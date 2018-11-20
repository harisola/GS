<?php

class Assign_teacher_ajax extends CI_Controller{

	function __construct(){

		parent::__construct();
	}

	public function get_table(){


			$academic_id = $this->input->post('academic');
			$grade_id = $this->input->post('grade');

			$this->load->model('roles/teacher/assign_teacher_mymodel','atm');

			//Get Section Name 

			$where = array(
				'academic_session_id' => $academic_id,
				'grade_id' => $grade_id
			);

			$group_by = 'section_id';
			$select = 'section_id,section_name';

			$data['section']=$this->atm->get_group_by('class_list',$where,$select,$group_by);
			
			//Get Grade Name

			$where_grade = array(
				'id' => $grade_id
			);

			$data['grade'] = $this->atm->get_group_by('_grade',$where_grade);



			// Get Staff Name

			$data['staff'] = $this->atm->get_group_by('staff_registered');

			// Get Subject 

			

			//Get Teacher_Type_Id

			$this->load->model('roles/teacher/assign_teacher_role_model','atrm');
			$data['teacher_type']=$this->atrm->get_by("atif_role_matrix.role_teacher_type");

			// var_dump($data['teacher_type']);
			// exit;
			
			// Get Compulsory Subject

			$data['subject'] = $this->atrm->get_subject($academic_id,$grade_id);

			// Get Optional Subject	

			$data['subject_optional'] = $this->atrm->get_subject_optional($academic_id,$grade_id);

			//Get Maximum Group Block



			$where = array(
				'acadmic' => $academic_id,
				'grade' => $grade_id
			);

			$select = "MAX(block) As no_of_group_block";

			$data['group_block'] = $this->atrm->get_by('atif_subject.subjectblock',$where,$select);

			//var_dump($data['group_block']);
			// exit;

			$data['subjectblock'] = $this->atrm->get_by('atif_subject.subjectblock',$where);

			// var_dump($data['subject_optional']);
			// var_dump($data['subjectblock']);



			$data['academic'] = $academic_id;

			$where_available = array(
				'academic_session_id' => $academic_id,
				'grade_id' => $grade_id,
			);

			$data_available = $this->atrm->get_by("atif_role_matrix.role_class_teacher",$where_available);
			// var_dump($data_available);
			// exit;

			if(!empty($data_available)){

				

				// ========================= 
				//	Get Class Teacher Data
				//==========================
				$teacher_type = 1;
				$data['get_class_teacher'] =  $this->atrm->get_join($academic_id,$grade_id,$teacher_type);


				// var_dump($data['get_class_teacher']);
				// exit;

				//Get Blocks Per Week

				$where_class = array(
					'academic_session_id' => $academic_id,
					'grade_id' => $grade_id,
					'teacher_type_id'=> $teacher_type
				); 

				$select = 'blocks_per_week';

				$data['get_class_block'] = $this->atrm->get_distinct('atif_role_matrix.role_class_teacher',$where_class,$select);

				
				// ==========================
				// Get Co Teacher Data
				//===========================
				$teacher_type = 2;
				$data['get_co_teacher'] = $this->atrm->get_join($academic_id,$grade_id,$teacher_type);

				//Get Blocks Per Week

				$where_class = array(
					'academic_session_id' => $academic_id,
					'grade_id' => $grade_id,
					'teacher_type_id'=> $teacher_type
				); 

				$select = 'blocks_per_week';

				$data['get_co_block'] = $this->atrm->get_distinct('atif_role_matrix.role_class_teacher',$where_class,$select);

				// ================================ 
				//	Get Reading Teacher Data
				// ===============================

				$teacher_type = 3;
				$data['get_reading_teacher'] = $this->atrm->get_join($academic_id,$grade_id,$teacher_type);



				//Get Blocks Per Week

				$where_class = array(
					'academic_session_id' => $academic_id,
					'grade_id' => $grade_id,
					'teacher_type_id'=> $teacher_type
				); 

				$select = 'blocks_per_week';

				$data['get_reading_block'] = $this->atrm->get_distinct('atif_role_matrix.role_class_teacher',$where_class,$select);

				//Get Subject Teacher
				
				$data['get_subject_teacher'] = $this->atrm->get_subject_teacher($academic_id,$grade_id);

				$data['get_subject_teacher_optional'] = $this->atrm->get_subject_teacher_optional($academic_id,$grade_id);

				// var_dump($data['get_subject_teacher_optional']);



				$this->load->view('roles/teacher/assign_teacher_edit_table',$data);

			}
			else if(empty($data_available)){
				$this->load->view('roles/teacher/assign_teacher_table',$data);
			}
	}

	


