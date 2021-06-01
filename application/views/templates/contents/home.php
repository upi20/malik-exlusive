<!-- ====================================================
			================= CONTENT ===============================
			===================================================== -->

<style>
	.card-tagihan {
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
		transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
		margin: 3px;
	}

	.card-tagihan:hover {
		box-shadow: 0 5px 5px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
	}
</style>
<section id="content">

	<div class="page page-tables-datatables">
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
				<form method="get" action="<?= base_url() ?>">
					<div class="row">
						<div class="col-md-4">
							<div class="row"></div>
						</div>
						<div class="col-md-3">
							<div class='input-group datepicker' data-format="L">
								<input type='text' placeholder="Pilih Tanggal Mulai" value="<?= $tanggal_mulai ?>" class="form-control" id="filter_tanggal_mulai" name="filter_tanggal_mulai" />
								<span class="input-group-addon">
									<span class="fa fa-calendar"></span>
								</span>
							</div>
						</div>
						<div class="col-md-3">
							<div class='input-group datepicker' data-format="L">
								<input type='text' placeholder="Pilih Tanggal Akhir" value="<?= $tanggal_akhir ?>" class="form-control" id="filter_tanggal_akhir" name="filter_tanggal_akhir" />
								<span class="input-group-addon">
									<span class="fa fa-calendar"></span>
								</span>
							</div>
						</div>
						<div class="col-md-2">
							<!-- <a href class="myIcon icon-hotpink icon-ef-9 icon-color"><i class="fa fa-umbrella"></i></a> -->
							<button class="btn btn-ef btn-ef-1-success btn-ef-1 btn-ef-1d btn-md" type="submit"><i class="fa fa-arrow-right"></i> Cari</button>

						</div>
					</div>
				</form>
			</div>
			<!-- /tile body -->

		</section>

		<div class="row">
			<!-- col -->
			<div class="col-md-12">

				<section class="tile">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font"><strong>Tagihan </strong>Admin</h1>

					</div>
					<!-- /tile header -->
					<!-- tile body -->
					<div class="tile-body">
						<div class="row">
							<!-- col -->
							<div class="col-md-12">
								<?php foreach ($admin as $a) : ?>
									<?php
									$tagihan = $this->db->select_sum('b.pede_total_harga')
										->join('penjualan_detail b', 'b.pede_penj_id = a.penj_id')
										->get_where(
											'penjualan a',
											[
												'a.penj_admin' => $a['admn_id'],
												'b.pede_status_pengiriman' => 'kirim',
												'a.penj_tanggal >=' => $tanggal_mulai,
												'a.penj_tanggal <=' => $tanggal_akhir
											]
										);
									if ($tagihan->row_array()['pede_total_harga'] == NULL) {
										$total_tagihan = 0;
									} else {
										$total_tagihan = $tagihan->row_array()['pede_total_harga'];
									}
									?>
									<div class="card-container col-lg-3 col-sm-6 col-sm-12">
										<div class="card shadow-sm card-tagihan">
											<!-- tile -->
											<section class="tile tile-simple tbox">
												<!-- tile widget -->
												<div class="tile-widget bg-blue text-center p-30 tcol">
													<a href class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-home"></i></a>
												</div>
												<!-- /tile widget -->
												<!-- tile body -->
												<div class="tile-body text-center tcol"><br>
													<p style="text-align:center">
													<h4 class="m-0"><?= $total_tagihan ?></h4>
													<span class="text-muted"><?= $a['admn_nama']; ?></span>
													</p>
												</div>
												<!-- /tile body -->
											</section>
											<!-- /tile -->
										</div>
									</div>
								<?php endforeach; ?>
								<!-- /col -->
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<!-- /tile body -->


		<div class="row">
			<!-- col -->
			<div class="col-md-12">

				<section class="tile">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font"><strong>Pembayaran </strong>Suplier</h1>

					</div>
					<!-- /tile header -->
					<!-- tile body -->
					<div class="tile-body">
						<div class="row">
							<!-- col -->
							<div class="col-md-12">
								<?php foreach ($suplier as $a) : ?>
									<?php
									$tagihan = $this->db->select_sum('b.pede_total_harga')
										->join('penjualan_detail b', 'b.pede_supp_id = a.supp_id')
										->join('penjualan c', 'c.penj_id = b.pede_penj_id')
										->get_where(
											'supplier a',
											[
												'b.pede_supp_id' => $a['supp_id'],
												'b.pede_status_pengiriman' => 'kirim',
												'c.penj_tanggal >=' => $tanggal_mulai,
												'c.penj_tanggal <=' => $tanggal_akhir
											]
										);
									if ($tagihan->row_array()['pede_total_harga'] == NULL) {
										$total_tagihan = 0;
									} else {
										$total_tagihan = $tagihan->row_array()['pede_total_harga'];
									}
									?>
									<div class="card-container col-lg-3 col-sm-6 col-sm-12">
										<div class="card shadow-sm card-tagihan">
											<!-- tile -->
											<section class="tile tile-simple tbox">
												<!-- tile widget -->
												<div class="tile-widget bg-blue text-center p-30 tcol">
													<a href class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-home"></i></a>
												</div>
												<!-- /tile widget -->
												<!-- tile body -->
												<div class="tile-body text-center tcol"><br>
													<p style="text-align:center">
													<h4 class="m-0"><?= $total_tagihan ?></h4>
													<span class="text-muted"><?= $a['supp_nama']; ?></span>
													</p>
												</div>
												<!-- /tile body -->
											</section>
											<!-- /tile -->
										</div>
									</div>
								<?php endforeach; ?>
								<!-- /col -->
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<!-- /tile body -->

		<div class="row">
			<!-- col -->
			<div class="col-md-12">

				<section class="tile">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font"><strong>Retur </strong>Perusahaan</h1>

					</div>
					<!-- /tile header -->
					<!-- tile body -->
					<div class="tile-body">
						<div class="row">
							<!-- col -->
							<div class="col-md-12">
								<?php foreach ($admin as $a) : ?>
									<?php
									$tagihan = $this->db->select_sum('b.pede_total_harga')
										->join('penjualan_detail b', 'b.pede_penj_id = a.penj_id')
										->get_where(
											'penjualan a',
											[
												'a.penj_admin' => $a['admn_id'],
												'b.pede_status_pengiriman' => 'retur',
												'a.penj_tanggal >=' => $tanggal_mulai,
												'a.penj_tanggal <=' => $tanggal_akhir
											]
										);

									if ($tagihan->row_array()['pede_total_harga'] == NULL) {
										$total_tagihan = 0;
									} else {
										$total_tagihan = $tagihan->row_array()['pede_total_harga'];
									}
									?>
									<div class="card-container col-lg-3 col-sm-6 col-sm-12">
										<div class="card shadow-sm card-tagihan">
											<!-- tile -->
											<section class="tile tile-simple tbox">
												<!-- tile widget -->
												<div class="tile-widget bg-blue text-center p-30 tcol">
													<a href class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-home"></i></a>
												</div>
												<!-- /tile widget -->
												<!-- tile body -->
												<div class="tile-body text-center tcol"><br>
													<p style="text-align:center">
													<h4 class="m-0"><?= $total_tagihan ?></h4>
													<span class="text-muted"><?= $a['admn_nama']; ?></span>
													</p>
												</div>
												<!-- /tile body -->
											</section>
											<!-- /tile -->
										</div>
									</div>
								<?php endforeach; ?>
								<!-- /col -->
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<!-- /tile body -->


		<div class="row">
			<!-- col -->
			<div class="col-md-12">

				<section class="tile">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font"><strong>Retur </strong>Suplier</h1>

					</div>
					<!-- /tile header -->
					<!-- tile body -->
					<div class="tile-body">
						<div class="row">
							<!-- col -->
							<div class="col-md-12">
								<?php foreach ($suplier as $a) : ?>
									<?php
									$tagihan = $this->db->select_sum('b.pede_total_harga')
										->join('penjualan_detail b', 'b.pede_supp_id = a.supp_id')
										->join('penjualan c', 'c.penj_id = b.pede_penj_id')
										->get_where(
											'supplier a',
											[
												'b.pede_supp_id' => $a['supp_id'],
												'b.pede_status_pengiriman' => 'retur',
												'c.penj_tanggal >=' => $tanggal_mulai,
												'c.penj_tanggal <=' => $tanggal_akhir
											]
										);
									if ($tagihan->row_array()['pede_total_harga'] == NULL) {
										$total_tagihan = 0;
									} else {
										$total_tagihan = $tagihan->row_array()['pede_total_harga'];
									}
									?>
									<div class="card-container col-lg-3 col-sm-6 col-sm-12">
										<div class="card shadow-sm card-tagihan">
											<!-- tile -->
											<section class="tile tile-simple tbox">
												<!-- tile widget -->
												<div class="tile-widget bg-blue text-center p-30 tcol">
													<a href class="myIcon icon-drank icon-ef-8 icon-color"><i class="fa fa-home"></i></a>
												</div>
												<!-- /tile widget -->
												<!-- tile body -->
												<div class="tile-body text-center tcol"><br>
													<p style="text-align:center">
													<h4 class="m-0"><?= $total_tagihan ?></h4>
													<span class="text-muted"><?= $a['supp_nama']; ?></span>
													</p>
												</div>
												<!-- /tile body -->
											</section>
											<!-- /tile -->
										</div>
									</div>
								<?php endforeach; ?>
								<!-- /col -->
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<!-- /tile body -->



		<div class="row">
			<!-- col -->
			<div class="col-md-12">

				<section class="tile">
					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font"><strong>Tabel </strong>Penjualan</h1>
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
									<li>
										<a role="button" tabindex="0" class="tile-refresh">
											<i class="fa fa-refresh"></i> Refresh
										</a>
									</li>
									<li>
										<a role="button" tabindex="0" class="tile-fullscreen">
											<i class="fa fa-expand"></i> Fullscreen
										</a>
									</li>
								</ul>

							</li>
							<!-- <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li> -->
						</ul>
					</div>
					<!-- /tile header -->
					<!-- tile body -->
					<div class="tile-body">
						<!-- <form role="form" id="form_head" method="post"> -->
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-custom">
										<thead>
											<tr>
												<th>Produk</th>
												<th>Permintaan</th>
												<th>Stok</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($table as $t) : ?>
												<tr>
													<td><?= $t['nama']; ?></td>
													<td><?= $t['permintaan'] ? $t['permintaan'] : "0"; ?></td>
													<td><?= $t['stok'] ? $t['stok'] : "0"; ?></td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
							<hr>
						</div>
						<!-- </form> -->
					</div>
					<!-- /tile body -->
				</section>
			</div>
		</div>
	</div>
	<!-- /col -->

</section>
<!--/ CONTENT -->