<?php
class Vehicle_register_model extends CI_Model{

	private $db_atif_vehicle;

	function __construct()
	{
		parent::__construct();
		$this->db_atif_vehicle = $this->load->database('default',TRUE);
	}


	protected $_table_name = 'vehicle_registered';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'id asc';	
	protected $_timestamps = TRUE;	


	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_atif_vehicle->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}
	}

	public function get_by($where, $single = FALSE){
		$this->db_atif_vehicle->where($where);
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
			$this->db_atif_vehicle->set($data);
			$this->db_atif_vehicle->insert($this->_table_name);
			$id = $this->db_atif_vehicle->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_atif_vehicle->set($data);
			$this->db_atif_vehicle->where($this->_primary_key, $id);
			$this->db_atif_vehicle->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_atif_vehicle->where($this->_primary_key, $id);
		$this->db_atif_vehicle->limit(1);
		$this->db_atif_vehicle->delete($this->_table_name);
	}
}