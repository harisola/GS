<?php

class Subject_programs extends MY_Controller{
	
	function __construct() {
		parent::__construct();
	}
	
	public function index(){
		$this->load->model('subjects/subject_model','SM');
		$this->SubjectList = $this->parentLi();
		$data['academicsList'] = $this->indexIndex();
		
		$this->load->model('autocomplete/anotherdb_model');
		$data['grades'] = $this->anotherdb_model->getSomething();
		
		
			
		$this->load->view('subjects/program/front_page',$data);
		$this->load->view('subjects/program/footer2');
	}
	
	
	public function indexIndex(){
		$this->load->model('default_db/defaultdb','ddb');
		$select = "`id`,`branch_id`,`name`";
		$tblnm = " `_academic_session`";
		$where = array('`is_active`' => 1, '`end_date` >' => ' NOW()' );
		$academicsList = $this->ddb->get($tblnm,$select,$where);
		return  $academicsList;
		//exit;
	}
	
		
	public function parentLi(){
		$this->load->model('subjects/subject_model','SM');
		$results = $this->SM->getModule();
		$firstZeor = true;
		$firstZeor2 = 0;
		$HTML = "";
		if( $results ){
			foreach( $results as $row ){
				
				$HTML .= '<div class="col col-2">';
				$HTML .= '<h5> '.$row['name'].'</h5>';
				$HTML .= $this->childLi( $row['id'] );
				$HTML .= '</div>';
			}
		
		}
			return $HTML;
			
   }
   
  public function childLi($parentID) {
		
		$this->load->model('subjects/subject_model','SM');
		$results = $this->SM->menu_showNestedModel( $parentID );
		static $firstZeor2 = 1;
		$HTML2 = "";
		if( $results ){
		$HTML2 .= '<ol class="list-group rp-draggable">';
		foreach( $results as $row ){
			$HTML2 .=  '<li class="list-group-item" data-id="'.$firstZeor2.'" id="'.$row['id'].'">';
			$HTML2 .=  $row['dname'] .'<i class="fa fa-plus pull-right"></i>';
			$HTML2 .= 	$this->childLi( $row['id'] );	
			$HTML2 .= '</li>';
			$firstZeor2++;
		}
		$HTML2 .= '</ol>';
		$firstZeor2++;
		}
		
		return $HTML2;
	}
	
	
}