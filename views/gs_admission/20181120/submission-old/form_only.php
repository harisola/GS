<?php //var_dump($data_id); ?>
<form action="<?=base_url();?>index.php/gs_admission/ajax_base/form_submission" method="POST" name="submission" id="submission" class="issuance">
<div class="col-md-12">



<div class="FormNoShow">
	<div class="col-md-3 text-right"><label class="FormNo">Form No.</label> </div>
	
	<div class="col-md-9">
	<input type="text" placeholder="XXXX" name="form_no" id="form_no" disabled value="<?php echo str_pad( $data_id["Form_no"],4,"0",STR_PAD_LEFT); ?>" />
	
	<input type="hidden" name="form_id" id="form_id" value="<?=$data_id["Form_id"];?>" />
	<input type="hidden" name="Fmly_Reg_ID" id="Fmly_Reg_ID" value="<?=$data_id["Family_reg_id"];?>" />
	<input type="hidden" name="submissionStage" id="submissionStage" value="2" />
	<input type="hidden" name="primary_contact" id="primary_contact" value="<?=$data_id["Primary_contact"];?>" />
	
	<input type="hidden" name="Current_Batch_id" id="Current_Batch_id" value="<?=$data_id["Batch_id"];?>" />
	<input type="hidden" name="Current_Time_Slot_id" id="Current_Time_Slot_id" value="<?=$data_id["Slot_id"];?>" />
	<?php if( ( $data_id["Batch_id"] > 0 ) && ( $data_id["Slot_id"] > 0 )){ ?>
	<input type="hidden" name="Current_Batch_Time_Slot_id_Change" id="Current_Batch_Time_Slot_id_Change" value="1" />
	<?php }else{ ?>
	<input type="hidden" name="Current_Batch_Time_Slot_id_Change" id="Current_Batch_Time_Slot_id_Change" value="0" />	
	<?php } ?>
	</div>
</div><!-- FormNoShow -->
</div><!-- col-md-12 -->
<hr />

 
      
	  
	  <?php
	  $pD = "";
	  if( $data_id["Grade_id"] > 2 ){
		  $pD= "block";
	  }else{
		  $pD= "none";
	  }
	  ?>
	  
	  
	<script type="text/javascript">
		var alevel_checklist = "<?php echo $data_id["Alevel_checklist"]; ?>";
    	
    	if(alevel_checklist !== ''){
          var checklist = alevel_checklist;
          checklist = checklist.split(',');
          for (var i = 0; i < checklist.length; i++) {
            $( "#"+checklist[i] ).prop( "checked", true );
          }
        }
   		var grades = ['A1', 'A2']
        
        if( grades.indexOf("<?php echo $data_id["Grade_name"]; ?>") == -1  ){
              $("#discussion_date").val('')
              $("#discussion_time").val('')
              $(".alevelBox").remove()
        } else {
            $("#discussion_date").val('')
            $("#discussion_time").val('')          
            $(".alevelBox").show()
        }        		
	</script>

<div class="col-md-12 paddingBottom20" id="previousData" style="display:<?=$pD;?>">

	<div class="col-md-6">
		<!--input type="text" class="" placeholder="Previous School *" name="previous_school" id="previous_school"  / -->
		<select name="previous_school" id="previous_school">
				  <option value="">Previous School</option>
				<?php 
					if( !empty( $school_lists )){ 
						foreach( $school_lists as $sl ){ ?>
						 <option value="<?=$sl["School_id"];?>" <?php if( $data_id["PS_id"] == $sl["School_id"] ){ echo "selected"; }?>><?=$sl["School_name"];?></option>
					<?php }
				 } ?>
				 <option value="52000">Other</option>
				 </select>
		 
	</div><!-- col-md-6 -->
	<div class="col-md-6" id="otherSchools" style="display:none;">
		<input type="text"  placeholder="School Name" name="other_school" id="other_school"  />
	</div><!-- col-md-6 -->
						
	<div id="addHere" class="col-md-6">
		<!--input type="text" placeholder="Previous Grade *" name="previous_grade" id="previous_grade" / -->
		 <select name="previous_grade" id="previous_grade">
				  <option value="">Previous Grade</option>
				<?php 
					if( !empty( $grade_lists )){ 
						foreach( $grade_lists as $gl ){ ?>
						 <option value="<?=$gl["Grade_id"];?>" <?php if( $data_id["PG_id"] == $gl["Grade_id"] ){ echo "selected"; }?>><?=$gl["Grade_name"];?></option>
					<?php }
				 } ?>
				 </select>
		 
	</div><!-- col-md-6 -->
	
	
	
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom20">
	<div class="col-md-6">
	   <input type="text" class="" readonly placeholder="Official Name *" name="official_name" id="official_name" value="<?=$data_id["Applicate_name"];?>" />
	</div><!-- col-md-6 -->
	<div class="col-md-6">
		 <input type="text" placeholder="Call Name" name="call_name" id="call_name" readonly value="<?=$data_id["Call_name"];?>" />
	</div><!-- col-md-6 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom20">
	<div class="col-md-6">
		<input placeholder="Date of Birth *" type="text" name="date_of_birth" id="date_of_birth" readonly value="<?=$data_id["Dob"];?>">
	</div><!-- col-md-6 -->
	
					    <div class="col-md-6">
                           <input type="text" placeholder="Admission Grade *" name="admission_grade" readonly id="admission_grade" value="<?=$data_id["Grade_name"];?>" />
							<input type="hidden" name="admission_grade_id" id="admission_grade_id" value="<?=$data_id["Grade_id"];?>" />
                        </div>
						
	
	
</div><!-- col-md-12 -->

