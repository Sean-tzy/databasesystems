<?php
require_once "../controllers/patient.controller.php";
require_once "../models/patient.model.php";

class patientList{ 
   public function displayPatientList(){
     $answer = (new ControllerPatient)->ctrPatientList();
     echo json_encode($answer);
   }
}

$patient_info = new patientList();
$patient_info -> displayPatientList();