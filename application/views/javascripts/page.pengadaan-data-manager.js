 $(function() {
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
				{ "data": "peng_tanggal" },
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
				{
					data: "pend_berat", render: function(data, type, full, meta)
					{
						return data+' ( '+full.prod_special+' )';							
					}
				},
				{ "data": "supp_nama" },
				{ "data": "pend_kode_produk_alias" },
				{ "data": "peng_keterangan" },
				{ "data": "peng_status_purchasing" },
				{ "data": "peng_status_manager" },
				{
					data: "peng_id", render: function(data, type, full, meta)
					{
						if(full.peng_status_purchasing == 'terima'){
							if(full.peng_status_manager == 'menunggu'){
								return '<a style="float:right;" href="<?=base_url()?>pengadaan/data/proses/terima/'+full.peng_id+'/manager" class="btn btn-xs btn-primary">Terima</a><a style="float:right;" href="<?=base_url()?>pengadaan/data/proses/tolak/'+full.peng_id+'/manager" class="btn btn-xs btn-warning">Tolak</a>';							
							}else{
								return '';
							}
						}else{
							return '';
						}
					}
				},
			],
		"aoColumnDefs": [
		  // { 'bSortable': false, 'aTargets': [ "no-sort" ] }
		  // { 'bSortable': false, 'aTargets': [ [1, "DESC"] ] }
		],
	  "aaSorting": [[ 6, "asc" ]]
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

