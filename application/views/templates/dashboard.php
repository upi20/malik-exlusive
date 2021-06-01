<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->



<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?= $this->setting->index()['app_title'] ?></title>
	<link rel="icon" type="image/ico" href="<?= base_url() ?>assets/admin/non-angular/assets/images/favicon.ico" />
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">




	<!-- ============================================
		================= Stylesheets ===================
		============================================= -->
	<!-- vendor css files -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/css/vendor/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/css/vendor/animate.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/css/vendor/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/daterangepicker/daterangepicker-bs3.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/morris/morris.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/owl-carousel/owl.carousel.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/owl-carousel/owl.theme.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/rickshaw/rickshaw.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/datatables/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/datatables/datatables.bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/chosen/chosen.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/summernote/summernote.css">

	<!-- project main css files -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/toastr/toastr.min.css"> <!-- fungsi alert -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/admin/non-angular/assets/css/main.css">
	<!--/ stylesheets -->

	<?php if (!empty($plugin_styles)) : ?>
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<?php foreach ($plugin_styles as $style) : ?>
			<link href="<?= $style ?>" rel="stylesheet" type="text/css" />
		<?php endforeach; ?>
		<!-- END PAGE LEVEL PLUGINS -->
	<?php endif; ?>


	<!-- ==========================================
		================= Modernizr ===================
		=========================================== -->
	<script src="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	<!--/ modernizr -->

</head>

