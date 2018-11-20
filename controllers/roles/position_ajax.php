<?php 
class Position_ajax extends CI_Controller{
	public function __construct(){ parent::__construct(); }
	
	
	public function set(){
		$this->load->model('roles/roledb_model','Rdb');
		
		
		$pTitle = $this->input->post('positionTitle');
		$domain = $this->input->post('domain');
		$roletype = $this->input->post('roletype');
		$cat = $this->input->post('category');
		$wing = $this->input->post('wing');
		$grade = $this->input->post('grade');
		$section = $this->input->post('section');
		$subject = $this->input->post('subject');
		$academic = $this->input->post('academic');
		
		// domain post value contance selected id with short code like 1_M (i.e:GS Management)
		$dn = explode("_", $domain );
		$domain = (int)$dn[0];
		$domain1 = $dn[1];
		// Role type value contance again selectd value id like 1 with role type cod 2_JN
		$tp = explode("_", $roletype );
		$roletype = (int)$tp[0];
		$roletype1 = $tp[1];
		
		$ctp = explode("_", $cat );
		$cat = (int)$ctp[0];
		$cat1 = $ctp[1];
		
		$gp_id = $domain1.'-'.$roletype1.'-'.$cat1;
		$db = "role_org";
		
		/*$table = "`gpid`";
		$select = "gp_id";
		$grandID = '';
		$where = array( "gp_id" => $gp_id);
		if( $gpIDs = $this->Rdb->getAll( $db, $table, $select, $where) ){
			$num = count($gpIDs);
			$sum = ($num+1);
			if($sum < 10 ){
				$grandID = $gp_id.'0'.$sum;	
			}else{
				$grandID = $gp_id.$sum;
			}
			
		}else{
			$sum = '01';
			$grandID = $gp_id.$sum;
			
		}
		$data1 = array("gpName" => $grandID,"gp_id"=> $gp_id);
		$ID = $this->Rdb->insert( $db, $table, $data1 );
		*/
		$table = "`role_position`";
		$select = "count(*)+1 AS Total";
		$where = array( "gp_id" => $gp_id);
		$gpIDs = $this->Rdb->getRowLike( $db, $table, $select, $where);
		$sum = $gpIDs["Total"];
		if($sum < 10 ){
			$grandID = $gp_id.'0'.$sum;	
		}else{
			$grandID = $gp_id.$sum;
		}
		$data = array(
			'org_domain_id' => $domain,
			'role_type_id' => $roletype,
			'gp_id' => $grandID,
			'wing_id' => $wing,
			'grade_id' => $grade,
			'section_id' => $section,
			'subject_id' => $subject,
			'title' => $pTitle,
			'staff_role_category_id' => $cat,
			'academic_session_id' => $academic
		);
		if( $ID = $this->Rdb->insert( $db, $table, $data ) ){
			echo $ID;
		}else{
			echo 0;
		} 
		
	}
	//	------------------------------------------------------ 
	//			Assign Position to Employee
	//	------------------------------------------------------
	public function assignPosition(){
		$this->load->model('roles/roledb_model','Rdb');
		$staffID   = $this->input->post('staffID');
		$position  = $this->input->post('position');
		$primary   = $this->input->post('primary');
		$secondary = $this->input->post('secondary');
		$trans = $this->input->post('reportingType');
		$db = "role_org";
		$table = "`role_position`";
		$data = array(
			"pm_report_to" => $primary,
			"sc_report_to" => $secondary,
			"staff_id" => $staffID,
			"is_transparent" => $trans
		);
		$where = array("id" => $position);
		if( $this->Rdb->overwrite($db, $table, $data, $where ) ){
			
			$data['results'] = $this->Rdb->join2();
			$this->load->view("roles/position/assign/load_right_side",$data);
		}else{
			echo 0;
		}
	}
	
