 $(function() {
 	
 	$('#harga_beli').autoNumeric('init');
 	$('#harga_jual').autoNumeric('init');
 	value_filter_kategori();
 	value_filter_supplier();
 	value_filter_vendor();
	value_new_kode();
	
	function cek_kode(kode=null){
		 window.apiClient.filter.cekKodeProduk(kode).done(function(res) {
		 	if(res == 1){
				$.message('Mohon maaf kode sudah terpakai.','Produk','error');
				$("#kode").val("");
		 	}else{
				$.message('Kode bisa digunakan.','Produk','success');
		 	}
		 }).fail(function($xhr) {
			 console.log($xhr);
		 });

	}

	$('#kode').on('change', () =>
	{
		var kode 	= $('#kode').val()
		cek_kode(kode)
	});
	
	function value_new_kode(){
		window.apiClient.code.getCodeProduk().done(function(res) {
			let kode = res['id'];
			// $("#kode").val(kode);
			$("#kode").val('');
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

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

	function value_filter_supplier(){
		$("#supp_nama").empty();
		// let level = $("#level").val();
		$("#supp_nama").append('<option value="" selected>Pilih Supplier</option>');
		window.apiClient.filter.referensiSupplier().done(function(res) {
				$.each(res, function(value, key) {
					$("#supp_nama").append("<option value='"+key.supp_id+"'>"+key.supp_nama+"</option>");
			  	})
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}


	function value_filter_vendor(){
		$("#filter_vendor").empty();
		// let level = $("#level").val();
		$("#filter_vendor").append('<option value="" selected>Pilih Supplier</option>');
		window.apiClient.filter.referensiSupplier().done(function(res) {
				$.each(res, function(value, key) {
					$("#filter_vendor").append("<option value='"+key.supp_nama+"'>"+key.supp_nama+"</option>");
			  	})
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	function value_filter_rak(){
		$("#val_rak_id").empty();
		// let level = $("#level").val();
		$("#val_rak_id").append('<option value="" selected>Pilih Rak</option>');
		window.apiClient.filter.referensiRak().done(function(res) {
				$.each(res, function(value, key) {
					$("#val_rak_id").append("<option value='"+key.rak_id+"'>"+key.rak_kode+"</option>");
			  	})
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	function value_filter_etalase(){
		$("#val_etal_id").empty();
		$("#val_etal_id").append('<option value="" selected>Pilih Etalase</option>');
		window.apiClient.filter.referensiEtalase().done(function(res) {
				$.each(res, function(value, key) {
					$("#val_etal_id").append("<option value='"+key.etal_id+"'>"+key.etal_kode+"</option>");
			  	})
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	$('#filter_kategori_utama').on('change', () =>
	{
		let kate_id = $("#filter_kategori_utama").val();
		$("#filter_kategori").empty();
		$("#filter_kategori").append('<option value="" selected>Pilih Kategori</option>');
		window.apiClient.filter.referensiKategoriWhere(kate_id,2).done(function(res) {
			$.each(res, function(value, key) {
				$("#filter_kategori").append("<option value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
		  	})
		}).fail(function($xhr) {
			console.log($xhr);
		});
	})

	// $('#satuan').on('change', () =>
	// {
	// 	let special = $("#satuan").val();
	// 	if(special == 'Ya'){
	// 		$("#detail_special").html(''
	// 			+'<div class="row">'
	// 				+'<div class="col-md-6">'
	// 					+'<div class="form-group">'
	// 						+'<label for="exampleInputEmail1">Kategori Special</label>'
	// 						+'<select class="form-control" name="kategori_special" id="kategori_special">'
	// 							+'<option value="1">Warna</option>'
	// 							+'<option value="2">Kunci</option>'
	// 						+'</select>'
	// 					+'</div>'
	// 				+'</div>'
	// 				+'<div class="col-md-6">'
	// 					+'<div class="form-group">'
	// 						+'<label for="exampleInputEmail1">Keterangan</label> <br><div id="detail_detail_special">'

	// 						+'<input type="checkbox" name="keterangan_special[]" value="3">Black &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" class="form-control" placeholder="Min stok" name="min_stok_special[]"> <br>'
	// 						+'<input type="checkbox" name="keterangan_special[]" value="4">White &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" class="form-control" placeholder="Min stok" name="min_stok_special[]">'
	// 						// +'<select class="form-control" name="keterangan_special" id="keterangan_special">'
	// 						// 	+'<option value="3">Black</option>'
	// 						// 	+'<option value="4">White</option>'
	// 						// +'</select>'
	// 					+'</div></div>'
	// 				+'</div>'
	// 			+'</div>'
	// 		+'');
	// 	}else{
	// 		$("#detail_special").html('');
	// 		$("#detail_detail_special").html('');
	// 	}

	// 	// $('.form-control').on('change', '#kategori_special', function(e) {
	// 	$('#kategori_special').on('change', () =>
	// 	{
	// 			let spec_id = $("#kategori_special").val();
	// 			$("#detail_detail_special").html('');
	// 			window.apiClient.code.getDetailSpecial(spec_id).done(function(res) {

	// 					$.each(res, function(value, key) {

	// 						$("#detail_detail_special").append(''
	// 							+'<input type="hidden" name="pros_id[]" value="'+key.pros_id+'">'
	// 							+'<input type="checkbox" name="keterangan_special[]" value="'+key.spec_id+'">'+key.spec_keterangan+' &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" class="form-control" placeholder="Min stok" name="min_stok_special[]"> <br>'
	// 						+'');
	// 					});
	// 				}).fail(function($xhr) {
	// 						console.log($xhr);
	// 				});
	// 	})
	// })

	// $('.form-control').on('change', '#kategori_special', function(e) {
	// // $('#kategori_special').on('change', () =>
	// // {
	// 	console.log('asik');
	// 	let spec_id = $("#kategori_special").val();
	// 	window.apiClient.code.getDetailSpecial(spec_id).done(function(res) {
	// 			console.log(res)
	// 			// $("#detail_special").append(''
	// 			// 		+'<div class="row">'
	// 			// 			+'<div class="col-md-6">'
	// 			// 				+'<div class="form-group">'
	// 			// 					+'<label for="exampleInputEmail1">Kategori Special</label>'
	// 			// 					+'<select class="form-control" name="kategori_special" id="kategori_special">'
	// 			// 						+'<option value="1">Warna</option>'
	// 			// 						+'<option value="2">Kunci</option>'
	// 			// 					+'</select>'
	// 			// 				+'</div>'
	// 			// 			+'</div>'
	// 			// 		+'<div class="col-md-6">'
	// 			// 			+'<div class="form-group">'
	// 			// 					+'<label for="exampleInputEmail1">Keterangan</label> <br>'
	// 			// 	+'<div id="detail_detail_special"></div>');
	// 			// $.each(res, function(value, key) {

	// 			// 	$("#detail_detail_special").append(''
	// 			// 					+'<input type="hidden" name="pros_id[]" value="'+key.pros_id+'">'
	// 			// 					+'<input checked type="checkbox" name="keterangan_special[]" value="'+key.spec_id+'">'+key.spec_keterangan+' &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" value="'+key.pros_min_stok+'" class="form-control" placeholder="Min stok" name="min_stok_special[]"> <br>'
	// 			// 					// +'<input type="checkbox" name="keterangan_special[]" value="4">White &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" class="form-control" placeholder="Min stok" name="min_stok_special[]">'
	// 			// 					// +'<select class="form-control" name="keterangan_special" id="keterangan_special">'
	// 			// 					// 	+'<option value="3">Black</option>'
	// 			// 					// 	+'<option value="4">White</option>'
	// 			// 					// +'</select>'
	// 			// 	+'');
	// 			// });
	// 			// $("#detail_special").append(''
	// 			// 				+'</div>'
	// 			// 		+'</div>'
	// 			// 	+'</div>'
	// 			// +'');
	// 		}).fail(function($xhr) {
	// 				console.log($xhr);
	// 		});
	// 	// if(special == 'Ya'){
	// 	// 	$("#detail_special").html(''
	// 	// 				+'<div class="form-group">'
	// 	// 					+'<label for="exampleInputEmail1">Keterangan</label> <br>'
	// 	// 					+'<input type="checkbox" name="keterangan_special[]" value="3">Black &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" class="form-control" placeholder="Min stok" name="min_stok_special[]"> <br>'
	// 	// 					+'<input type="checkbox" name="keterangan_special[]" value="4">White &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" class="form-control" placeholder="Min stok" name="min_stok_special[]">'
	// 	// 					// +'<select class="form-control" name="keterangan_special" id="keterangan_special">'
	// 	// 					// 	+'<option value="3">Black</option>'
	// 	// 					// 	+'<option value="4">White</option>'
	// 	// 					// +'</select>'
	// 	// 				+'</div>'
	// 	// 			+'</div>'
	// 	// 		+'</div>'
	// 	// 	+'');
	// 	// }else{
	// 	// 	$("#detail_special").html('');
	// 	// }
	// })

	$('#filter_kategori').on('change', () =>
	{
		let kate_id = $("#filter_kategori").val();
		$("#filter_sub_kategori").empty();
		$("#filter_sub_kategori").append('<option value="" selected>Pilih Sub Kategori</option>');
		window.apiClient.filter.referensiKategoriWhere(kate_id,3).done(function(res) {
			$.each(res, function(value, key) {
				$("#filter_sub_kategori").append("<option value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
		  	})
		}).fail(function($xhr) {
			console.log($xhr);
		});
	})

	$('#parent1').on('change', () =>
	{
		let parent1 = $("#parent1").val();
		let level = $("#level").val();
		$("#parent2").empty();
		$("#parent2").append('<option value="" selected>Pilih Kategori</option>');
		window.apiClient.filter.referensiKategoriWhere(parent1,2).done(function(res) {
				$.each(res, function(value, key) {
					$("#parent2").append("<option value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
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
	})

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}


	var table4 = $('#advanced-usage').DataTable({
		"scrollX": true,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": "<?= base_url()?>referensi/produk/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "prod_kode" },
			{ "data": "kate_nama_1" },
			// { "data": "kate_nama_2" },
			// { "data": "kate_nama_3" },
			{ "data": "prod_nama" },
			// { "data": "supp_nama" },
			// {
			// 	data: "prod_min_stok", render: function(data, type, full, meta)
			// 	{
			// 		return '<p style="text-align:right">'+data+'</p>'
			// 	}
			// },
			// {
			// 	data: "prod_max_stok", render: function(data, type, full, meta)
			// 	{
			// 		return '<p style="text-align:right">'+data+'</p>'
			// 	}
			// },
			{
				"data": "prod_stok", render: function(data, type, full, meta)
				{
					if(full.prod_special == 'Ya'){
						return '<button style="color: blue;background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;outline:none;float: right;text-align: right;" class="stok-button" data-toggle="modal" data-target="#splash-11" data-options="splash-11 splash-ef-14" value="'+full.prod_id+'">'+data+'</button>';						
					}else{
						return '<p style="text-align:right">'+data+'</p>'
					}
				}
			},
			{
				data: "prod_harga_jual", render: function(data, type, full, meta)
				{
					let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
					return '<p style="text-align:right">'+nominal+'</p>'
				}
			},
			// {
			// 	"data": "prod_gambar", render: function(data, type, full, meta)
			// 	{
			// 		return '<button class="btn btn-sm btn-success gambar-button" data-toggle="modal" data-target="#splash-9" data-options="splash-9 splash-ef-14" value="'+data+'"><i class="fa fa-search"></i> <span></span></button>';						
			// 	}
			// },
			{ "data": "prod_berat" },
			{ "data": "prod_special" },
		],
		"aoColumnDefs": [
		  // { 'bSortable': false, 'aTargets': [ "no-sort" ] }
		  // { 'bSortable': false, 'aTargets': [ [1, "DESC"] ] }
		],
	});
	

	var colvis = new $.fn.dataTable.ColVis(table4);

	$(colvis.button()).insertAfter('#colVis');
	$(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button');

	var tt = new $.fn.dataTable.TableTools(table4, {
		sRowSelect: 'single',
		"aButtons": [
			// 'copy',
			// 'print', {
			// 	'sExtends': 'collection',
			// 	'sButtonText': 'Save',
			// 	'aButtons': ['csv', 'xls', 'pdf']
			// }
		],
		"sSwfPath": "<?php echo base_url();?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
	});

	$(tt.fnContainer()).insertAfter('#tableTools');
	//*initialize responsive datatable

	function dynamic(val_kategori_utama=null, val_kategori=null, val_sub_kategori=null, val_rak=null, val_etalase=null, val_vendor=null, val_status_stok=null){
		//initialize responsive datatable
	
		var table4 = $('#advanced-usage').DataTable({
			"scrollX": true,
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?= base_url()?>referensi/produk/ajax_data/",
				"data": {
					val_kategori_utama: val_kategori_utama,
					val_kategori: val_kategori,
					val_sub_kategori: val_sub_kategori,
					val_rak: val_rak,
					val_etalase: val_etalase,
					val_vendor: val_vendor,
					val_status_stok: val_status_stok
				},
				"type": 'POST'
			},
			"columns": [
			{ "data": "prod_kode" },
			{ "data": "kate_nama_1" },
			// { "data": "kate_nama_2" },
			// { "data": "kate_nama_3" },
			{ "data": "prod_nama" },
			{
				"data": "prod_stok", render: function(data, type, full, meta)
				{
					if(full.prod_special == 'Ya'){
						return '<button style="color: blue;background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;outline:none;float: right;text-align: right;" class="stok-button" data-toggle="modal" data-target="#splash-11" data-options="splash-11 splash-ef-14" value="'+full.prod_id+'">'+data+'</button>';						
					}else{
						return '<p style="text-align:right">'+data+'</p>'
					}
				}
			},
			{
				data: "prod_harga_jual", render: function(data, type, full, meta)
				{
					let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
					return '<p style="text-align:right">'+nominal+'</p>'
				}
			},
			{ "data": "prod_berat" },
			{ "data": "prod_special" },
		],
		});


		var colvis = new $.fn.dataTable.ColVis(table4);

		$(colvis.button()).insertAfter('#colVis');
		$(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button');

		var tt = new $.fn.dataTable.TableTools(table4, {
			sRowSelect: 'single',
			"aButtons": [
				// 'copy',
				// 'print', {
				// 	'sExtends': 'collection',
				// 	'sButtonText': 'Save',
				// 	'aButtons': ['csv', 'xls', 'pdf']
				// }
			],
			"sSwfPath": "<?php echo base_url();?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
		});

		$(tt.fnContainer()).insertAfter('#tableTools');
	}

	$('#imageUploadForm').submit(function(evt) {
		evt.preventDefault();

		var formData = new FormData(this);
		let id 			= $('#imageUploadForm input[name=id]').val();
		if(id == 0) {
			$.ajax({
				type: 'POST',
				url:'<?= base_url() ?>referensi/produk/insert',
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
				success: function(data) {
					$("#advanced-usage").dataTable().fnDestroy();
					$.message('Berhasil ditambahkan.','Produk','success');
					dynamic();
					$('#imageUploadForm input[name=id]').val(0);
					$('#parent1').val('');
					$('#parent2').val('');
					$('#parent3').val('');
					$('#nama').val('');
					$('#harga_beli').val('');
					$('#harga_jual').val('');
					$('#berat').val('');
					$('#status').val('');
					$('#min_stok').val('');
					$('#max_stok').val('');
					$('#tahun').val('');
					$('#facebook').val('');
					$('#bukalapak').val('');
					$('#tokopedia').val('');
					$('#shopee').val('');
					$('#file').val('');
					$('#supp_nama').val('');
					$('#kode').val('');
					$('#special').val('');
					$('#link_referensi').val('');
					window.apiClient.code.getCodeProduk().done(function(res) {
						let kode = res['id'];
						$("#kode").val(kode);
					}).fail(function($xhr) {
						console.log($xhr);
					});
					$('#splash').modal('toggle');
				},
				error: function(data) {
					$.message('Gagal ditambahkan.','Produk','error');
					$('#splash').modal('toggle');
				}
			});
		}else{
			$.ajax({
				type: 'POST',
				url:'<?= base_url() ?>referensi/produk/update',
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
				success: function(data) {
					$("#advanced-usage").dataTable().fnDestroy();
					$.message('Berhasil ditambahkan.','Produk','success');
					dynamic();
					$('#imageUploadForm input[name=id]').val(0);
					$('#parent1').val('');
					$('#parent2').val('');
					$('#parent3').val('');
					$('#nama').val('');
					$('#harga_beli').val('');
					$('#harga_jual').val('');
					$('#berat').val('');
					$('#status').val('');
					$('#min_stok').val('');
					$('#max_stok').val('');
					$('#tahun').val('');
					$('#facebook').val('');
					$('#bukalapak').val('');
					$('#tokopedia').val('');
					$('#shopee').val('');
					$('#kode').val('');
					$('#file').val('');
					$('#special').val('');
					$('#link_referensi').val('');
					window.apiClient.code.getCodeProduk().done(function(res) {
						let kode = res['id'];
						$("#kode").val(kode);
					}).fail(function($xhr) {
						console.log($xhr);
					});
					$('#splash').modal('toggle');
				},
				error: function(data) {
					$.message('Gagal ditambahkan.','Produk','error');
					$('#splash').modal('toggle');
				}
			});
		}
	});


	// fungsi simpan 
	$('#form').submit(function(ev) {
		ev.preventDefault();

		let id 			= $('#form input[name=id]').val();
		let parent1 	= $('#parent1').val();
		let parent2 	= $('#parent2').val();
		let parent3 	= $('#parent3').val();
		let nama 		= $('#nama').val();
		let harga_beli 	= $('#harga_beli').val();
		harga_beli 		= window.apiClient.format.splitString(harga_beli, '.');
		let harga_jual 	= $('#harga_jual').val();
		harga_jual 		= window.apiClient.format.splitString(harga_jual, '.');
		let berat 		= $('#berat').val();
		let status 		= $('#status').val();
		let min_stok 	= $('#min_stok').val();
		min_stok = 0
		let max_stok 	= $('#max_stok').val();
		max_stok = 0
		let tahun 		= $('#tahun').val();
		let facebook 	= $('#facebook').val();
		let tokopedia 	= $('#tokopedia').val();
		let bukalapak 	= $('#bukalapak').val();
		let shopee 		= $('#shopee').val();
		let supp_nama 		= $('#supp_nama').val();

		let ajax = null;
		if(id == 0) {
			ajax = window.apiClient.referensiProduk.insert(parent1, parent2, parent3, nama, harga_beli, harga_jual, berat, status, min_stok, max_stok, tahun, facebook, tokopedia, bukalapak, shopee)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','Produk','success');
				dynamic();
				$('#form input[name=id]').val(0);
				$('#parent1').val('');
				$('#parent2').val('');
				$('#parent3').val('');
				$('#nama').val('');
				$('#harga_beli').val('');
				$('#harga_jual').val('');
				$('#berat').val('');
				$('#status').val('');
				$('#min_stok').val('');
				$('#max_stok').val('');
				$('#tahun').val('');
				$('#facebook').val('');
				$('#bukalapak').val('');
				$('#tokopedia').val('');
				$('#shopee').val('');
				$('#supp_nama').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Produk','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
		else {
			ajax = window.apiClient.referensiProduk.update(id, parent1, parent2, parent3, nama, harga_beli, harga_jual, berat, status, min_stok, max_stok, tahun, facebook, tokopedia, bukalapak, shopee, supp_nama)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.','Produk','success');
				dynamic();
				$('#form input[name=id]').val(0);
				$('#parent1').val('');
				$('#parent2').val('');
				$('#parent3').val('');
				$('#nama').val('');
				$('#harga_beli').val('');
				$('#harga_jual').val('');
				$('#berat').val('');
				$('#status').val('');
				$('#min_stok').val('');
				$('#max_stok').val('');
				$('#tahun').val('');
				$('#facebook').val('');
				$('#bukalapak').val('');
				$('#tokopedia').val('');
				$('#shopee').val('');
				$('#supp_nama').val('');

			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Produk','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
	});

	// fungsi simpan rak 
	$('#form-rak').submit(function(ev) {
		ev.preventDefault();

		let id 			= $('#form-rak input[name=rak_prod_id]').val();
		let rak_id 	= $('#val_rak_id').val();
		let rak_jumlah 	= $('#rak_jumlah').val();

		let ajax = null;
		ajax = window.apiClient.referensiProduk.ubahRak(id, rak_id, rak_jumlah)
		.done(function(data) {
			$("#advanced-usage").dataTable().fnDestroy();
			$.message('Berhasil diubah.','Produk','success');
			dynamic();
			$('#form-rak input[name=rak_prod_id]').val(0);
			$('#val_rak_id').val('');
			$('#rak_jumlah').val('');
		})
		.fail(function($xhr) {
			$.message('Gagal diubah.','Produk','error');
		}).
		always(function() {
			$('#splash-6').modal('toggle');
		});
	});

	// fungsi simpan etalase 
	$('#form-etalase').submit(function(ev) {
		ev.preventDefault();

		let id 			= $('#form-etalase input[name=etal_prod_id]').val();
		let etal_id 	= $('#val_etal_id').val();
		let etal_jumlah 	= $('#etal_jumlah').val();

		let ajax = null;
		ajax = window.apiClient.referensiProduk.ubahEtalase(id, etal_id, etal_jumlah)
		.done(function(data) {
			$("#advanced-usage").dataTable().fnDestroy();
			$.message('Berhasil diubah.','Produk','success');
			dynamic();
			$('#form-etalase input[name=etal_prod_id]').val(0);
			$('#val_etal_id').val('');
			$('#etal_jumlah').val('');
		})
		.fail(function($xhr) {
			$.message('Gagal diubah.','Produk','error');
		}).
		always(function() {
			$('#splash-7').modal('toggle');
		});
	});

	
	// fungsi ubah
	$('#advanced-usage tbody').on('click', '.edit-button', function(ev) {
		ev.preventDefault();

		var ids = $(this).val();
		var res = ids.split("|");
		console.log(res);
		$('#imageUploadForm input[name=id]').val(res[0]);
		$('#myModalLabel').html('Ubah Produk');
		$('#id').val(res[0]);
		$('#parent1').val(res[1]);
		$('#nama').val(res[2]);
		$('#harga_beli').val(res[3]);
		$('#harga_jual').val(res[4]);
		$('#berat').val(res[5]);
		$('#min_stok').val(res[6]);
		$('#max_stok').val(res[7]);
		$('#tahun').val(res[8]);
		$('#facebook').val(res[9]);
		$('#tokopedia').val(res[10]);
		$('#bukalapak').val(res[11]);
		$('#shopee').val(res[12]);
		$('#supp_nama').val(res[15]);
		$('#kode').val(res[16]);
		$('#special').val(res[17]);
		$('#link_referensi').val(res[18]);
		$("#detail_special").html('');
		$("#detail_detail_special").html('');
		if(res[17] == 'Ya'){
			window.apiClient.code.getSpecial(res[0]).done(function(res) {
				console.log(res)
				$("#detail_special").append(''
						+'<div class="row">'
							+'<div class="col-md-6">'
								+'<div class="form-group">'
									+'<label for="exampleInputEmail1">Kategori Special</label>'
									+'<select class="form-control" name="kategori_special" id="kategori_special">'
										+'<option value="1">Warna</option>'
										+'<option value="2">Kunci</option>'
									+'</select>'
								+'</div>'
							+'</div>'
						+'<div class="col-md-6">'
							+'<div class="form-group">'
									+'<label for="exampleInputEmail1">Keterangan</label> <br>'
					+'<div id="detail_detail_special"></div>');
				$.each(res, function(value, key) {

					$("#detail_detail_special").append(''
									+'<input type="hidden" name="pros_id[]" value="'+key.pros_id+'">'
									+'<input checked type="checkbox" name="keterangan_special[]" value="'+key.spec_id+'">'+key.spec_keterangan+' &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" value="'+key.pros_min_stok+'" class="form-control" placeholder="Min stok" name="min_stok_special[]"> <br>'
									// +'<input type="checkbox" name="keterangan_special[]" value="4">White &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" class="form-control" placeholder="Min stok" name="min_stok_special[]">'
									// +'<select class="form-control" name="keterangan_special" id="keterangan_special">'
									// 	+'<option value="3">Black</option>'
									// 	+'<option value="4">White</option>'
									// +'</select>'
					+'');
				});
				$("#detail_special").append(''
								+'</div>'
						+'</div>'
					+'</div>'
				+'');
			}).fail(function($xhr) {
					console.log($xhr);
			});
			
		}else{
			$("#detail_special").html('');
			$("#detail_detail_special").html('');
		}
		
		let parent1 = res[1];
		let level = $("#level").val();
		$("#parent2").empty();
		$("#parent2").append('<option value="" selected>Pilih Kategori</option>');
		window.apiClient.filter.referensiKategoriWhere(parent1,2).done(function(result) {
				$.each(result, function(value, key) {
					if(key.kate_id == res[13]){
						$("#parent2").append("<option selected value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
					}else{
						$("#parent2").append("<option value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
					}
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});

		let parent2 = res[13];
		$("#parent3").empty();
		$("#parent3").append('<option value="" selected>Pilih Kategori</option>');
		window.apiClient.filter.referensiKategoriWhere(parent2,3).done(function(result) {
				$.each(result, function(value, key) {
					if(key.kate_id == res[14]){
						$("#parent3").append("<option selected value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
					}else{
						$("#parent3").append("<option value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
					}
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	});

	// fungsi ubah rak
	$('#advanced-usage tbody').on('click', '.rak-button', function(ev) {
		ev.preventDefault();
		var ids = $(this).val();
		var res = ids.split("|");
		console.log(res);
		value_filter_rak();
		$('#form input[name=rak_prod_id]').val(res[0]);
		$('#myModalLabel').html('Ubah Rak Produk');
		$('#rak_prod_id').val(res[0]);
		$('#val_rak_id').val(res[1]);
		$('#rak_jumlah').val(res[2]);
	});

	// fungsi ubah etalase
	$('#advanced-usage tbody').on('click', '.etalase-button', function(ev) {
		ev.preventDefault();
		var ids = $(this).val();
		var res = ids.split("|");
		console.log(res);
		value_filter_etalase();
		$('#form input[name=etal_prod_id]').val(res[0]);
		$('#myModalLabel').html('Ubah Etalase Produk');
		$('#etal_prod_id').val(res[0]);
		$('#val_etal_id').val(res[1]);
		$('#etal_jumlah').val(res[2]);
	});

	// fungsi gambar
	$('#advanced-usage tbody').on('click', '.gambar-button', function(ev) {
		ev.preventDefault();
		var ids = $(this).val();
		var res = ids.split("|");
		console.log('res');
		// $('#form input[name=rak_prod_id]').val(res[0]);
		$("#detail_gambar").attr("src",'<?php echo base_url();?>gambar/'+res[0]);
		$('#myModalLabel').html('Lihat Gambar');
	});

	// fungsi min stok
	$('#advanced-usage tbody').on('click', '.min-stok-button', function(ev) {
		ev.preventDefault();
		var ids = $(this).val();
		var ress = ids.split("|");
		$("#detail_min_stok").html('');
		window.apiClient.code.getSpecial(ress[0]).done(function(res) {
			$.each(res, function(value, key) {
				$("#detail_min_stok").append('<div class="row">'
					+'<div class="col-md-6">'
						+'<div class="form-group">'
							+'<label>Warna</label>'
							+'<input class="form-control" name="" id="spec_keterangan" readonly value="'+key.spec_keterangan+'">'
						+'</div>'
					+'</div>'
					+'<div class="col-md-6">'
						+'<div class="form-group">'
							+'<label>Min Stok</label>'
							+'<input class="form-control" name="" id="pros_min_stok" readonly value="'+key.pros_min_stok+'">'
						+'</div>'
					+'</div>'
				+'</div>');
			});
		}).fail(function($xhr) {
			console.log($xhr);
		});
		$('#myModalLabel').html('Lihat Min Stok');
	});

	// fungsi stok
	$('#advanced-usage tbody').on('click', '.stok-button', function(ev) {
		ev.preventDefault();
		var ids = $(this).val();
		var ress = ids.split("|");
		$("#detail_stok").empty();
		window.apiClient.code.getSpecial(ress[0]).done(function(res) {
			$.each(res, function(value, key) {
				$("#detail_stok").append('<div class="row">'
					+'<div class="col-md-4">'
						+'<div class="form-group">'
							+'<label>Warna</label>'
							+'<input class="form-control" name="" id="spec_keterangan" readonly value="'+key.spec_keterangan+'">'
						+'</div>'
					+'</div>'
					+'<div class="col-md-4">'
						+'<div class="form-group">'
							+'<label>Min Stok</label>'
							+'<input class="form-control" name="" id="pros_min_stok" readonly value="'+key.pros_min_stok+'">'
						+'</div>'
					+'</div>'
					+'<div class="col-md-4">'
						+'<div class="form-group">'
							+'<label>Stok saat ini</label>'
							+'<input class="form-control" name="" id="pros_value" readonly value="'+key.pros_value+'">'
						+'</div>'
					+'</div>'
				+'</div>');
			});
		}).fail(function($xhr) {
			console.log($xhr);
		});
		$('#myModalLabel').html('Lihat Min Stok');
	});

	// fungsi hapus
	$('#advanced-usage tbody').on('click', '.delete-button', function(ev) {
		var ids = $(this).val();
		$("#idHapus").val(ids);
		$("#labelHapus").text('Form Hapus');
		$("#contentHapus").text('Apakah anda yakin akan menghapus data ini?');
		$('#myModal3').modal('toggle');
	});

	// fungsi hapus jika ya
	$('#clickHapus').click(function() {
		let id = $("#idHapus").val();
		ajax = window.apiClient.referensiProduk.delete(id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.','Produk','success');
				dynamic();
				
			})
			.fail(function($xhr) {
				$.message('Gagal dihapus.','Produk','error');
			}).
			always(function() {
				$('#myModal3').modal('toggle');
			});
	});

	$('#filter-cari').click(function() {
		let val_kategori_utama = $("#filter_kategori_utama").val();
		let val_kategori = $("#filter_kategori").val();
		let val_sub_kategori = $("#filter_sub_kategori").val();
		let val_rak = $("#filter_rak").val();
		let val_etalase = $("#filter_etalase").val();
		let val_vendor = $("#filter_vendor").val();
		let val_status_stok = $("#filter_status_stok").val();

		$("#advanced-usage").dataTable().fnDestroy();
		$.message('Pencarian Berhasil.','Produk','success');
		dynamic(val_kategori_utama, val_kategori, val_sub_kategori, val_rak, val_etalase, val_vendor, val_status_stok);
	});

	// fungsi tambah jika ya
	$('#clickTambah').click(function() {
		$('#myModalLabel').html('Form Produk');
		$('#imageUploadForm input[name=id]').val(0);
		$('#parent1').val('');
		$('#parent2').val('');
		$('#parent3').val('');
		$('#nama').val('');
		$('#harga_beli').val('');
		$('#harga_jual').val('');
		$('#berat').val(1);
		$('#status').val('');
		$('#min_stok').val('');
		$('#max_stok').val('');
		$('#tahun').val('');
		$('#facebook').val('');
		$('#bukalapak').val('');
		$('#tokopedia').val('');
		$('#shopee').val('');
		$('#kode').val('');
		$('#file').val('');
		window.apiClient.code.getCodeProduk().done(function(res) {
			let kode = res['id'];
			// $("#kode").val(kode);
			$("#kode").val('');
		}).fail(function($xhr) {
			console.log($xhr);
		});
	});
});

function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}