<?php
require_once "../controllers/clinicstaff.controller.php";
require_once "../models/clinicstaff.model.php";

class staffClinic{
  public $trans_type; 
  public $encodedby;
  public $firstname;
  public $lastname;
  public $mi;
  public $extension;
  public $designation;
  public $prc;
  public $empid;
  public $mobile;
  public $alternate;
  public $datehired;
  public $address;

  public function saveClinicStaff(){
    $trans_type = $this->trans_type;
    $encodedby = $this->encodedby;
  	$firstname = $this->firstname;
  	$lastname = $this->lastname;
  	$mi = $this->mi;
    $extension = $this->extension;
  	$designation = $this->designation;
  	$prc = $this->prc;
  	$empid = $this->empid;
  	$mobile = $this->mobile;
  	$alternate = $this->alternate;
    $datehired = $this->datehired;
  	$address = $this->address;

    $data = array("firstname"=>$firstname,
    	            "lastname"=>$lastname,
                  "mi"=>$mi,
                  "extension"=>$extension,
                  "designation"=>$designation,
                  "prc"=>$prc,
                  "empid"=>$empid,
                  "mobile"=>$mobile,
                  "alternate"=>$alternate,
                  "datehired"=>$datehired,
                  "address"=>$address,
                  "encodedby"=>$encodedby);

    if ($trans_type == 'New'){
      $answer = (new ControllerClinicStaff)->ctrSaveClinicStaff($data);
      echo $answer;
    }else{
      $answer = (new ControllerClinicStaff)->ctrEditClinicStaff($data);
      echo $answer;
    }

  }
}

$save_clinicstaff = new staffClinic();

$save_clinicstaff -> trans_type = $_POST["trans_type"];
$save_clinicstaff -> encodedby = $_POST["encodedby"];
$save_clinicstaff -> firstname = $_POST["firstname"];
$save_clinicstaff -> lastname = $_POST["lastname"];
$save_clinicstaff -> mi = $_POST["mi"];
$save_clinicstaff -> extension = $_POST["extension"];
$save_clinicstaff -> designation = $_POST["designation"];
$save_clinicstaff -> prc = $_POST["prc"];
$save_clinicstaff -> empid = $_POST["empid"];
$save_clinicstaff -> mobile = $_POST["mobile"];
$save_clinicstaff -> alternate = $_POST["alternate"];
$save_clinicstaff -> datehired = $_POST["datehired"];
$save_clinicstaff -> address = $_POST["address"];
$save_clinicstaff -> saveClinicStaff();