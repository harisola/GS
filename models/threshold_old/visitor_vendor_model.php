<?php
class Visitor_vendor_model extends CI_Model{

	private $db_visitors;
	private $db_visitors2;
	function __construct()
	{
		parent::__construct();
		
	}


	protected $_table_name = 'visitor';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'time_in desc';	
	protected $_timestamps = TRUE;

	public function getVisitorTypes(){
		$this->db_visitors = $this->load->database('visitors',TRUE);
		$query =
		"SELECT * FROM visitor_type order by sequence";

		$sql = $this->db_visitors->query($query);
		return $sql->result();
	}	


	public function get($id = NULL, $single = FALSE){
		$this->db_visitors = $this->load->database('visitors',TRUE);
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
		$this->db_visitors = $this->load->database('visitors',TRUE);
		$this->db_visitors->where($where);
		return $this->get(NULL, $single);
	}

	public function save($data, $id = NULL){
		$this->db_visitors = $this->load->database('visitors',TRUE);
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
		$this->db_visitors = $this->load->database('visitors',TRUE);
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_visitors->where($this->_primary_key, $id);
		$this->db_visitors->limit(1);
		$this->db_visitors->delete($this->_table_name);
	}
	
	
	public function getstudent($gs_id){
		$this->db_visitors2 = $this->load->database('default',TRUE);
		$sqlQuery="SELECT cl.abridged_name AS abridged_name FROM atif.student_registered AS cl WHERE cl.gs_id ='$gs_id'";
		$result = $this->db_visitors2->query( $sqlQuery );
		$results = $result->row_array();
		return $results;
		
	}
}