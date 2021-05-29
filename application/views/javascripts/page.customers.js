 $(function() {

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its customers to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>customers/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "id" },
			{ "data": "nama" },
			{ "data": "perusahaan" },
			{ "data": "email" },
			{ "data": "no_hp" },
			{ "data": "alamat" },
			{
				"data": "id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
							+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.id+'|'+full.nama+'|'+full.email+'|'+full.perusahaan+'|'+full.no_hp+'|'+full.alamat+'|'+full.status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
	//*initialize responsive datatable

	function dynamic(){
		//initialize responsive datatable
	
		var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>customers/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "id" },
			{ "data": "nama" },
			{ "data": "perusahaan" },
			{ "data": "email" },
			{ "data": "no_hp" },
			{ "data": "alamat" },
			{
				"data": "id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
							+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.id+'|'+full.nama+'|'+full.email+'|'+full.perusahaan+'|'+full.no_hp+'|'+full.alamat+'|'+full.status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
		let kode = $('#kode').val();
		let nama = $('#nama').val();
		let email = $('#email').val();
		let perusahaan = $('#perusahaan').val();
		let no_hp = $('#no_hp').val();
		let alamat = $('#alamat').val();
		let status = $('#status').val();
		let ajax = null;
		if(id == 0) {
			$.ajax({
					method: 'post',
					url: '<?= base_url() ?>customers/insert',
					data: {
						nama: nama,
						email: email,
						perusahaan: perusahaan,
						no_hp: no_hp,
						alamat: alamat
					}
				}).done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','Customers','success');
				dynamic();
				$('#form input[name=id]').val(0);
				$('#nama').val('');
				$('#email').val('');
				$('#perusahaan').val('');
				$('#no_hp').val('');
				$('#alamat').val('');
				$('#status').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Customers','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
		else {
			$.ajax({
					method: 'post',
					url: '<?= base_url() ?>customers/update',
					data: {
						id: id,
						nama: nama,
						email: email,
						perusahaan: perusahaan,
						no_hp: no_hp,
						alamat: alamat
					}
				}).done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.','Customers','success');
				dynamic();
				$('#form input[name=id]').val(0);
				$('#nama').val('');
				$('#email').val('');
				$('#perusahaan').val('');
				$('#no_hp').val('');
				$('#alamat').val('');
				$('#status').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Customers','error');
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
		var res = ids.split("|");
		$('#form input[name=id]').val(res[0]);
		$('#myModalLabel').html('Ubah Data Customers');
		$('#id').val(res[0]);
		$('#nama').val(res[1]);
		$('#email').val(res[2]);
		$('#perusahaan').val(res[3]);
		$('#no_hp').val(res[4]);
		$('#alamat').val(res[5]);
		$('#status').val(res[6]);
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
				url: '<?= base_url() ?>customers/delete',
				data: {
					id: id
				}
			}).done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.','Customers','success');
				dynamic();
				
			})
			.fail(function($xhr) {
				$.message('Gagal dihapus.','Customers','error');
			}).
			always(function() {
				$('#myModal3').modal('toggle');
			});
	});

	// fungsi tambah jika ya
	$('#clickTambah').click(function() {
		$('#myModalLabel').html('Form Customers');
		$('#form input[name=id]').val(0);
		$('#nama').val('');
		$('#email').val('');
		$('#perusahaan').val('');
		$('#no_hp').val('');
		$('#alamat').val('');
		$('#status').val('');
	});


});