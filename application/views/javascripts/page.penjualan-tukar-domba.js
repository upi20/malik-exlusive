 $(function() {

 	$('#dibayar').autoNumeric('init');

 value_filter_produk();

 function value_filter_produk(kelas=null){
		window.apiClient.filter.referensiProdukPenjualan(kelas).done(function(res) {
				$("#domba_baru").empty();
				$.each(res, function(value, key) {
					$("#domba_baru").append("<option value='"+key.prod_id+"'>"+key.prod_nama+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible)
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
				"url": "<?= base_url()?>penjualan/data/ajax_data/",
				"data": null,
				"type": 'POST',
			},
			"columns": [
				{ "data": "penj_id" },
				{ "data": "penj_nama" },
				{ "data": "penj_no_hp" },
				{ "data": "penj_alamat" },
				{
					data: "penj_total_harga", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
						return '<p style="text-align:right">'+nominal+'</p>'
					}
				},
				{
					data: "penj_dibayar", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
						return '<p style="text-align:right">'+nominal+'</p>'
					}
				},
				{
					data: "penj_sisa", render: function(data, type, full, meta)
					{
						let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
						return '<p style="text-align:right">'+nominal+'</p>'
					}
				},
				{ "data": "penj_keterangan" },
				{ "data": "penj_kondisi" },
				{ "data": "penj_tanggal" },
				{ "data": "penj_status" },
				{
					data: "penj_id", render: (data, type, full, meta) =>
					{
						return '<div class="pull-right">'
									+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" onclick=tukarDomba("'+full.penj_id+'")><i class="fa fa-edit"></i> <span>Tukar</span></button>'
								+'</div>'
					}
				},
			],
		"aoColumnDefs": [
		  { 'bSortable': false, 'aTargets': [ "no-sort" ] }
		]
	})


	var colvis = new $.fn.dataTable.ColVis(table4)

	$(colvis.button()).insertAfter('#colVis')
	$(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button')

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
		"sSwfPath": "<?php echo base_url()?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
	})

	$(tt.fnContainer()).insertAfter('#tableTools')
	//*initialize responsive datatable

	function dynamic()
	{
		var table4 = $('#advanced-usage').DataTable({
			"ajax": {
					"url": "<?= base_url()?>penjualan/data/ajax_data/",
					"data": null,
					"type": 'POST',
				},
				"columns": [
					{ "data": "penj_id" },
					{ "data": "user_email" },
					{ "data": "penj_nama" },
					{ "data": "penj_no_hp" },
					{ "data": "penj_alamat" },
					{
						data: "penj_total_harga", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
							return '<p style="text-align:right">'+nominal+'</p>'
						}
					},
					{
						data: "penj_dibayar", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
							return '<p style="text-align:right">'+nominal+'</p>'
						}
					},
					{
						data: "penj_sisa", render: function(data, type, full, meta)
						{
							let nominal = window.apiClient.format.rupiah(data, 'Rp. ')
							return '<p style="text-align:right">'+nominal+'</p>'
						}
					},
					{ "data": "penj_status" },
					{ "data": "penj_keterangan" },
					{
						data: "penj_id", render: (data, type, full, meta) =>
						{
							return '<div class="pull-right">'
										+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" onclick=bayar("'+full.penj_id+'|'+full.penj_total_harga+'")><i class="fa fa-edit"></i> <span>Tukar</span></button>'
									+'</div>'
						}
					},
				],
			"aoColumnDefs": [
			  { 'bSortable': false, 'aTargets': [ "no-sort" ] }
			]
		})


		var colvis = new $.fn.dataTable.ColVis(table4)

		$(colvis.button()).insertAfter('#colVis')
		$(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button')

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
			"sSwfPath": "<?php echo base_url()?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
		})

		$(tt.fnContainer()).insertAfter('#tableTools')
	}

	$('#form').submit(function(ev) {
		ev.preventDefault()

		let penj_id 	= $('#penj_id').val()
		let total_harga = $('#total_harga').val()
		total_harga 	= window.apiClient.format.splitString(total_harga, '.');
		let dibayar 	= $('#dibayar').val()
		dibayar 		= window.apiClient.format.splitString(dibayar, '.');
		let sisa 		= $('#sisa').val()
		sisa 			= window.apiClient.format.splitString(sisa, '.');
		let ajax = null
			
			ajax = window.apiClient.penjualanTambah.insertPembayaran(penj_id, total_harga, dibayar, sisa)
			.done(function(data)
			{
				$("#advanced-usage").dataTable().fnDestroy()
				$.message('Berhasil ditambahkan.','Pembayaran','success')
				dynamic()
				$('#nama').val('')
				$('#no_hp').val('')
				$('#status').val('')
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Driver','error')
			}).
			always(function() {
				$('#splash').modal('toggle')
			})
	})

	$('#dibayar').on('change', () =>
	{
		var dibayar 	= $('#dibayar').val()
		dibayar 		= window.apiClient.format.splitString(dibayar, '.');
		var total_harga = $('#total_harga').val()
		total_harga 	= window.apiClient.format.splitString(total_harga, '.');
		var sisa 		= Number(total_harga) - Number(dibayar)
		sisa 	= window.apiClient.format.splitString(sisa, '.');
		$('#sisa').val(sisa)
	})
})

