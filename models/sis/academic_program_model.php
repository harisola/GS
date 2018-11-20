<?php
class Academic_program_model extends CI_Model{

	private $db_staff_role;

	function __construct()
	{
		parent::__construct();
		$this->db_staff_role = $this->load->database('role',TRUE);
	}


	protected $_table_name = 'academic_program';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'id asc, order asc';	
	protected $_timestamps = TRUE;


	public function getProgramDetail()
	{
		$query=$this->db->query("select
			ap.id, ap.grade_id, ap.subject_id, ap.order, ap.academic_session_id,
			gg.dname as grade_name, ass.name as academic_session_name, asb.dname as subject_name
			from atif_role.academic_program ap
			left join atif._grade gg on gg.id = ap.grade_id
			left join atif_role.academic_subject asb on asb.id = ap.subject_id
			left join atif._academic_session ass on ass.id = ap.academic_session_id");
		$rows_array = $query->result_array();		
				
        return $rows_array;        
	}
	

	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_staff_role->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_staff_role->where('record_deleted', 0);
		if(!count($this->db_staff_role->ar_orderby)){
			$this->db_staff_role->order_by($this->_order_by);
		}
		return $this->db_staff_role->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_staff_role->where($where);
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
			$this->db_staff_role->set($data);
			$this->db_staff_role->insert($this->_table_name);
			$id = $this->db_staff_role->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_staff_role->set($data);
			$this->db_staff_role->where($this->_primary_key, $id);
			$this->db_staff_role->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_staff_role->where($this->_primary_key, $id);
		$this->db_staff_role->limit(1);
		$this->db_staff_role->delete($this->_table_name);
	}
}