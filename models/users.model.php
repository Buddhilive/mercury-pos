<?php
require_once "connection.php";
class UsersModel
{
    static public function showUsers($table, $item, $value)
    {
        if($item != null){
			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt -> fetch();

		}
		else{
			$stmt = Connection::connect()->prepare("SELECT * FROM $table");
			$stmt -> execute();

			return $stmt -> fetchAll();			
		}
    }
}
