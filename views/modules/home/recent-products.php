<?php

$item = null;
$value = null;
$order = "id";

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
            for ($i = 0; $i < count($products); $i++) {
                echo '<li class="item">
                    <div class="product-img">
                        <img src="' . $products[$i]["image"] . '" alt="Product Image">
                    </div>
                    <div class="product-info">
                        <a href="" class="product-title">
                            ' . $products[$i]["description"] . '
                            <span class="label label-warning pull-right">$' . $products[$i]["sellingPrice"] . '</span>
                        </a>
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