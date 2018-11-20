<div class="inner-spacer" role='content'>
  <div id='alert_validation' class="callout callout-danger" style="display: none;" >The Name Code field must contain a unique value.</div>
  <div  id ='alert_update'class="callout callout-info" style="display: none;"> Data Updated Successfully </div>
  <div id='alert_insert' class='callout callout-danger' style="display: none;">The Assessment Name fiedl must contain a unique value</div>
  <form action="" class="form-horizontal orb-form" role='form' method='post' id ='order-form' >
    <header>
    Edit Term Registration Form
      <button type='button' class='btn btn-primary link-button' style='float:right;'>Add Term</button>
    </header>
    <fieldset>
      <input type="hidden" name="id" value="<?php echo $row[0]['id'] ?>">
      <section>
        <label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
          <input type="text" placeholder="Enter Assesment Name" name='assest_name' id='assest_name' autofocus="autofocus" value="<?php echo $row[0]['name']; ?>" />
          <b class="tooltip tooltip-bottom-right">Enter the Name</b></label>
      </section>
      <section>
        <label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
          <input type="text" placeholder="Enter Display name" name='display' id='display' value="<?php echo $row[0]['dname']; ?>" />
          <b class="tooltip tooltip-bottom-right">Enter the Display Name</b></label>
      </section>
      <section>
        <label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
          <input type="text" placeholder="Enter Short Name" name='assest_ncode' id='assest_ncode' value="<?php echo $row[0]['sname']; ?>"/>
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

        submitHandler: function (form)
        {
          $(form).ajaxSubmit({
            type:"POST",
            url: "<?php echo base_url(); ?>index.php/term/getview/getupdate",
            cache: false,
            data: $('#order-form').serialize(),
            datatype: "html",
            success: function (data)
            {
              if(data == '0')
              {
                $('#alert_validation').css('display','');
                $('#alert_validation').fadeOut(5000);
              }
              else
              {
                $('#alert_update').css('display','');
                $('#alert_update').fadeOut(5000);
                $("#tableUpdate").html(data);
              }

            },
			      error:function (){
               $('#alert_insert').css('display','');
               $('#alert_insert').fadeOut(10000);
            }

          });
        }
		

        });
  
	}

  $('.link-button').click(function(){
    $.ajax({
      type:"POST",
      url:'<?php echo base_url(); ?>index.php/term/getview/mainheader',
      cache:'false',
      success:function(e)
      {
        $('#editTerm').html(e);
      }
    });
  });
$('#assest_name').keydown(function(e){
    if((e.keyCode >= 48 && e.keyCode <=57) || (e.keyCode >= 96 && e.keyCode <= 105))
    {
        return false;
    }
    else
    {
        return true;
    }
});
$('#display').keydown(function(e){
    if((e.keyCode >= 48 && e.keyCode <=57) || (e.keyCode >= 96 && e.keyCode <= 105))
    {
        return false;
    }
    else
    {
        return true;
    }
});
$('#assest_ncode').keydown(function(e){
    if((e.keyCode >= 48 && e.keyCode <=57) || (e.keyCode >= 96 && e.keyCode <= 105))
    {
        return false;
    }
    else
    {
        return true;
    }
});
</script>