	// -----------------------------------------------------
	
	
	public function staff(){
		$this->load->model('roles/roledb_model','Rdb');
		$staffID   = $this->input->post('staff');
		$ddb = "default";
		//Staff
		$sectionTable = "`staff_registered`";
		$select2 = "`id` AS `StaffID`, `gt_id` AS `GTID`,`name_code` AS `nCode`,`abridged_name` AS `aname`,`staff_category` AS `sCat` ";
		//$where4 = array( "id" =>$staffID,"is_active" => 1 );
		$where4 = array( "id" =>$staffID );
		$staffD = $this->Rdb->getAll( $ddb, $sectionTable, $select2, $where4 );
		$staffDa = array(
				"sID"=>$staffD[0]["StaffID"],
				"GTID"=>$staffD[0]["GTID"],
				"nCode"=>$staffD[0]["nCode"],
				"aname"=>$staffD[0]["aname"],
				"sCat"=>$staffD[0]["sCat"]
			);
			
		echo json_encode($staffDa);
	}
	
	
	public function staff2( $staffID, $select2 ){
		
		$this->load->model('roles/roledb_model','Rdb');
		$ddb = "default";
		$sectionTable = "`staff_registered`";
		//$where4 = array( "id" =>$staffID,"is_active" => 1 );
		$where4 = array( "id" =>$staffID );
		$staffD = $this->Rdb->getAll( $ddb, $sectionTable, $select2, $where4 );
		return $staffD;
		
	}
	
	
	
	public function getRType(){
		
		$domain   = $this->input->post('domain');
		$domainType = $this->getRType2($domain);
		
		$return = array ("TYPED" => $domainType );
		echo json_encode($return);
	}
	
	public function getRType2($domain){
		$this->load->model('roles/roledb_model','Rdb');
		$db = "role_org";
		$tType = "`role_type`";
		$select1 = "`id`,`dname`,`code` AS `code`";
		$where = array("domainID" => $domain);
		$roleTypes  = $this->Rdb->getAll($db, $tType, $select1, $where);
		$html = '';
		$html .= '<option value="">Type</option>';
		foreach( $roleTypes as $typ ){
			$html .= '<option value="'.$typ["id"].'_'.$typ["code"].'" title="'.$typ["dname"].'">';
			$html .= ucfirst( $typ["code"] );
			$html .= '</option>';
		}
		return $html;
	}
	
	public function getGpID(){
		$this->load->model('roles/roledb_model','Rdb');
		$posID   = $this->input->post('posID');
		$domain = $this->input->post('domain2');
		$roletype = $this->input->post('roletype2');
		$cat = $this->input->post('category2');
		
		$gs_grade = $this->input->post('gs_grade');
		$gs_subject = $this->input->post('gs_subject');
		
		$db = "role_org";
		$table = "`role_position`";
		$select = "count(*)+1 AS Total";
		$where = array( "gp_id" => $posID);
		$gpIDs = $this->Rdb->getRowLike( $db, $table, $select, $where);
		$sum = $gpIDs["Total"];
		//$num = count($gpIDs);
		//$sum = ( $num + 1 );
			
		if($sum < 10 ){
			
			$grandID = $posID.'-'.'0'.$sum;	
		}else{
			$grandID = $posID.'-'.$sum;
		}
		
		
		$ddb = "default";
		$acTable = "`_academic_session`";
		$select3 = "`id` AS `acID`,`name` AS `dname`";
		$where5 = array( "is_active" => 1, "branch_id" => 2);
		$ac = $this->Rdb->getAll( $ddb, $acTable, $select3, $where5 );
		$academic=$ac[0]["acID"];
		
		$ID =0;
		$data = array(
			'org_domain_id' => $domain,
			'role_type_id' => $roletype,
			'gp_id' => $grandID,
			'grade_id'=>$gs_grade,
			'subject_id'=>$gs_subject,
			'staff_role_category_id' => $cat,
			'academic_session_id' => $academic
		);
		//$ID = $this->Rdb->insert( $db, $table, $data );
		
		$return = array ("gpID"=>$grandID, "countPosi" => $sum );
		echo json_encode($return);
	}
	
	
	
