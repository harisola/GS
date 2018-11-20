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


<!-- Select 2 -->
<script src="<?php echo base_url()?>components/select2/select2.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#select_position_tags").select2();
  });
</script>


<!-- <script>
var highestCol = Math.max($('#element1').height(),$('#element2').height());
$('.elements').height(highestCol);
</script> -->


<!--GMap--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/gmap/jquery.gmap.js"></script> 

<!--Fullscreen--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/fullscreen/screenfull.min.js"></script> 

<!--Forms-->

<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script> 


<!--NanoScroller--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/nanoscroller/jquery.nanoscroller.min.js"></script> 

<!--Sparkline--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/sparkline/jquery.sparkline.min.js"></script> 

<!--Horizontal Dropdown--> 
<!-- <script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/horisontal/cbpHorizontalSlideOutMenu.js"></script>  -->
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/classie/classie.js"></script> 


<!--Datatables-->
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/datatables/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/datatables/jquery.dataTables-bootstrap.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/datatables/dataTables.colVis.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/datatables/colvis.extras.js"></script> 



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


<!--ToDo--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/todos/todos.js"></script> 

<!--FitVids--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/fitvids/jquery.fitvids.js"></script> 

<script type="text/javascript">




$(document).ready(function(){
    $("#CloseNav").click(function(){
        $("#CloseNav").hide();
        $("#OpenNav").show();
    });
    $("#OpenNav").click(function(){
        $("#OpenNav").hide();
        $("#CloseNav").show();
    });
});
function openNav() {
    document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
    document.getElementById("myNav").style.width = "0%";
}
/* JS for Menu Dropdown*/
$(document).ready(function(){
    $(".hasChild").click(function(){
        $(this).children('.subMenu').toggle();
    });
});

/* JS for Menu class toggler */ 
$(document).ready(function(){
    $(".main_menu li.main").click(function(){
        $(this).children(".main_menu li a").toggleClass("selected");
    });
});

</script>


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

$('#EntitityListing').dataTable({
      "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
    "aLengthMenu": [[50, 60, 70, -1], [50, 60, 70, "All"]],
    "iDisplayLength": 50
  });
$('#TTListing2').dataTable({
      "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
	"bLengthChange": false,
	"bInfo" : false,
    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
    "iDisplayLength": 10
  });
  $('#TTListing').dataTable({
      "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
	"bLengthChange": false,
	"bInfo" : false,
    "aLengthMenu": [[25, 50, 70, -1], [25, 50, 70, "All"]],
    "iDisplayLength": 25,
    "bSort" : false
  });
$('#StaffListHere').dataTable({
      "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
	"bLengthChange": false,
	"bInfo" : false,
    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
    "iDisplayLength": 10
  });

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


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

        // var menu = new cbpHorizontalSlideOutMenu(document.getElementById('cbp-hsmenu-wrapper'));

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
});
</script>
<!--/Scripts-->




<!-- Script Disable Hover on Submenu -->
<!-- <script type="text/javascript">
  $(document).ready(function() {
      $(".dropdown-submenu").bind('click', false);
  });
</script> -->

<script type="text/javascript">
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



