<?php
class Teacher_side_model extends CI_Model{
	
	private $SDB;
	private $DBMR;
	
	function __construct(){	parent::__construct(); }
	
	
	public function joinTwoTables( $tbl1, $tbl2, $on, $select=NULL, $where = NULL  ){
		$this->SDB = $this->load->database("default",TRUE);
		$this->SDB->distinct();
		if($select != NULL ){
			$this->SDB->select( $select );
		}else{
			$this->SDB->select("*");
		}
		$this->SDB->from($tbl1);
		$this->SDB->join($tbl2, $on);
		if($where != NULL ){
			$this->SDB->where( $where );
		}
		$query = $this->SDB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}	
	}
	
	public function getStaffID($loginID){
		$this->SDB = $this->load->database("default",TRUE);
		$this->SDB->select("*");
		$this->SDB->from("staff_registered");
		$this->SDB->where( "user_id", $loginID );
		$query = $this->SDB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->row_array();
			return $results;
		}else{
			return false;
		}
		
	}
	
	public function teacherSubject($where){
		$this->DBMR = $this->load->database("role_matrix",TRUE);
		$this->SDB->select("*");
		$this->SDB->from("role_subject_teacher");
		$this->SDB->where( $where );
		$query = $this->SDB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}
	}
	
	
	
	public function teacherSubjectData( $where ){
		
		$this->DB = $this->load->database("default",TRUE);
	
		
		$query ="SELECT 
		
		a.id AS tSID, a.program_id AS pID, a.gp_id AS GPID, b.dname AS secName,b.id AS sectionID,c.optional AS OPT,d.id AS gradeID, d.dname AS Grade, e.id AS subjectID, e.dname AS Subject,e.code AS subjectCode, concat(d.dname, '-', e.code, right(a.gp_id, 4)) AS gpp_id


		FROM atif_role_matrix.role_subject_teacher AS a

		LEFT JOIN atif._section AS b on b.id =a.section_id
		LEFT JOIN atif_subject.programmesetup AS c on a.program_id = c.id
		LEFT JOIN atif._grade AS d on c.gradeID = d.id
		LEFT JOIN atif_subject.subject AS e ON c.subjects = e.id
		
		WHERE ".$where;
		
		//print_r($query);
		$result = $this->DB->query( $query );
		$results = $result->result_array();
		return $results;
		
		
		
		//return $results;
		
		
	} 
	

	
	public function getSingleRow( $db2,  $tablename, $select=NULL, $where=NULL ){
		$this->SDB = $this->load->database($db2,TRUE);
		if($select != NULL ){
			$this->SDB->select( $select );
		}else{
			$this->SDB->select("*");
		}
		$this->SDB->from($tablename);
		if($where != NULL ){
			$this->SDB->where( $where );
		}
		$query = $this->SDB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->row_array();
			return $results;
		}else{
			return false;
		}
	}
	
	public function getAll( $db2, $table, $select=NULL, $where=NULL){
		
		$this->DB = $this->load->database($db2,TRUE);
		//$this->DB->distinct();
		if($select != NULL ){
			$this->DB->select( $select );
		}else{
			$this->DB->select("*");
		} 
		$this->DB->from( $table );
		if($where != NULL ){
			$this->DB->where( $where );
		}
		$query = $this->DB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
		}else{
			return FALSE;
		}
	}
	
	public function insert( $db2, $table, $data ){
		
		$this->DB = $this->load->database($db2,TRUE);
		$this->DB->insert($table,$data);
		$lastInsertedID = $this->DB->insert_id();
		if( $lastInsertedID > 0 ){
			return $lastInsertedID;
		}else{
			return FALSE;
		}
	}
	
	
	public function replace2($db2,$table,$data,$id ){
		$this->DB = $this->load->database($db2,TRUE);
		$this->DB->where('id', $id);
        $this->DB->update($table, $data); 
		$afftectedRows=$this->DB->affected_rows();
		return $afftectedRows;
	}
	

	public function class_list($detail_id,$grade_id,$section_id){
		$this->DB = $this->load->database("default",TRUE);
		
	$query = "select cl.id AS student_id, cl.abridged_name AS Name, marks.marks_obtained AS OtainMarks, marks.pending_marks, marks.pendingMarks, cl.created from atif.class_list cl left join 
	(select student_id, marks_obtained,pending_marks,pendingMarks from atif_subject_marks.assessment_marks where assessment_detail_id='".$detail_id."') as marks on marks.student_id=cl.id
	where cl.grade_id='".$grade_id."' and cl.section_id='".$section_id."' and ( cl.std_status_category = 'Student' or cl.std_status_category = 'Fence' ) 
	order by cl.grade_id, cl.section_id,
	cl.class_no=0,cl.class_no,cl.created, cl.call_name, cl.abridged_name";


	
	/*$query = "select cl.id AS student_id, cl.abridged_name AS Name, marks.marks_obtained AS OtainMarks,marks.pending_marks, marks.pendingMarks from atif.class_list cl left join 
	(select student_id, marks_obtained,pending_marks,pendingMarks from atif_subject_marks.assessment_marks where assessment_detail_id='".$detail_id."') as marks on marks.student_id=cl.id
	where cl.grade_id='".$grade_id."' and cl.section_id='".$section_id."' and ( cl.std_status_category = 'Student' or cl.std_status_category = 'Fence' ) order by cl.grade_id, cl.section_id, cl.call_name"; */
	
	
		$result = $this->DB->query( $query );
		$results = $result->result_array();
		return $results;
		//return $this->DB->last_query();
	}
	
	
