<?php
class Assesment_category_grade_model extends CI_Model
{
	private $db_category_grade_model;

	protected $_table_name = 'assessment_category_grade';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'id asc';	
	protected $_timestamps = TRUE;

	public function __construct()
	{
		parent::__construct();
		$this->db_category_grade_model = $this->load->database('atif_assessment',TRUE);
	}
	public function name_select_term($tablename)
	{

		$this->db_category_grade_model->select();
		$this->db_category_grade_model->from($tablename);
		$query=$this->db_category_grade_model->get();
		return $query->result_array();
	}

	public function assest_insert($tablename,$data)
	{
		return $this->db->insert($tablename,$data);
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
			$this->db_category_grade_model->set($data);
			$this->db_category_grade_model->insert($this->_table_name);
			$id = $this->db_category_grade_model->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_category_grade_model->set($data);
			$this->db_category_grade_model->where($this->_primary_key, $id);
			$this->db_category_grade_model->update($this->_table_name);
		}

		return $id;
	}

}
