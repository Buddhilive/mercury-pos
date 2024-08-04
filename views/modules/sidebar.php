<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="views/index3.html" class="brand-link">
        <img src="views/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Mercury POS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php
                if ($_SESSION["photo"] != "") {
                    echo '<img src="' . $_SESSION["photo"] . '" class="img-circle elevation-2" alt="User Image">';
                } else {
                    echo '<img src="views/dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">';
                }
                ?>
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION["name"] ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <?php
                if ($_SESSION["profile"] == "administrator" || $_SESSION["profile"] == "seller") {
                    echo '<li class="nav-item">
                        <a href="customers" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Customers
                            </p>
                        </a>
                    </li>';
                }

                if ($_SESSION["profile"] == "administrator" || $_SESSION["profile"] == "special") {
                    echo '<li class="nav-item">
                        <a href="categories" class="nav-link">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>
                                Categories
                            </p>
                        </a>
                    </li>';
                }

                if ($_SESSION["profile"] == "administrator" || $_SESSION["profile"] == "special") {
                    echo '<li class="nav-item">
                        <a href="products" class="nav-link">
                            <i class="nav-icon fas fa-cubes"></i>
                            <p>
                                Products
                            </p>
                        </a>
                    </li>';
                }

                if ($_SESSION["profile"] == "administrator" || $_SESSION["profile"] == "seller") {
                    echo '<li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-shopping-bag"></i>
                            <p>
                                Sales
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="create-sales" class="nav-link">
                                    <i class="fas fa-cart-plus nav-icon"></i>
                                    <p>Create Sales</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="sales" class="nav-link">
                                    <i class="fas fa-money-bill nav-icon"></i>
                                    <p>All Sales</p>
                                </a>
                            </li>
                        </ul>
                    </li>';
                }

                if ($_SESSION["profile"] == "administrator") {
                    echo '<li class="nav-item">
                        <a href="reports" class="nav-link">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>
                                Reports
                            </p>
                        </a>
                    </li>';
                }

                if ($_SESSION["profile"] == "administrator") {
                    echo '<li class="nav-item">
                        <a href="users" class="nav-link">
                            <i class="nav-icon fas fa-id-card"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>';
                }
                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>