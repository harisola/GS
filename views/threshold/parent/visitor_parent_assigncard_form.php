  <div class="col-md-6 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="visitor_parent_assignedcard_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Parent<small>Visit</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <!-- <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a> -->
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
	  
	  <?php /* ?><form action="<?php echo site_url()?>/threshold/visitor_parent" method="post" id="review-form" class="orb-form" novalidate="novalidate"><?php  */ ?>
	  
	  <form action="<?php echo site_url()?>/ajax/searchQuery/setParentVisting" method="POST" id="review-form" class="orb-form" novalidate="novalidate">
		
          <header>Parent Visiting Form</header>          
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } 
          ?> 
		  <fieldset>
			<div class="row">
			     <section class="col col-md-6">
				  <label class="select">
					<select name="location_id" id="location_id">
					  <option value="0" selected="" disabled="">Location</option>
					  <?php if( !empty( $this->data['Get_TapIn_Location'] )): ?>
						<?php foreach( $this->data['Get_TapIn_Location'] as $lc ): ?>
							<option value="<?=$lc["Location_id"];?>"> <?=$lc["Location_name"];?> </option>
						<?php endforeach; ?>
					  <?php endif; ?>
					  
					</select>
					<i></i>
				  </label>
				</section>
			
			</div>
		  </fieldset>
		  
          <fieldset>
		   <div class="row">
		   
            <!-- <section>
              <label class="label" for="gf_id" id="gf_id" name="gf_id" value="">GF-ID will appear here</label>
            </section>

2764237579 family car
3447268860 vander card
			-->
<style>
.invalid{ display:none;   }
</style>
            <center>
              <img class="img-circle" name="father_img" id="father_img" src="<?php echo $this->father_img_path; ?>" alt="Parent Picture">
              <!-- <img class="img-circle" name="student_img" id="student_img" src="" alt="User Picture">
              <img class="img-circle" name="mother_img" id="mother_img" src="" alt="User Picture">  readonly	-->
            </center>
			<br>
            <section class="col col-md-6">
              <label class="input" id="visiterGF1"> <i class="icon-prepend fa fa-user"></i>
               <input type="text" name="gf_id" id="gf_id" placeholder="GF ID" value="<?php echo $this->GFID; ?>"> 
				
				 <?php /* ?> <input type="text" name="gf_id" id="gf_id"  value="13-406" /><?php */ ?>
				
                <b class="tooltip tooltip-bottom-right">Enter the GF ID</b> </label>
				<!--em for="email" class="invalid" id="visiterGF2">Please enter GF ID</em -->
            </section>

            <section class="col col-md-6">
              <label class="select" id="visiterE1">
                <select name="no_of_persons" id="no_of_persons">
                  <option value="0" selected="" disabled="">Visitor</option>
                  <option value="F">Father</option>
                  <option value="M">Mother</option>
                  <option value="B">Both</option>
                  <option value="O">Other / Guardian</option>
                </select>
                <i></i>
              </label>
			  <!--em for="email" class="invalid" id="visiterE2">Please enter Visitor</em -->
            </section>
</div>
</fieldset>
<fieldset>
<div class="row">
            <section class="col col-md-6">
              <label class="input" id="visiterEP1">
			  <i class="icon-prepend fa fa-question"></i>
                <input type="text" name="parent_visit_purpose" id="parent_visit_purpose" placeholder="Visiting Purpose" value="<?php echo $this->parent_visit_purpose; ?>" autofocus>
                <b class="tooltip tooltip-bottom-right">Please mention visiting purpose</b> </label>
				 <!--em for="email" class="invalid" id="visiterEP2">Please enter visitor purpose</em -->
            </section>

<section class="col col-md-6">
			<label class="input" id="visiterEPe1"> 
			  <i class="icon-prepend fa fa-user"></i>
                <input type="text" name="parent_visit_to_person" id="parent_visit_to_person" value="<?php echo $this->parent_visit_to_person; ?>" placeholder="Person Name">
                <b class="tooltip tooltip-bottom-right">Please mention the person name whom parent is visiting</b> </label>
				 <!--em for="email" class="invalid" id="visiterEPe2">Please enter the person name whom parent is visiting</em -->
            </section>
			
			</div>
</fieldset>
<fieldset>
<div class="row">
            <section class="col col-md-6">
              <label class="input" id="visiterED1">
			  <i class="icon-prepend fa fa-building-o"></i>
                <input type="text" name="parent_visit_to_dapartment" id="parent_visit_to_dapartment" value="<?php echo $this->parent_visit_to_dapartment; ?>" placeholder="Visiting Department">
                <b class="tooltip tooltip-bottom-right">Please mention visiting department</b> </label>
				 <!--em for="email" class="invalid" id="visiterED2">Please enter visiting department</em -->
            </section>
         
            <section class="col col-md-6">
              <label class="input"> <i class="icon-prepend fa fa-credit-card"></i>
                <input type="text" name="parent_assigned_card" id="parent_assigned_card" value="<?php echo $this->parent_assigned_card; ?>" placeholder="Please select this field and tap the card">
                <b class="tooltip tooltip-bottom-right">Please select this field and TAP the card</b> </label>
            </section>
			</div>
				<input type="hidden" name="parent_father_name" id="parent_father_name" value="">
				<input type="hidden" name="parent_father_nic" id="parent_father_nic" value="">
	          	<input type="hidden" name="parent_father_mobile_phone" id="parent_father_mobile_phone" value="">

	          	<input type="hidden" name="parent_mother_name" id="parent_mother_name" value="">
	          	<input type="hidden" name="parent_mother_nic" id="parent_mother_nic" value="">
	          	<input type="hidden" name="parent_mother_mobile_phone" id="parent_mother_mobile_phone" value="">

	          	<input type="hidden" name="father_img_path" id="father_img_path" value="<?php echo $this->father_img_path; ?>">
          </fieldset>

			

          <!--footer -->
		  <fieldset>
			<div class="row">
				<section class="col col-6">
				<button type="submit" name="submit" class="btn btn-orb-org">Submit</button>
				<button type="button" name="visitor_parent_assignedcard_reset_button" class="btn btn-default">Reset</button>
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
	
            
          <!--/footer -->
        </form>
		
		
		
		
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->