$(function () {
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
			"url": "<?= base_url()?>laporan/packer/ajax_data/",
			"data": null,
			"type": 'POST',
		},
		"columns": [
			{ "data": "pack_nama" },
			{ "data": "penj_no_resi" },
			{ "data": "penj_nama" },
		],
		"aoColumnDefs": [
			{ 'bSortable': false, 'aTargets': ["no-sort"] }
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

	function dynamic(filter_tanggal_mulai, filter_tanggal_akhir, filter_packer) {
		var table4 = $('#advanced-usage').DataTable({
			"scrollX": true,
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?= base_url()?>laporan/packer/ajax_data/",
				"data":
				{
					filter_packer: filter_packer,
					filter_tanggal_mulai: filter_tanggal_mulai,
					filter_tanggal_akhir: filter_tanggal_akhir,
				},
				"type": 'POST',
			},
			"columns": [
				{ "data": "pack_nama" },
				{ "data": "penj_no_resi" },
				{ "data": "penj_nama" },
			],
			"aoColumnDefs": [
				{ 'bSortable': false, 'aTargets': ["no-sort"] }
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


	$('#filter-cari').click(function () {
		let filter_tanggal_mulai = $("#filter_tanggal_mulai").val();
		let filter_tanggal_akhir = $("#filter_tanggal_akhir").val();
		let filter_packer = $("#filter_packer").val();
		$("#advanced-usage").dataTable().fnDestroy();
		$.message('Pencarian Berhasil.', 'Laporan Penjualan', 'success');
		dynamic(filter_tanggal_mulai, filter_tanggal_akhir, filter_packer);
		$.ajax({
			method: 'post',
			url: '<?= base_url() ?>laporan/packer/getTotalResi',
			data: {
				filter_packer: filter_packer,
				filter_tanggal_mulai: filter_tanggal_mulai,
				filter_tanggal_akhir: filter_tanggal_akhir,
			}
		}).done(function (data) {
			// alert(data)
			$("#total-harga").text(window.apiClient.format.rupiah(data, 'Rp. '))
		})
	});
	$('#btn-cetak-excel').click(function () {
		const tgl_mulai = $('#filter_tanggal_mulai').val();
		const tgl_akhir = $('#filter_tanggal_akhir').val();
		const packer = $('#filter_packer').val();
		window.location.href = `<?= base_url() ?>laporan/packer/export_excel?filter_tanggal_mulai=${tgl_mulai}&filter_tanggal_akhir=${tgl_akhir}&filter_packer=${packer}`;
	})

})
