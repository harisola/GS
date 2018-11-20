<div class="MaroonBorderBox">
<form action="<?=base_url();?>index.php/gs_admission/ajax_base/get_data" method="POST" name="issuance" id="issuance" class="issuance">
<input type="hidden" name="FormAction" id="FormAction" value="1" />

<input type="hidden" name="Form_ID" id="Form_ID" value="<?=$data_id["Form_id"];?>" />
<input type="hidden" name="Fmly_Reg_ID" id="Fmly_Reg_ID" value="<?=$data_id["Family_reg_id"];?>" />
<input type="hidden" name="academic_session" id="academic_session" value="<?=$data_id["Academic"];?>" />

<input type="hidden" name="family_exists" id="family_exists" value="<?=$data_id["Gf_id"];?>" />
<?php if( $data_id["gt_id"] != '' && $data_id["gt_id"] != 0 ){ ?>
<input type="hidden" id="gt_id" name="gt_id" value=<?= $data_id["gt_id"] ?> />
<?php } ?>

<h3 class="relativeHead">Edit Applicant Details
<span class="pull-right">
<select name="campus" id="campus">
  <option value="0">Campus *</option>
  <option value="1" <?php if( $data_id["Campus"] == 1 ){ echo "selected"; } ?>> North</option>
  <option value="2" <?php if( $data_id["Campus"] == 2 ){ echo "selected"; } ?>> South</option>
</select>
</span>

 </h3>

<div class="inner">


<?php //var_dump( $data_id );

 ?>

<div class="col-md-12">
<div class="FatherNICShow">
<div class="col-md-3 text-right FatherNIC"><label class="">Father NIC</label> </div>
<div class="col-md-9"><input type="text" placeholder="XXXXX-XXXXXXX-X" name="f_nic" id="f_nic" value="<?=$data_id["Father_nic"];?>"  />
<!--span class="ifGFID"><a href="javascript:void(0)" class="GFIDClick">GF-ID</a></span--></div>
</div><!-- FatherNICShow -->
<div class="GFIDShow displayNone">
<div class="col-md-3 text-right FatherNIC"><label class="">GF ID</label> </div>
<div class="col-md-9"><input type="text" placeholder="XX-XXX" name="gf_id" id="gf_id" value="<?=$data_id["Gf_id"];?>" />
<!--span class="ifGFID"><a href="javascript:void(0)" class="FatherNICClick">Father NIC</a></span-->></div>
</div><!-- GFIDShow -->

<?php if( $data_id["gt_id"] != '' && $data_id["gt_id"] != 0 ){ ?>
 <div class="col-md-12 text-right">
  <a href="javascript:void(0)" class="show_gt_id" >GT ID: <?php echo $data_id["gt_id"]; ?></a>

</div><!-- col-md-6 -->
<?php }else{ ?>
<div class="col-md-12 text-right">
<a href="javascript:void(0)" class="show_gt_id" style="display:none;"></a>
</div><!-- col-md-6 -->
<?php } ?>
</div><!-- col-md-12 -->

<hr />

<div class="col-md-12 paddingBottom10">
<div class="col-md-6">
<input type="text" class="" name="token_no" id="token_no" value="<?php echo str_pad( $data_id["Token_no"],4,"0",STR_PAD_LEFT); ?>" />
</div><!-- col-md-6 -->

<div class="col-md-6">
<select name="gender" id="gender">
<option value="" disabled selected>Gender *</option>
<option value="B" <?php if( $data_id["Gender"] == "B"){ echo "selected"; }?>>Boy</option>
<option value="G" <?php if( $data_id["Gender"] == "G"){ echo "selected"; }?>>Girl</option>
</select>
					</div><!-- col-md-6 -->	
					

</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom10">
<div class="col-md-6">
<input type="text" class="" placeholder="Official Name *" name="official_name" id="official_name" value="<?=$data_id["Applicate_name"];?>" />
</div><!-- col-md-6 -->
<div class="col-md-6">
<input type="text" placeholder="Call Name *" name="call_name" id="call_name" value="<?=$data_id["Call_name"];?>" />
</div><!-- col-md-6 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom10">
<div class="col-md-6">
<!--input placeholder="Date of Birth *"  class="textbox-n" type="text" onfocus="(this.type='date')"  id="date_of_birth" onblur="(this.type='text')" name="date_of_birth" / -->

<input placeholder="Date of Birth *"  type="date"  id="date_of_birth" name="date_of_birth" class="date_of_birth" value="<?=$data_id["Dob"];?>" />

</div><!-- col-md-6 -->
  <div class="col-md-6">
	<input type="text" placeholder="Admission Grade *" name="admission_grade" id="admission_grade" value="<?=$data_id["Grade_name"];?>" readonly />
	<input type="hidden" name="admission_grade_id" id="admission_grade_id" value="<?=$data_id["Grade_id"];?>" />
</div><!-- col-md-6 -->
</div><!-- col-md-12 -->
                    <div class="col-md-12 paddingBottom10">
                      <div class="col-md-6">
                        <!--input placeholder="Date of Birth *"  class="textbox-n" type="text" onfocus="(this.type='date')"  id="date_of_birth" onblur="(this.type='text')" name="date_of_birth" / 
                        <input placeholder="Mobile *"  type="text"  id="" name="" class="" />-->
                        <div class="input_fields_wrap">
                         	<!-- <label>Mobile</label> -->
                          <?php if($data_id["Student_mobile"] != ''){
                          	$flag = 0;
                          	$data_id["Student_mobile"] = explode(',', $data_id["Student_mobile"]);
                            for($i=0; $i< count($data_id["Student_mobile"]); $i++){
                              $number = explode('-', $data_id["Student_mobile"][$i]);
                          ?>
                        	<div  class="dynamicPhone">
                     				<!-- <label>Mobile</label> -->
                              <select class="countryCodeNumber student_select_<?php echo $i; ?>"" name="student_mobile_code[]">
                                              <!-- Countries often selected by users can be moved to the top of the list. -->
                                              <!-- Countries known to be subject to general US embargo are commented out by default. -->
                                              <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->
                                            
                                              <option data-countryCode="US" value="1" selected>+1</option>
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
                                              <option data-countryCode="PK" value="92">+92</option>
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
                              <input name="student_mobile_phone[]" type="text" class="col-md-10" placeholder="Mobile" id="" value="<?php echo $number[1]; ?>" style="padding-left:60px;" /> 
                              <?php if($flag == 0) {
													      $flag = 1;
                            	?>
                              <button class="add_field_button">+</button>
                              <?php } else { ?>
                              <a href="#" class="remove_field1">X</a>
                              <?php } ?>
                          </div>
										      <script type="text/javascript">
                          	$(".student_select_"+ <?php echo $i; ?>).val("<?php echo $number[0]; ?>");
                          </script>                                        
                          <?php  }

                      		} ?> 
        				        </div><!-- input_fields_wrap -->
                      </div><!-- col-md-6 -->
                      <div class="col-md-6">
                        <input type="text" placeholder="Email *" name="student_email" id="student_email" value="<?php echo $data_id["Student_email"]; ?>"  />
                      </div><!-- col-md-6 -->
                    </div><!-- col-md-12 -->
                    <div class="col-md-12 paddingBottom10">
                      <div class="col-md-6">
                        <!--input placeholder="Date of Birth *"  class="textbox-n" type="text" onfocus="(this.type='date')"  id="date_of_birth" onblur="(this.type='text')" name="date_of_birth" / -->
                        <input placeholder="NIC/Passport *"  type="text"  id="student_nic" name="student_nic" class="date_of_birth" />
                      </div><!-- col-md-6 -->
                      <div class="col-md-6">                            
                        <input type="text" class="" placeholder="Referral Code" name="Referal_code" id="Referal_code" maxlength="6" minlength="6" value="<?php echo $data_id["referal_code"]; ?>" />
                      </div>
                    </div><!-- col-md-12 -->
                    <div class="col-md-12 paddingBottom10">
                      <div class="col-md-6">

                          <select id="batch" name="batch">
                            <?php foreach ($batch as  $batches) { ?>
                            <option value="<?= $batches['form_batch_id'] ?>|<?= $batches['batch_date'] ?>">
                              <?= $batches['batch_category'] ?> (<?= date('d-F-Y',strtotime($batches['batch_date'])) ?>)</option>
                            <?php } ?>
                          </select>
                      </div><!-- col-md-6 -->
                      <div class="col-md-6">
                          <select id="slots" name="slots">
                            <option value="<?php echo $data_id["Slot_id"]; ?>"><?php echo $data_id["form_assessment_time"]; ?></option>
                          </select>
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
						
						</div>
						
                    </div><!-- col-md-12 -->
