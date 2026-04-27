<?php
require_once "../controllers/labassay.controller.php";
require_once "../models/labassay.model.php";

class LaboratoryAssayRecord{
    public $trans_type;
    public $assaycode;
    public $abbreviation;
    public $description;
    public $category;
    public $atype;
    public $resulttype;
    public $specimen;
    public $unit;
    public $price;
    public $remarks;

    public function saveLaboratoryAssay(){
        $data = array(
            "assaycode" => $this->assaycode,
            "abbreviation" => $this->abbreviation,
            "description" => $this->description,
            "category" => $this->category,
            "atype" => $this->atype,
            "resulttype" => $this->resulttype,
            "specimen" => $this->specimen,
            "unit" => $this->unit,
            "price" => $this->price,
            "remarks" => $this->remarks
        );

        if ($this->trans_type == 'New'){
            $answer = (new ControllerLabAssay)->ctrSaveLabAssay($data);
            echo $answer;
        }else{
            $answer = (new ControllerLabAssay)->ctrEditLabAssay($data);
            echo $answer;
        }
    }
}

$save_labassay = new LaboratoryAssayRecord();
$save_labassay->trans_type = $_POST["trans_type"];
$save_labassay->assaycode = $_POST["assaycode"];
$save_labassay->abbreviation = $_POST["abbreviation"];
$save_labassay->description = $_POST["description"];
$save_labassay->category = $_POST["category"];
$save_labassay->atype = $_POST["atype"];
$save_labassay->resulttype = $_POST["resulttype"];
$save_labassay->specimen = $_POST["specimen"];
$save_labassay->unit = $_POST["unit"];
$save_labassay->price = $_POST["price"];
$save_labassay->remarks = $_POST["remarks"];
$save_labassay->saveLaboratoryAssay();
