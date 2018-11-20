<?php
class Academic_model2 extends MY_Model{

	protected $_table_name = '_academic_session';
	protected $_order_by = 'id asc';



	public function __construct()
	{
		parent::__construct();
	}


	public function get_academic()
	{
		$query = 'SELECT * From  _academic_session Where is_active = 1 or end_date > Now()';
		$row = $this->db->query($query);
		return $row->result();
	}

}