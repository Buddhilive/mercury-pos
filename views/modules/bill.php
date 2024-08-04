<?php

require_once "../../controllers/sales.controller.php";
require_once "../../models/sales.model.php";
require_once "../../controllers/customers.controller.php";
require_once "../../models/customers.model.php";
require_once "../../controllers/users.controller.php";
require_once "../../models/users.model.php";
require_once "../../controllers/products.controller.php";
require_once "../../models/products.model.php";

class printBill
{
	public $code;

	public function getBillPrinting()
	{
		$itemSale = "code";
		$valueSale = $this->code;

		$answerSale = SalesController::showSales($itemSale, $valueSale);

		$saledate = substr($answerSale["saledate"], 0, -8);
		$products = json_decode($answerSale["products"], true);
		$netPrice = number_format($answerSale["netPrice"], 2);
		$tax = number_format($answerSale["tax"], 2);
		$billAmount = number_format($answerSale["totalPrice"], 2);

		$itemCustomer = "id";
		$valueCustomer = $answerSale["idCustomer"];

		$answerCustomer = CustomersController::showCustomers($itemCustomer, $valueCustomer);

		$itemSeller = "id";
		$valueSeller = $answerSale["idSeller"];

		$answerSeller = UserController::getAllUsers($itemSeller, $valueSeller);

		require_once '../../extensions/tcpdf/pdf/tcpdf_include.php';

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->startPageGroup();
		$pdf->AddPage();

		$block1 = <<<EOF
	<table>		
		<tr>			
			<td style="width:50px"><img src="../assets/logo.png"></td>
			<td style="background-color:white; width:140px">			
				<div style="font-size:8.5px; text-align:right; line-height:15px;">					
					<br>
					NIT: 71.759.963-9
					<br>
					ADDRESS: Calle 44B 92-11
				</div>
			</td>
			<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">					
					<br>
					CELLPHONE: 300 786 52 49					
					<br>
					sales@inventorysystem.com
				</div>				
			</td>
			<td style="background-color:white; width:110px; text-align:center; color:red">
				<br><br>
				BILL N.<br>$valueSale
			</td>
		</tr>
	</table>
EOF;

		$pdf->writeHTML($block1, false, false, false, false, '');

		$block2 = <<<EOF
	<table>		
		<tr>			
			<td style="width:540px"><img src="images/back.jpg"></td>		
		</tr>
	</table>
	<table style="font-size:10px; padding:5px 10px;">	
		<tr>		
			<td style="border: 1px solid #666; background-color:white; width:390px">
				Customer: $answerCustomer[name]
			</td>
			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">			
				Date: $saledate
			</td>
		</tr>
		<tr>		
			<td style="border: 1px solid #666; background-color:white; width:540px">Seller: $answerSeller[name]</td>
		</tr>
		<tr>		
			<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>
		</tr>
	</table>
EOF;

		$pdf->writeHTML($block2, false, false, false, false, '');

		$block3 = <<<EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>		
			<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Product</td>
			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">quantity</td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">value Unit.</td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">value Total</td>
		</tr>
	</table>
EOF;

		$pdf->writeHTML($block3, false, false, false, false, '');

		foreach ($products as $key => $item) {

			$itemProduct = "description";
			$valueProduct = $item["description"];
			$orden = null;

			$answerProduct = ProductsController::showProducts($itemProduct, $valueProduct, $orden);
			$valueUnit = number_format($answerProduct["sellingPrice"], 2);
			$totalPrice = number_format($item["totalPrice"], 2);

			$block4 = <<<EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				$item[description]
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:right">
				$item[quantity]
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">Rs. 
				$valueUnit
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">Rs.  
				$totalPrice
			</td>
		</tr>
	</table>
EOF;

			$pdf->writeHTML($block4, false, false, false, false, '');
		}

		$block5 = <<<EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>
			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>
		</tr>		
		<tr>	
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Net:
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">
				Rs. $netPrice
			</td>
		</tr>
		<tr>
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Tax:
			</td>		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">
				Rs. $tax
			</td>
		</tr>
		<tr>		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">
				Rs. $billAmount
			</td>
		</tr>
	</table>
EOF;

		$pdf->writeHTML($block5, false, false, false, false, '');
		$pdf->Output('bill.pdf', 'I');
	}
}

$bill = new printBill();
$bill->code = $_GET["code"];
$bill->getBillPrinting();
