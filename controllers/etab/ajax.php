<?php
class Ajax extends CI_Controller{
	function  __construct(){ parent::__construct(); }
	
	public function getGrdSb(){
		$grdID = $this->input->post('grdID');
		$subject = $this->grdSubjects($grdID);
		$return = array("htmlS"=>$subject);
		echo json_encode( $return );
	}
	
	public function grdSubjects($grdID){
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$table3 = 'atif_subject.`subject` AS `a`';
		$table4 = 'atif_assessment.`gradesubjectass` AS `b`';
		$select2 = 'a.id AS subjectID ,a.dname AS subjectName';
		$ON2 = ('a.id = b.subject_id ');
		$where2 = array('b.grade_id'=>$grdID);
		
		$grdSubject = $this->ETS->joinTwoTables( $table3, $table4, $ON2, $select2, $where2 );
		$html = '';
		$html .= '<label class="label">Subject</label>';
		$html .= '';
		$html .= '<label class="select state-success">';
		$html .= '<select name="gSID" id="gSID">';
		$html .= '<option value="0">Choose name</option>';
		foreach( $grdSubject AS $s ):
		$html .= '<option value="'.$s["subjectID"].'">'.$s["subjectName"].'</option>';
		endforeach;
		$html .= '</select>';
		$html .= '<i>';
		$html .= '</i>';
		$html .= '</label>';
		return $html;
	}
	
	
	public function getGrdSbAss(){
		$sID = $this->input->post('sID');
		$gID = $this->input->post('grdID');
		$assCat = $this->gSAss($gID,$sID);
		$return = array("assCat"=>$assCat);
		echo json_encode( $return );
	}
	
	public function gSAss($gID,$sID){
		//assessment_category
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$table3 = 'atif_assessment.`assessment_category` AS `a`';
		$table4 = 'atif_assessment.`gradesubjectass` AS `b`';
		$select2 = 'a.id AS assID ,a.dname AS assName';
		$ON2 = ('a.id = b.assessment_category_id ');
		$where2 = array('b.grade_id'=>$gID, 'b.subject_id'=>$sID);
		$grdSubject = $this->ETS->joinTwoTables( $table3, $table4, $ON2, $select2, $where2 );
		$html = '';
		$html .= '<label class="label">Assessment</label>';
		$html .= '';
		$html .= '<label class="select state-success">';
		$html .= '<select name="gSAID" id="gSAID">';
		$html .= '<option value="0">Choose name</option>';
		foreach( $grdSubject AS $s ):
		$html .= '<option value="'.$s["assID"].'">'.$s["assName"].'</option>';
		endforeach;
		$html .= '</select>';
		$html .= '<i>';
		$html .= '</i>';
		$html .= '</label>';
		return $html;
		
		
	}
	
	// function for getting grade subject
	
