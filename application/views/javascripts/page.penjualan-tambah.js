 $(function() {

 	value_code()
 	value_filter_kategori()
 	value_filter_produk()
 	value_filter_sumber_penjualan()
 	total()
 	$('#dibayar').autoNumeric('init');
 	$('#harga').autoNumeric('init');
 	$('#nominal_recah').autoNumeric('init');
 	$('#nominal_pengiriman').autoNumeric('init');
 	
 	
	 function value_filter_kategori(){
		 $("#parent1").empty();
		 // let level = $("#level").val();
		 $("#parent1").append('<option value="" selected>Pilih Kategori Utama</option>');
		 window.apiClient.filter.referensiKategoriWhere(null,1).done(function(res) {
				 $.each(res, function(value, key) {
					 $("#parent1").append("<option value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
				   })
		 }).fail(function($xhr) {
			 console.log($xhr);
		 });

	 }

	 $('#parent1').on('change', () =>
	 {
		 let parent1 = $("#parent1").val();
		 let level = $("#level").val();
		 // $("#parent2").empty();
		 // $("#parent2").append('<option value="" selected>Pilih Kategori</option>');
		 // window.apiClient.filter.referensiKategoriWhere(parent1,2).done(function(res) {
			// 	 $.each(res, function(value, key) {
			// 		 $("#parent2").append("<option value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
			//    })
		 // }).fail(function($xhr) {
			//  console.log($xhr);
		 // });

		window.apiClient.filter.referensiProdukWhere(parent1, null, null).done(function(res) {
				$(".chosen-select").empty();
				$(".chosen-select").append('<option value="">Pilih Produk</option>');

				$.each(res, function(value, key) {
					$(".chosen-select").append("<option value='"+key.prod_id+"'>"+key.prod_nama+"</option>").trigger("chosen:updated");
			  	})
		}).fail(function($xhr) {
			console.log($xhr);
		});
	 })

	$('#parent2').on('change', () =>
	{
		let parent2 = $("#parent2").val();
		let level = $("#level").val();
		$("#parent3").empty();
		$("#parent3").append('<option value="" selected>Pilih Sub Kategori</option>');
		window.apiClient.filter.referensiKategoriWhere(parent2,3).done(function(res) {
				$.each(res, function(value, key) {
					$("#parent3").append("<option value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});

		window.apiClient.filter.referensiProdukWhere(null, parent2, null).done(function(res) {
			$(".chosen-select").empty();
			$(".chosen-select").append('<option value="">Pilih Produk</option>');

			$.each(res, function(value, key) {
				$(".chosen-select").append("<option value='"+key.prod_id+"'>"+key.prod_nama+"</option>").trigger("chosen:updated");
			})
		}).fail(function($xhr) {
			console.log($xhr);
		});
	})


	$('#parent3').on('change', () =>
	{
		let parent3 = $("#parent3").val();
		$(".chosen-select").empty();
		$(".chosen-select").append('<option value="" selected>Pilih Produk</option>').trigger("chosen:updated");
		window.apiClient.filter.referensiProdukWhere(null, null, parent3).done(function(res) {
				$.each(res, function(value, key) {
					$(".chosen-select").append("<option value='"+key.prod_id+"'>"+key.prod_kode+"</option>").trigger("chosen:updated");
			  	})
		}).fail(function($xhr) {
			console.log($xhr);
		});
	})
	
 	function value_code()
 	{
		window.apiClient.code.getCodePenjualan().done(function(res) {
			$("#code").val(res.id);
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	function value_filter_sumber_penjualan(regi_id=null){
		$("#supe_id").empty();
		$("#supe_id").append('<option value="">Pilih Sumber Penjualan</option>');
		window.apiClient.filter.referensiSumberPenjualan().done(function(res) {
				$.each(res, function(value, key) {
					$("#supe_id").append("<option value='"+key.supe_id+"'>"+key.supe_nama+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	// function value_filter_kategori(){
	// 	window.apiClient.filter.referensiKategori().done(function(res) {
	// 		$.each(res, function(value, key) {
	// 			$("#kate_id").append("<option value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
	// 	    })
	// 	}).fail(function($xhr) {
	// 		console.log($xhr);
	// 	});
	// }

	function value_filter_produk(kate_id=null){
		// window.apiClient.filter.referensiProdukWhere(kate_id).done(function(res) {
		// 		$(".chosen-select").empty();
		// 		$(".chosen-select").append('<option value="">Pilih Produk</option>');
		// 		$.each(res, function(value, key) {
		// 			$(".chosen-select").append("<option value='"+key.prod_id+"'>"+key.prod_nama+"</option>").trigger("chosen:updated");
		// 	  })
		// }).fail(function($xhr) {
		// 	console.log($xhr);
		// });
	}

	function total()
	{
		window.apiClient.penjualanTambah.getTotalHarga().done((res) =>
		{
			if(res >= 1000000){
					$("#status_pengiriman").css("display", "block");
			}else{
					$("#status_pengiriman").css("display", "none");
			}
			$('#total_harga').val(window.apiClient.format.rupiah(res, ''))
			let nilai = terbilang(res)
			// console.log(nilai)
			$('#total_harga_terbilang').val(nilai)
		}).fail((xhr) =>
		{
			console.log($xhr)
		})
	}

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"scrollX": true,
		"ajax": {
				"url": "<?= base_url()?>penjualan/tambah/ajax_data_detail/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
				// { "data": "kate_nama_1" },
				// { "data": "kate_nama_2" },
				// { "data": "prod_kode" },
				{ "data": "prod_nama" },
				{
					data: "pede_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				{ "data": "pede_jumlah" },
				{
					data: "pede_total_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				{
					data: "pede_id", render: function(data, type, full, meta)
					{
						return '<button class="btn btn-danger btn-sm hapus-detail" value="'+data+'" style="float:right;">Hapus</button>';
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
		"scrollX": true,
		"ajax": {
				"url": "<?= base_url()?>penjualan/tambah/ajax_data_detail/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
				// { "data": "kate_nama_1" },
				// { "data": "kate_nama_2" },
				// { "data": "prod_kode" },
				{ "data": "prod_nama" },
				{
					data: "pede_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				{ "data": "pede_jumlah" },
				{
					data: "pede_total_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				{
					data: "pede_id", render: function(data, type, full, meta)
					{
						return '<button class="btn btn-danger btn-sm hapus-detail" value="'+data+'" style="float:right;">Hapus</button>';
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
	}



	// fungsi simpan 
	$('#form').submit(function(ev) {
		ev.preventDefault();
		// value_code_detail();
		let code 		= $('#code').val();
		let parent1 	= $('#parent1').val();
		let parent2 	= $('#parent2').val();
		let parent3 	= $('#parent3').val();
		let prod_id 	= $('#prod_id').val();
		let harga 		= $('#harga').val();
		let jumlah 		= $('#jumlah').val();
		let total_harga = $('#total_harga_detail').val();
		harga 			= window.apiClient.format.splitString(harga, '.');
		total_harga 	= window.apiClient.format.splitString(total_harga, '.');
		let ajax = null;
		ajax = window.apiClient.penjualanTambah.insert(code, parent1, parent2, parent3, prod_id, harga, jumlah, total_harga)
		.done(function(data) {
			$("#advanced-usage").dataTable().fnDestroy();
			$.message('Berhasil ditambahkan.','Penjualan','success');
			$('#kate_nama').val('');
			$('#kate_id').val('');
			$('#harga_awal').val('');
			$('#total_harga_detail').val('');
			$('#jumlah').val('');
			$('#stok').val('');
			$('#harga').val('');
			$('#total').val('');
			$("#stok").val('');
			$("#prod_id").val('');
			$("#parent1").val('');
			$("#parent2").val('');
			$("#parent3").val('');
			$("#harga_awal").val('');
			$("#val_kode").val('');
			$(".chosen-select").empty();
			$(".chosen-select").append('<option value="" selected>Pilih Produk</option>').trigger("chosen:updated");
			$("#berat").val('');
			value_filter_produk();
			dynamic();
			total();
		})
		.fail(function($xhr) {
			$.message('Gagal ditambahkan.','Penjualan Detail','success');
		}).
		always(function() {
			$('#splash').modal('toggle');
		});
	});

	// fungsi simpan 
	$('#form_head').submit(function(ev) {
		ev.preventDefault();
		let code 			= $('#code').val();
		let user_id 		= $('#user_id').val();
		let tanggal 		= $('#tanggal').val();
		let nama 			= $('#nama').val();
		let id_toko 		= $("#id_toko").val();
		let no_resi 		= $("#no_resi").val();
		let no_hp 			= $('#no_hp').val();
		let alamat 			= $('#alamat').val();
		let tanggal_pengiriman = $('#tanggal_pengiriman').val();
		let keterangan 		= $('#keterangan').val();
		let total 			= $('#total_harga').val();
		let nominal_recah 	= $('#nominal_recah').val();
		let nominal_pengiriman = $('#nominal_pengiriman').val();
		// let supe_id 		= $('#supe_id').val();
		let supe_id 		= 1;
		let id_marketplace 		= $('#id_marketplace').val();
		let kurir 		= $('#kurir').val();
		let ongkir 		= $('#ongkir').val();
		nominal_recah 		= window.apiClient.format.splitString(nominal_recah, '.');
		nominal_pengiriman 	= window.apiClient.format.splitString(nominal_pengiriman, '.');
		total 				= window.apiClient.format.splitString(total, '.');
		let dibayar 		= $('#dibayar').val();

		dibayar 				= window.apiClient.format.splitString(dibayar, '.');


		var formData = new FormData(this);
		let id 			= $('#imageUploadForm input[name=id]').val();
		$.ajax({
			type: 'POST',
			url:'<?= base_url() ?>penjualan/tambah/insertHead',
			data:formData,
			cache:false,
			contentType: false,
			processData: false,
			success: function(data) {
				$.message('Berhasil ditambahkan.','Penjualan','success');
				window.location.href = "<?php echo base_url();?>penjualan/data"
			},
			error: function(data) {
				$.message('Gagal ditambahkan.','Penjualan','error');
				$('#splash').modal('toggle');
			}
		})
		// if(1 == 2){
		// 	alert('Mohon maaf, uang yang dibayar lebih. Harap periksa kembali');
		// }else{
		// 	let sisa 			= Number(total) - Number(dibayar);
		// 	// console.log(code, user_id, tanggal, nama, no_hp, alamat, nama2, no_hp2, alamat2, keterangan, total, dibayar, sisa)
		// 	let ajax = null;
		// 	ajax = window.apiClient.penjualanTambah.insertHead(code, user_id, tanggal, nama, no_hp, alamat, tanggal_pengiriman, keterangan, total, dibayar, sisa, nominal_recah, nominal_pengiriman, supe_id, id_marketplace, kurir, ongkir, id_toko, no_resi)
		// 	.done(function(data) {
		// 		$("#advanced-usage").dataTable().fnDestroy();
		// 		$.message('Berhasil ditambahkan.','Pemesanan','success');
		// 		// value_code();
		// 		// dynamic();
		// 		window.location.href = "<?php echo base_url();?>penjualan/data"
		// 		$('#id_pemesanan').val('');
		// 		// $('#nama').val('');
		// 		// $('#no_hp').val('');
		// 		// $('#alamat').val('');
		// 		// $('#tanggal').val('');
		// 		// $('#total_harga').val('');
		// 		// $('#dibayar').val('');
		// 		// $('#nama_produk').val('')
				
		// 	})
		// 	.fail(function($xhr) {
		// 		$.message('Gagal ditambahkan.','Pemesanan','success');
		// 	}).
		// 	always(function() {
		// 		$('#splash').modal('toggle');
		// 	});	
		// }

		
	});

	$('.chosen-select').on('change', () =>
	{
		let id = $('.chosen-select').val();
		window.apiClient.penjualanTambah.getProduk(id).done((res) =>
		{
			$('#nama_produk').val(res['produk'])
			$("#stok").val(res['stok']);
			$("#kate_id").val(res['kate_id']);
			$("#kate_nama").val(res['kate_nama']);
			$("#harga_awal").val(window.apiClient.format.rupiah(''+res['harga_awal'], ''));
			$("#harga").val(window.apiClient.format.rupiah(''+res['harga'], ''));
			$("#berat").val(res['berat']);
			// let satuan 	= res['satuan'];
			// $("#span-satuan").text('( '+satuan+' )');
			$('#satuan').val(res['satuan']);
		}).fail((xhr) =>
		{
			$.message('Produk Tidak Dimukan.','Produk','error');
		});
	});

	$('#harga').on('change', () =>
	{
		var jumlah 	= $('#jumlah').val()
		var harga 	= $('#harga').val()
		var total 	= Number(jumlah) * Number(harga)
		$('#total_harga_detail').val(total)
	});

	$('#jumlah').on('change', () =>
	{
		var stok_awal = $("#stok").val();
		var jumlah 	= $('#jumlah').val();
		if(parseInt(jumlah) > parseInt(stok_awal)){
			alert('stok tidak cukup. Maksimal '+stok_awal)
			$('#jumlah').val(stok_awal);
			var harga 	= $('#harga').val();
			harga 		= window.apiClient.format.splitString(harga, '.');
			var total 	= Number(stok_awal) * Number(harga);
			let nominal = window.apiClient.format.rupiah(''+total, '');
			$('#total_harga_detail').val(nominal);
		}else{
			var harga 	= $('#harga').val();
			harga 		= window.apiClient.format.splitString(harga, '.');
			var total 	= Number(jumlah) * Number(harga);
			let nominal = window.apiClient.format.rupiah(''+total, '');
			$('#total_harga_detail').val(nominal);	
		}
		
	})

	function terbilang(nilai=0){
	    var bilangan = nilai;
	    var kalimat  = "";
	    var angka    = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
	    var kata     = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
	    var tingkat  = new Array('','Ribu','Juta','Milyar','Triliun');

	    var panjang_bilangan = 0;
	    panjang_bilangan = bilangan.length;
	    // panjang_bilangan = 14;
	    /* pengujian panjang bilangan */
	    if(panjang_bilangan > 15){
	        kalimat = "Diluar Batas";
	    }else{
	        /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
	        for(i = 1; i <= panjang_bilangan; i++) {
	            angka[i] = bilangan.substr(-(i),1);
	        }
	         
	        var i = 1;
	        var j = 0;
	         
	        /* mulai proses iterasi terhadap array angka */
	        while(i <= panjang_bilangan){
	            subkalimat = "";
	            kata1 = "";
	            kata2 = "";
	            kata3 = "";
	             
	            /* untuk Ratusan */
	            if(angka[i+2] != "0"){
	                if(angka[i+2] == "1"){
	                    kata1 = "Seratus";
	                }else{
	                    kata1 = kata[angka[i+2]] + " Ratus";
	                }
	            }
	             
	            /* untuk Puluhan atau Belasan */
	            if(angka[i+1] != "0"){
	                if(angka[i+1] == "1"){
	                    if(angka[i] == "0"){
	                        kata2 = "Sepuluh";
	                    }else if(angka[i] == "1"){
	                        kata2 = "Sebelas";
	                    }else{
	                        kata2 = kata[angka[i]] + " Belas";
	                    }
	                }else{
	                    kata2 = kata[angka[i+1]] + " Puluh";
	                }
	            }
	             
	            /* untuk Satuan */
	            if (angka[i] != "0"){
	                if (angka[i+1] != "1"){
	                    kata3 = kata[angka[i]];
	                }
	            }
	             
	            /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
	            if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")){
	                subkalimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
	            }
	             
	            /* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
	            kalimat = subkalimat + kalimat;
	            i = i + 3;
	            j = j + 1;
	        }
	         
	        /* mengganti Satu Ribu jadi Seribu jika diperlukan */
	        if ((angka[5] == "0") && (angka[6] == "0")){
	            kalimat = kalimat.replace("Satu Ribu","Seribu");
	        }
	    }

	    return kalimat;
	}

	$('#advanced-usage tbody').on('click', '.hapus-detail', function(ev) {
		var ids = $(this).val();
		$("#idHapus").val(ids);
		$("#labelHapus").text('Form Hapus');
		$("#contentHapus").text('Apakah anda yakin akan menghapus data ini?');
		$('#myModal3').modal('toggle');
	});
	
	
	$('#btn-tambah').click(function() {
		$('#nama_produk').val('')
			$("#stok").val('');
			$("#kate_id").val('');
			$("#kate_nama").val('');
			$("#harga_awal").val('');
			$("#harga").val('');
			$("#berat").val('');
	});
	// fungsi hapus jika ya
	$('#clickHapus').click(function() {
		let id = $("#idHapus").val();
		ajax = window.apiClient.penjualanTambah.hapusDetail(id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.','Produk','success');
				dynamic();
				value_filter_produk();
				// coddingan total
				window.apiClient.pengadaanTambah.getTotalHarga().done((res) =>
				{
					if(res >= 1000000){
						$("#status_pengiriman").css("display", "block");
					}else{
							$("#status_pengiriman").css("display", "none");
					}
					$('#total_harga').val(window.apiClient.format.rupiah(res, ''))
					let nilai = terbilang(res);
					$('#total_harga_terbilang').val(nilai)
					$("#status_pengiriman").css("display", "none");
				}).fail((xhr) =>
				{
					console.log($xhr)
				});
			})
			.fail(function($xhr) {
				$.message('Gagal dihapus.','Produk','error');
			}).
			always(function() {

				$('#myModal3').modal('toggle');
			});
	});


	// fungsi cari produk
	$('#cari_produk').click(function() {
		let val_kode = $("#val_kode").val();
		window.apiClient.filter.referensiProdukWhere(null, null, null, null, val_kode).done(function(res) {
			let data_status = 0;
			$.each(res, function(value, key) {
				data_status = 1;
				let harga 	= key.prod_harga_jual;
				let berat 	= key.prod_berat;
				let vendor 	= key.prod_vendor;
				let satuan 	= key.prod_special;
				// $("#span-satuan").text('( '+satuan+' )');
				$("#harga").val(window.apiClient.format.rupiah(''+harga, ''));
				// $("#berat").val(Number(berat));
				var jumlah 	= $('#jumlah').val();
				$('#berat').val(key.prod_berat);
				$('#satuan').val(satuan);
				$('#stok').val(key.prod_stok);
				$('#nama_produk').val(key.prod_nama);
				$('#parent1').val(key.prod_kate_id);

			  $("#parent2").empty();
				window.apiClient.filter.referensiKategoriWhere(key.prod_kate_id,2).done(function(res2) {
					$.each(res2, function(value, val) {
						if(val.kate_id == key.prod_kate_id_2){
							$("#parent2").append("<option selected value='"+val.kate_id+"'>"+val.kate_nama+"</option>");							
						}else{
							$("#parent2").append("<option value='"+val.kate_id+"'>"+val.kate_nama+"</option>");							
						}
				  })
				}).fail(function($xhr) {
					console.log($xhr);
				});

			  $("#parent3").empty();
				window.apiClient.filter.referensiKategoriWhere(key.prod_kate_id_2,3).done(function(res3) {
					$.each(res3, function(value, val) {
						if(val.kate_id == key.prod_kate_id_3){
							$("#parent3").append("<option selected value='"+val.kate_id+"'>"+val.kate_nama+"</option>");							
						}else{
							$("#parent3").append("<option value='"+val.kate_id+"'>"+val.kate_nama+"</option>");							
						}
				  })
				}).fail(function($xhr) {
					console.log($xhr);
				});

				$(".chosen-select").empty();
				$(".chosen-select").append('<option value="" selected>Pilih Produk</option>').trigger("chosen:updated");
				window.apiClient.filter.referensiProdukWhere(null, key.prod_kate_id_2, key.prod_kate_id_3).done(function(res4) {
					$.each(res4, function(value, val) {
						if(val.prod_id == key.prod_id){
							$(".chosen-select").append("<option selected value='"+val.prod_id+"'>"+val.prod_kode+"</option>").trigger("chosen:updated");
						}else{
							$(".chosen-select").append("<option value='"+val.prod_id+"'>"+val.prod_kode+"</option>").trigger("chosen:updated");
						}
			  	})
				}).fail(function($xhr) {
					console.log($xhr);
				});

				// $('#parent2').val(key.prod_kate_id_2);
				// $('#parent3').val(key.prod_kate_id_3);
				harga 			= window.apiClient.format.splitString(harga, '.');
				var total 	= Number(jumlah) * Number(harga);
				let nominal = window.apiClient.format.rupiah(''+total, '');
				$('#total').val(nominal);
				// $('#supp_nama').val(vendor);
	  	});
	  	if(data_status == 0){
	  		alert('Kode Produk tidak ditemukan')
	  	}
		}).fail(function($xhr) {
			console.log($xhr);
		});
	});
	
	// fungsi cari produk
	//  $('#cari_produk').on('change', () =>
	//  {
	// 	let val_kode = $("#val_kode").val();
	// 	window.apiClient.filter.referensiProdukWhere(null, null, null, null, val_kode).done(function(res) {
	// 		let data_status = 0;
	// 		$.each(res, function(value, key) {
	// 			data_status = 1;
	// 			let harga 	= key.prod_harga_beli;
	// 			let berat 	= key.prod_berat;
	// 			let vendor 	= key.prod_vendor;
	// 			$("#harga").val(window.apiClient.format.rupiah(''+harga, ''));
	// 			// $("#berat").val(Number(berat));
	// 			var jumlah 	= $('#jumlah').val();
	// 			$('#berat').val(key.prod_berat);
	// 			$('#stok').val(key.prod_stok);
	// 			$('#nama_produk').val(key.prod_nama);
	// 			$('#parent1').val(key.prod_kate_id);

	// 			window.apiClient.filter.referensiKategoriWhere(key.prod_kate_id,2).done(function(res2) {
	// 				$.each(res2, function(value, val) {
	// 					if(val.kate_id == key.prod_kate_id_2){
	// 						$("#parent2").append("<option selected value='"+val.kate_id+"'>"+val.kate_nama+"</option>");							
	// 					}else{
	// 						$("#parent2").append("<option value='"+val.kate_id+"'>"+val.kate_nama+"</option>");							
	// 					}
	// 			  })
	// 			}).fail(function($xhr) {
	// 				console.log($xhr);
	// 			});

	// 			window.apiClient.filter.referensiKategoriWhere(key.prod_kate_id_2,3).done(function(res3) {
	// 				$.each(res3, function(value, val) {
	// 					if(val.kate_id == key.prod_kate_id_3){
	// 						$("#parent3").append("<option selected value='"+val.kate_id+"'>"+val.kate_nama+"</option>");							
	// 					}else{
	// 						$("#parent3").append("<option value='"+val.kate_id+"'>"+val.kate_nama+"</option>");							
	// 					}
	// 			  })
	// 			}).fail(function($xhr) {
	// 				console.log($xhr);
	// 			});

	// 			$(".chosen-select").empty();
	// 			$(".chosen-select").append('<option value="" selected>Pilih Produk</option>').trigger("chosen:updated");
	// 			window.apiClient.filter.referensiProdukWhere(null, null, key.prod_kate_id_3).done(function(res4) {
	// 				$.each(res4, function(value, val) {
	// 					if(val.prod_id == key.prod_id){
	// 						$(".chosen-select").append("<option selected value='"+val.prod_id+"'>"+val.prod_kode+"</option>").trigger("chosen:updated");
	// 					}else{
	// 						$(".chosen-select").append("<option value='"+val.prod_id+"'>"+val.prod_kode+"</option>").trigger("chosen:updated");
	// 					}
	// 		  	})
	// 			}).fail(function($xhr) {
	// 				console.log($xhr);
	// 			});

	// 			// $('#parent2').val(key.prod_kate_id_2);
	// 			// $('#parent3').val(key.prod_kate_id_3);
	// 			harga 			= window.apiClient.format.splitString(harga, '.');
	// 			var total 	= Number(jumlah) * Number(harga);
	// 			let nominal = window.apiClient.format.rupiah(''+total, '');
	// 			$('#total').val(nominal);
	// 			// $('#supp_nama').val(vendor);
	//   	});
	//   	if(data_status == 0){
	//   		alert('Kode Produk tidak ditemukan')
	//   	}
	// 	}).fail(function($xhr) {
	// 		console.log($xhr);
	// 	});
	// });
});