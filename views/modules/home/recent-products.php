<?php

$item = null;
$value = null;
$order = "id";

if (count($products) < 10) {
    $prod_length = count($products);
} else {
    $prod_length = 10;
}

$products = ProductsController::showProducts($item, $value, $order);

?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Recently Added Products</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <ul class="products-list product-list-in-box">
            <?php
            for ($i = 0; $i < $prod_length; $i++) {
                echo '<li class="item">
                    <div class="product-img">
                        <img src="' . $products[$i]["image"] . '" alt="Product Image">
                    </div>
                    <div class="product-info">
                        <h6 class="product-title text-blue">
                            ' . $products[$i]["description"] . ' - 
                            <span class="text-danger">Rs. ' . $products[$i]["sellingPrice"] . '</span>
                        </h6>
                    </div>
                </li>';
            }
            ?>
        </ul>
    </div>
    <div class="card-footer">
        <a href="products" class="uppercase">See all products</a>
    </div>
</div>