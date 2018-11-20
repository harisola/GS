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
    $(document).on('click','#allocate_profile',function(e){

        var profile = $('#profile_select option:selected').val();
        var profile_type_id = $('#profile_select option:selected').attr('data-id');
        
        // Get Staff ID
        var staff_id = [];
        var id = "";
        var oTable = $("#TTListing").dataTable();
        
        $(".staffCheck:checked", oTable.fnGetNodes()).each(function() {
            if (id != "") {
                id = id + "," + $(this).val();
                staff_id.push($(this).val());
            } else {
                staff_id.push($(this).val());
                id = $(this).val();
            }

        });

        

        // Allocation of Standard Profile to Staff

        if(staff_id != 0 && profile != 0 && profile_type_id == 1 ){
            
            $.ajax({
                type:"POST",
                cache:false,
                data:{
                    profile_id:profile,
                    profile_type_id:profile_type_id,
                    staff_id:staff_id
                },
                url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_staff_ajax/allocate_std_staff",
                success:function(e){

                    $('.replace_table').html('');
                    
                    $.ajax({
                        type:"POST",
                        cache:false,
                        url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_staff_ajax/get_left_panel",
                        success:function(f){
                             $('.replace_table').html(f);
                                 $("#TTListing").dataTable({
                                  "columnDefs": [{
                                      "targets": "no-sort",
                                      "orderable": false,
                                }],
                                "bLengthChange": false,
                                "bInfo" : false,
                                "aLengthMenu": [[25, 50, 70, -1], [25, 50, 70, "All"]],
                                "iDisplayLength": 50
                              });

                              // Toggle Filter   
                             $(".filterDiv").toggle();

                        }
                    });
                }
            });    

        } // End IF


        // Allocation of Custom Profile to Staff

        if(staff_id != 0 && profile != 0 && profile_type_id == 2 ){
            
            $.ajax({
                type:"POST",
                cache:false,
                data:{
                    profile_id:profile,
                    profile_type_id:profile_type_id,
                    staff_id:staff_id
                },
                url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_staff_ajax/allocate_cus_staff",
                success:function(e){

                    $('.replace_table').html('');
                    
                    $.ajax({
                        type:"POST",
                        cache:false,
                        url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_staff_ajax/get_left_panel",
                        success:function(f){
                             $('.replace_table').html(f);
                                 $("#TTListing").dataTable({
                                  "columnDefs": [{
                                      "targets": "no-sort",
                                      "orderable": false,
                                }],
                                "bLengthChange": false,
                                "bInfo" : false,
                                "aLengthMenu": [[25, 50, 70, -1], [25, 50, 70, "All"]],
                                "iDisplayLength": 50
                              });

                             // Toggle Filter   
                             $(".filterDiv").toggle();

                        }
                    });
                }
            });    

        } // End IF


        // Allocation of Part Time Profile to Staff

        if(staff_id != 0 && profile != 0 && profile_type_id == 3){

             $.ajax({
                type:"POST",
                cache:false,
                data:{
                    profile_id:profile,
                    profile_type_id:profile_type_id,
                    staff_id:staff_id
                },
                url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_staff_ajax/allocate_part_staff",
                success:function(e){
                 $('.replace_table').html('');
                    
                    $.ajax({
                        type:"POST",
                        cache:false,
                        url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_staff_ajax/get_left_panel",
                        success:function(f){
                             $('.replace_table').html(f);
                                 $("#TTListing").dataTable({
                                  "columnDefs": [{
                                      "targets": "no-sort",
                                      "orderable": false,
                                }],
                                "bLengthChange": false,
                                "bInfo" : false,
                                "aLengthMenu": [[25, 50, 70, -1], [25, 50, 70, "All"]],
                                "iDisplayLength": 50
                              });

                                // Toggle Filter   
                             $(".filterDiv").toggle();

                        }
                    });
                }

            });

        } // End if




    });

    $(document).on('change','#purpose',function(e){
        var profile_id = $(this).val();
        var profile_type_id = $('#purpose option:selected').attr('data-id');
        $('#get_profile').html('');
        $.ajax({
            type:"POST",
            cache:false,
            data:{
                profile_id:profile_id,
                profile_type_id:profile_type_id
            },
            url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_staff_ajax/get_profile",
            success:function(e){
                $('#get_profile').html(e);

                calculating_hours(profile_type_id)
            }
        });
    });


    // Calculating Avg Weekly Hours And Mon-thu Timing  

 function calculating_hours(profile_type_id){
  // Calculating Avg Weekly Timing
  var profile_type_id = profile_type_id;
  var morning_time = $('#std_morning').val();
  var afternoon_time = $('#std_afternoon').val();
  var fri_hours = $('#std_fri').val();
  var sat_hours = $('#std_sat_hrs').val();
  var sat_off = $('#std_off').val();
  var sat_on = $('#std_working').val();
  var ext_time = $('#std_ext').val();
  var ext_frequency = $('#std_frequency').val();


    if(profile_type_id == 1){
       if(morning_time.length != 0 && afternoon_time.length != 0){
        var p = "1/1/1970 ";
        difference_mt = new Date(new Date(p+afternoon_time) - new Date(p+morning_time)).toUTCString().split(" ")[4];
        difference_f = new Date(new Date(p+fri_hours) - new Date(p+morning_time)).toUTCString().split(" ")[4];
        
        $('#mon_thurs_hours').val(difference_mt);   
              
          var t1 = difference_mt.split(':');
          var t2 = difference_f.split(':');
          console.log(difference_f);
          if(difference_f == '17:00:00'){
            t2 = "00:00:00";
          }
          mins = Number(t1[1]*4) + Number(t2[1]);
          minhrs = Math.floor(parseInt(mins / 60));
          hrs = Number(t1[0]*4) + Number(t2[0]) + minhrs;
          mins = mins % 60;
          t1 = hrs + ':' + mins

          if(sat_on.length > 0){
              var sat = sat_hours * sat_on;
              sat = sat/4;
              console.log(sat);
              var n = new Date(0,0);
              n.setSeconds(+sat * 60 * 60);
              var sat_avg = (n.toTimeString().slice(0, 8));
            }else{

              var sat = sat_hours * (4-sat_off);
              sat = sat/4;
              var n = new Date(0,0);
              n.setSeconds(+sat * 60 * 60);
              var sat_avg = (n.toTimeString().slice(0, 8));

            }

            if(ext_frequency.length > 0){
              var p = "1/1/1970 ";
              difference_ext = new Date(new Date(p+ext_time) - new Date(p+afternoon_time)).toUTCString().split(" ")[4];
              var arr = difference_ext.split(':');
              var ext_working_hours =  parseFloat(parseInt(arr[0], 10) + '.' + parseInt((arr[1]/6)*10, 10));
              ext_working_hours = ext_working_hours * ext_frequency;
              var n = new Date(0,0);
              n.setSeconds(+ext_working_hours * 60 * 60);
              var ext_avg = (n.toTimeString().slice(0, 8));
              console.log(ext_avg);
            }else{
              var  ext_avg = '00:00:00';
            }

            //console.log(sat_avg);
            // var total_sat_avg = sat_avg.split(':');
            // console.log(total_sat_avg);
            // var mins_sat = Number(total_sat_avg[1]);
            // var minhrs_sat = Math.floor(parseInt(mins_sat / 60));
            // var  hrs_sat = Number(total_sat_avg[0]) + minhrs_sat;
            // mins_sat = mins_sat % 60;
            // var calc = hrs_sat + ':' + mins_sat;

            // console.log(calc);

            // mins = Number(t1[1]*4) + Number(t2[1]);
            // minhrs = Math.floor(parseInt(mins / 60));
            // hrs = Number(t1[0]*4) + Number(t2[0]) + minhrs;
            // mins = mins % 60;
            // t1 = hrs + ':' + mins

              var time1 = t1;
              var time2 = sat_avg;
              var time3 = ext_avg;
              
              var hour=0;
              var minute=0;
              var second=0;
              
              var splitTime1= time1.split(':');
              var splitTime2= time2.split(':');
              var splitTime3= time3.split(':');

              console.log(splitTime1);
              console.log(splitTime2);
              console.log(splitTime3);

              mins = Number(splitTime1[1]) + Number(splitTime2[1]) + Number(splitTime3[1]);
              minhrs = Math.floor(parseInt(mins / 60));
              hrs = Number(splitTime1[0]) + Number(splitTime2[0]) + Number(splitTime3[0]) + minhrs;
              mins = mins % 60;
              t1 = hrs+':'+mins;
          
              $('#avg_hrs').val(t1);
        }

       // Standard Friday Timing
        if(fri_hours.length != 0){
        difference = new Date(new Date(p+fri_hours) - new Date(p+morning_time)).toUTCString().split(" ")[4];
        $('#fri_hrs').val(difference);
        }
    } // End Standard Profile

    // ================= Custom Profile ========================//
    // ========================================================// 

        if(profile_type_id == 2){

            var custom_morning = $('#cus_morning').val();
            var custom_afternoon = $('#cus_afternoon').val();
            var custom_friday = $('#cus_fri').val();
            var sat_hours = $('#cus_sat_hrs').val();
            var sat_off = $('#cus_off').val();
            var sat_on = $('#cus_working').val();
            var ext_time = $('#cus_ext').val();
            var ext_frequency = $('#cus_frequency').val();
            var difference_time;

            if(custom_morning.length != 0 && custom_afternoon.length != 0){

              var p = "1/1/1970 ";
              difference_mt = new Date(new Date(p+custom_afternoon) - new Date(p+custom_morning)).toUTCString().split(" ")[4];
              difference_f = new Date(new Date(p+custom_friday) - new Date(p+custom_morning)).toUTCString().split(" ")[4];
              


              $('#cus_mon_thu_cal').val(difference_mt);   
                  
              var t1 = difference_mt.split(':');
              var t2 = difference_f.split(':');
              console.log(difference_f);
              if(difference_f == '17:00:00'){
                t2 = "00:00:00";
              }
              mins = Number(t1[1]*4) + Number(t2[1]);
              minhrs = Math.floor(parseInt(mins / 60));
              hrs = Number(t1[0]*4) + Number(t2[0]) + minhrs;
              mins = mins % 60;
              t1 = hrs + ':' + mins;

              if(sat_on.length > 0){
              var sat = sat_hours * sat_on;
              sat = sat/4;
              console.log(sat);
              var n = new Date(0,0);
              n.setSeconds(+sat * 60 * 60);
              var sat_avg = (n.toTimeString().slice(0, 8));
              }else{

                var sat = sat_hours * (4-sat_off);
                sat = sat/4;
                var n = new Date(0,0);
                n.setSeconds(+sat * 60 * 60);
                var sat_avg = (n.toTimeString().slice(0, 8));
              }

              if(ext_frequency.length > 0){
                var p = "1/1/1970 ";
                difference_ext = new Date(new Date(p+ext_time) - new Date(p+custom_afternoon)).toUTCString().split(" ")[4];
                var arr = difference_ext.split(':');
                var ext_working_hours =  parseFloat(parseInt(arr[0], 10) + '.' + parseInt((arr[1]/6)*10, 10));
                ext_working_hours = ext_working_hours * ext_frequency;
                var n = new Date(0,0);
                n.setSeconds(+ext_working_hours * 60 * 60);
                var ext_avg = (n.toTimeString().slice(0, 8));
                console.log(ext_avg);
              }else{
                var  ext_avg = '00:00:00';
              }

                var time1 = t1;
                var time2 = sat_avg;
                var time3 = ext_avg;
                
                var hour=0;
                var minute=0;
                var second=0;
                
                var splitTime1= time1.split(':');
                var splitTime2= time2.split(':');
                var splitTime3= time3.split(':');

                console.log(splitTime1);
                console.log(splitTime2);
                console.log(splitTime3);

                mins = Number(splitTime1[1]) + Number(splitTime2[1]) + Number(splitTime3[1]);
                minhrs = Math.floor(parseInt(mins / 60));
                hrs = Number(splitTime1[0]) + Number(splitTime2[0]) + Number(splitTime3[0]) + minhrs;
                mins = mins % 60;
                t1 = hrs+':'+mins;
              
              $('#avg_cus_cal').val(t1);

            
            }

            if(custom_friday.length != 0){

              difference = new Date(new Date(p+custom_friday) - new Date(p+custom_morning)).toUTCString().split(" ")[4];
              
              $('#cus_fri_cal').val(difference);
              
            }

        } // Custom End

        // Part Timer

        if(profile_type_id == 3){

            var mon_in = $('#avg_mon_in').val();
            var mon_out = $('#avg_mon_out').val();

            var tue_in =  $('#avg_tue_in').val();
            var tue_out = $('#avg_tue_out').val();

            var wed_in =  $('#avg_wed_in').val();
            var wed_out = $('#avg_wed_out').val();

            var thu_in =  $('#avg_thu_in').val();
            var thu_out = $('#avg_thu_out').val();

            var fri_in =  $('#avg_fri_in').val();
            var fri_out = $('#avg_fri_out').val();

            var sat_in =  $('#avg_sat_in').val();
            var sat_out = $('#avg_sat_out').val();

            if(fri_in.length != 0 && fri_out.length != 0){
            var p = "1/1/1970 ";
            difference = new Date(new Date(p+fri_out) - new Date(p+fri_in)).toUTCString().split(" ")[4];            
            $('#part_time_fri').val(difference);
      }


      // Monday Time Difference Calculation

      var time_out_mon;
      var time_in_mon;

      if(mon_out.length != 0 && mon_in.length != 0){
        time_out_mon = mon_out;
      }else{
        time_out_mon = '00:00:00';
      }

      if(mon_out.length != 0 && mon_in.length != 0){
        time_in_mon = mon_in;
      }else{
        time_in_mon = '00:00:00';
      }

      var p = "1/1/1970 ";
      var difference_mon = new Date(new Date(p+time_out_mon) - new Date(p+time_in_mon)).toUTCString().split(" ")[4];


      // Tuesday Time Difference Calculation

      var time_out_tue;
      var time_in_tue;

      if(tue_out.length != 0 && tue_in.length != 0){
        time_out_tue = tue_out;
      }else{
        time_out_tue = '00:00:00';
      }

      if(tue_out.length != 0 && tue_in.length != 0){
        time_in_tue = tue_in;
      }else{
        time_in_tue = '00:00:00';
      }

      var p = "1/1/1970 ";
      var difference_tue = new Date(new Date(p+time_out_tue) - new Date(p+time_in_tue)).toUTCString().split(" ")[4];


      // Wednesday Time Difference Calculation

      var time_out_wed;
      var time_in_wed;

      if(wed_out.length != 0 && wed_in.length != 0){
        time_out_wed = wed_out;
      }else{
        time_out_wed = '00:00:00';
      }

      if(wed_out.length != 0 && wed_in.length != 0){
        time_in_wed = wed_in;
      }else{
        time_in_wed = '00:00:00';
      }

      var p = "1/1/1970 ";
      var difference_wed = new Date(new Date(p+time_out_wed) - new Date(p+time_in_wed)).toUTCString().split(" ")[4];


      // Thursday Time Difference Calculation

      var time_out_thu;
      var time_in_thu;

      if(thu_out.length != 0 && thu_in.length != 0){
        time_out_thu = thu_out;
      }else{
        time_out_thu = '00:00:00';
      }

      if(thu_out.length != 0 && thu_in.length != 0){
        time_in_thu = thu_in;
      }else{
        time_in_thu = '00:00:00';
      }

      var p = "1/1/1970 ";
      var difference_thu = new Date(new Date(p+time_out_thu) - new Date(p+time_in_thu)).toUTCString().split(" ")[4];


      // Friday Time Difference Calculation

      var time_out_fri;
      var time_in_fri;

      if(fri_out.length != 0 && fri_in.length != 0){
        time_out_fri = fri_out;
      }else{
        time_out_fri = '00:00:00';
      }

      if(fri_out.length != 0 && fri_in.length != 0){
        time_in_fri = fri_in;
      }else{
        time_in_fri = '00:00:00';
      }

      var p = "1/1/1970 ";
      var difference_fri = new Date(new Date(p+time_out_fri) - new Date(p+time_in_fri)).toUTCString().split(" ")[4];


      $('#part_time_avg').val(difference_fri);


      // Saturday Time Difference Calculation

      var time_out_sat;
      var time_in_sat;

      if(sat_out.length != 0 && sat_in.length != 0){
        time_out_sat = sat_out;
      }else{
        time_out_sat = '00:00:00';
      }

      if(sat_out.length != 0 && sat_in.length != 0){
        time_in_sat = sat_in;
      }else{
        time_in_sat = '00:00:00';
      }

      var p = "1/1/1970 ";
      var difference_sat = new Date(new Date(p+time_out_sat) - new Date(p+time_in_sat)).toUTCString().split(" ")[4];


      
      // Calculated Total Average Weekly Hours


       var time1 = difference_mon;
       var time2 = difference_tue;
       var time3 = difference_wed;
       var time4 = difference_thu;
       var time5 = difference_fri;
       var time6 = difference_sat;
        
        var hour=0;
        var minute=0;
        var second=0;
        
        var splitTime1= time1.split(':');
        var splitTime2= time2.split(':');
        var splitTime3= time3.split(':');
        var splitTime4= time4.split(':');
        var splitTime5= time5.split(':');
        var splitTime6= time6.split(':');

        
        mins = Number(splitTime1[1]) + Number(splitTime2[1]) + Number(splitTime3[1]) + Number(splitTime4[1]) + Number(splitTime5[1]) + Number(splitTime6[1]);
        minhrs = Math.floor(parseInt(mins / 60));
        hrs = Number(splitTime1[0]) + Number(splitTime2[0]) + Number(splitTime3[0]) + Number(splitTime4[0]) + Number(splitTime5[0]) + Number(splitTime6[0]) + minhrs;
        mins = mins % 60;
        t1 = hrs+':'+mins;

        var spliting = t1.split(':');
        
        if(spliting[1].length == 1){
          t1 = hrs+':'+'0'+mins;
        }else{
          t1 = hrs+':'+mins;
        }
        $('#part_time_avg').val(t1);



        // Calculated Mon Thursday Hours

        mins = Number(splitTime1[1]) + Number(splitTime2[1]) + Number(splitTime3[1]) + Number(splitTime4[1]);
        minhrs = Math.floor(parseInt(mins / 60));
        hrs = Number(splitTime1[0]) + Number(splitTime2[0]) + Number(splitTime3[0]) + Number(splitTime4[0])  + minhrs;
        mins = mins % 60;
        var mon_thu = hrs+':'+mins;

        var spliting = mon_thu.split(':');
        
        if(spliting[1].length == 1){
          mon_thu = hrs+':'+'0'+mins;
        }else{
          mon_thu = hrs+':'+mins;
        }




      $('#part_time_mon_thu').val(mon_thu);



        } //  End Part Timer


 }


 //======================= Update Allocation ==========================//


  $(document).on('click','.select-staff',function(e){

  
    
    var staff_id = $(this).attr('data-id');
    var profile_id = $(this).attr('data-profile');
    var staff_name = $(this).attr('data-staff_name');
    var profile_type_id = $(this).attr('data-profile_type');

    if($('#TTListing tbody tr').hasClass('selected')){
        $('#TTListing tbody tr').removeClass('selected');
    }
    
    

    if(staff_id != '' && profile_id != '' && profile_type_id >= 1){
    $('.loading').show();

    $.ajax({
      type:"POST",
      cache:false,
      data:{
        staff_id:staff_id,
        profile_id:profile_id,
        staff_name:staff_name
      },
      url:"<?php echo base_url(); ?>index.php/tif_a/profile_allocation_staff_ajax/get_update_allocation",
      success:function(e){
        $('.ProfileDetail').html(e);
        calculating_hours(profile_type_id);
        $('.loading').hide();
        var td = $('#TTListing tbody tr td a[data-id = '+staff_id+']').closest("tr");
        td.addClass('selected');
        
      }
    });
        
    } 
    
 });


  // CALCULATING INLINE EDITABLE  PART TIMER VALUE


  $(document).on('click','#MonIN,#MonOUT,#TueIN,#TueOUT,#WedIN ,#WedOUT,#ThuIN,#ThuOUT,#FriIN,#FriOUT,#SatIN,#SatOUT',function(e){

  var id = e.target.id;

  

  // console.log(id);
  $(document).on('click','.editable-submit',function(f){
    // console.log(f);
      var hour = $('.hour option:selected').val();
      var minute = $('.minute option:selected').val();
      var ampm  = $('.ampm option:selected').val();
      if(minute.length == 1){
        minute = '0'+minute
      }
      var time = hour+':'+minute+':'+ampm;

      var MonIN;
      var MonOut;
      var TueIN;
      var TueOUT;
      var WedIN;
      var WedOUT;
      var ThuIN;
      var ThuOUT;
      var FriIN;
      var FriOUT;
      var SatIN;
      var SatOUT;
       
      
      if(id == 'MonIN'){
        MonIN = time;
        $('#avg_mon_in').val(MonIN);
        id = '';
      }

      if(id == 'MonOUT'){
        MonOut = time;
        $('#avg_mon_out').val(MonOut);
        id = '';
      }

      if(id == 'TueIN'){
        TueIN = time;
        $('#avg_tue_in').val(TueIN);
        id = '';
      }

      if(id == 'TueOUT'){
        TueOUT = time;
        $('#avg_tue_out').val(TueOUT);
        id='';
      }

      if(id == 'WedIN'){
        WedIN = time;
        $('#avg_wed_in').val(WedIN);
        id='';
      }

      if(id == 'WedOUT'){
        WedOUT = time;
        $('#avg_wed_out').val(WedOUT);
        id='';
      }

      if(id == 'ThuIN'){
        ThuIN = time;
        $('#avg_thu_in').val(ThuIN);
        id='';
      }

      if(id == 'ThuOUT'){
        ThuOUT = time;
        $('#avg_thu_out').val(ThuOUT);
        id='';
      }

      if(id == 'FriIN'){
        FriIN = time;
        $('#avg_fri_in').val(FriIN);
        id='';
      }

      if(id == 'FriOUT'){
        FriOUT = time;
        $('#avg_fri_out').val(FriOUT);
        id='';
      }

      if(id == 'SatIN'){
        SatIN = time;
        $('#avg_sat_in').val(SatIN);
        id='';
      }

      if(id == 'SatOUT'){
        SatOUT = time;
        $('#avg_sat_out').val(SatOUT);
        id='';
      }



      var mon_in = $('#avg_mon_in').val();
      var mon_out = $('#avg_mon_out').val();

      var tue_in =  $('#avg_tue_in').val();
      var tue_out = $('#avg_tue_out').val();

      var wed_in =  $('#avg_wed_in').val();
      var wed_out = $('#avg_wed_out').val();

      var thu_in =  $('#avg_thu_in').val();
      var thu_out = $('#avg_thu_out').val();

      var fri_in =  $('#avg_fri_in').val();
      var fri_out = $('#avg_fri_out').val();

      var sat_in =  $('#avg_sat_in').val();
      var sat_out = $('#avg_sat_out').val();

      if(fri_in.length != 0 && fri_out.length != 0){
        var p = "1/1/1970 ";
        difference = new Date(new Date(p+fri_out) - new Date(p+fri_in)).toUTCString().split(" ")[4];            
        $('#part_time_fri').val(difference);
      }


      // Monday Time Difference Calculation

      var time_out_mon;
      var time_in_mon;

      if(mon_out.length != 0 && mon_in.length != 0){
        time_out_mon = mon_out;
      }else{
        time_out_mon = '00:00:00';
      }

      if(mon_out.length != 0 && mon_in.length != 0){
        time_in_mon = mon_in;
      }else{
        time_in_mon = '00:00:00';
      }

      var p = "1/1/1970 ";
      var difference_mon = new Date(new Date(p+time_out_mon) - new Date(p+time_in_mon)).toUTCString().split(" ")[4];


      // Tuesday Time Difference Calculation

      var time_out_tue;
      var time_in_tue;

      if(tue_out.length != 0 && tue_in.length != 0){
        time_out_tue = tue_out;
      }else{
        time_out_tue = '00:00:00';
      }

      if(tue_out.length != 0 && tue_in.length != 0){
        time_in_tue = tue_in;
      }else{
        time_in_tue = '00:00:00';
      }

      var p = "1/1/1970 ";
      var difference_tue = new Date(new Date(p+time_out_tue) - new Date(p+time_in_tue)).toUTCString().split(" ")[4];


      // Wednesday Time Difference Calculation

      var time_out_wed;
      var time_in_wed;

      if(wed_out.length != 0 && wed_in.length != 0){
        time_out_wed = wed_out;
      }else{
        time_out_wed = '00:00:00';
      }

      if(wed_out.length != 0 && wed_in.length != 0){
        time_in_wed = wed_in;
      }else{
        time_in_wed = '00:00:00';
      }

      var p = "1/1/1970 ";
      var difference_wed = new Date(new Date(p+time_out_wed) - new Date(p+time_in_wed)).toUTCString().split(" ")[4];


      // Thursday Time Difference Calculation

      var time_out_thu;
      var time_in_thu;

      if(thu_out.length != 0 && thu_in.length != 0){
        time_out_thu = thu_out;
      }else{
        time_out_thu = '00:00:00';
      }

      if(thu_out.length != 0 && thu_in.length != 0){
        time_in_thu = thu_in;
      }else{
        time_in_thu = '00:00:00';
      }

      var p = "1/1/1970 ";
      var difference_thu = new Date(new Date(p+time_out_thu) - new Date(p+time_in_thu)).toUTCString().split(" ")[4];


      // Friday Time Difference Calculation

      var time_out_fri;
      var time_in_fri;

      if(fri_out.length != 0 && fri_in.length != 0){
        time_out_fri = fri_out;
      }else{
        time_out_fri = '00:00:00';
      }

      if(fri_out.length != 0 && fri_in.length != 0){
        time_in_fri = fri_in;
      }else{
        time_in_fri = '00:00:00';
      }

      var p = "1/1/1970 ";
      var difference_fri = new Date(new Date(p+time_out_fri) - new Date(p+time_in_fri)).toUTCString().split(" ")[4];


      $('#part_time_avg').val(difference_fri);


      // Saturday Time Difference Calculation

      var time_out_sat;
      var time_in_sat;

      if(sat_out.length != 0 && sat_in.length != 0){
        time_out_sat = sat_out;
      }else{
        time_out_sat = '00:00:00';
      }

      if(sat_out.length != 0 && sat_in.length != 0){
        time_in_sat = sat_in;
      }else{
        time_in_sat = '00:00:00';
      }

      var p = "1/1/1970 ";
      var difference_sat = new Date(new Date(p+time_out_sat) - new Date(p+time_in_sat)).toUTCString().split(" ")[4];


      
      // Calculated Total Average Weekly Hours


       var time1 = difference_mon;
       var time2 = difference_tue;
       var time3 = difference_wed;
       var time4 = difference_thu;
       var time5 = difference_fri;
       var time6 = difference_sat;
        
        var hour=0;
        var minute=0;
        var second=0;
        
        var splitTime1= time1.split(':');
        var splitTime2= time2.split(':');
        var splitTime3= time3.split(':');
        var splitTime4= time4.split(':');
        var splitTime5= time5.split(':');
        var splitTime6= time6.split(':');

        
        mins = Number(splitTime1[1]) + Number(splitTime2[1]) + Number(splitTime3[1]) + Number(splitTime4[1]) + Number(splitTime5[1]) + Number(splitTime6[1]);
        minhrs = Math.floor(parseInt(mins / 60));
        hrs = Number(splitTime1[0]) + Number(splitTime2[0]) + Number(splitTime3[0]) + Number(splitTime4[0]) + Number(splitTime5[0]) + Number(splitTime6[0]) + minhrs;
        mins = mins % 60;
        t1 = hrs+':'+mins;

        var spliting = t1.split(':');
        
        if(spliting[1].length == 1){
          t1 = hrs+':'+'0'+mins;
        }else{
          t1 = hrs+':'+mins;
        }
        $('#part_time_avg').val(t1);



        // Calculated Mon Thursday Hours

        mins = Number(splitTime1[1]) + Number(splitTime2[1]) + Number(splitTime3[1]) + Number(splitTime4[1]);
        minhrs = Math.floor(parseInt(mins / 60));
        hrs = Number(splitTime1[0]) + Number(splitTime2[0]) + Number(splitTime3[0]) + Number(splitTime4[0])  + minhrs;
        mins = mins % 60;
        var mon_thu = hrs+':'+mins;

        var spliting = mon_thu.split(':');
        
        if(spliting[1].length == 1){
          mon_thu = hrs+':'+'0'+mins;
        }else{
          mon_thu = hrs+':'+mins;
        }




      $('#part_time_mon_thu').val(mon_thu);




  });

});

    // ==========================================================// 
    //==========Working Hours Calculated in Custom Profile ======//
    //===========================================================//

 $(document).on('change','#cus_morning,#cus_afternoon,#cus_fri,#cus_ext,#cus_frequency,#cus_sat_hrs,#cus_off,#cus_working',function(e){
    var profile_type_id = $('#profile_type_id').val();
    calculating_hours(profile_type_id);
 });

 $(document).on('change','#cus_afternoon',function(e){

    var cus_afternoon = $(this).val();
    if(cus_afternoon.length > 0){
      $('#cus_fri').val(cus_afternoon);
    }
 });

   // Custom Profile Update

