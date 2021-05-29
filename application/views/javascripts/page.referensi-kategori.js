 $(function() {
 	
 	// $('#deskripsi').autoNumeric('init');
 	value_filter_kategori();

	function value_filter_kategori(){
		$("#parent1").empty();
		// let level = $("#level").val();
		$("#parent1").append('<option value="" selected>Pilih Kategori 1</option>');
		window.apiClient.filter.referensiKategoriWhere(null,1).done(function(res) {
				$.each(res, function(value, key) {
					$("#parent1").append("<option value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
			  	})
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	

	$('#parent1').on('change', () =>
	{
		let kate_id = $("#parent1").val();
		let level = $("#level").val();
		$("#parent2").empty();
		$("#parent2").append('<option value="" selected>Pilih Kategori 2</option>');
		window.apiClient.filter.referensiKategoriWhere(kate_id,2).done(function(res) {
				$.each(res, function(value, key) {
					$("#parent2").append("<option value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
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
		"ajax": {
			"url": "<?= base_url()?>referensi/kategori/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			// { "data": "kate_id" },
			// { "data": "kate_level" },
			// { "data": "parent" },
			{ "data": "kate_nama" },
			{ "data": "kate_deskripsi" },
			// { "data": "kate_status" },
			{
				"data": "kate_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.kate_id+'|'+full.kate_kate_id+'|'+full.kate_level+'|'+full.kate_nama+'|'+full.kate_deskripsi+'|'+full.kate_status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
			"url": "<?= base_url()?>referensi/kategori/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			// { "data": "kate_id" },
			// { "data": "kate_level" },
			// { "data": "parent" },
			{ "data": "kate_nama" },
			{ "data": "kate_deskripsi" },
			// { "data": "kate_status" },
			{
				"data": "kate_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
								+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.kate_id+'|'+full.kate_kate_id+'|'+full.kate_level+'|'+full.kate_nama+'|'+full.kate_deskripsi+'|'+full.kate_status+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
		let parent1 = $('#parent1').val();
		let parent2 = $('#parent2').val();
		let level = $('#level').val();
		level = 1;
		let nama = $('#nama').val();
		let deskripsi = $('#deskripsi').val();
		// deskripsi 		= window.apiClient.format.splitString(deskripsi, '.');
		let status = $('#status').val();
		let ajax = null;
		if(id == 0) {
			ajax = window.apiClient.referensiKategori.insert(parent1, parent2, level, nama, deskripsi, status)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','Kategori','success');
				dynamic();
				$('#form input[name=id]').val(0);
				$('#parent1').val('');
				$('#parent2').val('');
				$('#level').val('');
				$('#nama').val('');
				$('#deskripsi').val('');
				$('#status').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Kategori','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
		else {
			ajax = window.apiClient.referensiKategori.update(id, parent1, parent2, level, nama, deskripsi, status)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.','Kategori','success');
				dynamic();
				$('#form input[name=id]').val(0);
				$('#parent1').val('');
				$('#parent2').val('');
				$('#level').val('');
				$('#nama').val('');
				$('#deskripsi').val('');
				$('#status').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Kategori','error');
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
		var kate_kate_id = res[1];

		if(res[2] == "1"){
			$('#parent1').val('');
			$('#parent2').val('');
		}else if(res[2] == "2"){
			$('#parent1').val(res[1]);
			window.apiClient.filter.referensiKategoriWhere(res[1],2).done(function(result2) {
					$.each(result2, function(value, key) {
						if(key.kate_id == res[1]){
							$("#parent2").append("<option selected value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
						}else{
							$("#parent2").append("<option value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
						}
				  	})
			}).fail(function($xhr) {
				console.log($xhr);
			});
		}else if(res[2] == "3"){
			window.apiClient.code.getValueKategori(res[1]).done(function(result) {
				$('#parent1').val(result.id);
				let kate_id = result.id;
				let level = $("#level").val();
				$("#parent2").empty();
				$("#parent2").append('<option value="" selected>Pilih Kategori 2</option>');
				window.apiClient.filter.referensiKategoriWhere(kate_id,2).done(function(result2) {
						$.each(result2, function(value, key) {
							if(key.kate_id == res[1]){
								$("#parent2").append("<option selected value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
							}else{
								$("#parent2").append("<option value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
							}
					  	})
				}).fail(function($xhr) {
					console.log($xhr);
				});
			}).fail(function($xhr) {
				console.log($xhr);
			});
		}else if(res[2] == "4"){
			// window.apiClient.code.getValueKategori(res[1]).done(function(result) {
			// 	$('#parent1').val(result.id);
			// 	let kate_id = result.id;
			// 	let level = $("#level").val();
			// 	$("#parent2").empty();
			// 	$("#parent2").append('<option value="" selected>Pilih Kategori 2</option>');
			// 	window.apiClient.filter.referensiKategoriWhere(kate_id,2).done(function(result2) {
			// 			$.each(result2, function(value, key) {
			// 				if(key.kate_id == res[1]){
			// 					$("#parent2").append("<option selected value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
			// 				}else{
			// 					$("#parent2").append("<option value='"+key.kate_id+"'>"+key.kate_nama+"</option>");
			// 				}
			// 		  	})
			// 	}).fail(function($xhr) {
			// 		console.log($xhr);
			// 	});
			// }).fail(function($xhr) {
			// 	console.log($xhr);
			// });
			// $('#parent3').val(res[1]);
		}
		$('#form input[name=id]').val(res[0]);
		$('#myModalLabel').html('Ubah Kategori');
		$('#id').val(res[0]);
		$('#level').val(res[2]);
		$('#nama').val(res[3]);
		$('#deskripsi').val(res[4]);
		// $('#status').val(res[5]);
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
		ajax = window.apiClient.referensiKategori.delete(id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.','Kategori','success');
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
		$('#myModalLabel').html('Form Kategori');
		$('#form input[name=id]').val(0);
		$('#parent1').val('');
		$('#parent2').val('');
		$('#level').val('');
		$('#nama').val('');
		$('#deskripsi').val('');
		// $('#status').val('');
	});
});