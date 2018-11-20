  <div class="col-md-6  bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="new_staff_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>New<small>Staff</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
        <form action="<?php echo site_url()?>/hcm/staff_new" id="hcm_new_staff_form" name="hcm_new_staff_form" class="orb-form" novalidate="novalidate" method="POST">
          <header>Staff Form</header>
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
                <input type="text" name="employee_id" id="employee_id" placeholder="Employee ID" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('employee_id'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the employee id</b> </label>
            </section>
            </fieldset>

            <fieldset>
            <section>
              <label class="select">
                <select name="title_person_id" id="staff_title">
                  <option value="0" selected="" disabled="">Staff Title</option>
                  <?php
                    foreach($this->staff_data['staff_title'][0] as $staff_title) {
                  ?>
                  <option value="<?php echo (int)$staff_title->id; ?>"><?php echo $staff_title->title; ?></option>
                  <?php } ?>
                </select>
                <i></i> </label>
            </section>
            <section>
              <label class="select">
                <select name="gender">
                  <option value="0" selected="" disabled="">Gender</option>
                  <option value="M">Male</option>
                  <option value="F">Female</option>
                </select>
                <i></i> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="staff_name" id="staff_name" placeholder="NIC Name" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('staff_name'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the staff name</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="abridged_name" id="abridged_name" placeholder="Full Name" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('abridged_name'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the abridged name</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="name_code" id="name_code" placeholder="Name Code" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('name_code'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the name code</b> </label>
            </section>
            
            <section>
              <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" name="DOB" id="start" placeholder="Date of Birth" value="<?php if(validation_errors() != false) { echo $this->input->post('DOB'); } ?>">
              </label>
            </section>
            </fieldset>

            <fieldset>
            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="father_name" id="father_name" placeholder="Father Name" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('father_name'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the father name</b> </label>
            </section>
            </fieldset>

            <fieldset>
            <section>
              <label class="input"> <i class="icon-append fa fa-credit-card"></i>
                <input type="text" name="nic" id="nic" placeholder="xxxxx-xxxxxxx-x" value="<?php if(validation_errors() != false) { echo $this->input->post('nic'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the staff CNIC</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-mobile-phone"></i>
                <input type="tel" name="mobilephonereq" id="mobilephone" placeholder="(xxx) xxx-xx-xx" value="<?php if(validation_errors() != false) { echo $this->input->post('mobilephonereq'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the applicant mobile phone like 0313-9999999</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-phone"></i>
                <input type="tel" name="landline" id="landline" placeholder="xxx-xxxxxxx" value="<?php if(validation_errors() != false) { echo $this->input->post('landline'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the applicant land line phone like 21-39999999</b> </label>
            </section>
            </fieldset>

            <fieldset>
            <section>
              <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" name="DOJ" id="finish" placeholder="Date of Joining" value="<?php if(validation_errors() != false) { echo $this->input->post('DOJ'); } ?>">
              </label>
            </section>

            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="designation" id="designation" placeholder="Designation" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('designation'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the designation</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="department" id="department" 
                placeholder="Department" required="required" 
                value="<?php if(validation_errors() != false) 
                { echo $this->input->post('department'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the department</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="section" id="section" 
                placeholder="section" required="required" 
                value="<?php if(validation_errors() != false) 
                { echo $this->input->post('section'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the section</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="sub_section" id="sub_section" 
                placeholder="Sub Section"
                value="<?php if(validation_errors() != false) 
                { echo $this->input->post('sub_section'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the sub section</b> </label>
            </section>
            <section>
              <label class="select">
                <select name="category">
                  <option value="0" selected="" disabled="">Category</option>
                  <option value="Contractual">Contractual</option>
                  <option value="Permenant">Permenant</option>                  
                  <option value="Probation">Probation</option>
                </select>
                <i></i> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="eobi_no" id="eobi_no" 
                placeholder="EOBI No"
                value="<?php if(validation_errors() != false) 
                { echo $this->input->post('eobi_no'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the EOBI No</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="sessi_no" id="sessi_no" 
                placeholder="SESSI No"
                value="<?php if(validation_errors() != false) 
                { echo $this->input->post('sessi_no'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the SESSI No</b> </label>
            </section>
            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="gg_id" id="gg_id" 
                placeholder="Generations Google Id"
                value="<?php if(validation_errors() != false) 
                { echo $this->input->post('gg_id'); } ?>">
                <b class="tooltip tooltip-bottom-right">Enter the Generations Google Id</b> </label>
            </section>
            </fieldset>



            <fieldset>
            <section>
              <label class="select">
                <select name="gs_staff_type">                  
                  <option value="Direct" selected="selected">Direct Staff</option>
                  <option value="Non-Direct">Non Direct Staff</option>
                </select>
                <i></i> </label>
            </section>
            <section>              
              <label class="select">
                <select name="card_top_line">
                  <option value="0" selected="" disabled="">Card Top Line</option>
                  <?php
                    foreach($this->card['top_line'][0] as $card) {
                      if(strlen($card['c_topline']) >= 3) {
                  ?>
                  <option value="<?php echo $card['c_topline']; ?>"><?php echo $card['c_topline']; ?></option>
                  <?php } } ?>
                </select>
                <i></i> </label>
            </section>
            <section>              
              <label class="select">
                <select name="card_bottom_line">
                  <option value="0" selected="" disabled="">Card Bottom Line</option>
                  <?php
                    foreach($this->card['bottom_line'][0] as $card) {
                      if(strlen($card['c_bottomline']) >= 3) {
                  ?>
                  <option value="<?php echo $card['c_bottomline']; ?>"><?php echo $card['c_bottomline']; ?></option>
                  <?php } } ?>
                </select>
                <i></i> </label>
            </section>
            </fieldset>


          <footer>
            <button type="submit" name="hcm_new_staff_add_button" class="btn btn-orb-org">Proceed</button>
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->