<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script>


<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>
<!-- <script src="<?=base_url();?>components/gs_theme/js/custom.js"></script> -->


</body>
</html>


<script type="text/javascript">
	$('#grade').change(function(){
		var grade_id = $(this).val();
		$('#Generations_AjaxLoader').show();
		$.ajax({
			type:"POST",
			cache:false,
			data:{grade_id:grade_id},
			url:"<?php echo base_url() ?>index.php/gs_admission/admission_offer_approve_ajax/get_offer_detail",
			success:function(e){
				$('#Generations_AjaxLoader').hide();
				$('.offer_table').html(e);
			}

		})
	});

	// Add Detail like Admission

	$(document).on('click','#AddDetail',function(){
		var form_id = $(this).attr('data-formid');
		var gf_id = $(this).attr('data-gf_id');
		// alert(gf_id);	
		//alert(form_id);
		$.ajax({
			method:"POST",
			cache:false,
			data:{form_id:form_id,gf_id:gf_id},
			url:"<?php echo base_url() ?>index.php/gs_admission/admission_offer_approve_ajax/add_detail",
			success:function(e){
				// console.log(e);
				$('#AddDetails').modal('show');
				$('.add_detail').html(e);
			}
		});
	});


	// =================OFFER PREPERATION ===============//

	$(document).on('click','#preperation',function(){
		var form_id = $(this).attr('data-formid');
		$.ajax({
			method:"POST",
			cache:false,
			data:{form_id:form_id},
			url:"<?php echo base_url() ?>index.php/gs_admission/admission_offer_approve_ajax/add_preperation",
			success:function(e){
				$('#OfferPreparation').modal('show');
				$('.offer-preperation').html(e);
			}
		});
	});


	//==========================OFFER SUBMISSION ===============================//
	//==========================================================================//


	$(document).on('click','#offer_submission',function(){
		var form_id = $(this).attr('data-formid');
		$.ajax({
			method:"POST",
			cache:false,
			data:{form_id:form_id},
			url:"<?php echo base_url() ?>index.php/gs_admission/admission_offer_approve_ajax/offer_submission",
			success:function(e){
				$('#OfferSubmission').modal('show');
				$('.offer_submission').html(e);
			}
		});
	});


	// SELECT SUB REGION

	$(document).on('change','#region',function(){
		var region_id = $('#region :selected').attr('data-id');
		$.ajax({
			type:"POST",
			cache:false,
			data:{region_id:region_id},
			url:"<?php echo base_url() ?>index.php/gs_admission/admission_offer_approve_ajax/get_sub_region",
			success:function(e){
				var jsonData = JSON.parse(e);
				var a='';
				for(var i = 0 ; i < jsonData.length ; i++){
					a +='<option value = "'+jsonData[i].name+'">'+jsonData[i].name+'</option>'; 
				}

				$('.sub_region').html(a);

			}
		});
	});


	//=================================Preperation Submit =================================//

	$(document).on('click','#preperation_submit',function(){
		var offer_letter_status =  $('.offer_letter').prop('checked');
		var fif_form_status = $('.fif_form').prop('checked');
		var photo_taken_status = $('.photo_taken').prop('checked');
		var handbook_status = $('.handbook').prop('checked');
		var printed_fee_bill_status = $('.printed_fee_bill').prop('checked');
		var form_id = $('.offer_letter').attr('data-formid');
		$('.prep-alert').css('display','none');

		//==================== OFFER LETTER STATUS ======================//
		//===============================================================//
		if(offer_letter_status == true){
			offer_letter_status = 1;
		}
		else{
			offer_letter_status = 0;
		}

		//==================FIF FORM STATUS ========================//
		//==========================================================//

		if(fif_form_status == true){
			fif_form_status = 1;
		}
		else{
			fif_form_status = 0;
		}

		// ========================= PHOTO TAKEN STATUS =================//
		//===============================================================//

		if(photo_taken_status == true){
			photo_taken_status = 1;
		}
		else{
			photo_taken_status = 0;
		}

		//================================Hand Book Status ===============//
		//================================================================//

		if(handbook_status == true){
			handbook_status = 1;
		}else{
			handbook_status = 0;
		}

		//=================================Printed Fee Bill ===============//
		//================================================================//

		if(printed_fee_bill_status == true){
			printed_fee_bill_status = 1;
		}
		else{
			printed_fee_bill_status = 0;
		}


		if(offer_letter_status == 1 && fif_form_status == 1 && photo_taken_status == 1 && handbook_status == 1 && printed_fee_bill_status == 1){

		$('#Generations_AjaxLoader').show();
		$.ajax({
			type:"POST",
			cache:false,
			data:{form_id:form_id,offer_letter_status:offer_letter_status,fif_form_status:fif_form_status,photo_taken_status:photo_taken_status,handbook_status:handbook_status,printed_fee_bill_status:printed_fee_bill_status},
			url:"<?php echo base_url(); ?>index.php/gs_admission/admission_offer_approve_ajax/insert_update_preperation",
			success:function(e){

				// GET FORM DETAIL
				
				$.ajax({
					type:"POST",
					cache:false,
					data:{form_id:form_id},
					url:"<?php echo base_url() ?>index.php/gs_admission/admission_offer_approve_ajax/get_detail_of_form",
					success:function(f){

						var jsonData = JSON.parse(f);
						var offer_letter;
						var fif_form;
						var photo_taken;
						var handbook;
						var printedFeeBill;
						for(var i = 0 ; i < jsonData.length; i++){
							
							offer_letter = jsonData[i].is_printed_offer_letter;
							fif_form = jsonData[i].is_printed_fif;
							photo_taken = jsonData[i].is_printed_photo_token;
							handbook = jsonData[i].is_handbook;
							printedFeeBill = jsonData[i].is_printed_fee_bill;


							//offer Letter Ajax Response
							if(offer_letter == 0){
								$('.liActions #offer_'+form_id).removeClass('tick');
								$('.liActions #offer_'+form_id).addClass('cross');
							}else{
								$('.liActions #offer_'+form_id).removeClass('cross');
								$('.liActions #offer_'+form_id).addClass('tick');
							}

							//Fif Form Ajax Response

							if(fif_form == 0){
								$('.liActions #fif_'+form_id).removeClass('tick');
								$('.liActions #fif_'+form_id).addClass('cross');

							}else{
								$('.liActions #fif_'+form_id).removeClass('cross');
								$('.liActions #fif_'+form_id).addClass('tick');
							}

							// Photos From Ajax Response

							if(photo_taken == 0){
								$('.liActions #photo_'+form_id).removeClass('tick');
								$('.liActions #photo_'+form_id).addClass('cross');

							}else{
								$('.liActions #photo_'+form_id).removeClass('cross');
								$('.liActions #photo_'+form_id).addClass('tick');								
							}

							// HandBook Ajax Response

							if(handbook == 0){
								$('.liActions #handbook_'+form_id).removeClass('tick');
								$('.liActions #handbook_'+form_id).addClass('cross');
							}
							else{
								$('.liActions #handbook_'+form_id).removeClass('cross');
								$('.liActions #handbook_'+form_id).addClass('tick');	
							}



							// Printed Fee Bill
							if(printedFeeBill == 0){
								$('.liActions #printed_fee_'+form_id).removeClass('tick');
								$('.liActions #printed_fee_'+form_id).addClass('cross');
							}
							else{
								$('.liActions #printed_fee_'+form_id).removeClass('cross');
								$('.liActions #printed_fee_'+form_id).addClass('tick');	
							}

							

							$('.offer-submission-hide').show();
							$('#OfferPreparation').modal('hide');
							$('#Generations_AjaxLoader').hide();

						}
					}
				});
			}
		});

		}else{
			$('.prep-alert').css('display','');
		}
		 	
	});
 
 	$(document).on('click','#btn-submission',function(){
 		var signed_offer =  $('.signed_offer').prop('checked');
 		var signed_fif = $('.signed_fif').prop('checked');
 		var signed_handbook = $('.signed_handbook').prop('checked');
 		var offer_pack_handover = $('.offer_pack_handover').prop('checked');
 		var form_id = $('.signed_offer').attr('data-formid');
 	
 		var check_signed_offer = 0;
 		var check_offer_pack_handover = 0 

 		// SIGNED OFFER
 		if(signed_offer == true){
 			signed_offer = 1;
 			check_signed_offer = 1;
 		}
 		else{
 			signed_offer = 0;
 			check_signed_offer = 0;
 		}

 		// SIGNED FIF
 		if(signed_fif == true){
 			signed_fif = 1;
 		}
 		else{
 			signed_fif = 0;
 		}

 		// Signed Handbook
 		if(signed_handbook == true){
 			signed_handbook = 1;
 		}
 		else{
 			signed_handbook = 0;
 		}

 		// Offer Pack Handover
 		if(offer_pack_handover == true){
 			offer_pack_handover = 1;
 			check_offer_pack_handover = 1;
 		
 		}
 		else{
 			offer_pack_handover = 0;
 			check_offer_pack_handover = 0;
 			
 		}
 		if(check_signed_offer == 1 && check_offer_pack_handover == 1){
 			$('.alert-box').hide();
	 		$('#Generations_AjaxLoader').show();
	 		$.ajax({
	 			type:"POST",
	 			cache:false,
	 			data:{form_id:form_id,signed_offer:signed_offer,signed_fif:signed_fif,signed_handbook:signed_handbook,offer_pack_handover:offer_pack_handover},
	 			url:"<?php echo base_url() ?>index.php/gs_admission/admission_offer_approve_ajax/insert_update_submission",
	 			success:function(e){
	 				$('#btn-submission').hide();
	 				$.ajax({
	 					type:"POST",
	 					cache:false,
	 					data:{form_id:form_id},
	 					url:"<?php echo base_url() ?>index.php/gs_admission/admission_offer_approve_ajax/get_detail_of_form",
	 					success:function(f){
	 						var jsonData = JSON.parse(f);
	 						var is_signed_offer_letter;
	 						var is_complete_fif_form;
	 						var is_signed_hand_book;
	 						var is_fee_bill_handover;

	 						for(var i = 0 ; i < jsonData.length ;i++){
	 							is_signed_offer_letter = jsonData[i].is_signed_offer_letter;
	 							is_complete_fif_form = jsonData[i].is_complete_fif_form;
	 							is_signed_hand_book = jsonData[i].is_signed_hand_book;
	 							is_fee_bill_handover = jsonData[i].is_fee_bill_handover;

	 							// Signed offer Letter Ajax Response
								if(is_signed_offer_letter == 0){
									$('.liActions #signed_offer_'+form_id).removeClass('tick');
									$('.liActions #signed_offer_'+form_id).addClass('cross');
								}else{
									$('.liActions #signed_offer_'+form_id).removeClass('cross');
									$('.liActions #signed_offer_'+form_id).addClass('tick');
								}

								//Compelete Fif Form Ajax Response
								
								if(is_complete_fif_form == 0){

									$('.liActions #complete_fif_'+form_id).removeClass('tick');
									$('.liActions #complete_fif_'+form_id).addClass('cross');

								}else{
									$('.liActions #complete_fif_'+form_id).removeClass('cross');
									$('.liActions #complete_fif_'+form_id).addClass('tick');
								}

								// Signed Hand Book From Ajax Response

								if(is_signed_hand_book == 0){
									$('.liActions #signed_handbook_'+form_id).removeClass('tick');
									$('.liActions #signed_handbook_'+form_id).addClass('cross');

								}else{
									$('.liActions #signed_handbook_'+form_id).removeClass('cross');
									$('.liActions #signed_handbook_'+form_id).addClass('tick');								
								}

								// Printed Ajax Response

								if(offer_pack_handover == 0){
									$('.liActions #is_offer_pack_handover_'+form_id).removeClass('tick');
									$('.liActions #is_offer_pack_handover_'+form_id).addClass('cross');
								}
								else{
									$('.liActions #is_offer_pack_handover_'+form_id).removeClass('cross');
									$('.liActions #is_offer_pack_handover_'+form_id).addClass('tick');	
								}

								$('#OfferSubmission').modal('hide');
								$('#Generations_AjaxLoader').hide();
	 						}
	 					}
	 				});
	 			}
	 		});
 		}else{
 			$('.alert-box').show();
 		}

 	});

 	//==================== PRINT OFFER LETTER =======================//

 	$(document).on('click','#print_offer',function(){
 		var form_id = $('#print_offer').attr('data-formid');
 		call_pdf_offerLetterForm(form_id);
 		$(".offer_letter").attr('checked', true);


 	});

 	//============================ FIF FORM LETTER ==================// 


 	$(document).on('click','#print_fif',function(){

 		var form_id = $('#print_fif').attr('data-formid');
 		$(".fif_form").attr('checked', true);
 		call_pdf_FIF(form_id);

 	});







 	function call_pdf_offerLetterForm(FormID){
		var url = "<?php echo base_url(); ?>index.php/gs_admission/offer_letter/show?FormNo="+FormID;
		var win = window.open(url, '_blank');
		if(win){
		    //Browser has allowed it to be opened
		    win.focus();
		}else{
		    //Broswer has blocked it
		    alert('Please allow popups for this site');
		}
	}





	function call_pdf_feeBill(FormID){
		var url = "<?php echo base_url(); ?>index.php/gs_admission/admission_fee_bill/fb?FormID="+FormID;
		var win = window.open(url, '_blank');
		if(win){
		    //Browser has allowed it to be opened
		    win.focus();
		}else{
		    //Broswer has blocked it
		    alert('Please allow popups for this site');
		}
	}


	function call_pdf_FIF(FormID){
		var url = "<?php echo base_url(); ?>index.php/gs_admission/admission_offer_approve/printForm?FormID="+FormID;
		var win = window.open(url, '_blank');
		if(win){
		    //Browser has allowed it to be opened
		    win.focus();
		}else{
		    //Broswer has blocked it
		    alert('Please allow popups for this site');
		}
	}

	$(document).on('click','#checkbox1',function(){
		    $('#checkbox1').change(function(){
        if(this.checked){
            $('.autoUpdate').fadeIn('slow');
        	$('#region').hide();
        	$('.sub_region').hide();
        	$('#region').val('');
        	$('#sub_region').val('');
        }
        else{
            $('.autoUpdate').fadeOut('slow');
            $('#region').show();
        	$('#sub_region').show();
        }

    });
	});

	$(document).on("change", "#previous_school", function(){
	  var prs = $(this).val();
	  
	  if( prs == '52000' ){
	    $('#otherSchools').show(); 
	    $( "#addHere" ).addClass("paddingTop20");
	  }else{
	    $('#otherSchools').hide(); 
	    $('#other_school').val('');
	    $( "#addHere" ).removeClass("paddingTop20");
	  }

	});

</script>