function tukarDomba(id)
{
	// var res = id.split("|")
	console.log(id);
	$('#penj_id').val(id);
	$("#isi_domba").empty();
	window.apiClient.penjualanData.getDataPenjualan(id).done(function(res) {
		let no=1;
		
		$.each(res, function(value, key) {
			$("#total_harga").val(window.apiClient.format.rupiah(''+key.penj_total_harga, ''));
			$("#dibayar").val(window.apiClient.format.rupiah(''+key.penj_dibayar, ''));
			$("#sisa").val(window.apiClient.format.rupiah(''+key.penj_sisa, ''));
	  		window.apiClient.filter.referensiProdukPenjualan().done(function(res) {
				$("#domba_baru_"+key.pede_id).empty();
				$("#domba_baru_"+key.pede_id).append("<option value=''>Pilih</option>");
				$.each(res, function(value, q) {
					$("#domba_baru_"+key.pede_id).append("<option value='"+q.prod_id+"'>"+q.prod_nama+"</option>");
			  })
			}).fail(function($xhr) {
				console.log($xhr);
			});

			$("#isi_domba").append(""
				+"<tr>"
					+"<td>"+no+"</td>"
					+"<td><input type='hidden' name='pede_id[]' value='"+key.pede_id+"'><input type='hidden' name='pede_prod_id[]' value='"+key.pede_prod_id+"'><input type='hidden' name='harga_lama[]' value='"+key.pede_harga+"'>"+key.prod_nama+"</td>"
					+"<td>"+key.kela_nama+"</td>"
					+"<td>"+key.pede_harga+"</td>"
					+"<td>"
						+"<select name='domba_baru_"+key.pede_id+"' id='domba_baru_"+key.pede_id+"' class='form-control'>"
						+"</select>"
					+"</td>"
					+"<td>"
						+"<select name='kelas_baru_"+key.pede_id+"' id='kelas_baru_"+key.pede_id+"' class='form-control'>"
							+"<option value=''>Pilih</option>"
							+"<option value='1'>A</option>"
							+"<option value='2'>B</option>"
							+"<option value='3'>C</option>"
							+"<option value='4'>D</option>"
							+"<option value='6'>Istimewa</option>"
							+"<option value='7'>Super</option>"
						+"</select>"
					+"</td>"
					+"<td>"
						+"<input type='text' class='form-control' name='harga_baru_"+key.pede_id+"'>"
					+"</td>"
				+"</tr>"
			+"");
			no = no + 1;
  		});
	}).fail(function($xhr) {
		console.log($xhr);
	});
	// let total_harga = window.apiClient.format.rupiah(''+rest[1], '');
	// $('#total_harga').val(total_harga);
}