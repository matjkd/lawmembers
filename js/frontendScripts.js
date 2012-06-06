
function hoverMenu(menu) {

	$(menu).hover(function() {
		$(this).stop(true, true).animate({
			backgroundColor: '#ccc'
		});
	}, function() {
		$(this).stop(true, true).animate({
			backgroundColor: '#ddd'
		});
	});

}

$(document).ready(function() {
	
	hoverMenu('.newsletterbox');
	
});