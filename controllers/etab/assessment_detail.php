<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assessment_detail extends MY_Controller {	

	public function __construct(){
		parent::__construct();
	}
	//g.abid@generations.gs
	public function index(){
		
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$teachGrade = 3;
		$table1 = 'atif.`_grade` AS `a`';
		$table2 = 'atif_assessment.`gradesubjectass` AS `b`';
		$select = 'a.id AS GradeID ,a.dname AS GradeName , b.subject_id AS subjectID';
		$ON = ('b.grade_id=a.id');
		$where = array('b.grade_id'=>$teachGrade);
		$data['tchrGrds'] = $this->ETS->joinTwoTables( $table1, $table2, $ON, $select, $where );
		
		$this->load->model('autocomplete/anotherdb_model','AM');
		$data['grades'] = $this->AM->getSomething();
		
		$login_user_id = $this->session->userdata("user_id"); //118 GAA
		
		$reg_user = $this->ETS->getStaffID( $login_user_id );
		$reg_user_id = $reg_user['id'];
		
		$c_sss_id = 6;
		//$where = array("academic_session_id"=> $c_sss_id, "staff_id"=>$reg_user_id );
		//$teacherSubjects = $this->ETS->teacherSubject($where);
		
		
		
		$c_sss_id = 6;
		$where = array("a.academic_session_id"=> $c_sss_id, "a.staff_id"=>$reg_user_id );
		$teacherSubjects2 = $this->ETS->teacherSubjectData($where);
		
		// var_dump( $teacherSubjects ); 
		
		//var_dump( $teacherSubjects2 );
		//exit;
		$gradeID = array();
		$grade = array();
		$subject_teacher = array();
		
		if($teacherSubjects2){
			foreach ($teacherSubjects2 as $h) {
			$gradeID[] = $h['gradeID'];
			$grade[] = $h['Grade'];
			$subject_teacher[] = $h['tSID'];
		}
		$gradeID = array_unique($gradeID);
		$grade = array_unique($grade);
		$data['grandGrades'] = array_combine($gradeID,$grade);
		$data["subject_teacher"] = $subject_teacher;
		}else{
			$data['grandGrades'] = NULL;
			$data["subject_teacher"] = NULL;
		}
		
		
		
		
		$data["user_id"] = $reg_user_id;
		$data["sessionID"] = $c_sss_id;
		
		
		// $grandGrades = array_combine($gradeID,$grade);
		// foreach($grandGrades AS $key => $value ){ echo $key; echo "<br />"; echo $value; } exit;
		
		// $subjectID = $tchrGrds[0]["subjectID"];
		// $table3 = 'atif_subject.`subject` AS `a`';
		// $table4 = 'atif_assessment.`gradesubjectass` AS `b`';
		// $select2 = 'a.id AS subjectID ,a.dname AS subjectName';
		// $ON2 = ('a.id = b.subject_id ');
		// $where2 = array('b.subject_id'=>$subjectID);
		// $grdSubject = $this->ETS->joinTwoTables( $table3, $table4, $ON2, $select2, $where2 );
		// var_dump($tchrGrds);
		// exit;
		
		$this->load->view("etab/assessment_detail/detail_view", $data );
		$this->load->view("etab/assessment_detail/footer");
		
	}
}	