  <div class="col-md-6  bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="wing_grades_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Grades<small>in Wing (<?php echo $this->data['branch'][0]->dwebname; ?>)</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
        <form action="<?php echo site_url()?>/organization/linkgrade/add" id="wing_grades_form" name="wing_grades_form" class="orb-form" novalidate="novalidate" method="POST">
          <header>Add a new grade to wing</header>
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } 
          ?>                     
          <fieldset>            
            <section>
              <label class="select">
                <select name="wing">
                  <option value="0" selected="" disabled="">Select Wing</option>
                  <?php foreach ($this->data['wings'] as $wing) { ?>
                    <option value="<?php echo $wing->id; ?>"><?php echo $wing->name; ?></option>                    
                  <?php } ?>
                </select>
                <i></i> </label>
            </section>

            <section>
              <label class="select">
                <select name="grade">
                  <option value="0" selected="" disabled="">Select Grade</option>
                  <?php foreach ($this->data['grades'] as $grade) { ?>
                    <option value="<?php echo $grade->id; ?>"><?php echo $grade->name; ?></option>
                  <?php } ?>
                </select>
                <i></i> </label>
            </section>
          </fieldset>

          <footer>            
            <button type="submit" name="wing_grade_add_button" class="btn btn-orb-org">Save</button>
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->