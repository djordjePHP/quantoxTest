<?php

namespace App\controller;


class IndexController extends BaseController
{
    public function index(){
        return $this->view('home/index', []);
    }
}