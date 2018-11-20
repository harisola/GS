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
											Staff, Series, Passage
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
													<td colspan="2" style="text-align:center">Role Code</td>
													<td colspan="2" style="text-align:center"> GT-ID</td>
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
						<table style="width: 100%;">
							<tr style="text-align:center;">
							 <td> 
									<table class="table table-bordered">
										<tr>
											<td style="color:#82b964;">Role Code </td>
											<td> Staff Name</td>
										</tr>
										<tr class="list-group-item-danger"><td colspan="2">Position ID</td></tr>
										<tr><td colspan="2">Position Title</td></tr>
									</table>
							 </td>
							 <td>
							 <table class="table table-bordered">
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
			  
			  <?php for($count=1; $count<2;$count++) { ?> 
               <table class="table table-striped  orb-form containerTable">
               <input type="hidden" name="staffIDV[]" class="staffIDV" />
			   <input type="hidden" name="roleCodeV[]" class="roleCodeV" />
			   
			   <input type="hidden" name="domainH[]" class="domainHidden" />
			   <input type="hidden" name="domainHTxt[]" class="domainHiddenTxt" />
			   
			   <input type="hidden" name="roletypeH[]" class="roletypeHidden" />
			   <input type="hidden" name="roletypeHTxt[]" class="roletypeHiddenTxt" />
			   
			   <input type="hidden" name="categoryH[]" class="categoryHidden" />
			   <input type="hidden" name="categoryHTxt[]" class="categoryHiddenTxt" />
			   
			   <input type="hidden" name="positionIDH[]" class="positionIDH" />
			   <input type="hidden" name="lastID[]" class="lastID" />
			   
			   <input type="hidden" name="countRoleCode[]" class="countRoleCode" class="countRoleCode" value="1" />
			   
			   <input type="hidden" name="positionStatus[]" class="positionStatus" value="1" />
			   
			   <input type="hidden" name="fundamentalID[]" class="fundamentalID" value="" />
			   
                    <tr>
                      <td style="width:380px;padding-right:0;">
						 <table style="width:96%;" class="tableFour">
							<tr>
							<td>
							<table class="table table-bordered allocation_3" style="opacity:0.3;">
							<tr style="background-color: #f0f0ed;">
							<td colspan="2" style="text-align:center;"> <span class="roleCode1"> Role Code</span> <span class="roleCode2"></span>
							
								<input type="hidden" name="roleCode3" class="roleCode3" />
								<input type="hidden" name="roleCode4" class="roleCode4" />
								
							</td>
							<td colspan="2" style="text-align:center"> <span  class="gt_ID">GT-ID </span></td>
							</tr>
							<tr><td colspan="4" style="text-align:center;"><span  class="nameCode">Staff Name</span> </td></tr>
							<tr>
							<td class="list-group-item-danger" >
							<?php if(!empty( $staff )){ ?>
							<select name="staffID" class="staffID">
							<option value="0">Code</option>
							<?php foreach( $staff as $stfId ){ ?>
							<option value="<?=$stfId["StaffID"];?>" title="<?=$stfId["aname"];?>"> <?=$stfId["nCode"];?></option>
							<?php } ?>
							</select>
							<?php } ?>
							</td>
							<td style="text-align:center;">
							<div class="staffCount">
							Count
							</div>
							</td>
							<td class="list-group-item-danger" style="text-align:center;"> 
							Fundamental?<br />
							
							<div class="fundamental"><input type="radio" name="fundacheck" value="V_0" class="fundaCount" />V</div>
							
							<!--select name="cat1[]" class="cat1" disabled>
							<option value="0">Code</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="I">I</option>
							<option value="V">V</option>
							</select -->
							
							</td>
							<td class="list-group-item-danger" style="text-align:center;">

							<select name="cat2[]" class="cat2">
							<option value="0">Code</option>
							<option value="1">OP</option>
							<option value="2">TR</option>
							<option value="3">VC</option>
							</select>
							</td>
							</tr>
							</table>
							</td>
							</tr>	
							</table>
					  </td> <!-- //First table first TD -->
<style>
.firstActive {
border-radius: 5px;
box-shadow: 3px 3px 25px 1px #808080;
display: block;
padding: 20px;
width: 300px;
}

</style>
                      <td style="padding-left: 0;">
							<table style="" class="firstActive tableOne">
							<tr>
							<td>
							<table style="text-align:center;width:285px;" class="table table-bordered allocation_2">
							<tr class="list-group-item-danger"><td>
							<?php 
							//var_dump($domains); 
							if(!empty( $domains )){ ?>
							<select name="domain[]" class="domain" id="gs_domain">
							<option value="">Domain</option>
							<?php foreach( $domains as $domain ){ ?>
							<option value="<?=$domain["id"];?>" title="<?=$domain["dname"];?>"><?=ucfirst($domain["code"]);?> </option>
							<?php } ?>
							</select>
							<?php } ?>
							
							<?php 
							//var_dump($roleTypes); 
							//if(!empty( $roleTypes )){ ?>
							<select name="roletype[]" class="roletype" disabled>
							<option value="">Type</option>
							<?php /*foreach( $roleTypes as $typ ){ ?>
							<option value="<?=$typ["id"];?>_<?=$typ["code"];?>"><?=ucfirst($typ["code"]);?> </option>
							<?php } */?>
							</select>
							<?php //} ?>	
							
							</td></tr>
							<tr class="list-group-item-danger"><td> 
							<?php if(!empty( $categories )){ ?>
							<select name="category[]" class="category" disabled>
							<option value="">Category</option>
							<?php foreach( $categories as $cat ){ ?>
							<option value="<?=$cat["id"];?>_<?=$cat["code"];?>"><?=ucfirst(trim($cat["code"]));?> </option>
							<?php } ?>
							</select>
							<?php } ?>	
							</td></tr>
							<tr><td> 
							
							<table style="width:285px;">
							<tr>
								<td>
								
							<select name="gs_grade" class="gs_grade" style="display:none" id="gs_grade">
							
							<option value="">Grade</option>
							<?php foreach($grades as $g ){ ?>
								<option value="<?=$g["id"];?>"><?=$g["dname"];?></option>
							<?php } ?>
							</select>
							
							</td>
							
								<td>
								<select name="gs_subject" class="gs_subject" style="display:none" id="gs_subject">
								<option value="">Subject</option>
							<?php foreach($subjects as $g ){ ?>
								<option value="<?=$g["id"];?>"><?=$g["dname"];?></option>
							<?php } ?>
							</select>
								</td>
							</tr>
							</table>
							
							<!--div class="locationSerial" style="float: left;text-align: right;width: 57%;" -->
							<div class="locationSerial">
							Location Serial 
							</div>
							
							<div class="locSlContinue" style="display:none;">
							<div class="positionIDLabel">Position ID </div>	
							<a href="#" class="lsclink">Continue..</a>
							</div>
							
							</td></tr>
							</table>

							</td>
							</tr>	
							</table>
							
					  </td><!-- // first table second td -->
                       <td>
					   
						<table style="width: 100%; opacity:0.5;" class="positionIDT">
						
							<tr> 
								<td>
									<table class="table table-bordered tableClick" style="text-align:center;" id="label_2">
									<tr><td> 
									<div class="positionIDLabel2">
										Position ID
									</div>	
									</td></tr>
									<tr class="list-group-item-danger"><td> <input type="text" name="tagline[]" class="tagline" disabled /> </td></tr>
									<tr class="list-group-item-danger"><td> <input type="text" name="bottomline[]" class="bottomline" disabled /> </td></tr>
								</table>
								</td>
							 </tr>	
							</tbody>
						 </table>
							
					  </td><!-- // first table third td -->
                      <td style="width:480px;">
						<table style="width: 100%;" class="table-bordered tableThree">
							<tr style="text-align:center;">
							 <td> 
									<table class="table table-bordered link_1" style="opacity:0.5;">
										<tr>
										
											<td style="color:#82b964;"> 
											
										<select name="rpRoleCode[]" style="width:100%;" class="rpRoleCode">
										<option value="0">Role Code</option>
										<?php /*foreach($positions AS $pos ){?>
											<option value="<?=$pos["postionID"];?>"><?=$pos["roleCode"];?></option>
										<?php } */ ?>
										</select>

											</td>
											<td> <div class="pRSName"> Staff Name </div> </td>
										</tr>
										<tr class="list-group-item-danger"><td colspan="2">
										
										<select name="positionID[]" style="width:100%;" class="positionID">
										<option value="0">Code</option>
										<?php /*foreach($positions AS $pos ){?>
											<option value="<?=$pos["postionID"];?>"><?=$pos["positionTitle"];?></option>
										<?php } */?>
										</select>
										
										</td></tr>
										<tr><td colspan="2">
											<div class="posTitleTB">
											Position Title
											</div>
										</td></tr>
									</table>
							 </td>
							 <td>
							 	<table class="table table-bordered link_2" style="opacity:0.5;">
										<tr>
											<td style="color:#82b964;">
											<select name="rpRoleCode[]" style="width:100%;" class="rpRoleCode2">
										<option value="0">Role Code</option>
										<?php /*foreach($positions AS $pos ){?>
											<option value="<?=$pos["postionID"];?>"><?=$pos["roleCode"];?></option>
										<?php } */ ?>
										</select>
											</td>
											
											<td> <div class="pRSName2"> Staff Name </div> </td>
											
										</tr>
										<tr class="list-group-item-danger"><td colspan="2">
										<select name="positionID2[]" class="positionID2" style="width:100%;">
										<option value="0">Code</option>
										</select>
										
										</td></tr>
										<tr><td colspan="2">
										<div class="posTitleTB2">
											Position Title
											</div>
										</td></tr>
									</table>
							 </td>
							</tr>	
						</table>
							
					  </td><!-- // first table fourth td -->
					</tr>
                </table>
              <?php } ?>
			  
			</div>
		</div>
	</div>
</div>


