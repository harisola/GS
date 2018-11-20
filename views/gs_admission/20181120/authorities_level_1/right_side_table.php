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

<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#ConfirmListing">Confirm Admissions (<?=$count_ConfirmAdmission;?>)</a></li>
	<li><a data-toggle="tab" href="#NotInterestedListing">Not Interested (<?=$count_Not_Interested;?>)</a></li>
	<li><a data-toggle="tab" href="#RegretListing">Regret Reloaded(<?=$count_Regret;?>)</a></li>
	<li><a data-toggle="tab" href="#RequestForGrade">Request For Grade (<?=$count_RequestForGrade;?>)</a></li>
	
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
			<?php //var_dump($ConfirmAdmission); ?>
		</div><!-- absoluteDrop -->
		
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
				   <tr>
				  <td class="text-center"><?php echo str_pad( $ca["form_id"],4,"0",STR_PAD_LEFT); ?></td>
				  <td><a href="#" class="confirm_admission" data-id="confirmAdmission_<?=$ca["form_id"];?>" >
				  <?=$ca["official_name"];?></a><br /><small><?=$ca["form_submission_date"];?></small></td>
				  <td><?=$ca["father_name"];?><br /><small><?=$ca["father_mobile"];?> / <?=$ca["mother_mobile"];?></small></td>
				  <td class="text-center"><?=$ca["final_batch_slot"];?> - <?=$ca["grade_name"];?></td>
				  
				  <td class="text-left"><?php if(($ca['form_status_id']>=5) && ($ca['form_status_stage_id']==1 || $ca['form_status_stage_id']==2)) {echo 'Admission Offer';} else {echo 'Approval Pending';}?> </td>
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
			  <tr>
				 <td class="text-center"><?php echo str_pad( $ca["form_id"],4,"0",STR_PAD_LEFT); ?></td>
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
			  <tr>
				<td class="text-center"><?php echo str_pad( $ca["form_id"],4,"0",STR_PAD_LEFT); ?></td>
				  <td><a href="#" class="confirm_admission" data-id="regret_<?=$ca["form_id"];?>" >
				  <?=$ca["official_name"];?></a><br /><small><?=$ca["form_submission_date"];?></small></td>
				  <td><?=$ca["father_name"];?><br /><small><?=$ca["father_mobile"];?> / <?=$ca["mother_mobile"];?></small></td>
				  <td class="text-center"><?=$ca["final_batch_slot"];?> - <?=$ca["grade_name"];?></td>
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
		<?php //var_dump( $All_Applications ); ?>
                          <table id="RequestForGradeTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                              <thead> 
                                  <tr> 
                                      <th width="" class="text-center">Form #</th> 
                                      <th width="">Applicant Name<br /><small>Submission Date</small></th> 
                                      <th width="">Father Name<br /><small>Father/Mother Mobile</small></th> 
                                      <th width="" class="text-center no-sort">Admission Grade</th>
									  <th width="" class="text-center">RequestForGrade</th>
									  
                                  </tr>
                              </thead>
							  
							  	<tfoot>
								<tr>
									<td colspan="5">Filter list by Current Standing</td>
								</tr>
								
								</tfoot>
                              <tbody>  <?php 
							  
							  //var_dump($RequestForGrade);
							  if(!empty($RequestForGrade)){
								  foreach( $RequestForGrade as $ca ){ ?>
                                  <tr>
                                      <td class="text-center"><?php echo str_pad( $ca["form_no"],4,"0",STR_PAD_LEFT); ?></td>
                                      <td><a href="#" class="confirm_admission" data-id="RequestForGrade_<?=$ca["form_id"];?>" >
									  <?=$ca["official_name"];?></a><br /><small><?=$ca["form_submission_date"];?></small></td>
                                      <td><?=$ca["father_name"];?><br /><small><?=$ca["father_mobile"];?> / <?=$ca["mother_mobile"];?></small></td>
                                     <td class="text-center"> <?=$ca["grade_name"];?></td>
									  <td class="text-left"><?=$ca["RequestForGrade"];?> </td>
									  
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
			
		  <tbody>  <?php if(!empty($All_Applications)){
			  foreach( $All_Applications as $ca ){ ?>
			  <tr>
				  <td class="text-center"><?php echo str_pad( $ca["form_id"],4,"0",STR_PAD_LEFT); ?></td>
				  <td><a href="#" class="confirm_admission" data-id="allApplication_<?=$ca["form_id"];?>" >
				  <?=$ca["official_name"];?></a><br /><small><?=$ca["form_submission_date"];?></small></td>
				  <td><?=$ca["father_name"];?><br /><small><?=$ca["father_mobile"];?> / <?=$ca["mother_mobile"];?></small></td>
				 <td class="text-center"><?=$ca["final_batch_slot"];?> - <?=$ca["grade_name"];?></td>
				  <td class="text-left"><?php //$ca["form_discussion_decission"];?> </td>
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/custom.js"></script>


<script>
$(document).ready(function(){
	$('#confirmAdmissionTable').dataTable();
	$('#CommunicationListing').dataTable();
	$('#regretListingTable').dataTable();
	//$('#AllApplicantTable').dataTable();
	
	$('#RequestForGradeTable').dataTable();
	
	
	
$('#confirmAdmissionTable2').DataTable( {
initComplete: function () {
this.api().columns().every( function () {
	var column = this;
	var select = $('<select style="position: absolute;right: 31px;top: -80px;width: 250px;"><option value="">Filter list by Current Standing</option></select>')
		.appendTo( $(column.footer()).empty() )
		.on( 'change', function () {
			var val = $.fn.dataTable.util.escapeRegex(
				$(this).val()
			);

			column
				.search( val ? '^'+val+'$' : '', true, false )
				.draw();
		} );

	column.data().unique().sort().each( function ( d, j ) {
		select.append( '<option value="'+d+'">'+d+'</option>' )
	} );
} );
}
} );



$('#AllApplicantTable').DataTable( {
initComplete: function () {
this.api().columns().every( function () {
	var column = this;
	var select = $('<select style="position: absolute;right: 31px;top: -80px;width: 250px;"><option value="">Filter list by Current Standing</option></select>')
		.appendTo( $(column.footer()).empty() )
		.on( 'change', function () {
			var val = $.fn.dataTable.util.escapeRegex(
				$(this).val()
			);

			column
				.search( val ? '^'+val+'$' : '', true, false )
				.draw();
		} );

	column.data().unique().sort().each( function ( d, j ) {
		select.append( '<option value="'+d+'">'+d+'</option>' )
	} );
} );
}
} );

});	
</script>