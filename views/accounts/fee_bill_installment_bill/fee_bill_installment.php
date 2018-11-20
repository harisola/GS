<div class="col-md-12 bootstrap-grid sortable-grid">
<!-- New widget -->
            
            
  <!-- End .powerwidget --> 
  <div class="powerwidget <?php echo $title_background_color_add; ?>" id="duplicate_feebill_info_bar" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>NOTE<small>Only generates current Installment bill. </small></h2>
        
          <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">        
        


        <!-- <header>Enter GS-ID or GF-ID to view Family Information</header> -->
        <form action="" id="form_installment_gsid" name="form_installment_gsid" class="orb-form" novalidate="novalidate" method="POST">
          <fieldset>
            <div class="row">
              <section class="col col-2">              
                <label class="label">GS ID</label>
                <label class="input">
                  <input type="text" name="gs_id" id="gs_id" placeholder="GS-ID" required="required" autofocus="autofocus">
                </label>
              </section> 
              <section class="col col-2">              
                <label class="label">&nbsp;</label>
                <label class="input">
                  <button type="submit" id="search_gsid" class="btn btn-orb-org">Search</button>
                </label>
              </section>              
            </div>
          </fieldset>
          <footer></footer>
        </form>
		  




        <!-- <header>Enter GS-ID or GF-ID to view Family Information</header> -->
        <form action="" id="form_installment_genbill" name="form_installment_genbill" class="orb-form" novalidate="novalidate" method="POST">
          <fieldset>
              <div id="student_info" class="col-md-12">
            		Installment # 2
              </div><br /><br />
            <div class="row">
          		<section class="col col-2">              
	                <label class="label">Waive percentage</label>
	                <label class="input">
	                  <input type="number" min="0" max="100" name="" id="waive_percentage" placeholder="0 - 100"  required="required" autofocus="autofocus">
	                </label>
	            </section>
          		<section class="col col-2">              
	                <label class="label">Bill Issue Date</label>
	                <label class="input">
	                  <input type="date" name="" id="issue_date" placeholder="Date" required="required" autofocus="autofocus">
	                </label>
	            </section>
	            <section class="col col-2">              
	                <label class="label">Due Date</label>
	                <label class="input">
	                  <input type="date" name="" id="due_date" placeholder="Date" required="required" autofocus="autofocus">
	                </label>
	            </section>
	            <section class="col col-2">              
	                <label class="label">Bank Validity Date</label>
	                <label class="input">
	                  <input type="date" name="" id="validity_date" placeholder="Date" required="required" autofocus="autofocus">
	                </label>
	            </section>
	            <section class="col col-2">              
	                <label class="label">&nbsp;</label>
	                <label class="input">
	                  <button type="submit" id="generate_bill" class="btn btn-orb-org">Generate Bill</button>
	                </label>
	            </section>   
          	</div><!-- -->

          </fieldset>
          <footer></footer>
        </form>





          
          <div class="row" id="div_fee_bill">
          	<div class="col-md-12">
          		content for going 
          	</div>
          </div>

    </div>
  </div>
</div>