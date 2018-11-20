<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $class_list_color_view; ?>" id="fo_activecase_div" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>List<small>Active Case</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="active_case_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="active_case_datatable" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No: activate to sort column descending" style="width: 15px;">S.No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Abridged Name: activate to sort column ascending" style="width: 100px;">Abridged Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Official Name: activate to sort column ascending" style="width: 120px;">Official Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 10px;">Status</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Grade: activate to sort column ascending" style="width: 10px;">Grade</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Section: activate to sort column ascending" style="width: 10px;">Section</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Penalty: activate to sort column ascending" style="width: 10px;">Absent</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 10px;">ActiveCase</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Present: activate to sort column ascending" style="width: 10px;">Present</th>


                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Father Name: activate to sort column ascending" style="width: 10px;">Father Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Father Mobile: activate to sort column ascending" style="width: 10px;">Father Mobile</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mother Nmae: activate to sort column ascending" style="width: 10px;">Mother Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mother Mobile: activate to sort column ascending" style="width: 10px;">Mother Mobile</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Last Attendance: activate to sort column ascending" style="width: 10px;">Last Attendance</th>


                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Gender: activate to sort column ascending" style="width: 5px;">Gender</th>
                <!-- <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GR No: activate to sort column ascending" style="width: 20px;">GR No</th> -->
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GS ID: activate to sort column ascending" style="width: 20px;">GS ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GF ID: activate to sort column ascending" style="width: 20px;">GF ID</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_sno" placeholder="Filter S.No" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_abridged_name" placeholder="Filter Abridged Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_official_name" placeholder="Filter Official Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_status" placeholder="Filter Status" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_grade" placeholder="Filter Grade" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section" placeholder="Filter Section" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section" placeholder="Filter Penalty" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section" placeholder="Filter Active Case Status" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section" placeholder="Filter Present" class="search_init"></th>

                <th rowspan="1" colspan="1"><input type="text" name="filter_section" placeholder="Filter Father Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section" placeholder="Filter Father Mobile" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section" placeholder="Filter Mother Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section" placeholder="Filter Mother Mobile" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section" placeholder="Filter Last Attendance" class="search_init"></th>

                
                <th rowspan="1" colspan="1"><input type="text" name="filter_Gender" placeholder="Filter Gender" class="search_init"></th>
                <!-- <th rowspan="1" colspan="1"><input type="text" name="filter_grno" placeholder="Filter GR No" class="search_init"></th> -->
                <th rowspan="1" colspan="1"><input type="text" name="filter_gsid" placeholder="Filter GS-ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gfid" placeholder="Filter GF-ID" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            $SNo = 1;
            foreach($this->Student['attendance_data'] as $class_list) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <?php if($class_list['total_a'] > 0) { ?>
              <tr class="<?php echo $class_odd_even; ?>">
                <td class=" sorting_1"><?php echo $SNo; ?></td>
                <td class=" sorting_1"><?php echo $class_list['abridged_name']; ?></td>
                <td class=" "><?php echo $class_list['official_name']; ?></td>
                <td class=" centered-cell"><?php echo $class_list['std_status_code']; ?></td>
                <td class=" centered-cell"><?php echo $class_list['grade_name']; ?></td>
                <td class=" centered-cell"><?php echo $class_list['section_name']; ?></td>
                <td class=" centered-cell"><a data-toggle="modal" class="items-image show_student_activecase" data-id="<?php echo $class_list['gs_id']; ?>" href="#"><?php echo $class_list['total_a']; ?></a></td>

                <?php if($class_list['close_category_id'] == '0') { ?>
                  <td class=" aneditable_acase_category_id centered-cell"><a href="#" data-type="select" data-name="close_category_id" data-pk="<?php echo $class_list['activecase_case_id']; ?>" data-placement="top" data-title="Active Case?">                    
                    <?php echo "Open"; ?></a>                      
                  </td>
                <?php } else { ?>
                  <td class=" centered-cell"><?php echo ""; ?></td>
                <?php } ?>
                <td class=" centered-cell"><?php echo $class_list['total_p']; ?></td>
                <td class=" centered-cell"><?php echo $class_list['father_name']; ?></td>
                <td class=" centered-cell"><?php echo $class_list['father_mobile_phone']; ?></td>
                <td class=" centered-cell"><?php echo $class_list['mother_name']; ?></td>
                <td class=" centered-cell"><?php echo $class_list['mother_mobile_phone']; ?></td>
                <td class=" centered-cell"><?php echo $class_list['last_atd_date']; ?></td>
                <td class=" centered-cell"><?php echo $class_list['gender']; ?></td>
                <!-- <td class=" centered-cell"><?php echo $class_list['gr_no']; ?></td> -->
                <td class=" centered-cell"><?php echo $class_list['gs_id']; ?></td>
                <td class=" centered-cell"><?php echo $class_list['gfid']; ?></td>
              </tr>
            <?php $SNo++; } ?>
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