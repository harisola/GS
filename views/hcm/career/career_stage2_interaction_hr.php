<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $online_applicant_color_view; ?> powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Applicant<small>List</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="class_list_view_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="online_applicant_forms_stage2_interactionhr_table" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 15px;">Name</th>
                <!-- <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mobile Phone: activate to sort column ascending" style="width: 100px;">Mobile Phone</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 120px;">Email</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="NIC: activate to sort column ascending" style="width: 85px;">NIC</th> -->
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GC ID: activate to sort column ascending" style="width: 10px;">GC ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Forward To: activate to sort column ascending" style="width: 10px;">Recommend To</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Form In: activate to sort column ascending" style="width: 10px;">Form In</th>                
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="View Form: activate to sort column ascending" style="width: 10px;">View Form</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Full Form: activate to sort column ascending" style="width: 10px;">Full Form</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="History: activate to sort column ascending" style="width: 10px;">History</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Gender: activate to sort column ascending" style="width: 85px;">Gender</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Applied Date: activate to sort column ascending" style="width: 20px;">Handedover</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Name" class="search_init"></th>
                <!-- <th rowspan="1" colspan="1"><input type="text" name="filter_mobile_phone" placeholder="Filter Mobile Phone" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_email" placeholder="Filter Email" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_nic" placeholder="Filter NIC" class="search_init"></th> -->
                <th rowspan="1" colspan="1"><input type="text" name="filter_gcid" placeholder="Filter GCID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_forward_to" placeholder="Filter Recommend To" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_form_in" placeholder="Filter Form In" class="search_init"></th>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_action" placeholder="Filter View Form" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_action" placeholder="Filter Full Form" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_action" placeholder="Filter History" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gender" placeholder="Filter Gender" class="search_init"></th>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_handed_over" placeholder="Handedover Date" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';            
            foreach($this->online['applicant_data'][0] as $applicant_data) {
              if($applicant_data->interaction_finished == 0){
                if($class_odd_even == 'odd'){
                  $class_odd_even = 'even';
                }else{
                  $class_odd_even = 'odd';
                }              
          ?>
            <tr class="<?php echo $class_odd_even; ?>">
               <td class=" sorting_1"><?php echo $applicant_data->name; ?></td>
               <!-- <td class=" centered-cell"><?php /*echo $applicant_data->mobile_phone; ?></td>
               <td class=" "><?php echo $applicant_data->email; ?></td>
               <td class=" centered-cell"><?php echo $applicant_data->nic; */?></td> -->
               <td class=" centered-cell"><?php echo $applicant_data->gc_id;?></td>

               <?php if($applicant_data->form_location == 0 || $applicant_data->form_location == 1) { ?>
                 <td class=" centered-cell"><?php echo $applicant_data->forward_interaction_name; ?>
                    <a class="btn btn-warning interaction_forward_to" data-toggle="modal" data-id="<?php echo $applicant_data->id;?>" href="#"><i class="fa fa-mail-forward"></i></a>
                 </td>
               <?php }else{ ?>
                  <td class=" centered-cell"><?php echo $applicant_data->forward_interaction_name; ?>
                  </td>
               <?php } ?>            

               <!-- Physical Form -->
               <?php if(empty($applicant_data->form_location) || $applicant_data->form_location == 0) { ?>
                  <td class=" centered-cell">HR
                    <div class="btn-group">
                      <a class="btn btn-danger interaction_form_send" data-toggle="modal" data-id="<?php echo $applicant_data->id;?>" href="#"><i class="fa fa-send"></i></a>
                    </div>
                  </td>
               <?php }else if($applicant_data->form_location == 1) {?>
                  <td class=" centered-cell">in transit from HR to <?php echo $applicant_data->form_in_centre;?>
                    <div class="btn-group">
                      <a class="btn btn-danger interaction_form_send" data-toggle="modal" data-id="<?php echo $applicant_data->id;?>" href="#"><i class="fa fa-send"></i></a>
                    </div>
                  </td>
               <?php }else if($applicant_data->form_location == 2) {?>
                  <td class=" centered-cell"><?php echo $applicant_data->form_in_centre;?>                    
                  </td>
               <?php }else if($applicant_data->form_location == 3) {?>
                  <td class=" centered-cell">in transit from <?php echo $applicant_data->forward_interaction_name;?> to HR
                    <div class="btn-group">
                      <a class="btn btn-success interaction_form_received_by_hr" data-toggle="modal" data-id="<?php echo $applicant_data->form_send_received_id;?>" href="#"><i class="fa fa-check"></i></a>
                    </div>
                  </td>
               <?php } ?>
               <!-- Physical Form END -->

               <td class=" centered-cell">
                  <form action="<?php echo site_url()?>/hcm/mark_shortlist_a/printForm" method="post" accept-charset="utf-8" target="_blank">
                  <input type="hidden" name="career_id" value="<?php echo $applicant_data->id; ?>">
                  <button type="submit" name="print" value="Print">View</button>
                  </form>                  
               </td>

                
                <!-- View Complete Form Scan View -->
                <?php 
                  $GCID = $applicant_data->gc_id;
                  $converted_GCID = str_replace("-", "", $GCID);
                  $converted_GCID = str_replace("/", "_", $converted_GCID);
                ?>
                <td class=" centered-cell"><?php if(file_exists($this->data['applicant_form_path2'] . $converted_GCID . "_1.jpg"))
                            { ?>                
                              <form action="<?php echo site_url()?>/hcm/interaction_hr/printForm" method="post" accept-charset="utf-8" target="_blank">
                                <input type="hidden" name="id" value="<?php echo $applicant_data->gc_id; ?>">
                                <input type="hidden" name="name" value="<?php echo $applicant_data->name; ?>">
                                <button type="submit" name="print" value="Print">Full Form</button>
                              </form>
                            <?php } ?>
                          </td>
                <!-- End Complete Form Scan View -->


               <td class=" centered-cell">
                  <div class="btn-group">                    
                    <a class="btn btn-info career_history_modal" data-toggle="modal" data-id="<?php echo $applicant_data->id;?>" href="#"><i class="fa fa-history"></i>
                    </a>
                  </div>
               </td>
               <td class=" centered-cell"><?php echo $applicant_data->gender; ?></td>
               <?php if($applicant_data->handedover_datetime == 0) { ?>
                  <td class=" centered-cell"></td>
               <?php } else { ?>
                  <td class=" centered-cell"><?php echo unix_to_human($applicant_data->handedover_datetime); ?></td>
               <?php } ?>
            </tr>
          <?php } }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of View applicants -->

<!-- <a data-toggle="modal" class="items-image show_student_information" data-id="<?php /*echo $class_list['gr_no'];*/?>" href="#"> -->