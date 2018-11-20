<div class="inner-spacer" role="content">
<div class="callout callout-info" style="display: none;"> Data Inserted Successfully </div>
  <form action="" id="order-form" class="orb-form" novalidate="novalidate" method="POST">
    <header>Academic Session Form</header>  
      <fieldset>
      <section>
       <label class="label"><b>Select Academic</b></label>
        <label class="select">
          <select name="assessment_session_id" id='assessment_session_id'>
            <option value="0" selected="" disabled="">Academic Session</option>
            <?php if(!empty($academic1)) { ?>
              <?php foreach($academic1 as $val1) {?>
              <option value="<?php echo $val1->id; ?>"><?php echo $val1->name; ?></option>
              <?php } ?>
            <?php } ?>

          </select>
          <i></i> </label>
      </section>
      <section>
       <label class="label"><b>Select Term</b></label>
        <label class="select">
          <select name="assessment_term_id" id='assessment_term_id'>
            <option value="0" selected="" disabled="">Term Name</option>
            <?php if(!empty($query1))
            { ?>
                <?php foreach ($query1 as $val) { ?>
                  <option value="<?php echo $val->id; ?>"><?php echo $val->dname; ?></option>
                <?php }  ?>
            <?php } ?>


          </select>

          <i></i> </label>
      </section>
      </fieldset>
    <fieldset>
     <section>
        <label class="input"> <i class="icon-append fa fa-calendar"></i>
          <input type="text" class='date_from' name="date_from" id="start" placeholder="Date From"/>
          <b class="tooltip tooltip-bottom-right">Needed to enter the Date From</b>
        </label>
       
      </section>
      <section>
        <label class="input"> <i class="icon-append fa fa-calendar"></i>
          <input type="text" class='date_to' name="date_to" id="finish" placeholder="Date To"/>
          <b class="tooltip tooltip-bottom-right">Needed to enter the Date to</b>
        </label>
      </section>
      </fieldset>
      <fieldset>
        <label class="toggle">
          <input type="checkbox" name="is_active" id="box" checked value="1">
          <i></i>Active
        </label>
      </fieldset>            
    <footer>
      <button type="submit" class="btn btn-orb-org">Submit</button>
      <button type="reset" class="btn btn-orb-org" style="float: right;">Reset </button>
    </footer>
  </form>
</div>

<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script> 

<script type="text/javascript">
  if($('#order-form').length){
    $('#order-form').validate({
      rules:{
        assessment_session_id:{
          required: true
        },
        assessment_term_id:{
          required: true
        },
        date_from:{
          required: true
        },
        date_to:{
         required: true 
        }
      },

      //Message Validation

      messages:{
        assessment_session_id:{
          required : 'Please select your Session Name'
        },
        assessment_term_id:{
          required:'Please select the Term Name'
        },
        date_from:{
          required:'Please Enter the date_from'
        },
        date_to:{
          required:'Please Enter the date_to'
        }
      },

      submitHandler:function(form)
      {
        $(form).ajaxSubmit({
          type:"POST",
          url:"<?php echo base_url() ?>index.php/term/getpost/create_academic",
          cache:false,
          data:$('#order-form').serialize(),
          datatype:"html",
          success: function(data)
          {
            if(data == 0)
            {
                alert('Validation not complete');
            }
            else
            {
              $.ajax({
                  type:"POST",
                  url:"<?php echo base_url() ?>index.php/term/getpost/getacademic",
                  datatype: "html",
                  success:function(response)
                  {
                      $('.callout').css('display','');
                      $('.callout').fadeOut(5000);
                      $('#tableUpdate').html(response);
                      $('#assessment_session_id').val(0);
                      $("#assessment_term_id").val(0);
                      $('.date_from').val('');
                      $('.date_to').val('');

                     
                  }
              });
            }
          }
        });
      }

    });
  }


if ($('#start').length) {
            $('#start').datepicker({
                dateFormat: 'yy-mm-dd',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#finish').datepicker('option', 'minDate', selectedDate);
                }
            });
        }
if ($('#finish').length) {
            $('#finish').datepicker({
                dateFormat: 'yy-mm-dd',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#start').datepicker('option', 'maxDate', selectedDate);
                }
            });
        }
</script>