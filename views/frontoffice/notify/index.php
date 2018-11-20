 <div class="col-md-6  bootstrap-grid sortable-grid ui-sortable">
 <style>
	.alert-blocks img {
    float: left;
    height: 40px;
    margin-right: 15px;
    width: 40px;
}
.rounded-x {
    border-radius: 50% !important;
}
</style>
 <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="new_student_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>New<small>Student</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
	  
	  
		<div class="row">
		<div class="col-xs-6">
		<div id="table_container_length" class="dataTables_length"><label>
		</label></div></div>
		<div class="col-xs-6"><div class="dataTables_filter" id="table_container_filter">
		<label>Expire: 
		
			   <select id="msds_select" name="msds_select" aria-controls="table_container">
                    <option value="-1"></option>
                    <option value="Submission Expire">Submission</option>
                    <option value="Assessment Expire">Assessment</option>
                    <option value="Offer Expire">Offer</option>
                    
                    </select>
		</label>
		
		</div></div></div>
		
		
		
		<table class="table table-condensed table-bordered margin-0px" id="table_container">
			<thead>
				<tr>
				  <th>#</th>
				  <th>Register By</th>
				  <th>Type</th>
				  
				  <th>Show</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>#</th>
					<th colspan="">Category</th>
					<th>Type</th>
					<th>Show</th>
				</tr>
			</tfoot>
			<tbody>
				<?php $counter = 1; ?>
				<?php if(!empty( $notify_list)){ ?> 
				<?php foreach( $notify_list AS $d ){ 
					$photo_url = base_url().$this->data['staff_150_photo_path'].$d["S_emp_id"].".png";
					?>
					  <?php if( (int)$d["N_seen"] == 0 ){ ?> 
					  <tr class="tableRow danger" id="row_id_<?=$d["N_log_id"];?>">
					  <?php }else{ ?> 
					  <tr id="row_id_<?=$d["N_log_id"];?>" class="tableRow">
						<?php } ?>
						
					
					<input type="hidden" name="" class="N_log_id" value="<?=$d["N_log_id"];?>" />
					<input type="hidden" name="" class="N_cat_id" value="<?=$d["N_cat_id"];?>" />
					
					<input type="hidden" name="" class="S_id" value="<?=$d["S_id"];?>" />
					<input type="hidden" name="" class="S_emp_id" value="<?=$d["S_emp_id"];?>" />
					<input type="hidden" name="" class="gs_id" value="<?=$d["gs_id"];?>" />
					<input type="hidden" name="" class="notify_to" value="<?=$d["notify_to"];?>" />
					<input type="hidden" name="" class="current_user" value="<?=$d["notify_to"];?>" />
					
					<td class="alert-blocks"><?php $counter;?>  <img alt="" src="<?=$photo_url;?>" class="rounded-x mCS_img_loaded">  </td> <?php $counter++; ?>
					 <td class="alert-blocks"><?=$d["S_name"];?></td>
						<?php /*
						<strong><?=$d["S_name"];?></strong><?php $d["S_desgntn"]; ?>
						<br /><?php $d["S_deprt"];?> 
						*/ ?>
                      <td class="alert-blocks ">
						<?=$d["N_type"];?> 
						</td>
					 
                      <td>
					  <?php /*if( (int)$d["N_seen"] == 0 ){ ?> 
					  <span class="label label-danger open_show" data-id="<?=$d["N_log_id"];?>" style="cursor: pointer;">Display <small>New</small></span>
					  <?php }else{ ?> 
						<?php } */?>
						
					  <span class="label label-success open_show" data-id="<?=$d["N_log_id"];?>" data-type="<?php echo $d["NType"]; ?>" style="cursor: pointer;">Open</span>
					  </td>
                    </tr>  
					<?php } ?>
					<?php }else{ ?>
						<tr>
							<td colspan="6"> Record not found! </td>
						</tr>
					<?php } ?>
                  </tbody>
                </table>
		</div>
    </div>
  </div>
  <div id="conversion"></div>