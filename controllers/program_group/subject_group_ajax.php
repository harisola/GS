<?php

class subject_group_ajax extends CI_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->model('program_group/subject_group_model','sjm');
	}

	public function load_form()
	{
		$this->load->view('program_group/subject_group_form');
	}
	public function create()
	{
		if(!empty($this->input->post()))
		{	
			
			$this->form_validation->set_rules('group_name','Group Name','required|max_length[9]|is_unique[subject_selection_group.name]');
			$this->form_validation->set_rules('group_dname','Group displayName','required|max_length[9]');
			$this->form_validation->set_rules('group_sname','Group shortName','required|max_length[9]');
			$this->form_validation->set_rules('group_cname','Group codeName','required|max_length[3]|is_unique[subject_selection_group.code]');
			$this->form_validation->set_rules('group_pname','Group Postion','required|integer');
			if($this->form_validation->run() == False)
			{
				echo validation_errors();
			}
			else
			{	
				
				$name = $this->input->post('group_name');
				$dname = $this->input->post('group_dname');
				$sname = $this->input->post('group_sname');
				$code = $this->input->post('group_cname');
				$position = $this->input->post('group_pname');

				$data = array(
					'name' => $name,
					'dname' => $dname,
					'sname' => $sname,
					'code' => $code,
					'position' => $position,
					'created' => time(),
					'register_by' => $this->session->userdata('user_id'),
					'modified' => time(),
					'modified_by' => $this->session->userdata('user_id')

				);

				$this->load->model('program_group/subject_group_model','sjm');
				$this->sjm->save('subject_selection_group',$data);

				echo 1;
			}	

		}
	}

	public function table_create()
	{



		//MOdel Load for Selecting data from Table

		$this->load->model('program_group/subject_group_model','sjm');
		$data['table_data']= $this->sjm->get_by('subject_selection_group');

		//MOdel Load for Selecting data from Table

		$this->load->view('program_group/table_insert',$data);
	}

	public function load_form_edit()
	{
		$id = $this->uri->segment(4);
		$select = '';
		
		$where = array(
			'id' => $id
		);

		$data['edit_data']=$this->sjm->get_by('subject_selection_group',$select,$where);
		$this->load->view('program_group/subject_group_form_update',$data);

	}

	public function get_update()
	{
		if(!empty($this->input->post()))
		{
			$group_id = $this->input->post('group_id');
			$group_name = $this->input->post('group_name');
			$group_dname = $this->input->post('group_dname');
			$group_sname = $this->input->post('group_sname');
			$group_cname = $this->input->post('group_cname');
			$group_pname = $this->input->post('group_pname');

			$where = array(
				'id' => $group_id
			);
			$select = 'name,code';

			$data['unique'] = $this->sjm->get_by('subject_selection_group',$select,$where);

			$name = $data['unique'][0]->name;
			$code = $data['unique'][0]->code;


			if($group_name == $name)
			{
				$is_unique_group = "";

			}
			else if($group_name != $name)
			{
				$is_unique_group = "|is_unique[subject_selection_group.name]";

			}

			if($group_cname == $code)
			{
				$is_unique_code = '';
			}
			else if($group_cname != $code)
			{
				$is_unique_code = "|is_unique[subject_selection_group.code]";
			}


			$this->form_validation->set_rules('group_name','Group Name','required|max_length[9]'.$is_unique_group);
			$this->form_validation->set_rules('group_cname','Group codeName','required|max_length[3]'.$is_unique_code);
			
			$this->form_validation->set_rules('group_dname','Group displayName','required|max_length[9]');
			$this->form_validation->set_rules('group_sname','Group shortName','required|max_length[9]');

			$this->form_validation->set_rules('group_pname','Group Postion','required|integer');

			if($this->form_validation->run() == False)
			{
				echo validation_errors();
			}
			else
			{
				$where = array(
					'id' => $group_id
				);

				$data = array(
					'name' => $group_name,
					'dname' => $group_dname,
					'sname' => $group_sname,
					'code' => $group_cname,
					'position' => $group_pname,
					'created' => time(),
					'register_by' => $this->session->userdata('user_id'),
					'modified' => time(),
					'modified_by' => $this->session->userdata('user_id')
				);

				 $this->sjm->get_updated_by('subject_selection_group',$where,$data);
				 echo 1;

			}

		}


		

	}
}