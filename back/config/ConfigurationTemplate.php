<?php
class ConfigurationTemplate
{
    public function addTemplateBase()
    {
        include "view/template.php";
    }
    public function addContainer()
    {
        /*CONTENEDOR CAMBIANTE DE ACUERDO AL MODULO E ITEM */
        $routes = new Routes();
        $res_resources = $routes->getResourceForContainer();
        include $res_resources[0];
    }
    public function addScripts()
    {
        /*CONTENEDOR CAMBIANTE DE ACUERDO AL MODULO E ITEM */
        $routes = new Routes();
        $res_resources = $routes->getResourceForContainer();
        //INCLUIMOS LOS SCRIPTS
        $array_scripts = $res_resources[1];
        if ($array_scripts==null) {
        $array_scripts = array();
        }
        foreach ($array_scripts as $path_script) {
            echo '<script type="text/javascript" src="/back/' . $path_script . '"></script>';
        }
    }
}