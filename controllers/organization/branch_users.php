<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Netcarver\Textile;

class Branch_users extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('organization/branch_users_model');
		$this->load->model('organization/users_in_branch_model');
		$this->load->model('organization/branch_model');
		$this->load->model('organization/users_model');
	}

	public function index()
	{
		// Getting all the user groups
		$this->branch_data['branch_users'] = $this->branch_users_model->get();
		$this->branch_data['users_in_branch'] = $this->users_in_branch_model->get();
		$this->branch_data['branch'] = $this->branch_model->get();
		$this->branch_data['users'] = $this->users_model->get();

		// load users interface				
		$this->load->view('organization/branch_users/branch_users_add_orb', $this->branch_data);
		$this->load->view('organization/branch_users/branch_users_view_orb', $this->branch_data);
		$this->load->view('menus/menu_orb_footer');	
	}

	public function add()
	{
		if(count($_POST))
		{			
			/**
			 * Insert user and branch to branch_user
			**/			
			$data = array(
				'register_by' => (int)$this->session->userdata('user_id'),
				'user_id' => (int)($this->input->post('users')),
				'branch_id' => $this->input->post('branch')				
			);
			
			$id = (int)$this->branch_users_model->save($data);			
			redirect('organization/branch_users');
		}
	}

	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    
    	/*
	     Check submitted value
	    */
	    $table_data = array(
	    	$name => (int)$value
    	);

    	var_dump($table_aata);

	    if(!empty($value)) {	        
	        $id = $this->branch_users_model->save($table_data, $pk);	        
	        //print_r($_POST);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}
}