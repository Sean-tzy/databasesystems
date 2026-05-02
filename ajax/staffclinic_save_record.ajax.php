<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../controllers/clinicstaff.controller.php";
require_once __DIR__ . "/../models/clinicstaff.model.php";

$data = [
    "trans_type" => $_POST["trans_type"] ?? "New",
    "encodedby" => $_POST["encodedby"] ?? "",
    "firstname" => $_POST["firstname"] ?? "",
    "lastname" => $_POST["lastname"] ?? "",
    "mi" => $_POST["mi"] ?? "",
    "extension" => $_POST["extension"] ?? "",
    "designation" => $_POST["designation"] ?? "",
    "prc" => $_POST["prc"] ?? "",
    "empid" => $_POST["empid"] ?? "",
    "mobile" => $_POST["mobile"] ?? "",
    "alternate" => $_POST["alternate"] ?? "",
    "datehired" => $_POST["datehired"] ?? null,
    "address" => $_POST["address"] ?? ""
];

if ($data["trans_type"] === "New") {
    echo ControllerClinicStaff::ctrSaveClinicStaff($data);
} else {
    echo ControllerClinicStaff::ctrEditClinicStaff($data);
}