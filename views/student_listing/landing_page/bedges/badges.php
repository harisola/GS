<div class="col-md-12" style="padding-bottom:0;">
	<div class="MaroonBorderBox">

	<div class="inner" style="">
		<div class="col-md-12 padding">
			<div class="portlet" id="ListBadges">
				<h3>All badges <a href="#" class="AddNewBadge ButtonAnchor">Add New Badge</a></h3>
				<table width="100%" border="1" id="BadgeList" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="text-center no-sort" width="">&nbsp;</th>
						<th class="" width="">Badge Title</th>
						<th class="" width="">Assigned to</th>
						<th class="no-sort text-center" width="">Action</th>
					</tr>
				</thead><!-- thead -->
				<tbody>
				<?php if( !empty($Bedge_Info) ) { ?>
				<?php foreach( $Bedge_Info as $BI ){ ?>
					<tr class="">
						<td class="text-center"><span class="badgeShow" style="background:<?=$BI["bedge_color"];?>"><?=$BI["bedge_code"];?></span></td>
						<td class=""><?=$BI["bedge_title"];?></td>
						<td class="">  </td>
						<td class="text-center">
							<a href="#" id="edit_<?=$BI["ID"];?>"   class="Edit_Badges">Edit</a> | 
							<a href="#" id="assign_<?=$BI["ID"];?>" class="Assign_Badges">Assign</a>
						</td>
					</tr>	
				<?php } ?>
				<?php } ?>
					
				
				</tbody>
				</table><!-- ListingTable -->

			</div>
		</div>
		</div>
	</div>
</div>


<script>
$(document).ready(function(){
	
	     
            $('#badge_expiry').datepicker({
                dateFormat: 'yy-mm-dd',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>'
            });
			
			
			
$('#BadgeList').dataTable({
      "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
    "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
    "iDisplayLength": 10,
	"bLengthChange": false,
	"bInfo" : false,
	
	
});
  
  
  
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
