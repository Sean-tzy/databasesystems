<?php
require_once "connection.php";
class ModelUserRights{
    static private function mdlRandomCredential($length){
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $maxIndex = strlen($characters) - 1;
        $value = '';

        for ($i = 0; $i < $length; $i++) {
            $value .= $characters[random_int(0, $maxIndex)];
        }

        return $value;
    }

    static private function mdlGenerateUsername($pdo){
        do {
            $username = 'user' . self::mdlRandomCredential(8);
            $stmt = $pdo->prepare("SELECT username FROM userrights WHERE username = :username");
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();
            $exists = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = null;
        } while ($exists);

        return $username;
    }

    static private function mdlGeneratePassword(){
        return self::mdlRandomCredential(12);
    }

    static private function mdlGenerateUserId($pdo){
        $stmt = $pdo->prepare("
            SELECT CONCAT('U', LPAD((COALESCE(MAX(CAST(SUBSTRING(userid, 2) AS UNSIGNED)), 0) + 1), 4, '0')) AS gen_id
            FROM userrights
            WHERE userid REGEXP '^U[0-9]+$'
        ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;

        return $result["gen_id"];
    }

	static public function mdlGetUserCredentials($tableUsers, $item, $value){
		$stmt = (new Connection)->connect()->prepare("SELECT * FROM $tableUsers WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
	}

	static public function mdlGetUserLogin($username, $upassword){
		$encryptpass = $upassword;
		$stmt = (new Connection)->connect()->prepare("SELECT userid, username, upassword FROM userrights WHERE (username = '$username') AND (upassword = '$encryptpass')");
		$stmt -> execute();
		return $stmt -> fetch();
	}

	static public function mdlAddLogin($empid){
		$db = new Connection();
		$pdo = $db->connect();
        try{
        	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

			date_default_timezone_set('Asia/Manila');

			$emp_id = $empid;
			$currentdate = date('Y-m-d');
			$currenttime = date('h:i A');
			$currentday = date("l");
			$stmt = (new Connection)->connect()->prepare("INSERT INTO logintracker(empid, cdate, ctime, cday) VALUES (:empid, :cdate, :ctime, :cday)");
			$stmt -> bindParam(":empid", $emp_id, PDO::PARAM_STR);
			$stmt -> bindParam(":cdate", $currentdate, PDO::PARAM_STR);
			$stmt -> bindParam(":ctime", $currenttime, PDO::PARAM_STR);
			$stmt -> bindParam(":cday", $currentday, PDO::PARAM_STR);
			
			$stmt->execute();
		    $pdo->commit();
		    return "ok";
		}catch (Exception $e){
			$pdo->rollBack();
			return "error";
		}	
		$pdo = null;	
		$stmt = null;
	}

	static public function mdlShowLoginReport($start_date, $end_date){
		if(!empty($end_date)){
			$dates = " AND (c.cdate BETWEEN '$start_date' AND '$end_date')";
		}else{
			$dates = "";
		}					

		$whereClause = "WHERE (c.empid != 'EM00001')" . $dates;
        
		$stmt = (new Connection)->connect()->prepare("SELECT c.cdate,c.ctime,c.cday,CONCAT(a.fname,' ',a.lname) AS full_name FROM employees AS a INNER JOIN logintracker AS c ON (a.empid = c.empid) $whereClause ORDER BY c.cdate,c.id");

		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

    static public function mdlAccessUserList(){
        $stmt = (new Connection)->connect()->prepare("
            SELECT
                u.userid,
                u.empid,
                u.usertype,
                u.diagnostics,
                u.clinicstaff,
                u.patientregistry,
                u.laboratoryassays,
                u.reports,
                u.accessprivelege,
                CONCAT(c.lastname, ', ', c.firstname) AS staffname
            FROM userrights AS u
            INNER JOIN clinicstaff AS c ON c.empid = u.empid
            ORDER BY c.lastname, c.firstname
        ");

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        return $results;
    }

    static public function mdlSearchAccessUser($empid){
        $stmt = (new Connection)->connect()->prepare("
            SELECT
                u.userid,
                u.empid,
                u.username,
                u.usertype,
                u.diagnostics,
                u.clinicstaff,
                u.patientregistry,
                u.laboratoryassays,
                u.reports,
                u.accessprivelege,
                CONCAT(c.lastname, ', ', c.firstname) AS staffname
            FROM userrights AS u
            INNER JOIN clinicstaff AS c ON c.empid = u.empid
            WHERE u.empid = :empid
        ");

        $stmt->bindParam(":empid", $empid, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlSaveAccessPrivileges($data){
        $db = new Connection();
        $pdo = $db->connect();

        try{
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

            $check = $pdo->prepare("SELECT empid FROM userrights WHERE empid = :empid");
            $check->bindParam(":empid", $data["empid"], PDO::PARAM_STR);
            $check->execute();

            if($check->rowCount() === 0){
                $userid = self::mdlGenerateUserId($pdo);
                $username = self::mdlGenerateUsername($pdo);
                $upassword = self::mdlGeneratePassword();

                $stmt = $pdo->prepare("
                    INSERT INTO userrights(
                        userid, empid, username, upassword,
                        usertype, diagnostics, clinicstaff,
                        patientregistry, laboratoryassays,
                        reports, accessprivelege
                    ) VALUES (
                        :userid, :empid, :username, :upassword,
                        :usertype, :diagnostics, :clinicstaff,
                        :patientregistry, :laboratoryassays,
                        :reports, :accessprivelege
                    )
                ");

                $stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
                $stmt->bindParam(":empid", $data["empid"], PDO::PARAM_STR);
                $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                $stmt->bindParam(":upassword", $upassword, PDO::PARAM_STR);
                $stmt->bindParam(":usertype", $data["usertype"], PDO::PARAM_STR);
                $stmt->bindParam(":diagnostics", $data["diagnostics"], PDO::PARAM_STR);
                $stmt->bindParam(":clinicstaff", $data["clinicstaff"], PDO::PARAM_STR);
                $stmt->bindParam(":patientregistry", $data["patientregistry"], PDO::PARAM_STR);
                $stmt->bindParam(":laboratoryassays", $data["laboratoryassays"], PDO::PARAM_STR);
                $stmt->bindParam(":reports", $data["reports"], PDO::PARAM_STR);
                $stmt->bindParam(":accessprivelege", $data["accessprivelege"], PDO::PARAM_STR);
                $stmt->execute();
            } else {
                $stmt = $pdo->prepare("
                    UPDATE userrights SET
                        usertype = :usertype,
                        diagnostics = :diagnostics,
                        clinicstaff = :clinicstaff,
                        patientregistry = :patientregistry,
                        laboratoryassays = :laboratoryassays,
                        reports = :reports,
                        accessprivelege = :accessprivelege
                    WHERE empid = :empid
                ");

                $stmt->bindParam(":empid", $data["empid"], PDO::PARAM_STR);
                $stmt->bindParam(":usertype", $data["usertype"], PDO::PARAM_STR);
                $stmt->bindParam(":diagnostics", $data["diagnostics"], PDO::PARAM_STR);
                $stmt->bindParam(":clinicstaff", $data["clinicstaff"], PDO::PARAM_STR);
                $stmt->bindParam(":patientregistry", $data["patientregistry"], PDO::PARAM_STR);
                $stmt->bindParam(":laboratoryassays", $data["laboratoryassays"], PDO::PARAM_STR);
                $stmt->bindParam(":reports", $data["reports"], PDO::PARAM_STR);
                $stmt->bindParam(":accessprivelege", $data["accessprivelege"], PDO::PARAM_STR);
                $stmt->execute();
            }

            $pdo->commit();
            return "ok";
        }catch (PDOException $e){
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            return "error";
        }
    }
}
