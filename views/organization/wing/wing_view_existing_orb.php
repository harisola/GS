<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $title_background_color_view; ?> powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>wings<small>Existing</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="wing_existing_wrapper" class="dataTables_wrapper form-inline" role="grid">
              
          <table class="display table table-striped table-hover dataTable" id="wings_existing" aria-describedby="applicant_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 150px;">Name</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Display Name: activate to sort column ascending" style="width: 10px;">Display Name</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Created: activate to sort column ascending" style="width: 10px;">Created</th>
              </tr>
            </thead>
            
            <tfoot>
              <tr>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_wing_name" placeholder="Filter Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_wing_dname" placeholder="Filter Display Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_wing_created" placeholder="Filter Created" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            foreach($this->data['wing'] as $wing) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">              
              <td class=" sorting_1"><a href="#" data-type="text" data-name="name" data-pk="<?php echo $wing->id; ?>" data-placement="right"><?php echo $wing->name; ?></a></td>
              <td class="display_name"><a href="#" data-type="text" data-name="dname" data-pk="<?php echo $wing->id; ?>" data-placement="right"><?php echo $wing->dname; ?></a></td>
              <td class=" "><?php echo unix_to_human($wing->created); ?></td>
            </tr>            
          <?php } ?>            
          </tbody>
        </table>          
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->