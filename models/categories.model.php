<?php
require_once "connection.php";

class CategoriesModel
{

    static public function addCategory($table, $data)
    {

        $stmt = Connection::connect()->prepare("INSERT INTO $table (category) VALUES (:category)");
        $stmt->bindParam(":category", $data, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }

        $stmt = null;
    }

    static public function showCategories($table, $item, $value){
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
        
		$stmt = null;
	}
}
