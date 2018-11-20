<?php
class Student_log_comments extends CI_Model{

	private $db_student_log;

	function __construct()
	{
		parent::__construct();
		$this->db_student_log = $this->load->database('student_log',TRUE);
	}


	protected $_table_name = 'log_comments';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'created desc';	
	protected $_timestamps = TRUE;

	
	public function getStudentID($GSID){
		$query=$this->db->query("SELECT id as thisdata FROM atif.class_list WHERE gs_id = '$GSID'"); 
		$row = $query->row_array();
		$thisData = $row['thisdata'];

		return $thisData;	
	}


	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_student_log->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_student_log->where('record_deleted', 0);
		if(!count($this->db_student_log->ar_orderby)){
			$this->db_student_log->order_by($this->_order_by);
		}
		return $this->db_student_log->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_student_log->where($where);
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
			$this->db_student_log->set($data);
			$this->db_student_log->insert($this->_table_name);
			$id = $this->db_student_log->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_student_log->set($data);
			$this->db_student_log->where($this->_primary_key, $id);
			$this->db_student_log->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_student_log->where($this->_primary_key, $id);
		$this->db_student_log->limit(1);
		$this->db_student_log->delete($this->_table_name);
	}
}