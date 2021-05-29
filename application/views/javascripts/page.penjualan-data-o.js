$(function () {

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
			"data": filter,
			"type": 'POST',
		},
		"columns": [
			{ "data": "penj_id" },
			{ "data": "penj_tanggal" },
			{ "data": "penj_no_resi" },
			{ "data": "toko" },
			{ "data": "penj_nama" },
			// { "data": "penj_keterangan" },
			{ "data": "prod_nama" },
			{
				data: "pede_harga", render: function (data, type, full, meta) {
					let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
					return '<p style="text-align:right">' + nominal + '</p>'
				}
			},
			{ 'data': 'pede_jumlah' },
			{
				data: "pede_total_harga", render: function (data, type, full, meta) {
					let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
					return '<p style="text-align:right">' + nominal + '</p>'
				}
			},
			{
				data: "penj_status_pengiriman", render: function (data, type, full, meta) {
					if (data == '') {
						return 'proses';
					} else {
						return data;
					}
				}
			},
			// {
			// 	data: "penj_id", render: (data, type, full, meta) =>
			// 	{
			// 		if(full.penj_status != 'Hangus'){
			// 			if (full.penj_sisa == 0) 
			// 			{
			// 				return '<div class="pull-right">'
			// 							// +'<a class="btn btn-success btn-xs edit-detail" href="#'+full.pede_id+'/'+full.penj_id+'" style="width: 100%;"><i class="fa fa-edit"></i> Ubah Status</a>'
			// 							+'<a style="width: 100%;" target="_BLANK" href="<?=base_url()?>penjualan/data/cetak/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
			// 							// +'<a style="width: 100%;" href="<?=base_url()?>penjualan/data/suratJalan/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Surat Jalan</button></a>'
			// 						+'</div>'
			// 			}else
			// 			{
			// 				return '<div class="pull-right">'
			// 							+'<a class="btn btn-success  btn-xs edit-detail" href="#'+full.pede_id+'/'+full.penj_id+'" style="width: 100%;"><i class="fa fa-edit"></i> Ubah Status</a>'
			// 							// +'<button style="width: 100%;" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" onclick=bayar("'+full.penj_id+'|'+full.penj_total_harga+'|'+full.penj_dibayar+'|'+full.penj_sisa+'")><i class="fa fa-edit"></i> <span>Bayar Sisa</span></button>'
			// 							+'<a style="width: 100%;" target="_BLANK" href="<?=base_url()?>penjualan/data/cetak/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
			// 							// +'<a style="width: 100%;" href="<?=base_url()?>penjualan/data/suratJalan/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Surat Jalan</button></a>'
			// 						+'</div>'
			// 			}		
			// 		}else{
			// 			return '';		
			// 		}
			// 	}
			// },
		],
		"aoColumnDefs": [
			{ 'bSortable': false, 'aTargets': ["no-sort"] }
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

	function dynamic(filter_status_pengiriman, filter_tanggal_mulai, filter_tanggal_akhir, filter_toko) {
		var table4 = $('#advanced-usage').DataTable({
			"scrollX": true,
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?= base_url()?>penjualan/data/ajax_data/",
				"data":
				{
					filter_status_pengiriman: filter_status_pengiriman,
					filter_tanggal_mulai: filter_tanggal_mulai,
					filter_tanggal_akhir: filter_tanggal_akhir,
					filter_toko: filter_toko,
					filter_admin: null,
					filter_packer: null,
					filter_supplier: null,
				},
				"type": 'POST',
			},
			"columns": [
				{ "data": "penj_id" },
				{ "data": "penj_tanggal" },
				{ "data": "penj_no_resi" },
				{ "data": "toko" },
				{ "data": "penj_nama" },
				// { "data": "penj_keterangan" },
				{ "data": "prod_nama" },
				{
					data: "pede_harga", render: function (data, type, full, meta) {
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
						return '<p style="text-align:right">' + nominal + '</p>'
					}
				},
				{ 'data': 'pede_jumlah' },
				{
					data: "pede_total_harga", render: function (data, type, full, meta) {
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
						return '<p style="text-align:right">' + nominal + '</p>'
					}
				},
				{
					data: "penj_status_pengiriman", render: function (data, type, full, meta) {
						if (data == '') {
							return 'proses';
						} else {
							return data;
						}
					}
				},
				// {
				// 	data: "penj_id", render: (data, type, full, meta) =>
				// 	{
				// 		if(full.penj_status != 'Hangus'){
				// 			if (full.penj_sisa == 0) 
				// 			{
				// 				return '<div class="pull-right">'
				// 							// +'<a class="btn btn-success btn-xs edit-detail" href="#'+full.pede_id+'/'+full.penj_id+'" style="width: 100%;"><i class="fa fa-edit"></i> Ubah Status</a>'
				// 							+'<a style="width: 100%;" target="_BLANK" href="<?=base_url()?>penjualan/data/cetak/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
				// 							// +'<a style="width: 100%;" href="<?=base_url()?>penjualan/data/suratJalan/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Surat Jalan</button></a>'
				// 						+'</div>'
				// 			}else
				// 			{
				// 				return '<div class="pull-right">'
				// 							+'<a class="btn btn-success  btn-xs edit-detail" href="#'+full.pede_id+'/'+full.penj_id+'" style="width: 100%;"><i class="fa fa-edit"></i> Ubah Status</a>'
				// 							// +'<button style="width: 100%;" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" onclick=bayar("'+full.penj_id+'|'+full.penj_total_harga+'|'+full.penj_dibayar+'|'+full.penj_sisa+'")><i class="fa fa-edit"></i> <span>Bayar Sisa</span></button>'
				// 							+'<a style="width: 100%;" target="_BLANK" href="<?=base_url()?>penjualan/data/cetak/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
				// 							// +'<a style="width: 100%;" href="<?=base_url()?>penjualan/data/suratJalan/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Surat Jalan</button></a>'
				// 						+'</div>'
				// 			}		
				// 		}else{
				// 			return '';		
				// 		}
				// 	}
				// },
			],
			"aoColumnDefs": [
				{ 'bSortable': false, 'aTargets': ["no-sort"] }
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

	$('#form').submit(function (ev) {
		ev.preventDefault();
		let penj_id = $('#penj_id').val()
		let sisa_awal = $('#sisa_awal').val()
		sisa_awal = window.apiClient.format.splitString('' + sisa_awal, '.');
		let total_harga = $('#total_harga').val()
		total_harga = window.apiClient.format.splitString('' + total_harga, '.');
		let dibayar = $('#dibayar').val()
		dibayar = window.apiClient.format.splitString('' + dibayar, '.');
		let sisa = $('#sisa').val()
		sisa = window.apiClient.format.splitString('' + sisa, '.');
		let ajax = null;
		ajax = window.apiClient.penjualanTambah.insertPembayaran(penj_id, total_harga, dibayar, sisa)
			.done(function (data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.', 'Pembayaran', 'success');
				dynamic();
				$("#sisa_awal").val('');
				$("#total_harga").val('');
				$("#sisa").val('');
				$("#penj_id").val('');
				$("#dibayar").val('');
			})
			.fail(function ($xhr) {
				$.message('Gagal ditambahkan.', 'Pembayaran', 'error');
			}).
			always(function () {
				$('#splash').modal('toggle');
			});
	});

	$('#dibayar').on('change', () => {
		var dibayar = $('#dibayar').val();
		// dibayar 		= window.apiClient.format.splitString(dibayar, '.');
		// total 			= window.apiClient.format.splitString(total, '.');
		var total_harga = $('#total_harga').val();
		var sisa_awal = $('#sisa_awal').val();
		// total_harga 	= window.apiClient.format.splitString(total_harga, '.');
		var sisa = Number(window.apiClient.format.splitString(sisa_awal, '.')) - Number(window.apiClient.format.splitString(dibayar, '.'))
		sisa = window.apiClient.format.rupiah('' + sisa, '');
		$('#sisa').val(sisa);
	});

	$('#filter-cari').click(function () {
		let filter_status_pengiriman = $("#filter_status_pengiriman").val();
		let filter_tanggal_mulai = $("#filter_tanggal_mulai").val();
		let filter_tanggal_akhir = $("#filter_tanggal_akhir").val();
		let filter_toko = $("#filter_toko").val();
		$("#advanced-usage").dataTable().fnDestroy();
		$.message('Pencarian Berhasil.', 'Laporan Penjualan', 'success');
		dynamic(filter_status_pengiriman, filter_tanggal_mulai, filter_tanggal_akhir, filter_toko);
	});

	$('#advanced-usage tbody').on('click', '.edit-detail', function (ev) {
		// var ids = $(this).val();
		var ids = $(this).attr("href");
		ids = window.apiClient.format.splitString(ids, '#');
		var res = ids.split("/");
		let pede_id = res[0]
		let penj_id = res[1]

		$("#idHapus").val(pede_id + "|" + penj_id);
		$("#labelHapus").text('Form Ubah Status');
		$("#driver").empty();
		$("#driver").append('<option value="" selected>Pilih Driver</option>');
		$.ajax({
			method: 'post',
			url: '<?= base_url() ?>penjualan/data/getDriver',
			data: null
		}).done(function (data) {
			$.each(data, function (value, key) {
				$("#driver").append("<option value='" + key.nama + "'>" + key.nama + "</option>");
			})
		})

		$("#kendaraan").empty();
		$("#kendaraan").append('<option value="" selected>Pilih Kendaraan</option>');
		$.ajax({
			method: 'post',
			url: '<?= base_url() ?>penjualan/data/getKendaraan',
			data: null
		}).done(function (data) {
			$.each(data, function (value, key) {
				$("#kendaraan").append("<option value='" + key.merk + " - " + key.plat_nomor + "'>" + key.merk + " - " + key.plat_nomor + "</option>");
			})
		})
		$("#contentHapus").html(''
			+ '<select id="status" name="status" class="form-control">'
			+ '<option value="Hutang">Hutang</option>'
			+ '<option value="Proses">Proses</option>'
			+ '<option value="Selesai">Selesai</option>'
			+ '</select><br>'
			+ '<select id="driver" name="driver" class="form-control">'

			+ '</select><br>'
			+ '<select id="kendaraan" name="kendaraan" class="form-control">'

			+ '</select><br>');

		$('#myModal3').modal('toggle');
	});

	$('#clickHapus').click(function () {
		let id = $("#idHapus").val();
		let id_penjualan = $("#id_penjualan").val();
		let status = $("#status").val();
		let driver = $("#driver").val();
		let kendaraan = $("#kendaraan").val();
		ajax = window.apiClient.pengadaanTambah.ubahDetailPengirimanPenjualan(id, status, driver, kendaraan)
			.done(function (data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.', 'Transaksi Status', 'success');
				dynamic();
			})
			.fail(function ($xhr) {
				$.message('Gagal diubah.', 'Transaksi Status', 'error');
			}).
			always(function () {
				$('#myModal3').modal('toggle');
				$('#myModal3').modal('hide');
			});
	});
})

function bayar(id) {
	var res = id.split("|")
	// console.log(res);
	$('#penj_id').val(res[0]);
	let total_harga = window.apiClient.format.rupiah('' + res[1], '');
	let pembayaran = window.apiClient.format.rupiah('' + res[2], '');
	let sisa = window.apiClient.format.rupiah('' + res[3], '');
	$('#total_harga').val(total_harga);
	$('#pembayaran').val(pembayaran);
	$('#sisa_awal').val(sisa);
}