<?php
class Grade_model extends MY_Model{	
	protected $_table_name = '_grade';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'id';
	public $rules = array();		
	protected $_timestamps = TRUE;	

	public function __construct()
	{
		parent::__construct();
	}

	public $validation = array(
		array('field' => 'grade_name', 'label' => 'Grade Name', 'rules' => 'required'),
		array('field' => 'grade_display_name', 'label' => 'Grade Display Name', 'rules' => 'required'),
		array('field' => 'grade_complete_in_years', 'label' => 'Grade Complete in Years', 'rules' => 'required|integer'),
	);	
}