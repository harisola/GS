<?php
class Attendance_staff_today_model extends CI_Model{

	private $db_attendance_staff;

	function __construct()
	{
		parent::__construct();
		$this->db_attendance_staff = $this->load->database('attendance_staff',TRUE);
	}


	protected $_table_name = 'staff_atd_report_1';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'gt_id asc';	
	protected $_timestamps = TRUE;	




	public function getStaffAttendance_Missed(){		
		$query =
		"SELECT * FROM
			(select 
			sr.id, sr.employee_id, sr.gt_id, sr.abridged_name as name,
			sr.c_topline, sr.c_bottomline, branch.short_name as branch_name, sr.staff_type,
			sr.department, sr.designation,
			Threshold.location_id as T_location, 
			StaffATD.location_id as S_location,
			IF(Threshold.location_id != '' and StaffATD.location_id is null, 'No', 'Yes') AS `time`,
			sr.id as staff_id, sr.gender, sr.record_deleted

			from `atif`.`staff_registered` as sr
			 
			left join (SELECT * from
			(select
			stin.staff_id, stin.time, stin.location_id
			from atif_attendance_staff.staff_attendance_in as stin
			where (stin.location_id != 3 and stin.location_id != 8)
			and stin.date = curdate()
			order by stin.staff_id) AS DATA
			group by staff_id) as Threshold on Threshold.staff_id = sr.id

			left join (SELECT * from
			(select
			stin.staff_id, stin.time, stin.location_id
			from atif_attendance_staff.staff_attendance_in as stin
			where (stin.location_id = 3 or stin.location_id = 8)
			and stin.date = curdate()
			order by stin.staff_id) AS DATA
			group by staff_id) as StaffATD on StaffATD.staff_id = sr.id

			left join `atif`.`_branch` as  `branch` on `branch`.`id` = sr.`branch_id`
			 
			where (sr.`is_active` = 1) group by sr.`gt_id`) AS DATA
		WHERE time = 'No'
		and branch_name != 'North'";
			

		$sql = $this->db_attendance_staff->query($query);
		return $sql->result();
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