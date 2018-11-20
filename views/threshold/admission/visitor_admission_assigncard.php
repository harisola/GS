
  <div class="col-md-6 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="visitor_parent_assignedcard_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Admission<small>Visit</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <!-- <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a> -->
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
	  <?php /*?>
        <form action="<?php echo site_url()?>/threshold/visitor_admission" id="visitor_admission_assignedcard_form" name="visitor_admission_assignedcard_form" class="orb-form" novalidate="novalidate" method="POST"> <?php */ ?>
		<form action="<?php echo site_url()?>/threshold/Visitor_admission_ajax/admission" method="post" id="review-form" class="orb-form" novalidate="novalidate">
		
          <header>Visiting for Admission</header>          
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } 
          ?>                     
          <fieldset>      <div class="row">
		  
						<!--section class="col col-6">
                        <label class="input"> <i class="icon-prepend fa fa-user"></i>
                          <input type="text" name="fname" placeholder="First name">
                        </label>
                      </section>
                      <section class="col col-6">
                        <label class="input"> <i class="icon-prepend fa fa-user"></i>
                          <input type="text" name="lname" placeholder="Last name">
                        </label>
                      </section -->
					  
                    
			<style>

.callout-info::before {
   font-size: 1.5em;
    height: 29px;
    left: 10px;
    top: 3px;
    width: 29px;
}

.callout-danger::before {
   font-size: 1.5em;
    height: 29px;
    left: 10px;
    top: 3px;
    width: 29px;
}
			</style>		
			<!-- / 2720532651 / -->
            <section class="col col-6">
              <label class="input"> <i class="icon-prepend fa fa-credit-card"></i>
                <input type="text" name="cnic" id="cnic" placeholder="NIC" required="required" value="<?php echo $this->admission_nic; ?>" autofocus>
                <b class="tooltip tooltip-bottom-right">Please mention visitor NIC</b> </label>
            </section>
			
			<section class="col col-6">
			
			<div style="margin-bottom: 0;margin-top: 0;min-height: 0;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="ajaxloader">
                  <img src="<?php echo base_url();?>/components/image/ajax-loader.gif">
                </div>
				
				<div class="callout callout-info" style="margin-bottom: 0;margin-top: 0;min-height: 0;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="calloutMessage">
                  <p>Admission Information Noted!</p>
                </div>
				
				
				<div class="callout callout-danger" style="margin-bottom: 0;margin-top: 0;min-height: 0;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="calloutMessageError">
                  <p> Card Error </p>
                </div>
				
				
				
			</section>
			
			</div>
          </fieldset>



          <fieldset>
		  <div class="row">
		   <section class="col col-6">
		   <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" name="name" id="name" placeholder="Name" required="required" value="<?php echo $this->admission_name; ?>" autofocus>
                <b class="tooltip tooltip-bottom-right">Please mention visitor NIC</b> </label>
		   </section>
		   <section class="col col-6">
		   <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                <input type="text" name="mobile_phone" id="mobile_phone" placeholder="Mobile Phone" required="required" value="<?php echo $this->admission_mobile_phone; ?>" autofocus>
                <b class="tooltip tooltip-bottom-right">Please mention visitor Mobile Phone</b> </label>
		   </section>
		  </div>
          </fieldset>



          <fieldset>
		   <div class="row">
            <section class="col col-6">
              <label class="select">
                <select name="admission_visit_purpose" id="admission_visit_purpose" required="required">
                  <option value="0" selected="" disabled="">Visiting Purpose</option>
                  <option value="Form Issuance">Form Issuance</option>
                  <option value="Form Submission">Form Submission</option>
                  <option value="Assessment">Assessment</option>
                  <option value="Discussion">Discussion</option>
                  <option value="Offer Letter or Fee Bill">Offer Letter or Fee Bill</option>
                  <option value="Further Discussion">Further Discussion</option>
                </select>
                <i></i> </label>
            </section>

            <!-- <section>
              <label class="input"> <i class="icon-append fa fa-book"></i>
                <input type="text" name="admission_visit_purpose" id="admission_visit_purpose" placeholder="Visiting Purpose" required="required" value="<?php// echo $this->admission_visit_purpose; ?>">
                <b class="tooltip tooltip-bottom-right">Please mention visiting purpose</b> </label>
            </section> -->

            <section class="col col-6">
              <label class="input"> <i class="icon-prepend fa fa-user"></i>
                <input type="text" name="admission_visit_to_person" id="admission_visit_to_person" value="<?php echo $this->admission_visit_to_person; ?>" placeholder="Person Name">
                <b class="tooltip tooltip-bottom-right">Please mention the person name whom parent is visiting</b> </label>
            </section>
</div>
          </fieldset>
		  
		   <fieldset>
		   <div class="row">
		   
            <section class="col col-6">
              <label class="input"> <i class="icon-prepend fa fa-building-o"></i>
                <input type="text" name="admission_visit_to_dapartment" id="admission_visit_to_dapartment" value="<?php echo $this->admission_visit_to_dapartment; ?>" placeholder="Admission for class">
                <b class="tooltip tooltip-bottom-right">Please mention admission class</b> </label>
            </section>
			
			 <section class="col col-6">
              <label class="input"> <i class="icon-prepend fa fa-credit-card"></i>
                <input type="text" name="admission_assigned_card" id="admission_assigned_card" value="<?php echo $this->admission_assigned_card; ?>" placeholder="Please select this field and tap card" required="required">
                <b class="tooltip tooltip-bottom-right">Select this field and TAP card</b> </label>
            </section>
			
			</div>
          </fieldset>


          
      				

          <footer>            
            <button type="submit" name="visitor_guest_assignedcard_button" class="btn btn-orb-org">Submit</button>
            <button type="button" style="margin-left:165px;" name="visitor_admission_assignedcard_reset_button" class="btn btn-default">reset</button>
          </footer>
		  
        </form>
		
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->
  