<?php
class Class_list_freeze_date_model extends CI_Model
{
	public function __construct(){ parent::__construct(); }

	public function set_freeze_date($data)
	{
		$this->db->query($data);
  }
	public function get_freezed_date($query)
  {

  	$query = $this->db->query($query);
		$row   = $query->result_array();
		return $row;
	}
}