<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-default" id="daterange-btn2">
                        <span>
                            <i class="fa fa-calendar"></i> Date range
                        </span>
                        <i class="fa fa-caret-down"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        include "reports/sales-graph.php";
                        ?>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <?php
                        include "reports/bestseller-products.php";
                        ?>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <?php
                        include "reports/sellers.php";
                        ?>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <?php
                        include "reports/buyers.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>