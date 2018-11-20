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
			</div><!-- FormNoShow -->
		</div><!-- col-md-12 -->
		<hr />
		<div class="col-md-12 paddingBottom20">
		  <div class="col-md-6">
						<select name="previous_school" id="previous_school">
                              <option value="">Previous School</option>
							<?php 
								if( !empty( $school_lists )){ 
									foreach( $school_lists as $sl ){ ?>
									 <option value="<?=$sl["School_id"];?>"><?=$sl["School_name"];?></option>
								<?php }
								} ?>
								<option value="52000">Other</option>
							 </select>
							 
                            <!--input type="text" class="" placeholder="Previous School *" name="previous_school" id="previous_school" / -->
							 
                        </div><!-- col-md-6 -->
						
						<div class="col-md-6" id="otherSchools" style="display:none;">
							<input type="text"  placeholder="School Name" name="other_school" id="other_school"  />
						</div><!-- col-md-6 -->
                        <div id="addHere" class="col-md-6">
						
						  <select name="previous_grade" id="previous_grade">
                              <option value="">Previous Grade</option>
							<?php 
								if( !empty( $grade_lists )){ 
									foreach( $grade_lists as $gl ){ ?>
									 <option value="<?=$gl["Grade_id"];?>"><?=$gl["Grade_name"];?></option>
								<?php }
							 } ?>
							 </select>
                            <!--input type="text" placeholder="Previous Grade *" name="previous_grade" id="previous_grade" / -->
							 
                        </div><!-- col-md-6 -->
			
		</div><!-- col-md-12 -->
		<div class="col-md-12 paddingBottom20">
			<div class="col-md-6">
			   <input type="text" class="" placeholder="Official Name *" name="official_name" id="official_name" />
			</div><!-- col-md-6 -->
			<div class="col-md-6">
				 <input type="text" placeholder="Call Name" name="call_name" id="call_name" />
			</div><!-- col-md-6 -->
		</div><!-- col-md-12 -->
		<div class="col-md-12 paddingBottom20">
			<div class="col-md-6">
				<input placeholder="Date of Birth *" type="text" name="date_of_birth" id="date_of_birth">
			</div><!-- col-md-6 -->
		   
			<div class="col-md-6">
			   <input type="text" placeholder="Admission Grade *" name="admission_grade" id="admission_grade" />
				<input type="hidden" name="admission_grade_id" id="admission_grade_id" value="" />
			</div><!-- col-md-6 -->
		   
		</div><!-- col-md-12 -->
		<div class="col-md-12 paddingBottom20">
		   
			
			 <div class="col-md-6">
			   <select name="gender" id="gender">
			  <option value="" disabled selected>Gender *</option>
			  <option value="B">Boy</option>
			  <option value="G">Girl</option>
			</select>
			</div><!-- col-md-6 -->
			<div class="col-md-6">
			</div><!-- col-md-6 -->
		</div><!-- col-md-12 -->
		<hr />
		<div class="col-md-12 paddingBottom20">
			<div class="col-md-6">
				<input type="text" class="" placeholder="Father Name *" name="father_name" id="father_name" /><br /><br />
				<input type="text" class="" placeholder="Father Mobile *" name="father_mobile" id="father_mobile" /><br /><br />
				<input type="text" class="" placeholder="Father NIC *" name="father_nic" id="father_nic" /><br /><br />
				<input type="text" class="" placeholder="Father Email" name="father_email" id="father_email" />
				
				
			</div><!-- col-md-6 -->
			<div class="col-md-6">
				<input type="text" class="" placeholder="Mother Name *" required="" name="mother_name" id="mother_name" /><br /><Br />
				<input type="text" class="" placeholder="Mother Mobile *" required="" name="mother_mobile" id="mother_mobile" /><br /><br />
				<input type="text" class="" placeholder="Mother NIC *" required="" name="mother_nic" id="mother_nic" /><br /><br />
				<input type="text" class="" placeholder="Mother Email" name="mother_email" id="mother_email" />
				
			</div><!-- col-md-6 -->
		</div>
	 
		<hr />
		<div class="col-md-12">
			<div class="col-md-12">
				<textarea placeholder="Comments" rows="4" cols="50" name="comments" id="comments"></textarea>
			</div><!-- col-md-12 -->
		</div><!-- col-md-12 -->
		
		<hr />
		<div class="col-md-12">
			<div class="col-md-12 paddingBottom0">
				<input type="checkbox" id="ps" name="ps" style="display:block;visibility:hidden;"> <label for="ps">Photos Submitted *</label>
			</div><!-- col-md-12 -->
			<div class="col-md-12 paddingBottom0">
				<input type="checkbox" id="bco" name="bco" style="display:block;visibility:hidden;"> <label for="bco">Birth Certificate (O) *</label>
			</div><!-- col-md-12 -->
			<div class="col-md-12 paddingBottom0">
				<input type="checkbox" id="bcc" name="bcc" style="display:block;visibility:hidden;"> <label for="bcc">Birth Certificate (C) *</label>
			</div><!-- col-md-12 -->    
		</div><!-- .col-md-12 -->
		<hr />
	 
		
		 <div class="col-md-12">
			<div class="alert alert-danger col-md-6" style="display:none;" id="error_message">
				<strong> Application Form! </strong> Under Process. 
			</div>
			<div class="col-md-6" id="submitButton">
				<input type="submit" name="greenBTN" id="greenBTN" class="greenBTN" value="Print & Issue" />
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


});	
</script>
