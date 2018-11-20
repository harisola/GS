
<style>
#BatchListing td {
    padding: 9px;
}

.absoluteDiv3 input[type="submit"] {
    float: right !important;
    padding: 2px 8px !important;
    font-size: 14px !important;
    margin-left: 10px !important;
	width:auto !important;
}
.absoluteDiv3 {
    top: 70px;
	width:590px;
}
.rangeinput {
	width: 150px !important;
    font-size: 12px;
    padding: 3px 5px !important;
}
</style>
<script>
$(document).ready(


function(){
	
	
	 $('#billMISTable').DataTable( {
        dom: 'Bfrtip',
		 buttons: ['copy','excel']
	
    } );
	
$('.rangeinput').datepicker({
	dateFormat: 'yy-mm-dd',
	prevText: '<i class="fa fa-chevron-left"></i>',
	nextText: '<i class="fa fa-chevron-right"></i>',
});


}

);


$(document).on("click", "#btn_submit", function(){
	
	
	$("#issuance").validate({
		rules: {
		from_date: { required: true	},
		to_date:   { required: true	},
		},
		messages: {
		from_date: { required: 'From Date' },
		to_date: { required: 'To Date' },
		},
		submitHandler: function(form){
			$(form).ajaxSubmit({
				beforeSend: function(){ $("#ajaxloader").show(); },
				uploadProgress: function (event, position, total, percentComplete){},
				dataType: "HTML",
				success: function(res){
				//console.log( res );
				//$("#issuance")[0].reset();
				$("#MaroonBorderBox").html('');
				$("#MaroonBorderBox").html(res);
				},complete:function(){  },
			});
		},
		errorPlacement: function (error, element) {
		error.insertAfter(element.parent());
		}
	});// end validate
	
	
	
});

</script>


    
    
    
    
    
    
    
    
   
	
	

<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src=" //cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">


    
    

	
	
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script>
<?php /* ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script>

<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>

<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/custom.js"></script>

<?php */ ?>





</body>
</html>
