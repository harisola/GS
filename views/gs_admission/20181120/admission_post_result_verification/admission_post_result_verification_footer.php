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

	//  Regular Admission Data Table Intialize
	$('#RaoTable').dataTable({
	  "bLengthChange": false,
	  "columnDefs": [ {
	      "targets": 'no-sort',
	      "orderable": false,
	} ],
		"aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
	"iDisplayLength": 20
	});

	// Early Admission Data Table Intialize
	$('#EaoTable').dataTable({
	  "bLengthChange": false,
	  "columnDefs": [ {
	      "targets": 'no-sort',
	      "orderable": false,
	} ],
		"aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
	"iDisplayLength": 20
	});
  
  
  
  

    //  $('#AdmissionFormListing').DataTable( {
    //     initComplete: function () {
    //         this.api().columns().every( function () {
    //             var column = this;
    //             var select = $('<select style="position: absolute;right: 31px;top: -54px;width: 250px;"><option value="">Filter list by Current Standing</option></select>')
    //                 .appendTo( $(column.footer()).empty() )
    //                 .on( 'change', function () {
    //                     var val = $.fn.dataTable.util.escapeRegex(
    //                         $(this).val()
    //                     );
 
    //                     column
    //                         .search( val ? '^'+val+'$' : '', true, false )
    //                         .draw();
    //                 } );
 
    //             column.data().unique().sort().each( function ( d, j ) {
    //                 select.append( '<option value="'+d+'">'+d+'</option>' )
    //             } );
    //         } );
    //     }
    // } ); 

  
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
		console.log(fOType);
		var spt = fOType.split("_");
		var formStage = spt[0];
		var form_id = parseInt( spt[1] );
		var currentStage = spt[2];
		 var thisText = $(this).text();
		//console.log(currentStage);
		var fllwUpLists = $("#followup_lists");
		fllwUpLists.switchClass( "col-md-12", "col-md-7", 1000, "easeInOutQuad" );
		var fllwUpComments = $("#followupComments");
		fllwUpComments.slideDown("slow");
		if( fOType != '' ){
			getCommentsList(form_id,formStage,currentStage);
		}
	});
  
});


$(document).on("click", "#addFollowUp", function(){
	var form_id = $("#form_id").val();
	var form_stage = $("#form_stage").val();
	var currentStage1 = $('#currentStage').val();
	$("#form_followup").validate({
		rules: {
			FOStatus: { required: true	},
			followupComments: { required: true	},

		},
		messages: {
			FOStatus: { required: 'Please Mention Status' },
			followupComments: { required: 'Please Give Comments' },
		},
		submitHandler: function(form)
		{
			$(form).ajaxSubmit({
				success: function(res)
				{
					//alert(res['id']);
					//console.log("success Function");
					//console.log(res);
					// setTimeout(function(){
					// 	getCommentsList(form_id,form_stage,currentStage1);
					// }, 3000);	
					

					reloadTableData(form_id,form_stage,currentStage1);
					
				}
			});
		},
		complete:function(){

		},
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
		url : "<?=base_url();?>index.php/gs_admission/admission_post_result_verification/getCommentsType",
		data:{formStage:type,form_id:form_id,currentStage:currentStage},
		dataType: "HTML",
		beforeSend: function(){},
		success: function(res){
			$("#followupComments").html('');
			$("#followupComments").html(res);
		},
		complete:function(){ },
		error:function(){}
	});
}

function reloadTableData(form_id,type,currentStage){
	
	$('#ajaxloader2').show();
	$.ajax({
		type: "POST",
		url : "<?=base_url();?>index.php/gs_admission/admission_post_result_verification/reloadTableData",
		data:{formStage:type,form_id:form_id,currentStage:currentStage},
		dataType: "HTML",
		success: function(res){
			
			$("#paddingRight20").html('');
			$("#paddingRight20").html(res);
			$('#ajaxloader2').hide();

		},
		error:function(){}
	});
}



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
