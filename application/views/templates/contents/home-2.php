<!-- ====================================================
			================= CONTENT ===============================
			===================================================== -->
			<section id="content">

				<div class="page page-dashboard">

					<div class="pageheader">

						<!-- <h2>Dashboard <span></span></h2> -->

						<div class="page-bar">

							<ul class="page-breadcrumb">
								<li>
									<a href=""><i class="fa fa-home"></i> Dashboard</a>
								</li>
								<li>
									<a href="">Dashboard</a>
								</li>
							</ul>

							<div class="page-toolbar">

							</div>

						</div>

					</div>

					
					<!-- cards row -->
					<div class="row">

						<!-- col -->
						<div class="card-container col-lg-4 col-sm-6 col-sm-12">
							<div class="card">
								
                            <!-- tile -->
                            <section class="tile tile-simple tbox">

                                <!-- tile widget -->
                                <div class="tile-widget bg-blue text-center p-30 tcol">
                                <a href class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-home"></i></a>
                                </div>
                                <!-- /tile widget -->

                                <!-- tile body -->
                                <div class="tile-body text-center tcol"><br>
									<p style="center">
                                    <h4 class="m-0"><?=$total_produk?></h4>
                                    <span class="text-muted">Total Produk</span>
									</p>
                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->
							</div>
						</div>
						<!-- /col -->

						<div class="card-container col-lg-4 col-sm-6 col-sm-12">
							<div class="card">
                            <!-- tile -->
								<section class="tile tile-simple tbox">
									<!-- tile widget -->
									<div class="tile-widget bg-blue text-center p-30 tcol">
										<a href class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-cubes"></i></a>
									</div>
									<!-- /tile widget -->
									<!-- tile body -->
									<div class="tile-body text-center tcol">
										<br>
										<p style="center">
										<h4 class="m-0"><?=$total_stok?></h4>
										<span class="text-muted">Total Stok</span>
										</p>
									</div>
									<!-- /tile body -->
								</section>
                            <!-- /tile -->
							</div>
						</div>

						<!-- col -->
					<div class="card-container col-lg-4 col-sm-6 col-sm-12">
							<div class="card">
								
                            <!-- tile -->
								<section class="tile tile-simple tbox">

									<!-- tile widget -->
									<div class="tile-widget bg-info text-center p-30 tcol">
									<a href class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-archive"></i></a>
									</div>
									<!-- /tile widget -->

									<!-- tile body -->
									<div class="tile-body text-center tcol">
										<br>
										<p style="center">
											<h4 class="m-0"><?=$this->libs->rupiah_non($total_nominal_penjualan)?></h4>
											<span class="text-muted">Total Penjualan</span>
										</p>
									</div>
									<!-- /tile body -->

								</section>
                            <!-- /tile -->
							</div>
						</div>

						<!-- /col -->
					</div>
					<!-- /row -->


				</div>

			
			</section>
			<!--/ CONTENT -->
