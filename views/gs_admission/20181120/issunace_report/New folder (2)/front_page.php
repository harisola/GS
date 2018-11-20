
<div class="container" id="BatchListing">
    <!-- Two column layout Start -->
	<div class="row">
        <div class="col-md-12 BatchListing">
        	<div class="MaroonBorderBox">
        		<h3>Issuance Report</h3>
                <div class="inner" style="padding:20px !important;">
                	<div class="col-md-2">
                    	<span class="filterTitle">Select Grade</span>
                    	<dl class="dropdown">
                            <dt>
                            	<a href="#"><span class="hida">Select</span> <p class="multiSel" style="display:;"></p></a>
                            </dt><!-- dt -->
                            <dd>
                                <div class="mutliSelect">
                                    <ul>
                                        <li><input type="checkbox" value="All" name="All" id="All"/><label for="All">All Grades</label></li>
                                        <li><input type="checkbox" value="1" name="PN" id="PN" /><label for="PN">PN</label></li>
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
                        </dl><!-- dl -->
                    </div><!-- col-md-2 -->
					
						<form action="<?=base_url();?>index.php/gs_admission/issuance_report/fliter" method="POST" name="fliter_issuance" id="fliter_issuance">
						<input type="hidden" name="gradeNameValidate" id="gradeNameValidate" value="" />
                    <div class="col-md-2">
                    	<span class="filterTitle">From</span>
                    	<input type="text" placeholder="From" id="from_date" name="from_date" />
                    </div><!-- col-md-2 -->
                    <div class="col-md-2">
                    	<span class="filterTitle">To</span>
                    	<input type="text" placeholder="To"  id="to_date" name="to_date" />
                    </div><!-- col-md-2 -->
