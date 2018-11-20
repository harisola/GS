<div class="container" id="FollowUpScreen">
<?php

	if(!empty($ConfirmAdmission) ){
		$count_ConfirmAdmission = count( $ConfirmAdmission );
	}else{
		$count_ConfirmAdmission =0;
	}
	
	if(!empty($Not_Interested) ){
		$count_Not_Interested = count( $Not_Interested );
	}else{
		$count_Not_Interested=0;
	}
	if(!empty($Regret) ){
		$count_Regret = count( $Regret );
	}else{
		$count_Regret=0;
	}
	if(!empty($All_Applications) ){
		$count_All_Applications = count( $All_Applications );
	}else{
		$count_All_Applications=0;
	}
		if(!empty($RequestForGrade) ){
		$count_RequestForGrade = count( $RequestForGrade );
	}else{
		$count_RequestForGrade=0;
	}

		
?>
    <!-- Two column layout Start -->
	<div class="row">
    	<div class="col-md-12">
        	<h2 class="withBorderBottom">Overview Admission forms</h2>
        </div><!-- col-md-12 -->
    	<div class="col-md-12" id="leftSide">
        	<div class="MaroonBorderBox">
        		<h3>Applicants List</h3>
				
                <div class="inner20 paddingLeft20 paddingRight20" id="paddingRight20">
             
					<ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#ConfirmListing">Confirm Admissions (<?=$count_ConfirmAdmission;?>)</a></li>
                        <li><a data-toggle="tab" href="#NotInterestedListing">Not Interested (<?=$count_Not_Interested;?>)</a></li>
                        <li><a data-toggle="tab" href="#RegretListing">Regret (<?=$count_Regret;?>)</a></li>
						<li><a data-toggle="tab" href="#RequestForGrade">Request For Grade (<?=$count_RequestForGrade;?>)</a></li>
                        <li><a data-toggle="tab" href="#AllApplicants">All Applicants (<?=$count_All_Applications;?>)</a></li>
                     </ul><!-- nav-tabs -->
                    <div class="tab-content">
                        <div id="ConfirmListing" class="tab-pane fade in active">
                        	<!--div class="col-md-6" style=" position: absolute;right: 0;top: -51px;width: 200px;">
                            	<select required class="">
                                  <option value="" disabled selected>Filter list by Current Standing</option>
                                  <option value="">Assessment Only</option>
                                  <option value="">Assessment & Discussion</option>
                                  <option value="">Discussion Only</option>
                                  <option value="">Offer</option>
                                  <option value="">Billing</option>
                                </select>
								<?php //var_dump($ConfirmAdmission); ?>
                            </div --><!-- absoluteDrop -->
							
                          	<table id="confirmAdmissionTable2" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                              <thead> 
                                  <tr> 
                                      <th width="" class="text-center">Form #</th> 
                                      <th width="">Applicant Name<br /><small>Submission Date</small></th> 
                                      <th width="">Father Name<br /><small>Father/Mother Mobile</small></th> 
                                      <th width="" class="text-center no-sort">Batch ID - Grade</th>
                                      <th width="" class="text-center">Current Status</th>
                                  </tr>
                              </thead>
							  	<tfoot>
								<tr>
								<td colspan="5">Filter list by Current Standing</td>
								</tr>
								
								</tfoot>
								
								
								
                              <tbody> 
							  <?php if(!empty($ConfirmAdmission)){
								  foreach( $ConfirmAdmission as $ca ){ ?>
									   <tr >
                                      <td class="text-center"><?php echo str_pad( $ca["form_no"],4,"0",STR_PAD_LEFT); ?></td>
                                      <td><a href="#" class="confirm_admission" data-id="confirmAdmission_<?=$ca["form_id"];?>" >
									  <?=$ca["official_name"];?></a><br /><small><?=$ca["form_submission_date"];?></small></td>
                                      <td><?=$ca["father_name"];?><br /><small><?=$ca["father_mobile"];?> / <?=$ca["mother_mobile"];?></small></td>
                                     <td class="text-center"><?=$ca["final_batch_slot"];?> - <?=$ca["grade_name"];?></td>
									  

                                   <td class="text-left"><?php if(($ca['form_status_id']>=5) && ($ca['form_status_stage_id']<=3)) {echo 'Admission Offer';} else {echo 'Approval Pending';}?> </td>
                                  </tr>
								  <?php } 
								  
								  }else{?>
								  <tr>
                                    <td colspan="5">No Record Found!</td>
                                  </tr>
								  <!--tr role="row">
                                      <td class="text-center sorting_1">5824</td>
                                      <td><a href="#" class="confirm_admission" data-id="confirmAdmission_21">Muhammad Saleem Atif</a><br><small>02-December-2016</small></td>
                                      <td>Atif Mushtaq<br><small>0300-2155406 / 0332-3123104</small></td>
                                      <td class="text-center">A01-02</td>
                                      <td class="text-left">Admission Confirm<br><small>Additional Comments blurb will be showed here</small></td>
                                  </tr -->
								  
							  <?php } ?>
                                 
								  
                                </tbody> 
                            </table><!-- StaffListing -->
                        </div><!-- ConfirmListing -->
                        <div id="NotInterestedListing" class="tab-pane fade">
                        	<div class="col-md-6" style=" position: absolute;right: 0;top: -51px;width: 200px;">
                            	<select required class="">
                                  <option value="" disabled selected>Filter list by Current Standing</option>
                                  <option value="">Assessment Only</option>
                                  <option value="">Assessment & Discussion</option>
                                  <option value="">Discussion Only</option>
                                  <option value="">Offer</option>
                                  <option value="">Billing</option>
                                </select>
                            </div><!-- absoluteDrop -->
                          <table id="CommunicationListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                              <thead> 
							  
                                  <tr> 
                                      <th width="" class="text-center">Form #</th> 
                                      <th width="">Applicant Name<br /><small>Submission Date</small></th> 
                                      <th width="">Father Name<br /><small>Father/Mother Mobile</small></th> 
                                      <th width="" class="text-center no-sort">Batch ID - Grade</th>
                                      <th width="" class="text-center">Current Status</th>
                                  </tr>
                              </thead>
                              <tbody> 
							    <?php if(!empty($Not_Interested)){
								  foreach( $Not_Interested as $ca ){ ?>
                                  <tr data-id="<?=$ca["form_id"] ?>">
                                     <td class="text-center"><?php echo str_pad( $ca["form_no"],4,"0",STR_PAD_LEFT); ?></td>
                                      <td><a href="#" class="confirm_admission" data-id="notInterestd_<?=$ca["form_id"];?>" >
									  <?=$ca["official_name"];?></a><br /><small><?=$ca["form_submission_date"];?></small></td>
                                      <td><?=$ca["father_name"];?><br /><small><?=$ca["father_mobile"];?> / <?=$ca["mother_mobile"];?></small></td>
                                      <td class="text-center"><?=$ca["final_batch_slot"];?> - <?=$ca["grade_name"];?></td>
                                      <td class="text-left">Not Interested </td>
                                  </tr>
                                 </tr>
								  <?php } ?>
								  
							  <?php } else{?>
								   <tr>
                                    <td colspan="5">No Record Found!</td>
                                  </tr>
								  <!--tr role="row">
                                      <td class="text-center sorting_1">5824</td>
                                      <td><a href="#" class="confirm_admission" data-id="notInterestd_21">Muhammad Saleem Atif</a><br><small>02-December-2016</small></td>
                                      <td>Atif Mushtaq<br><small>0300-2155406 / 0332-3123104</small></td>
                                      <td class="text-center">A01-02</td>
                                      <td class="text-left">Admission Confirm<br><small>Additional Comments blurb will be showed here</small></td>
                                  </tr -->
								  
							  <?php } ?>
                              </tbody> 
                            </table><!-- StaffListing -->
                        </div><!-- NotInterestedListing -->
                        <div id="RegretListing" class="tab-pane fade">
                        	<div class="col-md-6" style=" position: absolute;right: 0;top: -51px;width: 200px;">
                            	<select required class="">
                                  <option value="" disabled selected>Filter list by Current Standing</option>
                                  <option value="">Assessment Only</option>
                                  <option value="">Assessment & Discussion</option>
                                  <option value="">Discussion Only</option>
                                  <option value="">Offer</option>
                                  <option value="">Billing</option>
                                </select>
                            </div><!-- absoluteDrop -->
                          <table id="regretListingTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                              <thead> 
                                  <tr> 
                                      <th width="" class="text-center">Form #</th> 
                                      <th width="">Applicant Name<br /><small>Submission Date</small></th> 
                                      <th width="">Father Name<br /><small>Father/Mother Mobile</small></th> 
                                      <th width="" class="text-center no-sort">Batch ID - Grade</th>
                                      <th width="" class="text-center">Current Status</th>
                                  </tr>
                              </thead>
                              <tbody>  <?php if(!empty($Regret)){
								  foreach( $Regret as $ca ){ ?>
                                  <tr data-id="<?=$ca["form_id"] ?>">
                                    <td class="text-center"><?php echo str_pad( $ca["form_no"],4,"0",STR_PAD_LEFT); ?></td>
                                      <td><a href="#" class="confirm_admission" data-id="regret_<?=$ca["form_id"];?>" >
									  <?=$ca["official_name"];?></a><br /><small><?=$ca["form_submission_date"];?></small></td>
                                      <td><?=$ca["father_name"];?><br /><small><?=$ca["father_mobile"];?> / <?=$ca["mother_mobile"];?></small></td>
                                      <td class="text-center"><?=$ca["final_batch_slot"];?> <?php //$ca["batch_category"];?> - <?=$ca["grade_name"];?></td>
                                      <td class="text-left">Regret </td>
                                  </tr>
                                 </tr>
								  <?php } ?>
								  
							  <?php } else{?>
								  <tr>
                                    <td colspan="5">No Record Found!</td>
                                  </tr>
								  <!--tr role="row">
                                      <td class="text-center sorting_1">5824</td>
                                      <td><a href="#" class="confirm_admission" data-id="regret_21">Muhammad Saleem Atif</a><br><small>02-December-2016</small></td>
                                      <td>Atif Mushtaq<br><small>0300-2155406 / 0332-3123104</small></td>
                                      <td class="text-center">A01-02</td>
                                      <td class="text-left">Admission Confirm<br><small>Additional Comments blurb will be showed here</small></td>
                                  </tr -->
								  
							  <?php } ?>
                              </tbody> 
                            </table><!-- StaffListing -->
                        </div><!-- RegretListing -->
						
						
						
						
							     <div id="RequestForGrade" class="tab-pane fade">
                        	<div class="col-md-6" style=" position: absolute;right: 0;top: -51px;width: 200px;">
                            	<select required class="">
                                  <option value="" disabled selected>Filter list by Current Standing</option>
                                  <option value="">Assessment Only</option>
                                  <option value="">Assessment & Discussion</option>
                                  <option value="">Discussion Only</option>
                                  <option value="">Offer</option>
                                  <option value="">Billing</option>
                                </select>
                            </div><!-- absoluteDrop -->
							<?php //var_dump( $RequestForGrade ); ?>
                          <table id="RequestForGradeTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                              <thead> 
                                  <tr> 
                                      <th width="" class="text-center">Form #</th> 
                                      <th width="">Applicant Name<br /><small>Submission Date</small></th> 
                                      <th width="">Father Name<br /><small>Father/Mother Mobile</small></th> 
									  <th width="" class="text-center no-sort">Admission Grade</th>
                                      <th width="" class="text-center">Request For Grade</th>
									  
                                  </tr>
                              </thead>
							  
							  	<tfoot>
								<tr>
									<td colspan="4">Filter list by Current Standing</td>
								</tr>
								
								</tfoot>
                              <tbody>  <?php 
							  $array = array( 1=>"PN",2=>"N",3=>"KG",4=>"I",5=>"II",6=>"III",7=>"IV",8=>"V",9=>"VI",10=>"VII",11=>"VIII",12=>"IX",13=>"X",14=>"XI",15=>"A1",16=>"A2" );
							
							  //var_dump($RequestForGrade);
							  if(!empty($RequestForGrade)){
								  foreach( $RequestForGrade as $ca ){ ?>
                                  <tr>
                                      <td class="text-center"><?php echo str_pad( $ca["form_no"],4,"0",STR_PAD_LEFT); ?></td>
                                      <td><a href="#" class="confirm_admission" data-id="RequestForGrade_<?=$ca["form_id"];?>" >
									  <?=$ca["official_name"];?></a><br /><small><?=$ca["form_submission_date"];?></small></td>
                                      <td><?=$ca["father_name"];?><br /><small><?=$ca["father_mobile"];?> / <?=$ca["mother_mobile"];?></small></td>
                                       <td class="text-center"> <?=$ca["grade_name"];?></td>
                                      
									  <td class="text-left"><?php
									   $request_for_grade = $ca["RequestForGrade"];
									  $grade_name = $array[$request_for_grade];
									  echo $grade_name;
									  ?> </td>
									  
                                  </tr>
                                  <?php } ?>
								  
							  <?php } else{?>
								 <tr>
                                    <td colspan="5">No Record Found!</td>
                                  </tr>
								  <!--tr role="row">
                                      <td class="text-center sorting_1">5824</td>
                                      <td><a href="#" class="confirm_admission" data-id="allApplication_21">Muhammad Saleem Atif</a><br><small>02-December-2016</small></td>
                                      <td>Atif Mushtaq<br><small>0300-2155406 / 0332-3123104</small></td>
                                      <td class="text-center">A01-02</td>
                                      <td class="text-left">Admission Confirm<br><small>Additional Comments blurb will be showed here</small></td>
                                  </tr -->
								  
							  <?php } ?>
                              </tbody> 
                            </table><!-- StaffListing -->
                        </div><!-- RequestForGrade -->
						
						
						
                        <div id="AllApplicants" class="tab-pane fade">
                        	<!--div class="col-md-6" style=" position: absolute;right: 0;top: -51px;width: 200px;">
                            	<select required class="">
                                  <option value="" disabled selected>Filter list by Current Standing</option>
                                  <option value="">Assessment Only</option>
                                  <option value="">Assessment & Discussion</option>
                                  <option value="">Discussion Only</option>
                                  <option value="">Offer</option>
                                  <option value="">Billing</option>
                                </select>
                            </div --><!-- absoluteDrop -->
							<?php //var_dump( $All_Applications ); ?>
                          <table id="AllApplicantTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                              <thead> 
                                  <tr> 
                                      <th width="" class="text-center">Form #</th> 
                                      <th width="">Applicant Name<br /><small>Submission Date</small></th> 
                                      <th width="">Father Name<br /><small>Father/Mother Mobile</small></th> 
                                      <th width="" class="text-center no-sort">Batch ID - Grade</th>
                                      <th width="" class="text-center">Current Status</th>
                                  </tr>
                              </thead>
							  
							  <tfoot>
			<tr>
			<td colspan="5">Filter list by Current Standing</td>
			</tr>
			
			</tfoot>
			
                              <tbody>  <?php 
							  
							  
							  if(!empty($All_Applications)){
								  foreach( $All_Applications as $ca ){ ?>
                                  <tr data-id="<?=$ca["form_id"] ?>">
                                      <td class="text-center"><?php echo str_pad( $ca["form_id"],4,"0",STR_PAD_LEFT); ?></td>
                                      <td><a href="#" class="confirm_admission" data-id="allApplication_<?=$ca["form_id"];?>" >
									  <?=$ca["official_name"];?></a><br /><small><?=$ca["form_submission_date"];?></small></td>
                                      <td><?=$ca["father_name"];?><br /><small><?=$ca["father_mobile"];?> / <?=$ca["mother_mobile"];?></small></td>
                                      <td class="text-center"><?=$ca["final_batch_slot"];?> - <?=$ca["grade_name"];?></td>
                                      <td class="text-left"><?=$ca["form_discussion_decision"];?> </td>
                                  </tr>
                                  <?php } ?>
								  
							  <?php } else{?>
								 <tr>
                                    <td colspan="5">No Record Found!</td>
                                  </tr>
								  <!--tr role="row">
                                      <td class="text-center sorting_1">5824</td>
                                      <td><a href="#" class="confirm_admission" data-id="allApplication_21">Muhammad Saleem Atif</a><br><small>02-December-2016</small></td>
                                      <td>Atif Mushtaq<br><small>0300-2155406 / 0332-3123104</small></td>
                                      <td class="text-center">A01-02</td>
                                      <td class="text-left">Admission Confirm<br><small>Additional Comments blurb will be showed here</small></td>
                                  </tr -->
								  
							  <?php } ?>
                              </tbody> 
                            </table><!-- StaffListing -->
                        </div><!-- AllApplicants -->
                    </div><!-- tab-content -->
                </div><!-- inner -->
            </div><!-- MaroonBorderBox -->
        </div><!-- col-md-7 -->
		
        <div class="col-md-5" style="display:none;" id="rightSide"></div><!-- col-md-4 -->
	   
    </div><!-- row -->
    <!-- Two column layout END -->
</div><!-- container -->


 <div style="display:none;" id="ajaxloader">  <p> <br /> <br /> <br /> <br /> Please Wait .. </p></div>

<style>

#ajaxloader{background-color: silver}
#ajaxloader{
	 position: absolute;
border:none;
  top: 364px;
  left:300px;
background-color: transparent;
text-align: center;
background-image: url(<?php echo base_url();?>/components/image/ajax-loader2.gif);
background-position: center center;
background-repeat: no-repeat;
}



​


</style>


