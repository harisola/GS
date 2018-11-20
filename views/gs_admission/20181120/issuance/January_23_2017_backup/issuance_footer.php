<!--Forms-->

<!--Panel Question Modal-->
<div class="modal fade" id="alreadySubmitted">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header"> Campus<i class="fa fa-question"></i>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
      <div class="modal-body text-center"> Please Choose Campus </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal --> 


<script type="text/javascript">


$(document).ready(function(){


$("#father_nic").prop("readonly",true);

	
if ($('#token_no').length) {
	$('#token_no').mask('999', {
		placeholder: 'X'
	});
}	
	
	
	
// GF ID	
if ($('#gf_id').length) {
	$('#gf_id').mask('99-999', {
		placeholder: 'X'
	});
}	
	
// Date range
if ($('#date_of_birth').length) {
	
	$('#date_of_birth').datepicker({
		changeMonth: true,
        changeYear: true,
		 yearRange: '2000:'+(new Date).getFullYear(),
		dateFormat: 'yy-mm-dd',
		prevText: '<i class="fa fa-chevron-left"></i>',
		nextText: '<i class="fa fa-chevron-right"></i>',
		onSelect: function(date) {
			getadmissiongradedob(date);
		},
	});	

}	

if ($('#f_nic').length) {
  $('#f_nic').mask('99999-9999999-9', {
        placeholder: 'X'
   });
}



// Father NIC
if ($('#father_nic').length) {
  $('#father_nic').mask('99999-9999999-9', {
        placeholder: 'X'
   });
}
// Mother NIC
if ($('#mother_nic').length) {
  $('#mother_nic').mask('99999-9999999-9', {
        placeholder: 'X'
   });
}	
	
	
// father mobile
if ($('#father_mobile').length) {
  $('#father_mobile').mask('0399-9999999', {
        placeholder: 'X'
   });
}	
	

// mother_mobile 
if ($('#mother_mobile').length) {
  $('#mother_mobile').mask('0399-9999999', {
        placeholder: 'X'
   });
}	
	
	
$(document).on("keyup", "#gf_id", function(){
	var gfid = $(this).val();
	var f_nic = '';
	//console.log( value.length );
	if ( gfid.indexOf("X") >= 0 ){
		//console.log( 0 );
		
			$("#father_name").val('');
			$("#father_mobile").val('');
			$("#father_nic").val('');
			//$("#father_nic").val(f_nic);
			$("#father_email").val('');
			$("#mother_name").val('');
			$("#mother_mobile").val('');
			$("#mother_nic").val('');
			$("#mother_email").val('');
			$("#family_exists").val(0);
				$("#show_fif").hide();
				
	}else{
		//console.log( 1 );
		if( gfid.length == 6 ){
			getdataByGfId(gfid,f_nic);	
		}
		$("#father_nic").val(f_nic);
	}
	
	
});	

$(document).on("keyup", "#f_nic", function(){
	var f_nic = $(this).val();
	var gfid = '';
	var campus = $("#campus").val();
	
	//if( campus != '' ){
		if ( f_nic.indexOf("X") >= 0 ){
			$("#father_nic").val(f_nic);
			$("#father_name").val('');
			$("#father_mobile").val('');
			//$("#father_nic").val('');
			//$("#father_nic").val(f_nic);
			$("#father_email").val('');
			$("#mother_name").val('');
			$("#mother_mobile").val('');
			$("#mother_nic").val('');
			$("#mother_email").val('');
			$("#family_exists").val(0);
			$("#show_fif").hide();
		}else{
			getdataByGfId(gfid,f_nic);	
			$("#father_nic").val(f_nic);
		}
	
	//}else{}
	
	
	
});	


 
function getdataByGfId(gf_id,f_nic){
	
var lenght = gf_id.length;

		
		$.ajax({
			type: "POST",
			url : "<?=base_url();?>index.php/gs_admission/ajax_base/getDataByGfId/",
			data: {gf_id:gf_id,f_nic:f_nic},
			dataType: "JSON",
			beforeSend: function(){},
			success: function(res){
				
			$("#father_name").val('');
			$("#father_mobile").val('');
			//$("#father_nic").val('');
			//$("#father_nic").val(f_nic);
			$("#father_email").val('');
			$("#mother_name").val('');
			$("#mother_mobile").val('');
			$("#mother_nic").val('');
			$("#mother_email").val('');
			$("#family_exists").val(0);
			//console.log(res);
				$("#show_fif").hide();
				if(!res){
				
				}else{
					
				var gf_id = parseInt( res.f_id );
				var single_parent = parseInt( res.s_p );
				var primary_contact = parseInt( res.p_c);
				var family_id = res.family_id;
								
				$("#father_name").val( res.f_name );
				$("#father_mobile").val(res.f_mobile_phone);
				$("#father_nic").val(res.f_nic);
				
				
				
				$("#father_email").val(res.f_email);
				$("#mother_name").val( res.m_name );
				$("#mother_mobile").val(res.m_mobile_phone);
				$("#mother_nic").val(res.m_nic);
				$("#mother_email").val(res.m_email);
				
				if( primary_contact == 1){
					$( "#primary_contact1" ).prop( "checked", false );
					$( "#primary_contact2" ).prop( "checked", true );
				}else{
					$( "#primary_contact2" ).prop( "checked", false );
					$( "#primary_contact1" ).prop( "checked", true );
				}
				if( single_parent == 1 ){
					$( "#c2" ).prop( "checked", true );	
				}else{
					$( "#c2" ).prop( "checked", false );
				}
				
				if( gf_id == '' ){
					$("#show_fif").hide();
					$("#family_exists").val(gf_id);
				}else{
					$("#family_exists").val(gf_id);	
					$("#show_fif").show();
				}
				
				console.log( "family_id" + family_id );
				
				if( family_id == '' ){
					$("#show_fif").hide();
				}else{
					$("#show_fif").show();
				}
				
				
			   }
			},
			complete:function(){ },
			error:function(){}
			
		});
		
	//}
	
}



// Issuance Form Listing Data Table	
$('#issuanceFormListing').dataTable({
	"order": [],
    "columnDefs": [{ "targets"  : 'no-sort', "orderable": false, }]
});




  $(document).on("click", ".GFIDClick", function(){
       $(".FatherNICShow").hide();
	   $("#f_nic").val('');
	   $(".GFIDShow").show();
    });
	
	$(document).on("click", ".FatherNICClick", function(){
    
       $(".GFIDShow").hide();
	   $("#gf_id").val('');
	   $(".FatherNICShow").show();
    });
	
	

 $("#issuance").bind("keypress", function(e) {
            if (e.keyCode == 13) return false;
      });
	  
});


