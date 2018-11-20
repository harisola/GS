<?php
class Group_menu{
	private $ci;
	function __construct() {
		$this->ci =& get_instance(); 
	}
	function group_menus(){
		
		$this->ci->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$userid = (int)$this->ci->session->userdata('user_id');
		
		$reg_user = $this->ci->ETS->getStaffID( $userid );
		$reg_user_id = $reg_user['id'];
		$branch_id = (int)$reg_user['branch_id'];
		
		$this->ci->load->model('etab/academic/academic_model','AM');
		$sessions = $this->ci->AM->getSession($branch_id);
		//echo "KashifSession:".$c_sss_id = $sessions[0]["id"];
		$c_sss_id = $sessions[0]["id"];
		$sessionsTerm = $this->ci->AM->getSesstrm($c_sss_id);
		$term = (int)$sessionsTerm[0]["TermID"];
		//$where = array("a.academic_session_id"=> $c_sss_id, "a.staff_id"=>$reg_user_id );
		
		$where = "a.academic_session_id = " . $c_sss_id . " AND a.staff_id = " . $reg_user_id ;

		$teacherSubjects2 = $this->ci->ETS->teacherSubjectData($where);
		
		$html = '';
		
		if( $teacherSubjects2 != NULL ) {
			
		$html .= '<li><a class="submenu" href="#" data-id="groups" title="Groups List"><i class="fa fa-users"></i><span> Groups </span></a>';
		
		$html .= '<ul id="groups">';
		foreach($teacherSubjects2 as $g ){
			
			$tSID 		= $g['tSID'];
			$pID 		= $g['pID'];
			$secName 	= $g['secName'];
			$sectionID 	= $g['sectionID'];
			$gradeID 	= $g['gradeID'];
			$Grade 		= $g['Grade'];
			$subjectID 	= $g['subjectID'];
			$Subject 	= $g['Subject'];
			$subjectCode= $g['subjectCode'];
			$OPT = $g['OPT'];
			$GPID = $g['GPID'];
			$gpp_id = $g['gpp_id'];
			$roleCode = $Grade."-".$subjectCode."-"."O-".$secName;	
			
			
			
			$encode_url = 'user_id='.$reg_user_id.'&matrixRoleSbjTchrID='.$tSID.'&programmeID='.$pID.'&secName='.$secName.'&sectionID='.$sectionID.'&gradeID='.$gradeID.'&Grade='.$Grade.'&subjectID='.$subjectID.'&Subject='.$Subject.'&subjectCode='.$subjectCode.'&optional='.$OPT.'&GPID='.'&gpp_id='.$gpp_id.'';
			
			
			
			$html .= '<li><a href="'.site_url().'/process/define_process?'.$encode_url.'" title="Icon Fonts"><i class="fa fa-child"></i><span>'.$GPID.'</span></a> </li>';
			
		}
			$html .= '</ul>';
			$html .= '</li>';
		}
		
		$db = 'role_matrix';
		$tablename = 'setup_grade_lt';
		
		$select = "id,staff_id";
		$where = array( "staff_id" => $reg_user_id );
		
		$is_lead = $this->ci->ETS->getAll( $db, $tablename, $select, $where);
		//print_r( $is_lead );
		$count = 0;
		if( !empty( $is_lead ) && $is_lead != NULL ){
			$prameters = "teacher_id=".$reg_user_id;
			$notify_url = site_url().'/process/notifications?'.$prameters.'';
			
			foreach($is_lead AS $prg ){
				
			if( $prg["staff_id"] > 0 )
				$count +=  $this->prgAssmnt( $prg["staff_id"],$c_sss_id,$term );
			
			}
			
			$html .= '<li class=""><a title="Inbox" href="'.$notify_url.'"><i class="entypo-inbox"></i><span> Notifications <span class="badge" id="badgeNotification">'.$count.' </span></span></a></li>';
			
		}
		
		$this->ci->load->database('default',TRUE);
		return $html;
	}
	
	
	public function prgAssmnt( $proID, $session,$term ){
		$this->ci->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$notifications = $this->ci->ETS->countNotifications($proID,$session,$term);
		$return = $notifications["Notification"];
		return $return;
	}
	
	
	
	
	
	
	
}	