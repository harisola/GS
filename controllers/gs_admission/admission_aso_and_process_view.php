<?php

class Admission_aso_and_process_view extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$user_id =  (int)$this->session->userdata('user_id'); 
		$this->user_id = $user_id;

	}
	public function index(){

		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{
			$this->load->view('gs_files/header');
	        $this->load->view('gs_files/main-nav');
	        $this->load->view('gs_files/breadcrumb');

	        $this->load->model('admission/admission_batch_model','abm');
	        $data['grade'] =  $this->abm->get_by_all('atif._grade');
	        // var_dump($data);

					
			$this->load->view('gs_admission/aso_and/aso_and_process_view',$data);
			$this->load->view('gs_admission/aso_and/aso_and_view_footer');
		}

	}

	public function get_batch(){
		$this->load->model('admission/admission_batch_model','abm');


		// ============ Get Batch Code Like A01(with date)=========//
		//=========================================================//
		$grade_id = $this->input->post('grade_id');
		$where = array(
			'grade_id' => $grade_id
		);
		$select  = '';
		$form_batch =  $this->abm->get_by_all('atif_gs_admission._form_batch',$select,$where);

		if(!empty($form_batch)){
			echo json_encode($form_batch);
		}
		else{
			echo "No batch Created";
		}


	}

		//========= Form Count in Batch===============//
		//============================================//

	public function get_batch_form_submitted(){
		$this->load->model('admission/admission_batch_model','abm');
		$batch_id = $this->input->post('batch_id');
		$grade_id = $this->input->post('grade_id');
		$where = array(
			'form_batch_id' => $batch_id,
			'grade_id' => $grade_id,
			'batch_slot_id >=' => 1
		);
		$select = 'count(*) as batch_count';
		$batch = $this->abm->get_by_all('atif_gs_admission.admission_form',$select,$where);

		echo json_encode($batch);
	}

		//=============Form Coun in grade ===========//
		//===========================================//

	public function count_form_in_grade(){

		$this->load->model('admission/admission_batch_model','abm');
		$grade_id = $this->input->post('grade_id');
		$where = array(
			'grade_id' => $grade_id
		);
		$select = 'count(id) as grade_count';
		$grade = $this->abm->get_by_all('atif_gs_admission.admission_form',$select,$where);
		echo json_encode($grade);
	}

	//============= Get View And Edit Modal ============//
	//==================================================//

	public function get_view_and_edit_modal(){

		$form_id = $this->input->post('form_id');
		$grade_id = $this->input->post('grade_id');
		$batch = $this->input->post('batch_case');



		$this->load->model('admission/admission_batch_model','abm');


		// Assessment Result,Decision both And , Aso 
		$assessment_status = 3;
		$assessment_result = 'result';
		$assessment_decision = 'decision'; // For ASO only

		$assessment_result_teacher = $this->abm->get_category_teacher($grade_id,$assessment_status,$assessment_result);
		$assessment_decision_teacher = $this->abm->get_category_teacher($grade_id,$assessment_status,$assessment_decision);
		// var_dump($assessment_result_teacher);
		// exit;


		// Discussion Result,Decision Both And,ASO
		
		$discussion_status = 4;
		$discussion_result = 'result';
		$discussion_decision = 'decision';

		$discussion_result_teacher = $this->abm->get_category_teacher($grade_id,$discussion_status,$discussion_result);
		$discussion_decision_teacher = $this->abm->get_category_teacher($grade_id,$discussion_status,$discussion_decision);


		// Get Result  //

		$assessment_result =  $this->abm->get_result_discussion($form_id,$assessment_status);
		$discussion_result_detail =  $this->abm->get_result_discussion($form_id,$discussion_status);
		//var_dump($discussion_result_detail);
		

		//exit;
		


		
		$html = '';
		$html .= '<div class="modal-body">';
		$html .= '<div class="col-md-12" style="">';
		$html .= '<div class="MaroonBorderBox">';
		$html .= '<div class="inner" style="padding-bottom:0;padding-top:0;">';
		$html .= '<div class="col-md-3" style="background: #e9f9fb;border-right: 2px solid #54bbc7;">';
		$html .= '<div class="col-md-12">';
		$html .= '<h4 class="text-center">Assessment</h4>';

		// ================== Form Result  ====================//
		//=====================================================//

		$html .= '<form action="" method="POST" id="result_decission" >';
		$html .= '<input type="hidden" value="'.$form_id.'" name="form_id"/>';
		$html .= '<h6>Result</h6>';
		$html .= '<div class="col-md-6 paddingBottom20 no-padding">';
		$html .= '<select value="" name="assessment_result_grade">';
		
		if(!empty($assessment_result[0]->form_assessment_result)){
			$html .= '<option value="'.$assessment_result[0]->form_assessment_result.'">'.$assessment_result[0]->form_assessment_result.'</option>';
		}
		else{
		$html .= '<option disabled selected>Select Grade *</option>';	
		$html .= '<option value="A+">A+</option>';
		$html .= '<option value="A">A</option>';
		$html .= '<option value="A-">A-</option>';
		$html .= '<option value="B">B</option>';
		$html .= '<option value="C">C</option>';
		}
		$html .= '</select>';
		$html .= '</div>'; //col-md-6
		$html .= '<div class="col-md-6 paddingBottom20 no-padding">';
		$html .= '<select  id="" name="assessment_result_teacher">';
		

		if(!empty($assessment_result[0]->form_assessment_result_by_name) && $assessment_result[0]->form_assessment_result_by != 0){
			$html .= '<option value="'.$assessment_result[0]->form_assessment_result_by.'">'.$assessment_result[0]->form_assessment_result_by_name.'</option>';
		}
		else if(!empty($assessment_result_teacher)){
			$html .= '<option value="" disabled selected>By *</option>';
			foreach($assessment_result_teacher as $assessment_result){
		
			$html .= '<option value="'.$assessment_result->staff_id.'">'.$assessment_result->name.'</option>';

			}
		}

		$html .= '</select>';
		$html .= '</div>'; // <!-- col-md-6 -->



		//========================= IF Batch is ASO =========================//
		//===================================================================//
		if($batch == 2){

		$assessment_result =  $this->abm->get_result_discussion($form_id,$assessment_status);
		$html .= '<h6>Decision</h6>';
		$html .= '<div class="col-md-6 paddingBottom20 no-padding">';
		$html .= '<select required id="decision_status" name="resultDecision">';
		if(!empty($assessment_result[0]->form_assessment_decision)){
			$html .= '<option value="'.$assessment_result[0]->form_assessment_decision.'">'.$assessment_result[0]->form_assessment_decision.'</option>';
		$html .= '<option value="CFD">CFD</option>';
		$html .= '<option value="RGT">RGT</option>';
		$html .= '<option value="WIL">WIL</option>';
		$html .= '<option value="OHD">OHD</option>';

		}else{
		$html .= '<option value="" disabled selected>Decision *</option>';
		$html .= '<option value="CFD">CFD</option>';
		$html .= '<option value="RGT">RGT</option>';
		$html .= '<option value="WIL">WIL</option>';
		$html .= '<option value="OHD">OHD</option>';
		}
		$html .= '</select>';
		$html .= '</div>'; //<!-- col-md-6 -->
		//$html .= '<div class="col-md-6 paddingBottom20 no-padding">';
		//$html .= '<select required id="" name="resultDecisionTeacher">';

		// if(!empty($assessment_result[0]->form_assessment_decision_by) && $assessment_result[0]->form_assessment_decision_by != 0){
		// 	$html .= '<option value="'.$assessment_result[0]->form_assessment_decision_by.'">'.$assessment_result[0]->form_assessment_decision_by_name.'</option>';

		// }
		// else if(!empty($assessment_decision_teacher)){
		// 	$html .= '<option value="" disabled selected>By *</option>';
		// 	foreach($assessment_decision_teacher as $assessment_decision_teacher){
		// 		$html .= '<option value="'.$assessment_decision_teacher->staff_id.'">'.$assessment_decision_teacher->name.'</option>';
		// 	}
		
		// }
		//$html .= '<option value="2">Ms. Anum Anwar</option>';
		//$html .= '<option value="3">Ms. Yusra Kaiser</option>';

		//$html .= '</select>';
		//$html .= '</div>'; // <!-- col-md-6 -->


		//================== FORM ASSESSMENT DECISION IF CFD ====================================//
		//======================================================================================//

		$html .='<div class="col-md-12">';
		 if(!empty($assessment_result[0]->form_assessment_decision) && $assessment_result[0]->form_assessment_decision == 'CFD'){
		 	$html .= '<div class="col-md-6 paddingBottom20 no-padding" id="cfd">';
		 	$html .= '<input type="date" required name="assessment_result_date" id="assessment_result_date" value="'.$assessment_result[0]->form_discussion_date.'" />';
			$html .= '</div>'; //<!-- col-md-6 -->
			
		 }
		else{
			$html .= '<div class="col-md-6 paddingBottom20 no-padding" id="cfd" style="display:none">';
			$html .= '<input type="date" required name="assessment_result_date" id="assessment_result_date" value="" />';
			$html .= '</div>'; //<!-- col-md-6 -->
			
		}


		if(!empty($assessment_result[0]->form_assessment_decision) && $assessment_result[0]->form_assessment_decision == 'CFD'){
			$html .= '<div class="col-md-6 paddingBottom20 no-padding" id="cft">';
			$html .= '<input type="time" required name="assessment_result_time" id="assessment_result_time"  value="'.$assessment_result[0]->form_discussion_time.'"/>';
			$html .= '</div>'; //<!-- col-md-6 --><!-- If CFD Show-->
		}
		else{
			$html .= '<div class="col-md-6 paddingBottom20 no-padding" id="cft" style="display:none">';
			$html .= '<input type="time" required name="assessment_result_time" id="assessment_result_time" />';
			$html .= '</div>'; //<!-- col-md-6 --><!-- If CFD Show-->
		}
		$html .='</div>';

		//===============================END CFD =============================//


		//========================= Form Assessment Decision IF WLD =======//
		//================================================================//

		if(!empty($assessment_result[0]->form_assessment_decision) && $assessment_result[0]->form_assessment_decision == 'WIL'){
			$html .= '<div class="col-md-6 paddingBottom20 no-padding IfWIL ">';
		}
		else{
		$html .= '<div class="col-md-6 paddingBottom20 no-padding IfWIL displayNone">';
		}
		$html .= '<select required id="resultWaited" name="resultWaited">';
		if(!empty($assessment_result[0]->form_assessment_decision) && $assessment_result[0]->form_assessment_decision == 'WIL'){
			$html .= '<option value="">'.$assessment_result[0]->weightage.'</option>';
			$html .= '<option value="1.0">1.0</option>';
			$html .= '<option value="1.1">1.1</option>';
			$html .= '<option value="1.2">1.2</option>';
			$html .= '<option value="1.3">1.3</option>';
		}else{
		$html .= '<option value="" disabled selected>Grade *</option>';
		$html .= '<option value="1.0">1.0</option>';
		$html .= '<option value="1.1">1.1</option>';
		$html .= '<option value="1.2">1.2</option>';
		$html .= '<option value="1.3">1.3</option>';
		 //<!-- col-md-6 If WIL Show -->
		}
		$html .= '</select>';
		$html .= '</div>';

		}

		// =========================== End ASO =======================//

		$html .= '<div class="col-md-12" style="padding-bottom:20px;">';
		$html .= '<textarea placeholder="Comments" rows="4" cols="50" name="result_comment"></textarea>';
		$html .= '</div>';  //<!-- col-md-12 -->
		$html .= '<div class="col-md-12 paddingBottom20">';
		$html .= '<input type="submit" class="greenBTN" value="Submit" />';
		$html .= '</div>'; //<!-- col-md-12 -->
		$html .= '</div>'; //<!-- col-md-12 -->
		$html .= '</form>';

		// ==================== Form End ==========================//
		//=========================================================//


		//========================== Discussion Form ===============//
		//==========================================================//

		$html .= '<hr />';
 	    $html .= '<div class="col-md-12">';                                   
        $html .= '<h4 class="text-center">Discussion</h4>';
        $html .= '<h6>Result</h6>';
        $html .= '<form action="" method="POST" id="discussion_detail">';
        $html .= '<input type="hidden" value="'.$form_id.'" name="form_id" id="form_id"/>';
        $html .= '<div class="col-md-6 paddingBottom20 no-padding">';
        $html .='<select required id="" name="disscussion_result">';
        if(!empty($discussion_result_detail[0]->form_discussion_result)){
        	$html .= '<option value="'.$discussion_result_detail[0]->form_discussion_result.'">'.$discussion_result_detail[0]->form_discussion_result.'</option>';
        }else{
        $html .= '<option value="" disabled selected>Select Grade *</option>';
        $html .= '<option value="A+">A+</option>';
        $html .= '<option value="A">A</option>';                                          
        $html .= '<option value="A-">A-</option>';                              	            
        $html .='<option value="B">B</option>';                                         
        $html .='<option value="C">C</option>';
        }                                              
   		$html .= '</select>';
        $html .='</div>'; //<!-- col-md-6 -->
        
        


        $html .='<div class="col-md-6 paddingBottom20 no-padding">';
        $html .='<select required id="" name="disscussion_result_teacher">';
        
        if($discussion_result_detail[0]->form_discussion_result_by != 0){
        	$html .= '<option value="'.$discussion_result_detail[0]->form_discussion_result_by.'">'.$discussion_result_detail[0]->form_discussion_result_by_name.'</option>';
        }else if(!empty($discussion_result_teacher)){
        	$html .='<option value="" disabled selected>By *</option>';
        	foreach($discussion_result_teacher as $discussion_teacher){
   				$html .='<option value="'.$discussion_teacher->staff_id.'">'.$discussion_teacher->name.'</option>';
   			}
        }                                                    
        $html .='</select>';
        $html .='</div>'; //<!-- col-md-6 -->
        



        $html .='<h6>Decision</h6>';
        $html .='<div class="col-md-6 paddingBottom20 no-padding">';
        $html .='<select required id="DECD" name="discussion_decision_result">';
        if(!empty($discussion_result_detail[0]->form_discussion_decision)){
        	$html .='<option value="'.$discussion_result_detail[0]->form_discussion_decision.'">'.$discussion_result_detail[0]->form_discussion_decision.'</option>';
        $html .='<option value="OFR">OFR</option>';
        $html .='<option value="RGT">RGT</option>';
        $html .='<option value="WIL">WIL</option>';
        $html .='<option value="OHD">OHD</option>';
        }else{
        $html .='<option value="" disabled selected>Decision *</option>';
        $html .='<option value="OFR">OFR</option>';
        $html .='<option value="RGT">RGT</option>';
        $html .='<option value="WIL">WIL</option>';
        $html .='<option value="OHD">OHD</option>';
    	}
        $html .='</select>';
        $html .='</div>'; //<!-- col-md-6 -->


        
     //    $html .='<div class="col-md-6 paddingBottom20 no-padding">';
     //    $html .='<select required id="" name="discussion_decision_teacher">';

     //    if($discussion_result_detail[0]->form_discussion_decision_by != 0){
     //    	$html .= '<option value="'.$discussion_result_detail[0]->form_discussion_decision_by.'">'.$discussion_result_detail[0]->form_discussion_decision_by_name.'</option>';
     //    }
     //    else if(!empty($discussion_decision_teacher)){
     //    	$html .='<option value="" disabled selected>By *</option>';
     //    	foreach($discussion_decision_teacher as $decision_teacher){
     //    	$html .='<option value="'.$decision_teacher->staff_id.'">'.$decision_teacher->name.'</option>';
    	// 	}
    	// }
     //    //$html .='<option value="">Ms. Anum Anwar</option>';
     //    //$html .= '<option value="">Ms. Yusra Kaiser</option>';
     //    $html .= '</select>';
     //    $html .= '</div>'; //<!-- col-md-6 -->


        if(!empty($discussion_result_detail[0]->form_discussion_decision) && $discussion_result_detail[0]->form_discussion_decision == 'OFR'){
        	 $html .= '<div class="col-md-6 paddingBottom20 no-padding" id="ddIfOFR_date">';
	        $html .= '<input required type="date" name="offer_date" id="offer_date" value="'.$discussion_result_detail[0]->offer_date.'"/>';
    	    $html .= '</div>'; //<!-- col-md-6 -->
        }
        else{
        $html .= '<div class="col-md-6 paddingBottom20 no-padding" id="ddIfOFR_date" style="display:none">';
        $html .= '<input required type="date" name="offer_date" id="offer_date"/>';
        $html .= '</div>'; //<!-- col-md-6 -->
        }



        //$html .= '<div class="col-md-6 paddingBottom20 no-padding" id="ddIfOFR_time" style="display:none" >';
        //$html .= '<input type="time" name="offer_time" id="offer_time" />';
        //$html .= '</div>'; //<!-- col-md-6 --><!-- If OFR Show-->

        if(!empty($discussion_result_detail[0]->form_discussion_decision) && $discussion_result_detail[0]->form_discussion_decision == 'WIL'){
        	 $html .= '<div class="col-md-6 paddingBottom20 no-padding ddIfWILD" id="ddIfWILD">';
        }else{
        	$html .= '<div class="col-md-6 paddingBottom20 no-padding ddIfWILD" id="ddIfWILD" style="display:none">';
        }

        
        $html .= '<select  required id="weightage_wil" name="weightage_wil">';
        if(!empty($discussion_result_detail[0]->form_discussion_decision) && $discussion_result_detail[0]->form_discussion_decision == 'WIL'){
        	 $html .= '<option value="'.$discussion_result_detail[0]->weightage.'">'.$discussion_result_detail[0]->weightage.'</option>';
        	 $html .= '<option value="1.0">1.0</option>';
        	 $html .= '<option value="1.1">1.1</option>';
        	 $html .= '<option value="1.2">1.2</option>';
        	 $html .= '<option value="1.3">1.3</option>';
        }
        else{
        $html .= '<option value="" disabled selected>Grade *</option>';
        $html .= '<option value="1.0">1.0</option>';
        $html .= '<option value="1.1">1.1</option>';
        $html .= '<option value="1.2">1.2</option>';
        $html .= '<option value="1.3">1.3</option>';
    	}
        $html .= '</select>';
        $html .= '</div>'; //<!-- col-md-6 If WIL Show -->

        $html .= '<div class="col-md-12" style="padding-bottom:20px;">';
        $html .= '<textarea placeholder="Comments" rows="4" cols="50" name="discussion_comment"></textarea>';
        $html .= '</div>'; //<!-- col-md-12 -->
        $html .= '<div class="col-md-12" style="padding-bottom:20px;">';
        $html .= '<input type="submit" class="greenBTN" value="Submit" />';
        $html .= '</div>'; //<!-- col-md-12 -->

        $html .= '</div>'; //<!-- col-md-12 -->
        $html .= '</form>';
        $html .= '</div>'; //<!-- col-md-3 -->

		$comments_log = $this->abm->sp_form_complete_log($form_id);
        // var_dump($comments_log);

		$n = 1;
        $html .= '<div class="col-md-9">';
        $html .= '<div class="TimelineReview">';
        $html .= '<ul>';

        foreach($comments_log as $log){
        	if($log->type == 'Issuance' || $log->type == 'Stage' || $log->type == 'Status'){
        		$html .= '<li class="adminResponse">';
        		$html .= '<p>'.$log->message.'</p>';
        		$html .= '</li>';
        	}
        	else{

        		if($this->user_id == $log->user_id){
        		$html .= '<li class="out">';
        		$html .= '<div class="systemResponse col-md-10">';
        		$html .= '<span class="arrowHeadRight">&nbsp;</span>';
         		$html .= '<p><strong>'.$log->reason.'</strong><br /><small>'.$log->message.'</small></p>';
         		$html .= '<span class="commentDate">'.$log->dt.'</span>'; // <!-- commentDate -->
         		$html .= '</div>'; //<!-- systemResponse -->
         		$html .= '<div class="avatarLeft col-md-2">';
        		$html .= '<img src="'.base_url('assets/photos/hcm/150x150/staff/'.$log->photo_id.'.png') .'"/>';
        		$html .= '</div>'; //<!-- avatarLeft -->
         		$html .= '</li>'; //<!-- out -->

         		}else{


         		        		$html .= '<li class="in">';
        		$html .= '<div class="avatarLeft col-md-2">';
        		 $html .= '<img src="'.base_url('assets/photos/hcm/150x150/staff/'.$log->photo_id.'.png') .'"/>';
        		$html .= '</div>'; //<!-- avatarLeft -->
        		$html .= '<div class="systemResponse col-md-10">';
        		$html .= '<span class="arrowHeadLeft">&nbsp;</span>';
         		$html .= '<p><strong>'.$log->reason.'</strong><br /><small>'.$log->message.'</small></p>';
         		$html .= '<span class="commentDate">'.$log->dt.'</span>'; // <!-- commentDate -->

         		$html .= '</div>'; //<!-- systemResponse -->
         		//$html .= '<img src="'.base_url('assets/photos/hcm/150x150/staff/'.$log->photo_id.'.png') .'"/>';
         		$html .= '</li>'; //<!-- in -->

         		}
         	// 	$n++;
         		
         		

        	}
        }
        
        $html .= '</ul>';
        $html .= '</div><!-- Timeline -->';
        $html .= '</div><!-- col-md-9 -->';
        $html .= '</div><!-- inner -->';
        $html .= '</div><!-- .MaroonBorderBox -->';
        $html .= '</div><!-- col-md-12 -->';
        $html .= '</div><!-- modal-body -->';


        $html .= '<script >$(document).ready(function(){
		if($("#result_decission").length){

			$("#result_decission").validate({
				rules:{
					assessment_result_grade:{
						required:true,
					},
					assessment_result_teacher:{
						required:true
					}
				},
				    submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: "POST",
                        url:"'.base_url("index.php/gs_admission/admission_aso_and_process/result_decision_insert").'",
                        success: function (data) {
                        	var form_id =  $("#form_id").val();
                        	$.ajax({
                        		type:"POST",
                        		cache:false,
                        		data:{form_no:form_id},
                        		url:"'.base_url("index.php/gs_admission/admission_aso_and_process/view_and_updated_status").'",
                        		success:function(e){
                        			var jsonData = JSON.parse(e);
                        			var ast_name_code;
                        			var form_assessment_result;
                        			var form_assessment_decision;
                        			var form_discussion_date;
                        			var flag_ast_result;
                        			var flag_ast_decision;
                        			var flag_ast_allocation;
                        			var flag_comm_ast_result;
                        			
                        			for(var i = 0 ;i < jsonData.length; i++){
                        				
                        				ast_name_code = jsonData[i].ast_name_code;
                        				form_assessment_result = jsonData[i].form_assessment_result;
                        				form_assessment_decision = jsonData[i].form_assessment_decision;
                        				flag_ast_result = jsonData[i].flag_ast_result;
                        				flag_ast_decision = jsonData[i].flag_ast_decision;
                        				flag_ast_allocation = jsonData[i].flag_ast_allocation;
                        				flag_comm_ast_result = jsonData[i].flag_comm_ast_result;
                        				form_discussion_date = jsonData[i].form_discussion_date;
                        				

                        			}

                        			$("#ast_name_code_"+form_id).text(ast_name_code);
                        			$("#form_assessment_result_"+form_id).text(form_assessment_result);


                        			$("#ast_name_code_aso_"+form_id).text(ast_name_code);
                        			$("#form_assessment_result_aso_"+form_id).text(form_assessment_result);
                        			$("#form_assessment_decision_aso_"+form_id).text(form_assessment_decision);
                        			$("#form_discussion_date_aso_"+form_id).text(form_discussion_date);
                        			



                        			if(flag_ast_result == 1){
                        			$("#img_result_aso_"+form_id).prop("src","'.base_url("components/gs_theme/images/result_active.png").'");

                        			}

                        			if(flag_ast_decision == 1){
                        			$("#img_decision_aso_"+form_id).prop("src","'.base_url("components/gs_theme/images/discussion_active.png").'");	

                        			}

                        			if(flag_ast_allocation == 1){
                        				$("#img_allocation_aso_"+form_id).prop("src","'.base_url("components/gs_theme/images/AllocationIcon_active.png").'");
                        			}

                        			$("#myModal4").modal("hide");


                        		}
                        	});
                        }
                    });
                }

			});

		}


		
		if($("#discussion_detail").length){

			$("#discussion_detail").validate({
				rules:{
					disscussion_result:{
						required:true,
					},
					disscussion_teacher:{
						required:true
					}
				},

				submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: "POST",
                        url:"'.base_url("index.php/gs_admission/admission_aso_and_process/discussion_decision_insert").'",
                        success: function (data) {

                        	var form_id =  $("#form_id").val();

                        	$("#img_result_"+form_id).prop("src","'.base_url("components/gs_theme/images/result_active.png").'");

                        	$("#img_decision_"+form_id).prop("src","'.base_url("components/gs_theme/images/discussion_active.png").'");

                        	$("#img_allocation_"+form_id).prop("src","'.base_url("components/gs_theme/images/AllocationIcon_active.png").'");

                        	
                        	$.ajax({
                        		type:"POST",
                        		cache:false,
                        		data:{form_no:form_id},
                        		url:"'.base_url("index.php/gs_admission/admission_aso_and_process/view_and_updated_status").'",
                        		success:function(e){
                        			var jsonData = JSON.parse(e);
                        			var ast_name_code;
                        			var form_assessment_result;
                        			var ast_name_code;
                        			var dis_name_code;
                        			var form_discussion_result;
                        			var form_discussion_decision;
                        			var Offer ;
                        			for (var i = 0; i < jsonData.length; i++){

                        				ast_name_code = jsonData[i].ast_name_code;
                        				form_assessment_result = jsonData[i].form_assessment_result;
                        				//ast_name_code = jsonData[i].ast_name_code; 
                        				dis_name_code = jsonData[i].dis_name_code;
                        				form_discussion_result = jsonData[i].form_discussion_result;
                        				form_discussion_decision = jsonData[i].form_discussion_decision;
                        				
                        				
                        			}

                        			$("#ast_name_code_"+form_id).text(ast_name_code);
                        			$("#form_assessment_result_"+form_id).text(form_assessment_result);
                        			//$("#ast_name_code_"+form_id).text(ast_name_code);
                        			$("#dis_name_code_"+form_id).text(dis_name_code);
                        			$("#form_discussion_result_"+form_id).text(form_discussion_result);
                        			$("#form_discussion_decision_"+form_id).text(form_discussion_decision);

                        			if(form_discussion_decision == ""){

                        			}
                        			else{
                        				$("#offer_"+form_id).text("Approval Pending");
                        			}

                        			$("#myModal4").modal("hide");

                        		}
                        	});
                        	

                        }
                    });
                }


			});

		}



		});
		</script>';

        echo $html;
  
                                 
                                   
	}

	//============== Insert Result Decision ==================//
	//=======================================================//

	public function result_decision_insert(){


		// var_dump($this->input->post());
		// exit;
		$this->load->model('admission/admission_batch_model','abm');

		$form_status_id = 3;
		$form_id = $this->input->post('form_id');
		$assessment_result_grade = $this->input->post('assessment_result_grade');
		$assessment_result_teacher = $this->input->post('assessment_result_teacher');
		$assessment_result_decision = $this->input->post('resultDecision');
		$assessment_decision_teacher =  $this->input->post('resultDecisionTeacher');
		$result_comment = $this->input->post('result_comment');


		// Update The Assessment Result And Discussion

		$where = array(
			'id' => $form_id
		);


		// IN AND CASE
		$data = array(
			'form_assessment_result' => $assessment_result_grade,
			'form_assessment_result_by' => $assessment_result_teacher,
			//'form_assessment_decision' => $assessment_result_decision,
			'form_assessment_decision_by' => $assessment_result_teacher,
			'form_status_id' => $form_status_id,
			'form_status_stage_id' => 1
		);

		$affected_and_rows = $this->abm->update_data('atif_gs_admission.admission_form',$where,$data);
		echo $affected_and_rows;


		//===========================Comments=======================//
		//==========================================================//
		// if(!empty($affected_rows)){
	

			// if($assessment_decision_teacher){

			// 	$where_staff = array(
			// 		'id' => $assessment_decision_teacher
			// 	);
			// }
			//else{
		
				$where_staff = array(
					'id' => $assessment_result_teacher
				);
			//}


			$select = "name";
			$staff_name = $this->abm->get_by_all('atif.staff_registered',$select,$where_staff);
			$teacher_name = $staff_name[0]->name;
			
			if($assessment_result_decision){
				$reason = $assessment_result_decision."(".$assessment_result_grade.") By ". $teacher_name;
			}
			else{
				$reason = "Result (".$assessment_result_grade.") By ".$teacher_name;
			}



			//Insert Into Comment's Log Table

			$data_comments = array(
				'admission_form_id' => $form_id,
				'reason' => $reason,
				'comments' => $result_comment,
				'created' => time(),
				'register_by' => (int)$this->session->userdata['user_id'],
				'modified' => time(),
				'modified_by' => (int)$this->session->userdata['user_id']
			);



			$comments_insert = $this->abm->insert_data('atif_gs_admission.log_form_comments',$data_comments);
			echo $comments_insert;


		// }



		//========================== Call For Discussion Applicant ====================//
		//=============================================================================//
		if($assessment_result_decision == 'CFD'){

			$assessment_result_date = $this->input->post('assessment_result_date');
			$assessment_result_time = $this->input->post('assessment_result_time');
			$assessment_result_time = date('h:i:s',strtotime($assessment_result_time));
			$form_status_stage_id = 13;

			$date = date_create($assessment_result_date);
			$date_create = date_format($date,'Y-m-d');

			$where_result_offer = array(
				'id' => $form_id
			);

			$data_result_offer = array(
				'form_assessment_decision' => $assessment_result_decision,
			//	'form_assessment_decision_by' => $assessment_decision_teacher,
				'form_discussion_date' => $assessment_result_date,
				'form_discussion_time' => $assessment_result_time,
				'form_status_stage_id' => $form_status_stage_id,
				'modified' => time(),
				'modified_by' => $this->user_id
			);

			$offer_result_update = $this->abm->update_data('atif_gs_admission.admission_form',$where_result_offer,$data_result_offer);
			echo $offer_result_update;
		}

		//==================================== Wait Listed Applicant =================//
		//============================================================================//

		if($assessment_result_decision == 'WIL'){
			$result_wait = $this->input->post('resultWaited');

			// Updation in status Stage
			$form_status_stage_id = 9;

			$where_waitlist = array(
				'id' => $form_id
			);

			$data_update = array(
				'form_assessment_decision' => $assessment_result_decision,
			//	'form_assessment_decision_by' => $assessment_decision_teacher,
				'form_status_stage_id' => $form_status_stage_id,
				'modified' => time(),
				'modified_by' => $this->user_id
			);

			$waitlist_result_update = $this->abm->update_data('atif_gs_admission.admission_form',$where_waitlist,$data_update);
			echo $waitlist_result_update;

			//===========Check for if empty ====================//

			$where_waitlist_not_empty = array(
				'admission_form_id' => $form_id,
				'form_status_id' => $form_status_id 
			);

			$data_waitlist_not_empty = array(
				'weightage' => $result_wait,
				'modified' => time(),
				'modified_by' => $this->user_id
			);

			$select_waitlist_not_empty = "weightage";


			$waitlist_not_empty = $this->abm->get_by_all('atif_gs_admission.admission_form_waitlist',$select_waitlist_not_empty,$where_waitlist_not_empty);

			if(!empty($waitlist_not_empty)){

				$update_waitlist_not_empty = $this->abm->update_data('atif_gs_admission.admission_form_waitlist',$where_waitlist_not_empty,$data_waitlist_not_empty);
			}else{


			// Insert Weightage into weightlist
			$data = array(
				'admission_form_id	' => $form_id,
				'form_status_id' => $form_status_id,
				'weightage' => $result_wait,
				'created' => time(),
				'register_by'=> $this->user_id,
				'modified' => time(),
				'modified_by' => $this->user_id
			);

			$affected_rows = $this->abm->insert_data('atif_gs_admission.admission_form_waitlist',$data);
			echo $affected_rows;
		}

		}

		//================================== ON HOLD APPLICANT==================================//
		//======================================================================================//

		if($assessment_result_decision == 'OHD'){
			$form_status_stage_id = 8;

			$where_onhold = array(
				'id' => $form_id
			);

			$data_update = array(
				'form_assessment_decision' => $assessment_result_decision,
			//	'form_assessment_decision_by' => $assessment_decision_teacher,
				'form_status_stage_id' => $form_status_stage_id,
				'modified' => time(),
				'modified_by' => $this->user_id
			);

			$onhold_result_update = $this->abm->update_data('atif_gs_admission.admission_form',$where_onhold,$data_update);
			echo $onhold_result_update;
		}

		//====================================== Regeret Applicant =========================//
		//==================================================================================//



		if($assessment_result_decision == 'RGT'){
			$form_status_stage_id = 6;

			$where_regert = array(
				'id' => $form_id
			);

			$data_update = array(
				'form_assessment_decision' => $assessment_result_decision,
			//	'form_assessment_decision_by' => $assessment_decision_teacher,
				'form_status_stage_id' => $form_status_stage_id,
				'modified' => time(),
				'modified_by' => $this->user_id
			);

			$regert_result_update = $this->abm->update_data('atif_gs_admission.admission_form',$where_regert,$data_update);
			echo $regert_result_update;
		}


	



	}


	//==================Discussion Decision =======================//
	//============================================================//

	public function discussion_decision_insert(){
		var_dump($this->input->post());
		$form_id = $this->input->post('form_id');
		$form_status_id = 4;
		$disscussion_result = $this->input->post('disscussion_result');
		$disscussion_result_teacher = $this->input->post('disscussion_result_teacher');
		$discussion_decision_result = $this->input->post('discussion_decision_result');
		//$discussion_decision_teacher = $this->input->post('discussion_decision_teacher');
		$discussion_comment = $this->input->post('discussion_comment');

		$this->load->model('admission/admission_batch_model','abm');

		//Discussion
		$where_udpate = array(
			'id' => $form_id
		);
		$discussion_data = array(

			'form_discussion_result' => $disscussion_result,
			'form_discussion_result_by' => $disscussion_result_teacher,

			//'form_discussion_decision' => $discussion_decision_result,
			'form_discussion_decision_by' => $disscussion_result_teacher,  // discussion_result_teacher 
			'form_status_id' => $form_status_id,
			'form_status_stage_id' => 1,
			'modified' => time(),
			'modified_by' => $this->user_id

		);

		$update_rows = $this->abm->update_data('atif_gs_admission.admission_form',$where_udpate,$discussion_data);
		echo $update_rows;


		// Discussion And Decision Comments
		if(!empty($update_rows)){

			$where_staff = array(
				'id' => $discussion_decision_teacher
			);
			$select = "name";
			$staff_name = $this->abm-> get_by_all('atif.staff_registered',$select,$where_staff);
			$teacher_name = $staff_name[0]->name;
			$reason = $discussion_decision_result." by ". $teacher_name;

			//Insert Into Comment's Log Table

			$data_comments = array(
				'admission_form_id' => $form_id,
				'reason' => $reason,
				'comments' => $discussion_comment,
				'created' => time(),
				'register_by' => $this->user_id,
				'modified' => time(),
				'modified_by' => $this->user_id
			);

			$comments_insert = $this->abm->insert_data('atif_gs_admission.log_form_comments',$data_comments);
			echo $comments_insert;


		}


		// Discussion Decision  Offer

		if($discussion_decision_result == 'OFR'){
			$offer_date = $this->input->post('offer_date');
			$date = date_create($offer_date);
			$date_create = date_format($date,'Y-m-d');
			
			$where_offer = array(
				'id' => $form_id
			);

			$offer_data = array(
				'form_discussion_decision' => $discussion_decision_result,
				//'form_discussion_decision_by' => $discussion_decision_teacher, // by demand comments
				'offer_date' => $date_create,
				'form_status_id' => 5,
				'form_status_stage_id' => 12,
				'modified' => time(),
				'modified_by' => $this->user_id
			);

			$offer_update = $this->abm->update_data('atif_gs_admission.admission_form',$where_offer,$offer_data);
			echo $offer_update;

		}

		// Discussion Decision Waitlist

		if($discussion_decision_result == 'WIL'){

			$weightage_wil = $this->input->post('weightage_wil');

			$where_waitlist = array(
				'id' => $form_id
			);

			$update_waitlist = array(
				'form_discussion_decision' => $discussion_decision_result,
				//'form_discussion_decision_by' => $discussion_decision_teacher, // by demand comments
				'form_status_id' => 4,
				'form_status_stage_id' => 9,
				'modified' => time(),
				'modified_by' => $this->user_id
			);

			$affected_waitlist = $this->abm->update_data('atif_gs_admission.admission_form',$where_waitlist,$update_waitlist);


			$where_waitlist_not_empty = array(
				'admission_form_id' => $form_id,
				'form_status_id' => 4
			);

			$data_waitlist_not_empty = array(
				'weightage' => $weightage_wil,
				'modified' => time(),
				'modified_by' => $this->user_id
			);

			$select_waitlist_not_empty = "weightage";


			$waitlist_not_empty = $this->abm->get_by_all('atif_gs_admission.admission_form_waitlist',$select_waitlist_not_empty,$where_waitlist_not_empty);

			if(!empty($waitlist_not_empty)){

				$update_waitlist_not_empty = $this->abm->update_data('atif_gs_admission.admission_form_waitlist',$where_waitlist_not_empty,$data_waitlist_not_empty);
			}else{

			$data = array(
				'admission_form_id	' => $form_id,
				'form_status_id' => $form_status_id,
				'weightage' => $weightage_wil,
				'created' => time(),
				'register_by'=> $this->user_id,
				'modified' => time(),
				'modified_by' => $this->user_id
			);
			$affected_rows = $this->abm->insert_data('atif_gs_admission.admission_form_waitlist',$data);
			echo $affected_rows;
		}
		}

			// IF Discussion Decesion is RGT

			if($discussion_decision_result == 'RGT'){
				
				$where_regert = array(
					'id' => $form_id
				);

				$regert_data = array(
					'form_discussion_decision' => $discussion_decision_result,
					//'form_discussion_decision_by' => $discussion_decision_teacher, //by demand comments
					'form_status_id' => 4,
					'form_status_stage_id' => 6,
					'modified' => time(),
					'modified_by' => $this->user_id
				);

				$regert_update = $this->abm->update_data('atif_gs_admission.admission_form',$where_regert,$regert_data);
				echo $regert_update;

			}

			// IF Discussion Decesion is ON HOLD

			if($discussion_decision_result == 'OHD'){
			
			$where_onhold = array(
				'id' => $form_id
			);

			$onhold_data = array(
				'form_discussion_decision' => $discussion_decision_result,
				//'form_discussion_decision_by' => $discussion_decision_teacher, //by demand comments
				'form_status_id' => 4,
				'form_status_stage_id' => 8,
				'modified' => time(),
				'modified_by' => $this->user_id
			);

			$onhold_update = $this->abm->update_data('atif_gs_admission.admission_form',$where_onhold,$onhold_data);
			echo $onhold_update;

		}


	}

	//======================= GET DETAIL OF BATCH WISE ============================//
	//=============================================================================//

	public function get_detail_aso_and(){
		$batch_id = $this->input->post('batch_id');
		$this->load->model('admission/admission_batch_model','abm');
		$batch_aso_and =  $this->abm->get_aso_and($batch_id);
		// var_dump($batch_aso_and);
		// exit;
		if(!empty($batch_aso_and)){
		$batch = $batch_aso_and[0]->and_id;
		}else{
			$batch = '';
		}
		$html = '';
		$html .= '<table id="AdmissionFormListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">'; 
        $html .='<thead>'; 
        $html .='<tr>';
        $html .='<th class="no-sort" width="2%"></th>'; 
        $html .='<th width="" class="text-center">Form #</th>'; 
        $html .='<th width="" class="no-sort">Applicant Name<br /><small>Father Name</small></th>';
        $html .='<th width="" class="text-center no-sort">AST Appointment<br /><div class="col-md-6 no-padding"><small>AST Done on</small></div><div class="col-md-6 no-padding text-right"><small>AST by</small></div></th>';
        $html .='<th width="" class="text-left no-sort">AST Result<br /><div class="col-md-12 no-padding text-right">AST Decision</div></th>';
        $html .='<th width="" class="text-center no-sort">DIS Appointment<br /><div class="col-md-6 no-padding"><small>DIS Done on</small></div><div class="col-md-6 no-padding text-right"><small>DIS by</small></div></th>';
        $html .='<th width="" class="text-left no-sort">DIS Result<br /><div class="col-md-12 no-padding text-right">DIS Decision</div></th>';
        $html .='<!-- <th width="" class="text-center">Decision</th> -->';
        $html .='<th width="" class="text-left no-sort">Offer Date<br /><small>Time</small></th>';
        $html .='<th width="" class="text-center no-sort">Action</th>';
        $html .='</tr>';
        $html .='</thead>';
		$html .= '<tbody>';   
		
		if($batch == 1){

			// ===============================START AND ======================================//
			//================================================================================//
		foreach($batch_aso_and as $aso_and_process){
		if($aso_and_process->form_status_stage_id == 7){
			$html .= '<tr class="grayAlert">';
			
		}else{	
			$html .= '<tr>';

		}	
		$html .='<td></td>';
		$html .= '<input type="hidden" id="batch_case" value="'.$aso_and_process->and_id.'">';
		$html .= '<td class="text-center" id="form-no">'.$aso_and_process->form_id.'</td>';
		$html .= '<td>'.$aso_and_process->applicant_name.'<br /><small>'.$aso_and_process->father_name.'</small></td>';
		$html .= '<td class="text-center">';
		$html .= '<strong>'.$aso_and_process->form_assessment_date.'</strong><br />';

		// IF Assessment Extension is empty
		if($aso_and_process->ast_done_on == ''){
		$html .= ' <div class="col-md-6 no-padding text-left"><small id="ast_done_on_'.$aso_and_process->form_id.'">-</small></div>';
		}
		else{
		$html .= ' <div class="col-md-6 no-padding text-left"><small>'.$aso_and_process->ast_done_on.'</small></div>';
		}

		// IF Assessment Name Code is Empty

		if($aso_and_process->ast_name_code == ''){
		$html .= '<div class="col-md-6 no-padding text-right"><small id="ast_name_code_'.$aso_and_process->form_id.'">-</small></div>';
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-right"><small>'.$aso_and_process->ast_name_code.'</small></div>';
		}
		$html .= '</td>';
		$html .= '<td class="text-left">';

		// IF Assessment Result is Empty
		if($aso_and_process->form_assessment_result == ''){
		$html .= '<div class="col-md-12 text-left" id="form_assessment_result_'.$aso_and_process->form_id.'">-</div>';	
		}
		else{
		$html .= '<div class="col-md-12 text-left">'.$aso_and_process->form_assessment_result.'</div>';
		}
		
		// If Assessment Decision is Empty
		if($aso_and_process->form_assessment_decision == 0){
		$html .= '<div class="col-md-12 text-right" id="form_assessment_decision_'.$aso_and_process->form_id.'">-<div>';

		}
		else{
		$html .= '<div class="col-md-12 text-right">'.$aso_and_process->form_assessment_decision.'</div>';
		}

		$html .= '</td>';
		$html .= '<td class="text-center">';
		$html .= '<strong>'.$aso_and_process->form_assessment_date.'</strong><br />';

		// If Discussion Done  is Empty
		if($aso_and_process->dis_done_on == ''){
			$html .= '<div class="col-md-6 no-padding text-left"><small id="dis_done_on_'.$aso_and_process->form_id.'">-</small></div>';	
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-left"><small>'.$aso_and_process->dis_done_on.'</small></div>';
		}

		// If Discussion Name Code is Empty
		if($aso_and_process->dis_name_code == ''){
		$html .= '<div class="col-md-6 no-padding text-right"><small id="dis_name_code_'.$aso_and_process->form_id.'">-</small></div>';
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-right"><small>'.$aso_and_process->dis_name_code.'</small></div>';
		}

		$html .= '<div class="text-center">';
		$html .= '<hr class="lowMargin" />';

		// Reminder image
		if($aso_and_process->flag_ast_reminder == 0){
			$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}else{
		$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}

		// Presence
		if($aso_and_process->flag_ast_presence == 0){
		$html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true" id="img_presence_'.$aso_and_process->form_id.'"> &nbsp;';
		}
		else{
			$html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}

		// Follow Up Icon

		if($aso_and_process->flag_ast_followup == 0){
		$html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';
		}
		else{
		$html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';

		}
		
		$html .= ' </div>';
		$html .= '</td>';
		$html .= '<td class="text-left">';

		// IF Form Discussion Result is Empty
		if($aso_and_process->form_discussion_result == ''){
		$html .= '<div class="col-md-12 text-left" id="form_discussion_result_'.$aso_and_process->form_id.'">-</div>';

		}
		else{
		$html .= '<div class="col-md-12 text-left">'.$aso_and_process->form_discussion_result.'</div>';
		}

		// Form Dicision Result is Empty
		if($aso_and_process->form_discussion_decision == ''){
		$html .= '<div class="col-md-12 text-right" id="form_discussion_decision_'.$aso_and_process->form_id.'">-</div>';
		}
		else{
		$html .= '<div class="col-md-12 text-right" id="form_discussion_decision_'.$aso_and_process->form_id.'">'.$aso_and_process->form_discussion_decision.'</div>';
		}
		$html .= '<div class="text-center no-padding">';
		$html .= '<hr class="lowMargin" />';
		if($aso_and_process->flag_dis_result == 0){

		$html .= '<img src="'.base_url("components/gs_theme/images/result.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true" id="img_result_'.$aso_and_process->form_id.'"> &nbsp; ';
		}
		else{

			$html .= '<img src="'.base_url("components/gs_theme/images/result_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; ';
		}

		if($aso_and_process->flag_dis_decision == 0){
		$html .= '<img src="'.base_url("components/gs_theme/images/discussion.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true" id="img_decision_'.$aso_and_process->form_id.'"> &nbsp;';
		}
		else{
			$html .= '<img src="'.base_url("components/gs_theme/images/discussion_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;';
		}

		if($aso_and_process->flag_dis_allocation == 0){

		$html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true" id="img_allocation_'.$aso_and_process->form_id.'"> &nbsp;';
		}
		else{

		$html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;';
		}

		if($aso_and_process->flag_comm_dis_result == 0){
		$html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';
		}
		else{
		$html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';	
			
		}
		$html .= '</div>';
		$html .= '</td>';
			$html .= '<td class="text-left"><span id="offer_'.$aso_and_process->form_id.'">'.$aso_and_process->final_decision.'</span></td>';
		$html .= '<td class="text-center"><small><a href="#" data-toggle="modal" data-target="#myModal4" id="view_and_edit" data-form="'.$aso_and_process->form_id.'">View & Edit</a><br /><br /><a href="javascript:void(0)" id="mark_present" data-presesnt="'.$aso_and_process->form_id.'">Mark as Present</a></small></td>';
		$html .= '</tr>';
		}
		} //End BAtch

		// ==================================== END AND =================================//
		//=============================================================================//

		// ======================================== START ASO ============================//
		//================================================================================//

		if($batch == 2){

		foreach($batch_aso_and as $aso_and_process){

		if($aso_and_process->form_status_stage_id == 7){
			$html .= '<tr class="grayAlert">';
			
		}else{	
			$html .= '<tr>';

		}
		$html .='<td></td>';
		//$html .='<td><input type="checkbox" id="'.$aso_and_process->form_id.'" class="normal checkedStatus" unchecked /></td>';
		$html .= '<input type="hidden" id="batch_case" value="'.$aso_and_process->and_id.'">';
		$html .= '<td class="text-center" id="form-no">'.$aso_and_process->form_id.'</td>';
		$html .= '<td>'.$aso_and_process->applicant_name.'<br /><small>'.$aso_and_process->father_name.'</small></td>';
		$html .= '<td class="text-center">';
		$html .= '<strong>'.$aso_and_process->form_assessment_date.'</strong><br />';

		// IF Assessment Extension is empty
		if($aso_and_process->ast_done_on == ''){
		$html .= ' <div class="col-md-6 no-padding text-left"><small id="ast_aso_done_on_'.$aso_and_process->form_id.'">-</small></div>';
		}
		else{
		$html .= ' <div class="col-md-6 no-padding text-left"><small>'.$aso_and_process->ast_done_on.'</small></div>';
		}

		// IF Assessment Name Code is Empty

		if($aso_and_process->ast_name_code == ''){
		$html .= '<div class="col-md-6 no-padding text-right"><small id="ast_name_code_aso_'.$aso_and_process->form_id.'">-</small></div>';
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-right"><small id="ast_name_code_aso_'.$aso_and_process->form_id.'">'.$aso_and_process->ast_name_code.'</small></div>';
		}

		$html .='<div class="text-center">';
        $html .='<hr class="lowMargin" />';

        // New Cassess

        if($aso_and_process->flag_ast_reminder == 0){
       	$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
       }else{

       	$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';

       }

       if($aso_and_process->flag_ast_presence == 0){

        $html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true" id="img_presence_assessment'.$aso_and_process->form_id.'"> &nbsp;';
    	}
    	else{
    	 $html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true" id="img_presence_'.$aso_and_process->form_id.'"> &nbsp;';	
    		
    	}

    	if($aso_and_process->flag_ast_followup == 0){

        $html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';
    	}
    	else{

    	$html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';
    	}

        $html  .='</div>';
		$html .= '</td>';
		$html .= '<td class="text-left">';

		// IF Assessment Result is Empty
		if($aso_and_process->form_assessment_result == ''){
		$html .= '<div class="col-md-12 text-left" id="form_assessment_result_aso_'.$aso_and_process->form_id.'">-</div>';	
		}
		else{
		$html .= '<div class="col-md-12 text-left">'.$aso_and_process->form_assessment_result.'</div>';
		}
		
		// If Assessment Decision is Empty
		if($aso_and_process->form_assessment_decision == ''){
		$html .= '<div class="col-md-12 text-right" id="form_assessment_decision_aso_'.$aso_and_process->form_id.'">-</div>';
		}
		else{
		$html .= '<div class="col-md-12 text-right" id="form_assessment_decision_aso_'.$aso_and_process->form_id.'">'.$aso_and_process->form_assessment_decision.'</div>';
		}

		$html .='<div class="text-center no-padding">';
        $html .='<hr class="lowMargin" />';

        // New Cassess
        if($aso_and_process->flag_ast_result == 0){
        $html .= '<img src="'.base_url("components/gs_theme/images/result.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true" id="img_result_aso_'.$aso_and_process->form_id.'"> &nbsp; ';
    	}
    	else{
    	$html .= '<img src="'.base_url("components/gs_theme/images/result_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; ';

    	}

    	if($aso_and_process->flag_ast_decision == 0){

        $html .= '<img src="'.base_url("components/gs_theme/images/discussion.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true" id="img_decision_aso_'.$aso_and_process->form_id.'"> &nbsp;';
    	}
    	else{

    	$html .= '<img src="'.base_url("components/gs_theme/images/discussion_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;';
    	}

    	if($aso_and_process->flag_ast_allocation == 0){

        $html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true" id="img_allocation_aso_'.$aso_and_process->form_id.'"> &nbsp;';
    	}
    	else{
    	 $html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;';
    	}


    	if($aso_and_process->flag_comm_ast_result == 0){
        $html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';
    	}
    	else{

    	$html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';

    	}

        $html .='</div>';

		$html .= '</td>';
		$html .= '<td class="text-center">';
		if($aso_and_process->form_discussion_date == ''){
		$html .= '<strong id="form_discussion_date_aso_'.$aso_and_process->form_id.'">-</strong><br/>';
		}
		else{
		$html .= '<strong>'.$aso_and_process->form_discussion_date.'</strong><br />';
		}

		// If Discussion Done  is Empty
		if($aso_and_process->dis_done_on == ''){
			$html .= '<div class="col-md-6 no-padding text-left"><small id="dis_aso_done_on_'.$aso_and_process->form_id.'">-</small></div>';	
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-left"><small>'.$aso_and_process->dis_done_on.'</small></div>';
		}

		// If Discussion Name Code is Empty
		if($aso_and_process->dis_name_code == ''){
		$html .= '<div class="col-md-6 no-padding text-right"><small id="dis_name_code_'.$aso_and_process->form_id.'">-</small></div>';
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-right"><small>'.$aso_and_process->dis_name_code.'</small></div>';
		}

		$html .= '<div class="text-center">';
		$html .= '<hr class="lowMargin" />';

		// Reminder image
		if($aso_and_process->flag_dis_reminder == 0){
			$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}else{
		$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}

		// Presence
		if($aso_and_process->flag_dis_presence == 0){
		$html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true" id="img_presence_discussion'.$aso_and_process->form_id.'"> &nbsp;';
		}
		else{
			$html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}

		// Follow Up Icon

		if($aso_and_process->flag_dis_followup == 0){
		$html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';
		}
		else{
		$html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';

		}
		
		$html .= ' </div>';
		$html .= '</td>';
		$html .= '<td class="text-left">';

		// IF Form Discussion Result is Empty
		if($aso_and_process->form_discussion_result == ''){
		$html .= '<div class="col-md-12 text-left" id="form_discussion_result_'.$aso_and_process->form_id.'">-</div>';

		}
		else{
		$html .= '<div class="col-md-12 text-left">'.$aso_and_process->form_discussion_result.'</div>';
		}

		// Form Dicision Result is Empty
		if($aso_and_process->form_discussion_decision == ''){
		$html .= '<div class="col-md-12 text-right" id="form_discussion_decision_'.$aso_and_process->form_id.'">-</div>';
		}
		else{
		$html .= '<div class="col-md-12 text-right" id="form_discussion_decision_'.$aso_and_process->form_id.'">'.$aso_and_process->form_discussion_decision.'</div>';
		}
		$html .= '<div class="text-center no-padding">';
		$html .= '<hr class="lowMargin" />';
		if($aso_and_process->flag_dis_result == 0){

		$html .= '<img src="'.base_url("components/gs_theme/images/result.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true" id="img_result_'.$aso_and_process->form_id.'"> &nbsp; ';
		}
		else{

			$html .= '<img src="'.base_url("components/gs_theme/images/result_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; ';
		}

		if($aso_and_process->flag_dis_decision == 0){
		$html .= '<img src="'.base_url("components/gs_theme/images/discussion.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true" id="img_decision_'.$aso_and_process->form_id.'"> &nbsp;';
		}
		else{
			$html .= '<img src="'.base_url("components/gs_theme/images/discussion_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;';
		}

		if($aso_and_process->flag_dis_allocation == 0){

		$html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true" id="img_allocation_'.$aso_and_process->form_id.'"> &nbsp;';
		}
		else{

		$html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;';
		}

		if($aso_and_process->flag_comm_dis_result == 0){
		$html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';
		}
		else{
		$html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';	
			
		}
		$html .= '</div>';
		$html .= '</td>';

			$html .= '<td class="text-left"><span id="offer_'.$aso_and_process->form_id.'">'.$aso_and_process->final_decision.'</td>';

		
		$html .= '<td class="text-center"><small><a href="#" data-toggle="modal" data-target="#myModal4" id="view_and_edit" data-form="'.$aso_and_process->form_id.'">View & Edit</a><br /><br /><a href="javascript:void(0)" id="mark_present_aso" data-presesnt="'.$aso_and_process->form_id.'">Mark as Present</a></small></td>';
		$html .= '</tr>';


		}

		//======================ASO END =========================================//
		//=======================================================================//

		}

		$html .= '</table>';

		/*
		$html .= '<div class="col-md-6 absoluteDiv">';
        $html .='<div class="col-md-6 no-padding">';
        $html .='<select id="status" required class="paddingBottom10 paddingLeft10 paddingRight10 paddingTop10">';
        $html .='<option value="" disabled selected >Select Action *</option>';
        $html .='<option value="5">Offer Approve</option>';
        $html .='<option value="6">Move to Regret</option>';
        $html .='<option value="9">Move to Wait List</option>';
        $html .='<option value="8">Move to Hold</option>';
        $html .='</select>'; 	
        $html .='</div><!-- col-md-6 -->';
        $html .='<div class="col-md-3">';
        $html .='<input type="submit" class="greenBTN btn" value="Apply" id="status_update" />';
        $html .='</div><!-- col-md-6 -->';
        $html .='</div>';
        */

        $html .= '<script>';
        $html .= '$(document).ready(function() {
 				  $("#AdmissionFormListing").dataTable();
				  });';
        $html .='</script>';

		echo $html;                                  

	}


	// ================= AND , ASO PRESENT ============================//
	//=================================================================//

	public function get_and_present(){

		$form_no = $this->input->post('form_no');
		$where = array(
			'id' => $form_no
		);
		$select = '';
		$this->load->model('admission/admission_batch_model','abm');
		$admission_form = $this->abm->get_by_all('atif_gs_admission.admission_form',$select,$where);
		$old_status = $admission_form[0]->form_status_id;
		$form_status_old_stage_id = $admission_form[0]->form_status_stage_id;

		// Update New Status of Assessment
		$update_assessment_status = array(
			'form_status_id' => 3,
			'form_status_stage_id' => 4,

		);

		$affected_assessment_status = $this->abm->update_data('atif_gs_admission.admission_form',$where,$update_assessment_status);

		//// Update New Status of Discussion

		$update_discussion_result = array(
			'form_status_id' => 4,
			'form_status_stage_id' => 4,
		);

		$affected_discussion_status = $this->abm->update_data('atif_gs_admission.admission_form',$where,$update_discussion_result);

		if($affected_discussion_status != 0){
			// Updated Old Status
			$update_old_status = array(
				'form_status_id' => $old_status,
				'form_status_stage_id' => $form_status_old_stage_id

			);

			$old_status_update = $this->abm->update_data('atif_gs_admission.admission_form',$where,$update_old_status);
			echo "Status Update Successfully";
			

		}
		else{
			echo "No Stauts Updated";
		}


	}


	// Presenece ASO 
	public function present_aso(){

		$form_no = $this->input->post('form_no');
		$where = array(
			'id' => $form_no
		);
		$select = '';
		$this->load->model('admission/admission_batch_model','abm');
		$admission_form = $this->abm->get_by_all('atif_gs_admission.admission_form',$select,$where);
		$old_status = $admission_form[0]->form_status_id;
		$old_stage_id = $admission_form[0]->form_status_stage_id;
		if($old_status == 2){

		$update_assessment_status = array(
			'form_status_id' => 3,
			'form_status_stage_id' => 4,

		);

		$this->abm->update_data('atif_gs_admission.admission_form',$where,$update_assessment_status);
		echo "3";

		}
		else if($old_status == 3 && $old_stage_id == 13 ){

			$update_assessment_status = array(
			'form_status_id' => 4,
			'form_status_stage_id' => 4,

		);

		$this->abm->update_data('atif_gs_admission.admission_form',$where,$update_assessment_status);
		echo "4";

		}
		else{

			$update_discussion_status = array(
			'form_status_stage_id' => 4,

		);

		$this->abm->update_data('atif_gs_admission.admission_form',$where,$update_discussion_status);
		echo "4";
		

		}

	}

	public function get_and_present_detail(){

		$form_no = $this->input->post('form_no');
		$this->load->model('admission/admission_batch_model','abm');
		$and_detail = $this->abm->get_and_detail($form_no);
		echo json_encode($and_detail);
	}




	public function view_and_updated_status(){

		$form_no = $this->input->post('form_no');
		$this->load->model('admission/admission_batch_model','abm');
		$and_detail = $this->abm->get_and_detail($form_no);
		echo json_encode($and_detail);


	}

	// public function get_aso_present(){
		
	// 	$form_no = $this->input->post('form_no');

	// }

	public function update_action(){
		$form_id = $this->input->post('form_id');
		$status = $this->input->post('status');
		$this->load->model('admission/admission_batch_model','abm');

		$and_detail = array();
		for($i = 0 ;$i<sizeof($form_id); $i++){
			$where = array(
				'id' => $form_id[$i],
			);

			if($status == 5){
				$data = array(
					'form_status_id' => $status,
					'form_status_stage_id' => 1
				);
			}
			else{
				$data = array(
					'form_status_stage_id' => $status
				);
			}

			$this->abm->update_data('atif_gs_admission.admission_form',$where,$data);
			
				$select = '';
				array_push($and_detail, $this->abm->get_by_all('atif_gs_admission.admission_form',$select,$where));
		}

		echo json_encode($and_detail);
	}


	// ========================================= ALL APPLICANT  ======================================//
	// ===============================================================================================//

	public function get_all_applicant(){


		$grade_id = $this->input->post('grade_id');

		$this->load->model('admission/admission_batch_model','abm');
		$batch_aso_and =  $this->abm->abm->get_aso_and_by_grade($grade_id);

		if(!empty($batch_aso_and)){
		$batch = $batch_aso_and[0]->and_id;
		}
		else{
		$batch = '';
		}
		

		$html = '';
		$html .= '<div class="col-md-4 absoluteDiv2">';
		$html .= '<div class="col-md-8 no-padding">';
		$html .= '<select required class="paddingBottom10 paddingLeft10 paddingRight10 paddingTop10" id="filter_val">';
		$html .= '<option value="" disabled selected>Select Filter *</option>';
		$html .= '<option value="13">CFD</option>';
		$html .= '<option value="5">OFR</option>';
		$html .= '<option value="6">RGT</option>';
		$html .= '<option value="9">WIL</option>';
		$html .= '<option value="8">OHD</option>';
		$html .= '</select>';
		$html .= '</div><!-- col-md-6 -->';
		$html .= '<div class="col-md-4">';
		$html .= '<input type="submit" class="greenBTN btn" value="Apply" id="applicant_status" />';
		$html .= '</div><!-- col-md-6 -->';
		$html .= '</div><!-- absoluteDiv2 -->';
		$html .= '<table id="AdmissionFormListinggs" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">'; 
        $html .='<thead>'; 
        $html .='<tr>';
        //$html .='<th class="no-sort" width="2%"><input type="checkbox" id="selectAll" class="normal" /></th>'; 
        $html .='<th width="" class="text-center">Form #</th>'; 
        $html .='<th width="" class="no-sort">Applicant Name<br /><small>Father Name</small></th>';
        $html .='<th width="" class="text-center no-sort">AST Appointment<br /><div class="col-md-6 no-padding"><small>AST Done on</small></div><div class="col-md-6 no-padding text-right"><small>AST by</small></div></th>';
        $html .='<th width="" class="text-left no-sort">AST Result<br /><div class="col-md-12 no-padding text-right">AST Decision</div></th>';
        $html .='<th width="" class="text-center no-sort">DIS Appointment<br /><div class="col-md-6 no-padding"><small>DIS Done on</small></div><div class="col-md-6 no-padding text-right"><small>DIS by</small></div></th>';
        $html .='<th width="" class="text-left no-sort">DIS Result<br /><div class="col-md-12 no-padding text-right">DIS Decision</div></th>';
        $html .='<!-- <th width="" class="text-center">Decision</th> -->';
        $html .='<th width="" class="text-left no-sort">Offer Date<br /><small>Time</small></th>';
       // $html .='<th width="" class="text-center no-sort">Action</th>';
        $html .='</tr>';
        $html .='</thead>';
        if($batch == 1){

			// ===============================START AND ======================================//
			//================================================================================//
		foreach($batch_aso_and as $aso_and_process){
					if($aso_and_process->form_status_stage_id == 7){
			$html .= '<tr class="grayAlert">';
			
		}else{	
			$html .= '<tr>';

		}
		//$html .= '<tr>';	
		//$html .='<td><input type="checkbox" id="'.$aso_and_process->form_id.'" class="normal checkedStatus" unchecked /></td>';
		$html .= '<input type="hidden" id="batch_case" value="'.$aso_and_process->and_id.'">';
		$html .= '<td class="text-center" id="form_no_'.$aso_and_process->form_id.'">'.$aso_and_process->form_no.'</td>';
		$html .= '<td>'.$aso_and_process->applicant_name.'<br /><small>'.$aso_and_process->father_name.'</small></td>';
		$html .= '<td class="text-center">';
		$html .= '<strong>'.$aso_and_process->form_assessment_date.'</strong><br />';

		// IF Assessment Extension is empty
		if($aso_and_process->ast_done_on == ''){
		$html .= ' <div class="col-md-6 no-padding text-left"><small>-</small></div>';
		}
		else{
		$html .= ' <div class="col-md-6 no-padding text-left"><small>'.$aso_and_process->ast_done_on.'</small></div>';
		}

		// IF Assessment Name Code is Empty

		if($aso_and_process->ast_name_code == ''){
		$html .= '<div class="col-md-6 no-padding text-right"><small>-</small></div>';
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-right"><small>'.$aso_and_process->ast_name_code.'</small></div>';
		}
		$html .= '</td>';
		$html .= '<td class="text-left">';

		// IF Assessment Result is Empty
		if($aso_and_process->form_assessment_result == ''){
		$html .= '<div class="col-md-12 text-left">-</div>';	
		}
		else{
		$html .= '<div class="col-md-12 text-left">'.$aso_and_process->form_assessment_result.'</div>';
		}
		
		// If Assessment Decision is Empty
		if($aso_and_process->form_assessment_decision == 0){
		$html .= '<div class="col-md-12 text-right">-<div>';

		}
		else{
		$html .= '<div class="col-md-12 text-right">'.$aso_and_process->form_assessment_decision.'</div>';
		}

		$html .= '</td>';
		$html .= '<td class="text-center">';
		$html .= '<strong>'.$aso_and_process->form_assessment_date.'</strong><br />';

		// If Discussion Done  is Empty
		if($aso_and_process->dis_done_on == ''){
			$html .= '<div class="col-md-6 no-padding text-left"><small>-</small></div>';	
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-left"><small>'.$aso_and_process->dis_done_on.'</small></div>';
		}

		// If Discussion Name Code is Empty
		if($aso_and_process->dis_name_code == ''){
		$html .= '<div class="col-md-6 no-padding text-right"><small id="dis_name_code_'.$aso_and_process->form_id.'">-</small></div>';
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-right"><small>'.$aso_and_process->dis_name_code.'</small></div>';
		}

		$html .= '<div class="text-center">';
		$html .= '<hr class="lowMargin" />';

		// Reminder image
		if($aso_and_process->flag_ast_reminder == 0){
			$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}else{
		$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}

		// Presence
		if($aso_and_process->flag_ast_presence == 0){
		$html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp;';
		}
		else{
			$html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}

		// Follow Up Icon

		if($aso_and_process->flag_ast_followup == 0){
		$html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';
		}
		else{
		$html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';

		}
		
		$html .= ' </div>';
		$html .= '</td>';
		$html .= '<td class="text-left">';

		// IF Form Discussion Result is Empty
		if($aso_and_process->form_discussion_result == ''){
		$html .= '<div class="col-md-12 text-left">-</div>';

		}
		else{
		$html .= '<div class="col-md-12 text-left">'.$aso_and_process->form_discussion_result.'</div>';
		}

		// Form Dicision Result is Empty
		if($aso_and_process->form_discussion_decision == ''){
		$html .= '<div class="col-md-12 text-right" id="form_discussion_decision_'.$aso_and_process->form_id.'">-</div>';
		}
		else{
		$html .= '<div class="col-md-12 text-right">'.$aso_and_process->form_discussion_decision.'</div>';
		}
		$html .= '<div class="text-center no-padding">';
		$html .= '<hr class="lowMargin" />';
		if($aso_and_process->flag_dis_result == 0){

		$html .= '<img src="'.base_url("components/gs_theme/images/result.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; ';
		}
		else{

			$html .= '<img src="'.base_url("components/gs_theme/images/result_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; ';
		}

		if($aso_and_process->flag_dis_decision == 0){
		$html .= '<img src="'.base_url("components/gs_theme/images/discussion.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;';
		}
		else{
			$html .= '<img src="'.base_url("components/gs_theme/images/discussion_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;';
		}

		if($aso_and_process->flag_dis_allocation == 0){

		$html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;';
		}
		else{

		$html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;';
		}

		if($aso_and_process->flag_comm_dis_result == 0){
		$html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';
		}
		else{
		$html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';	
			
		}
		$html .= '</div>';
		$html .= '</td>';
		// if($aso_and_process->form_discussion_decision == ''){
			$html .= '<td class="text-left">'.$aso_and_process->final_decision.'</td>';
		// }
		// else{
		// $html .= '<td class="text-left">Approval Pending</td>';
		// }
		//$html .= '<td class="text-center"><small><a href="#" data-toggle="modal" data-target="#myModal4" id="view_and_edit" data-form="'.$aso_and_process->form_id.'">View & Edit</a><br /><br /><a href="javascript:void(0)" id="mark_present" data-presesnt="'.$aso_and_process->form_id.'">Mark as Present</a></small></td>';
		$html .= '</tr>';
		}
		} //End BAtch


		if($batch == 2){

		foreach($batch_aso_and as $aso_and_process){
		if($aso_and_process->form_status_stage_id == 7){
			$html .= '<tr class="grayAlert">';
			
		}else{	
			$html .= '<tr>';

		}

		//$html .= '<tr>';	
		//$html .='<td><input type="checkbox" id="'.$aso_and_process->form_id.'" class="normal checkedStatus" unchecked /></td>';
		$html .= '<input type="hidden" id="batch_case" value="'.$aso_and_process->and_id.'">';
		$html .= '<td class="text-center" id="">'.$aso_and_process->form_id.'</td>';
		$html .= '<td>'.$aso_and_process->applicant_name.'<br /><small>'.$aso_and_process->father_name.'</small></td>';
		$html .= '<td class="text-center">';
		$html .= '<strong>'.$aso_and_process->form_assessment_date.'</strong><br />';

		// IF Assessment Extension is empty
		if($aso_and_process->ast_done_on == ''){
		$html .= ' <div class="col-md-6 no-padding text-left"><small>-</small></div>';
		}
		else{
		$html .= ' <div class="col-md-6 no-padding text-left"><small>'.$aso_and_process->ast_done_on.'</small></div>';
		}

		// IF Assessment Name Code is Empty

		if($aso_and_process->ast_name_code == ''){
		$html .= '<div class="col-md-6 no-padding text-right"><small>-</small></div>';
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-right"><small>'.$aso_and_process->ast_name_code.'</small></div>';
		}

		$html .='<div class="text-center">';
        $html .='<hr class="lowMargin" />';

        // New Cassess

        if($aso_and_process->flag_ast_reminder == 0){
       	$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
       }else{

       	$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';

       }

       if($aso_and_process->flag_ast_presence == 0){

        $html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp;';
    	}
    	else{
    	 $html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp;';	
    		
    	}

    	if($aso_and_process->flag_ast_followup == 0){

        $html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';
    	}
    	else{

    	$html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';
    	}

        $html  .='</div>';
		$html .= '</td>';
		$html .= '<td class="text-left">';

		// IF Assessment Result is Empty
		if($aso_and_process->form_assessment_result == ''){
		$html .= '<div class="col-md-12 text-left">-</div>';	
		}
		else{
		$html .= '<div class="col-md-12 text-left">'.$aso_and_process->form_assessment_result.'</div>';
		}
		
		// If Assessment Decision is Empty
		if($aso_and_process->form_assessment_decision == ''){
		$html .= '<div class="col-md-12 text-right">-</div>';
		}
		else{
		$html .= '<div class="col-md-12 text-right">'.$aso_and_process->form_assessment_decision.'</div>';
		}

		$html .='<div class="text-center no-padding">';
        $html .='<hr class="lowMargin" />';

        // New Cassess
        if($aso_and_process->flag_ast_result == 0){
        $html .= '<img src="'.base_url("components/gs_theme/images/result.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; ';
    	}
    	else{
    	$html .= '<img src="'.base_url("components/gs_theme/images/result_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; ';

    	}

    	if($aso_and_process->flag_ast_decision == 0){

        $html .= '<img src="'.base_url("components/gs_theme/images/discussion.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;';
    	}
    	else{

    	$html .= '<img src="'.base_url("components/gs_theme/images/discussion_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;';
    	}

    	if($aso_and_process->flag_ast_allocation == 0){

        $html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;';
    	}
    	else{
    	 $html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;';
    	}


    	if($aso_and_process->flag_comm_ast_result == 0){
        $html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';
    	}
    	else{

    	$html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';

    	}

        $html .='</div>';

		$html .= '</td>';
		$html .= '<td class="text-center">';
		if($aso_and_process->form_discussion_date == ''){
		$html .= '<strong>-</strong><br/>';
		}
		else{
		$html .= '<strong>'.$aso_and_process->form_discussion_date.'</strong><br />';
		}

		// If Discussion Done  is Empty
		if($aso_and_process->dis_done_on == ''){
			$html .= '<div class="col-md-6 no-padding text-left"><small id="dis_done_on_'.$aso_and_process->form_id.'">-</small></div>';	
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-left"><small>'.$aso_and_process->dis_done_on.'</small></div>';
		}

		// If Discussion Name Code is Empty
		if($aso_and_process->dis_name_code == ''){
		$html .= '<div class="col-md-6 no-padding text-right"><small>-</small></div>';
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-right"><small>'.$aso_and_process->dis_name_code.'</small></div>';
		}

		$html .= '<div class="text-center">';
		$html .= '<hr class="lowMargin" />';

		// Reminder image
		if($aso_and_process->flag_dis_reminder == 0){
			$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}else{
		$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}

		// Presence
		if($aso_and_process->flag_dis_presence == 0){
		$html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp;';
		}
		else{
			$html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}

		// Follow Up Icon

		if($aso_and_process->flag_dis_followup == 0){
		$html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';
		}
		else{
		$html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';

		}
		
		$html .= ' </div>';
		$html .= '</td>';
		$html .= '<td class="text-left">';

		// IF Form Discussion Result is Empty
		if($aso_and_process->form_discussion_result == ''){
		$html .= '<div class="col-md-12 text-left">-</div>';

		}
		else{
		$html .= '<div class="col-md-12 text-left">'.$aso_and_process->form_discussion_result.'</div>';
		}

		// Form Dicision Result is Empty
		if($aso_and_process->form_discussion_decision == ''){
		$html .= '<div class="col-md-12 text-right">-</div>';
		}
		else{
		$html .= '<div class="col-md-12 text-right">'.$aso_and_process->form_discussion_decision.'</div>';
		}
		$html .= '<div class="text-center no-padding">';
		$html .= '<hr class="lowMargin" />';
		if($aso_and_process->flag_dis_result == 0){

		$html .= '<img src="'.base_url("components/gs_theme/images/result.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; ';
		}
		else{

			$html .= '<img src="'.base_url("components/gs_theme/images/result_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; ';
		}

		if($aso_and_process->flag_dis_decision == 0){
		$html .= '<img src="'.base_url("components/gs_theme/images/discussion.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;';
		}
		else{
			$html .= '<img src="'.base_url("components/gs_theme/images/discussion_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;';
		}

		if($aso_and_process->flag_dis_allocation == 0){

		$html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;';
		}
		else{

		$html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;';
		}

		if($aso_and_process->flag_comm_dis_result == 0){
		$html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';
		}
		else{
		$html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';	
			
		}
		$html .= '</div>';
		$html .= '</td>';
		//if($aso_and_process->form_discussion_decision == ''){
			$html .= '<td class="text-left">'.$aso_and_process->final_decision.'</td>';
		//}
		// else{
		// 	$html .= '<td class="text-left">Approval Pending</td>';
		// }
		
		//$html .= '<td class="text-center"><small><a href="#" data-toggle="modal" data-target="#myModal4" id="view_and_edit" data-form="'.$aso_and_process->form_id.'">View & Edit</a><br /><br /><a href="javascript:void(0)" id="mark_present" data-presesnt="'.$aso_and_process->form_id.'">Mark as Present</a></small></td>';
		$html .= '</tr>';


		}

		//======================ASO END =========================================//
		//=======================================================================//

		}

		$html .= '</table>';

		$html .= '<script>';
        $html .= '$(document).ready(function() {
 				  $("#AdmissionFormListinggs").dataTable();
				  });';
        $html .='</script>';

		echo $html;

                    
	}


	// =====================================APPLICANT FILTERATION DATA===============================//
	//==============================================================================================//

	public function filter_applicant(){
		$this->load->model('admission/admission_batch_model','abm');
		$applicant_status = $this->input->post('applicant_status');
		$grade_id = $this->input->post('grade_id');
		

		
		

		if($applicant_status == 5){

			$applicant_status_stage = 1;
			$status = $this->abm->get_offer_stage($applicant_status_stage,$grade_id);
			

			
		}
		else{

			$status = $this->abm->get_stage_applicant($applicant_status,$grade_id);
			
			

		}


		// FILTERATION APPLICANT DATA


		if(!empty($status)){
		$batch = $status[0]->and_id;
		}
		else{
		$batch = '';
		}


		$html = '';
		$html .= '<div class="col-md-4 absoluteDiv2">';
		$html .= '<div class="col-md-8 no-padding">';
		$html .= '<select required class="paddingBottom10 paddingLeft10 paddingRight10 paddingTop10" id="filter_val">';
		$html .= '<option value="" disabled selected>Select Filter *</option>';
		$html .= '<option value="13">CFD</option>';
		$html .= '<option value="5">OFR</option>';
		$html .= '<option value="6">RGT</option>';
		$html .= '<option value="9">WIL</option>';
		$html .= '<option value="8">OHD</option>';
		$html .= '</select>';
		$html .= '</div><!-- col-md-6 -->';
		$html .= '<div class="col-md-4">';
		$html .= '<input type="submit" class="greenBTN btn" value="Apply" id="applicant_status" />';
		$html .= '</div><!-- col-md-6 -->';
		$html .= '</div><!-- absoluteDiv2 -->';
		$html .= '<table id="AdmissionFormListinggs" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">'; 
        $html .='<thead>'; 
        $html .='<tr>';
        //$html .='<th class="no-sort" width="2%"><input type="checkbox" id="selectAll" class="normal" /></th>'; 
        $html .='<th width="" class="text-center">Form #</th>'; 
        $html .='<th width="" class="no-sort">Applicant Name<br /><small>Father Name</small></th>';
        $html .='<th width="" class="text-center no-sort">AST Appointment<br /><div class="col-md-6 no-padding"><small>AST Done on</small></div><div class="col-md-6 no-padding text-right"><small>AST by</small></div></th>';
        $html .='<th width="" class="text-left no-sort">AST Result<br /><div class="col-md-12 no-padding text-right">AST Decision</div></th>';
        $html .='<th width="" class="text-center no-sort">DIS Appointment<br /><div class="col-md-6 no-padding"><small>DIS Done on</small></div><div class="col-md-6 no-padding text-right"><small>DIS by</small></div></th>';
        $html .='<th width="" class="text-left no-sort">DIS Result<br /><div class="col-md-12 no-padding text-right">DIS Decision</div></th>';
        $html .='<!-- <th width="" class="text-center">Decision</th> -->';
        $html .='<th width="" class="text-left no-sort">Offer Date<br /><small>Time</small></th>';
       // $html .='<th width="" class="text-center no-sort">Action</th>';
        $html .='</tr>';
        $html .='</thead>';
        if($batch == 1){

			// ===============================START AND ======================================//
			//================================================================================//
		foreach($status as $aso_and_process){
		$html .= '<tr>';	
		//$html .='<td><input type="checkbox" id="'.$aso_and_process->form_id.'" class="normal checkedStatus" unchecked /></td>';
		$html .= '<input type="hidden" id="batch_case" value="'.$aso_and_process->and_id.'">';
		$html .= '<td class="text-center" id="form_no_'.$aso_and_process->form_id.'">'.$aso_and_process->form_id.'</td>';
		$html .= '<td>'.$aso_and_process->applicant_name.'<br /><small>'.$aso_and_process->father_name.'</small></td>';
		$html .= '<td class="text-center">';
		$html .= '<strong>'.$aso_and_process->form_assessment_date.'</strong><br />';

		// IF Assessment Extension is empty
		if($aso_and_process->ast_done_on == ''){
		$html .= ' <div class="col-md-6 no-padding text-left"><small>-</small></div>';
		}
		else{
		$html .= ' <div class="col-md-6 no-padding text-left"><small>'.$aso_and_process->ast_done_on.'</small></div>';
		}

		// IF Assessment Name Code is Empty

		if($aso_and_process->ast_name_code == ''){
		$html .= '<div class="col-md-6 no-padding text-right"><small>-</small></div>';
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-right"><small>'.$aso_and_process->ast_name_code.'</small></div>';
		}
		$html .= '</td>';
		$html .= '<td class="text-left">';

		// IF Assessment Result is Empty
		if($aso_and_process->form_assessment_result == ''){
		$html .= '<div class="col-md-12 text-left">-</div>';	
		}
		else{
		$html .= '<div class="col-md-12 text-left">'.$aso_and_process->form_assessment_result.'</div>';
		}
		
		// If Assessment Decision is Empty
		if($aso_and_process->form_assessment_decision == 0){
		$html .= '<div class="col-md-12 text-right">-<div>';

		}
		else{
		$html .= '<div class="col-md-12 text-right">'.$aso_and_process->form_assessment_decision.'</div>';
		}

		$html .= '</td>';
		$html .= '<td class="text-center">';
		$html .= '<strong>'.$aso_and_process->form_assessment_date.'</strong><br />';

		// If Discussion Done  is Empty
		if($aso_and_process->dis_done_on == ''){
			$html .= '<div class="col-md-6 no-padding text-left"><small>-</small></div>';	
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-left"><small>'.$aso_and_process->dis_done_on.'</small></div>';
		}

		// If Discussion Name Code is Empty
		if($aso_and_process->dis_name_code == ''){
		$html .= '<div class="col-md-6 no-padding text-right"><small id="dis_name_code_'.$aso_and_process->form_id.'">-</small></div>';
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-right"><small>'.$aso_and_process->dis_name_code.'</small></div>';
		}

		$html .= '<div class="text-center">';
		$html .= '<hr class="lowMargin" />';

		// Reminder image
		if($aso_and_process->flag_ast_reminder == 0){
			$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}else{
		$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}

		// Presence
		if($aso_and_process->flag_ast_presence == 0){
		$html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp;';
		}
		else{
			$html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}

		// Follow Up Icon

		if($aso_and_process->flag_ast_followup == 0){
		$html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';
		}
		else{
		$html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';

		}
		
		$html .= ' </div>';
		$html .= '</td>';
		$html .= '<td class="text-left">';

		// IF Form Discussion Result is Empty
		if($aso_and_process->form_discussion_result == ''){
		$html .= '<div class="col-md-12 text-left">-</div>';

		}
		else{
		$html .= '<div class="col-md-12 text-left">'.$aso_and_process->form_discussion_result.'</div>';
		}

		// Form Dicision Result is Empty
		if($aso_and_process->form_discussion_decision == ''){
		$html .= '<div class="col-md-12 text-right" id="form_discussion_decision_'.$aso_and_process->form_id.'">-</div>';
		}
		else{
		$html .= '<div class="col-md-12 text-right">'.$aso_and_process->form_discussion_decision.'</div>';
		}
		$html .= '<div class="text-center no-padding">';
		$html .= '<hr class="lowMargin" />';
		if($aso_and_process->flag_dis_result == 0){

		$html .= '<img src="'.base_url("components/gs_theme/images/result.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; ';
		}
		else{

			$html .= '<img src="'.base_url("components/gs_theme/images/result_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; ';
		}

		if($aso_and_process->flag_dis_decision == 0){
		$html .= '<img src="'.base_url("components/gs_theme/images/discussion.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;';
		}
		else{
			$html .= '<img src="'.base_url("components/gs_theme/images/discussion_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;';
		}

		if($aso_and_process->flag_dis_allocation == 0){

		$html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;';
		}
		else{

		$html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;';
		}

		if($aso_and_process->flag_comm_dis_result == 0){
		$html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';
		}
		else{
		$html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';	
			
		}
		$html .= '</div>';
		$html .= '</td>';
		// if($aso_and_process->form_discussion_decision == ''){
			$html .= '<td class="text-left">'.$aso_and_process->final_decision.'</td>';
		// }
		// else{
		// $html .= '<td class="text-left">Approval Pending</td>';
		// }
		//$html .= '<td class="text-center"><small><a href="#" data-toggle="modal" data-target="#myModal4" id="view_and_edit" data-form="'.$aso_and_process->form_id.'">View & Edit</a><br /><br /><a href="javascript:void(0)" id="mark_present" data-presesnt="'.$aso_and_process->form_id.'">Mark as Present</a></small></td>';
		$html .= '</tr>';
		}
		} //End BAtch


		if($batch == 2){

		foreach($batch_aso_and as $aso_and_process){

		$html .= '<tr>';	
		//$html .='<td><input type="checkbox" id="'.$aso_and_process->form_id.'" class="normal checkedStatus" unchecked /></td>';
		$html .= '<input type="hidden" id="batch_case" value="'.$aso_and_process->and_id.'">';
		$html .= '<td class="text-center" id="">'.$aso_and_process->form_id.'</td>';
		$html .= '<td>'.$aso_and_process->applicant_name.'<br /><small>'.$aso_and_process->father_name.'</small></td>';
		$html .= '<td class="text-center">';
		$html .= '<strong>'.$aso_and_process->form_assessment_date.'</strong><br />';

		// IF Assessment Extension is empty
		if($aso_and_process->ast_done_on == ''){
		$html .= ' <div class="col-md-6 no-padding text-left"><small>-</small></div>';
		}
		else{
		$html .= ' <div class="col-md-6 no-padding text-left"><small>'.$aso_and_process->ast_done_on.'</small></div>';
		}

		// IF Assessment Name Code is Empty

		if($aso_and_process->ast_name_code == ''){
		$html .= '<div class="col-md-6 no-padding text-right"><small>-</small></div>';
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-right"><small>'.$aso_and_process->ast_name_code.'</small></div>';
		}

		$html .='<div class="text-center">';
        $html .='<hr class="lowMargin" />';

        // New Cassess

        if($aso_and_process->flag_ast_reminder == 0){
       	$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
       }else{

       	$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';

       }

       if($aso_and_process->flag_ast_presence == 0){

        $html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp;';
    	}
    	else{
    	 $html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp;';	
    		
    	}

    	if($aso_and_process->flag_ast_followup == 0){

        $html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';
    	}
    	else{

    	$html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';
    	}

        $html  .='</div>';
		$html .= '</td>';
		$html .= '<td class="text-left">';

		// IF Assessment Result is Empty
		if($aso_and_process->form_assessment_result == ''){
		$html .= '<div class="col-md-12 text-left">-</div>';	
		}
		else{
		$html .= '<div class="col-md-12 text-left">'.$aso_and_process->form_assessment_result.'</div>';
		}
		
		// If Assessment Decision is Empty
		if($aso_and_process->form_assessment_decision == ''){
		$html .= '<div class="col-md-12 text-right">-</div>';
		}
		else{
		$html .= '<div class="col-md-12 text-right">'.$aso_and_process->form_assessment_decision.'</div>';
		}

		$html .='<div class="text-center no-padding">';
        $html .='<hr class="lowMargin" />';

        // New Cassess
        if($aso_and_process->flag_ast_result == 0){
        $html .= '<img src="'.base_url("components/gs_theme/images/result.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; ';
    	}
    	else{
    	$html .= '<img src="'.base_url("components/gs_theme/images/result_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; ';

    	}

    	if($aso_and_process->flag_ast_decision == 0){

        $html .= '<img src="'.base_url("components/gs_theme/images/discussion.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;';
    	}
    	else{

    	$html .= '<img src="'.base_url("components/gs_theme/images/discussion_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;';
    	}

    	if($aso_and_process->flag_ast_allocation == 0){

        $html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;';
    	}
    	else{
    	 $html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;';
    	}


    	if($aso_and_process->flag_comm_ast_result == 0){
        $html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';
    	}
    	else{

    	$html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';

    	}

        $html .='</div>';

		$html .= '</td>';
		$html .= '<td class="text-center">';
		if($aso_and_process->form_discussion_date == ''){
		$html .= '<strong>-</strong><br/>';
		}
		else{
		$html .= '<strong>'.$aso_and_process->form_discussion_date.'</strong><br />';
		}

		// If Discussion Done  is Empty
		if($aso_and_process->dis_done_on == ''){
			$html .= '<div class="col-md-6 no-padding text-left"><small id="dis_done_on_'.$aso_and_process->form_id.'">-</small></div>';	
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-left"><small>'.$aso_and_process->dis_done_on.'</small></div>';
		}

		// If Discussion Name Code is Empty
		if($aso_and_process->dis_name_code == ''){
		$html .= '<div class="col-md-6 no-padding text-right"><small>-</small></div>';
		}
		else{
		$html .= '<div class="col-md-6 no-padding text-right"><small>'.$aso_and_process->dis_name_code.'</small></div>';
		}

		$html .= '<div class="text-center">';
		$html .= '<hr class="lowMargin" />';

		// Reminder image
		if($aso_and_process->flag_dis_reminder == 0){
			$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}else{
		$html .= '<img src="'.base_url("components/gs_theme/images/ReminderIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}

		// Presence
		if($aso_and_process->flag_dis_presence == 0){
		$html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp;';
		}
		else{
			$html .= '<img src="'.base_url("components/gs_theme/images/PresenceIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp;';
		}

		// Follow Up Icon

		if($aso_and_process->flag_dis_followup == 0){
		$html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';
		}
		else{
		$html .= ' <img src="'.base_url("components/gs_theme/images/FollowUpIcon_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">';

		}
		
		$html .= ' </div>';
		$html .= '</td>';
		$html .= '<td class="text-left">';

		// IF Form Discussion Result is Empty
		if($aso_and_process->form_discussion_result == ''){
		$html .= '<div class="col-md-12 text-left">-</div>';

		}
		else{
		$html .= '<div class="col-md-12 text-left">'.$aso_and_process->form_discussion_result.'</div>';
		}

		// Form Dicision Result is Empty
		if($aso_and_process->form_discussion_decision == ''){
		$html .= '<div class="col-md-12 text-right">-</div>';
		}
		else{
		$html .= '<div class="col-md-12 text-right">'.$aso_and_process->form_discussion_decision.'</div>';
		}
		$html .= '<div class="text-center no-padding">';
		$html .= '<hr class="lowMargin" />';
		if($aso_and_process->flag_dis_result == 0){

		$html .= '<img src="'.base_url("components/gs_theme/images/result.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; ';
		}
		else{

			$html .= '<img src="'.base_url("components/gs_theme/images/result_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; ';
		}

		if($aso_and_process->flag_dis_decision == 0){
		$html .= '<img src="'.base_url("components/gs_theme/images/discussion.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;';
		}
		else{
			$html .= '<img src="'.base_url("components/gs_theme/images/discussion_active.png").'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp;';
		}

		if($aso_and_process->flag_dis_allocation == 0){

		$html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;';
		}
		else{

		$html .= ' <img src="'.base_url('components/gs_theme/images/AllocationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp;';
		}

		if($aso_and_process->flag_comm_dis_result == 0){
		$html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';
		}
		else{
		$html .= '<img src="'.base_url('components/gs_theme/images/CommunicationIcon_active.png').'" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">';	
			
		}
		$html .= '</div>';
		$html .= '</td>';
		//if($aso_and_process->form_discussion_decision == ''){
			$html .= '<td class="text-left">'.$aso_and_process->final_decision.'</td>';
		//}
		// else{
		// 	$html .= '<td class="text-left">Approval Pending</td>';
		// }
		
		//$html .= '<td class="text-center"><small><a href="#" data-toggle="modal" data-target="#myModal4" id="view_and_edit" data-form="'.$aso_and_process->form_id.'">View & Edit</a><br /><br /><a href="javascript:void(0)" id="mark_present" data-presesnt="'.$aso_and_process->form_id.'">Mark as Present</a></small></td>';
		$html .= '</tr>';


		}

		//======================ASO END =========================================//
		//=======================================================================//

		}

		$html .= '</table>';

		$html .= '<script>';
        $html .= '$(document).ready(function() {
 				  $("#AdmissionFormListinggs").dataTable();
				  });';
        $html .='</script>';

		echo $html;

		
	}




}