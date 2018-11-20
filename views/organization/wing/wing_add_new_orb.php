  <div class="col-md-6  bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="add_new_wing_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>wing<small>Add new wing</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">      
        <form id="wing_add_new_form" action="<?php echo site_url()?>/organization/wing/add" name="wing_add_new_form" class="orb-form" novalidate="novalidate" method="POST">
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } 
          ?>
          <fieldset>
            <section>
              <label class="input"> <i class="icon-append fa fa-building"></i>
                <input type="text" name="wing_name" id="wing_name" placeholder="wing Name" required="required">
                <b class="tooltip tooltip-bottom-right">wing Name</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-credit-card"></i>
                <input type="text" name="wing_display_name" id="wing_display_name" placeholder="wing Display Name">
                <b class="tooltip tooltip-bottom-right">wing Display Name</b> </label>
            </section>
          </fieldset>            

          <footer>            
            <button type="submit" name="wing_add_new_button" class="btn btn-orb-org">Save</button>
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->
