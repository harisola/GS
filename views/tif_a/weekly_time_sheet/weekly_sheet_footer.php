<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->

<!-- <script src="/application/views/tif_a/weekly_time_sheet/js/multiSelect.js"></script> -->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script>
<script src="/application/views/tif_a/weekly_time_sheet/js/multiSelect.js"></script>

<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>
<!-- <script src="<?=base_url();?>components/gs_theme/js/custom.js"></script> -->
<script src="<?= base_url(); ?>components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href='<?php echo base_url() ?>components/bootstrap-multiselect/css/bootstrap-multiselect.css'/>






</body>
</html>

<script type="text/javascript">
	$(document).ready(function(e){

		$('#WeeklyTimesheet').DataTable();

		$('#profile-select').multiselect({numberDisplayed: 1 
		});
		$('#department-select').multiselect({numberDisplayed: 1 
		});
		/**
		Description: Ajax Request for Update in Weekly Time Sheet
		**/
		$(document).on('change','#time-in,#time-out',function(e){
			var time_flag = e.target.id;
			var time = $(this).val();
			var updated_id = $(this).attr('data-updated-id');
			
			$.ajax({
				type:"POST",
				data:{
					time:time,
					updated_id:updated_id,
					time_flag:time_flag
				},
				cache:false,
				url:"<?php echo base_url() ?>index.php/tif_a/weekly_sheet_ajax/get_update",
				beforeSend:function(){
					
				},
				success:function(e){
					console.log(e);
				}
			});
		});

	});

  /***** BEGIN - Apply filter searching *****/
    $('#apply_filter').click(function() {

        var profiles = $('#profile-select option:selected');
        var departments = $('#department-select option:selected');
        var selectedProfiles = [];
        var selectedDepartments = [];
        
        $(profiles).each(function(index, profile) {
            selectedProfiles.push([$(this).val()]);
        });

        $(departments).each(function(index, department) {
            selectedDepartments.push([$(this).val()]);
        });

        var profileRegex = selectedProfiles.join("|");
        var departmentRegex = selectedDepartments.join("|");
        var table = jQuery("#WeeklyTimesheet").dataTable();

        table.fnFilter(profileRegex, 0, true, false);
        table.fnFilter(departmentRegex, 1, true, false);

    });  


</script>