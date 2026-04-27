<?php
require_once "connection.php";

class ModelLabAssay{
    static private function mdlGenerateLabAssayCode($pdo){
        $stmt = $pdo->prepare("
            SELECT COALESCE(MAX(CAST(SUBSTRING(assaycode, 2) AS UNSIGNED)), 0) AS last_code
            FROM laboratoryassays
            WHERE assaycode REGEXP '^A[0-9]+$'
        ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $nextNumber = (int)$result["last_code"] + 1;
        $stmt = null;

        return "A" . str_pad((string)$nextNumber, 3, "0", STR_PAD_LEFT);
    }

    static private function mdlEnsureLabAssayTable($pdo){
        $stmt = $pdo->prepare("
            CREATE TABLE IF NOT EXISTS laboratoryassays (
                id INT NOT NULL AUTO_INCREMENT,
                assaycode VARCHAR(20) NOT NULL,
                abbreviation VARCHAR(50) NOT NULL,
                description VARCHAR(150) NOT NULL,
                category VARCHAR(50) NOT NULL,
                atype VARCHAR(30) NOT NULL,
                resulttype VARCHAR(30) NOT NULL,
                specimen VARCHAR(50) NOT NULL,
                unit VARCHAR(30) DEFAULT NULL,
                price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
                remarks VARCHAR(255) DEFAULT NULL,
                PRIMARY KEY (id),
                UNIQUE KEY uniq_assaycode (assaycode)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");

        $stmt->execute();
        $stmt = null;
    }

    static public function mdlSaveLabAssay($data){
        $db = new Connection();
        $pdo = $db->connect();

        try{
            self::mdlEnsureLabAssayTable($pdo);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

            $assaycode = self::mdlGenerateLabAssayCode($pdo);

            $check = $pdo->prepare("SELECT assaycode FROM laboratoryassays WHERE assaycode = :assaycode");
            $check->bindParam(":assaycode", $assaycode, PDO::PARAM_STR);
            $check->execute();

            if($check->rowCount() > 0){
                $pdo->rollBack();
                return "existing";
            }

            $stmt = $pdo->prepare("
                INSERT INTO laboratoryassays(
                    assaycode, abbreviation, description, category,
                    atype, resulttype, specimen, unit,
                    price, remarks
                ) VALUES (
                    :assaycode, :abbreviation, :description, :category,
                    :atype, :resulttype, :specimen, :unit,
                    :price, :remarks
                )
            ");

            $stmt->bindParam(":assaycode", $assaycode, PDO::PARAM_STR);
            $stmt->bindParam(":abbreviation", $data["abbreviation"], PDO::PARAM_STR);
            $stmt->bindParam(":description", $data["description"], PDO::PARAM_STR);
            $stmt->bindParam(":category", $data["category"], PDO::PARAM_STR);
            $stmt->bindParam(":atype", $data["atype"], PDO::PARAM_STR);
            $stmt->bindParam(":resulttype", $data["resulttype"], PDO::PARAM_STR);
            $stmt->bindParam(":specimen", $data["specimen"], PDO::PARAM_STR);

            if ($data["unit"] === "") {
                $stmt->bindValue(":unit", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":unit", $data["unit"], PDO::PARAM_STR);
            }

            $stmt->bindValue(":price", $data["price"], PDO::PARAM_STR);

            if ($data["remarks"] === "") {
                $stmt->bindValue(":remarks", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":remarks", $data["remarks"], PDO::PARAM_STR);
            }

            $stmt->execute();

            $pdo->commit();
            return $assaycode;

        }catch (PDOException $e){
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }

            if(isset($e->errorInfo[1]) && $e->errorInfo[1] == 1062){
                return "existing";
            }

            return "error";
        }
    }

    static public function mdlEditLabAssay($data){
        $db = new Connection();
        $pdo = $db->connect();

        try{
            self::mdlEnsureLabAssayTable($pdo);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("
                UPDATE laboratoryassays SET
                    abbreviation = :abbreviation,
                    description = :description,
                    category = :category,
                    atype = :atype,
                    resulttype = :resulttype,
                    specimen = :specimen,
                    unit = :unit,
                    price = :price,
                    remarks = :remarks
                WHERE assaycode = :assaycode
            ");

            $stmt->bindParam(":assaycode", $data["assaycode"], PDO::PARAM_STR);
            $stmt->bindParam(":abbreviation", $data["abbreviation"], PDO::PARAM_STR);
            $stmt->bindParam(":description", $data["description"], PDO::PARAM_STR);
            $stmt->bindParam(":category", $data["category"], PDO::PARAM_STR);
            $stmt->bindParam(":atype", $data["atype"], PDO::PARAM_STR);
            $stmt->bindParam(":resulttype", $data["resulttype"], PDO::PARAM_STR);
            $stmt->bindParam(":specimen", $data["specimen"], PDO::PARAM_STR);

            if ($data["unit"] === "") {
                $stmt->bindValue(":unit", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":unit", $data["unit"], PDO::PARAM_STR);
            }

            $stmt->bindValue(":price", $data["price"], PDO::PARAM_STR);

            if ($data["remarks"] === "") {
                $stmt->bindValue(":remarks", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(":remarks", $data["remarks"], PDO::PARAM_STR);
            }

            $stmt->execute();

            $pdo->commit();
            return "ok";

        }catch (PDOException $e){
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }

            return "error";
        }
    }

    static public function mdlLabAssayList(){
        $pdo = (new Connection)->connect();
        self::mdlEnsureLabAssayTable($pdo);

        $stmt = $pdo->prepare("SELECT * FROM laboratoryassays ORDER BY description ASC");
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt = null;
        return $results;
    }

    static public function mdlSearchLabAssay($assaycode){
        $pdo = (new Connection)->connect();
        self::mdlEnsureLabAssayTable($pdo);

        $stmt = $pdo->prepare("SELECT * FROM laboratoryassays WHERE assaycode = :assaycode");
        $stmt->bindParam(":assaycode", $assaycode, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }
}
