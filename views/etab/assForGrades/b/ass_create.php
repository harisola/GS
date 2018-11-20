<style>
.page-header{ display:none; }
.fa-times-circle{ display:none;}
.fa-chevron-circle-up { display:none;}
</style>

<div class="content-wrapper" style="margin: 0 10px;min-height:auto;">
	<!-- Widget Row Start grid -->
     <div class="row" id="powerwidgets dark-red">
        <div class="col-md-12 bootstrap-grid">     

<div id="assessmentGrade">

		
			<!-- New widget -->
			<div class="col-md-6 bootstrap-grid"> 
			<!-- New Category Form Submission  -->
            <div class="powerwidget dark-red" id="order-form-validation-widget2" data-widget-editbutton="false">
              <header>
                <h2> Create <small> Assessment For Grade </small></h2>
              </header>
              <div class="inner-spacer">
			  <div class="callout callout-info" id="successMsg" style="display:none;">
			  Thank you! Category Created.
			  </div>
				
                <form action="" method="post" enctype="multipart/form-data" id="createAssForm" class="orb-form">
				

			
			<input type="hidden" name="createUpdate" value="create" />
			
				<fieldset>
					<div class="row">
						<section class="col-12">
							<section class="col col-3">
							<label class="label"> Session</label>
								<!--label class="select">
							  <select name="academicSession" id="academicSession">
								<option value=""> Choose   </option>
								<option value="2"> 2016-17 </option>
								<option value="3"> 2017-18 </option>
								<option value="201415"> 2014-15 </option>
								<option value="201314"> 2013-14 </option>
							  </select>
							  <i></i> </label -->
							  <?php //print_r( $acLists ); ?>
							  <label class="select">
						    <select id="academicSession" name="academicSession">
							 <option value=""> Academic Sessions  </option>
							 <?php if(!empty( $acLists )) :?>
							 <?php foreach($acLists as $ac ) : ?>
								<?php if( $ac["branch_id"] == "1" ){ ?>
								<option value="<?=$ac["id"];?>"> North Campus<? //$ac["name"]; //$ac["branch_id"]; ?></option>
								<?php }else{ ?>
								<option value="<?=$ac["id"];?>"> South Campus<? $ac["name"]; //$ac["branch_id"]; ?></option>	
								<?php }  ?>

							 <?php endforeach; ?>
							 <?php endif; ?>
							 
							 

						  </select>
						<i></i> </label>
						
						
							</section>
							
							
						
							
							<section class="col col-3">
								<label class="label">Terms</label>
								<label class="select">
							  <select name="academicSessionTerm" id="academicSessionTerm" disabled>
								<option value=""> Choose </option>
								<!--option value="0"> All </option>
								<option value="1"> 1st Term </option>
								<option value="2"> 2nd Term </option -->
							</select>
							  <i></i> </label>
							</section>
							
							<section class="col col-3">
								<label class="label">Grade </label>
									<label class="select">
									
									 <select name="gradeName" id="gradeName" disabled>
										<option value=""> Choose  </option>
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
								
								
									<section class="col col-3">
									<label class="label"> Subjects </label>
									 <div id="gradeSections">
						
						
								<label class="select">
							  <select name="gradeSubject" id="gradeSubject">
								<option value=""> Choose </option>
								
							</select>
							  <i></i> </label>
							  
							  </div>
						</section>
						
								
								
						</section>
					</div>
				</fieldset>
				
				
					<fieldset>
				<div class="row">
					<section class="col-12">
						<section class="col col-6" id="mainCategory2">
						<label class="label">Category </label>
						<?php if(!empty($categories) ){ ?>
						<label class="select">
							<select name="mainCategory" id="mainCategory">
							<option value=""> Main Category </option>
							<?php foreach($categories as $grade ): ?>
							<?php if( $grade->id != 61 ) { ?>
								<option value="<?=$grade->id;?>"> <?=ucwords( strtolower( $grade->name ) );?> </option>
							<?php } ?>
							<?php endforeach; ?>
							</select>
						<i></i> </label>
						<?php }else ?>
						</section>
						<section class="col col-6">
							<label class="label">Weightage Available Space  </label>
