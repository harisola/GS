<?php 
Class Fee_bill_info extends CI_Controller{
	public function __construct(){
		parent::__construct();		
	}

	function index(){		
	}


	public function getFeeBillInfo(){
		$html = '<style>
	.table-striped>tbody>tr:nth-child(odd)>td{
		background-color:transparent;
	}
		</style>';


		if(count($_POST)){
			$GBID = str_replace("-", "", $_POST['gbid']);
			$this->load->model('accounts/fee_bill/fee_bill_upload_mis_model');
			$FeeBillInfo = $this->fee_bill_upload_mis_model->getThisFeeBillInfo($GBID);
			$FeeReceived = 0;
			foreach ($FeeBillInfo as $FB) {
				$FeeReceived += $FB['received_amount'];
			}

			// var_dump($FeeBillInfo);
		

			if(count($FeeBillInfo) > 0){
				$html .= '<div class="powerwidget cold-grey powerwidget-sortable" id="table2" data-widget-editbutton="false" role="widget" style="">
	              <header role="heading">
	                <h2>' . $FeeBillInfo[0]['abridged_name'] . '<small>' . $FeeBillInfo[0]['class'] . '</small></h2>
	              <div class="powerwidget-ctrls" role="menu">
	              	<!--<a href="#" class="button-icon powerwidget-delete-btn"><i class="fa fa-times-circle"></i></a>
	              	<a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
	              	<a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>-->
              	  </div>
              	  <span class="powerwidget-loader"></span>
              	  </header>
	              <div class="inner-spacer" role="content">

	              	<div class="page-header">
	                    <h1>' . $FeeBillInfo[0]['bill_title'] . '</h1>';

	                    if(($FeeBillInfo[0]['total_payable']-$FeeReceived) > 0){
	                    	$html .= '<div style="position: absolute;	right: 20px; top: 30px;"> Total Payable : <font size="5" color="red">Rs. ' . number_format(($FeeBillInfo[0]['total_payable']-$FeeReceived)) . '</font></div>';
	                    }else{
	                    	$html .= '<div style="position: absolute;	right: 20px; top: 30px;"> Excess amount received : <font size="5" color="green">Rs. ' . number_format(($FeeReceived-$FeeBillInfo[0]['total_payable'])) . '</font></div>';
	                    }

	                    // Number Of Billing Month

	                    $no_of_billing_month = $FeeBillInfo[0]['bill_months'];
	                   

	                    // Explode the Tutuon and Resources Fees

	                   
	                   $tution_resources =  explode(",",$FeeBillInfo[0]['fee_a']);

	                   // Musakhar Charges 
	                   if($FeeBillInfo[0]['fee_b'] != ''){
	                   		$fee_b = explode(",",$FeeBillInfo[0]['fee_b']);
	               		}


	               		// Discount to Student
	               		if($FeeBillInfo[0]['fee_d_l1'] != ''){

	               			$pos = strpos($FeeBillInfo[0]['fee_d_l1'],')');
	               			$fee_d_l1_text = $FeeBillInfo[0]['fee_d_l1'];
	               			$fee_d_l1_dtext = substr($FeeBillInfo[0]['fee_d_l1'],0,$pos+1); 
	               			$fee_d_l1_amount = substr($FeeBillInfo[0]['fee_d_l1'], $pos+1,strlen($FeeBillInfo[0]['fee_d_l1']));

	               		}


	               		// Minimum Resources Fees
	               		if($FeeBillInfo[0]['fee_d_l2'] != ''){
	               			$fee_d = explode(",",$FeeBillInfo[0]['fee_d_l2']);
	               		}
	               		

	               		// Advance to Govt 
	               		if($FeeBillInfo[0]['oc_adv_tax'] != ''){
	               			$oc_adv_tax = intval($FeeBillInfo[0]['oc_adv_tax']);
	               			if($oc_adv_tax == 0){
	               				$advance_tax = '-';
	               			}
	               			else if($oc_adv_tax != 0){
	               				$advance_tax = $oc_adv_tax;
	               			}	
	               		}

	               		// Adjustment

	               		if($FeeBillInfo[0]['adjustment'] != ''){
	               			$adjustment = intval($FeeBillInfo[0]['adjustment']);
	               			if($adjustment == 0){
	               				$adj = "-";
	               			}
	               			else if($adjustment != 0){
	               				$adj = $adjustment;
	               			}
	               		}
	               		
	               		

	               		


	                   $tution = $tution_resources[0];

	                   if(!empty($tution_resources[1])){
	                   $resources = $tution_resources[1];
	               	   }
	               	   else{
	               	   	$resources = null;
	               	   }

	               	  

	                   //Explode to get the Tution Fess
	                   $t_fee = explode("@",$tution);

	                   $tution_fee_text = ($t_fee[0]);
	                   $tution_fee = intval($t_fee[1]);

	                   
	                   // tution fee per month
	                   $tution_fee_per_month = intval($tution_fee/$no_of_billing_month);

	                   // Resources Fees

	                   if($resources != null){

	                   $r_fees = explode("@",$resources);
	                   // var_dump($r_fees);

	                   $resources_fees_text = ($r_fees[0]);
	                   $resources_fees = intval($r_fees[1]);

	                   // Resources Fees Per Month

	                   $resources_fees_per_month = intval($resources_fees/$no_of_billing_month);

	               	   }
	               	   else if($resources == null){
	               	   	$resources_fees = 0;
	               	   	$resources_fees_per_month = 0;	

	               	   }
	                   // var_dump($FeeBillInfo[0]['fee_a_discount']);

	                   if($FeeBillInfo[0]['fee_a_discount'] == 0){
	                   	
	                   	$total_bill = intval($tution_fee+$resources_fees);
	                   	$total_bill_per_month = intval($tution_fee_per_month+$resources_fees_per_month);

	                   }
	                   else{

	                   	$discount = intval($FeeBillInfo[0]['fee_a_discount']);
	                   	$discount = $discount*$no_of_billing_month;
	                   	$discount_per_month = intval($discount/$no_of_billing_month);
	                   	$total_bill = intval($tution_fee+$resources_fees-$discount);
	                   	$total_bill_per_month = intval($tution_fee_per_month+$resources_fees_per_month-	$discount_per_month);
	                   	// var_dump($total_bill_per_month);


	                   }
	                   


	                   // var_dump($total_tution_resource);
                  	$html .= '</div>
                  	<div class="col-md-6">
                  		<table class="table table-striped">
	                      <thead>
	                        <tr>
	                          <th width="40%"></th>
	                          <th width="30%" style="text-align: right !important;">Monthly Amount</th>
	                          <th width="30%" style="text-align: right !important;">Total Amount</th>
	                        </tr>
	                      </thead>
	                      <tbody>
	                        <tr>
	                          <td><div class="product-name">
	                              <h5>'.$tution_fee_text.'</h5>	
	                              </div>
	                          </td>
	                          <td align="right">'.$tution_fee_per_month.'</td>
	                          <td align="right"><h4>'.number_format($tution_fee).'</h4></td>
	                        </tr>';

	                        if(!empty($resources)){	
	                        	$html .='<tr>
	                        	 <td><div class="product-name">
	                         		<h5>'.$resources_fees_text.'</h5>
	                         	 </div>
	                         	 </td>
	                         	 <td align="right">'.$resources_fees_per_month.'</td>
	                         	 <td align="right"><h4>'.number_format($resources_fees).'</h4></td> 	
	                      		</tr>';
	                      	}

	                      	// Fee Discount
	                      	if($FeeBillInfo[0]["fee_a_discount"] != 0){
	                      		$html .= '<tr>
	                         <td><div class="product-name">
	                         	<h5>Discount Fee</h5>
	                         	</div>
	                         </td>
	                         <td align="right">(-'.$discount_per_month.')</td>
	                         <td align="right"><h4>(-'.$discount.')</h4></td><tr>';
	                      	}


	                      	$html .='<tr style="background-color:#33383d;color:#ffffff;font-weight:bold;">
	                      	 <td>
	                      	  <div class="product-name">
	                      	  	<h5>GROSS TUITION FEE</h5>
	                      	  </div>
	                      	 </td>
	                      	 <td align="right">'.$total_bill_per_month.'</td>
	                      	 <td align="right">'.number_format($total_bill).'</td>
	                      	</tr>';


	                     //Concession Depend on C(CT)50
	                      	
	                    if($FeeBillInfo[0]['fee_d_l1'] != ''){
	                    	$discount_percentage = ($total_bill/100) * $fee_d_l1_amount;
	                    	$html .='<tr>
	                    	<td>
	                      	 <div class="product-name">
	                      	  <h5>Concession</h5>
	                      	 </div>			
	                      	</td>
	                      	<td align="right">'.$fee_d_l1_text.'</td>
	                      	<td align="right"><h4>('.number_format($discount_percentage).')</h4></td>
	                      	
	                      	
	                      	</tr>';
	                    }



	                    // Minimum Resources Fees

	                    if($FeeBillInfo[0]['fee_d_l2'] != ''){
	                    	$minimum_resource = 0;
	                    	for($i=0;$i<sizeof($fee_d);$i++){
	                    		$fee_d1 = explode('@',$fee_d[$i]);
	                    		$html .= '<tr>
	                    		<td>
	                    		 <div class="product-name">
	                    		 	<h5>'.$fee_d1[0].'</h5>
	                    		 </div>
	                    		 </td>
	                    		 <td align="right" colspan="3"><h4>'.number_format(($fee_d1[1]*$no_of_billing_month)).'</h4></td>
	                    		 </tr>
	                    		';
	                    		$minimum_resource += $fee_d1[1];
	                    			
	                    	}
	                    	$minimum_resource = $minimum_resource*$no_of_billing_month;
	                    	
	                    }

	                    

	                    $html .= '<tr>
	                    <td></td>
	                    <td></td>
	                    <td></td>
	                    </tr>';

	                    // Musakhar Charges

	                    if($FeeBillInfo[0]['fee_b'] != ''){
	                      	$additional_charges	= 0;	
	                      	for($i=0;$i<sizeof($fee_b);$i++){
	                   			$fee_b1 = explode("@",$fee_b[$i]);
	                   	
	 							
	                      	$html .= '<tr>
	                      		<td>
	                      		 <div class="product-name">
	                      			<h5>'.$fee_b1[0].'</h5>
	                      		 </div>			
	                      		</td>
	                      		<td align="right"></td>
	                      		<td align="right"><h4>'.number_format($fee_b1[1]).'</h4></td>
	                      	</tr>';

	                      	$additional_charges += $fee_b1[1];

	                      }

	                    }

	                    // Additional Charges	

	                    if(!empty($additional_charges)){		  	
	                      $html .='<tr style="background-color:#33383d;color:#ffffff;font-weight:bold;">
	                      	 <td>
	                      	  <div class="product-name">
	                      	  	<h5>ADDITIONAL CHARGES</h5>
	                      	  </div>
	                      	 </td>
	                      	 <td align="right"></td>
	                      	 <td align="right">'.number_format($additional_charges).'</td>
	                      	</tr>';

	                    }

	                 // Total Current Billing
	                 
	                 if(empty($additional_charges)){
	                 	$additional_charges = 0;
	                 }

	                 if(empty($total_bill)){
	                 	$total_bill =0;
	                 }

	                 if(empty($discount_percentage)){
	                 	$discount_percentage =0;
	                 }

	                 if(empty($minimum_resource)){
	                 	$minimum_resource =0;
	                 }

	                 if(empty($oc_adv_tax)){
	                 	$advance_tax_govt = 0;
	                 }




	                 $total_current_bill = ($total_bill+$additional_charges+$minimum_resource+$advance_tax_govt)-$discount_percentage;
	                


	                 // Total Current Billing
                      $html.='<tr style="background-color:#33383d;color:#ffffff;font-weight:bold;">
                      	 <td colspan="2">
                      	  <div class="product-name">
                      	  	<h5>TOTAL CURRENT BILLING</h5>
                      	  </div>
                      	 </td>
                      	 
                      	 <td align="right"><h4>'.number_format($total_current_bill).'</h4></td>
                      	</tr>';

                    


                      $html .='</tbody>

                      <!--<tfoot>
	                      <tr>
	                      	<td class="noborders" colspan="1" rowspan="1">&nbsp;</td>
	                        <td colspan="1">Total Payale</td>
	                        <td colspan="1" align="right">3800.00</td>
	                      </tr>	                      
                      </tfoot>-->
                      
                    </table>
                </div>
                ';

	                $html .='
	                	<div class="col-md-6">
                  		 <table class="table table-striped">
	                      <thead>
	                        <tr>
	                          <th width="40%"></th>
	                          <th width="30%" style="text-align: right !important;">Monthly Amount</th>
	                          <th width="30%" style="text-align: right !important;">Total Amount</th>
	                        </tr>
	                      </thead>
	                      <tbody>';


	                      // Advance Tax To Govt	
	                      if(!empty($advance_tax)){
	                      	$html .='<tr>
	                          <td><div class="product-name">
	                              <h5>Advance Tax to Govt on Parents Behalf(adjustable)</h5>	
	                              </div>
	                          </td>
	                          <td align="right"></td>
	                          <td align="right"><h4>'.$advance_tax.'</h4></td>
	                        </tr>';
	                    	}


	                     // Adjustment	
	                     if(!empty($adj)){

							$html .='<tr>
	                          <td><div class="product-name">
	                              <h5>Current Arrears /(Adjustments) from Earlier Billing</h5>	
	                              </div>
	                          </td>
	                          <td align="right"></td>
	                          <td align="right"><h4>'.$adj.'</h4></td>
	                        </tr>';

	                    }


	                    // Total Payable Bill
	                    if(empty($total_current_bill)){
	                    	$total_current_bill =0;
	                    }
	                    if(empty($adj)){
	                    	$adj = 0;
	                    }

	                    $total_payable = $adj+$total_current_bill;


	                        $html .= '<tr style="background-color:#33383d;color:#ffffff;font-weight:bold;">
	                          <td colspan="2"><div class="product-name">
	                              <h5>TOTAL CURRENTLY PAYABLE</h5>	
	                              </div>
	                          </td>
	                          <td align="right"><h4>'.number_format($total_payable).'</h4></td>
	                        </tr>

	                      </tbody>
		                 </table>
		                </div>';




                if($FeeBillInfo[0]['received_amount'] != ''){
	                $html .= '<table class="table table-condensed table-bordered margin-0px">
	                  <thead>
	                    <tr>
	                      <th>Receiving Date</th>
	                      <th>Amount</th>
	                      <th>Mode</th>
	                      <th>Description</th>
	                    </tr>
	                  </thead>
	                  <tbody>';

		                foreach ($FeeBillInfo as $FB) {
			                $html .= '<tr>
			                      <td>' . $FB['received_date'] . '</td>
			                      <td>' . $FB['received_amount'] . '</td>
			                      <td>' . $FB['received_payment_mode'] . '</td>
			                      <td>' . $FB['received_branch'] . '</td>
			                    </tr>';
			            }

	                    
	                $html .= '</tbody>
	                </table>';
	            }else{

	            	$html .= '<div class="col-lg-12 remittance">
                        <h5>No fee received yet !</h5>
                        <ul>
                          <li>Installment amount only receive through Pay Order</li>
                          <li>Payorder charges are Rs. 600</li>
                          <li>Late Fee amount has options</li>
                        </ul>
                      </div>';
	            }

	            $html .= '</div>
	            </div>';		
			}
			
        }

        
		echo $html;
	}
}