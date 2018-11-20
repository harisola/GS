<div class="col-md-12">
<style>
.nav > li > a{ padding: 10px 40px;}
</style>
<div class="col-md-12" id="firstDiv">
<div class="dark-red powerwidget">
<header><h2> Asssessment <small> Marks </small></h2></header>
<div class="inner-spacer">
<div class="col-md-12">
	<form class="orb-form" action="">
	<fieldset>
	<div class="row">

	   <section class="col col-1">
		<label class="label">Grade</label>
		 <label class="select state-success">
		  <select id="teacherGrade" name="teacherGrade">
			<option value="0">Choose name</option>
			<?php if(!empty($tchrGrds)){
				foreach($tchrGrds AS $grd ): ?>
				<option value="<?=$grd["GradeID"];?>"> <?=$grd["GradeName"];?> </option>
			<?php endforeach;
			} ?>
		  </select>
		  <i></i> </label>
		</section>
		
			
		<section class="col col-1" id="assCat">
		 <label class="label">Section</label>
		  <label class="select state-success">
		   <select id="" name="categories">
				<option value="0" selected="" >Choose</option>
				<option value="1">G</option>
				<option value="2">W</option>
				<option value="3">L</option>
			</select>
			<i></i> </label>
		</section>
		
		
		<section class="col col-2" id="subjectList">
		 <label class="label">Subject</label>
		 <label class="select state-success">
		  <select id="" name="">
			<option value="0">Choose name</option>
			<option value="33">Chemistry</option>
			<option value="36">E.Language</option>
		 </select>
		 <i></i> </label>
		</section>
		
		<section class="col col-2" id="assCat">
		 <label class="label">Category</label>
		  <label class="select state-success">
		   <select id="" name="categories">
				<option value="0" selected="" >Choose</option>
				<option value="1">Formative</option>
				<option value="2">Summative</option>
				<option value="3">ASP</option>
			</select>
			<i></i> </label>
		</section>
		
		
		<section class="col col-2" id="assCatType">
		 <label class="label">Category Type</label>
		  <label class="select state-success">
		   <select id="" name="catType">
				<option value="0" selected="" >Choose</option>
				<option value="1">Paractical</option>
				<option value="2">Class Work</option>
				<option value="3">Quiz</option>
			</select>
			<i></i> </label>
		</section>
		
			
		<section class="col col-4" id="assCatType">
		   <table class="table table-striped table-hover margin-0px">
                  <thead>
                    <tr>
					  <th>Start date</th>
                      <th>Assessment Title</th>
                      <th>Min Marks</th>
                      <th> Mix Marks</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>12.07.2016</td>
                      <td>Paractical One</td>
                      <td>2</td>
                      <td>10</td>
                    </tr>
				 </tbody>
                </table>
             
	
		</section>
	</div>
	</fieldset>
	
	<fieldset>
	<div class="row">
		<section class="col col-11">
	 <h3> Grade Section's Students </h3> 
	 <br />
                <table class="table table-condensed table-bordered margin-0px">
                  <thead>
                    <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
					  <th>Gender</th>
                      <th>Obtain Marks</th>
                     
                    </tr>
                  </thead>
                  <tbody>
				  <?php for( $acounter = 1; $acounter <10; $acounter++ ) { ?>
                    <tr>
                      <td>Calvin</td>
                      <td>Klein</td>
					  <td> B </td>
                      <td>
						<label class="select state-success">
						<select id="" name="catType">
						<option value="0" selected="" >Marks</option>
						<?php for($a =2; $a<11; $a++ ){?>
						<option value="<?=$a;?>"><?=$a;?></option>	
						<?php } ?>
						</select>
						<i></i> </label>
					  </td>
                    </tr>
				  <?php } ?>
					</tbody>
                </table>
             </section> 
			 
	</div>
	</fieldset>
</form>
</div>
<div class="col-md-12">
<div class="orb-form">

<!--fieldset>
<div class="row">
<section class="col col-6">
	<label class="input"> <i class="icon-append fa fa-calendar"></i>
		<input type="text" placeholder="Start date" id="start" name="start" class="hasDatepicker">
	</label>
</section>
<section class="col col-6">
	<label class="input"> <i class="icon-append fa fa-calendar"></i>
	<input type="text" placeholder="Expected finish date" id="finish" name="finish" class="hasDatepicker">
	</label>
</section>
</div>
</fieldset -->
</div>	  
</div>	
</div>
</div>
</div>
</div>