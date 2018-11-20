  <div class="col-md-6  bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="applicant_form_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Register<small>Applicant</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
        <form action="<?php echo site_url()?>/hcm/applicant_form" id="hcm_new_applicant_form" name="hcm_new_applicant_form" class="orb-form" novalidate="novalidate" method="POST">
          <header>Applicant form</header>
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } 
          ?>                     
          <fieldset>
            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="applicant_name" id="applicant_name" placeholder="Applicant Name" required="required">
                <b class="tooltip tooltip-bottom-right">Enter the applicant name</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-credit-card"></i>
                <input type="text" name="cnic" id="cnic" placeholder="xxxxx-xxxxxxx-x">
                <b class="tooltip tooltip-bottom-right">Enter the applicant CNIC</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-mobile-phone"></i>
                <input type="tel" name="mobilephonereq" id="mobilephone" placeholder="(xxx) xxx-xx-xx">
                <b class="tooltip tooltip-bottom-right">Enter the applicant mobile phone like 0313-9999999</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-phone"></i>
                <input type="tel" name="landline" id="landline" placeholder="xxx-xxxxxxx">
                <b class="tooltip tooltip-bottom-right">Enter the applicant land line phone like 213-9999999</b> </label>
            </section>
          </fieldset>
          <fieldset>          
            <section>
              <label class="select">
                <select name="gender">
                  <option value="0" selected="" disabled="">Gender</option>
                  <option value="M">Male</option>
                  <option value="F">Female</option>                
                </select>
                <i></i> </label>
            </section>          
          </fieldset>
          
          <fieldset>              
            <section>            
              <label class="select">Position applied for :
                <select  multiple id="select_position_tags" name="hcm_all_position_tags[]" style="width:100%" class="required form-control">
                  <option value="Management">Management</option>
                  <option value="Teaching">Teaching</option>
                  <option value="Admin">Admin</option>                                  
                  <option value="Technical">Technical</option>
                </select>
              </label>              
            </section>            
          </fieldset>


          <footer>            
            <button type="submit" name="hcm_applicant_form_button" class="btn btn-orb-org">Submit</button>
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->