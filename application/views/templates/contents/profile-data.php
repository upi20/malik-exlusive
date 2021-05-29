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
						<form role="form" action="<?=base_url()?>profile/data/ubah" id="form_head" method="post">
							<div class="modal-body">
								<div class="row">
									<input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('data')['id'] ?>">
									<div class="col-md-12">
										<div class="form-group">
											<label for="exampleInputEmail1">E-mail</label>
											<input readonly="" type="email" class="form-control" id="email" name="email" required="" value="<?=$profile['user_email']?>">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Nama</label>
											<input readonly="" type="text" class="form-control" id="nama" name="nama" required="" value="<?=$profile['user_name']?>">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">No Hp</label>
											<input readonly="" type="number" class="form-control" id="no_hp" name="no_hp" required="" value="<?=$profile['user_phone']?>">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Alamat</label>
											<textarea readonly class="form-control" id="alamat" name="alamat" required=""><?=$profile['user_address']?></textarea>
										</div>

										<hr>
										<h4 align="center">Ubah Password</h4>
										<div class="form-group">
											<label for="exampleInputEmail1">Password Baru</label>
											<input type="password" class="form-control" id="password" name="password">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Ulangi Password Baru</label>
											<input type="password" class="form-control" id="password_baru" name="password_baru">
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
					<!-- /tile body -->

				</section>
				<!-- /tile -->

			</div>
			<!-- /col -->
		</div>
		<!-- /row -->

	</div>
	
</section>
