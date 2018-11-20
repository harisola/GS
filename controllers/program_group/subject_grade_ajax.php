<?php

class Subject_grade_ajax extends CI_Controller{

	
	public function get_SC()
	{
		$this->load->model('program_group/subject_grade_mymodel','sjmm');
		$data = $this->sjmm->get_grade();
		echo json_encode($data);
	}

	public function get_NC()
	{
		$this->load->model('program_group/subject_grade_mymodel','sjmm');
		$data = $this->sjmm->get_grade_NC();
		echo json_encode($data);
	}

	public function get_teacher()
	{

		
		if(!empty($this->input->post()))
		{
			$academic_id = $this->input->post('academic');
			$grade_id = $this->input->post('grade');
			$select ='';
			
			$where_class_teacher = array(
				'type_name' => 'Class Teacher',
				'academic_session_id' => $academic_id,
				'grade_id' => $grade_id

			);



			$this->load->model('program_group/subject_grade_rolemodel','sgrm');
			$data['class_teacher'] = $this->sgrm->get_by('role_in_org_view',$where_class_teacher,$select);

			// Redevolpment Select From "Role_teacher_Blocks"// 
			$where_select_class = array(
				'teacher_id' => 'Class Teacher',
				'grade_id' => $grade_id,
				'record_deleted' => 0
			);

			$data['block_select'] = $this->sgrm->get_by('role_teacher_blocks',$where_select_class,$select);
			// End Development



			$where_co_teacher = array(
				'type_name' => 'Co Teacher',
				'academic_session_id' => $academic_id,
				'grade_id' => $grade_id
				
				

			);


			// For Group By With Respect to ID in Role Org View
			$group = 'id';
			$select = '';


			$data['co_teacher'] = $this->sgrm->get_by('role_in_org_view',$where_co_teacher,$select,$group);



			// Redevolpment Select From "Role_teacher_Blocks"// 

			$where_select_class_co = array(
				'teacher_id' => ' Co Teacher',
				'grade_id' => $grade_id,
				'record_deleted' => 0
			);

			$data['block_select_co'] = $this->sgrm->get_by('role_teacher_blocks',$where_select_class_co,$select);



			// End Development



			// Get Compulsory and Optional Subject From atif_subject to subject_grade_ajax fron model subject_grade_role_model

			$optional = 0;

			$data['compulsory'] = $this->sgrm->get_join($optional,$grade_id,$academic_id);

			$optional  = 1;
			$this->load->model('program_group/subject_grade_rolemodel','sgrm');
			$data['optional'] = $this->sgrm->get_join($optional,$grade_id,$academic_id);

				//Academic and Grade ID

			$data['academic_id'] = $academic_id;
			$data['grade_id'] = $grade_id;


			$where_grade = array(
				'grade_id' => $grade_id,
				'academic_session_id' => $academic_id
			 );

			
			$data['subject_grade'] = $this->sgrm->get_by('atif_subject.subject_selection_group_grade',$where_grade);

				//View OF A Groups

			if(!empty($data['subject_grade'])){

				$this->load->model('program_group/subject_grade_rolemodel','sgrm');


				//Distinct Number OF GROUPS
				$data['no_of_group'] = $this->sgrm->get_distinct('atif_subject.subject_selection_group_grade',$grade_id,$academic_id);


				//Blocks Per Weeks



				//Getting Subject OF Group One
				$group_id = 1;
				$grade = $grade_id;
				$academic = $academic_id;

				$data['blocks_per_week_one'] = $this->sgrm->get_blocks($group_id,$grade,$academic);

				

				$data['no_of_subject_one']=$this->sgrm->get_subject($group_id,$grade,$academic);
			
				//Getting Subject OF GROUP 2
				$group_id = 2;
				$grade = $grade_id;
				$academic = $academic_id;

				$data['blocks_per_week_two'] = $this->sgrm->get_blocks($group_id,$grade,$academic);

				

				$data['no_of_subject_two']=$this->sgrm->get_subject($group_id,$grade,$academic);


				//Getting Subject FOR GROUP 3
				$group_id = 3;
				$grade = $grade_id;
				$academic = $academic_id;

				$data['no_of_subject_three']=$this->sgrm->get_subject($group_id,$grade,$academic);

				$data['blocks_per_week_three'] = $this->sgrm->get_blocks($group_id,$grade,$academic);




				//Getting Subject FOR GROUP 4
				$group_id = 4;
				$grade = $grade_id;
				$academic = $academic_id;

				$data['blocks_per_week_four'] = $this->sgrm->get_blocks($group_id,$grade,$academic);

				$data['no_of_subject_four']=$this->sgrm->get_subject($group_id,$grade,$academic);


				//Getting Subject For Group 5
				$group_id = 5;
				$grade = $grade_id;
				$academic = $academic_id;

				$data['blocks_per_week_five'] = $this->sgrm->get_blocks($group_id,$grade,$academic);

				$data['no_of_subject_five']=$this->sgrm->get_subject($group_id,$grade,$academic);

				//Getting Subject For Group 6
				$group_id = 6;
				$grade = $grade_id;
				$academic = $academic_id;

				$data['blocks_per_week_six'] = $this->sgrm->get_blocks($group_id,$grade,$academic);

				$data['no_of_subject_six']=$this->sgrm->get_subject($group_id,$grade,$academic);


			}


			$this->load->view('program_group/subject_grade_role_table',$data);


		}
	}

