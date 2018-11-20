  <div class="col-md-6  bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="link_branch_dept_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Link<small>Department</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">      
        <form id="link_branch_dept_form" action="<?php echo site_url()?>/organization/linkdepartment/add" name="link_branch_dept_form" class="orb-form" novalidate="novalidate" method="POST">
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } 
          ?>
          <header><?php echo $this->data['branch'][0]->dwebname; ?></header>
          <fieldset>
            <section>
              <label class="select">
                <select name="department">
                  <option value="0" selected="" disabled="">Select department</option>
                  <?php foreach ($this->data['departments'][0] as $department) { ?>
                    <option value="<?php echo $department->id; ?>"><?php echo $department->name; ?></option>                    
                  <?php } ?>
                </select>
                <i></i> </label>
            </section>
          </fieldset>            

          <footer>            
            <button type="submit" name="grade_add_new_button" class="btn btn-orb-org">Save</button>
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->
