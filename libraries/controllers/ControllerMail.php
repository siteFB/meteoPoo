<?php

namespace Controllers;

abstract class ControllerMail {

    protected $model;
    protected $modelName;

    public function __construct()
    {
        $this->model = new $this->modelName();
    }
}