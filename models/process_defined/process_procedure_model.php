<?php
class Process_procedure_model extends CI_Model{

	private $db_atif;

	function __construct()
	{
		parent::__construct();
		$this->db_atif = $this->load->database('process',TRUE);
	}


	protected $_table_name = 'process_procedure';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'id asc';	
	protected $_timestamps = TRUE;


	public function getAllProceduresOf($ProcessID){
		$query=$this->db->query('SELECT 
					pp.process_id, pp.procedure_id,
					pr.name as process_name,
					pd.name as procedure_name, pd.description as procedure_description
					FROM atif_process.process_procedure pp
					left join atif_process.process pr on pr.id=pp.process_id
					left join atif_process.procedure pd on pd.id=pp.procedure_id

					where pp.record_deleted=0 and pr.record_deleted=0 and pd.record_deleted=0 and pp.process_id = '.$ProcessID);
		$rows_array = $query->result_array();		

		return $rows_array;
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