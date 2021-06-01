<section id="content">

	<div class="page page-tables-datatables">
		<div class="pageheader">
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<a href="<?= base_url() ?>"><i class="fa fa-home"></i> Dashboard</a>
					</li>
					<li>
						<a href="#">Kategori</a>
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
									<!-- <th>ID</th> -->
									<!-- <th>Level</th> -->
									<!-- <th>Parent</th> -->
									<th>Nama</th>
									<th>Deskripsi</th>
									<!-- <th>Status</th> -->
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
				<h3 class="modal-title custom-font" id="myModalLabel">Form Kategori</h3>
			</div>
			<form role="form" id="form" method="post">
				<div class="modal-body">
					<input type="hidden" name="id" value="0">
					<div class="row">
						<div class="col-md-12" style="display: none;">
							<div class="form-group">
								<label for="exampleInputEmail1">Level</label>
								<input type="number" class="form-control" id="level" placeholder="Masukan Level" name="level">
							</div>
						</div>
						<div class="col-md-6" style="display: none;">
							<div class="form-group">
								<label for="exampleInputEmail1">Parent 1</label>
								<select class="form-control" name="parent1" id="parent1">
									<option value="">Pilih Parent 1</option>
								</select>
							</div>
						</div>
						<div class="col-md-5" style="display: none;">
							<div class="form-group">
								<label for="exampleInputEmail1">Parent 2</label>
								<select class="form-control" name="parent2" id="parent2">
									<option value="">Pilih Parent 2</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama</label>
								<input type="text" class="form-control" id="nama" placeholder="Masukan nama" required="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Deskripsi</label>
								<textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
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