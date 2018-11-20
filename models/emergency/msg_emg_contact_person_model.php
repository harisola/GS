<?php
class Msg_emg_contact_person_model extends MY_Model{
	protected $_table_name = 'msg_emg_contact_persons_list';
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