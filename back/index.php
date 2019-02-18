<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

#Enrutador y Utilitarios
require_once "config/BeanResource.php";
require_once "config/ConfigurationTemplate.php";
require_once "config/Routes.php";

$configurationTemplate = new ConfigurationTemplate();
$configurationTemplate->addTemplateBase();

?>