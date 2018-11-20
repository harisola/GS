<?php
class Academic extends MY_Controller
{
	function  __construct()
	{
		parent::__construct();
		
	}

	 public function  index()
	{
		
		$where = array(
			'is_active'=> 1,
			);

		//Academic Session
		$this->load->model('assestment/academic_model2');
		// $term_name['academic1'] = $this->academic_model->get_by($where);
		$term_name['academic1'] = $this->academic_model2->get_academic();
	
		//Term Name
		$this->load->model('assestment/getid_term_academic');
		$term_name['query1'] = $this->getid_term_academic->name_select_term('assessment_term');

		//Get View Of a Table
		$date_view['view'] = $this->getid_term_academic->getview();


		// if($this->input->post())
		// {

		//   $check=$this->validate();
		//   if($check  == true)
		//   {
		//   	$this->add();
		//   }

		//   unset($_POST);
		  
		// }
		


	

		$this->load->view('assestment/academic_header',$term_name);
		$this->load->view('assestment/academic_view',$date_view);
		$this->load->view('assestment/academic_footer');
    }
		
		
		

	public function add()
	{
		if(count($_POST))
		{


			$AssessmentTermID = $this->input->post('assessment_term_id');
			$AcademicSessionID = $this->input->post('assessment_session_id');
			$DateFrom = $this->input->post('date_from');
			$DateTo = $this->input->post('date_to');
						
			$data = array(
				'assessment_term_id' => $AssessmentTermID,
				'academic_session_id' => $AcademicSessionID,
				'date_from' => $DateFrom,
				'date_to' => $DateTo,
				);


			$this->getid_term_academic->save($data);
		}
	}


	public function validate()
	{
		if($this->input->post() != null && !empty($this->input->post()))
		{
			$this->form_validation->set_rules('assessment_session_id', 'Academic Name', 'required|santized');
			$this->form_validation->set_rules('assessment_term_id','Term Name','required|santized');
			$this->form_validation->set_rules('date_from','Date From','required|alpha_dash|santized');
			$this->form_validation->set_rules('date_to','Date To','required|alpha-dash|santized');

			
		}
		if($this->form_validation->run() == False)
		{
			return False;	
		}
		else
		{
			return True;
		}


	}
	

	
}