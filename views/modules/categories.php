<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addCategory">
                    Add Category
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-responsive-lg data-tables">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $value = null;

                        $categories = CategoriesController::showCategories($item, $value);

                        foreach ($categories as $key => $cat) {
                            echo '<tr>
                                  <td>' . ($key + 1) . '</td>
                                  <td class="text-uppercase">' . $cat['category'] . '</td>
                                  <td>       
                                    <div class="btn-group">
                                      <button class="btn btn-warning btnEditCategory" idCategory="' . $cat["id"] . '" data-toggle="modal" data-target="#editCategories"><i class="fa fa-pencil-alt"></i></button>
        
                                      <button class="btn btn-danger btnDeleteCategory" idCategory="' . $cat["id"] . '"><i class="fa fa-times"></i></button>
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

<!-- Add new category modal -->
<div id="addCategory" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="box-body">
                        <!--Input Category -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <input class="form-control input-lg" type="text" name="newCategory" placeholder="Category name" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <?php
                $createCategory = new CategoriesController();
                $createCategory->createCategory();
                ?>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div id="editCategories" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="POST">
                <div class="modal-body">
                    <div class="box-body">
                        <!--Input name -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                </div>
                                <input class="form-control input-lg" type="text" id="editCategory" name="editCategory" required>
                                <input type="hidden" name="idCategory" id="idCategory" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>

                <?php
                $editCategory = new CategoriesController();
                $editCategory->editCategory();
                ?>
            </form>
        </div>

    </div>
</div>