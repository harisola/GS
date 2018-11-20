<?php

class Programme_report_model extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->database('subject',TRUE);
	}


		// Get Programme and Subject Detail
	public function get_subejct_detail($grade_id,$academic_session_id, $AcademicYear=null){

		$query = "SELECT ps.optional,s.name as 	subject_name,s.code as subject_code FROM programmesetup".$AcademicYear." ps  inner join atif_subject.subject s on s.id =  ps.subjects where ps.gradeID = ".$grade_id." and ps.sessionID = ".$academic_session_id;
		$row = $this->db->query($query);
		$rows = $row->result_array();
		if(!empty($rows) || $rows != '' || $rows != null){
			return $rows;
		}
		else if(empty($rows) || $rows == '' || $rows == null ){
			return false;
		}

		
	}

	public function get_by($tablename,$select='',$where=null){

		$this->db->from($tablename);

		// Selection of the data
		if($select == ''){
			$this->db->select();
		}
		else if ($select != ''){
			$this->db->select($select);
		}

		// Where case of the data

		if($where == null){
		}
		else if($where != null){
			$this->db->where($where);
		}

		//query result
		$result = $this->db->get();
		$row = $result->result();

		if(!empty($row)){
			return $row;
		}
		else if (empty($result)){
			return false;
		}



	}

	public function get_subject_selection_group($grade_id,$academic_session_id){
	$query = "SELECT s.name as subject_name,ag.name as grade_name,ssg.name as group_name,ssgg.subject_selection_group_id,ssgg.grade_id FROM subject_selection_group_grade ssgg 
		inner join subject_selection_group ssg on ssg.id = ssgg.subject_selection_group_id
		inner join atif._grade ag on ag.id = ssgg.grade_id
		inner join atif_subject.subject s on s.id = ssgg.subject_id where ssgg.grade_id = ".$grade_id." and ssgg.academic_session_id = ".$academic_session_id;
	$row = $this->db->query($query);
	$result = $row->result();
	return $result;
	}

	public function get_teacher($grade_id,$section_id,$type_id){
	$query="SELECT asr.name as class_teacher FROM atif_role.role_in_org rio inner join atif.staff_registered asr on asr.id = rio.staff_id where grade_id =".$grade_id." and section_id =".$section_id." and type_id =".$type_id;
	$row = $this->db->query($query);
	$result = $row->result();
	return $result;
	}
}
