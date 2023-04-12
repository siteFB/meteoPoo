<?php

require_once('../../libraries/base/connexionBDD.php');

class Model{

    protected $db;

    public function __construct()
    {
        $this->db = getPdo();
    }
    
}