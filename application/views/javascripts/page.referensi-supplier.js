 $(function() {

 	function cek_kode(kode=null){
		 window.apiClient.filter.cekKode(kode).done(function(res) {
		 	if(res == 1){
				$.message('Mohon maaf kode sudah terpakai.','Supplier','error');
				$("#kode").val("");
		 	}else{
				$.message('Kode bisa digunakan.','Supplier','success');
		 	}
		 }).fail(function($xhr) {
			 console.log($xhr);
		 });

	}

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its supplier to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>referensi/supplier/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "supp_id" },
			{ "data": "supp_kode" },
			{ "data": "supp_nama" },
			{ "data": "supp_alamat" },
			// { "data": "supp_status" },
			// { "data": "supp_rating" },
			// { "data": "supp_komen" },
			{
				"data": "supp_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
							+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.supp_id+'|'+full.supp_kode+'|'+full.supp_nama+'|'+full.supp_email+'|'+full.supp_telpon+'|'+full.supp_no_hp+'|'+full.supp_alamat+'|'+full.supp_status+'|'+full.supp_rating+'|'+full.supp_komen+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
			"url": "<?= base_url()?>referensi/supplier/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "supp_id" },
			{ "data": "supp_kode" },
			{ "data": "supp_nama" },
			{ "data": "supp_alamat" },
			// { "data": "supp_status" },
			// { "data": "supp_rating" },
			// { "data": "supp_komen" },
			{
				"data": "supp_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
							+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.supp_id+'|'+full.supp_kode+'|'+full.supp_nama+'|'+full.supp_email+'|'+full.supp_telpon+'|'+full.supp_no_hp+'|'+full.supp_alamat+'|'+full.supp_status+'|'+full.supp_rating+'|'+full.supp_komen+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
		let telpon = $('#telpon').val();
		let no_hp = $('#no_hp').val();
		let alamat = $('#alamat').val();
		let status = $('#status').val();
		// let rating = $('input[name=rating]:checked').val();
		let rating = 1;
		let komen = $('#komen').val();

		let ajax = null;
		if(id == 0) {
			ajax = window.apiClient.referensiSupplier.insert(kode, nama, email, telpon, no_hp, alamat, status, rating, komen)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','Supplier','success');
				dynamic();
				$('#form input[name=id]').val(0);
				$('#kode').val('');
				$('#nama').val('');
				$('#alamat').val('');
				$('#status').val('');
				$('#rating').val('');
				$('#komen').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Supplier','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
		else {
			ajax = window.apiClient.referensiSupplier.update(id, kode, nama, email, telpon, no_hp, alamat, status, rating, komen)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.','Supplier','success');
				dynamic();
				$('#form input[name=id]').val(0);
				$('#kode').val('');
				$('#nama').val('');
				$('#alamat').val('');
				$('#status').val('');
				$('#rating').val('');
				$('#komen').val('');
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Supplier','error');
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
		$('#myModalLabel').html('Ubah Data Supplier');
		$('#id').val(res[0]);
		$('#kode').val(res[1]);
		$('#nama').val(res[2]);
		$('#alamat').val(res[6]);
		$('#status').val(res[7]);
		$("input[name=rating][value='"+res[8]+"']").prop("checked",true);
		$('#komen').val(res[9]);
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
		ajax = window.apiClient.referensiSupplier.delete(id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.','Supplier','success');
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
		$('#myModalLabel').html('Form Supplier');
		$('#form input[name=id]').val(0);
		$('#kode').val('');
		$('#nama').val('');
		$('#alamat').val('');
		$('#status').val('');
		$('#komen').val('');
		$("input[name=rating]").prop("checked",false);
	});

	$('#kode').on('change', () =>
	{
		var kode 	= $('#kode').val()
		cek_kode(kode)
	});

});