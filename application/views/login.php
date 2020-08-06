<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Coffee@Dito</title>

	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
	<style type="text/css">
		.justify-content-center{
			margin-top: 180px;
		}
	</style>
</head>
<body>
	<div class="container">
		<!-- Outer Row -->
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<!-- selip i gambar -->
			</div>
			<div class="col-lg-4">
				<div class="text-center">
					<h1 class="h4 text-gray-900 mb-4">Coffee's@Dito</h1>
					<!-- <?php // echo base_url('auth/login') ?> -->
				</div>
				<form action="<?php echo base_url('index.php/auth/login') ?>" method="post" class="user">
					<div class="form-group">
						<input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Username ...">
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
					</div>
					<button type="submit" class="btn btn-primary btn-user btn-block" style="margin-top: 50px;">
						Login
					</button>
				</form>
			</div>
		</div>
	</div>
	<!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
	<!-- Core plugin JavaScript-->
	<script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
	<!-- Custom scripts for all pages-->
	<script src="<?php echo base_url('assets/js/sb-admin-2.min.js') ?>"></script>
</body>
</html>