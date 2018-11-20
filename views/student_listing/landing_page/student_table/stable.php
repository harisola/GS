<table width="100%" border="1" id="EntitityListing" class="table table-striped table-bordered table-hover">
<thead>
  <tr>
	<th class="text-center no-sort" width="">SR</th>
	<th class="text-center no-sort" width="">Class</th>
	<th class="" width="">Name</th>
	<th class="text-center no-sort" width="">Att.</th>
	<th class="no-sort text-center" width="">Profiles</th>
	<th class="no-sort text-center" width="">Badges <a style="" href="#" id="BadgeAlloc">+</a> </th>
	<th class="no-sort text-center" width="">
		<img src="<?php echo base_url()?>components/student_listing/images/redBell.jpg" width="15" />
	</th>
  </tr>
</thead><!-- thead -->
<tbody><?=$table_view;?></tbody>
</table><!-- ListingTable -->
<script>
$(document).ready(function () {
$('[data-toggle="tooltip"]').tooltip();
	$('#EntitityListing').dataTable({
		"columnDefs": [ { "targets": 'no-sort',"orderable": false, } ],
		"aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
		"iDisplayLength": 50,
		"bLengthChange": false,"bSort" : false
	});
});  
</script>