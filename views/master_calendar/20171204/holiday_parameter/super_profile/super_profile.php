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
.contentArea {
	padding:0 20px;	
}
p.policy {
	font-size:16px;
}
h3.underline {
	display:inline-block;
	border-bottom:2px solid #888;
}
.contentArea div.text-center {
	margin-bottom:20px;	
}
ul.policyList {
    font-size: 16px;
    line-height: 28px;
}
ul.policyList li {
	line-height:30px;	
}
/* */
input[type="time"],
input[type="text"] {
	    width: 80%;
    height: 24px;
	padding:0 5px;
}
#example thead tr {
	display:;	
}
.DTFC_Cloned thead tr {
	
}
table.dataTable {
	margin-top:0 !important;	
}
table.table.table-striped.table-bordered.table-hover.dataTable.no-footer.DTFC_Cloned tbody td {
    background: #ececec;
}
#example_wrapper {
    padding: 0 20px;
}	
.SuperProfileArea {
    border: 1px solid #ccc;
    padding: 0;
}
.SuperProfileArea .headingArea {
    background: #a35555;
    padding: 10px;
    margin-bottom: 20px;
}
.SuperProfileArea .headingArea h2 {
    color: #fff;
    font-weight: normal;
    font-size: 18px;
    margin: 0;
}
.SuperProfileArea table td {
    padding: 10px 5px !important;
}
th.text-left.sorting.ui-state-default,
.DTFC_Cloned th.no-sort.text-center.sorting.ui-state-default,
th.text-left.ui-state-default,
.DTFC_Cloned th.no-sort.text-center.ui-state-default, 
.DTFC_Cloned th.no-sort.text-center.ui-state-default {
    background: #ececec !important;
}
input[type="button"].greenBTN, input[type="submit"].greenBTN {
    background: #1bbc9b;
    color: #fff;
    border: 1px solid #169d81;
    width: 28%;
    padding: 8px;
    font-size: 14px;
}
.row.nomargin {
	margin:0 !important;	
}
.modal-dialog {
    width: 450px;
    margin: 30px auto;
}
.TimeLineModal .modal-footer {
    float: left;
    width: 100%;
    padding: 0;
    text-align: center;
    padding-bottom: 10px;
    border-top: 1px solid #ccc;
    padding-top: 10px;
    margin-top: 5px;
}
.TimeLineModal input[type="text"] {
	width:100%;
	padding:15px 6px;	
}
.editable.editable-click {
    font-size: 14px;
    color: #000;
    border-bottom: dashed 1px #000000;
    font-weight: normal;
}
a.editable {
    font-size: 18px;
    font-weight: bold;
    color: #d87474;
    border-bottom: 1px solid;
}
a.editable:hover {
	text-decoration:none;	
}
</style>
<link id="main-style" href="/application/views/super_profile/style/super_profile.css" rel="stylesheet" type="text/css">
<script src="/application/views/super_profile/js/index.js"></script>
<div class="container">
	<div class="row">
    	<div class="col-md-12">
        	<div class="container-fluid">
              <div class="col-md-12 SuperProfileArea">
              <div class="modal fade TimeLineModal" id="NewSuperProfile" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">New Super Profile</h4>
                            </div>
                            <div class="modal-body">
                              <div class="row nomargin">
                                  <form>
                                    <div class="col-md-12" style="padding:10px 0;">
                                        <div class="col-md-4" style="padding-top:8px;">
                                            Super Profile Title
                                        </div><!-- col-md-3 -->
                                        <div class="col-md-8">
                                            <input type="text" placeholder="Super Profile Title" />
                                        </div><!-- col-md-9 -->
                                    </div><!-- col-md-12 no-padding -->
                                    <div class="col-md-12" style="padding:10px 0;">
                                        <div class="col-md-4" style="padding-top:8px;">
                                            Description
                                        </div><!-- col-md-3 -->
                                        <div class="col-md-8">
                                            <textarea></textarea>
                                        </div><!-- col-md-9 -->
                                    </div><!-- col-md-12 no-padding -->
                                  </form>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <input type="submit" class="greenBTN widthSmall" data-dismiss="modal" value="Add New Super Profile">
                            </div>
                          </div>
                          
                        </div>
                    </div><!-- SetHolidayParameter -->
              	<div class="headingArea"><h2>Super Profiles <a href="#" class="absoluteBtn " data-toggle="modal" data-target="#NewSuperProfile" >Add new Profile</a></h2></div>
                <table width="" border="1" id="example" class="table table-striped table-bordered table-hover" style="padding:0 20px">
                  <thead>
                      <tr>
                        <th class="text-left" width="300">TT Profiles</th>
                        <th class="no-sort text-center" width="200">TT Profile Timing</th>
                        <th class="no-sort text-center" width="200">Ramadan</th>
                        <th class="no-sort text-center" width="200">June</th>
                        <th class="no-sort text-center" width="200">July</th>
                        <th class="no-sort text-center" width="200">Early Off</th>
                        <th class="no-sort text-center" width="200">Saturdays</th>
                      </tr>
                  </thead><!-- thead -->
                  <!-- thead -->
                  <tbody>
                      <tr class="">
                        <td class="text-left"><strong>Teachers - NC</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="bottom" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="bottom" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td class=""><strong>Lead Teachers SC</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td class=""><strong>Subject Heads</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td class=""><strong>TeachersSC</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td class=""><strong>Year Tutors/Lead Teachers NC</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td class=""><strong>Faculty Resource NC (Edu Tech /Sports/ Art)</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>VP/HM</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Coordinators</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Facilitators</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Year Tutors SC</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Faculty Resource (Edu Tech /Sports/ Discvy Centre/ Art )</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Librarians</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Generosity Female</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Admin Resource (library Asst/ Sci Lab Asst)</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="bottom" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="bottom" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="bottom" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="bottom" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="bottom" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="bottom" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="bottom" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="bottom" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="bottom" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="bottom" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Generosity Male</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Admin/ Finance</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="bottom" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="bottom" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="bottom" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="bottom" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="bottom" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="bottom" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="bottom" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="bottom" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="bottom" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="bottom" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Admin/ SIS/Tamkeen</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Domestic Staff- Female</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Domestic StaffMale</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Security Wardens</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Security Guards</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Operations</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Security Guards</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                      <tr class="">
                        <td><strong>Custom</strong></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding">07:30 AM</div><div class="col-md-2">-</div><div class="col-md-5 no-padding">04:00 PM</div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                        <td class="text-center"><div class="col-md-12 no-padding"><div class="col-md-5 no-padding"><a href="#" class="MonIN" data-placement="top" data-title="Morning">00:00</a></div><div class="col-md-2">-</div><div class="col-md-5 no-padding"><a href="#" class="MonOUT" data-placement="top" data-title="Afternoon">00:00</a></div></div></td>
                      </tr>
                  </tbody>
                </table>
              </div>
			</div>
