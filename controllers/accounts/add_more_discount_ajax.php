<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_more_discount_ajax extends CI_Controller {

	public function __construct()
	{ 
		parent::__construct();
	}
	
	
	function HTML_Form()
	{
		$this->load->model('accounts/fee_bill/Fee_bill_student_discount_model');
		$GSID = $this->input->post('gs_id');
		$this->data['student_discount_info'] = $this->Fee_bill_student_discount_model->getStudentInfo($GSID);
		$response = $this->load->view('accounts/student_discount/add_more_dicount','',TRUE);
		$r = array( "h"=> $response );
		echo json_encode($r);
	}
	
	
	public function add(){
		$this->load->model('sis/fif_student_info_model');
		$GSID = $this->input->post('gs_id');
		$student_id = $this->input->post('student_id');
		$StudentInfo = $this->fif_student_info_model->getStudentInfo($GSID);
		$this->AcademicSessionFrom = ( $StudentInfo[0]['academic_session_id'] - 1 ) ;
		$this->AcademicSessionTo   = $StudentInfo[0]['academic_session_id'];
		
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
		$this->data['student_discount_info'] = $this->Fee_bill_student_discount_model->getStudentDiscountInfo($GSID);
		
		$Response_html = $this->load->view('accounts/student_discount/student_discount_edit_view_refresh','',TRUE);
		$array = array("RH"=>$Response_html,"Last_Inserted_ID"=>$new_discount);
		echo json_encode($array);
		
	}
}
?>