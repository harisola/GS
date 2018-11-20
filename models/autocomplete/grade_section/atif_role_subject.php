<?php 
class Atif_role_subject extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->db_role = $this->load->database('atif_role',TRUE);
	}

	public function get_grade_subject($where_subject)
	{
		$this->db_role->select('ass.name,ass.id',false);
		$this->db_role->from('academic_subject as ass ');
		$this->db_role->join('academic_program as ap','ap.subject_id = ass.id');
		$this->db_role->where($where_subject);
		$query = $this->db_role->get();
		return $query->result();		
	}

	 public function get_teacher_subject($tablename,$where_teacher)
	 {
	 	$this->db_role->select();
	 	$this->db_role->from($tablename);
	 	$this->db_role->where($where_teacher);
	 	$query = $this->db_role->get();
	 	return $query->result();
	 	

	 	// $query ='SELECT * FROM '. $tablename. 'where grade_name = '.'PN'.'and section_id = '.'1'.'and subject_id = '. '41'.'';
	 	// return $this->db_role->get()->result();
	 } 
}