<?php
class Staff_registered_model extends MY_Model{
	protected $_table_name = 'staff_registered';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'abridged_name asc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct()
	{
		parent::__construct();
	}

	public $validation = array(
		array('field' => 'employee_id', 'label' => 'Employee ID', 'rules' => 'intval|required'),
		array('field' => 'title_person_id', 'label' => 'Staff Title', 'rules' => 'intval|required'),
		array('field' => 'staff_name', 'label' => 'NIC Name', 'rules' => 'trim|sanitize|required'),
		array('field' => 'abridged_name', 'label' => 'Full Name', 'rules' => 'trim|sanitize|required|min_length[3]|max_length[18]'),
		array('field' => 'name_code', 'label' => 'Name Code', 'rules' => 'trim|sanitize|required|min_length[3]|max_length[3]|is_unique[staff_registered.name_code]'),		
		array('field' => 'father_name', 'label' => 'Father Name', 'rules' => 'trim|sanitize|required'),
		//array('field' => 'spouse_name', 'label' => 'Spouse Name', 'rules' => 'trim|sanitize'),
		array('field' => 'nic', 'label' => 'NIC', 'rules' => 'trim|sanitize|required|min_length[15]|max_length[15]|is_unique[staff_registered.nic]'),
		array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim|sanitize|required'),
		array('field' => 'mobilephonereq', 'label' => 'Mobile Phone', 'rules' => 'trim|sanitize|required'),
		array('field' => 'landline', 'label' => 'Land Line', 'rules' => 'trim|sanitize'),
		array('field' => 'DOB', 'label' => 'DOB', 'rules' => 'trim|sanitize'),
		array('field' => 'DOJ', 'label' => 'DOJ', 'rules' => 'trim|sanitize'),

		array('field' => 'designation', 'label' => 'Designation', 'rules' => 'trim|sanitize|required'),
		array('field' => 'department', 'label' => 'Department', 'rules' => 'trim|sanitize|required'),
		array('field' => 'section', 'label' => 'Section', 'rules' => 'trim|sanitize'),
		array('field' => 'sub_section', 'label' => 'Sub Section', 'rules' => 'trim|sanitize'),
		array('field' => 'category', 'label' => 'Category', 'rules' => 'trim|sanitize|required'),
		array('field' => 'eobi_no', 'label' => 'EOBI No', 'rules' => 'trim|sanitize|is_unique[staff_registered.eobi_no]'),
		array('field' => 'sessi_no', 'label' => 'SESSI No', 'rules' => 'trim|sanitize|is_unique[staff_registered.sessi_no]'),
		array('field' => 'gg_id', 'label' => 'Generations Google Id', 'rules' => 'trim|sanitize|valid_email|is_unique[staff_registered.gg_id]|required'),

		array('field' => 'card_top_line', 'label' => 'Card Top Line', 'rules' => 'trim|sanitize|required'),
		array('field' => 'card_bottom_line', 'label' => 'Card Bottom Line', 'rules' => 'trim|sanitize|required')
	);




