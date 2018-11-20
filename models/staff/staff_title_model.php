<?php
class Staff_title_model extends MY_Model{
	protected $_table_name = '_title_person';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'order asc';
	public $rules = array();
	protected $_timestamps = FALSE;

	public function __construct()
	{
		parent::__construct();
	}
}