<hr style="margin-top: 10px;" />
<div class="col-md-12 paddingBottom10">
<div class="col-md-6" style="margin-top:-18px;">

<?php if($data_id["single_parent"] == 1){ ?>
<input type="checkbox" id="c2" name="single_parent" checked style="display:block;visibility:hidden;"> 
<?php }else{ ?>
<input type="checkbox" id="c2" name="single_parent" style="display:block;visibility:hidden; "> 
<?php } ?> 
<label for="c2">Single Parent</label>
</div><!-- col-md-6 -->

<?php if( $data_id["gt_id"] != ''  && $data_id["gt_id"] != 0 ){ ?>
 <div class="col-md-3 text-right" style="padding: 0;">
  <a href="javascript:void(0)" class="show_gt_id" >GT ID: <?php echo $data_id["gt_id"]; ?></a>

</div><!-- col-md-6 -->
<?php }else{ ?>
<div class="col-md-3 text-right"  style="padding: 0;">
<a href="javascript:void(0)" class="show_gt_id" style="display:none;"></a>
</div><!-- col-md-6 -->
<?php } ?>

<?php if( $data_id["Gf_id"] != '' ){ ?>
 <div class="col-md-3 text-right">
	<a href="javascript:void(0)" id="show_fif">Show FIF</a>

</div><!-- col-md-6 -->
<?php }else{ ?>
<div class="col-md-3 text-right">
	<a href="javascript:void(0)" id="show_fif" style="display:none;">Show FIF</a>
</div><!-- col-md-6 -->
<?php } ?>
						
</div><!-- col-md-12 -->
<hr style="margin-top:0px;" />
<div class="col-md-12 paddingBottom10">
	<div class="col-md-6">
	<input type="radio" name="primary_contact" id="primary_contact1" value="0" <?php if($data_id["Primary_contact"] == 0){ echo "checked"; }?> > <label for="primary_contact1">Primary Contact Father</label><br /><br />
		<input type="text" class="" placeholder="Father Name *" name="father_name" id="father_name" value="<?=$data_id["Father_name"];?>" /><br /><br />
		    <div class="input_fields_wrap_father" style="margin-bottom: 14px;">
                           				<!-- <label>Mobile</label> -->
       <?php $flag = 0; if($data_id["Father_mobile"] != ''){ 
                           		$flag = 1;
                           		?>
                            	<div  class="dynamicPhone">
                           				<!-- <label>Mobile</label> -->
                                        <select class="countryCodeNumber" name="father_mobile_code[]">
                                              <!-- Countries often selected by users can be moved to the top of the list. -->
                                              <!-- Countries known to be subject to general US embargo are commented out by default. -->
                                              <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->
                                            
                                              <option data-countryCode="US" value="1" selected>+1</option>
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
                                            <input name="father_mobile_phone[]" type="text" class="col-md-10" placeholder="Mobile" id="" value="<?php echo str_replace("-","",substr( $data_id["Father_mobile"], 1)); ?>" style="padding-left:60px;" /> 
                                            <button class="add_field_button_father">+</button>
                                        </div>
                                <?php } else { ?>
                              <div  class="dynamicPhone">
                                  <!-- <label>Mobile</label> -->
                                        <select class="countryCodeNumber" name="father_mobile_code[]">
                                              <!-- Countries often selected by users can be moved to the top of the list. -->
                                              <!-- Countries known to be subject to general US embargo are commented out by default. -->
                                              <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->
                                            
                                              <option data-countryCode="US" value="1" selected>+1</option>
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
                                            <input name="father_mobile_phone[]" type="text" class="col-md-10" placeholder="Mobile" id=""  style="padding-left:60px;" /> 
                                            <button class="add_field_button_father">+</button>
                                        </div>
                               <?php } ?>                           				
                           		<?php if($data_id["Father_mobile_other"] != ''){

                                	$data_id["Father_mobile_other"] = explode(',', $data_id["Father_mobile_other"]);

                            	 for($i=0; $i< count($data_id["Father_mobile_other"]); $i++){ 
                            	 		$number = explode('-', $data_id["Father_mobile_other"][$i]);
                            	 	?>
                                            <div  class="dynamicPhone">
                                           <select class="countryCodeNumber father_select_<?php echo $i; ?>" name="father_mobile_code[]">
                                              <!-- Countries often selected by users can be moved to the top of the list. -->
                                              <!-- Countries known to be subject to general US embargo are commented out by default. -->
                                              <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->
                                            
                                              <option data-countryCode="US" value="1" selected>+1</option>
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
                                              <option data-countryCode="PK" value="92">+92</option>
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
                                            <input name="father_mobile_phone[]" type="text" class="col-md-10" placeholder="Mobile" id="" value="<?php echo $number[1]; ?>" style="padding-left:60px;" /> 
                                            <?php if($flag == 0) { ?> 

                                            	<button class="add_field_button_father">+</button>
                                            <?php } else {?>
												<a href="#" class="remove_field1">X</a>
                                            <?php } ?>
                                            
                                        </div>
                                        <script type="text/javascript">
                                        	$(".father_select_"+ <?php echo $i; ?>).val("<?php echo $number[0]; ?>");
                                        </script>
                                    <?php $flag = 1; } 
                                    		}?>
                      				          </div><!-- input_fields_wrap --><br /><br />
		<!--<input type="text" class="" placeholder="Father Mobile *" name="father_mobile" id="father_mobile" value="<?=$data_id["Father_mobile"];?>" /><br /><br />-->
		<input type="text" class="" placeholder="Father NIC *" name="father_nic" id="father_nic" value="<?=$data_id["Father_nic"];?>" /><br /><br />
		<input type="text" class="" placeholder="Father Email" name="father_email" id="father_email" value="<?=$data_id["Father_email"];?>" />
	</div><!-- col-md-6 -->
	<div class="col-md-6">
	<input type="radio" name="primary_contact" id="primary_contact2" value="1" <?php if($data_id["Primary_contact"] == 1){ echo "checked"; }?>> <label for="primary_contact2">Primary Contact Mother</label><br /><br />
	
		<input type="text" class="" placeholder="Mother Name" name="mother_name" id="mother_name" value="<?=$data_id["Mother_name"];?>" /><br /><br />
                        	
                            <div class="input_fields_wrap_mother" style="margin-bottom: 14px;">
							<?php if($data_id["Mother_mobile"] != ''){  $flag = 1; ?>
                            	<div  class="dynamicPhone">
                           				<!-- <label>Mobile</label> -->
                                        <select class="countryCodeNumber" name="mother_mobile_code[]">
                                              <!-- Countries often selected by users can be moved to the top of the list. -->
                                              <!-- Countries known to be subject to general US embargo are commented out by default. -->
                                              <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->
                                            
                                              <option data-countryCode="US" value="1" selected>+1</option>
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
                                            <input name="mother_mobile_phone[]" type="text" class="col-md-10" placeholder="Mobile" id="" value="<?php echo str_replace("-","",substr( $data_id["Mother_mobile"], 1)); ?>" style="padding-left:60px;" /> 
                                            <button class="add_field_button_mother">+</button>
                                        </div>
                                <?php } else { ?>
                                                <div  class="dynamicPhone">
                                  <!-- <label>Mobile</label> -->
                                        <select class="countryCodeNumber" name="mother_mobile_code[]">
                                              <!-- Countries often selected by users can be moved to the top of the list. -->
                                              <!-- Countries known to be subject to general US embargo are commented out by default. -->
                                              <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->
                                            
                                              <option data-countryCode="US" value="1" selected>+1</option>
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
                                            <input name="mother_mobile_phone[]" type="text" class="col-md-10" placeholder="Mobile" id=""  style="padding-left:60px;" /> 
                                            <button class="add_field_button_mother">+</button>
                                        </div>
                                <?php } ?>
                                <?php $flag = 0; if($data_id["Mother_mobile_other"] != ''){

                                	$data_id["Mother_mobile_other"] = explode(',', $data_id["Mother_mobile_other"]);

                            	 for($i=0; $i< count($data_id["Mother_mobile_other"]); $i++){ 
                            	 		$number = explode('-', $data_id["Mother_mobile_other"][$i]);

                            	 	?>
                            	<div  class="dynamicPhone">
                           				<!-- <label>Mobile</label> -->
                                        <select class="countryCodeNumber mother_select_<?php echo $i; ?>"" name="mother_mobile_code[]">
                                              <!-- Countries often selected by users can be moved to the top of the list. -->
                                              <!-- Countries known to be subject to general US embargo are commented out by default. -->
                                              <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->
                                            
                                              <option data-countryCode="US" value="1" selected>+1</option>
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
                                              <option data-countryCode="PK" value="92">+92</option>
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
                                            <input name="mother_mobile_phone[]" type="text" class="col-md-10" placeholder="Mobile" id="" value="<?php echo $number[1]; ?>" style="padding-left:60px;" /> 
                                            <?php if($flag == 0) { ?> 

                                            	<button class="add_field_button_father">+</button>
                                            <?php } else {?>
												<a href="#" class="remove_field1">X</a>
                                            <?php } ?>
                                        </div>
										<script type="text/javascript">
                                        	$(".mother_select_"+ <?php echo $i; ?>).val("<?php echo $number[0]; ?>");
                                        </script>                                        
                                <?php $flag = 1; }

                            		} ?>
                        				</div><!-- input_fields_wrap --><br /><br />

		<!--<input type="text" class="" placeholder="Mother Mobile" name="mother_mobile" id="mother_mobile" value="<?=$data_id["Mother_mobile"];?>" /><br /><br />-->
		<input type="text" class="" placeholder="Mother NIC" name="mother_nic" id="mother_nic" value="<?=$data_id["Mother_nic"];?>" /><br /><br />
		<input type="text" class="" placeholder="Mother Email" name="mother_email" id="mother_email" value="<?=$data_id["Mother_email"];?>" />
	</div><!-- col-md-6 -->
