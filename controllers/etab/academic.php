<?php
class Academic extends MY_Controller{
	function  __construct(){ parent::__construct(); }
	
	public function  index(){
		$where = array( 'is_active'=> 1 );
		$this->load->model('etab/academic/academic_model','AM');
		if( $this->AM->get() ){
			$term_name['academic1'] = $this->AM->get();
		}else{
			$term_name['academic1'] = NULL;
		} 
		if( $this->AM->name_select_term('assessment_term') ){
		$term_name['query1'] = $this->AM->name_select_term('assessment_term');	
		}else{
			$term_name['query1'] = NULL;
		}
		if( $this->AM->getview() ){
			$date_view['view'] = $this->AM->getview();
		}else{
			$date_view['view'] = NULL;
		}
		
		
		//var_dump( $term_name );
		//var_dump( $date_view );
		//exit;
		$this->load->view('etab/academic/assestment/academic_header',$term_name);
		$this->load->view('etab/academic/assestment/academic_view',$date_view);
		$this->load->view('etab/academic/assestment/academic_footer');
	}
	
	/*public function add(){
		if(count($_POST)){
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
	*/

	
}