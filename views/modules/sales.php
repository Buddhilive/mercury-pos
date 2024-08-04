<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Sales</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header d-flex">
                <a class="btn btn-primary" href="create-sales">
                    Add Sale
                </a>
                <span class="flex-grow-1"></span>
                <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                    <span>
                        <i class="fa fa-calendar"></i> Date Range
                    </span>
                    <i class="fa fa-caret-down"></i>
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-responsive-lg tables">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Bill code</th>
                            <th>Customer</th>
                            <th>Seller</th>
                            <th>Payment method</th>
                            <th>Net cost</th>
                            <th>Total cost</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $item = null;
                        $value = null;

                        $answer = SalesController::showSales($item, $value);

                        foreach ($answer as $key => $value) {
                            echo '<td>' . ($key + 1) . '</td>

                            <td>' . $value["code"] . '</td>';

                            $itemCustomer = "id";
                            $valueCustomer = $value["idCustomer"];

                            $customerAnswer = CustomersController::showCustomers($itemCustomer, $valueCustomer);

                            echo '<td>' . $customerAnswer["name"] . '</td>';

                            $itemUser = "id";
                            $valueUser = $value["idSeller"];

                            $userAnswer = UserController::getAllUsers($itemUser, $valueUser);

                            if (isset($_GET["hiddenProfile"]) && $_GET["hiddenProfile"] == "administrator") {
                                $buttons = '<button class="btn btn-info btnPrintBill" saleCode="' . $value["code"] . '"><i class="fa fa-print"></i></button>
                                    <button class="btn btn-warning btnEditSale" idSale="' . $value["id"] . '"><i class="fa fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btnDeleteSale" idSale="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
                            } else {
                                $buttons = '<button class="btn btn-info btnPrintBill" saleCode="' . $value["code"] . '"><i class="fa fa-print"></i></button>';
                            }

                            echo '<td>' . $userAnswer["name"] . '</td>
                                <td>' . $value["paymentMethod"] . '</td>
                                <td>Rs. ' . number_format($value["netPrice"], 2) . '</td>
                                <td>Rs. ' . number_format($value["totalPrice"], 2) . '</td>
                                <td>' . $value["saledate"] . '</td>
                                <td>
                                <div class="btn-group">'                                   
                                    . $buttons .
                                '</div>  
                                </td>
                            </tr>';
                        }

                        ?>
                    </tbody>
                </table>
                <?php
                $deleteSale = new SalesController();
                $deleteSale->deleteSale();
                ?>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>