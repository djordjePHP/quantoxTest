<?php
require_once "bootstrap.php";
use  App\db\Connection;

$newCon = Connection::connect();

print_r($newCon);