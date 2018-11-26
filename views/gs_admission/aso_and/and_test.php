		 <table id="AdmissionFormListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
        <thead> 
        <tr>
        <th width="" class="text-center">Form #</th> 
        <th width="" class="no-sort">Applicant Name<br /><small>Father Name</small></th>
        <th width="" class="text-center no-sort">AST Appointment<br /><div class="col-md-6 no-padding"><small>AST Done on</small></div><div class="col-md-6 no-padding text-right"><small>AST by</small></div></th>
        <th width="" class="text-left no-sort">AST Result<br /><div class="col-md-12 no-padding text-right">AST Decision</div></th>
        <th width="" class="text-center no-sort">DIS Appointment<br /><div class="col-md-6 no-padding"><small>DIS Done on</small></div><div class="col-md-6 no-padding text-right"><small>DIS by</small></div></th>
        <th width="" class="text-left no-sort">DIS Result<br /><div class="col-md-12 no-padding text-right">DIS Decision</div></th>
        <!-- <th width="" class="text-center">Decision</th> -->
        <th width="" class="text-left no-sort">Offer Date<br /><small>Time</small></th>
        <th width="" class="text-center no-sort">Action</th>
        </tr>
        </thead>
		 <tbody>   
		

		<?php foreach($batch_aso_and_new as $aso_and_process){ ?>
					 <?php if($aso_and_process->form_status_stage_id == 7){ ?>
						 <tr class="grayAlert">
						<td></td>
					  <?php }else{ ?>	
						 <tr>
					  <?php } ?>
					 <input type="hidden" id="batch_case" value="<?= $aso_and_process->and_id?>">
					 <td class="text-center" id="form-no"><?= $aso_and_process->form_no ?></td>
					 <td><span id="applicant_name_<?= $aso_and_process->form_id?>"><?= $aso_and_process->applicant_name ?></span><br /><small><?= $aso_and_process->father_name ?></small></td>
					 <td class="text-center">
					 <strong><?= $aso_and_process->form_assessment_date ?></strong><br />
					<?php if($aso_and_process->previous_batch_id!= ''){ ?>
						<?php if($aso_and_process->rst_done_on == ''){ ?>
							 <div class="col-md-6 no-padding text-left"><small id="ast_done_on_<?= $aso_and_process->form_id?>">-</small></div>	
						<?php }else{ ?>
						 <div class="col-md-6 no-padding text-left"><small><?= $aso_and_process->rst_done_on ?></small></div>
						<?php } ?>
				     <?php }else{ ?>
				        <?php if($aso_and_process->ast_done_on == ''){ ?>
							 <div class="col-md-6 no-padding text-left"><small id="ast_done_on_<?= $aso_and_process->form_id?>">-</small></div>	
						<?php }else{ ?>
						 <div class="col-md-6 no-padding text-left"><small><?= $aso_and_process->ast_done_on ?></small></div>
						<?php } ?>

				    <?php } ?>



					<?php if($aso_and_process->ast_name_code == ''){  ?>
					 <div class="col-md-6 no-padding text-right"><small id="ast_name_code_<?= $aso_and_process->form_id?>">-</small></div>
					<?php }else{ ?>
					 <div class="col-md-6 no-padding text-right"><small><?= $aso_and_process->ast_name_code ?></small></div>
					<?php } ?>
					 </td>
					 <td class="text-left">
					<?php if($aso_and_process->form_assessment_result == ''){ ?>
					 <div class="col-md-12 text-left" id="form_assessment_result_<?= $aso_and_process->form_id?>">-</div>	
					<?php }else{ ?>
					 <div class="col-md-12 text-left"><?= $aso_and_process->form_assessment_result ?></div>
					<?php } ?>
					
					<?php if($aso_and_process->form_assessment_decision == 0){ ?>
					 <div class="col-md-12 text-right" id="form_assessment_decision_<?= $aso_and_process->form_id?>">-<div>

					<?php }else{ ?>
					 <div class="col-md-12 text-right"><?= $aso_and_process->form_assessment_decision ?></div>
					<?php } ?>

					 </td>
					 <td class="text-center">
					 <strong><?= $aso_and_process->form_assessment_date ?></strong><br />
					 <?php if($aso_and_process->previous_batch_id!= ''){ ?>
						<?php if($aso_and_process->rdis_done_on == ''){ ?>
							 <div class="col-md-6 no-padding text-left"><small id="dis_done_on_<?= $aso_and_process->form_id?>">-</small></div>	
						<?php }else{ ?>
						 <div class="col-md-6 no-padding text-left"><small><?= $aso_and_process->rdis_done_on ?></small></div>
						<?php } ?>
				     <?php }else{ ?>
				        <?php if($aso_and_process->ast_done_on == ''){ ?>
							 <div class="col-md-6 no-padding text-left"><small id="dis_done_on_<?= $aso_and_process->form_id?>">-</small></div>	
						<?php }else{ ?>
						 <div class="col-md-6 no-padding text-left"><small><?= $aso_and_process->dis_done_on ?></small></div>
						<?php } ?>

				    <?php } ?>


					<?php if($aso_and_process->dis_name_code == ''){ ?>
					 <div class="col-md-6 no-padding text-right"><small id="dis_name_code_<?= $aso_and_process->form_id?>">-</small></div>
					<?php  }else{ ?>
					 <div class="col-md-6 no-padding text-right"><small><?= $aso_and_process->dis_name_code ?></small></div>
					<?php } ?>

					 <div class="text-center">
					 <hr class="lowMargin" />

					<?php if($aso_and_process->flag_ast_reminder == 0){ ?>
						 <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
					<?php }else{ ?>
					 <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
					<?php } ?>
					<?php if($aso_and_process->previous_batch_id!= ''){ ?>
						<?php if($aso_and_process->flag_rst_presence == 0){ ?>
						 	<img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true" id="img_presence_and_<?= $aso_and_process->form_id?>"> &nbsp;
						<?php  }else{ ?>
							 <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
						<?php } ?>
					<?php }else{ ?>
						<?php if($aso_and_process->flag_ast_presence == 0){ ?>
						 	<img id="img_presence_and_<?= $aso_and_process->form_id ?>"" src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true" id="img_presence_and_<?= $aso_and_process->form_id?>"> &nbsp;
						<?php  }else{ ?>
							 <img id="img_presence_and_<?= $aso_and_process->form_id ?>" src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
						<?php } ?>

					<?php } ?>


					<?php if($aso_and_process->flag_ast_followup == 0){ ?>
					   <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
					<?php }else{ ?>
					   <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
					<?php } ?>
					
					   </div>
					 </td>
					 <td class="text-left">

					<?php if($aso_and_process->form_discussion_result == ''){ ?>
					 <div class="col-md-12 text-left" id="form_discussion_result_<?= $aso_and_process->form_id?>">-</div>
					<?php }else{ ?>
					 <div class="col-md-12 text-left"><?= $aso_and_process->form_discussion_result ?></div>
					<?php } ?>

					<?php if($aso_and_process->form_discussion_decision == ''){ ?>
					 <div class="col-md-12 text-right" id="form_discussion_decision_<?= $aso_and_process->form_id?>">-</div>
					<?php }else{ ?>
					 <div class="col-md-12 text-right" id="form_discussion_decision_<?= $aso_and_process->form_id?>"><?php 
					 if($aso_and_process->previous_batch_id!= ''){
					 	echo'-';
					 }else{
					 	echo $aso_and_process->form_discussion_decision;
					 } 

					 ?></div>
					<?php } ?>
					   <div class="text-center no-padding">
					   <hr class="lowMargin" />
					<?php if($aso_and_process->flag_dis_result == 0){ ?>
					 <img src="<?= base_url(); ?>/components/gs_theme/images/result.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true" id="img_result_<?= $aso_and_process->form_id?>"> &nbsp;
					<?php }else{ ?>
						 <img src="<?= base_url(); ?>/components/gs_theme/images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp;
					<?php } ?>
					<?php if($aso_and_process->previous_batch_id!= ''){ ?>
							<?php if($aso_and_process->flag_rdis_decision == 0){ ?>
								 <img src="<?= base_url(); ?>/components/gs_theme/images/discussion.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true" id="img_decision_<?= $aso_and_process->form_id?>"> &nbsp;
							<?php }else{ ?>
								 <img src="<?= base_url(); ?>/components/gs_theme/images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;
							<?php } ?>
						<?php }else{ ?>
							<?php if($aso_and_process->flag_dis_decision == 0){ ?>
								 <img src="<?= base_url(); ?>/components/gs_theme/images/discussion.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true" id="img_decision_<?= $aso_and_process->form_id?>"> &nbsp;
							<?php }else{ ?>
								 <img src="<?= base_url(); ?>/components/gs_theme/images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;
							<?php } ?>
						<?php } ?>



					<?php if($aso_and_process->previous_batch_id!= ''){ ?>
						<?php if($aso_and_process->flag_rdis_allocation == 0){ ?>
							 <img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true" id="img_allocation_<?= $aso_and_process->form_id?>"> &nbsp;
						<?php }else{ ?>
						 	<img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;
						<?php } ?>
					<?php }else{ ?>
						<?php if($aso_and_process->flag_dis_allocation == 0){ ?>
							 <img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true" id="img_allocation_<?= $aso_and_process->form_id?>"> &nbsp;
						<?php }else{ ?>
						 	<img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;
						<?php } ?>
					<?php } ?>

					<?php if($aso_and_process->flag_comm_dis_result == 0){ ?>
					 <img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
					<?php }else{ ?>
					 <img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">	
					<?php } ?>
					 </div>
					 </td>
						 <td class="text-left"><span id="offer_<?= $aso_and_process->form_id?>"><?= $aso_and_process->final_decision ?></span></td>
					  <td class="text-center">
							<?php if($aso_and_process->previous_batch_id!= ''){ ?>
	               				 <?php if($aso_and_process->flag_rst_presence == 0){ ?>
									 <small class="attendance_text_<?= $aso_and_process->form_id?>">Mark Attendance to proceed<br /><br />	
										<a href="javascript:void(0)" id="mark_present" data-re_assistment="<?= $aso_and_process->previous_batch_id?>" data-presesnt="<?= $aso_and_process->form_id?>" data-form="<?= $aso_and_process->form_id?>">Mark as Present</a></small>
								<?php }else{ ?>
									 <small><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal4" id="view_and_edit" data-form="<?= $aso_and_process->form_id?>">View & Edit</a><br /><br />	
								<?php } ?>
									 <small><a class="edit_btn btn_number_<?= $aso_and_process->form_id?>" href="javascript:void(0)" data-toggle="modal" data-target="#myModal4" 
										 id="view_and_edit" data-form="<?= $aso_and_process->form_id?>">View & Edit</a><br /><br />	</small>
							<?php }else{ ?>
								<?php if($aso_and_process->flag_ast_presence == 0){ ?>
										 <small class="attendance_text_<?= $aso_and_process->form_id?>">Mark Attendance to proceed<br /><br />	
										<a href="javascript:void(0)" id="mark_present" data-re_assistment="<?= $aso_and_process->previous_batch_id?>" data-presesnt="<?= $aso_and_process->form_id?>" data-form="<?= $aso_and_process->form_id?>">Mark as Present</a></small>
								<?php }else{ ?>
										 <small><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal4" id="view_and_edit" data-form="<?= $aso_and_process->form_id?>">View & Edit</a><br /><br />	</small>
								<?php } ?>

										 <small><a class="edit_btn btn_number_<?= $aso_and_process->form_id?>" href="javascript:void(0)" data-toggle="modal" data-target="#myModal4" 
										 id="view_and_edit" data-form="<?= $aso_and_process->form_id?>">View & Edit</a><br /><br />	</small>

						   <?php } ?>
					</td>

					
	 <?php } ?>

	 <?php foreach($batch_aso_old as $aso_and_process){ ?>
					 <?php if($aso_and_process->form_status_stage_id == 7){ ?>
						 <tr class="grayAlert">
						<td></td>
					  <?php }else{ ?>	
						 <tr>
					  <?php } ?>
					 <input type="hidden" id="batch_case" value="<?= $aso_and_process->and_id?>">
					 <td class="text-center" id="form-no"><?= $aso_and_process->form_no ?></td>
					 <td><span id="applicant_name_<?= $aso_and_process->form_id?>"><?= $aso_and_process->applicant_name ?></span><br /><small><?= $aso_and_process->father_name ?></small></td>
					 <td class="text-center">
					 <strong><?= $aso_and_process->form_assessment_date ?></strong><br />

					<?php if($aso_and_process->ast_done_on == ''){ ?>
					 <div class="col-md-6 no-padding text-left"><small id="ast_done_on_<?= $aso_and_process->form_id?>">-</small></div>
					<?php }else{ ?>
					  <div class="col-md-6 no-padding text-left"><small><?= $aso_and_process->ast_done_on ?></small></div>
					<?php } ?>


					<?php if($aso_and_process->pvs_ast_name_code == ''){  ?>
					 <div class="col-md-6 no-padding text-right"><small id="ast_name_code_<?= $aso_and_process->form_id?>">-</small></div>
					<?php }else{ ?>
					 <div class="col-md-6 no-padding text-right"><small><?= $aso_and_process->pvs_ast_name_code ?></small></div>
					<?php } ?>
					 </td>
					 <td class="text-left">
					<?php if($aso_and_process->pvs_form_assessment_result == ''){ ?>
					 <div class="col-md-12 text-left" id="form_assessment_result_<?= $aso_and_process->form_id?>">-</div>	
					<?php }else{ ?>
					 <div class="col-md-12 text-left"><?= $aso_and_process->pvs_form_assessment_result ?></div>
					<?php } ?>
					
					<?php if($aso_and_process->pvs_form_assessment_decision == 0){ ?>
					 <div class="col-md-12 text-right" id="form_assessment_decision_<?= $aso_and_process->form_id?>">-<div>

					<?php }else{ ?>
					 <div class="col-md-12 text-right"><?= $aso_and_process->pvs_form_assessment_decision ?></div>
					<?php } ?>

					 </td>
					 <td class="text-center">
					 <strong><?= $aso_and_process->form_assessment_date ?></strong><br />

					<?php if($aso_and_process->dis_done_on == ''){ ?>
						 <div class="col-md-6 no-padding text-left"><small id="dis_done_on_<?= $aso_and_process->form_id?>">-</small></div>	
					<?php }else{ ?>
					 <div class="col-md-6 no-padding text-left"><small><?= $aso_and_process->dis_done_on ?></small></div>
					<?php } ?>

					<?php if($aso_and_process->pvs_dis_name_code == ''){ ?>
					 <div class="col-md-6 no-padding text-right"><small id="dis_name_code_<?= $aso_and_process->form_id?>">-</small></div>
					<?php  }else{ ?>
					 <div class="col-md-6 no-padding text-right"><small><?= $aso_and_process->pvs_dis_name_code ?></small></div>
					<?php } ?>

					 <div class="text-center">
					 <hr class="lowMargin" />

					<?php if($aso_and_process->flag_ast_reminder == 0){ ?>
						 <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
					<?php }else{ ?>
					 <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
					<?php } ?>

					<?php if($aso_and_process->flag_ast_presence == 0){ ?>
					 <img id="img_presence_and_<?= $aso_and_process->form_id ?>" src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true" id="img_presence_and_<?= $aso_and_process->form_id?>"> &nbsp;
					<?php  }else{ ?>
						 <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
					<?php } ?>


					<?php if($aso_and_process->flag_ast_followup == 0){ ?>
					   <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
					<?php }else{ ?>
					   <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
					<?php } ?>
					
					   </div>
					 </td>
					 <td class="text-left">

					<?php if($aso_and_process->pvs_form_discussion_result == ''){ ?>
					 <div class="col-md-12 text-left" id="form_discussion_result_<?= $aso_and_process->form_id?>">-</div>
					<?php }else{ ?>
					 <div class="col-md-12 text-left"><?= $aso_and_process->pvs_form_discussion_result ?></div>
					<?php } ?>

					<?php if($aso_and_process->pvs_form_discussion_decision == ''){ ?>
					 <div class="col-md-12 text-right" id="form_discussion_decision_<?= $aso_and_process->form_id?>">-</div>
					<?php }else{ ?>
					 <div class="col-md-12 text-right" id="form_discussion_decision_<?= $aso_and_process->form_id?>"><?= $aso_and_process->pvs_form_discussion_decision ?></div>
					<?php } ?>
					   <div class="text-center no-padding">
					   <hr class="lowMargin" />
					<?php if($aso_and_process->flag_dis_result == 0){ ?>
					 <img src="<?= base_url(); ?>/components/gs_theme/images/result.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true" id="img_result_<?= $aso_and_process->form_id?>"> &nbsp;
					<?php }else{ ?>
						 <img src="<?= base_url(); ?>/components/gs_theme/images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp;
					<?php } ?>

					<?php if($aso_and_process->flag_dis_decision == 0){ ?>
					 <img src="<?= base_url(); ?>/components/gs_theme/images/discussion.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true" id="img_decision_<?= $aso_and_process->form_id?>"> &nbsp;
					<?php }else{ ?>
						 <img src="<?= base_url(); ?>/components/gs_theme/images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;
					<?php } ?>

					<?php if($aso_and_process->flag_dis_allocation == 0){ ?>
						 <img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true" id="img_allocation_<?= $aso_and_process->form_id?>"> &nbsp;
					<?php }else{ ?>
					 	<img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;
					<?php } ?>

					<?php if($aso_and_process->flag_comm_dis_result == 0){ ?>
					 <img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
					<?php }else{ ?>
					 <img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">	
					<?php } ?>
					 </div>
					 </td>
						 <td class="text-left"><span id="offer_<?= $aso_and_process->form_id?>"><?= $aso_and_process->final_decision ?></span></td>
					<td class="text-center">
					<strong>
					Re Assistment to Batch <?= $aso_and_process->batch_category ?>
					</strong>
					</td>
        </tr>
	 <?php } ?>
	 </tbody>
  </table>
   </div>
   </div>
   </div>

</div>

</div>
	

<script>$(document).ready(function() {
 				  $("#AdmissionFormListing").dataTable();
				  });</script>
				  <style type="text/css">
				  	.edit_btn{
				  		display: none;
				  	}
				  </style>