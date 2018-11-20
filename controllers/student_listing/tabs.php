<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tabs extends CI_Controller{
    public function __construct(){
        parent::__construct();
	}
	
	
	public function view_tab(){
		$this->load->model('student_listing/student_info_model', 'SI');
		$tab_id = $this->input->post("tab_id");
		$student_id = (int)$this->input->post("student_id");
		
		
		$gs_id = $this->input->post("gs_id");
		$gr_no = $this->input->post("gr_no");
		$gf_id = $this->input->post("gf_id");
		
		
		
		$data["tab_id"] = $tab_id;
		$data["student_id"] = $student_id;
		
		$data["gs_id"] = $gs_id;
		$data["gr_no"] = $gr_no;
		$data["gf_id"] = $gf_id;
		
		
		
		if($tab_id == "SMS"){
			
			$this->load->view('student_listing/landing_page/sms_tab',$data);
		}elseif( $tab_id == "Attendance" ){
			
			$this->load->view('student_listing/landing_page/attendance_tab',$data);
		}elseif( $tab_id == "Grade" ){
			
			$this->load->view('student_listing/landing_page/grade_tab',$data);
		}elseif( $tab_id == "Billing" ){
			
			$this->load->view('student_listing/landing_page/billing_tab',$data);
		}elseif( $tab_id == "Discount" ){
			
			$this->load->view('student_listing/landing_page/discount_tab',$data);
		}elseif( $tab_id == "Arrears-Advance" ){
			
			$this->load->view('student_listing/landing_page/arrears_advance_tab',$data);
		}elseif( $tab_id == "Timeline" ){
			
			$this->load->view('student_listing/landing_page/timeline_tab',$data);
		}else{
			
			$student_profile = $this->SI->get_student_by_id($student_id);
			$data['student_profile'] = $student_profile;
			$gf_id = $student_profile["gf_id"];
			$data['parent_info'] = $this->SI->get_parents_info($gf_id);
			$data['work_detail'] = $this->SI->student_family_work_detail($gf_id);
			
			
			$this->load->view('student_listing/landing_page/profile_tab',$data);
		}
		
		
		
		
	}
	
	
	public function student_info(){
		
		$this->load->model('student_listing/student_info_model', 'SI');
		 $this->load->model('class_list/student_basic_profile_model', 'BM' );
		$student_id = (int)$this->input->post("student_id");
		$tab_id 	=  $this->input->post("tab_id");
		$gs_id = $this->input->post("gsid");
		
		
		//$student_profile = $this->SI->get_student_profile($student_id);
		$student_profile = $this->SI->getStudent($grade_id=NULL,$section_id=NULL,$gs_id);
		
		//$student_profile = $this->SI->masterlist($grade_id=NULL,$section_id=NULL,$gs_id);
		// $gf_id = $student_profile[0]["GF_ID"];
		$data['student_profile'] = $student_profile;
		$gf_id = $student_profile["gf_id"];
		
		$data['parent_info'] = $this->SI->get_parents_info($gf_id);
		$grade_id=$student_profile["grade_id"];
		$section_id=$student_profile["section_id"];
		$gr_no = $student_profile["gr_no"];
		
		$siblings_data = $this->BM->get_siblings_data($gr_no);
		//var_dump( $siblings_data ); exit;
		  $father_photo_found = false;
			$mother_photo_found = false;
			
		  if( $siblings_data[0]['siblings_total'] > 1){
			
			
			 foreach ($siblings_data as $sibling) {
				  // checking father, mother photo
				  $data["gr_no"] = $sibling['gr_no'];
				  if(!$father_photo_found){
					$data['father_photo'] = base_url() . 'assets/photos/sis/150x150/father/'.$sibling['gr_no'].'.png';
					if(file_exists('assets/photos/sis/150x150/father/' . $sibling['gr_no'] . '.png')){
					  $father_photo_found = true;
					}
				  }
				  if(!$mother_photo_found){
					$data['mother_photo'] = base_url() . 'assets/photos/sis/150x150/mother/' . $sibling['gr_no'] . '.png';
					if(file_exists('assets/photos/sis/150x150/mother/' . $sibling['gr_no'] . '.png')){
					  $mother_photo_found = true;
					}
				  }
			 }
		  }else{
			   $data["gr_no"] = $gr_no;
			  $father_photo = "assets/photos/sis/150x150/father/".$gr_no.".png";
			  $mother_photo = "assets/photos/sis/150x150/mother/".$gr_no.".png";
		
			  if( file_exists( $father_photo ) ){
					 $data['father_photo'] = base_url() . 'assets/photos/sis/150x150/father/'.$gr_no.'.png'; 
				}else{
					$data['father_photo'] = base_url()."assets/photos/sis/150x150/father/male.png";
				}
				
				if( file_exists($mother_photo) ){
					 $data['mother_photo'] = base_url() . 'assets/photos/sis/150x150/mother/'.$gr_no.'.png';
				}else{
					$data['mother_photo'] = base_url()."assets/photos/sis/150x150/mother/female.png";
				}
		
			
			
		  }
			  
			  
		$p_verf = $this->SI->present_verfication($grade_id,$section_id);
		
	
		
		
		if( $student_profile["To_Time"] != NULL ){
					
					if( !empty( $p_verf ) ){
						
					if( $student_profile["Case_ID"] == 'Unauthorized Absent' ){
						$attendance_varification=2;	
					}elseif( $student_profile["Case_ID"] == 'Authorized Absent' ){
						$attendance_varification=3;	
					}elseif( $student_profile["Case_ID"] == 'Uninformed' ){
						$attendance_varification=2;	
					}else{
						if( $student_profile["Case_Solved"] == 'A' ){
							$attendance_varification=3;	
						}elseif( $student_profile["Case_Solved"] == 'U' ){
							$attendance_varification=2;
						}else{
							$attendance_varification=1;	
						}
						
					}
						
						
					}else{ $attendance_varification=0; }
					
				}else{
					
					date_default_timezone_set("Asia/Karachi");
					if (time() >= strtotime("09:00:00")) {
						
						if( $student_profile["Case_Solved"] == 'A' ){
							$attendance_varification=3;	
						}elseif( $student_profile["Case_Solved"] == 'U' ){
							$attendance_varification=2;
						}else{
							$attendance_varification=2;
						}
						
						//$attendance_varification=2;
						
					}else{ 
					
						// Tap In Wait
						$attendance_varification=5;
						
					}
					
				}
				
		
		$data["attendance_varification"]=$attendance_varification;
		
		$data["tab_id"]=$tab_id;
		$data['work_detail'] = $this->SI->student_family_work_detail($gf_id);
		$this->load->view('student_listing/landing_page/main_right_side',$data );
		
	}
	
	
 

	
}	