<div class="col-md-12"> 
	<div class="col-md-12">
		<div class="dark-red powerwidget">
		 <header><h2> Position <small> Org Position </small></h2></header>
			  <div class="tab-content">
			  <br />
		       <table class="table">
               
                    <tr>
                      <td style="width:380px;">
							<table class="table table-bordered">
								<thead><tr><th style="text-align:center;">Allocation (3) </th></tr></thead>
								<tbody>
									<tr>
										<td style="text-align:center;">
											Staff, Series, paSSage
										</td>
									</tr>	
								</tbody>
							</table>
					  </td> <!-- //First table first TD -->
					  
                      <td style="width:300px;">
						<table class="table table-bordered">
								<thead><tr><th style="text-align:center;">Allocation (2) </th></tr></thead>
								<tbody>
									<tr>
										<td style="text-align:center;">
											Position ID
										</td>
									</tr>	
								</tbody>
							</table>
							
					  </td><!-- // first table second td -->
                       <td style="width:300px;">
						<table class="table table-bordered ">
								<thead><tr><th style="text-align:center;">Label (2) </th></tr></thead>
								<tbody>
									<tr>
										<td style="text-align:center;">
											Position Title
										</td>
									</tr>	
								</tbody>
							</table>
							
					  </td><!-- // first table third td -->
                      <td style="width:480px;">
						<table class="table table-bordered ">
								<thead><tr><th style="text-align:center;" colspan="2">Link (2) </th></tr></thead>
								<tbody>
									<tr style="text-align:center;">
										<td> Reporting Primary </td>
										<td> Reporting Secondary </td>
									</tr>	
								</tbody>
							</table>
							
					  </td><!-- // first table fourth td -->
					</tr>
                 
                </table>
        	  <br />
		       <table class="table table-striped ">
					<tr>
                      <td style="width:380px;">
							<table width="100%">
								
								
									<tr>
										<td>
											<table class="table table-bordered">
												<tr style="background-color: #f0f0ed;">
													<td colspan="2">Role Code</td>
													<td colspan="2" style="text-align:right"> GT-ID</td>
												</tr>
												<tr><td colspan="4" style="text-align:center;">Staff Name</td></tr>
												<tr>
													<td class="list-group-item-danger" >NMC</td>
													<td style="text-align:center;">Count</td>
													<td class="list-group-item-danger" style="text-align:center;">B/I</td>
													<td class="list-group-item-danger" style="text-align:center;">OP/TR/VC</td>
												</tr>
											</table>
											
										</td>
									</tr>	
							</table>
					  </td> <!-- //First table first TD -->
					  
                      <td style="width:300px;">
						<table style="width: 100%;">
						  <tr>
							<td>
								<table class="table table-bordered" style="text-align:center;width:100%">
									<tr class="list-group-item-danger"><td>Segment Wing</td></tr>
									<tr class="list-group-item-danger"><td> Role Category </td></tr>
									<tr><td> Location Serial</td></tr>
								</table>
							
							</td>
						  </tr>	
						</table>
							
					  </td><!-- // first table second td -->
                       <td style="width:300px;">
						<table style="width: 100%;">
							<tr> 
								<td>
									<table class="table table-bordered" style="text-align:center;">
									<tr><td> Position ID</td></tr>
									<tr class="list-group-item-danger"><td> Position Title - TL </td></tr>
									<tr class="list-group-item-danger"><td> Position Title - BL</td></tr>
								</table>
								</td>
							 </tr>	
							</tbody>
						 </table>
							
					  </td><!-- // first table third td -->
                      <td style="width:480px;">
						<table class="table">
							<tr style="text-align:center;">
							 <td style="width:240px;">
									<table class="table">
										<tr>
											<td style="color:#82b964;">Role Code </td>
											<td> Staff Name</td>
										</tr>
										<tr class="list-group-item-danger"><td colspan="2">Position ID</td></tr>
										<tr><td colspan="2">Position Title</td></tr>
									</table>
							 </td>
							 <td style="width:240px;">
							 <table class="table">
								<tr>
									<td style="color:#82b964;">Role Code </td>
									<td> Staff Name</td>
								</tr>
								<tr class="list-group-item-danger"><td colspan="2">Position ID</td></tr>
								<tr><td colspan="2">Position Title</td></tr>
							</table>
							 </td>
							</tr>	
						</table>
					  </td><!-- // first table fourth td -->
					</tr>
               </table>
			  
        	  <br />
			  
			  
			  <?php 
			  
			  if(!empty( $results )){ ?>
			  
			   <?php foreach( $results AS $pos ){ ?>
			   <?php $pos["PositionID"];?>
			   <?php $PF = $pos["PF"]; ?>
               <table class="table table-striped  orb-form containerTable">
			   
               <input type="hidden" name="staffIDV[]" class="staffIDV" value="<?=$pos["PositionsStaffID"];?>" />
			   <input type="hidden" name="roleCodeV[]" class="roleCodeV" value="<?=$pos["RoleCode"];?>" />
			   
			   <input type="hidden" name="domainH[]" class="domainHidden" value="<?=$pos["DomainID"];?>" />
			   <input type="hidden" name="domainHTxt[]" class="domainHiddenTxt" />
			   
			   <input type="hidden" name="roletypeH[]" class="roletypeHidden" value="<?=$pos["TypeID"];?>" />
			   <input type="hidden" name="roletypeHTxt[]" class="roletypeHiddenTxt" />
			   
			   <input type="hidden" name="categoryH[]" class="categoryHidden" value="<?=$pos["CatID"];?>" />
			   <input type="hidden" name="categoryHTxt[]" class="categoryHiddenTxt" />
			   
			   <input type="hidden" name="positionIDH[]" class="positionIDH" value="<?=$pos["PositionID"];?>" />
			   <input type="hidden" name="lastID[]" class="lastID" value="<?=$pos["PositionID"];?>"/>
			   
			   <input type="hidden" name="positionStatus[]" class="positionStatus" value="1" />
			   

			   
				<?php
					$CI =& get_instance();
					$staffID = $pos["PositionsStaffID"];
					if($staffID > 0 ){
						$staffID =  $CI->primaryPostions( $staffID ) ;
						$PositionCount = count($staffID);
					}else{
						$PositionCount = 0;
					}
					//var_dump($staffID);
				?>
				
					<?php 
							$posCount = $pos["PositionCount"]; 
							
							$thisID = $pos["PositionID"];
							
							?>
							<input type="hidden" name="PositionCount[]" class="PositionCount" value="<?=$posCount;?>" />
							<input type="hidden" name="countRoleCode[]" class="countRoleCode" class="countRoleCode" value="<?=$posCount;?>" />
                    <tr>
                      <td style="width:380px;padding-right:0;">
						 <table style="width:96%;">
							<tr>
							<td>
							<table class="table table-bordered allocation_3">
							<tr style="background-color: #f0f0ed;">
							<td colspan="2"> <span class="roleCode1">
							
							<?php //echo $pos["RoleCode"];
							
							
							$ex = explode("-",$pos["RoleCode"]);
							echo $ex[0].'-'; ?></span><span class="roleCode2">
							
							<?php echo $ex[1]; 
							
							/*if($PositionCount > 1 ){
								$ID1 = $staffID[0]["PosID"];
								if( $thisID == $ID1 ){
									echo "A";
								}else{
									echo "B";
								}
							}else{
								echo "I";
							} */
							?>
							</span>
							
								<input type="hidden" name="roleCode3" class="roleCode3" />
								<input type="hidden" name="roleCode4" class="roleCode4" />
								
								
							   <?php
								if( $PositionCount == 0 ){
								$positons = 0;
								}else if( $PositionCount == 1 ){
									$dum = 0;
									$positons = $thisID."_".$dum;
								}else{
								$posID1 = $staffID[0]["PosID"];
									if(  $staffID[1]["PosID"] != NULL ){
										$posID2 = $staffID[1]["PosID"];
										$positons = $posID1."_".$posID2;	
									}else{
										$positons = $posID1."_".$thisID;
									}
								
								}
								//var_dump($staffID);
								?>
			   
			     <input type="hidden" name="fundamentalID[]" class="fundamentalID" value="<?=$positons;?>" />
				 
								
							</td>
							<td colspan="2" style="text-align:right"> <span  class="gt_ID"> <?=$pos["GT_ID"];?></span></td>
							</tr>
							<tr><td colspan="4" style="text-align:center;"><span  class="nameCode">
							<?php if( $pos["staffName"] != '' ){
								echo $pos["staffName"];
							}else{
								echo "Position not assigned!";
							} ?>
							</span> </td></tr>
							<tr>
							<td class="list-group-item-danger" >
							
							<?php  if(!empty( $staff )){ ?>
							<select name="staffID" class="staffID">
							<option value="0">Code</option>
							<?php foreach( $staff as $stfId ){ ?>
							<option value="<?=$stfId["StaffID"];?>" <?php if( $pos["PositionsStaffID"] == $stfId["StaffID"] ) { echo "selected"; } ?>> 
							<?=$stfId["nCode"];?></option>
							<?php } ?>
							</select>
							<?php } ?>
							</td>
							<td style="text-align:center;">
							<div class="staffCount">
							
							<?=$pos["PositionCount"];?>
							
							</div>
							</td>
							<td class="list-group-item-danger" style="text-align:center;"> 
							Fundamental?<br />
							
							<div class="fundamental">
						
							
						
							<?php
							$html = '';
							if( $PositionCount == 0 ){
								$html .= '<input type="radio" name="fundacheck'.$thisID.'" value="V_'.$ID.'" class="fundaCount" checked="" disabled /> V';
							}else if( $PositionCount == 1 ){
								$ID = $staffID[0]["PosID"];
								$html .= '<input type="radio" name="fundacheck'.$thisID.'" value="I_'.$ID.'" class="fundaCount"  checked="" disabled /> I';
							}else if( $PositionCount == 2 ){
								$ID1 = $staffID[0]["PosID"];
								$ID2 = $staffID[1]["PosID"];
								if( $PF == $thisID ){
							    	$html .= '<input type="radio" name="fundacheck'.$thisID.'" value="A_'.$ID1.'" class="fundaCount" checked="checked" /> A';
									$html .= '<input type="radio" name="fundacheck'.$thisID.'" value="B_'.$ID2.'" class="fundaCount" /> B';
								}else{
									$html .= '<input type="radio" name="fundacheck'.$thisID.'" value="A_'.$ID1.'" class="fundaCount" /> A';
									$html .= '<input type="radio" name="fundacheck'.$thisID.'" value="B_'.$ID2.'" class="fundaCount" checked="checked" /> B';
								}
							}else{
								$html .= "Error! While assigning";
							}
								echo $html;
							?>
							</div>
							
							
							
							</td>
							<td class="list-group-item-danger" style="text-align:center;">
							<?php $trans = $pos["Transparent"]; ?>
							<select name="cat2[]" class="cat2">
							
							<option value="0">Code</option>
							
							<option value="1" <?php if( $trans == 1 ){ echo "selected"; }?>>OP</option>
							<option value="2" <?php if( $trans == 2 ){ echo "selected"; }?>>TR</option>
							<option value="3" <?php if( $trans == 3 ){ echo "selected"; }?>>VC</option>
							</select>
							</td>
							</tr>
							</table>
							</td>
							</tr>	
							</table>
					  </td> <!-- //First table first TD -->
					  
                      <td style="width:300px;padding-left: 0;">
							<table style="width: 100%;">
							<tr>
							<td>
							<table style="text-align:center;width:100%;" class="table table-bordered allocation_2">
							<tr class="list-group-item-danger"><td>
							<?php
							
							$lss = explode("-",$pos["PostionTitle"]);
							$str =  $lss[0]."-".$lss[1]."-".$lss[2];
							echo $str;
							?></td></tr>
							<tr class="list-group-item-danger"><td> </td></tr>
							<tr><td> 
							<div class="locationSerial">
							<?php
							$ls = explode("-",$pos["PostionTitle"]);
							echo $ls[3];
							?>
							
							</div>
							
							<div class="locSlContinue" style="display:none;">
							<div class="positionIDLabel"> 
							<?php echo $pos["PostionTitle"]; ?>
							</div>	
							<a href="#" class="lsclink">Continue..</a>
							</div>
							
							</td></tr>
							</table>

							</td>
							</tr>	
							</table>
							
					  </td><!-- // first table second td -->
                       <td style="width:300px;">
						<table style="width: 100%;" class="positionIDT">
							<tr> 
								<td>
									<table class="table table-bordered tableClick" style="text-align:center;" id="label_2">
									<tr><td> 
									<div class="positionIDLabel2">
										<?php echo $pos["PostionTitle"]; ?>
									</div>	
									</td></tr>
									<tr class="list-group-item-danger"><td> <input type="text" name="tagline[]" class="tagline" value="<?=$pos["TopLine"]; ?>" /> </td></tr>
									<tr class="list-group-item-danger"><td> <input type="text" name="bottomline[]" class="bottomline" value="<?=$pos["BottomLine"]; ?>" /> </td></tr>
								</table>
								</td>
							 </tr>	
							</tbody>
						 </table>
							
					  </td><!-- // first table third td -->
                      <td style="width:480px;">
						<table class="table">
							<tr style="text-align:center;">
							 <td style="width:280px;">
									<table class="table table-bordered link_1">
										<tr>
										
											<td style="color:#82b964;"> 
											
											<?php //echo "pmPostionID". $pos['pmPostionID']; ?>
											
										<select name="rpRoleCode[]" style="width:100%;" class="rpRoleCode">
										<option value="" <?php if( $pos['pmPostionID'] == 0){ echo "selected"; }?>>Role Code </option>
										<?php foreach($positions AS $s ){?>
										
										<option value="<?=$s["postionID"];?>" <?php if( $pos['pmPostionID'] == $s["postionID"]){ echo "selected"; }?>>
										<?=$s["roleCode"];?></option>
										
										<?php }  ?>
										</select>

											</td>
											<td> <div class="pRSName"> <?php echo $pos['PRstaffName']?$pos['PRstaffName']:'Staff Name'; ?> </div> </td>
										</tr>
										<tr class="list-group-item-danger"><td colspan="2">
									<?php //echo "pmPostionID". $pos['pmPostionID']; ?>
										<select name="positionID[]" style="width:100%;" class="positionID">
										<option value="" <?php if( $pos['pmPostionID'] == 0){ echo "selected"; }?>>Position ID</option>
										<?php 
										foreach($positions AS $pos2 ){?>
											<option value="<?=$pos2["postionID"];?>" <?php if( $pos['pmPostionID'] == $pos2["postionID"]){ echo "selected"; }?>><?=$pos2["positionTitle"];?></option>
										<?php } ?>
										</select>
										
										</td></tr>
										<tr><td colspan="2">
											<div class="posTitleTB">
											<?php if( $pos["pmTopLine"] != NULL ){
												echo $pos["pmTopLine"];
											}else{
												echo "Position Title";
											}
											if( $pos["pmBottomLine"] != NULL && trim($pos["pmBottomLine"]) != '' ){
												echo ",".$pos["pmBottomLine"];
											}
											?>
											</div>
										</td></tr>
									</table>
							 </td>
							 <td style="width:280px;">
							 	<table class="table table-bordered link_2">
										<tr>
											<td style="color:#82b964;">
											<?php //echo "SecondayReportID". $pos['SecondayReportID']; ?>
											<select name="rpRoleCode[]" style="width:100%;" class="rpRoleCode2">
										<option value="">Role Code</option>
										<?php //if( $pos['SecondayReportID'] > 0  ){ ?>
										<?php  foreach($positions AS $pos3 ){?>
										<option value="<?=$pos3["postionID"];?>" <?php if( $pos['SecondayReportID'] == $pos3["postionID"] ){ echo "selected"; }?>><?=$pos3["roleCode"];?></option>
										<?php }  ?>
										
										<?php /*}else{
											<option value="0"> Creat Only</option>
										} */?>
										
										</select>
											</td>
											
											<td> <div class="pRSName2"> <?php echo $pos['SRstffName']?$pos['SRstffName']:'Staff Name'; ?>  </div> </td>
											
										</tr>
										<tr class="list-group-item-danger"><td colspan="2">
										<select name="positionID2[]" class="positionID2" style="width:100%;">
										<option value="">Position ID</option>
										<?php //if( $pos['SecondayReportID'] > 0  ){ ?>
										<?php  foreach($positions AS $pos3 ){?>
										<option value="<?=$pos3["postionID"];?>" <?php if( $pos['SecondayReportID'] == $pos3["postionID"]){ echo "selected"; }?>><?=$pos3["positionTitle"];?></option>
										<?php }  ?>
										<?php /*}else{ 
											<option value="0"> Creat Only</option>
										 } */?>
										
										</select>
										
										</td></tr>
										<tr><td colspan="2">
										<div class="posTitleTB2">
											<?php 
											if( isset( $pos["srTopLine"] )  ){
												
												echo $pos["srTopLine"];
											}else{
												echo "Position Title";
												
											}
											
											if( $pos["srBottomLine"] != null ){
												echo ",".$pos["srBottomLine"];
											}
											
											?>
											</div>
										</td></tr>
									</table>
							 </td>
							</tr>	
						</table>
							
					  </td><!-- // first table fourth td -->
					</tr>
                </table>
				<hr />
              <?php } ?>
			   <?php } ?>
			</div>
		</div>
	</div>
</div>


