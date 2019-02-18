<?php

class BeanResource {

  public $path;
  public $path_resource;

  public function __construct($path,$path_resource) {
    $this->path = $path;
    $this->path_resource = $path_resource;
  }
}