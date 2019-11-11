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
    public function findUsersByTerm($term){
        $session = new Session;
        if(!$session->is_logged_in()){
            header("Location: ?c=users&m=login");
        }

        $this->model = new User();
        $users = $this->model->findUsersByTerm($term);
        $data = [
            'searchTerm'=> $term,
            'users'=>$users
        ];

        $this->view('users/index', $data);
    }
    public function login(){
        $this->view('users/auth/login', []);
    }

    public function logout(){
        $session  = new Session();
        $session->logout();
        $this->view('users/auth/login',[]);
    }
    public function auth(){
        $this->model = new User();
        if(isset($_POST['email']) && isset($_POST['password'])){
            $res =  $this->model->auth(['email'=>trim($_POST['email']), 'password'=>trim($_POST['password'])]);
            if(empty($res)){

                $data = [
                    'loginError'=>'Neispravni podaci',
                    'email'=> $_POST['email'],
                    'password'=> $_POST['password']
                ];
                $this->view('users/auth/login',$data);
            }else{
                $session = new Session();
                $session->login($res[0]);
                $this->view('home/index',[]);
            }
        }else{
            $this->view('users/auth/login',[]);
        }
    }

    public function registerUser(){
        $this->model = new User();
        $data = [
            'registerError'=> '',
            'creds'=>$_POST
        ];
        if(
            (isset($_POST['email']) && !empty($_POST['email'])) &&
            (isset($_POST['password']) && !empty($_POST['password'])) &&
            (isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])) &&
            (isset($_POST['first_name']) && !empty($_POST['first_name'])) &&
            (isset($_POST['last_name']) && !empty($_POST['last_name']))
        ){

            if($_POST['password'] !== $_POST['confirm_password']){
                $data['registerError'] = 'Lozinke se ne podudaraju';
                $this->view('users/auth/register',$data);
            }
            $creds = [
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'first_name'=>trim($_POST['first_name']),
                'last_name'=>trim($_POST['last_name']),
            ];
            $this->model->email = $creds['email'];
            $this->model->password = $creds['password'];
            $this->model->first_name = $creds['first_name'];
            $this->model->last_name = $creds['last_name'];
            $create = $this->model->create();

            if($create){
                $user = $this->model->findWhere("email = '". $creds['email'] ."';");
                $session = new Session();

                $session->login($user[0]);
                $this->view('home/index',[]);
                return;

            }else{

                $data['registerError'] = "GRESKA";
                $this->view('users/auth/register',$data);
            }
            if(empty($res)){

                $data = [
                    'loginError'=>'Neispravni podaci',
                    'email'=> $_POST['email'],
                    'password'=> $_POST['password']
                ];
                $this->view('users/auth/login',$data);
            }else{
                $session = new Session();
                $session->login($res[0]);
                $this->view('home/index',[]);
            }
        }else{
            print_r($_POST);
            $data['registerError'] = "Sva polja su obavezna";
            $this->view('users/auth/register',$data);
        }
    }
    public function register(){
        $this->view('users/auth/register',[]);

    }

}