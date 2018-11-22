


<script>$(document).ready(function() {
 				  $("#AdmissionFormListing").dataTable();
				  });</script>


<table id="AdmissionFormListing" class="table table-striped table-bordered table-hover dataTable no-footer" cellspacing="0" width="100%" role="grid" aria-describedby="AdmissionFormListing_info" style="width: 100%;">
  <thead>
    <tr role="row">

      <th width="" class="text-center sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="Form #: activate to sort column ascending" style="width: 57px;">Form #
      </th>
      <th width="" class="no-sort sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="Applicant NameFather Name: activate to sort column ascending" style="width: 119px;">Applicant Name
        <br>
        <small>Father Name
        </small>
      </th>
      <th width="" class="text-center no-sort sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="AST AppointmentAST Done onAST by: activate to sort column ascending" style="width: 130px;">AST Appointment
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
      <th width="" class="text-left no-sort sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="AST ResultAST Decision: activate to sort column ascending" style="width: 101px;">AST Result
        <br>
        <div class="col-md-12 no-padding text-right">AST Decision
        </div>
      </th>
      <th width="" class="text-center no-sort sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="DIS AppointmentDIS Done onDIS by: activate to sort column ascending" style="width: 128px;">DIS Appointment
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
      <th width="" class="text-left no-sort sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="DIS ResultDIS Decision: activate to sort column ascending" style="width: 102px;">DIS Result
        <br>
        <div class="col-md-12 no-padding text-right">DIS Decision
        </div>
      </th>
      <th width="" class="text-left no-sort sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="Offer DateTime: activate to sort column ascending" style="width: 81px;">Offer Date
        <br>
        <small>Time
        </small>
      </th>
      <th width="" class="text-center no-sort sorting" tabindex="0" aria-controls="AdmissionFormListing" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 157px;">Action
      </th>
    </tr>
  </thead>
  <tbody>
        <?php foreach($batch_aso_and_new as $aso_and_process){ ?>
          <?php if($aso_and_process->form_status_stage_id == 7){ ?>
            <tr class="grayAlert">
          <?php }else{ ?>
            <tr>
          <?php } ?>
            <input type="hidden" id="batch_case" value="<?= $aso_and_process->and_id ?>">
          <td class="text-center" id=""><?= $aso_and_process->form_no ?></td>
          <td><?= $aso_and_process->applicant_name ?><br /><small><?= $aso_and_process->father_name ?></small></td>
          <td class="text-center">
          <strong><?= $aso_and_process->form_assessment_date ?></strong><br />

          <!-- IF Assessment Extension is empty  -->
          <?php if($aso_and_process->ast_done_on == ''){ ?>
            <div class="col-md-6 no-padding text-left" ><small id="ast_aso_done_on_<?= $aso_and_process->form_id ?>">-</small></div>
          <?php }else{ ?>
            <div class="col-md-6 no-padding text-left"><small id="ast_aso_done_on_<?= $aso_and_process->form_id ?>"><?= $aso_and_process->ast_done_on ?></small></div>
          <?php } ?>

          <?php if($aso_and_process->ast_name_code == ''){ ?>
            <div class="col-md-6 no-padding text-right"><small id="ast_name_code_<?= $aso_and_process->ast_name_code ?>">-</small></div>
          <?php }else{ ?>
            <div class="col-md-6 no-padding text-right"><small id="ast_name_code_<?= $aso_and_process->form_id ?>"><?= $aso_and_process->ast_name_code ?></small></div>
          <?php } ?>

          <div class="text-center">
            <hr class="lowMargin" />
              <?php if($aso_and_process->flag_ast_reminder == 0){ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true">&nbsp;
              <?php  }else{ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true">&nbsp;
             <?php } ?>
            <?php if($aso_and_process->previous_batch_id!=''){ ?>
                 <?php if($aso_and_process->flag_rst_presence == 0){ ?>
                    <img id="img_presence_assessment_<?= $aso_and_process->form_id ?>" src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon.png") 
                    title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true">&nbsp;
               
                <?php }else{ ?>
                  <img id="img_presence_assessment_<?= $aso_and_process->form_id ?>" src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true">&nbsp;  
                <?php } ?>
              <?php }else{ ?>
              <?php if($aso_and_process->flag_ast_presence == 0){ ?>
                    <img id="img_presence_assessment_<?= $aso_and_process->form_id ?>" src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true">&nbsp;
               
                <?php }else{ ?>
                  <img id="img_presence_assessment_<?= $aso_and_process->form_id ?>" src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true">&nbsp;  
                <?php } ?>

              <?php } ?>

            <?php if($aso_and_process->flag_ast_followup == 0){ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
            <?php  }else{ ?>
              <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
            <?php } ?>
                </div>
          </td>
            <td class="text-left">

          <?php if($aso_and_process->form_assessment_result == ''){ ?>
            <div class="col-md-12 text-left" id="form_assessment_result_aso_<?= $aso_and_process->form_id ?>">-</div> 
         <?php }else{ ?>
            <div class="col-md-12 text-left"><?= $aso_and_process->form_assessment_result ?></div>
          <?php } ?>
          
          <?php if($aso_and_process->form_assessment_decision == ''){ ?>
            <div class="col-md-12 text-right" id="form_assessment_decision_aso_<?= $aso_and_process->form_id ?>">-</div>
          <?php } 
          else{ ?>
            <div class="col-md-12 text-right" id="form_assessment_decision_aso_<?= $aso_and_process->form_assessment_result ?>"><?= $aso_and_process->form_assessment_decision ?></div>
          <?php } ?>

           <div class="text-center no-padding">
               <hr class="lowMargin" />
          <?php if($aso_and_process->previous_batch_id!= ''){ ?>
              <?php if($aso_and_process->flag_rst_result == 0){ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/result.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true" id="img_result_aso_<?= $aso_and_process->form_id ?>"> &nbsp; 
              <?php  }else{ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/result_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true" id="img_result_aso_<?= $aso_and_process->form_id ?>"> &nbsp; 
           <?php } ?>
         <?php }else { ?>
          <?php if($aso_and_process->flag_ast_result == 0){ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/result.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true" id="img_result_aso_<?= $aso_and_process->form_id ?>"> &nbsp; 
              <?php  }else{ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/result_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true" id="img_result_aso_<?= $aso_and_process->form_id ?>"> &nbsp; 
           <?php } ?>

         <?php } ?>
            <?php if($aso_and_process->flag_ast_decision == 0){ ?>

            <img src="<?= base_url(); ?>/components/gs_theme/images/discussion.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true" id="img_decision_aso_<?= $aso_and_process->form_id ?>"> &nbsp;
            <?php }else{ ?>

              <img src="<?= base_url(); ?>/components/gs_theme/images/discussion_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true" id="img_decision_aso_<?= $aso_and_process->form_id ?>"> &nbsp;
            <?php } ?>

            <?php if($aso_and_process->flag_ast_allocation == 0){ ?>

                <img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true" id="img_allocation_aso_<?= $aso_and_process->form_id ?>"> &nbsp;
            <?php }else{ ?>
               <img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true" id="img_allocation_aso_<?= $aso_and_process->form_id ?>"> &nbsp;
            <?php } ?>


           <?php  if($aso_and_process->flag_comm_ast_result == 0){ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true" id="img_result_aso_<?= $aso_and_process->form_assessment_result ?>">
            <?php }else{ ?>
              <img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
            <?php } ?>

               </div>

            </td>
            <td class="text-center">
         <?php if($aso_and_process->form_discussion_date == ''){ ?>
            <strong id="form_discussion_date_aso_<?= $aso_and_process->form_id ?>">-</strong><br/>
          <?php }else{ ?>
            <strong><?= $aso_and_process->form_discussion_date ?></strong><br />
         <?php } ?>

          <?php if($aso_and_process->dis_done_on == ''){ ?>
              <div class="col-md-6 no-padding text-left"><small id="dis_aso_done_on_<?= $aso_and_process->form_id ?>">-</small></div>
          <?php } else{ ?>
            <div class="col-md-6 no-padding text-left" id="dis_aso_done_on_<?= $aso_and_process->form_id ?>" ><small><?= $aso_and_process->dis_done_on ?></small></div>
         <?php } ?>

          <?php if($aso_and_process->dis_name_code == ''){ ?>
            <div class="col-md-6 no-padding text-right"><small id="dis_name_code_<?= $aso_and_process->form_id ?>">-</small></div>
          <?php }else{ ?>
            <div class="col-md-6 no-padding text-right"><small><?= $aso_and_process->dis_name_code ?></small></div>
          <?php } ?>

            <div class="text-center">
            <hr class="lowMargin" />

          <?php if($aso_and_process->flag_dis_reminder == 0){ ?>
              <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
          <?php }else{ ?>
            <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
          <?php } ?>
          <?php if($aso_and_process->previous_batch_id!=''){ ?>
              <?php if($aso_and_process->flag_rdis_presence == 0){ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp;
              <?php }else{ ?>

                  <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
              <?php } ?>
            <?php }else{ ?>

              <?php if($aso_and_process->flag_dis_presence == 0){ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp;
              <?php }else{ ?>
                  <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
              <?php } ?>

            <?php } ?>


          <?php if($aso_and_process->flag_dis_followup == 0){ ?>
            <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
          <?php }else{ ?>
            <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
          <?php } ?>
          
            </div>
            </td>
            <td class="text-left">

          <?php if($aso_and_process->form_discussion_result == ''){ ?>
            <div class="col-md-12 text-left" id="form_discussion_result_<?= $aso_and_process->form_id ?>">-</div>
          <?php }else{ ?>
            <div class="col-md-12 text-left" id="form_discussion_result_<?= $aso_and_process->form_id ?>"><?= $aso_and_process->form_discussion_result ?></div>
          <?php } ?>

          <?php if($aso_and_process->form_discussion_decision == ''){ ?>
            <div class="col-md-12 text-right" id="form_discussion_decision_<?= $aso_and_process->form_id ?>">-</div>
          <?php }else{  ?>
            <div class="col-md-12 text-right" id="form_discussion_decision_<?= $aso_and_process->form_id ?>">
              <input type="hidden" name="dis_decision" id="dis_decision" id="form_dis_<?= $aso_and_process->form_id ?>" value="<?= $aso_and_process->form_id ?>">
              <?php if($aso_and_process->previous_batch_id!=''){
                  echo '-';
              }else{
                echo $aso_and_process->form_discussion_decision;
              } ?></div>
          <?php  } ?>
            <div class="text-center no-padding">
            <hr class="lowMargin" />
          <?php if($aso_and_process->flag_dis_result == 0){ ?>
            <img id="img_result_<?= $aso_and_process->form_id ?>" src="<?= base_url(); ?>/components/gs_theme/images/result.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
          <?php }else{ ?>
              <img id="img_result_<?= $aso_and_process->form_id ?>" src="<?= base_url(); ?>/components/gs_theme/images/result_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
          <?php } ?>
        <?php if($aso_and_process->previous_batch_id!= ''){ ?>
          <?php if($aso_and_process->flag_rdis_decision == 0){ ?>
            <img id="img_decision_<?= $aso_and_process->form_id; ?>" src="<?= base_url(); ?>/components/gs_theme/images/discussion.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true" id="img_discussion_<?= $aso_and_process->form_id; ?>"> &nbsp;
          <?php }else{ ?>
              <img id="img_decision_<?= $aso_and_process->form_id; ?>" src="<?= base_url(); ?>/components/gs_theme/images/discussion_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;
          <?php } ?>
        <?php }else{ ?>
          <?php if($aso_and_process->flag_rdis_decision == 0){ ?>
            <img id="img_decision_<?= $aso_and_process->form_id; ?>" src="<?= base_url(); ?>/components/gs_theme/images/discussion.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;
          <?php }else{ ?>
              <img id="img_decision_<?= $aso_and_process->form_id; ?>" src="<?= base_url(); ?>/components/gs_theme/images/discussion_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;
          <?php } ?>

        <?php } ?>
        <?php if($aso_and_process->previous_batch_id!= ''){ ?>
              <?php if($aso_and_process->flag_rdis_allocation == 0){ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true" id="img_allocation_<?= $aso_and_process->form_id; ?>"> &nbsp;
              <?php }else{ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true" id="img_allocation_<?= $aso_and_process->form_discussion_decision; ?>"> &nbsp;
              <?php } ?>
            <?php }else{ ?>
              <?php if($aso_and_process->flag_dis_allocation == 0){ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" id="img_allocation_<?= $aso_and_process->form_id; ?>" data-pin-nopin="true"> &nbsp;
              <?php }else{ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;
              <?php } ?>

            <?php } ?>

          <?php if($aso_and_process->flag_comm_dis_result == 0){ ?>
            <img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
          <?php }else{ ?>
            <img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">  
          <?php } ?>
            </div>

            </td>
             <td class="text-left"><span id="offer_<?= $aso_and_process->form_id?>"><?= $aso_and_process->final_decision ?></span></td>
          <?php if($aso_and_process->previous_batch_id != ''){ ?>
                <?php if($aso_and_process->form_status_id == 2 && $aso_and_process->form_status_stage_id == 2){ ?>
                   <td class="text-center"><small>Mark Attendance to proceed<br /><br />  
                    <a href="javascript:void(0)" id="mark_present_aso" data-re_assistment="<?= $aso_and_process->previous_batch_id?>" data-presesnt="<?= $aso_and_process->form_id?>">Mark as Present</a></small>

                <?php }else if($aso_and_process->form_status_id == 8 && $aso_and_process->form_status_stage_id == 19 && $aso_and_process->pvs_form_assessment_result != ""){ ?>
                    <td class="text-center"><small>Mark Attendance to proceed<br /><br />  
                    <a href="javascript:void(0)" id="mark_present_aso" data-re_assistment="<?= $aso_and_process->previous_batch_id?>" data-presesnt="<?= $aso_and_process->form_id?>">Mark as Present</a></small>
                    
              <?php }else if($aso_and_process->form_status_id == 3 && $aso_and_process->form_status_stage_id == 4 && $aso_and_process->pvs_form_assessment_result != ""){ ?>
                    <td class="text-center"><small>Mark Attendance to proceed<br /><br />  
                    <a href="javascript:void(0)" id="mark_present_aso" data-re_assistment="<?= $aso_and_process->previous_batch_id?>" data-presesnt="<?= $aso_and_process->form_id?>">Mark as Present</a></small>

                <?php }else if($aso_and_process->form_status_id == 9 && $aso_and_process->form_status_stage_id == 13 && $aso_and_process->pvs_form_assessment_result != ""){ ?>
                    <td class="text-center"><small>Mark Attendance to proceed<br /><br />  
                    <a href="javascript:void(0)" id="mark_present_aso" data-re_assistment="<?= $aso_and_process->previous_batch_id?>" data-presesnt="<?= $aso_and_process->form_id?>">Mark as Present</a></small>
                <?php }else if($aso_and_process->form_status_id == 3 && $aso_and_process->form_status_stage_id == 13){ ?>
                    <td class="text-center"><small>Mark Attendance to proceed<br /><br />  
                    <a href="javascript:void(0)" id="mark_present_aso" data-re_assistment="<?= $aso_and_process->previous_batch_id?>" data-presesnt="<?= $aso_and_process->form_id?>">Mark as Present</a></small>

                <?php }else{ ?>
                   <td class="text-center"><small><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal4" id="view_and_edit" data-form="<?= $aso_and_process->form_id?>">View & Edit</a><br /><br /> 
                <?php } ?>

          <?php }else{ ?>

              <?php if($aso_and_process->form_status_id == 2 && $aso_and_process->form_status_stage_id == 2){ ?>
                   <td class="text-center"><small>Mark Attendance to proceed<br /><br />  
                    <a href="javascript:void(0)" id="mark_present_aso" data-re_assistment="<?= $aso_and_process->previous_batch_id?>" data-presesnt="<?= $aso_and_process->form_id?>">Mark as Present</a></small>
   
              <?php }else if($aso_and_process->form_status_id == 3 && $aso_and_process->form_status_stage_id == 4 && $aso_and_process->pvs_form_assessment_result != ""){ ?>
                    <td class="text-center"><small>Mark Attendance to proceed<br /><br />  
                    <a href="javascript:void(0)" id="mark_present_aso" data-re_assistment="<?= $aso_and_process->previous_batch_id?>" data-presesnt="<?= $aso_and_process->form_id?>">Mark as Present</a></small>
                <?php }else if($aso_and_process->form_status_id == 9 && $aso_and_process->form_status_stage_id == 13 && $aso_and_process->pvs_form_assessment_result != ""){ ?>
                    <td class="text-center"><small>Mark Attendance to proceed<br /><br />  
                    <a href="javascript:void(0)" id="mark_present_aso" data-re_assistment="<?= $aso_and_process->previous_batch_id?>" data-presesnt="<?= $aso_and_process->form_id?>">Mark as Present</a></small>
                <?php }else if($aso_and_process->form_status_id == 3 && $aso_and_process->form_status_stage_id == 13){ ?>
                    <td class="text-center"><small>Mark Attendance to proceed<br /><br />  
                    <a href="javascript:void(0)" id="mark_present_aso" data-re_assistment="<?= $aso_and_process->previous_batch_id?>" data-presesnt="<?= $aso_and_process->form_id?>">Mark as Present</a></small>
                <?php }else{ ?>
                   <td class="text-center"><small><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal4" id="view_and_edit" data-form="<?= $aso_and_process->form_id?>">View & Edit</a><br /><br /> 
                <?php } ?>
          <?php } ?>


          
          </td></tr>
   <?php } ?>

        <?php foreach($batch_aso_old as $aso_and_process){ ?>
          <?php if($aso_and_process->form_status_stage_id == 7){ ?>
            <tr class="grayAlert">
          <?php }else{ ?>
            <tr>
          <?php } ?>
          
          <td class="text-center" id=""><?= $aso_and_process->form_no ?></td>
          <td><?= $aso_and_process->applicant_name ?><br /><small><?= $aso_and_process->father_name ?></small></td>
          <td class="text-center">
          <strong><?= $aso_and_process->form_assessment_date ?></strong><br />

          <!-- IF Assessment Extension is empty  -->
          <?php if($aso_and_process->ast_done_on == ''){ ?>
            <div class="col-md-6 no-padding text-left"><small>-</small></div>
          <?php }else{ ?>
            <div class="col-md-6 no-padding text-left"><small><?= $aso_and_process->ast_done_on ?></small></div>
          <?php } ?>

          <?php if($aso_and_process->pvs_ast_name_code == ''){ ?>
            <div class="col-md-6 no-padding text-right"><small>-</small></div>
          <?php }else{ ?>
            <div class="col-md-6 no-padding text-right"><small><?= $aso_and_process->pvs_ast_name_code ?></small></div>
          <?php } ?>

          <div class="text-center">
              <?php if($aso_and_process->flag_ast_reminder == 0){ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true">&nbsp;
              <?php  }else{ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true">&nbsp;
             <?php } ?>

             <?php if($aso_and_process->flag_ast_presence == 0){ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true">&nbsp;
           
            <?php }else{ ?>
              <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true">&nbsp;  <?php } ?>

            <?php if($aso_and_process->flag_ast_followup == 0){ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
            <?php  }else{ ?>
              <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
            <?php } ?>
                </div>
          </td>
            <td class="text-left">

          <?php if($aso_and_process->pvs_form_assessment_result == ''){ ?>
            <div class="col-md-12 text-left">-</div> 
         <?php }else{ ?>
            <div class="col-md-12 text-left"><?= $aso_and_process->pvs_form_assessment_result ?></div>
          <?php } ?>
          
          <?php if($aso_and_process->pvs_form_assessment_decision == ''){ ?>
            <div class="col-md-12 text-right">-</div>
          <?php } 
          else{ ?>
            <div class="col-md-12 text-right"><?= $aso_and_process->pvs_form_assessment_decision ?></div>
          <?php } ?>

           <div class="text-center no-padding">
               <hr class="lowMargin" />
              <?php if($aso_and_process->flag_ast_result == 0){ ?>
                <img id="img_result_<?= $aso_and_process->form_id ?>" src="<?= base_url(); ?>/components/gs_theme/images/result.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
           <?php  }else{ ?>
              <img id="img_result_<?= $aso_and_process->form_id ?>" src="<?= base_url(); ?>/components/gs_theme/images/result_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 

           <?php } ?>

            <?php if($aso_and_process->flag_ast_decision == 0){ ?>

            <img src="<?= base_url(); ?>/components/gs_theme/images/discussion.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;
            <?php }else{ ?>

              <img src="<?= base_url(); ?>/components/gs_theme/images/discussion_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;
            <?php } ?>

            <?php if($aso_and_process->flag_ast_allocation == 0){ ?>

                <img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;
            <?php }else{ ?>
               <img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;
            <?php } ?>


           <?php  if($aso_and_process->flag_comm_ast_result == 0){ ?>
                <img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
            <?php }else{ ?>
              <img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
            <?php } ?>

               </div>

            </td>
            <td class="text-center">
         <?php if($aso_and_process->form_discussion_date == ''){ ?>
            <strong>-</strong><br/>
          <?php }else{ ?>
            <strong><?= $aso_and_process->form_discussion_date ?></strong><br />
         <?php } ?>

          <?php if($aso_and_process->dis_done_on == ''){ ?>
              <div class="col-md-6 no-padding text-left"><small id="dis_done_on_<?= $aso_and_process->form_id ?>">-</small></div>
          <?php } else{ ?>
            <div class="col-md-6 no-padding text-left"><small><?= $aso_and_process->dis_done_on ?></small></div>
         <?php } ?>

          <?php if($aso_and_process->pvs_dis_name_code == ''){ ?>
            <div class="col-md-6 no-padding text-right"><small>-</small></div>
          <?php }else{ ?>
            <div class="col-md-6 no-padding text-right"><small><?= $aso_and_process->pvs_dis_name_code ?></small></div>
          <?php } ?>

            <div class="text-center">
            <hr class="lowMargin" />

          <?php if($aso_and_process->flag_dis_reminder == 0){ ?>
              <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
          <?php }else{ ?>
            <img src="<?= base_url(); ?>/components/gs_theme/images/ReminderIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
          <?php } ?>

          <?php if($aso_and_process->flag_dis_presence == 0){ ?>
            <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp;
          <?php }else{ ?>
              <img src="<?= base_url(); ?>/components/gs_theme/images/PresenceIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;
          <?php } ?>


          <?php if($aso_and_process->flag_dis_followup == 0){ ?>
            <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
          <?php }else{ ?>
            <img src="<?= base_url(); ?>/components/gs_theme/images/FollowUpIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
          <?php } ?>
          
            </div>
            </td>
            <td class="text-left">

          <?php if($aso_and_process->pvs_form_discussion_result == ''){ ?>
            <div class="col-md-12 text-left">-</div>
          <?php }else{ ?>
            <div class="col-md-12 text-left"><?= $aso_and_process->pvs_form_discussion_result ?></div>
          <?php } ?>

          <?php if($aso_and_process->pvs_form_discussion_decision == ''){ ?>
            <div class="col-md-12 text-right">-</div>
          <?php }else{  ?>
            <div class="col-md-12 text-right"><?= $aso_and_process->pvs_form_discussion_decision ?></div>
          <?php  } ?>
            <div class="text-center no-padding">
            <hr class="lowMargin" />
          <?php if($aso_and_process->flag_dis_result == 0){ ?>
            <img id="img_result_<?= $aso_and_process->form_id ?>" src="<?= base_url(); ?>/components/gs_theme/images/result.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
          <?php }else{ ?>
              <img id="img_result_<?= $aso_and_process->form_id ?>" src="<?= base_url(); ?>/components/gs_theme/images/result_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
          <?php } ?>

          <?php if($aso_and_process->flag_dis_decision == 0){ ?>
            <img src="<?= base_url(); ?>/components/gs_theme/images/discussion.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;
          <?php }else{ ?>
              <img src="<?= base_url(); ?>/components/gs_theme/images/discussion_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;
          <?php } ?>
          <?php if($aso_and_process->flag_dis_allocation == 0){ ?>
            <img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;
          <?php }else{ ?>
            <img src="<?= base_url(); ?>/components/gs_theme/images/AllocationIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;
          <?php } ?>

          <?php if($aso_and_process->flag_comm_dis_result == 0){ ?>
            <img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
          <?php }else{ ?>
            <img src="<?= base_url(); ?>/components/gs_theme/images/CommunicationIcon_active.png") title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">  
          <?php } ?>
            </div>

            </td>
          <td class="text-left">
            <span id="offer_<?= $aso_and_process->form_id ?>"></span></td>
                 <td class="text-center"><strong>
                Re-Assessment to Batch <?= $aso_and_process->batch_category ?>
              </strong> 
              </tr>
        <?php } ?>
      

  </tbody>
  </table>
   </div>
  </div>

