<?php
#error_reporting(E_ALL);
#ini_set('display_errors', '1');

#Enrutador y Utilitarios
require_once "config/BeanResource.php";
require_once "config/ConfigurationTemplate.php";
require_once "config/Routes.php";
require_once "config/Conexion.php";
require_once "capsule/Capsule.php";
require_once "capsule/Employee.php";
require_once "model/EmployeeM.php";

$configurationTemplate = new ConfigurationTemplate();
if ($configurationTemplate->getView() == 'view') {
    $configurationTemplate->addTemplateBase();
} else {
    $configurationTemplate->addContainer();
}

