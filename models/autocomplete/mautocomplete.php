<?php
class Mautocomplete extends CI_Model{
    
	private $ADB;
	private $SDB;
	function __construct() {
		parent::__construct();
		
	}
		
	public function createCategory( $tableName, $data ){
		$this->ADB = $this->load->database('assessment',true);
		$sucess = $this->ADB->insert( $tableName, $data );
		$ID = $this->ADB->insert_id();
		if($sucess)
				return $ID;
			else
				return FALSE;
	}
	
	public function getdta(){
		$this->ADB = $this->load->database('assessment',true);
		$this->ADB->select('*');
		$this->ADB->from('assessment_category');
		$this->ADB->where('status', 1);
		$query = $this->ADB->get();
		return $query->result();
		
	}
	
	public function getAll($table,$columns ,$where = NULL ){
		$this->ADB = $this->load->database('assessment',true);
		
		$this->ADB->select($columns);
		$this->ADB->from($table);
		if( $where != NULL ){
			$this->ADB->where( $where );
		}
		$query = $this->ADB->get();
		return $query->result();
		
	}
	
	public function getRow($table,$columns=NULL,$where=NULL  ){
	$this->ADB = $this->load->database('assessment',true);
		$this->ADB->select($columns);
		$this->ADB->from($table);
		if( $where != NULL ){
			$this->ADB->where( $where );
		}
		$query = $this->ADB->get();
		return $query->row();
		
	}
	
	public function updateTable($tablename, $data, $where ){
		$this->ADB = $this->load->database('assessment',true);
		$this->ADB->where($where);
		$this->ADB->update($tablename, $data ); 
		$afftectedRows = $this->ADB->affected_rows();
		return $afftectedRows;
	}
	
	/*
		============================================================
			Join main category with its sub category
			Like Formative Quiz, Formative Pratical
		============================================================
	*/
		public function joinCategories( $where = NULL ){
			$this->ADB = $this->load->database('assessment',true);
			
			$this->ADB->select('assessment_category.name as mcat, assessment_type.*');
			$this->ADB->from('assessment_category');
			$this->ADB->join('assessment_type', 'assessment_type.ass_category_id = assessment_category.id', 'inner'); 
			if( $where != NULL ){
				$this->ADB->where( $where );
			}
			$query = $this->ADB->get();
			return $query->result();
			
		}
		
		
		public function joinCategorie2(){
			$this->ADB = $this->load->database('assessment',true);
			
		$sqlQuery = "SELECT ass_type.id as ass_type_id, ass_cat.name as cat_name, ass_type.name, if(ass_type.id = ass_sub.assessment_type_id, 1, 0) as block FROM atif_assessment.assessment_type as ass_type left join atif_assessment.gradesubjectass as ass_sub on ass_sub.assessment_type_id = ass_type.id left join (select * from atif_assessment.assessment_category where status=1) as ass_cat on ass_cat.id = ass_category_id 
		where ass_type.record_deleted = 0 group by ass_type_id";
			
			$result = $this->ADB->query( $sqlQuery );
			$results = $result->result_array();
			return $results;
		
		}
		
		
		
		public function countSum(){
			$this->ADB = $this->load->database('assessment',true);
			$this->ADB->select_sum('weightage');
			$this->ADB->from('assessment_category');
			$this->ADB->where("status",1);
			$query=$this->ADB->get();
			$return = $query->row()->weightage;
			return $return;
		}
	/*
		===================     End      ===========================
	*/
	
	public function joinAssTypeAssessment( $where = NULL ){
		$this->ADB = $this->load->database('assessment',true);
		$this->ADB->select('ast.id as astID, ast.name as astname, grds.weightage as grdweightage');
		$this->ADB->from('assessment_type as ast');
		$this->ADB->join('gradesubjectass as grds', 'ast.id = grds.assessment_type_id', 'inner'); 
		if( $where != NULL ){
				$this->ADB->where( $where );
			}
			$query = $this->ADB->get();
			return $query->result_array();
			
	}
	
	
	public function deleteData( $table, $where ){
		$this->ADB = $this->load->database('assessment',true);
		$this->ADB->where( $where );
		$this->ADB->delete($table); 
	}
	
