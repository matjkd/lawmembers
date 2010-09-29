

<?php 
if(isset($grid))
	{
		?>
		<div class="grid">
		
		<?=$this->load->view($grid)?> 
		</div>
		<div class="bodytext">
	<?php }
	else
	{
		echo "<div class='bodytext' style='width:940px; margin:0 20px;'>";
	}
?>





<?php $this->load->view($body); ?>
</div>
<div style="clear: both; height:10px;"></div>