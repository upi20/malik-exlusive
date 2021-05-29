 $(function() {

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}

	dynamic()

	function dynamic(){
		//initialize responsive datatable
	
		var table4 = $('#advanced-usage').DataTable({
			"ajax": {
				"url": "<?= base_url()?>toko/data/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
				{ "data": "nama" },
				{ "data": "nama_lengkap" },
				{ "data": "no_hp" },
				{
					"data": "id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
											+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.id+'|'+full.nama+'|'+full.nama_lengkap+'|'+full.no_hp+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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

		let id = $('#form input[name=id]').val();
		let nama = $('#nama').val();
		let nama_lengkap = $('#nama_lengkap').val();
		let no_hp = $('#no_hp').val();

		let ajax = null;
		if(id == 0) {
			$.ajax({
				method: 'post',
				url: '<?= base_url() ?>toko/data/insert',
				data: {
					nama: nama,
					nama_lengkap: nama_lengkap,
					no_hp: no_hp,
				}
			})
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','Toko','success');
				dynamic();
				$('#nama').val('');
				$('#nama_lengkap').val('');
				$('#no_hp').val('');
				
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Toko','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
		else {
			$.ajax({
				method: 'post',
				url: '<?= base_url() ?>toko/data/update',
				data: {
					id:id,
					nama: nama,
					nama_lengkap: nama_lengkap,
					no_hp: no_hp,
				}
			})
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.','Toko','success');
				dynamic();
				
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Toko','error');
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
		$('#myModalLabel').html('Ubah Data Toko');
		$('#id').val(res[0]);
		$('#nama').val(res[1]);
		$('#nama_lengkap').val(res[2]);
		$('#no_hp').val(res[3]);
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
				url: '<?= base_url() ?>toko/data/delete',
				data: {
					id:id,
				}
			})
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.','Toko','success');
				dynamic();
				
			})
			.fail(function($xhr) {
				$.message('Gagal dihapus.','Toko','error');
			}).
			always(function() {
				$('#myModal3').modal('toggle');
			});
	});

	// fungsi tambah jika ya
	$('#clickTambah').click(function() {
		$('#myModalLabel').html('Form Toko');
		$('#form input[name=id]').val(0);
		$('#nama').val('');
		$('#nama_lengkap').val('');
		$('#no_hp').val('');
	});
});