	public function getGpID2(){
		$this->load->model('roles/roledb_model','Rdb');
		$posID   = $this->input->post('posID2');
		$domain = $this->input->post('domain2');
		$roletype = $this->input->post('roletype2');
		$cat = $this->input->post('category2');
		$db = "role_org";
		$table = "`role_position`";
		
		$ddb = "default";
		$acTable = "`_academic_session`";
		$select3 = "`id` AS `acID`,`name` AS `dname`";
		$where5 = array( "is_active" => 1, "branch_id" => 2);
		$ac = $this->Rdb->getAll( $ddb, $acTable, $select3, $where5 );
		$academic=$ac[0]["acID"];
		
		$data = array(
			'org_domain_id' => $domain,
			'role_type_id' => $roletype,
			'gp_id' => $posID,
			'staff_role_category_id' => $cat,
			'academic_session_id' => $academic
		);
		$ID = $this->Rdb->insert( $db, $table, $data );
		$return = array ("lastID"=>$ID,"gpID"=>$posID );
		echo json_encode($return);
	}
	
	
	public function updatepostion(){
		$this->load->model('roles/roledb_model','Rdb');
		$lastID   = $this->input->post('lastID');
		$topline = $this->input->post('topline');
		$bottomline = $this->input->post('bottomline');
		$db = "role_org";
		$table = "`role_position`";
		$data = array("role_title_tl"=>$topline,"role_title_bl"=>$bottomline);
		$where = array("id"=>$lastID);
		$return = $this->Rdb->overwrite( $db, $table, $data, $where );
		$return2 = array ("affected"=>$return);

		/* New Code applied by Kashif Solangi on 6th Nov 2018
		*/
		$Query = "select ro.staff_id as Staff_id from atif_role_org.role_position as ro 
		where ro.id=".$lastID."";
		$r = $this->Rdb->get_Staff_id_from_role_position_table($Query);
		if(!empty($r))
		{
			$Staff_id = $r['Staff_id'];
			if( $Staff_id > 0 )
			{
				
				$UQuery = "UPDATE `atif`.`staff_registered` 
				SET `designation`='".mysql_real_escape_string($topline)."',
				`department`='".mysql_real_escape_string($bottomline)."',
				`c_topline`= '".mysql_real_escape_string($topline)."',
				`c_bottomline`='".mysql_real_escape_string($bottomline)."'
				WHERE  `id`=".$Staff_id.";";

				$this->Rdb->update_Staff_id_from_role_position_table($UQuery);	
			}
		}
		echo json_encode($return2);

		/* End code */ 
	}
	
	
	
	public function getPostionTitle(){
		$this->load->model('roles/roledb_model','Rdb');
		$db = "role_org";
		$tType = "`role_position`";
		$se = "id AS postionID,gp_id AS positionTitle,roleCode AS roleCode";
		//$where1 = array( "positionStatus" => 1, "record_deleted" => 0 );
		$where1 = array( "record_deleted" => 0 );
		$roleTypes  = $this->Rdb->getAll($db, $tType, $se, $where1);
		
		$html = '';
		$html .= '<option value="">Postion ID</option>';
		//if( !empty($roleTypes)){
			foreach( $roleTypes as $typ ){
				$html .= '<option value="'.$typ["postionID"].'">';
				$html .= $typ["positionTitle"];
				$html .= '</option>';
			}
		//}else{$html .= '<option value="-1">Creat Only </option>';	}
		
		
		
		
		$html2 = '';
		$html2 .= '<option value="">Role Code</option>';
	//	if( !empty($roleTypes)){
			foreach( $roleTypes as $typ ){
				$html2 .= '<option value="'.$typ["postionID"].'">';
				$html2 .= $typ["roleCode"];
				$html2 .= '</option>';
			}
		//}else{ $html2 .= '<option value="-1">Creat Only </option>';	}
		
		
		$return2 = array ( "pos"=>$html, "rC" => $html2 );
		echo json_encode($return2);
	}
	