	public function insert_teacher(){
		
		/*var_dump($this->input->post());
		exit;*/
		$staff_field_name = $this->input->post('staff_id_class');
		$teacher_type = $this->input->post('teacher_type_id');

		$this->load->model('roles/teacher/assign_teacher_role_model','atrm');

		//========================
		//Class Teacher
		//========================

		if($teacher_type == '1'){
			
			$academic = $this->input->post('academic_session_id');
			$grade = $this->input->post('grade_id');
			$section = $this->input->post('section_id');
			$teacher_type = $this->input->post('teacher_type_id');
			$class_teacher_position = $this->input->post('class_teacher_position');
			$bpw = $this->input->post('blocks_per_week');
			$staff_id = $this->input->post('value');
			$grade_name = $this->input->post('grade_name');
			$section_name = $this->input->post('section_name');

			$position = explode('-',$class_teacher_position);
			$class_position = $grade_name."-"."CLTR"."-"."0"."-".$section_name;

			$data = array(
				'academic_session_id' => $academic,
				'grade_id' => $grade,
				'section_id' => $section,
				'teacher_type_id' => $teacher_type,
				'gp_id' => $class_position,
				'blocks_per_week' => $bpw,
				'staff_id' => $staff_id,
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			);

			$affected_rows = $this->atrm->save('atif_role_matrix.role_class_teacher',$data);




			/********************************************************** Role in ORG -- Old Roles
			*************************************************************************************/
			$where = array(
				'academic_session_id' => $academic,
				'grade_id' => $grade,
				'section_id' => $section,
				'type_id' => 15
			);
			$data = array(
				'staff_id' => $staff_id,
			);
			$affected_rows_oldRoles=$this->atrm->update_data('atif_role.role_in_org',$where,$data);
			/*************************************************************************************/
			echo $affected_rows;
		}

		//=================================
		// Co Teacher 
		//=================================

		if($teacher_type == '2'){
			
			$academic = $this->input->post('academic_session_id');
			$grade = $this->input->post('grade_id');
			$section = $this->input->post('section_id');
			$teacher_type = $this->input->post('teacher_type_id');
			$co_teacher_position = $this->input->post('co_teacher_position');
			$bpw = $this->input->post('blocks_per_week');
			$staff_id = $this->input->post('value');
			$grade_name = $this->input->post('grade_name');
			$section_name = $this->input->post('section_name');

			
			$co_position = $grade_name."-"."COTR"."-"."0"."-".$section_name;

			$data = array(
				'academic_session_id'=>$academic,
				'grade_id'=>$grade,
				'section_id'=>$section,
				'teacher_type_id' => $teacher_type,
				'gp_id' => $co_position,
				'blocks_per_week' => $bpw,
				'staff_id' => $staff_id,
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			);

			$affected_rows = $this->atrm->save('atif_role_matrix.role_class_teacher',$data);



			/********************************************************** Role in ORG -- Old Roles
			*************************************************************************************/
			$where = array(
				'academic_session_id' => $academic,
				'grade_id' => $grade,
				'section_id' => $section,
				'type_id' => 16
			);
			$data = array(
				'staff_id' => $staff_id,
			);
			$affected_rows_oldRoles=$this->atrm->update_data('atif_role.role_in_org',$where,$data);
			/*************************************************************************************/
			echo $affected_rows;


		}

		// =============================
		// Reading Teacher  
		// =============================

		if($teacher_type == '3'){
			
			$academic = $this->input->post('academic_session_id');
			$grade = $this->input->post('grade_id');
			$section = $this->input->post('section_id');
			$teacher_type = $this->input->post('teacher_type_id');
			$reading_teacher_position = $this->input->post('reading_teacher_position');
			$bpw = $this->input->post('blocks_per_week');
			$staff_id = $this->input->post('value');
			$grade_name = $this->input->post('grade_name');
			$section_name = $this->input->post('section_name');

			
			$reading_teacher = $grade_name."-"."RGTR"."-"."0"."-".$section_name;


			$data = array(
				
				'academic_session_id'=>$academic,
				'grade_id' => $grade,
				'section_id' => $section,
				'teacher_type_id' => $teacher_type,
				'gp_id'=>$reading_teacher,
				'blocks_per_week' => $bpw,
				'staff_id' => $staff_id,
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			);

			$affected_rows = $this->atrm->save('atif_role_matrix.role_class_teacher',$data);
			echo $affected_rows;
		}

	}

