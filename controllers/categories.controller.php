<?php
class CategoriesController {
    static public function createCategory() {
        if(isset($_POST['newCategory'])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newCategory"])){
				$table = 'mp_categories';
				$data = $_POST['newCategory'];

				$answer = CategoriesModel::addCategory($table, $data);

				if($answer == 'ok'){
					echo '<script>						
						Swal.fire({
							type: "success",
							title: "Category has been successfully saved",
							showConfirmButton: true,
							confirmButtonText: "Close"
							}).then(function(result){
								if (result.value) {
									window.location = "categories";
								}
							});						
					</script>';
				}
			}else{
				echo '<script>					
						Swal.fire({
							type: "error",
							title: "No especial characters or blank fields",
							showConfirmButton: true,
							confirmButtonText: "Close"				
							 }).then(function(result){
								if (result.value) {
									window.location = "categories";
								}
							});						
				</script>';				
			}
		}
    }

	static public function showCategories($item, $value){
		$table = "mp_categories";
		$answer = CategoriesModel::showCategories($table, $item, $value);

		return $answer;
	}

	static public function editCategory(){
		if(isset($_POST["editCategory"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editCategory"])){
				$table = "mp_categories";

				$data = array("category"=>$_POST["editCategory"],
							   "id"=>$_POST["idCategory"]);

				$answer = CategoriesModel::editCategory($table, $data);

				if($answer == "ok"){
					echo'<script>
					Swal.fire({
						  type: "success",
						  title: "Category has been successfully saved ",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
									if (result.value) {
									window.location = "categories";
									}
								})
					</script>';
				}
			}else{
				echo'<script>
					Swal.fire({
						  type: "error",
						  title: "No especial characters or blank fields",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {
							window.location = "categories";
							}
						})
			  	</script>';
			}
		}
	}
}