 $(function() {
 	$('#nominal').autoNumeric('init');

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}


	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>pengeluaran/data/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "pean_id" },
			{ "data": "pean_tanggal" },
			{ "data": "pean_kategori" },
			{ "data": "pean_keterangan" },
			{
				data: "pean_nominal", render: function(data, type, full, meta)
				{
					let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
					
					return '<p style="text-align:right">'+nominal+'</p>'
				}
			},
			{ "data": "pean_untuk" },
			{
				"data": "pean_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
										+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.pean_id+'|'+full.pean_kategori+'|'+full.pean_keterangan+'|'+full.pean_nominal+'|'+full.pean_untuk+'|'+full.pean_tanggal+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
										+'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
									+'</div>';
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
			"url": "<?= base_url()?>pengeluaran/data/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "pean_id" },
			{ "data": "pean_tanggal" },
			{ "data": "pean_kategori" },
			{ "data": "pean_keterangan" },
			{ 
				data: "pean_nominal", render: function(data, type, full, meta)
				{
					let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
					
					return '<p style="text-align:right">'+nominal+'</p>'
				} 
			},
			{ "data": "pean_untuk" },
			{
				"data": "pean_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
										+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.pean_id+'|'+full.pean_kategori+'|'+full.pean_keterangan+'|'+full.pean_nominal+'|'+full.pean_untuk+'|'+full.pean_tanggal+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
										+'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
									+'</div>';
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

		let id 				= $('#form input[name=id]').val();
		let kategori 		= $('#kategori').val();
		let keterangan 		= $('#keterangan').val();
		let nominal 		= $('#nominal').val();
		nominal 		= window.apiClient.format.splitString(nominal, '.');
		let untuk 			= $('#untuk').val()
		let tanggal 			= $('#tanggal').val()
		// console.log(id);
		let ajax = null;
		if(id == 0) {
			ajax = window.apiClient.pengeluaran.insert(kategori, keterangan, nominal, untuk, tanggal)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','Pengeluaran','success');
				dynamic();
				// $('#form input[name=id]').val(0);
				$('#id').val('');
				$('#kategori').val('');
				$('#keterangan').val('');
				$('#nominal').val('');
				$('#tanggal').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Kelas','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
		else {
			ajax = window.apiClient.pengeluaran.update(id, kategori, keterangan, nominal, untuk, tanggal)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.','Pengeluaran','success');
				dynamic();
				$('#id').val('');
				$('#kategori').val('');
				$('#keterangan').val('');
				$('#nominal').val('');
				$('#tanggal').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Kelas','error');
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
		$('#myModalLabel').html('Ubah Kelas');
		$('#id').val(res[0]);
		$('#kategori').val(res[1]);
		$('#keterangan').val(res[2]);
		let nominal = res[3];
		nominal = window.apiClient.format.rupiah(''+nominal, '');

		$('#nominal').val(nominal);
		$('#untuk').val(res[4])
		$('#tanggal').val(res[5])
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
		ajax = window.apiClient.pengeluaran.delete(id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.','Pengeluaran','success');
				dynamic();
				
			})
			.fail(function($xhr) {
				$.message('Gagal dihapus.','Kelas','error');
			}).
			always(function() {
				$('#myModal3').modal('toggle');
			});
	});

});