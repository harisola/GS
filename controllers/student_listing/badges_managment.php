<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Badges_managment extends CI_Controller{
	private $table_view;
	
    public function __construct(){
        parent::__construct();
		$this->load->library('session');
	}
	
	public function Badges_List(){
		 
		$this->load->model('student_listing/badge_managment_model', 'BM');
		$Grade_id 	=  $this->input->post("Grade_id");
		$Section_id = $this->input->post("Section_id");
		$data["Bedge_Info"] = $this->BM->Get_Bedges($Grade_id, $Section_id);
		$this->load->view('student_listing/landing_page/bedges/badges',$data);
				
	}
	
	
	
	public function Create_Badges(){
		 
		$this->load->model('student_listing/student_info_model', 'SI');
		$Grade_id 	=  $this->input->post("Grade_id");
		$Section_id = $this->input->post("Section_id");
		$Current_Academic = $this->input->post("Current_Academic");
		$Current_Term = $this->input->post("Current_Term");
		$this->load->model('student_listing/student_info_model', 'SI');
		$data['Grade_Section_Student'] = $this->SI->getStudent($Grade_id,$Section_id,$GS_ID=NULL);
		$data["Student_Selected"] =FALSE;
		$data["Grade_id"] = $Grade_id;
		
		$data["Section_id"]= $Section_id;
		$data["Current_Academic"]= $Current_Academic;
		$data["Current_Term"]= $Current_Term;
		
		$this->load->view('student_listing/landing_page/bedges/create_assign_badge',$data);
	}
	
	
	public function Create_Badges_List(){
		 
		$this->load->model('student_listing/badge_managment_model', 'BM');
		$Grade_id 	=  $this->input->post("Grade_id");
		$Section_id = $this->input->post("Section_id");
		
		if( $this->input->post("Badge_id") != NULL ){
			$Badge_id = $this->input->post("Badge_id");
		}else{ 
			$Badge_id=NULL;
		}
		
		
		
		
		$Badge_Assigned_Students = $this->BM->badge_assigned_student($Grade_id, $Section_id, $Badge_id);
		$this->load->view('student_listing/landing_page/bedges/create_assign_badge');
	}
	
	
	public function Create_Badges_Assign(){
		$this->load->model('student_listing/badge_managment_model', 'BM');
		
		$Grade_id 	=  $this->input->post("Grade_id");
		$Section_id = $this->input->post("Section_id");
		$badge_title = $this->input->post("badge_title");
		$badge_code = $this->input->post("badge_code");
	
		$badge_color = $this->input->post("badge_color");
		$badge_priority = $this->input->post("badge_priority");
		$badge_des = $this->input->post("badge_des");
		$Section_id = $this->input->post("Section_id");
		
		$Current_Academic = $this->input->post("Current_Academic");
		$Current_Term = $this->input->post("Current_Term");
		
		if ( $this->input->post("badge_expiry") != NULL ){
			$badge_expiry = $this->input->post("badge_expiry");
		}else{
			$badge_expiry = '0000-00-00';
		}
		$table = "badges";
		$data = array(
			"bedge_title"=>$badge_title,
			"bedge_code"=>$badge_code,
			"bedge_expiry"=>$badge_expiry,
			"bedge_color"=>$badge_color,
			"bedge_priority"=>$badge_priority,
			"bedge_description"=>$badge_des,
			"academic_session_id"=>$Current_Academic,
			"session_term_id"=>$Current_Term,
			"grade_id"=>$Grade_id,
			"section_id"=>$Section_id,
			"created"=>time(),
			"created_by"=>$this->session->userdata("user_id")
		);
		$b_last_id = $this->BM->set($table, $data);
		
		
		if( $this->input->post("students") != NULL ){
			$students = $this->input->post("students");
			$table="bedge_student";
			foreach($students as $student){
				$data = array(
					"bedge_id"=>$b_last_id,
					"student_id"=>$student,
					"created"=>time(),
					"created_by"=>$this->session->userdata("user_id")
				);
				$last_id = $this->BM->set($table, $data);
			}
		}
		
		echo $b_last_id;
	}
	
	
	public function Edit_Badge(){
		
		$this->load->model('student_listing/badge_managment_model', 'BM');
		
		$Badge_id = $this->input->post("Badge_id");
		$Grade_id = $this->input->post("Grade_id");
		$Section_id = $this->input->post("Section_id");
		
		
		$data["Badge_Info"] = $this->BM->Get_Bedge($Badge_id);
		
		$Grade_Section_Student = $this->BM->Badge_Students($Grade_id,$Section_id,$Badge_id);
		if( $Grade_Section_Student != NULL ){
			
			$data["Grade_Section_Student"]=$Grade_Section_Student;
			$data["Student_Selected"]=TRUE;
			
			
			/*
			$query='select cl.id as Student_Id, cl.official_name as Abridged_Name, cl.gs_id as GS_ID,b_data.Badge_id as Badge

from  atif.class_list  as cl
left join ( 
	select bs.student_id as Student_id, bd.ID AS Badge_id  from gs_badges.badges as bd
		left join gs_badges.bedge_student as bs on(bs.bedge_id=bd.ID)
			where
				bs.record_deleted=0 and bd.ID=9 ) as b_data

on(b_data.Student_id = cl.id )
where 
cl.grade_id=13 and cl.section_id=7

group by cl.gs_id
order by cl.call_name';
			*/
			
			
		}else{
			$this->load->model('student_listing/student_info_model', 'SI');
			$Grade_id 	=  $this->input->post("Grade_id");
			$Section_id = $this->input->post("Section_id");
			$Current_Academic = $this->input->post("Current_Academic");
			$Current_Term = $this->input->post("Current_Term");
			$data['Grade_Section_Student'] = $this->SI->getStudent($Grade_id,$Section_id,$GS_ID=NULL);
			$data["Student_Selected"] =FALSE;
		
		}
		 
		$this->load->view('student_listing/landing_page/bedges/edit_badge',$data);
		//$data['Grade_Section_Student'] = $this->SI->getStudent($Grade_id,$Section_id,$GS_ID=NULL);
		
	}
	
	
	
	public function Edit_Badges_Assign(){
		$this->load->model('student_listing/badge_managment_model', 'BM');
		
		
		$badge_title = $this->input->post("ebadge_title");
		$badge_code = $this->input->post("ebadge_code");
		$badge_expiry = $this->input->post("ebadge_expiry");
		$badge_color = $this->input->post("ebadge_color");
		$badge_priority = $this->input->post("ebadge_priority");
		$badge_des = $this->input->post("ebadge_des");
		$Badge_id = $this->input->post("Badge_id");
		
		
		
		
		$table = "badges";
		$data = array(
			"bedge_title"=>$badge_title,
			"bedge_code"=>$badge_code,
			"bedge_expiry"=>$badge_expiry,
			"bedge_color"=>$badge_color,
			"bedge_priority"=>$badge_priority,
			"bedge_description"=>$badge_des,
			"modified"=>time(),
			"modified_by"=>$this->session->userdata("user_id")
		);
		$where = array("ID" => $Badge_id);
		$b_last_id = $this->BM->UPDating($table, $data,$where);
		
		
		if( $this->input->post("students") != NULL ){
			
			$bedge_student="bedge_student";
			$data = array( "modified"=>time(), "modified_by"=>$this->session->userdata("user_id"), "record_deleted"=>1 );
			$where = array("bedge_id" => $Badge_id);
			$b_last_id = $this->BM->UPDating($bedge_student, $data,$where);
		
			$students = $this->input->post("students");
			foreach($students as $student){
				$data = array(
					"bedge_id"=>$Badge_id,
					"student_id"=>$student,
					"created"=>time(),
					"created_by"=>$this->session->userdata("user_id")
				);
				$last_id = $this->BM->set($bedge_student, $data);
			}
			
		}
		
		echo $last_id;
	}
	
	
	function student_table_list(){
		
		$this->load->library('MasterPagStudents_lib','','MPS');
		
		$Grade_id = $this->input->post("Grade_id");
		$Section_id = $this->input->post("Section_id");
		
		
		$data["table_view"] = $this->MPS->get_table_list( $Grade_id, $Section_id );
		$this->load->view('student_listing/landing_page/student_table/stable',$data);
	}
	
	
	
	
	
	
}	