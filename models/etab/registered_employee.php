<?php
class Registered_employee extends MY_Model{
	protected $_table_name = 'staff_registered';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'abridged_name asc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct() { parent::__construct(); 	}
	
	
	 /**
	   * Function for getting school employee complete information
	  **/
		public function getEmployee(){
			$this->db->select('employee_id,name');
			$this->db->from('staff_registered');
			//$this->db->limit(10,1);
			$query = $this->db->get();
			return $result = $query->result();
		}
	/* End */
	
	
	
	
}//main classs	