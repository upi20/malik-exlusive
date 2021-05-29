 $(function() {

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}

	value_filter_blok();

	$('#blok_id').on('change', () =>
	{
		var blok_id = $("#blok_id").val();
		value_filter_rumah(blok_id);
	});

	function value_filter_blok(){
		$("#blok_id").empty();
		$("#blok_id").append('<option value="" selected>Pilih Blok</option>');
		window.apiClient.filter.referensiBlok().done(function(res) {
				$.each(res, function(value, key) {
					$("#blok_id").append("<option value='"+key.blok_id+"'>"+key.blok_nama+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	function value_filter_rumah(blok_id=null){
		$("#ruma_id").empty();
		$("#ruma_id").append('<option value="">Pilih Rumah</option>');
		window.apiClient.filter.referensiRumah(blok_id).done(function(res) {
				$.each(res, function(value, key) {
					$("#ruma_id").append("<option value='"+key.ruma_id+"'>"+key.ruma_nama+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>produk/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "prod_id" },
			{ "data": "prod_ruma_id" },
			{ "data": "kela_nama" },
			{ "data": "prod_nama" },
			// { "data": "prod_stok" },
			// { "data": "prod_harga_beli" },
			// { "data": "prod_harga_jual" },
			{ "data": "prod_status" },
		],
		"aoColumnDefs": [
		  { 'bSortable': false, 'aTargets': [ "no-sort" ] }
		]
	});


	var colvis = new $.fn.dataTable.ColVis(table4);

	$(colvis.button()).insertAfter('#colVis');
	$(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button');

	var tt = new $.fn.dataTable.TableTools(table4, {
		sRowSelect: 'single',
		"aButtons": [
			'copy',
			'print', {
				'sExtends': 'collection',
				'sButtonText': 'Save',
				'aButtons': ['csv', 'xls', 'pdf']
			}
		],
		"sSwfPath": "<?php echo base_url();?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
	});

	$(tt.fnContainer()).insertAfter('#tableTools');
	//*initialize responsive datatable


});

function lokal(id)
{
	var res = id.split("|");
	$('#prod_id').val(res[0]);
	if(res[1] != 'null'){
		$('#blok_id').val(res[1]);
	}else{
		$('#blok_id').val(res[1]);
	}
	let blok_id = $("#blok_id").val();
	if(res[2] != 'null'){
		$("#ruma_id").empty();
		$("#ruma_id").val(res[2]);
		$("#ruma_id").append('<option value="">Pilih Rumah</option>');
		window.apiClient.filter.referensiRumah(blok_id).done(function(res) {
			let val = res[2];
			// val = Number(res[2]);
				$.each(res, function(value, key) {
					switch(key.ruma_id) {
					  case val:
					    // code block
						$("#ruma_id").append("<option selected value='"+key.ruma_id+"'>"+key.ruma_nama+"</option>");						
					    // break;
					  default:
						$("#ruma_id").append("<option value='"+key.ruma_id+"'>"+key.ruma_nama+"</option>");						
					    // code block
					}
			  	});
			// $("#ruma_id").val(res[2]);
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}else{
	}
	
	$('#prod_nama').val(res[3]);
}

function kelas(id)
{
	$('#kelas').empty()
	let rest = id.split('|')
	$('#prod_id2').val(rest[0])
	$('#kelas_lama').val(rest[1])

	window.apiClient.filter.referensiKelas().done(function(res) {
	$.each(res, function(value, key) {
		$("#kelas").append("<option value='"+key.kela_id+"'>"+key.kela_nama+"</option>");
		$("#kelas").val(rest[1]);
	 })
	}).fail(function($xhr) {
		console.log($xhr);
	});
}