<?php
class ConfigurationTemplate{

    public function addTemplateBase(){
		include "view/template.php";
    }

    public function addContainer(){
        $routes = new Routes();
        $res = $routes->getResourceForContainer();
        include $res;
    }
}