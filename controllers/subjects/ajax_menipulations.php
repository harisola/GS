<?php
class Ajax_menipulations extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}
	
	public function index(){
	$this->load->model('subjects/subject_model','SM');
	$this->SubjectList = $this->getSubList();
	$this->load->view('subjects/front_page');
	}
	
	public function rearangeOrder(){
		$this->load->model('subjects/subject_model','SM');
		$freturn =0;
		if( $this->input->post() ){
		$jsonstring = $this->input->post('jsonstring');
		$jsonDecoded = json_decode($jsonstring, true, 64);
		$readbleArray = $this->parseJsonArray( $jsonDecoded );


			foreach ($readbleArray as $key => $value) {
				if (is_array( $value )){
					$data = array( 'position' => $key,'parent_id' => $value['parentID']);
					$where = array( 'id' => $value['id'] );
					$tableName = 'subject';
					echo $freturn = $this->SM->overwrite( $tableName, $data, $where );
					unset($data,$where);
					}
				}
			}
		}
	
	
	public function parseJsonArray($jsonArray, $parentID = 0){
		$return = array();
		foreach ($jsonArray as $subArray) {
		$returnSubSubArray = array();
		if (isset($subArray['children'])) {
			$returnSubSubArray = $this->parseJsonArray($subArray['children'], $subArray['id']);
		}
			$return[] = array('id' => $subArray['id'], 'parentID' => $parentID);
			$return = array_merge($return, $returnSubSubArray);
		}
		return $return;
	}
	public function createSubject(){
		$sname = $this->input->post('sname');
		$sdname = $this->input->post('sdname');
		$spriority = $this->input->post('spriority');
		
		
		$this->load->model('subjects/subject_model','SM');
		$code = substr($sname,0,4);
		$data = array("name" => $sname, "dname" => $sname, "sname" => $sdname, "code" => $sdname, "parent_id" => 0 );
		$table_name = "subject";
		$sucess = $this->SM->set( $table_name, $data );
		if($sucess == 1){
			return 1;
		}else if($sucess == 2){
			return 2;
		}else if($sucess == 3){
			return 3;
		}
	}
	
	
	
	
	
		
	public function getSubList(){
		$this->load->model('subjects/subject_model','SM');
		$results = $this->SM->getModule();
		$HTML = "";
		if( $results ){
		$HTML .= '<ol class="dd-list">';
		foreach( $results as $row ){
				$HTML .= '<li class="dd-item" data-id="'.$row['id'].'">';
				$HTML .= '<div class="dd-handle">'.$row['name'].'<a class="pull-right btn-link" id="item_'.$row['id'].'"><i class="fa fa-close"></i>Edit</a></div>';
				$HTML .= $this->menu_showNested( $row['id'] );
				$HTML .= '</li>';
			}
			$HTML .= '</ol>';
		return $HTML;
		}else{
			return $HTML;
		}	
   }
	   
	public function menu_showNested($parentID) {
		$this->load->model('subjects/subject_model','SM');
		$results = $this->SM->menu_showNestedModel( $parentID );
		$HTML2 = "";
		if( $results ){
		$HTML2 .= '<ol class="dd-list">';
		foreach( $results as $row ){
			$HTML2 .=  '<li class="dd-item" data-id="'.$row['id'].'">';
			$HTML2 .=  '<div class="dd-handle">'.$row['name'].'<a class="pull-right btn-link" id="item_'.$row['id'].'"><i class="fa fa-close"></i>Edit</a></div>';
			$HTML2 .= 	$this->menu_showNested( $row['id'] );
			$HTML2 .= '</li>';
		}
		$HTML2 .= '</ol>';
		}
		return $HTML2;
	}
	
	
	public function get(){
		$this->SubjectList = $this->getSubList();
		$this->load->view('subjects/subject_list');
	}
	
	
	
	public function editable(){
		(int)$ID = $this->input->post('ID');
		$this->load->model('subjects/subject_model','SM');
		$select = "id,name,dname,sname,code";
		$where=array("id"=>$ID);
		$data['results'] = $this->SM->get($select,$where);
		$this->load->view('subjects/createSubjectForm',$data);
		
		
	}
	
	public function updateSub(){
		
		$this->load->model('subjects/subject_model','SM');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//$this->form_validation->set_rules('sname', 'name', 'required');
		//$this->form_validation->set_rules('sdname', 'Display name', 'required');
		//$this->form_validation->set_rules('scret_ID', 'hidden id', 'required');
		$sname = $this->input->post('sname');
		$sdname = $this->input->post('sdname');
		$ID = $this->input->post('scret_ID');
		$spriority = $this->input->post('spriority');
		
		
		

		//if ($this->form_validation->run() == FALSE){
			//redirect('/subjects/subjects', 'refresh');
		//}else{
			if( $ID != '' ){
			//(int)$IDD = $this->input->post('scret_ID');
			//$data	= array( "name" => $sname, "dname" => $sdname, "sname" => $sname );
			$data 	= array("name" => $sname, "dname" => $sname, "sname" => $sdname, "code" => $sdname);
			$where	= array( "id" => $ID );
			$tableName = 'subject';
			$this->SM->overwrite( $tableName, $data, $where );
			
			
			}else{
				$code = substr($sname,0,4);
				//$data = array("name" => $sname, "dname" => $sdname, "sname" => $sname, "code" => $code, "parent_id" => 0 );
				$data 	= array("name" => $sname, "dname" => $sname, "sname" => $sdname, "code" => $sdname , "parent_id" => 0 );
				$table_name = "subject";
				$this->SM->set( $table_name, $data );
			}
			
			$this->get();
			
			//$this->load->view('formsuccess');
		//}
	}
	
	public function getGradeProgrammme(){
		
		$this->load->model('subjects/subject_model','SM');
		$gradeID 	= $this->input->post("gradeID");
		$sessionID 	= $this->input->post("sessionID");
		$table_name = "programmesetup";
		$where = array( "sessionID" => $sessionID, "gradeID" => $gradeID, );
		$this->SM->removePSetup( $table_name, $where  );
		$counter = 0;
		if( $this->input->post("subjects")){
			$array_subject 	= $this->input->post("subjects");
			$options 	= $this->input->post("optional");
			if( $array_subject != '' ){
				$subjects = array_unique($array_subject);
			}
			if( $options != '' ){
				$optionals = array_unique($options);	
			}
			
			
			$op = array();
			if(!empty($optionals) ){
				foreach( $optionals as $o ){
					array_push($op, $o );
				}	
			}
		foreach($subjects as $sub ):
			if(!empty($op) ){
				if( in_array($sub,$op) ){
					$opt = 1;	
				}else{
					$opt =0;
				}
			}else{
				$opt =0;
			}
		if($sessionID > 0 && $gradeID > 0 && $sub > 0 ){
			$data = array(
			"sessionID" => $sessionID,
			"gradeID" => $gradeID,
			"subjects" => $sub,
			"optional" => $opt,
			"created" => time(),
			"register_by" => $this->session->userdata("user_id"),
			"modified" => time(),
			"modified_by"=> $this->session->userdata("user_id")
		);
			$sucess = $this->SM->setup( $table_name, $data );
		}
		$counter++;
		endforeach;	
		}
	}
	
	
	
	public function getR(){
		$this->load->model('subjects/subject_model','SM');
		$this->load->model('etab/teacher_side/teacher_side_model','TSM');
		
		$acID = $this->input->post("acID");
		$grID = $this->input->post("grID");
		$tablename = "`programmesetup`";
		$select = "`id`,`subjects`,`optional`";
		$where = array("sessionID" =>  $acID, "gradeID" =>  $grID );
		$su = array();
		$opt = array();
		$results = array();
		
		$db2="role_matrix";
		$table2 ="role_subject_teacher";
		$select2 ="count(id) AS programmes";
		$programmesIDs =0;
		if( $results = $this->SM->getR( $tablename,$select,$where )  ){ 
		
			foreach( $results AS $r ){ 
				$wh = array("program_id" => $r['id'] );
				$programmes = $this->TSM->getSingleRow( $db2, $table2, $select2, $wh );
				if( $programmes["programmes"] > 0 ){
					$programmesIDs++;
				}
				
			}
			
		}else{
			$results = array();	
		}
		
		
		
		
		if( !empty( $results )){
			
			foreach($results as $r ){
				array_push($su,$r["subjects"]);
				if( $r["optional"] == 1 ){
					array_push($opt,$r["subjects"] );	
				}
			}
			
		}else{
			$su = array();
		}
		
		if(!empty( $su )){
			if(!empty( $opt )){
				$this->SubjectList = $this->parentLi( $su, $opt );
			}else{
				$this->SubjectList = $this->parentLi($su,$opt = NULL );
			}
			
		}else{
			$this->SubjectList = $this->parentLi($su = NULL,$opt = NULL  );
		}
		
		if( $results != NULL ){
			$this->SubjectDList = $this->droppedList( $results,$acID,$grID  );	
		}else{
			$this->SubjectDList = $this->droppedList( $results = NULL,$acID,$grID );
		}
		$response = array( 'html' => $this->SubjectList , 'dhtml' => $this->SubjectDList, 'IDs' => $opt,"prgrmIDs"=>$programmesIDs );
		//$response = array( 'html' => $this->SubjectList , 'dhtml' => $count );
		
		echo json_encode($response);
	}
	public function parentLi($su = NULL,$opt = NULL){
		$this->load->model('subjects/subject_model','SM');
		$results = $this->SM->getModule();
		$firstZeor = true;
		$firstZeor2 = 0;
		$HTML = "";
		if( $results ){
			foreach( $results as $row ){
				$HTML .= '<div class="col col-2">';
				$HTML .= '<h5> '.$row['name'].'</h5>';
				if( $su != NULL ){
					if( $opt != NULL ){
						$HTML .= $this->childLi( $row['id'], $su, $opt);
					}else{
						$HTML .= $this->childLi( $row['id'], $su,$opt = NULL );
					}
				}else{
					$HTML .= $this->childLi( $row['id'], $su=NULL,$opt = NULL  );
				}
				$HTML .= '</div>';
				$firstZeor2++;
			}
		}
		return $HTML;
	}
   
  public function childLi($parentID , $su = NULL,$opt = NULL ) {
		$this->load->model('subjects/subject_model','SM');
		$results = $this->SM->menu_showNestedModel( $parentID );
		static $firstZeor2 = 1;
		$HTML2 = "";
		if( $results ){
		$HTML2 .= '<ol class="list-group rp-draggable">';
		foreach( $results as $row ){
			if( $su != NULL  ) {
				if( in_array($row['id'],$su ) ) {
					if( $opt != NULL  ) {
						if( in_array($row['id'],$opt ) ) {
							$HTML2 .=  '<li class="list-group-item list-group-item addedToFav" data-id="'.$row['id'].'" id="'.$row['id'].'" style="background-color: hsl(11, 64%, 91%);">';
						}else{
							$HTML2 .=  '<li class="list-group-item list-group-item addedToFav" data-id="'.$row['id'].'" id="'.$row['id'].'">';
						}
					}else{
						$HTML2 .=  '<li class="list-group-item list-group-item addedToFav" data-id="'.$row['id'].'" id="'.$row['id'].'">';
					}
				}else{
					$HTML2 .=  '<li class="list-group-item" data-id="'. $row['id'] .'" id="'.$row['id'].'">';
				}
		}else{
			$HTML2 .=  '<li class="list-group-item" data-id="'.$firstZeor2.'" id="'.$row['id'].'">';
		}
		$HTML2 .=  $row['dname'] .'<i class="fa fa-plus pull-right"></i>';
		if( $su != NULL ){
			if( $opt != NULL ){
				$HTML2 .= $this->childLi( $row['id'], $su, $opt);
			}else{
				$HTML2 .= $this->childLi( $row['id'], $su,$opt = NULL );
			}
		}else{
			$HTML2 .= $this->childLi( $row['id'], $su=NULL,$opt = NULL );
		}
			$HTML2 .= '</li>';
			$firstZeor2++;
		}
			$HTML2 .= '</ol>';
		$firstZeor2++;
		}
		return $HTML2; 
	}
	
	
	public function droppedList( $results = NULL,$acID = NULL,$grID = NULL   ){
		$this->load->model('subjects/subject_model','SM');
		$this->load->model('etab/teacher_side/teacher_side_model','TSM');
		
		
		
		$db2="role_matrix";
		$table2 ="role_subject_teacher";
		$select2 ="count(id) AS programmes";
		$programmesIDs =0;
		$cross = '';
		$boolean = true;
		$html = '<ol class="h-droped-list">';
		if( $results != NULL ){
			
			foreach( $results  as $subID ){
				$where =  array("id" => $subID['subjects'] );
				$results = $this->SM->getModuleWhere( $where );
				//$position = $results->position;
				
				$cross = '';
				$wh = array("program_id" => $subID['id'] );
				$programmes = $this->TSM->getSingleRow( $db2, $table2, $select2, $wh );
				
				if( $programmes["programmes"] > 0 ){
					//$cross = '<i class="fa fa-check pull-right"></i>';
					$cross = '';
				}else{
					$cross = '<i class="fa fa-plus pull-right"></i>';
				}
			
				
				//echo $programmes["programmes"]."<br />";
				
				$optnl = $subID['optional'];
				if( $optnl == 1){
					$html .= '<li id="'. $subID['subjects'].'" data-id="'. $subID['subjects'] .'" class="list-group-item addedToFav" style="background-color: hsl(11, 64%, 91%);">';
					$html .=$results->dname;
					$html .= $cross;
					
					$html .= '<span class="edit">Optional</span>';
					
				}else{
					$html .= '<li id="'. $subID['subjects'].'" data-id="'. $subID['subjects'] .'" class="list-group-item addedToFav">';
					$html .=$results->dname;
					//$html .= '<i class="fa fa-plus pull-right"></i>';
					$html .= $cross;
					
					$html .= '<span class="edit">Compulsory</span>';
					
				}
				if( $subID['optional'] == 1 ){
					$html .= '<div class="optH" style="display:block;">';
					$html .= '<input type="checkbox" name="optional[]" value="'.$subID['subjects'].'" checked="checked">  An Optional Programme';	
				}else{
					$html .= '<div class="optH" style="display:none;">';
					$html .= '<input type="checkbox" name="optional[]" value="'.$subID['subjects'].'">  Set This As An Optional Programme';
				}
				$html .= '</div>';	
				$html .= '</li>';
				$html .= '<input id="i'.$subID['subjects'].'" type="hidden" value="'. $subID['subjects'].'" name="subjects[]">';
				$boolean = false;
			}
			
			$html .= '<li class="placeholder" style="display: none;">  Empty! Grade Level Prgramme Setup  </li>';	
			$html .= '<input id="sessionID" type="hidden" value="'.$acID.'" name="sessionID">';
			$html .= '<input id="gradeID" type="hidden" value="'.$grID.'" name="gradeID">';
			$html .= '<input id="Hiddensubjects" type="hidden" value="1" name="Hiddensubjects">';
		}else{
			$html .= '<li class="placeholder">Empty! Grade Level Prgramme Setup</li>';	
			$html .= '<input id="sessionID" type="hidden" value="'.$acID.'" name="sessionID">';
			$html .= '<input id="gradeID" type="hidden" value="'.$grID.'" name="gradeID">';
			$html .= '<input id="Hiddensubjects" type="hidden" value="" name="Hiddensubjects">';
		}
		$html .= '</ol>';
		return $html;
	}
	
	public function getSection(){
		$jsonstring = $this->input->post('jsonstring');
		$this->load->model('subjects/subject_model','SM');
		$select = "*";
		$table_name = "gradeSections";
		$where =  array("gradeID" => $jsonstring );
		$results = $this->SM->getR( $table_name, $select, $where );
		//echo json_decode($results[0]->sectionID);
		$decoded = json_decode( $results[0]['sectionID'] );
		$html = "";
		$html .= "<label class='label'>Grade Section</label>";
		$html .= " <label class='select'>";
		$html .= "<select id='gradeSection'>";
		foreach($decoded as $d ){
			$html .= "<option value='".$d->id."'>".$d->name."</option>";
		}
		$html .= "</select>";
		$html .= "<i></i> </label>";
		echo $html;
	}
	
	// shifling
	
	public function programmOptions(){
		$this->load->model('subjects/subject_model','SM');
		$jsonstring = $this->input->post('jsonstring');
		$jsonDecoded = json_decode($jsonstring, true, 64);
		$SessionID = $jsonDecoded["sessionID"];
		$term = $jsonDecoded["term"];
		$GradeID = $jsonDecoded["gradeID"];
		
		$previous = (int)$jsonDecoded["_previous"];
		
		$login_user_id = $this->session->userdata("user_id"); //118 GAA
		$unique = $jsonDecoded["unique"]; //grd_15-std_6987-grp_1-ac_8-trm_1 
		
		$grpSbID = (int)$jsonDecoded["grpSbID"]; // subject id selected option programme
		$expldUnique = explode("-",$unique);
		
		
		
		$grd = $expldUnique[0]; // grade
		$std = $expldUnique[1]; // student
		$grp = $expldUnique[2]; // group
		
		$exstd = explode("_",$std);
		$exstd[0];
		$studentID = (int)$exstd[1];
		
		
		$exgrp = explode("_",$grp);
		$exgrp[0];
		$group_no = (int)$exgrp[1];
		$table ="subject_selection_student2";
		
		
		// Now get id from table subjectblock through `key` a_8_t_1_grd_16_grp_1_s_33
		// and concante that resultant ID with students id to table studentselectedblock and updated to record deleted
		
		$select1 = "ID";
		if( $previous == 0 ){
			$uniqueKey1 = "a_".$SessionID."_t_".$term."_grd_".$GradeID."_grp_".$group_no."_s_".$grpSbID;
		}else{
			$uniqueKey1 = "a_".$SessionID."_t_".$term."_grd_".$GradeID."_grp_".$group_no."_s_".$previous;
		}
		
		$subjectblock = "subjectblock";
		$where = array( '`key`' => $uniqueKey1 );
		if( $this->SM->getSingleRow( $subjectblock, $select1, $where ) ){
			
			$subjectblockID = $this->SM->getSingleRow( $subjectblock, $select1, $where );
			$subjectblckID = (int)$subjectblockID->ID;
			
			
			$table2  = 'studentselectedblock';
			$select2 = "`key` AS Key_key";
			$where2 = array("blockID" => $subjectblckID );
			$subjectblckID2 = $this->SM->getSingleRow( $table2, $select2, $where2 );
			if( !empty( $subjectblckID2 ) ){
				
				$data3 = array( "studentID"=>0,"modified" => time(), "modified_by" => $login_user_id,"record_deleted" => 1 );
				$where3 = array( "blockID" => $subjectblckID, "studentID"=> $studentID );
				
				$updated = $this->SM->overwrite($table2,$data3, $where3 );
				
			}else{ $updated =0; }
				
			
		}else{
			$subjectblckID = 0;
			$updated = 0;
		}
		
		
		
		$select4 = "ID";
		$where4 = array( "grdStdGrp"=>$unique,"record_deleted" => 0 );
		$subSlctnStd2ID = $this->SM->getSingleRow( $table, $select4, $where4 );
		$record = 'I';
		if( !empty( $subSlctnStd2ID ) ){
			
			$data4  = array( "modified"=>time(), "modified_by" => $login_user_id,"record_deleted" => 1 );
			$this->SM->overwrite($table,$data4,$where4 );
			$record = 'U';
			
		}
			
		$data = array(
			"grdStdGrp"=>$unique,
			"subject_selection_grade_id"=>$grpSbID,
			"student_id"=>$studentID,
			"grade_id"=>$GradeID,
			"group_no" => $group_no,
			"session"=> $SessionID,
			"term" => $term,
			"created" => time(),
			"register_by" => $login_user_id,
			"record_deleted" => 0
		);
		
		//$this->SM->setupReplace( $table, $data  );
		
		$this->SM->setup( $table, $data );
		
	
		
		$data3 = array( "grade_id" => $GradeID, "group_no"=>$group_no, "subject_selection_grade_id" => $grpSbID, "record_deleted" => 0 );
		
		$thisSubject = $this->SM->countData( $table, $data3 );
				
		$data4 = array( "grade_id" => $GradeID, "group_no"=>$group_no, 'subject_selection_grade_id != ' => 0, "record_deleted" => 0 );
		$groupTotal = $this->SM->countData( $table, $data4 );
		
		$encode = array( "thisSubject"=>$thisSubject,"groupTotal"=>$groupTotal, "subjectblockKEy" => $uniqueKey1,"blockID" => $subjectblckID,"key_student2"=>$unique,"updated"=>$updated, "student2"=>$record );
		
		$return = json_encode($encode,true,64);
		echo $return;
		
		//var_dump( $jsonDecoded["groupID"] );
		//foreach( $jsonDecoded["studentID"] as $std ){ echo $std; }
		//foreach( $jsonDecoded["groupID"] as $grd ){ echo $grd; }
	
	}
	
	public function createHeader($noOfGroup){
		
		$header = '';
		//$header .= '';
		$header .= '<tr>';
		$header .= '<th class="thtext">#</th>';
		$header .= '<th class="thtext">GS-ID</th>';
		$header .= '<th class="thtext">Abridge Name</th>';
		$header .= '<th class="thtext">Gender </th>';
		$header .= '<th class="thtext">section </th>';
		$header .= '<th class="thtext">status </th>';
		$al = "A";
		
		for($l = 1; $l<=$noOfGroup;$l++){
			$header .= '<th class="thtext">Group '.$al.' </th>';
			$al++;
		}
		
		$header .= '</tr>';
		return $header;
 
	}
	
	public function getGroups(){
		$this->load->model('subjects/subject_model','SM');
		(int)$grdID = $this->input->post('jsonstring');
		
		(int)$sessionID = $this->input->post('sessionID');
		(int)$term = $this->input->post('term');
		
		if( $this->gradeGroups($grdID,$sessionID,$term) ){
			$data["groups"] = $this->gradeGroups($grdID,$sessionID,$term);
		}else{
			$data["groups"] = NULL;	
		}
		
		
		$grdGrpSubjects = "";
		$countGroup = "A";
		$noOfGroup = 1;
		
		$grdStudents = '';
		$grdStdnts = $this->getGradeStudents($grdID,$sessionID,$term);
		
		$grdStudents	= $grdStdnts["students"];
		$totalStudent	= $grdStdnts["totalStudent"];
		$totalGroups = count( $data["groups"] ); 		
		$header = $this->createHeader( $totalGroups );
		
		
		if( $data["groups"] != NULL ){
			
			foreach( $data["groups"] as $grpsID ){
				
				$grdGrpSubjects .= $this->grdGrpSubjectsUlFormate( $grdID, $grpsID["GroupID"], $countGroup, $sessionID, $noOfGroup,$term,$totalStudent );
				$countGroup++;
				$noOfGroup++;
			}
		}else{
			
			$html = '';
			$html .= '<div class="col-md-2" style="margin-right:40px;margin-bottom:10px;">';
			$html .= '<span> No Group Created </span>';
			$html .= '<br />';
			$html .= '<ol class="list-group">';
			$html .= '<li class="list-group-item">No Group Subjects Found</li>';
			$html .= '</ol>';
			$html .= '</div>';
			$grdGrpSubjects = $html;
			$noOfGroup = 0;
		}
		
		
		//echo $grdGrpSubjects;
		$response = array("grpSbjLst"=>$grdGrpSubjects, "grdStdnt" => $grdStudents, "noOfGroup"=>$noOfGroup, "header"=>$header);
		echo json_encode($response);
		
		
	}
	public function gradeGroups($grdID , $acadmic,$term ){
		$this->load->model('subjects/subject_model','SM');
		$grdID = $grdID;
		$tablename = "`subject_selection_group_grade`";
		$select = "`subject_selection_group_id` AS `GroupID`";
		$where = array("academic_session_id" => $acadmic, "grade_id" =>  $grdID, "record_deleted" => 0);
		if( $this->SM->getDistinct( $tablename, $select, $where) ){
			$groupID = $this->SM->getDistinct( $tablename, $select, $where);		
		}else{
			$groupID = NULL;
		}
		return $groupID;
	}
	
	public function grdGrpSubjects($grdID, $grpID,$acadmic,$studentID, $wherere=NULL,$class,$term){
		$this->load->model('subjects/subject_model','SM');
		$grdID = $grdID;
		$html  = "";
		//$html .= '<input class="groupHideID" type="hidden" name="groupHideID[]" value="'.$grpID.'"  id="group_'.$grpID.'" />';
	
		
		$tablename = "`subject_selection_group_grade`";
		$tbl2 = "subject";
		$select = "`subject_id` AS `subjectID`";
		$select2 = "`subject`.`id`,`subject`.`dname`";
		$onOpt = "subject_selection_group_grade.subject_id = subject.id";
		
		$where = array("academic_session_id" => $acadmic, "grade_id" =>  $grdID, "subject_selection_group_id" =>$grpID, "record_deleted" => 0);
		$html .= '<label class="select">';
		
        $html .= '<select name="groupID[]" class="groupID '.$class.'"  id="grd_'.$grdID.'-std_'.$studentID.'-grp_'.$grpID.'-ac_'.$acadmic.'-trm_'.$term.'">';
		$html .= '<option value=""> Blank </option>';
		
		if( $grdGrpSubID = $this->SM->getR( $tablename, $select, $where) ){
			//$grdGrpSubID = $this->SM->getR( $tablename, $select, $where);	
			foreach( $grdGrpSubID as $sID ){
				//$html .= '<option value="">'.$sID["subjectID"].'</option>';
				$where2 = array( "`subject`.`id`" => $sID["subjectID"] );
				$subids = $this->SM->join(  $tbl2, $tablename, $onOpt, $select2, $where2 );
				if( !empty($subids ) ) {
					if( $wherere == NULL ){
						foreach( $subids as $subN ){
							$html .= '<option value="'.$subN["id"].'">'.$subN["dname"].'</option>';	
						}
					}else{
						foreach( $subids as $subN ){
							if( in_array( $subN["id"],$wherere) ){
								$html .= '<option value="'.$subN["id"].'" selected>'.$subN["dname"].'</option>';		
							}else{
								$html .= '<option value="'.$subN["id"].'">'.$subN["dname"].'</option>';	
							}
						}
					}
				}
			}
		}
		$html .= '</select><i></i></label>';
		return $html;
	}
	
	public function grdGrpSubjectsUlFormate($grdID, $grpID,$countGroup,$acadmic,$noOfGroup,$term,$totalStudent){
		$this->load->model('subjects/subject_model','SM');
		$grdID = $grdID;
		$html  = "";
		$tablename = "`subject_selection_group_grade` AS `a`";
		$tbl2 = "`subject` AS `b`";
		$select = "`subject_id` AS `subjectID`";
		$select2 = "b.`dname`";
		$onOpt = "a.subject_id=b.id";
		$where = array( "academic_session_id" => $acadmic, "grade_id" =>  $grdID, "subject_selection_group_id" =>$grpID, "record_deleted" => 0);
		
		$tablename3 = "`subject_selection_student2`";
		
		$countSubject = 0;
		
			
		$html .= '<div class="col-md-2" style="margin-right:40px;margin-bottom:10px;">';
		if( $grdGrpSubID = $this->SM->getR( $tablename, $select, $where) ){
			//$grdGrpSubID = $this->SM->getR( $tablename, $select, $where);
			
			$html .= '<span> Group '.$countGroup .'</span>';
			$html2 = '';
			$blanked =0;
			$html .= '<br />';
			$html .= '<ol class="list-group" id="group_'.$noOfGroup.'">';
			$html2 = '<ul id="group_'.$noOfGroup.'" style="display:none">';
			foreach( $grdGrpSubID as $sID ){
				$where2 = array( "`b`.`id`" => $sID["subjectID"] );
				$subids = $this->SM->join(  $tbl2, $tablename, $onOpt, $select2, $where2 );
$where3 = array( "subject_selection_grade_id" => $sID["subjectID"], "grade_id" =>$grdID, "group_no"=>$noOfGroup,
 'subject_selection_grade_id >' => 0, "session"=>$acadmic, "term"=>$term, "record_deleted" => 0 );
				$countSubject = $this->SM->countAll( $tablename3, $where3);
				if( !empty($subids ) ) {
					foreach( $subids as $subN ){
						//$html .= '<option value="">'.$subN["dname"].'</option>';	
						
						$html .= '<li class="list-group-item"><a href="'.base_url().'index.php/subjects/option_level_allocation?grade='.$grdID.'&group='.$noOfGroup.'&subject='.$sID["subjectID"].'">' . $subN["dname"].'</a><span class="badge" id=grdgrp_'.$noOfGroup.'_'.$sID["subjectID"].'>'.$countSubject.'</span></li>';
						$blanked += $countSubject;
						$html2 .= '<li></li>';
						
					}
				}
			}
			
			
			
			$html .= '<li class="list-group-item">Total<span class="badge" id="total_'.$noOfGroup.'">'.$blanked.'</span></li>';
			
			if( $totalStudent > 0 ){
			$grandtotal =  $blanked-$totalStudent;
			}else{
				$grandtotal = 0;
			}
			$html .= '<li class="list-group-item">Blank<span class="badge" id="blanked_'.$noOfGroup.'">'.$grandtotal.'</span></li>';
			
			$html2 .= '</ul>';
			$html .= '</ol>';
		}
		$html .= '<input type="hidden" id="totalGrdStd" name="gtoal" value="'.$totalStudent.'" /></div>';	
		
		//$return = array("html"=>$html,"html2"=>$html2);
		return $html;
	}
	
	
	public function getGradeStudents($grdID, $sessionID, $term ){
		$this->load->model('subjects/subject_model','SM');
		$counter = 1;
		$html = '';
		$grdStudents = $this->SM->getGrdStudents( $grdID, $sessionID );
//		exit;
		
		$totalStd = sizeof($grdStudents);
		
		if(!empty($grdStudents)){
		$groups = $this->gradeGroups($grdID, $sessionID,$term);
		
		$countgroups = count( $groups );
		

			$html .= '<thead>';
			$html .= '<tr>';
			$html .= '<th>#</th>';
			$html .= '<th>GS-ID</th>';
			$html .= '<th>Abridge Name</th>';
			$html .= '<th>Gender</th>';
			$html .= '<th>Section</th>';
			$html .= '<th>Status</th>';
			if($countgroups > 0 ){
				$g = "A";
				for($a=1;$a<=$countgroups;$a++){
					$html .= '<th>Groups '. $g .'</th>';
					$g++;
				}
			}
			
			
			$html .= '</tr>';
			$html .= '</thead>';
		
		$html .= '<tbody>';
			foreach($grdStudents as $stdnt){
				//$html .= '<input type="hidden" name="studentID[]" value="'.$stdnt['id'].'" />';
				//$html .= '<td><span class="num">'.$counter.'</span></td>';
				
				$html .= '<tr>';
				$html .= '<td>'.$counter.'</td>';
				$html .= '<td>'.$stdnt['gs_id'].'</td>';
				$html .= '<td>'. trim($stdnt['abridged_name']).'</td>';
				//$html .= '<h5>';
				//$html .= trim($stdnt['abridged_name']);
				//$html .= '</h5>';
				//$html .= '</td>';
				
				$html .= '<td>';
				if($stdnt['gender'] == 'B')
					$gender = "Boy";
				else
					$gender = "Girl";
				
				$html .= $gender;
				
				$html .= '</td>';
				
				$html .= '<td>'.$stdnt['section'].'</td>';
				
				
				$html .= '<td>'.ucfirst($stdnt['status']).'</td>';
				
				$stid = $stdnt['id'];
				
				if(!empty($groups)){
					$tablename = "subject_selection_student2";
					$select = "subject_selection_grade_id as sID";
					foreach( $groups as $grpsID ){
						$GroupID = $grpsID["GroupID"];
						//grd_1-std_6023-grp_1-ac_5-trm_1
						$unique = "grd_".$grdID."-std_".$stid."-grp_".$GroupID."-ac_".$sessionID."-trm_".$term;
						//$where = array("grdStdGrp"=> $unique,'subject_selection_grade_id !=' => 0 );
						$where = array("grdStdGrp"=> $unique,'subject_selection_grade_id !=' => 0, "record_deleted" => 0 );
						$stdoptprgtmp = $this->SM->getR( $tablename, $select, $where);
						if(!empty( $stdoptprgtmp )){
							$where = array();
							foreach($stdoptprgtmp as $s ){ array_push($where,$s["sID"]); }
							$class = "has-success";
							//if( $grpsID["GroupID"] != 0 ){ $class = "has-success"; }else{ $class = "haswarning"; }
							
							$html .= '<td>';
								$html .= $this->grdGrpSubjects($grdID, $grpsID["GroupID"], $sessionID, $stid, $where,$class,$term );
							$html .= '</td>';
						}else{
							$class = "haswarning";
							$html .= '<td>';
								$html .= $this->grdGrpSubjects($grdID, $grpsID["GroupID"], $sessionID, $stid,$where =NULL,$class,$term );
							$html .= '</td>';	
						}
					}
				}
				$html .= '</tr>';
				$counter++;
			}
		}else{
			$html .= '<tr>';
				$html .= '<td colspan="5">No Record Found!';
				$html .= '<td>';
			$html .= '</tr>';
		}
		$html .= '</tbody>';
		$return = array( "students" => $html, "totalStudent" => $totalStd);
		return $return;
	}

	

}
?>