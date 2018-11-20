<?php
class Ajax_base_model extends CI_Model{
	
	private $NDB;
	private $DDB;
	
	public function __construct(){ 	
		parent::__construct(); 
	}
	
	//* Get Active Case Updation
	
	public function get_notify_method( $category, $notify_to, $unread ){
		$this->NDB = $this->load->database("atif_notification", TRUE);
		//$query = "SELECT * FROM atif_notification.notify_meta_data AS md WHERE md.category_id=".$category." AND notify_to = ".$notify_to." AND is_read = 0";
		$query = "SELECT * FROM atif_notification.notify_meta_data AS md WHERE notify_to = ".$notify_to." AND is_read = 0 ";
		$result = $this->NDB->query( $query );
		if( $result->num_rows() > 0 ){
			$return = $result->result_array();
		}else{
			$return = FALSE;
		}
		return $return;
	}
	
	
	
public function get_notification_method( $category, $notify_to ){
	$this->NDB = $this->load->database("atif_notification", TRUE);

	/*$query = "SELECT 
	md.id AS N_log_id,
	md.category_id AS N_cat_id,
	nc.name AS N_type,
	cd.start_case_name AS Case_Name,
	md.url AS N_url,
	md.message AS N_message,
	md.gs_id AS gs_id,
	md.notify_to AS notify_to,
	md.is_read AS N_seen,
	md.created AS N_create_date,
	sr.id AS S_id,
	sr.employee_id AS S_emp_id,
	sr.abridged_name AS S_name,
	sr.designation AS S_desgntn,
	sr.department AS S_deprt
	FROM  atif_attendance.activecase_case_desc as acd
	left join atif_notification.`notify_meta_data` as md
	on(md.gs_id= acd.gs_id)
	LEFT JOIN atif.staff_registered AS sr
	ON( sr.user_id = md.register_by)
	LEFT JOIN atif_notification.category AS nc
	ON(nc.id = md.category_id)
	LEFT JOIN atif_attendance.activecase_case_desc AS cd
	ON(cd.gs_id = md.gs_id )
	
	WHERE 
	md.category_id=".$category."
	AND md.notify_to =".$notify_to."
	AND from_unixtime(md.created) > '2017-07-01' GROUP BY md.id ORDER BY md.id DESC";
	
	$query ="SELECT 
	md.id AS N_log_id,
	md.category_id AS N_cat_id,
	nc.name AS N_type,
	acd.start_case_name AS Case_Name,
	md.url AS N_url,
	md.message AS N_message,
	md.gs_id AS gs_id,
	md.notify_to AS notify_to,
	md.is_read AS N_seen,
	md.created AS N_create_date,
	sr.id AS S_id,
	sr.employee_id AS S_emp_id,
	sr.abridged_name AS S_name,
	sr.designation AS S_desgntn,
	sr.department AS S_deprt
	FROM  atif_attendance.activecase_case_desc as acd
	
	left join atif_notification.`notify_meta_data` as md
	on(md.gs_id= acd.gs_id)
	
	LEFT JOIN atif.staff_registered AS sr
	ON( sr.user_id = md.register_by)
	
	LEFT JOIN atif_notification.category AS nc
	ON(nc.id = md.category_id)
	WHERE md.notify_to =".$notify_to." and md.is_read=0 and md.record_deleted=0
	AND from_unixtime(md.created) > '2017-07-01' GROUP BY md.id ORDER BY md.id DESC";*/
	
	
	/*
	SELECT
'Attendance_Notification' as NType,

md.id AS N_log_id,
	md.category_id AS N_cat_id,
	'Active Case' AS N_type,
	acd.start_case_name AS Case_Name,

	md.message AS N_message,
	md.gs_id AS gs_id,
	md.notify_to AS notify_to,
	md.is_read AS N_seen,
	md.created AS N_create_date,
	sr.id AS S_id,
	sr.employee_id AS S_emp_id,
	sr.abridged_name AS S_name,
	sr.designation AS S_desgntn,
	sr.department AS S_deprt,
	
from_unixtime(md.created, '%Y-%m-%d') as Dated
FROM atif_notification.`notify_meta_data` as md

left join ( select 
ac.* 
from atif_attendance.activecase_case AS ac where  ac.close_category_id=1 ) as ac
on ac.gs_id=md.gs_id

LEFT JOIN atif.staff_registered AS sr
ON( sr.user_id = md.register_by)
	

left join atif_attendance.activecase_case_desc as acd
on(acd.gs_id= md.gs_id)
	
where  md.notify_to=".$notify_to." and md.category_id=1 and md.is_read=0 and md.record_deleted=0
and from_unixtime(md.created) > '2017-07-01'
group by md.gs_id, md.register_by, Dated
	*/
	
$query = "SELECT

con.* 

from (
select 

'Attendance_Notification' as NType,

m.id AS N_log_id,
	m.category_id AS N_cat_id,
	
	concat('Active Case ') AS N_type,
	
	#acd.start_case_name AS Case_Name,
	'' AS Case_Name,
	m.url AS N_url,
	m.message AS N_message,
	m.gs_id AS gs_id,
	m.notify_to AS notify_to,
	m.is_read AS N_seen,
	m.created AS N_create_date,
	sr.id AS S_id,
	sr.employee_id AS S_emp_id,
	sr.abridged_name AS S_name,
	sr.designation AS S_desgntn,
	sr.department AS S_deprt,
	
from_unixtime(m.created, '%Y-%m-%d') as Dated


from atif_attendance.activecase_log as l
inner join atif_attendance.activecase_case as c on c.id=l.activecase_id
inner join atif_notification.notify_meta_data as m
#on m.gs_id= c.gs_id
on m.log_id=l.id

inner JOIN atif.staff_registered AS sr
ON( sr.user_id = m.register_by)


where from_unixtime(l.created, '%Y-%m-%d') >= '2017-08-01'  and c.close_category_id=1
and m.notify_to=".$notify_to." and m.is_read=0
group by l.activecase_id





) as con

order by con.Dated desc ";
	
	
	$result = $this->NDB->query( $query );
	if( $result->num_rows() > 0 ){
		$return = $result->result_array();
	}else{
		$return = FALSE;
	}
	return $return;
}
	
	
	public function gt_ntfctn_gs_id_wise($notify_id,$cat,$staff_id, $gs_id){
		$this->NDB = $this->load->database("atif_notification", TRUE);
		
		$query ="select id from atif_notification.notify_meta_data AS md where md.category_id=".$cat." and md.gs_id='".$gs_id."' and md.register_by=".$staff_id." and md.notify_to=".$notify_id." and md.is_read=0";
		
		$query ="select id from atif_notification.notify_meta_data AS md where md.category_id=".$cat." and md.gs_id='".$gs_id."' and  md.notify_to=".$notify_id." and md.is_read=0 and from_unixtime(md.created) > '2017-08-01'";
		
		//$query = "select * from atif_notification.notify_meta_data AS md where md.category_id=1 and md.gs_id='04-053' and md.is_read=0";
		
		$result = $this->NDB->query( $query );
		if( $result->num_rows() > 0 ){
			$return = $result->result_array();
		}else{
			$return = FALSE;
		}
		return $return;
		
	}
	
	
	public function gt_ntfctn_gs_id_wise2($notify_to,$cat,$staff_id, $gs_id){
		
		$this->NDB = $this->load->database("atif_notification", TRUE);
		
		/* $query = "SELECT md.id AS N_log_id, md.category_id AS N_cat_id, nc.name AS N_type, md.url AS N_url,md.message AS N_message,md.gs_id AS gs_id, md.notify_to AS notify_to, md.is_read AS N_seen,md.created AS N_create_date, md.register_by AS N_register_by, sr.id AS S_id, sr.employee_id AS S_emp_id, sr.abridged_name AS S_name, sr.designation AS S_desgntn, sr.department AS S_deprt FROM atif_notification.notify_meta_data AS md 
		JOIN atif.staff_registered AS sr ON( sr.user_id = md.register_by) JOIN atif_notification.category AS nc ON(nc.id = md.category_id) WHERE  md.category_id=".$cat." AND md.notify_to =".$notify_to." AND md.gs_id='".$gs_id."' AND md.register_by=".$staff_id." AND md.record_deleted=0 AND from_unixtime(md.created) > '2017-07-01' group by md.id ORDER BY n_log_id DESC";
		
		*/
		$query = "SELECT md.id AS N_log_id, md.category_id AS N_cat_id, nc.name AS N_type, md.url AS N_url,md.message AS N_message,md.gs_id AS gs_id, md.notify_to AS notify_to, md.is_read AS N_seen,md.created AS N_create_date, md.register_by AS N_register_by, sr.id AS S_id, sr.employee_id AS S_emp_id, sr.abridged_name AS S_name, sr.designation AS S_desgntn, sr.department AS S_deprt 
FROM atif_notification.notify_meta_data AS md 

		LEFT JOIN ( select srr.* from atif.staff_registered AS srr where srr.id=".$staff_id." ) as sr
		 ON( sr.user_id = md.register_by) 
		
		
		JOIN atif_notification.category AS nc ON(nc.id = md.category_id) WHERE 
		
		 md.category_id=".$cat." AND md.notify_to =".$notify_to." AND md.gs_id='".$gs_id."' 
		 AND md.record_deleted=0 AND from_unixtime(md.created) > '2017-07-01' 
		 group by md.id ORDER BY n_log_id DESC";
		$result = $this->NDB->query( $query );
		if( $result->num_rows() > 0 ){
			$return = $result->result_array();
		}else{
			$return = FALSE;
		}
		return $return;
		
	}
	
	
	public function get_thread_id($staff_id, $gs_id){
		$this->DDB = $this->load->database('default',TRUE);
		/*$query ="select ac.id AS thread_id, acat.name AS CaseName from atif_attendance.activecase_case AS ac 
		left join atif_attendance.activecase_category as acat on(acat.id = ac.category_id ) 
		left join atif.staff_registered as sr on sr.user_id = ac.register_by 
		where ac.gs_id = '".$gs_id."' and ac.close_category_id=1 and sr.id='".$staff_id."' 	order by ac.id desc limit 1";*/
		
		$query ="select m.log_id AS thread_id from atif_notification.notify_meta_data as m
inner join atif_attendance.activecase_log as l on l.id = m.log_id
where m.id='".$gs_id."'";
		
		$result = $this->NDB->query( $query );
		if( $result->num_rows() > 0 ){
			$return = $result->row_array();
		}else{
			$return = FALSE;
		}
		return $return;
	}
	
	
	public function getStudentActiveCaseLog2($ActiveCaseID){
		$this->DDB = $this->load->database('default',TRUE);
		$result = "";
		//$cQuery = "select * from activecase_log_desc where activecase_id = ".$ActiveCaseID." order by created ASC";
		
		$cQuery = "select sr.employee_id, sr.user_id, sr.abridged_name, sr.gender, ac.comments, ac.created from atif_attendance.activecase_log AS ac 
left join atif.staff_registered as sr on sr.user_id = ac.register_by
where ac.id=".$ActiveCaseID." order by ac.id desc limit 1";
		
		$query=$this->db->query($cQuery);
		if($query->num_rows() > 0){
			$result = $query->result_array();
		}
		return $result;
	}
	
