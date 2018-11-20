<style>
.container {
	width: 100% !important;
}

.content-wrapper {
    min-height: 860px !important;
	max-width: 1700px !important;
    margin: 0 auto;
}
div.dataTables_filter input {
	max-width:140px;	
}
.table > thead > tr > th, 
.table > tbody > tr > th, 
.table > tfoot > tr > th, 
.table > thead > tr > td, 
.table > tbody > tr > td, 
.table > tfoot > tr > td {
    padding: 4px 4px;
}
.xedit span.grayish {
    color: #888;
    float: left;
    width: 140px;
}
.widthSmall {
	width:200px !important;
	font-size:16px !important;	
}
.absoluteBtn {
    position: absolute;
    background: #1bbc9b;
    color: #fff;
    font-size: 16px;
    right: 0px;
    padding: 10px 15px;
    top: 0px;
}
.absoluteBtn:hover {
	color:#000;
}
.headingArea {
	position:relative;	
}
/* 21st March 2017 Added */
.grayedout {
	color:#adaaaa;
}
.ProfileTimingTable {
	    border: 1px solid #666;
}
.ProfileTimingTable thead {
	
}
.ProfileTimingTable thead tr {
	    background: #eaeaea;
    height: 34px;
	border-top:1px solid #666;
}
.ProfileTimingTable thead tr td {
	text-align:center;
	color:#000;
}
.ProfileTimingTable tbody {
	
}
.ProfileTimingTable tbody tr {
	    height: 54px;
    border-bottom: 1px solid #666;
}
.ProfileTimingTable tbody tr:last-child {
	/* border-bottom:0 none;	*/
}
.ProfileTimingTable tbody tr:first-child {
	border-top:1px solid #666;	
}
.ProfileTimingTable tbody tr td {
	text-align:center;
}

.ProfileTimingTable tbody tr td input {
	width:90% !important;	
}
/* */
.StandTime tbody tr td:first-child {
	background:none;
	border:0 none;	
}
.editable.editable-click {
    font-size: 14px;
    color: #000;
    border-bottom: dashed 1px #000000;
}
.popover .popover-title {
    font-size: 16px;
    color: #333;
    border-bottom: 1px solid #ccc;
    padding: 10px;
    font-weight: normal;
    float: left;
    width: 100%;
    margin: 0 0px 17px;
}
.filterDiv {
    float: left;
    width: 100%;
    background: #ececec;
    border-bottom: 2px solid #a5a5a5;
    padding: 15px 0;
}
.ProfileTimingTablePT tr td:first-child {
    background: #b5d9e6;
    color: #000;
}
/* */
.multiselect-container {
  box-shadow: 0 3px 12px rgba(0,0,0,.175);
  padding: 10px 0;
  margin: 0;
  width:100%;
}
.multiselect-container .checkbox {
  margin: 0;
}
.multiselect-container li {
  margin: 0;
  padding: 0;
  line-height: 0;
}
.multiselect-container li a {
  line-height: 25px;
  margin: 0;
  padding:0 10px;
}
button.multiselect.dropdown-toggle.btn {
	text-align:left;	
}
b.caret {
    float: right;
    margin-top: 8px;	
}
.filterHR {
    border-top: 1px solid #ccc;
    margin-bottom: 0;
}
input[type="button"].greenBTNFilter, input[type="submit"].greenBTNFilter {
    background: #1bbc9b;
    color: #fff;
    border: 1px solid #169d81;
    width: 100%;
    padding: 5px;
    font-size: 14px;
    margin-top: 10px;
}
.bBottomD td {
	border-bottom:1px solid #888 !important;	
}

.loading{
 display: none;
 position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background:url('<?php echo base_url("components/image/ajax-loader2.gif") ?>') 50% 50% no-repeat rgb(249,249,249);
}

</style>
<!-- X editable files -->
<!-- bootstrap -->
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>  

