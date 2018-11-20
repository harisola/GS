<div class="col-md-12 bootstrap-grid sortable-grid">
<!-- New widget -->
            
            
  <!-- End .powerwidget --> 
  <div class="powerwidget <?php echo $title_background_color_add; ?>" id="duplicate_feebill_info_bar" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>NOTE<small>Duplicate bill genereates only last generated bill. Previous bill becomes void once duplicate bill issued.</small></h2>
        <div class="powerwidget-ctrls" role="menu">          
<!--           <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
<a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a> -->
        </div>
          <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">        
        <form action="<?php echo site_url()?>/accounts/fee_bill_duplicate" id="duplicate_feebill_form" name="duplicate_feebill_form" class="orb-form" novalidate="novalidate" method="POST">
          <!-- <header>Enter GS-ID or GF-ID to view Family Information</header> -->
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } 
          ?>
          <fieldset>
            <div class="row">
              <section class="col col-2">              
                <label class="label">GS ID</label>
                <label class="input">
                  <input type="text" name="gs_id" id="gs_id" placeholder="GS-ID" required="required" autofocus="autofocus">
                </label>
              </section>              
            </div>
          </fieldset>
        <footer>
          <button type="submit" class="btn btn-orb-org">Search</button>            
        </footer>
      </form>
    </div>
  </div>
</div>