<?php
require_once "connection.php";

class ModelClinicStaff {

    static public function mdlSaveClinicStaff($data) {

        try {
            $pdo = (new Connection())->connect();

            $stmt = $pdo->prepare("
                INSERT INTO clinicstaff
                (empid, firstname, lastname, mi, extension, designation, prc, mobile, alternate, datehired, address, encodedby, estatus)
                VALUES
                (:empid, :firstname, :lastname, :mi, :extension, :designation, :prc, :mobile, :alternate, :datehired, :address, :encodedby, :estatus)
            ");

            $stmt->execute([
                ":empid" => $data["empid"] ?: "EM" . str_pad(rand(1,99999), 5, "0", STR_PAD_LEFT),
                ":firstname" => $data["firstname"],
                ":lastname" => $data["lastname"],
                ":mi" => $data["mi"],
                ":extension" => $data["extension"] ?: "",
                ":designation" => $data["designation"],
                ":prc" => $data["prc"] ?: "",
                ":mobile" => $data["mobile"] ?: "",
                ":alternate" => $data["alternate"] ?: "",
                ":datehired" => $data["datehired"] ?: null,
                ":address" => $data["address"] ?: "",
                ":encodedby" => $data["encodedby"],
                ":estatus" => "Active"
            ]);

            return "ok";

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    static public function mdlEditClinicStaff($data) {

        try {
            $pdo = (new Connection())->connect();

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
                    address = :address
                WHERE empid = :empid
            ");

            $stmt->execute([
                ":firstname" => $data["firstname"],
                ":lastname" => $data["lastname"],
                ":mi" => $data["mi"],
                ":extension" => $data["extension"] ?: "",
                ":designation" => $data["designation"],
                ":prc" => $data["prc"] ?: "",
                ":mobile" => $data["mobile"] ?: "",
                ":alternate" => $data["alternate"] ?: "",
                ":datehired" => $data["datehired"] ?: null,
                ":address" => $data["address"] ?: "",
                ":empid" => $data["empid"]
            ]);

            return "ok";

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

static public function mdlClinicStaffList() {

    try {
        $pdo = (new Connection())->connect();

        $stmt = $pdo->prepare("
            SELECT 
                empid,
                firstname,
                lastname,
                mi,
                designation,
                prc,
                mobile
            FROM clinicstaff
            ORDER BY lastname, firstname
        ");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        return [];
    }
}

}