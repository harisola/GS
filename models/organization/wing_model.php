<?php
class Wing_model extends MY_Model{	
	protected $_table_name = '_wing';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'id';
	public $rules = array();		
	protected $_timestamps = TRUE;	

	public function __construct()
	{
		parent::__construct();
	}

	public $validation = array(
		array('field' => 'wing_name', 'label' => 'wing Name', 'rules' => 'required'),
		array('field' => 'wing_display_name', 'label' => 'wing Display Name', 'rules' => 'required')		
	);	
}