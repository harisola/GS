<script>
$(document).ready(function(){
	$('#confirmAdmissionTable').dataTable();
	$('#CommunicationListing').dataTable();
	$('#regretListingTable').dataTable();
	//$('#AllApplicantTable').dataTable();
	
	$('#RequestForGradeTable').dataTable();


$('#confirmAdmissionTable2').DataTable( {
initComplete: function () {
this.api().columns().every( function () {
	var column = this;
	var select = $('<select style="position: absolute;right: 31px;top: -80px;width: 250px;"><option value="">Filter list by Current Standing</option></select>')
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
	
	


$('#AllApplicantTable').DataTable( {
initComplete: function () {
this.api().columns().every( function () {
	var column = this;
	var select = $('<select style="position: absolute;right: 31px;top: -80px;width: 250px;"><option value="">Filter list by Current Standing</option></select>')
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

	
	/*
$('#CommunicationListing').DataTable( {
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
	*/
	
	/*
$('#regretListingTable').DataTable( {
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
	*/	
	
		
	/*
$('#AllApplicantTable').DataTable( {
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
	*/	
	
	
	
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
		url : "<?=base_url();?>index.php/gs_admission/authorities_po2/getCommentsType",
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
	$("#ajaxloader").show();
	$.ajax({
		type: "POST",
		url : "<?=base_url();?>index.php/gs_admission/authorities_po2/reloadTableData",
		data:{formStage:formStage,form_id:form_id },
		dataType: "HTML",
		beforeSend: function(){ $("#ajaxloader").show(); },
		success: function(res){
			$("#paddingRight20").html('');
			$("#paddingRight20").html(res);
		},
		complete:function(){ $("#ajaxloader").show(); },
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
			decision_performed: { required: function(){
				var rfg = $("#request_for_grade").val();
				if(  parseInt( rfg ) > 0 ){
					return true
				}else{
					return false
				}
			}	
			},
			txt_comments: { required: true	},
			revive_txt_comments:{required:true}
		},
		messages: {
			reviveApplication: { required: 'Please Select Revive' },
			decision_performed: { required: 'Please select decision' },
			txt_comments: { required: 'Please Give Comments' },
			revive_txt_comments:{required: 'Please Give Comments'}
			
			
		},
		submitHandler: function(form){
			$("#ReviveCase").show();
			// dialog box for confirmation
			$( "#ReviveCase" ).dialog({
			  resizable: false,
			  height: "auto",
			  width: 400,
			  modal: true,
			  buttons: {
				"Yes Complete": function() {
					$(form).ajaxSubmit({
						beforeSend: function(){ $("#ajaxloader").show(); },
						uploadProgress: function (event, position, total, percentComplete){},
						dataType: "JSON",
						success: function(res){
							//console.log( res );
							$("#postComments").resetForm();
							 getCommentsList(form_id,form_stage);
							$('#CommunicationListing tr[data-id='+form_id+']').remove();
							$('#AllApplicantTable tr[data-id='+form_id+']').remove();
							$('#regretListingTable tr[data-id='+form_id+']').remove();
							$("#ajaxloader").hide();
						},complete:function(){  },
					});
				$( this ).dialog( "close" );
				},
				Cancel: function() {  $("#postComments").resetForm(); $( this ).dialog( "close" ); $("#ReviveCase").hide(); 
				$("#ajaxloader").hide();
				}
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