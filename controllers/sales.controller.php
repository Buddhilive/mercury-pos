<?php

class SalesController
{
    static public function showSales($item, $value)
    {
        $table = "mp_sales";
        $answer = SalesModel::showSales($table, $item, $value);

        return $answer;
    }

    static public function createSale()
    {
        if (isset($_POST["newSale"])) {
            $productsList = json_decode($_POST["productsList"], true);

            $totalPurchasedProducts = array();

            foreach ($productsList as $key => $value) {
                array_push($totalPurchasedProducts, $value["quantity"]);

                $tableProducts = "mp_products";

                $item = "id";
                $valueProductId = $value["id"];
                $order = "id";

                $getProduct = ProductsModel::showProducts($tableProducts, $item, $valueProductId, $order);

                $item1a = "sales";
                $value1a = $value["quantity"] + $getProduct["sales"];

                $newSales = ProductsModel::updateProduct($tableProducts, $item1a, $value1a, $valueProductId);

                $item1b = "stock";
                $value1b = $value["stock"];

                $newStock = ProductsModel::updateProduct($tableProducts, $item1b, $value1b, $valueProductId);
            }

            $tableCustomers = "mp_customers";

            $item = "id";
            $valueCustomer = $_POST["selectCustomer"];

            $getCustomer = CustomersModel::showCustomers($tableCustomers, $item, $valueCustomer);

            $item1a = "mp_purchases";
            $value1a = array_sum($totalPurchasedProducts) + $getCustomer["purchases"];

            $customerPurchases = CustomersModel::updateCustomer($tableCustomers, $item1a, $value1a, $valueCustomer);

            $item1b = "lastPurchase";

            date_default_timezone_set('Asia/Colombo');

            $date = date('Y-m-d');
            $hour = date('H:i:s');
            $value1b = $date . ' ' . $hour;

            $dateCustomer = CustomersModel::updateCustomer($tableCustomers, $item1b, $value1b, $valueCustomer);

            $table = "mp_sales";

            $data = array(
                "idSeller" => $_POST["idSeller"],
                "idCustomer" => $_POST["selectCustomer"],
                "code" => $_POST["newSale"],
                "products" => $_POST["productsList"],
                "tax" => $_POST["newTaxPrice"],
                "netPrice" => $_POST["newNetPrice"],
                "totalPrice" => $_POST["saleTotal"],
                "paymentMethod" => $_POST["listPaymentMethod"]
            );

            $answer = SalesModel::addSale($table, $data);

            if ($answer == "ok") {
                echo '<script>
				localStorage.removeItem("range");
				Swal.fire({
					  type: "success",
					  title: "The sale has been succesfully added",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {
								window.location = "sales";
								}
							});
				</script>';
            }
        }
    }

