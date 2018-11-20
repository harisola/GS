 <div class="inner-spacer" role="content">
    <form action="" id="form-insert" class="orb-form" novalidate="novalidate" method="POST">
       <header>Assessment Category Grade</header>
       <fieldset>
          <section>
             <label class="label"><b>Select Grade</b></label>
             <label class="select">
                <select name="grade_id" id="grade-id" >
                   <option value="0" selected="" disabled="">Grades</option>
                   <?php if(!empty($grade))  {?>
                    <?php foreach($grade as $value) {?>
                   <option value="<?php echo $value->id ?>"><?php echo $value->dname ?></option>
                   <?php } ?>
                   <?php } ?>
                </select>
                <i></i> 
             </label>
          </section>
          </fieldset>
       <fieldset style="padding-bottom: 0px;">
          <section>
             <div class='row'>
              <div class='col-md-3'>
                <label class='input' style="font-size: 20px;">Formative</label>
                <input type="hidden" value='<?php echo $category[0]->id ?>' name='formative'/>
              </div>  
              <div class='col-md-4 col-xs-8'>
                 <i class="icon-append fa fa-asterisk" style="height: 40px;color: #757575"></i>
                 <!-- Change In Value -->
                <input type="text" name='form_weight' id='form-weight' class='form-control' placeholder="Enter Weightage" value="<?php echo $category[0]->weightage; ?>" style="padding-top: 0px;padding-bottom: 0px;padding-left: 5px;">
              </div>
                <label class="toggle" style="font-size:15px;text-align: center;right: 18px">
                <input style="font-size:10px" type="checkbox"  name="is_fix_formative" value id='get-value-formative'  />
                <i style="color:black;height: 19px;width: 56px;"></i><b style="float: right"></b></label>
             </div>
          </section>
       </fieldset>
       <fieldset style="padding-bottom: 0px;">
          <section>
             <div class='row'>
              <div class='col-md-3'>
                <label class='input' style="font-size: 20px;">Summative</label>
                <input type="hidden" value='<?php echo $category[1]->id ?>' name='summative'>
              </div>  
              <div class='col-md-4 col-xs-8'>
                 <i class="icon-append fa fa-asterisk" style="height: 40px;color: #757575"></i>
                <input type="text" name='summ_weight' id='summ-weight' class='form-control' placeholder="Enter Weightage" value="<?php echo $category[1]->weightage; ?>" style="padding-top: 0px;padding-bottom: 0px;padding-left: 5px;">
              </div>
                 <label class="toggle" style="font-size:15px;text-align: center;right: 18px">
                <input style="font-size:10px" type="checkbox"  name="is_fix_summative" value id='get-value-summative'  />
                <i style="color:black;height: 19px;width: 56px;"></i><b style="float: right"></b></label>
              
             </div>
          </section>
       </fieldset>
       <fieldset style="padding-bottom: 0px;">
          <section>
             <div class='row'>
              <div class='col-md-3'>
                <label class='input' style="font-size: 20px;">Attendance</label>
                <input type="hidden" value='<?php echo $category[2]->id ?>' name='attendance'>
              </div>  
              <div class='col-md-4 col-xs-8'>
                 <i class="icon-append fa fa-asterisk" style="height: 40px;color: #757575"></i>
                <input type="text" name='att_weight' id='att-weight' class='form-control' placeholder="Enter Weightage" value="<?php echo $category[2]->weightage; ?>" style="padding-top: 0px;padding-bottom: 0px;padding-left: 5px;">
              </div>

              <label class="toggle" style="font-size:15px;text-align: center;right: 18px">
                <input style="font-size:10px" type="checkbox"  name="is_fix_attendance" value id='get-value-attendance'  />
                <i style="color:black;height: 19px;width: 56px;"></i><b style="float: right"></b></label>
             </div>
          </section>
       </fieldset>
       <fieldset style="padding-bottom: 0px;">
          <section>
             <div class='row'>
              <div class='col-md-3'>
                <label class='input' style="font-size: 20px;">Stationary</label>
                <input type="hidden" value='<?php echo $category[3]->id ?>' name='stationary'>
              </div>  
              <div class='col-md-4 col-xs-8'>
                 <i class="icon-append fa fa-asterisk" style="height: 40px;color: #757575"></i>
                <input type="text" name='stat_weight' id='stat-weight' class='form-control' placeholder="Enter Weightage" value="<?php echo $category[3]->weightage; ?>" style="padding-top: 0px;padding-bottom: 0px;padding-left: 5px;">
              </div>
              <label class="toggle" style="font-size:15px;text-align: center;right: 18px">
                <input style="font-size:10px" type="checkbox"  name="is_fix_stationary" value id='get-value-stationary'  />
                <i style="color:black;height: 19px;width: 56px; "></i><b style="float: right"></b></label>
             </div>
          </section>
       </fieldset>
       <fieldset style='padding-bottom: 0px'>
          <section>
             <div class='row'>
              <div class='col-md-3'>
                <label class='input' style="font-size: 20px;">PTM</label>
                <input type="hidden" name='ptm' value='<?php echo $category[4]->id ?>'>
              </div>
          <div class='col-md-4 col-xs-8'>
           <i class="icon-append fa fa-asterisk" style="height: 40px;color: #757575"></i>
           <input type="text" name='parent_weight' id='parent-weight' class='form-control' placeholder="Enter Weightage" value="<?php echo $category[4]->weightage; ?>" style="padding-top: 0px;padding-bottom: 0px;padding-left: 5px;">  
          </div>
          <label class="toggle" style="font-size:15px;text-align: center;right: 18px">
                <input style="font-size:10px" type="checkbox"  name="is_fix_ptm" value id='get-value-ptm'  />
                <i style="color:black;height: 19px;width: 56px; "></i><b style="float: right"></b></label>
          </section>
       </fieldset>
               <fieldset>
                  <div id = 'total'></div>
               </fieldset>
          <footer>
             <button type="submit" class="btn btn-orb-org" id='btn-insert'>Submit</button>
             <button type="reset" class="btn btn-orb-org" style="float: right;">Reset </button>
          </footer>
    </form>
 </div>

