	<!-- New widget -->
			<div class="col-md-6 bootstrap-grid"> 
			<!-- New Category Form Submission  -->
            <div class="powerwidget cold-grey" id="order-form-validation-widget2" data-widget-editbutton="false">
              <header>
                <h2> Update <small> Assessment For Grade </small></h2>
              </header>
              <div class="inner-spacer">
			  <div class="callout callout-info" id="successMsg" style="display:none;">
			  Thank you! Category Created.
			  </div>
				
            <form action="" method="post" enctype="multipart/form-data" id="createAssForm" class="orb-form">
		
		<input type="hidden" id="programID" value="<?=$programID["id"];?>" name="programID" />
				<fieldset>
					<div class="row">
						<section class="col-12">
							<section class="col col-3">
							<label class="label"> Session</label>
								<input type="hidden" id="session_id" value="<?=$session2["id"];?>" name="session_id" />
								<label class="label"><?=$session2["name"];?></label>
							</section>
							
							<section class="col col-3">
							<label class="label">Terms</label>
								<input type="hidden" id="term_id" value="<?=$term;?>" name="term_id" />
								<label class="label">
								<?php if( $term == 1 ){
									echo "First Term";
								}else{
									echo "Second Term";
								} ?>
								</label>
							</section>
							
								<section class="col col-3">
									<label class="label">Grade </label>
									<input type="hidden" id="grade_id" value="<?=$grade2["id"];?>" name="grade_id" />
									<label class="label"><?=$grade2["name"];?></label>
								</section>
								<section class="col col-3">
									<label class="label"> Subjects </label>
									<input type="hidden" id="subject_id" value="<?=$subject2["id"];?>" name="subject_id" />
									<label class="label"><?=$subject2["dname"];?></label>
									<?php //var_dump( $subject2 ); ?>
								</section>
						
								
								
						</section>
					</div>
				</fieldset>
				
				
					<fieldset>
				<div class="row">
					<section class="col-12">
						<section class="col col-6">
							<label class="label">Category </label>
							<input type="hidden" id="category_id" value="<?=$category2["id"];?>" name="category_id" />
									<label class="label"><?=$category2["dname"];?></label>
									<?php //var_dump( $category2 ); ?>
						</section>
						
						<section class="col col-6">
							<label class="label">Weightage Available Space  </label>
							<?php if( !empty( $alreadyID ) ){ 
							//var_dump( $alreadyID ); ?>
							
							<?php $count_weightage = 0;?>
							<?php foreach( $alreadyID as $cat ): ?>
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

							<?php } ?>

						</section>
						


					</section>
				</div>
			</fieldset>
			
		<fieldset>

			
			
			      <!--Panel-->
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-title pull-left">Category <small>Type</small></div>
                
                <div class="clearfix"></div>
              </div>
			  
              <div class="panel-body"> 
			  <input type="hidden" value="1" class="updateBlockIDs" id="updateBlockIDs" />
			  <table class="table table-condensed table-bordered margin-0px">
			  <tr style="text-algin:center;font-weight:bold;">
				<td> # </td>
				<td> Category Title </td>
				<td> Weightage </td>
			  </tr>
			  <?php if(!empty($alreadyID) ){  ?>
			  <?php $counter = 0; $locked = 0; 
			  
				//echo $alreadyID[$counter]["detailID"];
				$count =1;
			  ?>
					<?php foreach( $alreadyID as $cat ): ?>
					
					<?php
						$trClass = "";
						$gpaid = 0;
						$menedatory = "";
						if( $cat["block"] == 1 ){
							$trClass = "danger";	
							$gpaid = $cat["gpaid"];
							$menedatory = "*";
						}elseif( $cat["block"] == 2 ) {
							$trClass = "success";
							$gpaid = $cat["gpaid"];
							$menedatory = "";
						}else  {
							$trClass = "";
							$gpaid =0;
							$menedatory = "";
						}
					?>
					
					<tr class="<?=$trClass;?>">
					<td><?=$count;?></td>
					<td><strong> <?=ucwords( strtolower( $cat["name"] ) );?> <?=$menedatory;?> </strong></td>
					<input type="hidden" name="subCategory[]" value="<?=$cat["id"];?>" />
					<input type="hidden" value="<?=$cat['program_id'];?>" name="program_id[]" id="program_id" />
					<input type="hidden" value="<?=$gpaid;?>" name="idforupdation[]" />
					
					<td>
					<input type="hidden" value="<?=$cat["grdweightage"];?>" class="catWeighateHide" name="1" />
					<input type="hidden" value="<?=$cat["block"];?>" class="blockIDs" />
					<input type="hidden" value="<?=$cat["block"];?>" name="blockidforupdation[]" />
					
					<label class="select">
					<select name="weightage[]" class="weighateges">  
					<option value="0"> Weightage </option>
					<?php for($counter = 1; $counter <= 100; $counter+= 0.5){ ?>
						<option value="<?=$counter;?>" <?php if( $cat["grdweightage"]== $counter) echo "selected"; ?>> <?=$counter;?> </option>
					<?php } ?>
					</select>
					<i></i> </label>
					
					</td>
					</tr>
					<?php 
					$count++;
					endforeach; ?>
					<?php } ?>
					</table>
					<?php // echo "Total Weightage". $count_weightage; ?>
              
				
				
				</div>
            </div>
            <!--/Panel-->
			
			
		</fieldset>	
			
				<div class="message"> <i class="fa fa-check"></i> <p>Thank you ! Category Created.</p></div>
				<footer>
					<button class="updateAssessmentBtn btn btn-default" type="submit" id="btnCW"> Create Weightage </button>
				</footer>
		</form>
              </div>
            </div>
            <!-- /End Widget --> 
		</div>