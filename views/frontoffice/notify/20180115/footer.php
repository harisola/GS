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
            

            // View, Edit, Delete from Table (Admission) *** only VIEW
            <?php if($this->data['can_user_view'] == 1 && $this->data['can_user_delete'] == 0 && $this->uri->uri_string() == 'fo/new_admission') {?>
            if ($('#new_admission_table').length) {
                var oTable = $('#new_admission_table').dataTable({
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
                    "sResponsive": true,
                    "jQueryUI": true
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



            // View, Edit, Delete from Table (Withdrawal) *** only VIEW
            <?php if($this->data['can_user_view'] == 1 && $this->data['can_user_delete'] == 0 && $this->uri->uri_string() == 'fo/student_withdrawal') {?>
            if ($('#withdrawal_student_table').length) {
                var oTable = $('#withdrawal_student_table').dataTable({
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
                    "sResponsive": true,
                    "jQueryUI": true
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




            // View, Edit, Delete from Table (Status Change) *** only VIEW
            <?php if($this->data['can_user_view'] == 1 && $this->data['can_user_delete'] == 0 && $this->uri->uri_string() == 'fo/student_ai') {?>
            if ($('#statusai_student_table').length) {
                var oTable = $('#statusai_student_table').dataTable({
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
                    "sResponsive": true,
                    "jQueryUI": true
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


            
            // View, Edit, Delete from Table (Student Duplicate Card) *** only VIEW
            <?php if($this->data['can_user_view'] == 1 && $this->data['can_user_delete'] == 0 && $this->uri->uri_string() == 'fo/student_duplicate_card') {?>
            if ($('#duplicatecard_student_table').length) {
                var oTable = $('#duplicatecard_student_table').dataTable({
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
                    "sResponsive": true,
                    "jQueryUI": true
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


            
            // View, Edit, Delete from Table (Student House Change) *** only VIEW
            <?php if($this->data['can_user_view'] == 1 && $this->data['can_user_delete'] == 0 && $this->uri->uri_string() == 'fo/student_house_change') {?>
            if ($('#housechange_student_table').length) {
                var oTable = $('#housechange_student_table').dataTable({
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
                    "sResponsive": true,
                    "jQueryUI": true
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




            // View, Edit, Delete from Table (Student Section Change) *** only VIEW
            <?php if($this->data['can_user_view'] == 1 && $this->data['can_user_delete'] == 0 && $this->uri->uri_string() == 'fo/student_section_change') {?>
            if ($('#sectionchange_student_table').length) {
                var oTable = $('#sectionchange_student_table').dataTable({
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
                    "sResponsive": true,
                    "jQueryUI": true
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

        if ($('#form_no').length) {
            $('#form_no').mask('9999', {
                placeholder: 'X'
            });
        }

        if ($('#gs_id').length) {
            $('#gs_id').mask('99-999', {
                placeholder: 'X'
            });
        }

        if ($('#card_amount').length) {
            $('#card_amount').mask('999', {
                placeholder: 'X'
            });
        }

        if ($('#gr_no').length) {
            $('#gr_no').mask('99999', {
                placeholder: 'X'
            });
        }

        if ($('#nic').length) {
            $('#nic').mask('99999-9999999-9', {
                placeholder: 'X'
            });
        }

        if ($('#admission_fee').length) {
            $('#admission_fee').mask('99,999', {
                placeholder: 'X'
            });
        }

        if ($('#security_deposit').length) {
            $('#security_deposit').mask('99,999', {
                placeholder: 'X'
            });
        }

        if ($('#computer_subscription').length) {
            $('#computer_subscription').mask('9,999', {
                placeholder: 'X'
            });
        }

        // Date range
        if ($('student_dob').length) {
            $('#student_dob').datepicker({
                dateFormat: 'yy-mm-dd',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#student_doj').datepicker('option', 'minDate', selectedDate);
                }
            });
        }
        if ($('#student_doj').length) {
            $('#student_doj').datepicker({
                dateFormat: 'yy-mm-dd',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#student_dob').datepicker('option', 'maxDate', selectedDate);
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


$(document).on("click", ".open_show", function(){
	var $r = $(this).closest(".tableRow");
	var notify_id = parseInt( $(this).attr("data-id") );
	var cat_id = parseInt( $r.find(".N_cat_id").val() );
	var staff_id = parseInt( $r.find(".S_id").val());
	var emp_id = parseInt( $r.find(".S_emp_id").val());
	var gs_id = $r.find(".gs_id").val();
	var notify_to = parseInt( $r.find(".notify_to").val()); // 
	var current_user = parseInt( $r.find(".current_user").val()); // 
	
	
	
	
	//console.log(notify_id);
	//console.log(N_cat_id);
	
	if( notify_id > 0 ){
		$.ajax({
			type: "POST",
			url : "<?=base_url();?>index.php/fo/notify_log_ajax/get_converssion/",
			data: {notify_id:notify_id,cat_id:cat_id,staff_id:staff_id,emp_id:emp_id,gs_id:gs_id,notify_to:notify_to,current_user:current_user},
			dataType: "JSON",
			beforeSend: function(){
			},
			success: function(res){
				var obj = res.TR;
				var hht = res.ht;
				//console.log(obj);
				$.each( obj, function( index, value ) {
					var v = parseInt( value );
					var rowID = "#row_id_"+v;
					$(rowID).removeClass("danger",2000);
				});
				$("#conversion").html('');
				$("#conversion").html(hht);
				highlight_last_li();
			},
			complete:function(){ 
			},
			error:function(){ 
			}
			
		});
	}
	
});

/*$(document).on("click", ".send-message", function(){
$("#chat-messages-list li").removeClass("highlight");
var $last = $("#chat-messages-list").append('<li class="left clearfix highlight"><span class="user-img pull-right"> <img src="http://placehold.it/150x150" alt="User Avatar" class="img-circle" /> </span><div class="chat-body clearfix"><div class="header"> <span class="name">Spiderman</span> <span class="badge"><i class="fa fa-clock-o"></i>14 mins ago</span></div><p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales. </p></div></li>');
});

$(document).on("click", ".send-message", function(){
var container = $('.chat-content');
var scrollTo = $('.highlight');
container.animate({scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()}, 2000);
}); */

$(document).ready(function(){
	highlight_last_li();
});

function highlight_last_li(){
	$("#chat-messages-list li").last().addClass("highlight");
	var container = $('.chat-content');
	var scrollTo = $('.highlight');
	container.animate({scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()}, 2000);
}


$(document).on("click",".send-message", function(){
	var notify_id = $("#notify_id").val();
	var cat_id = $("#cat_id").val();
	var staff_id = $("#staff_id").val();
	var emp_id = $("#emp_id").val();
	var gs_id = $("#gs_id").val();
	var notify_to = $("#notify_to").val();
	var messge_comments2 = $("#messge_comments").val();
	
	var myname = $("#myname").val();
	
	
	var container = $('.chat-content');					
	var photo_url = '<?=base_url()."assets/photos/hcm/150x150/staff/";?>'+emp_id+'.png';
	
	var now =  '<?=unix_to_human( time() );?>';
	//console.log(messge_comments2);
	
	
	    $("#order-form").validate({
				rules: {
					gs_id: { required: true },
					activecase_id: { required: true },
					current_user: { required: true },
					messge_comments: { required: true }
				},
				messages: {
					gs_id: { required: 'GS-ID not found!' },
					activecase_id: { required: 'Case not registered!' },
					current_user: { required: 'User id not found!' },
					messge_comments: { required: 'Please enter comments' }
                },
				submitHandler: function(form){
					$(form).ajaxSubmit({
						beforeSend: function(){ $("#ajaxloader").show(); },
						uploadProgress: function (event, position, total, percentComplete){},
						dataType: "JSON",
						success: function(res){ 
						//console.log(res);
						var rd = res.rd;
						//console.log(rd);
						var cu = rd.c_u;
						//console.log(cu);
						var m = rd.m;
						//console.log(m);
							var id = parseInt( res.r );
							
							$("#ajaxloader").hide();
							
							if( id > 0 ){
								
								$("#calloutMessageError").hide();
								$('#calloutMessage').show(0).delay(5000).hide(0);
								
								getnotice2();
								
								
$("#messge_comments").val(''); 								
var list = $("#chat-messages-list li").removeClass("highlight");
var $last = $("#chat-messages-list").append('<li class="left clearfix highlight"><span class="user-img pull-left"> <img src="'+photo_url+'" alt="User Avatar" class="img-circle" /> </span><div class="chat-body clearfix"><div class="header"> <span class="name">'+myname+'</span> <span class="badge"> '+now+'<i class="fa fa-clock-o"></i></span></div><p>'+m+'</p></div></li>');
var scrollTo = $('.highlight');
container.animate({scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()}, 2000);

//messge_comments2 = '';

	
/*$.ajax({
		type: "POST",
		url : "<?=base_url();?>index.php/fo/notify_log_ajax/get_converssion/",
		data: {notify_id:notify_id,cat_id:cat_id,staff_id:staff_id,emp_id:emp_id,gs_id:gs_id,notify_to:notify_to},
		dataType: "JSON",
		beforeSend: function(){
		},
		success: function(res){
			var obj = res.TR;
			var hht = res.ht;
			//console.log(obj);
			$.each( obj, function( index, value ) {
				var v = parseInt( value );
				var rowID = "#row_id_"+v;
				$(rowID).removeClass("danger",2000);
			});
			$("#conversion").html('');
			$("#conversion").html(hht);
			highlight_last_li();
		},
		complete:function(){ 
		},
		error:function(){ 
		}
		
	}); */
								
								
							}else{
								$('#calloutMessage').hide();
								$('#newNofitication').hide();
								$('#calloutMessageError').show(0).delay(5000).hide(0);
							}
							
						}
                    });
			},
			errorPlacement: function (error, element) {
               error.insertAfter(element.parent());
               }
            });
       
});


function getnotice2(){

var nuum1 = $("#newNofitication");
nuum1.show();
var nuum = nuum1.html();
var num = parseInt(nuum);	
var user_id = $("#nuser_id").val();
	$.ajax({
		type: "POST",
		url: "<?=site_url().'/fo/notify_log_ajax/get_notification/';?>",
		data: { num: num,user_id:user_id },
		dataType : "JSON",
		beforeSend : function (){ },
		success: function( res ){
			nuum1.html(parseInt(res.r));
		},
		complete:function(){ },
		error: function() { }
	});
}
</script>


<script type="text/javascript" src="<?php echo base_url()?>components/js/anstyle.js"></script>
<!--/Scripts-->

</body>
</html>