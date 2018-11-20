<?php
class Getid_term_academic extends CI_Model
{
	private $db_term_academic;

	public $_table_name = 'assessment_term_academic_session';
	

	public function __construct()
	{
		parent::__construct();
		$this->db_term_academic = $this->load->database('atif_assessment',TRUE);
	}

	public function name_select_term($tablename)
	{

		$this->db->select();
		$this->db->from($tablename);
		$query=$this->db->get();
		return $query->result();
	}


	public function assest_insert($tablename,$data)
	{
		return $this->db->insert($tablename,$data);
	}

	public function getview()
	{
		$query = 'SELECT atas.id ,at.dname, sa.name ,atas.date_from,atas.date_to,atas.is_active FROM `assessment_term_academic_session` atas left join assessment_term at on atas.assessment_term_id = at.id left join atif._academic_session sa on atas.academic_session_id = sa.id';
		$row = $this->db->query($query);
		return $row->result();
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
			$this->db_term_academic->set($data);
			$this->db_term_academic->insert($this->_table_name);
			$id = $this->db_term_academic->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_term_academic->set($data);
			$this->db_term_academic->where($this->_primary_key, $id);
			$this->db_term_academic->update($this->_table_name);
		}

		return $id;
	}

	public function fetch($tablename,$where=null)
	{
		$query = 'SELECT atas.id ,at.dname, sa.name ,atas.date_from,atas.date_to FROM `assessment_term_academic_session` atas left join assessment_term at on atas.assessment_term_id = at.id left join atif._academic_session sa on atas.academic_session_id = sa.id where atas.id ='."'".$where."'";
		$row = $this->db->query($query);
		return $row->result();
	}

	public function term_name($tablename)
	{
		$this->db_term_academic->select();
		$this->db_term_academic->from($tablename);
		$query= $this->db_term_academic->get();
		$query->result();
	}

	public function getupdated($tablename,$where,$data)
	{
		$this->db->where($where);
		$this->db->update($tablename,$data);
		$afftectedRows = $this->db->affected_rows();
		return $afftectedRows;
	}

	public function get_same_data($tablename,$where)
	{
		$where_from = array('id' => $where);
		$this->db->where($where_from);
		$this->db->from($tablename);
		$query = $this->db->get();
		return $query->result();
	}
	public function getdelete($tablename,$where)
	{
		$this->db->where($where);
		$this->db->delete($tablename);
	}
}
