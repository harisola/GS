<style>
.dtable{display:none;}
.dtable_custom_controls { position: absolute;z-index: 50;margin-left: 150px;margin-top:1px}
.dtable_custom_controls 
.dataTables_length {width:auto;float:none}
table {
	font-size:12px;	
}
table tr td,
table tr th {
	padding:2px;
}
.text-right {
	float:right;	
}
.text-left {
	float:left;	
}
select {
    border: 0 none;
    padding: 0;
}
.withBor {
	padding:8px;
	border:1px solid #888;	
}
.width60 {
	width:60px;
}
.width50 {
	width:50px;
}
.width40 {
	width:40px;
}
.width100 {
	max-width:100px;	
}
.annotationHead {
	background:#e6e6e6;
}	
.annotationHead td {
		
}
thead.annotationHead th {
    border-right: 1px solid #888 !important;
    border-bottom: 1px solid #888 !important;
    border-top: 1px solid #888 !important;
    border-left: 1px solid #888 !important;
}
.nosorter::after,
.nosorter::before {	
	display:none !important;
}

table.dataTable thead th, table.dataTable thead td {
    padding: 8px 2px;
    border-bottom: 1px solid #111;
}
.absoluteDiv3 {
    position: absolute;
    right: 36px;
    width: 540px;
    top: 62px;
}
.absoluteDiv3 dl {
	margin-right:10px;	
}
#BatchListing td {
    padding: 9px;
}
.dropdown ul,
.dropdownG ul {
  margin: -1px 0 0 0;
}

.dropdown dd,
.dropdownG dd {
  position: relative;
}

.dropdown a,
.dropdown a:visited,
.dropdownG a,
.dropdownG a:visited {
  color: #888;
  text-decoration: none;
  outline: none;
  font-size: 14px;
}

.dropdown dt a,
.dropdownG dt a {
    background-color: #ffffff;
    display: block;
    padding: 18px 10px 16px 10px !important;
    min-height: 12px;
    line-height: 0px;
    overflow: hidden;
    border: 1px solid #a9a9a9;
    font-weight: normal;
}

.dropdown dt a span,
.multiSel span,
.dropdownG dt a span,
.multiSelG span {
  cursor: pointer;
  display: inline-block;
  padding: 0 3px 2px 0;
}

.dropdown dd ul,
.dropdownG dd ul {
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

.dropdown span.value,
.dropdownG span.value {
  display: none;
}

.dropdown dd ul li a,
.dropdownG dd ul li a {
  padding: 5px;
  display: block;
}

.dropdown dd ul li a:hover,
.dropdownG dd ul li a:hover {
  background-color: #fff;
}
.multiSel,
.multiSelG {
	margin:0 !important;	
}
</style>
<script>
$('#All').click(function (e) {
    $(this).closest('.mutliSelect').find('li input:checkbox').prop('checked', this.checked);
});

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


/* FOr Gender Filter */
$('#AllG').click(function (e) {
    $(this).closest('.mutliSelectG').find('li input:checkbox').prop('checked', this.checked);
});

$(".dropdownG dt a").on('click', function() {
  $(".dropdownG dd ul").slideToggle('fast');
});

$(".dropdownG dd ul li a").on('click', function() {
  $(".dropdownG dd ul").hide();
});

function getSelectedValue(id) {
  return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
  var $clicked = $(e.target);
  if (!$clicked.parents().hasClass("dropdownG")) $(".dropdownG dd ul").hide();
});

