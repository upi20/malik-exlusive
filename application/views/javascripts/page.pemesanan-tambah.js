 $(function() {


 	$('#harga').autoNumeric('init');

 	function total_harga(id_pemesanan){
 		window.apiClient.pemesanan.getTotalHarga(id_pemesanan).done(function(res) {
 			$("#total_harga_terbilang").val(terbilang(res.value));
 			$("#total_harga").val(window.apiClient.format.rupiah(res.value, ''));
		}).fail(function($xhr) {
			console.log($xhr);
		});
 	}

 	function value_code(){
		window.apiClient.code.getCodePemesanan().done(function(res) {
			$("#code").val(res.id);
			total_harga(res.id);
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	function value_code_detail(){
		window.apiClient.code.getCodePemesananDetail().done(function(res) {
			$("#id_detail").val(res.id);
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

 	value_code_detail();
 	value_code();
 	value_filter_supplier();
 	total_harga($("#code").val());

	function value_filter_supplier(){
		window.apiClient.filter.referensiSupplier().done(function(res) {
				$.each(res, function(value, key) {
					$("#id_supplier").append("<option value='"+key.id+"'>"+key.nama+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	value_filter_kategori();

	function value_filter_kategori(){
		window.apiClient.filter.referensiKategori().done(function(res) {
				$.each(res, function(value, key) {
					$("#id_kategori").append("<option value='"+key.id+"'>"+key.nama+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	value_filter_barang();

	function value_filter_barang(){
		window.apiClient.filter.referensiBarang().done(function(res) {
				$.each(res, function(value, key) {
					$("#id_barang").append("<option value='"+key.id+"'>"+key.nama+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
				"url": "<?= base_url()?>pemesanan/tambah/ajax_data_detail/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
				{ "data": "id_supplier" },
				{ "data": "id_barang" },
				{
					data: "harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				{ "data": "satuan" },
				{ "data": "jumlah" },
				{
					data: "total", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
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
				"url": "<?= base_url()?>pemesanan/tambah/ajax_data_detail/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
				{ "data": "id_supplier" },
				{ "data": "id_barang" },
				{
					data: "harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				{ "data": "satuan" },
				{ "data": "jumlah" },
				{
					data: "total", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
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
		value_code_detail();
		let id_detail = $("#id_detail").val();
		let id = $('#code').val();
		let id_supplier = $('#id_supplier').val();
		let id_barang = $('#id_barang').val();
		let harga = $('#harga').val();
		harga = window.apiClient.format.splitString(harga, '.');
		let satuan = $('#satuan').val();
		let jumlah = $('#jumlah').val();
		
		let ajax = null;
		ajax = window.apiClient.pemesanan.insertDetail(id_detail, id, id_supplier, id_barang, harga, satuan, jumlah)
		.done(function(data) {
			$("#advanced-usage").dataTable().fnDestroy();
			$.message('Berhasil ditambahkan.','Pemesanan Detail','success');
			dynamic();
			$('#id_detail').val('');
			value_code_detail();
			$('#id_supplier').val('');
			$('#id_barang').val('');
			$('#harga').val('');
			$('#satuan').val('');
			$('#jumlah').val('');
			total_harga(id);
		})
		.fail(function($xhr) {
			$.message('Gagal ditambahkan.','Pemesanan Detail','success');
		}).
		always(function() {
			$('#splash').modal('toggle');
		});
	});

	// fungsi simpan 
	$('#form_head').submit(function(ev) {
		ev.preventDefault();
		let id = $('#code').val();
		let nama = $('#nama').val();
		let no_telpon = $('#no_telpon').val();
		let alamat = $('#alamat').val();
		let tanggal = $('#tanggal').val();
		let total_harga = $('#total_harga').val();
		let dibayar = $('#dibayar').val();
		let sisa = parseInt(total_harga);
		
		let ajax = null;
		ajax = window.apiClient.pemesanan.insertHead(id, nama, no_telpon, alamat, tanggal, total_harga, dibayar, sisa)
		.done(function(data) {
			$("#advanced-usage").dataTable().fnDestroy();
			$.message('Berhasil ditambahkan.','Pemesanan','success');
			dynamic();
			$('#id_detail').val('');
			value_code_detail();
			$('#id_pemesanan').val('');
			value_code();
			$('#nama').val('');
			$('#no_telpon').val('');
			$('#alamat').val('');
			$('#tanggal').val('');
			$('#total_harga').val('');
			$('#dibayar').val('');
			window.location.href = "<?php echo base_url();?>pemesanan/data";
		})
		.fail(function($xhr) {
			$.message('Gagal ditambahkan.','Pemesanan','success');
		}).
		always(function() {
			$('#splash').modal('toggle');
		});
	});

	// function penyebut(nilai) {
	// 	// nilai = abs(nilai);
	// 	// nilai = Math.abs(nilai);
	// 	// huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	// 	huruf = [
	// 		"", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"
	// 	];
	// 	temp = "";
	// 	if (nilai < 12) {
	// 		temp = " "+ huruf[nilai];
	// 	} else if (nilai <20) {
	// 		temp = penyebut(nilai - 10)+ " belas";
	// 	} else if (nilai < 100) {
	// 		temp = penyebut(nilai/10)+" puluh"+ penyebut(nilai % 10);
	// 	} else if (nilai < 200) {
	// 		temp = " seratus" + penyebut(nilai - 100);
	// 	} else if (nilai < 1000) {
	// 		temp = penyebut(nilai/100) + " ratus" + penyebut(nilai % 100);
	// 	} else if (nilai < 2000) {
	// 		temp = " seribu" + penyebut(nilai - 1000);
	// 	} else if (nilai < 1000000) {
	// 		temp = penyebut(nilai/1000) + " ribu" + penyebut(nilai % 1000);
	// 	} else if (nilai < 1000000000) {
	// 		temp = penyebut(nilai/1000000) + " juta" + penyebut(nilai % 1000000);
	// 	} else if (nilai < 1000000000000) {
	// 		temp = penyebut(nilai/1000000000) + " milyar" + penyebut(fmod(nilai,1000000000));
	// 	} else if (nilai < 1000000000000000) {
	// 		temp = penyebut(nilai/1000000000000) + " trilyun" + penyebut(fmod(nilai,1000000000000));
	// 	}     
	// 	console.log(nilai);
	// 	console.log(temp);
	// 	return temp;
	// }

	function terbilang(nilai){
	    var bilangan = nilai;
	    console.log(bilangan);
	    var kalimat  = "";
	    var angka    = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
	    var kata     = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
	    var tingkat  = new Array('','Ribu','Juta','Milyar','Triliun');
	    var panjang_bilangan = bilangan.length;
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
 
	// function terbilang(nilai) {
	// 	let hasil=0;
	// 	if(nilai<0) {
	// 		hasil = "minus ". penyebut(nilai);
	// 	} else {
	// 		hasil = penyebut(nilai);
	// 	}     		
	// 	return hasil;
	// }
});