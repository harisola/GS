<?php

class Admission_compelete_check_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}










	// public function ShouldRegisterStudent($FormNo){
	// 	$result = false;

	// 	//var_dump($FormNo);
	// 	$query = "SELECT
	// 		* FROM
	// 		(select
	// 			af.id, af.form_no, af.abridged_name,
	// 			afo.signed_offer_letter, afo.offer_pack_handover,
	// 			afo.completed_fif_form, afo.signed_hand_book, IF(IFNULL(fbr.received_amount, 0) = 0, 0, 1) as fee_received
				
	// 			from atif_gs_admission.admission_form as af
	// 			left join atif_gs_admission.admission_form_offer as afo
	// 			   ON afo.admission_form_id = af.id
	// 			LEFT JOIN atif_fee_student.fee_bill as fb
	// 				ON af.form_no = mid(fb.gb_id, 6, 4)
	// 				AND fb.academic_session_id >= 9
	// 				AND fb.record_deleted = 0
	// 				AND LENGTH(fb.gb_id) = 10
	// 				AND LEFT(fb.gb_id,2) = 18
	// 			LEFT JOIN atif_fee_student.fee_bill_received as fbr
	// 				ON fbr.fee_bill_id = fb.id
	// 			WHERE af.form_no = $FormNo
	// 			)
	// 		as DB
	// 		WHERE signed_offer_letter = 1
	// 		AND offer_pack_handover = 1
	// 		AND completed_fif_form = 1
	// 		AND signed_hand_book = 1
	// 		AND fee_received = 1";


	// 	$resultQuery = $this->db->query( $query );
	// 	if( $resultQuery->num_rows() > 0 ){
	// 		$result = true;
	// 	}
	// 	return $result;
	// }

	public function ShouldRegisterStudent($FormNo){
		$result = false;

		//var_dump($FormNo);
		$query = "SELECT
			* FROM
			(select
				af.id, af.form_no, af.abridged_name,
				afo.signed_offer_letter, afo.offer_pack_handover,
				afo.completed_fif_form, afo.signed_hand_book, IF(IFNULL(fbr.received_amount, 0) = 0, 0, 1) as fee_received
				
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				   ON afo.admission_form_id = af.id
				LEFT JOIN atif_fee_student.fee_bill as fb
					ON af.form_no = mid(fb.gb_id, 6, 4)
					AND fb.academic_session_id >= 9
					AND fb.record_deleted = 0
					AND LENGTH(fb.gb_id) = 10
					AND LEFT(fb.gb_id,2) = 18
				LEFT JOIN atif_fee_student.fee_bill_received as fbr
					ON fbr.fee_bill_id = fb.id
				WHERE af.form_no = $FormNo
				)
			as DB
			WHERE signed_offer_letter = 1
			AND offer_pack_handover = 1
			AND completed_fif_form = 1
			AND signed_hand_book = 1
			AND fee_received = 1";


		$resultQuery = $this->db->query( $query );
		if( $resultQuery->num_rows() > 0 ){
			$result = true;
		}
		return $result;
	}

	// public function ShouldRegisterStudent_FormID($FormID){
	// 	$result = false;

	// 	$query = "SELECT
	// 		* FROM
	// 		(select
	// 			af.id, af.form_no, af.abridged_name,
	// 			afo.signed_offer_letter, afo.offer_pack_handover,
	// 			afo.completed_fif_form, afo.signed_hand_book, IF(IFNULL(fbr.received_amount, 0) = 0, 0, 1) as fee_received
				
	// 			from atif_gs_admission.admission_form as af
	// 			left join atif_gs_admission.admission_form_offer as afo
	// 			   ON afo.admission_form_id = af.id
	// 			LEFT JOIN atif_fee_student.fee_bill as fb
	// 				ON af.form_no = mid(fb.gb_id, 6, 4)
	// 				AND fb.academic_session_id >= 9
	// 				AND fb.record_deleted = 0
	// 				AND LENGTH(fb.gb_id) = 10
	// 			LEFT JOIN atif_fee_student.fee_bill_received as fbr
	// 				ON fbr.fee_bill_id = fb.id
	// 			WHERE af.id = $FormID
	// 			)
	// 		as DB
	// 		WHERE signed_offer_letter = 1
	// 		AND offer_pack_handover = 1
	// 		AND completed_fif_form = 1
	// 		AND signed_hand_book = 1
	// 		AND fee_received = 1";
			

	// 	$result = $this->db->query( $query );
	// 	if( $result->num_rows() > 0 ){
	// 		$result = true;
	// 	}
	// 	return $result;
	// }


	public function ShouldRegisterStudent_FormID($FormID){
		$result = false;

		$query = "SELECT
			* FROM
			(select
				af.id, af.form_no, af.abridged_name,
				afo.signed_offer_letter, afo.offer_pack_handover,
				afo.completed_fif_form, afo.signed_hand_book, IF(IFNULL(fbr.received_amount, 0) = 0, 0, 1) as fee_received,gb_id
				
				
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				   ON afo.admission_form_id = af.id
				LEFT JOIN atif_fee_student.fee_bill as fb
					ON af.form_no = IF(LENGTH(af.form_no) > 4 , mid(fb.gb_id, 5, 5),mid(fb.gb_id, 6, 4) )
					AND fb.academic_session_id >= 9
					AND fb.record_deleted = 0
					AND fb.bill_title = 'Admission'
					AND LENGTH(fb.gb_id) = 10
				LEFT JOIN atif_fee_student.fee_bill_received as fbr
					ON fbr.fee_bill_id = fb.id
				WHERE af.id = $FormID
				)
			as DB
			WHERE MID(gb_id,3,2) <> '72' AND signed_offer_letter = 1
			AND offer_pack_handover = 1
			AND completed_fif_form = 1
			AND signed_hand_book = 1
			AND fee_received = 1";
			

		$result = $this->db->query( $query );
		if( $result->num_rows() > 0 ){
			$result = true;
		}
		return $result;
	}










 // public function getStudentFeeBillData($FormID){
	// 	$query = "SELECT
	// 		* FROM
	// 		(select
	// 			af.id, af.form_no, af.abridged_name,
	// 			afo.signed_offer_letter, afo.offer_pack_handover,
	// 			afo.completed_fif_form, afo.signed_hand_book, IF(IFNULL(fbr.received_amount, 0) = 0, 0, 1) as fee_received,
	// 			fb.gb_id, fbr.received_date, fbr.received_branch
				
	// 			from atif_gs_admission.admission_form as af
	// 			left join atif_gs_admission.admission_form_offer as afo
	// 			   ON afo.admission_form_id = af.id
	// 			LEFT JOIN atif_fee_student.fee_bill as fb
	// 				ON af.form_no = mid(fb.gb_id, 6, 4)
	// 				AND fb.academic_session_id >= 9
	// 				AND fb.record_deleted = 0
	// 				AND LENGTH(fb.gb_id) = 10
	// 			LEFT JOIN atif_fee_student.fee_bill_received as fbr
	// 				ON fbr.fee_bill_id = fb.id
	// 			WHERE af.id = $FormID
	// 			)
	// 		as DB
	// 		WHERE signed_offer_letter = 1
	// 		AND offer_pack_handover = 1
	// 		AND completed_fif_form = 1
	// 		AND signed_hand_book = 1
	// 		AND fee_received = 1";


	// 	$row = $this->db->query($query);
	// 	$result=$row->result_array();
	// 	return $result;
	// }



	public function getStudentFeeBillData($FormID){
		$query = "SELECT
			* FROM
			(select
				af.id, af.form_no, af.abridged_name,
				afo.signed_offer_letter, afo.offer_pack_handover,
				afo.completed_fif_form, afo.signed_hand_book, IF(IFNULL(fbr.received_amount, 0) = 0, 0, 1) as fee_received,
				fb.gb_id, fbr.received_date, fbr.received_branch
				
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				   ON afo.admission_form_id = af.id
				LEFT JOIN atif_fee_student.fee_bill as fb
					ON af.form_no = IF(LENGTH(af.form_no) > 4 , mid(fb.gb_id, 5, 5),mid(fb.gb_id, 6, 4))
					AND fb.bill_title = 'Admission'
					AND fb.academic_session_id >= 9
					AND fb.record_deleted = 0
					AND LENGTH(fb.gb_id) = 10
				LEFT JOIN atif_fee_student.fee_bill_received as fbr
					ON fbr.fee_bill_id = fb.id
				WHERE af.id =$FormID
				)
			as DB
			WHERE signed_offer_letter = 1
			AND offer_pack_handover = 1
			AND completed_fif_form = 1
			AND signed_hand_book = 1
			AND fee_received = 1
			AND MID(gb_id,3,2) <> '72'";


		$row = $this->db->query($query);
		$result=$row->result_array();
		return $result;
	}



	






			public function get_pejmo_class_list(){
		$query = "SELECT
		if(fbr.id is null, '', sr.gs_id) as gs_id, sr.gf_id,
		af.form_id, af.form_no, af.gf_id, IFNULL(af.final_batchslot,'') AS final_batchslot,
		af.official_name AS applicant_name, af.father_name, IFNULL(DATE_FORMAT(af.offer_date, '%a %d, %b %Y'),'') AS offer_date, IFNULL(DATE_FORMAT(of.due_date, '%a %d, %b %Y'),'') AS payment_due_date,af.grade_id As grade_id,af.grade_name AS grade_name,CONCAT(IF(af.father_mobile <> '',af.father_mobile,'N/A'),' / ',IF(af.mother_mobile <> '',af.mother_mobile,'N/A')) AS fathe_mother_detail,


		IF(IFNULL(fbr.received_amount, 0) = 0, 0, 1) as fee_received,

		/********** Offer Details **********/ 
		IF(af.home_apartment_no='' AND af.home_street_name='' AND af.home_building_name='' AND af.home_plot_no='' AND af.home_region='' AND af.home_subregion='', 0, 1) AS is_address, IF(of.due_date='0000-00-00' OR of.due_date IS NULL, 0, 1) AS is_date_of_payment, IF(of.concession_code='' OR of.concession_code IS NULL,0,1) AS is_concession_code, IF(of.joining_date='0000-00-00' OR of.joining_date IS NULL, 0, 1) AS is_activiation_date,
		IF(af.father_qualification <> '' AND af.father_occupation <> '' AND af.father_company <> '' AND af.father_department <> '' AND af.father_office_location <> '' AND af.father_work_phone <> '' AND af.mother_qualification <> '' AND af.mother_occupation <> '' AND af.mother_company <> '' AND af.mother_department <> '' AND af.mother_office_location <> '' AND af.mother_work_phone <> '' ,1,0) as is_family_detail,IF(af.previous_school_id <> 0 AND af.previous_grade <> 0,1,0) as is_previous_school_grade,
		/********** Offer Details - END **********/


		/********** Offer Preparation **********/ IFNULL(of.offer_letter,'') AS is_printed_offer_letter, IFNULL(of.fif_form,'') AS is_printed_fif, IFNULL(of.photo_token,'') AS is_printed_photo_token, IFNULL(of.hand_book,'') AS is_handbook,
		/********** Offer Preparation - END **********/


		/********** Offer Submission **********/ IFNULL(of.signed_offer_letter,'') AS is_signed_offer_letter, IFNULL(of.completed_fif_form,'') AS is_complete_fif_form, IFNULL(of.signed_hand_book,'') AS is_signed_hand_book, IFNULL(of.print_fee_bill,'') AS is_printed_fee_bill,IFNULL(of.offer_pack_handover,'') as offer_pack_handover,
		/********** Offer Submission - END **********/


		/********** Status **********/ IF(af.form_id=allocation.admission_form_id,1,0) AS allocation, IF(af.form_id=communication.admission_form_id,1,0) AS communication, IF(af.form_id=reminder.admission_form_id,1,0) AS reminder, IF(af.form_id=presence.admission_form_id,1,0) AS presence, IF(af.form_id=followup.admission_form_id,1,0) AS followup,
		/********** Status - END **********/


		/********** Form Fields **********/
		af.home_apartment_no, af.home_street_name, af.home_building_name,
		af.home_plot_no, af.home_region, af.home_subregion, IFNULL(of.due_date,'') AS due_date, IFNULL(of.concession_code,'') AS concession_code, IFNULL(of.concession_perc,'') AS concession_perc, IFNULL(of.joining_date,'') AS joining_date
		/********** Form Fields - END **********/
		FROM atif_gs_admission.view_admission_form AS af
		LEFT JOIN atif_fee_student.fee_bill as fb
			ON af.form_no = IF(LENGTH(af.form_no) > 4 , mid(fb.gb_id, 5, 5),mid(fb.gb_id, 6, 4))
			AND fb.academic_session_id >= 9
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10
			AND LEFT(fb.gb_id, 2) != '17'
			AND fb.bill_title = 'Admission'

		LEFT JOIN atif_fee_student.fee_bill_received as fbr
			ON fbr.fee_bill_id = fb.id
		LEFT JOIN atif.student_registered as sr
			ON sr.id = fb.student_id
			AND sr.id != 7060
		LEFT JOIN atif_gs_admission.admission_form_offer AS of ON of.admission_form_id = af.form_id
		LEFT JOIN (
		SELECT admission_form_id
		FROM atif_gs_admission.log_form_status
		WHERE new_form_status=5 AND new_form_stage=1
		GROUP BY admission_form_id) AS allocation ON allocation.admission_form_id=af.form_id
		LEFT JOIN (
		SELECT admission_form_id
		FROM atif_gs_admission.log_form_status
		WHERE new_form_status=5 AND new_form_stage=2
		GROUP BY admission_form_id) AS communication ON communication.admission_form_id=af.form_id
		LEFT JOIN (
		SELECT admission_form_id
		FROM atif_gs_admission.log_form_status
		WHERE new_form_status=5 AND new_form_stage=3
		GROUP BY admission_form_id) AS reminder ON reminder.admission_form_id=af.form_id
		LEFT JOIN (
		SELECT admission_form_id
		FROM atif_gs_admission.log_form_status
		WHERE new_form_status=5 AND new_form_stage=4
		GROUP BY admission_form_id) AS presence ON presence.admission_form_id=af.form_id
		LEFT JOIN (
		SELECT admission_form_id
		FROM atif_gs_admission.log_form_status
		WHERE new_form_status=5 AND new_form_stage=5
		GROUP BY admission_form_id) AS followup ON followup.admission_form_id=af.form_id
		WHERE  ((af.grade_id >= 1 AND af.grade_id <= 14) OR  (af.grade_id = 17)) AND af.form_status_id >= 5 AND (af.form_status_stage_id = 3 OR af.form_status_stage_id = 1 OR af.form_status_stage_id = 10 /*OR af.form_status_stage_id = 12 */ OR af.form_status_stage_id = 2 OR af.form_status_stage_id = 11) AND of.offer_letter <> '' AND of.fif_form <> '' AND of.photo_token <> '' AND of.hand_book <> '' AND of.signed_offer_letter <> '' AND of.offer_pack_handover <> '' 
		group by af.form_id";
		$row = $this->db->query($query);
		return $row->result();
	}




	// public function get_pejmo_class_list(){
	// 	$query = "SELECT
	// 	if(fbr.id is null, '', sr.gs_id) as gs_id, sr.gf_id,
	// 	af.form_id, af.form_no, af.gf_id, IFNULL(af.final_batchslot,'') AS final_batchslot,
	// 	af.official_name AS applicant_name, af.father_name, IFNULL(DATE_FORMAT(af.offer_date, '%a %d, %b %Y'),'') AS offer_date, IFNULL(DATE_FORMAT(of.due_date, '%a %d, %b %Y'),'') AS payment_due_date,af.grade_id As grade_id,af.grade_name AS grade_name,CONCAT(IF(af.father_mobile <> '',af.father_mobile,'N/A'),' / ',IF(af.mother_mobile <> '',af.mother_mobile,'N/A')) AS fathe_mother_detail,


	// 	IF(IFNULL(fbr.received_amount, 0) = 0, 0, 1) as fee_received,

	// 	/********** Offer Details **********/ 
	// 	IF(af.home_apartment_no='' AND af.home_street_name='' AND af.home_building_name='' AND af.home_plot_no='' AND af.home_region='' AND af.home_subregion='', 0, 1) AS is_address, IF(of.due_date='0000-00-00' OR of.due_date IS NULL, 0, 1) AS is_date_of_payment, IF(of.concession_code='' OR of.concession_code IS NULL,0,1) AS is_concession_code, IF(of.joining_date='0000-00-00' OR of.joining_date IS NULL, 0, 1) AS is_activiation_date,
	// 	IF(af.father_qualification <> '' AND af.father_occupation <> '' AND af.father_company <> '' AND af.father_department <> '' AND af.father_office_location <> '' AND af.father_work_phone <> '' AND af.mother_qualification <> '' AND af.mother_occupation <> '' AND af.mother_company <> '' AND af.mother_department <> '' AND af.mother_office_location <> '' AND af.mother_work_phone <> '' ,1,0) as is_family_detail,IF(af.previous_school_id <> 0 AND af.previous_grade <> 0,1,0) as is_previous_school_grade,
	// 	/********** Offer Details - END **********/


	// 	/********** Offer Preparation **********/ IFNULL(of.offer_letter,'') AS is_printed_offer_letter, IFNULL(of.fif_form,'') AS is_printed_fif, IFNULL(of.photo_token,'') AS is_printed_photo_token, IFNULL(of.hand_book,'') AS is_handbook,
	// 	/********** Offer Preparation - END **********/


	// 	/********** Offer Submission **********/ IFNULL(of.signed_offer_letter,'') AS is_signed_offer_letter, IFNULL(of.completed_fif_form,'') AS is_complete_fif_form, IFNULL(of.signed_hand_book,'') AS is_signed_hand_book, IFNULL(of.print_fee_bill,'') AS is_printed_fee_bill,IFNULL(of.offer_pack_handover,'') as offer_pack_handover,
	// 	/********** Offer Submission - END **********/


	// 	/********** Status **********/ IF(af.form_id=allocation.admission_form_id,1,0) AS allocation, IF(af.form_id=communication.admission_form_id,1,0) AS communication, IF(af.form_id=reminder.admission_form_id,1,0) AS reminder, IF(af.form_id=presence.admission_form_id,1,0) AS presence, IF(af.form_id=followup.admission_form_id,1,0) AS followup,
	// 	/********** Status - END **********/


	// 	/********** Form Fields **********/
	// 	af.home_apartment_no, af.home_street_name, af.home_building_name,
	// 	af.home_plot_no, af.home_region, af.home_subregion, IFNULL(of.due_date,'') AS due_date, IFNULL(of.concession_code,'') AS concession_code, IFNULL(of.concession_perc,'') AS concession_perc, IFNULL(of.joining_date,'') AS joining_date
	// 	/********** Form Fields - END **********/
	// 	FROM atif_gs_admission.view_admission_form AS af
	// 	LEFT JOIN atif_fee_student.fee_bill as fb
	// 		ON af.form_no = mid(fb.gb_id, 6, 4)
	// 		AND fb.academic_session_id >= 9
	// 		AND fb.record_deleted = 0
	// 		AND LENGTH(fb.gb_id) = 10
	// 		AND LEFT(fb.gb_id, 2) != '17'

	// 	LEFT JOIN atif_fee_student.fee_bill_received as fbr
	// 		ON fbr.fee_bill_id = fb.id
	// 	LEFT JOIN atif.student_registered as sr
	// 		ON sr.id = fb.student_id
	// 		AND sr.id != 7060
	// 	LEFT JOIN atif_gs_admission.admission_form_offer AS of ON of.admission_form_id = af.form_id
	// 	LEFT JOIN (
	// 	SELECT admission_form_id
	// 	FROM atif_gs_admission.log_form_status
	// 	WHERE new_form_status=5 AND new_form_stage=1
	// 	GROUP BY admission_form_id) AS allocation ON allocation.admission_form_id=af.form_id
	// 	LEFT JOIN (
	// 	SELECT admission_form_id
	// 	FROM atif_gs_admission.log_form_status
	// 	WHERE new_form_status=5 AND new_form_stage=2
	// 	GROUP BY admission_form_id) AS communication ON communication.admission_form_id=af.form_id
	// 	LEFT JOIN (
	// 	SELECT admission_form_id
	// 	FROM atif_gs_admission.log_form_status
	// 	WHERE new_form_status=5 AND new_form_stage=3
	// 	GROUP BY admission_form_id) AS reminder ON reminder.admission_form_id=af.form_id
	// 	LEFT JOIN (
	// 	SELECT admission_form_id
	// 	FROM atif_gs_admission.log_form_status
	// 	WHERE new_form_status=5 AND new_form_stage=4
	// 	GROUP BY admission_form_id) AS presence ON presence.admission_form_id=af.form_id
	// 	LEFT JOIN (
	// 	SELECT admission_form_id
	// 	FROM atif_gs_admission.log_form_status
	// 	WHERE new_form_status=5 AND new_form_stage=5
	// 	GROUP BY admission_form_id) AS followup ON followup.admission_form_id=af.form_id
	// 	WHERE  ((af.grade_id >= 1 AND af.grade_id <= 14) OR  (af.grade_id = 17)) AND af.form_status_id >= 5 AND (af.form_status_stage_id = 3 OR af.form_status_stage_id = 1 OR af.form_status_stage_id = 10 /*OR af.form_status_stage_id = 12 */ OR af.form_status_stage_id = 2 OR af.form_status_stage_id = 11) AND of.offer_letter <> '' AND of.fif_form <> '' AND of.photo_token <> '' AND of.hand_book <> '' AND of.signed_offer_letter <> '' AND of.offer_pack_handover <> '' 
	// 	group by af.form_id";
	// 	$row = $this->db->query($query);
	// 	return $row->result();
	// }

	// public function get_aLevel_class_list(){
	// 	$query = "SELECT
	// 	if(fbr.id is null, '', sr.gs_id) as gs_id, sr.gf_id,
	// 	af.form_id, af.form_no, af.gf_id, IFNULL(af.final_batchslot,'') AS final_batchslot,
	// 	af.official_name AS applicant_name, af.father_name, IFNULL(DATE_FORMAT(af.offer_date, '%a %d, %b %Y'),'') AS offer_date, IFNULL(DATE_FORMAT(of.due_date, '%a %d, %b %Y'),'') AS payment_due_date,af.grade_id As grade_id,af.grade_name AS grade_name,CONCAT(IF(af.father_mobile <> '',af.father_mobile,'N/A'),' / ',IF(af.mother_mobile <> '',af.mother_mobile,'N/A')) AS fathe_mother_detail,


	// 	IF(IFNULL(fbr.received_amount, 0) = 0, 0, 1) as fee_received,

	// 	/********** Offer Details **********/ 
	// 	IF(af.home_apartment_no='' AND af.home_street_name='' AND af.home_building_name='' AND af.home_plot_no='' AND af.home_region='' AND af.home_subregion='', 0, 1) AS is_address, IF(of.due_date='0000-00-00' OR of.due_date IS NULL, 0, 1) AS is_date_of_payment, IF(of.concession_code='' OR of.concession_code IS NULL,0,1) AS is_concession_code, IF(of.joining_date='0000-00-00' OR of.joining_date IS NULL, 0, 1) AS is_activiation_date,
	// 	IF(af.father_qualification <> '' AND af.father_occupation <> '' AND af.father_company <> '' AND af.father_department <> '' AND af.father_office_location <> '' AND af.father_work_phone <> '' AND af.mother_qualification <> '' AND af.mother_occupation <> '' AND af.mother_company <> '' AND af.mother_department <> '' AND af.mother_office_location <> '' AND af.mother_work_phone <> '' ,1,0) as is_family_detail,IF(af.previous_school_id <> 0 AND af.previous_grade <> 0,1,0) as is_previous_school_grade,
	// 	/********** Offer Details - END **********/


	// 	/********** Offer Preparation **********/ IFNULL(of.offer_letter,'') AS is_printed_offer_letter, IFNULL(of.fif_form,'') AS is_printed_fif, IFNULL(of.photo_token,'') AS is_printed_photo_token, IFNULL(of.hand_book,'') AS is_handbook,
	// 	/********** Offer Preparation - END **********/


	// 	/********** Offer Submission **********/ IFNULL(of.signed_offer_letter,'') AS is_signed_offer_letter, IFNULL(of.completed_fif_form,'') AS is_complete_fif_form, IFNULL(of.signed_hand_book,'') AS is_signed_hand_book, IFNULL(of.print_fee_bill,'') AS is_printed_fee_bill,IFNULL(of.offer_pack_handover,'') as offer_pack_handover,
	// 	/********** Offer Submission - END **********/


	// 	/********** Status **********/ IF(af.form_id=allocation.admission_form_id,1,0) AS allocation, IF(af.form_id=communication.admission_form_id,1,0) AS communication, IF(af.form_id=reminder.admission_form_id,1,0) AS reminder, IF(af.form_id=presence.admission_form_id,1,0) AS presence, IF(af.form_id=followup.admission_form_id,1,0) AS followup,
	// 	/********** Status - END **********/


	// 	/********** Form Fields **********/
	// 	af.home_apartment_no, af.home_street_name, af.home_building_name,
	// 	af.home_plot_no, af.home_region, af.home_subregion, IFNULL(of.due_date,'') AS due_date, IFNULL(of.concession_code,'') AS concession_code, IFNULL(of.concession_perc,'') AS concession_perc, IFNULL(of.joining_date,'') AS joining_date
	// 	/********** Form Fields - END **********/
	// 	FROM atif_gs_admission.view_admission_form AS af
	// 	LEFT JOIN atif_fee_student.fee_bill as fb
	// 		ON af.form_no = mid(fb.gb_id, 6, 4)
	// 		AND fb.academic_session_id >= 9
	// 		AND fb.record_deleted = 0
	// 		AND LENGTH(fb.gb_id) = 10
	// 		AND LEFT(fb.gb_id, 2) != '17'
	// 		AND (LEFT(fb.gb_id , 4) = 1886 OR LEFT(fb.gb_id , 4) = 1885)

	// 	LEFT JOIN atif_fee_student.fee_bill_received as fbr
	// 		ON fbr.fee_bill_id = fb.id
	// 	LEFT JOIN atif.student_registered as sr
	// 		ON sr.id = fb.student_id
	// 		AND sr.id != 7060
	// 	LEFT JOIN atif_gs_admission.admission_form_offer AS of ON of.admission_form_id = af.form_id
	// 	LEFT JOIN (
	// 	SELECT admission_form_id
	// 	FROM atif_gs_admission.log_form_status
	// 	WHERE new_form_status=5 AND new_form_stage=1
	// 	GROUP BY admission_form_id) AS allocation ON allocation.admission_form_id=af.form_id
	// 	LEFT JOIN (
	// 	SELECT admission_form_id
	// 	FROM atif_gs_admission.log_form_status
	// 	WHERE new_form_status=5 AND new_form_stage=2
	// 	GROUP BY admission_form_id) AS communication ON communication.admission_form_id=af.form_id
	// 	LEFT JOIN (
	// 	SELECT admission_form_id
	// 	FROM atif_gs_admission.log_form_status
	// 	WHERE new_form_status=5 AND new_form_stage=3
	// 	GROUP BY admission_form_id) AS reminder ON reminder.admission_form_id=af.form_id
	// 	LEFT JOIN (
	// 	SELECT admission_form_id
	// 	FROM atif_gs_admission.log_form_status
	// 	WHERE new_form_status=5 AND new_form_stage=4
	// 	GROUP BY admission_form_id) AS presence ON presence.admission_form_id=af.form_id
	// 	LEFT JOIN (
	// 	SELECT admission_form_id
	// 	FROM atif_gs_admission.log_form_status
	// 	WHERE new_form_status=5 AND new_form_stage=5
	// 	GROUP BY admission_form_id) AS followup ON followup.admission_form_id=af.form_id
	// 	WHERE  (af.grade_id >= 15 AND af.grade_id <= 16) AND af.form_status_id >= 5 AND (af.form_status_stage_id = 3 OR af.form_status_stage_id = 1 OR af.form_status_stage_id = 10 /*OR af.form_status_stage_id = 12 */ OR af.form_status_stage_id = 2 OR af.form_status_stage_id = 11) AND of.offer_letter <> '' AND of.fif_form <> '' AND of.photo_token <> '' AND of.hand_book <> '' AND of.signed_offer_letter <> '' AND of.offer_pack_handover <> '' AND of.post_result_verification_approval = 1
	// 	group by af.form_id";
	// 	$row = $this->db->query($query);
	// 	return $row->result();
	// }

	public function get_aLevel_class_list(){
		$query = "SELECT
		if(fbr.id is null, '', sr.gs_id) as gs_id, sr.gf_id,
		af.form_id, af.form_no, af.gf_id, IFNULL(af.final_batchslot,'') AS final_batchslot,
		af.official_name AS applicant_name, af.father_name, IFNULL(DATE_FORMAT(af.offer_date, '%a %d, %b %Y'),'') AS offer_date, IFNULL(DATE_FORMAT(of.due_date, '%a %d, %b %Y'),'') AS payment_due_date,af.grade_id As grade_id,af.grade_name AS grade_name,CONCAT(IF(af.father_mobile <> '',af.father_mobile,'N/A'),' / ',IF(af.mother_mobile <> '',af.mother_mobile,'N/A')) AS fathe_mother_detail,


		IF(IFNULL(fbr.received_amount, 0) = 0, 0, 1) as fee_received,

		/********** Offer Details **********/ 
		IF(af.home_apartment_no='' AND af.home_street_name='' AND af.home_building_name='' AND af.home_plot_no='' AND af.home_region='' AND af.home_subregion='', 0, 1) AS is_address, IF(of.due_date='0000-00-00' OR of.due_date IS NULL, 0, 1) AS is_date_of_payment, IF(of.concession_code='' OR of.concession_code IS NULL,0,1) AS is_concession_code, IF(of.joining_date='0000-00-00' OR of.joining_date IS NULL, 0, 1) AS is_activiation_date,
		IF(af.father_qualification <> '' AND af.father_occupation <> '' AND af.father_company <> '' AND af.father_department <> '' AND af.father_office_location <> '' AND af.father_work_phone <> '' AND af.mother_qualification <> '' AND af.mother_occupation <> '' AND af.mother_company <> '' AND af.mother_department <> '' AND af.mother_office_location <> '' AND af.mother_work_phone <> '' ,1,0) as is_family_detail,IF(af.previous_school_id <> 0 AND af.previous_grade <> 0,1,0) as is_previous_school_grade,
		/********** Offer Details - END **********/


		/********** Offer Preparation **********/ IFNULL(of.offer_letter,'') AS is_printed_offer_letter, IFNULL(of.fif_form,'') AS is_printed_fif, IFNULL(of.photo_token,'') AS is_printed_photo_token, IFNULL(of.hand_book,'') AS is_handbook,
		/********** Offer Preparation - END **********/


		/********** Offer Submission **********/ IFNULL(of.signed_offer_letter,'') AS is_signed_offer_letter, IFNULL(of.completed_fif_form,'') AS is_complete_fif_form, IFNULL(of.signed_hand_book,'') AS is_signed_hand_book, IFNULL(of.print_fee_bill,'') AS is_printed_fee_bill,IFNULL(of.offer_pack_handover,'') as offer_pack_handover,
		/********** Offer Submission - END **********/


		/********** Status **********/ IF(af.form_id=allocation.admission_form_id,1,0) AS allocation, IF(af.form_id=communication.admission_form_id,1,0) AS communication, IF(af.form_id=reminder.admission_form_id,1,0) AS reminder, IF(af.form_id=presence.admission_form_id,1,0) AS presence, IF(af.form_id=followup.admission_form_id,1,0) AS followup,
		/********** Status - END **********/


		/********** Form Fields **********/
		af.home_apartment_no, af.home_street_name, af.home_building_name,
		af.home_plot_no, af.home_region, af.home_subregion, IFNULL(of.due_date,'') AS due_date, IFNULL(of.concession_code,'') AS concession_code, IFNULL(of.concession_perc,'') AS concession_perc, IFNULL(of.joining_date,'') AS joining_date
		/********** Form Fields - END **********/
		FROM atif_gs_admission.view_admission_form AS af
		LEFT JOIN atif_fee_student.fee_bill as fb
			ON af.form_no = IF(LENGTH(af.form_no) > 4 , mid(fb.gb_id, 5, 5),mid(fb.gb_id, 6, 4))
			AND fb.academic_session_id >= 9
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10
			AND LEFT(fb.gb_id, 2) != '17'
			AND fb.bill_title = 'Admission'
			

		LEFT JOIN atif_fee_student.fee_bill_received as fbr
			ON fbr.fee_bill_id = fb.id
		LEFT JOIN atif.student_registered as sr
			ON sr.id = fb.student_id
			AND sr.id != 7060
		LEFT JOIN atif_gs_admission.admission_form_offer AS of ON of.admission_form_id = af.form_id
		LEFT JOIN (
		SELECT admission_form_id
		FROM atif_gs_admission.log_form_status
		WHERE new_form_status=5 AND new_form_stage=1
		GROUP BY admission_form_id) AS allocation ON allocation.admission_form_id=af.form_id
		LEFT JOIN (
		SELECT admission_form_id
		FROM atif_gs_admission.log_form_status
		WHERE new_form_status=5 AND new_form_stage=2
		GROUP BY admission_form_id) AS communication ON communication.admission_form_id=af.form_id
		LEFT JOIN (
		SELECT admission_form_id
		FROM atif_gs_admission.log_form_status
		WHERE new_form_status=5 AND new_form_stage=3
		GROUP BY admission_form_id) AS reminder ON reminder.admission_form_id=af.form_id
		LEFT JOIN (
		SELECT admission_form_id
		FROM atif_gs_admission.log_form_status
		WHERE new_form_status=5 AND new_form_stage=4
		GROUP BY admission_form_id) AS presence ON presence.admission_form_id=af.form_id
		LEFT JOIN (
		SELECT admission_form_id
		FROM atif_gs_admission.log_form_status
		WHERE new_form_status=5 AND new_form_stage=5
		GROUP BY admission_form_id) AS followup ON followup.admission_form_id=af.form_id
		WHERE  (af.grade_id >= 15 AND af.grade_id <= 16) AND af.form_status_id >= 5 AND (af.form_status_stage_id = 3 OR af.form_status_stage_id = 1 OR af.form_status_stage_id = 10 /*OR af.form_status_stage_id = 12 */ OR af.form_status_stage_id = 2 OR af.form_status_stage_id = 11) AND of.offer_letter <> '' AND of.fif_form <> '' AND of.photo_token <> '' AND of.hand_book <> '' AND of.signed_offer_letter <> '' AND of.offer_pack_handover <> '' AND of.post_result_verification_approval = 1 AND (MID(fb.gb_id,3,2) = 86 OR MID(fb.gb_id,3,2)=85)
		group by af.form_id";
		$row = $this->db->query($query);
		return $row->result();
	}


	public function get_log($form_id){
		
		
			$query = "SELECT * FROM
			(
			/************************************************* Form Issuance
			*****************************************************************/
			select
			af.id as admission_form_id, FROM_UNIXTIME(af.created) as change_date, '' as reason,
			CONCAT('Admission form issued', ' on ', DATE_FORMAT(FROM_UNIXTIME(af.created), '%d-%b-%Y %h:%i %p')) as message,
			'Issuance' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 1 as this_order
			from atif_gs_admission.admission_form as af
			left join atif.staff_registered as sr
			   on sr.user_id = af.register_by
			where af.id = ".$form_id." /***** Change Form ID *****/
			
			
			
			UNION
			
			
			/************************************** Form Issuance - COmments
			*****************************************************************/
			select
			af.id as admission_form_id, FROM_UNIXTIME(af.created) as change_date, IF(af.comments!='', 'Admission Form Comments', '') as reason,
			IF(af.comments != '', CONCAT(af.comments, ' on ', DATE_FORMAT(FROM_UNIXTIME(af.created), '%d-%b-%Y %h:%i %p')), '') as message,
			'Comments' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 1 as this_order
			from atif_gs_admission.admission_form as af
			left join atif.staff_registered as sr
			   on sr.user_id = af.register_by
			where af.id = ".$form_id." and af.comments!='' /***** Change Form ID *****/



			UNION

			/*************************************************** Form Status - Submission
			*****************************************************************/
			select
			lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, '' as reason,
			CONCAT(fst_new.name, ' on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
			'Status' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 2 as this_order

			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission._form_status as fst_old
			   on fst_old.id = lgs.old_form_status
			left join atif_gs_admission._form_status as fst_new
			   on fst_new.id = lgs.new_form_status
			left join atif.staff_registered as sr
			   on sr.user_id = lgs.modified_by
			where lgs.admission_form_id = ".$form_id." /***** Change Form ID *****/    
			and lgs.type = 'S' and lgs.old_form_status=1 and lgs.new_form_status=2
			group by lgs.admission_form_id

			UNION


			/************************************ Communication - Assessment
			*****************************************************************/
			select
			lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, '' as reason,
			CONCAT('Communication of Assessment on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
			'Stage' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 3 as this_order

			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission._form_status_stage as fst_old
			   on fst_old.id = lgs.new_form_stage
			left join atif_gs_admission._form_status_stage as fst_new
			   on fst_new.id = lgs.new_form_stage
			left join atif.staff_registered as sr
			   on sr.user_id = lgs.modified_by
			where lgs.admission_form_id = ".$form_id." /***** Change Form ID *****/    
			and lgs.new_form_status = 2 and lgs.new_form_stage = 2
			group by admission_form_id


			UNION


			/***************************************** Presence - Assessment
			*****************************************************************/
			select
			lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, '' as reason,
			CONCAT('Presence of Assessment on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
			'Stage' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 3 as this_order

			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission._form_status_stage as fst_old
			   on fst_old.id = lgs.new_form_stage
			left join atif_gs_admission._form_status_stage as fst_new
			   on fst_new.id = lgs.new_form_stage
			left join atif.staff_registered as sr
			   on sr.user_id = lgs.modified_by
			where lgs.admission_form_id = ".$form_id." /***** Change Form ID *****/    
			and lgs.new_form_status = 3 and lgs.new_form_stage = 4
			group by admission_form_id


			UNION



			/*********************************** Form Status Stage - Beyond 5
			*****************************************************************/
			/*
			select
			lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, '' as reason,
			CONCAT(fst_new.name, ' on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
			'Stage' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 5 as this_order

			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission._form_status_stage as fst_old
			   on fst_old.id = lgs.new_form_stage
			left join atif_gs_admission._form_status_stage as fst_new
			   on fst_new.id = lgs.new_form_stage
			left join atif.staff_registered as sr
			   on sr.user_id = lgs.modified_by
			where lgs.admission_form_id = ".$form_id." /***** Change Form ID *****/    
			/*and lgs.type = 'G' and lgs.new_form_status >= 5


			UNION*/



			/************************************************* Form Comments
			*****************************************************************/
			select
			com.admission_form_id, FROM_UNIXTIME(com.created) as change_date, IF(com.reason = '', '', CONCAT(com.reason, ' on ', DATE_FORMAT(FROM_UNIXTIME(com.created), '%a %d, %b %Y %h:%i %p'))) as reason,
			com.comments as message, 'Comments' as type,
			if(sr.employee_id='298', 'gs_logo', sr.employee_id) as photo_id, sr.abridged_name as staff_name, 4 as this_order

			from atif_gs_admission.log_form_comments as com
			left join atif.staff_registered as sr
			   on sr.user_id = com.register_by
			       
			where com.admission_form_id = ".$form_id." /***** Change Form ID *****/        
			) AS DATA

			order by admission_form_id, change_date, this_order";



	$result = $this->db->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
	}else{ return FALSE; }
		
	} // Get Log

	// public function get_form_check($form_id){
	// 	$query = "SELECT af.is_photo_submitted,af.is_birthcrt_o,af.is_birthcrt_c,af.previous_school_id,af.previous_grade,af.is_alevel_supplement, IF(fr.home_apartment_no='' AND fr.home_region='' AND fr.home_subregion='', 0, 1) AS is_address, IF(afo.due_date='0000-00-00' OR afo.due_date IS NULL, 0, 1) AS is_date_of_payment, IF(afo.concession_code='' OR afo.concession_code IS NULL,0,1) AS is_concession_code, IF(afo.joining_date='0000-00-00' OR afo.joining_date IS NULL, 0, 1) AS is_activiation_date, IFNULL(afo.offer_letter,'') AS is_printed_offer_letter, IFNULL(afo.fif_form,'') AS is_printed_fif, IFNULL(afo.photo_token,'') AS is_printed_photo_token, IFNULL(afo.hand_book,'') AS is_handbook, IFNULL(afo.signed_offer_letter,'') AS is_signed_offer_letter, IFNULL(afo.completed_fif_form,'') AS is_complete_fif_form, IFNULL(afo.signed_hand_book,'') AS is_signed_hand_book, IFNULL(afo.print_fee_bill,'') AS is_printed_fee_bill, IFNULL(afo.offer_pack_handover,'') AS offer_pack_handover, IF(IFNULL(fbr.received_amount, 0) = 0, 0, 1) AS fee_received,
	// 		IF(fr.father_qualification <> '' AND fr.father_occupation <> '' AND fr.father_company <> '' AND fr.father_department <> '' AND fr.father_office_location <> '' AND fr.father_work_phone <> '' AND fr.mother_qualification <> '' AND fr.mother_occupation <> '' AND fr.mother_company <> '' AND fr.mother_department <> '' AND fr.mother_office_location <> '' AND fr.mother_work_phone <> '' ,1,0) as is_family_detail
	// 		FROM atif_gs_admission.admission_form af
	// 		LEFT JOIN atif_gs_admission.admission_form_offer afo ON af.id = afo.admission_form_id
	// 		LEFT JOIN atif_gs_admission.family_registration fr ON fr.gf_id = af.gf_id
	// 		LEFT JOIN atif_fee_student.fee_bill AS fb ON af.form_no = MID(fb.gb_id, 6, 4) AND fb.academic_session_id >= 9 AND fb.record_deleted = 0 AND LEFT(fb.gb_id,2) = 18
	// 		LEFT JOIN atif_fee_student.fee_bill_received AS fbr ON fbr.fee_bill_id = fb.id
	// 		WHERE af.id = '".$form_id."'";
	// 		$result = $this->db->query( $query );
	// 		if( $result->num_rows() > 0 ){
	// 		$results = $result->result_array();
	// 		return $results;
	// 		}else{ return FALSE; }
	// }

	public function get_form_check($form_id){
		$query = "SELECT af.is_photo_submitted,af.is_birthcrt_o,af.is_birthcrt_c,af.previous_school_id,af.previous_grade,af.is_alevel_supplement, IF(fr.home_apartment_no='' AND fr.home_region='' AND fr.home_subregion='', 0, 1) AS is_address, IF(afo.due_date='0000-00-00' OR afo.due_date IS NULL, 0, 1) AS is_date_of_payment, IF(afo.concession_code='' OR afo.concession_code IS NULL,0,1) AS is_concession_code, IF(afo.joining_date='0000-00-00' OR afo.joining_date IS NULL, 0, 1) AS is_activiation_date, IFNULL(afo.offer_letter,'') AS is_printed_offer_letter, IFNULL(afo.fif_form,'') AS is_printed_fif, IFNULL(afo.photo_token,'') AS is_printed_photo_token, IFNULL(afo.hand_book,'') AS is_handbook, IFNULL(afo.signed_offer_letter,'') AS is_signed_offer_letter, IFNULL(afo.completed_fif_form,'') AS is_complete_fif_form, IFNULL(afo.signed_hand_book,'') AS is_signed_hand_book, IFNULL(afo.print_fee_bill,'') AS is_printed_fee_bill, IFNULL(afo.offer_pack_handover,'') AS offer_pack_handover, IF(IFNULL(fbr.received_amount, 0) = 0, 0, 1) AS fee_received, IF(fr.father_qualification <> '' AND fr.father_occupation <> '' AND fr.father_company <> '' AND fr.father_department <> '' AND fr.father_office_location <> '' AND fr.father_work_phone <> '' AND fr.mother_qualification <> '' AND fr.mother_occupation <> '' AND fr.mother_company <> '' AND fr.mother_department <> '' AND fr.mother_office_location <> '' AND fr.mother_work_phone <> '',1,0) AS is_family_detail
FROM atif_gs_admission.admission_form af
LEFT JOIN atif_gs_admission.admission_form_offer afo ON af.id = afo.admission_form_id
LEFT JOIN atif_gs_admission.family_registration fr ON fr.gf_id = af.gf_id
LEFT JOIN atif_fee_student.fee_bill AS fb ON af.form_no = IF(LENGTH(af.form_no) > 4 , mid(fb.gb_id, 5, 5),mid(fb.gb_id, 6, 4) ) AND fb.academic_session_id >= 9 AND fb.record_deleted = 0 AND
LEFT(fb.gb_id,2) = 18 AND fb.bill_title = 'Admission'
LEFT JOIN atif_fee_student.fee_bill_received AS fbr ON fbr.fee_bill_id = fb.id
WHERE af.id = '".$form_id."' and MID(fb.gb_id,3,2) <> '72'";
			$result = $this->db->query( $query );
			if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
			}else{ return FALSE; }
	}

	// public function get_form_check_aLevel($form_id){
	// 	$query = "SELECT af.is_photo_submitted,af.is_birthcrt_o,af.is_birthcrt_c,af.previous_school_id,af.previous_grade,af.is_alevel_supplement, IF(fr.home_apartment_no='' AND fr.home_region='' AND fr.home_subregion='', 0, 1) AS is_address, IF(afo.due_date='0000-00-00' OR afo.due_date IS NULL, 0, 1) AS is_date_of_payment, IF(afo.concession_code='' OR afo.concession_code IS NULL,0,1) AS is_concession_code, IF(afo.joining_date='0000-00-00' OR afo.joining_date IS NULL, 0, 1) AS is_activiation_date, IFNULL(afo.offer_letter,'') AS is_printed_offer_letter, IFNULL(afo.fif_form,'') AS is_printed_fif, IFNULL(afo.photo_token,'') AS is_printed_photo_token, IFNULL(afo.hand_book,'') AS is_handbook, IFNULL(afo.signed_offer_letter,'') AS is_signed_offer_letter, IFNULL(afo.completed_fif_form,'') AS is_complete_fif_form, IFNULL(afo.signed_hand_book,'') AS is_signed_hand_book, IFNULL(afo.print_fee_bill,'') AS is_printed_fee_bill, IFNULL(afo.offer_pack_handover,'') AS offer_pack_handover, IF(IFNULL(fbr.received_amount, 0) = 0, 0, 1) AS fee_received,
	// 		IF(fr.father_qualification <> '' AND fr.father_occupation <> '' AND fr.father_company <> '' AND fr.father_department <> '' AND fr.father_office_location <> '' AND fr.father_work_phone <> '' AND fr.mother_qualification <> '' AND fr.mother_occupation <> '' AND fr.mother_company <> '' AND fr.mother_department <> '' AND fr.mother_office_location <> '' AND fr.mother_work_phone <> '' ,1,0) as is_family_detail,af.alevel_checklist
	// 		FROM atif_gs_admission.admission_form af
	// 		LEFT JOIN atif_gs_admission.admission_form_offer afo ON af.id = afo.admission_form_id
	// 		LEFT JOIN atif_gs_admission.family_registration fr ON fr.gf_id = af.gf_id
	// 		LEFT JOIN atif_fee_student.fee_bill AS fb ON af.form_no = MID(fb.gb_id, 6, 4) AND fb.academic_session_id >= 9 AND fb.record_deleted = 0 AND (LEFT(fb.gb_id,4) = 1885 OR LEFT(fb.gb_id,4) = 1886)
	// 		LEFT JOIN atif_fee_student.fee_bill_received AS fbr ON fbr.fee_bill_id = fb.id
	// 		WHERE af.id = ".$form_id;
	// 		$result = $this->db->query( $query );
	// 		if( $result->num_rows() > 0 ){
	// 		$results = $result->result_array();
	// 		return $results;
	// 		}else{ return FALSE; }
	// }
	public function get_form_check_aLevel($form_id){
		$query = "SELECT af.is_photo_submitted,af.is_birthcrt_o,af.is_birthcrt_c,af.previous_school_id,af.previous_grade,af.is_alevel_supplement, IF(fr.home_apartment_no='' AND fr.home_region='' AND fr.home_subregion='', 0, 1) AS is_address, IF(afo.due_date='0000-00-00' OR afo.due_date IS NULL, 0, 1) AS is_date_of_payment, IF(afo.concession_code='' OR afo.concession_code IS NULL,0,1) AS is_concession_code, IF(afo.joining_date='0000-00-00' OR afo.joining_date IS NULL, 0, 1) AS is_activiation_date, IFNULL(afo.offer_letter,'') AS is_printed_offer_letter, IFNULL(afo.fif_form,'') AS is_printed_fif, IFNULL(afo.photo_token,'') AS is_printed_photo_token, IFNULL(afo.hand_book,'') AS is_handbook, IFNULL(afo.signed_offer_letter,'') AS is_signed_offer_letter, IFNULL(afo.completed_fif_form,'') AS is_complete_fif_form, IFNULL(afo.signed_hand_book,'') AS is_signed_hand_book, IFNULL(afo.print_fee_bill,'') AS is_printed_fee_bill, IFNULL(afo.offer_pack_handover,'') AS offer_pack_handover, IF(IFNULL(fbr.received_amount, 0) = 0, 0, 1) AS fee_received, IF(fr.father_qualification <> '' AND fr.father_occupation <> '' AND fr.father_company <> '' AND fr.father_department <> '' AND fr.father_office_location <> '' AND fr.father_work_phone <> '' AND fr.mother_qualification <> '' AND fr.mother_occupation <> '' AND fr.mother_company <> '' AND fr.mother_department <> '' AND fr.mother_office_location <> '' AND fr.mother_work_phone <> '',1,0) AS is_family_detail,af.alevel_checklist
FROM atif_gs_admission.admission_form af
LEFT JOIN atif_gs_admission.admission_form_offer afo ON af.id = afo.admission_form_id
LEFT JOIN atif_gs_admission.family_registration fr ON fr.gf_id = af.gf_id
LEFT JOIN atif_fee_student.fee_bill AS fb ON af.form_no = IF(LENGTH(af.form_no) > 4 , mid(fb.gb_id, 5, 5),mid(fb.gb_id, 6, 4) ) AND fb.academic_session_id >= 9 AND fb.record_deleted = 0 AND
LEFT(fb.gb_id,2) = 18
LEFT JOIN atif_fee_student.fee_bill_received AS fbr ON fbr.fee_bill_id = fb.id
WHERE af.id = '".$form_id."' and MID(fb.gb_id,3,2) <> '72' and MID(fb.gb_id,3,2) <> '82'";


			$result = $this->db->query( $query );
			if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
			}else{ return FALSE; }
	}

	public function get_by_all($tablename, $select='', $where=null, $group=''){

		// Table Name

		// Selection

		$this->db->from($tablename);
		if($select == ''){
			$this->db->select();
		}
		else if($select != ''){
			$this->db->select($select);
		}

		// Where Condition

		if($where == null){

		}
		else if($where != null){
			$this->db->where($where);
		}



		//Group By

		if($group == ''){
		}
		else if($group != ''){
			$this->db->group_by($group);
		}

		// Get Query Result

		$query = $this->db->get();
		$row = $query->result();

		if($row == null){
			return false;
		}
		else if($row != null){
			return $row;
		}

	}

	public function update_data($tablename,$where,$data){
		
		$this->db->where($where);
		$this->db->update($tablename,$data);
		$row = $this->db->affected_rows();

		if($row == null){
			return false;
		}
		else if($row != null){
			return $row;
		}
	}

}