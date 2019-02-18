<?php
class Routes{

    public function getResourceForContainer(){
		$routes = new Routes();
		$path_resource = "view/modules/";
        if($routes->isURLValidate()){
			$context = '/app-php-base/';
			$context_path = $_SERVER['REQUEST_URI'];
			$path = substr($context_path,strlen($context));
			$values_path = explode("?",$path);
			$path = $values_path[0];
			if(substr($path,strlen($path)-1, strlen($path)) == "/"){
				$path = substr($path,0,strlen($path)-1);
			}
			$list_pages = array();

			/* menu1 */
			$resource = new BeanResource('menu1','menu1/item1.html');
			array_push($list_pages, $resource);
			/* submenu1 */
			$resource = new BeanResource('menu1/submenu1','menu1/submenu1/subitem1.html');
			array_push($list_pages, $resource);
			/* submenu2 */
			$resource = new BeanResource('menu1/submenu2','menu1/submenu2/subitem2.html');
			array_push($list_pages, $resource);
			/* menu2 */
			$resource = new BeanResource('menu2','menu2/item2.html');
			array_push($list_pages, $resource);
			/* menu3 */
			$resource = new BeanResource('menu3','menu3/item3.html');
			array_push($list_pages, $resource);


			$exists = false;
			foreach($list_pages as $_resource){
				if($path == $_resource->path){
					$exists = true;
					$path_resource .= $_resource->path_resource;
					break;
				}
			}
			if(!$exists){
				$path_resource .= 'index.html';
			}
        }else{
			$path_resource .= 'index.html';
		}
		return $path_resource;
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