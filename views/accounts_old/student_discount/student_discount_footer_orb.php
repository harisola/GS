    </div>
    <!-- All Complete and Close -->
  </div>
  <!--/MainWrapper--> 
</div>
<!--/Smooth Scroll--> 
<!--Modals--> 
 
<!--Panel Question Modal-->
<div class="modal fade" id="panel-question">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <i class="fa fa-question"></i> </div>
      <div class="modal-body text-center">How Do you Do?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 

<!--Power Widgets Modal-->
<div class="modal" id="delete-widget">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <i class="fa fa-lock"></i> </div>
      <div class="modal-body text-center">
        <p>Are you sure to delete this widget?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="trigger-deletewidget-reset">Cancel</button>
        <button type="button" class="btn btn-primary" id="trigger-deletewidget">Delete</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 

<!--Sign Out Dialog Modal-->
<div class="modal" id="signout">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <i class="fa fa-lock"></i> </div>
      <div class="modal-body text-center">Are You Sure Want To Log Out?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="yesigo">Ok</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 

<!--Lock Screen Dialog Modal-->
<div class="modal" id="lockscreen">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <i class="fa fa-lock"></i> </div>
      <div class="modal-body text-center">Are You Sure Want To Lock Screen?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="yesilock">Ok</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 

<!--Scripts--> 

<!--GMaps-->
<!-- 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
-->

<!--JQuery--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/jquery/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/jquery/jquery-ui.min.js"></script> 

<?php
    if($this->data['can_user_view'] == 1  || $this->data['can_user_add'] ==1 || $this->data['can_user_print'] == 1 || $this->data['can_user_export'] ==1 ||
    $this->data['can_user_edit'] == 1 || $this->data['can_user_delete'] == 1 || $this->data['can_user_approve'] == 1)
{ ?>
<!-- Select 2 -->
<script src="<?php echo base_url()?>components/select2/select2.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#select_position_tags").select2();
  });
</script>
<?php } ?>

<!-- <script>
var highestCol = Math.max($('#element1').height(),$('#element2').height());
$('.elements').height(highestCol);
</script> -->


<!--GMap--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/gmap/jquery.gmap.js"></script> 

<!--Fullscreen--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/fullscreen/screenfull.min.js"></script> 

<!--Forms-->
<?php
    if($this->data['can_user_view'] == 1  || $this->data['can_user_add'] ==1 || $this->data['can_user_print'] == 1 || $this->data['can_user_export'] ==1 ||
    $this->data['can_user_edit'] == 1 || $this->data['can_user_delete'] == 1 || $this->data['can_user_approve'] == 1)
{ ?>
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script> 
<?php } ?>

<!--NanoScroller--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/nanoscroller/jquery.nanoscroller.min.js"></script> 

<!--Sparkline--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/sparkline/jquery.sparkline.min.js"></script> 

<!--Horizontal Dropdown--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/horisontal/cbpHorizontalSlideOutMenu.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/classie/classie.js"></script> 

<?php
    if($this->data['can_user_view'] == 1  || $this->data['can_user_add'] ==1 || $this->data['can_user_print'] == 1 || $this->data['can_user_export'] ==1 ||
    $this->data['can_user_edit'] == 1 || $this->data['can_user_delete'] == 1 || $this->data['can_user_approve'] == 1)
{ ?> 
<!--Datatables-->
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/datatables/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/datatables/jquery.dataTables-bootstrap.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/datatables/dataTables.colVis.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/datatables/colvis.extras.js"></script> 
<?php } ?>


<!--PowerWidgets--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/powerwidgets/powerwidgets.js"></script> 

<!--Bootstrap--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/bootstrap/bootstrap.min.js"></script> 

<!--Bootstrap Hover Dropdown - Uncomment this if you want to open dropdowns on mouse hover
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>

<script>
// Menu hover dropdown effect
$('.dropdown-toggle').dropdownHover().dropdown();
$(document).on('click', '.orbmm .dropdown-menu', function(e) {
    e.stopPropagation()
})

</script>--> 

<?php
    if($this->data['can_user_view'] == 1  || $this->data['can_user_add'] ==1 || $this->data['can_user_print'] == 1 || $this->data['can_user_export'] ==1 ||
    $this->data['can_user_edit'] == 1 || $this->data['can_user_delete'] == 1 || $this->data['can_user_approve'] == 1)
{ ?> 
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
<?php } ?>

<!--ToDo--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/todos/todos.js"></script> 

<!--FitVids--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/fitvids/jquery.fitvids.js"></script> 