$(document).on('keypress change','#cus_off,#cus_working',function(e){

    var sat_off = $('#cus_off').val();
    var sat_on = $('#cus_working').val();

    if(sat_off != ''){
      $("#cus_working").attr('disabled','disabled');
    }

    if(sat_on != ''){
      $('#cus_off').attr('disabled','disabled');
    }

    if(sat_off == '' && sat_on == ''){
      $("#cus_off").removeAttr('disabled');
      $("#cus_working").removeAttr('disabled');
    }

});


$(document).on('click','#updated_allocated_profile',function(e){
   var updated_id = $('#update_id').val();
   var profile_type_id = $('#profile_type_id').val();



    var $form = $('#updated_staff_allocation');
    var validator = $form.validate({

      rules:{
        cus_morning : "required",
        cus_afternoon:"required",
        
      },
      messages:{

        cus_morning: "Enter Time",
        cus_afternoon:"Enter Time"

      },


    });




    //validate the form
    validator.form();

  if(profile_type_id == 2 && $form.valid() ){

    var morning_time = $('#cus_morning').val();
    var afternoon_time = $('#cus_afternoon').val();
    var wed_timeout = $('#cus_wed').val();
    var fri_timeout = $('#cus_fri').val();
    var ext_time = $('#cus_ext').val();
    var ext_frequency =  $('#cus_frequency').val();
    var ext_july = $('#cus_july').val();
    var sat_hrs = $('#cus_sat_hrs').val();
    var sat_off = $('#cus_off').val();
    var sat_working = $('#cus_working').val();
    var avg_hrs = $('#avg_cus_cal').val();

 

    $.ajax({
        type:"POST",
        cache:false,
        data:{
          morning_time:morning_time,
          afternoon_time:afternoon_time,
          wed_timeout:wed_timeout,
          fri_timeout:fri_timeout,
          ext_time:ext_time,
          ext_frequency:ext_frequency,
          ext_july:ext_july,
          sat_hrs:sat_hrs,
          sat_off:sat_off,
          sat_working:sat_working,
          updated_id:updated_id,
          avg_hrs:avg_hrs
        },
        url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_staff_ajax/updated_custom_profile",
        success:function(e){
          
          // Success Function 
          $('.alert-success').css('display','');
          $('.alert-success').fadeOut(5000);
        }
      });



  } // END CUSTOM 

  if(profile_type_id == 3 && $form.valid() ){

      var mon_in = $('#MonIN').text();
      var mon_out = $('#MonOUT').text();
      var tue_in = $('#TueIN').text();
      var tue_out = $('#TueOUT').text();
      var wed_in = $('#WedIN').text();
      var wed_out = $('#WedOUT').text();
      var thu_in = $('#ThuIN').text();
      var thu_out = $('#ThuOUT').text();
      var fri_in = $('#FriIN').text();
      var fri_out = $('#FriOUT').text();
      var sat_in = $('#SatIN').text();
      var sat_out = $('#SatOUT').text();
      
           
      $.ajax({
        type:"POST",
        cache:false,
        data:{
        mon_in:mon_in,
        mon_out:mon_out,
        tue_in:tue_in,
        tue_out:tue_out,
        wed_in:wed_in,
        wed_out:wed_out,
        thu_in:thu_in,
        thu_out:thu_out,
        fri_in:fri_in,
        fri_out:fri_out,
        sat_in:sat_in,
        sat_out:sat_out,
        updated_id:updated_id
        },
        url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_staff_ajax/update_partTime_profile",
        success:function(e){

          // Success Function 
          $('.alert-success').css('display','');
          $('.alert-success').fadeOut(5000);
        }
      });

  } // END PART TIMER


});


 // Refresh to Intial Page

 $(document).on('click','#refresh',function(){
  // alert('r');
      if($('#TTListing tbody tr').hasClass('selected')){
        $('#TTListing tbody tr').removeClass('selected');
    }
  $.ajax({
    type:"POST",
    cache:false,
    url:"<?php echo base_url(); ?>index.php/tif_a/profile_allocation_staff_ajax/get_refresh",
    success:function(e){
      $('.ProfileDetail').html(e);
    }
  });
 });




</script>

<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/bootstrap/bootstrap.min.js"></script> 


<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/bootstrap-editable.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/demo.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/demo-mock.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/select2.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/address.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/jquery.mockjax.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/moment.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/typeahead.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/typeaheadjs.js"></script>