	public function grdSubjects2(){
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$grdID = $this->input->post('grade_id');
		$session = $this->input->post('session');
		
		$table3 = 'atif_subject.`subject` AS `a`';
		$table4 = 'atif_subject.`programmesetup` AS `b`';
		$select2 = 'a.id AS subjectID ,a.dname AS subjectName';
		$ON2 = 'a.id = b.subjects ';
		
		
		$where2 = array('b.gradeID'=>$grdID,'b.sessionID'=>$session);
		$grdSubject = $this->ETS->joinTwoTables( $table3, $table4, $ON2, $select2, $where2 );
		
		$html = '';
		//$html .= '<label class="label">Subject</label>';
		//$html .= '';
		$html .= '<label class="select state-success">';
		$html .= '<select name="gradeSubject" id="gradeSubject">';
		$html .= '<option value="0">Choose name</option>';
		if( !empty($grdSubject) ){
		foreach( $grdSubject AS $s ):
		$html .= '<option value="'.$s["subjectID"].'">'.$s["subjectName"].'</option>';
		endforeach;
		}
		$html .= '</select>';
		$html .= '<i>';
		$html .= '</i>';
		$html .= '</label>';
		$return = array("HTML2" => $html );
		echo json_encode( $return );
	}
	
	
	public function gradeCategory(){
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$grdID = $this->input->post('grade_id');
		$table3 = 'atif_assessment.`assessment_category` AS `a`';
		$table4 = 'atif_assessment.`assessment_category_grade` AS `b`';
		$select2 = 'a.id AS catID ,a.dname AS catName';
		$ON2 = 'a.id = b.assessment_category_id';
		
		$where2 = array('b.grade_id'=>$grdID, 'b.is_fix'=>0);
		
		//$where2 = array('a.status' => 1);
		
		$grdCategories = $this->ETS->joinTwoTables( $table3, $table4, $ON2, $select2, $where2 );
		$html = '';
		$html .= '<label class="label">Category Type </label>';
		//$html .= '';
		$html .= '<label class="select state-success">';
		$html .= '<select name="mainCategory" id="mainCategory">';
		$html .= '<option value="0">Choose name</option>';
		if( !empty( $grdCategories ) ) :
		foreach( $grdCategories AS $s ):
		$html .= '<option value="'.$s["catID"].'">'.$s["catName"].'</option>';
		endforeach;
		endif;
		$html .= '</select>';
		$html .= '<i>';
		$html .= '</i>';
		$html .= '</label>';
		$return = array("HTML2" => $html );
		echo json_encode( $return );
		
	}
	
	
	public function gradeSubCategoryFinal(){
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$grdID = $this->input->post('grade_id');
		$subject_id = $this->input->post('subject_id');
		$categoryID = $this->input->post('categoryID');
		
		
		$table3 = 'atif_assessment.`assessment_type` AS `a`';
		$table4 = 'atif_assessment.`gradesubjectass` AS `b`';
		$select2 = 'a.id AS catID ,a.name AS catName';
		$ON2 = 'a.id = b.assessment_type_id';
		$where2 = array('b.grade_id'=>$grdID,'b.subject_id' => $subject_id, 'b.assessment_category_id' =>$categoryID, 'b.weightage >'=>0);
		$grdCategories = $this->ETS->joinTwoTables( $table3, $table4, $ON2, $select2, $where2 );
		$html = '';
		$html .= '<label class="label">Category Type </label>';
		//$html .= '';
		$html .= '<label class="select state-success">';
		$html .= '<select name="catType" id="catType">';
		$html .= '<option value="0">Type</option>';
		foreach( $grdCategories AS $s ):
		$html .= '<option value="'.$s["catID"].'">'.$s["catName"].'</option>';
		endforeach;
		$html .= '</select>';
		$html .= '<i>';
		$html .= '</i>';
		$html .= '</label>';
		$return = array("HTML3" => $html );
		echo json_encode( $return );
		
	}
	
