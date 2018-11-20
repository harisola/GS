<?php

class Weekly_time_sheet_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function get_weeks(){
		$query = 'SELECT * from atif_gs_events.hijri_calendar where `date` > curdate() limit 7';
		$row = $this->db->query($query);
		$result = $row->result();
		return $result;
	}


	//========================== GET SUPER PROFILE CURRENT CALENDAR DATE =============================//
	//===============================================================================================//
	public function get_super_profile(){
		$query = "SELECT hc.id,hc.`date` as event_date,ec.ID as event_id,ec.cat_name as super_profile_name,spt.profile_id as profile_id,spt.super_profile_id as super_profile_id,spt.is_on_mon as is_on,spt.mon_in as time_in,spt.mon_out as time_out

			from atif_gs_events.hijri_calendar hc
			inner join atif_gs_events.calendar_events_managment evm on hc.`date` = evm.calendar_ID 
			inner join atif_gs_events.event_category ec on (ec.ID = evm.event_ID and ec.`Type` = 'Staff')
			inner join atif_gs_events.super_profile_time spt on (spt.super_profile_id = ec.ID)
			where `date` > curdate()";
		$row = $this->db->query($query);
		$result = $row->result();
		return $result;
	}

	//============== GET PROFILE DETAIL OF A STAFF ===============================//
	//============================================================================//

	public function get_profile_allocation(){

		$query = "SELECT tpts.id as profile_allocation_id,
				tpts.is_on_mon,tpts.is_on_tue,tpts.is_on_wed,
				tpts.is_on_thu,tpts.is_on_fri,tpts.is_on_sat,
				tpts.is_on_sun,tpts.mon_in,tpts.tue_in,tpts.wed_in,
				tpts.thu_in,tpts.fri_in,tpts.sat_in,tpts.sun_in,tpts.mon_out,
				tpts.tue_out,tpts.wed_out,tpts.thu_out,tpts.fri_out,
				addtime(IF(SUBSTR(tpts.sat_hrs,2,1) = '.',REPLACE(tpts.sat_hrs,'.5',':30'),concat(tpts.sat_hrs,':00:00')),tpts.sat_in) as sat_out,tpts.sun_out,tt.name as profile_name,tt.id as profile_id,sr.id as staff_id,sr.abridged_name,sr.c_topline as designation,sr.c_bottomline as department

				FROM atif_gs_events.tt_profile_time_staff tpts

				inner join atif_gs_events.tt_profile  tt on tt.id = tpts.profile_id
				inner join atif.staff_registered sr on sr.id = tpts.staff_id
				order by profile_name";
		$row = $this->db->query($query);
		$result = $row->result();
		return $result;

	}

		/**
		@name:Rohail Aslam
		@Decription:Staff Description And Profile Description
		@input:none
		@date:Aug 21,2017
		**/

	public function staff_profile_desc(){

		$query_statement = 'SELECT 
			wts.id,sr.abridged_name,sr.id as staff_id,
			sr.c_topline,sr.c_bottomline,wts.`date`,tp.name as profile_name,
			wts.time_in,wts.time_out
			FROM 
			atif_gs_events.weekly_time_sheet wts
			inner join atif.staff_registered sr on sr.id = wts.staff_id
			left join atif_gs_events.tt_profile_time_staff tpts on tpts.staff_id = wts.staff_id
			left join atif_gs_events.tt_profile tp on tp.id =  tpts.profile_id 

			where wts.`date` > curdate()';
		$query_statement = $this->db->query($query_statement);
		$query_result = $query_statement->result();
		return $query_result;
	}

		/**
		@name:Rohail Aslam
		@Decription:Staff Details
		@input:none
		@date:Aug 21,2017
		**/

	public function get_staff(){

		$query_statement = "select sr.id,sr.abridged_name,sr.c_bottomline,sr.c_topline,
							ifnull(tp.name,'') as profile_name
							FROM atif.staff_registered sr
							left join atif_gs_events.tt_profile_time_staff tpts on tpts.staff_id = sr.id
							left join atif_gs_events.tt_profile tp on tp.id = tpts.profile_id

							where sr.is_active = 1 and sr.is_posted = 1 ";
		$query_statement = $this->db->query($query_statement);
		$query_result = $query_statement->result();
		return $query_result;

	}

		/**
		@name:Rohail Aslam
		@Decription:Update the table Name
		@input: $table_name,$where,$data
		@date:Aug 21,2017
		**/

	public function updation($table_name,$where,$data){

		$this->db->where($where);
		$updated_id = $this->db->update($table_name,$data);
		return $updated_id;

	}

	/***
	@name:Rohail Aslam
	@Description:Get the name of the Profile
	@input:$tablename,$select,$where
	@date:Aug 23,2017
	**/

	public function get($table_name,$select,$where){

		if($select != ''){
			$this->db->select($select);
		}else{
			$this->db->select();
		}

		if($where != ''){
			$this->db->where($where);
		}

		$query_object = $this->db->get($table_name);

		return $query_object->result();

	}



}