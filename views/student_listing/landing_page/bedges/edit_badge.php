
<div class="col-md-12" style="padding-bottom:0;">
<div class="MaroonBorderBox">
<?php //var_dump( $Badge_Info ); ?>
<div class="inner" style="">
<div class="col-md-12 padding">
<div class="portlet" id="AddNewBadgeArea">
<form action="<?=base_url();?>index.php/student_listing/badges_managment/Edit_Badges_Assign" method="POST" name="eissuance" id="eissuance" class="eissuance">

<input type="hidden" name="Badge_id" id="Badge_id" value="<?=$Badge_Info['ID'];?>" />

<h3 style="margin-bottom:20px;">Add a new Badge <a href="#" id="BackBadge">Back to Badges</a></h3>
<div class="col-md-5 no-padding border-right extrapadding">
<div class="col-md-12 paddingBottom15">
<div class="col-md-3 paddingTop5 text-right">
Title
</div><!-- col-md-3 -->
<div class="col-md-9">
<input type="text" name="ebadge_title" id="ebadge_title" value="<?=$Badge_Info['bedge_title'];?>" />
</div><!-- col-md-9 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom15">
<div class="col-md-3 paddingTop5 text-right">
Code
</div><!-- col-md-3 -->
<div class="col-md-9">
<input type="text" name="ebadge_code" id="ebadge_code" value="<?=$Badge_Info['bedge_code'];?>" />
</div><!-- col-md-9 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom15">
<div class="col-md-3 paddingTop5 text-right">
Expiry
</div><!-- col-md-3 -->
<div class="col-md-9">
<input type="date" placeholder="Expiry date" name="ebadge_expiry" id="ebadge_expiry" value="<?=$Badge_Info['bedge_expiry'];?>" />
</div><!-- col-md-9 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom15">
<div class="col-md-3 paddingTop5 text-right">
Color
</div><!-- col-md-3 -->
<div class="col-md-9">
<input type="color" value="<?=$Badge_Info['bedge_color'];?>" name="ebadge_color" id="ebadge_color" />
</div><!-- col-md-9 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom15">
<div class="col-md-3 paddingTop5 text-right">
Priority
</div><!-- col-md-3 -->
<div class="col-md-9">
<select name="ebadge_priority" id="ebadge_priority">
<option value="1" <?php if($Badge_Info['bedge_priority']==1){ echo "selected";}?>>1</option>
<option value="2" <?php if($Badge_Info['bedge_priority']==2){ echo "selected";}?>>2</option>
<option value="3" <?php if($Badge_Info['bedge_priority']==3){ echo "selected";}?>>3</option>
<option value="4" <?php if($Badge_Info['bedge_priority']==4){ echo "selected";}?>>4</option>

</select>
</div><!-- col-md-9 -->
</div><!-- col-md-12 -->
<div class="col-md-12 paddingBottom15">
<div class="col-md-3 text-right">
Description
</div><!-- col-md-3 -->
<div class="col-md-9">
<textarea rows="5" name="ebadge_des" id="ebadge_des"><?=$Badge_Info['bedge_description'];?></textarea>
</div><!-- col-md-9 -->
</div><!-- col-md-12 -->
</div><!-- col-md-5 no-padding -->
<div class="col-md-7">
<table width="100%" border="1" id="BadgeAllocation1" class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th class="text-center no-sort" width=""><input type="checkbox" name="empty" value="0" /></th>
<th class="text-center" width="">GS-ID</th>
<th class="" width="">Name</th>
<th class="no-sort text-center" width="">Badges</th>
</tr>
</thead><!-- thead -->
<tbody>

<?php  
//var_dump($Grade_Section_Student);
if( !empty( $Grade_Section_Student )){
	
	foreach( $Grade_Section_Student as $ss ){ ?>
	<?php  if($ss["Badge_Color"] != NULL ){ $checked="checked"; $selected="selected"; }else{ $checked=""; $selected=""; } ?>
	<tr class="<?=$selected;?>">
		<td class="text-center"><input type="checkbox" value="<?=$ss["Student_Id"];?>" name="students[]" <?=$checked;?> /></td>
		<td class="text-center"><?=$ss["GS_ID"];?></td>
		<td class=""><?=$ss["Abridged_Name"];?></td>
		<td class="text-center">
		<?php 
			if($Student_Selected){  ?>
			<span class="badgeShow" style="background:<?=$ss["Badge_Color"];?>"><?=$ss["Badge_Code"];?></span>
			 <?php }else{ ?>
			
			 <?php }
		?>
			
		</td>
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
<input type="submit" class="centerGreenBtn" value="Update Badge" id="btn_edit_badge" />
</div><!-- col-md-12 -->
</form>
</div>
</div><!-- col-md-12 -->

</div><!-- inner -->
</div><!-- .MaroonBorderBox -->
</div><!-- col-md-12 -->

<script>
$(document).ready(function(){

     
            $('#ebadge_expiry').datepicker({
                dateFormat: 'yy-mm-dd',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>'
            });
      
  
  	$('#BadgeAllocation1').dataTable({
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