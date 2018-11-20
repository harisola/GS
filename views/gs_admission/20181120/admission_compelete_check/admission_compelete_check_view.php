<style> tr.redAlert { background:#fbdfdf !important; }
   legend {
   display: block;
   padding: 0;
   margin-bottom: 0px;
   font-size: 18px;
   line-height: inherit;
   color: #333;
   border-bottom: 0 none !important;
   padding: 0px 10px 0 10px;
   width: auto;
   }
   fieldset {
   border: 1px solid #ccc !important;
   padding: 10px !important;
   margin-bottom: 20px;
   }
   .liActions .tick {
    padding-left: 0px !important;
}

.alert-danger-alevel{
  background-color: #f2dede;
  border-color: #ebcccc;
  color: #a94442;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<div class="container" id="FollowUpScreen">
   <div class="row">
     <div class="col-md-12 no-padding" style="width: 335px; text-align: center; position: absolute; top: 40%; left: 40%; background: rgb(241, 239, 239); border: 1px solid rgb(204, 204, 204); padding: 10px; z-index: 99999; display: none;" id="Generations_AjaxLoader">
               <img src="http://10.10.10.50/gs//components/image/gsLoader.gif" width="200"><br><hr style="margin: 7px 0;border-top: 1px solid #ccc;"> Loading. Please Wait...
      </div>
      <div class="col-md-12">
         <h2 class="withBorderBottom">Final Admissions Complete checklist</h2>
      </div>
      <div class="col-md-12" id="applicantList">
         <div class="MaroonBorderBox">
            <h3>Candidate checklist</h3>
            <div class="inner20 paddingLeft20 paddingRight20" id="paddingRight20">
               <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#pejmoTab">PEJMO</a></li>
                  <li><a data-toggle="tab" href="#aLevelTab">A-Levels</a></li>
                  <li><a data-toggle="tab" href="#AllApplicants">All Applicants</a></li>
               </ul>
               <!-- nav-tabs -->
               <div class="tab-content">
                  <!-- pejmo nav-tabs -->
                  <div id="pejmoTab" class="tab-pane fade in active" style="padding:20px; ">
                    <div class="col-md-2">
                       <select name="skills" id="grade_multi" multiple="" class="ui fluid dropdown">
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
                     <table id="pejmoTabTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>

                           <tr>
                              <th width="" class="text-center">Form #</th>
                              <th width="">Applicant Name<br /><small>Payment Due Date</small></th>
                              <th width="" class="text-center">Grade Name </th>
                               <th width="" class="text-center" style="display:none">Grade Name </th>
                              <th width="">Father Name<br /><small>Father/Mother Mobile</small></th>
                              <th width="" class="text-center">Pre-admission<br />Checklist</th>
                           </tr>
                        </thead>
                        <tbody>
                        <?php foreach($pegmo_list as $pegmo_list) { ?>
                          <?php if($pegmo_list->grade_id <= 14 || $pegmo_list->grade_id == 17 ) { ?>
                           <tr class="verified">
                              <td class="text-center"><?php echo $pegmo_list->form_no?></td>
                              <td>
                                 <a href="javascript:void(0)" class="followup_row" data-id="<?php echo $pegmo_list->form_id ?>"> 
                                 <?php echo $pegmo_list->applicant_name ?>
                                 </a>
                                 <br />
                                 <small><?php echo $pegmo_list->payment_due_date ?></small>
                              </td>
                              <td class="text-center"><?php echo $pegmo_list->grade_name ?><br />
                                <ul class="liActions">
                                  <?php if($pegmo_list->gs_id != null) {  ?>
                                  <li id="address_4" class="tick" style="width: 110px;margin: 0 auto;"><?php echo $pegmo_list->gs_id; ?></li>
                                  <?php } ?>
                                </ul>
                              </td>
                              <td style="display:none"><?= $pegmo_list->grade_id ?></td>
                              <td><?php echo $pegmo_list->father_name ?><br /><small><?php echo $pegmo_list->fathe_mother_detail ?></small></td>
                              <td class="text-center"><a id="checkList" href="javascript:void"  data-toggle="modal" data-target="#myModal" onClick="checkList(<?=$pegmo_list->form_id ?>,<?=$pegmo_list->grade_id ?>)" >View & Edit</a></td>
                           </tr>
                           <?php } ?>
                        <?php } ?>
                        </tbody>
                     </table>
                     <!-- StaffListing -->
                  </div>
                  <!-- aLevelTap nav-tabs -->
                  
                  <div id="aLevelTab" class="tab-pane fade " style="padding:20px; ">
                       <table id="AlevelAdmissionFormListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                          <thead>
                             <tr>
                                <th width="" class="text-center">Form #</th>
                                <th width="">Applicant Name<br /><small>Payment Due Date</small></th>
                                <th width="">Grade Name </th>
                                <th width="">Father Name<br /><small>Father/Mother Mobile</small></th>
                                <th width="">Pre-admission<br />Checklist</th>
                             </tr>
                          </thead>
         
                          <tbody>
                        <?php foreach($aLevel_list as $aLevel_list) { ?>
                          
                           <tr class="verified">
                              <td class="text-center"><?php echo $aLevel_list->form_no?></td>
                              <td>
                                 <a href="javascript:void(0)" class="followup_row" data-id="<?php echo $aLevel_list->form_id ?>"> 
                                 <?php echo $aLevel_list->applicant_name ?>
                                 </a>
                                 <br />
                                 <small><?php echo $aLevel_list->payment_due_date ?></small>
                              </td>
                              <td class="text-center"><?php echo $aLevel_list->grade_name ?><br />
                                <ul class="liActions">
                                  <?php if($aLevel_list->gs_id != null) {  ?>
                                  <li id="address_4" class="tick" style="width: 110px;margin: 0 auto;"><?php echo $aLevel_list->gs_id; ?></li>
                                  <?php } ?>
                                </ul>
                              </td>
                              
                              <td><?php echo $aLevel_list->father_name ?><br /><small><?php echo $aLevel_list->fathe_mother_detail ?></small></td>
                              <td class="text-center"><a id="checkList" href="javascript:void"  data-toggle="modal" data-target="#myModal" onClick="checkListAlevel(<?=$aLevel_list->form_id ?>,<?=$aLevel_list->grade_id ?>)" >View & Edit</a></td>
                           </tr>
                           
                        <?php } ?>
                        </tbody>
                         
                       </table>
                       <!-- StaffListing -->
                  </div>
                  <!-- AllApplicants Tap nav-tabs -->
                  <div id="AllApplicants" class="tab-pane fade " style="padding:20px; ">
                       <table id="AllApplicantsAdmissionFormListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                          <thead>
                             <tr>
                                <th width="" class="text-center">Form #</th>
                                <th width="">Applicant Name<br /><small>Payment Due Date</small></th>
                                <th width="">Grade Name </th>
                                <th width="">Father Name<br /><small>Father/Mother Mobile</small></th>
                                <th width="">Pre-admission<br />Checklist</th>
                             </tr>
                          </thead>
                          <tbody>
                             <tr class="verified">
                                <td class="text-center">1</td>
                                <td>
                                   <a href="#" class="followup_row" data-id=""> 
                                   Haris Ola
                                   </a>
                                   <br />
                                   <small>Tue, 16 Jan 2018</small>
                                </td>
                                <td>PN</td>
                                <td>Muhammad Feroze<br /><small>0300-2155406 / 0332-3123104</small></td>
                                <td class="text-center"><a id="" href="#"  data-toggle="modal" data-target="#myModal">View & Edit</a></td>
                             </tr>
                          </tbody>
                       </table>
                       <!-- StaffListing -->
                  </div>
                 
               </div>
               <!-- tab-content -->
            </div>
            <!-- inner -->
         </div>
         <!-- MaroonBorderBox -->
      </div>
      <!-- col-md-7 -->
      <div class="modal fade" id="myModal" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close floatClose" data-dismiss="modal">×</button>
                  <h4 class="modal-title">Pre-admission Checklist</h4>
               </div>
               <form id="checkListValidation">
               <div class="modal-body">
                  <input type="hidden" name="form_no" id="form_no"/>
                  <input type="hidden" name="grade_id" id="grade_id"/> 
                    <fieldset>
                       <legend>Form Submission:</legend>
                       <input type="checkbox" id="photo_submit" value= "photoSubmited" name="" class="photo_submit"> <label class="photo_submit" for="photo_submit">Photos Submitted </label><br />
                       <input type="checkbox" id="birth_certificate_orignal" name="" value= "BirthCertificateOrignalSubmited" class="birth_certificate_orignal"> <label class="birth_certificate_orignal" for="birth_certificate_orignal">Birth Certificate (O) </label><br />
                       <input type="checkbox" id="birth_certificate_copy" name="" value= "BirthCertificateCopySubmited" class="birth_certificate_copy"> <label class="birth_certificate_copy" for="birth_certificate_copy">Birth Certificate (C) </label><br />
                       <span class="ALevelCheckDIV">
                      <input type="checkbox" id="a_level_supplement" name="" value="" required="required" class="ALevelCheck" checked="" disabled=""> <label class="" for="">Duly filled Admission Application Form and A-Level Supplement </label>
                    </span><br />
                    </fieldset>
                    <div class="row" style="padding: 0 15px;">
                       <fieldset class="col-md-6" style="float: left; width: 49%;">
                          <legend>FAO Preparation:</legend>
                          <span class="previousSchoolGradeHide"><input type="checkbox" id="previous_school" name="" class="previous_school" value="previousSchoolSubmited"> <label class="previous_school" for="previous_school">Previous School </label><br />
                          <input type="checkbox" id="previous_grade" name="" class="previous_grade" value="previousGradeSubmited"> <label class="previous_grade" for="previous_grade">Previous Grade </label><br /></span>
                          <input type="checkbox" id="is_address" name="" class="is_address" value="isAddressSubmited"> <label class="is_address" for="is_address">Address </label><br />
                          <input type="checkbox" id="is_payment_window" name=""  class="is_payment_window" value="paymentWindowSubmited"> <label class="is_payment_window" for="is_payment_window">Payment Window </label><br />
                          <input type="checkbox" id="is_concession_code" name=""  class="is_concession_code" value="concessionCodeSubmited"> <label class="is_concession_code" for="is_concession_code">Concession Code </label><br />
                          <input type="checkbox" id="is_activation_date" name=""  class="is_activation_date" value="activationDateSubmited"> <label class="is_activation_date" for="is_activation_date">Activation / Joining Date </label><br />
                          <input type="checkbox" id="father_mother_detail" name=""  class="father_mother_detail" value="fatherMotherdetailSubmit"> <label class="father_mother_detail" for="father_mother_detail">Father & Mother details </label><br />
                          <input type="checkbox" id="print_offer_letter" name=""  value="offerLetterSubmited" class="print_offer_letter"> <label class="print_offer_letter" for="print_offer_letter">Print Offer Letter </label><br />
                          <input type="checkbox" id="print_fif" name=""  class="print_fif" value="fifFormSubmited"> <label class="print_fif" for="print_fif">Print FIF </label><br />
                          <input type="checkbox" id="print_photo_taken" name=""  class="print_photo_taken" value="photoTakenSubmited"> <label class="print_photo_taken" for="print_photo_taken">Print Photo Token </label><br />
                          <input type="checkbox" id="print_fee_bill" name=""  class="print_fee_bill" value="feeBillSubmited"> <label class="print_fee_bill" for="print_fee_bill">Print Fee Bill </label><br />
                          <input type="checkbox" id="is_handbook_ready" name=""  class="is_handbook_ready" value="handbookSubmited"> <label class="is_handbook_ready" for="handbook_ready">Handbook Ready </label><br />
                       </fieldset>
                       <fieldset class="col-md-6" style="float: right;width: 49%;">
                          <legend>FAO Procedure:</legend>
                          <input type="checkbox" id="signed_offer_letter" name=""  class="signed_offer_letter" value="signedOfferLetterSubmited"> <label class="signed_offer_letter" for="signed_offer_letter">Signed Offer Letter </label><br />
                          <input type="checkbox" id="compelete_fif_form" name="checkList[]"  class="compelete_fif_form" value="compeleteFifFormSubmited"> <label class="compelete_fif_form" for="compelete_fif_form">Complete FIF Form </label><br />
                          <input type="checkbox" id="signed_handbook" name="checkList[]"  class="signed_handbook" value="signedHandbookSubmited"> <label class="signed_handbook" for="signed_handbook">Signed Handbook </label><br />
                          <input type="checkbox" id="offer_pack_handover" name=""  class="offer_pack_handover" value="offerPackHandoverSubmited"> <label class="offer_pack_handover" for="offer_pack_handover">Offer Pack handedover</label><br />
                          <input type="checkbox" disabled="disabled" id="is_fee_received" name=""  class="is_fee_received" value="feeReceivedSubmited"> <label class="is_fee_received" for="is_fee_received">Paid Fee Bill<br /><small style="margin-left: 24px;">(System generated Check)</small> </label><br />
                          <span style="width: 200px;background: none;height: 40px;position: absolute;bottom: 13px;"></span>
                       </fieldset>
                    </div>
                    <fieldset class="ALevelCheckDIV" >
                       <legend>A-Level Checks:</legend>
                        <input type="checkbox" id="APCOSR" name="formCheckList[]" value="APCOSR" required="required" class=""> <label class="" for="APCOSR">Attested Photo copy of school result for grades IX, X and XI.(incl mocks) </label><br />
                       <input type="checkbox"  id="PRFSSE" name="formCheckList[]" value="PRFSSE" required="required" class=""> <label class="" for="PRFSSE">Principal recommendation form in school sealed envelope</label><br />
                       <input type="checkbox" value="ACCIEX"  id="ACCIEX" name="formCheckList[]" required="required" class=""> <label class="" for="ACCIEX">Attested copy of CIE Olevel results and certificates.(grade X only)</label><br />
                       <input type="checkbox" value="ACCIE"  id="ACCIE" name="formCheckList[]" required="required" class=""> <label class="" for="ACCIE">Attested copy of CIE Olevel results and certificates. *</label><br />
                      <!--  <input type="checkbox" id="ACMER" name="formCheckList[]" value="ACMER" required="required" class=""> <label class="" for="ACMER">Attested copy mock exam result/first term result</label><br /> -->
                       <!-- <input type="checkbox" value="ACFFR" id="ACFFR" name="formCheckList[]" required="required" class=""> <label class="" for="ACFFR">Attested copies of full and final result </label><br /> -->
                       <input type="checkbox" value="CCFPS" id="CCFPS" name="formCheckList[]" required="required" class=""> <label class="" for="CCFPS">Transfer / Leaving certificate from previous school </label><br />
                       <input type="checkbox" value="PCCCA"  id="PCCCA" name="formCheckList[]" required="required" class=""> <label class="" for="PCCCA">Copies of certificates of cross curricular activities</label><br />
                    </fieldset>
               </div>
                  <div class="alert alert-danger" style="display:none">Please tick  the  Complete FIF Form and  Signed Handbook to proceed.</div>
                  <div class="alert  alert-danger-alevel" style="display:none">Please tick  the  Complete FIF Form , Signed Handbook to proceed and Attested copy of CIE Olevel results and certificates.  to proceed</div>
               <div class="modal-footer text-center" style="text-align: center;">
                  <input type="button" class="btn btn-success" value="Verify" onClick="updateCheckList()"/>
               </div>
               </form>
               <!-- Modal content-->     
            </div>
         </div>
         <!-- modal-dialog -->
      </div>
      <!-- modal -->
      <div class="col-md-5" style="display:none;" id="comment_box">
      </div>
      <!-- col-md-4 -->
   </div>
   <!-- row -->
   <!-- Two column layout END -->
</div>
<!-- container -->
<script type="text/javascript">
   // var checklist = function checklist(alevel_checklist, id){
   
   //     $('input[type=checkbox]').prop( "checked", false );
       
   //     $('#form_no').val(id);
   
   //     if(alevel_checklist !== ''){
        
   //       var checklist = alevel_checklist;
   //       checklist = checklist.split(',');
         
   //       for (var i = 0; i < checklist.length; i++) {
   //         $( "#"+checklist[i] ).prop( "checked", true );
   //       }
   //     }
   // }
   // var verifyCheckList = function verifyCheckList() {
   
   //   var form_no = $('#form_no').val();
   //   var formCheckList = [];
   //   $('input[name^="formCheckList"]').each(function() {
   //     if(this.checked){
   //         formCheckList.push($(this).val())
   //     }
   //   });
   
   //   $.ajax({
   //       url: "<?php echo site_url('gs_admission/admission_post_result_verification/updateCheckList') ?>",
   //       type: "POST",
   //       data: {
   //         'form_no' : form_no,
   //         'formCheckList' : formCheckList
   //       },
   //       success: function(response){
   //           $('#myModal').modal('toggle');
   //           var offerLetter = 0;
   //           if($( "#offerLetter").is(":checked")){
   //             offerLetter = 1;
   //           }            
   //             var viewEditOnclick = $("#viewEdit_"+form_no).attr("onClick");
   //             var funcname = viewEditOnclick.substring(0,viewEditOnclick.indexOf("("));
   //             formCheckList = formCheckList.join();       
   //             $("#viewEdit_"+form_no).attr("onclick",funcname+"('"+formCheckList+"',"+form_no+")");
   //       },
   //       error: function(){
             
   //       }
   //   });
   
   // }
   // var updateOfferLetterFlag = function updateOfferLetterFlag() {
   
   //   var form_no = $('#form_no').val();
   //   var offerLetter = 0;
   
   //   if($( "#offerLetter").is(":checked")){
   //       offerLetter = 1;
   //   }
   
   //   $.ajax({
   //       url: "<?php echo site_url('gs_admission/admission_post_result_verification/updateOfferLetter') ?>",
   //       type: "POST",
   //       data: {
   //         'form_no' : form_no,
   //         'offerLetter' : offerLetter
   //       },
   //       success: function(response){
   
   //       },
   //       error: function(){
             
   //       }
   //   });
   
   // }
   
</script>
<div style="display:none;" id="ajaxloader2">
   <p> <br /> <br /> <br /> <br /> Please Wait ... </p>
</div>
<style>
   tr.verified {
   border-left: 3px solid green;
   }
   .required {
   color: red;
   }
   .modal-dialog {
   width: 80% !important;
   margin: 5% auto !important;
   }
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