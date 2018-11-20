<div class="container">

    <div class="row">
    	<div class="col-md-4 BrowsingList" style="">
	    	<div class="LeftListing" style="">
            	
                <div class="LeftListing_ContentSection">
                	<div class="headingArea"><h2>Holiday<a href="#" class="absoluteBtn">Create Holiday Category</a></h2></div>
                	<table width="100%" border="1" id="Event_Cat_Table2" class="table table-striped table-bordered table-hover">
	                  <thead>
	                      <tr>
	                        <th class="text-center no-sort" width="">SR</th>
	                        <th class="" width="">Holiday title</th>
                            <th class="no-sort text-center" width="">Short</th>
                          </tr>
	                  </thead><!-- thead -->
					 <tbody>
					 <?php if( !empty($Events) ) : ?>
					 <?php foreach($Events as $e ): ?>
	                      <tr class="Event_Category_Row" id="Row_<?=$e["ID"];?>">
	                        <td class="text-center"><?=$e["ID"];?></td>
	                        <td><a href="#" class=""><?=$e["cat_name"];?></a></td>
                            <td class="text-center"><?=$e["cat_short_title"];?></td>
                          </tr>
					<?php endforeach; ?>
					<?php else: ?>
						<tr class="selected" id="Row_0">
	                    <td class="text-center" colspan="4" >No Record Found!</td>
	                    </tr>
					<?php endif; ?>
					
	               
	                </table><!-- ListingTable -->
	            </div><!-- LeftListing_ContentSection -->
	        </div><!-- .StudentListing -->
	    </div><!-- col-md-4 -->
		
		<form action="<?=base_url();?>index.php/master_calendar/holiday_parameter_ajax/Set_Variables" method="POST" name="issuance" id="issuance" class="issuance">
		
	    <div class="col-md-8" style="padding-right:25px;">
	    	 	<div class="col-md-12 ProfileDetail" id="Right_Side" style="display:none;">
            	<div class="headingArea"><h2>Add new Holiday <span class="pull-right" id="Close_Form" style="cursor: pointer;">Close</span></h2> </div>
                <div class="col-md-12 no-padding">
                	<form>
                    	<div class="col-md-12 paddingBottom20">
                        	<div class="col-md-6 no-padding">
                                <div class="col-md-4 text-right" style="padding-top: 5px;">
                                    Holiday title
                                </div><!-- col-md-4 -->
                                <div class="col-md-8 no-padding">
								<input type="hidden" name="OpType" id="OpType" value="1" />
								<input type="hidden" name="Holiday_ID" id="Holiday_ID" value="0" />
                                    <input type="text" placeholder="Holiday title" name="Holiday_Parameter" id="Holiday_Parameter" />
                                </div><!-- col-md-8 -->
                            </div><!-- col-md-6 no-padding -->
                            <div class="col-md-6 no-padding">
                                <div class="col-md-4 text-right" style="padding-top: 5px;">
                                    Holiday short title
                                </div><!-- col-md-4 -->
                                <div class="col-md-8 no-padding">
                                    <input type="text" placeholder="Holiday Short Title" name="Holiday_Short_Title" id="Holiday_Short_Title" />
                                </div><!-- col-md-8 -->
                            </div><!-- col-md-6 no-padding -->
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingBottom20">
                        	<div class="col-md-6 no-padding">
                                <div class="col-md-4 text-right" style="padding-top: 5px;">
                                    Holiday description
                                </div><!-- col-md-4 -->
                                <div class="col-md-8 no-padding">
                                    <textarea placeholder=""  rows="6" name="Holiday_Description" id="Holiday_Description"></textarea>
                                </div><!-- col-md-8 -->
                            </div><!-- col-md-6 no-padding -->
                        </div><!-- col-md-12 -->
                    </form>
                </div><!-- col-md-6 no-padding-->
                <div class="col-md-12 borderTop text-center">
                	<input type="button" name="clear" class="grayBTN widthSmall" id="greenBTN3" value="Clear"> 
					<input type="submit" name="submit" class="greenBTN widthSmall" id="greenBTN" value="Add new Holiday">
                </div><!-- col-md-12 -->
            </div><!-- col-md-12 -->
	   
            </div>
	    
		</form>
		</div>
	</div>
   <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>  
	<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>
</div>

<link id="main-style" href="<?=base_url();?>components/master_calenar/super_profile/style/super_profile.css" rel="stylesheet" type="text/css">

<script src="<?=base_url();?>components/master_calenar/super_profile/js/index.js"></script>
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
.ProfileDetail input[type="text"] {
	padding: 15px 5px !important;	
}
</style>