<body id="minovate" class="appWrapper">


	<!-- ====================================================
		================= Application Content ===================
		===================================================== -->
	<div id="wrap" class="animsition">






		<!-- ===============================================
			================= HEADER Content ===================
			================================================ -->
		<section id="header" style="background-color: #2B333E;">
			<header class="clearfix">

				<!-- Branding -->
				<div class="branding" style="background-color: #2B333E;">
					<a class="brand" href="<?= base_url() ?>">
						<span><strong><?= $this->setting->index()['app_name'] ?></strong> </span>
						<!-- <img src="" style="width: 75%;"> -->
					</a>
					<a role="button" tabindex="0" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a>
				</div>
				<!-- Branding end -->


				<!-- Right-side navigation -->
				<ul class="nav-right pull-right list-inline">


					<li class="dropdown nav-profile">

						<a href class="dropdown-toggle" data-toggle="dropdown">
							<span><?= $this->session->userdata('data')['nama'] ?> <i class="fa fa-angle-down"></i></span>
						</a>

						<ul class="dropdown-menu animated littleFadeInRight" role="menu">

							<li>
								<a role="button" tabindex="0" href="<?= base_url() ?>profile/data">
									<span class="badge bg-greensea pull-right"></span>
									<i class="fa fa-user"></i>Profile
								</a>
							</li>

							<li class="divider"></li>

							<li>
								<a role="button" href="<?= base_url() ?>login/logout" tabindex="0">
									<i class="fa fa-sign-out"></i>Logout
								</a>
							</li>

						</ul>

					</li>

				</ul>
				<!-- Right-side navigation end -->



			</header>

		</section>
		<!--/ HEADER Content  -->





		<!-- =================================================
			================= CONTROLS Content ===================
			================================================== -->
		<div id="controls">





			<!-- ================================================
				================= SIDEBAR Content ===================
				================================================= -->
			<?php $this->load->view('templates/navigation'); ?>

			<!--/ SIDEBAR Content -->





			<!-- =================================================
				================= RIGHTBAR Content ===================
				================================================== -->
			<aside id="rightbar">

				<div role="tabpanel">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="<?= base_url() ?>assets/admin/non-angular/#users" aria-controls="users" role="tab" data-toggle="tab"><i class="fa fa-users"></i></a></li>
						<li role="presentation"><a href="<?= base_url() ?>assets/admin/non-angular/#history" aria-controls="history" role="tab" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
						<li role="presentation"><a href="<?= base_url() ?>assets/admin/non-angular/#friends" aria-controls="friends" role="tab" data-toggle="tab"><i class="fa fa-heart"></i></a></li>
						<li role="presentation"><a href="<?= base_url() ?>assets/admin/non-angular/#settings" aria-controls="settings" role="tab" data-toggle="tab"><i class="fa fa-cog"></i></a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="users">
							<h6><strong>Online</strong> Users</h6>

							<ul>

								<li class="online">
									<div class="media">
										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/ici-avatar.jpg" alt> -->
										</a>
										<div class="media-body">
											<span class="media-heading">Ing. Imrich <strong>Kamarel</strong></span>
											<small><i class="fa fa-map-marker"></i> Ulaanbaatar, Mongolia</small>
											<span class="badge badge-outline status"></span>
										</div>
									</div>
								</li>

								<li class="online">
									<div class="media">

										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/arnold-avatar.jpg" alt> -->
										</a>
										<span class="badge bg-lightred unread">3</span>

										<div class="media-body">
											<span class="media-heading">Arnold <strong>Karlsberg</strong></span>
											<small><i class="fa fa-map-marker"></i> Bratislava, Slovakia</small>
											<span class="badge badge-outline status"></span>
										</div>

									</div>
								</li>

								<li class="online">
									<div class="media">
										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/peter-avatar.jpg" alt> -->
										</a>
										<div class="media-body">
											<span class="media-heading">Peter <strong>Kay</strong></span>
											<small><i class="fa fa-map-marker"></i> Kosice, Slovakia</small>
											<span class="badge badge-outline status"></span>
										</div>
									</div>
								</li>

								<li class="online">
									<div class="media">
										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/george-avatar.jpg" alt> -->
										</a>
										<div class="media-body">
											<span class="media-heading">George <strong>McCain</strong></span>
											<small><i class="fa fa-map-marker"></i> Prague, Czech Republic</small>
											<span class="badge badge-outline status"></span>
										</div>
									</div>
								</li>

								<li class="busy">
									<div class="media">
										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/random-avatar1.jpg" alt> -->
										</a>
										<div class="media-body">
											<span class="media-heading">Lucius <strong>Cashmere</strong></span>
											<small><i class="fa fa-map-marker"></i> Wien, Austria</small>
											<span class="badge badge-outline status"></span>
										</div>
									</div>
								</li>

								<li class="busy">
									<div class="media">
										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/random-avatar2.jpg" alt> -->
										</a>
										<div class="media-body">
											<span class="media-heading">Jesse <strong>Phoenix</strong></span>
											<small><i class="fa fa-map-marker"></i> Berlin, Germany</small>
											<span class="badge badge-outline status"></span>
										</div>
									</div>
								</li>

							</ul>

							<h6><strong>Offline</strong> Users</h6>

							<ul>

								<li class="offline">
									<div class="media">
										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/random-avatar4.jpg" alt> -->
										</a>
										<div class="media-body">
											<span class="media-heading">Dell <strong>MacApple</strong></span>
											<small><i class="fa fa-map-marker"></i> Paris, France</small>
											<span class="badge badge-outline status"></span>
										</div>
									</div>
								</li>

								<li class="offline">
									<div class="media">

										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/random-avatar5.jpg" alt> -->
										</a>

										<div class="media-body">
											<span class="media-heading">Roger <strong>Flopple</strong></span>
											<small><i class="fa fa-map-marker"></i> Rome, Italia</small>
											<span class="badge badge-outline status"></span>
										</div>

									</div>
								</li>

								<li class="offline">
									<div class="media">
										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/random-avatar6.jpg" alt> -->
										</a>
										<div class="media-body">
											<span class="media-heading">Nico <strong>Vulture</strong></span>
											<small><i class="fa fa-map-marker"></i> Kyjev, Ukraine</small>
											<span class="badge badge-outline status"></span>
										</div>
									</div>
								</li>

								<li class="offline">
									<div class="media">
										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/random-avatar7.jpg" alt> -->
										</a>
										<div class="media-body">
											<span class="media-heading">Bobby <strong>Socks</strong></span>
											<small><i class="fa fa-map-marker"></i> Moscow, Russia</small>
											<span class="badge badge-outline status"></span>
										</div>
									</div>
								</li>

								<li class="offline">
									<div class="media">
										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/random-avatar8.jpg" alt> -->
										</a>
										<div class="media-body">
											<span class="media-heading">Anna <strong>Opichia</strong></span>
											<small><i class="fa fa-map-marker"></i> Budapest, Hungary</small>
											<span class="badge badge-outline status"></span>
										</div>
									</div>
								</li>

							</ul>
						</div>

						<div role="tabpanel" class="tab-pane" id="history">
							<h6><strong>Chat</strong> History</h6>

							<ul>

								<li class="online">
									<div class="media">
										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/ici-avatar.jpg" alt> -->
										</a>
										<div class="media-body">
											<span class="media-heading">Ing. Imrich <strong>Kamarel</strong></span>
											<small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor</small>
											<span class="badge badge-outline status"></span>
										</div>
									</div>
								</li>

								<li class="busy">
									<div class="media">

										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/arnold-avatar.jpg" alt> -->
										</a>
										<span class="badge bg-lightred unread">3</span>

										<div class="media-body">
											<span class="media-heading">Arnold <strong>Karlsberg</strong></span>
											<small>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</small>
											<span class="badge badge-outline status"></span>
										</div>

									</div>
								</li>

								<li class="offline">
									<div class="media">
										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/peter-avatar.jpg" alt> -->
										</a>
										<div class="media-body">
											<span class="media-heading">Peter <strong>Kay</strong></span>
											<small>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit </small>
											<span class="badge badge-outline status"></span>
										</div>
									</div>
								</li>

							</ul>
						</div>

						<div role="tabpanel" class="tab-pane" id="friends">
							<h6><strong>Friends</strong> List</h6>
							<ul>

								<li class="online">
									<div class="media">

										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/arnold-avatar.jpg" alt> -->
										</a>
										<span class="badge bg-lightred unread">3</span>

										<div class="media-body">
											<span class="media-heading">Arnold <strong>Karlsberg</strong></span>
											<small><i class="fa fa-map-marker"></i> Bratislava, Slovakia</small>
											<span class="badge badge-outline status"></span>
										</div>

									</div>
								</li>

								<li class="offline">
									<div class="media">
										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/random-avatar8.jpg" alt> -->
										</a>
										<div class="media-body">
											<span class="media-heading">Anna <strong>Opichia</strong></span>
											<small><i class="fa fa-map-marker"></i> Budapest, Hungary</small>
											<span class="badge badge-outline status"></span>
										</div>
									</div>
								</li>

								<li class="busy">
									<div class="media">
										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/random-avatar1.jpg" alt> -->
										</a>
										<div class="media-body">
											<span class="media-heading">Lucius <strong>Cashmere</strong></span>
											<small><i class="fa fa-map-marker"></i> Wien, Austria</small>
											<span class="badge badge-outline status"></span>
										</div>
									</div>
								</li>

								<li class="online">
									<div class="media">
										<a class="pull-left thumb thumb-sm" role="button" tabindex="0">
											<!-- <img class="media-object img-circle" src="<?= base_url() ?>assets/admin/non-angular/assets/images/ici-avatar.jpg" alt> -->
										</a>
										<div class="media-body">
											<span class="media-heading">Ing. Imrich <strong>Kamarel</strong></span>
											<small><i class="fa fa-map-marker"></i> Ulaanbaatar, Mongolia</small>
											<span class="badge badge-outline status"></span>
										</div>
									</div>
								</li>

							</ul>
						</div>

						<div role="tabpanel" class="tab-pane" id="settings">
							<h6><strong>Chat</strong> Settings</h6>

							<ul class="settings">

								<li>
									<div class="form-group">
										<label class="col-xs-8 control-label">Show Offline Users</label>
										<div class="col-xs-4 control-label">
											<div class="onoffswitch greensea">
												<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="show-offline" checked="">
												<label class="onoffswitch-label" for="show-offline">
													<span class="onoffswitch-inner"></span>
													<span class="onoffswitch-switch"></span>
												</label>
											</div>
										</div>
									</div>
								</li>

								<li>
									<div class="form-group">
										<label class="col-xs-8 control-label">Show Fullname</label>
										<div class="col-xs-4 control-label">
											<div class="onoffswitch greensea">
												<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="show-fullname">
												<label class="onoffswitch-label" for="show-fullname">
													<span class="onoffswitch-inner"></span>
													<span class="onoffswitch-switch"></span>
												</label>
											</div>
										</div>
									</div>
								</li>

								<li>
									<div class="form-group">
										<label class="col-xs-8 control-label">History Enable</label>
										<div class="col-xs-4 control-label">
											<div class="onoffswitch greensea">
												<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="show-history" checked="">
												<label class="onoffswitch-label" for="show-history">
													<span class="onoffswitch-inner"></span>
													<span class="onoffswitch-switch"></span>
												</label>
											</div>
										</div>
									</div>
								</li>

								<li>
									<div class="form-group">
										<label class="col-xs-8 control-label">Show Locations</label>
										<div class="col-xs-4 control-label">
											<div class="onoffswitch greensea">
												<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="show-location" checked="">
												<label class="onoffswitch-label" for="show-location">
													<span class="onoffswitch-inner"></span>
													<span class="onoffswitch-switch"></span>
												</label>
											</div>
										</div>
									</div>
								</li>

								<li>
									<div class="form-group">
										<label class="col-xs-8 control-label">Notifications</label>
										<div class="col-xs-4 control-label">
											<div class="onoffswitch greensea">
												<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="show-notifications">
												<label class="onoffswitch-label" for="show-notifications">
													<span class="onoffswitch-inner"></span>
													<span class="onoffswitch-switch"></span>
												</label>
											</div>
										</div>
									</div>
								</li>

								<li>
									<div class="form-group">
										<label class="col-xs-8 control-label">Show Undread Count</label>
										<div class="col-xs-4 control-label">
											<div class="onoffswitch greensea">
												<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="show-unread" checked="">
												<label class="onoffswitch-label" for="show-unread">
													<span class="onoffswitch-inner"></span>
													<span class="onoffswitch-switch"></span>
												</label>
											</div>
										</div>
									</div>
								</li>

							</ul>
						</div>
					</div>

				</div>

			</aside>
			<!--/ RIGHTBAR Content -->

		</div>
		<!--/ CONTROLS Content -->

		<!-- ====================================================
			================= CONTENT ===============================
			===================================================== -->
		<?php if (file_exists(VIEWPATH . "templates/contents/$content.php")) : ?>
			<?php $this->load->view("templates/contents/$content.php"); ?>
		<?php endif; ?>
		<!--/ CONTENT -->

	</div>
	<!--/ Application Content -->

	<!-- modal hapus -->
	<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title custom-font" id="labelHapus"></h3>
				</div>
				<div class="modal-body" id="contentHapus">
				</div>
				<div class="modal-footer">
					<button id="clickHapus" class="btn btn-success btn-ef btn-ef-3 btn-ef-3c"><i class="fa fa-arrow-right"></i> Ya</button>

					<button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Tidak</button>
				</div>
				<input type="hidden" id="idHapus" name="">
			</div>
		</div>
	</div>
	<!-- ============================================
		============== Vendor JavaScripts ===============
		============================================= -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
		window.jQuery || document.write('<script src="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')
	</script>

	<script src="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/bootstrap/bootstrap.min.js"></script>

	<script src="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/jRespond/jRespond.min.js"></script>

	<script src="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

	<script src="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

	<script src="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

	<script src="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/daterangepicker/daterangepicker.js"></script>

	<script src="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/screenfull/screenfull.min.js"></script>

	<script src="<?= base_url() ?>assets/admin/non-angular/assets/js/vendor/toastr/toastr.min.js"></script>

	<!-- ============================================
		============== Custom JavaScripts ===============
		============================================= -->
	<script src="<?= base_url() ?>assets/admin/non-angular/assets/js/main.js"></script>
	<!--/ custom javascripts -->
	<script src="<?= $this->plugin->build_url("javascripts/api-client.js", FALSE, 'site') ?>" type="text/javascript"></script>
	<script src="<?= $this->plugin->build_url("javascripts/application.js", FALSE, 'site') ?>" type="text/javascript"></script>
	<!-- PAGE RELATED PLUGIN(S) -->
	<?php if (!empty($plugin_scripts)) : ?>
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<?php foreach ($plugin_scripts as $script) : ?>
			<script src="<?= $script ?>" type="text/javascript"></script>
		<?php endforeach; ?>
		<!-- END PAGE LEVEL PLUGINS -->
	<?php endif; ?>

	<script type="text/javascript">
		$(document).ready(function() {
			$.sound_path = '<?= base_url() ?>assets/sound/';

		});
	</script>

	<?php if (file_exists(VIEWPATH . "javascripts/page.$content.js")) : ?>
		<script src="<?= $this->plugin->build_url("javascripts/page.$content.js") ?>" type="text/javascript"></script>
	<?php endif; ?>




	<!-- ===============================================
		============== Page Specific Scripts ===============
		================================================ -->


	<!--/ Page Specific Scripts -->

</body>

</html>