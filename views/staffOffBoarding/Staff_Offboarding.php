<link href="<?php echo base_url()?>components/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="<?php echo base_url()?>components/js/bootstrap-toggle.min.js"></script>
<style>
.PrintButtonTop {
    position: absolute;
    top: -42px;
    right: -15px;
    z-index: 9;
}
.harisola {
    padding: 10px 20px;
    width: 100%;
    float: left;
    border: 1px solid #ccc;
}
.PrintButtonTop a {
    position: absolute;
    right: 15px;
    top: 42px;
    background: url(../../Components/image/PrintButton.png) no-repeat;
    width: 100px;
    height: 27px;
}
.PrintButtonTop a:hover {
    text-decoration:none;   
}
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
    padding-top:9px !important; 
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
.offboardingForm {
   float:left;
   width:100%;
}
h5.headingFormSection {
        background: #b1d4f3;
    text-align: center;
    color: #000;
    font-weight: normal;
    margin-top: 0;
    padding: 10px 0;
    font-size: 16px;    
}
.fieldArea {
    padding-bottom: 15px;
    float: left;
    width: 100%;
    min-height: 56px;   
}
.fieldArea2:first-child {
    border-top: 1px solid #e2e2e2;
    padding-top:5px;
}
.fieldArea2:last-child {
    border-bottom:0 none;
    padding-top: 25px;  
}
.fieldArea2 {
    padding-bottom: 4px;
    float: left;
    width: 100%;
    border-bottom: 1px solid #e2e2e2;
    margin-bottom: 5px;
}
input[type="text"],
input[type="number"],
input[type="date"] {
    padding: 7px 5px;
    width:100%;
}
th {
    text-transform: none !important;
    font-size: 14px !important;
    background: #ececec !important;
    color: #333 !important;
    font-weight: normal;
    border-top: 1px solid #ccc !important;
    border-bottom: 1px solid #ccc !important;
    border-color: #ccc !important;
    padding: 6px 7px !important;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
}
td {
    font-size: 14px !important;
    background: #fff !important;
    color: #333 !important;
    font-weight: normal;
    border-top: 0;
    border-bottom: 1px solid #ccc !important;
    border-color: #ccc !important;
    padding: 6px 7px !important;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
}
.boxOpening {
    border: 1px solid #ccc;
    border-top: 0 none;
    padding-top: 50px !important;   
}
.nav-tabs > li > a {
    margin-right:0 !important;  
}
.offboardingForm li.active {
    background: #fff;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #a35555 !important;
    cursor:pointer !important;
}
.offboardingForm table {
    font-size:12px; 
}
#EntitityListing_wrapper .row .col-xs-6:first-child {
    display:none;   
}
#EntitityListing_wrapper .row .col-xs-6:last-child {
    width:100%;
}
div.dataTables_wrapper div.dataTables_paginate {
    margin: 0;
    white-space: nowrap;
    text-align: center;
    font-size: 12px;
}
#EntitityListing_wrapper {
    padding: 10px;
    float: left;
    width: 100%;
    overflow-x: hidden;
    font-size: 12px;
}
#EntitityListing_wrapper table {
    overflow-y: scroll;
    width: 98%;
    padding-right: 1px;
    overflow-x: hidden;
    font-size: 12px;
}
div.dataTables_filter input {
    padding: 4px 6px !important;
}
.borderRightRed {
    border-right: 2px solid #e26a6a;
}
.RightInformation_headerSection {
    border: 1px solid #c34a4a;
    float: left;
    background: #fff;
    padding: 10px 10px;
    min-height: 146px;
    max-height: 146px;
}
.paddingLeft0 {
	padding-left:0;	
}
.paddingRight0 {
	padding-right:0;	
}
h2.headHeading {
    font-size: 14px;
    font-weight: bold;
    color: #c34a4a;
    letter-spacing: 1px;
    margin-top: 10px;
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
$('#TTListing').dataTable({
      "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
    "bLengthChange": false,
    "bInfo" : false,
    "aLengthMenu": [[25, 50, 70, -1], [25, 50, 70, "All"]],
    "iDisplayLength": 25,
    "bSort" : false
  });
  $('#EntitityListing').dataTable({
      "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
    "bLengthChange": false,
    "bInfo" : false,
    "aLengthMenu": [[25, 50, 70, -1], [25, 50, 70, "All"]],
    "iDisplayLength": 25,
    "bSort" : false
  });
</script>
<div class="container">
  <div class="row" style="margin-left: -3px !important;margin-right: 10px !important;">
      <div class="col-md-4 " style=""> 
        <div class="LeftListing" style="">
              <div class="LeftListing_ContentSection">
                  <div class="headingArea">
                    <h2>Staff List </h2>
                    </div><!-- headingArea -->
                    <div class="filterDiv" style="display:none;">
                      <div class="row" style="margin:0 !important;">    
                            <div class="col-md-6">
                              <label>Department</label><br />
                                <select type="text" class=" multiselect" multiple="multiple" role="multiselect" id="department">       
                                  <?php foreach($this->Department as $data) { ?>
                                      <option value="<?php echo $data['c_topline']; ?>" ><?php echo $data['c_topline']; ?></option>
                                  <?php } ?>
                                </select> 
                            </div> 
                            <div class="col-md-6">
                              <label>Sections</label><br />
                                <select type="text" class=" multiselect" multiple="multiple" role="multiselect" id="sections">          
                                  <?php foreach($this->Section as $data) { ?>
                                      <option value="<?php echo $data['c_bottomline']; ?>" ><?php echo $data['c_bottomline']; ?></option>
                                  <?php } ?>
                                </select> 
                            </div>        
                        </div><!-- row -->
                      <hr class="filterHR" />
                        <div class="row">
                          <div class="col-md-4 col-md-offset-4">
                              <input id="apply_filters" type="submit" class="greenBTNFilter" value="Apply Filters">
                            </div><!-- col-md-4 -->
                        </div><!-- row -->
                    </div><!-- filterDiv -->
                    <div class="col-md-12 no-padding">
                    <table width="100%" border="1" id="EntitityListing" class="table table-striped table-bordered table-hover">
                          <thead>
                              <tr>
                                <th class="text-center no-sort" width="">SR</th>
                                <th class="text-center no-sort" width="">GT-ID</th>
                                <th class="" width="">Name</th>
                                <th class="" width="">Status</th>
                                <th style ="display: none;">Name Code</th>
                              </tr>
                          </thead><!-- thead -->
                          <tbody id="staff_listing_body">
                            <?php
                                $i=1; 
                                foreach ($this->staffData as $data) { ?>
                              <tr id="row-<?php echo $data['gt_id']; ?>">
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-center"><?php echo $data['gt_id']; ?></td>
                                <td class="data-gt_id"><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: <?php echo $data['gt_id']; ?>" data-pin-nopin="true" class="anchorCol"><?php echo $data['abridged_name']; ?></a></td>
                                <td class="text-center"><?php echo $data['staff_status_code']; ?></td>
                                <td class="text-center" style="display: none;"><?php echo $data['name_code']; ?></td>
                              </tr>
                            <?php $i++; } ?>
                          </tbody>
                        </table><!-- ListingTable -->
                    </div><!-- col-md-12 -->
              </div><!-- LeftListing_ContentSection -->
          </div><!-- .LeftListing -->
      </div><!-- col-md-4 -->
      <div id="staffTIFA" class="col-md-8 paddingRight0" style="">
        
      </div><!-- col-md-9 -->
  </div><!-- row -->
</div><!-- container -->