	public function gradeCategoryFinal(){
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$grdID = $this->input->post('grade_id');
		$subjectID = $this->input->post('subjectID');
		
		$table3 = 'atif_assessment.`assessment_category` AS `a`';
		$table4 = 'atif_assessment.`gradesubjectass` AS `b`';
		$select2 = 'a.id AS catID ,a.dname AS catName';
		$ON2 = 'a.id = b.assessment_category_id';
		$where2 = array('b.grade_id'=>$grdID,"subject_id"=>$subjectID,'b.weightage >'=>0);
		
		$grdCategories = $this->ETS->joinTwoTables( $table3, $table4, $ON2, $select2, $where2 );
			$html = '';
		$html .= '<label class="label">Category </label>';
		//$html .= '';
		$html .= '<label class="select state-success">';
		$html .= '<select name="mainCategory" id="mainCategory">';
		$html .= '<option value="0">Category</option>';
		foreach( $grdCategories AS $s ):
		$html .= '<option value="'.$s["catID"].'">'.$s["catName"].'</option>';
		endforeach;
		$html .= '</select>';
		$html .= '<i>';
		$html .= '</i>';
		$html .= '</label>';
		$return = array("HTML2" => $html );
		echo json_encode( $return );
		
	}
	
	
	public function getGradeSection(){
		//$this->load->model('etab/ajax_model', 'ETA');
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$grdID = $this->input->post('grade_id');
		$userID = $this->input->post('userID');
		$sessionID = $this->input->post('sessionID');
		
		$c_sss_id = 6;
		$where = array("a.academic_session_id"=> $c_sss_id, "a.staff_id"=>$userID, "c.gradeID"=>$grdID );
		$teacherSubjects2 = $this->ETS->teacherSubjectData($where);
		
		$secName   = array();
		$sectionID = array();
		$subjectID = array();
		$Subject   = array();
		$subject_teacher = array();
		foreach ($teacherSubjects2 as $h) {
			$sectionID[] = $h['sectionID'];
			$secName[]   = $h['secName'];
			$subjectID[] = $h["subjectID"];
			$Subject[]   = $h["Subject"];
			$subject_teacher[] = $h['tSID'];
		}
		$subjectID = array_unique( $subjectID );
		$Subject   = array_unique( $Subject );
		$data['sections'] = array_combine( $sectionID, $secName );
		$data['subject']  = array_combine( $subjectID, $Subject );
		$data["subject_teacher"] = $subject_teacher;
		
		//var_dump( $data['sections'] );
		
		//$data['sections'] = $this->ETA->gradeSection($grdID);
		$this->load->view("etab/assessment_detail/gradeSections", $data );
	}
	
	public function gradeSection($teacherSubjects2){
		
		$secName   = array();
		$sectionID = array();
		foreach ( $teacherSubjects2 as $h ) {
			$secName[] = $h['secName'];
			$sectionID[] = $h['sectionID'];
		}
		$secName   = array_unique( $secName );
		$sectionID = array_unique( $sectionID );
		$session   = array_combine( $secName, $sectionID );
		
	}
	
	
	public function grdSubjects3(){
		
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$grdID = $this->input->post('grade_id');
		$userID = $this->input->post('userID');
		
		$c_sss_id = 6;
		$where = array("a.academic_session_id"=> $c_sss_id, "a.staff_id"=>$userID, "c.gradeID"=>$grdID );
		$teacherSubjects2 = $this->ETS->teacherSubjectData($where);
		$subjectID = array();
		$Subject   = array();
		$html = '';
		
		foreach( $teacherSubjects2 as $h ){
			$subjectID[] = $h["subjectID"];
			$Subject[]   = $h["Subject"];
		}
		
		$subjectID = array_unique( $subjectID );
		$Subject   = array_unique( $Subject );
		$subjects  = array_combine( $subjectID, $Subject );
		
		$html .= '<label class="select state-success">';
		$html .= '<select name="gradeSubject" id="gradeSubject">';
		$html .= '<option value="0">Choose name</option>';
		foreach( $subjects AS $k => $v ):
			$html .= '<option value="'.$k.'">'.$v.'</option>';
		endforeach;
		$html .= '</select>';
		$html .= '<i>';
		$html .= '</i>';
		$html .= '</label>';
		$return = array("HTML2" => $html );
		echo json_encode( $return );
	}
	
