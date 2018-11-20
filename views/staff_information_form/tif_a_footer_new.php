

<!--Forms-->

<!--Panel Question Modal-->
<div class="modal fade" id="alreadySubmitted">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header"> Campus<i class="fa fa-question"></i>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
      <div class="modal-body text-center"> Please Choose Campus </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 





<!--Datatables-->
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/datatables/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/datatables/jquery.dataTables-bootstrap.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/datatables/dataTables.colVis.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/datatables/colvis.extras.js"></script> 


<!--X-Editable--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/bootstrap-editable.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/demo.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/demo-mock.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/select2.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/address.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/jquery.mockjax.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/moment.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/select2-bootstrap.css"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/typeahead.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/typeaheadjs.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>components/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>components/js/dataTables.tableTools.min.js"></script>





<script type="text/javascript">



$('#EntitityListing').dataTable({
      "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
    "aLengthMenu": [[50, 60, 70, -1], [50, 60, 70, "All"]],
    "iDisplayLength": 50
  });
  
$('#BadgeAllocation').dataTable({
      "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
    "iDisplayLength": 10,
  "bLengthChange": false,
  "bInfo" : false,
  });
$('#BadgeList').dataTable({
      "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
    "iDisplayLength": 10,
  "bLengthChange": false,
  "bInfo" : false,
  });





  isDown = false;
  $(document).ready(function(){
    $('#EntitityListing_wrapper').scroll(function() {
       var scroll = $('#EntitityListing_wrapper').scrollTop();

       if(scroll >= 100 && !isDown){  
         $( ".a" ).addClass( "hide" ); 
         $( ".b" ).addClass( "show" );     
        //alert('going down');
        isDown = true;
       }else if(scroll < 100 && isDown){
          $( ".a" ).removeClass( "hide" );
          $( ".b" ).removeClass( "show" );
          isDown = false;
          //alert('going up');
       }
       //alert(scroll);
    });
  });
</script>






<link rel="stylesheet" href="/application/views/staff_information_form/style/jquery-ui.css">
<script src="/application/views/staff_information_form/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script>


<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/custom.js"></script>





<script type="text/javascript">
   $(document).on("click",".data-gt_id a ",function() {
      var GTID = $(this).data('original-title');
      GTID = GTID.substr(GTID.length - 6);
      $('#staffTIFA').html('Loading... Please wait');

      /***** Selecting Row *****/
      $('#EntitityListing tr').removeClass("selected");
      var selectedRow = '#row-'+GTID;
      $(selectedRow).addClass('selected');




      /***** Posting GT-ID and retrieving data ****/
      $.ajax({
          url: "<?php echo site_url()?>/staff_information_form_basic/viewtifa/getStaff_tifA",
          type: "post",
          data: {
              GTID: GTID,
          },
          success: function (response) {
            $('#staffTIFA').html(response);
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Something went wrong! please try later.');
          }
      });
   });






   $(document).on("click","#apply_filters",function() {
      var Department = [];
      var Sections = [];

      $.each($("#department option:selected"), function(){            
          Department.push($(this).val());
      });

      $.each($("#sections option:selected"), function(){            
          Sections.push($(this).val());
      });


      $.ajax({
          url: "<?php echo site_url()?>/staff_information_form_basic/viewtifa/getStaffListing",
          type: "post",
          data: {
              department: Department.join(","),
              section: Sections.join(","),
          },
          success: function (response) {
            $('#staff_listing_body').html(response);
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Something went wrong! please try later.');
          }
      });
   });










   $(document).on('change', '#soflow', function() {
    var StaffID = $( this ).val();
    var $row = $('#staff_listing_body tr.selected').closest("tr");    // Find the row
    var GTID = $row.find("td:nth-child(2)").text(); // Find the text
    GTID = GTID.substr(GTID.length - 6);
    $.ajax({
        url: "<?php echo site_url()?>/staff_information_form_basic/viewtifa/updateMatrixFR",
        type: "post",
        data: {
            GTID: GTID,
            StaffID: StaffID
        },
        success: function (response) {
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Something went wrong! please try later.');
        }
    });
  });
   
</script>
</body>
</html>