	public function updttpbl(){
		$this->load->model('roles/roledb_model','Rdb');
		$db = "role_org";
		$table = "`role_position`";
		
		$pmReportToID   = $this->input->post('ID');
		$whereID   = $this->input->post('lastID');
		$type   = $this->input->post('type');
		
		if($type == 1){
			$data = array("pm_report_to"=>$pmReportToID);
		}else{
			$data = array("sc_report_to"=>$pmReportToID);
		}
		$where = array("id"=>$whereID);
		$return = $this->Rdb->overwrite( $db, $table, $data, $where );
		$return2 = array ("affected"=>$return);
		echo json_encode($return2);
		
	}
	
	public function getTopBottomLine(){
		$this->load->model('roles/roledb_model','Rdb');
		$ID   = $this->input->post('ID');
		$db = "role_org";
		$tType = "`role_position`";
		$se = "role_title_tl AS topLine,role_title_bl AS bottomLine,staff_id AS staffID";
		$where1 = array( "id"=>$ID);
		$r = $this->Rdb->getSingleRow($db, $tType, $se, $where1);
		$return2 = $r["topLine"]."-".$r["bottomLine"];
		$staffID = $r["staffID"];
		if( $staffID > 0 ){
			$select2 = "`id` AS `stffID`, `abridged_name` AS `aname`";
			$staff = $this->staff2($staffID,$select2);
			
			$stfID = $staff[0]["stffID"];
			$aname = $staff[0]["aname"];
		}else{
			$stfID = 0;
			$aname = 0;
		}
		
		$se = "id AS postionID,gp_id AS positionTitle,roleCode AS roleCode";
		$where1 = array( "positionStatus" => 1, "record_deleted" => 0 );
		$where1 = array( "record_deleted" => 0 );
		$roleTypes  = $this->Rdb->getAll($db, $tType, $se, $where1);
		
			$html = '';
		$html .= '<option value="">Postion ID</option>';
		foreach( $roleTypes as $typ ){
			if($ID == $typ["postionID"] ){ $selected ="selected=selected"; }else{ $selected ="";  }
			$html .= '<option value="'.$typ["postionID"].'" '.$selected.'>';
			$html .= $typ["positionTitle"];
			$html .= '</option>';
		}
		
		$html2 = '';
		$html2 .= '<option value="">Role Code</option>';
		foreach( $roleTypes as $typ ){
			
			if($ID == $typ["postionID"] ){ $selected ="selected=selected"; }else{ $selected ="";  }
			$html2 .= '<option value="'.$typ["postionID"].'" '.$selected.'>';
			$html2 .= $typ["roleCode"];
			$html2 .= '</option>';
		}
		
		
		$ar = array("combinetlbl" => $return2, "staffID" =>$staffID,"staffName" => $aname, "options"=>$html2, "options2"=>$html );
		
		echo json_encode($ar);
	}
	
	
	
	public function getPosInfo(){
		$this->load->model('roles/roledb_model','Rdb');
		$staffID   = $this->input->post('staff');
		$lastID   = $this->input->post('lastID');
		//$ptype   = $this->input->post('ptype');
		//if($ptype != 1){ $lastID = 0; }
		
		$db = "role_org";
		$tType = "`role_position`";
		$select1 = "count(*)+1 AS staffID";
		$select2 = "id AS PosID";
		$where = array("staff_id" => $staffID);
		$staffCount  = $this->Rdb->getAll($db, $tType, $select1, $where);
		$stffCount = $staffCount[0]["staffID"];
		
		$posID = $this->Rdb->getAll($db, $tType, $select2, $where);
		
		
		$html = $this->staffCheckBox($stffCount,$posID,$lastID);
		
		if( $staffCount == 0 ){
			$positons = 0;
		}else if( $staffCount == 1 ){
			$dum = 0;
			$positons = $lastID."_".$dum;
		}else{
			$posID1 = $posID[0]["PosID"];
			if($posID1 == ''){
				$posID1 = 0;
			}
			$positons = $posID1."_".$lastID;
		}
		
		$return = array( "sc"=> $stffCount, "cHtml" =>$html, "fid"=>$positons );
		echo json_encode($return);
	}
	
