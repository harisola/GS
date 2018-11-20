<div class="container">
    <!-- Two column layout Start -->
<style>
.tab-content {
    float: left;
    width: 100%;
    border: 1px solid #ccc;
    border-top: 0 none;
    padding-bottom: 30px;
}
</style>
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#formIssuanceSetup" data-toggle="tab">Form Issuance</a>
				</li>
				<li class="">
					<a href="#formSubmissionSetup" data-toggle="tab">Form Submission</a>
				</li>
			</ul>
			<div class="tab-content">
				<div id="formIssuanceSetup" class="tab-pane fade in active">
					<div class="col-md-12 paddingTop20">
				    	<div class="col-md-4" style="">
				        	<div class="MaroonBorderBox">
				        		<h3>Setup Issuance</h3>
				                <div class="inner">
				                <form action="<?=base_url();?>index.php/gs_admission/admission_setup/index" method="POST" id="batchDetail">
				                	<div class="col-md-12 paddingBottom20">
				                        <div class="col-md-4 text-right"><label class="FormNo">Select Grade</label> </div>
				                        <div class="col-md-8">
				                            <select  name='grade' id='grade' required="">
				                              <option value="" disabled selected>Grade *</option>
				                              <option value="17">PG</option>
				                              <option value="1">PN</option>
				                              <option value="2">N</option>
				                              <option value="3">KG</option>
				                              <option value="4">I</option>
				                              <option value="5">II</option>
				                              <option value="6">III</option>
				                              <option value="7">IV</option>
				                              <option value="8">V</option>
				                              <option value="9">VI</option>
				                              <option value="10">VII</option>
				                              <option value="11">VIII</option>
				                              <option value="12">IX</option>
				                              <option value="13">X</option>
				                              <option value="14">XI</option>
				                              <option value="15">A1</option>
				                              <option value="16">A2</option>
				                            </select>
				                        </div>
				                    </div><!-- col-md-12 -->
				                    <div class="col-md-12 paddingBottom20">
				                        <div class="col-md-4 text-right"><label class="FormNo">Issuance Date *</label> </div>
				                        <div class="col-md-8">
				                            <input type="date" id="" name="issuance_date" placeholder="Issuance Date" required="" />
				                        </div>
				                    </div><!-- col-md-12 -->
				                    <hr />
				                    <div class="col-md-12">
				                    	<input type="submit" class="greenBTN" value="Add Issuance Date" required="" />
				                    </div><!-- col-md-12 -->
				                    </form>
				                </div><!-- inner -->
				            </div><!-- .MaroonBorderBox -->
				        </div><!-- col-md-4 -->
				        <div class="col-md-8 BatchListing">
				        	<div class="MaroonBorderBox">
				        		<h3>Issuance dates</h3>
				                <div class="inner20 paddingLeft20 paddingRight20">
				                	<div class="modal fade in" id="myModal" role="dialog">
				                        <div class="modal-dialog">
				                          
				                          
				                        </div><!-- modal-dialog -->
				                    </div><!-- modal -->

				                	<table id="IssuaceListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
				                      <thead> 
				                          <tr> 
				                              <th width="" class="text-center"><strong>Grade</strong></th> 
				                              <th width="" class="text-center"><strong>Issuance Date</strong></th> 
				                              <th width="" class="text-center"><strong>Created Date</strong></th>
				                              <th width="" class="text-center"><strong>Status</strong></th> 
				                          </tr>
				                      </thead>
				                      <tbody>
				                      	<?php if($issuance_data){ ?>
				                      	<?php  foreach ($issuance_data as $key => $value) { ?>
				                          <tr>
				                              <td class="text-center"><?php echo  $value['name']; ?></td>
				                              <td class="text-center"><?php echo  $value['date']; ?></td>
				                              <td class="text-center"><?php echo  $value['created']; ?></td>
				                              <td class="text-center"><?php echo  $value['status']; ?></td>
				                          </tr>
				                        <?php } ?>
				                        <?php } ?>
				                      </tbody> 
				                  </table><!-- StaffListing -->
				                </div><!-- inner -->
				            </div><!-- MaroonBorderBox -->
				        </div><!-- col-md-8 -->
			    	</div><!-- col-md-12 -->
				</div><!-- #formIssuanceSetup -->
				<div id="formSubmissionSetup" class="tab-pane fade">
					<div class="col-md-12 paddingTop20">
				    	<div class="col-md-4" style="">
				        	<div class="MaroonBorderBox">
				        		<h3>Setup a Batch</h3>
				                <div class="inner">
				                <form action="<?=base_url();?>index.php/gs_admission/admission_setup/formSubmissionSetup" method="POST" id="batchDetail">
				                	
				                    <div class="col-md-12 paddingBottom20">
				                        <div class="col-md-4 text-right"><label class="FormNo">Date *</label> </div>
				                        <div class="col-md-8">
				                            <input type="date" name="date" id="date" required="" />
				                        </div>
				                    </div><!-- col-md-12 -->
				                    <div class="col-md-12 paddingBottom20">
				                        <div class="col-md-4 text-right"><label class="FormNo">Start Time *</label> </div>
				                        <div class="col-md-8">
				                            <input type="time" name="start_time" id="" required="" />
				                        </div>
				                    </div><!-- col-md-12 -->
				                    <div class="col-md-12 paddingBottom20">
				                        <div class="col-md-4 text-right"><label class="FormNo">End Time *</label> </div>
				                        <div class="col-md-8">
				                            <input type="time"  name="end_time" id="" required="" />
				                        </div>
				                    </div>
				                    <!-- col-md-12 -->
				                    <div class="col-md-12 paddingBottom20">
				                        <div class="col-md-4 text-right"><label class="FormNo">No of Slots *</label> </div>
				                        <div class="col-md-8">
				                            <input type="number"  name="no_of_forms_submission" id="" required="" />
				                        </div>
				                     </div> <!-- col-md-12 -->
				                    <!-- <div class="col-md-12 paddingBottom20"> -->
				                       <!--  <div class="col-md-4 text-right"><label class="">Duration<br />per Slot *</label> </div> -->
				                        <!-- <div class="col-md-8"> -->
				                            <
				                        <!-- </div>
				 -->                    <!-- </div> --><!-- col-md-12 -->
				                    <hr />
				                    <div class="col-md-12">
				                    	<input type="submit" class="greenBTN" value="Add a Batch" />
				                    </div><!-- col-md-12 -->
				                    </form>
				                </div><!-- inner -->
				            </div><!-- .MaroonBorderBox -->
				        </div><!-- col-md-4 -->
				        <div class="col-md-8 BatchListing">
				        	<div class="MaroonBorderBox">
				        		<h3>Batches Laucnhed</h3>
				                <div class="inner20 paddingLeft20 paddingRight20">
				                	<table id="SubmissionFormListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
				                      <thead> 
				                          <tr> 
				                              <th width="" class="text-center"><strong>Submission Date</strong></th> 
				                              <th width=""><strong>Start Time</strong></th> 
				                              <th width=""><strong>End Time</strong></th>
				                              <th width="" class="text-center"><strong>No of slots</strong></th> 
				                              <th width="" class="text-center"><strong>Created Date</strong></th>
				                              <th width="" class="text-center"><strong>Status</strong></th>
				                          </tr>
				                      </thead>
				                      <tbody>
				                      	<?php if($submission_data)  {?>
				                      	<?php  foreach ($submission_data as $key => $value) { ?>
				                          <tr>
				                              <td class="text-center"><?php echo  $value['date']; ?></td> 
				                              <td class="text-center"><?php echo  $value['time_start']; ?></td>
				                              <td class="text-center"><?php echo  $value['time_end']; ?></td>
				                              <td class="text-center"><?php echo  $value['no_of_forms_submission']; ?></td>
				                              <td class="text-center"><?php echo  $value['created']; ?></td>
				                              <td class="text-center"><?php echo  $value['status']; ?></td>
				                          </tr>
				                         <?php } ?>
				                         <?php } ?>
				                        
				                      </tbody> 
				                  </table><!-- StaffListing -->
				                </div><!-- inner -->
				            </div><!-- MaroonBorderBox -->
				        </div><!-- col-md-8 -->
					</div><!-- col-md-12 -->
				</div><!-- formSubmissionSetup -->
			</div>
		</div><!-- col-md-12 -->
    </div><!-- row -->
    <!-- Two column layout END -->
</div><!-- container -->