<?php
class Program_grade_allocation_ajax extends CI_Controller{

	public function __construct(){
		parent::__construct();
	}

		public function get_subject(){

		
		
		$gradeID = $this->input->post('grade');
		$sectionID = $this->input->post('section');
		$academic_id = $this->input->post('academic');
		$term_id = $this->input->post('term_id');



		$this->load->model('etab_reports/formative_report_model','frm');
		$programsetup = $this->frm->getProgramme($gradeID,$academic_id);



		/***********************************************ProgrammeSetup*************************************************************************************************************************************************************/

		$html = '';
		if(!empty($programsetup)){

			$html .="<thead>";
			$html .="<tbody>";

			foreach ($programsetup as $program) {

				if($program->optional == 1){

					$html .="<tr>";
					$html .= "<td class='optional' data-program='$program->id' data-subject='$program->subjects' data-grade = '".$gradeID."' data-academic = '".$academic_id. "' data-optional = '".$program->optional."'>".$program->name."</td>";
					$html .= "</tr>";
				}
				else if($program->optional == 0){


				$this->load->model('etab_reports/formative_report_model','frm');
				$select = "id,gp_id,staff_id";
				$where = array(
				'program_id' => $program->id,
				'academic_session_id' => $academic_id,
				'section_id' => $sectionID
				);

				$group ='';
				$role = $this->frm->get_by('atif_role_matrix.role_subject_teacher',$select,$where,$group);
				
				
				
					$html .="<tr>";
					$html .= "<td class='compulsory' data-program='$program->id' data-subject='$program->subjects' data-grade = '".$gradeID. "' data-academic ='".$academic_id."' data-section = '".$sectionID."' data-optional = '".$program->optional."' data-role ='".$role[0]->id."'>".$program->name."</td>";
					$html .= "</tr>";
				}	
			}

			$html .="</thead>";
			$html .="</tbody>";

			$html .="<style>
				.optional{
					background-color:#F7DFDA;
				}
				.compulsory{
					background-color:#E2F4FA;
				}
			</style>";


			echo $html;
		}
	}



