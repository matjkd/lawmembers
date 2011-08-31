<?php

    foreach($company as  $row):

            $companyname = $row->company_name;
            $company_id = $row->idcompany;

    endforeach;
 ?>

<strong>The following company will be deleted:</strong><br/>
<?=$companyname?><br/><br/>

<strong>The following users will be deleted:</strong><br/>
<?php
if($employees != NULL){
    foreach($employees as  $row2):

        echo $row2['firstname']." ".$row2['lastname']."<br/>";

    endforeach;
}
 ?>

<br/>
<?=form_open('members/delete_company_confirm')?>
<?=form_hidden('idcompany', $company_id)?>
<?=form_submit('submit', 'Delete '.$company_id.'')?>
<?=form_close()?>