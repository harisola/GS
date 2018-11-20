<?php
class Branch_wing_grade_model extends MY_Model{	
	protected $_table_name = '_branch_wing_grade';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'id';
	public $rules = array();		
	protected $_timestamps = TRUE;	

	public function __construct()
	{
		parent::__construct();
	}	
}