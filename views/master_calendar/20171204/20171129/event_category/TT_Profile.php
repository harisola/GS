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
.tabletdBorderRight {
	border-right: 1px solid #666;
}	
</style>
<!-- X editable files -->
<!-- bootstrap -->
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>  

<!-- x-editable (bootstrap version) -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'popup';     
    
    //make editable
    $('#MonIN').editable({
			type: 'time',
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
});
</script>


<!---- -->
<link id="main-style" href="/application/views/haris2/style/TTProfiles.css" rel="stylesheet" type="text/css">
<div class="container">
	<div class="row">
    	<div class="col-md-4 BrowsingList" style="">
	    	<div class="LeftListing" style="">
            	
                <div class="LeftListing_ContentSection">
                	<div class="headingArea"><h2>Staff Profiles <a href="#" class="absoluteBtn">Add new Profile</a></h2></div>
                	<table width="100%" border="1" id="TTListing" class="table table-striped table-bordered table-hover">
	                  <thead>
	                      <tr>
	                        <th class="text-center no-sort" width="">SR</th>
	                        <th class="" width="">Name</th>
                            <th class="no-sort text-center" width="">Allocations</th>
                          </tr>
	                  </thead><!-- thead -->
					  <tbody>
	                      <tr class="selected">
	                        <td class="text-center">1</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Teachers - NC</a></td>
                            <td class="text-center">22</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">2</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Lead Teachers SC</a></td>
	                        <td class="text-center">2</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">3</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Subject Heads</a></td>
	                        <td class="text-center">30</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">4</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Teachers - SC</a></td>
	                        <td class="text-center">5</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">5</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Year Tutors/Lead Teachers NC</a></td>
	                        <td class="text-center">9</td>
                          </tr>
	                      <tr class="Fence">
	                        <td class="text-center">6</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Faculty Resource  NC (Edu Tech /Sports/ Art) </a></td>
	                        <td class="text-center">10</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">7</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">VP/HM</a></td>
	                        <td class="text-center">12</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">8</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Coordinators</a></td>
	                        <td class="text-center">14</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">9</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Facilitators</a></td>
	                        <td class="text-center">15</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">10</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Year Tutors SC</a></td>
	                        <td class="text-center">52</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">11</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Faculty Resource (Edu Tech /Sports/ Discvy Centre/ Art )</a></td>
	                        <td class="text-center">20</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">12</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Librarians</a></td>
	                        <td class="text-center">10</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">13</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Generosity Female</a></td>
	                        <td class="text-center">10</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">14</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Admin Resource (library Asst/ Sci Lab Asst)</a></td>
	                        <td class="text-center">40</td>
                          </tr>
                          <tr class="selected">
	                        <td class="text-center">15</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Generosity Male</a></td>
                            <td class="text-center">18</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">16</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Admin/ Finance</a></td>
	                        <td class="text-center">53</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">17</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Admin/ SIS/Tamkeen</a></td>
	                        <td class="text-center">78</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">18</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Domestic Staff- Female</a></td>
	                        <td class="text-center">95</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">19</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Domestic Staff - Male</a></td>
	                        <td class="text-center">45</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">20</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Security Wardens</a></td>
	                        <td class="text-center">26</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">21</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Security Guards</a></td>
	                        <td class="text-center">52</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">22</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Operations</a></td>
	                        <td class="text-center">95</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">23</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Security Guards</a></td>
	                        <td class="text-center">45</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">24</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Custom</a></td>
	                        <td class="text-center">5</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center">25</td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Part Time</a></td>
	                        <td class="text-center">16</td>
                          </tr>
	                  </tbody>
	                </table><!-- ListingTable -->
	            </div><!-- LeftListing_ContentSection -->
	        </div><!-- .StudentListing -->
	    </div><!-- col-md-4 -->
	    <div class="col-md-8" style="padding-right:25px;">
	    	<div class="col-md-12 ProfileDetail">
            	<div class="headingArea"><h2>Add new Profile</h2></div>
                <div class="col-md-12 no-padding borderRight">
                	<form>
                    	<div class="col-md-6 paddingBottom20">
                        	<div class="col-md-4 text-right" style="padding-top: 5px;">
                            	TT Profile Name
                            </div><!-- col-md-4 -->
                            <div class="col-md-8 no-padding">
                            	<input type="text" placeholder="Teachers NC" />
                            </div><!-- col-md-8 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-6">
                        	<div class="col-md-4 text-right" style="padding-top: 5px;">
                            	Profile Type
                            </div><!-- col-md-4 -->
                            <div class="col-md-8 no-padding">
                            	<select required id="purpose">
                                    <option value="">Select</option>
                                    <option value="0">Standard</option>
                                    <option value="1">Custom</option>
                                    <option value="2">Part Time</option>
                                </select>
                            </div><!-- col-md-8 -->
                        </div><!-- col-md-12 -->
                        <br /><br /><br /><br />
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
                                            <td><input type="time" placeholder="" /></td>
                                            <td><input type="time" placeholder="" /></td>
                                            <td><input type="time" placeholder="" /></td>
                                            <td style="border-right: 1px solid #666;"><input type="time" placeholder="" /></td>
                                            <td><input type="time" placeholder="" /></td>
                                            <td><input type="number" placeholder="e.g. 2" /></td>
                                            <td style="border-right: 1px solid #666;"><input type="date" placeholder="" /></td>
                                            <td><input type="number" placeholder="e.g. 4.5" /></td>
                                            <td><input type="number" placeholder="e.g. 3" /></td>
                                            <td><input type="number" placeholder="e.g. 2" /></td>
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
                                            <td colspan="4" bgcolor="#f2dcdb">Standard Timings</td>
                                            <td colspan="3" bgcolor="#daeef3">Extensions</td>
                                            <td colspan="3" bgcolor="#d8e4bc">Saturdays</td>
                                        </tr>
                                      </thead>
                                      <thead>
                                        <tr>
                                            <td width="10%" bgcolor="#f2dcdb">Morning</td>
                                            <td width="10%" bgcolor="#f2dcdb">Afternoon</td>
                                            <td width="10%" bgcolor="#f2dcdb">Wed Afternoon</td>
                                            <td width="10%" bgcolor="#f2dcdb">Fri Afternoon</td>
                                            <td width="10%" bgcolor="#daeef3">Ext Time</td>
                                            <td width="10%" bgcolor="#daeef3">Ext Freq</td>
                                            <td width="10%" bgcolor="#daeef3">July Start</td>
                                            <td width="10%" bgcolor="#d8e4bc">Sat Hours</td>
                                            <td width="10%" bgcolor="#d8e4bc">Sat Off</td>
                                            <td width="10%" bgcolor="#d8e4bc">Sat Working</td>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                            <td><input type="time" placeholder="" /></td>
                                            <td><input type="time" placeholder="" /></td>
                                            <td><input type="time" placeholder="" /></td>
                                            <td><input type="time" placeholder="" /></td>
                                            <td><input type="time" placeholder="" /></td>
                                            <td><input type="number" placeholder="" /></td>
                                            <td><input type="date" placeholder="" /></td>
                                            <td><input type="number" placeholder="" /></td>
                                            <td><input type="number" placeholder="" /></td>
                                            <td><input type="number" placeholder="" /></td>
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
                        <div class="partTIMEDIV" style="display:none;">
                            <h3>Part Timer</h3>
                            <div class="CutomTimingWrapper">
                              <div class="col-md-12 paddingBottom20">
                                <table width="100%" border="0" class="ProfileTimingTable">
                                  <thead>
                                    <tr>
                                        <td width="" colspan="2" bgcolor="#b5d9e6" class="tabletdBorderRight"><strong>Mon</strong></td>
                                        <td width="" colspan="2" bgcolor="#b5d9e6" class="tabletdBorderRight"><strong>Tue</strong></td>
                                        <td width="" colspan="2" bgcolor="#b5d9e6" class="tabletdBorderRight"><strong>Wed</strong></td>
                                        <td width="" colspan="2" bgcolor="#b5d9e6" class="tabletdBorderRight"><strong>Thu</strong></td>
                                        <td width="" colspan="2" bgcolor="#b5d9e6" class="tabletdBorderRight"><strong>Fri</strong></td>
                                        <td width="" colspan="2" bgcolor="#b5d9e6"><strong>Sat</strong></td>
                                    </tr>
                                    <tr>
                                        <td width=""  class="tabletdBorderRight">In</td>
                                        <td width=""  class="tabletdBorderRight">Out</td>
                                        <td width=""  class="tabletdBorderRight">In</td>
                                        <td width=""  class="tabletdBorderRight">Out</td>
                                        <td width=""  class="tabletdBorderRight">In</td>
                                        <td width=""  class="tabletdBorderRight">Out</td>
                                        <td width=""  class="tabletdBorderRight">In</td>
                                        <td width=""  class="tabletdBorderRight">Out</td>
                                        <td width=""  class="tabletdBorderRight">In</td>
                                        <td width=""  class="tabletdBorderRight">Out</td>
                                        <td width=""  class="tabletdBorderRight">In</td>
                                        <td width="">Out</td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                        <td class="tabletdBorderRight"><a href="#" id="MonIN" data-placement="top" data-title="In time for Monday">00:00</a></td>
                                        <td class="tabletdBorderRight"><a href="#" id="MonOUT" data-placement="top" data-title="Out time for Monday">00:00</a></td>
                                        <td class="tabletdBorderRight"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday">00:00</a></td>
                                        <td class="tabletdBorderRight"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday">00:00</a></td>
                                        <td class="tabletdBorderRight"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday">00:00</a></td>
                                        <td class="tabletdBorderRight"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday">00:00</a></td>
                                        <td class="tabletdBorderRight"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday">00:00</a></td>
                                        <td class="tabletdBorderRight"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday">00:00</a></td>
                                        <td class="tabletdBorderRight"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday">00:00</a></td>
                                        <td class="tabletdBorderRight"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday">00:00</a></td>
                                        <td class="tabletdBorderRight"><a href="#" id="SatIN" data-placement="left" data-title="In time for Saturday">00:00</a></td>
                                        <td><a href="#" id="SatOUT" data-placement="left" data-title="Out time for Saturday">00:00</a></td>
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
                              </div><!-- paddingBottom20 -->
                            </div><!-- #CutomTimingWrapper-->
                        </div><!-- partTIMEDIV -->
                    </form>
                </div><!-- col-md-6-->
                
                <div class="col-md-12 borderTop text-center">
                	<input type="button" name="clear" class="grayBTN widthSmall" id="greenBTN3" value="Clear"> <input type="submit" name="submit" class="greenBTN widthSmall" id="greenBTN" value="Add new Profile">
                </div><!-- col-md-12 -->
            </div><!-- col-md-12 -->
	    </div><!-- col-md-8 -->
	</div><!-- row -->
</div><!-- container -->
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.js"></script>
<script>

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


$('#checkAll').click(function () {    
    $(':checkbox.checkItem').prop('checked', this.checked);    
 });
</script>
