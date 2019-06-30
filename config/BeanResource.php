<?php

class BeanResource
{
    public $path;
    public $path_resource;
    public $path_scripts;
    public $view;
    public function __construct($path, $path_resource, $path_scripts = array())
    {
        $this->path = $path;
        $this->path_resource = $path_resource;
        $this->path_scripts = $path_scripts;
        $this->view = 'view';
    }

    public function viewApi()
    {
        $this->view = 'api';
    }
    public function viewFree()
    {
        $this->view = 'free';
    }
}

