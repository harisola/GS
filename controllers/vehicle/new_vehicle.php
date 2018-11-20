<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class New_vehicle extends MY_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->model('vehicle/vehicle_registration_model');
		$this->attendance['staff'] = array($this->vehicle_registration_model->get());
	}

	
	public function index()
	{
		$this->data['registered'] = $this->vehicle_registration_model->getAllregistered();
		$this->data['brand'] = $this->vehicle_registration_model->getAllbrand();
		$this->data['make'] = $this->vehicle_registration_model->getAllmake();
		$this->data['color'] = $this->vehicle_registration_model->getAllcolor();	
		$this->data['capacity'] = $this->vehicle_registration_model->getAllcapacity();
		$data["league"] = $this->vehicle_registration_model->fetch_league();	
		$data["staffData"] = $this->vehicle_registration_model->getStaff();	
		$this->load->view('vehicle/staff_add_vehicle_view', $data);
		$this->load->view('vehicle/vehicle_registration_footer_orb');
		$this->load->helper("url");
	    $this->load->library("pagination");
		
	}

	
	function add()
	{
		//Create array for get data From index
		//form varable then table col name
	 $this->db_atif = $this->load->database('default',TRUE);
	 $data = array(
	 			   'register_type' =>$this->input->post('registered'),
				   'gv_id' =>$this->input->post('gvid'),
					'name_code' =>$this->input->post('namecode'),
					'registration_no' =>$this->input->post('regno'),
					'brand_id' =>$this->input->post('league'),
					'make_id' =>$this->input->post('team'),
					'color_id' =>$this->input->post('colour'),
					//'capacity' =>$this->input->post('capacity'),
					'rfid_dec_no' =>$this->input->post('rfdec'),
					'rfid_hex_no' =>$this->input->post('rfhex'),
					'is_active' =>$this->input->post('active'),
					'inactive_date' =>$this->input->post('activedate')
					
					);
				//print_r ($data);
					//exit();
		// mean that insert into database table name tblstudent	
		$this->db_atif->insert('vehicle_registered',$data);

		
		// mean that when insert already it will go to page index
		redirect("vehicle/new_Vehicle");
	}


	public function buildTeam()
    {
         //set selected country id from POST
      echo  $id = $this->input->post('id',TRUE);

        //run the query for the cities we specified earlier
        $rows =$this->vehicle_registration_model->fetch_team($id);
        
       $output = '<option value="">Select make</option>';
        foreach ($rows as $row)
        {
            //here we build a dropdown item line for each query result
            $output .= "<option value='".$row->id."'>".$row->name."</option>";
        }

        echo $output;
    }



    function printForm()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    

	    
		$table_data = array(
			$name => $value
		);

		//var_dump($table_data);
		/*
		Check submitted value
		*/
	    if(!empty($value)) {	    	
	    	$this->load->model('vehicle/vehicle_register_model');
	        $id = $this->vehicle_register_model->save($table_data, $pk);	        	        
	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }	    
	}
}