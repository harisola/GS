    </div>
    <!-- All Complete and Close -->
  </div>
  <!--/MainWrapper--> 
</div>
<!--/Smooth Scroll--> 
<!--Modals--> 
 

<!-- Student Information Modal -->
<div class="modal fade" id="student_information_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Family Information</h4></div>
      <div id="modal-body" class="modal-body text-center"></div>                                       
                      
            
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 


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


<!-- Search List Items -->


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
            <?php if($this->data['can_user_view'] == 1 && $this->data['can_user_delete'] == 0 && $this->uri->uri_string() == 'class_list/name_view') {?>
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
        //  Forms
        // ========================================================================

        //Masking

        if ($('#date, #date2').length) {
            $("#date, #date2").mask('99/99/9999', {
                placeholder: 'X'
            });
        }

        if ($('#phone').length) {
            $("#phone").mask('(999) 999-9999', {
                placeholder: 'X'
            });
        }

        if ($('#mobilephone').length) {
            $('#mobilephone').mask('0999-9999999', {
                placeholder: 'X'
            });
        }

        if ($('#landline').length) {
            $('#landline').mask('999-9999999', {
                placeholder: 'X'
            });
        }

        if ($('#cnic').length) {
            $('#cnic').mask('99999-9999999-9', {
                placeholder: 'X'
            });
        }

        if ($('#card').length) {
            $("#card").mask('9999-9999-9999-9999', {
                placeholder: 'X'
            });
        }

        if ($('#serial').length) {
            $("#serial").mask('***-***-***-***-***-***', {
                placeholder: '_'
            });
        }
        if ($('#tax').length) {
            $("#tax").mask('99-9999999', {
                placeholder: 'X'
            });
        }
        if ($('#cvv').length) {
            $('#cvv').mask('999', {
                placeholder: 'X'
            });
        }
        if ($('#year').length) {
            $('#year').mask('2099', {
                placeholder: 'X'
            });
        }


        //Datepicker

        // Regular datepicker
        if ($('#date').length) {
            $('#date').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>'
            });
        }

        // Date range
        if ($('#start').length) {
            $('#start').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#finish').datepicker('option', 'minDate', selectedDate);
                }
            });
        }
        if ($('#finish').length) {
            $('#finish').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#start').datepicker('option', 'maxDate', selectedDate);
                }
            });
        }

        // Inline datepicker
        if ($('#inline').length) {
            $('#inline').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>'
            });
        }

        // Inline date range
        if ($('#inline-start').length) {
            $('#inline-start').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#inline-finish').datepicker('option', 'minDate', selectedDate);
                }
            });
        }
        if ($('#inline-finish').length) {
            $('#inline-finish').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#inline-start').datepicker('option', 'maxDate', selectedDate);
                }
            });
        }             


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


// ========================================================================
//  Call Student Information Modal
// ========================================================================
/*$(".show_student_information").click(function (e) {
    e.preventDefault();
    var GRNo = $(this).data('id');    
    $('#student_information_modal').modal();
    $(this).find('.std_grno').text(GRNo);
});*/
$(document).on("click", ".show_student_information", function (e) {

    e.preventDefault();

    var _self = $(this);

    var GR_No = _self.data('id');
    
    $.post('<?php echo base_url() . "index.php/class_list/student_profile_basic_view/";?>?grno='+GR_No, function(data) {
      $('#modal-body').html(data);
    });      


    $("#student_information_modal").modal('show');
});
</script>
<script type="text/javascript" src="<?php echo base_url()?>components/js/anstyle.js"></script>

<script>
$(document).ready(function(){
    $('#selected_grade').change(function(){ //any select change on the dropdown with id selected_grade trigger this code
        $("#selected_section > option").remove(); //first of all clear select items
        var option = $('#selected_grade').val();  // here we are taking option id of the selected one.

        if(option == '#'){
            return false; // return false after clearing sub selected_grade if 'please select was chosen'
        }

        $.ajax({
            type: "POST",
            url: "<?php echo site_url()?>/ajax/class_list_data/getsuboptions_of_grade/"+option, //here we are calling our dropdown controller and getsuboptions method passing the option

            success: function(selected_section) //we're calling the response json array 'selected_section'
            {
                $.each(selected_section,function(id,value) //here we're doing a foeach loop round each sub option with id as the key and value as the value
                {
                    var opt = $('<option />'); // here we're creating a new select option for each suboption
                    opt.val(id);
                    opt.text(value);
                    $('#selected_section').append(opt); //here we will append these new select selected_grade to a dropdown with the id 'selected_section'
                });
            }

        });

    });



    var TimerInterval;
    $('#tapin_form').submit(function(e) {
        
        
        e.preventDefault();
        data = $('#tapin_form').serialize();
        var rfid_card = $('#rfid_dec').val();

        $("#rfid_dec").val('');
        $("#rfid_dec").focus();
        if(rfid_card.length == 10){
            $.ajax({
                url: '<?php echo base_url() . "index.php/threshold/gen_attendance_ajax/get_TapIn_Information";?>',
                type: 'POST',
                data: data,
                dataType:'JSON',
                success: function(response) {
                    $("#inner_content").html('');
                    /*
                    $("#inner_content").html('');
                    $("#rfid_dec").val('');
                    $("#rfid_dec").focus();
                    */
                    
                    $("#inner_content").html(response.h1);
                    
                    
                    
                    if( response.h2 != '' ){
                        $(".main_location_code").show();
                        $("#location_code1").html('');
                        $("#location_code2").html('');
                        $("#location_code1").html(response.h2);
                        $("#location_code2").html(response.h2);
                    }else{
                        $(".main_location_code").hide();
                        $("#location_code1").html('');
                        $("#location_code2").html('');
                    }
                    
                    //$("#location_code1").html('');
                    //$("#location_code1").html(response.h2);
                    

                    clearInterval(TimerInterval);
                    TimerInterval = setInterval(setDefaultScreen, 9600);
                }
            });     
        }
    });






$(document).on("click","#setFocus_div", function(){
    $( "#rfid_dec" ).focus();
});
    
    function setDefaultScreen(){
        $.ajax({
            url: '<?php echo base_url() . "index.php/threshold/gen_attendance_ajax/getDefault_ScreenLayout";?>',
            success: function(response) {
                $("#inner_content").html(response);
                $( "#rfid_dec" ).val('');
                $( "#rfid_dec" ).focus();
                clearInterval(TimerInterval);
            }
        });
        $( "#rfid_dec" ).val('');
        $( "#rfid_dec" ).focus();
        $(".main_location_code").hide();
        $("#location_code1").html('');
        $("#location_code2").html('');
    }
});
</script>
<!--/Scripts-->




<!-- Script Disable Hover on Submenu -->
<!-- <script type="text/javascript">
  $(document).ready(function() {
      $(".dropdown-submenu").bind('click', false);
  });
</script> -->




</body>
</html>