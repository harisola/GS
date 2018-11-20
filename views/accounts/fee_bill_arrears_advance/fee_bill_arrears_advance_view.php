<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $class_list_color_view; ?> powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Arrears / Advance<small>List</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">


        <div id="class_list_view_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="student_ana_table" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 10px;">GS ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 10px;">GF ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 10px;">Pet Type</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 10px;">Pet Code</th>

                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Abridged Name: activate to sort column ascending" style="width: 20px;">Abridged Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Grade: activate to sort column ascending" style="width: 10px;">Grade</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Section: activate to sort column ascending" style="width: 10px;">Section</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Status: activate to sort column ascending" style="width: 10px;">Student Status</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Last Bill: activate to sort column ascending" style="width: 10px;">Last Generated Bill</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Arrears_Advance: activate to sort column ascending" style="width: 10px;">Arrears / Advance</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Grade ID: activate to sort column ascending" style="width: 10px;">Grade ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Section ID: activate to sort column ascending" style="width: 10px;">Section ID</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gsid" placeholder="Filter GS-ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gfid" placeholder="Filter GF-ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gfid" placeholder="Filter Petitioner Type" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gfid" placeholder="Filter Petitioner Code" class="search_init"></th>

                <th rowspan="1" colspan="1"><input type="text" name="filter_abridged_name" placeholder="Filter Abridged Name" class="search_init"></th>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_grade" placeholder="Filter Grade" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section" placeholder="Filter Section" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_student_status" placeholder="Filter Student Status" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_bill" placeholder="Filter Last Bill" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section" placeholder="Filter Arrears/Advance" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_grade_id" placeholder="Filter GradeID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section_id" placeholder="Filter SectionID" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            foreach($this->data['fee_arrears_advance'] as $class_list) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">
              <td class=" centered-cell"><?php echo $class_list['gs_id']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['gf_id']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['petitioner_type']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['petitioner_code']; ?></td>

              <td class=" "><?php echo $class_list['abridged_name']; ?></td>              
              <td class=" centered-cell"><?php echo $class_list['grade_name']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['section_name']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['student_status_name']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['last_bill_title']; ?></td>
              <?php if(intval($class_list['balance'])>0) { ?>                
                <td class=" centered-cell"><font color="red"><?php echo number_format($class_list['balance']); ?></font></td>                
              <?php } else { ?>
                <td class=" centered-cell"><?php echo number_format($class_list['balance']); ?></td>
              <?php } ?>
              <td class=" centered-cell"><?php echo $class_list['grade_id']; ?></td>
              <td class=" centered-cell"><?php echo $class_list['section_id']; ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>