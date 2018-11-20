
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

	// Grade Selection For Selecting the Batch

	$(document).on('change','#grade_select',function(){

		var $grade_id;
		$grade_id = $('#grade_select option:selected').val();
		window.open('<?php echo site_url(); ?>/gs_admission/admission_form_print_ajax/batch_garde_summary?GradeID='+$grade_id+'&OptionID=1','_blank');
		window.open('<?php echo site_url(); ?>/gs_admission/admission_form_print_ajax/batch_garde_summary?GradeID='+$grade_id+'&OptionID=2','_blank');
		$.ajax({
			type:"POST",
			cache:false,
			data:{grade_id:$grade_id},
			url:"<?php echo site_url() ?>/gs_admission/admission_batch_view/get_batch_available",
			success:function(e){
				var a='';
				var formated_batch;
				var batch_id;
				var JsonData = JSON.parse(e);
				a += '<option value="" disabled="" selected="">Select Batch</option>'
				for(var i=0;i<JsonData.length;i++){
					formated_batch =  JsonData[i].batch_category.replace('-', '');
					a +='<option value ='+formated_batch+'>'+formated_batch+'</option>';
				}
				$('#batch_category').html(a);

			}
		});
		
	});

	// Batch Selection For getting the _form_batch_slots

	$(document).on('change','#batch_category',function(){
		var batch_category = $(this).val();
		var $grade_id;
		$grade_id = $('#grade_select option:selected').val();
		window.open('<?php echo site_url(); ?>/gs_admission/admission_form_print_ajax/batch_details?BatchID='+batch_category,'_blank');
		window.open('<?php echo site_url(); ?>/gs_admission/admission_form_print_ajax/discussion_sheet?BatchID='+batch_category,'_blank');
		if($grade_id <= 2){
			window.open('<?php echo site_url(); ?>/gs_admission/admission_form_print_ajax/assessment_sheet?BatchID='+batch_category,'_blank');
		}
		
		$.ajax({
			type:"POST",
			cache:false,
			data:{batch_category:batch_category},
			url:"<?php echo site_url(); ?>/gs_admission/admission_batch_view/get_batch_detail",
			success:function(e){
				$('#AdmissionFormListing').html(e);
			}
		});
	});
</script>