<section id="content">

	<div class="page page-tables-datatables">

		<div class="pageheader">

			<div class="page-bar">

				<ul class="page-breadcrumb">
					<li>
						<a href="<?=base_url()?>"><i class="fa fa-home"></i> Dashboard</a>
					</li>
					<li>
						<a href="#">Pengiriman</a>
					</li>
					<li>
						<a href="<?=base_url()?>pengiriman/dikirim">Dikirim</a>
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
						<h1 class="custom-font">Data <strong>Pengiriman - Dikirim</strong></h1>
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
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12">
										<br>
										<table class="table table-custom" id="advanced-usage">
											<thead>
											<tr>
												<th>ID</th>
												<th>Nama</th>
												<th>No hp</th>
												<th>Alamat</th>
												<th>Total harga</th>
												<th>Di bayar</th>
												<th>Sisa</th>
												<!-- <th>Status Pengiriman</th> -->
												<th>Keterangan</th>
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
					<h3 class="modal-title custom-font" id="myModalLabel">Form Pengiriman</h3>
				</div>
				<form role="form" id="form" method="post">
					<div class="modal-body">
						<input type="hidden" name="id" value="0">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" id="id_detail" name="id_detail">
								<div class="form-group">
									<label for="exampleInputEmail1">ID Penjualan</label>
									<input type="text" class="form-control" id="penj_id" name="penj_id" readonly required="">
									<input type="hidden" class="form-control" id="pede_id" name="pede_id" readonly required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Tanggal</label>
									<input type="text" class="form-control" id="tanggal" name="tanggal" required="" readonly>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Keterangan</label>
									<input type="text" class="form-control" id="keterangan" readonly="" name="keterangan" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Total Harga</label>
									<input type="text" class="form-control" id="total_harga" name="total_harga" readonly required="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Di bayar</label>
									<input type="text" class="form-control" id="dibayar" readonly="" name="dibayar" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Sisa</label>
									<input type="text" class="form-control" id="sisa" name="sisa" readonly required="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead>
										<tr>
											<!-- <td>No</td> -->
											<td>Kategori</td>
											<td>Produk</td>
											<td>Harga</td>
											<td>Jumlah</td>
											<td>Total Harga</td>
										</tr>
									</thead>
									<tbody id="isi-berangkat">
									</tbody>
								</table>
							</div>
						</div>
						<br>
						
					</div>
					<hr>
					<div class="modal-footer">
						<button type="submit" class="btn btn-default btn-border">Sampai</button>
						<button class="btn btn-default btn-border" data-dismiss="modal">Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>