<?php

namespace app\core;

abstract class Controller
{
    public $route;
    public $view;
    public $acl;
    public $model;

    public function __construct($route)
    {
        $this->route = $route;
        if (!$this->checkAcl()) {
            View::errorCode(403);
        }
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel(string $name)
    {
        $path = 'app\models\\'.ucfirst($name);
        if (class_exists($path)) {
            return new $path();
        }
    }

    public function checkAcl(): bool
    {
        $this->acl = require 'config/acl/'.$this->route['controller'].'.php';
        if ($this->isAcl('all')) {
            return true;
        } elseif (isset($_SESSION['authorize']['id']) and $this->isAcl('authorize')) {
            return true;
        } elseif (!isset($_SESSION['authorize']['id']) and $this->isAcl('guest')) {
            return true;
        } elseif (isset($_SESSION['admin']) and $this->isAcl('admin')) {
            return true;
        }

        return false;
    }

    public function isAcl($key): bool
    {
        return \in_array($this->route['action'], $this->acl[$key], true);
    }
}