<style>
.tooltipp {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.tooltipp .tooltiptext {
    visibility: hidden;
    width: 170px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 1s;
}

.tooltipp .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

.tooltipp:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}
</style>                    
				
                    <div class="col-md-2" style="width:15%;">
                    	<input type="submit" id="issuance_fliter" name="issuance_fliter" class="greenBTN" value="Apply Filters" style="padding:14px;" />
                    </div><!-- col-md-2 -->
                </div><!-- inner -->
				</form>
				
                <hr class="RedHR" />
                <div class="inner paddingLeft20 paddingRight20" style="padding:20px !important;" id="paddingRight20">
				<?php //var_dump( $issuance_report ); ?>
                    <table id="data_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                      <thead> 
                          <tr> 
                              <th class="text-center"></th> 
                              <th class="text-center">PN</th> 
                              <th class="text-center">N</th> 
                              <th class="text-center">KG</th>
                              <th class="text-center">I</th>
                              <th class="text-center">II</th>
                              <th class="text-center">III</th>
                              <th class="text-center">IV</th>
                              <th class="text-center">V</th>
                              <th class="text-center">VI</th>
                              <th class="text-center">VII</th>
                              <th class="text-center">VIII</th>
                              <th class="text-center">IX</th>
                              <th class="text-center">X</th>
							  <th class="text-center">XI</th>
							  <th class="text-center">A</th>
                              <th class="text-center" style="border-left:2px solid #888;">Total</th>
                          </tr>
                      </thead>
                      <tbody> 
					
					  <?php 
					  $grandTotalGirls=0;
					  $grandTotalBoye=0;
					  
					  $grandTotalGirlsPN=0;
					  $grandTotalBoysPN=0;
					  
					  $grandTotalGirlsN=0;
					  $grandTotalBoysN=0;
					  
					  
					  $grandTotalGirlskg=0;
					  $grandTotalBoyskg=0;
					  
					  
					  $grandTotalGirlsi=0;
					  $grandTotalBoysi=0;
					  
					  
					  $grandTotalGirlsii=0;
					  $grandTotalBoysii=0;
					  
					  
					  $grandTotalGirlsiii=0;
					  $grandTotalBoysiii=0;
					  
					  
					  $grandTotalGirlsiv=0;
					  $grandTotalBoysiv=0;
					  
					  $grandTotalGirlsv=0;
					  $grandTotalBoysv=0;
					  
					  
					  $grandTotalGirlsvi=0;
					  $grandTotalBoysvi=0;
					  
					  
					  $grandTotalGirlsvii=0;
					  $grandTotalBoysvii=0;
					  
					  
					  $grandTotalGirlsviii=0;
					  $grandTotalBoysviii=0;
					  
					  
					  $grandTotalGirlsix=0;
					  $grandTotalBoysix=0;
					  
					  
					  $grandTotalGirlsx=0;
					  $grandTotalBoysx=0;
					  
					  
					  $grandTotalGirlsxi=0;
					  $grandTotalBoysxi=0;
					  
					  
					  $grandTotalGirlsxii=0;
					  $grandTotalBoysxii=0;
					  
					  $TotalGirls = 0;
					  $TotalBoye = 0;
					  
					  
						if( !empty( $issuance_report ) ){ ?>
						  <?php foreach( $issuance_report as $ir ){  
							$countGirls=0;
							$countBoy= 0; ?>
						       <tr>
							   
								<td class="text-center"> <strong> <?=$ir["issuance_date"];?></strong></td>
							  
							<td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>
									<?php if( (int)$ir["PN_G"] > 0 ){
										echo $ir["PN_G"];
										$countGirls += (int)$ir["PN_G"];
										 $grandTotalGirlsPN += (int)$ir["PN_G"];
									}else{
										echo 0;
									} ?>
									</strong>
                                    <!--span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span -->
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php
									if( (int)$ir["PN_B"] > 0 ){
										echo $ir["PN_B"];
										$countBoy += $ir["PN_B"];
										 $grandTotalBoysPN += (int)$ir["PN_B"];
									}else{
										echo 0;
									} ?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong><?php 
									if( (int)$ir["N_G"] > 0){
										echo $ir["N_G"];
										$countGirls += (int)$ir["N_G"];
										$grandTotalGirlsN += (int)$ir["N_G"];
									}else{
										echo 0;
									} ?></strong>
                                    
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["N_B"] > 0){ echo $ir["N_B"]; 
									$countBoy += $ir["N_B"]; 
									$grandTotalBoysN += $ir["N_B"];
									}else{ echo 0; } ?></strong>
                                
                                </div>
                              </td>
							  
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
									<strong><?php if( (int)$ir["KG_G"] > 0){ echo $ir["KG_G"]; 
									$countGirls += (int)$ir["KG_G"];
									
									$grandTotalGirlskg += (int)$ir["KG_G"];
									
									}else{ echo 0; } ?></strong>
                                   
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                   
									<strong><?php if( (int)$ir["KG_B"] > 0){ echo $ir["KG_B"]; 
									$countBoy += $ir["KG_B"]; 
									$grandTotalBoyskg += $ir["KG_B"]; 
									
									}else{ echo 0; } ?></strong>
                                	
                                </div>
                              </td>
							  
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>
									<strong><?php if( (int)$ir["I_G"] > 0){ echo $ir["I_G"]; 
									$countGirls += (int)$ir["I_G"];
									$grandTotalGirlsi += (int)$ir["I_G"];
									
									 }else{ echo 0; } ?></strong>
                                    
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                	<strong><?php if( (int)$ir["I_B"] > 0){ echo $ir["I_B"]; 
									$countBoy += $ir["I_B"]; 
									$grandTotalBoysi += $ir["I_B"]; 
									}else{ echo 0; } ?></strong>
                                	
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
									<strong><?php if( (int)$ir["II_G"] > 0){ echo $ir["II_G"];
									$countGirls += (int)$ir["II_G"];
									$grandTotalGirlsii += (int)$ir["II_G"];
									
									}else{ echo 0; } ?></strong>
                                    
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["II_B"] > 0){ echo $ir["II_B"]; 
									
									$countBoy += $ir["II_B"]; 
									$grandTotalBoysii += $ir["II_B"]; 
									
									}else{ echo 0; } ?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong>
									<?php if( (int)$ir["III_G"] > 0){ echo $ir["III_G"]; 
												$countGirls += (int)$ir["III_G"];
												$grandTotalGirlsiii += (int)$ir["III_G"];
												
									}else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["III_B"] > 0){ echo $ir["III_B"]; 
									$countBoy += $ir["III_B"]; 
									$grandTotalBoysiii += $ir["III_B"]; 
									}else{ echo 0; } ?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?php if( (int)$ir["IV_G"] > 0){ echo $ir["IV_G"]; 
									$countGirls += (int)$ir["IV_G"];
									$grandTotalGirlsiv += (int)$ir["IV_G"];
									
									}else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["IV_B"] > 0){ echo $ir["IV_B"]; 
									$countBoy += $ir["IV_B"];
									$grandTotalBoysiv += $ir["IV_B"];
									}else{ echo 0; } ?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?php if( (int)$ir["V_G"] > 0){ echo $ir["V_G"]; 
									$countGirls += (int)$ir["V_G"];
									$grandTotalGirlsv += (int)$ir["V_G"];
									
									 }else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["V_B"] > 0){ echo $ir["V_B"]; 
									$countBoy += $ir["V_B"]; 
									$grandTotalBoysv += $ir["V_B"]; 
									
									}else{ echo 0; } ?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                  <strong><?php if( (int)$ir["VI_G"] > 0){ echo $ir["VI_G"];
								  $countGirls += (int)$ir["VI_G"];
								  $grandTotalGirlsvi += (int)$ir["VI_G"];
								   }else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["VI_B"] > 0){ echo $ir["VI_B"];
									$countBoy += $ir["VI_B"];
									$grandTotalBoysvi += $ir["VI_B"];
									}else{ echo 0; } ?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?php if( (int)$ir["VII_G"] > 0){ echo $ir["VII_G"];
											$countGirls += (int)$ir["VII_G"];
											$grandTotalGirlsvii += (int)$ir["VII_G"];
									 }else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
									<strong><?php if( (int)$ir["VII_B"] > 0){ echo $ir["VII_B"]; 
									$countBoy += $ir["VII_B"];
									$grandTotalBoysvii += $ir["VII_B"];
									}else{ echo 0; } ?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?php if( (int)$ir["VIII_G"] > 0){ echo $ir["VIII_G"];
									$countGirls += (int)$ir["VIII_G"];
									$grandTotalGirlsviii += (int)$ir["VIII_G"];

									}else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["VIII_B"] > 0){ echo $ir["VIII_B"];  
									$countBoy += $ir["VIII_B"];
									$grandTotalBoysviii += $ir["VIII_B"];
									}else{ echo 0; } ?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?php if( (int)$ir["IX_G"] > 0){ echo $ir["IX_G"]; 
									$countGirls += (int)$ir["IX_G"];
									$grandTotalGirlsix += (int)$ir["IX_G"];
									}else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                   
                                	<strong><?php if( (int)$ir["IX_B"] > 0){ echo $ir["IX_B"]; 
									
									$countBoy += $ir["IX_B"]; 
									$grandTotalBoysix += $ir["IX_B"]; 
									}else{ echo 0; } ?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                   <strong><?php if( (int)$ir["X_G"] > 0){ echo $ir["X_G"]; 
								   $countGirls += (int)$ir["X_G"];
								   $grandTotalGirlsx += (int)$ir["X_G"]; 
								   }else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["X_B"] > 0){ echo $ir["X_B"]; 
									$countBoy += $ir["X_B"];
									$grandTotalBoysx += $ir["X_B"];
									}else{ echo 0; } ?></strong>
                                </div>
                              </td>
                              <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                   <strong><?php if( (int)$ir["XI_G"] > 0){ echo $ir["XI_G"]; 
								   $countGirls += (int)$ir["XI_G"];
								   $grandTotalGirlsxi += (int)$ir["XI_G"];
								   }else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["XI_B"] > 0){ echo $ir["XI_B"];
									$countBoy += $ir["XI_B"]; 
									$grandTotalBoysxi += $ir["XI_B"];
									}else{ echo 0; } ?></strong>
                                </div>
                              </td>
							      <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                   <strong><?php if( (int)$ir["A1_G"] > 0){ echo $ir["A1_G"]; 
								   $countGirls += (int)$ir["A1_G"]; 
								   $grandTotalGirlsxii += (int)$ir["A1_G"]; 
								   }else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["A1_B"] > 0){ echo $ir["A1_B"]; 
									$countBoy += $ir["A1_B"]; 
									$grandTotalBoysxii += $ir["A1_B"];
									}else{ echo 0; } ?></strong>
                                </div>
                              </td>
                           
							   <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong><?=$countGirls;?></strong>
                                  
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$countBoy;?></strong>
                                	
									
									<?php
									$TotalGirls += $countGirls;
									$TotalBoye += $countBoy;
									?>
									
                                </div>
                              </td>
                           
							  
                             
                          </tr>
                      
						  <?php } ?>
					  <?php } ?>
					  
                         <!-- Grand Total -->
						 
						 
						    <tr>
							   
								<td class="text-center"> <strong> Grand Total </strong></td>
							  
							<td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>
									<?=$grandTotalGirlsPN;?>
									</strong>
                                    <!--span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span -->
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysPN;?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong><?=$grandTotalGirlsN;?></strong>
                                    
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysN;?></strong>
                                
                                </div>
                              </td>
							  
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
									<strong><?=$grandTotalGirlskg;?></strong>
                                    
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                   
									<strong><?=$grandTotalBoyskg;?></strong>
                                	
                                </div>
                              </td>
							  
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>
									<strong><?=$grandTotalGirlsi;?></strong>
                                    
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                	<strong><?=$grandTotalBoysi;?></strong>
                                	
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
									<strong><?=$grandTotalGirlsii;?></strong>
                                    
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysii;?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong>
									<?=$grandTotalGirlsiii;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysiii;?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?=$grandTotalGirlsiv;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysiv;?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?=$grandTotalGirlsv;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysv;?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                  <strong><?=$grandTotalGirlsvi;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysvi;?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?=$grandTotalGirlsvii;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
									<strong><?=$grandTotalBoysvii;?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?=$grandTotalGirlsviii;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysviii;?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?=$grandTotalGirlsix;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                   
                                	<strong><?=$grandTotalBoysix;?></strong>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                   <strong><?=$grandTotalGirlsx;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysx;?></strong>
                                </div>
                              </td>
                              <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                   <strong><?=$grandTotalGirlsxi;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysxi;?></strong>
                                </div>
                              </td>
							      <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                   <strong><?=$grandTotalGirlsxii;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysxii;?></strong>
                                </div>
                              </td>
                           
							   <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong><?=$TotalGirls;?>
									</strong>
                                  
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$TotalBoye;?></strong>
                                	
									
									
									
                                </div>
                              </td>
                           
							  
                             
                          </tr>
                      </tbody> 
                    </table><!-- StaffListing -->
					
					<?php
					
				
//echo $grandTotalGirls;
//echo "<br />";
//echo $grandTotalBoye;
?>
                </div><!-- inner -->
            </div><!-- MaroonBorderBox -->
        </div><!-- col-md-12 -->
    </div><!-- row -->
    <!-- Two column layout END -->
</div><!-- container -->


