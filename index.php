<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');
*/
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, HEAD, CREATE');
//header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

#Enrutador y Utilitarios
require_once "config/BeanResource.php";
require_once "config/ConfigurationTemplate.php";
require_once "config/Routes.php";

#ELEMENTS
$configurationTemplate = new ConfigurationTemplate();
if ($configurationTemplate->getView() == 'view') {
    $configurationTemplate->addTemplateBase();
} else if ($configurationTemplate->getView() == 'api') {
    header('Content-Type: application/json');
    $configurationTemplate->addContainer();
} else {
    $configurationTemplate->addContainer();
}

?>