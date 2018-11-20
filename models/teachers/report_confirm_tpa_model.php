<?php
class Report_confirm_tpa_model extends CI_Model{

	private $db_student_attendance;

	function __construct()
	{
		parent::__construct();
		$this->db_student_attendance = $this->load->database('role',TRUE);
	}	
	
	public function getConfirmTPALog($ThisDate, $GradeID)
	{
		$result = "";
		$cQuery = "select verification.id, verification.formal_name, verification.domain_name, verification.type_name, verification.gr_id, verification.grade_name, verification.section_name, verification.date, verification.ip4,
			from_unixtime(verification.login_time, '%h:%i:%s') as login_time,
			from_unixtime(verification.created, '%h:%i:%s') as confirm_tpa,
			from_unixtime(verification.logout_time, '%h:%i:%s') as logout_time,
		  	verification.atd_changes
		  	from
			(select staff.id, staff.formal_name, staff.domain_name, staff.type_name, staff.gr_id, staff.wing_name, staff.grade_name, staff.section_name,
			avt.date, avt.ip4, avt.created, login.created as login_time, logout.created as logout_time, atd_change.atd_changes, 
			staff.subject_name, staff.grade_id, staff.section_id, staff.user_id
			from
			(select
			`role`.`id` AS `id`,

			`sr`.`abridged_name` AS `formal_name`,

			`role`.`domain_name` AS `domain_name`,`role`.`type_name` AS `type_name`,`role`.`gr_id` AS `gr_id`,`role`.`wing_name` AS `wing_name`,
			`role`.`grade_name` AS `grade_name`,`role`.`section_name` AS `section_name`,
			`role`.`subject_name` AS `subject_name`,`role`.`grade_id` AS `grade_id`, role.section_id, sr.user_id



			from `atif_role`.`role_in_org_view` `role`
			left join atif.staff_registered sr on sr.id = role.staff_id

			where (`role`.`type_id` = 15 or `role`.`type_id` = 16)
			and role.grade_id >= " . $GradeID . " 

			group by `role`.`gr_id`

			order by `role`.`grade_id`,`role`.`section_id`) as staff

			left join
			(select * from atif_attendance.attendance_verification_teacher where `date` = '" . $ThisDate . "' group by user_id) as avt on avt.user_id = staff.user_id	

			left join
			(SELECT * FROM atif.users_login where date = '" . $ThisDate . "'
			group by user_id order by created asc) as login on login.user_id = staff.user_id

			left join
			(SELECT * FROM atif.users_logout where date = '" . $ThisDate . "'
			group by user_id order by created desc) as logout on logout.user_id = staff.user_id


			left join
			(SELECT count(id) as atd_changes, register_by FROM atif_attendance.attendance_status_changed where date = '" . $ThisDate . "' group by gs_id) as atd_change on atd_change.register_by = staff.user_id

			order by staff.grade_id asc, staff.section_id asc) as verification
			order by grade_id asc, section_id asc, login_time desc, confirm_tpa desc, logout_time desc";
		
		$query=$this->db->query($cQuery);
		if($query->num_rows() > 0){
			$result = $query->result_array();
		}
		
   		return $result;
	}



	public function getConfirmTPALog_Grades($ThisDate, $GradeID)
	{
		$result = "";
		$cQuery = "select * from (
			select verification.id, verification.formal_name, verification.domain_name, verification.type_name, verification.gr_id, verification.grade_name, verification.section_name, verification.date, verification.ip4, verification.grade_id,
			from_unixtime(verification.login_time, '%h:%i:%s') as login_time,
			from_unixtime(verification.created, '%h:%i:%s') as confirm_tpa,
			from_unixtime(verification.logout_time, '%h:%i:%s') as logout_time,
		  	verification.atd_changes
		  	from
			(select staff.id, staff.formal_name, staff.domain_name, staff.type_name, staff.gr_id, staff.wing_name, staff.grade_name, staff.section_name,
			avt.date, avt.ip4, avt.created, login.created as login_time, logout.created as logout_time, atd_change.atd_changes, 
			staff.subject_name, staff.grade_id, staff.section_id, staff.user_id
			from
			(select
			`role`.`id` AS `id`,

			`sr`.`abridged_name` AS `formal_name`,

			`role`.`domain_name` AS `domain_name`,`role`.`type_name` AS `type_name`,`role`.`gr_id` AS `gr_id`,`role`.`wing_name` AS `wing_name`,
			`role`.`grade_name` AS `grade_name`,`role`.`section_name` AS `section_name`,
			`role`.`subject_name` AS `subject_name`,`role`.`grade_id` AS `grade_id`, role.section_id, sr.user_id



			from `atif_role`.`role_in_org_view` `role`
			left join atif.staff_registered sr on sr.id = role.staff_id

			where (`role`.`type_id` = 15 or `role`.`type_id` = 16)
			and role.grade_id >= " . $GradeID . " 

			group by `role`.`gr_id`

			order by `role`.`grade_id`,`role`.`section_id`) as staff

			left join
			(select * from atif_attendance.attendance_verification_teacher where `date` = '" . $ThisDate . "' group by user_id) as avt on avt.user_id = staff.user_id	

			left join
			(SELECT * FROM atif.users_login where date = '" . $ThisDate . "'
			group by user_id order by created asc) as login on login.user_id = staff.user_id

			left join
			(SELECT * FROM atif.users_logout where date = '" . $ThisDate . "'
			group by user_id order by created desc) as logout on logout.user_id = staff.user_id


			left join
			(SELECT count(id) as atd_changes, register_by FROM atif_attendance.attendance_status_changed where date = '" . $ThisDate . "' group by gs_id) as atd_change on atd_change.register_by = staff.user_id

			order by staff.grade_id asc, staff.section_id asc) as verification) as grades group by grade_name order by grade_id asc";
		
		$query=$this->db->query($cQuery);
		if($query->num_rows() > 0){
			$result = $query->result_array();
		}
		
   		return $result;
	}
}