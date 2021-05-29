$(function () {
	let total_harga = 0;
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
			{ "data": "penj_no_resi" },
			{
				data: "penj_berkas", render: function (data, type, full, meta) {
					return '<a style="text-align:right;" href="<?php echo base_url();?>gambar/' + data + '">' + data + '</p>'
				}
			},
			{ "data": "supp_nama" },
			{ "data": "pack_nama" },
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
			{ "data": "pede_tanggal_kirim" },
			{
				data: "penj_id", render: (data, type, full, meta) => {
					if (full.penj_status != 'Hangus') {
						if (full.penj_sisa == 0) {
							return '<div class="pull-right">'
								+ '<a class="btn btn-success btn-xs edit-detail" href="#' + full.pede_id + '/' + full.penj_id + '/' + full.pede_status_pengiriman + '/' + full.pede_supp_id + '/' + full.pede_tanggal_kirim + '" data-id="' + full.prod_id + '"><i class="fa fa-edit"></i> Ubah</a>'
								// +'<a target="_BLANK" href="<?=base_url()?>penjualan/data/cetak/'+data+'"><button class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
								// +'<a style="width: 100%;" href="<?=base_url()?>penjualan/data/suratJalan/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Surat Jalan</button></a>'
								+ '</div>'
						} else {
							return '<div class="pull-right">'
								+ '<a class="btn btn-success  btn-xs edit-detail" href="#' + full.pede_id + '/' + full.penj_id + '/' + full.pede_status_pengiriman + '/' + full.pede_supp_id + '/' + full.pede_tanggal_kirim + '"  data-id="' + full.prod_id + '"><i class="fa fa-edit"></i> Ubah</a>'
								// +'<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" onclick=bayar("'+full.penj_id+'|'+full.penj_total_harga+'|'+full.penj_dibayar+'|'+full.penj_sisa+'")><i class="fa fa-edit"></i> <span>Bayar Sisa</span></button>'
								// +'<a target="_BLANK" href="<?=base_url()?>penjualan/data/cetak/'+data+'"><button class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
								// +'<a style="width: 100%;" href="<?=base_url()?>penjualan/data/suratJalan/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Surat Jalan</button></a>'
								+ '</div>'
						}
					} else {
						return '';
					}
				}
			},
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

	function dynamic(filter_tanggal_mulai, filter_tanggal_akhir, filter_admin, filter_packer, filter_supplier) {
		var table4 = $('#advanced-usage').DataTable({
			"scrollX": true,
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?= base_url()?>penjualan/data/ajax_data/",
				"data":
				{
					filter_status_pengiriman: null,
					filter_tanggal_mulai: filter_tanggal_mulai,
					filter_tanggal_akhir: filter_tanggal_akhir,
					filter_toko: null,
					filter_admin: filter_admin,
					filter_packer: filter_packer,
					filter_supplier: filter_supplier,
				},
				"type": 'POST',
			},
			"columns": [
				{ "data": "penj_id" },
				{ "data": "penj_tanggal" },
				{ "data": "penj_no_resi" },
				{
					data: "penj_berkas", render: function (data, type, full, meta) {
						return '<a style="text-align:right;" href="<?php echo base_url();?>gambar/' + data + '">' + data + '</p>'
					}
				},
				{ "data": "supp_nama" },
				{ "data": "pack_nama" },
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
				{ "data": "pede_tanggal_kirim" },
				{
					data: "penj_id", render: (data, type, full, meta) => {
						if (full.penj_status != 'Hangus') {
							if (full.penj_sisa == 0) {
								return '<div class="pull-right">'
									+ '<a class="btn btn-success btn-xs edit-detail" href="#' + full.pede_id + '/' + full.penj_id + '/' + full.pede_status_pengiriman + '/' + full.pede_supp_id + '/' + full.pede_tanggal_kirim + '"><i class="fa fa-edit"></i> Ubah</a>'
									// +'<a target="_BLANK" href="<?=base_url()?>penjualan/data/cetak/'+data+'"><button class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
									// +'<a style="width: 100%;" href="<?=base_url()?>penjualan/data/suratJalan/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Surat Jalan</button></a>'
									+ '</div>'
							} else {
								return '<div class="pull-right">'
									+ '<a class="btn btn-success  btn-xs edit-detail" href="#' + full.pede_id + '/' + full.penj_id + '/' + full.pede_status_pengiriman + '/' + full.pede_supp_id + '/' + full.pede_tanggal_kirim + '"><i class="fa fa-edit"></i> Ubah</a>'
									// +'<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" onclick=bayar("'+full.penj_id+'|'+full.penj_total_harga+'|'+full.penj_dibayar+'|'+full.penj_sisa+'")><i class="fa fa-edit"></i> <span>Bayar Sisa</span></button>'
									// +'<a target="_BLANK" href="<?=base_url()?>penjualan/data/cetak/'+data+'"><button class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
									// +'<a style="width: 100%;" href="<?=base_url()?>penjualan/data/suratJalan/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Surat Jalan</button></a>'
									+ '</div>'
							}
						} else {
							return '';
						}
					}
				},
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
		let filter_tanggal_mulai = $("#filter_tanggal_mulai").val();
		let filter_tanggal_akhir = $("#filter_tanggal_akhir").val();
		let filter_admin = $("#filter_admin").val();
		let filter_packer = $("#filter_packer").val();
		let filter_supplier = $("#filter_supplier").val();
		$("#advanced-usage").dataTable().fnDestroy();
		$.message('Pencarian Berhasil.', 'Laporan Penjualan', 'success');
		dynamic(filter_tanggal_mulai, filter_tanggal_akhir, filter_admin, filter_packer, filter_supplier);
		$.ajax({
			method: 'post',
			url: '<?= base_url() ?>penjualan/data/getTotalHarga',
			data: {
				filter_vendor: filter_vendor,
				filter_tanggal_mulai: filter_tanggal_mulai,
				filter_tanggal_akhir: filter_tanggal_akhir
			}
		}).done(function (data) {
			// alert(data)
			$("#total-harga").text(window.apiClient.format.rupiah(data, 'Rp. '))
		})
	});

	$('submitCari').on('click', '', function (ev) {

	})

	$('#advanced-usage tbody').on('click', '.edit-detail', function (ev) {
		// var ids = $(this).val();
		var ids = $(this).attr("href");
		ids = window.apiClient.format.splitString(ids, '#');
		var res = ids.split("/");
		let pede_id = res[0]
		let penj_id = res[1]
		let status = res[2]
		let supp_id = res[3]
		let tanggal_kirim = res[4]
		tanggal_kirim = tanggal_kirim.split(" ");
		tanggal_kirim = tanggal_kirim[0]
		$("#idHapus").val(pede_id + "|" + penj_id);
		$("#labelHapus").text('Form Ubah Status');


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


		// alert(status)
		$("#contentHapus").html(''
			+ '<select id="status" name="status" class="form-control">'
			+ '</select><br>'
			+ '<input type="date" value="' + tanggal_kirim + '" class="form-control" id="tanggal_kirim"><br>'
			+ '<select id="vendor" name="vendor" class="form-control">'
			+ '</select><br>'
			+ '<select id="packer" name="packer" class="form-control">'
			+ '</select><br>');

		$("#status").empty();
		$("#status").append('<option value="" selected>Pilih Status</option>');
		if (status == '' || status == 'proses') {
			$("#status").append("<option value='proses' selected>Proses</option>");
			$("#status").append("<option value='kirim'>Kirim</option>");
			$("#status").append("<option value='retur'>Retur</option>");
		} else if (status == 'kirim') {
			$("#status").append("<option value='proses'>Proses</option>");
			$("#status").append("<option value='kirim'>Kirim</option>");
			$("#status").append("<option value='retur'>Retur</option>");
		} else if (status == 'retur') {
			$("#status").append("<option value='proses'>Proses</option>");
			$("#status").append("<option value='kirim'>Kirim</option>");
			$("#status").append("<option value='retur' selected>Retur</option>");
		} else {

		}

		$('#packer').html('<option value="" selected>Pilih Packer</option>')
		for (let i = 0; i < packer.length; i++) {
			$('#packer').append('<option value="' + packer[i].split('|')[0] + '">' + packer[i].split('|')[1] + '</option>')
		}

		$("#vendor").empty();
		$("#vendor").append('<option value="" selected>Pilih Vendor</option>');

		$.ajax({
			method: 'post',
			url: '<?= base_url() ?>penjualan/data/getVendor',
			data: null
		}).done(function (data) {
			$.each(data, function (value, key) {
				if (key.supp_id == supp_id) {
					$("#vendor").append("<option selected value='" + key.supp_id + "'>" + key.supp_kode + " (" + key.supp_nama + ")</option>");
				} else {
					$("#vendor").append("<option value='" + key.supp_id + "'>" + key.supp_kode + " (" + key.supp_nama + ")</option>");
				}
			})
		})

		$('#myModal3').modal('toggle');
	});

	$('#clickHapus').click(function () {
		let id = $("#idHapus").val();
		let id_penjualan = $("#id_penjualan").val();
		let status = $("#status").val();
		let vendor = $("#vendor").val();
		let packer = $('#packer').val();
		let tanggal_kirim = $("#tanggal_kirim").val();
		ajax = window.apiClient.pengadaanTambah.ubahDetailPengirimanPenjualan(id, status, vendor, packer, tanggal_kirim)
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

	// Scan on click
	$('#scan-button').click(() => {
		// alert(status)
		$("#contentmyModal4").html('<label id="message-status"></label><br>'
			+ '<select id="status2" name="status" class="form-control">'
			+ '</select><br>'
			+ '<table class="table table-bordered">'
			+ '<thead>'
			+ '<tr>'
			+ '<th>Produk</th>'
			+ '<th>Jumlah</th>'
			+ '<th>Harga</th>'
			+ '<th>Vendor</th>'
			+ '</tr>'
			+ '</thead>'
			+ '<tbody id="ggwp">'
			+ '</tbody>'
			+ '</table><br>'
			+ '<input type="date" value="" class="form-control" id="tanggal_kirim2"><br>'
			// +'<select id="vendor2" name="vendor" class="form-control">'
			// +'</select><br>'
			+ '<select id="packer2" name="packer" class="form-control" required>'
			+ '</select><br>');

		$("#status").empty();
		$("#status").append('<option value="" selected>Pilih Status</option>');
		if (status == '' || status == 'proses') {
			$("#status2").append("<option value='proses' selected>Proses</option>");
			$("#status2").append("<option value='kirim'>Kirim</option>");
			$("#status2").append("<option value='retur'>Retur</option>");
		} else if (status == 'kirim') {
			$("#status2").append("<option value='proses'>Proses</option>");
			$("#status2").append("<option value='kirim' selected>Kirim</option>");
			$("#status2").append("<option value='retur'>Retur</option>");
		} else if (status == 'retur') {
			$("#status2").append("<option value='proses'>Proses</option>");
			$("#status2").append("<option value='kirim'>Kirim</option>");
			$("#status2").append("<option value='retur' selected>Retur</option>");
		} else {

		}

		$('#packer2').html('<option value="" selected>Pilih Packer</option>')
		for (let i = 0; i < packer.length; i++) {
			$('#packer2').append('<option value="' + packer[i].split('|')[0] + '">' + packer[i].split('|')[1] + '</option>')
		}

		$("#vendor2").empty();
		$("#vendor2").append('<option value="" selected>Pilih Vendor</option>');
		$.ajax({
			method: 'post',
			url: '<?= base_url() ?>penjualan/data/getVendor',
			data: null
		}).done(function (data) {
			$.each(data, function (value, key) {
				$("#vendor2").append("<option value='" + key.supp_id + "'>" + key.supp_kode + " (" + key.supp_nama + ")</option>");
			})
		})

		$("#labelmyModal4").text('Form Scan Barcode');

		$('#myModal4').modal('toggle');
	})

	$('#myModal4').on('shown.bs.modal', () => {
		$('#barcode').focus()
	})

	$('#focus').on('click', () => {
		$('#barcode').val('')
		$('#barcode').focus()
	})

	$('#barcode').on('focus', () => {
		$('#barcode').val('')
		$('#message-status').html('Silakan scann barcode')
	})

	$('#barcode').on('focusout', () => {
		$('#message-status').html('Silakan Tekan Tombol di atas untuk melakukan scann barcode')
	})

	$('#barcode').on('change', () => {
		let barcode = $('#barcode').val()

		$.ajax({
			method: 'post',
			url: '<?= base_url() ?>penjualan/data/scannBarcode',
			data: {
				no_resi: barcode,
			},
			success(data) {
				$('#idHapus').val(data.penj_id)
				$('#status2').val('kirim')
				$('#tanggal_kirim2').val(data.penj_tanggal)
				$('#packer2').val(data.penj_pack_id)
				// $('#vendor2').val(data.penj_supe_id)
				$('#ggwp').html('')

				if (data.produk_detail.length > 0) {
					for (let i = 0; i < data.produk_detail.length; i++) {
						$('#ggwp').append(`
							<tr>
								<td>${data.produk_detail[i].prod_nama}</td>
								<td>${data.produk_detail[i].pede_jumlah}</td>
								<td>${data.produk_detail[i].prod_harga_jual}</td>
								<td>
									<select onchange="ggwp(this, event, '${data.produk_detail[i].pede_id}')">
										<option>--Pilih Vendor--</option>
										${vendor.map(key => {
							console.log(data.produk_detail[i].pede_supp_id)
							console.log(key.split('|')[0])
							return `<option ${(data.produk_detail[i].pede_supp_id == key.split('|')[0]) ? 'selected' : ''} value="${key.split('|')[0]}">${key.split('|')[1]}</option>`
						})}
									</select>
							</tr>
						`)
					}
				}
			},
			error($xhr) {
				console.log($xhr)
			}
		})
	})

	$('#clickMyModel4').on('click', ev => {
		ev.preventDefault()

		let id = $('#idHapus').val()
		let no_resi = $('#barcode').val()
		let vendor = $("#vendor2").val()
		let packer = $('#packer2').val()
		let tanggal = $('#tanggal_kirim2').val()
		let status = $("#status2").val()

		$.ajax({
			method: 'post',
			url: '<?= base_url() ?>penjualan/data/postBarcode',
			data: {
				id: id,
				no_resi: no_resi,
				vendor: 1,
				packer: packer,
				tanggal: tanggal,
				status: status,
			},
			success(data) {
				console.log(data)
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.', 'Transaksi Status', 'success');
				dynamic();
				$('#vendor2').val('')
				$('#packer2').val('')
				$('#tanggal_kirim2').val('')
				$('#barcode').focus()
			},
			error($xhr) {
				console.log($xhr)
			}
		})

	})
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

function ggwp(el, ev, pede_id) {
	ev.preventDefault()

	$.ajax({
		method: 'post',
		url: '<?= base_url() ?>penjualan/data/changeVendor',
		data: {
			vendor: el.value,
			id: pede_id,
		},
		success(data) {
			$.message('Berhasil diubah.', 'Vendor', 'success');
		}
	})
}