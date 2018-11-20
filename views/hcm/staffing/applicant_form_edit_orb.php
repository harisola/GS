<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $title_background_color_view; ?> powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Applicant Forms<small>Edit</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="applicant_edit_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
              
          <table class="display table table-striped table-hover dataTable" id="applicant_edit_table" aria-describedby="applicant_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Applicant Name: activate to sort column descending" style="width: 150px;">Applicant Name</th>
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Applicant Name: activate to sort column descending" style="width: 10px;">GC ID</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Gender: activate to sort column ascending" style="width: 10px;">Gender</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="N I C: activate to sort column ascending" style="width: 85px;">N I C</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mobile Phone: activate to sort column ascending" style="width: 85px;">Mobile Phone</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Land Line: activate to sort column ascending" style="width: 85px;">Land Line</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 85px;">Position</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Applied Date: activate to sort column ascending" style="width: 85px;">Applied Date</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Form #: activate to sort column ascending" style="width: 25px;">Form #</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Campus: activate to sort column ascending" style="width: 25px;">Campus</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Campus Form #: activate to sort column ascending" style="width: 25px;">Campus Form #</th>
              </tr>
            </thead>
            
            <tfoot>
              <tr>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_applicant_name" placeholder="Filter Applicant Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gcid" placeholder="Filter GC-ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gender" placeholder="Filter Gender" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_nic" placeholder="Filter N I C" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_mobile_phone" placeholder="Filter Mobile Phone" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_land_line" placeholder="Filter Land Line" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_position" placeholder="Filter Position Applied" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_applied_date" placeholder="Filter Applied Date" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_form_no" placeholder="Filter Form #" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_campus" placeholder="Filter Campus" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_campus_form_no" placeholder="Filter Campus Form #" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            foreach($this->users_data['applicant_data'][0] as $applicant_record) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">              
              <td class=" sorting_1"><a href="#" data-type="text" data-name="full_name" data-pk="<?php echo $applicant_record->id; ?>" data-placement="right"><?php echo $applicant_record->full_name; ?></a></td>
              <td class=" "><?php echo $applicant_record->gc_id; ?></td>
              <td class="aneditablegender"><a href="#" data-type="select" data-name="gender" data-pk="<?php echo $applicant_record->id; ?>" data-placement="top" data-title="Gender"><?php echo $applicant_record->gender; ?></td>
              <td class="aneditablerequirednic"><a href="#" data-type="text" data-name="nic" data-pk="<?php echo $applicant_record->id; ?>" data-placement="top" data-title="N I C"><?php echo $applicant_record->nic; ?></td>
              <td class="aneditablerequiredmobilephone"><a href="#" data-type="text" data-name="mobile_phone" data-pk="<?php echo $applicant_record->id; ?>" data-placement="top" data-title="Mobile Phone"><?php echo $applicant_record->mobile_phone; ?></td>
              <td class="aneditablelandline"><a href="#" data-type="text" data-name="land_line" data-pk="<?php echo $applicant_record->id; ?>" data-placement="top" data-title="Land line"><?php echo $applicant_record->land_line; ?></td>
              <td class="aneditableposition"><a href="#" data-type="select2" data-name="position" data-pk="<?php echo $applicant_record->id; ?>" data-placement="top" data-title="Position"><?php echo $applicant_record->position; ?></td>
              <td class=" "><?php echo unix_to_human($applicant_record->created); ?></td>
              <td class=" "><?php echo $applicant_record->id; ?></td>
              <td class=" "><?php if($applicant_record->branch_id == 1) {
                            echo "North";
                            } else if($applicant_record->branch_id == 2) {
                            echo "South";
                            } ?></td>
              <td class=" "><?php echo $applicant_record->branch_form_no; ?></td>
              <!--<td class=" "><?php echo $applicant_record->modified; ?></td> -->
            </tr>            
          <?php } ?>            
          </tbody>
        </table>          
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->