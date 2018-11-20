<div class="col-md-2 bootstrap-grid sortable-grid ui-sortable">       
  <!-- Domain Setup -->    
  <div class="powerwidget dark-red" id="new_role_div" data-widget-editbutton="false" role="widget" style="">
    <header role="heading" class="ui-sortable-handle">
      <h2>Role in School<small>Create new Role</small></h2>
      <div class="powerwidget-ctrls" role="menu">        
        <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
      </div>
      <span class="powerwidget-loader"></span>
    </header>
    <div class="inner-spacer" role="content">
      <form action="<?php echo site_url()?>/staff_integration/setup_role_new" id="new_role_form" name="new_role_form" class="orb-form" novalidate="novalidate" method="POST">
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
              <select name="domain_id">
                <option value="0" disabled="disabled" selected="selected">Choose Domain</option>                
                <?php foreach ($this->data['domain'] as $data) { ?>
                  <?php if(validation_errors() != false) { ?>
                    <?php if($this->input->post('domain_id') == $data->id) { ?>
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
              <select name="type_id">
                <option value="0"disabled="disabled" selected="selected">Choose Type</option>
                <?php foreach ($this->data['type'] as $data) { ?>
                  <?php if(validation_errors() != false) { ?>
                      <?php if($this->input->post('type_id') == $data->id) { ?>
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
              <select name="wing_id">
                <option value="0"disabled="disabled" selected="selected">Choose Wing</option>
                <?php foreach ($this->data['wing'] as $data) { ?>
                  <?php if(validation_errors() != false) { ?>
                        <?php if($this->input->post('wing_id') == $data->id) { ?>
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
              <select name="grade_id">
                <option value="0"disabled="disabled" selected="selected">Choose Grade</option>
                  <option value="0">All</option>
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
              <select name="section_id">
                <option value="0"disabled="disabled" selected="selected">Choose Section</option>
                  <option value="0">All</option>
                <?php foreach ($this->data['section'] as $data) { ?>
                  <?php if(validation_errors() != false) { ?>
                    <?php if($this->input->post('section_id') == $data->id) { ?>
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


          <!--
          <section>
            <label class="">
              <select name="subject_id" class="selectpicker">
                <option value="0"disabled="disabled" selected="selected">Choose Subject</option>
                <option value="0">No Subject</option>
                <?php //foreach ($this->data['subject'] as $data) { ?>
                  <?php //if($data['parent_id'] == 0){ ?>                    
                    </optgroup><optgroup label="<?php //echo $data['dname']; ?>">
                  <?php //}else{ ?>
                    <option value="<?php //echo $data['id']; ?>"><?php //echo $data['dname']; ?></option>
                  <?php //} ?>               
                <?php //} ?>
              </select>
              <i></i>            
            </label>
          </section>
          -->


          <section>
            <label class="select">
              <select name="subject_id">
                <option value="" disabled="disabled" selected="selected">Choose Subject</option>
                <option value="0">No Subject</option>
                <?php foreach ($this->data['subject'] as $data) { ?>
                  <?php if($data['parent_id'] == 0){ ?>                    
                    <option value="<?php echo $data['id']; ?>" disabled="disabled"><?php echo $data['dname']; ?></option>
                  <?php }else{ ?>
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
              <select name="role_id">
                <option value="0" disabled="disabled" selected="selected">Choose Report To</option>
                <?php foreach ($this->data['role'] as $data) { ?>
                  <?php if(validation_errors() != false) { ?>
                    <?php if($this->input->post('role_id') == $data->id) { ?>
                      <option value="<?php echo $data->id; ?>" selected="selected"><?php echo $data->gr_id; ?></option>
                    <?php } ?>
                      <option value="<?php echo $data->id; ?>"><?php echo $data->gr_id; ?></option>
                  <?php }else{ ?>
                  <option value="<?php echo $data->id; ?>"><?php echo $data->gr_id; ?></option>
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
    <div class="powerwidget <?php echo $title_background_color_view; ?>" id="network_table_filter" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>School Network<small>Edit</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content" style="overflow-x:scroll ; overflow-y: hidden;">
        <div id="role_network_div" class="dataTables_wrapper form-inline" role="grid">

          <table class="display table table-striped table-hover dataTable" id="role_org_edit_table" aria-describedby="staff_info">

            <thead>
              <tr role="row">
              <!-- New Setting -->
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.: activate to sort column descending" style="width: 10px;">S.No.</th>
                <th class=" " role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="GR ID: activate to sort column descending" style="width: 10px;">GR ID</th>
                <th class=" " role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Domain: activate to sort column ascending" style="width: 25px;">Domain</th>
                <th class=" " role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Role Type: activate to sort column ascending" style="width: 25px;">Role Type</th>                
                <th class=" centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Wing: activate to sort column ascending" style="width: 10px;">Wing</th>
                <th class=" centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Grade: activate to sort column ascending" style="width: 10px;">Grade</th>
                <th class=" centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Section: activate to sort column ascending" style="width: 10px;">Section</th>
                <th class=" centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Subject: activate to sort column ascending" style="width: 10px;">Subject</th>
                <th class=" centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Report To: activate to sort column ascending" style="width: 10px;">Report To</th>
                <th class=" centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Secondary Reporting: activate to sort column ascending" style="width: 10px;">Secondary Reporting</th>
                <th class=" centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Academic Session: activate to sort column ascending" style="width: 10px;">Academic Session</th>
                <th class=" centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Staff Assigned: activate to sort column ascending" style="width: 10px;">Staff Assigend</th>
                <th class=" centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Staff Formal Name: activate to sort column ascending" style="width: 10px;">Staff Formal Name</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_sno" placeholder="Filter S.No." class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_order" placeholder="Filter GR ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Domain" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_dname" placeholder="Filter Role Type" class="search_init"></th>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_gnid" placeholder="Filter Wing" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gnid" placeholder="Filter Grade" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gnid" placeholder="Filter Section" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gnid" placeholder="Filter Subject" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gnid" placeholder="Filter Report To" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gnid" placeholder="Filter Secondary Reporting" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gnid" placeholder="Filter Academic Session" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gnid" placeholder="Filter Staff Assigned" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gnid" placeholder="Filter Staff Formal Name" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            $SNo = 1;
            foreach($this->data['all_roles'] as $role) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">
              <td class=" sorting_1 "><?php echo $SNo; ?></td>
              <td class=" "><?php echo substr($role['gr_id'], 0, 4) . substr($role['gr_id'], -2); ?></td>
              <td class=" "><?php echo $role['domain_name']; ?></td>
              <td class=" "><?php echo $role['type_name']; ?></td>              
              <td class=" aneditable_role_wing centered-cell"><a href="#" data-type="select" data-name="wing_id" data-pk="<?php echo $role['id']; ?>" data-placement="top" data-title="Wing"><?php echo $role['wing_name']; ?></a></td>
              <td class=" aneditable_role_grade centered-cell"><a href="#" data-type="select" data-name="grade_id" data-pk="<?php echo $role['id']; ?>" data-placement="top" data-title="Grade"><?php echo $role['grade_name']; ?></a></td>              
              <td class="aneditable_role_section centered-cell"><a href="#" data-type="select" data-name="section_id" data-pk="<?php echo $role['id']; ?>" data-placement="top" data-title="Section"><?php echo $role['section_name']; ?></a></td>
              <?php if($role['subject_id'] != '999') { ?>
                <td class="aneditable_role_subject centered-cell"><a href="#" data-type="select" data-name="subject_id" data-pk="<?php echo $role['id']; ?>" data-placement="top" data-title="Subject"><?php echo $role['subject_name']; ?></a></td>
              <?php } else { ?> 
                <td class="aneditable_role_subject centered-cell"><a href="#" data-type="select" data-name="subject_id" data-pk="<?php echo $role['id']; ?>" data-placement="top" data-title="Subject">No Subject</a></td>
              <?php } ?>
              <td class="aneditable_role_reportto centered-cell"><a href="#" data-type="select" data-name="report_to" data-pk="<?php echo $role['id']; ?>" data-placement="top" data-title="Report To"><?php echo $role['report_grid']; ?></a></td>
              <td class=" centered-cell"><a class="btn btn-primary secondary_reporting_modal" data-toggle="modal" data-id="<?php echo $role['id'];?>" href="#"><i class="fa fa-plus-circle"></i></a></td>
              <td class="aneditable_role_sessionid centered-cell"><a href="#" data-type="select" data-name="academic_session_id" data-pk="<?php echo $role['id']; ?>" data-placement="top" data-title="Academic Session"><?php echo $role['session_name']; ?></a></td>
              <td class="aneditable_role_staffid centered-cell"><a href="#" data-type="select2" data-name="staff_id" data-pk="<?php echo $role['id']; ?>" data-placement="left" data-title="Assign Staff"><?php echo $role['staff_name_code']; ?></a></td>
              <td class=" "><?php echo $role['staff_formal_name']; ?></td>
            </tr>
          <?php $SNo++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->







<!-- Organization Chart -->
<div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">       
  <!-- Domain Setup -->    
  <div class="powerwidget dark-red" id="org_chart_diagram_div" data-widget-editbutton="false" role="widget" style="">
    <header role="heading" class="ui-sortable-handle">
      <h2>Generation's School<small>Role Chart</small></h2>
      <div class="powerwidget-ctrls" role="menu">        
        <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
      </div>
      <span class="powerwidget-loader"></span>
    </header>
    <div class="inner-spacer" role="content">
      <div id="orgchart_diagram" style="width: 100%; height: 2000px; border-style: dotted; border-width: 1px;" />
    </div>
  </div>
</div>