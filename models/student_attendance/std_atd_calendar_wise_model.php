<?php
class Std_atd_calendar_wise_model extends CI_Model{

	private $db_student_attendance;

	function __construct()
	{
		parent::__construct();
		$this->db_student_attendance = $this->load->database('attendance_students',TRUE);
	}


	public function getWorkingDayDate($Grade, $WorkingDay, $dateTo)
	{
		$cQuery = "SELECT * FROM attendance_calendar where is_on = 1 and is_holiday = 0 and is_weekend = 0 and " . $Grade . " = 1 and date <= '" . $dateTo . "' order by date desc limit " . $WorkingDay;
		$query = $this->db->query($cQuery);
		$row = $query->result_array();
	
		$TotalDays = count($row);
		return $row[$TotalDays - 1]['date'];
	}

	public function getStudentAttendanceDates($dateFrom, $dateTo, $Grade, $Section, $Workingdays)
	{
		$cQuery = "select * from attendance_calendar where date between '" . $dateFrom . "' and '" . $dateTo . "' and is_on = 1 and is_holiday = 0 and is_weekend = 0 ";
		$cQuery .= "and " . $Grade . " = 1 limit " . $Workingdays;
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();

   		//print_r($cQuery);
   		return $row;
	}



	public function getStudentsAttendanceFrom_Penalty($dateFrom, $dateTo, $Grade, $Section, $attendanceDates)
	{
		$GroupConcat = "";
		$AtdCalQuery = "";
		$TotalDays = 0;
		$DaysColumns_wda = "";
		$DaysColumns_aa = "";
		$TotalPresent = "(";		

		$TotalDays = count($attendanceDates);
   		foreach ($attendanceDates as $thisDate) {
   			$date = strtotime($thisDate['date']);
			$day = date('d', $date);
			$month = date('m', $date);

   			$GroupConcat .= "GROUP_CONCAT(DISTINCT if(DAY(atd.Date) = " . $day . " and MONTH(atd.date) = " . $month . ", atd.time, " .
   										 "if(DAY(aas.date) = " . $day . " and MONTH(aas.date) = " . $month . ", abc.dname, NULL))) AS '" . $thisDate['date'] . "', ";
			$DaysColumns_wda .= "wda.`" . $thisDate['date'] . "`, ";
			$DaysColumns_aa .= "aa.`" . $thisDate['date'] . "`, ";
			$TotalPresent .= "if (wda.`" . $thisDate['date'] . "` > '00:00:00' and 
								  wda.`" . $thisDate['date'] . "` != 'A' and 
								  wda.`" . $thisDate['date'] . "` != 'U', 1, 0) + ";
   		}

   		$GroupConcat = rtrim($GroupConcat, ", ");
   		$DaysColumns_wda = rtrim($DaysColumns_wda, ",");
   		$DaysColumns_aa = rtrim($DaysColumns_aa, ",");
   		$TotalPresent = rtrim($TotalPresent, "+ ");
   		$TotalPresent .= ") as total_p ";