<div class="col-md-12 paddingBottom20">
                       
						
						 <div class="col-md-6">
                         <select name="gender" id="gender" disabled>
							<option value="">Gender *</option>
							<option value="Boy" <?php if( $data_id["Gender"] == "B"){ echo "selected"; }?>>Boy</option>
							<option value="Girl" <?php if( $data_id["Gender"] == "G"){ echo "selected"; }?>>Girl</option>
						</select>
                        </div><!-- col-md-6 -->
                      <div class="col-md-6">
                              <div id="student_mobile_div"></div>
                              <?php $numbers = explode(",",$data_id["Student_mobile"]); 
                              	for($i = 0; $i < count($numbers); $i++){ 
                              		$otherNumber = explode( "-" , $numbers[$i]); 
                              		$otherNumber[0] =str_replace("-", "", $otherNumber[0]); ?>
                              	<div class="input_fields_wrap" style="margin-bottom: 14px;">
                                        <select required="" class="countryCodeNumber student_other_<?php echo $i; ?>" name="student_mobile_code[]">
                                          <!-- Countries often selected by users can be moved to the top of the list. -->
                                          <!-- Countries known to be subject to general US embargo are commented out by default. -->
                                          <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->
                                        
                                          <option data-countrycode="US" value="1">+1</option>
                                          <option data-countrycode="GB" value="44">+44</option>
                                          <option data-countrycode="DZ" value="213">+213</option>
                                          <option data-countrycode="AD" value="376">+376</option>
                                          <option data-countrycode="AO" value="244">+244</option>
                                          <option data-countrycode="AI" value="1264">+1264</option>
                                          <option data-countrycode="AG" value="1268">+1268</option>
                                          <option data-countrycode="AR" value="54">+54</option>
                                          <option data-countrycode="AM" value="374">+374</option>
                                          <option data-countrycode="AW" value="297">+297</option>
                                          <option data-countrycode="AU" value="61">+61</option>
                                          <option data-countrycode="AT" value="43">+43</option>
                                          <option data-countrycode="AZ" value="994">+994</option>
                                          <option data-countrycode="BS" value="1242">+1242</option>
                                          <option data-countrycode="BH" value="973">+973</option>
                                          <option data-countrycode="BD" value="880">+880</option>
                                          <option data-countrycode="BB" value="1246">+1246</option>
                                          <option data-countrycode="BY" value="375">+375</option>
                                          <option data-countrycode="BE" value="32">+32</option>
                                          <option data-countrycode="BZ" value="501">+501</option>
                                          <option data-countrycode="BJ" value="229">+229</option>
                                          <option data-countrycode="BM" value="1441">+1441</option>
                                          <option data-countrycode="BT" value="975">+975</option>
                                          <option data-countrycode="BO" value="591">+591</option>
                                          <option data-countrycode="BA" value="387">+387</option>
                                          <option data-countrycode="BW" value="267">+267</option>
                                          <option data-countrycode="BR" value="55">+55</option>
                                          <option data-countrycode="BN" value="673">+673</option>
                                          <option data-countrycode="BG" value="359">+359</option>
                                          <option data-countrycode="BF" value="226">+226</option>
                                          <option data-countrycode="BI" value="257">+257</option>
                                          <option data-countrycode="KH" value="855">+855</option>
                                          <option data-countrycode="CM" value="237">+237</option>
                                          <option data-countrycode="CA" value="1">+1</option>
                                          <option data-countrycode="CV" value="238">+238</option>
                                        
                                          <option data-countrycode="KY" value="1345">+1345</option>
                                          <option data-countrycode="CF" value="236">+236</option>
                                          <option data-countrycode="CL" value="56">+56</option>
                                          <option data-countrycode="CN" value="86">+86</option>
                                          <option data-countrycode="CO" value="57">+57</option>
                                          <option data-countrycode="KM" value="269">+269</option>
                                          <option data-countrycode="CG" value="242">+242</option>
                                          <option data-countrycode="CK" value="682">+682</option>
                                          <option data-countrycode="CR" value="506">+506</option>
                                          <option data-countrycode="HR" value="385">+385</option>
                                          <!-- <option data-countryCode="CU" value="53">Cuba +53</option> -->
                                          <option data-countrycode="CY" value="90">+90</option>
                                          <option data-countrycode="CY" value="357">+357</option>
                                          <option data-countrycode="CZ" value="420">+420</option>
                                          <option data-countrycode="DK" value="45">+45</option>
                                          <option data-countrycode="DJ" value="253">+253</option>
                                          <option data-countrycode="DM" value="1809">+1809</option>
                                          <option data-countrycode="DO" value="1809">+1809</option>
                                          <option data-countrycode="EC" value="593">+593</option>
                                          <option data-countrycode="EG" value="20">+20</option>
                                          <option data-countrycode="SV" value="503">+503</option>
                                          <option data-countrycode="GQ" value="240">+240</option>
                                          <option data-countrycode="ER" value="291">+291</option>
                                          <option data-countrycode="EE" value="372">+372</option>
                                          <option data-countrycode="ET" value="251">+251</option>
                                          <option data-countrycode="FK" value="500">+500</option>
                                          <option data-countrycode="FO" value="298">+298</option>
                                          <option data-countrycode="FJ" value="679">+679</option>
                                          <option data-countrycode="FI" value="358">+358</option>
                                          <option data-countrycode="FR" value="33">+33</option>
                                          <option data-countrycode="GF" value="594">+594</option>
                                          <option data-countrycode="PF" value="689">+689</option>
                                          <option data-countrycode="GA" value="241">+241</option>
                                          <option data-countrycode="GM" value="220">+220</option>
                                          <option data-countrycode="GE" value="7880">+7880</option>
                                          <option data-countrycode="DE" value="49">+49</option>
                                          <option data-countrycode="GH" value="233">+233</option>
                                          <option data-countrycode="GI" value="350">+350</option>
                                          <option data-countrycode="GR" value="30">+30</option>
                                          <option data-countrycode="GL" value="299">+299</option>
                                          <option data-countrycode="GD" value="1473">+1473</option>
                                          <option data-countrycode="GP" value="590">+590</option>
                                          <option data-countrycode="GU" value="671">+671</option>
                                          <option data-countrycode="GT" value="502">+502</option>
                                          <option data-countrycode="GN" value="224">+224</option>
                                          <option data-countrycode="GW" value="245">+245</option>
                                          <option data-countrycode="GY" value="592">+592</option>
                                          <option data-countrycode="HT" value="509">+509</option>
                                          <option data-countrycode="HN" value="504">+504</option>
                                          <option data-countrycode="HK" value="852">+852</option>
                                          <option data-countrycode="HU" value="36">+36</option>
                                          <option data-countrycode="IS" value="354">+354</option>
                                          <option data-countrycode="IN" value="91">+91</option>
                                          <option data-countrycode="ID" value="62">+62</option>
                                          <option data-countrycode="IQ" value="964">+964</option>
                                          <!-- <option data-countryCode="IR" value="98">Iran +98</option> -->
                                          <option data-countrycode="IE" value="353">+353</option>
                                          <option data-countrycode="IL" value="972">+972</option>
                                          <option data-countrycode="IT" value="39">+39</option>
                                          <option data-countrycode="JM" value="1876">+1876</option>
                                          <option data-countrycode="JP" value="81">+81</option>
                                          <option data-countrycode="JO" value="962">+962</option>
                                          <option data-countrycode="KZ" value="7">+7</option>
                                          <option data-countrycode="KE" value="254">+254</option>
                                          <option data-countrycode="KI" value="686">+686</option>
                                          <option data-countrycode="KR" value="82">+82</option>
                                          <option data-countrycode="KW" value="965">+965</option>
                                          <option data-countrycode="KG" value="996">+996</option>
                                          <option data-countrycode="LA" value="856">+856</option>
                                          <option data-countrycode="LV" value="371">+371</option>
                                          <option data-countrycode="LB" value="961">+961</option>
                                          <option data-countrycode="LS" value="266">+266</option>
                                          <option data-countrycode="LR" value="231">+231</option>
                                          <option data-countrycode="LY" value="218">+218</option>
                                          <option data-countrycode="LI" value="417">+417</option>
                                          <option data-countrycode="LT" value="370">+370</option>
                                          <option data-countrycode="LU" value="352">+352</option>
                                          <option data-countrycode="MO" value="853">+853</option>
                                          <option data-countrycode="MK" value="389">+389</option>
                                          <option data-countrycode="MG" value="261">+261</option>
                                          <option data-countrycode="MW" value="265">+265</option>
                                          <option data-countrycode="MY" value="60">+60</option>
                                          <option data-countrycode="MV" value="960">+960</option>
                                          <option data-countrycode="ML" value="223">+223</option>
                                          <option data-countrycode="MT" value="356">+356</option>
                                          <option data-countrycode="MH" value="692">+692</option>
                                          <option data-countrycode="MQ" value="596">+596</option>
                                          <option data-countrycode="MR" value="222">+222</option>
                                          <option data-countrycode="YT" value="269">+269</option>
                                          <option data-countrycode="MX" value="52">+52</option>
                                          <option data-countrycode="FM" value="691">+691</option>
                                          <option data-countrycode="MD" value="373">+373</option>
                                          <option data-countrycode="MC" value="377">+377</option>
                                          <option data-countrycode="MN" value="976">+976</option>
                                          <option data-countrycode="MS" value="1664">+1664</option>
                                          <option data-countrycode="MA" value="212">+212</option>
                                          <option data-countrycode="MZ" value="258">+258</option>
                                          <option data-countrycode="MN" value="95">+95</option>
                                          <option data-countrycode="NA" value="264">+264</option>
                                          <option data-countrycode="NR" value="674">+674</option>
                                          <option data-countrycode="NP" value="977">+977</option>
                                          <option data-countrycode="NL" value="31">+31</option>
                                          <option data-countrycode="NC" value="687">+687</option>
                                          <option data-countrycode="NZ" value="64">+64</option>
                                          <option data-countrycode="NI" value="505">+505</option>
                                          <option data-countrycode="NE" value="227">+227</option>
                                          <option data-countrycode="NG" value="234">+234</option>
                                          <option data-countrycode="NU" value="683">+683</option>
                                          <option data-countrycode="NF" value="672">+672</option>
                                          <option data-countrycode="NP" value="670">+670</option>
                                          <option data-countrycode="NO" value="47">+47</option>
                                          <option data-countrycode="OM" value="968">+968</option>
                                          <option selected="" data-countrycode="PK" value="92">+92</option>
                                          <option data-countrycode="PW" value="680">+680</option>
                                          <option data-countrycode="PA" value="507">+507</option>
                                          <option data-countrycode="PG" value="675">+675</option>
                                          <option data-countrycode="PY" value="595">+595</option>
                                          <option data-countrycode="PE" value="51">+51</option>
                                          <option data-countrycode="PH" value="63">+63</option>
                                          <option data-countrycode="PL" value="48">+48</option>
                                          <option data-countrycode="PT" value="351">+351</option>
                                          <option data-countrycode="PR" value="1787">+1787</option>
                                          <option data-countrycode="QA" value="974">+974</option>
                                          <option data-countrycode="RE" value="262">+262</option>
                                          <option data-countrycode="RO" value="40">+40</option>
                                          <option data-countrycode="RU" value="7">+7</option>
                                          <option data-countrycode="RW" value="250">+250</option>
                                          <option data-countrycode="SM" value="378">+378</option>
                                          <option data-countrycode="ST" value="239">+239</option>
                                          <option data-countrycode="SA" value="966">+966</option>
                                          <option data-countrycode="SN" value="221">+221</option>
                                          <option data-countrycode="CS" value="381">+381</option>
                                          <option data-countrycode="SC" value="248">+248</option>
                                          <option data-countrycode="SL" value="232">+232</option>
                                          <option data-countrycode="SG" value="65">+65</option>
                                          <option data-countrycode="SK" value="421">+421</option>
                                          <option data-countrycode="SI" value="386">+386</option>
                                          <option data-countrycode="SB" value="677">+677</option>
                                          <option data-countrycode="SO" value="252">+252</option>
                                          <option data-countrycode="ZA" value="27">+27</option>
                                          <option data-countrycode="ES" value="34">+34</option>
                                          <option data-countrycode="LK" value="94">+94</option>
                                          <option data-countrycode="SH" value="290">+290</option>
                                          <option data-countrycode="KN" value="1869">+1869</option>
                                          <option data-countrycode="SC" value="1758">+1758</option>
                                          <option data-countrycode="SR" value="597">+597</option>
                                          <option data-countrycode="SD" value="249">+249</option>
                                          <option data-countrycode="SZ" value="268">+268</option>
                                          <option data-countrycode="SE" value="46">+46</option>
                                          <option data-countrycode="CH" value="41">+41</option>
                                          <!-- <option data-countryCode="SY" value="963">Syria +963</option> -->
                                          <option data-countrycode="TW" value="886">+886</option>
                                          <option data-countrycode="TJ" value="992">+992</option>
                                          <option data-countrycode="TH" value="66">+66</option>
                                          <option data-countrycode="TG" value="228">+228</option>
                                          <option data-countrycode="TO" value="676">+676</option>
                                          <option data-countrycode="TT" value="1868">+1868</option>
                                          <option data-countrycode="TN" value="216">+216</option>
                                          <option data-countrycode="TR" value="90">+90</option>
                                          <option data-countrycode="TM" value="993">+993</option>
                                          <option data-countrycode="TC" value="1649">+1649</option>
                                          <option data-countrycode="TV" value="688">+688</option>
                                          <option data-countrycode="UG" value="256">+256</option>
                                          <option data-countrycode="UA" value="380">+380</option>
                                          <option data-countrycode="AE" value="971">+971</option>
                                          <option data-countrycode="UY" value="598">+598</option>
                                          <option data-countrycode="UZ" value="998">+998</option>
                                          <option data-countrycode="VU" value="678">+678</option>
                                          <option data-countrycode="VA" value="379">+379</option>
                                          <option data-countrycode="VE" value="58">+58</option>
                                          <option data-countrycode="VN" value="84">+84</option>
                                          <option data-countrycode="VG" value="1">+1</option>
                                          <option data-countrycode="VI" value="1">+1</option>
                                          <option data-countrycode="WF" value="681">+681</option>
                                          <option data-countrycode="YE" value="969">+969</option>
                                          <option data-countrycode="YE" value="967">+967</option>
                                          <option data-countrycode="ZM" value="260">+260</option>
                                          <option data-countrycode="ZW" value="263">+263</option>
                                        </select>
                                        <input name="student_mobile_phone[]" type="number" class="col-md-10" placeholder="Mobile" id="student_mobile" value="<?php echo $otherNumber[1]; ?>" style="padding-left:80px;"> 
                                        <button class="add_field_button">+</button>
                                </div>
								 <br>
								 <script>$(".student_other_<?php echo $i; ?>").val(<?php echo $otherNumber[0]; ?>)</script>
                            <?php }
                              ?>
                                    
                          </div>
                    </div><!-- col-md-12 -->

<div class="col-md-12 paddingBottom0">
                       
            
             <div class="col-md-6 state-success">
                           <input value="<?=$data_id["Student_email"];?>" placeholder="Email" type="text" name="student_email" id="student_email" class="valid">
                        </div><!-- col-md-6 -->
                        <div class="col-md-6">
                          <input value="<?=$data_id["Student_nic"];?>" placeholder="NIC/Passport" type="text" name="student_nic" id="student_nic">
                        </div><!-- col-md-6 -->
                    </div>              
