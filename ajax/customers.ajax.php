<?php

require_once "../controllers/customers.controller.php";
require_once "../models/customers.model.php";

class AjaxCustomers{
	public $idCustomer;

	public function ajaxEditCustomer(){
		$item = "id";
		$value = $this->idCustomer;

		$answer = CustomersController::showCustomers($item, $value);

		echo json_encode($answer);
	}
}

if(isset($_POST["idCustomer"])){
	$Customer = new AjaxCustomers();
	$Customer -> idCustomer = $_POST["idCustomer"];
	$Customer -> ajaxEditCustomer();
}
