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
		 $query = "SELECT * FROM atif_notification.notify_meta_data AS md WHERE md.category_id=".$category." AND md.notify_to = ".$notify_to." AND md.is_read = 0 AND from_unixtime(md.created) > '2017-07-31' AND md.record_deleted=0";
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

	$query = "SELECT 
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
	FROM  atif_attendance.activecase_case as acd
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
	AND acd.close_category_id=0
	group by md.created, md.gs_id
	ORDER BY n_log_id DESC";
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
		
		//$query ="select id from atif_notification.notify_meta_data AS md where md.category_id=".$cat." and md.gs_id='".$gs_id."' and md.register_by=".$staff_id." and md.notify_to=".$notify_id." and md.is_read=0";
		
		$query ="select id from atif_notification.notify_meta_data AS md where md.category_id=".$cat." and md.gs_id='".$gs_id."' and  md.notify_to=".$notify_id." and md.is_read=0  AND md.record_deleted=0";
		
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
		$query = "SELECT md.id AS N_log_id, md.category_id AS N_cat_id, nc.name AS N_type, md.url AS N_url,md.message AS N_message,md.gs_id AS gs_id, md.notify_to AS notify_to, md.is_read AS N_seen,md.created AS N_create_date, md.register_by AS N_register_by, sr.id AS S_id, sr.employee_id AS S_emp_id, sr.abridged_name AS S_name, sr.designation AS S_desgntn, sr.department AS S_deprt FROM atif_notification.notify_meta_data AS md 
		JOIN atif.staff_registered AS sr ON( sr.id = md.register_by) JOIN atif_notification.category AS nc ON(nc.id = md.category_id) WHERE  md.category_id=".$cat." AND md.notify_to =".$notify_to." AND md.gs_id='".$gs_id."' AND md.register_by=".$staff_id." AND md.record_deleted=0 AND md.record_deleted=0 ORDER BY md.id DESC";
		
		$result = $this->NDB->query( $query );
		if( $result->num_rows() > 0 ){
			$return = $result->result_array();
		}else{
			$return = FALSE;
		}
		return $return;
		
	}
	
	
	public function get_thread_id($gs_id){
		$this->DDB = $this->load->database('default',TRUE);
		$query ="select ac.id AS thread_id, acat.name AS CaseName from atif_attendance.activecase_case AS ac join atif_attendance.activecase_category as acat on(acat.id = ac.category_id ) where ac.gs_id = '".$gs_id."' and ac.close_category_id=0 order by ac.id desc";
		
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
		$cQuery = "select * from activecase_log_desc where activecase_id = ".$ActiveCaseID." order by created ASC";
		
		$query=$this->db->query($cQuery);
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
	

	
	
}	

