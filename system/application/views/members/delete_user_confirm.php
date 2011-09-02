<?php

    foreach($employee as  $row):

            $name = $row->firstname." ".$row->lastname;
            $id = $row->idkeypeople;

    endforeach;
 ?>

<strong>The following user will be deleted:</strong><br/>
<?=$name?><br/><br/>



<br/>
<?=form_open('members/delete_employee_confirm')?>
<?=form_hidden('id', $id)?>
<?=form_submit('submit', 'Delete '.$name.'')?>
<?=form_close()?>