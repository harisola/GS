  <div class="col-md-4 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?>" id="visitor_alumni_assignedcard_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Alumni<small>Visit</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <!-- <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a> -->
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
        <form action="<?php echo site_url()?>/threshold/visitor_alumni_ajax" id="review-form" name="review-form" class="orb-form" novalidate="novalidate" method="POST">
			<input type="hidden" name="abridged_name" id="abridged_name" value="" />
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } 
          ?>
          <section class="">              
            <label class="label">GS ID</label>
            <label class="input">
              <input type="text" name="gs_id" id="gs_id" placeholder="GS-ID" autofocus="autofocus">
            </label>
          </section>


           <fieldset>
            <section>
              <label class="input"> <i class="icon-append fa fa-credit-card"></i>
                <input type="text" name="alumni_assigned_card" id="alumni_assigned_card" placeholder="Please select this field and tap the card" required="required">
                <b class="tooltip tooltip-bottom-right">Please select this field and TAP the card</b> </label>
            </section>
          </fieldset>
              <footer>    
<section class="col col-md-6">		  
            <button type="submit" name="visitor_guest_assignedcard_button" class="btn btn-orb-org">Submit</button>
           
			</section>
			<section class="col col-6">
				<div style="margin-bottom: 0;margin-top: 0;min-height: 0;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="ajaxloader">
                  <img src="<?php echo base_url();?>/components/image/ajax-loader.gif">
                </div>
				<div class="callout callout-info" style="margin-bottom: 0;margin-top: 0;min-height:45px;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="calloutMessage">
                  <p>Information Noted!</p>
                </div>
				<div class="callout callout-danger" style="margin-bottom: 0;margin-top: 0;min-height: 45px;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="calloutMessageError">
                  <p> Card Error </p>
                </div>
			 </section>
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->


