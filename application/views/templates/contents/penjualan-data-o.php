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
	        	<form method="get" action="<?= base_url() ?>penjualan/data">
		        	<div class="row">
		        		<!-- <div class="col-md-2" style="display: none;">
		        			<select class="form-control" name="filter_status_pembayaran" id="filter_status_pembayaran">
		        				<option value="">--Pilih Status Pembayaran--</option>
		        				<option value="Lunas" >Lunas</option>
		        				<option value="Hutang">Hutang</option>
		        			</select>
		        		</div> -->
		        		<div class="col-md-2">
		        			<select class="form-control" name="filter_status_pengiriman" id="filter_status_pengiriman">
		        				<option value="">--Pilih Status Pengiriman--</option>
		        				<option value="proses" <?php if(isset($filter['filter_status_pengiriman'])) : ?><?= ($filter['filter_status_pengiriman'] == 'proses') ? 'selected' : '' ?><?php endif ?>>Diproses</option>
		        				<option value="kirim" <?php if(isset($filter['filter_status_pengiriman'])) : ?><?= ($filter['filter_status_pengiriman'] == 'kirim') ? 'selected' : '' ?><?php endif ?>>Dikirim</option>
		        				<option value="retur" <?php if(isset($filter['filter_status_pengiriman'])) : ?><?= ($filter['filter_status_pengiriman'] == 'retur') ? 'selected' : '' ?><?php endif ?>>Retur</option>
		        			</select>
		        		</div>
		        		<div class="col-md-2">
		        			<select class="form-control" name="filter_toko" id="filter_toko">
		        				<option value="">--Toko--</option>
		        				<?php foreach ($toko as $q):?>
		        					<option value="<?=$q['id']?>" <?php if(isset($filter['filter_toko'])) : ?><?= ($filter['filter_toko'] == $q["id"]) ? 'selected' : '' ?><?php endif ?>><?=$q['nama']?></option>
		        				<?php endforeach;?>
		        			</select>
		        		</div>
		        		<div class="col-md-3">
		        			<div class='input-group datepicker' data-format="L">
		                  <input type='text' placeholder="Pilih Tanggal Mulai" class="form-control" id="filter_tanggal_mulai" name="filter_tanggal_mulai" value="<?php if(isset($filter['filter_tanggal_mulai'])) : ?><?= $filter['filter_tanggal_mulai'] ?><?php endif ?>" />
		                  <span class="input-group-addon">
		                      <span class="fa fa-calendar"></span>
		                  </span>
		              </div>
		        		</div>
		        		<div class="col-md-3">
		        			<div class='input-group datepicker' data-format="L">
		                  <input type='text' placeholder="Pilih Tanggal Akhir" class="form-control" id="filter_tanggal_akhir" name="filter_tanggal_akhir" value="<?php if(isset($filter['filter_tanggal_akhir'])) : ?><?= $filter['filter_tanggal_akhir'] ?><?php endif ?>" />
		                  <span class="input-group-addon">
		                      <span class="fa fa-calendar"></span>
		                  </span>
		              </div>
		        		</div>
		        		<!-- <div class="col-md-2" style="display: none;">
		        			<select class="form-control" name="filter_vendor" id="filter_vendor">
		        				<option value="">--Pilih Sumber Penjualan--</option>
		        				<option value="online">online</option>
		        				<option value="offline">offline</option>
		        			</select>
		        		</div> -->
		        		<div class="col-md-2">
		        			<!-- <a href class="myIcon icon-hotpink icon-ef-9 icon-color"><i class="fa fa-umbrella"></i></a> -->
		                  <button class="btn btn-ef btn-ef-1-success btn-ef-1 btn-ef-1d btn-md" type="submit"><i class="fa fa-arrow-right"></i> Cari</button>

		        		</div>
		        	</div>
	        	</form>
	        </div>
	        <!-- /tile body -->

        </section>
        <!-- /tile -->
				<!-- tile -->
				<section class="tile">

					<!-- tile header -->
					<div class="tile-header dvd dvd-btm">
						<h1 class="custom-font">Data <strong><?=$title?> Transaksi</strong></h1>
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
										<a style="float: right;" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" href="<?= base_url() ?>penjualan/tambah"><i class="fa fa-plus"></i> <span>Tambah</span></a>
										<table class="table table-custom" id="advanced-usage">
											<thead>
											<tr>
												<th>ID</th>
												<th>Tanggal</th>
												<th>No. Resi</th>
												<th>Toko</th>
												<th>Konsumen</th>
												<th>Produk</th>
												<th>Harga</th>
												<th>Qty</th>
												<th>T.Harga</th>
												<th>Status</th>
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

	<script type="text/javascript">
		let filter = {
		<?php if(isset($filter['filter_tanggal_mulai'])) : ?>
			<?php foreach($filter as $k => $v) : ?>
				<?= $k ?> : '<?= $v ?>',
			<?php endforeach ?>
		<?php endif ?>
		}
	</script>