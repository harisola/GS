<style>
.container {
	width: 100% !important;
}
.BrowsingList {
    border-right: 2px dashed #888;
	padding-left:25px;
    width: 40%;
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
/* NEW CSS ADDED ON 13th March 2017 */
.border-right {
    border-right: 1px solid #ccc;
}
.paddingTop5 {
	padding-top:5px;	
}
.col-md-12.no-padding {
	padding-bottom:10px !important;	
}
input[type="color"] {
    height: 30px;
}
input[type=date] {
    line-height: 18px;
}
input[type=checkbox] {
    display:inline-block;
}
#BadgeAllocation_wrapper .row .col-xs-6:last-child, #BadgeAllocation_wrapper .row .col-xs-6:last-child,
#BadgeList_wrapper .row .col-xs-6:last-child, #BadgeList_wrapper .row .col-xs-6:last-child {
    width: 100%;
}
#BadgeAlloc .modal-dialog {
    width:70%;
    margin: 5% auto !important;
}
h4.innerTitle {
	font-size:16px;
	font-weight:normal;
	border-bottom:1px solid #888;
	padding-bottom:15px;	
}
#BadgeList_wrapper {
    padding: 10px 15px;	
}
.badgeShow {
    width: 15px;
    color: #fff;
    margin-right: 0px;
    padding: 2px;
    display: inline-block;
    font-size: 10px;
}
.col-md-12.padding {
	padding:15px;	
}
.portlet {
    border: 1px solid #b3b3b3;
    float: left;
    width: 96%;
	margin:0 2%;
}	
.portlet h3 {
	background: #e2e2e2;
    color: #000;
    font-size: 16px;
    font-weight: normal;
	position:relative;
}
a.AddNewBadge.ButtonAnchor,
a#BackBadge {
    float: right;
    background: #1bbc9b;
    padding: 15px;
    position: absolute;
    right: 0;
    color: #fff;
    top: 0px;
}
.paddingBottom15 {
	padding-bottom:15px !important;	
}
.extrapadding {
	padding: 44px 0 !important;	
}
input[type="submit"].centerGreenBtn {
    background: #1bbc9b;
    color: #fff;
    border: 1px solid #169d81;
    padding: 10px 20px;
    font-size: 16px;
    margin-bottom: 20px;
}
.LeftListing_ContentSection .headingArea h2 {
    margin: 0;
    padding: 10px;
    color: #fff;
    font-size: 18px;
    font-weight: normal;
}
.LeftListing_ContentSection .headingArea {
    background: #a35555;
    width: 100%;
}
.headingArea {
    position: relative;
}
.LeftListing_ContentSection {
    border: 1px solid #ccc;
    float: left;
    width: 100%;
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
.nameCode {
	position:absolute;
	left:0;
	bottom:0;
	background:#000;
	color:#fff;
	font-size:16px;
	font-weight:bold;
	width:100%;
	text-align:center;
}
.primaryReporting {
    border: 1px solid #ccc;
}
.primaryReporting .PrimaryName {
	background: #d9d9d9;
    padding: 15px 5px 15px 0;
    margin: 0;
	font-size:14px;
	font-weight:normal;
	color:#808080;
}
.primaryReporting .PrimaryName .namePrimaryCode {
	background:#f2f2f2;
	    padding: 12px 15px 12px;	
		margin-right:10px;
		color:#808080;
		font-weight:bold;
}
.primaryReporting h5.PrimaryTopLine {
    margin: 0;
    background: #f2f2f2;
    padding: 15px 5px;
    text-align: center;
	font-weight:normal;
	font-size:12px;
	color:#808191;
}
.primaryReporting h5.PrimaryBottomLine {
    margin: 0;
    background: #d9d9d9;
    padding: 15px 5px;
    text-align: center;
	font-weight:normal;
	font-size:12px;
	color:#868081;
}
.summarySection.col-md-12 {
    padding: 20px 0;
}
.reportingPersonal {
    border: 1px solid #ccc;
}
.reportingPersonal .PrimaryName {
	background: #d9d9d9;
    padding: 15px 5px 15px 0;
    margin: 0;
	font-size:14px;
	font-weight:normal;
	color:#000;
}
.reportingPersonal .PrimaryName .namePrimaryCode {
	background:#f2f2f2;
	    padding: 12px 15px 12px;	
		margin-right:10px;
		color:#000;
		font-weight:bold;
}
.reportingPersonal h5.PrimaryTopLine {
    margin: 0;
    background: #dce6f1;
    padding: 15px 5px;
    text-align: center;
	font-weight:normal;
	font-size:12px;
	color:#000;
}
.reportingPersonal h5.PrimaryBottomLine {
    margin: 0;
    background: #b8cce4;
    padding: 15px 5px;
    text-align: center;
	font-weight:normal;
	font-size:12px;
	color:#000;
}
.leftLab3 {
    float: left;
    width: 160px;
    text-align: right;
    padding-right: 10px;
}
.normalFont.pull-right,
.normalFont.pull-left {
	margin:5px 0;	
}
.TimingSection .col-md-3 h5 {
	border-bottom:1px solid #ccc;
	padding-bottom:10px;
	text-transform:uppercase;	
	font-weight:normal;
}
.TimingSectionTable {
	background:#f2f2f2;	
	margin-bottom:20px;
	border:1px solid #ccc;
	min-height:200px;
}
.TimingSectionTable tr {
	
}
.TimingSectionTable tr td {
	padding:0 10px;
}
small:before {
	display:none;	
}
.MatrixRoles {
	/* border-bottom: 2px solid #cacaca; */
    padding-bottom: 10px;
    margin-bottom: 50px;	
}
.FunDaMentalReporting {
	border:1px solid #000;	
}
.FunRep {
	background:#5b6ef5;
	color:#fff;
	font-weight:bold;
}
.ClassTeach {
	background:#bfbfbf;
}
.ClassHere {
	background:#d9d9d9;
}
.ClassSectionHere {
	
}
.StuStrength {
	background:#bfbfbf;
}
.TopBottomLine {
	background:#d9d9d9;
}
.ReportingCodeName {
	background:#dce6f1;
	font-weight:bold;
}
.FunDaMentalReportingChap {
	
}
.FunDaMentalReportingChap .SRNO {
	background:#d9d9d9;
	width:8%;
}
.FunDaMentalReportingChap .SubjectName {
	background:#f2f2f2;	
}
.FunDaMentalReportingChap .StuStrength {
	background:#bfbfbf;
	font-weight:600;
	width:8%;	
}
.FunDaMentalReportingChap .Blocks {
	background:#d9d9d9;	
	width:8%;
}
.FunDaMentalReportingChap .TopBottomLine {
	background:#f2f2f2;
}
.FunDaMentalReportingChap .NameCodeHere {
	background:#dce6f1;
}
.FunDaMentalReportingChap .RankHere {
	background:#f2f2f2;
	width:8%;
}
.FunDaMentalReportingChap .FunRep {
	background:#5b6ef5;
	width:8%;
}
.FunRep.White {
	background:#fff !important;
}
.rotate {

/* Safari */
-webkit-transform: rotate(-90deg);

/* Firefox */
-moz-transform: rotate(-90deg);

/* IE */
-ms-transform: rotate(-90deg);

/* Opera */
-o-transform: rotate(-90deg);

/* Internet Explorer */
filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);

}
.secondLevelReporting {
	color:#8e8e8e;
	border-color:#b3b3b3 !important;	
}
.firstLevelReporting {
	color:#000;
	border-color:#b3b3b3 !important;	
}
.blackSolidBorder {
	position: absolute;
    background: #000;
    width: 3px;
    left: 33%;
    z-index: 0;
    height: 694px;
}
.graySolidBorder {
	position: absolute;
    background: #ccc;
    width: 3px;
    left: 66.4%;
    height: 300px;
}
.grayDashedBorder {
	position: absolute;
    width: 3px;
    border: 2px dashed #ccc;
    left: 66.4%;
    height: 300px;
    top: 45%;
}
.orgChartSection table {
	background:#fff;	
}
hr.smallHR {
    width: 80%;
    margin-left: 10%;
    border-color: #CCC;
}
.filterDiv {
    float: left;
    width: 100%;
    background: #ececec;
    border-bottom: 2px solid #a5a5a5;
    padding: 15px 0;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="/application/views/staffListing/js/multiSelect.js"></script>
<style>
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
/* */
#WeeklyTimesheet .form-control {
    display: block;
    height: 30px;
    padding: 6px 7px;
    font-size: 12px;
    color: #555;
    font-weight: 600;
    background-color: #fff;
    border: 1px solid #c0c2c7;
    border-radius: 1px;
    -webkit-box-shadow: none;
    box-shadow: none;
    -ms-transition: border-color 0.3s;
    -moz-transition: border-color 0.3s;
    width: 100% !important;
    text-align: center;
    -webkit-transition: border-color 0.3s;
}
#WeeklyTimesheet tr td {
    border-bottom: 1px solid #888 !important;
    padding: 10px 15px !important;
}
#WeeklyTimesheet.table-striped>tbody>tr:nth-child(odd)>td, 
#WeeklyTimesheet.table-striped>tbody>tr:nth-child(odd)>th {
    background-color: #e8e8e8;
}
/*
*/
#testingTable {
	
}
#testingTable table tbody tr th {
	
}
#testingTable div {
  margin-left: calc(50em + 60px);
}
#testingTable .headcol, .subhead {
  position: absolute;
  border-top: 3px solid grey;
  margin-top: 0px;
}


