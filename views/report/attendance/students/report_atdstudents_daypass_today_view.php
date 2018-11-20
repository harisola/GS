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
        <div id="class_list_view_table_wrapper" class="dataTables_wrapper form-inline" role="gs_id">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="attendance_students_daypass_today_table" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="GS ID: activate to sort column descending" style="width: 15px;">GS ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GR No: activate to sort column ascending" style="width: 100px;">Gr No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Photo: activate to sort column ascending" style="width: 100px;">Photo</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Abridged Name: activate to sort column ascending" style="width: 100px;">Abridged Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Gender: activate to sort column ascending" style="width: 120px;">Gender</th>                
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Grade Name: activate to sort column ascending" style="width: 5px;">Grade name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Section Name: activate to sort column ascending" style="width: 5px;">Section name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Card No: activate to sort column ascending" style="width: 5px;">Card No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Time In: activate to sort column ascending" style="width: 5px;">Time In</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Remarks: activate to sort column ascending" style="width: 5px;">Remarks</th>                
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gsid" placeholder="Filter GS ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_grno" placeholder="Filter GRNo" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_photo" placeholder="Filter Photo" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_abridged_name" placeholder="Filter Abridged Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gender" placeholder="Filter Gender" class="search_init"></th>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_grade_name" placeholder="Filter Grade Name" class="search_init"></th>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_section_name" placeholder="Filter Section Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_card_no" placeholder="Filter Card No" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_time_in" placeholder="Filter Time In" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_remarks" placeholder="Filter Remarks" class="search_init"></th>                
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';           
            foreach($this->attendance['students'][0] as $student) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">
              <td class=" sorting_1 centered-cell"><?php echo $student->gs_id; ?></td>
              <td class=" centered-cell"><?php echo $student->gr_no; ?></td>
              <?php
              if(file_exists($this->data['student_150_photo_path'] . $student->gr_no . ".png")){
                $female_photo = $this->data['student_150_photo_path'] . $student->gr_no . ".png";
                $male_photo = $this->data['student_150_photo_path'] . $student->gr_no . ".png";
              }else{
                $male_photo = 'assets/photos/sis/150x150/male.png';
                $female_photo = 'assets/photos/sis/150x150/female.png';                
              }

              if($student->gender == 'G') 
              {?>
                <td class=" centered-cell"><img src="<?php echo base_url() . $female_photo; ?>" alt="" border=3 height=50 width=50></td>
              <?php }else{?>
                <td class=" centered-cell"><img src="<?php echo base_url() . $male_photo; ?>" alt="" border=3 height=50 width=50></td>
              <?php }?>
              
              <td class=" centered-cell"><?php echo $student->abridged_name; ?></td>
              <td class=" centered-cell"><?php echo $student->gender; ?></td>
              
              <td class=" centered-cell"><?php echo $student->grade_name; ?></td>
              <td class=" centered-cell"><?php echo $student->section_name; ?></td>

              <?php if($student->tmp_card_no > 300 && $student->tmp_card_no <= 500) { ?>
                <td class=" centered-cell" style="background-color:#FFCBA4"><?php echo $student->tmp_card_no; ?></td>
              <?php } else { ?>
                <td class=" centered-cell" style="background-color:#FFE5B4"><?php echo $student->tmp_card_no; ?></td>
              <?php } ?>

              <?php if (empty($student->tmp_card_time)) { ?>
                <td class=" centered-cell">absent</td>
              <?php } else { ?>
                <td class=" centered-cell"><?php echo $student->tmp_card_time; ?></td>              
              <?php } ?>

				<?php if ($student->grade_name == 'PN') { ?>
	              <?php if (empty($student->tmp_card_time)) { ?>
	                <td class=" centered-cell">absent</td>                
	              <?php } else if (strtotime($student->tmp_card_time) > strtotime("08:30:00")) { ?>
	                <td class=" centered-cell">Late In</td>
	              <?php } else { ?>
	                <td class=" centered-cell">On Time</td>
	              <?php } ?>
	            <?php } else if ($student->grade_name == 'N') { ?>
            	  <?php if (empty($student->tmp_card_time)) { ?>
	                <td class=" centered-cell">absent</td>                
	              <?php } else if (strtotime($student->tmp_card_time) > strtotime("08:15:00")) { ?>
	                <td class=" centered-cell">Late In</td>
	              <?php } else { ?>
	                <td class=" centered-cell">On Time</td>
	              <?php } ?>
	            <?php } else if ($student->grade_name == 'KG' || $student->grade_name == 'I' || $student->grade_name == 'II') { ?>
	            	<?php if (empty($student->tmp_card_time)) { ?>
	                <td class=" centered-cell">absent</td>                
	              <?php } else if (strtotime($student->tmp_card_time) > strtotime("07:45:00")) { ?>
	                <td class=" centered-cell">Late In</td>
	              <?php } else { ?>
	                <td class=" centered-cell">On Time</td>
	              <?php } ?>
	            <?php } else { ?>
                <?php if (empty($student->tmp_card_time)) { ?>
                  <td class=" centered-cell">absent</td>                
                <?php } else if (strtotime($student->tmp_card_time) > strtotime("07:40:00")) { ?>
                  <td class=" centered-cell">Late In</td>
                <?php } else { ?>
                  <td class=" centered-cell">On Time</td>
                <?php } ?>
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