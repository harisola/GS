  <div class="col-md-5  bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="new_student_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>New<small>Vehicle</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
        <form action="<?php echo site_url()?>/vehicle/new_vehicle_ajax/add" id="review-form" name="review-form" class="orb-form" novalidate="novalidate" method="POST">
		
		<input type="hidden" name="actionType" id="actionType" value="1" />
		<input type="hidden" name="updatedID" id="updatedID" value="0" />
		<input type="hidden" name="staffVehicalID" id="staffVehicalID" value="0" />
		
          <header>Vehicle Registration</header>
          
          <fieldset>
		  <div class="row">

            <section class="col col-md-6">
               <label class="select">
              <select name="registered" id="registered_type">
                <option value="0"disabled="disabled" selected="selected">Choose Registered</option>
                <?php foreach ($this->data['registered'] as $data) { ?>
                  <?php if ($data['id'] != 0) { ?>
                    <?php if(validation_errors() != false) { ?>
                      <?php if($this->input->post('subject_id') == $data['id']) { ?>
                        <option value="<?php echo $data['id']; ?>" selected="selected"><?php echo $data['name']; ?></option>
                      <?php } ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
                    <?php }else{ ?>
                    <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
              </select>
              <i></i>            
            </label>
			</section>
			<section class="col col-md-6">
			<label class="input"> <i class="icon-append fa fa-user"></i>
                  <input type="text" name="gvid" value="" placeholder="GV ID" id="gvid"/>
                    <b class="tooltip tooltip-bottom-right">GV ID</b> </label>
			</section>
            </div>
            </fieldset>
          <style>
		  .select2-container{
			  display:inline;
		  }
		  </style>
                <fieldset>     
 <div class="row">				
                <section class="col col-md-6">
                  <label class="input" id="name_code1"> <i class="icon-append fa fa-user"></i>
                  <input type="text" name="namecode" value="" placeholder="Name Code" id="namecode" />
                    <b class="tooltip tooltip-bottom-right">Name Code</b> </label>
					
					
					
						<input type="hidden" name="namecodehidden" value="" id="namecodehidden" />
						<input type="hidden" name="employee_id" value="0" id="employee_id" />
						
					    <label class="select" id="name_code2" style="display:none;">
							<select name="name_code2" id="staffData">
								<option value="0"disabled="disabled" selected="selected">Choose</option>
									<?php 
									 if( !empty( $staffData  ) ){
										foreach ( $staffData as $d) { ?>
										<option value="<?php echo $d['employee_id']; ?>"><?php echo $d['name_code']; ?></option>
									   <?php } ?>
									<?php } ?>
							  </select>
						</label>
				</section>
					<section class="col col-md-6">
					  <label class="input"> <i class="icon-append fa fa-user"></i>
						<input type="text" name="regno" value="" placeholder="Reg #" id="regno" />
						<b class="tooltip tooltip-bottom-right">Register No:</b> </label>
					</section>
				</div>
                </fieldset>
            <fieldset>
				<div class="row">
				   <section class="col col-md-6">
					<label class="select">
					 <?php echo form_dropdown('league', $league,'','class="required" id="league" id="league"');  ?>
					 <i></i> </label>
					 </section>
        <!--Team dropdown-->


       <section class="col col-md-6">
        
                 
					
				 <label class="select">
					<select name="team" id="team">
						<option value="">select</option>
					</select>
					
             <i></i> </label>	
                
        </section>
         </div>
            </fieldset>
       <fieldset>
	    <div class="row">
            <section class="col col-md-6">
            <label class="select">
              <select name="colour" id="color_id">
                <option value="0"disabled="disabled" selected="selected">Choose Colour</option>
                <?php foreach ($this->data['color'] as $data) { ?>
                  <?php if ($data['id'] != 0) { ?>
                    <?php if(validation_errors() != false) { ?>
                      <?php if($this->input->post('subject_id') == $data['id']) { ?>
                        <option value="<?php echo $data['id']; ?>" selected="selected"><?php echo $data['name']; ?></option>
                      <?php } ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
                    <?php }else{ ?>
                    <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
              </select>
              <i></i>            
            </label>
      </section>
     
	  
            <section class="col col-md-6">
			
			
                 
					
					    <label class="select">
      <select name="active" id="is_active">
      <option value="0"disabled="disabled" selected="selected">Choose Status</option>
        <option value="1" selected>Active </option>
        <option value="0">Un-Active</option>
       </select></label>
       <input type="hidden" name="activedate" value="<?php echo $today = date("d-m-y");?>"/>
	   </section>
                </section>
				
				
				</div>
				 </fieldset>
				
				
				
				 <fieldset>
				  <div class="row">
                 <section class="col col-md-6">
				  <label class="input"> <i class="icon-append fa fa-user"></i>
                  <input type="text" name="rfdec" value="" placeholder="Rf dec" id="rfdec" />
                    <b class="tooltip tooltip-bottom-right">Rf dec</b> </label>
					
                  
                </section>
           
       <section class="col col-md-6">
	   <label class="input"> <i class="icon-append fa fa-user"></i>
                  <input input type="text" name="rfhex" value="" placeholder="Rf hex" id="rfhex" />
                    <b class="tooltip tooltip-bottom-right">Rf hex</b> </label>
   
	   
	   </div>
	    </fieldset>
	   
	   
          <footer>
		  <fieldset>
		  
		  <section class="col col-md-6">
            <button type="submit" name="hcm_new_staff_add_button" class="btn btn-orb-org">Proceed</button>
			<button type="submit" name="visitor_worker_assignedcard_reset_button" id="visitor_worker_assignedcard_reset_button" class="btn btn-orb-org">Reset</button>
			
		</section>
<section class="col col-6">
				<div style="margin-bottom: 0;margin-top: 0;min-height: 0;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="ajaxloader">
                  <img src="<?php echo base_url();?>/components/image/ajax-loader.gif">
                </div>
				<div class="callout callout-info" style="margin-bottom: 0;margin-top: 0;padding-bottom: 0;padding-top: 10px;display:none;" id="calloutMessage">
				<h6> Thank you! </h6>
				  <p> Vehicle Registration Info Saved </p>
                </div>
				<div class="callout callout-danger" style="margin-bottom: 0;margin-top: 0;padding-bottom: 10px;padding-top: 10px;display:none;" id="calloutMessageError">
				<h6> <strong> Oops!  </strong> Duplicate Records </h6>
					<p> GV-ID </p>
					<p>Register No:</p>
					<p>Rf hex</p>
                </div>
			 </section>		
			</fieldset>
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->
      
      
      
      
      
      
      
      
      
      
      
      
<div id="rightSideData">
      
   <!-- Datatables View users -->
  <div class="col-md-7 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $class_list_color_view; ?> powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>New Vehile Registration<small>Detail</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="new_admission_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="vehicle_change_form_table" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 15px;">ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GV ID: activate to sort column ascending" style="width: 100px;">Gv id</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Van Number: activate to sort column ascending" style="width: 120px;">Van Number</th>
                 <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Register Type: activate to sort column ascending" style="width: 120px;">Register type</th>
                 <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Name Code: activate to sort column ascending" style="width: 85px;">Name code</th>
                 <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Registration No: activate to sort column ascending" style="width: 120px;">Registration No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Is Active: activate to sort column ascending" style="width: 85px;">Is Active</th>
               
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_call_name" placeholder="Filter ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_photo" placeholder="Filter GV ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_abridged_name" placeholder="Filter Van Number" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_official_name" placeholder="Filter Register Type" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_official_name" placeholder="Filter Name Code" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_dob" placeholder="Filter Registration No" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_grade_section" placeholder="Filter Is Active" class="search_init"></th>
               
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          
          <?php
     foreach($this->vehicle_registration_model->gettablevehicle() as $row) 
    {
      ?>
      <tr>
      
   <td class="centered-cell"><a href="#" data-id="<?=$row->id; ?>" class="vehicalID"><?=$row->id; ?></a></td>
   <td class="centered-cell"><?=$row->gv_id; ?></td>
   <td class="centered-cell aneditable_van_number"><a href="#" data-type="text" data-name="van_number" data-pk="<?php echo $row->id; ?>" data-placement="top"><?php echo $row->van_number; ?></a></td>
    <td class="centered-cell"><?php echo$row->register_type; ?></td>
     <td class="centered-cell"><?php echo $row->name_code; ?></td>
      <td class="centered-cell"><?php echo $row->registration_no; ?></td>
      <td class="centered-cell"><?php echo $row->is_active; ?></td>
      </tr>
          <?php
      }
       ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</div>
      
      
      
    