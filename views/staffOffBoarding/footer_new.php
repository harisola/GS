

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
          url: "<?php echo site_url()?>/staff_information_form_basic/Staff_Offboarding/getStaff_OffBoarding",
          type: "post",
          data: {
              GTID: GTID,
          },
          success: function (response) {
            $('#staffTIFA').html(response);
            /***** Section / Department *****/
            $('#SD_PlannersReturned').bootstrapToggle();
            $('#SD_InductionManualReturned').bootstrapToggle();
            $('#SD_RecordKeepingRegReturned').bootstrapToggle();
            $('#SD_AtdRegReturned').bootstrapToggle();
            $('#SD_QBankReturned').bootstrapToggle();
            $('#SD_AllKeysReturned').bootstrapToggle();
            $('#SD_AllFilesHandedOver').bootstrapToggle();
            $('#SD_AnyOtherMatReturned').bootstrapToggle();

            /***** Library Books Returned *****/
            $('#LB_Returned').bootstrapToggle();

            /***** Library Books Returned *****/
            $('#FN_LoanBalance').bootstrapToggle();
            $('#FN_AdvAmount').bootstrapToggle();
            $('#FN_PFContribution').bootstrapToggle();
            $('#FN_CPDOutstanding').bootstrapToggle();
            $('#FN_ChildFee').bootstrapToggle();
            $('#FN_ChildSDReceivable').bootstrapToggle();

            /***** HR *****/
            $('#HR_TakafulOpted').bootstrapToggle();
            $('#HR_PrimaryInductionBooklet').bootstrapToggle();
            $('#HR_SmartCard').bootstrapToggle();
            $('#HR_VehicleSticker').bootstrapToggle();
            $('#HR_SuspendImmediately').bootstrapToggle();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            $('#staffTIFA').html('Something went wrong! please try later.');
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










   $(document).on("click","#greenBTN",function() {
      var GTID = $('#GTID').val();
      /***** Basic Profile *****/
      var BP_LastWD = $('#BP_LastWD').val();
      var BP_NoticePeriod = $('#BP_NoticePeriod').val();
      var BP_DateOfResignation = $('#BP_DateOfResignation').val();

      /***** Section / Department *****/
      var SD_PlannersReturned = 0;
      var SD_InductionManualReturned = 0;
      var SD_RecordKeepingRegReturned = 0;
      var SD_AtdRegReturned = 0;
      var SD_QBankReturned = 0;
      var SD_AllKeysReturned = 0;
      var SD_AllFilesHandedOver = 0;
      var SD_AnyOtherMatReturned = 0;
      var SD_Comments = $('#SD_Comments').val();
      if($("#SD_PlannersReturned").is(':checked')){ SD_PlannersReturned = 1; } 
      if($("#SD_InductionManualReturned").is(':checked')){ SD_InductionManualReturned = 1; } 
      if($("#SD_RecordKeepingRegReturned").is(':checked')){ SD_RecordKeepingRegReturned = 1; } 
      if($("#SD_AtdRegReturned").is(':checked')){ SD_AtdRegReturned = 1; } 
      if($("#SD_QBankReturned").is(':checked')){ SD_QBankReturned = 1; } 
      if($("#SD_AllKeysReturned").is(':checked')){ SD_AllKeysReturned = 1; } 
      if($("#SD_AllFilesHandedOver").is(':checked')){ SD_AllFilesHandedOver = 1; } 
      if($("#SD_AnyOtherMatReturned").is(':checked')){ SD_AnyOtherMatReturned = 1; } 

      /***** Library *****/
      var LB_Section = $('#LB_Section').val();
      var LB_Returned = 0;
      var LB_Amount = $('#LB_Amount').val();
      var LB_TitleOfBooks = $('#LB_TitleOfBooks').val();
      if($("#LB_Returned").is(':checked')){ LB_Returned = 1; }

      /***** Finance *****/
      var FN_LoanBalance = 0;
      var FN_AdvAmount = 0;
      var FN_PFContribution = 0;
      var FN_CPDOutstanding = 0;
      var FN_ChildFee = 0;
      var FN_ChildSDReceivable = 0;
      var FN_Comments = $('#FN_Comments').val();
      if($("#FN_LoanBalance").is(':checked')){ FN_LoanBalance = 1; }
      if($("#FN_AdvAmount").is(':checked')){ FN_AdvAmount = 1; }
      if($("#FN_PFContribution").is(':checked')){ FN_PFContribution = 1; }
      if($("#FN_CPDOutstanding").is(':checked')){ FN_CPDOutstanding = 1; }
      if($("#FN_ChildFee").is(':checked')){ FN_ChildFee = 1; }
      if($("#FN_ChildSDReceivable").is(':checked')){ FN_ChildSDReceivable = 1; }

      /***** HR *****/
      var HR_TakafulOpted = 0;
      var HR_PrimaryInductionBooklet = 0;
      var HR_SmartCard = 0;
      var HR_VehicleSticker = 0;
      var HR_SuspendImmediately = 0;
      var HR_Amount = $('#HR_Amount').val();
      var HR_FamilySize = $('#HR_FamilySize').val();
      var HR_GSEmail = $('#HR_GSEmail').val();
      var HR_PortalID = $('#HR_PortalID').val();
      var HR_SuspendAfter = $('#HR_SuspendAfter').val();
      if($("#HR_TakafulOpted").is(':checked')){ HR_TakafulOpted = 1; }
      if($("#HR_PrimaryInductionBooklet").is(':checked')){ HR_PrimaryInductionBooklet = 1; }
      if($("#HR_SmartCard").is(':checked')){ HR_SmartCard = 1; }
      if($("#HR_VehicleSticker").is(':checked')){ HR_VehicleSticker = 1; }
      if($("#HR_SuspendImmediately").is(':checked')){ HR_SuspendImmediately = 1; }



      

      $.ajax({
          url: "<?php echo site_url()?>/staff_information_form_basic/Staff_Offboarding/saveOffBoardingForm",
          type: "post",
          data: {
            GTID: GTID,
            BP_LastWD: BP_LastWD,
            BP_NoticePeriod: BP_NoticePeriod,
            BP_DateOfResignation: BP_DateOfResignation,

            SD_PlannersReturned: SD_PlannersReturned,
            SD_InductionManualReturned: SD_InductionManualReturned,
            SD_RecordKeepingRegReturned: SD_RecordKeepingRegReturned,
            SD_AtdRegReturned: SD_AtdRegReturned,
            SD_QBankReturned: SD_QBankReturned,
            SD_AllKeysReturned: SD_AllKeysReturned,
            SD_AllFilesHandedOver: SD_AllFilesHandedOver,
            SD_AnyOtherMatReturned: SD_AnyOtherMatReturned,
            SD_Comments: SD_Comments,

            LB_Section: LB_Section,
            LB_Returned: LB_Returned,
            LB_Amount: LB_Amount,
            LB_TitleOfBooks: LB_TitleOfBooks,

            FN_LoanBalance: FN_LoanBalance,
            FN_AdvAmount: FN_AdvAmount,
            FN_PFContribution: FN_PFContribution,
            FN_CPDOutstanding: FN_CPDOutstanding,
            FN_ChildFee: FN_ChildFee,
            FN_ChildSDReceivable: FN_ChildSDReceivable,
            FN_Comments: FN_Comments,

            HR_TakafulOpted: HR_TakafulOpted,
            HR_PrimaryInductionBooklet: HR_PrimaryInductionBooklet,
            HR_SmartCard: HR_SmartCard,
            HR_VehicleSticker: HR_VehicleSticker,
            HR_SuspendImmediately: HR_SuspendImmediately,
            HR_Amount: HR_Amount,
            HR_FamilySize: HR_FamilySize,
            HR_GSEmail: HR_GSEmail,
            HR_PortalID: HR_PortalID,
            HR_SuspendAfter: HR_SuspendAfter,
          },
          success: function (response) {
            $("#alert_div").addClass("alert alert-success");
            $('#alert_div').html(response);
            $("#alert_div").fadeIn( 100 );
            $("html, body").animate({ scrollTop: 0 }, 50);
            $("#alert_div").fadeTo(5000,1).fadeOut(1000);
            setTimeout(function() {
                $('#alert_div-read').removeClass('alert alert-success');
            },6000);
          },
          error: function(jqXHR, textStatus, errorThrown) {
            $('#alert_div').html('Something went wrong! please try later.');
          }
      });
   });
   
</script>
</body>
</html>