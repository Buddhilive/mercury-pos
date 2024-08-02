<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Sale</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Edit Sale</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-5 col-xs-12">
                <div class="card card-info card-outline">
                    <form role="form" method="post" class="saleForm">
                        <div class="card-body">
                            <?php
                            $item = "id";
                            $value = $_GET["idSale"];

                            $sale = SalesController::showSales($item, $value);

                            $itemUser = "id";
                            $valueUser = $sale["idSeller"];

                            $seller = UserController::getAllUsers($itemUser, $valueUser);

                            $itemCustomers = "id";
                            $valueCustomers = $sale["idCustomer"];

                            $customers = CustomersController::showCustomers($itemCustomers, $valueCustomers);

                            $taxPercentage = round($sale["tax"] * 100 / $sale["netPrice"]);
                            ?>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>

                                    <input type="text" class="form-control" name="newSeller" id="newSeller" value="<?php echo $seller["name"]; ?>" readonly>

                                    <input type="hidden" name="idSeller" value="<?php echo $seller["id"]; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>

                                    <input type="text" class="form-control" id="newSale" name="editSale" value="<?php echo $sale["code"]; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>

                                    <select class="form-control" name="selectCustomer" id="selectCustomer" required>
                                        <option value="<?php echo $customers["id"]; ?>"><?php echo $customers["name"]; ?></option>

                                        <?php
                                        $item = null;
                                        $value = null;

                                        $customers = CustomersController::showCustomers($item, $value);

                                        foreach ($customers as $key => $value) {
                                            echo '<option value="' . $value["id"] . '">' . $value["name"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row newProduct">
                                <?php
                                $productList = json_decode($sale["products"], true);

                                foreach ($productList as $key => $value) {
                                    $item = "id";
                                    $valueProduct = $value["id"];

                                    $answer = ProductsController::showproducts($item, $valueProduct);

                                    $lastStock = $answer["stock"] + $value["quantity"];

                                    echo '<div class="row" style="padding:5px 15px">                    
                                        <div class="col-md-6" style="padding-right:0px">                              
                                            <div class="input-group">                                   
                                                <div class="input-group-prepend"><span class="input-group-text"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct="' . $value["id"] . '"><i class="fa fa-times"></i></button></span></div>

                                                <input type="text" class="form-control newProductDescription" idProduct="' . $value["id"] . '" name="addProduct" value="' . $value["description"] . '" readonly required>
                                            </div>

                                        </div>

                                        <div class="col-md-3">                                
                                            <input type="number" class="form-control newProductQuantity" name="newProductQuantity" min="1" value="' . $value["quantity"] . '" stock="' . $lastStock . '" newStock="' . $value["stock"] . '" required>
                                        </div>

                                        <div class="col-md-3 enterPrice" style="padding-left:0px">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ion ion-social-usd"></i></span>
                                                </div>
                                    
                                                <input type="text" class="form-control newProductPrice" realPrice="' . $answer["sellingPrice"] . '" name="newProductPrice" value="' . $value["totalPrice"] . '" readonly required>                   
                                            </div>                                
                                        </div>
                                    </div>';
                                }
                                ?>

                            </div>

                            <input type="hidden" name="productsList" id="productsList">

                            <button type="button" class="btn btn-default hidden-lg btnAddProduct">Add Product</button>

                            <hr>

                            <div class="row">
                                <div class="col-xs-8 pull-right">
                                    <table class="table">
                                        <thead>
                                            <th>Taxes</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width: 50%">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" name="newTaxSale" id="newTaxSale" value="<?php echo $taxPercentage; ?>" min="0" required>

                                                        <input type="hidden" name="newTaxPrice" id="newTaxPrice" value="<?php echo $sale["tax"]; ?>" required>

                                                        <input type="hidden" name="newNetPrice" id="newNetPrice" value="<?php echo $sale["netPrice"]; ?>" required>

                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-percent"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width: 50%">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="ion ion-social-usd"></i>
                                                            </span>
                                                        </div>

                                                        <input type="number" class="form-control" name="newSaleTotal" id="newSaleTotal" placeholder="00000" totalSale="<?php echo $sale["netPrice"]; ?>" value="<?php echo $sale["totalPrice"]; ?>" readonly required>

                                                        <input type="hidden" name="saleTotal" id="saleTotal" value="<?php echo $sale["totalPrice"]; ?>" required>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <hr>

                            </div>

                            <hr>

                            <div class="form-group row">
                                <div class="col-xs-6" style="padding-right: 0">
                                    <div class="input-group">
                                        <select class="form-control" name="newPaymentMethod" id="newPaymentMethod" required>
                                            <option value="">Select payment method</option>
                                            <option value="cash">Cash</option>
                                            <option value="CC">Credit Card</option>
                                            <option value="DC">Debit Card</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="paymentMethodBoxes"></div>

                                <input type="hidden" name="listPaymentMethod" id="listPaymentMethod" required>
                            </div>
                            <br>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary pull-right">Save changes</button>
                        </div>
                    </form>

                    <?php
                    $editSale = new SalesController();
                    $editSale->editSale();
                    ?>
                </div>
            </div>

            <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
                <div class="card card-success card-outline">
                    <div class="card-body">
                        <table class="table table-bordered table-striped dt-responsive salesTable">
                            <thead>
                                <tr>
                                    <th style="width:10px">#</th>
                                    <th>Image</th>
                                    <th style="width:30px">Code</th>
                                    <th>Description</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>