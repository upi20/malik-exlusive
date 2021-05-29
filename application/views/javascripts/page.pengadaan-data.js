$(function () {
	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"scrollX": true,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": "<?= base_url()?>pengadaan/data/ajax_data/",
			"data": null,
			"type": 'POST',
		},
		"columns": [
			{ "data": "peng_id" },
			{ "data": "supp_nama" },
			{ "data": "peng_tanggal" },
			{ "data": "kate_nama_1" },
			// { "data": "kate_nama_2" },
			// { "data": "kate_nama_3" },
			{ "data": "prod_kode" },
			{ "data": "prod_nama" },
			{
				data: "pend_jumlah", render: function (data, type, full, meta) {
					return '<p style="text-align:right;">' + data + '</p>';
				}
			},
			{
				data: "pend_harga", render: function (data, type, full, meta) {
					let nominal = window.apiClient.format.rupiah(data, 'Rp. ');
					return '<p style="text-align:right;">' + nominal + '</p>';
				}
			},
			{
				data: "pend_total_harga", render: function (data, type, full, meta) {
					let nominal = window.apiClient.format.rupiah(data, 'Rp. ');
					return '<p style="text-align:right;">' + nominal + '</p>';
				}
			},
			{ "data": "prod_berat" },
			// { "data": "supp_nama" },
			// { "data": "pend_kode_produk_alias" },
			// { "data": "pend_no_tracking" },
			// {
			// 	data: "pend_link_referensi", render: function(data, type, full, meta)
			// 	{
			// 		return '<a href="'+data+'" target="_BLANK">'+data+'</a>';							
			// 	}
			// },
			{ "data": "peng_keterangan" },
			// { "data": "peng_status_manager" },
			// {
			// 	data: "pend_id", render: function(data, type, full, meta)
			// 	{
			// 		return '<a style="float:right;" target="_BLANK"  href="<?=base_url()?>pengadaan/data/cetak/'+full.peng_id+'" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Cetak</a>';

			// 	}
			// },
		],
		"aoColumnDefs": [
			// { 'bSortable': false, 'aTargets': [ "no-sort" ] }
			// { 'bSortable': false, 'aTargets': [ [1, "DESC"] ] }
		],
		"aaSorting": [[6, "asc"]]
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

});
