<?php


namespace App\controller;


use App\model\User;
use App\utils\CustomValidation;
use App\utils\Session;

class AuthController extends BaseController
{

    public function login(){
        $this->model = new User();

        if(isset($_POST['email']) && isset($_POST['password'])){
            $res =  $this->model->auth(['email'=>trim($_POST['email']), 'password'=>trim($_POST['password'])]);
            if(empty($res)){

                $data = [
                    'errors'=>['Neispravni podaci'],
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


    public function logout(){
        $session  = new Session();
        $session->logout();
        $this->view('users/auth/login',[]);
    }

    public function register(){
        $this->model = new User();
        if(isset($_POST['user_registration'])){

            $validation = new CustomValidation($this->model);
            $validation->rules = [
                'email'=>'required|unique',
                'password'=>'required|min:8',
                'confirm_password'=>'required|confirm_password',
                'first_name'=>'required',
                'last_name'=>'required'
            ];
            $validation->displayNames = [
                'email'=>'Email',
                'password'=>'Lozinka',
                'confirm_password'=>'Potvrda lozinke',
                'first_name'=>'Ime',
                'last_name'=>'Prezime'
            ];


            $errors = $validation->validateRequest($_POST);
            if(!empty($errors)){
                $data = [
                    'errors' => $errors,
                    'inputValues' => $_POST
                ];
                $this->view('users/auth/register',$data);
                return;
            }

            $this->model->email = $_POST['email'];
            $this->model->password = $_POST['password'];
            $this->model->first_name = $_POST['first_name'];
            $this->model->last_name = $_POST['last_name'];
            $newUser = $this->model->create();

            $newUser = $newUser[0];
            $session = new Session();
            $session->login($newUser);

            $this->view('home/index',[]);
        }else{
            $this->view('users/auth/register',[]);
        }


    }

}