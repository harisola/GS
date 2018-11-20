<?php 
class Category_ajax extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_section()
	{
		$grade_id =  $this->input->post('grade_id');
		$where = array(
			'grade_id' => $grade_id
		);

		$this->load->model('category/category_subject');
		$data =  $this->category_subject->subject($where);
		echo json_encode($data);
	}
	public function create()
	{

		
		// For Formative

		if($this->input->post('is_fix_formative')){
			$is_fix_formative = 1;
		}
		else{
			$is_fix_formative = 0;
		}


		//For Summative

		if($this->input->post('is_fix_summative')){
			$is_fix_summative = 1;
		}
		else{
			$is_fix_summative = 0;
		}

		//For Attendance

		if($this->input->post('is_fix_attendance')){
			$is_fix_attendance = 1;
		}
		else{
			$is_fix_attendance = 0;
		}

		//For Stationary

		if($this->input->post('is_fix_stationary')){
			$is_fix_stationary = 1;
		}
		else{
			$is_fix_stationary = 0;
		}

		//For PTM

		if($this->input->post('is_fix_ptm')){
			$is_fix_ptm = 1;
		}
		else{
			$is_fix_ptm = 0;
		}


		$where_grade = array(
			'grade_id' => $this->input->post('grade_id'),
		);

		$this->load->model('category/category_term');
		$result = $this->category_term->category_where_grade('assessment_category_grade',$where_grade);
		if($result == false)
		{	

			//For Formative
			$grade = $this->input->post('grade_id');
			$category_name1 = $this->input->post('formative');
			$category_weight1 = $this->input->post('form_weight');

			$post_form = array(
				'grade_id' => $grade,
				'assessment_category_id' => $category_name1,
				'weightage' => $category_weight1,
				'is_fix' => $is_fix_formative,
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			);

			$this->load->model('category/category_term');
			$this->category_term->data_insert('assessment_category_grade',$post_form);



			//For Summative

			$grade = $this->input->post('grade_id');
			$category_name2 = $this->input->post('summative');
			$category_weight2 = $this->input->post('summ_weight');

			$post_summ = array(
				'grade_id' => $grade,
				'assessment_category_id' => $category_name2,
				'weightage' => $category_weight2,
				'is_fix' => $is_fix_summative,
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			);

			$this->category_term->data_insert('assessment_category_grade',$post_summ);


			//For Attendance

			$grade = $this->input->post('grade_id');
			$category_name3 = $this->input->post('attendance');
			$category_weight3 = $this->input->post('att_weight');

			$post_attend = array(
				'grade_id' => $grade,
				'assessment_category_id' => $category_name3,
				'weightage' => $category_weight3,
				'is_fix' => $is_fix_attendance,
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			);

			$this->category_term->data_insert('assessment_category_grade',$post_attend);

			// For Stationary

			$grade = $this->input->post('grade_id');
			$category_name4 = $this->input->post('stationary');
			$category_weight4 = $this->input->post('stat_weight');

			$post_stat = array(
				'grade_id' => $grade,
				'assessment_category_id' => $category_name4,
				'weightage' => $category_weight4,
				'is_fix' => $is_fix_stationary,
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			);

			$this->category_term->data_insert('assessment_category_grade',$post_stat);

			//For PTM

			$grade = $this->input->post('grade_id');
			$category_name5 = $this->input->post('ptm');
			$category_weight5 = $this->input->post('parent_weight');

			$post_ptm = array(
				'grade_id' => $grade,
				'assessment_category_id' => $category_name5,
				'weightage' => $category_weight5,
				'is_fix' => $is_fix_ptm,
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			);

			$this->category_term->data_insert('assessment_category_grade',$post_ptm);

			$this->load->model('category/category_term');
			$data['category_detail']=$this->category_term->get_table();



			$this->load->view('category/category_table2',$data);
		}
		else
		{	
			$this->load->model('category/category_term');
			$data['category_detail']=$this->category_term->get_table();
			$this->load->view('category/category_table3',$data);

		}



	}

	public function edit()
	{
		$id = $this->uri->segment(4);
		$tablename = 'assessment_category_grade';
		$where  = array(
			'id'=>$id
			);
		
		$this->load->model('category/category_term');
		$data['get_grade_category'] = $this->category_term->category_where('
			assessment_category_grade',$where);

		// var_dump($data['get_grade_category']);
		// exit;
		
		$grade_id = $data['get_grade_category'][0]->grade_id;
		//$is_fix = $data['get_grade_category'][0]->is_fix;

		


		$where_grade = array(
			'grade_id' => $grade_id,
			//'is_fix'=>$is_fix
		);


		$data['select_id'] = $this->category_term->category_where('assessment_category_grade',$where_grade);
		
		// var_dump($data['select_id']);
		// exit;

		$data['select_grade'] = $this->category_term->get_where_table($grade_id);

		// var_dump($data['select_grade']);
		// exit;
		

		//$this->load->view('category/category_header2',$data);
		$this->load->view('category/category_form2',$data);




	}

	public function update()
	{


		$form_record_id = $this->input->post('formative_record_id');
		$summative_record_id =$this->input->post('summative_record_id');
		$attendance_record_id = $this->input->post('attendance_record_id');
		$stationary_record_id = $this->input->post('stationary_record_id');
		$ptm_record_id = $this->input->post( 'ptm_record_id');


			//For Formative
		if($this->input->post('is_fix_formative'))
		{
			$is_fix_formative = 1;
		}	
		else
		{
			$is_fix_formative = 0;
		}

		//For Summative

		if($this->input->post('is_fix_summative'))
		{
			$is_fix_summative = 1;
		}
		else
		{
			$is_fix_summative = 0;
		}

		// For Attendance

		if($this->input->post('is_fix_attendance'))
		{
			$is_fix_attendance = 1;
		}
		else
		{
			$is_fix_attendance = 0;
		}

		//For  Stationary

		if($this->input->post('is_fix_stationary'))
		{
			$is_fix_stationary = 1;
		}
		else
		{
			$is_fix_stationary = 0;
		}

		//For PTM
		


		if($this->input->post('is_fix_ptm'))
		{
			$is_fix_ptm = 1;
		}
		else
		{
			$is_fix_ptm = 0;
		}

		
		if(!empty($this->input->post()))
		{
			$tablename = 'assessment_category_grade';
			$grade_id = $this->input->post('grade_id');

			//For Formative

			$category1 = $this->input->post('formative');
			$form_weight = $this->input->post('form_weight');

			$where = array(
				'grade_id' => $grade_id,
				'assessment_category_id' => $category1,
			);

			$data = array(
				'weightage' => $form_weight,
				'is_fix' => $is_fix_formative
			);

			$this->load->model('category/category_term');
			$this->category_term->get_update($tablename,$data,$where);

			// For Summative
			
			$category2 = $this->input->post('summative');
			$summ_weight = $this->input->post('summ_weight');



			$where_summ = array(
				'grade_id' => $grade_id,
				'assessment_category_id' => $category2

			);

			$data_summ = array(
				'weightage' => $summ_weight,
				'is_fix' =>$is_fix_summative
			);

			$this->category_term->get_update($tablename,$data_summ,$where_summ);

			//For Attendance
			
			$category_att = $this->input->post('attendance');
			$att_weight = $this->input->post('att_weight');

			$where_att = array(
				'grade_id' => $grade_id,
				'assessment_category_id' => $category_att
			);


			$data_att = array(
				'weightage' => $att_weight,
				'is_fix' => $is_fix_attendance
			);

			$this->category_term->get_update($tablename,$data_att,$where_att);


			// For Stationary

			$category_stat = $this->input->post('stationary');
			$stat_weight = $this->input->post('stat_weight');

			$where_stat = array(
				'grade_id' => $grade_id,
				'assessment_category_id' => $category_stat
			);

			$data_stat = array(
				'weightage' => $stat_weight,
				'is_fix' => $is_fix_stationary
			);

			$this->category_term->get_update($tablename,$data_stat,$where_stat);

			//For PTM

			$category_ptm = $this->input->post('ptm');
			$ptm_weight = $this->input->post('parent_weight');

			$where_ptm = array(

				'grade_id' => $grade_id,
				'assessment_category_id' => $category_ptm

				);
			$data_ptm = array(

				'weightage' => $ptm_weight,
				'is_fix' => $is_fix_ptm
			);

			$this->category_term->get_update($tablename,$data_ptm,$where_ptm);

			$data['category_detail']=$this->category_term->get_table();

			$this->load->view('category/category_tableupdate',$data);

		}


	}

	public function get_insert()
	{
		$this->load->model('category/category_grade');
		$data['grade'] = $this->category_grade->get();

		$this->load->model('category/category_term');
		$data['category'] = $this->category_term->term('assessment_category');

		//$this->load->view('category/category_header3',$data);
		$this->load->view('category/category_form3',$data);

	}


}