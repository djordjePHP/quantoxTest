<?php namespace App\controller;


class BaseController
{
    protected $model;

    protected function view($path, $data){
        extract($data);
        ob_start();
        include('app/view/base/header.php');
        include('app/view/'.$path.'.php');
        include('app/view/base/footer.php');
        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }

}