<?php /* ?>
<div class="col-md-12 paddingBottom0">
	<div class="col-md-6">
	   <input type="text" placeholder="Admission Grade *" name="admission_grade" id="admission_grade" value="<?=$data_id["Grade_name"];?>" />
		<input type="hidden" name="admission_grade_id" id="admission_grade_id" value="<?=$data_id["Grade_id"];?>" />
	</div><!-- col-md-6 -->
	<div class="col-md-6">
	</div><!-- col-md-6 -->
</div><!-- col-md-12 -->
<?php */ ?>
<hr />
<div class="col-md-12 paddingBottom20">
	<div class="col-md-6">

	
	<?php if( $data_id["Primary_contact"] == 0 ){
			$readOnly = "readonly";
			$readOnly2 = "";
			$mendotryf = "*";
			$mendotrym = "";
		}else{
			$readOnly = "";
			$readOnly2 = "readonly";
			
			$mendotryf = "";
			$mendotrym = "*";
		}
	
	?> 
		<input type="text" class="" <?=$readOnly;?> placeholder="Father Name <?=$mendotryf;?>" name="father_name" id="father_name" value="<?=$data_id["Father_name"];?>" /><br /><br />

		
			<?php  if (!empty($data_id["Father_mobile"])) {
				$data_id["Father_mobile"] = substr($data_id["Father_mobile"], 1);
				$data_id["Father_mobile"] = str_replace("-", "", $data_id["Father_mobile"]);
			 ?>
      
			 	<div class="input_fields_wrap_father" style="margin-bottom: 14px;">
                    <select required="" class="countryCodeNumber" name="father_mobile_code[]">
                      <!-- Countries often selected by users can be moved to the top of the list. -->
                      <!-- Countries known to be subject to general US embargo are commented out by default. -->
                      <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->
                    
                      <option data-countrycode="US" value="1">+1</option>
                      <option data-countrycode="GB" value="44">+44</option>
                      <option data-countrycode="DZ" value="213">+213</option>
                      <option data-countrycode="AD" value="376">+376</option>
                      <option data-countrycode="AO" value="244">+244</option>
                      <option data-countrycode="AI" value="1264">+1264</option>
                      <option data-countrycode="AG" value="1268">+1268</option>
                      <option data-countrycode="AR" value="54">+54</option>
                      <option data-countrycode="AM" value="374">+374</option>
                      <option data-countrycode="AW" value="297">+297</option>
                      <option data-countrycode="AU" value="61">+61</option>
                      <option data-countrycode="AT" value="43">+43</option>
                      <option data-countrycode="AZ" value="994">+994</option>
                      <option data-countrycode="BS" value="1242">+1242</option>
                      <option data-countrycode="BH" value="973">+973</option>
                      <option data-countrycode="BD" value="880">+880</option>
                      <option data-countrycode="BB" value="1246">+1246</option>
                      <option data-countrycode="BY" value="375">+375</option>
                      <option data-countrycode="BE" value="32">+32</option>
                      <option data-countrycode="BZ" value="501">+501</option>
                      <option data-countrycode="BJ" value="229">+229</option>
                      <option data-countrycode="BM" value="1441">+1441</option>
                      <option data-countrycode="BT" value="975">+975</option>
                      <option data-countrycode="BO" value="591">+591</option>
                      <option data-countrycode="BA" value="387">+387</option>
                      <option data-countrycode="BW" value="267">+267</option>
                      <option data-countrycode="BR" value="55">+55</option>
                      <option data-countrycode="BN" value="673">+673</option>
                      <option data-countrycode="BG" value="359">+359</option>
                      <option data-countrycode="BF" value="226">+226</option>
                      <option data-countrycode="BI" value="257">+257</option>
                      <option data-countrycode="KH" value="855">+855</option>
                      <option data-countrycode="CM" value="237">+237</option>
                      <option data-countrycode="CA" value="1">+1</option>
                      <option data-countrycode="CV" value="238">+238</option>
                    
                      <option data-countrycode="KY" value="1345">+1345</option>
                      <option data-countrycode="CF" value="236">+236</option>
                      <option data-countrycode="CL" value="56">+56</option>
                      <option data-countrycode="CN" value="86">+86</option>
                      <option data-countrycode="CO" value="57">+57</option>
                      <option data-countrycode="KM" value="269">+269</option>
                      <option data-countrycode="CG" value="242">+242</option>
                      <option data-countrycode="CK" value="682">+682</option>
                      <option data-countrycode="CR" value="506">+506</option>
                      <option data-countrycode="HR" value="385">+385</option>
                      <!-- <option data-countryCode="CU" value="53">Cuba +53</option> -->
                      <option data-countrycode="CY" value="90">+90</option>
                      <option data-countrycode="CY" value="357">+357</option>
                      <option data-countrycode="CZ" value="420">+420</option>
                      <option data-countrycode="DK" value="45">+45</option>
                      <option data-countrycode="DJ" value="253">+253</option>
                      <option data-countrycode="DM" value="1809">+1809</option>
                      <option data-countrycode="DO" value="1809">+1809</option>
                      <option data-countrycode="EC" value="593">+593</option>
                      <option data-countrycode="EG" value="20">+20</option>
                      <option data-countrycode="SV" value="503">+503</option>
                      <option data-countrycode="GQ" value="240">+240</option>
                      <option data-countrycode="ER" value="291">+291</option>
                      <option data-countrycode="EE" value="372">+372</option>
                      <option data-countrycode="ET" value="251">+251</option>
                      <option data-countrycode="FK" value="500">+500</option>
                      <option data-countrycode="FO" value="298">+298</option>
                      <option data-countrycode="FJ" value="679">+679</option>
                      <option data-countrycode="FI" value="358">+358</option>
                      <option data-countrycode="FR" value="33">+33</option>
                      <option data-countrycode="GF" value="594">+594</option>
                      <option data-countrycode="PF" value="689">+689</option>
                      <option data-countrycode="GA" value="241">+241</option>
                      <option data-countrycode="GM" value="220">+220</option>
                      <option data-countrycode="GE" value="7880">+7880</option>
                      <option data-countrycode="DE" value="49">+49</option>
                      <option data-countrycode="GH" value="233">+233</option>
                      <option data-countrycode="GI" value="350">+350</option>
                      <option data-countrycode="GR" value="30">+30</option>
                      <option data-countrycode="GL" value="299">+299</option>
                      <option data-countrycode="GD" value="1473">+1473</option>
                      <option data-countrycode="GP" value="590">+590</option>
                      <option data-countrycode="GU" value="671">+671</option>
                      <option data-countrycode="GT" value="502">+502</option>
                      <option data-countrycode="GN" value="224">+224</option>
                      <option data-countrycode="GW" value="245">+245</option>
                      <option data-countrycode="GY" value="592">+592</option>
                      <option data-countrycode="HT" value="509">+509</option>
                      <option data-countrycode="HN" value="504">+504</option>
                      <option data-countrycode="HK" value="852">+852</option>
                      <option data-countrycode="HU" value="36">+36</option>
                      <option data-countrycode="IS" value="354">+354</option>
                      <option data-countrycode="IN" value="91">+91</option>
                      <option data-countrycode="ID" value="62">+62</option>
                      <option data-countrycode="IQ" value="964">+964</option>
                      <!-- <option data-countryCode="IR" value="98">Iran +98</option> -->
                      <option data-countrycode="IE" value="353">+353</option>
                      <option data-countrycode="IL" value="972">+972</option>
                      <option data-countrycode="IT" value="39">+39</option>
                      <option data-countrycode="JM" value="1876">+1876</option>
                      <option data-countrycode="JP" value="81">+81</option>
                      <option data-countrycode="JO" value="962">+962</option>
                      <option data-countrycode="KZ" value="7">+7</option>
                      <option data-countrycode="KE" value="254">+254</option>
                      <option data-countrycode="KI" value="686">+686</option>
                      <option data-countrycode="KR" value="82">+82</option>
                      <option data-countrycode="KW" value="965">+965</option>
                      <option data-countrycode="KG" value="996">+996</option>
                      <option data-countrycode="LA" value="856">+856</option>
                      <option data-countrycode="LV" value="371">+371</option>
                      <option data-countrycode="LB" value="961">+961</option>
                      <option data-countrycode="LS" value="266">+266</option>
                      <option data-countrycode="LR" value="231">+231</option>
                      <option data-countrycode="LY" value="218">+218</option>
                      <option data-countrycode="LI" value="417">+417</option>
                      <option data-countrycode="LT" value="370">+370</option>
                      <option data-countrycode="LU" value="352">+352</option>
                      <option data-countrycode="MO" value="853">+853</option>
                      <option data-countrycode="MK" value="389">+389</option>
                      <option data-countrycode="MG" value="261">+261</option>
                      <option data-countrycode="MW" value="265">+265</option>
                      <option data-countrycode="MY" value="60">+60</option>
                      <option data-countrycode="MV" value="960">+960</option>
                      <option data-countrycode="ML" value="223">+223</option>
                      <option data-countrycode="MT" value="356">+356</option>
                      <option data-countrycode="MH" value="692">+692</option>
                      <option data-countrycode="MQ" value="596">+596</option>
                      <option data-countrycode="MR" value="222">+222</option>
                      <option data-countrycode="YT" value="269">+269</option>
                      <option data-countrycode="MX" value="52">+52</option>
                      <option data-countrycode="FM" value="691">+691</option>
                      <option data-countrycode="MD" value="373">+373</option>
                      <option data-countrycode="MC" value="377">+377</option>
                      <option data-countrycode="MN" value="976">+976</option>
                      <option data-countrycode="MS" value="1664">+1664</option>
                      <option data-countrycode="MA" value="212">+212</option>
                      <option data-countrycode="MZ" value="258">+258</option>
                      <option data-countrycode="MN" value="95">+95</option>
                      <option data-countrycode="NA" value="264">+264</option>
                      <option data-countrycode="NR" value="674">+674</option>
                      <option data-countrycode="NP" value="977">+977</option>
                      <option data-countrycode="NL" value="31">+31</option>
                      <option data-countrycode="NC" value="687">+687</option>
                      <option data-countrycode="NZ" value="64">+64</option>
                      <option data-countrycode="NI" value="505">+505</option>
                      <option data-countrycode="NE" value="227">+227</option>
                      <option data-countrycode="NG" value="234">+234</option>
                      <option data-countrycode="NU" value="683">+683</option>
                      <option data-countrycode="NF" value="672">+672</option>
                      <option data-countrycode="NP" value="670">+670</option>
                      <option data-countrycode="NO" value="47">+47</option>
                      <option data-countrycode="OM" value="968">+968</option>
                      <option selected="" data-countrycode="PK" value="92">+92</option>
                      <option data-countrycode="PW" value="680">+680</option>
                      <option data-countrycode="PA" value="507">+507</option>
                      <option data-countrycode="PG" value="675">+675</option>
                      <option data-countrycode="PY" value="595">+595</option>
                      <option data-countrycode="PE" value="51">+51</option>
                      <option data-countrycode="PH" value="63">+63</option>
                      <option data-countrycode="PL" value="48">+48</option>
                      <option data-countrycode="PT" value="351">+351</option>
                      <option data-countrycode="PR" value="1787">+1787</option>
                      <option data-countrycode="QA" value="974">+974</option>
                      <option data-countrycode="RE" value="262">+262</option>
                      <option data-countrycode="RO" value="40">+40</option>
                      <option data-countrycode="RU" value="7">+7</option>
                      <option data-countrycode="RW" value="250">+250</option>
                      <option data-countrycode="SM" value="378">+378</option>
                      <option data-countrycode="ST" value="239">+239</option>
                      <option data-countrycode="SA" value="966">+966</option>
                      <option data-countrycode="SN" value="221">+221</option>
                      <option data-countrycode="CS" value="381">+381</option>
                      <option data-countrycode="SC" value="248">+248</option>
                      <option data-countrycode="SL" value="232">+232</option>
                      <option data-countrycode="SG" value="65">+65</option>
                      <option data-countrycode="SK" value="421">+421</option>
                      <option data-countrycode="SI" value="386">+386</option>
                      <option data-countrycode="SB" value="677">+677</option>
                      <option data-countrycode="SO" value="252">+252</option>
                      <option data-countrycode="ZA" value="27">+27</option>
                      <option data-countrycode="ES" value="34">+34</option>
                      <option data-countrycode="LK" value="94">+94</option>
                      <option data-countrycode="SH" value="290">+290</option>
                      <option data-countrycode="KN" value="1869">+1869</option>
                      <option data-countrycode="SC" value="1758">+1758</option>
                      <option data-countrycode="SR" value="597">+597</option>
                      <option data-countrycode="SD" value="249">+249</option>
                      <option data-countrycode="SZ" value="268">+268</option>
                      <option data-countrycode="SE" value="46">+46</option>
                      <option data-countrycode="CH" value="41">+41</option>
                      <!-- <option data-countryCode="SY" value="963">Syria +963</option> -->
                      <option data-countrycode="TW" value="886">+886</option>
                      <option data-countrycode="TJ" value="992">+992</option>
                      <option data-countrycode="TH" value="66">+66</option>
                      <option data-countrycode="TG" value="228">+228</option>
                      <option data-countrycode="TO" value="676">+676</option>
                      <option data-countrycode="TT" value="1868">+1868</option>
                      <option data-countrycode="TN" value="216">+216</option>
                      <option data-countrycode="TR" value="90">+90</option>
                      <option data-countrycode="TM" value="993">+993</option>
                      <option data-countrycode="TC" value="1649">+1649</option>
                      <option data-countrycode="TV" value="688">+688</option>
                      <option data-countrycode="UG" value="256">+256</option>
                      <option data-countrycode="UA" value="380">+380</option>
                      <option data-countrycode="AE" value="971">+971</option>
                      <option data-countrycode="UY" value="598">+598</option>
                      <option data-countrycode="UZ" value="998">+998</option>
                      <option data-countrycode="VU" value="678">+678</option>
                      <option data-countrycode="VA" value="379">+379</option>
                      <option data-countrycode="VE" value="58">+58</option>
                      <option data-countrycode="VN" value="84">+84</option>
                      <option data-countrycode="VG" value="1">+1</option>
                      <option data-countrycode="VI" value="1">+1</option>
                      <option data-countrycode="WF" value="681">+681</option>
                      <option data-countrycode="YE" value="969">+969</option>
                      <option data-countrycode="YE" value="967">+967</option>
                      <option data-countrycode="ZM" value="260">+260</option>
                      <option data-countrycode="ZW" value="263">+263</option>
                    </select>
                    <input required="" name="father_mobile_phone[]" type="number" class="col-md-10" placeholder="Mobile" id="father_mobile" value="<?php echo $data_id["Father_mobile"]; ?>" style="padding-left:80px;"> 
                    <button class="add_field_button_father">+</button>
                
              </div>
				<br /><br />

		<?php } if (!empty($data_id["Father_mobile_other"]) ) { 
			$data_id["Father_mobile_other"] = explode(',',$data_id["Father_mobile_other"] );
			$otherNumber[0] =str_replace("-", "", $otherNumber[0]);
			for($i=0; $i< count($data_id["Father_mobile_other"]); $i++){  
				$otherNumber = explode( "-" , $data_id["Father_mobile_other"][$i]);
				?>
					
				<div class="input_fields_wrap_additional_father" style="margin-bottom: 14px;">
                    <select required="" class="countryCodeNumber father_other_<?php echo $i; ?>" name="father_mobile_code[]">
                      <!-- Countries often selected by users can be moved to the top of the list. -->
                      <!-- Countries known to be subject to general US embargo are commented out by default. -->
                      <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->
                    
                      <option data-countrycode="US" value="1">+1</option>
                      <option data-countrycode="GB" value="44">+44</option>
                      <option data-countrycode="DZ" value="213">+213</option>
                      <option data-countrycode="AD" value="376">+376</option>
                      <option data-countrycode="AO" value="244">+244</option>
                      <option data-countrycode="AI" value="1264">+1264</option>
                      <option data-countrycode="AG" value="1268">+1268</option>
                      <option data-countrycode="AR" value="54">+54</option>
                      <option data-countrycode="AM" value="374">+374</option>
                      <option data-countrycode="AW" value="297">+297</option>
                      <option data-countrycode="AU" value="61">+61</option>
                      <option data-countrycode="AT" value="43">+43</option>
                      <option data-countrycode="AZ" value="994">+994</option>
                      <option data-countrycode="BS" value="1242">+1242</option>
                      <option data-countrycode="BH" value="973">+973</option>
                      <option data-countrycode="BD" value="880">+880</option>
                      <option data-countrycode="BB" value="1246">+1246</option>
                      <option data-countrycode="BY" value="375">+375</option>
                      <option data-countrycode="BE" value="32">+32</option>
                      <option data-countrycode="BZ" value="501">+501</option>
                      <option data-countrycode="BJ" value="229">+229</option>
                      <option data-countrycode="BM" value="1441">+1441</option>
                      <option data-countrycode="BT" value="975">+975</option>
                      <option data-countrycode="BO" value="591">+591</option>
                      <option data-countrycode="BA" value="387">+387</option>
                      <option data-countrycode="BW" value="267">+267</option>
                      <option data-countrycode="BR" value="55">+55</option>
                      <option data-countrycode="BN" value="673">+673</option>
                      <option data-countrycode="BG" value="359">+359</option>
                      <option data-countrycode="BF" value="226">+226</option>
                      <option data-countrycode="BI" value="257">+257</option>
                      <option data-countrycode="KH" value="855">+855</option>
                      <option data-countrycode="CM" value="237">+237</option>
                      <option data-countrycode="CA" value="1">+1</option>
                      <option data-countrycode="CV" value="238">+238</option>
                    
                      <option data-countrycode="KY" value="1345">+1345</option>
                      <option data-countrycode="CF" value="236">+236</option>
                      <option data-countrycode="CL" value="56">+56</option>
                      <option data-countrycode="CN" value="86">+86</option>
                      <option data-countrycode="CO" value="57">+57</option>
                      <option data-countrycode="KM" value="269">+269</option>
                      <option data-countrycode="CG" value="242">+242</option>
                      <option data-countrycode="CK" value="682">+682</option>
                      <option data-countrycode="CR" value="506">+506</option>
                      <option data-countrycode="HR" value="385">+385</option>
                      <!-- <option data-countryCode="CU" value="53">Cuba +53</option> -->
                      <option data-countrycode="CY" value="90">+90</option>
                      <option data-countrycode="CY" value="357">+357</option>
                      <option data-countrycode="CZ" value="420">+420</option>
                      <option data-countrycode="DK" value="45">+45</option>
                      <option data-countrycode="DJ" value="253">+253</option>
                      <option data-countrycode="DM" value="1809">+1809</option>
                      <option data-countrycode="DO" value="1809">+1809</option>
                      <option data-countrycode="EC" value="593">+593</option>
                      <option data-countrycode="EG" value="20">+20</option>
                      <option data-countrycode="SV" value="503">+503</option>
                      <option data-countrycode="GQ" value="240">+240</option>
                      <option data-countrycode="ER" value="291">+291</option>
                      <option data-countrycode="EE" value="372">+372</option>
                      <option data-countrycode="ET" value="251">+251</option>
                      <option data-countrycode="FK" value="500">+500</option>
                      <option data-countrycode="FO" value="298">+298</option>
                      <option data-countrycode="FJ" value="679">+679</option>
                      <option data-countrycode="FI" value="358">+358</option>
                      <option data-countrycode="FR" value="33">+33</option>
                      <option data-countrycode="GF" value="594">+594</option>
                      <option data-countrycode="PF" value="689">+689</option>
                      <option data-countrycode="GA" value="241">+241</option>
                      <option data-countrycode="GM" value="220">+220</option>
                      <option data-countrycode="GE" value="7880">+7880</option>
                      <option data-countrycode="DE" value="49">+49</option>
                      <option data-countrycode="GH" value="233">+233</option>
                      <option data-countrycode="GI" value="350">+350</option>
                      <option data-countrycode="GR" value="30">+30</option>
                      <option data-countrycode="GL" value="299">+299</option>
                      <option data-countrycode="GD" value="1473">+1473</option>
                      <option data-countrycode="GP" value="590">+590</option>
                      <option data-countrycode="GU" value="671">+671</option>
                      <option data-countrycode="GT" value="502">+502</option>
                      <option data-countrycode="GN" value="224">+224</option>
                      <option data-countrycode="GW" value="245">+245</option>
                      <option data-countrycode="GY" value="592">+592</option>
                      <option data-countrycode="HT" value="509">+509</option>
                      <option data-countrycode="HN" value="504">+504</option>
                      <option data-countrycode="HK" value="852">+852</option>
                      <option data-countrycode="HU" value="36">+36</option>
                      <option data-countrycode="IS" value="354">+354</option>
                      <option data-countrycode="IN" value="91">+91</option>
                      <option data-countrycode="ID" value="62">+62</option>
                      <option data-countrycode="IQ" value="964">+964</option>
                      <!-- <option data-countryCode="IR" value="98">Iran +98</option> -->
                      <option data-countrycode="IE" value="353">+353</option>
                      <option data-countrycode="IL" value="972">+972</option>
                      <option data-countrycode="IT" value="39">+39</option>
                      <option data-countrycode="JM" value="1876">+1876</option>
                      <option data-countrycode="JP" value="81">+81</option>
                      <option data-countrycode="JO" value="962">+962</option>
                      <option data-countrycode="KZ" value="7">+7</option>
                      <option data-countrycode="KE" value="254">+254</option>
                      <option data-countrycode="KI" value="686">+686</option>
                      <option data-countrycode="KR" value="82">+82</option>
                      <option data-countrycode="KW" value="965">+965</option>
                      <option data-countrycode="KG" value="996">+996</option>
                      <option data-countrycode="LA" value="856">+856</option>
                      <option data-countrycode="LV" value="371">+371</option>
                      <option data-countrycode="LB" value="961">+961</option>
                      <option data-countrycode="LS" value="266">+266</option>
                      <option data-countrycode="LR" value="231">+231</option>
                      <option data-countrycode="LY" value="218">+218</option>
                      <option data-countrycode="LI" value="417">+417</option>
                      <option data-countrycode="LT" value="370">+370</option>
                      <option data-countrycode="LU" value="352">+352</option>
                      <option data-countrycode="MO" value="853">+853</option>
                      <option data-countrycode="MK" value="389">+389</option>
                      <option data-countrycode="MG" value="261">+261</option>
                      <option data-countrycode="MW" value="265">+265</option>
                      <option data-countrycode="MY" value="60">+60</option>
                      <option data-countrycode="MV" value="960">+960</option>
                      <option data-countrycode="ML" value="223">+223</option>
                      <option data-countrycode="MT" value="356">+356</option>
                      <option data-countrycode="MH" value="692">+692</option>
                      <option data-countrycode="MQ" value="596">+596</option>
                      <option data-countrycode="MR" value="222">+222</option>
                      <option data-countrycode="YT" value="269">+269</option>
                      <option data-countrycode="MX" value="52">+52</option>
                      <option data-countrycode="FM" value="691">+691</option>
                      <option data-countrycode="MD" value="373">+373</option>
                      <option data-countrycode="MC" value="377">+377</option>
                      <option data-countrycode="MN" value="976">+976</option>
                      <option data-countrycode="MS" value="1664">+1664</option>
                      <option data-countrycode="MA" value="212">+212</option>
                      <option data-countrycode="MZ" value="258">+258</option>
                      <option data-countrycode="MN" value="95">+95</option>
                      <option data-countrycode="NA" value="264">+264</option>
                      <option data-countrycode="NR" value="674">+674</option>
                      <option data-countrycode="NP" value="977">+977</option>
                      <option data-countrycode="NL" value="31">+31</option>
                      <option data-countrycode="NC" value="687">+687</option>
                      <option data-countrycode="NZ" value="64">+64</option>
                      <option data-countrycode="NI" value="505">+505</option>
                      <option data-countrycode="NE" value="227">+227</option>
                      <option data-countrycode="NG" value="234">+234</option>
                      <option data-countrycode="NU" value="683">+683</option>
                      <option data-countrycode="NF" value="672">+672</option>
                      <option data-countrycode="NP" value="670">+670</option>
                      <option data-countrycode="NO" value="47">+47</option>
                      <option data-countrycode="OM" value="968">+968</option>
                      <option selected="" data-countrycode="PK" value="92">+92</option>
                      <option data-countrycode="PW" value="680">+680</option>
                      <option data-countrycode="PA" value="507">+507</option>
                      <option data-countrycode="PG" value="675">+675</option>
                      <option data-countrycode="PY" value="595">+595</option>
                      <option data-countrycode="PE" value="51">+51</option>
                      <option data-countrycode="PH" value="63">+63</option>
                      <option data-countrycode="PL" value="48">+48</option>
                      <option data-countrycode="PT" value="351">+351</option>
                      <option data-countrycode="PR" value="1787">+1787</option>
                      <option data-countrycode="QA" value="974">+974</option>
                      <option data-countrycode="RE" value="262">+262</option>
                      <option data-countrycode="RO" value="40">+40</option>
                      <option data-countrycode="RU" value="7">+7</option>
                      <option data-countrycode="RW" value="250">+250</option>
                      <option data-countrycode="SM" value="378">+378</option>
                      <option data-countrycode="ST" value="239">+239</option>
                      <option data-countrycode="SA" value="966">+966</option>
                      <option data-countrycode="SN" value="221">+221</option>
                      <option data-countrycode="CS" value="381">+381</option>
                      <option data-countrycode="SC" value="248">+248</option>
                      <option data-countrycode="SL" value="232">+232</option>
                      <option data-countrycode="SG" value="65">+65</option>
                      <option data-countrycode="SK" value="421">+421</option>
                      <option data-countrycode="SI" value="386">+386</option>
                      <option data-countrycode="SB" value="677">+677</option>
                      <option data-countrycode="SO" value="252">+252</option>
                      <option data-countrycode="ZA" value="27">+27</option>
                      <option data-countrycode="ES" value="34">+34</option>
                      <option data-countrycode="LK" value="94">+94</option>
                      <option data-countrycode="SH" value="290">+290</option>
                      <option data-countrycode="KN" value="1869">+1869</option>
                      <option data-countrycode="SC" value="1758">+1758</option>
                      <option data-countrycode="SR" value="597">+597</option>
                      <option data-countrycode="SD" value="249">+249</option>
                      <option data-countrycode="SZ" value="268">+268</option>
                      <option data-countrycode="SE" value="46">+46</option>
                      <option data-countrycode="CH" value="41">+41</option>
                      <!-- <option data-countryCode="SY" value="963">Syria +963</option> -->
                      <option data-countrycode="TW" value="886">+886</option>
                      <option data-countrycode="TJ" value="992">+992</option>
                      <option data-countrycode="TH" value="66">+66</option>
                      <option data-countrycode="TG" value="228">+228</option>
                      <option data-countrycode="TO" value="676">+676</option>
                      <option data-countrycode="TT" value="1868">+1868</option>
                      <option data-countrycode="TN" value="216">+216</option>
                      <option data-countrycode="TR" value="90">+90</option>
                      <option data-countrycode="TM" value="993">+993</option>
                      <option data-countrycode="TC" value="1649">+1649</option>
                      <option data-countrycode="TV" value="688">+688</option>
                      <option data-countrycode="UG" value="256">+256</option>
                      <option data-countrycode="UA" value="380">+380</option>
                      <option data-countrycode="AE" value="971">+971</option>
                      <option data-countrycode="UY" value="598">+598</option>
                      <option data-countrycode="UZ" value="998">+998</option>
                      <option data-countrycode="VU" value="678">+678</option>
                      <option data-countrycode="VA" value="379">+379</option>
                      <option data-countrycode="VE" value="58">+58</option>
                      <option data-countrycode="VN" value="84">+84</option>
                      <option data-countrycode="VG" value="1">+1</option>
                      <option data-countrycode="VI" value="1">+1</option>
                      <option data-countrycode="WF" value="681">+681</option>
                      <option data-countrycode="YE" value="969">+969</option>
                      <option data-countrycode="YE" value="967">+967</option>
                      <option data-countrycode="ZM" value="260">+260</option>
                      <option data-countrycode="ZW" value="263">+263</option>
                    </select>
                    <input required="" name="father_mobile_phone[]" type="number" class="col-md-10" placeholder="Mobile" id="father_mobile" value="<?php echo $otherNumber[1]; ?>" style="padding-left:80px;"> 
                   <a href="#" class="remove_field1">X</a>
                </div>

				<script>$(".father_other_<?php echo $i; ?>").val(<?php echo $otherNumber[0]; ?>)</script>

		<?php	}
		?>


		<?php } ?>
 <div class="fatherContactArea">
  </div>
		<input type="text" class="" <?=$readOnly;?> placeholder="Father NIC <?=$mendotryf;?>" name="father_nic" id="father_nic" value="<?=$data_id["Father_nic"];?>" /><br /><br />
		<input type="text" class="" placeholder="Father Email" name="father_email" id="father_email" value="<?=$data_id["Father_email"];?>" />

	</div><!-- col-md-6 -->
