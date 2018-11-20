<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Netcarver\Textile;

class Branch extends MY_Controller {

	public function __construct(){
		parent::__construct();		
		$this->load->model('organization/users_in_branch_model');
		$this->load->model('organization/branch_model');
		
		// Getting all the user groups		
		$this->data['branch_id'] = $this->users_in_branch_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
		$this->data['branch'] = $this->branch_model->get_by(array('id' => (int)$this->data['branch_id'][0]->branch_id));
	}

	public function index()
	{		
		// load users interface						
		$this->load->view('organization/branch/branch_user_access_orb', $this->data['branch']);
		$this->load->view('menus/menu_orb_footer');	
	}

	public function edit()
	{
		if(count($_POST))
		{			
			/**
			 * Edit branch information from POST values
			**/						

			$this->form_validation->set_rules($this->branch_model->validation);

			if($this->form_validation->run() == TRUE)
			{	
				$data = array(
					'name' => $this->input->post('branch_name'),
					'dwebname' => $this->input->post('branch_web_name'),
					'dmailname' => $this->input->post('branch_mail_name'),
					'demailname' => $this->input->post('branch_email_name'),
					'short_name' => $this->input->post('branch_short_name'),
					'address' => $this->input->post('branch_address'),
					'country' => $this->input->post('branch_country'),
					'telephone_no' => $this->input->post('branch_telephone_no'),
					'mobile_no' => $this->input->post('branch_mobile_no'),
					'email' => $this->input->post('branch_email'),
					'website' => $this->input->post('branch_website'),
					'currency_symbol' => $this->input->post('branch_currency_symbol'),
					'currency_no_of_decimal_places' => $this->input->post('branch_currency_no_of_decimal_places'),
					'currency_show_symbol_suffix_to_amount' => $this->input->post('branch_currency_show_symbol_suffix_to_amount'),
					'currency_symbol_for_decimal_portion' => $this->input->post('branch_currency_symbol_for_decimal_portion'),
					'currency_show_in_million' => $this->input->post('branch_currency_show_in_million'),
					'currency_put_space_amount_symbol' => $this->input->post('branch_currency_put_space_amount_symbol'),
					'currency_decimal_places_for_printing' => $this->input->post('branch_currency_decimal_places_for_printing')
				);
				$id = (int)$this->branch_model->save($data, (int)$this->data['branch_id'][0]->branch_id);
				redirect('organization/branch');
			}else{
				redirect('organization/branch');				
			}
		}else{
	        redirect('organization/branch');
    	}
	}
}