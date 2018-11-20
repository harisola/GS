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

          <table class="display table table-striped table-hover dataTable" id="online_applicant_forms_table" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 15px;">Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mobile Phone: activate to sort column ascending" style="width: 100px;">Mobile Phone</th>                
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 120px;">Email</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="NIC: activate to sort column ascending" style="width: 85px;">NIC</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GC ID: activate to sort column ascending" style="width: 10px;">GC ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 10px;">Action</th>                                
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Gender: activate to sort column ascending" style="width: 85px;">Gender</th>
                <!-- <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Position Applied: activate to sort column ascending" style="width: 5px;">Position Applied</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Seeking Position: activate to sort column ascending" style="width: 5px;">Seeking Position</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Class to Teach: activate to sort column ascending" style="width: 20px;">Class to Teach</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="DOB: activate to sort column ascending" style="width: 20px;">DOB</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Notice Period: activate to sort column ascending" style="width: 20px;">Notice Period</th>                
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="When can join: activate to sort column ascending" style="width: 20px;">When can join</th> -->
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Applied Date: activate to sort column ascending" style="width: 20px;">Applied</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_mobile_phone" placeholder="Filter Mobile Phone" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_email" placeholder="Filter Email" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_nic" placeholder="Filter NIC" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gcid" placeholder="Filter GCID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_action" placeholder="Filter Action" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gender" placeholder="Filter Gender" class="search_init"></th>
                <!-- <th rowspan="1" colspan="1"><input type="text" name="filter_position_applied" placeholder="Filter Position Applied" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_seeking_position" placeholder="Filter Seeking Position" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_class_to_teach" placeholder="Filter Class to Teach" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_dob" placeholder="Filter DOB" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_notice_period" placeholder="Filter Notice Period" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_when_can_join" placeholder="Filter When Can Join" class="search_init"></th> -->
                <th rowspan="1" colspan="1"><input type="text" name="filter_applied_date" placeholder="Applied Date" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';            
            foreach($this->online['applicant_data'][0] as $applicant_data) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }              
          ?>          
            <tr class="<?php echo $class_odd_even; ?>">
               <td class=" sorting_1"><?php echo $applicant_data->name; ?></td>
               <td class=" centered-cell"><?php echo $applicant_data->mobile_phone; ?></td>
               <td class=" "><?php echo $applicant_data->email; ?></td>
               <td class=" centered-cell"><?php echo $applicant_data->nic; ?></td>
               <td class=" centered-cell"><?php echo $applicant_data->gc_id; ?></td>               
               <td class=" centered-cell">
                  <div class="btn-group">
                    <form action="<?php echo site_url()?>/hcm/view_online_form/printForm" method="post" accept-charset="utf-8">
                    <input type="hidden" name="career_id" value="<?php echo $applicant_data->id; ?>">
                      <button type="submit" class="btn btn-info" name="print" value="Print">Applicant Form</button>
                    </form>
                    <form action="<?php echo site_url()?>/hcm/view_online_form/printForm2" method="post" accept-charset="utf-8">
                    <input type="hidden" name="career_id" value="<?php echo $applicant_data->id; ?>">
                      <button type="submit" class="btn btn-warning" name="print" value="Print">Flow Record</button>                    
                    </form>
                  </div>
               </td>
               <td class=" centered-cell"><?php echo $applicant_data->gender; ?></td>
               <!-- <td class=" centered-cell"><?php /*echo $applicant_data->position_applied;*/ ?></td>
               <td class=" centered-cell"><?php /*echo $applicant_data->seeking_position;*/ ?></td>
               <td class=" centered-cell"><?php /*echo $applicant_data->class_to_teach;*/ ?></td>
               <td class=" centered-cell"><?php /*echo date("d-M-Y", strtotime($applicant_data->dob));*/ ?></td>
               <td class=" centered-cell"><?php /*echo $applicant_data->notice_period;*/ ?></td>
               <td class=" centered-cell"><?php /*echo $applicant_data->when_can_join;*/ ?></td> -->
               <td class=" "><?php echo unix_to_human($applicant_data->created); ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of View applicants -->