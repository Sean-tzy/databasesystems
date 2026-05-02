<?php
require_once "../controllers/userrights.controller.php";
require_once "../models/userrights.model.php";

class AccessPrivelegeRecord{
    public $empid;
    public $usertype;
    public $diagnostics;
    public $clinicstaff;
    public $patientregistry;
    public $laboratoryassays;
    public $reports;
    public $accessprivelege;

    public function saveAccessPrivelege(){
        $data = array(
            "empid" => $this->empid,
            "usertype" => $this->usertype,
            "diagnostics" => $this->diagnostics,
            "clinicstaff" => $this->clinicstaff,
            "patientregistry" => $this->patientregistry,
            "laboratoryassays" => $this->laboratoryassays,
            "reports" => $this->reports,
            "accessprivelege" => $this->accessprivelege
        );

        $answer = (new ControllerUserRights)->ctrSaveAccessPrivileges($data);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($answer === "ok" && isset($_SESSION["empid"]) && $_SESSION["empid"] === $this->empid) {
            $_SESSION["usertype"] = $this->usertype;
            $_SESSION["diagnostics"] = $this->diagnostics;
            $_SESSION["clinicstaff"] = $this->clinicstaff;
            $_SESSION["patientregistry"] = $this->patientregistry;
            $_SESSION["laboratoryassays"] = $this->laboratoryassays;
            $_SESSION["reports"] = $this->reports;
            $_SESSION["accessprivelege"] = $this->accessprivelege;
        }

        echo $answer;
    }
}

$save_accessprivelege = new AccessPrivelegeRecord();
$save_accessprivelege->empid = $_POST["empid"];
$save_accessprivelege->usertype = $_POST["usertype"];
$save_accessprivelege->diagnostics = $_POST["diagnostics"];
$save_accessprivelege->clinicstaff = $_POST["clinicstaff"];
$save_accessprivelege->patientregistry = $_POST["patientregistry"];
$save_accessprivelege->laboratoryassays = $_POST["laboratoryassays"];
$save_accessprivelege->reports = $_POST["reports"];
$save_accessprivelege->accessprivelege = $_POST["accessprivelege"];
$save_accessprivelege->saveAccessPrivelege();
