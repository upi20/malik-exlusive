 $(function() {


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
			{ "data": "supp_email" },
			{ "data": "supp_telpon" },
			{ "data": "supp_no_hp" },
			{ "data": "supp_alamat" }
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


});