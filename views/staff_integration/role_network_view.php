<div class="col-md-4 bootstrap-grid sortable-grid ui-sortable">
       
  <!-- Domain Setup -->
    
    
  <div class="powerwidget dark-red" id="new_network_div" data-widget-editbutton="false" role="widget" style="">
    <header role="heading" class="ui-sortable-handle">
      <h2>School Network<small>Create new Network</small></h2>
      <div class="powerwidget-ctrls" role="menu">
        <!-- <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a> -->
        <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
      </div>
      <span class="powerwidget-loader"></span>
    </header>
    <div class="inner-spacer" role="content">
      <form action="<?php echo site_url()?>/staff_integration/setup_role_network" id="new_network_form" name="new_network_form" class="orb-form" novalidate="novalidate" method="POST">
      <?php
          if(validation_errors() != false) {
            echo '<div class="callout callout-danger">' . validation_errors() . "</div>";
          }else{
            if(count($_POST)){
              echo '<div class="callout callout-info"> saved success. </div>';              
            }
          }
        ?>
                             
        <fieldset>
          <section>
            <label class="input"> <i class="icon-append fa fa-camera-retro"></i>
              <input type="text" name="network_name" id="network_name" value="<?php if(validation_errors() != false) { echo $this->input->post('network_name'); } ?>" placeholder="Network Name" autofocus="autofocus">
              <b class="tooltip tooltip-bottom-right">Please mention the Network Name</b> </label>
          </section>

          <section>
            <label class="input"> <i class="icon-append fa fa-eye"></i>
              <input type="text" name="network_dname" id="network_dname" value="<?php if(validation_errors() != false) { echo $this->input->post('network_dname'); } ?>" placeholder="Network Display Name" required="required">
              <b class="tooltip tooltip-bottom-right">Please mention Network display name</b> </label>
          </section>
        </fieldset>

      
        <footer>            
          <button type="submit" name="new_domain_button" class="btn btn-orb-org">Save</button>
          <button type="button" style="margin-left:165px;" name="new_network_reset_button" class="btn btn-default">Reset</button>
        </footer>

      </form>
    </div>
  </div>
</div>



<!-- Datatables View users -->
  <div class="col-md-8 bootstrap-grid sortable-grid ui-sortable">

  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $title_background_color_view; ?>" id="network_table_filter" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>School Network<small>Edit</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="role_network_div" class="dataTables_wrapper form-inline" role="grid">

          <table class="display table table-striped table-hover dataTable" id="role_network_edit_table" aria-describedby="staff_info">

            <thead>
              <tr role="row">
              <!-- New Setting -->
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.: activate to sort column descending" style="width: 150px;">S.No.</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order: activate to sort column descending" style="width: 150px;">Order</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GT ID: activate to sort column ascending" style="width: 25px;">Name</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Employee Id: activate to sort column ascending" style="width: 25px;">Display Name</th>                
                <th class=" " role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GN ID: activate to sort column ascending" style="width: 10px;">GN ID</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_sno" placeholder="Filter S.No." class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_order" placeholder="Filter Order" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_dname" placeholder="Filter Display Name" class="search_init"></th>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_gnid" placeholder="Filter GN-ID" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            $SNo = 1;
            foreach($this->data['role_network'] as $role) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">
              <td class=" sorting_1 "><?php echo $SNo; ?></td>
              <td class="aneditable_network_order "><a href="#" data-type="text" data-name="order" data-pk="<?php echo $role->id; ?>" data-placement="top" data-title="Network Order"><?php echo $role->order; ?></a></td>
              <td class="aneditable_network_name "><a href="#" data-type="text" data-name="name" data-pk="<?php echo $role->id; ?>" data-placement="top" data-title="Network Name"><?php echo $role->name; ?></a></td>
              <td class="aneditable_network_dname "><a href="#" data-type="text" data-name="dname" data-pk="<?php echo $role->id; ?>" data-placement="top" data-title="Network Display Name"><?php echo $role->dname; ?></a></td>              
              <td class=" "><?php echo $role->gn_id; ?></td>
            </tr>
          <?php $SNo++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->