<?php
class Subjects extends MY_Controller{
	function __construct() {
		parent::__construct();
	}
	public function index(){
		
		$this->load->model('subjects/subject_model','SM');
		$this->SubjectList = $this->getSubList();
		//$this->load->view('subjects/testing/front_page2');
		//$this->load->view('subjects/testing/footer2');
		$this->load->view('subjects/front_page');
		$this->load->view('subjects/footer');
	}

	
	
	public function getSubList(){
		$this->load->model('subjects/subject_model','SM');
		$results = $this->SM->getModule();
		$HTML = "";
		if( $results ){
		$HTML .= '<ol class="dd-list">';
		foreach( $results as $row ){
				$HTML .= '<li class="dd-item" data-id="'.$row['id'].'" id="'.$row['id'].'">';
				$HTML .= '<div class="dd-handle">'.$row['name'].'<a class="pull-right btn-link" id="item_'.$row['id'].'"><i class="fa fa-close"></i>Edit</a></div>';
				$HTML .= $this->menu_showNested( $row['id'] );
				$HTML .= '</li>';
				//$HTML .= '<a class="pull-right button-delete text-danger" id="item_'.$row['id'].'"><i class="fa fa-close"></i>Edit</a>';
			}
			$HTML .= '</ol>';
		return $HTML;
		}else{
			return $HTML;
		}	
   }
   
  public function menu_showNested($parentID) {
		$this->load->model('subjects/subject_model','SM');
		$results = $this->SM->menu_showNestedModel( $parentID );
		$HTML2 = "";
		if( $results ){
		$HTML2 .= '<ol class="dd-list">';
		foreach( $results as $row ){
			$HTML2 .=  '<li class="dd-item" data-id="'.$row['id'].'">';
			$HTML2 .=  '<div class="dd-handle">'.$row['name'].'<a class="pull-right btn-link" id="item_'.$row['id'].'"><i class="fa fa-close"></i>Edit</a></div>';
			$HTML2 .= 	$this->menu_showNested( $row['id'] );
			$HTML2 .= '</li>';
		}
		$HTML2 .= '</ol>';
		}
		return $HTML2;
	}
	
}
