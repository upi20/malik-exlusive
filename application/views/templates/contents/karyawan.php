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
								<button id="clickTambah" style="float: right;" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14"><i class="fa fa-plus"></i> <span>Tambah Karyawan</span></button>
							</div>
						</div>
						<br>
						<table class="table table-custom" id="advanced-usage">
							<thead>
							<tr>
								<th>ID</th>
								<th>Nama</th>
								<th>No. HP</th>
								<th>Alamat</th>
								<th>Driver</th>
								<th>Total Hutang</th>
								<th>Dibayar</th>
								<th>Sisa</th>
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
				<h3 class="modal-title custom-font" id="myModalLabel"></h3>
			</div>
			<form role="form" id="form" method="post">
					<div class="modal-body">
						<div id="div-karyawan">
							<input type="hidden" name="id" value="0">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">Nama</label>
										<input type="text" class="form-control" id="nama" placeholder="Masukan nama">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">No. HP</label>
										<input type="text" class="form-control" id="no_hp" placeholder="Masukan no hp">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="exampleInputEmail1">Alamat</label>
										<textarea class="form-control" id="alamat"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="exampleInputEmail1">Driver</label>
										<select class="form-control" name="driver" id="driver">
											<option value="ya">Ya</option>
											<option value="tidak">Tidak</option>
										</select>
									</div>
								</div>
							</div>
					</div>
					<div id="div-casbon">
						<input type="hidden" name="hutang_id" id="hutang_id" value="0">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="exampleInputEmail1">Nama</label>
										<input type="text" class="form-control" id="hutang_nama" placeholder="Masukan nama" readonly="">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="exampleInputEmail1">Nominal</label>
										<input type="text" class="form-control" id="jumlah" placeholder="Masukan Nominal Casbon">
									</div>
								</div>
							</div>
					</div>
					<div id="div-bayar">
						<input type="hidden" name="bayar_id" id="bayar_id" value="0">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="exampleInputEmail1">Nama</label>
										<input type="text" class="form-control" id="bayar_nama" placeholder="Masukan nama" readonly="">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="exampleInputEmail1">Nominal</label>
										<input type="text" class="form-control" id="bayar_jumlah" placeholder="Masukan Nominal Bayar">
									</div>
								</div>
							</div>
					</div>
					<hr>
					<div class="modal-footer">
						<button type="submit" class="btn btn-default btn-border">Simpan</button>
						<button class="btn btn-default btn-border" data-dismiss="modal">Batal</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
