 $(function() {
	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}
	var peng_id = $("#peng_id").val();

	function dynamic(){
		//initialize responsive datatable
		var peng_id = $("#peng_id").val();
		var table4 = $('#advanced-usage').DataTable({
		"scrollX": true,
		"ajax": {
				"url": "<?= base_url()?>pengadaan/refund/ajax_data_detail/",
				"data": {
					peng_id: peng_id
				},
				"type": 'POST',
			},
			"columns": [
				{ "data": "pend_peng_id" },
				{ "data": "kate_nama_1" },
				{ "data": "kate_nama_2" },
				{ "data": "kate_nama_3" },
				{ "data": "prod_kode" },
				{ "data": "prod_nama" },
				{
					data: "pend_jumlah", render: function(data, type, full, meta)
						{
							return '<p style="text-align:right;">'+data+'</p>';
						}
				},
				{
					data: "pend_harga", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ');
							return '<p style="text-align:right;">'+nominal+'</p>';
						}
				},
				{
					data: "pend_total_harga", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ');
							return '<p style="text-align:right;">'+nominal+'</p>';
						}
				},
				{ "data": "pend_berat" },
				{ "data": "supp_nama" },
				{ "data": "pend_kode_produk_alias" },
				{ "data": "pend_no_tracking" },
				{ "data": "pend_status_pengiriman" },
				{
					data: "pend_link_referensi", render: function(data, type, full, meta)
					{
						return '<a href="'+data+'" target="_BLANK">'+data+'</a>';							
					}
				},
				{
					data: "pend_id", render: function(data, type, full, meta)
					{
						if(full.pend_status_pengiriman == 'Has Arrived'){
							return '<a class="btn btn-success btn-sm edit-detail" href="#'+data+'" style="float:right;">Ubah</a>';							
						}else{
							return '';							
						}
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

	var table4 = $('#advanced-usage').DataTable({
		"scrollX": true,
		"ajax": {
				"url": "<?= base_url()?>pengadaan/refund/ajax_data_detail/",
				"data": {
					peng_id: peng_id
				},
				"type": 'POST',
			},
			"columns": [
				{ "data": "pend_peng_id" },
				{ "data": "kate_nama_1" },
				{ "data": "kate_nama_2" },
				{ "data": "kate_nama_3" },
				{ "data": "prod_kode" },
				{ "data": "prod_nama" },
				{
					data: "pend_jumlah", render: function(data, type, full, meta)
						{
							return '<p style="text-align:right;">'+data+'</p>';
						}
				},
				{
					data: "pend_harga", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ');
							return '<p style="text-align:right;">'+nominal+'</p>';
						}
				},
				{
					data: "pend_total_harga", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ');
							return '<p style="text-align:right;">'+nominal+'</p>';
						}
				},
				{ "data": "pend_berat" },
				{ "data": "supp_nama" },
				{ "data": "pend_kode_produk_alias" },
				{ "data": "pend_no_tracking" },
				{ "data": "pend_status_pengiriman" },
				{
					data: "pend_link_referensi", render: function(data, type, full, meta)
					{
						return '<a href="'+data+'" target="_BLANK">'+data+'</a>';							
					}
				},
				{
					data: "pend_id", render: function(data, type, full, meta)
					{
						if(full.pend_status_pengiriman == 'Has Arrived'){
							return '<a class="btn btn-success btn-sm edit-detail" href="#'+data+'" style="float:right;">Ubah</a>';							
						}else{
							return '';							
						}
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


	$('#advanced-usage tbody').on('click', '.edit-detail', function(ev) {
		// var ids = $(this).val();
		var ids = $(this).attr("href");
		ids 	= window.apiClient.format.splitString(ids, '#');
		$("#idHapus").val(ids);
		$("#labelHapus").text('Form Ubah Status');
		$("#contentHapus").html('<input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah Barang Rusak"><br>'
			+'<select id="status" name="status" class="form-control">'
				+'<option value="Rusak">Rusak</option>'
			+'</select>');

		$('#myModal3').modal('toggle');
	});

	// fungsi hapus jika ya
	$('#clickHapus').click(function() {
		let id = $("#idHapus").val();
		let jumlah = $("#jumlah").val();
		let status = $("#status").val();
		ajax = window.apiClient.pengadaanTambah.ubahDetailRefund(id,status,jumlah)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.','Produk','success');
				dynamic();
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Produk','error');
			}).
			always(function() {
				$('#myModal3').modal('toggle');
			});
	});
});