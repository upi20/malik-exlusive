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
		$(selector).dataTable({
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

	$('.edit-button').click(function() {
		$('#myModalEdit').modal();
	});

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
});