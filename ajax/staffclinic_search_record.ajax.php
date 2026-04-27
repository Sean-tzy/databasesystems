<?php
require_once "../controllers/clinicstaff.controller.php";
require_once "../models/clinicstaff.model.php";

class ClinicStaffInformation{
    public $empid;
    public function getClinicStaffInformation(){
      $empid = $this->empid;
      $answer = (new ControllerClinicStaff)->ctrSearchClinicStaff($empid);
      echo json_encode($answer);
    }
}
 
if(isset($_POST["empid"])){
  $searchClinicStaff = new ClinicStaffInformation();
  $searchClinicStaff -> empid = $_POST["empid"];
  $searchClinicStaff -> getClinicStaffInformation();
}