	public function get_grading(){

		
		$program_id  = $this->input->post('program');
		$academic_id = $this->input->post('academic_id');
		$grade_id = $this->input->post('grade');
		$subject_name = $this->input->post('subject_name');



		$select ='';
		$where ='';
		$group = '';
		$this->load->model('etab/program_grade_allocation/program_grade_allocation_model','pgam');
		$grading = $this->pgam->get_by('atif_subject._grading',$select,$where,$group);


		$where_program_grade = array(
			'program_id'=>$program_id,
			'academic_session_id' => $academic_id,
			'grade_id' => $grade_id
		);


		//==================Get Data For Program Grading if Empty so input box is empty else value is placed in input box =====================================================//
		$weightage_program = $this->pgam->get_by('atif_subject.program_grading',$select,$where_program_grade);



		$html = '';
		$html .= '<div class="col-md-6">';
		$html .= '<div class="callout callout-info" style="display:none;" id="msg-success">
                  <h4>Data Update and Insert Successfully</h4></div>';
		$html .='<div class="powerwidget black"';
		$html .= '<header>';
		$html .=  '<h2 style="color:white;font-size:1.2em;">Program Grading<small style="color:white;font-size:1.2em;">'.$subject_name.'</small></h2>';
		$html .= '</header>';
		$html .= '<div class="inner-spacer" id="gradingMarks" style="height:35vh">';
		

		$html .= '<form action="" class="orb-form" method="POST" id="form">';

		$html .= '<input type="hidden"  value="'.$grade_id.'" name="grade_id">';
		$html .= '<input type="hidden"  value="'.$program_id.'" name="program_id">';
		$html .= '<input type="hidden"  value="'.$academic_id.'" name="academic_id">';

		foreach($grading as $grading_subjects){


			$found = 0;
			$html .= '<div class="row">';
			$html .= '<div class="col-md-3">';
			if($grading_subjects->id == 6){
				$html .= '<label class="label"><strong style="font-size:17px;">'.$grading_subjects->dname.'</strong><span style="margin-left:6px;color:#ba0000;text-transform:none;";><<span></label>';
			}else{
			$html .= '<label class="label"><strong style="font-size:17px;">'.$grading_subjects->dname.'</strong><span style="margin-left:6px;color:#00845c; text-transform:none;">>=<span></label>';
			}
			$html .= '<input type="hidden"  value="'.$grading_subjects->id.'" name=grade_sub[]>';
			$html .= '</div>';
			$html .= '<div class="col-md-3">';
			$html .= '<label class="input">';


			//===================IF Not Empty ===================================//
			//===================================================================//
			if(!empty($weightage_program)){

			for($i=0;$i<sizeof($weightage_program);$i++){
				if($grading_subjects->id == $weightage_program[$i]->grading_id && $weightage_program[$i]->program_id == $program_id && $weightage_program[$i]->academic_session_id == $academic_id && $weightage_program[$i]->grade_id == $grade_id){
					$html .= '<input type="text" id="weightage_sub" name=weightage_sub[] value="'.$weightage_program[$i]->weightage.'">';
					$found = 1;
				}
			}
		}
			
			//========================== IF Empty==================================//
			//====================================================================//

			if($found == 0){
			$html .= '<input type="text" placeholder="Greater Then" id="weightage_sub" name=weightage_sub[]>';
			}
			$html .= '</label>';
			$html .= '</div>';
			$html .= '</div>';

			$html .= '<hr>';
		}

		$html .= '<div class="row">';
		$html .= '<div class="col-md-7">';
		$html .= '<button class="btn btn-primary" style="float:right;margin-top:10px;margin-right:50px;">Submit</button>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</form>';

		$html .= '<script type="text/javascript">
        if($("#form").length)
        {
          //Form Validation
          $("#form").validate({
          	ignore:[],
            rules: {
                     "weightage_sub[]": {
                        required: true
                    }
                    
                  },
                  //Message Validation
                  messages: {
                    "weightage_sub[]": {
                        required: "Please Enter the Weightage"
                    }
                 
                   
                },

                 submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: "POST",
                        url:"program_grade_allocation_ajax/insert_grade",
                        cache:false,

                        success: function (data)
                        {
                          $("#msg-success").css("display","");
                          $("#msg-success").fadeOut(2000);
                        }

                  });

                }
          });
        }';

        $html .='$(document).ready(function () {
		 
		  $("#weightage_sub").keypress(function (e) {
		     
		     if (e.which != 8 && e.which != 0 && (e.which < 46 || e.which > 57)) {
		        //display error message
		       
		               return false;
		    }
		   });
		});</script>';


		echo $html;
	}


	//==============================INSERT AND UPDATE ======================================================================================//

	public function insert_grade(){

	$this->load->model('etab/program_grade_allocation/program_grade_allocation_model','pgam');


	$grade_id = $this->input->post('grade_id');
	$program_id = $this->input->post('program_id');
	$academic_id = $this->input->post('academic_id');
	$grading_scheme = $this->input->post('grade_sub');
	$weightage_grade = $this->input->post('weightage_sub');



	for($i=0 ; $i<sizeof($grading_scheme);$i++){

		// Selecting From grading_program
		$select='id';
		$where_update = array(
			'academic_session_id' => $academic_id,
			'grade_id' => $grade_id,
			'program_id' => $program_id,
			'grading_id' => $grading_scheme[$i],
		);

	//======== Select From program_grading if empty so insert it else update it====//
	//=============================================================================//
		$updation_select = $this->pgam->get_by('atif_subject.program_grading',$select,$where_update);


	//============Updation iF Not Empty ===========================================//
	//=============================================================================//	
		if(!empty($updation_select)){

			$id = $updation_select[0]->id;
			
			$update_data = array(
				'weightage' => $weightage_grade[$i],
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			);

			$where = array(
				'id' => $id
			);

			$row = $this->pgam->save('atif_subject.program_grading',$update_data,$where);
			echo "update";
		}else if(empty($updation_select)){

		//================Insert IF Empty================================================//
		//===============================================================================//	
			
		$data=array(
			'academic_session_id' => $academic_id,
			'grade_id' => $grade_id,
			'program_id' => $program_id,
			'grading_id' => $grading_scheme[$i],
			'weightage' => $weightage_grade[$i],
			'created' => time(),
			'register_by' => $this->session->userdata('user_id'),
			'modified' => time(),
			'modified_by' => $this->session->userdata('user_id')

		);

		$affected_row = $this->pgam->insert_data('atif_subject.program_grading',$data);
		echo $affected_row;
	}

	}




	}

	public function get_asp(){
		
		$grade_id = $this->input->post('grade');
		$academic = $this->input->post('academic');
		$grade_name = $this->input->post('grade_name');
		$term_id = 1;
		$html = '';

		$this->load->model('etab/program_grade_allocation/program_grade_allocation_model','pgam');	



		$group='';
		$select='';
		$where = array(
			'grade_id' => $grade_id,
			'academic_session_id' => $academic,
			'term_id'=> $term_id
		);

		$asp = $this->pgam->get_by('atif_subject_marks.asp_marks_criteria',$select,$where,$group);
	

		if(!empty($asp)){

			$term = $asp[0]->term_id;
			$attendance = $asp[0]->attendance;
			$stationery = $asp[0]->stationery;
			$ptm_orientation = $asp[0]->ptm_orientation;
			$ptm_unit = $asp[0]->ptm_unit;

		}else{
			$term = '';
			$attendance = '';
			$stationery = '';
			$ptm_orientation = '';
			$ptm_unit = '';
		}


		$html .= '<div class="powerwidget black">';
		$html .= '<header>Grade-Level-Asp| '.$grade_name.'</header>';
		$html .= '<div class="inner-spacer">';

		$html .=  '<div class="callout callout-info alert" style="display:none">
                  	<h4>Data Insert And Update Successfully</h4>
                   </div>';
		
		$html .= '<form method="POST" class="orb-form" id="asp">';
		$html .= '<input type="hidden" value="'.$grade_id. '" name="grade_id">';
		$html .= '<input type="hidden" value="'.$academic.'" name="academic">';
		$html .= '<div class="row">';
		$html .= '<div class="col-md-11">';
		$html .= '<fieldset>';
		$html .= '<section>';
		$html .= '<label class="label">Select</label>';
		$html .= '<label class="select"  id="term">';
		$html .= '<select>';
		if(!empty($term)){
			if($term == 1){
			$html .= '<option value="1">First Term</option>';
			}
			else if($term == 2){
				$html .= '<option value="2">Second Term</option>';
			}
		}
		else{
		$html .= '<option value="1" selected>First Term</option>';
		$html .= '<option value="2">Second Term</option>';
		}
		$html .= '</select><i></i>';
		$html .= '</label>';
		$html .= '</section>';
		$html .= '</fieldset>';
		$html .= '</div>';
		$html .= '</div>';

		//============================= Attendance ========================================//
		//================================================================================// 

		$html .= '<hr>';
		$html .= '<div class="row" style="margin-top:10px">';
		$html .= '<div class="col-md-6">';
		$html .= '<label class="label" style="font-size:20px;">Attendance</label>';
		$html .= '</div>';
		$html .= '<div class="col-md-4">';
		$html .= '<label class="input">';
		if(!empty($attendance)){
			$html .= '<input type="text" value="'.$attendance.'" name="Attendance" id="asp-validate">';
		}
		else{
		$html .= '<input type="text" name="Attendance" placeholder="Enter Attendance Marks" id="asp-validate">';
		}
		$html .= '</label>';
		$html .= '</div>';
		$html .= '</div>';



		//=====================================Stationary===================================//
		//=================================================================================//

		$html .= '<hr>';
		$html .= '<div class="row" style="margin-top:10px;">';
		$html .= '<div class="col-md-6">';
		$html .= '<label class="label" style="font-size:20px;">Stationary</label>';
		$html .= '</div>';
		$html .= '<div class="col-md-4">';
		$html .= '<label class="input">';
		if(!empty($stationery)){
			$html .= '<input type="text" value="'.$stationery.'" name="Stationary" id="asp-validate">';
		}
		else{
		$html .= '<input type="text" name="Stationary" placeholder="Enter Stationary Marks" id="asp-validate">';
		}
		$html .= '</label>';
		$html .= '</div>';
		$html .= '</div>';

		//======================================PTM Orientation==============================//
		//===================================================================================//

		$html .= '<hr>';
		$html .= '<div class="row" style="margin-top:10px;">';
		$html .= '<div class="col-md-6">';
		$html .= '<label class="label" style="font-size:20px;">Orientation Meeting</label>';
		$html .= '</div>';
		$html .= '<div class="col-md-4">';
		$html .= '<label class="input">';
		if(!empty($ptm_orientation)){
			$html .='<input type="text" value="'.$ptm_orientation.'" name="orientation_ptm" id="asp-validate">';
		}
		else{
		$html .= '<input type="text" name="orientation_ptm" placeholder="Enter Orientation Meeting Marks" id="asp-validate">';
		}
		$html .= '</label>';
		$html .= '</div>';
		$html .= '</div>';

		//========================================PTM UNIT =====================================//
		//======================================================================================//
		$html .= '<hr>';
		$html .= '<div class="row" style="margin-top:10px;">';
		$html .= '<div class="col-md-6">';
		$html .= '<label class="label" style="font-size:20px;">PTM UNIT</label>';
		$html .= '</div>';
		$html .= '<div class="col-md-4">';
		$html .= '<label class="input">';
		if(!empty($ptm_unit)){
			$html .= '<input type="text" value="'.$ptm_unit.'" name="unit_ptm" id="asp-validate">';
		}
		else{
		$html .= '<input type="text" name="unit_ptm" placeholder="Enter PTM Unit Marks" id="asp-validate">';
		}
		$html .= '</label>';
		$html .= '</div>';
		$html .= '</div>';


		$html .= '<hr>';
		$html .= '<div class="row" style="margin-top:10px;">';
		$html .= '<div class="col-md-10">';
		$html .= '<input type="button" class="btn btn-primary pull-right btn-submit" value="Submit">';
		$html .= '</div>';
		$html .= '</div>';



		$html .='</form>';
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}

	public function insert_asp(){

		$academic_session_id = $this->input->post('academic_id');
		$grade_id = $this->input->post('grade_id');
		$term_id = $this->input->post('term');
		$attendance_marks = $this->input->post('attendance');
		$stationary_marks = $this->input->post('stationary');
		$orientation_ptm_marks = $this->input->post('orientation_ptm');
		$unit_ptm_marks = $this->input->post('unit_ptm');

		$this->load->model('etab/program_grade_allocation/program_grade_allocation_model','pgam');

		//=====================================Data Updated =======================================//
		//=========================================================================================//

		$where = array(
			'grade_id'=> $grade_id,
			'academic_session_id' => $academic_session_id,
			'term_id'=>$term_id,

		);

		$select = 'id';

		$att_sat_ptm = $this->pgam->get_by('atif_subject_marks.asp_marks_criteria',$select,$where);

		if(!empty($att_sat_ptm)){
			$where_update_id = $att_sat_ptm[0]->id;
			$where_update = array(
				'id' => $where_update_id
			);
			$data_update = array(
				'attendance' => $attendance_marks,
				'term_id' => $term_id,
				'stationery' => $stationary_marks,
				'ptm_orientation' => $orientation_ptm_marks,
				'ptm_unit'=>$unit_ptm_marks
			);
			$rows_update = $this->pgam->save('atif_subject_marks.asp_marks_criteria',$data_update,$where_update);
			echo $rows_update;
		}else if(empty($att_sat_ptm )){

		// ====================================Data Insert ========================================//
		//=========================================================================================//
		$data = array(
			'grade_id'=>$grade_id,
			'academic_session_id' => $academic_session_id,
			'term_id'=>$term_id,
			'attendance'=>$attendance_marks,
			'stationery'=>$stationary_marks,
			'ptm_orientation'=>$orientation_ptm_marks,
			'ptm_unit' => $unit_ptm_marks,
			'created' => time(),
			'register_by'=>$this->session->userdata('user_id'),
			'modified' => time(),
			'modified_by' => $this->session->userdata('user_id')

		);

		$affected_row = $this->pgam->insert_data('atif_subject_marks.asp_marks_criteria',$data);
		echo $affected_row;
	  }			
	}
		public function get_overall(){
		
		$grade = $this->input->post('grade');
		$section = $this->input->post('section');
		$academic = $this->input->post('academic');
		$grade_name = $this->input->post('grade_name');


		$select='';
		$where ='';
		$group = '';

		$this->load->model('etab/program_grade_allocation/program_grade_allocation_model','pgam');

		$grading = $this->pgam->get_by('atif_subject._grading',$select,$where,$group);

		$counter = 0;
		$select='';
		$group ='';
		$where_update = array(
			'grade_id' => $grade,
			'academic_session_id' => $academic
		);

		$get_overall = $this->pgam->get_by('atif_subject.overall_grading',$select,$where_update,$group);
		
		// var_dump($get_overall);
		//var_dump($grading);

		$html = '';
		$html .= '<div class="powerwidget black">';
		$html .= '<header>Overall Percentge For Grade| '.$grade_name.'</header>';
		$html .= '<div class="inner-spacer">';
		$html .= '<form class="orb-form"  id="overallgrade">';
		$html .= '<input type="hidden" name="grade_id" value='.$grade.'>';
		$html .= '<input type="hidden" name="academic_session_id" value='.$academic.'>';
		foreach ($grading as $grade) {
			$html .= '<div class="row">';
				$html .= '<div class="col-md-3">';
				$html .= '<input type="hidden" name="grade[]" value='.$grade->id.'>';
				if($grade->id == 6){
					$html .='<label class="label"><strong style="font-size:17px;">'.$grade->dname.'</strong><span style="margin-left:6px;color:#f95959; text-transform:none;"><<span></label>';
				}
				else{
				$html .= '<label class="label"><strong style="font-size:17px;">'.$grade->dname.'</strong><span style="margin-left:6px;color:#00845c; text-transform:none;">>=<span></label>';
				}
				$html .= '</div>';
				$html .= '<div class="col-md-3">';
					$html .= '<label class="input">';
						if(!empty($get_overall)){
							$html .= '<input type="text" value="'.$get_overall[$counter]->weightage.'" name="grade_wieghtage[]" id="asp-validate">';
							
						}
						else{

						$html .= '<input type="text" placeholder="Enter Marks" name="grade_wieghtage[]" id="asp-validate">';
						}
			
					$html .= '</label>';
				$html .= '</div>';
			$html .= '</div>';
			$html .= '<hr>';
			$counter++;
		}

		$html .= '<div class="row">';
		$html .= '<div class="col-md-6">';
		$html .= '<button  class="btn btn-primary pull-right" id="sub"  style="margin-top:10px;">Submit</button>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</form>';
		$html .= '</div>';
		$html .= '</div>';

		


		echo $html;
	}

	public function insert_overallGrading(){

		$this->load->model('etab/program_grade_allocation/program_grade_allocation_model','pgam');


		$grade_id = $this->input->post('grade_id');
		$academic_session_id = $this->input->post('academic_session_id');
		$grading = $this->input->post('grade');
		$grade_wieghtage = $this->input->post('grade_wieghtage');


		//====================Updation Data ==============================//
		//================================================================//

		$select='';
		$group='';
		$where = array(
			'grade_id' => $grade_id,
			'academic_session_id' => $academic_session_id,
		);

		$get_overall_update = $this->pgam->get_by('atif_subject.overall_grading',$select,$where,$group); 

		if(!empty($get_overall_update)){



			for($j=0;$j<sizeof($grade_wieghtage);$j++){
				if(empty($grade_wieghtage[$j])){
					$grade_wieghtage[$j] = 0;
				}
				$data_update = array(
					'grading_id' => $grading[$j],
					'weightage' => $grade_wieghtage[$j],
					'modified'=>time(),

				);

				$id = $get_overall_update[$j]->id;	

				
				$where_update = array(
					'id' => $id
				);

				$updated_row = $this->pgam->save('atif_subject.overall_grading',$data_update,$where_update);
				echo $updated_row;

			}
		}

		//==============================END UPDATION =========================//
		//====================================================================//
		else {
	

		


		//================ Insert Data =========================//
		//======================================================//
		for($i=0;$i<sizeof($grade_wieghtage);$i++){
			if(empty($grade_wieghtage[$i])){
				$grade_wieghtage[$i] = 0;
			}
			
			$data = array(
				'academic_session_id' => $academic_session_id,
				'grade_id' => $grade_id,
				'grading_id' => $grading[$i],
				'weightage' => $grade_wieghtage[$i],
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified'=>time(),
				'modified_by' => $this->session->userdata('user_id')
			);
		
		

		$affected_row =  $this->pgam->insert_data('atif_subject.overall_grading',$data);
		echo $affected_row;	

		}

		//===============End Isert Data ========================//
		//======================================================//

	  }

	}

}