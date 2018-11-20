<div class="inner-spacer" role='content'>
 <div id='alert_validation' class='callout callout-danger' style="display: none;"></div>
  <div id='alert_insert' class="callout callout-info" style="display: none;"> Data Inserted Successfully </div>
 <form action="" class="form-horizontal orb-form" role='form' method='post' id ='order-form' >
  <header>Term Registration Form</header>
    <fieldset>
       <section>
      <label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
      <input type="text" placeholder="Enter Assesment Name" name='assest_name' id='assest_name' autofocus="autofocus" />
      <b class="tooltip tooltip-bottom-right">Enter the Name</b></label>
   </section>
   <section>
      <label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
      <input type="text" placeholder="Enter Display name" name='display' id = 'display' />
      <b class="tooltip tooltip-bottom-right">Enter the Display Name</b></label>
   </section>
     <section>
      <label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
      <input type="text" placeholder="Enter Short Name" name='assest_ncode' id='assest_ncode'/>
      <b class="tooltip tooltip-bottom-right">Enter the Short Name</b>
      </label>
     </section>                      
     </fieldset>
   <footer>
    <button type="submit" class="btn btn-orb-org" id='send'>Submit</button>
    <button type="reset" class="btn btn-orb-org" style='float:right'>Reset</button>
   </footer>
 </form>
</div>
<script type="text/javascript">
  if($('#order-form').length){
     $('#order-form').validate({
        rules:{
            assest_name :{
               required: true 
            },
            display :{
                required: true
            },
            assest_ncode :{
                required: true,
                rangelength: [1, 3]
            }
          },
      submitHandler:function(form)
      {
        $(form).ajaxSubmit({
        type:"POST",
        url:"<?php echo base_url(); ?>index.php/term/getpost/create",
        cache:false,
        data:$('#order-form').serialize(),
        datatype:"html",
        success: function (data)
        {
          if(data != 1)
            {
              $('#alert_validation').css('display','');
              $('#alert_validation').fadeOut(5000);
              $('#alert_validation').html(data);
            }
            if(data == 1)
            {
              $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>index.php/term/getview",
                datatype:"html",
                success: function(response)
                {
                    $('#alert_insert').css('display','');
                    $('#alert_insert').fadeOut(5000);
                    $("#tableUpdate").html(response);
                    $('#assest_name').val('');
                    $('#display').val('');
                    $('#assest_ncode').val('');
                }

             });
            }
          }
        });
      }

    });
  }
// $('#assest_name').keydown(function(e){
//   if((e.keyCode >= 48 && e.keyCode <=57) || (e.keyCode >= 96 && e.keyCode <= 105))
//   {
//     return false;
//   }
//     else
//     {
//       return true;
//     }
// });

// $('#display').keydown(function(e){
//   if((e.keyCode >= 48 && e.keyCode <=57) || (e.keyCode >= 96 && e.keyCode <= 105))
//   {
//     return false;
//   }
//   else
//   {
//     return true;
//   }
// });
// $('#assest_ncode').keydown(function(e){
//     if((e.keyCode >= 48 && e.keyCode <=57) || (e.keyCode >= 96 && e.keyCode <= 105))
//     {
//       return false;
//     }
//     else
//     {
//       return true;
//     }
// });



</script>

