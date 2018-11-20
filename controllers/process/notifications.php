<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notifications extends MY_Controller {
	public function __construct(){
		parent::__construct();	
	}
	
	public function index(){
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$this->load->library('user_agent');
		
		
		$teacher_id = (int)$this->input->get("teacher_id");
		
		$db = 'role_matrix';
		$tablename = 'setup_grade_lt';
		$select = "program_id";
		$where = array( "staff_id" => $teacher_id ); // user id 
		$leadProgramms = $this->ETS->getAll( $db, $tablename, $select, $where);
		//var_dump( $leadProgramms );
		//exit;
	
		
		
		$browser = $this->agent->browser();
		//echo "<br />";
		$ip = $this->input->ip_address();
		$user_agent = $this->input->user_agent();
		
		$data["user_ip"] = $ip;
		$data["user_agent"] = $user_agent;
		$data["user_id"] = $teacher_id;
		
		
		$login_user_id = $this->session->userdata("user_id"); //118 GAA
		$reg_user = $this->ETS->getStaffID( $login_user_id );
		$reg_user_id = $reg_user['id'];
		
		$branch_id = (int)$reg_user['branch_id'];
		
		
		$this->load->model('etab/academic/academic_model','AM');
		$sessions = $this->AM->getSession($branch_id);
		$c_sss_id = $sessions[0]["id"];	
		
		$sessionsTerm = $this->AM->getSesstrm($c_sss_id);
		$term = (int)$sessionsTerm[0]["TermID"];
		
		
		$data['gradeProgramme'] = $this->gtGrdSbjtCtSbCt( $leadProgramms, $c_sss_id,$term );
		
		
		
		 
		$this->load->view("process/notifications/notifications.php",$data);
		$this->load->view("process/notifications/footer.php");
	}
	
	

	
	
	
	
		// Get Grade Subject category and its subcategory
	// Like Formmative -> Class Work
	public function gtGrdSbjtCtSbCt( $leadProgramms,$c_sss_id,$term ){
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$html = '';
		$changeColor = true;	
		if( $leadProgramms != NULL ){
			
		foreach($leadProgramms AS $gs ){
		
		$where = array("c.id" => $gs["program_id"], "c.sessionID" =>$c_sss_id );
		
		$types = $this->ETS->programGradeSub( $where);
	
			
			
			
			
			if(!empty($types)){
				
			
			foreach($types AS $type ){
				
				$ID = $type['Grade'];
				$Grade = $type['Grade'];
				$ProgrammeID = $type["ProgrammeID"];
				
				if( $type["ProgrammeID"] > 0 ){
				$count = $this->prgAssmntNtfct( $type["ProgrammeID"], $c_sss_id,$term );	
				}else{
					$count = 0;
				}
					
				
			
			$html .='<div class="panel panel-default" id="forms-'.$count.'">';	
			
				
			  
			  //if($changeColor){
				  if($count > 0 ){
				//$html .='<div class="panel-heading" style="background-color: #595f66;">';  
				$html .='<div class="panel-heading" style="background-color: #5bc0de;">';
				$changeColor = false;
			  }else{
				  
				  $html .='<div class="panel-heading" style="background-color: #595f66;">';  
				  $changeColor = true; 
			  }
               
				
				
				$html .='<div class="panel-title pull-left">'.$Grade.'<small>'.$type["subjectCode"].'</small></div>';
				
				
                
				
                $html .='<div class="pull-right">';
				$html .='<span class="badge">'.$count.' </span>';
				//$html .='<a href="#" data-toggle="modal" data-target="#panel-question" class="btn-question"><i class="fa fa-question-circle"></i></a>';
				$html .='<a href="#" class="btn-minmax"><i class="fa fa-chevron-circle-down"></i></a>';
				//$html .='<a href="#" class="btn-close"><i class="fa fa-times-circle"></i></a>';
				$html .='</div>';
				
                $html .='<div class="clearfix"></div>';
              $html .='</div>';
				
				// this id contains grade id subject id category id and cat type id.
				 $html .= '<div class="panel-body" style="display: none;">';
				 
				 //$html .='<p class="leads">List groups are a flexible and powerful component for displaying not only simple lists of elements, but complex ones with custom content.</p>';
				 
				
				
					$html .= $this->gradeAssessment($ProgrammeID,$Grade,$c_sss_id);
				 
					
				
				$html .= '</div>';
            $html .= '</div>';
			
			}// end foreach types
		}
		} // End foreach retrieve array data main category
	}
		return $html;
	}
	
	
	
	
	public function gradeAssessment( $programme_id, $Grade,$c_sss_id ){
			
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETM');
		
		$table3 = 'atif_assessment.`assessment_category` AS `a`';
		$table4 = 'atif_assessment.`gradesubjectass` AS `b`';
		$select2 = 'a.id AS catID ,a.dname AS catName2';
		$ON2 = 'a.id = b.assessment_category_id';
		
		$where2 = array('a.status'=>1,'b.program_id'=>$programme_id,'b.weightage > '=>0, 'b.record_deleted' => 0);
		
		// get program's cateogry like Formmative and Summative etc...
		$grdCategories = $this->ETM->joinTwoTables( $table3, $table4, $ON2, $select2, $where2 );
		
		// var_dump( $grdCategories );
		// exit;
		
		$html = '';
		
		
		$table5 = 'atif_assessment.`assessment_type` AS `a`';
		$table6 = 'atif_assessment.`gradesubjectass` AS `b`';
		
		$select3 = 'a.id AS catID2 ,a.name AS catName,b.id AS Ass_id,b.program_id AS Programme';
		$ON3 = 'a.id = b.assessment_type_id';
		
	
			$changeColor = true;
			$count = 0;
			
		if( $grdCategories != NULL ){
			
		foreach($grdCategories AS $gs ){
			
			$catID = (int)$gs["catID"];
			$catName2 = $gs["catName2"];
			
			
			
			$where3 = array('b.program_id'=>$programme_id, 'b.assessment_category_id'=>$catID, 'b.weightage > '=>0, 'b.record_deleted' => 0);
			// programme category and subcatogry assigned like Formmative > Class Assessment etc ...
			
			
			$assessmentsTypes = $this->ETM->joinTwoTables( $table5, $table6, $ON3, $select3, $where3 );
			
			
			$db = "subject_grade";
			$table = "assessment_detail";
			$select = "id AS Ids";
			
			
			
			
			
			//var_dump($assessmentsTypes);
			//exit;
			
			if( !empty($assessmentsTypes)){
			foreach($assessmentsTypes AS $lp ){
				
			$AssInGradeId = $lp["Ass_id"];
			
			
			
				
		   $where = array("assessment_in_grade_id"=>$AssInGradeId,"record_deleted"=>0);
		   
			// programme category and subcatogry > Deatil assigned like Formmative > Class Assessment > Class Assessment 1.1  etc ...
			$resultss = $this->ETM->getTchrDetailID( $AssInGradeId );
		
			
			//$resultss = $this->ETM->getAll( $db, $table, $select, $where );
			
		
			
			
			
			
			
			if( !empty( $resultss ) ){
				//$catIDType2 = $resultss["Ids"];	
				$count = $this->prgAssmntTypeNtfct( $programme_id, $resultss );
			}else{
				$count = 0;
			}
			//echo $count;
			//exit;
			
			
			
			
			
			$html .='<div class="panel panel-default" id="table1">';
			
			
			 //if($changeColor){
			if( $count > 0 ){
				$html .='<div class="panel-heading" style="background-color: #5bc0de;">';
				$changeColor = false;
			  }else{
				$html .='<div class="panel-heading" style="background-color: #595f66;">';   
				  $changeColor = true; 
			  }
			  
            //$html .='<div class="panel-heading">';
            $html .='<div class="panel-title pull-left">'.$catName2.'<small>'.$lp["catName"].'</small></div>';
            $html .='<div class="pull-right">';
			$html .='<span class="badge">'.$count.' </span>';
			$html .='<a href="#" class="btn-minmax"><i class="fa fa-chevron-circle-down"></i></a>';
			$html .='</div>';
            $html .='<div class="clearfix"></div>';
            $html .='</div>';
			
			
			$html .='<div class="panel-body inner-spacer" style="display:none" role="content">';
			//$html .='<p class="leads">List groups are a flexible content.</p>';
				//$html .= $this->get_List($lp["Ass_id"]);
				
				$html .='<table class="table table-bordered table-striped margin-0px detailTable">';
					
					$html .='<thead>';
						$html .='<tr>';
							$html .='<th>#</th>';
							$html .='<th>Assessment</th>';
							//$html .='<th>Type</th>';
							//$html .='<th>Date</th>';
							$html .='<th>Students </th>';
						$html .='</tr>';
					$html .='</thead>';
						$html .='<tbody>';
						
						$html .= $this->getDetailList( $lp["Ass_id"],$Grade );
						
						//$html .= '<tr>';$html .= '<td>';$html .= '</td>';$html .= '<td>';$html .= '</td>';$html .= '<td>';$html .= '</td>';$html .= '<td>';$html .= '</td>';$html .= '<td>';$html .= '</td>';$html .= '</tr>';
						
						
						$html .='</tbody>';
					$html .='</table>';
					
					
					
			$html .='</div>';
			
			
			
            $html .='</div>';
			
			}// end foreach loop
			
			}			
			
		}
		}
			
			//exit;
            return $html;
			
			
			
			
		
		
	}
	
	
	
	
		public function getDetailList( $AssInGradeId,$Grade ){
			
		$this->load->model('etab/teacher_side/teacher_side_model','DBB');
		$db = "subject_grade";
		$table = "assessment_detail";
		/*$select = "id AS ID, date AS dt, title AS Title,created AS crtdDate, register_by AS teacher_id,role_id AS role_id, is_active AS active";
		$where = array("assessment_in_grade_id"=>$AssInGradeId,"record_deleted"=>0);
		$results = $this->DBB->getAll( $db, $table, $select, $where );*/
		
		$results = $this->DBB->getTchrDetailID2( $AssInGradeId );
		
		$db2 = 'default';
		$tablename2 = 'staff_registered';
		$select2 = "employee_id,abridged_name";
		
		$db3 = 'role_matrix';
		$tablename3 = 'role_subject_teacher';
		$select3 = "id AS RoleID, gp_id AS Role,section_id AS Section";
		
		$db4 = 'subject_marks';
		$tablename='assessment_marks';
		$count = "count(*) as pendng";
		$count2 = "count(*) as total_edit";
		
		$db5 = 'default';
		$tablename1='class_list';
		$count3 = "count(*) as sectionStudent";
		
		
		$nowTime = time();
		$html = '';
		$counter = 1;
		if( $results != NULL ){
			foreach( $results as $r ){
				$date = $r["dt"];
				$day = date('l', strtotime($date));
				$strtodate = strtotime($date);
				$crtdDate = $r["crtdDate"];
				$teacher_id = $r["teacher_id"]; 
				$active = $r["active"]; 
				
				$where2 = array( "id" => $teacher_id );
				$teacher = $this->DBB->getSingleRow( $db2,  $tablename2, $select2, $where2 );


				$employee_id =  $teacher["employee_id"];
				$abridged_name = $teacher["abridged_name"];

				$role_id = $r["role_id"]; 
				$where3 = array( "id" => $role_id );
				$roles = $this->DBB->getSingleRow( $db3,  $tablename3, $select3, $where3 );
				
				$detail_id = $r["ID"];
				$where1 = array("assessment_detail_id" => $detail_id, "pending_marks" => 1);
				$total_pendding = $this->DBB->getSingleRow( $db4,  $tablename, $count, $where1 );
				
				
				$detail_id = $r["ID"];
				$where1 = array("assessment_detail_id" => $detail_id );
				$total_edit = $this->DBB->getSingleRow( $db4,  $tablename, $count2, $where1 );
				
				
				//var_dump( $roles ); exit;
				$role = $roles["Role"];
				$Section = $roles["Section"];
				
				
				$where4 = array("grade_name" => $Grade,"section_id" => $Section  );
				
				//$section_students = $this->DBB->getSingleRow( $db5,  $tablename1, $count3, $where4 );
				$section_students = $this->DBB->countGrdSctonStd($Grade, $Section);
				//var_dump($section_students  );
				//exit;
				
				//if( $section_students = $this->DBB->countGrdSctonStd($Grade,$Section) ){}else{$section_students = NULL;}
				/*$workingDates = $this->addDays( $crtdDate, 2, $skipdays, $skipdates = array());
				//$workingDates = date("Y-m-d",$workingDates);
				if( $nowTime >= $workingDates ){
					$deadLine ="color:#f0ad4e";
					$btn = "btn btn-warning";
					$edit_students = "edit_students_panding";
				}else{
					$deadLine ="color:#82b964";
					$btn = "btn btn-success";
					$edit_students = "edit_students";
				}
				*/
				
				$deadLine ="";
				$btn = "";
				$edit_students = "";
					
				$day .= "&nbsp;&nbsp;";
				$html .="<tr data-uid='".$r["ID"]."' style=".$deadLine." class='parentTR'>";
				$html .='<input type="hidden" class="hGrade" value="'.$Grade.'">';
				$html .='<input type="hidden" class="hSection" value="'.$Section.'">';
				$html .='<input type="hidden" value="'.$detail_id.'" class="detail_id">';
				$html .='<td class="tdTitle">'.$counter.'</td>';
				$html .='<td class="tdTitle2">';
				$html .='<div class="alert-blocks alert-blocks-pending alert-dismissable">';
				$html .='<img alt="" src="'.base_url().'Assets/photos/hcm/150x150/staff/'.$employee_id.'.png" class="rounded-x mCS_img_loaded">';
				$html .='<div class="overflow-h2">';
				$html .='<strong class="color-yellow">'.$abridged_name.'</strong>';
				$html .='<p>'.$role.'</p>';
				$html .='<p>Title: '.$r["Title"].'</p>';
				$html .='<p>Date: '. $day . $r["dt"]  .'</p>';
				$html .='</div>';
				$html .='</div>';
				//$html .='</td>';
				//$html .='<td class="tdTitle">'.$r["Title"].'</td>';
				//$html .='<td class="tdTitle">'. $day . $r["dt"]  . '</td>';
				$html .= "<td style='width:25%'>";
				
				$locked = "";
				
				if( $active == 0 ){
					$locked = "block";
					$locked2 = "none";
				}else{
					$locked = "none";
					$locked2 = "block";
				}
				
				$html .= '<div class="list-group lockedDiv" style="display:'.$locked.'">';
				if( $total_pendding["pendng"] > 0 ){
				$html .= '<a class="list-group-item pedding_request" href="#"><span class="badge">'.$total_pendding["pendng"].'</span>Pending</a>';
				}else{
					//$html .= "<button class='".$btn." btn-xs ".$edit_students."' id='ass_".$r["ID"]."'><i class='fa fa-pencil'></i> Edit</button>";	
				}
				////$html .= '<div class="list-group">';
				//$assigned = ( $section_students["sectionStudent"] - $total_edit["pendng"]  );
				if( $total_edit["total_edit"] > 0 ){
				$html .= '<li class="list-group-item blanked_request"><span class="badge">'.$total_edit["total_edit"].'</span>Marks Assigned</li>';
				}else{
					$html .= '<a class="list-group-item total_request" href="#"><span class="badge">'.$total_edit["total_edit"].'</span>Programme Total</a>';
				}
				
				if( $section_students["sectionStudent"] > 0 ){
				$left = ( $section_students["sectionStudent"] - $total_edit["total_edit"]  );
				$html .= '<li class="list-group-item blanked_request"><span class="badge">'.$left.'</span>Not Assigned</li>';	
				$html .= '<a class="list-group-item total_request" href="#"><span class="badge">'.$section_students["sectionStudent"].'</span>Programme Total</a>';
				}else{}
				$html .= '</div>';
				
				$html .='<div class="callout-gen undoDiv2" style="padding: 10px; margin-top: 5px;display:none;">';
				$html .='<p>Are You Sure? To Unlock This Assessment Type <span class="finalMarks2"></span>  <a href="#" class="undo2">Undo</a> </p>';
				$html .='<p>';
				$html .='<br />';
				$html .='<br />';
				$html .='<button type="button" class="btn btn-primary btn-xs appAssTpy" id="approveA_'.$r["ID"].'">Approve </button>';
				$html .='</p>';
				//$html .='<input type="hidden" value="" class="finalDecision" />';
				$html .='</div>';

				$html .= '<div class="lockedDiv2" style="display:'.$locked2.'">';
				$html .= "<span class='label label-danger'>Status Lock</span>";
				$html .='<br />';$html .='<br />';$html .='<br />';
				$html .= '<span class="label label-primary unlocked" data-id="un_'.$r["ID"].'">Unlock</span>';
				$html .= '</div>';
				
				
				
				$html .= '</td>';
				
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
	
	
	
	
	public function prgAssmntNtfct($proID, $session,$term){
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$notifications = $this->ETS->countNotifications($proID, $session,$term);
		$return = $notifications["Notification"];
		return $return;
	}
	
	public function prgAssmntTypeNtfct( $proID, $assTypes ){
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$return = 0;
		foreach( $assTypes AS $t ){
			$assType = $t["Ids"];
			$notifications = $this->ETS->countNotificationsType($proID, $assType);	
			if( $notifications["Notification"] > 0 ){
				$return += $notifications["Notification"];	
			}
		}
		return $return;
	}
	
	
	
	
}