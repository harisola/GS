<?php
class Assessment_term extends MY_Model{


	protected $_table_name = 'assessment_term';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'created desc';
	public $rules = array();
	protected $_timestamps = TRUE;

	private $db_asset;

	public function __construct()
	{
		parent::__construct();
		$this->db_asset =$this->load->database('atif_assessment',TRUE);
	}



	public function select($tablename)
	{	

		$this->db->from($tablename);
		
		$this->db->select();
		$this->db->order_by("id", "desc"); 
		$query=$this->db->get();
		return $query->result_array();
	}

	public function term_insert( $data ){

		return $this->db_asset->insert('assessment_term', $data); 

	}

	public function fetch($tablename,$where=null)
	{
		$this->db->select()->from($tablename);
		if(is_array($where) && $where != null)
		{
			foreach($where as $key=>$val)
			{
				$this->db->where($key,$val);
			}
		}

		return $this->db->get()->result_array();
	}

	public function getupdated($tablename,$where,$data)
	{
		$this->db->where($where);
		$this->db->update($tablename,$data);
		$afftectedRows = $this->db->affected_rows();
		return $afftectedRows;
	}
	public function getDelete($tablename,$where_delete)
	{
		$this->db->where($where_delete);
		//$row = $this->db->delete($tablename);
		//return $row;
		if($this->db->delete($tablename))
		{
			return true;
		}
		else
		{
			return False;
		}

	}
}