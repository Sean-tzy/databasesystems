<?php
require_once "connection.php";
class ModelClinicStaff{
    static public function mdlSaveClinicStaff($data){
        $db = new Connection();
        $pdo = $db->connect();

        try{
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

            // Generate ID
            $clinicstaff_id = $pdo->prepare("
                SELECT CONCAT('CS', LPAD((COUNT(id)+1),4,'0')) as gen_id 
                FROM clinicstaff
            ");
            $clinicstaff_id->execute();
            $clinicstaffid = $clinicstaff_id->fetch(PDO::FETCH_ASSOC);
            $clinicstaffcode = $clinicstaffid['gen_id'];

            // OPTIONAL: Manual check (extra safety)
            $check = $pdo->prepare("SELECT empid FROM clinicstaff WHERE empid = :empid");
            $check->bindParam(":empid", $clinicstaffcode, PDO::PARAM_STR);
            $check->execute();

            if($check->rowCount() > 0){
                $pdo->rollBack();
                return "existing";
            }

            // Insert
            $stmt = $pdo->prepare("
                INSERT INTO clinicstaff(
                    empid, firstname, lastname, mi, extension,
                    designation, prc, mobile, alternate,
                    datehired, address, encodedby
                ) VALUES (
                    :empid, :firstname, :lastname, :mi, :extension,
                    :designation, :prc, :mobile, :alternate,
                    :datehired, :address, :encodedby
                )
            ");

            $stmt->bindParam(":empid", $clinicstaffcode, PDO::PARAM_STR);
            $stmt->bindParam(":firstname", $data["firstname"], PDO::PARAM_STR);
            $stmt->bindParam(":lastname", $data["lastname"], PDO::PARAM_STR);
            $stmt->bindParam(":mi", $data["mi"], PDO::PARAM_STR);
            $stmt->bindParam(":extension", $data["extension"], PDO::PARAM_STR);
            $stmt->bindParam(":designation", $data["designation"], PDO::PARAM_STR);
            $stmt->bindParam(":prc", $data["prc"], PDO::PARAM_STR);
            $stmt->bindParam(":mobile", $data["mobile"], PDO::PARAM_STR);
            $stmt->bindParam(":alternate", $data["alternate"], PDO::PARAM_STR);

            if (empty($data["datehired"])) {
                $stmt->bindValue(":datehired", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":datehired", $data["datehired"], PDO::PARAM_STR);
            }
            // $stmt->bindParam(":datehired", $data["datehired"], PDO::PARAM_STR);
            $stmt->bindParam(":address", $data["address"], PDO::PARAM_STR);
            $stmt->bindParam(":encodedby", $data["encodedby"], PDO::PARAM_STR);

            $stmt->execute();

            $pdo->commit();
            return $clinicstaffcode;

        }catch (PDOException $e){
            $pdo->rollBack();
            // If duplicate entry error (MySQL error code 1062)
            if($e->errorInfo[1] == 1062){
                return "existing";
            }
            return "error";
        }
    }

    static public function mdlEditClinicStaff($data){
        $db = new Connection();
        $pdo = $db->connect();

        try{
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("
                UPDATE clinicstaff SET
                    firstname = :firstname,
                    lastname = :lastname,
                    mi = :mi,
                    extension = :extension,
                    designation = :designation,
                    prc = :prc,
                    mobile = :mobile,
                    alternate = :alternate,
                    datehired = :datehired,
                    address = :address,
                    encodedby = :encodedby
                WHERE empid = :empid
            ");

            $stmt->bindParam(":empid", $data["empid"], PDO::PARAM_STR);
            $stmt->bindParam(":firstname", $data["firstname"], PDO::PARAM_STR);
            $stmt->bindParam(":lastname", $data["lastname"], PDO::PARAM_STR);
            $stmt->bindParam(":mi", $data["mi"], PDO::PARAM_STR);
            $stmt->bindParam(":extension", $data["extension"], PDO::PARAM_STR);
            $stmt->bindParam(":designation", $data["designation"], PDO::PARAM_STR);
            $stmt->bindParam(":prc", $data["prc"], PDO::PARAM_STR);
            $stmt->bindParam(":mobile", $data["mobile"], PDO::PARAM_STR);
            $stmt->bindParam(":alternate", $data["alternate"], PDO::PARAM_STR);

            if (empty($data["datehired"])) {
                $stmt->bindValue(":datehired", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":datehired", $data["datehired"], PDO::PARAM_STR);
            }
            $stmt->bindParam(":address", $data["address"], PDO::PARAM_STR);
            $stmt->bindParam(":encodedby", $data["encodedby"], PDO::PARAM_STR);

            $stmt->execute();

            $pdo->commit();
            return "ok";

        }catch (PDOException $e){
            $pdo->rollBack();
            if($e->errorInfo[1] == 1062){
                return "existing";
            }
            return "error";
        }
    }    

    static public function mdlClinicStaffList(){
		$stmt = (new Connection)->connect()->prepare("SELECT * FROM clinicstaff");
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt = null; 
        return $results;
	}	

    static public function mdlSearchClinicStaff($empid) {
        $stmt = (new Connection)->connect()->prepare(
            "SELECT * FROM clinicstaff WHERE empid = :empid"
        );

        $stmt->bindParam(":empid", $empid, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }
}