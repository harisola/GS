<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $title_background_color_view; ?> powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>sections<small>Existing</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="section_existing_wrapper" class="dataTables_wrapper form-inline" role="grid">
              
          <table class="display table table-striped table-hover dataTable" id="sections_existing" aria-describedby="applicant_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 150px;">Name</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Display Name: activate to sort column ascending" style="width: 10px;">Display Name</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Gender: activate to sort column ascending" style="width: 10px;">Gender</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Created: activate to sort column ascending" style="width: 10px;">Created</th>
              </tr>
            </thead>
            
            <tfoot>
              <tr>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_section_name" placeholder="Filter Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section_dname" placeholder="Filter Display Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section_gender" placeholder="Filter Gender" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_section_created" placeholder="Filter Created" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            foreach($this->data['section'] as $section) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">              
              <td class=" sorting_1"><a href="#" data-type="text" data-name="name" data-pk="<?php echo $section->id; ?>" data-placement="right"><?php echo $section->name; ?></a></td>
              <td class="display_name"><a href="#" data-type="text" data-name="dname" data-pk="<?php echo $section->id; ?>" data-placement="right"><?php echo $section->dname; ?></a></td>
              <td class="gender"><a href="#" data-type="select" data-name="gender" data-pk="<?php echo $section->id; ?>" data-placement="top" data-title="Gender"><?php echo $section->gender; ?></td>
              <td class=" "><?php echo unix_to_human($section->created); ?></td>
            </tr>            
          <?php } ?>            
          </tbody>
        </table>          
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->