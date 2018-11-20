<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Setup_domain extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}


	public function index()		
	{
		$this->load->model('staff_integration/role_domain_model');

		$this->form_validation->set_rules($this->validation);

		if($this->form_validation->run() == FALSE){
			
		}else{
			$this->add();
		}

		$this->data['role_domain'] = $this->role_domain_model->get();
		$this->load->view('staff_integration/role_domain_view.php');
		$this->load->view('staff_integration/role_domain_orb_footer.php');
	}


	public $validation = array(
		array('field' => 'domain_name', 'label' => 'Domain Name', 'rules' => 'trim|sanitize|required|min_length[3]|max_length[50]|is_unique[role_domain.name]'),
		array('field' => 'domain_dname', 'label' => 'Domain Display Name', 'rules' => 'trim|sanitize|required|min_length[3]|max_length[50]'),
		array('field' => 'domain_code', 'label' => 'Domain Code', 'rules' => 'trim|sanitize|required|min_length[2]|max_length[2]|is_unique[role_domain.code]')
	);




	public function add()
	{
		if(count($_POST))
		{
			$this->load->model('staff_integration/role_domain_model');

			$data = array(
				'name' => ucwords(strtolower($this->input->post('domain_name'))),
				'dname' => ucwords(strtolower($this->input->post('domain_dname'))),
				'code' => strtoupper($this->input->post('domain_code'))
			);

			$new_domain = (int)$this->role_domain_model->save($data);
		}

		redirect('/staff_integration/setup_domain', 'refresh');
	}


	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    

	    
		$table_data = array(
			$name => $value
		);

		$this->load->model('staff_integration/role_domain_model');
	    if(!empty($value)) {	        
	        $id = $this->role_domain_model->save($table_data, $pk);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}
}