<!-- x-editable (bootstrap version) -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>
<!-- <script type="text/javascript">
$(document).ready(function() {
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'popup';     
    
    //make username editable
    $('#MonIN').editable({
			type: 'time'
		});
	$('#MonOUT').editable({
			type: 'time'
		});
	$('#TueIN').editable({
			type: 'time'
		});
	$('#TueOUT').editable({
			type: 'time'
		});
	$('#WedIN').editable({
			type: 'time'
		});
	$('#WedOUT').editable({
			type: 'time'
		});
	$('#ThuIN').editable({
			type: 'time'
		});
	$('#ThuOUT').editable({
			type: 'time'
		});
	$('#FriIN').editable({
			type: 'time'
		});
	$('#FriOUT').editable({
			type: 'time'
		});
	$('#SatIN').editable({
			type: 'time'
		});
	$('#SatOUT').editable({
			type: 'time'
		});
    
    //make status editable
    $('#status').editable({
        type: 'select',
        title: 'Select status',
        placement: 'right',
        value: 2,
        source: [
            {value: 1, text: 'status 1'},
            {value: 2, text: 'status 2'},
            {value: 3, text: 'status 3'}
        ]
        /*
        //uncomment these lines to send data on server
        ,pk: 1
        ,url: '/post'
        */
    });
});
</script> -->
<script>
$(document).ready(function(){
    $("#Filter").click(function(){
        $(".filterDiv").toggle();
    });

    $('#TTListing').dataTable({
      "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
    "bLengthChange": false,
    "bInfo" : false,
    "aLengthMenu": [[25, 50, 70, -1], [25, 50, 70, "All"]],
    "iDisplayLength": 50
  });



});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="/application/views/tif_a/profile_allocation_staff/js/multiSelect.js"></script>

