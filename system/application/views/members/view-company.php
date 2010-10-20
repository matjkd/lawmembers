<script type="text/javascript">
jQuery(function() {
    jQuery('.wymeditor').wymeditor();
});
</script>

<?php foreach($company as $key => $row): ?>

<script type="text/javascript">
	$(function() {
		$("#accordion").accordion({
			collapsible: true,
			autoHeight: false,
			navigation: true
		});
	});
</script>

<script>
$(document).ready(function() {
	var uid = "<?=$company_id?>";
    $(".edit").editable("<?=site_url('/members/edit_company')?>", 
    	    {
    	    	indicator : 'Saving...',
    	    	id   : 'elementid',
    	    	submit : 'OK',
    	        tooltip   : 'Click to edit...',
    	        submitdata : function() 
    	        	{
    	            	return {id : uid};
  				  	}
            	        
    	    });

    $(".yesno").editable("<?=site_url('/members/edit_company')?>", 
    	    {
    	data   : " {'1':'Yes','0':'No', 'selected':'<?php echo $row->active;?>'}",
     	    type   : "select",
     	    onblur : "submit",
     	    style  : "inherit",
     	    id   : 'elementid',     
     	        submitdata : function() 
     	        	{
     	        		return {id : uid};
   					}
    	    });
    <?php endforeach; ?>
    
   
   
 
});
</script>


<div class="demo">
	<div id="accordion">
	<?php $this->load->view("members/company_detail"); ?>
	<h3><a href="#">Employees</a></h3>
	<div>
		
	<?php $this->load->view("members/ajaxemployees"); ?>
		
	</div>
	
	


	</div>
	
</div>
<hr></hr>



