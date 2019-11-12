<?php


namespace App\controller;


use App\model\User;
use App\utils\Session;

class UsersController extends BaseController
{

    public function index(){
        $this->model = new User();
        $users = $this->model->read();
        $this->view('users/index', $users);
    }
    public function findUsersByTerm(){
        $searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

        $session = new Session;
        if(!$session->is_logged_in()){
            header("Location: ?c=users&m=login");
        }

        $this->model = new User();
        $users = $this->model->findUsersByTerm($searchTerm);
        $data = [
            'searchTerm'=> $searchTerm,
            'users'=>$users
        ];

        $this->view('home/index', $data);
    }

}