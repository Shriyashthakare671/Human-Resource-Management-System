<?php
    session_start();
    require "constants.php";
    require "blockchain/blockchain.php";

    $jsondata = new Block_chain;
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title><?php echo APP_NAME; ?></title>
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/vendor/bootstrap.css">
		<link rel="stylesheet" href="assets/vendor/metismenu/dist/metisMenu.css">
		<link rel="stylesheet" href="assets/vendor/switchery-npm/index.css">
		<link rel="stylesheet" href="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
		<link rel="stylesheet" href="assets/css/icons/line-awesome.min.css">
		<link rel="stylesheet" href="assets/css/icons/simple-line-icons.css">
		<link rel="stylesheet" href="assets/css/icons/dripicons.min.css">
		<link rel="stylesheet" href="assets/css/icons/material-design-iconic-font.min.css">
		<link rel="stylesheet" href="assets/css/bootstrap_datetimepicker.css" />
		<link rel="stylesheet" href="assets/css/common/main.bundle.css">
		<link rel="stylesheet" href="assets/vendor/fullcalendar/dist/fullcalendar.css">
		<link rel="stylesheet" href="assets/css/layouts/vertical/core/main.css">
		<link rel="stylesheet" href="assets/css/jquery-ui.css">
		<link rel="stylesheet" href="assets/css/layouts/vertical/menu-type/default.css">
		<link rel="stylesheet" href="assets/css/layouts/vertical/themes/theme-a.css">
		<link rel="stylesheet" href="assets/css/priority-nav-scroller.css">
		<link rel="stylesheet" href="assets/vendor/select2/select2.min.css">
		<link rel="stylesheet" href="assets/css/custom.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
		<style type="text/css">
			body, .swal2-title {
				font-family: 'Quicksand', sans-serif !important;
			}
			.btn-success {
				background-color: #000 !important;
			}
			.pagination .page-item.active .page-link {
				background-color: #000 !important;
				border-color: #000 !important;
			}
			body .sidebar.sidebar-left .sidebar-content .main-menu .nav.metismenu>li>a>i {
				color: #fff !important;	
			}
			body .aside-toolbar {
				background-color: #000 !important;
			}
			body .sidebar-left, body .sidebar-left .sidebar-content {
    			background-color: #000 !important;
			}
			body .sidebar.sidebar-left .sidebar-content .main-menu .nav.metismenu>li>a {
				color: #fff !important;
			}
			i {
			    color: #fff !important;
			}
		</style>
		<script src="assets/js/jquery.min.js"></script>
	</head>
	<body id="main_body">
	    <?php 
	        $userdata = (array) $_SESSION['userdata'];
	    ?>
		<div id="app">
			<aside class="sidebar sidebar-left">
				<div class="sidebar-content">
					<div class="aside-toolbar">
						<ul class="site-logo">
							<li>
								<a href="dashboard.php">
									<div class="logo">
										
									</div>
									<span class="brand-text"><?php echo APP_NAME; ?></span>
								</a>
							</li>
						</ul>
						<ul class="header-controls">
							<li class="nav-item">
								<button type="button" class="btn btn-link btn-menu" data-toggle-state="mini-sidebar">
									<i class="la la-dot-circle-o"></i>
								</button>
							</li>
						</ul>
					</div>
					<nav class="main-menu">
						<ul class="nav metismenu" id="menu-list">
							<li>
								<a href="dashboard.php"><i class="icon dripicons-help"></i>
									<span>Dashboard</span>
								</a>
							</li>
							<?php 
							    if(in_array($jsondata->data_decryption($userdata['usertype']),[1]))
							    {
							?>
						            <li>
        								<a href="users.php"><i class="icon dripicons-help"></i>
        									<span>Users</span>
        								</a>
        							</li>
        							<li>
        								<a href="interviews.php"><i class="icon dripicons-help"></i>
        									<span>Interviews</span>
        								</a>
        							</li>
        							<li>
        								<a href="feedbacks.php"><i class="icon dripicons-help"></i>
        									<span>Feedbacks</span>
        								</a>
        							</li>
							<?php
							    } else {
							?>
									<li>
        								<a href="other_users.php"><i class="icon dripicons-help"></i>
        									<span>Other Users</span>
        								</a>
        							</li>
        							<li>
        								<a href="past_companies.php"><i class="icon dripicons-help"></i>
        									<span>Post Companies</span>
        								</a>
        							</li>
							<?php
							    }
							 ?>	
							 <li>
								<a href="profile.php"><i class="icon dripicons-help"></i>
									<span>Profile</span>
								</a>
							</li>
							 <li>
								<a href="logout.php"><i class="icon dripicons-help"></i>
									<span>Logout</span>
								</a>
							</li>						
						</ul>
					</nav>
				</div>
			</aside>
			<div class="content-wrapper">
				<nav class="top-toolbar navbar navbar-mobile navbar-tablet">
					<ul class="navbar-nav nav-center">
						<li>
							<a href="dashboard.php">
								<div class="logo_mobile">
									<svg id="logo_mobile" width="27" height="27" viewBox="0 0 54.03 56.55">
										<defs>
											<linearGradient id="logo_background_mobile_color">
											<stop class="stop1" offset="0%"/>
											<stop class="stop2" offset="50%"/>
											<stop class="stop3" offset="100%"/>
										</linearGradient>
										</defs>
										<path id="logo_path_mobile" class="cls-2" d="M90.32,0c14.2-.28,22.78,7.91,26.56,18.24a39.17,39.17,0,0,1,1,4.17l.13,1.5A15.25,15.25,0,0,1,118.1,29v.72l-.51,3.13a30.47,30.47,0,0,1-3.33,8,15.29,15.29,0,0,1-2.5,3.52l.06.07c.57.88,1.43,1.58,2,2.41,1.1,1.49,2.36,2.81,3.46,4.3.41.55,1,1,1.41,1.56.68.92,1.16,1.89.32,3.06-.08.12-.08.24-.19.33a2.39,2.39,0,0,1-2.62.07,4.09,4.09,0,0,1-.7-.91c-.63-.85-1.41-1.61-2-2.48-1-1.42-2.33-2.67-3.39-4.1a16.77,16.77,0,0,1-1.15-1.37c-.11,0-.06,0-.13.07-.41.14-.65.55-1,.78-.72.54-1.49,1.08-2.24,1.56A29.5,29.5,0,0,1,97.81,53c-.83.24-1.6.18-2.5.39a16.68,16.68,0,0,1-3.65.26H90.58L88,53.36A36.87,36.87,0,0,1,82.71,52a27.15,27.15,0,0,1-15.1-14.66c-.47-1.1-.7-2.17-1.09-3.39-1-3-1.45-8.86-.51-12.38a29,29,0,0,1,2.56-7.36c3.56-6,7.41-9.77,14.08-12.57a34.92,34.92,0,0,1,4.8-1.3Zm.13,4.1c-.45.27-1.66.11-2.24.26a32.65,32.65,0,0,0-4.74,1.37A23,23,0,0,0,71,18.7,24,24,0,0,0,71.13,35c2.78,6.66,7.2,11.06,14.21,13.42,1.16.39,2.52.59,3.84.91l1.47.07a7.08,7.08,0,0,0,2.43,0H94c.89-.21,1.9-.28,2.75-.46V48.8A7.6,7.6,0,0,1,95.19,47c-.78-1-1.83-1.92-2.62-3s-1.86-1.84-2.62-2.87c-2-2.7-4.45-5.1-6.66-7.62-.57-.66-1.14-1.32-1.66-2-.22-.29-.59-.51-.77-.85a2.26,2.26,0,0,1,.58-2.61,2.39,2.39,0,0,1,2.24-.2,4.7,4.7,0,0,1,1.22,1.3l.51.46c.5.68,1,1.32,1.6,2,2.07,2.37,4.38,4.62,6.27,7.17.94,1.26,2.19,2.3,3.14,3.58l1,1c.82,1.1,1.8,2,2.62,3.13.26.35.65.6.9,1A23.06,23.06,0,0,0,105,45c.37-.27,1-.51,1.15-1h-.06c-.18-.51-.73-.83-1-1.24-.74-1-1.64-1.88-2.37-2.87-1.8-2.44-3.89-4.6-5.7-7-.61-.82-1.44-1.52-2-2.34-.85-1.16-3.82-3.73-1.54-5.41a2.27,2.27,0,0,1,1.86-.26c.9.37,2.33,2.43,2.94,3.26s1.27,1.31,1.79,2c1.44,1.95,3.11,3.66,4.54,5.6.41.55,1,1,1.41,1.56.66.89,1.46,1.66,2.11,2.54.29.39.61,1.06,1.09,1.24.54-1,1.34-1.84,1.92-2.8a25.69,25.69,0,0,0,2.5-6.32c1.27-4.51.32-10.37-1.15-13.81A22.48,22.48,0,0,0,100.75,5.94a35.12,35.12,0,0,0-6.08-1.69A20.59,20.59,0,0,0,90.45,4.11Z" transform="translate(-65.5)" fill="url(#logo_background_mobile_color)"/>
									</svg>
								</div>
								<span class="brand-text"></span>
							</a>
						</li>
					</ul>
					<ul class="navbar-nav nav-right">
						<li class="nav-item">
							<a href="javascript:void(0)" data-toggle-state="mobile-topbar-toggle">
								<i class="icon dripicons-dots-3 rotate-90"></i>
							</a>
						</li>
					</ul>
				</nav>
				<nav class="top-toolbar navbar navbar-desktop flex-nowrap">
					<ul class="navbar-nav nav-right">
						<li class="nav-item dropdown">
							<a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
								<img src="assets/img/icon.jpeg" class="w-35 rounded-circle" alt="Albert Einstein">
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-accout">
								<div class="dropdown-header pb-3">
									<div class="media d-user">
										<img class="align-self-center mr-3 w-40 rounded-circle" src="assets/img/icon.jpeg" alt="Albert Einstein">
										<div class="media-body">
											<h5 class="mt-0 mb-0">
												<?php 
												    echo ucwords($jsondata->data_decryption($userdata['name']));
												?>
											</h5>
											<span><?php echo $jsondata->data_decryption($userdata['email']); ?></span>
										</div>
									</div>
								</div>
								<?php 
								    if(in_array($jsondata->data_decryption($userdata['usertype']),[2]))
								    {

								?>
										<a class="dropdown-item" href="assets/uploads/<?php echo $userdata['resume']; ?>" download><i class="icon dripicons-lock-open"></i> Download Resume</a>
								<?php 
									}
								?>
								<a class="dropdown-item" href="logout.php"><i class="icon dripicons-lock-open"></i> Sign Out</a>
								<!-- <div class="dropdown-divider"></div> -->
							</div>
						</li>
					</ul>
				</nav>