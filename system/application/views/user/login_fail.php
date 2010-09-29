
<script type="text/javascript">
$(document).ready(function() { 

	$("span.spoiler").hide();

	 $('<a class="reveal">Your username or password is incorrect</a> ').insertBefore('.spoiler');

	$("a.reveal").mousemove(function(){
		$(this).parents("p").children("span.spoiler").fadeIn(2500);
		$(this).parents("p").children("a.reveal").fadeOut(600);
	});

});
</script>
<div align="center"><p><span class="spoiler"> </span></p></div>

<?php $this->load->view('user/index'); ?>
 