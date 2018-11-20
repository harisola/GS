
<?php

class Admission_offer_approve_ajax extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$user_id =  (int)$this->session->userdata('user_id'); 
		$this->user_id = $user_id;
	}

	public function get_offer_detail(){
		$grade_id = $this->input->post('grade_id');
		$this->load->model('admission/offer_model','am');
		$offer_detail =  $this->am->offer_detail_by_grade($grade_id);

		$html = '';
		$html .= '<table id="AdmissionFormListingg" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">';
		$html .= '<thead> ';
		$html .= '<tr>';
		$html .= '<th width="7%" class="text-center">Form </th> ';
		$html .= '<th width="7%" class="text-center">Batch ID</th> ';
		$html .= '<th width="14%">Applicant Name<br /><small>Father Name</small></th>';
		$html .= '<th width="16%" class=" no-sort">Offer Date<br />Payment Due Date</th>';
		$html .= '<th width="10%" class="text-left no-sort">Offer Details</th>';
		$html .= '<th width="12%" class="text-left no-sort">Offer Preparation</th>';
		$html .= '<th width="12%" class="text-left no-sort">Offer Procedure</th>';
		$html .= '<th width="15%" class="text-center no-sort">Status</th>';
		$html .= '<th width="7%" class="text-center no-sort">Action</th>';
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';
		foreach($offer_detail as $offer){

		
		

		$html .='<tr>';
		$html .= '<td class="text-center">'.str_pad($offer->form_no, 5, '0', STR_PAD_LEFT).'</td>';
		$html .= '<td class="text-center">'.$offer->final_batchslot.'<br /> '.$offer->form_discussion_criteria.'</td>';
		$html .= '<td>'.$offer->applicant_name.'<br /><small>'.$offer->father_name.'</small></td>'; 
		$html .= '<td class="text-left">'.$offer->offer_date.'<br /><span id="due_date_'.$offer->form_id.'">'.$offer->payment_due_date.'</span></td>'; 
		$html .= '<td class="text-left">'; 
		$html .= '<ul class="liActions">';

		// Previous School and Grade
		if($grade_id != 1 && $grade_id != 17 && $grade_id != 2){
			if($offer->is_previous_school_grade == 0){
				$html .= '<li id="previous_school_grade_'.$offer->form_id.'" class="cross">Previous School & Grade</li>'; 
			}
			else{
				$html .= '<li id="previous_school_grade_'.$offer->form_id.'" class="tick">Previous School & Grade</li>'; 
			}
		}

		// Address
		if($offer->is_address == 0){
			$html .= '<li id="address_'.$offer->form_id.'" class="cross">Address</li>'; 
		}
		else{
			$html .= '<li id="address_'.$offer->form_id.'" class="tick">Address</li>'; 
		}

		// Date OF Payment
		if($offer->is_date_of_payment == 0){
			$html .= '<li id="date_of_payment_'.$offer->form_id.'" class="cross">Payment window</li>'; 
		}
		else{
			$html .= '<li id="date_of_payment_'.$offer->form_id.'" class="tick">Payment window</li>'; 
		}


		//Concession Code

		if($offer->is_concession_code == 0){
			$html .= '<li id="concession_code_'.$offer->form_id.'" class="cross">Concession Code</li>'; 
		}
		else{
			$html .= '<li id="concession_code_'.$offer->form_id.'" class="tick">Concession Code</li>'; 
		}


		// Activation Date

		if($offer->is_activiation_date == 0){
			$html .= '<li id="activation_date_'.$offer->form_id.'" class="cross">Activation/Joining Date</li>';
		}
		else{
			$html .= '<li id="activation_date_'.$offer->form_id.'" class="tick">Activation/Joining Date</li>';
		}

		// Father Mother Details

		if($offer->is_family_detail == 0){
			$html .= '<li id="family_detail_'.$offer->form_id.'" class="cross">Father/Mother details</li>';
		}
		else{
			$html .= '<li id="family_detail_'.$offer->form_id.'" class="tick">Father/Mother details</li>';
		}

		
		
		
		$html .= '</ul>'; 
		$html .= '</td>';
		$html .= '<td class="text-left">'; 
		$html .= '<ul class="liActions">';

		// Offer Printed

		if($offer->is_printed_offer_letter == 1){
			$html .= '<li id="offer_'.$offer->form_id.'" class="tick">Print Offer Letter</li>'; 
		}
		else{
		$html .= '<li id="offer_'.$offer->form_id.'" class="cross">Print Offer Letter</li>'; 
		}

		// is_printed_fif

		if($offer->is_printed_fif == 1){
			$html .= '<li id="fif_'.$offer->form_id.'" class="tick">Print FIF</li>'; 
		}
		else{
			$html .= '<li id="fif_'.$offer->form_id.'" class="cross">Print FIF</li>'; 
		}

		// Photo Taken

		if($offer->is_printed_photo_token == 1){
			$html .= '<li id="photo_'.$offer->form_id.'" class="tick">Print Photo Token</li>'; 
		}
		else{
			$html .= '<li id="photo_'.$offer->form_id.'" class="cross">Print Photo Token</li>'; 
		}


		// HandBook

		if($offer->is_handbook == 1){
			$html .= '<li id="handbook_'.$offer->form_id.'"class="tick">Handbook ready</li>';
		}
		else{
			$html .= '<li id="handbook_'.$offer->form_id.'" class="cross">Handbook ready</li>';
		}

		// Print Fee Bill

		if($offer->is_printed_fee_bill == 1){
			$html .= '<li id="printed_fee_'.$offer->form_id.'"class="tick">Print Fee Bill</li>';
		}else{
			$html .= '<li id="printed_fee_'.$offer->form_id.'" class="cross">Print Fee Bill</li>';
		}
		
		$html .= '</ul>';
		$html .= '</td>';
		$html .= '<td class="text-left">';
		$html .= '<ul class="liActions">';

		// Signed OFFER Letter
		if($offer->is_signed_offer_letter == 1){
			$html .= '<li id="signed_offer_'.$offer->form_id.'" class="tick">Offer Letter Signed</li>';

		}else{
			$html .= '<li id="signed_offer_'.$offer->form_id.'" class="cross">Offer Letter Signed</li>';

		}

		// Compelete FIF FORM

		if($offer->is_complete_fif_form == 1){
			$html .= '<li id="complete_fif_'.$offer->form_id.'" class="tick">FIF form Completed</li>';

		}else{
			$html .= '<li id="complete_fif_'.$offer->form_id.'" class="cross">FIF form Completed</li>';

		}

		// Compelete SIGNED Hand Book

		if($offer->is_signed_hand_book == 1){

			$html .= '<li id="signed_handbook_'.$offer->form_id.'" class="tick">Hand Book Signed</li>';

		}
		else{
			$html .= '<li id="signed_handbook_'.$offer->form_id.'" class="cross">Hand Book Signed</li>';

		}

		// Signed Pack Hand Over
		if($offer->offer_pack_handover == 1){
			$html .= '<li id="is_offer_pack_handover_'.$offer->form_id.'" class="tick">Offer Pack handedover</li>';
		}
		else{
			$html .= '<li id="is_offer_pack_handover_'.$offer->form_id.'" class="cross">Offer Pack handedover</li>';

		}
		
		
		
		$html .= '</ul>';
		$html .= '</td>';
		$html .= '<td class="text-center">';

		// Allocation
		if($offer->allocation == 0){
			$html .= '<img src="'.base_url().'components/gs_theme/images/allocationIcon.png" title="Allocation" width="25" data-toggle="tooltip" data-placement="top" /> &nbsp;';
		}
		else{
			$html .= '<img src="'.base_url().'components/gs_theme/images/allocationIcon_active.png" title="Allocation" width="25" data-toggle="tooltip" data-placement="top" /> &nbsp;';
		}


		// Communication
		if($offer->communication == 0){
			$html .= '<img src="'.base_url().'components/gs_theme/images/communicationIcon.png" title="Communication" width="23" data-toggle="tooltip" data-placement="top" /> &nbsp;';
		}
		else{

			$html .= '<img src="'.base_url().'components/gs_theme/images/communicationIcon_active.png" title="Communication" width="23" data-toggle="tooltip" data-placement="top" /> &nbsp;';

		}

		// Reminder

		if($offer->reminder == 0){

			$html .= '<img src="'.base_url().'components/gs_theme/images/ReminderIcon.png" title="Reminder" width="20" data-toggle="tooltip" data-placement="top" /> &nbsp;';

		}else{

			$html .= '<img src="'.base_url().'components/gs_theme/images/ReminderIcon_active.png" title="Reminder" width="20" data-toggle="tooltip" data-placement="top" /> &nbsp;';;

		}

		// Presene Icon

		if($offer->presence == 0){
			$html .= '<img src="'.base_url().'components/gs_theme/images/PresenceIcon.png" title="Presence" width="20" data-toggle="tooltip" data-placement="top" /> &nbsp;';
		}else{

			$html .= '<img src="'.base_url().'components/gs_theme/images/PresenceIcon_active.png" title="Presence" width="20" data-toggle="tooltip" data-placement="top" /> &nbsp;';
		}

		// FOLLOW UP ICON

		if($offer->followup == 0){

			$html .= '<img src="'.base_url().'components/gs_theme/images/FollowUpIcon.png" title="Follow Up" width="20" data-toggle="tooltip" data-placement="top" />';

		}
		else{

			$html .= '<img src="'.base_url().'components/gs_theme/images/FollowUpIcon_active.png" title="Follow Up" width="20" data-toggle="tooltip" data-placement="top" />';


		}
		$html .= '</td>';
		$html .= '<td class="actionArea">';
		$html .= '<a href="javascript:void(0)" class="hoverAction">Action <i class="fa fa-angle-down" aria-hidden="true"></i></a>';
		$html .= '<div class="actionItems">';
		$html .= '<ul>';
		$html .= '<li><a href="javascript:void(0)" data-toggle="modal" data-target="AddDetails" data-formid = '.$offer->form_id.' data-gf_id = '.$offer->gf_id.' id="AddDetail">Add Details</a></li>';
		if($offer->is_address == 1 && $offer->is_date_of_payment == 1 && $offer->is_concession_code == 1 && $offer->is_activiation_date == 1 && $offer->is_family_detail == 1){
			$offer_prepation_style = 'style="display:block"';
		}else{
			$offer_prepation_style = 'style="display:none"';
		}
		$html .= '<li '.$offer_prepation_style.' class="offer-preperation-hide"><a href="javascript:void(0)" data-toggle="modal" data-target="#OfferPreparation" data-formid='.$offer->form_id.' id="preperation">Offer Preparation</a></li>';

		if($offer->is_printed_offer_letter == 1 &&  $offer->is_printed_fif == 1 && $offer->is_printed_photo_token == 1 && $offer->is_handbook == 1 && $offer->is_printed_fee_bill == 1){
			$offer_submission_style = 'style="display:block"';
		}else{
			$offer_submission_style = 'style="display:none"';
		}
		$html .= '<li '.$offer_submission_style.' class="offer-submission-hide"><a href="javascript:void(0)" data-toggle="modal" data-target="#OfferSubmission" data-formid = "'.$offer->form_id.'" id="offer_submission">Offer Procedure</a></li>';
		//$html .= '<li><a href="#" data-toggle="modal" data-target="#PrintFeeBill">Print Fee Bill</a></li>';
		$html .= '</ul>';
		$html .= '</div>';
		$html .= '</td>';
		$html .= '</tr>';
		}
		$html .= '</tbody>';
		$html .= '</table>';

		$html .= '<script>';
        $html .= '$(document).ready(function() {
 				  $("#AdmissionFormListingg").dataTable();
				  });';
        $html .='</script>';
		echo $html;                        
                          
                      
	}

	// public function add_detail(){
	// 	$staff_child_formno = array();

	// 	$this->load->model('admission/offer_model','am');

	// 	$school_lists = $this->am->school_id();
	// 	$grade_lists = $this->am->grade_id();



	// 	$data['staff_forms'] = $this->am->get_Staff_FormIDs();
	// 	foreach ($data['staff_forms'] as $staff_form) {
	// 		array_push($staff_child_formno, $staff_form->form_id);
	// 	}
		

	// 	$form_id = $this->input->post('form_id');

	// 	$school_grade = $this->am->get_school_grade_name($form_id);

	// 	$DueDate = $this->am->get_dueDate($form_id);
	// 	$DueDate = $DueDate[0]->this_date;


	// 	$gf_id = $this->input->post('gf_id');

	// 	$discountPercentage = 0;
	// 	$discountCode = '';
	// 	if(in_array($form_id, $staff_child_formno)){
	// 		$discountCode = 'C(TC)';
	// 		$discountPercentage = 50;
	// 	}


	// 	// Concession Detail

	// 	$where_form = array(
	// 		'admission_form_id' => $form_id
	// 	);

	// 	$select = '';

	// 	$concession_detail = $this->am->get_by_all('atif_gs_admission.admission_form_offer',$select,$where_form);




	// 	// End Concession Detail

	// 	// GET Address From Family Registration

	// 	$where_adress = array(
	// 		'gf_id' => $gf_id
	// 	);

	// 	$select = '';

	// 	$address_detail = $this->am->get_by_all('atif_gs_admission.family_registration',$select,$where_adress);

	// 	$family_detail = $this->am->get_parent_detail($gf_id);
		

	// 	$father_qualification = '';
	// 	$father_profession = '';
	// 	$father_organization = '';
	// 	$father_department = '';
	// 	$father_phone = '';
	// 	$father_address = '';
	// 	$father_designation = '';

	// 	$mother_qualification = '';
	// 	$mother_profession = '';
	// 	$mother_department = '';
	// 	$mother_organization = '';
	// 	$mother_phone = '';
	// 	$mother_address = '';
	// 	$mother_designation = '';

	// 	if(!empty($family_detail)){
	// 		foreach($family_detail as $family){
	// 			if($family->parent_type == 1){
	// 				$father_qualification = $family->level;
	// 				$father_profession = $family->profession;
	// 				$father_department = $family->department;
	// 				$father_organization = $family->organization;
	// 				$father_phone = $family->phone;
	// 				$father_address = $family->address;
	// 				$father_designation = $family->designation;
	//  			}else if($family->parent_type == 2){
	//  				$mother_qualification = $family->level;
	// 				$mother_profession = $family->profession;
	// 				$mother_department = $family->department;
	// 				$mother_organization = $family->organization;
	// 				$mother_phone = $family->phone;
	// 				$mother_address = $family->address;
	// 				$mother_designation = $family->designation;
	//  			}
	// 		}
	// 	}

	// 	// FATHER  INFORMATION  FROM ATIF_GS_ADMISSION.ADMISSION_FAMILY

	// 	if($address_detail[0]->father_qualification != '' && !empty($address_detail)){
	// 		$father_qualification = $address_detail[0]->father_qualification;
	// 	}

	// 	if($address_detail[0]->father_occupation != '' && !empty($address_detail)){
	// 		$father_profession = $address_detail[0]->father_occupation;
	// 	}

	// 	if($address_detail[0]->father_department != '' && !empty($address_detail)){
	// 		$father_department = $address_detail[0]->father_department;
	// 	}

	// 	if($address_detail[0]->father_company != '' && !empty($address_detail)){
	// 		$father_organization = $address_detail[0]->father_company;
	// 	}

	// 	if($address_detail[0]->father_office_location != '' && !empty($address_detail)){
	// 		$father_address = $address_detail[0]->father_office_location;
	// 	}

	// 	if($address_detail[0]->father_work_phone != '' && !empty($address_detail)){
	// 		$father_phone = $address_detail[0]->father_work_phone;
	// 	}

	// 	if($address_detail[0]->father_designation != '' && !empty($address_detail)){
	// 		$father_designation = $address_detail[0]->father_designation;
	// 	}


	// 	// MOTHER  INFORMATION  FROM ATIF_GS_ADMISSION.ADMISSION_FAMILY

	// 	if($address_detail[0]->mother_qualification != '' && !empty($address_detail)){
	// 		$mother_qualification = $address_detail[0]->mother_qualification;
	// 	}

	// 	if($address_detail[0]->mother_occupation != '' && !empty($address_detail)){
	// 		$mother_profession = $address_detail[0]->mother_occupation;
	// 	}

	// 	if($address_detail[0]->mother_department != '' && !empty($address_detail)){
	// 		$mother_department = $address_detail[0]->mother_department;
	// 	}

	// 	if($address_detail[0]->mother_company != '' && !empty($address_detail)){
	// 		$mother_organization = $address_detail[0]->mother_company;
	// 	}

	// 	if($address_detail[0]->mother_office_location != '' && !empty($address_detail)){
	// 		$mother_phone = $address_detail[0]->mother_office_location;
	// 	}

	// 	if($address_detail[0]->mother_work_phone != '' && !empty($address_detail)){
	// 		$mother_address = $address_detail[0]->mother_work_phone;
	// 	}

	// 	if($address_detail[0]->mother_designation != '' && !empty($address_detail)){
	// 		$mother_designation = $address_detail[0]->mother_designation;
	// 	}

	// 	// End Family Address

	// 	$region = $this->am->get_by_all('atif._region');

	// 	// Applicant Name
	// 	$where_id = array(
	// 		'id' => $form_id
	// 	);

	// 	$select = '';
	// 	$admission_form = $this->am->get_by_all('atif_gs_admission.admission_form',$select,$where_id);
	// 	$applicant_name = $admission_form[0]->official_name;

	// 	$html = '';

	// 	$html .='<div class="modal-header">';
	// 	$html .='<button type="button" class="close floatClose" data-dismiss="modal">&times;</button>';
 //        $html .='<h4 class="modal-title">Applicant Details for - <strong>'.$applicant_name.'</strong></h4>';
 //        $html .='</div>';

	// 	$html .= '<div class="modal-body">';
	// 	$html .= '<div class="col-md-12" style="padding-bottom:0;">';
	// 	$html .= '<div class="MaroonBorderBox">';
	// 	$html .= '<div class="inner" style="">';
	// 	$html .= '<form id="address_form" method="POST" action="">';

	// 	$html .= '<input type="hidden" name="form_id" value="'.$form_id.'" />';
	// 	$html .= '<input type="hidden" name="gf_id" value="'.$gf_id.'" />';

	// 	if($admission_form[0]->grade_id == 1 || $admission_form[0]->grade_id == 17 || $admission_form[0]->grade_id == 2){
	// 		$previous_school_style = "style='display:none'";
	// 		$previous_school_disable = "disabled";
	// 	}else{
	// 		$previous_school_style = "style='display:block'";
	// 		$previous_school_disable = "";
	// 	}

	// 	$html .= '<div class="col-md-12 paddingBottom20" '.$previous_school_style.'">';
	// 	$html .= '<div class="col-md-3 text-right">Previous School & Grade*</div>';
	// 	$html .= '<div class="col-md-9">';

	// 	/* Grade */
	// 	$html .= '<div class="col-md-6">';
	// 	$html .= '<select name="previous_grade" '.$previous_school_disable.' required>';
	// 	if(!empty($school_grade[0]->grade_id)){
	// 		$html .= '<option value="'.$school_grade[0]->grade_id.'"  selected> '.$school_grade[0]->grade_name.' </option>';
	// 	}else{
	// 		$html .= '<option value="" disabled selected> Select Grade </option>';
	// 	}
	// 	foreach($grade_lists as $grade){
	// 		$html .= '<option value="'.$grade['Grade_id'].'">'.$grade['Grade_name'].'</option>';
	// 	}
	// 	$html .= '</select>';
	// 	$html .= '</div><!-- col-md-6 -->';


	// 	/*Previous School and Grade added*/
	// 	$html .= '<div class="col-md-6">';
	// 	$html .= '<select id="previous_school" name="previous_school" '.$previous_school_disable.' required>';
	// 	if(!empty($school_grade[0]->school_id)){
	// 		$html .= '<option value="'.$school_grade[0]->school_id.'"selected>'.$school_grade[0]->school_name.'</option>';
	// 	}else{
	// 		$html .= '<option value="" disabled selected>Select School</option>';
	// 	}
	// 	foreach($school_lists as $school){
	// 		$html .= '<option value="'.$school['School_id'].'">'.$school['School_name'].'</option>';
	// 	}
	// 	$html .= '<option value="52000">Other</option>';
	// 	$html .= '</select>';
	// 	$html .= '</div><!-- col-md-6 -->';
	// 	$html .= '<div class="col-md-6" id="otherSchools" style="display:none;" ><input type="text"  placeholder="School Name" name="other_school" id="other_school" '.$previous_school_disable.' required/></div>';

	// 	$html .= '</div>';
	// 	$html .= '</div>';
	// 	/* Previous School and grade added */

	// 	$html .= '<div class="col-md-12 paddingBottom20">';
	// 	$html .= '<div class="col-md-3 text-right">Address *</div>';
	// 	$html .= '<div class="col-md-9">';
	// 	$html .= '<div class="col-md-6 paddingBottom10">';
	// 	// Apartment No
	// 	if($address_detail[0]->home_apartment_no != '' ){
	// 	$html .= '<input  type="text" required placeholder="Apartment No / House No" name="apartment_no" value="'.$address_detail[0]->home_apartment_no.'" />';
	// 	}
	// 	else{
	// 	$html .= '<input type="text" required placeholder="Apartment No / House No" name="apartment_no"  />';
	// 	}
	// 	$html .= '</div><!-- col-md-6 -->';
	// 	$html .= '<div class="col-md-6 paddingBottom10">';

	// 	// Street Name
	// 	if($address_detail[0]->home_street_name != ''){
	// 	$html .= '<input type="text" placeholder="Street Name / Street No" name="street_name" value="'.$address_detail[0]->home_street_name.'"  />';
	// 	}
	// 	else{
	// 	$html .= '<input type="text" placeholder="Street Name / Street No" name="street_name"  />';
	// 	}
	// 	$html .= '</div>';
	// 	$html .= '<div class="col-md-6 paddingBottom10">';

	// 	// Building Name
	// 	if($address_detail[0]->home_building_name != ''){
	// 	$html .= '<input type="text" placeholder="Building name" name="building_name" value="'.$address_detail[0]->home_building_name.'" />';	
	// 	}else{
	// 	$html .= '<input type="text" placeholder="Building name" name="building_name" />';
	// 	}
	// 	$html .= '</div><!-- col-md-6 -->';
	// 	$html .= '<div class="col-md-6 paddingBottom10">';

	// 	// Plot No
	// 	if($address_detail[0]->home_plot_no != ''){
	// 	$html .= '<input type="text" placeholder="Plot No" name="plot_no" value="'.$address_detail[0]->home_plot_no.'" />';
	// 	}else{
	// 	$html .= '<input type="text" placeholder="Plot No" name="plot_no"/>';	
	// 	}
	// 	$html .= '</div><!-- col-md-6 -->';
	// 	$html .= '<div class="col-md-6 paddingBottom10">';
	// 	$html .= '<select  name="region" id="region" required>';
		

	// 	// Region
	// 	if($address_detail[0]->home_region != ''){
	// 	$html .= '<option value="'.$address_detail[0]->home_region.'" selected>'.$address_detail[0]->home_region.'</option>';

	// 	foreach($region as $region){
	// 	$html .= '<option data-id ="'.$region->id.'" value="'.$region->name.'">'.$region->name.'</option>';
	// 	}

	// 	}else{
	// 		$html .= '<option value="" disabled selected>Select Region</option>';
	// 		foreach($region as $region){
	// 		$html .= '<option data-id ="'.$region->id.'" value="'.$region->name.'">'.$region->name.'</option>';
	// 		}
	// 	}
	// 	$html .= '</select>';

	// 			// ============= Other Region=================//
	// 	$html .= '<input type="checkbox" id="checkbox1"/><label for="checkbox1">Others</label>';
	// 	$html .='<div class="autoUpdate" style="display:none;">
	// 		<input type="text" placeholder="Enter region" name="region_input" />
	// 	</div>';

	// 	//$html .= '<input type="text" placeholder="Region" name="region" />';
	// 	$html .= '</div><!-- col-md-6 -->';
	// 	$html .= '<div class="col-md-6 paddingBottom10">';
	// 	$html .= '<select name="sub-region" class="sub_region" id="sub_region"  >';
	// 	if($address_detail[0]->home_subregion != ''){

	// 		$html .= '<option value="'.$address_detail[0]->home_subregion.'">'.$address_detail[0]->home_subregion.'</option>';
	// 	}
		

	// 	//$html .= '<div class="sub_region"></div>';
	// 	//$html .= '<input type="text" placeholder="Sub region" name="sub_region" />';
	// 	$html .= '</select>';

	// 	//=============== Other Sub Region =================================//
	// 	$html .='<div class="autoUpdate" style="display:none;padding-top:22px">
	// 		<input type="text" placeholder="Enter Sub region"  name="sub_region_input" />
	// 	</div>';
	// 	$html .= '</div><!-- col-md-6 -->';
	// 	$html .= '</div><!-- col-md-9 -->';
	// 	$html .= '</div><!-- col-md-12 -->';
	// 	$html .= '<div class="col-md-12">';
	// 	$html .= ' <div class="col-md-3 text-right paddingTop10">Payment Window * </div><!-- col-md-3 -->';
	// 	$html .= '<div class="col-md-9">';
	// 	$html .= '<div class="col-md-12" style="padding:0 15px 0 15px;">';
	// 	// if(!empty($concession_detail)){
	// 	// 	if($concession_detail[0]->due_date != ''){
	// 	// 	$html .= '<input type="date" placeholder="dd/mm/yyyy" min="'.$admission_form[0]->offer_date.'" name="date_of_payment" value="'.$concession_detail[0]->due_date.'"  required/>';
	// 	// 	}else{
	// 	// 	$html .= '<input type="date" placeholder="dd/mm/yyyy"  name="date_of_payment" value="'.date("Y-m-j").'" required/>';
	// 	// 	}
	// 	// }else{
	// 	// 	$DueDate_Save = date("Y-m-d", strtotime($admission_form[0]->offer_date. ' + 5 weekday'));
	// 	// $html .= '<input type="date" placeholder="dd/mm/yyyy" name="date_of_payment" min="'.$admission_form[0]->offer_date.'" value="'.$DueDate_Save.'" required/>';
	// 	// }

	// 	$html .= '<input type="date" placeholder="dd/mm/yyyy" min="'.$admission_form[0]->offer_date.'" name="date_of_payment" value="'.$DueDate.'"  required/>';
	// 	$html .= '</div><!-- col-md-6 -->';
	// 	$html .= '</div><!-- col-md-9 -->';
	// 	$html .= '</div><!-- col-md-12 -->';
	// 	$html .= '<div class="col-md-12">';
	// 	$html .= '<div class="col-md-3 text-right paddingTop10">Concession Code <span class="required">*</span></div><!-- col-md-3 -->';
	// 	$html .= '<div class="col-md-9">';
	// 	$html .= '<div class="col-md-12" style="padding:0 15px 0 15px;">';
	// 	$html .= '<select  name="concession_code" required>';
	// 	if(!empty($concession_detail)){

	// 		if($concession_detail[0]->concession_code != ''){
	// 		//$html .= '<option value="'.$concession_detail[0]->concession_code.'">'.$concession_detail[0]->concession_code.'</option>';
	// 			if($concession_detail[0]->concession_code == '0'){
	// 				$html .= '<option value="'.$concession_detail[0]->concession_code.'" selected>No Discount</option>';

	// 			}else{
	// 				$html .= '<option value="'.$concession_detail[0]->concession_code.'">'.$concession_detail[0]->concession_code.'</option>';
	// 			}
	// 		$html .= '<option value="0">No Discount </option>';
	// 		$html .= '<option value="C(TC)">C(TC)</option>';
	// 		$html .= '<option value="C(NB)">C(NB)</option>';
	// 		$html .= '<option value="C(FF)">C(FF)</option>';
	// 		$html .= '<option value="C(SP)">C(SP)</option>';
	// 		$html .= '<option value="C(RR)">C(RR)</option>';
	// 		$html .= '<option value="C(OT)">C(OT)</option>';
	// 		$html .= '<option value="C(PR)">C(PR)</option>';	
	// 		}else{
	// 		$html .= '<option value="" disabled selected>Concession Code</option>';
	// 		$html .= '<option value="0">No Discount </option>';
	// 		if($discountCode==''){
	// 			$html .= '<option value="C(TC)">C(TC)</option>';
	// 		}else{
	// 			$html .= '<option value="C(TC)" selected>C(TC)</option>';
	// 		}
	// 		$html .= '<option value="C(NB)">C(NB)</option>';
	// 		$html .= '<option value="C(FF)">C(FF)</option>';
	// 		$html .= '<option value="C(SP)">C(SP)</option>';
	// 		$html .= '<option value="C(RR)">C(RR)</option>';
	// 		$html .= '<option value="C(OT)">C(OT)</option>';
	// 		$html .= '<option value="C(PR)">C(PR)</option>';	
	// 		}
	// 	}else{
	// 		$html .= '<option value="0">No Discount </option>';
	// 		$html .= '<option value="" disabled selected>Concession Code</option>';
	// 		if($discountCode==''){
	// 			$html .= '<option value="C(TC)">C(TC)</option>';
	// 		}else{
	// 			$html .= '<option value="C(TC)" selected>C(TC)</option>';
	// 		}
	// 		$html .= '<option value="C(NB)">C(NB)</option>';
	// 		$html .= '<option value="C(FF)">C(FF)</option>';
	// 		$html .= '<option value="C(SP)">C(SP)</option>';
	// 		$html .= '<option value="C(RR)">C(RR)</option>';
	// 		$html .= '<option value="C(OT)">C(OT)</option>';
	// 		$html .= '<option value="C(PR)">C(PR)</option>';
	// 	}

	// 	$html .= '</select>';
	// 	$html .= '</div><!-- col-md-6 -->';
	// 	$html .= '</div><!-- col-md-9 -->';
	// 	$html .= '</div><!-- col-md-12 -->';

	// 	$html .= '<div class="col-md-12">';
	// 	$html .= '<div class="col-md-3 text-right paddingTop10">Percentage </div><!-- col-md-3 -->';
	// 	$html .= '<div class="col-md-9">';
	// 	$html .= '<div class="col-md-12" style="padding:0 15px 0 15px;">';
	// 	if(!empty($concession_detail)){
	// 		if($concession_detail[0]->concession_perc != ''){
	// 		$html .= '<input type="number" placeholder="Enter Percentage" name="percentage" value="'.$concession_detail[0]->concession_perc.'" />';	
	// 		}
	// 		else{
	// 		$html .= '<input type="number" placeholder="Enter Percentage" name="percentage" value="'.$discountPercentage.'"/>';
	// 		}
	// 	}else{
	// 		$html .= '<input type="number" placeholder="Enter Percentage" name="percentage" value="'.$discountPercentage.'"/>';
	// 	}
		
	// 	$html .= '</div><!-- col-md-6 -->';
	// 	$html .= '</div><!-- col-md-9 -->';
	// 	$html .= '</div><!-- col-md-12 -->';

	// 	$html .= '<div class="col-md-12">';
	// 	$html .= '<div class="col-md-3 text-right paddingTop10">Activation/Joining Date *</div><!-- col-md-3 -->';
	// 	$html .= '<div class="col-md-9">';
	// 	$html .= '<div class="col-md-12" style="padding:0 15px 0 15px;">';
	// 	// var_dump($concession_detail);
	// 	if(!empty($concession_detail)){
	// 	if($concession_detail[0]->joining_date != ''){
	// 		$html .= '<input type="date" placeholder="dd/mm/yyyy" name="activation_date" value="'.$concession_detail[0]->joining_date.'"  required/>';	
	// 		}else{
	// 		$html .= '<input type="date" placeholder="dd/mm/yyyy" name="activation_date"  required/>';
	// 		}
	// 	}
	// 	else{
	// 	$html .= '<input type="date" placeholder="dd/mm/yyyy" name="activation_date"  required/>';	
	// 	}
		
	// 	$html .= '</div><!-- col-md-6 -->';
	// 	$html .= '</div><!-- col-md-9 -->';
	// 	$html .= '</div><!-- col-md-12 -->';
	// 	$html .= '<hr />';
	// 	/* Father Mother Details Form */
	// 	$html .= '<div class="col-md-12">';
	// 	$html .= '<div class="col-md-5"><h4 class="text-center">Father</h4></div><div class="col-md-2"></div><div class="col-md-5"><h4 class="text-center">Mother</h4></div>';
	// 	$html .= '</div><!-- col-md-12 -->';
	// 	$html .= '<div class="col-md-12">';
	// 	if($father_qualification != ''){
	// 		$html .= '<div class="col-md-5"><input type="text"  placeholder="Final Academic Qualification"  required name="father_qualification" value="'.$father_qualification.'"/></div>';
	// 	}else{
	// 		$html .= '<div class="col-md-5"><input type="text"  placeholder="Final Academic Qualification"  required name="father_qualification"/></div>';
	// 	}
		
	// 	$html .= '<div class="col-md-2 text-center">Final Academic Qualification</div>';
	// 	if($mother_qualification != ''){
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Final Academic Qualification" required  name="mother_qualification" value="'.$mother_qualification.'"/></div>';
	// 	}else{
	// 		$html .= '<div class="col-md-5"><input type="text"  placeholder="Final Academic Qualification" required  name="mother_qualification"/></div>';
	// 	}
	// 	$html .= '</div><!-- col-md-12 -->';
	// 	$html .= '<div class="col-md-12">';
	// 	if($father_profession != ''){
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Profession"  required name="father_profession" value="'.$father_profession.'"/></div>';
	// 	}else{
	// 		$html .= '<div class="col-md-5"><input type="text"  placeholder="Profession"  required name="father_profession"/></div>';
	// 	}

	// 	$html .= '<div class="col-md-2 text-center">Profession</div>';
	// 	if($mother_profession != ''){
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Profession"  required name="mother_profession" value="'.$mother_profession.'"/></div>';
	// 	}else{
	// 		$html .= '<div class="col-md-5"><input type="text"  placeholder="Profession"  required name="mother_profession"/></div>';
	// 	}	
	// 	$html .= '</div><!-- col-md-12 -->';

	// 	$html .= '<div class="col-md-12">';

	// 	if($father_designation != ''){
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="designation"  required name="father_designation" value="'.$father_designation.'"/></div>';
	// 	}else{
	// 		$html .= '<div class="col-md-5"><input type="text"  placeholder="designation"  required name="father_designation"/></div>';
	// 	}

	// 	$html .= '<div class="col-md-2 text-center">Designation</div>';

	// 	if($mother_designation != ''){
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Designation" required name="mother_designation" value="'.$mother_designation.'"/></div>';
	// 	}else{
	// 		$html .= '<div class="col-md-5"><input type="text"  placeholder="Designation" required name="mother_designation"/></div>';
	// 	}
	// 	$html .= '</div><!-- col-md-12 -->';

	// 	$html .= '<div class="col-md-12">';

	// 	if($father_department != ''){
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Department"  required name="father_department" value="'.$father_department.'"/></div>';
	// 	}else{
	// 		$html .= '<div class="col-md-5"><input type="text"  placeholder="Department"  required name="father_department"/></div>';
	// 	}

	// 	$html .= '<div class="col-md-2 text-center">Department</div>';

	// 	if($mother_department != ''){
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Department" required name="mother_department" value="'.$mother_department.'"/></div>';
	// 	}else{
	// 		$html .= '<div class="col-md-5"><input type="text"  placeholder="Department" required name="mother_department"/></div>';
	// 	}
	// 	$html .= '</div><!-- col-md-12 -->';





	// 	$html .= '<div class="col-md-12">';

	// 	if($father_organization != ''){
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Organization" required name="father_organization" value="'.$father_organization.'" /></div>';
	// 	}else{
	// 		$html .= '<div class="col-md-5"><input type="text"  placeholder="Organization" required name="father_organization" /></div>';
	// 	}
	// 	$html .= '<div class="col-md-2 text-center">Organization</div>';

	// 	if($mother_organization != ''){
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Organization" required name="mother_organization" value="
	// 	'.$mother_organization.'"/></div>';
	// 	}else{
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Organization" required name="mother_organization"/></div>';

	// 	}

	// 	$html .= '</div><!-- col-md-12 -->';
	// 	$html .= '<div class="col-md-12">';
	// 	if($father_address != ''){
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Address" required name="father_officeAddress" value="'.$father_address.'"/></div>';
	// 	}else{
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Address" required name="father_officeAddress"/></div>';
	// 	}

	// 	$html .= '<div class="col-md-2 text-center">Office Address</div>';
	// 	if($mother_address  != ''){
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Address" required name="mother_officeAddress" value="'.$mother_address.'"/></div>';
	// 	}else{
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Address" required name="mother_officeAddress"/></div>';
	// 	}
	// 	$html .= '</div><!-- col-md-12 -->';
	// 	$html .= '<div class="col-md-12">';

	// 	if($father_phone != '' ){
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Phone" required name="father_officePhoneNumber" value="'.$father_phone.'"/></div>';
	// 	}else{
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Phone" required name="father_officePhoneNumber"/></div>';

	// 	}
	// 	$html .= '<div class="col-md-2 text-center">Office Phone</div>';
	// 	if($mother_phone != ''){
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Phone" required name="mother_officePhoneNumber" value="'.$mother_phone.'"/></div>';
	// 	}else{
	// 	$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Phone" required name="mother_officePhoneNumber"/></div>';
	// 	}
	// 	$html .= '</div><!-- col-md-12 -->';
	// 	/* Father mother Details End */
	// 	$html .= '<hr />';
	// 	$html .= '<div class="col-md-12" style="padding-bottom:0;">';
	// 	$html .= '<div class="col-md-3">&nbsp;</div>';
	// 	$html .= '<div class="col-md-9">';
	// 	$html .= '<div class="col-md-5">';
	// 	$html .= '<input type="submit" class="greenBTN" value="Submit" id="adress_submit" />';
	// 	$html .= '</div><!-- col-md-2 -->';
	// 	$html .= '</div><!-- col-md-9 -->';
	// 	$html .= '</div><!-- col-md-12 -->';
	// 	$html .= '</div>';
	// 	$html .= '</div><!-- inner -->';
	// 	$html .= '</div><!-- .MaroonBorderBox -->';
	// 	$html .= '</div><!-- col-md-12 -->';

	// 	$html .= '<script>$(document).ready(function(){
	// 	if($("#address_form").length){

	// 		$("#address_form").validate({
	// 			rules:{
	// 				date_of_payment:{
	// 					required:true
	// 				},

	// 				activation_date:{
	// 					required:true
	// 				}
	// 			},
	// 			    submitHandler: function (form) {
	// 			    $("#Generations_AjaxLoader").show();
	// 			    $(form).ajaxSubmit({
 //                        type: "POST",
 //                        url:"'.base_url("index.php/gs_admission/Admission_offer_approve_ajax/insert_address_concession").'",
 //                        success: function (data) {

 //                        	var form_id = $("input[name=form_id]").val();
 //                        	$.ajax({
 //                        		type:"POST",
 //                        		cache:false,
 //                        		data:{form_id:form_id},
 //                        		url:"'.base_url().'index.php/gs_admission/Admission_offer_approve_ajax/get_detail_of_form",
 //                        		success:function(e){
 //                        			var jsonData = JSON.parse(e);
 //                        			for(var i = 0 ; i < jsonData.length; i++){

 //                        				var is_address = jsonData[i].is_address;
 //                        				var is_date_of_payment = jsonData[i].is_date_of_payment;
 //                        				var is_concession_code = jsonData[i].is_concession_code;
 //                        				var is_activiation_date = jsonData[i].is_activiation_date;
 //                        				var payment_due_date = jsonData[i].payment_due_date;
 //                        				var is_family_detail = jsonData[i].is_family_detail;
 //                        				var is_previous_school_grade = jsonData[i].is_previous_school_grade;

 //                        				// Address
 //                        				if(is_address == 0){
	// 									$(".liActions #address_"+form_id).removeClass("tick");
	// 									$(".liActions #address_"+form_id).addClass("cross");

	// 									}else{
	// 									$(".liActions #address_"+form_id).removeClass("cross");
	// 									$(".liActions #address_"+form_id).addClass("tick");
	// 									}


	// 									// Date Of Payment
										
	// 									if(is_date_of_payment == 1){

	// 									$(".liActions #date_of_payment_"+form_id).removeClass("cross");
	// 									$(".liActions #date_of_payment_"+form_id).addClass("tick");
											
	// 									}else{
	// 									$(".liActions #date_of_payment_"+form_id).removeClass("tick");
	// 									$(".liActions #date_of_payment_"+form_id).addClass("cross");	

	// 									}

	// 									// Concession Code
										
	// 									if(is_concession_code == 1){
	// 									$(".liActions #concession_code_"+form_id).removeClass("cross");
	// 									$(".liActions #concession_code_"+form_id).addClass("tick");
										

	// 									}else{
											
	// 									$(".liActions #concession_code_"+form_id).removeClass("tick");
	// 									$(".liActions #concession_code_"+form_id).addClass("cross");
	// 									}

	// 									// Activation Date

	// 									if(is_activiation_date == 1){
	// 									$(".liActions #activation_date_"+form_id).removeClass("cross");
	// 									$(".liActions #activation_date_"+form_id).addClass("tick");
	// 									}
	// 									else{
	// 									$(".liActions #activation_date_"+form_id).removeClass("tick");
	// 									$(".liActions #activation_date_"+form_id).addClass("cross");

	// 									}

	// 									// Family Detail

	// 									if(is_family_detail == 1){
	// 									$(".liActions #family_detail_"+form_id).removeClass("cross");
	// 									$(".liActions #family_detail_"+form_id).addClass("tick");
	// 									}
	// 									else{
	// 									$(".liActions #family_detail_"+form_id).removeClass("tick");
	// 									$(".liActions #family_detail_"+form_id).addClass("cross");

	// 									}



	// 									// Previous School Grade

	// 									if(is_previous_school_grade == 1){
	// 									$(".liActions #previous_school_grade_"+form_id).removeClass("cross");
	// 									$(".liActions #previous_school_grade_"+form_id).addClass("tick");
	// 									}
	// 									else{
	// 									$(".liActions #previous_school_grade_"+form_id).removeClass("tick");
	// 									$(".liActions #previous_school_grade_"+form_id).addClass("cross");

	// 									}

	// 									// Payement Due Date 

	// 									if(payment_due_date != ""){

	// 									$("#due_date_"+form_id).text(payment_due_date)

	// 									}
	// 									$(".offer-preperation-hide").show();
	// 									$("#AddDetails").modal("hide");

	// 									$("#Generations_AjaxLoader").hide();
                        				
 //                        			}
 //                        		}
 //                        	});
 //                        }
 //                    })	


 //                        }
 //                    });
 //                }

	// 		});';

	// 	$html .= '</script>';


	// 	echo $html ;   
	// }


		public function add_detail(){
		$staff_child_formno = array();

		$this->load->model('admission/offer_model','am');

		$school_lists = $this->am->school_id();
		$grade_lists = $this->am->grade_id();



		$data['staff_forms'] = $this->am->get_Staff_FormIDs();
		foreach ($data['staff_forms'] as $staff_form) {
			array_push($staff_child_formno, $staff_form->form_id);
		}
		

		$form_id = $this->input->post('form_id');

		$school_grade = $this->am->get_school_grade_name($form_id);

		$DueDate = $this->am->get_dueDate($form_id);
		$DueDate = $DueDate[0]->this_date;


		$gf_id = $this->input->post('gf_id');

		$discountPercentage = 0;
		$discountCode = '';
		if(in_array($form_id, $staff_child_formno)){
			$discountCode = 'C(TC)';
			$discountPercentage = 50;
		}


		// Concession Detail

		$where_form = array(
			'admission_form_id' => $form_id
		);

		$select = '';

		$concession_detail = $this->am->get_by_all('atif_gs_admission.admission_form_offer',$select,$where_form);




		// End Concession Detail

		// GET Address From Family Registration

		$where_adress = array(
			'gf_id' => $gf_id
		);

		$select = '';

		$address_detail = $this->am->get_by_all('atif_gs_admission.family_registration',$select,$where_adress);

		$family_detail = $this->am->get_parent_detail($gf_id);
		

		$father_qualification = '';
		$father_profession = '';
		$father_organization = '';
		$father_department = '';
		$father_phone = '';
		$father_address = '';
		$father_designation = '';

		$mother_qualification = '';
		$mother_profession = '';
		$mother_department = '';
		$mother_organization = '';
		$mother_phone = '';
		$mother_address = '';
		$mother_designation = '';

		if(!empty($family_detail)){
			foreach($family_detail as $family){
				if($family->parent_type == 1){
					$father_qualification = $family->level;
					$father_profession = $family->profession;
					$father_department = $family->department;
					$father_organization = $family->organization;
					$father_phone = $family->phone;
					$father_address = $family->address;
					$father_designation = $family->designation;
	 			}else if($family->parent_type == 2){
	 				$mother_qualification = $family->level;
					$mother_profession = $family->profession;
					$mother_department = $family->department;
					$mother_organization = $family->organization;
					$mother_phone = $family->phone;
					$mother_address = $family->address;
					$mother_designation = $family->designation;
	 			}
			}
		}

		// FATHER  INFORMATION  FROM ATIF_GS_ADMISSION.ADMISSION_FAMILY

		if($address_detail[0]->father_qualification != '' && !empty($address_detail)){
			$father_qualification = $address_detail[0]->father_qualification;
		}

		if($address_detail[0]->father_occupation != '' && !empty($address_detail)){
			$father_profession = $address_detail[0]->father_occupation;
		}

		if($address_detail[0]->father_department != '' && !empty($address_detail)){
			$father_department = $address_detail[0]->father_department;
		}

		if($address_detail[0]->father_company != '' && !empty($address_detail)){
			$father_organization = $address_detail[0]->father_company;
		}

		if($address_detail[0]->father_office_location != '' && !empty($address_detail)){
			$father_address = $address_detail[0]->father_office_location;
		}

		if($address_detail[0]->father_work_phone != '' && !empty($address_detail)){
			$father_phone = $address_detail[0]->father_work_phone;
		}

		if($address_detail[0]->father_designation != '' && !empty($address_detail)){
			$father_designation = $address_detail[0]->father_designation;
		}


		// MOTHER  INFORMATION  FROM ATIF_GS_ADMISSION.ADMISSION_FAMILY

		if($address_detail[0]->mother_qualification != '' && !empty($address_detail)){
			$mother_qualification = $address_detail[0]->mother_qualification;
		}

		if($address_detail[0]->mother_occupation != '' && !empty($address_detail)){
			$mother_profession = $address_detail[0]->mother_occupation;
		}

		if($address_detail[0]->mother_department != '' && !empty($address_detail)){
			$mother_department = $address_detail[0]->mother_department;
		}

		if($address_detail[0]->mother_company != '' && !empty($address_detail)){
			$mother_organization = $address_detail[0]->mother_company;
		}

		if($address_detail[0]->mother_office_location != '' && !empty($address_detail)){
			$mother_phone = $address_detail[0]->mother_office_location;
		}

		if($address_detail[0]->mother_work_phone != '' && !empty($address_detail)){
			$mother_address = $address_detail[0]->mother_work_phone;
		}

		if($address_detail[0]->mother_designation != '' && !empty($address_detail)){
			$mother_designation = $address_detail[0]->mother_designation;
		}

		// End Family Address

		$region = $this->am->get_by_all('atif._region');

		// Applicant Name
		$where_id = array(
			'id' => $form_id
		);

		$select = '';
		$admission_form = $this->am->get_by_all('atif_gs_admission.admission_form',$select,$where_id);
		$applicant_name = $admission_form[0]->official_name;

		$html = '';

		$html .='<div class="modal-header">';
		$html .='<button type="button" class="close floatClose" data-dismiss="modal">&times;</button>';
        $html .='<h4 class="modal-title">Applicant Details for - <strong>'.$applicant_name.'</strong></h4>';
        $html .='</div>';

		$html .= '<div class="modal-body">';
		$html .= '<div class="col-md-12" style="padding-bottom:0;">';
		$html .= '<div class="MaroonBorderBox">';
		$html .= '<div class="inner" style="">';
		$html .= '<form id="address_form" method="POST" action="">';

		$html .= '<input type="hidden" name="form_id" value="'.$form_id.'" />';
		$html .= '<input type="hidden" name="gf_id" value="'.$gf_id.'" />';

		if($admission_form[0]->grade_id == 1 || $admission_form[0]->grade_id == 17 || $admission_form[0]->grade_id == 2){
			$previous_school_style = "style='display:none'";
			$previous_school_disable = "disabled";
		}else{
			$previous_school_style = "style='display:block'";
			$previous_school_disable = "";
		}

		$html .= '<div class="col-md-12 paddingBottom20" '.$previous_school_style.'">';
		$html .= '<div class="col-md-3 text-right">Previous School & Grade*</div>';
		$html .= '<div class="col-md-9">';

		/* Grade */
		$html .= '<div class="col-md-6">';
		$html .= '<select name="previous_grade" '.$previous_school_disable.' required>';
		if(!empty($school_grade[0]->grade_id)){
			$html .= '<option value="'.$school_grade[0]->grade_id.'"  selected> '.$school_grade[0]->grade_name.' </option>';
		}else{
			$html .= '<option value="" disabled selected> Select Grade </option>';
		}
		foreach($grade_lists as $grade){
			$html .= '<option value="'.$grade['Grade_id'].'">'.$grade['Grade_name'].'</option>';
		}
		$html .= '</select>';
		$html .= '</div><!-- col-md-6 -->';


		/*Previous School and Grade added*/
		$html .= '<div class="col-md-6">';
		$html .= '<select id="previous_school" name="previous_school" '.$previous_school_disable.' required>';
		if(!empty($school_grade[0]->school_id)){
			$html .= '<option value="'.$school_grade[0]->school_id.'"selected>'.$school_grade[0]->school_name.'</option>';
		}else{
			$html .= '<option value="" disabled selected>Select School</option>';
		}
		foreach($school_lists as $school){
			$html .= '<option value="'.$school['School_id'].'">'.$school['School_name'].'</option>';
		}
		$html .= '<option value="52000">Other</option>';
		$html .= '</select>';
		$html .= '</div><!-- col-md-6 -->';
		$html .= '<div class="col-md-6" id="otherSchools" style="display:none;" ><input type="text"  placeholder="School Name" name="other_school" id="other_school" '.$previous_school_disable.' required/></div>';

		$html .= '</div>';
		$html .= '</div>';
		/* Previous School and grade added */

		$html .= '<div class="col-md-12 paddingBottom20">';
		$html .= '<div class="col-md-3 text-right">Address *</div>';
		$html .= '<div class="col-md-9">';
		$html .= '<div class="col-md-6 paddingBottom10">';
		// Apartment No
		if($address_detail[0]->home_apartment_no != '' ){
		$html .= '<input  type="text" required placeholder="Apartment No / House No" name="apartment_no" value="'.$address_detail[0]->home_apartment_no.'" />';
		}
		else{
		$html .= '<input type="text" required placeholder="Apartment No / House No" name="apartment_no"  />';
		}
		$html .= '</div><!-- col-md-6 -->';
		$html .= '<div class="col-md-6 paddingBottom10">';

		// Street Name
		if($address_detail[0]->home_street_name != ''){
		$html .= '<input type="text" placeholder="Street Name / Street No" name="street_name" value="'.$address_detail[0]->home_street_name.'"  />';
		}
		else{
		$html .= '<input type="text" placeholder="Street Name / Street No" name="street_name"  />';
		}
		$html .= '</div>';
		$html .= '<div class="col-md-6 paddingBottom10">';

		// Building Name
		if($address_detail[0]->home_building_name != ''){
		$html .= '<input type="text" placeholder="Building name" name="building_name" value="'.$address_detail[0]->home_building_name.'" />';	
		}else{
		$html .= '<input type="text" placeholder="Building name" name="building_name" />';
		}
		$html .= '</div><!-- col-md-6 -->';
		$html .= '<div class="col-md-6 paddingBottom10">';

		// Plot No
		if($address_detail[0]->home_plot_no != ''){
		$html .= '<input type="text" placeholder="Plot No" name="plot_no" value="'.$address_detail[0]->home_plot_no.'" />';
		}else{
		$html .= '<input type="text" placeholder="Plot No" name="plot_no"/>';	
		}
		$html .= '</div><!-- col-md-6 -->';
		$html .= '<div class="col-md-6 paddingBottom10">';
		$html .= '<select  name="region" id="region" required>';
		

		// Region
		if($address_detail[0]->home_region != ''){
		$html .= '<option value="'.$address_detail[0]->home_region.'" selected>'.$address_detail[0]->home_region.'</option>';

		foreach($region as $region){
		$html .= '<option data-id ="'.$region->id.'" value="'.$region->name.'">'.$region->name.'</option>';
		}

		}else{
			$html .= '<option value="" disabled selected>Select Region</option>';
			foreach($region as $region){
			$html .= '<option data-id ="'.$region->id.'" value="'.$region->name.'">'.$region->name.'</option>';
			}
		}
		$html .= '</select>';

				// ============= Other Region=================//
		$html .= '<input type="checkbox" id="checkbox1"/><label for="checkbox1">Others</label>';
		$html .='<div class="autoUpdate" style="display:none;">
			<input type="text" placeholder="Enter region" name="region_input" />
		</div>';

		//$html .= '<input type="text" placeholder="Region" name="region" />';
		$html .= '</div><!-- col-md-6 -->';
		$html .= '<div class="col-md-6 paddingBottom10">';
		$html .= '<select name="sub-region" class="sub_region" id="sub_region"  >';
		if($address_detail[0]->home_subregion != ''){

			$html .= '<option value="'.$address_detail[0]->home_subregion.'">'.$address_detail[0]->home_subregion.'</option>';
		}
		

		//$html .= '<div class="sub_region"></div>';
		//$html .= '<input type="text" placeholder="Sub region" name="sub_region" />';
		$html .= '</select>';

		//=============== Other Sub Region =================================//
		$html .='<div class="autoUpdate" style="display:none;padding-top:22px">
			<input type="text" placeholder="Enter Sub region"  name="sub_region_input" />
		</div>';
		$html .= '</div><!-- col-md-6 -->';
		$html .= '</div><!-- col-md-9 -->';
		$html .= '</div><!-- col-md-12 -->';
		$html .= '<div class="col-md-12">';
		$html .= ' <div class="col-md-3 text-right paddingTop10">Payment Window * </div><!-- col-md-3 -->';
		$html .= '<div class="col-md-9">';
		$html .= '<div class="col-md-12" style="padding:0 15px 0 15px;">';
		// if(!empty($concession_detail)){
		// 	if($concession_detail[0]->due_date != ''){
		// 	$html .= '<input type="date" placeholder="dd/mm/yyyy" min="'.$admission_form[0]->offer_date.'" name="date_of_payment" value="'.$concession_detail[0]->due_date.'"  required/>';
		// 	}else{
		// 	$html .= '<input type="date" placeholder="dd/mm/yyyy"  name="date_of_payment" value="'.date("Y-m-j").'" required/>';
		// 	}
		// }else{
		// 	$DueDate_Save = date("Y-m-d", strtotime($admission_form[0]->offer_date. ' + 5 weekday'));
		// $html .= '<input type="date" placeholder="dd/mm/yyyy" name="date_of_payment" min="'.$admission_form[0]->offer_date.'" value="'.$DueDate_Save.'" required/>';
		// }

		$html .= '<input type="date" placeholder="dd/mm/yyyy" min="'.$admission_form[0]->offer_date.'" name="date_of_payment" value="'.$DueDate.'"  required/>';
		$html .= '</div><!-- col-md-6 -->';
		$html .= '</div><!-- col-md-9 -->';
		$html .= '</div><!-- col-md-12 -->';
		$html .= '<div class="col-md-12">';
		$html .= '<div class="col-md-3 text-right paddingTop10">Concession Code <span class="required">*</span></div><!-- col-md-3 -->';
		$html .= '<div class="col-md-9">';
		$html .= '<div class="col-md-12" style="padding:0 15px 0 15px;">';
		$html .= '<select  name="concession_code" required>';
		if(!empty($concession_detail)){

			if($concession_detail[0]->concession_code != ''){
			//$html .= '<option value="'.$concession_detail[0]->concession_code.'">'.$concession_detail[0]->concession_code.'</option>';
				if($concession_detail[0]->concession_code == '0'){
					$html .= '<option value="'.$concession_detail[0]->concession_code.'" selected>No Discount</option>';

				}else{
					$html .= '<option value="'.$concession_detail[0]->concession_code.'">'.$concession_detail[0]->concession_code.'</option>';
				}
			$html .= '<option value="0">No Discount </option>';
			$html .= '<option value="C(TC)">C(TC)</option>';
			$html .= '<option value="C(NB)">C(NB)</option>';
			$html .= '<option value="C(FF)">C(FF)</option>';
			$html .= '<option value="C(SP)">C(SP)</option>';
			$html .= '<option value="C(RR)">C(RR)</option>';
			$html .= '<option value="C(OT)">C(OT)</option>';
			$html .= '<option value="C(PR)">C(PR)</option>';	
			}else{
			$html .= '<option value="" disabled selected>Concession Code</option>';
			$html .= '<option value="0">No Discount </option>';
			if($discountCode==''){
				$html .= '<option value="C(TC)">C(TC)</option>';
			}else{
				$html .= '<option value="C(TC)" selected>C(TC)</option>';
			}
			$html .= '<option value="C(NB)">C(NB)</option>';
			$html .= '<option value="C(FF)">C(FF)</option>';
			$html .= '<option value="C(SP)">C(SP)</option>';
			$html .= '<option value="C(RR)">C(RR)</option>';
			$html .= '<option value="C(OT)">C(OT)</option>';
			$html .= '<option value="C(PR)">C(PR)</option>';	
			}
		}else{
			$html .= '<option value="0">No Discount </option>';
			$html .= '<option value="" disabled selected>Concession Code</option>';
			if($discountCode==''){
				$html .= '<option value="C(TC)">C(TC)</option>';
			}else{
				$html .= '<option value="C(TC)" selected>C(TC)</option>';
			}
			$html .= '<option value="C(NB)">C(NB)</option>';
			$html .= '<option value="C(FF)">C(FF)</option>';
			$html .= '<option value="C(SP)">C(SP)</option>';
			$html .= '<option value="C(RR)">C(RR)</option>';
			$html .= '<option value="C(OT)">C(OT)</option>';
			$html .= '<option value="C(PR)">C(PR)</option>';
		}

		$html .= '</select>';
		$html .= '</div><!-- col-md-6 -->';
		$html .= '</div><!-- col-md-9 -->';
		$html .= '</div><!-- col-md-12 -->';

		$html .= '<div class="col-md-12">';
		$html .= '<div class="col-md-3 text-right paddingTop10">Percentage </div><!-- col-md-3 -->';
		$html .= '<div class="col-md-9">';
		$html .= '<div class="col-md-12" style="padding:0 15px 0 15px;">';
		if(!empty($concession_detail)){
			if($concession_detail[0]->concession_perc != ''){
			$html .= '<input type="number" placeholder="Enter Percentage" name="percentage" value="'.$concession_detail[0]->concession_perc.'" />';	
			}
			else{
			$html .= '<input type="number" placeholder="Enter Percentage" name="percentage" value="'.$discountPercentage.'"/>';
			}
		}else{
			$html .= '<input type="number" placeholder="Enter Percentage" name="percentage" value="'.$discountPercentage.'"/>';
		}
		
		$html .= '</div><!-- col-md-6 -->';
		$html .= '</div><!-- col-md-9 -->';
		$html .= '</div><!-- col-md-12 -->';

		if($admission_form[0]->grade_id == 15 || $admission_form[0]->grade_id == 16){
		$html .= '<div class="col-md-12">';
		$html .= '<div class="col-md-3 text-right paddingTop10">Scholarship Academic </div>';
		$html .= '<div class="col-md-9">';
		$html .= '<div class="col-md-12" style="padding:0 15px 0 15px;">';
		if($concession_detail[0]->scholarship_ac != 0 && $concession_detail[0]){

		$html .= '<input type="number" name="scholarshipAcademic" value="'.$concession_detail[0]->scholarship_ac.'">';
		}else{
			$html .= '<input type="number" name="scholarshipAcademic">';
		}
		$html .= '</div><!-- col-md-6 -->';
		$html .= '</div><!-- col-md-9 -->';
		$html .= '</div><!-- col-md-12 -->';

		

		$html .= '<div class="col-md-12">';
		$html .= '<div class="col-md-3 text-right paddingTop10">Scholarship Non-Academic </div><!-- col-md-3 -->';
		$html .= '<div class="col-md-9">';
		$html .= '<div class="col-md-12" style="padding:0 15px 0 15px;">';
		if($concession_detail[0]->scholarship_nac != 0 && $concession_detail[0]){

		$html .= '<input type="number" name="scholarshipNonAcademic" value="'.$concession_detail[0]->scholarship_nac.'">';
		}else{
			$html .= '<input type="number" name="scholarshipNonAcademic">';
		}
		//$html .= '<input type="number" name="scholarshipNonAcademic">';
		$html .= '</div><!-- col-md-6 -->';
		$html .= '</div><!-- col-md-9 -->';
		$html .= '</div><!-- col-md-12 -->';

		$html .= '<div class="col-md-12">';
		$html .= '<div class="col-md-3 text-right paddingTop10">Admission Fee Waiver (50%) </div><!-- col-md-3 -->';
		$html .= '<div class="col-md-9">';

		$html .= '<div class="col-md-12" style="padding:0 15px 0 15px;">';
		if( $concession_detail[0]->admission_fee_waiver == 0 ){
$html .= '<input type="checkbox" name="admission_fee_waiver"  id="admission_fee_waiver" style="display:block;" />';
		}else{
			$html .= '<input type="checkbox" name="admission_fee_waiver" id="admission_fee_waiver" style="display:block;"checked />';
		}
		


		$html .= '</div><!-- col-md-6 -->';
		$html .= '</div><!-- col-md-9 -->';
		$html .= '</div><!-- col-md-12 -->';

		}

		$html .= '<div class="col-md-12">';
		$html .= '<div class="col-md-3 text-right paddingTop10">Activation/Joining Date *</div><!-- col-md-3 -->';
		$html .= '<div class="col-md-9">';	
		$html .= '<div class="col-md-12" style="padding:0 15px 0 15px;">';
		// var_dump($concession_detail);
		if(!empty($concession_detail)){
		if($concession_detail[0]->joining_date != ''){
			$html .= '<input type="date" placeholder="dd/mm/yyyy" name="activation_date" value="'.$concession_detail[0]->joining_date.'"  required/>';	
			}else{
			$html .= '<input type="date" placeholder="dd/mm/yyyy" name="activation_date"  required/>';
			}
		}
		else{
		$html .= '<input type="date" placeholder="dd/mm/yyyy" name="activation_date"  required/>';	
		}
		
		$html .= '</div><!-- col-md-6 -->';
		$html .= '</div><!-- col-md-9 -->';
		$html .= '</div><!-- col-md-12 -->';
		$html .= '<hr />';
		/* Father Mother Details Form */
		$html .= '<div class="col-md-12">';
		$html .= '<div class="col-md-5"><h4 class="text-center">Father</h4></div><div class="col-md-2"></div><div class="col-md-5"><h4 class="text-center">Mother</h4></div>';
		$html .= '</div><!-- col-md-12 -->';
		$html .= '<div class="col-md-12">';
		if($father_qualification != ''){
			$html .= '<div class="col-md-5"><input type="text"  placeholder="Final Academic Qualification"  required name="father_qualification" value="'.$father_qualification.'"/></div>';
		}else{
			$html .= '<div class="col-md-5"><input type="text"  placeholder="Final Academic Qualification"  required name="father_qualification"/></div>';
		}
		
		$html .= '<div class="col-md-2 text-center">Final Academic Qualification</div>';
		if($mother_qualification != ''){
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Final Academic Qualification" required  name="mother_qualification" value="'.$mother_qualification.'"/></div>';
		}else{
			$html .= '<div class="col-md-5"><input type="text"  placeholder="Final Academic Qualification" required  name="mother_qualification"/></div>';
		}
		$html .= '</div><!-- col-md-12 -->';
		$html .= '<div class="col-md-12">';
		if($father_profession != ''){
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Profession"  required name="father_profession" value="'.$father_profession.'"/></div>';
		}else{
			$html .= '<div class="col-md-5"><input type="text"  placeholder="Profession"  required name="father_profession"/></div>';
		}

		$html .= '<div class="col-md-2 text-center">Profession</div>';
		if($mother_profession != ''){
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Profession"  required name="mother_profession" value="'.$mother_profession.'"/></div>';
		}else{
			$html .= '<div class="col-md-5"><input type="text"  placeholder="Profession"  required name="mother_profession"/></div>';
		}	
		$html .= '</div><!-- col-md-12 -->';

		$html .= '<div class="col-md-12">';

		if($father_designation != ''){
		$html .= '<div class="col-md-5"><input type="text"  placeholder="designation"  required name="father_designation" value="'.$father_designation.'"/></div>';
		}else{
			$html .= '<div class="col-md-5"><input type="text"  placeholder="designation"  required name="father_designation"/></div>';
		}

		$html .= '<div class="col-md-2 text-center">Designation</div>';

		if($mother_designation != ''){
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Designation" required name="mother_designation" value="'.$mother_designation.'"/></div>';
		}else{
			$html .= '<div class="col-md-5"><input type="text"  placeholder="Designation" required name="mother_designation"/></div>';
		}
		$html .= '</div><!-- col-md-12 -->';

		$html .= '<div class="col-md-12">';

		if($father_department != ''){
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Department"  required name="father_department" value="'.$father_department.'"/></div>';
		}else{
			$html .= '<div class="col-md-5"><input type="text"  placeholder="Department"  required name="father_department"/></div>';
		}

		$html .= '<div class="col-md-2 text-center">Department</div>';

		if($mother_department != ''){
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Department" required name="mother_department" value="'.$mother_department.'"/></div>';
		}else{
			$html .= '<div class="col-md-5"><input type="text"  placeholder="Department" required name="mother_department"/></div>';
		}
		$html .= '</div><!-- col-md-12 -->';





		$html .= '<div class="col-md-12">';

		if($father_organization != ''){
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Organization" required name="father_organization" value="'.$father_organization.'" /></div>';
		}else{
			$html .= '<div class="col-md-5"><input type="text"  placeholder="Organization" required name="father_organization" /></div>';
		}
		$html .= '<div class="col-md-2 text-center">Organization</div>';

		if($mother_organization != ''){
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Organization" required name="mother_organization" value="
		'.$mother_organization.'"/></div>';
		}else{
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Organization" required name="mother_organization"/></div>';

		}

		$html .= '</div><!-- col-md-12 -->';
		$html .= '<div class="col-md-12">';
		if($father_address != ''){
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Address" required name="father_officeAddress" value="'.$father_address.'"/></div>';
		}else{
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Address" required name="father_officeAddress"/></div>';
		}

		$html .= '<div class="col-md-2 text-center">Office Address</div>';
		if($mother_address  != ''){
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Address" required name="mother_officeAddress" value="'.$mother_address.'"/></div>';
		}else{
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Address" required name="mother_officeAddress"/></div>';
		}
		$html .= '</div><!-- col-md-12 -->';
		$html .= '<div class="col-md-12">';

		if($father_phone != '' ){
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Phone" required name="father_officePhoneNumber" value="'.$father_phone.'"/></div>';
		}else{
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Phone" required name="father_officePhoneNumber"/></div>';

		}
		$html .= '<div class="col-md-2 text-center">Office Phone</div>';
		if($mother_phone != ''){
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Phone" required name="mother_officePhoneNumber" value="'.$mother_phone.'"/></div>';
		}else{
		$html .= '<div class="col-md-5"><input type="text"  placeholder="Office Phone" required name="mother_officePhoneNumber"/></div>';
		}
		$html .= '</div><!-- col-md-12 -->';
		/* Father mother Details End */
		$html .= '<hr />';
		$html .= '<div class="col-md-12" style="padding-bottom:0;">';
		$html .= '<div class="col-md-3">&nbsp;</div>';
		$html .= '<div class="col-md-9">';
		$html .= '<div class="col-md-5">';
		$html .= '<input type="submit" class="greenBTN" value="Submit" id="adress_submit" />';
		$html .= '</div><!-- col-md-2 -->';
		$html .= '</div><!-- col-md-9 -->';
		$html .= '</div><!-- col-md-12 -->';
		$html .= '</div>';
		$html .= '</div><!-- inner -->';
		$html .= '</div><!-- .MaroonBorderBox -->';
		$html .= '</div><!-- col-md-12 -->';

		$html .= '<script>$(document).ready(function(){
		if($("#address_form").length){

			$("#address_form").validate({
				rules:{
					date_of_payment:{
						required:true
					},

					activation_date:{
						required:true
					}
				},
				    submitHandler: function (form) {
				    $("#Generations_AjaxLoader").show();
				    $(form).ajaxSubmit({
                        type: "POST",
                        url:"'.base_url("index.php/gs_admission/Admission_offer_approve_ajax/insert_address_concession").'",
                        success: function (data) {

                        	var form_id = $("input[name=form_id]").val();
                        	$.ajax({
                        		type:"POST",
                        		cache:false,
                        		data:{form_id:form_id},
                        		url:"'.base_url().'index.php/gs_admission/Admission_offer_approve_ajax/get_detail_of_form",
                        		success:function(e){
                        			var jsonData = JSON.parse(e);
                        			for(var i = 0 ; i < jsonData.length; i++){

                        				var is_address = jsonData[i].is_address;
                        				var is_date_of_payment = jsonData[i].is_date_of_payment;
                        				var is_concession_code = jsonData[i].is_concession_code;
                        				var is_activiation_date = jsonData[i].is_activiation_date;
                        				var payment_due_date = jsonData[i].payment_due_date;
                        				var is_family_detail = jsonData[i].is_family_detail;
                        				var is_previous_school_grade = jsonData[i].is_previous_school_grade;

                        				// Address
                        				if(is_address == 0){
										$(".liActions #address_"+form_id).removeClass("tick");
										$(".liActions #address_"+form_id).addClass("cross");

										}else{
										$(".liActions #address_"+form_id).removeClass("cross");
										$(".liActions #address_"+form_id).addClass("tick");
										}


										// Date Of Payment
										
										if(is_date_of_payment == 1){

										$(".liActions #date_of_payment_"+form_id).removeClass("cross");
										$(".liActions #date_of_payment_"+form_id).addClass("tick");
											
										}else{
										$(".liActions #date_of_payment_"+form_id).removeClass("tick");
										$(".liActions #date_of_payment_"+form_id).addClass("cross");	

										}

										// Concession Code
										
										if(is_concession_code == 1){
										$(".liActions #concession_code_"+form_id).removeClass("cross");
										$(".liActions #concession_code_"+form_id).addClass("tick");
										

										}else{
											
										$(".liActions #concession_code_"+form_id).removeClass("tick");
										$(".liActions #concession_code_"+form_id).addClass("cross");
										}

										// Activation Date

										if(is_activiation_date == 1){
										$(".liActions #activation_date_"+form_id).removeClass("cross");
										$(".liActions #activation_date_"+form_id).addClass("tick");
										}
										else{
										$(".liActions #activation_date_"+form_id).removeClass("tick");
										$(".liActions #activation_date_"+form_id).addClass("cross");

										}

										// Family Detail

										if(is_family_detail == 1){
										$(".liActions #family_detail_"+form_id).removeClass("cross");
										$(".liActions #family_detail_"+form_id).addClass("tick");
										}
										else{
										$(".liActions #family_detail_"+form_id).removeClass("tick");
										$(".liActions #family_detail_"+form_id).addClass("cross");

										}



										// Previous School Grade

										if(is_previous_school_grade == 1){
										$(".liActions #previous_school_grade_"+form_id).removeClass("cross");
										$(".liActions #previous_school_grade_"+form_id).addClass("tick");
										}
										else{
										$(".liActions #previous_school_grade_"+form_id).removeClass("tick");
										$(".liActions #previous_school_grade_"+form_id).addClass("cross");

										}

										// Payement Due Date 

										if(payment_due_date != ""){

										$("#due_date_"+form_id).text(payment_due_date)

										}
										$(".offer-preperation-hide").show();
										$("#AddDetails").modal("hide");

										$("#Generations_AjaxLoader").hide();
                        				
                        			}
                        		}
                        	});
                        }
                    })	


                        }
                    });
                }

			});';

		$html .= '</script>';


		echo $html ;   
	}




	// =================================== INSERT DETAIL LIKE CONCESSION ADDRESS=====================//
	//==============================================================================================//

		public function insert_address_concession(){

		$this->load->model('admission/offer_model','am');

		$form_id = $this->input->post('form_id');

		$gf_id = $this->input->post('gf_id');

		// Previous Grade And Previous School

		if(!empty($this->input->post('previous_grade'))){
			$previous_grade = $this->input->post('previous_grade');
		}else{
			$previous_grade = null;
		}

		if(!empty($this->input->post('previous_school'))){
			$previous_school = $this->input->post('previous_school');
		}else{
			$previous_school = null;
		}

		if($this->input->post('other_school')){
			$other_school = $this->input->post('other_school');
		}else{
			$other_school = null;		
		}



		if($previous_grade || $previous_school || $other_school){
			$this->previousGradeUpdate($previous_grade,$previous_school,$other_school,$form_id);
		}

		// Home And Appartment

		$appartment_no = $this->input->post('apartment_no');
		$street_name = $this->input->post('street_name');
		$building_name = $this->input->post('building_name');
		$plot_no = $this->input->post('plot_no');

		// Father And Mother Details

		$father_qualification = $this->input->post('father_qualification');
		$mother_qualification = $this->input->post('mother_qualification');

		$father_profession = $this->input->post('father_profession');
		$mother_profession = $this->input->post('mother_profession');

		$father_department = $this->input->post('father_department');
		$mother_department = $this->input->post('mother_department');

		$father_designation = $this->input->post('father_designation');
		$mother_designation = $this->input->post('mother_designation');

		$father_organization = $this->input->post('father_organization');
		$mother_organization = $this->input->post('mother_organization');

		$father_officeAddress = $this->input->post('father_officeAddress');
		$mother_officeAddress = $this->input->post('mother_officeAddress');

		$father_officePhoneNumber = $this->input->post('father_officePhoneNumber');
		$mother_officePhoneNumber = $this->input->post('mother_officePhoneNumber');




		if($this->input->post('region_input') != ''){
			$region = $this->input->post('region_input');
		}
		else if ($this->input->post('region') != ''){
			$region = $this->input->post('region');

		}

		if(!empty($this->input->post('sub-region'))){
			$sub_region = $this->input->post('sub-region');
		}else if($this->input->post('sub_region_input') != ''){
			$sub_region = $this->input->post('sub_region_input');
		}
		else{
			$sub_region = '';
		}

		$date_of_payment = $this->input->post('date_of_payment');
		$concession_code = $this->input->post('concession_code');
		$activation_date = $this->input->post('activation_date');
		$percentage = $this->input->post('percentage');

		

		// ===================== ADDRESS UPDATED ========================//
		//===============================================================//
		$data_adress = array(
			'home_apartment_no' => $appartment_no,
			'home_street_name' => $street_name,
			'home_building_name' => $building_name,
			'home_plot_no' => $plot_no,
			'home_region' => $region,
			'home_subregion' => $sub_region,
			'father_qualification' => $father_qualification,
			'father_occupation' => $father_profession,
			'father_department' => $father_department,
			'father_designation' => $father_designation,
			'father_company' => $father_organization,
			'father_office_location'=> $father_officeAddress,
			'father_work_phone' => $father_officePhoneNumber,
			'mother_qualification' => $mother_qualification,
			'mother_occupation' => $mother_profession,
			'mother_department' => $mother_department,
			'mother_designation' => $mother_designation,
			'mother_company' => $mother_organization,
			'mother_office_location'=> $mother_officeAddress,
			'mother_work_phone' => $mother_officePhoneNumber,
			'modified' => time(),
			'modified_by' => $this->user_id
		);

		$where_gf = array(
			'gf_id' => $gf_id
		);

		$updated_adress =  $this->am->update_data('atif_gs_admission.family_registration',$where_gf,$data_adress);
		echo $updated_adress;


		// =================== Concession Updated ============================ //
		//====================================================================//



		$where_concession = array(
			'admission_form_id' => $form_id
		);

		$select = 'id';

		$get_concession = $this->am->get_by_all('atif_gs_admission.admission_form_offer',$select,$where_concession);

		if(!empty($get_concession)){



		if ($this->input->post('admission_fee_waiver') === FALSE)
		{
		  $admission_fee_waiver=0;
		}
		else
		{
			$admission_fee_waiver=1;
		}



		$data_concession = array(
			'concession_code' => $concession_code,
			'concession_perc' => $percentage,
			'scholarship_ac' => $this->input->post('scholarshipAcademic'),
			'scholarship_nac' => $this->input->post('scholarshipNonAcademic'),
			'due_date' => $date_of_payment,
			'joining_date' => $activation_date,
			'admission_fee_waiver' =>$admission_fee_waiver,
			'modified' => time(),
			'modified_by' => $this->user_id

		);

		$id = $get_concession[0]->id;
		$where_id = array(
			'id' => $id
		);

		$update_concession = $this->am->update_data('atif_gs_admission.admission_form_offer',$where_id,$data_concession);
		echo $update_concession;	
			
		}else{


		if ($this->input->post('admission_fee_waiver') === FALSE)
		{
		  $admission_fee_waiver=0;
		}
		else
		{
			$admission_fee_waiver=1;
		}


			$insert_concession = array(
				'admission_form_id' => $form_id,
				'due_date' => $date_of_payment,
				'scholarship_ac' => $this->input->post('scholarshipAcademic'),
				'scholarship_nac' => $this->input->post('scholarshipNonAcademic'),
				'concession_code' => $concession_code,
				'concession_perc' => $percentage,
				'joining_date' => $activation_date,
				'offer_letter' => 0,
				'fif_form' => 0,
				'photo_token' => 0,
				'hand_book' => 0,
				'signed_offer_letter' => 0,
				'completed_fif_form' => 0,
				'signed_hand_book' => 0,
				'print_fee_bill' => 0,
				'offer_pack_handover' => 0,
				'admission_fee_waiver' =>$admission_fee_waiver,
				'created' => time(),
				'register_by' => $this->user_id,
				'modified' => time(),
				'modified_by' => $this->user_id

			);

			$inserted_row = $this->am->insert_data('atif_gs_admission.admission_form_offer',$insert_concession);
			echo $inserted_row;
		}

		
		$this->BillUpdate($form_id,$date_of_payment);
		
	}


	public function previousGradeUpdate($previous_grade,$previous_school,$other_school,$form_id){

		if( $other_school != NULL ){
				$previous_school_name = $other_school;	
				$data = array( "name" => $previous_school_name, "created"=>time(), "register_by" =>$this->session->userdata("user_id"));
				$previous_school = $this->am->set("_school",$data);

		}else{
				$previous_school = $previous_school;
		}




		$data = array(
			'previous_school_id' => $previous_school,
			'previous_grade' => $previous_grade,
			'modified' => time(),
			'modified_by' => $this->session->userdata("user_id")
		);

		$where = array(
			'id' => $form_id 
		);

		$update_previous_grade = $this->am->update_data('atif_gs_admission.admission_form',$where,$data);
	}



	// ======================= GET SUB REGION ====================//
	//============================================================//

	public function get_sub_region(){

		$region_id = $this->input->post('region_id');
		
		$this->load->model('admission/offer_model','am');

		$where = array(
			'region_id' => $region_id
		);

		$select = '';


		$sub_region = $this->am->get_by_all('atif._region_sub',$select,$where);

		echo json_encode($sub_region);

	}


	//============================OFFER PREPERATION ===============================//

	public function add_preperation(){

		$this->load->model('admission/offer_model','am');	
		$form_id = $this->input->post('form_id');

		$where = array(
			'admission_form_id' => $form_id
		);

		$select = '';
		$preperation =  $this->am->get_by_all('atif_gs_admission.admission_form_offer',$select,$where);
		//var_dump($preperation);

		$html = '';

		$where_id = array(
			'id' => $form_id
		);

		$select = 'official_name,grade_id';
		$admission_form = $this->am->get_by_all('atif_gs_admission.admission_form',$select,$where_id);
		$applicant_name = $admission_form[0]->official_name;

		$html .='<div class="modal-header">';
		$html .='<button type="button" class="close floatClose" data-dismiss="modal">&times;</button>';
        $html .='<h4 class="modal-title">Offer Preparation for - <strong>'.$applicant_name.'</strong></h4>';
        $html .='</div>';

		$html .= '<div class="modal-body">';
		//$html .= '<form id="prepForm">';
		$html .= '<div class="col-md-12" style="padding-bottom:0;">';
		$html .= '<div class="MaroonBorderBox">';
		$html .= '<div class="inner" style="">';
		$html .= '<div class="paddingLeft30 paddingRight30">';
		$html .= '<div class="alert alert-danger prep-alert" style="display:none">';
		$html .= 'Please tick all the boxes once you have the offer pack ready.';
		$html .= '</div>';
		$html .= '</div><!-- col-md-12 -->';
		$html .= '<div class="col-md-12 paddingBottom10">';
		$html .= '<div class="col-md-8 paddingBottom10 paddingLeft30">';
		if(!empty($preperation)){
			if($preperation[0]->offer_letter == 0){
				$html .= '<input type="checkbox" id="1" required  name="offer_letter" data-formid = '.$form_id.'  class="bigCheck offer_letter">';
			}
			else{
			$html .= '<input type="checkbox" id="1" name="offer_letter" required  data-formid = '.$form_id.'  class="bigCheck offer_letter" checked>';
			}
		}else{
			$html .= '<input type="checkbox" id="1" name="offer_letter" required  data-formid = '.$form_id.'  class="bigCheck offer_letter" >';
		}
		$html .= '<label class="bigLabel" for="1">Print Offer Letter <a href="javascript:void(0)"  class="smallLink" id="print_offer" data-formid='.$form_id.'><em>Print</em></a></label>';
		$html .= '</div><!-- col-md-8 -->';
		$html .= '<div class="col-md-2">&nbsp;</div>';
		$html .= '</div>';
		$html .= '<div class="col-md-12 paddingBottom10">';
		$html .= '<div class="col-md-8 paddingBottom10 paddingLeft30">';
		if(!empty($preperation)){
			if($preperation[0]->fif_form == 0){
				$html .= '<input type="checkbox" id="2" name="fif_form" required  class="bigCheck fif_form">';
			}
			else{
				$html .= '<input type="checkbox" id="2" name="fif_form" required  class="bigCheck fif_form" checked>';
			}
		}else{
			$html .= '<input type="checkbox" id="2" name="fif_form" required class="bigCheck fif_form">';
		}
		$html .= '<label class="bigLabel" for="2">Print FIF <a href="javascript:void(0)" id="print_fif" data-formid='.$form_id.' class="smallLink"><em>Print</em></a></label>';
		$html .= '</div><!-- col-md-8 -->';
		$html .= '<div class="col-md-2">&nbsp;</div>';
		$html .= '</div>';
		$html .= '<div class="col-md-12 paddingBottom10">';
		$html .= '<div class="col-md-8 paddingBottom10 paddingLeft30">';
		if(!empty($preperation)){
			if($preperation[0]->photo_token == 0){
			$html .= '<input type="checkbox" id="3" name="photo_taken" required class="bigCheck photo_taken">';
			}
			else{
			$html .= '<input type="checkbox" id="3" name="photo_taken" required class="bigCheck photo_taken" checked>';
			}
		}else{
			$html .= '<input type="checkbox" id="3" name="photo_taken" required class="bigCheck photo_taken">';	
		}
		$html .= '<label class="bigLabel" for="3">Print Photo Token <a href="#" class="smallLink"></a></label>';
		$html .= '</div><!-- col-md-8 -->';
		$html .= '<div class="col-md-2">&nbsp;</div>';
		$html .= '</div><!-- col-md-12 -->';
		$html .= '<div class="col-md-12 paddingBottom10">';
		$html .= '<div class="col-md-8 paddingBottom10 paddingLeft30">';
		if(!empty($preperation)){
			if($preperation[0]->hand_book == 0){
			$html .= '<input type="checkbox" id="4" name="handbook" required class="bigCheck handbook">';
			}
			else{
			$html .= '<input type="checkbox" id="4" name="handbook" required class="bigCheck handbook" checked>';
			}
		}else{
			$html .= '<input type="checkbox" id="4" name="handbook" required class="bigCheck handbook">';
		}
		$html .= '<label class="bigLabel" for="4">Handbook ready <a href="#" class="smallLink"></a></label>';
		$html .= '</div><!-- col-md-8 -->';
		$html .= '<div class="col-md-2">&nbsp;</div>';
		$html .= '</div><!-- col-md-12 -->';
		$html .= '<div class="col-md-12 paddingBottom10">';
		$html .= '<div class="col-md-8 paddingBottom10 paddingLeft30">';
		if(!empty($preperation)){
			if($preperation[0]->print_fee_bill == 0){
			$html .= '<input type="checkbox" id="5" name="printed_fee_bill" required class="bigCheck printed_fee_bill">';
			}
			else{
			$html .= '<input type="checkbox" id="5" name="printed_fee_bill" required class="bigCheck printed_fee_bill" checked>';
			}
		}else{
			$html .= '<input type="checkbox" id="5" name="printed_fee_bill" required class="bigCheck printed_fee_bill">';
		}
		$html .= '<label class="bigLabel" for="5"> Print Fee bill';
		if($admission_form[0]->grade_id == 15 || $admission_form[0]->grade_id == 16){
			$html .= '<a target="_blank" href="'.base_url().'index.php/gs_admission/admission_fee_bill_fao/fb?FormID='.$form_id.'" class="smallLink">';
		}else{
			
		$html .= '<a target="_blank" href="'.base_url().'index.php/gs_admission/admission_fee_bill/fb?FormID='.$form_id.'" class="smallLink">';
		}
		$html .= '<em>Print</em></a></label>';
		$html .= '</div><!-- col-md-8 -->';
		$html .= '<div class="col-md-2">&nbsp;</div>';
		$html .= '</div><!-- col-md-12 -->';
		$html .= '<hr />';
		$html .= '<div class="col-md-12" style="padding-bottom:0;">';
		$html .= '<div class="col-md-9 paddingLeft20">';
		$html .= '<div class="col-md-5">';
		$html .= '<input type="button" class="greenBTN" value="Submit" id="preperation_submit" />';
		$html .= '</div><!-- col-md-2 -->';
		$html .= '</div><!-- col-md-9 -->';
		$html .= '</div><!-- col-md-12 -->';
		$html .= '</div><!-- inner -->';
		$html .= '</div><!-- .MaroonBorderBox -->';
		$html .= '</div><!-- col-md-12 -->';
		//$html .= '</form>';
		$html .= '</div><!-- modal-body -->';
		

		echo $html;


	}


	// ======================== OFFER Submission ============================================//
	//======================================================================================//


	public function offer_submission(){

		$this->load->model('admission/offer_model','am');

		$form_id = $this->input->post('form_id');

		$where = array(
			'admission_form_id' => $form_id
		);

		$select = '';
		$submission =  $this->am->get_by_all('atif_gs_admission.admission_form_offer',$select,$where);

		// Applicant Name

		$where_id = array(
			'id' => $form_id
		);

		$select = 'official_name';
		$admission_form = $this->am->get_by_all('atif_gs_admission.admission_form',$select,$where_id);
		$applicant_name = $admission_form[0]->official_name;


		$html = '';

		$html .='<div class="modal-header">';
		$html .='<button type="button" class="close floatClose" data-dismiss="modal">&times;</button>';
        $html .='<h4 class="modal-title">Offer Submission for -<strong>'.$applicant_name.'</strong></h4>';
        $html .='</div>';

		$html .= '<div class="modal-body">';
		$html .= '<div class="col-md-12" style="padding-bottom:0;">';
		$html .= '<div class="MaroonBorderBox">';
		$html .= '<div class="inner" style="">';
		$html .= '<div class="paddingLeft30 paddingRight30">';
		$html .= '<div class="alert alert-danger alert-box" style="display:none">';
		$html .= 'Please tick <strong>Offer Letter Signed</strong> and <strong>Offer Pack Hand Over</strong>';
		$html .= '</div>';
		$html .= '</div><!-- col-md-12 -->';
		$html .= '<div class="col-md-12 paddingBottom10">';
		$html .= '<div class="col-md-8 paddingBottom10 paddingLeft30">';
		if(!empty($submission)){
			if($submission[0]->signed_offer_letter == 1){
			$html .= '<input type="checkbox" id="11" data-formid='.$form_id.' name="" required="required" class="bigCheck signed_offer" checked>';
			}
			else{
			$html .= '<input type="checkbox" id="11" data-formid='.$form_id.' name="" required="required" class="bigCheck signed_offer">';
			}
		}
		else{
		$html .= '<input type="checkbox" id="11" data-formid='.$form_id.' name="" required="required" class="bigCheck signed_offer">';
		}
		$html .= '<label class="bigLabel" for="11">Offer Letter Signed</label>';
		$html .= '</div><!-- col-md-8 -->';
		$html .= '<div class="col-md-2">&nbsp;</div>';
		$html .= '</div>';
		$html .= '<div class="col-md-12 paddingBottom10">';
		$html .= '<div class="col-md-8 paddingBottom10 paddingLeft30">';
		if(!empty($submission)){
			if($submission[0]->completed_fif_form== 1){
			$html .= '<input type="checkbox" id="22" name="" required="required" class="bigCheck signed_fif" checked>';	
			}
			else{
			$html .= '<input type="checkbox" id="22" name="" required="required" class="bigCheck signed_fif">';	
			}
		}
		else{
		$html .= '<input type="checkbox" id="22" name="" required="required" class="bigCheck signed_fif">';	
		}
		$html .= '<label class="bigLabel" for="22">FIF Form Completed</label>';
		$html .= '</div><!-- col-md-8 -->';
		$html .= '<div class="col-md-2">&nbsp;</div>';
		$html .= '</div>';
		$html .= '<div class="col-md-12 paddingBottom10">';
		$html .= '<div class="col-md-8 paddingBottom10 paddingLeft30">';
		if(!empty($submission)){
			if($submission[0]->signed_hand_book == 1){
			$html .= '<input type="checkbox" id="33" name="" required="required" class="bigCheck signed_handbook" checked>';			

			}else{
			 $html .= '<input type="checkbox" id="33" name="" required="required" class="bigCheck signed_handbook">';			
			}

		}else{
		$html .= '<input type="checkbox" id="33" name="" required="required" class="bigCheck signed_handbook">';			
		}
		$html .= '<label class="bigLabel" for="33">Handbook Signed </label>';
		$html .= '</div><!-- col-md-8 -->';
		$html .= '<div class="col-md-2">&nbsp;</div>';
		$html .= '</div><!-- col-md-12 -->';
		$html .= '<div class="col-md-12 paddingBottom10">';
		$html .= '<div class="col-md-8 paddingBottom10 paddingLeft30">';
		if(!empty($submission)){
			if($submission[0]->offer_pack_handover == 1){
			$html .= '<input type="checkbox" id="44" name="" required="required" class="bigCheck offer_pack_handover" checked>';

			}
			else{
			$html .= '<input type="checkbox" id="44" name="" required="required" class="bigCheck offer_pack_handover">';

			}

		}else{
		$html .= '<input type="checkbox" id="44" name="" required="required" class="bigCheck offer_pack_handover">';

		}
		$html .= '<label class="bigLabel" for="44">Offer Pack handedover </label>';
		$html .= '</div><!-- col-md-8 -->';
		$html .= '<div class="col-md-2">&nbsp;</div>';
		$html .= '</div><!-- col-md-12 -->';
		$html .= '<hr />';
		$html .= '<div class="col-md-12" style="padding-bottom:0;">';
		$html .= '<div class="col-md-9 paddingLeft20">';
		$html .= '<div class="col-md-5">';

		$display = $submission[0]->offer_pack_handover == 1 && $submission[0]->signed_offer_letter == 1  ? 'display:none' : 'display:';
		$html .= '<input type="submit" style = '.$display.' class="greenBTN" value="Submit" id="btn-submission" />';
		$html .= '</div><!-- col-md-2 -->';
		$html .= '</div><!-- col-md-9 -->';
		$html .= ' </div><!-- col-md-12 -->';
		$html .= ' </div><!-- inner -->';
		$html .= '</div><!-- .MaroonBorderBox -->';
		$html .= '</div><!-- col-md-12 -->';
		$html .= '</div><!-- modal-body -->';

		echo $html;                
	}


	// Insert and update  Offer Preperation

	public function insert_update_preperation(){

		$form_id = $this->input->post('form_id');
		$offer_letter_status = $this->input->post('offer_letter_status');
		$fif_form_status = $this->input->post('fif_form_status');
		$photo_taken_status = $this->input->post('photo_taken_status');
		$handbook_status = $this->input->post('handbook_status');
		$printed_fee_bill_status = $this->input->post('printed_fee_bill_status');

		// Check Form Is Empty or Not

		$where = array(
		'admission_form_id' => $form_id
		);

		$this->load->model('admission/offer_model','am');
		$select = 'id';
		$selected_id =  $this->am->get_by_all('atif_gs_admission.admission_form_offer',$select,$where);
		if(!empty($selected_id)){
			$id = $selected_id[0]->id;
		}
		else{
			$id = '';
		}

		if(!empty($id)){

			// Updated Data

			$updated_data_row = array(
				'offer_letter' => $offer_letter_status,
				'fif_form' => $fif_form_status,
				'photo_token' => $photo_taken_status,
				'hand_book' => $handbook_status,
				'print_fee_bill' => $printed_fee_bill_status,
				'modified' => time(),
				'modified_by' => $this->user_id
			);

			$where_data = array(
				'id' => $id
			);

			$updated_rows = $this->am->update_data('atif_gs_admission.admission_form_offer',$where_data,$updated_data_row);
			echo $updated_rows;

		}

		// INSERT DATA INTO Admission FORM OFFER
		else{

			$data = array(
				'admission_form_id' => $form_id,
				'offer_letter' => $offer_letter_status,
				'fif_form' => $fif_form_status,
				'photo_token' => $photo_taken_status,
				'hand_book' => $handbook_status,
				'print_fee_bill' => $printed_fee_bill_status,
				'created' => time(),
				'register_by' => $this->user_id,
				'modified' => time(),
				'modified_by' => $this->user_id
			);

			$insert =  $this->am->insert_data('atif_gs_admission.admission_form_offer',$data);
			echo $insert;
		}
		
		//var_dump($id);
	}


	public function get_detail_of_form(){

		$form_id = $this->input->post('form_id');
		$this->load->model('admission/offer_model','am');
		$form_detail =  $this->am->offer_detail_by_form_id($form_id);
		echo json_encode($form_detail);

	}

	public function insert_update_submission(){
		$form_id = $this->input->post('form_id');

		$signed_offer = $this->input->post('signed_offer');
		$signed_fif = $this->input->post('signed_fif');
		$signed_handbook = $this->input->post('signed_handbook');
		$offer_pack_handover = $this->input->post('offer_pack_handover');
		

		// Check Form Is Empty or Not

		$where = array(
		'admission_form_id' => $form_id
		);

		$this->load->model('admission/offer_model','am');
		$select = 'id';
		$selected_id =  $this->am->get_by_all('atif_gs_admission.admission_form_offer',$select,$where);
		if(!empty($selected_id)){
			$id = $selected_id[0]->id;
		}
		else{
			$id = '';
		}

		if(!empty($id)){

			// Updated Data

			$updated_data_row = array(
				'signed_offer_letter' => $signed_offer,
				'completed_fif_form' => $signed_fif,
				'signed_hand_book' => $signed_handbook,
				'offer_pack_handover' => $offer_pack_handover,
				'modified' => time(),
				'modified_by' => $this->user_id
			);

			$where_data = array(
				'id' => $id
			);

			$updated_rows = $this->am->update_data('atif_gs_admission.admission_form_offer',$where_data,$updated_data_row);
			echo $updated_rows;

		}

		// INSERT DATA INTO Admission FORM OFFER
		else{

			$data = array(
				'admission_form_id' => $form_id,
				'signed_offer_letter' => $signed_offer,
				'completed_fif_form' => $signed_fif,
				'signed_hand_book' => $signed_handbook,
				'offer_pack_handover' => $offer_pack_handover,
				'created' => time(),
				'register_by' => $this->user_id,
				'modified' => time(),
				'modified_by' => $this->user_id
			);

			$insert =  $this->am->insert_data('atif_gs_admission.admission_form_offer',$data);
			echo $insert;
		}
	}


	public function BillUpdate($form_id,$date_of_payment){
		$FormID = $form_id;
		$date_of_payment = $date_of_payment;

		$thisDate = $this->am->getFeeBill_OfferDate($FormID);

		$data['student'] = $this->am->offer_detail_by_form_id($FormID);
		$staffInfo = $this->am->getAdmission_StaffInfo($FormID);



		$FeeBillID = ''; $FeeBillIDSum = 0;
		$BillID = date('y') . '81';
		if($data['student'][0]->grade_id >= 6 && $data['student'][0]->grade_id <= 16){
			$BillID = date('y') . '82';
		}	
		$BillID = $BillID . str_pad($data['student'][0]->form_no, 5, '0', STR_PAD_LEFT);
		for($i=0; $i<strlen($BillID); $i++){
			$FeeBillIDSum += intval(substr($BillID, $i, 1));
		}
		$FeeBillIDSum += 1;
		$FeeBillIDSum = substr($FeeBillIDSum, -1);
		//$FeeBillID = 'Bill # ' . substr($BillID, 0, 2) . '-' . substr($BillID, 2, 2) . '-' . substr($BillID, 4, 5) . '-' . (substr($FeeBillIDSum, -1) + 1);
		$FeeBillID_Save = (substr($BillID, 0, 2).substr($BillID, 2, 2).substr($BillID, 4, 5).$FeeBillIDSum);
		$FeeBillID = 'Bill # ' . substr($FeeBillID_Save, 0, 2) . '-' . substr($FeeBillID_Save, 2, 2) . '-' . substr($FeeBillID_Save, 4, 5) . '-' . $FeeBillIDSum;


		$AdmissionYear = date('Y');
		$CallName = $data['student'][0]->call_name;

		$FatherName = '';
		if($data['student'][0]->gender=='G'){
			$FatherName = 'D/O ';
		}else{
			$FatherName = 'S/O ';
		}
		$FatherName .= $data['student'][0]->father_name;

		$Admitted = 'for admission to ' . $data['student'][0]->grade_name;

		$IssueDate = date("D d M 'y", strtotime($thisDate[0]->offer_date));
		$IssueDate_Save = date("Y-m-d", strtotime($thisDate[0]->offer_date));

		
		$select = 'bill_due_date';
		$where_gb_id = array(
			'gb_id' => $FeeBillID_Save
		);

		//$due_date_exists = $this->offer_model->get_by_all('atif_fee_student.fee_bill', $select, $where_gb_id);
		$due_date_exists = $this->am->get_by_all_query($FeeBillID_Save);

		
		// Due Date Extension

		if(!empty($due_date_exists)){
			 $DueDate = date("D d M 'y", strtotime($date_of_payment));
			 $DueDate_Save = $date_of_payment;
		}else{
			$DueDate = date("D d M 'y", strtotime($date_of_payment));
			$DueDate_Save = date("Y-m-d", strtotime($date_of_payment));
		}
		

		$BankValidityDate = $DueDate;
		$BankValidityDate_Save = $DueDate_Save;



		$Heading =  ''; //'FOR GRADE (' . $data['student'][0]->grade_name . ')';
		$nonRefundable_l1_text = "Admission Fee (Non-Refundable)";
		$nonRefundable_l2_text = "Computer Subscription Fee";
		$refundable_l1_text = "Security Deposit (Refundable)";
		$refundable_l2_text = "Waiver for T-CPM Staff";



		$ConcessionCode = $data['student'][0]->concession_code;
		$Concession = $data['student'][0]->concession_perc;
		$ConcessionAmount = 0;

		$nonRefundable_l1_amount = 40000;
		$nonRefundable_l2_amount = 0;
		if($data['student'][0]->grade_id >= 6 && $data['student'][0]->grade_id <= 14){
			$nonRefundable_l2_amount = 2000;
		}		
		$refundable_l1_amount = 15000;
		if($data['student'][0]->grade_id >= 15){
			$nonRefundable_l1_amount = 33000;
			$refundable_l1_amount = 12000;
		}
		$total_nonRefundable_amount = $nonRefundable_l1_amount;
		if($Concession>0){
			$ConcessionAmount = $total_nonRefundable_amount * $Concession / 100;
			if($ConcessionCode == 'C(TC)'){
				$refundable_l1_amount = 0;
			}
		}else{
			$Concession = 0;
		}
		$total_refundable_amount = $refundable_l1_amount + $nonRefundable_l2_amount;
		$TotalPayable = $total_nonRefundable_amount + $total_refundable_amount - $ConcessionAmount;

		



		if($this->am->feeBillCheck($FeeBillID_Save)){
			$this->am->updateFeeBill($FeeBillID_Save, $IssueDate_Save, $DueDate_Save, $BankValidityDate_Save, $TotalPayable, $ConcessionCode, $Concession, $total_nonRefundable_amount, $total_refundable_amount);
		}else{
			$this->am->insertFeeBill($FeeBillID_Save, $IssueDate_Save, $DueDate_Save, $BankValidityDate_Save, $TotalPayable, $ConcessionCode, $Concession, $total_nonRefundable_amount, $total_refundable_amount);
		}
	}


}