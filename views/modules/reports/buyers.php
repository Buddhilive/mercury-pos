<?php

$item = null;
$value = null;

$sales = SalesController::showSales($item, $value);
$Customers = CustomersController::showCustomers($item, $value);
$arrayCustomers = array();
$arrayCustomersList = array();

foreach ($sales as $key => $valueSales) {
    foreach ($Customers as $key => $valueCustomers) {
        if ($valueCustomers["id"] == $valueSales["idCustomer"]) {
            array_push($arrayCustomers, $valueCustomers["name"]);
            $arrayCustomersList = array($valueCustomers["name"] => $valueSales["netPrice"]);

            foreach ($arrayCustomersList as $key => $value) {
                $addingTotalSales[$key] += $value;
            }
        }
    }
}

$dontrepeatnames = array_unique($arrayCustomers);
?>

<div class="card">
    <div class="card-header">Best Buyers</div>
    <div class="card-body">
        <div class="chart-responsive">
            <div class="chart" id="bar-chart2" style="height: 300px;"></div>
        </div>
    </div>
</div>

<script>
    var bar = new Morris.Bar({
        element: 'bar-chart2',
        resize: true,
        data: [
            <?php
            foreach ($dontrepeatnames as $value) {
                echo "{y: '" . $value . "', a: '" . $addingTotalSales[$value] . "'},";
            }
            ?>
        ],
        barColors: ['#f6a'],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['sales'],
        preUnits: '$',
        hideHover: 'auto'
    });
</script>