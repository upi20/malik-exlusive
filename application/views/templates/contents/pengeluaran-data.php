<section id="content">

				<div class="page page-tables-datatables">

					<div class="pageheader">

						<div class="page-bar">

							<ul class="page-breadcrumb">
								<li>
									<a href="<?=base_url()?>"><i class="fa fa-home"></i> Dashboard</a>
								</li>
								<li>
									<a href="#">Pengeluaran</a>
								</li>
								<li>
									<a href="<?=base_url()?>pengeluaran/data">Data</a>
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
									<div class="row">
										<div class="col-md-6"><div id="tableTools"></div></div>
										<div class="col-md-6">
											<button style="float: right;" class="btn btn-ef btn-ef-5 btn-ef-5b btn-success mb-10" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14"><i class="fa fa-plus"></i> <span>Tambah</span></button>
										</div>
									</div>
									<br>
									<table class="table table-custom" id="advanced-usage">
										<thead>
										<tr>
											<th>ID</th>
											<th>Tanggal</th>
											<th>Kategori</th>
											<th>Keterangan</th>
											<th>Nominal</th>
											<th>Untuk</th>
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
							<h3 class="modal-title custom-font" id="myModalLabel">Form Pengeluaran</h3>
						</div>
						<form role="form" id="form" method="post">
							<div class="modal-body">
								<input type="hidden" name="id" value="0">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="exampleInputEmail1">Kategori</label>
											<select class="form-control" id="kategori" required="">
												<option value="">Pilih Kategori</option>
												<option value="Divisi 1">Divisi 1</option>
												<option value="Divisi 2">Divisi 2</option>
												<option value="Divisi 3">Divisi 3</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="exampleInputEmail1">Keterangan</label>
											<textarea class="form-control" id="keterangan" name="keterangan" required="" placeholder="Masukan Keterangan"></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="exampleInputEmail1">Nominal</label>
											<input type="text" name="nominal" id="nominal" required="" class="form-control" placeholder="Masukan Nominal">		
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="exampleInputEmail1">Untuk</label>
											<select class="form-control" id="untuk" required="">
												<option value="">Untuk</option>
												<option value="Makan">Makan</option>
												<option value="Sewa">Sewa</option>
												<option value="Bensin">Bensin</option>
												<option value="Suplemen">Suplemen</option>
												<option value="Rumput">Rumput</option>
												<option value="Barang">Barang</option>
												<option value="Atk">Atk</option>
												<option value="Lainya">Lainya</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="exampleInputEmail1">Tanggal</label>
											<input type="date" id="tanggal" class="form-control" name="tanggal">
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