public function class_list2($detail_id,$blockID,$subjectblock){
		$this->DB = $this->load->database("default",TRUE);
		
	$query = "select
stdblk.blockid, stdblk.studentid, stdblk.subjectblock,
cl.id AS student_id, cl.abridged_name AS Name, marks.marks_obtained AS OtainMarks, marks.pending_marks, marks.pendingMarks,

if(cl.std_status_category = 'student', 1, 
if(cl.std_status_category = 'fence', 2,
if(cl.std_status_category = 'out', 3, Null))) as student_order

from atif_subject.studentselectedblock stdblk
left join atif.class_list cl on cl.id=stdblk.studentid 
left join 
	(select student_id, marks_obtained,pending_marks,pendingMarks from atif_subject_marks.assessment_marks where assessment_detail_id='".$detail_id."') as marks on marks.student_id=cl.id
	where stdblk.blockID='".$blockID."' and stdblk.subjectblock='".$subjectblock."' and stdblk.record_deleted=0 and ( cl.std_status_category = 'Student' or cl.std_status_category = 'Fence' ) order by student_order, cl.call_name";


	
	
		$result = $this->DB->query( $query );
		$results = $result->result_array();
		return $results;
		//return $this->DB->last_query();
	}
	
	
	
	public function setReplace($db,$table,$data){
		$this->DB = $this->load->database($db,TRUE);
		$replace = $this->DB->replace($table,$data);
		if($replace){
			return true;
		}else{
			return false;
		}
		
	}
	
	
	/*
	 * Function for getting lead teacher info
	 */
	 
	public function getLT( $teacher_id, $prgm_id ){
		
	}
	
	
	/*
		Programme Grade, Subject Names
	*/
	
	public function programGradeSub($where){
		$this->DB = $this->load->database("default",TRUE);
		
		$tbl3 ="`atif_subject`.`programmesetup` AS `c`";
		$tbl4 ="`atif`.`_grade` AS `d`";
		$on4 = "c.gradeID = d.id";
		
		$tbl5 ="`atif_subject`.`subject` AS `e`";
		$on5 = "c.subjects = e.id";
		
		$select = "c.id AS ProgrammeID,d.dname AS Grade,e.dname AS Subject,e.code AS subjectCode";
		$this->DB->select( $select );
		$this->DB->from( $tbl3 );
		$this->DB->join($tbl4, $on4,'LEFT');
		$this->DB->join($tbl5, $on5,'LEFT');
		
		if($where != NULL ){ $this->DB->where( $where );}
		$query = $this->DB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}
	
		
	}
	
	
	
	public function innerJoin( $tbl1, $tbl2, $on, $select=NULL, $where = NULL,$where_or =''  ){
		$this->DB = $this->load->database("default",TRUE);
		if($select != NULL ){
		$this->DB->select( $select );
		}else{
		$this->DB->select("*");
		}
		$this->DB->from($tbl1);
		$this->DB->join($tbl2, $on);
		
		if($where != NULL ){
		$this->DB->where( $where );
		}
		
		if( $where_or != '' ){
		$this->DB->where( $where_or );
		}
		
		$query = $this->DB->get();
		if( $query->num_rows() > 0 ){
		$results = $query->result_array();
		return $results;
		//return $this->DB->last_query();
		}else{
		return false;
		}	
	}
	
	
		public function leftJoin( $tbl1, $tbl2, $on, $select=NULL, $where = NULL,$where_or =''  ){
		$this->DB = $this->load->database("default",TRUE);
		//$this->DB->distinct();
		if($select != NULL ){
		$this->DB->select( $select );
		}else{
		$this->DB->select("*");
		}
		
		$this->DB->from($tbl1);
		$this->DB->join($tbl2, $on, "LEFT");
		
		
		if($where != NULL ){
		$this->DB->where( $where );
		}
		
		if( $where_or != '' ){
		$this->DB->where( $where_or );
		}
		
		$query = $this->DB->get();
		if( $query->num_rows() > 0 ){
		$results = $query->result_array();
		return $results;
		//return $this->DB->last_query();
		}else{
		return false;
		}	
	}
	
	public function leftJoin2($category, $gradeID, $subjectID, $termID, $sessionID){
		$this->DB = $this->load->database("default",TRUE);
		$SQLQuery ="SELECT
		ass.id, ass.name, ass_selected.gpaid AS gpaid,
		ass_selected.id as ass_created, ass_selected.typeid, ass_selected.grdweightage, ass_selected.program_id, 
		IF(ass.id=ass_selected.typeid and ass_selected.id IS NOT NULL, 1, 
		IF(ass.id=ass_selected.typeid and ass_selected.id IS NULL, 2, 0)) as block
		from atif_assessment.assessment_type as ass
		LEFT JOIN
		(SELECT  group_concat(c.id) AS ID, b.name AS Category_Type, b.id AS TypeID,a.id AS gpaid, a.program_id AS program_id, a.weightage AS grdweightage FROM `atif_assessment`.`gradesubjectass` AS a LEFT JOIN `atif_subject_grade`.`assessment_detail` AS c on ( c.assessment_in_grade_id = a.id )
		LEFT JOIN `atif_assessment`.`assessment_type` AS b ON( b.id = a.assessment_type_id)
		WHERE `a`.`assessment_category_id`= ".$category."
		AND `a`.`grade_id` = ".$gradeID."
		AND `a`.`subject_id` = ".$subjectID."
		AND `a`.`assessment_term_id` = ".$termID."
		AND `a`.`academic_session_id` = ".$sessionID."
		AND `a`.`weightage` > 0
		AND `a`.`record_deleted` = 0
		group by b.name
		order by b.id) as ass_selected on ass_selected.typeid = ass.id  where ass.ass_category_id = ".$category." AND ass.record_deleted = 0";

		$result = $this->DB->query( $SQLQuery );
		$results = $result->result_array();
		return $results;
		//return $this->DB->last_query();
	}
	
	
	public function innerJoinStdMrk($detail_id,$grade_id,$section_id){
		$this->DB = $this->load->database("default",TRUE);
		
		$query = "select cl.id AS student_id, cl.abridged_name AS Name, marks.marks_obtained AS OtainMarks, marks.pending_marks, marks.pendingMarks from atif.class_list cl left join 
	(select student_id, marks_obtained,pending_marks,pendingMarks from atif_subject_marks.assessment_marks where assessment_detail_id='".$detail_id."') as marks on marks.student_id=cl.id
	where cl.grade_id='".$grade_id."' and cl.section_id='".$section_id."' and ( cl.std_status_category = 'Student' or cl.std_status_category = 'Fence' ) order by cl.call_name";
	
		$result = $this->DB->query( $query );
		$results = $result->result_array();
		return $results;
		//return $this->DB->last_query();
	
	}
	
	
	public function allowDate(){
		$this->DB = $this->load->database("default",TRUE);
		
		$sqlQuery = 'SELECT tb.date AS RangeDate FROM atif_attendance.attendance_calendar AS tb WHERE tb.date <= curdate() AND tb.is_on = 1 AND tb.is_holiday = 0 AND tb.is_weekend=0 ORDER BY tb.id DESC limit 200, 1';

		$result = $this->DB->query( $sqlQuery );
		$results = $result->row_array();
		return $results;
		
		
	}
	
