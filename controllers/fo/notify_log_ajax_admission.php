<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notify_log_ajax extends CI_Controller {
	public function __construct(){
		parent::__construct();				
		$this->load->library('session');
	}
	public function get_notification(){
		$num = (int)$this->input->post("num");
		//$user_id = $this->input->post("user_id");
		$user_id = (int)$this->session->userdata('user_id');
		
		$unread = $this->get_notify($user_id);
		$result = $unread;
		echo json_encode( array( "r" =>$result ) );
	}
	
	
	public function get_notify($user_id){
		$this->load->model('front_office/ajax_base_model', 'ABM' );
		$category=1;
		$notify_to= $user_id;
		$unread=0;
		if( $unreads = $this->ABM->get_notify_method( $category, $notify_to, $unread ) ){
			$unread = count( $unreads );
		}else{
			$unread =0;
		}
		return $unread;
	}
	
	
	public function get_converssion(){
		$this->load->model('front_office/ajax_base_model', 'ABM' );
		$notify_id = (int)$this->input->post("notify_id"); // notification_meta_data id
		$cat_id = (int)$this->input->post("cat_id");
		$staff_id = (int)$this->input->post("staff_id"); // register by id
		$emp_id = (int)$this->input->post("emp_id");  // register by employee id
		$gs_id = $this->input->post("gs_id");
		$notify_to = (int)$this->input->post("notify_to"); // current user staff id 
		$current_user = (int)$this->input->post("current_user"); // current user id
		$notify_type = $this->input->post("notify_type"); // Admission_Notification, Attendance_Notification
		
		$staffInfo = $this->ABM->getStaffInfo($current_user);
		$employee_id = $staffInfo["employee_id"]; 
		$staff_id = $staffInfo["id"]; 
		
		
		
		
		$tableRows=array();
		$html = 'Case Remove!';
		
		if( $notify_type == 'Attendance_Notification' )
		{
				$tableRow = $this->ABM->gt_ntfctn_gs_id_wise( $notify_to, $cat_id, $staff_id, $gs_id );
				
				if(  !empty($tableRow) )
				{
					//$tableRows = $tableRow;
					foreach( $tableRow AS $r ){
						array_push($tableRows,$r["id"]);
					}
				}
				
				$thread_id = 0;
				$CaseName = "";
				$tid = $this->ABM->get_thread_id( $this->input->post("staff_id"),  $notify_id);
				
				if( !empty($tid) )
				{
					$thread_id = $tid["thread_id"];
					//$CaseName = $tid["CaseName"];
					$CaseName = 'Attendance';
					
					$current_user = $this->session->userdata('user_id');
					$current_username = $this->session->userdata('username');
					
					$html = $this->create_converssion( $notify_to, $cat_id, $staff_id,$emp_id, $gs_id,$thread_id,$CaseName,$notify_id,$employee_id,$current_user ,$current_username);
				
				
				}else{
					
					$thread_id = 0;	
					$CaseName = "";
					$html = 'Case Remove!';
				}
		}
		else
		{
			// here notify_id behive as form_id
			$html = $this->Admission_Form( $notify_id  );
			
			
		}
		
		
		$data=array( "TR"=> $tableRows, "ht"=>$html);
		
		echo json_encode( $data );
	}
	
	
	public function create_converssion( $notify_to, $cat_id, $staff_id,$emp_id, $gs_id,$thread_id,$CaseName,$notify_id ,$employee_id,$current_user ,$current_username ){
		$this->load->model('front_office/ajax_base_model', 'ABM' );
		if( $tableRow = $this->ABM->gt_ntfctn_gs_id_wise2($notify_to, $cat_id,$staff_id, $gs_id) ){
		}else{
		$tableRow = array();
		}
		 
		//echo $ActiveCaseID = $thread_id; exit; // metaid
		$ActiveCaseID = $thread_id;
		$StudentGSID = $gs_id;
		
		//$this->load->model('student_attendance/activecase_log_desc_model');
        $ACaseDesc = $this->ABM->getStudentActiveCaseLog2($ActiveCaseID);        
		
		//$this->load->model('students/students_current_classlist_model');
        //$data['student_info'] = $this->students_current_classlist_model->get_by(array('gs_id' => $StudentGSID));
		
		$Query  = "select * from atif.class_list where gs_id='".$gs_id."'";
		$data['student_info'] = $this->ABM->Run_Query($Query);
		
		//var_dump(  $data['student_info'] ); exit;
		//var_dump(  $ACaseDesc ); exit;
		
		if( !empty($data['student_info'])){
		
		
			
			/*$title = $data['student_info'][0]->abridged_name;
			$gs_idd = $data['student_info'][0]->gs_id;
			$grade_name = $data['student_info'][0]->grade_name;
			$section_name = $data['student_info'][0]->section_name;
			$gender = $data['student_info'][0]->gender;
			*/
			
			$title = $data['student_info'][0]['abridged_name'];
			$gs_idd = $data['student_info'][0]['gs_id'];
			$grade_name = $data['student_info'][0]['grade_name'];
			$section_name = $data['student_info'][0]['section_name'];
			$gender = $data['student_info'][0]['gender'];
		
		
		}else{
			$title = '';
			$gs_idd = '';
			$grade_name = '';
			$section_name = '';
			$gender = '';
		}
	
		
		if( $gender == "G"){
			$gender = "Girl";
		}else{
			$gender = "Boy";
		}
		
		 $ActiveCaseInfo = "";
		 
		$html = '';
		$html .= '<div class="col-md-6  bootstrap-grid sortable-grid ui-sortable">';
		$html .= '<div class="powerwidget dark-red powerwidget-sortable" id="left_side_div" data-widget-editbutton="false" role="widget">';
		$html .= '<header role="heading">';
			$html .= '<h2> Student <small>'.$title.'</small> </h2>';
			//$html .= '<div class="powerwidget-ctrls" role="menu">';
			//$html .= '</div>';
			$html .= '<span class="powerwidget-loader"></span>';
		$html .= '</header>';
		$html .= '<div class="inner-spacer" role="content">';
		
			$html .= '<div class="chat-container">';
			
               $html .= '<div class="chat-pusher">';
			   $html .= '<blockquote>';
               $html .= '<p>'.$title.'</p>';
			    $html .= '<footer>'.$gs_idd.'|<cite title="Source Title">'.$grade_name."-".$section_name.'|</cite>'.$gender.' </footer>';
			   $html .= '<footer>Active Case <cite title="Source Title">'.$CaseName.'</cite></footer>';
              
               $html .= '</blockquote>';
			   
                $html .= '<div class="chat-content" style="height:205px;">';
				
                 $html .= '<div class="nano2">';
                   $html .= '<div class="nano-content">';
                     $html .= '<div class="chat-content-inner">';
						$html .= '<div class="clearfix">';
                           $html .= '<div class="chat-messages">';
						   
                             $html .= '<ul id="chat-messages-list">';
							 
							 
							 
							     if($ACaseDesc == "") {
         
        }else{
          $isLeft = true;


          // Staff Related Data
         $this->data['staff_150_photo_path'] ='assets/photos/hcm/150x150/staff/';
          $this->data['photo_file'] = '.png';

			
			
			
			//var_dump($this->session->userdata); exit;

            foreach ($ACaseDesc as $ActiveCase) {    

				
                $ImageName = base_url() . $this->data['staff_150_photo_path'] . $ActiveCase['employee_id'] . $this->data['photo_file'];
                $ImageMale = base_url() . $this->data['staff_150_photo_path'] . "male.png";
                $ImageFemale = base_url() . $this->data['staff_150_photo_path'] . "female.png";
                $ImageFound = "Yes";
				
				if( $ActiveCase['user_id'] == $current_user ){
					$isLeft = true;
					$myname = $ActiveCase['abridged_name'];
				}else{
					$isLeft = false;
					$myname = $ActiveCase['abridged_name'];
				}
				

                if (!file_exists($this->data['staff_150_photo_path'] . $ActiveCase['employee_id'] . $this->data['photo_file'])) {
                    if($ActiveCase['gender'] == 'M'){
                        $ImageName = $ImageMale;
                    }else if($ActiveCase['gender'] == 'F'){
                        $ImageName = $ImageFemale;
                    }

                    $ImageFound = "No";              
                } 
				

              if($isLeft == true){
                $ActiveCaseInfo .=
                  '<li class="left clearfix">
                    <div class="user-img pull-left"> <img src="' . $ImageName . '" alt="User Avatar"> </div>
                    <div class="chat-body clearfix">
                      <div class="header"> <span class="name">' . $ActiveCase['abridged_name'] . '</span><span class="name"></span> <span class="badge"><!--<i class="fa fa-clock-o"></i>-->' . unix_to_human($ActiveCase['created']) . '</span></div>
                      <p> ' . $ActiveCase['comments'] .' </p>
                    </div>
                  </li>';
                 // $isLeft = false;
              }else{
                $ActiveCaseInfo .=
                  '<li class="right clearfix"><span class="user-img pull-right"> <img src="' . $ImageName . '" alt="User Avatar"> </span>
                    <div class="chat-body clearfix">
                      <div class="header"> <span class="name">' . $ActiveCase['abridged_name'] . '</span>
					  <span class=" badge"><!--<i class="fa fa-clock-o"></i>-->' . unix_to_human($ActiveCase['created']) . '</span> </div>
                      <p> ' . $ActiveCase['comments'] .' </p>
                    </div>
                  </li>';
				//$isLeft = true;
              }                  
            }                  
         


           $html .= $ActiveCaseInfo;
        } 
		
		
                                      $html .= '</ul>';
                                    $html .= '</div>';
                                  $html .= '</div>';
                                $html .= '</div>';
                              $html .= '</div>';
                            $html .= '</div>';
                          $html .= '</div>';
                        $html .= '</div>';
                      $html .= '</div>';
					$action = base_url()."index.php/fo/notify_log_ajax/add2";
					$html .= '<div class="chat-message-form">';
					
							$html .= '<form method="POST" action="'.$action.'" name="order-form" id="order-form">';
							$html .= '<input type="hidden" id="gs_id" name="gs_id" value="' . $StudentGSID . '">';
							$html .= '<input type="hidden" id="activecase_id" name="activecase_id" value="' . $ActiveCaseID . '">';
							$html .= '<input type="hidden" id="current_user" name="current_user" value="' . $current_user . '">';
							$html .= '<input type="hidden" id="staff_id" name="staff_id" value="' . $notify_to . '">';
							
							$html .= '<input type="hidden" id="notify_id" name="notify_id" value="' . $notify_id . '">';
							$html .= '<input type="hidden" id="cat_id" name="cat_id" value="' . $cat_id . '">';
							$html .= '<input type="hidden" id="emp_id" name="emp_id" value="' . $employee_id . '">';
							$html .= '<input type="hidden" id="notify_to" name="notify_to" value="' . $staff_id . '">';
							$html .= '<input type="hidden" id="myname" name="myname" value="'.ucwords( $current_username ).'">';
							
							
							
							
							
							$html .= '<div class="row">';
								$html .= '<div class="col-md-12">';
									$html .= '<textarea placeholder="Write Your Message Here" class="form-control margin-bottom" rows="2" name="messge_comments" id="messge_comments"></textarea>';
								$html .= '</div>';
								$html .= '<div class="col-md-12">';
								
								$html .= '<div style="margin-bottom: 0;margin-top: 0;min-height: 0;padding-bottom: 0;padding-top: 10px;display:none;height:27px;margin-left:4px;" id="ajaxloader">';
								$src = base_url()."components/image/ajax-loader.gif";
								$html .= '<img src="'.$src.'">';
								$html .= '</div>';
								
								$html .= '<div class="callout callout-info pull-left" style="margin-bottom:0;margin-top: 0;min-height:56px;padding-bottom:0;padding-top:10px;display:none;margin-left:4px;" id="calloutMessage">';
								$html .= '<p>Message Sent!</p>';
								$html .= '</div>';
							
								$html .= '<div class="callout callout-danger pull-left" style="margin-bottom:0; margin-top:0; min-height: 56px; padding-bottom:0; padding-top:10px; display:none; margin-left:4px;" id="calloutMessageError">';
								$html .= '<p> Error </p>';
								$html .= '</div>';
								
									$html .= '<button class="btn btn-info pull-right send-message" id="send-message" type="submit">Send</button>';
								$html .= '</div>';
							$html .= '</div>';
						$html .= '</form>';
                    $html .= '</div>';
		$html .= '</div>';
    $html .= '</div>';
  $html .= '</div>';
  
  return $html;
	}
	
	
	public function Admission_Form( $form_id  )
	{
		$this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$this->load->model('gs_admission/submission_model', 'SM');
		$this->load->model('gs_admission/comment_log', 'CL');
		
		
		$gSlot = $this->ff->giveSlot( $form_id );
		$data["form_id"]=$form_id;
		$data["give_slot_id"] = $gSlot["id"];
		
		$form_batch_id = $gSlot["form_batch_id"];
		$data['form_batch_id'] = $form_batch_id;
		
		
		$fInfo = $this->ff->getFormInfo($form_id);
		$grade_id = $fInfo["grade_id"];
		$data['form_no'] = $fInfo["form_no"];
		$data["student_name"] = $fInfo["official_name"];
		$data["formInfo"] = $fInfo;
		$data["fComt"] = $this->ff->getFormComments($form_id);
		$data["currentStage"] = 'Offer';
		$data["batch"] = $this->ff->getBatchInfo($grade_id);
		$data["formHistory"] = $this->CL->get_log($form_id);
		if( $form_batch_id != '' ){
			$data["timeSlots"] = $this->SM->getSlots($form_batch_id,$form_id);	
		}
		
		$User_id=$current_user = (int)$this->session->userdata('user_id');
		
		$emp_id = $this->SM->getUserInfo($User_id);
		
		
		if( !empty( $emp_id ) )
		{
			$data["Emp_id"]  = $emp_id['Emp_id'];
		}
		else
		{
			$data["Emp_id"]  =0;
		}
		
		//var_dump( $data["formHistory"]  ); exit;
		return $this->load->view('gs_admission/fo_followup/fo_followup_comments_notification',$data,TRUE);
	}	
	
	
	
	public function n_get_converssion(){
		$title = "Sania Irfan";
        $ActiveCaseID = 51;
		$StudentGSID = "05-518";
		$this->load->model('student_attendance/activecase_log_desc_model');
        $ACaseDesc = $this->activecase_log_desc_model->getStudentActiveCaseLog($ActiveCaseID);        
		$this->load->model('students/students_current_classlist_model');
        $data['student_info'] = $this->students_current_classlist_model->get_by(array('gs_id' => $StudentGSID));
		
        $CommentsForm = ' 
          <form class="activecase_comments_form">
              <input type="hidden" id="gs_id" name="gs_id" value="' . $StudentGSID . '">
              <input type="hidden" id="activecase_id" name="activecase_id" value="' . $ActiveCaseID . '">
              <div class="chat-message-form">
                <div class="row">
                  <div class="col-md-12">
                    <textarea placeholder="Write Your Message Here" class="form-control margin-bottom" rows="2" id="comments" name="comments" autofocus="autofocus" required="required"></textarea>
                  </div>                
                  
                  <div class="col-md-2 col-sm-4 col-xs-4">                    
                  </div>
                </div>
              </div>
            </form>';

        if($ACaseDesc == "") {
          //$ActiveCaseInfo = $CommentsForm;
		  $ActiveCaseInfo = "";
          echo
          '<h3>' . $data['student_info'][0]->abridged_name . '</h3>' .
          '<div class="profile-header">' . $title . '</div>' .
          $ActiveCaseInfo;
        }else{
          $isLeft = true;


          // Staff Related Data
         // $this->data['staff_150_photo_path'] ='assets/photos/hcm/150x150/staff/';
        //  $this->data['photo_file'] = '.png';

          $ActiveCaseInfo = '<h3>' . $data['student_info'][0]->abridged_name . '</h3> 
            <div class="tab-pane active" id="chat">
              <div class="profile-header">' . $title . '</div>' . $CommentsForm . '                
              <div class="chat-messages user-profile-chat">
                <ul>';

            foreach ($ACaseDesc as $ActiveCase) {              
                //$ImageName = base_url() . $this->data['staff_150_photo_path'] . $ActiveCase['employee_id'] . $this->data['photo_file'];
                //$ImageMale = base_url() . $this->data['staff_150_photo_path'] . "male.png";
                //$ImageFemale = base_url() . $this->data['staff_150_photo_path'] . "female.png";
                //$ImageFound = "Yes";
				
				
				$ImageName = "";
                $ImageMale = "";
                $ImageFemale = "";
                $ImageFound = "";

                if (!file_exists($this->data['staff_150_photo_path'] . $ActiveCase['employee_id'] . $this->data['photo_file'])) {
                    if($ActiveCase['gender'] == 'M'){
                        $ImageName = $ImageMale;
                    }else if($ActiveCase['gender'] == 'F'){
                        $ImageName = $ImageFemale;
                    }

                    $ImageFound = "No";              
                } 

              if($isLeft == true){
                $ActiveCaseInfo .=
                  '<li class="left clearfix">
                    <div class="user-img pull-left"> <img src="' . $ImageName . '" alt="User Avatar"> </div>
                    <div class="chat-body clearfix">
                      <div class="header"> <span class="name">' . $ActiveCase['abridged_name'] . '</span><span class="name"></span> <span class="badge"><!--<i class="fa fa-clock-o"></i>-->' . unix_to_human($ActiveCase['created']) . '</span></div>
                      <p> ' . $ActiveCase['comments'] .' </p>
                    </div>
                  </li>';
                  $isLeft = false;
              }else{
                $ActiveCaseInfo .=
                  '<li class="right clearfix"><span class="user-img pull-right"> <img src="' . $ImageName . '" alt="User Avatar"> </span>
                    <div class="chat-body clearfix">
                      <div class="header"> <span class="name">' . $ActiveCase['abridged_name'] . '</span><span class=" badge"><!--<i class="fa fa-clock-o"></i>-->' . unix_to_human($ActiveCase['created']) . '</span> </div>
                      <p> ' . $ActiveCase['comments'] .' </p>
                    </div>
                  </li>';
                $isLeft = true;
              }                  
            }                  
          $ActiveCaseInfo .=
            '</ul>
          </div>';


          return $ActiveCaseInfo;
        } 
		
		
		
	}
	
	
	
	

	
	
	
		public function add2(){
		if(count($_POST)){
			$this->load->model('student_attendance/activecase_log_model');
			$GSID = $this->input->post('gs_id');
			$ActiveCaseMessage = $this->input->post('messge_comments');
			$ActiveCaseID = $this->input->post('activecase_id');
			$staff_id = $this->input->post('staff_id');
			$current_user=$current_user = (int)$this->session->userdata('user_id');

			// now get current user name and emp_id
			
			
			$notify_id = $this->input->post('notify_id');
			$cat_id = $this->input->post('cat_id');
			$emp_id = $this->input->post('emp_id');
			$notify_to = $this->input->post('notify_to');
			$current_username = $this->input->post('myname');
			
			
			$return_Data = array("c_u" => $current_username, "m"=>$ActiveCaseMessage,"emp_id"=>$emp_id);
			
			// (int)$this->data['staff_registered_data'][0]->id, //152
			
			$table_data = array(
				'activecase_id' => $ActiveCaseID,
				'staff_id' => $notify_to,
				'comments' => $ActiveCaseMessage
			);
			
			 //var_dump( $table_data ); exit;
			$last_id = $this->activecase_log_model->save($table_data);
			// var_dump( $last_id ); exit;
			// add notification here
			$this->load->model('student_attendance/notification_log', 'notify');
			
			$base_url = base_url();
			$url = $last_id;
			
			$register_by = $staff_id;
			$table = "notify_meta_data";
			$notified = $this->notify->notify_to($GSID);
			//var_dump( $notified );
			if( !empty( $notified )){
				foreach( $notified AS $nt ){
					$notify_to = $nt["Notity_To"];
					$data = array("category_id"=>1, "message"=>$ActiveCaseMessage, "gs_id"=>$GSID, "notify_to"=>$notify_to, "log_id"=>$last_id, "created" => time(), "register_by" => $register_by );
					$this->notify->add_record($table,$data);
				}
				$notified_tchr = $this->notify->notify_to_teacher( $GSID, $ActiveCaseID);
				$teacher_id = $notified_tchr["register_by"];
				$data = array("category_id"=>1, "message"=>$ActiveCaseMessage, "gs_id"=>$GSID, "notify_to"=>$teacher_id, "log_id"=>$url, "created" => time(), "register_by" => $register_by );
				$this->notify->add_record($table,$data);
				$category_id = 1;
				$activeCaseIDs = $this->notify->getActivecaseid( $register_by,$url,$GSID,$category_id );
				if( !empty($activeCaseIDs)){
					foreach( $activeCaseIDs AS $log_id ){
						$logid = (int)$log_id["id"];
						if( $logid > 0 ){ $this->notify->set_read($register_by,$logid); }
					}
				}
			}
		}
		
		echo json_encode(array("r" => $last_id, "rd" => $return_Data ) );
	}

}
