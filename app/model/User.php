<?php


namespace App\model;


use PDO;

class User extends ActiveRecord
{
    public function __construct()
    {
        parent::__construct('users');
    }

    public function findUsersByTerm($term){
        $whereQ = "first_name LIKE '%".$term."%' OR last_name LIKE '%".$term."%' OR email LIKE '%".$term."%';";
        return $this->findWhere($whereQ);
    }
    public function auth($creds){
        $whereQ = " email = '". $creds['email'] . "' AND " . " password = PASSWORD('". $creds['password'] ."');";

        return $this->findWhere($whereQ);

    }
    public function register($creds){
        $whereQ = " email = '". $creds['email'] . "' AND " . " password = PASSWORD('". $creds['password'] ."');";

        return $this->findWhere($whereQ);

    }
}