	public function is_exists_name_code($name_code){
		$result = false;
		$query=$this->db->query("SELECT name_code FROM atif.staff_registered where name_code = '" . $name_code . "'");
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			if($row['name_code'] != ''){
				$result=true;
			}
		}
		return $result;
	}



	public function is_staff_nic_exists($staffNIC){
		$result = false;
		$query=$this->db->query("SELECT nic FROM atif.staff_registered where nic = '" . $staffNIC . "'");
		
		if ($query->num_rows() > 0) {			
			$result=true;			
		}

		return $result;
	}



	// public function get_staff_information_of_nic($NIC){
	// 	$result = "";

	// 	$query=$this->db->query("SELECT
	// 						sr.id as staff_id, sr.name, sr.nic, SUBSTRING(sr.gg_id, 1, POSITION('@' IN sr.gg_id)-1) as gg_id, ifnull(career.gc_id,'') as gc_id, sr.mobile_phone, sr.gender,  DATE_FORMAT(sr.dob, '%d-%b-%Y') as dob, DATE_FORMAT(sr.doj, '%d-%b-%Y') as doj, sr.land_line as landline,
	// 						sr.father_name, sr.spouse_name,
	// 						ifnull(CONCAT(LEFT(LPAD(family.gf_id,5,0), 2), '-', RIGHT(LPAD(family.gf_id,5,0), 3)),'') as gf_id,
	// 						sr.gt_id, sr.abridged_name, sr.call_name, sr.name_code,
	// 						ifnull(req_it.desktop,'') as it_desktop, ifnull(req_it.printer,'') as it_printer, ifnull(req_it.other,'') as it_other,
	// 						ifnull(req_sf.table,'') as sf_table, ifnull(req_sf.chair,'') as sf_chair, ifnull(req_sf.shelf,'') as sf_shelf,
	// 						ifnull(req_tp.private,'0') as tp_private, ifnull(req_tp.shuttle,'0') as tp_shuttle,
	// 						ifnull(DATE_FORMAT(req_join.formal_doj, '%d-%b-%Y'),'') as formal_doj, ifnull(req_join.doj_procedure,'') as doj_procedure, ifnull(req_join.photo,'') as photo, ifnull(req_join.joining_policy_induction,'') as joining_policy_induction, ifnull(req_join.smart_card,'') as smart_card, ifnull(req_join.visiting_card,'') as visiting_card,

	// 						req_onb.provident_fund_offer, req_onb.provident_fund_appointment, req_onb.provident_fund_joining,
	// 						req_onb.eobi_sessi_offer, req_onb.eobi_sessi_appointment, req_onb.eobi_sessi_joining,
	// 						req_onb.life_and_health_takaful_offer, req_onb.life_and_health_takaful_appointment, req_onb.life_and_health_takaful_joining,
	// 						req_onb.bank_account_offer, req_onb.bank_account_appointment, req_onb.bank_account_joining,
	// 						req_onb.loan_policy_offer, req_onb.loan_policy_appointment, req_onb.loan_policy_joining,
	// 						req_onb.child_fee_concession_offer, req_onb.child_fee_concession_appointment, req_onb.child_fee_concession_joining,
	// 						req_onb.timing_punctuality_offer, req_onb.timing_punctuality_appointment, req_onb.timing_punctuality_joining,
	// 						req_onb.probation_and_confirmation_offer, req_onb.probation_and_confirmation_appointment, req_onb.probation_and_confirmation_joining,
	// 						req_onb.notice_period_and_resignation_offer, req_onb.notice_period_and_resignation_appointment, req_onb.notice_period_and_resignation_joining,
	// 						req_onb.dress_code_offer, req_onb.dress_code_appointment, req_onb.dress_code_joining,
	// 						req_onb.tuition_policy_offer, req_onb.tuition_policy_appointment, req_onb.tuition_policy_joining,
	// 						req_onb.annual_leave_offer, req_onb.annual_leave_appointment, req_onb.annual_leave_joining,
	// 						req_onb.emergency_policy_offer, req_onb.emergency_policy_appointment, req_onb.emergency_policy_joining,
	// 						req_onb.primary_induction_offer, req_onb.primary_induction_appointment, req_onb.primary_induction_joining,
	// 						req_onb.cpd_offer, req_onb.cpd_appointment, req_onb.cpd_joining,
	// 						req_onb.provident_fund_comments,
	// 						req_onb.eobi_sessi_comments,
	// 						req_onb.health_takaful_comments,
	// 						req_onb.bank_account_comments,
	// 						req_onb.loan_policy_comments,
	// 						req_onb.child_fee_concession_comments,
	// 						req_onb.timing_punctuality_comments,
	// 						req_onb.probation_confirmation_comments,
	// 						req_onb.notice_period_registration_comments,
	// 						req_onb.dress_code_comments,
	// 						req_onb.tuition_policy_comments,
	// 						req_onb.annual_leave_comments,
	// 						req_onb.emergency_policy_comments,
	// 						req_onb.primary_induction_comments,
	// 						req_onb.cpd_comments

	// 						FROM atif.staff_registered sr
	// 						left join atif_career.career as career on career.nic=sr.nic
	// 						left join atif.staff_child as family on family.staff_id= sr.id
	// 						left join atif.staff_registered_requirements_it as req_it on req_it.staff_id=sr.id
	// 						left join atif.staff_registered_requirements_spacefurniture as req_sf on req_sf.staff_id=sr.id
	// 						left join atif.staff_registered_requirements_transport as req_tp on req_tp.staff_id=sr.id
	// 						left join atif.staff_registered_requirements_joining as req_join on req_join.staff_id=sr.id
	// 						left join atif.staff_registered_requirements_onboarding as req_onb on req_onb.staff_id=sr.id
							
	// 						where sr.nic='$NIC' order by sr.id desc limit 1");
		
		
	// 	if ($query->num_rows() > 0) {
	// 		$rows_array = $query->result_array();
	// 		$result = $rows_array;
	// 	}else{
	// 		$result = $this->get_gcid_of_nic($NIC);
	// 	}

	// 	return $result;
	// }

	public function get_staff_information_of_nic($NIC){
		$result = "";

		$query=$this->db->query("SELECT
							sr.id as staff_id, sr.name, sr.nic, SUBSTRING(sr.gg_id, 1, POSITION('@' IN sr.gg_id)-1) as gg_id, ifnull(career.gc_id,'') as gc_id, sr.mobile_phone, sr.gender,  DATE_FORMAT(sr.dob, '%d-%b-%Y') as dob, DATE_FORMAT(sr.doj, '%d-%b-%Y') as doj, sr.land_line as landline,
							sr.father_name, sr.spouse_name,
							ifnull(CONCAT(LEFT(LPAD(family.gf_id,5,0), 2), '-', RIGHT(LPAD(family.gf_id,5,0), 3)),'') as gf_id,
							sr.gt_id, sr.abridged_name, sr.call_name, sr.name_code,
							ifnull(req_it.desktop,'') as it_desktop, ifnull(req_it.printer,'') as it_printer, ifnull(req_it.other,'') as it_other,
							ifnull(req_sf.table,'') as sf_table, ifnull(req_sf.chair,'') as sf_chair, ifnull(req_sf.shelf,'') as sf_shelf,
							ifnull(req_tp.private,'0') as tp_private, ifnull(req_tp.shuttle,'0') as tp_shuttle,
							ifnull(DATE_FORMAT(req_join.formal_doj, '%d-%b-%Y'),'') as formal_doj, ifnull(req_join.doj_procedure,'') as doj_procedure, ifnull(req_join.photo,'') as photo, ifnull(req_join.joining_policy_induction,'') as joining_policy_induction, ifnull(req_join.smart_card,'') as smart_card, ifnull(req_join.visiting_card,'') as visiting_card,

							req_onb.provident_fund_offer, req_onb.provident_fund_appointment, req_onb.provident_fund_joining,
							req_onb.eobi_sessi_offer, req_onb.eobi_sessi_appointment, req_onb.eobi_sessi_joining,
							req_onb.life_and_health_takaful_offer, req_onb.life_and_health_takaful_appointment, req_onb.life_and_health_takaful_joining,
							req_onb.bank_account_offer, req_onb.bank_account_appointment, req_onb.bank_account_joining,
							req_onb.loan_policy_offer, req_onb.loan_policy_appointment, req_onb.loan_policy_joining,
							req_onb.child_fee_concession_offer, req_onb.child_fee_concession_appointment, req_onb.child_fee_concession_joining,
							req_onb.timing_punctuality_offer, req_onb.timing_punctuality_appointment, req_onb.timing_punctuality_joining,
							req_onb.probation_and_confirmation_offer, req_onb.probation_and_confirmation_appointment, req_onb.probation_and_confirmation_joining,
							req_onb.notice_period_and_resignation_offer, req_onb.notice_period_and_resignation_appointment, req_onb.notice_period_and_resignation_joining,
							req_onb.dress_code_offer, req_onb.dress_code_appointment, req_onb.dress_code_joining,
							req_onb.tuition_policy_offer, req_onb.tuition_policy_appointment, req_onb.tuition_policy_joining,
							req_onb.annual_leave_offer, req_onb.annual_leave_appointment, req_onb.annual_leave_joining,
							req_onb.emergency_policy_offer, req_onb.emergency_policy_appointment, req_onb.emergency_policy_joining,
							req_onb.primary_induction_offer, req_onb.primary_induction_appointment, req_onb.primary_induction_joining,
							req_onb.cpd_offer, req_onb.cpd_appointment, req_onb.cpd_joining,
							req_onb.provident_fund_comments,
							req_onb.eobi_sessi_comments,
							req_onb.health_takaful_comments,
							req_onb.bank_account_comments,
							req_onb.loan_policy_comments,
							req_onb.child_fee_concession_comments,
							req_onb.timing_punctuality_comments,
							req_onb.probation_confirmation_comments,
							req_onb.notice_period_registration_comments,
							req_onb.dress_code_comments,
							req_onb.tuition_policy_comments,
							req_onb.annual_leave_comments,
							req_onb.emergency_policy_comments,
							req_onb.primary_induction_comments,
							req_onb.cpd_comments,
							sci.apartment_no,sci.building_name,sci.plot_no,
							sci.street_name,ifnull(r.name,'') as region,
							ifnull(rs.name,'') as sub_region,
							tpts.mon_in as mon_in_time,tpts.mon_out as mon_out_time,sr.designation,sr.department,
							srfs.name as spouse_name,ifnull(rp.roleCode,'') as role_code

							FROM atif.staff_registered sr
							left join atif_career.career as career on career.nic=sr.nic
							left join atif.staff_child as family on family.staff_id= sr.id
							left join atif.staff_registered_requirements_it as req_it on req_it.staff_id=sr.id
							left join atif.staff_registered_requirements_spacefurniture as req_sf on req_sf.staff_id=sr.id
							left join atif.staff_registered_requirements_transport as req_tp on req_tp.staff_id=sr.id
							left join atif.staff_registered_requirements_joining as req_join on req_join.staff_id=sr.id
							left join atif.staff_registered_requirements_onboarding as req_onb on req_onb.staff_id=sr.id
							left join atif.staff_contact_info sci on sci.staff_id = sr.id
							left join atif._region r on r.id = sci.region
							left join atif._region_sub rs on rs.id = sci.sub_region
							left join atif_gs_events.tt_profile_time_staff tpts on (tpts.staff_id = sr.id and tpts.record_deleted = 0)
							left join atif.staff_registered_father_spouse srfs on (srfs.staff_id = sr.id and srfs.spouseType = 2)
							left join atif_role_org.role_position rp on rp.staff_id = sr.id 
							where sr.nic= '".$NIC."' order by sr.id desc limit 1");
		
		
		if ($query->num_rows() > 0) {
			$rows_array = $query->result_array();
			$result = $rows_array;
		}else{
			$result = $this->get_gcid_of_nic($NIC);
		}

		return $result;
	}


	public function get_gcid_of_nic($NIC){
		$query=$this->db->query("SELECT id as career_id, name, nic, email, gc_id, mobile_phone, gender,  DATE_FORMAT(dob, '%d-%b-%Y') as dob, landline, 
								'' as doj,'' as gt_id, '' as abridged_name, '' as call_name, '' as name_code
								FROM atif_career.career 
								where nic='$NIC' order by id desc limit 1");
		
		$rows_array = $query->result_array();
				
        return $rows_array;
	}	


	public function get_modified_staff_today(){
		$query=$this->db->query("SELECT * FROM `staff_registered` where FROM_UNIXTIME(modified) >= curdate() order by modified desc");
		
		$rows_array = $query->result_array();
				
        return $rows_array;		
	}







	public function get_StaffList_Status(){
		$query=$this->db->query("select sr.*, concat(st.name, ' ', st.code) as staff_status_name from atif.staff_registered as sr left join atif._staffstatus as st on st.id = sr.staff_status");
		
		$rows_array = $query->result();
				
        return $rows_array;		
	}
}