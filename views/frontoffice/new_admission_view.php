  <div class="col-md-4  bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="new_student_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>New<small>Student</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
        <form action="<?php echo site_url()?>/fo/new_admission" id="new_student_form" name="new_student_form" target = "_blank" class="orb-form" novalidate="novalidate" method="POST">
          <header>Student Registration Form</header>
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
                <input type="text" name="form_no" id="form_no" placeholder="Form #" autofocus="autofocus" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('form_no'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the form number</b> </label>
            </section>
            <section>
              <label class="select">
                <select name="gender">
                  <option value="0" selected="" disabled="">Gender</option>
                  <option value="B">Boy</option>
                  <option value="G">Girl</option>
                </select>
                <i></i> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="official_name" id="official_name" placeholder="Official Name" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('official_name'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the Full name</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="abridged_name" id="abridged_name" placeholder="Abridged Name" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('abridged_name'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the abridged name</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="call_name" id="call_name" placeholder="Call Name" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('call_name'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the Call name</b> </label>
            </section>
            
            <section>
              <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" name="student_dob" id="datepicker_dob" placeholder="Date of Birth" value="<?php if(validation_errors() != false) { echo $this->input->post('student_dob'); } ?>">
              </label>
            </section>
            </fieldset>

            <fieldset>
              <section>
                <label class="input"> <i class="icon-append fa fa-user"></i>
                  <input type="text" name="father_name" id="father_name" placeholder="Father Name" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('father_name'); } ?>">
                  <b class="tooltip tooltip-bottom-right">Enter the Father name</b> </label>
              </section>
              <section>
                <label class="input"> <i class="icon-append fa fa-credit-card"></i>
                  <input type="text" name="nic" id="nic" placeholder="xxxxx-xxxxxxx-x" value="<?php if(validation_errors() != false) { echo $this->input->post('nic'); } ?>">
                  <b class="tooltip tooltip-bottom-right">Enter the Father NIC</b> </label>
              </section>
            </fieldset>

            <fieldset>
              <section>
                <label class="select">
                  <select name="gradeofadmission">
                    <option value="0" selected="" disabled="">Grade of Admission</option>
                    <option value="17">PG</option>
                    <option value="1">PN</option>
                    <option value="2">N</option>
                    <option value="3">KG</option>
                    <option value="4">I</option>
                    <option value="5">II</option>
                    <option value="6">III</option>
                    <option value="7">IV</option>
                    <option value="8">V</option>
                    <option value="9">VI</option>
                    <option value="10">VII</option>
                    <option value="11">VIII</option>
                    <option value="12">IX</option>
                    <option value="13">X</option>
                    <option value="15">A1</option>
                  </select>
                  <i></i> </label>
              </section>
              <section>
                <label class="select">
                  <select name="sessionofadmission">
                    <option value="0" selected="" disabled="">Session of Admission</option>                    
                    <option value="2016">2016 - 2017</option>
                    <option value="2017">2017 - 2018</option>
                  </select>
                  <i></i> </label>
              </section>
              <section>
                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                  <input type="text" name="studentdoj" id="student_doj" placeholder="Date of Joining" value="<?php if(validation_errors() != false) { echo $this->input->post('student_doj'); } ?>">
                </label>
              </section>
            </fieldset>


            <fieldset>            
              <section>
                <label class="select">
                  <select name="undertaking">
                    <option value="0" selected="" disabled="">Undertaking</option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                  <i></i> </label>
                </section>

                <section>
                  <label class="select">
                  <select name="red_file">
                    <option value="0" selected="" disabled="">Red File Created?</option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                  <i></i> </label>
                </section>

                <section>
                  <label class="select">
                  <select name="register_entry">
                    <option value="0" selected="" disabled="">GS Register Entry?</option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                  <i></i> </label>
              </section>
            </fieldset>

            <fieldset>
              <section>
                <label class="input"> <i class="icon-append fa fa-dollar"></i>
                  <input type="text" name="admission_fee" id="admission_fee" placeholder="Admission Fee" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('admission_fee'); } ?>">
                  <b class="tooltip tooltip-bottom-right">Enter the Admission Fee</b> </label>
              </section>
              <section>
                <label class="input"> <i class="icon-append fa fa-dollar"></i>
                  <input type="text" name="security_deposit" id="security_deposit" placeholder="Security Deposit" value="<?php if(validation_errors() != false) { echo $this->input->post('security_deposit'); } ?>">
                  <b class="tooltip tooltip-bottom-right">Enter the Security Deposit</b> </label>
              </section>
              <section>
                <label class="input"> <i class="icon-append fa fa-dollar"></i>
                  <input type="text" name="computer_subscription" id="computer_subscription" placeholder="Computer Subscription" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('computer_subscription'); } ?>">
                  <b class="tooltip tooltip-bottom-right">Enter the Computer Subscription</b> </label>
              </section>
            </fieldset>
            
          <footer>
            <button type="submit" name="fo_new_admission_form_button"  class="btn btn-orb-org">Submit</button>
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->