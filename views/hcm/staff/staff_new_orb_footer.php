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

        // We should listen touch elements of touch devices
        $('.smooth-overflow').on('touchstart', function (event) {});

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
            $('#megamenuCarousel').carousel();
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
        //  FullCalendar (js\vendors\fullcalendar)
        // ========================================================================

        //Calendar with Draggable Events
        // initialize the external events
        if ($('#external-events div.external-event').length) {
            $('#external-events div.external-event').each(function () {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });

            });

            // initialize the calendar
            var date = new Date();
            var dd = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today,title',
                    right: 'month,agendaWeek,agendaDay'
                },

                events: [{
                    title: 'All Day Event',
                    start: new Date(y, m, 1),
                    className: ["event", "greenEvent"]

                }, {
                    title: 'Long Event',
                    start: new Date(y, m, dd - 5),
                    end: new Date(y, m, dd - 2),
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, dd - 3, 16, 0),
                    allDay: false
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, dd + 4, 16, 0),
                    allDay: false
                }, {
                    title: 'Meeting',
                    start: new Date(y, m, dd, 10, 30),
                    allDay: false
                }, {
                    title: 'Lunch',
                    start: new Date(y, m, dd, 12, 0),
                    end: new Date(y, m, dd, 14, 0),
                    allDay: false
                }, {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/',
                    className: [".greenEvent"]

                }],

                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function (date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                }
            });
        }


        // initialize the calendar on index page
        var date2 = new Date();
        var ddd = date2.getDate();
        var mmm = date2.getMonth();
        var yyy = date2.getFullYear();


        if ($('#calendar2').length) {
            $('#calendar2').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                editable: true,
                events: [{
                    title: 'All Day Event',
                    start: new Date(yyy, mmm, 1)
                }, {
                    title: 'Long Event',
                    start: new Date(yyy, mmm, ddd - 5),
                    end: new Date(yyy, mmm, ddd - 2)
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(yyy, mmm, ddd - 3, 16, 0),
                    allDay: false
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(yyy, mmm, ddd + 4, 16, 0),
                    allDay: false
                }, {
                    title: 'Meeting',
                    start: new Date(yyy, mmm, ddd, 10, 30),
                    allDay: false
                }, {
                    title: 'Lunch',
                    start: new Date(yyy, mmm, ddd, 12, 0),
                    end: new Date(yyy, mmm, ddd, 14, 0),
                    allDay: false
                }, {
                    title: 'Birthday Party',
                    start: new Date(yyy, mmm, ddd + 1, 19, 0),
                    end: new Date(yyy, mmm, ddd + 1, 22, 30),
                    allDay: false
                }, {
                    title: 'Click for Google',
                    start: new Date(yyy, mmm, 28),
                    end: new Date(yyy, mmm, 29),
                    url: 'http://google.com/'
                }]
            });
        }


        // ========================================================================
        //  Bootstrap Tooltips and Popovers
        // ========================================================================

        if ($('.tooltiped').length) {
            $('.tooltiped').tooltip();
        }

        if ($('.popovered').length) {
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

            //Basic Table
            if ($('#table-1').length) {
                $('#table-1').dataTable();
            }



            //Table With Column Clearing


            var asInitVals = [];

            if ($('#table-3').length) {
                $('#table-3').dataTable({
                    "bPaginate": false,
                    "sDom": 'C<"clear">lfrtip',
                    colVis: {
                        order: 'alfa'
                    }
                });
            }
            //Table With Column Filtering


            if ($('#table-2').length) {
                var oTable = $('#table-2').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"
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


            // if there's google maps script on the page
            if (typeof google !== 'undefined') {

                // ========================================================================
                //  Google Maps
                // ========================================================================

                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions

                var mapOptions = {

                    map_canvas: {

                        // How zoomed in you want the map to start at (always required)
                        zoom: 11,

                        // disable default UI
                        controls: false,

                        // The latitude and longitude to center the map (always required)
                        latitude: 40.6700, // New York,
                        longitude: -73.9400,



                        // How you would like to style the map. 
                        styles: [{
                            'featureType': 'water',
                            'stylers': [{
                                'visibility': 'on'
                            }, {
                                'color': '#638897'
                            }]
                        }, {
                            'featureType': 'landscape',
                            'stylers': [{
                                'color': '#f2e5d4'
                            }]
                        }, {
                            'featureType': 'road.highway',
                            'elementType': 'geometry',
                            'stylers': [{
                                'color': '#82b964'
                            }]
                        }, {
                            'featureType': 'road.arterial',
                            'elementType': 'geometry',
                            'stylers': [{
                                'color': '#e4d7c6'
                            }]
                        }, {
                            'featureType': 'road.local',
                            'elementType': 'geometry',
                            'stylers': [{
                                'color': '#fbfaf7'
                            }]
                        }, {
                            'featureType': 'poi.park',
                            'elementType': 'geometry',
                            'stylers': [{
                                'color': '#82b964'
                            }]
                        }, {
                            'featureType': 'administrative',
                            'stylers': [{
                                'visibility': 'on'
                            }, {
                                'lightness': 33
                            }]
                        }, {
                            'featureType': 'road'
                        }, {
                            'featureType': 'poi.park',
                            'elementType': 'labels',
                            'stylers': [{
                                'visibility': 'on'
                            }, {
                                'lightness': 20
                            }]
                        }, {}, {
                            'featureType': 'road',
                            'stylers': [{
                                'lightness': 20
                            }]
                        }]
                    },

                    map_canvas2: {
                        zoom: 11,

                        // disable default UI
                        controls: false,

                        latitude: 40.6700, // New York,
                        longitude: -73.9400,

                        styles: [{
                            "stylers": [{
                                "saturation": -100
                            }, {
                                "gamma": 1
                            }]
                        }, {
                            "elementType": "labels.text.stroke",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "poi.business",
                            "elementType": "labels.text",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "poi.business",
                            "elementType": "labels.icon",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "poi.place_of_worship",
                            "elementType": "labels.text",
                            "stylers": [{

                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "poi.place_of_worship",
                            "elementType": "labels.icon",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [{
                                "visibility": "simplified"
                            }]
                        }, {
                            "featureType": "water",
                            "stylers": [{
                                "visibility": "on"
                            }, {
                                "saturation": 50
                            }, {
                                "gamma": 0
                            }, {
                                "hue": "#50a5d1"
                            }]
                        }, {
                            "featureType": "administrative.neighborhood",
                            "elementType": "labels.text.fill",
                            "stylers": [{
                                "color": "#333333"
                            }]
                        }, {
                            "featureType": "road.local",
                            "elementType": "labels.text",
                            "stylers": [{
                                "weight": 0.5
                            }, {
                                "color": "#333333"
                            }]
                        }, {
                            "featureType": "transit.station",
                            "elementType": "labels.icon",
                            "stylers": [{
                                "gamma": 1
                            }, {
                                "saturation": 10
                            }]
                        }]
                    },

                    map_canvas3: {
                        zoom: 11,

                        // disable default UI
                        controls: false,

                        latitude: 40.6700, // New York,
                        longitude: -73.9400,

                        styles: [{
                            "featureType": "water",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#81c1d9"
                            }]
                        }, {
                            "featureType": "landscape",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#f0f0ed"
                            }]
                        }, {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#c4c5c5"
                            }]
                        }, {
                            "featureType": "poi",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#e2e8e7"
                            }]
                        }, {
                            "featureType": "transit",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#e2e8e7"
                            }]
                        }, {
                            "elementType": "labels.text.stroke",
                            "stylers": [{
                                "visibility": "on"
                            }, {
                                "color": "#81c1d9"
                            }, {
                                "weight": 6
                            }]
                        }, {
                            "elementType": "labels.text.fill",
                            "stylers": [{
                                "color": "#ffffff"
                            }]
                        }, {
                            "featureType": "administrative",
                            "elementType": "geometry",
                            "stylers": [{
                                "weight": 0.2
                            }, {
                                "color": "#1a3541"
                            }]
                        }, {
                            "elementType": "labels.icon",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "poi.park",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#e2e8e7"
                            }]
                        }]
                    },

                    // settings for map in mega menu
                    googlemaps1: {

                        // allow map controls
                        controls: {
                            panControl: true,
                            zoomControl: true,
                            mapTypeControl: true,
                            scaleControl: true,
                            streetViewControl: false,
                            overviewMapControl: true
                        },

                        // disable scroll wheel
                        scrollwheel: false,

                        // setup custom marker
                        markers: [{

                            latitude: 40.6700,
                            longitude: -73.9400,


                            html: "<strong>ORB Head Office</strong><br>Boulevard of Broken Dreams 66, Apt 99<br>",
                            icon: {
                                image: "images/pin.png",
                                iconsize: [35, 55],
                                iconanchor: [35, 55]
                            }
                        }],


                        styles: [{
                            "featureType": "water",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#a2daf2"
                            }]
                        }, {
                            "featureType": "landscape.man_made",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#f7f1df"
                            }]
                        }, {
                            "featureType": "landscape.natural",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#d0e3b4"
                            }]
                        }, {
                            "featureType": "landscape.natural.terrain",
                            "elementType": "geometry",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "poi.park",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#bde6ab"
                            }]
                        }, {
                            "featureType": "poi",
                            "elementType": "labels",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "poi.medical",
                            "elementType": "geometry",
                            "stylers": [{
                                "color": "#fbd3da"
                            }]
                        }, {
                            "featureType": "poi.business",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "road",
                            "elementType": "geometry.stroke",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "road",
                            "elementType": "labels",
                            "stylers": [{
                                "visibility": "off"
                            }]
                        }, {
                            "featureType": "road.highway",
                            "elementType": "geometry.fill",
                            "stylers": [{
                                "color": "#ffe15f"
                            }]
                        }, {
                            "featureType": "road.highway",
                            "elementType": "geometry.stroke",
                            "stylers": [{
                                "color": "#efd151"
                            }]
                        }, {
                            "featureType": "road.arterial",
                            "elementType": "geometry.fill",
                            "stylers": [{
                                "color": "#ffffff"
                            }]
                        }, {
                            "featureType": "road.local",
                            "elementType": "geometry.fill",
                            "stylers": [{
                                "color": "black"
                            }]
                        }, {
                            "featureType": "transit.station.airport",
                            "elementType": "geometry.fill",
                            "stylers": [{
                                "color": "#cfb2db"
                            }]
                        }],


                        // initial coordinates
                        latitude: 40.6700,
                        longitude: -73.9400,

                        zoom: 10
                    }
                };

                // sometimes we want to resize map after it's container has been resized,
                // so we can specify an element and event to trigger map resize
                var resizeEvents = {
                    googlemaps1: {
                        target: '.dropdown',
                        evt: 'show.bs.dropdown'
                    }
                };

                // setup maps
                $('.map-container').each(function () {

                    // for each map on the page, take it's options by id
                    var mapSettings = mapOptions[this.id];

                    // create map
                    var $map = $(this).gMap(mapSettings);

                    // store the reference to 'native' google map object
                    var map = $map.data('gMap.reference');

                    // apply styling if any
                    var styles = mapSettings['styles'];
                    if (styles) {
                        map.setOptions({
                            styles: styles
                        });
                    }

                    // do subscribe on events to resize after
                    var evts;
                    if (evts = resizeEvents[this.id] || resizeEvents['*']) {
                        $(evts.target).on(evts.evt, function () {
                            var center = map.getCenter();
                            setTimeout(function () {
                                google.maps.event.trigger($map[0], 'resize');
                                map.setCenter(center);
                            }, 10);
                        });
                    }
                });

            }
        });


        // ========================================================================
        //  Forms
        // ========================================================================

        //Masking

        //Masking

        if ($('#mobilephone').length) {
            $('#mobilephone').mask('0999-9999999', {
                placeholder: 'X'
            });
        }

        if ($('#landline').length) {
            $('#landline').mask('99-99999999', {
                placeholder: 'X'
            });
        }

        if ($('#nic').length) {
            $('#nic').mask('99999-9999999-9', {
                placeholder: 'X'
            });
        }


        //Datepicker DOB and DOJ

        // Regular datepicker
        if ($('#date').length) {
            $('#date').datepicker({
                dateFormat: 'dd-mm-yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>'
            });
        }

        // Date range
        if ($('#start').length) {
            $('#start').datepicker({
                dateFormat: 'dd-mm-yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>',
                onSelect: function (selectedDate) {
                    $('#finish').datepicker('option', 'minDate', selectedDate);
                }
            });
        }
        if ($('#finish').length) {
            $('#finish').datepicker({
                dateFormat: 'dd-mm-yy',
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




        // Validation Examples




        // Available Validations
        if ($('#available-validations').length) {

            $("#available-validations").validate({
                // Rules for form validation
                rules: {
                    required: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    url: {
                        required: true,
                        url: true
                    },
                    date3: {
                        required: true,
                        date: true
                    },
                    min: {
                        required: true,
                        minlength: 5
                    },
                    max: {
                        required: true,
                        maxlength: 5
                    },
                    range: {
                        required: true,
                        rangelength: [5, 10]
                    },
                    digits: {
                        required: true,
                        digits: true
                    },
                    number: {
                        required: true,
                        number: true
                    },
                    minVal: {
                        required: true,
                        min: 5
                    },
                    maxVal: {
                        required: true,
                        max: 100
                    },
                    rangeVal: {
                        required: true,
                        range: [5, 100]
                    }
                },

                // Messages for form validation
                messages: {
                    required: {
                        required: 'Please enter something'
                    },
                    email: {
                        required: 'Please enter your email address'
                    },
                    url: {
                        required: 'Please enter your URL'
                    },
                    date3: {
                        required: 'Please enter some date in mm/dd/yyyy format'
                    },
                    min: {
                        required: 'Please enter some text'
                    },
                    max: {
                        required: 'Please enter some text'
                    },
                    range: {
                        required: 'Please enter some text'
                    },
                    digits: {
                        required: 'Please enter some digits'
                    },
                    number: {
                        required: 'Please enter some number'
                    },
                    minVal: {
                        required: 'Please enter some value'
                    },
                    maxVal: {
                        required: 'Please enter some value'
                    },
                    rangeVal: {
                        required: 'Please enter some value'
                    }
                },

                // Do not change code below
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }




        // Login Form Validation
        if ($('#login-form').length) {
            $("#login-form").validate({
                // Rules for form validation
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    }
                },

                // Messages for form validation
                messages: {
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    password: {
                        required: 'Please enter your password'
                    }
                },

                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });

        }

        // Checkout Form Validation


        if ($('#checkout-form').length) {
            $('#checkout-form').validate({

                // Rules for form validation
                rules: {
                    fname: {
                        required: true
                    },
                    lname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    code: {
                        required: true,
                        digits: true
                    },
                    address: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    card: {
                        required: true
                    },
                    cvv: {
                        required: true,
                        digits: true
                    },
                    month: {
                        required: true
                    },
                    year: {
                        required: true,
                        digits: true
                    }
                },

                // Messages for form validation
                messages: {
                    fname: {
                        required: 'Please enter your first name'
                    },
                    lname: {
                        required: 'Please enter your last name'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    phone: {
                        required: 'Please enter your phone number'
                    },
                    country: {
                        required: 'Please select your country'
                    },
                    city: {
                        required: 'Please enter your city'
                    },
                    code: {
                        required: 'Please enter code',
                        digits: 'Digits only please'
                    },
                    address: {
                        required: 'Please enter your full address'
                    },
                    name: {
                        required: 'Please enter name on your card'
                    },
                    card: {
                        required: 'Please enter your card number'
                    },
                    cvv: {
                        required: 'Enter CVV2',
                        digits: 'Digits only'
                    },
                    month: {
                        required: 'Select month'
                    },
                    year: {
                        required: 'Enter year',
                        digits: 'Digits only please'
                    }
                },


                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }

        //Order Form Validation
        if ($('#order-form').length) {
            $("#order-form").validate({
                // Rules for form validation
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true
                    },
                    interested: {
                        required: true
                    },
                    budget: {
                        required: true
                    }
                },

                // Messages for form validation
                messages: {
                    name: {
                        required: 'Please enter your name'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    phone: {
                        required: 'Please enter your phone number'
                    },
                    interested: {
                        required: 'Please select interested service'
                    },
                    budget: {
                        required: 'Please select your budget'
                    }
                },

                // Ajax form submition
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        beforeSend: function () {
                            $('#order-form button[type="submit"]').addClass('button-uploading').attr('disabled', true);
                        },
                        uploadProgress: function (event, position, total, percentComplete) {
                            $("#order-form .progress").text(percentComplete + '%');
                        },
                        success: function () {
                            $("#order-form").addClass('submited');
                            $('#order-form button[type="submit"]').removeClass('button-uploading').attr('disabled', false);
                        }
                    });
                },

                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }


        //Registration Form Validation
        
        if ($('#registration-form').length) {
            $("#registration-form").validate({
                // Rules for form validation
                rules: {
                    username: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    passwordConfirm: {
                        required: true,
                        minlength: 3,
                        maxlength: 20,
                        equalTo: '#password'
                    },
                    firstname: {
                        required: true
                    },
                    lastname: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    terms: {
                        required: true
                    }
                },

                // Messages for form validation
                messages: {
                    login: {
                        required: 'Please enter your login'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    password: {
                        required: 'Please enter your password'
                    },
                    passwordConfirm: {
                        required: 'Please enter your password one more time',
                        equalTo: 'Please enter the same password as above'
                    },
                    firstname: {
                        required: 'Please select your first name'
                    },
                    lastname: {
                        required: 'Please select your last name'
                    },
                    gender: {
                        required: 'Please select your gender'
                    },
                    terms: {
                        required: 'You must agree with Terms and Conditions'
                    }
                },

                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }

        //Review Form Validation
        if ($('#review-form').length) {
            $("#review-form").validate({
                // Rules for form validation
                rules: {
                    name: {
                        required: true
                    },

                    email: {
                        required: true,
                        email: true
                    },
                    review: {
                        required: true,
                        minlength: 20
                    },
                    quality: {
                        required: true
                    },
                    reliability: {
                        required: true
                    },
                    overall: {
                        required: true

                    }
                },

                // Messages for form validation
                messages: {
                    name: {
                        required: 'Please enter your name'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    review: {
                        required: 'Please enter your review'
                    },
                    quality: {
                        required: 'Please rate quality of the product'
                    },
                    reliability: {

                        required: 'Please rate reliability of the product'
                    },
                    overall: {
                        required: 'Please rate the product'
                    }
                },

                // Ajax form submition                  
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        beforeSend: function () {
                            $('#review-form button[type="submit"]').attr('disabled', true);
                        },
                        success: function () {
                            $("#review-form").addClass('submited');
                        }
                    });
                },


                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }

        //Steps Validation          

        if ($('#wizard').length) {
            $('#wizard').steps({
                bodyTag: 'fieldset',
                autoFocus: true,
                transitionEffect: 'slideLeft',
                finish: 'Continue',
                onStepChanging: function (e, i, j) {
                    $("#steps-wizard").validate().settings.ignore = ":disabled,:hidden";
                    return $("#steps-wizard").valid();
                },
                onFinishing: function () {
                    $("#steps-wizard").validate().settings.ignore = ":disabled";
                    return $("#steps-wizard").valid();
                },
                onFinished: function () {
                    $("#steps-wizard").submit();
                }
            });
        }



        // Validation
        if ($('#steps-wizard').length) {
            $('#steps-wizard').validate({
                // Rules for form validation
                rules: {
                    fname: {
                        required: true
                    },
                    lname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    code: {
                        required: true,
                        digits: true
                    },
                    address: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    card: {
                        required: true,
                    },
                    cvv: {
                        required: true,
                        digits: true
                    },
                    month: {
                        required: true
                    },
                    year: {
                        required: true,
                        digits: true
                    }
                },

                // Messages for form validation
                messages: {
                    fname: {
                        required: 'Please enter your first name'
                    },
                    lname: {
                        required: 'Please enter your last name'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address'
                    },
                    phone: {
                        required: 'Please enter your phone number'
                    },
                    country: {
                        required: 'Please select your country'
                    },
                    city: {
                        required: 'Please enter your city'
                    },
                    code: {
                        required: 'Please enter code',
                        digits: 'Digits only please'
                    },
                    address: {
                        required: 'Please enter your full address'
                    },
                    name: {
                        required: 'Please enter name on your card'
                    },
                    card: {
                        required: 'Please enter your card number'
                    },
                    cvv: {
                        required: 'Enter CVV2',
                        digits: 'Digits only'
                    },
                    month: {
                        required: 'Select month'
                    },
                    year: {
                        required: 'Enter year',
                        digits: 'Digits only please'
                    }
                },

                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }

        // ========================================================================
        //  Easy Pie Charts
        // ========================================================================

        //Facebook//
        if ($('#easy1').length) {
            $('#easy1').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '20',
                size: 90,
                trackColor: '#f0f0ed',
                lineCap: 'butt',
                barColor: '#47639e',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }

        //Twitter//
        if ($('#easy2').length) {
            $('#easy2').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '20',
                size: 90,
                trackColor: '#f0f0ed',
                lineCap: 'butt',
                barColor: '#55acee',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }
        //Pinterest//
        if ($('#easy3').length) {
            $('#easy3').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '20',
                size: 90,
                trackColor: '#f0f0ed',
                lineCap: 'butt',
                barColor: '#cb2027',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }
        //Dribble//
        if ($('#easy4').length) {
            $('#easy4').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '20',
                size: 90,
                trackColor: '#f0f0ed',
                lineCap: 'butt',
                barColor: '#333',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }

        //GooglePlus//
        if ($('#easy5').length) {
            $('#easy5').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '20',
                size: 90,
                trackColor: '#f0f0ed',
                lineCap: 'butt',
                barColor: '#a0c3ff',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }

        //VK//
        if ($('#easy6').length) {
            $('#easy6').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '20',
                size: 90,
                trackColor: '#f0f0ed',
                lineCap: 'butt',
                barColor: '#597da3',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));

                }
            });
        }

        if ($('#easy7').length) {
            $('#easy7').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '23',
                trackColor: '#999',
                lineCap: 'butt',
                barColor: '#fff',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }

        if ($('#easy8').length) {
            $('#easy8').easyPieChart({
                easing: 'easeOutBounce',
                lineWidth: '23',
                trackColor: '#cacac8',
                lineCap: 'butt',
                barColor: '#949fb2',
                scaleColor: false,
                onStep: function (from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
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

            // ========================================================================
            //  Sign Out Modal
            // ========================================================================            

            $(".goaway").click(function (e) {
                e.preventDefault();
                $('#signout').modal();
                $('#yesigo').click(function () {
                    window.open('admin-login.html', '_self');
                    $('#signout').modal('hide');
                });

            });
        }


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

        // ========================================================================
        //  ChartJs (js\vendors\chartjs)
        // ========================================================================

        //Donut Demo
        var doughnutData = [{
                value: 30,
                color: "#82b964"
            }, {
                value: 50,
                color: "#58b868"
            }, {
                value: 100,
                color: "#009485"
            }, {
                value: 40,
                color: "#ccd600"
            }, {
                value: 120,
                color: "#f4cc13"
            }

        ];

        var doughnutoptions = {
            segmentShowStroke: false,
            percentageInnerCutout: 40
        };


        //Donut on Index
        var doughnutData2 = [{
                value: 30,
                color: "#595f66"
            }, {
                value: 50,
                color: "#f4cc13"
            }, {
                value: 100,
                color: "#fff"
            }, {
                value: 40,
                color: "#454b52"

            }

        ];

        var doughnutoptions2 = {
            segmentShowStroke: false,
            percentageInnerCutout: 40
        };


        //Donut on Index
        var doughnutData3 = [{
                value: 15,
                color: "#a7609a"
            }, {
                value: 35,
                color: "#d24d33"
            }, {
                value: 10,
                color: "#f87aa0"
            }, {
                value: 40,
                color: "#f0ad4e"
            }

        ];

        var doughnutoptions3 = {
            segmentShowStroke: false,
            percentageInnerCutout: 40
        };


        //Donut on Index
        var doughnutData4 = [{
                value: 40,
                color: "#454b52"
            }, {
                value: 20,
                color: "#fff"
            }, {
                value: 20,
                color: "#5bc0de"
            }, {
                value: 20,
                color: "#993838"
            }

        ];

        var doughnutoptions4 = {
            segmentShowStroke: false,
            percentageInnerCutout: 40
        };


        //LineChart Demo
        var lineChartData = {
            labels: ["", "", "", "", "", "", ""],
            datasets: [{
                    fillColor: "rgba(150,159,161,0.5)",
                    strokeColor: "rgba(150,159,161,1)",
                    pointColor: "rgba(150,159,161,1)",
                    pointStrokeColor: "#fff",
                    data: [65, 59, 90, 81, 56, 55, 40]
                }, {
                    fillColor: "rgba(91,192,222,0.5)",
                    strokeColor: "rgba(91,192,222,1)",
                    pointColor: "rgba(91,192,222,1)",
                    pointStrokeColor: "#fff",
                    data: [28, 48, 40, 19, 96, 27, 100]
                }

            ]
        };




        var lineChartDataoptions = {
            scaleFontFamily: "'Open Sans'",
            scaleFontSize: 11,
        };


        //LineChart Portlet
        var lineChartData2 = {
            labels: ["", "", "", "", "", "", ""],
            datasets: [{
                fillColor: "rgba(244,204,19,0.5)",
                strokeColor: "#f4cc13",
                data: [65, 59, 99, 81, 56, 55, 40]
            }, {
                fillColor: "rgba(91,192,222,0.5)",
                strokeColor: "rgba(91,192,222,1)",
                data: [28, 48, 88, 56, 72, 65, 100]
            }, {
                fillColor: "rgba(255,255,255,0.5)",
                strokeColor: "#fff",
                data: [12, 32, 42, 13, 33, 27, 59]
            }]


        };

        var lineChartDataoptions2 = {
            pointDot: false,
            datasetStrokeWidth: 4,
            scaleShowGridLines: true,
            scaleShowLabels: false,
        };


        //LineChart Portlet
        var lineChartData3 = {
            labels: ["", "", "", "", "", "", ""],
            datasets: [{
                fillColor: "rgba(51,56,61,0.8)",
                strokeColor: "#33383d",
                data: [88, 71, 99, 83, 99, 66, 71]
            }, {
                fillColor: "rgba(153,56,56,0.8)",
                strokeColor: "#993838",
                data: [65, 59, 99, 81, 56, 55, 0]
            }, {
                fillColor: "rgba(210,77,51,0.8)",
                strokeColor: "#d24d33",
                data: [28, 48, 88, 56, 72, 10, 0]
            }, {
                fillColor: "rgba(240,173,78,0.8)",
                strokeColor: "#f0ad4e",
                data: [12, 32, 42, 13, 33, 27, 0]
            }]


        };

        var lineChartDataoptions3 = {
            pointDot: false,
            datasetStrokeWidth: 4,
            scaleShowGridLines: true,
            scaleShowLabels: false,
        };


        //PieChart Demo
        var pieData = [{
                value: 30,
                color: "#f87aa0"
            }, {
                value: 50,
                color: "#a7609a"
            }, {
                value: 20,
                color: "#d24d33"
            }, {
                value: 10,
                color: "#454b52"
            }, {
                value: 20,
                color: "#993838"
            }

        ];

        var pieChartoptions = {
            segmentShowStroke: false

        };

        //BarChart Demo
        var barChartData = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],

            datasets: [{
                fillColor: "rgba(150,159,161,0.5)",
                strokeColor: "rgba(150,159,161,1)",
                data: [65, 59, 90, 81, 56, 55, 40]
            }, {
                fillColor: "rgba(210,77,51,0.5)",
                strokeColor: "rgba(210,77,51,1)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }],
        };

        var barChartoptions = {
            scaleFontFamily: "'Open Sans'",
            scaleFontSize: 11,
        };


        //PolarChart Demo
        var chartData = [{
            value: Math.random(),
            color: "#a7609a"
        }, {
            value: Math.random(),
            color: "#d24d33"
        }, {
            value: Math.random(),
            color: "#21323D"
        }, {
            value: Math.random(),
            color: "#9D9B7F"
        }, {
            value: Math.random(),
            color: "#7D4F6D"
        }, {
            value: Math.random(),
            color: "#82b964"
        }];



        var polarChartoptions = {
            scaleFontFamily: "'Open Sans'",
            scaleFontSize: 10,
            scaleBackdropColor: "rgba(0,0,0,0.75)",
            scaleBackdropPaddingY: 4,
            scaleBackdropPaddingX: 4,
            scaleFontColor: "#fff",
            segmentShowStroke: false,

        };



        //RadarChart Demo
        var radarChartData = {
            labels: ["", "", "", "", "", "", ""],
            datasets: [{
                fillColor: "rgba(150,159,161,0.5)",
                strokeColor: "rgba(150,159,161,1)",
                pointColor: "rgba(150,159,161,1)",
                pointStrokeColor: "#fff",
                data: [65, 59, 90, 81, 56, 55, 40]
            }, {
                fillColor: "rgba(88,184,104,0.5)",
                strokeColor: "rgba(88,184,104,1)",
                pointColor: "rgba(88,184,104,1)",
                pointStrokeColor: "#fff",
                data: [28, 48, 40, 19, 96, 27, 100]
            }]

        };




        if ($('#chartjs-doughnut').length > 0) {
            new Chart(document.getElementById("chartjs-doughnut").getContext("2d")).Doughnut(doughnutData, doughnutoptions);
        }
        if ($('#chartjs-doughnut2').length > 0) {
            new Chart(document.getElementById("chartjs-doughnut2").getContext("2d")).Doughnut(doughnutData2, doughnutoptions2);
        }
        if ($('#chartjs-doughnut3').length > 0) {
            new Chart(document.getElementById("chartjs-doughnut3").getContext("2d")).Doughnut(doughnutData3, doughnutoptions3);
        }
        if ($('#chartjs-doughnut4').length > 0) {
            new Chart(document.getElementById("chartjs-doughnut4").getContext("2d")).Doughnut(doughnutData4, doughnutoptions4);
        }

        if ($('#chartjs-line').length > 0) {
            new Chart(document.getElementById("chartjs-line").getContext("2d")).Line(lineChartData, lineChartDataoptions);
        }
        if ($('#chartjs-line-portlet').length > 0) {
            new Chart(document.getElementById("chartjs-line-portlet").getContext("2d")).Line(lineChartData2, lineChartDataoptions2);
        }
        if ($('#chartjs-line-portlet2').length > 0) {
            new Chart(document.getElementById("chartjs-line-portlet2").getContext("2d")).Line(lineChartData3, lineChartDataoptions3);
        }
        if ($('#chartjs-radar').length > 0) {
            new Chart(document.getElementById("chartjs-radar").getContext("2d")).Radar(radarChartData);
        }
        if ($('#chartjs-polarArea').length > 0) {
            new Chart(document.getElementById("chartjs-polarArea").getContext("2d")).PolarArea(chartData, polarChartoptions);
        }
        if ($('#chartjs-bar').length > 0) {
            new Chart(document.getElementById("chartjs-bar").getContext("2d")).Bar(barChartData, barChartoptions);
        }
        if ($('#chartjs-pie').length > 0) {
            new Chart(document.getElementById("chartjs-pie").getContext("2d")).Pie(pieData, pieChartoptions);
        }




    });

    // ========================================================================
    //  MegaMenu Elements
    // ========================================================================

    // The following code is used to initialize widgets inside dropdown menu
    // after they becomes visible
    // Please note that Google Maps Inits JS in you can found in Google Maps Section of this file


    $('.dropdown').on('show.bs.dropdown', function () {
        var $this = $(this);
        setTimeout(function () {

            // carousels
            var $carousel = $('.carousel', $this).carousel();
            $('[data-slide], [data-slide-to]', $carousel).click(function (e) {
                e.preventDefault();
                $(this).trigger('click.bs.carousel.data-api');
            });

            // tabs
            var $tabs = $('#tabs', $this).tab();
            $('[data-toggle="tab"], [data-toggle="pill"]', $tabs).click(function (e) {
                e.preventDefault();
                $(this).trigger('click.bs.tab.data-api');
            });
        }, 10);
    });

    // ========================================================================
    //  Scroll To Top
    // ========================================================================

    $('.smooth-overflow').on('scroll', function () {

        if ($(this).scrollTop() > 100) {
            $('.scroll-top-wrapper').addClass('show');
        } else {
            $('.scroll-top-wrapper').removeClass('show');
        }
    });

    $('.scroll-top-wrapper').on('click', scrollToTop);

    function scrollToTop() {
            var verticalOffset = typeof (verticalOffset) != 'undefined' ? verticalOffset : 0;
            var element = $('body');
            var offset = element.offset();
            var offsetTop = offset.top;
            $('.smooth-overflow').animate({
                scrollTop: offsetTop
            }, 400, 'linear');
        }
        //----------------------------------------------------------------------


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

</script>
<script type="text/javascript" src="<?php echo base_url()?>components/js/anstyle.js"></script>
<!--/Scripts-->

</body>
</html>