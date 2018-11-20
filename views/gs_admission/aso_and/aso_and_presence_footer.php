<link rel="stylesheet" href="<?=base_url();?>components/gs_theme/css/jquery-ui.css">
<script src="<?=base_url();?>components/gs_theme/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script>


<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/custom.js"></script>


</body>
</html>

<script type="text/javascript">

	// =========== Getting Grade ID ================//
	//==============================================//
	$(document).on('change','#grade',function(e){
		var grade_id = $(this).val();
		var grade_name = $('#grade :selected').text();
		if(grade_id == 15 || grade_id == 16){
			$('#batch').css('display','none');
			$('#batch_name').text('');
			$('#batch_count').text('');
			a_level_dio(grade_id);
		}else{
		// Grade Selection Like PN,N,KG
		$('#batch').css('display','');
		grade_name = grade_name.trim();
		$('#selected_grade').html(grade_name);

		$.ajax({
			type:"POST",
			cache:false,
			data:{grade_id:grade_id},
			url:"<?php echo base_url(); ?>index.php/gs_admission/admission_aso_and_process_presence/get_batch",
			success:function(e){
				var a='';
				if(e == 'No batch Created'){
					a='<option value="" disabled selected>No Batch Created</option>';
					$('#batch').html(a);
				}else{
				var jsonData = JSON.parse(e);
				var batch_category = '';
				var date = '';
				var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
				// var months = ['January','Febmark_present_asomark_present_asuary','March','April','May','June','July','August','September','October','November','December'];
				a = '<option value="" disabled selected >Select Batch*</option>';
				for(var i=0;i<jsonData.length;i++){
					date = jsonData[i].date;
					var d = new Date(date);
					day = d.getDay();
					batch_category = jsonData[i].batch_category.replace('-','')+'('+days[day]+','+date+')';
					a +='<option value='+jsonData[i].id+'>'+batch_category+'</option>';
				}

				$('#batch').html(a);

			}

			}
		});


		// Form in a certain grade

		$.ajax({
			type:"POST",
			cache:false,
			data:{grade_id:grade_id},
			url:"<?php echo base_url(); ?>index.php/gs_admission/admission_aso_and_process_presence/count_form_in_grade",
			success:function(e){

				var grade_count = JSON.parse(e);
				grade_count = '('+grade_count[0].grade_count+')';
				$('#grade_count').html(grade_count);

			}
		});


		// Get All Applicant

		}

	});

	// For A-Level
	function a_level_dio(grade_id){
		$('#Generations_AjaxLoader').show();
		$.ajax({
			type:"POST",
			cache:false,
			data:{grade_id:grade_id},
			url:"<?php echo base_url(); ?>index.php/gs_admission/admission_aso_and_process_presence/get_A_level",
			success:function(e){
				$('#Generations_AjaxLoader').hide();
				$('#aso_and_data').html(e);

			}
		})
	}


	// ===================== ON Batch Changed ==================//
	//==========================================================//

	$(document).on('change','#batch',function(){
		$('#Generations_AjaxLoader').show();
		var batch_id = $(this).val();
		var batch_name = $('#batch :selected').text();
		batch_name = batch_name.substring(0,3);
		var grade = $('#grade :selected').val();
		$('#batch_name').html(batch_name);

		// Form in a certain batch 
		$.ajax({
			type:"POST",
			cache:false,
			data:{batch_id:batch_id,grade_id:grade},
			url:"<?php echo base_url(); ?>index.php/gs_admission/admission_aso_and_process_presence/get_batch_form_submitted",
			success:function(e){
				var countBatch = JSON.parse(e);
				countBatch = '('+countBatch[0].batch_count+')';
				$('#batch_count').html(countBatch);
			}
		});

		// Get Detail Table OF ASO , AND

		$.ajax({
			type:"POST",
			cache:false,
			data:{batch_id:batch_id},
			url:"<?php echo base_url(); ?>index.php/gs_admission/admission_aso_and_process_presence/get_detail_aso_and",
			success:function(e){
				 $('#aso_and_data').html(e);
				 $('#Generations_AjaxLoader').hide();
				// $('#AdmissionFormListing').append(e);
			}
		})

		

	});

	//===============================Marks As Present========================//
	//=======================================================================//


	// ===================== AND CASE ==================//

	$(document).on('click','#mark_present',function(){
		$('#Generations_AjaxLoader').show();
		var form_no = $(this).attr('data-presesnt');
		$.ajax({
			type:"POST",
			cache:false,
			data:{form_no:form_no},
			url:"<?php echo base_url(); ?>index.php/gs_admission/admission_aso_and_process_presence/get_and_present",
			success:function(e){

				if(e == 1){


					// ASO CASE PRESENCE
					//$('#img_presence_discussion'+form_no).prop('src','<?php echo base_url() ?>components/gs_theme/images/PresenceIcon_active.png');
					//$('#img_presence_assessment'+form_no).prop('src','<?php echo base_url() ?>components/gs_theme/images/PresenceIcon_active.png');

					// AND CASE PRESENCE
					$('#img_presence_and_'+form_no).prop('src','<?php echo base_url() ?>components/gs_theme/images/PresenceIcon_active.png');
					//$('#mark_present_'+form_no).hide();

					$.ajax({
						type:"POST",
						cache:false,
						data:{form_no:form_no},
						url:"<?php echo base_url(); ?>index.php/gs_admission/admission_aso_and_process_presence/get_and_present_detail",
						success:function(data){
							var jsonData = JSON.parse(data);
							var ast_done_on;
							var dis_done_on;
							for(var i = 0; i < jsonData.length ; i++){
								ast_done_on = jsonData[i].ast_done_on;
								dis_done_on = jsonData[i].dis_done_on;
							}
							$('#ast_done_on_'+form_no).text(ast_done_on);
							$('#dis_done_on_'+form_no).text(dis_done_on);
							$('#Generations_AjaxLoader').hide();
						}		
					});
				}

			}
		});
		
	});

	//========================= ASO Case  ====================//

	$(document).on('click','#mark_present_aso',function(){

		var form_no = $(this).attr('data-presesnt');

		$.ajax({
			type:"POST",
			cache:false,
			data:{form_no:form_no},
			url:"<?php echo base_url(); ?>index.php/gs_admission/admission_aso_and_process_presence/present_aso",
			success:function(e){

				if (e == 3){

					$('#img_presence_assessment'+form_no).prop('src','<?php echo base_url() ?>components/gs_theme/images/PresenceIcon_active.png');

					$.ajax({
						type:"POST",
						cache:false,
						data:{form_no:form_no},
						url:"<?php echo base_url(); ?>index.php/gs_admission/admission_aso_and_process_presence/get_and_present_detail",
						success:function(data){

							var jsonData = JSON.parse(data);
							var ast_aso_done_on;

							for(var i = 0 ;i < jsonData.length ; i++){
								ast_aso_done_on = jsonData[i].ast_done_on;
								$('#ast_aso_done_on_'+form_no).text(ast_aso_done_on);
							}

							
						}
					});

				}
				else if (e == 4){

					$('#img_presence_discussion'+form_no).prop('src','<?php echo base_url() ?>components/gs_theme/images/PresenceIcon_active.png');

					$.ajax({
						type:"POST",
						cache:false,
						data:{form_no:form_no},
						url:"<?php echo base_url(); ?>index.php/gs_admission/admission_aso_and_process_presence/get_and_present_detail",
						success:function(data){

							var jsonData = JSON.parse(data);
							var dis_aso_done_on;

							for(var i = 0 ;i < jsonData.length ; i++){
								dis_aso_done_on = jsonData[i].dis_done_on;
								$('#dis_aso_done_on_'+form_no).text(dis_aso_done_on);
							}

							
						}
					});

				}

			}

		})


	});

	//===========================View And Edit Button Pressed =====================//
	//============================================================================//

	$(document).on('click','#view_and_edit',function(){
		var form_id = $(this).attr('data-form');
		var grade_id = $('#grade :selected').val();
		var batch_id = $('#batch :selected').val();
		var batch_case = $('#batch_case').val();
		$.ajax({
			type:"POST",
			cache:false,
			data:{grade_id:grade_id,form_id:form_id,batch_case:batch_case},
			url:"<?php echo base_url() ?>index.php/gs_admission/admission_aso_and_process_presence/get_view_and_edit_modal",
			success:function(e){
				$('.assessment_discussion').html(e);
			}
		});
	});



	//======================================= MARK Presence IN ASO =====================//
	//=================================================================================//

	// 
	//=================== Jquery of `Result Decision` for show and hide Input Box =========//
	//===================================================================================//

	$(document).on('change','#decision_status',function(){
		var astd = $(this).val();
		//alert(astd);
		if(astd == 'WIL'){
			$('.IfWIL').removeClass("displayNone");
			$('.IfWIL').css('display','');
			$('#cfd').css('display','none');
			$('#cft').css('display','none');
			$('#assessment_result_date').val('');
			$('#assessment_result_time').val('');
		}
		else if(astd == 'CFD'){
			//alert('CFD');
			$('#cfd').css('display','');
			$('#cft').css('display','');
			$('.IfWIL').css('display','none');
			$('#resultWaited').val('');
		}
		else if(astd == 'RGT'){
			$('.IfWIL').css('display','none');
			$('#cfd').css('display','none');
			$('#cft').css('display','none');
			$('#assessment_result_date').val('');
			$('#assessment_result_time').val('');
			$('#resultWaited').val('');
		}
		else if(astd == 'OHD'){
			$('.IfWIL').css('display','none');
			$('#cfd').css('display','none');
			$('#cft').css('display','none');
			$('#assessment_result_date').val('');
			$('#assessment_result_time').val('');
			$('#resultWaited').val('');
		}


	});

	//=== JQUERY OF `Discussion Decision` for show and hide Input Box===========//
	//==========================================================================//

	$(document).on('change','#DECD',function(){
		var dd = $(this).val();
		if(dd == 'WIL'){
			
			$('.ddIfWILD').css('display','');
			$('#ddIfOFR_date').css('display','none');
			//$('#ddIfOFR_time').css('display','none');
			$('#offer_date').val('');
			//$('#offer_time').val('');
		}
		else if(dd == 'OFR'){
			$('#ddIfOFR_date').css('display','');
			//$('#ddIfOFR_time').css('display','');
			$('.ddIfWILD').css('display','none');
			$('#weightage_wil').val('');
		}
		else if(dd == 'OHD'){
			$('.ddIfWILD').css('display','none');
			$('#ddIfOFR_date').css('display','none');
			//$('#ddIfOFR_time').css('display','none');
			$('#offer_date').val('');
			//$('#offer_time').val('');
			$('#weightage_wil').val('');
		}
		else if(dd == 'RGT'){
			$('.ddIfWILD').css('display','none');
			$('#ddIfOFR_date').css('display','none');
			//$('#ddIfOFR_time').css('display','none');
			$('#offer_date').val('');
			//$('#offer_time').val('');
			$('#weightage_wil').val('');
		}
	});

