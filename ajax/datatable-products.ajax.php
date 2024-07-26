<?php

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

class ProductsTable
{
    public function showProductsTable()
    {
        $item = null;
        $value = null;

        $products = ProductsController::showProducts($item, $value);

        if (count($products) == 0) {
            $jsonData = '{"data":[]}';
            echo $jsonData;

            return;
        }

        $jsonData = '{
			"data":[';
        for ($i = 0; $i < count($products); $i++) {

            $image = "<img src='" . $products[$i]["image"] . "' width='40px'>";

            $item = "id";
            $value = $products[$i]["idCategory"];

            $categories = CategoriesController::showCategories($item, $value);

            if ($products[$i]["stock"] <= 10) {
                $stock = "<button class='btn btn-danger'>" . $products[$i]["stock"] . "</button>";
            } else if ($products[$i]["stock"] > 11 && $products[$i]["stock"] <= 15) {
                $stock = "<button class='btn btn-warning'>" . $products[$i]["stock"] . "</button>";
            } else {
                $stock = "<button class='btn btn-success'>" . $products[$i]["stock"] . "</button>";
            }

            $buttons =  "<div class='btn-group'><button class='btn btn-warning btnEditProduct' idProduct='" . $products[$i]["id"] . "' data-toggle='modal' data-target='#editProduct'><i class='fa fa-pencil-alt'></i></button><button class='btn btn-danger btnDeleteProduct' idProduct='" . $products[$i]["id"] . "' code='" . $products[$i]["code"] . "' image='" . $products[$i]["image"] . "'><i class='fa fa-times'></i></button></div>";

            $jsonData .= '[
						"' . ($i + 1) . '",
						"' . $image . '",
						"' . $products[$i]["code"] . '",
						"' . $products[$i]["description"] . '",
						"' . $categories["category"] . '",
						"' . $stock . '",
						"$ ' . $products[$i]["buyingPrice"] . '",
						"$ ' . $products[$i]["sellingPrice"] . '",
						"' . $products[$i]["date"] . '",
						"' . $buttons . '"
					],';
        }

        $jsonData = substr($jsonData, 0, -1);
        $jsonData .= '] 

			}';

        echo $jsonData;
    }
}

$activateProducts = new ProductsTable();
$activateProducts->showProductsTable();