	public function getTerms(){
		
		$this->load->model('etab/academic/assessment_term','AM');
		$acedmicID = $this->input->post('acedmicID');
		//$tablename = "`assessment_term_academic_session`";
		$where = array("a.academic_session_id"=>$acedmicID);
		$resutls = $this->AM->getTerm($where);
		$html ='';
		$html .='<option value=""> Choose </option>';
		foreach($resutls AS $r ){
			$html .='<option value='.$r["term_id"].'>'.$r["Term"].'  </option>';	
		}
		echo $html;
	}
	
	
	public function studentMarks(){
		
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$detail_id = $this->input->post('detail_id');
		$user_ip = $this->input->post('user_ip');
		$user_agent = $this->input->post('user_agent');
		$obtainMarks = $this->input->post('obtainMarks');
		$student_id = $this->input->post('student_id');
		$user_id = $this->input->post('user_id');
		$pending_marks = (int)$this->input->post('pending_marks');
		$mObtn = $this->input->post('mObtn');
		
		
		
		$db2 = "subject_marks";
		$table = "assessment_marks";
		$return = 0;
		$key = $detail_id."_".$student_id;
		if($pending_marks == 0){
			$data = array(
			"key" =>$key,
			"assessment_detail_id"=>$detail_id, 
			"student_id"=>$student_id, 
			"marks_obtained"=>$mObtn,
			"ip4"=>$user_ip, 
			"agent_string"=>$user_agent,
			"created"=>time(),
			"register_by"=>$user_id
			);
			echo $return = 0;
		}else{
			$data = array(
			"key" =>$key,
			"assessment_detail_id"=>$detail_id, 
			"student_id"=>$student_id, 
			"marks_obtained"=>$mObtn,
			"pendingMarks" => $obtainMarks,
			"pending_marks"=>1,
			"ip4"=>$user_ip, 
			"agent_string"=>$user_agent,
			"created"=>time(),
			"register_by"=>$user_id
			);
			echo $return = 1;
		}
		
		
		$this->ETS->setReplace( $db2, $table, $data );
		//echo $return;
		
	}
	
	
	public function approveMarks(){
		
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		
		$marksID = $this->input->post('marksID');
		$student_id = $this->input->post('students_id');
		$user_id = $this->input->post('user_id');
		$user_ip = $this->input->post('user_ip');
		$user_agent = $this->input->post('user_agent');
		$ObtainM = $this->input->post('ObtainM');
		$PenddingM = $this->input->post('PenddingM');
		$FDec = (int)$this->input->post('FDec');
		
		if( $FDec == 1 ){
			
			$data = array(
			"student_id"=>$student_id, 
			"marks_obtained"=>$ObtainM,
			"pendingMarks" => 0,
			"pending_marks"=>0,
			"ip4"=>$user_ip, 
			"agent_string"=>$user_agent,
			"unread" => 0,
			"modified"=>time(),
			"modified_by"=>$user_id
			);
			
		}else{
			
			$data = array(
			"student_id"=>$student_id, 
			"marks_obtained"=>$PenddingM,
			"pendingMarks" => 0,
			"pending_marks"=>0,
			"ip4"=>$user_ip, 
			"agent_string"=>$user_agent,
			"unread" => 0,
			"modified"=>time(),
			"modified_by"=>$user_id
			);
			
		}
		$db2 = "subject_marks";
		$table = "assessment_marks";
		echo $return = $this->ETS->replace2($db2,$table,$data,$marksID );
	}
	
	
	public function studentMarks2(){
		
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$detail_id = $this->input->post('detail_id');
		$user_ip = $this->input->post('user_ip');
		$user_agent = $this->input->post('user_agent');
		$obtainMarks = $this->input->post('obtainMarks');
		$student_id = $this->input->post('student_id');
		$user_id = $this->input->post('user_id');
		$pending_marks = (int)$this->input->post('pending_marks');
		$mObtn = $this->input->post('mObtn');
		
		$db2 = "subject_marks";
		$table = "assessment_marks";
		$return = 0;
		$key = $detail_id."_".$student_id;
		if($pending_marks == 0){
			$data = array(
			"key" =>$key,
			"assessment_detail_id"=>$detail_id, 
			"student_id"=>$student_id, 
			"marks_obtained"=>0,
			"ip4"=>$user_ip, 
			"agent_string"=>$user_agent,
			"created"=>time(),
			"register_by"=>$user_id
			);
			echo $return = 0;
		}else{
			$data = array(
			"key" =>$key,
			"assessment_detail_id"=>$detail_id, 
			"student_id"=>$student_id, 
			"marks_obtained"=>$mObtn,
			"pendingMarks" => 0,
			"pending_marks"=>1,
			"ip4"=>$user_ip, 
			"agent_string"=>$user_agent,
			"created"=>time(),
			"register_by"=>$user_id
			);
			echo $return = 1;
		}
		
		
		$this->ETS->setReplace( $db2, $table, $data );
		//echo $return;
		
	}
	
}
?>