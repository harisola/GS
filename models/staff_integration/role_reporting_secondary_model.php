<?php
class Role_reporting_secondary_model extends CI_Model{

	private $db_role;

	function __construct()
	{
		parent::__construct();
		$this->db_role = $this->load->database('role',TRUE);
	}


	protected $_table_name = 'role_reporting_secondary';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'order asc';	
	protected $_timestamps = TRUE;



	public function getSecondaryReportingOf($RoleID)
	{
		$cQuery = "select * from secondary_reporting_info
					where role_id = " . $RoleID;

   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	    				
    	
   		return $row;	
	}

	public function getAllReportingRoles()
	{
		$cQuery = "select id, gr_id from role_in_org
					order by gr_id asc";

   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	    				
    	
   		return $row;	
	}


	public function getRoleInfo($RoleID)
	{
		$cQuery = "select * from role_in_org_view
					where id = " . $RoleID . " limit 1";

   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	    				
    	
   		return $row;	
	}
	
	
	public function getSecondaryReportingID($RowNum)
	{
		if($RowNum == 0){
			$cQuery = "select * from role_secondary_reporting
						limit 1";
		}else{
			$cQuery = "select * from role_secondary_reporting
						limit " . $RowNum . ",1";
		}		

   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	    				
    	
   		return $row;	
	}
	

	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_role->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_role->where('record_deleted', 0);
		if(!count($this->db_role->ar_orderby)){
			$this->db_role->order_by($this->_order_by);
		}
		return $this->db_role->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_role->where($where);
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
			$this->db_role->set($data);
			$this->db_role->insert($this->_table_name);
			$id = $this->db_role->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_role->set($data);
			$this->db_role->where($this->_primary_key, $id);
			$this->db_role->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_role->where($this->_primary_key, $id);
		$this->db_role->limit(1);
		$this->db_role->delete($this->_table_name);
	}
}