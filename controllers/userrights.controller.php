<?php
class ControllerUserRights{
    static private function ctrNormalizeAccessLevel($value){
        $allowed = ["Full", "View", "Restricted"];
        return in_array($value, $allowed) ? $value : "Full";
    }

	static public function ctrUserLogin(){
		if (isset($_POST["loginUser"])) {
				$encryptpass = $_POST["loginPass"];
				$table = 'userrights';
				$item = 'username';
				$value = $_POST["loginUser"];
				$answer = (new ModelUserRights)->mdlGetUserCredentials($table, $item, $value);

				if(!empty($answer) && $answer["username"] == $_POST["loginUser"] && $answer["upassword"] == $encryptpass){
					$_SESSION["loggedIn"] = "ok";
					$_SESSION["id"] = $answer["id"];
					
					$_SESSION["empid"] = $answer["empid"];
					$_SESSION["userid"] = $answer["userid"];
                    $_SESSION["usertype"] = $answer["usertype"] ?? "Admin";
                    $_SESSION["diagnostics"] = self::ctrNormalizeAccessLevel($answer["diagnostics"] ?? "Full");
                    $_SESSION["clinicstaff"] = self::ctrNormalizeAccessLevel($answer["clinicstaff"] ?? "Full");
                    $_SESSION["patientregistry"] = self::ctrNormalizeAccessLevel($answer["patientregistry"] ?? "Full");
                    $_SESSION["laboratoryassays"] = self::ctrNormalizeAccessLevel($answer["laboratoryassays"] ?? "Full");
                    $_SESSION["reports"] = self::ctrNormalizeAccessLevel($answer["reports"] ?? "Full");
                    $_SESSION["accessprivelege"] = self::ctrNormalizeAccessLevel($answer["accessprivelege"] ?? "Full");
					
					$empid = $_SESSION["empid"];
					$answer = (new ModelUserRights)->mdlAddLogin($empid);
				    if ($answer == 'ok') {
                        echo '<script>
									window.location = "home";
								</script>';
				    }
				}else{
					echo '<br><div style="text-align:center;" class="alert alert-danger">User or password incorrect</div>';
				}
			
		}
	}

    static public function ctrAccessUserList(){
        $answer = (new ModelUserRights)->mdlAccessUserList();
        return $answer;
    }

    static public function ctrSearchAccessUser($empid){
        $answer = (new ModelUserRights)->mdlSearchAccessUser($empid);
        return $answer;
    }

    static public function ctrSaveAccessPrivileges($data){
        $answer = (new ModelUserRights)->mdlSaveAccessPrivileges($data);
        return $answer;
    }
}
