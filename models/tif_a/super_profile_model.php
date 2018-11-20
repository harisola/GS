<?php

class Super_profile_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database('default',True);
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

	public function get_tt_profile_detail(){

		$query = "select tt.id,tt.profile_type_id,tt.name,IF(tt_time.is_on_mon = 1,tt_time.mon_in,'') as mon_in,
			IF(tt_time.is_on_mon = 1,tt_time.mon_out,'') as mon_out 
			from atif_gs_events.tt_profile tt

			left join atif_gs_events.tt_profile_time tt_time on 

			tt_time.profile_id = tt.id 

			where tt.profile_type_id = 1 order by tt.created";
		$row = $this->db->query($query);
		return $row->result();

	}
}