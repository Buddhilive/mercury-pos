<?php

$item = null;
$value = null;

$sales = SalesController::showSales($item, $value);
$users = UserController::getAllUsers($item, $value);

$arraySellers = array();
$arraySellersList = array();

foreach ($sales as $key => $valueSales) {
    foreach ($users as $key => $valueUsers) {
        if ($valueUsers["id"] == $valueSales["idSeller"]) {
            array_push($arraySellers, $valueUsers["name"]);
            $arraySellersList = array($valueUsers["name"] => $valueSales["netPrice"]);

            foreach ($arraySellersList as $key => $value) {
                $addingTotalSales[$key] += $value;
            }
        }
    }
}

$dontrepeatnames = array_unique($arraySellers);
?>

<div class="card">
    <div class="card-header">Best Sellers</div>
    <div class="card-body">
        <div class="chart-responsive">
        <div class="chart" id="bar-chart1" style="height: 300px;"></div>
        </div>
    </div>
</div>

<script>
    var bar = new Morris.Bar({
        element: 'bar-chart1',
        resize: true,
        data: [
            <?php
            foreach ($dontrepeatnames as $value) {
                echo "{y: '" . $value . "', a: '" . $addingTotalSales[$value] . "'},";
            }
            ?>
        ],
        barColors: ['#0af'],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['sales'],
        preUnits: '$',
        hideHover: 'auto'
    });
</script>