<?php
class Class_list_current_model extends CI_Model{

	private $db_atif;

	function __construct()
	{
		parent::__construct();
		$this->db_atif = $this->load->database('default',TRUE);
	}


	protected $_table_name = 'students_current_classlist';
	protected $_primary_key = 'student_id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'abridged_name asc';	
	protected $_timestamps = TRUE;


	public function getThresholdParentsData(){		
		
		/*$class_query = "select student.gr_no, student.gs_id, student.abridged_name, if(student.grade_name is null, 'Alumni', student.grade_name) as grade_name,
			student.section_name, student.gf_id from
			(SELECT 
			sr.gr_no, sr.gs_id, sr.abridged_name, sar.grade_name, sar.section_name, sr.gf_id
			FROM student_registered sr
			left join (
			SELECT sar.student_id, gg.name as grade_name, ss.name as section_name
			from student_academic_record sar
			left join _grade gg on gg.id = sar.grade_id
			left join _section ss on ss.id = sar.section_id
			where (sar.academic_session_id = 5 or sar.academic_session_id = 6))			
			sar on sar.student_id = sr.id
			where sr.abridged_name != '') student";*/


		/*$class_query = "select student.gr_no, student.gs_id, student.abridged_name, if(student.grade_name is null, 'Alumni', student.grade_name) as grade_name,
			student.section_name, student.gf_id, allparents.date as alp_date from
			(SELECT 
			sr.gr_no, sr.gs_id, sr.abridged_name, sar.grade_name, sar.section_name, sr.gf_id
			FROM atif.student_registered sr
			left join (
			SELECT sar.student_id, gg.name as grade_name, ss.name as section_name
			from atif.student_academic_record sar
			left join atif._grade gg on gg.id = sar.grade_id
			left join atif._section ss on ss.id = sar.section_id            
			where (sar.academic_session_id = 5 or sar.academic_session_id = 6))			
			sar on sar.student_id = sr.id
			where sr.abridged_name != '') student
            left join (select gf_id, date from atif_visitors.allowed_parents where date=curdate()) as allparents on allparents.gf_id = student.gf_id";*/
        $class_query = "select student.gr_no, student.gs_id, if(pet.type!='', 'X X X', '') as petitioner_type, student.abridged_name, if(student.grade_name is null, 'Alumni', student.grade_name) as grade_name,
			student.section_name, student.gf_id, allparents.date as alp_date, allparents.color_hex from
			(SELECT 
			sr.gr_no, sr.gs_id, sr.abridged_name, sar.grade_name, sar.section_name, sr.gf_id
			FROM atif.student_registered sr
			left join (
			SELECT sar.student_id, gg.name as grade_name, ss.name as section_name
			from atif.student_academic_record sar
			left join atif._grade gg on gg.id = sar.grade_id
			left join atif._section ss on ss.id = sar.section_id            
			where (sar.academic_session_id = $this->AcademicSessionFrom or sar.academic_session_id = $this->AcademicSessionTo))
			sar on sar.student_id = sr.id
			where sr.abridged_name != '') student
            left join (select gf_id, date, color_hex, weight from atif_visitors.today_disallowed_parents) as allparents on allparents.gf_id = student.gf_id
            left join (select title, gf_id, gender, petitioner_code, petitioner_no, type, withdrew_petition from atif_gs_events.1509_petitioners where withdrew_petition=0) as pet on pet.gf_id=student.gf_id";

		
		$query=$this->db->query($class_query); 
		$row = $query->result_array();	
				
		return $row;
	}

	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_atif->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_atif->where('record_deleted', 0);
		if(!count($this->db_atif->ar_orderby)){
			$this->db_atif->order_by($this->_order_by);
		}
		return $this->db_atif->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_atif->where($where);
		return $this->get(NULL, $single);
	}

	public function save($data, $id = NULL){

		// Set timestamps
		if($this->_timestamps == TRUE){
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = human_to_unix($now);
			$data['modified'] = human_to_unix($now);
			$data['modified_by'] = (int)$this->session->userdata['user_id'];
		}

		// Insert a new record
		if ($id === NULL){
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db_atif->set($data);
			$this->db_atif->insert($this->_table_name);
			$id = $this->db_atif->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_atif->set($data);
			$this->db_atif->where($this->_primary_key, $id);
			$this->db_atif->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_atif->where($this->_primary_key, $id);
		$this->db_atif->limit(1);
		$this->db_atif->delete($this->_table_name);
	}
}