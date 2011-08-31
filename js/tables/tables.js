$(document).ready(function() {
	$('#table_id').dataTable({
		"bStateSave": true,
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"aoColumns": [null, null, {"bSearchable": false}, {"bSearchable": false}, {"bSearchable": false}]
		
		});
} );

$(document).ready(function() {
	$('#usertable').dataTable({
		"bStateSave": true,
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"aoColumns": [null, null, {"bSearchable": false}, {"bSearchable": false}]

		});
} );
