 $(function() {


	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its supplier to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>karyawan/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "id" },
			{ "data": "nama" },
			{ "data": "no_hp" },
			{ "data": "alamat" },
			{ "data": "driver" },
			{ "data": "total_hutang" },
			{ "data": "dibayar" },
			{ "data": "sisa" },
			{
				"data": "id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
							+'<button class="btn btn-sm btn-success btn-ef btn-ef-5 btn-ef-5b hutang-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.id+'|'+full.nama+'"><i class="fa fa-edit"></i> <span>Hutang</span></button>'
							+'<button class="btn btn-sm btn-default btn-ef btn-ef-5 btn-ef-5b bayar-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.id+'|'+full.nama+'"><i class="fa fa-edit"></i> <span>Bayar</span></button>'
							+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.id+'|'+full.nama+'|'+full.no_hp+'|'+full.alamat+'|'+full.driver+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
							+'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
							+'<a class="btn btn-sm btn-default btn-ef btn-ef-5 btn-ef-5b" href="<?=base_url()?>karyawan/cetak/'+full.id+'"><i class="fa fa-print"></i> <span>Cetak</span></a>'
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
	//*initialize responsive datatable

	function dynamic(){
		//initialize responsive datatable
	
		var table4 = $('#advanced-usage').DataTable({
			"ajax": {
			"url": "<?= base_url()?>karyawan/ajax_data/",
			"data": null,
			"type": 'POST'
			},
			"columns": [
				{ "data": "id" },
				{ "data": "nama" },
				{ "data": "no_hp" },
				{ "data": "alamat" },
				{ "data": "driver" },
				{ "data": "total_hutang" },
				{ "data": "dibayar" },
				{ "data": "sisa" },
				{
					"data": "id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
								+'<button class="btn btn-sm btn-success btn-ef btn-ef-5 btn-ef-5b hutang-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.id+'|'+full.nama+'"><i class="fa fa-edit"></i> <span>Hutang</span></button>'
								+'<button class="btn btn-sm btn-default btn-ef btn-ef-5 btn-ef-5b bayar-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.id+'|'+full.nama+'"><i class="fa fa-edit"></i> <span>Bayar</span></button>'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.id+'|'+full.nama+'|'+full.no_hp+'|'+full.alamat+'|'+full.driver+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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

	// fungsi simpan 
	$('#form').submit(function(ev) {
		ev.preventDefault();

		let id = $('#form input[name=id]').val();
		let nama = $('#nama').val();
		let no_hp = $('#no_hp').val();
		let alamat = $('#alamat').val();
		let driver = $('#driver').val();

		let hutang_id = $('#hutang_id').val();
		let jumlah = $('#jumlah').val();

		let bayar_id = $('#bayar_id').val();
		let bayar_jumlah = $('#bayar_jumlah').val();

		let ajax = null;
		if(hutang_id != 0){
			$.ajax({
				method: 'post',
				url: '<?= base_url() ?>karyawan/hutang',
				data: {
					id: hutang_id,
					jumlah: jumlah
				}
			}).done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','Casbon Karyawan','success');
				dynamic();
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Casbon Karyawan','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			})
		}else if(bayar_id != 0){
			$.ajax({
				method: 'post',
				url: '<?= base_url() ?>karyawan/bayar',
				data: {
					id: bayar_id,
					jumlah: bayar_jumlah
				}
			}).done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','Bayar Casbon Karyawan','success');
				dynamic();
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Bayar Casbon Karyawan','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			})
		}else{
			if(id == 0) {
				$.ajax({
					method: 'post',
					url: '<?= base_url() ?>karyawan/insert',
					data: {
						nama: nama,
						no_hp: no_hp,
						alamat: alamat,
						driver: driver
					}
				}).done(function(data) {
					$("#advanced-usage").dataTable().fnDestroy();
					$.message('Berhasil ditambahkan.','Karyawan','success');
					dynamic();
					$('#form input[name=id]').val(0);
					$('#nama').val('');
					$('#no_hp').val('');
					$('#alamat').val('');
				})
				.fail(function($xhr) {
					$.message('Gagal ditambahkan.','Karyawan','error');
				}).
				always(function() {
					$('#splash').modal('toggle');
				})
			}
			else {
				$.ajax({
					method: 'post',
					url: '<?= base_url() ?>karyawan/update',
					data: {
						id: id,
						nama: nama,
						no_hp: no_hp,
						alamat: alamat,
						driver: driver
					}
				}).done(function(data) {
					$("#advanced-usage").dataTable().fnDestroy();
					$.message('Berhasil diubah.','Karyawan','success');
					dynamic();
					$('#form input[name=id]').val(0);
					$('#nama').val('');
					$('#no_hp').val('');
					$('#alamat').val('');
				})
				.fail(function($xhr) {
					$.message('Gagal diubah.','Karyawan','error');
				}).
				always(function() {
					$('#splash').modal('toggle');
				})
			}
		}

		
	});

	$('#advanced-usage tbody').on('click', '.hutang-button', function(ev) {
		ev.preventDefault();
		var ids = $(this).val();
		var res = ids.split("|");
		$('#bayar_id').val(0);
		$('#myModalLabel').html('Form Casbon');
		$('#hutang_id').val(res[0]);
		$('#hutang_nama').val(res[1]);
		$('#jumlah').val('');

		$("#div-casbon").show()
		$("#div-bayar").hide()
		$("#div-karyawan").hide()
	});

	$('#advanced-usage tbody').on('click', '.bayar-button', function(ev) {
		ev.preventDefault();
		$('#hutang_id').val(0);
		var ids = $(this).val();
		var res = ids.split("|");

		$('#myModalLabel').html('Form Bayar Casbon');
		$('#bayar_id').val(res[0]);
		$('#bayar_nama').val(res[1]);
		$('#bayar_jumlah').val('');

		$("#div-bayar").show()
		$("#div-casbon").hide()
		$("#div-karyawan").hide()
	});
	
	// fungsi ubah
	$('#advanced-usage tbody').on('click', '.edit-button', function(ev) {
		ev.preventDefault();
		var ids = $(this).val();
		var res = ids.split("|");
		$('#hutang_id').val(0);
		$('#bayar_id').val(0);
		$('#form input[name=id]').val(res[0]);
		$('#myModalLabel').html('Ubah Data Karyawan');
		$('#id').val(res[0]);
		$('#nama').val(res[1]);
		$('#no_hp').val(res[2]);
		$('#alamat').val(res[3]);
		$('#driver').val(res[4]);
		$("#div-karyawan").show()
		$("#div-bayar").hide()
		$("#div-casbon").hide()
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
		$.ajax({
			method: 'post',
			url: '<?= base_url() ?>karyawan/delete',
			data: {
				id: id
			}
		}).done(function(data) {
			$("#advanced-usage").dataTable().fnDestroy();
			$.message('Berhasil dihapus.','Karyawan','success');
			dynamic();
			
		})
		.fail(function($xhr) {
			$.message('Gagal dihapus.','Kategori','error');
		}).
		always(function() {
			$('#myModal3').modal('toggle');
		})
	});

	// fungsi tambah jika ya
	$('#clickTambah').click(function() {
		$('#myModalLabel').html('Form Karyawan');
		$('#form input[name=id]').val(0);
		$('#hutang_id').val(0);
		$('#nama').val('');
		$('#no_hp').val('');
		$('#alamat').val('');
		$("#div-karyawan").show()
		$("#div-bayar").hide()
		$("#div-casbon").hide()
	});

});