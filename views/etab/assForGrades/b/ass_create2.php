	<!-- New widget -->
			<div class="col-md-6 bootstrap-grid"> 
			<!-- New Category Form Submission  -->
            <div class="powerwidget cold-grey" id="order-form-validation-widget2" data-widget-editbutton="false">
              <header>
                <h2> Create <small> Assessment For Grade </small></h2>
              </header>
              <div class="inner-spacer">
			  <div class="callout callout-info" id="successMsg" style="display:none;">
			  Thank you! Category Created.
			  </div>
				
            <form action="" method="post" enctype="multipart/form-data" id="createAssForm" class="orb-form">
			<?php
			//echo var_dump( $assessment[0]->assessment_category_id );
			//echo "Main Category". $assessment[0]->assessment_category_id;
			//var_dump($assessment);
			//print_r(array_keys($assessment, "assessment_type_id"));
			//echo array_search('assessment_type_id',$assessment);
			?>
				<fieldset>
					<div class="row">
						<section class="col-12">
							<section class="col col-3">
							<label class="label"> Session</label>
								<label class="select">
							  <select name="academicSession" id="academicSession">
								<option value=""> Choose   </option>
								<option value="2" <?php if($assessment[0]->academic_session_id == 2 ){ echo "selected"; }?>> 2016-17 </option>
								<option value="3" <?php if($assessment[0]->academic_session_id == 3 ){ echo "selected"; }?>> 2017-18 </option>
								<!--option value="201415"> 2014-15 </option>
								<option value="201314"> 2013-14 </option-->
							  </select>
							  <i></i> </label>
							</section>
							
							<section class="col col-3">
							<label class="label">Terms</label>
								<label class="select">
							  <select name="academicSessionTerm" id="academicSessionTerm">
								<option value=""> Choose </option>
								<!--option value="0"> All </option -->
								<option value="1" <?php if($assessment[0]->assessment_term_id == 1 ){ echo "selected"; }?>>  1st Term </option>
								<option value="2" <?php if($assessment[0]->assessment_term_id == 2 ){ echo "selected"; }?>> 2nd Term </option>
							</select>
							  <i></i> </label>
							</section>
							
								<section class="col col-3">
						<label class="label">Grade </label>
							<label class="select">
							 <select name="gradeName" id="gradeName">
								<option value=""> Choose  </option>
								<!--option value="0"> All  </option -->
								<?php 
									if(!empty($grades) ):
										foreach($grades as $grade ): ?>
											<option value="<?=$grade->id;?>" <?php if($assessment[0]->grade_id == $grade->id ){ echo "selected"; }?>> <?=$grade->dname;?> </option>
										<?php 
										endforeach;
									endif;
								?>
							  </select>
							  <i></i> </label>
							  	</section>
								
								
									<section class="col col-3">
									<label class="label"> Subjects </label>
									 <div id="gradeSections">
						
						
								<label class="select">
							  <select name="gradeSubject" id="gradeSubject">
								<?php 
									if(!empty($subjects) ):
										foreach($subjects as $grade ): ?>
											<option value="<?=$grade->subject_id;?>" <?php if($assessment[0]->subject_id == $grade->subject_id ){ echo "selected"; }?>> <?=$grade->subject_name;?> </option>
										<?php 
										endforeach;
									endif;
								?>
								
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
						<section class="col col-6">
						<label class="label">Category </label>
						<?php if(!empty($categories) ){ ?>
						<label class="select">
							<select name="mainCategory" id="mainCategory">
							<option value=""> Main Category </option>
							<?php foreach($categories as $grade ): ?>
							<?php if( $grade->id != 61 ) { ?>
								<option value="<?=$grade->id;?>" <?php if($assessment[0]->assessment_category_id == $grade->id ){ echo "selected"; }?>> <?=ucwords( strtolower( $grade->name ) );?> </option>
							<?php } ?>
							<?php endforeach; ?>
							</select>
						<i></i> </label>
						<?php }else ?>
						</section>
						<section class="col col-6">
							<label class="label">Weightage Available Space  </label>
					<?php $count_weightage = 0;?>
					<?php foreach( $assessmentType2 as $cat ): ?>
					<?php $count_weightage += $cat["grdweightage"];  ?>
					<?php endforeach; ?>
					<?php
						if( $count_weightage == 100 ){
							$vw = 0;
						}else{
							$vw = 100 - $count_weightage;
						}
					?>
<input class="form-control" type="text" id="availableSpace" value="<?=$vw;?>" style="border:0;padding:0;background:none;float: left;width: 10%;" disabled />
<input type="hidden" id="availableSpaceH" value="0" />

						</section>
						


					</section>
				</div>
			</fieldset>
			
		<fieldset>
			<div class="row">
			
			<?php //var_dump($assessmentType2); ?>
			<section class="col-8" id="subCat">
			
						
					<?php 
					$count_weightage = 0;
					$counterr = 0;
					$mainCatSub = $assessmentType2;
					$boolean = true;
					if(!empty($mainCatSub) ){ 
					?>
					<?php foreach( $mainCatSub as $cat ): ?>
					<?php 
						$count_weightage += $cat["grdweightage"];  
					?>
					<section class="col col-5">
					<?php if( $boolean ){ ?>
					<label class="label">Category Type  </label>
					<?php } ?>
					<strong> <?=ucwords( strtolower( $cat["astname"] ) );?></strong>
					<input type="hidden" name="subCategory[]" value="<?=$cat["astID"];?>" />
					
					<input type="hidden" name="createUpdate" value="update" />
					
					<input type="hidden" name="assessmentID[]" value="<?=$assessment[$counterr]->id;?>" />
					<?php $counterr++; ?>
					</section>
					<section class="col col-3">
					<?php if( $boolean ){ ?>
					<label class="label">Weighate  </label>	
					<?php } ?>

					<input type="hidden" value="<?=$cat["grdweightage"];?>" class="catWeighateHide" name="1" />
					<label class="select">
					<select name="weightage[]" class="weighateges">
					<option value="0">  Choose Weighate  </option>
					<?php for($counter = 1; $counter <= 100; $counter+= 0.5){ ?>
					
					<option value="<?=$counter;?>" <?php if( $cat["grdweightage"] == $counter ) echo "selected"; ?>> <?=$counter;?> </option>
					<?php } ?>
					</select>
					<i></i> </label>
					</section>
					<?php 
					$boolean = false; 
					endforeach; ?>
					<?php } ?>
					<?php // echo "Total Weightage". $count_weightage; ?>
			
			
			</section>
			</div>
		</fieldset>	
				
			
				<div class="message"> <i class="fa fa-check"></i> <p>Thank you ! Category Created.</p></div>
				<footer>
					<button class="createAssessmentBtn btn btn-default" type="submit" id="btnCW" disabled> Create Weightage </button>
				</footer>
		</form>
              </div>
            </div>
            <!-- /End Widget --> 
		</div>