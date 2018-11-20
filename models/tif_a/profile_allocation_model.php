<?php

class Profile_allocation_model extends CI_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->database('default',TRUE);
	}

	public function get_by($tablename,$select,$where){

		if($select == ''){
			$this->db->select();
		}
		else{

			$this->db->select($select);
		}
		$this->db->from($tablename);
		if($where == ''){

		}
		else{
			$this->db->where($where);
		}
		$query =  $this->db-> get();
		$result = $query->result();
		return $result;
	}

	public function insert_data($tablename,$data){
		$this->db->insert($tablename,$data);
		$affected =  $this->db->insert_id();
		return $affected;
	}

	public function update_data($tablename,$where,$data){

		$this->db->where($where);
		$this->db->update($tablename,$data);
		$row = $this->db->affected_rows();
		if($row == null){
			return false;
		}
		else if($row != null){
			return $row;
		}
		
	}

	public function staff_profile_allocation(){
		$query = "SELECT tpts.profile_id,tp.name as profile_name,tpts.staff_id,
				tp.profile_type_id as profile_type_id,sr.name as staff_name,sr.designation,
				sr.department,sr.gt_id,sr.name_code
				from atif_gs_events.tt_profile_time_staff tpts

				inner join atif_gs_events.tt_profile tp on tp.id = tpts.profile_id

				inner join atif.staff_registered sr on sr.id = tpts.staff_id

				where tpts.record_deleted = 0 order by profile_name";
		$row = $this->db->query($query);
		$result = $row->result();
		return $result;
	}


	public function get_staff_allocation($profile_id){
		$query = "SELECT tpts.profile_id,tp.name as profile_name,tpts.staff_id,
				tp.profile_type_id as profile_type_id,sr.name as staff_name,sr.designation,
				sr.department,sr.gt_id,sr.name_code
				from atif_gs_events.tt_profile_time_staff tpts

				inner join atif_gs_events.tt_profile tp on tp.id = tpts.profile_id

				inner join atif.staff_registered sr on sr.id = tpts.staff_id

				where tpts.record_deleted = 0 and tpts.profile_id = ".$profile_id;
		$row = $this->db->query($query);
		$result = $row->result();
		return $result;  
	}


	public function get_StaffList(){
		$query="select sr.id, sr.gt_id, sr.abridged_name, sr.name_code, sr.c_bottomline,sr.c_topline, st.code as staff_status_code,sr.designation,sr.department
			from atif.staff_registered as sr
			left join atif._staffstatus as st
				on st.id = sr.staff_status
			where sr.is_active=1 and sr.is_posted=1 
			order by sr.name";
		$row=$this->db->query($query);
		return $row->result();
	}


	public function get_StaffProfile(){
		$query = "SELECT sr.id as staff_id,sr.gt_id,sr.abridged_name,
				sr.name_code,sr.designation,sr.department,ifnull(t.profile_type_id,'') as profile_type_id,ifnull(t.id,'') as profile_id,
				ifnull(t.name,'-') as profile_name

				from atif.staff_registered  sr

				left join atif_gs_events.tt_profile_time_staff ts on (ts.staff_id = sr.id and ts.record_deleted = 0)

				left join atif_gs_events.tt_profile t on (t.id = ts.profile_id)

				where sr.is_active = 1 and sr.is_posted = 1

				order by t.name desc,sr.name";
		$row = $this->db->query($query);
		return $row->result();
	}

}