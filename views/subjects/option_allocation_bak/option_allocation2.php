<div class="col-md-12"> 
  <!-- New widget -->
	<div class="dark-red powerwidget">
		<header><h2>Student Level<small>Programme option selection</small></h2></header>
		  <div class="inner-spacer">
		  <div class="row orb-form">
		  <div class="col-md-12">
		  
			<?php if(!empty( $gradesID )){
				$gradesID = $gradesID;
			}else{
				$gradesID = 0;
			}?>
			<section class="col-md-4">
			
			<section class="col-md-5">
			<label class="label">Grade</label>
			<label class="select">
			<select id="gradeID2" name="gradeID">
			<option value=""> Grade </option>
			<?php
				$gradeName = '';
				$counter =1;
				if(!empty($grades) ):
					foreach($grades as $grade ): 
					if( $gradesID == $grade->id ){ $gradeName = $grade->dname; }
					?>
					<?php if( $grade->id > 12 ){?>
					<option value="<?=$grade->id;?>" <?php if( $grade->id == $gradesID ){ echo "selected"; } ?>> <?=$grade->dname;?> </option>
					<?php } ?>
					<?php 
					$counter++;
					endforeach;
				endif;
			?>
			</select>
			<i></i> </label>
			</section>
			
			<?php //$subjectID; ?>
			<section class="col-md-5">
			<label class="label">Optional Subjects</label>
			<label class="select">
			<select id="optionalSubjects" name="optionalSubjects">
			<option value=""> Grade </option>
			<?php
				$counter =1;
				if(!empty($optSubjects) ):
					foreach($optSubjects as $grade ): 
					
					if( $subjectID == $grade['id'] ){
						$subjectname = $grade['name'];
					}
					?>
					<option value="<?=$grade['id'];?>" <?php if( $grade['id'] == $subjectID ){ echo "selected"; } ?>> <?=$grade['name'];?> </option>
					<?php 
					//$counter++;
					endforeach;
				endif;
			?>
			</select>
			<i></i> </label>
			</section>
			
			
			</section>
			
			<div style="display:none;">
				<?php echo $ulList; ?>
			</div>
			
		  
		  
			<section class="col-md-7">
			<section class="col-md-6">
			<!--form class="orb-form" -->
				<table class="orb-form">
					<tr><td>Students :</td><td>
					<?php
					
						if( !empty($countStudents ) ) {
							echo $countStudents;
							$countStudents2 = $countStudents;
						}else{
							$countStudents2 =0;
						}
							
					?>
					</td>
					</tr>
					<tr><td>Total Groups : </td><td>
						
							<section class="col col-3">
                        <label class="input">
                          <input type="text" name="groupBlockNo" id="groupBlockNo" value="<?=$totalBlock;?>" />
                        </label>
                      </section>
						
					<?php
						if( isset( $gradesID ) ){
							$gradesID  = $gradesID;
						}else{
								$gradesID  = 0;
						}
						
						if( isset( $group ) ){
							$groupID  = $group;
						}else{
								$groupID  = 0;
						}
						
						if( isset( $subjectID ) ){
							$subjectID  = $subjectID;
						}else{
								$subjectID  = 0;
						}
							
						
						
						
					?>					
					
					  <input type="hidden" name="gradesID" id="gradesID" value="<?=$gradesID;?>" />
					  <input type="hidden" name="groupID" id="groupID" value="<?=$groupID;?>" />
					  <input type="hidden" name="subjectID" id="subjectID" value="<?=$subjectID;?>" />
					  <input type="hidden" name="totalStudents" id="totalStudents" value="<?=$countStudents2;?>" />
					  <input type="hidden" name="sessionID" id="sessionID" value="8" />
					 <input type="hidden" name="term" id="term" value="1" />
					 
					  
					  <input type="submit" name="submit" id="createBlock" value="Create Blocks" class="btn" />
					  
					  <div class="col-md-1" id="loadingStudentsAjax2" style="display:none;margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.8;">
					  
						<p id="errormsg" style="display:none;">Number must be under then 5 </p>

						</td>
					</tr>
					
				</table>
				<!--/form -->
				</section>
			<section class="col-md-4">
			<!--section class="col-md-5"   -->
			
			<div class="box" id="ParentContainer">
			<?php
				echo $blockHTML;
			?>
			</div>
			</section>
		
		  
		  
			</section>
		
		 
			
			
			</div>
			
		  <style>
		  .content-wrapper{
			  min-height:0px;
		  }
		  * html .box { 
	position: absolute;
}
.box{
	top: 180px;
	margin: 67px 0 0 -143px;
	
    width:300px;
    position: fixed;
    /*overflow: scroll;  or hidden */
}

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
		 
	<div class="col-md-6 inner-spacer" role="content">
	
		<table class="table table-striped table-hover"  style="display:block" style="width:100%" id="tbleStdLst">
				<thead>
					<tr>
						<th width="15%">ID</th>
						<th width="68%">Full Name</th>
						<th width="20%">GS-ID</th>
						<th width="20%">Group</th>
					</tr>	
				</thead>
			<tbody>
			
			</tbody>
		 </table>

 <div class="height250">
   <form id="option_selection" name="option_selection" class="orb-form">
	<?php 
		echo $student;
	?>
	</form>        
</div>
			</div>
		 </div>

 
<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script -->



<?php /* ?><img src="<?=base_url()?>components/image/12.gif" style="margin-left:25%" /> <?php */ ?>
</div>
<!--table class="table table-striped table-hover"  style="display:none" id="studentsHeaderTable" -->

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

</div>
	
 
		</div>
		<!-- End .powerwidget --> 
		
	   
</div>
<!-- /Inner Row Col-md-12 --> 
