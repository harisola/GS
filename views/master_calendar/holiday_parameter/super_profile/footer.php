<script>
$(document).on("click", ".absoluteBtn", function(){
	$("#Right_Side").show("show");
});
$(document).on("click", "#Close_Form", function(){
	$("#Right_Side").hide("show");
});


$(document).on("click", "#greenBTN", function(){
	
	$("#issuance").validate({
		rules: {
			Holiday_Parameter:   { required: true	},
			Holiday_Short_Title: { required: true   },
		},
		messages: {
			Holiday_Parameter: { required: 'Please Enter Holiday Parameter!' },
			Holiday_Short_Title: { required: 'Please Enter Short Title!' }
		},
		submitHandler: function(form){
			$(form).ajaxSubmit({
				beforeSend: function(){ $("#ajaxloader").show(); },
				uploadProgress: function (event, position, total, percentComplete){},
				dataType: "JSON",
				success: function(res){ 
				// console.log(res) 
				$("#issuance").validate().resetForm();
				var Table_Row = '<tr class="Event_Category_Row" id="Row_'+res.ID+'">';
					Table_Row += '<td class="text-center">'+res.ID+'</td>';
					Table_Row += '<td><a href="#" class="Table_Cat_Name" id="'+res.ID+'">'+res.Title+'</a></td>';
					Table_Row += '<td class="text-center">'+res.Short+'</td>';
					Table_Row += '</tr>';
					if( parseInt(res.OpType)==1){
						$('#Event_Cat_Table2 tbody').append(Table_Row);
					}else{
						$("#Row_"+res.ID).replaceWith(Table_Row);
					}
				}
			});
		},
		errorPlacement: function (error, element){
			error.insertAfter(element.parent());
		}
	});// end validate


});



function Get_Row(Row_ID){
	var Type='Holiday';
	try{
		$.ajax({
		url: "<?=site_url()?>/master_calendar/holiday_parameter_ajax/Get_Holiday_Record",
		type: "POST",
		data:{Row_ID:Row_ID,Type:Type},
		dataType:'JSON',
		beforeSend: function() { $("#ajaxloader").show();},
		success:function(res){
			//console.log(res)
			
			$("#OpType").val(2);
			$("#Holiday_ID").val(res.ID);
			
			$("#Holiday_Parameter").val('');
			$("#Holiday_Parameter").val(res.cat_name);
			
			$("#Holiday_Short_Title").val('');
			$("#Holiday_Short_Title").val(res.cat_short_title);
			
			$("#Holiday_Description").val('');
			$("#Holiday_Description").val(res.cat_description);
			
		},
		complete:function(){ }
		});
	
	}catch(error){
		alert(error.message);
	}
}
$(document).on("click", ".Event_Category_Row", function(){
	var R_ID=$(this).attr("id");
	var RID=R_ID.split("Row_");
	var Row_ID=parseInt(RID[1]);
	Get_Row(Row_ID);
});
</script>

<script src="<?=base_url();?>components/js/jquery.min.js"></script>
<script src="<?=base_url();?>components/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/custom.js"></script>
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>

</body>
</html>
