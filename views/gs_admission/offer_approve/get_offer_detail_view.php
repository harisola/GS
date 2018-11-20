<?php 

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
			$html .= '<td class="text-center">'.$offer->form_no.'</td>';
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
?>