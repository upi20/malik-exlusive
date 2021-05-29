 $(function() {

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its etalase to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>referensi/etalase/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "etal_id" },
			{ "data": "etal_kode" },
			{ "data": "etal_keterangan" },
			{
				"data": "etal_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
										+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.etal_id+'|'+full.etal_kode+'|'+full.etal_keterangan+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
			"url": "<?= base_url()?>referensi/etalase/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "etal_id" },
			{ "data": "etal_kode" },
			{ "data": "etal_keterangan" },
			{
				"data": "etal_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
										+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.etal_id+'|'+full.etal_kode+'|'+full.etal_keterangan+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
		let keterangan = $('#keterangan').val();

		let ajax = null;
		if(id == 0) {
			ajax = window.apiClient.referensiEtalase.insert(kode, keterangan)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','Etalase','success');
				dynamic();
				$('#form input[name=id]').val(0);
				$('#kode').val('');
				$('#keterangan').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Etalase','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
		else {
			ajax = window.apiClient.referensiEtalase.update(id, kode, keterangan)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.','Etalase','success');
				dynamic();
				$('#form input[name=id]').val(0);
				$('#kode').val('');
				$('#keterangan').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Etalase','error');
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
		console.log(res);
		$('#form input[name=id]').val(res[0]);
		$('#myModalLabel').html('Ubah Data Etalase');
		$('#id').val(res[0]);
		$('#kode').val(res[1]);
		$('#keterangan').val(res[2]);
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
		ajax = window.apiClient.referensiEtalase.delete(id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.','Etalase','success');
				dynamic();
				
			})
			.fail(function($xhr) {
				$.message('Gagal dihapus.','Kategori','error');
			}).
			always(function() {
				$('#myModal3').modal('toggle');
			});
	});

	// fungsi tambah jika ya
	$('#clickTambah').click(function() {
		$('#myModalLabel').html('Form Etalase');
		$('#form input[name=id]').val(0);
		$('#kode').val('');
		$('#keterangan').val('');
	});
});