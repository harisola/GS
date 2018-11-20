<?php
class Career_ic_allowed_model extends MY_Model{	
	protected $_table_name = 'career_ic_allowed';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'id asc';
	public $rules = array();
	protected $_timestamps = TRUE;	

	public function __construct()
	{
		parent::__construct();
	}
}