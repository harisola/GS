<?php
class Option_level_allocation extends MY_Controller{
	function __construct() {
		parent::__construct();
	}
	
	public function index(){
		$this->load->model('autocomplete/anotherdb_model','ANM');
		$data['grades'] = $this->ANM->getSomething();
		
		if( $this->input->get('grade', TRUE ) ){
			
			$this->load->model('subjects/subject_model','SM');
			$gradesID =  $this->input->get('grade', TRUE);
			$groupID =  $this->input->get('group', TRUE);
			$subjectID =  $this->input->get('subject', TRUE);
			
			$data['gradesID'] = $gradesID;
			$data['group'] = $groupID;
			$data['subjectID'] = $subjectID;
			$tablename = "subject";
			$select 			= "dname";
			$where = array("id" => $subjectID);
			$data['subjectname'] = $this->SM->getSingleRow( $tablename, $select, $where );
			//$subjectname->dname;
			
			
			
				$this->load->model('etab/teacher_side/teacher_side_model', 'ETM');
		
		$login_user_id = $this->session->userdata("user_id"); //118 GAA
		$reg_user = $this->ETM->getStaffID( $login_user_id );
		$reg_user_id = $reg_user['id'];
		//exit;
		$branch_id = (int)$reg_user['branch_id'];
		
		
		$this->load->model('etab/academic/academic_model','AM');
		$sessions = $this->AM->getSession($branch_id);
		$c_sss_id = $sessions[0]["id"];
		
		$sessionsTerm = $this->AM->getSesstrm($c_sss_id);
		$term = (int)$sessionsTerm[0]["TermID"];
		
		//$term = 1;
		$acadmic = $c_sss_id;
		
			
		$tablename3 = "`subject_selection_student2`";	
		$where3 = array(
			"subject_selection_grade_id" => $subjectID, 
			"grade_id" =>$gradesID, 
			"group_no"=>$groupID, 
			'subject_selection_grade_id !=' => 1,
			"session"=>$c_sss_id, 
			"term"=>$term );
		//$data['countStudents'] = $this->SM->countAll( $tablename3, $where3);
		$select3 = "subject_selection_grade_id AS subjectsID";
		$grdGrpSubID = $this->SM->getR( $tablename3, $select3, $where3);
		
		
		
		
		$data['countStudents'] = sizeof($grdGrpSubID);
		
		$table1 = "subject AS a";
		$table2 = "subject_selection_student2 AS b";
		$joinOn = "b.subject_selection_grade_id = a.id";
		$where2 = array("b.grade_id" =>$gradesID, "b.group_no"=>$groupID, 'b.subject_selection_grade_id !=' => 1, "b.session"=>$c_sss_id, 
			"b.term"=>$term);
		$select2  = "a.id, a.name";
		$data['optSubjects'] = $this->SM->joinSubjects( $table1, $table2, $joinOn, $select2, $where2 );
		
		
	
		
		
	
		
		
		
		}else{
			redirect(base_url('index.php/subjects/programme_option_selection'));
		}
		
		
		$unique = "a_".$acadmic."_t_".$term."_grd_".$gradesID."_grp_".$groupID."_s_".$subjectID."";
		
		$key = $this->getSbtBl( $unique );
		
		//$key = $this->getSbtBl( $acadmic,$term,$gradesID,$groupID,$subjectID);
	//var_dump( $key ); exit;
		if(!empty($key)){
			
			$ID = $key->ID;
			//echo "<br />";
			$blkID =  $key->block;
			///exit;
			$data["totalBlock"] = $blkID;
			$data["blockHTML"] = $this->createBlock((int)$ID, (int)$blkID );
			
			$html = $this->subjectStudents( $acadmic, $term, $gradesID, $groupID, $subjectID,$blkID,$ID );
			
			$data["student"] = $html["html"];
			$data["ulList"] = $html["html2"];
			
			//var_dump( $html );
			//exit;
			
			$this->load->view("subjects/option_allocation/option_allocation2",$data);
		}else{
			
			$this->load->view("subjects/option_allocation/option_allocation",$data);
			
		}
		
		$this->load->view("subjects/option_allocation/footer");	
		
		
		
		
	}
	
	
	public function gradeGroups2($grdID , $acadmic ){
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
	
	
	
	public function getSbtBl( $unique ){
		//public function getSbtBl( $acadmic,$term,$gradesID,$groupID,$subjectID ){
		$this->load->model('subjects/subject_model','SM');
		$tablename = "subjectblock";
		$where = array( "key" => $unique );
		//$where = array( "key" => $unique );
		$select = "ID,block";
		$key = $this->SM->getSingleRow( $tablename, $select, $where );
		return $key;
	}
	
	
	public function createBlock( $blockID, $subjectBlock ){
		$this->load->model('subjects/subject_model','SM');
			
		$DB = "default";
		$tbl1= "student_registered";
		$select = "gender";
		$tbl2 = "studentselectedblock";
		$select = "studentID,subjectBlock";
		$select2 = "gender";
		$html = '';
		$html .= '<table class="table" style="" id="FixedDiv">';
		$html .= '<tr>';
		$html .= '<th> Group </th>';
		$html .= '<th> Boys </th>';
		$html .= '<th> Girls </th>';
		$html .= '<th> Total </th>';
		$html .= '</tr>';
		for($loop = 1; $loop<=$subjectBlock; $loop++){
			$where = array( "blockID" => $blockID,"subjectBlock"=>$loop );
			//$where = array( "blockID" => $blockID,"subjectBlock"=>$loop,"record_deleted"=>0  );
			$blockData = $this->SM->getR( $tbl2, $select, $where );
			$total = count( $blockData );
			$boy=0;
			$girl=0;
			if( !empty( $blockData ) ){
				
			
			 foreach( $blockData as $row ){
				$where2 = array("id" => $row["studentID"] );
				$singleStd = $this->SM->getSingleRow2( $DB, $tbl1, $select2, $where2 );	
				if( $singleStd->gender == 'B' ){
					$boy++;
				}else{
					$girl++;
				}
				}
		}	
				$subtotal = $boy + $girl;
				$html .= '<tr>';
			$html .= '<td>'.$loop.'</td>';
			$html .= '<td><span  id="boy_'.$loop.'">'.$boy.'</span></td>';
			$html .= '<td id="girl_'.$loop.'">'.$girl.'</td>';
			$html .= '<td id="total_'.$loop.'">'.$subtotal.'</td>';
			$html .= '</tr>';
			}
			$html .= '</table>';
			return $html;
	}
	
	
	
	
	
	public function createDropDown( $block, $ID ,$subjectBlock){
		$html = '';
		$html .= '<label class="select">';
        $html .= '<select class="blockDropdown" id="'.$ID.'">';
		$html .= '<option value=""> Choose </option>';
		for( $row = 1; $row <= $block; $row++ ){
			$selected="";
			if($subjectBlock != '' ){
				if( $row == $subjectBlock ){
					$selected="selected";
				}
			}else{
				$selected="";
			}
			
			$html .= '<option value="'.$row.'" '.$selected.' >'.$row.'</option>';
		}
		$html .= '</select><i></i></label>';
		
		return $html;
	}
	
	
	public function subjectStudents( $sessionID, $term, $gradesID, $groupID, $subjectID,$blockID,$ID ){
		$this->load->model('subjects/subject_model','SM');
		$DB = "subject";
		$tbl1= "studentselectedblock";
		$select2 = "subjectBlock";
		$results = $this->SM->getStd( $sessionID, $term, $gradesID, $groupID, $subjectID );
		
		
		
		$html = '';
		$html2 = '';
		$html2 .= '<ul id="listID">';
		$html .= '<table class="table table-striped table-bordered table-hover" style="width:100%" id="subjectStudents">';
		$html .= '<tbody>';
		$counter = 1;
		foreach( $results as $r ):
			$html .= '<tr>';
			//$html .= '<input type="hidden" name="studentID[]" value='.$r["id"].' />';
			$html .= '<td width="1%">';
			$html .= '<span class="num">';
			$html .= $counter;
			$html .= '</span>';
			$html .= '</td>';
			$html .= '<td width="3%">'.$r["GS-ID"].'</td>';
			$html .= '<td width="13%">';
			$html .= '<h5>'.$r["Full Name"].'</h5>';
			$html .= '<input type="hidden" value="'.$r["Gender"].'" id="gndr_'.$r["id"].'" />';
			$html .= '<input type="hidden" value="'.$ID.'" name="blockID" />';
			$html .= '</td>';
			
			
			$html .= '<td width="3%">'.$r["Gender"].'</td>';
			$html .= '<td width="3%">'.$r["section"].'</td>';
			$html .= '<td width="3%">'.$r["status"].'</td>';
			
			$html .= ' <td width="3%">';
			$where2 = array("studentID" => $r["id"], "blockID" => $ID );
			if(  $singleStd = $this->SM->getSingleRow2( $DB, $tbl1, $select2, $where2 ) ){
				$subjectBlock = $singleStd->subjectBlock;	
				$html .= $this->createDropDown( $blockID, $r["key"],$subjectBlock );
				$html2 .= '<li value="'.$r["id"].'">'.$subjectBlock.'</li>';
			}else{
				$html .= $this->createDropDown( $blockID, $r["key"],$subjectBlock='' );
			}
			
			$html .= '</td>';
			
			$counter++;
			$html .= '</tr>';
			
			
			
		endforeach;
		$html .= '</tbody>';
		$html .= '</table>';
		$html2 .= '</ul>';
		$return = array("html"=>$html, "html2" => $html2 );
		return $return;
	}
	
	
}	