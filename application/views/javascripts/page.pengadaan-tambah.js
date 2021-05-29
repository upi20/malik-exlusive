$(function () {

	value_code();
	total();
	value_supplier();

	function value_supplier() {
		$("#supp_id").empty();
		$("#supp_id").append('<option value="" selected>Pilih Supplier</option>');
		$.ajax({
			method: 'post',
			url: '<?= base_url() ?>pengadaan/tambah/getDataSupplier',
			data: null
		}).done(function (data) {
			$.each(data, function (value, key) {
				$("#supp_id").append("<option selected value='" + key.supp_id + "'>" + key.supp_nama + "</option>");
			})
		})
	}

	// testtest();
	function testtest() {
		var ar1 = [1, 3];
		var ar2 = [5, 6];


		$('input[name^="min_stok_special"]').each(function () {
			// alert($(this).val());
			ar1.push($(this).val());
		});

		$('input[name^="pros_id"]').each(function () {
			ar2.push($(this).val());
			// alert($(this).val());
		});

		var ar3 = ar1.concat(ar2);

		// var info = $.serialize(ar3);

		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>pengadaan/tambah/detail_product",
			data: { info: ar3 },
			success: function (msg) {
				// $('.answer').html(msg);
				console.log(msg)
			}
		});
	}
	$('#dibayar').autoNumeric('init');
	$('#harga').autoNumeric('init');

	function value_code() {
		window.apiClient.code.getCodePengadaan().done(function (res) {
			$("#code").val(res.id);
		}).fail(function ($xhr) {
			console.log($xhr);
		});
	}

	// function value_filter_produk(){
	// 	$("#prod_id").empty();
	// 	$("#prod_id").append('<option value="" selected>Pilih Produk</option>');
	// 	window.apiClient.filter.referensiProduk().done(function(res) {
	// 		$.each(res, function(value, key) {
	// 			$("#prod_id").append("<option value='"+key.prod_id+"'>"+key.prod_nama+"</option>");
	// 	  	})
	// 	}).fail(function($xhr) {
	// 		console.log($xhr);
	// 	});
	// }

	function total() {
		window.apiClient.pengadaanTambah.getTotalHarga().done((res) => {
			$('#total_harga').val(window.apiClient.format.rupiah(res, ''))
			let nilai = terbilang(res);
			$('#total_harga_terbilang').val(nilai)
		}).fail((xhr) => {
			console.log($xhr)
		});
	}

	value_filter_kategori();

	function value_filter_kategori() {
		$("#parent1").empty();
		// let level = $("#level").val();
		$("#parent1").append('<option value="" selected>Pilih Kategori Utama</option>');
		window.apiClient.filter.referensiKategoriWhere(null, 1).done(function (res) {
			$.each(res, function (value, key) {
				$("#parent1").append("<option value='" + key.kate_id + "'>" + key.kate_nama + "</option>");
			})
		}).fail(function ($xhr) {
			console.log($xhr);
		});
	}


	$('#parent1').on('change', () => {
		let parent1 = $("#parent1").val();
		let level = $("#level").val();
		$("#parent2").empty();
		$("#parent2").append('<option value="" selected>Pilih Kategori</option>');
		window.apiClient.filter.referensiKategoriWhere(parent1, 2).done(function (res) {
			$.each(res, function (value, key) {
				$("#parent2").append("<option value='" + key.kate_id + "'>" + key.kate_nama + "</option>");
			})
		}).fail(function ($xhr) {
			console.log($xhr);
		});

		$("#prod_id").empty();
		$("#prod_id").append('<option value="" selected>Pilih Produk</option>');
		window.apiClient.filter.referensiProdukWhere(parent1, null, null).done(function (res) {
			$.each(res, function (value, key) {
				$("#prod_id").append("<option value='" + key.prod_id + "'>" + key.prod_nama + "</option>");
			})
		}).fail(function ($xhr) {
			console.log($xhr);
		});
	})

	$('#parent2').on('change', () => {
		let parent2 = $("#parent2").val();
		let level = $("#level").val();
		$("#parent3").empty();
		$("#parent3").append('<option value="" selected>Pilih Sub Kategori</option>');
		window.apiClient.filter.referensiKategoriWhere(parent2, 3).done(function (res) {
			$.each(res, function (value, key) {
				$("#parent3").append("<option value='" + key.kate_id + "'>" + key.kate_nama + "</option>");
			})
		}).fail(function ($xhr) {
			console.log($xhr);
		});

		$("#prod_id").empty();
		$("#prod_id").append('<option value="" selected>Pilih Produk</option>');
		window.apiClient.filter.referensiProdukWhere(null, parent2, null).done(function (res) {
			$.each(res, function (value, key) {
				$("#prod_id").append("<option value='" + key.prod_id + "'>" + key.prod_nama + "</option>");
			})
		}).fail(function ($xhr) {
			console.log($xhr);
		});
	})

	$('#parent3').on('change', () => {
		let parent3 = $("#parent3").val();
		$("#prod_id").empty();
		$("#prod_id").append('<option value="" selected>Pilih Produk</option>');
		window.apiClient.filter.referensiProdukWhere(null, null, parent3).done(function (res) {
			$.each(res, function (value, key) {
				$("#prod_id").append("<option value='" + key.prod_id + "'>" + key.prod_nama + "</option>");
			})
		}).fail(function ($xhr) {
			console.log($xhr);
		});
	})
	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"scrollX": true,
		"ajax": {
			"url": "<?= base_url()?>pengadaan/tambah/ajax_data_detail/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "kate_nama_1" },
			{ "data": "prod_kode" },
			{ "data": "prod_nama" },
			{
				data: "pend_harga", render: function (data, type, full, meta) {
					let nominal = window.apiClient.format.rupiah(data, '');
					return '<p style="text-align:right;">' + nominal + '</p>';
				}
			},
			{ "data": "pend_jumlah" },
			{ "data": "pend_berat" },
			{ "data": "prod_special" },
			{
				data: "pend_total_harga", render: function (data, type, full, meta) {
					let nominal = window.apiClient.format.rupiah(data, '');
					return '<p style="text-align:right;">' + nominal + '</p>';
				}
			},
			{
				data: "pend_id", render: function (data, type, full, meta) {
					return '<a class="btn btn-danger btn-sm hapus-detail" href="#' + data + '" style="float:right;">Hapus</a>';
				}
			},
		],
		"aoColumnDefs": [
			{ 'bSortable': false, 'aTargets': ["no-sort"] }
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

	function dynamic() {
		//initialize responsive datatable

		var table4 = $('#advanced-usage').DataTable({
			"scrollX": true,
			"ajax": {
				"url": "<?= base_url()?>pengadaan/tambah/ajax_data_detail/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
				{ "data": "kate_nama_1" },
				{ "data": "prod_kode" },
				{ "data": "prod_nama" },
				{
					data: "pend_harga", render: function (data, type, full, meta) {
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">' + nominal + '</p>';
					}
				},
				{ "data": "pend_jumlah" },
				{ "data": "pend_berat" },
				{ "data": "prod_special" },
				{
					data: "pend_total_harga", render: function (data, type, full, meta) {
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">' + nominal + '</p>';
					}
				},
				{
					data: "pend_id", render: function (data, type, full, meta) {
						return '<a class="btn btn-danger btn-sm hapus-detail" href="#' + data + '" style="float:right;">Hapus</a>';
					}
				},
			],
			"aoColumnDefs": [
				{ 'bSortable': false, 'aTargets': ["no-sort"] }
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


	// fungsi simpan
	$('#form').submit(function (ev) {
		ev.preventDefault();
		let code = $('#code').val();
		let parent1 = $('#parent1').val();
		let parent2 = $('#parent2').val();
		let parent3 = $('#parent3').val();
		let prod_id = $('#prod_id').val();
		let jumlah = $('#jumlah').val();
		let harga = $('#harga').val();
		let total = $('#total').val();
		let berat = $('#berat').val();
		harga = window.apiClient.format.splitString(harga, '.');
		total = window.apiClient.format.splitString(total, '.');
		var ar1 = [];
		var ar2 = [];


		$('input[name^="min_stok_special"]').each(function () {
			// alert($(this).val());
			ar1.push($(this).val());
		});

		$('input[name^="pros_id"]').each(function () {
			ar2.push($(this).val());
			// alert($(this).val());
		});

		var ar3 = ar1.concat(ar2);


		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>pengadaan/tambah/detail_product",
			data: { info: ar3, peng_id: code, prod_id: prod_id },
			success: function (msg) {
				console.log(msg)
			}
		});

		let supp_id = $('#supp_id').val();
		let kode_produk_alias = $('#kode_produk_alias').val();
		let no_tracking = $('#no_tracking').val();
		let link_referensi = $('#link_referensi').val();
		let ajax = null;
		ajax = window.apiClient.pengadaanTambah.insert(code, parent1, parent2, parent3, prod_id, jumlah, harga, total, berat, supp_id, kode_produk_alias, no_tracking, link_referensi)
			.done(function (data) {
				$("#advanced-usage").dataTable().fnDestroy();
				dynamic();
				$.message('Berhasil ditambahkan.', 'Pembeliaan Detail', 'success');
				$('#parent1').val('');
				$('#parent2').val('');
				$('#parent3').val('');
				$('#prod_id').val('');
				$('#jumlah').val('');
				$('#harga').val('');
				$('#total').val('');
				$('#berat').val('');
				$('#kode_produk_alias').val('');
				$('#no_tracking').val('');
				$('#link_referensi').val('');

				// coddingan total
				window.apiClient.pengadaanTambah.getTotalHarga().done((res) => {
					$('#total_harga').val(window.apiClient.format.rupiah(res, ''))
					let nilai = terbilang(res);
					$('#total_harga_terbilang').val(nilai)
				}).fail((xhr) => {
					console.log($xhr)
				});
			})
			.fail(function ($xhr) {
				$.message('Gagal ditambahkan.', 'Pembeliaan Detail', 'success');
			}).
			always(function () {
				$('#splash').modal('toggle');
			});
	});

	// fungsi simpan
	$('#form_head').submit(function (ev) {
		ev.preventDefault();
		let id = $('#code').val();
		let tanggal = $('#tanggal').val();
		let keterangan = $('#keterangan').val();
		let total_harga = $('#total_harga').val();
		let supp_id = $('#supp_id').val();
		total_harga = window.apiClient.format.splitString(total_harga, '.');
		let dibayar = $('#dibayar').val();
		dibayar = window.apiClient.format.splitString(dibayar, '.');
		let sisa = Number(total_harga) - Number(dibayar);
		let ajax = null;

		ajax = window.apiClient.pengadaanTambah.insertHead(id, tanggal, keterangan, total_harga, dibayar, sisa, supp_id)
			.done(function (data) {
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil ditambahkan.', 'Pembeliaan', 'success')
				dynamic()
				$('#total_harga').val('')
				$('#total_harga_terbilang').val('')
				window.location.href = "<?php echo base_url();?>pengadaan/data";
			})
			.fail(function ($xhr) {
				$.message('Gagal ditambahkan.', 'Pembeliaan', 'success');
			}).
			always(function () {
				$('#splash').modal('toggle');
			});
	});

	$('#kate_id').on('change', () => {
		let kate_id = $("#kate_id").val();
		$("#prod_id").empty();
		$("#prod_id").append('<option value="" selected>Pilih Produk</option>');
		window.apiClient.filter.referensiProdukWhere(kate_id, null, null).done(function (res) {
			$.each(res, function (value, key) {
				$("#prod_id").append("<option value='" + key.prod_id + "'>" + key.prod_nama + "</option>");
			})
		}).fail(function ($xhr) {
			console.log($xhr);
		});
	})

	$('#prod_id').on('change', () => {
		let prod_id = $('#prod_id').val();
		let kate_id = $("#kate_id").val();
		window.apiClient.filter.referensiProdukWhere(null, null, null, prod_id).done(function (res) {
			$.each(res, function (value, key) {
				// if(key.prod_selisih_stok < 1){
				let harga = key.prod_harga_beli;
				let berat = key.prod_berat;
				let satuan = key.prod_special;
				let vendor = key.prod_vendor;
				$("#harga").val(window.apiClient.format.rupiah('' + harga, ''));
				var jumlah = $('#jumlah').val();
				harga = window.apiClient.format.splitString(harga, '.');
				var total = Number(jumlah) * Number(harga);
				let nominal = window.apiClient.format.rupiah('' + total, '');
				$('#total').val(nominal);
				$("#span-satuan").text('( ' + satuan + ' )');
				$("#berat").val(berat);
				$("#satuan").val(satuan);
				// }else{
				// 	alert('Stok produk ini melebihi dari cukup')
				// 	$("#harga").val(0);
				// 	$("#berat").val('');
				// 	$("#satuan").val('');
				// 	$('#total').val(0);
				// }
			})
		}).fail(function ($xhr) {
			console.log($xhr);
		});
	})


	$('#jumlah').on('change', () => {
		var jumlah = $('#jumlah').val();
		var harga = $('#harga').val();
		harga = window.apiClient.format.splitString(harga, '.');

		var total = Number(jumlah) * Number(harga);
		let nominal = window.apiClient.format.rupiah('' + total, '');
		$('#total').val(nominal);
	})
	$('#harga').on('change', () => {
		var jumlah = $('#jumlah').val();
		var harga = $('#harga').val();
		harga = window.apiClient.format.splitString(harga, '.');

		var total = Number(jumlah) * Number(harga);
		let nominal = window.apiClient.format.rupiah('' + total, '');
		$('#total').val(nominal);
	})

	function terbilang(nilai) {
		var bilangan = nilai;
		console.log(bilangan);
		var kalimat = "";
		var angka = new Array('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
		var kata = new Array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan');
		var tingkat = new Array('', 'Ribu', 'Juta', 'Milyar', 'Triliun');
		var panjang_bilangan = bilangan.length;
		// panjang_bilangan = 14;
		/* pengujian panjang bilangan */
		if (panjang_bilangan > 15) {
			kalimat = "Diluar Batas";
		} else {
			/* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
			for (i = 1; i <= panjang_bilangan; i++) {
				angka[i] = bilangan.substr(-(i), 1);
			}

			var i = 1;
			var j = 0;

			/* mulai proses iterasi terhadap array angka */
			while (i <= panjang_bilangan) {
				subkalimat = "";
				kata1 = "";
				kata2 = "";
				kata3 = "";

				/* untuk Ratusan */
				if (angka[i + 2] != "0") {
					if (angka[i + 2] == "1") {
						kata1 = "Seratus";
					} else {
						kata1 = kata[angka[i + 2]] + " Ratus";
					}
				}

				/* untuk Puluhan atau Belasan */
				if (angka[i + 1] != "0") {
					if (angka[i + 1] == "1") {
						if (angka[i] == "0") {
							kata2 = "Sepuluh";
						} else if (angka[i] == "1") {
							kata2 = "Sebelas";
						} else {
							kata2 = kata[angka[i]] + " Belas";
						}
					} else {
						kata2 = kata[angka[i + 1]] + " Puluh";
					}
				}

				/* untuk Satuan */
				if (angka[i] != "0") {
					if (angka[i + 1] != "1") {
						kata3 = kata[angka[i]];
					}
				}

				/* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
				if ((angka[i] != "0") || (angka[i + 1] != "0") || (angka[i + 2] != "0")) {
					subkalimat = kata1 + " " + kata2 + " " + kata3 + " " + tingkat[j] + " ";
				}

				/* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
				kalimat = subkalimat + kalimat;
				i = i + 3;
				j = j + 1;
			}

			/* mengganti Satu Ribu jadi Seribu jika diperlukan */
			if ((angka[5] == "0") && (angka[6] == "0")) {
				kalimat = kalimat.replace("Satu Ribu", "Seribu");
			}
		}

		return kalimat;
	}

	// function hapusData(ids=null){
	// 	console.log(ids);
	// }

	$('#advanced-usage tbody').on('click', '.hapus-detail', function (ev) {
		// var ids = $(this).val();
		var ids = $(this).attr("href");
		ids = window.apiClient.format.splitString(ids, '#');
		$("#idHapus").val(ids);
		console.log(ids);
		$("#labelHapus").text('Form Hapus');
		$("#contentHapus").text('Apakah anda yakin akan menghapus data ini?');

		$('#myModal3').modal('toggle');
	});

	// fungsi hapus jika ya
	$('#clickHapus').click(function () {
		let id = $("#idHapus").val();
		ajax = window.apiClient.pengadaanTambah.hapusDetail(id)
			.done(function (data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.', 'Pembeliaan', 'success');
				dynamic();
				// window.apiClient.code.getNoRecBaru().done(function(res) {
				// 		$("#no_rec").val(res.id);
				// 	}).fail(function($xhr) {
				// 		console.log($xhr);
				// 	});
				// coddingan total
				window.apiClient.pengadaanTambah.getTotalHarga().done((res) => {
					$('#total_harga').val(window.apiClient.format.rupiah(res, ''))
					let nilai = terbilang(res);
					$('#total_harga_terbilang').val(nilai);

				}).fail((xhr) => {
					console.log($xhr)
				});
			})
			.fail(function ($xhr) {
				$.message('Gagal dihapus.', 'Pembeliaan', 'error');
			}).
			always(function () {
				$('#myModal3').modal('toggle');
			});
	});

	// fungsi cari produk
	$('#cari_produk').click(function () {
		let val_kode = $("#val_kode").val();
		window.apiClient.filter.referensiProdukWhere(null, null, null, null, val_kode).done(function (res) {
			$.each(res, function (value, key) {
				let val_id = key.prod_id;
				let special = key.prod_special;
				let harga = key.prod_harga_beli;
				let berat = key.prod_berat;
				let satuan = key.prod_special;
				// $("#span-satuan").text('( '+satuan+' )');
				// let berat 	= res.prod_berat+' '+res.prod_special;
				let vendor = key.prod_vendor;
				// window.apiClient.filter.getValueSupplier(vendor).done(function(res) {
				// 	$('#supp_id').val(res.supp_id);
				// }).fail(function($xhr) {
				// 	console.log($xhr);
				// });
				$("#harga").val(window.apiClient.format.rupiah('' + harga, ''));
				// $("#harga").val(harga);
				// $("#berat").val(Number(berat));
				var jumlah = $('#jumlah').val();
				$('#berat').val(key.prod_berat);
				$('#satuan').val(satuan);
				$('#parent1').val(key.prod_kate_id);
				$('#parent2').empty();
				window.apiClient.filter.referensiKategoriWhere(key.prod_kate_id, 2).done(function (res2) {
					$.each(res2, function (value, val) {
						if (val.kate_id == key.prod_kate_id_2) {
							$("#parent2").append("<option selected value='" + val.kate_id + "'>" + val.kate_nama + "</option>");
						} else {
							$("#parent2").append("<option value='" + val.kate_id + "'>" + val.kate_nama + "</option>");
						}
					})
				}).fail(function ($xhr) {
					console.log($xhr);
				});

				$('#parent3').empty();
				window.apiClient.filter.referensiKategoriWhere(key.prod_kate_id_2, 3).done(function (res3) {
					$.each(res3, function (value, val) {
						if (val.kate_id == key.prod_kate_id_3) {
							$("#parent3").append("<option selected value='" + val.kate_id + "'>" + val.kate_nama + "</option>");
						} else {
							$("#parent3").append("<option value='" + val.kate_id + "'>" + val.kate_nama + "</option>");
						}
					})
				}).fail(function ($xhr) {
					console.log($xhr);
				});

				$("#prod_id").empty();
				$("#prod_id").append('<option value="" selected>Pilih Produk</option>');
				window.apiClient.filter.referensiProdukWhere(null, key.prod_kate_id_2, key.prod_kate_id_3).done(function (res4) {
					$.each(res4, function (value, val) {
						if (val.prod_id == key.prod_id) {
							$("#prod_id").append("<option selected value='" + val.prod_id + "'>" + val.prod_nama + "</option>");
						} else {
							$("#prod_id").append("<option value='" + val.prod_id + "'>" + val.prod_nama + "</option>");
						}
					})
				}).fail(function ($xhr) {
					console.log($xhr);
				});

				// $('#parent2').val(key.prod_kate_id_2);
				// $('#parent3').val(key.prod_kate_id_3);
				harga = window.apiClient.format.splitString(harga, '.');
				var total = Number(jumlah) * Number(harga);
				let nominal = window.apiClient.format.rupiah('' + total, '');
				$('#total').val(nominal);
			})
		}).fail(function ($xhr) {
			console.log($xhr);
		});
	});
});