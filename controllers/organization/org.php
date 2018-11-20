<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Netcarver\Textile;

class Org extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('organization/organization_model');		
	}

	public function index()
	{
		// Getting all the user groups
		$this->data['org'] = $this->organization_model->get_by(array('id' => 1));
		// load users interface				
		$this->load->view('organization/org_detail/organization_orb', $this->data['org']);
		$this->load->view('menus/menu_orb_footer');	
	}

	public function edit()
	{
		if(count($_POST))
		{			
			/**
			 * Edit organization information from POST values
			**/						
			$this->form_validation->set_rules($this->organization_model->validation);

			if($this->form_validation->run() == TRUE)
			{	
				$data = array(
					'name' => $this->input->post('org_name'),
					'dwebname' => $this->input->post('org_web_name'),
					'dmailname' => $this->input->post('org_mail_name'),
					'demailname' => $this->input->post('org_email_name'),
					'address' => $this->input->post('org_address'),
					'country' => $this->input->post('org_country'),
					'telephone_no' => $this->input->post('org_telephone_no'),
					'mobile_no' => $this->input->post('org_mobile_no'),
					'email' => $this->input->post('org_email'),
					'website' => $this->input->post('org_website'),
					'currency_symbol' => $this->input->post('org_currency_symbol'),
					'currency_no_of_decimal_places' => $this->input->post('org_currency_no_of_decimal_places'),
					'currency_show_symbol_suffix_to_amount' => $this->input->post('org_currency_show_symbol_suffix_to_amount'),
					'currency_symbol_for_decimal_portion' => $this->input->post('org_currency_symbol_for_decimal_portion'),
					'currency_show_in_million' => $this->input->post('org_currency_show_in_million'),
					'currency_put_space_amount_symbol' => $this->input->post('org_currency_put_space_amount_symbol'),
					'currency_decimal_places_for_printing' => $this->input->post('org_currency_decimal_places_for_printing')
				);
				$id = (int)$this->organization_model->save($data, 1);			
				redirect('organization/org');
			}else{
				redirect('organization/org');				
			}
		}else{
	        redirect('organization/org');
    	}
	}
}