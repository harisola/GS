<?php

class Category_subject extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database('atif_role',TRUE);
	}

	public function subject($where_subject)
	{
		$this->db->select('ass.name,ass.id',false);
		$this->db->from('academic_subject as ass ');
		$this->db->join('academic_program as ap','ap.subject_id = ass.id');
		$this->db->where($where_subject);
		$query = $this->db->get();
		return $query->result();
	}

}