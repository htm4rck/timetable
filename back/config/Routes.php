<?php
class Routes{

    public function getResourceForContainer(){
		$routes = new Routes();
		$path_resource = "view/modules/";
		$path_scripts = "";
        if($routes->isURLValidate()){
			$context = '/back/';
			$context_path = $_SERVER['REQUEST_URI'];
			$path = substr($context_path,strlen($context));
			$values_path = explode("?",$path);
			$path = $values_path[0];
			if(substr($path,strlen($path)-1, strlen($path)) == "/"){
				$path = substr($path,0,strlen($path)-1);
			}
			$list_pages = array();
			#TODO: MANTENIMIENTOS
			$resource = new BeanResource('upkeeps','upkeeps/upkeeps.html',array());
			array_push($list_pages, $resource);

			$resource = new BeanResource('upkeeps/employee','upkeeps/employee/employee.php',array($path_resource . 'upkeeps/employee/employee.js'));
			array_push($list_pages, $resource);


			$exists = false;
			foreach($list_pages as $_resource){
				if($path == $_resource->path){
					$exists = true;
					$path_resource .= $_resource->path_resource;
					$path_scripts = $_resource->path_scripts;
					break;
				}
			}
			if(!$exists){
				$path_resource .= 'index.html';
			}
        }else{
			$path_resource .= 'index.html';
		}
		$resources = array($path_resource, $path_scripts);
		return $resources;
    }

    public function isURLValidate(){
		$url_actual = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if (filter_var($url_actual, FILTER_VALIDATE_URL)) {
			return true;
		} else {
			return false;
		}
	}
}