<style>
#BatchListing td {
    padding: 9px;
}
</style>
<script>


$('#All').click(function (e) {
    $(this).closest('.mutliSelect').find('li input:checkbox').prop('checked', this.checked);
});
/*
	Dropdown with Multiple checkbox select with jQuery - May 27, 2013
	(c) 2013 @ElmahdiMahmoud
	license: http://www.opensource.org/licenses/mit-license.php
*/

$(".dropdown dt a").on('click', function() {
  $(".dropdown dd ul").slideToggle('fast');
});

$(".dropdown dd ul li a").on('click', function() {
  $(".dropdown dd ul").hide();
});

function getSelectedValue(id) {
 return $("#" + id).find("dt a span.value").html();
}



$('.mutliSelect input[type="checkbox"]').on('click', function() {

  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
    title = $(this).val() + ",";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
   // $('.multiSel').append(html);
   // $(".hida").hide();
  } 
  else {	  
	$('span[title="' + title + '"]').remove();
	var ret = $(".hida");
	$(".hida").hide();
	$('.dropdown dt a').append(ret);
	  if (!$(this).is(':checked')) {
		  $(".hida").html('');
		  $(".hida").show();
	  }
	  //else
	  //{
	//	  	$(".hida").show();
	//		$(".hida").html('Select');
	 // }
  } 
});


$('.mutliSelect input[type="checkbox"]').on('click', function() {
//  title = $(this).id + ",";
  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
	  title = $(this).attr("id")+ ",";
	

var ID = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
	  ID = $(this).val();	
	  
	 


 
 

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSel').append(html);
	var appendHidden = '<input type="hidden" class="someElement" name="gradename[]" value="'+ID+'" id="grade_id_'+ID+'"  />';
	$('#fliter_issuance').append(appendHidden);
	
    $(".hida").hide();
	
  }else {
	  
	$('span[title="' + title + '"]').remove();
	var ret = $(".hida");
	$(".hida").hide();
	$('.dropdown dt a').append(ret);
	  if (!$(this).is(':checked')) {
		  
		  $(".hida").html('');
		  $(".hida").show();
	  }
	 
	  
	
	$("#grade_id_"+ID+"").remove();
  }
 
 
var count_hidden2 = $('.someElement:hidden').length;
var hiden_ele = parseInt(count_hidden2);
	
	if( hiden_ele == 0 ){
		$("#gradeNameValidate").val("");	
	}else{
		$("#gradeNameValidate").val("1");
	}
	
	
 /*if ($(this).is(':checked')) { 
	$('#fliter_issuance').append('<input type="hidden" name="gradename[]" value='+ID+' id='"grade_id_"+ID+'  />');
 }else{
	 $('#grade_id_'+ID)remove();
 } */ 
 
});



	
//https://jqueryvalidation.org/required-method/		
$(document).on("click", "#issuance_fliter", function(){

$("#fliter_issuance").validate({
	 ignore: [],
	rules: {
		gradeNameValidate: { required: true },
		from_date: { required: true },
		to_date: { required: true },
	},
messages: {
	gradeNameValidate: { required: 'Please Select Grade' },
	from_date: { required: 'Please Select From Date' },
	to_date: { required: 'Please Select To Date' }
},
submitHandler: function(form){
	$(form).ajaxSubmit({
		beforeSend: function(){ $("#ajaxloader").show(); },
		uploadProgress: function (event, position, total, percentComplete){},
		dataType: "HTML",
		success: function(res){
			console.log(res);
			$("#fliter_issuance")[0].reset();
			//$(".invalid").remove();
			$("#paddingRight20").html('');
			$("#paddingRight20").html(res);
		
		}
	});
},
errorPlacement: function (error, element) {
	error.insertAfter(element.parent());
}
});// end validate

});// end on click button


/* JS for Menu Dropdown*/
$(document).ready(function(){
    


   $('#billing_confirmation').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="position: absolute;right: 348px;top: -41px;width: 250px;"><option value="">Filter Grade</option></select>')
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