	public function save_role(){


		$this->load->model('program_group/subject_grade_rolemodel','sgrm');

		// *********************
		// Class teacher Start *
		// *********************



		if(!empty($this->input->post('class_teacher'))){



			$class_staff_id = $this->input->post('class_teacher_staff_id');
			$academic = $this->input->post('academic_session_id');
			$class_teacher = $this->input->post('class_teacher');
			$grade_class_teacher = $this->input->post('grade_id');
			$section_class_teacher = $this->input->post('section_id');
			$block_class_teacher = $this->input->post('class_teacher_block');
			$counter = 0;

			foreach($class_teacher as $value){
				$data_class_teacher = array(

					'teacher_id' => $value,
					'staff_id' => $class_staff_id[$counter],
					'academic_session_id' => $academic[$counter],
					'grade_id' => $grade_class_teacher[$counter],
					'section_id' => $section_class_teacher[$counter],
					'blocks_per_week' => $block_class_teacher[$counter],
					'created' => time(),
					'register_by' => $this->session->userdata('user_id'),
					'modified' =>time(),
					'modified_by' => $this->session->userdata('user_id')
				);
				

				// echo json_encode($data);
				$where_data = array(

					'teacher_id' => $value,
					'grade_id' => $grade_class_teacher[$counter],
					'section_id' => $section_class_teacher[$counter],
					'staff_id' => $class_staff_id[$counter],
					'academic_session_id' => $academic[$counter]
					//'blocks_per_week' => $block_class_teacher[$counter],
				);

				$update_data = array(

					'record_deleted' => 1,
					'modified' => time(),
					'modified_by' => $this->session->userdata('user_id')
				);

				$counter++;

				$this->sgrm->update('role_teacher_blocks',$where_data,$update_data);

				$rows = $this->sgrm->insert_data('role_teacher_blocks',$data_class_teacher);

			}
		}

		// *******************
		// Class Teacher End //
		//********************


		//********************* 
		//CO Teacher Start   //
		//*********************

		if(!empty($this->input->post('co_teacher')))
		{	
			

			$co_staff_id = $this->input->post('Co_teacher_staff_id');
			$co_academic = $this->input->post('co_academic_session_id');
			$co_teacher = $this->input->post('co_teacher');
			$grade_co_teacher = $this->input->post('grade_id');
			$section_co_teacher = $this->input->post('section_id');
			$co_blocks = $this->input->post('co_block');
			$counter = 0;

			foreach($co_teacher as $value){
				$data_co_teacher = array(

					'teacher_id' => $value,
					'staff_id' => $co_staff_id[$counter],
					'academic_session_id' => $co_academic[$counter],
					'grade_id' => $grade_co_teacher[$counter],
					'section_id' => $section_co_teacher[$counter],
					'blocks_per_week' => $co_blocks[$counter],
					'created' => time(),
					'register_by' => $this->session->userdata('user_id'),
					'modified' =>time(),
					'modified_by' => $this->session->userdata('user_id')

				);



				$where_co_data = array(

					'teacher_id' => $value,
					'staff_id' => $co_staff_id[$counter],
					'academic_session_id' => $academic[$counter],
					'grade_id' => $grade_class_teacher[$counter],
					'section_id' => $section_class_teacher[$counter],
				);

				$co_update_data = array(

					'record_deleted' => 1,
					'modified' => time(),
					'modified_by' => $this->session->userdata('user_id')
				);

				$counter++;

				$this->sgrm->update('role_teacher_blocks',$where_co_data,$co_update_data);

				$rows = $this->sgrm->insert_data('role_teacher_blocks',$data_co_teacher);
			}
		}

		//*****************
		//Co Teacher End **
		//*****************

	}

