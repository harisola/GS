<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Academic_subject extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('sis/academic_subject_model');

		$this->form_validation->set_rules($this->validation);

		if($this->form_validation->run() == FALSE){
			
		}else{
			$this->add();
		}
		$this->data['subject'] = $this->academic_subject_model->get();
		$this->SubjectList = $this->academic_subject_model->getSubjectList();
		$this->load->view('sis/academic_subject/academic_subject_view');
		$this->load->view('sis/academic_subject/academic_subject_orb_footer');
	}



	public $validation = array(
		array('field' => 'subject_name', 'label' => 'Subject Name', 'rules' => 'trim|sanitize|required|min_length[3]|max_length[50]|is_unique[academic_subject.name]'),
		array('field' => 'subject_dname', 'label' => 'Subject Display Name', 'rules' => 'trim|sanitize|required|min_length[3]|max_length[50]')		
	);



	public function add()
	{
		if(count($_POST))
		{
			$this->load->model('sis/academic_subject_model');

			$data = array(
				'name' => ucwords(strtolower($this->input->post('subject_name'))),
				'dname' => ucwords(strtolower($this->input->post('subject_dname')))				
			);

			$new_domain = (int)$this->academic_subject_model->save($data);
		}

		redirect('/sis/academic_subject', 'refresh');
	}



	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    

	    
		$table_data = array(
			$name => $value
		);

		$this->load->model('sis/academic_subject_model');
	    if(!empty($value)) {	        
	        $id = $this->academic_subject_model->save($table_data, $pk);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}


	public function edit2()
	{
		if(count($_POST))
		{
			$order = 1;
			$parent_order = 1;
			$academic_subjects = $this->input->post('academic_subjects');
			$academic_subjects = json_decode($academic_subjects);


			$readbleArray = $this->parseJsonArray($academic_subjects);
			$this->updateSubject($readbleArray);			
		}		
		redirect('/sis/academic_subject', 'refresh');
	}


	function parseJsonArray($jsonArray, $parentID = 0) {
	  $return = array();
	  foreach ($jsonArray as $subArray) {
	    $returnSubSubArray = array();
	    if (isset($subArray->children)) {
	  		$returnSubSubArray = $this->parseJsonArray($subArray->children, $subArray->id);
	    }
	    $return[] = array('id' => $subArray->id, 'parentID' => $parentID);
	    $return = array_merge($return, $returnSubSubArray);
	  }
	  return $return;
	}


	private function updateSubject($arrayData)
	{
		$this->load->model('sis/academic_subject_model');
		foreach ($arrayData as $data) {
			$tableData = array(
				'parent_id' => $data['parentID']
			);
			$this->academic_subject_model->save($tableData, $data['id']);
		}		
	}
}