    static public function editSale()
    {
        if (isset($_POST["editSale"])) {
            $table = "mp_sales";

            $item = "code";
            $value = $_POST["editSale"];

            $getSale = SalesModel::showSales($table, $item, $value);

            if ($_POST["productsList"] == "") {
                $productsList = $getSale["products"];
                $productChange = false;
            } else {
                $productsList = $_POST["productsList"];
                $productChange = true;
            }

            if ($productChange) {
                $products =  json_decode($getSale["products"], true);

                $totalPurchasedProducts = array();

                foreach ($products as $key => $value) {
                    array_push($totalPurchasedProducts, $value["quantity"]);

                    $tableProducts = "mp_products";

                    $item = "id";
                    $value1 = $value["id"];
                    $order = "id";

                    $getProduct = ProductsModel::showProducts($tableProducts, $item, $value1, $order);

                    $item1a = "sales";
                    $value1a = $getProduct["sales"] - $value["quantity"];

                    $newSales = ProductsModel::updateProduct($tableProducts, $item1a, $value1a, $value);

                    $item1b = "stock";
                    $value1b = $value["quantity"] + $getProduct["stock"];

                    $stockNew = ProductsModel::updateProduct($tableProducts, $item1b, $value1b, $value);
                }

                $tableCustomers = "mp_customers";

                $itemCustomer = "id";
                $valueCustomer = $_POST["selectCustomer"];

                $getCustomer = CustomersModel::showCustomers($tableCustomers, $itemCustomer, $valueCustomer);

                $item1a = "purchases";
                $value1a = $getCustomer["purchases"] - array_sum($totalPurchasedProducts);

                $customerPurchases = CustomersModel::updateCustomer($tableCustomers, $item1a, $value1a, $valueCustomer);

                $productsList_2 = json_decode($productsList, true);

                $totalPurchasedProducts_2 = array();

                foreach ($productsList_2 as $key => $value) {
                    array_push($totalPurchasedProducts_2, $value["quantity"]);

                    $tableProducts_2 = "mp_products";

                    $item_2 = "id";
                    $value_2 = $value["id"];
                    $order = "id";

                    $getProduct_2 = ProductsModel::showProducts($tableProducts_2, $item_2, $value_2, $order);

                    $item1a_2 = "sales";
                    $value1a_2 = $value["quantity"] + $getProduct_2["sales"];

                    $newSales_2 = ProductsModel::updateProduct($tableProducts_2, $item1a_2, $value1a_2, $value_2);

                    $item1b_2 = "stock";
                    $value1b_2 = $getProduct_2["stock"] - $value["quantity"];

                    $newStock_2 = ProductsModel::updateProduct($tableProducts_2, $item1b_2, $value1b_2, $value_2);
                }

                $tableCustomers_2 = "mp_customers";
                $item_2 = "id";
                $value_2 = $_POST["selectCustomer"];

                $getCustomer_2 = CustomersModel::showCustomers($tableCustomers_2, $item_2, $value_2);

                $item1a_2 = "purchases";
                $value1a_2 = array_sum($totalPurchasedProducts_2) + $getCustomer_2["purchases"];

                $customerPurchases_2 = CustomersModel::updateCustomer($tableCustomers_2, $item1a_2, $value1a_2, $value_2);

                $item1b_2 = "lastPurchase";

                date_default_timezone_set('America/Bogota');

                $date = date('Y-m-d');
                $hour = date('H:i:s');
                $value1b_2 = $date . ' ' . $hour;

                $dateCustomer_2 = CustomersModel::updateCustomer($tableCustomers_2, $item1b_2, $value1b_2, $value_2);
            }

            $data = array(
                "idSeller" => $_POST["idSeller"],
                "idCustomer" => $_POST["selectCustomer"],
                "code" => $_POST["editSale"],
                "products" => $productsList,
                "tax" => $_POST["newTaxPrice"],
                "netPrice" => $_POST["newNetPrice"],
                "totalPrice" => $_POST["saleTotal"],
                "paymentMethod" => $_POST["listPaymentMethod"]
            );

            $answer = SalesModel::editSale($table, $data);

            if ($answer == "ok") {
                echo '<script>
				localStorage.removeItem("range");
				Swal.fire({
					  type: "success",
					  title: "The sale has been edited correctly",
					  showConfirmButton: true,
					  confirmButtonText: "Close"
					  }).then((result) => {
								if (result.value) {
								window.location = "sales";
								}
							});
				</script>';
            }
        }
    }

    static public function deleteSale()
    {
        if (isset($_GET["idSale"])) {
            $table = "mp_sales";

            $item = "id";
            $value = $_GET["idSale"];

            $getSale = SalesModel::showSales($table, $item, $value);

            $tableCustomers = "mp_customers";

            $itemsales = null;
            $valuesales = null;

            $getSales = SalesModel::showSales($table, $itemsales, $valuesales);

            $saveDates = array();

            foreach ($getSales as $key => $value) {
                if ($value["idCustomer"] == $getSale["idCustomer"]) {
                    array_push($saveDates, $value["saledate"]);
                }
            }

            if (count($saveDates) > 1) {

                if ($getSale["saledate"] > $saveDates[count($saveDates) - 2]) {
                    $item = "lastPurchase";
                    $value = $saveDates[count($saveDates) - 2];
                    $valueIdCustomer = $getSale["idCustomer"];

                    $customerPurchases = CustomersModel::updateCustomer($tableCustomers, $item, $value, $valueIdCustomer);
                } else {
                    $item = "lastPurchase";
                    $value = $saveDates[count($saveDates) - 1];
                    $valueIdCustomer = $getSale["idCustomer"];

                    $customerPurchases = CustomersModel::updateCustomer($tableCustomers, $item, $value, $valueIdCustomer);
                }
            } else {
                $item = "lastPurchase";
                $value = "0000-00-00 00:00:00";
                $valueIdCustomer = $getSale["idCustomer"];

                $customerPurchases = CustomersModel::updateCustomer($tableCustomers, $item, $value, $valueIdCustomer);
            }

            $products =  json_decode($getSale["products"], true);

            $totalPurchasedProducts = array();

            foreach ($products as $key => $value) {
                array_push($totalPurchasedProducts, $value["quantity"]);

                $tableProducts = "mp_products";

                $item = "id";
                $valueProductId = $value["id"];
                $order = "id";

                $getProduct = ProductsModel::showProducts($tableProducts, $item, $valueProductId, $order);

                $item1a = "sales";
                $value1a = $getProduct["sales"] - $value["quantity"];

                $newSales = ProductsModel::updateProduct($tableProducts, $item1a, $value1a, $valueProductId);

                $item1b = "stock";
                $value1b = $value["quantity"] + $getProduct["stock"];

                $stockNew = ProductsModel::updateProduct($tableProducts, $item1b, $value1b, $valueProductId);
            }

            $tableCustomers = "mp_customers";
            $itemCustomer = "id";
            $valueCustomer = $getSale["idCustomer"];
            $getCustomer = CustomersModel::showCustomers($tableCustomers, $itemCustomer, $valueCustomer);

            $item1a = "purchases";
            $value1a = $getCustomer["purchases"] - array_sum($totalPurchasedProducts);
            $customerPurchases = CustomersModel::updateCustomer($tableCustomers, $item1a, $value1a, $valueCustomer);

            $answer = SalesModel::deleteSale($table, $_GET["idSale"]);

            if ($answer == "ok") {
                echo '<script>
				Swal.fire({
					  type: "success",
					  title: "The sale has been deleted succesfully",
					  showConfirmButton: true,
					  confirmButtonText: "Close",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {
								window.location = "sales";
								}
							});
				</script>';
            }
        }
    }

