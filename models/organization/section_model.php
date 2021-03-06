<?php
class Section_model extends MY_Model{	
	protected $_table_name = '_section';
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
		array('field' => 'section_name', 'label' => 'Section Name', 'rules' => 'required'),
		array('field' => 'section_display_name', 'label' => 'Section Display Name', 'rules' => 'required')
	);	
}