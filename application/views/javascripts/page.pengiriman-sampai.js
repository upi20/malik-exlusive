 $(function() {

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
				"url": "<?= base_url()?>pengiriman/sampai/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
				{ "data": "penj_id" },
				{ "data": "penj_nama" },
				{ "data": "penj_no_hp" },
				{ "data": "penj_alamat" },
				{
					data: "penj_total_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				// {
				// 	data: "penj_dibayar", render: function(data, type, full, meta)
				// 	{
				// 		let nominal = window.apiClient.format.rupiah(data, '');
				// 		return '<p style="text-align:right;">'+nominal+'</p>';
				// 	}
				// },
				{
					data: "penj_sisa", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				// { "data": "prod_nama" },
				// {
				// 	data: "pman_insentif_live", render: function(data, type, full, meta)
				// 	{
				// 		let nominal = window.apiClient.format.rupiah(data, '');
				// 		return '<p style="text-align:right;">'+nominal+'</p>';
				// 	}
				// },
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
	//*initialize responsive datatable

	function dynamic(){
		//initialize responsive datatable
	
		var table4 = $('#advanced-usage').DataTable({
		"ajax": {
				"url": "<?= base_url()?>pengiriman/sampai/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
				{ "data": "penj_id" },
				{ "data": "penj_nama" },
				{ "data": "penj_no_hp" },
				{ "data": "penj_alamat" },
				{
					data: "penj_total_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				{
					data: "penj_dibayar", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				{
					data: "penj_sisa", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				{ "data": "prod_nama" },
				{
					data: "pman_insentif_live", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
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
});