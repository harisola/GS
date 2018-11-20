<?php
class Vehicle_registration_model extends CI_Model{

	private $db_attendance_staff;

	function __construct()
	{
		parent::__construct();
		$this->db_attendance_staff = $this->load->database('attendance_vehicle',TRUE);
	}


	protected $_table_name = 'vehicle_today_in';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'gv_id asc';	
	protected $_timestamps = TRUE;	



    public function gettable()
		{
			$query = $this->db_attendance_staff->get('vehicle_today_in');
			return $query->result();
		}
		
		 public function getprevious()
		{
		$query=$this->db_attendance_staff->query("SELECT * FROM vehicle_staff_atd_in_out Where date = curdate()-1 order by employee_id asc, in_out desc;");
		   return $query->result();	
			/*$query = $this->db_attendance_staff->get('');
			return $query->result();*/
		}
	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_attendance_staff->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_attendance_staff->where('record_deleted', 0);
		if(!count($this->db_attendance_staff->ar_orderby)){
			$this->db_attendance_staff->order_by($this->_order_by);
		}
		return $this->db_attendance_staff->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_attendance_staff->where($where);
		return $this->get(NULL, $single);
	}

	public function save($data, $id = NULL){

		// Set timestamps
		if($this->_timestamps == TRUE){
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = human_to_unix($now);
			$data['modified'] = human_to_unix($now);
			$data['modified_by'] = (int)$this->session->userdata['user_id'];
		}

		// Insert a new record
		if ($id === NULL){
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db_attendance_staff->set($data);
			$this->db_attendance_staff->insert($this->_table_name);
			$id = $this->db_attendance_staff->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_attendance_staff->set($data);
			$this->db_attendance_staff->where($this->_primary_key, $id);
			$this->db_attendance_staff->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_attendance_staff->where($this->_primary_key, $id);
		$this->db_attendance_staff->limit(1);
		$this->db_attendance_staff->delete($this->_table_name);
	}
	public function getAllbrand()
	{
		$query=$this->vehicle_registered->query("SELECT  id,name FROM vehicle_brand GROUP BY name");
		$rows_array = $query->result_array();		
				
        return $rows_array;        
	}
	public function getAllmake()
	{
		$query=$this->vehicle_registered->query("SELECT id,name FROM vehicle_make GROUP BY name");
		$rows_array = $query->result_array();		
				
        return $rows_array;        
	}
	public function getAllregistered()
	{
		$this->vehicle_registered = $this->load->database('default',TRUE);
		$query=$this->vehicle_registered->query("SELECT id,name FROM vehicle_registered_type GROUP BY name");
		$rows_array = $query->result_array();		
				
        return $rows_array;        
	}
	public function getAllcolor()
	{
		$this->vehicle_registered = $this->load->database('default',TRUE);
		$query=$this->vehicle_registered->query("SELECT id,name FROM vehicle_color GROUP BY name");
		$rows_array = $query->result_array();		
				
        return $rows_array;        
	}
	public function getAllcapacity()
	{
		$this->vehicle_registered = $this->load->database('default',TRUE);
		$query=$this->vehicle_registered->query("SELECT id,name FROM vehicle_capacity GROUP BY name");
		$rows_array = $query->result_array();		
				
        return $rows_array;        
	}
	function fetch_league() {
		$this->vehicle_registered = $this->load->database('default',TRUE);
	 $return = array();
	 $this->vehicle_registered->from('vehicle_brand');
	 $this->vehicle_registered->order_by('name');
	 $result = $this->vehicle_registered->get();
	 $return[0] = 'Select brand';
	 if($result->num_rows() > 0) {
	 foreach($result->result_array() as $row) {
	 $return[$row['id']] = $row['name'];
	 }
	 }
	 return $return;
	 }
	 
	 function fetch_team($id){
		$this->vehicle_registered = $this->load->database('default',TRUE);
		 $return = array();
		 $this->vehicle_registered->from('vehicle_make');
		 $this->vehicle_registered->where('brand_id', $id);
		 $this->vehicle_registered->order_by('name');
		 $result = $this->vehicle_registered->get();
	 if($result->num_rows() > 0) {
	 $return = $result->result();
	 }
	 return $return;
	 }
	 function gettablevehicle()
	{
		$this->vehicle_registered = $this->load->database('default',TRUE);
		
		//$this->vehicle_registered->where('register_type =', 2);
		$this->vehicle_registered->where('is_active =', 1);
		
		$query = $this->vehicle_registered->get('vehicle_registered');
		return $query->result();
	}
	function getStaff(){
		
		$this->vehicle_registered = $this->load->database('default',TRUE);
		$query = "select id,employee_id, name_code from staff_registered where is_active = 1 and is_posted = 1";
		$query=$this->vehicle_registered->query($query);
		$rows_array = $query->result_array();		
		return $rows_array;
		
		
	}
}