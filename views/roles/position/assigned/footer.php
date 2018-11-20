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
    $(".staffID").select2();
	//$(".rpRoleCode").select2();
	//$(".rpRoleCode2").select2();
	//$(".positionID").select2();
	//$(".positionID2").select2();	
	
	
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

<!--Nestable--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/nestable-lists/jquery.nestable.js"></script>



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
            

            // View, Edit Role Domain
            <?php if($this->data['can_user_view'] == 1 && $this->data['can_user_edit'] == 1 && $this->data['can_user_delete'] == 0 && $this->uri->uri_string() == 'sis/academic_subject') {?>
            if ($('#subject_edit_table').length) {
                var oTable = $('#subject_edit_table').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"                        
                    },
                    //"sDom": '<"search"fTlp><"bottom"><"clear">lrtip',
                    "sDom": 'T<"clear">lfrtip',
                    tableTools: {
                        "sSwfPath": "<?php echo base_url()?>components/js/swf/copy_csv_xls_pdf.swf"
                    },
                    "bProcessing": true,
                    /*"sScrollX": "100%",
                    "bScrollCollapse": true,*/
                    "iDisplayLength": 35,
                    "sResponsive": true,

                    "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        $('.aneditable_subject_name a').editable({
                            type: 'text',
                            url: '<?php echo base_url()?>index.php/sis/academic_subject/edit',

                            validate: function(value) {
                               if($.trim(value) == '') return 'This field is required';                               
                            }
                        });

                        $('.aneditable_subject_dname a').editable({
                            type: 'text',
                            url: '<?php echo base_url()?>index.php/sis/academic_subject/edit',

                            validate: function(value) {
                               if($.trim(value) == '') return 'This field is required';                               
                            }
                        });                        
                    } 
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

	 $(document).ready(function () {
		
		 
		
	 if ($('#positions').length) {
                var oTable = $('#positions').dataTable({
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
                    "iDisplayLength": 10,
                    "sResponsive": true
                });                

                $("tfoot input").keyup(function () {
                 
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
	});
	
	
$(".goaway").click(function (e) {
    e.preventDefault();
    $('#signout').modal();
    $('#yesigo').click(function () {
        window.open('<?php echo site_url('logout');?>', '_self');
        $('#signout').modal('hide');
    });

});

$(document).on("change", ".cat1", function(){
	var ID = $(this).val();
	
	var $row = $(this).closest(".containerTable");
	//var roleCode2 = $row.find(".roleCode2");
	var roleCode1 = $row.find(".roleCode1");
		//roleCode2.html(ID);
	var fRoleC = roleCode1.html() + roleCode2.html();
	var roleCodeV = $row.find(".roleCodeV");
		roleCodeV.val(fRoleC);
	var cat2 = $row.find(".cat2");
		cat2.removeAttr("disabled");
  
});

$(document).on("change", ".cat2", function(){
	var ID = $(this).val();
	var $row = $(this).closest(".containerTable");
	var allct2 = $row.find(".allocation_2");
	allct2.css("opacity", "");
	var domain = $row.find(".domain");
	domain.removeAttr("disabled");
});


$(document).on("change", ".domain", function(){
	var ID = $(this).val();
	
	var txt = $(this).find('option:selected').text();
	var $row = $(this).closest(".containerTable");
	var pStatus = $row.find(".positionStatus").val();
	if( parseInt(pStatus) != 0 ){
	var roletype = $row.find(".roletype");
	$row.find(".category").val('');
	var lSerial = $row.find(".locationSerial");
	lSerial.html("Location Serial");
	$row.find(".locSlContinue").hide();
	
	//category.val('');
	
	
	
	roletype.removeAttr("disabled");
	var dmnH = $row.find(".domainHidden");
	var dmnHTxt = $row.find(".domainHiddenTxt");
	dmnH.val(ID);
	dmnHTxt.val(txt);
	var IDD = parseInt(ID);
	if( IDD > 1 && IDD < 6  ){
		
		$.ajax({
			type:"POST",
			url : "<?=base_url(); ?>index.php/roles/position_ajax/getRType",
			data:{domain:ID},
			dataType: "JSON",
			success:function(res){
			//$(".nameCode").html( res.aname );
				roletype.find('option').remove().end().append( res.TYPED );
				//console.log( res.TYPED );
			},
		});
	
	}// greater than zeor
	else{
		roletype.find('option').remove().end();
	}
	}else{
		alert("Position Created Refresh The Page");
	}	
});

$(document).on("change", ".roletype", function(){
	var ID = $(this).val();
	var txt = $(this).find('option:selected').text();
	var $row = $(this).closest(".containerTable");
	var category = $row.find(".category");
	category.removeAttr("disabled");
	category.val('');
	var lSerial = $row.find(".locationSerial");
	lSerial.html("Location Serial");
	$row.find(".locSlContinue").hide();
	
	var dmnH = $row.find(".roletypeHidden");
	var dmnHTxt = $row.find(".roletypeHiddenTxt");
		dmnH.val(ID);
		dmnHTxt.val(txt);
});

$(document).on("change", ".category", function(){
	var ID = $(this).val();
	var $row = $(this).closest(".containerTable");
	//$row.find(".category").val('');
	
	if( ID != '' ){
	var idS = ID.split("_");
	var nText = idS[1];
	var txt = $(this).find('option:selected').text();
	
	var dmnH = $row.find(".categoryHidden");
	var dmnHTxt = $row.find(".categoryHiddenTxt");
		//dmnH.val(nText);
		dmnH.val( ID );
		dmnHTxt.val(txt);
	var domain = $row.find(".domainHiddenTxt").val();
	
	var roleType = $row.find(".roletypeHiddenTxt").val();
	
	var posID = domain.trim()+"-"+roleType.trim()+"-"+nText.trim();
	
	var posIDH = $row.find(".positionIDH");
	var locationSerial = $row.find(".locationSerial");
	var positionIDLabel = $row.find(".positionIDLabel");
	
	var dHidden = $row.find(".domainHidden").val();
	var rtHidden = $row.find(".roletypeHidden").val();
	var cat = parseInt( idS[0] );
	//console.log( posID );
	//console.log( cat );
	
	var lsclink = $row.find(".locSlContinue");
	if( domain != '' && roleType != '' && nText != ''){
		$.ajax({
			type:"POST",
			url : "<?=base_url(); ?>index.php/roles/position_ajax/getGpID",
			data:{posID:posID,domain2:dHidden,roletype2:rtHidden,category2:cat},
			dataType: "JSON",
			success:function(res){
				
				
				locationSerial.html( res.countPosi );
				posIDH.val( res.gpID );
				positionIDLabel.html( res.gpID  );
				lsclink.show();
			},
		});
	}

	}// if mean ID not empty
	else{
		var lSerial = $row.find(".locationSerial");
	lSerial.html("Location Serial");
	$row.find(".locSlContinue").hide();
	}
}); <!-- End Category dropdown menu -->

<!-- // Start Of Continue.. button -->
$(document).on("click",".lsclink", function(){
	var $row = $(this).closest(".containerTable");
	var positionIDT = $row.find(".positionIDT");
	positionIDT.css("opacity", "");
	var tagline = $row.find(".tagline");
	tagline.removeAttr("disabled");
	var bottomline = $row.find(".bottomline");
	bottomline.removeAttr("disabled");
	var posIDH = $row.find(".positionIDH");
	var posID = posIDH.val();
	
	var domainID = $row.find(".domainHidden").val();
	var domainTxt = $row.find(".domainHiddenTxt").val();
	var role = $row.find(".roletypeHidden").val();
	var r = role.split("_");
	var roleID  = parseInt(r[0]);
	var roleTxt = r[1];
	var cat = $row.find(".categoryHidden").val();
	var c = cat.split("_");
	var catID  = parseInt(c[0]);
	var catTxt = c[1];
	
	
	var lastID = $row.find(".lastID");
	
	var positionIDLabel = $row.find(".positionIDLabel2");
	
	if( posID != '' ){
		$.ajax({
			type:"POST",
			url : "<?=base_url(); ?>index.php/roles/position_ajax/getGpID2",
			data:{posID2:posID,domain2:domainID,roletype2:roleID,category2:catID},
			dataType: "JSON",
			success:function(res){
				//alert(res.lastID);
				positionIDLabel.html( res.gpID  );
				var pID = parseInt( res.lastID );
				lastID.val(pID);
			},
		});
	}
	
	
	
});


var timerid;
$(document).on("input", ".tagline", function(){
	var value = $(this).val();
	
	
	var $row = $(this).closest(".containerTable");
	var link_1 = $row.find(".link_1");
	var positionID = $row.find(".positionID");
	var lsclink = $row.find(".locSlContinue");
	
	if($(this).data("lastval")!= value){
		$(this).data("lastval",value);
		clearTimeout(timerid);
		timerid = setTimeout(function() {
		lsclink.hide();
			//alert(value);  
			
		},1100);
	};

        var lastID = $row.find(".lastID").val();
    var bottomline = $row.find(".bottomline").val();
    console.log(lastID);
    console.log(bottomline);
    if( lastID != 0 ){
        $.ajax({
            type:"POST",
            url : "<?=base_url(); ?>index.php/roles/position_ajax/updatepostion",
            data:{lastID:lastID,topline:value,bottomline:bottomline},
            dataType: "JSON",
            success:function(res){
                
                if( res.affected > 0 ){
                    
                    /*$.ajax({
                        type:"POST",
                        url : "<?=base_url(); ?>index.php/roles/position_ajax/getPostionTitle",
                        cache: false,
                        dataType: "JSON",
                        success:function(res){
                            
                            positionID.find('option').remove().end().append( res.pos );
                            positionID2.find('option').remove().end().append( res.pos );
                            
                            rpRoleCode.find('option').remove().end().append( res.rC );
                            rpRoleCode2.find('option').remove().end().append( res.rC );
                            
                        },
                    });*/
        
                }// response must not be empty
                
                
                
            },
        });
    }
});

var timerid2;
$(document).on("input", ".bottomline", function(){
	var value = $(this).val();
	
	var $row = $(this).closest(".containerTable");
	var link_1 = $row.find(".link_1");
	var positionID = $row.find(".positionID");
	var link_2 = $row.find(".link_2");
	var positionID2 = $row.find(".positionID2");
	var rpRoleCode = $row.find(".rpRoleCode");
	var rpRoleCode2 = $row.find(".rpRoleCode2");
	
	
	var lastID = $row.find(".lastID").val();
	var tagline = $row.find(".tagline").val();
	
	
	
	if($(this).data("lastval")!= value){
		$(this).data("lastval",value);
		clearTimeout(timerid2);
		timerid2 = setTimeout(function() {
			link_1.css("opacity", "");
			positionID.removeAttr("disabled");
			rpRoleCode.removeAttr("disabled");
			rpRoleCode2.removeAttr("disabled");
			link_2.css("opacity", "");
			positionID2.removeAttr("disabled");
			
			//alert(lastID);
			//alert(tagline);
			//alert(value);
			
	if( lastID != 0 ){
		$.ajax({
			type:"POST",
			url : "<?=base_url(); ?>index.php/roles/position_ajax/updatepostion",
			data:{lastID:lastID,topline:tagline,bottomline:value},
			dataType: "JSON",
			success:function(res){
				
				if( res.affected > 0 ){
					
					/*$.ajax({
						type:"POST",
						url : "<?=base_url(); ?>index.php/roles/position_ajax/getPostionTitle",
						cache: false,
						dataType: "JSON",
						success:function(res){
							
							positionID.find('option').remove().end().append( res.pos );
							positionID2.find('option').remove().end().append( res.pos );
							
							rpRoleCode.find('option').remove().end().append( res.rC );
							rpRoleCode2.find('option').remove().end().append( res.rC );
							
						},
					});*/
		
				}// response must not be empty
				
				
				
			},
		});
	}
	
			
		},1100);
	};
});
<!-- end TOP Line -->

<!-- on change position ID -->
$(document).on("change",".positionID",function(){
	var thsID = $(this).val();
	var $row = $(this).closest(".containerTable");
	var posTitleTB = $row.find(".posTitleTB");
	var lastID = $row.find(".lastID").val();
	var pRSName = $row.find(".pRSName");
	var rpRoleCode = $row.find(".rpRoleCode");
	var _thisID;
	
	if( thsID == '' ){
		_thisID = 0;
	}else{
		_thisID = parseInt( thsID );
	}
		$.ajax({
			type:"POST",
			url : "<?=base_url(); ?>index.php/roles/position_ajax/updttpbl",
			cache: false,
			data:{ID:thsID,lastID:parseInt(lastID),type:1},
			dataType: "JSON",
			success:function(res){
				
				$.ajax({
					type:"POST",
					url : "<?=base_url(); ?>index.php/roles/position_ajax/getTopBottomLine",
					cache: false,
					data:{ID:thsID},
					dataType: "JSON",
					success:function(res){
						//alert(res.combinetlbl);
						posTitleTB.html( res.combinetlbl );
						pRSName.html( res.staffName );
						
						rpRoleCode.find('option').remove().end().append( res.options );
						
					},
				});
			},
			
		});
	
	
});


<!-- on change position ID -->
$(document).on("change",".rpRoleCode",function(){
	var thsID = $(this).val();
	var $row = $(this).closest(".containerTable");
	var posTitleTB = $row.find(".posTitleTB");
	var lastID = $row.find(".lastID").val();
	var pRSName = $row.find(".pRSName");
	var rpRoleCode = $row.find(".positionID");
	
	var _thisID;
	
	if( thsID == '' ){
		_thisID = 0;
	}else{
		_thisID = parseInt( thsID );
	}
	
	
	//if( parseInt( thsID ) > 0 ){
		$.ajax({
			type:"POST",
			url : "<?=base_url(); ?>index.php/roles/position_ajax/updttpbl",
			cache: false,
			data:{ID:thsID,lastID:parseInt(lastID),type:1},
			dataType: "JSON",
			success:function(res){
				$.ajax({
					type:"POST",
					url : "<?=base_url(); ?>index.php/roles/position_ajax/getTopBottomLine",
					cache: false,
					data:{ID:thsID},
					dataType: "JSON",
					success:function(res){
						//alert(res.combinetlbl);
						posTitleTB.html( res.combinetlbl );
						pRSName.html( res.staffName );
						
						rpRoleCode.find('option').remove().end().append( res.options2 );
						
					},
				});
			},
		});
	//}
});


<!-- on change position ID -->
$(document).on("change",".positionID2",function(){
	var thsID = $(this).val();
	var $row = $(this).closest(".containerTable");
	var posTitleTB2 = $row.find(".posTitleTB2");
	var lastID = $row.find(".lastID").val();
	var pRSName2 = $row.find(".pRSName2");
	var rpRoleCode2 = $row.find(".rpRoleCode2");
	
	if( thsID == '' ){
		_thisID = 0;
	}else{
		_thisID = parseInt( thsID );
	}
	
	//if( parseInt( thsID ) > 0 ){
		$.ajax({
			type:"POST",
			url : "<?=base_url(); ?>index.php/roles/position_ajax/updttpbl",
			cache: false,
			data:{ID:thsID,lastID:parseInt(lastID),type:2},
			dataType: "JSON",
			success:function(res){
				$.ajax({
					type:"POST",
					url : "<?=base_url(); ?>index.php/roles/position_ajax/getTopBottomLine",
					cache: false,
					data:{ID:thsID},
					dataType: "JSON",
					success:function(resp){
						//alert(resp.combinetlbl);
						posTitleTB2.html( resp.combinetlbl );
						pRSName2.html( resp.staffName );
						rpRoleCode2.find('option').remove().end().append( resp.options );
					},
				});
				
			},
		});
//	}
});



<!-- on change position ID -->
$(document).on("change",".rpRoleCode2",function(){
	var thsID = $(this).val();
	var $row = $(this).closest(".containerTable");
	var posTitleTB = $row.find(".posTitleTB2");
	var lastID = $row.find(".lastID").val();
	var pRSName = $row.find(".pRSName2");
	var rpRoleCode = $row.find(".positionID2");
	if( thsID == '' ){
		_thisID = 0;
	}else{
		_thisID = parseInt( thsID );
	}
//if( parseInt( thsID ) > 0 ){
		$.ajax({
			type:"POST",
			url : "<?=base_url(); ?>index.php/roles/position_ajax/updttpbl",
			cache: false,
			data:{ID:thsID,lastID:parseInt(lastID),type:2},
			dataType: "JSON",
			success:function(res){
				$.ajax({
					type:"POST",
					url : "<?=base_url(); ?>index.php/roles/position_ajax/getTopBottomLine",
					cache: false,
					data:{ID:thsID},
					dataType: "JSON",
					success:function(res){
						//alert(res.combinetlbl);
						posTitleTB.html( res.combinetlbl );
						pRSName.html( res.staffName );
						
						rpRoleCode.find('option').remove().end().append( res.options2 );
						
					},
				});
			},
		});
	//}
});


$(document).on("change",".link_1",function(){
	var $row = $(this).closest(".containerTable");
	var allocation_3 = $row.find(".allocation_3");
	allocation_3.css("opacity", "");
});


$(document).on("change",".staffID",function(){
	var ID = $(this).val();
	var $row = $(this).closest(".containerTable");
	var nameCode = $row.find(".nameCode");
	var gt_ID = $row.find(".gt_ID");
	var roleCode1 = $row.find(".roleCode1");
	var staffIDV = $row.find(".staffIDV");
	var funda = $row.find(".fundamental");
	var cat1 = $row.find(".cat1");
	var cat2 = $row.find(".cat2");
	
	var lastID = $row.find(".lastID").val();
	var stffCount = $row.find(".staffCount");
	var roleCode2 = $row.find(".roleCode2");
	var fundID = $row.find(".fundamentalID");
	
	var countRoleCode = $row.find(".countRoleCode");
	var PositionCount = $row.find(".PositionCount");
	var noAss = "0_"+lastID;
	var noAss2 = lastID+"_0";
	$.ajax({
		type:"POST",
		url : "<?=base_url(); ?>index.php/roles/position_ajax/staff",
		data:{staff:ID},
		dataType: "JSON",
		success:function(res){
			nameCode.html(res.aname);
			gt_ID.html(res.GTID);
			roleCode1.html(res.nCode+"-");
			staffIDV.val(res.sID);
			cat1.removeAttr("disabled");
			$.ajax({
				type:"POST",
				url : "<?=base_url(); ?>index.php/roles/position_ajax/getPosInfo",
				cache: false,
				data:{staff:ID,lastID:lastID,ptype:2},
				dataType: "JSON",
				success:function(resp){
					var sc = parseInt(resp.sc);
					if( sc == 1){
						roleCode2.html("I")
					}else if( sc == 2 ){
						roleCode2.html("A")
					}
					stffCount.html( sc );
					funda.html( resp.cHtml );
					
					
					if( resp.fid == noAss ){
						fundID.val(noAss2)
					}else{
						fundID.val(resp.fid)
					}
					countRoleCode.val(sc);
					PositionCount.val(sc);
					if( sc == 3 ){
					cat2.hide();
					}else{
					cat2.show();
					}
					
					
			   },
			});
		},
	});
});

<!-- End Staff dropdown -->
$(document).on("change", ".cat2", function(){
	
	var $row = $(this).closest(".containerTable");
	var staffID = $row.find(".staffIDV").val();
	var posID = $row.find(".lastID").val();
	var pStatus = $row.find(".positionStatus").val();
	var pStatus2 = $row.find(".positionStatus");
	var thsID = $(this).val();
	var roleCode1 = $row.find(".roleCode1");
	var roleCode2 = $row.find(".roleCode2");
	var nameCode = $row.find(".nameCode");
	var gt_ID = $row.find(".gt_ID");
	var staffCount = $row.find(".staffCount");
	var fundamental = $row.find(".fundamental");
	var locationSerial = $row.find(".locationSerial");
	var positionIDLabel2 = $row.find(".positionIDLabel2");
	var posTitleTB = $row.find(".posTitleTB");
	var posTitleTB2 = $row.find(".posTitleTB2");
	var someVariable = roleCode1.html();
	//var r4 = roleCode2.html();
	var r4 = $.trim(roleCode2.html());
	
	someVariable = someVariable.replace('-', '');
	
	var nameCode3 =someVariable.trim();
	
	var posCount = $row.find(".PositionCount");
	
	 var fCount = $row.find('input[type="radio"]:checked', '.fundaCount').val();
	var fc = fCount.split("_");
	var fundamental = fc[1];
	var fundaAB = fc[0];
	
	
	var fundID = $row.find(".fundamentalID").val();
	var posCount2 = parseInt(posCount);
	var ctRC = $row.find(".countRoleCode");
	var ctRC1 = ctRC.val();
	
	var fundID1 = fundID.trim();
	$.ajax({
		type:"POST",
		url : "<?=base_url(); ?>index.php/roles/position_ajax/finishEditing",
		cache: false,
		data:{staff1:staffID,posID1:posID,thsID1:thsID,rolecode1:nameCode3,rolecode2:r4,countRC:ctRC1,funda:fundamental,funda2AB:fundaAB,fundID2:fundID1},
		dataType: "JSON",
		success:function(resp){
			pStatus2.val(0);
			alert("Position Updated!");
			
			
		},
	});
	
	
	
});
$(document).on("change",".fundaCount", function(){
	var fundaV = $(this).val();
	
	var $row = $(this).closest(".containerTable");
	/*var roleCode2 = $row.find(".roleCode2");
	roleCode2.html(fundaV);*/
	var posID = $row.find(".lastID").val();
	var fu = fundaV.split("_");
	var ff = fu[0];
	//alert(ff);
	var roleCode2 = $row.find(".roleCode2");
	roleCode2.html(ff);
	
	
});


	/*if ($('#positiontForm').length) {
		$("#positiontForm").validate({
			ignore: [],
			rules: {
				domain: { required: true},
				roletype: { required: true},
				category: { required: true },
				positionTitle: { required: true },
				academic: { required: true },
			},
			messages: {
				domain:{required: 'Select domain name'},
				roletype:{required: 'Select role type'},
				category:{required: 'Select category' },
				positionTitle:{required: 'Please enter position title'},
				academic: { required: 'Select academic' },
			},
			 // Ajax form submition
             submitHandler: function (form) {
				 //$('#positions').DataTable().fnAddData(["Tiger Nixon", "System Architect", "B","25","PN","G","Edinburgh" ]);
										
										
				  $( form ).ajaxSubmit({
					  
					  	type:"POST",
						url : "<?=base_url(); ?>index.php/roles/position_ajax/set",
						beforeSend: function () {
                           $('#positiontForm button[type="submit"]').addClass('button-uploading').attr('disabled', true);
						},
                        uploadProgress: function (event, position, total, percentComplete) {
							$("#positiontForm .progress").text(percentComplete + '%');
						},
						success: function ( res) {
							console.log( res );
							//var response = parseInt(res);
							
							var c1 = $('#domain').find('option:selected').text();
							var c2 = $('#roletype').find('option:selected').text();
							var c3 = $('#category').find('option:selected').text();
							var c4 = $('#wing').find('option:selected').text();
							var c5 = $('#grade').find('option:selected').text();
							var c6 = $('#section').find('option:selected').text();
							var c7 = $('#subject').find('option:selected').text();
							var c8 = $('#positionTitle').val();
							
							$('#positions').DataTable().fnAddData([ c8,c1, c2, c3,c4,c5,c6,c7 ]);		
							$('#positiontForm button[type="submit"]').removeClass('button-uploading').attr('disabled', false);
                        },
						complete:function(){
							$( '#positiontForm' ).each(function(){ this.reset(); });
							$("#positiontForm .progress").hide();
							$("#positiontForm").removeClass('submited');
							$("#positiontForm").addClass('orb-form');
							
						}
						
						
				  }); 
                
             },
			// Do not change code below
			errorPlacement: function (error, element) {
				error.insertAfter( element.parent() );
			}

		});

	}*/
	
	

</script>
</body>
</html>