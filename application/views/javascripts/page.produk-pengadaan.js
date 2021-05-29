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
			{
				data: "prod_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-left">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" onclick=lokal("'+full.prod_id+'|'+full.prod_blok_id+'|'+full.prod_ruma_id+'|'+full.prod_nama+'")><i class="fa fa-edit"></i> <span>'+full.blok_nama+' - '+full.prod_ruma_id+'</span></button>'
							+'</div>'
				}
			},
			{
				data: "prod_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-left">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b" data-toggle="modal" data-target="#splash2" data-options="splash-2 splash-ef-14" onclick=kelas("'+full.prod_id+'|'+full.kela_id+'")><i class="fa fa-edit"></i> <span>'+full.kela_nama+'</span></button>'
							+'</div>'
				}
				// "data": "kela_nama" 
			},
			{ "data": "prod_nama" },
			// { "data": "prod_stok" },
			// { "data": "prod_harga_beli" },
			// { "data": "prod_harga_jual" },
			// { "data": "prod_status" },
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

	function dynamic(){
		//initialize responsive datatable
	
		var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>produk/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "prod_id" },
			{
				data: "prod_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-left">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" onclick=lokal("'+full.prod_id+'|'+full.prod_blok_id+'|'+full.prod_ruma_id+'|'+full.prod_nama+'")><i class="fa fa-edit"></i> <span>'+full.blok_nama+' - '+full.prod_ruma_id+'</span></button>'
							+'</div>'
				}
			},
			{
				data: "prod_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-left">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b" data-toggle="modal" data-target="#splash2" data-options="splash-2 splash-ef-14" onclick=kelas("'+full.prod_id+'|'+full.kela_id+'")><i class="fa fa-edit"></i> <span>'+full.kela_nama+'</span></button>'
							+'</div>'
				}
				// "data": "kela_nama" 
			},
			{ "data": "prod_nama" },
			// { "data": "prod_stok" },
			// { "data": "prod_harga_beli" },
			// { "data": "prod_harga_jual" },
			// { "data": "prod_status" },
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
	}

	// fungsi simpan 
	$('#form').submit(function(ev) {
		ev.preventDefault();
		// value_code_detail();
		let prod_id 	= $('#prod_id').val();
		let blok_id 	= $('#blok_id').val();
		let ruma_id 	= $('#ruma_id').val();
		let ajax = null;
		ajax = window.apiClient.produk.lokal(prod_id, blok_id, ruma_id)
		.done(function(data) {
			$("#advanced-usage").dataTable().fnDestroy();
			$.message('Berhasil diubah.','lokal','success');
			// value_code_detail();
			$('#prod_id').val('');
			$('#blok_id').val('');
			$('#prod_nama').val('');
			$('#ruma_id').val('');
			dynamic();
			// $('#jumlah').val('');
			// total_harga(id);
		})
		.fail(function($xhr) {
			$.message('Gagal ditambahkan.','Penjualan Detail','success');
		}).
		always(function() {
			$('#splash').modal('toggle');
		});
	});

	$('#form2').submit((ev) =>
	{
		ev.preventDefault();
		// value_code_detail();
		let prod_id 	= $('#prod_id2').val();
		let kelas 		= $('#kelas').val();
		let kelas_lama 	= $('#kelas_lama').val()

		let ajax = null;
		ajax = window.apiClient.produk.kelas(prod_id, kelas, kelas_lama)
		.done(function(data) {
			$("#advanced-usage").dataTable().fnDestroy();
			$.message('Berhasil diubah.','Kelas','success');
			// value_code_detail();
			$('#prod_id2').val('');
			$('#kelas').val('');
			// $('#prod_nama').val('');
			// $('#ruma_id').val('');
			dynamic();
			// $('#jumlah').val('');
			// total_harga(id);
		})
		.fail(function($xhr) {
			$.message('Gagal ditambahkan.','Penjualan Detail','success');
		}).
		always(function() {
			$('#splash2').modal('toggle');
		});
	})
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