<script>
// JavaScript Document
/* JS for overlay Menu */
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

/* JS for Menu icon toggler */
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




$(document).ready(function() {
  $('#StaffListing').dataTable();
  $('#AllApplicantList').dataTable();
  $('#HoldList').dataTable();
  $('#TBIList').dataTable();
  $('#WaitListList').dataTable();
  $('#CommunicationListing').dataTable();
  $('#CommunicationsListing').dataTable();
$('#AdmissionFormListingFollowupHold').dataTable();
  
  
  $('#BatchListingList').dataTable();
  $('#AdmissionFormListinggs').dataTable({
	  "bLengthChange": false,
	  "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
  	"aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
    "iDisplayLength": 20
  });
 $('#internalMissHandle').dataTable({
 	 "bLengthChange": false,
	  "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
  	"aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
    "iDisplayLength": 20
 });
  
  
   /*var oTable = $('#AdmissionFormListing').dataTable({
	  "bLengthChange": false,
	  "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
  	"aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
    "iDisplayLength": 20
  });*/
  
  
  

     $('#AdmissionFormListing').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="position: absolute;right: 31px;top: -54px;width: 250px;"><option value="">Filter list by Current Standing</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } ); 

  
   $(document).on('change', '#fliterList', function(){
        var val = $(this).val();
        
		/*$('#AdmissionFormListing').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value="">Filter list by Current Standing</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex( $(this).val() );
						column.search( val ? '^'+val+'$' : '', true, false ).draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) { select.append( '<option value="'+d+'">'+d+'</option>' ) } );
            } );
        }
    } ); */
	
	
    });
	
  $('#AdmissionFormListingg').dataTable({
	  "bLengthChange": false,
	  "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
  	"aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
    "iDisplayLength": 20
  });
  
 /*
  * -----------------------------------------------------------
  * 	Kashif Solangi Function and Methods Start From Here
  * -----------------------------------------------------------
 */ 
 

$(document).on("click", "#hidr", function(){
  //$( "#followupComments" ).hide( 1000 );
   $('#followupComments').slideToggle("slow");
   var fllwUpLists = $("#followup_lists").switchClass( "col-md-7", "col-md-12", 1000, "easeInOutQuad" );
	
});
  
$(document).on("click", ".followup_row", function(){
		var fOType = $(this).attr("data-id");
		var spt = fOType.split("_");
		var formStage = spt[0];
		var form_id = parseInt( spt[1] );
		var currentStage = spt[2];



		var thisText = $(this).text();
		var fllwUpLists = $("#followup_lists");
		fllwUpLists.switchClass( "col-md-12", "col-md-7", 1000, "easeInOutQuad" );
		var fllwUpComments = $("#followupComments");
		fllwUpComments.slideDown("slow");
		
		if( fOType != '' ){
			getCommentsList(form_id,formStage,currentStage);

		}



	});
  
});

