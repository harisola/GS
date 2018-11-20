<div class="container">
    <style>
    .other_mobile_numbers {
    margin: 0px 0px;
}
        .switch {
        position: relative;
        height: 30px;
        width: 145px;
        background:#ccc;
        border-radius: 3px;
        -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
        }
        .switch-label {
        position: relative;
        z-index: 2;
        float: left;
        width: 50%;
        line-height: 30px;
        font-size: 14px;
        color: #000;
        text-align: center;
        cursor: pointer;
        }
        .switch-label:active {
        font-weight: bold;
        }
        .switch-label-off {
        padding-left: 2px;
        }
        .switch-label-on {
        padding-right: 2px;
        }
        /*
        Note: using adjacent or general sibling selectors 
        combined with pseudo classes doesn't work in Safari 
        5.0 and Chrome 12.
        See this article for more info and a potential fix: 
        https://css-tricks.com/webkit-sibling-bug/
        */
        .switch-input {
        display: none;
        }
        .switch-input:checked + .switch-label {
        font-weight: bold;
        color: #fff;
        -webkit-transition: 0.15s ease-out;
        -moz-transition: 0.15s ease-out;
        -o-transition: 0.15s ease-out;
        transition: 0.15s ease-out;
        }
        .switch-input:checked + .switch-label-on ~ .switch-selection {
        /* Note: left: 50% doesn't transition in WebKit */
        left: 70px;
        }
        .switch-selection {
        display: block;
        position: absolute;
        z-index: 1;
        top: 2px;
        left: 2px;
        width: 50%;
        height: 26px;
        background: #65bd63;
        border-radius: 3px;
        background-image: -webkit-linear-gradient(top, #9dd993, #65bd63);
        background-image: -moz-linear-gradient(top, #9dd993, #65bd63);
        background-image: -o-linear-gradient(top, #9dd993, #65bd63);
        background-image: linear-gradient(to bottom, #9dd993, #65bd63);
        -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), 0 0 2px rgba(0, 0, 0, 0.2);
        box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), 0 0 2px rgba(0, 0, 0, 0.2);
        -webkit-transition: left 0.15s ease-out;
        -moz-transition: left 0.15s ease-out;
        -o-transition: left 0.15s ease-out;
        transition: left 0.15s ease-out;
        }
        .switch-blue .switch-selection {
        background: #45c1fd;
        }
        .switch-yellow .switch-selection {
        background: #c4bb61;
        background-image: -webkit-linear-gradient(top, #e0dd94, #c4bb61);
        background-image: -moz-linear-gradient(top, #e0dd94, #c4bb61);
        background-image: -o-linear-gradient(top, #e0dd94, #c4bb61);
        background-image: linear-gradient(to bottom, #e0dd94, #c4bb61);
        }
        input[type="checkbox"][disabled] + label {
        color:#888;
        }
        input[type="checkbox"][disabled] + label:before {
        background:#ccc;
        border:#888;
        }
    </style>
    <!-- Two column layout Start -->
    <div class="row">
        <div class="col-md-12">
            <h2 class="withBorderBottom">Admission Form Submission </h2>
        </div>
        <!-- col-md-12 -->

        <div class="col-md-4" style="">
            <div class="MaroonBorderBox" id="applicantDetails">
                <h3>Applicant Details</h3>
                <div class="inner" id="form_data">
                    <form action="<?=base_url();?>index.php/gs_admission/ajax_base/form_submission" method="POST" name="submission" id="submission" class="issuance">
                        <div class="col-md-12">
                            <div class="FormNoShow">
                                <div class="col-md-3 text-right"><label class="FormNo">Form No.</label> </div>
                                <div class="col-md-9"><input type="text" placeholder="XXXX" name="form_no" id="form_no" />
                                    <input type="hidden" name="form_id" id="form_id" value="" />
                                    <input type="hidden" name="Fmly_Reg_ID" id="Fmly_Reg_ID" value="0" />
                                    <input type="hidden" name="submissionStage" id="submissionStage" value="1" />
                                    <input type="hidden" name="primary_contact" id="primary_contact" value="" />
                                    <input type="hidden" name="Current_Batch_id" id="Current_Batch_id" value="0" />
                                    <input type="hidden" name="Current_Time_Slot_id" id="Current_Time_Slot_id" value="0" />
                                    <input type="hidden" name="Current_Batch_Time_Slot_id_Change" id="Current_Batch_Time_Slot_id_Change" value="0" />
                                </div>
                            </div>
                            <!-- FormNoShow -->
                        </div>

                        <div class="submission_form" style="display: none;"> 
                            <!-- col-md-12 -->
                            <hr />
                            <div class="col-md-12 paddingBottom20" id="previousData">
                                <div class="col-md-6">
                                    <select name="previous_school" id="previous_school">
                                        <option value="Previous School">Previous School</option>
                                        <?php 
                                            if( !empty( $school_lists )){ 
                                              foreach( $school_lists as $sl ){ ?>
                                        <option value="<?=$sl["School_id"];?>"><?=$sl["School_name"];?></option>
                                        <?php }
                                            } ?>
                                        <option value="52000">Other</option>
                                    </select>
                                    <!--input type="text" class="" placeholder="Previous School *" name="previous_school" id="previous_school" / -->
                                </div>
                                <!-- col-md-6 -->
                                <div class="col-md-6" id="otherSchools" style="display:none;">
                                    <input type="text"  placeholder="School Name" name="other_school" id="other_school"  />
                                </div>
                                <!-- col-md-6 -->
                                <div id="addHere" class="col-md-6">
                                    <select name="previous_grade" id="previous_grade">
                                        <option value="Previous Grade">Previous Grade</option>
                                        <?php 
                                            if( !empty( $grade_lists )){ 
                                              foreach( $grade_lists as $gl ){ ?>
                                        <option value="<?=$gl["Grade_id"];?>"><?=$gl["Grade_name"];?></option>
                                        <?php }
                                            } ?>
                                    </select>
                                    <!--input type="text" placeholder="Previous Grade *" name="previous_grade" id="previous_grade" / -->
                                </div>
                                <!-- col-md-6 -->
                            </div>
                            <!-- col-md-12 -->
                            <div class="col-md-12 paddingBottom20">
                                <div class="col-md-6">
                                    <input type="text" class="" placeholder="Official Name *" name="official_name" id="official_name" />
                                </div>
                                <!-- col-md-6 -->
                                <div class="col-md-6">
                                    <input type="text" placeholder="Call Name" name="call_name" id="call_name" />
                                </div>
                                <!-- col-md-6 -->
                            </div>
                            <!-- col-md-12 -->
                            <div class="col-md-12 paddingBottom20">
                                <div class="col-md-6">
                                    <input placeholder="Date of Birth *" type="text" name="date_of_birth" id="date_of_birth">
                                </div>
                                <!-- col-md-6 -->
                                <div class="col-md-6">
                                    <input type="text" placeholder="Admission Grade *" name="admission_grade" id="admission_grade" />
                                    <input type="hidden" name="admission_grade_id" id="admission_grade_id" value="" />
                                </div>
                                <!-- col-md-6 -->
                            </div>
                            <!-- col-md-12 -->
                            <div class="col-md-12 paddingBottom20">
                                <div class="col-md-6">
                                    <select name="gender" id="gender">
                                        <option value="" disabled selected>Gender *</option>
                                        <option value="B">Boy</option>
                                        <option value="G">Girl</option>
                                    </select>
                                </div>
                                <!-- col-md-6 -->
                                <div class="col-md-6" >
                                    <div id='student_mobile_div' ></div>
                                </div>
                                <!-- col-md-6 -->
                            </div>
                            <!-- col-md-12 -->
                            <div class="col-md-12 paddingBottom0">
                                <div class="col-md-6">
                                    <input placeholder="Email" type="text" name="student_email" id="student_email">
                                </div>
                                <!-- col-md-6 -->
                                <div class="col-md-6">
                                    <input placeholder="NIC/Passport" type="text" name="student_nic" id="student_nic">
                                </div>
                                <!-- col-md-6 -->
                            </div>
                            <!-- col-md-12 -->
                            <hr />
                            <div class="col-md-12 paddingBottom20">
                                <div class="col-md-6">
                                    <input type="text" class="" placeholder="Father Name *" name="father_name" id="father_name" /><br /><br />
                                    <input type="text" class="" placeholder="Father Mobile *" name="father_mobile" id="father_mobile" /><br /><br />
                                    <input type="text" class="" placeholder="Father NIC *" name="father_nic" id="father_nic" /><br /><br />
                                    <input type="text" class="" placeholder="Father Email" name="father_email" id="father_email" />
                                </div>
                                <!-- col-md-6 -->
                                <div class="col-md-6">
                                    <input type="text" class="" placeholder="Mother Name *" name="mother_name" id="mother_name" /><br /><Br />
                                    <input type="text" class="" placeholder="Mother Mobile *" name="mother_mobile" id="mother_mobile" /><br /><br />
                                    <input type="text" class="" placeholder="Mother NIC *" name="mother_nic" id="mother_nic" /><br /><br />
                                    <input type="text" class="" placeholder="Mother Email *" name="mother_email" id="mother_email" />
                                </div>
                                <!-- col-md-6 -->
                            </div>
                            <hr />
                            <div class="alevelBox">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <h4>Discussion date</h4>
                                        <div class="switch switch-blue">
                                            <input type="radio" class="switch-input" name="discussion_status" value="today" id="week2" >
                                            <label for="week2" class="switch-label switch-label-off">Today</label>
                                            <input type="radio" class="switch-input" name="discussion_status" value="later" id="month2" checked>
                                            <label for="month2" class="switch-label switch-label-on">Later</label>
                                            <span class="switch-selection" ></span>
                                        </div>
                                        <br />
                                        <div class="col-md-6" style="padding-left:0;">
                                            <input type="date" min="<?php echo date('Y-m-d'); ?>"  class="" placeholder="" name="discussion_date" id="discussion_date" />
                                        </div>
                                        <!-- col-md-6 -->
                                        <div class="col-md-6" style="padding-right:0;">
                                            <input type="time" class="" placeholder="" name="discussion_time" id="discussion_time" />
                                        </div>
                                        <!-- col-md-6 -->
                                    </div>
                                    <!-- col-md-12 -->
                                </div>
                                <!-- col-md-12 -->
                                <hr />
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <textarea placeholder="Comments" rows="4" cols="50" name="comments" id="comments"></textarea>
                                </div>
                                <!-- col-md-12 -->
                            </div>
                            <!-- col-md-12 -->
                            <hr />
                            <div class="col-md-12">
                                <div class="col-md-12 paddingBottom0">
                                    <input type="checkbox" id="ps" name="ps" style="display:block;visibility:hidden;"> <label for="ps">Photos Submitted *</label>
                                </div>
                                <!-- col-md-12 -->
                                <div class="col-md-12 paddingBottom0">
                                    <input type="checkbox" id="bco" name="bco" style="display:block;visibility:hidden;"> <label for="bco">Birth Certificate (O) *</label>
                                </div>
                                <!-- col-md-12 -->
                                <div class="col-md-12 paddingBottom0">
                                    <input type="checkbox" id="bcc" name="bcc" style="display:block;visibility:hidden;"> <label for="bcc">Birth Certificate (C) *</label>
                                </div>
                                <!-- col-md-12 -->    
                            </div>
                            <!-- .col-md-12 -->
                            <hr />
                            <div class="col-md-12">
                                <div class="alevelBox">
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" id="AFF" name="alevelCheckList[]" value="AFF" style="display:block;visibility:hidden;"> <label for="AFF">Admission Form Filled</label>
                                    </div>
                                    <!-- col-md-12 -->
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" id="BCCE" name="alevelCheckList[]" value="BCCE" style="display:block;visibility:hidden;"> <label for="BCCE">Birth Certificate copy</label>
                                    </div>
                                    <!-- col-md-12 -->
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" id="RPSP" name="alevelCheckList[]" value="RPSP" style="display:block;visibility:hidden;"> <label for="RPSP">Recent Passport size photograph</label>
                                    </div>
                                    <!-- col-md-12 -->    
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" id="APCOSR" name="alevelCheckList[]" value="APCOSR" style="display:block;visibility:hidden;"> <label for="APCOSR">Attested Photo copy of school result (IX, X and XI)</label>
                                    </div>
                                    <!-- col-md-12 -->
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" id="ACMER" name="alevelCheckList[]" value="ACMER" style="display:block;visibility:hidden;"> <label for="ACMER">Attested copy mock exam result/first term result</label>
                                    </div>
                                    <!-- col-md-12 -->
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" id="PRFSSE" name="alevelCheckList[]" value="PRFSSE" style="display:block;visibility:hidden;"> <label for="PRFSSE">Principal recommendation form in school sealed envelope</label>
                                    </div>
                                    <!-- col-md-12 -->    
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" value="ACCIE"  id="ACCIE" name="alevelCheckList[]" style="display:block;visibility:hidden;"> <label for="ACCIE">Attested copy of CIE Olevel results and certificates</label>
                                    </div>
                                    <!-- col-md-12 -->    
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" value="ACFFR" id="ACFFR" name="alevelCheckList[]" style="display:block;visibility:hidden;"> <label for="ACFFR">Attested copies of full and final result</label>
                                    </div>
                                    <!-- col-md-12 -->
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" value="CCFPS" id="CCFPS" name="alevelCheckList[]" style="display:block;visibility:hidden;"> <label for="CCFPS">Clearance certificate from previous school</label>
                                    </div>
                                    <!-- col-md-12 -->
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" value="PCCCA"  id="PCCCA" name="alevelCheckList[]" style="display:block;visibility:hidden;"> <label for="PCCCA">Photocopies of certificate of cross curricular activities</label>
                                    </div>
                                    <!-- col-md-12 -->    
                                    <!-- .col-md-12 -->
                                </div>
                                <!-- .col-md-12 -->
                            </div>
                            <hr />
                            <div class="col-md-12">
                                <div class="alert alert-danger col-md-6" style="display:none;" id="error_message">
                                    <strong> Application Form!</strong> Under Process. 
                                </div>
                                <div class="col-md-6" id="submitButton">
                                    <input type="submit" name="greenBTN" id="greenBTN" class="greenBTN" value="Print & Issue" />
                                </div>
                                <!-- col-md-6 -->
                                <div class="col-md-6">
                                    <input type="button" name="clear" class="grayBTN" id="greenBTN3" value="Clear" />
                                </div>
                                <!-- col-md-6 -->
                            </div>
                        </div>
                        <!-- col-md-12 -->
                    </form>
                    <!-- // End Of Form -->
                </div>
                <!-- inner -->
            </div>
            <!-- .MaroonBorderBox -->
        </div>
        <!-- col-md-4 -->
        <!-- // Rigth Side Table Data -->
        <div class="col-md-8">
            <div class="MaroonBorderBox">
                <h3>Admission Form Submission</h3>
                <div class="inner20 paddingLeft20 paddingRight20" id="MaroonBorderBox2">
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
                            <?php 
                                //var_dump( $formlist ); ?>
                            <?php if( !empty($formlist )){ 
                                foreach( $formlist AS $fl ){ ?>
                            <tr>
                                <td class="text-center"><?php echo str_pad( $fl["Form_no"],4,"0",STR_PAD_LEFT); ?></td>
                                <td><?=$fl["Applicate_name"];?><br /><small><?=$fl["Father_name"];?></small></td>
                                <td class="text-center">
                                    <?php if( ($fl["Grade_id"] != 15 ) && ($fl["Grade_id"] != 16 )) { ?>
                                        <span class="bold"><?=$fl["batch_name"];?></span><br />

                                    <?php  } ?>

                                    <small class="pull-left"><?=$fl["form_assessment_date"];?></small><small class="pull-right">          
                                        <?php if( ($fl["Grade_id"] != 15 ) && ($fl["Grade_id"] != 16 ) ) { 
                                            echo $fl["form_assessment_time"];
                                         } else {
                                            $time = strtotime($fl["Form_discussion_time"]);   
                                            echo date("H:i A", $time);
                                         }    ?></small></td>
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
                                <td class="text-center">
                                    <p><?=$fl["Grade_name"];?></p>
                                </td>
                                <td class="actionArea">
                                    <a href="#" class="hoverAction">Action <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <div class="actionItems">
                                        <ul>
                                            <li><a href="#" class="view_n_print" data-id="<?=$fl["Form_id"];?>">Print Form</a></li>
                                            <li><a href="#" class="view_n_Edit" data-id="<?=$fl["Form_id"];?>">View and Edit Details</a></li>
                                        </ul>
                                        <!-- actionIteamsUL-->
                                    </div>
                                    <!-- actionItems -->
                                </td>
                            </tr>
                            <?php }
                                }   ?>
                        </tbody>
                    </table>
                    <!-- StaffListing -->
                </div>
                <!-- inner -->
            </div>
            <!-- MaroonBorderBox -->
        </div>
        <!-- col-md-8 -->
    </div>
    <!-- row -->
    <!-- Two column layout END -->
</div>
<!-- container -->
<style>
    .state-error .invalid {
    border-color: red;
    color: red;
    border:1px solid red;
    }
    .state-error .invalid::-webkit-input-placeholder {
    color:red;
    }
    .state-error label {
    color:red;
    }
</style>