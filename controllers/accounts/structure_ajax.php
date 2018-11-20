<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Structure_ajax extends CI_Controller {

	public function __construct()
	{ 
		parent::__construct();
		$this->load->library('session');
	}

	public function CheckStartDate()
	{
		$this->load->model('accounts/fee_bill/fb_structure/index', 'FBS');
		$Start_Date = $this->input->get('Start_Date');
		return $this->FBS->CheckStartDate($Start_Date);
	}



	public function CheckEndDate()
	{
		$this->load->model('accounts/fee_bill/fb_structure/index', 'FBS');
		$End_Date = $this->input->get('End_Date');
		return $this->FBS->CheckEndDate($End_Date);
	}


	public function add_Session()
	{
		$this->load->model('accounts/fee_bill/fb_structure/index', 'FBS');

		$Session_Name = $this->input->post('Session_Name');
		$Display_Name = $this->input->post('Display_Name');
		$Start_Date   = $this->input->post('Start_Date');
		$End_Date     = $this->input->post('End_Date');

		$Start_Date = date('Y-m-d',strtotime(  $Start_Date  ) );
		$End_Date = date('Y-m-d', strtotime(  $End_Date  ) );


		$NC_Display_Name = 'NC_'.$Session_Name;
		$SC_Display_Name = 'SC_'.$Session_Name;
		$Created_Date    = time();
		$Modified_Date   = time();
		$Register_by     = $this->session->userdata("user_id");
		
		$Add = 0;

		$getSession = $this->FBS->getSession();
		if( !empty( $getSession ) )
		{
			foreach ($getSession as $value) 
			{
			 if( ( $value["start_date"] >  $Start_Date ) || ( $value["end_date"] >  $End_Date ))
				{
					$Add = 1;
				}
			}
	  }

	  if( $Start_Date > $End_Date )
	  {
	  	$Add = 1;
	  }

	

		$Array_North = array(
			'branch_id' => 1,
			'name' => $NC_Display_Name,
			'dname' => $Display_Name,
			'start_date'=>$Start_Date,
			'end_date' =>$End_Date,
			'is_lock' => 0,
			'is_active' => 1,
			'created' => $Created_Date,
			'register_by' => $Register_by,
			'modified' => $Modified_Date,
			'modified_by' => $Register_by
		);


		$Array_South = array(
			'branch_id' => 2,
			'name' => $SC_Display_Name,
			'dname' => $Display_Name,
			'start_date'=>$Start_Date,
			'end_date' =>$End_Date,
			'is_lock' => 0,
			'is_active' => 1,
			'created' => $Created_Date,
			'register_by' => $Register_by,
			'modified' => $Modified_Date,
			'modified_by' => $Register_by
		);


		$Last_id_South=0;	
		if( $Add == 0 )
		{
			$this->FBS->Update_function();
			$Last_id_North = $this->FBS->form_insert( $Array_North  );
			$Last_id_South = $this->FBS->form_insert( $Array_South  );
		}
		
		echo $Last_id_South;	
}



		public function Get_Post_Data()
		{
			$this->load->model('accounts/fee_bill/fb_structure/index', 'FBS');
			$Hidden_Definition_id = $this->input->post('Hidden_Definition_id');
			$affected_rows = 0;

			$Created_Date    = time();
			$Modified_Date   = time();
			$Register_by     = $this->session->userdata("user_id");


			if(!empty($Hidden_Definition_id))
			{
				foreach ($Hidden_Definition_id as $value) 
				{
					
					$tuition_fee = $this->input->post( $value.'_tuition_fee');
					$resource_fee = $this->input->post($value.'_resource_fee');
					$musakhar = $this->input->post($value.'_musakhar');
					$lab_avc = $this->input->post($value.'_lab_avc');
					$yearly = $this->input->post($value.'_yearly');


					$Array_Data = array(
						"tuition_fee" => $tuition_fee,
						"resource_fee" => $resource_fee,
						"musakhar" => $musakhar,
						"lab_avc" => $lab_avc,
						"yearly" => $yearly,
						'created' => $Created_Date,
						'register_by' => $Register_by,
						'modified' => $Modified_Date,
						'modified_by' => $Register_by
					);
					$affected_rows = $this->FBS->Update_Fee_Definition($Array_Data, $value);
				}
			}

			//echo $affected_rows;
			$S_url = base_url(). 'index.php/accounts/fee_bill_fee_structure';

			redirect($S_url, 'refresh');  


		}




}	
