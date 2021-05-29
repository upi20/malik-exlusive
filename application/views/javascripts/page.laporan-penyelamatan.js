$(function() {

	/* BASIC ;*/
	var responsiveHelper_dt_basic = undefined;
	var responsiveHelper_datatable_fixed_column = undefined;
	var responsiveHelper_datatable_col_reorder = undefined;
	var responsiveHelper_datatable_tabletools = undefined;

	var breakpointDefinition = {
		tablet : 1024,
		phone : 480
	};

	let isi_nomer = 0;



	function code(){
		window.apiClient.codeOtomatis.lapor().done(function(res) {
			$("#lapo_id").val(res.id);
		});
	}

	const $table =
	$('#dt_basic').DataTable({
		sDom: "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			autoWidth: true,
			"oLanguage": {
				"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
			},
		  "ordering" : false,
	    "scrollX": true,
	    "processing": true,
	    "serverSide": true,
	    ajax: {
				url: "<?= base_url()?>laporan/penyelamatan/ax_data_isi/",
				data: null,
				type: 'POST'
			},
			columns: [
	      { data: "lapo_id" },
	      { data: "user_name" },
	      { data: "user_phone" },
	      { data: "lapo_nama" },
	      { data: "lapo_no_hp" },
	      { data: "lapo_alamat" },
	      { data: "lapo_keterangan" },
	      {
					data: "lapo_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
											+'<a href="<?=base_url()?>laporan/CetakPemadaman/cetak_pemadaman/'+data+'"><button class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
										+'</div>';
					}
				},
			],
			scrollX: true,
				preDrawCallback : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic) {
						// responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($(selector), breakpointDefinition);
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($("#dt_basic"), breakpointDefinition);
					}
				},
				rowCallback: function(nRow) {
					responsiveHelper_dt_basic.createExpandIcon(nRow);
				},
				drawCallback: function(oSettings) {
					responsiveHelper_dt_basic.respond();
				},
	});

	$('.edit-button').click(function() {
		$('#myModalEdit').modal();
	});

	/***  ROW FUNCTION  ***/



	$('#dt_basic tbody').on('click', '.lihat-button', function(ev) {
		ev.preventDefault();
		var file = $(this).val();
		$('#file_photo').attr("src","<?php echo base_url();?>assets/gambar/"+file);
		$('#myModalImage').modal();
	});
});
