<?php	
require_once "controllers/template.controller.php";

require_once "controllers/userrights.controller.php";
require_once "models/userrights.model.php";

require_once "controllers/clinicstaff.controller.php";
require_once "models/clinicstaff.model.php";

require_once "controllers/patient.controller.php";
require_once "models/patient.model.php";

require_once "controllers\labassay.controller.php";
require_once "models\labassay.model.php";

$template = new ControllerTemplate();
$template -> ctrTemplate();
