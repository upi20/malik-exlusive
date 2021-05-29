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
									<h1 class="custom-font">Data <strong>Produk</strong></h1>
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
									<table class="table table-custom" id="advanced-usage">
										<thead>
										<tr>
											<th>ID</th>
											<th>Kategori</th>
											<th>Produk</th>
											<th>Stok</th>
											<th>Harga</th>
											<th>Berat</th>
											<th>Status</th>
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
					<h3 class="modal-title custom-font" id="myModalLabel">Form Ubah Lokal</h3>
				</div>
				<form role="form" id="form" method="post">
					<div class="modal-body">
						<input type="hidden" name="id" value="0">
						<div class="row">	
							<div class="col-md-12">
								<input type="hidden" id="id_detail" name="id_detail">
								<div class="form-group">
									<label for="exampleInputEmail1">Domba</label>
									<input type="hidden" class="form-control" id="prod_id" name="prod_id" readonly required="">
									<input type="text" class="form-control" id="prod_nama" name="prod_nama" readonly required="">
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Blok</label>
									<select class="form-control" name="blok_id" id="blok_id">
									</select>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Rumah</label>
									<select class="form-control" name="ruma_id" id="ruma_id">
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

	<!-- Splash Modal 2 -->
	<div class="modal splash fade" id="splash2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title custom-font" id="myModalLabel">Form Kelas</h3>
				</div>
				<form role="form" id="form2" method="post">
					<div class="modal-body">
						<!-- <input type="hidden" name="id" value="0"> -->
						<input type="hidden" name="kelas_lama" id="kelas_lama">
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" id="prod_id2" name="prod_id2">
								<div class="form-group">
									<label for="exampleInputEmail1">Kelas</label>
									<select class="form-control" name="kelas" id="kelas">
										<option value="">Pilih Kelas</option>
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

	<div class="modal splash fade" id="splash3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title custom-font" id="myModalLabel">Form Status</h3>
				</div>
				<form role="form" action="<?=base_url();?>produk/ubahStatus" method="post">
					<div class="modal-body">
						<input type="hidden" name="prod_id_status" id="prod_id_status" value="0">
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" id="prod_id2" name="prod_id2">
								<div class="form-group">
									<label for="exampleInputEmail1">Status</label>
									<select class="form-control" name="status" id="status">
										<option value="">Pilih Status</option>
										<option value="mati">Mati</option>
										<option value="hilang">Hilang</option>
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

<!-- 	<div class="modal splash fade" id="splash4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title custom-font" id="myModalLabel">Tambah Gambar Hewan</h3>
				</div>
				<form role="form" action="<?=base_url();?>produk/ubahPhotoJenis" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<input type="hidden" name="prod_id_photos" id="prod_id_photos" value="0">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="exampleInputEmail1">Gambar</label>
									<input type="file" class="form-control" name="gambar">
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
	</div> -->