<script type="text/javascript">

// Start Check Boxes
if ($('#get-value-formative').length) {
  $(document).on("change","#get-value-formative", function(){
  var cbAns = ( $(this).is(':checked') ) ? 1 : 0;
  $('#get-value-formative').val(cbAns);

  });

}

if ($('#get-value-summative').length) {
  $(document).on("change","#get-value-summative", function(){
  var cbAns = ( $(this).is(':checked') ) ? 1 : 0;
  $('#get-value-summative').val(cbAns);

  });

}

if ($('#get-value-attendance').length) {
  $(document).on("change","#get-value-attendance", function(){
  var cbAns = ( $(this).is(':checked') ) ? 1 : 0;
  $('#get-value-attendance').val(cbAns);

  });

}

if ($('#get-value-stationary').length) {
  $(document).on("change","#get-value-stationary", function(){
  var cbAns = ( $(this).is(':checked') ) ? 1 : 0;
  $('#get-value-stationary').val(cbAns);

  });

}

if ($('#get-value-ptm').length) {
  $(document).on("change","#get-value-ptm", function(){
  var cbAns = ( $(this).is(':checked') ) ? 1 : 0;
  $('#get-value-ptm').val(cbAns);
 });

}
     // End Check Boxes
    if ($('#form-insert').length) {
        $(document).on('click', '#btn-insert', function() {
            var formative = parseInt($('#form-weight').val());
            var sumative = parseInt($('#summ-weight').val());
            var attendance =parseInt($('#att-weight').val());
            var stationary =parseInt($('#stat-weight').val());
            var ptm =parseInt($('#parent-weight').val());
            var total = parseInt(formative+sumative+attendance+stationary+ptm);
            var a;
            if (total < 100) {
                sum = 100 - total;
                a = "<p style='font-size:18px; color:red;'> The Remaining Weightage is " + sum + "</p>";
                $('#total').html(a);
            } else if (total > 100) {
                sum = 100;
                a = "<p style='font-size:18px; color:red;' > The total Weightage is greater than" + sum + "</p>";
                $('#total').html(a);
            } else if (total == 100) {
                a = "";
                $('#total').html(a);
                insert_data();
            }

        });

    }

    if ($("#form-insert").length) {
        $('#form-insert').validate({
            rules: {
                form_weight: {
                    required: true,
                    rangelength: [1, 3]
                },
                summ_weight: {
                    required: true,
                    rangelength: [1, 3]
                },
                grade_id: {
                    required: true
                },
                att_weight:{
                  required:true,
                  rangelength: [1,3]
                },
                stat_weight:{
                  required:true,
                  rangelength: [1,3]
                },
                parent_weight:{
                  required:true,
                  rangelength: [1,3]
                }

            },
            messages: {
                form_weight: {
                    required: "Please Enter the Formative Weightage"
                },
                summ_weight: {
                    required: "Please Enter the summative Weightage "
                },
                grade_id: {
                    required: "Plese Enter the grade Name"
                },
                att_weight:{
                  required:"Please Enter the attendance Weightage"
                },
                stat_weight:{
                  required:"Please Enter the Stationary Weightage",
                },
                parent_weight:{
                  required:"Please Enter the PTM Weightage"
                }


            },
            submitHandler: function(form) {
                return false;
            }
        });
    }

    function insert_data() {
        if ($('#form-insert').length) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/category/category_ajax/create",
                cache: false,
                data: $('#form-insert').serialize(),
                datatype: "html",
                success: function(h) {

                    $('#tableUpdate').html(h);

                    $('#grade-id').val(0);
                    $('#form-weight').val('');
                    $('#summ-weight').val('');
                    $('#att-weight').val('');
                    $('#stat-weight').val('');
                    $('#parent-weight').val('');

                }
            });
        }
    }

    $('#form-weight').keydown(function(e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
            return true;
        } else {
            return false;
        }
    });

    $('#summ-weight').keydown(function(e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
            return true;
        } else {
            return false;
        }
    });
    $('#att-weight').keydown(function(e){
    if($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1|| (e.keyCode >= 48 && e.keyCode <=57) || (e.keyCode >= 96 && e.keyCode <= 105)){
        return true;
    }
    else{
        return false;
    }
    });
    $('#stat-weight').keydown(function(e){
    if($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1|| (e.keyCode >= 48 && e.keyCode <=57) || (e.keyCode >= 96 && e.keyCode <= 105)){
        return true;
    }
    else{
        return false;
    }
    });
    $('#parent-weight').keydown(function(e){
    if($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1|| (e.keyCode >= 48 && e.keyCode <=57) || (e.keyCode >= 96 && e.keyCode <= 105)){
        return true;
    }
    else{
        return false;
    }
    });
</script>



