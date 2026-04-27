<?php
class ControllerClinicStaff{
	static public function ctrSaveClinicStaff($data){
	   	$answer = (new ModelClinicStaff)->mdlSaveClinicStaff($data);
		return $answer;
	}

	static public function ctrEditClinicStaff($data){
	   	$answer = (new ModelClinicStaff)->mdlEditClinicStaff($data);
		return $answer;
	}

    static public function ctrClinicStaffList(){
		$answer = (new ModelClinicStaff)->mdlClinicStaffList();
		return $answer;
	}
	
	static public function ctrSearchClinicStaff($empid){
		$answer = (new ModelClinicStaff)->mdlSearchClinicStaff($empid);
		return $answer;
	}
}