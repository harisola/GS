<script>
$(document).ready(function(){
	$('#confirmAdmissionTable').dataTable();
	$('#CommunicationListing').dataTable();
	$('#regretListingTable').dataTable();
	$('#AllApplicantTable').dataTable();
	

});

$(document).on("click", "#hidr", function(){
  
   $('#rightSide').slideToggle("slow");
   var fllwUpLists = $("#leftSide").switchClass( "col-md-7", "col-md-12", 1000, "easeInOutQuad" );
	
});


$(document).on("click", ".confirm_admission", function(){
		var fOType = $(this).attr("data-id");
		var spt = fOType.split("_");
		var formStage = spt[0];
		var form_id = parseInt( spt[1] );
		//var currentStage = spt[2];
		
		var fllwUpLists = $("#leftSide");
		fllwUpLists.switchClass( "col-md-12", "col-md-7", 1000, "easeInOutQuad" );
		var fllwUpComments = $("#rightSide");
		fllwUpComments.slideDown("slow");
		if( fOType != '' ){
			getCommentsList(form_id, formStage );
		}
	});
  

function getCommentsList(form_id, formStage ){
	$.ajax({
		type: "POST",
		url : "<?=base_url();?>index.php/gs_admission/authorities_ad2/getCommentsType",
		data:{formStage:formStage,form_id:form_id },
		dataType: "HTML",
		beforeSend: function(){},
		success: function(res){
			$("#rightSide").html('');
			$("#rightSide").html(res);
		},
		complete:function(){ },
		error:function(){}
	});
}

function reloadTableData( form_id, formStage ){
	$.ajax({
		type: "POST",
		url : "<?=base_url();?>index.php/gs_admission/authorities_ad2/reloadTableData",
		data:{formStage:formStage,form_id:form_id },
		dataType: "HTML",
		beforeSend: function(){},
		success: function(res){
			$("#paddingRight20").html('');
			$("#paddingRight20").html(res);
		},
		complete:function(){ },
		error:function(){}
	});
}

$(document).on("click", "#formSubmit", function(){
	
	/*$("#ReviveCase").modal({                    // wire up the actual modal functionality and show the dialog
      "backdrop"  : "static",
      "keyboard"  : true,
      "show"      : true                     // ensure the modal is shown immediately
    });*/
	var form_stage = $("#stageType").val();
	var form_id = $("#form_id").val();
	
	$("#postComments").validate({
		rules: {
			reviveApplication: { required: true	},
			txt_comments: { required: true	},
		},
		messages: {
			reviveApplication: { required: 'Please Select Revive' },
			txt_comments: { required: 'Please Give Comments' },
		},
		submitHandler: function(form){
			$("#ajaxloader").show();
			$("#ReviveCase").show();
			// dialog box for confirmation
			$( "#ReviveCase" ).dialog({
			  resizable: false,
			  height: "auto",
			  width: 400,
			  modal: true,
			  buttons: {
				"Yes Revive Applicant": function() {
					$(form).ajaxSubmit({
						beforeSend: function(){  },
						uploadProgress: function (event, position, total, percentComplete){},
						dataType: "JSON",
						success: function(res){
							console.log( res );
							 $("#postComments").resetForm();
							getCommentsList(form_id,form_stage);
							$('#confirmAdmissionTable tr[data-id='+form_id+']').remove();
							$('#CommunicationListing tr[data-id='+form_id+']').remove();
							$('#AllApplicantTable tr[data-id='+form_id+']').remove();
							$("#ajaxloader").hide();
							//reloadTableData( form_id, form_stage );
						}
					});
				$( this ).dialog( "close" );
				},
				Cancel: function() {  $("#postComments").resetForm(); $( this ).dialog( "close" ); $("#ReviveCase").hide(); }
			  }
			});
	
	
			
		},
		errorPlacement: function (error, element) {
			error.insertAfter(element.parent());
		}
	});// end validate
	
	
	
	
	
	
	
	
	
	
	
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
<script src="<?=base_url();?>components/gs_theme/js/custom.js"></script>

</body>
</html>