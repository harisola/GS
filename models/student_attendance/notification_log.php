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
	
	/*
		Group id add karan saa uun group ja member notification get kanda
		user id save thende atif_notification.notify_meta_data table me
		notify_to column me
	*/
	public function notify_to( $gs_id  ){
		$this->dbd = $this->load->database('default',TRUE);
		// first query
		
		/*$sqlQuery = "SELECT sr.`user_id` AS Notity_To FROM atif.`staff_registered` AS sr
		JOIN atif_role_org.`role_position` AS rp
		ON (rp.staff_id = sr.`id` )
		WHERE sr.`branch_id` = ( SELECT ac.`branch_id` FROM atif.`_academic_session` AS ac 
		JOIN  atif.`class_list` AS cl 
		ON( cl.`academic_session_id`  = ac.`id`  )
		WHERE cl.`gs_id` = '".$gs_id."' )
		AND sr.`is_active`=1 AND sr.`is_posted`=1
		AND ( rp.`gp_id` LIKE '%N-FO%' || rp.`gp_id` LIKE '%N-NP-J-%' )";*/
		
		// Second query
		/*$sqlQuery = "SELECT sr.`user_id` AS Notity_To FROM atif.`staff_registered` AS sr
		INNER JOIN atif_role_org.`role_position` AS rp ON (rp.staff_id = sr.`id`)
		LEFT JOIN ( SELECT gr.user_id as User_id, gr.group_id as Group_id FROM atif.users_groups AS gr  WHERE (gr.group_id = 23 or gr.group_id=31) ) AS group_data
		on( group_data.User_id = sr.user_id )
		WHERE sr.`branch_id` = ( SELECT ac.`branch_id` FROM atif.`_academic_session` AS ac 
		LEFT JOIN  atif.`class_list` AS cl 
		ON( cl.`academic_session_id`  = ac.`id` )
		WHERE cl.`gs_id` = '".$gs_id."' )
		and group_data.Group_id is not null";*/
		
		
		$sqlQuery = "SELECT gr.user_id AS Notity_To FROM atif.users_groups AS gr WHERE( gr.group_id=11 or gr.group_id = 23 or gr.group_id=31)";
		
		$query = $this->dbd->query( $sqlQuery );
		
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
			//return $this->dbd->last_query();
		}else{
			return false;
		}	
	}
	
	public function Run_Query($Query)
	{
		
		$this->dbd = $this->load->database('default',TRUE);
		$query=$this->dbd->query($Query); 
		if( $query->num_rows() > 0 )
		{
			$results = $query->result_array();
			return $results;
		}
		else
		{
			return FALSE;
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
		
		//$sqlQuery ="SELECT * FROM atif_notification.`notify_meta_data` as n  WHERE n.notify_to =".$user_id." AND n.is_read = 0 and n.record_deleted=0";
		
		/*$sqlQuery = "SELECT 
		SUM(T_N.Total_Notification) AS Total_Notification
		FROM(
		
		SELECT 
		COUNT(*) AS Total_Notification
		FROM atif_notification.`notify_meta_data` AS n  
		
		
		#left join atif_attendance.activecase_case AS ac  on ac.gs_id=n.gs_id

		WHERE #ac.close_category_id=0 and 
		n.notify_to =".$user_id." 
		
		AND n.is_read = 0 
		AND n.record_deleted=0 ) AS T_N ";*/
		
		$sqlQuery = "select sum( nn.idz) as Total_Notification

from(

select count(nn.idz) as idz
from( 

select count(l.id) as idz  from atif_attendance.activecase_log as l
inner join atif_attendance.activecase_case as c on c.id=l.activecase_id
inner join atif_notification.notify_meta_data as m
#on m.gs_id= c.gs_id
on m.log_id=l.id

where from_unixtime(l.created, '%Y-%m-%d') >= '2017-08-01'  and c.close_category_id=1
and m.notify_to=".$user_id." and m.is_read=0
group by l.activecase_id
order by l.id


) as nn




) as nn ";
		
		$query = $this->dbd->query( $sqlQuery );
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
			//return $this->dbd->last_query();
		}else{
			return false;
		}
		
	}
	
	public function get_admission_unread_notification($user_id)
	{
		$this->dbd = $this->load->database('default',TRUE);
		$sqlQuery ="select count(m.id) as Admission_Total from atif_notification.notify_meta_data as m where  ( m.notify_to=".$user_id." and m.category_id=2 and m.is_read=0 )";
		$query = $this->dbd->query( $sqlQuery );
		if( $query->num_rows() > 0 ){
			$results = $query->row_array();
			return $results;
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