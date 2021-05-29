<section id="content">

	<div class="page page-tables-datatables">

		<div class="pageheader">

			<div class="page-bar">

				<ul class="page-breadcrumb">
					<li>
						<a href="<?=base_url()?>"><i class="fa fa-home"></i> Dashboard</a>
					</li>
					<li>
						<a href="#">Pengadaan</a>
					</li>
					<li>
						<a href="<?=base_url()?>pengadaan/data">Transaksi</a>
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
						<!-- <form role="form" id="form_head" method="post"> -->
							<input type="hidden" id="peng_id" value="<?=$peng_id?>" name="peng_id">
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
												<!-- <th>Sub Kategori</th> -->
												<th>Kode Produk</th>
												<th>Produk</th>
												<th>Jumlah</th>
												<th>Harga</th>
												<th>Total Harga</th>
												<th>Berat</th>
												<th>Vendor</th>
												<!-- <th>Produk Alias</th> -->
												<!-- <th>No Tracking</th> -->
												<th>Status</th>
												<!-- <th>Link Referensi</th> -->
												<th>Pilihan</th>
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
