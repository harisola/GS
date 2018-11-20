<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Setup_role_type extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}


	public function index()		
	{
		$this->load->model('staff_integration/role_type_model');

		$this->form_validation->set_rules($this->validation);

		if($this->form_validation->run() == FALSE){
			
		}else{
			$this->add();
		}

		$this->data['role_type'] = $this->role_type_model->get();
		$this->load->view('staff_integration/role_type_view.php');
		$this->load->view('staff_integration/role_domain_orb_footer.php');
	}


	public $validation = array(
		array('field' => 'role_name', 'label' => 'Role Name', 'rules' => 'trim|sanitize|required|min_length[3]|max_length[50]|is_unique[role_type.name]'),
		array('field' => 'role_dname', 'label' => 'Role Display Name', 'rules' => 'trim|sanitize|required|min_length[3]|max_length[50]'),
		array('field' => 'role_code', 'label' => 'Role Code', 'rules' => 'trim|sanitize|required|min_length[1]|max_length[1]')
	);




	public function add()
	{
		if(count($_POST))
		{
			$this->load->model('staff_integration/role_type_model');

			$data = array(
				'name' => ucwords(strtolower($this->input->post('role_name'))),
				'dname' => ucwords(strtolower($this->input->post('role_dname'))),
				'code' => strtoupper($this->input->post('role_code'))
			);

			$new_domain = (int)$this->role_type_model->save($data);
		}

		redirect('/staff_integration/setup_role_type', 'refresh');
	}


	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    

	    
		$table_data = array(
			$name => $value
		);

		$this->load->model('staff_integration/role_type_model');
	    if(!empty($value)) {	        
	        $id = $this->role_type_model->save($table_data, $pk);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}
}