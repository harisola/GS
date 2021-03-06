  <div class="col-md-4 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="visitor_parent_assignedcard_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Vendor<small>Visit</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <!-- <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a> -->
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
	  
	 
		  
  
        <form action="<?php echo site_url()?>/threshold/visitor_vendor" id="visitor_vendor_assignedcard_form" name="visitor_vendor_assignedcard_form" class="orb-form" novalidate="novalidate" method="POST">
		
		
          <header>Vendor Visiting Form  </header>          

			  
			  

						
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } 
          ?>                     
      
<!-- 42101-8623231-9 0345-3189989-->


          <fieldset>
		   <section>
              <label class="input"> <i class="icon-append fa fa-credit-card"></i>
               
				<input type="text" name="cnic" id="scnic" placeholder="Vendor NIC" value="<?php echo $this->vendor_nic; ?>" >
                <b class="tooltip tooltip-bottom-right">Please mention visitor NIC</b> </label>
            </section>
			
            <section>
              <label class="input"> <i class="icon-append fa fa-credit-card"></i>
			  <?php /* ?>
			  <input type="hidden" name="cnic" value="<?php echo $this->vendor_nic; ?>" >
			  <?php */ ?> 
                <input type="text" name="name" id="name" placeholder="Vendor Name" required="required" value="<?php echo $this->vendor_name; ?>" autofocus>
                <b class="tooltip tooltip-bottom-right">Please mention visitor NIC</b> </label>
            </section>

            <section>
              <label class="input"> <i class="icon-append fa fa-credit-card"></i>
                <input type="text" name="mobile_phone" id="mobile_phone" placeholder="Vendor Mobile Phone" required="required" value="<?php echo $this->vendor_mobile_phone; ?>" autofocus>
                <b class="tooltip tooltip-bottom-right">Please mention visitor Mobile Phone</b> </label>
            </section>
          </fieldset>



          <fieldset>          
            <section>
              <label class="input"> <i class="icon-append fa fa-book"></i>
                <input type="text" name="vendor_visit_purpose" id="vendor_visit_purpose" placeholder="Visiting Purpose" required="required" value="<?php echo $this->vendor_visit_purpose; ?>">
                <b class="tooltip tooltip-bottom-right">Please mention visiting purpose</b> </label>
            </section>

            <section>
              <label class="input"> <i class="icon-append fa fa-user"></i>
                <input type="text" name="vendor_visit_to_person" id="vendor_visit_to_person" value="<?php echo $this->vendor_visit_to_person; ?>" placeholder="Person Name">
                <b class="tooltip tooltip-bottom-right">Please mention the person name whom vendor is visiting</b> </label>
            </section>

            <section>
              <label class="input"> <i class="icon-append fa fa-building-o"></i>
                <input type="text" name="vendor_visit_to_dapartment" id="vendor_visit_to_dapartment" value="<?php echo $this->vendor_visit_to_dapartment; ?>" placeholder="Visiting Department">
                <b class="tooltip tooltip-bottom-right">Please mention visiting department</b> </label>
            </section>
          </fieldset>


          <fieldset>
            <section>
              <label class="input"> <i class="icon-append fa fa-credit-card"></i>
                <input type="text" name="vendor_assigned_card" id="vendor_assigned_card" value="<?php echo $this->vendor_assigned_card; ?>" placeholder="Please select this field and tap the card" required="required">
                <b class="tooltip tooltip-bottom-right">Please select this field and TAP the card</b> </label>
            </section>
          </fieldset>
      				

          <footer>            
            <button type="submit" name="visitor_guest_assignedcard_button" class="btn btn-orb-org">Submit</button>
            <button type="button" style="margin-left:165px;" name="visitor_vendor_assignedcard_reset_button" class="btn btn-default">reset</button>
          </footer>
        </form>
		
		
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->
  
  
  
  
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
  
 <div class="col-md-8 bootstrap-grid sortable-grid ui-sortable">
 <!-- Search Form -->
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="visitor_search" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Vendor<small>Visit</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
	  <div class="inner-spacer orb-form" role="content">
			<fieldset>
			<div class="row">
			
			  <section class="col col-6">
				<label class="input state-success"> <i class="icon-append fa fa-credit-card"></i>
				<input id="cnic" placeholder="Vendor NIC" type="text">
				<b class="tooltip tooltip-bottom-right">Please mention visitor NIC</b> </label>
				<span class="help-block">OR</span>
			  <!--/section>
			  
			  <section class="col col-6" -->
			  
				<label class="input state-success"> <i class="icon-append fa fa-credit-card"></i>
				<input id="mobile_phone2" placeholder="Vendor Mobile Number" type="text">
				<b class="tooltip tooltip-bottom-right">Please mention visitor Mobile Number</b> </label>
			  </section>
			  
			</div>
			<footer>            
				<button type="button" name="searchQuery" id="searchQuery" class="btn btn-orb-org">Search</button>
			</footer>
			</fieldset>
			
			
			
			
		</div>
	</div>
</div>
  <!-- End of Applicant form -->