<?php namespace App\utils;

class Session
{
    private $logged_in = false;
    public $user_id;
    public $user_fn;
    public $user_ln;
    public $user_email;

    public function __construct()
    {
        session_start();
        $this->check_login();

    }
    public function is_logged_in(){
        return $this->logged_in;
    }

    public function login($user){
        if($user){
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->user_fn = $_SESSION['user_fn'] = $user->first_name;
            $this->user_ln = $_SESSION['user_ln'] = $user->last_name;
            $this->user_email = $_SESSION['user_email'] = $user->email;
            $this->logged_in = true;
        }
    }

    public function logout(){
        unset($this->user_id);
        unset($this->user_fn);
        unset($this->user_ln);
        unset($this->user_email);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_fn']);
        unset($_SESSION['user_ln']);
        unset($_SESSION['user_email']);
        $this->logged_in = false;

    }
    private function check_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->user_fn = $_SESSION['user_fn'];
            $this->user_ln = $_SESSION['user_ln'];
            $this->logged_in = true;
            $this->user_email = $_SESSION['user_email'];
        }else{
            unset($this->user_id);
            unset($this->user_fn);
            unset($this->user_ln);
            unset($this->user_email);
            $this->logged_in = false;
        }
    }
}