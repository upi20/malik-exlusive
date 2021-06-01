<section id="content">

	<div class="page page-tables-datatables">
		<div class="pageheader">

			<div class="page-bar">

				<ul class="page-breadcrumb">
					<li>
						<a href="<?= base_url() ?>"><i class="fa fa-home"></i> Dashboard</a>
					</li>
					<li>
						<a href="#">Laporan</a>
					</li>
					<li>
						<a href="<?= base_url() ?>laporan/penjualan">Penjualan</a>
					</li>
				</ul>

			</div>

		</div>

		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">
				<!-- tile -->


				<!-- tile -->
				<section class="tile">

					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">Data <strong>Laporan - Penjualan</strong></h1>
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
						<div class="row">
							<div class="col-md-8">
							</div>
							<div class="col-md-4">
								<!-- <a href="<?= base_url() ?>laporan/penjualan/cetakPdf"><button style="float: right;" class="btn btn-primary mb-10"><span>Cetak PDF</span></button></a> -->
								<a href="<?= base_url() ?>laporan/penjualan/export_excel"><button style="float: right;" class="btn btn-success mb-10"> <span>Cetak Excel</span></button></a>
							</div>
						</div>
						<br>
						<table class="table table-custom" id="advanced-usage">
							<thead>
								<tr>
									<th>ID</th>
									<th>Total Harga</th>
									<th>Dibayar</th>
									<th>Sisa</th>
									<th>Tanggal Transaksi</th>
									<!-- <th>Tanggal Pengiriman</th> -->
									<th>Keterangan</th>
								</tr>
							</thead>
						</table>
					</div>
					<!-- /tile body -->

				</section>
				<!-- /tile -->

			</div>
			<!-- /col -->
		</div>
		<!-- /row -->

	</div>

</section>