<?php
class Notify_header{
	private $ci;
	function __construct(){
		$this->ci =& get_instance(); 
	}
	
	public function group_menus_count()
	{
		
		$this->ci->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$userid = (int)$this->ci->session->userdata('user_id');
		
		$reg_user = $this->ci->ETS->getStaffID( $userid );
		$reg_user_id = $reg_user['id'];
		$branch_id = (int)$reg_user['branch_id'];
		$this->ci->load->model('etab/academic/academic_model','AM');
		$sessions = $this->ci->AM->getSession($branch_id);
		$c_sss_id = $sessions[0]["id"];
		$sessionsTerm = $this->ci->AM->getSesstrm($c_sss_id);
		$term = (int)$sessionsTerm[0]["TermID"];
		$html = '';
		$isLead = NULL;
		$dbRoleMatrix = 'role_matrix';
		$tablename = 'setup_grade_lt';
		$select = "id,staff_id";
		$where = array( "staff_id" => $reg_user_id );
		$isLead = $this->ci->ETS->getAll( $dbRoleMatrix, $tablename, $select, $where);
		
		
		$default = 'default';
		$tablename2 = 'users_groups';
		$select2 = "id";
		$where2 = array( "user_id"=>$userid, "group_id" => 25 );
		$isTeacher = $this->ci->ETS->getAll( $default, $tablename2, $select2, $where2);
		
		$this->ci->load->model('student_attendance/notification_log', 'NTF');
		
		$zero_or_one = $this->ci->NTF->check_user_group2($userid);
		if(  !empty( $zero_or_one  ) ){
			$checking = $zero_or_one["result"];
			if( $checking == 1 ){
				$notify_list = $this->ci->NTF->get_notification($userid);
				if( !empty( $notify_list ) ){
					
				}else{ $notify_list=TRUE;}	
				
			}else{ $notify_list = FALSE; }
			
		}else{ $notify_list = FALSE; }
		
		$unread_list='';
		$Admission_unread_list=array();
		$unread_list = $this->ci->NTF->get_unread_notification($userid);
		
		$Admission_unread_list = $this->ci->NTF->get_admission_unread_notification($userid);
		
		
		if( !empty( $Admission_unread_list ) )
		{
			$Admission_count=$Admission_unread_list['Admission_Total'];
		}else 
		{
			$Admission_count=0;
		}
		
		
		if( !empty( $unread_list )){
			$countN = $unread_list[0]['Total_Notification'];
		}else{ $countN = 0; }
		
		$teacher=0;
				
		if( $isLead != NULL && !empty( $isLead ) ) 
		{
			
		$html .= '<div class="btn-groups pull-left">';
		$html .= '<button type="button" class="btn btn-default" data-toggle="dropdown">';
		$html .= '<i class="entypo-megaphone"></i>';
		//print_r( $is_lead );
		$count = 0;
		$prameters = "teacher_id=".$reg_user_id;
		$notify_url = site_url().'/process/notifications?'.$prameters.'';
		foreach($isLead AS $prg ){
			if( $prg["staff_id"] > 0 ){
				$count +=  $this->prgAssmnt2( $prg["staff_id"],$c_sss_id,$term );
			}
			
		}// end foreach
		//if( $count > 0 ){
			$html .= '<span class="new"></span>';
		//}
		$html .= '</button>';
		$html .= '<div id="notification-dropdown" class="dropdown-menu">';
		$html .= '<div class="dropdown-header">Notifications <span class="badge pull-right">';
		$html .= $count;
		$html .= '</span>
		</div>';
		$html .= ' <div class="dropdown-footer">';
		$html .= '<a class="btn btn-dark" href="'.$notify_url.'">'; $html .= 'See All'; $html .= '</a>';
		$html .= '</div>';
        $html .= '</div>';
		$html .= '</div>';
		$html .= $this->notify_list2($countN,$isTeacher=NULL);
		}else{ 
		//var_dump( $notify_list ); exit;
			if( !empty( $notify_list )  ){ 
					$html .= $this->notify_list2($countN,$isTeacher);
				}else{ $countN =0; }
			}
			
			
		$html .= $this->Count_Admission($Admission_count);	
			
		$this->ci->load->database('default',TRUE);
		return $html;
	}
	
	public function prgAssmnt2( $proID, $session,$term )
	{
		$this->ci->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$notifications = $this->ci->ETS->countNotifications($proID,$session,$term);
		return $notifications["Notification"];
		
	}
	
	
	public function notify_list2($countN,$isTeacher=NULL)
	{
		$html = '';
		//if( $countN > 0 ){
		$html .= '<div class="btn-groups pull-left">';
		$html .= '<button type="button" class="btn btn-default" data-toggle="dropdown">';
		$html .= '<i class="entypo-megaphone"></i>';
		$html .= '<span class="newNofitication" id="newNofitication_" style="display: block;"> '. $countN.' </span>';	
		$html .= '</button>';
		$html .= '<div id="notification-dropdown" class="dropdown-menu">';
		
		$html .= '<div class="dropdown-header">Active Case <span class="badge pull-right" id="newNotify">'. $countN.'</span></div>';
		
		$notify_url2 = base_url() ."index.php/fo/notify_log";
		if(!empty( $isTeacher )){ 
		$html .= '<div class="dropdown-footer"><a class="btn btn-dark" href="'. $notify_url2.'">See All</a></div>';
		}else{
		$html .= '<div class="dropdown-footer"><a class="btn btn-dark" href="'. $notify_url2.'">See All</a></div>';
		}
		
		$html .= '</div>';
		$html .= '</div>';
		//}else{ }
		return $html;
	}
	
	
	public function Count_Admission($Number)
	{
		$html = '';
		
		$html .= '<div class="btn-groups pull-left" id="admission_counter_p">';
		$html .= '<button type="button" class="btn btn-default" data-toggle="dropdown">';
		
		$html .= '<i class="entypo-megaphone"></i>';
		if( $Number > 0 ){
			$html .= '<span class="newNofitication" style="display: block;" id="admission_counter"> '. $Number.' </span>';
		}
		$html .= '</button>';
		$html .= '<div id="notification-dropdown" class="dropdown-menu">';
		
		$html .= '<div class="dropdown-header"> Admission Notification <span class="badge pull-right">'. $Number.'</span></div>';
		
		$notify_url2 = base_url() ."index.php/fo/notify_log_admissions";
		
		$html .= '<div class="dropdown-footer"><a class="btn btn-dark" href="'. $notify_url2.'">See All</a></div>';
		
		
		$html .= '</div>';
		$html .= '</div>';
		return $html;
	}
}	