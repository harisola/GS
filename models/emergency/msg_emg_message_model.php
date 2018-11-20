<?php
class Msg_emg_message_model extends MY_Model{
	protected $_table_name = 'msg_emg_message';
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
		array('field' => 'message', 'label' => 'Custom Message', 'rules' => 'trim|required')
	);
}