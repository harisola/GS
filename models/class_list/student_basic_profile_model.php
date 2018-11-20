<?php
class Student_basic_profile_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_siblings_data($GRNo){
		$siblings_query =
		"SELECT * FROM class_list WHERE gf_id = 
		(SELECT gf_id FROM student_registered WHERE gr_no = " . $GRNo . ") ORDER BY year_dob ASC";
		$query=$this->db->query($siblings_query); 
		$row = $query->result_array();	
				
		return $row;
	}


	public function get_siblings_data_GSID($GSID){
		$siblings_query =
		"SELECT * FROM class_list WHERE gf_id = 
		(SELECT gf_id FROM student_registered WHERE gs_id = '" . $GSID . "') ORDER BY year_dob ASC";
		$query=$this->db->query($siblings_query); 
		$row = $query->result_array();	
				
		return $row;
	}


	public function get_siblings_data_GFID($GFID){
		$siblings_query = "
		select sr.gr_no, sr.gender, sr.call_name, IFNULL(cl.grade_name,'') as grade_name, IFNULL(cl.section_name,'') as section_name,
		IFNULL(cl.std_status_code, 'A-WDN') as std_status_code, 
		IFNULL(IF(cl.status_color_hex='FFFFFF', '3AEA00', cl.status_color_hex), 'C60310') as status_color_hex
		from atif.student_registered as sr
		left join atif.class_list as cl
			on cl.id = sr.id
		WHERE sr.gf_id = " . $GFID . " ORDER BY sr.year_dob ASC";
		$query=$this->db->query($siblings_query); 
		$row = $query->result_array();	
				
		return $row;
	}


	public function get_parent_data($GFID){
		$parent_query = "SELECT * FROM student_family_record where gf_id = " . $GFID . " order by parent_type asc";
		$query=$this->db->query($parent_query); 
		$row = $query->result_array();	
				
		return $row;
	}


	public function get_student_basic_info($StudentName){
		$cQuery = "SELECT sr.official_name, sr.gender, sr.gs_id, sr.gr_no, 
					CONCAT(LEFT(LPAD(sr.gf_id,5,0), 2), '-', RIGHT(LPAD(sr.gf_id,5,0), 3)) as gf_id,
					student_data.grade_name, student_data.section_name, ifnull(student_data.student_status, 'Alumni') as student_status,
					father.father_name, mother.mother_name
					FROM atif.student_registered sr
					left join (select gf_id, name as father_name from atif.student_family_record where parent_type=1) as father on father.gf_id=sr.gf_id
					left join (select gf_id, name as mother_name from atif.student_family_record where parent_type=2) as mother on mother.gf_id=sr.gf_id
					left join					
						(SELECT 
						student_id, gg.dname as grade_name, ss.dname as section_name, sst.dname as student_status
						FROM student_academic_record sar
						left join atif._academic_session ases on ases.id=sar.academic_session_id
						left join _grade gg on gg.id=sar.grade_id
						left join _section ss on ss.id=sar.section_id
						left join _student_status sst on sst.id=sar.status_id
						where ases.is_active=1) as student_data on student_data.student_id=sr.id
					where sr.official_name like '%" . $StudentName . "%'";

		$query=$this->db->query($cQuery); 
		$row = $query->result_array();	
				
		return $row;	
	}




	public function get_parent_data_rfidDec($RFID_Dec){
		
		$cQuery = "
		SELECT Visitor.*, if(ap.date is null, 0, 1) as marked,
		IFNULL(dap.color_hex, 'FFFFFF') as dap_color, IFNULL(dap.code, '') as dap_code FROM
		(select
			sfr.gf_id, sfr.name, sfr.parent_type, sfr.rfid_dec, sfr.nic, sfr.mobile_phone
			from atif.student_family_record as sfr
			where sfr.gf_id = (select gf_id from atif.student_family_record where rfid_dec = '$RFID_Dec' limit 1)

		union

		select
			sfr.gf_id, sfr.name, sfr.parent_type, sfr.rfid_dec, sfr.nic, sfr.mobile_phone
			from atif.student_family_record as sfr
			where sfr.gf_id = (select REPLACE(v.description, '-', '') as gf_id from atif_visitors.visitor as v
				where DATE_FORMAT(FROM_UNIXTIME(v.created), '%Y-%m-%d') = curdate()
				and v.rfid_dec = '$RFID_Dec' order by v.id desc limit 1)
		) AS Visitor

		left join atif_visitors.allowed_parents as ap
		on ap.gf_id = Visitor.gf_id
		and ap.date = curdate()
		
		left join (select gf_id, color_hex, code from atif_visitors.disallowed_parent where date=curdate()) as dap
		on dap.gf_id = Visitor.gf_id
		order by parent_type";

		$query=$this->db->query($cQuery); 
		$row = $query->result_array();	
				
		return $row;
	}




	public function checkIsParentIN($RFID_Dec, $location_id){
		
		$cQuery = "select
			v.id, v.time_out
			from atif_visitors.visitor as v
			where DATE_FORMAT(FROM_UNIXTIME(v.created), '%Y-%m-%d') = curdate()
			and v.rfid_dec = '$RFID_Dec' ";	
			
			$cQuery .= " and v.campus_id='$location_id' "; 
			
			if($location_id==4){ }else{ }
			
			$cQuery .= "order by v.id desc";
			
			

		$query=$this->db->query($cQuery); 
		$row = $query->result_array();	
				
		return $row;
	}
}