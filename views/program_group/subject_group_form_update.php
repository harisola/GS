<div class='inner-spacer' style="text-align: left">

 <div class="callout callout-info" id='success' style="display: none;">
    <p>Data Update Successfully</p>
 </div>
    <div class='callout callout-danger' id='errors' style="display: none;"></div>
 <form action="" class="form-horizontal orb-form" role='form' method='post' id ='subject-grade-update' >
	<header>Edit Group Registration Form</header>
    <input type='hidden' value="<?php echo $edit_data[0]->id; ?>" name='group_id' />

	<fieldset>
		<section>
			<label class='label'>Group Name</label>
			<label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
            <input type="text" placeholder="Enter Group Name" name='group_name' id = 'group-name' value="<?php echo $edit_data[0]->name ?>" />
            <b class="tooltip tooltip-bottom-right">Enter the Group Name</b></label>
		</section>
		</fieldset>
	<fieldset>
		<section>
			<label class='label'>Display Name</label>
			<label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
            <input type="text" placeholder="Enter Display Group Name" name='group_dname'  id = 'group-dname' value="<?php echo $edit_data[0]->dname; ?>" />
            <b class="tooltip tooltip-bottom-right">Enter the Display Group Name</b></label>
		</section>
	</fieldset>
	<fieldset>
		<section>
			<label class='label'>Short Name</label>
			<label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
            <input type="text" placeholder="Enter Short Group Name" name='group_sname'  id = 'group-sname' value="<?php echo $edit_data[0]->sname; ?>" />
            <b class="tooltip tooltip-bottom-right">Enter the Short Group Name</b></label>
		</section>
	</fieldset>
	<fieldset>
		<section>
			<label class='label'>Code</label>
			<label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
            <input type="text" placeholder="Enter Code Group Name" name='group_cname'  id = 'group-cname' value="<?php echo $edit_data[0]->code; ?>" />
            <b class="tooltip tooltip-bottom-right">Enter the Code Group Name</b></label>
		</section>
	</fieldset>
	<fieldset>
		<section>
			<label class='label'>Position</label>
			<label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
            <input type="text" placeholder="Enter Group Position" name='group_pname'  id = 'group-pname' value="<?php echo $edit_data[0]->position; ?>" />
            <b class="tooltip tooltip-bottom-right">Enter Group Position</b></label>
		</section>
	</fieldset>
      <footer>
        <button type="submit" class="btn btn-orb-org " id='update-edit' style="float: left;">Update</button>
        <button type="reset" class="btn btn-orb-org" style='float:right'>Reset</button>
     </footer>
 </form>


</div>

<script type="text/javascript">


    if($('#subject-grade-update').length){
    $('#subject-grade-update').validate({

        rules:{
            group_name :{
               required: true,
               rangelength: [1, 9] 
            },
            group_dname :{
                required: true,
                rangelength: [1, 9]
            },
            group_sname :{
                required: true,
                rangelength: [1, 9]
            },
            group_cname:{
            	required: true,
                rangelength: [1, 3]
            },
            group_pname:{
            	required: true
            }

        },

        submitHandler: function (form)
        {
          $(form).ajaxSubmit({
            type:"POST",
            url: "<?php echo base_url(); ?>index.php/program_group/subject_group_ajax/get_update",
            cache: false,
            datatype: "html",
            success: function (data)
            {
              	if (data != 1)
              	{
              		$('#errors').css('display','');
              		$('#errors').html(data);
              		$('#errors').fadeOut(10000);
              	}
              	else if (data == 1)
              	{	

              		$.ajax({
              			type:"POST",
              			url:"<?php echo base_url(); ?>index.php/program_group/subject_group_ajax/table_create",
              			cache:false,
              			datatype:'html',
              			success:function(e){
              				$('#table').html(e);
              				$('#success').css('display','');
              				$('#success').fadeOut(10000);
              			}
              		});
              		

              	}
            },
			error:function (error){

           		console.log(error);	
            }

          });
        }
		

        });
  
	}


</script>