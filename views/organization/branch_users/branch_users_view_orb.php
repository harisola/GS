<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $title_background_color_view; ?> powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Users in branch<small>Edit</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="users_edit_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
              
          <table class="display table table-striped table-hover dataTable" id="users_edit_table" aria-describedby="applicant_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="User Name: activate to sort column descending" style="width: 150px;">User Name</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Branch: activate to sort column ascending" style="width: 10px;">Branch</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Created: activate to sort column ascending" style="width: 10px;">Created</th>
              </tr>
            </thead>
            
            <tfoot>
              <tr>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_user_name" placeholder="Filter User Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_branch" placeholder="Filter Branch" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_branch" placeholder="Filter Created" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            foreach($this->branch_data['users_in_branch'] as $branch_users) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">              
              <td class=" "><?php echo ucwords($branch_users->username); ?></td>
              <td class="selectbranch"><a href="#" data-type="select" data-name="branch_id" data-pk="<?php echo $branch_users->id; ?>" data-placement="top" data-title="Branch"><?php echo $branch_users->branch_name; ?></td>
              <td class=" "><?php echo unix_to_human($branch_users->created); ?></td>
            </tr>            
          <?php } ?>            
          </tbody>
        </table>          
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->