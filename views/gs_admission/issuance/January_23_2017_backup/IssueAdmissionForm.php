<div class="container" id="IssueAdmissionForm">
    <!-- Two column layout Start -->
	<div class="row">
	<div id="form_data">
	
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

<input type="hidden" name="family_exists" id="family_exists" value="5043" />


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
                    <hr />
                    <div class="col-md-12 paddingBottom20">
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
					
									
							  
                    <div class="col-md-12 paddingBottom20">
                        <div class="col-md-6">
                            <input type="text" class="" placeholder="Official Name *" name="official_name" id="official_name" />
                        </div><!-- col-md-6 -->
                        <div class="col-md-6">
                            <input type="text" placeholder="Call Name *" name="call_name" id="call_name" />
                        </div><!-- col-md-6 -->
                    </div><!-- col-md-12 -->
                    <div class="col-md-12 paddingBottom0">
                        <div class="col-md-6">
                            <!--input placeholder="Date of Birth *"  class="textbox-n" type="text" onfocus="(this.type='date')"  id="date_of_birth" onblur="(this.type='text')" name="date_of_birth" / -->
							
						<input placeholder="Date of Birth *"  type="text"  id="date_of_birth" name="date_of_birth" class="date_of_birth" />
							
                        </div><!-- col-md-6 -->
						
						
                     <div class="col-md-6">
                        	<input type="text" placeholder="Admission Grade *" name="admission_grade" id="admission_grade" readonly />
							<input type="hidden" name="admission_grade_id" id="admission_grade_id" value="" />
                        </div><!-- col-md-6 -->
						
						
						
						
                    </div><!-- col-md-12 -->
                      <hr />
                    <div class="col-md-12 paddingBottom10">
                    	<div class="col-md-6" style="margin-top:-18px;">
                    		<input type="checkbox" id="c2" name="single_parent" style="display:block; visibility:hidden;"> <label for="c2">Single Parent</label>
                        </div><!-- col-md-6 -->
						
						
						 <div class="col-md-6 text-right">
                        	<!--a href="#" data-toggle="modal" data-target="#myModal" id="show_fif">Show FIF</a -->
							<a href="javascript:void(0)" id="show_fif" style="display:none;">Show FIF</a>
                        </div><!-- col-md-6 -->
                    </div><!-- col-md-12 -->
					<hr style="margin-top:0px;" />
                    <div class="col-md-12 paddingBottom20">
                    	<div class="col-md-6">
							<input class="paddingBottom10" type="radio" name="primary_contact" value="0" checked id="primary_contact1"> <label for="primary_contact1">Primary Contact Father</label><br /><br />
                        	<input type="text" class="" placeholder="Father Name *" name="father_name" id="father_name" /><br /><br />
                            
                            <input type="text" class="" placeholder="Father Mobile *" name="father_mobile" id="father_mobile" /><br /><br />
                            <input type="text" class="" placeholder="Father NIC *" name="father_nic" id="father_nic" /><br /><br />
                            <input type="text" class="" placeholder="Father Email" name="father_email" id="father_email" />
                        </div><!-- col-md-6 -->
                        <div class="col-md-6">
							<input class="paddingBottom10" type="radio" name="primary_contact" value="1" id="primary_contact2"> <label for="primary_contact2">Primary Contact Mother</label><br /><br />
                        	<input type="text" class="" placeholder="Mother Name" name="mother_name" id="mother_name" /><br /><Br />
                            <input type="text" class="" placeholder="Mother Mobile" name="mother_mobile" id="mother_mobile" /><br /><br />
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
                    	<div class="col-md-6">
						
                    		<input type="checkbox" required="required" id="ps" name="photo_submitted" style="visibility:hidden;display:block;"> <label for="ps"> Photos Submitted <span class="required">*</span></label>
							
                        </div><!-- col-md-6 -->
                    </div><!-- col-md-12 -->
                    <div class="col-md-12 paddingBottom0">
                    	<div class="col-md-6">
                    		<input type="checkbox" id="bco" name="birth_certificate_o" style="visibility:hidden;display:block;"> <label for="bco">Birth Certificate (O)</label>
                        </div><!-- col-md-6 -->
                    </div><!-- col-md-12 -->
                    <div class="col-md-12 paddingBottom0">
                    	<div class="col-md-6">
                    		<input type="checkbox" id="bcc" name="birth_certificate_c" style="visibility:hidden;display:block;"> <label for="bcc">Birth Certificate (C)</label>
                        </div><!-- col-md-6 -->
                    </div><!-- col-md-12 -->
                    <hr />
                    <div class="col-md-12">
                    	<input type="submit" name="submit" class="greenBTN" id="greenBTN" value="Print & Issue" />
						
								
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
		</style>		


					
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
                              <th width="" class="text-center no-sort">Status</th>
                              <th width="" class="text-center">GF-ID</th>
                              <th width="" class="no-sort">Action</th>
                          </tr>
                      </thead>
                      <tbody> 
					  <?php	if( !empty( $formlist ) ){
							foreach( $formlist AS $fl ){ ?>
							<tr>
						  <td class="text-center"><?php echo str_pad( $fl["Form_no"],3,"0",STR_PAD_LEFT); ?></td>
						  <td><?=$fl["Applicate_name"];?></td>
						  <td><?=$fl["Father_name"];?> - <strong> <?=$fl["Father_mobile"];?> </strong></td>
						  <td class="text-center">
						   <?php //$fl["form_status_id"];?>
						  <img src="<?php echo base_url()?>components/gs_theme/images/allocationIcon_active.png" title="Allocation" width="25" data-toggle="tooltip" data-placement="top" /> &nbsp; <img src="<?php echo base_url()?>components/gs_theme/images/communicationIcon_active.png" title="Communication" width="23" data-toggle="tooltip" data-placement="top" /></td>
						  
						 
						  <td class="text-center"><p><?php 
						  //echo join('-', str_split( $fl["Gf_id"], 2));
						  //echo implode('-', str_split($fl["Gf_id"], 2));
						  $value = $fl["gfid"];
						  
						  if( (int)substr($value, 0, 2) == 17 ){
							  
						  }else{
							echo $value = substr($value, 0, 2).''.substr($value, 2);  
						  }
						  ?></p></td>
						  <td class="actionArea">
							<a href="javascript:void(0)" class="hoverAction">Action <i class="fa fa-angle-down" aria-hidden="true"></i></a>
							<div class="actionItems">
								<ul>
									<li><a href="<?php echo base_url();?>index.php/gs_admission/ajax_base/print_admission_form?FormNo=<?php echo $fl['Form_id'];?>" target="_blank">Print Form</a></li>
									<li><a href="#" class="view_n_Edit" data-id="<?=$fl["Form_id"];?>">View and Edit Details</a></li>
								</ul><!-- actionIteamsUL-->
							</div><!-- actionItems -->
						  </td>
                          </tr>
						  <?php }
						} 	?>
					
					</tbody> 
                  </table><!-- StaffListing -->
                </div><!-- inner -->
            </div><!-- MaroonBorderBox -->
        
		
		</div><!-- MaroonBorderBox2 -->
		</div><!-- col-md-8 -->
    </div><!-- row -->
    <!-- Two column layout END -->
</div><!-- container -->



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
                	
					