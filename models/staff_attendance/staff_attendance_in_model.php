<?php
class Staff_attendance_in_model extends CI_Model{

	private $db_staff_attendance;

	function __construct()
	{
		parent::__construct();
		$this->db_staff_attendance = $this->load->database('attendance_staff',TRUE);
	}


	protected $_table_name = 'staff_attendance_in';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'date desc';	
	protected $_timestamps = TRUE;
	

	public function getStaffAttendanceData($RFID)
	{

		/*
		$cQuery = "select
		sr.id as staff_id, title.title as salutation, sr.abridged_name as name, sr.gt_id as gen_id, sr.employee_id as photo_id, sr.gender, REPLACE(sr.mobile_phone, '-', '') as mobile_phone,
		IF(t.tmp_card_no > 0, 1, 0) as marked, '' as dap_color, '' as dap_code,
		IFNULL(min(i.time), '') as time_in_th, IFNULL(min(atd.time), '') as time_in_atd
		from atif.staff_registered as sr
		left join atif._title_person as title
			on title.id = sr.title_person_id
		left join atif_attendance_staff.tmpcard_staff_used as t
			on t.staff_id = sr.id
			and t.date = curdate()
		left join atif_attendance_staff.staff_attendance_in as i
			on i.staff_id = sr.id
			and i.date = curdate()
			and (i.location_id = 1 Or i.location_id = 2 Or i.location_id = 5 Or i.location_id = 6 Or i.location_id = 7 Or i.location_id = 8 Or i.location_id = 16)
		left join atif_attendance_staff.staff_attendance_in as atd
			on atd.staff_id = sr.id
			and atd.date = curdate()
			and (atd.location_id = 3 Or atd.location_id = 4)
			where sr.rfid_dec = '".$RFID."'";
		*/


		$cQuery = "select * from
		(select
				sr.id as staff_id, title.title as salutation, sr.abridged_name as name, sr.gt_id as gen_id, sr.employee_id as photo_id, sr.gender, REPLACE(sr.mobile_phone, '-', '') as mobile_phone,
				IF(t.tmp_card_no > 0, 1, 0) as marked, '' as dap_color, '' as dap_code,
				IFNULL(min(i.time), '') as time_in_th, IFNULL(min(atd.time), '') as time_in_atd
				from atif.staff_registered as sr
				left join atif._title_person as title
					on title.id = sr.title_person_id
				left join atif_attendance_staff.tmpcard_staff_used as t
					on t.staff_id = sr.id
					and t.date = curdate()
				left join atif_attendance_staff.staff_attendance_in as i
					on i.staff_id = sr.id
					and i.date = curdate()
					and (i.location_id = 1 Or i.location_id = 2 Or i.location_id = 5 Or i.location_id = 6 Or i.location_id = 7 Or i.location_id = 8 Or i.location_id = 16)
				left join atif_attendance_staff.staff_attendance_in as atd
					on atd.staff_id = sr.id
					and atd.date = curdate()
					and (atd.location_id = 3 Or atd.location_id = 4)

			where sr.rfid_dec = '".$RFID."'

		UNION

		select
		sr.id as staff_id, title.title as salutation, sr.abridged_name as name, sr.gt_id as gen_id, sr.employee_id as photo_id, sr.gender, REPLACE(sr.mobile_phone, '-', '') as mobile_phone,
				IF(t.tmp_card_no > 0, 1, 0) as marked, '' as dap_color, '' as dap_code,
				IFNULL(min(i.time), '') as time_in_th, IFNULL(min(atd.time), '') as time_in_atd

		from atif_attendance_staff.tmpcard_staff_used as tmp

		left join atif._tmp_rfid_cards as cd
			on cd.card_no = tmp.tmp_card_no
		left join atif.staff_registered as sr
			on sr.id = tmp.staff_id
				left join atif._title_person as title
					on title.id = sr.title_person_id
				left join atif_attendance_staff.tmpcard_staff_used as t
					on t.staff_id = sr.id
					and t.date = curdate()
				left join atif_attendance_staff.staff_attendance_in as i
					on i.staff_id = sr.id
					and i.date = curdate()
					and (i.location_id = 1 Or i.location_id = 2 Or i.location_id = 5 Or i.location_id = 6 Or i.location_id = 7 Or i.location_id = 8 Or i.location_id = 16)
				left join atif_attendance_staff.staff_attendance_in as atd
					on atd.staff_id = sr.id
					and atd.date = curdate()
					and (atd.location_id = 3 Or atd.location_id = 4)

		where tmp.date = curdate()
		and cd.rfid_dec = '".$RFID."') AS DATA
		where staff_id is not null";
		
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();

   		return $row;
	}


	
	public function checkIsLastIN($StaffID)
	{
		$result = false;

		$cQuery = "select * from
			(select * from
				(select
				i.staff_id, i.date, i.time as time, 'I' as atd
				from atif_attendance_staff.staff_attendance_in as i
				where i.staff_id = ".$StaffID."
				and i.date = curdate()
				and i.location_id = 3
				order by i.id desc
				limit 1) as i
			
			UNION
			
			select * from
				(select
				o.staff_id, o.date, o.time as time, 'O' as atd
				from atif_attendance_staff.staff_attendance_out as o
				where o.staff_id = ".$StaffID."
				and o.date = curdate()
				and o.location_id = 3
				order by o.id desc
				limit 1) as o) 
			AS DATA
		ORDER BY DATA.time desc
		LIMIT 1";



		
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();
   		if(!empty($row)){
	   		if($row[0]['atd'] == 'O'){
	   			$result = false;
	   		}else{
	   			$result = true;
	   		}
	   	}

   		return $result;
	}




	public function makeSMSPool($mobilePhone, $message){
		$data = array( 
			'mobile_phone' => $mobilePhone, 
			'message' => $message);
		$this->db->insert('atif_sms.sms_pool', $data);
	}





	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_staff_attendance->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_staff_attendance->where('record_deleted', 0);
		if(!count($this->db_staff_attendance->ar_orderby)){
			$this->db_staff_attendance->order_by($this->_order_by);
		}
		return $this->db_staff_attendance->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_staff_attendance->where($where);
		return $this->get(NULL, $single);
	}

	public function save($data, $id = NULL){

		// Set timestamps
		if($this->_timestamps == TRUE){
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = human_to_unix($now);
			$id || $data['register_by'] = 1;
			$data['modified'] = human_to_unix($now);
			$data['modified_by'] = 1;
		}

		// Insert a new record
		if ($id === NULL){
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db_staff_attendance->set($data);
			$this->db_staff_attendance->insert($this->_table_name);
			$id = $this->db_staff_attendance->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_staff_attendance->set($data);
			$this->db_staff_attendance->where($this->_primary_key, $id);
			$this->db_staff_attendance->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_staff_attendance->where($this->_primary_key, $id);
		$this->db_staff_attendance->limit(1);
		$this->db_staff_attendance->delete($this->_table_name);
	}
}