	public function edit_bpw(){
		var_dump($this->input->post());
		$blocks_per_week = $this->input->post('block_per_week');
		$academic = $this->input->post('academic_session_id');
		$grade = $this->input->post('grade_id');
		$class_teacher_type = $this->input->post('class_teacher_type');

		$data = array(
			'blocks_per_week' => $blocks_per_week
		);

		$where = array(
			'academic_session_id' => $academic,
			'grade_id' => $grade,
			'teacher_type_id'=>$class_teacher_type
		);

		$this->load->model('roles/teacher/assign_teacher_role_model','atrm');
		$affected_rows = $this->atrm->update_data('atif_role_matrix.role_class_teacher',$where,$data);
		echo $affected_rows;

	}

	public function edit_teacher(){

		


		$teacher_type = $this->input->post('teacher_type_id');
		$this->load->model('roles/teacher/assign_teacher_role_model','atrm');


		if($teacher_type == '1'){


			$id = $this->input->post('pk');
			$section_id = $this->input->post('section_id');
			$academic_session_id = $this->input->post('academic_session_id');
			$grade_id = $this->input->post('grade_id');
			$teacher_type = $this->input->post('teacher_type_id');
			$section_name = $this->input->post('section_name');

			$staff_id = $this->input->post('value');
			$grade_name = $this->input->post('grade_name');

			$where = array(
				'id' => $id,
				'academic_session_id' => $academic_session_id,
				'grade_id' => $grade_id,
				'section_id' => $section_id,
				'teacher_type_id' => $teacher_type
			);

			$data = array(
				'staff_id' => $staff_id,
			);

			$affected_rows=$this->atrm->update_data('atif_role_matrix.role_class_teacher',$where,$data);




			/********************************************************** Role in ORG -- Old Roles
			*************************************************************************************/
			$where = array(
				'academic_session_id' => $academic_session_id,
				'grade_id' => $grade_id,
				'section_id' => $section_id,
				'type_id' => 15
			);
			$data = array(
				'staff_id' => $staff_id,
			);
			$affected_rows_oldRoles=$this->atrm->update_data('atif_role.role_in_org',$where,$data);
			/*************************************************************************************/
			echo $affected_rows;
		
		}

		if($teacher_type == '2'){

			$id = $this->input->post('pk');
			$section_id = $this->input->post('section_id');
			$academic_session_id = $this->input->post('academic_session_id');
			$grade_id = $this->input->post('grade_id');
			$teacher_type = $this->input->post('teacher_type_id');
			$section_name = $this->input->post('section_name');

			$staff_id = $this->input->post('value');
			$grade_name = $this->input->post('grade_name');



			$where = array(

				'id' => $id,
				'academic_session_id' => $academic_session_id,
				'grade_id' => $grade_id,
				'section_id' => $section_id,
				'teacher_type_id' => $teacher_type
			);

			$data = array(
				'staff_id' => $staff_id,
			);

			$affected_rows=$this->atrm->update_data('atif_role_matrix.role_class_teacher',$where,$data);




			/********************************************************** Role in ORG -- Old Roles
			*************************************************************************************/
			$where = array(
				'academic_session_id' => $academic_session_id,
				'grade_id' => $grade_id,
				'section_id' => $section_id,
				'type_id' => 16
			);
			$data = array(
				'staff_id' => $staff_id,
			);
			$affected_rows_oldRoles=$this->atrm->update_data('atif_role.role_in_org',$where,$data);
			/*************************************************************************************/


			
			echo $affected_rows;

		}

		if($teacher_type == '3'){

			$id = $this->input->post('pk');
			$section_id = $this->input->post('section_id');
			$academic_session_id = $this->input->post('academic_session_id');
			$grade_id = $this->input->post('grade_id');
			$teacher_type = $this->input->post('teacher_type_id');
			$section_name = $this->input->post('section_name');

			$staff_id = $this->input->post('value');
			$grade_name = $this->input->post('grade_name');



			$where = array(

				'id' => $id,
				'academic_session_id' => $academic_session_id,
				'grade_id' => $grade_id,
				'section_id' => $section_id,
				'teacher_type_id' => $teacher_type
			);

			$data = array(
				'staff_id' => $staff_id,

			);

			$affected_rows=$this->atrm->update_data('atif_role_matrix.role_class_teacher',$where,$data);
			echo $affected_rows;

		}


	}

	public function get_SC()
	{
		$this->load->model('roles/teacher/assign_teacher_mymodel','atm');
		$data = $this->atm->get_grade();
		echo json_encode($data);
	}

	public function get_NC()
	{
		$this->load->model('roles/teacher/assign_teacher_mymodel','atm');
		$data = $this->atm->get_grade_NC();
		echo json_encode($data);
	}

	public function insert_subject_teacher()
	
