<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assessment_marks extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		
		$teachGrade = 3;
		
		$table1 = 'atif.`_grade` AS `a`';
		$table2 = 'atif_assessment.`gradesubjectass` AS `b`';
		$select = 'a.id AS GradeID ,a.dname AS GradeName , b.subject_id AS subjectID';
		$ON = ('b.grade_id=a.id');
		$where = array('b.grade_id'=>$teachGrade);
		$data['tchrGrds'] = $this->ETS->joinTwoTables( $table1, $table2, $ON, $select, $where );
		
		$session_id = $this->session->userdata("user_id"); // 172
		
		
		$this->load->view("etab/assessment_marks/marks",$data);
		$this->load->view("etab/assessment_marks/footer");
	}	
}	