 $(function() {

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}


	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>laporan/pengadaan/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "peng_id" },
			{
					data: "peng_total_harga", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ');
							return '<p style="text-align:right;">'+nominal+'</p>';
						}
				},
				{
					data: "peng_dibayar", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ');
							return '<p style="text-align:right;">'+nominal+'</p>';
						}
				},
				{
					data: "peng_sisa", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ');
							return '<p style="text-align:right;">'+nominal+'</p>';
						}
				},
			{ "data": "peng_keterangan" },
			{ "data": "peng_tanggal" },
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
		],
		"sSwfPath": "<?php echo base_url();?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
	});

	$(tt.fnContainer()).insertAfter('#tableTools');
	//*initialize responsive datatable

	function dynamic(){
		//initialize responsive datatable
	
		var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>laporan/pengadaan/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "peng_id" },
			{ "data": "peng_total_harga" },
			{ "data": "peng_dibayar" },
			{ "data": "peng_sisa" },
			{ "data": "peng_keterangan" },
			{ "data": "peng_tanggal" },
			{ "data": "peng_status" },
			{ "data": "peng_generate" },
			{
				"data": "peng_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
										+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.peng_id+'|'+full.peng_total_harga+'|'+full.peng_dibayar+'|'+full.peng_sisa+'|'+full.peng_keterangan+'|'+full.peng_tanggal+'|'+full.peng_status+'|'+full.peng_generate+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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

	
});