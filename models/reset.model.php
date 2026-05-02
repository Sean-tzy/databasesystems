<?php

require_once __DIR__ . "/connection.php";

class ModelReset
{
    static public function mdlGetUserByUsername($table, $username)
    {
        $allowedTables = ["userrights"];

        if (!in_array($table, $allowedTables, true)) {
            return false;
        }

        try {
            $stmt = Connection::connect()->prepare(
                "SELECT id, username, upassword
                 FROM $table
                 WHERE username = :username
                 LIMIT 1"
            );

            $stmt->bindParam(":username", $username, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }

            return false;

        } catch (PDOException $e) {
            return false;
        }
    }

    static public function mdlUpdateCredentials($table, $data)
    {
        $allowedTables = ["userrights"];

        if (!in_array($table, $allowedTables, true)) {
            return "Invalid table.";
        }

        try {
            $stmt = Connection::connect()->prepare(
                "UPDATE $table
                 SET username = :username,
                     upassword = :upassword
                 WHERE id = :id"
            );

            $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
            $stmt->bindParam(":upassword", $data["upassword"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            }

            return "Unable to update credentials.";

        } catch (PDOException $e) {
            return "SQL ERROR: " . $e->getMessage();
        }
    }
}