	{
		var_dump($this->input->post());

		$this->load->model('roles/teacher/assign_teacher_role_model','atrm');

		$staff_id = $this->input->post('value');
		$section_id = $this->input->post('section_id');
		$academic_session_id = $this->input->post('academic_session_id');
		$grade_id = $this->input->post('grade_id');
		$program_id = $this->input->post('program_id');
		$grade_id = $this->input->post('grade_id');

		// =============================
		//	For Gp ID
		// =============================

		$grade_name = $this->input->post('grade_name');
		$section_name = $this->input->post('section_name');
		$subject_name  = $this->input->post('subject_name');
		$subject_id = $this->input->post('subject_id');

		$where_optional = array(
			'id' =>	$program_id
		);

		$select_optional = 'optional';

		$is_optional = $this->atrm->get_by('atif_subject.programmesetup',$where_optional,$select_optional);

		$optional = $is_optional[0]->optional;

		// For  Subject Code
		
		$where_subject = array(
				'id'=> $subject_id
			);

			$select_subject = "code";

			$sub_code = $this->atrm->get_by('atif_subject.subject',$where_subject,$select_subject);

			$subject_code = $sub_code[0]->code;

		// End Sucbject Code

		if($optional == 0){

			$gp_id = $grade_name."-".$subject_code."-"."0"."-".$section_name;

		}
		// else if($optional == 1){
			
		// 	$gp_id = $grade_name."-".$subject_code."-"."1"."-".$section_name;

		// }



		

		$data = array(
			'academic_session_id' => $academic_session_id,
			'program_id' => $program_id,
			'section_id' => $section_id,
			'gp_id' => $gp_id,
			'staff_id' => $staff_id,
			'created'=>time(),
			'register_by'=> $this->session->userdata('user_id'),
			'modified' => time(),
			'modified_by' => $this->session->userdata('user_id')
		);

		$affected_rows = $this->atrm->save('atif_role_matrix.role_subject_teacher',$data);
		echo $affected_rows;
	}

	public function update_subject_teacher(){

		$this->load->model('roles/teacher/assign_teacher_role_model','atrm');
		var_dump($this->input->post());
		$staff_id = $this->input->post('value');
		$id = $this->input->post('pk');

		$data = array(
			'staff_id' => $staff_id
		);
		$where = array(
			'id' => $id
		);

		$affected_rows = $this->atrm->update_data('atif_role_matrix.role_subject_teacher',$where,$data);
		echo $affected_rows;
	}


	// Insert Optional Subject

	public function insert_optional_subject_teacher(){
		var_dump($this->input->post());

		$staff_id = $this->input->post('value');
		$group_block = $this->input->post('pk');
		$grade_name = $this->input->post('grade_name');
		$subject_name = $this->input->post('subject_name');
		$program_id = $this->input->post('program_id');
		$academic_session_id = $this->input->post('academic_session_id');
		$key = $this->input->post('key');
		$subject_id = $this->input->post('subject_id');

		$key = explode('_', $key);


		$this->load->model('roles/teacher/assign_teacher_role_model','atrm');

		$group = $key[7];




		// For  Subject Code
		
		$where_subject = array(
				'id'=> $subject_id
			);

		$select_subject = "code";

		$sub_code = $this->atrm->get_by('atif_subject.subject',$where_subject,$select_subject);

		$subject_code = $sub_code[0]->code;



		// Get Group Name like A,B,C

		$where = array(
			'id' => $group
		);

		$data['group_name'] = $this->atrm->get_by('atif_subject.subject_selection_group',$where);
	

		$group_name = $data['group_name'][0]->name;

		// Making an Gp_id for Optional Subject	

		$gp_id = $grade_name."-".$subject_code."-".$group_name."-".$group_block;

		var_dump($gp_id);

		// Insert Data into database

		$data = array(
			'academic_session_id' => $academic_session_id,
			'program_id' => $program_id,
			'section_id' => $group_block,
			'gp_id'=>$gp_id,
			'staff_id'=>$staff_id,
			'created'=>time(),
			'register_by'=> $this->session->userdata('user_id'),
			'modified'=>time(),
			'modified_by' => $this->session->userdata('user_id')
		);

		$row = $this->atrm->save('atif_role_matrix.role_subject_teacher',$data);
		echo $row;

	}

	public function edit_optional_subject(){

		var_dump($this->input->post());
		$this->load->model('roles/teacher/assign_teacher_role_model','atrm');
		
		$staff_id = $this->input->post('value');
		$id = $this->input->post('pk');

		$where = array(
			'id' => $id
			 
		);

		$data = array(
			'staff_id' => $staff_id,
			'modified' => time(),
			'modified_by' => $this->session->userdata('user_id'),
		);

		$row = $this->atrm->update_data('atif_role_matrix.role_subject_teacher',$where,$data);
		echo $row;
		


	}


	
}