	//*******************
	// Save Group   *****	
 	// ******************
	public function save_group()
	{

		$grade = $this->input->post('grade_id');

		$data['academic_id'] = $this->input->post('academic_id');
		$data['grade_id'] = $this->input->post('grade_id');
		$group_number = $this->input->post('number-group');
		$select='';

		$where = array(
			'id <='=> $group_number

		);

		$this->load->model('program_group/subject_grade_model','sgm');
		$data['group']=$this->sgm->get_by('subject_selection_group',$select,$where);



		$where_grade = array(
			'grade_id' => $grade
		);


		$data['select_group']=$this->sgm->get_by('subject_selection_group_grade',$select,$where_grade);
		$this->load->view('program_group/subject_grade_group',$data);
	}

	//*******************
	// Save Group End ***
	//*******************

	public function save_group_subject()
	{
		// var_dump($this->input->post());
		// exit;


		$subject_name = $this->input->post('subject');	
		$group = $this->input->post('group');
		$group_id = $this->input->post('group_id');
		$academic = $this->input->post('academic_id');
		$grade = $this->input->post('grade_id');
		$block_per_week = $this->input->post('bpw');





		for($i=0; $i<sizeof($subject_name); $i++)
		{


			$data = array(
				'subject_id'=>$subject_name[$i],
				'group_id'=>$group[$i],
				'grade'=>$grade,
				'academic_session_id'=>$academic,
				'bpw'=>$block_per_week


			);

			if($data['group_id'] == 1)
			{	
				$block = $block_per_week[0];
			}

			if($data['group_id'] == 2)
			{	
				$block = $block_per_week[1];
			}

			if($data['group_id'] == 3)
			{	
				$block = $block_per_week[2];
			}

			if($data['group_id'] == 4)
			{	
				$block = $block_per_week[3];
			}

			if($data['group_id'] != '')
			{
				if($data['group_id'] == 5)
				{	
					$block = $block_per_week[4];
				}
			}

			if($data['group_id'] != '')
			{
				if($data['group_id'] == 6)
				{	
					$block = $block_per_week[5];
				}
			}

			$data_one = array(

				'academic_session_id'=>$academic,
				'grade_id'=>$grade,
				'subject_id'=>$subject_name[$i],
				'subject_selection_group_id'=>$group[$i],
				'blocks_per_week'=>$block,
				'created'=>time(),
				'register_by'=>$this->session->userdata('user_id'),
				'modified'=>time(),
				'modified_by'=>$this->session->userdata('user_id')

			);



			// var_dump($data['group_id']);

			$this->load->model('program_group/subject_grade_model','sgm');
			$insert = $this->sgm->save('subject_selection_group_grade',$data_one);

			
		}

		

	}

	
	//********************** 
	//Compulsory Programme *
	//**********************

