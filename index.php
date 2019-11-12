<?php
require_once "bootstrap.php";

if(isset($_GET['c']) && isset($_GET['m'])){
    $controllerName =ucfirst( $_GET['c'].'Controller');
    $method = $_GET['m'];
}else{
    $controllerName ='IndexController';
    $method = 'index';

}
$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : null;

$controllerNamespace = 'App\\controller\\'.$controllerName;

$controller = new $controllerNamespace();

$controller->$method();

