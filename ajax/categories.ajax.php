<?php
require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

class AjaxCategories{
	public $idCategory;

	public function ajaxEditCategory(){
		$item = "id";
		$valor = $this->idCategory;
		$answer = CategoriesController::showCategories($item, $valor);

		echo json_encode($answer);
	}
}

if(isset($_POST["idCategory"])){
	$category = new AjaxCategories();
	$category -> idCategory = $_POST["idCategory"];
	$category -> ajaxEditCategory();
}
