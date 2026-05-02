<?php

class Connection
{
    static public function connect()
    {
        try {
            $link = new PDO(
                "mysql:host=localhost;dbname=labdiagnostic",
                "root",
                ""
            );

            $link->exec("set names utf8");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $link;

        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}