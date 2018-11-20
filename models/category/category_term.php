<?php
class Category_term extends CI_Model{

	public function __construct()
	{
		$this->load->database('atif_assessment',TRUE);	
	}

	public function term($tablename)
	{
		$this->db->select();
		$this->db->from($tablename);
		$query = $this->db->get();
		return $query->result();
	}

	public function data_insert($tablename,$data)
	{

		$this->db->insert($tablename,$data);
	}

	public function get_table()
	{
		// $this->db->select('asg.id','g.name as grade_id','ac.name as assessment_category_id','asg.weightage','asg.is_fix');
		// $this->db->from('assessment_category_grade asg');
		// $this->db->join('atif._grade g','g.id = asg.grade_id');
		// $this->db->join('assessment_category ac','ac.id = asg.assessment_category_id');
		// $query = $this->db->get();
		// return $query->result();
		$query = 'SELECT asg.id,g.name as grade_id,ac.name as assessment_category_id,asg.weightage,asg.is_fix FROM assessment_category_grade asg 
			inner join atif._grade g on g.id = asg.grade_id
			inner join assessment_category ac on ac.id = asg.assessment_category_id';
		$rows = $this->db->query($query);
		return $rows->result();
	}

	public function category_where($tablename,$where)
	{
		$this->db->select();
		$this->db->from($tablename);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_where_table($grade_id)
	{
		$query = 'SELECT asg.id,g.name as grade_id,ac.name as assessment_category_id,asg.weightage,asg.is_fix FROM assessment_category_grade asg 
			inner join atif._grade g on g.id = asg.grade_id
			inner join assessment_category ac on ac.id = asg.assessment_category_id where grade_id = '.$grade_id." ";
		$row = $this->db->query($query);
		return $row->result();
	}

	public function get_update($tablename,$data,$where)
	{
		$this->db->where($where);
		$this->db->update($tablename,$data);
		$affectedrows = $this->db->affected_rows();
		if($affectedrows)
		{
			return $affectedrows;
		}
		else
		{
			return false;
		}
	}

	public function category_where_grade($tablename,$where)
	{
		$this->db->select();
		$this->db->from($tablename);
		$this->db->where($where);
		$query = $this->db->get();
		$row = $query->result();
		if(!empty($row))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}