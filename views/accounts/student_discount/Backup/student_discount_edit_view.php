<div class="col-md-6 bootstrap-grid sortable-grid">

  <div class="powerwidget cold-grey" id="sutdent_discount_form_div" data-widget-editbutton="false" role="widget" style="">
    <header role="heading">
      <h2>Discount<small>Edit discount</small></h2>
      <div class="powerwidget-ctrls" role="menu">
        <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
        <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
      </div>
    </header>
    <div class="inner-spacer" role="content">      
      <address>
        <strong><?php echo $this->data['student_discount_info'][0]['abridged_name'] . '</strong> (GS-ID: <strong>' . $this->input->post('gs_id') . ')'; ?></strong><br>
        <?php echo $this->data['student_discount_info'][0]['grade_name'] . '-' . $this->data['student_discount_info'][0]['section_name']; ?><br>
        <?php echo $this->data['student_discount_info'][0]['concession_code'] . ', ' . $this->data['student_discount_info'][0]['concession_name']. ', <strong>' . 
        $this->data['student_discount_info'][0]['percentage'] . '%</strong>'; ?><br>
      </address>
      

      <table class="table table-striped table-hover margin-0px">
        <thead>
          <tr>
            <th>Month</th>
            <th>Discount</th>            
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Aug</td>
            <td>
              <a href="#" id="student_discount_aug" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Aug" class="editable editable-click editable-empty" data-original-title="" title="Student Discount for Aug"><?php echo $this->data['student_discount_info'][0]['aug']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Sep</td>
            <td>
              <a href="#" id="student_discount_sep" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Sep" class="editable editable-click editable-empty" data-original-title="" title="Student Discount for Sep"><?php echo $this->data['student_discount_info'][0]['sep']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Oct</td>
            <td>
              <a href="#" id="student_discount_oct" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Oct" class="editable editable-click editable-empty" data-original-title="" title="Student Discount for Oct"><?php echo $this->data['student_discount_info'][0]['oct']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Nov</td>
            <td>
              <a href="#" id="student_discount_nov" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Nov" class="editable editable-click editable-empty" data-original-title="" title="Student Discount for Nov"><?php echo $this->data['student_discount_info'][0]['nov']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Dec</td>
            <td>
              <a href="#" id="student_discount_dec" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Dec" class="editable editable-click editable-empty" data-original-title="" title="Student Discount for Dec"><?php echo $this->data['student_discount_info'][0]['dec']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Jan</td>
            <td>
              <a href="#" id="student_discount_jan" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Jan" class="editable editable-click editable-empty" data-original-title="" title="Student Discount for Jan"><?php echo $this->data['student_discount_info'][0]['jan']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Feb</td>
            <td>
              <a href="#" id="student_discount_feb" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Feb" class="editable editable-click editable-empty" data-original-title="" title="Student Discount for Feb"><?php echo $this->data['student_discount_info'][0]['feb']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Mar</td>
            <td>
              <a href="#" id="student_discount_mar" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Mar" class="editable editable-click editable-empty" data-original-title="" title="Student Discount for Mar"><?php echo $this->data['student_discount_info'][0]['mar']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Apr</td>
            <td>
              <a href="#" id="student_discount_apr" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Apr" class="editable editable-click editable-empty" data-original-title="" title="Student Discount for Apr"><?php echo $this->data['student_discount_info'][0]['apr']; ?></a>
            </td>
          </tr>
          <tr>
            <td>May</td>
            <td>
              <a href="#" id="student_discount_may" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for May" class="editable editable-click editable-empty" data-original-title="" title="Student Discount for May"><?php echo $this->data['student_discount_info'][0]['may']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Jun</td>
            <td>
              <a href="#" id="student_discount_jun" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Jun" class="editable editable-click editable-empty" data-original-title="" title="Student Discount for Jun"><?php echo $this->data['student_discount_info'][0]['jun']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Jul</td>
            <td>
              <a href="#" id="student_discount_jul" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Jul" class="editable editable-click editable-empty" data-original-title="" title="Student Discount for Jul"><?php echo $this->data['student_discount_info'][0]['jul']; ?></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>