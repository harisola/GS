<?php
class Student_directory_model extends MY_Model{
	protected $_table_name = 'class_list';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'grade_id asc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct()
	{
		parent::__construct();
	}

	public function getAllStudentsData()
	{
		$cQuery = "select
				cl.call_name, cl.abridged_name, cl.official_name, cl.dob, cl.grade_id, cl.grade_name, cl.section_name,
				cl.house_name, cl.house_dname, cl.house_color_hex, cl.gender, cl.gr_no, cl.gs_id, cl.std_status_code as student_status_name,
				CONCAT(LEFT(LPAD(cl.gf_id,5,0), 2), '-', RIGHT(LPAD(cl.gf_id,5,0), 3)) as gf_id,
				father.name as father_name, father.nic as father_nic, father.mobile_phone as father_mobile_phone,
				father.speciality as father_speciality, father.profession as father_profession,
				mother.name as mother_name, mother.nic as mother_nic, mother.mobile_phone as mother_mobile_phone,
				mother.speciality as mother_speciality, mother.profession as mother_profession,
				sci.phone as home_phone, sci.apartment_no, sci.building_name, sci.plot_no, sci.street_name, sci.sub_region, sci.region,
				father_org.organization as father_organization, father_org.department as father_department,
				father_org.designation as father_desgination, father_org.phone as father_org_phone,
				mother_org.organization as mother_organization, mother_org.department as mother_department,
				mother_org.designation as mother_desgination, mother_org.phone as mother_org_phone

				from atif.class_list cl
				left join (select gf_id, name, nic, mobile_phone, speciality, profession from atif.student_family_record where parent_type = 1)
							as father on father.gf_id = cl.gf_id
				left join (select gf_id, name, nic, mobile_phone, speciality, profession from atif.student_family_record where parent_type = 2)
							as mother on mother.gf_id = cl.gf_id
				left join (SELECT gf_id, phone, apartment_no, building_name, plot_no, street_name, sub_region, region FROM `student_contact_info` group by gf_id order by sub_region desc)
							as sci on sci.gf_id = cl.gf_id
				left join (select gf_id, organization, department, designation, phone, address, sub_region, region, city, country
							from student_family_work_detail where parent_type = 1)
							as father_org on father_org.gf_id = cl.gf_id
				left join (select gf_id, organization, department, designation, phone, address, sub_region, region, city, country
							from student_family_work_detail where parent_type = 2)
							as mother_org on mother_org.gf_id = cl.gf_id							
				group by cl.gs_id";

							
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}
}