<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends MY_Model{
	protected $_table_name = 'groups';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'dname';
	protected $_rules = array();
	protected $_timestamps = FALSE;
}