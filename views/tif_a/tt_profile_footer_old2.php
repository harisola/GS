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

    // $( window ).scroll(function() {
    //   alert('sdf');
    // });



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
    "iDisplayLength": 30
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
        // if ($('#july_start').length) {
        //     $('#july_start').datepicker({
        //         dateFormat: 'dd.mm.yy',
        //         prevText: '<i class="fa fa-chevron-left"></i>',
        //         nextText: '<i class="fa fa-chevron-right"></i>',
        //         defaultDate: new Date('1 July 2014')
        //     });
        // }

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

<!---  TT Profile Scripting -->
  
<script type="text/javascript">


  //=============== On Change Selection ===============//
  //==================================================// 
  $(document).on('change','#purpose', function() {
      if (this.value == '')
      {
        $(".standardDIV").hide();
        $(".customDIV").hide();
        $(".partTIMEDIV").hide();
      }
  });
  $(document).on('change','#purpose', function() {
      if (this.value == '1')
      {
        $(".standardDIV").show();
        $(".customDIV").hide();
        $(".partTIMEDIV").hide();
      }
  });
  $(document).on('change','#purpose', function() {
      if (this.value == '2')
      {
        $(".standardDIV").hide();
        $(".customDIV").show();
        $(".partTIMEDIV").hide();
      }
      });
  $(document).on('change','#purpose', function() {

    if (this.value == '3')
      {
        $(".standardDIV").hide();
        $(".customDIV").hide();
        $(".partTIMEDIV").show();
      }

    });
  

  //================= Add Profile ====================//
  //==================================================//



  $(document).on('click','#add_profile',function(){

    $('.loading').show();

      $.ajax({
        type:"POST",
        cache:false,
        url:"<?php echo base_url() ?>index.php/tif_a/tt_profile_ajax/add_new_profile",
        success:function(e){
          $('.add_profile_response').html(e);
          $('.loading').hide();
        }
      });
  });


//====================== Insert Profile ===============//
//====================================================//

