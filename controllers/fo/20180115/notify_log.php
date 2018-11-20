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
		
		$this->load->view('frontoffice/notify/index.php',$data);
		$this->load->view('frontoffice/notify/footer.php');
	}

	
	public function get_notification($userid){
		$this->load->model('front_office/ajax_base_model', 'ABM' );
		$category=1;
		//$notify_to= $current_user_id;
		if( $unreads = $this->ABM->get_notification_method( $category, $userid ) ){
			$unread = $unreads;
		}else{
			$unread =0;
		}
		return $unread;
	}
	
	
}