<link id="main-style" href="/application/views/tif_a/profile_allocation_staff/style/TTProfiles.css" rel="stylesheet" type="text/css">
<div class="container">
	<div class="row">
    	<div class="col-md-4 BrowsingList" style="">
	    	<div class="LeftListing" style="">
                <div class="LeftListing_ContentSection">
                	<div class="headingArea"><h2>Staff List <a href="#" class="absoluteBtn" id="Filter">Allocate</a></h2></div>
                    <div class="filterDiv" style="display:none;">
                    	<div class="row" style="margin:0 !important;">		
                            <div class="col-md-12">
                            	<label>Profile</label><br />
                                <select id="profile_select">
                                <option value="0" selected disabled>Allocate Profile</option>          
                                <?php foreach($profile_description as $profile) { ?>
                                  <option value="<?php echo $profile->id ?>" data-id="<?php echo $profile->profile_type_id ?>"><?php echo $profile->name  ?></option>
                                <?php } ?>
                                </select> 
                            </div>         
                        </div><!-- row -->
                    	<hr class="filterHR" />
                        <div class="row">
                        	<div class="col-md-4 col-md-offset-4">
                            	<input type="submit" class="greenBTNFilter" value="Allocate Profile" id="allocate_profile">
                            </div><!-- col-md-4 -->
                        </div><!-- row -->
                    </div><!-- filterDiv -->
                  <div class="replace_table">
                	<table width="100%" border="1" id="TTListing" class="table table-striped table-bordered table-hover">
	                  <thead>
	                      <tr>
	                        <th class="text-center no-sort" width=""><input type="checkbox" id="checkAll"></th>
	                        <th class="" width="">Staff Name<br /><small>Dept / Designation</small></th>
                            <th class="text-left" width="">Name Code<br /><small>GT ID</small></th>
                            <th class="text-left" width="">Profile</th>
                          </tr>
	                  </thead><!-- thead -->
					   <tbody>
                    
                      <?php foreach($staff as $staff) { ?>

	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="staffCheck" value="<?php echo $staff->staff_id ?>"></td>
	                        <td><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top"  data-pin-nopin="true" class="anchorCol select-staff" data-id="<?php echo $staff->staff_id ?>" data-profile="<?php echo $staff->profile_id ?>" data-profile_type="<?php echo $staff->profile_type_id ?>" data-staff_name="<?php echo $staff->abridged_name ?>"><?php echo $staff->abridged_name ?></a><br /><small><?php echo $staff->designation ?>/ <?php echo $staff->department ?></small></td>
                            <td class="text-left"><?php echo $staff->name_code ?><br /><small><?php echo $staff->gt_id ?></small></td>
                            <td class="text-left"><?php echo $staff->profile_name ?></td>
                        </tr>
                      <?php } ?>
	                  </tbody>
	                </table><!-- ListingTable -->
                  </div>
	            </div><!-- LeftListing_ContentSection -->
	        </div><!-- .StudentListing -->
	    </div><!-- col-md-4 -->
	    <div class="col-md-8" style="padding-right:25px;">
	    	<div class="col-md-12 ProfileDetail">
            	<div class="headingArea">
            	  <h2>Profile  <strong>Detail</strong></h2>
            	</div>
                <div class="col-md-12 no-padding borderRight">
                	<form>
                        <div class="col-md-6">
                        	<div class="col-md-4 text-right" style="padding-top: 5px;">
                            	Select Profile
                          </div><!-- col-md-4 -->
                            <div class="col-md-8 no-padding">
                            	<select required id="purpose">
                                    <option value="">Select</option>
                                    <?php foreach($profile_description as $profile) { ?>
                                        <option value="<?php echo $profile->id ?>" data-id="<?php echo $profile->profile_type_id ?>"><?php echo $profile->name ?></option>
                                    <?php } ?>

                                </select>
                            </div><!-- col-md-8 -->
                        </div><!-- col-md-12 -->
                        <br /><br /><br /><br />
                        <div id="get_profile"></div>
                        <?php /* ?>
                        <div class="standardDIV" style="display:none;">
                            <h3>Standard Timings</h3>
                            <div id="StandardTimingWrapper">
                              <div class="col-md-12 paddingBottom20">
                                    <table width="100%" border="0" class="ProfileTimingTable StandTime">
                                      <thead>
                                        <tr>
                                            <td colspan="4" width="34%" bgcolor="#f2dcdb" style="border-right: 1px solid #666;"><strong>Standard Timings</strong></td>
                                            <td colspan="3" width="33%" bgcolor="#daeef3" style="border-right: 1px solid #666;"><strong>Extensions</strong></td>
                                            <td colspan="3" width="33%" bgcolor="#d8e4bc"><strong>Saturdays</strong></td>
                                        </tr>
                                      </thead>
                                      <thead>
                                        <tr>
                                            <td width="10%" bgcolor="#f2dcdb">Morning</td>
                                            <td width="10%" bgcolor="#f2dcdb">Afternoon</td>
                                            <td width="10%" bgcolor="#f2dcdb">Wed</td>
                                            <td width="10%" bgcolor="#f2dcdb" style="border-right: 1px solid #666;">Fri</td>
                                            <td width="10%" bgcolor="#daeef3">Time</td>
                                            <td width="10%" bgcolor="#daeef3">Freq</td>
                                            <td width="10%" bgcolor="#daeef3" style="border-right: 1px solid #666;">July Start</td>
                                            <td width="10%" bgcolor="#d8e4bc">Hours</td>
                                            <td width="10%" bgcolor="#d8e4bc">Off</td>
                                            <td width="10%" bgcolor="#d8e4bc">Working</td>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                            <td><input type="time" placeholder="" value="07:30" /></td>
                                            <td><input type="time" placeholder="" value="14:00" /></td>
                                            <td><input type="time" placeholder="" value="15:00"/></td>
                                            <td style="border-right: 1px solid #666;"><input type="time" placeholder="" value="13:00" /></td>
                                            <td><input type="time" placeholder="" value="15:30" /></td>
                                            <td><input type="number" placeholder="e.g. 2" value="2" /></td>
                                            <td style="border-right: 1px solid #666;"><input type="date" placeholder="" value="07/13/2017" /></td>
                                            <td><input type="number" placeholder="e.g. 4.5" value="4.5" /></td>
                                            <td><input type="number" placeholder="e.g. 3" value="3" /></td>
                                            <td><input type="number" placeholder="e.g. 2" value="" /></td>
                                          </tr>
                                      </tbody>
                                    </table>
                                    <hr />
                                    <table width="100%" border="0" class="ProfileTimingTable">
                                            <thead>
                                            <tr>
                                                <td width="33%" colspan="3" bgcolor=""><strong>Calculations</strong></td>
                                            </tr>
                                          </thead>
                                          <thead>
                                            <tr>
                                                <td width="" style="border-right: 1px solid #666;" >M-T Hours</td>
                                                <td width="" style="border-right: 1px solid #666;" >Fri Hours</td>
                                                <td width="">Avg Weekly Hours</td>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                                <td><input type="text" disabled="disabled" value="6:00" /></td>
                                                <td><input type="text" disabled="disabled" value="5:30" /></td>
                                                <td><input type="text" disabled="disabled" value="30:30" /></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                </div>
                            </div><!-- #StandardTimingWrapper -->
                       	</div><!-- standardDIV-->
                        
                        <div class="customDIV"  style="display:none;">
                            <h3>Custom Timings</h3>
                            <div id="StandardTimingWrapper">
                              <div class="col-md-12 paddingBottom20">
                                    <table width="100%" border="0" class="ProfileTimingTable StandTime">
                                      <thead>
                                        <tr>
                                            <td colspan="4" width="34%" bgcolor="#f2dcdb" style="border-right: 1px solid #666;"><strong>Standard Timings</strong></td>
                                            <td colspan="3" width="33%" bgcolor="#daeef3" style="border-right: 1px solid #666;"><strong>Extensions</strong></td>
                                            <td colspan="3" width="33%" bgcolor="#d8e4bc"><strong>Saturdays</strong></td>
                                        </tr>
                                      </thead>
                                      <thead>
                                        <tr>
                                            <td width="10%" bgcolor="#f2dcdb">Morning</td>
                                            <td width="10%" bgcolor="#f2dcdb">Afternoon</td>
                                            <td width="10%" bgcolor="#f2dcdb">Wed</td>
                                            <td width="10%" bgcolor="#f2dcdb" style="border-right: 1px solid #666;">Fri</td>
                                            <td width="10%" bgcolor="#daeef3">Time</td>
                                            <td width="10%" bgcolor="#daeef3">Freq</td>
                                            <td width="10%" bgcolor="#daeef3" style="border-right: 1px solid #666;">July Start</td>
                                            <td width="10%" bgcolor="#d8e4bc">Hours</td>
                                            <td width="10%" bgcolor="#d8e4bc">Off</td>
                                            <td width="10%" bgcolor="#d8e4bc">Working</td>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                            <td><input type="time" placeholder="" value="07:30" /></td>
                                            <td><input type="time" placeholder="" value="14:00" /></td>
                                            <td><input type="time" placeholder="" value="15:00"/></td>
                                            <td style="border-right: 1px solid #666;"><input type="time" placeholder="" value="13:00" /></td>
                                            <td><input type="time" placeholder="" value="15:30" /></td>
                                            <td><input type="number" placeholder="e.g. 2" value="2" /></td>
                                            <td style="border-right: 1px solid #666;"><input type="date" placeholder="" value="07/13/2017" /></td>
                                            <td><input type="number" placeholder="e.g. 4.5" value="4.5" /></td>
                                            <td><input type="number" placeholder="e.g. 3" value="3" /></td>
                                            <td><input type="number" placeholder="e.g. 2" value="" /></td>
                                          </tr>
                                      </tbody>
                                    </table>
                                    <hr />
                                    <table width="100%" border="0" class="ProfileTimingTable">
                                            <thead>
                                            <tr>
                                                <td width="33%" colspan="3" bgcolor=""><strong>Calculations</strong></td>
                                            </tr>
                                          </thead>
                                          <thead>
                                            <tr>
                                                <td width="" style="border-right: 1px solid #666;" >M-T Hours</td>
                                                <td width="" style="border-right: 1px solid #666;" >Fri Hours</td>
                                                <td width="">Avg Weekly Hours</td>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                                <td><input type="text" disabled="disabled" value="6:00" /></td>
                                                <td><input type="text" disabled="disabled" value="5:30" /></td>
                                                <td><input type="text" disabled="disabled" value="30:30" /></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                </div>
                            </div><!-- #StandardTimingWrapper -->
                       	</div><!-- customDIV-->
                        <?php */ ?>

                        <?php /* ?>
                        <div class="partTIMEDIV" style="display:none;">
                            <h3>Part Timer</h3>
                            <div class="CutomTimingWrapper">
                              <div class="col-md-12 paddingBottom20">
                                    <table width="100%" border="0" class="ProfileTimingTable ProfileTimingTablePT">
                                        <thead>
                                            <tr>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>&nbsp;</strong></td>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Mon</strong></td>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Tue</strong></td>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Wed</strong></td>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Thu</strong></td>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Fri</strong></td>
                                                <td width="" colspan="2" bgcolor="#b5d9e6"><strong>Sat</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;"><strong>In</strong></td>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="MonIN" data-placement="top" data-title="In time for Monday">00:00</a></td>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday">00:00</a></td>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday">00:00</a></td>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday">00:00</a></td>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday">00:00</a></td>
                                                <td width="" colspan="2"><a href="#" id="SatIN" data-placement="top" data-title="In time for Saturday">00:00</a></td>
                                            </tr>
                                            <tr>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;"><strong>Out</strong></td>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="MonOUT" data-placement="top" data-title="Out time for Monday">00:00</a></td>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday">00:00</a></td>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday">00:00</a></td>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday">00:00</a></td>
                                                <td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday">00:00</a></td>
                                                <td width="" colspan="2"><a href="#" id="SatOUT" data-placement="top" data-title="Out time for Saturday">00:00</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
        							<hr />
                                    <table width="100%" border="0" class="ProfileTimingTable">
                                            <thead>
                                            <tr>
                                                <td width="33%" colspan="3" bgcolor=""><strong>Calculations</strong></td>
                                            </tr>
                                          </thead>
                                          <thead>
                                            <tr>
                                                <td width="" style="border-right: 1px solid #666;" >M-T Hours</td>
                                                <td width="" style="border-right: 1px solid #666;" >Fri Hours</td>
                                                <td width="">Avg Weekly Hours</td>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                                <td><input type="text" disabled="disabled" value="6:00" /></td>
                                                <td><input type="text" disabled="disabled" value="5:30" /></td>
                                                <td><input type="text" disabled="disabled" value="30:30" /></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                </div>
                            </div><!-- #CutomTimingWrapper-->
                        </div><!-- partTIMEDIV -->

                        <?php */ ?>
                        
                        
                        <?php /* ?>
                        <h3>Saturdays</h3>
                        <div class="col-md-12 paddingBottom20">
                            <div class="col-md-4 no-paddingLeft" >
                                <input type="text" placeholder="" />
                            </div><!-- col-md-3 -->
                            <div class="col-md-4 no-paddingLeft">
                                <input type="text" placeholder="" />
                            </div><!-- col-md-3 -->
                            <div class="col-md-4 no-paddingLeft">
                                <input type="text" placeholder="" />
                            </div><!-- col-md-3 -->
                        </div><!-- col-md-12 -->
                        <h3>Extension per week &nbsp;&nbsp;<input class="ExtensionInProfile" type="checkbox" name="ExtensionInProfile" value="1" onchange="valueChanged()" style="margin-top:4px;"/></h3>
                        <div class="col-md-12 paddingBottom20 ExtensionYes" style="display:none;">
                            <div class="col-md-4 no-paddingLeft" >
                                <div class="col-md-6" style="padding-left:0;padding-right:0;"><input style="border-right: 0 none !important;border: 1px solid #a9a9a9;padding: 6px;" type="number" class="col-md-6" min="0" max="12" placeholder="Hours"></div>
                                <div class="col-md-6" style="padding-left:0;padding-right:0;"><input type="number" class="col-md-6" min="0" max="60" placeholder="min"></div>
                            </div><!-- col-md-3 -->
                            <div class="col-md-4 no-paddingLeft">
                              <input type="number" placeholder="Extension Frequency" />
                            </div><!-- col-md-3 -->
                            <div class="col-md-4 no-paddingLeft">
                            	<input placeholder="July Start" type="text" onfocus="(this.type='date')" > 
                            </div><!-- col-md-3 -->
                        </div><!-- col-md-12 -->
						<?php */ ?>
                    </form>
                </div><!-- col-md-6-->
                
                <?php /* ?>
                <div class="col-md-6">
                	<h3 class="secTitle">Select Staff for this Profile</h3>
                	<table width="100%" border="1" id="StaffListHere" class="table table-striped table-bordered table-hover">
	                  <thead>
	                      <tr>
	                        <th class="text-center no-sort" width=""><input type="checkbox" value="" id="checkAll"></th>
	                        <th class="" width="">Name</th>
                            <th class="text-center" width="">Department</th>
                            <th class="text-center" width="">Profile</th>
                          </tr>
	                  </thead><!-- thead -->
					  <tbody>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Aalia Begum</strong><br /><small>HR Officer</small></td>
                            <td class="text-center">Senior Section</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Aamir Hussain Khan</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Operations & Housekeeping	</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Aamna Mushtaq</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Starter Section</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="grayedout">
	                        <td class="text-center"><input disabled="disabled" type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Aarzo Fatima</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Operations & Housekeeping	</td>
                            <td class="text-center">Generosity</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Aasima Sheikh</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Middle Section	</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="Fence">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Aayesha Khanum</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Junior Section</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Abbas Fazal Masih</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Operations & Housekeeping</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Abdul Aziz</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Operations & Housekeeping</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Abdul Basit</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Human Resources</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Abdul Ghaffar</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Human Resources</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Abdul Ghafoor</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Operations & Housekeeping</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="grayedout">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value="" disabled="disabled" ></td>
	                        <td><strong>Abdul Jabbar</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Starter Section</td>
                            <td class="text-center">Generosity</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Abdul Kalam</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Operations & Housekeeping</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Abdul Khaliq Patel</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Starter Section</td>
                            <td class="text-center">-</td>
                          </tr>
                          <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Abdul Malik</strong><br /><small>HR Officer</small></td>
                            <td class="text-center">Human Resources</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Abdul Naeem</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Senior Section</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Abdul Rasheed</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Human Resources</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Abdul Tawab</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Operations & Housekeeping</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="grayedout">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value="" disabled="disabled" ></td>
	                        <td><strong>Abdul Waheed</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Starter Section</td>
                            <td class="text-center">Generosity</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Abdul Waris</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Senior Section</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Abdullah Zubair</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Operations & Housekeeping</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Adeela Zeeshan</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Operations & Housekeeping</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Adil Aqeel</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Operations & Housekeeping</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Adnan</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Operations & Housekeeping</td>
                            <td class="text-center">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Adnan Masih</strong><br /><small>HR Officer</small></td>
	                        <td class="text-center">Senior Section</td>
                            <td class="text-center">-</td>
                          </tr>
	                  </tbody>
	                </table><!-- ListingTable -->
                </div><!-- col-md-6-->
				<?php */ ?>

                <!-- BUTTON -->
                <?php /*
                <div class="col-md-12 borderTop text-center">
                	<input type="button" name="clear" class="grayBTN widthSmall" id="greenBTN3" value="Clear"> <input type="submit" name="submit" class="greenBTN widthSmall" id="greenBTN" value="Allocate Profile">
                </div><!-- col-md-12 -->
                <?php */ ?>
            </div><!-- col-md-12 -->
	    </div><!-- col-md-8 -->
	</div><!-- row -->
