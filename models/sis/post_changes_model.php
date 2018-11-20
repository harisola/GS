<?php
class Post_changes_model extends CI_Model{

	private $db_atif;

	function __construct()
	{
		parent::__construct();
		$this->db_atif = $this->load->database('default',TRUE);
	}



	public function getAcademicSessionData($AcademicSessionFrom, $AcademicSessionTo)
	{
		$cQuery = "SELECT
			sar.id, sar.student_id, sar.previous_class, sar.grade_id, sar.section_id, sar.house_id, sar.status_id, sar.student_status_id, 
			sar.status_change_comments, sar.section_change_comments, sar.house_change_comments,
			sr.gr_no, sr.gs_id, sr.abridged_name, sr.gender,
			gg.name as grade_name, ss.name as section_name, hh.name as house_name, sst.name as student_status,
			ssn.code as status_code
			FROM student_academic_record sar
			left join _grade gg on gg.id = sar.grade_id
			left join _section ss on ss.id = sar.section_id
			left join _house hh on hh.id = sar.house_id
			left join _student_status sst on sst.id = sar.status_id
			left join student_registered sr on sr.id = sar.student_id
			left join _studentstatus ssn on ssn.id = sar.student_status_id
			where sar.academic_session_id >= " . $AcademicSessionFrom . " and sar.academic_session_id <= " . $AcademicSessionTo . " 
			and sr.record_deleted = 0";
		
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();

   		//print_r($cQuery);
   		return $row;
	}


	public function getSectionList()
	{
		$cQuery = "SELECT * from _section";		
		
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();
   		
   		return $row;
	}

	public function getHouseList()
	{
		$cQuery = "SELECT * from _house";		
		
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();
   		
   		return $row;
	}

	public function getStudentStatusList()
	{
		$cQuery = "SELECT * from _student_status";		
		
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();
   		
   		return $row;
	}



	public function getStudentStatusList2016()
	{
		$cQuery = "SELECT * from _studentstatus";		
		
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();
   		
   		return $row;
	}


	protected $_table_name = 'student_academic_record';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'grade_id asc';	
	protected $_timestamps = TRUE;
	

	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_atif->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_atif->where('record_deleted', 0);
		if(!count($this->db_atif->ar_orderby)){
			$this->db_atif->order_by($this->_order_by);
		}
		return $this->db_atif->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_atif->where($where);
		return $this->get(NULL, $single);
	}

	public function save($data, $id = NULL){

		// Set timestamps
		if($this->_timestamps == TRUE){
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = human_to_unix($now);
			$id || $data['register_by'] = (int)$this->session->userdata['user_id'];
			$data['modified'] = human_to_unix($now);
			$data['modified_by'] = (int)$this->session->userdata['user_id'];
		}

		// Insert a new record
		if ($id === NULL){
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db_atif->set($data);
			$this->db_atif->insert($this->_table_name);
			$id = $this->db_atif->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_atif->set($data);
			$this->db_atif->where($this->_primary_key, $id);
			$this->db_atif->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_atif->where($this->_primary_key, $id);
		$this->db_atif->limit(1);
		$this->db_atif->delete($this->_table_name);
	}
}