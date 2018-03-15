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

    <link href="<?php echo base_url('includes/dist/css/tiles.css');?>" rel="stylesheet">

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
    <script src="<?php echo base_url('includes/bower_components/angular-authentication/js/angular-authentication.js');?>"></script>
    <script src="<?php echo base_url('includes/bower_components/angular-cookies/angular-cookies.js');?>"></script>
    <script src="<?php echo base_url('includes/bower_components/angularUtils-pagination/dirPagination.js');?>"></script>
    <script src="<?php echo base_url('includes/bower_components/cpf_cnpj/build/cpf.js');?>"></script>
    <script src="<?php echo base_url('includes/bower_components/cpf_cnpj/build/cnpj.js');?>"></script>
    <script src="<?php echo base_url('includes/bower_components/ng-cpf-cnpj/lib/ngCpfCnpj.js');?>"></script>
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

	<!-- Navigation -->
	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0" ng-if="globals.currentUser">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">SisKitnet</a>
		</div>
		<!-- /.navbar-header -->

		<ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="">Alertas
                    <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-alerts -->
            </li>
			<!-- /.dropdown -->
			<li class="dropdown" ng-controller="LogoutController">

				<a class="dropdown-toggle" data-toggle="dropdown" href="">
					<i class="fa fa-user fa-fw"></i> <?php echo $this->session->userdata('login');?> <i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-user">
					<li><a href="#/conta"><i class="fa fa-user fa-fw"></i> Conta</a>
					</li>
					<!--                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>-->
					<!--                    </li>-->
					<li class="divider"></li>
					<li><a href="#" ng-click="sair()"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
					</li>
				</ul>
				<!-- /.dropdown-user -->
			</li>
			<!-- /.dropdown -->
		</ul>
		<!-- /.navbar-top-links -->
		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav navbar-collapse">
				<ul class="nav" id="side-menu">
					<li>
						<a href="#/"><i class="fa fa-tachometer fa-fw"></i> Início</a>
					</li>
					<li>
						<a href="#/locatarios"><i class="fa fa-users fa-fw"></i> Locatários</a>
					</li>
					<li>
						<a href="#/contratos"><i class="fa fa-file-text fa-fw"></i> Contratos</a>
					</li>
					<li>
						<a href="#/imoveis"><i class="fa fa-home fa-fw"></i> Imóveis</a>
					</li>
					<li>
						<a href="#/despesas"><i class="fa fa-money fa-fw"></i> Despesas</a>
					</li>
                    <li>
                        <a href="#/indenizacoes"><i class="fa fa-money fa-fw"></i> Indenizações</a>
                    </li>
					<li>
						<a href="#/pagamentos"><i class="fa fa-credit-card fa-fw"></i> Pagamentos</a>
					</li>
					<li>
						<a href="#/relatorios"><i class="fa fa-bar-chart fa-fw"></i> Relatórios</a>
					</li>
				</ul>
			</div>
			<!-- /.sidebar-collapse -->
		</div>
		<!-- /.navbar-static-side -->
	</nav>


		<ng-view></ng-view>


<!--    <div ng-if="!globals.currentUser">-->
<!--        <ng-view></ng-view>-->
<!--    </div>-->


<!--    <div ng-if="!globals.currentUser">-->
<!--            <ng-view></ng-view>-->
<!--    </div>-->
<!--    <div ng-if="hideMenus == false">-->
<!--        <ng-view></ng-view>-->
<!--    </div>-->

</div>
</body>
</html>