</div><!-- container -->
<div class="loading">
</div>
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.js"></script>
<script>
 $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
 
$(document).ready(function(){
    $('#purpose').on('change', function() {
      if ( this.value == '')
      {
        $(".standardDIV").hide();
		$(".customDIV").hide();
		$(".partTIMEDIV").hide();
      }
	} );
	$('#purpose').on('change', function() {
      if ( this.value == '0')
      {
        $(".standardDIV").show();
		$(".customDIV").hide();
		$(".partTIMEDIV").hide();
      }
	});
	$('#purpose').on('change', function() {
      if ( this.value == '1')
      {
        $(".standardDIV").hide();
    		$(".customDIV").show();
    		$(".partTIMEDIV").hide();
      }
      });
	$('#purpose').on('change', function() {
	  if ( this.value == '2')
      {
        $(".standardDIV").hide();
    		$(".customDIV").hide();
    		$(".partTIMEDIV").show();
      }
    });


});

function valueChanged()
{
    if($('.ProfileExpiry').is(":checked"))   
        $(".ProfileExpiryYes").show();
    else
        $(".ProfileExpiryYes").hide();
	if($('.ExtensionInProfile').is(":checked"))   
        $(".ExtensionYes").show();
    else
        $(".ExtensionYes").hide();

}
</script>
