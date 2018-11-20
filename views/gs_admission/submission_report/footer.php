<style>
.dropdown dd,
.dropdown dt {
  margin: 0px;
  padding: 0px;
}
#BatchListing td .boys {
	background:#c9f0f9;
	padding:5px 0;
}
#BatchListing td .girls {
	background:#ffe1ec	;
	padding:5px 0;
}
#BatchListing td {
    vertical-align: middle !important;
    padding: 0;
}
.dropdown ul {
  margin: -1px 0 0 0;
}

.dropdown dd {
  position: relative;
}

.dropdown a,
.dropdown a:visited {
  color: #888;
  text-decoration: none;
  outline: none;
  font-size: 14px;
}

.dropdown dt a {
      background-color: #ffffff;
    display: block;
    padding: 12px 20px 12px 10px;
    min-height: 18px;
    line-height: 9px;
    overflow: hidden;
    border: 1px solid #a9a9a9;
    font-weight: normal;
}

.dropdown dt a span,
.multiSel span {
  cursor: pointer;
  display: inline-block;
  padding: 0 3px 2px 0;
}

.dropdown dd ul {
    background-color: #fff;
    border: 1px solid #a9a9a9;
    color: #000;
    display: none;
    left: 0px;
    padding: 2px 15px 2px 5px;
    position: absolute;
    top: 0px;
    width: 100%;
    list-style: none;
    height: 120px;
    overflow: auto;
	z-index:9999;
}

.dropdown span.value {
  display: none;
}

.dropdown dd ul li a {
  padding: 5px;
  display: block;
}

.dropdown dd ul li a:hover {
  background-color: #fff;
}
.multiSel {
	margin:0 !important;	
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
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

$(document).bind('click', function(e) {
  var $clicked = $(e.target);
  if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
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
		//console.log(res);
		$("#fliter_issuance")[0].reset();
		$(".invalid").remove();
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

var DECStatus = jQuery('#DECStatus');
var select = this.value;
DECStatus.change(function () {
    if ($(this).val() == 'WIL') {
        $('.IfWIL').show();
    }
    else $('.IfWIL').hide();
});

DECStatus.change(function () {
    if ($(this).val() == 'OFD') {
        $('.IfOFD').show();
    }
    else $('.IfOFD').hide();
});



$(document).ready( function(){
	
// Date range
if ($('#from_date').length) {
	$('#from_date').datepicker({
		//changeMonth: true,
        //changeYear: true,
    	//yearRange: '2000:'+(new Date).getFullYear(),
		dateFormat: 'yy-mm-dd',
		prevText: '<i class="fa fa-chevron-left"></i>',
		nextText: '<i class="fa fa-chevron-right"></i>',
		//onSelect: function(date) {},
	});	
}

if ($('#to_date').length) {
	$('#to_date').datepicker({
		dateFormat: 'yy-mm-dd',
		prevText: '<i class="fa fa-chevron-left"></i>',
		nextText: '<i class="fa fa-chevron-right"></i>',
	});	
}





});



$(document).ready(function() {
    $('#data_table').DataTable();
} );
</script>

<?php /* ?>
<script src="<?=base_url();?>components/gs_theme/js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://vitalets.github.io/x-editable/assets/demo-mock.js"></script> 
<?php */ ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/custom.js"></script>




