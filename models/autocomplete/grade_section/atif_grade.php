<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Atif_grade extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function getsection( $tablename, $where_grade )
	{
		$this->db_role = $this->load->database('default',TRUE);
		
		$this->db->select("`section_name`,`section_id`");
		$this->db->distinct();
		$this->db->where($where_grade);
		$this->db->from($tablename);
		//$this->db->group_by( array( 'grade_name', 'section_name' ) );
		$this->db->order_by('section_id','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return  $query->result();
		}else{
			return false;
		}	
	}	
	
	
	public function getAllProgramsOfGrade( $grade_id ){
		$this->db_role = $this->load->database('role',TRUE);
		$this->db->select("*");
		$this->db->where("grade_id",$grade_id );
		$this->db->from("academic_program_view");
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return  $query->result();
		}else{
			return false;
		}	
		
	}
	

}