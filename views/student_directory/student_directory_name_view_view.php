<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $class_list_color_view; ?> powerwidget-sortable" id="student_directory_div" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Student Directory<small>All Students</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">

        <div id="student_directory_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="student_directory_table" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Call Name: activate to sort column descending" style="width: 15px;">Call Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Abridged Name: activate to sort column ascending" style="width: 15px;">Abridged Name</th>                
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Official Name: activate to sort column ascending" style="width: 15px;">Official Name</th>                
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Grade-Section: activate to sort column ascending" style="width: 5px;">Grade-Section</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Gender: activate to sort column ascending" style="width: 5px;">Gender</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 5px;">Status</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GS ID: activate to sort column ascending" style="width: 5px;">GS ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GF ID: activate to sort column ascending" style="width: 5px;">GF ID</th>

                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="House: activate to sort column ascending" style="width: 5px;">House</th>

                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Father Name: activate to sort column ascending" style="width: 5px;">Father Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Father NIC: activate to sort column ascending" style="width: 5px;">Father NIC</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Father Mobile: activate to sort column ascending" style="width: 5px;">Father Mobile</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Father Speciality: activate to sort column ascending" style="width: 5px;">Father Speciality</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Father Profession: activate to sort column ascending" style="width: 5px;">Father Profession</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Father Organization: activate to sort column ascending" style="width: 5px;">Father Organization</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Father Department: activate to sort column ascending" style="width: 5px;">Father Department</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Father Designation: activate to sort column ascending" style="width: 5px;">Father Designation</th>



                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mother Name: activate to sort column ascending" style="width: 5px;">Mother Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mother NIC: activate to sort column ascending" style="width: 5px;">Mother NIC</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mother Mobile: activate to sort column ascending" style="width: 5px;">Mother Mobile</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mother Speciality: activate to sort column ascending" style="width: 5px;">Mother Speciality</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mother Profession: activate to sort column ascending" style="width: 5px;">Mother Profession</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mother Organization: activate to sort column ascending" style="width: 5px;">Mother Organization</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mother Department: activate to sort column ascending" style="width: 5px;">Mother Department</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mother Designation: activate to sort column ascending" style="width: 5px;">Mother Designation</th>



                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Home Phone: activate to sort column ascending" style="width: 5px;">Home Phone</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Apartment No: activate to sort column ascending" style="width: 5px;">Apartment No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Building Name: activate to sort column ascending" style="width: 5px;">Building Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Plot No: activate to sort column ascending" style="width: 5px;">Plot No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Street Name activate to sort column ascending" style="width: 5px;">Street Name</th>                
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Sub Region: activate to sort column ascending" style="width: 5px;">Sub Region</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Region: activate to sort column ascending" style="width: 5px;">Region</th>
                

              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_call_name" placeholder="Filter Call Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_abridged_name" placeholder="Filter Abridged Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_official_name" placeholder="Filter Official Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_grade_section" placeholder="Filter Grade-Section" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gender" placeholder="Filter Gender" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_status" placeholder="Filter Status" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gsid" placeholder="Filter GS ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gfid" placeholder="Filter GF ID" class="search_init"></th>
  
                <th rowspan="1" colspan="1"><input type="text" name="filter_house" placeholder="Filter House" class="search_init"></th>

                <th rowspan="1" colspan="1"><input type="text" name="filter_father_name" placeholder="Filter Father Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_father_nic" placeholder="Filter Father NIC" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_father_mobile" placeholder="Filter Father Mobile" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_father_speciality" placeholder="Filter Father Speciality" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_father_profession" placeholder="Filter Father Profession" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_father_organization" placeholder="Filter Father Organization" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_father_department" placeholder="Filter Father Department" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_father_designation" placeholder="Filter Father Designation" class="search_init"></th>


                <th rowspan="1" colspan="1"><input type="text" name="filter_mother_name" placeholder="Filter Mother Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_mother_nic" placeholder="Filter Mother NIC" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_mother_mobile" placeholder="Filter Mother Mobile" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_mother_speciality" placeholder="Filter Mother Speciality" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_mother_profession" placeholder="Filter Mother Profession" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_mother_organization" placeholder="Filter Mother Organization" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_mother_department" placeholder="Filter Mother Department" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_mother_designation" placeholder="Filter Mother Designation" class="search_init"></th>



                <th rowspan="1" colspan="1"><input type="text" name="filter_home_phone" placeholder="Filter Home Phone" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_apartment_no" placeholder="Filter Apartment No" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_building_name" placeholder="Filter Building Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_plot_no" placeholder="Filter Plot No" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_street_name" placeholder="Filter Street Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_sub_region" placeholder="Filter Sub Region" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_region" placeholder="Filter Region" class="search_init"></th>                
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            foreach($this->StudentData as $class_list) {
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
              <td class=" centered-cell"><?php echo $class_list['grade_name'] . '-' . $class_list['section_name']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['gender']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['student_status_name']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['gs_id']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['gf_id']; ?></td>

              <?php if($class_list['house_dname'] != 'Jinnah') {?>

                <td class=" centered-cell" style="background-color:#<?php echo $class_list['house_color_hex'];?>"><a data-toggle="modal" style="text-decoration:none !important; text-decoration:none;" class="show_student_information" data-id="<?php echo $class_list['gr_no'];?>" href="#"><span style="color:white"><?php echo $class_list['house_dname']; ?></span></td>
                </a>
              <?php } else{?>

                <td class=" centered-cell" style="background-color:#<?php echo $class_list['house_color_hex'];?>"><a data-toggle="modal" style="text-decoration:none !important; text-decoration:none;" class="show_student_information" data-id="<?php echo $class_list['gr_no'];?>" href="#"><span style="color:black"><?php echo $class_list['house_dname']; ?></td>
                </a>
              <?php } ?>

              <td class=" "><?php echo $class_list['father_name']; ?></td>
              <td class=" "><?php echo $class_list['father_nic']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['father_mobile_phone']; ?></td>
              <td class=" "><?php echo $class_list['father_speciality']; ?></td>
              <td class=" "><?php echo $class_list['father_profession']; ?></td>
              <td class=" "><?php echo $class_list['father_organization']; ?></td>
              <td class=" "><?php echo $class_list['father_department']; ?></td>
              <td class=" "><?php echo $class_list['father_desgination']; ?></td>

              <td class=" "><?php echo $class_list['mother_name']; ?></td>
              <td class=" "><?php echo $class_list['mother_nic']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['mother_mobile_phone']; ?></td>
              <td class=" "><?php echo $class_list['mother_speciality']; ?></td>
              <td class=" "><?php echo $class_list['mother_profession']; ?></td>
              <td class=" "><?php echo $class_list['mother_organization']; ?></td>
              <td class=" "><?php echo $class_list['mother_department']; ?></td>
              <td class=" "><?php echo $class_list['mother_desgination']; ?></td>
        

              <td class=" "><?php echo $class_list['home_phone']; ?></td>
              <td class=" "><?php echo $class_list['apartment_no']; ?></td>
              <td class=" "><?php echo $class_list['building_name']; ?></td>
              <td class=" "><?php echo $class_list['plot_no']; ?></td>
              <td class=" "><?php echo $class_list['street_name']; ?></td>
              <td class=" "><?php echo $class_list['sub_region']; ?></td>
              <td class=" "><?php echo $class_list['region']; ?></td>
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