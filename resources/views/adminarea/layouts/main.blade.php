<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>@yield('title')</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="/adminUi/assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="/adminUi/assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="/adminUi/assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="/adminUi/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="/adminUi/assets/stylesheets/theme.css" />

		<!-- Style CSS -->
		<link rel="stylesheet" href="/adminUi/assets/stylesheets/style.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="/adminUi/assets/stylesheets/skins/default.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="/adminUi/assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="/adminUi/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

		<!-- Datatables -->
		<link rel="stylesheet" href="/adminUi/assets/datatables/css/bootstrap.min.css">
		<link rel="stylesheet" href="/adminUi/assets/datatables/css/bootstrap-editable.css">  
		<link rel="stylesheet" href="/adminUi/assets/datatables/css/bootstrap-table.css">    
	  
		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="/adminUi/assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="/adminUi/assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="#" class="logo">
						<h4 style="color: black;">MINSU.ID</h4>
						{{-- <img src="/adminUi/assets/images/logo.png" height="35" alt="Porto Admin" /> --}}
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="/adminUi/#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="{{ asset('storage/images/profile/'.Auth::user()->image_profile) }}" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name">{{ Auth::user()->name }}</span>
								<span class="role">{{ Auth::user()->roles->role_name }}</span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="/admin-area/staff/change-password/{{ Auth::user()->id }}"><i class="fa fa-lock"></i> Ganti Password</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="/administrator/logout"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
					<div class="sidebar-header">
						<div class="sidebar-title">
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li>
										<a href="/administrator/dashboard">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li>
										<a href="/admin-area/customer">
											<i class="fa fa-users" aria-hidden="true"></i>
											<span>Customer</span>
										</a>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-cubes" aria-hidden="true"></i>
											<span>Produk</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="/admin-area/products">
													 Data Produk
												</a>
											</li>
											<li>
												<a href="/admin-area/stocks">
													 Stok
												</a>
											</li>
										</ul>
									</li>
									<li>
										<a href="/admin-area/category">
											<i class="fa fa-tasks" aria-hidden="true"></i>
											<span>Kategori</span>
										</a>
									</li>
									@if (Auth::user()->role_id == 1)
										<li>
											<a href="/admin-area/staff">
												<i class="fa fa-user" aria-hidden="true"></i>
												<span>Staff</span>
											</a>
										</li>										
									@endif
									<li>
										<a href="/admin-area/transaction">
											<i class="fa fa-dollar" aria-hidden="true"></i>
											<span>Transaksi</span>
										</a>
									</li>										
									<li>
										<a href="#">
											<i class="fa fa-file-text" aria-hidden="true"></i>
											<span>Laporan</span>
										</a>
									</li>
									<li>
										<a href="/administrator/logout">
											<i class="fa fa-power-off" aria-hidden="true"></i>
											<span>Logout</span>
										</a>
									</li>
								</ul>
							</nav>
						</div>
				
					</div>
				
				</aside>
				<!-- end: sidebar -->

				<!-- Start Content -->
					@yield('dashboardAdminArea')

					@yield('customerAdminArea')
					@yield('editCustomerAdminArea')
					@yield('showDeletedCustomerAdminArea')

					@yield('productAdminArea')
					@yield('addProductAdminArea')
					@yield('editProductAdminArea')
					@yield('showDeletedProductAdminArea')

					@yield('stockAdminArea')
					@yield('editStockAdminArea')

					@yield('categoryAdminArea')
					@yield('addCategoryAdminArea')
					@yield('editCategoryAdminArea')
					@yield('showDeletedCategoryAdminArea')

					@yield('staffAdminArea')
					@yield('addStaffAdminArea')
					@yield('editStaffAdminArea')
					@yield('changePasswordStaff')

					@yield('transactionAdminArea')
					@yield('transactionDetailAdminArea')
					@yield('invoiceAdminArea')
					@yield('showDeletedTransactionAdminArea')
				<!-- End Content -->
			</div>

		</section>
		<!-- Vendor -->
		<script src="/adminUi/assets/vendor/jquery/jquery.js"></script>
		<script src="/adminUi/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="/adminUi/assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="/adminUi/assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="/adminUi/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="/adminUi/assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="/adminUi/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

		<!-- Datatables -->
		<script src="/adminUi/assets/datatables/js/bootstrap-table.js"></script>
		<script src="/adminUi/assets/datatables/js/tableExport.js"></script>
		<script src="/adminUi/assets/datatables/js/data-table-active.js"></script>
		<script src="/adminUi/assets/datatables/js/bootstrap-table-editable.js"></script>
		<script src="/adminUi/assets/datatables/js/bootstrap-editable.js"></script>
		<script src="/adminUi/assets/datatables/js/bootstrap-table-resizable.js"></script>
		<script src="/adminUi/assets/datatables/js/colResizable-1.5.source.js"></script>
		<script src="/adminUi/assets/datatables/js/bootstrap-table-export.js"></script>
	
		<!-- Specific Page Vendor -->
		<script src="/adminUi/assets/vendor/select2/select2.js"></script>
		<script src="/adminUi/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="/adminUi/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="/adminUi/assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="/adminUi/assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="/adminUi/assets/javascripts/theme.init.js"></script>

		<!-- Flash Message -->
		<script type="text/javascript">window.setTimeout("document.getElementById('flashMessage').style.display='none';", 5000); </script>

		{{-- <!-- Examples -->
		<script src="/adminUi/assets/javascripts/tables/examples.datatables.editable.js"></script> --}}
	</body>
</html>