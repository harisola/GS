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
	width: 8%;
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

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
    width: 50%;
    margin: 0 auto 20px;
}

.tabletdBorderRight {
	border-right: 1px solid #666;
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





<link id="main-style" href="<?php echo base_url('components/gs_theme/css/tt_profile/TTProfiles.css') ?>" rel="stylesheet" type="text/css">
<div class="container paddingTop55">
    <div class="row breadcrumb">
        <div class="col-md-12">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Staff</a></li>
                <li>Profile Allocation</li>
            </ul>  
        </div><!-- col-md-12 -->
    </div><!-- row breadcrumb -->
</div><!-- container -->
<div class="container">
	<div class="row">
    	<div class="col-md-4 BrowsingList" style="">
    	  <div class="replace_table">
	    	<div class="LeftListing" style="">
                <div class="LeftListing_ContentSection">
                	<div class="headingArea"><h2>Staff List </h2></div>
                	<table width="100%" border="1" id="TTListing" class="table table-striped table-bordered table-hover">
	                  <thead>
	                      <tr>
	                        <th class="text-center" width=""><input type="checkbox" id="checkAll"></th>
	                        <th class="" width="">Staff Name<br /><small>Dept / Designation</small></th>
                            <th class="text-left" width="">Name Code<br /><small>GT ID</small></th>
                            <th class="text-left" width="">Profile</th>
                          </tr>
	                  </thead><!-- thead -->
					  <tbody>
					  
					  	<?php foreach($staff as $staff_list)  { ?>

					  	<?php $found = 0; ?>
					  	  
					  	  	<?php foreach($staff_allocation as $staff_allocate)  { ?>

					  	  		<?php if($staff_allocate->staff_id == $staff_list->id) { ?>	

							  	  <tr class="">
			                        <td class="text-center"><input type="checkbox" class="staffCheck" value="<?php echo $staff_list->id ?>" disabled /></td>
			                        <td><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-pin-nopin="true" class="anchorCol select-staff" data-id="<?php echo $staff_list->id ?>" data-profile="<?php echo $staff_allocate->profile_id ?>" data-staff_name="<?php echo $staff_list->abridged_name ?>" data-profile_type="<?php echo $staff_allocate->profile_type_id ?>"><?php echo $staff_list->abridged_name ?></a><br /><small><?php echo $staff_list->department ?>/ <?php echo $staff_list->designation ?></small></td>
		                            <td class="text-left"><?php echo $staff_list->name_code ?><br/><small><?php echo $staff_list->gt_id ?></small></td>
		                            <td class="text-left"><?php echo $staff_allocate->profile_name ?></td>
		                          </tr>

		                          <?php $found = 1; ?>
                          		<?php } ?> <!-- End IF -->

                          	<?php } ?> <!-- End Staff Allocate -->

                          	<?php if($found == 0) { ?>

                          		<tr class="">
			                        <td class="text-center"><input type="checkbox" class="staffCheck" value="<?php echo $staff_list->id ?>"></td>
			                        <td><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" data-pin-nopin="true" class="anchorCol"><?php echo $staff_list->abridged_name ?></a><br /><small><?php echo $staff_list->department ?>/ <?php echo $staff_list->designation ?></small></td>
		                            <td class="text-left"><?php echo $staff_list->name_code ?><br/><small><?php echo $staff_list->gt_id ?></small></td>
		                            <td class="text-left">-</td>
		                        </tr>

                          	<?php } ?> <!-- End Found -->
                          
					  	<?php } ?> <!-- End Staff List -->

					  	<?php /* 
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem" checked="checked"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Muhammad Ghaffar</a><br />
	                        <small>Starter Section / Academic Coordinator</small></td>
	                        <td class="text-left">MGG<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem" checked="checked"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Muhammad Hashim</a><br />
	                        <small>Starter Section / Lead Teacher</small></td>
	                        <td class="text-left">MHK<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem" checked="checked"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Khalil Ahmed</a><br />
	                        <small>Starter Section / Year Tutor</small></td>
	                        <td class="text-left">KAA<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Muhammad Umer</a><br />
	                        <small>Starter Section / Facilitator</small></td>
	                        <td class="text-left">MUU<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="Fence">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Muhammad Ayaz</a><br /><small>Starter Section / Headmistress</small></td>
	                        <td class="text-left">MAM<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Muhammad Imran</a><br /><small>Starter Section / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Ayesha Khatoon</a><br /><small>Starter Section / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Noor Badshah</a><br /><small>Starter Section / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Muhammad Ali</a><br /><small>Starter Section / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Mirza Asim Mehmood</a><br /><small>Starter Section / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Adeela Zeeshan</a><br /><small>Starter Section / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Afshan Imran</a><br /><small>Starter Section / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Abdul Tawab</a><br /><small>Starter Section / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
                          <tr class="selected">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Fatma Ajmal Khan</a><br /><small>Starter Section / Headmistress</small></td>
                            <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Gul-e-Zehra</a><br /><small>Starter Section / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Khushbakht Sabahat</a><br />
	                          <small>DI / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Lubna Qadri</a><br />
	                          <small>DI / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Maliha Rafi Khan</a><br />
	                          <small>SIS / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Ayesha Siddiqui</a><br />
	                          <small>SIS / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Afsheen Faisal</a><br />
	                          <small>SIS / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Muhammad Anees</a><br /><small> <small>Software</small> / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Abbas Fazal Masih</a><br /><small> <small>Software</small> / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Nadia Faisal</a><br />
	                          <small>Software / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
	                      <tr class="">
	                        <td class="text-center"><input type="checkbox" class="checkItem"></td>
	                        <td><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: 12-123" data-pin-nopin="true" class="anchorCol">Nausheen Sohail</a><br /><small> <small>Software</small> / Headmistress</small></td>
	                        <td class="text-left">MSS<br /><small>14-156</small></td>
                            <td class="text-left">-</td>
                          </tr>
                          <?php */ ?>
	                  </tbody>
	                </table><!-- ListingTable -->
	            </div><!-- LeftListing_ContentSection -->
	          
	          </div><!-- .StudentListing -->
	        </div> <!-- Replace Table -->
	    </div><!-- col-md-4 -->
	    <div class="col-md-8" style="padding-right:25px;">
	    	<div class="col-md-12 ProfileDetail">
            	<div class="headingArea">
            	  <h2>Profile Allocation To Staff<strong></strong></h2>
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
                                    <option value="<?php echo $profile->id ?>" data-id="<?php echo $profile->profile_type_id ?>"><?php echo $profile->name  ?></option>
                                    <?php } ?>
                                    <!-- <option value="1">Custom</option>
                                    <option value="2">Part Time</option>
                                    <option value="0">Teachers - NC</option>
                                    <option value="0">Lead Teachers SC</option>
                                    <option value="0">Subject Heads</option>
                                    <option value="0">Teachers - SC</option>
                                    <option value="0">Generosity Female</option>
                                    <option value="0">Admin/ SIS/Tamkeen</option>
                                    <option value="0">Admin/ Finance</option>
                                    <option value="0">Security Guards</option>
                                    <option value="0">Operations</option>
                                    <option value="0">Security Guards</option>
                                    <option value="0">Domestic Staff- Female</option>
                                    <option value="0">Domestic Staff- Male</option> -->
                                </select>
                            </div><!-- col-md-8 -->
                        </div><!-- col-md-12 -->
                        <br /><br /><br /><br />
                       
						<div id="get_profile"></div>
                    </form>
                </div><!-- col-md-6-->
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
      // $('.checkItem').attr("checked",true);
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
