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
						<br>
						<table class="table table-custom" id="advanced-usage">
							<thead>
							<tr>
								<th>Produk</th>
								<th>Supplier</th>
								<th>Jumlah</th>
							</tr>
							</thead>
							<tbody>
								<?php foreach($data as $r) : ?>
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
