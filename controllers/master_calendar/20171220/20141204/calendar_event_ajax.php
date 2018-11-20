<?php
class Calendar_event_ajax extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	
	protected $Cat_name='';
	protected $Cat_Status='';
	protected $Cat_Short_Title='';
	protected $Cat_Color='';
	protected $Cat_Des='';
	protected $Op='';
	protected $Cat_Event_ID=0;
	
	
	public function Html_For_Updation(){
		$this->Cat_Event_ID = $this->input->post("Cat_Event_Id");
		$this->load->model("master_calendar/master_calender","MC");
		$return = $this->MC->get_cat_event( $this->Cat_Event_ID );
		$data = array(
		"Cat_Id"=>$this->Cat_Event_ID,
		"cat_name"=>$return['cat_name'],
		"cat_short_title"=>$return["cat_short_title"],
		"cat_description"=>$return["cat_description"],
		"cat_status"=>$return["cat_status"],
		"cat_color"=>$return["cat_color"]
		);
		echo json_encode($data);
		
	}
	
	
	public function Category_Management(){
		// Set Variable through posts method
		$this->Cat_name 		= $this->input->post("Cat_name");
		$this->Cat_Status 		= $this->input->post("Cat_Status");
		$this->Cat_Short_Title  = $this->input->post("Cat_Short_Title");
		$this->Cat_Color 		= $this->input->post("Cat_Color");
		$this->Cat_Des 			= $this->input->post("Cat_Des");
		$this->Op 				= (int)$this->input->post("Op");
		$this->Cat_Event_ID 	= $this->input->post("Cat_Event_Id");
		if( $this->Op == 1){
			// Insert Into Database
			$last_inserted_id = $this->Db_Insert();
		}else{
			// Update Into Database
			$last_inserted_id = $this->Db_Update();
		}
		$re = array("ID"=>$last_inserted_id);
		echo json_encode($re);
	}
	
	// insert into database event
	public function Db_Insert(){
		$this->load->model("master_calendar/master_calender","MC");
		$table="event_category";
		$data = array(
		"Type"=>"Event",
		"cat_name"=>$this->Cat_name,
		"cat_short_title"=>$this->Cat_Short_Title,
		"cat_description"=>$this->Cat_Des,
		"cat_status"=>$this->Cat_Status,
		"cat_color"=>$this->Cat_Color,
		"created"=>time(),
		"register_by"=>$this->session->userdata("user_id")
		);
		$last_inserted_id = $this->MC->set($table, $data);
		return $last_inserted_id;
	}
	
		// insert into database event
	public function Db_Update(){
		$this->load->model("master_calendar/master_calender","MC");
		$table="event_category";
		$data = array(
		"cat_name"=>$this->Cat_name,
		"cat_short_title"=>$this->Cat_Short_Title,
		"cat_description"=>$this->Cat_Des,
		"cat_status"=>$this->Cat_Status,
		"cat_color"=>$this->Cat_Color,
		"modified"=>time(),
		"modified_by"=>$this->session->userdata("user_id")
		);
		
		$table="event_category";
		$where = array("ID"=>$this->Cat_Event_ID);
		$this->MC->table_update($table,$data,$where);
		
		return $this->Cat_Event_ID;
	}
	
	
}