#testingTable div {
  overflow-x: scroll;
}
#testingTable th {
    background: none !important;
    border-bottom: 1px solid #ccc !important;
    padding: 3px !important;
    text-align: left;
}
/*
#testingTable section {
  margin: 0 1em;
  position: relative;
}
#testingTable .headcol {
  border-bottom-width: 0;
}
#testingTable table {
  border-collapse: separate;
  border-spacing: 0;
  border-top: 3px solid grey;
}
#testingTable td, th {
  margin: 0;
  white-space: nowrap;
  border: 1px solid grey;
  border-top-width: 0;
  border-left-width: 0;
}
#testingTable .headcol {
        left: 0;
    border-right-width: 0;
    border-left-width: 0;
    width: 30em;
    border-bottom: 0 none !important;
    border-top: 1px solid #ccc !important;
    text-align: left;
	background: #f3f3f3 !important;
}
#testingTable .subhead {
  border-right-width: 1px;
    border-left-width: 1px;
    left: 30em;
    width: 17em;
    border-top: 1px solid #ccc !important;
    border-bottom: 0 none !important;
	background: #f3f3f3 !important;
}
*/
#testingTable td, th {
  margin: 0;
}
#testingTable .headcol {
    left: 0;
    width: 492px;
    text-align: left !important;
	background: #e7e7e7 !important;
    font-size: 13px !important;
	padding:4px !important;
}
#testingTable .subhead {
    left: 491px;
    width: 13%;
	    background: #e7e7e7 !important;
}
#testingTable .headcol, .subhead {
  top: auto;
  text-align: center;
}

.superProfiles {
	overflow:scroll;
	width:100pc;
}
.superProfiles thead tr th {
	width:200px;
}
.superProfiles tr td,
.superProfiles tr th {
	text-align:center;
}
.superProfiles tr td {
	border-bottom:1px solid #888 !important;	
}
.superProfiles tr td,
.TTProfileListingLeft tr td {
	padding:10px !important;	
}
.superProfiles tr th,
.TTProfileListingLeft tr th {
	padding:15px 10px !important;	
}
.TTProfileListingLeft {
		
}
.TTProfileListingLeft tr td {
	    background: #e0e0e0 !important;
    border: 1px solid #bfbfbf !important;
	font-weight:bold;
}
input[type="button"].greenBTN, input[type="submit"].greenBTN {
    background: #1bbc9b;
    color: #fff;
    border: 1px solid #169d81;
    width: 36%;
    padding: 8px;
    font-size: 14px;
}
.TimeLineModal .modal-footer {
    float: left;
    width: 100%;
    padding: 0;
    text-align: center;
    border-top: 1px solid #ccc;
    padding: 10px 0;
}
.TimeLineModal input[type="text"], .TimeLineModal input[type="date"], .TimeLineModal input[type="time"] {
    padding: 5px;
    width: 100%;
    line-height: 19px;
}
.filterDiv2 {
    display: block;
    position: absolute;
    background: #f3f3f3;
    top: 38px;
    right: 0;
    z-index: 9;
    padding: 10px;
    border: 1px solid #868383;
    border-top: 0 none;
	border-right: 0 none;
	width:500px;
}
</style>
<script>
$(document).ready(function(){
    $(".AddNewBadge").click(function(){
        $("#ListBadges").hide();
		$("#AddNewBadgeArea").show();
    });
    $("#BackBadge").click(function(){
        $("#ListBadges").show();
		$("#AddNewBadgeArea").hide();
    });
});
$(document).ready(function(){
    $("#Filter").click(function(){
        $(".filterDiv").toggle();
    });
});

$(document).ready(function(){
    $("#Filterr").click(function(){
        $(".filterDiv2").toggle();
    });
});
</script>

<div class="container">
	<div class="row" style="margin-left:5px;margin-right:5px;">
    	<div class="LeftListing_ContentSection">
        	<div class="headingArea" style="margin-bottom:20px;">
              <h2>Super Profile <a class="HolidayParameter HolidayParOn tooltipp absoluteBtn" href="#" data-toggle="modal" data-target="#SetHolidayParameter">New Super Profile</a></h2>
            </div>
            <div class="modal fade TimeLineModal" id="SetHolidayParameter" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Add new Super Profile</h4>
                        </div>
                        <div class="modal-body">
                          <div class="row" style="margin:0;">
                              <form>
                                <div class="col-md-12" style="padding:10px 0;">
                                    <div class="col-md-3" style="padding-top:5px;">
                                        Super Profile Name
                                    </div><!-- col-md-3 -->
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Holiday Title" />
                                    </div><!-- col-md-9 -->
                                </div><!-- col-md-12 no-padding -->
                                <div class="col-md-12" style="padding:10px 0;">
                                    <div class="col-md-3" style="padding-top:5px;">
                                        Description
                                    </div><!-- col-md-3 -->
                                    <div class="col-md-9">
                                        <textarea></textarea>
                                    </div><!-- col-md-9 -->
                                </div><!-- col-md-12 no-padding -->
                              </form>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <input type="submit" class="greenBTN widthSmall" data-dismiss="modal" value="Add Super Profile">
                        </div>
                      </div>   
                      
                    </div>
                </div><!-- SetHolidayParameter -->
				
				
            <div style="padding: 0px 20px 20px 0px;float: left;width: 100%;">
                <div class="col-md-4 paddingRight0">
                    <table width="100%" class="table table-striped table-hover table-bordered TTProfileListingLeft" style="border-right:0px;">
                      <thead>
                      <tr>
                        <th>TT Profiles</th>
                        <th width="140px">TT Profile Timing</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td>Teachers - NC</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      <tr>
                        <td>Lead Teachers SC</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      <tr>
                        <td>Subject Heads</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      <tr>
                        <td>Teachers - SC</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      <tr>
                        <td>Year Tutors/Lead Teachers NC</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      <tr>
                        <td>Faculty Resource NC</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      <tr>
                        <td>VP/HM</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      <tr>
                        <td>Coordinators</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      <tr>
                        <td>Facilitators</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      <tr>
                        <td>Year Tutors SC</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      <tr>
                        <td>Faculty Resource</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      <tr>
                        <td>Librarians</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      <tr>
                        <td>Generosity Female</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      <tr>
                        <td>Admin/ Finance</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      <tr>
                        <td>Admin/ SIS/Tamkeen</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      <tr>
                        <td>Domestic Staff- Female</td>
                        <td>00:00 - 0:00</td>
                      </tr>
                      </tbody>
                    </table>
                </div><!-- -->
                <div class="col-md-8 paddingLeft0" style="overflow-x:scroll;">
                    <table width="" class="table table-striped table-hover table-bordered superProfiles" >
                      <thead>
                      <tr>
                        <th>Ramzan</th>
                        <th>Eid</th>
                        <th>June</th>
                        <th>July</th>
                        <th>September</th>
                        <th>December</th>
                        <th>Custom</th>
                        <th>Custom 2</th>
                        <th>Custom 3</th>
                        <th>Custom 4</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      <tr>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                        <td width="">00:00 - 00:00</td>
                      </tr>
                      </tbody>
                   
				   </table>
                </div><!-- -->
            </div>
        </div>
    </div><!-- row -->
