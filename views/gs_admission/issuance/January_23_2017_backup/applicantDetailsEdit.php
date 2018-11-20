<div class="MaroonBorderBox">
<form action="<?=base_url();?>index.php/gs_admission/ajax_base/get_data" method="POST" name="issuance" id="issuance" class="issuance">
<input type="hidden" name="FormAction" id="FormAction" value="1" />

<input type="hidden" name="Form_ID" id="Form_ID" value="<?=$data_id["Form_id"];?>" />
<input type="hidden" name="Fmly_Reg_ID" id="Fmly_Reg_ID" value="<?=$data_id["Family_reg_id"];?>" />
<input type="hidden" name="academic_session" id="academic_session" value="<?=$data_id["Academic"];?>" />

<input type="hidden" name="family_exists" id="family_exists" value="<?=$data_id["Gf_id"];?>" />

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


<?php //var_dump( $data_id ); ?>

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
</div><!-- col-md-12 -->
<hr />

<div class="col-md-12 paddingBottom20">
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
<div class="col-md-12 paddingBottom20">
<div class="col-md-6">
<input type="text" class="" placeholder="Official Name *" name="official_name" id="official_name" value="<?=$data_id["Applicate_name"];?>" />
</div><!-- col-md-6 -->
<div class="col-md-6">
<input type="text" placeholder="Call Name *" name="call_name" id="call_name" value="<?=$data_id["Call_name"];?>" />
</div><!-- col-md-6 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom0">
<div class="col-md-6">
<!--input placeholder="Date of Birth *"  class="textbox-n" type="text" onfocus="(this.type='date')"  id="date_of_birth" onblur="(this.type='text')" name="date_of_birth" / -->

<input placeholder="Date of Birth *"  type="text"  id="date_of_birth" name="date_of_birth" class="date_of_birth" value="<?=$data_id["Dob"];?>" />

</div><!-- col-md-6 -->
  <div class="col-md-6">
	<input type="text" placeholder="Admission Grade *" name="admission_grade" id="admission_grade" value="<?=$data_id["Grade_name"];?>" readonly />
	<input type="hidden" name="admission_grade_id" id="admission_grade_id" value="<?=$data_id["Grade_id"];?>" />
</div><!-- col-md-6 -->
</div><!-- col-md-12 -->
<hr />
<div class="col-md-12 paddingBottom10">
<div class="col-md-6" style="margin-top:-18px;">

<?php if($data_id["single_parent"] == 1){ ?>
<input type="checkbox" id="c2" name="single_parent" checked style="display:block;visibility:hidden;"> 
<?php }else{ ?>
<input type="checkbox" id="c2" name="single_parent" style="display:block;visibility:hidden; "> 
<?php } ?> 
<label for="c2">Single Parent</label>
</div><!-- col-md-6 -->

<?php if( $data_id["Gf_id"] != '' ){ ?>
 <div class="col-md-6 text-right">
	<a href="javascript:void(0)" id="show_fif">Show FIF</a>
</div><!-- col-md-6 -->
<?php }else{ ?>
<div class="col-md-6 text-right">
	<a href="javascript:void(0)" id="show_fif" style="display:none;">Show FIF</a>
</div><!-- col-md-6 -->
<?php } ?>
						
</div><!-- col-md-12 -->
<hr style="margin-top:0px;" />
<div class="col-md-12 paddingBottom20">
	<div class="col-md-6">
	<input type="radio" name="primary_contact" id="primary_contact1" value="0" <?php if($data_id["Primary_contact"] == 0){ echo "checked"; }?> > <label for="primary_contact1">Primary Contact Father</label><br /><br />
		<input type="text" class="" placeholder="Father Name *" name="father_name" id="father_name" value="<?=$data_id["Father_name"];?>" /><br /><br />
		<input type="text" class="" placeholder="Father Mobile *" name="father_mobile" id="father_mobile" value="<?=$data_id["Father_mobile"];?>" /><br /><br />
		<input type="text" class="" placeholder="Father NIC *" name="father_nic" id="father_nic" value="<?=$data_id["Father_nic"];?>" /><br /><br />
		<input type="text" class="" placeholder="Father Email" name="father_email" id="father_email" value="<?=$data_id["Father_email"];?>" />
	</div><!-- col-md-6 -->
	<div class="col-md-6">
	<input type="radio" name="primary_contact" id="primary_contact2" value="1" <?php if($data_id["Primary_contact"] == 1){ echo "checked"; }?>> <label for="primary_contact2">Primary Contact Mother</label><br /><br />
	
		<input type="text" class="" placeholder="Mother Name" name="mother_name" id="mother_name" value="<?=$data_id["Mother_name"];?>" /><br /><Br />
		<input type="text" class="" placeholder="Mother Mobile" name="mother_mobile" id="mother_mobile" value="<?=$data_id["Mother_mobile"];?>" /><br /><br />
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
<div class="col-md-6">
<input type="checkbox" id="ps" name="photo_submitted" <?php if( $data_id["Photo_submitted"] == 1){ echo "checked"; }?> style="display:block;visibility:hidden;"> <label for="ps">Photos Submitted <span class="required">*</span></label>
</div><!-- col-md-6 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom0">
<div class="col-md-6">
<input type="checkbox" id="bco" name="birth_certificate_o" <?php if( $data_id["Birth_o"] == 1){ echo "checked"; }?> style="display:block;visibility:hidden;"> <label for="bco">Birth Certificate (O)</label>
</div><!-- col-md-6 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom0">
<div class="col-md-6">
<input type="checkbox" id="bcc" name="birth_certificate_c" <?php if( $data_id["Birth_c"] == 1){ echo "checked"; }?> style="display:block;visibility:hidden;"> <label for="bcc">Birth Certificate (C)</label>
</div><!-- col-md-6 -->
</div><!-- col-md-12 -->
<hr />
<div class="col-md-12">

<div class="col-md-6">
<input type="submit" name="submit" class="greenBTN" id="greenBTN" value="Print & Update" />
</div>
<div class="col-md-6">
<input type="button" name="clear" class="grayBTN" id="greenBTN2" value="Clear" />
</div>

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



</div><!-- inner -->
</form>
</div><!-- .MaroonBorderBox -->
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

