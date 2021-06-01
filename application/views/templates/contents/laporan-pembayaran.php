<section id="content">

	<div class="page page-tables-datatables">

		<div class="pageheader">

			<div class="page-bar">

				<ul class="page-breadcrumb">
					<li>
						<a href="<?= base_url() ?>"><i class="fa fa-home"></i> Dashboard</a>
					</li>
					<li>
						<a href="<?= base_url() ?>laporan/pembayaran">Pembayaran</a>
					</li>
				</ul>

			</div>

		</div>

		<!-- row -->
		<div class="row">
			<!-- col -->
			<div class="col-md-12">



				<!-- tile -->
				<section class="tile">

					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">Data <strong><?= $title ?></strong></h1>
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
							<div class="col-md-6">
								<div id="tableTools"></div>
							</div>
							<div class="col-md-6">
								<a href="<?= base_url() ?>laporan/pembayaran/export_excel"><button style="float: right;" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" data-toggle="modal" data-target="#" data-options="splash-2 splash-ef-14"><i class="fa fa-plus"></i> <span>Cetak</span></button></a>
							</div>
						</div>
						<br>
						<table class="table table-custom" id="advanced-usage">
							<thead>
								<tr>
									<th>ID</th>
									<th>ID Penjualan</th>
									<th>Total Harga</th>
									<th>Nominal</th>
									<th>Sisa</th>
									<th>Tanggal</th>
									<th style="text-align: right;">Pilihan &nbsp;&nbsp;</th>
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

<!-- Splash Modal -->
<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title custom-font" id="myModalLabel">Form Pembayaran</h3>
			</div>
			<form role="form" id="form" method="post">
				<div class="modal-body">
					<input type="hidden" name="id" value="0">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama</label>
								<input type="text" class="form-control" id="nama" placeholder="Masukan nama" required="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Jumlah Stok</label>
								<input type="number" class="form-control" id="stok" placeholder="Masukan Jumlah Stok" required="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Beli</label>
								<input type="text" class="form-control" id="beli" placeholder="Masukan Beli" required="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Jual</label>
								<input type="text" class="form-control" id="jual" placeholder="Masukan jual" required="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Rumah</label>
								<select class="form-control" id="rumah" required>
									<option value="">Pilih Rumah</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Kelas</label>
								<select class="form-control" id="kelas" required>
									<option value="">Pilih Kelas</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Status</label>
								<select class="form-control" name="status" id="status" required="">
									<option value="">--Pilih Status--</option>
									<option value="Belum Terjual">Belum Terjual</option>
									<option value="Terjual">Terjual</option>
									<option value="Berangkat">Berangkat</option>
									<option value="Terkirim">Terkirim</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default btn-border">Simpan</button>
					<button class="btn btn-default btn-border" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>