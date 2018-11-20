<?php
class Getpost extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
	}

	public function create()
	{
			
			$this->load->model('etab/academic/assessment_term');
			$assest_name = $this->input->post('assest_name');
			$display = $this->input->post('display');
			$ncode = $this->input->post('assest_ncode');

			$this->form_validation->set_rules('assest_name','Assessment Name','required|is_unique[assessment_term.name]');
			$this->form_validation->set_rules('display','Display Name','required');
			$this->form_validation->set_rules('assest_ncode','Name Code','required|is_unique[assessment_term.sname]|alpha');

			if($this->form_validation->run() == False){
				echo validation_errors();
			}else{
				
				$name = $this->input->post('assest_name');
				$dname = $this->input->post('display');
				$ncode = $this->input->post('assest_ncode');

				$data= array(
					'name' => $name,
					'dname' => $dname,
					'sname' => $ncode,
					'created'=> time(),
					'register_by'=>$this->session->userdata('user_id'),
					'modified' => time(),
					'modified_by' => $this->session->userdata('user_id')
				);

				$success = $this->assessment_term->term_insert($data);
				if($success){
					echo $success;
				}
				
			}


		
		
	}

	public function getid()
	{
		$this->load->model('etab/academic/assessment_term');
		$ID = $this->uri->segment(4);
		$tablename = 'assessment_term';
		$where = array('id'=>$ID);
		$data['row'] = $this->assessment_term->fetch($tablename,$where);
		$this->load->view('assestment/assestment_term2',$data);
				

	}

	public function create_academic()
	{
			
			$session = $this->input->post('assessment_session_id');
			$term = $this->input->post('assessment_term_id');
			$date_from = $this->input->post('date_from');
			$date_to = $this->input->post('date_to');

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
				$session = $this->input->post('assessment_session_id');
				$term = $this->input->post('assessment_term_id');
				$date_from = $this->input->post('date_from');
				$date_to = $this->input->post('date_to');

				$data = array(
					'assessment_term_id' => $term,
					'academic_session_id'=> $session,
					'date_from' => $date_from,
					'date_to'=> $date_to,
					'created'=> time(),
					'register_by'=>$this->session->userdata('user_id'),
					'modified' => time(),
					'modified_by' => $this->session->userdata('user_id')
				);

				$this->load->model('etab/academic/academic_model','getid_term_academic');
				$success = $this->getid_term_academic->save($data);
				echo $success;
			}
	}

	public function getacademic()
	{
		$this->load->model('etab/academic/academic_model','getid_term_academic');
		$data['view'] = $this->getid_term_academic->getview();
		$this->load->view('etab/academic/assestment/academic_view2',$data);	
	}

	public function edit_academic()
	{
		$this->load->model('etab/academic/academic_model','getid_term_academic');
		$id = $this->uri->segment(4);
		$tablename = 'assessment_term_academic_session';
		$where = array(
			'is_active'=> 1,
			);

		//Term Name
		$term_name['query1'] = $this->getid_term_academic->name_select_term('assessment_term');


		//$this->load->model('assestment/getid_term_academic');

		$term_name['query'] = $this->getid_term_academic->fetch($tablename,$id);
		$term_name['value'] = $this->getid_term_academic->get_same_data($tablename,$id);

		
		


		//Academic Session
		$this->load->model('assestment/academic_model');
		$term_name['academic1'] = $this->academic_model->get_by($where);




		
	
		

		$this->load->view('assestment/academic_header2',$term_name);
	}

	public function getdelete()
	{

		$ID = $this->uri->segment(4);
		$tablename = 'assessment_term';
		$where = array('id'=>$ID);
		$this->load->model('etab/academic/assessment_term');
		$status_delete = $this->assessment_term->getDelete($tablename,$where);

		//$data['check'] = $this->assessment_term->fetch('assessment_term_academic_session',$where);
			$data['query']=$this->assessment_term->select($tablename);
			$this->load->view('assestment/assestment_table2',$data);
	}

	public function get_academic_delete()
	{
		$id = $this->uri->segment(4);
		$tablename = 'assessment_term_academic_session';
		$where = array('id'=>$id);

		$this->load->model('assestment/getid_term_academic');
		$this->getid_term_academic->getdelete($tablename,$where);

		$this->getid_term_academic->name_select_term($tablename);

		$data['view'] =$this->getid_term_academic->getview();

		$this->load->view('assestment/academic_view2',$data);

	}

}



?>