	function Run_Query($Query)
	{
		$this->DDB = $this->load->database('default',TRUE);
		$result = "";
		$query=$this->db->query($Query);
		if($query->num_rows() > 0){
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function getStaffInfo($sid){
		
		$this->DDB = $this->load->database('default',TRUE);
		$result = "";
		$cQuery = "select sr.id, sr.employee_id, sr.user_id, sr.name from atif.staff_registered AS sr where sr.user_id=".$sid."";
		$query=$this->db->query($cQuery);
		if($query->num_rows() > 0){
			$result = $query->row_array();
		}
		return $result;
		
	}
	
	
	
	
public function get_admission_notification_method( $category, $notify_to ){
	$this->NDB = $this->load->database("atif_notification", TRUE);


$query = "SELECT

con.* 

from (

SELECT
'Admission_Notification' as NType,
	af.id AS N_log_id,
	md.category_id AS N_cat_id,
	
	CONCAT( af.official_name, ' #',af.form_no) AS N_type,
	af.grade_name as Grade_name,
	fr.father_name as F_name, 
	fr.father_mobile as F_mobile,
	fr.mother_mobile as M_Mobile,
	af.official_name as applicant_name,
	af.form_no as Form_no, 
	
	if( af.form_status_id=1,'Submission',
	if( af.form_status_id=2,'Assessment',
	if( af.form_status_id=4,'Discussion',
	if( af.form_status_id=5,'Offer',
	if( af.form_status_id=6,'Admission_Complete',''
	))))) AS Case_Name,

	md.message AS N_message,
	md.log_id AS gs_id,
	md.notify_to AS notify_to,
	md.is_read AS N_seen,
	md.created AS N_create_date,
	0  AS S_id,
	'gs_logo'  AS S_emp_id,
	
	if( af.form_status_id=1,'Submission Date expired',
	if( af.form_status_id=2,'Assessment Date expired',
	if( af.form_status_id=4,'Discussion Date expired',
	if( af.form_status_id=5,'Offer Date expired',
	if( af.form_status_id=6,'Admission Complete',''))))) AS S_name,
	
	
	
	

if( (fbr.received_amount > 0) and 

( of.offer_letter = 0
or of.fif_form =0 
or of.hand_book=0
or of.signed_offer_letter=0
or of.completed_fif_form=0
or of.signed_hand_book=0 
or of.offer_pack_handover=0 ), 'Admission Fee Received Checks Missing', '')  AS S_desgntn,




	
	
	0  AS S_deprt,
	from_unixtime(md.created, '%d-%M, %Y %h:%m %i %p' ) as NDated,
	
	

from_unixtime(md.created, '%Y-%m-%d') as Dated
FROM atif_notification.`notify_meta_data` as md
left join atif_gs_admission.admission_form as af on af.id = md.log_id
left join atif_gs_admission.family_registration as fr on fr.gf_id = af.gf_id

LEFT JOIN atif_gs_admission.admission_form_offer AS of ON of.admission_form_id = af.id
			
left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 9
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10
			
left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id


where md.notify_to=".$notify_to." and md.category_id=2 and (md.is_read=0 or md.is_read=1)  and md.record_deleted=0

) as con

order by con.Dated desc ";
	
	
	$result = $this->NDB->query( $query );
	if( $result->num_rows() > 0 ){
		$return = $result->result_array();
	}else{
		$return = FALSE;
	}
	return $return;
}

	
	
}	

