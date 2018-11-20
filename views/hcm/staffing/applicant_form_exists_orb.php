  <meta http-equiv="refresh" content="10">

  <div class="col-md-6  bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="exists_applicant_form_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Register<small>Applicant</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
        <form action="<?php echo site_url()?>/hcm/applicant_form/add2" id="hcm_exists_applicant_form" name="hcm_exists_applicant_form" class="orb-form" novalidate="novalidate" method="POST">
          <header>Applicant form</header>
          <?php
            if(validation_errors() != false) {              
              if (form_error('cnic')) {
                echo '<div class="callout callout-danger">' . "NIC " . $this->exists_applicant['nic'] . " already exists!";
              }
            } 
          ?>          
          <!-- checking all the previous entries and showing the applied dates -->
          <?php
            $first_record = true;
            foreach($this->exists_applicant['last_record'][0] as $applicant_record) {
              echo "</br>" . "applied date : " . unix_to_human($applicant_record->created);              
              if($first_record){
                $id = $applicant_record->id;
                $full_name = $applicant_record->full_name;
                $gender = $applicant_record->gender;
                $nic = $applicant_record->nic;
                $mobile_phone = $applicant_record->mobile_phone;
                $land_line = $applicant_record->land_line;
                $position = $applicant_record->position;
                $first_record = false;
              }
          ?>
          
          <?php } ?></div> <!-- last attended applicant form data -->
          <input type="hidden" name="lastrecord_id" value="<?php echo $id; ?>">
          <input type="hidden" name="lastrecord_full_name" value="<?php echo $this->exists_applicant['full_name']; ?>">
          <input type="hidden" name="lastrecord_gender" value="<?php echo $gender; ?>">
          <input type="hidden" name="lastrecord_nic" value="<?php echo $nic; ?>">
          <input type="hidden" name="lastrecord_mobile_phone" value="<?php echo $this->exists_applicant['mobile_phone']; ?>">
          <input type="hidden" name="lastrecord_land_line" value="<?php if ($this->exists_applicant['land_line'] == "") echo $land_line; ?>">
          <input type="hidden" name="lastrecord_position" value="<?php echo $this->exists_applicant['position']; ?>">

          <input type="hidden" name="newrecord_full_name" value="<?php echo $this->exists_applicant['full_name']; ?>">
          <input type="hidden" name="newrecord_gender" value="<?php echo $this->exists_applicant['gender']; ?>">
          <input type="hidden" name="newrecord_nic" value="<?php echo $this->exists_applicant['nic']; ?>">
          <input type="hidden" name="newrecord_mobile_phone" value="<?php echo $this->exists_applicant['mobile_phone']; ?>">
          <input type="hidden" name="newrecord_land_line" value="<?php echo $this->exists_applicant['land_line']; ?>">
          <input type="hidden" name="newrecord_position" value="<?php echo $this->exists_applicant['position']; ?>">
          
          <fieldset>          
            <section>
              <label class="select">
                <select name="exists_applicant_form_action">
                  <option value="0" selected="" disabled="">Print the previous form >> OR << generate new form?</option>                  
                  <option value="Last">Print the last applied form</option>
                  <option value="New">Print NEW form</option>                                  
                </select>
                <i></i> </label>
            </section>          
          </fieldset>
          <footer>            
            <button type="submit" name="hcm_exists_applicant_form_button" class="btn btn-orb-org">Submit</button>
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->