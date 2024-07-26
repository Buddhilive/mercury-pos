<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addProduct">
                    Add Product
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-responsive-lg productsTable">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Image</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Buying price</th>
                            <th>Selling Price</th>
                            <th>Date added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

<!-- Add new product modal -->
<div id="addProduct" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="box-body">
                        <!-- select category -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <select class="form-control input-lg" id="newCategory" name="newCategory">
                                    <option value="" disabled selected>Select category</option>
                                    <?php
                                    $item = null;
                                    $value1 = null;

                                    $categories = CategoriesController::showCategories($item, $value1);

                                    foreach ($categories as $key => $value) {
                                        echo '<option value="' . $value["id"] . '">' . $value["category"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- Product code -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-code"></i></span>
                                </div>
                                <input class="form-control input-lg" type="text" id="newCode" name="newCode" placeholder="Add Code" required readonly>
                            </div>
                        </div>

                        <!-- Product description -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-file-alt"></i></span>
                                </div>
                                <input class="form-control input-lg" type="text" id="newDescription" name="newDescription" placeholder="Add Description" required>
                            </div>
                        </div>

                        <!-- input stock -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-check"></i></span>
                                </div>
                                <input class="form-control input-lg" type="number" id="newStock" name="newStock" placeholder="Add Stock" min="0" required>
                            </div>
                        </div>

                        <!-- Price Inputs -->
                        <fieldset class="border p-2">
                            <legend class="w-auto">Prices</legend>
                            <div class="form-group row">
                                <div class="input-group col-md-6 mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-arrow-up"></i></span>
                                    </div>
                                    <input type="number" class="form-control input-lg" id="newBuyingPrice" name="newBuyingPrice" step="any" min="0" placeholder="Buying price" required>
                                </div>

                                <div class="input-group col-md-6 mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-arrow-down"></i></span>
                                    </div>
                                    <input type="number" class="form-control input-lg" id="newSellingPrice" name="newSellingPrice" step="any" min="0" placeholder="Selling price" required>
                                </div>
                                <!-- CHECKBOX PERCENTAGE -->
                                <div class="input-group col-md-6">
                                    <label>
                                        <input type="checkbox" class="minimal percentage" checked>
                                        Use percentage
                                    </label>
                                </div>

                                <div class="input-group col-md-6">
                                    <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-percent"></i></span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Uploading image -->
                        <div class="form-group mt-3">
                            <div class="panel">Upload image</div>
                            <input id="newProdPhoto" type="file" class="newImage" name="newProdPhoto">
                            <p class="help-block">Maximum size 2Mb</p>
                            <img class="thumbnail preview" src="views/dist/img/boxed-bg.png" width="100px">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <?php
                $createProduct = new ProductsController();
                $createProduct->createProducts();
                ?>
            </form>
        </div>
    </div>
</div>

<!-- Edit product modal -->
<div id="editProduct" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="box-body">
                        <!-- select category -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <select class="form-control input-lg" name="editCategory" readonly required>
                                    <option id="editCategory"></option>
                                </select>
                            </div>
                        </div>
                        <!-- Product code -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-code"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" id="editCode" name="editCode" readonly required>
                            </div>
                        </div>

                        <!-- Product description -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-file-alt"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" id="editDescription" name="editDescription" required>
                            </div>
                        </div>

                        <!-- input stock -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-check"></i></span>
                                </div>
                                <input type="number" class="form-control input-lg" id="editStock" name="editStock" min="0" required>
                            </div>
                        </div>

                        <!-- Price Inputs -->
                        <fieldset class="border p-2">
                            <legend class="w-auto">Prices</legend>
                            <div class="form-group row">
                                <div class="input-group col-md-6 mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-arrow-up"></i></span>
                                    </div>
                                    <input type="number" class="form-control input-lg" id="editBuyingPrice" name="editBuyingPrice" step="any" min="0" required>
                                </div>

                                <div class="input-group col-md-6 mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-arrow-down"></i></span>
                                    </div>
                                    <input type="number" class="form-control input-lg" id="editSellingPrice" name="editSellingPrice" step="any" min="0" readonly required>
                                </div>
                                <!-- CHECKBOX PERCENTAGE -->
                                <div class="input-group col-md-6">
                                    <label>
                                        <input type="checkbox" class="minimal percentage" checked>
                                        Use percentage
                                    </label>
                                </div>

                                <div class="input-group col-md-6">
                                    <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-percent"></i></span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Uploading image -->
                        <div class="form-group mt-3">
                            <div class="panel">Upload image</div>
                            <input type="file" class="newImage" name="editImage">
                            <p class="help-block">2MB max</p>
                            <img class="thumbnail preview" src="views/dist/img/boxed-bg.png" width="100px">
                            <input type="hidden" name="currentImage" id="currentImage">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <?php
                $editProduct = new ProductsController();
                $editProduct->editProduct();
                ?>
            </form>
        </div>
    </div>
</div>
<?php
$deleteProduct = new ProductsController();
$deleteProduct->deleteProduct();
?>