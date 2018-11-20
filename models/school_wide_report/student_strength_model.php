<?php
class Student_strength_model extends CI_Model{

	private $db_students;

	function __construct()
	{
		parent::__construct();
		$this->db_students = $this->load->database('default',TRUE);
	}

	

	public function getStudentGradeSectionSummary()
	{
		$query=$this->db->query("select `cls`.`grade` AS `grade_name`,`cls`.`section` AS `section_name`,
			`str`.`students` AS `students`,`str`.`girl` AS `girl`,`str`.`boy` AS `boy`,`str`.`jinnah` AS `jinnah`,
			`str`.`iqbal` AS `iqbal`,`str`.`syed` AS `syed` from (((select `gg`.`name` AS `grade`,
			`ss`.`name` AS `section`,`gg`.`id` AS `grade_id`,`ss`.`id` AS `section_id` 

			from (`atif`.`_grade` `gg` join `atif`.`_section` `ss`) 
			where if((`gg`.`id` <= 3),((`ss`.`id` >= 11) and (`ss`.`id` <= 21)),
			if((`gg`.`id` >= 4),(((`ss`.`id` >= 1) and (`ss`.`id` <= 10)) or (`ss`.`id` = 21)),'')) 
			order by `gg`.`id`,`ss`.`id`)) `cls` 

			left join (select `cl`.`grade_name` AS `grade_name`,`cl`.`section_name` AS `section_name`,
			count(`cl`.`gs_id`) AS `students`,sum(if((`cl`.`gender` = 'G'),1,0)) AS `girl`,
			sum(if((`cl`.`gender` = 'B'),1,0)) AS `boy`,sum(if((`cl`.`house_name` = 'jinnah'),1,0)) AS `jinnah`,
			sum(if((`cl`.`house_name` = 'iqbal'),1,0)) AS `iqbal`,
			sum(if((`cl`.`house_name` = 'syed'),1,0)) AS `syed` 
			from `atif`.`class_list` `cl` 
			where ((`cl`.`student_status_name` = 'active') or (`cl`.`student_status_name` = 'inactive')) 
			group by `cl`.`grade_name`,`cl`.`section_name` 
			order by `cl`.`grade_id`,`cl`.`section_id`) `str` 

			on(((`str`.`grade_name` = `cls`.`grade`) and (`str`.`section_name` = `cls`.`section`)))) 

			order by `cls`.`grade_id`,`cls`.`section_id`");
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentGradeSummary()
	{
		$query=$this->db_students->query("select `cl`.`grade_name` AS `grade_name`,count(`cl`.`gs_id`) AS `students`,
		sum(if((`cl`.`gender` = 'G'),1,0)) AS `girl`,
		sum(if((`cl`.`gender` = 'B'),1,0)) AS `boy`,
		sum(if((`cl`.`house_name` = 'Jinnah'),1,0)) AS `jinnah`,
		sum(if((`cl`.`house_name` = 'Iqbal'),1,0)) AS `iqbal`,
		sum(if((`cl`.`house_name` = 'Syed'),1,0)) AS `syed`,
		sum(if((`pet`.`petitioner_code` <> ''),1,0)) AS `pet_students`,
		sum(if(((`pet`.`petitioner_code` <> '') and (`cl`.`gender` = 'G')),1,0)) AS `pet_girl`,
		sum(if(((`pet`.`petitioner_code` <> '') and (`cl`.`gender` = 'B')),1,0)) AS `pet_boy` 

		from (`atif`.`class_list` `cl` 

		left join (select `atif_gs_events`.`1509_petitioners`.`gf_id` AS `gf_id`,
		`atif_gs_events`.`1509_petitioners`.`petitioner_code` AS `petitioner_code`,
		`atif_gs_events`.`1509_petitioners`.`pay_regular_fee` AS `pay_regular_fee` 
		from `atif_gs_events`.`1509_petitioners` 
		where (`atif_gs_events`.`1509_petitioners`.`pay_regular_fee` = 0)
		group by `atif_gs_events`.`1509_petitioners`.`gf_id`) `pet` 
		on((`pet`.`gf_id` = `cl`.`gf_id`))) 

		where ((`cl`.`student_status_name` = 'active') or (`cl`.`student_status_name` = 'inactive')) 
		group by `cl`.`grade_name` order by `cl`.`grade_id`");
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentWingSummary()
	{
		$query=$this->db_students->query("select `cl`.`wing_name` AS `wing_name`,count(`cl`.`gs_id`) AS `students`,
			sum(if((`cl`.`gender` = 'G'),1,0)) AS `girl`,sum(if((`cl`.`gender` = 'B'),1,0)) AS `boy`,
			sum(if((`cl`.`house_name` = 'Jinnah'),1,0)) AS `jinnah`,
			sum(if((`cl`.`house_name` = 'Iqbal'),1,0)) AS `iqbal`,
			sum(if((`cl`.`house_name` = 'Syed'),1,0)) AS `syed`,
			sum(if((`pet`.`petitioner_code` <> ''),1,0)) AS `pet_students`,
			sum(if(((`pet`.`petitioner_code` <> '') and (`cl`.`gender` = 'G')),1,0)) AS `pet_girl`,
			sum(if(((`pet`.`petitioner_code` <> '') and (`cl`.`gender` = 'B')),1,0)) AS `pet_boy` 

			from (`atif`.`class_list` `cl` 

			left join (select `atif_gs_events`.`1509_petitioners`.`gf_id` AS `gf_id`,
			`atif_gs_events`.`1509_petitioners`.`petitioner_code` AS `petitioner_code`,
			`atif_gs_events`.`1509_petitioners`.`pay_regular_fee` AS `pay_regular_fee` 
			from `atif_gs_events`.`1509_petitioners` 
			where (`atif_gs_events`.`1509_petitioners`.`pay_regular_fee` = 0)
			group by `atif_gs_events`.`1509_petitioners`.`gf_id`) `pet` 
			on((`pet`.`gf_id` = `cl`.`gf_id`))) 
			where ((`cl`.`student_status_name` = 'active') or (`cl`.`student_status_name` = 'inactive')) 

			group by `cl`.`wing_name` 
			order by `cl`.`wing_order`");
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentCampusSummary()
	{
		$query=$this->db_students->query("select `cl`.`campus` AS `grade_name`,count(`cl`.`gs_id`) AS `students`,
		sum(if((`cl`.`gender` = 'G'),1,0)) AS `girl`,
		sum(if((`cl`.`gender` = 'B'),1,0)) AS `boy`,
		sum(if((`cl`.`house_name` = 'Jinnah'),1,0)) AS `jinnah`,
		sum(if((`cl`.`house_name` = 'Iqbal'),1,0)) AS `iqbal`,
		sum(if((`cl`.`house_name` = 'Syed'),1,0)) AS `syed`,
		sum(if((`pet`.`petitioner_code` <> ''),1,0)) AS `pet_students`,
		sum(if(((`pet`.`petitioner_code` <> '') and (`cl`.`gender` = 'G')),1,0)) AS `pet_girl`,
		sum(if(((`pet`.`petitioner_code` <> '') and (`cl`.`gender` = 'B')),1,0)) AS `pet_boy` 

		from (`atif`.`class_list` `cl` 

		left join (select `atif_gs_events`.`1509_petitioners`.`gf_id` AS `gf_id`,
		`atif_gs_events`.`1509_petitioners`.`petitioner_code` AS `petitioner_code`,
		`atif_gs_events`.`1509_petitioners`.`pay_regular_fee` AS `pay_regular_fee` 

		from `atif_gs_events`.`1509_petitioners` 
		where (`atif_gs_events`.`1509_petitioners`.`pay_regular_fee` = 0)
		group by `atif_gs_events`.`1509_petitioners`.`gf_id`) `pet` 
		on((`pet`.`gf_id` = `cl`.`gf_id`))) 

		where ((`cl`.`student_status_name` = 'active') or (`cl`.`student_status_name` = 'inactive')) 
		group by `cl`.`campus` order by `cl`.`campus`");
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function get_by($tablename,$select='',$where=null,$group=''){

		// Table Name

		

		// Selection

		$this->db->from($tablename);
		if($select == ''){
			$this->db->select();
		}
		else if($select != ''){
			$this->db->select($select);
		}

		// Where Condition

		if($where == null){

		}
		else if($where != null){
			$this->db->where($where);
		}



		//Group By

		if($group == ''){
		}
		else if($group != ''){
			$this->db->group_by($group);
		}

		// Get Query Result

		$query = $this->db->get();
		$row = $query->result();

		if($row == null){
			return false;
		}
		else if($row != null){
			return $row;
		}



	}





















	public function getStudentGradeSectionSummary_where($WHERE)
	{
		$query=$this->db->query("select `cls`.`grade` AS `grade_name`,`cls`.`section` AS `section_name`,
			`str`.`students` AS `students`,`str`.`girl` AS `girl`,`str`.`boy` AS `boy`,`str`.`jinnah` AS `jinnah`,
			`str`.`iqbal` AS `iqbal`,`str`.`syed` AS `syed` from (((select `gg`.`name` AS `grade`,
			`ss`.`name` AS `section`,`gg`.`id` AS `grade_id`,`ss`.`id` AS `section_id` 

			from (`atif`.`_grade` `gg` join `atif`.`_section` `ss`) 
			where if((`gg`.`id` <= 3) or (`gg`.`id` = 17),((`ss`.`id` >= 11) and (`ss`.`id` <= 21)),
			if((`gg`.`id` >= 4),(((`ss`.`id` >= 1) and (`ss`.`id` <= 10)) or (`ss`.`id` = 21)),'')) 
			order by `gg`.`id`,`ss`.`id`)) `cls`

			left join (select `cl`.`grade_name` AS `grade_name`,`cl`.`section_name` AS `section_name`,
			count(`cl`.`gs_id`) AS `students`,sum(if((`cl`.`gender` = 'G'),1,0)) AS `girl`,
			sum(if((`cl`.`gender` = 'B'),1,0)) AS `boy`,sum(if((`cl`.`house_name` = 'jinnah'),1,0)) AS `jinnah`,
			sum(if((`cl`.`house_name` = 'iqbal'),1,0)) AS `iqbal`,
			sum(if((`cl`.`house_name` = 'syed'),1,0)) AS `syed` 
			from `atif`.`class_list` `cl` 
			where (".$WHERE.") 
			group by `cl`.`grade_name`,`cl`.`section_name` 
			order by `cl`.`grade_id`,`cl`.`section_id`) `str` 

			on(((`str`.`grade_name` = `cls`.`grade`) and (`str`.`section_name` = `cls`.`section`)))) 

			order by `cls`.`grade_id`,`cls`.`section_id`");
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentGradeSummary_where($WHERE)
	{
		$query=$this->db_students->query("select `cl`.`grade_name` AS `grade_name`,count(`cl`.`gs_id`) AS `students`,
		sum(if((`cl`.`gender` = 'G'),1,0)) AS `girl`,
		sum(if((`cl`.`gender` = 'B'),1,0)) AS `boy`,
		sum(if((`cl`.`house_name` = 'Jinnah'),1,0)) AS `jinnah`,
		sum(if((`cl`.`house_name` = 'Iqbal'),1,0)) AS `iqbal`,
		sum(if((`cl`.`house_name` = 'Syed'),1,0)) AS `syed`,
		sum(if((`cl`.`std_status_code` = 'S-CPT'),1,0)) AS `pet_students`,
		sum(if(((`cl`.`std_status_code` = 'S-CPT') and (`cl`.`gender` = 'G')),1,0)) AS `pet_girl`,
		sum(if(((`cl`.`std_status_code` = 'S-CPT') and (`cl`.`gender` = 'B')),1,0)) AS `pet_boy`, se.total_section 

		from `atif`.`class_list` `cl` 
		left join(Select grade_id, count(distinct section_id) as total_section
					From atif.class_list	where section_id != 21 group by grade_id) as se
				on se.grade_id = cl.grade_id
		where (".$WHERE.") 
		group by `cl`.`grade_name` order by `cl`.`complete_in_years` desc");
		$rows_array = $query->result_array();
		return $rows_array;
	}
	public function getStudentWingSummary_where($WHERE)
	{
		$query=$this->db_students->query("select `cl`.`wing_name` AS `wing_name`,count(`cl`.`gs_id`) AS `students`,
			sum(if((`cl`.`gender` = 'G'),1,0)) AS `girl`,sum(if((`cl`.`gender` = 'B'),1,0)) AS `boy`,
			sum(if((`cl`.`house_name` = 'Jinnah'),1,0)) AS `jinnah`,
			sum(if((`cl`.`house_name` = 'Iqbal'),1,0)) AS `iqbal`,
			sum(if((`cl`.`house_name` = 'Syed'),1,0)) AS `syed`,
			sum(if((`cl`.`std_status_code` = 'S-CPT'),1,0)) AS `pet_students`,
			sum(if(((`cl`.`std_status_code` = 'S-CPT') and (`cl`.`gender` = 'G')),1,0)) AS `pet_girl`,
			sum(if(((`cl`.`std_status_code` = 'S-CPT') and (`cl`.`gender` = 'B')),1,0)) AS `pet_boy` 

			from `atif`.`class_list` `cl` 

			where (".$WHERE.") 

			group by `cl`.`wing_name` 
			order by `cl`.`wing_order`");
		$rows_array = $query->result_array();
		return $rows_array;
	}
	public function getStudentCampusSummary_where($WHERE)
	{
		$query=$this->db_students->query("select `cl`.`campus` AS `grade_name`,count(`cl`.`gs_id`) AS `students`,
		sum(if((`cl`.`gender` = 'G'),1,0)) AS `girl`,
		sum(if((`cl`.`gender` = 'B'),1,0)) AS `boy`,
		sum(if((`cl`.`house_name` = 'Jinnah'),1,0)) AS `jinnah`,
		sum(if((`cl`.`house_name` = 'Iqbal'),1,0)) AS `iqbal`,
		sum(if((`cl`.`house_name` = 'Syed'),1,0)) AS `syed`,
		sum(if((`cl`.`std_status_code` = 'S-CPT'),1,0)) AS `pet_students`,
		sum(if(((`cl`.`std_status_code` = 'S-CPT') and (`cl`.`gender` = 'G')),1,0)) AS `pet_girl`,
		sum(if(((`cl`.`std_status_code` = 'S-CPT') and (`cl`.`gender` = 'B')),1,0)) AS `pet_boy` 

		from `atif`.`class_list` `cl` 

		where (".$WHERE.") 
		group by `cl`.`campus` order by `cl`.`campus`");
		$rows_array = $query->result_array();
		return $rows_array;
	}
}