<input class="form-control" type="text" id="availableSpace" value="100" style="border:0;padding:0;background:none;float: left;width: 10%;" disabled />
<input type="hidden" id="availableSpaceH" value="0" />
						</section>
						


						<?php /* ?>
					<section class="col col-6" id="subCat" disabled>
					
					<label class="label">Category Type  </label>
					<?php if(!empty($categories) ){ ?>
					<label class="select">
					<select name="subCategory" id="subCategory">
					<option value=""> Category Type </option>
					
					</select>
					<i></i> </label>
					<?php }else{ ?>
						<p>No! Sub Category For This Category</p>
					<?php } ?>
					
					</section>
					<?php */ ?>
					</section>
				</div>
			</fieldset>
			
		<fieldset>
			<div class="row">
				<section class="col-8" id="subCat">
					<table class="table table-striped table-hover margin-0px">
					<thead>
					<tr>
					<th>Ignore</th>
					<th>Sub Category</th>
					<th>Weightage </th>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td colspan="3"> No Record Found!</td>
					</tr>
					</tbody>
					</table>
				</section>
			</div>
		</fieldset>	
				
					
				<?php /* ?>
                  <fieldset>
					
					
					<div class="row">
					
					<section class="col-12">
					
					<section class="col col-6">
						<label class="label">Grade </label>
							<label class="select">
							 <select name="gradeName" id="gradeName" disabled>
								<option value=""> Choose Grade </option>
								<option value="0"> All  </option>
								<?php 
									if(!empty($grades) ):
										foreach($grades as $grade ): ?>
											<option value="<?=$grade->id;?>"> <?=$grade->dname;?> </option>
										<?php 
										endforeach;
									endif;
								?>
							  </select>
							  <i></i> </label>
							  	</section>
								
								 <div id="gradeSections">
								<section class="col col-3" style="display:none;">
								<label class="label">Grade Sections </label>
							 
							  
							<label class="select">
							 <select name="gradeSections" id="gradeSections" disabled>
								<option value=""> Choose Sections </option>
								<option value="0"> All  </option>
								
								<?php 
									if(!empty($grades) ):
										foreach($grades as $grade ): ?>
											<option value="<?=$grade->id;?>"> <?=$grade->dname;?> </option>
										<?php 
										endforeach;
									endif;
								?>
							  </select>
							  <i></i> </label>
							
						</section>
						
						
						<section class="col col-6">
						
						<label class="label"> Grade Subjects </label>
								<label class="select">
							  <select name="gradeSubject" id="gradeSubject" disabled>
								<option value=""> Choose Grade Subject </option>
								
							</select>
							  <i></i> </label>
						</section>
						
						</div>
				</section>
                      
                    </div>
					
				  </fieldset>
				  
				  
				  <!-- getCategoris-->
<style>
.callout-danger::before{ top:5px; }
.inner-spacer .callout{	margin:0; }
.callout { margin:0; min-height: 15px; }
</style>
			
				 
		  <fieldset>
		  <div class="row">
			<section class="col-12">
				<section class="col col-6">
					<label class="label">Weighate  </label>
					<label class="select">
							<select name="weightage" id="weightage">
							<option value=""> Choose Weighate</option>
								<option value="0"> Depends on grade teacher </option>
								<?php for($counter = 1; $counter <= 100; $counter+= 0.5){ ?>
									<option value="<?=$counter;?>"> <?=$counter;?> </option>
								<?php } ?>
							</select>
							<i></i> </label>
					</section>
					<section class="col col-6" id="teacherWeightage" style="display:none;">
					<div class="callout callout-info">
                     
                      <p>Teacher will adjust accordingly available weightage space for this category</p>
                    </div>
					</section>
					
				</section>
			  </div>
			  </fieldset>
			  <fieldset>
				<div class="row">
					<section class="col-12">
						<section class="col col-1"><p>2013-14 </p></section>
						<section class="col col-1"><p>1st Term </p></section>
						<section class="col col-1"><p>VII</p></section>
						<section class="col col-3"><p>ALL Sections</p></section>
						<section class="col col-3"><p> English Litereture</p></section>
						<section class="col col-3"><p> Remaining Space is 30%</p></section>
					</section>
				</div>
			  </fieldset>
			  <?php */ ?>
				<div class="message"> <i class="fa fa-check"></i> <p>Thank you ! Category Created.</p></div>
				<footer>
					<button class="createAssessmentBtn btn btn-default" type="submit" id="btnCW" disabled> Create Weightage </button>
				</footer>
		</form>
              </div>
            </div>
            <!-- /End Widget --> 
		</div>
         
</div> <!-- / end id assessmentGrade -->


