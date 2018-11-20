<!-- Datatables View users -->
  <div class="col-md-8 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $class_list_color_view; ?> powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>New Admission<small>Detail</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="new_admission_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="new_admission_table" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="descending" aria-label="SNo: activate to sort column descending" style="width: 15px;">S.No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GS ID: activate to sort column ascending" style="width: 100px;">GS ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Form No: activate to sort column ascending" style="width: 100px;">Form No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GR No: activate to sort column ascending" style="width: 120px;">GR No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 85px;">Student Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Grade: activate to sort column ascending" style="width: 85px;">Grade</th>                
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Gender: activate to sort column ascending" style="width: 5px;">Gender</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Father Name: activate to sort column ascending" style="width: 20px;">Father Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Father NIC: activate to sort column ascending" style="width: 20px;">Father NIC</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Undertaking: activate to sort column ascending" style="width: 20px;">Undertaking</th>                
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Red File: activate to sort column ascending" style="width: 20px;">Red File</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GS Register: activate to sort column ascending" style="width: 20px;">GS Register</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Created: activate to sort column ascending" style="width: 20px;">Created</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_sno" placeholder="Filter SNo" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gsid" placeholder="Filter GS ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_formno" placeholder="Filter Form No" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_grno" placeholder="Filter GR No" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_studentname" placeholder="Filter Student Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_grade" placeholder="Filter Grade" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gender" placeholder="Filter Gender" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_fathername" placeholder="Filter Father Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_fathernic" placeholder="Filter Father NIC" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_undertaking" placeholder="Filter Undertaking" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_redfile" placeholder="Filter Red File" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gsregister" placeholder="Filter GS Register" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gsregister" placeholder="Filter Created" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            $SNo = 1;
            foreach($this->data['AdmissionData'] as $table_data) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">              
              <form action="<?php echo site_url()?>/fo/new_admission/printForm2" method="post" accept-charset="utf-8">
                <td class=" centered-cell sorting_2"><input type="submit" name="new_admission_id" value="<?php echo $table_data['id']; ?>"></td>
              </form>
              <td class=" centered-cell"><?php echo $table_data['gs_id']; ?></td>
              <td class=" centered-cell"><?php echo $table_data['form_no']; ?></td>
              <td class=" centered-cell"><?php echo $table_data['gr_no']; ?></td>
              <td class=" "><?php echo $table_data['student_name']; ?></td>
              <td class=" centered-cell"><?php echo $table_data['grade_name']; ?></td>
              <td class=" centered-cell"><?php echo $table_data['gender']; ?></td>
              <td class=" "><?php echo $table_data['father_name']; ?></td>
              <td class=" centered-cell"><?php echo $table_data['father_nic']; ?></td>
              <td class=" centered-cell"><?php if($table_data['undertaking'] == 1) { echo "Y"; } else { echo "N"; } ?></td>
              <td class=" centered-cell"><?php if($table_data['file_created'] == 1) { echo "Y"; } else { echo "N"; } ?></td>
              <td class=" centered-cell"><?php if($table_data['register_entry'] == 1) { echo "Y"; } else { echo "N"; } ?></td>
              <td class=" centered-cell"><?php echo unix_to_human($table_data['created']); ?></td>
            </tr>
          <?php $SNo++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->
<!-- <td class=" centered-cell" style="background-color:#<?php echo $class_list['house_color_hex'];?>"><span style="background-color:#<?php echo $class_list['house_color_hex'];?>"><?php echo $class_list['house_dname']; ?></span></td>
-->