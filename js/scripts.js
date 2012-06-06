var base_url = $('#baseurl').val();
var loadergif = $('<img class="gifloader" src="' + base_url
		+ 'images/load.gif" />');

function deleteNewsletter(id) {

	var answer = confirm("Are you sure you want to delete this Newsletter?");
	if (answer) {
		$('#row_' + id).append(loadergif);
		$.post(base_url + '/newsletters/delete_newsletter/', {
			newsletter_id : id
		}, function(data) {
			$('.gifloader').remove();
			$('#row_' + id).remove();
			

		});

	} else {
		return false;
	}
}

// Modal dialog increase the default animation speed to exaggerate the effect
$.fx.speeds._default = 500;
$(document).ready(function() {
	$("#dialog").dialog({
		autoOpen : false,
		show : "fade",
		hide : "fade",
		width : "800px"
	});

	$("#opener").click(function() {
		$("#dialog").dialog("open");
		return false;
	});
});

$(document).ready(function() {
	jQuery(function() {
		jQuery('.wymeditor').wymeditor();
	});
});
