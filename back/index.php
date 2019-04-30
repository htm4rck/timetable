<?php
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
//header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

#Enrutador y Utilitarios
require_once "config/BeanResource.php";
require_once "config/ConfigurationTemplate.php";
require_once "config/Routes.php";
require_once "config/Conexion.php";
require_once "capsule/Capsule.php";

require_once "capsule/Employee.php";
require_once "capsule/Manager.php";
require_once "capsule/TimetableEmployee.php";

require_once "model/EmployeeM.php";
require_once "model/ManagerM.php";
require_once "model/TimetableEmployeeM.php";

$configurationTemplate = new ConfigurationTemplate();
if ($configurationTemplate->getView() == 'view') {
    $configurationTemplate->addTemplateBase();
} else if ($configurationTemplate->getView() == 'api') {
    header('Content-Type: application/json');
    $configurationTemplate->addContainer();
} else {
    $configurationTemplate->addContainer();
}
