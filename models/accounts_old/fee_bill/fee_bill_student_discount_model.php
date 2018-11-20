<?php
class Fee_bill_student_discount_model extends CI_Model{

	private $db_atif_fee;

	function __construct()
	{
		parent::__construct();
		$this->db_atif_fee = $this->load->database('fee_bill_student_db', TRUE);
	}


	protected $_table_name = 'concession_level_definition';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'created desc';	
	protected $_timestamps = TRUE;


	public function getStudentInfo($GSID){		
		$query=$this->db->query("SELECT * from atif.class_list
			where gs_id = '" . $GSID . "'");
		$rows_array = $query->result_array();		
				
        return $rows_array;
	}


	public function getStudentDiscountInfo($GSID){		
		$query=$this->db->query("SELECT c.id, 
			cl.abridged_name, cl.gender, cl.grade_name, cl.section_name, CONCAT(LEFT(LPAD(cl.gf_id,5,0), 2), '-', RIGHT(LPAD(cl.gf_id,5,0), 3)) as gf_id,
			c.student_id, c.concession_type_id, c.description, c.percentage, c.amount, c.is_active, c.aug, c.sep, c.oct, c.nov, c.dec, c.jan, c.feb, c.mar, c.apr, c.may, c.jun, c.jul, 
			c.academic_session_id, p.dname as concession_name, p.name_code as concession_code
			FROM atif_fee_student.concession_level_definition as c
			left join atif_fee_student. concession_type_parameter p on p.id = c.concession_type_id
			left join atif.class_list cl on cl.id = c.student_id
			where cl.gs_id = '" . $GSID . "'
			and c.academic_session_id >= " . $this->AcademicSessionFrom . " and c.academic_session_id <= " . $this->AcademicSessionTo . "
			and c.concession_type_id != 9");
		$rows_array = $query->result_array();		
				
        return $rows_array;
	}


	public function already_discount($GSID){
		$result = false;
		$query=$this->db->query("SELECT c.id, cl.gs_id,
			cl.abridged_name, cl.gender, cl.grade_name, cl.section_name, CONCAT(LEFT(LPAD(cl.gf_id,5,0), 2), '-', RIGHT(LPAD(cl.gf_id,5,0), 3)) as gf_id,
			c.student_id, c.concession_type_id, c.description, c.percentage, c.amount, c.is_active, c.aug, c.sep, c.oct, c.nov, c.dec, c.jan, c.feb, c.mar, c.apr, c.may, c.jun, c.jul, 
			c.academic_session_id, p.dname as concession_name, p.name_code as concession_code
			FROM atif_fee_student.concession_level_definition as c
			left join atif_fee_student. concession_type_parameter p on p.id = c.concession_type_id
			left join atif.class_list cl on cl.id = c.student_id
			where cl.gs_id = '" . $GSID . "'
			and c.academic_session_id >= " . $this->AcademicSessionFrom . " and c.academic_session_id <= " . $this->AcademicSessionTo . "
			and c.concession_type_id != 9");

		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			if($row['gs_id'] != ''){
				$result=true;
			}
		}
		return $result;
	}
	

	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_atif_fee->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_atif_fee->where('record_deleted', 0);
		if(!count($this->db_atif_fee->ar_orderby)){
			$this->db_atif_fee->order_by($this->_order_by);
		}
		return $this->db_atif_fee->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_atif_fee->where($where);
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
			$this->db_atif_fee->set($data);
			$this->db_atif_fee->insert($this->_table_name);
			$id = $this->db_atif_fee->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_atif_fee->set($data);
			$this->db_atif_fee->where($this->_primary_key, $id);
			$this->db_atif_fee->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_atif_fee->where($this->_primary_key, $id);
		$this->db_atif_fee->limit(1);
		$this->db_atif_fee->delete($this->_table_name);
	}
}