<?php

class ProductsController
{

    static public function showProducts($item, $value)
    {
        $table = "mp_products";
        $answer = ProductsModel::showProducts($table, $item, $value);

        return $answer;
    }

    static public function createProducts()
    {

        if (isset($_POST["newDescription"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newDescription"]) &&
                preg_match('/^[0-9]+$/', $_POST["newStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["newBuyingPrice"]) &&
                preg_match('/^[0-9.]+$/', $_POST["newSellingPrice"])
            ) {

                $route = "views/dist/img/boxed-bg.png";

                if (isset($_FILES["newProdPhoto"]["tmp_name"])) {
                    list($width, $height) = getimagesize($_FILES["newProdPhoto"]["tmp_name"]);

                    $newWidth = 500;
                    $newHeight = 500;

                    $folder = "views/uploads/images/products/" . $_POST["newCode"];

                    mkdir($folder, 0755, true);

                    if ($_FILES["newProdPhoto"]["type"] == "image/jpeg") {
                        $random = mt_rand(100, 999);
                        $route = "views/uploads/images/products/" . $_POST["newCode"] . "/" . $random . ".jpg";
                        $origin = imagecreatefromjpeg($_FILES["newProdPhoto"]["tmp_name"]);
                        $destiny = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                        imagejpeg($destiny, $route);
                    }

                    if ($_FILES["newProdPhoto"]["type"] == "image/png") {
                        $random = mt_rand(100, 999);
                        $route = "views/uploads/images/products/" . $_POST["newCode"] . "/" . $random . ".png";
                        $origin = imagecreatefrompng($_FILES["newProdPhoto"]["tmp_name"]);
                        $destiny = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                        imagepng($destiny, $route);
                    }
                }

                $table = "mp_products";

                $data = array(
                    "idCategory" => $_POST["newCategory"],
                    "code" => $_POST["newCode"],
                    "description" => $_POST["newDescription"],
                    "stock" => $_POST["newStock"],
                    "buyingPrice" => $_POST["newBuyingPrice"],
                    "sellingPrice" => $_POST["newSellingPrice"],
                    "image" => $route
                );

                $answer = ProductsModel::addProduct($table, $data);

                if ($answer == "ok") {
                    echo '<script>
						Swal.fire({
							  type: "success",
							  title: "Product has been successfully saved.",
							  showConfirmButton: true,
							  confirmButtonText: "Close"
							  }).then(function(result){
										if (result.value) {
										window.location = "products";
										}
									})
						</script>';
                }
            } else {
                echo '<script>
					Swal.fire({
						  type: "error",
						  title: "The Product cannot have empty fields or have special characters!",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {
							window.location = "products";
							}
						})
			  	</script>';
            }
        }
    }

    static public function editProduct()
    {
        if (isset($_POST["editDescription"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editDescription"]) &&
                preg_match('/^[0-9]+$/', $_POST["editStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editBuyingPrice"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editSellingPrice"])
            ) {
                $route = $_POST["currentImage"];

                if (isset($_FILES["editImage"]["tmp_name"]) && !empty($_FILES["editImage"]["tmp_name"])) {
                    list($width, $height) = getimagesize($_FILES["editImage"]["tmp_name"]);

                    $newWidth = 500;
                    $newHeight = 500;

                    $folder = "views/uploads/images/products/" . $_POST["editCode"];

                    if (!empty($_POST["currentImage"]) && $_POST["currentImage"] != "views/dist/img/boxed-bg.png") {
                        unlink($_POST["currentImage"]);
                    } else {
                        mkdir($folder, 0755, true);
                    }

                    if ($_FILES["editImage"]["type"] == "image/jpeg") {
                        $random = mt_rand(100, 999);
                        $route = "views/uploads/images/products/" . $_POST["editCode"] . "/" . $random . ".jpg";
                        $origin = imagecreatefromjpeg($_FILES["editImage"]["tmp_name"]);
                        $destiny = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                        imagejpeg($destiny, $route);
                    }

                    if ($_FILES["editImage"]["type"] == "image/png") {
                        $random = mt_rand(100, 999);
                        $route = "views/uploads/images/products/" . $_POST["editCode"] . "/" . $random . ".png";
                        $origin = imagecreatefrompng($_FILES["editImage"]["tmp_name"]);
                        $destiny = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                        imagepng($destiny, $route);
                    }
                }

                $table = "mp_products";

                $data = array(
                    "idCategory" => $_POST["editCategory"],
                    "code" => $_POST["editCode"],
                    "description" => $_POST["editDescription"],
                    "stock" => $_POST["editStock"],
                    "buyingPrice" => $_POST["editBuyingPrice"],
                    "sellingPrice" => $_POST["editSellingPrice"],
                    "image" => $route
                );

                $answer = ProductsModel::editProduct($table, $data);

                if ($answer == "ok") {
                    echo '<script>
						Swal.fire({
							  type: "success",
							  title: "The product has been edited",
							  showConfirmButton: true,
							  confirmButtonText: "Close"
							  }).then(function(result){
										if (result.value) {
										window.location = "products";
										}
									})
						</script>';
                }
            } else {

                echo '<script>
					Swal.fire({
						  type: "error",
						  title: "The Product cannot be empty or have special characters!",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {
							window.location = "products";
							}
						})
			  	</script>';
            }
        }
    }

    static public function deleteProduct()
    {

        if (isset($_GET["idProduct"])) {

            $table = "mp_products";
            $datum = $_GET["idProduct"];

            if ($_GET["image"] != "" && $_GET["image"] != "views/dist/img/boxed-bg.png") {

                unlink($_GET["image"]);
                rmdir('views/uploads/images/products/' . $_GET["code"]);
            }

            $answer = ProductsModel::deleteProduct($table, $datum);

            if ($answer == "ok") {
                echo '<script>
				Swal.fire({
					  type: "success",
					  title: "The Product has been successfully deleted",
					  showConfirmButton: true,
					  confirmButtonText: "Close"
					  }).then(function(result){
								if (result.value) {
								window.location = "products";
								}
							})
				</script>';
            }
        }
    }
}
