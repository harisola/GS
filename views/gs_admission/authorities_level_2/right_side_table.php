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
	

		
?>

             
					<ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#ConfirmListing">Wait List(<?=$count_ConfirmAdmission;?>)</a></li>
                        <li><a data-toggle="tab" href="#NotInterestedListing">On Hold (<?=$count_Not_Interested;?>)</a></li>
                        <li><a data-toggle="tab" href="#AllApplicants">All Applicants (<?=$count_All_Applications;?>)</a></li>
                     </ul><!-- nav-tabs -->
                    <div class="tab-content">
                        <div id="ConfirmListing" class="tab-pane fade in active">
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
                          	<table id="confirmAdmissionTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
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
							  <?php if(!empty($ConfirmAdmission)){
								  foreach( $ConfirmAdmission as $ca ){ ?>
									   <tr>
                                      <td class="text-center"><?php echo str_pad( $ca["form_id"],4,"0",STR_PAD_LEFT); ?></td>
                                      <td><a href="#" class="confirm_admission" data-id="waitList_<?=$ca["form_id"];?>" >
									  <?=$ca["official_name"];?></a><br /><small><?=$ca["form_submission_date"];?></small></td>
                                      <td><?=$ca["father_name"];?><br /><small><?=$ca["father_mobile"];?> / <?=$ca["mother_mobile"];?></small></td>
                                      <td class="text-center"><?=$ca["final_batch_slot"];?> - <?=$ca["grade_name"];?></td>
									  
                                      <td class="text-left">Admission Confirm </td>
                                  </tr>
								  <?php } 
								  
								  }else{?>
								  <tr>
                                    <td colspan="5">No Record Found!</td>
                                  </tr>
								  <!--tr role="row">
                                      <td class="text-center sorting_1">5824</td>
                                      <td><a href="#" class="confirm_admission" data-id="waitList_21">Muhammad Saleem Atif</a><br><small>02-December-2016</small></td>
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
                                   <?php 
									if( $ca["day_passed"] > 2 ){
										$redClass = "grayAlert";
									}else{
										$redClass = "";
									}
								  ?>
                                  <tr class="<?=$redClass;?>">
                                     <td class="text-center"><?php echo str_pad( $ca["form_id"],4,"0",STR_PAD_LEFT); ?></td>
                                      <td><a href="#" class="confirm_admission" data-id="notInterestd_<?=$ca["form_id"];?>" >
									  <?=$ca["official_name"];?></a><br /><small><?=$ca["form_submission_date"];?></small></td>
                                      <td><?=$ca["father_name"];?><br /><small><?=$ca["father_mobile"];?> / <?=$ca["mother_mobile"];?></small></td>
                                      <td class="text-center"><?=$ca["final_batch_slot"];?> - <?=$ca["grade_name"];?></td>
                                      <td class="text-left">On Hold</td>
                                  </tr>
                                 </tr>
								  <?php } ?>
								  
							  <?php } else{?>
								   <tr>
                                    <td colspan="5">No Record Found!</td>
                                  </tr>
								  <!--tr role="row">
                                      <td class="text-center sorting_1">5824</td>
                                      <td><a href="#" class="confirm_admission" data-id="waitList_21">Muhammad Saleem Atif</a><br><small>02-December-2016</small></td>
                                      <td>Atif Mushtaq<br><small>0300-2155406 / 0332-3123104</small></td>
                                      <td class="text-center">A01-02</td>
                                      <td class="text-left">Admission Confirm<br><small>Additional Comments blurb will be showed here</small></td>
                                  </tr -->
								  
							  <?php } ?>
                              </tbody> 
                            </table><!-- StaffListing -->
                        </div><!-- NotInterestedListing -->
						
                     
						
						
                        <div id="AllApplicants" class="tab-pane fade">
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
                              <tbody>  <?php if(!empty($All_Applications)){
								  foreach( $All_Applications as $ca ){ ?>
                                  <tr>
                                      <td class="text-center"><?php echo str_pad( $ca["form_id"],4,"0",STR_PAD_LEFT); ?></td>
                                      <td><a href="#" class="confirm_admission" data-id="allApp_<?=$ca["form_id"];?>" >
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
                                      <td><a href="#" class="confirm_admission" data-id="waitList_21">Muhammad Saleem Atif</a><br><small>02-December-2016</small></td>
                                      <td>Atif Mushtaq<br><small>0300-2155406 / 0332-3123104</small></td>
                                      <td class="text-center">A01-02</td>
                                      <td class="text-left">Admission Confirm<br><small>Additional Comments blurb will be showed here</small></td>
                                  </tr -->
								  
							  <?php } ?>
                              </tbody> 
                            </table><!-- StaffListing -->
                        </div><!-- AllApplicants -->
                    </div><!-- tab-content -->
              
				
				




<script>
$(document).ready(function(){
	$('#confirmAdmissionTable').dataTable();
	$('#CommunicationListing').dataTable();
	$('#regretListingTable').dataTable();
	$('#AllApplicantTable').dataTable();
});
</script>	