$(document).on("change", "#FOStatus", function(){
	var status = $('#FOStatus option:selected').val();
	var currentStage = $('#currentStage').val();
	var currentStaging = $('#currentStaged').val();

	//if( status != '' && status == 'Ext' ){
		
	if( status == 'Ext' || status == 'FHD'  ){
		var dateToday = new Date();		
		if( currentStage == 'Submission' || currentStage == 'All_applicantion' ||  currentStage == 'Fee Bill' || currentStage == 'Discussion' || currentStage == 'Offer'){
			
			$(".displayNone2").show("fast");
			if( status == 'FHD' ){
				var maxDate = '+30d';
			}else {
				var maxDate = '+90d';
			}
			
			$('#submission_ext').datepicker({
			dateFormat: 'yy-mm-dd',
			minDate: dateToday,
			maxDate: maxDate,
			prevText: '<i class="fa fa-chevron-left"></i>',
			nextText: '<i class="fa fa-chevron-right"></i>',
			});

			$(".displayNone").hide("fast");
		}else if( currentStage == 'Assessment' ){
			$(".displayNone2").hide("fast");
			$(".displayNone").show("show");
		}else{
			$(".displayNone2").hide("fast");
			$(".displayNone").hide("fast");	
		}
		
	}else{
		$(".displayNone").hide("fast");	
		$(".displayNone2").hide("fast");
	}

	// Extension for status If Required

	if(status == 'EXTENSION' && currentStaging == 'Submission'){
		$('.displayNone').show("show");
	}else{
		$('.displayNone').hide('fast');
	}
	
});
$(document).on("click", "#addFollowUp", function(){
	var form_id = $("#form_id").val();
	var form_stage = $("#form_stage").val();
	var currentStage1 = $('#currentStage').val();
	$("#ajaxloader2").show();
	
	$("#form_followup").validate({
		rules: {
			FOStatus: { required: true	},
			followupComments: { required: true	},
			submission_ext:{required:true},
			batch_id: { 
					required: function(){
						var status = $('#FOStatus option:selected').val();
						var currentStage = $('#currentStage').val();
						if( currentStage == 'Submission' ){ 
							return true; 
						}
					}
				},
			time_slot: { 
				required: function(){
						var ts = $('#time_slot option:selected').val();
						if( ts == '' ){ 
							return true; 
						}
					}
				},
		},
		messages: {
			FOStatus: { required: 'Please Mention Status' },
			followupComments: { required: 'Please Give Comments' },
			batch_id: { required: 'Please Select Batch' },
			time_slot: { required: 'Please Mention Time Slot' },
			submission_ext:{required:'Please Enter the date'},
		},
		submitHandler: function(form){
			$(form).ajaxSubmit({
				beforeSend: function(){ $("#ajaxloader").show(); $("#ajaxloader2").show(); },
				uploadProgress: function (event, position, total, percentComplete){},
				dataType: "JSON",
				success: function(res){
					//console.log( res );
					
					setTimeout(function(){
						$("#ajaxloader").hide();
						$("#form_followup")[0].reset();
						getCommentsList(form_id,form_stage,currentStage1);
					}, 3000);
					
					
					reloadTableData(form_id,form_stage,currentStage1);
					
					
					
				}
			});
		},
		complete:function(){   },
		errorPlacement: function (error, element) {
			error.insertAfter(element.parent());
		}
	});// end validate
	
	
});


// Function for getting and adding comments
// like Followup, Communicatin, All Application
function getCommentsList(form_id,type,currentStage){
	$.ajax({
		type: "POST",
		url : "<?=base_url();?>index.php/gs_admission/frontoffice_followup/getCommentsType",
		data:{formStage:type,form_id:form_id,currentStage:currentStage},
		dataType: "HTML",
		beforeSend: function(){},
		success: function(res){
			$("#followupComments").html('');
			$("#followupComments").html(res);
			if(type == 'internalMishandle'){
			console.log('at CurrentStageOffer');
		 	$('.statusDisplay').css('display','none');
		 	}else{
		 	$('.statusDisplay').css('display','');
		 	}
		},
		complete:function(){ },
		error:function(){}
	});
}

function reloadTableData(form_id,type,currentStage){
	$.ajax({
		type: "POST",
		url : "<?=base_url();?>index.php/gs_admission/frontoffice_followup/reloadTableData",
		data:{formStage:type,form_id:form_id,currentStage:currentStage},
		dataType: "HTML",
		beforeSend: function(){ $("#ajaxloader").show(); $("#ajaxloader2").show(); },
		success: function(res){
			
			$("#paddingRight20").html('');
			$("#paddingRight20").html(res);
			
			$("#ajaxloader").hide();
			$("#ajaxloader2").hide();
		},
		complete:function(){ $("#ajaxloader").hide(); $("#ajaxloader2").hide(); },
		error:function(){}
	});
}


$(document).on("change","#batch_id", function(){
	var tval = $(this).val();
	if(tval != '' ){
		$.ajax({
		type: "POST",
		url : "<?=base_url();?>index.php/gs_admission/frontoffice_followup/batchSlot",
		data:{batch_id:tval},
		dataType: "JSON",
		beforeSend: function(){},
		success: function(res){
			$('#time_slot').find('option').remove().end().append(res.op);
		},
		complete:function(){ },
		error:function(){}
	});
	}
});
</script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script>

<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>

</body>
</html>
