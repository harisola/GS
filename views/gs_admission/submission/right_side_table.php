<table id="AllApplicantList" class="table table-striped table-bordered table-hover boldHead" cellspacing="0" width="100%"> 
  <thead> 
	  <tr> 
		  <th width="" class="text-center valignMiddle">Form #</th> 
                              <th width="">Applicant Name<br /><small>Father Name</small></th> 
                              <th width="" class="text-center valignMiddle">Batch ID</th>
                              <th width="" class="valignMiddle">Submission Date</th> 
                              <th width="" class="text-center no-sort valignMiddle">Status</th>
                              <th width="" class="text-center valignMiddle">Grade</th>
                              <th width="" class="no-sort valignMiddle">Action</th>
	  </tr>
  </thead>
  <tbody> 
 <?php //var_dump( $formlist ); ?>
	<?php if( !empty($formlist )){ 
			foreach( $formlist AS $fl ){ ?>
		 <tr>
                              <td class="text-center"><?php echo str_pad( $fl["Form_no"],5,"0",STR_PAD_LEFT); ?></td>
                              <td><?=$fl["Applicate_name"];?><br /><small><?=$fl["Father_name"];?></small></td>
                              <td class="text-center"><span class="bold"><?=$fl["batch_name"];?></span><br /><small class="pull-left"><?=$fl["form_assessment_date"];?></small><small class="pull-right"><?=$fl["form_assessment_time"];?></small></td>
                              <td><?=$fl["submission_unix_date"];?></td>
                              <td class="text-center">
							  <?php 
							  
							  if( $fl["done_reminder"] == 0 ){ ?>
								 <img src="<?php echo base_url();?>/components/gs_theme/images/ReminderIcon.png" title="Reminder" width="20" data-toggle="tooltip" data-placement="top" />  
							  <?php }else{ ?>
								  <img src="<?php echo base_url();?>/components/gs_theme/images/ReminderIcon_active.png" title="Reminder" width="20" data-toggle="tooltip" data-placement="top" /> 
							  <?php } ?>&nbsp;
							  
							  <?php 
							  if( $fl["done_presence"] == 0 ){ ?>
							  <img src="<?php echo base_url();?>/components/gs_theme/images/PresenceIcon.png" title="Presence" width="20" data-toggle="tooltip" data-placement="top" /> 
							  <?php }else{ ?>
							  <img src="<?php echo base_url();?>/components/gs_theme/images/PresenceIcon_active.png" title="Presence" width="20" data-toggle="tooltip" data-placement="top" /> 
							  <?php } ?>&nbsp;
							  
							  <?php 
							  if( $fl["done_followup"] == 0 ){ ?>
							  <img src="<?php echo base_url();?>/components/gs_theme/images/FollowUpIcon.png" title="Follow Up" width="20" data-toggle="tooltip" data-placement="top" />
							  <?php }else{ ?>
							  <img src="<?php echo base_url();?>/components/gs_theme/images/FollowUpIcon_active.png" title="Follow Up" width="20" data-toggle="tooltip" data-placement="top" />
							  <?php } ?>
							  </td>
                              <td class="text-center"><p><?=$fl["Grade_name"];?></p></td>
                              <td class="actionArea">
                              	<a href="#" class="hoverAction">Action <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <div class="actionItems">
                                  

                                  <ul>
                                   	 <?php if( $fl["Print_Form_level"] == 1 ){ ?>
                                                <li><a href="#" class="print_discussion_sheet" data-id="<?=$fl["Form_id"];?>" data-batch="<?=$fl["Batch_Title"];?>">Print Discussion Sheet</a></li>
                                            <?php }/*else{ ?>
 <li><a href="#" class="view_n_print" data-id="<?=$fl["Form_id"];?>">Print Form</a></li>
                                            <?php } */?>

                                            <?php if( $fl["Print_Form_pn_n"] == 1 ){ ?>
                                                <li><a href="#" class="print_discussion_sheet_pn_n" data-id="<?=$fl["Form_id"];?>" data-batch="<?=$fl["Batch_Title"];?>">Print Discussion Sheet</a></li>
                                            <?php }?>

                                        <li><a href="#" class="view_n_Edit" data-id="<?=$fl["Form_id"];?>">View and Edit Details</a></li>
                                    </ul><!-- actionIteamsUL-->
                                    
                                </div><!-- actionItems -->
                              </td>
                          </tr>
	  <?php }
	} 	?>

  </tbody> 
</table><!-- StaffListing -->

<script>

/* Data table */ 
$(document).ready(function() {
  $('#AllApplicantList').dataTable();
}); 
</script>