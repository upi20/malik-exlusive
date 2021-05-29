 $(function() {
 	let level = $("#value_level").val();
	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>pemesanan/data/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "id_pemesanan" },
			{
				data: "total_harga", render: function(data, type, full, meta)
				{
					let nominal = window.apiClient.format.rupiah(data, '');
					return '<p style="text-align:right;">'+nominal+'</p>';
				}
			},
			{
				data: "dibayar", render: function(data, type, full, meta)
				{
					let nominal = window.apiClient.format.rupiah(data, '');
					return '<p style="text-align:right;">'+nominal+'</p>';
				}
			},
			{
				data: "sisa", render: function(data, type, full, meta)
				{
					let nominal = window.apiClient.format.rupiah(data, '');
					return '<p style="text-align:right;">'+nominal+'</p>';
				}
			},
			{ "data": "tanggal" },
			{ "data": "status" },
			{
				data: "status", render: function(data, type, full, meta)
				{
					if( data == 'on confirm' ) {
						if ( level == "Pemilik") {
							return '<div class="pull-right">'
									+'<a href="<?=base_url()?>pemesanan/data/status/terima/'+full.id_pemesanan+'">'
										+'<button class="btn btn-xs btn-primary value="'+data+' " >'
											+'<i class="fa fa-edit"></i>Terima'
										+'</button>'
									+'</a> | ' 
									+'<a href="<?=base_url()?>pemesanan/data/status/tolak/'+full.id_pemesanan+'">'
										+'<button class="btn btn-xs btn-danger value="'+data+' " >'
											+'<i class="fa fa-edit"></i>Tolak'
										+'</button>'
									+'</a>'
								+'</div>';
						} else {
							return '';
						}
					} else if( data == 'terima' ) {
						if ( level == "Supplier") {
							return '<div class="pull-right">'
									+'<a href="<?=base_url()?>pemesanan/data/status2/kirim/'+full.id_pemesanan+'">'
										+'<button class="btn btn-xs btn-primary value="'+data+' " >'
											+'<i class="fa fa-edit"></i>Terima dan Kirim Barang'
										+'</button>'
									+'</a> | ' 
									+'<a href="<?=base_url()?>pemesanan/data/status2/tolak/'+full.id_pemesanan+'">'
										+'<button class="btn btn-xs btn-danger value="'+data+' " >'
											+'<i class="fa fa-edit"></i>Tolak'
										+'</button>'
									+'</a>'
								+'</div>';	
						} else {
							return '';
						}
						
					} else if( data == 'kirim' ) {
						if ( level == "Staff") {
							return '<div class="pull-right">'
									+'<a href="<?=base_url()?>pemesanan/data/status3/sampai/'+full.id_pemesanan+'">'
										+'<button class="btn btn-xs btn-primary value="'+data+' " >'
											+'<i class="fa fa-edit"></i>Sampai digudang'
										+'</button>'
									+'</a> | ' 
									+'<a href="<?=base_url()?>pemesanan/data/status3/tolak/'+full.id_pemesanan+'">'
										+'<button class="btn btn-xs btn-danger value="'+data+' " >'
											+'<i class="fa fa-edit"></i>Tolak'
										+'</button>'
									+'</a>'
								+'</div>';	
						} else {
							return '';
						}
						
					} else {
						return '';
					}

				}
			},
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
				"url": "<?= base_url()?>pemesanan/data/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
				{ "data": "user_email" },
				{ "data": "hafi_nama" },
				{ "data": "hafi_tanggal_lahir" },
				{ "data": "hafi_alamat" },
				{ "data": "hafi_no_hp" },
				{ "data": "hafi_biografi" },
				{ "data": "hafi_photo" },
				{ "data": "hafi_status" }
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