<script>

$(document).on("click", ".absoluteBtn", function(){
	$("#Right_Side").show("show");
});
$(document).on("click", "#Close_Form", function(){
	$("#Right_Side").hide("show");
});

$(document).on("click","#greenBTN", function(){
database_event_category();
});

$(document).on("click",".Table_Cat_Name", function(){
	var ID = $(this).attr("id");
	
	$.ajax({
	url: "<?=site_url()?>/master_calendar/calendar_event_ajax/Html_For_Updation",
	type: "POST",
	data:{Cat_Event_Id:ID},
	dataType:'JSON',
	beforeSend: function() { $("#ajaxloader").show();},
	success:function(res){
		//$("#Event_Category_Layout").html(res);
		
		$("#Category_Id").val(res.Cat_Id);
		
		$("#Category_Name").val('');
		$("#Category_Name").val(res.cat_name);
		
		$("#Category_Short_Title").val('');
		$("#Category_Short_Title").val(res.cat_short_title);
		
		$("#Category_Description").val('');
		$("#Category_Description").val(res.cat_description);
		
		$("#Category_Status").val('');
		$("#Category_Status").val(res.cat_status);
		
		$("#Category_Color").val('');
		$("#Category_Color").val(res.cat_color);
		$("#OpType").val(2);
		
		
	},
	complete:function(){ }
	});
});
function database_event_category(){
	var Cat_Name = $("#Category_Name").val();
	var Cat_Status = parseInt($("#Category_Status").val());
	var Cat_Short_Title = $("#Category_Short_Title").val();
	var Cat_Color = $("#Category_Color").val();
	var Cat_Des = $("#Category_Description").val();
	var OpType = $("#OpType").val();
	var Category_Id = $("#Category_Id").val();
	
	var Status='';
	if(Cat_Status==1){
		Status='Active';	
	}else{
		Status='In-Active';
	}
	
	if( Cat_Name != '' &&  Cat_Short_Title != '' ){
		
		$("#Error_Msg").hide("slow");
		var Go_To_Action=1;
		
	}else{
		var Go_To_Action=0;
		$("#Error_Msg").show("slow");
	}
	
	
	$("#ajaxloader").show();
	if( Go_To_Action > 0 ){
	$.ajax({
	url: "<?=site_url()?>/master_calendar/calendar_event_ajax/Category_Management",
	type: "POST",
	data:{Cat_name:Cat_Name,Cat_Status:Cat_Status,Cat_Short_Title:Cat_Short_Title,Cat_Color:Cat_Color,Cat_Des:Cat_Des,Op:OpType,Cat_Event_Id:Category_Id},
	dataType:'JSON',
	beforeSend: function() {
	 	$("#ajaxloader").show();
	},
	success: function(res){
		
		Reset_Fields();
		
		var Table_Row = '<tr class="" id="Row_'+res.ID+'">';
	        Table_Row += '<td class="text-center">'+res.ID+'</td>';
	        Table_Row += '<td><a href="#" class="Table_Cat_Name" id="'+res.ID+'">'+Cat_Name+'</a></td>';
	        Table_Row += '<td class="text-center">'+Status+'</td>';
            Table_Row += '</tr>';
			
			if(OpType==1){
				$('#Event_Cat_Table tbody').append(Table_Row);
			}else{
				$("#Row_"+res.ID).replaceWith(Table_Row);
			}
	
		$("#ajaxloader").hide();
	},
	complete: function () { 
		//$("#ajaxloader").hide();
	}
	});
	
	}else{ $("#ajaxloader").hide(); }
}

$(document).ready(function(){
	
	$('#Event_Cat_Table').dataTable({
		"order": [],
		"columnDefs": [{ "targets"  : 'no-sort', "orderable": false, }]
	});
});

function Reset_Fields(){
	$("#Category_Name").val('');
		$("#Category_Status").val('');
		$("#Category_Short_Title").val('');
		$("#Category_Color").val();
		$("#Category_Description").val('');
		$("#OpType").val(1);
		$("#Category_Id").val(0);
		
}
$(document).on("click", "#greenBTN3", function(){
	Reset_Fields();
});
</script>

<script src="<?=base_url();?>components/js/jquery.min.js"></script>
<script src="<?=base_url();?>components/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/custom.js"></script>




<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>

</body>
</html>
