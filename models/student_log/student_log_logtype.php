<?php
class Student_log_logtype extends CI_Model{

	private $db_student_log;

	function __construct()
	{
		parent::__construct();
		$this->db_student_log = $this->load->database('student_log',TRUE);
	}


	protected $_table_name = 'log_type';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'thisorder asc';	
	protected $_timestamps = TRUE;

	

	public function getStudentSmartCardDetail($GSID){
		$query =
		"SELECT
		(@num:=@num+1) as num,
		sc.req_date, sc.description,
		sc.new_adm, sc.`duplicate`, 
		if(sc.new_adm=1, 'New Admission', 'Duplicate') as card_description

		FROM atif.class_list cl
		
		left join atif.req_student_card sc on sc.student_id=cl.id
		join (select @num := 0) as number

		where cl.gs_id = '$GSID'

		order by sc.req_date desc";

		$sql = $this->db_student_log->query($query);
		return $sql->result();
	}




	public function get_comments($GSID, $CommentsType){
		$query =
		"SELECT
		(@num:=@num+1) as num,
		comm.id, comm.comments, from_unixtime(comm.created) as created, comm.register_by, comm.tag,
		ifnull(sr.employee_id,'') as employee_id, sr.name as staff_name, sr.gender,
		cl.abridged_name, user.id as user_id
		
		
		FROM atif.class_list cl
		
		left join atif_student_log.log_comments as comm on comm.student_id=cl.id
		left join atif.staff_registered as sr on sr.user_id=comm.register_by
		left join atif.users as user on user.id=sr.user_id
		
		join (select @num := 0) as number

		where cl.gs_id = '$GSID' and comm.tag like '%" . $CommentsType . "%'

		order by comm.created desc";


		$sql = $this->db_student_log->query($query);
		return $sql->result();
	}





	public function getStudentName($GSID){

		$query=$this->db_student_log->query("SELECT abridged_name as thisdata FROM atif.class_list WHERE gs_id = '$GSID'"); 
		$row = $query->row_array();
		$thisData = $row['thisdata'];

		return $thisData;
	}


	public function getStudentID($GSID){
		$query=$this->db_student_log->query("SELECT id as thisdata FROM atif.class_list WHERE gs_id = '$GSID'"); 
		$row = $query->row_array();
		$thisData = $row['thisdata'];

		return $thisData;	
	}







	public function getStudentGradeName($GSID){

		$query=$this->db_student_log->query("SELECT grade_name as thisdata FROM atif.class_list WHERE gs_id = '$GSID'"); 
		$row = $query->row_array();
		$thisData = $row['thisdata'];

		return $thisData;
	}

	public function getStudentAttendance($GSID, $GradeName, $DateFrom, $DateTo)
	{
		$query = "select 
		day_name, date, is_on, is_holiday, is_weekend, time, abridged_name, grade_name, grade_on, 
		day_description, tmp_card_no, tmp_card, year, month, day, hours, minutes

		from (

		select

		DAYNAME(cal.date) as day_name, cal.date, cal.is_on, cal.is_holiday, cal.is_weekend,
		atd_in.time, cl.abridged_name, '$GradeName' as grade_name,


		if(cal.is_on = 0, 0,
			if('$GradeName' = 'PN', cal.pn,
			if('$GradeName' = 'N', cal.n,
			if('$GradeName' = 'KG', cal.kg,
			if('$GradeName' = 'I', cal.i,
			if('$GradeName' = 'II', cal.ii,
			if('$GradeName' = 'III', cal.iii,
			if('$GradeName' = 'IV', cal.iv,
			if('$GradeName' = 'V', cal.v,
			if('$GradeName' = 'VI', cal.vi,
			if('$GradeName' = 'VII', cal.vii,
			if('$GradeName' = 'VIII', cal.viii,
			if('$GradeName' = 'IX', cal.ix,
			if('$GradeName' = 'X', cal.x,
			if('$GradeName' = 'XI', cal.xi,
			if('$GradeName' = 'A1', cal.a1,
			if('$GradeName' = 'A2', cal.a2, 99))))))))))))))))) as grade_on,

		cal.description as day_description, tcard.tmp_card_no,

		if(tcard.tmp_card_no >=301 and tcard.tmp_card_no <=500, 'Interim', 
			if(tcard.tmp_card_no >= 501 and tcard.tmp_card_no <=999, 'Day Pass', '')) as tmp_card,	

		DATE_FORMAT(cal.date,'%Y') as year, DATE_FORMAT(cal.date,'%m') as month, DATE_FORMAT(cal.date,'%d') as day,
		TIME_FORMAT(atd_in.time, '%H') as hours, TIME_FORMAT(atd_in.time, '%i') as minutes


		from atif_attendance.attendance_calendar cal

		left join (select gs_id, date, min(time) as time from atif_attendance.student_attendance 
			where gs_id = '$GSID'
			group by date) as atd_in on atd_in.date = cal.date
			
		left join atif.class_list as cl on cl.gs_id = atd_in.gs_id
		left join (select min(tmp_card_no) as tmp_card_no, date, gs_id from atif_attendance.tmpcard_student_used 
				   where gs_id = '$GSID' group by date) as tcard 
				on tcard.gs_id = atd_in.gs_id and tcard.date = cal.date


		where cal.date >= '$DateFrom' and cal.date <= '$DateTo'

		order by cal.date asc
		) as student_data


		group by date

		order by date";


		
		$sql = $this->db_student_log->query($query);
		return $sql->result();
	}




	public function getAllLogNames(){
		$query =
		"SELECT
		* from atif_student_log.log_type

		where record_deleted = 0
		and name != 'Time Line'

		order by thisorder asc";

		$sql = $this->db_student_log->query($query);
		return $sql->result();
	}

















	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_student_log->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_student_log->where('record_deleted', 0);
		$this->db_student_log->where('show_on_tab', 1);
		if(!count($this->db_student_log->ar_orderby)){
			$this->db_student_log->order_by($this->_order_by);
		}
		return $this->db_student_log->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_student_log->where($where);
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
			$this->db_student_log->set($data);
			$this->db_student_log->insert($this->_table_name);
			$id = $this->db_student_log->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_student_log->set($data);
			$this->db_student_log->where($this->_primary_key, $id);
			$this->db_student_log->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_student_log->where($this->_primary_key, $id);
		$this->db_student_log->limit(1);
		$this->db_student_log->delete($this->_table_name);
	}
}