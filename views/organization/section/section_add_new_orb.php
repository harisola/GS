  <div class="col-md-6  bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="add_new_section_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>section<small>Add new section</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">      
        <form id="section_add_new_form" action="<?php echo site_url()?>/organization/section/add" name="section_add_new_form" class="orb-form" novalidate="novalidate" method="POST">
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } 
          ?>
          <fieldset>
            <section>
              <label class="input"> <i class="icon-append fa fa-building"></i>
                <input type="text" name="section_name" id="section_name" placeholder="section Name" required="required">
                <b class="tooltip tooltip-bottom-right">section Name</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-credit-card"></i>
                <input type="text" name="section_display_name" id="section_display_name" placeholder="section Display Name">
                <b class="tooltip tooltip-bottom-right">section Display Name</b> </label>
            </section>
            <section>
              <label class="select">
                <select name="gender">
                  <option value="Mix">Mix</option>
                  <option value="Boy">Boy</option>
                  <option value="Girl">Girl</option>                  
                </select>
                <i></i> </label>
            </section>
          </fieldset>            

          <footer>            
            <button type="submit" name="section_add_new_button" class="btn btn-orb-org">Save</button>
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->
