<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('global/header'); ?>
<body>

<div id="header">
	<div id="header_inner">
		<div id="logo"></div>
        <div id="top_menu"><?php $this->load->view('global/menutop'); ?>	
		</div>
    </div>
</div>

<div id="mainnav">

	<div id="mainnav_inner">
        <?php $this->load->view('global/main_menu'); ?>
	</div>
</div>
	

	
    <div class="container">
 
		<div class="contents">
		<?php $this->load->view('global/warning'); ?>
        <?php $this->load->view($main); ?>
        </div>
     
  	</div>
  

<?php $this->load->view('global/footer'); ?>

</body>
</html>