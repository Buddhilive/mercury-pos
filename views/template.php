<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mercury POS</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="views/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <?php

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
                $_GET["route"] == "client" ||
                $_GET["route"] == "sales" ||
                $_GET["route"] == "create-sales" ||
                $_GET["route"] == "reports"
            ) {
                include "modules/" . $_GET["route"] . ".php";
            }
        }
        /* Footer */
        include "modules/footer.php";
        /* Control Panel */
        include "modules/control-panel.php";
        ?>

    </div>

    <!-- jQuery -->
    <script src="views/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="views/dist/js/adminlte.min.js"></script>
</body>

</html>