		$AtdCalQuery .= "SELECT aa.gs_id, aa.std_status_code, aa.gr_no, aa.abridged_name, aa.call_name, aa.grade_name, aa.section_name, ";
		$AtdCalQuery .= $DaysColumns_aa;
		$AtdCalQuery .= "aa.daypass_used_ten, aa.total_p, (" . $TotalDays . "-aa.total_p) as total_a, aa.total_l, ";
		$AtdCalQuery .= "(((" . $TotalDays . "-aa.total_p) * 3)+(aa.total_l*2)+(if(aa.daypass_used_ten > 0 , aa.daypass_used_ten, 0))) as penalty, ";
		$AtdCalQuery .=  "aa.total_d ";
		$AtdCalQuery .= "FROM (";
   		$AtdCalQuery .= "SELECT ";
   		$AtdCalQuery .= "wda.gs_id, wda.std_status_code, wda.gr_no, wda.abridged_name, wda.call_name, wda.grade_name, wda.section_name, ";
   		$AtdCalQuery .= $DaysColumns_wda;
   		$AtdCalQuery .= "wda.daypass_used_ten, wda.total_pp, wda.total_l, wda.total_aa, wda.total_d, ";
   		$AtdCalQuery .= $TotalPresent;   		
   		$AtdCalQuery .= " FROM (";
   		$AtdCalQuery .= "SELECT atd.gs_id, cl.gr_no, cl.std_status_code, cl.abridged_name, cl.call_name, cl.grade_name, cl.section_name, dp.daypass_used_ten,";
   		$AtdCalQuery .= $GroupConcat;
   		$AtdCalQuery .= ", COUNT(if(atd.time > '00:00:00', atd.time, NULL)) AS 'total_pp',						
						COUNT(if(atd.time >= '07:41:00', atd.time, NULL)) AS 'total_l',						
						(" . $TotalDays . " - COUNT(if(atd.time > '00:00:00', atd.time, NULL))) as total_aa,						
						" . $TotalDays . " as total_d
						FROM (select DISTINCT gs_id, date, time, ip4, location_id, record_deleted from atif_attendance.student_attendance 
							WHERE date BETWEEN '" . $dateFrom . "' and '" . $dateTo . "'
							group by gs_id, date ORDER BY `student_attendance`.`gs_id` ASC) as atd
						right join atif.class_list cl
						on cl.gs_id = atd.gs_id
						left join 
						(select 
							atif_attendance.tmpcard_student_used.gs_id AS GS_ID,
							atif_attendance.tmpcard_student_used.date AS DATE,
							count(0) AS DayPass_Used_TEN from atif_attendance.tmpcard_student_used
							where ((atif_attendance.tmpcard_student_used.date >= '" . $dateFrom . "')
							and (atif_attendance.tmpcard_student_used.tmp_card_no > 500)
							and (atif_attendance.tmpcard_student_used.tmp_card_no < 700))
							group by atif_attendance.tmpcard_student_used.gs_id
							order by year(atif_attendance.tmpcard_student_used.date) desc,
							month(atif_attendance.tmpcard_student_used.date) desc, dayofmonth(atif_attendance.tmpcard_student_used.date) desc) as dp
						on dp.gs_id = atd.gs_id

						left join atif_attendance.attendance_absent_solved aas
						on aas.gs_id = atd.gs_id and aas.date BETWEEN '" . $dateFrom . "' and '" . $dateTo . "'
						left join atif_attendance.attendance_absent_case abc
						on abc.id = aas.absent_case_id
						left join atif_attendance.attendance_absent_reasons abr
						on abr.id = aas.absent_reason_id

						WHERE atd.date BETWEEN '" . $dateFrom . "' and '" . $dateTo . "'
						and cl.grade_name = '" . $Grade . "' and cl.section_name = '" . $Section . "' 						
						GROUP BY atd.gs_id
						order by total_pp asc, total_l desc, daypass_used_ten desc";
		$AtdCalQuery .= ") as wda) as aa /*where 
			(aa.grade_name != 'PN' and aa.grade_name != 'N' or aa.grade_name != 'KG' and
			 aa.grade_name != 'I' and aa.grade_name != 'II')*/ order by penalty desc";

		/***** change here *****/
		//print_r($AtdCalQuery);
		$cQuery = $AtdCalQuery;
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();

