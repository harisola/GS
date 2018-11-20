<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fee_bill_payorder_receiving extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('accounts/fee_bill/fee_bill_upload_mis_model');
	}

	public function index(){		
		$this->form_validation->set_rules($this->fee_bill_upload_mis_model->validation_payorder_receiving);
		$this->formError = 0;
		$freezeBlocks=$this->fee_bill_upload_mis_model->freezeBlocks();
		$data=array('freeze' => $freezeBlocks);
		if($this->form_validation->run() == FALSE){
			$this->load->view('accounts/fee_bill_payorder_receiving/fee_bill_payorder_rec_form',$data);
			$this->load->view('accounts/fee_bill_payorder_receiving/fee_bill_payorder_rec_orb_footer');			
		}else{
			$this->add();
			$this->load->view('accounts/fee_bill_payorder_receiving/fee_bill_payorder_rec_form',$data);
			$this->load->view('accounts/fee_bill_payorder_receiving/fee_bill_payorder_rec_orb_footer');
		}		
	}

	public function add()
	{
		if(count($_POST))
		{
			$LateFeeAmount = 600;
			$POChargesAmount = 600;
			$BillNo = str_replace("-", "", $this->input->post('fee_bill_no'));
			$PayorderDate = $this->input->post('payorder_date');
			$PayorderNumber = $this->input->post('payorder_number');
			$PayorderDesc = $this->input->post('payorder_description');
			$IsLateFee = $this->input->post('is_late_fee');
			$IsPOCharges = $this->input->post('is_po_charges');
			
						
			$LateFee = 0;
			$POCharges = 0;
			$FeeBillID = $this->fee_bill_upload_mis_model->getFeeBillID($BillNo);

			if(floatval($IsLateFee) == 2){
				$LateFee = $LateFeeAmount;
			}

			if(floatval($IsPOCharges) == 2){
				$POCharges = $POChargesAmount;
			}

			if(floatval($IsLateFee) != 2){$LateFeeAmount=0;}
			$PayorderAmount = $this->input->post('payorder_amount') - $LateFeeAmount - $POCharges;


			$payorder_data = array(
				'fee_bill_id' => $FeeBillID,
				'received_date' => $PayorderDate,
				'received_amount' => $PayorderAmount,
				'received_late_fee' => $LateFee,
				'received_po_charges' => $POCharges,
				'received_payment_mode' => "Payorder",
				'received_branch' => "PO#: " . $PayorderNumber . ", " . $PayorderDesc
			);

			$feebill_saved = $this->fee_bill_upload_mis_model->save($payorder_data);
		}
	}
}