<?php 

class Getview extends CI_Controller{

	public function __construct()
	{
		
		parent::__construct();
		$this->load->model('assestment/assessment_term' ,'AT');
	}

	public function index()
	{
		//$this->load->view('assestment/check');
		$data['query']=$this->AT->select('assessment_term');
		$this->load->view('assestment/assestment_table2',$data);

	}

	public function getupdate()
	{
			$tablename = 'assessment_term';
			$id = $this->input->post('id');

			$where_select = array(
				'id' => $id
			);

			$data['unique'] = $this->AT->fetch($tablename,$where_select);

			$term_name = $data['unique'][0]['name'];
			$term_sname = $data['unique'][0]['sname'];


		    $assest_name = $this->input->post('assest_name');
			$display = $this->input->post('display');
			$ncode = $this->input->post('assest_ncode');

			if($term_name != $assest_name)
			{

				$is_unique = '|is_unique[assessment_term.name]';
				
			}
			else
			{

				$is_unique = '';
			}

			if($term_sname != $ncode)
			{
				$is_unique = '|is_unique[assessment_term.sname]';
			}
			else
			{
				$is_unique='';
			}
			

			$this->form_validation->set_rules('assest_name','Assessment Name','required'.$is_unique);
			$this->form_validation->set_rules('display','Display Name','required');
			$this->form_validation->set_rules('assest_ncode','Name Code','required|alpha'.$is_unique);

			

			if($this->form_validation->run() == False)
			{
				
				echo 0;				 
			}
			else
			{
				$tablename = 'assessment_term';
				$name = $this->input->post('assest_name');
				$dname = $this->input->post('display');
				$ncode = $this->input->post('assest_ncode');

				$data= array(
					'name' => $name,
					'dname' => $dname,
					'sname' => $ncode
				);

				$where =  array(
					'id' => $id
				);

				$success = $this->AT->getupdated($tablename,$where,$data);
				$data['query'] = $this->AT->select($tablename);
			    $this->load->view('assestment/assestment_table2',$data);

			}
	}

	public function academic_update()
	{
		$tablename = 'assessment_term_academic_session';
		$id = $this->input->post('id');
		$academic_session = $this->input->post('assessment_session_id');
		$term_name = $this->input->post('assessment_term_id');
		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');
		$active = $this->input->post('is_active');

		$this->form_validation->set_rules('assessment_session_id','Session Name','required');
		$this->form_validation->set_rules('assessment_term_id','Term Name','required');
		$this->form_validation->set_rules('date_from','Date From','required');
		$this->form_validation->set_rules('date_to','Date To','required');

		if($this->form_validation->run() == False)
		{
			echo 0;
		}
		else
		{
			$academic_session = $this->input->post('assessment_session_id');
			$term_name = $this->input->post('assessment_term_id');
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');

			$data = array(
				'academic_session_id' => $academic_session,
				'assessment_term_id' => $term_name,
				'date_from' => $date_from,
				'date_to' => $date_to,
				'is_active' => $active	
			);
			$where = array(
				'id' => $id
			);

			$this->load->model('assestment/getid_term_academic');

			$success = $this->getid_term_academic->getupdated($tablename,$where,$data);

			 $this->getid_term_academic->name_select_term($tablename);

			$data['view'] =$this->getid_term_academic->getview();

			$this->load->view('assestment/academic_view2',$data);
			
		}

	}

	public function mainheader()
	{
		$this->load->view('assestment/assestment_term3');
	}

	public function main_academic_header()
	{

		$where = array(
			'is_active'=> 1,
			);

		//Academic Session
		$this->load->model('assestment/academic_model2');
		$term_name['academic1'] = $this->academic_model2->get_by($where);


		//Term Name
		$this->load->model('assestment/getid_term_academic');
		$term_name['query1'] = $this->getid_term_academic->name_select_term('assessment_term');

		$this->load->view('assestment/academic_header3',$term_name);
	}
	
}

