<?php  foreach($address as $addressdetail): ?>	
<script>
$(document).ready(function() {
	var uid = "<?=$address_id?>";
    $(".editaddress").editable("<?=site_url('/members/edit_address')?>", 
    	    {
    	    	indicator : 'Saving...',
    	    	id   : 'elementid',
    	    	submit : 'OK',
    	    	 onblur : "submit",
    	        tooltip   : 'Click to edit...',
    	        submitdata : function() 
    	        {
    	            return {id : uid};
    }
    
        	        
    	    });

    $(".regionedit").editable("<?=site_url('/members/edit_address')?>", 
    	    {
    		data   : "{'1':'Other','2':'Europe','3':'North America','4':'Asia/Pacific','5':'South America','6':'Middle East','selected':'<?php echo $addressdetail->region;?>'}",
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


		
	<div>
	
		
<table width="260px">
<tr>
		<td class='leftcolumn'>
		Address 1
		</td>
		<td>
		 <div class='editaddress' id='address1'><?=$addressdetail->address1?></div>
		</td>
	</tr>
	
		<?php if($addressdetail->address2 == NULL)
	{
		?>
		
		<tr>
		<td class='leftcolumn'>
	Address 2
		</td>
		<td>
		 <div class='editaddress' id='address2'></div>
		</td>
	</tr>
		
		<?php 
		
		
	}
	else
	{
	?>
	<tr>
		<td class='leftcolumn'>
	Address 2
		</td>
		<td>
		 <div class='editaddress' id='address2'><?=$addressdetail->address2?></div>
		</td>
	</tr>
	<?php }?>
	
	<?php if($addressdetail->address3 == NULL)
	{
		?>
		
		<tr>
		<td class='leftcolumn'>
	Address 3
		</td>
		<td>
		 <div class='editaddress' id='address3'></div>
		</td>
	</tr>
		
		<?php 
		
		
	}
	else
	{
	?>
	<tr>
		<td class='leftcolumn'>
	Address 3
		</td>
		<td>
		 <div class='editaddress' id='address3'><?=$addressdetail->address3?></div>
		</td>
	</tr>
	<?php }?>
	<tr>
		<td class='leftcolumn'>
	Address 4
		</td>
		<td>
		 <div class='editaddress' id='address4'><?=$addressdetail->address4?></div>
		</td>
	</tr>
	
	<tr>
		<td class='leftcolumn'>
	City
		</td>
		<td>
		 <div class='editaddress' id='city'><?=$addressdetail->city?></div>
		</td>
	</tr>
	
	<tr>
		<td class='leftcolumn'>
	Country
		</td>
		<td>
		 <div class='editaddress' id='country'><?=$addressdetail->country?></div>
		</td>
	</tr>
	
	<tr>
		<td class='leftcolumn'>
	Region
		</td>
		<td>
		 <div class='regionedit' id='region'><?=$addressdetail->region?></div>
		</td>
	</tr>

<tr>
		<td class='leftcolumn'>
		Postcode
		</td>
		<td>
		 <div class='editaddress' id='Postcode'><?=$addressdetail->postcode?></div>
		</td>
	</tr>
 
<tr>
		<td class='leftcolumn'>
		Tel
		</td>
		<td>
		 <div class='editaddress' id='tel'><?=$addressdetail->tel?></div>
		</td>
	</tr>
	
	<tr>
		<td class='leftcolumn'>
		Fax
		</td>
		<td>
		 <div class='editaddress' id='fax'><?=$addressdetail->fax?></div>
		</td>
	</tr>
	
	<tr>
		<td class='leftcolumn'>
		Email
		</td>
		<td>
		 <div class='editaddress' id='email'><?=$addressdetail->email?></div>
		</td>
	</tr>


</table>
		<?php endforeach ?>
	

		
	</div>

		