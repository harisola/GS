<?php
class Staff_req_it_model extends CI_Model{

	private $this_loaded_db;

	function __construct()
	{
		parent::__construct();
		$this->this_loaded_db = $this->load->database('default',TRUE);
	}


	protected $_table_name = 'staff_registered_requirements_it';
	protected $_primary_key = 'staff_id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'staff_id desc';	
	protected $_timestamps = TRUE;

	

	public function exists_staff_req_it($StaffID){
		$result = false;
		$query=$this->db->query("SELECT staff_id FROM " . $this->_table_name . " where staff_id = '" . $StaffID . "'");
		
		if ($query->num_rows() > 0) {			
			$result=true;			
		}

		return $result;
	}



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
			$this->_primary_key = 'id';
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