	/*
		=============================================================
			Function for count weightage according to main category
			weightage wise if there is wieghtage space/
			For insertation
		=============================================================
	*/
	public function countWeightageCat($categoryID, $currentWeightage ){
		$this->ADB = $this->load->database('assessment',true);
		//SELECT sum(`weightage`) as `Total` FROM `assessment_type` WHERE `ass_category_id`=58 GROUP BY ass_category_id HAVING Total <= 100 
		//$this->ADB->select_sum('weightage', 'Total');$this->ADB->from('assessment_type');$this->ADB->where( 'ass_category_id' , $categoryID );$this->ADB->group_by("ass_category_id"); $this->ADB->having("Total <= ", 100 );$query = $this->ADB->get();$result = $query->row();return $result;
		$this->ADB->select_sum('weightage', 'Total');
		$this->ADB->from('assessment_type');
		$this->ADB->where( 'ass_category_id' , $categoryID );
		$query = $this->ADB->get();
		$result = $query->row();
		
		 if( $result->Total != NULL ){
			 
			$totalSum   = ( $result->Total + $currentWeightage );
			$totalSum2  = ( $totalSum - 100 );
			$adjustTotal = ( $currentWeightage - $totalSum2 );
			
				if( $result->Total >= 100 ){
					$return =  array("success" => 3, "adjustTotal" => 0 );
					
				}else{
					if( $totalSum <= 100 ){
						$return =  array("success" => 1, "adjustTotal" => 0 );
						
					}else{
						$return =  array("success" => 2, "adjustTotal" =>  $adjustTotal );
						
					}
				}
			}else{
				$return =  array("success" => 0, "adjustTotal" => 0 );
				
			}
		 
			
			return $return;
		
	}
	/*
		============================ End ============================
	*/
	
	
	/*
		=============================================================
			Function for count weightage according to main category
			weightage wise if there is wieghtage space/
			For insertation
		=============================================================
	*/
		public function getWeightage( $catID, $weightage,$currentWeightage){
			$this->ADB = $this->load->database('assessment',true);
			$select = array( '(FORMAT(SUM(weightage),2)) as Total' );

			$this->ADB->select($select);
			$this->ADB->from('assessment_type');
			$this->ADB->where( 'ass_category_id' , $catID );
			$query = $this->ADB->get();
			$result = $query->row();
			$currentTotal = $result->Total;
			//echo "<br />";
			$totalSum   = ( $currentTotal + $weightage );
			
			if( $totalSum < 100 ){
				$totalSum2  = ( 100 - $totalSum );
			}else{
				$totalSum2  = ( $totalSum - 100 );	
			}
			//echo "<br />";
			//echo $totalSum2;
			
			if( $totalSum2 < $currentWeightage ){
				$adjustTotal = ( $currentWeightage - $totalSum2 );
			}else{
				$adjustTotal = ( $totalSum2 - $currentWeightage );
			}
			//echo "<br />";
			//echo $adjustTotal;
			
			
			 if( $currentTotal >= 100 ){
				
				if( $weightage > $currentWeightage ){
					$return =  array("success" => 3, "adjustTotal" => 0 );
					return $return;
				}else{
					$return =  array("success" => 4, "adjustTotal" => $adjustTotal );
					return $return;
				}
				
				
				
			}else{
				
				if( $totalSum <= 100 ){
					$return =  array("success" => 1, "adjustTotal" => 0 );
					return $return;
				}else{
					$return =  array("success" => 2, "adjustTotal" =>  $adjustTotal );
					return $return;
				}
				
			
			} 
		}
	/*
		============================ End ============================
	*/
	
	
	// ============================================
	//  Get Grades
	// ============================================
	/*
	public function getGrade(){
		$active_group = "default";
		$active_record = TRUE;
		$this->DDB->select("*");
		$this->DDB->from('_grade');
		$query = $this->DDB->get();
		return $query->result();
	}
	// End Grades
	*/
		
	//SELECT SUM(`weightage`) as `Total` FROM `gradesubjectass` WHERE `grade_id` = 12 AND `subject_id` = 25 AND `assessment_category_id`=58 AND `assessment_term_id` = 1 AND `academic_session_id` = 2 
	
	public function getSumWeightage( $tablename, $where ){
		$this->ADB = $this->load->database('assessment',true);
		$this->ADB->select_sum('weightage', 'Total');
		$this->ADB->from(  $tablename );
		$this->ADB->where( $where );
		$query = $this->ADB->get();
		$result = $query->row();
		if( $result->Total != NULL ){
			return 1;
		}else{
			return 0;
		}
	}
	
	public function getAssessment($select = NULL, $where = NULL ){
		$this->ADB = $this->load->database('assessment',true);
		//$this->ADB->select('a.name,b.weightage');
		if( $select != NULL ){
			$this->ADB->select( $select );
		}else{
		$this->ADB->select('*');	
		}
		$this->ADB->from("assessment_type as a");
		$this->ADB->join("gradesubjectass as b", 'a.id=b.assessment_type_id','INNER');
		if( $where != NULL ){
			$this->ADB->where( $where );
		}
		$query = $this->ADB->get();
		return $query->result();
	}
	
	
	public function getAssessment2(){
		
		/*
		SELECT 
	gd.`dname` AS `Grade`,
	sb.`name` AS `Subject`,
	ac.`name` AS `Category`,
	t.`name` AS `CategoryType`,
	ss.`name` AS `AcademicSession`,
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
WHERE gs.`academic_session_id` = 2
		*/
	}
	
	
	public function getProgramID( $where ){
		
		$this->SDB = $this->load->database("subject",TRUE);
		$this->SDB->select("id");
		$this->SDB->from("programmesetup");
		$this->SDB->where( $where);
		$query = $this->SDB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}
		
	}
	
	
	public function getSubject2($where_subject){
		
		$this->dbSub = $this->load->database('subject',TRUE);
		$this->dbSub->select('id,dname');
		$this->dbSub->from('subject');
		$this->dbSub->where($where_subject);
		$query = $this->dbSub->get();
		return $query->row_array();	
		
	}
	
}