 $(function() {


	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its supplier to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>kendaraan/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			// { "data": "id" },
			{ "data": "jenis" },
			{ "data": "merk" },
			{ "data": "plat_nomor" },
			{
				"data": "id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
							+'<button class="btn btn-sm btn-success btn-ef btn-ef-5 btn-ef-5b hutang-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.id+'|'+full.jenis+'"><i class="fa fa-edit"></i> <span>Hutang</span></button>'
							+'<button class="btn btn-sm btn-default btn-ef btn-ef-5 btn-ef-5b bayar-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.id+'|'+full.jenis+'"><i class="fa fa-edit"></i> <span>Bayar</span></button>'
							+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.id+'|'+full.jenis+'|'+full.merk+'|'+full.plat_nomor+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
							+'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
							+'<a class="btn btn-sm btn-default btn-ef btn-ef-5 btn-ef-5b" href="<?=base_url()?>kendaraan/cetak/'+full.id+'"><i class="fa fa-print"></i> <span>Cetak</span></a>'
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
			"url": "<?= base_url()?>kendaraan/ajax_data/",
			"data": null,
			"type": 'POST'
			},
			"columns": [
				// { "data": "id" },
				{ "data": "jenis" },
				{ "data": "merk" },
				{ "data": "plat_nomor" },
				{
					"data": "id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
								+'<button class="btn btn-sm btn-success btn-ef btn-ef-5 btn-ef-5b hutang-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.id+'|'+full.jenis+'"><i class="fa fa-edit"></i> <span>Hutang</span></button>'
								+'<button class="btn btn-sm btn-default btn-ef btn-ef-5 btn-ef-5b bayar-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.id+'|'+full.jenis+'"><i class="fa fa-edit"></i> <span>Bayar</span></button>'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.id+'|'+full.jenis+'|'+full.merk+'|'+full.plat_nomor+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
		let jenis = $('#jenis').val();
		let merk = $('#merk').val();
		let plat_nomor = $('#plat_nomor').val();
		let ajax = null;
		
		if(id == 0) {
			$.ajax({
				method: 'post',
				url: '<?= base_url() ?>kendaraan/insert',
				data: {
					jenis: jenis,
					merk: merk,
					plat_nomor: plat_nomor
				}
			}).done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','Kendaraan','success');
				dynamic();
				$('#form input[name=id]').val(0);
				$('#jenis').val('');
				$('#merk').val('');
				$('#plat_nomor').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Kendaraan','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			})
		}
		else {
			$.ajax({
				method: 'post',
				url: '<?= base_url() ?>kendaraan/update',
				data: {
					id: id,
					jenis: jenis,
					merk: merk,
					plat_nomor: plat_nomor
				}
			}).done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.','Kendaraan','success');
				dynamic();
				$('#form input[name=id]').val(0);
				$('#jenis').val('');
				$('#merk').val('');
				$('#plat_nomor').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Kendaraan','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			})
		}

		
	});

	
	// fungsi ubah
	$('#advanced-usage tbody').on('click', '.edit-button', function(ev) {
		ev.preventDefault();
		var ids = $(this).val();
		var res = ids.split("|");
		$('#form input[name=id]').val(res[0]);
		$('#myModalLabel').html('Ubah Data Kendaraan');
		$('#id').val(res[0]);
		$('#jenis').val(res[1]);
		$('#merk').val(res[2]);
		$('#plat_nomor').val(res[3]);
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
			url: '<?= base_url() ?>kendaraan/delete',
			data: {
				id: id
			}
		}).done(function(data) {
			$("#advanced-usage").dataTable().fnDestroy();
			$.message('Berhasil dihapus.','Kendaraan','success');
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
		$('#myModalLabel').html('Form Kendaraan');
		$('#form input[name=id]').val(0);
		$('#jenis').val('');
		$('#merk').val('');
		$('#plat_nomor').val('');
	});

});