<?php
class Department_model extends MY_Model{	
	protected $_table_name = '_department';
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
		array('field' => 'department_name', 'label' => 'Department Name', 'rules' => 'required'),
		array('field' => 'department_display_name', 'label' => 'Department Display Name', 'rules' => 'required')
	);	
}