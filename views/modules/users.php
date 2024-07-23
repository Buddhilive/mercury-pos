<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Administration</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">User Administration</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addUser">
                    Add User
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-responsive-lg data-tables">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Photo</th>
                            <th>Profile</th>
                            <th>Status</th>
                            <th>Last login</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $value = null;

                        $all_users = UserController::getAllUsers($item, $value);

                        foreach ($all_users as $key => $user) {
                            echo '<tr>
                            <td>' . $user['id'] . '</td>
                            <td>' . $user['name'] . '</td>
                            <td>' . $user['username'] . '</td>';

                            if ($user['photo'] != '') {
                                echo '<td><img src="' . $user['photo'] . '" class="img-thumbnail" width="40px"></td>';
                            } else {
                                echo '<td><img src="views/dist/img/avatar.png" class="img-thumbnail" width="40px"></td>';
                            }

                            echo '<td>' . $user['profile'] . '</td>';
                            if ($user["status"] != 0) {
                                echo '<td><button class="btn btn-success btnActivate btn-xs" userId="' . $user["id"] . '" userStatus="0">Activated</button></td>';
                            } else {
                                echo '<td><button class="btn btn-danger btnActivate btn-xs" userId="' . $user["id"] . '" userStatus="1">Deactivated</button></td>';
                            }
                            echo '<td>' . $user['last_login'] . '</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning btnEditUser" idUser="' . $user['id'] . '" data-toggle="modal" data-target="#editUser"><i class="fa fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btnDeleteUser" userId="' . $user['id'] . '" username="' . $user['username'] . '" userPhoto="' . $user['photo'] . '"><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>

<!-- Add new user modal -->
<div id="addUser" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add user</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="box-body">
                        <!--Input name -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input class="form-control input-lg" type="text" id="newName" name="newName" placeholder="Add name" required>
                            </div>
                        </div>

                        <!-- input username -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input class="form-control input-lg" type="text" id="newUser" name="newUser" placeholder="Add username" required>
                            </div>
                        </div>

                        <!-- input password -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input class="form-control input-lg" type="password" name="newPasswd" placeholder="Add password" required>
                            </div>
                        </div>

                        <!-- input profile -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <select class="form-control input-lg" name="newProfile">
                                    <option value="">Select profile</option>
                                    <option value="administrator">Administrator</option>
                                    <option value="special">Special</option>
                                    <option value="seller">Seller</option>
                                </select>
                            </div>
                        </div>
                        <!-- Uploading image -->
                        <div class="form-group">
                            <div class="panel">Upload image</div>
                            <input class="newPics" type="file" name="newPhoto">
                            <p class="help-block">Maximum size 2Mb</p>
                            <img class="thumbnail preview" src="views/dist/img/avatar.png" width="100px">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <?php
                $new_user = new UserController();
                $new_user->createUser();
                ?>
            </form>
        </div>
    </div>
</div>

<!-- Edit user modal -->
<div id="editUser" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit user</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="box-body">
                        <!--Input name -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input class="form-control input-lg" type="text" id="editName" name="editName" value="" required>
                            </div>
                        </div>

                        <!-- input username -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input class="form-control input-lg" type="text" id="editUsername" name="editUser" value="" readonly>
                            </div>
                        </div>

                        <!-- input password -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input class="form-control input-lg" type="password" name="editPasswd" placeholder="Type new password">
                                <input type="hidden" name="currentPasswd" id="currentPasswd">
                            </div>
                        </div>

                        <!-- input profile -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <select class="form-control input-lg" name="editProfile">
                                    <option value="" id="editProfile"></option>
                                    <option value="administrator">Administrator</option>
                                    <option value="special">Special</option>
                                    <option value="seller">Seller</option>
                                </select>
                            </div>
                        </div>
                        <!-- Uploading image -->
                        <div class="form-group">
                            <div class="panel">Upload image</div>
                            <input class="newPics" type="file" name="editPhoto">
                            <p class="help-block">Maximum size 2Mb</p>
                            <img class="thumbnail preview" src="views/dist/img/avatar.png" width="100px">
                            <input type="hidden" name="currentPicture" id="currentPicture">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Modify</button>
                </div>
                <?php
                $edit_user = new UserController();
                $edit_user -> editUser();
                ?>
            </form>
        </div>
    </div>
</div>

<?php
  $deleteUser = new UserController();
  $deleteUser -> deleteUser();
?> 