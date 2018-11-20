<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fee_bill_arrears_advance extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('accounts/fee_bill/fee_bill_arrears_advance_model');
	}

	public function index()
	{		
		$this->data['fee_arrears_advance'] = $this->fee_bill_arrears_advance_model->getStudentsArrearsAdvanceAmount($this->AcademicSessionFrom, $this->AcademicSessionTo);
		$this->load->view('accounts/fee_bill_arrears_advance/fee_bill_arrears_advance_view');
		$this->load->view('accounts/fee_bill_arrears_advance/fee_bill_arrears_advance_footer_orb');
	}
}