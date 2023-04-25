<?php

namespace Models;

require_once('../../libraries/models/Model.php');

class Connexion extends Model{

    protected $table ='users';
    protected $chooseFetch = 'fetch';
    protected $return = '$user';
}