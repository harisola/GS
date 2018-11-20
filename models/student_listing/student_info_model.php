<?php
class Student_info_model extends MY_Model{
	
	private $ddb;
	
	function __construct(){ parent::__construct(); }
	
	
	public function get_grade_section_students($grade_id,$section_id){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "select 
			cl.id as Student_Id,
			cl.official_name as O_Name, 
			cl.abridged_name as Abridged_Name,
			cl.call_name as C_Name,
			cl.grade_name as Grade_Name, 
			cl.section_name as Section_Name,
			cl.std_status_code as Statud_Code,
			cl.class_no as Roll_no,
			cl.gs_id as GS_ID,
			cl.status_color_hex as Status_Color,
			sap.academic as P_Academic,
			sap.social  as P_Social,
			sap.parental as P_Parental,
			sap.accounts as P_Accounts,
			sap.p_support as P_Support,
			sap.p_conduct as P_Conduct,
			atd.last10Days,
			atd60.last60Days
			from 
			atif.class_list as cl 
			join atif_gs_events.student_academic_profile  as sap
			on(sap.gs_id = cl.gs_id)
			
					Left Join ( select st.gs_id, count(st.id) AS last10Days from atif_attendance.student_attendance as st
							left join  atif_attendance.`attendance_calendar`as  ac  
							on(ac.date=st.date)
							where 
							DATE(ac.`date`) BETWEEN DATE_SUB(NOW(),INTERVAL 10 DAY) and DATE_SUB(NOW(),INTERVAL 0 DAY) and ac.is_on=1
							group by st.gs_id) as atd
 					on atd.gs_id = cl.gs_id
							
	
			Left Join (select st60.gs_id, count(st60.id) AS last60Days from atif_attendance.student_attendance as st60
							left join  atif_attendance.`attendance_calendar`as  ac60
							on(ac60.date=st60.date)
							where 
							DATE(ac60.`date`) BETWEEN DATE_SUB(NOW(),INTERVAL 60 DAY) and DATE_SUB(NOW(),INTERVAL 0 DAY) and ac60.is_on=1
							group by st60.gs_id) as atd60
							on atd60.gs_id = cl.gs_id
							
			 where grade_id=".$grade_id." and section_id=".$section_id." order by section_name, abridged_name asc";
		$result = $this->ddb->query( $query );
		//echo $this->ddb->last_query();
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->result_array();
		return $results;
		}else{ return FALSE; }
	}
	
	
	
	
	// Get Student Info
	public function get_student_profile($student_id){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "select cl.*, 
		
			sap.academic as P_Academic,
			sap.social  as P_Social,
			sap.parental as P_Parental,
			sap.accounts as P_Accounts,
			sap.p_support as P_Support,
			sap.p_conduct as P_Conduct,
			atd.last10Days,
			atd60.last60Days
			
		from atif.class_list as cl  
		join atif_gs_events.student_academic_profile  as sap
		on(sap.gs_id = cl.gs_id)
		

		Left Join (select st.gs_id, count(st.id) AS last10Days from atif_attendance.student_attendance as st
							left join  atif_attendance.`attendance_calendar`as  ac  
							on(ac.date=st.date)
							where 
							DATE(ac.`date`) BETWEEN DATE_SUB(NOW(),INTERVAL 10 DAY) and DATE_SUB(NOW(),INTERVAL 0 DAY) and ac.is_on=1
							group by st.gs_id) as atd
 					on atd.gs_id = cl.gs_id
							
	
			Left Join (select st60.gs_id, count(st60.id) AS last60Days from atif_attendance.student_attendance as st60
							left join  atif_attendance.`attendance_calendar`as  ac60
							on(ac60.date=st60.date)
							where 
							DATE(ac60.`date`) BETWEEN DATE_SUB(NOW(),INTERVAL 60 DAY) and DATE_SUB(NOW(),INTERVAL 0 DAY) and ac60.is_on=1
							group by st60.gs_id) as atd60
							on atd60.gs_id = cl.gs_id

							
		where cl.id = ".$student_id."";
		
		
		$result = $this->ddb->query( $query );
		//echo $this->ddb->last_query();
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
		
	}
	
	
	// Get Student Info
	public function get_student_by_id($student_id){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "select * from atif.class_list as cl where cl.id = ".$student_id."";
		$result = $this->ddb->query( $query );
		//echo $this->ddb->last_query();
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
		
	}
	
	public function get_parents_info($gf_id){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "select * from atif.student_family_record where gf_id='".$gf_id."'";
		$result = $this->ddb->query($query);
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->result_array();
		return $results;
		}else{ return FALSE; }
		
	}
	
	// student_family_work_detail
	public function student_family_work_detail($gf_id){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "select * from atif.student_family_work_detail as fw where fw.gf_id='".$gf_id."'";
		$result = $this->ddb->query($query);
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->result_array();
		return $results;
		}else{ return FALSE; }
		
	}
	
	public function count_students($grade_id,$section_id ){
		$this->ddb = $this->load->database('default',TRUE);
		

$query = "select
count(*) as Total,
sum(if(cl.gender='B' and cl.std_status_category='Student', 1, 0)) as Total_Boys,
sum(if(cl.gender='G' and cl.std_status_category='Student', 1, 0)) as Total_Girls,
sum(if(cl.gender='B' and cl.std_status_category='Fence', 1, 0)) as Total_Boys_Fence,
sum(if(cl.gender='G' and cl.std_status_category='Fence', 1, 0)) as Total_Girls_Fence,
sum(if(cl.gender='B' and cl.std_status_category='Student' and atd.time is not null, 1, 0)) as Today_Boys,
sum(if(cl.gender='G' and cl.std_status_category='Student' and atd.time is not null, 1, 0)) as Today_Girls,
sum(if(cl.gender='B' and cl.std_status_category='Fence' and atd.time is not null, 1, 0)) as Today_Boys_Fence,
sum(if(cl.gender='G' and cl.std_status_category='Fence' and atd.time is not null, 1, 0)) as Today_Girls_Fence,
sum(if(cl.std_status_category='Fence' and atd.time is not null, 1, 0)) as Today_Fence,
sum(if( atd.time is null,1,0) ) as Today_Absents

from atif.class_list as cl
left join 
	(select gs_id, time from atif_attendance.student_attendance 
		where date=curdate()
		group by gs_id) as atd
	on atd.gs_id = cl.gs_id	
	
where cl.grade_id=".$grade_id." and cl.section_id=".$section_id." and
(cl.std_status_category='Student' or cl.std_status_category='Fence')
group by cl.grade_id, cl.section_id";

		$result = $this->ddb->query($query);
		//echo $this->ddb->last_query(); exit;
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
		
	}
	
	
	public function get_grade_co_Teacher($grade_id,$section_id){
		$this->ddb = $this->load->database('default',TRUE);
		/*$query = "SELECT 
					sr.id as StaffID,
					sr.abridged_name AS Teacher_Name,
					sr.employee_id AS Image_ID,
					rc.gp_id AS Teacher_Type,
					sr.user_id as User_Id,
					if(ct.staff_name != '','Y','N') AS Class_teacher,
					if(coot.staff_name != '', 'Y', 'N') AS Co_Teacher
					FROM atif.staff_registered as sr
					LEFT JOIN atif_role_matrix.role_class_teacher AS rc
					ON(rc.staff_id = sr.id)
					LEFT JOIN atif_role_matrix.teacher_class as ct
					ON( ct.employee_id = sr.employee_id)
					LEFT JOIN atif_role_matrix.teacher_co as coot
					ON( coot.employee_id = sr.employee_id)
					WHERE rc.grade_id=".$grade_id." AND rc.section_id=".$section_id." order by rc.gp_id";*/
					
					$query = "SELECT 
				
				sr.id as StaffID,
					sr.abridged_name AS Teacher_Name,
					sr.employee_id AS Image_ID,

					sr.user_id as User_Id,
					if(ov.type_name ='Class Teacher', 'Class_teacher','') AS Class_teacher,
					if(ov.type_name ='Co Teacher', 'Co_Teacher','') AS Co_Teacher
					
					FROM atif.staff_registered as sr
					
					left join atif_role.role_in_org_view as ov
					
					on(ov.employee_id = sr.employee_id )
					
					WHERE ov.grade_id=".$grade_id." and ov.section_id=".$section_id."
						and ( ov.type_id = 15 || ov.type_id=16)";

		$result = $this->ddb->query($query);
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->result_array();
		return $results;
		}else{ return FALSE; }
		
	}
	
	public function last10OnDays(){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "select * from atif_attendance.student_attendance as st
		left join  atif_attendance.`attendance_calendar`as  ac  
		on(ac.date=st.date)
		where st.gs_id='08-404' and 
		ac.`is_on`=1 and ( ac.`date` >= DATE(NOW()) - INTERVAL 10 DAY )";
		$result = $this->ddb->query($query);
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
	}
	
	public function getGradeSectionTotal($grade_id,$section_id){
		$this->ddb = $this->load->database('default',TRUE);
		$query="select  
		COUNT(CASE WHEN ct.std_status_category='fence' THEN 1 END) AS Grade_Section_Fence,
		count(ct.official_name) as Grade_Section_Total
		from atif.class_list as ct 
		where ct.grade_id=".$grade_id." and ct.section_id=".$section_id."";
		$result = $this->ddb->query($query);
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
		
	}
	 
	
		
	
	public function masterlist($grade_id=NULL,$section_id=NULL,$gs_id=NULL){
		
		$this->ddb = $this->load->database('default',TRUE);
		
		$AtdCalQuery = "select
			atd_cl.date, atd_cl.islami_date, atd_cl.islami_month, atd_cl.is_on,
			sum(atd_cl.pn) as pn, sum(atd_cl.n) as n, sum(atd_cl.kg) as kg,
			sum(atd_cl.i) as i, sum(atd_cl.ii) as ii,
			sum(atd_cl.iii) as iii, sum(atd_cl.iv) as iv, sum(atd_cl.v) as v, sum(atd_cl.vi) as vi,
			sum(atd_cl.vii) as vii, sum(atd_cl.viii) as viii, sum(atd_cl.ix) as ix, sum(atd_cl.x) as x, sum(atd_cl.xi) as xi,
			sum(atd_cl.a1) as a1, sum(atd_cl.a2) as a2


			from
				(select * from	
					(select 
						atd_cl.date, atd_cl.islami_date, atd_cl.islami_month, atd_cl.is_on,
						atd_cl.pn, atd_cl.n, atd_cl.kg,
						atd_cl.i, atd_cl.ii,
						atd_cl.iii, atd_cl.iv, atd_cl.v, atd_cl.vi,
						atd_cl.vii, atd_cl.viii, atd_cl.ix, atd_cl.x, atd_cl.xi,
						atd_cl.a1, atd_cl.a2
					from atif_attendance.attendance_calendar as atd_cl
					
					where atd_cl.date <= curdate()
					and is_on = 1
					
					order by atd_cl.date desc
					
					limit 10) as atd_cl
					order by atd_cl.date) as atd_cl	
				group by atd_cl.is_on";
		$cQuery = $AtdCalQuery;
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();

	
			
   		 $AtdCalQuery = "select
		cl.id as Student_Id,
		cl.gs_id as GS_ID,
		cl.gfid as GF_ID, 
		cl.abridged_name as Abridged_Name,
		cl.official_name as O_Name,
		cl.call_name as C_Name,
		cl.std_status_code as Statud_Code, 
		cl.grade_name as Grade_Name, 
		cl.section_name as Section_Name, 
		cl.gender as Gender,
		cl.class_no as Roll_no,
		cl.status_color_hex as Status_Color,
		
		father.name as father_name, father.mobile_phone as father_mobile_phone,
		mother.name as mother_name, mother.mobile_phone as mother_mobile_phone,
		
		activecc.id as activecase_case_id, IFNULL(activecc.close_category_id, '') as close_category_id,
		IFNULL(last_atd.ldate, '') AS last_atd_date, cl.total_wd, cl.total_p, (cl.total_wd - cl.total_p) as total_a,
		'' as total_l, '' as daypass_used_ten,
		
			sap.academic as P_Academic,
			sap.social  as P_Social,
			sap.parental as P_Parental,
			sap.accounts as P_Accounts,
			sap.p_support as P_Support,
			sap.p_conduct as P_Conduct,
			 absent.case_name as Case_ID

		from
			(select
			cl.id,cl.gs_id, cl.abridged_name, cl.official_name, cl.call_name, cl.std_status_code, cl.grade_name, cl.section_name,
			cl.gf_id, cl.gfid, cl.gender,cl.class_no,cl.status_color_hex,cl.grade_id,cl.section_id,
			IF(cl.grade_id = 1, " . $row[0]['pn'] . ",
				IF(cl.grade_id = 2, " . $row[0]['n'] . ",
				IF(cl.grade_id = 3, " . $row[0]['kg'] . ",
				IF(cl.grade_id = 4, " . $row[0]['i'] . ",
				IF(cl.grade_id = 5, " . $row[0]['ii'] . ",
				IF(cl.grade_id = 6, " . $row[0]['iii'] . ",
				IF(cl.grade_id = 7, " . $row[0]['iv'] . ",
				IF(cl.grade_id = 8, " . $row[0]['v'] . ",
				IF(cl.grade_id = 9, " . $row[0]['vi'] . ",
				IF(cl.grade_id = 10, " . $row[0]['vii'] . ",
				IF(cl.grade_id = 11, " . $row[0]['viii'] . ",
				IF(cl.grade_id = 12, " . $row[0]['ix'] . ",
				IF(cl.grade_id = 13, " . $row[0]['x'] . ",
				IF(cl.grade_id = 14, " . $row[0]['xi'] . ",
				IF(cl.grade_id = 15, " . $row[0]['a1'] . ",
				IF(cl.grade_id = 16, " . $row[0]['a2'] . ", ''
				)))))))))))))))) as total_wd,
			IFNULL(atd.total_p, 0) as total_p
			from atif.class_list as cl
			left join
				(select
					atd.date, atd.gs_id, atd.gr_no,
					count(atd.date) as total_p
					from
						(select
						atd_cl.date, atd.gs_id, atd.gr_no
						from
						atif_attendance.attendance_calendar as atd_cl
						left join atif_attendance.student_attendance as atd
							on atd.date = atd_cl.date
						where 
							atd_cl.date >='".$row[0]['date']."'
						and atd_cl.date <= curdate()
						and atd_cl.is_on = 1
						group by atd.gs_id, atd.date) as atd
					group by atd.gs_id) as atd
				on atd.gs_id = cl.gs_id
			
			order by cl.grade_id, cl.section_id, cl.call_name) as cl
		left join (select
			atd2.gs_id, max(atd2.date) as ldate
			from atif_attendance.student_attendance as atd2
			group by atd2.gs_id) as last_atd
			on last_atd.gs_id = cl.gs_id
		left join (select gf_id, name, mobile_phone from atif.student_family_record where parent_type=1) as father
			on father.gf_id = cl.gf_id
		left join (select gf_id, name, mobile_phone from atif.student_family_record where parent_type=2) as mother
			on mother.gf_id = cl.gf_id
		left join (select * from atif_attendance.activecase_case where close_category_id = 0) activecc on activecc.gs_id = cl.gs_id 
		left join atif_gs_events.student_academic_profile  as sap on(sap.gs_id = cl.gs_id)
		left join (
select ac.gs_id, cat.name as case_name from atif_attendance.activecase_case  as ac
left join atif_attendance.activecase_category as cat
on(cat.id=ac.category_id)
where from_unixtime(ac.created, '%Y-%m-%d') = curdate() 
) as absent
on(absent.gs_id=cl.gs_id)";

		
		if( $grade_id != NULL && $section_id != NULL ){
			$AtdCalQuery .= " where cl.grade_id=".$grade_id." and cl.section_id=".$section_id." group by cl.gs_id";
		}else{
			//$AtdCalQuery .= " limit 1";
			$AtdCalQuery .= " where cl.gs_id='".$gs_id."'";
		}
		

		$cQuery = $AtdCalQuery;
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();

   		return $row;  
		
	}
	
	
	
	public function present_verfication($grade_id,$section_id){
		$this->ddb = $this->load->database('default',TRUE);
		
		$query =" select
			 tpa_rpt.id, tpa_rpt.formal_name_id, tpa_rpt.formal_name, tpa_rpt.domain_name, tpa_rpt.type_name,
			tpa_rpt.gr_id, tpa_rpt.grade_name, tpa_rpt.section_name, tpa_rpt.date, tpa_rpt.ip4,
			tpa_rpt.login_time, tpa_rpt.confirm_tpa, tpa_rpt.logout_time, tpa_rpt.atd_changes

			from
			(select DISTINCT  verification.id, verification.formal_name_id,verification.formal_name, verification.domain_name, 
			verification.type_name, verification.gr_id, verification.grade_name, verification.section_name, 
			verification.date, verification.ip4,
						from_unixtime(verification.login_time, '%h:%i:%s') as login_time,
						from_unixtime(verification.created, '%h:%i:%s') as confirm_tpa,
						from_unixtime(verification.logout_time, '%h:%i:%s') as logout_time,
					  	verification.atd_changes
						
						
					  	from
						(select staff.id, staff.formal_name_id, staff.formal_name, staff.domain_name, staff.type_name, staff.gr_id, 
						staff.wing_name, staff.grade_name, staff.section_name,
						avt.date, avt.ip4, avt.created, login.created as login_time, logout.created as logout_time,
						 atd_change.atd_changes, 
						staff.subject_name, staff.grade_id, staff.section_id, staff.user_id
						from
						(select
						`role`.`id` AS `id`,
						
						`sr`.`id` AS `formal_name_id`,
						`sr`.`abridged_name` AS `formal_name`,

						`role`.`domain_name` AS `domain_name`,`role`.`type_name` AS `type_name`,`role`.`gr_id` AS `gr_id`,
						`role`.`wing_name` AS `wing_name`,
						`role`.`grade_name` AS `grade_name`,`role`.`section_name` AS `section_name`,
						`role`.`subject_name` AS `subject_name`,`role`.`grade_id` AS `grade_id`, role.section_id, sr.user_id
					



						from `atif_role`.`role_in_org_view` `role`
						left join atif.staff_registered sr on sr.id = role.staff_id

						where 
						(`role`.`type_id` = 15 or `role`.`type_id` = 16) and 
						role.grade_id=".$grade_id." 
						and role.section_id=".$section_id."
						 and (role.domain_name = 'Starter' or role.domain_name = 'Junior' or role.domain_name = 'Middler'  or role.domain_name = 'Senior')
			  

						group by `role`.`gr_id`

						order by `role`.`grade_id`,`role`.`section_id`) as staff

						left join
						(select * from atif_attendance.attendance_verification_teacher where `date` = curdate() 

						group by user_id) as avt on avt.user_id = staff.user_id	

						left join
						(SELECT * FROM atif.users_login where date = curdate()
						group by user_id order by created asc) as login on login.user_id = staff.user_id

						left join
						(SELECT * FROM atif.users_logout where date = curdate()
						group by user_id order by created desc) as logout on logout.user_id = staff.user_id


						left join
						(SELECT count(id) as atd_changes, register_by FROM atif_attendance.attendance_status_changed where date =curdate() group by gs_id) as atd_change on atd_change.register_by = staff.user_id
	where  
			 avt.created is not null
						order by staff.grade_id asc, staff.section_id asc) as verification
						order by grade_id asc, section_id asc, login_time desc, confirm_tpa desc, logout_time desc
			) as tpa_rpt

			union

			select
			avo.id, sr.id AS formal_name_id,sr.abridged_name AS formal_name, left(sr.c_topline,15) as domain_name, left(sr.c_bottomline,15) as type_name,
			'' as gr_id, gg.name as grade_name, ss.name as section_name,
			avo.date, avo.ip4, '' as login_time, from_unixtime(avo.created, '%h:%i:%s') as confirm_tpa, '' as logout_time, '' as atd_changes
			from
			atif_attendance.attendance_verification_other avo

			left join atif.staff_registered sr on sr.user_id = avo.user_id
			left join atif._grade as gg on gg.id = avo.grade_id
			left join atif._section as ss on ss.id = avo.section_id
			 where avo.date = curdate()
			 and gg.id=".$grade_id." and ss.id = ".$section_id."";
			 
			 
		$rquery=$this->ddb->query($query); 
   		$row = $rquery->result_array();

   		return $row;  
		
		
		
	}
	
	
	public function getStudent($Grade_id=NULL,$Section_id=NULL,$GS_ID=NULL){
		
		$this->ddb2 = $this->load->database('attendance_students2',TRUE);
		
		if($GS_ID == NULL){
		$squery = "CALL `sp_get_student_grade_list`(?,?)";
		$query = $this->ddb2->query($squery, array("Grade_id"=>$Grade_id, "Section_id"=>$Section_id));
		return $query->result_array();	
		}else{
		$squery = "CALL `sp_get_single_student_grade_list`(?)";
		$query = $this->ddb2->query($squery, array("GS_ID"=>$GS_ID));
		return $query->row_array();	
		}
	}
	
	public function get_academic($grade_id,$section_id){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "select academic_session_id as Academic  from atif.class_list where grade_id=".$grade_id." and section_id=".$section_id." limit 1";
		$result = $this->ddb->query($query);
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
	}
	
		public function get_term($academic_id){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "select assessment_term_id as Term from atif_assessment.assessment_term_academic_session where academic_session_id=".$academic_id." and is_active=1";
		$result = $this->ddb->query($query);
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
	}
	
	
}// main class
	
	
	
	
	/*
	
	select * from atif_attendance.student_attendance where  DATE( `date`) 
	BETWEEN DATE_SUB(NOW(),INTERVAL 10 DAY) and DATE_SUB(NOW(),INTERVAL 0 DAY)AND gs_id='05-056'

select * from atif_attendance.attendance_calendar
where  DATE( `date`) BETWEEN DATE_SUB(NOW(),INTERVAL 10 DAY) and DATE_SUB(NOW(),INTERVAL 0 DAY) and is_on=1


*****************
select
sum(j.C_PN) as Class_PN,
sum(j.C_N) as Class_N,
sum(C_KG) as Class_KG,
sum(C_I) as Class_I,
sum(C_II) as Class_II,
sum(C_III) as Class_III,
sum(C_IV) as Class_IV,
sum(C_V) as Class_V,
sum(C_VI) as Class_VI,
sum(C_VII) as Class_VII,
sum(C_VIII) as Class_VIII,
sum(C_IX) as Class_IX,
sum(C_X) as Class_X,
sum(C_XI) as Class_XI,
sum(C_A1) as Class_A1,
sum(C_A2) as Class_A2
from ( select
ac.date as Dated,
ac.pn as C_PN,
ac.n as C_N,
ac.kg as C_KG,
ac.i as C_I,
ac.ii as C_II,
ac.iii as C_III,
ac.iv as C_IV,
ac.v as C_V,
ac.vi as C_VI,
ac.vii as C_VII,
ac.viii as C_VIII,
ac.ix as C_IX,
ac.x as C_X,
ac.xi as C_XI,
ac.a1 as C_A1,
ac.a2 as C_A2
from atif_attendance.attendance_calendar as ac
where  ac.date <= curdate() 
and ac.is_on=1 
order by ac.id desc
limit 10
) as j

**********
*/

