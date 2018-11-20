<?php
class Rfid_model extends CI_Model{

	private $db_students;

	function __construct()
	{
		parent::__construct();
		$this->db_students = $this->load->database('default',TRUE);
	}

	protected $_table_name = 'student_registered';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'time_in desc';	
	protected $_timestamps = TRUE;

	public function get_Alumni_n_ParentsCard_Data($RFIDDec)
	{
		$query=$this->db->query("SELECT name, rfid_dec, rfid_hex, gender, visitor from
			(SELECT
			sr.abridged_name as name, sr.rfid_dec, sr.rfid_hex, sr.gender, 'Alumni' as visitor
			FROM atif.student_registered sr

			union

			SELECT
			family.name, family.rfid_dec, family.rfid_hex, if(family.parent_type = 1, 'B', 'G') as gender, 'Parent' as visitor
			from atif.student_family_record family) rfid_data
			where rfid_dec = '" . $RFIDDec . "'");

		$rows_array = $query->result_array();
		return $rows_array;
	}



	public function validate_Alumni_n_ParentsCard($RFIDDec)
	{
		$result = false;

		$query=$this->db->query("SELECT name, rfid_dec, rfid_hex, gender, visitor from
			(SELECT
			sr.abridged_name as name, sr.rfid_dec, sr.rfid_hex, sr.gender, 'Alumni' as visitor
			FROM atif.student_registered sr

			union

			SELECT
			family.name, family.rfid_dec, family.rfid_hex, if(family.parent_type = 1, 'B', 'G') as gender, 'Parent' as visitor
			from atif.student_family_record family) rfid_data
			where rfid_dec = '" . $RFIDDec . "'");

		$query_result = $this->db_students->query($query);
		
		if ( $query_result->num_rows() > 0)
		{
			$result = true;
		}
		

		return $result;
	}	



	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_visitors->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_visitors->where('record_deleted', 0);
		if(!count($this->db_visitors->ar_orderby)){
			$this->db_visitors->order_by($this->_order_by);
		}
		return $this->db_visitors->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_visitors->where($where);
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
			$this->db_visitors->set($data);
			$this->db_visitors->insert($this->_table_name);
			$id = $this->db_visitors->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_visitors->set($data);
			$this->db_visitors->where($this->_primary_key, $id);
			$this->db_visitors->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_visitors->where($this->_primary_key, $id);
		$this->db_visitors->limit(1);
		$this->db_visitors->delete($this->_table_name);
	}
}