 $(function() {

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}


	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>laporan/pembayaran/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "pepe_id" },
			{ "data": "pepe_penj_id" },
			{ "data": "pepe_total_harga" },
			{ "data": "pepe_nominal" },
			{ "data": "pepe_sisa" },
			{ "data": "tanggal" },
			{
				"data": "pepe_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
										// +'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.pepe_id+'|'+full.pepe_penj_id+'|'+full.pepe_total_harga+'|'+full.pepe_nominal+'|'+full.pepe_sisa+'|'+full.tanggal+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
										// +'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
									+'</div>';
				}
			}
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
			"url": "<?= base_url()?>laporan/pembayaran/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "pepe_id" },
			{ "data": "pepe_penj_id" },
			{ "data": "pepe_total_harga" },
			{ "data": "pepe_nominal" },
			{ "data": "pepe_sisa" },
			{ "data": "tanggal" },
			{
				"data": "pepe_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
										+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.pepe_id+'|'+full.pepe_penj_id+'|'+full.pepe_total_harga+'|'+full.pepe_nominal+'|'+full.pepe_sisa+'|'+full.tanggal+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
										+'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
									+'</div>';
				}
			}
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

	// // fungsi simpan 
	// $('#form').submit(function(ev) {
	// 	ev.preventDefault();

	// 	let id = $('#form input[name=id]').val();
	// 	let nama = $('#nama').val();

	// 	let ajax = null;
	// 	if(id == 0) {
	// 		ajax = window.apiClient.laporanpembayaran.insert(nama)
	// 		.done(function(data) {
	// 			$("#advanced-usage").dataTable().fnDestroy();
	// 			$.message('Berhasil ditambahkan.','pembayaran','success');
	// 			dynamic();
	// 			$('#form input[name=id]').val(0);
	// 			$('#nama').val('');
	// 		})
	// 		.fail(function($xhr) {
	// 			$.message('Gagal ditambahkan.','pembayaran','error');
	// 		}).
	// 		always(function() {
	// 			$('#splash').modal('toggle');
	// 		});
	// 	}
	// 	else {
	// 		ajax = window.apiClient.laporanpembayaran.update(id, nama)
	// 		.done(function(data) {
	// 			$("#advanced-usage").dataTable().fnDestroy();
	// 			$.message('Berhasil diubah.','pembayaran','success');
	// 			dynamic();
	// 			$('#form input[name=id]').val(0);
	// 			$('#nama').val('');
	// 		})
	// 		.fail(function($xhr) {
	// 			$.message('Gagal diubah.','pembayaran','error');
	// 		}).
	// 		always(function() {
	// 			$('#splash').modal('toggle');
	// 		});
	// 	}
	// });

	
	// // fungsi ubah
	// $('#advanced-usage tbody').on('click', '.edit-button', function(ev) {
	// 	ev.preventDefault();
	// 	var ids = $(this).val();
	// 	var res = ids.split("|");
	// 	$('#form input[name=id]').val(res[0]);
	// 	$('#myModalLabel').html('Ubah pembayaran');
	// 	$('#id').val(res[0]);
	// 	$('#nama').val(res[1]);
	// });

	// // fungsi hapus
	// $('#advanced-usage tbody').on('click', '.delete-button', function(ev) {
	// 	var ids = $(this).val();
	// 	$("#idHapus").val(ids);
	// 	$("#labelHapus").text('Form Hapus');
	// 	$("#contentHapus").text('Apakah anda yakin akan menghapus data ini?');
	// 	$('#myModal3').modal('toggle');
	// });

	// // fungsi hapus jika ya
	// $('#clickHapus').click(function() {
	// 	let id = $("#idHapus").val();
	// 	ajax = window.apiClient.laporanpembayaran.delete(id)
	// 		.done(function(data) {
	// 			$("#advanced-usage").dataTable().fnDestroy();
	// 			$.message('Berhasil dihapus.','pembayaran','success');
	// 			dynamic();
				
	// 		})
	// 		.fail(function($xhr) {
	// 			$.message('Gagal dihapus.','pembayaran','error');
	// 		}).
	// 		always(function() {
	// 			$('#myModal3').modal('toggle');
	// 		});
	// });

});