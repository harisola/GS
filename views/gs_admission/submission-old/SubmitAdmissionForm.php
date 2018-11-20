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
                                        <input required="" name="father_mobile_phone[]" type="number" class="col-md-10" placeholder="Mobile" id="father_mobile" value="" style="padding-left:80px;" /> 
                                        <button class="add_field_button_father">+</button>
                                    </div><!-- input_fields_wrap --><br /><br />                                    
                                    </div>
                                    <input type="text" class="" placeholder="Father NIC *" name="father_nic" id="father_nic" /><br /><br />
                                    <input type="text" class="" placeholder="Father Email" name="father_email" id="father_email" />
                                </div>
                                <!-- col-md-6 -->
                                <div class="col-md-6">
                                    <input type="text" class="" placeholder="Mother Name *" name="mother_name" id="mother_name" /><br /><Br />
                                    <div class="motherContactArea">
                                    <div class="input_fields_wrap_father" style="margin-bottom: 14px;">
                                        <select required="" class="countryCodeNumber" name="mother_mobile_code[]">
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
                                        <input required="" name="mother_mobile_phone[]" type="number" class="col-md-10" placeholder="Mobile" id="mother_mobile" value="" style="padding-left:80px;" /> 
                                        <button class="add_field_button_mother">+</button>
                                        <br /><br />   
                                    </div><!-- input_fields_wrap -->   
                                    </div>   
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
                            
                            <div class="col-md-12">
                                <div class="alevelBox">
                                    <div class="col-md-12 paddingBottom0 alevel_checklist" style="padding-left: 0;" >
                                        <div class="col-md-12">
                                            <input type="checkbox" required="" id="as" name="alevel_supplement"  style="visibility:hidden;display:block;"> 
                                            <label for="as">Duly filled Admission Application Form and A-Level Supplement <span class="required">*</span></label>
                                        </div>
                                                                         
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
                                            <input type="checkbox" id="APCOSR" name="alevelCheckList[]" value="APCOSR" style="display:block;visibility:hidden;"> <label for="APCOSR">Attested Photo copy of school result for grade IX, X and XI (incl mocks) </label>
                                        </div>
                                        <!-- col-md-12 -->
                                        <!--  <div class="col-md-12 paddingBottom0">
                                            <input type="checkbox" id="ACMER" name="alevelCheckList[]" value="ACMER" style="display:block;visibility:hidden;"> <label for="ACMER">Attested copy mock exam result/first term result</label> 
                                        </div> -->  
                                        <!-- col-md-12 -->
                                        <div class="col-md-12 paddingBottom0">
                                            <input type="checkbox" id="PRFSSE" name="alevelCheckList[]" value="PRFSSE" style="display:block;visibility:hidden;"> <label for="PRFSSE">Principal recommendation form in school sealed envelope</label>
                                        </div>
                                        <!-- col-md-12 -->    
                                        <div class="col-md-12 paddingBottom0">
                                            <input type="checkbox" value="ACCIE"  id="ACCIE" name="alevelCheckList[]" style="display:block;visibility:hidden;"> <label for="ACCIE">Attested copy of CAIE Olevel Statement of Results</label>
                                        </div>
                                        <!-- col-md-12 -->    
                                        <!-- <div class="col-md-12 paddingBottom0">
                                            <input type="checkbox" value="ACFFR" id="ACFFR" name="alevelCheckList[]" style="display:block;visibility:hidden;"> <label for="ACFFR">Attested copies of full and final result</label>
                                        </div> -->  
                                        <!-- col-md-12 -->
                                        <div class="col-md-12 paddingBottom0">
                                            <input type="checkbox" value="CCFPS" id="CCFPS" name="alevelCheckList[]" style="display:block;visibility:hidden;"> <label for="CCFPS">Transfer / Leaving certificate from previous school.</label>
                                        </div>
                                        <!-- col-md-12 -->
                                        <div class="col-md-12 paddingBottom0">
                                            <input type="checkbox" value="PCCCA"  id="PCCCA" name="alevelCheckList[]" style="display:block;visibility:hidden;"> <label for="PCCCA">Copies of certificate of cross curricular activities</label>
                                        </div>
                                    <!-- col-md-12 -->    
                                    <!-- .col-md-12 -->
                                    </div>
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
                                            <?php if($fl['Grade_id'] == 15 || $fl['Grade_id'] == 16)  { ?>
                                                <li><a href="#" class="print_discussion_sheet" data-id="<?=$fl["Form_id"];?>">Print Discussion Sheet</a></li>
                                            <?php } ?>
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
.countryCodeNumber {
     position: absolute;
    top: 0;
    z-index: 1;
    width: 70px;
    text-align: center;
    border-bottom: 0;
    left: 0px;
    padding-bottom: 6px;
    font-size: 12px;
    padding-top: 7px;
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
    padding: 6px 6px;
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
    margin-bottom: 20px;
    float: left;
    width: 100%;
    margin-top: 20px;
}
.add_field_button {
    display: none;
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
    padding: 7px 6px; 
}    
em.invalid{
    display: none !important;
}
</style>