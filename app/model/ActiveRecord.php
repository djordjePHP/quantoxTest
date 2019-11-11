<?php namespace App\model;

use App\db\Connection;
use PDO;
class ActiveRecord extends Connection
{

    public static $tableName;
    public static $db;

    public function __construct($tableName){
        self::$tableName = $tableName;
        self::$db = self::connect();
        self::$db->exec("set names utf8");
    }



    public function create(){
        $thisObjVars = get_object_vars($this);
        $q = self::$db->prepare("DESCRIBE ".self::$tableName);
        $q->execute();
        $table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
        foreach($thisObjVars as $key => $val){
            if(!in_array($key,$table_fields)) return false;
        }

        $keys = implode(',',array_keys($thisObjVars));
        $values = "";
        foreach($thisObjVars as $key => $val){
            $values .= "'$val',";
        }
        $q =  self::$db->prepare("INSERT INTO ".self::$tableName." ($keys) VALUES ($values)");
        $result = $q->execute();
        $result;
    }

    public function read($id = null){
        if(!$id){
            $query = "SELECT * FROM ".self::$tableName.";";
        }else{
            $query = "SELECT * FROM ".self::$tableName." WHERE id =".$id.";";
        }

        $preparedQ = self::$db->prepare($query);
        $preparedQ->execute();
        $results = $preparedQ->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    public function update(){

    }
    public function delete($id){

        $prep = self::$db->prepare("DELETE FROM " . self::$tableName . " WHERE id = " . $id . ";");
        $prep->execute();
        if ($prep->rowCount() > 0) {
            return true;
        } else {
            return $prep->errorInfo();
        }
    }


}