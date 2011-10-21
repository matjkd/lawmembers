	<script type="text/javascript">
jQuery(function() {
    jQuery('.wymeditor').wymeditor();
});
        </script>

<?php foreach($searches as $row):
    // Format date here
$date_added = ($row->date_added);

$date_added = date("l, d F, Y, ga", $date_added);



    ?>
        <div style="background-color: #dddddd; padding:10px; margin-bottom:5px;">       
<h1><?=$row->search_title?></h1>
        <div style="float:left; width:400px; margin-bottom:10px; height:80px;">

<?=$date_added?>

        </div>
        
              <div style="float:left; width:400px; margin-bottom:10px; height:80px;">
Company details etc here

        </div>
        <div style="clear:both; background-color:#eeeeee; padding:5px;">
                    <p>
                    <h3>Business Opportunity</h3>
               <?=$row->content?>
            </p>
         
        </div>
        </div>
<?php endforeach ?>