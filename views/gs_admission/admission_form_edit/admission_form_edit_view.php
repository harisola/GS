<div class="container" id="IssueAdmissionForm">
   <!-- Two column layout Start -->
   <script>
      $(document).ready(function() {
          $(".tabs-menu a").click(function(event) {
              event.preventDefault();
              $(this).parent().addClass("current");
              $(this).parent().siblings().removeClass("current");
              var tab = $(this).attr("href");
              $(".tab-content").not(tab).css("display", "none");
              $(tab).fadeIn();
          });
      });
   </script>
   <style>
   .TimelineAddForm {
      display: none;
}
      .tabs-menu {
      width: 100%;
      float: left;
      clear: both;
      list-style: none;
      margin-bottom: 0;
      margin-top: 30px;
      }
      .tabs-menu li {
      width: 50%;
      line-height: 30px;
      float: left;
      /*border-top: 1px solid #d4d4d1;
      border-right: 1px solid #d4d4d1;
      border-left: 1px solid #d4d4d1; */
      }
      .tabs-menu li.current {
      position: relative;
      /* background-color: #a35554; */
      border-bottom: 1px solid #fff;
      z-index: 5;
      border-bottom: 4px solid #a35554;
      }
      .tabs-menu li a {
      padding: 10px;
      color: #888;
      text-decoration: none;
      width: 100%;
      text-align: center;
      float: left;
      font-size:18px;
      }
      .tabs-menu .current a {
      color: #000;
      }
      .tab {
      float: left;
      margin-bottom: 20px;
      width: auto;
      border-top: 2px solid #d4d4d1;
      }
      .tab-content {
      padding-top: 20px;
      display: none;
      float: left;
      width: 100%;
      }
      #tab-1 {
      display: block;   
      }
   </style>
   <style>
      .TimeLineModal .modal-body {
      padding:10px;
      }
      .TimeLineModal .modal-footer {
      text-align:center;
      padding:20px 0;
      }
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
      .state-error .invalid + select  {
      background: #f0c6bd none repeat scroll 0 0;
      box-shadow: 0 0 0 12px #f0c6bd;
      }
      .state-error .invalid + input {
      background: #f0c6bd none repeat scroll 0 0;
      }
      .state-error + em {
      color: #ee9393;
      display: block;
      font-size: 0.9em;
      font-style: normal;
      font-weight: 400;
      line-height: 15px;
      margin-top: 6px;
      padding: 0 1px;
      }
      .issuance .rating.state-error + em {
      margin-bottom: 4px;
      margin-top: -4px;
      }
      .callout-info::before {
      font-size: 1.5em;
      height: 29px;
      left: 10px;
      top: 3px;
      width: 29px;
      }
      .callout-danger::before {
      font-size: 1.5em;
      height: 29px;
      left: 10px;
      top: 3px;
      width: 29px;
      }
      .btn {
      border: 1px solid #b54f4f;
      color: #b54f4f;
      padding: 5px 10px;
      border-radius:0 !important;
      }
      input[type="text"],
      input[type="email"],
      input[type="date"],
      select {
      padding:5px;
      width:100%;
      }
      .paddingTop20 {
      padding-top: 20px !important;
      }
      .countryCodeNumber {
      position: absolute;
      top: 25px;
      z-index: 9999;
      width: 139px;
      text-align: center;
      border-bottom: 0;
      left: 0px;
      padding-bottom: 6px;
      }
      .countryCodeNumberStudent,
     .countryCodeNumberStuent {
      position: absolute;
      top: 0px;
      z-index: 9999;
      width: 139px;
      text-align: center;
      border-bottom: 0;
      left: 0px;
      padding-bottom: 6px;
      }
      .countryCodeNumberFather {
      position: absolute;
      top: 25px;
      z-index: 9999;
      width: 139px;
      text-align: center;
      border-bottom: 0;
      left: 0px;
      padding-bottom: 6px;
      }
      .countryCodeNumberMother {
      position: absolute;
      top: 25px;
      z-index: 9999;
      width: 139px;
      text-align: center;
      border-bottom: 0;
      left: 0px;
      padding-bottom: 6px;
      }
      .add_field_button_student,
      .add_field_button_father,
      .add_field_button_mother {
      position: absolute;
      right: 0;
      top: 25px;
      background: green;
      border: 0;
      font-size: 20px;
      color: #fff;
      padding: 3px 10px;
      }
     .add_field_button_student {
      position: absolute;
      right: 0;
      top: 0px;
      background: green;
      border: 0;
      font-size: 20px;
      color: #fff;
      padding: 3px 10px;
      }
      .input_fields_wrap_student,
      .input_fields_wrap_father,
      .input_fields_wrap_mother {
      position: relative;
      }
      .input_fields_wrap_additional_student,
      .input_fields_wrap_additional_father,
      .input_fields_wrap_additional_mother {
      position: relative;
      margin-top: 13px;
      float: left;
      width: 100%;
      }
      .input_fields_wrap_additional_student .countryCodeNumberStudent,
      .input_fields_wrap_additional_father .countryCodeNumberStudent,
      .input_fields_wrap_additional_mother .countryCodeNumberStudent {
      top: 0px;
      }
      .input_fields_wrap_additional_student .countryCodeNumberFather,
      .input_fields_wrap_additional_father .countryCodeNumberFather,
      .input_fields_wrap_additional_mother .countryCodeNumberFather {
      top: 0px;
      }
      .input_fields_wrap_additional_student .countryCodeNumberMother,
      .input_fields_wrap_additional_father .countryCodeNumberMother,
      .input_fields_wrap_additional_mother .countryCodeNumberMother {
      top: 0px;
      }
      .remove_field,
      .remove_field1,
      .remove_field2 {
      position: absolute;
      right: 0;
      top: 0px;
      background: red;
      border: 0;
      font-size: 18px;
      color: #fff;
      padding: 4px 10px;  
      }
      .btn-success {
      color: #fff !important;
      border: 1px solid #156715 !important;
      padding: 6px 30px !important;
      }
      .btn-default {
      border: 1px solid #888 !important;
      color: #888 !important;
      }
   </style>
   <div class="row">

      <div class="col-md-12 no-padding" style="width: 335px; text-align: center; position: absolute; top: 40%; left: 40%; background: rgb(241, 239, 239); border: 1px solid rgb(204, 204, 204); padding: 10px; z-index:99999;display:none" id="Generations_AjaxLoader">
   <img src="http://10.10.10.50/gs/components/image/gsLoader.gif" width="200"><br><hr style="margin: 7px 0;border-top: 1px solid #ccc;"> Please Wait...
   </div>


      <div class="col-md-12">
         <h2 class="withBorderBottom"> List Of All Admission Form </h2>
      </div>
      <!-- col-md-12 -->
      <div class="col-md-12" id="followup_lists">
         <div id="MaroonBorderBox2">
            <div class="MaroonBorderBox">
               <h3>Admission Forms Issued <span class="pull-right" style="margin-top: -5px;" id="">
                  <span class="bigNum" id="myTotal"><?php echo count($admission_form) ?></span> &nbsp; &nbsp; <a href="#" style="color:#fff;"></a></span>
               </h3>
               <div class="inner20 paddingLeft20 paddingRight20">
                  <table id="issuanceFormListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                     <thead>
                        <tr>
                           <th width="" class="text-center">Form #</th>
                           <th width="">Applicant Name</th>
                           <th width="">Father Name - <strong>Contact</strong></th>
                           <th width="" class="text-center no-sort">Current Standing</th>
                           <th width="" class="no-sort" style="text-align:center;">Edit</th>
                           <th width="" class="no-sort" style="text-align:center;">View Log</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach($admission_form as $admission)  { ?>
                        <tr>
                           <td class="text-center"><?php echo $admission->form_no  ?></td>
                           <td id="official_name_display"><?php echo $admission->official_name ?></td>
                           <td id="father_detail_display"><?php echo $admission->father_detail ?></td>
                           <td class="text-center"><?php echo $admission->status ?></td>
                           <td class="actionArea" style="text-align:center;">
                              <a data-toggle="modal" data-target="#myModal" class="data_admission" data-id="<?php echo $admission->id ?>" class="btn" onclick="editAdmission(<?php echo $admission->id ?>)">Edit Details </a>
                           </td>
                           <td class="text-center"><a href="javascript:void(0)" class="data-log" data-id="<?php echo $admission->id ?>" class="btn" onclick="ViewLog(<?php echo $admission->id ?>)">View Logs</td>
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
                  <!-- StaffListing -->
               </div>
               <!-- inner -->
            </div>
            <!-- MaroonBorderBox -->
         </div>
         <!-- MaroonBorderBox2 -->
      </div>
      <!-- col-md-12 -->

     <div class="col-md-5" style="display:none;" id="followupComments">
         <!-- // Ajax Response Will Be Show Here -->
      </div>
   </div>
   <!-- row -->
   <!-- Two column layout END -->
</div>
<!-- container -->
<script>
   $(document).ready(function() {

      var max_fields      = 10; //maximum input boxes allowed
      var wrapper         = $(".input_fields_wrap_student_div"); //Fields wrapper
      var wrapper1        = $(".input_fields_wrap_father_div"); //Fields wrapper
      var wrapper2         = $(".input_fields_wrap_mother_div"); //Fields wrapper
      var add_button      = $(".add_field_button_student"); //Add button ID
      var add_button1      = $(".add_field_button_father"); //Add button ID
      var add_button2      = $(".add_field_button_mother"); //Add button ID
       
      var x = 1;

      $(add_button1).click(function(e){ 
         e.preventDefault();
         if(x < max_fields){ 
            x++; 
            $(wrapper1).append('<div class="input_fields_wrap_additional_father" id="fields_wrap_additional_father"><select class="countryCodeNumberFather selectCountry" name="fatherMobile[]"><option data-countryCode="" value="0" selected>Select Country</option><option data-countryCode="US" value="1">USA (+1)</option><option data-countryCode="PAK" value="92">Pakistan  (+92)</option><option data-countryCode="GB" value="44">UK (+44)</option></select><input type="text" class="col-md-10 f-no" placeholder="Mobile" style="padding-left:150px;" /> <a href="#" class="remove_field1">X</a></div>'); 
         }
      });

        
      $(add_button2).click(function(e){ 
         e.preventDefault();
         if(x < max_fields){ 
             x++; 
             $(wrapper2).append('<div class="input_fields_wrap_additional_mother"><select class="countryCodeNumberMother selectCountryMother"><option data-countryCode="" value="0" selected>Select Country</option><option data-countryCode="US" value="1" >USA (+1)</option><option data-countryCode="PAK" value="92">Pakistan  (+92)</option><option data-countryCode="GB" value="44">UK (+44)</option></select><input type="text" class="col-md-10 m-no" placeholder="Mobile"  style="padding-left:150px;" /> <a href="#" class="remove_field2">X</a></div>'); //add input box
         }
      });


      $(document).on('click','.add_field_button_student',function(){

         $('.input_fields_wrap_student_div').append('<div class="input_fields_wrap_additional_student"><select class="countryCodeNumberStudent"><option data-countryCode="US" value="1" selected>USA (+1)</option><option data-countryCode="GB" value="44">UK (+44)</option></select><input type="text" class="col-md-10 s-no" placeholder="Mobile" id=""  style="padding-left:150px;" /> <a href="#" class="remove_field">X</a></div>');
      });


     // Remove The Number Element
      $(wrapper1).on("click",".remove_field1", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('.input_fields_wrap_additional_father').remove(); x--;
        });

      $(wrapper2).on("click",".remove_field2", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('.input_fields_wrap_additional_mother').remove(); x--;
        });
      
      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('.input_fields_wrap_additional_student').remove(); 
            x--;
        });


      $('.f-no').mask('9999999999');
        
      $('.m-no').mask('9999999999');
       
   });




   // Masking On a Selected Country For Father Selection
   $(document).on('change','.selectCountry',function(){
      var selectCountry = $(".selectCountry option:selected").val();
      if(selectCountry == '92'){
         $('.f-no').mask('9999999999');
      }else{
         $(".f-no").unmask();
      }
   });

   // Masking On a Selected Country for Mother Selection
   $(document).on('change','.selectCountryMother',function(){
      var selectCountry = $(".selectCountryMother option:selected").val();
      if(selectCountry == '92'){
         $('.m-no').mask('9999999999');
      }else{
         $(".m-no").unmask();
      }
   });