<div class="col-md-6">
	
	<input type="text" class="" <?=$readOnly2;?> placeholder="Mother Name <?=$mendotrym;?>" name="mother_name" id="mother_name" value="<?=$data_id["Mother_name"];?>" /><br /><br />
	<?php  if (!empty($data_id["Mother_mobile"])) {
		$data_id["Mother_mobile"] = substr($data_id["Mother_mobile"], 1);
		$data_id["Mother_mobile"] = str_replace("-", "", $data_id["Mother_mobile"]);
	 ?>	
	 <div class="input_fields_wrap_mother" style="margin-bottom: 14px;">
	            <select required="" class="countryCodeNumber" name="mother_mobile_code[]">
                      <!-- Countries often selected by users can be moved to the top of the list. -->
                      <!-- Countries known to be subject to general US embargo are commented out by default. -->
                      <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->
                    
                      <option data-countrycode="US" value="1">+1</option>
                      <option data-countrycode="GB" value="44">+44</option>
                      <option data-countrycode="DZ" value="213">+213</option>
                      <option data-countrycode="AD" value="376">+376</option>
                      <option data-countrycode="AO" value="244">+244</option>
                      <option data-countrycode="AI" value="1264">+1264</option>
                      <option data-countrycode="AG" value="1268">+1268</option>
                      <option data-countrycode="AR" value="54">+54</option>
                      <option data-countrycode="AM" value="374">+374</option>
                      <option data-countrycode="AW" value="297">+297</option>
                      <option data-countrycode="AU" value="61">+61</option>
                      <option data-countrycode="AT" value="43">+43</option>
                      <option data-countrycode="AZ" value="994">+994</option>
                      <option data-countrycode="BS" value="1242">+1242</option>
                      <option data-countrycode="BH" value="973">+973</option>
                      <option data-countrycode="BD" value="880">+880</option>
                      <option data-countrycode="BB" value="1246">+1246</option>
                      <option data-countrycode="BY" value="375">+375</option>
                      <option data-countrycode="BE" value="32">+32</option>
                      <option data-countrycode="BZ" value="501">+501</option>
                      <option data-countrycode="BJ" value="229">+229</option>
                      <option data-countrycode="BM" value="1441">+1441</option>
                      <option data-countrycode="BT" value="975">+975</option>
                      <option data-countrycode="BO" value="591">+591</option>
                      <option data-countrycode="BA" value="387">+387</option>
                      <option data-countrycode="BW" value="267">+267</option>
                      <option data-countrycode="BR" value="55">+55</option>
                      <option data-countrycode="BN" value="673">+673</option>
                      <option data-countrycode="BG" value="359">+359</option>
                      <option data-countrycode="BF" value="226">+226</option>
                      <option data-countrycode="BI" value="257">+257</option>
                      <option data-countrycode="KH" value="855">+855</option>
                      <option data-countrycode="CM" value="237">+237</option>
                      <option data-countrycode="CA" value="1">+1</option>
                      <option data-countrycode="CV" value="238">+238</option>
                    
                      <option data-countrycode="KY" value="1345">+1345</option>
                      <option data-countrycode="CF" value="236">+236</option>
                      <option data-countrycode="CL" value="56">+56</option>
                      <option data-countrycode="CN" value="86">+86</option>
                      <option data-countrycode="CO" value="57">+57</option>
                      <option data-countrycode="KM" value="269">+269</option>
                      <option data-countrycode="CG" value="242">+242</option>
                      <option data-countrycode="CK" value="682">+682</option>
                      <option data-countrycode="CR" value="506">+506</option>
                      <option data-countrycode="HR" value="385">+385</option>
                      <!-- <option data-countryCode="CU" value="53">Cuba +53</option> -->
                      <option data-countrycode="CY" value="90">+90</option>
                      <option data-countrycode="CY" value="357">+357</option>
                      <option data-countrycode="CZ" value="420">+420</option>
                      <option data-countrycode="DK" value="45">+45</option>
                      <option data-countrycode="DJ" value="253">+253</option>
                      <option data-countrycode="DM" value="1809">+1809</option>
                      <option data-countrycode="DO" value="1809">+1809</option>
                      <option data-countrycode="EC" value="593">+593</option>
                      <option data-countrycode="EG" value="20">+20</option>
                      <option data-countrycode="SV" value="503">+503</option>
                      <option data-countrycode="GQ" value="240">+240</option>
                      <option data-countrycode="ER" value="291">+291</option>
                      <option data-countrycode="EE" value="372">+372</option>
                      <option data-countrycode="ET" value="251">+251</option>
                      <option data-countrycode="FK" value="500">+500</option>
                      <option data-countrycode="FO" value="298">+298</option>
                      <option data-countrycode="FJ" value="679">+679</option>
                      <option data-countrycode="FI" value="358">+358</option>
                      <option data-countrycode="FR" value="33">+33</option>
                      <option data-countrycode="GF" value="594">+594</option>
                      <option data-countrycode="PF" value="689">+689</option>
                      <option data-countrycode="GA" value="241">+241</option>
                      <option data-countrycode="GM" value="220">+220</option>
                      <option data-countrycode="GE" value="7880">+7880</option>
                      <option data-countrycode="DE" value="49">+49</option>
                      <option data-countrycode="GH" value="233">+233</option>
                      <option data-countrycode="GI" value="350">+350</option>
                      <option data-countrycode="GR" value="30">+30</option>
                      <option data-countrycode="GL" value="299">+299</option>
                      <option data-countrycode="GD" value="1473">+1473</option>
                      <option data-countrycode="GP" value="590">+590</option>
                      <option data-countrycode="GU" value="671">+671</option>
                      <option data-countrycode="GT" value="502">+502</option>
                      <option data-countrycode="GN" value="224">+224</option>
                      <option data-countrycode="GW" value="245">+245</option>
                      <option data-countrycode="GY" value="592">+592</option>
                      <option data-countrycode="HT" value="509">+509</option>
                      <option data-countrycode="HN" value="504">+504</option>
                      <option data-countrycode="HK" value="852">+852</option>
                      <option data-countrycode="HU" value="36">+36</option>
                      <option data-countrycode="IS" value="354">+354</option>
                      <option data-countrycode="IN" value="91">+91</option>
                      <option data-countrycode="ID" value="62">+62</option>
                      <option data-countrycode="IQ" value="964">+964</option>
                      <!-- <option data-countryCode="IR" value="98">Iran +98</option> -->
                      <option data-countrycode="IE" value="353">+353</option>
                      <option data-countrycode="IL" value="972">+972</option>
                      <option data-countrycode="IT" value="39">+39</option>
                      <option data-countrycode="JM" value="1876">+1876</option>
                      <option data-countrycode="JP" value="81">+81</option>
                      <option data-countrycode="JO" value="962">+962</option>
                      <option data-countrycode="KZ" value="7">+7</option>
                      <option data-countrycode="KE" value="254">+254</option>
                      <option data-countrycode="KI" value="686">+686</option>
                      <option data-countrycode="KR" value="82">+82</option>
                      <option data-countrycode="KW" value="965">+965</option>
                      <option data-countrycode="KG" value="996">+996</option>
                      <option data-countrycode="LA" value="856">+856</option>
                      <option data-countrycode="LV" value="371">+371</option>
                      <option data-countrycode="LB" value="961">+961</option>
                      <option data-countrycode="LS" value="266">+266</option>
                      <option data-countrycode="LR" value="231">+231</option>
                      <option data-countrycode="LY" value="218">+218</option>
                      <option data-countrycode="LI" value="417">+417</option>
                      <option data-countrycode="LT" value="370">+370</option>
                      <option data-countrycode="LU" value="352">+352</option>
                      <option data-countrycode="MO" value="853">+853</option>
                      <option data-countrycode="MK" value="389">+389</option>
                      <option data-countrycode="MG" value="261">+261</option>
                      <option data-countrycode="MW" value="265">+265</option>
                      <option data-countrycode="MY" value="60">+60</option>
                      <option data-countrycode="MV" value="960">+960</option>
                      <option data-countrycode="ML" value="223">+223</option>
                      <option data-countrycode="MT" value="356">+356</option>
                      <option data-countrycode="MH" value="692">+692</option>
                      <option data-countrycode="MQ" value="596">+596</option>
                      <option data-countrycode="MR" value="222">+222</option>
                      <option data-countrycode="YT" value="269">+269</option>
                      <option data-countrycode="MX" value="52">+52</option>
                      <option data-countrycode="FM" value="691">+691</option>
                      <option data-countrycode="MD" value="373">+373</option>
                      <option data-countrycode="MC" value="377">+377</option>
                      <option data-countrycode="MN" value="976">+976</option>
                      <option data-countrycode="MS" value="1664">+1664</option>
                      <option data-countrycode="MA" value="212">+212</option>
                      <option data-countrycode="MZ" value="258">+258</option>
                      <option data-countrycode="MN" value="95">+95</option>
                      <option data-countrycode="NA" value="264">+264</option>
                      <option data-countrycode="NR" value="674">+674</option>
                      <option data-countrycode="NP" value="977">+977</option>
                      <option data-countrycode="NL" value="31">+31</option>
                      <option data-countrycode="NC" value="687">+687</option>
                      <option data-countrycode="NZ" value="64">+64</option>
                      <option data-countrycode="NI" value="505">+505</option>
                      <option data-countrycode="NE" value="227">+227</option>
                      <option data-countrycode="NG" value="234">+234</option>
                      <option data-countrycode="NU" value="683">+683</option>
                      <option data-countrycode="NF" value="672">+672</option>
                      <option data-countrycode="NP" value="670">+670</option>
                      <option data-countrycode="NO" value="47">+47</option>
                      <option data-countrycode="OM" value="968">+968</option>
                      <option selected="" data-countrycode="PK" value="92">+92</option>
                      <option data-countrycode="PW" value="680">+680</option>
                      <option data-countrycode="PA" value="507">+507</option>
                      <option data-countrycode="PG" value="675">+675</option>
                      <option data-countrycode="PY" value="595">+595</option>
                      <option data-countrycode="PE" value="51">+51</option>
                      <option data-countrycode="PH" value="63">+63</option>
                      <option data-countrycode="PL" value="48">+48</option>
                      <option data-countrycode="PT" value="351">+351</option>
                      <option data-countrycode="PR" value="1787">+1787</option>
                      <option data-countrycode="QA" value="974">+974</option>
                      <option data-countrycode="RE" value="262">+262</option>
                      <option data-countrycode="RO" value="40">+40</option>
                      <option data-countrycode="RU" value="7">+7</option>
                      <option data-countrycode="RW" value="250">+250</option>
                      <option data-countrycode="SM" value="378">+378</option>
                      <option data-countrycode="ST" value="239">+239</option>
                      <option data-countrycode="SA" value="966">+966</option>
                      <option data-countrycode="SN" value="221">+221</option>
                      <option data-countrycode="CS" value="381">+381</option>
                      <option data-countrycode="SC" value="248">+248</option>
                      <option data-countrycode="SL" value="232">+232</option>
                      <option data-countrycode="SG" value="65">+65</option>
                      <option data-countrycode="SK" value="421">+421</option>
                      <option data-countrycode="SI" value="386">+386</option>
                      <option data-countrycode="SB" value="677">+677</option>
                      <option data-countrycode="SO" value="252">+252</option>
                      <option data-countrycode="ZA" value="27">+27</option>
                      <option data-countrycode="ES" value="34">+34</option>
                      <option data-countrycode="LK" value="94">+94</option>
                      <option data-countrycode="SH" value="290">+290</option>
                      <option data-countrycode="KN" value="1869">+1869</option>
                      <option data-countrycode="SC" value="1758">+1758</option>
                      <option data-countrycode="SR" value="597">+597</option>
                      <option data-countrycode="SD" value="249">+249</option>
                      <option data-countrycode="SZ" value="268">+268</option>
                      <option data-countrycode="SE" value="46">+46</option>
                      <option data-countrycode="CH" value="41">+41</option>
                      <!-- <option data-countryCode="SY" value="963">Syria +963</option> -->
                      <option data-countrycode="TW" value="886">+886</option>
                      <option data-countrycode="TJ" value="992">+992</option>
                      <option data-countrycode="TH" value="66">+66</option>
                      <option data-countrycode="TG" value="228">+228</option>
                      <option data-countrycode="TO" value="676">+676</option>
                      <option data-countrycode="TT" value="1868">+1868</option>
                      <option data-countrycode="TN" value="216">+216</option>
                      <option data-countrycode="TR" value="90">+90</option>
                      <option data-countrycode="TM" value="993">+993</option>
                      <option data-countrycode="TC" value="1649">+1649</option>
                      <option data-countrycode="TV" value="688">+688</option>
                      <option data-countrycode="UG" value="256">+256</option>
                      <option data-countrycode="UA" value="380">+380</option>
                      <option data-countrycode="AE" value="971">+971</option>
                      <option data-countrycode="UY" value="598">+598</option>
                      <option data-countrycode="UZ" value="998">+998</option>
                      <option data-countrycode="VU" value="678">+678</option>
                      <option data-countrycode="VA" value="379">+379</option>
                      <option data-countrycode="VE" value="58">+58</option>
                      <option data-countrycode="VN" value="84">+84</option>
                      <option data-countrycode="VG" value="1">+1</option>
                      <option data-countrycode="VI" value="1">+1</option>
                      <option data-countrycode="WF" value="681">+681</option>
                      <option data-countrycode="YE" value="969">+969</option>
                      <option data-countrycode="YE" value="967">+967</option>
                      <option data-countrycode="ZM" value="260">+260</option>
                      <option data-countrycode="ZW" value="263">+263</option>
                </select>
                <input required="" name="mother_mobile_phone[]" type="number" class="col-md-10" placeholder="Mobile" id="father_mobile" value="<?php echo $data_id["Mother_mobile"]; ?>" style="padding-left:80px;"> 
                <button class="add_field_button_mother">+</button>
    </div>
				<br /><br />
	<?php } if (!empty($data_id["Mother_mobile_other"]) ) { 
		$data_id["Mother_mobile_other"] = explode(',',$data_id["Mother_mobile_other"] );
		for($i=0; $i< count($data_id["Mother_mobile_other"]); $i++){ 
			$otherNumber = explode( "-" , $data_id["Mother_mobile_other"][$i]);
			$otherNumber[0] =str_replace("-", "", $otherNumber[0]);
		 ?>
				<div class="input_fields_wrap_additional_mother" style="margin-bottom: 14px;">
                    <select required="" class="countryCodeNumber mother_other_<?php echo $i; ?>" name="mother_mobile_code[]">
                      <!-- Countries often selected by users can be moved to the top of the list. -->
                      <!-- Countries known to be subject to general US embargo are commented out by default. -->
                      <!-- The data-countryCode attribute is populated with ISO country code, and value is int'l calling code. -->
                    
                      <option data-countrycode="US" value="1">+1</option>
                      <option data-countrycode="GB" value="44">+44</option>
                      <option data-countrycode="DZ" value="213">+213</option>
                      <option data-countrycode="AD" value="376">+376</option>
                      <option data-countrycode="AO" value="244">+244</option>
                      <option data-countrycode="AI" value="1264">+1264</option>
                      <option data-countrycode="AG" value="1268">+1268</option>
                      <option data-countrycode="AR" value="54">+54</option>
                      <option data-countrycode="AM" value="374">+374</option>
                      <option data-countrycode="AW" value="297">+297</option>
                      <option data-countrycode="AU" value="61">+61</option>
                      <option data-countrycode="AT" value="43">+43</option>
                      <option data-countrycode="AZ" value="994">+994</option>
                      <option data-countrycode="BS" value="1242">+1242</option>
                      <option data-countrycode="BH" value="973">+973</option>
                      <option data-countrycode="BD" value="880">+880</option>
                      <option data-countrycode="BB" value="1246">+1246</option>
                      <option data-countrycode="BY" value="375">+375</option>
                      <option data-countrycode="BE" value="32">+32</option>
                      <option data-countrycode="BZ" value="501">+501</option>
                      <option data-countrycode="BJ" value="229">+229</option>
                      <option data-countrycode="BM" value="1441">+1441</option>
                      <option data-countrycode="BT" value="975">+975</option>
                      <option data-countrycode="BO" value="591">+591</option>
                      <option data-countrycode="BA" value="387">+387</option>
                      <option data-countrycode="BW" value="267">+267</option>
                      <option data-countrycode="BR" value="55">+55</option>
                      <option data-countrycode="BN" value="673">+673</option>
                      <option data-countrycode="BG" value="359">+359</option>
                      <option data-countrycode="BF" value="226">+226</option>
                      <option data-countrycode="BI" value="257">+257</option>
                      <option data-countrycode="KH" value="855">+855</option>
                      <option data-countrycode="CM" value="237">+237</option>
                      <option data-countrycode="CA" value="1">+1</option>
                      <option data-countrycode="CV" value="238">+238</option>
                    
                      <option data-countrycode="KY" value="1345">+1345</option>
                      <option data-countrycode="CF" value="236">+236</option>
                      <option data-countrycode="CL" value="56">+56</option>
                      <option data-countrycode="CN" value="86">+86</option>
                      <option data-countrycode="CO" value="57">+57</option>
                      <option data-countrycode="KM" value="269">+269</option>
                      <option data-countrycode="CG" value="242">+242</option>
                      <option data-countrycode="CK" value="682">+682</option>
                      <option data-countrycode="CR" value="506">+506</option>
                      <option data-countrycode="HR" value="385">+385</option>
                      <!-- <option data-countryCode="CU" value="53">Cuba +53</option> -->
                      <option data-countrycode="CY" value="90">+90</option>
                      <option data-countrycode="CY" value="357">+357</option>
                      <option data-countrycode="CZ" value="420">+420</option>
                      <option data-countrycode="DK" value="45">+45</option>
                      <option data-countrycode="DJ" value="253">+253</option>
                      <option data-countrycode="DM" value="1809">+1809</option>
                      <option data-countrycode="DO" value="1809">+1809</option>
                      <option data-countrycode="EC" value="593">+593</option>
                      <option data-countrycode="EG" value="20">+20</option>
                      <option data-countrycode="SV" value="503">+503</option>
                      <option data-countrycode="GQ" value="240">+240</option>
                      <option data-countrycode="ER" value="291">+291</option>
                      <option data-countrycode="EE" value="372">+372</option>
                      <option data-countrycode="ET" value="251">+251</option>
                      <option data-countrycode="FK" value="500">+500</option>
                      <option data-countrycode="FO" value="298">+298</option>
                      <option data-countrycode="FJ" value="679">+679</option>
                      <option data-countrycode="FI" value="358">+358</option>
                      <option data-countrycode="FR" value="33">+33</option>
                      <option data-countrycode="GF" value="594">+594</option>
                      <option data-countrycode="PF" value="689">+689</option>
                      <option data-countrycode="GA" value="241">+241</option>
                      <option data-countrycode="GM" value="220">+220</option>
                      <option data-countrycode="GE" value="7880">+7880</option>
                      <option data-countrycode="DE" value="49">+49</option>
                      <option data-countrycode="GH" value="233">+233</option>
                      <option data-countrycode="GI" value="350">+350</option>
                      <option data-countrycode="GR" value="30">+30</option>
                      <option data-countrycode="GL" value="299">+299</option>
                      <option data-countrycode="GD" value="1473">+1473</option>
                      <option data-countrycode="GP" value="590">+590</option>
                      <option data-countrycode="GU" value="671">+671</option>
                      <option data-countrycode="GT" value="502">+502</option>
                      <option data-countrycode="GN" value="224">+224</option>
                      <option data-countrycode="GW" value="245">+245</option>
                      <option data-countrycode="GY" value="592">+592</option>
                      <option data-countrycode="HT" value="509">+509</option>
                      <option data-countrycode="HN" value="504">+504</option>
                      <option data-countrycode="HK" value="852">+852</option>
                      <option data-countrycode="HU" value="36">+36</option>
                      <option data-countrycode="IS" value="354">+354</option>
                      <option data-countrycode="IN" value="91">+91</option>
                      <option data-countrycode="ID" value="62">+62</option>
                      <option data-countrycode="IQ" value="964">+964</option>
                      <!-- <option data-countryCode="IR" value="98">Iran +98</option> -->
                      <option data-countrycode="IE" value="353">+353</option>
                      <option data-countrycode="IL" value="972">+972</option>
                      <option data-countrycode="IT" value="39">+39</option>
                      <option data-countrycode="JM" value="1876">+1876</option>
                      <option data-countrycode="JP" value="81">+81</option>
                      <option data-countrycode="JO" value="962">+962</option>
                      <option data-countrycode="KZ" value="7">+7</option>
                      <option data-countrycode="KE" value="254">+254</option>
                      <option data-countrycode="KI" value="686">+686</option>
                      <option data-countrycode="KR" value="82">+82</option>
                      <option data-countrycode="KW" value="965">+965</option>
                      <option data-countrycode="KG" value="996">+996</option>
                      <option data-countrycode="LA" value="856">+856</option>
                      <option data-countrycode="LV" value="371">+371</option>
                      <option data-countrycode="LB" value="961">+961</option>
                      <option data-countrycode="LS" value="266">+266</option>
                      <option data-countrycode="LR" value="231">+231</option>
                      <option data-countrycode="LY" value="218">+218</option>
                      <option data-countrycode="LI" value="417">+417</option>
                      <option data-countrycode="LT" value="370">+370</option>
                      <option data-countrycode="LU" value="352">+352</option>
                      <option data-countrycode="MO" value="853">+853</option>
                      <option data-countrycode="MK" value="389">+389</option>
                      <option data-countrycode="MG" value="261">+261</option>
                      <option data-countrycode="MW" value="265">+265</option>
                      <option data-countrycode="MY" value="60">+60</option>
                      <option data-countrycode="MV" value="960">+960</option>
                      <option data-countrycode="ML" value="223">+223</option>
                      <option data-countrycode="MT" value="356">+356</option>
                      <option data-countrycode="MH" value="692">+692</option>
                      <option data-countrycode="MQ" value="596">+596</option>
                      <option data-countrycode="MR" value="222">+222</option>
                      <option data-countrycode="YT" value="269">+269</option>
                      <option data-countrycode="MX" value="52">+52</option>
                      <option data-countrycode="FM" value="691">+691</option>
                      <option data-countrycode="MD" value="373">+373</option>
                      <option data-countrycode="MC" value="377">+377</option>
                      <option data-countrycode="MN" value="976">+976</option>
                      <option data-countrycode="MS" value="1664">+1664</option>
                      <option data-countrycode="MA" value="212">+212</option>
                      <option data-countrycode="MZ" value="258">+258</option>
                      <option data-countrycode="MN" value="95">+95</option>
                      <option data-countrycode="NA" value="264">+264</option>
                      <option data-countrycode="NR" value="674">+674</option>
                      <option data-countrycode="NP" value="977">+977</option>
                      <option data-countrycode="NL" value="31">+31</option>
                      <option data-countrycode="NC" value="687">+687</option>
                      <option data-countrycode="NZ" value="64">+64</option>
                      <option data-countrycode="NI" value="505">+505</option>
                      <option data-countrycode="NE" value="227">+227</option>
                      <option data-countrycode="NG" value="234">+234</option>
                      <option data-countrycode="NU" value="683">+683</option>
                      <option data-countrycode="NF" value="672">+672</option>
                      <option data-countrycode="NP" value="670">+670</option>
                      <option data-countrycode="NO" value="47">+47</option>
                      <option data-countrycode="OM" value="968">+968</option>
                      <option selected="" data-countrycode="PK" value="92">+92</option>
                      <option data-countrycode="PW" value="680">+680</option>
                      <option data-countrycode="PA" value="507">+507</option>
                      <option data-countrycode="PG" value="675">+675</option>
                      <option data-countrycode="PY" value="595">+595</option>
                      <option data-countrycode="PE" value="51">+51</option>
                      <option data-countrycode="PH" value="63">+63</option>
                      <option data-countrycode="PL" value="48">+48</option>
                      <option data-countrycode="PT" value="351">+351</option>
                      <option data-countrycode="PR" value="1787">+1787</option>
                      <option data-countrycode="QA" value="974">+974</option>
                      <option data-countrycode="RE" value="262">+262</option>
                      <option data-countrycode="RO" value="40">+40</option>
                      <option data-countrycode="RU" value="7">+7</option>
                      <option data-countrycode="RW" value="250">+250</option>
                      <option data-countrycode="SM" value="378">+378</option>
                      <option data-countrycode="ST" value="239">+239</option>
                      <option data-countrycode="SA" value="966">+966</option>
                      <option data-countrycode="SN" value="221">+221</option>
                      <option data-countrycode="CS" value="381">+381</option>
                      <option data-countrycode="SC" value="248">+248</option>
                      <option data-countrycode="SL" value="232">+232</option>
                      <option data-countrycode="SG" value="65">+65</option>
                      <option data-countrycode="SK" value="421">+421</option>
                      <option data-countrycode="SI" value="386">+386</option>
                      <option data-countrycode="SB" value="677">+677</option>
                      <option data-countrycode="SO" value="252">+252</option>
                      <option data-countrycode="ZA" value="27">+27</option>
                      <option data-countrycode="ES" value="34">+34</option>
                      <option data-countrycode="LK" value="94">+94</option>
                      <option data-countrycode="SH" value="290">+290</option>
                      <option data-countrycode="KN" value="1869">+1869</option>
                      <option data-countrycode="SC" value="1758">+1758</option>
                      <option data-countrycode="SR" value="597">+597</option>
                      <option data-countrycode="SD" value="249">+249</option>
                      <option data-countrycode="SZ" value="268">+268</option>
                      <option data-countrycode="SE" value="46">+46</option>
                      <option data-countrycode="CH" value="41">+41</option>
                      <!-- <option data-countryCode="SY" value="963">Syria +963</option> -->
                      <option data-countrycode="TW" value="886">+886</option>
                      <option data-countrycode="TJ" value="992">+992</option>
                      <option data-countrycode="TH" value="66">+66</option>
                      <option data-countrycode="TG" value="228">+228</option>
                      <option data-countrycode="TO" value="676">+676</option>
                      <option data-countrycode="TT" value="1868">+1868</option>
                      <option data-countrycode="TN" value="216">+216</option>
                      <option data-countrycode="TR" value="90">+90</option>
                      <option data-countrycode="TM" value="993">+993</option>
                      <option data-countrycode="TC" value="1649">+1649</option>
                      <option data-countrycode="TV" value="688">+688</option>
                      <option data-countrycode="UG" value="256">+256</option>
                      <option data-countrycode="UA" value="380">+380</option>
                      <option data-countrycode="AE" value="971">+971</option>
                      <option data-countrycode="UY" value="598">+598</option>
                      <option data-countrycode="UZ" value="998">+998</option>
                      <option data-countrycode="VU" value="678">+678</option>
                      <option data-countrycode="VA" value="379">+379</option>
                      <option data-countrycode="VE" value="58">+58</option>
                      <option data-countrycode="VN" value="84">+84</option>
                      <option data-countrycode="VG" value="1">+1</option>
                      <option data-countrycode="VI" value="1">+1</option>
                      <option data-countrycode="WF" value="681">+681</option>
                      <option data-countrycode="YE" value="969">+969</option>
                      <option data-countrycode="YE" value="967">+967</option>
                      <option data-countrycode="ZM" value="260">+260</option>
                      <option data-countrycode="ZW" value="263">+263</option>
                    </select>
                    <input required="" name="mother_mobile_phone[]" type="number" class="col-md-10 " placeholder="Mobile" id="mother_mobile" value="<?php echo $otherNumber[1]; ?>" style="padding-left:80px;"> 
                   <a href="#" class="remove_field2">X</a>
                </div>

                <script>$(".mother_other_<?php echo $i; ?>").val(<?php echo $otherNumber[0]; ?>)</script>
	<?php	}
	?>


	<?php } ?>
   <div class="motherContactArea">
  </div>	
	<input type="text" class="" <?=$readOnly2;?> placeholder="Mother NIC <?=$mendotrym;?>" name="mother_nic" id="mother_nic" value="<?=$data_id["Mother_nic"];?>" /><br /><br />
	<input type="text" class="" placeholder="Mother Email" name="mother_email" id="mother_email" value="<?=$data_id["Mother_email"];?>" />
	
