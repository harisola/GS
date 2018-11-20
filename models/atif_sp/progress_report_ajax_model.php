<?php
class Progress_report_ajax_model extends CI_Model{

	private $db_AssReport;

	public  function __construct()
	{
		parent::__construct();
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
	}

	/************************************************************ Formative Summative
	******************************************************************************/
	public function get_formative_summative($GSID, $TermID){
		
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL `Complete_Assessment_Report_GS_lvl_3_GSID`('".$GSID."',$TermID)";
		$sql = $this->db_AssReport->query($query);
		// print_r($sql->result());
		return $sql->result();

	}
	/*****************************************************************************/


	/*****************Term Marks ********************************/
	public function get_term_marks($GSID,$TermID){
	
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_lvl_4_GSID`('".$GSID."',$TermID)";
		$sql = $this->db_AssReport->query($query);
		// print_r($sql->result());
		return $sql->result();

	}

	
		public function get_term_asp($Grade,$Section,$TermID){
	
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_LVL_ASP`($Grade,$Section,$TermID)";
		$sql = $this->db_AssReport->query($query);
		// print_r($sql->result());
		return $sql->result();

	}


		/************************************************************ Formative Summative
	******************************************************************************/
	public function get_formative_summative_term_two($GSID, $TermID){
		
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL `Complete_Assessment_Report_GS_lvl_3_GSID`('".$GSID."',$TermID)";
		$sql = $this->db_AssReport->query($query);
		// print_r($sql->result());
		return $sql->result();

	}
	/*****************************************************************************/


	/*****************Term Marks ********************************/
	public function get_term_marks_term_two($GSID,$TermID){
	
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_lvl_4_GSID`('".$GSID."',$TermID)";
		$sql = $this->db_AssReport->query($query);
		// print_r($sql->result());
		return $sql->result();

	}

	
		public function get_term_asp_term_two($Grade,$Section,$TermID){
	
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_LVL_ASP`($Grade,$Section,$TermID)";
		$sql = $this->db_AssReport->query($query);
		// print_r($sql->result());
		return $sql->result();

	}


	public function get_grading($grade_id){

		$query = "select og.weightage,g.name from atif_subject.overall_grading  og

				  	left join atif_subject._grading g on g.id = og.grading_id

					where og.grade_id = ".$grade_id;

		$sql = $this->db->query($query);
		return $sql->result();

	}

	//========================== SCIENCE SUMMATIVE AND FORMATIVE==================//
	//============================================================================//
	public function get_formative_summative_science($GSID,$TermID){

		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL `Complete_Assessment_Report_GS_lvl_3_Science_GSID`('".$GSID."',$TermID)";
		$sql = $this->db_AssReport->query($query);
		// print_r($sql->result());
		return $sql->result();

	}

	//=================================SCIENCE TERM MARKS ========================//
	//===========================================================================//

		public function get_term_marks_science($GSID,$TermID){
	
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_lvl_4_Science_GSID`('".$GSID."',$TermID)";
		$sql = $this->db_AssReport->query($query);
		// print_r($sql->result());
		return $sql->result();

	}


	//========================== SCIENCE SUMMATIVE AND FORMATIVE==================//
	//============================================================================//
	public function get_formative_summative_science_term_two($GSID,$TermID){

		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL `Complete_Assessment_Report_GS_lvl_3_Science_GSID`('".$GSID."',$TermID)";
		$sql = $this->db_AssReport->query($query);
		// print_r($sql->result());
		return $sql->result();

	}

	//=================================SCIENCE TERM MARKS ========================//
	//===========================================================================//

		public function get_term_marks_science_term_two($GSID,$TermID){
	
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_sp.`Complete_Assessment_Report_GS_lvl_4_Science_GSID`('".$GSID."',$TermID)";
		$sql = $this->db_AssReport->query($query);
		// print_r($sql->result());
		return $sql->result();

	}
}