<input type="hidden" value="<?= $this->level ?>" id="value_level">
<section id="content">

	<div class="page page-tables-datatables">

		<div class="pageheader">

			<div class="page-bar">

				<ul class="page-breadcrumb">
					<li>
						<a href="<?= base_url() ?>"><i class="fa fa-home"></i> Dashboard</a>
					</li>
					<li>
						<a href="#">Pemesanan</a>
					</li>
					<li>
						<a href="<?= base_url() ?>pemesanan/data">Data</a>
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
						<h1 class="custom-font"><strong><?= $title ?></strong></h1>
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
						<?php if ($this->level == "Staff") : ?>
							<div class="row">
								<div class="col-md-6">
									<div id="tableTools"></div>
								</div>
								<div class="col-md-6">
									<a style="float: right;" href="<?= base_url() ?>pemesanan/tambah" class="btn btn-success">Tambah</a>
								</div>
							</div>
							<br>
						<?php endif; ?>
						<table class="table table-custom" id="advanced-usage">
							<thead>
								<tr>
									<th>Kode</th>
									<th>Total Harga</th>
									<th>Total Bayar</th>
									<th>Sisa</th>
									<th>Tanggal</th>
									<th>Status</th>
									<th>Pilihan</th>
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
				<h3 class="modal-title custom-font" id="myModalLabel">Form Hafalan</h3>
			</div>
			<form role="form" id="form" method="post">
				<div class="modal-body">
					<input type="hidden" name="id" value="0">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama</label>
								<input type="text" class="form-control" id="nama" placeholder="Masukan nama" required="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label for="exampleInputPassword1">Index</label>
							<input type="number" class="form-control" id="index" placeholder="Masukan Index" required="">
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Status</label>
								<select class="form-control" name="status" id="status" required="">
									<option value="">--Pilih Status--</option>
									<option value="Aktif">Aktif</option>
									<option value="Tidak Aktif">Tidak Aktif</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">

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