<section id="content">

				<div class="page page-tables-datatables">

					<div class="pageheader">

						<div class="page-bar">

							<ul class="page-breadcrumb">
								<li>
									<a href="<?=base_url()?>"><i class="fa fa-home"></i> Dashboard</a>
								</li>
								<li>
									<a href="#">Laporan</a>
								</li>
								<li>
									<a href="<?=base_url()?>laporan/pengadaan">Pengadaan</a>
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
								<h1 class="custom-font"><strong>Filter</strong> Data Sample</h1>
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
									<div class="col-md-3">
										<select class="form-control" name="filter_status_pembayaran" id="filter_status_pembayaran">
											<option value="">--Pilih Status Pembayaran--</option>
											<option value="Lunas">Lunas</option>
											<option value="Hutang">Hutang</option>
										</select>
									</div>
									<div class="col-md-2" style="display: none;">
										<select class="form-control" name="filter_status_pengiriman" id="filter_status_pengiriman">
											<option value="0">--Pilih Status Pengiriman--</option>
											<option value="1">Belum Dikirim</option>
											<option value="Dikirim">Dikirim</option>
											<option value="Sampai">Sampai</option>
										</select>
									</div>
									<div class="col-md-3">
										<div class='input-group datepicker' data-format="L">
										<input type='text' placeholder="Pilih Tanggal Mulai" class="form-control" id="filter_tanggal_mulai" />
										<span class="input-group-addon">
											<span class="fa fa-calendar"></span>
										</span>
									</div>
									</div>
									<div class="col-md-3">
										<div class='input-group datepicker' data-format="L">
										<input type='text' placeholder="Pilih Tanggal Akhir" class="form-control" id="filter_tanggal_akhir" />
										<span class="input-group-addon">
											<span class="fa fa-calendar"></span>
										</span>
									</div>
									</div>
									<div class="col-md-2" style="display: none;">
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
									<h1 class="custom-font">Data <strong>Laporan - Pengadaan</strong></h1>
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
											<a href="<?=base_url()?>laporan/pengadaan/cetakPdf"><button style="float: right;" target="_BLANK" class="btn btn-primary mb-10"><span>Cetak PDF</span></button></a>
										</div>
									</div>
									<br>
									<table class="table table-custom" id="advanced-usage">
										<thead>
										<tr>
											<th>ID</th>
											<th>Total Harga</th>
											<th>Sisa</th>
											<th>Dibayar</th>
											<th>Keterangan</th>
											<th>Tanggal</th>
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
