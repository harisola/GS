	<div class="dark-red powerwidget" id="datatable-basic-init" data-widget-editbutton="false">
	  <header><h2> Position <small> List of position </small></h2></header>
		<div class="inner-spacer">
			<table class="table table-striped table-hover" id="positions">
			 <thead>
				<tr>
					<th>Staff</th>
					<th>Postion Title</th>
					<th>Primary Reporing to</th>
					<th>Secondary Reporting to</th>
					
				</tr>
			</thead>
			<tbody>
				<?php foreach( $results as $res ):  ?>
				<tr>
					<td>
					<?php if( $res["staffCode"] == '' ){ ?>
					Not Assigned!
					<?php }else{ ?>
					<?=$res["staffCode"];?>-<?=$res["staffName"];?>	
					<?php } ?>
					
					</td>
					<td><?=$res["title"];?></td>
					<td><?=$res["PrimaryR"];?></td>
					<td><?=$res["SecondaryR"];?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		   </table>
			
		
	</div>
	</div>
<script>

$(document).ready(function () {
	if ($('#positions').length) {
		var oTable = $('#positions').dataTable({
				"oLanguage": {
					"sSearch": "Search all columns:"                        
				},
				//"sDom": '<"search"fTlp><"bottom"><"clear">lrtip',
				"sDom": 'T<"clear">lfrtip',
				tableTools: {
					"sSwfPath": "<?php echo base_url()?>components/js/swf/copy_csv_xls_pdf.swf"
				},
				"bProcessing": true,
				//"bServerSide": true,
				"sScrollX": "100%",
				"bScrollCollapse": true,
				"iDisplayLength": 10,
				"sResponsive": true
			});                

            }
	});
</script>