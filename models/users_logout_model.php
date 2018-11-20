<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_logout_model extends MY_Model{
	protected $_table_name = 'users_logout';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'created';
	protected $_rules = array();
	protected $_timestamps = TRUE;
}