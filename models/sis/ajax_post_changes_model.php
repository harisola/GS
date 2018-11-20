<?php
class Ajax_post_changes_model extends CI_Model{

	private $db_atif;

	function __construct()
	{
		parent::__construct();
		$this->db_atif = $this->load->database('default',TRUE);
	}

	public function save($data, $where )
	{
		//$table_name_ci = '`atif`.`student_contact_info`';
		$table_name_ci = '`atif`.`student_registered`';
		
		$this->db_atif->set($data);
		$this->db_atif->where( $where );
		$this->db_atif->update($table_name_ci);
		return $this->db_atif->affected_rows();
	}


	public function update_family_record($data, $where )
	{
		$table_name_ci = '`atif`.`student_family_record`';
		$this->db_atif->set($data);
		$this->db_atif->where( $where );
		$this->db_atif->update($table_name_ci);
		return $this->db_atif->affected_rows();
	}

	
}