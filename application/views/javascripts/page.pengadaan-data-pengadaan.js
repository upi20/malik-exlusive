 $(function() {
	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
				"url": "<?= base_url()?>pengadaan/data/ajax_data/",
				"data": null,
				"type": 'POST',
			},
			"columns": [
				{ "data": "peng_id" },
				{ "data": "peng_tanggal" },
				{ "data": "peng_keterangan" },
				{ "data": "peng_total_ekor" },
				{ "data": "peng_nomer_ekor" },
				// { "data": "peng_status" },
				// {
				// 	data: "peng_generate", render: function(data, type, full, meta)
				// 	{
				// 		if ( Number(data) == 1 ) {
				// 			return '<a style="text-align:right;" class="btn btn-xs btn-primary">Sudah</a> | <a style="text-align:right;" href="<?=base_url()?>pengadaan/data/detail/'+full.peng_id+'" class="btn btn-xs btn-primary">Detail</a>';						} else {
				// 			return '<button class="btn btn-xs btn-warning btn-ef btn-ef-5 btn-ef-5b" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" onclick=olahDomba("'+full.peng_id+'")><i class="fa fa-edit"></i> <span>Olah Domba</span></button>'
				// 		}
				// 	}
				// },
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

});

function olahDomba(id)
{
	$('#peng_id').val(id);
	$("#isi_domba").empty();
	window.apiClient.pengadaanData.getDataPengadaan(id).done(function(res) {
		let no=1;
		let nomer=0;
		$.each(res, function(value, key) {
			$("#total_harga").val(window.apiClient.format.rupiah(''+key.peng_total_harga, ''));
			$("#dibayar").val(window.apiClient.format.rupiah(''+key.peng_dibayar, ''));
			$("#sisa").val(window.apiClient.format.rupiah(''+key.peng_sisa, ''));
			for (i = 0; i < key.pend_jumlah; i++) { 

				$("#isi_domba").append(""
					+"<tr>"
						+"<td>"+no+"</td>"
						+"<td><input type='text' id='' name='no_recording_"+key.pend_id+"_"+nomer+"' class='form-control'></td>"
						+"<td><input type='hidden' name='pend_id[]' value='"+key.pend_id+"'><input type='hidden' name='kela_lama[]' value='"+key.kela_id+"'><input type='hidden' name='harga_beli[]' value='"+key.pend_harga+"'>"+key.kela_nama+"</td>"
						+"<td>"
							+"<select name='kelas_baru_"+key.pend_id+"_"+nomer+"' id='kelas_baru_"+key.pend_id+"_"+nomer+"' class='form-control'>"
								+"<option value='1'>A</option>"
								+"<option value='2'>B</option>"
								+"<option value='3'>C</option>"
								+"<option value='4'>D</option>"
								+"<option value='5'>E</option>"
								+"<option value='6'>Istimewa</option>"
								+"<option value='7'>Super</option>"
							+"</select>"
						+"</td>"
					+"</tr>"
				+"");

				nomer = nomer + 1;
				no = no + 1;
			}
  		});
	}).fail(function($xhr) {
		console.log($xhr);
	});
	// let total_harga = window.apiClient.format.rupiah(''+rest[1], '');
	// $('#total_harga').val(total_harga);
}

function myFunction(nama){
	console.log(nama);
	window.apiClient.filter.cekNoRecording(nama).done(function(res) {
		console.log(res);
	}).fail(function($xhr) {
		console.log($xhr);
	});
}