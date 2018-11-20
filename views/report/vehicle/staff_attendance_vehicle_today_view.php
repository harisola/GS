<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $class_list_color_view; ?> powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Vehicle <small>In</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="class_list_view_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->
<table class="tg">
  <tr>
    <th class="tg-031e" style="width: 10px;"></th>
    <th class="tg-031e">
      <form action="<?php echo site_url()?>/vehicle/report_vehicle_in" id="attendance_staff_Vehicle" name="attendance_staff_Vehicle" method="POST">
          <input id="e1" name="e1" style="display: inline-block !important;">
          <button type="submit" class="btn btn-primary">Report</button>
      </form>
    </th>
  </tr>
</table>
          <table class="display table table-striped table-hover dataTable" id="attendance_staff_today_table" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="GT ID: activate to sort column descending" style="width: 15px;">Abridged Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Photo: activate to sort column ascending" style="width: 100px;">Date</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Formal Name: activate to sort column ascending" style="width: 100px;">Time</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending" style="width: 120px;">Registration No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Designation: activate to sort column ascending" style="width: 85px;">Gv id</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Top Line: activate to sort column ascending" style="width: 85px;">Name code</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_call_name" placeholder="Filter Abridged Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_photo" placeholder="Filter Date" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_abridged_name" placeholder="Filter Time" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_official_name" placeholder="Filter Registration No" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_dob" placeholder="Filter Gv Id" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_grade_section" placeholder="Filter Name code" class="search_init"></th>
               
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          
          <?php
     foreach($this->attendance_vehicle_today_model->gettable($this->dateRangeFrom, $this->dateRangeTo) as $row) 
    {
      ?>
      <tr>
      
   <td class=" centered-cell"><?php echo $row->abridged_name; ?></td>
   <td class=" centered-cell"><?php echo $row->date; ?></td>
    <td class=" centered-cell"><?php echo $row->time; ?></td>
     <td class=" centered-cell"><?php echo $row->registration_no; ?></td>
      <td class=" centered-cell"><?php echo $row->gv_id; ?></td>
      <td class=" centered-cell"><?php echo $row->name_code; ?></td>
      </tr>
          <?php
      }
       ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
