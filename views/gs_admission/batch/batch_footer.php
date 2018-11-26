<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
	$(document).on('click','.batch_category_detail',function(){
		var batch_caegory = $(this).attr('data-id');
		var slots = $('#slots').text();
		var batch_caegory_formatted = batch_caegory.replace('-','');
		$.ajax({
			type:"POST",
			cache:false,
			data:{batch_caegory:batch_caegory_formatted,no_of_slots:slots},
			url:"<?php echo base_url(); ?>index.php/gs_admission/admission_batch_setup/get_batch_detail",
			success:function(e){
				$('.get').html(e);
			}
		});
		 
	});

	$('#grade').on('change',function(){
		var grade_id = $(this).val();
		$.ajax({
			type:"POST",
			cache:false,
			data:{grade_id:grade_id},
			url:"<?php echo base_url(); ?>index.php/gs_admission/admission_batch_setup/insert_batch_detail",
			success:function(e){
					var JsonData = JSON.parse(e);
					var a;
					for(var i=0;i<JsonData.length;i++){
						a = JsonData[i].batch_name;
					}

					$('#batch_name').val(a);
					$('#batch_name_hidden').val(a);

			}
		})
	});

$(document).ready(function(){


if ($('#batchDetail').length) {
            $('#batchDetail').validate({

                // Rules for form validation
                rules: {
                     no_of_slots: {
                        required: true
                    },
                     date1:{
                     	required: true
                     },
                     start_time:{
                     	required:true
                     },
                     end_time:{
                     	required:true
                     },
                     duration_per_slot:{
                     	required:true
                     },
                     grade:{
                     	required:true
                     }


                },

                // Messages for form validation
                messages: {
                    no_of_slots: {
                        required: 'Please Enter the No of Slots'
                    },
                    date1:{
                    	required:'Please Enter the Date'
                    },
                    start_time:{
                    	required:'Please Enter the Start Time'
                    },
                    end_time:{
                    	required:'Please Enter the End Time'
                    },
                    duration_per_slot:{
                    	required:'Please Enter the Duration per Slots'
                    },
                    grade:{
                    	required:"Please Select Grade"
                    }
  
                   
                },

                // Continue Form HEre

                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: "POST",
                        url:"<?php echo base_url(); ?>index.php/gs_admission/admission_batch_setup/form_batch_insert",
                        success: function (data) {
                            var $grade,$batch_id,$date,$start_time,$end_time,$no_of_slots,$duration_per_slot,$grade_name;
                            $grade =  $('#grade').val();
                            $grade_name = $('#grade :selected').text();
                            $batch_id = $('#batch_name_hidden').val();
                            $date = $('#date').val();
                            $start_time = $('#start_time').val();
                            $end_time = $('#end_time').val();
                            $no_of_slots = $('#no_of_slots').val();
                            $no_of_slots = '0 '+'/ '+$no_of_slots;
                            $duration_per_slot = $('#duration_per_slot').val();
                            $duration_per_slot = $duration_per_slot + ' '+'min';
                            var $html='';
                            $html += '<tr>';
                            $html += '<td class="text-center">'+$grade_name+'</td>';
                            $html += '<td><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="batch_category_detail" data-id="'+$batch_id+'">'+$batch_id+'</a></td>';
                            $html += '<td>'+$date+'</td>';
                            $html += '<td class="text-center">'+$start_time+':00'+'</td>';
                            $html += '<td class="text-center">'+$end_time+':00'+'</td>';
                            $html += '<td class="text-center">'+$no_of_slots+'</td>';
                            $html += '<td class="text-center">'+$duration_per_slot+'</td>';
                            $html += '</tr>';
                            $($html).prependTo('#AdmissionFormListing tbody');
                            $('#grade').val('');
							$('#batch_name').val('');
							$('#batch_name_hidden').val('');
							$('#date').val('');
							$('#start_time').val('');
							$('#end_time').val('');
							// $('#no_of_slots').val('');
							// $('#duration_per_slot').val('');
                        }
                    });
                }


       
            });
        }

				 
    });

    $(document).on('click','#batch_slot_button',function(){
        $('#BatchListingList > tbody  > tr').each(function() {
            var SlotID = $(this).find("input.batch_slot_id").val();
            var SlotTime = $(this).find("input.batch_slot_time").val();
            $.ajax({
            type:"POST",
            cache:false,
            data:{slot_id:SlotID, slot_time:SlotTime},
            url:"<?php echo base_url(); ?>index.php/gs_admission/admission_batch_setup/update_batch_detail",
                success:function(e){
                }
            })
        });
    });

    $('#date').on('click',function(e){

        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var maxDate = year + '-' + month + '-' + day;
        $('#date').attr('min', maxDate);
    });

    $('#date').on('focusout',function(e){
        var date = $(this).val();
        var today_date = getCurrentDate();
        if(Date.parse(date) < Date.parse(today_date)){
            $('#date').val('');
        }
    });

    // Get Current Date
    function getCurrentDate(){
        var d = new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var output = d.getFullYear() + '/' +
        (month<10 ? '0' : '') + month + '/' +
        (day<10 ? '0' : '') + day;
        return output;
    }
	
</script>

