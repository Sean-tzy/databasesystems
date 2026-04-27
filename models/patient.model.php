<?php
require_once "connection.php";
class ModelPatient{
    static public function mdlSavePatient($data){
        $db = new Connection();
        $pdo = $db->connect();

        try{
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

            // Generate ID
            $patient_id = $pdo->prepare("
                SELECT CONCAT('PI', LPAD((COUNT(id)+1),8,'0')) as gen_id 
                FROM patient
            ");
            $patient_id->execute();
            $patientid = $patient_id->fetch(PDO::FETCH_ASSOC);
            $patientcode = $patientid['gen_id'];

            // OPTIONAL: Manual check (extra safety)
            $check = $pdo->prepare("SELECT patientid FROM patient WHERE patientid = :patientid");
            $check->bindParam(":patientid", $patientcode, PDO::PARAM_STR);
            $check->execute();

            if($check->rowCount() > 0){
                $pdo->rollBack();
                return "existing";
            }

            // Insert
            $stmt = $pdo->prepare("
                INSERT INTO patient(
                    patientid, firstname, lastname, mi, extension, 
                    birthdate, gender, nationality, email, 
                    mobile, alternate, address, encodedby
                ) VALUES (
                    :patientid, :firstname, :lastname, :mi, :extension,
                    :birthdate, :gender, :nationality, :email,
                    :mobile, :alternate, :address, :encodedby
                )
            ");

            $stmt->bindParam(":patientid", $patientcode, PDO::PARAM_STR);
            $stmt->bindParam(":firstname", $data["firstname"], PDO::PARAM_STR);
            $stmt->bindParam(":lastname", $data["lastname"], PDO::PARAM_STR);
            $stmt->bindParam(":mi", $data["mi"], PDO::PARAM_STR);
            $stmt->bindParam(":extension", $data["extension"], PDO::PARAM_STR);

            if (empty($data["birthdate"])) {
                $stmt->bindValue(":birthdate", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":birthdate", $data["birthdate"], PDO::PARAM_STR);
            }
            $stmt->bindParam(":gender", $data["gender"], PDO::PARAM_STR);
            $stmt->bindParam(":nationality", $data["nationality"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
            $stmt->bindParam(":mobile", $data["mobile"], PDO::PARAM_STR);
            $stmt->bindParam(":alternate", $data["alternate"], PDO::PARAM_STR);
            $stmt->bindParam(":address", $data["address"], PDO::PARAM_STR);
            $stmt->bindParam(":encodedby", $data["encodedby"], PDO::PARAM_STR);

            $stmt->execute();

            $pdo->commit();
            return $patientcode;

        }catch (PDOException $e){
            $pdo->rollBack();
            // If duplicate entry error (MySQL error code 1062)
            if($e->errorInfo[1] == 1062){
                return "existing";
            }
            return "error";
        }
    }

    static public function mdlPatientList(){
		$stmt = (new Connection)->connect()->prepare("SELECT * FROM patient");
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt = null; 
        return $results;
	}	
}