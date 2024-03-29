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
						<!-- <form role="form" id="form_head" method="post"> -->
						<input type="hidden" id="peng_id" value="<?= $peng_id ?>" name="peng_id">
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<!-- <button style="float: right;" id="add-detail" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button> -->
									<table class="table table-custom" id="advanced-usage">
										<thead>
											<tr>
												<th>ID</th>
												<th>Kategori Atas</th>
												<th>Kategori</th>
												<th>Sub Kategori</th>
												<th>Produk</th>
												<th>Jumlah</th>
												<th>Harga</th>
												<th>Total Harga</th>
												<th>Berat</th>
												<th>Vendor</th>
												<th>Produk Alias</th>
												<th>No Tracking</th>
												<th>Link Referensi</th>
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


<!-- Splash Modal -->
<div class="modal splash fade" id="splash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title custom-font" id="myModalLabel">Form Tukar Domba</h3>
			</div>
			<form role="form" action="<?php echo base_url(); ?>pengadaan/data/olah" method="post">
				<div class="modal-body">
					<input type="hidden" name="id" value="0">
					<div class="row">
						<div class="col-md-6">
							<input type="hidden" id="id_detail" name="id_detail">
							<div class="form-group">
								<label for="exampleInputEmail1">ID Pengadaan</label>
								<input type="text" class="form-control" id="peng_id" name="peng_id" readonly>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Yang Dibayar</label>
								<input type="text" class="form-control" id="dibayar" name="dibayar" placeholder="Masukan Yang Dibayar" readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Total Harga</label>
								<input type="text" class="form-control" id="total_harga" name="total_harga" readonly>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Sisa</label>
								<input type="text" class="form-control" id="sisa" name="sisa" readonly>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Kelas Awal</th>
										<th>Kelas Akhir</th>
									</tr>
								</thead>
								<tbody id="isi_domba"></tbody>
							</table>
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