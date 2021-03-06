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

          <table class="display table table-striped table-hover dataTable" id="online_applicant_forms_shortlist2_interactionhr_table" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GC ID: activate to sort column ascending" style="width: 10px;">GC ID</th>
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 15px;">Name</th>                

                <!-- Tags -->
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Academic Subject Tag: activate to sort column ascending" style="width: 10px;">Tags Academic Subject</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Academic Primary Tag: activate to sort column ascending" style="width: 10px;">Tags Academic Primary</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Academic Section Tag: activate to sort column ascending" style="width: 10px;">Tags Academic Section</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Academic Management Tag: activate to sort column ascending" style="width: 10px;">Tags Academic Management</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Academic Management Primary Tag: activate to sort column ascending" style="width: 10px;">Tags Academic Management Primary</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Admin Area Tag: activate to sort column ascending" style="width: 10px;">Tags Admin Area</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Admin Area Primary Tag: activate to sort column ascending" style="width: 10px;">Tags Admin Primary</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Admin Area Position: activate to sort column ascending" style="width: 10px;">Tags Admin Position</th>
                <!-- Tags End -->

                <!-- Grade -->
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Grade: activate to sort column ascending" style="width: 10px;">Grade</th>
                <!-- Grade End -->


                <!-- Action Step -->
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Action Step: activate to sort column ascending" style="width: 10px;">Action Step</th>
                <!-- Action Step End -->

                <!-- Comments -->
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Comments: activate to sort column ascending" style="width: 10px;">Comments</th>
                <!-- Comments End -->

                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="View Form: activate to sort column ascending" style="width: 10px;">View Form</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Full Form: activate to sort column ascending" style="width: 10px;">Full Form</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Gender: activate to sort column ascending" style="width: 85px;">Gender</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Applied Date: activate to sort column ascending" style="width: 20px;">Handedover</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gcid" placeholder="Filter GCID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Name" class="search_init"></th>


                <!-- Tags -->
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Tag Academic Subject" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Tag Academic Subject Primary" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Tag Academic Section" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Tag Academic Management" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Tag Academic Management Primary" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Tag Admin Area" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Tag Admin Area Primary" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Tag Admin Position" class="search_init"></th>
                <!-- Tags End -->


                <!-- Grade -->
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Grade" class="search_init"></th>
                <!-- Grade End -->


                <!-- Action Step -->
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Action Step" class="search_init"></th>
                <!-- Action Step End -->


                <!-- Comments -->
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Comments" class="search_init"></th>
                <!-- Comments End -->


                <th rowspan="1" colspan="1"><input type="text" name="filter_action" placeholder="Filter View Form" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_action" placeholder="Filter Full Form" class="search_init"></th>                
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
               <td class=" centered-cell"><?php echo $applicant_data->gc_id;?></td>
               <td class=" sorting_1"><?php echo $applicant_data->name; ?></td>

              <!-- Tags -->              
              <td class=" centered-cell aneditable_sl_tags_acd_subjects"><a href="#" data-type="select2" data-name="sl_tags_acd_subject" data-pk="<?php echo $applicant_data->id; ?>" data-placement="right" data-value="<?php echo $applicant_data->sl_tags_acd_subject; ?>" data-title="Academic Subjects"></a></td>
              <td class=" centered-cell aneditable_sl_tags_acd_subjects_primary"><a href="#" data-type="select2" data-name="sl_tags_acd_primary" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top" data-value="<?php echo $applicant_data->sl_tags_acd_primary; ?>" data-title="Primary Academic Subjects"></a></td>
              <td class=" centered-cell aneditable_sl_tags_acd_sections"><a href="#" data-type="select2" data-name="sl_tags_acd_section" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top" data-value="<?php echo $applicant_data->sl_tags_acd_section; ?>" data-title="Academic Section"></a></td>
              <td class=" centered-cell aneditable_sl_tags_acdm"><a href="#" data-type="select2" data-name="sl_tags_acdm" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top" data-value="<?php echo $applicant_data->sl_tags_acdm; ?>" data-title="Academic Management"></a></td>
              <td class=" centered-cell aneditable_sl_tags_acdm_primary"><a href="#" data-type="select2" data-name="sl_tags_acdm_primary" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top" data-value="<?php echo $applicant_data->sl_tags_acdm_primary; ?>" data-title="Academic Management Primary"></a></td>
              <td class=" centered-cell aneditable_sl_tags_admin_area"><a href="#" data-type="select2" data-name="sl_tags_admin_area" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top" data-value="<?php echo $applicant_data->sl_tags_admin_area; ?>" data-title="Admin Area"></a></td>
              <td class=" centered-cell aneditable_sl_tags_admin_position"><a href="#" data-type="select2" data-name="sl_tags_admin_position" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top" data-value="<?php echo $applicant_data->sl_tags_admin_position; ?>" data-title="Admin Position"></a></td>
              <td class=" centered-cell aneditable_sl_tags_admin_primary"><a href="#" data-type="select2" data-name="sl_tags_admin_primary" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top" data-value="<?php echo $applicant_data->sl_tags_admin_primary; ?>" data-title="Admin Primary"></a></td>
              <!-- Tags End -->



              <!-- Grade -->
              <?php if ($applicant_data->sl2_grade == "") { ?>
                <td class=" centered-cell aneditable_shortlist_sl2_grade"><a href="#" data-type="select" data-name="sl2_grade" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top">.....</a></td>
              <?php }else { ?>
                <td class=" centered-cell aneditable_shortlist_sl2_grade"><a href="#" data-type="select" data-name="sl2_grade" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top"><?php echo $applicant_data->sl2_grade; ?></a></td>
              <?php } ?> 
              <!-- Grade End -->
               


              <!-- Action Step -->
              <?php if ($applicant_data->sl2 == 1) { ?>
                  <td class=" centered-cell aneditable_shortlist_sl2"><a href="#" data-type="select" data-name="sl2" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top">SL3</a></td>
               <?php } else if ($applicant_data->sl2 == 0) { ?>
                  <td class=" centered-cell aneditable_shortlist_sl2"><a href="#" data-type="select" data-name="sl2" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top">.....</a></td>
               <?php } else if ($applicant_data->sl2 == 2) { ?>
                  <td class=" centered-cell aneditable_shortlist_sl2"><a href="#" data-type="select" data-name="sl2" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top">Archive</a></td>
               <?php }else { ?>
                  <td class=" centered-cell aneditable_shortlist_sl2"><a href="#" data-type="select" data-name="sl2" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top">Formal Interview</a></td>
               <?php } ?>              
              <!-- Action Step End -->


              <!-- Comments -->
              <?php if ($applicant_data->sl2_comments == "") { ?>
                <td class=" centered-cell aneditable_shortlist_2_comments"><a href="#" data-type="textarea" data-name="sl2_comments" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top">.....</a></td>                
              <?php } else {?>
                <td class=" centered-cell aneditable_shortlist_2_comments"><a href="#" data-type="textarea" data-name="sl2_comments" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top"><?php echo $applicant_data->sl2_comments; ?></a></td>
              <?php } ?>
              <!-- Comments End -->


               <td class=" centered-cell">
                  <form action="<?php echo site_url()?>/hcm/mark_shortlist_a/printForm" method="post" accept-charset="utf-8">
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
                              <form action="<?php echo site_url()?>/hcm/interaction_hr/printForm" method="post" accept-charset="utf-8">
                                <input type="hidden" name="id" value="<?php echo $applicant_data->gc_id; ?>">
                                <input type="hidden" name="name" value="<?php echo $applicant_data->name; ?>">
                                <button type="submit" name="print" value="Print">Full Form</button>
                              </form>
                            <?php } ?>
                          </td>
                <!-- End Complete Form Scan View -->


               
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