$('.mutliSelectG input[type="checkbox"]').on('click', function() {

  var title = $(this).closest('.mutliSelectG').find('input[type="checkbox"]').val(),
    title = $(this).val() + ",";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSelG').append(html);
    $(".hidaG").hide();
	
	
	

	
	
	
  } 
  else {	  
	$('span[title="' + title + '"]').remove();
	var ret = $(".hidaG");
	$(".hidaG").hide();
	$('.dropdownG dt a').append(ret);
	  if (!$(this).is(':checked')) {
		  $(".hidaG").html('');
		  $(".hidaG").show();
	  }
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
	
	
	/***************************************************/
    // Ajax here for refreshing Batch of selected Grade
    /***************************************************/
    //var selectedGrades = $('.someElement').val();
	
	//var selectedGrades = $("input[name='gradename[]']").val();
	var selectedGrades = $('.multiSel').text();

   $.ajax({
        type:"POST",
        cache:false,
        data:{gradeID:selectedGrades},
        url:"<?php echo base_url(); ?>index.php/gs_admission/batch_sheet/edit2",
		dataType:"HTML",
        success:function(res){
			$('#BiGSelectBox').html('');
            $('#BiGSelectBox').html(res);
			//console.log(e)
        }
    });
    /***************************************************/
	
	
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
		$("#AjaxResponseContainer").html('');
		$("#AjaxResponseContainer").html(res);
		$("#ajaxloader").hide();
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

/*
$(document).ready(function(){
	  

$('#batch_sheet').DataTable( {
	initComplete: function () {
		this.api().columns().every( function () {
			var column = this;
			var select = $('<select style=" position: absolute;right: 935px;top: 102px;width: 87px;"><option value="">Gender</option></select>')
			
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
*/
$(document).ready(function() {


	
var table =  $('#batch_sheet').DataTable({  "bLengthChange": false,
	  "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
  	"aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
    "iDisplayLength": 20
	});

var assNC = $("#ass_name_code");
var ASTDateOn = $("#AST_Date_On");
$bool = true;
var d_array=[];
var ass_n_c=[];
table.column(6).data().unique().sort().each( function ( d, j ) {
	var dt = d.split("simple_form_assessment_date");
	   var dt2 = dt[1].split('</div><div class="text-right col-md-4 ast_name_code">')
		var tting = dt2[0].toString();
		var assDate =  tting.slice(2); 
		if( (assDate != "") ){
			d_array.push( assDate );	
		}
	
    } );
var unique2 = d_array.filter(function(item, i, ar){ return ar.indexOf(item) === i; });
$.each(unique2, function(i, el){ 
ASTDateOn.append( '<option value="'+el+'">'+el+'</option>' )
});



	
table.column(6).data().unique().sort().each( function ( d, j ) {
	var sp = d.split("ast_name_code");
	var ss = sp[1].split("</div>")
	var lenght = ss.length;
	//var lastFive = ss.substr( 1 ); // => "Tabs1"
	var testing =ss.toString();
	var sl =  testing.slice(2); //Outputs: Tabs1
	var sl = sl.replace(',', '');
	//var sl2 = sl.replace(/\|/g,'');
	//alert(sl)
	 if( (sl != "") ){
		 ass_n_c.push( sl );
		
	   }
	} );
	
var unique3 = ass_n_c.filter(function(item, i, ar){ return ar.indexOf(item) === i; });
$.each(unique3, function(i, el){ 
assNC.append( '<option value="'+el+'">'+el+'</option>' )
});


var ASTDC = $("#ass_decission_name_code");
var ass_d_n_c = [];
table.column(7).data().unique().sort().each( function ( d, j ) {
  var dt = d.split("form_assessment_decision");
  
  var ss = dt[1].split("</span>")
	var lenght = ss.length;
	var testing =ss.toString();
	var sl =  testing.slice(2); //Outputs: Tabs1
	var sl = sl.replace(',', '');
	if( (sl != "") ){
	ass_d_n_c.push( sl );
	}

} );
var unique4 = ass_d_n_c.filter(function(item, i, ar){ return ar.indexOf(item) === i; });
$.each(unique4, function(i, el){ 
ASTDC.append( '<option value="'+el+'">'+el+'</option>' )
});

	
var ASTDateOn2 = $("#discussion_date");
var d_array2=[];
table.column(8).data().unique().sort().each( function ( d, j ) {
	var dt = d.split("dis_done_on");
	//alert(dt[1])
	  var dt2 = dt[1].split('</div><div class="text-right col-md-4 dis_name_code">')
		var tting = dt2[0].toString();
		var assDate2 =  tting.slice(2); 
		if( (assDate2 != "") ){
			d_array2.push( assDate2 );	
		}
	
    } );
var unique2 = d_array2.filter(function(item, i, ar){ return ar.indexOf(item) === i; });
$.each(unique2, function(i, el){ 
ASTDateOn2.append( '<option value="'+el+'">'+el+'</option>' )
});




var ASTDC2 = $("#discussion_name_code");
var ass_d_n_c2 = [];
table.column(8).data().unique().sort().each( function ( d, j ) {
  var dt = d.split("dis_name_code");
 
  var ss = dt[1].split("</div>")
 
	var lenght = ss.length;
	var testing =ss.toString();
	var sl =  testing.slice(2); //Outputs: Tabs1
	 
	var sl = sl.replace(',', '');
	if( (sl != "") ){
	ass_d_n_c2.push( sl );
	}

} );
var unique5 = ass_d_n_c2.filter(function(item, i, ar){ return ar.indexOf(item) === i; });
$.each(unique5, function(i, el){ 
ASTDC2.append( '<option value="'+el+'">'+el+'</option>' )
});





var ASTDC3 = $("#out_comeFinalResult");
var ass_d_n_c3 = [];
table.column(12).data().unique().sort().each( function ( d, j ) {
  var dt = d.split("form_discussion_decision");
 
  var ss = dt[1].split('</span><br><span class="text-right">')
  
	var testing =ss[0].toString();
	var sl =  testing.slice(2); //Outputs: Tabs1
	var sl = sl.replace(',', '');
	
	if( (sl != "") ){
	ass_d_n_c3.push( sl );
	}

} );
var unique4 = ass_d_n_c3.filter(function(item, i, ar){ return ar.indexOf(item) === i; });
$.each(unique4, function(i, el){ 
ASTDC3.append( '<option value="'+el+'">'+el+'</option>' )
});




$(document).on("change", "#firstDropdownId", function(){
var value = $(this).val();
console.log(value);
table.columns(4).search(value).draw();
} );

$(document).on("change", "#siblingDropdownId", function(){
var value = $(this).val();
console.log(value);
table.columns(5).search(value).draw();
} );

$(document).on("change", "#ass_name_code", function(){
var value = $(this).val();
table.columns(6).search(value).draw();
} );

$(document).on("change", "#AST_Date_On", function(){
var value = $(this).val();
table.columns(6).search(value).draw();
} );

$(document).on("change", "#ass_d_result", function(){
var value = $(this).val();
table.columns(7).search(value).draw();
} );

$(document).on("change", "#ass_decission_name_code", function(){
var value = $(this).val();
table.columns(7).search(value).draw();
} );


$(document).on("change", "#discussion_date", function(){
var value = $(this).val();
table.columns(8).search(value).draw();
} );


$(document).on("change", "#discussion_name_code", function(){
var value = $(this).val();
table.columns(8).search(value).draw();
} );


$(document).on("change", "#discussion_result", function(){
var value = $(this).val();
table.columns(9).search(value).draw();
} );


$(document).on("change", "#discussion_decission", function(){
var value = $(this).val();
table.columns(9).search(value).draw();
} );



$(document).on("change", "#out_comeFinalResult", function(){
var value = $(this).val();
table.columns(12).search(value).draw();
} );


} );

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

