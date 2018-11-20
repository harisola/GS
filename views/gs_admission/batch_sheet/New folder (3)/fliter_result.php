			<?php //var_dump( $batchBilling ); exit; $bll["and_batch"]

			
			?> 
			
			<input type="hidden" name="h_gender" id="h_gender" value="<?=$gender;?>" />
			<input type="hidden" name="h_siblings" id="h_siblings" value="<?=$siblings;?>" />
			<input type="hidden" name="h_Assmnt_dt" id="h_Assmnt_dt" value="<?=$Assmnt_dt;?>" />
			<input type="hidden" name="h_ass_name_code" id="h_ass_name_code" value="<?=$ass_name_code;?>" />
			<input type="hidden" name="h_ass_d_result" id="h_ass_d_result" value="<?=$ass_d_result;?>" />
			<input type="hidden" name="h_a_d_n_c" id="h_a_d_n_c" value="<?=$a_d_n_c;?>" />
			<input type="hidden" name="h_discussion_date" id="h_discussion_date" value="<?=$discussion_date;?>" />
			<input type="hidden" name="h_dis_n_c" id="h_dis_n_c" value="<?=$dis_n_c;?>" />
			<input type="hidden" name="h_dis_result" id="h_dis_result" value="<?=$dis_result;?>" />
			<input type="hidden" name="h_dis_dec" id="h_dis_dec" value="<?=$dis_dec;?>" />
			<input type="hidden" name="h_OutCome" id="h_OutCome" value="<?=$OutCome;?>" />
			<input type="hidden" name="h_batch_cat" id="h_batch_cat" value="<?=$batch_cat;?>" />
			
			
			<table id="batch_sheet2" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%" > 
                      <thead> 
					 <!--tr>
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
						
					  </tr -->
                          
					 
					        <tr> 
                              <th class="no-sort nosorter" width="5%" style="padding-right:10px !important;">
								  <span class="text-left">SR. #</span><br />
								  <span class="text-right">Form #</span>
							  </th> 
                              <th class="no-sort" width="7%">
								  <span class="text-left">Orgnl Batch</span><br />
								  <span class="text-right">Final Batch</span>
							  </th> 
                              <th class="no-sort" width="10%">
								  <span class="text-left">Applicant Name</span><br />
								  <span class="text-right">Father Name</span>
							  </th>
                              <th class="no-sort" width="7%">
								  <span class="text-left">Issue Date</span><br />
								  <span class="text-right">Submit Date</span>
							  </th>
                              <th class="no-sort" width="4%">
							  
                              	<span class="text-left">
                                	<select id="firstDropdownId">
                                    	<option value="">Gender</option>
                                        <option value="Boy" <?php if($gender == 'B'){ echo "selected"; }?>>Boy</option>
                                        <option value="Girl" <?php if($gender == 'G'){ echo "selected"; }?>>Girl</option>
                                    </select>
                                </span>
                            </th>
							  <th class="no-sort" width="4%">
								<span>
                                	<select id="siblingDropdownId">
                                    	<option value="">Sibling</option>
                                        <option value="Yes" <?php if($siblings == 'Yes'){ echo "selected"; }?>>Yes</option>
                                        <option value="NO" <?php if($siblings == 'No'){ echo "selected"; }?>>No</option>
                                    </select>
                                </span> </th>
								
                              <th class="no-sort" width="15%">
                              	
                               <div class="text-center col-md-12"> AST Appointment  </div>
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
                                        <option value="A+" <?php if($ass_d_result == 'A+'){ echo "selected"; }?>>A+</option>
                                        <option value="A-" <?php if($ass_d_result == 'A'){ echo "selected"; }?>>A-</option>
                                        <option value="B+" <?php if($ass_d_result == 'B+'){ echo "selected"; }?>>B+</option>
                                        <option value="B-" <?php if($ass_d_result == 'B'){ echo "selected"; }?>>B-</option>
										<option value="C" <?php if($ass_d_result == 'C'){ echo "selected"; }?>>C</option>
										<option value="D" <?php if($ass_d_result == 'D'){ echo "selected"; }?>>D</option>
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
                              	<div class="text-center col-md-12"> DIS Appointment  </div> 
                              	<div class="text-left col-md-6 no-padding">
                                	<select class="width100" id="discussion_date">
                                    	<option value="">DIS Date On</option>
                                     </select>
                                </div>
                                <div class="text-right col-md-6 no-padding">
                                	<select class="width60" id="discussion_name_code">
                                    	<option value="">DIS By</option>
                                    </select>
                                </div>
                            </th>
                              <th class="no-sort" width="6%">
                              	<span class="text-left">
                                	<select class="width40" id="discussion_result">
                                    	<option value="">R</option>
										  <option value="A+" <?php if($dis_result == 'A+'){ echo "selected"; }?>>A+</option>
                                        <option value="A-" <?php if($dis_result == 'A'){ echo "selected"; }?>>A-</option>
                                        <option value="B+" <?php if($dis_result == 'B+'){ echo "selected"; }?>>B+</option>
                                        <option value="B-" <?php if($dis_result == 'B'){ echo "selected"; }?>>B-</option>
										<option value="C" <?php if($dis_result == 'C'){ echo "selected"; }?>>C</option>
										<option value="D" <?php if($dis_result == 'D'){ echo "selected"; }?>>D</option>
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
					  
						if( !empty( $batchBilling ) )	{
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
					  
						}
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
					
					<?php
						$comma_separated ="";
						/*if( !empty($batch_name) ){
							
						}else{
							if( !empty($grade_id) ){
							foreach( $grade_id as $gd ){
								switch($gd){
									case 1: $comma_separated .=",PN"; break;
									case 2: $comma_separated .=",N,"; break;
									case 3: $comma_separated .="KG,"; break;
									case 4: $comma_separated .="I,"; break;
									case 5: $comma_separated .="II,"; break;
									case 6: $comma_separated .="III,"; break;
									case 7: $comma_separated .="IV,"; break;
									case 8: $comma_separated .="V,"; break;
									case 9: $comma_separated .="VI,"; break;
									case 10: $comma_separated .="VII,"; break;
									case 11: $comma_separated .="VIII,"; break;
									case 12: $comma_separated .="IX,"; break;
									case 13: $comma_separated .="X,"; break;
									case 14: $comma_separated .="XI,"; break;
									case 15: $comma_separated .="A1,"; break;
									case 16: $comma_separated .="A2"; break;
									
								}
							}
								//$comma_separated .= ",".$gd;
								
							}
						}*/
						
					?>
					<h5>Search Result For Grade <?php //echo $comma_separated; ?></h5>
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

