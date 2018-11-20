<?php
class Master_calender extends CI_Model{
	private $ddb;
	function __construct(){ parent::__construct(); }
	public function GetDate($StartDate=NULL,$EndDate=NULL){
		$this->ddb = $this->load->database('default',TRUE);
		
		if($StartDate !=NULL){
			//date_default_timezone_set("Asia/Karachi");
			//$st_date = date("Y-m-d",mktime(1,1,1,8,1,2016));
			$Acdstart_date = date("Y-m-d",strtotime("2017-08-01"));
			$Acdstart_date2 = date("Y-m-d",strtotime($StartDate));
			if( $Acdstart_date2 > $Acdstart_date ){ $AcdStartDate='2017-08-01';	}else{ $AcdStartDate='2016-08-01'; }
			
			$query = "SELECT  ca.id, ca.date, ca.islami_date, ca.islami_month,s.w as genweek,GROUP_CONCAT(e.calendar_ID) AS eTitle 
			FROM atif_gs_events.hijri_calendar AS ca
left join 
(SELECT
(@a:= @a+1) as Serail_Number,
if( date='2017-08-01', @r:=0, '' ) as t,
IF((@a%7)=0,@r:=@r+1,'') as w,
date as dates
FROM atif_gs_events.hijri_calendar,
(SELECT @a:= 0 ) AS a,
(SELECT @r:= 0 ) AS r
WHERE date >= '".$AcdStartDate."'  ) as s
on (s.dates = ca.date)
left join ( select calendar_ID from atif_gs_events.calendar_events_managment ) as e
on(e.calendar_ID = ca.id)
WHERE ca.`date` >='".$StartDate."' AND ca.`date` <= '".$EndDate."' group by ca.id";

		}else{
			$query = "SELECT id,date FROM atif_gs_events.hijri_calendar AS ca WHERE `date` >= '2017-02-01'";
		}
		$result = $this->ddb->query( $query );
		//echo $this->ddb->last_query();
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->result_array();
		return $results;
		}else{ return FALSE; }
	}
	/* Get Generations week */
	public function getGenerationWeek($Sdate,$EndDate){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "select r.w as GenWeek
					from
					( SELECT (@a:= @a+1) as Serail_Number, IF((@a%7)=0,@r:=@r+1,'') as w, date as d FROM atif_gs_events.hijri_calendar, 
					(SELECT @a:= 0 ) AS a, (SELECT @r:= 0 ) AS r WHERE date >= '2017-08-01') as r
					where r.d >= '".$Sdate."' and r.w != '' AND r.d <= '".$EndDate."'";
		$result = $this->ddb->query( $query );
		//echo $this->ddb->last_query();exit;
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
	}
	// Insert database
	public function set($table, $data){
		$this->ddb = $this->load->database('events',TRUE);
		$this->ddb->insert($table, $data);
		return $this->ddb->insert_id();	
	}
	public function table_update($table,$data,$where){
		$this->ddb = $this->load->database('events',TRUE);
		$return = $this->ddb->update($table, $data, $where);
		return $return;
	}
	public function table_remove($table,$where){
		$this->ddb = $this->load->database('events',TRUE);
		$data = array('record_deleted'=>1,"modified"=>time(),"modified_by"=>$this->session->userdata("user_id"));
		$this->ddb->where( $where);
		$this->ddb->update($table,$data);
	}
	
	// end set
	public function get_events($date){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "select e.id as ID, e.`schedule_followup_ID` as 'Schedule', e.event_title as Title, e.event_short_title,
			e.event_start_time as Event_Start_Time, e.event_end_time as Event_End_Time,
			ec.Type as Type, ec.cat_name as Category_Name, ec.cat_short_title as Short_Title from 
			atif_gs_events.calendar_events_managment e 
			left join atif_gs_events.event_category as ec on(ec.ID=e.`event_ID`)
			where e.calendar_ID='".$date."'";
	
		$result = $this->ddb->query( $query );
		//echo $this->ddb->last_query();exit;
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->result_array();
		return $results;
		}else{ return FALSE; }
	}
	
	public function Get_Hijri_By_Ger($date){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "SELECT islami_date, islami_month FROM atif_gs_events.hijri_calendar where date = '".$date."'";
	
		$result = $this->ddb->query( $query );
		//echo $this->ddb->last_query();exit;
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
	}
	
	
	// end set Get_Events_Hijri_Wise
	public function Get_Events_Hijri_Wise($date){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "select
			e.ID as ID, e.Hijri_Date, e.`schedule_followup_ID` as 'Schedule', e.event_title as Title, e.event_short_title,
			e.event_start_time as Event_Start_Time, e.event_end_time as Event_End_Time,
			ec.Type as Type, ec.cat_name as Category_Name, ec.cat_short_title as Short_Title
			from atif_gs_events.calendar_events_managment_hijri_date e 
			left join atif_gs_events.event_category as ec on(ec.ID=e.`event_ID`) 
			where e.Hijri_Date='".$date."' AND e.record_deleted=0";
		$result = $this->ddb->query( $query );
		//echo $this->ddb->last_query();exit;
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->result_array();
		return $results;
		}else{ return FALSE; }
	}
	
	
	
	public function get_event($Event_Id){
		$this->ddb = $this->load->database('default',TRUE);
		$query ="select  
		e.*, ec.Type as Type, ec.cat_name as Category_Name, ec.cat_short_title as Short_Title
		from atif_gs_events.calendar_events_managment as e
		left join atif_gs_events.event_category as ec on(ec.ID=e.`event_ID`)
		where e.ID='".$Event_Id."'";
		$result = $this->ddb->query( $query );
		//echo $this->ddb->last_query();exit;
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
	} 
	
	public function Get_EventH($Event_Id){
		$this->ddb = $this->load->database('default',TRUE);
		$query ="select  
		e.*, ec.Type as Type, ec.cat_name as Category_Name, ec.cat_short_title as Short_Title
		from atif_gs_events.calendar_events_managment_hijri_date as e
		left join atif_gs_events.event_category as ec on(ec.ID=e.`event_ID`)
		where e.ID='".$Event_Id."'";
		$result = $this->ddb->query( $query );
		//echo $this->ddb->last_query();exit;
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
	}
	
	public function Get_EventHOne($Event_Id){
		$this->ddb = $this->load->database('default',TRUE);
		$query ="select * from atif_gs_events.calendar_events_managment_hijri_date
		where Hijri_Date='".$Event_Id."'";
		$result = $this->ddb->query( $query );
		//echo $this->ddb->last_query();exit;
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
	}
	
	
	// Category Event
	public function get_cat_event($ID=NULL){
		$this->ddb = $this->load->database('default',TRUE);
		if($ID != NULL){
			$query ="SELECT * FROM  atif_gs_events.event_category where cat_status=1 and ID=".$ID." and Type='Event'";
		}else{
			$query="SELECT * FROM  atif_gs_events.event_category where cat_status=1 and Type='Event'";
		}
		$result = $this->ddb->query( $query );
		if(($result != FALSE) && ($result->num_rows() > 0) ){
		if($ID != NULL){
			$results = $result->row_array();
		}else{
			$results = $result->result_array();
		}
		return $results;
		}else{ return FALSE; }
	}
	
	// Get All Event Active/In-Active
	public function Get_All_Event($Type=NULL){
		$this->ddb = $this->load->database('default',TRUE);
		if($Type==NULL){
		$query="SELECT * FROM  atif_gs_events.event_category where Type='Event'";	
		}else{
			$query="SELECT * FROM  atif_gs_events.event_category where Type='".$Type."'";
		}
		$result = $this->ddb->query($query);
		if(($result != FALSE) && ($result->num_rows() > 0) ){
			$results = $result->result_array();
			return $results;
		}else{ 
			return FALSE; 
		}
	}
	
	// Category Event Effected Department
	public function event_effected_department( $ID=NULL ){
		$this->ddb = $this->load->database('default',TRUE);
		if($ID != NULL){
			$query ="SELECT * FROM atif_gs_events.event_effected_department where ID=".$ID." and record_deleted=0";
		}else{
			$query="SELECT * FROM atif_gs_events.event_effected_department where record_deleted=0";
		}
		$result = $this->ddb->query( $query );
		if(($result != FALSE) && ($result->num_rows() > 0) ){
		if($ID != NULL){
			$results = $result->row_array();
		}else{
			$results = $result->result_array();
		}
		return $results;
		}else{ return FALSE; }
	}
	
	public function get($db,$table,$ID=NULL){
		$this->ddb = $this->load->database('default',TRUE);
		if($ID != NULL){
			$query ="SELECT * FROM ".$db.".".$table." where id=".$ID."";
		}else{
			$query="SELECT * FROM ".$db.".".$table."";
		}
		$result = $this->ddb->query( $query );
		if(($result != FALSE) && ($result->num_rows() > 0) ){
		if($ID != NULL){
			$results = $result->row_array();
		}else{
			$results = $result->result_array();
		}
		return $results;
		}else{ return FALSE; }
	}
	
	public function getWingGrade($Wing_Id,$Events_ID){
		$this->ddb = $this->load->database('default',TRUE);
		//$query="SELECT g.id, g.dname FROM atif._wing_grade as w join atif._grade as g on(g.id=w.grade_id) where w.wing_id=".$Wing_Id."";
		//$query = "SELECT g.id, g.dname, eff.department_ID as Grade, eff.event_ID as Event_ID FROM atif._wing_grade as w join atif._grade as g on(g.id=w.grade_id) left join atif_gs_events.event_effected_department as eff on(eff.department_ID = g.dname) where w.wing_id=".$Wing_Id." group by g.dname";
		$query = "SELECT g.id, g.dname, eff.department_ID as Grade, eff.event_ID as Event_ID FROM atif._wing_grade as w join atif._grade as g on(g.id=w.grade_id) left join ( select * from atif_gs_events.event_effected_department where event_ID=".$Events_ID." and record_deleted=0 ) as eff on(eff.department_ID = g.dname) where w.wing_id=".$Wing_Id." group by g.dname";
		$result = $this->ddb->query( $query );
		$results = $result->result_array();
		return $results;
	}
	
	
	public function getDepartment($Events_ID){
		$this->ddb = $this->load->database('default',TRUE);
		$query="SELECT * FROM atif_gs_events.event_effected_department WHERE `event_ID`=".$Events_ID." and `record_deleted`=0";
		$result = $this->ddb->query( $query );
		$results = $result->result_array();
		return $results;
	}
	
	
	
	public function getWingGradeH($Wing_Id,$Events_ID){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "SELECT g.id, g.dname, eff.department_ID as Grade, eff.event_ID as Event_ID 
		FROM atif._wing_grade as w join atif._grade as g on(g.id=w.grade_id) left join 
		( select * from atif_gs_events.event_effected_department_hijri_date where event_ID=".$Events_ID." and record_deleted=0 ) as eff on(eff.department_ID = g.dname) where w.wing_id=".$Wing_Id." group by g.dname";
		$result = $this->ddb->query( $query );
		$results = $result->result_array();
		return $results;
	}
	
	
	public function getDepartmentH($Events_ID){
		$this->ddb = $this->load->database('default',TRUE);
		$query="SELECT * FROM atif_gs_events.event_effected_department_hijri_date WHERE `event_ID`=".$Events_ID." and `record_deleted`=0";
		$result = $this->ddb->query( $query );
		$results = $result->result_array();
		return $results;
	}
	
	
	public function getE($EventID,$Department){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "SELECT ID FROM atif_gs_events.event_effected_department WHERE `event_ID`=".$EventID." and `department_ID`='".$Department."' and `record_deleted`=0";
		$result = $this->ddb->query( $query );
		$results = $result->row_array();
		return $results;
	}
	
	public function getEH($EventID,$Department){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "SELECT ID FROM atif_gs_events.event_effected_department_hijri_date WHERE `event_ID`=".$EventID." and `department_ID`='".$Department."' and `record_deleted`=0";
		$result = $this->ddb->query( $query );
		$results = $result->row_array();
		return $results;
	}
	
	// Category Event Record By ID and Type or
	public function Get_Event_Category($ID=NULL,$Type=NULL){
		$this->ddb = $this->load->database('default',TRUE);
		if($ID != NULL){	
			$query ="SELECT * FROM  atif_gs_events.event_category where cat_status=1 and ID=".$ID." and Type='".$Type."'";
		}else{
			$query="SELECT * FROM  atif_gs_events.event_category where cat_status=1 and Type='Event'";
		}
		$result = $this->ddb->query( $query );
		if(($result != FALSE) && ($result->num_rows() > 0) ){
		if($ID != NULL){
			$results = $result->row_array();
		}else{
			$results = $result->result_array();
		}
		return $results;
		}else{ return FALSE; }
	}
	
	public function Followup_Availability_Date_Wise($RDate){
		$this->ddb = $this->load->database('default',TRUE);
		$query ="SELECT * FROM atif_gs_events.calendar_events_managment as em  WHERE em.calendar_ID='".$RDate."' and em.schedule_followup_ID > 0";
		$result = $this->ddb->query($query);
		if(($result != FALSE) && ($result->num_rows() > 0)){
			return TRUE;
		}else{ 
			return FALSE; 
		}
	}
	
	
	
	
	public function Get_Hijri_Date($StartDate=NULL){
		$this->ddb = $this->load->database('default',TRUE);
		//$query = "SELECT islami_date,islami_month as IslamicMonth FROM atif_gs_events.hijri_calendar AS ca WHERE `date` = '".$StartDate."'";
		$query = "SELECT ca.islami_date, ca.islami_month as IslamicMonth, hm.month_code, hm.Symbol FROM atif_gs_events.hijri_calendar AS ca left join atif_gs_events.hijri_month as hm on(hm.ID= SUBSTRING( ca.islami_date, 6, 2) ) WHERE ca.date = '".$StartDate."'";
		$result = $this->ddb->query( $query );
		//echo $this->ddb->last_query();
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
	}
	
	
	
	public function get_Hijri_Date2($Date){
		$this->ddb = $this->load->database('events',TRUE);
		$query = "SELECT * FROM atif_gs_events.hijri_calendar where date > '".$Date."'";
		$result = $this->ddb->query( $query );
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->result_array();
		return $results;
		}else{ return FALSE; }
		
	}
	
	public function Get_Hijri_Date_Info($StartDate=NULL){
		$this->ddb = $this->load->database('default',TRUE);
		$Query = "SELECT * FROM atif_gs_events.hijri_table as a left join atif_gs_events.hijri_month as b on(b.id=a.Month_Info) where a.Islamic_Date='".$StartDate."'";
		$result = $this->ddb->query( $Query );
		//echo $this->ddb->last_query();
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
	}
	
	
	public function Get_Event_Date($Event_id)
	{
		$this->ddb = $this->load->database('events',TRUE);
		$Query = "SELECT `calendar_ID` as Dated FROM calendar_events_managment WHERE ID=".$Event_id."";
		$quer = $this->ddb->query($Query);
		$results = $quer->row_array();
		return $results;
	}

	public function Update_Weekly_TimeSheet($From_date,$To_date){
		$this->ddb = $this->load->database('events',TRUE);
		$squery = "CALL `sp_generate_time_sheet`(?,?)";
		$query = $this->ddb->query($squery, array("DateFrom"=>$From_date, "DateTo"=>$To_date));
		return $query->result_array();	
	}
	
	
	public function Update_Weekly_TimeSheet_InLuie($From_date,$To_date){
		$this->ddb = $this->load->database('events',TRUE);
		$squery = "CALL `sp_InLuie`(?,?)";
		$query = $this->ddb->query($squery, array("Current_dated"=>$From_date, "Luie_dated"=>$To_date));
		return $query->result_array();	
	}
	public function Update_Weekly_TimeSheet_InLuie2($From_date,$To_date){
		$this->ddb = $this->load->database('events',TRUE);
		$squery = "CALL `sp_InLuieRes`(?,?)";
		$query = $this->ddb->query($squery, array("Current_dated"=>$From_date, "Luie_dated"=>$To_date));
		return $query->result_array();	
	}
	
	public function Get_Staff_Profile(){
		$this->ddb = $this->load->database('events',TRUE);
		//$Query = "SELECT Ttp.id as Profile_id, Ttp.name as Profile_name , eff.department_ID FROM `tt_profile` as Ttp LEFT JOIN( SELECT * FROM atif_gs_events.event_effected_department WHERE record_deleted = 0 ) as eff on eff.`department_ID` = Ttp.id WHERE Ttp.record_deleted=0";
		$Query = "SELECT Ttp.id as Profile_id, Ttp.name as Profile_name FROM `tt_profile` as Ttp WHERE Ttp.record_deleted=0";
		$quer = $this->ddb->query($Query);
		$results = $quer->result_array();
		return $results;
	}
	
	
}