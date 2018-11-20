<script>
// JavaScript Document
/* JS for overlay Menu */
function openNav() {
    document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
    document.getElementById("myNav").style.width = "0%";
}

/* JS for Menu Dropdown*/
$(document).ready(function(){
    $(".hasChild").click(function(){
        $(this).children('.subMenu').toggle();
    });
});

/* JS for Menu class toggler */ 
$(document).ready(function(){
    $(".main_menu li.main").click(function(){
        $(this).children(".main_menu li a").toggleClass("selected");
    });
});

/* JS for Menu icon toggler */
$(document).ready(function(){
    $("#CloseNav").click(function(){
        $("#CloseNav").hide();
    $("#OpenNav").show();
    });
    $("#OpenNav").click(function(){
    $("#OpenNav").hide();
        $("#CloseNav").show();
    });
});




$(document).ready(function() {
  
  $('#grade_multi').multiselect();
  //  Intialize pejmoTabTable
  $('#pejmoTabTable').dataTable({
    "bLengthChange": false,
    "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
      } ],
     "aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
     "iDisplayLength": 20
  });


  //  Intialize  Alevel  Table
  $('#AlevelAdmissionFormListing').dataTable({
    "bLengthChange": false,
    "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
      } ],
      "aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
      "iDisplayLength": 20
  });


   //  Intialize  AllApplicants Table
  $('#AllApplicantsAdmissionFormListing').dataTable({
    "bLengthChange": false,
    "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
      } ],
      "aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
      "iDisplayLength": 20
  });


  $('#pejmoTabTable').dataTable();
 // $('#AlevelAdmissionFormListing').dataTable();
  $('#AllApplicantsAdmissionFormListing').dataTable();


});


  $('.followup_row').click(function(e){
    var form_id = $(this).data('id');
    var official_name = $.trim($(this).text());
    console.log('official_name'+official_name);
    $("#applicantList").switchClass('col-md-12','col-md-7',1000,"easeInOutQuad");
    $('#comment_box').show();
    $('#Generations_AjaxLoader').css('display','');
    commentBox(form_id,official_name);
    $('#Generations_AjaxLoader').css('display','none');
    
  });

  $('#comment_box').click(function(e){
    $("#applicantList").switchClass('col-md-7','col-md-12',1000,"easeInOutQuad");
    $('#comment_box').hide();
  });

  function commentBox(form_id,official_name){
    $.ajax({
      type:"POST",
      cache:false,
      data:{form_id:form_id},
      url:"<?php echo base_url(); ?>index.php/gs_admission/admission_compelete_check/getComments",
      success:function(e){
        var data = JSON.parse(e);
        console.log(data);
        var html = '';
        html += '<div class="MaroonBorderBox">';
        html += '<h3>Compelete Check List of '+official_name+'<button id="hidr" style="pull-right">Hide</button> </h3>';
        html += '<div class="inner" style="padding-bottom:0;">';
        html += '<div class="TimelineReview">';
        html += '<ul>';
        var in_out = "in";
        if(data){
          for(var i = 0 ; i < data.length ; i++){
            if( data[i].type == 'Issuance' || data[i].type == 'Stage' || data[i].type == 'Status' ) {
              html += '<li class="adminResponse">';
              html += '<p>'+data[i].message+'</p>';
              html += '</li>';
            }else{
              if( in_out == 'in' ){ 
                in_out = "out"; 
              }else{ 
                in_out = "in"; 
              }  
              html += '<li class="'+in_out+'">';
              html += '<div class="avatarLeft col-md-2">';
               
              html += '<img src="<?php echo base_url();?>assets/photos/hcm/150x150/staff/'+data[i].photo_id+'.png" />';
              html += '</div><!-- avatarLeft -->';
               
              html += '<div class="systemResponse col-md-10">';
              html += '<span class="arrowHeadLeft">&nbsp;</span>';
              html += '<p>';
                  

              if( data[i].reason != '' ){                 
               html += '<strong>'+ data[i].reason +'</strong>';
              }
                  
              html += '<br /><small>'+data[i].message+'</small>';
              html += '</p>';
              html += '<span class="commentDate">'+data[i].change_date+'</span><!-- commentDate -->';
              html += '</div><!-- systemResponse -->';
              html += '</li><!-- in -->';
            }
          } // end for
        } // if Data
        html += '</ul>';
        html += '</div>';
        html += '</div>';
        $('#comment_box').html(html);
      }
    });
  }

  // Check List Model

  function checkList(form_id,grade_id){

      $('input[name="form_no"]').val(form_id);
      $('input[name="grade_id"]').val(grade_id);
      if(grade_id <= 13  || grade_id == 17){
        $('.ALevelCheckDIV').hide();
      }else{
        $('.ALevelCheckDIV').show();
      }

      if(grade_id == 1 || grade_id == 2 || grade_id == 17){
        $('.previousSchoolGradeHide').hide();
      }else{
        $('.previousSchoolGradeHide').show();
      }

      $.ajax({
        type:"POST",
        cache:false,
        data:{form_id:form_id},
        url:"<?php echo base_url() ?>index.php/gs_admission/admission_compelete_check/getApplicantData",
        success:function(e){
          var obj = JSON.parse(e);
          mappingCheck(obj);
        }
      });
  }

  function mappingCheck(obj){
        var photoSubmit;
        var birthCertificateOrignal;
        var birthCertificateCopy;
        var applicantAddress;
        var previousSchool;
        var previousGrade;
        var isAddress;
        var dayOfpayment;
        var isConcessionCode;
        var isActivationDate;
        var isFamilyDetail;
        var printOfferLetter;
        var printFif;
        var printPhotoTaken;
        var printFeeBill;
        var printHandbook;
        var signedOfferLetter;
        var completeFifForm;
        var signedHandbook;
        var offerPackHandover;
        var feeReceived;
        var aLevelCheck;
        var alevelSupplement;
        console.log(obj);
        for(var i = 0 ; i < obj.length ; obj++){
          photoSubmit = obj[i].is_photo_submitted;
          birthCertificateOrignal = obj[i].is_birthcrt_o;
          birthCertificateCopy = obj[i].is_birthcrt_c;
          applicantAddress = obj[i].is_address;
          previousSchool = obj[i].previous_school_id;
          previousGrade = obj[i].previous_grade;
          isAddress = obj[i].is_address;
          dayOfpayment = obj[i].is_date_of_payment;
          isConcessionCode = obj[i].is_concession_code;
          isActivationDate = obj[i].is_activiation_date;
          isFamilyDetail = obj[i].is_family_detail;
          printOfferLetter = obj[i].is_printed_offer_letter;
          printFif = obj[i].is_printed_fif;
          printPhotoTaken = obj[i].is_printed_photo_token;
          printFeeBill = obj[i].is_printed_fee_bill;
          printHandbook = obj[i].is_handbook;
          signedOfferLetter = obj[i].is_signed_offer_letter;
          completeFifForm = obj[i].is_complete_fif_form;
          signedHandbook = obj[i].is_signed_hand_book;
          offerPackHandover = obj[i].offer_pack_handover;
          feeReceived = obj[i].fee_received;
          aLevelCheck = obj[i].alevel_checklist;
          alevelSupplement = obj[i].is_alevel_supplement;
        }


        // A Level Checks
        $('input[type=checkbox]').prop( "checked", false );
        $('input[type=checkbox]').attr('disabled', false);
        if(aLevelCheck !== '' && aLevelCheck !== null && aLevelCheck !== undefined){
          var checklist = aLevelCheck;
          checklist = checklist.split(',');
          
          for (var i = 0; i < checklist.length; i++) {
            $( "#"+checklist[i] ).prop( "checked", true );
            $('#'+checklist[i]).attr('disabled', true);
          }
        }

        if(alevelSupplement == 1){
          checkDisableEnable("a_level_supplement",1);
        }else{
          checkDisableEnable("a_level_supplement",0);
        }

          // PhotoSubmit 
        if(photoSubmit == 1){
          checkDisableEnable("photo_submit",1); 
        }else{
          checkDisableEnable("photo_submit",0);
        }

          //Birth Certificate Orignal

        if(birthCertificateOrignal == 1){
          checkDisableEnable("birth_certificate_orignal",1);
        }else{
          checkDisableEnable("birth_certificate_orignal",0);
        }

         //Birth Certificate Copy

        if(birthCertificateCopy == 1){
          checkDisableEnable("birth_certificate_copy",1);
        }else{
          checkDisableEnable("birth_certificate_copy",0);
        }

        // Applicant Address

        if(applicantAddress == 1){
          checkDisableEnable("birth_certificate_copy",1);
        }else{
          checkDisableEnable("birth_certificate_copy",0);
        }

        // Previous School 
        if(previousSchool != 0){
          checkDisableEnable("previous_school",1);
        }else{
          checkDisableEnable("previous_school",0);
        }

        // Previous Grade
        if(previousGrade != 0){
          checkDisableEnable("previous_grade",1);
        }else{
          checkDisableEnable("previous_grade",0);
        }

        // Is Address
        if(isAddress == 1){
           checkDisableEnable("is_address",1);
        }else{
           checkDisableEnable("is_address",0);
        }

        // IS Day Of Payment
        if(dayOfpayment == 1){
          
          checkDisableEnable("is_payment_window",1);
        }else{
          checkDisableEnable("is_payment_window",0);
        }

        //is Concession Code
        if(isConcessionCode == 1){
          checkDisableEnable("is_concession_code",1);
        }else{
          checkDisableEnable("is_concession_code",0);
        }

        // Is Activation Date
        if(isActivationDate == 1){
          checkDisableEnable("is_activation_date",1);
        }else{
          checkDisableEnable("is_activation_date",0);
        }

        // Is Family Detail
        if(isFamilyDetail == 1){
          checkDisableEnable("father_mother_detail",1);
        }else{
          checkDisableEnable("father_mother_detail",0);
        }

        // Is Printed Offer Letter

        if(printOfferLetter == 1){
          checkDisableEnable("print_offer_letter",1);
        }else{
          checkDisableEnable("print_offer_letter",0);
        }

        // Print FIF

        if(printFif == 1){
          checkDisableEnable("print_fif",1);
        }else{
          checkDisableEnable("print_fif",0);
        }

        // Print Photo Taken

        if(printPhotoTaken == 1){
          checkDisableEnable("print_photo_taken",1);
        }else{
          checkDisableEnable("print_photo_taken",1);
        }

        // Print Fee Bill

        if(printFeeBill == 1){
          checkDisableEnable("print_fee_bill",1);
        }else{
          checkDisableEnable("print_fee_bill",0);
        }

        // Print Hand book

        if(printHandbook == 1){
          checkDisableEnable("is_handbook_ready",1);
        }else{
          checkDisableEnable("is_handbook_ready",0);
        }

        // SignedOfferLetter

        if(signedOfferLetter == 1){
          checkDisableEnable("signed_offer_letter",1);
        }else{
          checkDisableEnable("signed_offer_letter",0);
        }

        //Compelte Fif Form

        if(completeFifForm == 1){
          checkDisableEnable("compelete_fif_form",1);
        }else{
          checkDisableEnable("compelete_fif_form",0);
        }

        
        // Signed Hand Book
        if(signedHandbook == 1){
          checkDisableEnable("signed_handbook",1);
        }else{
          checkDisableEnable("signed_handbook",0);
        }

        // IsOfferPackHandover
        if(offerPackHandover == 1){
          checkDisableEnable("offer_pack_handover",1);
        }else{
          checkDisableEnable("offer_pack_handover",0);
        }

        // Fee Received
        if(feeReceived == 1){
          checkDisableEnable("is_fee_received",1);
        }else{
          checkDisableEnable("is_fee_received",0);
        }
  }


  // CheckList A-Level

  function checkListAlevel(form_id,grade_id){
      $('input[name="form_no"]').val(form_id);
      $('input[name="grade_id"]').val(grade_id);
      if(grade_id <= 13 && grade_id != 17){
        $('.ALevelCheckDIV').hide();
      }else{
        $('.ALevelCheckDIV').show();
      }

      if(grade_id == 1 || grade_id == 2 || grade_id == 17){
        $('.previousSchoolGradeHide').hide();
      }else{
        $('.previousSchoolGradeHide').show();
      }

      $.ajax({
        type:"POST",
        cache:false,
        data:{form_id:form_id},
        url:"<?php echo base_url() ?>index.php/gs_admission/admission_compelete_check/getApplicantDataAlevel",
        success:function(e){
          var obj = JSON.parse(e);
          mappingCheck(obj);
        }
      });
  }


  function checkDisableEnable(id,is_checked){
      if(is_checked){
        $("#"+id).prop('checked', true); 
        $("#"+id).prop('disabled', true);
      }else{
        $("#"+id).prop('checked', false); 
        $("#"+id).prop('disabled', false);
      }
  }



  // Update CheckList

  var updateCheckList = function(e){
    var form_no = $('#form_no').val();
    var grade_id = $('#grade_id').val();

    var formCheckList = [];
    $('input[name^="checkList"]').each(function() {
      if(this.checked){
          formCheckList.push($(this).val())
      }
    });

      if(grade_id <= 14 || grade_id == 17){


          if(formCheckList.length == 2){
            $.ajax({
            type:"POST",
            cache:false,
            data:{
              form_id:form_no,
              formCheckList:formCheckList
            },
            url:"<?php echo base_url() ?>index.php/gs_admission/admission_compelete_check/updateCheckList",
            success:function(e){
              $('#myModal').modal('hide');
              location.reload();
            }
          });
         }else{
          $(".alert-danger").show();
          $( ".alert-danger" ).fadeOut(3000);
         }

     }else{


        var AlevelChecks = [];
        $('input[name^="formCheckList"]').each(function() {
          if(this.checked){
              AlevelChecks.push($(this).val())
          }
        });


        if(formCheckList.length == 2 && AlevelChecks.indexOf('ACCIE') != -1){
            $.ajax({
            type:"POST",
            cache:false,
            data:{
              form_id:form_no,
              AlevelChecks:AlevelChecks
            },
            url:"<?php echo base_url() ?>index.php/gs_admission/admission_compelete_check/updateCheckListAlevel",
            success:function(e){
              $('#myModal').modal('hide');
              location.reload();
            }
          });
         }else{

          $(".alert-danger-alevel").show();
          $(".alert-danger-alevel").fadeOut(7000);
         
         }

     }

  }


  $('#grade_multi').on('change',function(e){

       var selected = $(this).val();
      // Declare variables 
      var input, filter, table, tr, td, i;
      table = document.getElementById("pejmoTabTable");
      tr = table.getElementsByTagName("tr");
    
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
        if (td && selected.length != 0) {
          if (jQuery.inArray(td.innerHTML, selected) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }else{
          tr[i].style.display = "";
        } 
      }

  });


</script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script>

<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

</body>
</html>
