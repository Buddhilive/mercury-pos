<?php
$item = null;
$value = null;
$order = "sales";
$products = ProductsController::showProducts($item, $value, $order);
$colours = array("red", "green", "yellow", "aqua", "purple", "blue", "cyan", "magenta", "orange", "gold");

$salesTotal = ProductsController::showAddingOfTheSales();
?>

<div class="card">
    <div class="card-header">Best Seller Products</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="chart-responsive">
                    <canvas id="pieChart" height="350"></canvas>
                </div>
            </div>
            <!-- <div class="col-md-5">
                <ul class="chart-legend clearfix">
                    <?php
                    for ($i = 0; $i < 10; $i++) {
                        echo ' <li><i class="fa fa-circle-o text-' . $colours[$i] . '"></i> ' . $products[$i]["description"] . '</li>';
                    }
                    ?>
                </ul>
            </div> -->
        </div>
    </div>
    <div class="card-footer">
        <ul class="nav nav-pills nav-stacked">
            <?php
            for ($i = 0; $i < 5; $i++) {
                echo '<li>                        
                        <a>
                        <img src="' . $products[$i]["image"] . '" class="img-thumbnail" width="60px" style="margin-right:10px"> 
                        ' . $products[$i]["description"] . '
                        <span class="pull-right text-' . $colours[$i] . '">   
                        ' . ceil($products[$i]["sales"] * 100 / $salesTotal["total"]) . '%
                        </span>                          
                        </a>
                     </li>';
            }
            ?>
        </ul>
    </div>
</div>

<script>
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
    var pieData = [
        <?php
        for ($i = 0; $i < count($products); $i++) {
            echo $products[$i]["sales"] . ",";
        }
        ?>
    ];
    var pieLabels = [
        <?php
        for ($i = 0; $i < count($products); $i++) {
            echo "'" . $products[$i]["description"] . "',";
        }
        ?>
    ];
    var pieColors = [
        <?php
        for ($i = 0; $i < count($products); $i++) {
            echo "'" . $colours[$i] . "',";
        }
        ?>
    ];
    var pieOptions = {
        // Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        // String - The colour of each segment stroke
        segmentStrokeColor: '#fff',
        // Number - The width of each segment stroke
        segmentStrokeWidth: 1,
        // Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        // Number - Amount of animation steps
        animationSteps: 100,
        // String - Animation easing effect
        animationEasing: 'easeOutBounce',
        // Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        // Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        // Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: false,
        // String - A legend template
        legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
        // String - A tooltip template
        tooltipTemplate: '<%=value %> <%=label%>'
    };

    var pieChart = new Chart(pieChartCanvas, {
        type: 'doughnut',
        data: {
            labels: pieLabels,
            datasets: [{
                label: 'Best Seller',
                data: pieData,
                backgroundColor: pieColors,
            }]
        },
        options: pieOptions
    });
</script>