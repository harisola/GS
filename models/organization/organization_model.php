<?php
class Organization_model extends MY_Model{	
	protected $_table_name = '_organization';
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
		array('field' => 'org_name', 'label' => '', 'rules' => 'trim|required|xss_clean')		
	);
}