</div><!-- col-md-12 -->


<hr />
<div class="col-md-12">
<div class="col-md-12">
<textarea placeholder="Comments" rows="4" cols="50" name="comments" id="comments"><?=$data_id["Comments"];?></textarea>
</div><!-- col-md-12 -->
</div><!-- col-md-12 -->
<hr />
<div class="col-md-12 paddingBottom0">
<div class="col-md-6"  style="margin-top: -20px;">
<input type="checkbox" id="ps" name="photo_submitted" <?php if( $data_id["Photo_submitted"] == 1){ echo "checked"; }?> style="display:block;visibility:hidden;"> <label for="ps">Photos Submitted</label>
</div><!-- col-md-6 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom0">
<div class="col-md-6" style="margin-top: -10px;">
<input type="checkbox" id="bco" name="birth_certificate_o" <?php if( $data_id["Birth_o"] == 1){ echo "checked"; }?> style="display:block;visibility:hidden;"> <label for="bco">Birth Certificate (O)</label>
</div><!-- col-md-6 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom0">
<div class="col-md-6" style="margin-top: -10px;">
<input type="checkbox" id="bcc" name="birth_certificate_c" <?php if( $data_id["Birth_c"] == 1){ echo "checked"; }?> style="display:block;visibility:hidden;"> <label for="bcc">Birth Certificate (C)</label>
</div><!-- col-md-6 -->
</div><!-- col-md-12 -->
<?php if($data_id["Grade_id"] == 15 || $data_id["Grade_id"] == 16) {?>
<div class="col-md-12 paddingBottom0 alevel_checklist" >
  <div class="col-md-12" style="margin-top: -10px;">
    <input type="checkbox" id="as" name="alevel_supplement" <?php if( $data_id["Alevel_supplement"] == 1){ echo "checked"; }?> style="visibility:hidden;display:block;"> <label for="as">Duly filled Admission Application Form and A-Level Supplement</label>
    </div><!-- col-md-6 -->
</div><!-- col-md-12 -->
<?php } ?>     
<hr />
<div class="col-md-12">

<div class="col-md-6">
<input type="submit" name="submit" class="greenBTN" id="greenBTN" value="Print & Update" />
</div>
<div class="col-md-6">
<input type="button" name="clear" class="grayBTN" id="greenBTN2" value="Clear" />
</div>

<style>
.dynamicPhone:first-child {
	margin-top: 0px;
}
.dynamicPhone {
    position: relative;
    float: left;
   margin-bottom: 0px !important ; 
}
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
</style>		


<section class="col col-6">

<div style="margin-bottom: 0;margin-top: 0;min-height: 0;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="ajaxloader">
<img src="<?php echo base_url();?>/components/image/ajax-loader.gif">
</div>

<div class="callout callout-info" style="margin-bottom: 0;margin-top: 0;min-height: 0;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="calloutMessage">
<p>Admission Information Noted!</p>
</div>


<div class="callout callout-danger" style="margin-bottom: 0;margin-top: 0;min-height: 0;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="calloutMessageError">
<p> Card Error </p>
</div>
</section>


