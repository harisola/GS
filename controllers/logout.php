<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends CI_Controller {
	public function index(){

		/*********************************************************************************************
		*****
		**********************************************************************************************/
		$this->load->model('users_logout_model');

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
		$id = $this->users_logout_model->save($data);
		/*********************************************************************************************
		**************************************************************************************** E N D
		**********************************************************************************************/

		$this->ion_auth->logout();
		$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('welcome', 'refresh');
	}
}