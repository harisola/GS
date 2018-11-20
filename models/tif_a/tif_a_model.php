<?php

class Tif_a_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database('default',true);
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


	// // Query Execution to Get Profile Name and Number of Staff Allocation

	// public function profile_staff_allocation(){

	// 	$query = "select ps.name ,ps.id,if(count(spa.staff_id)=0,0,count(spa.staff_id)) as staff_allocated from atif_staff.profile_setup ps 

	// 			 left join  atif_staff.staff_profile_allocation spa 
	// 			 on (spa.profile_setup_id = ps.id and spa.record_deleted = 0)

				 
	// 			 group by ps.name order by ps.id";
	// 	$row =  $this->db->query($query);
	// 	return $row->result();
		


	// }


	// // List of profile that is already allocated in Profile

	// public function staff_profile_allocated(){
	// 	$query = "select spa.staff_id,ps.name as profile_name,ps.id as profile_id

	// 			  from atif_staff.staff_profile_allocation spa

	// 		   	  inner join atif_staff.profile_setup as ps 
	// 			  on ps.id = spa.profile_setup_id

	// 			  where spa.record_deleted = 0";
	// 	$row = $this->db->query($query);
	// 	return $row->result();
	// }

	//======================= Profile Description =========================//
	//=====================================================================//

	public function profile_description($profile_id){
		$query = "select tt.id,tt.name,tt.profile_type_id,tpt.name as profile_type_name,tpt.is_day_wise 
				  from atif_gs_events.tt_profile tt

				  inner join atif_gs_events.tt_profile_type tpt on tpt.id = tt.profile_type_id 

				  where tt.id = ".$profile_id;
		$row = $this->db->query($query);
		$result = $row->result();
		return $result;
	}

	public function profile_allocated(){
		$query = "select tt.id,tt.profile_type_id,tt.name,count(ts.staff_id) as staff_allocation
			from atif_gs_events.tt_profile tt

			left join atif_gs_events.tt_profile_time_staff ts on (ts.profile_id = tt.id and ts.record_deleted = 0)

			 

			group by tt.id";
		$row = $this->db->query($query);
		$result = $row->result();
		return $result;
	}


}