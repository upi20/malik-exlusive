$(function() {

	/* BASIC ;*/
	var responsiveHelper_dt_basic = undefined;
	var responsiveHelper_datatable_fixed_column = undefined;
	var responsiveHelper_datatable_col_reorder = undefined;
	var responsiveHelper_datatable_tabletools = undefined;
	
	var breakpointDefinition = {
		tablet : 1024,
		phone : 480
	};



	function initTable(selector) {
		return $(selector).dataTable({
			sDom: "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			autoWidth: true,
	        "oLanguage": {
			    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
			},
			preDrawCallback : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($(selector), breakpointDefinition);
				}
			},
			rowCallback: function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			drawCallback: function(oSettings) {
				responsiveHelper_dt_basic.respond();
			},
		});
	}
	initTable('#dt_basic');
	$("#dt_basic").DataTable().rows.add(window.dataSlider);
	$("#dt_basic").DataTable().draw();

	const $table = $('#dt_basic').DataTable();

	$('.edit-button').click(function() {
		$('#myModalEdit').modal();
	});

	/***  ROW FUNCTION  ***/

	function addRow(data) {
		let row = [
			data.id,
			data.name,
			data.description,
			data.stok,
			data.price,
			'<div class="pull-right">'+
				'<button class="btn btn-xs btn-primary edit-button"><i class="fa fa-edit"></i> Edit</button> '+
				'<button class="btn btn-xs btn-danger delete-button"><i class="fa fa-trash"></i> Hapus</button>'+
			'</div>'
		];
		let $node = $($table.row.add(row).draw().node());
		$node.attr('data', JSON.stringify(data));
		$node.attr('data-id', data.id);
	}


	$('.delete-button').click(function() {
		let $this = $(this);
		$.SmartMessageBox({
			title: 'Hapus Data?',
			content: 'Apakah anda yakin akan menghapus data ini?',
			buttons: '[Ya][Tidak]',
		}, function(button) {
			if(button === 'Ya') {
				console.log('menghapus data dengan id `'+$this.parents('tr').attr('data')+'`');
			}
		});
	});

	$('#form').submit(function(ev) {
		ev.preventDefault();

		let id = $('#form input[name=id]').val();
		let name = $('#name').val();
		let description = $('#description').val();
		let stok = $('#stok').val();
		let price = $('#price').val();

		let ajax = null;
		if(id == 0) {
			ajax = window.apiClient.produk.insert(name, description, stok, price)
			.done(function(data) {
				addRow(data);
			})
			.fail(function($xhr) {
				$.failMessage('Gagal menambahkan hari libur.');
			}).
			always(function() {
				$('#myModal').modal('toggle');
			});
		}
		else {
			ajax = window.apiClient.hariLibur.update(id, tanggal, keterangan)
			.done(function(data) {
				editRow(id, data);
			})
			.fail(function($xhr) {
				$.failMessage('Gagal mengubah hari libur.');
			}).
			always(function() {
				$('#myModal').modal('toggle');
			});
		}
	});

	$('#add-button').click(function(ev) {
		ev.preventDefault();

		$('#myModalLabel').html('Tambah Data Produk');
		$('#form input[name=id]').val(0);
		$('#name').val('');
		$('#description').val('');
		$('#stok').val('');
		$('#price').val('');

		$('#myModal').modal();
	});

});