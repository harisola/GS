<?php

class Org_chart_model extends CI_Model{

	function __construct(){

		parent::__construct();
		$this->role_org = $this->load->database('role_org',TRUE);
	}

	public function get_by(){


		$query = $this->role_org->query("select org.id,
		org.rolecode, org.org_domain_id, org.role_type_id, org.gp_id, org.wing_id, org.grade_id,
		org.section_id, org.subject_id, org.title, org.pm_report_to,org.sc_report_to ,org.is_assistant, org.staff_role_category_id,
		org.role_title_tl, org.role_title_bl, org.staff_id, org.is_transparent, org.academic_session_id, org.positionstatus,
		org.countrolecode, org.fundamentalrole,

		orgd.dname as domain_name, orgt.dname as domain_type,
		ww.dname as wing_name, gg.dname as grade_name, ss.dname as section_name,
		orgc.dname as staff_role_category,
		sr.abridged_name,sr.employee_id,sr.gender as staff_gender


		from atif_role_org.role_position as org

		left join atif_role_org.role_domain orgd on orgd.id=org.org_domain_id
		left join atif_role_org.role_type orgt on orgt.id=org.role_type_id
		left join atif._wing ww on ww.id=org.wing_id
		left join atif._grade gg on gg.id=org.grade_id
		left join atif._section ss on ss.id=org.section_id
		left join atif_role_org.role_category orgc on orgc.id=org.staff_role_category_id
		left join atif.staff_registered sr on sr.id=org.staff_id


		where org.record_deleted=0

		order by org.pm_report_to, org.id");

		 
		$result =  $query->result_array();
		return $result;
	}
}