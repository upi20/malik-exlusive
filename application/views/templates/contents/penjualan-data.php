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
								<select class="form-control" name="filter_status_pembayaran" id="filter_status_pembayaran">
									<option value="">--Pilih Status Pembayaran--</option>
									<option value="Lunas">Lunas</option>
									<option value="Hutang">Hutang</option>
									<option value="Hangus">Hangus</option>
								</select>
							</div>
							<div class="col-md-2">
								<select class="form-control" name="filter_status_pengiriman" id="filter_status_pengiriman">
									<option value="0">--Pilih Status Pengiriman--</option>
									<option value="1">Belum Dikirim</option>
									<option value="Dikirim">Dikirim</option>
									<option value="Sampai">Sampai</option>
								</select>
							</div>
							<div class="col-md-2">
								<div class='input-group datepicker' data-format="L">
									<input type='text' placeholder="Pilih Tanggal Mulai" class="form-control" id="filter_tanggal_mulai" />
									<span class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</span>
								</div>
							</div>
							<div class="col-md-2">
								<div class='input-group datepicker' data-format="L">
									<input type='text' placeholder="Pilih Tanggal Akhir" class="form-control" id="filter_tanggal_akhir" />
									<span class="input-group-addon">
										<span class="fa fa-calendar"></span>
									</span>
								</div>
							</div>
							<div class="col-md-2">
								<select class="form-control" name="filter_sumber_penjualan" id="filter_sumber_penjualan">
									<option value="">--Pilih Sumber Penjualan--</option>
									<option value="online">online</option>
									<option value="offline">offline</option>
								</select>
							</div>
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
						<h1 class="custom-font">Data <strong><?= $title ?> Transaksi</strong></h1>
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
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<!-- <button style="float: right;" id="add-detail" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button> -->
									<?php
									if ($this->session->userdata('data')['level'] == "Admin O" or $this->session->userdata('data')['level'] == "Manager") : ?>
										<a style="float: right;" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" href="<?= base_url() ?>penjualan/tambah"><i class="fa fa-plus"></i> <span>Tambah</span></a>
										<br>
										<br>
									<?php else : ?>
										<?php endif; ?>?>
										<table class="table table-custom" id="advanced-usage">
											<thead>
												<tr>
													<th>ID</th>
													<th>Tanggal</th>
													<th>Nama</th>
													<th>No hp</th>
													<th>Alamat</th>
													<th>Total harga</th>
													<th>Di bayar</th>
													<th>Sisa Bayar</th>
													<th>Keterangan</th>
													<th>Sumber Penjualan</th>
													<th>Tanggal Kirim</th>
													<th>Kategori Atas</th>
													<th>Kategori</th>
													<th>Sub Kategori</th>
													<th>Kode Produk</th>
													<th>Produk</th>
													<th>Harga</th>
													<th>Jumlah</th>
													<th>Total Harga Produk</th>
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