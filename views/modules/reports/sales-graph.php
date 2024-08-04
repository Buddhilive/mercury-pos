<?php
error_reporting(0);

if (isset($_GET["initialDate"])) {
    $initialDate = $_GET["initialDate"];
    $finalDate = $_GET["finalDate"];
} else {
    $initialDate = null;
    $finalDate = null;
}

$answer = SalesController::salesDatesRange($initialDate, $finalDate);

$arrayDates = array();
$arraySales = array();
$addingMonthPayments = array();

foreach ($answer as $key => $value) {
    #We capture only year and month
    $singleDate = substr($value["saledate"], 0, 7);

    #Introduce dates in arrayDates
    array_push($arrayDates, $singleDate);

    #We capture the sales
    $arraySales = array($singleDate => $value["totalPrice"]);

    #we add payments made in the same month
    foreach ($arraySales as $key => $value) {
        $addingMonthPayments[$key] += $value;
    }
}

$noRepeatDates = array_unique($arrayDates);
?>

<div class="card">
    <div class="card-header">Sales Graph</div>
    <div class="card-body">
        <div class="chart" id="line-chart-Sales" style="height: 250px;"></div>
    </div>
</div>

<script>
    var line = new Morris.Line({
        element: 'line-chart-Sales',
        resize: true,
        data: [
            <?php
            if ($noRepeatDates != null) {
                foreach ($noRepeatDates as $key) {
                    echo "{ y: '" . $key . "', Sales: " . $addingMonthPayments[$key] . " },";
                }
                // echo "{y: '" . $key . "', Sales: " . $addingMonthPayments[$key] . " }";
            } else {
                echo "{ y: '0', Sales: '0' }";
            }
            ?>
        ],
        xkey: 'y',
        ykeys: ['Sales'],
        labels: ['Sales'],
        lineColors: ['#4bc0c0'],
        lineWidth: 2,
        hideHover: 'auto',
        gridTextColor: '#000',
        gridStrokeWidth: 0.4,
        pointSize: 4,
        pointStrokeColors: ['#4bc0c0'],
        gridLineColor: '#4bc0c0',
        gridTextFamily: 'Open Sans',
        preUnits: 'Rs.',
        gridTextSize: 10
    });
</script>