$(document).on('click','#insert_profile',function(){
  var option =  $('#purpose option:selected').val();

    var $form = $('#form-profile');
    var validator = $form.validate({

      rules:{
        profile_name:"required",
        select_profile:"required",
        morning_time:"required",
        afternoon_time:"required",
        custom_morning : "required",
        custom_afternoon:"required",
        
      },
      messages:{
        profile_name:"Please Enter Profile Name",
        select_profile:"Please Select the Profile",
        morning_time:"Enter Time",
        afternoon_time:"Enter  Time",
        custom_morning: "Enter Time",
        custom_afternoon:"Enter Time"

      },


    });




    //validate the form
    validator.form();


  //============== Standard Timing  Wizard ================//
  //=======================================================//
    if(option == 1){

      // check for validation Form
       if ($form.valid()) {
          


          var profile_name =  $('#profile_name').val();
          var morning_time = $('#morning_time').val();
          var afternoon_time = $('#afternoon_time').val();
          var wed_time = $('#wed_time').val();
          var fri_time = $('#fri_time').val();
          var ext_time = $('#ext_time').val();
          var ext_frequency = $('#ext_frequency').val();
          var july_start = $('#july_start').val();
          var sat_hour = $('#sat_hour').val();
          var sat_off = $('#sat_off').val();
          var sat_on = $('#sat_on').val();
          var avg_hrs = $('#avg_hrs').val();



          //================== Insert Profile Information ==================//
          //================================================================//

          $.ajax({
            type:"POST",
            cache:false,
            data:{
              profile_type:option,
              profile_name:profile_name,
            },
            url:"<?php echo base_url() ?>index.php/tif_a/tt_profile_ajax/insert_tt_profile",
            success:function(e){
                
                var profile_id = e;
                $.ajax({
                  type:"POST",
                  cache:false,
                  data:{
                    profile_id:profile_id,
                    morning_time:morning_time,
                    afternoon_time:afternoon_time,
                    wed_time:wed_time,
                    fri_time:fri_time,
                    ext_time:ext_time,
                    ext_frequency:ext_frequency,
                    july_start:july_start,
                    sat_hour:sat_hour,
                    sat_off:sat_off,
                    sat_on:sat_on,
                    avg_hrs:avg_hrs
                  },
                  url:"<?php echo base_url() ?>index.php/tif_a/tt_profile_ajax/insert_profile_timing",
                  success:function(e){
                    // console.log(e);

                    // Updated Left Panel

                    left_panel();

                    $('.alert-success').css('display','');
                    $('.alert-success').fadeOut(5000);

                  }
                });

            }
          });


       } // End Validation
    }


    //========================== Custom Profile Insertion ========================================//
    //==================================================================================//
    if(option == 2 ){

      // check for validation Form
       if ($form.valid()) {
        
        var profile_name = $('#profile_name').val();
        var morning_time  = $('#cus_morning').val();
        var afternoon_time = $('#cus_afternoon').val();
        var wed_time = $('#cus_wed').val();
        var cus_fri = $('#cus_fri').val();
        var cus_ext_time = $('#cus_ext_time').val();
        var cus_ext_freq = $('#cus_ext_freq').val();
        var cus_july_start = $('#cus_july_start').val();
        var cus_sat_hour = $('#cus_sat_hour').val();
        var cus_sat_off = $('#cus_sat_off').val();
        var cus_sat_working = $('#cus_sat_working').val();
        var avg_hrs = $('#cus_avg_weekly').val();


        $.ajax({
          type:"POST",
          cache:false,
          data:{
            profile_type:option,
            profile_name:profile_name,
          },
          url:"<?php echo base_url() ?>index.php/tif_a/tt_profile_ajax/insert_tt_profile",
          success:function(e){
            var profile_id = e;
            if(e != 0){
              $.ajax({
                type:"POST",
                cache:false,
                data:{
                  profile_id:profile_id,
                  morning_time:morning_time,
                  afternoon_time:afternoon_time,
                  wed_time:wed_time,
                  fri_time:cus_fri,
                  ext_time:cus_ext_time,
                  ext_frequency:cus_ext_freq,
                  july_start:cus_july_start,
                  sat_hour:cus_sat_hour,
                  sat_off:cus_sat_off,
                  sat_on:cus_sat_working,
                  avg_hrs:avg_hrs
                },
                url:"<?php echo base_url() ?>index.php/tif_a/tt_profile_ajax/insert_custom_timing",
                success:function(n){
                  console.log(n);
                  // Update Left Panel
                   left_panel();
                   $('.alert-success').css('display','');
                   $('.alert-success').fadeOut(5000);
                }
              }); // Ajax End
            } //     End IF
          }
        });

       } // End Validation

    }


    //=================================Part Timer Insertion ==================================//
    //=========================================================================================//

    if(option == 3){
      if($form.valid()){

        var profile_name = $('#profile_name').val();
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
        var avg_weekly = $('#part_time_avg').val();


        $.ajax({
          type:"POST",
          cache:false,
          data:{
            profile_type:option,
            profile_name:profile_name,
          },
          url:"<?php echo base_url(); ?>index.php/tif_a/tt_profile_ajax/insert_tt_profile",
          success:function(e){
            var profile_id = e;
            if(e != 0){
              $.ajax({
                type:"POST",
                cache:false,
                data:{
                  profile_id:profile_id,
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
                  avg_weekly:avg_weekly
                },
                url:"<?php echo base_url() ?>index.php/tif_a/tt_profile_ajax/insert_part_time_timing",
                success:function(f){
                  console.log(f);
                  // Update Left Panel
                  left_panel();
                  $('.alert-success').css('display','');
                  $('.alert-success').fadeOut(5000);
                }
              });
            }
            
          }
        }); 
        

      } // End Validation

    }
});


//==================== Calculation IN Calculating Timings ===========//
//===================================================================//


