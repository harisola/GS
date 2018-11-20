<?php
class Role_domain_model extends CI_Model{

	private $db_staff_integration;

	function __construct()
	{
		parent::__construct();
		$this->db_staff_integration = $this->load->database('role',TRUE);
	}


	protected $_table_name = 'role_domain';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'order asc';	
	protected $_timestamps = TRUE;
	

	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_staff_integration->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_staff_integration->where('record_deleted', 0);
		if(!count($this->db_staff_integration->ar_orderby)){
			$this->db_staff_integration->order_by($this->_order_by);
		}
		return $this->db_staff_integration->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_staff_integration->where($where);
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
			$this->db_staff_integration->set($data);
			$this->db_staff_integration->insert($this->_table_name);
			$id = $this->db_staff_integration->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_staff_integration->set($data);
			$this->db_staff_integration->where($this->_primary_key, $id);
			$this->db_staff_integration->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_staff_integration->where($this->_primary_key, $id);
		$this->db_staff_integration->limit(1);
		$this->db_staff_integration->delete($this->_table_name);
	}
}