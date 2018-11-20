<?php
class Branch_users_model extends MY_Model{	
	protected $_table_name = '_branch_user';
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
		array('field' => 'branch', 'label' => 'Branch Name', 'rules' => 'required'),
		array('field' => 'users', 'label' => 'User Name', 'rules' => 'required')
	);	
}