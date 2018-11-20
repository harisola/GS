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

  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
    title = $(this).val() + ",";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSel').append(html);
    $(".hida").hide();
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
</script>

<script src="<?=base_url();?>components/gs_theme/js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://vitalets.github.io/x-editable/assets/demo-mock.js"></script> 