</div><!-- container -->

<hr /><hr /><hr />
<?php /* ?>
<div class="container" id="testingTable">
    <section>
        <div>
            <table class="table table-striped table-bordered" id="">
              <thead>
              <tr>
                <th class="headcol"><strong>TT Profiles</strong></th>
                <th class="subhead">TT Profile Timing</th>
                <th class="long">Ramadan</th>
                <th class="long">August</th>
                <th class="long">June</th>
                <th class="long">July</th>
                <th class="long">Early Off</th>
                <th class="long">Saturdays</th>
                <th class="long">Sundays</th>
                <th class="long">Holidays</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <th class="headcol"><strong>Admin Resource (library Asst/ Sci Lab Asst)</strong></th>
                <th class="subhead">00:00 - 0:00</th>
                <td class="long">00:00 - 0:00</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
              </tr>
              <tr>
                <th class="headcol"><strong>Admin/ Finance</strong></th>
                <th class="subhead">00:00 - 0:00</th>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
              </tr>
              <tr>
                <th class="headcol"><strong>Admin/ SIS/Tamkeen</strong></th>
                <th class="subhead">00:00 - 0:00</th>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
              </tr>
              <tr>
                <th class="headcol"><strong>Coordinators</strong></th>
                <th class="subhead">00:00 - 0:00</th>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
              </tr>
              <tr>
                 <th class="headcol"><strong>Domestic Staff- Female</strong></th>
                <th class="subhead">00:00 - 0:00</th>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
              </tr>
              <tr>
                <th class="headcol"><strong>Domestic Staff - Male</strong></th>
                <th class="subhead">00:00 - 0:00</th>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
              </tr>
              <tr>
                <th class="headcol"><strong>Facilitators</strong></th>
                <th class="subhead">00:00 - 0:00</th>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
              </tr>
              <tr>
                <th class="headcol"><strong>Faculty Resource (Edu Tech /Sports/ Discvy Centre/ Art )</strong></th>
                <th class="subhead">00:00 - 0:00</th>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
              </tr>
              <tr>
                <th class="headcol"><strong>Faculty Resource NC (Edu Tech /Sports/ Art)</strong></th>
                <th class="subhead">00:00 - 0:00</th>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
                <td class="long">00:00 - 00:0</td>
              </tr>
              </tbody>
            </table>
        </div>
    </section>
</div>

<hr /><hr /><hr />
<?php */ ?>
<div class="container">
	<div class="row" style="margin:0;margin-right: 5px;margin-left: 5px;">
    	<div class="LeftListing_ContentSection" style="position:relative;">
        	<div class="headingArea" style="margin-bottom:20px;">
              <h2>Super Profile <a class="absoluteBtn" href="#" id="Filterr">Filter</a></h2>
            </div>
            <div class="filterDiv2" style="display:none;">
                    	<div class="row" style="margin:0 !important;">		 
                            <div class="col-md-6">
                            	<label>Profiles</label><br />
                                <select type="text" class=" multiselect" multiple="multiple" role="multiselect">          
                                  <option value="0" >Photos</option>          
                                  <option value="1">Link</option>
                                  <option value="2" >Edit</option>
                                  <option value="3">Cart</option>
                                  <option value="4">Cart</option>
                                  <option value="5">Cart</option>
                                  <option value="6">Cart</option>
                                  <option value="7">Cart</option>
                                  <option value="8">Cart</option>
                                </select> 
                            </div>
                            <div class="col-md-6">
                            	<label>Department</label><br />
                                <select type="text" class=" multiselect" multiple="multiple" role="multiselect">          
                                  <option value="0" >Photos</option>          
                                  <option value="1">Link</option>
                                  <option value="2" >Edit</option>
                                  <option value="3">Cart</option>
                                  <option value="4">Cart</option>
                                  <option value="5">Cart</option>
                                  <option value="6">Cart</option>
                                  <option value="7">Cart</option>
                                  <option value="8">Cart</option>
                                </select> 
                            </div>        
                        </div><!-- row -->
                    	<hr class="filterHR" />
                        <div class="row">
                        	<div class="col-md-6 col-md-offset-3">
                            	<input type="submit" class="greenBTNFilter" value="Apply">
                            </div><!-- col-md-4 -->
                        </div><!-- row -->
                    </div><!-- filterDiv -->
            <div style="padding: 0px 20px 20px 20px;float: left;width: 100%;">
        	<table class="table table-striped table-hover table-bordered" id="WeeklyTimesheet">
                <thead>
                    <tr>
                        <th width="20%"> Name </th>
                        <th class="text-center"> Monday<br /><small>08 May 2017</small> </th>
                        <th class="text-center"> Tuesday<br /><small>09 May 2017</small> </th>
                        <th class="text-center"> Wednesday<br /><small>10 May 2017</small> </th>
                        <th class="text-center"> Thursday<br /><small>11 May 2017</small> </th>
                        <th class="text-center"> Friday<br /><small>12 May 2017</small> </th>
                        <th class="text-center"> Saturday<br /><small>13 May 2017</small> </th>
                        <th class="text-center"> Sunday<br /><small>14 May 2017</small> </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Muhammad <strong>Haris</strong> Ola<br /><small><strong>Dept: </strong>Software</small><br /><small><strong>Desg: </strong>UI/UX Developer</small><br /><small><strong>Profile: </strong>Software</small> </td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" disabled /> - <input class="form-control input-sm" type="time" value="07:00" disabled /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" disabled /> - <input class="form-control input-sm" type="time" value="07:00" disabled /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" disabled /> - <input class="form-control input-sm" type="time" value="07:00" disabled /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" disabled /> - <input class="form-control input-sm" type="time" value="07:00" disabled /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" disabled /> - <input class="form-control input-sm" type="time" value="07:00" disabled /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" disabled /> - <input class="form-control input-sm" type="time" value="07:00" disabled /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" disabled /> - <input class="form-control input-sm" type="time" value="07:00" disabled /></td>
                        
                    </tr>
                    <tr>
                        <td>Muhammad <strong>Faisal</strong><br /><small><strong>Dept: </strong>Software</small><br /><small><strong>Desg: </strong>UI/UX Developer</small><br /><small><strong>Profile: </strong>Software</small> </td>
                        <td class="text-center"><input class="form-control input-sm col-md-5" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        
                    </tr>
                    <tr>
                        <td><strong>Rohail</strong> Aslam<br /><small><strong>Dept: </strong>Software</small><br /><small><strong>Desg: </strong>UI/UX Developer</small><br /><small><strong>Profile: </strong>Software</small> </td>
                        <td class="text-center"><input class="form-control input-sm col-md-5" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        
                    </tr>
                    <tr>
                        <td><strong>Atif</strong> Naseem<br /><small><strong>Dept: </strong>Software</small><br /><small><strong>Desg: </strong>UI/UX Developer</small><br /><small><strong>Profile: </strong>Software</small> </td>
                        <td class="text-center"><input class="form-control input-sm col-md-5" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        
                    </tr>
                    <tr>
                        <td><strong>Kashif</strong> Solangi<br /><small><strong>Dept: </strong>Software</small><br /><small><strong>Desg: </strong>UI/UX Developer</small><br /><small><strong>Profile: </strong>Software</small> </td>
                        <td class="text-center"><input class="form-control input-sm col-md-5" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        
                    </tr>
                    <tr>
                        <td><strong>Amin</strong> Vohra <br /><small><strong>Dept: </strong>DI</small><br /><small><strong>Desg: </strong>CCTV Operator</small><br /><small><strong>Profile: </strong>DI</small> </td>
                        <td class="text-center"><input class="form-control input-sm col-md-5" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        
                    </tr>
                    <tr>
                        <td><strong>Asder</strong> Ahmed<br /><small><strong>Dept: </strong>DI</small><br /><small><strong>Desg: </strong>Network Manager</small><br /><small><strong>Profile: </strong>DI</small> </td>
                        <td class="text-center"><input class="form-control input-sm col-md-5" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        
                    </tr>
                    <tr>
                        <td><strong>Rehan</strong> Akhter<br /><small><strong>Dept: </strong>Software</small><br /><small><strong>Desg: </strong>Network Admin</small><br /><small><strong>Profile: </strong>DI</small> </td>
                        <td class="text-center"><input class="form-control input-sm col-md-5" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        <td class="text-center"><input class="form-control input-sm" type="time" value="07:00" /> - <input class="form-control input-sm" type="time" value="07:00" /></td>
                        
                    </tr>
                </tbody>
            </table>
            </div>
        </div><!-- col-md-12 -->
    </div><!-- row -->
