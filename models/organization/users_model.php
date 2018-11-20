<?php
class Users_model extends MY_Model{	
	protected $_table_name = 'users';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'first_name';
	public $rules = array();		
	protected $_timestamps = FALSE;	

	public function __construct()
	{
		parent::__construct();
	}	
}