<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Setup_role_reporting extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}


	public function index()		
	{
		$this->load->model('staff_integration/role_reporting_model');

		$this->form_validation->set_rules($this->validation);

		if($this->form_validation->run() == FALSE){
			
		}else{
			$this->add();
		}

		$this->data['role_reporting'] = $this->role_reporting_model->get();
		$this->load->view('staff_integration/role_reporting_view.php');
		$this->load->view('staff_integration/role_domain_orb_footer.php');
	}


	public $validation = array(
		array('field' => 'reporting_name', 'label' => 'Reporting Name', 'rules' => 'trim|sanitize|required|min_length[3]|max_length[50]|is_unique[role_secondary_reporting.name]'),
		array('field' => 'reporting_dname', 'label' => 'Reporting Display Name', 'rules' => 'trim|sanitize|required|min_length[3]|max_length[50]')
	);




	public function add()
	{
		if(count($_POST))
		{
			$this->load->model('staff_integration/role_reporting_model');

			$data = array(
				'name' => ucwords(strtolower($this->input->post('reporting_name'))),
				'dname' => ucwords(strtolower($this->input->post('reporting_dname'))),
				'description' => $this->input->post('reporting_description')
			);

			$new_domain = (int)$this->role_reporting_model->save($data);
		}

		redirect('/staff_integration/setup_role_reporting', 'refresh');
	}


	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    

	    
		$table_data = array(
			$name => $value
		);

		$this->load->model('staff_integration/role_reporting_model');
	    if(!empty($value)) {	        
	        $id = $this->role_reporting_model->save($table_data, $pk);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}
}