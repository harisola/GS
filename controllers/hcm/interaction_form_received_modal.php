<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Interaction_form_received_modal extends CI_Controller {
	public function __construct(){
		parent::__construct();
    $this->load->model('hcm/career_form_model');
    $this->load->model('hcm/career_form_uni_model');
    $this->load->model('hcm/career_form_emp_model');
    $this->load->model('hcm/career_form_interactions');
    $this->load->model('hcm/career_form_interaction_centre');
    $this->load->model('hcm/career_form_interaction_grade');
    $this->load->model('hcm/career_form_interaction_tags');
    $this->load->model('hcm/career_form_interaction_send_received');    
	}

	public function index()
	{	
		$this_form_received = $this->input->get(NULL, TRUE);
		if($this_form_received == false)
		{
		}else{
      $form_received_id = $this_form_received['form_send_received_id'];
      

      $form_start = "";
      $form_end = "";
      $btn_Received = "";
      // **********************************************
      // Getting all the information from DB
     
      // **********************************************
      // **********************************************     


      $form_start .= '<form method="post" action="' . site_url() . '/hcm/interaction_centre_review/edit">
        <input type="hidden" name="form_received_id" value="' . $form_received_id . '">';
      $form_end .= '</form>';

      $btn_Received .= '<br><br><br><button type="submit" class="btn btn-warning btn-lg btn-block">Yes! Form Received</button>';


      echo $form_start
      . $btn_Received
      . $form_end;

    }
  }
}