<script type="text/javascript">

  //========== Get Standard,Custom and Part Timer Profile ==============//

  $(document).on('change','#purpose',function(e){
    var profile_id = $(this).val();
    var profile_type_id = $('#purpose option:selected').attr('data-id');

    $('.loading').show();

    $.ajax({
      type:"POST",
      cache:false,
      data:{
        profile_id:profile_id,
        profile_type_id:profile_type_id
      },
      url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_ajax/get_profile",
      success:function(e){
        // console.log(e);
        $('#get_profile').html(e);

        calculating_hours(profile_type_id);



        $('.replace_table').html('');
        
        $.ajax({
        type:"POST",
        cache:false,
        data:{
          profile_id:profile_id,
          profile_type_id:profile_type_id
        },
        url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_ajax/get_left_panel_data",
        success:function(e){
            $('.replace_table').html(e);
            $('.loading').hide();
          } 
        });

        
      } // End Success
    });
    
  });

  //========= Allocation Profile to Staff ============//
  //==================================================//

  $(document).on('click','#allocate_profile',function(e){
    
    // AJAX PARAMETER FOR POST
    var profile_type_id = $('#profile_type_id').val();
    var profile_id = $('#profile_id').val();


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

     //======== FOR STANDARD PROFILE ===========//
     //=========================================// 

    if(staff_id != 0 && profile_type_id == 1){

      var morning_time = $('#std_morning').val();
      var afternoon_time = $('#std_afternoon').val();
      var wed_timeout = $('#std_wed').val();
      var fri_timeout = $('#std_fri').val();
      var ext_time = $('#std_ext').val();
      var ext_frequency =  $('#std_frequency').val();
      var ext_july = $('#std_july').val();
      var sat_hrs = $('#std_sat_hrs').val();
      var sat_off = $('#std_off').val();
      var sat_working = $('#std_working').val();
      var avg_hrs = $('#avg_hrs').val();
      $.ajax({
        type:"POST",
        cache:false,
        data:{
          staff_id:staff_id,
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
          profile_id:profile_id,
          avg_hrs:avg_hrs
        },
        url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_ajax/allocate_std_staff",
        success:function(e){

            // Success function  
           $('.alert-success').css('display','');
           $('.alert-success').fadeOut(5000);
        }
      });

    }

    //====================== FOR CUSTOM PROFILE=============//
    //======================================================//

    if(staff_id != 0 && profile_type_id == 2){
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
          staff_id:staff_id,
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
          profile_id:profile_id,
          avg_hrs:avg_hrs
        },
        url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_ajax/allocate_cus_staff",
        success:function(e){
           // Success function  
           $('.alert-success').css('display','');
           $('.alert-success').fadeOut(5000);
        }
      });
    }


    //======= For Part Timer ==============//
    //====================================//

   if(staff_id != 0 && profile_type_id == 3){

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
        staff_id:staff_id,
        profile_id:profile_id
        },
        url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_ajax/allocate_partTime_staff",
        success:function(e){
            // Success function  
           $('.alert-success').css('display','');
           $('.alert-success').fadeOut(5000);
        }
      })


    }


  });

 //==================================== EDIT STAFF =======================//

 $(document).on('click','.select-staff',function(e){
    
    var staff_id = $(this).attr('data-id');
    var profile_id = $(this).attr('data-profile');
    var staff_name = $(this).attr('data-staff_name');
    var profile_type_id = $(this).attr('data-profile_type');
    if($('#TTListing tbody tr').hasClass('selected')){
        $('#TTListing tbody tr').removeClass('selected');
    }

    $('.loading').show();
    $.ajax({
      type:"POST",
      cache:false,
      data:{
        staff_id:staff_id,
        profile_id:profile_id,
        staff_name:staff_name
      },
      url:"<?php echo base_url(); ?>index.php/tif_a/profile_allocation_ajax/get_update_allocation",
      success:function(e){
        $('.ProfileDetail').html(e);
        calculating_hours(profile_type_id);
        $('.loading').hide();
        $('.staffCheck').prop('checked', false);
        var td = $('#TTListing tbody tr td a[data-id = '+staff_id+']').closest("tr");
        td.addClass('selected');
      }
    });
    
 });


//============================ Updated Allocated Profile==============================//
//====================================================================================//

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
        url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_ajax/updated_custom_profile",
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
        url:"<?php echo base_url() ?>index.php/tif_a/profile_allocation_ajax/update_partTime_profile",
        success:function(e){

          // Success Function 
          $('.alert-success').css('display','');
          $('.alert-success').fadeOut(5000);
        }
      });

  } // END PART TIMER


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

//Select All CheckBox  

 $(document).on('click','#checkAllSelect',function() { 
      
    $(".staffCheck").prop('checked', $(this).prop("checked"));


 });

 // Refresh to Intial Page

 $(document).on('click','#refresh',function(){
  // alert('r');
  $.ajax({
    type:"POST",
    cache:false,
    url:"<?php echo base_url(); ?>index.php/tif_a/profile_allocation_ajax/get_refresh",
    success:function(e){
      $('.ProfileDetail').html(e);
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


 }

 $(document).on('change','#cus_morning,#cus_afternoon,#cus_fri,#cus_ext,#cus_frequency,#cus_sat_hrs,#cus_off',function(e){
    var profile_type_id = $('#profile_type_id').val();
    calculating_hours(profile_type_id);
 });

 $(document).on('change','#cus_afternoon',function(e){

    var cus_afternoon = $(this).val();
    if(cus_afternoon.length > 0){
      $('#cus_fri').val(cus_afternoon);
    }
 });

</script>






</body>
</html>