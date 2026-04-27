<?php
require_once "../controllers/clinicstaff.controller.php";
require_once "../models/clinicstaff.model.php";

class staffList{ 
   public function displayClinicStaffList(){
     $answer = (new ControllerClinicStaff)->ctrClinicStaffList();
     echo json_encode($answer);
   }
}

$staff_info = new staffList();
$staff_info -> displayClinicStaffList();