</div><!-- col-md-6 -->
	
</div>
<hr />
<div class="col-md-12 paddingBottom0">
	<div class="col-md-6">
	<?php 
	$giveBatch=true;
	//var_dump( $formBatchDetails ); ?>
		
	
		<?php  if(  ( $data_id["Grade_id"] != 15 ) && ( $data_id["Grade_id"] != 16 ) ) { ?> 
		<select name="batch_name" id="batch_name">
		  <option value="">Batch *</option>
		  <?php if( !empty($formBatchDetails)){ 
			foreach( $formBatchDetails as $d){
				if( $data_id["Batch_id"] == $d["formBatchID"] ){
					$giveBatch=true;
				}else{
					$giveBatch=false;
				}
			?>
		  <option value="<?=$d["formBatchID"];?>"  <?php if( $data_id["Batch_id"] == $d["formBatchID"] ){ echo "selected"; } ?>><?=$d["batchCategory"]; ?> 
			 (<?php echo date("j-F-Y ", strtotime( $d["BDate"] ) );?>)</option>
		  <?php } 
		  } ?>
		</select>
		<a href="#" class="showBatches">Show Batches</a>
		
		<div class="modal fade in" id="batchAvailable" role="dialog">
			<div class="modal-dialog">
			
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Batches Available</h4>
				</div>
				<div class="modal-body" id="modal-dialog">
				  
				  
				

				 
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>
			  
			  
			</div>
		</div>

		
	</div><!-- col-md-6 -->
	
	
	
	
	
	<div class="col-md-6">
	<?php //var_dump( $slotInfo ); 
		//echo $data_id["Batch_id"];?>
	  <select name="submission_time" id="submission_time">
				  <option value="">Select Time *</option>
				
				  
				   <?php   if( !empty($slotInfo)){ 
				   //if( $giveBatch ){
					foreach( $slotInfo as $d){
					?>
				  <option value="<?=$d["slotID"];?>"  <?php if( $data_id["Slot_id"] == $d["slotID"] ){ echo "selected"; } ?>><?=$d["Duration"]; ?> </option>
				  <?php } 
				  } ?>
				  
				  
				</select>
	</div><!-- col-md-6 -->
	<hr />
			<?php } ?> 