	public function staffCheckBox( $staffCount, $posID, $lastID ){
		
		
		
		
		$html = '';
		if( $staffCount == 0 ){
			$html .= '<input type="radio" name="fundacheck" value="VI_'.$lastID.'" class="fundaCount" checked="" /> V';
		}else if( $staffCount == 1 ){
			//$posID1 = $posID[0]["PosID"];
			$posID1 = $lastID;
			$html .= '<input type="radio" name="fundacheck" value="I_'.$lastID.'" class="fundaCount"  checked="" /> I';
		}else if( $staffCount == 2 ){
			$posID1 = $posID[0]["PosID"];
			$posID2 = $lastID;
			//$html .= '<input type="checkbox" name="fundacheck[]" value="A" class="fundaCount" checked="" /> A';
			//$html .= '<input type="checkbox" name="fundacheck[]" value="B" class="fundaCount"  /> B';
			
			$html .= '<input type="radio" name="fundacheck" value="A_'.$posID1.'" class="fundaCount" checked="" /> A';
			$html .= '<input type="radio" name="fundacheck" value="B_'.$posID2.'" class="fundaCount"  /> B';
		}else{
			//$html .= "Error! While assigning";
			$html .= '<input type="radio" name="fundacheck" value="VI_'.$lastID.'" class="fundaCount" checked="" /> V';
		}
		return $html;
	}
	

public function staff_registered_topline_bottomline($postion_id,$Staff_id)
	{
		$this->load->model('roles/roledb_model','Rdb');

		$Query = "select ro.role_title_tl as Topline, ro.role_title_bl as Bottom_line from atif_role_org.role_position as ro  where ro.id=".$postion_id."";

		$r = $this->Rdb->get_Staff_id_from_role_position_table($Query);
		if(!empty($r))
		{
			$topline = $r['Topline'];
			$bottomline = $r['Bottom_line'];
			
			
			
				$UQuery = "UPDATE `atif`.`staff_registered` 
				SET `designation`='".mysql_real_escape_string($topline)."',
				`department`='".mysql_real_escape_string($bottomline)."',
				`c_topline`= '".mysql_real_escape_string($topline)."',
				`c_bottomline`='".mysql_real_escape_string($bottomline)."'
				WHERE  `id`=".$Staff_id.";";
				$this->Rdb->update_Staff_id_from_role_position_table($UQuery);	
			
		}
		return true;
	}


