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
						<h1 class="custom-font">Data <strong><?=$title?></strong></h1>
						<ul class="controls">
							<li class="dropdown">

								<a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
									<i class="fa fa-cog"></i>
									<i class="fa fa-spinner fa-spin"></i>
								</a>

								<ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
									<li>
										<a role="button" tabindex="0" class="tile-toggle">
											<span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
											<span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
					<!-- /tile header -->

					<!-- tile body -->
					<div class="tile-body">
						<form role="form" id="form_head" method="post">
							<div class="modal-body">
								<div class="row">
									<input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('data')['id'] ?>">
									<div class="col-md-4">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="exampleInputEmail1">Kode</label>
													<input type="text" class="form-control" id="code" name="code" readonly="" required="">
												</div>		
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="exampleInputEmail1">Tanggal Transaksi</label>
													<input type="date" class="form-control" id="tanggal" name="tanggal" required="" value="<?php echo date('Y-m-d');?>" readonly>
												</div>		
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Toko</label>
													<select class="form-control" name="id_toko" id="id_toko">
														<?php foreach($listToko as $lc):?>
															<option value="<?=$lc['id']?>"><?=$lc['nama']." (".$lc['nama_lengkap'].")"?></option>
														<?php endforeach;?>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Admin</label>
													<select class="form-control" name="id_admin" id="id_admin">
														<?php foreach($listAdmin as $lc):?>
															<option value="<?=$lc['admn_id']?>"><?=$lc['admn_nama']?></option>
														<?php endforeach;?>
													</select>
												</div>		
											</div>
										</div>
										

										<div class="form-group">
											<label for="exampleInputEmail1">Keterangan</label>
											<textarea class="form-control" id="keterangan" name="keterangan"></textarea>
										</div>

										<div class="form-group">
											<label for="exampleInputEmail1">No. Resi</label>
											<input type="text" class="form-control" id="no_resi" name="no_resi">
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="exampleInputEmail1">Nama Pembeli</label>
													<input type="text" class="form-control" id="nama" name="nama">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="exampleInputEmail1">No Hp Pembeli</label>
													<input type="number" class="form-control" id="no_hp" name="no_hp">
												</div>
											</div>
										</div>
										
										<!-- <div class="form-group"> -->
											<!-- <label for="exampleInputEmail1">Instansi</label> -->
											<input type="hidden" class="form-control" id="instansi" name="instansi">
										<!-- </div> -->

										<div class="form-group">
											<label for="exampleInputEmail1">Alamat Pembeli</label>
											<textarea class="form-control" id="alamat" name="alamat"></textarea>
										</div>
										<!-- <div class="form-group"> -->
											<!-- <label for="exampleInputEmail1">Kondisi</label> -->
											<input type="hidden" class="form-control" id="kondisi" name="kondisi" value="Dikirim">
											<!-- <select class="form-control" name="kondisi" id="kondisi">
												<option value="Dikirim">Dikirim</option>
												<option value="Dipotong">Dipotong</option>
												<option value="Disalurkan">Disalurkan</option>
											</select>
										</div> -->
												
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="exampleInputEmail1">COD / NON COD</label>
													<select class="form-control" name="kurir" id="kurir">
														<option value="COD">COD</option>
														<option value="NON COD">NON COD</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Berkas/File</label>
													<input type="file" class="form-control" name="berkas" id="berkas">
												</div>		
											</div>
										</div>
										<div class="form-group" style="display: none;">
											<label for="exampleInputEmail1">Ongkir</label>
											<input type="number" class="form-control" id="ongkir" name="ongkir" value="0" required="">
										</div>
										<div class="form-group" style="display: none;">
											<label for="exampleInputEmail1">ID Transaksi (Marketplace)</label>
											<input type="text" class="form-control" id="id_marketplace" name="id_marketplace">
										</div>
										<div class="form-group" style="display: none;">
											<label for="exampleInputEmail1">Sumber Penjualan</label>
											<select class="form-control" name="supe_id" id="supe_id">
												<option value="">Pilih Sumber Penjualan</option>
											</select>
										</div>
										
									</div>
									<div class="col-md-8">
										<!-- <button style="float: right;" id="add-detail" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button> -->
										<a style="float: right;" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" data-toggle="modal" id="btn-tambah" data-target="#splash" data-options="splash-2 splash-ef-14"><i class="fa fa-plus"></i> <span>Tambah</span></a>

										<table class="table table-custom" id="advanced-usage">
											<thead>
											<tr>
												<!-- <th>Kategori</th> -->
												<!-- <th>Kode</th> -->
												<th>Produk</th>
												<th>Harga</th>
												<th>Jumlah</th>
												<th>Total Harga</th>
												<th>Tindakan</th>
											</tr>
											</thead>
										</table>
										<hr>
										<div class="row">
											<div class="col-md-8" style="float: right;">
												<div class="form-group">
													<input type="text" id="total_harga" class="form-control" name="total_harga" readonly="" style="    text-align: right;">
												</div>
											</div>
											<div class="col-md-4" style="float: right;">
												<div class="form-group">
													<label><b style="font-size: 14px;">Nominal Transaksi :</b> </label>
												</div>
											</div>
										</div>
										<div class="row">
											<!-- <div class="col-md-8" style="float: right;"> -->
												<!-- <div class="form-group"> -->
													<input type="hidden" id="total_harga_terbilang" class="form-control" name="total_harga_terbilang" readonly="" style="    text-align: right;">
												<!-- </div> -->
											<!-- </div> -->
											<!-- <div class="col-md-4" style="float: right;">
												<div class="form-group">
													<label><b style="font-size: 18px;">Terbilang:</b> </label>
												</div>
											</div> -->
										</div>
										<!-- <div class="row"> -->
											<!-- <div class="col-md-8" style="float: right;"> -->
												<!-- <div class="form-group"> -->
													<input type="hidden" value="0" id="nominal_recah" class="form-control" name="nominal_recah" style="    text-align: right;">
												<!-- </div> -->
											<!-- </div> -->
											<!-- <div class="col-md-4" style="float: right;">
												<div class="form-group">
													<label><b style="font-size: 14px;">Nominal Recah :</b> </label>
												</div>
											</div> -->
										<!-- </div> -->
										<!-- <div class="row"> -->
											<!-- <div class="col-md-8" style="float: right;"> -->
												<!-- <div class="form-group"> -->
													<input type="hidden" value="0" id="nominal_pengiriman" class="form-control" name="nominal_pengiriman" style="    text-align: right;">
												<!-- </div> -->
											<!-- </div> -->
											<!-- <div class="col-md-4" style="float: right;"> -->
												<!-- <div class="form-group">
													<label><b style="font-size: 14px;">Nominal Pengiriman :</b> </label>
												</div> -->
											<!-- </div> -->
										<!-- </div> -->
										<div class="row">
											<div class="col-md-8" style="float: right;">
												<div class="form-group">
													<input type="text" value="" id="dibayar" class="form-control" name="dibayar" required="">
												</div>
											</div>
											<div class="col-md-4" style="float: right;">
												<div class="form-group">
													<label><b style="font-size: 18px;">Dibayarkan / DP:</b> </label>
												</div>
											</div>
										</div>
										<div class="row" id="status_pengiriman" style="display: none;">
											<div class="col-md-8" style="float: right;">
												<div class="form-group">
													<input type="date" class="form-control" name="tanggal_pengiriman" id="tanggal_pengiriman">
												</div>
											</div>
											<div class="col-md-4" style="float: right;">
												<div class="form-group">
													<label><b style="font-size: 18px;">Tanggal Pengiriman:</b> </label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="modal-footer">
								<button type="submit" class="btn btn-default btn-border">Simpan</button>
								<a class="btn btn-default btn-border" href="<?=base_url()?>penjualan/data">Batal</a>
							</div>
						</form>
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
					<h3 class="modal-title custom-font" id="myModalLabel">Form Tambah Penjualan</h3>
				</div>
				<form role="form" id="form" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<input type="hidden" name="id" value="0">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" name="val_kode" id="val_kode" placeholder="Cari Kode Produk">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<a id="cari_produk" class="btn btn-default">Cari</a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Kategori Utama</label>
									<select class="form-control" name="parent1" id="parent1">
										<option value="">Pilih</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Produk</label>
									<br>
									<select style="width: 100%;" tabindex="3" class="chosen-select" id="prod_id" name="prod_id">
										<option value="">Pilih Produk</option>
									</select>
								</div>
							</div>
							<div class="col-md-6" style="display: none;">
								<div class="form-group">
									<label for="exampleInputEmail1">Kategori</label>
									<select class="form-control" name="parent2" id="parent2">
										<option value="">Pilih</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6" style="display: none;">
								<div class="form-group">
									<label for="exampleInputEmail1">Sub Kategori</label>
									<select class="form-control" name="parent3" id="parent3">
										<option value="">Pilih</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6" style="display: none;">
								<div class="form-group">
									<label for="exampleInputEmail1">Nama Produk</label>
									<input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" required="" readonly="">
								</div>
							</div>
							<input type="hidden" class="form-control" id="harga_awal" name="harga_awal" placeholder="Harga Awal" required="" readonly="">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Harga Jual</label>
									<input type="text" class="form-control" id="harga" name="harga" placeholder="Masukan Harga" required="">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputEmail1">Stok</label>
									<input type="text" class="form-control" id="stok" name="stok" required="" readonly="">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputEmail1">Jumlah</label>
									<input type="number" class="form-control" id="jumlah" name="jumlah" required="">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputEmail1">Berat</label>
									<input type="number" class="form-control" readonly id="berat" name="berat">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputEmail1">Satuan</label>
									<input type="text" class="form-control" readonly id="satuan" name="satuan">
								</div>
							</div>
							<div class="col-md-6">
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Total Harga</label>
									<input type="text" class="form-control" id="total_harga_detail" name="total_harga_detail" readonly required="">
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
