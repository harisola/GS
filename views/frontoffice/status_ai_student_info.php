<!-- Datatables View users -->
  <div class="col-md-9 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $class_list_color_view; ?> powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Status Change<small>Detail</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="new_admission_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="statusai_student_table" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="descending" aria-label="SNo: activate to sort column descending" style="width: 15px;">S.No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GS ID: activate to sort column ascending" style="width: 100px;">GS ID</th>                
                <!-- <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GF ID: activate to sort column ascending" style="width: 120px;">GF ID</th> -->
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Abridged Name: activate to sort column ascending" style="width: 85px;">Abridged Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Grade: activate to sort column ascending" style="width: 85px;">Grade</th>                
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Section: activate to sort column ascending" style="width: 5px;">Section</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Request Date: activate to sort column ascending" style="width: 20px;">Req Date</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="W.E.F: activate to sort column ascending" style="width: 20px;">W.E.F</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Old Status: activate to sort column ascending" style="width: 20px;">Old Status</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="New Status: activate to sort column ascending" style="width: 20px;">New Status</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Reason: activate to sort column ascending" style="width: 20px;">Reason</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="IP: activate to sort column ascending" style="width: 20px;">IP</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Created: activate to sort column ascending" style="width: 20px;">Created</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_sno" placeholder="Filter SNo" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gsid" placeholder="Filter GS ID" class="search_init"></th>                
                <!-- <th rowspan="1" colspan="1"><input type="text" name="filter_gfid" placeholder="Filter GF ID" class="search_init"></th> -->
                <th rowspan="1" colspan="1"><input type="text" name="filter_abridgedname" placeholder="Filter Abridged Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_grade" placeholder="Filter Grade" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section" placeholder="Filter Section" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_reqdate" placeholder="Filter Req Date" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_wef" placeholder="Filter W.E.F" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_oldstatus" placeholder="Filter Old Status" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_oldstatus" placeholder="Filter New Status" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_reason" placeholder="Filter Reason" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_ip" placeholder="Filter IP" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_created" placeholder="Filter Created" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            $SNo = 1;
            foreach($this->data['StatusAI'] as $table_data) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">              
              <!-- <form action="<?php echo site_url()?>/fo/student_withdrawal/printForm2" method="post" accept-charset="utf-8"> -->
                <td class=" centered-cell sorting_2"><input type="submit" name="withdrawal_id" value="<?php echo $table_data['id']; ?>"></td>
              <!-- </form> -->
              <td class=" centered-cell"><?php echo $table_data['gs_id']; ?></td>              
              <!-- <td class=" centered-cell"><?php //echo $table_data['gf_id']; ?></td> -->
              <td class=" "><?php echo $table_data['abridged_name']; ?></td>
              <td class=" centered-cell"><?php echo $table_data['grade_name']; ?></td>
              <td class=" centered-cell"><?php echo $table_data['section_name']; ?></td>
              <td class=" "><?php echo $table_data['req_date']; ?></td>
              <td class=" centered-cell"><?php echo $table_data['wef_date']; ?></td>
              <td class=" centered-cell"><?php echo $table_data['old_status_name']; ?></td>
              <td class=" centered-cell"><?php echo $table_data['new_status_name']; ?></td>
              <td class=" centered-cell"><?php echo $table_data['description']; ?></td>
              <td class=" centered-cell"><?php echo $table_data['ip']; ?></td>              
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