<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('global/frontendheader'); ?>
<body>







    <div class="container">

		
		<?php // $this->load->view('global/warning'); ?>
        <?php $this->load->view($main); ?>
      

  	</div>





<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>
  <script src="http://cdn.jquerytools.org/1.2.6/all/jquery.tools.min.js"></script>


<script src="<?=base_url()?>js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/frontendScripts.js" type="text/javascript"></script>
</body>
</html>