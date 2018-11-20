<?php
class Academic_model extends CI_Model{
	private $defultDB;
	private $AssDB;
	private $DDDB;
	public function __construct(){ parent::__construct(); }
	
	public function get(){
		$this->defultDB = $this->load->database('default',true);
		$query = 'SELECT * From  _academic_session Where is_active = 1 or end_date > Now() AND is_active = 1';
		$results = $this->defultDB->query($query);
		if ($results->num_rows() > 0) { return $results->result_array(); }else{ return FALSE; }
	}
	
	public function name_select_term($tablename){
		$this->AssDB = $this->load->database('assessment',TRUE);
		$this->AssDB->select();
		$this->AssDB->from($tablename);
		$results = $this->AssDB->get();
		
		if ($results->num_rows() > 0) {
			return $results->result_array();	
		}else{
			return FALSE;
		}
		
		//return $query->result_array();
	}


	public function assest_insert($tablename,$data){
		$this->AssDB = $this->load->database('assessment',TRUE);
		return $this->AssDB->insert($tablename,$data);
	}

	public function getview(){
		$this->AssDB = $this->load->database('assessment',TRUE);
		
		$query = 'SELECT atas.id ,at.dname, sa.name ,atas.date_from,atas.date_to FROM `assessment_term_academic_session` atas left join assessment_term at on atas.assessment_term_id = at.id left join atif._academic_session sa on atas.academic_session_id = sa.id';
		
		$results = $this->AssDB->query($query);
		
		if ($results->num_rows() > 0) {
			return $results->result_array();	
		}else{
			return FALSE;
		}
	}

	public function save( $data, $id = NULL){
		$this->AssDB = $this->load->database('assessment',TRUE);
		$table_name = "assessment_term_academic_session";
		if( $id == NULL ){
			$this->AssDB->insert($table_name,$data);
			$id = $this->AssDB->insert_id();
		}else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->AssDB->set($data);
			$this->AssDB->where($this->_primary_key, $id);
			$this->AssDB->update($this->_table_name);
		}
		return $id;
	}

	public function fetch($tablename,$where=null){
		
		$this->AssDB = $this->load->database('assessment',TRUE);
		$query = 'SELECT atas.id ,at.dname, sa.name ,atas.date_from,atas.date_to FROM `assessment_term_academic_session` atas left join assessment_term at on atas.assessment_term_id = at.id left join atif._academic_session sa on atas.academic_session_id = sa.id where atas.id ='."'".$where."'";
		$row = $this->AssDB->query($query);
		return $row->result();
		
	}

	public function term_name($tablename){
		$this->AssDB = $this->load->database('assessment',TRUE);
		$this->AssDB->select();
		$this->AssDB->from($tablename);
		$query= $this->AssDB->get();
		$query->result();
	}

	public function getupdated($tablename,$where,$data){
		$this->AssDB = $this->load->database('assessment',TRUE);
		$this->AssDB->where($where);
		$this->AssDB->update($tablename,$data);
		$afftectedRows = $this->db->affected_rows();
		return $afftectedRows;
	}

	public function get_same_data($tablename,$where){
		$this->AssDB = $this->load->database('assessment',TRUE);
		$where_from = array('id' => $where);
		$this->AssDB->where($where_from);
		$this->AssDB->from($tablename);
		$query = $this->AssDB->get();
		return $query->result();
	}
	public function getdelete($tablename,$where){
		$this->AssDB = $this->load->database('assessment',TRUE);
		$this->AssDB->where($where);
		$this->AssDB->delete($tablename);
	}
	
	
	public function getSession($branch_id){
		$this->DDDB = $this->load->database('default',TRUE);
		//$query = "SELECT id From  _academic_session Where branch_id = 2 AND is_active = 1 OR end_date > Now()";
		$query = "SELECT id From  _academic_session Where branch_id = $branch_id AND is_active = 1";
		
		$results = $this->DDDB->query($query);
		if ($results->num_rows() > 0) { return $results->result_array(); }else{ return FALSE; }
	}
	
		public function getSesstrm($session){
		$this->DDDB = $this->load->database('assessment',TRUE);
		//$query = "SELECT id From  _academic_session Where branch_id = 2 AND is_active = 1 OR end_date > Now()";
		$query = "SELECT assessment_term_id AS TermID From  assessment_term_academic_session Where academic_session_id = $session AND is_active = 1";
		$results = $this->DDDB->query($query);
		if ($results->num_rows() > 0) { return $results->result_array(); }else{ return FALSE; }
	}

}