</div><!-- col-md-12 -->

<div class="col-md-12">
	<div class="col-md-12">
		<textarea placeholder="Comments" rows="4" cols="50" name="comments" id="comments"><?=$data_id["Comments"];?></textarea>
	</div><!-- col-md-12 -->
</div><!-- col-md-12 -->
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
                                            <input type="date" class="" placeholder="<?php echo date("Y-m-d", strtotime($data_id['Form_discussion_date']));?>" name="discussion_date" id="discussion_date_update" value="<?php echo date("Y-m-d", strtotime($data_id['Form_discussion_date']));?>" />
                                        </div>
                                        <!-- col-md-6 -->
										
                                        
                                        <div class="col-md-6" style="padding-right:0;">
                                            <input type="time" class="" placeholder="" name="discussion_time" id="discussion_time_update" value="<?= $data_id['Form_discussion_time'];?>" />
                                        </div>
                                        <!-- col-md-6 -->
                                    </div>
                                    <!-- col-md-12 -->
                                </div>
                                <!-- col-md-12 -->
                                <hr />
                            </div>
<hr />
<div class="col-md-12">
	<div class="col-md-12 paddingBottom0">
		<input type="checkbox" id="ps" name="ps" <?php if( $data_id["Photo_submitted"] == 1){ echo "checked"; }?> style="display:block;visibility:hidden;"> <label for="ps">Photos Submitted <span class="required">*</span></label>
	</div><!-- col-md-12 -->
	<div class="col-md-12 paddingBottom0">
		
		<input type="checkbox" id="bco" name="bco" <?php if( $data_id["Birth_o"] == 1){ echo "checked"; }?> style="display:block;visibility:hidden;"> <label for="bco">Birth Certificate (O) <span class="required">*</span></label>
	</div><!-- col-md-12 -->
	<div class="col-md-12 paddingBottom0">
		<input type="checkbox" id="bcc" name="bcc" <?php if( $data_id["Birth_c"] == 1){ echo "checked"; }?> style="display:block;visibility:hidden;"> <label for="bcc">Birth Certificate (C) <span class="required">*</span></label>
	</div><!-- col-md-12 -->    
