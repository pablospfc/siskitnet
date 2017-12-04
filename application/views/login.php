<!DOCTYPE html>
<html lang="en">

<head >

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SisKitnet</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('includes/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.rawgit.com/gilf/ngPrint/master/ngPrint.min.css" />

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('includes/vendor/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url('includes/vendor/datatables-plugins/dataTables.bootstrap.css');?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url('includes/vendor/datatables-responsive/dataTables.responsive.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('includes/dist/css/sb-admin-2.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('includes/vendor/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url('includes/vendor/fullcalendar/css/bootstrap-colorpicker.min.css');?>" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url('includes/vendor/fullcalendar/css/bootstrap-timepicker.min.css');?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<?php echo base_url('includes/vendor/jquery/jquery.min.js')?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('includes/vendor/bootstrap/js/bootstrap.min.js');?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('includes/vendor/metisMenu/metisMenu.min.js');?>"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url('includes/vendor/datatables/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?php echo base_url('includes/vendor/datatables-plugins/dataTables.bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('includes/vendor/datatables-responsive/dataTables.responsive.js');?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('includes/dist/js/sb-admin-2.js');?>"></script>

    <script src="<?php echo base_url('includes/vendor/fullcalendar/js/bootstrap-colorpicker.min.js');?>"></script>

    <script src="<?php echo base_url('includes/vendor/fullcalendar/js/bootstrap-timepicker.min.js');?>"></script>

    <script src="<?php echo base_url('includes/bower_components/angular/angular.min.js');?>"></script>
    <script src="<?php echo base_url('includes/bower_components/angular-route/angular-route.min.js');?>"></script>
    <script src="<?php echo base_url('includes/bower_components/angular-br-filters/release/angular-br-filters.min.js');?>"></script>
    <script src="<?php echo base_url('includes/bower_components/angular-messages/angular-messages.min.js');?>"></script>
    <script src="<?php echo base_url('includes/bower_components/angular-sanitize/angular-sanitize.min.js');?>"></script>
    <script src="<?php echo base_url('includes/bower_components/angular-modal-service/dst/angular-modal-service.min.js');?>"></script>
    <script src="<?php echo base_url('includes/bower_components/angular-input-masks/angular-input-masks-standalone.min.js');?>"></script>
    <script src="<?php echo base_url('includes/bower_components/bootbox.js/bootbox.js');?>"></script>
    <script src="<?php echo base_url('includes/app/siskitnet.min.js');?>"></script>


    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>

</head>

<body ng-app="sisKitnet-App">

<div id="wrapper">


    <div id="page-wrapper">
        <ng-view></ng-view>
    </div>
</div>
</body>
</html>