	public function save_comp()
	{

		$this->load->model('program_group/subject_grade_model','sgm');

		$academic_id = $this->input->post('academic_id');
		$grade_id = $this->input->post('grade_id');
		$subject = $this->input->post('subject_id');
		$bpw = $this->input->post('bpw_comp');

		$counter = 0;

		foreach ($subject as  $value) {
			
			// $data = array(
			// 	'academic_session_id' => $academic_id,
			// 	'grade_id' => $grade_id,
			// 	'subject_id' => $value,
			// 	'block_per_week' => $bpw[$counter]
			// );

			$where = array(

				'sessionID' => $academic_id,
				'gradeID' => $grade_id,
				'subjects' => $value,

			);

			$data_update = array(
				'blocks_per_week' => $bpw[$counter]
			);

			$counter++;

			$row = $this->sgm->update('programmesetup',$where,$data_update);

			
			// echo json_encode($data);
			
		}
		
	}

	//***************************
	// End Compulsory Programme *
	//***************************


	// *************************
	// Optional Programme      *
	// *************************


	public function save_option()
	{
		$academic_id = $this->input->post('academic_id');
		$grade_id = $this->input->post('grade_id');
		$subject = $this->input->post('subject_id');
		$bpw = $this->input->post('bpw');
		$counter = 0;
		foreach ($subject as  $value) {
			
			$data = array(
				'academic_session_id' => $academic_id,
				'grade_id' => $grade_id,
				'subject_id' => $value,
				'block_per_week' => $bpw[$counter]
			);

			$counter++;
			echo json_encode($data);

		}
	}

	//************************
	//End Optional Programme *
	//************************


	// public function save_view_insert()
	// {



	// 	$this->load->model('program_group/subject_grade_model','sgm');



	// 		// ***************
	// 		// For Group One *
	// 		//****************

	// 	$academic = $this->input->post('academic_id');
	// 	$grade  = $this->input->post('grade_id');
	// 	$group_one = $this->input->post('group_id_1');
	// 	$block_group_one = $this->input->post('bpw_1');
	// 	$subject_group_one = $this->input->post('subject_1');
	// 	$counter = 0;

	// 	foreach ($subject_group_one as  $value) {
			
	// 		$data_group_one = array(
	// 			'academic_session_id'=>$academic,
	// 			'grade_id'=>$grade,
	// 			'subject_id'=>$subject_group_one[$counter],
	// 			'subject_selection_group_id'=>$group_one,
	// 			'blocks_per_week'=> $block_group_one,
	// 			'created'=>time(),
	// 			'register_by'=>$this->session->userdata('user_id'),
	// 			'modified'=>time(),
	// 			'modified_by'=>$this->session->userdata('user_id')

	// 		);
			
	// 		// For Updation Record Delete Update to 1

	// 		$where_update_one = array(
	// 			'academic_session_id'=>$academic,
	// 			'grade_id'=>$grade,
	// 			'subject_id'=>$subject_group_one[$counter],
	// 			'subject_selection_group_id'=>$group_one,
	// 			//'blocks_per_week'=> $block_group_one,
	// 		);

	// 		$counter++;

	// 		$data_update_one = array(
				
				
	// 			'modified'=>time(),
	// 			'modified_by'=>$this->session->userdata('user_id'),
	// 			'record_deleted' => 1

	// 		);


	// 		$rows = $this->sgm->update('subject_selection_group_grade',$where_update_one,$data_update_one);	

			
	// 		// Insert Data into Table

	// 		$this->sgm->save('subject_selection_group_grade',$data_group_one);

	// 		//var_dump($data);
	// 	}

	// 	// ************
	// 	//For Group 2 *
	// 	//*************

	// 	$group_two = $this->input->post('group_id_2');
	// 	$block_group_two = $this->input->post('bpw_2');
	// 	$subject_group_two = $this->input->post('subject_2');
	// 	$counter = 0;


	// 	if(!empty($subject_group_two)) {
	// 	foreach ($subject_group_two as  $value) {
	// 		$data_group_two = array(

	// 			'academic_session_id'=>$academic,
	// 			'grade_id'=>$grade,
	// 			'subject_id'=>$subject_group_two[$counter],
	// 			'subject_selection_group_id'=>$group_two,
	// 			'blocks_per_week'=> $block_group_two,
	// 			'created'=>time(),
	// 			'register_by'=>$this->session->userdata('user_id'),
	// 			'modified'=>time(),
	// 			'modified_by'=>$this->session->userdata('user_id')

