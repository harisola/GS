  <div class="col-md-4 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?>" id="visitor_alumni_or_family_assignedcard_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Alumni / Parents<small>Visit</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <!-- <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a> -->
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
        <form action="<?php echo site_url()?>/threshold/visitors_smartcard" id="visitor_alumni_or_family_assignedcard_form" name="visitor_alumni_or_family_assignedcard_form" class="orb-form" novalidate="novalidate" method="POST">
          <!-- <header>Alumni or Family Card Reder</header> -->          
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } else if(count($_POST) && empty($this->NFCCardHolder)) {                            
              echo '<div class="callout callout-danger">' . 'Smart Card  NOT  recognized!' . "</div>";
            }
          ?>          

          <fieldset>
            <section class="">              
              <label class="label">Tap Smart Card Here</label>
              <label class="input">
                <input type="text" name="rfid_dec" id="rfid_dec" placeholder="Please select and TAP NFC smart card" autofocus="autofocus">
              </label>
            </section>
          </fieldset>

        
          <?php if(count($_POST) && !empty($this->NFCCardHolder)) { ?>            
            <div class="">
              <div class="coupons">
                <div class="coupons-inner"><h1 align="center"><?php echo $this->NFCCardHolder[0]['name'] ?></h1>
                  <br>
                  <h3 align="center" class="coupons-code"><?php echo $this->NFCCardHolder[0]['visitor'] ?></h3>
                  <br><br>
                  <div><h3 align="center"><?php echo date('g:i A'); ?></h3></div>
                  <div class="one-time"><h4 align="center"><?php echo date('d-M-Y'); ?></h4></div>
                </div>
              </div>
            </div>            
            <br><br>
          <?php } ?>
      				

          <footer>            
            <button type="submit" name="visitor_guest_assignedcard_button" class="btn btn-orb-org">  Smart Card  </button>            
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->