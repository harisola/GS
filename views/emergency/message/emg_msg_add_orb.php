  <div class="col-md-4  bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> -->

    <!-- Applicant Form -->

    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="applicant_form_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Send<small>Message</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
        <!-- <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST"> -->
          <header>Emg Msg</header>
          <?php
            if(validation_errors() != false) {
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";
            }else{
              if(count($_POST)){
                echo '<div class="callout callout-info"> Message to ' . $this->MessageToPersons .
                ' persons. <br><br> Server Response : ' .
                '<br> ' . $this->MessageBalance .
                '</div>';
              }
            }
          ?>

          <!-- R E D    B U T T O N S -->
          <!-- F I N A L    M E S S A G E -->
          <fieldset>
            <br><br><center>
              <section>
              <table>
              <tr><td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="1">
                  <input type="hidden" name="msg_id" value="2">
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-orb-org" onclick="return confirm('Are you sure? NC SOS to Internal Group')">NC SOS<br>to<br><br>Internal Group</button>
                  <!-- <a href="#myModal1" role="button" class="btn btn-orb-org" data-toggle="modal">NC SOS<br><br> to Internal Group</a> -->
                </form></td><td>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                <td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="3">
                  <input type="hidden" name="msg_id" value="1">
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-orb-org" onclick="return confirm('Are you sure? SC SOS to Internal Group')">SC SOS<br>to<br><br>Internal Group</button>
                </form></td>
              </tr></table>
              </section>
            </center>

            <br><br><br><br><center>
              <section>
              <table>
              <tr><td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="4">
                  <input type="hidden" name="msg_id" value="2">
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-orb-org" onclick="return confirm('Are you sure? NC SOS to ALL Contacts')">NC SOS<br>to<br><br>All Contacts</button>
                </form></td><td>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                <td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="2">
                  <input type="hidden" name="msg_id" value="1">
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-orb-org" onclick="return confirm('Are you sure? SC SOS to ALL Contacts')">SC SOS<br>to<br><br>All Contacts</button>
                </form></td>
              </tr></table>
              </section>
            </center>
            <br><br><br>
          </fieldset>



          <!-- G R E E N    B U T T O N S -->
          <!-- T E S T    M E S S A G E -->
          <br><br><br><br>
          <fieldset>
            <br><br><center>
              <section>
              <table>
              <tr><td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="1">
                  <input type="hidden" name="msg_id" value="3">
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-success" onclick="return confirm('Are you sure? TEST NC SOS to Internal Group')">TEST NC SOS<br>to<br><br>Internal Group</button>
                </form></td><td>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                <td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="3">
                  <input type="hidden" name="msg_id" value="4">
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-success" onclick="return confirm('Are you sure? TEST SC SOS to Internal Group')">TEST SC SOS<br>to<br><br>Internal Group</button>
                </form></td>
              </tr></table>
              </section>
            </center>

            <br><br><br><br><center>
              <section>
              <table>
              <tr><td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="4">
                  <input type="hidden" name="msg_id" value="3">
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-success" onclick="return confirm('Are you sure? TEST NC SOS to ALL Contacts')">TEST NC SOS<br>to<br><br>All Contacts</button>
                </form></td><td>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                <td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="2">
                  <input type="hidden" name="msg_id" value="4">
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-success" onclick="return confirm('Are you sure? TEST SC SOS to ALL Contacts')">TEST SC SOS<br>to<br><br>All Contacts</button>
                </form></td>
              </tr></table>
              </section>
            </center>
            <br><br><br>
          </fieldset>



          <!-- B L U E    B U T T O N S -->
          <!-- C U S T O M    M E S S A G E -->
          <br><br><br><br>
          <fieldset>
            <br><br><center>
              <section>
              <table>
              <tr><td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="1">
                  <input type="hidden" name="msg_id" value="5">
                  <label class="label">Message</label>
                  <label class="textarea textarea-resizable">
                    <textarea rows="3" name="message" id="message" style="margin-top: 0px; margin-bottom: 0px; height: 74px;"></textarea>
                  </label>
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-primary" onclick="return confirm('Are you sure? Custom NC SOS to Internal Group')">NC SOS<br>to<br><br>Internal Group</button>
                </form></td><td>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                <td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="3">
                  <input type="hidden" name="msg_id" value="5">
                  <label class="label">Message</label>
                  <label class="textarea textarea-resizable">
                    <textarea rows="3" name="message" id="message" style="margin-top: 0px; margin-bottom: 0px; height: 74px;"></textarea>
                  </label>
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-primary" onclick="return confirm('Are you sure? Custom SC SOS to Internal Group')">SC SOS<br>to<br><br>Internal Group</button>
                </form></td>
              </tr></table>
              </section>
            </center>

            <br><br><br><br><center>
              <section>
              <table>
              <tr><td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="4">
                  <input type="hidden" name="msg_id" value="5">
                  <label class="label">Message</label>
                  <label class="textarea textarea-resizable">
                    <textarea rows="3" name="message" id="message" style="margin-top: 0px; margin-bottom: 0px; height: 74px;"></textarea>
                  </label>
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-primary" onclick="return confirm('Are you sure? Custom NC SOS to ALL Contacts')">NC SOS<br>to<br><br>All Contacts</button>
                </form></td><td>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                <td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="2">
                  <input type="hidden" name="msg_id" value="5">
                  <label class="label">Message</label>
                  <label class="textarea textarea-resizable">
                    <textarea rows="3" name="message" id="message" style="margin-top: 0px; margin-bottom: 0px; height: 74px;"></textarea>
                  </label>
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-primary" onclick="return confirm('Are you sure? Custom SC SOS to ALL Contacts')">SC SOS<br>to<br><br>All Contacts</button>
                </form></td>
              </tr></table>
              </section>
            </center>
            <br><br><br>
          </fieldset>



          <!-- G R A Y    B U T T O N S -->
          <!-- M U L T I P L E    M E S S A G E -->
          <br><br><br><br>
          <fieldset>
            <br><br><center>
              <section>
              <table>
              <tr><td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="5">
                  <input type="hidden" name="msg_id" value="2">
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-default" onclick="return confirm('Are you sure? NC SOS to Test Group')">NC SOS<br>to<br><br>Test Group</button>
                </form></td><td>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                <td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="5">
                  <input type="hidden" name="msg_id" value="1">
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-default" onclick="return confirm('Are you sure? SC SOS to Test Group')">SC SOS<br>to<br><br>Test Group</button>
                </form></td>
              </tr></table>
              </section>
            </center>

            <br><br><center>
              <section>
              <table>
              <tr><td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="5">
                  <input type="hidden" name="msg_id" value="3">
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-default" onclick="return confirm('Are you sure? NC SOS to Test Group')">TEST NC SOS<br>to<br><br>Test Group</button>
                </form></td><td>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                <td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="5">
                  <input type="hidden" name="msg_id" value="4">
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-default" onclick="return confirm('Are you sure? SC SOS to Test Group')">TEST SC SOS<br>to<br><br>Test Group</button>
                </form></td>
              </tr></table>
              </section>
            </center>

            <br><br><br><br><center>
              <section>
              <table>
              <tr><td></td><td>
                <form action="<?php echo site_url()?>/emg/emg_msg" id="emg_send_msg_form" name="emg_send_msg_form" class="orb-form" novalidate="novalidate" method="POST">
                  <input type="hidden" name="contact_id" value="5">
                  <input type="hidden" name="msg_id" value="5">
                  <label class="label">Message</label>
                  <label class="textarea textarea-resizable">
                    <textarea rows="3" name="message" id="message" style="margin-top: 0px; margin-bottom: 0px; height: 74px;"></textarea>
                  </label>
                  <button type="submit" name="hcm_applicant_form_button" class="btn btn-default" onclick="return confirm('Are you sure? Custom NC SOS to Test Group')">NC SOS<br>to<br><br>Test Group</button>
                </form></td>
              </tr></table>
              </section>
            </center>
            <br><br><br>
          </fieldset>




          <footer>
            <!-- <button type="submit" name="hcm_applicant_form_button" class="btn btn-orb-org">Submit</button> -->
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->