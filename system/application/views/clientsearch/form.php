<?=form_open('clientsearches/add_search')?>

<p>
<?=form_label('Title')?>:<br/>
<?=form_input('search_title')?>
</p>

<p>
<?=form_label('Location')?>:<br/>
<?=form_textarea('content')?>
</p>


<?=form_submit('submit', 'Submit Event!')?>
</p>