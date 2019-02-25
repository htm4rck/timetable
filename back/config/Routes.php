<?php
class Routes
{

  private $list_pages;
  private $path_resource;
  public function __construct()
  {
    $this->path_resource = "view/modules/";
    $this->list_pages = array();
    //TODO: API
    $resource = new BeanResource('api/employee', 'EmployeeC.php');
    $resource->viewApi();
    array_push($this->list_pages, $resource);
    //TODO : MANTENIMIENTOS
    $resource = new BeanResource('upkeeps', 'upkeeps/upkeeps.html');
    array_push($this->list_pages, $resource);

    $resource = new BeanResource('upkeeps/employee', 'upkeeps/employee/employee.php', array($this->path_resource . 'upkeeps/employee/employee.js'));
    array_push($this->list_pages, $resource);
  }

  public function getResourceForContainer()
  {
    $routes = new Routes();
    $path_scripts = "";
    $view = true;
    if ($routes->isURLValidate()) {
      $context = '/back/';
      $context_path = $_SERVER['REQUEST_URI'];
      $path = substr($context_path, strlen($context));
      $values_path = explode("?", $path);
      $path = $values_path[0];
      if (substr($path, strlen($path) - 1, strlen($path)) == "/") {
        $path = substr($path, 0, strlen($path) - 1);
      }
      $exists = false;
      foreach ($this->list_pages as $_resource) {
        if ($path == $_resource->path) {
          $exists = true;
          if ($_resource->view == 'api') {
            $this->path_resource = 'control/';
          }
          $this->path_resource .= $_resource->path_resource;
          $path_scripts = $_resource->path_scripts;
          $view = $_resource->view;
          break;
        }
      }
      if (!$exists) {
        $this->path_resource .= 'index.html';
      }
    } else {
      $this->path_resource .= 'index.html';
    }
    $resources = array($this->path_resource, $path_scripts, $view);
    return $resources;
  }

  public function isURLValidate()
  {
    $url_actual = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (filter_var($url_actual, FILTER_VALIDATE_URL)) {
      return true;
    } else {
      return false;
    }
  }
}
