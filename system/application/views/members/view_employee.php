<?=$this->load->view('js/view-employee')?>
<?=$this->load->view('members/employee_controls')?>
<?php  foreach($employee_detail as $employee): ?>
<div style="float:left; width:300px;">
				<div class="formfield">
						 <div class="leftcolumn">First Name:</div>
						 <div  id='firstname'><?=$employee->firstname?></div>
						 <div style="clear:both;"></div>
				</div>

				<div class="formfield">
						 <div class="leftcolumn">Last Name:</div>
						 <div id='lastname'><?=$employee->lastname?></div>
						 <div style="clear:both;"></div>
				</div>

                                 <div class="formfield">
						 <div class="leftcolumn">Username:</div>
						 <div  id='username'><?=$employee->username?></div>
						 <div style="clear:both;"></div>
				</div>

				<div class="formfield">
						 <div class="leftcolumn">Job Title:</div>
						 <div id='jobtitle'><?=$employee->jobtitle?></div>
						 <div style="clear:both;"></div>
				</div>

				<div class="formfield">
						 <div class="leftcolumn">Tel:</div>
						 <div  id='people_tel'><?=$employee->people_tel?></div>
						 <div style="clear:both;"></div>
				</div>

				<div class="formfield">
						 <div class="leftcolumn">Mob:</div>
						 <div  id='people_mobile'><?=$employee->people_mobile?></div>
						 <div style="clear:both;"></div>
				</div>
				<div class="formfield">
						 <div class="leftcolumn">Email:</div>
						 <div  id='people_email'><?=$employee->people_email?></div>
						 <div style="clear:both;"></div>
				</div>


                               





</div>
<div style="float:right;">
<img width="100" height="100" src="http://www.laworld.com/admin/images/profiles/thumbs/<?=$employee->profile_photo?>">



<br/>



	



</div>




<div style="clear:both;"></div>
	

	<?php


		echo $employee->people_resume;


?>
	
<?php endforeach; ?>