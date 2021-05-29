<section id="content">

	<div class="page page-tables-datatables">

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
							<div class="col-md-2">
								<select class="form-control" name="filter_supplier" id="filter_supplier">
									<option value="">--Supplier--</option>
									<?php foreach ($supplier as $q) : ?>
										<option value="<?= $q['supp_id'] ?>"><?= $q['supp_nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
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
							<div class="col-md-2">
								<!-- <a href class="myIcon icon-hotpink icon-ef-9 icon-color"><i class="fa fa-umbrella"></i></a> -->
								<button class="btn btn-ef btn-ef-1-success btn-ef-1 btn-ef-1d btn-md" id="filter-cari"><i class="fa fa-arrow-right"></i> Cari</button>

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
						<button style="float: right; margin-right: 10px;" class="btn btn-success" id="scan-button"><i class="fa fa-qrcode"></i> Scan Barcode</button>
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
												<th>Vendor</th>
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