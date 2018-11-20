  <div class="col-md-3  bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="status_student_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Status<small>Student</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
        <form action="<?php echo site_url()?>/fo/student_ai" id="status_student_form" name="status_student_form" class="orb-form" novalidate="novalidate" method="POST">
          <header>Student Active / Inactive Form</header>
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
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="gs_id" id="gs_id" placeholder="GS-ID" autofocus="autofocus" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('gs_id'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the student GS-ID</b> </label>
            </section>                        
            
              <section>
                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                  <input type="text" name="wef_date" id="wef_date" placeholder="With Effect From" value="<?php if(validation_errors() != false) { echo $this->input->post('wef_date'); } ?>">
                </label>
              </section>

              <section>
                <label class="input"> <i class="icon-append fa fa-user"></i>
                  <input type="text" name="description" id="description" placeholder="Reason" autofocus="autofocus" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('description'); } ?>">
                  <b class="tooltip tooltip-bottom-right">Enter the student status change reason</b> </label>
              </section>         

            <section>
              <label class="select">
                <select name="new_status">
                  <option value="0" selected="" disabled="">New Status</option>
                  <option value="1">Active</option>
                  <option value="3">Inactive</option>
                </select>
                <i></i> </label>
            </section>
          </fieldset>            
            
          <footer>
            <button type="submit" name="fo_new_admission_form_button" class="btn btn-orb-org">Proceed</button>
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->