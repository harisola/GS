<style> tr.redAlert { background:#fbdfdf !important; }</style>
<div class="container" id="FollowUpScreen">
   <?php
      if(!empty($followUpLists)){
        $countFollowup = count( $followUpLists );
      }else{
      $countFollowup=0;
      }
      
      if(!empty($CommunicationLists)){
        $countComm = count( $CommunicationLists );
      }else{
        $countComm=0;
      }
      if(!empty($AllApplicantLists)){
        $countAll = count( $AllApplicantLists );
      }else{
        $countAll=0;
      }
      
      if(!empty($get_offer_user_expire)){
        $countUserExpire = count( $get_offer_user_expire );
      }else{
        $countUserExpire=0;
      }

      if(!empty($get_followup_hold)){
        $countfollowup_hold = count( $get_followup_hold );
      }else{
        $countfollowup_hold=0;
      }
      
      ?>
   <div class="row">
      <div class="col-md-12">
         <h2 class="withBorderBottom">Front Office Followup</h2>
      </div>
      <div class="col-md-12" id="followup_lists">
         <div class="MaroonBorderBox">
            <h3>Front Office Followup</h3>
            <div class="inner20 paddingLeft20 paddingRight20" id="paddingRight20">
               <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#FollowUpTab">Follow Up (<?=$countFollowup;?>)</a></li>
                  <li><a data-toggle="tab" href="#CommunicationTab">Communication (<?=$countComm;?>)</a></li>
                  <li><a data-toggle="tab" href="#AllApplicants">All Applicants (<?=$countAll;?>)</a></li>
                  <li><a data-toggle="tab" href="#offerUserExpire">Internal MisHandle (<?=$countUserExpire;?>)</a></li>


                  <li><a data-toggle="tab" href="#FollowupHold">Followup Hold (<?=$countfollowup_hold;?>)</a></li>

               </ul>
               <!-- nav-tabs -->
               <div class="tab-content">
                  <div id="FollowUpTab" class="tab-pane fade in active">
                     <?php //var_dump($followUpLists);  ?>
                     <table id="AdmissionFormListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                              <th width="" class="text-center">Form #</th>
                              <th width="">Applicant Name<br /><small>Submission Date</small></th>
                              <th width="">Grade Name </th>
                              <th width="">Father Name<br /><small>Father/Mother Mobile</small></th>
                              <th width="" class="text-center no-sort">Current<br />Standing</th>
                              <th width="" class="text-center">Current Status</th>
                           </tr>
                        </thead>
                        <tfoot>
                           <tr>
                              <td colspan="5">Filter list by Current Standing</td>
                           </tr>
                        </tfoot>
                        <tbody>
                           <?php //var_dump($followUpLists); 
                              if(!empty($followUpLists)){?>
                           <?php foreach( $followUpLists as $fl ){ ?>
                           <?php 
                              if( $fl["day_passed"] > 2 ){
                                $redClass = "grayAlert";
                              }else{
                                $redClass = "";
                              } 
                               ?>
                           <tr class="<?=$redClass;?>">
                              <td class="text-center"><?php echo str_pad( $fl["form_no"],3,"0",STR_PAD_LEFT); ?></td>
                              <td><a href="#" class="followup_row" data-id="followup_<?=$fl["form_id"];?>_<?=$fl["current_standing"];?>" ><?=$fl["applicant_name"];?></a><br /><small>
                                 <?php echo date("j-F-Y", strtotime( $fl["form_submission_date"] ) );?>
                                 <i><?=$fl["day_diff"];?></i></small>
                              </td>
                              <td><?=$fl["grade_name"];?></td>
                              <td><?=$fl["father_name"];?><br /><small><?=$fl["father_mobile"];?> / <?=$fl["mother_mobile"];?></small></td>
                              <td class="text-center"><?=$fl["current_standing"];?></td>
                              <td class="text-left"><?=$fl["current_status_1"];?> </td>
                           </tr>
                           <?php } ?>
                           <?php } ?>
                        </tbody>
                     </table>
                     <!-- StaffListing -->
                  </div>



                  <!-- FollowUpTab -->
                  <div id="CommunicationTab" class="tab-pane fade">
                     <div class="absoluteDrop col-md-6">
                        <select required class="">
                           <option value="" disabled selected>Filter list by Current Standing</option>
                           <option value="">Assessment Only</option>
                           <option value="">Assessment & Discussion</option>
                           <option value="">Discussion Only</option>
                           <option value="">Offer</option>
                           <option value="">Billing</option>
                        </select>
                     </div>
                     <!-- absoluteDrop -->
                     <table id="CommunicationListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                              <th width="" class="text-center">Form #</th>
                              <th width="">Applicant Name<br /><small>Submission Date</small></th>
                              <th width="">Grade Name </th>
                              <th width="">Father Name<br /><small>Father/Mother Mobile</small></th>
                              <th width="" class="text-center no-sort">Current<br />Standing</th>
                              <th width="" class="text-center">Current Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              //var_dump($AllApplicantLists); 
                              
                              if(!empty($CommunicationLists)){ ?>
                           <?php foreach( $CommunicationLists as $fl ){ ?>
                           <tr>
                              <td class="text-center"><?php echo str_pad( $fl["form_no"],3,"0",STR_PAD_LEFT); ?></td>
                              <td><a href="#" class="followup_row" data-id="communication_<?=$fl["form_id"];?>_<?=$fl["current_standing"];?>" ><?=$fl["applicant_name"];?></a><br /><small>
                                 <?php echo date("j-F-Y", strtotime( $fl["form_submission_date"] ) );?>
                                 <i><?=$fl["day_diff"];?></i></small>
                              </td>
                              <td><?=$fl["grade_name"];?></td>
                              <td><?=$fl["father_name"];?><br /><small><?=$fl["father_mobile"];?> / <?=$fl["mother_mobile"];?></small></td>
                              <td class="text-center"><?=$fl["current_standing"];?></td>
                              <td class="text-left"><?=$fl["current_status_1"];?> </td>
                           </tr>
                           <?php } ?>
                           <?php } ?>                  
                        </tbody>
                     </table>
                     <!-- StaffListing -->
                  </div>
                  <!-- CommunicationTab -->
                  <div id="AllApplicants" class="tab-pane fade">
                     <div class="absoluteDrop col-md-6">
                        <select required class="">
                           <option value="" disabled selected>Filter list by Current Standing</option>
                           <option value="">Assessment Only</option>
                           <option value="">Assessment & Discussion</option>
                           <option value="">Discussion Only</option>
                           <option value="">Offer</option>
                           <option value="">Billing</option>
                        </select>
                     </div>
                     <!-- absoluteDrop -->
                     <?php //var_dump($AllApplicantLists); ?>
                     <table id="AllApplicantList" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                              <th width="" class="text-center">Form #</th>
                              <th width="">Applicant Name<br /><small>Submission Date</small></th>
                              <th width="">Grade Name </th>
                              <th width="">Father Name<br /><small>Father/Mother Mobile</small></th>
                              <th width="" class="text-center no-sort">Current<br />Standing</th>
                              <th width="" class="text-center">Current Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php //var_dump($AllApplicantLists); 
                              if( !empty($AllApplicantLists) ){ ?>
                           <?php foreach( $AllApplicantLists as $fl ){ ?>
                           <tr>
                              <td class="text-center"><?php echo str_pad( $fl["form_no"],3,"0",STR_PAD_LEFT); ?></td>
                              <td><a href="#" class="followup_row" data-id="allApplications_<?=$fl["form_id"];?>_<?=$fl["current_standing"];?>" ><?=$fl["applicant_name"];?></a><br /><small>
                                 <?php echo date("j-F-Y", strtotime( $fl["form_submission_date"] ) );?>
                                 <i><?=$fl["day_diff"];?></i></small>
                              </td>
                              <td><?=$fl["grade_name"];?></td>
                              <td><?=$fl["father_name"];?><br /><small><?=$fl["father_mobile"];?> / <?=$fl["mother_mobile"];?></small></td>
                              <td class="text-center"><?=$fl["current_standing"];?></td>
                              <td class="text-left"><?=$fl["current_status_1"];?> </td>
                           </tr>
                           <?php }  ?>
                           <?php } ?>       
                        </tbody>
                     </table>
                     <!-- StaffListing -->
                  </div>
                  <!-- AllApplicants -->
                  <div id="offerUserExpire" style="padding:20px ;" class="tab-pane fade">
                     <table id="internalMissHandle" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                              <th width="" class="text-center">Form #</th>
                              <th width="">Applicant Name<br /><small>Submission Date</small></th>
                              <th width="">Grade Name </th>
                              <th width="">Father Name<br /><small>Father/Mother Mobile</small></th>
                              <th width="" class="text-center no-sort">Current<br />Standing</th>
                              <th width="" class="text-center">Current Status</th>
                           </tr>
                        </thead>
                        <tfoot>
                           <tr>
                              <td colspan="5">Filter list by Current Standing</td>
                           </tr>
                        </tfoot>
                        <tbody>
                           <?php //var_dump($followUpLists); 
                              if(!empty($get_offer_user_expire)){?>
                           <?php foreach( $get_offer_user_expire as $fl ){ ?>
                           <?php 
                              if( $fl["day_passed"] > 2 ){
                                $redClass = "grayAlert";
                              }else{
                                $redClass = "";
                              } 
                               ?>
                           <tr class="<?=$redClass;?>">
                              <td class="text-center"><?php echo str_pad( $fl["form_no"],3,"0",STR_PAD_LEFT); ?></td>
                              <td><a href="#" class="followup_row" data-id="internalMishandle_<?=$fl["form_id"];?>_<?=$fl["current_standing"];?>" ><?=$fl["applicant_name"];?></a><br /><small>
                                 <?php echo date("j-F-Y", strtotime( $fl["form_submission_date"] ) );?>
                                 <i><?=$fl["day_diff"];?></i></small>
                              </td>
                              <td><?=$fl["grade_name"];?></td>
                              <td><?=$fl["father_name"];?><br /><small><?=$fl["father_mobile"];?> / <?=$fl["mother_mobile"];?></small></td>
                              <td class="text-center"><?=$fl["current_standing"];?></td>
                              <td class="text-left"><?=$fl["current_status_1"];?> </td>
                           </tr>
                           <?php } ?>
                           <?php } ?>
                        </tbody>
                     </table>
                     <!-- StaffListing -->
                  </div>




    <div id="FollowupHold" class="tab-pane fade in">
                     <?php //var_dump($followUpLists);  ?>
                     <table id="AdmissionFormListingFollowupHold" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                              <th width="" class="text-center">Form #</th>
                              <th width="">Applicant Name<br /><small>Submission Date</small></th>
                              <th width="">Grade Name </th>
                              <th width="">Father Name<br /><small>Father/Mother Mobile</small></th>
                              <th width="" class="text-center no-sort">Current<br />Standing</th>
                              <th width="" class="text-center">Current Status</th>
                           </tr>
                        </thead>
                        <tfoot>
                           <tr>
                              <td colspan="5">Filter list by Current Standing</td>
                           </tr>
                        </tfoot>
                        <tbody>
                           <?php //var_dump($followUpLists); 
                              if(!empty($get_followup_hold)){?>
                           <?php foreach( $get_followup_hold as $fl ){ ?>
                           <?php 
                              if( $fl["day_passed"] > 2 ){
                                $redClass = "grayAlert";
                              }else{
                                $redClass = "";
                              } 
                               ?>
                           <tr class="<?=$redClass;?>">
                              <td class="text-center"><?php echo str_pad( $fl["form_no"],3,"0",STR_PAD_LEFT); ?></td>
                              <td><a href="#" class="followup_row" data-id="followuphold_<?=$fl["form_id"];?>_<?=$fl["current_standing"];?>" ><?=$fl["applicant_name"];?></a><br /><small>
                                 <?php echo date("j-F-Y", strtotime( $fl["form_submission_date"] ) );?>
                                 <i><?=$fl["day_diff"];?></i></small>
                              </td>
                              <td><?=$fl["grade_name"];?></td>
                              <td><?=$fl["father_name"];?><br /><small><?=$fl["father_mobile"];?> / <?=$fl["mother_mobile"];?></small></td>
                              <td class="text-center"><?=$fl["current_standing"];?></td>
                              <td class="text-left"><?=$fl["current_status_1"];?> </td>
                           </tr>
                           <?php } ?>
                           <?php } ?>
                        </tbody>
                     </table>
                     <!-- StaffListing -->
                  </div>





                  <!-- Internal MisHandler -->
               </div>
               <!-- tab-content -->
            </div>
            <!-- inner -->
         </div>
         <!-- MaroonBorderBox -->
      </div>
      <!-- col-md-7 -->
      <div class="col-md-5" style="display:none;" id="followupComments">
         <!-- // Ajax Response Will Be Show Here -->
      </div>
      <!-- col-md-4 -->
   </div>
   <!-- row -->
   <!-- Two column layout END -->
</div>
<!-- container -->
<div style="display:none;" id="ajaxloader2">
   <p> <br /> <br /> <br /> <br /> Please Wait .. </p>
</div>
<style>
   #ajaxloader2{background-color: silver}
   #ajaxloader2{
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
</style>