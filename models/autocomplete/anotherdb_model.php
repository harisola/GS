<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Anotherdb_model extends CI_Model
{
  private $another;
  private $dbRole;
  function __construct(){ 
	parent::__construct(); 
  }

public function getSomething(){
	$this->another = $this->load->database('default',TRUE);
    $this->another->select('*');
    $q = $this->another->get('_grade');
    if($q->num_rows()>0){
      return $q->result();
    }else{
      return FALSE;
    }
}
  
  
  public function getGrade( $select = NULL, $where=NULL )
  {
	$this->another = $this->load->database('default',TRUE);
	if( $select != NULL ){ 
		$this->another->select( $select );
	}else{
		$this->another->select('*');
	}
    
	$this->another->from('_grade');
	if( $where != NULL ){
		$this->another->where( $where );
	}
	$q = $this->another->get();
	if($q->num_rows()>0)
    {
      return $q->result();
    }
    else
    {
      return FALSE;
    }
  }
  
  
  
  public function getAllSections(){
	$this->another = $this->load->database('default',TRUE);
	$this->another->select("id,name");
	$this->another->from("_section");
	$this->another->order_by('name'); 
	$query = $this->another->get(); 
	return $query->result();
  }
  
  
  
	public function get_grade_subject2($where_subject){
		
		$this->dbRole = $this->load->database('role',TRUE);
		$this->dbRole->select('ass.name,ass.id');
		$this->dbRole->from('academic_subject as ass');
		$this->dbRole->join('academic_program as ap','ap.subject_id = ass.id');
		$this->dbRole->where($where_subject);
		$query = $this->dbRole->get();
		return $query->result();	
		
	}
	
		
	public function getAssmnt(){
		
	$query = "SELECT 
					gd.`id` AS `gradeID`,
					gd.`dname` AS `Grade`,
					sb.`id` AS `subjectID`,
					sb.`name` AS `Subject`,
					ac.`id` AS `catID`,
					ac.`name` AS `Category`,
					t.`id` AS `ctTypeID`,
					t.`name` AS `CategoryType`,
					ss.`id` AS `asID`,
					ss.`name` AS `AcademicSession`,
					trm.`id` AS `trmID`,
					trm.`name` AS `Term`,
					gs.`id` AS `assID`,
					gs.`weightage` AS `AssWeightage`
					
				FROM atif.`_grade` AS gd
				JOIN atif_assessment.`gradesubjectass` AS gs ON ( gd.`id` = gs.`grade_id` )
				JOIN atif_role.`academic_subject` AS sb ON ( gs.`subject_id` = sb.`id` )
				JOIN atif_assessment.`assessment_category` AS ac ON ( gs.`assessment_category_id` = ac.`id`)
				JOIN atif_assessment.`assessment_type` AS t ON (gs.`assessment_type_id` = t.`id` )
				JOIN atif_assessment.`assessment_academic` AS ss ON (gs.`academic_session_id` = ss.`id`)
				JOIN atif_assessment.`assessment_term` AS trm ON (gs.`assessment_term_id` = trm.`id`)
				WHERE gs.`academic_session_id` = 2 ORDER BY gs.`id` DESC LIMIT 300";
				
		$query=$this->db->query($query); 
		$row = $query->result();	
		return $row;
		
	}
	
	
	
	public function getGradeSection($gradeID){
		
		//$this->load->database();
		
		$sqlQuery = "SELECT distinct a.`section_id`, b.id,b.dname FROM `atif_role`.`role_in_org_view` AS a JOIN `atif`.`_section` as b ON (a.section_id = b.id) WHERE a.`grade_id` = $gradeID";
		
		$query=$this->db->query($sqlQuery); 
		$results = $query->result_array();	
		return $results;
	}
	
}