	public function finish(){
		$this->load->model('roles/roledb_model','Rdb');
		$staffID   = $this->input->post('staff1');
		$posID     = (int) $this->input->post('posID1'); // current id
		$thsID     = $this->input->post('thsID1');
		
		$roleCode1     = $this->input->post('rolecode1');
		$roleCode2     = $this->input->post('rolecode2');
		
		$ctRC     = $this->input->post('countRC');
		$funda     = (int) $this->input->post('funda'); //fundamental id
		$fundID     = $this->input->post('fundID2');
		$funda2AB     = $this->input->post('funda2AB'); // A B
		
		
		$fndID = explode("_",$fundID);
		$fndIDA  = (int) $fndID[0]; // previus pos id
		$fndIDB = (int) $fndID[1]; // current pos id
		
		
		//$fRCode = $roleCode1.'-'.$roleCode2;
		
		$db = "role_org";
		$table = "`role_position`";
		$return = '';
		
			
		if( $ctRC == 0 || $ctRC == '' ){ $ctRC = 1; }
		
	
		
		if( $funda2AB == 'B'){
			
					
			$fRCodeA = $roleCode1.'-A';
			$fRCodeB = $roleCode1.'-B';
			$data1 = array( "roleCode" => $fRCodeA, "fundamentalRole" => $fndIDA );
			$where2 = array("id"=>$fndIDA);
			$return = $this->Rdb->overwrite( $db, $table, $data1, $where2 );
			
			
			$data = array( "roleCode" => $fRCodeB, "staff_id"=>$staffID, "is_transparent" => $thsID, "positionStatus" => 1,"countRoleCode" =>$ctRC,"fundamentalRole" => 0 );
			$where = array("id"=>$posID);
			$return = $this->Rdb->overwrite( $db, $table, $data, $where );
			
			
			
		}else if( $funda2AB == 'A' ){
			
			$fRCodeA = $roleCode1.'-A';
			$fRCodeB = $roleCode1.'-B';
			$data1 = array( "roleCode" => $fRCodeB, "fundamentalRole" =>0  );
			$where2 = array("id"=>$fndIDA);
			$return = $this->Rdb->overwrite( $db, $table, $data1, $where2 );
			
			
			$data = array( "roleCode" => $fRCodeA, "staff_id"=>$staffID, "is_transparent" => $thsID, "positionStatus" => 1,"countRoleCode" =>$ctRC,"fundamentalRole" => $fndIDB );
			$where = array("id"=>$posID);
			$return = $this->Rdb->overwrite( $db, $table, $data, $where );
			
			
		}else{
			
			$fRCode = $roleCode1.'-'.$roleCode2;
			$posStatus = 0;
			if($roleCode2 == 'V'){
			$posStatus = 0;	
			}else{
				$posStatus = 1;
			}
			$data = array( 
				"roleCode" => $fRCode,
				"staff_id"=>$staffID,
				"is_transparent" =>$thsID,
				"positionStatus" => $posStatus,
				"countRoleCode" =>$ctRC,
				"fundamentalRole" => $posID 
				);
			
			$where = array("id"=>$posID);
			$return = $this->Rdb->overwrite( $db, $table, $data, $where );
		}
	
		
		$return2 = array ("affected"=>$return);
		echo json_encode($return2);
		
	}
	
	
	
