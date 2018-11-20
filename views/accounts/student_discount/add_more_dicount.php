<?php  //var_dump( $this->data['student_discount_info']);  ?>


<div class="bootstrap-grid sortable-grid">            
	<div class="powerwidget cold-grey" id="student_discount_new" data-widget-editbutton="false" role="widget" style="">
		<header role="heading">
			<h2>Add More <small>Student Fee Discount</small></h2>
			<div class="powerwidget-ctrls" role="menu">          
			<a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
			<a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
			</div>
			<span class="powerwidget-loader"></span>
		</header>
      <div class="inner-spacer" role="content">        
        <address>
          <strong><?php echo $this->data['student_discount_info'][0]['abridged_name'] . '</strong> (GS-ID: <strong>' . $this->input->post('gs_id') . ')'; ?></strong><br>
          <?php echo $this->data['student_discount_info'][0]['grade_name'] . '-' . $this->data['student_discount_info'][0]['section_name']; ?><br>
          <br>
        </address>

        <form action="<?php echo site_url() . '/accounts/add_more_discount_ajax/add'; ?>" id="student_fee_discount_addmore_form" name="student_fee_discount_addmore_form" class="orb-form" novalidate="novalidate" method="POST">
          <!-- <header>Enter GS-ID or GF-ID to view Family Information</header> -->
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } 
          ?>          

          <fieldset>
            <input type="hidden" name="gs_id" value="<?php echo $this->input->post('gs_id');?>">
			<input type="hidden" name="student_id" value="<?php echo $this->data['student_discount_info'][0]['id'];?>">
            <section>
              <label class="select">
                <select name="concession_type">
                  <option value="1" selected="">Teacher Child</option>
                  <option value="2">Need Based</option>
                  <option value="3">Friends & Family</option>
                  <option value="4">Single Parent</option>
                  <option value="5">Resourceful</option>
                  <option value="6">Other Concession</option>
                  <option value="7">Scholarship - Academic</option>
                  <option value="8">Sholarship - Non-Academic</option>
                  <option value="9">South Campus</option>
                  <option value="10">Provisional Concession</option>
                </select>
                <i></i> 
              </label>
            </section>            

            <section>
              <label class="input">                
                <input type="number" name="aug" id="aug" placeholder="August">
                <b class="tooltip tooltip-bottom-right">August</b> </label>
            </section>
            
            <section>
              <label class="input">
                <input type="number"  name="sep" id="sep" placeholder="September">
                <b class="tooltip tooltip-bottom-right">September</b> </label>
            </section>

            <section>
              <label class="input">
                <input type="number"  name="oct" id="oct" placeholder="October">
                <b class="tooltip tooltip-bottom-right">October</b> </label>
            </section>

            <section>
              <label class="input">
                <input type="number"  name="nov" id="nov" placeholder="November">
                <b class="tooltip tooltip-bottom-right">November</b> </label>
            </section>

            <section>
              <label class="input">
                <input type="number"  name="dec" id="dec" placeholder="December">
                <b class="tooltip tooltip-bottom-right">December</b> </label>
            </section>


            <section>
              <label class="input">
                <input type="number"  name="jan" id="jan" placeholder="January">
                <b class="tooltip tooltip-bottom-right">January</b> </label>
            </section>

            <section>
              <label class="input">
                <input type="number"  name="feb" id="feb" placeholder="February">
                <b class="tooltip tooltip-bottom-right">February</b> </label>
            </section>

            <section>
              <label class="input">
                <input type="number"  name="mar" id="mar" placeholder="March">
                <b class="tooltip tooltip-bottom-right">March</b> </label>
            </section>

            <section>
              <label class="input">
                <input type="number"  name="apr" id="apr" placeholder="April">
                <b class="tooltip tooltip-bottom-right">April</b> </label>
            </section>

            <section>
              <label class="input">
                <input type="number"  name="may" id="may" placeholder="May">
                <b class="tooltip tooltip-bottom-right">May</b> </label>
            </section>

            <section>
              <label class="input">
                <input type="number"  name="jun" id="jun" placeholder="June">
                <b class="tooltip tooltip-bottom-right">June</b> </label>
            </section>

            <section>
              <label class="input">
                <input type="number"  name="jul" id="jul" placeholder="July">
                <b class="tooltip tooltip-bottom-right">July</b> </label>
            </section>            

          </fieldset>
          <footer>
            <button type="submit" class="btn btn-orb-org" id="Button_AddMore"> Add Another Discount </button>
          </footer>
        </form>
      </div>
    </div>
  </div>