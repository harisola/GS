	<?php
class Subject_model extends CI_Model{
	private $SDB;
	private $DDB;
	public function __construct(){
		parent::__construct(); 
	}
	
	public function get( $select, $where=NULL ){
		$this->SDB = $this->load->database("subject",TRUE);
		if($select != NULL ){
			$this->SDB->select( $select );
		}else{
			$this->SDB->select("*");
		}
		$this->SDB->from("subject");
		if($where != NULL ){
			$this->SDB->where( $where );
		}
		$this->SDB->order_by("position","asc");
		$query = $this->SDB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}	
	}
	
	public function overwrite( $tableName, $data, $where ){
		$this->SDB = $this->load->database("subject",TRUE);
		$this->SDB->where( $where );
		$this->SDB->update($tableName,$data);
		$afftectedRows = $this->SDB->affected_rows();
		return $afftectedRows;
	}
	
	
	public function getParent( $parent_id ){
		
		$this->SDB = $this->load->database("subject",TRUE);
		$this->SDB->select("*");
		$this->SDB->from("subject");
		$this->SDB->where( "parent_id", $parent_id );
		$this->SDB->order_by("position");
		$query = $this->SDB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}	
		
	}
	
	public function getModule(){
	   $this->SDB = $this->load->database("subject",TRUE);
		$this->SDB->select("id,name,dname");
		$this->SDB->from("subject");
		$this->SDB->where("parent_id",0);
		$this->SDB->order_by("position","ASC");
		$query = $this->SDB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}	
   }
   
   public function getModuleWhere($where){
	   $this->SDB = $this->load->database("subject",TRUE);
		$this->SDB->select("dname,position");
		$this->SDB->from("subject");
		$this->SDB->where($where);
		$query = $this->SDB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->row();
			return $results;
		}else{
			return false;
		}	
   }
   
   
	public function menu_showNestedModel($parentID) {
		$this->SDB = $this->load->database("subject",TRUE);
		$this->SDB->select("id,name,dname");
		$this->SDB->from("subject");
		$this->SDB->where("parent_id",$parentID );
		$this->SDB->order_by("position","ASC");
		$query = $this->SDB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}
	}
	
	public function set( $table_name,$data ){
		$this->SDB = $this->load->database("subject",TRUE);
		$this->SDB->insert($table_name,$data);
		$lastInsertedID = $this->SDB->insert_id();
		if( $lastInsertedID > 0 ){
			$data_data = array("position" => $lastInsertedID);
			$where = array("id" => $lastInsertedID);
			$sucess = $this->overwrite($table_name, $data_data, $where );
			if($sucess){
				return 1;	
			}else{
				return 2;
			}
			
		}else{
			return 3;
		}
		
	}
	
	public function setup( $table_name,$data ){
		$this->SDB = $this->load->database("subject",TRUE);
		$this->SDB->insert($table_name,$data);
		$lastInsertedID = $this->SDB->insert_id();
		if( $lastInsertedID > 0 ){
			return TRUE;
		}else{
			return TRUE;
		}
		
	}
	
	
	public function getR( $tablename, $select=NULL, $where=NULL ){
		$this->SDB = $this->load->database("subject",TRUE);
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
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}	
	}
	
	public function removePSetup($tablname,$where){
		$this->SDB = $this->load->database("subject",TRUE);
		$this->db->where($where);
		$this->db->delete($tablname); 
		return TRUE;
	}
	
	
	public function getJoin( $where ){
		$this->SDB = $this->load->database("subject",TRUE);
		$this->SDB->select("*");
		$this->SDB->from("subject");
		$this->SDB->join("programmesetup" , 'programmesetup.subjects = subject.id', 'left');
		$this->SDB->where($where);
		$query = $this->SDB->get();
		$results = $query->result_array();
		return $results;
	}
	
	
	public function setupReplace2( $table_name,$data ){
		$this->SDB = $this->load->database("subject",TRUE);
		$this->SDB->replace($table_name,$data);
		$last_id = $this->db->insert_id();
		return $last_id;
		
	}
	
	public function setupReplace( $table_name,$data ){
		$this->SDB = $this->load->database("subject",TRUE);
		$this->SDB->replace($table_name,$data);
		return TRUE;
	}
	
	
	public function getDistinct( $tablename, $select=NULL, $where=NULL  ){
		
		$this->SDB = $this->load->database("subject",TRUE);
		
		$this->SDB->distinct();
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
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}	
	}
	

	
	public function join($tbl1, $tbl2, $on, $select=NULL, $where ){
		$this->SDB = $this->load->database("subject",TRUE);
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
	
	/*SELECT a.`official_name` FROM `student_registered` as a join `student_academic_record` as b ON (a.id =b.student_id) WHERE b.grade_id = 13 AND b.academic_session_id = 6 */
	
	
	
	public function getGrdStudents( $grdID, $sessionID ){
		$this->DDB = $this->load->database("default",TRUE);
		
		$where = array("grade_id" => $grdID, "std_status_category"=>"Student");
		$this->DDB->select("`id`,`official_name`,`abridged_name`, `gender`, `gs_id`,`section_dname` AS `section`,`student_status_name` AS `status`");
		$this->DDB->from("`class_list`");
		$this->DDB->where( $where );
		//$this->DDB->where("(std_status_category='Student' OR std_status_category='Fence')", NULL, FALSE);
		$this->DDB->order_by("section_id", "ASC");
		$this->DDB->order_by("call_name", "ASC"); 
		$query = $this->DDB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}	
		
	}
	
	
	public function countAll($tablename,$where){
		$this->SDB = $this->load->database("subject",TRUE);
		$this->SDB->select ( 'COUNT(*) AS `numrows`' );
		$this->SDB->where ( $where );
		$query = $this->SDB->get ( $tablename );
		return $query->row ()->numrows;
	}
	
	
	public function getSingleRow( $tablename, $select=NULL, $where=NULL ){
		$this->SDB = $this->load->database("subject",TRUE);
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
			$results = $query->row();
			return $results;
		}else{
			return false;
		}
	}
	public function getStd( $sessionID, $term,$grdID,$grpID,$subjectID){
		
		$this->DDB = $this->load->database("default",TRUE);
		$where = array( "b.grade_id" => $grdID, "b.group_no"=>$grpID, "b.subject_selection_grade_id" => $subjectID, "`b`.`term`" => $term, "`b`.`record_deleted`" => 0 );
		
		$this->DDB->select("`a`.`id`,`a`.`abridged_name` AS `Full Name`, `a`.`gs_id` AS `GS-ID`, `a`.`gender` AS `Gender`, `b`.`grdStdGrp` AS `key`,`a`.`section_dname` AS
		`section`,`a`.`student_status_dname` AS `status`");
		$this->DDB->from("atif.class_list AS `a`");
		$this->DDB->join("atif_subject.subject_selection_student2 AS `b`", "a.id = b.student_id");
		$this->DDB->where( $where );
		
		$this->DDB->where("(a.std_status_category='Student' OR a.std_status_category='Fence')", NULL, FALSE);
		$this->DDB->order_by("a.section_id", "ASC");
		$this->DDB->order_by("a.call_name", "ASC"); 
		
		$query = $this->DDB->get();
		//echo $this->DDB->last_query();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			//return $this->DDB->last_query();
			return $results;
		}else{
			return false;
		}
	}
	
	public function joinSubjects($tbl1, $tbl2, $on, $select=NULL, $where ){
		$this->SDB = $this->load->database("subject",TRUE);
		
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
	
	
	PUBLIC FUNCTION COUNTGENDER( $grdID, $grpID, $subjectID=NULL ){
		
		$this->DDB = $this->load->database("default",TRUE);
		if($subjectID != NULL){
		$where = array( "b.grade_id" => $grdID, "b.group_no"=>$grpID, "b.subject_selection_grade_id" => $subjectID );	
		}else{
			$where = array( "b.grade_id" => $grdID, "b.group_no"=>$grpID );
		}
		$this->DDB->select( "COUNT( distinct case a.gender when 'G' then a.id else null end ) AS `Girls`,COUNT( distinct case a.gender when 'B' then a.id else null end ) AS `Boys`");
		$this->DDB->from("atif.student_registered AS `a`");
		$this->DDB->join("atif_subject.subject_selection_student2 AS `b`", "a.id = b.student_id");
		$this->DDB->where( $where );
		$query = $this->DDB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}	
	}
	
	
	
	public function joinTable( $select, $from, $joinTable2, $on, $where ){
		$this->DDB = $this->load->database("default",TRUE);
		$this->DDB->select( $select );
		$this->DDB->from( $from );
		$this->DDB->join($joinTable2, $on );
		$this->DDB->where( $where );
		$query = $this->DDB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}	
	}
	
	
	public function getSingleRow2( $DB, $tablename, $select=NULL, $where=NULL ){
		$this->SDB = $this->load->database( $DB,TRUE);
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
			$results = $query->row();
			return $results;
		}else{
			return false;
		}
	}
	
	public function countData( $table, $where ){
		$this->SDB = $this->load->database("subject",TRUE);
		
		$this->SDB->where( $where );
		$num_rows = $this->SDB->count_all_results( $table );
		return $num_rows;
	}
	
}