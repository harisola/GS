<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $class_list_color_view; ?> powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Staff <small>Attendance</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="class_list_view_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="attendance_staff_previousday_out_table" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="GT ID: activate to sort column descending" style="width: 15px;">GT ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Photo: activate to sort column ascending" style="width: 100px;">Photo</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Formal Name: activate to sort column ascending" style="width: 100px;">Formal Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending" style="width: 120px;">Department</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Designation: activate to sort column ascending" style="width: 85px;">Designation</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Top Line: activate to sort column ascending" style="width: 85px;">Top Line</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Bottom Line: activate to sort column ascending" style="width: 5px;">Bottom Line</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Time In: activate to sort column ascending" style="width: 5px;">Time Out</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_call_name" placeholder="Filter GT ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_photo" placeholder="Filter Photo" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_abridged_name" placeholder="Filter Formal Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_official_name" placeholder="Filter Department" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_dob" placeholder="Filter Designation" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_grade_section" placeholder="Filter Top Line" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_House" placeholder="Filter Bottom Line" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_Gender" placeholder="Filter Time In" class="search_init"></th>                
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';           
            foreach($this->attendance['staff'][0] as $staff) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">
              <td class=" sorting_1 centered-cell"><?php echo $staff->gt_id; ?></td>
              <?php
                $ImageName = base_url() . $this->data['staff_150_photo_path'] . $staff->employee_id . $this->data['photo_file'];
                $ImageMale = base_url() . $this->data['staff_150_photo_path'] . "male.png";
                $ImageFemale = base_url() . $this->data['staff_150_photo_path'] . "female.png";
                $ImageFound = "Yes";

                if (!file_exists($this->data['staff_150_photo_path'] . $staff->employee_id . $this->data['photo_file'])) {
                    if($staff->gender == 'M'){
                        $ImageName = $ImageMale;
                    }else if($staff->gender == 'F'){
                        $ImageName = $ImageFemale;
                    }

                    $ImageFound = "No";
                }
              ?>
              <td class=" centered-cell"><img src="<?php echo $ImageName; ?>" alt="" border=3 height=50 width=50></td> 
              <td class=" centered-cell"><?php echo $staff->full_name; ?></td>
              <td class=" centered-cell"><?php echo $staff->department; ?></td>
              <td class=" centered-cell"><?php echo $staff->designation; ?></td>
              <td class=" centered-cell"><?php echo $staff->c_topline; ?></td>
              <td class=" centered-cell"><?php echo $staff->c_bottomline; ?></td>
              <?php if (empty($staff->time_out)) { ?>
                <td class=" centered-cell">absent</td>
              <?php } else { ?>
                <td class=" centered-cell"><?php echo $staff->time_out; ?></td>
              <?php } ?>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->
<!-- <td class=" centered-cell" style="background-color:#<?php echo $class_list['house_color_hex'];?>"><span style="background-color:#<?php echo $class_list['house_color_hex'];?>"><?php echo $class_list['house_dname']; ?></span></td>
-->