    static public function salesDatesRange($initialDate, $finalDate)
    {
        $table = "mp_sales";
        $answer = SalesModel::salesDatesRange($table, $initialDate, $finalDate);

        return $answer;
    }

    public function downloadReport()
    {
        if (isset($_GET["report"])) {
            $table = "mp_sales";

            if (isset($_GET["initialDate"]) && isset($_GET["finalDate"])) {
                $sales = SalesModel::salesDatesRange($table, $_GET["initialDate"], $_GET["finalDate"]);
            } else {
                $item = null;
                $value = null;

                $sales = SalesModel::showSales($table, $item, $value);
            }

            $name = $_GET["report"] . '.xls';

            header('Expires: 0');
            header('Cache-control: private');
            header("Content-type: application/vnd.ms-excel"); // Excel file
            header("Cache-Control: cache, must-revalidate");
            header('Content-Description: File Transfer');
            header('Last-Modified: ' . date('D, d M Y H:i:s'));
            header("Pragma: public");
            header('Content-Disposition:; filename="' . $name . '"');
            header("Content-Transfer-Encoding: binary");

            echo mb_convert_encoding("<table border='0'> 
					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>Invoice_ID</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>Customer</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Seller</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Quantity</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Products</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Tax</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Net_Price</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>Payment_Method</td	
					<td style='font-weight:bold; border:1px solid #eee;'>Date</td>		
					</tr>", 'ISO-8859-1', 'UTF-8');

            foreach ($sales as $row => $item) {

                $customer = CustomersController::showCustomers("id", $item["idCustomer"]);
                $vendedor = UserController::getAllUsers("id", $item["idSeller"]);

                echo mb_convert_encoding("<tr>
			 			<td style='border:1px solid #eee;'>" . $item["code"] . "</td> 
			 			<td style='border:1px solid #eee;'>" . $customer["name"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $vendedor["name"] . "</td>
			 			<td style='border:1px solid #eee;'>", 'ISO-8859-1', 'UTF-8');

                $products =  json_decode($item["products"], true);

                foreach ($products as $key => $valueproducts) {

                    echo mb_convert_encoding($valueproducts["quantity"] . "<br>", 'ISO-8859-1', 'UTF-8');
                }

                echo mb_convert_encoding("</td><td style='border:1px solid #eee;'>", 'ISO-8859-1', 'UTF-8');

                foreach ($products as $key => $valueproducts) {

                    echo mb_convert_encoding($valueproducts["description"] . "<br>", 'ISO-8859-1', 'UTF-8');
                }

                echo mb_convert_encoding("</td>
					<td style='border:1px solid #eee;'>$ " . number_format($item["tax"], 2) . "</td>
					<td style='border:1px solid #eee;'>$ " . number_format($item["netPrice"], 2) . "</td>	
					<td style='border:1px solid #eee;'>$ " . number_format($item["totalPrice"], 2) . "</td>
					<td style='border:1px solid #eee;'>" . $item["paymentMethod"] . "</td>
					<td style='border:1px solid #eee;'>" . substr($item["saledate"], 0, 10) . "</td>		
		 			</tr>", 'ISO-8859-1', 'UTF-8');
            }

            echo "</table>";
        }
    }

    public function addingTotalSales()
    {
        $table = "mp_sales";
        $answer = SalesModel::addingTotalSales($table);

        return $answer;
    }
}
