<?php
require_once "../controllers/userrights.controller.php";
require_once "../models/userrights.model.php";

class AccessPrivelegeList{
    public function displayAccessPrivelegeList(){
        $answer = (new ControllerUserRights)->ctrAccessUserList();
        echo json_encode($answer);
    }
}

$accessprivelege_info = new AccessPrivelegeList();
$accessprivelege_info->displayAccessPrivelegeList();
