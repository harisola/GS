<div class="col-md-12"> 
  <!-- New widget -->
	<div class="dark-red powerwidget">
		<header><h2>Student Level<small>Programme option selection</small></h2></header>
		  <div class="inner-spacer">
		  <div class="row orb-form">
		  <?php //var_dump( $sessions  ); ?>
		   <div class="col-md-1">
		   		<section>
				  <label class="label">Session</label>
                    <label class="select">
					<select name="sessionID" id="sessionID">
					<option value="">Academic Session</option>
					<?php 
					//echo $this->SubjectList;
					if( !empty($sessions) ){ 
					foreach($sessions as $ac ){  
					if( $ac["branch_id"] == "1" ){ ?>
						<option value="<?=$ac["id"];?>"> North Campus<? //$ac["name"]; //$ac["branch_id"]; ?></option>
					<?php }else{ ?>
						<option value="<?=$ac["id"];?>"> South Campus<? $ac["name"]; //$ac["branch_id"]; ?></option>	
					<?php }
					 }
					}
					?>
					</select>
					<i></i> </label>
					</section>
		   </div>

		   
		  <div class="col-md-1">
			
	
					
			<section>
                      <label class="label">Grade</label>
                      <label class="select">
                       <select class="gradeID2" id="gradeID" name="gradeID" disabled>
				
						
							<option value=''> Choose  Grade </option>
		<!--option value="0"> All  </option -->
		<optgroup label="North Campus" id="northCampusGrades">
		<?php 
			$counter =1;
			
			if(!empty($grades) ):
				foreach($grades as $grade ): ?>
				
				<?php if( $counter < 6 ) { ?>
				
					<option value="<?=$grade->id;?>"> <?=$grade->dname;?> </option>	
					
				<?php } ?>
				 
				<?php 
				$counter++;
				endforeach;
			endif;
		 ?>
		 </optgroup>
		 
		 <optgroup label="South Campus" id="southCampusGrades" style="display:none;">
		<?php 
			$counter2 =1;
			
			if(!empty($grades) ):
				foreach($grades as $grade ): ?>
				
				<?php if( $counter2 > 5 ) { ?>
					<option value="<?=$grade->id;?>"> <?=$grade->dname;?> </option>	
				<?php } ?>
				
				<?php 
				$counter2++;
				endforeach;
			endif;
		 ?>
		  </optgroup>
		  
		  
					  </select>
                        <i></i> </label>
					</section>
			<!--section id="selectedGrade"></section -->
			</div>
			<div class="col-md-1" id="loadingStudentsAjax" style="position:relative; top:35px;display:none;">
			<section>
                <img src="<?php echo base_url()?>components/image/loading-small.gif" />
			</section>
			</div>
		  <div class="col-md-10">
			<section id="gradeGroupList" style="display:none"></section>	
		 </div>
		 </div>
		 
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
<style>
.thtext{
	text-align:center;
	background: #858689 none repeat scroll 0 0;
	border:0 !important;
    color: #ffffff;
    font-size: 0.87em;
    font-weight: 700;
    letter-spacing: 1px;
   
    text-transform: uppercase;
}

</style>
<script>

</script>
  <form id="option_selection2" name="option_selection2" class="orb-form">

<table class="table table-condensed table-bordered margin-0px"  style="display:none" id="studentsHeaderTable">
	<thead>
	</thead>
	<tbody>
	</tbody>
</table>
</form>			  
 <!--div class="height250" -->
		
		
			  
			  
		
	<!--table class="fancyTable" id="myTable01" cellpadding="0" cellspacing="0" -->
	
<!--table class="table table-striped table-hover dataTable" id="studentlist2" -->
<table class="table table-condensed table-bordered margin-0px" id="studentlist2">

	<thead>
	</thead>
	<tbody>
	</tbody>

</table>

<?php 
//var_dump( $sessionsTerm  );
//var_dump( $term  );


if( !empty( $sessionsTerm ) ){
$counter = 1;
//foreach($sessions as $s ){?>
	<?php /* ?> <input type="hidden" name="sessionID[]" id="sessionID_<?=$counter;?>" value="<?=$s["id"];?>" /> <?php */ ?> 
	<input type="hidden" name="sessionID[]" id="sessionID_<?=$sessionsTerm;?>" value="<?=$sessionsTerm;?>" />
<?php //$counter++; }
}else{?>
<input type="hidden" name="sessionID" id="sessionID" value="0" />
<?php } ?>

		
			<input type="hidden" name="term" id="term" value="<?=$term;?>" />
			
			<input type="hidden" name="gradeID" id="gradeIDHidden" value="" />
			<input type="hidden" name="grdGroupNo" id="grdGroupNo" value="" />
			<input type="hidden" name="totalStudents" id="totalStudents" value="100" />
			<input type="hidden" name="studentsIDAr" id="studentsIDAr" value="" />

			
			
		  <!--/div -->
		  
		  
		  </div>
	
 
		</div>
		<!-- End .powerwidget --> 
		
	   
</div>