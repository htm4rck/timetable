<?php

class BeanResource
{
    public $path;
    public $path_resource;
    public $path_scripts;
    public function __construct($path, $path_resource, $path_scripts)
    {
        $this->path = $path;
        $this->path_resource = $path_resource;
        $this->path_scripts = $path_scripts;
    }
}