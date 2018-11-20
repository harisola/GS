<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Profile_view extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');

		$this->load->database();

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
					
	}


	public function index()
	{
		$this->form_validation->set_rules('old_password', 'Old Password', 'required');
		$this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_password_confirm]');
		$this->form_validation->set_rules('new_password_confirm', 'Confirm Password', 'required');

		
		if($this->form_validation->run() == FALSE){			
			
		}else{
			$identity = $this->session->userdata('identity');
			$change = $this->ion_auth->change_password($identity, $this->input->post('old_password'), $this->input->post('new_password'));			
		}
				
		$this->load->view('user/user_profile_view');
		$this->load->view('menus/menu_orb_footer');
	}
}