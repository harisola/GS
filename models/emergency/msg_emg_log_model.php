<?php
class Msg_emg_log_model extends MY_Model{
	protected $_table_name = 'msg_emg_log';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'id asc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct()
	{
		parent::__construct();
	}

	public $validation = array(
		array('field' => 'contact_id', 'label' => 'Contact Type', 'rules' => 'intval|required'),
		array('field' => 'msg_id', 'label' => 'Message', 'rules' => 'intval|required')
	);
}