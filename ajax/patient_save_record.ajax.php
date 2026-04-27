<?php
require_once "../controllers/patient.controller.php";
require_once "../models/patient.model.php";

class patientClinic{
  public $trans_type; 
  public $encodedby;
  public $firstname;
  public $lastname;
  public $mi;
  public $extension;
  public $birthdate;
  public $gender;
  public $nationality;
  public $email;
  public $mobile;
  public $alternate;
  public $address;

  public function savePatient(){
    $trans_type = $this->trans_type;
    $encodedby = $this->encodedby;
  	$firstname = $this->firstname;
  	$lastname = $this->lastname;
  	$mi = $this->mi;
    $extension = $this->extension;
  	$birthdate = $this->birthdate;
  	$gender = $this->gender;
  	$nationality = $this->nationality;
  	$email = $this->email;
  	$mobile = $this->mobile;
    $alternate = $this->alternate;
  	$address = $this->address;

    $data = array("firstname"=>$firstname,
    	          "lastname"=>$lastname,
                  "mi"=>$mi,
                  "extension"=>$extension,
                  "birthdate"=>$birthdate,
                  "gender"=>$gender,
                  "nationality"=>$nationality,
                  "email"=>$email,
                  "mobile"=>$mobile,
                  "alternate"=>$alternate,
                  "address"=>$address,
                  "encodedby"=>$encodedby);

    if ($trans_type == 'New'){
      $answer = (new ControllerPatient)->ctrSavePatient($data);
      echo $answer;
    }else{
      $answer = (new ControllerPatient)->ctrEditPatient($data);
    }

  }
}

$save_patient = new patientClinic();
$save_patient -> trans_type = $_POST["trans_type"];
$save_patient -> encodedby = $_POST["encodedby"];
$save_patient -> firstname = $_POST["firstname"];
$save_patient -> lastname = $_POST["lastname"];
$save_patient -> mi = $_POST["mi"];
$save_patient -> extension = $_POST["extension"];
$save_patient -> birthdate = $_POST["birthdate"];
$save_patient -> gender = $_POST["gender"];
$save_patient -> nationality = $_POST["nationality"];
$save_patient -> email = $_POST["email"];
$save_patient -> mobile = $_POST["mobile"];
$save_patient -> alternate = $_POST["alternate"];
$save_patient -> address = $_POST["address"];
$save_patient -> savePatient();