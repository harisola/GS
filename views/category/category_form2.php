<div class="inner-spacer" role="content">
  <form action="" id="category-form" class="orb-form" novalidate="novalidate" method="POST">
     <header>
     Assessment Category Grade
     <button class='btn btn-primary insert-assessment' style="float: right">Add Assessment</button>
     </header>
    <input type="hidden" value="<?php echo $select_grade[0]->id ?>" name='formative_record_id' />
    <input type="hidden" value="<?php echo $select_grade[1]->id ?>" name='summative_record_id' />
    <input type="hidden" value="<?php echo $select_grade[2]->id ?>" name='attendance_record_id' />
    <input type="hidden" value="<?php echo $select_grade[3]->id ?>" name='stationary_record_id' />
    <input type="hidden" value="<?php echo $select_grade[4]->id ?>" name='ptm_record_id' />
    <input type="hidden" value="<?php echo $select_id[0]->grade_id ?>" name='grade_id' />
     <fieldset>
        <section>
           <label class="label"><b>Select Grade</b></label>
           <label class="select" >
              <select>
                 <option value="<?php echo $select_id[0]->grade_id;  ?>" selected="" disabled="" ><?php echo $select_grade[0]->grade_id ?></option>
              </select>
              <i></i> 
           </label>
        </section>
        </fieldset>
     <fieldset style="padding-bottom: 0px;">
        <section>
      <?php if($select_id[0]->is_fix == 1) { ?>
        <?php $checked = 'checked'; ?>
      <?php } else $checked =''; ?>
           <div class='row'>
            <div class='col-md-3'>
              <label class='input' style="font-size: 20px;">Formative</label>
              <input type="hidden" value='<?php echo $select_id[0]->assessment_category_id;  ?>' name='formative'/>
            </div>  
            <div class='col-md-4 col-xs-8'>
               <i class="icon-append fa fa-asterisk" style="height: 40px;color:#757575 "></i>
              <input type="text" name='form_weight' id='form-weight' class='form-control' placeholder="Enter Weightage" style="padding-top: 0px;padding-bottom: 0px;padding-left: 5px;"
              value="<?php echo $select_grade[0]->weightage; ?>">
            </div>
            <label class="toggle" style="font-size:15px;text-align: center;right: 18px">
            <input style="font-size:10px" type="checkbox"  name="is_fix_formative"  id='get-value-formative'  <?php echo $checked ?>  />
            <i style="color:black;height: 19px;width: 56px; "></i><b style="float: right"></b></label>
           </div>
        </section>
     </fieldset>
     <?php if($select_id[1]->is_fix == 1) { ?>
      <?php $checked_summ = 'checked'; ?>
     <?php } else $checked_summ =''; ?>
     <fieldset style="padding-bottom: 0px">
        <section>
           <div class='row'>
            <div class='col-md-3'>
              <label class='input' style="font-size: 20px;">Summative</label>
              <input type="hidden" value='<?php echo $select_id[1]->assessment_category_id; ?>' name='summative'>
            </div>  
            <div class='col-md-4 col-xs-8'>
               <i class="icon-append fa fa-asterisk" style="height: 40px;color: #757575"></i>
              <input type="text" name='summ_weight' id='summ-weight' class='form-control' placeholder="Enter Weightage" style="padding-top: 0px;padding-bottom: 0px;padding-left: 5px;"
              value="<?php echo $select_grade[1]->weightage; ?>">
            </div>
            <label class="toggle" style="font-size:15px;text-align: center;right: 18px">
            <input style="font-size:10px" type="checkbox"  name="is_fix_summative"  id='get-value-summative' <?php echo $checked_summ; ?>  />
            <i style="color:black;height: 19px;width: 56px; "></i><b style="float: right"></b></label>
           </div>
        </section>
     </fieldset>
      <?php if($select_id[2]->is_fix == 1) { ?>
        <?php $checked_atten = 'checked'; ?>
      <?php } else $checked_atten =''; ?>
      <fieldset style="padding-bottom: 0px">
        <section>
           <div class='row'>
            <div class='col-md-3'>
              <label class='input' style="font-size: 20px;">Attendance</label>
              <input type="hidden" value='<?php echo $select_id[2]->assessment_category_id; ?>' name='attendance'>
            </div>  
            <div class='col-md-4 col-xs-8'>
               <i class="icon-append fa fa-asterisk" style="height: 40px;color: #757575"></i>
              <input type="text" name='att_weight' id='att-weight' class='form-control' placeholder="Enter Weightage" style="padding-top: 0px;padding-bottom: 0px;padding-left: 5px;"
              value="<?php echo $select_grade[2]->weightage; ?>">
            </div>

            <label class="toggle" style="font-size:15px;text-align: center;right: 18px">
            <input style="font-size:10px" type="checkbox"  name="is_fix_attendance"  id='get-value-attendance' <?php echo $checked_atten ?> />
            <i style="color:black;height: 19px;width: 56px; "></i><b style="float: right"></b></label>
           </div>
        </section>
     </fieldset>
      <?php if($select_id[3]->is_fix == 1) { ?>
      <?php $checked_stat = 'checked'; ?>
      <?php } else $checked_stat =''; ?>
         <fieldset style="padding-bottom: 0px">
        <section>
           <div class='row'>
            <div class='col-md-3'>
              <label class='input' style="font-size: 20px;">Stationary</label>
              <input type="hidden" value='<?php echo $select_id[3]->assessment_category_id; ?>' name='stationary'>
            </div>  
            <div class='col-md-4 col-xs-8'>
               <i class="icon-append fa fa-asterisk" style="height: 40px;color: #757575"></i>
              <input type="text" name='stat_weight' id='stat-weight' class='form-control' placeholder="Enter Weightage" style="padding-top: 0px;padding-bottom: 0px;padding-left: 5px;"
              value="<?php echo $select_grade[3]->weightage; ?>">
            </div>
           <label class="toggle" style="font-size:15px;text-align: center;right: 18px">
          <input style="font-size:10px" type="checkbox"  name="is_fix_stationary"  id='get-value-stationary' <?php echo $checked_stat;  ?> />
          <i style="color:black;height: 19px;width: 56px; "></i><b style="float: right"></b></label>
           </div>
        </section>
     </fieldset>
           <?php if($select_id[4]->is_fix == 1) { ?>
      <?php $checked_ptm = 'checked';  ?>
      <?php } else $checked_ptm =''; ?>
         <fieldset style="padding-bottom: 0px">
        <section>
           <div class='row'>
            <div class='col-md-3'>
              <label class='input' style="font-size: 20px;">PTM</label>
              <input type="hidden" value='<?php echo $select_id[4]->assessment_category_id; ?>' name='ptm'>
            </div>  
            <div class='col-md-4 col-xs-8'>
               <i class="icon-append fa fa-asterisk" style="height: 40px;color: #757575"></i>
              <input type="text" name='parent_weight' id='parent-weight' class='form-control' placeholder="Enter Weightage" style="padding-top: 0px;padding-bottom: 0px;padding-left: 5px;"
              value="<?php echo $select_grade[4]->weightage; ?>">
            </div>
           <label class="toggle" style="font-size:15px;text-align: center;right: 18px">
          <input style="font-size:10px" type="checkbox"  name="is_fix_ptm"  id='get-value-ptm' <?php echo $checked_ptm; ?>  />
          <i style="color:black;height: 19px;width: 56px; "></i><b style="float: right"></b></label>
           </div>
        </section>
     </fieldset>
             <fieldset>
                <div id = 'total'></div>
             </fieldset>
        <footer>
           <button type="submit" class="btn btn-orb-org" id='btn-update'>Update</button>
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

    if(("#category-form").length){
      $('#category-form').validate({
          rules: {
            form_weight:{
              required:true,
              rangelength: [1, 3]
            },
            summ_weight:{
              required:true,
              rangelength: [1, 3]
            },
            att_weight:{
              required:true,
              rangelength:[1,3]
            },
            stat_weight:{
              required:true,
              rangelength:[1,3]
            },
            parent_weight:{
              required:true,
              rangelength:[1,3]
            }

          },
          messages:{
            form_weight:{
              required:"Please Enter the Formative Weightage"
            },
            summ_weight:{
              required:"Please Enter the summative Weightage "
            },
            att_weight:{
              required:"Please Enter the Attendance Weightage"
            },
            stat_weight:{
              required:"Please Enter the Stationary Weightage"
            },
            parent_weight:{
              required:"Please Enter PTM Weightage"
            }

          },
          submitHandler:function(form)
          {
             return false;
          }
      });
    }

    if($('#category-form').length){
    $(document).on('click','#btn-update',function(){
    var formative =parseInt($('#form-weight').val());
    var sumative = parseInt($('#summ-weight').val());
    var attendance =parseInt($('#att-weight').val());
    var stationary =parseInt($('#stat-weight').val());
    var ptm =parseInt($('#parent-weight').val());
    var total = parseInt(formative+sumative+attendance+stationary+ptm);
    var a;
    if(total < 100){
        sum = 100 - total;
        a = "<p style='font-size:18px; color:red;'> The Remaining Weightage is " +sum+ "</p>";
        $('#total').html(a);
    }
    else if(total > 100){
        sum  =100;
        a="<p style='font-size:18px; color:red;' > The total Weightage is greater than"+sum+ "</p>";
        $('#total').html(a);
    }
    else if (total == 100){
        a="";
        $('#total').html(a);
        update_data();
    }

    });
}
function update_data(){
    if(('#category-form').length){
      $.ajax({
        type:"POST",
        cache:false,
        data:$('#category-form').serialize(),
        url:"<?php echo base_url(); ?>index.php/category/category_ajax/update",
        datatype:"html",
        success:function(f)
        {
          $('#tableUpdate').html(f);
        }

      });
    }
}
$(".insert-assessment").click(function(){
  $.ajax({
    type:"POST",
    url:"<?php  echo base_url(); ?>index.php/category/category_ajax/get_insert ",
    cache:false,
    datatype:"html",
    success:function(g)
    {
      $('#edit-category').html(g);
    }
  })
});
  $('#form-weight').keydown(function(e){
  if($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||(e.keyCode >= 48 && e.keyCode <=57) || (e.keyCode >= 96 && e.keyCode <= 105)){
      return true;
  }
  else{
    return false;
  }
});

  $('#summ-weight').keydown(function(e){
  if($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1|| (e.keyCode >= 48 && e.keyCode <=57) || (e.keyCode >= 96 && e.keyCode <= 105)){

    return true;
  }
  else{
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

