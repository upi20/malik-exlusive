 $(function() {

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}


	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>laporan/penjualan/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "penj_id" },
			{
					data: "penj_total_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
						return '<p style="text-align:right">'+nominal+'</p>'
					}
				},
				{
					data: "penj_dibayar", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
						return '<p style="text-align:right">'+nominal+'</p>'
					}
				},
				{
					data: "penj_sisa", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
						return '<p style="text-align:right">'+nominal+'</p>'
					}
				},
			{ "data": "penj_tanggal" },
			{ "data": "penj_tanggal_pengiriman" },
			{ "data": "penj_keterangan" },
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
			// 'copy',
			// 'print', {
			// 	'sExtends': 'collection',
			// 	'sButtonText': 'Save',
			// 	'aButtons': ['csv', 'xls', 'pdf']
			// }
		],
		"sSwfPath": "<?php echo base_url();?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
	});

	$(tt.fnContainer()).insertAfter('#tableTools');
	//*initialize responsive datatable

	function dynamic(filter_status_pembayaran, filter_status_pengiriman, filter_tanggal_mulai, filter_tanggal_akhir, filter_sumber_penjualan){
		//initialize responsive datatable
	
		var table4 = $('#advanced-usage').DataTable({
			"ajax": {
				"url": "<?= base_url()?>laporan/penjualan/ajax_data/",
				"data": {
					filter_status_pembayaran: filter_status_pembayaran,
					filter_status_pengiriman: filter_status_pengiriman,
					filter_tanggal_mulai: filter_tanggal_mulai,
					filter_tanggal_akhir: filter_tanggal_akhir,
					filter_sumber_penjualan: filter_sumber_penjualan
				},
				"type": 'POST'
			},
			"columns": [
				{ "data": "penj_id" },
				{
						data: "penj_total_harga", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
							return '<p style="text-align:right">'+nominal+'</p>'
						}
					},
					{
						data: "penj_dibayar", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
							return '<p style="text-align:right">'+nominal+'</p>'
						}
					},
					{
						data: "penj_sisa", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
							return '<p style="text-align:right">'+nominal+'</p>'
						}
					},
				{ "data": "penj_tanggal" },
				{ "data": "penj_tanggal_pengiriman" },
				{ "data": "penj_keterangan" },
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


	$('#filter-cari').click(function() {
		let filter_status_pembayaran = $("#filter_status_pembayaran").val();
		let filter_status_pengiriman = $("#filter_status_pengiriman").val();
		let filter_tanggal_mulai = $("#filter_tanggal_mulai").val();
		let filter_tanggal_akhir = $("#filter_tanggal_akhir").val();
		let filter_sumber_penjualan = $("#filter_sumber_penjualan").val();
		$("#advanced-usage").dataTable().fnDestroy();
		$.message('Pencarian Berhasil.','Laporan Penjualan','success');
		dynamic(filter_status_pembayaran, filter_status_pengiriman, filter_tanggal_mulai, filter_tanggal_akhir, filter_sumber_penjualan);
	});
	// // fungsi simpan 
	// $('#form').submit(function(ev) {
	// 	ev.preventDefault();

	// 	let id = $('#form input[name=id]').val();
	// 	let nama = $('#nama').val();

	// 	let ajax = null;
	// 	if(id == 0) {
	// 		ajax = window.apiClient.laporanpenjualan.insert(nama)
	// 		.done(function(data) {
	// 			$("#advanced-usage").dataTable().fnDestroy();
	// 			$.message('Berhasil ditambahkan.','penjualan','success');
	// 			dynamic();
	// 			$('#form input[name=id]').val(0);
	// 			$('#nama').val('');
	// 		})
	// 		.fail(function($xhr) {
	// 			$.message('Gagal ditambahkan.','penjualan','error');
	// 		}).
	// 		always(function() {
	// 			$('#splash').modal('toggle');
	// 		});
	// 	}
	// 	else {
	// 		ajax = window.apiClient.laporanpenjualan.update(id, nama)
	// 		.done(function(data) {
	// 			$("#advanced-usage").dataTable().fnDestroy();
	// 			$.message('Berhasil diubah.','penjualan','success');
	// 			dynamic();
	// 			$('#form input[name=id]').val(0);
	// 			$('#nama').val('');
	// 		})
	// 		.fail(function($xhr) {
	// 			$.message('Gagal diubah.','penjualan','error');
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
	// 	$('#myModalLabel').html('Ubah penjualan');
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
	// 	ajax = window.apiClient.laporanpenjualan.delete(id)
	// 		.done(function(data) {
	// 			$("#advanced-usage").dataTable().fnDestroy();
	// 			$.message('Berhasil dihapus.','penjualan','success');
	// 			dynamic();
				
	// 		})
	// 		.fail(function($xhr) {
	// 			$.message('Gagal dihapus.','penjualan','error');
	// 		}).
	// 		always(function() {
	// 			$('#myModal3').modal('toggle');
	// 		});
	// });

});