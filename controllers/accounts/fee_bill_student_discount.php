<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fee_bill_student_discount extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
	}


	public function index(){
		$this->fromForm = "accounts/fee_bill_student_discount";

		$this->form_validation->set_rules($this->validation_gsid);
		$this->form_validation->set_message('verifyGSID','GS-ID not exists');
		$this->form_validation->set_message('canEditDiscount_of_GSID','The student does not have any discount');


		if($this->form_validation->run() == FALSE){			
			$this->load->view('accounts/student_discount/student_discount_input_form');
		}else{
			$GSID = $this->input->post('gs_id');
			$this->load->model('accounts/fee_bill/Fee_bill_student_discount_model');
			$this->data['student_discount_info'] = $this->Fee_bill_student_discount_model->getStudentDiscountInfo($GSID);
			$this->load->view('accounts/student_discount/student_discount_input_form');
			$this->load->view('accounts/student_discount/student_discount_edit_view');
		}
		$this->load->view('accounts/student_discount/student_discount_footer_orb');
	}



	public function edit(){
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
		
	    //$value = $_POST['value'];
		$value=0;
		
		
		if( $_POST['value'] <= 0 ){
			$value = 0;
		}else{
			$value = (int)$_POST['value'];	
		}
	    
		$table_data = array(
			$name => $value
		);
		
		$this->load->model('accounts/fee_bill/Fee_bill_student_discount_model');
	    if(is_int($value)) {
			$id = $this->Fee_bill_student_discount_model->save($table_data, $pk);        
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }		
	}



	public $validation_gsid = array(
		array('field' => 'gs_id', 'label' => 'GS-ID', 'rules' => 'trim|sanitize|callback_verifyGSID|callback_canEditDiscount_of_GSID')
	);
	

	function canEditDiscount_of_GSID($str){
		$this->load->model('accounts/fee_bill/Fee_bill_student_discount_model');
		if($this->Fee_bill_student_discount_model->already_discount($str) == false){
				return FALSE;
		}else{
			return TRUE;
		}
	}

	function verifyGSID($str)
	{
	   $field_value = $str;	   
	   $this->load->model('sis/fif_student_info_model');

	   if($this->input->post('gs_id') == "" || $this->fif_student_info_model->checkGSID($str) == false)
	   {
	     return FALSE;
	   }
	   else
	   {
	     return TRUE;
	   }
	}
}