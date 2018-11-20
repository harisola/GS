<?php
class Academic_session_model extends MY_Model{	
	protected $_table_name = '_academic_session';
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
		array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|xss_clean'),
		array('field' => 'dname', 'label' => 'Display Name', 'rules' => 'trim|required|xss_clean'),
		array('field' => 'start_date', 'label' => 'Start Date', 'rules' => 'trim|required|xss_clean'),
		array('field' => 'end_date', 'label' => 'End Date', 'rules' => 'trim|required|xss_clean'),
		array('field' => 'is_active', 'label' => 'Is Active', 'rules' => 'required')
	);
}