<div class="col-md-2 bootstrap-grid sortable-grid ui-sortable">       
  <!-- Domain Setup -->    
  <div class="powerwidget dark-red" id="new_program_div" data-widget-editbutton="false" role="widget" style="">
    <header role="heading" class="ui-sortable-handle">
      <h2>Program in School<small>Create New</small></h2>
      <div class="powerwidget-ctrls" role="menu">        
        <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
      </div>
      <span class="powerwidget-loader"></span>
    </header>
    <div class="inner-spacer" role="content">
      <form action="<?php echo site_url()?>/sis/academic_program" id="new_program_form" name="new_program_form" class="orb-form" novalidate="novalidate" method="POST">
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
            <label class="select">
              <select name="grade_id">
                <option value="0"disabled="disabled" selected="selected">Choose Grade</option>
                <?php foreach ($this->data['grade'] as $data) { ?>
                  <?php if(validation_errors() != false) { ?>
                    <?php if($this->input->post('grade_id') == $data->id) { ?>
                      <option value="<?php echo $data->id; ?>" selected="selected"><?php echo $data->dname; ?></option>
                    <?php } ?>
                      <option value="<?php echo $data->id; ?>"><?php echo $data->dname; ?></option>
                  <?php }else{ ?>
                  <option value="<?php echo $data->id; ?>"><?php echo $data->dname; ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
              <i></i>            
            </label>
          </section>


          <section>
            <label class="select">
              <select name="subject_id">
                <option value="0"disabled="disabled" selected="selected">Choose Subject</option>
                <?php foreach ($this->data['subject'] as $data) { ?>
                  <?php if ($data['parent_id'] != 0) { ?>
                    <?php if(validation_errors() != false) { ?>
                      <?php if($this->input->post('subject_id') == $data['id']) { ?>
                        <option value="<?php echo $data['id']; ?>" selected="selected"><?php echo $data['dname']; ?></option>
                      <?php } ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['dname']; ?></option>
                    <?php }else{ ?>
                    <option value="<?php echo $data['id']; ?>"><?php echo $data['dname']; ?></option>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
              </select>
              <i></i>            
            </label>
          </section>


          <section>
            <label class="select">
              <select name="academic_session_id">
                <option value="0" disabled="disabled" selected="selected">Choose Academic Session</option>
                <?php foreach ($this->data['academic_session'] as $data) { ?>
                  <?php if(validation_errors() != false) { ?>
                    <?php if($this->input->post('academic_session_id') == $data->id) { ?>
                      <option value="<?php echo $data->id; ?>" selected="selected"><?php echo $data->name; ?></option>
                    <?php } ?>
                      <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
                  <?php }else{ ?>
                  <option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
              <i></i>            
            </label>
          </section>

        </fieldset>

      
        <footer>            
          <button type="submit" name="new_role_button" class="btn btn-orb-org">Create New</button>
          <button type="button" style="margin-left:65px;" name="new_role_reset_button" class="btn btn-default">Reset</button>
        </footer>

      </form>
    </div>
  </div>
</div>














<!-- Datatables View users -->
  <div class="col-md-10 bootstrap-grid sortable-grid ui-sortable">

  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $title_background_color_view; ?>" id="program_table_filter" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Academic Program<small>Edit</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="role_program_div" class="dataTables_wrapper form-inline" role="grid">

          <table class="display table table-striped table-hover dataTable" id="role_program_edit_table" aria-describedby="staff_info">

            <thead>
              <tr role="row">
              <!-- New Setting -->
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.: activate to sort column descending" style="width: 10px;">S.No.</th>
                <th class=" centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Grade Name: activate to sort column descending" style="width: 10px;">Grade Name</th>
                <th class=" centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Subject: activate to sort column ascending" style="width: 25px;">Subject</th>
                <th class=" centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Academic Session: activate to sort column ascending" style="width: 25px;">Academic Session</th>                
                <th class=" centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Order: activate to sort column ascending" style="width: 10px;">Order</th>                
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_sno" placeholder="Filter S.No." class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_order" placeholder="Filter Grade Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Subject" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_dname" placeholder="Filter Academic Session" class="search_init"></th>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_gnid" placeholder="Filter Order" class="search_init"></th>                
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            $SNo = 1;
            foreach($this->data['program'] as $role) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">
              <td class=" sorting_1 "><?php echo $SNo; ?></td>              
              <td class=" centered-cell"><?php echo $role['grade_name']; ?></td>
              <td class=" aneditable_program_subject centered-cell"><a href="#" data-type="select" data-name="subject_id" data-pk="<?php echo $role['id']; ?>" data-placement="top" data-title="Subject"><?php echo $role['subject_name']; ?></a></td>
              <td class=" centered-cell"><?php echo $role['academic_session_name']; ?></td>              
              <td class="aneditable_program_order centered-cell"><a href="#" data-type="select" data-name="order" data-pk="<?php echo $role['id']; ?>" data-placement="left" data-title="Order"><?php echo $role['order']; ?></a></td>              
            </tr>
          <?php $SNo++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->