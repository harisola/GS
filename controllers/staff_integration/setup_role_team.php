<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Setup_role_team extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}


	public function index()		
	{
		$this->load->model('staff_integration/role_team_model');

		$this->form_validation->set_rules($this->validation);

		if($this->form_validation->run() == FALSE){
			
		}else{
			$this->add();
		}

		$this->data['role_team'] = $this->role_team_model->get();
		$this->load->view('staff_integration/role_team_view.php');
		$this->load->view('staff_integration/role_domain_orb_footer.php');
	}


	public $validation = array(
		array('field' => 'team_name', 'label' => 'Team Name', 'rules' => 'trim|sanitize|required|min_length[3]|max_length[50]|is_unique[role_team.name]'),
		array('field' => 'team_dname', 'label' => 'Team Display Name', 'rules' => 'trim|sanitize|required|min_length[3]|max_length[50]')
	);




	public function add()
	{
		if(count($_POST))
		{
			$this->load->model('staff_integration/role_team_model');
			$teamID = $this->role_team_model->generateRoleTeamID();

			$data = array(
				'name' => ucwords(strtolower($this->input->post('team_name'))),
				'dname' => ucwords(strtolower($this->input->post('team_dname'))),
				'gm_id' => $teamID
			);

			$new_domain = (int)$this->role_team_model->save($data);
		}

		redirect('/staff_integration/setup_role_team', 'refresh');
	}


	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    

	    
		$table_data = array(
			$name => $value
		);

		$this->load->model('staff_integration/role_team_model');
	    if(!empty($value)) {	        
	        $id = $this->role_team_model->save($table_data, $pk);
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}
}