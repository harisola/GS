<div class="inner-spacer" role="content">
    <div class="callout callout-info" style="display: none;"> Data Updated Successfully </div>
        <form action="" id="order-form" class="orb-form" novalidate="novalidate" method="POST">
          <header>
          Edit Academic Session Form
          <button type='button' class='btn btn-primary link-button' style="float:right">Add Academic</button> 
          </header>

            <fieldset>
            <section>
            <input type="hidden" name='id' value="<?php echo $query[0]->id?>" >
             <label class="label"><b>Select Academic</b></label>
              <label class="select">
                <select name="assessment_session_id" id='assessment_session_id'>
                  <option value="<?php echo $value[0]->academic_session_id ?>"><?php echo $query[0]->name; ?></option>
                  <?php if(!empty($academic1)) { ?>
                    <?php foreach($academic1 as $val1) {?>
                      <?php if($value[0]->academic_session_id == $val1->id ) {?>
                      <?php } else {?>
                        <option value="<?php echo $val1->id; ?>"><?php echo $val1->name; ?></option>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>

                </select>
                <i></i> </label>
            </section>
            <section>
             <label class="label"><b>Select Term</b></label>
              <label class="select">
                <select name="assessment_term_id" id='assessment_term_id'>
                  <option value="<?php echo $value[0]->assessment_term_id?>"><?php echo $query[0]->dname?></option>
                  <?php if(!empty($query1)) { ?>
                    <?php foreach ($query1 as $val) { ?>
                      <?php if($value[0]->assessment_term_id == $val->id) {?>
                      <?php } else{?>
                      <option value="<?php echo $val->id; ?>"><?php echo $val->dname; ?></option>
                      <?php } ?>
                      <?php }  ?>
                  <?php } ?>


                </select>

                <i></i> </label>
            </section>
            </fieldset>
          <fieldset>
           <section>
              <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" class='date_from' name="date_from" id="start" placeholder="Date From" value='<?php echo $query[0]->date_from ?>' />
                <b class="tooltip tooltip-bottom-right">Needed to enter the Date From</b>
              </label>
             
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" name="date_to" id="finish" class='date_to' placeholder="Date To" value="<?php echo $query[0]->date_to ?>" />
                <b class="tooltip tooltip-bottom-right">Needed to enter the Date to</b>
              </label>
            </section>
            </fieldset>            
          <footer>
            <button type="submit" class="btn btn-orb-org">Submit</button>
            <button type="reset" class="btn btn-orb-org" style="float: right;">Reset </button>
          </footer>
        </form>
      </div>

     
     <!--Forms--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script> 




 <script type="text/javascript">
        if($('#order-form').length)
        {
          //Form Validation
          $('#order-form').validate({
            rules: {
                     assessment_term_id: {
                        required: true
                    },
                     assessment_session_id: {
                        required: true,
                    },
                    date_from: {
                        required: true
                    },
                    date_to: {
                        required: true
                    }
                  },
                  //Message Validation
                  messages: {
                    assessment_term_id: {
                        required: 'Please select the Term Name'
                    },
                    assessment_session_id: {
                        required: 'Please select your Session Name'
                    },
                    date_from: {
                        required: 'Please enter Date From'
                    },
                    date_to: {
                        required: 'Please enter Date To'
                    },
                   
                },

                 submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: "POST",
                        url:"<?php echo base_url() ?>index.php/term/getview/academic_update",
                        cache:false,
                        data:$('#order-form').serialize(),
                        datatype: "html",
                        success: function (data)
                        {
                          if(data == 0)
                          {
                            alert('Check the Field');
                          }
                          else
                          {
                             $('#tableUpdate').html(data);
                             $('.callout').css('display','');
                             $('.callout').fadeOut(5000);

                          
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

$('.link-button').click(function(){
  $.ajax({
    type:"POST",
    url:"<?php echo base_url(); ?>index.php/term/getview/main_academic_header",
    cache:false,
    datatype:"html",
    success:function(e)
    {
      $('#editTerm').html(e);
    }
  });
});
    

      </script>

      
