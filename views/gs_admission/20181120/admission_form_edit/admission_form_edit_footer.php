<!--Forms-->

<!--Panel Question Modal-->
<div class="modal fade" id="alreadySubmitted">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header"> Campus<i class="fa fa-question"></i>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
      <div class="modal-body text-center"> Please Choose Campus </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 


<script type="text/javascript">

$(document).on("click", "#request_grade", function(){
	if( $("#request_grade").is(':checked') ){
		$("#requestedGrade_div").show("fast");  // checked
	}else{
		$("#requestedGrade_div").hide("slow");  // unchecked
		$('#requestGrade').val('');
	}
});

var editAdmission  = function(id){
	var admission_form_id = id;
	$.ajax({
		type:"POST",
		cache:false,
		data:{
			admission_form_id:admission_form_id
		},
		url:"<?php echo site_url() ?>/gs_admission/admission_form_editable/getApplicantDetail",
		success :function(e){
			var data =  JSON.parse(e);
			if(data.length > 0){
				$('.input_fields_wrap').remove();
				$('.input_fields_wrap_additional_student').remove();
				$('.input_fields_wrap_additional_father').remove();
				$('.input_fields_wrap_additional_mother').remove();
				$('.input_fields_wrap_student').remove();
				$('#admission_form_id').val(admission_form_id);
				$('#official_name').val(data[0].official_name);
				$('#call_name').val(data[0].call_name);
				$('#dateOfBirth').val(data[0].dob);
				$('#gender').val(data[0].gender);
				$('#father_name').val(data[0].father_name);
				$('#mother_name').val(data[0].mother_name);
				$('#father_nic').val(data[0].father_nic);
				$('#mother_nic').val(data[0].mother_nic);
				$('#father_email').val(data[0].father_email);
				$('#mother_email').val(data[0].mother_email);
				$('#student_email').val(data[0].student_email);
				$('#student_nic').val(data[0].student_nic);
				$('#gf_id').val(data[0].gfid);
				$('#grade').val(data[0].grade_id);
				var father_mobile_other = data[0].father_mobile_other;
				var mother_mobile_other = data[0].mother_mobile_other;
				var student_mobile = data[0].student_mobile;
				var request_for_grade = data[0].request_for_grade;
				var request_grade = data[0].request_grade;


				if(request_grade > 0 &&  request_for_grade > 0){
					$('#request_grade').prop("checked",true);
					$('#requestedGrade_div').show();
					$('#requestGrade').val(request_for_grade);
				}else{
					$('#request_grade').prop("checked",false);
					$('#requestedGrade_div').hide();
					$('#requestGrade').val('');
				}




				// Father Mobile	
				if(data[0].father_mobile){
					console.log(data[0].father_mobile);
					var fatherMobile =  data[0].father_mobile.substring(1,data[0].father_mobile.length);
					fatherMobile = fatherMobile.replace("-", "");
					$('#father_number').val(fatherMobile);
					$('.countryCodeNumberFather').val(92);
				}

				// Mother Mobile
				if(data[0].mother_mobile){
					var mother_mobile =  data[0].mother_mobile.substring(1,data[0].mother_mobile.length);
					mother_mobile = mother_mobile.replace("-", "");
					$('#mother_number').val(mother_mobile );
					$('.countryCodeNumberMother').val(92);
				}


				// FATHER MOBILE OTHER
				if(father_mobile_other){
					var code_number =  getMobileOther(father_mobile_other);
					for (var j = 0 ; j < code_number.length ; j++ ){

					$('.input_fields_wrap_father_div').append('<div class="input_fields_wrap_additional_father" id="fields_wrap_additional_father"><select class="countryCodeNumberFather countryCodeNumberFather_'+j+'" name="fatherMobile[]"> <option disabled="disabled">Other Countries</option> <option data-countryCode="US" value="1" selected>USA (+1)</option> <option data-countryCode="GB" value="44">UK (+44)</option> <option data-countryCode="DZ" value="213">Algeria (+213)</option> <option data-countryCode="AD" value="376">Andorra (+376)</option> <option data-countryCode="AO" value="244">Angola (+244)</option> <option data-countryCode="AI" value="1264">Anguilla (+1264)</option> <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option> <option data-countryCode="AR" value="54">Argentina (+54)</option> <option data-countryCode="AM" value="374">Armenia (+374)</option> <option data-countryCode="AW" value="297">Aruba (+297)</option> <option data-countryCode="AU" value="61">Australia (+61)</option> <option data-countryCode="AT" value="43">Austria (+43)</option> <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option> <option data-countryCode="BS" value="1242">Bahamas (+1242)</option> <option data-countryCode="BH" value="973">Bahrain (+973)</option> <option data-countryCode="BD" value="880">Bangladesh (+880)</option> <option data-countryCode="BB" value="1246">Barbados (+1246)</option> <option data-countryCode="BY" value="375">Belarus (+375)</option> <option data-countryCode="BE" value="32">Belgium (+32)</option> <option data-countryCode="BZ" value="501">Belize (+501)</option> <option data-countryCode="BJ" value="229">Benin (+229)</option> <option data-countryCode="BM" value="1441">Bermuda (+1441)</option> <option data-countryCode="BT" value="975">Bhutan (+975)</option> <option data-countryCode="BO" value="591">Bolivia (+591)</option> <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option> <option data-countryCode="BW" value="267">Botswana (+267)</option> <option data-countryCode="BR" value="55">Brazil (+55)</option> <option data-countryCode="BN" value="673">Brunei (+673)</option> <option data-countryCode="BG" value="359">Bulgaria (+359)</option> <option data-countryCode="BF" value="226">Burkina Faso (+226)</option> <option data-countryCode="BI" value="257">Burundi (+257)</option> <option data-countryCode="KH" value="855">Cambodia (+855)</option> <option data-countryCode="CM" value="237">Cameroon (+237)</option> <option data-countryCode="CA" value="1">Canada (+1)</option> <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option> <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option> <option data-countryCode="CF" value="236">Central African Republic (+236)</option> <option data-countryCode="CL" value="56">Chile (+56)</option> <option data-countryCode="CN" value="86">China (+86)</option> <option data-countryCode="CO" value="57">Colombia (+57)</option> <option data-countryCode="KM" value="269">Comoros (+269)</option> <option data-countryCode="CG" value="242">Congo (+242)</option> <option data-countryCode="CK" value="682">Cook Islands (+682)</option> <option data-countryCode="CR" value="506">Costa Rica (+506)</option> <option data-countryCode="HR" value="385">Croatia (+385)</option> <option data-countryCode="CU" value="53">Cuba (+53)</option> <option data-countryCode="CY" value="90">Cyprus - North (+90)</option> <option data-countryCode="CY" value="357">Cyprus - South (+357)</option> <option data-countryCode="CZ" value="420">Czech Republic (+420)</option> <option data-countryCode="DK" value="45">Denmark (+45)</option> <option data-countryCode="DJ" value="253">Djibouti (+253)</option> <option data-countryCode="DM" value="1809">Dominica (+1809)</option> <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option> <option data-countryCode="EC" value="593">Ecuador (+593)</option> <option data-countryCode="EG" value="20">Egypt (+20)</option> <option data-countryCode="SV" value="503">El Salvador (+503)</option> <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option> <option data-countryCode="ER" value="291">Eritrea (+291)</option> <option data-countryCode="EE" value="372">Estonia (+372)</option> <option data-countryCode="ET" value="251">Ethiopia (+251)</option> <option data-countryCode="FK" value="500">Falkland Islands (+500)</option> <option data-countryCode="FO" value="298">Faroe Islands (+298)</option> <option data-countryCode="FJ" value="679">Fiji (+679)</option> <option data-countryCode="FI" value="358">Finland (+358)</option> <option data-countryCode="FR" value="33">France (+33)</option> <option data-countryCode="GF" value="594">French Guiana (+594)</option> <option data-countryCode="PF" value="689">French Polynesia (+689)</option> <option data-countryCode="GA" value="241">Gabon (+241)</option> <option data-countryCode="GM" value="220">Gambia (+220)</option> <option data-countryCode="GE" value="7880">Georgia (+7880)</option> <option data-countryCode="DE" value="49">Germany (+49)</option> <option data-countryCode="GH" value="233">Ghana (+233)</option> <option data-countryCode="GI" value="350">Gibraltar (+350)</option> <option data-countryCode="GR" value="30">Greece (+30)</option> <option data-countryCode="GL" value="299">Greenland (+299)</option> <option data-countryCode="GD" value="1473">Grenada (+1473)</option> <option data-countryCode="GP" value="590">Guadeloupe (+590)</option> <option data-countryCode="GU" value="671">Guam (+671)</option> <option data-countryCode="GT" value="502">Guatemala (+502)</option> <option data-countryCode="GN" value="224">Guinea (+224)</option> <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option> <option data-countryCode="GY" value="592">Guyana (+592)</option> <option data-countryCode="HT" value="509">Haiti (+509)</option> <option data-countryCode="HN" value="504">Honduras (+504)</option> <option data-countryCode="HK" value="852">Hong Kong (+852)</option> <option data-countryCode="HU" value="36">Hungary (+36)</option> <option data-countryCode="IS" value="354">Iceland (+354)</option> <option data-countryCode="IN" value="91">India (+91)</option> <option data-countryCode="ID" value="62">Indonesia (+62)</option> <option data-countryCode="IQ" value="964">Iraq (+964)</option> <option data-countryCode="IR" value="98">Iran (+98)</option> <option data-countryCode="IE" value="353">Ireland (+353)</option> <option data-countryCode="IL" value="972">Israel (+972)</option> <option data-countryCode="IT" value="39">Italy (+39)</option> <option data-countryCode="JM" value="1876">Jamaica (+1876)</option> <option data-countryCode="JP" value="81">Japan (+81)</option> <option data-countryCode="JO" value="962">Jordan (+962)</option> <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option> <option data-countryCode="KE" value="254">Kenya (+254)</option> <option data-countryCode="KI" value="686">Kiribati (+686)</option> <option data-countryCode="KP" value="850">Korea - North (+850)</option> <option data-countryCode="KR" value="82">Korea - South (+82)</option> <option data-countryCode="KW" value="965">Kuwait (+965)</option> <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option> <option data-countryCode="LA" value="856">Laos (+856)</option> <option data-countryCode="LV" value="371">Latvia (+371)</option> <option data-countryCode="LB" value="961">Lebanon (+961)</option> <option data-countryCode="LS" value="266">Lesotho (+266)</option> <option data-countryCode="LR" value="231">Liberia (+231)</option> <option data-countryCode="LY" value="218">Libya (+218)</option> <option data-countryCode="LI" value="417">Liechtenstein (+417)</option> <option data-countryCode="LT" value="370">Lithuania (+370)</option> <option data-countryCode="LU" value="352">Luxembourg (+352)</option> <option data-countryCode="MO" value="853">Macao (+853)</option> <option data-countryCode="MK" value="389">Macedonia (+389)</option> <option data-countryCode="MG" value="261">Madagascar (+261)</option> <option data-countryCode="MW" value="265">Malawi (+265)</option> <option data-countryCode="MY" value="60">Malaysia (+60)</option> <option data-countryCode="MV" value="960">Maldives (+960)</option> <option data-countryCode="ML" value="223">Mali (+223)</option> <option data-countryCode="MT" value="356">Malta (+356)</option> <option data-countryCode="MH" value="692">Marshall Islands (+692)</option> <option data-countryCode="MQ" value="596">Martinique (+596)</option> <option data-countryCode="MR" value="222">Mauritania (+222)</option> <option data-countryCode="YT" value="269">Mayotte (+269)</option> <option data-countryCode="MX" value="52">Mexico (+52)</option> <option data-countryCode="FM" value="691">Micronesia (+691)</option> <option data-countryCode="MD" value="373">Moldova (+373)</option> <option data-countryCode="MC" value="377">Monaco (+377)</option> <option data-countryCode="MN" value="976">Mongolia (+976)</option> <option data-countryCode="MS" value="1664">Montserrat (+1664)</option> <option data-countryCode="MA" value="212">Morocco (+212)</option> <option data-countryCode="MZ" value="258">Mozambique (+258)</option> <option data-countryCode="MN" value="95">Myanmar (+95)</option> <option data-countryCode="NA" value="264">Namibia (+264)</option> <option data-countryCode="NR" value="674">Nauru (+674)</option> <option data-countryCode="NP" value="977">Nepal (+977)</option> <option data-countryCode="NL" value="31">Netherlands (+31)</option> <option data-countryCode="NC" value="687">New Caledonia (+687)</option> <option data-countryCode="NZ" value="64">New Zealand (+64)</option> <option data-countryCode="NI" value="505">Nicaragua (+505)</option> <option data-countryCode="NE" value="227">Niger (+227)</option> <option data-countryCode="NG" value="234">Nigeria (+234)</option> <option data-countryCode="NU" value="683">Niue (+683)</option> <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option> <option data-countryCode="NP" value="670">Northern Marianas (+670)</option> <option data-countryCode="NO" value="47">Norway (+47)</option> <option data-countryCode="OM" value="968">Oman (+968)</option> <option data-countryCode="PK" value="92" selected>Pakistan (+92)</option> <option data-countryCode="PW" value="680">Palau (+680)</option> <option data-countryCode="PA" value="507">Panama (+507)</option> <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option> <option data-countryCode="PY" value="595">Paraguay (+595)</option> <option data-countryCode="PE" value="51">Peru (+51)</option> <option data-countryCode="PH" value="63">Philippines (+63)</option> <option data-countryCode="PL" value="48">Poland (+48)</option> <option data-countryCode="PT" value="351">Portugal (+351)</option> <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option> <option data-countryCode="QA" value="974">Qatar (+974)</option> <option data-countryCode="RE" value="262">Reunion (+262)</option> <option data-countryCode="RO" value="40">Romania (+40)</option> <option data-countryCode="RU" value="7">Russia (+7)</option> <option data-countryCode="RW" value="250">Rwanda (+250)</option> <option data-countryCode="SM" value="378">San Marino (+378)</option> <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option> <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option> <option data-countryCode="SN" value="221">Senegal (+221)</option> <option data-countryCode="CS" value="381">Serbia (+381)</option> <option data-countryCode="SC" value="248">Seychelles (+248)</option> <option data-countryCode="SL" value="232">Sierra Leone (+232)</option> <option data-countryCode="SG" value="65">Singapore (+65)</option> <option data-countryCode="SK" value="421">Slovak Republic (+421)</option> <option data-countryCode="SI" value="386">Slovenia (+386)</option> <option data-countryCode="SB" value="677">Solomon Islands (+677)</option> <option data-countryCode="SO" value="252">Somalia (+252)</option> <option data-countryCode="ZA" value="27">South Africa (+27)</option> <option data-countryCode="ES" value="34">Spain (+34)</option> <option data-countryCode="LK" value="94">Sri Lanka (+94)</option> <option data-countryCode="SH" value="290">St. Helena (+290)</option> <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option> <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option> <option data-countryCode="SR" value="597">Suriname (+597)</option> <option data-countryCode="SD" value="249">Sudan (+249)</option> <option data-countryCode="SZ" value="268">Swaziland (+268)</option> <option data-countryCode="SE" value="46">Sweden (+46)</option> <option data-countryCode="CH" value="41">Switzerland (+41)</option> <option data-countryCode="SY" value="963">Syria (+963)</option> <option data-countryCode="TW" value="886">Taiwan (+886)</option> <option data-countryCode="TJ" value="992">Tajikistan (+992)</option> <option data-countryCode="TH" value="66">Thailand (+66)</option> <option data-countryCode="TG" value="228">Togo (+228)</option> <option data-countryCode="TO" value="676">Tonga (+676)</option> <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option> <option data-countryCode="TN" value="216">Tunisia (+216)</option> <option data-countryCode="TR" value="90">Turkey (+90)</option> <option data-countryCode="TM" value="993">Turkmenistan (+993)</option> <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option> <option data-countryCode="TV" value="688">Tuvalu (+688)</option> <option data-countryCode="UG" value="256">Uganda (+256)</option> <option data-countryCode="UA" value="380">Ukraine (+380)</option> <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option> <option data-countryCode="UY" value="598">Uruguay (+598)</option> <option data-countryCode="UZ" value="998">Uzbekistan (+998)</option> <option data-countryCode="VU" value="678">Vanuatu (+678)</option> <option data-countryCode="VA" value="379">Vatican City (+379)</option> <option data-countryCode="VE" value="58">Venezuela (+58)</option> <option data-countryCode="VN" value="84">Vietnam (+84)</option> <option data-countryCode="VG" value="1">Virgin Islands - British (+1)</option> <option data-countryCode="VI" value="1">Virgin Islands - US (+1)</option> <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option> <option data-countryCode="YE" value="969">Yemen (North)(+969)</option> <option data-countryCode="YE" value="967">Yemen (South)(+967)</option> <option data-countryCode="ZM" value="260">Zambia (+260)</option> <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option></select><input type="text" class="col-md-10 f-no f-no_'+j+'" placeholder="Mobile" style="padding-left:150px;" /> <a href="#" class="remove_field1">X</a></div>');

						$('.countryCodeNumberFather_'+j).val(code_number[j][0]);
						$('.f-no_'+j).val(code_number[j][1]);
						$('.f-no').mask('9999999999');
					}
				}

				//MOTHER MOBILE OTHER
				if(mother_mobile_other){
					var code_number =  getMobileOther(mother_mobile_other);
					for (var j = 0 ; j < code_number.length ; j++ ){

					$('.input_fields_wrap_mother_div').append('<div class="input_fields_wrap_additional_mother" id="fields_wrap_additional_mother"><select class="countryCodeNumberMother countryCodeNumberMother_'+j+'" name="fatherMobile[]"> <option disabled="disabled">Other Countries</option> <option data-countryCode="US" value="1" selected>USA (+1)</option> <option data-countryCode="GB" value="44">UK (+44)</option> <option data-countryCode="DZ" value="213">Algeria (+213)</option> <option data-countryCode="AD" value="376">Andorra (+376)</option> <option data-countryCode="AO" value="244">Angola (+244)</option> <option data-countryCode="AI" value="1264">Anguilla (+1264)</option> <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option> <option data-countryCode="AR" value="54">Argentina (+54)</option> <option data-countryCode="AM" value="374">Armenia (+374)</option> <option data-countryCode="AW" value="297">Aruba (+297)</option> <option data-countryCode="AU" value="61">Australia (+61)</option> <option data-countryCode="AT" value="43">Austria (+43)</option> <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option> <option data-countryCode="BS" value="1242">Bahamas (+1242)</option> <option data-countryCode="BH" value="973">Bahrain (+973)</option> <option data-countryCode="BD" value="880">Bangladesh (+880)</option> <option data-countryCode="BB" value="1246">Barbados (+1246)</option> <option data-countryCode="BY" value="375">Belarus (+375)</option> <option data-countryCode="BE" value="32">Belgium (+32)</option> <option data-countryCode="BZ" value="501">Belize (+501)</option> <option data-countryCode="BJ" value="229">Benin (+229)</option> <option data-countryCode="BM" value="1441">Bermuda (+1441)</option> <option data-countryCode="BT" value="975">Bhutan (+975)</option> <option data-countryCode="BO" value="591">Bolivia (+591)</option> <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option> <option data-countryCode="BW" value="267">Botswana (+267)</option> <option data-countryCode="BR" value="55">Brazil (+55)</option> <option data-countryCode="BN" value="673">Brunei (+673)</option> <option data-countryCode="BG" value="359">Bulgaria (+359)</option> <option data-countryCode="BF" value="226">Burkina Faso (+226)</option> <option data-countryCode="BI" value="257">Burundi (+257)</option> <option data-countryCode="KH" value="855">Cambodia (+855)</option> <option data-countryCode="CM" value="237">Cameroon (+237)</option> <option data-countryCode="CA" value="1">Canada (+1)</option> <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option> <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option> <option data-countryCode="CF" value="236">Central African Republic (+236)</option> <option data-countryCode="CL" value="56">Chile (+56)</option> <option data-countryCode="CN" value="86">China (+86)</option> <option data-countryCode="CO" value="57">Colombia (+57)</option> <option data-countryCode="KM" value="269">Comoros (+269)</option> <option data-countryCode="CG" value="242">Congo (+242)</option> <option data-countryCode="CK" value="682">Cook Islands (+682)</option> <option data-countryCode="CR" value="506">Costa Rica (+506)</option> <option data-countryCode="HR" value="385">Croatia (+385)</option> <option data-countryCode="CU" value="53">Cuba (+53)</option> <option data-countryCode="CY" value="90">Cyprus - North (+90)</option> <option data-countryCode="CY" value="357">Cyprus - South (+357)</option> <option data-countryCode="CZ" value="420">Czech Republic (+420)</option> <option data-countryCode="DK" value="45">Denmark (+45)</option> <option data-countryCode="DJ" value="253">Djibouti (+253)</option> <option data-countryCode="DM" value="1809">Dominica (+1809)</option> <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option> <option data-countryCode="EC" value="593">Ecuador (+593)</option> <option data-countryCode="EG" value="20">Egypt (+20)</option> <option data-countryCode="SV" value="503">El Salvador (+503)</option> <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option> <option data-countryCode="ER" value="291">Eritrea (+291)</option> <option data-countryCode="EE" value="372">Estonia (+372)</option> <option data-countryCode="ET" value="251">Ethiopia (+251)</option> <option data-countryCode="FK" value="500">Falkland Islands (+500)</option> <option data-countryCode="FO" value="298">Faroe Islands (+298)</option> <option data-countryCode="FJ" value="679">Fiji (+679)</option> <option data-countryCode="FI" value="358">Finland (+358)</option> <option data-countryCode="FR" value="33">France (+33)</option> <option data-countryCode="GF" value="594">French Guiana (+594)</option> <option data-countryCode="PF" value="689">French Polynesia (+689)</option> <option data-countryCode="GA" value="241">Gabon (+241)</option> <option data-countryCode="GM" value="220">Gambia (+220)</option> <option data-countryCode="GE" value="7880">Georgia (+7880)</option> <option data-countryCode="DE" value="49">Germany (+49)</option> <option data-countryCode="GH" value="233">Ghana (+233)</option> <option data-countryCode="GI" value="350">Gibraltar (+350)</option> <option data-countryCode="GR" value="30">Greece (+30)</option> <option data-countryCode="GL" value="299">Greenland (+299)</option> <option data-countryCode="GD" value="1473">Grenada (+1473)</option> <option data-countryCode="GP" value="590">Guadeloupe (+590)</option> <option data-countryCode="GU" value="671">Guam (+671)</option> <option data-countryCode="GT" value="502">Guatemala (+502)</option> <option data-countryCode="GN" value="224">Guinea (+224)</option> <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option> <option data-countryCode="GY" value="592">Guyana (+592)</option> <option data-countryCode="HT" value="509">Haiti (+509)</option> <option data-countryCode="HN" value="504">Honduras (+504)</option> <option data-countryCode="HK" value="852">Hong Kong (+852)</option> <option data-countryCode="HU" value="36">Hungary (+36)</option> <option data-countryCode="IS" value="354">Iceland (+354)</option> <option data-countryCode="IN" value="91">India (+91)</option> <option data-countryCode="ID" value="62">Indonesia (+62)</option> <option data-countryCode="IQ" value="964">Iraq (+964)</option> <option data-countryCode="IR" value="98">Iran (+98)</option> <option data-countryCode="IE" value="353">Ireland (+353)</option> <option data-countryCode="IL" value="972">Israel (+972)</option> <option data-countryCode="IT" value="39">Italy (+39)</option> <option data-countryCode="JM" value="1876">Jamaica (+1876)</option> <option data-countryCode="JP" value="81">Japan (+81)</option> <option data-countryCode="JO" value="962">Jordan (+962)</option> <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option> <option data-countryCode="KE" value="254">Kenya (+254)</option> <option data-countryCode="KI" value="686">Kiribati (+686)</option> <option data-countryCode="KP" value="850">Korea - North (+850)</option> <option data-countryCode="KR" value="82">Korea - South (+82)</option> <option data-countryCode="KW" value="965">Kuwait (+965)</option> <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option> <option data-countryCode="LA" value="856">Laos (+856)</option> <option data-countryCode="LV" value="371">Latvia (+371)</option> <option data-countryCode="LB" value="961">Lebanon (+961)</option> <option data-countryCode="LS" value="266">Lesotho (+266)</option> <option data-countryCode="LR" value="231">Liberia (+231)</option> <option data-countryCode="LY" value="218">Libya (+218)</option> <option data-countryCode="LI" value="417">Liechtenstein (+417)</option> <option data-countryCode="LT" value="370">Lithuania (+370)</option> <option data-countryCode="LU" value="352">Luxembourg (+352)</option> <option data-countryCode="MO" value="853">Macao (+853)</option> <option data-countryCode="MK" value="389">Macedonia (+389)</option> <option data-countryCode="MG" value="261">Madagascar (+261)</option> <option data-countryCode="MW" value="265">Malawi (+265)</option> <option data-countryCode="MY" value="60">Malaysia (+60)</option> <option data-countryCode="MV" value="960">Maldives (+960)</option> <option data-countryCode="ML" value="223">Mali (+223)</option> <option data-countryCode="MT" value="356">Malta (+356)</option> <option data-countryCode="MH" value="692">Marshall Islands (+692)</option> <option data-countryCode="MQ" value="596">Martinique (+596)</option> <option data-countryCode="MR" value="222">Mauritania (+222)</option> <option data-countryCode="YT" value="269">Mayotte (+269)</option> <option data-countryCode="MX" value="52">Mexico (+52)</option> <option data-countryCode="FM" value="691">Micronesia (+691)</option> <option data-countryCode="MD" value="373">Moldova (+373)</option> <option data-countryCode="MC" value="377">Monaco (+377)</option> <option data-countryCode="MN" value="976">Mongolia (+976)</option> <option data-countryCode="MS" value="1664">Montserrat (+1664)</option> <option data-countryCode="MA" value="212">Morocco (+212)</option> <option data-countryCode="MZ" value="258">Mozambique (+258)</option> <option data-countryCode="MN" value="95">Myanmar (+95)</option> <option data-countryCode="NA" value="264">Namibia (+264)</option> <option data-countryCode="NR" value="674">Nauru (+674)</option> <option data-countryCode="NP" value="977">Nepal (+977)</option> <option data-countryCode="NL" value="31">Netherlands (+31)</option> <option data-countryCode="NC" value="687">New Caledonia (+687)</option> <option data-countryCode="NZ" value="64">New Zealand (+64)</option> <option data-countryCode="NI" value="505">Nicaragua (+505)</option> <option data-countryCode="NE" value="227">Niger (+227)</option> <option data-countryCode="NG" value="234">Nigeria (+234)</option> <option data-countryCode="NU" value="683">Niue (+683)</option> <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option> <option data-countryCode="NP" value="670">Northern Marianas (+670)</option> <option data-countryCode="NO" value="47">Norway (+47)</option> <option data-countryCode="OM" value="968">Oman (+968)</option> <option data-countryCode="PK" value="92" selected>Pakistan (+92)</option> <option data-countryCode="PW" value="680">Palau (+680)</option> <option data-countryCode="PA" value="507">Panama (+507)</option> <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option> <option data-countryCode="PY" value="595">Paraguay (+595)</option> <option data-countryCode="PE" value="51">Peru (+51)</option> <option data-countryCode="PH" value="63">Philippines (+63)</option> <option data-countryCode="PL" value="48">Poland (+48)</option> <option data-countryCode="PT" value="351">Portugal (+351)</option> <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option> <option data-countryCode="QA" value="974">Qatar (+974)</option> <option data-countryCode="RE" value="262">Reunion (+262)</option> <option data-countryCode="RO" value="40">Romania (+40)</option> <option data-countryCode="RU" value="7">Russia (+7)</option> <option data-countryCode="RW" value="250">Rwanda (+250)</option> <option data-countryCode="SM" value="378">San Marino (+378)</option> <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option> <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option> <option data-countryCode="SN" value="221">Senegal (+221)</option> <option data-countryCode="CS" value="381">Serbia (+381)</option> <option data-countryCode="SC" value="248">Seychelles (+248)</option> <option data-countryCode="SL" value="232">Sierra Leone (+232)</option> <option data-countryCode="SG" value="65">Singapore (+65)</option> <option data-countryCode="SK" value="421">Slovak Republic (+421)</option> <option data-countryCode="SI" value="386">Slovenia (+386)</option> <option data-countryCode="SB" value="677">Solomon Islands (+677)</option> <option data-countryCode="SO" value="252">Somalia (+252)</option> <option data-countryCode="ZA" value="27">South Africa (+27)</option> <option data-countryCode="ES" value="34">Spain (+34)</option> <option data-countryCode="LK" value="94">Sri Lanka (+94)</option> <option data-countryCode="SH" value="290">St. Helena (+290)</option> <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option> <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option> <option data-countryCode="SR" value="597">Suriname (+597)</option> <option data-countryCode="SD" value="249">Sudan (+249)</option> <option data-countryCode="SZ" value="268">Swaziland (+268)</option> <option data-countryCode="SE" value="46">Sweden (+46)</option> <option data-countryCode="CH" value="41">Switzerland (+41)</option> <option data-countryCode="SY" value="963">Syria (+963)</option> <option data-countryCode="TW" value="886">Taiwan (+886)</option> <option data-countryCode="TJ" value="992">Tajikistan (+992)</option> <option data-countryCode="TH" value="66">Thailand (+66)</option> <option data-countryCode="TG" value="228">Togo (+228)</option> <option data-countryCode="TO" value="676">Tonga (+676)</option> <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option> <option data-countryCode="TN" value="216">Tunisia (+216)</option> <option data-countryCode="TR" value="90">Turkey (+90)</option> <option data-countryCode="TM" value="993">Turkmenistan (+993)</option> <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option> <option data-countryCode="TV" value="688">Tuvalu (+688)</option> <option data-countryCode="UG" value="256">Uganda (+256)</option> <option data-countryCode="UA" value="380">Ukraine (+380)</option> <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option> <option data-countryCode="UY" value="598">Uruguay (+598)</option> <option data-countryCode="UZ" value="998">Uzbekistan (+998)</option> <option data-countryCode="VU" value="678">Vanuatu (+678)</option> <option data-countryCode="VA" value="379">Vatican City (+379)</option> <option data-countryCode="VE" value="58">Venezuela (+58)</option> <option data-countryCode="VN" value="84">Vietnam (+84)</option> <option data-countryCode="VG" value="1">Virgin Islands - British (+1)</option> <option data-countryCode="VI" value="1">Virgin Islands - US (+1)</option> <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option> <option data-countryCode="YE" value="969">Yemen (North)(+969)</option> <option data-countryCode="YE" value="967">Yemen (South)(+967)</option> <option data-countryCode="ZM" value="260">Zambia (+260)</option> <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option></select><input type="text" class="col-md-10 m-no m-no_'+j+'" placeholder="Mobile" style="padding-left:150px;" /> <a href="#" class="remove_field2">X</a></div>');
						$('.countryCodeNumberMother_'+j).val(code_number[j][0]);
						$('.m-no_'+j).val(code_number[j][1]);
      					$('.m-no').mask('9999999999');
					}
				}

				//STUDENT MOBILE OTHER
				if(student_mobile){
					var code_number =  getMobileOther(student_mobile);

					for(var i = 0 ; i < code_number.length ;i++){
						$('.input_fields_wrap_student_div').append('<div class="input_fields_wrap_student"><select class="countryCodeNumberStuent countryCodeNumberStuent_'+i+'" name="studentMobile[]"> <option disabled="disabled">Other Countries</option> <option data-countryCode="US" value="1" selected>USA (+1)</option> <option data-countryCode="GB" value="44">UK (+44)</option> <option data-countryCode="DZ" value="213">Algeria (+213)</option> <option data-countryCode="AD" value="376">Andorra (+376)</option> <option data-countryCode="AO" value="244">Angola (+244)</option> <option data-countryCode="AI" value="1264">Anguilla (+1264)</option> <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option> <option data-countryCode="AR" value="54">Argentina (+54)</option> <option data-countryCode="AM" value="374">Armenia (+374)</option> <option data-countryCode="AW" value="297">Aruba (+297)</option> <option data-countryCode="AU" value="61">Australia (+61)</option> <option data-countryCode="AT" value="43">Austria (+43)</option> <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option> <option data-countryCode="BS" value="1242">Bahamas (+1242)</option> <option data-countryCode="BH" value="973">Bahrain (+973)</option> <option data-countryCode="BD" value="880">Bangladesh (+880)</option> <option data-countryCode="BB" value="1246">Barbados (+1246)</option> <option data-countryCode="BY" value="375">Belarus (+375)</option> <option data-countryCode="BE" value="32">Belgium (+32)</option> <option data-countryCode="BZ" value="501">Belize (+501)</option> <option data-countryCode="BJ" value="229">Benin (+229)</option> <option data-countryCode="BM" value="1441">Bermuda (+1441)</option> <option data-countryCode="BT" value="975">Bhutan (+975)</option> <option data-countryCode="BO" value="591">Bolivia (+591)</option> <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option> <option data-countryCode="BW" value="267">Botswana (+267)</option> <option data-countryCode="BR" value="55">Brazil (+55)</option> <option data-countryCode="BN" value="673">Brunei (+673)</option> <option data-countryCode="BG" value="359">Bulgaria (+359)</option> <option data-countryCode="BF" value="226">Burkina Faso (+226)</option> <option data-countryCode="BI" value="257">Burundi (+257)</option> <option data-countryCode="KH" value="855">Cambodia (+855)</option> <option data-countryCode="CM" value="237">Cameroon (+237)</option> <option data-countryCode="CA" value="1">Canada (+1)</option> <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option> <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option> <option data-countryCode="CF" value="236">Central African Republic (+236)</option> <option data-countryCode="CL" value="56">Chile (+56)</option> <option data-countryCode="CN" value="86">China (+86)</option> <option data-countryCode="CO" value="57">Colombia (+57)</option> <option data-countryCode="KM" value="269">Comoros (+269)</option> <option data-countryCode="CG" value="242">Congo (+242)</option> <option data-countryCode="CK" value="682">Cook Islands (+682)</option> <option data-countryCode="CR" value="506">Costa Rica (+506)</option> <option data-countryCode="HR" value="385">Croatia (+385)</option> <option data-countryCode="CU" value="53">Cuba (+53)</option> <option data-countryCode="CY" value="90">Cyprus - North (+90)</option> <option data-countryCode="CY" value="357">Cyprus - South (+357)</option> <option data-countryCode="CZ" value="420">Czech Republic (+420)</option> <option data-countryCode="DK" value="45">Denmark (+45)</option> <option data-countryCode="DJ" value="253">Djibouti (+253)</option> <option data-countryCode="DM" value="1809">Dominica (+1809)</option> <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option> <option data-countryCode="EC" value="593">Ecuador (+593)</option> <option data-countryCode="EG" value="20">Egypt (+20)</option> <option data-countryCode="SV" value="503">El Salvador (+503)</option> <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option> <option data-countryCode="ER" value="291">Eritrea (+291)</option> <option data-countryCode="EE" value="372">Estonia (+372)</option> <option data-countryCode="ET" value="251">Ethiopia (+251)</option> <option data-countryCode="FK" value="500">Falkland Islands (+500)</option> <option data-countryCode="FO" value="298">Faroe Islands (+298)</option> <option data-countryCode="FJ" value="679">Fiji (+679)</option> <option data-countryCode="FI" value="358">Finland (+358)</option> <option data-countryCode="FR" value="33">France (+33)</option> <option data-countryCode="GF" value="594">French Guiana (+594)</option> <option data-countryCode="PF" value="689">French Polynesia (+689)</option> <option data-countryCode="GA" value="241">Gabon (+241)</option> <option data-countryCode="GM" value="220">Gambia (+220)</option> <option data-countryCode="GE" value="7880">Georgia (+7880)</option> <option data-countryCode="DE" value="49">Germany (+49)</option> <option data-countryCode="GH" value="233">Ghana (+233)</option> <option data-countryCode="GI" value="350">Gibraltar (+350)</option> <option data-countryCode="GR" value="30">Greece (+30)</option> <option data-countryCode="GL" value="299">Greenland (+299)</option> <option data-countryCode="GD" value="1473">Grenada (+1473)</option> <option data-countryCode="GP" value="590">Guadeloupe (+590)</option> <option data-countryCode="GU" value="671">Guam (+671)</option> <option data-countryCode="GT" value="502">Guatemala (+502)</option> <option data-countryCode="GN" value="224">Guinea (+224)</option> <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option> <option data-countryCode="GY" value="592">Guyana (+592)</option> <option data-countryCode="HT" value="509">Haiti (+509)</option> <option data-countryCode="HN" value="504">Honduras (+504)</option> <option data-countryCode="HK" value="852">Hong Kong (+852)</option> <option data-countryCode="HU" value="36">Hungary (+36)</option> <option data-countryCode="IS" value="354">Iceland (+354)</option> <option data-countryCode="IN" value="91">India (+91)</option> <option data-countryCode="ID" value="62">Indonesia (+62)</option> <option data-countryCode="IQ" value="964">Iraq (+964)</option> <option data-countryCode="IR" value="98">Iran (+98)</option> <option data-countryCode="IE" value="353">Ireland (+353)</option> <option data-countryCode="IL" value="972">Israel (+972)</option> <option data-countryCode="IT" value="39">Italy (+39)</option> <option data-countryCode="JM" value="1876">Jamaica (+1876)</option> <option data-countryCode="JP" value="81">Japan (+81)</option> <option data-countryCode="JO" value="962">Jordan (+962)</option> <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option> <option data-countryCode="KE" value="254">Kenya (+254)</option> <option data-countryCode="KI" value="686">Kiribati (+686)</option> <option data-countryCode="KP" value="850">Korea - North (+850)</option> <option data-countryCode="KR" value="82">Korea - South (+82)</option> <option data-countryCode="KW" value="965">Kuwait (+965)</option> <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option> <option data-countryCode="LA" value="856">Laos (+856)</option> <option data-countryCode="LV" value="371">Latvia (+371)</option> <option data-countryCode="LB" value="961">Lebanon (+961)</option> <option data-countryCode="LS" value="266">Lesotho (+266)</option> <option data-countryCode="LR" value="231">Liberia (+231)</option> <option data-countryCode="LY" value="218">Libya (+218)</option> <option data-countryCode="LI" value="417">Liechtenstein (+417)</option> <option data-countryCode="LT" value="370">Lithuania (+370)</option> <option data-countryCode="LU" value="352">Luxembourg (+352)</option> <option data-countryCode="MO" value="853">Macao (+853)</option> <option data-countryCode="MK" value="389">Macedonia (+389)</option> <option data-countryCode="MG" value="261">Madagascar (+261)</option> <option data-countryCode="MW" value="265">Malawi (+265)</option> <option data-countryCode="MY" value="60">Malaysia (+60)</option> <option data-countryCode="MV" value="960">Maldives (+960)</option> <option data-countryCode="ML" value="223">Mali (+223)</option> <option data-countryCode="MT" value="356">Malta (+356)</option> <option data-countryCode="MH" value="692">Marshall Islands (+692)</option> <option data-countryCode="MQ" value="596">Martinique (+596)</option> <option data-countryCode="MR" value="222">Mauritania (+222)</option> <option data-countryCode="YT" value="269">Mayotte (+269)</option> <option data-countryCode="MX" value="52">Mexico (+52)</option> <option data-countryCode="FM" value="691">Micronesia (+691)</option> <option data-countryCode="MD" value="373">Moldova (+373)</option> <option data-countryCode="MC" value="377">Monaco (+377)</option> <option data-countryCode="MN" value="976">Mongolia (+976)</option> <option data-countryCode="MS" value="1664">Montserrat (+1664)</option> <option data-countryCode="MA" value="212">Morocco (+212)</option> <option data-countryCode="MZ" value="258">Mozambique (+258)</option> <option data-countryCode="MN" value="95">Myanmar (+95)</option> <option data-countryCode="NA" value="264">Namibia (+264)</option> <option data-countryCode="NR" value="674">Nauru (+674)</option> <option data-countryCode="NP" value="977">Nepal (+977)</option> <option data-countryCode="NL" value="31">Netherlands (+31)</option> <option data-countryCode="NC" value="687">New Caledonia (+687)</option> <option data-countryCode="NZ" value="64">New Zealand (+64)</option> <option data-countryCode="NI" value="505">Nicaragua (+505)</option> <option data-countryCode="NE" value="227">Niger (+227)</option> <option data-countryCode="NG" value="234">Nigeria (+234)</option> <option data-countryCode="NU" value="683">Niue (+683)</option> <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option> <option data-countryCode="NP" value="670">Northern Marianas (+670)</option> <option data-countryCode="NO" value="47">Norway (+47)</option> <option data-countryCode="OM" value="968">Oman (+968)</option> <option data-countryCode="PK" value="92" selected>Pakistan (+92)</option> <option data-countryCode="PW" value="680">Palau (+680)</option> <option data-countryCode="PA" value="507">Panama (+507)</option> <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option> <option data-countryCode="PY" value="595">Paraguay (+595)</option> <option data-countryCode="PE" value="51">Peru (+51)</option> <option data-countryCode="PH" value="63">Philippines (+63)</option> <option data-countryCode="PL" value="48">Poland (+48)</option> <option data-countryCode="PT" value="351">Portugal (+351)</option> <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option> <option data-countryCode="QA" value="974">Qatar (+974)</option> <option data-countryCode="RE" value="262">Reunion (+262)</option> <option data-countryCode="RO" value="40">Romania (+40)</option> <option data-countryCode="RU" value="7">Russia (+7)</option> <option data-countryCode="RW" value="250">Rwanda (+250)</option> <option data-countryCode="SM" value="378">San Marino (+378)</option> <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option> <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option> <option data-countryCode="SN" value="221">Senegal (+221)</option> <option data-countryCode="CS" value="381">Serbia (+381)</option> <option data-countryCode="SC" value="248">Seychelles (+248)</option> <option data-countryCode="SL" value="232">Sierra Leone (+232)</option> <option data-countryCode="SG" value="65">Singapore (+65)</option> <option data-countryCode="SK" value="421">Slovak Republic (+421)</option> <option data-countryCode="SI" value="386">Slovenia (+386)</option> <option data-countryCode="SB" value="677">Solomon Islands (+677)</option> <option data-countryCode="SO" value="252">Somalia (+252)</option> <option data-countryCode="ZA" value="27">South Africa (+27)</option> <option data-countryCode="ES" value="34">Spain (+34)</option> <option data-countryCode="LK" value="94">Sri Lanka (+94)</option> <option data-countryCode="SH" value="290">St. Helena (+290)</option> <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option> <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option> <option data-countryCode="SR" value="597">Suriname (+597)</option> <option data-countryCode="SD" value="249">Sudan (+249)</option> <option data-countryCode="SZ" value="268">Swaziland (+268)</option> <option data-countryCode="SE" value="46">Sweden (+46)</option> <option data-countryCode="CH" value="41">Switzerland (+41)</option> <option data-countryCode="SY" value="963">Syria (+963)</option> <option data-countryCode="TW" value="886">Taiwan (+886)</option> <option data-countryCode="TJ" value="992">Tajikistan (+992)</option> <option data-countryCode="TH" value="66">Thailand (+66)</option> <option data-countryCode="TG" value="228">Togo (+228)</option> <option data-countryCode="TO" value="676">Tonga (+676)</option> <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option> <option data-countryCode="TN" value="216">Tunisia (+216)</option> <option data-countryCode="TR" value="90">Turkey (+90)</option> <option data-countryCode="TM" value="993">Turkmenistan (+993)</option> <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option> <option data-countryCode="TV" value="688">Tuvalu (+688)</option> <option data-countryCode="UG" value="256">Uganda (+256)</option> <option data-countryCode="UA" value="380">Ukraine (+380)</option> <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option> <option data-countryCode="UY" value="598">Uruguay (+598)</option> <option data-countryCode="UZ" value="998">Uzbekistan (+998)</option> <option data-countryCode="VU" value="678">Vanuatu (+678)</option> <option data-countryCode="VA" value="379">Vatican City (+379)</option> <option data-countryCode="VE" value="58">Venezuela (+58)</option> <option data-countryCode="VN" value="84">Vietnam (+84)</option> <option data-countryCode="VG" value="1">Virgin Islands - British (+1)</option> <option data-countryCode="VI" value="1">Virgin Islands - US (+1)</option> <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option> <option data-countryCode="YE" value="969">Yemen (North)(+969)</option> <option data-countryCode="YE" value="967">Yemen (South)(+967)</option> <option data-countryCode="ZM" value="260">Zambia (+260)</option> <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option></select><input type="text" class="col-md-10 s-no s-no_'+i+'" placeholder="Mobile" style="padding-left:150px;"  /> <a href="#" class="add_field_button_student">+</a></div>');
							$('.countryCodeNumberStuent_'+i).val(code_number[i][0]);
							$('.s-no_'+i).val(code_number[i][1]);
					}
				}

			}
		}
	});

	$(document).on("click",".add_field_button",function(e){ //on add input button click
          e.preventDefault();
          var max_fields   = 10;
          var wrapper  = $(".input_fields_wrap"); 
          var x = 1; //initlal text box count
          if(x < max_fields){ //max input box allowed
              x++; //text box increment
              $(wrapper).append('<div class="input_fields_wrap_additional_student"><select class="countryCodeNumberStudent"><option data-countryCode="US" value="1" selected>USA (+1)</option><option data-countryCode="GB" value="44">UK (+44)</option></select><input type="text" class="col-md-10 s-no" placeholder="Mobile" id=""  style="padding-left:150px;" /> <a href="#" class="remove_field">X</a></div>'); //add input box
        }
    });
}

	function  getMobileOther(mobile_other){
		var arr = [];
		var number_split = [];
		var code = [];
		var number = [];
		arr = mobile_other.split(',');

		for(var i = 0 ; i < arr.length ; i++){
			number_split[i] = arr[i].split('-');
		}

		return number_split;

	}

 var updateForm = function(){
 	var admission_form_id = $('#admission_form_id').val();
 	$('#issuanceFormListing tr').removeClass('data-replace');
	var table =  $('.data_admission').filter('[data-id="'+$('#admission_form_id').val()+'"]').closest('tr').addClass('data-replace');
	var official_name = $('#official_name').val();
	var call_name = $('#call_name').val();
	var dateOfBirth = $('#dateOfBirth').val();
	var gender = $('#gender').val();
	var father_name = $('#father_name').val();
	var mother_name = $('#mother_name').val();
	var father_nic = $('#father_nic').val();
	var mother_nic = $('#mother_nic').val();
	var father_email = $('#father_email').val();
	var mother_email = $('#mother_email').val();
	var student_nic = $('#student_nic').val();
	var student_email = $('#student_email').val();
	var gf_id = $('#gf_id').val();
	var grade_id = $('#grade').val();
	var grade_name = $('#grade :selected').text();

	var request_grade =  $('#request_grade').is(":checked");
	request_grade = request_grade == true ? 1 : 0 ;
	var request_for_grade = $('#requestGrade').val();



	localStorage.setItem('father_number', $('#father_number').val());


	// Father Number and Father Code
	var father_number_code = document.getElementsByClassName("countryCodeNumberFather");
	var f_no = $('.f-no').map(function(){
	  			return $(this).val()
	}).get();

	var father_code = [];
	for(var i = 0 ; i < father_number_code.length ; i++){
		father_code[i] = father_number_code[i].value;
	}

	// Mother Number and Mother Code

	var mother_number_code = document.getElementsByClassName("countryCodeNumberMother");
	var m_no = $('.m-no').map(function(){
	  	return $(this).val()
	}).get();
	var mother_code = [];
	for(var i = 0 ; i < mother_number_code.length ; i++){
		mother_code[i] = mother_number_code[i].value;
	}



	// Student Number and Student Code 

	var student_number_code = document.getElementsByClassName("countryCodeNumberStuent");

	var s_no = $('.s-no').map(function(){
	  	return $(this).val()
	}).get();
	var student_code = [];
	for(var i = 0 ; i < student_number_code.length ; i++){
		student_code[i] = student_number_code[i].value;
	}


	    // validate the form when it is submitted
    var form = $( "#editForm" );
	form.validate({
    	rules: {
        	official_name:{
            	required: true,
        	},
        	call_name:{
        		required: true,
        		maxlength: 9,
        	}

    	}
	});
	if(form.valid() == true){
		$.ajax({
			type:"POST",
			cache:false,
			data:{
				admission_form_id:admission_form_id,
				student_nic:student_nic,
				student_email:student_email,
				official_name:official_name,
				call_name:call_name,
				dateOfBirth:dateOfBirth,
				gender:gender,
				father_name:father_name,
				mother_name:mother_name,
				father_nic:father_nic,
				mother_nic:mother_nic,
				father_email:father_email,
				mother_email:mother_email,
				father_code:father_code,
				f_no:f_no,
				mother_code:mother_code,
				m_no:m_no,
				student_code:student_code,
				s_no:s_no,
				gf_id:gf_id,
				grade_id:grade_id,
				grade_name:grade_name,
				request_grade:request_grade,
				request_for_grade:request_for_grade
			},
			url:"<?php echo site_url() ?>/gs_admission/admission_form_editable/editApplicationDetail",
			success:function(e){
				tableUpdation();
				$('#myModal').modal('hide');
			}
		});
	}

	function tableUpdation(){
		var table = document.getElementById("issuanceFormListing");
		var row = table.rows;
		var father_number = localStorage.getItem("father_number");
		father_number = "0"+father_number;
		father_number =  father_number.slice(0, 4) + "-" + father_number.slice(4);


		$.each( row, function( key, value ) {
  			
  			if( $(this).hasClass("data-replace") )
  			{

  				 $(this).closest('tr').find('#official_name_display').text(official_name);

  				$(this).closest('tr').find('#father_detail_display').text(father_name+" - "+father_number);

               

  			}
  			
		});


	}
}

