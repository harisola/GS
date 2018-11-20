<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class New_vehicle_ajax extends CI_Controller {
	 function __construct() {
        parent::__construct();
		
		
    }

	public function add(){
		
	$this->load->database('default',TRUE);
	
	$this->load->library("session");
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');
	
	$actionType = (int)$this->input->post('actionType');
	$updatedID = (int)$this->input->post('updatedID');
	$staffVehicalID = (int)$this->input->post('staffVehicalID');
	$employee_id = (int)$this->input->post('employee_id');
	
	$name_code = '';
	$namecode = $this->input->post('namecode');
	
	$register_type = $this->input->post('registered');
	
	if( $namecode == '' ){
		$name_code = $this->input->post('namecodehidden');	
	}else{
		$name_code = $this->input->post('namecode');
	}
	
	$emp_id =0;
	if( $employee_id == 0 ){
		$emp_id =0;	
	}else{
		$emp_id =$employee_id;
	}

 
 


if( $actionType == 1 && $updatedID == 0 ){
	
	
	$this->form_validation->set_rules('gvid', 'gvid', 'trim|required|is_unique[vehicle_registered.gv_id]');
	$this->form_validation->set_rules('regno', 'regno', 'trim|required|is_unique[vehicle_registered.registration_no]');
	$this->form_validation->set_rules('rfhex', 'rfhex', 'trim|required|is_unique[vehicle_registered.rfid_hex_no]');
if ($this->form_validation->run() == FALSE) {
	 $error =1;
	// $this->form_validation->set_message();
	// validation_errors(); 
 }else{
	 $error =0;
 }	

if( $error == 0){
// Insert new record in two tables	
$data = array(
	'register_type' => $register_type,
	'gv_id' =>$this->input->post('gvid'),
	'name_code' => $name_code,
	'registration_no' =>$this->input->post('regno'),
	'brand_id' =>$this->input->post('league'),
	'make_id' =>$this->input->post('team'),
	'color_id' =>$this->input->post('colour'),
	'rfid_dec_no' =>$this->input->post('rfdec'),
	'rfid_hex_no' =>$this->input->post('rfhex'),
	'is_active' =>$this->input->post('active'),
	'inactive_date' =>$this->input->post('activedate')
);
$insert = $this->db->insert('vehicle_registered', $data);

//"employee_id"=> $this->input->post('name_code2'),

if( $register_type == 1 ){
	$staff = array(
		"employee_id"=> $emp_id,
		"name_code"=>$name_code,
		"gv_id"=>$this->input->post('gvid')
	);

	$this->db->insert('staff_vehicle',$staff);
}

echo 1;
//end Inserted	
}else{ 
echo 0; 
} 
 


}else{
// updated 

	
$data = array(
	'register_type' => $register_type,
	//'gv_id' =>$this->input->post('gvid'),
	'name_code' => $name_code,
	//'registration_no' =>$this->input->post('regno'),
	'brand_id' =>$this->input->post('league'),
	'make_id' =>$this->input->post('team'),
	'color_id' =>$this->input->post('colour'),
	'rfid_dec_no' =>$this->input->post('rfdec'),
	'rfid_hex_no' =>$this->input->post('rfhex'),
	'is_active' =>$this->input->post('active'),
	'inactive_date' =>$this->input->post('activedate'),
	"modified" => time(),
	"modified_by" => $this->session->userdata('user_id')
);
$this->db->where('id', $updatedID);
$this->db->update('vehicle_registered', $data); 

// "gv_id"=>$this->input->post('gvid'),
// "employee_id"=> $this->input->post('name_code2'),

if( $register_type == 1 ){
$staff = array(
	"employee_id"=> $emp_id,
	"name_code"=> $name_code
);
$this->db->where('id', $staffVehicalID);
$this->db->update('staff_vehicle', $staff);
}

echo 1;
	


	
}// end Else of if updated
	
	
	


	
	
	
	}
	
	
	  
		
	  
	public function getLeague(){
		$this->load->model('vehicle/vehicle_ajax_model', 'VR');
		//'id' , 'brand_id', 'name' 
		$league = $this->input->post('league');
		$queryResultant = $this->VR->get( $league );
		//var_dump( $queryResultant );
		$html = "";
		$html  .= "<option value='0' selected>Select</option>";
		if( $queryResultant ){
			foreach( $queryResultant AS $r ){
				$html  .= "<option value=".$r["id"].">".$r["name"]."</option>";
			}
		} else{
			//$html  .= "<option value='0'>No Data Found </option>";
		}
		echo $html;
	}
	
	public function getLeagueById(){
		$this->load->model('vehicle/vehicle_ajax_model', 'VR');
		$league = $this->input->post('league');
		$queryResultant = $this->VR->getById($league);
		echo json_encode( $queryResultant );
	}

	
	
	public function getRightSide(){
		$this->load->model('vehicle/vehicle_registration_model');
		$this->load->view('vehicle/staff_add_vehicle_view2');
	}

}
