<?php
if ($this->session->flashdata('conf_msg'))
{
?>

<script type="text/javascript">
$(document).ready(function() { 

	$("span.spoiler").hide();

	 $('<a class="reveal"><?=$this->session->flashdata('conf_msg')?></a> ').insertBefore('.spoiler');

	$("a.reveal").mousemove(function(){
		$(this).parents("message").children("span.spoiler").fadeIn(2500);
		$(this).parents("message").children("a.reveal").fadeOut(600);
	});

});
</script>
<div align="center" >
	<message>
		<span class="spoiler"> </span>
	</message>
</div>
<?php } ?>