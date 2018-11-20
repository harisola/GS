<?php
class Subject_grade extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$where = array(
			'is_active' => 1,
			//'name' => 'SC_2016-2017'

		);

		//IF We Need  A North We Open That
		//$where_academic_or = 'end_date > Now()';
		$where_academic_or = '';
		$this->load->model('program_group/subject_grade_mymodel','sjmm');
		$data['academic_session']=$this->sjmm->get_by_academic('_academic_session',$where,$where_academic_or);

		



		$this->load->model('program_group/subject_grade_model','sgm');
		$data['subject'] = $this->sgm->get_by('subject');
		//var_dump($data['subject']);
		//exit;
		$this->load->view('program_group/subject_grade_form',$data);
		$this->load->view('program_group/subject_grade_footer');


	}
}