<script>
$(document).ready(function(){
	
	

			

var h_Assmnt_dt = $("#h_Assmnt_dt").val();
var h_ass_name_code = $("#h_ass_name_code").val(); 
var h_a_d_n_c = $("#h_a_d_n_c").val();
var h_discussion_date = $("#h_discussion_date").val();
var h_dis_n_c = $("#h_dis_n_c").val(); 
var h_dis_dec = $("#h_dis_dec").val(); 
var h_OutCome = $("#h_OutCome").val(); 
var h_batch_cat = $("#h_batch_cat").val();

h_ass_d_result
var table = $('#batch_sheet2').DataTable({ "bLengthChange": false,
											"order": [],
											"columnDefs": [ { "targets": 'no-sort', "orderable": false } ],
											"aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
											"iDisplayLength": 20 });

var assNC = $("#ass_name_code");
var ASTDateOn = $("#AST_Date_On");
$bool = true;
var d_array=[];
var ass_n_c=[];

table.column(6).data().unique().sort().each( function ( d, j ) {
	
	var dt		=	d.split("simple_form_assessment_date");
	var dt2		=	dt[1].split('</div><div class="text-right col-md-4 ast_name_code">')
	var tting	=	dt2[0].toString();
	var assDate	=	tting.slice(2); 
	
	if( (assDate != "") ){
		d_array.push( assDate );	
	}
} );
var unique2 = d_array.filter(function(item, i, ar){ return ar.indexOf(item) === i; });
$.each(unique2, function(i, el){
	
if( h_Assmnt_dt == el ){
	ASTDateOn.append( '<option value="'+el+'" selected="selected">'+el+'</option>' )
}else{
	ASTDateOn.append( '<option value="'+el+'">'+el+'</option>' )
}
	

});



	
table.column(6).data().unique().sort().each( function ( d, j ) {
	var sp = d.split("ast_name_code");
	var ss = sp[1].split("</div>")
	var lenght = ss.length;
	//var lastFive = ss.substr( 1 ); // => "Tabs1"
	var testing =ss.toString();
	var sl =  testing.slice(2); //Outputs: Tabs1
	var sl = $.trim(sl.replace(',', ''));
	if( (sl != "") ){
		ass_n_c.push(sl);
	}
});
	
var unique3 = ass_n_c.filter(function(item, i, ar){ return ar.indexOf(item) === i; });
$.each(unique3, function(i, el){ 
if( h_ass_name_code == el ){
assNC.append( '<option value="'+el+'" selected="selected">'+el+'</option>' )
}else{
assNC.append( '<option value="'+el+'">'+el+'</option>' )	
}

});


var ASTDC = $("#ass_decission_name_code");
var ass_d_n_c = [];
table.column(7).data().unique().sort().each( function ( d, j ) {
  var dt = d.split("form_assessment_decision");
  
  var ss = dt[1].split("</span>")
	var lenght = ss.length;
	var testing =ss.toString();
	var sl =  testing.slice(2); //Outputs: Tabs1
	var sl = sl.replace(',', '');
	if( (sl != "") ){
	ass_d_n_c.push( sl );
	}

} );
var unique4 = ass_d_n_c.filter(function(item, i, ar){ return ar.indexOf(item) === i; });
$.each(unique4, function(i, el){ 
if( h_a_d_n_c == el ){
ASTDC.append( '<option value="'+el+'" selected="selected">'+el+'</option>' )
}else{
ASTDC.append( '<option value="'+el+'">'+el+'</option>' )	
}

});

	
var ASTDateOn2 = $("#discussion_date");
var d_array2=[];
table.column(8).data().unique().sort().each( function ( d, j ) {
	var dt = d.split("dis_done_on");
	//alert(dt[1])
	  var dt2 = dt[1].split('</div><div class="text-right col-md-4 dis_name_code">')
		var tting = dt2[0].toString();
		var assDate2 =  tting.slice(2); 
		if( (assDate2 != "") ){
			d_array2.push( assDate2 );	
		}
	
    } );
var unique2 = d_array2.filter(function(item, i, ar){ return ar.indexOf(item) === i; });
$.each(unique2, function(i, el){ 
if( h_discussion_date == el ){
ASTDateOn2.append( '<option value="'+el+'" selected="selected">'+el+'</option>' )
}else{
ASTDateOn2.append( '<option value="'+el+'">'+el+'</option>' )	
}

});




var ASTDC2 = $("#discussion_name_code");
var ass_d_n_c2 = [];
table.column(8).data().unique().sort().each( function ( d, j ) {
  var dt = d.split("dis_name_code");
 
  var ss = dt[1].split("</div>")
 
	var lenght = ss.length;
	var testing =ss.toString();
	var sl =  testing.slice(2); //Outputs: Tabs1
	 
	var sl = sl.replace(',', '');
	if( (sl != "") ){
	ass_d_n_c2.push( sl );
	}

} );
var unique5 = ass_d_n_c2.filter(function(item, i, ar){ return ar.indexOf(item) === i; });
$.each(unique5, function(i, el){ 
if( h_dis_n_c == el ){
ASTDC2.append( '<option value="'+el+'" selected="selected">'+el+'</option>' )
}else{
ASTDC2.append( '<option value="'+el+'">'+el+'</option>' )	
}

});


var ASTDC3 = $("#out_comeFinalResult");
var ass_d_n_c3 = [];
table.column(12).data().unique().sort().each( function ( d, j ) {
  var dt = d.split("form_discussion_decision");
 
  var ss = dt[1].split('</span><br><span class="text-right">')
  
	var testing =ss[0].toString();
	var sl =  testing.slice(2); //Outputs: Tabs1
	var sl = sl.replace(',', '');
	
	if( (sl != "") ){
	ass_d_n_c3.push( sl );
	}

} );
var unique4 = ass_d_n_c3.filter(function(item, i, ar){ return ar.indexOf(item) === i; });
$.each(unique4, function(i, el){ 
if( h_OutCome == el ){
ASTDC3.append( '<option value="'+el+'" selected="selected">'+el+'</option>' )	
}else{
ASTDC3.append( '<option value="'+el+'">'+el+'</option>' )	
}

});




var h_ass_d_result = $("#h_ass_d_result").val();
var ass_d_result = $("#ass_d_result");
$('select[id="ass_d_result"]').find('option[value="'+h_ass_d_result+'"]').attr("selected",true);




var h_dis_result = $("#h_dis_result").val();
var discussion_result = $("#discussion_result");
$('select[id="discussion_result"]').find('option[value="'+h_dis_result+'"]').attr("selected",true);

/*
			
$(document).on("change", "#firstDropdownId", function(){
var value = $(this).val();
console.log(value);
table.columns(4).search(value).draw();
} );

$(document).on("change", "#siblingDropdownId", function(){
var value = $(this).val();
console.log(value);
table.columns(5).search(value).draw();
} );

$(document).on("change", "#ass_name_code", function(){
var value = $(this).val();
table.columns(6).search(value).draw();
} );

$(document).on("change", "#AST_Date_On", function(){
var value = $(this).val();
table.columns(6).search(value).draw();
} );

$(document).on("change", "#ass_d_result", function(){
var value = $(this).val();
table.columns(7).search(value).draw();
} );

$(document).on("change", "#ass_decission_name_code", function(){
var value = $(this).val();
table.columns(7).search(value).draw();
} );


$(document).on("change", "#discussion_date", function(){
var value = $(this).val();
table.columns(8).search(value).draw();
} );


$(document).on("change", "#discussion_name_code", function(){
var value = $(this).val();
table.columns(8).search(value).draw();
} );


$(document).on("change", "#discussion_result", function(){
var value = $(this).val();
table.columns(9).search(value).draw();
} );


$(document).on("change", "#discussion_decission", function(){
var value = $(this).val();
table.columns(9).search(value).draw();
} );



$(document).on("change", "#out_comeFinalResult", function(){
var value = $(this).val();
table.columns(12).search(value).draw();
} );*/

/*function getvalues(){
	var myarray = ''; // more efficient than new Array()
	
	
	if( $("#firstDropdownId").val() != ''  ){ 
		var gender = $("#firstDropdownId").val(); 
	}else{ 
		var gender = ""; 
	}
	if( $("#siblingDropdownId").val() != ''  ){ 
		var siblings = $("#siblingDropdownId").val(); 
	}else{ 
		var siblings = "";
	}
	
	var AST_Date_On = $("#AST_Date_On").val();
	var ass_name_code = $("#ass_name_code").val();
	var ass_d_result = $("#ass_d_result").val();
	var ass_decission_name_code = $("#ass_decission_name_code").val();
	var discussion_date = $("#discussion_date").val();
	var discussion_name_code = $("#discussion_name_code").val();
	var discussion_result = $("#discussion_result").val();
	var discussion_decission = $("#discussion_decission").val();
	var out_comeFinalResult = $("#out_comeFinalResult").val();
	//var BiGSelectBox = $(".BiGSelectBox").val();
	
		var grade_id='';
		$('.someElement').each(function(){
			if( $(this).val() != '' ){
				grade_id +=","+$(this).val();
			}
			
		});
		
	myarray = "Gender="+gender+"&siblings="+siblings+"&AST_Date_On="+AST_Date_On+"&ass_name_code="+ass_name_code+"&ass_d_result="+ass_d_result+"&ass_decission_name_code="+ass_decission_name_code+"&discussion_date="+discussion_date+"&discussion_name_code="+discussion_name_code+"&discussion_result="+discussion_result+"&discussion_decission="+discussion_decission+"&out_comeFinalResult="+out_comeFinalResult+"&grade_id="+grade_id;
	return myarray;
	 

}

$(document).on("change", "#firstDropdownId", function(){
var arr = getvalues();
alert(arr)
});

$(document).on("change", "#siblingDropdownId", function(){
var arr = getvalues();
alert(arr)
});
*/

} );

</script>