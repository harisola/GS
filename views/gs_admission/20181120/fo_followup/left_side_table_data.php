<style> tr.redAlert { background:#fbdfdf !important; }</style>

<?php
if(!empty($followUpLists)){
$countFollowup = count( $followUpLists );
}else{
$countFollowup=0;
}

if(!empty($CommunicationLists)){
$countComm = count( $CommunicationLists );
}else{
$countComm=0;
}
if(!empty($AllApplicantLists)){
$countAll = count( $AllApplicantLists );
}else{
$countAll=0;
}
?>

<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#FollowUpTab">Follow Up (<?=$countFollowup;?>)</a></li>
	<li><a data-toggle="tab" href="#CommunicationTab">Communication (<?=$countComm;?>)</a></li>
	<li><a data-toggle="tab" href="#AllApplicants">All Applicants Reloaded (<?=$countAll;?>)</a></li>
</ul><!-- nav-tabs -->
<div class="tab-content">
<div id="FollowUpTab" class="tab-pane fade in active">
	
		<table id="AdmissionFormListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
		  <thead> 
			<tr> 
				<th width="" class="text-center">Form #</th> 
				 <th width="">Applicant Name<br /><small>Submission Date</small></th> 
				 <th width="">Grade Name </th> 
				 <th width="">Father Name<br /><small>Father/Mother Mobile</small></th> 
				 <th width="" class="text-center no-sort">Current<br />Standing</th>
				 <th width="" class="text-center">Current Status</th>
			  </tr>
			</thead>
			<tfoot>
			<tr>
			<td colspan="5">Filter list by Current Standing</td>
			</tr>
			</tfoot>
		  <tbody> 
		  <?php //var_dump($followUpLists); 
		  if(!empty($followUpLists)){?>
			<?php foreach( $followUpLists as $fl ){ ?>
				<?php 
				if( $fl["day_passed"] > 2 ){
					$redClass = "grayAlert";
				}else{
					$redClass = "";
				} 
				?>
				<tr class="<?=$redClass;?>">
								   
			  
				<td class="text-center"><?php echo str_pad( $fl["form_no"],3,"0",STR_PAD_LEFT); ?></td>
				<td><a href="#" class="followup_row" data-id="followup_<?=$fl["form_id"];?>_<?=$fl["current_standing"];?>" ><?=$fl["applicant_name"];?></a><br /><small>
				<?php echo date("j-F-Y", strtotime( $fl["form_submission_date"] ) );?>
				<i><?=$fl["day_diff"];?></i></small></td>
				<td><?=$fl["grade_name"];?></td>
				<td><?=$fl["father_name"];?><br /><small><?=$fl["father_mobile"];?> / <?=$fl["father_mobile"];?></small></td>
				<td class="text-center"><?=$fl["current_standing"];?></td>
				<td class="text-left"><?=$fl["current_status_1"];?> </td>
			  </tr>
			  <?php } ?>
			   <?php } ?>
		   
			 
		
		</tbody> 
		</table><!-- StaffListing -->
	</div><!-- FollowUpTab -->
	<div id="CommunicationTab" class="tab-pane fade">
		<div class="absoluteDrop col-md-6">
			<select required class="">
			  <option value="" disabled selected>Filter list by Current Standing</option>
			  <option value="">Assessment Only</option>
			  <option value="">Assessment & Discussion</option>
			  <option value="">Discussion Only</option>
			  <option value="">Offer</option>
			  <option value="">Billing</option>
			</select>
		</div><!-- absoluteDrop -->
	  <table id="CommunicationListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
		  <thead> 
			  <tr> 
				  <th width="" class="text-center">Form #</th> 
				  <th width="">Applicant Name<br /><small>Submission Date</small></th> 
				  <th width="">Grade Name </th> 
				  <th width="">Father Name<br /><small>Father/Mother Mobile</small></th> 
				  <th width="" class="text-center no-sort">Current<br />Standing</th>
				  <th width="" class="text-center">Current Status</th>
			  </tr>
		  </thead>
		  <tbody> 
			 
			<?php 
			
			
			
			
			//var_dump($AllApplicantLists); 
			
			if(!empty($CommunicationLists)){ ?>
			
			<?php foreach( $CommunicationLists as $fl ){ ?>
			  <tr>
				<td class="text-center"><?php echo str_pad( $fl["form_no"],3,"0",STR_PAD_LEFT); ?></td>
				<td><a href="#" class="followup_row" data-id="communication_<?=$fl["form_id"];?>_<?=$fl["current_standing"];?>" ><?=$fl["applicant_name"];?></a><br /><small>
				<?php echo date("j-F-Y", strtotime( $fl["form_submission_date"] ) );?>
				<i><?=$fl["day_diff"];?></i></small></td>
				<td><?=$fl["grade_name"];?></td>
				<td><?=$fl["father_name"];?><br /><small><?=$fl["father_mobile"];?> / <?=$fl["father_mobile"];?></small></td>
				<td class="text-center"><?=$fl["current_standing"];?></td>
				<td class="text-left"><?=$fl["current_status_1"];?> </td>
			  </tr>
			  <?php } ?>
			   <?php } ?>									 
		   
		 </tbody> 
		</table><!-- StaffListing -->
	</div><!-- CommunicationTab -->
	<div id="AllApplicants" class="tab-pane fade">
		<div class="absoluteDrop col-md-6">
			<select required class="">
			  <option value="" disabled selected>Filter list by Current Standing</option>
			  <option value="">Assessment Only</option>
			  <option value="">Assessment & Discussion</option>
			  <option value="">Discussion Only</option>
			  <option value="">Offer</option>
			  <option value="">Billing</option>
			</select>
		</div><!-- absoluteDrop -->
		<?php //var_dump($AllApplicantLists); ?>
	  <table id="AllApplicantList" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
		  <thead> 
			  <tr> 
				  <th width="" class="text-center">Form #</th> 
				  <th width="">Applicant Name<br /><small>Submission Date</small></th> 
				  <th width="">Grade Name </th> 
				  <th width="">Father Name<br /><small>Father/Mother Mobile</small></th> 
				  <th width="" class="text-center no-sort">Current<br />Standing</th>
				  <th width="" class="text-center">Current Status</th>
			  </tr>
		  </thead>
		  <tbody> 
		   <?php //var_dump($AllApplicantLists); 
			if( !empty($AllApplicantLists) ){ ?>
			<?php foreach( $AllApplicantLists as $fl ){ ?>
			  <tr>
				<td class="text-center"><?php echo str_pad( $fl["form_no"],3,"0",STR_PAD_LEFT); ?></td>
				<td><a href="#" class="followup_row" data-id="allApplications_<?=$fl["form_id"];?>_<?=$fl["current_standing"];?>" ><?=$fl["applicant_name"];?></a><br /><small>
				<?php echo date("j-F-Y", strtotime( $fl["form_submission_date"] ) );?>
				<i><?=$fl["day_diff"];?></i></small></td>
				<td><?=$fl["grade_name"];?></td>
				<td><?=$fl["father_name"];?><br /><small><?=$fl["father_mobile"];?> / <?=$fl["father_mobile"];?></small></td>
				<td class="text-center"><?=$fl["current_standing"];?></td>
				<td class="text-left"><?=$fl["current_status_1"];?> </td>
			  </tr>
			  <?php }  ?>
			   <?php } ?>				
		  </tbody> 
		</table><!-- StaffListing -->
	</div><!-- AllApplicants -->
</div><!-- tab-content -->
<script>
$(document).ready(function() { 
$('#AllApplicantList').dataTable();
$('#CommunicationListing').dataTable();
$('#AdmissionFormListing').DataTable( {
	initComplete: function () {
	this.api().columns().every( function () {
		
	var column = this;
	var select = $('<select style="position: absolute;right: 31px;top: -54px;width: 250px;"><option value="">Filter list by Current Standing</option></select>')
	.appendTo( $( column.footer() ).empty() ).on( 'change', function () {
		
	var val = $.fn.dataTable.util.escapeRegex( $(this).val() );
		column.search( val ? '^'+val+'$' : '', true, false ).draw();
	});

	column.data().unique().sort().each( function ( d, j ) {
	select.append( '<option value="'+d+'">'+d+'</option>' )
	} );
	
	} );
	}
});
  
  
});
</script>