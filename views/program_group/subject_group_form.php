
<div class='inner-spacer' style="text-align: left">
	 
    <div class="callout callout-info" id='success' style="display: none;">
        <p>Data Inserted Successfully</p>
    </div>
    <div class='callout callout-danger' id = 'errors' style="display: none"></div>
	<form action="" class="form-horizontal orb-form" role='form' method='post' id ='subject-grade-form' >
		<header>Group Registration Form</header>
        
		<fieldset>
			<section>
				<label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
                <input type="text" placeholder="Enter Group Name" name='group_name' id = 'group-name'/>
                <b class="tooltip tooltip-bottom-right">Enter the Group Name</b></label>
			</section>
			</fieldset>
		<fieldset>
			<section>
				<label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
                <input type="text" placeholder="Enter Display Group Name" name='group_dname'  id = 'group-dname'/>
                <b class="tooltip tooltip-bottom-right">Enter the Display Group Name</b></label>
			</section>
		</fieldset>
		<fieldset>
			<section>
				<label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
                <input type="text" placeholder="Enter Short Group Name" name='group_sname'  id = 'group-sname'/>
                <b class="tooltip tooltip-bottom-right">Enter the Short Group Name</b></label>
			</section>
		</fieldset>
		<fieldset>
			<section>
				<label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
                <input type="text" placeholder="Enter Code Group Name" name='group_cname'  id = 'group-cname'/>
                <b class="tooltip tooltip-bottom-right">Enter the Code Group Name</b></label>
			</section>
		</fieldset>
		<fieldset>
			<section>
				<label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
                <input type="text" placeholder="Enter Group Position" name='group_pname'  id = 'group-pname'/>
                <b class="tooltip tooltip-bottom-right">Enter Group Position</b></label>
			</section>
		</fieldset>
          <footer>
            <button type="submit" class="btn btn-orb-org " id='send' style="float: left;">Insert</button>
            <button type="reset" class="btn btn-orb-org" style='float:right'>Reset</button>
         </footer>
         

	</form>


</div>
<!-- <div class ='col-md-12'>
    <div id = 'errors'></div>
</div> -->
<style type="text/css">

	  /* individual elements: webkit */
#group-name::-webkit-input-placeholder { color:#555555; }
#group-dname::-webkit-input-placeholder { color:#555555; }
#group-sname::-webkit-input-placeholder { color:#555555; }
#group-cname::-webkit-input-placeholder { color:#555555; }
#group-pname::-webkit-input-placeholder { color:#555555; }



	/* individual elements: mozilla */
#group-name::-moz-placeholder { color:#555555; }
#group-dname::-moz-placeholder { color:#555555; }
#group-sname::-moz-placeholder { color:#555555; }
#group-cname::-moz-placeholder { color:#555555; }
#group-pname::-moz-placeholder { color:#555555; }


</style>


<script type="text/javascript">

if ($('#subject-grade-form').length) {
    $("#subject-grade-form").validate({
        // Rules for form validation
        rules: {
            group_name: {
                required: true,
                rangelength:[1,9]
            },
            group_dname: {
                required: true,
                rangelength:[1,9]
            },
            group_sname:{
            	required:true,
            	rangelength:[1,9]
            },
            group_cname:{
            	required:true,
            	rangelength:[1,3]
            },
            group_pname:{
            	required:true
            }
        },

        // Messages for form validation
        messages: {
            group_name: {
                required: 'Please Enter the Group Name'
            },
            group_dname: {
                required: 'Please Enter the Display Name'
            },
            group_sname:{
            	required:'Please Enter the Short Name'
            },
            group_cname:{
            	required:"Please Enter the Code"
            },
            group_pname:{
            	required:"Please Enter Position of the Grade"
            }


        },
        	//Ajax For Data Inserted
        submitHandler: function (form) 
		{
			$(form).ajaxSubmit({
       			type: "POST",
        		url: "<?php echo base_url(); ?>index.php/program_group/subject_group_ajax/create",
        		cache:false,
        		data:$('#subject-grade-form').serialize(),
        		datatype:"html",
        		success: function (data)
        		{
        			if(data == 1)
                    {
                        $.ajax({
                            type:"POST",
                            url:"<?php echo base_url(); ?>index.php/program_group/subject_group_ajax/table_create",
                            cache:false,
                            datatype:"html",
                            success:function(e)
                            {
                               $('#table').html(e);
                               $('#success').css('display','');
                               $('#success').fadeOut(10000);
                               $('#group-name').val('');
                               $('#group-dname').val('');
                               $('#group-sname').val('');
                               $('#group-cname').val('');
                               $('#group-pname').val('');

                            }

                        });
                    }   
                    else
                    {   
                        $('#errors').css('display','');
                        $('#errors').html(data);
                        $('#errors').fadeOut(10000);    
                    }
                    

        		}
   		 	});
		}

      
    });

}
    //Numeric Keys OFF

$('#group-pname').keydown(function(e){
  if($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||(e.keyCode >= 48 && e.keyCode <=57) || (e.keyCode >= 96 && e.keyCode <= 105)){
      return true;
  }
  else{
    return false;
  }
});
</script>