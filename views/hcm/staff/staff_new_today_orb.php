<div class="col-md-6 bootstrap-grid sortable-grid ui-sortable"> 
  <!-- New widget -->
  
  <div class="powerwidget cold-grey powerwidget-sortable" id="table2" data-widget-editbutton="false" role="widget" style="position: relative; opacity: 1;">
    <header role="heading">
      <h2>Staff<small>Today</small></h2>
      <div class="powerwidget-ctrls" role="menu">
        <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
        <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
      </div><span class="powerwidget-loader"></span>
    </header>
    <div class="inner-spacer" role="content">
      <table class="table table-condensed table-bordered margin-0px">
        <thead>
          <tr>
            <th>Employee Id</th>
            <th>Official Name</th>
            <th>Gender</th>
            <th>Mobile Phone</th>
          </tr>
        </thead>
        <tbody>
           <?php
            $class_active = '';
            foreach($this->staff_today_data['staff_today_data'][0] as $staff_record) {
              if($class_active == ''){
                $class_active = 'active';
              }else{
                $class_active = '';
              }
          ?>
            <tr class="<?php echo $class_active; ?>">
              <td><?php echo $staff_record->employee_id; ?></td>
              <td><?php echo $staff_record->name; ?></td>
              <td><?php echo $staff_record->gender; ?></td>
              <td><?php echo $staff_record->mobile_phone; ?></td>              
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- End .powerwidget -->
</div>