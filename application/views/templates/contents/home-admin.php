<!-- ====================================================
			================= CONTENT ===============================
			===================================================== -->

<style>
	.card-tagihan {
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
		transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
		margin: 3px;
	}

	.card-tagihan:hover {
		box-shadow: 0 5px 5px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
	}
</style>
<section id="content">

	<div class="page page-tables-datatables">
		<!-- tile -->
		<section class="tile">
			<!-- tile header -->
			<div class="tile-header dvd dvd-btm">
				<h1 class="custom-font"><strong>Filter</strong> Data</h1>
				<ul class="controls">
					<li class="dropdown">

						<a role="button" tabindex="0" class="tile-toggle">
							<span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
							<span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
						</a>

					</li>
				</ul>
			</div>
			<!-- /tile header -->

			<!-- tile body -->
			<div class="tile-body">
				<form method="get" action="<?= base_url() ?>">
					<div class="row">
						<div class="col-md-4">
							<div class="row"></div>
						</div>
						<div class="col-md-3">
							<div class='input-group' data-format="">
								<input type='date' placeholder="Pilih Tanggal Mulai" class="form-control" id="filter_tanggal_mulai" name="filter_tanggal_mulai" value="<?= $tanggal_mulai ?>" />
							</div>
						</div>
						<div class="col-md-3">
							<div class='input-group ' data-format="L">
								<input type='date' placeholder="Pilih Tanggal Akhir" class="form-control" id="filter_tanggal_akhir" name="filter_tanggal_akhir" value="<?= $tanggal_akhir ?>" />
							</div>
						</div>
						<div class="col-md-2">
							<!-- <a href class="myIcon icon-hotpink icon-ef-9 icon-color"><i class="fa fa-umbrella"></i></a> -->
							<button class="btn btn-ef btn-ef-1-success btn-ef-1 btn-ef-1d btn-md" type="submit"><i class="fa fa-arrow-right"></i> Cari</button>

						</div>
					</div>
				</form>
			</div>
			<!-- /tile body -->

		</section>

		<!-- Jumlah penjualan harian -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">

				<section class="tile">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font"><strong>Highlight status </strong>penjualan</h1>

					</div>
					<!-- /tile header -->
					<!-- tile body -->
					<div class="tile-body">
						<div class="row">
							<!-- col -->
							<div class="col-md-12">

								<div class="card-container col-lg-3 col-sm-6 col-sm-12">
									<div class="card shadow-sm card-tagihan">
										<!-- tile -->
										<section class="tile tile-simple tbox">
											<!-- tile widget -->
											<div class="tile-widget bg-blue text-center p-30 tcol">
												<a href class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-home"></i></a>
											</div>
											<!-- /tile widget -->
											<!-- tile body -->
											<div class="tile-body text-center tcol"><br>
												<p style="text-align:center">
												<h4 class="m-0"><?php echo $penjualan['proses']; ?></h4>
												<span class="text-muted">Proses</span>
												</p>
											</div>
											<!-- /tile body -->
										</section>
										<!-- /tile -->
									</div>
								</div>


								<div class="card-container col-lg-3 col-sm-6 col-sm-12">
									<div class="card shadow-sm card-tagihan">
										<!-- tile -->
										<section class="tile tile-simple tbox">
											<!-- tile widget -->
											<div class="tile-widget bg-blue text-center p-30 tcol">
												<a href class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-home"></i></a>
											</div>
											<!-- /tile widget -->
											<!-- tile body -->
											<div class="tile-body text-center tcol"><br>
												<p style="text-align:center">
												<h4 class="m-0"><?php echo $penjualan['kirim']; ?></h4>
												<span class="text-muted">Kirim</span>
												</p>
											</div>
											<!-- /tile body -->
										</section>
										<!-- /tile -->
									</div>
								</div>


								<div class="card-container col-lg-3 col-sm-6 col-sm-12">
									<div class="card shadow-sm card-tagihan">
										<!-- tile -->
										<section class="tile tile-simple tbox">
											<!-- tile widget -->
											<div class="tile-widget bg-blue text-center p-30 tcol">
												<a href class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-home"></i></a>
											</div>
											<!-- /tile widget -->
											<!-- tile body -->
											<div class="tile-body text-center tcol"><br>
												<p style="text-align:center">
												<h4 class="m-0"><?php echo $penjualan['retur']; ?></h4>
												<span class="text-muted">Retur</span>
												</p>
											</div>
											<!-- /tile body -->
										</section>
										<!-- /tile -->
									</div>
								</div>


								<!-- /col -->
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<!-- /tile body -->
	</div>
	<!-- /col -->

</section>
<!--/ CONTENT -->