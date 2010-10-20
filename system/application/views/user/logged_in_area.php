



<div class='bodytext' style='width:940px; margin:0 20px;'>
	<?php $this->load->view($body); ?>
</div>

<?php 
if(isset($grid))
	{
		?>
		<div class="grid">
		
		<?=$this->load->view($grid)?> 
		</div>
		
	<?php }
	
	?>
	
	<div style="clear: both; height:10px;"></div>