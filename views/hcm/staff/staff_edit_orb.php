<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">

  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $title_background_color_view; ?>" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Staff<small>Edit</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="staff_edit_table_wrapper" class="dataTables_wrapper form-inline" role="grid">

          <table class="display table table-striped table-hover dataTable" id="staff_edit_table" aria-describedby="staff_info">

            <thead>
              <tr role="row">
              <!-- New Setting -->
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.: activate to sort column descending" style="width: 150px;">S.No.</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Staff ID: activate to sort column ascending" style="width: 5px;">Staff ID</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GT ID: activate to sort column ascending" style="width: 25px;">GT ID</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Employee Id: activate to sort column ascending" style="width: 25px;">Old Employee ID</th>
                <th class=" " role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Photo: activate to sort column ascending" style="width: 10px;">Photo</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="NIC Name: activate to sort column ascending" style="width: 85px;">NIC Name</th>

                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Old Status: activate to sort column ascending" style="width: 20px;">Old Status</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="New Status: activate to sort column ascending" style="width: 20px;">New Status</th>

                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GG Id: activate to sort column ascending" style="width: 25px;">GG Id</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Campus: activate to sort column ascending" style="width: 5px;">Campus</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Type: activate to sort column ascending" style="width: 5px;">Staff Type</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Staff Category: activate to sort column ascending" style="width: 25px;">Staff Category</th>


                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="N I C: activate to sort column ascending" style="width: 100px;">N I C</th>                
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Card Top Line: activate to sort column ascending" style="width: 85px;">Card Top Line</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Card Bottom Line: activate to sort column ascending" style="width: 85px;">Card Bottom Line</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Title: activate to sort column ascending" style="width: 10px;">Title</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Full Name: activate to sort column ascending" style="width: 85px;">Full Name</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="NameCode: activate to sort column ascending" style="width: 10px;">NameCode</th>

                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="DOJ: activate to sort column ascending" style="width: 100px;">DOJ</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="DOB: activate to sort column ascending" style="width: 100px;">DOB</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Gender: activate to sort column ascending" style="width: 10px;">Gender</th>                

                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mobile Phone: activate to sort column ascending" style="width: 85px;">Mobile Phone</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Land Line: activate to sort column ascending" style="width: 85px;">Land Line</th>

                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Designation: activate to sort column ascending" style="width: 50px;">Designation</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending" style="width: 50px;">Department</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Section: activate to sort column ascending" style="width: 50px;">Section</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Sub Section: activate to sort column ascending" style="width: 25px;">Sub Section</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Category: activate to sort column ascending" style="width: 25px;">Category</th>

                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Active: activate to sort column ascending" style="width: 25px;">Active</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Post: activate to sort column ascending" style="width: 25px;">Post</th>
                <th class=" " role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Image: activate to sort column ascending" style="width: 5px;">Image</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Recorded: activate to sort column ascending" style="width: 25px;">Recorded</th>

              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_sno" placeholder="Filter S.No." class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gt_id" placeholder="Filter Staff ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gt_id" placeholder="Filter GT ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_employee_id" placeholder="Filter Employee Id" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_photo" placeholder="Filter Photo" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_staff_name" placeholder="Filter NIC Name" class="search_init"></th>

                <th rowspan="1" colspan="1"><input type="text" name="filter_old_status" placeholder="Filter Old Status" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_new_status" placeholder="Filter New Status" class="search_init"></th>

                <th rowspan="1" colspan="1"><input type="text" name="filter_gg_id" placeholder="Filter GG Id" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_campus" placeholder="Filter Campus" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_campus" placeholder="Filter Staff Type" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_staff_category" placeholder="Filter Staff Category" class="search_init"></th>

                <th rowspan="1" colspan="1"><input type="text" name="filter_nic" placeholder="Filter NIC" class="search_init"></th>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_card_top_line" placeholder="Filter Card Top Line" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_card_bottom_line" placeholder="Filter Card Bottom Line" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_staff_title" placeholder="Filter Title" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_abridged_name" placeholder="Filter Full Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name_code" placeholder="Filter NameCode" class="search_init"></th>

                <th rowspan="1" colspan="1"><input type="text" name="filter_doj" placeholder="Filter DOJ" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_dob" placeholder="Filter DOB" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gender" placeholder="Filter Gender" class="search_init"></th>                

                <th rowspan="1" colspan="1"><input type="text" name="filter_mobile_phone" placeholder="Filter Mobile Phone" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_land_line" placeholder="Filter Land Line" class="search_init"></th>

                <th rowspan="1" colspan="1"><input type="text" name="filter_designation" placeholder="Filter Designation" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_department" placeholder="Filter Department" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section" placeholder="Filter Section" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_sub_section" placeholder="Filter Sub Section" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_category" placeholder="Filter Category" class="search_init"></th>

                <th rowspan="1" colspan="1"><input type="text" name="filter_active" placeholder="Filter Active" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_post" placeholder="Filter Post" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_image" placeholder="Filter Image" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_recorded" placeholder="Filter Recorded" class="search_init"></th>

              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            $SNo = 1;
            foreach($this->staff_data['staff_data'][0] as $staff_record) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">
              <td class=" sorting_1 centered-cell"><?php echo $SNo; ?></td>
              <td class=" centered-cell"><?php echo $staff_record->id; ?></td>
              <td class=" aneditable_gt_id centered-cell"><a href="#" data-type="text" data-name="gt_id" data-pk="<?php echo $staff_record->id; ?>" data-placement="right"><?php echo $staff_record->gt_id; ?></a></td>
              <td class=" aneditable_employee_id centered-cell"><a href="#" data-type="text" data-name="employee_id" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->employee_id; ?></a></td>
              <?php
                $ImageName = base_url() . $this->data['staff_150_photo_path'] . $staff_record->employee_id . $this->data['photo_file'];
                $ImageMale = base_url() . $this->data['staff_150_photo_path'] . "male.png";
                $ImageFemale = base_url() . $this->data['staff_150_photo_path'] . "female.png";
                $ImageFound = "Yes";

                if (!file_exists($this->data['staff_150_photo_path'] . $staff_record->employee_id . $this->data['photo_file'])) {
                    if($staff_record->gender == 'M'){
                        $ImageName = $ImageMale;
                    }else if($staff_record->gender == 'F'){
                        $ImageName = $ImageFemale;
                    }

                    $ImageFound = "No";
                }
              ?>
              <td><img src="<?php echo $ImageName; ?>" alt="" border=3 height=50 width=50></img></td>
              <td class=" aneditable_staff_name"><a href="#" data-type="text" data-name="name" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->name; ?></a></td>


              <td class="centered-cell"><?php echo $staff_record->status_code; ?></td> 
              <td class="aneditable_staff_status centered-cell"><a href="#" data-type="select" data-name="staff_status" data-pk="<?php echo $staff_record->id; ?>" data-placement="top" data-title="Status"><?php echo $staff_record->staff_status_name; ?></td> 


              <td class=" aneditable_gg_id"><a href="#" data-type="text" data-name="gg_id" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->gg_id; ?></a></td>

              <?php if($staff_record->branch_id == 1) { ?>
                <td class=" centered-cell aneditable_branch_id"><a href="#" data-type="select" data-name="branch_id" data-pk="<?php echo $staff_record->id; ?>" data-placement="top">North</a></td>
              <?php } else if($staff_record->branch_id == 2) { ?>
                <td class=" centered-cell aneditable_branch_id"><a href="#" data-type="select" data-name="branch_id" data-pk="<?php echo $staff_record->id; ?>" data-placement="top">South</a></td>
              <?php } else { ?>
                <td class=" centered-cell aneditable_branch_id"><a href="#" data-type="select" data-name="branch_id" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"></a></td>
              <?php } ?>


              <td class=" centered-cell aneditable_staff_type"><a href="#" data-type="select" data-name="staff_type" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->staff_type; ?></a></td>


              <td class=" centered-cell"><?php echo $staff_record->staff_category; ?></td>

              <td class="aneditable_nic centered-cell"><a href="#" data-type="text" data-name="nic" data-pk="<?php echo $staff_record->id; ?>" data-placement="top" data-title="N I C"><?php echo $staff_record->nic; ?></td> 


              <td class=" aneditable_staff_name"><a href="#" data-type="text" data-name="c_topline" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->c_topline; ?></a></td>
              <td class=" aneditable_staff_name"><a href="#" data-type="text" data-name="c_bottomline" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->c_bottomline; ?></a></td>
              <td class=" aneditable_staff_title centered-cell"><a href="#" data-type="select" data-name="title_person_id" data-pk="<?php echo $staff_record->id; ?>" data-placement="top">
              <?php
                foreach ($this->staff_data['staff_title'][0] as $StaffTitle) {
                    if($staff_record->title_person_id == $StaffTitle->id) {
                        echo $StaffTitle->title;
                    }
                }
              ?></a></td>
              <td class=" aneditable_abridged_name"><a href="#" data-type="text" data-name="abridged_name" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->abridged_name; ?></a></td>
              <td class=" aneditable_name_code centered-cell"><a href="#" data-type="text" data-name="name_code" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->name_code; ?></a></td>

              <td class=" aneditable_doj centered-cell"><a href="#" id="doj" data-type="combodate" data-value="<?php echo $staff_record->doj; ?>" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="<?php echo $staff_record->id; ?>" data-title="Select Date of joining" class="editable editable-click" data-original-title="" title=""><?php echo $staff_record->doj; ?></a></td>
              <td class=" aneditable_dob centered-cell"><a href="#" id="dob" data-type="combodate" data-value="<?php echo $staff_record->dob; ?>" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="<?php echo $staff_record->id; ?>"  data-title="Select Date of birth" class="editable editable-click" data-original-title="" title=""><?php echo $staff_record->dob; ?></a></td>
              <td class=" aneditable_gender centered-cell"><a href="#" data-type="select" data-name="gender" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->gender; ?></a></td>                            

              <td class=" aneditable_mobile_phone centered-cell"><a href="#" data-type="text" data-name="mobile_phone" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->mobile_phone; ?></a></td>
              <td class=" aneditable_landline centered-cell"><a href="#" data-type="text" data-name="landline" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->land_line; ?></a></td>

              <td class=" aneditable_designation"><a href="#" data-type="text" data-name="designation" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->designation; ?></a></td>
              <td class=" aneditable_department"><a href="#" data-type="text" data-name="department" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->department; ?></a></td>
              <td class=" aneditable_section"><a href="#" data-type="text" data-name="section" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->section; ?></a></td>
              <td class=" aneditable_sub_section"><a href="#" data-type="text" data-name="sub_section" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->sub_section; ?></a></td>
              <td class=" aneditable_category centered-cell"><a href="#" data-type="select" data-name="category" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php echo $staff_record->category; ?></a></td>

              <td class=" aneditable_is_active centered-cell"><a href="#" data-type="select" data-name="is_active" data-pk="<?php echo $staff_record->id; ?>" data-placement="top"><?php if($staff_record->is_active==1) {echo "Yes";} else { echo "No";} ?></a></td>
              <td class=" aneditable_is_posted centered-cell"><a href="#" data-type="select" data-name="is_posted" data-pk="<?php echo $staff_record->id; ?>" data-placement="left"><?php if($staff_record->is_posted==1) {echo "Yes";} else { echo "No";} ?></a></td>

              <td class=" centered-cell"><?php echo $ImageFound; ?></td>
              <td class=" centered-cell"><?php echo unix_to_human($staff_record->created); ?></td>
            </tr>
          <?php $SNo++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->