<?php
class Staff_status_model extends MY_Model{
	protected $_table_name = '_staffstatus';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'id asc';
	public $rules = array();
	protected $_timestamps = FALSE;

	public function __construct()
	{
		parent::__construct();
	}
}