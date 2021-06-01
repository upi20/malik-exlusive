<section id="content">

	<div class="page page-tables-datatables">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<a href="<?= base_url() ?>"><i class="fa fa-home"></i> Dashboard</a>
					</li>
					<li>
						<a href="#">Supplier</a>
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
						<h1 class="custom-font">Data <strong><?= $title ?></strong></h1>

					</div>
					<!-- /tile header -->

					<!-- tile body -->
					<div class="tile-body">
						<div class="row">
							<div class="col-md-6">
								<div id="tableTools"></div>
							</div>
							<div class="col-md-6">
								<button id="clickTambah" style="float: right;" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14"><i class="fa fa-plus"></i> <span>Tambah</span></button>
							</div>
						</div>
						<br>
						<table class="table table-custom" id="advanced-usage">
							<thead>
								<tr>
									<th>ID</th>
									<th>Kode</th>
									<th>Nama</th>
									<th>Alamat</th>
									<!-- <th>Status</th> -->
									<!-- <th>Ratting</th> -->
									<!-- <th>Komentar</th> -->
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
				<h3 class="modal-title custom-font" id="myModalLabel">Form Supplier</h3>
			</div>
			<form role="form" id="form" method="post">
				<div class="modal-body">
					<input type="hidden" name="id" value="0">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Kode</label>
								<input type="text" class="form-control" id="kode" placeholder="Masukan kode" required="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama</label>
								<input type="text" class="form-control" id="nama" placeholder="Masukan nama" required="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="display: none;">
							<div class="form-group">
								<label for="exampleInputEmail1">Email</label>
								<input type="email" class="form-control" id="email" placeholder="Masukan email">
							</div>
						</div>
						<div class="col-md-6" style="display: none;">
							<div class="form-group">
								<label for="exampleInputEmail1">Status</label>
								<select class="form-control" id="status">
									<option selected value="Dalam Negeri">Dalam Negeri</option>
									<option value="Luar Negeri">Luar Negeri</option>
								</select>
							</div>
						</div>
						<div class="col-md-3" style="display: none;">
							<div class="form-group">
								<label for="exampleInputEmail1">No. Telpon</label>
								<input type="text" class="form-control" id="telpon" placeholder="Masukan telpon">
							</div>
						</div>
						<div class="col-md-3" style="display: none;">
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
						<div class="col-md-6" style="display: none;">
							<div class="form-group">
								<label for="exampleInputEmail1">Komentar</label>
								<textarea class="form-control" id="komen"></textarea>
							</div>
						</div>
					</div>
					<div class="row" style="display: none;">
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Ratting</label>
								<br>
								<div class="col-md-2">
									<label class="checkbox checkbox-custom">
										<input name="rating" id="rating" value="1" type="radio"><i></i> 1
									</label>
								</div>
								<div class="col-md-2">
									<label class="checkbox checkbox-custom">
										<input name="rating" id="rating" value="2" type="radio"><i></i> 2
									</label>
								</div>
								<div class="col-md-2">
									<label class="checkbox checkbox-custom">
										<input name="rating" id="rating" value="3" type="radio"><i></i> 3
									</label>
								</div>
								<div class="col-md-2">
									<label class="checkbox checkbox-custom">
										<input name="rating" id="rating" value="4" type="radio"><i></i> 4
									</label>
								</div>
								<div class="col-md-2">
									<label class="checkbox checkbox-custom">
										<input name="rating" id="rating" value="5" type="radio"><i></i> 5
									</label>
								</div>

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