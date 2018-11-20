<style>

.TimeLineModal .modal-body {
  padding:10px;
}
.TimeLineModal .modal-footer {
  display:none;
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
.input_fields_wrap_additional {
    margin: 10px 0 0 0px !important;
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
    .paddingTop20 {
    padding-top: 20px !important;
}
.countryCodeNumber {
     position: absolute;
    top: 0;
    z-index: 1;
    width: 55px;
    text-align: center;
    border-bottom: 0;
    left: 0px;
    padding-bottom: 5px;
    font-size: 12px;
    padding-top: 5px;
}
.add_field_button,
.add_field_button_father,
.add_field_button_mother {
    position: absolute;
    right: 0;
    top: 0;
    background: green;
    border: 0;
    font-size: 16px;
    color: #fff;
    padding: 4px 6px;
}
.fatherContactArea,
.motherContactArea {
    float: left;
    width: 100%;
}
.input_fields_wrap,
.input_fields_wrap_father,
.input_fields_wrap_mother {
    position: relative;
}
.input_fields_wrap_additional,
.input_fields_wrap_additional_father,
.input_fields_wrap_additional_mother {
    position: relative;
    margin-bottom: 10px;
    float: left;
    width: 100%;
}
.input_fields_wrap_additional .countryCodeNumber,
.input_fields_wrap_additional_father .countryCodeNumber,
.input_fields_wrap_additional_mother .countryCodeNumber {
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
    font-size: 14px;
    color: #fff;
    padding: 5px 6px; 
}
    </style>
<div class="container" id="IssueAdmissionForm">
    <!-- Two column layout Start -->
  <div class="row">
        <div id="form_data">
            <div class="col-md-12 no-padding" style="width: 335px; text-align: center; position: absolute; top: 40%; left: 40%; background: rgb(241, 239, 239); border: 1px solid rgb(204, 204, 204); padding: 10px; z-index: 99999; display: none;" id="Generations_AjaxLoader">
               <img src="http://10.10.10.50/gs//components/image/gsLoader.gif" width="200"><br><hr style="margin: 7px 0;border-top: 1px solid #ccc;"> Loading. Please Wait...
            </div>
            <div class="col-md-12">
                <h2 class="withBorderBottom">Admission Form Issuance</h2>
            </div><!-- col-md-12 -->
            <div class="col-md-4" style="" id="applicantDetails">
            <?php /* ?>
            <div style="margin-bottom: 0;margin-top: 0;min-height: 0;padding-bottom: 0;padding-top: 10px;display:none1;height:27px;" id="ajaxloader2">
              <img src="<?php echo base_url();?>/components/image/ajax-loader.gif">
              </div>
              <?php */ ?>
            
                <form action="<?=base_url();?>index.php/gs_admission/ajax_base/get_data" method="POST" name="issuance" id="issuance" class="issuance">
                <input type="hidden" name="FormAction" id="FormAction" value="0" />
                
                <input type="hidden" name="Form_ID" id="Form_ID" value="0" />
                <input type="hidden" name="Fmly_Reg_ID" id="Fmly_Reg_ID" value="0" />
                <input type="hidden" name="academic_session" id="academic_session" value="" />
                <input type="hidden" name="old_gs_id" id="old_gs_id" value="" />
                
                <input type="hidden" name="family_exists" id="family_exists" value="5043" />
                <input type="hidden" id="gt_id" name="gt_id"  />
        
                    <div class="MaroonBorderBox">
                        <h3 class="relativeHead"> Applicant Details 
                            <span class="pull-right">
                                <select name="campus" id="campus">
                                  <option value="">Campus *</option>
                                  <option value="1"> North</option>
                                  <option value="2"> South</option>
                                </select>
                            </span>
                        </h3>
                        <div class="inner">
                            <div class="col-md-12">
                                <div class="FatherNICShow">
                                    <div class="col-md-3 text-right FatherNIC"><label class="">Father NIC</label> </div>
                                    <div class="col-md-9"><input type="text" placeholder="XXXXX-XXXXXXX-X" name="f_nic" id="f_nic" />
                                    <span class="ifGFID"><a href="javascript:void(0)" class="GFIDClick">GF-ID</a></span></div>
                                </div><!-- FatherNICShow -->
                                <div class="GFIDShow displayNone">
                                    <div class="col-md-3 text-right FatherNIC"><label class="">GF ID</label> </div>
                                    <div class="col-md-9"><input type="text" placeholder="XX-XXX" name="gf_id" id="gf_id" />
                            <span class="ifGFID"><a href="javascript:void(0)" class="FatherNICClick">Father NIC</a></span></div>
                                </div><!-- GFIDShow -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 text-right" style="padding-right: 30px;padding-top: 10px;">
                                <div class="col-md-3">&nbsp;</div>
                                <div class="col-md-9">
                                  <a href="javascript:void(0)" class="show_gt_id" style="display:none; text-align: left; float: left;"></a>
                                  <a href="javascript:void(0)" class="show_fif" style="display:none; text-align: right;">Show FIF</a>
                                </div>
                                  <!--a href="#" data-toggle="modal" data-target="#myModal" id="show_fif">Show FIF</a -->
                            </div>

                            <hr style="margin-top: 5px;" />
                            <div class="col-md-12 paddingBottom0">
                                <?php /* ?>
                                <div class="col-md-6" style="margin-top:-18px;">
                                  <input id="c3" name="late_issuance" style="display:block; visibility:hidden;" type="checkbox"> 
                                  <label for="c3">Late Issuance</label>
                                </div><!-- col-md-6 -->
                                <?php */ ?>
                                <div class="col-md-6" style="margin-top:-25px;">
                                  <input id="alevel_student_check" name="alevel_student_check" style="display:block; visibility:hidden;" type="checkbox"> 
                                  <label id="alevel_student_check_label" for="alevel_student_check">Alevel</label>
                                </div><!-- col-md-6 -->         
                            </div><!-- col-md-12 -->
                            <hr style="margin-top: 7px;" />
                            <div class="col-md-12 paddingBottom10">
                                <div class="col-md-6">
                                    <input type="text" class="" placeholder="Token No. *" name="token_no" id="token_no" />
                                </div><!-- col-md-6 -->
                                <div class="col-md-6">
                                    <select name="gender" id="gender">
                                      <option value="" disabled selected>Gender *</option>
                                      <option value="B">Boy</option>
                                      <option value="G">Girl</option>
                                    </select>
                                </div><!-- col-md-6 --> 
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingBottom10">
                                <div class="col-md-6">
                                    <input type="text" class="" placeholder="Official Name *" name="official_name" id="official_name" />
                                </div><!-- col-md-6 -->
                                <div class="col-md-6">
                                    <input type="text" placeholder="Call Name *" name="call_name" id="call_name" />
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingBottom10">
                                <div class="col-md-6">
                                    <!--input placeholder="Date of Birth *"  class="textbox-n" type="text" onfocus="(this.type='date')"  id="date_of_birth" onblur="(this.type='text')" name="date_of_birth" / -->
                                    <input placeholder="Date of Birth *"  type="date"  id="date_of_birth" name="date_of_birth" class="date_of_birth" />


                                </div><!-- col-md-6 -->
                                <div class="col-md-6">
                                    <input type="text" placeholder="Admission Grade *" name="admission_grade" id="admission_grade"  />
                                    <select  id="alevel_grade_selectBox" style="display: none;">
                                        <option value="" disabled="" selected="">Grade *</option>
                                        <option value="15" selected="">A1</option>
                                        <option value="16">A2</option>
                                    </select>                          
                                    <input type="hidden" name="admission_grade_id" id="admission_grade_id" value="" />
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingBottom10">
                                <div class="col-md-6">
                                    <!--input placeholder="Date of Birth *"  class="textbox-n" type="text" onfocus="(this.type='date')"  id="date_of_birth" onblur="(this.type='text')" name="date_of_birth" / 
                                    <input placeholder="Mobile *"  type="text"  id="" name="" class="" />-->
                                    <div class="input_fields_wrap">
                                        <!-- <label>Mobile</label> -->
                                        <select class="countryCodeNumber" name="student_mobile_code[]" >
                                          <!-- Countries often selected by users can be moved to the top of the list. -->
                                          <!-- Countries known to be subject to general US embargo are commented out by default. -->
                                          <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->
                                        
                                          <option data-countryCode="US" value="1" >+1</option>
                                          <option data-countryCode="GB" value="44">+44</option>
                                          <option data-countryCode="DZ" value="213">+213</option>
                                          <option data-countryCode="AD" value="376">+376</option>
                                          <option data-countryCode="AO" value="244">+244</option>
                                          <option data-countryCode="AI" value="1264">+1264</option>
                                          <option data-countryCode="AG" value="1268">+1268</option>
                                          <option data-countryCode="AR" value="54">+54</option>
                                          <option data-countryCode="AM" value="374">+374</option>
                                          <option data-countryCode="AW" value="297">+297</option>
                                          <option data-countryCode="AU" value="61">+61</option>
                                          <option data-countryCode="AT" value="43">+43</option>
                                          <option data-countryCode="AZ" value="994">+994</option>
                                          <option data-countryCode="BS" value="1242">+1242</option>
                                          <option data-countryCode="BH" value="973">+973</option>
                                          <option data-countryCode="BD" value="880">+880</option>
                                          <option data-countryCode="BB" value="1246">+1246</option>
                                          <option data-countryCode="BY" value="375">+375</option>
                                          <option data-countryCode="BE" value="32">+32</option>
                                          <option data-countryCode="BZ" value="501">+501</option>
                                          <option data-countryCode="BJ" value="229">+229</option>
                                          <option data-countryCode="BM" value="1441">+1441</option>
                                          <option data-countryCode="BT" value="975">+975</option>
                                          <option data-countryCode="BO" value="591">+591</option>
                                          <option data-countryCode="BA" value="387">+387</option>
                                          <option data-countryCode="BW" value="267">+267</option>
                                          <option data-countryCode="BR" value="55">+55</option>
                                          <option data-countryCode="BN" value="673">+673</option>
                                          <option data-countryCode="BG" value="359">+359</option>
                                          <option data-countryCode="BF" value="226">+226</option>
                                          <option data-countryCode="BI" value="257">+257</option>
                                          <option data-countryCode="KH" value="855">+855</option>
                                          <option data-countryCode="CM" value="237">+237</option>
                                          <option data-countryCode="CV" value="238">+238</option>
            
                                          <option data-countryCode="KY" value="1345">+1345</option>
                                          <option data-countryCode="CF" value="236">+236</option>
                                          <option data-countryCode="CL" value="56">+56</option>
                                          <option data-countryCode="CN" value="86">+86</option>
                                          <option data-countryCode="CO" value="57">+57</option>
                                          <option data-countryCode="KM" value="269">+269</option>
                                          <option data-countryCode="CG" value="242">+242</option>
                                          <option data-countryCode="CK" value="682">+682</option>
                                          <option data-countryCode="CR" value="506">+506</option>
                                          <option data-countryCode="HR" value="385">+385</option>
                                          <!-- <option data-countryCode="CU" value="53">Cuba +53</option> -->
                                          <option data-countryCode="CY" value="90">+90</option>
                                          <option data-countryCode="CY" value="357">+357</option>
                                          <option data-countryCode="CZ" value="420">+420</option>
                                          <option data-countryCode="DK" value="45">+45</option>
                                          <option data-countryCode="DJ" value="253">+253</option>
                                          <option data-countryCode="DM" value="1809">+1809</option>
                                          <option data-countryCode="DO" value="1809">+1809</option>
                                          <option data-countryCode="EC" value="593">+593</option>
                                          <option data-countryCode="EG" value="20">+20</option>
                                          <option data-countryCode="SV" value="503">+503</option>
                                          <option data-countryCode="GQ" value="240">+240</option>
                                          <option data-countryCode="ER" value="291">+291</option>
                                          <option data-countryCode="EE" value="372">+372</option>
                                          <option data-countryCode="ET" value="251">+251</option>
                                          <option data-countryCode="FK" value="500">+500</option>
                                          <option data-countryCode="FO" value="298">+298</option>
                                          <option data-countryCode="FJ" value="679">+679</option>
                                          <option data-countryCode="FI" value="358">+358</option>
                                          <option data-countryCode="FR" value="33">+33</option>
                                          <option data-countryCode="GF" value="594">+594</option>
                                          <option data-countryCode="PF" value="689">+689</option>
                                          <option data-countryCode="GA" value="241">+241</option>
                                          <option data-countryCode="GM" value="220">+220</option>
                                          <option data-countryCode="GE" value="7880">+7880</option>
                                          <option data-countryCode="DE" value="49">+49</option>
                                          <option data-countryCode="GH" value="233">+233</option>
                                          <option data-countryCode="GI" value="350">+350</option>
                                          <option data-countryCode="GR" value="30">+30</option>
                                          <option data-countryCode="GL" value="299">+299</option>
                                          <option data-countryCode="GD" value="1473">+1473</option>
                                          <option data-countryCode="GP" value="590">+590</option>
                                          <option data-countryCode="GU" value="671">+671</option>
                                          <option data-countryCode="GT" value="502">+502</option>
                                          <option data-countryCode="GN" value="224">+224</option>
                                          <option data-countryCode="GW" value="245">+245</option>
                                          <option data-countryCode="GY" value="592">+592</option>
                                          <option data-countryCode="HT" value="509">+509</option>
                                          <option data-countryCode="HN" value="504">+504</option>
                                          <option data-countryCode="HK" value="852">+852</option>
                                          <option data-countryCode="HU" value="36">+36</option>
                                          <option data-countryCode="IS" value="354">+354</option>
                                          <option data-countryCode="IN" value="91">+91</option>
                                          <option data-countryCode="ID" value="62">+62</option>
                                          <option data-countryCode="IQ" value="964">+964</option>
                                          <!-- <option data-countryCode="IR" value="98">Iran +98</option> -->
                                          <option data-countryCode="IE" value="353">+353</option>
                                          <option data-countryCode="IL" value="972">+972</option>
                                          <option data-countryCode="IT" value="39">+39</option>
                                          <option data-countryCode="JM" value="1876">+1876</option>
                                          <option data-countryCode="JP" value="81">+81</option>
                                          <option data-countryCode="JO" value="962">+962</option>
                                          <option data-countryCode="KZ" value="7">+7</option>
                                          <option data-countryCode="KE" value="254">+254</option>
                                          <option data-countryCode="KI" value="686">+686</option>
                                          <option data-countryCode="KR" value="82">+82</option>
                                          <option data-countryCode="KW" value="965">+965</option>
                                          <option data-countryCode="KG" value="996">+996</option>
                                          <option data-countryCode="LA" value="856">+856</option>
                                          <option data-countryCode="LV" value="371">+371</option>
                                          <option data-countryCode="LB" value="961">+961</option>
                                          <option data-countryCode="LS" value="266">+266</option>
                                          <option data-countryCode="LR" value="231">+231</option>
                                          <option data-countryCode="LY" value="218">+218</option>
                                          <option data-countryCode="LI" value="417">+417</option>
                                          <option data-countryCode="LT" value="370">+370</option>
                                          <option data-countryCode="LU" value="352">+352</option>
                                          <option data-countryCode="MO" value="853">+853</option>
                                          <option data-countryCode="MK" value="389">+389</option>
                                          <option data-countryCode="MG" value="261">+261</option>
                                          <option data-countryCode="MW" value="265">+265</option>
                                          <option data-countryCode="MY" value="60">+60</option>
                                          <option data-countryCode="MV" value="960">+960</option>
                                          <option data-countryCode="ML" value="223">+223</option>
                                          <option data-countryCode="MT" value="356">+356</option>
                                          <option data-countryCode="MH" value="692">+692</option>
                                          <option data-countryCode="MQ" value="596">+596</option>
                                          <option data-countryCode="MR" value="222">+222</option>
                                          <option data-countryCode="YT" value="269">+269</option>
                                          <option data-countryCode="MX" value="52">+52</option>
                                          <option data-countryCode="FM" value="691">+691</option>
                                          <option data-countryCode="MD" value="373">+373</option>
                                          <option data-countryCode="MC" value="377">+377</option>
                                          <option data-countryCode="MN" value="976">+976</option>
                                          <option data-countryCode="MS" value="1664">+1664</option>
                                          <option data-countryCode="MA" value="212">+212</option>
                                          <option data-countryCode="MZ" value="258">+258</option>
                                          <option data-countryCode="MN" value="95">+95</option>
                                          <option data-countryCode="NA" value="264">+264</option>
                                          <option data-countryCode="NR" value="674">+674</option>
                                          <option data-countryCode="NP" value="977">+977</option>
                                          <option data-countryCode="NL" value="31">+31</option>
                                          <option data-countryCode="NC" value="687">+687</option>
                                          <option data-countryCode="NZ" value="64">+64</option>
                                          <option data-countryCode="NI" value="505">+505</option>
                                          <option data-countryCode="NE" value="227">+227</option>
                                          <option data-countryCode="NG" value="234">+234</option>
                                          <option data-countryCode="NU" value="683">+683</option>
                                          <option data-countryCode="NF" value="672">+672</option>
                                          <option data-countryCode="NP" value="670">+670</option>
                                          <option data-countryCode="NO" value="47">+47</option>
                                          <option data-countryCode="OM" value="968">+968</option>
                                          <option selected data-countryCode="PK" value="92">+92</option>
                                          <option data-countryCode="PW" value="680">+680</option>
                                          <option data-countryCode="PA" value="507">+507</option>
                                          <option data-countryCode="PG" value="675">+675</option>
                                          <option data-countryCode="PY" value="595">+595</option>
                                          <option data-countryCode="PE" value="51">+51</option>
                                          <option data-countryCode="PH" value="63">+63</option>
                                          <option data-countryCode="PL" value="48">+48</option>
                                          <option data-countryCode="PT" value="351">+351</option>
                                          <option data-countryCode="PR" value="1787">+1787</option>
                                          <option data-countryCode="QA" value="974">+974</option>
                                          <option data-countryCode="RE" value="262">+262</option>
                                          <option data-countryCode="RO" value="40">+40</option>
                                          <option data-countryCode="RU" value="7">+7</option>
                                          <option data-countryCode="RW" value="250">+250</option>
                                          <option data-countryCode="SM" value="378">+378</option>
                                          <option data-countryCode="ST" value="239">+239</option>
                                          <option data-countryCode="SA" value="966">+966</option>
                                          <option data-countryCode="SN" value="221">+221</option>
                                          <option data-countryCode="CS" value="381">+381</option>
                                          <option data-countryCode="SC" value="248">+248</option>
                                          <option data-countryCode="SL" value="232">+232</option>
                                          <option data-countryCode="SG" value="65">+65</option>
                                          <option data-countryCode="SK" value="421">+421</option>
                                          <option data-countryCode="SI" value="386">+386</option>
                                          <option data-countryCode="SB" value="677">+677</option>
                                          <option data-countryCode="SO" value="252">+252</option>
                                          <option data-countryCode="ZA" value="27">+27</option>
                                          <option data-countryCode="ES" value="34">+34</option>
                                          <option data-countryCode="LK" value="94">+94</option>
                                          <option data-countryCode="SH" value="290">+290</option>
                                          <option data-countryCode="KN" value="1869">+1869</option>
                                          <option data-countryCode="SC" value="1758">+1758</option>
                                          <option data-countryCode="SR" value="597">+597</option>
                                          <option data-countryCode="SD" value="249">+249</option>
                                          <option data-countryCode="SZ" value="268">+268</option>
                                          <option data-countryCode="SE" value="46">+46</option>
                                          <option data-countryCode="CH" value="41">+41</option>
                                          <!-- <option data-countryCode="SY" value="963">Syria +963</option> -->
                                          <option data-countryCode="TW" value="886">+886</option>
                                          <option data-countryCode="TJ" value="992">+992</option>
                                          <option data-countryCode="TH" value="66">+66</option>
                                          <option data-countryCode="TG" value="228">+228</option>
                                          <option data-countryCode="TO" value="676">+676</option>
                                          <option data-countryCode="TT" value="1868">+1868</option>
                                          <option data-countryCode="TN" value="216">+216</option>
                                          <option data-countryCode="TR" value="90">+90</option>
                                          <option data-countryCode="TM" value="993">+993</option>
                                          <option data-countryCode="TC" value="1649">+1649</option>
                                          <option data-countryCode="TV" value="688">+688</option>
                                          <option data-countryCode="UG" value="256">+256</option>
                                          <option data-countryCode="UA" value="380">+380</option>
                                          <option data-countryCode="AE" value="971">+971</option>
                                          <option data-countryCode="UY" value="598">+598</option>
                                          <option data-countryCode="UZ" value="998">+998</option>
                                          <option data-countryCode="VU" value="678">+678</option>
                                          <option data-countryCode="VA" value="379">+379</option>
                                          <option data-countryCode="VE" value="58">+58</option>
                                          <option data-countryCode="VN" value="84">+84</option>
                                          <option data-countryCode="WF" value="681">+681</option>
                                          <option data-countryCode="YE" value="969">+969</option>
                                          <option data-countryCode="YE" value="967">+967</option>
                                          <option data-countryCode="ZM" value="260">+260</option>
                                          <option data-countryCode="ZW" value="263">+263</option>
                                        </select>
                                        <input name="student_mobile_phone[]"  type="number" class="col-md-10" placeholder="Mobile" id="" value="" style="padding-left:60px;" /> 
                                        <button class="add_field_button">+</button>
                                    </div><!-- input_fields_wrap -->
                                 </div><!-- col-md-6 -->
                                <div class="col-md-6">
                                    <input type="text" placeholder="Email" name="student_email" id="student_email"  />
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingBottom0">
                                <div class="col-md-6">
                                    <!--input placeholder="Date of Birth *"  class="textbox-n" type="text" onfocus="(this.type='date')"  id="date_of_birth" onblur="(this.type='text')" name="date_of_birth" / -->
                                        <input placeholder="Student NIC"  type="text"  id="student_nic" name="student_nic" class="date_of_birth" />
                                </div><!-- col-md-6 -->
                                 <div class="col-md-6">                            
                                        <input type="text" class="" placeholder="Referral Code" name="Referal_code" id="Referal_code" maxlength="6" minlength="6"  />
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <hr style="margin-bottom: 0;" />
                            <div class="col-md-12 paddingBottom0">
                                <div class="col-md-6">
                                    <input type="checkbox" id="request_grade" name="request_grade" value="" style="visibility:hidden;display:block;" />
                                    <label for="request_grade"> Request For Grade <span class="required"> </span></label>
                                </div><!-- col-md-6 -->
                                <div class="col-md-6" id="requestedGrade_div" style="display:none">
                                    <select style="margin-top:10px" id="requestGrade" name="requestGrade">
                                        <option value="">Grade</option>
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
                            <hr style="margin-top: 10px;" />
                            <div class="col-md-12 paddingBottom10">
                                <div class="col-md-6" style="margin-top:-18px;">
                                    <input type="checkbox" id="c2" name="single_parent" style="display:block; visibility:hidden;"> <label for="c2">Single Parent</label>
                                </div><!-- col-md-6 -->
                                <div class="col-md-6 text-right">
                                      <!--a href="#" data-toggle="modal" data-target="#myModal" id="show_fif">Show FIF</a -->
                                    <a href="javascript:void(0)" class="show_fif" style="display:none;">Show FIF</a>
                                    <a href="javascript:void(0)" class="show_gt_id" style="display:none;"></a>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <hr style="margin-top:0px;" />
                            <div class="col-md-12 paddingBottom10">
                                <div class="col-md-6">
                                    <input class="paddingBottom10" type="radio" name="primary_contact" value="0" checked id="primary_contact1"> <label for="primary_contact1">Primary Contact Father</label><br /><br />
                                    <input type="text" class="" placeholder="Father Name *" name="father_name" id="father_name" required="" /><br /><br />
                                    <div class="fatherContactArea">
                                    <div class="input_fields_wrap_father" style="margin-bottom: 14px;">
                                        <select required="" class="countryCodeNumber" name="father_mobile_code[]">
                                          <!-- Countries often selected by users can be moved to the top of the list. -->
                                          <!-- Countries known to be subject to general US embargo are commented out by default. -->
                                          <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->
                                        
                                          <option data-countryCode="US" value="1" >+1</option>
                                          <option data-countryCode="GB" value="44">+44</option>
                                          <option data-countryCode="DZ" value="213">+213</option>
                                          <option data-countryCode="AD" value="376">+376</option>
                                          <option data-countryCode="AO" value="244">+244</option>
                                          <option data-countryCode="AI" value="1264">+1264</option>
                                          <option data-countryCode="AG" value="1268">+1268</option>
                                          <option data-countryCode="AR" value="54">+54</option>
                                          <option data-countryCode="AM" value="374">+374</option>
                                          <option data-countryCode="AW" value="297">+297</option>
                                          <option data-countryCode="AU" value="61">+61</option>
                                          <option data-countryCode="AT" value="43">+43</option>
                                          <option data-countryCode="AZ" value="994">+994</option>
                                          <option data-countryCode="BS" value="1242">+1242</option>
                                          <option data-countryCode="BH" value="973">+973</option>
                                          <option data-countryCode="BD" value="880">+880</option>
                                          <option data-countryCode="BB" value="1246">+1246</option>
                                          <option data-countryCode="BY" value="375">+375</option>
                                          <option data-countryCode="BE" value="32">+32</option>
                                          <option data-countryCode="BZ" value="501">+501</option>
                                          <option data-countryCode="BJ" value="229">+229</option>
                                          <option data-countryCode="BM" value="1441">+1441</option>
                                          <option data-countryCode="BT" value="975">+975</option>
                                          <option data-countryCode="BO" value="591">+591</option>
                                          <option data-countryCode="BA" value="387">+387</option>
                                          <option data-countryCode="BW" value="267">+267</option>
                                          <option data-countryCode="BR" value="55">+55</option>
                                          <option data-countryCode="BN" value="673">+673</option>
                                          <option data-countryCode="BG" value="359">+359</option>
                                          <option data-countryCode="BF" value="226">+226</option>
                                          <option data-countryCode="BI" value="257">+257</option>
                                          <option data-countryCode="KH" value="855">+855</option>
                                          <option data-countryCode="CM" value="237">+237</option>
                                          <option data-countryCode="CA" value="1">+1</option>
                                          <option data-countryCode="CV" value="238">+238</option>
                                        
                                          <option data-countryCode="KY" value="1345">+1345</option>
                                          <option data-countryCode="CF" value="236">+236</option>
                                          <option data-countryCode="CL" value="56">+56</option>
                                          <option data-countryCode="CN" value="86">+86</option>
                                          <option data-countryCode="CO" value="57">+57</option>
                                          <option data-countryCode="KM" value="269">+269</option>
                                          <option data-countryCode="CG" value="242">+242</option>
                                          <option data-countryCode="CK" value="682">+682</option>
                                          <option data-countryCode="CR" value="506">+506</option>
                                          <option data-countryCode="HR" value="385">+385</option>
                                          <!-- <option data-countryCode="CU" value="53">Cuba +53</option> -->
                                          <option data-countryCode="CY" value="90">+90</option>
                                          <option data-countryCode="CY" value="357">+357</option>
                                          <option data-countryCode="CZ" value="420">+420</option>
                                          <option data-countryCode="DK" value="45">+45</option>
                                          <option data-countryCode="DJ" value="253">+253</option>
                                          <option data-countryCode="DM" value="1809">+1809</option>
                                          <option data-countryCode="DO" value="1809">+1809</option>
                                          <option data-countryCode="EC" value="593">+593</option>
                                          <option data-countryCode="EG" value="20">+20</option>
                                          <option data-countryCode="SV" value="503">+503</option>
                                          <option data-countryCode="GQ" value="240">+240</option>
                                          <option data-countryCode="ER" value="291">+291</option>
                                          <option data-countryCode="EE" value="372">+372</option>
                                          <option data-countryCode="ET" value="251">+251</option>
                                          <option data-countryCode="FK" value="500">+500</option>
                                          <option data-countryCode="FO" value="298">+298</option>
                                          <option data-countryCode="FJ" value="679">+679</option>
                                          <option data-countryCode="FI" value="358">+358</option>
                                          <option data-countryCode="FR" value="33">+33</option>
                                          <option data-countryCode="GF" value="594">+594</option>
                                          <option data-countryCode="PF" value="689">+689</option>
                                          <option data-countryCode="GA" value="241">+241</option>
                                          <option data-countryCode="GM" value="220">+220</option>
                                          <option data-countryCode="GE" value="7880">+7880</option>
                                          <option data-countryCode="DE" value="49">+49</option>
                                          <option data-countryCode="GH" value="233">+233</option>
                                          <option data-countryCode="GI" value="350">+350</option>
                                          <option data-countryCode="GR" value="30">+30</option>
                                          <option data-countryCode="GL" value="299">+299</option>
                                          <option data-countryCode="GD" value="1473">+1473</option>
                                          <option data-countryCode="GP" value="590">+590</option>
                                          <option data-countryCode="GU" value="671">+671</option>
                                          <option data-countryCode="GT" value="502">+502</option>
                                          <option data-countryCode="GN" value="224">+224</option>
                                          <option data-countryCode="GW" value="245">+245</option>
                                          <option data-countryCode="GY" value="592">+592</option>
                                          <option data-countryCode="HT" value="509">+509</option>
                                          <option data-countryCode="HN" value="504">+504</option>
                                          <option data-countryCode="HK" value="852">+852</option>
                                          <option data-countryCode="HU" value="36">+36</option>
                                          <option data-countryCode="IS" value="354">+354</option>
                                          <option data-countryCode="IN" value="91">+91</option>
                                          <option data-countryCode="ID" value="62">+62</option>
                                          <option data-countryCode="IQ" value="964">+964</option>
                                          <!-- <option data-countryCode="IR" value="98">Iran +98</option> -->
                                          <option data-countryCode="IE" value="353">+353</option>
                                          <option data-countryCode="IL" value="972">+972</option>
                                          <option data-countryCode="IT" value="39">+39</option>
                                          <option data-countryCode="JM" value="1876">+1876</option>
                                          <option data-countryCode="JP" value="81">+81</option>
                                          <option data-countryCode="JO" value="962">+962</option>
                                          <option data-countryCode="KZ" value="7">+7</option>
                                          <option data-countryCode="KE" value="254">+254</option>
                                          <option data-countryCode="KI" value="686">+686</option>
                                          <option data-countryCode="KR" value="82">+82</option>
                                          <option data-countryCode="KW" value="965">+965</option>
                                          <option data-countryCode="KG" value="996">+996</option>
                                          <option data-countryCode="LA" value="856">+856</option>
                                          <option data-countryCode="LV" value="371">+371</option>
                                          <option data-countryCode="LB" value="961">+961</option>
                                          <option data-countryCode="LS" value="266">+266</option>
                                          <option data-countryCode="LR" value="231">+231</option>
                                          <option data-countryCode="LY" value="218">+218</option>
                                          <option data-countryCode="LI" value="417">+417</option>
                                          <option data-countryCode="LT" value="370">+370</option>
                                          <option data-countryCode="LU" value="352">+352</option>
                                          <option data-countryCode="MO" value="853">+853</option>
                                          <option data-countryCode="MK" value="389">+389</option>
                                          <option data-countryCode="MG" value="261">+261</option>
                                          <option data-countryCode="MW" value="265">+265</option>
                                          <option data-countryCode="MY" value="60">+60</option>
                                          <option data-countryCode="MV" value="960">+960</option>
                                          <option data-countryCode="ML" value="223">+223</option>
                                          <option data-countryCode="MT" value="356">+356</option>
                                          <option data-countryCode="MH" value="692">+692</option>
                                          <option data-countryCode="MQ" value="596">+596</option>
                                          <option data-countryCode="MR" value="222">+222</option>
                                          <option data-countryCode="YT" value="269">+269</option>
                                          <option data-countryCode="MX" value="52">+52</option>
                                          <option data-countryCode="FM" value="691">+691</option>
                                          <option data-countryCode="MD" value="373">+373</option>
                                          <option data-countryCode="MC" value="377">+377</option>
                                          <option data-countryCode="MN" value="976">+976</option>
                                          <option data-countryCode="MS" value="1664">+1664</option>
                                          <option data-countryCode="MA" value="212">+212</option>
                                          <option data-countryCode="MZ" value="258">+258</option>
                                          <option data-countryCode="MN" value="95">+95</option>
                                          <option data-countryCode="NA" value="264">+264</option>
                                          <option data-countryCode="NR" value="674">+674</option>
                                          <option data-countryCode="NP" value="977">+977</option>
                                          <option data-countryCode="NL" value="31">+31</option>
                                          <option data-countryCode="NC" value="687">+687</option>
                                          <option data-countryCode="NZ" value="64">+64</option>
                                          <option data-countryCode="NI" value="505">+505</option>
                                          <option data-countryCode="NE" value="227">+227</option>
                                          <option data-countryCode="NG" value="234">+234</option>
                                          <option data-countryCode="NU" value="683">+683</option>
                                          <option data-countryCode="NF" value="672">+672</option>
                                          <option data-countryCode="NP" value="670">+670</option>
                                          <option data-countryCode="NO" value="47">+47</option>
                                          <option data-countryCode="OM" value="968">+968</option>
                                          <option selected data-countryCode="PK" value="92">+92</option>
                                          <option data-countryCode="PW" value="680">+680</option>
                                          <option data-countryCode="PA" value="507">+507</option>
                                          <option data-countryCode="PG" value="675">+675</option>
                                          <option data-countryCode="PY" value="595">+595</option>
                                          <option data-countryCode="PE" value="51">+51</option>
                                          <option data-countryCode="PH" value="63">+63</option>
                                          <option data-countryCode="PL" value="48">+48</option>
                                          <option data-countryCode="PT" value="351">+351</option>
                                          <option data-countryCode="PR" value="1787">+1787</option>
                                          <option data-countryCode="QA" value="974">+974</option>
                                          <option data-countryCode="RE" value="262">+262</option>
                                          <option data-countryCode="RO" value="40">+40</option>
                                          <option data-countryCode="RU" value="7">+7</option>
                                          <option data-countryCode="RW" value="250">+250</option>
                                          <option data-countryCode="SM" value="378">+378</option>
                                          <option data-countryCode="ST" value="239">+239</option>
                                          <option data-countryCode="SA" value="966">+966</option>
                                          <option data-countryCode="SN" value="221">+221</option>
                                          <option data-countryCode="CS" value="381">+381</option>
                                          <option data-countryCode="SC" value="248">+248</option>
                                          <option data-countryCode="SL" value="232">+232</option>
                                          <option data-countryCode="SG" value="65">+65</option>
                                          <option data-countryCode="SK" value="421">+421</option>
                                          <option data-countryCode="SI" value="386">+386</option>
                                          <option data-countryCode="SB" value="677">+677</option>
                                          <option data-countryCode="SO" value="252">+252</option>
                                          <option data-countryCode="ZA" value="27">+27</option>
                                          <option data-countryCode="ES" value="34">+34</option>
                                          <option data-countryCode="LK" value="94">+94</option>
                                          <option data-countryCode="SH" value="290">+290</option>
                                          <option data-countryCode="KN" value="1869">+1869</option>
                                          <option data-countryCode="SC" value="1758">+1758</option>
                                          <option data-countryCode="SR" value="597">+597</option>
                                          <option data-countryCode="SD" value="249">+249</option>
                                          <option data-countryCode="SZ" value="268">+268</option>
                                          <option data-countryCode="SE" value="46">+46</option>
                                          <option data-countryCode="CH" value="41">+41</option>
                                          <!-- <option data-countryCode="SY" value="963">Syria +963</option> -->
                                          <option data-countryCode="TW" value="886">+886</option>
                                          <option data-countryCode="TJ" value="992">+992</option>
                                          <option data-countryCode="TH" value="66">+66</option>
                                          <option data-countryCode="TG" value="228">+228</option>
                                          <option data-countryCode="TO" value="676">+676</option>
                                          <option data-countryCode="TT" value="1868">+1868</option>
                                          <option data-countryCode="TN" value="216">+216</option>
                                          <option data-countryCode="TR" value="90">+90</option>
                                          <option data-countryCode="TM" value="993">+993</option>
                                          <option data-countryCode="TC" value="1649">+1649</option>
                                          <option data-countryCode="TV" value="688">+688</option>
                                          <option data-countryCode="UG" value="256">+256</option>
                                          <option data-countryCode="UA" value="380">+380</option>
                                          <option data-countryCode="AE" value="971">+971</option>
                                          <option data-countryCode="UY" value="598">+598</option>
                                          <option data-countryCode="UZ" value="998">+998</option>
                                          <option data-countryCode="VU" value="678">+678</option>
                                          <option data-countryCode="VA" value="379">+379</option>
                                          <option data-countryCode="VE" value="58">+58</option>
                                          <option data-countryCode="VN" value="84">+84</option>
                                          <option data-countryCode="VG" value="1">+1</option>
                                          <option data-countryCode="VI" value="1">+1</option>
                                          <option data-countryCode="WF" value="681">+681</option>
                                          <option data-countryCode="YE" value="969">+969</option>
                                          <option data-countryCode="YE" value="967">+967</option>
                                          <option data-countryCode="ZM" value="260">+260</option>
                                          <option data-countryCode="ZW" value="263">+263</option>
                                        </select>
                                        <input required="" name="father_mobile_phone[]" type="number" class="col-md-10" placeholder="Mobile" id="father_mobile" value="" style="padding-left:60px;" /> 
                                        <button class="add_field_button_father">+</button>
                                    </div><!-- input_fields_wrap --><br /><br />
                                  </div><!-- fatherContactArea -->
                                    <!-- <input type="text" class="" placeholder="Father Mobile *" name="father_mobile" id="father_mobile" /><br /><br /> -->
                                    <input type="text" class="" placeholder="Father NIC *" name="father_nic" id="father_nic" /><br /><br />

                                    <input type="text" class="" placeholder="Father Email" name="father_email" id="father_email" />
                                  
                                </div><!-- col-md-6 -->
                                <div class="col-md-6">
                                    <input class="paddingBottom10" type="radio" name="primary_contact" value="1" id="primary_contact2"> <label for="primary_contact2">Primary Contact Mother</label><br /><br />
                                    <input type="text" class="" placeholder="Mother Name" name="mother_name" id="mother_name" /><br /><Br />
                                    <div class="motherContactArea">
                                    <div class="input_fields_wrap_mother" style="margin-bottom: 14px;">
                                        <!-- <label>Mobile</label> -->
                                        <select class="countryCodeNumber" name="mother_mobile_code[]">
                                        <!-- Countries often selected by users can be moved to the top of the list. -->
                                        <!-- Countries known to be subject to general US embargo are commented out by default. -->
                                        <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->
                                        
                                        <option data-countryCode="US" value="1" >+1</option>
                                        <option data-countryCode="GB" value="44">+44</option>
                                        <option data-countryCode="DZ" value="213">+213</option>
                                        <option data-countryCode="AD" value="376">+376</option>
                                        <option data-countryCode="AO" value="244">+244</option>
                                        <option data-countryCode="AI" value="1264">+1264</option>
                                        <option data-countryCode="AG" value="1268">+1268</option>
                                        <option data-countryCode="AR" value="54">+54</option>
                                        <option data-countryCode="AM" value="374">+374</option>
                                        <option data-countryCode="AW" value="297">+297</option>
                                        <option data-countryCode="AU" value="61">+61</option>
                                        <option data-countryCode="AT" value="43">+43</option>
                                        <option data-countryCode="AZ" value="994">+994</option>
                                        <option data-countryCode="BS" value="1242">+1242</option>
                                        <option data-countryCode="BH" value="973">+973</option>
                                        <option data-countryCode="BD" value="880">+880</option>
                                        <option data-countryCode="BB" value="1246">+1246</option>
                                        <option data-countryCode="BY" value="375">+375</option>
                                        <option data-countryCode="BE" value="32">+32</option>
                                        <option data-countryCode="BZ" value="501">+501</option>
                                        <option data-countryCode="BJ" value="229">+229</option>
                                        <option data-countryCode="BM" value="1441">+1441</option>
                                        <option data-countryCode="BT" value="975">+975</option>
                                        <option data-countryCode="BO" value="591">+591</option>
                                        <option data-countryCode="BA" value="387">+387</option>
                                        <option data-countryCode="BW" value="267">+267</option>
                                        <option data-countryCode="BR" value="55">+55</option>
                                        <option data-countryCode="BN" value="673">+673</option>
                                        <option data-countryCode="BG" value="359">+359</option>
                                        <option data-countryCode="BF" value="226">+226</option>
                                        <option data-countryCode="BI" value="257">+257</option>
                                        <option data-countryCode="KH" value="855">+855</option>
                                        <option data-countryCode="CM" value="237">+237</option>
                                        <option data-countryCode="CA" value="1">+1</option>
                                        <option data-countryCode="CV" value="238">+238</option>
                                        
                                        <option data-countryCode="KY" value="1345">+1345</option>
                                        <option data-countryCode="CF" value="236">+236</option>
                                        <option data-countryCode="CL" value="56">+56</option>
                                        <option data-countryCode="CN" value="86">+86</option>
                                        <option data-countryCode="CO" value="57">+57</option>
                                        <option data-countryCode="KM" value="269">+269</option>
                                        <option data-countryCode="CG" value="242">+242</option>
                                        <option data-countryCode="CK" value="682">+682</option>
                                        <option data-countryCode="CR" value="506">+506</option>
                                        <option data-countryCode="HR" value="385">+385</option>
                                        <!-- <option data-countryCode="CU" value="53">Cuba +53</option> -->
                                        <option data-countryCode="CY" value="90">+90</option>
                                        <option data-countryCode="CY" value="357">+357</option>
                                        <option data-countryCode="CZ" value="420">+420</option>
                                        <option data-countryCode="DK" value="45">+45</option>
                                        <option data-countryCode="DJ" value="253">+253</option>
                                        <option data-countryCode="DM" value="1809">+1809</option>
                                        <option data-countryCode="DO" value="1809">+1809</option>
                                        <option data-countryCode="EC" value="593">+593</option>
                                        <option data-countryCode="EG" value="20">+20</option>
                                        <option data-countryCode="SV" value="503">+503</option>
                                        <option data-countryCode="GQ" value="240">+240</option>
                                        <option data-countryCode="ER" value="291">+291</option>
                                        <option data-countryCode="EE" value="372">+372</option>
                                        <option data-countryCode="ET" value="251">+251</option>
                                        <option data-countryCode="FK" value="500">+500</option>
                                        <option data-countryCode="FO" value="298">+298</option>
                                        <option data-countryCode="FJ" value="679">+679</option>
                                        <option data-countryCode="FI" value="358">+358</option>
                                        <option data-countryCode="FR" value="33">+33</option>
                                        <option data-countryCode="GF" value="594">+594</option>
                                        <option data-countryCode="PF" value="689">+689</option>
                                        <option data-countryCode="GA" value="241">+241</option>
                                        <option data-countryCode="GM" value="220">+220</option>
                                        <option data-countryCode="GE" value="7880">+7880</option>
                                        <option data-countryCode="DE" value="49">+49</option>
                                        <option data-countryCode="GH" value="233">+233</option>
                                        <option data-countryCode="GI" value="350">+350</option>
                                        <option data-countryCode="GR" value="30">+30</option>
                                        <option data-countryCode="GL" value="299">+299</option>
                                        <option data-countryCode="GD" value="1473">+1473</option>
                                        <option data-countryCode="GP" value="590">+590</option>
                                        <option data-countryCode="GU" value="671">+671</option>
                                        <option data-countryCode="GT" value="502">+502</option>
                                        <option data-countryCode="GN" value="224">+224</option>
                                        <option data-countryCode="GW" value="245">+245</option>
                                        <option data-countryCode="GY" value="592">+592</option>
                                        <option data-countryCode="HT" value="509">+509</option>
                                        <option data-countryCode="HN" value="504">+504</option>
                                        <option data-countryCode="HK" value="852">+852</option>
                                        <option data-countryCode="HU" value="36">+36</option>
                                        <option data-countryCode="IS" value="354">+354</option>
                                        <option data-countryCode="IN" value="91">+91</option>
                                        <option data-countryCode="ID" value="62">+62</option>
                                        <option data-countryCode="IQ" value="964">+964</option>
                                        <!-- <option data-countryCode="IR" value="98">Iran +98</option> -->
                                        <option data-countryCode="IE" value="353">+353</option>
                                        <option data-countryCode="IL" value="972">+972</option>
                                        <option data-countryCode="IT" value="39">+39</option>
                                        <option data-countryCode="JM" value="1876">+1876</option>
                                        <option data-countryCode="JP" value="81">+81</option>
                                        <option data-countryCode="JO" value="962">+962</option>
                                        <option data-countryCode="KZ" value="7">+7</option>
                                        <option data-countryCode="KE" value="254">+254</option>
                                        <option data-countryCode="KI" value="686">+686</option>
                                        <option data-countryCode="KR" value="82">+82</option>
                                        <option data-countryCode="KW" value="965">+965</option>
                                        <option data-countryCode="KG" value="996">+996</option>
                                        <option data-countryCode="LA" value="856">+856</option>
                                        <option data-countryCode="LV" value="371">+371</option>
                                        <option data-countryCode="LB" value="961">+961</option>
                                        <option data-countryCode="LS" value="266">+266</option>
                                        <option data-countryCode="LR" value="231">+231</option>
                                        <option data-countryCode="LY" value="218">+218</option>
                                        <option data-countryCode="LI" value="417">+417</option>
                                        <option data-countryCode="LT" value="370">+370</option>
                                        <option data-countryCode="LU" value="352">+352</option>
                                        <option data-countryCode="MO" value="853">+853</option>
                                        <option data-countryCode="MK" value="389">+389</option>
                                        <option data-countryCode="MG" value="261">+261</option>
                                        <option data-countryCode="MW" value="265">+265</option>
                                        <option data-countryCode="MY" value="60">+60</option>
                                        <option data-countryCode="MV" value="960">+960</option>
                                        <option data-countryCode="ML" value="223">+223</option>
                                        <option data-countryCode="MT" value="356">+356</option>
                                        <option data-countryCode="MH" value="692">+692</option>
                                        <option data-countryCode="MQ" value="596">+596</option>
                                        <option data-countryCode="MR" value="222">+222</option>
                                        <option data-countryCode="YT" value="269">+269</option>
                                        <option data-countryCode="MX" value="52">+52</option>
                                        <option data-countryCode="FM" value="691">+691</option>
                                        <option data-countryCode="MD" value="373">+373</option>
                                        <option data-countryCode="MC" value="377">+377</option>
                                        <option data-countryCode="MN" value="976">+976</option>
                                        <option data-countryCode="MS" value="1664">+1664</option>
                                        <option data-countryCode="MA" value="212">+212</option>
                                        <option data-countryCode="MZ" value="258">+258</option>
                                        <option data-countryCode="MN" value="95">+95</option>
                                        <option data-countryCode="NA" value="264">+264</option>
                                        <option data-countryCode="NR" value="674">+674</option>
                                        <option data-countryCode="NP" value="977">+977</option>
                                        <option data-countryCode="NL" value="31">+31</option>
                                        <option data-countryCode="NC" value="687">+687</option>
                                        <option data-countryCode="NZ" value="64">+64</option>
                                        <option data-countryCode="NI" value="505">+505</option>
                                        <option data-countryCode="NE" value="227">+227</option>
                                        <option data-countryCode="NG" value="234">+234</option>
                                        <option data-countryCode="NU" value="683">+683</option>
                                        <option data-countryCode="NF" value="672">+672</option>
                                        <option data-countryCode="NP" value="670">+670</option>
                                        <option data-countryCode="NO" value="47">+47</option>
                                        <option data-countryCode="OM" value="968">+968</option>
                                        <option selected data-countryCode="PK" value="92">+92</option>
                                        <option data-countryCode="PW" value="680">+680</option>
                                        <option data-countryCode="PA" value="507">+507</option>
                                        <option data-countryCode="PG" value="675">+675</option>
                                        <option data-countryCode="PY" value="595">+595</option>
                                        <option data-countryCode="PE" value="51">+51</option>
                                        <option data-countryCode="PH" value="63">+63</option>
                                        <option data-countryCode="PL" value="48">+48</option>
                                        <option data-countryCode="PT" value="351">+351</option>
                                        <option data-countryCode="PR" value="1787">+1787</option>
                                        <option data-countryCode="QA" value="974">+974</option>
                                        <option data-countryCode="RE" value="262">+262</option>
                                        <option data-countryCode="RO" value="40">+40</option>
                                        <option data-countryCode="RU" value="7">+7</option>
                                        <option data-countryCode="RW" value="250">+250</option>
                                        <option data-countryCode="SM" value="378">+378</option>
                                        <option data-countryCode="ST" value="239">+239</option>
                                        <option data-countryCode="SA" value="966">+966</option>
                                        <option data-countryCode="SN" value="221">+221</option>
                                        <option data-countryCode="CS" value="381">+381</option>
                                        <option data-countryCode="SC" value="248">+248</option>
                                        <option data-countryCode="SL" value="232">+232</option>
                                        <option data-countryCode="SG" value="65">+65</option>
                                        <option data-countryCode="SK" value="421">+421</option>
                                        <option data-countryCode="SI" value="386">+386</option>
                                        <option data-countryCode="SB" value="677">+677</option>
                                        <option data-countryCode="SO" value="252">+252</option>
                                        <option data-countryCode="ZA" value="27">+27</option>
                                        <option data-countryCode="ES" value="34">+34</option>
                                        <option data-countryCode="LK" value="94">+94</option>
                                        <option data-countryCode="SH" value="290">+290</option>
                                        <option data-countryCode="KN" value="1869">+1869</option>
                                        <option data-countryCode="SC" value="1758">+1758</option>
                                        <option data-countryCode="SR" value="597">+597</option>
                                        <option data-countryCode="SD" value="249">+249</option>
                                        <option data-countryCode="SZ" value="268">+268</option>
                                        <option data-countryCode="SE" value="46">+46</option>
                                        <option data-countryCode="CH" value="41">+41</option>
                                        <!-- <option data-countryCode="SY" value="963">Syria +963</option> -->
                                        <option data-countryCode="TW" value="886">+886</option>
                                        <option data-countryCode="TJ" value="992">+992</option>
                                        <option data-countryCode="TH" value="66">+66</option>
                                        <option data-countryCode="TG" value="228">+228</option>
                                        <option data-countryCode="TO" value="676">+676</option>
                                        <option data-countryCode="TT" value="1868">+1868</option>
                                        <option data-countryCode="TN" value="216">+216</option>
                                        <option data-countryCode="TR" value="90">+90</option>
                                        <option data-countryCode="TM" value="993">+993</option>
                                        <option data-countryCode="TC" value="1649">+1649</option>
                                        <option data-countryCode="TV" value="688">+688</option>
                                        <option data-countryCode="UG" value="256">+256</option>
                                        <option data-countryCode="UA" value="380">+380</option>
                                        <option data-countryCode="AE" value="971">+971</option>
                                        <option data-countryCode="UY" value="598">+598</option>
                                        <option data-countryCode="UZ" value="998">+998</option>
                                        <option data-countryCode="VU" value="678">+678</option>
                                        <option data-countryCode="VA" value="379">+379</option>
                                        <option data-countryCode="VE" value="58">+58</option>
                                        <option data-countryCode="VN" value="84">+84</option>
                                        <option data-countryCode="VG" value="1">+1</option>
                                        <option data-countryCode="VI" value="1">+1</option>
                                        <option data-countryCode="WF" value="681">+681</option>
                                        <option data-countryCode="YE" value="969">+969</option>
                                        <option data-countryCode="YE" value="967">+967</option>
                                        <option data-countryCode="ZM" value="260">+260</option>
                                        <option data-countryCode="ZW" value="263">+263</option>
                                        </select>
                                        <input name="mother_mobile_phone[]" type="text" class="col-md-10" placeholder="Mobile" id="mother_mobile" value="" style="padding-left:60px;" /> 
                                        <button class="add_field_button_mother">+</button>
                                    </div><!-- input_fields_wrap --><br /><br />
                                  </div><!-- motherContactArea -->
                                    <!-- <input type="text" class="" placeholder="Mother Mobile" name="mother_mobile" id="mother_mobile" /><br /><br /> -->
                                    <input type="text" class="" placeholder="Mother NIC" name="mother_nic" id="mother_nic" /><br /><br />
                                    <input type="text" class="" placeholder="Mother Email" name="mother_email" id="mother_email" />
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <hr />
                            <div class="col-md-12">
                              <div class="col-md-12">
                                <textarea placeholder="Comments" rows="4" cols="50" name="comments" id="comments"></textarea>
                            <!--input type="checkbox" id="ps" name="photo_submitted" style="display:block"> Photos Submitted -->
                                </div><!-- col-md-12 -->
                            </div><!-- col-md-12 -->
                            <hr />
                            <div class="col-md-12 paddingBottom0">
                              <div class="col-md-6" style="margin-top: -20px;">
                            
                                <input type="checkbox"  id="ps" name="photo_submitted" style="visibility:hidden;display:block;"> <label for="ps">Photos Submitted </label>
                            
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingBottom0">
                              <div class="col-md-6" style="margin-top: -10px;">
                                <input type="checkbox" id="bco" name="birth_certificate_o" style="visibility:hidden;display:block;"> <label for="bco">Birth Certificate (O)</label>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingBottom0">
                              <div class="col-md-6" style="margin-top: -10px;">
                                <input type="checkbox" id="bcc" name="birth_certificate_c" style="visibility:hidden;display:block;"> <label for="bcc">Birth Certificate (C)</label>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingBottom0 alevel_checklist" style="display: none;">
                              <div class="col-md-12">
                                <input type="checkbox" id="as" name="alevel_supplement" style="visibility:hidden;display:block;"> <label for="as">Duly filled Admission Application Form and A-Level Supplement</label>
                                </div>
                            </div><!-- col-md-12 -->                            
                            <hr />
                            <div class="col-md-12">
                              <input type="submit" name="submit" class="greenBTN" id="greenBTN" value="Print & Issue" />
                    
                        
                
            
            
                  
            <div id="calloutMessage" style="display:none;">
                  <div style="margin-bottom: 0;margin-top: 0;min-height: 0;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="ajaxloader">
                  <img src="<?php echo base_url();?>/components/image/ajax-loader.gif">
                  </div>
            
                  <div class="col-md-6 alert alert-danger">
                  <p>"You have already submitted this form" 
                  <a href="" id="print_url">Print</a></p>
                  </div>
                
                  <div class="col-md-6">
                  <input type="button" name="clear" class="grayBTN" id="greenBTN2" value="Clear" />
                  </div>
            </div>
            
              
              
                            </div><!-- col-md-12 -->
                      </div><!-- inner -->  
                    </div><!-- .MaroonBorderBox -->
                </form>
            </div><!-- col-md-4 -->
        </div><!-- Form Data-->    
        <div class="col-md-8">
            <div id="MaroonBorderBox2">
                  <div class="MaroonBorderBox">
              
                    <h3>Admission Forms Issued <span class="pull-right" style="margin-top: -5px;" id="reloadList">
                <span class="bigNum" id="myTotal">
                <?=$myttl["mytotal"]; ?>
                </span><small id="grandTotal"> / <?=$ttl["totalForm"]; ?></small> &nbsp; &nbsp; <a href="#" style="color:#fff;">
                <i class="fa fa-refresh" aria-hidden="true" id="reloadList"></i></a></span></h3>
              
                
                
                        <div class="inner20 paddingLeft20 paddingRight20">
                <?php //var_dump( $formlist ); ?>
                          <table id="issuanceFormListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                              <thead> 
                                  <tr> 
                                      <th width="" class="text-center">Form #</th> 
                                       
                                      <th width="">Applicant Name</th> 
                                      <th width="">Father Name - <strong>Contact</strong></th> 
                                      <th width="" class="text-center">Batch Id</th>
                                      <th width="" class="text-center no-sort">Status</th>
                                      <th width="" class="text-center">GF-ID</th>
                                      <th width="" class="no-sort">Action</th>
                                  </tr>
                              </thead>
                              <tbody> 
                    <?php if( !empty( $formlist ) ){
                      foreach( $formlist AS $fl ){ ?>

                      <tr>
                      <td class="text-center"><?php echo str_pad( $fl["Form_no"],3,"0",STR_PAD_LEFT); ?></td>
                      
                      <td><?=$fl["Applicate_name"];?></td>
                      <td><?=$fl["Father_name"];?> - <strong> <?=$fl["Father_mobile"];?> </strong></td>
                      <td class="text-center">
                        <strong><?= $fl["batch_name"]; ?></strong><br>
                        <span class="ass_date pull-left"><?= $fl["form_assessment_date"]; ?></span>
                        <span class="ass_time pull-right"><?= $fl["form_assessment_time"]; ?></span>


                      </td>
                      <td class="text-center">
                       <?php //$fl["form_status_id"];?>
                      <img src="<?php echo base_url()?>components/gs_theme/images/allocationIcon_active.png" title="Allocation" width="25" data-toggle="tooltip" data-placement="top" /> &nbsp; <img src="<?php echo base_url()?>components/gs_theme/images/communicationIcon_active.png" title="Communication" width="23" data-toggle="tooltip" data-placement="top" /></td>
                      
                     
                      <td class="text-center"><p><?php 
                      //echo join('-', str_split( $fl["Gf_id"], 2));
                      //echo implode('-', str_split($fl["Gf_id"], 2));
                      $value = $fl["gfid"];
                      
                      if( ( (int)substr($value, 0, 2) == 18 ) ){
                        
                      }else{
                      echo $value = substr($value, 0, 2).''.substr($value, 2);  
                      }
                      ?></p></td>
                      <td class="actionArea">
                      <a href="javascript:void(0)" class="hoverAction">Action <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                      <div class="actionItems">
                        <ul>
                          <li><a href="<?php echo base_url();?>index.php/gs_admission/ajax_base/print_admission_form?FormNo=<?php echo $fl['Form_id'];?>" target="_blank">Print Form</a></li>
                          <li><a href="#" class="view_n_Edit" data-grade_id="<?=$fl["Grade_id"];?>" data-id="<?=$fl["Form_id"];?>">View and Edit Details</a></li>
                        </ul><!-- actionIteamsUL-->
                      </div><!-- actionItems -->
                      </td>
                                  </tr>
                      <?php }
                    }   ?>
                  
                  </tbody> 
                          </table><!-- StaffListing -->
                        </div><!-- inner -->
                    </div><!-- MaroonBorderBox -->
                
            
            </div><!-- MaroonBorderBox2 -->
        </div><!-- col-md-8 -->
    </div><!-- row -->
    <!-- Two column layout END -->
</div><!-- container -->

<script>
$(document).ready(function() {
    var max_fields      = 2; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var wrapper1        = $(".fatherContactArea"); //Fields wrapper
    var wrapper2         = $(".motherContactArea"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var add_button1      = $(".add_field_button_father"); //Add button ID
    var add_button2      = $(".add_field_button_mother"); //Add button ID
    
    var x = 1; //initlal text box count
    var x1 = 1; //initlal text box count
    var x2 = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="input_fields_wrap_additional"><select class="countryCodeNumber" name="student_mobile_code[]"> <!-- Countries often selected by users can be moved to the top of the list. --> <!-- Countries known to be subject to general US embargo are commented out by default. --> <!-- The data-countryCode attribute is populated with ISO country code, and value is int l calling code. --> <option data-countryCode="US" value="1" >+1</option> <option data-countryCode="GB" value="44">+44</option> <option data-countryCode="DZ" value="213">+213</option> <option data-countryCode="AD" value="376">+376</option> <option data-countryCode="AO" value="244">+244</option> <option data-countryCode="AI" value="1264">+1264</option> <option data-countryCode="AG" value="1268">+1268</option> <option data-countryCode="AR" value="54">+54</option> <option data-countryCode="AM" value="374">+374</option> <option data-countryCode="AW" value="297">+297</option> <option data-countryCode="AU" value="61">+61</option> <option data-countryCode="AT" value="43">+43</option> <option data-countryCode="AZ" value="994">+994</option> <option data-countryCode="BS" value="1242">+1242</option> <option data-countryCode="BH" value="973">+973</option> <option data-countryCode="BD" value="880">+880</option> <option data-countryCode="BB" value="1246">+1246</option> <option data-countryCode="BY" value="375">+375</option> <option data-countryCode="BE" value="32">+32</option> <option data-countryCode="BZ" value="501">+501</option> <option data-countryCode="BJ" value="229">+229</option> <option data-countryCode="BM" value="1441">+1441</option> <option data-countryCode="BT" value="975">+975</option> <option data-countryCode="BO" value="591">+591</option> <option data-countryCode="BA" value="387">+387</option> <option data-countryCode="BW" value="267">+267</option> <option data-countryCode="BR" value="55">+55</option> <option data-countryCode="BN" value="673">+673</option> <option data-countryCode="BG" value="359">+359</option> <option data-countryCode="BF" value="226">+226</option> <option data-countryCode="BI" value="257">+257</option> <option data-countryCode="KH" value="855">+855</option> <option data-countryCode="CM" value="237">+237</option> <option data-countryCode="CA" value="1">+1</option> <option data-countryCode="CV" value="238">+238</option> <option data-countryCode="KY" value="1345">+1345</option> <option data-countryCode="CF" value="236">+236</option> <option data-countryCode="CL" value="56">+56</option> <option data-countryCode="CN" value="86">+86</option> <option data-countryCode="CO" value="57">+57</option> <option data-countryCode="KM" value="269">+269</option> <option data-countryCode="CG" value="242">+242</option> <option data-countryCode="CK" value="682">+682</option> <option data-countryCode="CR" value="506">+506</option> <option data-countryCode="HR" value="385">+385</option> <!-- <option data-countryCode="CU" value="53">Cuba +53</option> --> <option data-countryCode="CY" value="90">+90</option> <option data-countryCode="CY" value="357">+357</option> <option data-countryCode="CZ" value="420">+420</option> <option data-countryCode="DK" value="45">+45</option> <option data-countryCode="DJ" value="253">+253</option> <option data-countryCode="DM" value="1809">+1809</option> <option data-countryCode="DO" value="1809">+1809</option> <option data-countryCode="EC" value="593">+593</option> <option data-countryCode="EG" value="20">+20</option> <option data-countryCode="SV" value="503">+503</option> <option data-countryCode="GQ" value="240">+240</option> <option data-countryCode="ER" value="291">+291</option> <option data-countryCode="EE" value="372">+372</option> <option data-countryCode="ET" value="251">+251</option> <option data-countryCode="FK" value="500">+500</option> <option data-countryCode="FO" value="298">+298</option> <option data-countryCode="FJ" value="679">+679</option> <option data-countryCode="FI" value="358">+358</option> <option data-countryCode="FR" value="33">+33</option> <option data-countryCode="GF" value="594">+594</option> <option data-countryCode="PF" value="689">+689</option> <option data-countryCode="GA" value="241">+241</option> <option data-countryCode="GM" value="220">+220</option> <option data-countryCode="GE" value="7880">+7880</option> <option data-countryCode="DE" value="49">+49</option> <option data-countryCode="GH" value="233">+233</option> <option data-countryCode="GI" value="350">+350</option> <option data-countryCode="GR" value="30">+30</option> <option data-countryCode="GL" value="299">+299</option> <option data-countryCode="GD" value="1473">+1473</option> <option data-countryCode="GP" value="590">+590</option> <option data-countryCode="GU" value="671">+671</option> <option data-countryCode="GT" value="502">+502</option> <option data-countryCode="GN" value="224">+224</option> <option data-countryCode="GW" value="245">+245</option> <option data-countryCode="GY" value="592">+592</option> <option data-countryCode="HT" value="509">+509</option> <option data-countryCode="HN" value="504">+504</option> <option data-countryCode="HK" value="852">+852</option> <option data-countryCode="HU" value="36">+36</option> <option data-countryCode="IS" value="354">+354</option> <option data-countryCode="IN" value="91">+91</option> <option data-countryCode="ID" value="62">+62</option> <option data-countryCode="IQ" value="964">+964</option> <!-- <option data-countryCode="IR" value="98">Iran +98</option> --> <option data-countryCode="IE" value="353">+353</option> <option data-countryCode="IL" value="972">+972</option> <option data-countryCode="IT" value="39">+39</option> <option data-countryCode="JM" value="1876">+1876</option> <option data-countryCode="JP" value="81">+81</option> <option data-countryCode="JO" value="962">+962</option> <option data-countryCode="KZ" value="7">+7</option> <option data-countryCode="KE" value="254">+254</option> <option data-countryCode="KI" value="686">+686</option> <option data-countryCode="KR" value="82">+82</option> <option data-countryCode="KW" value="965">+965</option> <option data-countryCode="KG" value="996">+996</option> <option data-countryCode="LA" value="856">+856</option> <option data-countryCode="LV" value="371">+371</option> <option data-countryCode="LB" value="961">+961</option> <option data-countryCode="LS" value="266">+266</option> <option data-countryCode="LR" value="231">+231</option> <option data-countryCode="LY" value="218">+218</option> <option data-countryCode="LI" value="417">+417</option> <option data-countryCode="LT" value="370">+370</option> <option data-countryCode="LU" value="352">+352</option> <option data-countryCode="MO" value="853">+853</option> <option data-countryCode="MK" value="389">+389</option> <option data-countryCode="MG" value="261">+261</option> <option data-countryCode="MW" value="265">+265</option> <option data-countryCode="MY" value="60">+60</option> <option data-countryCode="MV" value="960">+960</option> <option data-countryCode="ML" value="223">+223</option> <option data-countryCode="MT" value="356">+356</option> <option data-countryCode="MH" value="692">+692</option> <option data-countryCode="MQ" value="596">+596</option> <option data-countryCode="MR" value="222">+222</option> <option data-countryCode="YT" value="269">+269</option> <option data-countryCode="MX" value="52">+52</option> <option data-countryCode="FM" value="691">+691</option> <option data-countryCode="MD" value="373">+373</option> <option data-countryCode="MC" value="377">+377</option> <option data-countryCode="MN" value="976">+976</option> <option data-countryCode="MS" value="1664">+1664</option> <option data-countryCode="MA" value="212">+212</option> <option data-countryCode="MZ" value="258">+258</option> <option data-countryCode="MN" value="95">+95</option> <option data-countryCode="NA" value="264">+264</option> <option data-countryCode="NR" value="674">+674</option> <option data-countryCode="NP" value="977">+977</option> <option data-countryCode="NL" value="31">+31</option> <option data-countryCode="NC" value="687">+687</option> <option data-countryCode="NZ" value="64">+64</option> <option data-countryCode="NI" value="505">+505</option> <option data-countryCode="NE" value="227">+227</option> <option data-countryCode="NG" value="234">+234</option> <option data-countryCode="NU" value="683">+683</option> <option data-countryCode="NF" value="672">+672</option> <option data-countryCode="NP" value="670">+670</option> <option data-countryCode="NO" value="47">+47</option> <option data-countryCode="OM" value="968">+968</option> <option selected data-countryCode="PK" value="92" selected >+92</option> <option data-countryCode="PW" value="680">+680</option> <option data-countryCode="PA" value="507">+507</option> <option data-countryCode="PG" value="675">+675</option> <option data-countryCode="PY" value="595">+595</option> <option data-countryCode="PE" value="51">+51</option> <option data-countryCode="PH" value="63">+63</option> <option data-countryCode="PL" value="48">+48</option> <option data-countryCode="PT" value="351">+351</option> <option data-countryCode="PR" value="1787">+1787</option> <option data-countryCode="QA" value="974">+974</option> <option data-countryCode="RE" value="262">+262</option> <option data-countryCode="RO" value="40">+40</option> <option data-countryCode="RU" value="7">+7</option> <option data-countryCode="RW" value="250">+250</option> <option data-countryCode="SM" value="378">+378</option> <option data-countryCode="ST" value="239">+239</option> <option data-countryCode="SA" value="966">+966</option> <option data-countryCode="SN" value="221">+221</option> <option data-countryCode="CS" value="381">+381</option> <option data-countryCode="SC" value="248">+248</option> <option data-countryCode="SL" value="232">+232</option> <option data-countryCode="SG" value="65">+65</option> <option data-countryCode="SK" value="421">+421</option> <option data-countryCode="SI" value="386">+386</option> <option data-countryCode="SB" value="677">+677</option> <option data-countryCode="SO" value="252">+252</option> <option data-countryCode="ZA" value="27">+27</option> <option data-countryCode="ES" value="34">+34</option> <option data-countryCode="LK" value="94">+94</option> <option data-countryCode="SH" value="290">+290</option> <option data-countryCode="KN" value="1869">+1869</option> <option data-countryCode="SC" value="1758">+1758</option> <option data-countryCode="SR" value="597">+597</option> <option data-countryCode="SD" value="249">+249</option> <option data-countryCode="SZ" value="268">+268</option> <option data-countryCode="SE" value="46">+46</option> <option data-countryCode="CH" value="41">+41</option> <!-- <option data-countryCode="SY" value="963">Syria +963</option> --> <option data-countryCode="TW" value="886">+886</option> <option data-countryCode="TJ" value="992">+992</option> <option data-countryCode="TH" value="66">+66</option> <option data-countryCode="TG" value="228">+228</option> <option data-countryCode="TO" value="676">+676</option> <option data-countryCode="TT" value="1868">+1868</option> <option data-countryCode="TN" value="216">+216</option> <option data-countryCode="TR" value="90">+90</option> <option data-countryCode="TM" value="993">+993</option> <option data-countryCode="TC" value="1649">+1649</option> <option data-countryCode="TV" value="688">+688</option> <option data-countryCode="UG" value="256">+256</option> <option data-countryCode="UA" value="380">+380</option> <option data-countryCode="AE" value="971">+971</option> <option data-countryCode="UY" value="598">+598</option> <option data-countryCode="UZ" value="998">+998</option> <option data-countryCode="VU" value="678">+678</option> <option data-countryCode="VA" value="379">+379</option> <option data-countryCode="VE" value="58">+58</option> <option data-countryCode="VN" value="84">+84</option> <option data-countryCode="VG" value="1">+1</option> <option data-countryCode="VI" value="1">+1</option> <option data-countryCode="WF" value="681">+681</option> <option data-countryCode="YE" value="969">+969</option> <option data-countryCode="YE" value="967">+967</option> <option data-countryCode="ZM" value="260">+260</option> <option data-countryCode="ZW" value="263">+263</option> </select><input name="student_mobile_phone[]" type="number" class="col-md-10" placeholder="Mobile" id="" value="" style="padding-left:80px;" /> <a href="#" class="remove_field">X</a></div>'); //add input box
        }
    });
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('.input_fields_wrap_additional').remove(); x--;
    })
  /* */
  $(add_button1).click(function(e){ //on add input button click
        e.preventDefault();
        if(x1 < max_fields){ //max input box allowed
            x1++; //text box increment
            $(wrapper1).append('<div class="input_fields_wrap_additional_father"><select class="countryCodeNumber" name="father_mobile_code[]"> <!-- Countries often selected by users can be moved to the top of the list. --> <!-- Countries known to be subject to general US embargo are commented out by default. --> <!-- The data-countryCode attribute is populated with ISO country code, and value is int l calling code. --> <option data-countryCode="US" value="1" >+1</option> <option data-countryCode="GB" value="44">+44</option> <option data-countryCode="DZ" value="213">+213</option> <option data-countryCode="AD" value="376">+376</option> <option data-countryCode="AO" value="244">+244</option> <option data-countryCode="AI" value="1264">+1264</option> <option data-countryCode="AG" value="1268">+1268</option> <option data-countryCode="AR" value="54">+54</option> <option data-countryCode="AM" value="374">+374</option> <option data-countryCode="AW" value="297">+297</option> <option data-countryCode="AU" value="61">+61</option> <option data-countryCode="AT" value="43">+43</option> <option data-countryCode="AZ" value="994">+994</option> <option data-countryCode="BS" value="1242">+1242</option> <option data-countryCode="BH" value="973">+973</option> <option data-countryCode="BD" value="880">+880</option> <option data-countryCode="BB" value="1246">+1246</option> <option data-countryCode="BY" value="375">+375</option> <option data-countryCode="BE" value="32">+32</option> <option data-countryCode="BZ" value="501">+501</option> <option data-countryCode="BJ" value="229">+229</option> <option data-countryCode="BM" value="1441">+1441</option> <option data-countryCode="BT" value="975">+975</option> <option data-countryCode="BO" value="591">+591</option> <option data-countryCode="BA" value="387">+387</option> <option data-countryCode="BW" value="267">+267</option> <option data-countryCode="BR" value="55">+55</option> <option data-countryCode="BN" value="673">+673</option> <option data-countryCode="BG" value="359">+359</option> <option data-countryCode="BF" value="226">+226</option> <option data-countryCode="BI" value="257">+257</option> <option data-countryCode="KH" value="855">+855</option> <option data-countryCode="CM" value="237">+237</option> <option data-countryCode="CA" value="1">+1</option> <option data-countryCode="CV" value="238">+238</option> <option data-countryCode="KY" value="1345">+1345</option> <option data-countryCode="CF" value="236">+236</option> <option data-countryCode="CL" value="56">+56</option> <option data-countryCode="CN" value="86">+86</option> <option data-countryCode="CO" value="57">+57</option> <option data-countryCode="KM" value="269">+269</option> <option data-countryCode="CG" value="242">+242</option> <option data-countryCode="CK" value="682">+682</option> <option data-countryCode="CR" value="506">+506</option> <option data-countryCode="HR" value="385">+385</option> <!-- <option data-countryCode="CU" value="53">Cuba +53</option> --> <option data-countryCode="CY" value="90">+90</option> <option data-countryCode="CY" value="357">+357</option> <option data-countryCode="CZ" value="420">+420</option> <option data-countryCode="DK" value="45">+45</option> <option data-countryCode="DJ" value="253">+253</option> <option data-countryCode="DM" value="1809">+1809</option> <option data-countryCode="DO" value="1809">+1809</option> <option data-countryCode="EC" value="593">+593</option> <option data-countryCode="EG" value="20">+20</option> <option data-countryCode="SV" value="503">+503</option> <option data-countryCode="GQ" value="240">+240</option> <option data-countryCode="ER" value="291">+291</option> <option data-countryCode="EE" value="372">+372</option> <option data-countryCode="ET" value="251">+251</option> <option data-countryCode="FK" value="500">+500</option> <option data-countryCode="FO" value="298">+298</option> <option data-countryCode="FJ" value="679">+679</option> <option data-countryCode="FI" value="358">+358</option> <option data-countryCode="FR" value="33">+33</option> <option data-countryCode="GF" value="594">+594</option> <option data-countryCode="PF" value="689">+689</option> <option data-countryCode="GA" value="241">+241</option> <option data-countryCode="GM" value="220">+220</option> <option data-countryCode="GE" value="7880">+7880</option> <option data-countryCode="DE" value="49">+49</option> <option data-countryCode="GH" value="233">+233</option> <option data-countryCode="GI" value="350">+350</option> <option data-countryCode="GR" value="30">+30</option> <option data-countryCode="GL" value="299">+299</option> <option data-countryCode="GD" value="1473">+1473</option> <option data-countryCode="GP" value="590">+590</option> <option data-countryCode="GU" value="671">+671</option> <option data-countryCode="GT" value="502">+502</option> <option data-countryCode="GN" value="224">+224</option> <option data-countryCode="GW" value="245">+245</option> <option data-countryCode="GY" value="592">+592</option> <option data-countryCode="HT" value="509">+509</option> <option data-countryCode="HN" value="504">+504</option> <option data-countryCode="HK" value="852">+852</option> <option data-countryCode="HU" value="36">+36</option> <option data-countryCode="IS" value="354">+354</option> <option data-countryCode="IN" value="91">+91</option> <option data-countryCode="ID" value="62">+62</option> <option data-countryCode="IQ" value="964">+964</option> <!-- <option data-countryCode="IR" value="98">Iran +98</option> --> <option data-countryCode="IE" value="353">+353</option> <option data-countryCode="IL" value="972">+972</option> <option data-countryCode="IT" value="39">+39</option> <option data-countryCode="JM" value="1876">+1876</option> <option data-countryCode="JP" value="81">+81</option> <option data-countryCode="JO" value="962">+962</option> <option data-countryCode="KZ" value="7">+7</option> <option data-countryCode="KE" value="254">+254</option> <option data-countryCode="KI" value="686">+686</option> <option data-countryCode="KR" value="82">+82</option> <option data-countryCode="KW" value="965">+965</option> <option data-countryCode="KG" value="996">+996</option> <option data-countryCode="LA" value="856">+856</option> <option data-countryCode="LV" value="371">+371</option> <option data-countryCode="LB" value="961">+961</option> <option data-countryCode="LS" value="266">+266</option> <option data-countryCode="LR" value="231">+231</option> <option data-countryCode="LY" value="218">+218</option> <option data-countryCode="LI" value="417">+417</option> <option data-countryCode="LT" value="370">+370</option> <option data-countryCode="LU" value="352">+352</option> <option data-countryCode="MO" value="853">+853</option> <option data-countryCode="MK" value="389">+389</option> <option data-countryCode="MG" value="261">+261</option> <option data-countryCode="MW" value="265">+265</option> <option data-countryCode="MY" value="60">+60</option> <option data-countryCode="MV" value="960">+960</option> <option data-countryCode="ML" value="223">+223</option> <option data-countryCode="MT" value="356">+356</option> <option data-countryCode="MH" value="692">+692</option> <option data-countryCode="MQ" value="596">+596</option> <option data-countryCode="MR" value="222">+222</option> <option data-countryCode="YT" value="269">+269</option> <option data-countryCode="MX" value="52">+52</option> <option data-countryCode="FM" value="691">+691</option> <option data-countryCode="MD" value="373">+373</option> <option data-countryCode="MC" value="377">+377</option> <option data-countryCode="MN" value="976">+976</option> <option data-countryCode="MS" value="1664">+1664</option> <option data-countryCode="MA" value="212">+212</option> <option data-countryCode="MZ" value="258">+258</option> <option data-countryCode="MN" value="95">+95</option> <option data-countryCode="NA" value="264">+264</option> <option data-countryCode="NR" value="674">+674</option> <option data-countryCode="NP" value="977">+977</option> <option data-countryCode="NL" value="31">+31</option> <option data-countryCode="NC" value="687">+687</option> <option data-countryCode="NZ" value="64">+64</option> <option data-countryCode="NI" value="505">+505</option> <option data-countryCode="NE" value="227">+227</option> <option data-countryCode="NG" value="234">+234</option> <option data-countryCode="NU" value="683">+683</option> <option data-countryCode="NF" value="672">+672</option> <option data-countryCode="NP" value="670">+670</option> <option data-countryCode="NO" value="47">+47</option> <option data-countryCode="OM" value="968">+968</option> <option selected data-countryCode="PK" value="92" selected>+92</option> <option data-countryCode="PW" value="680">+680</option> <option data-countryCode="PA" value="507">+507</option> <option data-countryCode="PG" value="675">+675</option> <option data-countryCode="PY" value="595">+595</option> <option data-countryCode="PE" value="51">+51</option> <option data-countryCode="PH" value="63">+63</option> <option data-countryCode="PL" value="48">+48</option> <option data-countryCode="PT" value="351">+351</option> <option data-countryCode="PR" value="1787">+1787</option> <option data-countryCode="QA" value="974">+974</option> <option data-countryCode="RE" value="262">+262</option> <option data-countryCode="RO" value="40">+40</option> <option data-countryCode="RU" value="7">+7</option> <option data-countryCode="RW" value="250">+250</option> <option data-countryCode="SM" value="378">+378</option> <option data-countryCode="ST" value="239">+239</option> <option data-countryCode="SA" value="966">+966</option> <option data-countryCode="SN" value="221">+221</option> <option data-countryCode="CS" value="381">+381</option> <option data-countryCode="SC" value="248">+248</option> <option data-countryCode="SL" value="232">+232</option> <option data-countryCode="SG" value="65">+65</option> <option data-countryCode="SK" value="421">+421</option> <option data-countryCode="SI" value="386">+386</option> <option data-countryCode="SB" value="677">+677</option> <option data-countryCode="SO" value="252">+252</option> <option data-countryCode="ZA" value="27">+27</option> <option data-countryCode="ES" value="34">+34</option> <option data-countryCode="LK" value="94">+94</option> <option data-countryCode="SH" value="290">+290</option> <option data-countryCode="KN" value="1869">+1869</option> <option data-countryCode="SC" value="1758">+1758</option> <option data-countryCode="SR" value="597">+597</option> <option data-countryCode="SD" value="249">+249</option> <option data-countryCode="SZ" value="268">+268</option> <option data-countryCode="SE" value="46">+46</option> <option data-countryCode="CH" value="41">+41</option> <!-- <option data-countryCode="SY" value="963">Syria +963</option> --> <option data-countryCode="TW" value="886">+886</option> <option data-countryCode="TJ" value="992">+992</option> <option data-countryCode="TH" value="66">+66</option> <option data-countryCode="TG" value="228">+228</option> <option data-countryCode="TO" value="676">+676</option> <option data-countryCode="TT" value="1868">+1868</option> <option data-countryCode="TN" value="216">+216</option> <option data-countryCode="TR" value="90">+90</option> <option data-countryCode="TM" value="993">+993</option> <option data-countryCode="TC" value="1649">+1649</option> <option data-countryCode="TV" value="688">+688</option> <option data-countryCode="UG" value="256">+256</option> <option data-countryCode="UA" value="380">+380</option> <option data-countryCode="AE" value="971">+971</option> <option data-countryCode="UY" value="598">+598</option> <option data-countryCode="UZ" value="998">+998</option> <option data-countryCode="VU" value="678">+678</option> <option data-countryCode="VA" value="379">+379</option> <option data-countryCode="VE" value="58">+58</option> <option data-countryCode="VN" value="84">+84</option> <option data-countryCode="VG" value="1">+1</option> <option data-countryCode="VI" value="1">+1</option> <option data-countryCode="WF" value="681">+681</option> <option data-countryCode="YE" value="969">+969</option> <option data-countryCode="YE" value="967">+967</option> <option data-countryCode="ZM" value="260">+260</option> <option data-countryCode="ZW" value="263">+263</option> </select><input type="number" class="col-md-10" placeholder="Mobile" id="" value="" style="padding-left:80px;" name="father_mobile_phone[]" /> <a href="#" class="remove_field1">X</a></div>'); //add input box
        }
    });
  $(wrapper1).on("click",".remove_field1", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('.input_fields_wrap_additional_father').remove(); x--;
    })
  /* */
  $(add_button2).click(function(e){ //on add input button click
        e.preventDefault();
        if(x2 < max_fields){ //max input box allowed
            x2++; //text box increment
            $(wrapper2).append('<div class="input_fields_wrap_additional_mother"><select class="countryCodeNumber" name="mother_mobile_code[]"> <!-- Countries often selected by users can be moved to the top of the list. --> <!-- Countries known to be subject to general US embargo are commented out by default. --> <!-- The data-countryCode attribute is populated with ISO country code, and value is int l calling code. --> <option data-countryCode="US" value="1" >+1</option> <option data-countryCode="GB" value="44">+44</option> <option data-countryCode="DZ" value="213">+213</option> <option data-countryCode="AD" value="376">+376</option> <option data-countryCode="AO" value="244">+244</option> <option data-countryCode="AI" value="1264">+1264</option> <option data-countryCode="AG" value="1268">+1268</option> <option data-countryCode="AR" value="54">+54</option> <option data-countryCode="AM" value="374">+374</option> <option data-countryCode="AW" value="297">+297</option> <option data-countryCode="AU" value="61">+61</option> <option data-countryCode="AT" value="43">+43</option> <option data-countryCode="AZ" value="994">+994</option> <option data-countryCode="BS" value="1242">+1242</option> <option data-countryCode="BH" value="973">+973</option> <option data-countryCode="BD" value="880">+880</option> <option data-countryCode="BB" value="1246">+1246</option> <option data-countryCode="BY" value="375">+375</option> <option data-countryCode="BE" value="32">+32</option> <option data-countryCode="BZ" value="501">+501</option> <option data-countryCode="BJ" value="229">+229</option> <option data-countryCode="BM" value="1441">+1441</option> <option data-countryCode="BT" value="975">+975</option> <option data-countryCode="BO" value="591">+591</option> <option data-countryCode="BA" value="387">+387</option> <option data-countryCode="BW" value="267">+267</option> <option data-countryCode="BR" value="55">+55</option> <option data-countryCode="BN" value="673">+673</option> <option data-countryCode="BG" value="359">+359</option> <option data-countryCode="BF" value="226">+226</option> <option data-countryCode="BI" value="257">+257</option> <option data-countryCode="KH" value="855">+855</option> <option data-countryCode="CM" value="237">+237</option> <option data-countryCode="CA" value="1">+1</option> <option data-countryCode="CV" value="238">+238</option> <option data-countryCode="KY" value="1345">+1345</option> <option data-countryCode="CF" value="236">+236</option> <option data-countryCode="CL" value="56">+56</option> <option data-countryCode="CN" value="86">+86</option> <option data-countryCode="CO" value="57">+57</option> <option data-countryCode="KM" value="269">+269</option> <option data-countryCode="CG" value="242">+242</option> <option data-countryCode="CK" value="682">+682</option> <option data-countryCode="CR" value="506">+506</option> <option data-countryCode="HR" value="385">+385</option> <!-- <option data-countryCode="CU" value="53">Cuba +53</option> --> <option data-countryCode="CY" value="90">+90</option> <option data-countryCode="CY" value="357">+357</option> <option data-countryCode="CZ" value="420">+420</option> <option data-countryCode="DK" value="45">+45</option> <option data-countryCode="DJ" value="253">+253</option> <option data-countryCode="DM" value="1809">+1809</option> <option data-countryCode="DO" value="1809">+1809</option> <option data-countryCode="EC" value="593">+593</option> <option data-countryCode="EG" value="20">+20</option> <option data-countryCode="SV" value="503">+503</option> <option data-countryCode="GQ" value="240">+240</option> <option data-countryCode="ER" value="291">+291</option> <option data-countryCode="EE" value="372">+372</option> <option data-countryCode="ET" value="251">+251</option> <option data-countryCode="FK" value="500">+500</option> <option data-countryCode="FO" value="298">+298</option> <option data-countryCode="FJ" value="679">+679</option> <option data-countryCode="FI" value="358">+358</option> <option data-countryCode="FR" value="33">+33</option> <option data-countryCode="GF" value="594">+594</option> <option data-countryCode="PF" value="689">+689</option> <option data-countryCode="GA" value="241">+241</option> <option data-countryCode="GM" value="220">+220</option> <option data-countryCode="GE" value="7880">+7880</option> <option data-countryCode="DE" value="49">+49</option> <option data-countryCode="GH" value="233">+233</option> <option data-countryCode="GI" value="350">+350</option> <option data-countryCode="GR" value="30">+30</option> <option data-countryCode="GL" value="299">+299</option> <option data-countryCode="GD" value="1473">+1473</option> <option data-countryCode="GP" value="590">+590</option> <option data-countryCode="GU" value="671">+671</option> <option data-countryCode="GT" value="502">+502</option> <option data-countryCode="GN" value="224">+224</option> <option data-countryCode="GW" value="245">+245</option> <option data-countryCode="GY" value="592">+592</option> <option data-countryCode="HT" value="509">+509</option> <option data-countryCode="HN" value="504">+504</option> <option data-countryCode="HK" value="852">+852</option> <option data-countryCode="HU" value="36">+36</option> <option data-countryCode="IS" value="354">+354</option> <option data-countryCode="IN" value="91">+91</option> <option data-countryCode="ID" value="62">+62</option> <option data-countryCode="IQ" value="964">+964</option> <!-- <option data-countryCode="IR" value="98">Iran +98</option> --> <option data-countryCode="IE" value="353">+353</option> <option data-countryCode="IL" value="972">+972</option> <option data-countryCode="IT" value="39">+39</option> <option data-countryCode="JM" value="1876">+1876</option> <option data-countryCode="JP" value="81">+81</option> <option data-countryCode="JO" value="962">+962</option> <option data-countryCode="KZ" value="7">+7</option> <option data-countryCode="KE" value="254">+254</option> <option data-countryCode="KI" value="686">+686</option> <option data-countryCode="KR" value="82">+82</option> <option data-countryCode="KW" value="965">+965</option> <option data-countryCode="KG" value="996">+996</option> <option data-countryCode="LA" value="856">+856</option> <option data-countryCode="LV" value="371">+371</option> <option data-countryCode="LB" value="961">+961</option> <option data-countryCode="LS" value="266">+266</option> <option data-countryCode="LR" value="231">+231</option> <option data-countryCode="LY" value="218">+218</option> <option data-countryCode="LI" value="417">+417</option> <option data-countryCode="LT" value="370">+370</option> <option data-countryCode="LU" value="352">+352</option> <option data-countryCode="MO" value="853">+853</option> <option data-countryCode="MK" value="389">+389</option> <option data-countryCode="MG" value="261">+261</option> <option data-countryCode="MW" value="265">+265</option> <option data-countryCode="MY" value="60">+60</option> <option data-countryCode="MV" value="960">+960</option> <option data-countryCode="ML" value="223">+223</option> <option data-countryCode="MT" value="356">+356</option> <option data-countryCode="MH" value="692">+692</option> <option data-countryCode="MQ" value="596">+596</option> <option data-countryCode="MR" value="222">+222</option> <option data-countryCode="YT" value="269">+269</option> <option data-countryCode="MX" value="52">+52</option> <option data-countryCode="FM" value="691">+691</option> <option data-countryCode="MD" value="373">+373</option> <option data-countryCode="MC" value="377">+377</option> <option data-countryCode="MN" value="976">+976</option> <option data-countryCode="MS" value="1664">+1664</option> <option data-countryCode="MA" value="212">+212</option> <option data-countryCode="MZ" value="258">+258</option> <option data-countryCode="MN" value="95">+95</option> <option data-countryCode="NA" value="264">+264</option> <option data-countryCode="NR" value="674">+674</option> <option data-countryCode="NP" value="977">+977</option> <option data-countryCode="NL" value="31">+31</option> <option data-countryCode="NC" value="687">+687</option> <option data-countryCode="NZ" value="64">+64</option> <option data-countryCode="NI" value="505">+505</option> <option data-countryCode="NE" value="227">+227</option> <option data-countryCode="NG" value="234">+234</option> <option data-countryCode="NU" value="683">+683</option> <option data-countryCode="NF" value="672">+672</option> <option data-countryCode="NP" value="670">+670</option> <option data-countryCode="NO" value="47">+47</option> <option data-countryCode="OM" value="968">+968</option> <option selected data-countryCode="PK" value="92" selected>+92</option> <option data-countryCode="PW" value="680">+680</option> <option data-countryCode="PA" value="507">+507</option> <option data-countryCode="PG" value="675">+675</option> <option data-countryCode="PY" value="595">+595</option> <option data-countryCode="PE" value="51">+51</option> <option data-countryCode="PH" value="63">+63</option> <option data-countryCode="PL" value="48">+48</option> <option data-countryCode="PT" value="351">+351</option> <option data-countryCode="PR" value="1787">+1787</option> <option data-countryCode="QA" value="974">+974</option> <option data-countryCode="RE" value="262">+262</option> <option data-countryCode="RO" value="40">+40</option> <option data-countryCode="RU" value="7">+7</option> <option data-countryCode="RW" value="250">+250</option> <option data-countryCode="SM" value="378">+378</option> <option data-countryCode="ST" value="239">+239</option> <option data-countryCode="SA" value="966">+966</option> <option data-countryCode="SN" value="221">+221</option> <option data-countryCode="CS" value="381">+381</option> <option data-countryCode="SC" value="248">+248</option> <option data-countryCode="SL" value="232">+232</option> <option data-countryCode="SG" value="65">+65</option> <option data-countryCode="SK" value="421">+421</option> <option data-countryCode="SI" value="386">+386</option> <option data-countryCode="SB" value="677">+677</option> <option data-countryCode="SO" value="252">+252</option> <option data-countryCode="ZA" value="27">+27</option> <option data-countryCode="ES" value="34">+34</option> <option data-countryCode="LK" value="94">+94</option> <option data-countryCode="SH" value="290">+290</option> <option data-countryCode="KN" value="1869">+1869</option> <option data-countryCode="SC" value="1758">+1758</option> <option data-countryCode="SR" value="597">+597</option> <option data-countryCode="SD" value="249">+249</option> <option data-countryCode="SZ" value="268">+268</option> <option data-countryCode="SE" value="46">+46</option> <option data-countryCode="CH" value="41">+41</option> <!-- <option data-countryCode="SY" value="963">Syria +963</option> --> <option data-countryCode="TW" value="886">+886</option> <option data-countryCode="TJ" value="992">+992</option> <option data-countryCode="TH" value="66">+66</option> <option data-countryCode="TG" value="228">+228</option> <option data-countryCode="TO" value="676">+676</option> <option data-countryCode="TT" value="1868">+1868</option> <option data-countryCode="TN" value="216">+216</option> <option data-countryCode="TR" value="90">+90</option> <option data-countryCode="TM" value="993">+993</option> <option data-countryCode="TC" value="1649">+1649</option> <option data-countryCode="TV" value="688">+688</option> <option data-countryCode="UG" value="256">+256</option> <option data-countryCode="UA" value="380">+380</option> <option data-countryCode="AE" value="971">+971</option> <option data-countryCode="UY" value="598">+598</option> <option data-countryCode="UZ" value="998">+998</option> <option data-countryCode="VU" value="678">+678</option> <option data-countryCode="VA" value="379">+379</option> <option data-countryCode="VE" value="58">+58</option> <option data-countryCode="VN" value="84">+84</option> <option data-countryCode="VG" value="1">+1</option> <option data-countryCode="VI" value="1">+1</option> <option data-countryCode="WF" value="681">+681</option> <option data-countryCode="YE" value="969">+969</option> <option data-countryCode="YE" value="967">+967</option> <option data-countryCode="ZM" value="260">+260</option> <option data-countryCode="ZW" value="263">+263</option> </select><input name="mother_mobile_phone[]" type="text" class="col-md-10" placeholder="Mobile" id="" value="" style="padding-left:80px;" /> <a href="#" class="remove_field2">X</a></div>'); //add input box
        }
    });
  $(wrapper2).on("click",".remove_field2", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('.input_fields_wrap_additional_mother').remove(); x--;
    })
    
});
</script>