	// 		);

			
	// 		// For Updation Record Delete Update to 1

	// 		$where_update_two = array(
	// 			'academic_session_id'=>$academic,
	// 			'grade_id'=>$grade,
	// 			'subject_id'=>$subject_group_two[$counter],
	// 			'subject_selection_group_id'=>$group_two,
	// 			//'blocks_per_week'=> $block_group_two,
	// 		);


	// 		$counter++;


	// 		$data_update_two = array(
				
	// 			'modified'=>time(),
	// 			'modified_by'=>$this->session->userdata('user_id'),
	// 			'record_deleted' => 1

	// 		);

	// 		$this->sgm->update('subject_selection_group_grade',$where_update_two,$data_update_two);

	// 		// var_dump($data_group_two);
	// 		$this->sgm->save('subject_selection_group_grade',$data_group_two);
	// 	}
	// }

	// 	//************* 
	// 	//For group 3 *
	// 	//*************

	// 	$group_three = $this->input->post('group_id_3');
	// 	$block_group_three = $this->input->post('bpw_3');
	// 	$subject_group_three = $this->input->post('subject_3');
	// 	$counter = 0;

	// 	if(!empty($subject_group_three)){	
	// 	foreach($subject_group_three as $value)
	// 	{
	// 		$data_group_three = array(

	// 			'academic_session_id'=>$academic,
	// 			'grade_id'=>$grade,
	// 			'subject_id'=>$subject_group_three[$counter],
	// 			'subject_selection_group_id'=>$group_three,
	// 			'blocks_per_week'=> $block_group_three,
	// 			'created'=>time(),
	// 			'register_by'=>$this->session->userdata('user_id'),
	// 			'modified'=>time(),
	// 			'modified_by'=>$this->session->userdata('user_id')
	// 		);

			

	// 		$where_update_three = array(
	// 			'academic_session_id'=>$academic,
	// 			'grade_id'=>$grade,
	// 			'subject_id'=>$subject_group_three[$counter],
	// 			'subject_selection_group_id'=>$group_three,
	// 			//'blocks_per_week'=> $block_group_three,
	// 		);

	// 		$counter++;

	// 		$data_update_three = array(
				
	// 			'modified'=>time(),
	// 			'modified_by'=>$this->session->userdata('user_id'),
	// 			'record_deleted' => 1

	// 		);

	// 		$this->sgm->update('subject_selection_group_grade',$where_update_three,$data_update_three);

	// 		$this->sgm->save('subject_selection_group_grade',$data_group_three);			

	// 		// var_dump($data_group_three);
	// 	}
	// }

	// 	//*************
	// 	//For Group 4 *
	// 	//*************

	// 	$group_four = $this->input->post('group_id_4');
	// 	$block_group_four = $this->input->post('bpw_4');
	// 	$subject_group_four = $this->input->post('subject_4');
	// 	$counter = 0;

	// 	if(!empty($subject_group_four)) {

	// 	foreach ($subject_group_four as  $value) {
			
	// 		$data_group_four = array(

	// 			'academic_session_id'=>$academic,
	// 			'grade_id'=>$grade,
	// 			'subject_id'=>$subject_group_four[$counter],
	// 			'subject_selection_group_id'=>$group_four,
	// 			'blocks_per_week'=> $block_group_four,
	// 			'created'=>time(),
	// 			'register_by'=>$this->session->userdata('user_id'),
	// 			'modified'=>time(),
	// 			'modified_by'=>$this->session->userdata('user_id')
	// 		);

	// 		$where_update_four = array(
	// 			'academic_session_id'=>$academic,
	// 			'grade_id'=>$grade,
	// 			'subject_id'=>$subject_group_four[$counter],
	// 			'subject_selection_group_id'=>$group_four,
	// 			//'blocks_per_week'=> $block_group_four,
	// 		);

	// 		$counter++;

	// 		$data_update_four = array(
				
	// 			'modified'=>time(),
	// 			'modified_by'=>$this->session->userdata('user_id'),
	// 			'record_deleted' => 1

	// 		);

	// 		$rows = $this->sgm->update('subject_selection_group_grade',$where_update_four,$data_update_four);

			