$(document).on("change", "#campus", function(){
	var campus = $(this).val();
	//alert(campus)
	if( campus != '' ){
		if( parseInt( campus ) == 1 ){
			$("#academic_session").val(9);
		}else{
			$("#academic_session").val(10);
		}
	}else{
		$("#academic_session").val('');
	}
});

		
/*
father_name: { 
		lettersonly:true,
		required: function(){
			
			if( $("#primary_contact1").is(':checked') || $("#FormAction").val() == 1 ||  $("#c2").is(':checked') ){ 
				return true
			}else{
				return false
			}
			
		},
	},
*/	
//https://jqueryvalidation.org/required-method/		

$(document).on("click", "#greenBTN", function(){
var campus_se = $('#campus option:selected').val();

$.validator.addMethod("lettersonly", function(value, element) {
return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "Only alphabetical characters");


$("#issuance").validate({
rules: {
	
	f_nic: { required: true	},
	gf_id: { required: true },
	token_no: { required: true },
	official_name: { required: true, lettersonly:true },
	call_name: { required: true, lettersonly:true, rangelength: [3, 9]},
	date_of_birth: { required: true },
	gender: { required: true },
	father_name: { 
		lettersonly:true,
		required: true
	},
	father_mobile: { 
		required: function() {
			
			/*if( $("#c2").is(':checked') ){ 
				return false
			}else{ 
				return true
			} */
			
			if( $("#c2").is(':checked') ){
				
				if(  $("#primary_contact1").is(':checked') ){
					return true
				}else{
					return false
				}
					
			}else{
				
				if(  $("#primary_contact1").is(':checked') ){
					return true
				}else{
					return false	
				}
				
			}
			
		},
	},
	
	father_nic: { required: true },
	father_email: { 
		//required: function(element) { if($("#c2").is(':checked')){ return false; }else{ return true; } },
		email:true 
	},
	mother_name: { required: function(){
		
		if( $("#c2").is(':checked') ){
				
				if(  $("#primary_contact2").is(':checked') ){
					return true
				}else{
					return false
				}
					
			}else{
				
				if(  $("#primary_contact2").is(':checked') ){
					return true
				}else{
					return false	
				}
				
			}
			
			/*if( $("#primary_contact2").is(':checked')) { 
			return true
			}else{
				return false
			}*/
		}
	},
	mother_mobile:{ required:function(){
		/*if( $("#primary_contact2").is(':checked')) { 
				return true
			}else{
				return false
			}*/
			
			if( $("#c2").is(':checked') ){
				
				if(  $("#primary_contact2").is(':checked') ){
					$("#mother_mobile").addClass( "invalid" );
					return true
					
				}else{
					$("#mother_mobile").addClass( "valid" );
					return false
				}
					
			}else{
				
				if(  $("#primary_contact2").is(':checked') ){
					return true
				}else{
					return false	
				}
				
			}
	}
	
	},
	//mother_email:{ email:true  },
	admission_grade: { required: true },
	campus: { required: true },
	photo_submitted: { required: true }
},
messages: {
	f_nic: { required: '' },
	gf_id: { required: '' },
	token_no: { required: '' },
	official_name: { required: '', lettersonly:'' },
	call_name: { required: '', lettersonly:'' },
	date_of_birth: { required: '', lettersonly:'' },
	gender: { required: '' },
	//single_parent: { required: '' },
	father_name: { required: '', lettersonly: '' },
	father_mobile: { required: '' },
	father_nic: { required: '' },
	father_email: { email: '' },
	mother_name : { required: '' },
	mother_mobile:{ required:'' },
	//mother_email: { required: '' },
	admission_grade: { required: '' },
	campus: { required: '' },
	photo_submitted:{ required: '' }
},
submitHandler: function(form){
	$(form).ajaxSubmit({
		beforeSend: function(){ $("#ajaxloader").show(); },
		uploadProgress: function (event, position, total, percentComplete){},
		dataType: "JSON",
		
		success: function(res){
		//console.log(res);
		$("#ajaxloader").hide();
		//$("#issuance").validate().resetForm();
		refreshForm(campus_se);
		reload_table_data()
		call_pdf_insertForm(res.form_id);
		
		
		}
	});
},
errorPlacement: function (error, element) {
error.insertAfter(element.parent());
}
});// end validate
});// end on click button
   

$(document).on("click", ".view_n_Edit", function(){
	
	var data_id = $(this).attr("data-id");
	var data_id = parseInt( data_id );
	//console.log(data_id);
	
	getAppDtEdt( data_id );
	//setInterval(function(){ //getAppDtEdt( data_id ); }, 3000);
});

function getAppDtEdt(data_id){
	var ad = $("#applicantDetails");
	if( data_id > 0 ){
		$.ajax({
		type: "POST",
		url : "<?=base_url();?>index.php/gs_admission/ajax_base/applicantDetailsEdit",
		data: {data_id:data_id},
		dataType: "HTML",
		beforeSend: function(){},
		success: function(res){
			ad.html('');
			ad.html(res);
		},
		complete:function(){ },
		error:function(){}
		});
	}
}


function getadmissiongradedob(dateOfBirth){
	//console.log(dateOfBirth)
	
		var f_nic = $("#f_nic").val();
		var official_name = $("#official_name").val();
		var gender = $("#gender").val();
		var academic_session = $("#academic_session").val();
		var campus = $("#campus").val();
		
		//if( campus != '' ){
			
			$.ajax({
				
				type: "POST",
				url : "<?=base_url();?>index.php/gs_admission/ajax_base/admissionGrade",
				data: {dob:dateOfBirth,f_nic:f_nic,official_name:official_name,gender:gender,academic_session:academic_session},
				dataType: "JSON",
				beforeSend: function(){},
				success: function(res){
					// console.log(res);
					// console.log( res.dob[0].grade_name );
					
					
					$("#admission_grade").val( res.dob[0].grade_name );
					$("#admission_grade_id").val( parseInt( res.dob[0].grade_id ) );
					
					if( parseInt(  res.form_no )  > 0 ){
						var form_id = parseInt(  res.form_no );
						var printULR = "<?=base_url();?>index.php/gs_admission/ajax_base/print_admission_form?FormNo="+form_id;
						
						$("#print_url").attr('href', printULR);
						$("#print_url").attr('target','_blank');
						
						$("#greenBTN").hide();
						$("#calloutMessage").show();
						
					}else{
						$("#calloutMessage").hide();
						$("#greenBTN").show();
					}
					
				},
				complete:function(){ },
				error:function(){}
				
			});
			
		//}else{
			//$("#date_of_birth").val('');
		//	$('#alreadySubmitted').modal({ show: 'true' });
		//}
	
}



function refreshForm(campus_se){
	
		$.ajax({
		type: "POST",
		url : "<?=base_url();?>index.php/gs_admission/ajax_base/refreshFormData",
		dataType: "HTML",
		data:{campus:campus_se},
		beforeSend: function(){},
		success: function(res){
			$("#form_data").html('');
			$("#form_data").html(res);
		},
		complete:function(){ },
		error:function(){}
		});
	
}



function reload_table_data(){
	//console.log(dateOfBirth)
		$.ajax({
		type: "POST",
		url : "<?=base_url();?>index.php/gs_admission/ajax_base/reloadTableData",
		dataType: "HTML",
		beforeSend: function(){},
		success: function(res){
			$("#MaroonBorderBox2").html('');
			$("#MaroonBorderBox2").html(res);
		},
		complete:function(){ },
		error:function(){}
		});
	
}

$(document).on("click", "#greenBTN2", function(){ 
		var campus = $('#campus option:selected').val();
		//console.log(campus)
		refreshForm(campus);
});


$(document).on("click","#reloadList", function(){
	$.ajax({
		type: "POST",
		url : "<?=base_url();?>index.php/gs_admission/ajax_base/reloadFormList",
		dataType: "JSON",
		beforeSend: function(){},
		success: function(res){
			//console.log(res)
			$("#myTotal").html('');
			$("#myTotal").html(res.ml);
			$("#grandTotal").html('');
			$("#grandTotal").html(' / '+res.gt);
			reload_table_data();
		},
		complete:function(){ },
		error:function(){}
		});
});

$(document).on("click", "#show_fif", 

function(){
	var family_id = $("#family_exists").val();
	
	$("#tab_content").html('');
	
	
	
	$.ajax({
		type: "POST",
		url : "<?=base_url();?>index.php/gs_admission/ajax_base/show_fif",
		data:{gf_id:family_id},
		dataType: "JSON",
		beforeSend: function(){},
		success: function(res){
			
			//console.log(res);
			
			$("#tab_content").html('');
			$("#tab_content").html(res.fH);
			// Show Fif Modal
			$('#myModal').modal({ show: 'true' });
		
			
		},
		complete:function(){},
		error:function(){}
		});
		
		//if( family_id != '' ){ $("#family_gf_id").html( family_id );	}
		
		//setInterval(function(){ $('#myModal').modal({ show: 'true' });}, 1000);
		
	
}

);




function call_pdf_insertForm(FormNo){
	var url = "<?php echo base_url(); ?>index.php/gs_admission/ajax_base/print_admission_form?FormNo="+FormNo;
	var win = window.open(url, '_blank');
	if(win){
	    //Browser has allowed it to be opened
	    win.focus();
	}else{
	    //Broswer has blocked it
	    alert('Please allow popups for this site');
	}
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
<script src="<?=base_url();?>components/gs_theme/js/custom.js"></script>

</body>
</html>