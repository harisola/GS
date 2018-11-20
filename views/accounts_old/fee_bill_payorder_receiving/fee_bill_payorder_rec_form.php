  <div class="col-md-4  bootstrap-grid sortable-grid">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?>" id="fee_bill_payorder_receiving_div2" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <!-- <h2><small></small></h2> -->
        <div class="powerwidget-ctrls" role="menu">          
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
        <form action="<?php echo site_url()?>/accounts/fee_bill_payorder_receiving" id="new_student_form" name="new_student_form" class="orb-form" novalidate="novalidate" method="POST">
          <!-- <header></header> -->
          <?php
            if(validation_errors() != false) {
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";
            }else{
              if(count($_POST)){
                echo '<div class="callout callout-info"> saved success. <br><br>Please check fee receiving report</div>';              
              }
            }
          ?>
            <fieldset>
              <section>
                <label class="input"> <i class="icon-append fa fa-user"></i>
                  <input type="text" name="fee_bill_no" id="fee_bill_no" placeholder="<?php echo date('y') . '1-GS-ID-9'; ?>" autofocus="autofocus" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('fee_bill_no'); } ?>">
                  <b class="tooltip tooltip-bottom-right">Enter the Fee Bill ID</b> </label>
              </section>
            </fieldset>


            <fieldset>            
              <section>
                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                  <input type="text" name="payorder_date" id="payorder_date" placeholder="Payorder receiving date" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('payorder_date'); } ?>">
                  <b class="tooltip tooltip-bottom-right">Payorder Date</b>
                </label>
              </section>

              <section>
                <label class="input"> <i class="icon-append fa fa-slack"></i>
                  <input type="text" name="payorder_number" id="payorder_number" placeholder="Payorder Number" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('payorder_number'); } ?>">
                  <b class="tooltip tooltip-bottom-right">Payorder Number</b>
                </label>
              </section>

              <section>
                <label class="input"> <i class="icon-append fa fa-pencil"></i>
                  <input type="text" name="payorder_description" id="payorder_description" placeholder="Payorder Description" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('payorder_description'); } ?>">
                  <b class="tooltip tooltip-bottom-right">Payorder Description</b>
                </label>
              </section>

              <section>
                <label class="input"> <i class="icon-append fa fa-slack"></i>
                  <input type="text" name="payorder_amount" id="payorder_amount" placeholder="Payorder Amount" required="required" value="<?php if(validation_errors() != false) { echo $this->input->post('payorder_amount'); } ?>">
                  <b class="tooltip tooltip-bottom-right">Enter the Payorder Amount</b> </label>
              </section>

              <section>
                <label class="select">
                  <select name="is_late_fee">
                    <option value="0" selected="" disabled="">With Late Fee ?</option>                    
                    <option value="1">No</option>
                    <option value="2">Yes</option>
                  </select>
                  <i></i>
                  <b class="tooltip tooltip-bottom-right">Payorder with Late Fee ?</b>
                </label>
              </section>



              <section>
                <label class="select">
                  <select name="is_po_charges">
                    <option value="0" selected="" disabled="">apply Payorder charges Rs.600 ?</option>                    
                    <option value="1">No</option>
                    <option value="2">Yes</option>
                  </select>
                  <i></i>
                  <b class="tooltip tooltip-bottom-right">PO charges will deduct from the PO amount ?</b>
                </label>
              </section>
            </fieldset>
            
          <footer>
            <button type="submit" name="fo_new_admission_form_button" class="btn btn-orb-org">Proceed</button>
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->






  <div class="col-md-8  bootstrap-grid sortable-grid">
    <div id="feebill_info">
  
    </div>
  </div>