<?php
class Class_list_sr_view_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}


	public function get_all_classes_fee_detail()
	{				
		$class_query = "SELECT
		student_family_record.name as father_name,
		class_list.id, class_list.official_name, class_list.abridged_name, class_list.call_name, class_list.prefix_name, class_list.suffix_name,
		class_list.first_name, class_list.last_name, class_list.gender, class_list.dob, class_list.year_dob, class_list.nationality_1, class_list.nationality_2,
		class_list.religion, class_list.year_of_admission, class_list.grade_of_admission, class_list.previous_school, class_list.mobile_phone,
		class_list.email, class_list.facebook, class_list.linkedin, class_list.gr_no, class_list.gs_id, class_list.gf_id, class_list.staff_child,
		class_list.siblings_position, class_list.record_deleted, class_list.previous_class, class_list.student_group, class_list.detain, class_list.class_no,
		class_list.rfid_dec_no, class_list.rfid_hex_no, class_list.is_rfid_blocked, class_list.status_remarks, class_list.academic_session_id,
		class_list.academic_session_is_active, class_list.grade_id, class_list.grade_name, class_list.grade_dname, class_list.complete_in_years,
		class_list.section_id, class_list.section_name, class_list.section_dname, class_list.wing_name, class_list.wing_order, class_list.section_position,
		class_list.house_name, class_list.house_dname, class_list.house_short_name, class_list.house_position, class_list.house_red, class_list.house_green, 
		class_list.house_blue, class_list.house_color_hex, class_list.house_color_font, class_list.student_status_name, class_list.student_status_dname, class_list.std_status_code,
		class_list.siblings_total, class_list.generation_of,
		if(feeBill_AugSep.arrears_and_advance<0, 'Yes', if(feeBill_AugSep.augsep_received_amount>0, 'Yes', 'No')) as feeAugSep
		FROM class_list
		left join (select * from student_family_record where parent_type = 1) as student_family_record on student_family_record.gf_id = class_list.gf_id

		left join 
			(select fb.student_id, ifnull(fb.received_amount,0) as augsep_received_amount,
					ana.amount as arrears_and_advance							
				from atif_fee.fee_bill fb
				left join (select student_id, amount from atif_fee.arrears_and_advance) as ana on ana.student_id=fb.student_id
				where fb.is_void=0 and fb.record_deleted=0 
				and fb.academic_session_id>=5 and fb.academic_session_id <=6
				and fb.bill_cycle_id=1						
			) as feeBill_AugSep on feeBill_AugSep.student_id=class_list.id				
		where (student_status_name = 'active' or student_status_name = 'inactive') order by call_name asc";
		
		$query=$this->db->query($class_query); 
		$row = $query->result_array();	
				
		return $row;
	}



	public function get_all_classes($where1, $where2, $withdrawal = NULL){
		if($withdrawal == NULL)
		{
			$class_query = "SELECT * FROM class_list WHERE (" . $where1 . ") AND (" . $where2 . ") order by call_name asc";
		}else{
			$class_query = "SELECT
				student_family_record.name as father_name, student_family_record2.name as mother_name,
				class_list.id, class_list.official_name, class_list.abridged_name, class_list.call_name, class_list.prefix_name, class_list.suffix_name,
				class_list.first_name, class_list.last_name, class_list.gender, class_list.dob, class_list.year_dob, class_list.nationality_1, class_list.nationality_2,
				class_list.religion, class_list.year_of_admission, class_list.grade_of_admission, class_list.previous_school, class_list.mobile_phone,
				class_list.email, class_list.facebook, class_list.linkedin, class_list.gr_no, class_list.gs_id, 
				Concat(Left(Lpad(class_list.gf_id, 5, 0),2),'-',Right(Lpad(class_list.gf_id, 5, 0),3)) as gf_id, class_list.staff_child,
				class_list.siblings_position, class_list.record_deleted, class_list.previous_class, class_list.student_group, class_list.detain, class_list.class_no,
				class_list.rfid_dec_no, class_list.rfid_hex_no, class_list.is_rfid_blocked, class_list.status_remarks, class_list.academic_session_id,
				class_list.academic_session_is_active, class_list.grade_id, class_list.grade_name, class_list.grade_dname, class_list.complete_in_years,
				class_list.section_id, class_list.section_name, class_list.section_dname, class_list.wing_name, class_list.wing_order, class_list.section_position,
				class_list.house_name, class_list.house_dname, class_list.house_short_name, class_list.house_position, class_list.house_red, class_list.house_green, 
				class_list.house_blue, class_list.house_color_hex, class_list.house_color_font, class_list.student_status_name, class_list.student_status_dname, class_list.std_status_code,
				class_list.siblings_total, class_list.generation_of,
				if(feeBill_AugSep.arrears_and_advance<0, 'Yes', if(feeBill_AugSep.augsep_received_amount>0, 'Yes', 'No')) as feeAugSep
				FROM class_list
				left join (select * from student_family_record where parent_type = 1) as student_family_record on student_family_record.gf_id = class_list.gf_id
				left join (select * from student_family_record where parent_type = 2) as student_family_record2 on student_family_record2.gf_id = class_list.gf_id

				left join 
					(select fb.student_id, ifnull(fb.received_amount,0) as augsep_received_amount,
							ana.amount as arrears_and_advance							
						from atif_fee.fee_bill fb
						left join (select student_id, amount from atif_fee.arrears_and_advance) as ana on ana.student_id=fb.student_id
						where fb.is_void=0 and fb.record_deleted=0 
						and fb.academic_session_id>=5 and fb.academic_session_id <=6
						and fb.bill_cycle_id=1						
					) as feeBill_AugSep on feeBill_AugSep.student_id=class_list.id				
				where (" . $where1 . ") AND (" . $where2 . ") AND (student_status_name = 'active' or student_status_name = 'inactive') order by call_name asc";
		}
		$query=$this->db->query($class_query); 
		$row = $query->result_array();	
				
		return $row;
	}


	public function get_all_classes_attendance($where1, $where2, $withdrawal = NULL){
		if($withdrawal == NULL)
		{
			$class_query = "SELECT * FROM attendance_student_today WHERE (" . $where1 . ") AND (" . $where2 . ") order by call_name asc";
		}else{
			$class_query = "SELECT * FROM attendance_student_today WHERE (" . $where1 . ") AND (" . $where2 . ") AND (student_status_name = 'active' or student_status_name = 'inactive') 
							order by grade_id asc, section_id asc, call_name asc";
		}
		$query=$this->db->query($class_query); 
		$row = $query->result_array();	
		

		return $row;
	}



	public function getGSID_AbsentStudent($ID){
		$getGSID = "";
		$query=$this->db->query("SELECT gs_id FROM class_list WHERE id = " . $ID); 		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$getGSID = $row['gs_id'];
		}
		return $getGSID;
	}



	public function get_all_sections_of($GradeID){
		$class_query = "SELECT section_id, section_name FROM class_list WHERE grade_id = '" . $GradeID . "' group by section_name order by section_id asc";
		
		$query=$this->db->query($class_query); 
		//$row = $query->result_array();

		// if there are suboptinos for this option...
		if($query->num_rows() > 0){
			$suboptions_arr;

			// Format for passing into jQuery loop

			foreach ($query->result() as $suboption) {
				$suboptions_arr[$suboption->section_id] = $suboption->section_name;
			}

			return $suboptions_arr;
		}

		return;
	}



	public function get_all_sections_of_grade($GradeName){
		$class_query = "SELECT section_id, section_name FROM class_list WHERE grade_name = '" . $GradeName . "' group by section_name order by section_id asc";
		$query=$this->db->query($class_query); 
		//$row = $query->result_array();

		// if there are suboptinos for this option...
		if($query->num_rows() > 0){
			$query=$this->db->query($class_query); 
			$row = $query->result_array();
			return $row;
		}

		return;
	}


	public function get_all_grade_name(){		
		$class_query = "select grade_id, grade_name from class_list group by grade_name order by grade_id asc";
	
		$query=$this->db->query($class_query); 
		$row = $query->result_array();

		return $row;
	}	



	public function get_students_info_of($GradeID, $SectionID){		
		$class_query = "select
			cl.gs_id, cl.official_name, cl.abridged_name, cl.call_name,
			cl.dob, cl.gender,
			CONCAT(LEFT(LPAD(cl.gf_id,5,0), 2), '-', RIGHT(LPAD(cl.gf_id,5,0), 3)) as gf_id,
			father.name as father_name, mother.name as mother_name,
			cl.house_name, cl.grade_name, cl.section_name, CONCAT(cl.grade_name, '-', cl.section_name) as grade_section,
			cl.student_status_name, cl.std_status_code,
			student_siblings_total_active.siblings_total AS active_siblings_total,
			CONCAT(previous_cl.grade_name, '-', previous_cl.section_name) as previous_grade_section,
			DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE, cl.dob)),'%y Years %m Months') AS age_ym,
			DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE, cl.dob)),'%y Years %m Months %d Days') AS age_ymd,
			cl.siblings_position, cl.active_siblings_position, cl.siblings_total, pet.petitioner_code
			from atif.class_list cl
			left join atif.class_list_1516 previous_cl on previous_cl.id = cl.id
			left join (select * from atif.student_family_record where parent_type = 1) as father on father.gf_id = cl.gf_id
			left join (select * from atif.student_family_record where parent_type = 2) as mother on mother.gf_id = cl.gf_id
			left Join (select * from atif_gs_events.1509_petitioners where pay_regular_fee = 0) as pet on pet.gf_id = cl.gf_id
			left join student_siblings_total_active on student_siblings_total_active.gf_id = cl.gf_id

			where cl.grade_id ='" . $GradeID . "' and cl.section_id = '" . $SectionID . "'
			and cl.student_status_name != 'withdrawal' and cl.student_status_name != 'deregister'
			group by cl.gs_id
			order by cl.grade_id asc, cl.section_id asc, cl.call_name asc";
	
		$query=$this->db->query($class_query); 
		$row = $query->result_array();	
				
		return $row;
	}




	public function get_students_info_of_GS($GradeID, $SectionID){
		$class_query = "SELECT * FROM (

			/****************************************** Student
			****************************************************/
			select

			cl.id, cl.official_name, cl.abridged_name, cl.call_name, cl.prefix_name, cl.suffix_name, cl.first_name, cl.last_name,
			cl.gender, cl.dob, cl.year_dob, cl.nationality_1, cl.nationality_2, cl.religion, cl.year_of_admission, cl.grade_of_admission,
			cl.previous_school, cl.mobile_phone, cl.email, cl.facebook, cl.linkedin, cl.gr_no, cl.gs_id, cl.gfid as gf_id, cl.staff_child,
			cl.siblings_position, cl.active_siblings_position, cl.record_deleted, cl.previous_class, cl.student_group,
			cl.detain, cl.class_no, cl.rfid_dec_no, cl.rfid_hex_no, cl.is_rfid_blocked, cl.status_remarks, cl.academic_session_id,
			cl.academic_session_is_active, cl.grade_id, cl.grade_name, cl.grade_dname, cl.complete_in_years, cl.section_id, cl.section_name,
			cl.section_dname, cl.wing_name, cl.wing_order, cl.section_position, cl.house_name, cl.house_dname, cl.house_short_name, cl.house_position,
			cl.house_red, cl.house_green, cl.house_blue, cl.house_color_hex, cl.house_color_font, cl.status_id, cl.student_status_name, cl.student_status_dname,
			cl.std_status_id, cl.std_status_name, cl.std_status_code, cl.std_status_category, cl.campus, cl.siblings_total, cl.generation_of, cl.gfid,
			IFNULL(tc.staff_name, '') as class_teacher, IFNULL(tco.staff_name, '') as co_teacher, IFNULL(tr.staff_name, '') as reading_teacher,
			IFNULL(tc.employee_id, '') as class_teacher_photo_id, 
			IFNULL(tco.employee_id, '') as co_teacher_photo_id, 
			IFNULL(tr.employee_id, '') as reading_teacher_photo_id,
			1 AS student_order,
			father.name as father_name, mother.name as mother_name,
			student_siblings_total_active.siblings_total AS active_siblings_total,
			CONCAT(previous_cl.grade_name, '-', previous_cl.section_name) as previous_grade_section,
			DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE, cl.dob)),'%y Years %m Months') AS age_ym,
			DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE, cl.dob)),'%y Years %m Months %d Days') AS age_ymd,
			pet.petitioner_code,cl.created

			from atif.class_list as cl

			left join atif_role_matrix.teacher_class as tc 
			 	on tc.grade_id = cl.grade_id
			 	and tc.section_id = cl.section_id
			 	and tc.academic_session_id = cl.academic_session_id
			 
			left join atif_role_matrix.teacher_co as tco
			 	on tco.grade_id = cl.grade_id
			 	and tco.section_id = cl.section_id
			 	and tco.academic_session_id = cl.academic_session_id

			left join atif_role_matrix.teacher_reading as tr
			 	on tr.grade_id = cl.grade_id
			 	and tr.section_id = cl.section_id
			 	and tr.academic_session_id = cl.academic_session_id	

			left join atif.class_list_1617 previous_cl on previous_cl.id = cl.id
			left join (select * from atif.student_family_record where parent_type = 1) as father on father.gf_id = cl.gf_id
			left join (select * from atif.student_family_record where parent_type = 2) as mother on mother.gf_id = cl.gf_id
			left Join (select * from atif_gs_events.1509_petitioners where pay_regular_fee = 0) as pet on pet.gf_id = cl.gf_id
			left join student_siblings_total_active on student_siblings_total_active.gf_id = cl.gf_id
			 	

			where cl.grade_id = $GradeID 
			  and cl.section_id = $SectionID
			  #and cl.std_status_category = 'Student'

			group by cl.gs_id
			/****************************************************/


		

			) AS StudentData

			order by grade_id, section_id,
			class_no=0,class_no,created,call_name;";



	
		$query=$this->db->query($class_query); 
		$row = $query->result_array();	
				
		return $row;
	}










	public function get_all_grade_section($UserID){		
		$class_query = "select
			cl.grade_id, cl.grade_name, cl.section_id, cl.section_name, cla.academic_session_id 

			from atif.users u
			left join atif.staff_registered as sr on sr.user_id=u.id
			left join atif.cl_access_configuration as cla on cla.staff_id=sr.id
			left join atif.class_list as cl on cl.grade_id = cla.grade_id


			where u.id = $UserID
			and cla.academic_session_id >= $this->AcademicSessionFrom
			and cla.academic_session_id <= $this->AcademicSessionTo


			group by cl.grade_name, cl.section_name 

			order by cl.grade_id asc, cl.section_id asc";
	
		$query=$this->db->query($class_query); 
		$row = $query->result_array();

		return $row;
	}








	public function get_all_grade_section_students($GradeName, $SectionName){		
		$class_query = "select id, gs_id, abridged_name, grade_id, grade_name, section_id, section_name, std_status_code from class_list where grade_name = '$GradeName' and section_name = '$SectionName' group by gs_id order by call_name asc";
	
		$query=$this->db->query($class_query); 
		$row = $query->result_array();

		return $row;
	}




















	public function get_all_grades($UserID){		
		$class_query = "select
			cl.grade_id, cl.grade_name, cl.section_id, cl.section_name, cla.academic_session_id 

			from atif.users u
			left join atif.staff_registered as sr on sr.user_id=u.id
			left join atif.cl_access_configuration as cla on cla.staff_id=sr.id
			left join atif.class_list as cl on cl.grade_id = cla.grade_id


			where u.id = $UserID
			and cla.academic_session_id >= $this->AcademicSessionFrom
			and cla.academic_session_id <= $this->AcademicSessionTo


			group by cl.grade_name

			order by cl.grade_id asc, cl.section_id asc";
	
		$query=$this->db->query($class_query); 
		$row = $query->result_array();

		return $row;
	}

	
}