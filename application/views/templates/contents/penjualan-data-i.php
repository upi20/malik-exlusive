<style>
	.tabel {
		display: inline;
		position: relative;
		float: left;
		max-width: 450px;
		min-width: 300px;
	}

	.tabel td {
		padding: 3px;
	}

	.tabel tr td:first-child {
		font-weight: bold;
	}

	.tabel tr td {
		vertical-align: top;
	}
</style>
<section id="content">

	<div class="page page-tables-datatables">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<a href="<?= base_url() ?>"><i class="fa fa-home"></i> Dashboard</a>
					</li>
					<li>
						<a href="#">Penjualan</a>
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
						<h1 class="custom-font">Data <strong><?= $title ?> Transaksi :</strong> <b style="text-align: right;" id="total-harga"><?php echo $this->libs->rupiah($total_harga); ?></b></h1>
						<a class="btn btn-success" style="margin-left: 10px" href="<?= base_url() ?>penjualan/data/export_excel"><i class="fa fa-print"></i> <span>Export Excel</span></a>
						<div style="float: right;margin-right: 30px">
							<a class="btn btn-success" style="margin-right: 10px" data-toggle="modal" data-target="#import" href="#"><i class="fa fa-plus"></i> <span>Import</span></a>
							<button class="btn btn-success" id="scan-button"><i class="fa fa-qrcode"></i> Scan Barcode</button>
						</div>
					</div>
					<!-- /tile header -->

					<!-- tile body -->
					<div class="tile-body">
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-2" style="display: none;">
								<select class="form-control" name="filter_status_pembayaran" id="filter_status_pembayaran">
									<option value="">--Status Pembayaran--</option>
									<option value="Lunas">Lunas</option>
									<option value="Hutang">Hutang</option>
								</select>
							</div>
							<div class="col-md-2" style="display: none;">
								<select class="form-control" name="filter_status_pengiriman" id="filter_status_pengiriman">
									<option value="">--Status Pengiriman--</option>
									<option value="proses">Proses</option>
									<option value="kirim">Kirim</option>
								</select>
							</div>
							<div class="col-md-2" style="display: none;">
								<select class="form-control" name="filter_vendor" id="filter_vendor">
									<option value="">--Vendor--</option>
									<?php foreach ($vendor as $q) : ?>
										<option value="<?= $q['supp_id'] ?>"><?= $q['supp_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-2">
								<select class="form-control" name="filter_admin" id="filter_admin">
									<option value="">--Admin--</option>
									<?php foreach ($admin as $q) : ?>
										<option value="<?= $q['admn_id'] ?>"><?= $q['admn_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-2">
								<select class="form-control" name="filter_packer" id="filter_packer">
									<option value="">--Packer--</option>
									<?php foreach ($packer as $q) : ?>
										<option value="<?= $q['pack_id'] ?>"><?= $q['pack_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<!-- <div class="col-md-2">
								<select class="form-control" name="filter_supplier" id="filter_supplier">
									<option value="">--Supplier--</option>
									<?php foreach ($supplier as $q) : ?>
										<option value="<?= $q['supp_id'] ?>"><?= $q['supp_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div> -->
							<div class="col-md-2">
								<div class='input-group datepicker' data-format="L">
									<input type='text' placeholder="Pilih Tanggal Mulai" class="form-control" id="filter_tanggal_mulai" />
									<span class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</span>
								</div>
							</div>
							<div class="col-md-2">
								<div class='input-group datepicker' data-format="L">
									<input type='text' placeholder="Pilih Tanggal Akhir" class="form-control" id="filter_tanggal_akhir" />
									<span class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</span>
								</div>
							</div>
							<div class="col-md-2" style="display: none;">
								<select class="form-control" name="filter_sumber_penjualan" id="filter_sumber_penjualan">
									<option value="">--Pilih Sumber Penjualan--</option>
									<option value="online">online</option>
									<option value="offline">offline</option>
								</select>
							</div>
							<div class="col-md-1">
								<!-- <a href class="myIcon icon-hotpink icon-ef-9 icon-color"><i class="fa fa-umbrella"></i></a> -->
								<button class="btn btn-ef btn-ef-1-success btn-ef-1 btn-ef-1d btn-md" id="filter-cari" style="width:100%"><i class="fa fa-arrow-right"></i> Cari</button>
							</div>
						</div>
					</div>
					<!-- /tile body -->

				</section>
				<!-- /tile -->
				<!-- tile -->
				<section class="tile">

					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">Data <strong><?= $title ?> Transaksi :</strong> <b style="text-align: right;" id="total-harga"><?php echo $this->libs->rupiah($total_harga); ?></b></h1>
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
						<!-- <form role="form" id="form_head" method="post"> -->
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">

									<table id="advanced-usage" class="display nowrap" style="width:100%">
										<thead>
											<tr>
												<th>ID</th>
												<th>Tanggal</th>
												<th>No. Resi</th>
												<th>Berkas</th>
												<!-- <th>Vendor</th> -->
												<th>Packer</th>
												<th>Toko</th>
												<th>Konsumen</th>
												<!-- <th>Keterangan</th> -->
												<th>Produk</th>
												<th>Harga</th>
												<th>Qty</th>
												<th>T.Harga</th>
												<th>Status</th>
												<th>Tanggal Kirim</th>
												<th style="width: 5%;">Aksi</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
							<hr>
						</div>
						<!-- </form> -->
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

<!-- Modal -->
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="post" enctype="multipart/form-data" action="<?= base_url() ?>penjualan/data/import">
				<div class="modal-header">
					<h3 class="modal-title custom-font">Import Data</h3>
				</div>
				<div class="modal-body">
					<label>File(.xls)</label>
					<input type="file" name="file" id="file">
				</div>
				<div class="modal-footer">
					<button id="clickImport" class="btn btn-success btn-ef btn-ef-3 btn-ef-3c"><i class="fa fa-arrow-right"></i> Submit</button>

					<button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Tidak</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Splash Modal -->
<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title custom-font" id="myModalLabel">Form Bayar Sisa</h3>
			</div>
			<form role="form" id="form" method="post">
				<div class="modal-body">
					<input type="hidden" name="id" value="0">
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" id="id_detail" name="id_detail">
							<div class="form-group">
								<label for="exampleInputEmail1">ID Penjualan</label>
								<input type="text" class="form-control" id="penj_id" name="penj_id" readonly required="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Total Harga</label>
								<input type="text" class="form-control" id="total_harga" name="total_harga" required="" readonly>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Pembayaran</label>
								<input type="text" class="form-control" id="pembayaran" name="pembayaran" required="" readonly>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Sisa</label>
								<input type="text" class="form-control" id="sisa_awal" name="sisa_awal" required="" readonly>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Yang Dibayar</label>
								<input type="text" class="form-control" id="dibayar" name="dibayar" placeholder="Masukan Yang Dibayar" required="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Sisa</label>
								<input type="text" class="form-control" id="sisa" name="sisa" readonly required="">
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
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title custom-font" id="labelmyModal4"></h3>
				<button id="focus">Focus Scann Barcode</button>
			</div>
			<div class="modal-body">
				<input id="barcode" name="barcode" autocomplete="off" class="form-control">
				<div id="contentmyModal4"></div>
			</div>
			<div class="modal-footer">
				<button id="clickMyModel4" class="btn btn-success btn-ef btn-ef-3 btn-ef-3c"><i class="fa fa-arrow-right"></i> Submit</button>

				<button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Tidak</button>
			</div>
			<input type="hidden" id="idHapus" name="">
		</div>
	</div>
</div>


<!-- modal kirim -->
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="labelmyModal5" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title custom-font" id="labelmyModal5">Kirim Penjualan</h3>
			</div>
			<div class="modal-body">
				<div class="row" id="vendor-informasi-penjualan">
				</div>
				<hr>
				<div class="row">
					<div style="padding:0 15px;">
						<h4 style=" margin-top:0">Data Penjualan Pengiriman</h4>
					</div>
					<div class="col-md-4">
						<label for="status">Status</label>
						<select id="status" name="status" class="form-control">
						</select>
					</div>
					<div class="col-md-4">
						<label for="tanggal">Tanggal</label>
						<input type="date" value="" class="form-control" id="tanggal">
					</div>
					<div class="col-md-4">
						<label for="packer">Packer</label>
						<select id="packer" name="packer" class="form-control">
							<option value="" selected>Pilih packer</option>
						</select>
					</div>
				</div>


				<div id="vendors">
					<div class="row" id="vendor-1">
						<br>
						<div class="col-md-3" id="pilih-vendor">
							<label for="vendor-select-1">Vendor</label>
							<select id="vendor-select-1" name="vendor-select-1" class="form-control vendor-select" onchange="handleChangeVendor(this)" data-no="1">
								<option value="" selected>Pilih Vendor</option>
							</select>
						</div>
						<div class="col-md-9 p-0 m-0">
							<div class="col-md-3">
								<label for="jumlah-1">Jumlah</label>
								<input type="number" class="form-control vendor-jumlah" id="jumlah-1" onkeyup="handleJumlahStokSisa(1)" onclick="handleJumlahStokSisa(1)" onload="handleJumlahStokSisa(1)">
							</div>
							<div class="col-md-3" id="pilih-vendor-stok">
								<label for="stok-1">Stok</label>
								<input type="number" disabled class="form-control vendor-stok" id="stok-1">
							</div>
							<div class="col-md-3" id="pilih-vendor-stok-sisa">
								<label for="stok-sisa-1">Stok Sisa</label>
								<input type="number" disabled class="form-control vendor-stok-sisa" id="stok-sisa-1">
							</div>

							<div class="col-md-3">
								<br>
								<div style="display: flex; flex-direction: row-reverse; margin-top:4px;">
									<button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="vendor-tambah"><i class="glyphicon glyphicon-plus"></i> Tambah Vendor</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="submitFormUbah" class="btn btn-success btn-ef btn-ef-3 btn-ef-3c"><i class="fa fa-arrow-right"></i> Simpan</button>
				<button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Batal</button>
			</div>
			<input type="hidden" id="idHapus" name="">
		</div>
	</div>
</div>

<!-- modal ubah -->
<div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title custom-font" id="labelmyModal4">Ubah Kirim Penjualan</h3>
			</div>
			<div class="modal-body">
				<div class="row" id="ubah-vendor-informasi-penjualan">
				</div>
				<hr>
				<div class="row">
					<div style="padding:0 15px;">
						<h4 style=" margin-top:0">Data Penjualan Pengiriman</h4>
					</div>
					<div class="col-md-4">
						<label for="status">Status</label>
						<select id="ubah-status" name="status" class="form-control" disabled>
							<option value="kirim">Kirim</option>
						</select>
					</div>
					<div class="col-md-4">
						<label for="tanggal">Tanggal</label>
						<input type="date" value="" class="form-control" id="ubah-tanggal">
					</div>
					<div class="col-md-4">
						<label for="packer">Packer</label>
						<select id="ubah-packer" name="packer" class="form-control">
							<option value="" selected>Pilih packer</option>
						</select>
					</div>
				</div>


				<div id="ubah-vendors">
					<div class="row" id="ubah-vendor-1">
						<br>
						<div class="col-md-3" id="ubah-pilih-vendor">
							<label for="vendor-select-1">Vendor</label>
							<select id="ubah-vendor-select-1" name="vendor-select-1" class="form-control ubah-vendor-select" onchange="handleChangeVendor(this, 'ubah')" data-no="1">
								<option value="" selected>Pilih Vendor</option>
							</select>
						</div>
						<div class="col-md-9 p-0 m-0">
							<div class="col-md-3">
								<label for="jumlah-1">Jumlah</label>
								<input type="number" class="form-control ubah-vendor-jumlah" id="ubah-jumlah-1" onkeyup="handleJumlahStokSisa(1,'ubah')" onclick="handleJumlahStokSisa(1,'ubah')" onload="handleJumlahStokSisa(1,'ubah')">
							</div>
							<div class="col-md-3" id="ubah-pilih-vendor-stok">
								<label for="stok-1">Stok</label>
								<input type="number" disabled class="form-control ubah-vendor-stok" id="ubah-stok-1">
							</div>
							<div class="col-md-3" id="ubah-pilih-vendor-stok-sisa">
								<label for="stok-sisa-1">Stok Sisa</label>
								<input type="number" disabled class="form-control ubah-vendor-stok-sisa" id="ubah-stok-sisa-1">
							</div>

							<div class="col-md-3">
								<br>
								<div style="display: flex; flex-direction: row-reverse; margin-top:4px;">
									<button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="ubah-vendor-tambah"><i class="glyphicon glyphicon-plus"></i> Tambah Vendor</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="ubah-submitFormUbah" class="btn btn-success btn-ef btn-ef-3 btn-ef-3c"><i class="fa fa-arrow-right"></i> Simpan</button>
				<button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Batal</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	<?php
	$packer = $this->db->get('packer')->result_array();
	?>
	let packer = [
		<?php foreach ($packer as $p) : ?> '<?= $p['pack_id'] ?>|<?= $p['pack_nama'] ?>',
		<?php endforeach ?>
	]

	let vendor = [
		<?php foreach ($vendor as $v) : ?> '<?= $v['supp_id'] ?>|<?= $v['supp_nama'] ?>',
		<?php endforeach ?>
	]

	let level = '<?= $this->session->userdata('data')['level'] ?>'
</script>