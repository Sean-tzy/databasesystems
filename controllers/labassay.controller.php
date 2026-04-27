<?php
class ControllerLabAssay{
    static public function ctrSaveLabAssay($data){
        $answer = (new ModelLabAssay)->mdlSaveLabAssay($data);
        return $answer;
    }

    static public function ctrEditLabAssay($data){
        $answer = (new ModelLabAssay)->mdlEditLabAssay($data);
        return $answer;
    }

    static public function ctrLabAssayList(){
        $answer = (new ModelLabAssay)->mdlLabAssayList();
        return $answer;
    }

    static public function ctrSearchLabAssay($assaycode){
        $answer = (new ModelLabAssay)->mdlSearchLabAssay($assaycode);
        return $answer;
    }
}
