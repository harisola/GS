<?php 
class Sg_ajax extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function section(){
		
		if(!empty($this->input->post('grade_id'))){
			echo $grade_id = $this->input->post('grade_id');
		//	$where = array( 'grade_id' => $grade_id );
			//$this->load->model('autocomplete/grade_section/atif_grade');
			//$data['section']=$this->atif_grade->getsection('class_list',$where);
			//$data['grade_id'] = $grade_id;
			//print_r( $data );
			//$this->load->view('etab/assForGrades/grade_section/get_section',$data);
						
		}else{
			return 0;
		}
		
	}

	public function subject()
	{	
		$section_id = $this->input->post('section_id');
		if(!empty($section_id[1]))
		{
			$grade_id = $section_id[1];
			$where = array(
				'grade_id' => $grade_id
			);
			$this->load->model('autocomplete/grade_section/atif_role_subject','ars');
			$data['subject']=$this->ars->get_grade_subject($where);
			$data['section_id'] = $section_id[0];
			$data['grade_id'] = $section_id[1];
			$this->load->view('etab/assForGrades/grade_section/get_subject',$data);
		}
	}

	public function teacher()
	{

		$subject_id = $this->input->post('subject_id');
		$tablename = 'role_in_org_view';
		$grade_id =  $subject_id[2];
		$section_id = $subject_id[1];
		$subject_id = $subject_id[0];

		$where = array(
			'grade_id' => $grade_id,
			'section_id' => $section_id,
			'subject_id' => $subject_id,
		);

		$this->load->model('autocomplete/grade_section/atif_role_subject');
		$data['teacher']=$this->atif_role_subject->get_teacher_subject($tablename,$where);
		$this->load->view('etab/assForGrades/grade_section/get_teacher',$data);

	}

	

	
}

?>