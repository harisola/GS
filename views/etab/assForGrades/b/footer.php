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



<div id="myModal3" class="modal fade" data-easein="fadeInUp" data-easeout="fadeOutUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title">WEIGHTAGE ERROR </h4>
</div>
<div class="modal-body">
<p>Please Adjust Weightage.</p>
</div>
<div class="modal-footer">
<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
</div>
</div>
</div>


<div id="myModal4" class="modal fade" data-easein="fadeInUp" data-easeout="fadeOutUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title"> Assessment created for this programme </h4>
</div>
<div class="modal-body">
<p>Assessment already created for this programme. </p>
</div>
<div class="modal-footer">
<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
</div>
</div>
</div>



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
<!--script type="text/javascript" src="<?php //echo base_url()?>components/orb/js/scripts.js"></script -->

<!--Main App--> 
<script type="text/javascript">
//ORB JavaScript
// DOM Preload
(function ($) {



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
                sortable: false,
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
            <?php if($this->data['can_user_view'] == 1 && $this->data['can_user_delete'] == 0 && ($this->uri->uri_string() == 'etab/assessment_category' || $this->uri->uri_string() == 'etab/assessment_category_type' || $this->uri->uri_string() == 'etab/assessment_category_grade' ) ) {?>
            if ($('#diplayCategory').length) {
                var oTable = $('#diplayCategory').dataTable({
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

	$(document).on("change","#academicSession", function(){
		var acedmicID = $(this).val();
		var res = acedmicID.split("_"); 
		var acedmicID = parseInt(res[0]);
		var branchID = parseInt(res[1]) ;
		
		
		
		$("#academicSessionTerm").val($("#academicSessionTerm option:first").val());
		$("#gradeName").val($("#gradeName option:first").val());
		$("#gradeSubject").val($("#gradeSubject option:first").val());
		
		
	var _thisText = $(this).find('option:selected').text();
	if(_thisText == ' North Campus'){
		
		
		$("#southCampusGrades").hide();
		$("#northCampusGrades").show();
		
	}else{
		$("#northCampusGrades").hide();
		$("#southCampusGrades").show();
		
	}
	
	$("#academicSessionTerm").prop("disabled", false);
	
	if( acedmicID != '' ){
		$.ajax({
		type:"POST",
		url : "<?=base_url(); ?>index.php/etab/ajax/getTerms",
		data:{ acedmicID:acedmicID},
		dataType: "html",
		success: function( response ){
			$("#academicSessionTerm").empty();
			$("#academicSessionTerm").append(response);
		}


	});
	}

	});
	

		
$(document).on("click",".link_edit",function(){
//$(".link_edit").click(function(){
	var linkID = $(this).attr('id');
	//alert(linkID);
	var grade_id = $("#grade_"+linkID ).val();
	var sub_ID = $("#sub_"+linkID).val();
	var sessionID = $("#session_"+linkID).val();
	var termID = $("#term_"+linkID).val();
	$.ajax({
		type:"POST",
		url : "<?=base_url(); ?>index.php/automcomplete/assGrade/edit2/"+linkID,
		data:{ categoryID:linkID, grade_id:grade_id, sub_ID:sub_ID, sessionID:sessionID, termID:termID },
		dataType: "html",
		success: function( response ){
			//alert( response );
			$('#assessmentGrade').html( response );
				var totalCount;
				totalCount = 0;
				$(".weighateges").each(function(){
					var eachValue = $(this).val();
					totalCount = parseFloat(totalCount)+parseFloat(eachValue);
				});
				if( totalCount == 100 ){
					$("#btnCW").prop("disabled", false);
				}else{
					$("#btnCW").prop("disabled", true);
				}
				
				
		},
		complete:function(){
		}

	});

});
$(document).on("click",".link_remove",function(){
	var linkID = $(this).attr('id');
	//alert(linkID);
	var agree = confirm("Are you sure you want to delete this file?");
	/*if (agree){
		  $.ajax({
			url : "<?=base_url(); ?>index.php/automcomplete/assGrade/removeCat/"+linkID,
			dataType: "html",
			success: function(data){
			  $.ajax({
				type: "POST",
				url : "<?=base_url(); ?>index.php/automcomplete/assGrade/getCreatedCategories",
				dataType: "html",
				success: function(data){
					$('#createdCategories2').html(data);
				},
				complete: function(){
					$("#updateCategory").find("input[type=text] , textarea , select ").each(function(){ $(this).val('');   });	  
				}

			 });
			}//
		});
	}else{
			return false;
		} 
	*/

	
  }); 
  
  
  
		// ==== take grade id and get section ====
			$(document).on("change","#gradeName",function(){
				$("#btnCW").prop("disabled",true);
				//$("#gradeSubject").prop("disabled",true);
				
				$("#mainCategory").val('');
				var gradeID = $(this).val();
				var academicSession = $("#academicSession").val();
				
				if(gradeID > 0 ){
				
				$.ajax({
					type:"POST",
					//url:"<?php echo base_url(); ?>index.php/automcomplete/sg_ajax/section",
					url:"<?php echo base_url(); ?>index.php/etab/ajax/grdSubjects2",
					cache:false,
					data:{grade_id:gradeID,session:academicSession},
					dataType:'JSON',
					//dataType:'HTML',
					success:function( res ){
						//$('#gradeSections').html( res );
						$('#gradeSections').html( res.HTML2 );
					}
				});
				
				
				$.ajax({
					type:"POST",
					//url:"<?php echo base_url(); ?>index.php/automcomplete/sg_ajax/section",
					url:"<?php echo base_url(); ?>index.php/etab/ajax/gradeCategory",
					cache:false,
					data:{grade_id:gradeID},
					dataType:'JSON',
					//dataType:'HTML',
					success:function( res ){
						//$("#gradeSubject").prop("disabled",false);
						$('#mainCategory2').html( res.HTML2 );
					}
				});
				}// if greater than zero
				
			});
			
			
			
			
			$(document).on("change","#academicSessionTerm",function(){
				$("#mainCategory").val('');
				$("#btnCW").prop("disabled",true);
				$("#gradeName").prop("disabled",false);
				
				//$("#mainCategory").val('');
			});
			
			
			$(document).on("change","#academicSession",function(){
				  //$("#academicSessionTerm").prop("disabled", false);
				   $("#mainCategory").val('');
				//  $("#btnCW").prop("disabled",true);
				//  $("#mainCategory").val('');
			});
			
				
			//$(document).on("change","#academicSessionTerm",function(){$("#gradeName").prop("disabled", false);});
			
			$(document).on("change","#gradeName",function(){
				  $("#gradeSections").prop("disabled", false);
				 // $("#btnCW").prop("disabled",true);
				  //$("#mainCategory").val('');
			});
			
			
			$(document).on("change","#gradeSubject",function(){
			  $("#mainCategory").val('');
			  $(".panel-default").html('');
			  $('#subCat').html('');	
			 // $("#btnCW").prop("disabled",true);
			});
			
			// on change main category like formative, summative,ASP and get their sub categories.
			$(document).on("change","#mainCategory",function(){
				
				$("#btnCW").prop("disabled", true);
				var mCatID = $(this).val();
				//alert(mCatID);
				$("#availableSpace").val(100);
				 if( mCatID == '' ){
					$("#weightage").val('');
					$("#weightage").prop("disabled", true);
				 }
				 
				var gradeID = $("#gradeName").val();
				var programID = $("#gradeSubject").val();
				var sessionID = $("#academicSession").val();
				var termsID = $("#academicSessionTerm").val();
					
			$(".panel-default").html('');
					
				$.ajax({
					type:"POST",
					url : "<?=base_url(); ?>index.php/ajaxbasemanupulations/categorytype/getSubCat/"+mCatID,
					cache:false,
					data:{gradeID:gradeID,programID:programID,sessionID:sessionID,termsID:termsID},
					dataType:'JSON',
					//dataType:'HTML',
					success:function( response ){
						//console.log( response );
						if( response.exits == 1){
							
							$('#myModal4').modal({
								"backdrop"  : "static",
								"keyboard"  : true,
								"show"      : true
							});
							
						
						}else{
						
						}
						
						$('#subCat').html(response.typeHTML);	
						
						$.ajax({
								type: "POST",
								url : "<?=base_url();?>index.php/automcomplete/assGrade/getAssessment",
								data:{as:sessionID,ast:termsID,grdn:gradeID,grdSub:programID,mcat:mCatID},
								dataType: "html",
								success: function( responseGtAss ){
									//alert(responseGtAss);
									$('#createdCategories2').html( responseGtAss );
								}
							}); 
					
						
						
						
					}
				});
				
				
			});
			
			$(document).on("change","#subCategory",function(){
				$("#academicSession").val('');
				if( $(this).val() != '' ){
					$("#academicSession").prop("disabled", false);	
				}else{
					$("#academicSession").prop("disabled", true);
				}
			}); 
			
			$(document).on("change",".weighateges",function(){
				var cvalue = parseFloat( $(this).val() );
				
				var $row = $(this).closest(".subCatRow");
				var ignore = $row.find(".checkBoxIngore");
				var igV = ignore.val();
				
				if( cvalue == 0 ){
					ignore.prop("checked", true);	
				}else{
					ignore.prop("checked", false);
				}
				
				
				var avialableS = parseFloat( $("#availableSpace").val() );
				var tmpTotal,totalCount;
				totalCount = 0;
				$(".weighateges").each(function(){
					var eachValue = $(this).val();
					totalCount = parseFloat(totalCount)+parseFloat(eachValue);
				});
				//alert(totalCount);
				if( totalCount >=0 && totalCount <= 100 ){
					tmpTotal = ( 100 - totalCount);
					$("#availableSpace").val( tmpTotal.toFixed(2) );
				}else{
					var curq = $('.weighateges').index( $(this) );
					var asdf = $('.catWeighateHide').eq(curq).val();
					$('.weighateges').eq(curq).val(asdf);
					$('#myModal3').modal({
						"backdrop"  : "static",
						"keyboard"  : true,
						"show"      : true
					});
				}
				var cur = $('.weighateges').index($(this));
				$('.catWeighateHide').eq(cur).val( $(this).val() );
				var tmpTotalF = parseFloat( $("#availableSpace").val() );
				if( tmpTotalF == 0 ){
					$("#btnCW").prop("disabled", false);	
				}else{
					$("#btnCW").prop("disabled", true);	
				}
				
			});
			
		//======================= end take grade id and get section ==============
		//========================================================================
        //	Forms Validition
        //========================================================================
	    //Order Form Validation
	   $(document).on("click", ".createAssessmentBtn", function(){
		 
		 if ($('#createAssForm').length) {
		   $("#createAssForm").validate({
                // Rules for form validation
				ignore: [],
                rules: {
                academicSession : { required: true },
                academicSessionTerm: { required: true },
                gradeName: { required: true },
                gradeSubject: { required: true },
				mainCategory: { required: true },
				programSetupID:{required:true}
				//subCategory: { required: true },
				//'weightageType[]': { required: true }
					
                },

                // Messages for form validation
                messages: {
					academicSession: { required: 'Please enter category name title' },
					academicSessionTerm: { required: 'Please enter category display name' },
					gradeName: { required: 'Please enter category short name' },
					gradeSubject: { required: 'Please enter category short name' },
					mainCategory: { required: 'Please enter category short name' },
					programSetupID: { required: 'Please enter category short name' },
					
					//'subCategory[]': { required: 'Please enter category short name' },
					//'weightageType[]': { required: 'Please enter category short name' }
                },

                // Ajax form submition
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
						type: "POST",
						url : "<?=base_url();?>index.php/automcomplete/assGrade/createAssessment",
						cache: false,               
						data: $('#createAssForm').serialize(),
						dataType: "TEXT",
						beforeSend: function () {
                            $('#createAssForm button[type="submit"]').addClass('button-uploading').attr('disabled', true);
                        },
                        uploadProgress: function (event, position, total, percentComplete) {
                            $("#createAssForm .progress").text(percentComplete + '%');
                        },
                        success: function ( reponseCrAs ) {
							var acSession2 = $("#academicSession").val();
							var acSeTerm2 = $("#academicSessionTerm").val();
							var grdName2 = $("#gradeName").val();
							var grdSubject2 = $("#gradeSubject").val();
							var mCat2 = $("#mainCategory").val();
							
							
							$.ajax({
								type: "POST",
								url : "<?=base_url();?>index.php/automcomplete/assGrade/getAssessment",
								data:{as:acSession2,ast:acSeTerm2,grdn:grdName2,grdSub:grdSubject2,mcat:mCat2},
								dataType: "html",
								success: function( responseGtAss ){
									//alert(responseGtAss);
									$('#createdCategories2').html( responseGtAss );
								}
							}); 
							
							
							$("#availableSpace").val(100);
							$("#mainCategory").val('');
							$('.weighateges').each(function(){
								var asdfdsfa = $(this);
								asdfdsfa.val('');
							}); 
							$("#createAssForm").addClass('submited');
							$('#createAssForm button[type="submit"]').removeClass('button-uploading').attr('disabled', false);
							
						},
						complete:function(){
							$( '#createAssForm' ).each(function(){
								//this.reset();
							});
							
							
				
							
							
							$('#successMsg').show();
							//setTimeout(function(){$('#successMsg').hide();}, 5000);
							$('#successMsg	').fadeOut(5000);
							//$("#order-form .progress").hide();
							//$("#successMsg").removeAttr('display');
							$("#createAssForm").removeClass('submited');
							$("#createAssForm").addClass('.orb-form');
							$('#createAssForm button[type="submit"]').removeClass('button-uploading').attr('disabled', true);
						}
                    });
                },

                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }
		
		
	   } );
	

		
		 
		
		
		


        



        // ========================================================================
        //  Inbox
        // ========================================================================




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

$(".goaway").click(function (e) {
    e.preventDefault();
    $('#signout').modal();
    $('#yesigo').click(function () {
        window.open('<?php echo site_url('logout');?>', '_self');
        $('#signout').modal('hide');
    });

});
</script>

</body>
</html>