		public function finishEditing(){
			
		$this->load->model('roles/roledb_model','Rdb');
		$db = "role_org";
		$table = "`role_position`";
		$return = '';
		
		
		$staffID   = $this->input->post('staff1');
		$posID     = (int) $this->input->post('posID1'); // current id
		$thsID     = $this->input->post('thsID1');
		
		$roleCode1     = $this->input->post('rolecode1');
		$roleCode2     = $this->input->post('rolecode2');
		
		$ctRC     = $this->input->post('countRC');
		$funda     = (int) $this->input->post('funda'); //fundamental id
		$fundID     = $this->input->post('fundID2');
		$funda2AB     = $this->input->post('funda2AB'); // A B
		
		
		$fndID = explode("_",$fundID);
		$fndIDA  = (int) $fndID[0]; // previus pos id
		$fndIDB = (int) $fndID[1]; // current pos id
	
if( $fndIDB != 0 ){ 


if( ( $ctRC == 1 )  && ( $roleCode2 == 'A' || $roleCode2 == 'I' ) )
{
$this->staff_registered_topline_bottomline($posID,$staffID);	
}

	
if( $posID == $fndIDA  ){
	
	if($roleCode2 == 'A'){
		
			$fRCodeA = $roleCode1.'-A';
			$fRCodeB = $roleCode1.'-B';
			
			$data1 = array( "roleCode" => $fRCodeB, "fundamentalRole" => 0 );
			$where2 = array("id"=>$fndIDB);
			$return = $this->Rdb->overwrite( $db, $table, $data1, $where2 );
			
			
			$data = array( "roleCode" => $fRCodeA, "staff_id"=>$staffID, "is_transparent" => $thsID, "positionStatus" => 1,"countRoleCode" =>$ctRC,"fundamentalRole" => $posID );
			$where = array("id"=>$posID);
			$return = $this->Rdb->overwrite( $db, $table, $data, $where );
			
			
	}
	if($roleCode2 == 'B'){
		
			$fRCodeA = $roleCode1.'-A';
			$fRCodeB = $roleCode1.'-B';
			
			$data1 = array( "roleCode" => $fRCodeA, "fundamentalRole" => $fndIDB );
			$where2 = array("id"=>$fndIDB);
			$return = $this->Rdb->overwrite( $db, $table, $data1, $where2 );
			
			
			$data = array( "roleCode" => $fRCodeB, "staff_id"=>$staffID, "is_transparent" => $thsID, "positionStatus" => 1,"countRoleCode" =>$ctRC,"fundamentalRole" => 0 );
			$where = array("id"=>$posID);
			$return = $this->Rdb->overwrite( $db, $table, $data, $where );
	}
	
}else if( $posID == $fndIDB  ){
	
	if($roleCode2 == 'A'){
		
			$fRCodeA = $roleCode1.'-A';
			$fRCodeB = $roleCode1.'-B';
			
			$data1 = array( "roleCode" => $fRCodeB, "fundamentalRole" => 0 );
			$where2 = array("id"=>$fndIDA);
			$return = $this->Rdb->overwrite( $db, $table, $data1, $where2 );
			
			
			$data = array( "roleCode" => $fRCodeA, "staff_id"=>$staffID, "is_transparent" => $thsID, "positionStatus" => 1,"countRoleCode" =>$ctRC,"fundamentalRole" => $posID );
			$where = array("id"=>$posID);
			$return = $this->Rdb->overwrite( $db, $table, $data, $where );
			
			
	}
	if($roleCode2 == 'B'){
		
			$fRCodeA = $roleCode1.'-A';
			$fRCodeB = $roleCode1.'-B';
			
			$data1 = array( "roleCode" => $fRCodeA, "fundamentalRole" => $fndIDA );
			$where2 = array("id"=>$fndIDA);
			$return = $this->Rdb->overwrite( $db, $table, $data1, $where2 );
			
			
			$data = array( "roleCode" => $fRCodeB, "staff_id"=>$staffID, "is_transparent" => $thsID, "positionStatus" => 1,"countRoleCode" =>$ctRC,"fundamentalRole" => 0 );
			$where = array("id"=>$posID);
			$return = $this->Rdb->overwrite( $db, $table, $data, $where );
	}
	
} 

	}else {
			
			$fRCode = $roleCode1.'-'.$roleCode2;
			$data = array( "roleCode" => $fRCode, "staff_id"=>$staffID, "is_transparent" => $thsID, "positionStatus" => 1,"countRoleCode" =>$ctRC,"fundamentalRole" => $posID );
			$where = array("id"=>$posID);
			$return = $this->Rdb->overwrite( $db, $table, $data, $where );
		}

		$this->Rdb->SP_Set_Role_Computations();
	
	//$return2 = array ( "staffID"=>$staffID,"posID"=>$posID,"roleCode1"=>$roleCode1,"roleCode2"=>$roleCode2,"ctRC"=>$ctRC,"funda"=>$funda,"fundID"=>$fundID );
	$return2 = array ("affected"=>$return);
		echo json_encode($return2);
		
	}
	
	
	public function primaryPostions( $staffID ){
		
		$this->load->model('roles/roledb_model','Rdb');
		$db = "role_org";
		$tType = "`role_position`";
		$select2 = "id AS PosID";
		$where = array("staff_id" => $staffID);
		$posID = $this->Rdb->getAll($db, $tType, $select2, $where);
		return $posID;
		
    }
	
}	