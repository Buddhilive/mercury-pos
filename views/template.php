<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="views/assets/favicon.ico" type="image/x-icon">
    <title>Mercury POS</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="views/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="views/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="views/css/swtalert.css">
    <!-- sweetalert2 -->
    <script src="views/js/swtalert.js"></script>
</head>
<?php
/* Authorized content */
if (isset($_SESSION["authSession"]) && $_SESSION["authSession"] == "ok") {
    echo '<body class="hold-transition sidebar-mini">';
    echo '<div class="wrapper">';
    /* Header */
    include "modules/header.php";
    /* Sidebar */
    include "modules/sidebar.php";
    /* Content */
    if (isset($_GET["route"])) {
        if (
            $_GET["route"] == "dashboard" ||
            $_GET["route"] == "users" ||
            $_GET["route"] == "categories" ||
            $_GET["route"] == "products" ||
            $_GET["route"] == "customers" ||
            $_GET["route"] == "sales" ||
            $_GET["route"] == "create-sales" ||
            $_GET["route"] == "reports" ||
            $_GET["route"] == "logout"
        ) {
            include "modules/" . $_GET["route"] . ".php";
        } else {
            include "modules/404.php";
        }
    } else {
        include "modules/dashboard.php";
    }
    /* Footer */
    include "modules/footer.php";
    /* Control Panel */
    include "modules/control-panel.php";
    echo '</div>';
} else {
    /* Login page */
    echo '<body class="hold-transition sidebar-mini login-page">';
    include 'modules/login.php';
}
?>

<!-- jQuery -->
<script src="views/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="views/dist/js/adminlte.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="views/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="views/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<!-- <script src="views/plugins/jszip/jszip.min.js"></script>
<script src="views/plugins/pdfmake/pdfmake.min.js"></script>
<script src="views/plugins/pdfmake/vfs_fonts.js"></script> -->
<script src="views/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- InputMask -->
<script src="views/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Custom Script -->
<script src="views/js/main.js"></script>
<script src="views/js/users.js"></script>
<script src="views/js/categories.js"></script>
<script src="views/js/products.js"></script>
<script src="views/js/customers.js"></script>
</body>

</html>