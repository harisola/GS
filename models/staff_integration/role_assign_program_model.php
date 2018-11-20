<?php
class Role_assign_program_model extends CI_Model{

	private $db_role;

	function __construct()
	{
		parent::__construct();
		$this->db_role = $this->load->database('role',TRUE);
	}
	
	public function getAllProgramsOf($GradeName)
	{
		$cQuery = "SELECT * FROM academic_program_view where grade_name = '" . $GradeName . "' order by 'order'";

   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	    				
    	
   		return $row;	
	}

	public function getAllClassTeachersOf($GradeName)
	{
		$cQuery = "SELECT *
					FROM role_in_org_view
					where grade_name = '" . $GradeName . "'
					and type_id = 15
					group by gr_id
					order by gr_id asc";  		

   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	    				
    	
   		return $row;	
	}

	public function getAllLeadTeachersOf($GradeName)
	{
		$cQuery = "SELECT
				role.id, role.domain_name, role.type_name, role.gr_id, role.wing_name, role.grade_name, role.section_name, role.subject_name, role.academic_session_name,
				role.staff_name, role.staff_name_code, role.employee_id, role.domain_id, role.type_id, role.wing_id, role.grade_id, role.section_id,
				role.subject_id, role.academic_session_id, role.report_to, role.is_assistant, role.staff_id, role.record_deleted

				FROM role_lead_teacher_link_view lt
				left join role_in_org_view role on role.gr_id = lt.gr_id

				where (lt.academic_session_id = ". $this->AcademicSessionFrom ." or lt.academic_session_id = " . $this->AcademicSessionTo . ")
				and lt.grade_name = '" . $GradeName . "'
				group by role.gr_id
				order by role.subject_id asc";

   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	    				
    	
   		return $row;	
	}

	public function getAllCoTeachersOf($GradeName)
	{
		$cQuery = "SELECT *
					FROM role_in_org_view
					where grade_name = '" . $GradeName . "'
					and type_id = 16
					group by gr_id
					order by gr_id asc";

   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	    				
    	
   		return $row;	
	}

	public function getAllYearTutorsOf($GradeName)
	{
		$cQuery = "SELECT *
					FROM role_in_org_view
					where grade_name = '" . $GradeName . "'
					and type_id = 6
					group by gr_id
					order by gr_id asc";

   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	    				
    	
   		return $row;	
	}

	public function getAllSubjectTeachersOf($GradeName, $SubjectID){
		$cQuery = "SELECT *
					FROM role_in_org_view
					where grade_name = '" . $GradeName . "'
					and type_id = 17
                    and subject_id = '" . $SubjectID . "'
                    group by gr_id
					order by gr_id asc";
		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	    				
    	
   		return $row;
	}


	public function get_CnC_Teacher($GradeID, $SectionID){
		$cQuery = "SELECT 
				staff_name, type_name, type_id
				FROM `role_in_org_view`
				where grade_id = '" . $GradeID . "'
				and section_id = '" . $SectionID . "'
				and (type_id = 15 or type_id = 16)";
		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	    				
    	
   		return $row;
	}

	protected $_table_name = 'role_domain';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'order asc';	
	protected $_timestamps = TRUE;
	

	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_role->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_role->where('record_deleted', 0);
		if(!count($this->db_role->ar_orderby)){
			$this->db_role->order_by($this->_order_by);
		}
		return $this->db_role->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_role->where($where);
		return $this->get(NULL, $single);
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
			$this->db_role->set($data);
			$this->db_role->insert($this->_table_name);
			$id = $this->db_role->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_role->set($data);
			$this->db_role->where($this->_primary_key, $id);
			$this->db_role->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_role->where($this->_primary_key, $id);
		$this->db_role->limit(1);
		$this->db_role->delete($this->_table_name);
	}
}