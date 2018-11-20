<div class="col-md-12"> 
  <!-- New widget -->
	<div class="dark-red powerwidget">
		<header><h2>Student Level<small>Programme option selection</small></h2></header>
		  <div class="inner-spacer">
		  <div class="row orb-form">
		  <div class="col-md-1">
			
			<section>
                      <label class="label">Grade</label>
                      <label class="select">
                       <select class="gradeID2" id="gradeID" name="gradeID">
						<option value=""> Grade </option>
						<?php
							$counter =1;
							if(!empty($grades) ):
								foreach($grades as $grade ): ?>
								<?php if($counter > 12){ ?> 
									<option value="<?=$grade->id;?>"> <?=$grade->dname;?> </option>
								<?php } ?>
								
								<?php 
								$counter++;
								endforeach;
							endif;
						?>
					  </select>
                        <i></i> </label>
						
						
						 
						
                    </section>
			<!--section id="selectedGrade"></section -->
			</div>
			<div class="col-md-1" id="loadingStudentsAjax" style="position:relative; top:35px;display:none;">
			<section>
                <img src="<?php echo base_url()?>components/image/loading-small.gif" />
				<!--img src="<?php // echo base_url()?>components/image/SIBLING_SPINNER-2.gif" style="margin-left:25%" / -->
				
				</section>
			</div>
		  <div class="col-md-10">
			<section id="gradeGroupList" style="display:none"></section>	
			
		 </div>
		 </div>
 <!--style>
 https://www.google.com/search?q=fix+table+header+postion&ie=utf-8&oe=utf-8&client=firefox-b-ab#q=fix+table+header+fixed
 </style -->
 <style>
.haswarning  {
	
	
	background: hsl(37, 100%, 94%) none repeat scroll 0 0;
	border-color: hsl(39, 97%, 58%) !important;
    box-shadow: none !important;
}

.height250 {
    height: 600px;
    overflow: auto;
}

.table > thead > tr > th{
	padding: 7px 6px;
}	


.has-success{
  background: hsl(98, 37%, 81%) none repeat scroll 0 0 !important;
    border-color: hsl(39, 96%, 58%);
    box-shadow: none;
}


</style>
 
<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script -->


<div class="col-md-1" id="loadingStudentsAjax2" style="display:none;margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.8;">
<?php /* ?><img src="<?=base_url()?>components/image/12.gif" style="margin-left:25%" /> <?php */ ?>
</div>
<!--table class="table table-striped table-hover"  style="display:none" id="studentsHeaderTable" -->
<table class="table table-striped table-hover margin-0px"  style="display:none" id="studentsHeaderTable">
<thead>
 <tr>
	<th>#</th>
	<th>GS-ID</th>
	<th>Abridge Name</th>
	<th>Group A </th>
	<th>Group B</th>
	<th>Group C</th>
	<th>Group D </th>
 </tr>	
</thead>
<tbody>
</tbody>
</table>
			  
 <div class="height250">
		  <form id="option_selection" name="option_selection" class="orb-form">
		  
		
			  
			  
		
	<!--table class="fancyTable" id="myTable01" cellpadding="0" cellspacing="0" -->
	
<!--table class="table table-striped table-hover dataTable" id="studentlist2" -->
<table class="table table-condensed table-bordered margin-0px" id="studentlist2">

	<!--thead> 
		
			<th>#</th>
			<th>GS-ID</th>
			<th>Abridge Name</th>
			<th>Group A </th>
			<th>Group B</th>
			<th>Group C</th>
			<th>Group D </th>
		
	 </thead -->
	 
		<tbody>
		
		
	  
				
			
			  </tbody>
			  
			  <tfoot>
				<tr>
				 <th>#</th>
				  <th>GS-ID</th>
				  <th> Abridge Name </th>
				  <th> Group A</th>
				  <th> Group B</th>
				  <th> Group C</th>
				  <th> Group D</th>
				</tr>
			  </tfoot>
			  
			</table>
			
			<input type="hidden" name="sessionID" id="sessionID" value="8" />
			<input type="hidden" name="term" id="term" value="1" />
			
			<input type="hidden" name="gradeID" id="gradeIDHidden" value="" />
			<input type="hidden" name="grdGroupNo" id="grdGroupNo" value="" />
			<input type="hidden" name="totalStudents" id="totalStudents" value="100" />
			<input type="hidden" name="studentsIDAr" id="studentsIDAr" value="" />
			<ul style="display:none;" id="sIDAr">
			</ul>
			</form>
			
			
		  </div></div>
	
 
		</div>
		<!-- End .powerwidget --> 
		
	   
</div>
<!-- /Inner Row Col-md-12 --> 
