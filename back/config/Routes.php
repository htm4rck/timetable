<?php
class Routes
{

  private $list_pages;
  private $path_resource;
  public function __construct()
  {
    $this->path_resource = "view/modules/";
    $this->list_pages = array();
    
    //TODO : INICIO
    $resource = new BeanResource('index', 'index/index.html');
    array_push($this->list_pages, $resource);
    $resource = new BeanResource('', 'index/index.html');
    array_push($this->list_pages, $resource);

    //TODO: API
    $resource = new BeanResource('api/employee', 'EmployeeC.php');
    $resource->viewApi();
    array_push($this->list_pages, $resource);

    $resource = new BeanResource('api/manager', 'ManagerC.php');
    $resource->viewApi();
    array_push($this->list_pages, $resource);

    $resource = new BeanResource('api/timetbemployee', 'TimetableEmployeeC.php');
    $resource->viewApi();
    array_push($this->list_pages, $resource);

    $resource = new BeanResource('api/timetbweekly', 'TimetableWeeklyC.php');
    $resource->viewApi();
    array_push($this->list_pages, $resource);

    $resource = new BeanResource('api/timetbwork', 'TimetableWorkC.php');
    $resource->viewApi();
    array_push($this->list_pages, $resource);
    
    //TODO : Free
    $resource = new BeanResource('api', 'free/blank/blank.html');
    $resource->viewFree();
    array_push($this->list_pages, $resource);

    $resource = new BeanResource('login', 'free/login/login.html');
    $resource->viewFree();
    array_push($this->list_pages, $resource);
    
    //TODO : MANTENIMIENTOS
    $resource = new BeanResource('upkeeps', 'upkeeps/upkeeps.html');
    array_push($this->list_pages, $resource);

    $resource = new BeanResource('upkeeps/employee', 'upkeeps/employee/employee.html', array($this->path_resource . 'upkeeps/employee/employee.js'));
    array_push($this->list_pages, $resource);
    $resource = new BeanResource('upkeeps/manager', 'upkeeps/manager/manager.html', array($this->path_resource . 'upkeeps/manager/manager.js'));
    array_push($this->list_pages, $resource);
    $resource = new BeanResource('upkeeps/tmtbemployee', 'upkeeps/tmtbemployee/tmtbemployee.html', array($this->path_resource . 'upkeeps/tmtbemployee/tmtbemployee.js'));
    array_push($this->list_pages, $resource);
    $resource = new BeanResource('upkeeps/tmtbweekly', 'upkeeps/tmtbweekly/tmtbweekly.html', array($this->path_resource . 'upkeeps/tmtbweekly/tmtbweekly.js'));
    array_push($this->list_pages, $resource);
    $resource = new BeanResource('upkeeps/tmtbwork', 'upkeeps/tmtbwork/tmtbwork.html', array($this->path_resource . 'upkeeps/tmtbwork/tmtbwork.js'));
    array_push($this->list_pages, $resource);


    //TODO : HORARIOS
    $resource = new BeanResource('process', 'process/process.html');
    array_push($this->list_pages, $resource);

    $resource = new BeanResource('process/employee', 'process/employee/employee.html', array($this->path_resource . 'process/employee/employee.js',$this->path_resource . 'process/employee/tmtbemployee.js'));
    array_push($this->list_pages, $resource);

    $resource = new BeanResource('process/tmtbweekly', 'process/tmtbweekly/tmtbweekly.html', array($this->path_resource . 'process/tmtbweekly/tmtbweekly.js',$this->path_resource . 'process/tmtbweekly/tmtbwork.js',$this->path_resource . 'process/tmtbweekly/employee.js',$this->path_resource . 'process/tmtbweekly/tmtbemployee.js'));
    array_push($this->list_pages, $resource);

    $resource = new BeanResource('process/tmtbvalid', 'process/tmtbvalid/tmtbvalid.html', array($this->path_resource . 'process/tmtbvalid/tmtbweekly.js',$this->path_resource . 'process/tmtbvalid/tmtbwork.js',$this->path_resource . 'process/tmtbvalid/employee.js'));
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
        $this->path_resource .= 'free/error/404.html';
        $view='free';
      }
    } else {
      $this->path_resource .= 'free/error/404.html';
      $view='free';
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
