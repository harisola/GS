<?php 

class Assessment_category_grade_ajax extends CI_Controller{

	function __construct(){
		parent::__construct();
	}

	public function update(){

		var_dump($this->input->post());

		$this->load->model('category/assessment_category_grade_model','acgm');

		$id = $this->input->post('pk');
		$weightage = $this->input->post('value');

		$data = array(
			'weightage' => $weightage
		);

		$where = array(
			'id' =>  $id
		);

		$row =  $this->acgm->update('assessment_category_grade',$where,$data); 
		echo $row;

	}

	public function insert(){

		var_dump($this->input->post());

		$weightage = (int)$this->input->post('value');
		$grade_id = (int)$this->input->post('grade_id');
		$assessment_category_id = (int) $this->input->post('assessment_category');

		$this->load->model('category/assessment_category_grade_model','acgm');


		//For Formative
		if($assessment_category_id == 1){
			
			$is_fix = 0;
			$data = array(
				'grade_id' => $grade_id,
				'assessment_category_id' => $assessment_category_id,
				'weightage' => $weightage,
				'is_fix' => $is_fix,
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			);

			$row = $this->acgm-> insert_data('assessment_category_grade',$data);
			
			echo $row;

		}


		// For Summative
		if($assessment_category_id == 2){
			$is_fix = 0;
			
			$data = array(

				'grade_id' => $grade_id,
				'assessment_category_id' => $assessment_category_id,
				'weightage' => $weightage,
				'is_fix' => $is_fix,
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			);

			$row = $this->acgm-> insert_data('assessment_category_grade',$data);
			echo $row;

		}


		// For ASP(Attendance)
		if($assessment_category_id == 3){
			
			$is_fix = 1;
			$data = array(

				'grade_id' => $grade_id,
				'assessment_category_id' => $assessment_category_id,
				'weightage' => $weightage,
				'is_fix' => $is_fix,
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			
			);

			$row = $this->acgm-> insert_data('assessment_category_grade',$data);
			echo $row;

		}

		//For ASP(Stationary)

		if($assessment_category_id == 4){
			
			$is_fix = 1;
			$data = array(

				'grade_id' => $grade_id,
				'assessment_category_id' => $assessment_category_id,
				'weightage' => $weightage,
				'is_fix' => $is_fix,
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			
			);

			$row = $this->acgm-> insert_data('assessment_category_grade',$data);
			echo $row;

		}

		// For ASP(PTM)

		if($assessment_category_id == 5){
			
			$is_fix = 1;
			$data = array(

				'grade_id' => $grade_id,
				'assessment_category_id' => $assessment_category_id,
				'weightage' => $weightage,
				'is_fix' => $is_fix,
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			
			);

			$row = $this->acgm-> insert_data('assessment_category_grade',$data);
			echo $row;

		}




	}
}

?>