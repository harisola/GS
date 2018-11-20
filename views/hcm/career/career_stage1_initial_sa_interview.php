<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $online_applicant_color_view; ?> powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Applicant<small>List</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="class_list_view_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->



          <p id="date_filter">
            <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
            <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="datepicker_to" />
          </p>
          
          <table class="display table table-striped table-hover dataTable" id="online_applicant_forms_stage1_initialsa_table" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Applied Date: activate to sort column ascending" style="width: 20px;">Applied</th>
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 15px;">Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mobile Phone: activate to sort column ascending" style="width: 100px;">NIC</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mobile Phone: activate to sort column ascending" style="width: 100px;">Mobile Phone</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Landline: activate to sort column ascending" style="width: 120px;">Landline</th>
                <!-- <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="NIC: activate to sort column ascending" style="width: 85px;">NIC</th> -->
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GC ID: activate to sort column ascending" style="width: 10px;">GC ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="View: activate to sort column ascending" style="width: 10px;">View Part A</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Handed Over: activate to sort column ascending" style="width: 10px;">Handed Over</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Gender: activate to sort column ascending" style="width: 85px;">Gender</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_applied_date" placeholder="Applied Date" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_nic" placeholder="Filter NIC" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_mobile_phone" placeholder="Filter Mobile Phone" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_landline" placeholder="Filter Landline" class="search_init"></th>
                <!-- <th rowspan="1" colspan="1"><input type="text" name="filter_nic" placeholder="Filter NIC" class="search_init"></th> -->
                <th rowspan="1" colspan="1"><input type="text" name="filter_gcid" placeholder="Filter GCID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_view" placeholder="Filter View" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_handedover" placeholder="Filter Handed Over" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gender" placeholder="Filter Gender" class="search_init"></th>                
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">

          <?php 
              $class_odd_even = 'even';
            
            foreach($this->online['applicant_data'][0] as $applicant_data) {
              $GCID = $applicant_data->gc_id;
              $converted_GCID = str_replace("-", "", $GCID);
              $converted_GCID = str_replace("/", "_", $converted_GCID);

              /*if(file_exists($this->data['applicant_form_path2'] . $converted_GCID . "_1.jpg"))
              { */
                if($class_odd_even == 'odd'){
                  $class_odd_even = 'even';
                }else{
                  $class_odd_even = 'odd';
                }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">
               <td class=" centered-cell"><?php echo unix_to_human($applicant_data->created); ?></td>
               <td class=" sorting_1"><?php echo $applicant_data->name; ?></td>
               <td class=" sorting_1"><?php echo $applicant_data->nic; ?></td>
               <td class=" centered-cell"><?php echo $applicant_data->mobile_phone; ?></td>
               <td class=" "><?php echo $applicant_data->landline; ?></td>
               <!-- <td class=" centered-cell"><?php /*echo $applicant_data->nic;*/ ?></td> -->
               <td class=" centered-cell"><?php echo $applicant_data->gc_id; ?></td>
               <td class=" centered-cell">
                  <form action="<?php echo site_url()?>/hcm/view_online_form/printForm" method="post" accept-charset="utf-8">
                  <input type="hidden" name="career_id" value="<?php echo $applicant_data->id; ?>">
                  <button type="submit" name="print" value="Print">View</button>
                  </form>
               </td>
               <?php if ($applicant_data->initial_sa_interview == 1) { ?>
                  <td class=" centered-cell aneditable_shortlist_sa" style="background-color:#ECE5B6"><a href="#" data-type="select" data-name="initial_sa_interview" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top">Yes</a></td>               
               <?php }else { ?>
                  <td class=" centered-cell aneditable_shortlist_sa" style="background-color:#F9966B"><a href="#" data-type="select" data-name="initial_sa_interview" data-pk="<?php echo $applicant_data->id; ?>" data-placement="top">No</a></td>
               <?php } ?>
               <td class=" centered-cell"><?php echo $applicant_data->gender; ?></td>
            </tr>
          <?php } /*}*/ ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of View applicants -->