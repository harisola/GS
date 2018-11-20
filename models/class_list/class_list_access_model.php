<?php
class Class_list_access_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_allowed_class($where1, $where2){
		$class_query = "SELECT * FROM class_list_access WHERE (" . $where1 . ") AND (" . $where2 . ") order by complete_in_years desc, all_sections_allowed desc";
		$query=$this->db->query($class_query); 
		$row = $query->result_array();	
				
		return $row;
	}

	public function get_all_sections($GradeName, $AcademicSessionId){
		$sections_query = "SELECT section_dname FROM class_list where grade_name = '" . $GradeName . "' and academic_session_id = " . $AcademicSessionId . " group by section_dname order by section_position asc";
		$query=$this->db->query($sections_query); 
		$row = $query->result_array();	
				
		return $row;
	}
	
	
	public function get_user_group($user_id){
		//$query = "SELECT ug.group_id AS GroupID FROM atif.users_groups AS ug WHERE ug.user_id = $user_id LIMIT 1";
		
		$query = "select if(gg.id = 23 or gg.id = 25 or gg.id = 31, 1, 0) as result from atif.users as u left join atif.users_groups as g on g.user_id = u.id left join atif.groups as gg on gg.id = g.group_id where u.id =".$user_id." group by u.id";
		
		//$query = "SELECT rp.staff_id AS StaffID FROM atif_role_org.`role_position` AS rp WHERE rp.`gp_id` LIKE '%N-FO%' AND rp.staff_id = $user_id LIMIT 1";
		
		$query=$this->db->query($query); 
		if( $query->num_rows() > 0 ){
			return $query->row_array();	
		}else{
			return FALSE;
		}
	}
	
	// Get Current User ids if frontofficer than  
	public function getFrontOfficersID($user_id){
		
		$query = "SELECT sr.user_id AS Notity_To FROM atif.staff_registered AS sr JOIN atif_role_org.role_position AS rp 
		ON (rp.staff_id = sr.id ) WHERE sr.user_id=".$user_id." AND sr.is_active=1 AND sr.is_posted=1 AND rp.gp_id LIKE '%N-FO%'";
		
		$query=$this->db->query($query); 
		if( $query->num_rows() > 0 ){
			return 1;
		}else{
			return 0;
		}
	}
}