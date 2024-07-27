<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Clients</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Clients</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addCustomer">
                    Add User
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-responsive-lg customerTable">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Name</th>
                            <th>I.D Document</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Birthday</th>
                            <th>Total purchases</th>
                            <th>Last Purchase</th>
                            <th>Last login</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $item = null;
                        $value = null;

                        $Customers = CustomersController::showCustomers($item, $value);

                        foreach ($Customers as $key => $customer) {
                            echo '<tr>
                                    <td>' . ($key + 1) . '</td>
                                    <td>' . $customer["name"] . '</td>
                                    <td>' . $customer["idDocument"] . '</td>
                                    <td>' . $customer["email"] . '</td>
                                    <td>' . $customer["phone"] . '</td>
                                    <td>' . $customer["address"] . '</td>
                                    <td>' . $customer["birthdate"] . '</td>             
                                    <td>' . $customer["purchases"] . '</td>
                                    <td>0000-00-00 00:00:00</td>
                                    <td>' . $customer["registerDate"] . '</td>
                                    <td>
                                        <div class="btn-group">      
                                        <button class="btn btn-warning btnEditCustomer" data-toggle="modal" data-target="#editCustomerModal" idCustomer="' . $customer["id"] . '"><i class="fa fa-pencil-alt"></i></button>
                                        <button class="btn btn-danger btnDeleteCustomer" idCustomer="' . $customer["id"] . '"><i class="fa fa-times"></i></button>
                                        </div>  
                                    </td>
                                </tr>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<!-- Add new customer modal -->
<div id="addCustomer" class="modal fade" role="dialog">
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

<!-- Edit customer modal -->
<div id="editCustomerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit customer</h4>
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
                                <input type="text" class="form-control input-lg" name="editCustomer" id="editCustomer" required>
                                <input type="hidden" id="idCustomer" name="idCustomer">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <input type="number" min="0" class="form-control input-lg" name="editIdDocument" id="editIdDocument" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <input type="email" class="form-control input-lg" name="editEmail" id="editEmail" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" name="editPhone" id="editPhone" data-inputmask="'mask':'(999) 999-9999999'" data-mask required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" name="editAddress" id="editAddress"  required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" name="editBirthdate" id="editBirthdate" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <?php
                $EditCustomer = new CustomersController();
                $EditCustomer -> editCustomer();
                ?>
            </form>
        </div>
    </div>
</div>

<?php
  $deleteCustomer = new CustomersController();
  $deleteCustomer -> deleteCustomer();
?>