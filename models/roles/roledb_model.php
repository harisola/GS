<?php
class Roledb_model extends CI_Model{
	private $DB;
	public function __construct(){ parent::__construct(); }
	
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
			return false;
		}
	}
	
	public function insert( $db2, $table, $data ){
		
		$this->DB = $this->load->database($db2,TRUE);
		$this->DB->insert($table,$data);
		$lastInsertedID = $this->DB->insert_id();
		if( $lastInsertedID > 0 ){
			return $lastInsertedID;
		}else{
			return 0;
		}
	}
	
	
	
	public function join(){
		$this->DB = $this->load->database("default",TRUE);
		$select = "";
		$tbl1 = "`atif_role_org`.`role_domain` AS `a`"; //a.id AS domainID, a.dname AS domainName
		$on = "d.org_domain_id = a.id";
		$tbl2 = "`atif_role_org`.`role_type` AS `b`"; // b.id AS typeID, b.dname AS typeName
		$on2 = "d.role_type_id = b.id";
		$tbl3 = "`atif_role_org`.`role_category` AS `c`"; // c.id AS catID, c.dname AS catName
		$on3 = "d.staff_role_category_id = c.id";
		$tbl4 = "`atif_role_org`.`role_position` AS `d`";
		$tbl5 ="`atif`.`_wing` AS `e`";
		$on5 = "d.wing_id = e.id";
		$tbl6 ="`atif`.`_grade` AS `f`";
		$on6 = "d.grade_id = f.id";
		$tbl7 ="`atif`.`_section` AS `g`";
		$on7 = "d.section_id = g.id";
		$tbl8 ="`atif_subject`.`subject` AS `h`";
		$on8 = "d.subject_id = h.id";
		$select = "d.id AS pID, d.title AS title, a.dname AS domainName, b.dname AS typeName, c.dname AS catName, e.dname AS wingName, f.dname AS grdName, g.dname AS secName, h.dname AS subName";
		$this->DB->select( $select );
		$this->DB->from( $tbl4 );
		$this->DB->join($tbl1, $on);
		$this->DB->join($tbl2, $on2,'LEFT');
		$this->DB->join($tbl3, $on3 ,'LEFT');
		$this->DB->join($tbl5, $on5,'LEFT');
		$this->DB->join($tbl6, $on6,'LEFT');
		$this->DB->join($tbl7, $on7,'LEFT');
		$this->DB->join($tbl8, $on8,'LEFT');
		//if($where != NULL ){ $this->DB->where( $where );}
		$query = $this->DB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
			
			
			

		}else{
			return false;
		}
	}
	
	
	public function getRowLike( $db2, $table, $select=NULL, $where=NULL){
		
		$this->DB = $this->load->database($db2,TRUE);
		if($select != NULL ){
			$this->DB->select( $select );
		}else{
			$this->DB->select("*");
		}
		$this->DB->from( $table );
		if($where != NULL ){
			$this->DB->like( $where );
		}
		$query = $this->DB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->row_array();
			return $results;
		}else{
			return FALSE;
		}
	}
	
	// update table function
	public function overwrite($db, $table, $data = array(), $where = array() ){
		$this->DB = $this->load->database($db,TRUE);
		$this->DB->where( $where );
		$this->DB->update($table,$data);
		$afftectedRows = $this->DB->affected_rows();
		return $afftectedRows;
	}
	
	
	// function for staff and its position
	public function join2(){
		$this->DB = $this->load->database("default",TRUE);
		
		$tbl1 = "`atif_role_org`.`role_position` AS `a`";
		
		$tbl2 ="`atif`.`staff_registered` AS `b`";
		$on = "a.staff_id = b.id";
		
		//$tbl3 = "`atif_role_org`.`role_position` AS `c`";
		//$on2 = "a.pm_report_to = c.id";
		//$tbl4 = "`atif_role_org`.`role_position` AS `e`";
		//$on3 = "a.sc_report_to = e.id";
		
		$tbl5 = "`atif_role_org`.`role_domain` AS `f`";
		$on4 = "f.id=a.org_domain_id";
		
		
		$tbl6 = "`atif_role_org`.`role_type` AS `g`";
		$on5 = "g.id=a.role_type_id";
		
		$tbl7 = "`atif_role_org`.`role_category` AS `h`";
		$on6 = "h.id=a.staff_role_category_id";
		
		//$tbl8 ="`atif`.`staff_registered` AS `i`";
		//$on7 = "c.staff_id = i.id";
		
		//$tbl9 ="`atif`.`staff_registered` AS `j`";
		//$on8 = "e.staff_id = j.id";
		
		
		$select = 'a.id AS PositionID,
				   a.roleCode AS RoleCode,	
				   a.gp_id AS PostionTitle,
				   a.role_title_tl AS TopLine,
				   a.role_title_bl AS BottomLine,
				   a.staff_id AS PositionsStaffID,
				   a.countRoleCode AS PositionCount,
				   a.is_transparent AS Transparent,
				   a.fundamentalRole AS PF,
				   a.role_title_tl AS pmTopLine,
				   a.role_title_bl AS pmBottomLine,
				   a.roleCode AS PrimaryReportRoleCode,
				   a.roleCode AS SecondayReportRoleCode,
				   a.sc_report_to AS SecondayReportID,
				   a.role_title_tl AS srTopLine,
				   a.role_title_bl AS srBottomLine,
				   a.pm_report_to AS pmPostionID,
				   
				   b.name_code AS staffCode,
				   b.abridged_name AS staffName,
				   b.gt_id AS GT_ID,
				   b.abridged_name AS PRstaffName,
				   b.abridged_name AS SRstffName,
				   
				   f.id AS DomainID,
				   f.dname AS Domain,
				   g.id AS TypeID,
				   g.dname AS RoleType,
				   h.id AS CatID,
				   h.dname AS Category';
				   
		$this->DB->select( $select );
		$this->DB->from( $tbl1 );
		$this->DB->join($tbl2, $on,'LEFT');
		//$this->DB->join($tbl3, $on2,'LEFT');
		//$this->DB->join($tbl4, $on3,'LEFT');
		$this->DB->join($tbl5, $on4,'LEFT');
		$this->DB->join($tbl6, $on5,'LEFT');
		$this->DB->join($tbl7, $on6,'LEFT');
		//$this->DB->join($tbl8, $on7,'LEFT');
		//$this->DB->join($tbl9, $on8,'LEFT');
		//$this->DB->where("a.academic_session_id",8);
		//$this->DB->limit(10);
		$query = $this->DB->get();
		//echo $this->DB->last_query();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}
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
	
	
public function getStaffCategory( $db2, $table, $select=NULL, $where=NULL, $column_name = '' ){
		$this->DB = $this->load->database($db2,TRUE);
		$this->DB->distinct();
		if($select != NULL ){
			$this->DB->select( $select );
		}else{
			$this->DB->select("*");
		}
		$this->DB->from( $table );
		if($where != NULL ){
			$this->DB->where( $where );
		}
		if($column_name != ''){
			$this->DB->group_by($column_name);		
		}
		
		
		$query = $this->DB->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result_array();
			return $results;
		}else{
			return false;
		}
}

		public function get_Staff_id_from_role_position_table($Query)
		{
	     	$this->DB = $this->load->database("default",TRUE);
			$query = $this->DB->query($Query);
	    	if( $query->num_rows() > 0 ){
			$results = $query->row_array();
			return $results;
			}else{
				return false;
			}
		}

	    public function update_Staff_id_from_role_position_table($Query)
		{
	    	$this->DB = $this->load->database("default",TRUE);
			$this->DB->query($Query);
	    	return $this->db->affected_rows();
	    }

	public function SP_Set_Role_Computations(){
	        $this->DB = $this->load->database("role_org",TRUE);
	        $query = $this->DB->query("CALL sp_update_role_distance()");
	        return $query->result();
	    }
	
}	
