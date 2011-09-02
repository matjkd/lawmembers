<script type="text/javascript">
jQuery(function() {
    jQuery('.wymeditor').wymeditor();
});





$(document).ready(function() {
	var uid = "<?=$employee_id?>";
           $(".edit").editable("<?=site_url('/members/edit_employee')?>",
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
            
      $(".yesno").editable("<?=site_url('/members/edit_employee')?>",
    	    {
    	data   : " {'1':'Yes','0':'No', 'selected':'1'}",
     	    type   : "select",
     	    onblur : "submit",
     	    style  : "inherit",
     	    id   : 'elementid',
     	        submitdata : function()
     	        	{
     	        		return {id : uid};
   			}
    	    });

  
    
   
   
 
});


</script>