
<div class="col-md-12" style="padding-bottom:0;">
<div class="MaroonBorderBox">
<?php //var_dump( $Grade_Section_Student ); ?>
<div class="inner" style="">
<div class="col-md-12 padding">
<div class="portlet" id="AddNewBadgeArea">
<form action="<?=base_url();?>index.php/student_listing/badges_managment/Create_Badges_Assign" method="POST" name="issuance" id="issuance" class="issuance">

<input type="hidden" name="Grade_id" id="Grade_id" value="<?=$Grade_id;?>" />
<input type="hidden" name="Section_id" id="Section_id" value="<?=$Section_id;?>" />
<input type="hidden" name="Current_Academic" id="Current_Academic" value="<?=$Current_Academic;?>" />
<input type="hidden" name="Current_Term" id="Current_Term" value="<?=$Current_Term;?>" />



<h3 style="margin-bottom:20px;">Add a new Badge <a href="#" id="BackBadge">Back to Badges</a></h3>
<div class="col-md-5 no-padding border-right extrapadding">
<div class="col-md-12 paddingBottom15">
<div class="col-md-3 paddingTop5 text-right">
Title
</div><!-- col-md-3 -->
<div class="col-md-9">
<input type="text" placeholder="Badge title" name="badge_title" id="badge_title" />
</div><!-- col-md-9 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom15">
<div class="col-md-3 paddingTop5 text-right">
Code
</div><!-- col-md-3 -->
<div class="col-md-9">
<input type="text" placeholder="Badge code" name="badge_code" id="badge_code" />
</div><!-- col-md-9 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom15">
<div class="col-md-3 paddingTop5 text-right">
Expiry
</div><!-- col-md-3 -->
<div class="col-md-9">
<input type="date" placeholder="Expiry date" name="badge_expiry" id="badge_expiry" />
</div><!-- col-md-9 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom15">
<div class="col-md-3 paddingTop5 text-right">
Color
</div><!-- col-md-3 -->
<div class="col-md-9">
<input type="color" value="#ff0000" name="badge_color" id="badge_color" />
</div><!-- col-md-9 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom15">
<div class="col-md-3 paddingTop5 text-right">
Priority
</div><!-- col-md-3 -->
<div class="col-md-9">
<select name="badge_priority" id="badge_priority">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select>
</div><!-- col-md-9 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom15">
<div class="col-md-3 text-right">
Description
</div><!-- col-md-3 -->
<div class="col-md-9">
<textarea rows="5" name="badge_des" id="badge_des"></textarea>
</div><!-- col-md-9 -->
</div><!-- col-md-12 -->
</div><!-- col-md-5 no-padding -->
<div class="col-md-7">
<table width="100%" border="1" id="BadgeAllocation" class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th class="text-center no-sort" width=""><input type="checkbox" name="empty" value="0" /></th>
<th class="text-center" width="">GS-ID</th>
<th class="" width="">Name</th>
<!--th class="no-sort text-center" width="">Badges</th -->
</tr>
</thead><!-- thead -->
<tbody>

<?php  
//var_dump($Grade_Section_Student);
if( !empty( $Grade_Section_Student )){
	foreach( $Grade_Section_Student as $ss ){ ?>
	<tr class="">
		<td class="text-center"><input type="checkbox" value="<?=$ss["Student_Id"];?>" name="students[]" /></td>
		<td class="text-center"><?=$ss["GS_ID"];?></td>
		<td class=""><?=$ss["Abridged_Name"];?></td>
		
		<!--td class="text-center">
			<span class="ProfileB text-center">G</span>
			<span class="ProfileC text-center">M</span>
			<span class="ProfileD text-center">A</span> 
			<span class="ProfileGray text-center">.</span>
		</td -->
	</tr>
	<?php } 
	
}else{ ?>
<tr>
	<td class="text-center" colspan="4"> No Record Found!</td>
</tr>
<?php } ?>

</tbody>
</table><!-- ListingTable -->
</div><!-- col-md-7 -->
<hr />
<div class="col-md-12 text-center">
<input type="submit" class="centerGreenBtn" value="Add New Badge" id="create_badge" />
</div><!-- col-md-12 -->
</form>
</div>
</div><!-- col-md-12 -->

</div><!-- inner -->
</div><!-- .MaroonBorderBox -->
</div><!-- col-md-12 -->

<script>
$(document).ready(function(){
  
  // Regular datepicker
        if ($('#badge_expiry').length) {
            $('#badge_expiry').datepicker({
                dateFormat: 'yy-mm-dd',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>'
            });
        }
  	$('#BadgeAllocation').dataTable({
      "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
    "iDisplayLength": 10,
	"bLengthChange": false,
	"bInfo" : false,
  });
  
  
  
});
  
</script>