<?php

class Assign_teacher_role_model extends CI_Model{

	function construct(){
		parent::__construct();
		$this->matrix_role = $this->load->database('role_matrix',TRUE);
	}

	public function get_by($tablename,$where=Null,$select='',$group='')
	{


		if($select == ''){
			$this->db->select();
		}
		else if ($select != ''){
			$this->db->select($select);
		}
		
		$this->db->from($tablename);
		if($where == Null){

		}
		else if ($where != Null){
			$this->db->where($where);
		}
		if($group == '')
		{

		}
		else if($group != ''){
			$this->db->group_by($group); 
		}

		$query = $this->db->get();
		$row = $query->result();

		if($row == null)
		{
			return false;
		}
		else if($row != null)
		{
			return $row;
		}
	}


	public function save($tablename,$data){

		$this->db->insert($tablename,$data);
		
		$affected = $this->db->affected_rows();
		return $affected;

	}


	public function get_join($academic_session_id,$grade_id,$teacher_type_id)
	{
		$query = "SELECT rct.id,rct.academic_session_id,rct.grade_id,rct.section_id,rct.teacher_type_id,rct.gp_id,rct.blocks_per_week,sr.name as staff_name ,sr.name_code From atif_role_matrix.role_class_teacher rct inner join atif.staff_registered sr on sr.id = rct.staff_id where academic_session_id =".$academic_session_id." "." and grade_id = ".$grade_id." " ."and teacher_type_id = ".$teacher_type_id;
		$row = $this->db->query($query);
		return $row->result();

	}

	public function get_distinct($tablename,$where,$select){
		
		$this->db->distinct();
		if($select == '')
		{
			$this->db->select();
		}
		else if($select != ''){
			$this->db->select($select);
		}
		$this->db->from($tablename);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result();
	}

	public function update_data($tablename,$where,$data){
		$this->db->where($where);
		$this->db->update($tablename,$data);
		$row = $this->db->affected_rows();
		return $row;
	}

	public function get_subject($academic,$grade)
	{
		$query = "SELECT ps.id,ps.gradeID,ps.subjects as subject_id,s.name as subject_name  FROM atif_subject.programmesetup ps
				  inner join atif_subject.subject s on  s.id = ps.subjects where ps.gradeID = ".$grade." " ."and ps.sessionID = ".$academic." and ps.optional = 0";
		$row = $this->db->query($query);
		return $row->result();

	}

		public function get_subject_optional($academic,$grade)
	{
		$query = "SELECT ps.id,ps.gradeID,ps.subjects as subject_id,s.name as subject_name  FROM atif_subject.programmesetup ps
				  inner join atif_subject.subject s on  s.id = ps.subjects where ps.gradeID = ".$grade." " ."and ps.sessionID = ".$academic." and ps.optional = 1";
		$row = $this->db->query($query);
		return $row->result();

	}

	public function get_subject_teacher($academic,$grade){

		$query = "SELECT rst.id,rst.academic_session_id,rst.program_id,rst.section_id, rst.gp_id,sr.name as staff_name,sr.name_code,ps.subjects FROM atif_role_matrix.role_subject_teacher rst inner join atif.staff_registered sr on sr.id = rst.staff_id inner join atif_subject.programmesetup ps on ps.id = rst.program_id  where academic_session_id = ".$academic." and ps.gradeID = ".$grade." and ps.optional=0";
		$row = $this->db->query($query);
		return $row->result();

	}

	// Get Subject Optional Teacher
	public function get_subject_teacher_optional($academic,$grade){

		$query = "SELECT rst.id,rst.academic_session_id,rst.program_id,rst.section_id, rst.gp_id,sr.name as staff_name,sr.name_code,ps.subjects FROM atif_role_matrix.role_subject_teacher rst inner join atif.staff_registered sr on sr.id = rst.staff_id inner join atif_subject.programmesetup ps on ps.id = rst.program_id  where academic_session_id = ".$academic." and ps.gradeID = ".$grade." and ps.optional=1";
		$row = $this->db->query($query);
		return $row->result();

	}



}