</div>


</div>

<script >
  $(document).ready(function(){

      $("#result_decission").validate({
        rules:{
          assessment_result_grade:{
            required:true,
          },
          assessment_result_teacher:{
            required:true
          }
        },
            submitHandler: function (form) {
            $("#Generations_AjaxLoader").show();  
                    $(form).ajaxSubmit({
                        type: "POST",
                        cache:false,
                        url:"<?= base_url(); ?>/index.php/gs_admission/admission_aso_and_process/result_decision_insert",
                        success: function (data) {
                          debugger;
                          var form_id =  $("#form_id").val();
                          var batch_id= $('#batch :selected').val();
                          $.ajax({
                            type:"POST",
                            cache:false,
                            data:{form_no:form_id},
                            url:"<?= base_url(); ?>/index.php/gs_admission/admission_aso_and_process/view_and_updated_status",
                            success:function(e){
                              $.ajax({
                                  type:"POST",
                                  cache:false,
                                  data:{batch_id:batch_id},
                                  url:"<?php echo base_url(); ?>index.php/gs_admission/admission_aso_and_process/get_detail_aso_and",
                                  success:function(f){
                                     $('#aso_and_data').html(f);
                                     $('#Generations_AjaxLoader').hide();
                                    // $('#AdmissionFormListing').append(e);
                                  }
                                });
                              $("#myModal4").modal("hide");
                            }


   

    }


    $(document).on("change", "#admission_criteria_for_a_level", function()
{

  var this_Value = $(this).val();
  if(this_Value == "EAO" )
  {
    $("#conditional").show("slow");
  }else{ 
    $("#conditional").hide("slow"); 
  }
  $("label.error").hide();
  $(".error").removeClass("error");
  $("em.invalid").hide();
  $("#conditional").removeClass("invalid");

});



    if($("#discussion_detail").length){

      $("#discussion_detail").validate({
              rules:{
              disscussion_result:{
                required:true,
              },
              disscussion_teacher:{
                required:true
              },
              conditional: { 
                

                required: { 
                  depends: function(element){
                      if( $("#admission_criteria_for_a_level").val() == "EAO" ) 
                        {
                          
                          if( $("#conditional").val() == "" )
                          {
                            return true
                          }else
                          {
                            return false
                          }

                        } 
                        else
                        {
                          return false
                        }
                    } 
                  } 

              },
          },

        submitHandler: function (form) {
          $("#Generations_AjaxLoader").show();
                    $(form).ajaxSubmit({
                        type: "POST",
                        cache:false,
                        url:"<?= base_url(); ?>/index.php/gs_admission/admission_aso_and_process/discussion_decision_insert_alevel",
                        success: function (data) {

                          var form_id =  $("#form_id").val();

                          $("#img_result_"+form_id).prop("src","<?= base_url(); ?>/components/gs_theme/images/result_active.png");

                          $("#img_decision_"+form_id).prop("src","<?= base_url(); ?>/components/gs_theme/images/discussion_active.png");

                          $("#img_allocation_"+form_id).prop("src","<?= base_url(); ?>/components/gs_theme/images/AllocationIcon_active.png");

                          
                          $.ajax({
                            type:"POST",
                            cache:false,
                            data:{form_no:form_id},
                            url:"<?= base_url(); ?>/index.php/gs_admission/admission_aso_and_process/view_and_updated_status",
                            success:function(e){
                              var jsonData = JSON.parse(e);
                              var ast_name_code;
                              var form_assessment_result;
                              var ast_name_code;
                              var dis_name_code;
                              var form_discussion_result;
                              var form_discussion_decision;
                              var Offer ;
                              for (var i = 0; i < jsonData.length; i++){

                                ast_name_code = jsonData[i].ast_name_code;
                                form_assessment_result = jsonData[i].form_assessment_result;
                                //ast_name_code = jsonData[i].ast_name_code; 
                                dis_name_code = jsonData[i].dis_name_code;
                                form_discussion_result = jsonData[i].form_discussion_result;
                                form_discussion_decision = jsonData[i].form_discussion_decision;
                                
                                
                              }

                              $("#ast_name_code_"+form_id).text(ast_name_code);
                              $("#form_assessment_result_"+form_id).text(form_assessment_result);
                              //$("#ast_name_code_"+form_id).text(ast_name_code);
                              $("#dis_name_code_"+form_id).text(dis_name_code);
                              $("#form_discussion_result_"+form_id).text(form_discussion_result);
                              $("#form_discussion_decision_"+form_id).text(form_discussion_decision);

                              if(form_discussion_decision == ""){

                              }
                              else{
                                $("#offer_"+form_id).text("");
                              }

                              $("#myModal4").modal("hide");
                              $("#Generations_AjaxLoader").hide();
                            }
                          });
                          

                        }
                    });
                }


      });

    }



    });
    </script>



