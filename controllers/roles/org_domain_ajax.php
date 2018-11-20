<?php 

class Org_domain_ajax extends CI_Controller{

	public function __construct(){
		parent::__construct();
		
	}

	public function insert_org_domain(){

		// var_dump($this->input->post());
			
			if(!empty($this->input->post())){

			$this->load->model('roles/org_domain_model','ODM');

			$name = $this->input->post('name');
			$dname = $this->input->post('dname');
			$sname = $this->input->post('sname');
			$code = $this->input->post('code');
			$position = $this->input->post('position');
			$hex_color = $this->input->post('color');


			$this->form_validation->set_rules('name','Name For','required|is_unique[role_domain.name]');
			$this->form_validation->set_rules('dname','Display Name','required');
			$this->form_validation->set_rules('sname','Short Name','required|is_unique[role_domain.sname]');
			$this->form_validation->set_rules('code','Code','required|max_length[3]|is_unique[role_domain.code]');
			$this->form_validation->set_rules('color','Color','required');
			$this->form_validation->set_rules('position','Position','required');

			if($this->form_validation->run() == FALSE){
				
				echo validation_errors();
			}
			else{

				$data = array(
					'name' => $name,
					'dname'=> $dname,
					'sname' => $sname,
					'code' => $code,
					'color_hex' => $hex_color,
					'position' => $position,
					'created' => time(),
					'register_by' => $this->session->userdata('user_id'),
					'modified' => time(),
					'modified_by'=> $this->session->userdata('user_id')
				);

				$row = $this->ODM->insert_data('role_domain',$data);
				echo $row;

			}
		}	

		
	}

	public function getLastId(){

		$this->load->model('roles/org_domain_model','ODM');
		$where = null;
		$select = 'id';
		$check = $this->ODM->get_by('role_domain',$where,$select);
		echo count($check);
		exit;
	}

	public function edit()
	{
		$this->load->model('roles/org_domain_model','ODM');
		// var_dump($this->input->post());
		$field_name = $this->input->post('name');
		$value = $this->input->post('value');
		$id = $this->input->post('pk');

		if($field_name == 'name' || $field_name == 'sname' || $field_name == 'code'){

			$where_value = array(
				$field_name => $value
			);

			$row = $this->ODM->get_by('role_domain',$where_value);
			if(!empty($row)){
				echo "<p>The  field must have unique value</p>";
			}
			else{
				$where  = array(
					'id' => $id
				);
				$data = array(
					$field_name => $value,
					'modified' => time(),
					'modified_by' => $this->session->userdata('user_id')
				);

				$this->ODM->save('role_domain',$data,$where);
				echo 1;
			}
			
		}
		else{

			$where  = array(
				'id' => $id
			);
			$data = array(
				$field_name => $value,
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			);

			if(!empty($value)){
				$this->ODM->save('role_domain',$data,$where);
				echo 1;
			}
			else{
				echo 0;
			}

		}



	}

}	

