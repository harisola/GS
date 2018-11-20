<?php
class print_option_group extends CI_Model{


	function __construct(){
		parent::__construct();
	}

	public function get_program($grade_id,$academic_session_id){
		$query = "SELECT s.id as subject_id, s.name as subject_name
				FROM atif_subject.programmesetup ps
				LEFT JOIN atif_subject.subject s ON s.id = ps.subjects
				where ps.gradeID = ".$grade_id." and ps.optional = 1 and ps.record_deleted = 0 and ps.sessionID = ".$academic_session_id;
		$result = $this->db->query( $query );
		$results = $result->result_array();
		return $results;
	}


	public function get_classlist($grade_id,$academic_session_id){
		$query = "	SELECT *
			FROM atif.class_list cl
			WHERE cl.grade_id = ".$grade_id." AND cl.academic_session_id = ".$academic_session_id." AND cl.std_status_category = 'Student'
			order by cl.section_id,cl.call_name";
		$result = $this->db->query( $query );
		$results = $result->result_array();
		return $results;
	}

	public function get_option_group($grade_id,$term_id,$academic_session_id){

		$query = "SELECT cl.id as student_id,cl.gs_id,cl.abridged_name,s.name AS subject_name,ssg.name AS grpup_name,sss.group_no AS group_id
		FROM atif_subject.subject_selection_student2 sss
		LEFT JOIN atif.class_list cl ON cl.id = sss.student_id
		LEFT JOIN atif_subject.subject s ON s.id = sss.subject_selection_grade_id
		LEFT JOIN atif_subject.subject_selection_group ssg ON ssg.id = sss.group_no
		WHERE sss.term = ".$term_id." AND cl.grade_id = ".$grade_id." AND sss.`session` = ".$academic_session_id." AND cl.std_status_category = 'Student' AND sss.record_deleted = 0";
		$result = $this->db->query( $query );
		$results = $result->result_array();
		return $results;
	}


	public function get_group($grade_id,$academic_session_id){
		$query = "SELECT ssg.id as group_id,ssg.name as group_name FROM atif_subject.subject_selection_group_grade ssgg
			LEFT JOIN atif_subject.subject_selection_group ssg on ssg.id = ssgg.subject_selection_group_id 
			where ssgg.grade_id = ".$grade_id." and ssgg.academic_session_id = ".$academic_session_id."
			GROUP BY ssg.id";
		$result = $this->db->query( $query );
		$results = $result->result_array();
		return $results;

	}


	

}// mean class assessment category	
