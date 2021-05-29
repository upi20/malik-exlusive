 $(function() {

 	$('#dibayar').autoNumeric('init');

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible)
	}

	var table4 = $('#advanced-usage').DataTable({
		"scrollX": true,
		"processing": true,
		"serverSide": true,
		"ajax": {
				"url": "<?= base_url()?>penjualan/data/ajax_data/",
				"data": null,
				"type": 'POST',
			},
			"columns": [
				{ "data": "penj_id" },
				{ "data": "penj_tanggal" },
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
				{ "data": "penj_tanggal_pengiriman" },
				{ "data": "kate_nama_1" },
				{ "data": "kate_nama_2" },
				{ "data": "kate_nama_3" },
				{ "data": "prod_kode" },
				{ "data": "prod_nama" },
				{ 
					data: "pede_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
						return '<p style="text-align:right">'+nominal+'</p>'
					}
				},
				{ 'data': 'pede_jumlah' },
				{ 
					data: "pede_total_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
						return '<p style="text-align:right">'+nominal+'</p>'
					}
				},
				{ "data": "penj_status" },
				{
					data: "penj_id", render: (data, type, full, meta) =>
					{
						if(full.penj_status != 'Hangus'){
							if (full.penj_sisa == 0) 
							{

								return '<div class="pull-right">'
											+'<button class="btn btn-xs btn-primary btn-ef btn-ef-5 btn-ef-5b" readonly><i class=""></i> <span>Lunas</span></button>'
											// +'<a href="<?=base_url()?>penjualan/data/detail/'+full.penj_id+'" class="btn btn-xs btn-success btn-ef btn-ef-5 btn-ef-5b detail-button"><i class=""></i> <span>Detail</span></a>'
											+'<a href="<?=base_url()?>penjualan/data/ubah/'+full.penj_id+'" class="btn btn-xs btn-warning btn-ef btn-ef-5 btn-ef-5b detail-button"><i class=""></i> <span>Ubah</span></a>'
											+'<a href="<?=base_url()?>laporan/CetakFaktur/cetak_faktur/'+data+'"><button class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
										+'</div>'
							}else
							{
								return '<div class="pull-right">'
											+'<button class="btn btn-xs btn-primary btn-ef btn-ef-5 btn-ef-5b" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" onclick=bayar("'+full.penj_id+'|'+full.penj_total_harga+'|'+full.penj_dibayar+'|'+full.penj_sisa+'")><i class="fa fa-edit"></i> <span>Bayar Sisa</span></button>'
											// +'<a href="<?=base_url()?>penjualan/data/detail/'+full.penj_id+'" class="btn btn-xs btn-success btn-ef btn-ef-5 btn-ef-5b detail-button"><i class=""></i> <span>Detail</span></a>'
											+'<a href="<?=base_url()?>penjualan/data/ubah/'+full.penj_id+'" class="btn btn-xs btn-warning btn-ef btn-ef-5 btn-ef-5b detail-button"><i class=""></i> <span>Ubah</span></a>'
											+'<a href="<?=base_url()?>laporan/CetakFaktur/cetak_faktur/'+data+'"><button class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
										+'</div>'
							}		
						}else{
							return '';		
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

	function dynamic(filter_status_pembayaran, filter_status_pengiriman, filter_tanggal_mulai, filter_tanggal_akhir, filter_sumber_penjualan)
	{
		var table4 = $('#advanced-usage').DataTable({
			"scrollX": true,
			"processing": true,
			"serverSide": true,
			"ajax": {
					"url": "<?= base_url()?>penjualan/data/ajax_data/",
					"data": 
					{
						filter_status_pembayaran: filter_status_pembayaran,
						filter_status_pengiriman: filter_status_pengiriman,
						filter_tanggal_mulai: filter_tanggal_mulai,
						filter_tanggal_akhir: filter_tanggal_akhir,
						filter_sumber_penjualan: filter_sumber_penjualan
					},
					"type": 'POST',
			},
			"columns": [
				{ "data": "penj_id" },
				{ "data": "penj_tanggal" },
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
				{ "data": "penj_tanggal_pengiriman" },
				{ "data": "kate_nama_1" },
				{ "data": "kate_nama_2" },
				{ "data": "kate_nama_3" },
				{ "data": "prod_kode" },
				{ "data": "prod_nama" },
				{ 
					data: "pede_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
						return '<p style="text-align:right">'+nominal+'</p>'
					}
				},
				{ 'data': 'pede_jumlah' },
				{ 
					data: "pede_total_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
						return '<p style="text-align:right">'+nominal+'</p>'
					}
				},
				{ "data": "penj_status" },
				{
					data: "penj_id", render: (data, type, full, meta) =>
					{
						if(full.penj_status != 'Hangus'){
							if (full.penj_sisa == 0) 
							{

								return '<div class="pull-right">'
											+'<button class="btn btn-xs btn-primary btn-ef btn-ef-5 btn-ef-5b" readonly><i class=""></i> <span>Lunas</span></button>'
											+'<a href="<?=base_url()?>penjualan/data/detail/'+full.penj_id+'" class="btn btn-xs btn-success btn-ef btn-ef-5 btn-ef-5b detail-button"><i class=""></i> <span>Detail</span></a>'
											+'<a href="<?=base_url()?>penjualan/data/ubah/'+full.penj_id+'" class="btn btn-xs btn-warning btn-ef btn-ef-5 btn-ef-5b detail-button"><i class=""></i> <span>Ubah</span></a>'
											+'<a href="<?=base_url()?>laporan/CetakFaktur/cetak_faktur/'+data+'"><button class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
										+'</div>'
							}else
							{
								return '<div class="pull-right">'
											+'<button class="btn btn-xs btn-primary btn-ef btn-ef-5 btn-ef-5b" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" onclick=bayar("'+full.penj_id+'|'+full.penj_total_harga+'|'+full.penj_dibayar+'|'+full.penj_sisa+'")><i class="fa fa-edit"></i> <span>Bayar Sisa</span></button>'
											+'<a href="<?=base_url()?>penjualan/data/detail/'+full.penj_id+'" class="btn btn-xs btn-success btn-ef btn-ef-5 btn-ef-5b detail-button"><i class=""></i> <span>Detail</span></a>'
											+'<a href="<?=base_url()?>penjualan/data/ubah/'+full.penj_id+'" class="btn btn-xs btn-warning btn-ef btn-ef-5 btn-ef-5b detail-button"><i class=""></i> <span>Ubah</span></a>'
											+'<a href="<?=base_url()?>laporan/CetakFaktur/cetak_faktur/'+data+'"><button class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
										+'</div>'
							}		
						}else{
							return '';		
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
	}

	$('#form').submit(function(ev) {
		ev.preventDefault();
		let penj_id 	= $('#penj_id').val()
		let sisa_awal = $('#sisa_awal').val()
		sisa_awal 	= window.apiClient.format.splitString(''+sisa_awal, '.');
		let total_harga = $('#total_harga').val()
		total_harga 	= window.apiClient.format.splitString(''+total_harga, '.');
		let dibayar 	= $('#dibayar').val()
		dibayar 		= window.apiClient.format.splitString(''+dibayar, '.');
		let sisa 		= $('#sisa').val()
		sisa 			= window.apiClient.format.splitString(''+sisa, '.');
		let ajax = null;
			ajax = window.apiClient.penjualanTambah.insertPembayaran(penj_id, total_harga, dibayar, sisa)
			.done(function(data)
			{
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','Pembayaran','success');
				dynamic();
				$("#sisa_awal").val('');
				$("#total_harga").val('');
				$("#sisa").val('');
				$("#penj_id").val('');
				$("#dibayar").val('');
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Pembayaran','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
	});

	$('#dibayar').on('change', () =>
	{
		var dibayar 	= $('#dibayar').val();
		// dibayar 		= window.apiClient.format.splitString(dibayar, '.');
		// total 			= window.apiClient.format.splitString(total, '.');
		var total_harga = $('#total_harga').val();
		var sisa_awal = $('#sisa_awal').val();
		// total_harga 	= window.apiClient.format.splitString(total_harga, '.');
		var sisa 		= Number(window.apiClient.format.splitString(sisa_awal,'.')) - Number(window.apiClient.format.splitString(dibayar,'.'))
		sisa = window.apiClient.format.rupiah(''+sisa, '');
		$('#sisa').val(sisa);
	});

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
})

function bayar(id)
{
	var res = id.split("|")
	// console.log(res);
	$('#penj_id').val(res[0]);
	let total_harga = window.apiClient.format.rupiah(''+res[1], '');
	let pembayaran = window.apiClient.format.rupiah(''+res[2], '');
	let sisa = window.apiClient.format.rupiah(''+res[3], '');
	$('#total_harga').val(total_harga);
	$('#pembayaran').val(pembayaran);
	$('#sisa_awal').val(sisa);
}