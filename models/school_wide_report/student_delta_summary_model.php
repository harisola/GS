<?php
class Student_delta_summary_model extends CI_Model{

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
			sum(if((ana.time >= '00:00:00'),1,0)) AS present,
			sum(if((ana.tmp_card_no > 0),1,0)) AS no_card,
			sum(if((ana.time >= '07:41:00'),1,0)) AS late
			from (select
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.section_name, cl.house_name,
			sa.date, sa.time, sa.ip4, sa.location_id, cl.grade_id, cl.section_id,
			tsu.tmp_card_no
			from atif.class_list cl
			left join
			(select * from atif_attendance.student_attendance where date = curdate()) as sa
			on sa.gs_id = cl.gs_id
			left join
			(select * from atif_attendance.tmpcard_student_used where date = curdate()) as tsu
			on tsu.gs_id = cl.gs_id) as ana
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
			sum(if((ana.time >= '00:00:00'),1,0)) AS present,
			sum(if((ana.tmp_card_no > 0),1,0)) AS no_card,
			sum(if((ana.time >= '07:41:00'),1,0)) AS late
			from (select
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.house_name,
			sa.date, sa.time, sa.ip4, sa.location_id, cl.grade_id, cl.section_id,
			tsu.tmp_card_no
			from atif.class_list cl
			left join
			(select * from atif_attendance.student_attendance where date = curdate()) as sa
			on sa.gs_id = cl.gs_id
			left join
			(select * from atif_attendance.tmpcard_student_used where date = curdate()) as tsu
			on tsu.gs_id = cl.gs_id) as ana
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
			sum(if((ana.time >= '00:00:00'),1,0)) AS present,
			sum(if((ana.tmp_card_no > 0),1,0)) AS no_card,
			sum(if((ana.time >= '07:41:00'),1,0)) AS late
			from (select
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.section_name, cl.house_name,
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
			) as ana
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
			sum(if((ana.time >= '00:00:00'),1,0)) AS present,
			sum(if((ana.tmp_card_no > 0),1,0)) AS no_card,
			sum(if((ana.time >= '07:41:00'),1,0)) AS late
			from (select
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.section_name, cl.house_name,
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
			) as ana
			group by ana.branch_name
			order by ana.grade_id, ana.section_id");
		$rows_array = $query->result_array();
		return $rows_array;
	}









	public function getStudentGradeSectionSummary_Date($DateFrom, $DateTo)
	{
		$thisQuery = "select
			ana.grade_name, ana.section_name,
			ana.grade_id, ana.section_id,
			count(ana.gs_id) AS students,
			count(ana.admission_id) as req_admission,
			count(ana.withdrawal_id) as req_withdrawal,
			count(ana.std_card_change) as req_std_card,
            count(ana.house_id) as req_house,
            count(ana.reqsection_id) as req_section,
            sum(if(ana.detain = '1', 1, 0)) as detain,
            sum(if(ana.statusai_id = '3', 1, 0)) as inative_add,
            sum(if(ana.statusai_id = '1', 1, 0)) as inative_less
			from (select cl.id,
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.section_name, cl.house_name, cl.detain,
			cl.grade_id, cl.section_id, new_admission.student_id as admission_id, withdrawal.student_id as withdrawal_id,
            house.student_id as house_id, reqsection.student_id as reqsection_id, statusai.new_status as statusai_id,
			std_card_change.id as std_card_change
			from atif.class_list cl
			left join
			(SELECT * FROM req_admission where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as new_admission on new_admission.student_id = cl.id
			left join
			(SELECT * FROM req_withdrawal where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as withdrawal on withdrawal.student_id = cl.id
			left join
			(SELECT * FROM req_student_card where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' and new_adm = 0 group by student_id) as std_card_change on std_card_change.student_id = cl.id
            left join 
            (SELECT * From req_house where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as house on house.student_id = cl.id
            left join 
            (SELECT * From req_section where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as reqsection on reqsection.student_id = cl.id
            left join 
            (SELECT * From req_statusai where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "') as statusai on statusai.student_id = cl.id
			) as ana
			group by ana.grade_name, ana.section_name
			order by ana.grade_id, ana.section_id";
		$query=$this->db->query($thisQuery);
		
		//print_r($thisQuery);
		$rows_array = $query->result_array();
		return $rows_array;
	}


	public function getStudentGradeSummary_Date($DateFrom, $DateTo)
	{
		$query=$this->db->query("select
			ana.grade_name, ana.section_name,
			ana.grade_id, ana.section_id,
			count(ana.gs_id) AS students,
			count(ana.admission_id) as req_admission,
			count(ana.withdrawal_id) as req_withdrawal,
			count(ana.std_card_change) as req_std_card,
            count(ana.house_id) as req_house,
            count(ana.reqsection_id) as req_section,
            sum(if(ana.detain = '1', 1, 0)) as detain,
            sum(if(ana.statusai_id = '3', 1, 0)) as inative_add,
            sum(if(ana.statusai_id = '1', 1, 0)) as inative_less
			from (select cl.id,
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.section_name, cl.house_name, cl.detain,
			cl.grade_id, cl.section_id, new_admission.student_id as admission_id, withdrawal.student_id as withdrawal_id,
            house.student_id as house_id, reqsection.student_id as reqsection_id, statusai.new_status as statusai_id,
			std_card_change.id as std_card_change
			from atif.class_list cl
			left join
			(SELECT * FROM req_admission where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as new_admission on new_admission.student_id = cl.id
			left join
			(SELECT * FROM req_withdrawal where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as withdrawal on withdrawal.student_id = cl.id
			left join
			(SELECT * FROM req_student_card where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' and new_adm = 0 group by student_id) as std_card_change on std_card_change.student_id = cl.id
            left join 
            (SELECT * From req_house where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as house on house.student_id = cl.id
            left join 
            (SELECT * From req_section where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as reqsection on reqsection.student_id = cl.id
            left join 
            (SELECT * From req_statusai where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "') as statusai on statusai.student_id = cl.id
			) as ana
			group by ana.grade_name
			order by ana.grade_id, ana.section_id");
		$rows_array = $query->result_array();
		return $rows_array;
	}


	public function getStudentWingSummary_Date($DateFrom, $DateTo)
	{
		$query=$this->db->query("select
			ana.grade_name, ana.section_name,
			ana.wing_name,
			ana.grade_id, ana.section_id,
			count(ana.gs_id) AS students,
			count(ana.admission_id) as req_admission,
			count(ana.withdrawal_id) as req_withdrawal,
			count(ana.std_card_change) as req_std_card,
            count(ana.house_id) as req_house,
            count(ana.reqsection_id) as req_section,
            sum(if(ana.detain = '1', 1, 0)) as detain,
            sum(if(ana.statusai_id = '3', 1, 0)) as inative_add,
            sum(if(ana.statusai_id = '1', 1, 0)) as inative_less
			from (select cl.id,
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.section_name, cl.house_name, cl.detain,
			cl.grade_id, cl.section_id, new_admission.student_id as admission_id, withdrawal.student_id as withdrawal_id,
            house.student_id as house_id, reqsection.student_id as reqsection_id, statusai.new_status as statusai_id,
			std_card_change.id as std_card_change, wing.name as wing_name
			from atif.class_list cl
			left join
			(SELECT * FROM req_admission where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as new_admission on new_admission.student_id = cl.id
			left join
			(SELECT * FROM req_withdrawal where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as withdrawal on withdrawal.student_id = cl.id
			left join
			(SELECT * FROM req_student_card where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' and new_adm = 0 group by student_id) as std_card_change on std_card_change.student_id = cl.id
            left join 
            (SELECT * From req_house where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as house on house.student_id = cl.id
            left join 
            (SELECT * From req_section where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as reqsection on reqsection.student_id = cl.id
            left join 
            (SELECT * From req_statusai where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "') as statusai on statusai.student_id = cl.id
            left join atif._wing_grade as wg on wg.grade_id = cl.grade_id
			left join atif._wing as wing on wing.id = wg.wing_id
			) as ana
			group by ana.wing_name
			order by ana.grade_id, ana.section_id");
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentCampusSummary_Date($DateFrom, $DateTo)
	{
		$query=$this->db->query("select
			ana.branch_name as campus_name,
			ana.grade_name, ana.section_name,
			ana.grade_id, ana.section_id,
			count(ana.gs_id) AS students,
			count(ana.admission_id) as req_admission,
			count(ana.withdrawal_id) as req_withdrawal,
			count(ana.std_card_change) as req_std_card,
            count(ana.house_id) as req_house,
            count(ana.reqsection_id) as req_section,
            sum(if(ana.detain = '1', 1, 0)) as detain,
            sum(if(ana.statusai_id = '3', 1, 0)) as inative_add,
            sum(if(ana.statusai_id = '1', 1, 0)) as inative_less
			from (select cl.id,
			cl.gs_id, cl.gr_no, cl.gf_id, cl.abridged_name, cl.grade_name, cl.section_name, cl.house_name, cl.detain,
			cl.grade_id, cl.section_id, new_admission.student_id as admission_id, withdrawal.student_id as withdrawal_id,
            house.student_id as house_id, reqsection.student_id as reqsection_id, statusai.new_status as statusai_id,
			std_card_change.id as std_card_change, wib.branch_name
			from atif.class_list cl
			left join
			(SELECT * FROM req_admission where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as new_admission on new_admission.student_id = cl.id
			left join
			(SELECT * FROM req_withdrawal where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as withdrawal on withdrawal.student_id = cl.id
			left join
			(SELECT * FROM req_student_card where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' and new_adm = 0 group by student_id) as std_card_change on std_card_change.student_id = cl.id
            left join 
            (SELECT * From req_house where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as house on house.student_id = cl.id
            left join 
            (SELECT * From req_section where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "' group by student_id) as reqsection on reqsection.student_id = cl.id
            left join 
            (SELECT * From req_statusai where req_date >= '" . $DateFrom . "' and req_date <= '" . $DateTo . "') as statusai on statusai.student_id = cl.id
            left join atif._wing_grade as wg on wg.grade_id = cl.grade_id
			left join atif._wing as wing on wing.id = wg.wing_id
			left join atif._wings_in_branch wib on wib.wing_id = wg.wing_id
			) as ana
			group by ana.branch_name
			order by ana.grade_id, ana.section_id");
		
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentAdmissionDetail_Date($DateFrom, $DateTo)
	{
		$query=$this->db->query("select
			reqa.gr_no, reqa.student_id, reqa.student_name, reqa.abridged_name, reqa.call_name, reqa.gender, reqa.req_date,
			cl.grade_name, cl.section_name, cl.gs_id
			FROM req_admission reqa
			left join class_list cl on cl.id = reqa.student_id
			where reqa.req_date >= '" . $DateFrom . "' and reqa.req_date <= '" . $DateTo . "'
			group by reqa.student_id
            order by reqa.req_date, cl.grade_id, cl.section_id");
		
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentWirhdrawalDetail_Date($DateFrom, $DateTo)
	{
		$query=$this->db->query("select
			cl.gs_id, cl.abridged_name, cl.grade_name, cl.section_name, cl.student_status_dname,
			reqw.student_id, reqw.req_date, reqw.wef_date, reqw.description
			FROM req_withdrawal reqw
			left join class_list cl on cl.id = reqw.student_id
			where reqw.req_date >= '" . $DateFrom . "' and reqw.req_date <= '" . $DateTo . "'
			group by reqw.student_id
            order by reqw.req_date, cl.grade_id, cl.section_id");
		
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentCardChangeDetail_Date($DateFrom, $DateTo)
	{
		$query=$this->db->query("select
			reqc.student_id, reqc.req_date, reqc.description, reqc.duplicate, reqc.new_adm, reqc.amount,
			cl.abridged_name, cl.grade_name, cl.section_name, cl.call_name, cl.gs_id
			FROM req_student_card reqc
			left join class_list cl on cl.id = reqc.student_id
			where reqc.req_date >= '" . $DateFrom . "' and reqc.req_date <= '" . $DateTo . "'
			and reqc.new_adm = 0
            order by reqc.req_date, cl.grade_id, cl.section_id");
		
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentSectionDetail_Date($DateFrom, $DateTo)
	{
		$query=$this->db->query("select 
			reqs.req_date, sec1.dname as new_section, sec2.dname as old_section,
			cl.abridged_name, cl.gs_id, cl.grade_name, cl.section_name
			FROM req_section reqs
			left join class_list cl on cl.id = reqs.student_id
			left join _section sec1 on sec1.id = reqs.new_section
            left join _section sec2 on sec2.id = reqs.old_section
			where reqs.req_date >= '" . $DateFrom . "' and reqs.req_date <= '" . $DateTo . "'
			order by reqs.req_date, cl.grade_id, cl.section_id");
		
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentHouseDetail_Date($DateFrom, $DateTo)
	{
		$query=$this->db->query("select
			cl.gs_id, cl.abridged_name, cl.grade_name, cl.section_name,
			h1.short_name as old_house, h2.short_name as new_house, reqh.req_date
			FROM req_house reqh
			left join _house h1 on h1.id = reqh.old_house
			left join _house h2 on h2.id = reqh.new_house
			left join class_list cl on cl.id = reqh.student_id
			where reqh.req_date >= '" . $DateFrom . "' and reqh.req_date <= '" . $DateTo . "'
			order by reqh.req_date, cl.grade_id, cl.section_id");
		
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentDetainDetail_Date()
	{
		$query=$this->db->query("select cl.gs_id, cl.abridged_name,
			cl.grade_name, cl.section_name, cl.previous_class, cl.detain
			FROM class_list cl 
			WHERE cl.detain = 1");
		
		$rows_array = $query->result_array();
		return $rows_array;
	}

	public function getStudentActiveDetail_Date($DateFrom, $DateTo)
	{
		$query=$this->db->query("select cl.gs_id, cl.abridged_name, cl.grade_name, cl.section_name,
			rsai.req_date, ss1.dname as old, ss2.dname as new
			FROM req_statusai rsai
			left join class_list cl on cl.id = rsai.student_id
			left join _student_status ss1 on ss1.id = rsai.old_status
			left Join _student_status ss2 on ss2.id = rsai.new_status
			WHERE rsai.req_date >= '" . $DateFrom . "' and rsai.req_date <= '" . $DateTo . "'
			order by rsai.req_date, cl.grade_id, cl.section_id");
		
		$rows_array = $query->result_array();
		return $rows_array;
	}

}