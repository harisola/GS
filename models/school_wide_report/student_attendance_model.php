<?php
class Student_attendance_model extends CI_Model{

	private $db_students;

	function __construct()
	{
		parent::__construct();
		$this->db_students = $this->load->database('default',TRUE);
	}

	
	public function getStudentGradeSectionSummary()
	{
		$query=$this->db->query("select
			ana.grade_name, ana.section_name,
			ana.grade_id, ana.section_id,
			ana.house_name, ana.date, ana.time, ana.ip4, ana.location_id, ana.tmp_card_no,
			count(ana.gs_id) AS students,
            sum(if((ana.student_status_name = 'Inactive' and ana.section_id != 21),1,0)) AS inactive_student_status,
			sum(if((ana.time >= '00:00:00'),1,0)) AS present,
			sum(if((ana.tmp_card_no > 0),1,0)) AS no_card,
			sum(if((ana.time >= '07:41:00'),1,0)) AS late
			from 

			(select
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.section_name, cl.house_name, cl.student_status_name,
			sa.date, sa.time, sa.ip4, sa.location_id, cl.grade_id, cl.section_id,
			tsu.tmp_card_no
			from atif.class_list cl
			left join
			(select * from atif_attendance.student_attendance where date = curdate()) as sa
			on sa.gs_id = cl.gs_id
			left join
			(select * from atif_attendance.tmpcard_student_used where date = curdate()) as tsu
			on tsu.gs_id = cl.gs_id
			where (cl.student_status_name = 'active' or cl.student_status_name = 'inactive')
			group by cl.gs_id)

			as ana
			group by ana.grade_name, ana.section_name
			order by ana.grade_id, ana.section_id");
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentGradeSummary()
	{
		$query=$this->db->query("select
			ana.grade_name,
			count(ana.gs_id) AS students,
            sum(if((ana.student_status_name = 'inactive' and ana.section_id != 21),1,0)) AS inactive_student_status,
			sum(if((ana.time >= '00:00:00'),1,0)) AS present,
			sum(if((ana.tmp_card_no > 0),1,0)) AS no_card,
			sum(if((ana.time >= '07:41:00'),1,0)) AS late
			from 

			(select
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.house_name, cl.student_status_name,
			sa.date, sa.time, sa.ip4, sa.location_id, cl.grade_id, cl.section_id,
			tsu.tmp_card_no
			from atif.class_list cl
			left join
			(select * from atif_attendance.student_attendance where date = curdate()) as sa
			on sa.gs_id = cl.gs_id
			left join
			(select * from atif_attendance.tmpcard_student_used where date = curdate()) as tsu
			on tsu.gs_id = cl.gs_id 
			where (cl.student_status_name = 'active' or cl.student_status_name = 'inactive')
			group by cl.gs_id)

			as ana
			group by ana.grade_name
			order by ana.grade_id, ana.section_id");
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentWingSummary()
	{
		$query=$this->db->query("select
			ana.wing_name,
			count(ana.gs_id) AS students,
            sum(if((ana.student_status_name = 'inactive' and ana.section_id != 21),1,0)) AS inactive_student_status,
			sum(if((ana.time >= '00:00:00'),1,0)) AS present,
			sum(if((ana.tmp_card_no > 0),1,0)) AS no_card,
			sum(if((ana.time >= '07:41:00'),1,0)) AS late
			from 

			(select
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.section_name, cl.house_name, cl.student_status_name,
			sa.date, sa.time, sa.ip4, sa.location_id, cl.grade_id, cl.section_id,
			tsu.tmp_card_no, wing.name as wing_name
			from atif.class_list cl
			left join
			(select * from atif_attendance.student_attendance where date = curdate()) as sa
			on sa.gs_id = cl.gs_id
			left join
			(select * from atif_attendance.tmpcard_student_used where date = curdate()) as tsu
			on tsu.gs_id = cl.gs_id
			left join atif._wing_grade as wg on wg.grade_id = cl.grade_id
			left join atif._wing as wing on wing.id = wg.wing_id
			where (cl.student_status_name = 'active' or cl.student_status_name = 'inactive')
			group by cl.gs_id)

			as ana
			group by ana.wing_name
			order by ana.grade_id, ana.section_id");
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentCampusSummary()
	{
		$query=$this->db->query("select
			ana.branch_name as campus_name,
			count(ana.gs_id) AS students,
            sum(if((ana.student_status_name = 'inactive' and ana.section_id != 21),1,0)) AS inactive_student_status,
			sum(if((ana.time >= '00:00:00'),1,0)) AS present,
			sum(if((ana.tmp_card_no > 0),1,0)) AS no_card,
			sum(if((ana.time >= '07:41:00'),1,0)) AS late
			from 

			(select
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.section_name, cl.house_name, cl.student_status_name,
			sa.date, sa.time, sa.ip4, sa.location_id, cl.grade_id, cl.section_id,
			tsu.tmp_card_no, wib.branch_name
			from atif.class_list cl
			left join
			(select * from atif_attendance.student_attendance where date = curdate()) as sa
			on sa.gs_id = cl.gs_id
			left join
			(select * from atif_attendance.tmpcard_student_used where date = curdate()) as tsu
			on tsu.gs_id = cl.gs_id
			left join atif._wing_grade as wg on wg.grade_id = cl.grade_id
			left join atif._wing as wing on wing.id = wg.wing_id
			left join atif._wings_in_branch wib on wib.wing_id = wg.wing_id
			where (cl.student_status_name = 'active' or cl.student_status_name = 'inactive')
			group by cl.gs_id)
			
			as ana
			group by ana.branch_name
			order by ana.grade_id, ana.section_id");
		$rows_array = $query->result_array();
		return $rows_array;
	}






	public function getStudentGradeSectionSummary_date($thisDate)
	{
		$query=$this->db->query("select
			ana.grade_name, ana.section_name,
			ana.grade_id, ana.section_id,
			ana.house_name, ana.date, ana.time, ana.ip4, ana.location_id, ana.tmp_card_no,
			count(ana.gs_id) AS students,
            sum(if((ana.student_status_name = 'inactive' and ana.section_id != 21),1,0)) AS inactive_student_status,
			sum(if((ana.time >= '00:00:00'),1,0)) AS present,
			sum(if((ana.tmp_card_no > 0),1,0)) AS no_card,
			sum(if((ana.time >= '07:41:00'),1,0)) AS late
			from 

			(select
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.section_name, cl.house_name, cl.student_status_name,
			sa.date, sa.time, sa.ip4, sa.location_id, cl.grade_id, cl.section_id,
			tsu.tmp_card_no
			from atif.class_list cl
			left join
			(select * from atif_attendance.student_attendance where date = '" . $thisDate . "') as sa
			on sa.gs_id = cl.gs_id
			left join
			(select * from atif_attendance.tmpcard_student_used where date = '" . $thisDate . "') as tsu
			on tsu.gs_id = cl.gs_id
			where (cl.student_status_name = 'active' or cl.student_status_name = 'inactive')
			group by cl.gs_id)

			as ana
			group by ana.grade_name, ana.section_name
			order by ana.grade_id, ana.section_id");
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentGradeSummary_date($thisDate)
	{
		$query=$this->db->query("select
			ana.grade_name,
			count(ana.gs_id) AS students,
            sum(if((ana.student_status_name = 'inactive' and ana.section_id != 21),1,0)) AS inactive_student_status,
			sum(if((ana.time >= '00:00:00'),1,0)) AS present,
			sum(if((ana.tmp_card_no > 0),1,0)) AS no_card,
			sum(if((ana.time >= '07:41:00'),1,0)) AS late
			from 

			(select
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.house_name, cl.student_status_name,
			sa.date, sa.time, sa.ip4, sa.location_id, cl.grade_id, cl.section_id,
			tsu.tmp_card_no
			from atif.class_list cl
			left join
			(select * from atif_attendance.student_attendance where date = '" . $thisDate . "') as sa
			on sa.gs_id = cl.gs_id
			left join
			(select * from atif_attendance.tmpcard_student_used where date = '" . $thisDate . "') as tsu
			on tsu.gs_id = cl.gs_id
			where (cl.student_status_name = 'active' or cl.student_status_name = 'inactive')
			group by cl.gs_id)

			as ana
			group by ana.grade_name
			order by ana.grade_id, ana.section_id");
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentWingSummary_date($thisDate)
	{
		$query=$this->db->query("select
			ana.wing_name,
			count(ana.gs_id) AS students,
            sum(if((ana.student_status_name = 'inactive' and ana.section_id != 21),1,0)) AS inactive_student_status,
			sum(if((ana.time >= '00:00:00'),1,0)) AS present,
			sum(if((ana.tmp_card_no > 0),1,0)) AS no_card,
			sum(if((ana.time >= '07:41:00'),1,0)) AS late
			from 

			(select
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.section_name, cl.house_name, cl.student_status_name,
			sa.date, sa.time, sa.ip4, sa.location_id, cl.grade_id, cl.section_id,
			tsu.tmp_card_no, wing.name as wing_name
			from atif.class_list cl
			left join
			(select * from atif_attendance.student_attendance where date = '" . $thisDate . "') as sa
			on sa.gs_id = cl.gs_id
			left join
			(select * from atif_attendance.tmpcard_student_used where date = '" . $thisDate . "') as tsu
			on tsu.gs_id = cl.gs_id
			left join atif._wing_grade as wg on wg.grade_id = cl.grade_id
			left join atif._wing as wing on wing.id = wg.wing_id
			where (cl.student_status_name = 'active' or cl.student_status_name = 'inactive')
			group by cl.gs_id)

			as ana
			group by ana.wing_name
			order by ana.grade_id, ana.section_id");
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentCampusSummary_date($thisDate)
	{
		$query=$this->db->query("select
			ana.branch_name as campus_name,
			count(ana.gs_id) AS students,
            sum(if((ana.student_status_name = 'inactive' and ana.section_id != 21),1,0)) As inactive_student_status,
			sum(if((ana.time >= '00:00:00'),1,0)) AS present,
			sum(if((ana.tmp_card_no > 0),1,0)) AS no_card,
			sum(if((ana.time >= '07:41:00'),1,0)) AS late
			from 

			(select
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.section_name, cl.house_name, cl.student_status_name,
			sa.date, sa.time, sa.ip4, sa.location_id, cl.grade_id, cl.section_id,
			tsu.tmp_card_no, wib.branch_name
			from atif.class_list cl
			left join
			(select * from atif_attendance.student_attendance where date = '" . $thisDate . "') as sa
			on sa.gs_id = cl.gs_id
			left join
			(select * from atif_attendance.tmpcard_student_used where date = '" . $thisDate . "') as tsu
			on tsu.gs_id = cl.gs_id
			left join atif._wing_grade as wg on wg.grade_id = cl.grade_id
			left join atif._wing as wing on wing.id = wg.wing_id
			left join atif._wings_in_branch wib on wib.wing_id = wg.wing_id
			where (cl.student_status_name = 'active' or cl.student_status_name = 'inactive')
			group by cl.gs_id)

			as ana
			group by ana.branch_name
			order by ana.grade_id, ana.section_id");
		$rows_array = $query->result_array();
		return $rows_array;
	}
}