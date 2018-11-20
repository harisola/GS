<?php
class Role_new_org_model extends CI_Model{

	private $db_staff_integration;

	function __construct()
	{
		parent::__construct();
		$this->db_staff_integration = $this->load->database('role',TRUE);
	}


	protected $_table_name = 'role_in_org';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'gr_id asc';	
	protected $_timestamps = TRUE;


	public function getLocationID($StaffID)
	{
		$cQuery = "SELECT
					riv.domain_name, aloc.id, aloc.name as location_name
					FROM atif_role.role_in_org_view riv
					left join atif_attendance.attendance_location aloc
					on aloc.name = riv.domain_name
					where riv.staff_id = " . $StaffID;
		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	    				
    	
   		return $row;
	}

	
	public function getAllSchoolRoles()
	{
		$cQuery = "select ana.id, ana.domain_name, ana.type_name,
			ana.subject_id,
			ana.gr_id, ana.is_assistant, ana.staff_id, ana.employee_id, ana.c_topline, ana.c_bottomline,
			ana.report_to, ana.staff_gender, ana.staff_department,
			COALESCE(ana.wing_name, 'ALL') AS wing_name,
			COALESCE(ana.grade_name, 'ALL') AS grade_name,
			COALESCE(ana.section_name, 'ALL') AS section_name,
			COALESCE(ana.subject_name, 'ALL') AS subject_name,
			COALESCE(ana.session_name, 'ALL') AS session_name,
			COALESCE(ana.report_grid, 'SELF') AS report_grid,
            COALESCE(ana.staff_name_code, 'Undefined') AS staff_name_code,
            COALESCE(ana.staff_formal_name, 'Undefined') AS staff_formal_name            
			from
			(SELECT 
			rg.id, rd.dname as domain_name, rt.dname as type_name, rg.gr_id, ww.dname as wing_name,
			gg.dname as grade_name, ss.dname as section_name, ass.dname as subject_name, asec.name as session_name, rig.gr_id as report_grid,
            sr.name_code as staff_name_code, sr.abridged_name as staff_formal_name, sr.employee_id, sr.c_topline, c_bottomline, sr.gender as staff_gender, sr.department as staff_department,
			rg.domain_id, rg.type_id, rg.wing_id, rg.grade_id, rg.section_id, rg.subject_id, rg.academic_session_id, rg.report_to, rg.staff_id, rg.is_assistant
			FROM atif_role.role_in_org rg
			left join atif_role.role_domain rd on rd.id = rg.domain_id
			left join atif_role.role_type rt on rt.id = rg.type_id
			left join atif._wing ww on ww.id = rg.wing_id
			left join atif._grade gg on gg.id = rg.grade_id
			left join atif._section ss on ss.id = rg.section_id
			left join atif_role.academic_subject ass on ass.id = rg.subject_id
			left join atif._academic_session asec on asec.id = rg.academic_session_id
			left join (select * from atif_role.role_in_org) rig on rig.id = rg.report_to
            left join atif.staff_registered sr on sr.id = rg.staff_id
            where rg.record_deleted = 0			
            ) ana
			order by ana.report_to asc, ana.is_assistant asc, ana.id asc";

   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	    				
    	
   		return $row;	
	}
	

	public function makeGRID($DomainID, $TypeID)
	{
		$makeGRID = "";

		$DomainCode = "";
		$query=$this->db->query("SELECT code FROM role_domain WHERE id = " . $DomainID);
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$DomainCode = $row['code'];
		}


		$TypeCode = "";
		$query=$this->db->query("SELECT code FROM role_type WHERE id = " . $TypeID);
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$TypeCode = $row['code'];
		}
		
		$makeGRID = $DomainCode . "-" . $TypeCode;

		$GRID = "";
		$query=$this->db->query("SELECT max(gr_id) as gr_id FROM role_in_org WHERE gr_id like '" . $makeGRID . "%'");

		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$GRID = $row['gr_id'];
			$GRID = substr($GRID, 4, 4);
			$GRID = $makeGRID . str_pad($GRID + 1, 4, "0", STR_PAD_LEFT);
		}else{
			$GRID = $makeGRID . "0001";
		}

		return $GRID;
	}


	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_staff_integration->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_staff_integration->where('record_deleted', 0);
		if(!count($this->db_staff_integration->ar_orderby)){
			$this->db_staff_integration->order_by($this->_order_by);
		}
		return $this->db_staff_integration->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_staff_integration->where($where);
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
			$this->db_staff_integration->set($data);
			$this->db_staff_integration->insert($this->_table_name);
			$id = $this->db_staff_integration->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_staff_integration->set($data);
			$this->db_staff_integration->where($this->_primary_key, $id);
			$this->db_staff_integration->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_staff_integration->where($this->_primary_key, $id);
		$this->db_staff_integration->limit(1);
		$this->db_staff_integration->delete($this->_table_name);
	}
}