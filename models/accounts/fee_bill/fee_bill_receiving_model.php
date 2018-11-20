<?php
class Fee_bill_receiving_model extends CI_Model{

	private $db_fee_bill;

	function __construct()
	{
		parent::__construct();
		$this->db_fee_bill = $this->load->database('fee_bill_student_db',TRUE);
	}

	protected $_table_name = 'fee_bill_received';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'id desc';	
	protected $_timestamps = TRUE;	




	public function receivingExists($FeeBillID){
		$result = 0;

		$thisQuery = "select id from fee_bill_received where fee_bill_id = " . intval($FeeBillID);
		$query=$this->db_fee_bill->query($thisQuery);
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$result = $row['id'];
		}
		return $result;
	}

	

	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_fee_bill->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_fee_bill->where('record_deleted', 0);
		if(!count($this->db_fee_bill->ar_orderby)){
			$this->db_fee_bill->order_by($this->_order_by);
		}
		return $this->db_fee_bill->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_fee_bill->where($where);
		return $this->get(NULL, $single);
	}

	public function save($data, $id = NULL){

		// Set timestamps
		if($this->_timestamps == TRUE){
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = human_to_unix($now);
			$data['register_by'] = (int)$this->session->userdata['user_id'];
			$data['modified'] = human_to_unix($now);
			$data['modified_by'] = (int)$this->session->userdata['user_id'];
		}

		// Insert a new record
		if ($id === NULL){
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db_fee_bill->set($data);
			$this->db_fee_bill->insert($this->_table_name);
			$id = $this->db_fee_bill->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_fee_bill->set($data);
			$this->db_fee_bill->where($this->_primary_key, $id);
			$this->db_fee_bill->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_fee_bill->where($this->_primary_key, $id);
		$this->db_fee_bill->limit(1);
		$this->db_fee_bill->delete($this->_table_name);
	}
}