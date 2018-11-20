       	<div class="MaroonBorderBox">
			
        			<h3>Admission Forms Issued <span class="pull-right" style="margin-top: -5px;" id="reloadList">
				<span class="bigNum" id="myTotal">
				<?=$myttl["mytotal"]; ?>
				</span><small id="grandTotal"> / <?=$ttl["totalForm"]; ?></small> &nbsp; &nbsp; <a href="#" style="color:#fff;">
				<i class="fa fa-refresh" aria-hidden="true" ></i></a></span></h3>
				
                <div class="inner20 paddingLeft20 paddingRight20">
				<?php //var_dump( $formlist ); ?>
                	<table id="issuanceFormListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                      <thead> 
                          <tr> 
                              <th width="" class="text-center">Form #</th> 
                              <th width="">Applicant Name</th> 
                              <th width="">Father Name - <strong>Contact</strong></th> 
                              <th width="" class="text-center no-sort">Status</th>
                              <th width="" class="text-center">GF-ID</th>
                              <th width="" class="no-sort">Action</th>
                          </tr>
                      </thead>
                      <tbody> 
					  <?php	if( !empty( $formlist ) ){
							foreach( $formlist AS $fl ){ ?>
							<tr>
						  <td class="text-center"><?php echo str_pad( $fl["Form_no"],4,"0",STR_PAD_LEFT); ?></td>
						  <td><?=$fl["Applicate_name"];?></td>
						  <td><?=$fl["Father_name"];?> - <strong> <?=$fl["Father_mobile"];?> </strong></td>
						  <td class="text-center">
						   <?php //$fl["form_status_id"];?>
						  <img src="<?php echo base_url()?>components/gs_theme/images/allocationIcon_active.png" title="Allocation" width="25" data-toggle="tooltip" data-placement="top" /> &nbsp; <img src="<?php echo base_url()?>components/gs_theme/images/communicationIcon_active.png" title="Communication" width="23" data-toggle="tooltip" data-placement="top" /></td>
						  
						 
						  <td class="text-center"><p><?php 
						  //echo join('-', str_split( $fl["Gf_id"], 2));
						  //echo implode('-', str_split($fl["Gf_id"], 2));
						  
						  //$value = $fl["gfid"];
						 // echo $value = substr($value, 0, 2).''.substr($value, 2);
						   $value = $fl["gfid"];
						  
						  if(  (int)substr($value, 0, 2) == 18 ){
							  
						  }else{
							echo $value = substr($value, 0, 2).''.substr($value, 2);  
						  }
						  
						  ?></p></td>
						  <td class="actionArea">
							<a href="javascript:void(0)" class="hoverAction">Action <i class="fa fa-angle-down" aria-hidden="true"></i></a>
							<div class="actionItems">
								<ul>
									<li><a href="http://10.10.10.63/gs/index.php/gs_admission/ajax_base/print_admission_form?FormNo=<?=$fl["Form_id"];?>" target="_blank">Print Form</a></li>
									<li><a href="#" class="view_n_Edit" data-id="<?=$fl["Form_id"];?>">View and Edit Details</a></li>
								</ul><!-- actionIteamsUL-->
							</div><!-- actionItems -->
						  </td>
                          </tr>
						  <?php }
						} 	?>
					
					</tbody> 
                  </table><!-- StaffListing -->
                </div><!-- inner -->
            </div><!-- MaroonBorderBox -->
       <script>
		$(document).ready(function(){
			// Issuance Form Listing Data Table	
$('#issuanceFormListing').dataTable({
	"order": [],
    "columnDefs": [{ "targets"  : 'no-sort', "orderable": false, }]
});

		});
	   </script>