	// 		$this->sgm->save('subject_selection_group_grade',$data_group_four);

			
	// 	}
	// }


	// }
	

	public function save_view_insert()
	{

		// var_dump($this->input->post());
		// exit;

		$this->load->model('program_group/subject_grade_model','sgm');



			// ***************
			// For Group One *
			//****************

		$academic = $this->input->post('academic_id');
		$grade  = $this->input->post('grade_id');
		$group_one = $this->input->post('group_id_1');
		$block_group_one = $this->input->post('bpw_1');
		$subject_group_one = $this->input->post('subject_1');
		$counter = 0;

		foreach ($subject_group_one as  $value) {
			
			$data_group_one = array(
				'academic_session_id'=>$academic,
				'grade_id'=>$grade,
				'subject_id'=>$subject_group_one[$counter],
				'subject_selection_group_id'=>$group_one,
				'blocks_per_week'=> $block_group_one,
				'created'=>time(),
				'register_by'=>$this->session->userdata('user_id'),
				'modified'=>time(),
				'modified_by'=>$this->session->userdata('user_id')

			);
			
			// For Updation Record Delete Update to 1

			$where_update_one = array(
				'academic_session_id'=>$academic,
				'grade_id'=>$grade,
			//	'subject_id'=>$subject_group_one[$counter],
				'subject_selection_group_id'=>$group_one,
				//'blocks_per_week'=> $block_group_one,
			);

			if($counter  == 0){

			$this->sgm->delete_data('subject_selection_group_grade',$where_update_one);
			}

			$counter++;



			
			// Insert Data into Table

			$this->sgm->save('subject_selection_group_grade',$data_group_one);


		}

		// ************
		//For Group 2 *
		//*************

		$group_two = $this->input->post('group_id_2');
		$block_group_two = $this->input->post('bpw_2');
		$subject_group_two = $this->input->post('subject_2');
		$counter = 0;


		if(!empty($subject_group_two)) {
		foreach ($subject_group_two as  $value) {
			$data_group_two = array(

				'academic_session_id'=>$academic,
				'grade_id'=>$grade,
				'subject_id'=>$subject_group_two[$counter],
				'subject_selection_group_id'=>$group_two,
				'blocks_per_week'=> $block_group_two,
				'created'=>time(),
				'register_by'=>$this->session->userdata('user_id'),
				'modified'=>time(),
				'modified_by'=>$this->session->userdata('user_id')

			);

			
			// For Updation Record Delete Update to 1

			$where_update_two = array(
				'academic_session_id'=>$academic,
				'grade_id'=>$grade,
				//'subject_id'=>$subject_group_two[$counter],
				'subject_selection_group_id'=>$group_two,
				//'blocks_per_week'=> $block_group_two,
			);

			if($counter == 0){

				$this->sgm->delete_data('subject_selection_group_grade',$where_update_two);

			}

			$counter++;

			// Insert Data into Table
			
			$this->sgm->save('subject_selection_group_grade',$data_group_two);
		}
	}

		//************* 
		//For group 3 *
		//*************

		$group_three = $this->input->post('group_id_3');
		$block_group_three = $this->input->post('bpw_3');
		$subject_group_three = $this->input->post('subject_3');
		$counter = 0;

		if(!empty($subject_group_three)){	
		foreach($subject_group_three as $value)
		{
			$data_group_three = array(

				'academic_session_id'=>$academic,
				'grade_id'=>$grade,
				'subject_id'=>$subject_group_three[$counter],
				'subject_selection_group_id'=>$group_three,
				'blocks_per_week'=> $block_group_three,
				'created'=>time(),
				'register_by'=>$this->session->userdata('user_id'),
				'modified'=>time(),
				'modified_by'=>$this->session->userdata('user_id')
			);

			

			$where_update_three = array(
				'academic_session_id'=>$academic,
				'grade_id'=>$grade,
				//'subject_id'=>$subject_group_three[$counter],
				'subject_selection_group_id'=>$group_three,
				//'blocks_per_week'=> $block_group_three,
			);

			if($counter == 0){
				$this->sgm->delete_data('subject_selection_group_grade',$where_update_three);
			}

			$counter++;

			// Insert Data into Table

			$this->sgm->save('subject_selection_group_grade',$data_group_three);			

			// var_dump($data_group_three);
		}
	}

		//*************
		//For Group 4 *
		//*************

		$group_four = $this->input->post('group_id_4');
		$block_group_four = $this->input->post('bpw_4');
		$subject_group_four = $this->input->post('subject_4');
		$counter = 0;

		if(!empty($subject_group_four)) {

		foreach ($subject_group_four as  $value) {
			
			$data_group_four = array(

				'academic_session_id'=>$academic,
				'grade_id'=>$grade,
				'subject_id'=>$subject_group_four[$counter],
				'subject_selection_group_id'=>$group_four,
				'blocks_per_week'=> $block_group_four,
				'created'=>time(),
				'register_by'=>$this->session->userdata('user_id'),
				'modified'=>time(),
				'modified_by'=>$this->session->userdata('user_id')
			);

			$where_update_four = array(
				'academic_session_id'=>$academic,
				'grade_id'=>$grade,
				//'subject_id'=>$subject_group_four[$counter],
				'subject_selection_group_id'=>$group_four,
				//'blocks_per_week'=> $block_group_four,
			);

			if($counter == 0){
				$this->sgm->delete_data('subject_selection_group_grade',$where_update_four);
			}

			$counter++;



			// Insert Data into Table

			$this->sgm->save('subject_selection_group_grade',$data_group_four);

			
		}
	}


		//*************
		//For Group 5 *
		//*************

		$group_five = $this->input->post('group_id_5');
		$block_group_five = $this->input->post('bpw_5');
		$subject_group_five = $this->input->post('subject_5');
		$counter = 0;

		if(!empty($subject_group_five)) {

		foreach ($subject_group_five as  $value) {
			
			$data_group_five = array(

				'academic_session_id'=>$academic,
				'grade_id'=>$grade,
				'subject_id'=>$subject_group_five[$counter],
				'subject_selection_group_id'=>$group_five,
				'blocks_per_week'=> $block_group_five,
				'created'=>time(),
				'register_by'=>$this->session->userdata('user_id'),
				'modified'=>time(),
				'modified_by'=>$this->session->userdata('user_id')
			);

			$where_update_five = array(
				'academic_session_id'=>$academic,
				'grade_id'=>$grade,
				//'subject_id'=>$subject_group_four[$counter],
				'subject_selection_group_id'=>$group_five,
				//'blocks_per_week'=> $block_group_four,
			);

			if($counter == 0){
				$this->sgm->delete_data('subject_selection_group_grade',$where_update_five);
			}

			$counter++;



			// Insert Data into Table

			$this->sgm->save('subject_selection_group_grade',$data_group_five);

			
		}
	}


		//*************
		//For Group 6 *
		//*************

		$group_six = $this->input->post('group_id_6');
		$block_group_six = $this->input->post('bpw_6');
		$subject_group_six = $this->input->post('subject_6');
		$counter = 0;

		if(!empty($subject_group_six)) {

		foreach ($subject_group_six as  $value) {
			
			$data_group_six = array(

				'academic_session_id'=>$academic,
				'grade_id'=>$grade,
				'subject_id'=>$subject_group_six[$counter],
				'subject_selection_group_id'=>$group_six,
				'blocks_per_week'=> $block_group_six,
				'created'=>time(),
				'register_by'=>$this->session->userdata('user_id'),
				'modified'=>time(),
				'modified_by'=>$this->session->userdata('user_id')
			);

			$where_update_six = array(
				'academic_session_id'=>$academic,
				'grade_id'=>$grade,
				//'subject_id'=>$subject_group_four[$counter],
				'subject_selection_group_id'=>$group_six,
				//'blocks_per_week'=> $block_group_four,
			);

			if($counter == 0){
				$this->sgm->delete_data('subject_selection_group_grade',$where_update_six);
			}

			$counter++;



			// Insert Data into Table

			$this->sgm->save('subject_selection_group_grade',$data_group_six);

			
		}
	}


	}


}