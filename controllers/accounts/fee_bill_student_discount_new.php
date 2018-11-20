<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fee_bill_student_discount_new extends MY_Controller {

	public function __construct()
	{ 
		parent::__construct();
	}
	
	public function index(){
		$this->fromForm = "accounts/fee_bill_student_discount_new";
		$this->form_validation->set_rules($this->validation_gsid);
		$this->form_validation->set_message('verifyGSID','GS-ID not exists');
		if($this->form_validation->run() == FALSE){			
			$this->load->view('accounts/student_discount/student_discount_input_form');
		}else{
			$GSID = $this->input->post('gs_id');
			$this->load->model('accounts/fee_bill/Fee_bill_student_discount_model');
			if($this->Fee_bill_student_discount_model->already_discount($GSID) == false){
				$this->data['student_discount_info'] = $this->Fee_bill_student_discount_model->getStudentInfo($GSID);
				$this->load->view('accounts/student_discount/student_discount_input_form');
				$this->load->view('accounts/student_discount/student_discount_new_form');
			}else{
				$this->data['student_discount_info'] = $this->Fee_bill_student_discount_model->getStudentDiscountInfo($GSID);
				$this->load->view('accounts/student_discount/student_discount_input_form');
				$this->load->view('accounts/student_discount/student_discount_edit_view');
			}
		}
		$this->load->view('accounts/student_discount/student_discount_footer_orb');
	}
	public function add(){
		$this->load->model('sis/fif_student_info_model');
		$StudentInfo = $this->fif_student_info_model->getStudentInfo($this->input->post('gs_id'));

		$Percentage=0;
		$Amount=0;
		$Aug = 0;
		$Sep = 0;
		$Oct = 0;
		$Nov = 0;
		$Dec = 0;
		$Jan = 0;
		$Feb = 0;
		$Mar = 0;
		$Apr = 0;
		$May = 0;
		$Jun = 0;
		$Jul = 0;

		$StudentID = $StudentInfo[0]['id'];
		$AcademicSessionID = $StudentInfo[0]['academic_session_id'];
		//$AcademicSessionID = 10;
		
		$ConcessionTypeID = $this->input->post('concession_type');
		if($this->input->post('aug')!="") {$Aug = $this->input->post('aug');}
		if($this->input->post('sep')!="") {$Sep = $this->input->post('sep');}
		if($this->input->post('oct')!="") {$Oct = $this->input->post('oct');}
		if($this->input->post('nov')!="") {$Nov = $this->input->post('nov');}
		if($this->input->post('dec')!="") {$Dec = $this->input->post('dec');}
		if($this->input->post('jan')!="") {$Jan = $this->input->post('jan');}
		if($this->input->post('feb')!="") {$Feb = $this->input->post('feb');}
		if($this->input->post('mar')!="") {$Mar = $this->input->post('mar');}
		if($this->input->post('apr')!="") {$Apr = $this->input->post('apr');}
		if($this->input->post('may')!="") {$Jun = $this->input->post('jun');}
		if($this->input->post('jun')!="") {$May = $this->input->post('may');}
		if($this->input->post('jul')!="") {$Jul = $this->input->post('jul');}
		

		if($this->input->post('concession_type')!=9){
			$Percentage = max($Aug, $Sep, $Oct, $Nov, $Dec, $Jan, $Feb, $Mar, $Apr, $May, $Jun, $Jul);
		}else{
			$Amount = max($Aug, $Sep, $Oct, $Nov, $Dec, $Jan, $Feb, $Mar, $Apr, $May, $Jun, $Jul);
		}
		$isActive = 1;

		$data = array(
				'student_id' => $StudentID,
				'concession_type_id' => $ConcessionTypeID,
				'description'=> 'Concession Set',
				'percentage' => $Percentage,
				'amount' => $Amount,
				'is_active' => $isActive,
				'active_from' => date("Y-m-d"),
				'aug' => $Aug,
				'sep' => $Sep,
				'oct' => $Oct,
				'nov' => $Nov,
				'dec' => $Dec,
				'jan' => $Jan,
				'feb' => $Feb,
				'mar' => $Mar,
				'apr' => $Apr,
				'may' => $May,
				'jun' => $Jun,
				'jul' => $Jul,
				'academic_session_id' => $AcademicSessionID
			);

		$this->load->model('accounts/fee_bill/Fee_bill_student_discount_model');
		$new_discount = (int)$this->Fee_bill_student_discount_model->save($data);
		

		$this->redirect['url'] = base_url() . 'index.php/accounts/fee_bill_student_discount_new';
		$this->redirect['wait'] = '3';
		$this->redirect['msg_l1'] = $this->input->post('gs_id');
		$this->redirect['msg_l2'] = 'Discount Added';
		$this->load->view('global/redirect_page_view');
		$this->load->view('accounts/student_discount/student_discount_footer_orb');
	}


	public $validation_gsid = array(
		array('field' => 'gs_id', 'label' => 'GS-ID', 'rules' => 'trim|sanitize|callback_verifyGSID')
	);
	


	function verifyGSID($str)
	{
	   $field_value = $str;	   
	   $this->load->model('sis/fif_student_info_model');

	   if($this->input->post('gs_id') == "" || $this->fif_student_info_model->checkGSID_from_ClassList($str) == false)
	   {
	     return FALSE;
	   }
	   else
	   {
	     return TRUE;
	   }
	}



	function canEditDiscount_of_GSID($str){
		$this->load->model('accounts/fee_bill/Fee_bill_student_discount_model');
		if($this->Fee_bill_student_discount_model->already_discount($str) == false){
				return FALSE;
		}else{
			return TRUE;
		}
	}
}