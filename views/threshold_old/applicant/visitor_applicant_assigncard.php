  <div class="col-md-5 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="visitor_parent_assignedcard_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Applicant<small>Visit</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <!-- <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a> -->
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
        <form action="<?php echo site_url()?>/threshold/visitor_applicant_ajax" id="review-form" name="review-form" class="orb-form" novalidate="novalidate" method="POST">
          <header>Applicant Visiting Form</header>          
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } 
          ?>                     
          <fieldset>
		  <div class="row">
            <section class="col col-md-6">       
           
              <label class="input"> <i class="icon-prepend fa fa-credit-card"></i>
                <input type="text" name="cnic" id="cnic" placeholder="Applicant NIC" value="<?php echo $this->applicant_nic; ?>" autofocus>
                <b class="tooltip tooltip-bottom-right">Please mention visitor NIC</b> </label>
            </section>
			</div>
          </fieldset>



          <fieldset>
		  <div class="row">
            <section class="col col-md-6">
              <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" name="name" id="name" placeholder="Applicant Name" value="<?php echo $this->applicant_name; ?>" autofocus>
                <b class="tooltip tooltip-bottom-right">Please mention applicant name</b> </label>
            </section>

            <section class="col col-md-6">
              <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                <input type="text" name="mobile_phone" id="mobile_phone" placeholder="Applicant Mobile Phone" value="<?php echo $this->applicant_mobile_phone; ?>" autofocus>
                <b class="tooltip tooltip-bottom-right">Please mention visitor Mobile Phone</b> </label>
            </section>
			</div>
          </fieldset>

             <fieldset>
           <div class="row">
            <section class="col col-md-6">
            <label class="select">
              <select name="applicant_visit_purpose" id="applicant_visit_purpose">
                <option value="0" selected="" disabled="">Visiting Purpose</option>
                <option value="Apply">Apply</option>
                <option value="Interview">Interview</option>
                <option value="Observation">Observation</option>                
              </select>
              <i></i> </label>
          </section>
			<section class="col col-md-6">
              <label class="input"> <i class="icon-prepend fa fa-credit-card"></i>
                <input type="text" name="applicant_assigned_card" id="applicant_assigned_card" value="<?php echo $this->applicant_assigned_card; ?>" placeholder="Select this field to tap card">
                <b class="tooltip tooltip-bottom-right">Please select this field, TAP card</b> </label>
            </section>
			
			</div>
          </fieldset>
      				

          <footer>    
		  
		    <fieldset>
           <div class="row">
            <section class="col col-md-6">
			
            <button type="submit" name="visitor_applicant_assignedcard_button" class="btn btn-orb-org">Submit</button>
            <button type="button" name="visitor_applicant_assignedcard_reset_button" class="btn btn-default">Reset</button>
			</section>
			
			 <section class="col col-6">
				<div style="margin-bottom: 0;margin-top: 0;min-height: 0;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="ajaxloader">
                  <img src="<?php echo base_url();?>/components/image/ajax-loader.gif">
                </div>
				<div class="callout callout-info" style="margin-bottom: 0;margin-top: 0;min-height:45px;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="calloutMessage">
                  <p>Visiting Information Noted!</p>
                </div>
				<div class="callout callout-danger" style="margin-bottom: 0;margin-top: 0;min-height: 45px;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="calloutMessageError">
                  <p> Card Error </p>
                </div>
			 </section>
			</div>
			</fieldset>
			
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->