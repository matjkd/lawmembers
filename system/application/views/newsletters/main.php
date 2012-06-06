<?php if($this->session->userdata('user_level') < 2 ) { ?>
<?=$this->load->view('newsletters/add_newsletter')?>

<hr/>
<?php } ?>
<?=$this->load->view('newsletters/list_newsletters')?>
