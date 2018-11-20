<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notify_log extends MY_Controller {
	public function __construct(){
		parent::__construct();				
	}
	public function index(){
		$current_user_id = $this->data['staff_registered_data'][0]->id;
		$userid = (int)$this->session->userdata('user_id'); 
		
		$data['notify_list'] = $this->get_notification($userid);
		//var_dump( $data['notify_list'] );
		//exit;
		//$this->Attendance_Notification(); exit;
		$this->load->view('frontoffice/notify/index.php',$data);
		$this->load->view('frontoffice/notify/footer.php');
	}

	
	public function get_notification($userid){
		$this->load->model('front_office/ajax_base_model', 'ABM' );
		$category=1;
		$unreads = $this->ABM->get_notification_method( $category, $userid );
		if( !empty($unreads) ){
			$unread = $unreads;
		}else{
			$unread =0;
		}
		return $unread;
	}
	
	
	 // Need to create Schedular which will run daily at 7 am
	
	public function Attendance_Notification()
	{
		$this->load->model('student_attendance/notification_log', 'NL');
		
		$Notify_ids = $this->NL->notify_to('00-000');
		
		$Query="select af.id as Form_id from atif_gs_admission.admission_form as af
			where (af.form_assessment_date = '0000-00-00' and af.form_status_id=1 )
			and ( DATEDIFF(curdate(),af.form_submission_date) = 2 )

			union 
			select af.id as Form_id from atif_gs_admission.admission_form as af
			where (af.form_status_id=2 and af.form_assessment_result ='')
			and ( DATEDIFF(curdate(),af.form_assessment_date) = 2 )

			union 
			select af.id as Form_id from atif_gs_admission.admission_form as af
			where (af.form_status_id=4)
			and ( DATEDIFF(curdate(),af.form_discussion_date) = 2 )

			union 
			select af.id as Form_id from atif_gs_admission.admission_form as af
			where (af.form_status_id=5)
			and ( DATEDIFF(curdate(),af.offer_date) = 2 )";
			
		$Result = $this->NL->Run_Query($Query);
		$table="notify_meta_data";
		
		if ( !empty( $Result ) ) 
		{
			foreach( $Result as $r )
			{
				$Form_id =  $r["Form_id"];
					
					if ( !empty( $Notify_ids ) )
					{
						foreach( $Notify_ids as $n )
						{
							$Notity_To = $n["Notity_To"];
							
							$data = array(
							"category_id"=>2,
							"message"=>"Attendance",
							"notify_to"=>$Notity_To,
							"is_read"=>0,
							"log_id"=>$Form_id,
							"created"=>time()
							);
							$this->NL->add_record($table, $data);
						}
					}
				
			}
			
		}
		echo "Successfully Added!";
	
	}
	
	
}