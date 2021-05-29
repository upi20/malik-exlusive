$(function() {

	window.selected_id = null;
	window.selected_nama = null;

	/* BASIC ;*/
	var responsiveHelper_dt_basic = undefined;
	var responsiveHelper_datatable_fixed_column = undefined;
	var responsiveHelper_datatable_col_reorder = undefined;
	var responsiveHelper_datatable_tabletools = undefined;
	
	var breakpointDefinition = {
		tablet : 1024,
		phone : 480
	};
	code();
	function code(){
		window.apiClient.codeOtomatis.pengadaanTransaksi().done(function(res) {
			$("#pean_id").val(res.id);
		});
	}
	
	value_filter_vendor();
	function value_filter_vendor(){
		window.apiClient.filter.referensiVendor().done(function(res) {
			// $("#filter_tanggal").append("<option value=''>Cari Berdasarkan Tanggal</option>");
				$.each(res, function(value, key) {
					$("#vend_id").append("<option value='"+key.vend_id+"'>"+key.vend_name+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

 	$('#harga_pengadaan_vendor').autoNumeric('init');
 	$('#harga_pengadaan_agen').autoNumeric('init');
 	// $('#harga_jual').autoNumeric('init');
	$('#total_bayar').autoNumeric('init');
	function dynamic(){
		$('#dt_basic').DataTable({
			sDom: "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				autoWidth: true,
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
				},
			  "ordering" : false,
		    "scrollX": true,
		    "processing": true,
		    "serverSide": true,
		    ajax: {
					url: "<?php echo base_url()?>pengadaan/masuk/ax_data_isi/",
					data: null,
					type: 'POST'
				},
				columns: [
		      // { data: "prod_id" },
		      { data: "prod_name" },
		      {
						data: "pead_harga_vendor", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ');
							return nominal;
						}
					},
					{
						data: "pead_harga_agen", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ');
							return nominal;
						}
					},
		      { data: "pead_jumlah" },
		      {
						data: "pead_total_harga", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ');
							return '<p style="text-align:right;">'+nominal+'</p>';
						}
					},
					{
						data: "pead_id", render: function(data, type, full, meta)
						{
							return '<div class="pull-right">'
												+'<button class="btn btn-xs btn-danger delete-button" value="'+data+'"><i class="fa fa-trash"></i> Hapus</button>'
											+'</div>';
						}
					}
				],
				"footerCallback": function ( row, data, start, end, display ) {
	        var api = this.api(), data;

	        // Remove the formatting to get integer data for summation
	        var intVal = function ( i ) {
	            return typeof i === 'string' ?
	                i.replace(/[\$,]/g, '')*1 :
	                typeof i === 'number' ?
	                    i : 0;
	        };

	        // Total over all pages
	        total = api
	            .column( 4 )
	            .data()
	            .reduce( function (a, b) {
	                return intVal(a) + intVal(b);
	            }, 0 );

	        // Total over this page
	        pageTotal = api
	            .column( 4, { page: 'current'} )
	            .data()
	            .reduce( function (a, b) {
	                return intVal(a) + intVal(b);
	            }, 0 );
	         $("#total_yang_harus_dibayar").val('Rp. '+total);
		    },
				scrollX: true,
		});
	}

	$('#dt_basic').dataTable({
		sDom: "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			autoWidth: true,
			"oLanguage": {
				"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
			},
		  "ordering" : false,
	    "scrollX": true,
	    "processing": true,
	    "serverSide": true,
		 	ajax: {
				url: "<?php echo base_url()?>pengadaan/masuk/ax_data_isi/",
				data: null,
				type: 'POST'
			},
			columns: [
	      // { data: "prod_id" },
	      { data: "prod_name" },
	      {
					data: "pead_harga_vendor", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ');
						return nominal;
					}
				},
				{
					data: "pead_harga_agen", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ');
						return nominal;
					}
				},
	      { data: "pead_jumlah" },
	      {
					data: "pead_total_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ');
						return nominal;
					}
				},
				{
					data: "pead_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
											+'<button class="btn btn-xs btn-danger delete-button" value="'+data+'"><i class="fa fa-trash"></i> Hapus</button>'
										+'</div>';
					}
				}
			],
			"footerCallback": function ( row, data, start, end, display ) {
        var api = this.api(), data;

        // Remove the formatting to get integer data for summation
        var intVal = function ( i ) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '')*1 :
                typeof i === 'number' ?
                    i : 0;
        };

        // Total over all pages
        total = api
            .column( 4 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

        // Total over this page
        pageTotal = api
            .column( 4, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );
         $("#total_yang_harus_dibayar").val('Rp. '+total);
	    },
		scrollX: true,
				preDrawCallback : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic) {
						// responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($(selector), breakpointDefinition);
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($("#dt_basic"), breakpointDefinition);
					}
				},
				rowCallback: function(nRow) {
					responsiveHelper_dt_basic.createExpandIcon(nRow);
				},
				drawCallback: function(oSettings) {
					responsiveHelper_dt_basic.respond();
				},
	});

	// const $table = $('#dt_basic').DataTable();
	
	$('#dt_basic tbody').on('click', '.delete-button', function(ev) {
		var ids = $(this).val();
		// let $this = $(this);
		ev.preventDefault();

		// let $tr = $(this).parents('tr');
		// let data = JSON.parse($tr.attr('data'));
		$.SmartMessageBox({
			title: "Hapus Data",
			content: "Apakah anda yakin akan menghapus data ini?",
			buttons: '[Tidak][Ya]'
		},
		function(click) {
			if(click === 'Ya') {
				window.apiClient.pengadaanMasuk.delete_detail(ids)
				.done(function(res) {
					// deleteRow(data.id);
					$("#dt_basic").dataTable().fnDestroy();
					dynamic();
				})
				.fail(function($xhr) {
					$.failMessage('Gagal menghapus data produk.');
				});
			}
		});
	});

	function deleteRow(id) {
		$table.row('[data-id='+id+']').remove().draw();
	}

	 // Date Range Picker
	$("input[name=filter-range-from]").datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths: 3,
		dateFormat: 'yy-mm-dd',
		prevText: '<i class="fa fa-chevron-left"></i>',
		nextText: '<i class="fa fa-chevron-right"></i>',
		onClose: function (selectedDate) {
			$("#filter-range-to").datepicker("option", "maxDate", selectedDate);
		}

	});

	$("input[name=filter-range-to]").datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths: 3,
		dateFormat: 'yy-mm-dd',
		prevText: '<i class="fa fa-chevron-left"></i>',
		nextText: '<i class="fa fa-chevron-right"></i>',
		onClose: function (selectedDate) {
			$("#filter-range-from").datepicker("option", "minDate", selectedDate);
		}
	});

	// $('.filter-tanggal, .filter-bulan, .filter-range').hide();
	$('.filter-tanggal, .filter-bulan, .filter-by').hide();

	$('#filter-by').change(function() {
		$('.filter-tanggal, .filter-bulan, .filter-range').hide();
		let by = $(this).val();
		if(by == 'daily') {
			$('.filter-tanggal').show();
		}
		else if(by == 'monthly') {
			$('.filter-bulan').show();
		}
		else if(by == 'range') {
			$('.filter-range').show();
		}
	});

	function addHead(data) {
		$("#id_pengadaan").val(data.id);
		$("#nama").val(data.nama);
		$("#no-telpon").val(data.notelpon);
		$("#alamat").val(data.alamat);
		$("#email").val(data.email);
		$("#tanggal").val(data.tanggal);
		$("#deskripsi").val(data.deskripsi);
		$("#id").val(data.id);
	}

	$('#form').submit(function(ev) {
		ev.preventDefault();

		let id = $('#form input[name=id]').val();
		let id_pengadaan = $('#pean_id').val();
		console.log(id_pengadaan);
		let nama = $('#vend_id').val();
		// let notelpon = $('#no-telpon').val();
		// let alamat = $('#alamat').val();
		// let email = $('#email').val();
		let tanggal = $('#tanggal').val();
		let deskripsi = $('#deskripsi').val();
		let ajax = null;
		// if(id == "") {
		// 	ajax = window.apiClient.pengadaanMasuk.insertHead(id_pengadaan, nama, tanggal, deskripsi)
		// 	.done(function(data) {
		// 		addHead(data);
		// 	})
		// 	.fail(function($xhr) {
		// 		$.failMessage('Gagal menambahkan Pengadaan Masuk.');
		// 	}).
		// 	always(function() {
		// 		$('#wid-id-1').addClass('jarviswidget-collapsed').children('div').slideDown('fast');
		// 		$('#info-head-simpan').modal('toggle');
		// 	});
		// }
		// else {
		// 	ajax = window.apiClient.pengadaanMasuk.updateHead(id, nama, notelpon, alamat, email, tanggal, deskripsi)
		// 	.done(function(data) {
		// 		addHead(data);
		// 	})
		// 	.fail(function($xhr) {
		// 		$.failMessage('Gagal mengubah Pengadaan Masuk.');
		// 	}).
		// 	always(function() {
		// 		$('#info-head-ubah').modal('toggle');
		// 	});
		// }
	});

	function splitString(stringToSplit, separator) {
	  var arrayOfStrings = stringToSplit.split(separator);
	  return arrayOfStrings.join('');
	}

	$('#form-produk').submit(function(ev) {
		ev.preventDefault();

		let id = $('#form-produk input[name=id_produk]').val();
		let id_pengadaan = $('#pean_id').val();

		// let id_pengadaan = 1;
		let cats_id = $('#cats_id').val();
		let prod_id = $('#prod_id').val();
		let harga_lama = $('#prod_price').val();
		let harga_pengadaan_vendor = $('#harga_pengadaan_vendor').val();
		let harga_pengadaan_agen = $('#harga_pengadaan_vendor').val();
		harga_pengadaan_vendor = window.apiClient.format.splitString(harga_pengadaan_vendor, '.');
		harga_pengadaan_agen = window.apiClient.format.splitString(harga_pengadaan_agen, '.');

		let jumlah_pengadaan = $('#jumlah_pengadaan').val();
		let jumlah_pcs = $('#jumlah_pcs').val();

		let ajax = null;
		id_pengadaan = 1;
		if(id_pengadaan != ""){
			if(id == "") {
				ajax = window.apiClient.pengadaanMasuk.insertDetail(id_pengadaan, prod_id, harga_lama, harga_pengadaan_vendor, harga_pengadaan_agen, jumlah_pengadaan, jumlah_pcs)
				.done(function(data) {
					// addDetail(data);
					$("#dt_basic").dataTable().fnDestroy();
					dynamic();

				})
				.fail(function($xhr) {
					$.failMessage('Gagal menambahkan Pengadaan Masuk.');
				}).
				always(function() {
					$("#jumlah_pcs").val('');
					$("#jumlah_pengadaan").val('');
					$("#prod_ukuran").val('');
					$("#satuan").val('');
					$('#myModal').modal('toggle');
				});
			}
			else {

			}
		}else{
			alert('isi pengadaan terlebih dahulu');
			$('#myModal').modal('toggle');
		}
	});

	$('#add-button').click(function(ev) {
		ev.preventDefault();

		$('#myModalLabel').html('Tambah Pengadaan Stok');
		// $('#form input[name=id]').val(0);
		$('#name').val('');
		$('#description').val('');
		$('#prod_stok').val('');
		$('#prod_price').val('');
		$('#jumlah_pengadaan').val('');
		$('#harga_pengadaan_vendor').val('');
		$('#harga_pengadaan_agen').val('');
		$("#jumlah_pcs").val('');
		$("#prod_ukuran").val('');
		$("#satuan").val('');
		$('#prod_id').val('');

		$('#myModal').modal();
	});

	$('#cats_id').change(function() {
		let cats_id = $(this).val();
		if(cats_id){
			ajax = window.apiClient.produk.getProduk(cats_id)
				.fail(function($xhr) {
					$.failMessage("<option value=''></option>");
				})
				.always(function() {
					$("#prod_id").html('');
				})
				.done(function(data) {
          $("#prod_id").append("<option value='0'>Pilih Produk</option>");
					$.each(data, function(value, key) {
            $("#prod_id").append("<option value='"+key.prod_id+"'>"+key.prod_name+"</option>");
          })
				});
		}
	});

	$("#jumlah_pengadaan").bind("keyup change", function(e) {
		var ukuran = $("#prod_ukuran").val();
		var qty = $("#jumlah_pengadaan").val();
		var satuan = $("#satuan").val();
		var pcs;
		console.log(ukuran);
		console.log(qty);
		if(satuan = 'meter'){
			pcs = qty * ukuran;
		}else{
			pcs = 0;
		}
		$("#jumlah_pcs").val(pcs);
	});

	$('#prod_id').change(function() {
		let prod_id = $(this).val();
		if(prod_id){
			ajax = window.apiClient.produk.getInfoProduk(prod_id)
				.fail(function($xhr) {
					$("#prod_stok").val('');
					$("#prod_price").val('');
				})
				.always(function() {
					
				})
				.done(function(data) {
					if(data.satuan == 'Meter'){
						$('#jumlah_pcs').prop('readonly', true);
						$('#jumlah_pengadaan').prop('readonly', false);
					}else if(data.satuan == 'Karung'){
						
						$('#jumlah_pcs').prop('readonly', false);
						$('#jumlah_pengadaan').val(0);
						$('#jumlah_pengadaan').prop('readonly', true);
					}else if(data.satuan == 'Liter'){
						$('#jumlah_pcs').prop('readonly', false);
						$('#jumlah_pengadaan').val(0);
						$('#jumlah_pengadaan').prop('readonly', true);
					}
					$('#addSatuanLabel').html(data.satuan);
					$("#satuan").val(data.satuan);
					$("#prod_ukuran").val(data.ukuran);
					$("#prod_stok").val(data.stok);
					$("#prod_price").val(window.apiClient.format.rupiah(data.price, 'Rp. '));
				});
		}
	});

	$('#tabel-cari tbody').on('click', 'tr', function() {
		let $tr = $(this);
		$('#tabel-cari tbody tr').removeClass('highlight');
		$tr.addClass('highlight');
		window.selected_id = $tr.children().first().text();
		window.selected_nama = $tr.children().eq(1).text();
		$('#modal-cari button.ok').removeAttr('disabled');
	});

	$('#modal-cari button.ok').click(function() {
		$('#modal-cari').modal('toggle');
		$('#filteridpengadaan').val(window.selected_id);
		$('#filternamapengadaan').val(window.selected_nama);
	});

	$('#tabel-cari').dataTable({
		sDom: "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
			"t"+
			"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
		autoWidth: true,
		"oLanguage": {
			"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
		},
		// scrollY: 200,
		scrollX: true,
		columns: [
			{data: 'pean_id'},
			{data: 'pean_name'},
			{data: 'pean_description'},
			{data: 'pean_date'},
		],
	});

	let $tabelCari = $('#tabel-cari').DataTable();

	$('#cari-lepeung').click(function() {
		let q = $('#cari').val();
		let tanggal = $('#caritanggal').val();
		if(q.length < 3){
			$('#cari').next().show();				
		}
		else {
			$('#cari').next().hide();
			$.getJSON('<?= site_url() ?>pengadaan/masuk/cari?term='+q+'&tanggal='+tanggal)
			.done(function(res) {
				$tabelCari.rows.add(res).draw();
				$('#modal-cari button.ok').attr('disabled','disabled');
				$('#tabel-cari tbody tr').removeClass('highlight');
				window.selected_id = null;
				window.selected_nama = null;
				$('#modal-cari').modal();
			});
		}
	});

	
	$('#cari-data').click(function() {
		let q = $('#filteridpengadaan').val();
		$.getJSON('<?= site_url() ?>pengadaan/masuk/getPengadaan?id='+q)
		.done(function(res) {

			$('#wid-id-0').addClass('jarviswidget-collapsed').children('div').slideUp('fast');
			$('#wid-id-3').removeClass('jarviswidget-collapsed').children('div').slideDown('fast');
			$('#wid-id-1').removeClass('jarviswidget-collapsed').children('div').slideDown('fast');
			
			// set data head
			$('#id').val(res[0].pean_id);
			$('#id_pengadaan').val(res[0].pean_id);
			$('#nama').val(res[0].pean_name);
			$('#no-telpon').val(res[0].pean_phone);
			$('#alamat').val(res[0].pean_alamat);
			$('#email').val(res[0].pean_email);
			$('#tanggal').val(res[0].pean_date);
			$('#deskripsi').val(res[0].pean_description);

			$.getJSON('<?= site_url() ?>pengadaan/masuk/getPengadaanDetail?id='+q)
				.done(function(obj) {
					$.each( obj, function( key, value ) {
					  console.log(value)
					  console.log(value.prod_name)
						let row = [
							value.prod_name,
							value.pead_harga_baru,
							value.pead_jumlah,
							value.pead_total_harga,
							'<div class="pull-right">'+
								'<button class="btn btn-xs btn-primary edit-button"><i class="fa fa-edit"></i> Edit</button> '+
								'<button class="btn btn-xs btn-danger delete-button"><i class="fa fa-trash"></i> Hapus</button>'+
							'</div>'
						];
						let $node = $($table.row.add(row).draw().node());
						$node.attr('data', JSON.stringify(value));
						$node.attr('data-id', value.pead_id);
					});
					// console.log(response)
					// console.log(response)
					// initTable('#dt_basic');
					// $("#dt_basic").DataTable().rows.add(window.dataPegawai);
					// $("#dt_basic").DataTable().draw();
			});
		});
	});


	$('#simpan-pengadaan').click(function() {
		if($('#vend_id').val() == "" || $('#vend_id').val() == null){
			$('#info-simpan-pengadaan-warning').modal('toggle');
		}else{
			// console.log($('#id').val());
			// let id_pengadaan = null; 
			let id_pengadaan = $('#pean_id').val();
			let nama = $('#vend_id').val();
			let tanggal = $('#tanggal').val();
			let deskripsi = $('#deskripsi').val();
			ajax = window.apiClient.pengadaanMasuk.insertHead(id_pengadaan, nama, tanggal, deskripsi)
			.done(function(data) {
				$("#vend_id").val('');
				$("#tanggal").val('');
				$("#deskripsi").val('');
				$("#total_bayar").val('');
				$("#id").val('');
				$("#id_pengadaan").val('');
				// $("#filteridpengadaan").val('');
				// $("#filternamapengadaan").val('');
				// $($table.clear().draw())
				$("#dt_basic").dataTable().fnDestroy();
				dynamic();
				$('#info-simpan-pengadaan-success').modal('toggle');
			})
			.fail(function($xhr) {
				$("#dt_basic").dataTable().fnDestroy();
				dynamic();
				$.failMessage('Gagal mengubah Pengadaan Masuk.');
			}).
			always(function() {
				// $('#info-simpan-pengadaan-success').modal('toggle');
				// $('#wid-id-0').removeClass('jarviswidget-collapsed').children('div').slideDown('fast');
				// $('#wid-id-3').addClass('jarviswidget-collapsed').children('div').slideUp('fast');
				// $('#wid-id-1').addClass('jarviswidget-collapsed').children('div').slideUp('fast');
			});
		}
	});
});