<?php /* ?>
        	<table border="1" id="example" class="table table-striped table-bordered table-hover">
	                  <thead>
	                      <tr>
	                        <th class="text-center no-sort" width=""><input type="checkbox" value="" id="checkAll"></th>
	                        <th class="" width="">TT Profiles</th>
                            <th class="text-center" width="">Allocated to</th>
                            <th class="text-center" width="">Allocated to</th>
                            <th class="text-center" width="">Allocated to</th>
                            <th class="text-center" width="">Allocated to</th>
                            <th class="text-center" width="">Allocated to</th>
                            <th class="text-center" width="">Allocated to</th>
                            <th class="text-center" width="">Allocated to</th>
                            <th class="text-center" width="">Allocated to</th>
                            <th class="text-center" width="">Allocated to</th>
                            <th class="text-center" width="">Allocated to</th>
                            <th class="text-center" width="">Allocated to</th>
                            <th class="text-center" width="">Allocated to</th>
                          </tr>
	                  </thead><!-- thead -->
					  <tbody>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Teachers - NC</strong></td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Lead Teachers SC</strong></td>
	                        <td class="text-center">22</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Subject Heads</strong></td>
	                        <td class="text-center">29</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Teachers - SC</strong></td>
	                        <td class="text-center">10</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Year Tutors/Lead Teachers NC</strong></td>
	                        <td class="text-center">51</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                          </tr>
	                      <tr class="Fence">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Faculty Resource NC (Edu Tech /Sports/ Art)</strong></td>
	                        <td class="text-center">20</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>VP/HM</strong></td>
	                        <td class="text-center">50</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Coordinators</strong></td>
	                        <td class="text-center">10</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Facilitators</strong></td>
	                        <td class="text-center">25</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Year Tutors SC</strong></td>
	                        <td class="text-center">15</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Faculty Resource (Edu Tech /Sports/ Discvy Centre/ Art )</strong></td>
	                        <td class="text-center">52</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Librarians</strong></td>
	                        <td class="text-center">7</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Generosity Female</strong></td>
	                        <td class="text-center">25</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Admin Resource (library Asst/ Sci Lab Asst)</strong></td>
	                        <td class="text-center">22</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" name="staffCheck" class="checkItem" value=""></td>
	                        <td><strong>Part Time</strong></td>
	                        <td class="text-center">20</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                            <td class="text-center">12</td>
                          </tr>
	                  </tbody>
	                </table>
					<?php */ ?>
        </div><!-- col-md-12 -->
    </div><!-- row -->
    
    
    
    <hr />
    <hr />
	
    