<?php

require_once "../controllers/users.controller.php";
require_once "../models/users.model.php";

class AjaxUsers{
	public $idUser;

	public function ajaxEditUser(){
		$item = "id";
		$value = $this->idUser;

		$answer = UserController::getAllUsers($item, $value);

		echo json_encode($answer);
	}
}

/* Edit user */
if (isset($_POST["idUser"])) {
	$edit = new AjaxUsers();
	$edit -> idUser = $_POST["idUser"];
	$edit -> ajaxEditUser();
}
