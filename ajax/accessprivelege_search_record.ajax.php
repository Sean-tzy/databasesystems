<?php
require_once "../controllers/userrights.controller.php";
require_once "../models/userrights.model.php";

class AccessPrivelegeInformation{
    public $empid;

    public function getAccessPrivelegeInformation(){
        $answer = (new ControllerUserRights)->ctrSearchAccessUser($this->empid);
        echo json_encode($answer);
    }
}

if(isset($_POST["empid"])){
    $search_accessprivelege = new AccessPrivelegeInformation();
    $search_accessprivelege->empid = $_POST["empid"];
    $search_accessprivelege->getAccessPrivelegeInformation();
}
