<?php

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

class AjaxProducts{

	public $idCategory;

	public function ajaxCreateProductCode(){
		$item = "idCategory";
		$value = $this->idCategory;

		$answer = ProductsController::showProducts($item, $value, "id");

		echo json_encode($answer);
	}

  	public $idProduct;

  	public function ajaxEditProduct(){
	    $item = "id";
	    $value = $this->idProduct;

	    $answer = ProductsController::showProducts($item, $value, "id");

	    echo json_encode($answer);
  	}

}

if(isset($_POST["idCategory"])){
	$productCode = new AjaxProducts();
	$productCode -> idCategory = $_POST["idCategory"];
	$productCode -> ajaxCreateProductCode();
}

if(isset($_POST["idProduct"])){
  $editProduct = new AjaxProducts();
  $editProduct -> idProduct = $_POST["idProduct"];
  $editProduct -> ajaxEditProduct();
}
