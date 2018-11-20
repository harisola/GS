<style type="text/css">
.input-large{
   width: 100px;
}
</style>

<div class="highlight">
  <select name="selected_grade" id="selected_grade">
    <option value="0">Choose Grade</option>
    <?php
    foreach ($this->data['allowed_classes'] as $classes) {
      echo '<option value="' . $classes['grade_id'] . '">' . $classes['grade_dname'] . '</option>';
    }
    ?>
  </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <select name="selected_section" id="selected_section">
    <option value="0">Choose Section</option>
  </select>

  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <button type="button" class="btn btn-warning" name="confirm_tpa" id="confirm_tpa">Confirm TPA</button>
</div>



<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $class_list_color_view; ?>" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Class<small>List</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="class_list_view_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="class_list_view_faculty_table" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Call Name: activate to sort column descending" style="width: 15px;">Call Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Abridged Name: activate to sort column ascending" style="width: 100px;">Abridged Name</th>                
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Official Name: activate to sort column ascending" style="width: 120px;">Official Name</th>                
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Grade-Section: activate to sort column ascending" style="width: 85px;">Grade-Section</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Attendance: activate to sort column ascending" style="width: 5px;">Attendance</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="House: activate to sort column ascending" style="width: 5px;">House</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Gender: activate to sort column ascending" style="width: 5px;">Gender</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 20px;">GR No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 20px;">GS ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 20px;">Status</th>                
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 20px;">GF ID</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_call_name" placeholder="Filter Call Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_abridged_name" placeholder="Filter Abridged Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_official_name" placeholder="Filter Official Name" class="search_init"></th>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_grade_section" placeholder="Filter Grade-Section" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_House" placeholder="Filter Attendance" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_House" placeholder="Filter House" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_Gender" placeholder="Filter Gender" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_grno" placeholder="Filter GR No" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gsid" placeholder="Filter GS-ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_status" placeholder="Filter Status" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gfid" placeholder="Filter GF-ID" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            foreach($this->data['class_list_data'] as $class_list) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">
              <td class=" sorting_1"><?php echo $class_list['call_name']; ?></td>
              <td class=" "><?php echo $class_list['abridged_name']; ?></td>
              <td class=" "><?php echo $class_list['official_name']; ?></td>              
              <td class=" centered-cell"><?php echo $class_list['grade_name'] . "-" . $class_list['section_name']; ?></td>
              <?php if($class_list['time'] == NULL) {?>
                <td class=" centered-cell aneditable_attendance_present">
                  <a href="#" data-type="select2" data-name="time" data-pk="<?php echo $class_list['student_id']; ?>" data-placement="top" data-title="Attendance Status">
                    <?php echo "Absent"; ?>
                  </a>
                </td>
              <?php } else {?>
                <td class=" centered-cell aneditable_attendance_absent">
                  <a href="#" data-type="select2" data-name="time" data-pk="<?php echo $class_list['id']; ?>" data-placement="top" data-title="Attendance Status">
                    <?php echo $class_list['time']; ?>
                  </a>
                </td>
              <?php } ?>

              <?php if($class_list['house_dname'] != 'Jinnah') {?>

                <td class=" centered-cell" style="background-color:#<?php echo $class_list['house_color_hex'];?>"><a data-toggle="modal" style="text-decoration:none !important; text-decoration:none;" class="show_student_information" data-id="<?php echo $class_list['gr_no'];?>" href="#"><span style="color:white"><?php echo $class_list['house_dname']; ?></span></td>
                </a>
              <?php } else{?>

                <td class=" centered-cell" style="background-color:#<?php echo $class_list['house_color_hex'];?>"><a data-toggle="modal" style="text-decoration:none !important; text-decoration:none;" class="show_student_information" data-id="<?php echo $class_list['gr_no'];?>" href="#"><span style="color:black"><?php echo $class_list['house_dname']; ?></td>
                </a>
              <?php } ?>              
              <td class=" centered-cell"><?php echo $class_list['gender']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['gr_no']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['gs_id']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['student_status_name']; ?></td>
              <?php $GF_ID_Last = substr($class_list['gf_id'], -3);
                $GF_ID_First = substr($class_list['gf_id'], 0, strlen($class_list['gf_id'])-strlen($GF_ID_Last));
                if(strlen($GF_ID_First) == 1)
                {
                  $GF_ID_First = '0' . $GF_ID_First;
                }
                $GF_ID = $GF_ID_First . "-" . $GF_ID_Last;
              ?>
              <td class=" centered-cell"><?php echo $GF_ID; ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>