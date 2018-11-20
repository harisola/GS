  <div class="col-md-6  bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="add_new_department_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Department<small>Add new department</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">      
        <form id="department_add_new_form" action="<?php echo site_url()?>/organization/department/add" name="department_add_new_form" class="orb-form" novalidate="novalidate" method="POST">
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } 
          ?>
          <fieldset>
            <section>
              <label class="input"> <i class="icon-append fa fa-building"></i>
                <input type="text" name="department_name" id="department_name" placeholder="Department Name" required="required">
                <b class="tooltip tooltip-bottom-right">Department Name</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-credit-card"></i>
                <input type="text" name="department_display_name" id="department_display_name" placeholder="Department Display Name">
                <b class="tooltip tooltip-bottom-right">Department Display Name</b> </label>
            </section>
          </fieldset>            

          <footer>            
            <button type="submit" name="department_add_new_button" class="btn btn-orb-org">Save</button>
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->
