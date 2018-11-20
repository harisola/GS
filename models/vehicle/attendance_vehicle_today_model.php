<?php
class Attendance_vehicle_today_model extends CI_Model{

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



	public function gettable($DateFrom, $DateTo)
	{
		if($DateFrom != "" || $DateTo != "") {		
			$thisQuery = "select `vehicle_info_atd_in`.`vehicle_id` AS `vehicle_id`,`atif`.`staff_registered`.`abridged_name` AS `abridged_name`,
			`vehicle_info_atd_in`.`date` AS `date`,`vehicle_info_atd_in`.`time` AS `time`,
			`vehicle_info_atd_in`.`registration_no` AS `registration_no`,`vehicle_info_atd_in`.`gv_id` AS `gv_id`,
			`atif`.`staff_vehicle`.`name_code` AS `name_code`,`vehicle_info_atd_in`.`record_deleted` AS `record_deleted`
			from `atif_attendance_vehicle`.`vehicle_info_atd_in`
			left join `atif`.`staff_vehicle` on `vehicle_info_atd_in`.`gv_id` = `atif`.`staff_vehicle`.`gv_id`
			left join `atif`.`staff_registered` on `atif`.`staff_registered`.`employee_id` = `atif`.`staff_vehicle`.`employee_id`
			where (`vehicle_info_atd_in`.`date` >= '$DateFrom' and `vehicle_info_atd_in`.`date` <= '$DateTo')";
			
			$query=$this->db_attendance_staff->query($thisQuery);
	   		return $query->result();			
		}else{
			$query = $this->db_attendance_staff->get('vehicle_today_in');
			
			return $query->result();
		}
		

		//$result = $this->db_attendance_staff->get();
		
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
}