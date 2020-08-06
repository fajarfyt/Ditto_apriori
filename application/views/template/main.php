<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Coffee's@Dito</title>

	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">

	<!-- Custom styles for this page -->
	<link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/OwlCarousel2/dist/assets/owl.carousel.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/OwlCarousel2/dist/assets/owl.theme.default.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/OwlCarousel2/dist/assets/owl.theme.green.min.css') ?>">
</head>

<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('index.php/order') ?>">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-coffee"></i>
				</div>
				<div class="sidebar-brand-text mx-3">Coffe's<sup>@</sup>Dito</div>
			</a>
			<!-- Divider -->
			<hr class="sidebar-divider my-0">
			<!-- Nav Item - Dashboard -->
			<!-- <li class="nav-item active">
				<a class="nav-link" href="<?php //echo base_url('index.php/home') ?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span>
				</a>
			</li> -->
			<!-- Divider -->
			<hr class="sidebar-divider my-0">
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('index.php/order') ?>">
					<i class="fas fa-fw fa-clipboard-list"></i>
					<span>Order</span>
				</a>
			</li>
			<!-- Divider -->
			<hr class="sidebar-divider">
			<!-- Heading -->
			<div class="sidebar-heading">
				Master
			</div>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('index.php/menu') ?>">
					<i class="fas fa-fw fa-mug-hot"></i>
					<span>Daftar Menu</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('index.php/kategori') ?>">
					<i class="fas fa-fw fa-box-open"></i>
					<span>Daftar Kategori</span>
				</a>
			</li>
			<hr class="sidebar-divider my-0">
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('index.php/apriori') ?>">
					<i class="fas fa-fw fa-clipboard-list"></i>
					<span>Buat Paket</span>
				</a>
			</li>


			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">
			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content">
				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>
					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">
						<div class="topbar-divider d-none d-sm-block"></div>
						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
								<img class="img-profile rounded-circle" src="<?php echo base_url('assets/img/settings.png') ?>">
							</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                				<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                					<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                					Logout
                				</a>
                			</div>
                		</li>
                	</ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                	<!-- CONTENT -->
                	<?php 
                		$this->load->view($content);
                	?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
            	<div class="container my-auto">
            		<div class="copyright text-center my-auto">
            			<span>Copyright &copy; Coffee's@Dito</span>
            		</div>
            	</div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
    	<i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
    				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">×</span>
    				</button>
    			</div>
    			<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
    			<div class="modal-footer">
    				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
    				<a class="btn btn-primary" href="<?php echo base_url('index.php/auth/logout') ?>">Logout</a>
    			</div>
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
	<!-- Page level plugins -->
	<script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/vendor/chart.js/Chart.min.js') ?>"></script>

	<!-- Page level custom scripts -->
	<script src="<?php echo base_url('assets/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/demo/chart-area-demo.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/demo/chart-pie-demo.js') ?>"></script>
	<script src="<?php echo base_url('assets/OwlCarousel2/dist/owl.carousel.min.js') ?>"></script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('.add_cart').click(function(){
				console.log('hello');
		        var product_id    = $(this).data("productid");
		        var product_name  = $(this).data("productname");
		        var product_price = $(this).data("productprice");
		        var quantity      = $('#' + product_id).val();
		        $.ajax({
		        	url : "<?php echo base_url('index.php/order/add_to_cart');?>",
		        	method : "POST",
		        	data : {
		        		product_id: product_id, 
		                product_name: product_name, 
		                product_price: product_price, 
		                quantity: quantity
		            },
			        success: function(data){
	                	$('#detail_cart').html(data);
	                }
	            });
		    });

		    $('#detail_cart').load("<?php echo base_url('index.php/order/load_cart');?>");

		    $(document).on('click','.romove_cart',function(){
		    	var row_id=$(this).attr("id"); 
		    	$.ajax({
		    		url : "<?php echo site_url('order/delete_cart');?>",
		    		method : "POST",
		    		data : {row_id : row_id},
		    		success :function(data){
		    			$('#detail_cart').html(data);
		    		}
		    	});
		    });

		    $(document).ready(function(){
		    	$(".owl-carousel").owlCarousel({
		    		margin: 10,
		    		nav: true,
		    		responsive:{
		    			0:{
		    				items:1
		    			},
		    			600:{
		    				items:2
		    			},
		    			960:{
		    				items:3
		    			},
		    			1200:{
		    				items:4
		    			}
		    		}
		    	});
		    });

		    $(document).on("click", ".open-AddBookDialog", function () {
				var id_assoc = $(this).data('id');
				$(".modal-body #bookId").val( id_assoc );
				let url = "<?php echo site_url('apriori/fajar/');?>"
				$.ajax({
		    		url : url+id_assoc,
		    		method : "GET",
		    		success :function(data){
		    			data = JSON.parse(data);
		    			$('#total_tod').val(data.data.total);
		    			console.log(data);
		    			// $()
		    		}
		    	});
			});
		});
	</script>
</body>
</html>