// ======================== FINAL STATUS UPDATED =========================//
//========================================================================// 


$(document).on('click','#selectAll',function() {
    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
});

	$(document).on('click','#status_update',function(){
		var form_id = [];
	    var status = $('#status option:selected').val();
		// alert(status);
		var ids;
        $('input:checked').each(function () { 
        	ids = this.id;
        	if(ids != 'selectAll'){

        		form_id.push(ids);

        	}
        	
        });

       

        $.ajax({


        	type:"POST",
        	cache:false,
        	//dataType:'json',
        	data:{form_id:form_id,status:status},
        	url:"<?php echo base_url(); ?>index.php/gs_admission/admission_aso_and_process_presence/update_action",
        	success:function(f){
        		//var obj = jQuery.parseJSON(f);
        		var days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
        		var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        		var offerdate;
        		var day;
        		var date;
        		var month;
        		var day_number;
        		var obj = JSON.parse(f);
        		for(var i=0; i<obj.length; i++){
        			console.log(obj[i][0].id);

        			// Offer Approve
        			if(obj[i][0].form_status_id == 5){
        				offerdate  = obj[i][0].offer_date;
        				if(offerdate != '0000-00-00'){
        					date = obj[i][0].offer_date;
							var d = new Date(date);
					    	month =  d.getMonth();
							day = d.getDay();
							day_number = d.getDate();
							$('#offer_'+obj[i][0].id).text('Offer '+days[day]+' '+day_number+' '+months[month]);	
        				}
        				else{
        					$('#offer_'+obj[i][0].id).text('Offer ');
        				}
        				
        				
        			}

        			// Regert
        			if(obj[i][0].form_status_stage_id == 15){
        				$('#offer_'+obj[i][0].id).text('Regret');
        			}

        			// On Hold
        			if(obj[i][0].form_status_stage_id == 16){
        				$('#offer_'+obj[i][0].id).text('On Hold');
        			}

        			// WaitList
        			if(obj[i][0].form_status_stage_id == 17){
        				$('#offer_'+obj[i][0].id).text('Wait List');
        			}
        		}

        		


        		$('#status').val('');
        		$('.checkedStatus').prop('checked', false);
        	}

        });
	});

//==================== BatchFilter ============================//
//=============================================================//

 $(document).on('click','#BatchFilter',function(){
 	var grade_id = $('#grade').val();
 	var grade_name = $("#grade :selected").text();
 });	
	

 // ============================ Applicant Status ========================//
 // ======================================================================//

 	$(document).on('click','#applicant_status',function(){
 		var applicant_status = $('#filter_val :selected').val();
 		var grade_id = $('#grade :selected').val();
 		$.ajax({
 			type:"POST",
 			cache:false,
 			data:{applicant_status:applicant_status,grade_id:grade_id},
 			url:"<?php echo base_url(); ?>index.php/gs_admission/admission_aso_and_process_presence/filter_applicant",
 			success:function(e){

 				$('.grade_aso_and').html(e);
 				
 				

 			}
 		});
 	});
</script>