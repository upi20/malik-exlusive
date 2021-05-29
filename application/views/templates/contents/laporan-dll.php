<!-- MAIN CONTENT -->
<div id="content">

	<!-- row -->
	<div class="row">
		
		<!-- col -->
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
			<h1 class="page-title txt-color-blueDark">
				<!-- PAGE HEADER -->
				<i class="fa-fw fa fa-home"></i> Laporan Dll
			</h1>
		</div>
		<!-- end col -->
		
	</div>
	<!-- end row -->
	
	<!--
		The ID "widget-grid" will start to initialize all widgets below 
		You do not need to use widgets if you dont want to. Simply remove 
		the <section></section> and you can use wells or panels instead 
		-->
	
	<!-- widget grid -->
	<section id="widget-grid" class="">
	
		<!-- row -->
		<div class="row">
			
			<!-- NEW WIDGET START -->
			<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
				<!-- Widget ID (each widget will need unique ID)-->
				<div class="jarviswidget" id="wid-id-0"
					data-widget-colorbutton="false"
					data-widget-editbutton="false"
					data-widget-deletebutton="false">
					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2>Data Laporan Dll</h2>
					</header>
	
					<!-- widget div-->
					<div>
						
						<!-- widget edit box -->
						<div class="jarviswidget-editbox">
							<!-- This area used as dropdown edit box -->
							<input class="form-control" type="text">	
						</div>
						<!-- end widget edit box -->
						
						<!-- widget content -->
						<div class="widget-body">

							<div class="pull-right">
								<button type="button" class="btn btn-success" id="add-button"><i class="fa fa-plus"></i> Cetak</button>
							</div>
							<br>				
							<br>				
							<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
								<thead>			                
									<tr>
										<th data-hide="id">ID</th>
										<th data-class="user_id"> Nama</th>
										<th data-class="user_id"> No HP</th>
										<th data-class="nama"> Nama PJ</th>
										<th data-class="no_hp"> Nomor Hp PJ</th>
										<th data-class="alamat"> Alamat</th>
										<th data-class="keterangan"> Keterangan</th>
										<th data-hide="status"> Photo</th>
									</tr>
								</thead>
							</table>	
						</div>
						<!-- end widget content -->
						
					</div>
					<!-- end widget div -->
					
				</div>
				<!-- end widget -->
	
			</article>
			<!-- WIDGET END -->
			
		</div>
	
		<!-- end row -->
	
	</section>
	<!-- end widget grid -->

</div>
<!-- END MAIN CONTENT -->


<div class="modal fade" id="myModalImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabelImage">File Image</h4>
			</div>
			<form id="form" method="post">
				<input type="hidden" name="id" value="0">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="alamat">Photo</label>
								<img src="" id="file_photo" style="width: 100%;">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="cancel" class="btn btn-default" data-dismiss="modal">
						Tutup
					</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
