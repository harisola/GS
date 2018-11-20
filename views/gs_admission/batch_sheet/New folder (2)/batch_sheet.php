<div class="container" id="BatchListing">
	<div class="row">
        <div class="col-md-12 BatchListing">
        	<div class="MaroonBorderBox">
        		<h3>Batch Sheet for Admission Tracking</h3>
                <div class="inner paddingLeft20 paddingRight20" style="padding:20px !important;">
                	<div class="absoluteDiv3">
                    	<dl class="dropdown">
							<dt> <a href="#"><span class="hida">Select Grade</span> <p class="multiSel" style="display:;"></p></a></dt>
                        <dd>
						<div class="mutliSelect">
						 <ul>
							<li>
								<input type="checkbox" value="All" name="All" id="All"/>
								<label for="All">All Grades</label>
							</li>
							<li>
								<input type="checkbox" value="1" name="PN" id="PN" />
								<label for="PN">PN</label>
							</li>
							<li><input type="checkbox" value="2" id="N" name="PN" /><label for="N">N</label></li>
							<li><input type="checkbox" value="3" name="KG" id="KG" /><label for="KG">KG</label></li>
							<li><input type="checkbox" value="4" name="I" id="I" /><label for="I">I</label></li>
							<li><input type="checkbox" value="5" name="II" id="II" /><label for="II">II</label></li>
							<li><input type="checkbox" value="6" name="III" id="III" /><label for="III">III</label></li>
							<li><input type="checkbox" value="7" name="IV" id="IV" /><label for="IV">IV</label></li>
							<li><input type="checkbox" value="8" name="V" id="V" /><label for="v">V</label></li>
							<li><input type="checkbox" value="9" name="VI" id="VI" /><label for="VI">VI</label></li>
							<li><input type="checkbox" value="10" name="VII" id="VII" /><label for="VII">VII</label></li>
							<li><input type="checkbox" value="11" name="VIII" id="VIII" /><label for="VIII">VIII</label></li>
							<li><input type="checkbox" value="12" name="IX" id="IX" /><label for="IX">IX</label></li>
							<li><input type="checkbox" value="13" name="X" id="X" /><label for="X">X</label></li>
							<li><input type="checkbox" value="14" name="X" id="XI" /><label for="XI">XI</label></li>
							<li><input type="checkbox" value="15" name="A1" id="A1" /><label for="A1">A1</label></li>
							</ul><!-- ul -->
						</div><!-- multiselect -->
					</dd><!-- dd -->                          
					</dl>
		                       <form action="<?=base_url();?>index.php/gs_admission/batch_sheet/fliter" method="POST" name="fliter_issuance" id="fliter_issuance">
						
						
						<dl class="dropdownG">	

						<div id="BiGSelectBox">
					   <select class="BiGSelectBox"  style="font-size: 12px; padding: 7px;" name="BiGSelectBox">
						  <option value="" selected="">Select Batch</option>
						</select>
					  </div>
					  
                        </dl><!-- dl -->
						
						<input type="hidden" name="gradeNameValidate" id="gradeNameValidate" value="" />
						
                 
 

  
                    	<input type="submit" id="issuance_fliter" name="issuance_fliter" class="greenBTN" value="Apply Filters" style="padding:14px;" />
                  
						</form>
                    </div>
					
					
						
									
					 	<!--select id="assessmentResultDropdownId" class="width40">
                                    	<option value="">R</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
										<option value="B">B</option>
										<option value="C">C</option>
										<option value="D">D</option>
										
                                    </select -->	

						<div id="AjaxResponseContainer"><!-- inner -->
						
				<table id="batch_sheet" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%" > 
                      <thead> 
					 <tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="2"> <div class="text-center col-md-12"> Gender  Sibling </div> </th>
						<th colspan="2"> <div class="text-center col-md-12"> AST Appointment  </div>   </th>
						<th colspan="2"> <div class="text-center col-md-12"> DIS Appointment  </div>   </th>
						
						<th></th>
						<th></th>
						<th></th>
						
					  </tr>
                          
					 
					        <tr> 
                              <th class="no-sort nosorter" width="5%" style="padding-right:10px !important;">
								  <span class="text-left">SR. #</span><br />
								  <span class="text-right">Form #</span>
							  </th> 
                              <th class="no-sort" width="7%">
								  <span class="text-left">Orgnl Batch</span><br />
								  <span class="text-right">Final Batch</span>
							  </th> 
                              <th class="no-sort" width="12%">
								  <span class="text-left">Applicant Name</span><br />
								  <span class="text-right">Father Name</span>
							  </th>
                              <th class="no-sort" width="7%">
								  <span class="text-left">Issue Date</span><br />
								  <span class="text-right">Submit Date</span>
							  </th>
                              <th class="no-sort" width="7%">
							  
                              	<span class="text-left">
                                	<select id="firstDropdownId">
                                    	<option value="">Gender</option>
                                        <option value="Boy">Boy</option>
                                        <option value="Girl">Girl</option>
                                    </select>
                                </span>
                            </th>
							<th class="no-sort" width="7%">
								<span>
                                	<select id="siblingDropdownId">
                                    	<option value="">Sibling</option>
                                        <option value="Yes">Yes</option>
                                        <option value="NO">No</option>
                                    </select>
                                </span> </th>
								
                              <th class="no-sort" width="15%">
                              	
                               
                                <div class="text-left col-md-6 no-padding">
                               	  <select class="width100" id="AST_Date_On">
                                    	<option value="">AST Date On</option>
                                    </select>
                                </div>
                                <div class="text-right col-md-6 no-padding">
                                	<select class="width60" id="ass_name_code">
                                    	<option value="">AST By</option>
                                    </select>
                                </div>
                            </th>
                              <th class="no-sort" width="6%">
                              	<span class="text-left">
                               	<select class="width40" id="ass_d_result">
                                    	<option value="">R</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
										<option value="C">C</option>
										<option value="D">D</option>
                                    </select>
                                </span>
                                <br />
                                <span class="text-right">
                               	<select class="width50" id="ass_decission_name_code">
                                    	<option value="">D</option>
                                    </select>
                                </span>
                            </th>
                              <th class="no-sort" width="15%">
                              	
                              	<div class="text-left col-md-6 no-padding">
                                	<select class="width100" id="discussion_date">
                                    	<option value="">Dss Date On</option>
                                     </select>
                                </div>
                                <div class="text-right col-md-6 no-padding">
                                	<select class="width60" id="discussion_name_code">
                                    	<option value="">Dss By</option>
                                    </select>
                                </div>
                            </th>
                              <th class="no-sort" width="6%">
                              	<span class="text-left">
                                	<select class="width40" id="discussion_result">
                                    	<option value="">R</option>
										 <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
										<option value="C">C</option>
										<option value="D">D</option>
                                   </select>
                                </span>
                                <br />
                                <span class="text-right">
                                	<select class="width50" id="discussion_decission">
                                    	<option value="">D</option>
                                    </select>
                                </span>
                            </th>
                              <th class="no-sort" width="8%">
								<span class="text-left">WIL Type</span><br />
								<span class="text-right">WIL Decision</span>
							  </th>
                              <th class="no-sort text-center" width="5%">
								<span class="text-left">OFR Date</span>
							   </th>
                              <th class="no-sort" width="15%">
                              	<span class="text-left">
                               	<select class="width100" id="out_comeFinalResult">
                                    	<option value="">Outcome</option>
                                        <!--option value="WIL">WIL</option>
                                        <option value="RGT">RGT</option>
                                        <option value="OFR">OFR</option>
                                        <option value="CFD">CFD</option -->
                                   </select>
                                </span>
                                <br />
                                <span class="text-right">Date</span>
                              </th>
							  <!--th></th><th></th -->
                          </tr>
					  </thead>
					  
				
								
                      <tbody> 
					  
					  <?php 
						$bool = 1;
						$Setteled = 0;
						$Reallocated =0;
						$InProcess =0;
						$BoysTotale=0;
						$GirlsTotale=0;
						$Siblings=0;
						$Pets=0;
						$CNF=0; $NIT=0; $Rgt=0;
						$Offer=0;
						
						// Assessement Resutl
						$Clc_AAplus = 0;
						$Clc_AA=0;
						$Clc_AAminus=0;
						$Clc_ABplus=0;
						$Clc_AB=0;
						$Clc_ABminus=0;
						$Clc_AC=0;
						$Clc_AD=0;
						$Clc_ACfd=0;
						$Clc_AWil=0;
						$Clc_AOhd=0;
						$Clc_ARgt=0;
						$Clc_DAplus=0; 
						$Clc_DA=0;
						$Clc_DAminus=0;
						$Clc_DBplus=0;
						$Clc_DB=0;
						$Clc_DBminus=0;
						$Clc_DC=0;
						$Clc_DD=0;
			
			
						$Clc_DOfr=0;
						$Clc_DWil=0;
						$Clc_DOhd=0;
						$Clc_DRgt=0;
						$regret_po=0;
			
			
						$totlAssD = 0; 
					    $Clc_TDis = 0;
						
						$intermediate_wl=0;
						$intermediate_oh=0;
						$intermediate_fu=0;
						$intermediate_ofd=0;
						
						$cnfd=0;
						
						$totalForm = count( $batchBilling );
					  
							
						foreach( $batchBilling as $bll ){
						?>
						  <tr> 
                              <td class=""><span class="text-left"><?=$bool;?></span>
								<br />
									<span class="text-right"><?=$bll["form_no"];?></span>
								</td> 
                              <td class=""><span class="text-left"><?=ucwords($bll["batch_category"]);?></span><br />
							  <span class="text-right"><?=$bll["batch_category"];?></span></td> 
							  
                              <td class=""><span class="text-left"><?=$bll["applicant_name"];?></span><br />
							  <span class="text-right"><?=$bll["father_name"];?></span></td>
							  
							  
                              <td class=""><span class="text-left"><?=$bll["form_issuance_date"];?></span><br />
							  <span class="text-right"><?=$bll["form_submission_date"];?></span></td>
							  <td class=""> <?=$bll["gender"];?> </td>
                              <td class=""><?=$bll["sibling"];?></td>
							  <td class=""><div class="text-center col-md-12"><?=$bll["form_assessment_date"];?></div> <br />
							  <div class="text-left col-md-8 simple_form_assessment_date"><?=$bll["simple_form_assessment_date"];?></div><div class="text-right col-md-4 ast_name_code"><?=$bll["ast_name_code"];?> </div></td>
							  <td class=""><span class="text-left"><?=$bll["form_assessment_result"];?></span><br /><span class="text-right form_assessment_decision"><?=$bll["form_assessment_decision"];?></span></td>
							  
                              <td class=""><div class="text-center col-md-12 form_discussion_date"><?=$bll["form_discussion_date"];?>'</div><br />
							  <div class="text-left col-md-8 dis_done_on"><?=$bll["dis_done_on"];?></div><div class="text-right col-md-4 dis_name_code"><?=$bll["dis_name_code"];?></div></td>
                              
							  <td class=""><span class="text-left"><?=$bll["form_discussion_result"];?></span><br /><span class="text-right form_discussion_decision"><?=$bll["form_discussion_decision"];?></span></td>
						  
                              <td class=""><span class="text-left"><?=$bll["form_assessment_decision"];?> </span><br />
							  <span class="text-right"><?=$bll["form_assessment_decision"];?></span></td>
							  
                              <td class=""><span class="text-left"><?=$bll["OFFER"];?></span></td>
							  
							  
							  
							  
							  <?php
								if( ($bll["form_status_stage_id"] == 6) || ($bll["form_status_stage_id"] == 15) ){
								$Rgt++;
								}
								if( ( $bll["form_status_stage_id"] == 7 )  && ( $bll["form_status_id"] >= 2  ) ){
								$NIT++;
								}


								//if( $bll["OFFER"] != '' ){
								if( $bll["form_status_id"] >= 5 ){

								$Offer++;
								}


								if( ($bll["form_status_stage_id"] == 1) && ( $bll["form_status_id"] >= 5  ) ){
								$CNF++;
								}
								if( ( $bll["form_status_id"] >= 6  ) ){
								$cnfd++;
								}



								if( ($bll["form_status_stage_id"] == 15 )  ){
								$regret_po++;
								}







								if( $bll["gender"] == 'Boy' ){
								$BoysTotale++;
								}else{
								$GirlsTotale++;
								}
								if( $bll["sibling"] == "Yes"){
								$Siblings++;
								}
								if( $bll["pet_code"] != "No" && $bll["pet_code"] != "Yes"){
								$Pets++;
								}





								// Assessment Result
								$Art_Tbl = $bll["form_assessment_result"];
								if ( $Art_Tbl == 'A+'){ $Clc_AAplus++; }
								if ( $Art_Tbl == 'A'){ $Clc_AA++; }
								if ( $Art_Tbl == 'A-'){ $Clc_AAminus++; }
								if ($Art_Tbl == 'B+'){ $Clc_ABplus++; }
								if ($Art_Tbl == 'B'){ $Clc_AB++; }
								if ($Art_Tbl == 'B-'){ $Clc_ABminus++; }
								if ($Art_Tbl == 'C'){ $Clc_AC++; }
								if ($Art_Tbl == 'D'){ $Clc_AD++; }

								$Adc_Tbl = $bll["form_assessment_decision"];
								if ($Adc_Tbl == 'CFD'){ $Clc_ACfd++; }
								if ($Adc_Tbl == 'WIL'){ $Clc_AWil++; }
								if ($Adc_Tbl == 'OHD'){ $Clc_AOhd++; }
								if ($Adc_Tbl == 'RGT'){ $Clc_ARgt++; }




								// Discussion Result
								$Drt_Tbl = $bll["form_discussion_result"];
								if ($Drt_Tbl == 'A+'){ $Clc_DAplus++; }
								if ($Drt_Tbl == 'A'){ $Clc_DA++; }
								if ($Drt_Tbl == 'A-'){ $Clc_DAminus++; }
								if ($Drt_Tbl == 'B+'){ $Clc_DBplus++; }
								if ($Drt_Tbl == 'B'){ $Clc_DB++; }
								if ($Drt_Tbl == 'B-'){ $Clc_DBminus++; }
								if ($Drt_Tbl == 'C'){ $Clc_DC++; }
								if ($Drt_Tbl == 'D'){ $Clc_DD++; }

								$Ddc_Tbl = $bll["form_discussion_decision"];
								if ($Ddc_Tbl == 'OFR'){ $Clc_DOfr++; }
								if ($Ddc_Tbl == 'WIL'){ $Clc_DWil++; }
								if ($Ddc_Tbl == 'OHD'){ $Clc_DOhd++; }
								if ($Ddc_Tbl == 'RGT'){ $Clc_DRgt++; }
			
							  ?>
                              <td class=""><span class="text-left form_discussion_decision"><?=$bll["form_discussion_decision"];?></span><br /><span class="text-right"><?=$bll["outcome_date"];?></span></td>
							  
							  
							 <?php /* ?> <td style=" visibility: hidden;"><?=$bll["form_assessment_result"];?> </td>
							  <td style=" visibility: hidden"><?=$bll["form_assessment_decision"];?> </td><?php */ ?>
							  
							  
                          </tr>
		
						
					  <?php $bool++; 
							
						
						
		   
			
			


					  } // end foreach
					  $Setteled = $CNF + $NIT + $Rgt;
					  $InProcess =  $totalForm - $Setteled;
					  
					  $totlAssD = $Clc_ACfd +  $Clc_AWil + $Clc_AOhd + $Clc_ARgt; 
					   $Clc_TDis = $Clc_DOfr + $Clc_DWil + $Clc_DOhd + $Clc_DRgt;
					   
						$intermediate_wl = ($Clc_AWil+$Clc_DWil);
						$intermediate_oh = ($Clc_AOhd+$Clc_DOhd);
						$intermediate_fu=($Clc_DRgt+$Clc_ARgt);
						$intermediate_ofd=($Clc_ACfd+$Clc_DOfr);
						
						
						
					  ?>
                          
                      </tbody> 
					</table><!-- StaffListing -->
					
					
					<table class="display table table-striped table-bordered table-hover" style="margin-top:30px;" width="100%" cellspacing="0">
                    	<thead>
                        	<tr>
                            	<th class="text-center" width="12%">Applicants</th>
                                <th class="text-center" width="13%">Profile</th>
                                <th class="text-center" width="20%">Assessment</th>
                                <th class="text-center" width="20%">Discussion</th>
                                <th class="text-center" width="8%">Intermediates</th>
                                <th class="text-center" width="11%">Outcomes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
							
							
						
                            	<td class="text-center">
                                	<table width="100%">
                                    	<tbody><tr>
                                        	<td>Total Forms<br><strong><?=$totalForm;?></strong></td>
                                            <td>Setteled<br><strong><?=$Setteled;?></strong></td>
                                        </tr>
                                        <tr>
                                        	<td>Reallocated<br><strong><?php //$Reallocated;?></strong></td>
                                            <td>In Process<br><strong><?=$InProcess;?></strong></td>
                                        </tr>
                                    </tbody></table>
                                </td>
                                <td class="text-center">
                                	<table width="100%">
                                    	<tbody><tr>
                                        	<td>Girls<br><strong><?=$GirlsTotale;?></strong></td>
                                            <td>Boys<br><strong><?=$BoysTotale;?></strong></td>
                                        </tr>
                                        <tr>
                                        	<td>Siblings<br><strong><?=$Siblings;?></strong></td>
                                            <td>Pet's<br><strong><?=$Pets;?></strong></td>
                                        </tr>
                                    </tbody></table>
                                </td>
                                <td class="text-center">
                                	<table width="100%">
		
			
			
                                    	<tbody><tr>
                                        	<td>A+<br><strong><?=$Clc_AAplus;?></strong></td>
                                            <td>A<br><strong><?=$Clc_AA;?></strong></td>
                                            <td>A-<br><strong><?=$Clc_AAminus;?></strong></td>
                                            <td>B+<br><strong><?=$Clc_ABplus;?></strong></td>
                                            <td>B<br><strong><?=$Clc_AB;?></strong></td>
                                            <td>B-<br><strong><?=$Clc_ABminus;?></strong></td>
                                            <td>C<br><strong><?=$Clc_AC;?></strong></td>
                                            <td>D<br><strong><?=$Clc_AD;?></strong></td>
                                        </tr>
                                    </tbody></table>
                                    <table width="100%">
                                        <tbody><tr>
                                        	<td>T ASS'D<br><strong><?=$totlAssD;?></strong></td>
                                            <td>&gt;CFD<br><strong><?=$Clc_ACfd;?></strong></td>
                                            <td>WL<br><strong><?=$Clc_AWil;?></strong></td>
                                            <td>*OH*<br><strong><?=$Clc_AOhd;?></strong></td>
                                            <td>RGT<br><strong><?=$Clc_ARgt;?></strong></td>
                                        </tr>
                                    </tbody></table>
                                </td>
                                <td class="text-center">
								
						
                                	<table width="100%">
                                    	<tbody><tr>
                                        	<td>A+<br><strong><?=$Clc_DAplus;?></strong></td>
                                            <td>A<br><strong><?=$Clc_DA;?></strong></td>
                                            <td>A-<br><strong><?=$Clc_DAminus;?></strong></td>
                                            <td>B+<br><strong><?=$Clc_DBplus;?></strong></td>
                                            <td>B<br><strong><?=$Clc_DB;?></strong></td>
                                            <td>B-<br><strong><?=$Clc_DBminus;?></strong></td>
                                            <td>C<br><strong><?=$Clc_DC;?></strong></td>
                                            <td>D<br><strong><?=$Clc_DD;?></strong></td>
                                        </tr>
                                    </tbody></table>
                                    <table width="100%">
                                        <tbody><tr>
										 <td>T ASS'D<br><strong><?=$Clc_TDis;?></strong></td>
                                            <td>&gt;CFD<br><strong><?=$Clc_DOfr;?></strong></td>
                                            <td>WL<br><strong><?=$Clc_DWil;?></strong></td>
                                            <td>*OH*<br><strong><?=$Clc_DOhd;?></strong></td>
                                            <td>RGT<br><strong><?=$Clc_DRgt;?></strong></td>
                                        </tr>
                                    </tbody></table>
                                </td>
                                <td class="text-center" width="8%">
                                	<table width="100%">
                                        <tbody><tr>
								
						
                                        	<td>WL<br><strong><?=$intermediate_wl;?></strong></td>
                                            <td>OH<br><strong><?=$intermediate_oh;?></strong></td>
                                            <td>F/U<br><strong><?=$intermediate_fu;?></strong></td>
                                        </tr>
                                    </tbody></table>
                                    <table width="100%">
                                        <tbody><tr>
                                        	<td>OFD<br><strong><?=$Offer;?></strong></td>
                                        </tr>
                                    </tbody></table>
                                </td>
                                <td class="text-center">
                                	<table width="100%">
									
                                        <tbody><tr>
                                        	<td>CNF<br><strong><?=$cnfd;?></strong></td>
                                            <td>RGT<br><strong><?=$regret_po;?></strong></td>
                                            <td>NIT<br><strong><?=$NIT;?></strong></td>
                                        </tr>
                                    </tbody></table>
                                    <table width="100%">
                                        <tbody><tr>
                                        	<td>INP<br><strong><?=$InProcess;?></strong></td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                
				</div><!-- inner -->
				</div><!-- inner -->
				
				


            </div><!-- MaroonBorderBox -->
        </div><!-- col-md-12 -->
    </div><!-- row -->
    <!-- Two column layout END -->
</div><!-- container -->

 <div style="display:none;" id="ajaxloader">  <p> <br /> <br /> <br /> <br /> Please Wait .. </p></div>

<style>

#ajaxloader{background-color: silver}
#ajaxloader{
	 position: absolute;
border:none;
  top: 115px;
  left:650px;
background-color: transparent;
text-align: center;
background-image: url(<?php echo base_url();?>/components/image/ajax-loader2.gif);
background-position: center center;
background-repeat: no-repeat;
}



​


</style>
