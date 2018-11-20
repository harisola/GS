<?php
class Student_family_ec_model extends MY_Model{
	protected $_table_name = 'student_family_ec';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'created desc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct()
	{
		parent::__construct();
	}
}