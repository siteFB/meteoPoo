<?php

require_once('../../libraries/models/model.php');

class Connexion extends Model{

    protected $table ='users';
    protected $chooseFetch = 'fetch';
    protected $return = '$user';
}