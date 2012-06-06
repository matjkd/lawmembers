$(document).ready(function() {
    $('#table_id').dataTable({
        "bStateSave": false,
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "aoColumns": [null, null, {
            "bSearchable": false
        }, {
            "bSearchable": false
        }, {
            "bSearchable": false
        }]
		
    });
} );

$(document).ready(function() {
    $('#usertable').dataTable({
        "bStateSave": false,
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "aoColumns": [null, null, {
            "bSearchable": false
        }, {
            "bSearchable": false
        }, {
            "bSearchable": false
        }]

    });
} );

$(document).ready(function() {
    $('#events_table').dataTable({
        "bStateSave": false,
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "aoColumns": [null, null, null, {
            "bSearchable": false
        }, {
            "bSearchable": false
        }, {
            "bSearchable": false
        }]

    });
} );

$(document).ready(function() {
    $('#newsletter_table').dataTable({
        "bStateSave": false,
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
         "aaSorting": [[ 0, "desc" ]]

    });
} );



