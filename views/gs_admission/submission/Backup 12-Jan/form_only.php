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
                              	for($i = 0; $i < count($numbers); $i++){ ?>
									<input value="<?=$numbers[$i];?>" name="student_mobile[]" type="text" class="col-md-10" placeholder="Mobile" id="student_mobile" > <br>

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
		<input type="text" class="" <?=$readOnly;?> placeholder="Father Mobile <?=$mendotryf;?>" name="father_mobile" id="father_mobile" value="<?php if (!empty($data_id["Father_mobile"])) {
			$data_id["Father_mobile"] = substr($data_id["Father_mobile"], 1);
			$data_id["Father_mobile"] = str_replace("-", "", $data_id["Father_mobile"]);
			echo "+92".$data_id["Father_mobile"];
	}?>" /><br /><br />
		<?php if (!empty($data_id["Father_mobile_other"]) ) { 
			$data_id["Father_mobile_other"] = explode(',',$data_id["Father_mobile_other"] );
			for($i=0; $i< count($data_id["Father_mobile_other"]); $i++){  ?>
					<input type="text" class="" <?=$readOnly;?> placeholder="Father Mobile <?=$mendotryf;?>" name="father_mobile_other[]" id="father_mobile_other" value="<?='+'. str_replace('-', '', $data_id["Father_mobile_other"][$i] );?>" /><br /><br />
		<?php	}
		?>


		<?php } ?>

		<input type="text" class="" <?=$readOnly;?> placeholder="Father NIC <?=$mendotryf;?>" name="father_nic" id="father_nic" value="<?=$data_id["Father_nic"];?>" /><br /><br />
		<input type="text" class="" placeholder="Father Email" name="father_email" id="father_email" value="<?=$data_id["Father_email"];?>" />

	</div><!-- col-md-6 -->
<div class="col-md-6">
	
	<input type="text" class="" <?=$readOnly2;?> placeholder="Mother Name <?=$mendotrym;?>" name="mother_name" id="mother_name" value="<?=$data_id["Mother_name"];?>" /><br /><br />
	<input type="text" class="" <?=$readOnly2;?>  placeholder="Mother Mobile <?=$mendotrym;?>" name="mother_mobile" id="mother_mobile" value="<?php if (!empty($data_id["Mother_mobile"])) {
			$data_id["Mother_mobile"] = substr($data_id["Mother_mobile"], 1);
			$data_id["Mother_mobile"] = str_replace("-", "", $data_id["Mother_mobile"]);
			echo "+92".$data_id["Mother_mobile"];
	}?>" /><br /><br />
	<?php if (!empty($data_id["Mother_mobile_other"]) ) { 
		$data_id["Mother_mobile_other"] = explode(',',$data_id["Mother_mobile_other"] );
		for($i=0; $i< count($data_id["Mother_mobile_other"]); $i++){  ?>
				<input type="text" class="" <?=$readOnly;?> placeholder="Mother Mobile <?=$mendotryf;?>" name="Mother_mobile_other[]" id="mother_mobile_other" value="<?='+'. str_replace('-', '', $data_id["Mother_mobile_other"][$i] );?>" /><br /><br />
	<?php	}
	?>


	<?php } ?>	
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
                                        <input type="checkbox" id="APCOSR" name="alevelCheckList[]" value="APCOSR" style="display:block;visibility:hidden;"> <label for="APCOSR">Attested Photo copy of school result (IX, X and XI)</label>
                                    </div>
                                    <!-- col-md-12 -->
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" id="ACMER" name="alevelCheckList[]" value="ACMER" style="display:block;visibility:hidden;"> <label for="ACMER">Attested copy mock exam result/first term result</label>
                                    </div>
                                    <!-- col-md-12 -->
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" id="PRFSSE" name="alevelCheckList[]" value="PRFSSE" style="display:block;visibility:hidden;"> <label for="PRFSSE">Principal recommendation form in school sealed envelope</label>
                                    </div>
                                    <!-- col-md-12 -->    
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" value="ACCIE"  id="ACCIE" name="alevelCheckList[]" style="display:block;visibility:hidden;"> <label for="ACCIE">Attested copy of CIE Olevel results and certificates</label>
                                    </div>
                                    <!-- col-md-12 -->    
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" value="ACFFR" id="ACFFR" name="alevelCheckList[]" style="display:block;visibility:hidden;"> <label for="ACFFR">Attested copies of full and final result</label>
                                    </div>
                                    <!-- col-md-12 -->
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" value="CCFPS" id="CCFPS" name="alevelCheckList[]" style="display:block;visibility:hidden;"> <label for="CCFPS">Clearance certificate from previous school</label>
                                    </div>
                                    <!-- col-md-12 -->
                                    <div class="col-md-12 paddingBottom0">
                                        <input type="checkbox" value="PCCCA"  id="PCCCA" name="alevelCheckList[]" style="display:block;visibility:hidden;"> <label for="PCCCA">Photocopies of certificate of cross curricular activities</label>
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

