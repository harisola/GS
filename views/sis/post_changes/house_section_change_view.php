<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">

  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $title_background_color_view; ?>" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Student<small>Academic Record Changes</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <!-- <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a> -->
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="student_academic_record" class="dataTables_wrapper form-inline" role="grid">

          <table class="display table table-striped table-hover dataTable" id="student_academic_record_table" aria-describedby="staff_info">

            <thead>
              <tr role="row">
              <!-- New Setting -->
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S No: activate to sort column descending" style="width: 150px;">S No.</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GR No: activate to sort column ascending" style="width: 25px;">GR No</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GS ID: activate to sort column ascending" style="width: 25px;">GS ID</th>
                <th class=" " role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 10px;">Student Name</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Gender: activate to sort column ascending" style="width: 85px;">Gender</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Grade: activate to sort column ascending" style="width: 25px;">Grade</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Section: activate to sort column ascending" style="width: 25px;">Section</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Status Section Comments: activate to sort column ascending" style="width: 25px;">Section Comments</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="House: activate to sort column ascending" style="width: 25px;">House</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Status House Comments: activate to sort column ascending" style="width: 25px;">House Comments</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 25px;">Status</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Status: activate to sort column ascending" style="width: 25px;">Student Status</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Status Comments: activate to sort column ascending" style="width: 25px;">Status Comments</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_sno" placeholder="Filter S.No." class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_grno" placeholder="Filter GR No" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gsid" placeholder="Filter GS ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_student_name" placeholder="Filter Student Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gender" placeholder="Filter Gender" class="search_init"></th>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_grade" placeholder="Filter Grade" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section" placeholder="Filter Section" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section_comments" placeholder="Filter Section Comments" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_house" placeholder="Filter House" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_house_comments" placeholder="Filter House Comments" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_status" placeholder="Filter Status" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_student_status" placeholder="Filter Student Status" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_status_comments" placeholder="Filter Status Comments" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            $SNo = 1;
            foreach($this->data['academic_data'] as $student_record) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">
              <td class=" sorting_1 centered-cell"><?php echo $SNo; ?></td>              
              <td class=" centered-cell"><?php echo $student_record['gr_no']; ?></td>
              <td class=" centered-cell"><?php echo $student_record['gs_id']; ?></td>
              <td class=" "><?php echo $student_record['abridged_name']; ?></td>
              <td class=" centered-cell"><?php echo $student_record['gender']; ?></td>
              <td class=" centered-cell"><?php echo $student_record['grade_name']; ?></td>
              <td class=" aneditable_section centered-cell"><a href="#" data-type="select" data-name="section_id" data-pk="<?php echo $student_record['id']; ?>" data-placement="top"><?php echo $student_record['section_name']; ?></a></td>
              <td class=" aneditable_section_change centered-cell"><a href="#" data-type="textarea" data-name="section_change_comments" data-pk="<?php echo $student_record['id']; ?>" data-placement="top"><?php echo $student_record['section_change_comments']; ?></a></td>
              <td class=" aneditable_house centered-cell"><a href="#" data-type="select" data-name="house_id" data-pk="<?php echo $student_record['id']; ?>" data-placement="top"><?php echo $student_record['house_name']; ?></a></td>
              <td class=" aneditable_house_change centered-cell"><a href="#" data-type="textarea" data-name="house_change_comments" data-pk="<?php echo $student_record['id']; ?>" data-placement="top"><?php echo $student_record['house_change_comments']; ?></a></td>
              <td class=" aneditable_status centered-cell"><a href="#" data-type="select" data-name="status_id" data-pk="<?php echo $student_record['id']; ?>" data-placement="top"><?php echo $student_record['student_status']; ?></a></td>
              <td class=" aneditable_student_status centered-cell"><a href="#" data-type="select" data-name="student_status_id" data-pk="<?php echo $student_record['id']; ?>" data-placement="top"><?php echo $student_record['status_code']; ?></a></td>
              <td class=" aneditable_status_change centered-cell"><a href="#" data-type="textarea" data-name="status_change_comments" data-pk="<?php echo $student_record['id']; ?>" data-placement="left"><?php echo $student_record['status_change_comments']; ?></a></td>
            </tr>
          <?php $SNo++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->