<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Define_process extends MY_Controller {
	public function __construct(){
		parent::__construct();	
	}

	public function index(){
		
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETM');
		$this->load->library('user_agent');
	
		
		$user_id 			 = (int)$this->input->get("user_id");
		$programmeID 		 = (int)$this->input->get("programmeID");
		$sectionID 			 = (int)$this->input->get("sectionID");
		$matrixRoleID 		 = (int)$this->input->get("matrixRoleSbjTchrID");
		$grdID 			     = (int)$this->input->get("gradeID");
		$subjectID 			 = (int)$this->input->get("subjectID");
		$Grade 				 = $this->input->get("Grade");
		$Subject 			 = $this->input->get("Subject");
		$subjectCode 		 = $this->input->get("subjectCode");
		$secName 		 	 = $this->input->get("secName");
		$optional 			 = $this->input->get("optional");
		$GPID 				 = $this->input->get("GPID");
		$gpp_id 				 = $this->input->get("gpp_id");
		
		

		
		$user_id = urldecode($user_id);
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
		
	
		
		if( $reg_user_id == $user_id ){
			// do nothing.
		}else{
		  //redirect(site_url('logout'));
	   }
        
		
		$acd = $c_sss_id;
		//exit;
		
		
		$db2 = "role_matrix";
		$tablename = "`role_subject_teacher`";
		$where = array("staff_id"=>$user_id,"id"=>$matrixRoleID,"program_id"=>$programmeID,"section_id"=>$sectionID,"academic_session_id"=> $acd );
		
		
		
		
		
		
		$select = "id,program_id";
		$roleResult = $this->ETM->getSingleRow( $db2,  $tablename, $select, $where );
		//var_dump( $roleResult );
		//exit;
		
		// Get grade subject category
		// And its cateogry type
		$browser = $this->agent->browser();
		//echo "<br />";
		$ip = $this->input->ip_address();
		$user_agent = $this->input->user_agent();
		$data["user_agent"] = array("browser"=>$browser,"ip"=>$ip,"user_agent"=>$user_agent,"user_id"=>$reg_user_id);
		
		
		$this->data['css_buttons'] = $this->load->view('css_beautiful/buttons2');
		if( $roleResult != NULL ){
			
			//$data['gSbjCat'] = $this->gtGrdSbjtCtSbCt($grdID, $subjectID,$acd,$term,$sectionID );
			$data['gSbjCat'] = $this->gtGrdSbjtCtSbCt($programmeID, $grdID, $subjectID,$acd,$term,$sectionID,$matrixRoleID,$optional );
			
			$data["variables"] = array("user_id"=>$user_id,"programmeID"=>$programmeID,"sectionID"=>$sectionID,"matrixRoleID"=>$matrixRoleID,"grdID"=>$grdID,"subjectID"=>$subjectID,"Grade"=>$Grade,"Subject"=>$Subject,"subjectCode"=>$subjectCode,"secName"=>$secName,"optional"=>$optional,"GPID"=>$GPID,"gpp_id"=>$gpp_id,"academic"=>$c_sss_id,"term" => $term);
			
			
			$this->load->view('process/setup/process_setup_form_orb',$data);
		}else{
			$this->load->view('process/setup/process_setup_form_orb2');
		}
		
		$this->load->view('process/setup/process_setup_footer_orb');	
	}

	// Get Grade Subject category and its subcategory
	// Like Formmative -> Class Work
	
	//public function gtGrdSbjtCtSbCt($grdID, $subjectID,$acd,$term,$sectionID  ){
	public function gtGrdSbjtCtSbCt($programmeID, $grdID, $subjectID,$acd,$term,$sectionID,$matrixRoleID,$optional  ){
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETM');
		$table3 = 'atif_assessment.`assessment_category` AS `a`';
		$table4 = 'atif_assessment.`gradesubjectass` AS `b`';
		//$table5 = 'atif_assessment.`assessment_type` AS `c`';
		$select2 = 'a.id AS catID ,a.dname AS catName';
		$ON2 = 'a.id = b.assessment_category_id';
		$where2 = array('a.status' => 1,'b.grade_id'=>$grdID,"b.subject_id"=>$subjectID, "b.assessment_term_id"=> $term,"b.academic_session_id"=> $acd, 'b.weightage > '=>0, 'b.record_deleted' => 0);
		//$where2 = array( 'a.status' => 1, 'b.program_id'=>$programmeID, "b.assessment_term_id"=> $term, "b.academic_session_id"=> $acd, 'b.weightage > '=>0, 'b.record_deleted' => 0);
		
		$grdCategories = $this->ETM->joinTwoTables( $table3, $table4, $ON2, $select2, $where2 );
		
		
		$table5 = 'atif_assessment.`assessment_type` AS `a`';
		$table6 = 'atif_assessment.`gradesubjectass` AS `b`';
		
		//$select3 = 'a.id AS catID2 ,a.name AS catName,b.id AS Ass_in_grade_id';
		$select3 = 'a.id AS catID2 ,a.name AS catName,b.id AS Ass_in_grade_id, b.weightage AS giveMarks,comments AS Comments';
		$ON3 = 'a.id = b.assessment_type_id';
		
		
		$html = '';
		//$html .='';
		if( $grdCategories != NULL ){
			
		foreach($grdCategories AS $gs ){
			$catID = $gs["catID"];
			$catName = $gs["catName"];
			//$Ass_in_grade_id = $gs["Ass_in_grade_id"];
			
			$where3 = array('b.grade_id'=>$grdID,"b.subject_id"=>$subjectID,'b.assessment_category_id'=>$catID,'b.assessment_term_id'=>$term, 'b.academic_session_id'=>$acd, 'b.weightage > '=>0, 'b.record_deleted' => 0);
			
			$types = $this->ETM->joinTwoTables( $table5, $table6, $ON3, $select3, $where3 );
			if(!empty($types)){
			foreach($types AS $type ){
				
				$ID = "processtable_".$grdID."_".$subjectID."_".$catID."_".$type["catID2"]."_".$type["Ass_in_grade_id"];
				
				$html .='<div class="panel panel-grey margin-bottom-40">';
				$html .='<div class="panel-heading" style="">';
				$title = $catName .' | '. strtoupper( $type["catName"] ) ;
				$html .='<h3 class="panel-title" title="'.$title.'">';
				$html .='<i class="fa fa-edit" title="'.$title.'"></i>';
				$html .= $catName .'<small style="color:#fff;"><b>'. strtoupper( $type["catName"] ) . '</b></small>';
				$html .='<a href="#" class="btn-minmax pull-right"> <i class="fa fa-chevron-circle-down" title="Show Sub Assessment"></i></a>';
				$html .='<i class="fa-1x entypo-list-add pull-right cursor" id="'.$ID.'" title="Creat Sub Assessment"></i>';
				$html .='</h3>';
				/*$html .='<h3 class="panel-title">';
				$html .='<i class="fa fa-edit"></i>';
				//$html .= $catName .' : '. strtoupper( $type["catName"] );
				$html .= $catName .'<small style="color:#fff;">'. strtoupper( $type["catName"] ) . '</small>';
				$html .='<a href="#" class="btn-minmax pull-right"> <i class="fa fa-chevron-circle-down"></i></a>';
				$html .='<i class="fa-1x entypo-list-add pull-right cursor" id="'.$ID.'"></i>';
				$html .='</h3>';*/
				
				$html .='</div>';
				$html .='<div class="panel-body"  style="display: none;">';
				
				//$html .='<p>Some default panel content here. Nulla vitae elit libero, a pharetra augue.</p>';
				// this id contains grade id subject id category id and cat type id.
				
				if( $type["Comments"] != '' ){
					$html .='<p> '. $type["Comments"] . '</p>';
				}
				//$html .= '<p><abbr title="Marks must be less than or equals to Given Marks">Given Weightage </abbr><b>'. $type["giveMarks"] . '</b></p>';
				
				$html .= '<p><abbr title="Marks must be less than or equals to Given Marks">Given Weightage  </abbr><b>'. $type["giveMarks"] . ' %</b></p>';
				
				
				$html .= '<input id="Ass_in_grade_id2" type="hidden" value="'.$type["Ass_in_grade_id"].'">';
				$html .='<table class="tables table table-bordered setup_process_table" title="'.$catName .' : '. strtoupper( $type["catName"] ).'" id="assCatID_'.$type["Ass_in_grade_id"].'">';
				
					$html .='<thead>';
						$html .='<tr>';
							$html .='<th>#</th>';
							$html .='<th>Type Name</th>';
							//$html .='<th>Due Date</th>';
							$html .='<th> Grade Students </th>';
							$html .='<th> Action </th>';
						$html .='</tr>';
					$html .='</thead>';
						$html .='<tbody>';
						$html .= $this->getDetail( $type["Ass_in_grade_id"],$sectionID,$matrixRoleID,$optional );
						$html .='</tbody>';
					$html .='</table>';
				$html .='</div>';
				$html .='</div>';
			
			}// end foreach types
		}
		} // End foreach retrieve array data main category
	}
		return $html;
	}
	

	public function getDetail( $AssInGradeId,$sectionID,$matrixRoleID,$optional ){
		$this->load->model('etab/teacher_side/teacher_side_model','DBB');
		$db = "subject_grade";
		$table = "assessment_detail";
		$select = "id AS ID, date AS dt, title AS Title,is_active,created AS crtdDate,ignore";
		//$where = array("assessment_in_grade_id"=>$AssInGradeId,"sectionID"=>$sectionID,"role_id" =>$matrixRoleID, "record_deleted"=>0);
		
		//$where = array("assessment_in_grade_id"=>$AssInGradeId,"sectionID"=>$sectionID,"record_deleted"=>0);
		
		if( $optional == 1 ){
			$where = array("assessment_in_grade_id"=>$AssInGradeId,"sectionID"=>$sectionID,"role_id" =>$matrixRoleID, "record_deleted"=>0);
		}else{
			$where = array("assessment_in_grade_id"=>$AssInGradeId,"sectionID"=>$sectionID, "record_deleted"=>0);
		}
		
		$results = $this->DBB->getAll( $db, $table, $select, $where );
		$nowTime = time();
		$html = '';
		$counter = 1;
		if( $results != NULL ){
			foreach( $results as $r ){
				$date = $r["dt"];
				$day = date('l', strtotime($date));
				$strtodate = strtotime($date);
				$crtdDate = $r["crtdDate"];
				$is_active = 0;
				$is_active = $r["is_active"];
				$workingDates = '';
				$skipdays = array("Saturday", "Sunday");
				$workingDates = $this->addDays( $crtdDate, 200, $skipdays, $skipdates = array());
				//$workingDates = date("Y-m-d",$workingDates);
				
				if( $nowTime >= $workingDates || $is_active == 1 ){
					$deadLine ="color:#f0ad4e";
					$btn = "btn btn-warning";
					$edit_students = "edit_students_panding";
				}else{
					$deadLine ="color:#82b964";
					$btn = "btn btn-success";
					$edit_students = "edit_students";
				}
				
				
				
				if( $r["ignore"] == 0 ){
					$checked = 'checked="checked"';
					$unchecked = '';
					$class= "";
					
				}else{
					$checked = '';
					$unchecked = 'checked="checked"';
					$class= "danger";
				}
				
				
				$day .= "&nbsp;&nbsp;";
				$html .="<tr data-uid='".$r["ID"]."' style=".$deadLine." title='".$r["Title"]."' class='".$class."'>";
				$html .='<td class="tdTitle">'.$counter.'</td>';
				$html .='<td class="tdTitle">'.$r["Title"]. "<br />Date: " . $day . $r["dt"].'</td>';
				//$html .='<td class="tdTitle">'. $day . $r["dt"]  . '</td>';
				if( $is_active == 1 ){
					$html .= "<td><span class='label label-danger' title='Please Contact To Your M.H For Unlock'>Status Lock</span></td>";
				}else{
					$html .= "<td><button class='".$btn." btn-xs ".$edit_students."' id='ass_".$r["ID"]."' title='Assign Marks To Students'><i class='fa fa-pencil'></i>Edit</button></td>";
				}
				
				
				$html .= '<td class="radioActionTD">';
				$html .= '<input type="hidden" value="'.$r["ID"].'" class="detailedID" />';
				$html .= '<div class="innerAction1">';
				
				$html .= '<input name="radio_inline_'.$r["ID"].'" value="1" type="radio" title="Accomplish this assessment" '.$checked.' class="radioAction"><i></i>  Accomplish &nbsp;';
				
				$html .= '<input name="radio_inline_'.$r["ID"].'" value="0" type="radio" title="Mistakenly created this assessment, please ignore." class="radioAction" '.$unchecked.'><i></i>  Ignore &nbsp;';
				
				$html .= '</div>';
				$html .= '<div class="innerAction2" style="display:none;">
				  Are you sure?
                        <button class="innerAction3 btn btn-success btn-sm" id="submitConfirmFail">No</button>
                        <button class="innerAction3 btn btn-danger btn-sm" id="submitConfirmOk">Yes</button>
				</div>
				<div class="innerAction4" style="display:none">
				<ul class="fa-ul">
					 <li><i class="fa-li fa fa-spinner fa-spin"></i> Updating...</li>
				</ul>
				</div>
				
				<div class="innerAction5" style="display:none">
				<ul class="fa-ul">
					 <li><i class="fa-li fa fa-check-square"></i> Updated Sucessfully</li>
				</ul>
				</div>
				
				<div class="innerAction6" style="display:none">
				<ul class="fa-ul">
					 <li><i class="fa-li fa fa-square"></i> Transicational Problem</li>
				</ul>
				</div>
				
				
				</td>';
				$html .='</tr>';
				
				
				$counter++;
			}
			
		}else{
			$html .='<tr>';
			$html .='<td colspan="4">No Created!</td>';
			$html .='</tr>';	
		}
		return $html;
		
	}
	
	public  function addDays($timestamp, $days, $skipdays, $skipdates = NULL) {
        // $skipdays: array (Monday-Sunday) eg. array("Saturday","Sunday")
        // $skipdates: array (YYYY-mm-dd) eg. array("2012-05-02","2015-08-01");
       //timestamp is strtotime of ur $startDate
        $i = 1;

        while ($days >= $i) {
            $timestamp = strtotime("+1 day", $timestamp);
            if ( (in_array(date("l", $timestamp), $skipdays)) || (in_array(date("Y-m-d", $timestamp), $skipdates)) )
            {
                $days++;
            }
            $i++;
        }

        return $timestamp;
        //return date("m/d/Y",$timestamp);
    }

}