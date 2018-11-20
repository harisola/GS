<?php
class Career_form_emp_model extends CI_Model{

	private $db_career_emp;

	function __construct()
	{
		parent::__construct();
		$this->db_career_emp = $this->load->database('career',TRUE);
	}


	protected $_table_name = 'career_employment';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'year_from desc';	
	protected $_timestamps = TRUE;	


	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_career_emp->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_career_emp->where('record_deleted', 0);
		if(!count($this->db_career_emp->ar_orderby)){
			$this->db_career_emp->order_by($this->_order_by);
		}
		return $this->db_career_emp->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_career_emp->where($where);
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
			$this->db_career_emp->set($data);
			$this->db_career_emp->insert($this->_table_name);
			$id = $this->db_career_emp->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_career_emp->set($data);
			$this->db_career_emp->where($this->_primary_key, $id);
			$this->db_career_emp->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_career_emp->where($this->_primary_key, $id);
		$this->db_career_emp->limit(1);
		$this->db_career_emp->delete($this->_table_name);
	}
}