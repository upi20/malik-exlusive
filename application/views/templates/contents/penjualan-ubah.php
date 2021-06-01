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
						<form role="form" action="<?= base_url() ?>penjualan/data/ubahSimpan" id="form_head" method="post">
							<div class="modal-body">
								<div class="row">
									<input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('data')['id'] ?>">
									<div class="col-md-3">
										<div class="form-group">
											<label for="exampleInputEmail1">Kode</label>
											<input type="text" class="form-control" id="code" name="code" readonly="" required="" value="<?= $detail['penj_id'] ?>">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Nama Pembeli</label>
											<input type="text" class="form-control" id="nama" name="nama" required="" value="<?= $detail['penj_nama'] ?>">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">No Hp Pembeli</label>
											<input type="number" class="form-control" id="no_hp" name="no_hp" required="" value="<?= $detail['penj_no_hp'] ?>">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Alamat Pembeli</label>
											<textarea class="form-control" id="alamat" name="alamat" required=""><?= $detail['penj_alamat'] ?></textarea>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Kurir</label>
											<select class="form-control" name="kurir" id="kurir">
												<option value="JNE">JNE</option>
												<option value="JNT">JNT</option>
												<option value="POS">POS</option>
											</select>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Ongkir</label>
											<input type="number" value="<?= $detail['penj_ongkir'] ?>" class="form-control" id="ongkir" name="ongkir" value="0" required="">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="exampleInputEmail1">ID Transaksi (Marketplace)</label>
											<input type="text" class="form-control" id="id_marketplace" name="id_marketplace" value="<?= $detail['penj_id_marketplace'] ?>">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Tanggal</label>
											<input type="date" class="form-control" id="tanggal" name="tanggal" required="" value="<?= $detail['penj_tanggal'] ?>">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Tanggal Pengiriman</label>
											<input type="date" class="form-control" name="tanggal_pengiriman" id="tanggal_pengiriman" value="<?= $detail['penj_tanggal_pengiriman'] ?>">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Sumber Penjualan</label>
											<select class="form-control" name="supe_id" id="supe_id">
												<option value="">Pilih Sumber Penjualan</option>
												<?php foreach ($listSumberPenjualan as $sp) : ?>
													<?php if ($detail['penj_supe_id'] == $sp['supe_id']) : ?>
														<option selected value="<?= $sp['supe_id'] ?>"><?= $sp['supe_nama'] ?></option>
													<?php else : ?>
														<option value="<?= $sp['supe_id'] ?>"><?= $sp['supe_nama'] ?></option>
													<?php endif; ?>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Keterangan</label>
											<textarea class="form-control" id="keterangan" name="keterangan" required=""><?= $detail['penj_keterangan'] ?></textarea>
										</div>
									</div>
									<div class="col-md-6">
										<table class="table table-custom" id="advanced-usage">
											<thead>
												<tr>
													<th>Kategori Atas</th>
													<th>Kategori</th>
													<th>Sub Kategori</th>
													<th>Produk</th>
													<th>Harga</th>
													<th>Jumlah</th>
													<th>Total Harga</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($detailProduk as $q) : ?>
													<tr>
														<td><?= $q['kate_nama_1'] ?></td>
														<td><?= $q['kate_nama_2'] ?></td>
														<td><?= $q['kate_nama_3'] ?></td>
														<td><?= $q['prod_nama'] ?></td>
														<td><?= $q['pede_harga'] ?></td>
														<td><?= $q['pede_jumlah'] ?></td>
														<td><?= $q['pede_total_harga'] ?></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
										<hr>
										<div class="row">
											<div class="col-md-8" style="float: right;">
												<div class="form-group">
													<input type="text" id="total_harga" class="form-control" name="total_harga" readonly="" value="<?= $this->libs->rupiah($detail['penj_total_harga']) ?>" style="text-align: right;">
												</div>
											</div>
											<div class="col-md-4" style="float: right;">
												<div class="form-group">
													<label><b style="font-size: 14px;">Nominal Transaksi :</b> </label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="modal-footer">
								<button type="submit" class="btn btn-default btn-border">Simpan</button>
								<!-- <button class="btn btn-default btn-border" data-dismiss="modal">Batal</button> -->
								<a class="btn btn-default btn-border" href="<?= base_url() ?>penjualan/data">Batal</a>
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
				<h3 class="modal-title custom-font" id="myModalLabel">Form Tambah Penjualan</h3>
			</div>
			<form role="form" id="form" method="post">
				<div class="modal-body">
					<input type="hidden" name="id" value="0">
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" id="id_detail" name="id_detail">

							<div class="form-group">
								<label for="exampleInputEmail1">No. Hewan</label>
								<br>
								<select style="width: 100%;" tabindex="3" class="chosen-select" id="produk" name="produk">
								</select>
							</div>
							<div class="form-group">
								<!-- <label for="exampleInputEmail1">Harga Awal</label> -->
								<input type="hidden" class="form-control" id="harga_awal" name="harga_awal" placeholder="Harga Awal" required="" readonly="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Kelas</label>
								<select class="form-control" name="kelas" id="kelas">
								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Harga</label>
								<input type="text" class="form-control" id="harga" name="harga" placeholder="Masukan Harga" required="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Keterangan</label>
								<textarea class="form-control" name="keterangan_detail" id="keterangan_detail"></textarea>
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