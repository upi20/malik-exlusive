 $(function() {

 	$('#dibayar').autoNumeric('init');


	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible)
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
				"url": "<?= base_url()?>penjualan/batal/ajax_data/",
				"data": null,
				"type": 'POST',
			},
			"columns": [
				{ "data": "penj_id" },
				{ "data": "penj_nama" },
				{ "data": "penj_no_hp" },
				{ "data": "penj_alamat" },
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
				{ "data": "penj_keterangan" },
				{ "data": "supe_nama" },
				{ "data": "penj_tanggal" },
				{ "data": "penj_status" },
				{
					data: "penj_id", render: (data, type, full, meta) =>
					{
						if( full.penj_status == 'Selesai' ) {
							return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-warning btn-ef btn-ef-5 btn-ef-5b hangus-button" value="'+data+'" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" readonly><i class=""></i> <span>Hangus</span></button>'
								+'</div>'
						}else {
							return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-warning btn-ef btn-ef-5 btn-ef-5b hangus-button" value="'+data+'" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" readonly><i class=""></i> <span>Hangus</span></button>'
								+'</div>'
						}
						
					}
				},
			],
		"aoColumnDefs": [
		  { 'bSortable': false, 'aTargets': [ "no-sort" ] }
		]
	})


	var colvis = new $.fn.dataTable.ColVis(table4)

	$(colvis.button()).insertAfter('#colVis')
	$(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button')

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
		"sSwfPath": "<?php echo base_url()?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
	})

	$(tt.fnContainer()).insertAfter('#tableTools')
	//*initialize responsive datatable

	function dynamic()
	{
		var table4 = $('#advanced-usage').DataTable({
			"ajax": {
					"url": "<?= base_url()?>penjualan/batal/ajax_data/",
					"data": null,
					"type": 'POST',
				},
				"columns": [
				{ "data": "penj_id" },
				{ "data": "penj_nama" },
				{ "data": "penj_no_hp" },
				{ "data": "penj_alamat" },
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
				{ "data": "penj_keterangan" },
				{ "data": "penj_kondisi" },
				{ "data": "penj_tanggal" },
				{ "data": "penj_status" },
				{
					data: "penj_id", render: (data, type, full, meta) =>
					{
						return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-warning btn-ef btn-ef-5 btn-ef-5b hangus-button" value="'+data+'" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" readonly><i class=""></i> <span>Hangus</span></button>'
								+'</div>'
					}
				},
			],
			"aoColumnDefs": [
			  { 'bSortable': false, 'aTargets': [ "no-sort" ] }
			]
		})


		var colvis = new $.fn.dataTable.ColVis(table4)

		$(colvis.button()).insertAfter('#colVis')
		$(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button')

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
			"sSwfPath": "<?php echo base_url()?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
		})

		$(tt.fnContainer()).insertAfter('#tableTools')
	}

	$('#advanced-usage tbody').on('click', '.hangus-button', function(ev) {
		var ids = $(this).val();
		console.log(ids);
		$("#idHapus").val(ids);
		$("#labelHapus").text('Form Hangus');
		$("#contentHapus").text('Apakah anda yakin akan menghapus data ini?');
		$('#myModal3').modal('toggle');
	});
	
	// fungsi hapus jika ya
	$('#clickHapus').click(function() {
		let id = $("#idHapus").val();
		console.log(id);
		ajax = window.apiClient.penjualanData.hangus(id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.','Domba','success');
				dynamic();
			})
			.fail(function($xhr) {
				$.message('Gagal dihapus.','Domba','error');
			}).
			always(function() {
				$('#myModal3').modal('toggle');
			});
	});
});