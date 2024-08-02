<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Sales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Create Sales</li>
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
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="newSeller" id="newSeller" value="<?php echo $_SESSION["name"]; ?>" readonly>
                                    <input type="hidden" name="idSeller" value="<?php echo $_SESSION["id"]; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>
                                    <?php
                                    $item = null;
                                    $value = null;

                                    $sales = SalesController::showSales($item, $value);

                                    if (!$sales) {
                                        echo '<input type="text" class="form-control" name="newSale" id="newSale" value="10001" readonly>';
                                    } else {
                                        foreach ($sales as $key => $value) {
                                        }
                                        $code = $value["code"] + 1;
                                        echo '<input type="text" class="form-control" name="newSale" id="newSale" value="' . $code . '" readonly>';
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-users"></i></span>
                                    </div>
                                    <select class="form-control" name="selectCustomer" id="selectCustomer" required>
                                        <option value="">Select customer</option>
                                        <?php
                                        $item = null;
                                        $value = null;

                                        $customers = CustomersController::showCustomers($item, $value);

                                        foreach ($customers as $key => $value) {
                                            echo '<option value="' . $value["id"] . '">' . $value["name"] . '</option>';
                                        }
                                        ?>
                                    </select>

                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAddCustomer" data-dismiss="modal">Add Customer</button>
                                    </div>
                                </div>

                                <div class="card card-orange card-outline mt-3 form-group row newProduct">

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
                                                            <input type="number" class="form-control" name="newTaxSale" id="newTaxSale" placeholder="0" min="0" required>

                                                            <input type="hidden" name="newTaxPrice" id="newTaxPrice" required>

                                                            <input type="hidden" name="newNetPrice" id="newNetPrice" required>

                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <i class="fa fa-percent"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="width: 50%">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                                            <input type="number" class="form-control" name="newSaleTotal" id="newSaleTotal" placeholder="00000" totalSale="" readonly required>

                                                            <input type="hidden" name="saleTotal" id="saleTotal" required>
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
                                                <option value="" disabled>Select payment method</option>
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
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary pull-right">Save sale</button>
                        </div>
                    </form>
                    <?php
                    $saveSale = new SalesController();
                    $saveSale->createSale();
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
    <!-- /.content -->
</div>

<!-- Add new customer modal -->
<div id="modalAddCustomer" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <input class="form-control input-lg" type="text" name="newCustomer" placeholder="Write name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <input class="form-control input-lg" type="number" min="0" name="newIdDocument" placeholder="Write your ID" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <input class="form-control input-lg" type="text" name="newEmail" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <input class="form-control input-lg" type="text" name="newPhone" placeholder="phone" data-inputmask='"mask": "(999) 999-9999999"' data-mask required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <input class="form-control input-lg" type="text" name="newAddress" placeholder="Address" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <input class="form-control input-lg" type="text" name="newBirthdate" placeholder="Birth Date" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <?php
                $createCustomer = new CustomersController();
                $createCustomer->createCustomer();
                ?>
            </form>
        </div>
    </div>
</div>