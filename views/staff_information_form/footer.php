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
<!-- <script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/x-editable/select2-bootstrap.css"></script> -->
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
<?php if($this->data['can_user_view'] == 1 && $this->data['can_user_delete'] == 0 && ( $this->uri->uri_string() == 'staff_information_form_basic/tipb_controller' ) ) { ?>
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


       //	=========================================================================
       //	Forms Validition
       //	=========================================================================
	  
        
					
					
		 //Datepicker

			// Regular datepicker
			if ($('#dtOfBith').length) {
				$('#dtOfBith').datepicker({
					dateFormat: 'dd-mm-yy',	
					prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>'
				});
			}

        
		// Regular datepicker
			/*if ( $('#schoolYear_0').length) {
				$('#schoolYear_0').datepicker({
					dateFormat: 'yy',	
					prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>',
					constrainInput: true
				});
			} */
			///http://jsfiddle.net/9g6hq5cq/4/
			//var length = $(".testing").length;
			if ( $('input[name^="schoolYear[]"').length) {
				$('input[name^="schoolYear[]"').each(function(i){
					var newID = 'schoolYear_'+i;
					var newID = 'schoolYear_'+i;
					$(this).attr( 'id',newID );
					//$(this).attr( 'class',newID );
					$( "#" + newID + "" ).datepicker();
					//$('#schoolYear_0').datepicker(); 
				}); 
				$(document).on("change", '.txt_schName', function(){
					var cur = $('.txt_schName').index($(this));
					//$('.schoolName_0').eq(cur).val( $(this).val() );
					var second = $('.schoolName_0').eq(cur);
					var valueess = $(this).val();
					if ( valueess == "Other") {
						$(this).attr("name","schoolNameKashif[]");
						second.attr("name","schoolName[]");
						second.val('');
						$(this).parents(".testing").find(".sn").hide();
						//$(this).parents(".testing").find(".schoolName_0").val('');
						$(this).parents(".testing").find(".input_input").show();
					}else{
						$(this).attr("name","schoolName[]");
						$(this).parents(".testing").find(".sn").show();
						second.attr("name","schoolNames[]");
						second.val('');
						//$('.schoolName_0').eq(cur).val($(this).val())
						$(this).parents(".testing").find(".input_input").hide();
						//$(this).parents(".testing").find(".schoolName_0").prop('disabled', true);
					}
				});
				$(document).on("click", '.btn_less1', function(){
					var len = $('.testing').length;
					if(len > 0 ){
						//var cur = $('.txt_schName').index($(this));
						//$(this).closest(".testing").remove();
						var cur2 = $('.btn_less1').index($(this));
						var sd =  $('.txt_schName').eq(cur2);
						sd.val('');
						sd.attr("name","schoolName[]");
						var sdd =  $('.schoolName_0').eq(cur2);
						sdd.val('');
						sdd.attr("name","schoolNames[]");
						$(this).parents(".testing").find(".input_input").hide();
						$(this).parents(".testing").find(".sn").show();
					}
				});
				
				//School Qualification 
				$(document).on("change", '.schoolQ', function(){
					var cur = $('.schoolQ').index($(this));
					//$('.schoolName_1').eq(cur).val($(this).val());
					var second = $('.schoolName_1').eq(cur);
					var valueess = $(this).val();
					if ( valueess == "Other") {
						$(this).attr("name","schoolNameKashif1[]");
						second.attr("name","schoolQualification[]");
						second.val('');
						$(this).parents(".testing").find(".schoolQQ").hide();
						//$(this).parents(".testing").find(".schoolName_1").val('');
						$(this).parents(".testing").find(".inputinput").show();
						
					 }else{
						$(this).attr("name","schoolQualification[]");
						second.attr("name","schoolNameKashif1[]");
						second.val('');
						$(this).parents(".testing").find(".schoolQQ").show();
						//$('.schoolName_1').eq(cur).val($(this).val())
						$(this).parents(".testing").find(".inputinput").hide();
					}
				});
				$(document).on("click", '.btn_less2', function(){	
					var len = $('.testing').length;
					if(len > 0 ){
						//var cur = $('.schoolQ').index($(this));
						var cur2 = $('.btn_less2').index($(this));
						var sd =  $('.schoolQ').eq(cur2);
						sd.val('');
						sd.attr("name","schoolQualification[]");
						var sdd =  $('.schoolName_1').eq(cur2);
						sdd.val('');
						sdd.attr("name","schoolNameKashif1[]");
						$(this).parents(".testing").find(".inputinput").hide();
						$(this).parents(".testing").find(".schoolQQ").show();
					}
				});	// end School Qualification
				
				
				
				//School Subject  schoolSubject
				$(document).on("change", '.schoolSubjct', function(){
					var cur = $('.schoolSubjct').index($(this));
					var second = $('.schoolName_2').eq( cur );
					//$('.schoolName_2').eq(cur).val($(this).val())
					var valueess = $(this).val();
					if ( valueess == "Other") {
						$(this).attr("name","schoolSubjctKashif[]");
						second.attr("name","schoolSubject[]");
						second.val('');
						$(this).parents(".testing").find(".schoolSub").hide();
						//$(this).parents(".testing").find(".schoolName_2").val('');
						$(this).parents(".testing").find(".inputssub").show();
					}else{
						$(this).attr("name","schoolSubject[]");
						second.attr("name","schoolSubjectKashif[]");
						second.val('');
						$(this).parents(".testing").find(".schoolSub").show();
						//$('.schoolName_2').eq(cur).val($(this).val())
						$(this).parents(".testing").find(".inputssub").hide();
					} 
				});
				
				$(document).on("click", '.btn_less3', function(){	
					var len = $('.testing').length;
					if( len > 0 ){
						//var cur = $('.schoolSubjct').index($(this));
						var cur2 = $('.btn_less3').index($(this));
						var sd =  $('.schoolSubjct').eq(cur2);
						sd.val('');
						sd.attr("name","schoolSubject[]");
						var sdd =  $('.schoolName_2').eq(cur2);
						sdd.val('');
						sdd.attr("name","schoolSubjectKashif[]");
						$(this).parents(".testing").find(".inputssub").hide();
						$(this).parents(".testing").find(".schoolSub").show();
					}
				});	
				// end School Subject
				
				
				
				
			} // end School
			
			if ( $('input[name^="collegeYear[]"').length) { 
				$('input[name^="collegeYear[]"').each(function(i){
					var newID = 'collegeYear_'+i;
					$(this).attr( 'id',newID );
					$( "#" + newID + "" ).datepicker();
					//$('#schoolYear_0').datepicker(); 
				}); 
				
				$(document).on("change", '.college_name', function(){
					
				  var cur = $('.college_name').index($(this));
				  //$('.cn_0').eq(cur).val($(this).val())
				  var second = $('.cn_0').eq(cur);
				  var valueess = $(this).val();
				  
				   if ( valueess == "Other") {
					   
					$(this).attr("name","collegeNameKashif[]");
					second.attr("name","collegeName[]");
						second.val('');
					$(this).parents(".tr_clone").find(".college_name2").hide();
					//$(this).parents(".tr_clone").find(".cn_0").val('');
					$(this).parents(".tr_clone").find(".input_college").show();
					
				   }else{
					   $(this).attr("name","collegeName[]");
						second.attr("name","collegeNameKashif[]");
						second.val('');
					$(this).parents(".tr_clone").find(".college_name2").show();
					//$('.cn_0').eq(cur).val($(this).val())
					$(this).parents(".tr_clone").find(".input_college").hide();
					
					}
				});
				$(document).on("click", '.btn_cn', function(){
				var len = $('.tr_clone').length;
				  if( len > 0 ){
						var cur2 = $('.btn_cn').index($(this));
						var sd =  $('.college_name').eq(cur2);
						sd.val('');
						sd.attr("name","collegeName[]");
						var sdd =  $('.cn_0').eq(cur2);
						sdd.val('');
						sdd.attr("name","collegeNameKashif[]");
						$(this).parents(".tr_clone").find(".input_college").hide();
						$(this).parents(".tr_clone").find(".college_name2").show();
					}
				});// End College Name
				
				
				
				// College Qualification
				
				$(document).on("change", '.collegeQ', function(){
					
				  var cur = $('.collegeQ').index($(this));
				   //$('.cq_1').eq(cur).val($(this).val())
				   var second = $('.cq_1').eq(cur);
					 
				   var valueess = $(this).val();
				   
				   if ( valueess == "Other") {
					   
					$(this).attr("name","collegeQKashif[]");
					second.attr("name","collegeQualification[]");
					second.val('');
					$(this).parents(".tr_clone").find(".collegeQQ").hide();
					//$(this).parents(".tr_clone").find(".cq_1").val('');
					$(this).parents(".tr_clone").find(".inputCQ").show();
					
					
				   }else{
					   $(this).attr("name","collegeQualification[]");
						second.attr("name","collegeQKashif[]");
					second.val('');
						$(this).parents(".tr_clone").find(".collegeQQ").show();
						//$('.cq_1').eq(cur).val($(this).val())
						$(this).parents(".tr_clone").find(".inputCQ").hide();
					}
					
				});
				
				$(document).on("click", '.btn_cq', function(){
					var len = $('.tr_clone').length;
					if( len > 0 ){
						//var cur = $('.btn_cq').index($(this));
						
						var cur2 = $('.btn_cq').index($(this));
						var sd =  $('.collegeQ').eq(cur2);
						sd.val('');
						sd.attr("name","collegeQualification[]");
						var sdd =  $('.cq_1').eq(cur2);
						sdd.val('');
						sdd.attr("name","collegeQKashif[]");
						
						$(this).parents(".tr_clone").find(".inputCQ").hide();
						$(this).parents(".tr_clone").find(".collegeQQ").show();
					}
				});// College Qualification
				
				
				// College Subject
				
				$(document).on("change", '.slct_clgSub', function(){
					var cur = $('.slct_clgSub').index($(this));
					var second = $('.txt_coSub').eq(cur);
					// $('.coSub3').eq(cur).val($(this).val())
					var valueess = $(this).val();
					//alert(valueess)
					
				  if ( valueess == "Other") {
						$(this).attr("name","collegeSubjectKashif[]");
						second.attr("name","collegeSubject[]");
						second.val('');
						$(this).parents(".tr_clone").find(".coSub1").hide();
						//$(this).parents(".tr_clone").find(".coSub3").val('');
						$(this).parents(".tr_clone").find(".coSub2").show();
					}else{
						$(this).attr("name","collegeSubject[]");
						second.attr("name","collegeSubjectKashif[]");
						second.val('');
						$(this).parents(".tr_clone").find(".coSub1").show();
						//$('.coSub3').eq(cur).val($(this).val())
						$(this).parents(".tr_clone").find(".coSub2").hide();
					}
				});
				
				$(document).on("click", '.coSub4', function(){
					
					var len = $('.tr_clone').length;
					if( len > 0 ){
						//var cur = $('.coSub4').index($(this));
						
						var cur2 = $('.coSub4').index($(this));
						var sd =  $('.slct_clgSub').eq(cur2);
						sd.val('');
						sd.attr("name","collegeSubject[]");
						var sdd =  $('.txt_coSub').eq(cur2);
						sdd.val('');
						sdd.attr("name","collegeSubjectKashif[]");
						
						$(this).parents(".tr_clone").find(".coSub2").hide();
						$(this).parents(".tr_clone").find(".coSub1").show();
					}
				});// College Subject
				
				
				
				
				
			} // college section jQuery
			
			if ( $('input[name^="universityYear[]"').length) { 
				$('input[name^="universityYear[]"').each(function(i){
					var newID = 'universityYear_'+i;
					$(this).attr( 'id',newID );
					$( "#" + newID + "" ).datepicker();
					//$('#schoolYear_0').datepicker(); 
				}); 
				
				
				
				// Unniversity Name 				
				$(document).on("change", '.slct_uniname', function(){
					var cur = $('.slct_uniname').index($(this));
					var second = $('.txt_uniname').eq(cur);
					// $('.coSub3').eq(cur).val($(this).val())
					var valueess = $(this).val();
					//alert(valueess)
					
				  if ( valueess == "Other") {
						$(this).attr("name","universityNames[]");
						second.attr("name","universityName[]");
						second.val('');
						$(this).parents(".uniRowClone").find(".uniContainer1").hide();
						
						$(this).parents(".uniRowClone").find(".uniContainer2").show();
					}else{
						$(this).attr("name","universityName[]");
						second.attr("name","universityNames[]");
						second.val('');
						$(this).parents(".uniRowClone").find(".uniContainer1").show();
						//$('.coSub3').eq(cur).val($(this).val())
						$(this).parents(".uniRowClone").find(".uniContainer2").hide();
					}
				});
				
				$(document).on("click", '.btn_un', function(){
					
					var len = $('.uniRowClone').length;
					if( len > 0 ){
						
						
						var cur2 = $('.btn_un').index($(this));
						var sd =  $('.slct_uniname').eq(cur2);
						sd.val('');
						sd.attr("name","universityName[]");
						var sdd =  $('.txt_uniname').eq(cur2);
						sdd.val('');
						sdd.attr("name","universityNames[]");
						
						$(this).parents(".uniRowClone").find(".uniContainer2").hide();
						$(this).parents(".uniRowClone").find(".uniContainer1").show();
					}
				});// Unniversity Name 
				
				
				// Unniversity Qualification 				
				$(document).on("change", '.slct_uniqual', function(){
					var cur = $('.slct_uniqual').index($(this));
					var second = $('.txt_uniqual').eq(cur);
					// $('.coSub3').eq(cur).val($(this).val())
					var valueess = $(this).val();
					//alert(valueess)
					
				  if ( valueess == "Other") {
						$(this).attr("name","universityQualifications[]");
						second.attr("name","universityQualification[]");
						second.val('');
						$(this).parents(".uniRowClone").find(".qtContainer1").hide();
						$(this).parents(".uniRowClone").find(".qtContainer2").show();
					}else{
						$(this).attr("name","universityQualification[]");
						second.attr("name","universityQualificatios[]");
						second.val('');
						$(this).parents(".uniRowClone").find(".qtContainer1").show();
						$(this).parents(".uniRowClone").find(".qtContainer2").hide();
					}
				});
				
				$(document).on("click", '.btn_uq', function(){
					
					var len = $('.uniRowClone').length;
					if( len > 0 ){
						var cur2 = $('.btn_uq').index($(this));
						var sd =  $('.slct_uniqual').eq(cur2);
						sd.val('');
						sd.attr("name","universityQualification[]");
						var sdd =  $('.txt_uniqual').eq(cur2);
						sdd.val('');
						sdd.attr("name","universityQualificatios[]");
						$(this).parents(".uniRowClone").find(".qtContainer2").hide();
						$(this).parents(".uniRowClone").find(".qtContainer1").show();
					}
				});// Unniversity Qualification 
				
				
				
				// Unniversity Qualification 				
				$(document).on("change", '.slct_unisubjct', function(){
					var cur = $('.slct_unisubjct').index($(this));
					var second = $('.txt_unisubjct').eq(cur);
					// $('.coSub3').eq(cur).val($(this).val())
					var valueess = $(this).val();
					//alert(valueess)
					
				  if ( valueess == "Other") {
						$(this).attr("name","universitySubjects[]");
						second.attr("name","universitySubject[]");
						second.val('');
						$(this).parents(".uniRowClone").find(".unisubContainer1").hide();
						$(this).parents(".uniRowClone").find(".unisubContainer2").show();
					}else{
						$(this).attr("name","universitySubject[]");
						second.attr("name","universitySubjects[]");
						second.val('');
						$(this).parents(".uniRowClone").find(".unisubContainer1").show();
						$(this).parents(".uniRowClone").find(".unisubContainer2").hide();
					}
				});
				
				$(document).on("click", '.btn_usb', function(){
					
					var len = $('.uniRowClone').length;
					if( len > 0 ){
						var cur2 = $('.btn_usb').index($(this));
						var sd =  $('.slct_unisubjct').eq(cur2);
						sd.val('');
						sd.attr("name","universitySubject[]");
						var sdd =  $('.txt_unisubjct').eq(cur2);
						sdd.val('');
						sdd.attr("name","universitySubjects[]");
						$(this).parents(".uniRowClone").find(".unisubContainer2").hide();
						$(this).parents(".uniRowClone").find(".unisubContainer1").show();
					}
				});// Unniversity Qualification 
				
				
				
				
				
				
				
				
			}
			
			if ( $('input[name^="professionalYear[]"').length) { 
				$('input[name^="professionalYear[]"').each(function(i){
					var newID = 'proYear_'+i;
					$(this).attr( 'id',newID );
					$( "#" + newID + "" ).datepicker();
					//$('#schoolYear_0').datepicker(); 
				}); 
			}
			
			if ( $('input[name^="othersYear[]"').length) { 
				$('input[name^="othersYear[]"').each(function(i){
					var newID = 'othrYear_'+i;
					$(this).attr( 'id',newID );
					$( "#" + newID + "" ).datepicker();
					//$('#schoolYear_0').datepicker(); 
				}); 
			}
			
			//if ( $('#collegeYear_0').length) { $('#collegeYear_0').datepicker(); } 
			//if ( $('#universityYear_0').length) { $('#universityYear_0').datepicker(); } 
			//if ( $('#proYear_0').length) { $('#proYear_0').datepicker(); } 
			//if ( $('#othrYear_0').length) { $('#othrYear_0').datepicker(); } 
			
			
			
			/*$('input[name^="institutionFrom[]"').each(function(i){
				var newID = 'efYear_0'+i;
				$(this).attr( 'id',newID );
				$( "#" + newID + "" ).datepicker();
			}); */
				
				
			if ( $('input[name^="institutionFrom[]"').length) { 
				
				$('input[name^="institutionFrom[]"').each(function(i){
				var newID = 'efYear_'+i;
				$(this).attr( 'id',newID );
				$( "#" + newID + "" ).datepicker();
				});
			
			}
			
			if ( $('input[name^="institutionFrom[]"').length) { 
				
				$('input[name^="institutionFrom[]"').each(function(i){
				var newID = 'efYear_'+i;
				$(this).attr( 'id',newID );
				$( "#" + newID + "" ).datepicker();
				});
				
				
				//$('.experienceToYear').datepicker('destroy');
				if ( $('input[name^="institutionTo[]"').length) {
					
					$('input[name^="institutionTo[]"').each(function(i){
						var newID = 'etYear_'+i;
						
						$(this).attr( 'id',newID );
						$( "#" + newID + "" ).datepicker();
						
						
					 
					});
					
				
				 
				 
				}

			
			}
			$(document).on("click",".presentCheckBox", function(){
				
				var presentSection = $(".presentSection");
				
				$(".presentSection").each(function(i){
					var newID = 'toDateH_'+i;
					$(this).attr( 'id',newID );
					
				});

		
					
				var checkedValue = $(this).is(':checked');
				//var sectionID = $(".presentSection").attr("id");
				//alert(checkedValue);
				var cur2 = $(".presentCheckBox").index( $(this) );
				var sd =  $('.presentSection').eq(cur2);
				var txt_yearTo =  $('.experienceToYear').eq(cur2);
				
				var sectionID = sd.attr("id");
				if( checkedValue ){
					txt_yearTo.val('');
					$( "#" + sectionID + "" ).hide();	 
				 }else{
					$( "#" + sectionID + "" ).show(); 
				 }
				
				 

				 
			});
			
			$(document).on("click",".remHistory",function(){
				
				$("#empHistory").on('click','.remHistory',function(){   
	var rowCount = $('#empHistory tr').length;
//	alert(rowCount);
	if( rowCount > 1 ){ $(this).parent().parent().remove();	 }else{ $(".remHistory").hide(); }
});
				
			} );
		
			
//$('input[name^="start_date"],input[name^="end_date"]').datepicker();
        
		
		$(".orb-form").bind("keypress", function (e) {
			if (e.keyCode == 13) {
			return false;
			}
		});
		
		//TIF-B Search Form
		
		if ($('#searchGtIDFitB').length) {
			$("#searchGtIDFitB").mask('99-999', {
				placeholder: 'X'
			});
        }
		
		if ($('#ntnNumber').length) {
			$("#ntnNumber").mask('9999999-9', {
				placeholder: 'X'
			});
        }
		
		if ($('#spouseFatherCNIC').length) {
			$("#spouseFatherCNIC").mask('99999-9999999-9', {
				placeholder: 'X'
			});
        }
		
		if ($('#spouseCNIC').length) {
			$("#spouseCNIC").mask('99999-9999999-9', {
				placeholder: 'X'
			});
        }
		
		if ($('#spouseFatherMobile').length) {
			$("#spouseFatherMobile").mask('9999-9999999', {
				placeholder: 'X'
			});
        }
		if ($('#spouseMobile').length) {
			$("#spouseMobile").mask('9999-9999999', {
				placeholder: 'X'
			});
        }
		
		if ($('#mobileNumber').length) {
			$("#mobileNumber").mask('9999-9999999', {
				placeholder: 'X'
			});
        }
		
		if ($('#landLineNumber').length) {
			$("#landLineNumber").mask('9999-9999999', {
				placeholder: 'X'
			});
        }
		// if ($('#eobiNumber').length) {
		// 	$("#eobiNumber").mask('9999X999999', {
		// 		placeholder: 'X'
		// 	});
  //       }

        if ($('#eobiNumber').length) {
            $.mask.definitions['X']='[A-Za-z]';
            $("#eobiNumber").mask('9999X999999', {
                 placeholder: 'X',
            });
        }
		
		if ($('#certificateNumber').length) {
			$("#certificateNumber").mask('00387875B-999', {
				placeholder: 'X'
			});
        }
		
		if ($('#sessiNumber').length) {
			$("#sessiNumber").mask('SWD-999999', {
				placeholder: 'X'
			});
        }
		
		if ($('#kinPhone').length) {
			$("#kinPhone").mask('9999-9999999', {
				placeholder: 'X'
			});
        }
		if ($('#emergencyContactPhone').length) {
			$("#emergencyContactPhone").mask('9999-9999999', {
				placeholder: 'X'
			});
        }
		
		
		
		
		$("#empSchool").on('click','.remCF',function(){   $(this).parent().parent().remove();  });
		
		
	
	
		// --------------------------------------------------------------------
        //   Basic Form Information.Available Validations tab-pane
	    // --------------------------------------------------------------------
       if ($('#staffInformationForm').length) {
		   
		   $("#staffInformationForm").validate({
            //Rules for form validation
			ignore: [],
            rules: {
				required: {
                    required: true
                },
					
				email: {required: true,email: true},
				
				dateOfBith: {
                    required: true,
                   // dtOfBith: true
                },
                   
               
				guID: {
                   required: true
                },
				
				
                  
                },

                // Messages for form validation
                messages: {
                    required: {
                        required: 'Please enter something'
                    },
                    email: {
                        required: 'Please enter your email address'
                    },
					
					fullName: {
                        required: 'Please enter Full Name'
                    },
					
					
					nameCode: {
                        required: 'Please enter Name Code'
                    },
					
					cnic: {
                        required: 'Please enter National Identity Card Number'
                    },
					
                   
                },
				
				 // Ajax form submition					
                submitHandler: function (form) {
					
						
					
                    $(form).ajaxSubmit({
						type:"POST",
						url: "<?php echo base_url();?>index.php/automcomplete/staff/staffbasicInfo", 
						beforeSend: function () {
                            $('#staffInformationForm button[type="submit"]').attr('disabled', true);
						},
                        success: function (response) {
                            //$("#staffInformationForm").addClass('submited');
							$("#basicInfoSucess").show();
							 $("#basicInfoSucess").fadeOut(9000);
							// $('#delete-widget').modal('show');
							 $('#personalinfo').removeClass('active');
							 $('a[href="#educationalRecord"]').tab('show');
							 $('#educationalRecord').addClass('active');
							 
							
                        }
                    });
                },

				// Do not change code below
				errorPlacement: function (error, element) {
					error.insertAfter( element.parent() );
				}
				
            });
			
        }
		// http://formvalidation.io/examples/bootstrap-tab/
		// https://www.google.com/search?q=tabs+form+validation+not+working&ie=utf-8&oe=utf-8
	
		// ------------------------------------------------------------
		// Form for Education Record available Validations tab-pane
		// ------------------------------------------------------------
       if ($('#staffEducationalRecord').length) {
		   
		   $("#staffEducationalRecord").validate({
            //Rules for form validation
			ignore: [],
            rules: {
			required: { required: true },
			//'schoolName[]': { required: true,},
			//'collegeName[]': {required: true,},
			},
			// Messages for form validation
            messages: {
                required: {
                    required: 'Please enter something'
                },
				//'schoolName[]': { required: 'Please enter School Name' },
				//'collegeName[]': { required: 'Please enter College Name' },
				
            },
			submitHandler: function (form) {
				$(form).ajaxSubmit({
						type:"POST",
						url: "<?php echo base_url();?>index.php/automcomplete/staff/updateEducationRecord",
						beforeSend: function () {
                            $('#staffEducationalRecord button[type="submit"]').attr('disabled', true);
						},
                        success: function (response) {
							//alert(response);
                            //$("#staffInformationForm").addClass('submited');
							$("#eduRecordSucess").show();
							 $("#eduRecordSucess").fadeOut(9000);
							 
							// not open $('#modalEdcRecord').modal('show');
							 // not open $('a[href="#educationalRecord"]').tab('show');
							 // not open $('a[href="#educationalRecord"]').addClass('active');
							 
							$('#educationalRecord').removeClass('active');
							$('a[href="#employmentHistory"]').tab('show');
							$('#employmentHistory').addClass('active');
							
                        }
                    });
                },

				// Do not change code below
				errorPlacement: function (error, element) {
					error.insertAfter( element.parent() );
				}
				
            });
			
        }
		// ------------------------------------------------------------------------
		// End form for education Record
		// ------------------------------------------------------------------------

		 if ($('#staffEmploymentHistory').length) {
		   
		   $("#staffEmploymentHistory").validate({
            //Rules for form validation
			ignore: [],
            rules: {
				required: {
                    required: true
                },
				
			},
			// Messages for form validation
            messages: {
                required: {
                    required: 'Please enter something'
                },
				
            },
			submitHandler: function (form) {
				$(form).ajaxSubmit({
						type:"POST",
						url: "<?php echo base_url();?>/index.php/automcomplete/staff/updateEmploymentRecord",
						beforeSend: function () {
                            $('#staffEmploymentHistory button[type="submit"]').attr('disabled', true);
						},
                        success: function (response) {
                            //$("#staffInformationForm").addClass('submited');
							$("#EmploymentHistorySucess").show();
							 $("#EmploymentHistorySucess").fadeOut(9000);
							// $('#modalEemploymentHistory').modal('show');
							 //$('a[href="#educationalRecord"]').tab('show');
							 //$('a[href="#educationalRecord"]').addClass('active');
							 
							  $('#employmentHistory').removeClass('active');
							$('a[href="#spouseDetail"]').tab('show');
							$('#spouseDetail').addClass('active');
							 
							 
							 
							
                        }
                    });
                },

				// Do not change code below
				errorPlacement: function (error, element) {
					error.insertAfter( element.parent() );
				}
				
            });
			
        }
		// ------------------------------------------------------------------------
		//  Ajax for updating employer employment history
		// ------------------------------------------------------------------------
		
		
		
		// -----------------------------------------------------------------------
		//            Ajax for editing Parents / Spouse Details tabs
		// -----------------------------------------------------------------------
			
		if ($('#staffspouseDetail').length) {
		   
		   $("#staffspouseDetail").validate({
            //Rules for form validation
			ignore: [],
            rules: {
				required: {
                    required: true
                },
			},
			// Messages for form validation
            messages: {
                required: {
                    required: 'Please enter something'
                },
            },
			submitHandler: function (form) {
				$(form).ajaxSubmit({
						type:"POST",
						url: "<?php echo base_url();?>/index.php/automcomplete/staff/updateSpouseDetail",
						beforeSend: function () {
                            $('#staffspouseDetail button[type="submit"]').attr('disabled', true);
						},
                        success: function (response) {
                            //$("#staffInformationForm").addClass('submited');
							$("#spouseDetailSucess").show();
							 $("#spouseDetailSucess").fadeOut(9000);
							 //$('#modalEemploymentHistory').modal('show');
							 //$('a[href="#educationalRecord"]').tab('show');
							 //$('a[href="#educationalRecord"]').addClass('active');
							 
							$('#spouseDetail').removeClass('active');
							$('a[href="#childrenDetail"]').tab('show');
							$('#childrenDetail').addClass('active');

							
                        }
                    });
                },

				// Do not change code below
				errorPlacement: function (error, element) {
					error.insertAfter( element.parent() );
				}
				
            });
			
        }
		// ------------------------------------------------------------------------
		//            End for editing Parents / Spouse Details
		// ------------------------------------------------------------------------
		
		
		// ------------------------------------------------------------------------
		//               Ajax for editing Alternative Contact Information 
		// ------------------------------------------------------------------------
		
		if ($('#staffalternativeContact').length) {
		   
		   $("#staffalternativeContact").validate({
            //Rules for form validation
			ignore: [],
            rules: {
				required: {
                    required: true
                },
				kinEmail: { email: true},
				emergencyContactEmail: { email: true},
			},
			// Messages for form validation
            messages: {
                required: {
                    required: 'Please enter something'
                },
            },
			submitHandler: function (form) {
				$(form).ajaxSubmit({
						type:"POST",
						url: "<?php echo base_url();?>index.php/automcomplete/staff/updateAlternativeContact",
						beforeSend: function () {
                            $('#staffalternativeContact button[type="submit"]').attr('disabled', true);
						},
                        success: function (response) {
                            //$("#staffInformationForm").addClass('submited');
							$("#alternativeContactSucess").show();
							 $("#alternativeContactSucess").fadeOut(9000);
							// $('#modalalternativeContact').modal('show');
							 //$('a[href="#educationalRecord"]').tab('show');
							 //$('a[href="#educationalRecord"]').addClass('active');
							 
							 
							 $('#alternativeContact').removeClass('active');
							$('a[href="#bankDetail"]').tab('show');
							$('#bankDetail').addClass('active');
							
							
                        }
                    });
                },

				// Do not change code below
				errorPlacement: function (error, element) {
					error.insertAfter( element.parent() );
				}
				
            });
			
        }
		
		// ------------------    End Alternative Contact    -----------------------
		
		
		
		
		
		// ------------------------------------------------------------------------
		//               Ajax for editing Bank Details
		// ------------------------------------------------------------------------
		
		if ($('#staffbankDetail').length) {
		   
		   $("#staffbankDetail").validate({
            //Rules for form validation
			ignore: [],
            rules: {
				required: {
                    required: true
                },
			},
			// Messages for form validation
            messages: {
                required: {
                    required: 'Please enter something'
                },
            },
			submitHandler: function (form) {
				$(form).ajaxSubmit({
						type:"POST",
						url: "<?php echo base_url();?>index.php/automcomplete/staff/updateBankDetails",
						beforeSend: function () {
                            $('#staffbankDetail button[type="submit"]').attr('disabled', true);
						},
                        success: function (response) {
                           
							$("#bankDetailSucess").show();
							 $("#bankDetailSucess").fadeOut(9000);
							 //$('#modalbankDetail').modal('show');
							 
							$('#bankDetail').removeClass('active');
							$('a[href="#otherDetail"]').tab('show');
							$('#otherDetail').addClass('active');
							 
							 
							
                        }
                    });
                },

				// Do not change code below
				errorPlacement: function (error, element) {
					error.insertAfter( element.parent() );
				}
				
            });
			
        }
		
		// ------------------    End Bank Details     -----------------------
		
		
		
		
		
		// ------------------------------------------------------------------------
		//               Ajax for editing Other Details
		// ------------------------------------------------------------------------
		
		if ($('#staffotherDetail').length) {
		   
		   $("#staffotherDetail").validate({
            //Rules for form validation
			ignore: [],
            rules: {
				required: {
                    required: true
                },
			},
			// Messages for form validation
            messages: {
                required: {
                    required: 'Please enter something'
                },
            },
			submitHandler: function (form) {
				$(form).ajaxSubmit({
						type:"POST",
						url: "<?php echo base_url();?>index.php/automcomplete/staff/updateOtherDetails",
						beforeSend: function () {
                            $('#staffotherDetail button[type="submit"]').attr('disabled', true);
						},
                        success: function (response) {
                           
							$("#otherDetailSucess").show();
							 $("#otherDetailSucess").fadeOut(9000);
							// $('#modalotherDetail').modal('show');
							 
							 $('#otherDetail').removeClass('active');
							$('a[href="#providentFund"]').tab('show');
							$('#providentFund').addClass('active');
							 
						}
                    });
                },

				// Do not change code below
				errorPlacement: function (error, element) {
					error.insertAfter( element.parent() );
				}
				
            });
			
        }
		// ------------------    End Other Details     -----------------------
		
		
		
		
		
		// ------------------------------------------------------------------------
		//               Ajax for editing Provident Fund
		// ------------------------------------------------------------------------
		
		if ($('#staffProvidentFund').length) {
		   
		   $("#staffProvidentFund").validate({
            //Rules for form validation
			ignore: [],
            rules: {
				required: {
                    required: true
                },
			},
			// Messages for form validation
            messages: {
                required: {
                    required: 'Please enter something'
                },
            },
			submitHandler: function (form) {
				$(form).ajaxSubmit({
						type:"POST",
						url: "<?php echo base_url();?>index.php/automcomplete/staff/updateProvidentFund",
						beforeSend: function () {
                            $('#staffProvidentFund button[type="submit"]').attr('disabled', true);
						},
                        success: function (response) {
                           
							$("#providentFundSucess").show();
							 $("#providentFundSucess").fadeOut(9000);
							// $('#modalprovidentFund').modal('show');
							 
							$('#providentFund').removeClass('active');
							$('a[href="#ntn"]').tab('show');
							$('#ntn').addClass('active');
							
							
							 
						}
                    });
                },

				// Do not change code below
				errorPlacement: function (error, element) {
					error.insertAfter( element.parent() );
				}
				
            });
			
        }
		// ------------------    End Provident Fund     -----------------------
		
		
		
		// ------------------------------------------------------------------------
		//               Ajax for editing National Tax Number
		// ------------------------------------------------------------------------
		
		if ($('#staffntn').length) {
		   
		   $("#staffntn").validate({
            //Rules for form validation
			ignore: [],
            rules: {
				required: {
                    required: true
                },
			},
			// Messages for form validation
            messages: {
                required: {
                    required: 'Please enter something'
                },
            },
			submitHandler: function (form) {
				$(form).ajaxSubmit({
						type:"POST",
						url: "<?php echo base_url();?>index.php/automcomplete/staff/updateNtn",
						beforeSend: function () {
                            $('#staffntn button[type="submit"]').attr('disabled', true);
						},
                        success: function (response) {
                           
							$("#ntnSucess").show();
							 $("#ntnSucess").fadeOut(9000);
							// $('#modalntn').modal('show');
							 
							 $('#ntn').removeClass('active');
							$('a[href="#takaful"]').tab('show');
							$('#takaful').addClass('active');
							 
						}
                    });
                },

				// Do not change code below
				errorPlacement: function (error, element) {
					error.insertAfter( element.parent() );
				}
				
            });
			
        }
		// ------------------    End National Tax Number   -----------------------
		
		
		
		
		// ------------------------------------------------------------------------
		//               Ajax for editing National Tax Number
		// ------------------------------------------------------------------------
		
		if ($('#stafftakaful').length) {
		   
		   $("#stafftakaful").validate({
            //Rules for form validation
			ignore: [],
            rules: {
				required: {
                    required: true
                },
			},
			// Messages for form validation
            messages: {
                required: {
                    required: 'Please enter something'
                },
            },
			submitHandler: function (form) {
				$(form).ajaxSubmit({
						type:"POST",
						url: "<?php echo base_url();?>index.php/automcomplete/staff/updateTakaful",
						beforeSend: function () {
                            $('#stafftakaful button[type="submit"]').attr('disabled', true);
						},
                        success: function (response) {
                           
							$("#takafulSucess").show();
							 $("#takafulSucess").fadeOut(9000);
							 $('#modalTakaful').modal('show');
							 
							 
							// $('#ntn').removeClass('active');
							//$('a[href="#takaful"]').tab('show');
							//$('#takaful').addClass('active');
							 
						}
                    });
                },

				// Do not change code below
				errorPlacement: function (error, element) {
					error.insertAfter( element.parent() );
				}
				
            });
			
        }
		// ------------------    End National Tax Number   -----------------------
		
		
		
		
        // ========================================================================
        // Inbox
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

<script type="text/javascript">
    $(document).on('change','#region',function(){
        var region_id = $('#region').val();
        cache:false,
        $.ajax({
            type:"POST",
            data:{region:region_id},
            url:"<?php echo base_url(); ?>index.php/automcomplete/staff/get_sub_region",
            success:function(e){
                // $('#sub').html('');
                $('.filter_sub_region').html(e);
                // console.log(e);
            }
        })
    });

        $(document).on('click','#other_region',function(){
            $('.replace').html('');
            $('.replace').html('<label class="input"><input type="text" placeholder="Enter Region Name" name="other_region"></label>');
            $('.filter_sub_region').html('');
            $('.filter_sub_region').html('<label class="input"><input type="text" placeholder="Enter Sub Region Name" name="other_sub_region"></label>');

        });

        // $(document).on('click','#sub_region',function(){
        //     $("#sub_region_disable").html('');
        //     $('#sub_region_disable').html('<input type="text" name="other_sub_region" class="form-control">');
        // });
</script>







</body>
</html>