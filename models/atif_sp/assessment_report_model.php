<?php
class Assessment_report_model extends CI_Model{

	private $db_AssReport;

	function __construct()
	{
		parent::__construct();
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
	}


	protected $_table_name = 'hello';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'time_in desc';	
	protected $_timestamps = TRUE;






	/************************************************************ Term Final Marks 
	******************************************************************************/
	public function get_complete_marks_of($GradeID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_Term_Marks_1617`($GradeID, $TermID)";
		
		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	public function get_complete_marks_of_ACD($AcademicYear=null, $GradeID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_Term_Marks_1617`($GradeID, $TermID)";
		if(!is_null($AcademicYear)){
			$query = "CALL atif_sp.`Complete_Assessment_Report_Term_Marks_".$AcademicYear."`($GradeID, $TermID)";
		}

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	/*****************************************************************************/







	/************************************************************ Term Final Marks 
	******************************************************************************/
	public function get_complete_marks_of_Science($AcademicSessionID, $TermID, $GradeID, $AcademicYear=null){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "select * from atif_sp.std_term_marks_total".$AcademicYear." as s where s.academic_session_id = $AcademicSessionID and s.term = $TermID and s.grade_id = $GradeID";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	/*****************************************************************************/

	





	/************************************** Grade Section Students' Subject Marks
	******************************************************************************/
	public function get_grade_subject_assessments($GradeID, $SubjectID, $RoleID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Get_Assessment_Detail_in_Grade_Active_ID`($GradeID, $SubjectID, $RoleID, $TermID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}


	public function get_students_grade_section($GradeID, $SectionID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Get_ClassList_of_GradeSection_ID_1718_1`($GradeID, $SectionID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}

	public function get_students_grade_section_SessionTerm($GradeID, $SectionID, $SessionTerm){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Get_ClassList_of_GradeSection_ID".$SessionTerm."`($GradeID, $SectionID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}


	public function get_grade_subject_assessments_marks($GradeID, $SectionID, $SubjectID, $RoleID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Assessment_Detail_ComMarks_in_Grade_ID`($GradeID, $SectionID, $SubjectID, $RoleID, $TermID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}


	public function get_grade_subject_assessments_aggMarks($GradeID, $SectionID, $SubjectID, $RoleID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Assessment_Detail_AggMarks_in_Grade_ID`($GradeID, $SectionID, $SubjectID, $RoleID, $TermID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	/******************************************************************************/







	/************************************* Grade Optional Students' Subject Marks
	******************************************************************************/
	public function get_students_grade_optional_group_block($GradeID, $SubjectID, $GroupID, $BlockID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Get_ClassList_of_GradeOptional_GroupBlock_ID`($GradeID, $SubjectID, $GroupID, $BlockID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}

	public function get_grade_subject_optional_assessments_marks($GradeID, $SubjectID, $GroupID, $BlockID, $RoleID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Assessment_Detail_OptMarks_in_Grade_ID`($GradeID, $SubjectID, $GroupID, $BlockID, $RoleID, $TermID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}


	public function get_grade_subject_optional_assessments_aggMarks($GradeID, $SubjectID, $GroupID, $BlockID, $RoleID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Assessment_Detail_OptAggMarks_in_Grade_ID`($GradeID, $SubjectID, $GroupID, $BlockID, $RoleID, $TermID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	/******************************************************************************/












	/************************************************************* Unit Assessment
	/******************************************************************************/
	public function get_unit_assessment_subjects($GradeID, $SectionID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Get_Formative_Unit_Marks_Subjects`($GradeID, $SectionID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	public function Get_Formative_Unit_Marks_CurrentGS($GradeID, $SectionID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Get_Formative_Unit_Marks_CurrentGS`($GradeID, $SectionID, $TermID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}

	public function get_unit_assessment_subjects_SessionTerm($GradeID, $SectionID, $SessionTerm){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Get_Formative_Unit_Marks_Subjects".$SessionTerm."`($GradeID, $SectionID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	public function Get_Formative_Unit_Marks_CurrentGS_SessionTerm($GradeID, $SectionID, $TermID, $SessionTerm){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Get_Formative_Unit_Marks_CurrentGS".$SessionTerm."`($GradeID, $SectionID, $TermID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	/******************************************************************************/








	/************************************ Count - Num Greater than in single array
	/******************************************************************************/
	public function getCountOf($NumArray, $Num){
		$numCount = sizeof($NumArray);
		$result = 0;

		for($i=0; $i<$numCount; $i++){
			if($NumArray[$i] > 0 && $NumArray[$i] >= $Num){
				$result++;
			}			
		}

		return $result;
	}
	public function getCountOf_Above($NumArray, $Num){
		$numCount = sizeof($NumArray);
		$result = 0;

		for($i=0; $i<$numCount; $i++){
			if($NumArray[$i] >= $Num){
				$result++;
			}			
		}

		return $result;
	}
	/******************************************************************************/




	/************************************* Count - Num Lesser than in single array
	/******************************************************************************/
	public function getCountOf_Less($NumArray, $Num){
		$numCount = sizeof($NumArray);
		$result = 0;

		for($i=0; $i<$numCount; $i++){
			if($NumArray[$i] > 0 && $NumArray[$i] < $Num){
				$result++;
			}			
		}

		return $result;
	}
	/******************************************************************************/




	/******************************************** Count - Num Lesser than in array
	/******************************************************************************/
	public function getCountOf_LessOnly($NumArray, $Num){
		$numCount = sizeof($NumArray);
		$result = 0;

		for($i=0; $i<$numCount; $i++){
			if($NumArray[$i] < $Num){
				$result++;
			}			
		}

		return $result;
	}
	public function getCountOf_LessOnly_2d($NumArray, $Num){
		$numCount = sizeof($NumArray);
		$result = 0;

		foreach ($NumArray as $val) {
			if($val < $Num){
				$result++;
			}
		}
		

		return $result;
	}
	/******************************************************************************/






	/****************************************** Count - Num Greater than in array
	/******************************************************************************/
	public function getCountOf_GreaterOnly($NumArray, $Num){
		$numCount = sizeof($NumArray);
		$result = 0;

		for($i=0; $i<$numCount; $i++){
			if($NumArray[$i] >= $Num){
				$result++;
			}			
		}

		return $result;
	}
	public function getCountOf_GreaterOnly_2d($NumArray, $Num){
		$numCount = sizeof($NumArray);
		$result = 0;

		foreach ($NumArray as $val) {
			if($val >= $Num){
				$result++;
			}
		}
		

		return $result;
	}
	public function getCountOf_GreaterOnly_2d_Between($NumArray, $NumBig, $NumLes){
		$numCount = sizeof($NumArray);
		$result = 0;

		foreach ($NumArray as $val) {
			if($NumBig >= $val && $NumLes <= $val){
				$result++;
			}
		}
		

		return $result;
	}
	/******************************************************************************/











	/************************************************** Count - Grade Equal to ...
	/******************************************************************************/
	public function CountThisGradeIn($GradeArray, $thisGrade){
		$numCount = sizeof($GradeArray);
		$result = 0;

		for($i=0; $i<$numCount; $i++){
			if($GradeArray[$i] == $thisGrade){
				$result++;
			}			
		}

		return $result;
	}
	public function CountThisGradeIn_2d($GradeArray, $thisGrade){
		$numCount = sizeof($GradeArray);
		$result = 0;

		foreach ($GradeArray as $val) {
			if($val == $thisGrade){
				$result++;
			}
		}
		

		return $result;
	}
	/******************************************************************************/
		
















	/******************************************* Assessment Marks -- Student Wise
	/******************************************************************************/
	public function Get_Formative_Unit_Marks_GSID($GSID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Get_Formative_Unit_Marks_GSID`('$GSID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}

	public function Get_Formative_Unit_Marks_GSID_Subjects($GradeID, $SectionID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Get_Formative_Unit_Marks_GSID_Subjects`($GradeID, $SectionID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	/******************************************************************************/










	/********************************************* Assessment Marks -- Term Report
	/******************************************************************************/
	public function Complete_Assessment_Report_GS_Subjects($GradeID, $SectionID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_Subjects`('$GradeID', '$SectionID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	public function Complete_Assessment_Report_GS_lvl_3($GradeID, $SectionID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_lvl_3`('$GradeID', '$SectionID', '$TermID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	public function Complete_Assessment_Report_GS_lvl_4($GradeID, $SectionID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_lvl_4`('$GradeID', '$SectionID', '$TermID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	public function Complete_Assessment_Report_GS_lvl_ASP($GradeID, $SectionID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_lvl_ASP`('$GradeID', '$SectionID', '$TermID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}







	public function Complete_Assessment_Report_GS_Subjects_SessionTerm($GradeID, $SectionID, $SessionTerm){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_Subjects".$SessionTerm."`('$GradeID', '$SectionID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	public function Complete_Assessment_Report_GS_lvl_3_SessionTerm($GradeID, $SectionID, $TermID, $SessionTerm){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_lvl_3".$SessionTerm."`('$GradeID', '$SectionID', '$TermID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	public function Complete_Assessment_Report_GS_lvl_4_SessionTerm($GradeID, $SectionID, $TermID, $SessionTerm){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_lvl_4".$SessionTerm."`('$GradeID', '$SectionID', '$TermID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	public function Complete_Assessment_Report_GS_lvl_ASP_SessionTerm($GradeID, $SectionID, $TermID, $SessionTerm){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_lvl_ASP".$SessionTerm."`('$GradeID', '$SectionID', '$TermID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}









	public function Complete_Assessment_Report_GS_Subjects_Science($GradeID, $SectionID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_Subjects_Science`('$GradeID', '$SectionID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	public function Complete_Assessment_Report_GS_Subjects_Split($GradeID, $SectionID, $AcademicYear=null){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_Subjects_Split".$AcademicYear."`('$GradeID', '$SectionID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	public function Complete_Assessment_Report_GS_lvl_3_Science($GradeID, $SectionID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_lvl_3_Science`('$GradeID', '$SectionID', '$TermID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	public function Complete_Assessment_Report_GS_lvl_4_Science($GradeID, $SectionID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_lvl_4_Science`('$GradeID', '$SectionID', '$TermID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}



	public function Complete_Assessment_Report_GS_Subjects_Science_SessionTerm($GradeID, $SectionID, $SessionTerm){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_Subjects_Science".$SessionTerm."`('$GradeID', '$SectionID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	public function Complete_Assessment_Report_GS_Subjects_Split_SessionTerm($GradeID, $SectionID, $SessionTerm){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_Subjects_Split".$SessionTerm."`('$GradeID', '$SectionID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	public function Complete_Assessment_Report_GS_lvl_3_Science_SessionTerm($GradeID, $SectionID, $TermID, $SessionTerm){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_lvl_3_Science".$SessionTerm."`('$GradeID', '$SectionID', '$TermID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	public function Complete_Assessment_Report_GS_lvl_4_Science_SessionTerm($GradeID, $SectionID, $TermID, $SessionTerm){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_lvl_4_Science".$SessionTerm."`('$GradeID', '$SectionID', '$TermID')";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	/******************************************************************************/
	




















	/***************************************************** Marks Ranking Function
	/******************************************************************************/
	public function getRankOf($NumArray, $Num){
		$max = max($NumArray);
		$numCount = sizeof($NumArray);
		$result = 1;
		rsort($NumArray);

		for($i=0; $i<$numCount; $i++){
			if($Num==$NumArray[$i]){
				break;
			}
			$result++;
		}

		return $result;
	}
	/******************************************************************************/






	/**************************************************** Random Background Color
	/******************************************************************************/
	public function getBGColor($Num){
		$Color[1] = '#FFF8DC';
		$Color[2] = '#FBEC5D';
		$Color[3] = '#FBCCE7';
		$Color[4] = '#E5E4E2';
		$Color[5] = '#FFDB58';
		$Color[6] = '#B2EC5D';
		$Color[7] = '#ACE1AF';
		$Color[8] = '#EDC9AF';
		$Color[9] = '#9BDDFF';
		$Color[10] = '#F7E98E';

		$Color[11] = '#66FFFF';
		$Color[12] = '#FFFF99';
		$Color[13] = '#CCCCFF';
		$Color[14] = '#FF9999';
		$Color[15] = '#BBFFFF';
		$Color[16] = '#FFCC33';
		$Color[17] = '#FFC1C1';
		$Color[18] = '#CCFF66';
		$Color[19] = '#B4EEB4';
		$Color[20] = '#FFD39B';

		$Color[21] = '#C1FFC1';
		$Color[22] = '#FFFF66';
		$Color[23] = '#EEE685';
		$Color[24] = '#CAE1FF';
		$Color[25] = '#B0E0E6';
		$Color[26] = '#DDA0DD';
		$Color[27] = '#EED2EE';
		$Color[28] = '#FF82AB';
		$Color[29] = '#FFC125';
		$Color[30] = '#EED5B7';

		$Color[31] = '#FFFFFF';
		$Color[32] = '#FFFFFF';
		$Color[33] = '#FFFFFF';
		$Color[34] = '#FFFFFF';
		$Color[35] = '#FFFFFF';
		$Color[36] = '#FFFFFF';
		$Color[37] = '#FFFFFF';
		$Color[38] = '#FFFFFF';
		$Color[39] = '#FFFFFF';
		$Color[40] = '#FFFFFF';

		$Color[41] = '#FFFFFF';
		$Color[42] = '#FFFFFF';
		$Color[43] = '#FFFFFF';
		$Color[44] = '#FFFFFF';
		$Color[45] = '#FFFFFF';
		$Color[46] = '#FFFFFF';
		$Color[47] = '#FFFFFF';
		$Color[48] = '#FFFFFF';
		$Color[49] = '#FFFFFF';
		$Color[50] = '#FFFFFF';

		return $Color[$Num];
	}
	/******************************************************************************/










	


	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_AssReport->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_AssReport->where('record_deleted', 0);
		if(!count($this->db_AssReport->ar_orderby)){
			$this->db_AssReport->order_by($this->_order_by);
		}
		return $this->db_AssReport->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_AssReport->where($where);
		return $this->get(NULL, $single);
	}

	public function save($data, $id = NULL){

		// Set timestamps
		if($this->_timestamps == TRUE){
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = human_to_unix($now);
			$id || $data['register_by'] = (int)$this->session->userdata['user_id'];
			$data['modified'] = human_to_unix($now);
			$data['modified_by'] = (int)$this->session->userdata['user_id'];
		}

		// Insert a new record
		if ($id === NULL){
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db_AssReport->set($data);
			$this->db_AssReport->insert($this->_table_name);
			$id = $this->db_AssReport->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_AssReport->set($data);
			$this->db_AssReport->where($this->_primary_key, $id);
			$this->db_AssReport->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_AssReport->where($this->_primary_key, $id);
		$this->db_AssReport->limit(1);
		$this->db_AssReport->delete($this->_table_name);
	}
	
	
	
	
		/*
		* Get Grade Subject Summative Assessment 
		* Which were created by admin
	*/
	
	public function getSummativeAss($GradeID, $SubjectID, $RoleID,$TermID,$category,$academic){
		
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		
		$query = "CALL atif_sp.`get_Detail`($GradeID, $SubjectID, $RoleID, $category,$academic,$TermID)"; // 1 for category id, 8 for academic, 1 for term

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	
	
	public function getGrdSbjctAssmntMarks( $GradeID, $SectionID, $SubjectID, $RoleID, $TermID,$Academic, $mainCategory ){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`GrdSbjctAssmntMarks`( $GradeID, $SectionID, $SubjectID, $RoleID, $TermID,$Academic, $mainCategory )";
		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}

	
		public function grdSbjctAssmntAggMarks( $GradeID, $SectionID, $SubjectID, $RoleID, $TermID ){
			$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`grdSbjctAssmntAggMarks`($GradeID, $SectionID, $SubjectID, $RoleID, $TermID)";
		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	
	
	
		/* Start*/
	
	public function grdSbjtOptAssMarks($GradeID, $SubjectID, $GroupID, $BlockID, $RoleID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		
		$query = "CALL atif_sp.`AssessmentDetailOptMarksInGradeID`($GradeID, $SubjectID, $GroupID, $BlockID, $RoleID, $TermID)";
		
		
		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	/* End */
	
	
		/*Start*/
	public function grdSbjtOptAssAggMarks($GradeID, $SubjectID, $GroupID, $BlockID, $RoleID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`AssessmentDetailOptAggMarksInGradeID`($GradeID, $SubjectID, $GroupID, $BlockID, $RoleID, $TermID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}
	/*End*/

	//Summative And Formative Report

	public function get_summative_assessment_titles($GradeID, $SubjectID, $RoleID, $TermID){

		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`summative_report`($GradeID, $SubjectID, $RoleID, $TermID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();

	}

	//Summative And Formative Report Term 1

	public function get_summative_assessment_titles_term_1($GradeID, $SubjectID, $RoleID, $TermID){

		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`summative_report_term_1`($GradeID, $SubjectID, $RoleID, $TermID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();

	}

	// Compulsory Formative And Summative Marks

	public function get_grade_ComFormSumm_assessments_marks($GradeID, $SectionID, $SubjectID, $RoleID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Assessment_Detail_ComFormSumm_in_Grade_ID`($GradeID, $SectionID, $SubjectID, $RoleID, $TermID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}

	//Optional Formative And Summative Marks

	public function get_grade_subject_optionalFormSumm_assessments_marks($GradeID, $SubjectID, $GroupID, $BlockID, $RoleID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Assessment_Detail_OptFromSumm_in_Grade_ID`($GradeID, $SubjectID, $GroupID, $BlockID, $RoleID, $TermID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}

	// Aggeriagate Compulsory Marks In Formative And Summative

	public function get_grade_subject_assessmentsFormSumm_aggMarks($GradeID, $SectionID, $SubjectID, $RoleID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Assessment_Detail_FormSummAggMarks_in_Grade_ID`($GradeID, $SectionID, $SubjectID, $RoleID, $TermID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}

	// Aggeriagate Optional Marks In Formative Amd Summative

	public function get_grade_subject_optionalFormSumm_assessments_aggMarks($GradeID, $SubjectID, $GroupID, $BlockID, $RoleID, $TermID){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Assessment_Detail_FormSummOptAggMarks_in_Grade_ID`($GradeID, $SubjectID, $GroupID, $BlockID, $RoleID, $TermID)";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}


	//GET GRADE FUNCTION

	public function get_grade($academic,$program){
		$query="SELECT g.name,weightage FROM atif_subject.program_grading pg 

				inner join atif_subject._grading g on 

				g.id = pg.grading_id

				where pg.program_id = ".$program." and 

				pg.academic_session_id = ".$academic;
		
		$sql = $this->db->query($query);
		
		return $sql->result(); 
	}



	public function get_Grade_Overall_grading($GradeID, $AcademicYear = null){
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "select * from atif_subject.overall_grading_view".$AcademicYear." where grade_id = $GradeID";

		$sql = $this->db_AssReport->query($query);
		return $sql->result();
	}

	public function get_class_teacher($academic,$role_id){
		$query = "select rst.id,sr.name from atif_role_matrix.role_subject_teacher rst
				inner join atif.staff_registered sr on sr.id = rst.staff_id
				where rst.id = ".$role_id. " and rst.academic_session_id = ".$academic;
		$sql = $this->db->query($query);
		return $sql->result();
	}

		public function get_unit_assessment_weightage($grade_id,$term_id,$academic){
		$query = "select *,'%' as percent,'G' as grade from atif_assessment.gradesubjectass gs 
				where assessment_type_id = 74   and gs.grade_id = ".$grade_id."  and assessment_term_id = ".$term_id." and academic_session_id = ".$academic." and weightage >0";
		$sql = $this->db->query($query);
		return $sql->result();
	}

		public function getSubectTeacherName($role_id){
		$query = "SELECT sr.abridged_name as name FROM atif_role_matrix.role_subject_teacher rst
					left join atif.staff_registered sr on sr.id = rst.staff_id
					where rst.id = '".$role_id."'";
		$sql = $this->db->query($query);
		return $sql->result();	
	}
}