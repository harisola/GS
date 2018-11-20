<?php 
class Subject_Grade_mymodel extends MY_Model{

	public function __Construct()
	{
		parent::__Construct();
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

	public function get_grade()
	{
		$query = 'SELECT id,name FROM `_grade` where id between 6 and 16';
		$row = $this->db->query($query);
		return $row->result();
	}

	public function get_grade_NC()
	{
		$query = 'SELECT id,name FROM `_grade` where id between 1 and 5';
		$row = $this->db->query($query);
		return $row->result();
	}
}



?>