<?php
class Stored_procedure_model extends CI_Model{

	private $db_storedProcedure;

	function __construct()
	{
		parent::__construct();
		$this->db_storedProcedure = $this->load->database('atif_sp',TRUE);
	}


	protected $_table_name = 'hello';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'time_in desc';	
	protected $_timestamps = TRUE;




	public function get_ThisStudent_TimeLine($GSID, $LimitFrom, $LimitTo){
		$query = "CALL `Get_Student_TimeLine`('$GSID', $LimitFrom, $LimitTo)";

		$sql = $this->db_storedProcedure->query($query);
		return $sql->result();
	}



	public function get_ThisStudent_TimeLine_Options($GSID, $LimitFrom, $LimitTo, $LogTypeOptions){

		$query = "select 
			id, student_id, log_name, change_description, reason, 
			color_bg, color_font, color_icon, icon, 
			recorded_date, recorded_time, recorded_date_format,

			if(day_before=0, 'Today',

				if(day_before=1, concat(day_before, ' day ago'), concat(day_before, ' days ago'))

			  ) as day_before,

			DATE_FORMAT(recorded_date, '%a') as day_name_short, full_recorded_time





			from



			(select

			log_con.id as id,

			log_con.student_id,

			'Billing' as log_name,

			if(cld.aug!=log_con.aug, concat('Aug: ', log_con.aug, ' to ', cld.aug),

				if(cld.sep!=log_con.sep, concat('Sep: ', log_con.sep, ' to ', cld.sep),

				if(cld.oct!=log_con.oct, concat('Oct: ', log_con.oct, ' to ', cld.oct),

				if(cld.nov!=log_con.nov, concat('Nov: ', log_con.nov, ' to ', cld.nov),

				if(cld.dec!=log_con.dec, concat('Dec: ', log_con.dec, ' to ', cld.dec),

				if(cld.jan!=log_con.jan, concat('Jan: ', log_con.jan, ' to ', cld.jan),

				if(cld.feb!=log_con.feb, concat('Feb: ', log_con.feb, ' to ', cld.feb),

				if(cld.mar!=log_con.mar, concat('Mar: ', log_con.mar, ' to ', cld.mar),

				if(cld.apr!=log_con.apr, concat('Apr: ', log_con.apr, ' to ', cld.apr),

				if(cld.may!=log_con.may, concat('May: ', log_con.may, ' to ', cld.may),

				if(cld.jun!=log_con.jun, concat('Jun: ', log_con.jun, ' to ', cld.jun),

				if(cld.jul!=log_con.jul, concat('Jul: ', log_con.jul, ' to ', cld.jul), ''

				)))))))))))) as change_description,

			'' as reason,

			color.color_bg,

			color.color_font,

			'bg-blue' as color_icon, 

			'fa-edit' as icon, 

			from_unixtime(log_con.updated_at, '%Y-%m-%d') as recorded_date,

			from_unixtime(log_con.updated_at, '%h:%i %p') as recorded_time,

			from_unixtime(log_con.updated_at, '%d-%b') as recorded_date_format,

			datediff(from_unixtime(UNIX_TIMESTAMP(), '%Y-%m-%d'), from_unixtime(log_con.updated_at, '%Y-%m-%d')) as day_before,

			log_con.updated_at as full_recorded_time



			from atif_student_log.log_student_concession as log_con



			JOIN (select color_bg, color_font

				from atif_student_log.log_type

				where id=5) as color



			LEFT JOIN atif_fee_student.concession_level_definition as cld on cld.student_id = log_con.student_id

			LEFT JOIN atif.student_registered as sr on sr.id = log_con.student_id



			where sr.gs_id = '$GSID'









			UNION









			select 

			sts.id as id, 

			sts.student_id as student_id,

			'Student Status' as log_name,

			concat(sts_old.code, ' to ', sts_new.code) as change_description,

			sar.status_change_comments as reason, 

			'' as color_bg,

			'' as color_font,

			'bg-pink' as color_icon, 

			'fa-child' as icon, 

			from_unixtime(sts.created, '%Y-%m-%d') as recorded_date,

			from_unixtime(sts.created, '%h:%i %p') as recorded_time,

			from_unixtime(sts.created, '%d-%b') as recorded_date_format,

			datediff(from_unixtime(UNIX_TIMESTAMP(), '%Y-%m-%d'), from_unixtime(sts.created, '%Y-%m-%d')) as day_before,

			sts.created as full_recorded_time



			from atif_student_log.log_student_status as sts

			LEFT JOIN atif.student_academic_record as sar 

				on sar.student_id = sts.student_id and sar.academic_session_id = sts.academic_session_id

			LEFT JOIN atif._studentstatus as sts_old 

				on sts_old.id = sts.old_status_id

			LEFT JOIN atif._studentstatus as sts_new 

				on sts_new.id = sar.student_status_id

			LEFT JOIN atif.student_registered as sr on sr.id = sts.student_id



			where sr.gs_id = '$GSID'









			UNION









			select 

			id, student_id, 'Attendance' as log_name,

			if(is_on=0, 'School Off',

				if(grade_on=0, 'Grade Off', 

				if(time IS NULL, 'Absent', concat('Tap-in : ', TIME_FORMAT(time, '%h:%i %p'))

			  ))) as change_description,

			'' as reason,

			'' as color_bg,

			'' as color_font,

			'bg-pink' as color_icon, 

			'fa-child' as icon,

			date as recorded_date,

			TIME_FORMAT(time, '%h:%i %p') as recorded_time,

			DATE_FORMAT(date, '%d-%b') as recorded_date_format,

			datediff(from_unixtime(UNIX_TIMESTAMP(), '%Y-%m-%d'), date) as day_before,

			full_recorded_time



			from (



			select



			atd_in.id, DAYNAME(cal.date) as day_name, cal.date, cal.is_on, cal.is_holiday, cal.is_weekend,

			atd_in.time, cl.abridged_name, cl.grade_name, cl.id as student_id,





			if(cal.is_on = 0, 0,

				if(cl.grade_name = 'PN', cal.pn,

				if(cl.grade_name = 'N', cal.n,

				if(cl.grade_name = 'KG', cal.kg,

				if(cl.grade_name = 'I', cal.i,

				if(cl.grade_name = 'II', cal.ii,

				if(cl.grade_name = 'III', cal.iii,

				if(cl.grade_name = 'IV', cal.iv,

				if(cl.grade_name = 'V', cal.v,

				if(cl.grade_name = 'VI', cal.vi,

				if(cl.grade_name = 'VII', cal.vii,

				if(cl.grade_name = 'VIII', cal.viii,

				if(cl.grade_name = 'IX', cal.ix,

				if(cl.grade_name = 'X', cal.x,

				if(cl.grade_name = 'XI', cal.xi,

				if(cl.grade_name = 'A1', cal.a1,

				if(cl.grade_name = 'A2', cal.a2, 99))))))))))))))))) as grade_on,



			cal.description as day_description, tcard.tmp_card_no,



			if(tcard.tmp_card_no >=301 and tcard.tmp_card_no <=500, 'Interim', 

				if(tcard.tmp_card_no >= 501 and tcard.tmp_card_no <=999, 'Day Pass', '')) as tmp_card,	



			DATE_FORMAT(cal.date,'%Y') as year, DATE_FORMAT(cal.date,'%m') as month, DATE_FORMAT(cal.date,'%d') as day,

			TIME_FORMAT(atd_in.time, '%H') as hours, TIME_FORMAT(atd_in.time, '%i') as minutes,

			concat(cal.date, atd_in.time) as full_recorded_time





			from atif_attendance.attendance_calendar cal



			left join (select id, gs_id, date, min(time) as time from atif_attendance.student_attendance 

				where gs_id = '$GSID'

				group by date) as atd_in on atd_in.date = cal.date

				

			left join atif.class_list as cl on cl.gs_id = atd_in.gs_id

			left join (select min(tmp_card_no) as tmp_card_no, date, gs_id from atif_attendance.tmpcard_student_used 

					   where gs_id = '$GSID' group by date) as tcard 

					on tcard.gs_id = atd_in.gs_id and tcard.date = cal.date





			where cal.date >= '2016-08-01' and cal.date <= curdate()



			group by cal.date



			order by cal.date desc, atd_in.time asc



			) as student_data











			UNION

			select

			com.id as id,
			com.student_id,
			com.tag as log_name,
			com.comments as change_description,

			CONCAT(sfr.abridged_name, ',', sfr.employee_id) as reason,

			'' as color_bg,
			'' as color_font,
			'bg-red' as color_icon, 
			'fa-comment-o' as icon,
			from_unixtime(com.created, '%Y-%m-%d') as recorded_date,
			from_unixtime(com.created, '%h:%i %p') as recorded_time,
			from_unixtime(com.created, '%d-%b') as recorded_date_format,
			datediff(from_unixtime(UNIX_TIMESTAMP(), '%Y-%m-%d'), from_unixtime(com.created, '%Y-%m-%d')) as day_before,
			com.created as full_recorded_time



			from atif_student_log.log_comments as com

			LEFT JOIN atif.student_registered as sr on sr.id = com.student_id
			LEFT JOIN atif.staff_registered as sfr on sfr.user_id = com.register_by

			where sr.gs_id = '$GSID'









			) as log_student
			where change_description != ''
			and (" . $LogTypeOptions . ") group by recorded_date, log_name, change_description

			order by recorded_date desc, full_recorded_time desc





			limit $LimitFrom, $LimitTo;
			";

		$sql = $this->db_storedProcedure->query($query);
		return $sql->result();
	}	





	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_storedProcedure->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_storedProcedure->where('record_deleted', 0);
		if(!count($this->db_storedProcedure->ar_orderby)){
			$this->db_storedProcedure->order_by($this->_order_by);
		}
		return $this->db_storedProcedure->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_storedProcedure->where($where);
		return $this->get(NULL, $single);
	}

	public function save($data, $id = NULL){

		// Set timestamps
		if($this->_timestamps == TRUE){
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = human_to_unix($now);
			$id || $data['register_by'] = (int)$this->session->userdata['user_id'];
			$data['modified'] = human_to_unix($now);
			$data['modified_by'] = (int)$this->session->userdata['user_id'];
		}

		// Insert a new record
		if ($id === NULL){
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db_storedProcedure->set($data);
			$this->db_storedProcedure->insert($this->_table_name);
			$id = $this->db_storedProcedure->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_storedProcedure->set($data);
			$this->db_storedProcedure->where($this->_primary_key, $id);
			$this->db_storedProcedure->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_storedProcedure->where($this->_primary_key, $id);
		$this->db_storedProcedure->limit(1);
		$this->db_storedProcedure->delete($this->_table_name);
	}
}