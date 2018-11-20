<?php
class Holiday_parameter_ajax extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	protected $Holiday_Title;
	protected $Holiday_Short_Title;
	protected $Holiday_Des;
	protected $ID;
	
	public function Set_Variables()	{
		
		$this->Holiday_Title 		= $this->input->post("Holiday_Parameter");
		$this->Holiday_Short_Title 	= $this->input->post("Holiday_Short_Title");
		$this->Holiday_Des 			= $this->input->post("Holiday_Description");
		$OpType 					= $this->input->post("OpType");
		$this->ID 				 	= $this->input->post("Holiday_ID");
		
		if( (int)$OpType == 1 ){
			$last_inserted_id = $this->Save_Holiday();
		}else{
			$last_inserted_id =$this->Update_Holiday();
		}
		
		$return = array( "ID"=>$last_inserted_id,"Title"=>$this->Holiday_Title, "Short"=>$this->Holiday_Short_Title,"OpType"=>$OpType );
		echo json_encode($return);
		
	}
	
	function Save_Holiday(){
		
		$this->load->model("master_calendar/master_calender","MC");
		$table="event_category";
		$data = array(
			"Type"=>"Holiday",
			"cat_name"=>$this->Holiday_Title,
			"cat_short_title"=>$this->Holiday_Short_Title,
			"cat_description"=>$this->Holiday_Des,
			"cat_status"=>1,
			"created"=>time(),
			"register_by"=>$this->session->userdata("user_id")
		);
		$last_inserted_id = $this->MC->set($table, $data);
		return $last_inserted_id;
	}
	
	// insert into database event
	public function Update_Holiday(){
		$this->load->model("master_calendar/master_calender","MC");
		$table="event_category";
		$data = array(
			"cat_name"=>$this->Holiday_Title,
			"cat_short_title"=>$this->Holiday_Short_Title,
			"cat_description"=>$this->Holiday_Des,
			"modified"=>time(),
			"modified_by"=>$this->session->userdata("user_id")
		);
		$table="event_category";
		$where = array("ID"=>$this->ID);
		$this->MC->table_update($table,$data,$where);
		return $this->ID;
	}
	
	function Get_Holiday_Record(){
		$this->load->model("master_calendar/master_calender","MC");
		$Row_ID = $this->input->post("Row_ID");
		$Type 	= $this->input->post("Type");
		$return = $this->MC->Get_Event_Category($Row_ID,$Type);
		echo json_encode($return);
	}

}