</div><!-- col-md-12 -->

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
    padding: 4px 4px;
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
    margin-top: 13px;
    float: left;
    width: 100%;
}
.input_fields_wrap_additional {
    margin: 10px 0 0 0px !important;
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

</div><!-- inner -->
</form>
</div><!-- .MaroonBorderBox -->
<script>
$(document).ready(function() {
    var max_fields      = 2; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
  var wrapper1        = $(".input_fields_wrap_father"); //Fields wrapper
  var wrapper2         = $(".input_fields_wrap_mother"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
  var add_button1      = $(".add_field_button_father"); //Add button ID
  var add_button2      = $(".add_field_button_mother"); //Add button ID
    
    var x = 1;
    var x1 = 1;
    var x2 = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="input_fields_wrap_additional"><select class="countryCodeNumber" name="student_mobile_code[]"> <!-- Countries often selected by users can be moved to the top of the list. --> <!-- Countries known to be subject to general US embargo are commented out by default. --> <!-- The data-countryCode attribute is populated with ISO country code, and value is int l calling code. --> <option data-countryCode="US" value="1" selected>+1</option> <option data-countryCode="GB" value="44">+44</option> <option data-countryCode="DZ" value="213">+213</option> <option data-countryCode="AD" value="376">+376</option> <option data-countryCode="AO" value="244">+244</option> <option data-countryCode="AI" value="1264">+1264</option> <option data-countryCode="AG" value="1268">+1268</option> <option data-countryCode="AR" value="54">+54</option> <option data-countryCode="AM" value="374">+374</option> <option data-countryCode="AW" value="297">+297</option> <option data-countryCode="AU" value="61">+61</option> <option data-countryCode="AT" value="43">+43</option> <option data-countryCode="AZ" value="994">+994</option> <option data-countryCode="BS" value="1242">+1242</option> <option data-countryCode="BH" value="973">+973</option> <option data-countryCode="BD" value="880">+880</option> <option data-countryCode="BB" value="1246">+1246</option> <option data-countryCode="BY" value="375">+375</option> <option data-countryCode="BE" value="32">+32</option> <option data-countryCode="BZ" value="501">+501</option> <option data-countryCode="BJ" value="229">+229</option> <option data-countryCode="BM" value="1441">+1441</option> <option data-countryCode="BT" value="975">+975</option> <option data-countryCode="BO" value="591">+591</option> <option data-countryCode="BA" value="387">+387</option> <option data-countryCode="BW" value="267">+267</option> <option data-countryCode="BR" value="55">+55</option> <option data-countryCode="BN" value="673">+673</option> <option data-countryCode="BG" value="359">+359</option> <option data-countryCode="BF" value="226">+226</option> <option data-countryCode="BI" value="257">+257</option> <option data-countryCode="KH" value="855">+855</option> <option data-countryCode="CM" value="237">+237</option> <option data-countryCode="CA" value="1">+1</option> <option data-countryCode="CV" value="238">+238</option> <option data-countryCode="KY" value="1345">+1345</option> <option data-countryCode="CF" value="236">+236</option> <option data-countryCode="CL" value="56">+56</option> <option data-countryCode="CN" value="86">+86</option> <option data-countryCode="CO" value="57">+57</option> <option data-countryCode="KM" value="269">+269</option> <option data-countryCode="CG" value="242">+242</option> <option data-countryCode="CK" value="682">+682</option> <option data-countryCode="CR" value="506">+506</option> <option data-countryCode="HR" value="385">+385</option> <!-- <option data-countryCode="CU" value="53">Cuba +53</option> --> <option data-countryCode="CY" value="90">+90</option> <option data-countryCode="CY" value="357">+357</option> <option data-countryCode="CZ" value="420">+420</option> <option data-countryCode="DK" value="45">+45</option> <option data-countryCode="DJ" value="253">+253</option> <option data-countryCode="DM" value="1809">+1809</option> <option data-countryCode="DO" value="1809">+1809</option> <option data-countryCode="EC" value="593">+593</option> <option data-countryCode="EG" value="20">+20</option> <option data-countryCode="SV" value="503">+503</option> <option data-countryCode="GQ" value="240">+240</option> <option data-countryCode="ER" value="291">+291</option> <option data-countryCode="EE" value="372">+372</option> <option data-countryCode="ET" value="251">+251</option> <option data-countryCode="FK" value="500">+500</option> <option data-countryCode="FO" value="298">+298</option> <option data-countryCode="FJ" value="679">+679</option> <option data-countryCode="FI" value="358">+358</option> <option data-countryCode="FR" value="33">+33</option> <option data-countryCode="GF" value="594">+594</option> <option data-countryCode="PF" value="689">+689</option> <option data-countryCode="GA" value="241">+241</option> <option data-countryCode="GM" value="220">+220</option> <option data-countryCode="GE" value="7880">+7880</option> <option data-countryCode="DE" value="49">+49</option> <option data-countryCode="GH" value="233">+233</option> <option data-countryCode="GI" value="350">+350</option> <option data-countryCode="GR" value="30">+30</option> <option data-countryCode="GL" value="299">+299</option> <option data-countryCode="GD" value="1473">+1473</option> <option data-countryCode="GP" value="590">+590</option> <option data-countryCode="GU" value="671">+671</option> <option data-countryCode="GT" value="502">+502</option> <option data-countryCode="GN" value="224">+224</option> <option data-countryCode="GW" value="245">+245</option> <option data-countryCode="GY" value="592">+592</option> <option data-countryCode="HT" value="509">+509</option> <option data-countryCode="HN" value="504">+504</option> <option data-countryCode="HK" value="852">+852</option> <option data-countryCode="HU" value="36">+36</option> <option data-countryCode="IS" value="354">+354</option> <option data-countryCode="IN" value="91">+91</option> <option data-countryCode="ID" value="62">+62</option> <option data-countryCode="IQ" value="964">+964</option> <!-- <option data-countryCode="IR" value="98">Iran +98</option> --> <option data-countryCode="IE" value="353">+353</option> <option data-countryCode="IL" value="972">+972</option> <option data-countryCode="IT" value="39">+39</option> <option data-countryCode="JM" value="1876">+1876</option> <option data-countryCode="JP" value="81">+81</option> <option data-countryCode="JO" value="962">+962</option> <option data-countryCode="KZ" value="7">+7</option> <option data-countryCode="KE" value="254">+254</option> <option data-countryCode="KI" value="686">+686</option> <option data-countryCode="KR" value="82">+82</option> <option data-countryCode="KW" value="965">+965</option> <option data-countryCode="KG" value="996">+996</option> <option data-countryCode="LA" value="856">+856</option> <option data-countryCode="LV" value="371">+371</option> <option data-countryCode="LB" value="961">+961</option> <option data-countryCode="LS" value="266">+266</option> <option data-countryCode="LR" value="231">+231</option> <option data-countryCode="LY" value="218">+218</option> <option data-countryCode="LI" value="417">+417</option> <option data-countryCode="LT" value="370">+370</option> <option data-countryCode="LU" value="352">+352</option> <option data-countryCode="MO" value="853">+853</option> <option data-countryCode="MK" value="389">+389</option> <option data-countryCode="MG" value="261">+261</option> <option data-countryCode="MW" value="265">+265</option> <option data-countryCode="MY" value="60">+60</option> <option data-countryCode="MV" value="960">+960</option> <option data-countryCode="ML" value="223">+223</option> <option data-countryCode="MT" value="356">+356</option> <option data-countryCode="MH" value="692">+692</option> <option data-countryCode="MQ" value="596">+596</option> <option data-countryCode="MR" value="222">+222</option> <option data-countryCode="YT" value="269">+269</option> <option data-countryCode="MX" value="52">+52</option> <option data-countryCode="FM" value="691">+691</option> <option data-countryCode="MD" value="373">+373</option> <option data-countryCode="MC" value="377">+377</option> <option data-countryCode="MN" value="976">+976</option> <option data-countryCode="MS" value="1664">+1664</option> <option data-countryCode="MA" value="212">+212</option> <option data-countryCode="MZ" value="258">+258</option> <option data-countryCode="MN" value="95">+95</option> <option data-countryCode="NA" value="264">+264</option> <option data-countryCode="NR" value="674">+674</option> <option data-countryCode="NP" value="977">+977</option> <option data-countryCode="NL" value="31">+31</option> <option data-countryCode="NC" value="687">+687</option> <option data-countryCode="NZ" value="64">+64</option> <option data-countryCode="NI" value="505">+505</option> <option data-countryCode="NE" value="227">+227</option> <option data-countryCode="NG" value="234">+234</option> <option data-countryCode="NU" value="683">+683</option> <option data-countryCode="NF" value="672">+672</option> <option data-countryCode="NP" value="670">+670</option> <option data-countryCode="NO" value="47">+47</option> <option data-countryCode="OM" value="968">+968</option> <option data-countryCode="PK" value="92" selected >+92</option> <option data-countryCode="PW" value="680">+680</option> <option data-countryCode="PA" value="507">+507</option> <option data-countryCode="PG" value="675">+675</option> <option data-countryCode="PY" value="595">+595</option> <option data-countryCode="PE" value="51">+51</option> <option data-countryCode="PH" value="63">+63</option> <option data-countryCode="PL" value="48">+48</option> <option data-countryCode="PT" value="351">+351</option> <option data-countryCode="PR" value="1787">+1787</option> <option data-countryCode="QA" value="974">+974</option> <option data-countryCode="RE" value="262">+262</option> <option data-countryCode="RO" value="40">+40</option> <option data-countryCode="RU" value="7">+7</option> <option data-countryCode="RW" value="250">+250</option> <option data-countryCode="SM" value="378">+378</option> <option data-countryCode="ST" value="239">+239</option> <option data-countryCode="SA" value="966">+966</option> <option data-countryCode="SN" value="221">+221</option> <option data-countryCode="CS" value="381">+381</option> <option data-countryCode="SC" value="248">+248</option> <option data-countryCode="SL" value="232">+232</option> <option data-countryCode="SG" value="65">+65</option> <option data-countryCode="SK" value="421">+421</option> <option data-countryCode="SI" value="386">+386</option> <option data-countryCode="SB" value="677">+677</option> <option data-countryCode="SO" value="252">+252</option> <option data-countryCode="ZA" value="27">+27</option> <option data-countryCode="ES" value="34">+34</option> <option data-countryCode="LK" value="94">+94</option> <option data-countryCode="SH" value="290">+290</option> <option data-countryCode="KN" value="1869">+1869</option> <option data-countryCode="SC" value="1758">+1758</option> <option data-countryCode="SR" value="597">+597</option> <option data-countryCode="SD" value="249">+249</option> <option data-countryCode="SZ" value="268">+268</option> <option data-countryCode="SE" value="46">+46</option> <option data-countryCode="CH" value="41">+41</option> <!-- <option data-countryCode="SY" value="963">Syria +963</option> --> <option data-countryCode="TW" value="886">+886</option> <option data-countryCode="TJ" value="992">+992</option> <option data-countryCode="TH" value="66">+66</option> <option data-countryCode="TG" value="228">+228</option> <option data-countryCode="TO" value="676">+676</option> <option data-countryCode="TT" value="1868">+1868</option> <option data-countryCode="TN" value="216">+216</option> <option data-countryCode="TR" value="90">+90</option> <option data-countryCode="TM" value="993">+993</option> <option data-countryCode="TC" value="1649">+1649</option> <option data-countryCode="TV" value="688">+688</option> <option data-countryCode="UG" value="256">+256</option> <option data-countryCode="UA" value="380">+380</option> <option data-countryCode="AE" value="971">+971</option> <option data-countryCode="UY" value="598">+598</option> <option data-countryCode="UZ" value="998">+998</option> <option data-countryCode="VU" value="678">+678</option> <option data-countryCode="VA" value="379">+379</option> <option data-countryCode="VE" value="58">+58</option> <option data-countryCode="VN" value="84">+84</option> <option data-countryCode="VG" value="1">+1</option> <option data-countryCode="VI" value="1">+1</option> <option data-countryCode="WF" value="681">+681</option> <option data-countryCode="YE" value="969">+969</option> <option data-countryCode="YE" value="967">+967</option> <option data-countryCode="ZM" value="260">+260</option> <option data-countryCode="ZW" value="263">+263</option> </select><input name="student_mobile_phone[]" type="text" class="col-md-10" placeholder="Mobile" id="" value="" style="padding-left:60px;" /> <a href="#" class="remove_field">X</a></div>'); //add input box
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
            $(wrapper1).append('<div class="input_fields_wrap_additional_father"><select class="countryCodeNumber" name="father_mobile_code[]"> <!-- Countries often selected by users can be moved to the top of the list. --> <!-- Countries known to be subject to general US embargo are commented out by default. --> <!-- The data-countryCode attribute is populated with ISO country code, and value is int l calling code. --> <option data-countryCode="US" value="1" selected>+1</option> <option data-countryCode="GB" value="44">+44</option> <option data-countryCode="DZ" value="213">+213</option> <option data-countryCode="AD" value="376">+376</option> <option data-countryCode="AO" value="244">+244</option> <option data-countryCode="AI" value="1264">+1264</option> <option data-countryCode="AG" value="1268">+1268</option> <option data-countryCode="AR" value="54">+54</option> <option data-countryCode="AM" value="374">+374</option> <option data-countryCode="AW" value="297">+297</option> <option data-countryCode="AU" value="61">+61</option> <option data-countryCode="AT" value="43">+43</option> <option data-countryCode="AZ" value="994">+994</option> <option data-countryCode="BS" value="1242">+1242</option> <option data-countryCode="BH" value="973">+973</option> <option data-countryCode="BD" value="880">+880</option> <option data-countryCode="BB" value="1246">+1246</option> <option data-countryCode="BY" value="375">+375</option> <option data-countryCode="BE" value="32">+32</option> <option data-countryCode="BZ" value="501">+501</option> <option data-countryCode="BJ" value="229">+229</option> <option data-countryCode="BM" value="1441">+1441</option> <option data-countryCode="BT" value="975">+975</option> <option data-countryCode="BO" value="591">+591</option> <option data-countryCode="BA" value="387">+387</option> <option data-countryCode="BW" value="267">+267</option> <option data-countryCode="BR" value="55">+55</option> <option data-countryCode="BN" value="673">+673</option> <option data-countryCode="BG" value="359">+359</option> <option data-countryCode="BF" value="226">+226</option> <option data-countryCode="BI" value="257">+257</option> <option data-countryCode="KH" value="855">+855</option> <option data-countryCode="CM" value="237">+237</option> <option data-countryCode="CA" value="1">+1</option> <option data-countryCode="CV" value="238">+238</option> <option data-countryCode="KY" value="1345">+1345</option> <option data-countryCode="CF" value="236">+236</option> <option data-countryCode="CL" value="56">+56</option> <option data-countryCode="CN" value="86">+86</option> <option data-countryCode="CO" value="57">+57</option> <option data-countryCode="KM" value="269">+269</option> <option data-countryCode="CG" value="242">+242</option> <option data-countryCode="CK" value="682">+682</option> <option data-countryCode="CR" value="506">+506</option> <option data-countryCode="HR" value="385">+385</option> <!-- <option data-countryCode="CU" value="53">Cuba +53</option> --> <option data-countryCode="CY" value="90">+90</option> <option data-countryCode="CY" value="357">+357</option> <option data-countryCode="CZ" value="420">+420</option> <option data-countryCode="DK" value="45">+45</option> <option data-countryCode="DJ" value="253">+253</option> <option data-countryCode="DM" value="1809">+1809</option> <option data-countryCode="DO" value="1809">+1809</option> <option data-countryCode="EC" value="593">+593</option> <option data-countryCode="EG" value="20">+20</option> <option data-countryCode="SV" value="503">+503</option> <option data-countryCode="GQ" value="240">+240</option> <option data-countryCode="ER" value="291">+291</option> <option data-countryCode="EE" value="372">+372</option> <option data-countryCode="ET" value="251">+251</option> <option data-countryCode="FK" value="500">+500</option> <option data-countryCode="FO" value="298">+298</option> <option data-countryCode="FJ" value="679">+679</option> <option data-countryCode="FI" value="358">+358</option> <option data-countryCode="FR" value="33">+33</option> <option data-countryCode="GF" value="594">+594</option> <option data-countryCode="PF" value="689">+689</option> <option data-countryCode="GA" value="241">+241</option> <option data-countryCode="GM" value="220">+220</option> <option data-countryCode="GE" value="7880">+7880</option> <option data-countryCode="DE" value="49">+49</option> <option data-countryCode="GH" value="233">+233</option> <option data-countryCode="GI" value="350">+350</option> <option data-countryCode="GR" value="30">+30</option> <option data-countryCode="GL" value="299">+299</option> <option data-countryCode="GD" value="1473">+1473</option> <option data-countryCode="GP" value="590">+590</option> <option data-countryCode="GU" value="671">+671</option> <option data-countryCode="GT" value="502">+502</option> <option data-countryCode="GN" value="224">+224</option> <option data-countryCode="GW" value="245">+245</option> <option data-countryCode="GY" value="592">+592</option> <option data-countryCode="HT" value="509">+509</option> <option data-countryCode="HN" value="504">+504</option> <option data-countryCode="HK" value="852">+852</option> <option data-countryCode="HU" value="36">+36</option> <option data-countryCode="IS" value="354">+354</option> <option data-countryCode="IN" value="91">+91</option> <option data-countryCode="ID" value="62">+62</option> <option data-countryCode="IQ" value="964">+964</option> <!-- <option data-countryCode="IR" value="98">Iran +98</option> --> <option data-countryCode="IE" value="353">+353</option> <option data-countryCode="IL" value="972">+972</option> <option data-countryCode="IT" value="39">+39</option> <option data-countryCode="JM" value="1876">+1876</option> <option data-countryCode="JP" value="81">+81</option> <option data-countryCode="JO" value="962">+962</option> <option data-countryCode="KZ" value="7">+7</option> <option data-countryCode="KE" value="254">+254</option> <option data-countryCode="KI" value="686">+686</option> <option data-countryCode="KR" value="82">+82</option> <option data-countryCode="KW" value="965">+965</option> <option data-countryCode="KG" value="996">+996</option> <option data-countryCode="LA" value="856">+856</option> <option data-countryCode="LV" value="371">+371</option> <option data-countryCode="LB" value="961">+961</option> <option data-countryCode="LS" value="266">+266</option> <option data-countryCode="LR" value="231">+231</option> <option data-countryCode="LY" value="218">+218</option> <option data-countryCode="LI" value="417">+417</option> <option data-countryCode="LT" value="370">+370</option> <option data-countryCode="LU" value="352">+352</option> <option data-countryCode="MO" value="853">+853</option> <option data-countryCode="MK" value="389">+389</option> <option data-countryCode="MG" value="261">+261</option> <option data-countryCode="MW" value="265">+265</option> <option data-countryCode="MY" value="60">+60</option> <option data-countryCode="MV" value="960">+960</option> <option data-countryCode="ML" value="223">+223</option> <option data-countryCode="MT" value="356">+356</option> <option data-countryCode="MH" value="692">+692</option> <option data-countryCode="MQ" value="596">+596</option> <option data-countryCode="MR" value="222">+222</option> <option data-countryCode="YT" value="269">+269</option> <option data-countryCode="MX" value="52">+52</option> <option data-countryCode="FM" value="691">+691</option> <option data-countryCode="MD" value="373">+373</option> <option data-countryCode="MC" value="377">+377</option> <option data-countryCode="MN" value="976">+976</option> <option data-countryCode="MS" value="1664">+1664</option> <option data-countryCode="MA" value="212">+212</option> <option data-countryCode="MZ" value="258">+258</option> <option data-countryCode="MN" value="95">+95</option> <option data-countryCode="NA" value="264">+264</option> <option data-countryCode="NR" value="674">+674</option> <option data-countryCode="NP" value="977">+977</option> <option data-countryCode="NL" value="31">+31</option> <option data-countryCode="NC" value="687">+687</option> <option data-countryCode="NZ" value="64">+64</option> <option data-countryCode="NI" value="505">+505</option> <option data-countryCode="NE" value="227">+227</option> <option data-countryCode="NG" value="234">+234</option> <option data-countryCode="NU" value="683">+683</option> <option data-countryCode="NF" value="672">+672</option> <option data-countryCode="NP" value="670">+670</option> <option data-countryCode="NO" value="47">+47</option> <option data-countryCode="OM" value="968">+968</option> <option data-countryCode="PK" value="92" selected>+92</option> <option data-countryCode="PW" value="680">+680</option> <option data-countryCode="PA" value="507">+507</option> <option data-countryCode="PG" value="675">+675</option> <option data-countryCode="PY" value="595">+595</option> <option data-countryCode="PE" value="51">+51</option> <option data-countryCode="PH" value="63">+63</option> <option data-countryCode="PL" value="48">+48</option> <option data-countryCode="PT" value="351">+351</option> <option data-countryCode="PR" value="1787">+1787</option> <option data-countryCode="QA" value="974">+974</option> <option data-countryCode="RE" value="262">+262</option> <option data-countryCode="RO" value="40">+40</option> <option data-countryCode="RU" value="7">+7</option> <option data-countryCode="RW" value="250">+250</option> <option data-countryCode="SM" value="378">+378</option> <option data-countryCode="ST" value="239">+239</option> <option data-countryCode="SA" value="966">+966</option> <option data-countryCode="SN" value="221">+221</option> <option data-countryCode="CS" value="381">+381</option> <option data-countryCode="SC" value="248">+248</option> <option data-countryCode="SL" value="232">+232</option> <option data-countryCode="SG" value="65">+65</option> <option data-countryCode="SK" value="421">+421</option> <option data-countryCode="SI" value="386">+386</option> <option data-countryCode="SB" value="677">+677</option> <option data-countryCode="SO" value="252">+252</option> <option data-countryCode="ZA" value="27">+27</option> <option data-countryCode="ES" value="34">+34</option> <option data-countryCode="LK" value="94">+94</option> <option data-countryCode="SH" value="290">+290</option> <option data-countryCode="KN" value="1869">+1869</option> <option data-countryCode="SC" value="1758">+1758</option> <option data-countryCode="SR" value="597">+597</option> <option data-countryCode="SD" value="249">+249</option> <option data-countryCode="SZ" value="268">+268</option> <option data-countryCode="SE" value="46">+46</option> <option data-countryCode="CH" value="41">+41</option> <!-- <option data-countryCode="SY" value="963">Syria +963</option> --> <option data-countryCode="TW" value="886">+886</option> <option data-countryCode="TJ" value="992">+992</option> <option data-countryCode="TH" value="66">+66</option> <option data-countryCode="TG" value="228">+228</option> <option data-countryCode="TO" value="676">+676</option> <option data-countryCode="TT" value="1868">+1868</option> <option data-countryCode="TN" value="216">+216</option> <option data-countryCode="TR" value="90">+90</option> <option data-countryCode="TM" value="993">+993</option> <option data-countryCode="TC" value="1649">+1649</option> <option data-countryCode="TV" value="688">+688</option> <option data-countryCode="UG" value="256">+256</option> <option data-countryCode="UA" value="380">+380</option> <option data-countryCode="AE" value="971">+971</option> <option data-countryCode="UY" value="598">+598</option> <option data-countryCode="UZ" value="998">+998</option> <option data-countryCode="VU" value="678">+678</option> <option data-countryCode="VA" value="379">+379</option> <option data-countryCode="VE" value="58">+58</option> <option data-countryCode="VN" value="84">+84</option> <option data-countryCode="VG" value="1">+1</option> <option data-countryCode="VI" value="1">+1</option> <option data-countryCode="WF" value="681">+681</option> <option data-countryCode="YE" value="969">+969</option> <option data-countryCode="YE" value="967">+967</option> <option data-countryCode="ZM" value="260">+260</option> <option data-countryCode="ZW" value="263">+263</option> </select><input type="text" class="col-md-10" placeholder="Mobile" id="" value="" style="padding-left:60px;" name="father_mobile_phone[]" /> <a href="#" class="remove_field1">X</a></div>'); //add input box
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
            $(wrapper2).append('<div class="input_fields_wrap_additional_mother"><select class="countryCodeNumber" name="mother_mobile_code[]"> <!-- Countries often selected by users can be moved to the top of the list. --> <!-- Countries known to be subject to general US embargo are commented out by default. --> <!-- The data-countryCode attribute is populated with ISO country code, and value is int l calling code. --> <option data-countryCode="US" value="1" selected>+1</option> <option data-countryCode="GB" value="44">+44</option> <option data-countryCode="DZ" value="213">+213</option> <option data-countryCode="AD" value="376">+376</option> <option data-countryCode="AO" value="244">+244</option> <option data-countryCode="AI" value="1264">+1264</option> <option data-countryCode="AG" value="1268">+1268</option> <option data-countryCode="AR" value="54">+54</option> <option data-countryCode="AM" value="374">+374</option> <option data-countryCode="AW" value="297">+297</option> <option data-countryCode="AU" value="61">+61</option> <option data-countryCode="AT" value="43">+43</option> <option data-countryCode="AZ" value="994">+994</option> <option data-countryCode="BS" value="1242">+1242</option> <option data-countryCode="BH" value="973">+973</option> <option data-countryCode="BD" value="880">+880</option> <option data-countryCode="BB" value="1246">+1246</option> <option data-countryCode="BY" value="375">+375</option> <option data-countryCode="BE" value="32">+32</option> <option data-countryCode="BZ" value="501">+501</option> <option data-countryCode="BJ" value="229">+229</option> <option data-countryCode="BM" value="1441">+1441</option> <option data-countryCode="BT" value="975">+975</option> <option data-countryCode="BO" value="591">+591</option> <option data-countryCode="BA" value="387">+387</option> <option data-countryCode="BW" value="267">+267</option> <option data-countryCode="BR" value="55">+55</option> <option data-countryCode="BN" value="673">+673</option> <option data-countryCode="BG" value="359">+359</option> <option data-countryCode="BF" value="226">+226</option> <option data-countryCode="BI" value="257">+257</option> <option data-countryCode="KH" value="855">+855</option> <option data-countryCode="CM" value="237">+237</option> <option data-countryCode="CA" value="1">+1</option> <option data-countryCode="CV" value="238">+238</option> <option data-countryCode="KY" value="1345">+1345</option> <option data-countryCode="CF" value="236">+236</option> <option data-countryCode="CL" value="56">+56</option> <option data-countryCode="CN" value="86">+86</option> <option data-countryCode="CO" value="57">+57</option> <option data-countryCode="KM" value="269">+269</option> <option data-countryCode="CG" value="242">+242</option> <option data-countryCode="CK" value="682">+682</option> <option data-countryCode="CR" value="506">+506</option> <option data-countryCode="HR" value="385">+385</option> <!-- <option data-countryCode="CU" value="53">Cuba +53</option> --> <option data-countryCode="CY" value="90">+90</option> <option data-countryCode="CY" value="357">+357</option> <option data-countryCode="CZ" value="420">+420</option> <option data-countryCode="DK" value="45">+45</option> <option data-countryCode="DJ" value="253">+253</option> <option data-countryCode="DM" value="1809">+1809</option> <option data-countryCode="DO" value="1809">+1809</option> <option data-countryCode="EC" value="593">+593</option> <option data-countryCode="EG" value="20">+20</option> <option data-countryCode="SV" value="503">+503</option> <option data-countryCode="GQ" value="240">+240</option> <option data-countryCode="ER" value="291">+291</option> <option data-countryCode="EE" value="372">+372</option> <option data-countryCode="ET" value="251">+251</option> <option data-countryCode="FK" value="500">+500</option> <option data-countryCode="FO" value="298">+298</option> <option data-countryCode="FJ" value="679">+679</option> <option data-countryCode="FI" value="358">+358</option> <option data-countryCode="FR" value="33">+33</option> <option data-countryCode="GF" value="594">+594</option> <option data-countryCode="PF" value="689">+689</option> <option data-countryCode="GA" value="241">+241</option> <option data-countryCode="GM" value="220">+220</option> <option data-countryCode="GE" value="7880">+7880</option> <option data-countryCode="DE" value="49">+49</option> <option data-countryCode="GH" value="233">+233</option> <option data-countryCode="GI" value="350">+350</option> <option data-countryCode="GR" value="30">+30</option> <option data-countryCode="GL" value="299">+299</option> <option data-countryCode="GD" value="1473">+1473</option> <option data-countryCode="GP" value="590">+590</option> <option data-countryCode="GU" value="671">+671</option> <option data-countryCode="GT" value="502">+502</option> <option data-countryCode="GN" value="224">+224</option> <option data-countryCode="GW" value="245">+245</option> <option data-countryCode="GY" value="592">+592</option> <option data-countryCode="HT" value="509">+509</option> <option data-countryCode="HN" value="504">+504</option> <option data-countryCode="HK" value="852">+852</option> <option data-countryCode="HU" value="36">+36</option> <option data-countryCode="IS" value="354">+354</option> <option data-countryCode="IN" value="91">+91</option> <option data-countryCode="ID" value="62">+62</option> <option data-countryCode="IQ" value="964">+964</option> <!-- <option data-countryCode="IR" value="98">Iran +98</option> --> <option data-countryCode="IE" value="353">+353</option> <option data-countryCode="IL" value="972">+972</option> <option data-countryCode="IT" value="39">+39</option> <option data-countryCode="JM" value="1876">+1876</option> <option data-countryCode="JP" value="81">+81</option> <option data-countryCode="JO" value="962">+962</option> <option data-countryCode="KZ" value="7">+7</option> <option data-countryCode="KE" value="254">+254</option> <option data-countryCode="KI" value="686">+686</option> <option data-countryCode="KR" value="82">+82</option> <option data-countryCode="KW" value="965">+965</option> <option data-countryCode="KG" value="996">+996</option> <option data-countryCode="LA" value="856">+856</option> <option data-countryCode="LV" value="371">+371</option> <option data-countryCode="LB" value="961">+961</option> <option data-countryCode="LS" value="266">+266</option> <option data-countryCode="LR" value="231">+231</option> <option data-countryCode="LY" value="218">+218</option> <option data-countryCode="LI" value="417">+417</option> <option data-countryCode="LT" value="370">+370</option> <option data-countryCode="LU" value="352">+352</option> <option data-countryCode="MO" value="853">+853</option> <option data-countryCode="MK" value="389">+389</option> <option data-countryCode="MG" value="261">+261</option> <option data-countryCode="MW" value="265">+265</option> <option data-countryCode="MY" value="60">+60</option> <option data-countryCode="MV" value="960">+960</option> <option data-countryCode="ML" value="223">+223</option> <option data-countryCode="MT" value="356">+356</option> <option data-countryCode="MH" value="692">+692</option> <option data-countryCode="MQ" value="596">+596</option> <option data-countryCode="MR" value="222">+222</option> <option data-countryCode="YT" value="269">+269</option> <option data-countryCode="MX" value="52">+52</option> <option data-countryCode="FM" value="691">+691</option> <option data-countryCode="MD" value="373">+373</option> <option data-countryCode="MC" value="377">+377</option> <option data-countryCode="MN" value="976">+976</option> <option data-countryCode="MS" value="1664">+1664</option> <option data-countryCode="MA" value="212">+212</option> <option data-countryCode="MZ" value="258">+258</option> <option data-countryCode="MN" value="95">+95</option> <option data-countryCode="NA" value="264">+264</option> <option data-countryCode="NR" value="674">+674</option> <option data-countryCode="NP" value="977">+977</option> <option data-countryCode="NL" value="31">+31</option> <option data-countryCode="NC" value="687">+687</option> <option data-countryCode="NZ" value="64">+64</option> <option data-countryCode="NI" value="505">+505</option> <option data-countryCode="NE" value="227">+227</option> <option data-countryCode="NG" value="234">+234</option> <option data-countryCode="NU" value="683">+683</option> <option data-countryCode="NF" value="672">+672</option> <option data-countryCode="NP" value="670">+670</option> <option data-countryCode="NO" value="47">+47</option> <option data-countryCode="OM" value="968">+968</option> <option data-countryCode="PK" value="92" selected>+92</option> <option data-countryCode="PW" value="680">+680</option> <option data-countryCode="PA" value="507">+507</option> <option data-countryCode="PG" value="675">+675</option> <option data-countryCode="PY" value="595">+595</option> <option data-countryCode="PE" value="51">+51</option> <option data-countryCode="PH" value="63">+63</option> <option data-countryCode="PL" value="48">+48</option> <option data-countryCode="PT" value="351">+351</option> <option data-countryCode="PR" value="1787">+1787</option> <option data-countryCode="QA" value="974">+974</option> <option data-countryCode="RE" value="262">+262</option> <option data-countryCode="RO" value="40">+40</option> <option data-countryCode="RU" value="7">+7</option> <option data-countryCode="RW" value="250">+250</option> <option data-countryCode="SM" value="378">+378</option> <option data-countryCode="ST" value="239">+239</option> <option data-countryCode="SA" value="966">+966</option> <option data-countryCode="SN" value="221">+221</option> <option data-countryCode="CS" value="381">+381</option> <option data-countryCode="SC" value="248">+248</option> <option data-countryCode="SL" value="232">+232</option> <option data-countryCode="SG" value="65">+65</option> <option data-countryCode="SK" value="421">+421</option> <option data-countryCode="SI" value="386">+386</option> <option data-countryCode="SB" value="677">+677</option> <option data-countryCode="SO" value="252">+252</option> <option data-countryCode="ZA" value="27">+27</option> <option data-countryCode="ES" value="34">+34</option> <option data-countryCode="LK" value="94">+94</option> <option data-countryCode="SH" value="290">+290</option> <option data-countryCode="KN" value="1869">+1869</option> <option data-countryCode="SC" value="1758">+1758</option> <option data-countryCode="SR" value="597">+597</option> <option data-countryCode="SD" value="249">+249</option> <option data-countryCode="SZ" value="268">+268</option> <option data-countryCode="SE" value="46">+46</option> <option data-countryCode="CH" value="41">+41</option> <!-- <option data-countryCode="SY" value="963">Syria +963</option> --> <option data-countryCode="TW" value="886">+886</option> <option data-countryCode="TJ" value="992">+992</option> <option data-countryCode="TH" value="66">+66</option> <option data-countryCode="TG" value="228">+228</option> <option data-countryCode="TO" value="676">+676</option> <option data-countryCode="TT" value="1868">+1868</option> <option data-countryCode="TN" value="216">+216</option> <option data-countryCode="TR" value="90">+90</option> <option data-countryCode="TM" value="993">+993</option> <option data-countryCode="TC" value="1649">+1649</option> <option data-countryCode="TV" value="688">+688</option> <option data-countryCode="UG" value="256">+256</option> <option data-countryCode="UA" value="380">+380</option> <option data-countryCode="AE" value="971">+971</option> <option data-countryCode="UY" value="598">+598</option> <option data-countryCode="UZ" value="998">+998</option> <option data-countryCode="VU" value="678">+678</option> <option data-countryCode="VA" value="379">+379</option> <option data-countryCode="VE" value="58">+58</option> <option data-countryCode="VN" value="84">+84</option> <option data-countryCode="VG" value="1">+1</option> <option data-countryCode="VI" value="1">+1</option> <option data-countryCode="WF" value="681">+681</option> <option data-countryCode="YE" value="969">+969</option> <option data-countryCode="YE" value="967">+967</option> <option data-countryCode="ZM" value="260">+260</option> <option data-countryCode="ZW" value="263">+263</option> </select><input name="mother_mobile_phone[]" type="text" class="col-md-10" placeholder="Mobile" id="" value="" style="padding-left:60px;" /> <a href="#" class="remove_field2">X</a></div>'); //add input box
        }
    });
  $(wrapper2).on("click",".remove_field2", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('.input_fields_wrap_additional_mother').remove(); x--;
    })
    
});
</script>
<script>
$(document).ready(function(){
	// Date range
if ($('#date_of_birth').length) {
	
	$('#date_of_birth').datepicker({
		changeMonth: true,
        changeYear: true,
		dateFormat: 'yy-mm-dd',
		yearRange: '1980:'+(new Date).getFullYear(),
		prevText: '<i class="fa fa-chevron-left"></i>',
		nextText: '<i class="fa fa-chevron-right"></i>',
		onSelect: function(date) {
			getadmissiongradedob(date);
		},
	});	

}



// GF ID	
if ($('#token_no').length) {
	$('#token_no').mask('9999', {
		placeholder: 'X'
	});
}	

if ($('#f_nic').length) {
  $('#f_nic').mask('99999-9999999-9', {
        placeholder: 'X'
   });
}

$('#student_nic').mask('99999-9999999-9', {
        placeholder: 'X'
   });

// Father NIC
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
	
	
// father mobile
if ($('#father_mobile').length) {
  $('#father_mobile').mask('0399-9999999', {
        placeholder: 'X'
   });
}	
	

// mother_mobile 
if ($('#mother_mobile').length) {
  $('#mother_mobile').mask('0399-9999999', {
        placeholder: 'X'
   });
}	
	
	
	// GF ID	
if ($('#gf_id').length) {
	$('#gf_id').mask('99-999', {
		placeholder: 'X'
	});
}
});
$("#batch").val('<?php echo $data_id["Batch_id"]; ?>|<?php echo $data_id["assessment_date_simple_format"]; ?>');



$(document).on("keyup", "#mother_nic", function(){
  
  var mother_nic = $(this).val();

  $.ajax({
    type: "POST",
    url : "<?=base_url();?>index.php/gs_admission/ajax_base/getDataByMNic/",
    data: {'m_nic' :mother_nic},
    dataType: "JSON",
    beforeSend: function(){},
    success: function(res){
      if(res.gt_id !== null  && res.gt_id !== undefined){
        $('#gt_id').val(res.gt_id)
        $('.show_gt_id').show();
        $('.show_gt_id').text("GT ID: "+res.gt_id); 
      } else {
        $('#gt_id').val('')
        $('.show_gt_id').hide();
        
      }   
    },
    complete:function(){ },
    error:function(){}
    
  });
  

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
							
                          
							 
                            </div><!-- modal-body -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
							
							
                          </div><!-- modal-content -->
                          
                        </div><!-- modal-dialog -->
                    </div><!-- modal -->

