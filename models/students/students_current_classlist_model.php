<?php
class Students_current_classlist_model extends MY_Model{

	protected $_table_name = 'students_current_classlist';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'grade_id desc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct()
	{
		parent::__construct();
	}	
}