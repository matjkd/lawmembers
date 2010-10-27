<div id="popup_form" align="center">
<?=form_open('members/create_company')?>

<?=form_label('Company Name')?> <?=form_input('company_name')?><br/>

<?=form_label('Web Address')?> <?=form_input('company_web')?><br/>

<?=form_submit('submit','Submit')?>

<?=form_close()?>
</div>