<div class="modal fade in modal40 TimeLineModal" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Family Information <small id="family_gf_id"></small></h4>
        </div><!-- modal-header -->
        
        <div class="modal-body" id="tab_content">
        
          <!--ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#ParentInformation">Parents</a></li>
            <li><a data-toggle="tab" href="#Siblinginformation">Siblings</a></li>
         </ul -->
         <!-- nav-tabs -->
         
         <!--div class="tab-content" id="" --->
         
            <div id="ParentInformation" class="tab-pane fade in active">
               <div class="col-md-6 text-center">
                    <img src="http://10.10.10.63/gs/assets/photos/sis/150x150/father/11857.png" /><br /><Br /><h4>Haseeb Khan</h4>
                </div><!-- -->
                <div class="col-md-6 text-center">
                    <img src="http://10.10.10.63/gs/assets/photos/sis/150x150/mother/11857.png" /><br /><Br /><h4>Hira Haseeb</h4>
                </div><!-- -->
             </div><!-- ParentInformation -->
             
            
            <div id="Siblinginformation" class="tab-pane fade">
                <div class="col-md-6 childInfo">
                    <div class="col-md-6 SiblingPic">
                        <img src="http://10.10.10.63/gs/assets/photos/sis/150x150/student/11857.png" /><br />
                        <span class="houseInfo text-center">
                            <span class="iqbal">Iqbal</span>
                            <!-- <span class="syed">Syed</span>
                            <span class="jinnah">Jinnah</span> -->
                        </span><!-- houseInfo --><br />
                    </div><!-- SiblingPic -->
                    <div class="col-md-6 SiblingInfo text-center">
                        <h4>Abdul Hannan Khan</h4>
                        <span class="otherInfo">
                            <small>11507 | 13-120</small>
                        </span><!-- otherInfo --><br />
                        <span class="gradeInfo">
                            <small>I-C</small>
                        </span><!-- gradeInfo --><br />
                        <span class="dateJoin">
                            <small>18-Oct-2006</small>
                        </span><!-- dateJoin --><br />
                        <span class="activeStatus">
                            <small><strong>Active</strong></small>
                        </span><!-- activeStatus -->
                    </div><!-- SiblingInfo -->
                </div><!-- col-md-6 -->
                
                <div class="col-md-6 childInfo">
                    <div class="col-md-6 SiblingPic">
                        <img src="http://10.10.10.63/gs/assets/photos/sis/150x150/student/11857.png" /><br />
                        <span class="houseInfo text-center">
                            <span class="iqbal">Iqbal</span>
                            <!-- <span class="syed">Syed</span>
                            <span class="jinnah">Jinnah</span> -->
                        </span><!-- houseInfo --><br />
                    </div><!-- SiblingPic -->
                    <div class="col-md-6 SiblingInfo text-center">
                        <h4>Abdul Hannan Khan</h4>
                        <span class="otherInfo">
                            <small>11507 | 13-120</small>
                        </span><!-- otherInfo --><br />
                        <span class="gradeInfo">
                            <small>I-C</small>
                        </span><!-- gradeInfo --><br />
                        <span class="dateJoin">
                            <small>18-Oct-2006</small>
                        </span><!-- dateJoin --><br />
                        <span class="activeStatus">
                            <small><strong>Active</strong></small>
                        </span><!-- activeStatus -->
                    </div><!-- SiblingInfo -->
                </div><!-- col-md-6 -->
                <div class="col-md-6 childInfo">
                    <div class="col-md-6 SiblingPic">
                        <img src="http://10.10.10.63/gs/assets/photos/sis/150x150/student/11857.png" /><br />
                        <span class="houseInfo text-center">
                            <span class="iqbal">Iqbal</span>
                            <!-- <span class="syed">Syed</span>
                            <span class="jinnah">Jinnah</span> -->
                        </span><!-- houseInfo --><br />
                    </div><!-- SiblingPic -->
                    <div class="col-md-6 SiblingInfo text-center">
                        <h4>Abdul Hannan Khan</h4>
                        <span class="otherInfo">
                            <small>11507 | 13-120</small>
                        </span><!-- otherInfo --><br />
                        <span class="gradeInfo">
                            <small>I-C</small>
                        </span><!-- gradeInfo --><br />
                        <span class="dateJoin">
                            <small>18-Oct-2006</small>
                        </span><!-- dateJoin --><br />
                        <span class="activeStatus">
                            <small><strong>Active</strong></small>
                        </span><!-- activeStatus -->
                    </div><!-- SiblingInfo -->
                </div><!-- col-md-6 -->
                <div class="col-md-6 childInfo">
                    <div class="col-md-6 SiblingPic">
                        <img src="http://10.10.10.63/gs/assets/photos/sis/150x150/student/11857.png" /><br />
                        <span class="houseInfo text-center">
                            <span class="iqbal">Iqbal</span>
                            <!-- <span class="syed">Syed</span>
                            <span class="jinnah">Jinnah</span> -->
                        </span><!-- houseInfo --><br />
                    </div><!-- SiblingPic -->
                    <div class="col-md-6 SiblingInfo text-center">
                        <h4>Abdul Hannan Khan</h4>
                        <span class="otherInfo">
                            <small>11507 | 13-120</small>
                        </span><!-- otherInfo --><br />
                        <span class="gradeInfo">
                            <small>I-C</small>
                        </span><!-- gradeInfo --><br />
                        <span class="dateJoin">
                            <small>18-Oct-2006</small>
                        </span><!-- dateJoin --><br />
                        <span class="activeStatus">
                            <small><strong>Active</strong></small>
                        </span><!-- activeStatus -->
                    </div><!-- SiblingInfo -->
                </div><!-- col-md-6 -->
                
            </div><!-- Siblinginformation -->
            
            
            
         <!--/div -->
         <!-- tab-content-->
         
        </div><!-- modal-body -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- modal-content -->
      
    </div><!-- modal-dialog -->
</div><!-- modal -->
                  
          