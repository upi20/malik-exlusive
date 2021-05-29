 $(function() {

 	value_filter_level();

	function value_filter_level(){
		window.apiClient.filter.pengaturanPenggunaLevel().done(function(res) {
			// $("#filter_tanggal").append("<option value=''>Cari Berdasarkan Tanggal</option>");
				$.each(res, function(value, key) {
					$("#lev_id").append("<option value='"+key.lev_id+"'>"+key.lev_nama+"</option>");
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
			"url": "<?= base_url()?>pengaturan/pengguna/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "user_email" },
			{ "data": "user_name" },
			{ "data": "user_phone" },
			{ "data": "user_address" },
			{ "data": "lev_nama" },
			{
				"data": "user_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
										+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.user_id+'|'+full.user_email+'|'+full.user_name+'|'+full.user_phone+'|'+full.user_address+'|'+full.lev_id+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
				// 'sExtends': 'collection',
				// 'sButtonText': 'Save',
				// 'aButtons': ['csv', 'xls', 'pdf']
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
				"url": "<?= base_url()?>pengaturan/pengguna/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
			{ "data": "user_email" },
			{ "data": "user_name" },
			{ "data": "user_phone" },
			{ "data": "user_address" },
			{ "data": "lev_nama" },
			{
				"data": "user_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
										+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.user_id+'|'+full.user_email+'|'+full.user_name+'|'+full.user_phone+'|'+full.user_address+'|'+full.lev_id+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
					// 'sExtends': 'collection',
					// 'sButtonText': 'Save',
					// 'aButtons': ['csv', 'xls', 'pdf']
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
		let email = $('#email').val();
		let name = $('#name').val();
		let phone = $('#phone').val();
		let address = $('#address').val();
		let lev_id = $('#lev_id').val();

		let ajax = null;
		if(id == 0) {
			ajax = window.apiClient.pengaturanPengguna.insert(email, name, phone, address, lev_id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','Level','success');
				dynamic();
				$('#form input[name=id]').val(0);
				$('#email').val('');
				$('#name').val('');
				$('#phone').val('');
				$('#address').val('');
				$('#lev_id').val('');
			})
			.fail(function($xhr) {
				$.failMessage('Gagal menambahkan Pengguna.');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
		else {
			ajax = window.apiClient.pengaturanPengguna.update(id, email, name, phone, address, lev_id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.','Pengguna','success');
				$('#myModalLabel').html('Tambah Data Pengguna');
				$('#form input[name=id]').val(0);
				$('#email').val('');
				$('#name').val('');
				$('#phone').val('');
				$('#address').val('');
				$('#lev_id').val('');
				dynamic();
			})
			.fail(function($xhr) {
				$.failMessage('Gagal mengubah Pengguna.');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
	});

	
	// fungsi ubah
	$('#advanced-usage tbody').on('click', '.edit-button', function(ev) {
		ev.preventDefault();
		var ids = $(this).val();
		console.log(ids);
		var res = ids.split("|");
		$('#form input[name=id]').val(res[0]);
		$('#myModalLabel').html('Ubah Data Pengguna');
		$('#id').val(res[0]);
		$('#email').val(res[1]);
		$('#name').val(res[2]);
		$('#phone').val(res[3]);
		$('#address').val(res[4]);
		$('#lev_id').val(res[5]);
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
		ajax = window.apiClient.pengaturanPengguna.delete(id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.','Level','success');
				dynamic();
				
			})
			.fail(function($xhr) {
				$.message('Gagal dihapus.','Level','error');
			}).
			always(function() {
				$('#myModal3').modal('toggle');
			});
	});

	// fungsi tambah jika ya
	$('#clickTambah').click(function() {
		$('#myModalLabel').html('Form Pengguna');
		$('#form input[name=id]').val(0);
		$('#email').val('');
		$('#name').val('');
		$('#phone').val('');
		$('#address').val('');
		$('#lev_id').val('');
	});
});
