<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php
            if ($_SESSION["profile"] == "administrator") {
                include "home/top-widgets.php";
            }
            ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if ($_SESSION["profile"] == "administrator") {
                    include "reports/sales-graph.php";
                }
                ?>
            </div>

            <div class="col-md-6">
                <?php
                if ($_SESSION["profile"] == "administrator") {
                    include "reports/bestseller-products.php";
                }
                ?>
            </div>
            <div class="col-md-6">
                <?php
                if ($_SESSION["profile"] == "administrator") {
                    include "home/recent-products.php";
                }
                ?>
            </div>

            <div class="col-md-12">
                <?php
                if ($_SESSION["profile"] == "special" || $_SESSION["profile"] == "seller") {
                    echo '<div class="box box-success">
                        <div class="box-header">
                            <h1>Welcome ' . $_SESSION["name"] . '</h1>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>