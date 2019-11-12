<?php


namespace App\utils;


use App\model\ActiveRecord;

class CustomValidation extends ActiveRecord
{
    public $rules;
    public $error = [];
    public $displayNames;

    public function __construct($model)
    {

        parent::__construct($model::$tableName);
    }

    public function setError($msg){
        $this->error[] = $msg;
    }

    protected function getDisplayName($field){
        return isset($this->displayNames[$field]) ? $this->displayNames[$field] : $field;
    }
    protected function required($key,$value){
       if($value == ''|| empty($value )){
           $this->setError("Polje '".$this->getDisplayName($key)."' je obavezno! <br>" );
       }
    }
    protected function unique($key, $value){
        $res = $this->findWhere("{$key} = '{$value}';");
        if($res){
            $this->setError("Polje '".$this->getDisplayName($key)."' vec postoji u bazi. <br>");
        }
    }

    protected function min($min, $key, $value){
        if(strlen($value) < $min){
            $this->setError("Polje '".$this->getDisplayName($key)."' mora sadrzati minimalno $min karaktera! <br>" );
        }
    }
    protected function max($max, $key, $value){
        if(strlen($value) > $max){
            $this->setError("Polje '".$this->getDisplayName($key)."' mora sadrzati maksimalno $max karaktera! <br>" );
        }
    }

    protected function confirm_password($key, $value){
        $password = $_POST['password'];
        if($password !== $value){
            $this->setError("Polje '".$this->getDisplayName($key)."' i polje '".$this->getDisplayName('password')."' se moraju podudarati  <br>" );
        }


    }


    public function validateRequest($request){
        foreach($request as $key => $value){
            if(isset($this->rules[$key])){

                $rules = explode('|',$this->rules[$key]);

                foreach ($rules as $rule){

                    if(stripos($rule,':')){ //example min:4
                        $arr = explode(':',$rule);
                        $method = $arr[0];
                        $param = $arr[1];
                        if(method_exists($this, $method)){
                            $this->$method($param,$key,$value);
                        }
                    }else{
                        if(method_exists($this, $rule)){
                            $this->$rule($key,$value);
                        }
                    }

                }
            }
        }
        return $this->error;
    }

}