<?php
class Assessment_term extends CI_Model{


	/*protected $_table_name = 'assessment_term';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'created desc';
	public $rules = array();
	protected $_timestamps = TRUE; */

	private $db_asset;

	public function __construct(){
		parent::__construct();
		$this->db_asset = $this->load->database('assessment',TRUE);
	}



	public function select($tablename)
	{	

		$this->db_asset->from($tablename);
		
		$this->db_asset->select();
		$this->db_asset->order_by("id", "desc"); 
		$query=$this->db_asset->get();
		return $query->result_array();
	}

	public function term_insert( $data ){

		return $this->db_asset->insert('assessment_term', $data); 

	}

	public function fetch($tablename,$where=null)
	{
		$this->db_asset->select()->from($tablename);
		if(is_array($where) && $where != null)
		{
			foreach($where as $key=>$val)
			{
				$this->db_asset->where($key,$val);
			}
		}

		return $this->db_asset->get()->result_array();
	}

	public function getupdated($tablename,$where,$data){
		
		$this->db_asset->where($where);
		$this->db_asset->update($tablename,$data);
		$afftectedRows = $this->db_asset->affected_rows();
		return $afftectedRows;
	}
	
	public function getDelete($tablename,$where_delete){
		$this->db_asset->where($where_delete);
		if($this->db_asset->delete($tablename)){
			return true;
		}
		else{
			return False;
		}
	}
	
	public function getTerm( $where ){
		$this->db_asset->select('b.id AS term_id, b.dname AS Term');
		$this->db_asset->from('assessment_term_academic_session AS a');
		$this->db_asset->join('assessment_term AS b','a.assessment_term_id=b.id');
		if(is_array($where) && $where != null){
			foreach($where as $key=>$val){
				$this->db_asset->where($key,$val);
			}
		}
		return $this->db_asset->get()->result_array();
	}
}