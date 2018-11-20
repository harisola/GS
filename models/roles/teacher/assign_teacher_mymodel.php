<?php
class Assign_teacher_mymodel extends MY_Model{

	function __construct(){
		parent::__construct();
	}

	public function get_by_academic($tablename,$where=NULL,$where_or='')
	{
		$this->db->select();
		$this->db->from($tablename);
		if($where == Null){

		}
		else if ($where != Null){
			$this->db->where($where);
		}

		if($where_or  == ''){

		}
		else if($where_or !=''){

			$this->db->or_where($where_or);
		}
		
		$query = $this->db->get();
		$row = $query->result();

		if($row  == Null)
		{
			return $row;
		}
		else if($row != Null)
		{
			return $row;
		}
		
	}

	public function get_group_by($tablename,$where=Null,$select='',$group='')
	{


		if($select == ''){
			$this->db->select();
		}
		else if ($select != ''){
			$this->db->select($select);
		}
		
		$this->db->from($tablename);
		if($where == Null){

		}
		else if ($where != Null){
			$this->db->where($where);
		}
		if($group == '')
		{

		}
		else if($group != ''){
			$this->db->group_by($group); 
		}

		$query = $this->db->get();
		$row = $query->result();

		if($row == null)
		{
			return false;
		}
		else if($row != null)
		{
			return $row;
		}
	}

	//Get Grade South  Campus

	public function get_grade()
	{
		$query = 'SELECT id,name FROM `_grade` where id between 6 and 16';
		$row = $this->db->query($query);
		return $row->result();
	}

	//Get Grade North Campus

	public function get_grade_NC()
	{
		$query = 'SELECT id,name,if(id=17,"1","2") as order_by FROM atif.`_grade`  where (id >=1 and id <= 5) OR id = 17 order by order_by';
		$row = $this->db->query($query);
		return $row->result();
	}


}