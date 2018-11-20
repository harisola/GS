<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Staff_onboarding extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('staff/staff_registered_model');		
	}

	public function index()
	{	
		$this->staff['modifed_today'] = $this->staff_registered_model->get_modified_staff_today();
		$this->form_validation->set_rules($this->staff_onboarding_form_validation);
		$this->form_validation->set_message('verifyNIC','NIC is not valid');
		$this->form_validation->set_message('existsStaffNIC','Staff is not registered against NIC, please register staff first.');


		if($this->form_validation->run() == TRUE){
			if(count($_POST))
			{
				$nic = $this->input->post('nic');
				$gender = $this->input->post('staff_gender');
				if($gender == 'on'){
					$gender = 'M';
				}else{
					$gender = 'F';
				}
				$official_name = $this->input->post('official_name');
				$abridged_name = $this->input->post('abridged_name');
				$call_name = $this->input->post('call_name');
				$name_code = $this->input->post('name_code');
				$address1 = $this->input->post('address1');
				$address2 = $this->input->post('address2');
				$landline = $this->input->post('landline');
				$gu_id = $this->input->post('gu_id') . '@generations.gs';
				$father_name = $this->input->post('father_name');
				$spouse_name = $this->input->post('spouse_name');
				$mobile_phone = $this->input->post('mobile_phone');
				$GFID = $this->input->post('gfid');

				$req_it_desktop = $this->input->post('di_need_desktop');
				$req_it_printer = $this->input->post('di_need_printer');
				$req_it_other = $this->input->post('di_need_other');
				$req_need_table = $this->input->post('snf_need_table');
				$req_need_chair = $this->input->post('snf_need_chair');
				$req_need_shelf = $this->input->post('snf_need_shelf');


				$provident_fund_comments = $this->input->post('provident_fund_comments');
				$eobi_sessi_comments = $this->input->post('eobi_sessi_comments');
				$health_takaful_comments = $this->input->post('health_takaful_comments');
				$bank_account_comments = $this->input->post('bank_account_comments');
				$loan_policy_comments = $this->input->post('loan_policy_comments');
				$child_fee_concession_comments = $this->input->post('child_fee_concession_comments');
				$timing_punctuality_comments = $this->input->post('timing_punctuality_comments');
				$probation_confirmation_comments = $this->input->post('probation_confirmation_comments');
				$notice_period_registration_comments = $this->input->post('notice_period_registration_comments');
				$dress_code_comments = $this->input->post('dress_code_comments');
				$tuition_policy_comments = $this->input->post('tuition_policy_comments');
				$annual_leave_comments = $this->input->post('annual_leave_comments');
				$emergency_policy_comments = $this->input->post('emergency_policy_comments');
				$primary_induction_comments = $this->input->post('primary_induction_comments');
				$cpd_comments = $this->input->post('cpd_comments');


				if($this->input->post('transport_shuttle') == 'on'){
					$transport_shuttle = 1;
				}else{
					$transport_shuttle = 0;
				}



				if($this->input->post('transport_door') == 'on'){
					$transport_door = 1;
				}else{
					$transport_door = 0;
				}

				
				

				$formal_doj = strtotime($this->input->post('formal_doj'));				
				$formal_doj = date('Y-m-d',$formal_doj);
				$doj_procedure = $this->input->post('joining_procedure');

				if($this->input->post('photo') == 'on'){
					$photo = 1;
				}else{
					$photo = 0;
				}
				if($this->input->post('joining_policy') == 'on'){
					$joining_policy_induction = 1;
				}else{
					$joining_policy_induction = 0;
				}				
				$smart_card = $this->input->post('smart_card');
				$visiting_card =$this->input->post('visiting_card');





				if($this->input->post('provident_fund-offer')=='on'){$provident_fund_offer=1;}else{$provident_fund_offer=0;}
				if($this->input->post('provident_fund-appointment')=='on'){$provident_fund_appointment=1;}else{$provident_fund_appointment=0;}
				if($this->input->post('provident_fund-joining')=='on'){$provident_fund_joining=1;}else{$provident_fund_joining=0;}

				if($this->input->post('eobi_sessi-offer')=='on'){$eobi_sessi_offer=1;}else{$eobi_sessi_offer=0;}
				if($this->input->post('eobi_sessi-appointment')=='on'){$eobi_sessi_appointment=1;}else{$eobi_sessi_appointment=0;}
				if($this->input->post('eobi_sessi-joining')=='on'){$eobi_sessi_joining=1;}else{$eobi_sessi_joining=0;}

				if($this->input->post('health_takaful-offer')=='on'){$life_and_health_takaful_offer=1;}else{$life_and_health_takaful_offer=0;}
				if($this->input->post('health_takaful-appointment')=='on'){$life_and_health_takaful_appointment=1;}else{$life_and_health_takaful_appointment=0;}
				if($this->input->post('health_takaful-joining')=='on'){$life_and_health_takaful_joining=1;}else{$life_and_health_takaful_joining=0;}

				if($this->input->post('bank_account-offer')=='on'){$bank_account_offer=1;}else{$bank_account_offer=0;}
				if($this->input->post('bank_account-appointment')=='on'){$bank_account_appointment=1;}else{$bank_account_appointment=0;}
				if($this->input->post('bank_account-joining')=='on'){$bank_account_joining=1;}else{$bank_account_joining=0;}
				
				
				if($this->input->post('loan_policy-offer')=='on'){$loan_policy_offer=1;}else{$loan_policy_offer=0;}
				if($this->input->post('loan_policy-appointment')=='on'){$loan_policy_appointment=1;}else{$loan_policy_appointment=0;}
				if($this->input->post('loan_policy-joining')=='on'){$loan_policy_joining=1;}else{$loan_policy_joining=0;}

				if($this->input->post('child_fee_concession-offer')=='on'){$child_fee_concession_offer=1;}else{$child_fee_concession_offer=0;}
				if($this->input->post('child_fee_concession-appointment')=='on'){$child_fee_concession_appointment=1;}else{$child_fee_concession_appointment=0;}
				if($this->input->post('child_fee_concession-joining')=='on'){$child_fee_concession_joining=1;}else{$child_fee_concession_joining=0;}

				if($this->input->post('joining-offer')=='on'){$joining_offer=1;}else{$joining_offer=0;}
				if($this->input->post('joining-appointment')=='on'){$joining_appointment=1;}else{$joining_appointment=0;}
				if($this->input->post('joining-joining')=='on'){$joining_joining=1;}else{$joining_joining=0;}

				if($this->input->post('timing_punctuality-offer')=='on'){$timing_punctuality_offer=1;}else{$timing_punctuality_offer=0;}
				if($this->input->post('timing_punctuality-appointment')=='on'){$timing_punctuality_appointment=1;}else{$timing_punctuality_appointment=0;}
				if($this->input->post('timing_punctuality-joining')=='on'){$timing_punctuality_joining=1;}else{$timing_punctuality_joining=0;}

				if($this->input->post('probation_confimation-offer')=='on'){$probation_confimation_offer=1;}else{$probation_confimation_offer=0;}
				if($this->input->post('probation_confimation-appointment')=='on'){$probation_confimation_appointment=1;}else{$probation_confimation_appointment=0;}
				if($this->input->post('probation_confimation-joining')=='on'){$probation_confimation_joining=1;}else{$probation_confimation_joining=0;}


				if($this->input->post('notice_period_resignation-offer')=='on'){$notice_period_resignation_offer=1;}else{$notice_period_resignation_offer=0;}
				if($this->input->post('notice_period_resignation-appointment')=='on'){$notice_period_resignation_appointment=1;}else{$notice_period_resignation_appointment=0;}
				if($this->input->post('notice_period_resignation-joining')=='on'){$notice_period_resignation_joining=1;}else{$notice_period_resignation_joining=0;}

				if($this->input->post('dress_code-offer')=='on'){$dress_code_offer=1;}else{$dress_code_offer=0;}
				if($this->input->post('dress_code-appointment')=='on'){$dress_code_appointment=1;}else{$dress_code_appointment=0;}
				if($this->input->post('dress_code-joining')=='on'){$dress_code_joining=1;}else{$dress_code_joining=0;}

				if($this->input->post('tuition_policy-offer')=='on'){$tuition_policy_offer=1;}else{$tuition_policy_offer=0;}
				if($this->input->post('tuition_policy-appointment')=='on'){$tuition_policy_appointment=1;}else{$tuition_policy_appointment=0;}
				if($this->input->post('tuition_policy-joining')=='on'){$tuition_policy_joining=1;}else{$tuition_policy_joining=0;}




				if($this->input->post('annual_leave-offer')=='on'){$annual_leave_offer=1;}else{$annual_leave_offer=0;}
				if($this->input->post('annual_leave-appointment')=='on'){$annual_leave_appointment=1;}else{$annual_leave_appointment=0;}
				if($this->input->post('annual_leave-joining')=='on'){$annual_leave_joining=1;}else{$annual_leave_joining=0;}

				if($this->input->post('emergency_policy-offer')=='on'){$emergency_policy_offer=1;}else{$emergency_policy_offer=0;}
				if($this->input->post('emergency_policy-appointment')=='on'){$emergency_policy_appointment=1;}else{$emergency_policy_appointment=0;}
				if($this->input->post('emergency_policy-joining')=='on'){$emergency_policy_joining=1;}else{$emergency_policy_joining=0;}

				if($this->input->post('cpd_induction-offer')=='on'){$cpd_induction_offer=1;}else{$cpd_induction_offer=0;}
				if($this->input->post('cpd_induction-appointment')=='on'){$cpd_induction_appointment=1;}else{$cpd_induction_appointment=0;}
				if($this->input->post('cpd_induction-joining')=='on'){$cpd_induction_joining=1;}else{$cpd_induction_joining=0;}

				if($this->input->post('primary_induction-offer')=='on'){$primary_induction_offer=1;}else{$primary_induction_offer=0;}
				if($this->input->post('primary_induction-appointment')=='on'){$primary_induction_appointment=1;}else{$primary_induction_appointment=0;}
				if($this->input->post('primary_induction-joining')=='on'){$primary_induction_joining=1;}else{$primary_induction_joining=0;}

				if($this->input->post('cpd-offer')=='on'){$cpd_offer=1;}else{$cpd_offer=0;}
				if($this->input->post('cpd-appointment')=='on'){$cpd_appointment=1;}else{$cpd_appointment=0;}
				if($this->input->post('cpd-joining')=='on'){$cpd_joining=1;}else{$cpd_joining=0;}
				


				



				$data['staff_reg'] = $this->staff_registered_model->get_by(array('nic' => $nic));				
				$staffID = (int)$data['staff_reg'][0]->id;




				// *******************************************************************
				// Saving Data to Staff Registered
				// *******************************************************************
				$this->load->model('staff/staff_registered_model');	
				$data = array(
					'name' => $official_name,
					'abridged_name' => $abridged_name,
					'call_name' => $call_name,
					'gender' => $gender,
					'father_name' => $father_name,
					'spouse_name' => $spouse_name,
					'home_address_1' => $address1,
					'home_address_2' => $address2
					//'gg_id' => $gu_id
				);				
				$id = (int)$this->staff_registered_model->save($data, $staffID);
				// *******************************************************************



				// *******************************************************************
				// Staff Child information
				// *******************************************************************
				$this->load->model('staff/staff_child_model');
				$GFID = $this->makeGFID_Num($GFID);
				$staffChildID=0;
				if($GFID != 0 and $GFID != ''){
					$staffChildID = (int)$this->staff_child_model->get_staff_child_id($staffID);
					$data = array(
						'staff_id' => $staffID,
						'gf_id' => $GFID
					);
				}
				if($staffChildID > 0){
					$id = (int)$this->staff_child_model->save($data, $staffChildID);
				}else{
					if($GFID != 0 and $GFID != ''){
						$this->staff_child_model->save($data);
					}
				}
				// *******************************************************************



				// *******************************************************************
				// Checking IT requirement exists or not
				// *******************************************************************
				$this->load->model('staff/staff_req_it_model');
				$data = array(
					'staff_id' => $staffID,
					'desktop' => $req_it_desktop,
					'printer' => $req_it_printer,
					'other' => $req_it_other
				);
				
				if($this->staff_req_it_model->exists_staff_req_it($staffID) == true){
					$id = (int)$this->staff_req_it_model->save($data, $staffID);
				}else{					
					$this->staff_req_it_model->save($data);
				}
				// *******************************************************************
				



				// *******************************************************************
				// Checking Sapce & Furniture requirement exists or not
				// *******************************************************************
				$this->load->model('staff/staff_req_spacefurniture_model');
				$data = array(
					'staff_id' => $staffID,
					'table' => $req_need_table,
					'chair' => $req_need_chair,
					'shelf' => $req_need_shelf
				);
				
				if($this->staff_req_spacefurniture_model->exists_staff_req_spacefurniture($staffID) == true){
					$id = (int)$this->staff_req_spacefurniture_model->save($data, $staffID);
				}else{					
					$this->staff_req_spacefurniture_model->save($data);
				}
				// *******************************************************************
				





				// *******************************************************************
				// Checking Transport requirement exists or not
				// *******************************************************************
				$this->load->model('staff/staff_req_transport_model');
				$data = array(
					'staff_id' => $staffID,
					'private' => $transport_shuttle,
					'shuttle' => $transport_door					
				);
				
				if($this->staff_req_transport_model->exists_staff_req_transport($staffID) == true){
					$id = (int)$this->staff_req_transport_model->save($data, $staffID);
				}else{					
					$this->staff_req_transport_model->save($data);
				}
				// *******************************************************************
				
				





				// *******************************************************************
				// Checking Joining requirement exists or not
				// *******************************************************************				
				$this->load->model('staff/staff_req_joining_model');
				$data = array(
					'staff_id' => $staffID,
					'formal_doj' => $formal_doj,
					'doj_procedure' => $doj_procedure,
					'photo' => $photo,
					'joining_policy_induction' => $joining_policy_induction,
					'smart_card' => $smart_card,
					'visiting_card' => $visiting_card
				);
				
				if($this->staff_req_joining_model->exists_staff_req_joining($staffID) == true){
					$id = (int)$this->staff_req_joining_model->save($data, $staffID);
				}else{					
					$this->staff_req_joining_model->save($data);
				}
				// *******************************************************************
				
				



				// *******************************************************************
				// Checking Onboarding requirement exists or not
				// *******************************************************************				
				$this->load->model('staff/Staff_req_onboarding_model');
				$data = array(
					'staff_id' => $staffID,
					'provident_fund_offer' => $provident_fund_offer,
					'provident_fund_appointment' => $provident_fund_appointment,
					'provident_fund_joining' => $provident_fund_joining,

					'eobi_sessi_offer' => $eobi_sessi_offer,
					'eobi_sessi_appointment' => $eobi_sessi_appointment,
					'eobi_sessi_joining' => $eobi_sessi_joining,

					'life_and_health_takaful_offer' => $life_and_health_takaful_offer,
					'life_and_health_takaful_appointment' => $life_and_health_takaful_appointment,
					'life_and_health_takaful_joining' => $life_and_health_takaful_joining,


					'bank_account_offer' => $bank_account_offer,
					'bank_account_appointment' => $bank_account_appointment,
					'bank_account_joining' => $bank_account_joining,


					'loan_policy_offer' => $loan_policy_offer,
					'loan_policy_appointment' => $loan_policy_appointment,
					'loan_policy_joining' => $loan_policy_joining,


					'child_fee_concession_offer' => $child_fee_concession_offer,
					'child_fee_concession_appointment' => $child_fee_concession_appointment,
					'child_fee_concession_joining' => $child_fee_concession_joining,


					'timing_punctuality_offer' => $timing_punctuality_offer,
					'timing_punctuality_appointment' => $timing_punctuality_appointment,
					'timing_punctuality_joining' => $timing_punctuality_joining,


					'probation_and_confirmation_offer' => $probation_confimation_offer,
					'probation_and_confirmation_appointment' => $probation_confimation_appointment,
					'probation_and_confirmation_joining' => $probation_confimation_joining,


					'notice_period_and_resignation_offer' => $notice_period_resignation_offer,
					'notice_period_and_resignation_appointment' => $notice_period_resignation_appointment,
					'notice_period_and_resignation_joining' => $notice_period_resignation_joining,


					'dress_code_offer' => $dress_code_offer,
					'dress_code_appointment' => $dress_code_appointment,
					'dress_code_joining' => $dress_code_joining,


					'tuition_policy_offer' => $tuition_policy_offer,
					'tuition_policy_appointment' => $tuition_policy_appointment,
					'tuition_policy_joining' => $tuition_policy_joining,


					'annual_leave_offer' => $annual_leave_offer,
					'annual_leave_appointment' => $annual_leave_appointment,
					'annual_leave_joining' => $annual_leave_joining,


					'emergency_policy_offer' => $emergency_policy_offer,
					'emergency_policy_appointment' => $emergency_policy_appointment,
					'emergency_policy_joining' => $emergency_policy_joining,


					'primary_induction_offer' => $primary_induction_offer,
					'primary_induction_appointment' => $primary_induction_appointment,
					'primary_induction_joining' => $primary_induction_joining,

					'cpd_offer' => $cpd_offer,
					'cpd_appointment' => $cpd_appointment,
					'cpd_joining' => $cpd_joining,


					'provident_fund_comments' => $provident_fund_comments,
					'eobi_sessi_comments' => $eobi_sessi_comments,
					'health_takaful_comments' => $health_takaful_comments,
					'bank_account_comments' => $bank_account_comments,
					'loan_policy_comments' => $loan_policy_comments,
					'child_fee_concession_comments' => $child_fee_concession_comments,
					'timing_punctuality_comments' => $timing_punctuality_comments,
					'probation_confirmation_comments' => $probation_confirmation_comments,
					'notice_period_registration_comments' => $notice_period_registration_comments,
					'dress_code_comments' => $dress_code_comments,
					'tuition_policy_comments' => $tuition_policy_comments,
					'annual_leave_comments' => $annual_leave_comments,
					'emergency_policy_comments' => $emergency_policy_comments,
					'primary_induction_comments' => $primary_induction_comments,
					'cpd_comments' => $cpd_comments
				);
				
				if($this->Staff_req_onboarding_model->exists_staff_req_onboarding($staffID) == true){
					$id = (int)$this->Staff_req_onboarding_model->save($data, $staffID);
				}else{					
					$this->Staff_req_onboarding_model->save($data);
				}
				// *******************************************************************
				
			}			
		}

		$firstdate = date('Y-m-d 0:0:0');
		$firstdate = human_to_unix($firstdate);
		$this->staff_today_data['staff_today_data'] = array($this->staff_registered_model->get_by(array('created >=' => $firstdate)));

		$this->load->view('hcm/onboarding/staff_onboarding_form');
		$this->load->view('hcm/onboarding/staff_onboarding_orb_footer');
	}




	public $staff_onboarding_form_validation = array(		
		array('field' => 'nic', 'label' => 'N.I.C', 'rules' => 'trim|sanitize|required|min_length[15]|max_length[15]|callback_verifyNIC|callback_existsStaffNIC')
	);


	function verifyNIC($str)
	{
	   $field_value = $str;	   
	   
	   if($this->input->post('nic') == "" && $this->input->post('nic') == "XXXXX-XXXXXXX-X")
	   {
	     return FALSE;
	   }
	   else
	   {
	   		if(strpos($this->input->post('nic'), 'X') !== false){
	   			return FALSE;
	   		}else{
	   			return TRUE;
	   		}
	   }
	}



	function existsStaffNIC($str)
	{
	   $field_value = $str;	   
	   
	   if($this->staff_registered_model->is_staff_nic_exists($this->input->post('nic'))==false)
	   {
	     return FALSE;
	   }
	   else
	   {
			return TRUE;	   		
	   }
	}



	public function makeGFID_Num($ID){
		$makeGFID_Num = "";
		$makeGFID_Num = str_replace("-", "", $ID);

		return $makeGFID_Num;
	}





	public function printForm()
	{
		if(count($_POST))
		{
			$nic = $this->input->post('nic_val');			
			$this->getPDFNow($nic);
		}
	}


	public function getPDFNow($nic)
	{

		$data['staff_reg'] = $this->staff_registered_model->get_by(array('nic' => $nic));
		$this->load->model('staff/staff_child_model');
		$data['staff_child'] = $this->staff_child_model->get_by(array('staff_id' => $data['staff_reg'][0]->id));
		$data['applicant_fathername'] = $this->staff_child_model->get_staff_father_spouse($data['staff_reg'][0]->id,1);
		$data['applicant_spousename'] = $this->staff_child_model->get_staff_father_spouse($data['staff_reg'][0]->id,2);
		$data['applicant_address'] = $this->staff_child_model->get_address($data['staff_reg'][0]->id);

		$this->load->model('staff/staff_req_it_model');
		$data['staff_it'] = $this->staff_req_it_model->get_by(array('staff_id' => $data['staff_reg'][0]->id));
		$this->load->model('staff/staff_req_spacefurniture_model');
		$data['staff_spacefurniture'] = $this->staff_req_spacefurniture_model->get_by(array('staff_id' => $data['staff_reg'][0]->id));
		$this->load->model('staff/staff_req_transport_model');
		$data['staff_transport'] = $this->staff_req_transport_model->get_by(array('staff_id' => $data['staff_reg'][0]->id));
		$this->load->model('staff/staff_req_joining_model');
		$data['staff_joining'] = $this->staff_req_joining_model->get_by(array('staff_id' => $data['staff_reg'][0]->id));
		$this->load->model('staff/Staff_req_onboarding_model');
		$data['staff_onboarding'] = $this->Staff_req_onboarding_model->get_by(array('staff_id' => $data['staff_reg'][0]->id));


		// REPORTING 

		$this->load->model('tif_model/tif_a_form_model');
		$staffData = $this->tif_a_form_model->get_StaffInfo($data['staff_reg'][0]->gt_id);

		if(!empty($staffData[0]['pm_report_to'])){

			if(!empty($this->tif_a_form_model->get_StaffReportingInfo($staffData[0]['pm_report_to']))){
				$staff_PR = $this->tif_a_form_model->get_StaffReportingInfo($staffData[0]['pm_report_to']);
			}else{
				$staff_PR = '';
			}
		}else{
			$staff_PR = '';
		}

		if(!empty($staffData[0]['sc_report_to'])){

			if(!empty($this->tif_a_form_model->get_StaffReportingInfo($staffData[0]['sc_report_to']))){
				$staff_SR = $this->tif_a_form_model->get_StaffReportingInfo($staffData[0]['sc_report_to']);
			}else{
				$staff_SR = '';
			}
		}else{
			$staff_SR = '';
		}


		// Profile  Timing

		$where = array(
			'staff_id' => $data['staff_reg'][0]->id,
			'record_deleted' => 0
		);
		$select = '';
		$this->load->model('tif_a/tif_a_model','tm');
		$profile_timing =  $this->tm->get_by('atif_gs_events.tt_profile_time_staff',$select,$where);

		$where_gc_id = array(
			'nic' => $nic
		);	
		$select = '';
		$gc_id = $this->tm->get_by('atif_career.career',$select,$where_gc_id);
		if(!empty($gc_id)){
			$gc_id = $gc_id[0]->gc_id;
		}else{
			$gc_id = '';
		}
			

		if(!empty($profile_timing)){
			$profile_time_in = $profile_timing[0]->mon_in;
			$profile_time_out = $profile_timing[0]->mon_out;
		}else{
			$profile_time_in = '';
			$profile_time_out = '';

		}


		// Role Code

		$where_role = array(
			'staff_id' => $data['staff_reg'][0]->id
		);
		$select = '';

		$role_code = $this->tm->get_by('atif_role_org.role_position',$select,$where_role);
		if(!empty($role_code)){
			$role_code = $role_code[0]->roleCode;
		}else{
			$role_code = '';
		}
		
		// all variables ************************

		$gt_id =$data['staff_reg'][0]->gt_id;
		$gender =$data['staff_reg'][0]->gender;
		$dob =date_create($data['staff_reg'][0]->dob);
		$dob =date_format($dob,'d-M-Y');
		$doj =date_create($data['staff_reg'][0]->doj);
		$doj =date_format($doj,'d-M-Y');
		$name =$data['staff_reg'][0]->name;
		$abridged_name = $data['staff_reg'][0]->abridged_name;
		$guid =$data['staff_reg'][0]->gg_id;
		$ncode =$data['staff_reg'][0]->name_code;
		if(!empty($staff_PR)){
			$primary_reporting = $staff_PR[0]['name'];
		}else{
			$primary_reporting = '';
		}
		
		if(!empty($staff_SR)){
			$secondary_reporting = $staff_SR[0]['name'];
		}else{
			$secondary_reporting = '';
		}
		
		//$address_one =$data['staff_reg'][0]->home_address_1;
		//$address_two =$data['staff_reg'][0]->home_address_2;

		//===================== Address ==========================//
		//=======================================================//

		if(!empty($data['applicant_address'])){

			$apartment_no = $data['applicant_address'][0]->apartment_no;
		$building_name = $data['applicant_address'][0]->building_name;
		$plot_no = $data['applicant_address'][0]->plot_no;
		$street_name = $data['applicant_address'][0]->street_name;
		$sub_region = $data['applicant_address'][0]->sub_region;
		$region = $data['applicant_address'][0]->region;

		}else{
		$apartment_no = '';
		$building_name = '' ;
		$plot_no = '';
		$street_name = '';
		$sub_region = '';
		$region =  '';
		}
		

		$cell_no =$data['staff_reg'][0]->mobile_phone;
		$land_line =$data['staff_reg'][0]->land_line;
		$username =ucwords($this->session->userdata['username']);

		if(!empty($data['applicant_fathername'])){
			$fathername = $data['applicant_fathername'][0]->name;
			$spousename = $data['applicant_spousename'][0]->name;

		}else{
			$fathername = '';
			$spousename = '';
		}
		
		$designation =$data['staff_reg'][0]->designation;
		$role =$data['staff_reg'][0]->staff_type;
		$department =$data['staff_reg'][0]->department;
		if(!empty($data['staff_child'][0]->gf_id))
		{
			$gfid = $data['staff_child'][0]->gf_id;
		}
		else
		{
			$gfid='';
		}

		if(!empty($gfid))
		{
			$this->load->model('staff/staff_child_model');
			$data['student_detail']=$this->staff_child_model->getStaffChildDetail($gfid);
			$gfid = $this->makeGFID($gfid);	
		}
		
		
		//var_dump($data['student_detail']);
		

		//Physical Need

		if($data['staff_it'])
		{
		$desktop = $data['staff_it'][0]->desktop;
		$printer=$data['staff_it'][0]->printer;
		$other=$data['staff_it'][0]->other;
		}
		else
		{
			$desktop = '';
			$printer ='';
			$other = '';
		}
		if($data['staff_spacefurniture'])
		{
		$table=$data['staff_spacefurniture'][0]->table;
		$chair=$data['staff_spacefurniture'][0]->chair;
		$shelf=$data['staff_spacefurniture'][0]->shelf;
		}
		else
		{
			$table = '';
			$chair = '';
			$shelf = '';
		}
		//Transport
		if($data['staff_transport'])
		{
		$private = $data['staff_transport'][0]->shuttle;
		$shuttle = $data['staff_transport'][0]->private;
		}
		else
		{
			$private = '';
			$shuttle = '';
		}
		//Staff Joining
		if($data['staff_joining'])
		{
		$formal_doj = date_create($data['staff_joining'][0]->formal_doj);
		$formal_doj = date_format($formal_doj,'d-M-Y');
		$doj_procedure =$data['staff_joining'][0]->doj_procedure;
		$photo=$data['staff_joining'][0]->photo;
		$joining_policy = $data['staff_joining'][0]->joining_policy_induction;
		$smartcard=$data['staff_joining'][0]->smart_card;
		$visitingcard=$data['staff_joining'][0]->visiting_card;
		}
		else
		{
			$formal_doj = '';
			$doj_procedure='';
			$photo='';
			$joining_policy='';
			$smartcard='';
			$visitingcard='';
		}
		//OnBoarding
		if($data['staff_onboarding'])
		{
		$providentoffer=$data['staff_onboarding'][0]->provident_fund_offer;
		$providentappointment=$data['staff_onboarding'][0]->provident_fund_appointment;
		$providentjoining=$data['staff_onboarding'][0]->provident_fund_joining;
		$providentcomment=$data['staff_onboarding'][0]->provident_fund_comments;

		$eobioffer=$data['staff_onboarding'][0]->eobi_sessi_offer;
		$eobiappointment=$data['staff_onboarding'][0]->eobi_sessi_appointment;
		$eobijoining=$data['staff_onboarding'][0]->eobi_sessi_joining;
		$eobicomment=$data['staff_onboarding'][0]->eobi_sessi_comments;

		$lifeoffer=$data['staff_onboarding'][0]->life_and_health_takaful_offer;
		$lifeappointment=$data['staff_onboarding'][0]->life_and_health_takaful_appointment;
		$lifejoining=$data['staff_onboarding'][0]->life_and_health_takaful_joining;
		$lifecomment=$data['staff_onboarding'][0]->health_takaful_comments;

		$bankoffer=$data['staff_onboarding'][0]->bank_account_offer;
		$bankappointment=$data['staff_onboarding'][0]->bank_account_appointment;
		$bankjoining=$data['staff_onboarding'][0]->bank_account_joining;
		$bankcomment=$data['staff_onboarding'][0]->bank_account_comments;

		$loanoffer =$data['staff_onboarding'][0]->loan_policy_offer;
		$loanappointment=$data['staff_onboarding'][0]->loan_policy_appointment;
		$loanjoining=$data['staff_onboarding'][0]->loan_policy_joining;
		$loancomment=$data['staff_onboarding'][0]->loan_policy_comments;

		$childoffer=$data['staff_onboarding'][0]->child_fee_concession_offer;
		$childappointment=$data['staff_onboarding'][0]->child_fee_concession_appointment;
		$childjoining=$data['staff_onboarding'][0]->child_fee_concession_joining;
		$childcomment=$data['staff_onboarding'][0]->child_fee_concession_comments;

		$timingoffer=$data['staff_onboarding'][0]->timing_punctuality_offer;
		$timingappointment=$data['staff_onboarding'][0]->timing_punctuality_appointment;
		$timingjoining=$data['staff_onboarding'][0]->timing_punctuality_joining;
		$timingcomment=$data['staff_onboarding'][0]->timing_punctuality_comments;

		$probationoffer=$data['staff_onboarding'][0]->probation_and_confirmation_offer;
		$probationappointment=$data['staff_onboarding'][0]->probation_and_confirmation_appointment;
		$probationjoining=$data['staff_onboarding'][0]->probation_and_confirmation_joining;
		$probationcomment=$data['staff_onboarding'][0]->probation_confirmation_comments;

		$noticeoffer=$data['staff_onboarding'][0]->notice_period_and_resignation_offer;
		$noticeappointment=$data['staff_onboarding'][0]->notice_period_and_resignation_appointment;
		$noticejoining=$data['staff_onboarding'][0]->notice_period_and_resignation_joining;
		$noticecomment=$data['staff_onboarding'][0]->notice_period_registration_comments;


		$dressoffer=$data['staff_onboarding'][0]->dress_code_offer;
		$dressappointment=$data['staff_onboarding'][0]->dress_code_appointment;
		$dressjoining=$data['staff_onboarding'][0]->dress_code_joining;
		$dresscomment=$data['staff_onboarding'][0]->dress_code_comments;

		$tutionoffer=$data['staff_onboarding'][0]->tuition_policy_offer;
		$tutionappointment=$data['staff_onboarding'][0]->tuition_policy_appointment;
		$tutionjoining=$data['staff_onboarding'][0]->tuition_policy_joining;
		$tutioncomment=$data['staff_onboarding'][0]->tuition_policy_comments;

		$annualoffer=$data['staff_onboarding'][0]->annual_leave_offer;
		$annualappointment=$data['staff_onboarding'][0]->annual_leave_appointment;
		$annualjoining=$data['staff_onboarding'][0]->annual_leave_joining;
		$annualcomment=$data['staff_onboarding'][0]->annual_leave_comments;

		$emergencyoffer=$data['staff_onboarding'][0]->emergency_policy_offer;
		$emergencyappointment=$data['staff_onboarding'][0]->emergency_policy_appointment;
		$emergencyjoining=$data['staff_onboarding'][0]->emergency_policy_joining;
		$emergencycomment=$data['staff_onboarding'][0]->emergency_policy_comments;

		$primaryoffer=$data['staff_onboarding'][0]->primary_induction_offer;
		$primaryappointment=$data['staff_onboarding'][0]->primary_induction_appointment;
		$primaryjoining=$data['staff_onboarding'][0]->primary_induction_joining;
		$primarycomment=$data['staff_onboarding'][0]->primary_induction_comments;


		$cpdoffer= $data['staff_onboarding'][0]->cpd_offer;
		$cpdappointment=$data['staff_onboarding'][0]->cpd_appointment;
		$cpdjoining=$data['staff_onboarding'][0]->cpd_joining;
		$cpdcomment=$data['staff_onboarding'][0]->cpd_comments;
		}
		else
		{
		$providentoffer='';
		$providentappointment='';
		$providentjoining='';
		$providentcomment='';
		$eobioffer='';
		$eobiappointment='';
		$eobijoining='';
		$eobicomment='';
		$lifeoffer='';
		$eobiappointment='';
		$eobijoining='';
		$eobicomment='';

		$lifeoffer='';
		$lifeappointment='';
		$lifejoining='';
		$lifecomment='';

		$bankoffer='';
		$bankappointment='';
		$bankjoining='';
		$bankcomment='';

		$loanoffer ='';
		$loanappointment='';
		$loanjoining='';
		$loancomment='';

		$childoffer='';
		$childappointment='';
		$childjoining='';
		$childcomment='';

		$timingoffer='';
		$timingappointment='';
		$timingjoining='';
		$timingcomment='';

		$probationoffer='';
		$probationappointment='';
		$probationjoining='';
		$probationcomment='';

		$noticeoffer='';
		$noticeappointment='';
		$noticejoining='';
		$noticecomment='';


		$dressoffer='';
		$dressappointment='';
		$dressjoining='';
		$dresscomment='';

		$tutionoffer='';
		$tutionappointment='';
		$tutionjoining='';
		$tutioncomment='';

		$annualoffer='';
		$annualappointment='';
		$annualjoining='';
		$annualcomment='';

		$emergencyoffer='';
		$emergencyappointment='';
		$emergencyjoining='';
		$emergencycomment='';

		$primaryoffer= '';
		$primaryappointment='';
		$primaryjoining= '';
		$primarycomment='';


		$cpdoffer= '';
		$cpdappointment='';
		$cpdjoining='';
		$cpdcomment='';
		}


		//Declaring an array of GS_ID;

		if(!empty($gfid))
		{
			for($i=0; $i<sizeof($data['student_detail']) ;$i++)
			{
				
				$gs_id[$i]=$data['student_detail'][$i]['gs_id'];
				$student_name[$i]=$data['student_detail'][$i]['official_name'];
				$class[$i]=$data['student_detail'][$i]['grade_dname']."-".$data['student_detail'][0]['section_dname'];
				$house[$i]=$data['student_detail'][$i]['house_dname'];
			}


		}

		//var_dump($house);



		//***************************************

		
		//var_dump($data['staff_onboarding']);
		 
		// Overall Font Size
		$font_size = 10;
		$font_name = 'Helvetica';
		$gender_mark_size = 20;
		$now_date = date('d-M-Y');
		$borderOn = 1;

		require_once('components/pdf/fpdf/fpdf.php');
		require_once('components/pdf/fpdi/fpdi.php');

		
		// initiate FPDI
		$pdf = new FPDI('P','mm','A4');

		// get the page count
		$pageCount = $pdf->setSourceFile('components/pdf/hcm_onboarding/onboarding_form.pdf');
		// iterate through all pages
		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
		    // import a page
		    $templateId = $pdf->importPage($pageNo);
		    // get the size of the imported page
		    $size = $pdf->getTemplateSize($templateId);

		    // create a page (landscape or portrait depending on the imported page size)
		    if ($size['w'] > $size['h']) {
		        $pdf->AddPage('L', array($size['w'], $size['h']));
		    } else {
		        $pdf->AddPage('P', array($size['w'], $size['h']));
		    }		    

		    // use the imported page
	    	$pdf->useTemplate($templateId);

	    	// Page # 1
	    	if ($templateId == 1){
			    // Staff name is here
			    // $pdf->SetFont($font_name);
			    // $pdf->SetFont($font_name,'',$font_size);
			    // $pdf->SetXY(17, 77.5);
			    // $pdf->Write(8, ucwords(strtolower($name)));

			    // gender marking
			    // if ($gender == 'M')
			    // {
			    // 	$pdf->AddFont('wingdng2','','wingdng2.php');
				   //  $pdf->SetFont('wingdng2','',$gender_mark_size);
				   //  $pdf->SetXY(126, 78.2);
				   //  $pdf->Write(8, 'P');

			   	// }else if($gender == 'F'){
			   	// 	$pdf->AddFont('wingdng2','','wingdng2.php');
				   //  $pdf->SetFont('wingdng2','',$gender_mark_size);
				   //  $pdf->SetXY(144, 78.2);
				   //  $pdf->Write(8, 'P');
			   	// }

			   	// cnic is here
			   	// $pdf->SetFont($font_name);
			   	// $pdf->SetFont($font_name,'',$font_size);
			    // $pdf->SetXY(90.5, 130);
			    // $pdf->Write(8, $nic);

			    //Gt-id
			    $borderOn = 0;
			   if($gt_id != '' || $gt_id != null){
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(23,27.8);
			   $pdf->Cell(26.5, 5.3, $gt_id, $borderOn, 0, 'L', 0);
			   }

			   // Applicant Form No 

			   if($gc_id != ''){
			   	$pdf->SetDrawColor(0,80,180);
		       	$pdf->SetFont($font_name,'',$font_size);
		       	$pdf->SetFillColor(0,80,180);
		       	$pdf->SetXY(23,33.5);
			   	$pdf->Cell(26.5, 5.3, $gc_id, $borderOn, 0, 'L', 0);

			   }

			   //Nic
			   if($nic != '' || $gt_id != null)
			   { 
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
			   $decrement_step = 0.1;
			   $line_width = 25.5;
			   $pdf->SetFont($font_name);			    
			   $pdf->SetXY(23,39);
			   $this_font_size = $font_size;
			   while($pdf->GetStringWidth($nic) > $line_width) {
			   $this_font_size -= $decrement_step;
			   $pdf->SetFont($font_name,'',$this_font_size);
						 }
			   $pdf->Cell($line_width, 5.2, $nic, $borderOn, 0, 'L', 0);
				}

			   //Date Of Birth

			   if($dob != '' || $dob != null)
			   {
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(78.4,27.8);
			   $pdf->Cell(26.5, 5.2, $dob, $borderOn, 0, 'L', 0);
			   }

			   //Date OF Joining

			   if($doj != '')
			   {
			  
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(78.4,33.5);
		       $line_width = 26.5;
		       $this_font_size = $font_size;
			   while($pdf->GetStringWidth($doj) > $line_width) {
			   $this_font_size -= $decrement_step;
			   $pdf->SetFont($font_name,'',$this_font_size);
				}
				
			   $pdf->Cell(26.5, 5.2, $doj, $borderOn, 0, 'L', 0);
				}
			   //Gender

			   if($data['staff_reg'][0]->gender == 'M')
			   {

			   	$gend = 'Male';
			   	$pdf->SetDrawColor(0,80,180);
		       	$pdf->SetFont($font_name,'',$font_size);
		       	$pdf->SetFillColor(0,80,180);
		       	$pdf->SetXY(78.9,39);
			   	$pdf->Cell(26.5, 5.2, $gend, $borderOn, 0, 'L', 0);

			   }
			   else if($data['staff_reg'][0]->gender == 'F')
			   {

			   	$gend = 'Female';
			   	$pdf->SetDrawColor(0,80,180);
		       	$pdf->SetFont($font_name,'',$font_size);
		       	$pdf->SetFillColor(0,80,180);
		       	$pdf->SetXY(78.9,39);
			   	$pdf->Cell(26.5, 5.2, $gend, $borderOn, 0, 'L', 0);
			   }

			   //Oficial Name
			   if($name != '')
			   {
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(37,49);
			   $pdf->Cell(66.5, 5.2, $name, $borderOn, 0, 'L', 0);
			   }
			   //Abridge Name
			   if($abridged_name != '')
			   {
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(37,54.5);
			   $pdf->Cell(66.5, 5.2, $abridged_name, $borderOn, 0, 'L', 0);
				}

			   //GU ID

			   if($guid != '')
			   {
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(37,60.5);
			   $pdf->Cell(66.5, 5.2, $guid, $borderOn, 0, 'L', 0);
			   }

			   //Name Code

			   if($ncode != '')
			   {
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(37,66.5);
			   $pdf->Cell(66.5, 5.2, $ncode, $borderOn, 0, 'L', 0);
			   }

			   //Address One
			   // if($address_one != '')
			   // {
			   // $pdf->SetDrawColor(0,80,180);
		    //    $pdf->SetFont($font_name,'',$font_size);
		    //    $pdf->SetFillColor(0,80,180);
		    //    $pdf->SetXY(38.4,67.1);
			   // $pdf->Cell(66.5, 5.2, $address_one, $borderOn, 0, 'L', 0);
			   // }

			   // //Address Two

			   // if($address_two != '')
			   // {
			   // $pdf->SetDrawColor(0,80,180);
		    //    $pdf->SetFont($font_name,'',$font_size);
		    //    $pdf->SetFillColor(0,80,180);
		    //    $pdf->SetXY(38.4,72.5);
			   // $pdf->Cell(66.5, 5.2, $address_two, $borderOn, 0, 'L', 0);
			   // }


			   // Appartment no 

			   if($apartment_no != ''){

			   	$pdf->SetDrawColor(0,80,180);
		       	$pdf->SetFont($font_name,'',$font_size);
		       	$pdf->SetFillColor(0,80,180);
		       	$pdf->SetXY(36,77.9);
			   	$pdf->Cell(66.5, 5.2, $apartment_no, $borderOn, 0, 'L', 0);

			   }

			   // Building No

			   if($building_name != ''){

			   	$pdf->SetDrawColor(0,80,180);
		       	$pdf->SetFont($font_name,'',$font_size);
		       	$pdf->SetFillColor(0,80,180);
		       	$pdf->SetXY(36,84);
			   	$pdf->Cell(66.5, 5.2, $building_name, $borderOn, 0, 'L', 0);

			   }

			   // Sub Region

			   if($sub_region != ''){

			   	$pdf->SetDrawColor(0,80,180);
		       	$pdf->SetFont($font_name,'',$font_size);
		       	$pdf->SetFillColor(0,80,180);
		       	$pdf->SetXY(36,90);
			   	$pdf->Cell(66.5, 5.2, $sub_region, $borderOn, 0, 'L', 0);

			   }

			   



			   //Cell No

			   if($cell_no != '')
			   {
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(36,95.5);
			   $pdf->Cell(66.5, 5.2, $cell_no, $borderOn, 0, 'L', 0);
			   }

			   

			   // Plot No 

			   if($plot_no != ''){
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(77,77.9);
			   $pdf->Cell(66.5, 5.2, $plot_no, $borderOn, 0, 'L', 0);
			   }

			    // Street Name

			   if($street_name != ''){

			   	$pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(77,84);
		       $line_width = 26;
		       $this_font_size = $font_size;
			   while($pdf->GetStringWidth($street_name) > $line_width) {
			   $this_font_size -= $decrement_step;
			   $pdf->SetFont($font_name,'',$this_font_size);
				}
		       
			   $pdf->Cell(66.5, 5.2, $street_name, $borderOn, 0, 'L', 0);
			   }
			   
			   // Region

			   if($region != ''){

			   	$pdf->SetDrawColor(0,80,180);
		       	$pdf->SetFont($font_name,'',$font_size);
		       	$pdf->SetFillColor(0,80,180);
		       	$pdf->SetXY(77,90);
			   	$pdf->Cell(66.5, 5.2, $region, $borderOn, 0, 'L', 0);

			   }

			  





			   //Land Line Number
			   if($land_line != '')
			   {
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(77,95.5);
			   $pdf->Cell(66.5, 5.2, $land_line, $borderOn, 0, 'L', 0);
			   }

			   //Username
			   if($username != '')
			   {
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(23,108.8);
			   $pdf->Cell(66.5, 5.2, $username, $borderOn, 0, 'L', 0);
			   }

			   // Date Stamp 

			   if($username != ''){
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',8);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(23,120);
			   $pdf->Cell(66.5, 5.2, date("D, d M Y"), $borderOn, 0, 'L', 0);
			   }

			   //Father Name
			   if($fathername != '')
			   {
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(132.9,33.3);
			   $pdf->Cell(66.5, 5.2, $fathername, $borderOn, 0, 'L', 0);

			   }

			   //Spouse Name
			   if($spousename != '')
			   {
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(132.9,39.3);
			   $pdf->Cell(66.5, 5.2, $spousename, $borderOn, 0, 'L', 0);
			   }		

			   //Designation

			   if($designation != '')
			   {

			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(23,139);
			   $pdf->Cell(53, 5.2, $designation, $borderOn, 0, 'L', 0);

			   }

			   //Role

			  if($role_code != '')
			  {
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(23,144.5);
			   $pdf->Cell(53, 5.2, $role_code, $borderOn, 0, 'L', 0);
			  }

			  //Department

			  if($department != '')
			  {
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(23,150.5);
			   $pdf->Cell(53, 5.2, $department, $borderOn, 0, 'L', 0);
			  }

			  //========= Reporting ============//

			  if($primary_reporting != ''){

			  	$pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(106,145);
			   $pdf->Cell(53, 5.2, $primary_reporting, $borderOn, 0, 'L', 0);

			  }


			  if($secondary_reporting != ''){

			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(106,151);
			   $pdf->Cell(53, 5.2, $secondary_reporting, $borderOn, 0, 'L', 0);

			  }


			  // ============ Profile Timing ================//

			  if($profile_time_in != ''){

			  	$pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(160,144.5);
			   $pdf->Cell(53, 5.2, date('g:i A',strtotime($profile_time_in)), $borderOn, 0, 'L', 0);

			  }

			  if($profile_time_out != ''){


			  	$pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(160,151);
			   $pdf->Cell(53, 5.2, date('g:i A',strtotime($profile_time_out)), $borderOn, 0, 'L', 0);

			  } 

			  //GFID
			  if($gfid != '')
			  {
			   $pdf->SetDrawColor(0,80,180);
		       $pdf->SetFont($font_name,'',$font_size);
		       $pdf->SetFillColor(0,80,180);
		       $pdf->SetXY(132.9,27.5);
			   $pdf->Cell(26.5, 5.2, $gfid, $borderOn, 0, 'L', 0);
			  }
			  

			  if(!empty($gfid))
			  {
			  	// for GS ID
			  	$height=0;
			  	for($i=0; $i<sizeof($gs_id); $i++)
			  	{
			  		$pdf->SetDrawColor(0,80,180);
					$pdf->SetFont($font_name,'',$font_size);
					$pdf->SetFillColor(0,80,180);
					if($i == 0)
					{
						$pdf->SetXY(119.6,55);

					}
					else
					{
						$pdf->SetXY(119.6,$height+55);	
					}
						    		
						$pdf->Cell(13, 5.4, $gs_id[$i], $borderOn, 0, 'L', 0);
						$height = $height + 5.4;	
			  	}


			  	//For Student Name


			  	$height=0;
			  	for($i=0;$i<sizeof($student_name);$i++)
			  	{
			  		$pdf->SetDrawColor(0,80,180);
					$pdf->SetFont($font_name,'',$font_size);
					$pdf->SetFillColor(0,80,180);
					if($i == 0)
					{
						$pdf->SetXY(132.5,55);
					}
					else
					{
						$pdf->SetXY(132.5,$height+55);	
					}
					$line_width = 38;
		       		$this_font_size = $font_size;
			     	while($pdf->GetStringWidth($student_name[$i]) > $line_width) {
			     	$this_font_size -= $decrement_step;
			    	$pdf->SetFont($font_name,'',$this_font_size);
					}
						    		
					$pdf->Cell(38, 5.4, $student_name[$i], $borderOn, 0, 'L', 0);
					$height = $height + 5.4;	
			  	}

			  	//For Student Class

			  	$height=0;
			  	for($i=0;$i<sizeof($class);$i++)
			  	{
			  		$pdf->SetDrawColor(0,80,180);
					$pdf->SetFont($font_name,'',$font_size);
					$pdf->SetFillColor(0,80,180);
					if($i == 0)
					{
						$pdf->SetXY(175,55);
					}
					else
					{
						$pdf->SetXY(175,$height+55);	
					}
						    		
					$pdf->Cell(13, 5.4, $class[$i], $borderOn, 0, 'L', 0);
					$height = $height + 5.4;	
			  	}

			  	// House Name

			  	$height=0;
			  	for($i=0;$i<sizeof($house);$i++)
			  	{
			  		$pdf->SetDrawColor(0,80,180);
					$pdf->SetFont($font_name,'',$font_size);
					$pdf->SetFillColor(0,80,180);
					if($i == 0)
					{
						$pdf->SetXY(187.5,55);
					}
					else
					{
						$pdf->SetXY(187.5,$height+55);	
					}
						    		
					$pdf->Cell(13, 5.4, $house[$i], $borderOn, 0, 'L', 0);
					$height = $height + 5.4;	
			  	}


			  }
			 



			  // Physical Need

			  //desktop
			  // var_dump($desktop);
			  if($desktop != '' or $desktop != 'null' )
			  {
			  if ($desktop == 'New Need')
			    {
			    	$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(26, 204.5);
				    $pdf->Write(8, 'P');

			   	}else if($desktop == 'Re-allocation'){
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(40, 204.5);
				    $pdf->Write(8, 'P');
			   	}
			   	else if($desktop == 'No Need')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(53.5, 204.5);
				    $pdf->Write(8, 'P');
			   	}
			   }

			   	//Printer
			   	if($printer != ''){
			   	if($printer == 'New Need')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(26, 211);
				    $pdf->Write(8, 'P');

			   	}
			   	else if($printer == 'Re-allocation'){
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(39.5, 211);
				    $pdf->Write(8, 'P');
			   	}
			   	else if($printer == 'No Need')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(53.5, 211);
				    $pdf->Write(8, 'P');
			   	}
			   }

			   	//Other

			   	if($other == 'New Need')
			   	{

			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(26, 217);
				    $pdf->Write(8, 'P');	
			   	}
			   	else if($other == 'Re-allocation')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(39.5, 217);
				    $pdf->Write(8, 'P');
			   	}
			   	else if($other == 'No Need')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(53.5, 217);
				    $pdf->Write(8, 'P');
			   	}

			   	// Table

			   	if($table == 'New Need')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(94, 204.5);
				    $pdf->Write(8, 'P');
			   	}
			   	else if($table == 'Re-allocation')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(108.5, 204.5);
				    $pdf->Write(8, 'P');

			   	}
			   	else if($table == 'No Need')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(121, 204.5);
				    $pdf->Write(8, 'P');
			   	}

			   	//Chair
			   	//var_dump($chair);

			   	if($chair == 'New Need')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(94, 211);
				    $pdf->Write(8, 'P');
			   	}
			   	else if($chair == 'Re-allocation')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(108.5, 211);
				    $pdf->Write(8, 'P');

			   	}
			   	else if($chair == 'No Need')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(121, 211);
				    $pdf->Write(8, 'P');
			   	}

			   	//SHELF

			   	if($shelf == 'New Need')
			   	{

			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(94, 217);
				    $pdf->Write(8, 'P');
			   	}
			   	else if($shelf == 'Re-allocation')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(108.5, 217);
				    $pdf->Write(8, 'P');
			   	}
			   	else if($shelf == 'No Need')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(121, 217);	
				    $pdf->Write(8, 'P');
			   	}

			   	//Shuttle
			   
			   	//var_dump($shuttle);
			   	if($shuttle == '0')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(176.8, 199);
				    $pdf->Write(8, 'P');
			   	}
			   	else if($shuttle == '1')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(163.6, 199);
				    $pdf->Write(8, 'P');
			   	}

			   	//Private

			   	if($private == '0')
			   	{
			   		$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(176.8, 205);
				    $pdf->Write(8, 'P');
			   	}
			   	else if($private == '1')
			   	{
					$pdf->AddFont('wingdng2','','wingdng2.php');
				    $pdf->SetFont('wingdng2','',$gender_mark_size);
				    $pdf->SetXY(163.6, 205);
				    $pdf->Write(8, 'P');
			   	}


			}

			//Page # 2

			if($templateId == 2)
			{
				//date of Joining

				if($formal_doj != '')
				{
				$pdf->SetDrawColor(0,80,180);
		       	$pdf->SetFont($font_name,'',$font_size);
		       	$pdf->SetFillColor(0,80,180);
		       	$pdf->SetXY(91.2,17.5);
			   	$pdf->Cell(43, 5.4, $formal_doj, $borderOn, 0, 'L', 0);
				}

				//date of joining
				if($doj_procedure != '')
				{
				$pdf->SetDrawColor(0,80,180);
		       	$pdf->SetFont($font_name,'',$font_size);
		       	$pdf->SetFillColor(0,80,180);
		       	$pdf->SetXY(91.2,23.2);
			   	$pdf->Cell(43, 5.4, $doj_procedure, $borderOn, 0, 'L', 0);
				}

				//Photo
				// var_dump($photo);
				if($photo != '')
				{
					if($photo == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(38.5, 31);
				     $pdf->Write(8, 'P');
					}
					else if($photo == '0')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(38.5, 31);
				     $pdf->Write(8, 'O');	
					}

				}

				// JOining Policy
				if($joining_policy != '')
				{
					if(intval($joining_policy) == 0)
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(38.5, 36.5);
				     $pdf->Write(8, 'O');	
					}else{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(38.5, 36.5);
				     $pdf->Write(8, 'P');

					}
				}
				
				//Smart Card
				if($smartcard != '')
				{
					if($smartcard == 'N/A')
					{
					 // $pdf->AddFont('wingdng2','','wingdng2.php');
				  //    $pdf->SetFont('wingdng2','',$gender_mark_size);
				  //    $pdf->SetXY(136, 31);
				  //    $pdf->Write(8, 'P');
					}
					else if($smartcard == 'Printed')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(136, 31);
				     $pdf->Write(8, 'P');
					}
					else if($smartcard == 'H/O')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(150, 31);
				     $pdf->Write(8, 'P');
					}
				}

				if($visitingcard != '')
				{
					if($visitingcard == 'N/A')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(136, 37);
				     $pdf->Write(8, 'P');
					}
					else if ($visitingcard == 'Printed')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(150, 37);
				     $pdf->Write(8, 'P');	
					}
					else if($visitingcard == 'H/O')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(164, 37);
				     $pdf->Write(8, 'P');
					}

				}

				//var_dump($data['staff_onboarding']);

				//Staff OnBoarding
				if($providentoffer != '')
				{
					if($providentoffer == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(37.7, 62);
				     $pdf->Write(8, 'P');
					}
				}
				if($providentappointment != '')
				{
					if($providentappointment == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(52, 62);
				     $pdf->Write(8, 'P');
					}
				}
				if($providentjoining != '')
				{
					if($providentjoining == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(65, 62);
				     $pdf->Write(8, 'P');
					}
				}

				$font_size1 = 7;
				if($providentcomment != '')
				{
				 $pdf->SetDrawColor(0,80,180);
		       	 $pdf->SetFont($font_name,'',$font_size1);
		       	 $pdf->SetFillColor(0,80,180);
		       	 $pdf->SetXY(77,62);
		       	 $line_width = 28;
		       	 $this_font_size = $font_size1;
			     while($pdf->GetStringWidth($providentcomment) > $line_width) {
			     $this_font_size -= $decrement_step;
			     $pdf->SetFont($font_name,'',$this_font_size);
						 }
			     //$pdf->Cell($line_width, 5.2, $nic, $borderOn, 0, 'L', 0);
			   	 $pdf->Cell(28, 5.6, $providentcomment, $borderOn, 0, 'L', 0);
				}

				if($eobioffer != '')
				{
					if($eobioffer == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(37.7, 68);
				     $pdf->Write(8, 'P');
					}
				}

				if($eobiappointment != '')
				{
					if($eobiappointment == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(52, 68);
				     $pdf->Write(8, 'P');
					}
				}

				if($eobijoining != '')
				{
					if($eobijoining == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(65, 68);
				     $pdf->Write(8, 'P');
					}
				}

				if($eobicomment != '')

				{
				 $pdf->SetDrawColor(0,80,180);
		       	 $pdf->SetFont($font_name,'',$font_size1);
		       	 $pdf->SetFillColor(0,80,180);
		       	 $pdf->SetXY(77,68);
		       	 $line_width = 28;
		       	 $this_font_size = $font_size1;
			     while($pdf->GetStringWidth($eobicomment) > $line_width) 
			     {
			     $this_font_size -= $decrement_step;
			     $pdf->SetFont($font_name,'',$this_font_size);
				 }
				 $pdf->Cell(28, 5.5, $eobicomment, $borderOn, 0, 'L', 0);
				}

				if($lifeoffer != '')
				{
					if($lifeoffer == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(37.7, 74);
				     $pdf->Write(8, 'P');	
					}
				}

				if($lifeappointment != '')
				{
					if($lifeappointment == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(52, 74);
				     $pdf->Write(8, 'P');
					}
				}

				if($lifejoining != '')
				{
					if($lifejoining == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(65, 74);
				     $pdf->Write(8, 'P');
					}
				}

				if($lifecomment != '')
				{
				 $pdf->SetDrawColor(0,80,180);
		       	 $pdf->SetFont($font_name,'',$font_size1);
		       	 $pdf->SetFillColor(0,80,180);
		       	 $pdf->SetXY(77,74);
		       	 $line_width = 28;
		       	 $this_font_size = $font_size1;
			     while($pdf->GetStringWidth($lifecomment) > $line_width) 
			     {
			     $this_font_size -= $decrement_step;
			     $pdf->SetFont($font_name,'',$this_font_size);
				 }
			   	 $pdf->Cell(28, 5.9, $lifecomment, $borderOn, 0, 'L', 0);
				}

				if($bankoffer != '')
				{
					if($bankoffer == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(37.7, 80);
				     $pdf->Write(8, 'P');
					}
				}
				if($bankappointment != '')
				{
					if($bankappointment == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(52, 80);
				     $pdf->Write(8, 'P');
					}
				}
				if($bankjoining != '')
				{
					if($bankjoining == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(65, 80);
				     $pdf->Write(8, 'P');
					}
				}
				if($bankcomment != '')
				{
				 $pdf->SetDrawColor(0,80,180);
		       	 $pdf->SetFont($font_name,'',$font_size1);
		       	 $pdf->SetFillColor(0,80,180);
		       	 $pdf->SetXY(77,80);
		       	 $line_width = 28;
		       	 $this_font_size = $font_size1;
			     while($pdf->GetStringWidth($bankcomment) > $line_width) 
			     {
			     $this_font_size -= $decrement_step;
			     $pdf->SetFont($font_name,'',$this_font_size);
				 }
			   	 $pdf->Cell(28, 5.9, $bankcomment, $borderOn, 0, 'L', 0);
				}

				if($loanoffer != '')
				{
					if($loanoffer == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(37.7, 86);
				     $pdf->Write(8, 'P');
					}
				}
				if($loanappointment != '')
				{
					if($loanappointment == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(52, 86);
				     $pdf->Write(8, 'P');
					}
				}
				if($loanjoining != '')
				{
					if($loanjoining == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(65, 86);
				     $pdf->Write(8, 'P');
					}
				}

				if($loancomment != '')
				{
				 $pdf->SetDrawColor(0,80,180);
		       	 $pdf->SetFont($font_name,'',$font_size1);
		       	 $pdf->SetFillColor(0,80,180);
		       	 $pdf->SetXY(77,86);
		       	 $line_width = 28;
		       	 $this_font_size = $font_size1;
			     while($pdf->GetStringWidth($loancomment) > $line_width) 
			     {
			     $this_font_size -= $decrement_step;
			     $pdf->SetFont($font_name,'',$this_font_size);
				 }
			   	 $pdf->Cell(28, 5.9, $loancomment, $borderOn, 0, 'L', 0);
				}

				if($childoffer != '')
				{
					if($childoffer  == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(37.7, 91);
				     $pdf->Write(8, 'P');
					}
				}
				if($childappointment != '')
				{
					if($childappointment == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(52, 91);
				     $pdf->Write(8, 'P');
					}
				}
				if($childjoining != '')
				{
					if($childjoining == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(65, 91);
				     $pdf->Write(8, 'P');
					}
				}

				if($childcomment != '')
				{
				 $pdf->SetDrawColor(0,80,180);
		       	 $pdf->SetFont($font_name,'',$font_size1);
		       	 $pdf->SetFillColor(0,80,180);
		       	 $pdf->SetXY(77,91);
		       	 $line_width = 28;
		       	 $this_font_size = $font_size1;
			     while($pdf->GetStringWidth($childcomment) > $line_width) 
			     {
			     $this_font_size -= $decrement_step;
			     $pdf->SetFont($font_name,'',$this_font_size);
				 }
			   	 $pdf->Cell(28, 5.9, $childcomment, $borderOn, 0, 'L', 0);
				}

				if($timingoffer != '')
				{
					if($timingoffer == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(37.7, 103);
				     $pdf->Write(8, 'P');	
					}
				}
				if($timingappointment != '')
				{
					if($timingoffer == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(52, 103);
				     $pdf->Write(8, 'P');
					}
				}
				if($timingjoining != '')
				{
					if($timingjoining == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(65, 103);
				     $pdf->Write(8, 'P');
					}
				}

				if($timingcomment != '')
				{
				 $pdf->SetDrawColor(0,80,180);
		       	 $pdf->SetFont($font_name,'',$font_size1);
		       	 $pdf->SetFillColor(0,80,180);
		       	 $pdf->SetXY(77,103);
		       	 $line_width = 28;
		       	 $this_font_size = $font_size1;
			     while($pdf->GetStringWidth($timingcomment) > $line_width) {
			     $this_font_size -= $decrement_step;
			     $pdf->SetFont($font_name,'',$this_font_size);
						 }
			     
			   	 $pdf->Cell(28, 5.8, $timingcomment, $borderOn, 0, 'L', 0);
				}

				if($probationoffer != '')
				{
					if($probationoffer == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(37.7, 108);
				     $pdf->Write(8, 'P');
					}
				}
				if($probationappointment != '')
				{
					if($probationappointment == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(52, 108);
				     $pdf->Write(8, 'P');
					}
				}
				if($probationjoining != '')
				{
					if($probationjoining == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(65, 108);
				     $pdf->Write(8, 'P');
					}
				}
				if($probationcomment != '')
				{

				 $pdf->SetDrawColor(0,80,180);
		       	 $pdf->SetFont($font_name,'',$font_size1);
		       	 $pdf->SetFillColor(0,80,180);
		       	 $pdf->SetXY(77,108);
		       	 $line_width = 28;
		       	 $this_font_size = $font_size1;
			     while($pdf->GetStringWidth($probationcomment) > $line_width) {
			     $this_font_size -= $decrement_step;
			     $pdf->SetFont($font_name,'',$this_font_size);
				 }
			     
			   	 $pdf->Cell(28, 5.9, $probationcomment, $borderOn, 0, 'L', 0);

				} 
				if($noticeoffer != '')
				{
					if($noticeoffer == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(37.7, 114);
				     $pdf->Write(8, 'P');	
					}
					//var_dump($data['staff_onboarding']);
				}
				if($noticeappointment != '')
				{
					if($noticeappointment == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(52, 114);
				     $pdf->Write(8, 'P');
					}
				}
				if($noticejoining != '')
				{
					if($noticejoining == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(65, 114);
				     $pdf->Write(8, 'P');
					}
				}
				if($noticecomment != '')
				{
				 $pdf->SetDrawColor(0,80,180);
		       	 $pdf->SetFont($font_name,'',$font_size1);
		       	 $pdf->SetFillColor(0,80,180);
		       	 $pdf->SetXY(77,114);
		       	 $line_width = 28;
		       	 $this_font_size = $font_size1;
			     while($pdf->GetStringWidth($noticecomment) > $line_width) {
			     $this_font_size -= $decrement_step;
			     $pdf->SetFont($font_name,'',$this_font_size);
				 }
			     
			   	 $pdf->Cell(28, 5.9, $noticecomment, $borderOn, 0, 'L', 0);
				}

				//================================ HR Policies =========================//
				//======================================================================//
				if($dressoffer != '')
				{
					if($dressoffer == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(137.6, 62);
				     $pdf->Write(8, 'P');
					}
				}
				if($dressappointment != '')
				{
					if($dressappointment == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(150.6, 62);
				     $pdf->Write(8, 'P');
					}
				}
				if($dressjoining != '')
				{
					if($dressjoining == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(164, 62);
				     $pdf->Write(8, 'P');
					}
				}

				if($dresscomment != '')
				{

				 $pdf->SetDrawColor(0,80,180);
		       	 $pdf->SetFont($font_name,'',$font_size1);
		       	 $pdf->SetFillColor(0,80,180);
		       	 $pdf->SetXY(190,62);
		       	 $line_width = 14;
		       	 $this_font_size = $font_size1;
			     while($pdf->GetStringWidth($dresscomment) > $line_width) {
			     $this_font_size -= $decrement_step;
			     $pdf->SetFont($font_name,'',$this_font_size);
				 }
			     
			   	 $pdf->Cell(14, 5.8, $dresscomment, $borderOn, 0, 'L', 0);
				}

				if($tutionoffer != '')
				{
					if($tutionoffer == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(137.6, 68);
				     $pdf->Write(8, 'P');
					}
				}

				if($tutionappointment != '')
				{
					if($tutionappointment == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(150.6, 68);
				     $pdf->Write(8, 'P');
					}
				}

				if($tutionjoining != '')
				{
					if($tutionjoining == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(164, 68);
				     $pdf->Write(8, 'P');
					}
				}

				if($tutioncomment != '')
				{

				 $pdf->SetDrawColor(0,80,180);
		       	 $pdf->SetFont($font_name,'',$font_size1);
		       	 $pdf->SetFillColor(0,80,180);
		       	 $pdf->SetXY(190,68);
		       	 $line_width = 14;
		       	 $this_font_size = $font_size1;
			     while($pdf->GetStringWidth($tutioncomment) > $line_width) {
			     $this_font_size -= $decrement_step;
			     $pdf->SetFont($font_name,'',$this_font_size);
				 }
			     
			   	 $pdf->Cell(14, 5.8, $tutioncomment, $borderOn, 0, 'L', 0);

				}

				if($annualoffer != '')
				{
					if($annualoffer == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(137.6, 74);
				     $pdf->Write(8, 'P');
					}
				}

				if($annualappointment != '')
				{
					if($annualappointment == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(150.6, 74);
				     $pdf->Write(8, 'P');
				 	}
				}

				if($annualjoining != '')
				{
					if($annualjoining == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(164, 74);
				     $pdf->Write(8, 'P');
					}
				}

				if($annualcomment != '')
				{
				 $pdf->SetDrawColor(0,80,180);
		       	 $pdf->SetFont($font_name,'',$font_size1);
		       	 $pdf->SetFillColor(0,80,180);
		       	 $pdf->SetXY(190,74);
		       	 $line_width = 14;
		       	 $this_font_size = $font_size1;
			     while($pdf->GetStringWidth($annualcomment) > $line_width) {
			     $this_font_size -= $decrement_step;
			     $pdf->SetFont($font_name,'',$this_font_size);
				 }
			     
			   	 $pdf->Cell(14, 5.6, $annualcomment, $borderOn, 0, 'L', 0);
				}

				if($emergencyoffer != '')
				{
					if($emergencyoffer == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(137.6, 80);
				     $pdf->Write(8, 'P');
					}
				}

				if($emergencyappointment != '')
				{
					if($emergencyappointment == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(150.6, 80);
				     $pdf->Write(8, 'P');
					}
				}

				if($emergencyjoining != '')
				{
					if($emergencyjoining == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(164, 80);
				     $pdf->Write(8, 'P');
					}
				}

				if($emergencycomment != '')
				{
				 $pdf->SetDrawColor(0,80,180);
		       	 $pdf->SetFont($font_name,'',$font_size1);
		       	 $pdf->SetFillColor(0,80,180);
		       	 $pdf->SetXY(190,80);
		       	 $line_width = 14;
		       	 $this_font_size = $font_size1;
			     while($pdf->GetStringWidth($emergencycomment) > $line_width) {
			     $this_font_size -= $decrement_step;
			     $pdf->SetFont($font_name,'',$this_font_size);
				 }
			     
			   	 $pdf->Cell(14, 5.8, $emergencycomment, $borderOn, 0, 'L', 0);
				}

				if($primaryoffer != '')
				{
					if($primaryoffer == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(137.6, 103);
				     $pdf->Write(8, 'P');	
					}
				}

				if($primaryappointment != '')
				{
					if($primaryappointment == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(150.6, 103);
				     $pdf->Write(8, 'P');
					}
				}
				if($primaryjoining != '')
				{
					if($primaryjoining == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(164, 103);
				     $pdf->Write(8, 'P');

					}
				}

				if($primarycomment != '')
				{
				 $pdf->SetDrawColor(0,80,180);
		       	 $pdf->SetFont($font_name,'',$font_size1);
		       	 $pdf->SetFillColor(0,80,180);
		       	 $pdf->SetXY(190,103);
		       	 $line_width = 14;
		       	 $this_font_size = $font_size1;
			     while($pdf->GetStringWidth($primarycomment) > $line_width) {
			     $this_font_size -= $decrement_step;
			     $pdf->SetFont($font_name,'',$this_font_size);
				 }
			     
			   	 $pdf->Cell(14, 5.6, $primarycomment, $borderOn, 0, 'L', 0);
				}

				if($cpdoffer != '')
				{
					if($cpdoffer == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(137.6, 108);
				     $pdf->Write(8, 'P');		
					}
				}

				if($cpdappointment != '')
				{
					if($cpdappointment == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(150.6, 108);
				     $pdf->Write(8, 'P');	
					}
				}

				if($cpdjoining != '')
				{
					if($cpdjoining == '1')
					{
					 $pdf->AddFont('wingdng2','','wingdng2.php');
				     $pdf->SetFont('wingdng2','',$gender_mark_size);
				     $pdf->SetXY(164, 108);
				     $pdf->Write(8, 'P');
					}
				}

				if($cpdcomment != '')
				{
				 $pdf->SetDrawColor(0,80,180);
		       	 $pdf->SetFont($font_name,'',$font_size1);
		       	 $pdf->SetFillColor(0,80,180);
		       	 $pdf->SetXY(190,108);
		       	 $line_width = 14;
		       	 $this_font_size = $font_size1;
			     while($pdf->GetStringWidth($cpdcomment) > $line_width) {
			     $this_font_size -= $decrement_step;
			     $pdf->SetFont($font_name,'',$this_font_size);
				 }
			     
			   	 $pdf->Cell(14, 5.8, $cpdcomment, $borderOn, 0, 'L', 0);
				}



				//var_dump($data['staff_child']);
			}

		}

		// Output the new PDF
		$pdf->Output($name . '.pdf', 'I');
		//$pdf->Output();

	}



	public function makeGFID($ID){
		$makeGFID = "";

		if($ID <= 999){
			$makeGFID = "00" . "-" . str_pad(str_pad($ID, -3), 3, "0", STR_PAD_LEFT);
		}else if($ID <= 9999){
			$makeGFID = "0" . substr($ID, 0, 1) . "-" . substr($ID, -3);
		}else{
			$makeGFID = substr($ID, 0, 2) . "-" . substr($ID, -3);
		}

		return $makeGFID;
	}
}