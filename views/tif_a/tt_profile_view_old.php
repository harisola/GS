<style>
.container {
	width: 100% !important;
}

.alert {
margin:0 20px 20px;
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

/*#loading{
	display: none;
}
*/


.grayedout {
	color:#adaaaa;
}
.ProfileTimingTable {
	    border: 1px solid #ccc;
}
.ProfileTimingTable thead {
	
}
.ProfileTimingTable thead tr {
	    background: #eaeaea;
    height: 34px;
	border-top:1px solid #ccc;
}
.ProfileTimingTable thead tr td {
	text-align:center;
	color:#000;
}
.ProfileTimingTable tbody {
	
}
.ProfileTimingTable tbody tr {
	    height: 54px;
    border-bottom: 1px solid #ccc;
}
.ProfileTimingTable tbody tr:last-child {
	/* border-bottom:0 none;	*/
}
.ProfileTimingTable tbody tr:first-child {
	border-top:1px solid #ccc;;	
}
.ProfileTimingTable tbody tr td {
	text-align:center;
}
.ProfileTimingTable tbody tr td:first-child {
	border-right:1px solid #888;	
	background:#eaeaea;
}
.ProfileTimingTable tbody tr td input {
	width:90% !important;	
}



.customTimingTable {
	    border: 1px solid #ccc;
}
.customTimingTable thead {
	
}
.customTimingTable thead tr {
	    background: #eaeaea;
    height: 34px;
	border-top:1px solid #ccc;
}
.customTimingTable thead tr td {
	text-align:center;
	color:#000;
}
.customTimingTable tbody {
	
}
.customTimingTable tbody tr {
	    height: 54px;
    border-bottom: 1px solid #ccc;
}
.customTimingTable tbody tr:last-child {
	/* border-bottom:0 none;	*/
}
.customTimingTable tbody tr:first-child {
	border-top:1px solid #ccc;;	
}
.customTimingTable tbody tr td {
	text-align:center;
}
.customTimingTable tbody tr td:first-child {
	border-right:1px solid #888;	
	background:#eaeaea;
}
.customTimingTable tbody tr td input {
	width:90% !important;	
}

.StandTime tbody tr td:first-child {
	background:none;
	border:0 none;	
}

</style>


<link id="main-style" href="<?php echo base_url('components/gs_theme/css/tt_profile/TTProfiles.css') ?>" rel="stylesheet" type="text/css">
<div class="container">
	<div class="row">
    	<div class="col-md-4 BrowsingList" style="">

    		<div id="left-replace">
	    	<div class="LeftListing" style="">
            	
                <div class="LeftListing_ContentSection">
                	<div class="headingArea"><h2>Staff Profile<a href="javascript:void(0)" class="absoluteBtn" id="add-profile">Add new Profile</a></h2></div>
                	<table width="100%" border="1" id="TTListing" class="table table-striped table-bordered table-hover">
	                  <thead>
	                      <tr>
	                        <th class="text-center no-sort" width="">SR</th>
	                        <th class="" width="">Name</th>
                            <th class="no-sort text-center" width="">Allocations</th>
                          </tr>
	                  </thead><!-- thead -->
					  <tbody>
					  	<?php $count_staff = 1; ?>
					  	<?php foreach($profile as $profile) { ?>
	                      <tr class="" id="add_<?php echo $profile->id ?>">
	                        <td class="text-center"><?php echo $count_staff ?></td>
	                        <td><a href="javascript:void(0)"  id="profile_click" data-profile_id="<?php echo $profile->id?>"><?php echo $profile->name ?></a></td>
                            <td class="text-center"><?php echo $profile->staff_allocated ?></td>
                          </tr>
                          <?php $count_staff++; ?>
                          <?php } ?>

	                  </tbody>
	                </table><!-- ListingTable -->
	            </div><!-- LeftListing_ContentSection -->
	        </div><!-- .StudentListing -->
	        </div>
	    </div><!-- col-md-4 -->


	    <div class="view_add"></div>


	</div><!-- row -->



</div><!-- container -->
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.js"></script>
<script>
$('#checkAll').click(function () {    
    $(':checkbox.checkItem').prop('checked', this.checked);    
 });
</script>
