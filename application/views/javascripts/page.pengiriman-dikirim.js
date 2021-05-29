 $(function() {

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
				"url": "<?= base_url()?>pengiriman/dikirim/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
				{ "data": "penj_id" },
				{ "data": "penj_nama" },
				{ "data": "penj_no_hp" },
				{ "data": "penj_alamat" },
				{
					data: "penj_total_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				{
					data: "penj_dibayar", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				{
					data: "penj_sisa", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				// { "data": "penj_status_pengiriman" },
				{ "data": "penj_keterangan" },
				{
						data: "penj_id", render: (data, type, full, meta) =>
						{
							return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b sampai-button" data-toggle="modal" onclick=detail("'+data+'") data-target="#splash" data-options="splash-2 splash-ef-14" readonly><i class=""></i> <span>Sampai</span></button>'
									+'<a href="<?php echo base_url();?>pengiriman/belum/batal/'+full.penj_id+'" class="btn btn-sm btn-success btn-ef btn-ef-5 btn-ef-5b"><i class=""></i> <span>Batal</span></button>'
								+'</div>'
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
				"url": "<?= base_url()?>pengiriman/dikirim/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
				{ "data": "penj_id" },
				{ "data": "penj_nama" },
				{ "data": "penj_no_hp" },
				{ "data": "penj_alamat" },
				{
					data: "penj_total_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				{
					data: "penj_dibayar", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				{
					data: "penj_sisa", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, '');
						return '<p style="text-align:right;">'+nominal+'</p>';
					}
				},
				// { "data": "penj_status_pengiriman" },
				{ "data": "penj_keterangan" },
				{
						data: "penj_id", render: (data, type, full, meta) =>
						{
							return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b sampai-button" data-toggle="modal" onclick=detail("'+data+'") data-target="#splash" data-options="splash-2 splash-ef-14" readonly><i class=""></i> <span>Sampai</span></button>'
									+'<a href="<?php echo base_url();?>pengiriman/belum/batal/'+full.penj_id+'" class="btn btn-sm btn-success btn-ef btn-ef-5 btn-ef-5b"><i class=""></i> <span>Batal</span></button>'
								+'</div>'
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
		let penj_id 	= $('#penj_id').val();
		let pede_id 	= $('#pede_id').val();
		let dibayar_live = $('#dibayar_live').val();
		let insentif_live = $('#insentif_live').val();
		let ajax = null;
		// console.log(dibayar_live);
		// console.log(insentif_live);
		ajax = window.apiClient.pengirimanDikirim.sampai(penj_id, pede_id, dibayar_live, insentif_live)
		.done(function(data) {
			$("#advanced-usage").dataTable().fnDestroy();
			dynamic();
			$.message('Berhasil di kirim.','Sampai','success');
		})
		.fail(function($xhr) {
			$.message('Gagal ditambahkan.','Pemesanan Detail','success');
		}).
		always(function() {
			$('#splash').modal('toggle');
		});
	});

});
	function detail(id)
	{
		$('#isi-berangkat').html("")

		window.apiClient.pengirimanDikirim.getDetail(id).done((res) =>
		{
			$.each(res, function(value, key) 
			{
				let harga 		= window.apiClient.format.rupiah(''+key.pede_harga, '')
				let total_harga = window.apiClient.format.rupiah(''+key.pede_total_harga, '')
				let total_harga_all = window.apiClient.format.rupiah(''+key.penj_total_harga, '')
				let dibayar 	= window.apiClient.format.rupiah(''+key.penj_dibayar, '')
				let sisa 		= window.apiClient.format.rupiah(''+key.penj_sisa, '')
				$('#id_detail').val(key.pede_id)
				$('#penj_id').val(key.penj_id)
				$('#pede_id').val(key.pede_id)
				$('#tanggal').val(key.penj_tanggal_pengiriman)
				$('#keterangan').val(key.penj_keterangan)
				$('#total_harga').val(total_harga_all)
				$('#dibayar').val(dibayar)
				$('#sisa').val(sisa)
				// console.log(key.pman_navi_id)

				$('#isi-berangkat').append(""
						+"<tr>"
						+"<td>"+ key.kate_nama +"</td>"
						+"<td>"+ key.prod_nama +"</td>"
						+"<td class='text-right'>"+ harga +"</td>"
						+"<td class='text-right'>"+ key.pede_jumlah +"</td>"
						+"<td class='text-right'>"+ total_harga +"</td>"
						+"</tr>"
						+"")
			})
		})
	}