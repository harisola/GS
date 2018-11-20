<style> tr.redAlert { background:#fbdfdf !important; }</style>
<?php
if(!empty($regular_admission)){
	$count_regular_admission = count( $regular_admission );
}else{
$count_regular_admission=0;
}

if(!empty($early_admission)){
	$count_early_admission = count( $early_admission );
}else{
	$count_early_admission=0;
}

$countAll = $count_regular_admission+$count_early_admission;
?>

	<div class="col-md-12"><h2 class="withBorderBottom">Post Result Verfication</h2></div>
		<div class="col-md-12" id="followup_lists">
			<div class="MaroonBorderBox">
				<h3>Post Result Verfication</h3>
				<div class="inner20 paddingLeft20 paddingRight20" id="paddingRight20">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#RaoTab">RAO (<?=$count_regular_admission;?>)</a></li>
						<li><a data-toggle="tab" href="#EaoTab">EAO (<?=$count_early_admission;?>)</a></li>
						<li><a data-toggle="tab" href="#AllApplicants">All Applicants (<?=$countAll;?>)</a></li>
					</ul><!-- nav-tabs -->
				 <div class="tab-content">
					<div id="RaoTab" class="tab-pane fade in active">
              <table id="RaoTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                              <thead> 
                								<tr> 
                									<th width="" class="text-center">Form #</th> 
                                  <th width="">Applicant Name<br /><small>Submission Date</small></th> 
                									<th width="">Grade Name </th> 
                                  <th width="">Father Name<br /><small>Father/Mother Mobile</small></th>
                                  <th width="">Result<br />Verification</th> 
                                </tr>
              								</thead>
                              <tbody> 
              							  <?php 
              							  if(!empty($regular_admission)){?>
              							    <?php foreach( $regular_admission as $regularAdmission ){ ?>
              								  <tr class="verified">
								                  <td class="text-center">
                                    	<?php echo str_pad( $regularAdmission->form_no,3,"0",STR_PAD_LEFT); ?>
                                	</td>
                                  <td>
                                  	<a href="#" class="followup_row" data-id="followup_<?=$regularAdmission->form_id;?>"> 
                                  		<?=$regularAdmission->applicant_name;?>
                                  	</a>
                                    <br />
                                    <small><?php echo date("j-F-Y", strtotime( $regularAdmission->form_submission_date ) );?></small>
									                </td>
									                <td><?=$regularAdmission->grade_name;?></td>
                                  <td><?=$regularAdmission->father_name;?><br /><small><?=$regularAdmission->father_mobile;?> / <?=$regularAdmission->mother_mobile;?></small></td>
                                  <td class="text-center"><a id="viewEdit_<?=$regularAdmission->form_id;?>" href="#" onclick="checklist(<?=$regularAdmission->form_id ?>)" data-toggle="modal" data-target="#myModal">View & Edit</a></td>
                                  
                                </tr>
								              <?php } ?>
								              <?php } ?>
							               </tbody> 
                            </table><!-- StaffListing -->
                        </div><!-- RaoTab -->


                <!-- Early Admission Tab -->
               <div id="EaoTab" class="tab-pane fade in">
                    <table id="EaoTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                      <thead> 
                        <tr> 
                          <th width="" class="text-center">Form #</th> 
                          <th width="">Applicant Name<br /><small>Submission Date</small></th> 
                          <th width="">Grade Name </th> 
                          <th width="">Father Name<br /><small>Father/Mother Mobile</small></th>
                          <th width="">Result<br />Verification</th> 
                        </tr>
                      </thead>
                      <tbody> 
                      <?php 
                      if(!empty($early_admission)){?>
                        <?php foreach( $early_admission as $early ){ ?>
                        <tr class="verified">
                          <td class="text-center">
                              <?php echo str_pad( $early->form_no,3,"0",STR_PAD_LEFT); ?>
                          </td>
                          <td>
                            <a href="#" class="followup_row" data-id="followup_<?=$early->form_id;?>"> 
                              <?=$early->applicant_name;?>
                            </a>
                            <br />
                            <small><?php echo date("j-F-Y", strtotime( $early->form_submission_date ) );?></small>
                          </td>
                          <td><?=$early->grade_name;?></td>
                          <td><?=$early->father_name;?><br /><small><?=$early->father_mobile;?> / <?=$early->mother_mobile;?></small></td>
                          <td class="text-center"><a id="viewEdit_<?=$early->form_id;?>" href="#" onclick="checklist(<?=$early->form_id ?>)" data-toggle="modal" data-target="#myModal">View & Edit</a></td>
                          
                        </tr>
                      <?php } ?>
                      <?php } ?>
                     </tbody> 
                    </table><!-- StaffListing -->
                        </div><!-- RaoTab -->
                    </div><!-- tab-content -->
                </div><!-- inner -->
            </div><!-- MaroonBorderBox -->
        </div><!-- col-md-7 -->
		    <div class="modal fade" id="myModal" role="dialog" style="display: none;">
          <div class="modal-dialog">
              <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close floatClose" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Post Result Verification Checklist</h4>
                 </div>
                 <div class="modal-body">
                  <input type="hidden" name="form_no" id="form_no">
<!--                    <input type="checkbox" id="signed_offer" name="signed_offer" required="required" class=""> <label class="" for="1">Signed Offer Letter</label><br /> -->
                   <input type="checkbox" id="duly_filled" name="duly_filled" required="required" class=""> <label class="" for="1">Duly Filled Admission Application Form and A-Level Supplement</label><br />
                   <!-- <input type="checkbox" id="BCCE" name="formCheckList[]" value="BCCE" required="required" class=""> <label class="" for="BCCE">Birth Certificate copy </label><br /> -->
                   <!-- <input type="checkbox" id="RPSP" name="formCheckList[]" value="RPSP" required="required" class=""> <label class="" for="RPSP">Recent Passport size photograph </label><br /> -->
                   <input type="checkbox" id="APCOSR" name="formCheckList[]" value="APCOSR" required="required" class=""> <label class="" for="APCOSR">Attested Photo copy of school result for grades IX, X and XI.(incl mocks) </label><br />
                   <input type="checkbox"  id="PRFSSE" name="formCheckList[]" value="PRFSSE" required="required" class=""> <label class="" for="PRFSSE">Principal recommendation form in school sealed envelope</label><br />
                   <input type="checkbox" value="ACCIEX"  id="ACCIEX" name="formCheckList[]" required="required" class=""> <label class="" for="ACCIEX">Attested copy of CIE Olevel results and certificates.(grade X only)</label><br />
                   <input type="checkbox" value="ACCIE"  id="ACCIE" name="formCheckList[]" required="required" class=""> <label class="" for="ACCIE">Attested copy of CIE Olevel results and certificates.</label><br />
                  <!--  <input type="checkbox" id="ACMER" name="formCheckList[]" value="ACMER" required="required" class=""> <label class="" for="ACMER">Attested copy mock exam result/first term result</label><br /> -->
                   <!-- <input type="checkbox" value="ACFFR" id="ACFFR" name="formCheckList[]" required="required" class=""> <label class="" for="ACFFR">Attested copies of full and final result </label><br /> -->
                   <input type="checkbox" value="CCFPS" id="CCFPS" name="formCheckList[]" required="required" class=""> <label class="" for="CCFPS">Transfer / Leaving certificate from previous school </label><br />
                   <input type="checkbox" value="PCCCA"  id="PCCCA" name="formCheckList[]" required="required" class=""> <label class="" for="PCCCA">Copies of certificates of cross curricular activities</label><br />
                 </div>
                 <div class="modal-footer text-center" style="text-align: center;">
                    <button onclick="verifyCheckList(); " class="btn btn-success">Verify</button>
                 </div>
                  <!-- Modal content-->     
              </div>
            </div><!-- modal-dialog -->
          </div><!-- modal -->
        <div class="col-md-5" style="display:none;" id="followupComments">
			<!-- // Ajax Response Will Be Show Here -->
		  </div><!-- col-md-4 -->
		



<script type="text/javascript">
		//  Regular Admission Data Table Intialize
	$('#RaoTable').dataTable({
	  "bLengthChange": false,
	  "columnDefs": [ {
	      "targets": 'no-sort',
	      "orderable": false,
	} ],
		"aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
	"iDisplayLength": 20
	});

	// Early Admission Data Table Intialize
	$('#EaoTable').dataTable({
	  "bLengthChange": false,
	  "columnDefs": [ {
	      "targets": 'no-sort',
	      "orderable": false,
	} ],
		"aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
	"iDisplayLength": 20
	});
</script>