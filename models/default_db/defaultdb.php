<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Defaultdb extends CI_Model{
	
	// Model for Default database data menipulation operations
	
	function __construct(){ 
		parent::__construct();
		$this->load->database('default',TRUE);
	}
	
	/*
	 * Function for get one table data from
	 * Default database
	*/
	
	public function get( $tablename, $select = NULL, $where=NULL  ){
		if( $select != NULL ){ 
			$this->db->select( $select );
		}else{
			$this->db->select('*');
		}
		$this->db->from($tablename);
		if( $where != NULL ){
			$this->db->where( $where );
		}
		$query = $this->db->get();
		if($query->num_rows()>0){
		  return $query->result_array();
		}else{
		  return FALSE;
		}
	}
}