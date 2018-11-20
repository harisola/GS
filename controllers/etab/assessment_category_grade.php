<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Assessment_category_grade extends MY_Controller {	
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		//$data['grades'] = $this->grades->get();
		$this->load->model('autocomplete/mautocomplete');
		$select = "*";
		$tableName = "assessment_category";
		$where = array( 'status' => 1 );
		$data['categories'] = $this->mautocomplete->getAll($tableName,$select,$where );
		$this->load->model('autocomplete/anotherdb_model');
		$data['grades'] = $this->anotherdb_model->getSomething();
		$acaSession = date("Y",time());
		
		if( $academicYear = $this->getAcademicSession( $acaSession ) ){
			$currentAcademicYear = $academicYear->id;	
			$tableName= "assessment_term";
			$select2 = "id,name";
			$where2 = array( 'academic_id' => $currentAcademicYear );
			$academicYearTerms = $this->getAcdmSssnYear( $tableName, $select2,$where2 );
			$firstTermID = $academicYearTerms[0]->id ;
			$firstTermName = $academicYearTerms[0]->name;
		}else{
			$firstTermID = 0;
			$firstTermName = 0;
		}
		
		
	
		
		$getAssmnt["sessionAssessments"] = $this->getAss();
		//$getAssmnt2[0]->ctTypeID;$counter =  count($getAssmnt);for($i=0; $i < sizeof($getAssmnt); $i++ ){ $catID =  $getAssmnt[$i]->catID; }
		
		$this->load->model('etab/academic/academic_model','AM');
		if( $this->AM->get() ){
			$data['acLists'] = $this->AM->get();
		}else{
			$data['acLists'] = NULL;
		} 
		//$table = "`gradesubjectass`";
		// data save in above mentioned table
		
		//var_dump($data);
		//exit;
		$this->load->view("etab/assForGrades/ass_create", $data);
		$this->load->view("etab/assForGrades/ass_display_cat_type",$getAssmnt);
		$this->load->view("etab/assForGrades/footer");
	}
	
	
	public function add(){
		$this->load->view("etab/assement_category_type");
		$this->load->view("etab/footer");
	}
	
	public function edit(){
		$this->load->view("etab/assement_cat_edit");
		$this->load->view("class_list/face_view/face_view_orb_footer");
	}
	
	
	public function getAcademicSession( $acaSession ){
		$this->load->model('autocomplete/mautocomplete',TRUE);
		$select = "*";
		$tableName = "assessment_academic";
		$where = array( 'year_name' => $acaSession );
		$academicYear = $this->mautocomplete->getRow($tableName,$select,$where );
		return $academicYear;
	}
	
	public function getAcdmSssnYear( $tableName, $select=NULL, $where = NULL ){
		$this->load->model('autocomplete/mautocomplete',TRUE);
		if($select != NULL ){
			$select = $select;
		}else{
			$select = "*";
		}
		$academicYears = $this->mautocomplete->getAll( $tableName, $select, $where = NULL );
		return $academicYears;
	}
	
	
	public function getAss(){
		$this->load->model('autocomplete/anotherdb_model');
		return $this->anotherdb_model->getAssmnt();
	}
	
	
	
	
}