</script>
<div class="modal fade in  TimeLineModal" id="myModal" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Details</h4>
         </div>
         <!-- modal-header -->
         <div class="modal-body" id="tab_content">
            <form id="editForm">
               <div class="col-md-12">
                  <div class="col-md-6">
                     <input type="hidden" id="admission_form_id">
                     <input type="hidden" id="gf_id">
                     <label>Official Name</label>
                     <input type="text" placeholder="Official Name" id="official_name"  name="official_name"/> 
                  </div>
                  <!-- col-md-6  -->
                  <div class="col-md-6">
                     <label>Call Name</label>
                     <input type="text" placeholder="Call Name" id="call_name" name="call_name" /> 
                  </div>
                  <!-- col-md-6  -->
               </div>
               <!-- col-md-12 -->
               <div class="col-md-12 paddingTop20">
                  <div class="col-md-6">
                     <label>DoB</label>
                     <input type="date" placeholder="DoB" id="dateOfBirth" /> 
                  </div>
                  <!-- col-md-6  -->
                  <div class="col-md-6">
                     <label>Admission Grade</label>
                     <select name="grade" id="grade">
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
                  <!-- col-md-6  -->
               </div>
               <!-- col-md-12 -->
               <div class="col-md-12 paddingTop20">
                  <div class="col-md-6">
                     <label>Gender</label>
                     <select id="gender">
                        <option value="B">Boy</option>
                        <option value="G">Girl</option>
                     </select>
                  </div>
                  <!-- col-md-6  -->
                  <div class="col-md-6">
                     <label>NIC/Passport</label>
                     <input type="text" placeholder="NIC/Passport" id="student_nic" /> 
                  </div>
                  <!-- col-md-6  -->
               </div>
               <!-- col-md-12 -->
               <div class="col-md-12 paddingTop20">
                  <div class="col-md-6">
                     <label>Email</label>
                     <input type="email" placeholder="Email" id="student_email" /> 
                  </div>
                  <!-- col-md-6  -->
                  <div class="col-md-6 input_fields_wrap_student_div">
                     <label>Mobile</label>                    
                  </div>
               </div>

               <!--  Request For Grade -->

               <div class="col-md-12 paddingBottom0">
                  <div class="col-md-6">
                  <input type="checkbox" id="request_grade" name="request_grade" value="" style="visibility:hidden;display:block;" />
                  <label for="request_grade"> Request For Grade <span class="required"> </span></label>
                  </div><!-- col-md-6 -->
                  <div class="col-md-6" id="requestedGrade_div" style="display:none">
                     <select style="margin-top:10px" id="requestGrade" name="requestGrade">
                         <option value="0">Grade</option>
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
                 </div><!-- col-md-6 -->
               </div><!-- col-md-12 -->


               <!-- col-md-6  -->
               <HR />
         <div class="col-md-12 paddingTop20">
         <div class="col-md-6">
         <label>Father Name</label>
         <input type="text" placeholder="Father Name" id="father_name"/> 
         </div><!-- col-md-6  -->
         <div class="col-md-6">
         <label>Mother Name</label>
         <input type="text" placeholder="Mother Name" id="mother_name" /> 
         </div><!-- col-md-6  -->
         </div><!-- col-md-12 -->
         <div class="col-md-12 paddingTop20">
         <div class="col-md-6 input_fields_wrap_father_div">
         <div class="input_fields_wrap_father">
         <label>Father Mobile</label>
         <select class="countryCodeNumberFather" name="fatherMobile[]" id="fields_wrap_additional_father">
         <option disabled="disabled">Other Countries</option>
         <option data-countryCode="US" value="1" selected>USA (+1)</option>
         <option data-countryCode="GB" value="44">UK (+44)</option>
         <option data-countryCode="DZ" value="213">Algeria (+213)</option>
         <option data-countryCode="AD" value="376">Andorra (+376)</option>
         <option data-countryCode="AO" value="244">Angola (+244)</option>
         <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
         <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
         <option data-countryCode="AR" value="54">Argentina (+54)</option>
         <option data-countryCode="AM" value="374">Armenia (+374)</option>
         <option data-countryCode="AW" value="297">Aruba (+297)</option>
         <option data-countryCode="AU" value="61">Australia (+61)</option>
         <option data-countryCode="AT" value="43">Austria (+43)</option>
         <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
         <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
         <option data-countryCode="BH" value="973">Bahrain (+973)</option>
         <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
         <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
         <option data-countryCode="BY" value="375">Belarus (+375)</option>
         <option data-countryCode="BE" value="32">Belgium (+32)</option>
         <option data-countryCode="BZ" value="501">Belize (+501)</option>
         <option data-countryCode="BJ" value="229">Benin (+229)</option>
         <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
         <option data-countryCode="BT" value="975">Bhutan (+975)</option>
         <option data-countryCode="BO" value="591">Bolivia (+591)</option>
         <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
         <option data-countryCode="BW" value="267">Botswana (+267)</option>
         <option data-countryCode="BR" value="55">Brazil (+55)</option>
         <option data-countryCode="BN" value="673">Brunei (+673)</option>
         <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
         <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
         <option data-countryCode="BI" value="257">Burundi (+257)</option>
         <option data-countryCode="KH" value="855">Cambodia (+855)</option>
         <option data-countryCode="CM" value="237">Cameroon (+237)</option>
         <option data-countryCode="CA" value="1">Canada (+1)</option>
         <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
         <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
         <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
         <option data-countryCode="CL" value="56">Chile (+56)</option>
         <option data-countryCode="CN" value="86">China (+86)</option>
         <option data-countryCode="CO" value="57">Colombia (+57)</option>
         <option data-countryCode="KM" value="269">Comoros (+269)</option>
         <option data-countryCode="CG" value="242">Congo (+242)</option>
         <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
         <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
         <option data-countryCode="HR" value="385">Croatia (+385)</option>
         <option data-countryCode="CU" value="53">Cuba (+53)</option>
         <option data-countryCode="CY" value="90">Cyprus - North (+90)</option>
         <option data-countryCode="CY" value="357">Cyprus - South (+357)</option>
         <option data-countryCode="CZ" value="420">Czech Republic (+420)</option>
         <option data-countryCode="DK" value="45">Denmark (+45)</option>
         <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
         <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
         <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
         <option data-countryCode="EC" value="593">Ecuador (+593)</option>
         <option data-countryCode="EG" value="20">Egypt (+20)</option>
         <option data-countryCode="SV" value="503">El Salvador (+503)</option>
         <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
         <option data-countryCode="ER" value="291">Eritrea (+291)</option>
         <option data-countryCode="EE" value="372">Estonia (+372)</option>
         <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
         <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
         <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
         <option data-countryCode="FJ" value="679">Fiji (+679)</option>
         <option data-countryCode="FI" value="358">Finland (+358)</option>
         <option data-countryCode="FR" value="33">France (+33)</option>
         <option data-countryCode="GF" value="594">French Guiana (+594)</option>
         <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
         <option data-countryCode="GA" value="241">Gabon (+241)</option>
         <option data-countryCode="GM" value="220">Gambia (+220)</option>
         <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
         <option data-countryCode="DE" value="49">Germany (+49)</option>
         <option data-countryCode="GH" value="233">Ghana (+233)</option>
         <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
         <option data-countryCode="GR" value="30">Greece (+30)</option>
         <option data-countryCode="GL" value="299">Greenland (+299)</option>
         <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
         <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
         <option data-countryCode="GU" value="671">Guam (+671)</option>
         <option data-countryCode="GT" value="502">Guatemala (+502)</option>
         <option data-countryCode="GN" value="224">Guinea (+224)</option>
         <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
         <option data-countryCode="GY" value="592">Guyana (+592)</option>
         <option data-countryCode="HT" value="509">Haiti (+509)</option>
         <option data-countryCode="HN" value="504">Honduras (+504)</option>
         <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
         <option data-countryCode="HU" value="36">Hungary (+36)</option>
         <option data-countryCode="IS" value="354">Iceland (+354)</option>
         <option data-countryCode="IN" value="91">India (+91)</option>
         <option data-countryCode="ID" value="62">Indonesia (+62)</option>
         <option data-countryCode="IQ" value="964">Iraq (+964)</option>
         <option data-countryCode="IR" value="98">Iran (+98)</option>
         <option data-countryCode="IE" value="353">Ireland (+353)</option>
         <option data-countryCode="IL" value="972">Israel (+972)</option>
         <option data-countryCode="IT" value="39">Italy (+39)</option>
         <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
         <option data-countryCode="JP" value="81">Japan (+81)</option>
         <option data-countryCode="JO" value="962">Jordan (+962)</option>
         <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
         <option data-countryCode="KE" value="254">Kenya (+254)</option>
         <option data-countryCode="KI" value="686">Kiribati (+686)</option>
         <option data-countryCode="KP" value="850">Korea - North (+850)</option>
         <option data-countryCode="KR" value="82">Korea - South (+82)</option>
         <option data-countryCode="KW" value="965">Kuwait (+965)</option>
         <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
         <option data-countryCode="LA" value="856">Laos (+856)</option>
         <option data-countryCode="LV" value="371">Latvia (+371)</option>
         <option data-countryCode="LB" value="961">Lebanon (+961)</option>
         <option data-countryCode="LS" value="266">Lesotho (+266)</option>
         <option data-countryCode="LR" value="231">Liberia (+231)</option>
         <option data-countryCode="LY" value="218">Libya (+218)</option>
         <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
         <option data-countryCode="LT" value="370">Lithuania (+370)</option>
         <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
         <option data-countryCode="MO" value="853">Macao (+853)</option>
         <option data-countryCode="MK" value="389">Macedonia (+389)</option>
         <option data-countryCode="MG" value="261">Madagascar (+261)</option>
         <option data-countryCode="MW" value="265">Malawi (+265)</option>
         <option data-countryCode="MY" value="60">Malaysia (+60)</option>
         <option data-countryCode="MV" value="960">Maldives (+960)</option>
         <option data-countryCode="ML" value="223">Mali (+223)</option>
         <option data-countryCode="MT" value="356">Malta (+356)</option>
         <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
         <option data-countryCode="MQ" value="596">Martinique (+596)</option>
         <option data-countryCode="MR" value="222">Mauritania (+222)</option>
         <option data-countryCode="YT" value="269">Mayotte (+269)</option>
         <option data-countryCode="MX" value="52">Mexico (+52)</option>
         <option data-countryCode="FM" value="691">Micronesia (+691)</option>
         <option data-countryCode="MD" value="373">Moldova (+373)</option>
         <option data-countryCode="MC" value="377">Monaco (+377)</option>
         <option data-countryCode="MN" value="976">Mongolia (+976)</option>
         <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
         <option data-countryCode="MA" value="212">Morocco (+212)</option>
         <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
         <option data-countryCode="MN" value="95">Myanmar (+95)</option>
         <option data-countryCode="NA" value="264">Namibia (+264)</option>
         <option data-countryCode="NR" value="674">Nauru (+674)</option>
         <option data-countryCode="NP" value="977">Nepal (+977)</option>
         <option data-countryCode="NL" value="31">Netherlands (+31)</option>
         <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
         <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
         <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
         <option data-countryCode="NE" value="227">Niger (+227)</option>
         <option data-countryCode="NG" value="234">Nigeria (+234)</option>
         <option data-countryCode="NU" value="683">Niue (+683)</option>
         <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
         <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
         <option data-countryCode="NO" value="47">Norway (+47)</option>
         <option data-countryCode="OM" value="968">Oman (+968)</option>
         <option data-countryCode="PK" value="92" selected>Pakistan (+92)</option>
         <option data-countryCode="PW" value="680">Palau (+680)</option>
         <option data-countryCode="PA" value="507">Panama (+507)</option>
         <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
         <option data-countryCode="PY" value="595">Paraguay (+595)</option>
         <option data-countryCode="PE" value="51">Peru (+51)</option>
         <option data-countryCode="PH" value="63">Philippines (+63)</option>
         <option data-countryCode="PL" value="48">Poland (+48)</option>
         <option data-countryCode="PT" value="351">Portugal (+351)</option>
         <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
         <option data-countryCode="QA" value="974">Qatar (+974)</option>
         <option data-countryCode="RE" value="262">Reunion (+262)</option>
         <option data-countryCode="RO" value="40">Romania (+40)</option>
         <option data-countryCode="RU" value="7">Russia (+7)</option>
         <option data-countryCode="RW" value="250">Rwanda (+250)</option>
         <option data-countryCode="SM" value="378">San Marino (+378)</option>
         <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
         <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
         <option data-countryCode="SN" value="221">Senegal (+221)</option>
         <option data-countryCode="CS" value="381">Serbia (+381)</option>
         <option data-countryCode="SC" value="248">Seychelles (+248)</option>
         <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
         <option data-countryCode="SG" value="65">Singapore (+65)</option>
         <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
         <option data-countryCode="SI" value="386">Slovenia (+386)</option>
         <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
         <option data-countryCode="SO" value="252">Somalia (+252)</option>
         <option data-countryCode="ZA" value="27">South Africa (+27)</option>
         <option data-countryCode="ES" value="34">Spain (+34)</option>
         <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
         <option data-countryCode="SH" value="290">St. Helena (+290)</option>
         <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
         <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
         <option data-countryCode="SR" value="597">Suriname (+597)</option>
         <option data-countryCode="SD" value="249">Sudan (+249)</option>
         <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
         <option data-countryCode="SE" value="46">Sweden (+46)</option>
         <option data-countryCode="CH" value="41">Switzerland (+41)</option>
         <option data-countryCode="SY" value="963">Syria (+963)</option>
         <option data-countryCode="TW" value="886">Taiwan (+886)</option>
         <option data-countryCode="TJ" value="992">Tajikistan (+992)</option>
         <option data-countryCode="TH" value="66">Thailand (+66)</option>
         <option data-countryCode="TG" value="228">Togo (+228)</option>
         <option data-countryCode="TO" value="676">Tonga (+676)</option>
         <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
         <option data-countryCode="TN" value="216">Tunisia (+216)</option>
         <option data-countryCode="TR" value="90">Turkey (+90)</option>
         <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
         <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
         <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
         <option data-countryCode="UG" value="256">Uganda (+256)</option>
         <option data-countryCode="UA" value="380">Ukraine (+380)</option>
         <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
         <option data-countryCode="UY" value="598">Uruguay (+598)</option>
         <option data-countryCode="UZ" value="998">Uzbekistan (+998)</option>
         <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
         <option data-countryCode="VA" value="379">Vatican City (+379)</option>
         <option data-countryCode="VE" value="58">Venezuela (+58)</option>
         <option data-countryCode="VN" value="84">Vietnam (+84)</option>
         <option data-countryCode="VG" value="1">Virgin Islands - British (+1)</option>
         <option data-countryCode="VI" value="1">Virgin Islands - US (+1)</option>
         <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
         <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
         <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
         <option data-countryCode="ZM" value="260">Zambia (+260)</option>
         <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
         </select>
         <input type="text" class="col-md-10 f-no" placeholder="Mobile" id="father_number"  style="padding-left:150px;"/> 
         <button class="add_field_button_father">+</button>
         </div><!-- input_fields_wrap -->
         </div><!-- col-md-6  -->   
         <div class="col-md-6 input_fields_wrap_mother_div">
         <div class="input_fields_wrap_mother">
         <label>Mother Mobile</label>
         <select class="countryCodeNumberMother"> 
         <option data-countryCode="US" value="1" selected>USA (+1)</option>
         <option data-countryCode="GB" value="44">UK (+44)</option>
         <option disabled="disabled">Other Countries</option>
         <option data-countryCode="DZ" value="213">Algeria (+213)</option>
         <option data-countryCode="AD" value="376">Andorra (+376)</option>
         <option data-countryCode="AO" value="244">Angola (+244)</option>
         <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
         <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
         <option data-countryCode="AR" value="54">Argentina (+54)</option>
         <option data-countryCode="AM" value="374">Armenia (+374)</option>
         <option data-countryCode="AW" value="297">Aruba (+297)</option>
         <option data-countryCode="AU" value="61">Australia (+61)</option>
         <option data-countryCode="AT" value="43">Austria (+43)</option>
         <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
         <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
         <option data-countryCode="BH" value="973">Bahrain (+973)</option>
         <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
         <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
         <option data-countryCode="BY" value="375">Belarus (+375)</option>
         <option data-countryCode="BE" value="32">Belgium (+32)</option>
         <option data-countryCode="BZ" value="501">Belize (+501)</option>
         <option data-countryCode="BJ" value="229">Benin (+229)</option>
         <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
         <option data-countryCode="BT" value="975">Bhutan (+975)</option>
         <option data-countryCode="BO" value="591">Bolivia (+591)</option>
         <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
         <option data-countryCode="BW" value="267">Botswana (+267)</option>
         <option data-countryCode="BR" value="55">Brazil (+55)</option>
         <option data-countryCode="BN" value="673">Brunei (+673)</option>
         <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
         <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
         <option data-countryCode="BI" value="257">Burundi (+257)</option>
         <option data-countryCode="KH" value="855">Cambodia (+855)</option>
         <option data-countryCode="CM" value="237">Cameroon (+237)</option>
         <option data-countryCode="CA" value="1">Canada (+1)</option>
         <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
         <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
         <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
         <option data-countryCode="CL" value="56">Chile (+56)</option>
         <option data-countryCode="CN" value="86">China (+86)</option>
         <option data-countryCode="CO" value="57">Colombia (+57)</option>
         <option data-countryCode="KM" value="269">Comoros (+269)</option>
         <option data-countryCode="CG" value="242">Congo (+242)</option>
         <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
         <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
         <option data-countryCode="HR" value="385">Croatia (+385)</option>
         <!-- <option data-countryCode="CU" value="53">Cuba (+53)</option> -->
         <option data-countryCode="CY" value="90">Cyprus - North (+90)</option>
         <option data-countryCode="CY" value="357">Cyprus - South (+357)</option>
         <option data-countryCode="CZ" value="420">Czech Republic (+420)</option>
         <option data-countryCode="DK" value="45">Denmark (+45)</option>
         <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
         <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
         <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
         <option data-countryCode="EC" value="593">Ecuador (+593)</option>
         <option data-countryCode="EG" value="20">Egypt (+20)</option>
         <option data-countryCode="SV" value="503">El Salvador (+503)</option>
         <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
         <option data-countryCode="ER" value="291">Eritrea (+291)</option>
         <option data-countryCode="EE" value="372">Estonia (+372)</option>
         <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
         <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
         <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
         <option data-countryCode="FJ" value="679">Fiji (+679)</option>
         <option data-countryCode="FI" value="358">Finland (+358)</option>
         <option data-countryCode="FR" value="33">France (+33)</option>
         <option data-countryCode="GF" value="594">French Guiana (+594)</option>
         <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
         <option data-countryCode="GA" value="241">Gabon (+241)</option>
         <option data-countryCode="GM" value="220">Gambia (+220)</option>
         <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
         <option data-countryCode="DE" value="49">Germany (+49)</option>
         <option data-countryCode="GH" value="233">Ghana (+233)</option>
         <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
         <option data-countryCode="GR" value="30">Greece (+30)</option>
         <option data-countryCode="GL" value="299">Greenland (+299)</option>
         <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
         <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
         <option data-countryCode="GU" value="671">Guam (+671)</option>
         <option data-countryCode="GT" value="502">Guatemala (+502)</option>
         <option data-countryCode="GN" value="224">Guinea (+224)</option>
         <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
         <option data-countryCode="GY" value="592">Guyana (+592)</option>
         <option data-countryCode="HT" value="509">Haiti (+509)</option>
         <option data-countryCode="HN" value="504">Honduras (+504)</option>
         <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
         <option data-countryCode="HU" value="36">Hungary (+36)</option>
         <option data-countryCode="IS" value="354">Iceland (+354)</option>
         <option data-countryCode="IN" value="91">India (+91)</option>
         <option data-countryCode="ID" value="62">Indonesia (+62)</option>
         <option data-countryCode="IQ" value="964">Iraq (+964)</option>
         <!-- <option data-countryCode="IR" value="98">Iran (+98)</option> -->
         <option data-countryCode="IE" value="353">Ireland (+353)</option>
         <option data-countryCode="IL" value="972">Israel (+972)</option>
         <option data-countryCode="IT" value="39">Italy (+39)</option>
         <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
         <option data-countryCode="JP" value="81">Japan (+81)</option>
         <option data-countryCode="JO" value="962">Jordan (+962)</option>
         <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
         <option data-countryCode="KE" value="254">Kenya (+254)</option>
         <option data-countryCode="KI" value="686">Kiribati (+686)</option>
         <!-- <option data-countryCode="KP" value="850">Korea - North (+850)</option> -->
         <option data-countryCode="KR" value="82">Korea - South (+82)</option>
         <option data-countryCode="KW" value="965">Kuwait (+965)</option>
         <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
         <option data-countryCode="LA" value="856">Laos (+856)</option>
         <option data-countryCode="LV" value="371">Latvia (+371)</option>
         <option data-countryCode="LB" value="961">Lebanon (+961)</option>
         <option data-countryCode="LS" value="266">Lesotho (+266)</option>
         <option data-countryCode="LR" value="231">Liberia (+231)</option>
         <option data-countryCode="LY" value="218">Libya (+218)</option>
         <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
         <option data-countryCode="LT" value="370">Lithuania (+370)</option>
         <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
         <option data-countryCode="MO" value="853">Macao (+853)</option>
         <option data-countryCode="MK" value="389">Macedonia (+389)</option>
         <option data-countryCode="MG" value="261">Madagascar (+261)</option>
         <option data-countryCode="MW" value="265">Malawi (+265)</option>
         <option data-countryCode="MY" value="60">Malaysia (+60)</option>
         <option data-countryCode="MV" value="960">Maldives (+960)</option>
         <option data-countryCode="ML" value="223">Mali (+223)</option>
         <option data-countryCode="MT" value="356">Malta (+356)</option>
         <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
         <option data-countryCode="MQ" value="596">Martinique (+596)</option>
         <option data-countryCode="MR" value="222">Mauritania (+222)</option>
         <option data-countryCode="YT" value="269">Mayotte (+269)</option>
         <option data-countryCode="MX" value="52">Mexico (+52)</option>
         <option data-countryCode="FM" value="691">Micronesia (+691)</option>
         <option data-countryCode="MD" value="373">Moldova (+373)</option>
         <option data-countryCode="MC" value="377">Monaco (+377)</option>
         <option data-countryCode="MN" value="976">Mongolia (+976)</option>
         <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
         <option data-countryCode="MA" value="212">Morocco (+212)</option>
         <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
         <option data-countryCode="MN" value="95">Myanmar (+95)</option>
         <option data-countryCode="NA" value="264">Namibia (+264)</option>
         <option data-countryCode="NR" value="674">Nauru (+674)</option>
         <option data-countryCode="NP" value="977">Nepal (+977)</option>
         <option data-countryCode="NL" value="31">Netherlands (+31)</option>
         <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
         <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
         <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
         <option data-countryCode="NE" value="227">Niger (+227)</option>
         <option data-countryCode="NG" value="234">Nigeria (+234)</option>
         <option data-countryCode="NU" value="683">Niue (+683)</option>
         <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
         <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
         <option data-countryCode="NO" value="47">Norway (+47)</option>
         <option data-countryCode="OM" value="968">Oman (+968)</option>
         <option data-countryCode="PK" value="92" selected>Pakistan (+92)</option>
         <option data-countryCode="PW" value="680">Palau (+680)</option>
         <option data-countryCode="PA" value="507">Panama (+507)</option>
         <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
         <option data-countryCode="PY" value="595">Paraguay (+595)</option>
         <option data-countryCode="PE" value="51">Peru (+51)</option>
         <option data-countryCode="PH" value="63">Philippines (+63)</option>
         <option data-countryCode="PL" value="48">Poland (+48)</option>
         <option data-countryCode="PT" value="351">Portugal (+351)</option>
         <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
         <option data-countryCode="QA" value="974">Qatar (+974)</option>
         <option data-countryCode="RE" value="262">Reunion (+262)</option>
         <option data-countryCode="RO" value="40">Romania (+40)</option>
         <option data-countryCode="RU" value="7">Russia (+7)</option>
         <option data-countryCode="RW" value="250">Rwanda (+250)</option>
         <option data-countryCode="SM" value="378">San Marino (+378)</option>
         <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
         <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
         <option data-countryCode="SN" value="221">Senegal (+221)</option>
         <option data-countryCode="CS" value="381">Serbia (+381)</option>
         <option data-countryCode="SC" value="248">Seychelles (+248)</option>
         <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
         <option data-countryCode="SG" value="65">Singapore (+65)</option>
         <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
         <option data-countryCode="SI" value="386">Slovenia (+386)</option>
         <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
         <option data-countryCode="SO" value="252">Somalia (+252)</option>
         <option data-countryCode="ZA" value="27">South Africa (+27)</option>
         <option data-countryCode="ES" value="34">Spain (+34)</option>
         <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
         <option data-countryCode="SH" value="290">St. Helena (+290)</option>
         <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
         <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
         <option data-countryCode="SR" value="597">Suriname (+597)</option>
         <option data-countryCode="SD" value="249">Sudan (+249)</option>
         <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
         <option data-countryCode="SE" value="46">Sweden (+46)</option>
         <option data-countryCode="CH" value="41">Switzerland (+41)</option>
         <!-- <option data-countryCode="SY" value="963">Syria (+963)</option> -->
         <option data-countryCode="TW" value="886">Taiwan (+886)</option>
         <option data-countryCode="TJ" value="992">Tajikistan (+992)</option>
         <option data-countryCode="TH" value="66">Thailand (+66)</option>
         <option data-countryCode="TG" value="228">Togo (+228)</option>
         <option data-countryCode="TO" value="676">Tonga (+676)</option>
         <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
         <option data-countryCode="TN" value="216">Tunisia (+216)</option>
         <option data-countryCode="TR" value="90">Turkey (+90)</option>
         <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
         <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
         <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
         <option data-countryCode="UG" value="256">Uganda (+256)</option>
         <option data-countryCode="UA" value="380">Ukraine (+380)</option>
         <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
         <option data-countryCode="UY" value="598">Uruguay (+598)</option>
         <option data-countryCode="UZ" value="998">Uzbekistan (+998)</option>
         <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
         <option data-countryCode="VA" value="379">Vatican City (+379)</option>
         <option data-countryCode="VE" value="58">Venezuela (+58)</option>
         <option data-countryCode="VN" value="84">Vietnam (+84)</option>
         <option data-countryCode="VG" value="1">Virgin Islands - British (+1)</option>
         <option data-countryCode="VI" value="1">Virgin Islands - US (+1)</option>
         <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
         <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
         <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
         <option data-countryCode="ZM" value="260">Zambia (+260)</option>
         <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
         </select>
         <input type="text" class="col-md-10 m-no" placeholder="Mobile" id="mother_number"  style="padding-left:150px;" /> 
         <button class="add_field_button_mother">+</button>
         </div><!-- input_fields_wrap -->
         </div><!-- col-md-6  -->
         </div><!-- col-md-12 -->
         <div class="col-md-12 paddingTop20">
         <div class="col-md-6">
         <label>Father NIC</label>
         <input type="text" placeholder="Father NIC" id="father_nic"/> 
         </div><!-- col-md-6  -->
         <div class="col-md-6">
         <label>Mother NIC</label>
         <input type="text" placeholder="Mother NIC" id="mother_nic"/> 
         </div><!-- col-md-6  -->
         </div><!-- col-md-12 -->
         <div class="col-md-12 paddingTop20">
         <div class="col-md-6">
         <label>Father Email</label>
         <input type="text" placeholder="Father Email" id="father_email"/> 
         </div><!-- col-md-6  -->
         <div class="col-md-6">
         <label>Mother Email</label>
         <input type="text" placeholder="Mother Email" id="mother_email"/> 
         </div><!-- col-md-6  -->
         </div><!-- col-md-12 -->
         
         </form>
         </div>
         <!-- col-md-12 -->
         <br />
      <div class="modal-footer">
        <!--  <button type="button" class="btn btn-success" data-dismiss="modal" onClick="updateForm()">Update</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> -->
         <input type="submit" class="btn btn-success" onclick="updateForm()" />
      </div>
         
      </div>
      <!-- modal-body -->
      
   </div>
   <!-- modal-content -->
</div>
<!-- modal-dialog -->
</div><!-- modal -->