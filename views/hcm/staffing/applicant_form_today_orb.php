<div class="col-md-6 bootstrap-grid sortable-grid ui-sortable"> 
  <!-- New widget -->
  
  <div class="powerwidget cold-grey powerwidget-sortable" id="table2" data-widget-editbutton="false" role="widget" style="position: relative; opacity: 1;">
    <header role="heading">
      <h2>Applicant<small>Today</small></h2>
      <div class="powerwidget-ctrls" role="menu">
        <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
        <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
      </div><span class="powerwidget-loader"></span>
    </header>
    <div class="inner-spacer" role="content">
      <table class="table table-condensed table-bordered margin-0px">
        <thead>
          <tr>
            <th>Form #</th>
            <th>Applicant Name</th>
            <th>Position</th>
            <th>Print</th>
          </tr>
        </thead>
        <tbody>
           <?php
            $class_active = '';
            foreach($this->applicant_today_data['applicant_data'][0] as $applicant_record) {
              if($class_active == ''){
                $class_active = 'active';
              }else{
                $class_active = '';
              }
          ?>
          <form action="<?php echo site_url()?>/hcm/applicant_form/printForm" method="post" accept-charset="utf-8">
            <input type="hidden" name="id" value="<?php echo $applicant_record->id; ?>">
            <input type="hidden" name="full_name" value="<?php echo $applicant_record->full_name; ?>">
            <input type="hidden" name="gender" value="<?php echo $applicant_record->gender; ?>">
            <input type="hidden" name="nic" value="<?php echo $applicant_record->nic; ?>">
            <input type="hidden" name="mobile_phone" value="<?php echo $applicant_record->mobile_phone; ?>">
            <input type="hidden" name="land_line" value="<?php echo $applicant_record->land_line; ?>">
            <input type="hidden" name="position" value="<?php echo $applicant_record->position; ?>">

            <tr class="<?php echo $class_active; ?>">
              <td><?php echo $applicant_record->gc_id; ?></td>
              <td><?php echo $applicant_record->full_name; ?></td>
              <td>
                <?php $position_tags = explode(",", $applicant_record->position);
                  foreach($position_tags as $position_tag) { ?>
                  <span class="label bg-cold-grey"><?php echo $position_tag; ?></span>
                <?php } ?>
              </td>
              <td><button type="submit" name="print" value="Print">Print</button></td>
            </tr>
          </form>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- End .powerwidget -->
</div>