<?php

$item = null;
$value = null;
$order = "id";

$sales = SalesController::addingTotalSales();

$categories = CategoriesController::showCategories($item, $value);
$totalCategories = count($categories);

$customers = CustomersController::showCustomers($item, $value);
$totalCustomers = count($customers);

$products = ProductsController::showProducts($item, $value, $order);
$totalProducts = count($products);

?>

<div class="col-lg-3 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <h3>Rs. <?php echo number_format($sales["total"],2); ?></h3>
            <p>Sales</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="sales" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?php echo number_format($totalCategories); ?></sup></h3>
            <p>Categories</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="categories" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
        <div class="inner">
            <h3><?php echo number_format($totalCustomers); ?></h3>
            <p>Customers</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="customers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
        <div class="inner">
            <h3><?php echo number_format($totalProducts); ?></h3>
            <p>Products</p>
        </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>
        <a href="products" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>