public function countNotifications( $programID, $session,$term ){
		$this->DB = $this->load->database("default",TRUE);
	
		$sqlQuery = 'SELECT count( if( c.unread = 1, 1, 1) ) AS Notification FROM atif_assessment.gradesubjectass AS a left join atif_subject_grade.assessment_detail AS b ON(a.id = b.assessment_in_grade_id ) left join atif_subject_marks.assessment_marks AS c ON( b.id = c.assessment_detail_id ) left join atif_assessment.assessment_category AS d ON ( a.`assessment_category_id` = d.id ) WHERE d.status = 1 AND a.program_id = '.$programID.' and a.academic_session_id= '.$session. ' and a.assessment_term_id= '.$term. ' and a.record_deleted =0 and c.unread = 1 and c.pending_marks = 1 and c.record_deleted = 0';
		
		
		
		$result = $this->DB->query( $sqlQuery );
		$results = $result->row_array();
		return $results;
		//return $this->DB->last_query();
	}
	
	
	public function countNotificationsType($programID, $assessmentTypeID){
		$this->DB = $this->load->database("default",TRUE);
		
		$sqlQuery = 'SELECT count( if( c.unread = 1, 1, 1) ) AS Notification FROM `atif_assessment`.`gradesubjectass` AS a left join`atif_subject_grade`.`assessment_detail` AS b ON(a.id = b.assessment_in_grade_id ) left join `atif_subject_marks`.`assessment_marks` AS c ON( b.id = c.assessment_detail_id ) WHERE a.`program_id` = '.$programID.' and c.`assessment_detail_id` = '.$assessmentTypeID.' and a.`record_deleted` =0 and c.unread = 1 and c.pending_marks = 1 and c.record_deleted = 0';
		
		$result = $this->DB->query( $sqlQuery );
		$results = $result->row_array();
		return $results;
		//return $this->DB->last_query();
		
	}

