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
			        		<div class="col-md-3">
			        			<select class="form-control" name="filter_supplier" id="filter_supplier">
			        				<option value="">--Supplier--</option>
			        				<?php foreach ($supplier as $q):?>
			        					<option value="<?=$q['supp_id']?>"><?=$q['supp_nama']?></option>
			        				<?php endforeach;?>
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
						<h1 class="custom-font">Data <strong><?=$title?> Transaksi: </strong> <b style="text-align: right;" id="total-harga"><?php echo $this->libs->rupiah($total_harga);?></b></h1>
					</div>
					<!-- /tile header -->

					<!-- tile body -->
					<div class="tile-body">
						<!-- <form role="form" id="form_head" method="post"> -->
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12">
										
										<table id="advanced-usage"  class="display nowrap" style="width:100%">
											<thead>
												<tr>
													<th>Supplier</th>
													<th>No. Resi</th>
													<th>Konsumen</th>
													<th>Kode</th>
													<th>Produk</th>
													<th>Harga</th>
													<th>Jumlah</th>
													<th>Total Harga</th>
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
