  <div class="col-md-6  bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="branch_users_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Users<small>in branch</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
        <form action="<?php echo site_url()?>/organization/branch_users/add" id="branch_users_form" name="branch_users_form" class="orb-form" novalidate="novalidate" method="POST">
          <header>Add a new user to branch</header>
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } 
          ?>                     
          <fieldset>            
            <section>
              <label class="select">
                <select name="branch">
                  <option value="0" selected="" disabled="">Select Branch</option>
                  <?php foreach ($this->branch_data['branch'] as $branch) { ?>
                    <option value="<?php echo $branch->id; ?>"><?php echo $branch->name; ?></option>                    
                  <?php } ?>
                </select>
                <i></i> </label>
            </section>

            <section>
              <label class="select">
                <select name="users">
                  <option value="0" selected="" disabled="">Select User</option>
                  <?php foreach ($this->branch_data['users'] as $users) { ?>
                    <option value="<?php echo $users->id; ?>"><?php echo $users->first_name . " " . $users->last_name; ?></option>
                  <?php } ?>
                </select>
                <i></i> </label>
            </section>
          </fieldset>

          <footer>            
            <button type="submit" name="branch_users_add_button" class="btn btn-orb-org">Save</button>
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->