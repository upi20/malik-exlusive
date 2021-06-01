<section id="content">

	<div class="page page-tables-datatables">
		<div class="pageheader">

			<div class="page-bar">

				<ul class="page-breadcrumb">
					<li>
						<a href="<?= base_url() ?>"><i class="fa fa-home"></i> Dashboard</a>
					</li>
					<li>
						<a href="#">Laporan</a>
					</li>
					<li>
						<a href="<?= base_url() ?>laporan/stok_supplier">Stok Supplier</a>
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
						<div class="pull-right">
							<a href="<?= base_url() ?>laporan/stok_supplier/export_excel" style="float: right;" class="btn btn-success mb-10" id="btn-cetak-excel"> <span>Cetak Excel</span></a>
						</div>
						<table class="table table-custom" id="advanced-usage">
							<thead>
								<tr>
									<th>Produk</th>
									<th>Supplier</th>
									<th>Jumlah</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $r) : ?>
									<tr>
										<td><?= $r['prod_nama'] ?></td>
										<td><?= $r['supp_nama'] ?></td>
										<td><?= $r['jumlah'] ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
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