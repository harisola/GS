<?php
class Notification_log extends CI_Model{
	private $dbn;
	private $dbd;
	function __construct(){
		parent::__construct();
	}
	
	public function add_record($table, $data ){
		$this->dbn = $this->load->database('atif_notification',TRUE);
		$lastID = $this->dbn->insert($table,$data);
		if( $lastID > 0 ){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	
	public function get_session_id(){
		$sqlQuery = "SELECT cl.`academic_session_id` FROM atif.`class_list` AS cl WHERE cl.`gs_id` = 04-027";
	}
	
	public function get_branch_id(){
		$sqlQuery = "SELECT ac.`branch_id` FROM atif.`_academic_session` AS ac WHERE ac.`id` = 8";
	}
	public function get_branch_name(){
		$sqlQuery = "SELECT * FROM atif.`_branch` AS b WHERE b.`id` = 2";
	}
	
	
	public function notify_to( $gs_id  ){
		$this->dbd = $this->load->database('default',TRUE);
		
		$sqlQuery = "SELECT sr.`user_id` AS Notity_To FROM atif.`staff_registered` AS sr
		JOIN atif_role_org.`role_position` AS rp
		ON (rp.staff_id = sr.`id` )
		WHERE sr.`branch_id` = ( SELECT ac.`branch_id` FROM atif.`_academic_session` AS ac 
		JOIN  atif.`class_list` AS cl 
		ON( cl.`academic_session_id`  = ac.`id`  )
		WHERE cl.`gs_id` = '".$gs_id."' )
		AND sr.`is_active`=1 AND sr.`is_posted`=1
		AND ( rp.`gp_id` LIKE '%N-FO%' || rp.`gp_id` LIKE '%N-NP-J-%' )";
		
		$query = $this->dbd->query( $sqlQuery );
		
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
			//return $this->dbd->last_query();
		}else{
			return false;
		}	
	}

	public function check_user_group2($user_id){
		$this->dbd = $this->load->database('default',TRUE);
		$query = "select if(gg.id = 23 or gg.id = 25 or gg.id = 31, 1, 0) as result from atif.users as u left join atif.users_groups as g on g.user_id = u.id left join atif.groups as gg on gg.id = g.group_id where u.id =".$user_id." group by u.id";
		$query=$this->dbd->query($query); 
		if( $query->num_rows() > 0 ){
			$results = $query->row_array();
			return $results;
		}else{
			return FALSE;
		}
		
	}
	public function get_notification($user_id){
		$this->dbd = $this->load->database('default',TRUE);
		$sqlQuery ="SELECT * FROM atif_notification.`notify_meta_data` WHERE notify_to =".$user_id."";
		$query = $this->dbd->query( $sqlQuery );
		
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
			
			//return $this->dbd->last_query();
			
		}else{
			return false;
		}
		
	}
	
	public function get_unread_notification($user_id){
		$this->dbd = $this->load->database('default',TRUE);
		$sqlQuery ="SELECT * FROM atif_notification.`notify_meta_data`  WHERE notify_to = $user_id AND is_read = 0";
		$query = $this->dbd->query( $sqlQuery );
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
			//return $this->dbd->last_query();
		}else{
			return false;
		}
		
	}
	
	
	public function notify_to_teacher($gs_id){
		$this->dbd = $this->load->database('default',TRUE);
		//$query ="select ac.register_by AS thread_created_by from atif.activecase_log_desc AS dl join atif_attendance.activecase_case AS ac  on(ac.id = dl.activecase_id ) where dl.id = $log_id";
		//$query = "select register_by from atif_attendance.activecase_case_desc where gs_id ='".$gs_id."'";
		//$query = "select sr.user_id AS register_by from atif.staff_registered as sr  where sr.id=( select ct.staff_id from atif_role_matrix.role_class_teacher as ct left join atif.class_list AS cl on( cl.grade_id = ct.grade_id and cl.section_id=ct.section_id ) where cl.gs_id='".$gs_id."' and ct.teacher_type_id=1 group by cl.grade_id )";
		$query = "select register_by from atif_notification.notify_meta_data as noti where noti.gs_id='".$gs_id."' limit 1";
		
		$query = $this->dbd->query( $query );
		if( $query->num_rows() > 0 ){
			$results = $query->row_array();
			return $results;
			//return $this->dbd->last_query();
		}else{
			return false;
		}
	}
	
	public function set_read($notify_to, $log_id){
		$this->NDB = $this->load->database("atif_notification", TRUE);
		$data = array( 'is_read' => 1 );
		//$where = array("notify_to"=>$notify_to, "log_id"=>$log_id );
		$where = array("id"=>$log_id);
		$this->NDB->where( $where );
		$this->NDB->update('notify_meta_data', $data);
		if( $this->NDB->affected_rows() > 0 ){
			return TRUE;
		}else{
			return FALSE;
		}
		
	}
	
	public function getActivecaseid( $notify_to,$url,$GSID,$category_id ){
		$this->dbd = $this->load->database('default',TRUE);
		/*$sqlQuery ="select id from atif_attendance.activecase_log AS sal
		where sal.activecase_id = 
		( select al.activecase_id from atif_attendance.activecase_log AS al 
		join atif_notification.notify_meta_data AS md
		on(md.log_id = al.id)
		where md.notify_to=".$notify_to." and md.is_read=0 and log_id=".$log_id." )";*/
		
		$sqlQuery = "select md.id as id from atif_notification.notify_meta_data AS md  where md.category_id=".$category_id." and md.notify_to=".$notify_to." and md.gs_id='".$GSID."' and md.is_read=0 ";
		
		$query = $this->dbd->query( $sqlQuery );
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
				
		}else{
			return false;
		}
		
		
	}
	
	

}	