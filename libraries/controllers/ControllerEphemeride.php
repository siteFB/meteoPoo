<?php

namespace Controllers;

abstract class ControllerEphemeride{

    protected $model;
    protected $modelName;

    public function __construct()
    {
        $this->model = new $this->modelName();
    }
}