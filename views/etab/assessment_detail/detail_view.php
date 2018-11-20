<div class="col-md-12">
<style>
/*.nav > li > a{ padding: 10px 40px;}*/
</style>
<div class="col-md-12" id="firstDiv">
<div class="dark-red powerwidget">
<header><h2> Asssessment <small> Detail </small></h2></header>
<div class="inner-spacer">
<div class="col-md-12">
	<input type="hidden" name="user_id" id="user_id" value="<?=$user_id;?>" />
	<input type="hidden" name="sessionID" id="sessionID" value="<?=$sessionID;?>" />
	<fieldset>
	<div class="row orb-form">
	   <section class="col col-1">
		<label class="label">Grade</label>
		 <label class="select state-success">

		  
			<select name="gradeName" id="gradeName">
			<option value=""> Choose  </option>
			<!--option value="0"> All  </option -->
			<?php
			/*$counter =1;
			if(!empty($grades) ):
			foreach($grades as $grade ): ?>
			<option value="<?=$grade->id;?>"> <?=$grade->dname;?> </option>
			<?php 
			//$counter++;
			endforeach;
			endif;*/
			
			$counter =1;
			if(!empty($grandGrades) ):
			foreach($grandGrades  AS $key => $value ): ?>
			<option value="<?=$key;?>"> <?=$value;?> </option>
			<?php 
			//$counter++;
			endforeach;
			endif;
			?>
						</select>
		  <i></i> </label>
		</section>
		<section class="col col-2" id="subjectList">
		 <label class="label">Subject</label>
		
		 
<div id="gradeSections">
<label class="select">
<select name="gradeSubject" id="gradeSubject">
<option value=""> Choose </option>
</select>
<i></i> </label>
</div>
		</section>
		
			<section class="col col-2" id="assCat">
		 <label class="label">Category</label>
		  <label class="select state-success">
		   <select id="" name="categories">
				<option value="0" selected="" >Choose</option>
			
			</select>
			<i></i> </label>
		</section>
		
				
	<section class="col col-2" id="assCatType">
		 <label class="label">Category Type</label>
		  <label class="select state-success">
		   <select id="" name="catType">
				<option value="0" selected="" >Choose</option>
				
			</select>
			<i></i> </label>
		</section>
		
	</div>
	</fieldset>


</div>
<div class="col-md-12">
<div class="orb-form">

<div class="row">
<section class="col col-10" id="grdSections">
<!--label class="input"> <i class="icon-append fa fa-calendar"></i>
	<input type="text" name="date[]" class="date">
  </label -->
</section>
</div>


</div>	  
</div>	
</div>
</div>
</div>
</div>