<!--Main App--> 
<script type="text/javascript">
//ORB JavaScript
// DOM Preload
(function ($) {

    "use strict";

    TableTools.BUTTONS.copy_to_div = {
        "sAction": "text",
        "sTag": "default",
        "sFieldBoundary": "",
        "sFieldSeperator": "\t",
        "sNewLine": "<br>",
        "sToolTip": "",
        "sButtonClass": "DTTT_button_text",
        "sButtonClassHover": "DTTT_button_text_hover",
        "sButtonText": "Copy to element",        
        "mColumns": "all",
        "bHeader": true,
        "bFooter": true,
        "sDiv": "",
        "fnMouseover": null,
        "fnMouseout": null,
        "fnClick": function( nButton, oConfig ) {
            document.getElementById(oConfig.sDiv).innerHTML =
                this.fnGetTableData(oConfig);
        },
        "fnSelect": null,
        "fnComplete": null,
        "fnInit": null
    };

    $(document).ready(function () {

        // Student Information
        $('.student_discount_aug').editable({
            type: 'text',
            name: 'aug',
            title: 'Student Discount for Aug',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_sep').editable({
            type: 'text',
            name: 'sep',
            title: 'Student Discount for Sep',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_oct').editable({
            type: 'text',
            name: 'oct',
            title: 'Student Discount for Oct',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_nov').editable({
            type: 'text',
            name: 'nov',
            title: 'Student Discount for Nov',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_dec').editable({
            type: 'text',
            name: 'dec',
            title: 'Student Discount for Dec',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_jan').editable({
            type: 'text',
            name: 'jan',
            title: 'Student Discount for Jan',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_feb').editable({
            type: 'text',
            name: 'feb',
            title: 'Student Discount for Feb',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_mar').editable({
            type: 'text',
            name: 'mar',
            title: 'Student Discount for Mar',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_apr').editable({
            type: 'text',
            name: 'apr',
            title: 'Student Discount for Apr',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_may').editable({
            type: 'text',
            name: 'may',
            title: 'Student Discount for May',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_jun').editable({
            type: 'text',
            name: 'jun',
            title: 'Student Discount for Jun',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_jul').editable({
            type: 'text',
            name: 'jul',
            title: 'Student Discount for Jul',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_abridged_name a').editable({
            type: 'text',
            name: 'abridged_name',
            title: 'Student Abridged Name',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit2',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_call_name a').editable({
            type: 'text',
            name: 'call_name',
            title: 'Student Call Name',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit2',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_nationality a').editable({
            type: 'text',
            name: 'nationality_1',
            title: 'Student Nationality',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit2',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_dob a').editable({
            type: 'text',
            name: 'dob',
            title: 'Student Date of Birth',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit2',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_mobile_phone a').editable({
            type: 'text',
            name: 'mobile_phone',
            title: 'Student Mobile Phone',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit2',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.student_mobile_phone a').on('shown', function(e, editable) {
            $(this).data('editable').input.$input.mask('0999-9999999');
        });

        $('.student_email a').editable({
            type: 'text',
            name: 'email',
            title: 'Student Email Address',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit2',
            validate: function(value) {
               if(isValidEmailAddress(value) == '') return 'Valid email is required';
            }
        });




        // Family Home & Primary Contact Info        
        $('.family_home_apartmentno a').editable({
            type: 'text',
            name: 'apartment_no',
            title: 'Home Apartment No',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit3'
        });

        $('.family_home_plotno a').editable({
            type: 'text',
            name: 'plot_no',
            title: 'Home Plot No',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit3'
        });

        $('.family_home_phoneno a').editable({
            type: 'text',
            name: 'phone',
            title: 'Home Phone Number',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit3'            
        });
        $('.family_home_phoneno a').on('shown', function(e, editable) {
            $(this).data('editable').input.$input.mask('0999-9999999');
        });
        
        $('.family_home_buildingname a').editable({
            type: 'text',
            name: 'building_name',
            title: 'Home Building Name',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit3'
        });
        
        $('.home_primary_mobile a').editable({
            name: 'primary_phone',
            title: 'Primary Phone Contact',
            source: [
                {value: 'Father', text: 'Father'},
                {value: 'Mother', text: 'Mother'},
                {value: 'Both', text: 'Both'}
            ],
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit3',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';                   
            }
        });

        $('.home_primary_sms a').editable({
            name: 'primary_sms',
            title: 'Primary SMS Contact',
            source: [
                {value: 'Father', text: 'Father'},
                {value: 'Mother', text: 'Mother'},
                {value: 'Both', text: 'Both'}
            ],
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit3',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';                   
            }
        });

        $('.home_primary_email a').editable({
            name: 'primary_email',
            title: 'Primary Email Contact',
            source: [
                {value: 'Father', text: 'Father'},
                {value: 'Mother', text: 'Mother'},
                {value: 'Both', text: 'Both'}
            ],
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit3',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';                   
            }
        });

        $('.family_home_streetname a').editable({
            type: 'text',
            name: 'street_name',
            title: 'Home Street Name',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit3'
        });

        $('.family_home_subregion a').editable({
            type: 'text',
            name: 'sub_region',
            title: 'Home Subregion',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit3'
        });

        $('.family_home_region a').editable({
            type: 'text',
            name: 'region',
            title: 'Home Region',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit3'
        });

        $('.family_home_city a').editable({
            type: 'text',
            name: 'city',
            title: 'Home City Name',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit3'
        });



        
        // Parent Information  --- Father
        $('.parent_father_name a').editable({
            type: 'text',
            name: 'name',
            title: 'Father Name',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_father_nationality1 a').editable({
            type: 'text',
            name: 'nationality_1',
            title: 'Father Nationality',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_father_nationality2 a').editable({
            type: 'text',
            name: 'nationality_2',
            title: 'Father Nationality',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });        
        $('.parent_father_nic a').editable({
            type: 'text',
            name: 'nic',
            title: 'Father CNIC',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_father_nic a').on('shown', function(e, editable) {
            $(this).data('editable').input.$input.mask('99999-9999999-9');
        });
        $('.parent_father_mobilephone a').editable({
            type: 'text',
            name: 'mobile_phone',
            title: 'Father Mobile Phone',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4'            
        });
        $('.parent_father_mobilephone a').on('shown', function(e, editable) {
            $(this).data('editable').input.$input.mask('0999-9999999');
        });
        $('.parent_father_profession a').editable({
            type: 'text',
            name: 'profession',
            title: 'Father Profession',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_father_speciality a').editable({
            type: 'text',
            name: 'speciality',
            title: 'Father Speciality',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_father_email a').editable({
            type: 'text',
            name: 'email',
            title: 'Father Email Address',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4',
            validate: function(value) {
               if(isValidEmailAddress(value) == '') return 'Valid email is required';
            }
        });        
        $('.parent_marital_status a').editable({
            name: 'marital_status',
            title: 'Marital Status',
            source: [
                {value: 'Married', text: 'Married'},
                {value: 'Divorced', text: 'Divorced'}                
            ],
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';                   
            }
        });






        // Parent Information  --- Mother
        $('.parent_mother_name a').editable({
            type: 'text',
            name: 'name',
            title: 'Mother Name',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_mother_nationality1 a').editable({
            type: 'text',
            name: 'nationality_1',
            title: 'Mother Nationality',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_mother_nationality2 a').editable({
            type: 'text',
            name: 'nationality_2',
            title: 'Mother Nationality',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });        
        $('.parent_mother_nic a').editable({
            type: 'text',
            name: 'nic',
            title: 'Mother CNIC',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_mother_nic a').on('shown', function(e, editable) {
            $(this).data('editable').input.$input.mask('99999-9999999-9');
        });
        $('.parent_mother_mobilephone a').editable({
            type: 'text',
            name: 'mobile_phone',
            title: 'Mother Mobile Phone',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4'            
        });
        $('.parent_mother_mobilephone a').on('shown', function(e, editable) {
            $(this).data('editable').input.$input.mask('0999-9999999');
        });
        $('.parent_mother_profession a').editable({
            type: 'text',
            name: 'profession',
            title: 'Mother Profession',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_mother_speciality a').editable({
            type: 'text',
            name: 'speciality',
            title: 'Mother Speciality',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_mother_email a').editable({
            type: 'text',
            name: 'email',
            title: 'Mother Email Address',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit4',
            validate: function(value) {
               if(isValidEmailAddress(value) == '') return 'Valid email is required';
            }
        });




        // Parent Qualification
        $('.parent_q_level a').editable({
            type: 'text',
            name: 'level',
            title: 'Highest Qualification Level',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit6',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });        
        $('.parent_q_title a').editable({
            type: 'text',
            name: 'title',
            title: 'Highest Qualification Title',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit6',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_q_institute a').editable({
            type: 'text',
            name: 'institute',
            title: 'Highest Qualification Institute',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit6',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_q_yoc a').editable({
            type: 'text',
            name: 'year_of_completion',
            title: 'Highest Qualification Completion Year',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit6',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_q_yoc a').on('shown', function(e, editable) {
            $(this).data('editable').input.$input.mask('9999');
        });




        // Parent Work Detail
        $('.parent_work_org a').editable({
            type: 'text',
            name: 'organization',
            title: 'Organization',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit7',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_work_dept a').editable({
            type: 'text',
            name: 'department',
            title: 'Department',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit7',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_work_desg a').editable({
            type: 'text',
            name: 'designation',
            title: 'designation',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit7',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_work_phone a').editable({
            type: 'text',
            name: 'phone',
            title: 'Work Phone',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit7',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_work_address a').editable({
            type: 'text',
            name: 'address',
            title: 'Work Address',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit7',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.parent_work_region a').editable({
            type: 'text',
            name: 'region',
            title: 'Work Regionl',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit7',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });





        
        // Family Emergency Contact Information
        $('.family_ec_name a').editable({
            type: 'text',
            name: 'name',
            title: 'Emergency Contact Person Name',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit5',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.family_ec_email a').editable({
            type: 'text',
            name: 'email',
            title: 'Emergency Contact Person Email',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit5',
            validate: function(value) {
               if(isValidEmailAddress(value) == '') return 'Valid email is required';
            }
        });
        $('.family_ec_phone a').editable({
            type: 'text',
            name: 'phone',
            title: 'Emergency Contact Person Phone',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit5',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.family_ec_phone a').on('shown', function(e, editable) {
            $(this).data('editable').input.$input.mask('0999-9999999');
        });
        $('.family_ec_relationship a').editable({
            type: 'text',
            name: 'relationship',
            title: 'Emergency Contact Person Relationship',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit5',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        $('.family_ec_homeaddress a').editable({
            type: 'text',
            name: 'home_address',
            title: 'Emergency Contact Person Home Address',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit5',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });
        



        // Preload DOM of Inbox functions:
        inbox();

        // ========================================================================
        //  Togglers
        // ========================================================================

        // toogle sidebar
        $('.left-toggler').click(function (e) {            
            $(".responsive-admin-menu").toggleClass("sidebar-toggle");            
            $(".content-wrapper").toggleClass("main-content-toggle-left");                        
            e.preventDefault();
        });

        // toogle sidebar
        $('.right-toggler').click(function (e) {
            $(".main-wrap").toggleClass("userbar-toggle");
            e.preventDefault();
        });

        // toogle chatbar
        $('.chat-toggler').click(function (e) {
            $(".chat-users-menu").toggleClass("chatbar-toggle");
            e.preventDefault();
        });

        // Toggle Chevron in Bootstrap Collapsible Panels
        $('.btn-close').click(function (e) {
            e.preventDefault();
            $(this).parent().parent().parent().fadeOut();
        });

        $('.btn-minmax').click(function (e) {
            e.preventDefault();
            var $target = $(this).parent().parent().next('.panel-body');
            if ($target.is(':visible')) $('i', $(this)).removeClass('fa fa-chevron-circle-up').addClass('fa fa-chevron-circle-down');
            else $('i', $(this)).removeClass('fa-chevron-circle-down').addClass('fa fa-chevron-circle-up');
            $target.slideToggle();
        });
        $('.btn-question').click(function (e) {
            e.preventDefault();
            $('#myModal').modal('show');
        });

        if ($('#megamenuCarousel').length) {
            $('#megamenuCarousel').carousel()
        }




        // ========================================================================
        //  JQuery FitVids Init (js\vendors\fitvids)
        // ========================================================================

        if ($('.vidz').length) {
            $(".vidz").fitVids();
        }
        

        // ========================================================================
        //  Powerwidgets (js\vendors\powerwidgets)
        // ========================================================================

        if ($('#powerwidgets').length) {
            $('#powerwidgets').powerWidgets({
                grid: '.bootstrap-grid',
                widgets: '.powerwidget',
                localStorage: true,
                deleteSettingsKey: '#deletesettingskey-options',
                settingsKeyLabel: 'Reset settings?',
                deletePositionKey: '#deletepositionkey-options',
                positionKeyLabel: 'Reset position?',
                sortable: true,
                buttonsHidden: false,
                toggleButton: true,
                toggleClass: 'fa fa-chevron-circle-up | fa fa-chevron-circle-down',
                toggleSpeed: 200,
                onToggle: function () {},
                deleteButton: true,
                deleteClass: 'fa fa-times-circle',
                onDelete: function (widget) {
                    $('#delete-widget').modal(); // shows the modal
                    $(widget).addClass('deletethiswidget'); // ads an indicator class which we will use to find the widget
                },
                editButton: true,
                editPlaceholder: '.powerwidget-editbox',
                editClass: 'fa fa-cog | fa fa-cog',
                editSpeed: 200,
                onEdit: function () {},
                fullscreenButton: true,
                fullscreenClass: 'fa fa-arrows-alt | fa fa-arrows-alt',
                fullscreenDiff: 3,
                onFullscreen: function () {},
                buttonOrder: '%refresh% %delete% %edit% %fullscreen% %toggle%',
                opacity: 1.0,
                dragHandle: '> header',
                placeholderClass: 'powerwidget-placeholder',
                indicator: true,
                indicatorTime: 600,
                ajax: true,
                timestampPlaceholder: '.powerwidget-timestamp',
                timestampFormat: 'Last update: %m%/%d%/%y% %h%:%i%:%s%',
                refreshButton: true,
                refreshButtonClass: 'fa fa-refresh',
                labelError: 'Sorry but there was a error:',
                labelUpdated: 'Last Update:',
                labelRefresh: 'Refresh',
                labelDelete: 'Delete widget:',
                afterLoad: function () {},
                rtl: false,
                onChange: function () {},
                onSave: function () {}
            });
        }

        // Custom way to delete widgets.
        $('#trigger-deletewidget').click(function (e) {
            $('.deletethiswidget').remove(); // delete widget
            $('#delete-widget').modal('hide'); // close the modal
        });
        $('#trigger-deletewidget-reset').click(function (e) {
            $('body').find('.deletethiswidget').removeClass('deletethiswidget'); // cancel so remove indicator class
        });


        // Empty all local storage. (demo not needed)
        $('.empty-local-storage').click(function (e) {
            var $m = $('#confirm_replacer');
            if ($m.length && typeof $.fn.modal === 'function') {
                $('#bootconfirm_confirm', $m).off(clickEvent).on(clickEvent, function (e) {
                    localStorage.clear();
                    location.reload();
                    $m.modal().hide();
                });
                $('.modal-title', $m).text("Clear all localStorage");
                $m.modal();
            } else {
                var cls = confirm("Clear all localStorage?");
                if (cls && localStorage) {
                    localStorage.clear();
                    location.reload();
                }
            }
            e.preventDefault();
        });
        

        // ========================================================================
        //  Bootstrap Tooltips and Popovers
        // ========================================================================

        if ($('.tooltiped').length) {
            $('.tooltiped').tooltip();
        }

        if ($('.tooltiped').length) {
            $('.popovered').popover({
                'html': 'true'
            });
        }


        // Making Bootstrap Popover Hovered


        if ($('.popover-hovered').length) {
            $('.popover-hovered').popover({
                trigger: 'hover',
                'html': 'true',
                'placement': 'top'
            });
        }

        // ========================================================================
        //  Progress Bars
        // ========================================================================

        if ($('.v-default-animated .progress-bar').length) {
            $('.v-default-animated .progress-bar').progressbar();
        }

        if ($('.h-default-basic .progress-bar').length) {
            $('.h-default-basic .progress-bar').progressbar({
                display_text: 'fill',
                use_percentage: false
            });
        }
        if ($('.v-bottom-animated .progress-bar').length) {
            $('.v-bottom-animated .progress-bar').progressbar({
                display_text: 'fill'
            });
        }

        // ========================================================================
        //  Full screen Toggle
        // ========================================================================

        $('#toggle-fullscreen').click(function () {
            screenfull.request();
        });


        // ========================================================================
        //  Keep open Bootstrap Dropdown on click
        // ========================================================================

        $('.keep_open').click(function (event) {
            event.stopPropagation();
        });


        // ========================================================================
        //  Nanoscroller
        // ========================================================================

        if ($('.nano').length) {
            $(".nano").nanoScroller();
        }


        // ========================================================================
        //  Inbox Page
        // ========================================================================

        function inbox() {

            // check all checkboxes in table
            $('.checkall').click(function () {

                var $parentTable = $(this).parents('table');
                var $checkboxes = $parentTable.find('.checkbox');
                var isChecked = $(this).is(':checked');


                $checkboxes.prop('checked', isChecked).parent().toggleClass('checked', isChecked);
                $parentTable.find('tbody tr').toggleClass('selected', isChecked);

            });

            // star
            $('.mailinbox .fa-flag').click(function () {
                var isStarred = $(this).is('.flagged-yellow');
                $(this).toggleClass('flagged-yellow', !isStarred).toggleClass('flagged-grey', isStarred);
            });

            //add class selected to table row when checked
            $('.mailinbox tbody input:checkbox').click(function () {
                $(this).parents('tr').toggleClass('selected', $(this).prop('checked'));
            });

            // trash
            $('.delete').click(function (e) {
                e.preventDefault();

                var $checked = $('.mailinbox .checkbox:checked');
                var toDelete = $checked.length;

                if (toDelete === 0) {
                    showAlert('No selected message');
                    return;
                }

                $checked.parents('tr').remove();

                var msg = $checked.length > 1 ? 'messages' : 'message';
                var info = $checked.length + ' ' + msg + ' deleted';
                showAlert(info);
            });

            // mark as read/unread
            $('.mark_read, .mark_unread').click(function (e) {
                e.preventDefault();

                var $checked = $('.mailinbox .checkbox:checked');
                var toMark = $checked.length;

                if (toMark === 0) {
                    showAlert('No selected message');
                    return;
                }

                $checked.parents('tr').toggleClass('unread', !$(this).is('.mark_read'));

                var msg = $checked.length > 1 ? 'messages were' : 'message was';
                var state = $(this).is('.mark_read') ? ' read' : ' unread';
                var info = $checked.length + ' ' + msg + ' marked as ' + state;
                showAlert(info);
            });

            // Refresh stub
            $('.refresh').click(function (e) {
                e.preventDefault();
                showLoader();
            });

            // bootstrap alert div
            var $alertDiv = $('<div class="alert alert-danger alert-inbox">')
                .css({
                    display: 'none',
                    position: 'absolute',
                    top: '40%'
                })
                .appendTo('.table-relative');

            // show alert
            function showAlert(message) {
                var w = $alertDiv.text(message).width();
                $alertDiv.show();
                var left = ($alertDiv.parent().width() - w) / 2;
                $alertDiv.css('left', left);
                setTimeout(function () {
                    $alertDiv.fadeOut();
                }, 1000);
            }

            // ajax loader div
            var $loader = $('<div class="loader-darkener">').appendTo('.table-relative');
            $('<div class="fa-spin dummy-loader">').appendTo($loader);

            // show ajax loader
            function showLoader() {
                $loader.show();
                setTimeout(function () {
                    $loader.hide();
                }, 1000);
            }
        }
       

        // ========================================================================
        //  Left Responsive Menu
        // ========================================================================   

        $(document).ready(function () {

            // Responsive Menu//
            $(".responsive-menu").click(function () {
                $(".responsive-admin-menu #menu").slideToggle();
            });
            $(window).resize(function () {
                $(".responsive-admin-menu #menu").removeAttr("style");
            });

            (function multiLevelAccordion($root) {

                var $accordions = $('.accordion', $root).add($root);
                $accordions.each(function () {

                    var $this = $(this);
                    var $active = $('> li > a.submenu.active', $this);
                    $active.next('ul').css('display', 'block');
                    $active.addClass('downarrow');
                    var a = $active.attr('data-id') || '';

                    var $links = $this.children('li').children('a.submenu');
                    $links.click(function (e) {
                        if (a !== "") {
                            $("#" + a).prev("a").removeClass("downarrow");
                            $("#" + a).slideUp("fast");
                        }
                        if (a == $(this).attr("data-id")) {
                            $("#" + $(this).attr("data-id")).slideUp("fast");
                            $(this).removeClass("downarrow");
                            a = "";
                        } else {
                            $("#" + $(this).attr("data-id")).slideDown("fast");
                            a = $(this).attr("data-id");
                            $(this).addClass("downarrow");
                        }
                        e.preventDefault();
                    });
                });
            })($('#menu'));




            // Responsive Menu Adding Opened Class//

            $(".responsive-admin-menu #menu li").hover(
                function () {
                    $(this).addClass("opened").siblings("li").removeClass("opened");
                },
                function () {
                    $(this).removeClass("opened");
                }
            );



            // ========================================================================
            //  Datatables
            // ========================================================================
            

            // View, Edit, Delete from Table (Applicant) *** only VIEW
            <?php if($this->data['can_user_view'] == 1 && $this->data['can_user_edit'] == 0 && $this->data['can_user_delete'] == 0 && $this->uri->uri_string() == 'class_list/name_view') {?>
            if ($('#class_list_view_faculty_table').length) {
                var oTable = $('#class_list_view_faculty_table').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"                        
                    },
                    //"sDom": '<"search"fTlp><"bottom"><"clear">lrtip',
                    "sDom": 'T<"clear">lfrtip',
                    tableTools: {
                        "sSwfPath": "<?php echo base_url()?>components/js/swf/copy_csv_xls_pdf.swf"
                    },
                    "bProcessing": true,
                    //"bServerSide": true,
                    "sScrollX": "100%",
                    "bScrollCollapse": true,
                    "iDisplayLength": 35,
                    "sResponsive": true
                });                

                $("tfoot input").keyup(function () {
                    /* Filter on the column (the index) of this element */
                    oTable.fnFilter(this.value, $("tfoot input").index(this));
                });


                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });

                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });

                $("tfoot input").blur(function (i) {
                    if (this.value === "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
                
            }

            <?php } ?>                    
            
        });

        // ========================================================================
        //  Horisontal Menu (js\vendors\horisontal)
        // ========================================================================

        var menu = new cbpHorizontalSlideOutMenu(document.getElementById('cbp-hsmenu-wrapper'));

        // ========================================================================
        //  Summernote (js\vendors\summernote)
        // ========================================================================

        if ($('#summernote').length) {
            $('#summernote').summernote({
                height: 100,
                focus: false
            });            
        }        


        // ========================================================================
        //  User View Switch (Users List Page)
        // ========================================================================
        function init() {
            optionSwitch.forEach(function (el, i) {
                el.addEventListener('click', function (ev) {
                    ev.preventDefault();
                    _switch(this);
                }, false);
            });
        }

        function _switch(opt) {
            // remove other view classes and any any selected option
            optionSwitch.forEach(function (el) {
                classie.remove(container, el.getAttribute('data-view'));
                classie.remove(el, 'items-selected');
            });
            // add the view class for this option
            classie.add(container, opt.getAttribute('data-view'));
            // this option stays selected
            classie.add(opt, 'items-selected');
        }


        if (document.getElementById('items')) {
            var container, optionSwitch;
            container = document.getElementById('items');
            optionSwitch = Array.prototype.slice.call(container.querySelectorAll('div.items-options > a'));
            init();
        }


        // ========================================================================
        //  Inbox
        // ========================================================================

        // check all checkboxes in table
        $('.checkall').click(function () {

            var $parentTable = $(this).parents('table');
            var $checkboxes = $parentTable.find('.checkbox');
            var isChecked = $(this).is(':checked');

            $checkboxes.prop('checked',
                isChecked).parent().toggleClass('checked', isChecked);
            $parentTable.find('tbody tr').toggleClass('selected', isChecked);

        });

        // star
        $('.fa-star').click(function () {
            var isStarred = $(this).is('.star-yellow');
            $(this).toggleClass('star-yellow', !isStarred).toggleClass('star-grey', isStarred);
        });

        //add class selected to table row when checked
        $('.mailinbox tbody input:checkbox').click(function () {
            $(this).parents('tr').toggleClass('selected', $(this).prop('checked'));
        });

        // trash
        $('.delete').click(function (e) {
            e.preventDefault();

            var $checked = $('.mailinbox .checkbox:checked');
            var toDelete = $checked.length;

            if (toDelete === 0) {
                showAlert('No selected message');
                return;
            }

            $checked.parents('tr').remove();

            var msg = $checked.length > 1 ? 'messages' : 'message';
            var info = $checked.length + ' ' + msg + ' deleted';
            showAlert(info);
        });

        // mark as read/unread
        $('.mark_read, .mark_unread').click(function (e) {
            e.preventDefault();

            var $checked = $('.mailinbox .checkbox:checked');
            var toMark = $checked.length;

            if (toMark === 0) {
                showAlert('No selected message');
                return;
            }

            $checked.parents('tr').toggleClass('unread', !$(this).is('.mark_read'));

            var msg = $checked.length > 1 ? 'messages were' : 'message was';
            var state = $(this).is('.mark_read') ? ' read' : ' unread';
            var info = $checked.length + ' ' + msg + ' marked as ' + state;
            showAlert(info);
        });

        // Refresh stub
        $('.refresh').click(function (e) {
            e.preventDefault();
            showLoader();
        });

        // bootstrap alert div
        var $alertDiv = $('<div class="alert alert-danger alert-inbox">')
            .css({
                display: 'none',
                position: 'absolute',
                top: '40%'
            })
            .appendTo('.table-ctn');

        // show alert
        function showAlert(message) {
            var w = $alertDiv.text(message).width();
            $alertDiv.show();
            var left = ($alertDiv.parent().width() - w) / 2;
            $alertDiv.css('left', left);
            setTimeout(function () {
                $alertDiv.fadeOut();
            }, 1000);
        }

        // ========================================================================
        //  Forms
        // ========================================================================

        if ($('#gs_id').length) {
            $('#gs_id').mask('99-999', {
                placeholder: 'X'
            });
        }

        if ($('#gf_id').length) {
            $('#gf_id').mask('99-999', {
                placeholder: 'X'
            });
        }



        // ajax loader div
        var $loader = $('<div class="loader-cnt">').appendTo('.table-ctn');
        $('<div class="fa fa-refresh fa-spin loader">').appendTo($loader);

        // show ajax loader
        function showLoader() {
            $loader.show();
            setTimeout(function () {
                $loader.hide();
            }, 1000);
        }
    });
})(jQuery);
</script> 


<script type="text/javascript">
$('.tags').editable({
    placement: 'right',
    select2: {
        tags: ['cake', 'cookies'],
        tokenSeparators: [",", " "]
    },
});

$('[id^="tags-edit-"]').click(function(e) {
    e.stopPropagation();
    e.preventDefault();
    $('#' + $(this).data('editable') ).editable('toggle');
});
</script>

<script type='text/javascript'>
// ========================================================================
//  Lock Modal
// ======================================================================== 

$(".lockme").click(function (e) {
    e.preventDefault();
    $('#lockscreen').modal();
    $('#yesilock').click(function () {
        window.open('admin-lock.html', '_self');
        $('#lockscreen').modal('hide');
    });

});


// ========================================================================
//  Sign Out Modal
// ========================================================================            

$(".goaway").click(function (e) {
    e.preventDefault();
    $('#signout').modal();
    $('#yesigo').click(function () {
        window.open('<?php echo site_url('logout');?>', '_self');
        $('#signout').modal('hide');
    });

});

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};


/*
 * Create New Dicount!
*/

$(document).on("click", "#Create_New_Discount", function(){
	var gs_id = $(this).data("gs_id");
	var studentid = $(this).data("studentid");
	$.ajax({
      url: "<?=site_url()?>/accounts/add_more_discount_ajax/HTML_Form",
      async: false,
      type: "POST",
      data: {gs_id:gs_id, studentid:studentid},
      dataType: "JSON",
      success: function(data) {
		  $("#addMoreDiscount").show();
		  $("#addMoreDiscount_Contents").html('');
		  $("#addMoreDiscount_Contents").html(data.h);
        
      }
    })
});




$(document).on("click", "#Button_AddMore", function(){
	
	$("#student_fee_discount_addmore_form").validate({
		rules: {
			gs_id:   { required: true	},
			concession_type: { required: true   },
			aug:{required:true, range: [0, 200]},
			sep:{required:true, range: [0, 200]},
			oct:{required:true, range: [0, 200]},
			nov:{required:true, range: [0, 200]},
			dec:{required:true, range: [0, 200]},
			jan:{required:true, range: [0, 200]},
			feb:{required:true, range: [0, 200]},
			mar:{required:true, range: [0, 200]},
			apr:{required:true, range: [0, 200]},
			may:{required:true, range: [0, 200]},
			jun:{required:true, range: [0, 200]},
			jul:{required:true, range: [0, 200]},
		},
		messages: {
			gs_id: { required: 'GS-ID Not Defined!' },
			concession_type: { required: 'Please Select Concession Type!' },
			aug: { required: 'Please fill month August minimum 0' },
			sep: { required: 'Please fill month September minimum 0' },
			oct: { required: 'Please fill month October minimum 0' },
			nov: { required: 'Please fill month November minimum 0' },
			dec: { required: 'Please fill month December minimum 0' },
			jan: { required: 'Please fill month January minimum 0' },
			feb: { required: 'Please fill month February minimum 0' },
			mar: { required: 'Please fill month March minimum 0' },
			apr: { required: 'Please fill month April minimum 0' },
			may: { required: 'Please fill month May minimum 0' },
			jun: { required: 'Please fill month June minimum 0' },
			jul: { required: 'Please fill month July minimum 0' },
		},
		submitHandler: function(form){
			$(form).ajaxSubmit({
				beforeSend: function(){ $("#ajaxloader").show(); },
				uploadProgress: function (event, position, total, percentComplete){},
				dataType: "JSON",
				success: function(res){
					//$("#student_fee_discount_addmore_form").validate().resetForm();
					
					$("#main_div").html('');
					$("#main_div").html(res.RH);
				}
			});
		},
		errorPlacement: function (error, element){
			error.insertAfter(element.parent());
		}
	});// end validate


});

</script>
<script type="text/javascript" src="<?php echo base_url()?>components/js/anstyle.js"></script>
<!--/Scripts-->



</body>
</html>