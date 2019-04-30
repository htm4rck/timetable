<?php
class ConfigurationTemplate
{
    private $res_resources;
    public function __construct()
    {
        $routes = new Routes();
        $this->res_resources = $routes->getResourceForContainer();
    }
    public function addTemplateBase()
    {
        include "view/template.php";
    }
    public function addContainer()
    {
        /*CONTENEDOR CAMBIANTE DE ACUERDO AL MODULO E ITEM */
        include $this->res_resources[0];
    }

    public function getView(){
        
        #echo $this->res_resources[2];
        return $this->res_resources[2];

    }

    public function addScripts()
    {
        /*CONTENEDOR CAMBIANTE DE ACUERDO AL MODULO E ITEM */
        //INCLUIMOS LOS SCRIPTS
        $array_scripts = $this->res_resources[1];
        if ($array_scripts==null) {
        $array_scripts = array();
        }
        foreach ($array_scripts as $path_script) {
            echo '<script type="text/javascript" src="/back/' . $path_script . '"></script>';
        }
    }
}