<?php
date_default_timezone_set("Asia/Bangkok");
session_start();
error_reporting(E_ALL & ~E_NOTICE);
if (!isset($_SESSION['user'])){
    header( "location: login.php" );
    exit(0);
}

include ('config/database.php');
include ('class/date.class.php');
include ('class/data.class.php');


$mysqli = connect();
$fnc = new pos();
$menu = $_GET['menu'];
// Get Value From Login
$empSession = $fnc->getUser($_SESSION['user']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>POS & STOCK SYSTEM</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Kanit:300&display=swap" rel="stylesheet">
    <!-- Custom Css -->
    <link href="dist/css/custom.css">
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- FullCalendar -->
    <link href='plugin/fullcalendar/packages/core/main.css' rel='stylesheet' />
    <link href='plugin/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
    <link href='plugin/fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
    <link href='plugin/fullcalendar/packages/list/main.css' rel='stylesheet' />
    <script src='plugin/fullcalendar/packages/core/main.js'></script>
    <script src='plugin/fullcalendar/packages/interaction/main.js'></script>
    <script src='plugin/fullcalendar/packages/daygrid/main.js'></script>
    <script src='plugin/fullcalendar/packages/timegrid/main.js'></script>
    <script src='plugin/fullcalendar/packages/list/main.js'></script>
    <!-- SweetAlert -->
    <script src="plugin/sweetalert/sweetalert.min.js"></script>
    <!-- Autocomplete -->
    <script type="text/javascript" charset="utf8" src="plugin/autocomplete/autocomplete.js"></script>
    <link rel="stylesheet" href="plugin/autocomplete/autocomplete.css">
    <!-- DataTable -->
    <link rel="stylesheet" type="text/css" href="plugin/datatable/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="plugin/datatable/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="plugin/datatable/dataTables.responsive.min.js"></script>
    <script type="text/javascript" charset="utf8" src="plugin/datatable/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script>
    $(document).ready(function() {
        var table = $('#reportTable').DataTable({
            responsive: true,
            "pageLength": 20,
            "lengthMenu": [
                [20, 50, 100, -1],
                [20, 50, 100, "All"]
            ],
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                },
                {
                    extend: 'print',
                }
            ],
        });
    });
    $(document).ready(function() {
        var table = $('#itemData').DataTable({
            scrollX: true,
            responsive: true,
        });
    });
    </script>
    <!-- ChartJS -->
    <script type="text/javascript" src="plugin/chart/Chart.bundle.js"></script>
    <!-- DatePicker -->
    <link rel="stylesheet" href="plugin/datepicker/jquery.datetimepicker.css">
    <script type="text/javascript" charset="utf8" src="plugin/datepicker/jquery.datetimepicker.full.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
            include ('template/nav.php');
            include ('template/sidebar.php');
            ?>
        <div class="content-wrapper">
            <?php if (!isset($menu)){ include ('menu/main.php'); }?>
            <?php if ($menu=='sale'){ include ('menu/sale/index.php'); }?>
            <?php if ($menu=='stock'){ include ('menu/stock/index.php'); }?>
            <?php if ($menu=='daily'){ include ('menu/sale/daily.php'); }?>
            <?php if ($menu=='week'){ include ('menu/sale/week.php'); }?>
            <?php if ($menu=='month'){ include ('menu/sale/month.php'); }?>
        </div>
        <?php include ('template/footer.php'); ?>
    </div>
</body>

</html>