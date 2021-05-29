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
						<!-- <form role="form" id="form_head" method="post"> -->
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12">
										<table class="table table-custom" id="advanced-usage">
											<thead>
											<tr>
												<th>ID</th>
												<th>Tanggal</th>
												<th>Nama</th>
												<!-- <th>No hp</th> -->
												<!-- <th>Alamat</th> -->
												<th>Total harga</th>
												<th>Di bayar</th>
												<th>Sisa</th>
												<th>Keterangan</th>
												<th>Kondisi</th>
												<th>Tanggal Kirim</th>
												<th>Status</th>
												<th>Aksi</th>
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
					<h3 class="modal-title custom-font" id="myModalLabel">Form Bayar Sisa</h3>
				</div>
				<form role="form" id="form" method="post">
					<div class="modal-body">
						<input type="hidden" name="id" value="0">
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" id="id_detail" name="id_detail">
								<div class="form-group">
									<label for="exampleInputEmail1">ID Penjualan</label>
									<input type="text" class="form-control" id="penj_id" name="penj_id" readonly required="">
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Total Harga</label>
									<input type="text" class="form-control" id="total_harga" name="total_harga" required="" readonly>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Pembayaran</label>
									<input type="text" class="form-control" id="pembayaran" name="pembayaran" required="" readonly>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Sisa</label>
									<input type="text" class="form-control" id="sisa_awal" name="sisa_awal" required="" readonly>
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Yang Dibayar</label>
									<input type="text" class="form-control" id="dibayar" name="dibayar" placeholder="Masukan Yang Dibayar" required="">
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Sisa</label>
									<input type="text" class="form-control" id="sisa" name="sisa" readonly required="">
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