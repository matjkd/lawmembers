	<script type="text/javascript">
jQuery(function() {
    jQuery('.wymeditor').wymeditor();
});
        
	$(function() {
		$( "#accordion" ).accordion({
			collapsible: true
		});
	});
	</script>
        <div id="accordion">
            
<?php foreach($searches as $row):
    // Format date here
$date_added = ($row->date_added);

$date_added = date("l, d F, Y, ga", $date_added);



    ?>
           
<h3><a href="#"><?=$row->search_title?></a></h3>
        <div>
		<p>
		   <span class="searchlabel">Added:</span><?=$date_added?><br/>
                                   <span class="searchlabel">Company: </span>   <?=$row->company_name?><br/>
                                    <span class="searchlabel">Country: </span>   <?=$row->country?><br/>
                                   <span class="searchlabel"> Member: </span><?=$row->firstname?> <?=$row->lastname?><br/>
                                    <span class="searchlabel">Email: </span>  <a href="mailto:<?=$row->people_email?>"><?=$row->people_email?></a><br/>
                                   <span class="searchlabel"> Phone Number:</span> <?=$row->tel?><br/>
                                   <span class="searchlabel"> Website:</span><a href="<?=$row->company_web?>"><?=$row->company_web?></a>
		</p>
		  <div style="clear:both; background-color:#eeeeee; padding:5px;">
                                           

                                                    <?=$row->content?>
                                            
         
                                </div>
	</div>
      
<?php endforeach ?>

        </div>
        
   