</div><!-- .col-md-12 -->
<hr />
           
                            <div class="col-md-12">
                                <div class="alevelBox">
                                    <div class="col-md-12 paddingBottom0 alevel_checklist" >
                                        <div class="col-md-12">
                                            <input <?php if( $data_id["Alevel_supplement"] == 1){ echo "checked"; }?>  type="checkbox" id="as" name="alevel_supplement" style="visibility:hidden;display:block;"> 
                                            <label for="as">Duly filled Admission Application Form and A-Level Supplement</label>
                                        </div>
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
                                        <input type="checkbox" id="APCOSR" name="alevelCheckList[]" value="APCOSR" style="display:block;visibility:hidden;"> <label for="APCOSR">Attested Photo copy of school result for grade IX, X and XI (incl mocks)</label>
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
                                <!-- .col-md-12 -->
                            </div>
<div class="col-md-12">
	<!--input type="button" class="greenBTN" value="Update & Print" / -->
	<div class="col-md-6">
		<input type="submit" name="greenBTN2" id="greenBTN2" class="greenBTN" value="Print & Update" />
	</div><!-- col-md-6 -->
	<div class="col-md-6">
		<input type="button" name="clear" class="grayBTN" id="greenBTN3" value="Clear" />
	</div><!-- col-md-6 -->
	
</div><!-- col-md-12 -->

</form> <!-- // End Of Form -->




<script>

