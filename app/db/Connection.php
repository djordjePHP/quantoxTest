<?php namespace App\db;

use PDO;

class Connection
{
    private static $conn = null;

    public static function connect()
    {
        if (!self::$conn) {
            self::$conn = new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME . '', '' . DBUSER . '', '' . DBPASS . '',array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));
        }
        return self::$conn;
    }
}