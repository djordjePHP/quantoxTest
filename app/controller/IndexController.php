<?php

namespace App\controller;
use App\utils\Session;

class IndexController extends BaseController
{
    public function index(){
        $session = new Session;
        if($session->is_logged_in()){
            return $this->view('home/index', []);
        }else{
            header("Location: ?c=users&m=login");
        }
    }
}