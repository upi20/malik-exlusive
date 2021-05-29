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
						<div class="row">
							<div class="col-md-6"><div id="tableTools"></div></div>
							<div class="col-md-6">
								<button id="clickTambah" style="float: right;" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14"><i class="fa fa-plus"></i> <span>Tambah</span></button>
							</div>
						</div>
						<br>
						<table class="table table-custom" id="advanced-usage">
							<thead>
								<tr>
									<th style="width: 6%;">Kode</th>
									<th>Kategori</th>
									<th style="width: 10%;">Nama</th>
									<th>Stok</th>
									<th>Harga Beli</th>
									<th>Harga Jual</th>
									<th>Berat</th>
									<th>Satuan</th>
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
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title custom-font" id="myModalLabel">Form Produk</h3>
			</div>
			<form role="form" id="imageUploadForm" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<input type="hidden" name="id" value="0">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Kategori Utama</label>
								<select class="form-control" name="parent1" id="parent1">
									<option value="">Pilih</option>
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
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama</label>
								<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama" required="">
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
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Beli</label>
								<input type="text" class="form-control" id="harga_beli" name="harga_beli" placeholder="Masukan Harga Beli" required="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Jual</label>
								<input type="text" class="form-control" id="harga_jual" name="harga_jual" placeholder="Masukan Harga Jual" required="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="display: none;">
							<div class="form-group">
								<label for="exampleInputEmail1">Supplier</label>
								<select class="form-control" id="supp_nama" name="supp_nama"></select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Kode</label>
								<input type="text" class="form-control" name="kode" id="kode" required placeholder="Kode Barang">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Berat</label>
								<input type="text" class="form-control" id="berat" name="berat" placeholder="Masukan Berat" required="" onkeypress='validate(event)' value="1" readonly>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Satuan</label>
								<select class="form-control" name="special" id="special">
									<option value="Pcs" selected="">Pcs</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group" style="display: none;">
								<label for="exampleInputEmail1">Min Stok</label>
								<input type="text" class="form-control" id="min_stok" name="min_stok" placeholder="Masukan Minimal Stok">
							</div>
						</div>
						<div class="col-md-3" style="display: none;">
							<div class="form-group">
								<label for="exampleInputEmail1">Max Stok</label>
								<input type="text" class="form-control" id="max_stok" name="max_stok" placeholder="Masukan Maksimal Stok">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="display: none;">
							<div class="form-group">
								<label for="exampleInputEmail1">Tahun</label>
								<input type="text" class="form-control" id="tahun" name="tahun" placeholder="Masukan Tahun">
							</div>
						</div>
					</div>
					<div id="detail_special"></div>
					<div class="row">
						<div class="col-md-6" style="display: none;">
							<div class="form-group">
								<label for="exampleInputEmail1">Gambar</label>
								<input type="file" class="form-control" name="file" id="file">
							</div>
						</div>
						
					</div>
					<div class="row" style="display: none;">
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Link Referensi</label>
								<textarea class="form-control" name="link_referensi" id="link_referensi"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default btn-border">Simpan</button>
					<button class="btn btn-default btn-border" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Splash Modal -->
<div class="modal splash fade" id="splash-6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title custom-font" id="myModalLabel">Form Rak Produk</h3>
			</div>
			<form role="form" id="form-rak" method="post">
				<div class="modal-body">
					<input type="hidden" name="rak_prod_id" id="rak_prod_id" value="0">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Rak</label>
								<select class="form-control" name="val_rak_id" id="val_rak_id">
									<option value="">Pilih Rak</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Jumlah</label>
								<input type="text" class="form-control" id="rak_jumlah" placeholder="Masukan jumlah" required="">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default btn-border">Simpan</button>
					<button class="btn btn-default btn-border" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Splash Modal -->
<div class="modal splash fade" id="splash-7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title custom-font" id="myModalLabel">Form Etalase Produk</h3>
			</div>
			<form role="form" id="form-etalase" method="post">
				<div class="modal-body">
					<input type="hidden" name="etal_prod_id" id="etal_prod_id" value="0">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Etalase</label>
								<select class="form-control" name="val_etal_id" id="val_etal_id">
									<option value="">Pilih Etalase</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Jumlah</label>
								<input type="text" class="form-control" id="etal_jumlah" placeholder="Masukan jumlah" required="">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default btn-border">Simpan</button>
					<button class="btn btn-default btn-border" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Splash Modal Gambar-->
<div class="modal splash fade" id="splash-9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form role="form" id="form-rak" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<img id="detail_gambar" style="width:100%;">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default btn-border" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Splash Modal Min Stok-->
<div class="modal splash fade" id="splash-10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="post">
				<div class="modal-body" id="detail_min_stok">
				</div>
				<div class="modal-footer">
					<button class="btn btn-default btn-border" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Splash Modal Min Stok-->
<div class="modal splash fade" id="splash-11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="post">
				<div class="modal-body" id="detail_stok">
				</div>
				<div class="modal-footer">
					<button class="btn btn-default btn-border" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>