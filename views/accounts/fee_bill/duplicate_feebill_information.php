<style>
.scrollitxaxis {
    overflow:scroll;
    height:350px;
}
</style>


<div class="col-md-12 bootstrap-grid sortable-grid ui-sortable"> 
  <!-- New widget -->
  
  <div class="powerwidget cold-grey" id="upload_bank_mis_div" data-widget-editbutton="false" role="widget" style="position: relative; opacity: 1;">
    <header role="heading">
      <?php if(!empty($this->StudentInfo[0])) { ?>
      <?php echo '<h2>' . $this->StudentInfo[0]['abridged_name'] . '<small>' . $this->StudentInfo[0]['class'] . '</small></h2>'; ?>
      <?php } ?>
      <div class="powerwidget-ctrls" role="menu">       
      </div><span class="powerwidget-loader"></span>
    </header>
    <div class="inner-spacer" role="content">
  
  
    <!-- tabs left -->
    
    <div class="tabbable tabs-left">

      <ul class="nav nav-tabs">
        <?php $i=1; foreach ($this->feebill as $feebill) { ?>
          <?php if(sizeof($this->feebill) != $i) { ?>
            <li class=""><a href="#bill_cycle_<?php echo $i; ?>" data-toggle="tab"><?php echo $feebill['bill_title']; ?> <!-- <span class="label label-default">Primary</span> --></a></li>
          <?php } else { ?>          
            <li class="active"><a href="#bill_cycle_<?php echo $i; ?>" data-toggle="tab"><?php echo $feebill['bill_title']; ?> <!-- <span class="label label-success">Yeah!</span> --></a></li>
          <?php } ?>
        <?php $i++; } ?>
      </ul>





      <?php
        $totalPayable = 0;
        $totalMonthly = 0;
        $studentTotalPayable = 0;
        $studentTotalMonthly = 0;
        $FMEO = 0;
        $MEO = 0;
        $counterFee = 0;
        foreach ($this->MultiFIF as $data) {
          $totalPayable += $data['total_fee_outstanding'];
          $totalMonthly += ($data['per_month_fee_base'] * 2.4);

          if($data['gs_id'] == $this->GSID){
            $studentTotalPayable = $data['total_fee_outstanding'];
            $studentTotalMonthly = ($data['per_month_fee_base'] * 2.4);
            if($data['total_fee_outstanding'] > 0) {
            }
          }
        }
        if($totalMonthly <=0 ){
            $FMEO = 0;  
        }else{
          $FMEO = ROUND($totalPayable / $totalMonthly, 0);
        }
        if($studentTotalMonthly <= 0){
          $MEO = 0;
        }else{
          $MEO = ROUND($studentTotalPayable / $studentTotalMonthly, 0);
        }
      ?>




      <div class="tab-content">

        <?php $i=1; foreach ($this->feebill as $feebill) { ?>
            <?php $fee_desc = explode(",", $feebill['fee_a']);
                  $fee_desc_b = explode(",", $feebill['fee_b']);
            ?>

            <?php if(sizeof($this->feebill) != $i) { ?>
              <div class="tab-pane" id="bill_cycle_<?php echo $i; ?>">
            <?php } else { ?>
              <div class="tab-pane active" id="bill_cycle_<?php echo $i; ?>">
            <?php } ?>

              <div class="table-responsive scrollitxaxis">
                <font size="3" face="verdana" color="black">Bill # : <?php echo $feebill['gb_id']; ?></font>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php if($FMEO > 0) { ?>
                    <font size="3" face="verdana" color="black">Student Installment Outstanding : </font>
                    <font size="5" color="red"><?php echo $MEO; ?></font>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <font size="3" face="verdana" color="black">Rs.</font>
                    <font size="4" color="red"><?php echo number_format($feebill['total_payable']+600); ?></font>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <font size="3" face="verdana" color="black">Family Installment Outstanding : </font>
                    <font size="5" color="red"><?php echo $FMEO; ?></font>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <font size="3" face="verdana" color="black">Rs.</font>
                    <font size="4" color="red"><?php echo number_format($totalPayable); ?></font>
                <?php } ?>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th width="5%">Bill Months</th>
                      <th width="10%">Issue Date</th>
                      <th width="10%">Due Date</th>
                      <th width="10%">Bank Validity</th>
                      <th width="5%">Payable</th>
                      <th width="5%">Received Amount</th>
                      <th width="10%">Received Date</th>
                      <th width="5%">Tuition Fee</th>
                      <th width="5%">Resource Fee</th>                      
                      <th width="5%">Musakhar</th>
                      <th width="5%">Yearly</th>
                      <th width="5%">SC Discount</th>
                      <th width="5%">Adjustment / Arrears</th>
                      <th width="5%">Concession</th>
                      <th width="5%">Scholarship</th>
                      <th width="5%">Adv. Tax</th>
                      <th width="5%">Smart Card</th>
                      <th width="5%">Magazine</th>                      
                      <th width="5%">Late Fee</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><div class="product-name">
                          <div class="product-num"></div>
                          <h4><?php echo $feebill['bill_months']; ?></h4>
                          <small></small> </div></td>
                      <td><?php echo date('D, d-M-Y', strtotime($feebill['bill_issue_date'])); ?></td>
                      <td><?php echo date('D, d-M-Y', strtotime($feebill['bill_due_date'])); ?></td>
                      <td><?php echo date('D, d-M-Y', strtotime($feebill['bill_bank_valid_date'])); ?></td>
                      <td><h6><?php echo number_format($feebill['total_payable']); ?></h6></td>

              
                      <?php if($feebill['received_amount'] <= 0) { ?>
                      <td><strong><font size="2.5" color="red"><?php echo number_format($feebill['received_amount']); ?></font></strong></td>
                      <td></td>
                      <?php } else { ?>
                      <td><strong><font size="2.5" color="green"><?php echo number_format($feebill['received_amount']); ?></font></strong></td>
                      <td><strong><font size="2.5" color="green"><?php if($feebill['received_date'] != '0000-00-00') { echo date('D, d-M-Y', strtotime($feebill['received_date'])); } ?></font></strong></td>
                      <?php } ?>

                      
                      <?php if (strlen((substr($fee_desc[0], strpos($fee_desc[0], '@')+1))) > 1) {?>
                        <td><?php echo number_format(substr($fee_desc[0], strpos($fee_desc[0], '@')+1)); ?></td>
                      <?php } else { ?>
                        <td><?php echo number_format($feebill['tuition_fee']); ?></td>
                      <?php } ?>
                      
                      <?php
                        if (sizeof($fee_desc) >= 2) {
                      ?>
                        <td><?php echo number_format(substr($fee_desc[1], strpos($fee_desc[1], '@')+1)); ?></td>
                      <?php } else { ?>
                        <td><?php echo ($feebill['resource_fee']); ?></td>
                      <?php } ?>


                      
                      <td> <?php echo ($feebill['musakhar']); ?> </td>

                      <?php
                        if (sizeof($fee_desc_b) >= 2) {
                      ?>
                        <td><?php echo substr($fee_desc_b[1], strpos($fee_desc_b[1], '@')+1); ?></td>
                      <?php } else { ?>
                        <td><?php /*echo substr($fee_desc_b[0], strpos($fee_desc_b[0], '@')+1);*/ ?>
                          <?php echo ($feebill['yearly']); ?>
                        </td>
                      <?php } ?> 
                     
                      <td><?php echo ($feebill['sc_discount']); ?></td>
                      <td><?php echo number_format($feebill['adjustment']); ?></td>

                      <?php if( $feebill['fee_d_l1'] =='' ){ ?>
                      <td><?php echo $feebill['concession']; ?></td>  
                       <?php } else{ ?>  
                      <td><?php echo $feebill['fee_d_l1']; ?></td>
                    <?php } ?>


                    <?php if( $feebill['fee_d_l2'] =='' ){ ?>
                      <td><?php echo $feebill['scholarship_codes']; ?></td>  
                       <?php } else{ ?>  
                      <td><?php echo $feebill['fee_d_l2']; ?></td>
                    <?php } ?>

                      

                      <td><?php echo number_format($feebill['oc_adv_tax']); ?></td>
                      <td><?php echo number_format($feebill['oc_smartcard_charges']); ?></td>
                      <td><?php echo number_format($feebill['oc_magazine']); ?></td>
                      
                      
                      <?php if(  $feebill['oc_late_fee'] == '' ) { ?>
                      <td><?php echo number_format($feebill['received_late_fee']); ?></td>
                    <?php } else { ?>
                      <td><?php echo number_format($feebill['oc_late_fee']); ?></td>
                    <?php } ?>
                    </tr>
                  </tbody>                  
                </table>



                <?php /*if(sizeof($this->feebill) == $i && floatval($feebill['total_payable']) > 0 && floatval($feebill['received_amount']) == 0) { ?>
                  <div class="row">
                    <div class="col-lg-12 remittance">
                      <?php $newFeeBillNumber = substr($feebill['gb_id'], 0, 15) ." " . chr(ord(substr($feebill['gb_id'], 16, 1))+1) . substr($feebill['gb_id'], -1); ?>
                      <h5>Duplicate Bill # will be: <?php echo $newFeeBillNumber; ?></h5>
                      <ul>
                        <li>If you generate duplicate feebill, old bill will become void.</li>
                        <li>Fee receiving will accept only against new bill # <?php echo $newFeeBillNumber; ?></li>                        
                      </ul>

                      <form action="<?php echo site_url()?>/accounts/fee_bill_duplicate/printForm" id="duplicate_feebill_print" name="duplicate_feebill_print" method="POST">
                        <input type="hidden" name="feebill_id" value="<?php echo $feebill['id']; ?>">
                        <input type="hidden" name="feebill_gbid" value="<?php echo $feebill['gb_id']; ?>">
                        <input type="hidden" name="feebill_new_gbid" value="<?php echo $newFeeBillNumber; ?>">
                        <!-- <button type="submit" class="btn btn-orb-org">Generate Duplicate</button>  -->
                      </form>
                    </div>
                  </div>
                <?php } */ ?>

                <?php /*if($FMEO > 0) { ?>
                  <div class="row">
                    <div class="col-lg-12 remittance">
                      <font size="3" face="verdana" color="black">Student Installment Outstanding : </font>
                      <font size="5" color="red"><?php echo $MEO; ?></font>
                      <br>
                      <font size="3" face="verdana" color="black">Family Installment Outstanding : </font>
                      <font size="5" color="red"><?php echo $FMEO; ?></font>
                    </div>
                  </div>
                <?php } */ ?>


              </div>
            </div>
        <?php $i++; } ?>

      </div>



    </div>
    
    <!-- /tabs -->  
  </div>
  </div>
</div>