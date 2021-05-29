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
						<div class="row">
							<div class="col-md-2">
								<select class="form-control" name="filter_kategori_utama" id="filter_kategori_utama">
									<option value="">--Pilih Kategori Utama--</option>
									<?php 
										foreach($filter_kategori_utama as $q){
											if(isset($val_kategori_utama)){
												if($val_kategori_utama == $q['kate_id']){
													echo '<option selected value="'.$q['kate_id'].'"> '.$q['kate_nama'].' </option>';
												}else{
													echo '<option value="'.$q['kate_id'].'"> '.$q['kate_nama'].' </option>';
												}
											}else{
												echo '<option value="'.$q['kate_id'].'"> '.$q['kate_nama'].' </option>';
											}
										}
									?>
								</select>
							</div>
							<div class="col-md-2">
								<select class="form-control" name="filter_kategori" id="filter_kategori">
									<option value="">--Pilih Kategori--</option>
									<?php 
										foreach($filter_kategori as $q){
											if(isset($val_kategori)){
												if($val_kategori == $q['kate_id']){
													echo '<option selected value="'.$q['kate_id'].'"> '.$q['kate_nama'].' </option>';
												}else{
													echo '<option value="'.$q['kate_id'].'"> '.$q['kate_nama'].' </option>';
												}
											}else{
												echo '<option value="'.$q['kate_id'].'"> '.$q['kate_nama'].' </option>';
											}
										}
									?>
								</select>
							</div>
							<div class="col-md-2">
								<select class="form-control" name="filter_sub_kategori" id="filter_sub_kategori">
									<option value="">--Pilih Sub Kategori--</option>
									<?php 
										foreach($filter_sub_kategori as $q){
											if(isset($val_sub_kategori)){
												if($val_sub_kategori == $q['kate_id']){
													echo '<option selected value="'.$q['kate_id'].'"> '.$q['kate_nama'].' </option>';
												}else{
													echo '<option value="'.$q['kate_id'].'"> '.$q['kate_nama'].' </option>';
												}
											}else{
												echo '<option value="'.$q['kate_id'].'"> '.$q['kate_nama'].' </option>';
											}
										}
									?>
								</select>
							</div>
							<!-- <div class="col-md-2">
								<select class="form-control" name="filter_rak" id="filter_rak">
									<option value="">--Pilih Rak--</option>
									<?php 
										foreach($filter_rak as $q){
											if(isset($val_rak)){
												if($val_rak == $q['rak_id']){
													echo '<option selected value="'.$q['rak_id'].'"> '.$q['rak_kode'].' </option>';
												}else{
													echo '<option value="'.$q['rak_id'].'"> '.$q['rak_kode'].' </option>';
												}
											}else{
												echo '<option value="'.$q['rak_id'].'"> '.$q['rak_kode'].' </option>';
											}
										}
									?>
								</select>
							</div>
							<div class="col-md-2">
								<select class="form-control" name="filter_etalase" id="filter_etalase">
									<option value="">--Pilih Etalase--</option>
									<?php 
										foreach($filter_etalase as $q){
											if(isset($val_etalase)){
												if($val_etalase == $q['etal_id']){
													echo '<option selected value="'.$q['etal_id'].'"> '.$q['etal_kode'].' </option>';
												}else{
													echo '<option value="'.$q['etal_id'].'"> '.$q['etal_kode'].' </option>';
												}
											}else{
												echo '<option value="'.$q['etal_id'].'"> '.$q['etal_kode'].' </option>';
											}
										}
									?>
								</select>
							</div> -->
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
								<th>Kode</th>
								<th>Kategori Atas</th>
								<th>Kategori</th>
								<th>Sub Kategori</th>
								<th style="width: 20%;">Nama</th>
								<!-- <th>Min Stok</th> -->
								<!-- <th>Max Stok</th> -->
								<th>Stok</th>
								<!-- <th>Selisih Stok</th> -->
								<th>Tahun</th>
								<th>Harga Beli</th>
								<th>Harga Jual</th>
								<th>Gambar</th>
								<th>Berat</th>
								<th>Satuan</th>
								<!-- <th>Facebook</th>
								<th>Tokopedia</th>
								<th>Bukalapak</th>
								<th>Shopee</th> -->
								<!-- <th>Rak</th>
								<th>Etalase</th> -->
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
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title custom-font" id="myModalLabel">Form Produk</h3>
			</div>
			<form role="form" id="imageUploadForm" method="post"  enctype="multipart/form-data">
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
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Kategori</label>
								<select class="form-control" name="parent2" id="parent2">
									<option value="">Pilih</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Sub Kategori</label>
								<select class="form-control" name="parent3" id="parent3">
									<option value="">Pilih</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama</label>
								<input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan nama" required="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label>Gambar</label>
							<input type="file" class="form-control" name="file" id="file">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Beli</label>
								<input type="text" class="form-control" name="harga_beli" id="harga_beli" placeholder="Masukan Harga Beli" required="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Jual</label>
								<input type="text" class="form-control" name="harga_jual" id="harga_jual" placeholder="Masukan Harga Jual" required="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Min Stok</label>
								<input type="text" class="form-control" name="min_stok" id="min_stok" placeholder="Masukan Minimal Stok" required="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Max Stok</label>
								<input type="text" class="form-control" name="max_stok" id="max_stok" placeholder="Masukan Maksimal Stok" required="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Berat</label>
								<input type="text" class="form-control" id="berat" name="berat" placeholder="Masukan Berat" required="" onkeypress='validate(event)'>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Satuan</label>
								<select class="form-control" name="satuan" id="satuan">
									<option value="kg">kg</option>
									<option value="liter">liter</option>
									<option value="meter">meter</option>
									<option value="mili meter">mili meter</option>
									<option value="sak">sak</option>
									<option value="buah">buah</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Tahun</label>
								<input type="text" class="form-control" id="tahun" name="tahun" placeholder="Masukan Tahun" required="">
							</div>
						</div>
					</div>
					<div class="row" style="display: none;">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Facebook</label>
								<select class="form-control" name="facebook" id="facebook">
									<option value="">--Pilih Kondisi--</option>
									<option value="sudah">Sudah</option>
									<option value="belum">Belum</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Tokopedia</label>
								<select class="form-control" name="tokopedia" id="tokopedia">
									<option value="">--Pilih Kondisi--</option>
									<option value="sudah">Sudah</option>
									<option value="belum">Belum</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Bukalapak</label>
								<select class="form-control" name="bukalapak" id="bukalapak">
									<option value="">--Pilih Kondisi--</option>
									<option value="sudah">Sudah</option>
									<option value="belum">Belum</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Shopee</label>
								<select class="form-control" name="shopee" id="shopee">
									<option value="">--Pilih Kondisi--</option>
									<option value="sudah">Sudah</option>
									<option value="belum">Belum</option>
								</select>
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