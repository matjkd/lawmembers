
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

//gallery image mouse overs
$(document).ready(function() {
    $(".thumbnails").hover(
        function() {
            $(this).stop().animate({
                opacity:0.5
            },
            300
            );
        },
        function () {
            $(this).stop().animate({
                opacity:1.0
            },
            300
            );
        })

       
    
    
});
$(function() {
 	
    $(".sortable").sortable({
        update: function(event,ui)
        {
            $.post(base_url + "admin/sort_gallery", {
                pages: $('.sortable').sortable('serialize')
            } );
        }
    });
    $(".sortable").disableSelection();
	 	
  	
});

//overlay
$(document).ready(function() {



    $("img[rel]").overlay();
});