$(document).on('keypress change keyup','#morning_time,#afternoon_time,#fri_time,#cus_morning,#cus_afternoon,#cus_fri,#sat_hour,#sat_on,#sat_off,#ext_frequency,#ext_time,#cus_ext_time,#cus_ext_freq,#cus_sat_hour,#cus_sat_off,#cus_sat_working',function(e){
   
   var morning_time = $('#morning_time').val();
   var afternoon_time = $('#afternoon_time').val();
   var fri_hours = $('#fri_time').val();
   var sat_hours = $('#sat_hour').val();
   var sat_off = $('#sat_off').val();
   var sat_on = $('#sat_on').val();
   var ext_time = $('#ext_time').val();
   var ext_frequency = $('#ext_frequency').val();

   
   
   var custom_morning = $('#cus_morning').val();
   var custom_afternoon = $('#cus_afternoon').val();
   var custom_friday = $('#cus_fri').val();
   var difference_time;
   
   // Standard Morning And Afternoon Timing

   if(morning_time.length != 0 && afternoon_time.length != 0){
		var p = "1/1/1970 ";
		difference_mt = new Date(new Date(p+afternoon_time) - new Date(p+morning_time)).toUTCString().split(" ")[4];
		difference_f = new Date(new Date(p+fri_hours) - new Date(p+morning_time)).toUTCString().split(" ")[4];
		
		$('#mon_thurs_hours').val(difference_mt);		
					
			var t1 = difference_mt.split(':');
			var t2 = difference_f.split(':');
			//console.log(difference_f);
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
        
        // hour = parseInt(splitTime1[0])+parseInt(splitTime2[0])+parseInt(splitTime3[0]);
        // minute = parseInt(splitTime1[1])+parseInt(splitTime2[1])+parseInt(splitTime3[1]);
        // hour = hour + minute/60;
        // minute = minute%60;
        // second = parseInt(splitTime1[2])+parseInt(splitTime2[2])+parseInt(splitTime3[2]);
        // minute = minute + second/60;
        // second = second%60;
        
        //console.log('sum of above time= '+hour+':'+minute+':'+second);




			
			$('#avg_hrs').val(t1);
   }

   // Standard Friday Timing
    if(fri_hours.length != 0){
     console.log("The friday timing is "+fri_hours);
	  difference = new Date(new Date(p+fri_hours) - new Date(p+morning_time)).toUTCString().split(" ")[4];
	  $('#fri_hrs').val(difference);
    }

    // Custom Morning And Afternoon Timing

    if(custom_morning.length != 0 && custom_afternoon.length != 0){

    var sat_hours = $('#cus_sat_hour').val();
    var sat_off = $('#cus_sat_off').val();
    var sat_on = $('#cus_sat_working').val();
    var ext_time = $('#cus_ext_time').val();
    var ext_frequency = $('#cus_ext_freq').val();

      var p = "1/1/1970 ";
    difference_mt = new Date(new Date(p+custom_afternoon) - new Date(p+custom_morning)).toUTCString().split(" ")[4];
    difference_f = new Date(new Date(p+custom_friday) - new Date(p+custom_morning)).toUTCString().split(" ")[4];
    
    $('#cus_mon_thu_hrs').val(difference_mt);   
          
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
      
      $('#cus_avg_weekly').val(t1);

      // $('#cus_mon_thu_hrs').val(custom_afternoon);
      // $('#cus_avg_weekly').val(custom_afternoon);
    }

    if(custom_friday.length != 0){

      difference = new Date(new Date(p+custom_friday) - new Date(p+custom_morning)).toUTCString().split(" ")[4];
      //alert(difference);
    $('#cus_fri_hrs').val(difference);
      //$('#cus_fri_hrs').val(custom_friday);
    }

});


//====================== Calculating In  Updation Change ===================//
//=========================================================================//

   
  // Standard Updation

   $(document).on('keypress change keyup','#morning_time_update,#afternoon_time_update,#fri_time_update,#sat_hour_update,#ext_time_update,#ext_frequency_update,#sat_off_update,#sat_on_update',function(e){
   
   var morning_time = $('#morning_time_update').val();
   var afternoon_time = $('#afternoon_time_update').val();
   var fri_hours = $('#fri_time_update').val();
   var sat_hours = $('#sat_hour_update').val();
   var sat_off = $('#sat_off_update').val();
   var sat_on = $('#sat_on_update').val();
   var ext_time = $('#ext_time_update').val();
   var ext_frequency = $('#ext_frequency_update').val();
   
   
 

   // Standard Morning And Afternoon Timing

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

});
  
    // Custom Updation
    $(document).on('keypress change','#custom_morning_update,#cus_afternoon_update,#cus_fri_update,#cus_sat_hour_update,#cus_ext_time_update,#cus_ext_freq_update,#cus_sat_off_update,#cus_sat_working_update',function(){

      var custom_morning = $('#custom_morning_update').val();
      var custom_afternoon = $('#cus_afternoon_update').val();
      var custom_friday = $('#cus_fri_update').val();
      var sat_hours = $('#cus_sat_hour_update').val();
      var sat_off = $('#cus_sat_off_update').val();
      var sat_on = $('#cus_sat_working_update').val();
      var ext_time = $('#cus_ext_time_update').val();
      var ext_frequency = $('#cus_ext_freq_update').val();
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

    });



