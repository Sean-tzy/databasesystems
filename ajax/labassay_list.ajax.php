<?php
require_once "../controllers/labassay.controller.php";
require_once "../models/labassay.model.php";

class LaboratoryAssayList{
    public function displayLaboratoryAssayList(){
        $answer = (new ControllerLabAssay)->ctrLabAssayList();
        echo json_encode($answer);
    }
}

$labassay_info = new LaboratoryAssayList();
$labassay_info->displayLaboratoryAssayList();