// Father NIC

$(document).ready(function(){
	//Father NIC
	if ($('#father_nic').length) {
	  $('#father_nic').mask('99999-9999999-9', {
	        placeholder: 'X'
	   });
	}
	// Mother NIC
	if ($('#mother_nic').length) {
	  $('#mother_nic').mask('99999-9999999-9', {
	        placeholder: 'X'
	   });
	}

	// Student NIC
	if ($('#student_nic').length) {
	  $('#student_nic').mask('99999-9999999-9', {
	        placeholder: 'X'
	   });
	}

	 $('#issuanceFormListing').DataTable();
});


var ViewLog = function(admission_form_id){

	var form_id = admission_form_id;
	var type = 'internalMishandle' ;
	var currentStage = 'Offer';

	var fllwUpLists = $("#followup_lists");
	fllwUpLists.switchClass( "col-md-12", "col-md-7", 1000, "easeInOutQuad" );
	var fllwUpComments = $("#followupComments");
	fllwUpComments.slideDown("slow");

	$.ajax({
		type: "POST",
		url : "<?=base_url();?>index.php/gs_admission/frontoffice_followup/getCommentsType",
		data:{formStage:type,form_id:form_id,currentStage:currentStage},
		dataType: "HTML",
		beforeSend: function(){},
		success: function(res){
			$("#followupComments").html('');
			$("#followupComments").html(res);
			if(type == 'internalMishandle'){
			console.log('at CurrentStageOffer');
		 	$('.statusDisplay').css('display','none');
		 	}else{
		 	$('.statusDisplay').css('display','');
		 	}
		},
		complete:function(){ },
		error:function(){}
	});

}

$(document).on("click", "#hidr", function(){
  //$( "#followupComments" ).hide( 1000 );
   $('#followupComments').slideToggle("slow");
   var fllwUpLists = $("#followup_lists").switchClass( "col-md-7", "col-md-12", 1000, "easeInOutQuad" );
	
});
	
</script>
<!--link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script-->

<!--link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script-->

<link rel="stylesheet" href="<?=base_url();?>components/gs_theme/css/jquery-ui.css">
<script src="<?=base_url();?>components/gs_theme/js/jquery-ui.js"></script>

<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script>


<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/custom.js"></script>

</body>
</html>