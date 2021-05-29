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
									<div class="col-md-3">
										<div class="form-group">
											<label for="exampleInputEmail1">Kode</label>
											<input type="text" class="form-control" id="code" name="code" required="">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Tanggal</label>
											<input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d');?>">
										</div>
										<div class="form-group">
											<label>Supplier</label>
											<select class="form-control" name="supp_id" id="supp_id"></select>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Keterangan</label>
											<textarea class="form-control" id="keterangan" name="keterangan"></textarea>
										</div>
									</div>
									<div class="col-md-9">
										<!-- <button style="float: right;" id="add-detail" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button> -->
										<a style="float: right;" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14"><i class="fa fa-plus"></i> <span>Tambah</span></a>
										<br>
										<br>
										<table class="table table-custom" id="advanced-usage">
											<thead>
											<tr>
												<!-- <th>Kategori Atas</th> -->
												<th>Kategori</th>
												<!-- <th>Sub Kategori</th> -->
												<th style="width: 10%;">Kode</th>
												<th style="width: 20%;">Produk</th>
												<th>Harga</th>
												<th>Jumlah</th>
												<th>Berat</th>
												<th>Satuan</th>
												<th>Total Harga</th>
												<!-- <th>Supplier</th> -->
												<!-- <th>Produk Alias</th> -->
												<!-- <th>No Tracking</th>
												<th>Link Referensi</th> -->
												<th>Tindakan</th>
											</tr>
											</thead>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5" style="float: right;">
										<div class="form-group">
											<input type="text" id="total_harga" class="form-control" name="total_harga" readonly="" style="    text-align: right;" value="0">
										</div>
									</div>
									<div class="col-md-2" style="float: right;">
										<div class="form-group">
											<label><b style="font-size: 18px;">Total :</b> </label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5" style="float: right;">
										<div class="form-group">
											<input type="text" id="total_harga_terbilang" class="form-control" name="total_harga_terbilang" readonly="" style="    text-align: right;">
										</div>
									</div>
									<div class="col-md-2" style="float: right;">
										<div class="form-group">
											<label><b style="font-size: 18px;">Terbilang:</b> </label>
										</div>
									</div>
								</div>
								<div class="row" style="display: none;">
									<div class="col-md-5" style="float: right;">
										<div class="form-group">
											<input type="text" id="dibayar" class="form-control" name="dibayar" required="" value="0">
										</div>
									</div>
									<div class="col-md-2" style="float: right;">
										<div class="form-group">
											<label><b style="font-size: 18px;">Dibayarkan:</b> </label>
										</div>
									</div>
								<!-- </div> -->
							</div>
							<hr>
							<div class="modal-footer">
								<button type="submit" class="btn btn-default btn-border">Simpan</button>
								<button class="btn btn-default btn-border" data-dismiss="modal">Batal</button>
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
					<h3 class="modal-title custom-font" id="myModalLabel">Form Tambah Pembeliaan</h3>
				</div>
				<form role="form" id="form" method="post">
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
									<label for="exampleInputEmail1">Nama</label>
									<select class="form-control" name="prod_id" id="prod_id">
										<option value="">--Pilih Produk--</option>
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
							
							<div class="col-md-6">
								<input type="hidden" id="id_detail" name="id_detail">
								<!-- <div class="form-group">
									<label for="exampleInputEmail1">Kategori</label>
									<select class="form-control" name="kate_id" id="kate_id" required="">
										<option value="">--Pilih Kategori--</option>
									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Produk</label>
									<select class="form-control" name="prod_id" id="prod_id">
										<option value="">--Pilih Produk--</option>
									</select>
								</div> -->
								<div class="form-group">
									<label for="exampleInputEmail1">Harga Beli</label>
									<input type="text" class="form-control" id="harga" name="harga" placeholder="Masukan Harga" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Jumlah</label>
									<input type="text" name="jumlah" class="form-control" id="jumlah" required="" placeholder="Masukan Jumlah" value="">
								</div>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputEmail1">Berat</label>
									<input type="text" name="berat" class="form-control" id="berat" placeholder="" readonly="">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputEmail1">Satuan</label>
									<input type="text" name="satuan" class="form-control" id="satuan" placeholder="" readonly="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Total</label>
									<input type="text" class="form-control" id="total" name="total" required="">
								</div>
							</div>
						</div>
						<div id="detail_special"></div>
						<div class="row" style="display: none;">
							
							<div class="col-md-6">
								<div class="form-group">
									<label>Supplier</label>
									<select class="form-control" name="supp_id" id="supp_id">
										<option value=""></option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-6" style="display: none;">
								<div class="form-group">
									<label>Kode Produk (Alias)</label>
									<input type="text" class="form-control" value="-" name="kode_produk_alias" id="kode_produk_alias">
								</div>
							</div>
						</div>
						<div class="row" style="display: none;">
							<div class="col-md-12">
								<div class="form-group">
									<label>No Tracking</label>
									<input type="text" class="form-control" name="no_tracking" id="no_tracking" >
								</div>
							</div>
						</div>
						<div class="row" style="display: none;">
							<div class="col-md-12">
								<div class="form-group">
									<label>Link Referensi</label>
									<textarea class="form-control" name="link_referensi" id="link_referensi"></textarea>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="modal-footer">
						<button type="submit" id="simpan" class="btn btn-default btn-border">Simpan</button>
						<button class="btn btn-default btn-border" data-dismiss="modal">Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