</div><!-- container -->

<hr /><hr /><hr />
<div class="container">
	<div class="row" style="margin-left: -3px !important;margin-right: 10px !important;">
    	<div class="col-md-4 " style=""> 
	    	<div class="LeftListing" style="">
            	<div class="LeftListing_ContentSection">
                	<div class="headingArea">
                	  <h2>Staff List <a href="#" class="absoluteBtn" id="Filter">Filter</a></h2>
                    </div><!-- headingArea -->
                    <div class="filterDiv" style="display:none;">
                    	<div class="row" style="margin:0 !important;">		
                            <div class="col-md-6">
                            	<label>Department</label><br />
                                <select type="text" class=" multiselect" multiple="multiple" role="multiselect">          
                                  <option value="0" >Photos</option>          
                                  <option value="1">Link</option>
                                  <option value="2" >Edit</option>
                                  <option value="3">Cart</option>
                                  <option value="4">Cart</option>
                                  <option value="5">Cart</option>
                                  <option value="6">Cart</option>
                                  <option value="7">Cart</option>
                                  <option value="8">Cart</option>
                                </select> 
                            </div> 
                            <div class="col-md-6">
                            	<label>Sections</label><br />
                                <select type="text" class=" multiselect" multiple="multiple" role="multiselect">          
                                  <option value="0" >Photos</option>          
                                  <option value="1">Link</option>
                                  <option value="2" >Edit</option>
                                  <option value="3">Cart</option>
                                  <option value="4">Cart</option>
                                  <option value="5">Cart</option>
                                  <option value="6">Cart</option>
                                  <option value="7">Cart</option>
                                  <option value="8">Cart</option>
                                </select> 
                            </div>        
                        </div><!-- row -->
                    	<hr class="filterHR" />
                        <div class="row">
                        	<div class="col-md-4 col-md-offset-4">
                            	<input type="submit" class="greenBTNFilter" value="Apply Filters">
                            </div><!-- col-md-4 -->
                        </div><!-- row -->
                    </div><!-- filterDiv -->
                    <table width="100%" border="1" id="EntitityListing" class="table table-striped table-bordered table-hover">
                          <thead>
                              <tr>
                                <th class="text-center no-sort" width="">SR</th>
                                <th class="text-center no-sort" width="">GT-ID</th>
                                <th class="" width="">Name</th>
                                <th class="text-center no-sort" width="">Att.</th>
                              </tr>
                          </thead><!-- thead -->
                          <tbody>
                              <tr class="selected">
                                <td class="text-center">1</td>
                                <td class="text-center">15-010</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox PP" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Pending Verification" data-pin-nopin="true">PP</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">2</td>
                                <td class="text-center">15-071</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox AA" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Absent Authorized" data-pin-nopin="true">AA</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">3</td>
                                <td class="text-center">15-095</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox AP" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Absence Verification Pending" data-pin-nopin="true">AP</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">4</td>
                                <td class="text-center">14-056</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox AU" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Absent Unauthorized" data-pin-nopin="true">AU</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">5</td>
                                <td class="text-center">14-084</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox TA" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Tap in Awaited" data-pin-nopin="true">TA</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="Fence">
                                <td class="text-center">6</td>
                                <td class="text-center">16-012</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox NE" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Not Expected Today" data-pin-nopin="true">NE</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">7</td>
                                <td class="text-center">16-070</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">8</td>
                                <td class="text-center">16-070</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">9</td>
                                <td class="text-center">16-070</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">10</td>
                                <td class="text-center">16-070</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">11</td>
                                <td class="text-center">16-070</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">12</td>
                                <td class="text-center">16-070</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">13</td>
                                <td class="text-center">16-070</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">14</td>
                                <td class="text-center">16-070</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="selected">
                                <td class="text-center">15</td>
                                <td class="text-center">16-070</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">16</td>
                                <td class="text-center">16-070</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">17</td>
                                <td class="text-center">16-070</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">18</td>
                                <td class="text-center">16-070</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Affan</strong> Masood Khan</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">19</td>
                                <td class="text-center">16-070</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol">Affan <strong>Maqsood</strong> Khan</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              <tr class="">
                                <td class="text-center">20</td>
                                <td class="text-center">16-070</td>
                                <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: 12-123" data-pin-nopin="true" class="anchorCol"><strong>Ayesha</strong> Aqeel</a><br /><small>Digital Infrastructure</small></td>
                                <td class="text-center"><span class="AttBox PV" style="min-width:60px;">
                                        <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Verified" data-pin-nopin="true">PV</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
                                    </span></td>
                              </tr>
                              
                          </tbody>
                        </table><!-- ListingTable -->
	            </div><!-- LeftListing_ContentSection -->
	        </div><!-- .LeftListing -->
	    </div><!-- col-md-4 -->
	    <div class="col-md-8 paddingRight0" style="">
	    	<div class="col-md-12 RightInformation_headerSection">
	            <div class="col-md-4 borderRightRed paddingLeft0">
	            	<div class="col-md-4 paddingLeft0 paddingRight0" style="max-width:105px;">
	            		<img width="100%" src="http://10.10.10.63/gs/assets/photos/hcm/500x500/staff/1159.jpg" title="Hadi" data-pin-nopin="true" class="borderRedImage" style="max-width: 105px;padding-bottom:20px;"><span class="nameCode">MHO</span>
	            	</div><!-- -->
	            	<div class="col-md-8 paddingRight0">
                        <h2 class="headHeading">Muhammad Haris Ola</h2>
                        <h6 class="normalFont"><span class="leftLab2">GT-ID:</span> <strong>06-070</strong> (S-CFS)</h6>
                        <h6 class="normalFont"><span class="leftLab2">GU-ID:</span> <strong>h.ola</strong></h6>
                        <h6 class="normalFont"><span class="leftLab2">Date of Joining:</span> <strong>26-Oct-16</strong></h6>
                        <h6 class="normalFont"><span class="leftLab2">Campus:</span> <strong>South</strong></h6>
                        
	            	</div><!-- -->
	            </div><!-- col-md-4 -->
	            <div class="col-md-4 borderRightRed" style="height:126px;">
					asdsa
	            </div><!-- col-md-4 -->
	            <div class="col-md-3"  style="height:126px;">
					
	            </div><!-- col-md-3 -->
	        </div><!-- RightInformation_headerSection -->
	        <div class="RightInformation">
            <div class="RightInformation_contentSection">
            	<ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#TIFB">TIF-B</a></li>
                    <li><a data-toggle="tab" href="#TIFA">TIFA</a></li>
                    <li><a data-toggle="tab" href="#TeamAtt">Team Att.</a></li>
                 </ul><!-- nav-tabs -->
                <div class="tab-content">
                	<div id="TIFB" class="tab-pane fade in active">
                    	<ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#BasicInformation">Basic</a></li>
                            <li><a data-toggle="tab" href="#EducationRecord">Education</a></li>
                            <li><a data-toggle="tab" href="#EmploymentHistory">Employment</a></li>
                            <li><a data-toggle="tab" href="#ParentSopuseDetails">Parent / Spouse</a></li>
                            <li><a data-toggle="tab" href="#ChildrenDetails">Children</a></li>
                            <li><a data-toggle="tab" href="#AlternateContacts">Alternate Contacts</a></li>
                            <li><a data-toggle="tab" href="#BankDetails">Other</a></li>
                         </ul><!-- nav-tabs -->
                         <div class="tab-content">
                         	<div id="BasicInformation" class="tab-pane fade in active">
                                <h3 class="headingUnderline">Basic Information</h3>
                                <table id="user" class="table table-bordered table-striped xedit" style="clear: both">
                                    <tbody> 
                                        <tr>         
                                            <td width="50%"><span class="grayish">Full Name <small>(as per NIC)</small>: </span> <a href="#">A Hadi Hunaiz</a></td>
                                            <td width="50%"><span class="grayish">CNIC: </span> <a href="#">42501-4559651-3</a></td>
                                        </tr>
                                        <tr>         
                                            <td width="50%"><span class="grayish">Religion: </span> <a href="#" >Muslim</a></td>
                                            <td width="50%"><span class="grayish">Nationality: </span> <a href="#">PAK</a></td>
                                        </tr>
                                        <tr>         
                                            <td width="50%"><span class="grayish">Gender: </span><a href="#">Male</a></td>
                                            <td width="50%"><span class="grayish">DOB <small>(as per NIC)</small>: </span> <a href="#">09 May 1991</a></td>
                                        </tr>
                                        <tr class="bBottomD">         
                                            <td width="50%"><span class="grayish">Marital Status : </span><a href="#">Single</a></td>
                                            <td width="50%">&nbsp;</td>
                                        </tr>
                                        <tr>         
                                            <td width="50%"><span class="grayish">Mobile Number: </span> <a href="#">+92-332-253-6406</a></td>
                                            <td width="50%"><span class="grayish">Landline Number: </span><a href="#">+9221-34615130</a></td>
                                        </tr>
                                        <tr class="bBottomD">         
                                            <td width="50%"><span class="grayish">Email <small>(Persoanal)</small>: </span> <a href="#">harisola@gmail.com</a></td>
                                            <td width="50%"></td>
                                        </tr>
                                        <tr>         
                                            <td width="50%"><span class="grayish">Apartment No : </span> <a href="#">+92-332-253-6406</a></td>
                                            <td width="50%"><span class="grayish">Street Name : </span><a href="#">+9221-34615130</a></td>
                                        </tr>
                                        <tr>         
                                            <td width="50%"><span class="grayish">Building Name : </span> <a href="#">+92-332-253-6406</a></td>
                                            <td width="50%"><span class="grayish">Plot No : </span><a href="#">+9221-34615130</a></td>
                                        </tr>
                                        <tr class="bBottomD">         
                                            <td width="50%"><span class="grayish">Region : </span> <a href="#">+92-332-253-6406</a></td>
                                            <td width="50%"><span class="grayish">Sub Region: </span><a href="#">+9221-34615130</a></td>
                                        </tr>
                                        <tr>         
                                            <td width="50%"><span class="grayish">Name Code : </span> <a href="#">MHO</a></td>
                                            <td width="50%"><span class="grayish">Employment Status : </span> <a href="#">Permanent</a></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div id="EducationRecord" class="tab-pane fade">
                            	<h3 class="headingUnderline">Education Record</h3>
                                <table width="100%" border="0" class="table table-bordered">
                                  <thead>
                                  <tr>
                                    <th class="" width="40%">Institute</th>
                                    <th width="20%">Subjects</th>
                                    <th width="20%">Qualification</th>
                                    <th width="10%">Result</th>
                                    <th width="10%">Year of<br />Completion</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <tr class="bBottomD">
                                    <td colspan="5" class=""><strong>School</strong></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr class="bBottomD">
                                    <td colspan="5" class=""><strong>College</strong></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr class="bBottomD">
                                    <td colspan="5" class=""><strong>University</strong></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr class="bBottomD">
                                    <td colspan="5" class=""><strong>Professional</strong></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr class="bBottomD">
                                    <td colspan="5" class=""><strong>Others</strong></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  </tbody>
                                </table>
                            </div>
                            <div id="EmploymentHistory" class="tab-pane fade">
                            	<h3 class="headingUnderline">Employment History</h3>
                                <table width="100%" border="0" class="table table-bordered">
                                  <thead>
                                  <tr>
                                    <th class="">Institution</th>
                                    <th>Designation</th>
                                    <th>Class(s)<br />taught</th>
                                    <th>Subject(s)<br />taught</th>
                                    <th>Salary</th>
                                    <th>From<br /><small>(year)</small></th>
                                    <th>To<br /><small>(year)</small></th>
                                    <th>Reasons for Leaving</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  </tbody>
                                </table>
                            </div>
                            <div id="ParentSopuseDetails" class="tab-pane fade">
                            	<h3 class="headingUnderline">Parent / Spouse details</h3>
                                <table width="100%" border="0" class="table table-bordered">
                                  <thead>
                                  <tr>
                                    <th class="text-center">Father</th>
                                    <th class="text-center" width="20%">&nbsp;</th>
                                    <th class="text-center">Spouse</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="text-center"><strong>Name</strong></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="text-center"><strong>Profession</strong></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="text-center"><strong>Qualification</strong></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="text-center"><strong>Designation</strong></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="text-center"><strong>Department</strong></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="text-center"><strong>Organisation</strong></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="text-center"><strong>CNIC</strong></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="text-center"><strong>Mobile</strong></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="text-center"><strong>Address</strong></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  
                                  </tbody>
                                </table>
                            </div>
                            <div id="ChildrenDetails" class="tab-pane fade">
                            	<h3 class="headingUnderline">Children Details - <small>GF-ID: <strong>16-070</strong></small></h3>
                                <table width="100%" border="0" class="table table-bordered">
                                  <thead>
                                  <tr>
                                    <th class="" width="10%">S. No.</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>School</th>
                                    <th>University</th>
                                    <th>Employer</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  </tbody>
                                </table>
                            </div>
                            <div id="AlternateContacts" class="tab-pane fade">
                            	<h3 class="headingUnderline">Alternate Contacts</h3>
                                <table width="100%" border="0" class="table table-bordered">
                                  <thead>
                                  <tr>
                                    <th class="text-center" width="40%">Next of Kin</th>
                                    <th class="text-center" width="20%">&nbsp;</th>
                                    <th class="text-center" width="40%">Emergency Contact</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="text-center"><strong>Name</strong></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="text-center"><strong>Address</strong></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="text-center"><strong>Email</strong></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="text-center"><strong>Mobile</strong></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="text-center"><strong>Relationship</strong></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  </tbody>
                                </table>
                            </div>
                            <div id="BankDetails" class="tab-pane fade">
                            	<h3 class="headingUnderline">Other Details</h3>
                                <table id="user" class="table table-bordered table-striped xedit" style="clear: both">
                                    <tbody> 
                                        <tr>         
                                            <td width="50%"><span class="grayish">Provident Fund : </span> <a href="#">Yes</a></td>
                                            <td width="50%"><span class="grayish">NTN : </span> <a href="#">42501-4559651-3</a></td>
                                        </tr>
                                        <tr>         
                                            <td width="50%"><span class="grayish">EOBI/SESSI number: </span> <a href="#" ></a></td>
                                            <td width="50%">&nbsp;</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <h3 class="headingUnderline">Bank Details</h3>
                                <table id="user" class="table table-bordered table-striped xedit" style="clear: both">
                                    <tbody> 
                                        <tr>         
                                            <td width="50%"><span class="grayish">Bank Name : </span> <a href="#">Meezan</a></td>
                                            <td width="50%"><span class="grayish">Branch: </span> <a href="#">Abul Hassan Isphani Road</a></td>
                                        </tr>
                                        <tr>         
                                            <td width="50%"><span class="grayish">Account Number: </span> <a href="#" ></a></td>
                                            <td width="50%">&nbsp;</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <h3 class="headingUnderline">Takaful</h3>
                                <table id="user" class="table table-bordered table-striped xedit" style="clear: both">
                                    <tbody> 
                                        <tr>         
                                            <td width="50%"><span class="grayish">Bank Name : </span> <a href="#">Meezan</a></td>
                                            <td width="50%"><span class="grayish">Branch: </span> <a href="#">Abul Hassan Isphani Road</a></td>
                                        </tr>
                                        <tr>         
                                            <td width="50%"><span class="grayish">Account Number: </span> <a href="#" ></a></td>
                                            <td width="50%">&nbsp;</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- TIF-B -->
                    <div id="TIFA" class="tab-pane fade">
                		<div class="RightInformation_contentSection" style="padding:0;">
                	<?php /* ?><?php */ ?>
                    <div class="summarySection col-md-12">
                    	<div class="col-md-6">
                        	<div class="col-md-6 paddingLeft0">
                            	<div class="primaryReporting">
                                    <h4 class="PrimaryName"><span class="namePrimaryCode">KNN</span>Khadija Noorani</h4>
                                    <h5 class="PrimaryTopLine">Vice Principal</h5>
                                    <h5 class="PrimaryBottomLine">Starter & Junior Section</h5>
                                </div><!-- primaryReporting -->
                            </div><!-- col-md-6 -->
                            <div class="col-md-6 paddingRight0">
                            	<div class="reportingPersonal">
                                    <h4 class="PrimaryName"><span class="namePrimaryCode">SSD</span>Shoaib Siddiqui</h4>
                                    <h5 class="PrimaryTopLine">Coordinator, Academics</h5>
                                    <h5 class="PrimaryBottomLine">Starter Section</h5>
                                </div><!-- primaryReporting -->
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-6 -->
                        <div class="col-md-6">
                        	<div class="col-md-6 paddingLeft0 paddingRight0">
                            	<h6 class="normalFont pull-right"><span class="leftLab3">Fundamental Reportees:</span> <strong>06-070</strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3">Primary Reportees:</span> <strong>06-070</strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3">Total Reportees:</span> <strong>06-070</strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3">Total Members:</span> <strong>06-070</strong></h6>
                            </div><!-- -->
                            <div class="col-md-6 paddingLeft0 paddingRight0">
                            	<h6 class="normalFont pull-right"><span class="leftLab3">Class Role:</span> <strong>06-070</strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3"> Total Teaching Roles:</span> <strong>06-070</strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3">Total Teaching Blocks:</span> <strong>06-070</strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3">Total Teaching Students:</span> <strong>06-070</strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3">Total Unique Students:</span> <strong>06-070</strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3">Total Student Blocks:</span> <strong>06-070</strong></h6>
                            </div><!-- -->
                        </div><!-- col-md-6 -->
                    </div><!-- summarySection -->
	                <hr style="margin-top: 5px;" />
                    <div class="TimingSection col-md-12">
                    	<div class="col-md-3 paddingLeft0 text-center ">
                        	<h5>Timing Profile & Hours</h5>
                            <table width="100%" border="0" class="TimingSectionTable">
                              <tr>
                              	<td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2">Timing Profile</td>
                              </tr>
                              <tr>
                                <td colspan="2"><h4 style="margin:0;font-size:16px;">Heads</h4></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2">Average Weekly Hours</td>
                              </tr>
                              <tr>
                                <td colspan="2"><h4 style="margin:0;font-size:16px;">53:00</h4></td>
                              </tr>
                              <tr>
                              	<td colspan="2">&nbsp;</td>
                              </tr>
                            </table>
                        </div><!-- col-md-3 -->
                        <div class="col-md-3 paddingLeft0 text-center">
                        	<h5>Full Time Parameters</h5>
                            <table width="100%" border="0" class="TimingSectionTable">
                              <tr>
                              	<td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td class="text-left">Standard IN</td>
                                <td class="text-right"><strong>07:30</strong></td>
                              </tr>
                              <tr>
                                <td class="text-left">Standard OUT</td>
                                <td class="text-right"><strong>15:30</strong></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td class="text-left">Friday OUT</td>
                                <td class="text-right"><strong>14:30</strong></td>
                              </tr>
                              <tr>
                                <td class="text-left">Saturday Hrs</td>
                                <td class="text-right"><strong>5.0</strong></td>
                              </tr>
                              <tr>
                              	<td colspan="2">&nbsp;</td>
                              </tr>
                            </table>
                        </div><!-- col-md-3 -->
                        <div class="col-md-3 paddingLeft0 text-center">
                        	<h5>Secondary Parameters</h5>
                            <table width="100%" border="0" class="TimingSectionTable">
                              <tr>
                              	<td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td class="text-left">Sat's Working</td>
                                <td class="text-right"><strong>2</strong></td>
                              </tr>
                              <tr>
                                <td class="text-left">Sat's Off</td>
                                <td class="text-right"><strong>-</strong></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td class="text-left">Ext. Out</td>
                                <td class="text-right"><strong>15:30</strong></td>
                              </tr>
                              <tr>
                                <td class="text-left">Ext. FREQ</td>
                                <td class="text-right"><strong>2</strong></td>
                              </tr>
                              <tr>
                                <td class="text-left">July Category</td>
                                <td class="text-right"><strong>W2</strong></td>
                              </tr>
                              <tr>
                              	<td colspan="2">&nbsp;</td>
                              </tr>
                            </table>
                        </div><!-- col-md-3 -->
                        <div class="col-md-3 paddingLeft0 text-center">
                        	<h5>Custom Timings</h5>
                            <table width="100%" border="0" class="TimingSectionTable">
                              <tr>
                              	<td colspan="3">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>Mon</td>
                                <td><strong>07:00</strong></td>
                                <td><strong>14:00</strong></td>
                              </tr>
                              <tr>
                                <td>Tue</td>
                                <td><strong>07:00</strong></td>
                                <td><strong>14:00</strong></td>
                              </tr>
                              <tr>
                                <td>Wed</td>
                                <td><strong>07:00</strong></td>
                                <td><strong>14:00</strong></td>
                              </tr>
                              <tr>
                                <td>Thu</td>
                                <td><strong>07:00</strong></td>
                                <td><strong>14:00</strong></td>
                              </tr>
                              <tr>
                                <td>Fri</td>
                                <td><strong>07:00</strong></td>
                                <td><strong>14:00</strong></td>
                              </tr>
                              <tr>
                                <td>Sat</td>
                                <td><strong>07:00</strong></td>
                                <td><strong>14:00</strong></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                            </table>

                        </div><!-- col-md-3 -->
                    </div><!-- TimingSection -->
                    <hr style="margin-top: 5px;" />
                    <div class="MatrixRolesSection">
                    	<h4 class="col-md-6 col-md-offset-3 text-center MatrixRoles">Matrix Role(s) <small>for Classes and Groups</small></h4>
                        <div class="col-md-12 paddingBottom40">
                        	<div class="col-md-6 col-md-offset-3 paddingLeft0 paddingRight0">
                            	<table width="100%" border="0" class="FunDaMentalReporting">
                                  <tr>
                                    <td class="text-center FunRep">FR</td>
                                    <td class="text-center ClassTeach">CLT</td>
                                    <td class="text-center ClassHere">IV-G</td>
                                    <td class="text-center ClassSectionHere">IV-CLT-0-G</td>
                                    <td class="text-center StuStrength">28</td>
                                    <td class="text-center TopBottomLine">YT, Grade IV<br />Sadia Ashar</td>
                                    <td class="text-center ReportingCodeName">SAS</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap" style="border:1px solid #000;">
                                  <tr>
                                    <td class="text-center SRNO">2</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                    <td class="text-center FunRep">FR</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">14</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">3</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                    <td class="text-center FunRep White"></td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">15</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">4</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                    <td class="text-center FunRep White"></td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">16</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">5</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                    <td class="text-center FunRep White"></td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">17</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">6</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                    <td class="text-center FunRep White"></td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">18</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">7</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                    <td class="text-center FunRep White"></td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">19</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">8</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                    <td class="text-center FunRep White"></td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">20</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">9</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                    <td class="text-center FunRep White"></td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">21</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">10</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                    <td class="text-center FunRep White"></td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">22</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">11</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                    <td class="text-center FunRep White"></td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">23</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">12</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                    <td class="text-center FunRep White"></td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">24</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">13</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                    <td class="text-center FunRep White"></td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">25</td>
                                    <td class="text-center SubjectName">X-PHYS-A-1</td>
                                    <td class="text-center StuStrength">29</td>
                                    <td class="text-center Blocks">3</td>
                                    <td class="text-center TopBottomLine">LT, Physics<br />Rukhsana Hai</td>
                                    <td class="text-center NameCodeHere">RHI</td>
                                    <td class="text-center RankHere">7</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                    </div><!-- MatrixRolesSection -->
                    <hr style="margin-top: 5px;" />
                    <div class="orgChartSection">
                    	<h4 class="col-md-6 col-md-offset-3 text-center MatrixRoles">Org Chart Roles(s) <small>for Non-Classroom Roles</small> | Role 1</h4>
                        <?php /* ?><?php */ ?>
                    	<div class="no-padding col-md-10 col-md-offset-1">
                            <div class="blackSolidBorder">&nbsp;</div>
                            <div class="graySolidBorder">&nbsp;</div>
                            <div class="grayDashedBorder">&nbsp;</div>
                        	<div class="col-md-12 ">
                            	<div class="col-md-6 text-center">
                                	<table width="100%" border="1" class="secondLevelReporting">
                                      <tr>
                                      	<td colspan="3"><h5>PRIMARY GRANDREPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40">JN-T001</td>
                                        <td width="30%">OPQ</td>
                                        <td width="30%">2</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">Vice Principal, Junior Section</td>
                                      </tr>
                                      <tr>
                                        <td height="40">GT 10-567</td>
                                        <td colspan="2">KHN</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">Khadija Noorani</td>
                                      </tr>
                                    </table>
									
                                </div><!-- col-md-6 -->
                                <div class="col-md-6 text-center">
                                	<table width="100%" border="1" class="secondLevelReporting">
                                      <tr>
                                      	<td colspan="3"><h5>SECONDARY GRANDREPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40">JN-T001</td>
                                        <td width="30%">OPQ</td>
                                        <td width="30%">2</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">Vice Principal, Junior Section</td>
                                      </tr>
                                      <tr>
                                        <td height="40">GT 10-567</td>
                                        <td colspan="2">KHN</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">Khadija Noorani</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingTop50">
                            	<div class="col-md-6 text-center">
                                	<table width="100%" border="1" class="firstLevelReporting">
                                      <tr>
                                      	<td colspan="3"><h5>PRIMARY REPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40" bgcolor="#e5d998">JN-T001</td>
                                        <td width="30%" bgcolor="#ffff00">OPQ</td>
                                        <td width="30%" bgcolor="#ffff00">2</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30" bgcolor="#e5d998">Vice Principal, Junior Section</td>
                                      </tr>
                                      <tr>
                                        <td height="40" bgcolor="#f4ecfd">GT 10-567</td>
                                        <td colspan="2" bgcolor="#f4ecfd">KHN</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30" bgcolor="#f4ecfd">Khadija Noorani</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                                <div class="col-md-6 text-center">
                                	<table width="100%" border="1" class="firstLevelReporting">
                                      <tr>
                                      	<td colspan="3"><h5>SECONDARY REPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40">JN-T001</td>
                                        <td width="30%">OPQ</td>
                                        <td width="30%">2</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">Vice Principal, Junior Section</td>
                                      </tr>
                                      <tr>
                                        <td height="40">GT 10-567</td>
                                        <td colspan="2">KHN</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">Khadija Noorani</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingTop50">
                            	<div class="col-md-6 col-md-offset-3 text-center" style="background:#e2e2e2;padding:15px;">
                                	<table width="100%" border="1" bgcolor="#fff" class="firstLevelReporting" style="background:#fff;" >
                                      <tr>
                                      	<td bgcolor="#ade4f2"><h5 style="color:#;">FR</h5></td>
                                      	<td colspan="2" bgcolor="#ade4f2"><h5>ROLE A</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40" bgcolor="#e5d998">JN-B-01</td>
                                        <td width="30%" bgcolor="#ffff00">OPQ</td>
                                        <td width="30%" bgcolor="#ffff00">4</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30" bgcolor="#e5d998">Headmistress, Junior Section</td>
                                      </tr>
                                      <tr>
                                        <td height="40" bgcolor="#ade4f2">ZHA-A</td>
                                        <td colspan="2" bgcolor="#f4ecfd">Zillehuma Asif</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingTop50">
                            	<div class="col-md-6 col-md-offset-3 text-center" style="background:none;padding:15px;">
                                	<table width="100%" border="1">
                                      <tr>
                                        <td colspan="2" width="33%" height="90">Fundamental<br />Primary<br /><h5>06</h5></td>
                                        <td colspan="2" width="33%" height="90">Total<br />Primary<br /><h5>06</h5></td>
                                        <td colspan="2" width="33%" height="90">Total<br />Reportee<br /><h5>06</h5></td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" width="50%"  height="80">Total Staff<br />Members<br /><h5>200</h5></td>
                                        <td colspan="3" width="50%"  height="80">Total Student<br />Members<br /><h5>1382</h5></td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                        </div><!-- col-md-12 -->
                        <hr class="smallHR" />
                        <div class="col-md-12 paddingLeft0 paddingRight0 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td bgcolor="#f5f5f5">1</td>
                                    <td bgcolor="#f5f5f5">P</td>
                                    <td bgcolor="#f4ecfd"><strong>Rakhshanda Ovais</strong></td>
                                    <td bgcolor="#ade4f2">ROV-B</td>
                                    <td bgcolor="#ade4f2">3 (25)</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#ffff00">IND</td>
                                    <td bgcolor="#ffff00">(ARS)</td>
                                    <td bgcolor="#e5d998">Headmistress</td>
                                    <td colspan="2" bgcolor="#e5d998">N-ML-M01</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingLeft0 paddingRight0 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td bgcolor="#f5f5f5">1</td>
                                    <td bgcolor="#f5f5f5">P</td>
                                    <td bgcolor="#f4ecfd"><strong>Rakhshanda Ovais</strong></td>
                                    <td bgcolor="#ade4f2">ROV-B</td>
                                    <td bgcolor="#ade4f2">3 (25)</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#ffff00">IND</td>
                                    <td bgcolor="#ffff00">(ARS)</td>
                                    <td bgcolor="#e5d998">Headmistress</td>
                                    <td colspan="2" bgcolor="#e5d998">N-ML-M01</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingLeft0 paddingRight0 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td bgcolor="#f5f5f5">1</td>
                                    <td bgcolor="#f5f5f5">P</td>
                                    <td bgcolor="#f4ecfd"><strong>Rakhshanda Ovais</strong></td>
                                    <td bgcolor="#ade4f2">ROV-B</td>
                                    <td bgcolor="#ade4f2">3 (25)</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#ffff00">IND</td>
                                    <td bgcolor="#ffff00">(ARS)</td>
                                    <td bgcolor="#e5d998">Headmistress</td>
                                    <td colspan="2" bgcolor="#e5d998">N-ML-M01</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingLeft0 paddingRight0 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td bgcolor="#f5f5f5">1</td>
                                    <td bgcolor="#f5f5f5">P</td>
                                    <td bgcolor="#f4ecfd"><strong>Rakhshanda Ovais</strong></td>
                                    <td bgcolor="#ade4f2">ROV-B</td>
                                    <td bgcolor="#ade4f2">3 (25)</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#ffff00">IND</td>
                                    <td bgcolor="#ffff00">(ARS)</td>
                                    <td bgcolor="#e5d998">Headmistress</td>
                                    <td colspan="2" bgcolor="#e5d998">N-ML-M01</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingLeft0 paddingRight0 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                    </div><!-- orgChartSection -->
                    <hr style="margin-top: 5px;" />
                    <div class="orgChartSection">
                    	<h4 class="col-md-6 col-md-offset-3 text-center MatrixRoles">Org Chart Roles(s) <small>for Non-Classroom Roles</small> | Role 2</h4>
                        <?php /* ?><?php */ ?>
                    	<div class="no-padding col-md-10 col-md-offset-1">
                            <div class="blackSolidBorder">&nbsp;</div>
                            <div class="graySolidBorder">&nbsp;</div>
                            <div class="grayDashedBorder">&nbsp;</div>
                        	<div class="col-md-12 ">
                            	<div class="col-md-6 text-center">
                                	<table width="100%" border="1" class="secondLevelReporting">
                                      <tr>
                                      	<td colspan="3"><h5>PRIMARY GRANDREPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40">JN-T001</td>
                                        <td width="30%">OPQ</td>
                                        <td width="30%">2</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">Vice Principal, Junior Section</td>
                                      </tr>
                                      <tr>
                                        <td height="40">GT 10-567</td>
                                        <td colspan="2">KHN</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">Khadija Noorani</td>
                                      </tr>
                                    </table>
									
                                </div><!-- col-md-6 -->
                                <div class="col-md-6 text-center">
                                	<table width="100%" border="1" class="secondLevelReporting">
                                      <tr>
                                      	<td colspan="3"><h5>SECONDARY GRANDREPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40">JN-T001</td>
                                        <td width="30%">OPQ</td>
                                        <td width="30%">2</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">Vice Principal, Junior Section</td>
                                      </tr>
                                      <tr>
                                        <td height="40">GT 10-567</td>
                                        <td colspan="2">KHN</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">Khadija Noorani</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingTop50">
                            	<div class="col-md-6 text-center">
                                	<table width="100%" border="1" class="firstLevelReporting">
                                      <tr>
                                      	<td colspan="3"><h5>PRIMARY REPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40" bgcolor="">JN-T001</td>
                                        <td width="30%" >OPQ</td>
                                        <td width="30%" >2</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30" bgcolor="">Vice Principal, Junior Section</td>
                                      </tr>
                                      <tr>
                                        <td height="40" >GT 10-567</td>
                                        <td colspan="2" bgcolor="#d1fbfb" ><strong>KHN</strong></td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">Khadija Noorani</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                                <div class="col-md-6 text-center">
                                	<table width="100%" border="1" class="firstLevelReporting">
                                      <tr>
                                      	<td colspan="3"><h5>SECONDARY REPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40">JN-T001</td>
                                        <td width="30%">OPQ</td>
                                        <td width="30%">2</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">Vice Principal, Junior Section</td>
                                      </tr>
                                      <tr>
                                        <td height="40">GT 10-567</td>
                                        <td colspan="2">KHN</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">Khadija Noorani</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingTop50">
                            	<div class="col-md-6 col-md-offset-3 text-center" style="background:#e2e2e2;padding:15px;">
                                	<table width="100%" border="1" bgcolor="#fff" class="firstLevelReporting" style="background:#fff;" >
                                      <tr>
                                      	<td colspan="3" bgcolor=""><h5>ROLE 2</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40" bgcolor="">JN-B-01</td>
                                        <td width="30%" bgcolor="">OPQ</td>
                                        <td width="30%" bgcolor="">4</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30" bgcolor="">Headmistress, Junior Section</td>
                                      </tr>
                                      <tr>
                                        <td height="40" bgcolor="">ZHA-A</td>
                                        <td colspan="2" bgcolor="">Zillehuma Asif</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingTop50">
                            	<div class="col-md-6 col-md-offset-3 text-center" style="background:none;padding:15px;">
                                	<table width="100%" border="1">
                                      <tr>
                                        <td colspan="2" width="33%" height="90">Fundamental<br />Primary<br /><h5>06</h5></td>
                                        <td colspan="2" width="33%" height="90">Total<br />Primary<br /><h5>06</h5></td>
                                        <td colspan="2" width="33%" height="90">Total<br />Reportee<br /><h5>06</h5></td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" width="50%"  height="80">Total Staff<br />Members<br /><h5>200</h5></td>
                                        <td colspan="3" width="50%"  height="80">Total Student<br />Members<br /><h5>1382</h5></td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                        </div><!-- col-md-12 -->
                        <hr class="smallHR" />
                        <div class="col-md-12 paddingLeft0 paddingRight0 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingLeft0 paddingRight0 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingLeft0 paddingRight0 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingLeft0 paddingRight0 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingLeft0 paddingRight0 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingLeft0 paddingRight0 paddingBottom20">
                        	<div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                            <div class="col-md-6">
                            	<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                  <tr>
                                    <td width="15%" bgcolor="#f5f5f5">1</td>
                                    <td width="15%" bgcolor="#f5f5f5">P</td>
                                    <td width="15%" bgcolor="">INDIR</td>
                                    <td width="15%" bgcolor="">ARS</td>
                                    <td width="40%" bgcolor="#f5f5f5">Admin Coordinator</td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#e1e1e1" colspan="2">MULTI(4)</td>
                                    <td bgcolor="#e1e1e1">16 (300)</td>
                                    <td bgcolor="#f5f5f5"><strong>MNH</strong></td>
                                    <td colspan="" bgcolor="#f5f5f5">Mehmood Hussain</td>
                                  </tr>
                                </table>
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->
                    </div><!-- orgChartSection -->
	            </div><!-- .RightInformation_contentSection -->    
                    </div><!-- TIF-A -->
                    <div id="TeamAtt" class="tab-pane fade">
                    	<table width="100%" border="0" class="table table-bordered ">
                          <thead>
                          <tr>
                            <th>Name - <small>Reporting type</small></th>
                            <th class="text-center">Interim<br />Issued</th>
                            <th class="text-center">Day Pass</th>
                            <th class="text-center">Authorized<br />Holiday</th>
                            <th class="text-center">Unauthorized<br />Holiday</th>
                            <th class="text-center">Total<br />Presence</th>
                            <th class="text-center">Total<br />Absence</th>
                            <th class="text-center">Total<br />School Days</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td>Muhammad Haris Ola - <small><strong>FP</strong></small></td>
                            <td class="text-center">01</td>
                            <td class="text-center">03</td>
                            <td class="text-center">05</td>
                            <td class="text-center">10</td>
                            <td class="text-center">50</td>
                            <td class="text-center">60</td>
                            <td class="text-center">255</td>
                          </tr>
                          <tr>
                            <td>Muhammad Haris Ola - <small><strong>FP</strong></small></td>
                            <td class="text-center">01</td>
                            <td class="text-center">03</td>
                            <td class="text-center">05</td>
                            <td class="text-center">10</td>
                            <td class="text-center">50</td>
                            <td class="text-center">60</td>
                            <td class="text-center">255</td>
                          </tr>
                          <tr>
                            <td>Muhammad Haris Ola - <small><strong>P</strong></small></td>
                            <td class="text-center">01</td>
                            <td class="text-center">03</td>
                            <td class="text-center">05</td>
                            <td class="text-center">10</td>
                            <td class="text-center">50</td>
                            <td class="text-center">60</td>
                            <td class="text-center">255</td>
                          </tr>
                          <tr>
                            <td>Muhammad Haris Ola - <small><strong>P</strong></small></td>
                            <td class="text-center">01</td>
                            <td class="text-center">03</td>
                            <td class="text-center">05</td>
                            <td class="text-center">10</td>
                            <td class="text-center">50</td>
                            <td class="text-center">60</td>
                            <td class="text-center">255</td>
                          </tr>
                          <tr>
                            <td>Muhammad Haris Ola - <small><strong>S</strong></small></td>
                            <td class="text-center">01</td>
                            <td class="text-center">03</td>
                            <td class="text-center">05</td>
                            <td class="text-center">10</td>
                            <td class="text-center">50</td>
                            <td class="text-center">60</td>
                            <td class="text-center">255</td>
                          </tr>
                          <tr>
                            <td>Muhammad Haris Ola - <small><strong>S</strong></small></td>
                            <td class="text-center">01</td>
                            <td class="text-center">03</td>
                            <td class="text-center">05</td>
                            <td class="text-center">10</td>
                            <td class="text-center">50</td>
                            <td class="text-center">60</td>
                            <td class="text-center">255</td>
                          </tr>
                          <tr>
                            <td>Muhammad Haris Ola - <small><strong>IND</strong></small></td>
                            <td class="text-center">01</td>
                            <td class="text-center">03</td>
                            <td class="text-center">05</td>
                            <td class="text-center">10</td>
                            <td class="text-center">50</td>
                            <td class="text-center">60</td>
                            <td class="text-center">255</td>
                          </tr>
                          </tbody>
                        </table>

                    </div><!-- Team Att -->
                </div>
            </div>
	        </div><!-- RightInformation -->
	    </div><!-- col-md-9 -->
	</div><!-- row -->
</div><!-- container -->