//========= Disable The text box  On =================//
//==================================================//
  

  // Standard Profile
  $(document).on('keypress change','#sat_off,#sat_on',function(e){

    var sat_off = $('#sat_off').val();
    var sat_on = $('#sat_on').val();

    if(sat_off != ''){
      $("#sat_on").attr('disabled','disabled');
    }

    if(sat_on != ''){
      $('#sat_off').attr('disabled','disabled');
    }

    if(sat_off == '' && sat_on == ''){
      $("#sat_off").removeAttr('disabled');
      $("#sat_on").removeAttr('disabled');
    }

  });

  // Custom Profile

  $(document).on('keypress change','#cus_sat_off,#cus_sat_working',function(e){

    var sat_off = $('#cus_sat_off').val();
    var sat_on = $('#cus_sat_working').val();

    if(sat_off != ''){
      $("#cus_sat_working").attr('disabled','disabled');
    }

    if(sat_on != ''){
      $('#cus_sat_off').attr('disabled','disabled');
    }

    if(sat_off == '' && sat_on == ''){
      $("#cus_sat_off").removeAttr('disabled');
      $("#cus_sat_working").removeAttr('disabled');
    }

  });


  // Standard Profile Update

    $(document).on('keypress change','#sat_off_update,#sat_on_update',function(e){

    var sat_off = $('#sat_off_update').val();
    var sat_on = $('#sat_on_update').val();

    if(sat_off != ''){
      $("#sat_on_update").attr('disabled','disabled');
    }

    if(sat_on != ''){
      $('#sat_off_update').attr('disabled','disabled');
    }

    if(sat_off == '' && sat_on == ''){
      $("#sat_off_update").removeAttr('disabled');
      $("#sat_on_update").removeAttr('disabled');
    }

  });

  // Custom Profile Update

