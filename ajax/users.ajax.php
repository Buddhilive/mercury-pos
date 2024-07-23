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

	/* ACTIVATE USER */
	public $activateUser;
	public $activateId;	

	public function ajaxActivateUser(){
		$table = "mp_users";
		$item1 = "status";
		$value1 = $this->activateUser;

		$item2 = "id";
		$value2 = $this->activateId;

		$answer = UsersModel::updateUser($table, $item1, $value1, $item2, $value2);
	}

	/* VALIDATE IF USER ALREADY EXISTS */
	public $validateUser;

	public function ajaxValidateUser(){
		$item = "username";
		$value = $this->validateUser;
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

/* Activate user */
if (isset($_POST["activateUser"])) {
	$activateUser = new AjaxUsers();
	$activateUser -> activateUser = $_POST["activateUser"];
	$activateUser -> activateId = $_POST["activateId"];
	$activateUser -> ajaxActivateUser();
}

/* Validate User */
if (isset($_POST["validateUser"])) {
	$valUser = new AjaxUsers();
	$valUser -> validateUser = $_POST["validateUser"];
	$valUser -> ajaxValidateUser();
}