//am.id AS marksID, ,am.marks_obtained AS OM,am.pendingMarks AS PM,cl.abridged_name AS stdName


	public function class_list3($detail_id,$grade_id,$section_id){
		$this->DB = $this->load->database("default",TRUE);
		
		$query = "select cl.id AS stdID, cl.abridged_name AS stdName, marks.id AS marksID, marks.marks_obtained AS OM, marks.pending_marks, marks.pendingMarks AS PM from atif.class_list cl left join 
	(select id,student_id, marks_obtained,pending_marks, pendingMarks from atif_subject_marks.assessment_marks where assessment_detail_id='".$detail_id."') as marks on marks.student_id=cl.id
	where cl.grade_name='".$grade_id."' and cl.section_id='".$section_id."' and ( cl.std_status_category = 'Student' or cl.std_status_category = 'Fence' )  order by cl.call_name";
	
		$result = $this->DB->query( $query );
		$results = $result->result_array();
		return $results;
		//return $this->DB->last_query();
	}

	public function getblockID($ac,$tr, $grd,$sub, $grpID){
		$this->DB = $this->load->database("default",TRUE);
		
		$query = "select ID from atif_subject.subjectblock where acadmic=".$ac." AND term=".$tr." AND grade=".$grd." AND subject=".$sub." AND SUBSTRING_INDEX(SUBSTRING_INDEX(`key`, '_', 8), '_', -1) = ".$grpID."";
		$result = $this->DB->query( $query );
		$results = $result->row_array();
		return $results;
	}
	
	
		public function programmeAsesmntLt(){
		
		$this->DB = $this->load->database("default",TRUE);
		
		$query = "SELECT
grade_name, subject_name, assessment_type_id, assessment_name,
assessment_weightage, full_name, program_id, sessionid, gradeid subjects, optional,
this_order, name_order
from

(select
gg.dname as grade_name, subject.dname as subject_name,
ass_detail.id as assessment_type_id,
IFNULL(ass_detail.title,'') as assessment_name, IFNULL(ass_detail.max_marks,'') as assessment_weightage,
IFNULL(concat(ass_detail.title, ' (', ass_detail.max_marks, ')'),'') as full_name,
program.id as program_id, program.sessionid, program.gradeid, program.subjects, program.optional,
'1' as this_order, assessment_type.name as name_order

from atif_subject.programmesetup as program

left join atif_subject.subject as subject
		on subject.id = program.subjects
left join atif._grade as gg 
		on gg.id = program.gradeid
left join atif_assessment.assessment_category_grade as ass_grade
		on ass_grade.grade_id = program.gradeid
left join (select * from atif_assessment.gradesubjectass where weightage > 0) as sbjweight
		on (sbjweight.program_id = program.id 
			and sbjweight.academic_session_id = program.sessionid
			and sbjweight.assessment_category_id = ass_grade.assessment_category_id
		  )
left join atif_assessment.assessment_type as assessment_type
		on assessment_type.id = sbjweight.assessment_type_id
left join atif._academic_session as acasession
		on acasession.id = program.sessionid
left join atif_subject_grade.assessment_detail as ass_detail
		on ass_detail.assessment_in_grade_id = sbjweight.id

where gg.dname = 'X'
and subject.dname = 'Physics'
and sbjweight.assessment_term_id = 1
and ass_grade.assessment_category_id = 1
and acasession.is_active = 1




UNION




select

gg.dname as grade_name, subject.dname as subject_name,
sbjweight.id as assessment_type_id,
assessment_type.name as assessment_name, sbjweight.weightage as assessment_weightage,
concat(assessment_type.name, ' (', sbjweight.weightage, ')') as full_name,
program.id as program_id, program.sessionid, program.gradeid, program.subjects, program.optional,
'2' as this_order, assessment_type.name as name_order



from atif_subject.programmesetup as program

left join atif_subject.subject as subject
		on subject.id = program.subjects
left join atif._grade as gg 
		on gg.id = program.gradeid
left join atif_assessment.assessment_category_grade as ass_grade
		on ass_grade.grade_id = program.gradeid
left join (select * from atif_assessment.gradesubjectass where weightage > 0) as sbjweight
		on (sbjweight.program_id = program.id 
			and sbjweight.academic_session_id = program.sessionid
			and sbjweight.assessment_category_id = ass_grade.assessment_category_id
		  )
left join atif_assessment.assessment_type as assessment_type
		on assessment_type.id = sbjweight.assessment_type_id
left join atif._academic_session as acasession
		on acasession.id = program.sessionid



where gg.dname = 'X'
and subject.dname = 'Physics'
and sbjweight.assessment_term_id = 1
and ass_grade.assessment_category_id = 1
and acasession.is_active = 1





/**************************************************
*************************** assessment_category_id
** 1 -> Formative
** 2 -> Summative
*************************** assessment_term_id
** 1 -> First Term
** 2 -> Second Term
***************************************************/
) as assessment_data


where assessment_type_id is not null

order by
name_order, this_order, full_name;";
		
		$result = $this->DB->query( $query );
		//$results = $result->row_result();
		$results = $result->row_array();
		return $results;
		
	}
	
	
		// For Notifications Process
	public function getTchrDetailID($AssGrade_id){
		$this->DB = $this->load->database("default",TRUE);
		$query = "SELECT a.id AS Ids FROM atif_subject_grade.assessment_detail AS a LEFT JOIN atif_role_matrix.role_subject_teacher AS b ON ( b.id = a.`role_id` AND b.staff_id = a.register_by ) WHERE a.`assessment_in_grade_id` = ".$AssGrade_id." AND b.`staff_id` != 'NULL' AND a.record_deleted=0";
		$result = $this->DB->query( $query );
		$results = $result->result_array();
		return $results;
		
	}
	
	// For Notifications Process
	public function getTchrDetailID2($AssGrade_id){
		$this->DB = $this->load->database("default",TRUE);
		$query = "SELECT a.id AS ID, a.date AS dt, a.title AS Title, a.created AS crtdDate, a.register_by AS teacher_id, a.role_id AS role_id, a.is_active AS active FROM atif_subject_grade.assessment_detail AS a LEFT JOIN atif_role_matrix.role_subject_teacher AS b ON ( b.id = a.`role_id` AND b.staff_id = a.register_by ) WHERE a.`assessment_in_grade_id` = ".$AssGrade_id." AND b.`staff_id` != 'NULL' AND a.record_deleted=0";
		$result = $this->DB->query( $query );
		$results = $result->result_array();
		return $results;
		
	}
	// For Notification Process
	public function countGrdSctonStd($grade,$section){
		$this->DB = $this->load->database("default",TRUE);
		
		$query = "select count(*) as sectionStudent from class_list 
		where grade_name='".$grade."' and section_id='".$section."' and ( cl.std_status_category = 'Student' or cl.std_status_category = 'Fence' ) order by call_name";
	
		$result = $this->DB->query( $query );
		$results = $result->row_array();
		return $results;
		//return $this->DB->last_query();
	}
	
}// mean class assessment category	
