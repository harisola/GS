<?php
class Staff_child_model extends MY_Model{
	protected $_table_name = 'staff_child';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'id asc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct()
	{
		parent::__construct();
	}



	public function is_staff_is_family($StaffID){
		$result = false;
		$query=$this->db->query("SELECT id FROM atif.staff_child where staff_id = '" . $StaffID . "'");		
		if ($query->num_rows() > 0) {
			$result=true;			
		}

		return $result;
	}


	public function get_staff_child_id($StaffID){
		$id=0;
		$query=$this->db->query("SELECT id FROM atif.staff_child where staff_id = " . $StaffID);
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$id = $row['id'];			
		}		

		return $id;
	}




	public function getStaffChildDetail($GFID){

		$query=$this->db->query("SELECT * FROM atif.class_list where gf_id = $GFID order by dob desc");
		$rows_array = $query->result_array();		

		return $rows_array;
	}

	public function get_staff_father_spouse($staffID,$spouseType){
		$query = $this->db->query("SELECT if(sr.father_name=sp.name,sr.father_name,sp.name) as name,sp.spouseType FROM atif.staff_registered sr join 
				atif.staff_registered_father_spouse sp ON sp.staff_id = sr.id 
				WHERE sp.staff_id = ".$staffID." and sp.spouseType = ".$spouseType);
		$row = $query->result();
		return $row;
	}

	public function get_address($staffID){
		$query = $this->db->query("select sci.apartment_no,sci.building_name,
				  sci.plot_no,sci.street_name,rs.name as sub_region,r.name as region
				  from atif.staff_contact_info sci
				  left join atif._region r on r.id = sci.region
				  left join atif._region_sub rs on rs.id = sci.sub_region
				  where sci.staff_id = ".$staffID);
		$row = $query->result();
		return $row;
	}

}