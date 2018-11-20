<?php

class Assessment_category_grade_mymodel extends MY_Model{

	protected $_table_name = '_grade';
	protected $_primary_key = 'id';
	protected $_timestamps = FALSE;
	protected $_order_by = 'id asc';

	public function __construct(){
		parent::__construct();
	}
}