<script type="text/javascript">
jQuery(function() {
    jQuery('.wymeditor').wymeditor();
});
<?php foreach($addresses as $key => $row): ?>
<?php $addressid = $row['idaddress']?>
<?php endforeach; ?>
$(document).ready(function() {
	
	$('#view_address').load('<?=base_url()?>members/view_address/' + <?=$addressid?> );

});

</script>

<?php 
if($company_id == 0)
{
	
}
else
{
foreach($company as $key => $row): ?>

<script type="text/javascript">
	$(function() {
		$("#accordion").accordion({
			collapsible: true,
			autoHeight: false,
			navigation: true
		});
	});

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
  
    
   
   
 
});

<?php 
	    
	    endforeach;

	}
	?>
</script>