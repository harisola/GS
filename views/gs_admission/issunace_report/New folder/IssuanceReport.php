<?php include 'header.php'; ?>
<div class="container" id="BatchListing">
    <!-- Two column layout Start -->
	<div class="row">
        <div class="col-md-12 BatchListing">
        	<div class="MaroonBorderBox">
        		<h3>Issuance Report</h3>
                <div class="inner" style="padding:20px !important;">
                	<div class="col-md-2">
                    	<span class="filterTitle">Select Grade</span>
                    	<dl class="dropdown">
                            <dt>
                            	<a href="#"><span class="hida">Select</span> <p class="multiSel" style="display:;"></p></a>
                            </dt><!-- dt -->
                            <dd>
                                <div class="mutliSelect">
                                    <ul>
                                        <li><input type="checkbox" value="All" name="All" id="All"/><label for="All">All Grades</label></li>
                                        <li><input type="checkbox" value="PN" name="PN" id="PN" /><label for="PN">PN</label></li>
                                        <li><input type="checkbox" value="N" id="N" name="PN" /><label for="N">N</label></li>
                                        <li><input type="checkbox" value="KG" name="KG" id="KG" /><label for="KG">KG</label></li>
                                        <li><input type="checkbox" value="I" name="I" id="I" /><label for="I">I</label></li>
                                        <li><input type="checkbox" value="II" name="II" id="II" /><label for="II">II</label></li>
                                        <li><input type="checkbox" value="III" name="III" id="III" /><label for="III">III</label></li>
                                        <li><input type="checkbox" value="IV" name="IV" id="IV" /><label for="IV">IV</label></li>
                                        <li><input type="checkbox" value="V" name="V" id="V" /><label for="v">V</label></li>
                                        <li><input type="checkbox" value="VI" name="VI" id="VI" /><label for="VI">VI</label></li>
                                        <li><input type="checkbox" value="VII" name="VII" id="VII" /><label for="VII">VII</label></li>
                                        <li><input type="checkbox" value="VIII" name="VIII" id="VIII" /><label for="VIII">VIII</label></li>
                                        <li><input type="checkbox" value="IX" name="IX" id="IX" /><label for="IX">IX</label></li>
                                        <li><input type="checkbox" value="X" name="X" id="X" /><label for="X">X</label></li>
                                    </ul><!-- ul -->
                                </div><!-- multiselect -->
                            </dd><!-- dd -->                          
                        </dl><!-- dl -->
                    </div><!-- col-md-2 -->
                    <div class="col-md-2">
                    	<span class="filterTitle">From</span>
                    	<input type="date" placeholder="From" />
                    </div><!-- col-md-2 -->
                    <div class="col-md-2">
                    	<span class="filterTitle">To</span>
                    	<input type="date" placeholder="To" />
                    </div><!-- col-md-2 -->
<style>
.tooltipp {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.tooltipp .tooltiptext {
    visibility: hidden;
    width: 170px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 1s;
}

.tooltipp .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

.tooltipp:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}
</style>                    
					<?php /* ?>
                    <div class="col-md-2">
                    	<span class="filterTitle">Relation</span>
                    	<select required class=" paddingLeft10 paddingRight10 " style="padding-top:6px;padding-bottom:6px;">
                          <option value="" disabled selected>Relation</option>
                          <option value="All">All</option>
                          <option value="petitioners">Petitioners</option>
                          <option value="friends">Friends</option>
                        </select>
                    </div><!-- col-md-2 -->
                    <div class="col-md-2">
                    	<span class="filterTitle">Campus</span>
                    	<select required class=" paddingLeft10 paddingRight10 " style="padding-top:6px;padding-bottom:6px;">
                          <option value="" disabled selected>Campus</option>
                          <option value="AllCampus">All</option>
                          <option value="North">North</option>
                          <option value="South">South</option>
                        </select>
                    </div><!-- col-md-2 -->
					<?php */ ?>
                    <div class="col-md-2" style="width:15%;">
                    	<input type="submit" class="greenBTN" value="Apply Filters" style="padding:14px;" />
                    </div><!-- col-md-2 -->
                </div><!-- inner -->
                <hr class="RedHR" />
                <div class="inner paddingLeft20 paddingRight20" style="padding:20px !important;">
                    <table id="AdmissionFormListingg" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                      <thead> 
                          <tr> 
                              <th width="" class="text-center"></th> 
                              <th width="" class="text-center">PN</th> 
                              <th width="" class="text-center">N</th> 
                              <th width="" class="text-center">KG</th>
                              <th width="" class="text-center">I</th>
                              <th width="" class="text-center">II</th>
                              <th width="" class="text-center">III</th>
                              <th width="" class="text-center">IV</th>
                              <th width="" class="text-center">V</th>
                              <th width="" class="text-center">VI</th>
                              <th width="" class="text-center">VII</th>
                              <th width="" class="text-center">VIII</th>
                              <th width="" class="text-center">IX</th>
                              <th width="" class="text-center">X</th>
                              <th width="" class="text-center" style="border-left:2px solid #888;">Total</th>
                          </tr>
                      </thead>
                      <tbody> 
                          <tr>
                              <td class="text-center"><strong>Sat 7 Jan</strong> to <strong>Sat 14 Jan</strong></td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>200</strong>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong>100</strong>
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>200</strong>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong>100</strong>
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>200</strong>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong>100</strong>
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>200</strong>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong>100</strong>
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>200</strong>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong>100</strong>
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>200</strong>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong>100</strong>
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>200</strong>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong>100</strong>
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>200</strong>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong>100</strong>
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>200</strong>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong>100</strong>
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>200</strong>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong>100</strong>
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>200</strong>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong>100</strong>
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>200</strong>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong>100</strong>
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>200</strong>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong>100</strong>
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>2600</strong>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong>1200</strong>
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                          </tr>
                          
                      </tbody> 
                    </table><!-- StaffListing -->
                </div><!-- inner -->
            </div><!-- MaroonBorderBox -->
        </div><!-- col-md-12 -->
    </div><!-- row -->
    <!-- Two column layout END -->
</div><!-- container -->
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
<script src="js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://vitalets.github.io/x-editable/assets/demo-mock.js"></script> 
<?php include 'footer.php'; ?>