$(document).on('keypress change','#cus_sat_off_update,#cus_sat_working_update',function(e){

    var sat_off = $('#cus_sat_off_update').val();
    var sat_on = $('#cus_sat_working_update').val();

    if(sat_off != ''){
      $("#cus_sat_working_update").attr('disabled','disabled');
    }

    if(sat_on != ''){
      $('#cus_sat_off_update').attr('disabled','disabled');
    }

    if(sat_off == '' && sat_on == ''){
      $("#cus_sat_off_update").removeAttr('disabled');
      $("#cus_sat_working_update").removeAttr('disabled');
    }

  });


  //======== Clear Button IS Pressed ===================//
  //====================================================//


  $(document).on('click','#greenBTN3',function(e){

    $('#profile_name').val('');
    $('#morning_time').val(''); 
    $('#afternoon_time').val('');
    $('#wed_time').val('');
    $('#fri_time').val('');
    $('#ext_time').val('');
    $('#ext_frequency').val('');
    $('#july_start').val('');
    $('#sat_hour').val('');
    $('#sat_off').val('');
    $('#sat_on').val('');
    $('#cus_morning').val('');
    $('#cus_afternoon').val('');
    $('#cus_wed').val('');
    $('#cus_fri').val('');
    $('#cus_ext_time').val('');
    $('#cus_ext_freq').val('');
    $('#cus_july_start').val('');
    $('#cus_sat_hour').val('');
    $('#cus_sat_off').val('');
    $('#cus_sat_working').val('');
    $('.editable').text('--:-- --');
  });


  //=========================================== Updation===========================//
  //==============================================================================//

  // Profile Selection For Update

  $(document).on('click','#profile_select',function(){
    var profile_id =  $(this).attr('data-id');
    var profile_name = $(this).text();
    var profile_type = $(this).attr('data-profileType');
    
    $('.add_profile_response').html('');
    $('.loading').show();
    $.ajax({
      type:"POST",
      cache:false,
      data:{
        id:profile_id,
        profile_name:profile_name
      },
      url:"<?php echo base_url() ?>index.php/tif_a/tt_profile_ajax/profile_update_interface",
      success:function(e){

        $('.add_profile_response').html(e);
        $('.loading').hide();

        //============= Standard Calculation ====================//
        //=======================================================//

         var morning_time = $('#morning_time_update').val();
         var afternoon_time = $('#afternoon_time_update').val();
         var fri_hours = $('#fri_time_update').val();
         var sat_hours = $('#sat_hour_update').val();
         var sat_off = $('#sat_off_update').val();
         var sat_on = $('#sat_on_update').val();
         var ext_time = $('#ext_time_update').val();
         var ext_frequency = $('#ext_frequency_update').val();
   
          
   

   
        if(profile_type == 1){
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
        }


        // ================= Custom Profile ========================//
        // ========================================================// 

        if(profile_type == 2){

          var custom_morning = $('#custom_morning_update').val();
          var custom_afternoon = $('#cus_afternoon_update').val();
          var custom_friday = $('#cus_fri_update').val();
          var sat_hours = $('#cus_sat_hour_update').val();
          var sat_off = $('#cus_sat_off_update').val();
          var sat_on = $('#cus_sat_working_update').val();
          var ext_time = $('#cus_ext_time_update').val();
          var ext_frequency = $('#cus_ext_freq_update').val();
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


        // ================== Part Timer Calculation ==========================//
        //====================================================================//

        if(profile_type == 3){

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

           if(typeof(time1)  != 'undefined'){
                time1 = difference_mon;
           }else{
                time1 = '00:00:00';
           }

           if(typeof(time2)  != 'undefined'){
                time2 = difference_tue;
           }else{
                time2 = '00:00:00';
           }


          if(typeof(time3)  != 'undefined'){
                time3 = difference_wed;
           }else{
                time3 = '00:00:00';
           }

           if(typeof(time4)  != 'undefined'){
                time4 = difference_thu;
           }else{
                time4 = '00:00:00';
           }

           if(typeof(time5)  != 'undefined'){
                time5 = difference_fri;
           }else{
                time5 = '00:00:00';
           }

           if(typeof(time6)  != 'undefined'){
                time6 = difference_sat;
           }else{
                time6 = '00:00:00';
           }
            
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

          } // End Part timer



      } // Success Function End

    });

  });


//============================ Profile Update ============================//
//========================================================================// 
$(document).on('click','#update_profile',function(){

  var profile_id =  $('#profile_id_update').val();
  var option = $('#purpose_update option:selected').val();

  var $form = $('#form_profile_updated');
  var validator = $form.validate({

      rules:{
        profile_name_update:"required",
        select_profile_update:"required",
        morning_time_update:"required",
        afternoon_time_update:"required",
        custom_morning_update : "required",
        custom_afternoon_udpate:"required",
        
      },
      messages:{
        profile_name_update:"Please Enter Profile Name",
        select_profile_update:"Please Select the Profile",
        morning_time_update:"Enter Time",
        afternoon_time_update:"Enter  Time",
        custom_morning_update: "Enter Time",
        custom_afternoon_udpate:"Enter Time"

      },


    });




    //validate the form
    validator.form();

   //============== Standard Timing  Wizard ================//
  //=======================================================//
    if(option == 1){

      // check for validation Form
       if ($form.valid()) {

        var profile_name = $('#profile_name_update').val();
        var morning_time = $('#morning_time_update').val();
        var afternoon_time = $('#afternoon_time_update').val();
        var wed_time = $('#wed_time_update').val();
        var fri_time = $('#fri_time_update').val();
        var ext_time = $('#ext_time_update').val();
        var ext_frequency = $('#ext_frequency_update').val();
        var july_start = $('#july_start_update').val();
        var sat_hour = $('#sat_hour_update').val();
        var sat_off = $('#sat_off_update').val();
        var sat_on = $('#sat_on_update').val();
        var avg_hrs = $('#avg_hrs').val();

        $.ajax({
          type:"POST",
          cache:false,
          data:{
            profile_id:profile_id,
            profile_name:profile_name,
            morning_time:morning_time,
            afternoon_time:afternoon_time,
            wed_time:wed_time,
            fri_time:fri_time,
            ext_time:ext_time,
            ext_frequency:ext_frequency,
            july_start:july_start,
            sat_hour:sat_hour,
            sat_off:sat_off,
            sat_on:sat_on,
            avg_hrs:avg_hrs
          },
          url:"<?php echo base_url() ?>index.php/tif_a/tt_profile_ajax/update_standard_profile",
          success:function(e){
            console.log(e);
            // Update Left Panel
             left_panel();
             $('.update-success').css('display','');
             $('.update-success').fadeOut(5000);
          }
        });


        

       } // Form Validation

    } // Standard Timing End

    //====================== Custom Timing Wizard ==================//
    //==============================================================//

    if(option == 2){
      if($form.valid()){
        
        var profile_name = $('#profile_name_update').val();
        var morning_time = $('#custom_morning_update').val();
        var afternoon_time = $('#cus_afternoon_update').val();
        var wed_time = $('#cus_wed_update').val();
        var fri_time = $('#cus_fri_update').val();
        var ext_time = $('#cus_ext_time_update').val();
        var ext_frequency = $('#cus_ext_freq_update').val();
        var july_start = $('#cus_july_start_update').val();
        var sat_hour = $('#cus_sat_hour_update').val();
        var sat_off = $('#cus_sat_off_update').val();
        var sat_on = $('#cus_sat_working_update').val();
        var avg_hrs = $('#avg_cus_cal').val();
        //alert(morning_time+''+afternoon_time+''+wed_time+''+fri_time+''+ext_time+''+ext_frequency+''+july_start+''+sat_hour+''+sat_off+''+sat_on);

        $.ajax({
          type:"POST",
          cache:false,
          data:{
            profile_id:profile_id,
            profile_name:profile_name,
            morning_time:morning_time,
            afternoon_time:afternoon_time,
            wed_time:wed_time,
            fri_time:fri_time,
            ext_time:ext_time,
            ext_frequency:ext_frequency,
            july_start:july_start,
            sat_hour:sat_hour,
            sat_off:sat_off,
            sat_on:sat_on,
            avg_hrs:avg_hrs
          },
          url:"<?php echo base_url() ?>index.php/tif_a/tt_profile_ajax/update_custom_profile",
          success:function(e){
            console.log(e);
            // Update Left Panel
             left_panel();
             $('.update-success').css('display','');
             $('.update-success').fadeOut(5000);
          }
        });


      } // End Validation
    } // End Custom Profile

  //========================== Part Timing Wizard ================//
  //=============================================================//

  if(option == 3){
   if($form.valid()){

    var profile_name = $('#profile_name_update').val();
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
    var part_time_avg = $('#part_time_avg').val();

    $.ajax({
      type:"POST",
      cache:false,
      data:{
        profile_id:profile_id,
        profile_name:profile_name,
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
        part_time_avg:part_time_avg
      },
      url:"<?php echo base_url() ?>index.php/tif_a/tt_profile_ajax/update_part_time_profile",
      success:function(e){
        console.log(e);
        // Update Left Panel
         left_panel();
         $('.update-success').css('display','');
         $('.update-success').fadeOut(5000);
      }
    });



   } // End Validation
  } // End Part Timer


  
});


// Left Panel After Updation

function left_panel(){
    $.ajax({
      type:"POST",
      cache:false,
      url:"<?php echo base_url() ?>index.php/tif_a/tt_profile_ajax/get_update_table",
      success:function(r){
        // console.log(r);
        $('.table-update').html(r);
      }
    });
}

//Afternoon time and Friday time

$(document).on('keypress change','#cus_afternoon,#afternoon_time',function(e){

    var custom_afternoon = $(this).val();
    if(custom_afternoon.length != 0 && e.target.id == 'cus_afternoon'){
      $('#cus_fri').val(custom_afternoon);
    }

    if(cus_afternoon.length != 0 && e.target.id == 'afternoon_time'){
      $('#fri_time').val(custom_afternoon);
    }


});


$(document).on('keyup','#profile_name',function(e){
  var profile_name = $(this).val();
  $.ajax({
    type:"POST",
    cache:false,
    data:{profile_name:profile_name},
    url:"<?php echo base_url() ?>index.php/tif_a/tt_profile_ajax/get_profile_name",
    success:function(e){
      if(e == 1){
        $('#profile_name').next('span').remove();
        $('<span style="color:#ff3737">Already Inserted</span>').insertAfter('#profile_name');
        $('#insert_profile').css('display','none');
      }else{
        $('#profile_name').next('span').remove();
        $('#insert_profile').css('display','');
      }
    }  
  });
});



//============================= CALCULATED PARTIMER CALCULATION ==================================//
//===============================================================================================//


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




</script>


</body>
</html>