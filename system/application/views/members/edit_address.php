<script>
$(document).ready(function() {
	var uid = "<?=$address_id?>";
    $(".editaddress").editable("<?=site_url('/members/edit_address')?>", 
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

<?php  foreach($address as $addressdetail): ?>	
		
	<div>
	
		
<table>
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
		 <div class='editaddress' id='address2' style="color:#cccccc;"></div>
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
		 <div class='editaddress' id='address3' style="color:#cccccc;"></div>
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
		 <div class='editaddress' id='region'><?=$addressdetail->region?></div>
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
 

</table>
		<?php endforeach ?>
	

		
	</div>

		