 $(function() {
 	
 	$('#harga_beli').autoNumeric('init');
 	$('#harga_jual').autoNumeric('init');
 	value_filter_kategori();

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
		// let level = $("#level").val();
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
		// "processing": true,
    // "serverSide": true,
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
			{ "data": "kate_nama_2" },
			{ "data": "kate_nama_3" },
			{ "data": "prod_nama" },
			{
				data: "prod_min_stok", render: function(data, type, full, meta)
				{
					return '<p style="text-align:right">'+data+'</p>'
				}
			},
			{
				data: "prod_max_stok", render: function(data, type, full, meta)
				{
					return '<p style="text-align:right">'+data+'</p>'
				}
			},
			{
				data: "prod_stok", render: function(data, type, full, meta)
				{
					return '<p style="text-align:right">'+data+'</p>'
				}
			},
			{
				data: "prod_selisih_stok", render: function(data, type, full, meta)
				{
					return '<p style="text-align:right">'+data+'</p>'
				}
			},
			{ "data": "prod_tahun" },
			{
				data: "prod_harga_beli", render: function(data, type, full, meta)
				{
					let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
					return '<p style="text-align:right">'+nominal+'</p>'
				}
			},
			{
				data: "prod_harga_jual", render: function(data, type, full, meta)
				{
					let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
					return '<p style="text-align:right">'+nominal+'</p>'
				}
			},
			{
				"data": "prod_gambar", render: function(data, type, full, meta)
				{
					return '<button class="btn btn-sm btn-success gambar-button" data-toggle="modal" data-target="#splash-9" data-options="splash-9 splash-ef-14" value="'+data+'"><i class="fa fa-search"></i> <span></span></button>';						
				}
			},
			{
				data: "prod_berat", render: function(data, type, full, meta)
				{
					return '<p style="text-align:right">'+data+'</p>'
				}
			},
			{ "data": "prod_special" },
			// { "data": "prod_tokopedia" },
			// { "data": "prod_bukalapak" },
			// { "data": "prod_shopee" },
			// {
			// 	"data": "prod_rak_jumlah", render: function(data, type, full, meta)
			// 	{
			// 		if(data > 0){
			// 			return '<button class="btn btn-sm btn-primary rak-button" data-toggle="modal" data-target="#splash-6" data-options="splash-6 splash-ef-14" value="'+full.prod_id+'|'+full.prod_rak_id+'|'+full.prod_rak_jumlah+'"><span>'+full.rak_kode+' - '+data+'</span></button>';						
			// 		}else{
			// 			return '<button class="btn btn-sm btn-primary rak-button" data-toggle="modal" data-target="#splash-6" data-options="splash-6 splash-ef-14" value="'+full.prod_id+'|'+full.prod_rak_id+'|'+full.prod_rak_jumlah+'"><span>-</span></button>';						
			// 		}
			// 	}
			// },
			// {
			// 	"data": "prod_etal_jumlah", render: function(data, type, full, meta)
			// 	{
			// 		if(data > 0){
			// 			return '<button class="btn btn-sm btn-primary  etalase-button" data-toggle="modal" data-target="#splash-7" data-options="splash-7 splash-ef-14" value="'+full.prod_id+'|'+full.prod_etal_id+'|'+full.prod_etal_jumlah+'"><span>'+full.etal_kode+' - '+data+'</span></button>';						
			// 		}else{
			// 			return '<button class="btn btn-sm btn-primary etalase-button" data-toggle="modal" data-target="#splash-7" data-options="splash-7 splash-ef-14" value="'+full.prod_id+'|'+full.prod_etal_id+'|'+full.prod_etal_jumlah+'"><span>-</span></button>';						
			// 		}
			// 	}
			// },
			{
				"data": "prod_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.prod_id+'|'+full.kate_id_1+'|'+full.prod_nama+'|'+full.prod_harga_beli+'|'+full.prod_harga_jual+'|'+full.prod_berat+'|'+full.prod_min_stok+'|'+full.prod_max_stok+'|'+full.prod_tahun+'|'+full.prod_facebook+'|'+full.prod_tokopedia+'|'+full.prod_bukalapak+'|'+full.prod_shopee+'|'+full.prod_kate_id_2+'|'+full.prod_kate_id_3+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
								+'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
							+'</div>';
				}
			}
		],
		"aoColumnDefs": [
		  // { 'bSortable': false, 'aTargets': [ "no-sort" ] }
		  // { 'bSortable': false, 'aTargets': [ [1, "DESC"] ] }
		],
	  "aaSorting": [[ 8, "asc" ]],
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

	function dynamic(val_kategori_utama=null, val_kategori=null, val_sub_kategori=null, val_rak=null, val_etalase=null){
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
					val_etalase: val_etalase
				},
				"type": 'POST'
			},
			"columns": [
				{ "data": "prod_kode" },
				{ "data": "kate_nama_1" },
				{ "data": "kate_nama_2" },
				{ "data": "kate_nama_3" },
				{ "data": "prod_nama" },
				{ "data": "prod_min_stok" },
				{ "data": "prod_max_stok" },
				{ "data": "prod_stok" },
				{ "data": "prod_selisih_stok" },
				{ "data": "prod_tahun" },
				{
					data: "prod_harga_beli", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
						return '<p style="text-align:right">'+nominal+'</p>'
					}
				},
				{
					data: "prod_harga_jual", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
						return '<p style="text-align:right">'+nominal+'</p>'
					}
				},
				{
					"data": "prod_gambar", render: function(data, type, full, meta)
					{
						return '<button class="btn btn-sm btn-success gambar-button" data-toggle="modal" data-target="#splash-9" data-options="splash-9 splash-ef-14" value="'+data+'"><i class="fa fa-search"></i> <span></span></button>';						
					}
				},
				{ "data": "prod_berat" },
				{ "data": "prod_special" },
				// { "data": "prod_facebook" },
				// { "data": "prod_tokopedia" },
				// { "data": "prod_bukalapak" },
				// { "data": "prod_shopee" },
				// {
				// 	"data": "prod_rak_jumlah", render: function(data, type, full, meta)
				// 	{
				// 		if(data > 0){
				// 			return '<button class="btn btn-sm btn-primary rak-button" data-toggle="modal" data-target="#splash-6" data-options="splash-6 splash-ef-14" value="'+full.prod_id+'|'+full.prod_rak_id+'|'+full.prod_rak_jumlah+'"><span>'+full.rak_kode+' - '+data+'</span></button>';						
				// 		}else{
				// 			return '<button class="btn btn-sm btn-primary rak-button" data-toggle="modal" data-target="#splash-6" data-options="splash-6 splash-ef-14" value="'+full.prod_id+'|'+full.prod_rak_id+'|'+full.prod_rak_jumlah+'"><span>-</span></button>';						
				// 		}
				// 	}
				// },
				// {
				// 	"data": "prod_etal_jumlah", render: function(data, type, full, meta)
				// 	{
				// 		if(data > 0){
				// 			return '<button class="btn btn-sm btn-primary  etalase-button" data-toggle="modal" data-target="#splash-7" data-options="splash-7 splash-ef-14" value="'+full.prod_id+'|'+full.prod_etal_id+'|'+full.prod_etal_jumlah+'"><span>'+full.etal_kode+' - '+data+'</span></button>';						
				// 		}else{
				// 			return '<button class="btn btn-sm btn-primary etalase-button" data-toggle="modal" data-target="#splash-7" data-options="splash-7 splash-ef-14" value="'+full.prod_id+'|'+full.prod_etal_id+'|'+full.prod_etal_jumlah+'"><span>-</span></button>';						
				// 		}
				// 	}
				// },
				{
					"data": "prod_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.prod_id+'|'+full.kate_id_1+'|'+full.prod_nama+'|'+full.prod_harga_beli+'|'+full.prod_harga_jual+'|'+full.prod_berat+'|'+full.prod_min_stok+'|'+full.prod_max_stok+'|'+full.prod_tahun+'|'+full.prod_facebook+'|'+full.prod_tokopedia+'|'+full.prod_bukalapak+'|'+full.prod_shopee+'|'+full.prod_kate_id_2+'|'+full.prod_kate_id_3+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
					$('#satuan').val('');
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
					$('#satuan').val('');
					$('#facebook').val('');
					$('#bukalapak').val('');
					$('#tokopedia').val('');
					$('#shopee').val('');
					$('#file').val('');
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
		let max_stok 	= $('#max_stok').val();
		let tahun 		= $('#tahun').val();
		let facebook 	= $('#facebook').val();
		let tokopedia 	= $('#tokopedia').val();
		let bukalapak 	= $('#bukalapak').val();
		let shopee 		= $('#shopee').val();
		let satuan 		= $('#satuan').val();

	
		let ajax = null;
		if(id == 0) {
			ajax = window.apiClient.referensiProduk.insert(parent1, parent2, parent3, nama, harga_beli, harga_jual, berat, status, min_stok, max_stok, tahun, facebook, tokopedia, bukalapak, shopee, satuan)
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
				$('#satuan').val('');
				$('#file').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Produk','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
		else {
			ajax = window.apiClient.referensiProduk.update(id, parent1, parent2, parent3, nama, harga_beli, harga_jual, berat, status, min_stok, max_stok, tahun, facebook, tokopedia, bukalapak, shopee, satuan)
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
				$('#satuan').val('');
				$('#tokopedia').val('');
				$('#shopee').val('');
				$('#file').val('');
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
		$('#satuan').val(res[13]);

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

	// fungsi gambar
	$('#advanced-usage tbody').on('click', '.gambar-button', function(ev) {
		ev.preventDefault();
		var ids = $(this).val();
		var res = ids.split("|");
		// $('#form input[name=rak_prod_id]').val(res[0]);
		$("#detail_gambar").attr("src",'<?php echo base_url();?>gambar/'+res[0]);
		$('#myModalLabel').html('Lihat Gambar');
	});

	// fungsi ubah rak
	$('#advanced-usage tbody').on('click', '.rak-button', function(ev) {
		ev.preventDefault();
		var ids = $(this).val();
		var res = ids.split("|");
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
		value_filter_etalase();
		$('#form input[name=etal_prod_id]').val(res[0]);
		$('#myModalLabel').html('Ubah Etalase Produk');
		$('#etal_prod_id').val(res[0]);
		$('#val_etal_id').val(res[1]);
		$('#etal_jumlah').val(res[2]);
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

		$("#advanced-usage").dataTable().fnDestroy();
		$.message('Pencarian Berhasil.','Produk','success');
		dynamic(val_kategori_utama, val_kategori, val_sub_kategori, val_rak, val_etalase);
	});

	// fungsi tambah jika ya
	$('#clickTambah').click(function() {
		$('#myModalLabel').html('Form Produk');
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
		$('#satuan').val('');
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