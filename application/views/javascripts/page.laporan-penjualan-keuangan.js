 $(function() {
 	let total_harga = 0;
	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible)
	}

	var table4 = $('#advanced-usage').DataTable({
		"scrollX": true,
		"processing": true,
		"serverSide": true,
		"ajax": {
				"url": "<?= base_url()?>laporan/penjualanKeuangan/ajax_data/",
				"data": null,
				"type": 'POST',
			},
			"columns": [
				{ "data": "supp_nama" },
				{ "data": "penj_no_resi" },
				{ "data": "penj_nama" },
				{ "data": "prod_kode" },
				{ "data": "prod_nama" },
				{ "data": "pede_harga" },
				{ "data": "pede_jumlah" },
				{ "data": "pede_total_harga" },
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

	function dynamic(filter_tanggal_mulai, filter_tanggal_akhir, filter_supplier)
	{
		var table4 = $('#advanced-usage').DataTable({
			"scrollX": true,
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?= base_url()?>laporan/penjualanKeuangan/ajax_data/",
				"data": 
				{
					filter_supplier: filter_supplier,
					filter_tanggal_mulai: filter_tanggal_mulai,
					filter_tanggal_akhir: filter_tanggal_akhir,
				},
				"type": 'POST',
			},
			"columns": [
				{ "data": "supp_nama" },
				{ "data": "penj_no_resi" },
				{ "data": "penj_nama" },
				{ "data": "prod_kode" },
				{ "data": "prod_nama" },
				{ "data": "pede_harga" },
				{ "data": "pede_jumlah" },
				{ "data": "pede_total_harga" },
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


	$('#filter-cari').click(function() {
		let filter_tanggal_mulai = $("#filter_tanggal_mulai").val();
		let filter_tanggal_akhir = $("#filter_tanggal_akhir").val();
		let filter_supplier = $("#filter_supplier").val();
		$("#advanced-usage").dataTable().fnDestroy();
		$.message('Pencarian Berhasil.','Laporan Penjualan','success');
		dynamic(filter_tanggal_mulai, filter_tanggal_akhir, filter_supplier);
		$.ajax({
			method: 'post',
			url: '<?= base_url() ?>laporan/penjualanKeuangan/getTotalHarga',
			data: {
				filter_supplier: filter_supplier,
				filter_tanggal_mulai: filter_tanggal_mulai,
				filter_tanggal_akhir: filter_tanggal_akhir,
			}
		}).done(function(data) {
			// alert(data)
			$("#total-harga").text(window.apiClient.format.rupiah(data, 'Rp. '))
		})
	});
})
