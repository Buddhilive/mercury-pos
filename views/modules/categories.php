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
                <button class="btn btn-primary" data-toggle="modal" data-target="#addUser">
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
                        <tr>
                            <td>1</td>
                            <td>admin</td>
                            <td>admin</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning btnEditUser" idUser="" data-toggle="modal" data-target="#editUser"><i class="fa fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btnDeleteUser" userId="" username="" userPhoto=""><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>