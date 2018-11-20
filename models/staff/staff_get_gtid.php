<?php
class Staff_get_gtid extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get_max_gtid($GTIDYear){

		$query=$this->db->query("SELECT max(gt_id) as max_id FROM staff_registered WHERE gt_id like '" . $GTIDYear . "-%'"); 
		$row = $query->row_array();
		$max_id = $row['max_id'];

		return $max_id;
	}



	public function getCardTopLine(){

		$query=$this->db->query("SELECT c_topline FROM `staff_registered` group by c_topline order by c_topline asc");		
		$rows_array = $query->result_array();		

		return $rows_array;
	}


	public function getCardBottomLine(){

		$query=$this->db->query("SELECT c_bottomline FROM `staff_registered` group by c_bottomline order by c_bottomline asc");
		$rows_array = $query->result_array();		

		return $rows_array;
	}
}
?>