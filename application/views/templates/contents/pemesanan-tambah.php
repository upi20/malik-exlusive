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
						<form role="form" id="form_head" method="post">
							<div class="modal-body">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="exampleInputEmail1">Kode</label>
											<input type="text" class="form-control" id="code" name="code" readonly="" required="">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Tanggal</label>
											<input type="date" class="form-control" id="tanggal" name="tanggal" required="">
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
													<th>Supplier</th>
													<th>Barang</th>
													<th>Harga</th>
													<th>Satuan</th>
													<th>Jumlah</th>
													<th>Total Harga</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-4" style="float: right;">
										<div class="form-group">
											<input type="text" id="total_harga" class="form-control" name="total_harga" readonly="" style="    text-align: right;">
										</div>
									</div>
									<div class="col-md-1" style="float: right;">
										<div class="form-group">
											<label><b style="font-size: 18px;">Total :</b> </label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4" style="float: right;">
										<div class="form-group">
											<input type="text" id="total_harga_terbilang" class="form-control" name="total_harga_terbilang" readonly="" style="    text-align: right;">
										</div>
									</div>
									<div class="col-md-1" style="float: right;">
										<div class="form-group">
											<label><b style="font-size: 18px;">Terbilang:</b> </label>
										</div>
									</div>
								</div>
								<!-- <div class="row"> -->
								<!-- <div class="col-md-4" style="float: right;">
										<div class="form-group">
											<input type="text" id="dibayar" class="form-control" name="dibayar" required="">
										</div>
									</div> -->
								<!-- <div class="col-md-2" style="float: right;">
										<div class="form-group">
											<label><b style="font-size: 18px;">Yang Dibayarkan :</b> </label>
										</div>
									</div> -->
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
				<h3 class="modal-title custom-font" id="myModalLabel">Form Tambah Barang</h3>
			</div>
			<form role="form" id="form" method="post">
				<div class="modal-body">
					<input type="hidden" name="id" value="0">
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" id="id_detail" name="id_detail">
							<div class="form-group">
								<label for="exampleInputEmail1">Supplier</label>
								<select class="form-control" name="id_supplier" id="id_supplier" required="">
									<option value="">--Pilih Supplier--</option>
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Barang</label>
								<select class="form-control" name="id_barang" id="id_barang" required="">
									<option value="">--Pilih Barang--</option>
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Harga</label>
								<input type="text" class="form-control" id="harga" name="harga" placeholder="Masukan Harga" required="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Satuan</label>
								<select class="form-control" name="satuan" id="satuan">
									<option value="">--Pilih Satuan--</option>
									<option value="Pcs">Pcs</option>
									<option value="Lusin">Lusin</option>
									<option value="Kodi">Kodi</option>
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Jumlah</label>
								<input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah" required="">
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