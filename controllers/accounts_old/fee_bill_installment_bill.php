<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fee_bill_installment_bill extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('accounts/fee_bill/fee_bill_installment');
	}

	public function index()
	{		
		$this->load->view('accounts/fee_bill_installment_bill/fee_bill_installment');
		$this->load->view('accounts/fee_bill_installment_bill/fee_bill_installment_footer');
	}
}