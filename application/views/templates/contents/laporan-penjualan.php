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
									<h1 class="custom-font">Data <strong>Laporan - Penjualan</strong></h1>
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
											<a href="<?=base_url()?>laporan/penjualan/export_excel"><button style="float: right;" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" data-toggle="modal" data-target="#" data-options="splash-2 splash-ef-14"><i class="fa fa-plus"></i> <span>Cetak</span></button></a>
										</div>
									</div>
									<br>
									<table class="table table-custom" id="advanced-usage">
										<thead>
										<tr>
											<th>ID</th>
											<th>Total Harga</th>
											<th>Dibayar</th>
											<th>Sisa</th>
											<th>Tanggal Transaksi</th>
											<th>Tanggal Pengiriman</th>
											<th>Keterangan</th>
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
