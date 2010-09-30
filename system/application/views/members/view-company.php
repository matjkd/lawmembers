<script type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced"

});
</script>
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



