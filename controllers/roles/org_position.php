<?php
defined('BASEPATH') or exit('No direct data access allowed');
class Org_position extends MY_Controller{
	
	public function __construct(){ parent::__construct(); }
	
	public function index(){
		
		$this->load->model('roles/roledb_model','Rdb');
		
		$db = "role_org";
		$table = "`role_domain`";
		$tType = "`role_type`";
		$tCat = "`role_category`";
		$select1 = "`id`,`dname`,`code` AS `code`";
		//$select2 = "`id`,`dname`,`code` AS `code2`";
		//$select3 = "`id`,`dname`,`code` AS `code3`";
		$select = "`id`,`dname`";
		$data['domains']    = $this->Rdb->getAll($db, $table, $select1, $where=NULL);
		$data['roleTypes']  = $this->Rdb->getAll($db, $tType, $select1, $where=NULL);
		//category
		$select4 = "`id`,`dname`,`code`";
		$column_name = "code";
		$data['categories'] = $this->Rdb->getStaffCategory($db, $tCat, $select4, $where=NULL,$column_name);
		
		//Get Current Postions
		$table_pos = "role_position";
		$se = "id AS postionID,gp_id AS positionTitle,roleCode AS roleCode";
		$where1 = array( "record_deleted" => 0 );
		$data['positions'] = $this->Rdb->getAll($db, $table_pos, $se, $where1 );
		
		
		//wings
		$ddb = "default";
		$wingTable = "`_wing`";
		$data['wings'] = $this->Rdb->getAll($ddb, $wingTable, $select, $where=NULL);
		//grades
		$gradeTable = "`_grade`";
		$where2 = array( "record_deleted" => 0 );
		$data['grades'] = $this->Rdb->getAll($ddb, $gradeTable, $select, $where2);
		//section
		$sectionTable = "`_section`";
		$where3 = array( "record_deleted" => 0 );
		$data['sections'] = $this->Rdb->getAll( $ddb, $sectionTable, $select, $where3 );
		//Staff
		$sectionTable = "`staff_registered`";
		$select2 = "`id` AS `StaffID`, `gt_id` AS `GTID`,`name_code` AS `nCode`,`abridged_name` AS `aname`,`staff_category` AS `sCat` ";
		$where4 = array( "is_active" => 1 );
		$data['staff'] = $this->Rdb->getAll( $ddb, $sectionTable, $select2, $where4 );
		
		$acTable = "`_academic_session`";
		$select3 = "`id` AS `acID`,`name` AS `dname`";
		$where5 = array( "is_active" => 1, "branch_id" => 2);
		$data['academic'] = $this->Rdb->getAll( $ddb, $acTable, $select3, $where5 );
		
		$data['joiningResults'] = $this->Rdb->join();
		
		//var_dump( $data['joiningResults'] );
	//	exit;
		
		//subjects
		$sdb = "subject";
		$stable = "`subject`";
		$where = array( "record_deleted" => 0 );
		$data['subjects'] = $this->Rdb->getAll($sdb, $stable, $select, $where );
		
		
		
		//var_dump( $data['subjects'] );
		//exit;
		//$this->load->view("roles/position/option_allocation",$data);
		$this->load->view("roles/position/option_allocation2",$data);
		$this->load->view("roles/position/footer");
	}
	
}