   		return $row;   		
	}


	public function getStudentsAttendanceOfGSID($dateFrom, $dateTo, $GSID, $attendanceDates)
	{
		$GroupConcat = "";
		$AtdCalQuery = "";
		$TotalDays = 0;
		$DaysColumns_wda = "";
		$DaysColumns_aa = "";
		$TotalPresent = "(";		

		$TotalDays = count($attendanceDates);
   		foreach ($attendanceDates as $thisDate) {
   			$date = strtotime($thisDate['date']);
			$day = date('d', $date);
			$month = date('m', $date);

   			$GroupConcat .= "GROUP_CONCAT(DISTINCT if(DAY(atd.Date) = " . $day . " and MONTH(atd.date) = " . $month . ", atd.time, " .
   										 "if(DAY(aas.date) = " . $day . " and MONTH(aas.date) = " . $month . ", abc.dname, NULL))) AS '" . $thisDate['date'] . "', ";
			$DaysColumns_wda .= "wda.`" . $thisDate['date'] . "`, ";
			$DaysColumns_aa .= "aa.`" . $thisDate['date'] . "`, ";
			$TotalPresent .= "if (wda.`" . $thisDate['date'] . "` > '00:00:00' and 
								  wda.`" . $thisDate['date'] . "` != 'A' and 
								  wda.`" . $thisDate['date'] . "` != 'U', 1, 0) + ";
   		}

   		$GroupConcat = rtrim($GroupConcat, ", ");
   		$DaysColumns_wda = rtrim($DaysColumns_wda, ",");
   		$DaysColumns_aa = rtrim($DaysColumns_aa, ",");
   		$TotalPresent = rtrim($TotalPresent, "+ ");
   		$TotalPresent .= ") as total_p ";

		$AtdCalQuery .= "SELECT aa.gs_id, aa.gr_no, aa.abridged_name, aa.call_name, aa.grade_name, aa.section_name, ";
		$AtdCalQuery .= $DaysColumns_aa;
		$AtdCalQuery .= "aa.daypass_used_ten, aa.total_p, (" . $TotalDays . "-aa.total_p) as total_a, aa.total_l, ";
		$AtdCalQuery .= "(((" . $TotalDays . "-aa.total_p) * 3)+(aa.total_l*2)+(if(aa.daypass_used_ten > 0 , aa.daypass_used_ten, 0))) as penalty, ";
		$AtdCalQuery .=  "aa.total_d ";
		$AtdCalQuery .= "FROM (";
   		$AtdCalQuery .= "SELECT ";
   		$AtdCalQuery .= "wda.gs_id, wda.gr_no, wda.abridged_name, wda.call_name, wda.grade_name, wda.section_name, ";
   		$AtdCalQuery .= $DaysColumns_wda;
   		$AtdCalQuery .= "wda.daypass_used_ten, wda.total_pp, wda.total_l, wda.total_aa, wda.total_d, ";
   		$AtdCalQuery .= $TotalPresent;   		
   		$AtdCalQuery .= " FROM (";
   		$AtdCalQuery .= "SELECT atd.gs_id, cl.gr_no, cl.abridged_name, cl.call_name, cl.grade_name, cl.section_name, dp.daypass_used_ten,";
   		$AtdCalQuery .= $GroupConcat;
   		$AtdCalQuery .= ", COUNT(if(atd.time > '00:00:00', atd.time, NULL)) AS 'total_pp',						
						COUNT(if(atd.time >= '07:41:00', atd.time, NULL)) AS 'total_l',						
						(" . $TotalDays . " - COUNT(if(atd.time > '00:00:00', atd.time, NULL))) as total_aa,						
						" . $TotalDays . " as total_d
						FROM (select DISTINCT gs_id, date, time, ip4, location_id, record_deleted from atif_attendance.student_attendance
							WHERE date BETWEEN '" . $dateFrom . "' and '" . $dateTo . "'
							group by gs_id, date ORDER BY `student_attendance`.`gs_id` ASC) as atd
						right join atif.students_current_classlist cl
						on cl.gs_id = atd.gs_id
						left join 
						(select 
							atif_attendance.tmpcard_student_used.gs_id AS GS_ID,
							atif_attendance.tmpcard_student_used.date AS DATE,
							count(0) AS DayPass_Used_TEN from atif_attendance.tmpcard_student_used
							where ((atif_attendance.tmpcard_student_used.date >= '" . $dateFrom . "')
							and (atif_attendance.tmpcard_student_used.tmp_card_no > 500)
							and (atif_attendance.tmpcard_student_used.tmp_card_no < 700))
							group by atif_attendance.tmpcard_student_used.gs_id
							order by year(atif_attendance.tmpcard_student_used.date) desc,
							month(atif_attendance.tmpcard_student_used.date) desc, dayofmonth(atif_attendance.tmpcard_student_used.date) desc) as dp
						on dp.gs_id = atd.gs_id

						left join atif_attendance.attendance_absent_solved aas
						on aas.gs_id = atd.gs_id and aas.date BETWEEN '" . $dateFrom . "' and '" . $dateTo . "'
						left join atif_attendance.attendance_absent_case abc
						on abc.id = aas.absent_case_id
						left join atif_attendance.attendance_absent_reasons abr
						on abr.id = aas.absent_reason_id

						WHERE atd.date BETWEEN '" . $dateFrom . "' and '" . $dateTo . "'						
						and cl.gs_id = '" . $GSID . "' 
						GROUP BY atd.gs_id
						order by total_pp asc, total_l desc, daypass_used_ten desc";
		$AtdCalQuery .= ") as wda) as aa order by penalty desc";

		//print_r($AtdCalQuery);
		$cQuery = $AtdCalQuery;
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();

   		return $row;
	}




	public function getStudentsAttendanceFrom_Absent($dateFrom, $dateTo, $Grade, $Section, $attendanceDates)
	{
		$GroupConcat = "";
		$AtdCalQuery = "";
		$TotalDays = 0;
		$DaysColumns_wda = "";
		$DaysColumns_aa = "";
		$TotalPresent = "(";		

		$TotalDays = count($attendanceDates);
   		foreach ($attendanceDates as $thisDate) {
   			$date = strtotime($thisDate['date']);
			$day = date('d', $date);
			$month = date('m', $date);

   			$GroupConcat .= "GROUP_CONCAT(DISTINCT if(DAY(atd.Date) = " . $day . " and MONTH(atd.date) = " . $month . ", atd.time, " .
   										 "if(DAY(aas.date) = " . $day . " and MONTH(aas.date) = " . $month . ", abc.dname, NULL))) AS '" . $thisDate['date'] . "', ";
			$DaysColumns_wda .= "wda.`" . $thisDate['date'] . "`, ";
			$DaysColumns_aa .= "aa.`" . $thisDate['date'] . "`, ";
			$TotalPresent .= "if (wda.`" . $thisDate['date'] . "` > '00:00:00' and 
								  wda.`" . $thisDate['date'] . "` != 'A' and 
								  wda.`" . $thisDate['date'] . "` != 'U', 1, 0) + ";
   		}

   		$GroupConcat = rtrim($GroupConcat, ", ");
   		$DaysColumns_wda = rtrim($DaysColumns_wda, ",");
   		$DaysColumns_aa = rtrim($DaysColumns_aa, ",");
   		$TotalPresent = rtrim($TotalPresent, "+ ");
   		$TotalPresent .= ") as total_p ";

		$AtdCalQuery .= "SELECT aa.gs_id, aa.std_status_code, aa.gr_no, aa.abridged_name, aa.call_name, aa.grade_name, aa.section_name, ";
		$AtdCalQuery .= $DaysColumns_aa;
		$AtdCalQuery .= "aa.daypass_used_ten, aa.total_p, (" . $TotalDays . "-aa.total_p) as total_a, aa.total_l, ";
		$AtdCalQuery .= "(((" . $TotalDays . "-aa.total_p) * 3)+(aa.total_l*2)+(if(aa.daypass_used_ten > 0 , aa.daypass_used_ten, 0))) as penalty, ";
		$AtdCalQuery .=  "aa.total_d ";
		$AtdCalQuery .= "FROM (";
   		$AtdCalQuery .= "SELECT ";
   		$AtdCalQuery .= "wda.gs_id, wda.std_status_code, wda.gr_no, wda.abridged_name, wda.call_name, wda.grade_name, wda.section_name, ";
   		$AtdCalQuery .= $DaysColumns_wda;
   		$AtdCalQuery .= "wda.daypass_used_ten, wda.total_pp, wda.total_l, wda.total_aa, wda.total_d, ";
   		$AtdCalQuery .= $TotalPresent;   		
   		$AtdCalQuery .= " FROM (";
   		$AtdCalQuery .= "SELECT atd.gs_id, cl.gr_no, cl.std_status_code, cl.abridged_name, cl.call_name, cl.grade_name, cl.section_name, dp.daypass_used_ten,";
   		$AtdCalQuery .= $GroupConcat;
   		$AtdCalQuery .= ", COUNT(if(atd.time > '00:00:00', atd.time, NULL)) AS 'total_pp',						
						COUNT(if(atd.time >= '07:41:00', atd.time, NULL)) AS 'total_l',						
						(" . $TotalDays . " - COUNT(if(atd.time > '00:00:00', atd.time, NULL))) as total_aa,						
						" . $TotalDays . " as total_d
						FROM (select DISTINCT gs_id, date, time, ip4, location_id, record_deleted from atif_attendance.student_attendance 
							WHERE date BETWEEN '" . $dateFrom . "' and '" . $dateTo . "'
							group by gs_id, date ORDER BY `student_attendance`.`gs_id` ASC) as atd
						right join atif.class_list cl
						on cl.gs_id = atd.gs_id
						left join 
						(select 
							atif_attendance.tmpcard_student_used.gs_id AS GS_ID,
							atif_attendance.tmpcard_student_used.date AS DATE,
							count(0) AS DayPass_Used_TEN from atif_attendance.tmpcard_student_used
							where ((atif_attendance.tmpcard_student_used.date >= '" . $dateFrom . "')
							and (atif_attendance.tmpcard_student_used.tmp_card_no > 500)
							and (atif_attendance.tmpcard_student_used.tmp_card_no < 700))
							group by atif_attendance.tmpcard_student_used.gs_id
							order by year(atif_attendance.tmpcard_student_used.date) desc,
							month(atif_attendance.tmpcard_student_used.date) desc, dayofmonth(atif_attendance.tmpcard_student_used.date) desc) as dp
						on dp.gs_id = atd.gs_id

						left join atif_attendance.attendance_absent_solved aas
						on aas.gs_id = atd.gs_id and aas.date BETWEEN '" . $dateFrom . "' and '" . $dateTo . "'
						left join atif_attendance.attendance_absent_case abc
						on abc.id = aas.absent_case_id
						left join atif_attendance.attendance_absent_reasons abr
						on abr.id = aas.absent_reason_id

						WHERE atd.date BETWEEN '" . $dateFrom . "' and '" . $dateTo . "'
						and cl.grade_name = '" . $Grade . "' and cl.section_name = '" . $Section . "' 						
						GROUP BY atd.gs_id
						order by total_pp asc, total_l desc, daypass_used_ten desc";
		$AtdCalQuery .= ") as wda) as aa order by total_a desc";

		/***** change here *****/
		//print_r($AtdCalQuery);
		$cQuery = $AtdCalQuery;
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();

   		return $row;   		
	}




	public function getAllWorkingDayDate($WorkingDay, $dateTo)
	{
		$cQuery = "SELECT * FROM attendance_calendar where is_on = 1 and is_holiday = 0 and is_weekend = 0 and date <= '" . $dateTo . "' order by date desc limit " . $WorkingDay;
		$query = $this->db->query($cQuery);
		$row = $query->result_array();
	
		$TotalDays = count($row);		
		return $row[$TotalDays - 1]['date'];
	}


	public function getAllStudentAttendanceDates($dateFrom, $dateTo, $Workingdays)
	{
		$cQuery = "select * from attendance_calendar where date between '" . $dateFrom . "' and '" . $dateTo . "' and is_on = 1 and is_holiday = 0 and is_weekend = 0 ";
		$cQuery .= "limit " . $Workingdays;
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();

   		//print_r($cQuery);
   		return $row;
	}


	public function getAllStudentsAttendanceFrom_Penalty($dateFrom, $dateTo, $attendanceDates, $GradeSection)
	{
		/*
		$GroupConcat = "";
		$AtdCalQuery = "";
		$TotalDays = 0;
		$DaysColumns_wda = "";
		$DaysColumns_aa = "";
		$TotalPresent = "(";		

		$TotalDays = count($attendanceDates);
   		foreach ($attendanceDates as $thisDate) {
   			$date = strtotime($thisDate['date']);
			$day = date('d', $date);
			$month = date('m', $date);

   			$GroupConcat .= "GROUP_CONCAT(DISTINCT if(DAY(atd.Date) = " . $day . " and MONTH(atd.date) = " . $month . ", atd.time, " .
   										 "if(DAY(aas.date) = " . $day . " and MONTH(aas.date) = " . $month . ", abc.dname, NULL))) AS '" . $thisDate['date'] . "', ";
			$DaysColumns_wda .= "wda.`" . $thisDate['date'] . "`, ";
			$DaysColumns_aa .= "aa.`" . $thisDate['date'] . "`, ";
			$TotalPresent .= "if (wda.`" . $thisDate['date'] . "` > '00:00:00' and 
								  wda.`" . $thisDate['date'] . "` != 'A' and 
								  wda.`" . $thisDate['date'] . "` != 'U', 1, 0) + ";
   		}

   		$GroupConcat = rtrim($GroupConcat, ", ");
   		$DaysColumns_wda = rtrim($DaysColumns_wda, ",");
   		$DaysColumns_aa = rtrim($DaysColumns_aa, ",");
   		$TotalPresent = rtrim($TotalPresent, "+ ");
   		$TotalPresent .= ") as total_p ";

		$AtdCalQuery .= "SELECT activecc.id as activecase_case_id, activecc.close_category_id, aa.gs_id, aa.std_status_code, aa.gr_no, aa.gender, aa.official_name, aa.abridged_name, aa.call_name, aa.grade_name, aa.section_name, aa.gf_id, aa.grade_id, aa.section_id, ";
		$AtdCalQuery .= $DaysColumns_aa;
		$AtdCalQuery .= "aa.daypass_used_ten, aa.total_p, (" . $TotalDays . "-aa.total_p) as total_a, aa.total_l, ";
		$AtdCalQuery .= "(((" . $TotalDays . "-aa.total_p) * 3)+(aa.total_l*2)+(if(aa.daypass_used_ten > 0 , aa.daypass_used_ten, 0))) as penalty, ";
		$AtdCalQuery .=  "aa.total_d ";
		$AtdCalQuery .= "FROM (";
   		$AtdCalQuery .= "SELECT ";
   		$AtdCalQuery .= "wda.gs_id, wda.std_status_code, wda.gr_no, wda.gf_id, wda.grade_id, wda.section_id, wda.gender, wda.official_name, wda.abridged_name, wda.call_name, wda.grade_name, wda.section_name, ";
   		$AtdCalQuery .= $DaysColumns_wda;
   		$AtdCalQuery .= "wda.daypass_used_ten, wda.total_pp, wda.total_l, wda.total_aa, wda.total_d, ";
   		$AtdCalQuery .= $TotalPresent;   		
   		$AtdCalQuery .= " FROM (";
   		$AtdCalQuery .= "SELECT atd.gs_id, cl.gr_no, cl.grade_id, cl.std_status_code, cl.section_id, cl.gf_id, cl.gender, cl.official_name, cl.abridged_name, cl.call_name, cl.grade_name, cl.section_name, dp.daypass_used_ten,";
   		$AtdCalQuery .= $GroupConcat;
   		$AtdCalQuery .= ", COUNT(if(atd.time > '00:00:00', atd.time, NULL)) AS 'total_pp',						
						COUNT(if(atd.time >= '07:41:00', atd.time, NULL)) AS 'total_l',						
						(" . $TotalDays . " - COUNT(if(atd.time > '00:00:00', atd.time, NULL))) as total_aa,						
						" . $TotalDays . " as total_d
						FROM (select DISTINCT gs_id, date, time, ip4, location_id, record_deleted from atif_attendance.student_attendance group by gs_id, date ORDER BY `student_attendance`.`gs_id` ASC) as atd
						right join atif.class_list cl
						on cl.gs_id = atd.gs_id
						left join 
						(select 
							atif_attendance.tmpcard_student_used.gs_id AS GS_ID,
							atif_attendance.tmpcard_student_used.date AS DATE,
							count(0) AS DayPass_Used_TEN from atif_attendance.tmpcard_student_used
							where ((atif_attendance.tmpcard_student_used.date >= '" . $dateFrom . "')
							and (atif_attendance.tmpcard_student_used.tmp_card_no > 500)
							and (atif_attendance.tmpcard_student_used.tmp_card_no < 700))
							group by atif_attendance.tmpcard_student_used.gs_id
							order by year(atif_attendance.tmpcard_student_used.date) desc,
							month(atif_attendance.tmpcard_student_used.date) desc, dayofmonth(atif_attendance.tmpcard_student_used.date) desc) as dp
						on dp.gs_id = atd.gs_id

						left join atif_attendance.attendance_absent_solved aas
						on aas.gs_id = atd.gs_id and aas.date BETWEEN '" . $dateFrom . "' and '" . $dateTo . "'
						left join atif_attendance.attendance_absent_case abc
						on abc.id = aas.absent_case_id
						left join atif_attendance.attendance_absent_reasons abr
						on abr.id = aas.absent_reason_id

						WHERE atd.date BETWEEN '" . $dateFrom . "' and '" . $dateTo . "'						
						GROUP BY atd.gs_id
						order by total_pp asc, total_l desc, daypass_used_ten desc";
		$AtdCalQuery .= ") as wda) as aa
						left join (select * from activecase_case where close_category_id = 0) activecc on activecc.gs_id = aa.gs_id	
						where " . $GradeSection . "
		 				order by grade_id asc, section_id asc, penalty desc";


		//print_r($AtdCalQuery);
		$cQuery = $AtdCalQuery;
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();

   		return $row;
   		*/



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
					
					limit 3) as atd_cl
					order by atd_cl.date) as atd_cl	
				group by atd_cl.is_on";
		$cQuery = $AtdCalQuery;
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();



   		$AtdCalQuery = "select
		cl.gs_id, cl.gfid, cl.abridged_name, cl.official_name, cl.call_name, cl.std_status_code, cl.grade_name, cl.section_name, cl.gender,
		father.name as father_name, father.mobile_phone as father_mobile_phone,
		mother.name as mother_name, mother.mobile_phone as mother_mobile_phone,
		activecc.id as activecase_case_id, IFNULL(activecc.close_category_id, '') as close_category_id,
		IFNULL(last_atd.ldate, '') AS last_atd_date, cl.total_wd, cl.total_p, (cl.total_wd - cl.total_p) as total_a,
		'' as total_l, '' as daypass_used_ten

		from
			(select
			cl.gs_id, cl.abridged_name, cl.official_name, cl.call_name, cl.std_status_code, cl.std_status_category, cl.grade_name, cl.section_name, cl.gf_id, cl.gfid, cl.gender,
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
							atd_cl.date >= '" . $row[0]['date'] . "' 
						and atd_cl.date <= curdate()
						and atd_cl.is_on = 1
						group by atd.gs_id, atd.date) as atd
					group by atd.gs_id) as atd
				on atd.gs_id = cl.gs_id
			
			order by cl.grade_id, cl.section_id, cl.call_name) as cl
		left join (select
			atd.gs_id, max(atd.date) as ldate
			from atif_attendance.student_attendance as atd
			group by atd.gs_id) as last_atd
			on last_atd.gs_id = cl.gs_id
		left join (select gf_id, name, mobile_phone from atif.student_family_record where parent_type=1) as father
			on father.gf_id = cl.gf_id
		left join (select gf_id, name, mobile_phone from atif.student_family_record where parent_type=2) as mother
			on mother.gf_id = cl.gf_id
		left join (select * from activecase_case where close_category_id = 0) activecc on activecc.gs_id = cl.gs_id

		where (cl.total_wd - cl.total_p) >= 1
		and activecc.id >= 591
		and cl.std_status_category = 'student';";

		$cQuery = $AtdCalQuery;
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();
   		return $row;
	}




	public function getAllStudentsAttendanceFrom_Absent($dateFrom, $dateTo, $attendanceDates)
	{
		$GroupConcat = "";
		$AtdCalQuery = "";
		$TotalDays = 0;
		$DaysColumns_wda = "";
		$DaysColumns_aa = "";
		$TotalPresent = "(";		

		$TotalDays = count($attendanceDates);
   		foreach ($attendanceDates as $thisDate) {
   			$date = strtotime($thisDate['date']);
			$day = date('d', $date);
			$month = date('m', $date);

   			$GroupConcat .= "GROUP_CONCAT(DISTINCT if(DAY(atd.Date) = " . $day . " and MONTH(atd.date) = " . $month . ", atd.time, " .
   										 "if(DAY(aas.date) = " . $day . " and MONTH(aas.date) = " . $month . ", abc.dname, NULL))) AS '" . $thisDate['date'] . "', ";
			$DaysColumns_wda .= "wda.`" . $thisDate['date'] . "`, ";
			$DaysColumns_aa .= "aa.`" . $thisDate['date'] . "`, ";
			$TotalPresent .= "if (wda.`" . $thisDate['date'] . "` > '00:00:00' and 
								  wda.`" . $thisDate['date'] . "` != 'A' and 
								  wda.`" . $thisDate['date'] . "` != 'U', 1, 0) + ";
   		}

   		$GroupConcat = rtrim($GroupConcat, ", ");
   		$DaysColumns_wda = rtrim($DaysColumns_wda, ",");
   		$DaysColumns_aa = rtrim($DaysColumns_aa, ",");
   		$TotalPresent = rtrim($TotalPresent, "+ ");
   		$TotalPresent .= ") as total_p ";

		$AtdCalQuery .= "SELECT aa.gs_id, aa.gr_no, aa.gender, aa.official_name, aa.abridged_name, aa.call_name, aa.grade_name, aa.section_name, aa.gf_id, aa.grade_id, aa.section_id, ";
		$AtdCalQuery .= $DaysColumns_aa;
		$AtdCalQuery .= "aa.daypass_used_ten, aa.total_p, (" . $TotalDays . "-aa.total_p) as total_a, aa.total_l, ";
		$AtdCalQuery .= "(((" . $TotalDays . "-aa.total_p) * 3)+(aa.total_l*2)+(if(aa.daypass_used_ten > 0 , aa.daypass_used_ten, 0))) as penalty, ";
		$AtdCalQuery .=  "aa.total_d ";
		$AtdCalQuery .= "FROM (";
   		$AtdCalQuery .= "SELECT ";
   		$AtdCalQuery .= "wda.gs_id, wda.gr_no, wda.gf_id, wda.grade_id, wda.section_id, wda.gender, wda.official_name, wda.abridged_name, wda.call_name, wda.grade_name, wda.section_name, ";
   		$AtdCalQuery .= $DaysColumns_wda;
   		$AtdCalQuery .= "wda.daypass_used_ten, wda.total_pp, wda.total_l, wda.total_aa, wda.total_d, ";
   		$AtdCalQuery .= $TotalPresent;   		
   		$AtdCalQuery .= " FROM (";
   		$AtdCalQuery .= "SELECT atd.gs_id, cl.gr_no, cl.grade_id, cl.section_id, cl.gf_id, cl.gender, cl.official_name, cl.abridged_name, cl.call_name, cl.grade_name, cl.section_name, dp.daypass_used_ten,";
   		$AtdCalQuery .= $GroupConcat;
   		$AtdCalQuery .= ", COUNT(if(atd.time > '00:00:00', atd.time, NULL)) AS 'total_pp',						
						COUNT(if(atd.time >= '07:41:00', atd.time, NULL)) AS 'total_l',						
						(" . $TotalDays . " - COUNT(if(atd.time > '00:00:00', atd.time, NULL))) as total_aa,						
						" . $TotalDays . " as total_d
						FROM (select DISTINCT gs_id, date, time, ip4, location_id, record_deleted from atif_attendance.student_attendance
							WHERE date BETWEEN '" . $dateFrom . "' and '" . $dateTo . "'
							group by gs_id, date ORDER BY `student_attendance`.`gs_id` ASC) as atd
						right join atif.students_current_classlist cl
						on cl.gs_id = atd.gs_id
						left join 
						(select 
							atif_attendance.tmpcard_student_used.gs_id AS GS_ID,
							atif_attendance.tmpcard_student_used.date AS DATE,
							count(0) AS DayPass_Used_TEN from atif_attendance.tmpcard_student_used
							where ((atif_attendance.tmpcard_student_used.date >= '" . $dateFrom . "')
							and (atif_attendance.tmpcard_student_used.tmp_card_no > 500)
							and (atif_attendance.tmpcard_student_used.tmp_card_no < 700))
							group by atif_attendance.tmpcard_student_used.gs_id
							order by year(atif_attendance.tmpcard_student_used.date) desc,
							month(atif_attendance.tmpcard_student_used.date) desc, dayofmonth(atif_attendance.tmpcard_student_used.date) desc) as dp
						on dp.gs_id = atd.gs_id

						left join atif_attendance.attendance_absent_solved aas
						on aas.gs_id = atd.gs_id and aas.date BETWEEN '" . $dateFrom . "' and '" . $dateTo . "'
						left join atif_attendance.attendance_absent_case abc
						on abc.id = aas.absent_case_id
						left join atif_attendance.attendance_absent_reasons abr
						on abr.id = aas.absent_reason_id

						WHERE atd.date BETWEEN '" . $dateFrom . "' and '" . $dateTo . "'						
						GROUP BY atd.gs_id
						order by total_pp asc, total_l desc, daypass_used_ten desc";
		$AtdCalQuery .= ") as wda) as aa
						order by grade_id asc, section_id asc, penalty desc";

		//print_r($AtdCalQuery);
		$cQuery = $AtdCalQuery;
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();

   		return $row;   		
	}
}