<?php
class ControllerClinicStaff {

    static public function ctrSaveClinicStaff($data){
        return ModelClinicStaff::mdlSaveClinicStaff($data);
    }

    static public function ctrEditClinicStaff($data){
        return ModelClinicStaff::mdlEditClinicStaff($data);
    }

    static public function ctrClinicStaffList(){
        return ModelClinicStaff::mdlClinicStaffList();
    }

    static public function ctrSearchClinicStaff($empid){
        return ModelClinicStaff::mdlSearchClinicStaff($empid);
    }
}