<div id="AdmissionFormListing_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
  <div class="row">
    <div class="col-sm-12">
      <table id="AdmissionFormListing" class="table table-striped table-bordered table-hover dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="AdmissionFormListing_info" style="width: 100%;">
        <thead>
          <tr role="row">
            <th class="no-sort sorting_asc" width="2%" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-sort="ascending" aria-label=": activate to sort column descending" style="width: 10.0104px;">
              <input type="checkbox" id="selectAll" class="normal">
            </th>
            <th width="" class="text-center sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="Form #: activate to sort column ascending" style="width: 66.0104px;">Form #
            </th>
            <th width="" class="no-sort sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="Applicant NameFather Name: activate to sort column ascending" style="width: 157.01px;">Applicant Name
              <br>
              <small>Father Name
              </small>
            </th>
            <th width="" class="text-center no-sort sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="AST AppointmentAST Done onAST by: activate to sort column ascending" style="width: 146.01px;">AST Appointment
              <br>
              <div class="col-md-6 no-padding">
                <small>AST Done on
                </small>
              </div>
              <div class="col-md-6 no-padding text-right">
                <small>AST by
                </small>
              </div>
            </th>
            <th width="" class="text-left no-sort sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="AST ResultAST Decision: activate to sort column ascending" style="width: 110.01px;">AST Result
              <br>
              <div class="col-md-12 no-padding text-right">AST Decision
              </div>
            </th>
            <th width="" class="text-center no-sort sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="DIS AppointmentDIS Done onDIS by: activate to sort column ascending" style="width: 144.01px;">DIS Appointment
              <br>
              <div class="col-md-6 no-padding">
                <small>DIS Done on
                </small>
              </div>
              <div class="col-md-6 no-padding text-right">
                <small>DIS by
                </small>
              </div>
            </th>
            <th width="" class="text-left no-sort sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="DIS ResultDIS Decision: activate to sort column ascending" style="width: 115.01px;">DIS Result
              <br>
              <div class="col-md-12 no-padding text-right">DIS Decision
              </div>
            </th>
            <th width="" class="text-left no-sort sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="Offer DateTime: activate to sort column ascending" style="width: 117.01px;">Offer Date
              <br>
              <small>Time
              </small>
            </th>
            <th width="" class="text-center no-sort sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 175px;">Action
            </th>
          </tr>
        </thead>
        <tbody>
       <?php foreach ($batch_aso_and_new as $batch_aso_and_news) { ?>
          <tr role="row" class="odd">
            <td class="sorting_1">
              <input type="checkbox" id="2" class="normal checkedStatus" unchecked="">
            </td>
            <input type="hidden" id="batch_case" value="1">
            <td class="text-center" id="form-no"><?= $batch_aso_and_news->form_no ?>
            </td>
            <td>
              <span id="applicant_name_2"><?= $batch_aso_and_news->applicant_name ?>
              </span>
              <br>
              <small><?= $batch_aso_and_news->father_name ?>
              </small>
            </td>
            <td class="text-center">
              <strong><?= $batch_aso_and_news->form_assessment_date ?>
              </strong>
              <br> 
              <div class="col-md-6 no-padding text-left">
                <small><?= $batch_aso_and_news->ast_done_on ?>
                </small>
              </div>
              <div class="col-md-6 no-padding text-right">
                <small><?= $batch_aso_and_news->ast_name_code ?>
                </small>
              </div>
              <div class="text-center">
                <hr class="lowMargin">
                <?php if($batch_aso_and_news->flag_ast_reminder == 0){ ?>
                    <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
              <?php }else{ ?>
                   <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

              <?php } ?>
                <?php if($batch_aso_and_news->flag_ast_presence == 0){ ?>
                    <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
              <?php }else{ ?>
                   <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

              <?php } ?> &nbsp; 
                <?php if($batch_aso_and_news->flag_ast_followup == 0){ ?>
                    <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
              <?php }else{ ?>
                   <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

              <?php } ?> 
              </div>
            </td>
            <td class="text-left">
              <div class="col-md-12 text-left"><?= $batch_aso_and_news->form_assessment_result ?>
              </div>
              <div class="col-md-12 text-right" id="form_assessment_decision_2">-
              	<?= $batch_aso_and_news->form_assessment_decision ?>
                <div>
                </div>
              </div>
            </td>
            <td class="text-center">
              <strong><?= $batch_aso_and_news->form_assessment_date ?>
              </strong>
              <br>
              <div class="col-md-6 no-padding text-left">
                <small><?= $batch_aso_and_news->dis_done_on ?>
                </small>
              </div>
              <div class="col-md-6 no-padding text-right">
                <small><?= $batch_aso_and_news->dis_name_code ?>
                </small>
              </div>
              <div class="text-center">
                <hr class="lowMargin">
                <?php if($batch_aso_and_news->flag_ast_reminder == 0){ ?>
                		<img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
            	<?php }else{ ?>
            		   <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

            	<?php } ?>
                <?php if($batch_aso_and_news->flag_ast_presence == 0){ ?>
                		<img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
            	<?php }else{ ?>
            		   <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

            	<?php } ?> &nbsp; 
                <?php if($batch_aso_and_news->flag_ast_followup == 0){ ?>
                		<img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
            	<?php }else{ ?>
            		   <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

            	<?php } ?> 
              </div>
            </td>
            <td class="text-left">
              <div class="col-md-12 text-left">
              	<?= $batch_aso_and_news->form_discussion_result ?>
              </div>
              <div class="col-md-12 text-right" id="form_discussion_decision_2">
              	<?= $batch_aso_and_news->form_discussion_decision ?>
              </div>
              <div class="text-center no-padding">
                <hr class="lowMargin">

                <?php if($batch_aso_and_news->flag_ast_result == 0){ ?>
                		<img src="<?= base_url(); ?>/components/gs_theme/images/result.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
            	<?php }else{ ?>
            		   <img src="<?= base_url(); ?>/components/gs_theme/images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

            	<?php } ?> 

            	<?php if($batch_aso_and_news->flag_ast_decision == 0){ ?>
                		<img src="<?= base_url(); ?>/components/gs_theme/images/discussion.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
            	<?php }else{ ?>
            		   <img src="<?= base_url(); ?>/components/gs_theme/images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

            	<?php } ?>

            	<?php if($batch_aso_and_news->flag_ast_allocation == 0){ ?>
                		<img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
            	<?php }else{ ?>
            		   <img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

            	<?php } ?>

            	<?php if($batch_aso_and_news->flag_comm_ast_result == 0){ ?>
                		<img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
            	<?php }else{ ?>
            		   <img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

            	<?php } ?>

                 

                
          
                
              </div>
            </td>
            <td class="text-left">
              <span id="offer_2"><?= $batch_aso_and_news->final_decision ?>
              </span>
            </td>
            <td class="text-center">
              <small>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal4" id="view_and_edit" data-form="<?= $batch_aso_and_news->form_id ?>">View &amp; Edit
                </a>
                <br>
                <br>
                <a href="javascript:void(0)" id="mark_present" data-presesnt="<?= $batch_aso_and_news->form_id ?>">Mark as Present
                </a>
              </small>
            </td>
          </tr>
      <?php } ?>

    <?php 

       foreach ($batch_aso_old as $batch_aso_and_news) { ?>

          <tr role="row" class="odd">
            <td class="sorting_1">
              <input type="checkbox" id="<?= $batch_aso_and_news->form_no ?>" class="normal checkedStatus" unchecked="">
            </td>
            <input type="hidden" id="batch_case" value="1">
            <td class="text-center" id="form-no"><?= $batch_aso_and_news->form_no ?>
            </td>
            <td>
              <span id="applicant_name_2"><?= $batch_aso_and_news->applicant_name ?>
              </span>
              <br>
              <small><?= $batch_aso_and_news->father_name ?>
              </small>
            </td>
            <td class="text-center">
              <strong><?= $batch_aso_and_news->form_assessment_date ?>
              </strong>
              <br> 
              <div class="col-md-6 no-padding text-left">
                <small><?= $batch_aso_and_news->ast_done_on ?>
                </small>
              </div>
              <div class="col-md-6 no-padding text-right">
                <small><?= $batch_aso_and_news->ast_name_code ?>
                </small>
              </div>
              <div class="text-center">
                <hr class="lowMargin">
                <?php if($batch_aso_and_news->flag_ast_reminder == 0){ ?>
                    <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
              <?php }else{ ?>
                   <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

              <?php } ?>
                <?php if($batch_aso_and_news->flag_ast_presence == 0){ ?>
                    <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
              <?php }else{ ?>
                   <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

              <?php } ?> &nbsp; 
                <?php if($batch_aso_and_news->flag_ast_followup == 0){ ?>
                    <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
              <?php }else{ ?>
                   <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

              <?php } ?> 
              </div>
            </td>
            <td class="text-left">
              <div class="col-md-12 text-left"><?= $batch_aso_and_news->form_assessment_result ?>
              </div>
              <div class="col-md-12 text-right" id="form_assessment_decision_2">-
              	<?= $batch_aso_and_news->form_assessment_decision ?>
                <div>
                </div>
              </div>
            </td>
            <td class="text-center">
              <strong><?= $batch_aso_and_news->form_assessment_date ?>
              </strong>
              <br>
              <div class="col-md-6 no-padding text-left">
                <small><?= $batch_aso_and_news->dis_done_on ?>
                </small>
              </div>
              <div class="col-md-6 no-padding text-right">
                <small><?= $batch_aso_and_news->dis_name_code ?>
                </small>
              </div>
              <div class="text-center">
                <hr class="lowMargin">
                <?php if($batch_aso_and_news->flag_ast_reminder == 0){ ?>
                		<img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
            	<?php }else{ ?>
            		   <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

            	<?php } ?>
                <?php if($batch_aso_and_news->flag_ast_presence == 0){ ?>
                		<img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
            	<?php }else{ ?>
            		   <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

            	<?php } ?> &nbsp; 
                <?php if($batch_aso_and_news->flag_ast_followup == 0){ ?>
                		<img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
            	<?php }else{ ?>
            		   <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

            	<?php } ?> 
              </div>
            </td>
            <td class="text-left">
              <div class="col-md-12 text-left">
              	<?= $batch_aso_and_news->form_discussion_result ?>
              </div>
              <div class="col-md-12 text-right" id="form_discussion_decision_2">
              	<?= $batch_aso_and_news->form_discussion_decision ?>
              </div>
              <div class="text-center no-padding">
                <hr class="lowMargin">

                <?php if($batch_aso_and_news->flag_dis_result == 0){ ?>
                		<img src="<?= base_url(); ?>/components/gs_theme/images/result.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
            	<?php }else{ ?>
            		   <img src="<?= base_url(); ?>/components/gs_theme/images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

            	<?php } ?> 

            	<?php if($batch_aso_and_news->flag_dis_decision == 0){ ?>
                		<img src="<?= base_url(); ?>/components/gs_theme/images/discussion.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
            	<?php }else{ ?>
            		   <img src="<?= base_url(); ?>/components/gs_theme/images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

            	<?php } ?>

            	<?php if($batch_aso_and_news->flag_dis_allocation == 0){ ?>
                		<img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
            	<?php }else{ ?>
            		   <img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

            	<?php } ?>

            	<?php if($batch_aso_and_news->flag_comm_dis_result == 0){ ?>
                		<img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
            	<?php }else{ ?>
            		   <img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;

            	<?php } ?>
    
              </div>
            </td>
            <td class="text-left">
              <span id="offer_2"><?= $batch_aso_and_news->final_decision ?>
              </span>
            </td>
            <td class="text-center">
              <strong>
                Re Assistment to Batch <?= $batch_aso_and_news->batch_category ?>
              </strong>
            </td>
          </tr>
      <?php } ?>



  
            
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>
<div class="col-md-6 absoluteDiv">
  <div class="col-md-6 no-padding">
    <select id="status" required="" class="paddingBottom10 paddingLeft10 paddingRight10 paddingTop10">
      <option value="" disabled="" selected="">Select Action *
      </option>
      <option value="5">Offer Approve
      </option>
      <option value="15">Move to Regret
      </option>
      <option value="17">Move to Wait List
      </option>
      <option value="16">Move to Hold
      </option>
    </select>
  </div>
  <!-- col-md-6 -->
  <div class="col-md-3">
    <input type="submit" class="greenBTN btn" value="Apply" id="status_update">
  </div>
  <!-- col-md-6 -->
</div>

</div>

<script>$(document).ready(function() {
 				  $("#AdmissionFormListing").dataTable();
				  });</script>