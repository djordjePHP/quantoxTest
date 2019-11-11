<?php
require_once "bootstrap.php";

if(!isset($_GET['c']) && !isset($_GET['m'])){
    $controllerName ='IndexController';
    $method = 'index';
}else{
    $controllerName =ucfirst( $_GET['c'].'Controller');
    $method = $_GET['m'];
}


$controllerNamespace = 'App\\controller\\'.$controllerName;

$controller = new $controllerNamespace();

$controller->$method();

