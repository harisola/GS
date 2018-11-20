<?php
class Tif_form_model extends MY_Model{

	protected $_table_name = 'staff_registered';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	//protected $_order_by = 'call_name desc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct()

	{
		parent::__construct();
	}
		//GFID
	

			// Getting The Staff Information.
	public function getAllStaffInfo()
	{
		$query = "select sr.gt_id from atif.staff_registered as sr
where sr.is_posted=1
and sr.is_active=1
and sr.staff_status=1";
		$row = $this->db->query($query);
		if($row != null)
		{
			return $row->result_array();	
		}
		else
		{
			return false;
		}
		
	}





		// Getting The Staff Information.
	public function getStaffInfo($gtID)
	{
		$query = "SELECT * FROM $this->_table_name Where gt_id = '".$gtID."'";
		$row = $this->db->query($query);
		if($row != null)
		{
			return $row->result_array();	
		}
		else
		{
			return false;
		}
		
	}

	// Getting the Staff Address
	public function getStaffAdd($gtID)
	{
		$query="SELECT * FROM staff_contact_info Where staff_id = '".$gtID."'";
		$row=$this->db->query($query);
		if($row != null)
		{
			return $row->result_array();	
		}
		else
		{
			return false;
		}

	}

	public function getStaffID($gtid)
	{
		$query="select id from staff_registered where gt_id='".$gtid."'";
		$staff_id=$this->db->query($query);
		return $staff_id->result_array();
	}

	public function getEmail($gtid)
	{
		$query="SELECT SUBSTRING(sr.gg_id, 1, POSITION('@' IN sr.gg_id)-1) as gg_id From staff_registered sr where gt_id = '".$gtid."'" ."ORDER BY `gg_id` DESC";
		$row=$this->db->query($query);
		return $row->result_array();
	}

	// Get Staff GGID
	// public function gefGG_ID()
	// {

	// }
	// Getting Qualification
	public function getQualification($staff_id)
	{
		$query="SELECT srq.level,srq.title,srq.institute,srq.subjects, srq.result,srq.year_of_completion,srq.is_professional From staff_registered_qualification srq left join staff_registered sr on sr.id = srq.staff_id where staff_id = '".$staff_id."'";
		$row =$this->db->query($query);
		return $row->result_array();
	}
	//Getting EmployeHistory
	public function getEmployeHistory($staff_id)
	{
		$query="SELECT sre.organization ,sre.designation,sre.classes_taught,sre.subject_taught,sre.salary, sre.from_year,sre.to_year,sre.reason_for_leaving From staff_registered_employement sre left join staff_registered sr on sr.id = sre.staff_id where staff_id = '".$staff_id."'";
		$row=$this->db->query($query);
		return $row->result_array();
	}
	//Getting Father_Spouse
	public function getFatherSpouse($staff_id)
	{

		$query="SELECT srfp.name,srfp.profession,srfp.qualification,srfp.designation,srfp.company,
		srfp.department,srfp.nic,srfp.mobile_phone,srfp.mobile_phone ,srfp.marital_status ,srfp.is_spouse FROM
		staff_registered_father_spouse srfp left Join staff_registered sr on sr.id =
		srfp.staff_id where srfp.staff_id = '".$staff_id."'";
		$row = $this->db->query($query);
		return $row->result_array();
	}

	//Getting Gf-ID
	public function getGfId($staff_id)
	{
		$query="SELECT gf_id From staff_child where staff_id='".$staff_id."'";
		$row=$this->db->query($query);
		return $row->result_array();
	} 
	//Children Detail
	public function getChildrenDetail($gfid)
	{
		$query="SELECT official_name,dob,gs_id from class_list where gf_id='".$gfid."'";
		$row=$this->db->query($query);
		return $row->result_array();
	}
	public function getAge($gfid)
	{
		$query="SELECT  DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(cl.dob, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(cl.dob, '00-%m-%d')) AS age
			FROM class_list cl where gf_id = '".$gfid."'";
		$row=$this->db->query($query);
		return $row->result_array();
	}

	public function getEmergencyContact($staff_id)
	{
		$query="SELECT sre.name,sre.address,sre.email,sre.phone,sre.relationship FROM staff_registered_emergency sre left join staff_registered sr on sr.id = sre.staff_id where staff_id = '".$staff_id."'" ;
		$row=$this->db->query($query);
		return $row->result_array();

	}
	public function getBankdetail($staff_id)
	{
		$query="SELECT srba.bank_name,srba.branch,srba.branch_code,srba.account_number From 
		staff_registered_bank_account srba Left join staff_registered sr on sr.id=
		srba.staff_id where staff_id = '".$staff_id."'";
		$row=$this->db->query($query);
		return $row->result_array();
	}
	public function geteobi($gt_id)
	{
		$query="SELECT eobi_no,sessi_no From staff_registered where gt_id= '".$gt_id."'";
		$row=$this->db->query($query);
		return $row->result_array();
	}

	public function get_by_tif($tablename,$where=null,$select_col=''){

		if($select_col == ''){
			$this->db->select();
		}
		else if ($select_col != ''){
			$this->db->select($select_col);
		}

		$this->db->from($tablename);

		if($where == null){

		}
		else if($where != null){
			$this->db->where($where);
		}

		$query = $this->db->get();
		$row = $query->result();

		if($row != null){
			return $row;
		}
		else if($row == null){
			return false;
		}

	}

}