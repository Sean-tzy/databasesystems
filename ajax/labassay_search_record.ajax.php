<?php
require_once "../controllers/labassay.controller.php";
require_once "../models/labassay.model.php";

class LaboratoryAssayInformation{
    public $assaycode;

    public function getLaboratoryAssayInformation(){
        $answer = (new ControllerLabAssay)->ctrSearchLabAssay($this->assaycode);
        echo json_encode($answer);
    }
}

if(isset($_POST["assaycode"])){
    $search_labassay = new LaboratoryAssayInformation();
    $search_labassay->assaycode = $_POST["assaycode"];
    $search_labassay->getLaboratoryAssayInformation();
}
