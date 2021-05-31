let vendor_jml = 1;
let prod_id_now = 0;
let pede_id_now = 0;
let pede_jumlah_now = 0;
let penj_id_now = "";
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
			// { "data": "supp_nama" },
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
				data: "pede_status_pengiriman", render: function (data, type, full, meta) {
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
					// if (full.penj_status != 'Hangus') {
					// 	if (full.penj_sisa == 0) {
					// 		return '<div class="pull-right">'
					// 			+ '<a class="btn btn-success btn-xs edit-detail" href="#' + full.pede_id + '/' + full.penj_id + '/' + full.pede_status_pengiriman + '/' + full.pede_supp_id + '/' + full.pede_tanggal_kirim + '/' + full.pede_jumlah + '" data-id="' + full.prod_id + '" data-toggle="modal" data-target="#myModal5"><i class="fa fa-edit"></i> Ubah</a>'
					// 			// +'<a target="_BLANK" href="<?=base_url()?>penjualan/data/cetak/'+data+'"><button class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
					// 			// +'<a style="width: 100%;" href="<?=base_url()?>penjualan/data/suratJalan/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Surat Jalan</button></a>'
					// 			+ '</div>'
					// 	} else {
					// 		return '<div class="pull-right">'
					// 			+ '<a class="btn btn-success btn-xs edit-detail" href="#' + full.pede_id + '/' + full.penj_id + '/' + full.pede_status_pengiriman + '/' + full.pede_supp_id + '/' + full.pede_tanggal_kirim + '/' + full.pede_jumlah + '" data-id="' + full.prod_id + '" data-toggle="modal" data-target="#myModal5"><i class="fa fa-edit"></i> Ubah</a>'
					// 			// +'<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" onclick=bayar("'+full.penj_id+'|'+full.penj_total_harga+'|'+full.penj_dibayar+'|'+full.penj_sisa+'")><i class="fa fa-edit"></i> <span>Bayar Sisa</span></button>'
					// 			// +'<a target="_BLANK" href="<?=base_url()?>penjualan/data/cetak/'+data+'"><button class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
					// 			// +'<a style="width: 100%;" href="<?=base_url()?>penjualan/data/suratJalan/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Surat Jalan</button></a>'
					// 			+ '</div>'
					// 	}
					// } else {
					// 	return '';
					// }

					// button sesuai dengan status penjualan detail

					if (full.pede_status_pengiriman == "proses" || full.pede_status_pengiriman == "") {
						return '<div class="pull-right">'
							+ '<a class="btn btn-success btn-xs edit-detail" href="#' + full.pede_id + '/' + full.penj_id + '/' + full.pede_status_pengiriman + '/' + full.pede_supp_id + '/' + full.pede_tanggal_kirim + '/' + full.pede_jumlah + '" data-id="' + full.prod_id + '"  data-toggle="modal" data-target="#myModal5"><i class="glyphicon glyphicon-send"></i> Kirim</a>'
							+ '</div>';
					} else {
						return '<div class="pull-right">'
							+ '<button class="btn btn-warning btn-xs btn-ubah" data-id="' + full.pede_id + '" ><i class="glyphicon glyphicon-edit"></i> Ubah</button>'
							+ "  " + '<button class="btn btn-danger btn-xs btn-retur" data-id="' + full.pede_id + '" ><i class="glyphicon glyphicon-log-in"></i> Retur</button>'
							+ '</div>';
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
				// { "data": "supp_nama" },
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
					data: "pede_status_pengiriman", render: function (data, type, full, meta) {
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
						// if (full.penj_status != 'Hangus') {
						// 	if (full.penj_sisa == 0) {
						// 		return '<div class="pull-right">'
						// 			+ '<a class="btn btn-success btn-xs edit-detail" href="#' + full.pede_id + '/' + full.penj_id + '/' + full.pede_status_pengiriman + '/' + full.pede_supp_id + '/' + full.pede_tanggal_kirim + '/' + full.pede_jumlah + '" data-id="' + full.prod_id + '"  data-toggle="modal" data-target="#myModal5"><i class="fa fa-edit"></i> Ubah</a>'
						// 			// +'<a target="_BLANK" href="<?=base_url()?>penjualan/data/cetak/'+data+'"><button class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
						// 			// +'<a style="width: 100%;" href="<?=base_url()?>penjualan/data/suratJalan/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Surat Jalan</button></a>'
						// 			+ '</div>'
						// 	} else {
						// 		return '<div class="pull-right">'
						// 			+ '<a class="btn btn-success btn-xs edit-detail" href="#' + full.pede_id + '/' + full.penj_id + '/' + full.pede_status_pengiriman + '/' + full.pede_supp_id + '/' + full.pede_tanggal_kirim + '/' + full.pede_jumlah + '" data-id="' + full.prod_id + '"  data-toggle="modal" data-target="#myModal5"><i class="fa fa-edit"></i> Ubah</a>'
						// 			// +'<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" onclick=bayar("'+full.penj_id+'|'+full.penj_total_harga+'|'+full.penj_dibayar+'|'+full.penj_sisa+'")><i class="fa fa-edit"></i> <span>Bayar Sisa</span></button>'
						// 			// +'<a target="_BLANK" href="<?=base_url()?>penjualan/data/cetak/'+data+'"><button class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Print</button></a>'
						// 			// +'<a style="width: 100%;" href="<?=base_url()?>penjualan/data/suratJalan/'+data+'"><button style="width: 100%;" class="btn btn-xs btn-default value="'+data+' " ><i class="fa fa-print"></i>Surat Jalan</button></a>'
						// 			+ '</div>'
						// 	}
						// } else {
						// 	return '';
						// }


						// button sesuai dengan status penjualan detail

						if (full.pede_status_pengiriman == "proses" || full.pede_status_pengiriman == "") {
							return '<div class="pull-right">'
								+ '<a class="btn btn-success btn-xs edit-detail" href="#' + full.pede_id + '/' + full.penj_id + '/' + full.pede_status_pengiriman + '/' + full.pede_supp_id + '/' + full.pede_tanggal_kirim + '/' + full.pede_jumlah + '" data-id="' + full.prod_id + '"  data-toggle="modal" data-target="#myModal5"><i class="glyphicon glyphicon-send"></i> Kirim</a>'
								+ '</div>';

						} else {
							return '<div class="pull-right">'
								+ '<button class="btn btn-warning btn-xs btn-ubah" data-id="' + full.pede_id + '" ><i class="glyphicon glyphicon-edit"></i> Ubah</button>'
								+ "  " + '<button class="btn btn-danger btn-xs btn-retur" data-id="' + full.pede_id + '" ><i class="glyphicon glyphicon-log-in"></i> Retur</button>'
								+ '</div>';
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

	// handle button kirim =============================================================================================
	$('#advanced-usage tbody').on('click', '.edit-detail', function (ev) {
		// get data from href attribute
		var ids = $(this).attr("href");
		ids = window.apiClient.format.splitString(ids, '#');
		var res = ids.split("/");
		let pede_id = res[0]
		let penj_id = res[1]
		let status = res[2]
		let supp_id = res[3]
		let tanggal_kirim = res[4]
		pede_jumlah_now = res[5]
		const prod_id = this.dataset.id;
		prod_id_now = prod_id;
		pede_id_now = pede_id;
		penj_id_now = penj_id;

		tanggal_kirim = tanggal_kirim.split(" ");
		tanggal_kirim = tanggal_kirim[0]
		$("#idHapus").val(pede_id + "|" + penj_id);
		$("#labelHapus").text('Form Ubah Status');

		// get data dan set informasi penjualan
		$.ajax({
			method: 'post',
			url: '<?= base_url() ?>penjualan/data/getDetailPede',
			data: {
				id: pede_id
			}
		}).done(function (data) {
			$("#tbl-id").text(data.penj_id);
			$("#tbl-resi").text(data.penj_no_resi);
			$("#tbl-berkas").html('<a style="text-align:right;" href="<?php echo base_url();?>gambar/' + data.penj_berkas + '">' + data.penj_berkas + '</p>');
			$("#tbl-toko").text(data.toko);
			$("#tbl-konsumen").text(data.penj_nama);
			$("#tbl-produk").text(data.prod_nama);
			$("#tbl-qty").text(data.pede_jumlah);
		})


		// set tanggal kirim
		const tanggal_full = new Date();
		const bln_nol = ((tanggal_full.getMonth() + 1) < 10) ? `0${(tanggal_full.getMonth() + 1)}` : (tanggal_full.getMonth() + 1);
		const tanggal_full_string = `${tanggal_full.getFullYear()}-${bln_nol}-${tanggal_full.getDate()}`;
		console.log(tanggal_full_string);
		$("#tanggal").val(tanggal_full_string);

		// Set Kendaraaan
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

		// Set Status
		const status_penjualan = $("#status");
		status_penjualan.empty();
		status_penjualan.attr('disabled', '');
		status_penjualan.append("<option value='kirim'>Kirim</option>");

		// Set Packer
		$('#packer').html('<option value="" selected>Pilih Packer</option>')
		for (let i = 0; i < packer.length; i++) {
			$('#packer').append('<option value="' + packer[i].split('|')[0] + '">' + packer[i].split('|')[1] + '</option>')
		}

		// reset vendor
		// Set Vendor
		$("#vendor-select-1").val("");
		$("#jumlah-1").val("");
		$("#stok-1").val("");
		// clear vendor
		clearVendor();

		// get vendor by id
		$.ajax({
			method: 'post',
			url: '<?= base_url() ?>penjualan/data/getVendorByIdPeDe',
			data: {
				id: pede_id
			},
			success(data) {
				if (data) {
					data.forEach((e, i) => {
						if (i) {
							addVendor({ vendor_id: e.vendor_id, jumlah: e.jumlah, stok: 0 });
							setStok(e.vendor_id, i + 1, prod_id);
						} else {
							$("#vendor-select-1").val(e.vendor_id);
							$("#jumlah-1").val(e.jumlah);
							setStok(e.vendor_id, 1, prod_id);
						}
					});
				}
			},
			error($xhr) {
				console.log($xhr)
			}
		})

		// get packer
		$.ajax({
			method: 'post',
			url: '<?= base_url() ?>penjualan/data/getPackerByPeDe',
			data: {
				id: pede_id
			},
			success(data) {
				if (Number(data)) {
					$("#packer").val(data);
				} else {
					$("#packer").val("");
				}
			},
			error($xhr) {
				console.log($xhr)
			}
		})
	});

	// vendor 1 add
	let vendor_html = '';

	// set vendor
	vendor.forEach(e => {
		e = e.split("|");
		vendor_html += `<option value="${e[0]}" >${e[1]}</option>`;
	});

	$("#vendor-select-1").append(vendor_html);

	// tambah vendor
	$('#vendor-tambah').click(function () {
		addVendor();
	});

	// handle submit kirim =============================================================================================
	$('#submitFormUbah').click(function () {
		let jmlVendor = 0;
		let jmlTotalQty = 0;
		let cekSelisihStok = true;
		let cekJumlahMinimal = true;
		let cekJmlTotalQty = true;
		let cekTanggalKirim = true;
		let cekPacker = true;

		const id = pede_id_now + "|" + penj_id_now + "|" + prod_id_now;
		const status = $("#status").val();
		const packer = $('#packer').val();
		const tanggal_kirim = $("#tanggal").val();

		const vendor_all = $(".vendor-select");
		const jumlah_all = $(".vendor-jumlah");
		const stok_all = $(".vendor-stok");

		let vendor_to_json = [];
		let jumlah_to_json = [];
		let stok_to_json = [];

		// validasi vendor
		vendor_all.each((i, e) => {
			if (e.value != "") {
				if (Number(jumlah_all[i].value) > Number(stok_all[i].value)) {
					cekSelisihStok = false;
				}
				if (Number(jumlah_all[i].value) <= 0) {
					cekJumlahMinimal = false;
				}
				jmlTotalQty += Number(jumlah_all[i].value);
				vendor_to_json.push(e.value);
				jumlah_to_json.push(jumlah_all[i].value);
				stok_to_json.push(stok_all[i].value);
				jmlVendor++;
			}
		});

		// validasi cek vendor
		if (!cekSelisihStok) $.message('Terdapat stok vendor yang kurang', 'Ubah Vendor', 'error');
		if (!cekJumlahMinimal) $.message('Jumlah penjualan harus lebih dari nol.', 'Jumlah Penjualan', 'error');
		if (!jmlVendor) $.message('Belum ada vendor yang di inputkan', 'Jumlah Vendor', 'error');

		// validasi qty
		if (Number(jmlTotalQty) != Number(pede_jumlah_now)) cekJmlTotalQty = false;
		if (Number(jmlTotalQty) > Number(pede_jumlah_now)) $.message(`Jumlah penjualan lebih dari qty ${pede_jumlah_now}.`, 'Jumlah Penjualan', 'error');
		if (Number(jmlTotalQty) < Number(pede_jumlah_now)) $.message(`Jumlah penjualan kurang dari qty ${pede_jumlah_now}.`, 'Jumlah Penjualan', 'error');

		// validasi tanggal
		const el_tanggal = $("#tanggal");
		if (el_tanggal.val() == "") {
			$.message('Tanggal Harus di isi', 'Informasi Pengiriman', 'error');
			cekTanggalKirim = false;
			el_tanggal.focus();
		}

		// validasi packer
		const el_packer = $("#packer");
		if (el_packer.val() == "") {
			$.message('Packer Harus di isi', 'Informasi Pengiriman', 'error');
			cekPacker = fasle;
			el_packer.focus();
		}

		// validasi result
		const valid = cekSelisihStok && cekJumlahMinimal && jmlVendor && cekJmlTotalQty && cekTanggalKirim && cekPacker;

		// eksekusi
		// eksekusi sebelumnya window.apiClient.pengadaanTambah.ubahDetailPengirimanPenjualan(id, status, vendor, packer, tanggal_kirim)
		if (valid) {
			let ele = this;
			ele.setAttribute('disabled', '');
			const vendor = JSON.stringify({ vendor: vendor_to_json, jumlah: jumlah_to_json, stok: stok_to_json });
			ajax = window.apiClient.pengadaanTambah.penjualanKirim(id, vendor, packer, tanggal_kirim)
				.done(function (data) {
					console.log(data);
					$("#advanced-usage").dataTable().fnDestroy();
					$.message('Berhasil diubah.', 'Transaksi Status', 'success');
					dynamic();
				})
				.fail(function ($xhr) {
					$.message('Gagal diubah.', 'Transaksi Status', 'error');
				}).
				always(function () {
					ele.removeAttribute('disabled');
					$('#myModal5').modal('toggle');
				});
		}
	});


	// scan ============================================================================================================
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

		const id = $('#idHapus').val()
		const no_resi = $('#barcode').val()
		const vendor = $("#vendor2").val()
		const packer = $('#packer2').val()
		const tanggal = $('#tanggal_kirim2').val()
		const status = $("#status2").val()

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

	// handle button retur ====================================================================================================
	$('#advanced-usage tbody').on('click', '.btn-retur', function (e) {
		const id_pede = this.dataset.id;
	});

	// handle button ubah =====================================================================================================
	$('#advanced-usage tbody').on('click', '.btn-ubah', function (e) {
		const id_pede = this.dataset.id;
	});

})

function bayar(id) {
	var res = id.split("|");
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

function deleteVendor(v) {
	$(`#vendor-${v}`).remove();
}

function clearVendor() {
	for (let i = vendor_jml; i >= 2; i--) {
		deleteVendor(i);
	}
	vendor_jml = 1;
}



// vendor ==============================================================================================================
function addVendor(data = false) {
	let vendor_id = "";
	let jumlah = "";
	let stok = "";
	if (data) {
		vendor_id = data.vendor_id;
		jumlah = data.jumlah;
		stok = data.stok;
	}

	vendor_jml++;
	let vendor_html = '<option value="">Pilih Vendor</option>';
	vendor.forEach(e => {
		e = e.split("|");
		if (vendor_id == e[0]) {
			vendor_html += `<option value="${e[0]}" selected>${e[1]}</option>`;
		} else {
			vendor_html += `<option value="${e[0]}">${e[1]}</option>`;
		}
	});
	$("#vendors").append(`
		<div class="row" id="vendor-${vendor_jml}">
			<div class="col-md-3" id="pilih-vendor">
				<br>
				<select id="vendor-select-${vendor_jml}" name="vendor-select-${vendor_jml}" class="form-control vendor-select" onchange="handleChangeVendor(this)" data-no="${vendor_jml}">
					${vendor_html}
				</select>
			</div>
			<div class="col-md-9 p-0 m-0">
				<div class="col-md-3">
					<br>
					<input type="number" class="form-control vendor-jumlah" value="${jumlah}" id="jumlah-${vendor_jml}"  onkeyup="handleJumlahStokSisa(${vendor_jml})" onclick="handleJumlahStokSisa(${vendor_jml})" onload="handleJumlahStokSisa(${vendor_jml})">
				</div>
				<div class="col-md-3" id="pilih-vendor-stok">
					<br>
					<input type="number" disabled class="form-control vendor-stok" value="${stok}" id="stok-${vendor_jml}">
				</div>
				<div class="col-md-3" id="pilih-vendor-stok-sisa">
					<br>
					<input type="number" disabled class="form-control vendor-stok-sisa" id="stok-sisa-${vendor_jml}">
				</div>
				<!-- button -->
				<div class="col-md-3">
					<br>
					<div style="display: flex; flex-direction: row-reverse; margin-top:3px;">
						<button class="btn btn-danger btn-ef btn-ef-3 btn-ef-3c vendor-hapus" onclick="deleteVendor(${vendor_jml})"><i class="glyphicon glyphicon-minus"></i> Hapus Vendor</button>
					</div>
				</div>
			</div>
		</div>
		`);
}

// vendor dirubah
function handleChangeVendor(el) {
	let vendor_check = [];
	const vendor_all = $(".vendor-select");

	for (let i = 0; i < vendor_all.length; i++) {
		if (vendor_all[i].value != "" && vendor_all[i] != el) {
			vendor_check[i] = vendor_all[i].value;
		}
	}
	// validasi
	// cek apakah vendor sudah ada
	if (vendor_check.includes(el.value)) {
		$.message('Vendor sudah digunakan sebelumnya.', 'Ubah Vendor', 'error');
		el.value = "";
	} else {
		el.setAttribute('disabled', '');
		setStok(el.value, el.dataset.no, prod_id_now);
	}
}

function setStok(vendor, i, prod_id) {
	$.ajax({
		method: 'post',
		url: '<?= base_url() ?>penjualan/data/getStokByVendorPeDe',
		data: {
			vendor_id: vendor,
			prod_id, prod_id
		},
		success(data) {
			$("#stok-" + i).val(data);
			handleJumlahStokSisa(i);
		},
		error($xhr) {
			console.log($xhr)
		},
		complete() {
			$("#vendor-select-" + i).removeAttr('disabled');
		}
	})
}

function handleJumlahStokSisa(id) {
	let stok = $(`#stok-${id}`).val();
	stok = (Number(stok) != NaN) ? Number(stok) : 0;

	let jml = $(`#jumlah-${id}`).val();
	jml = Number(jml ? jml : 0);

	$(`#stok-sisa-${id}`).val(stok - jml);
}

