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
		$stmt = null;			
    }

	static public function addUser($table, $data){
		$stmt = Connection::connect()->prepare("INSERT INTO $table (name, username, password, profile, photo) VALUES (:name, :username, :password, :profile, :photo)");

		$stmt -> bindParam(":name", $data["name"], PDO::PARAM_STR);
		$stmt -> bindParam(":username", $data["user"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $data["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":profile", $data["profile"], PDO::PARAM_STR);
		$stmt -> bindParam(":photo", $data["photo"], PDO::PARAM_STR);

		if ($stmt->execute()) {			
			return 'ok';		
		} else {			
			return 'error';
		}

		$stmt = null;
	}
}
