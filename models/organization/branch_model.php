<?php
class Branch_model extends MY_Model{	
	protected $_table_name = '_branch';
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
		array('field' => 'branch_name', 'label' => 'Branch Name', 'rules' => 'trim|required|xss_clean')
	);
}