// Kashif Solangi
$(document).ready(function(){
	
// GF ID	
if ($('#form_no').length) {
	$('#form_no').mask('9999', {
		placeholder: 'X'
	});
}	
	
// Date range
if ($('#date_of_birth').length) {
	
	$('#date_of_birth').datepicker({
		changeMonth: true,
        changeYear: true,
		dateFormat: 'yy-mm-dd',
		prevText: '<i class="fa fa-chevron-left"></i>',
		nextText: '<i class="fa fa-chevron-right"></i>',
		onSelect: function(date) {
			getadmissiongradedob(date);
		},
	});	

}	

if ($('#f_nic').length) {
  $('#f_nic').mask('99999-9999999-9', {
        placeholder: 'X'
   });
}



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
// if ($('#father_mobile').length) {
//   $('#father_mobile').mask('0399-9999999', {
//         placeholder: 'X'
//    });
// }	
	

// mother_mobile 
// if ($('#mother_mobile').length) {
//   $('#mother_mobile').mask('0399-9999999', {
//         placeholder: 'X'
//    });
// }	


});	
$(document).on("click", ".grayBTN",  function(){

  window.location.reload();
});
$(document).on("change", ".switch-input",  function(){

    var discussion_status =  $('input[name=discussion_status]:checked').val();
    if(discussion_status == 'today'){

        $('#discussion_date_update').hide();
        $('#discussion_time_update').hide();        
        var today = new Date();
        var dd = today.getDate();

        var mm = today.getMonth()+1; 
        var yyyy = today.getFullYear();
        if(dd<10) 
        {
            dd='0'+dd;
        } 

        if(mm<10) 
        {
            mm='0'+mm;
        } 
        today = yyyy+'-'+mm+'-'+dd;
        var today_time =  new Date().toLocaleTimeString('en-US', { hour12: false, 
                                             hour: "numeric", 
                                             minute: "numeric"});
        $('#discussion_date_update').val(today);
        $('#discussion_time_update').val(today_time);
        
    } else {
        $('#discussion_date_update').show();
        $('#discussion_time_update').show();        
       $('#discussion_date_update').val('<?php echo date("Y-m-d", strtotime($data_id['Form_discussion_date']));?>');
       $('#discussion_time_update').val('<?= $data_id['Form_discussion_time'];?>');      
    }
 

});
</script>
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
            $(wrapper).append('<div class="input_fields_wrap_additional"><select class="countryCodeNumber" name="student_mobile_code[]"> <!-- Countries often selected by users can be moved to the top of the list. --> <!-- Countries known to be subject to general US embargo are commented out by default. --> <!-- The data-countryCode attribute is populated with ISO country code, and value is int l calling code. --> <option data-countryCode="US" value="1" >+1</option> <option data-countryCode="GB" value="44">+44</option> <option data-countryCode="DZ" value="213">+213</option> <option data-countryCode="AD" value="376">+376</option> <option data-countryCode="AO" value="244">+244</option> <option data-countryCode="AI" value="1264">+1264</option> <option data-countryCode="AG" value="1268">+1268</option> <option data-countryCode="AR" value="54">+54</option> <option data-countryCode="AM" value="374">+374</option> <option data-countryCode="AW" value="297">+297</option> <option data-countryCode="AU" value="61">+61</option> <option data-countryCode="AT" value="43">+43</option> <option data-countryCode="AZ" value="994">+994</option> <option data-countryCode="BS" value="1242">+1242</option> <option data-countryCode="BH" value="973">+973</option> <option data-countryCode="BD" value="880">+880</option> <option data-countryCode="BB" value="1246">+1246</option> <option data-countryCode="BY" value="375">+375</option> <option data-countryCode="BE" value="32">+32</option> <option data-countryCode="BZ" value="501">+501</option> <option data-countryCode="BJ" value="229">+229</option> <option data-countryCode="BM" value="1441">+1441</option> <option data-countryCode="BT" value="975">+975</option> <option data-countryCode="BO" value="591">+591</option> <option data-countryCode="BA" value="387">+387</option> <option data-countryCode="BW" value="267">+267</option> <option data-countryCode="BR" value="55">+55</option> <option data-countryCode="BN" value="673">+673</option> <option data-countryCode="BG" value="359">+359</option> <option data-countryCode="BF" value="226">+226</option> <option data-countryCode="BI" value="257">+257</option> <option data-countryCode="KH" value="855">+855</option> <option data-countryCode="CM" value="237">+237</option> <option data-countryCode="CA" value="1">+1</option> <option data-countryCode="CV" value="238">+238</option> <option data-countryCode="KY" value="1345">+1345</option> <option data-countryCode="CF" value="236">+236</option> <option data-countryCode="CL" value="56">+56</option> <option data-countryCode="CN" value="86">+86</option> <option data-countryCode="CO" value="57">+57</option> <option data-countryCode="KM" value="269">+269</option> <option data-countryCode="CG" value="242">+242</option> <option data-countryCode="CK" value="682">+682</option> <option data-countryCode="CR" value="506">+506</option> <option data-countryCode="HR" value="385">+385</option> <!-- <option data-countryCode="CU" value="53">Cuba +53</option> --> <option data-countryCode="CY" value="90">+90</option> <option data-countryCode="CY" value="357">+357</option> <option data-countryCode="CZ" value="420">+420</option> <option data-countryCode="DK" value="45">+45</option> <option data-countryCode="DJ" value="253">+253</option> <option data-countryCode="DM" value="1809">+1809</option> <option data-countryCode="DO" value="1809">+1809</option> <option data-countryCode="EC" value="593">+593</option> <option data-countryCode="EG" value="20">+20</option> <option data-countryCode="SV" value="503">+503</option> <option data-countryCode="GQ" value="240">+240</option> <option data-countryCode="ER" value="291">+291</option> <option data-countryCode="EE" value="372">+372</option> <option data-countryCode="ET" value="251">+251</option> <option data-countryCode="FK" value="500">+500</option> <option data-countryCode="FO" value="298">+298</option> <option data-countryCode="FJ" value="679">+679</option> <option data-countryCode="FI" value="358">+358</option> <option data-countryCode="FR" value="33">+33</option> <option data-countryCode="GF" value="594">+594</option> <option data-countryCode="PF" value="689">+689</option> <option data-countryCode="GA" value="241">+241</option> <option data-countryCode="GM" value="220">+220</option> <option data-countryCode="GE" value="7880">+7880</option> <option data-countryCode="DE" value="49">+49</option> <option data-countryCode="GH" value="233">+233</option> <option data-countryCode="GI" value="350">+350</option> <option data-countryCode="GR" value="30">+30</option> <option data-countryCode="GL" value="299">+299</option> <option data-countryCode="GD" value="1473">+1473</option> <option data-countryCode="GP" value="590">+590</option> <option data-countryCode="GU" value="671">+671</option> <option data-countryCode="GT" value="502">+502</option> <option data-countryCode="GN" value="224">+224</option> <option data-countryCode="GW" value="245">+245</option> <option data-countryCode="GY" value="592">+592</option> <option data-countryCode="HT" value="509">+509</option> <option data-countryCode="HN" value="504">+504</option> <option data-countryCode="HK" value="852">+852</option> <option data-countryCode="HU" value="36">+36</option> <option data-countryCode="IS" value="354">+354</option> <option data-countryCode="IN" value="91">+91</option> <option data-countryCode="ID" value="62">+62</option> <option data-countryCode="IQ" value="964">+964</option> <!-- <option data-countryCode="IR" value="98">Iran +98</option> --> <option data-countryCode="IE" value="353">+353</option> <option data-countryCode="IL" value="972">+972</option> <option data-countryCode="IT" value="39">+39</option> <option data-countryCode="JM" value="1876">+1876</option> <option data-countryCode="JP" value="81">+81</option> <option data-countryCode="JO" value="962">+962</option> <option data-countryCode="KZ" value="7">+7</option> <option data-countryCode="KE" value="254">+254</option> <option data-countryCode="KI" value="686">+686</option> <option data-countryCode="KR" value="82">+82</option> <option data-countryCode="KW" value="965">+965</option> <option data-countryCode="KG" value="996">+996</option> <option data-countryCode="LA" value="856">+856</option> <option data-countryCode="LV" value="371">+371</option> <option data-countryCode="LB" value="961">+961</option> <option data-countryCode="LS" value="266">+266</option> <option data-countryCode="LR" value="231">+231</option> <option data-countryCode="LY" value="218">+218</option> <option data-countryCode="LI" value="417">+417</option> <option data-countryCode="LT" value="370">+370</option> <option data-countryCode="LU" value="352">+352</option> <option data-countryCode="MO" value="853">+853</option> <option data-countryCode="MK" value="389">+389</option> <option data-countryCode="MG" value="261">+261</option> <option data-countryCode="MW" value="265">+265</option> <option data-countryCode="MY" value="60">+60</option> <option data-countryCode="MV" value="960">+960</option> <option data-countryCode="ML" value="223">+223</option> <option data-countryCode="MT" value="356">+356</option> <option data-countryCode="MH" value="692">+692</option> <option data-countryCode="MQ" value="596">+596</option> <option data-countryCode="MR" value="222">+222</option> <option data-countryCode="YT" value="269">+269</option> <option data-countryCode="MX" value="52">+52</option> <option data-countryCode="FM" value="691">+691</option> <option data-countryCode="MD" value="373">+373</option> <option data-countryCode="MC" value="377">+377</option> <option data-countryCode="MN" value="976">+976</option> <option data-countryCode="MS" value="1664">+1664</option> <option data-countryCode="MA" value="212">+212</option> <option data-countryCode="MZ" value="258">+258</option> <option data-countryCode="MN" value="95">+95</option> <option data-countryCode="NA" value="264">+264</option> <option data-countryCode="NR" value="674">+674</option> <option data-countryCode="NP" value="977">+977</option> <option data-countryCode="NL" value="31">+31</option> <option data-countryCode="NC" value="687">+687</option> <option data-countryCode="NZ" value="64">+64</option> <option data-countryCode="NI" value="505">+505</option> <option data-countryCode="NE" value="227">+227</option> <option data-countryCode="NG" value="234">+234</option> <option data-countryCode="NU" value="683">+683</option> <option data-countryCode="NF" value="672">+672</option> <option data-countryCode="NP" value="670">+670</option> <option data-countryCode="NO" value="47">+47</option> <option data-countryCode="OM" value="968">+968</option> <option selected data-countryCode="PK" value="92" selected >+92</option> <option data-countryCode="PW" value="680">+680</option> <option data-countryCode="PA" value="507">+507</option> <option data-countryCode="PG" value="675">+675</option> <option data-countryCode="PY" value="595">+595</option> <option data-countryCode="PE" value="51">+51</option> <option data-countryCode="PH" value="63">+63</option> <option data-countryCode="PL" value="48">+48</option> <option data-countryCode="PT" value="351">+351</option> <option data-countryCode="PR" value="1787">+1787</option> <option data-countryCode="QA" value="974">+974</option> <option data-countryCode="RE" value="262">+262</option> <option data-countryCode="RO" value="40">+40</option> <option data-countryCode="RU" value="7">+7</option> <option data-countryCode="RW" value="250">+250</option> <option data-countryCode="SM" value="378">+378</option> <option data-countryCode="ST" value="239">+239</option> <option data-countryCode="SA" value="966">+966</option> <option data-countryCode="SN" value="221">+221</option> <option data-countryCode="CS" value="381">+381</option> <option data-countryCode="SC" value="248">+248</option> <option data-countryCode="SL" value="232">+232</option> <option data-countryCode="SG" value="65">+65</option> <option data-countryCode="SK" value="421">+421</option> <option data-countryCode="SI" value="386">+386</option> <option data-countryCode="SB" value="677">+677</option> <option data-countryCode="SO" value="252">+252</option> <option data-countryCode="ZA" value="27">+27</option> <option data-countryCode="ES" value="34">+34</option> <option data-countryCode="LK" value="94">+94</option> <option data-countryCode="SH" value="290">+290</option> <option data-countryCode="KN" value="1869">+1869</option> <option data-countryCode="SC" value="1758">+1758</option> <option data-countryCode="SR" value="597">+597</option> <option data-countryCode="SD" value="249">+249</option> <option data-countryCode="SZ" value="268">+268</option> <option data-countryCode="SE" value="46">+46</option> <option data-countryCode="CH" value="41">+41</option> <!-- <option data-countryCode="SY" value="963">Syria +963</option> --> <option data-countryCode="TW" value="886">+886</option> <option data-countryCode="TJ" value="992">+992</option> <option data-countryCode="TH" value="66">+66</option> <option data-countryCode="TG" value="228">+228</option> <option data-countryCode="TO" value="676">+676</option> <option data-countryCode="TT" value="1868">+1868</option> <option data-countryCode="TN" value="216">+216</option> <option data-countryCode="TR" value="90">+90</option> <option data-countryCode="TM" value="993">+993</option> <option data-countryCode="TC" value="1649">+1649</option> <option data-countryCode="TV" value="688">+688</option> <option data-countryCode="UG" value="256">+256</option> <option data-countryCode="UA" value="380">+380</option> <option data-countryCode="AE" value="971">+971</option> <option data-countryCode="UY" value="598">+598</option> <option data-countryCode="UZ" value="998">+998</option> <option data-countryCode="VU" value="678">+678</option> <option data-countryCode="VA" value="379">+379</option> <option data-countryCode="VE" value="58">+58</option> <option data-countryCode="VN" value="84">+84</option> <option data-countryCode="VG" value="1">+1</option> <option data-countryCode="VI" value="1">+1</option> <option data-countryCode="WF" value="681">+681</option> <option data-countryCode="YE" value="969">+969</option> <option data-countryCode="YE" value="967">+967</option> <option data-countryCode="ZM" value="260">+260</option> <option data-countryCode="ZW" value="263">+263</option> </select> <input name="student_mobile_phone[]" type="text" class="col-md-10" placeholder="Mobile" id="" value="" style="padding-left:80px;" /> <a href="#" class="remove_field">X</a></div>'); //add input box
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
<style type="text/css">
	.countryCodeNumber {
     position: absolute;
    top: 0;
    z-index: 9999;
    width: 55px;
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
</style>
