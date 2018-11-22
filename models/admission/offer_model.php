<?php

class Offer_model extends CI_Controller{

	 

	function __construct()
	{
		parent::__construct();
		$this->load->database('gs_admission',TRUE);
	}



	public function get_Staff_FormIDs(){
		$query = "select
			af.id as form_id, af.form_no, fr.father_nic, fr.gf_id, sr.nic, sr.category
			from atif_gs_admission.family_registration as fr
			left join atif_gs_admission.admission_form as af
				on af.gf_id = fr.gf_id
			inner join atif.staff_registered as sr
				on sr.nic = fr.father_nic
				or sr.nic = fr.mother_nic
			where  sr.staff_status = 1 and sr.is_active = 1";
		$row = $this->db->query($query);
		return $row->result();
	}

	public function get_by_all_query($GBID){
		$query = "select * from atif_fee_student.fee_bill as fb where fb.gb_id = '" . $GBID . "'";
		$row = $this->db->query($query);
		return $row->result();
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

	//===================Get Alevel Grades===============================//
	//==================================================================//

	public function get_all_alevel_grades(){
		$query = "Select * from atif._grade where id in (15,16)";
		$row = $this->db->query($query);
		return $row->result();

	}
	// public function offer_detail_by_grade($grade_id){
	// 	$query = "SELECT
	// 	af.form_id, af.form_no, af.gf_id, IFNULL(af.final_batchslot,'') AS final_batchslot,
	// 	af.official_name AS applicant_name, af.father_name, IFNULL(DATE_FORMAT(af.offer_date, '%a %d, %b %Y'),'') AS offer_date, IFNULL(DATE_FORMAT(of.due_date, '%a %d, %b %Y'),'') AS payment_due_date,


	// 	/********** Offer Details **********/ IF(af.home_apartment_no=''  AND af.home_region='' AND af.home_subregion='', 0, 1) AS is_address, IF(of.due_date='0000-00-00' OR of.due_date IS NULL, 0, 1) AS is_date_of_payment, IF(of.concession_code='' OR of.concession_code IS NULL,0,1) AS is_concession_code, IF(of.joining_date='0000-00-00' OR of.joining_date IS NULL, 0, 1) AS is_activiation_date,
	// 	IF(af.father_qualification <> '' AND af.father_occupation <> '' AND af.father_company <> '' AND af.father_department <> '' AND af.father_office_location <> '' AND af.father_work_phone <> '' AND af.father_designation <> '' AND af.mother_qualification <> '' AND af.mother_occupation <> '' AND af.mother_company <> '' AND af.mother_department <> '' AND af.mother_office_location <> '' AND af.mother_work_phone <> '' AND af.mother_designation <> '',1,0) as is_family_detail,IF(af.previous_school_id <> 0 AND af.previous_grade <> 0,1,0) as is_previous_school_grade,
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
	// 	WHERE af.grade_id = $grade_id AND af.form_status_id >= 5 AND (af.form_status_stage_id = 3 OR af.form_status_stage_id = 1 OR af.form_status_stage_id = 10 /*OR af.form_status_stage_id = 12 */ OR af.form_status_stage_id = 2 OR af.form_status_stage_id = 11)";
	// 	$row = $this->db->query($query);
	// 	return $row->result();
	// }

	public function offer_detail_by_grade($grade_id){
		$query = "SELECT
		af.form_id, af.form_no, af.gf_id, IFNULL(af.final_batchslot,'') AS final_batchslot,
		af.official_name AS applicant_name, af.father_name, IFNULL(DATE_FORMAT(af.offer_date, '%a %d, %b %Y'),'') AS offer_date, IFNULL(DATE_FORMAT(of.due_date, '%a %d, %b %Y'),'') AS payment_due_date,


		/********** Offer Details **********/ IF(af.home_apartment_no=''  AND af.home_region='' AND af.home_subregion='', 0, 1) AS is_address, IF(of.due_date='0000-00-00' OR of.due_date IS NULL, 0, 1) AS is_date_of_payment, IF(of.concession_code='' OR of.concession_code IS NULL,0,1) AS is_concession_code, IF(of.joining_date='0000-00-00' OR of.joining_date IS NULL, 0, 1) AS is_activiation_date,
		IF(af.father_qualification <> '' AND af.father_occupation <> '' AND af.father_company <> '' AND af.father_department <> '' AND af.father_office_location <> '' AND af.father_work_phone <> '' AND af.father_designation <> '' AND af.mother_qualification <> '' AND af.mother_occupation <> '' AND af.mother_company <> '' AND af.mother_department <> '' AND af.mother_office_location <> '' AND af.mother_work_phone <> '' AND af.mother_designation <> '',1,0) as is_family_detail,IF(af.previous_school_id <> 0 AND af.previous_grade <> 0,1,0) as is_previous_school_grade,
		/********** Offer Details - END **********/


		/********** Offer Preparation **********/ IFNULL(of.offer_letter,'') AS is_printed_offer_letter, IFNULL(of.fif_form,'') AS is_printed_fif, IFNULL(of.photo_token,'') AS is_printed_photo_token, IFNULL(of.hand_book,'') AS is_handbook,
		/********** Offer Preparation - END **********/


		/********** Offer Submission **********/ IFNULL(of.signed_offer_letter,'') AS is_signed_offer_letter, IFNULL(of.completed_fif_form,'') AS is_complete_fif_form, IFNULL(of.signed_hand_book,'') AS is_signed_hand_book, IFNULL(of.print_fee_bill,'') AS is_printed_fee_bill,IFNULL(of.offer_pack_handover,'') as offer_pack_handover,
		/********** Offer Submission - END **********/


		/********** Status **********/ IF(af.form_id=allocation.admission_form_id,1,0) AS allocation, IF(af.form_id=communication.admission_form_id,1,0) AS communication, IF(af.form_id=reminder.admission_form_id,1,0) AS reminder, IF(af.form_id=presence.admission_form_id,1,0) AS presence, IF(af.form_id=followup.admission_form_id,1,0) AS followup,
		/********** Status - END **********/


		/********** Form Fields **********/
		af.home_apartment_no, af.home_street_name, af.home_building_name,
		af.home_plot_no, af.home_region, af.home_subregion, IFNULL(of.due_date,'') AS due_date, IFNULL(of.concession_code,'') AS concession_code, IFNULL(of.concession_perc,'') AS concession_perc, IFNULL(of.joining_date,'') AS joining_date,af.form_discussion_criteria,IFNULL(of.post_result_verification_approval,0) as post_result_verification_approval
		/********** Form Fields - END **********/
		FROM atif_gs_admission.view_admission_form AS af
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
		WHERE af.grade_id = ".$grade_id." AND af.form_status_id >= 5 AND 
		(af.form_status_stage_id = 3 OR af.form_status_stage_id = 1 OR af.form_status_stage_id = 10 
		/*OR af.form_status_stage_id = 12 */ OR af.form_status_stage_id = 2 OR af.form_status_stage_id = 11 
		OR af.form_status_stage_id = 7)";
		if($grade_id >= 15 && $grade_id <= 16){
			$query .= " AND of.post_result_verification_approval = 1";  
		}


		$row = $this->db->query($query);
		return $row->result();
	}


	public function getAdmission_StaffInfo($form_id){
		$query = "select
			af.gt_id, af.gf_id, st.code as status_code,
			CONCAT(CONVERT(
			LEFT(LPAD(`af`.`gf_id`,5,0),2) USING utf8mb4),'-', CONVERT(
			RIGHT(LPAD(`af`.`gf_id`,5,0),3) USING utf8mb4)) AS `gfid`
			from atif_gs_admission.admission_form as af
			left join atif.staff_child as sc
				on sc.gf_id = af.gf_id
			left join atif.staff_registered as sr
				on sr.gt_id = af.gt_id
			left join atif._staffstatus as st
				on st.id = sr.staff_status
			where af.gt_id != '' and af.id = " . $form_id;

		$row = $this->db->query($query);
		return $row->result();
	}

		/*********************************************************** S T A R T */
	/***********************************************************************/
	/***** ***** ****** A-Level (Gen or Non-Gen EAO - FAO) ***** ***** *****/
	public function get_Admission_FeeStructure($GradeID){
		$query = "select 
		fd.academic_session_id, fd.grade_id, fd.tuition_fee, fd.resource_fee, fd.musakhar, fd.lab_avc, fd.yearly 
		from atif_fee_student.fee_definition as fd
		inner join atif._academic_session as ases
			on ases.id = fd.academic_session_id
			and ases.is_active = 1
		inner join atif._grade as gg
			on gg.id = fd.grade_id

		where fd.grade_id = $GradeID 
		order by gg.complete_in_years desc";

		$row = $this->db->query($query);
		return $row->result();
	}


	public function is_EAO_paid_of($EAOCode, $FormNo){
		$result = false;
		$query = "select
		fb.gb_id, fb.bill_issue_date, fb.bill_due_date, fb.bill_bank_valid_date,
		fbr.received_amount, fbr.received_date

		from atif_fee_student.fee_bill as fb
		inner join atif_fee_student.fee_bill_received as fbr
			on fbr.fee_bill_id = fb.id
		where 
		fb.gb_id like '%" . $EAOCode . $FormNo . "%'
		and fb.bill_cycle_no = 0";



		$query_result = $this->db->query($query);
		if ( $query_result->num_rows() > 0){
			$result = true;
		}
		return $result;
	}
	/***********************************************************************/
	/***** ***** ****** A-Level (Gen or Non-Gen EAO - FAO) ***** ***** *****/
	/*************************************************************** E N D */



	// public function offer_detail_by_form_id($form_id){

	// 	$query = "select
	// 	af.form_id, af.form_no, IFNULL(af.final_batchslot,'') as final_batchslot,
	// 	af.official_name as applicant_name, af.father_name, af.call_name, af.gender, af.grade_name, af.grade_id,
	// 	IFNULL(DATE_FORMAT(af.offer_date, '%a %d, %b %Y'),'') as offer_date,
	// 	IFNULL(DATE_FORMAT(of.due_date, '%a %d, %b %Y'),'') as payment_due_date, af.father_nic, 


	// 	/********** Offer Details **********/
	// 	IF(af.home_apartment_no='' AND af.home_street_name='' AND af.home_building_name=''
	// 		AND af.home_plot_no='' AND af.home_region='' AND af.home_subregion='', 0, 1) as is_address,
	// 	IF(of.due_date='0000-00-00' OR of.due_date is null, 0, 1) as is_date_of_payment, 
	// 	IF(of.concession_code='' OR of.concession_code is null,0,1) AS is_concession_code,
	// 	IF(of.joining_date='0000-00-00' OR of.joining_date is null, 0, 1) as is_activiation_date,
	// 	IF(af.father_qualification <> '' AND af.father_occupation <> '' AND af.father_company <> '' AND af.father_department <> '' AND af.father_office_location <> '' AND af.father_work_phone <> '' AND af.mother_qualification <> '' AND af.mother_occupation <> '' AND af.mother_company <> '' AND af.mother_department <> '' AND af.mother_office_location <> '' AND af.mother_work_phone <> '' ,1,0) as is_family_detail,IF(af.previous_school_id <> 0 AND af.previous_grade <> 0,1,0) as is_previous_school_grade,
	// 	/********** Offer Details - END **********/


	// 	/********** Offer Preparation **********/
	// 	IFNULL(of.offer_letter,'') as is_printed_offer_letter, IFNULL(of.fif_form,'') as is_printed_fif, 
	// 	IFNULL(of.photo_token,'') as is_printed_photo_token, IFNULL(of.hand_book,'') as is_handbook,
	// 	/********** Offer Preparation - END **********/


	// 	/********** Offer Submission **********/
	// 	IFNULL(of.signed_offer_letter,'') as is_signed_offer_letter, IFNULL(of.completed_fif_form,'') as is_complete_fif_form,
	// 	IFNULL(of.signed_hand_book,'') as is_signed_hand_book, IFNULL(of.print_fee_bill,'') as is_printed_fee_bill,IFNULL(of.offer_pack_handover,'') as offer_pack_handover,
	// 	/********** Offer Submission - END **********/


	// 	/********** Status **********/
	// 	IF(af.form_id=allocation.admission_form_id,1,0) as allocation,
	// 	IF(af.form_id=communication.admission_form_id,1,0) as communication,
	// 	IF(af.form_id=reminder.admission_form_id,1,0) as reminder,
	// 	IF(af.form_id=presence.admission_form_id,1,0) as presence,
	// 	IF(af.form_id=followup.admission_form_id,1,0) as followup,
	// 	/********** Status - END **********/


	// 	/********** Form Fields **********/
	// 	af.home_apartment_no, af.home_street_name, af.home_building_name,
	// 	af.home_plot_no, af.home_region, af.home_subregion,
	// 	IFNULL(of.due_date,'') as due_date, IFNULL(of.concession_code,'') as concession_code, 
	// 	IFNULL(of.concession_perc,'') as concession_perc, IFNULL(of.joining_date,'') as joining_date
	// 	/********** Form Fields - END **********/


	// 	from atif_gs_admission.view_admission_form as af

	// 	left join atif_gs_admission.admission_form_offer as of
	// 		on of.admission_form_id = af.form_id

	// 	left join (SELECT admission_form_id
	// 		FROM atif_gs_admission.log_form_status
	// 		where new_form_status=5 and new_form_stage=1
	// 		group by admission_form_id) as allocation
	// 		on allocation.admission_form_id=af.form_id

	// 	left join (SELECT admission_form_id
	// 		FROM atif_gs_admission.log_form_status
	// 		where new_form_status=5 and new_form_stage=2
	// 		group by admission_form_id) as communication
	// 		on communication.admission_form_id=af.form_id

	// 	left join (SELECT admission_form_id
	// 		FROM atif_gs_admission.log_form_status
	// 		where new_form_status=5 and new_form_stage=3
	// 		group by admission_form_id) as reminder
	// 		on reminder.admission_form_id=af.form_id
			
	// 	left join (SELECT admission_form_id
	// 		FROM atif_gs_admission.log_form_status
	// 		where new_form_status=5 and new_form_stage=4
	// 		group by admission_form_id) as presence
	// 		on presence.admission_form_id=af.form_id
			
	// 	left join (SELECT admission_form_id
	// 		FROM atif_gs_admission.log_form_status
	// 		where new_form_status=5 and new_form_stage=5
	// 		group by admission_form_id) as followup
	// 		on followup.admission_form_id=af.form_id
			
			
	// 	where af.form_id = $form_id and af.form_status_id >= 5 and (af.form_status_stage_id = 3 OR af.form_status_stage_id = 1 OR af.form_status_stage_id = 10 OR af.form_status_stage_id = 12 OR af.form_status_stage_id = 2)";
	// 	$row = $this->db->query($query);
	// 	return $row->result();

	// }

	public function offer_detail_by_form_id($form_id){

		$query = "select
		af.form_id, af.form_no, IFNULL(af.final_batchslot,'') as final_batchslot,
		af.official_name as applicant_name, af.father_name, af.call_name, af.gender, af.grade_name, af.grade_id,
		IFNULL(DATE_FORMAT(af.offer_date, '%a %d, %b %Y'),'') as offer_date,
		IFNULL(DATE_FORMAT(of.due_date, '%a %d, %b %Y'),'') as payment_due_date, af.father_nic, 


		/********** Offer Details **********/
		IF(af.home_apartment_no='' AND af.home_street_name='' AND af.home_building_name=''
			AND af.home_plot_no='' AND af.home_region='' AND af.home_subregion='', 0, 1) as is_address,
		IF(of.due_date='0000-00-00' OR of.due_date is null, 0, 1) as is_date_of_payment, 
		IF(of.concession_code='' OR of.concession_code is null,0,1) AS is_concession_code,
		IF(of.joining_date='0000-00-00' OR of.joining_date is null, 0, 1) as is_activiation_date,
		IF(af.father_qualification <> '' AND af.father_occupation <> '' AND af.father_company <> '' AND af.father_department <> '' AND af.father_office_location <> '' AND af.father_work_phone <> '' AND af.mother_qualification <> '' AND af.mother_occupation <> '' AND af.mother_company <> '' AND af.mother_department <> '' AND af.mother_office_location <> '' AND af.mother_work_phone <> '' ,1,0) as is_family_detail,IF(af.previous_school_id <> 0 AND af.previous_grade <> 0,1,0) as is_previous_school_grade,
		/********** Offer Details - END **********/


		/********** Offer Preparation **********/
		IFNULL(of.offer_letter,'') as is_printed_offer_letter, IFNULL(of.fif_form,'') as is_printed_fif, 
		IFNULL(of.photo_token,'') as is_printed_photo_token, IFNULL(of.hand_book,'') as is_handbook,
		/********** Offer Preparation - END **********/


		/********** Offer Submission **********/
		IFNULL(of.signed_offer_letter,'') as is_signed_offer_letter, IFNULL(of.completed_fif_form,'') as is_complete_fif_form,
		IFNULL(of.signed_hand_book,'') as is_signed_hand_book, IFNULL(of.print_fee_bill,'') as is_printed_fee_bill,IFNULL(of.offer_pack_handover,'') as offer_pack_handover,
		/********** Offer Submission - END **********/


		/********** Status **********/
		IF(af.form_id=allocation.admission_form_id,1,0) as allocation,
		IF(af.form_id=communication.admission_form_id,1,0) as communication,
		IF(af.form_id=reminder.admission_form_id,1,0) as reminder,
		IF(af.form_id=presence.admission_form_id,1,0) as presence,
		IF(af.form_id=followup.admission_form_id,1,0) as followup,
		/********** Status - END **********/


		/********** Form Fields **********/
		af.home_apartment_no, af.home_street_name, af.home_building_name,
		af.home_plot_no, af.home_region, af.home_subregion,
		IFNULL(of.due_date,'') as due_date, IFNULL(of.concession_code,'') as concession_code, 
		IFNULL(of.concession_perc,'') as concession_perc, 
		IFNULL(of.scholarship_ac, '') as scholarship_ac,
		IFNULL(of.scholarship_nac, '') as scholarship_nac,
		IFNULL(of.joining_date,'') as joining_date,
		/********** Form Fields - END **********/
		
		/*Admission form waiver*/
		
		if(of.admission_fee_waiver=0,0,1) as Admission_Form_Wavier


		from atif_gs_admission.view_admission_form as af

		left join atif_gs_admission.admission_form_offer as of
			on of.admission_form_id = af.form_id

		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=1
			group by admission_form_id) as allocation
			on allocation.admission_form_id=af.form_id

		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=2
			group by admission_form_id) as communication
			on communication.admission_form_id=af.form_id

		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=3
			group by admission_form_id) as reminder
			on reminder.admission_form_id=af.form_id
			
		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=4
			group by admission_form_id) as presence
			on presence.admission_form_id=af.form_id
			
		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=5
			group by admission_form_id) as followup
			on followup.admission_form_id=af.form_id
			
			
		where af.form_id = $form_id and af.form_status_id >= 5 and (af.form_status_stage_id = 3 OR af.form_status_stage_id = 1 OR af.form_status_stage_id = 10 OR af.form_status_stage_id = 12 OR af.form_status_stage_id = 2)";
		$row = $this->db->query($query);
		return $row->result();

	}

	// ================ INSERT DATA ===================//
	//=================================================//

	public function insert_data($tablename,$data){

		$this->db->insert($tablename,$data);
		
		$affected = $this->db->affected_rows();
		return $affected;

	}

	//====================UPDATED DATA ==================//
	//===================================================//

	public function update_data($tablename,$where,$data){
		
		print_r($where);
		print_r($tablename);
		print_r($data);
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

	public function updateFeeBill_ALevel($GBID, $BillIssueDate, $BillDueDate, $BillValidityDate, $BillPayable, $ConcessionCode, $ConcessionPerc, $AdmissionFee, $SecurityDeposit, $AdditionalCharges, $GrossTuitionFee, $Scholarship){
		$this->load->library('session');
		$query = "update atif_fee_student.fee_bill set 
			bill_issue_date = '$BillIssueDate',
			bill_due_date = '$BillDueDate',
			bill_bank_valid_date = '$BillValidityDate',
			bill_payable = $BillPayable,
			total_payable = $BillPayable,
			fee_d_l1 = '$ConcessionCode',
			fee_a_discount = $ConcessionPerc,
			fee_d_l2 = '$Scholarship',
			additional_charges = $AdditionalCharges,
			gross_tuition_fee = $GrossTuitionFee,
			admission_fee = $AdmissionFee,
			security_deposit = $SecurityDeposit,
			modified = unix_timestamp(),
			modified_by = " . (int)$this->session->userdata("user_id") . "

			where gb_id = '$GBID'";
			$query_result = $this->db->query($query);
	}
	public function insertFeeBill_ALevel($GBID, $BillIssueDate, $BillDueDate, $BillValidityDate, $BillPayable, $ConcessionCode, $ConcessionPerc, $AdmissionFee, $SecurityDeposit, $AdditionalCharges, $GrossTuitionFee, $Scholarship){
		$this->load->library('session');
		$FeeBIllTypeID = 1;
		$AcademicSessionID = 13;
		$BillCycleNo = 0;
		$BillTitle = 'Admission';
		$BillMonths = 0;
		$StudentID = 7060;
		$query = "insert into atif_fee_student.fee_bill (fee_bill_type_id, gb_id, academic_session_id, bill_cycle_no, bill_title, 
		bill_issue_date, bill_due_date, bill_bank_valid_date, bill_months, student_id, fee_a, fee_a_discount, fee_d_l1, fee_b, fee_b_discount,
		adjustment, arrears_suspended, total_current_bill, oc_smartcard_charges, oc_smartcard_ids, oc_magazine,
		oc_surcharge, oc_suspended, oc_adv_tax, oc_late_fee, oc_yearly, waive_amount, admission_fee, security_deposit, bill_payable, total_payable, is_void, additional_charges, gross_tuition_fee, fee_d_l2,
		created, register_by, modified, modified_by, record_deleted) values
		('$FeeBIllTypeID', '$GBID', $AcademicSessionID, $BillCycleNo, '$BillTitle', '$BillIssueDate', '$BillDueDate', '$BillValidityDate', $BillMonths, $StudentID, '', $ConcessionPerc, '$ConcessionCode', '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, $AdmissionFee, $SecurityDeposit, $BillPayable, $BillPayable,
		0, $AdditionalCharges, $GrossTuitionFee, '$Scholarship',
		unix_timestamp(), " . (int)$this->session->userdata("user_id") . ", unix_timestamp(), " . (int)$this->session->userdata("user_id") . ", 0)";
		$query_result = $this->db->query($query);
	}








	public function get_OfferLetter_StudentData($FormNo){
		$thisDate = $this->getFeeBill_OfferDate($FormNo);



		//$DueDate = date("Y-m-d", strtotime($thisDate[0]->offer_date. ' + 5 weekday'));
		$query = "Select
					af.id, af.form_no, af.official_name, af.call_name, af.grade_id, af.grade_name, af.gender, fr.father_name,
					if(fr.single_parent = 1 and fr.primary_contact = 0, 'Mr.', 
					if(fr.single_parent = 1 and fr.primary_contact = 1, 'Mrs.', 'Mr. & Mrs.')) as title,
					if(fr.single_parent = 1 and fr.primary_contact = 0, fr.father_name, 
					if(fr.single_parent = 1 and fr.primary_contact = 1, fr.mother_name, fr.father_name)) as parent, idate.islami_date,
					DATE_FORMAT(afo.due_date,'%W, %M %d, %Y') as valid_date,
					CONCAT( CASE  
				              WHEN IFNULL(fr.home_apartment_no,'') = ''
				              THEN '' 
				              ELSE CONCAT(fr.home_apartment_no, ', ')
				       		  END,
				              CASE
				              WHEN IFNULL(fr.home_building_name,'') = ''
				              THEN '' 
				              ELSE CONCAT(fr.home_building_name, ', ') 
				              END,
				              CASE
				              WHEN IFNULL(fr.home_plot_no,'') = ''
				              THEN '' 
				              ELSE CONCAT(fr.home_plot_no, ', ') 
				              END,
				              CASE
				              WHEN IFNULL(fr.home_street_name,'') = ''
				              THEN '' 
				              ELSE CONCAT(fr.home_street_name, ', ') 
				              END,
				              CASE
				              WHEN IFNULL(fr.home_subregion,'') = ''
				              THEN '' 
				              ELSE CONCAT(fr.home_subregion, ', ') 
				              END,
				              CASE
				              WHEN IFNULL(fr.home_region,'') = ''
				              THEN '' 
				              ELSE CONCAT(fr.home_region, '') 
				              END
				              ) as address
				From atif_gs_admission.admission_form as af
				Left Join atif_gs_admission.family_registration as fr 
				on fr.gf_id = af.gf_id
				Left Join (Select date, 
					concat(islami_month, ' ',date_format(islami_date, '%d %Y')) as islami_date  
					from atif_attendance.attendance_calendar ) as idate
				on idate.date = curdate()
				Left Join atif_gs_admission.admission_form_offer as afo on afo.admission_form_id = af.id

				where af.id = '$FormNo'";
		$row = $this->db->query($query);
		return $row->result();
	}



	public function getFeeBill_OfferDate($FeeBillID){
		$query = "select
			af.offer_date
			from atif_gs_admission.admission_form as af where af.id = $FeeBillID";
		$row = $this->db->query($query);
		return $row->result();
	}




	public function feeBillCheck($GBID){
		$result = false;
		$query = "select * from atif_fee_student.fee_bill where gb_id = '$GBID'";
		$query_result = $this->db->query($query);
		if ( $query_result->num_rows() > 0){
			$result = true;
		}
		return $result;
	}



	public function updateFeeBill($GBID, $BillIssueDate, $BillDueDate, $BillValidityDate, $BillPayable, $ConcessionCode, $ConcessionPerc, $AdmissionFee, $SecurityDeposit){
		$this->load->library('session');
		$query = "update atif_fee_student.fee_bill set 
			bill_issue_date = '$BillIssueDate',
			bill_due_date = '$BillDueDate',
			bill_bank_valid_date = '$BillValidityDate',
			bill_payable = $BillPayable,
			total_payable = $BillPayable,
			fee_d_l1 = '$ConcessionCode',
			fee_a_discount = $ConcessionPerc,
			admission_fee = $AdmissionFee,
			security_deposit = $SecurityDeposit,
			modified = unix_timestamp(),
			modified_by = " . (int)$this->session->userdata("user_id") . "

			where gb_id = '$GBID'";
			$query_result = $this->db->query($query);
	}


	public function insertFeeBill($GBID, $BillIssueDate, $BillDueDate, $BillValidityDate, $BillPayable, $ConcessionCode, $ConcessionPerc, $AdmissionFee, $SecurityDeposit){
		$this->load->library('session');
		$FeeBIllTypeID = 1;
		$AcademicSessionID = 13;
		$BillCycleNo = 0;
		$BillTitle = 'Admission';
		$BillMonths = 0;
		$StudentID = 7060;
		$query = "insert into atif_fee_student.fee_bill (fee_bill_type_id, gb_id, academic_session_id, bill_cycle_no, bill_title, 
		bill_issue_date, bill_due_date, bill_bank_valid_date, bill_months, student_id, fee_a, fee_a_discount, fee_d_l1, fee_d_l2, fee_b, fee_b_discount,
		adjustment, arrears_suspended, gross_tuition_fee, additional_charges, total_current_bill, oc_smartcard_charges, oc_smartcard_ids, oc_magazine,
		oc_surcharge, oc_suspended, oc_adv_tax, oc_late_fee, oc_yearly, waive_amount, admission_fee, security_deposit, bill_payable, total_payable, is_void,
		created, register_by, modified, modified_by, record_deleted) values
		('$FeeBIllTypeID', '$GBID', $AcademicSessionID, $BillCycleNo, '$BillTitle', '$BillIssueDate', '$BillDueDate', '$BillValidityDate', $BillMonths, $StudentID, '', $ConcessionPerc, '$ConcessionCode', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, $AdmissionFee, $SecurityDeposit, $BillPayable, $BillPayable,
		0, unix_timestamp(), " . (int)$this->session->userdata("user_id") . ", unix_timestamp(), " . (int)$this->session->userdata("user_id") . ", 0)";
		$query_result = $this->db->query($query);
	}























	public function getGFID_of_FormID($FormID)
	{
		$cQuery = "select * from atif_gs_admission.admission_form where id = $FormID";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}

	/***** FIF *****
	****************/
	public function checkGSID_from_ClassList($GSID){
		$result = false;

		$query=$this->db->query("SELECT gs_id FROM atif.class_list WHERE gs_id = '" . $GSID . "'"); 
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			if($row['gs_id'] != ''){
				$result=true;
			}
		}

		return $result;
	}

	public function checkGSID($GSID){
		$result = false;

		$query=$this->db->query("SELECT gs_id FROM atif.student_registered WHERE gs_id = '" . $GSID . "'"); 
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			if($row['gs_id'] != ''){
				$result=true;
			}
		}

		return $result;
	}


	public function getStudentInfo($GSID)
	{
		$cQuery = "select * from atif.class_list where gs_id = '" . $GSID . "' group by gs_id";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}


	public function getStudentGRNO($GSID)
	{
		$cQuery = "select * from atif.class_list where gs_id = '" . $GSID . "'";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
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

	public function makeGFID_Num($ID){
		$makeGFID_Num = "";
		$makeGFID_Num = str_replace("-", "", $ID);

		return $makeGFID_Num;
	}


	public function getGFID($GSID){
		$getGFID = 0;

		$query=$this->db->query("SELECT gf_id FROM atif.student_registered WHERE gs_id = '" . $GSID . "'"); 
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$getGFID = $row['gf_id'];
		}

		return $getGFID;
	}

	
	public function getSiblingsInfo($GFID)
	{
		$cQuery = "";
		if(substr($GFID, 0, 2) == 18){
		$cQuery = "
			select '99999' as student_id, '99999' as gr_no, af.form_no as gs_id, af.gf_id, af.official_name, '' as abridged_name,
			af.call_name, af.gender, af.dob, '' as nationality_1, '' as nationality_2, '' as religion, 2018 as year_of_admission,
			af.grade_name as grade_of_admission, '' as previous_school, '' as mobile_phone, '' as email, '' as facebook, '' as linkedin,
			9 as siblings_position, 0 as record_deleted, '' as generation_of, '' as previous_class, '' as detain, af.grade_id, '' as section_id,
			'' as rfid_dec_no, '' as rfid_hex_no, af.grade_name, '' as section_name, 'admission' as student_status_name, '' as house_name,
			'' as house_red, '' as house_green, '' as house_blue, '' as house_color_hex, '' as academic_session_id, '' as std_status_code, '' as tax_nic
			from atif_gs_admission.admission_form as af where gf_id = $GFID
			group by gs_id 
			order by grade_id desc";
		} else {

			$cQuery = "select * from
			(select * from
			(select * from atif.students_all
				where gf_id = $GFID
							union
							select '99999' as student_id, '99999' as gr_no, af.form_no as gs_id, af.gf_id, af.official_name, '' as abridged_name,
							af.call_name, af.gender, af.dob, '' as nationality_1, '' as nationality_2, '' as religion, 2018 as year_of_admission,
							af.grade_name as grade_of_admission, '' as previous_school, '' as mobile_phone, '' as email, '' as facebook, '' as linkedin,
							9 as siblings_position, 0 as record_deleted, '' as generation_of, '' as previous_class, '' as detain, af.grade_id, '' as section_id,
							'' as rfid_dec_no, '' as rfid_hex_no, af.grade_name, '' as section_name, 'admission' as student_status_name, '' as house_name,
							'' as house_red, '' as house_green, '' as house_blue, '' as house_color_hex, '' as academic_session_id, '' as std_status_code, '' as tax_nic
							from atif_gs_admission.admission_form as af where gf_id = $GFID
							group by gs_id
							order by grade_id desc
			) as data
			order by year_of_admission asc
			) as data
			group by dob, official_name";
		}
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	    				
    	
   		return $row;
	}

	public function getParentStaffInfo($GFID)
	{
		$cQuery = "select * from
			(select * from atif.students_family_staff
			where record_deleted = 0 and gf_id = $GFID

			union

			select fr.father_nic, fr.gf_id, '' as rfid_dec, '' as rfid_hex, fr.father_name, '' as staff_id, '' as employee_id,
			'' as staff_name, '' as staff_gender, '' as nationality_1, '' as nationality_2, fr.father_mobile as mobile_phone,
			fr.father_email as email, '' as marital_status, 1 as parent_type, '' as yod, '' as speciality, '' as profession,
			'' as created, '' as register_by, '' as modified, '' as modified_by, '' as record_deleted
			from atif_gs_admission.family_registration as fr
			where fr.gf_id = $GFID

			union

			select fr.mother_nic, fr.gf_id, '' as rfid_dec, '' as rfid_hex, fr.mother_name, '' as staff_id, '' as employee_id,
			'' as staff_name, '' as staff_gender, '' as nationality_1, '' as nationality_2, fr.mother_mobile as mobile_phone,
			fr.mother_email as email, 'M' as marital_status, 2 as parent_type, '' as yod, '' as speciality, '' as profession,
			'' as created, '' as register_by, '' as modified, '' as modified_by, '' as record_deleted
			from atif_gs_admission.family_registration as fr
			where fr.gf_id = $GFID) as data
			order by rfid_dec desc, parent_type asc
			limit 2";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}


	public function getHomeInfo($GFID)
	{
		$cQuery = "select '' as id, fr.gf_id, fr.home_phone as phone,
		'' as address_1, '' as address_2, fr.home_apartment_no as apartment_no, fr.home_building_name as building_name,
		fr.home_plot_no as plot_no, fr.home_street_name as street_name, fr.home_subregion as sub_region, fr.home_region as region,
		'Karachi' as city, 'Father' as primary_sms, 'Father' as primary_phone, 'Father' as primary_email,
		'' as created, '' as register_by, '' as modified, '' as modified_by, 0 as record_deleted
		from atif_gs_admission.family_registration as fr
		where fr.gf_id = $GFID
		order by id desc
		limit 1";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}


	public function getParentsInfo($GFID)
	{
		$cQuery = "select * from
			(select '' as id, fr.father_nic as nic, fr.gf_id, fr.father_name as name, '' as first_name, '' as last_name,
			'' as abridged_name, '' as call_name, '' as nationality_1, '' as nationality_2, fr.father_mobile as mobile_phone,
			fr.father_email as email, 'Married' as marital_status, 1 as parent_type, '' as yod, '' as speciality, 
			if(fr.father_occupation = 'NA' or fr.father_occupation = 'N/A', '', fr.father_occupation) as profession,
			if(fr.father_qualification = 'NA' or fr.father_qualification = 'N/A', '', fr.father_qualification) as qualification,
			if(fr.father_designation = 'NA' or fr.father_designation = 'N/A', '', fr.father_designation) as designation,
			if(fr.father_department = 'NA' or fr.father_department = 'N/A', '', fr.father_department) as department,
			if(fr.father_company = 'NA' or fr.father_company = 'N/A', '', fr.father_company) as organization,
			if(fr.father_office_location = 'NA' or fr.father_office_location = 'N/A', '', fr.father_office_location) as office_location,
			if(fr.father_work_phone = 'NA' or fr.father_work_phone = 'N/A', '', fr.father_work_phone) as office_phone,
			'' as rfid_dec, '' as rfid_hex, '' as created, '' as register_by, '' as modified, '' as modified_by,
			0 as record_deleted
			from atif_gs_admission.family_registration as fr
			where fr.gf_id = $GFID

			union

			select '' as id, fr.mother_nic as nic, fr.gf_id, fr.mother_name as name, '' as first_name, '' as last_name,
			'' as abridged_name, '' as call_name, '' as nationality_1, '' as nationality_2, fr.mother_mobile as mobile_phone,
			fr.mother_email as email, 'Married' as marital_status, 2 as parent_type, '' as yod, '' as speciality, 
			if(fr.mother_occupation = 'NA' or fr.mother_occupation = 'N/A', '', fr.mother_occupation) as profession,
			if(fr.mother_qualification = 'NA' or fr.mother_qualification = 'N/A', '', fr.mother_qualification) as qualification,
			if(fr.mother_designation = 'NA' or fr.mother_designation = 'N/A', '', fr.mother_designation) as designation,
			if(fr.mother_department = 'NA' or fr.mother_department = 'N/A', '', fr.mother_department) as department,
			if(fr.mother_company = 'NA' or fr.mother_company = 'N/A', '', fr.mother_company) as organization,
			if(fr.mother_office_location = 'NA' or fr.mother_office_location = 'N/A', '', fr.mother_office_location) as office_location,
			if(fr.mother_work_phone = 'NA' or fr.mother_work_phone = 'N/A', '', fr.mother_work_phone) as office_phone,
			'' as rfid_dec, '' as rfid_hex, '' as created, '' as register_by, '' as modified, '' as modified_by,
			0 as record_deleted
			from atif_gs_admission.family_registration as fr
			where fr.gf_id = $GFID) as data
			order by id asc, parent_type asc
			limit 2";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}


	public function getECInfo($GFID)
	{
		$cQuery = "select * from atif.student_family_ec where gf_id = " . $GFID . " order by created desc limit 1";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}


	public function getFatherQualification($GFID)
	{
		$cQuery = "select * from atif.student_family_qualification where gf_id = " . $GFID . " and parent_type = 1 and record_deleted = 0 order by created desc limit 2";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}

	public function getMotherQualification($GFID)
	{
		$cQuery = "select * from atif.student_family_qualification where gf_id = " . $GFID . " and parent_type = 2 and record_deleted = 0 order by created desc limit 2";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}

	public function getFatherWorkDetail($GFID)
	{
		$cQuery = "select * from atif.student_family_work_detail where gf_id = " . $GFID . " and parent_type = 1 and record_deleted = 0 order by created desc limit 1";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}

	public function getMotherWorkDetail($GFID)
	{
		$cQuery = "select * from atif.student_family_work_detail where gf_id = " . $GFID . " and parent_type = 2 and record_deleted = 0 order by created desc limit 1";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}








	public function getFatherPhotoPath($GFID)
	{
		$getFatherPhotoPath = "xxx";

		$StudentPhotoPath = 'assets/photos/sis/150x150/student/';
		$FatherPhotoPath = 'assets/photos/sis/150x150/father/';
		$MotherPhotoPath = 'assets/photos/sis/150x150/mother/';
		$StaffPhotoPath = 'assets/photos/hcm/150x150/staff/';

		$siblings = $this->getSiblingsInfo($GFID);

		$FatherPhotoFound = false;
		$MotherPhotoFound = false;
		
		foreach ($siblings as $sibling) {			
			if(file_exists($FatherPhotoPath . $sibling['gr_no'] . ".png")){				
				$getFatherPhotoPath = $FatherPhotoPath . $sibling['gr_no'] . ".png";
				$FatherPhotoFound = true;
			}
		}


		$MaritalStatus = $this->getParentsInfo($GFID);
		/*
		// If Staff
		if($FatherPhotoFound == false){
			$ParentStaff = $this->getParentStaffInfo($GFID);
			if($ParentStaff[0]['staff_gender'] == "M"){
				$getFatherPhotoPath = $StaffPhotoPath . $ParentStaff[0]['employee_id'] . ".png";
				$FatherPhotoFound = true;
			}
		}

		// If Divorced		
		if ($FatherPhotoFound == false){			
			if($MaritalStatus[0]['marital_status'] == "Divorced"){
				$getFatherPhotoPath = $FatherPhotoPath . "PicDivorce_Dark.png";
				$FatherPhotoFound = true;
			}
		}

		// If Late
		if ($FatherPhotoFound == false){
			if($MaritalStatus[0]['yod'] == "Late"){
				$getFatherPhotoPath = $FatherPhotoPath . "PicLate_Dark.png";
				$FatherPhotoFound = true;				
			}
		}
		*/

		// If NO photo found
		if($FatherPhotoFound == false){
			$getFatherPhotoPath = $FatherPhotoPath . "NoPic.png";
		}

		
		return $getFatherPhotoPath;
	}



	public function getMotherPhotoPath($GFID)
	{
		$getMotherPhotoPath = "xxx";

		$StudentPhotoPath = 'assets/photos/sis/150x150/student/';
		$FatherPhotoPath = 'assets/photos/sis/150x150/father/';
		$MotherPhotoPath = 'assets/photos/sis/150x150/mother/';
		$StaffPhotoPath = 'assets/photos/hcm/150x150/staff/';

		$siblings = $this->getSiblingsInfo($GFID);

		$FatherPhotoFound = false;
		$MotherPhotoFound = false;
		
		foreach ($siblings as $sibling) {			
			if(file_exists($MotherPhotoPath . $sibling['gr_no'] . ".png")){				
				$getMotherPhotoPath = $MotherPhotoPath . $sibling['gr_no'] . ".png";
				$MotherPhotoFound = true;
			}
		}


		$MaritalStatus = $this->getParentsInfo($GFID);
		/*
		// If Staff
		if($MotherPhotoFound == false){
			$ParentStaff = $this->getParentStaffInfo($GFID);
			if($ParentStaff[0]['staff_gender'] == "F"){
				$getMotherPhotoPath = $StaffPhotoPath . $ParentStaff[0]['employee_id'] . ".png";
				$MotherPhotoFound = true;
			}
		}


		// If Divorced
		if ($MotherPhotoFound == false){
			if($MaritalStatus[1]['marital_status'] == "Divorced"){
				$getMotherPhotoPath = $MotherPhotoPath . "PicDivorce_Dark.png";
				$MotherPhotoFound = true;
			}
		}

		// If Late
		if ($MotherPhotoFound == false){
			if($MaritalStatus[1]['yod'] == "Late"){
				$getMotherPhotoPath = $MotherPhotoPath . "PicLate_Dark.png";
				$MotherPhotoFound = true;
			}
		}
		*/		


		// If NO photo found
		if($MotherPhotoFound == false){
			$getMotherPhotoPath = $MotherPhotoPath . "NoPic.png";
		}

		return $getMotherPhotoPath;
	}


	//============================== A-Level Early Admission Offer =============================//
	//==========================================================================================//

public function offer_detail_by_grade_a_level($grade_id){
		$query = "SELECT
		af.form_id, af.form_no, af.gf_id, IFNULL(af.final_batchslot,'') AS final_batchslot,
		af.official_name AS applicant_name, af.father_name, IFNULL(DATE_FORMAT(af.offer_date, '%a %d, %b %Y'),'') AS offer_date, IFNULL(DATE_FORMAT(of.due_date, '%a %d, %b %Y'),'') AS payment_due_date,


		/********** Offer Details **********/ IF(af.home_apartment_no=''  AND af.home_region='' AND af.home_subregion='', 0, 1) AS is_address, IF(of.due_date='0000-00-00' OR of.due_date IS NULL, 0, 1) AS is_date_of_payment, IF(of.concession_code='' OR of.concession_code IS NULL,0,1) AS is_concession_code, IF(of.joining_date='0000-00-00' OR of.joining_date IS NULL, 0, 1) AS is_activiation_date,
		IF(af.father_qualification <> '' AND af.father_occupation <> '' AND af.father_company <> '' AND af.father_department <> '' AND af.father_office_location <> '' AND af.father_work_phone <> '' AND af.father_designation <> '' AND af.mother_qualification <> '' AND af.mother_occupation <> '' AND af.mother_company <> '' AND af.mother_department <> '' AND af.mother_office_location <> '' AND af.mother_work_phone <> '' AND af.mother_designation <> '',1,0) as is_family_detail,IF(af.previous_school_id <> 0 AND af.previous_grade <> 0,1,0) as is_previous_school_grade,
		/********** Offer Details - END **********/


		/********** Offer Preparation **********/ IFNULL(of.offer_letter,'') AS is_printed_offer_letter,IFNULL(of.early_admission_offer_letter,'') AS is_early_admission_printed_offer_letter,IFNULL(of.early_admission_print_fee_bill,'') AS is_early_admission_print_fee_bill, IFNULL(of.fif_form,'') AS is_printed_fif, IFNULL(of.photo_token,'') AS is_printed_photo_token, IFNULL(of.hand_book,'') AS is_handbook,
		/********** Offer Preparation - END **********/


		/********** Offer Submission **********/ IFNULL(of.signed_offer_letter,'') AS is_signed_offer_letter, IFNULL(of.early_admission_signed_offer_letter,'') AS is_early_admission_signed_offer_letter,IFNULL(of.completed_fif_form,'') AS is_complete_fif_form, IFNULL(of.signed_hand_book,'') AS is_signed_hand_book, IFNULL(of.print_fee_bill,'') AS is_printed_fee_bill,IFNULL(of.early_admission_offer_pack_handover,'') as early_admission_offer_pack_handover,IFNULL(of.offer_pack_handover,'') as offer_pack_handover,
		/********** Offer Submission - END **********/


		/********** Status **********/ IF(af.form_id=allocation.admission_form_id,1,0) AS allocation, IF(af.form_id=communication.admission_form_id,1,0) AS communication, IF(af.form_id=reminder.admission_form_id,1,0) AS reminder, IF(af.form_id=presence.admission_form_id,1,0) AS presence, IF(af.form_id=followup.admission_form_id,1,0) AS followup,
		/********** Status - END **********/


		/********** Form Fields **********/
		af.home_apartment_no, af.home_street_name, af.home_building_name,
		af.home_plot_no, af.home_region, af.home_subregion, IFNULL(of.due_date,'') AS due_date, IFNULL(of.concession_code,'') AS concession_code, IFNULL(of.concession_perc,'') AS concession_perc, IFNULL(of.joining_date,'') AS joining_date
		/********** Form Fields - END **********/
		FROM atif_gs_admission.view_admission_form AS af
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
		WHERE af.grade_id = 15 AND af.form_status_id >= 5 AND (af.form_status_stage_id = 3 OR af.form_status_stage_id = 1 OR af.form_status_stage_id = 10 /*OR af.form_status_stage_id = 12 */ OR af.form_status_stage_id = 2 OR af.form_status_stage_id = 11 OR af.form_status_stage_id = 7) AND af.form_discussion_criteria = 'EAO'";
		$row = $this->db->query($query);
		return $row->result();
	}

	//============================= Regular Admission Offer ==============================//
	//====================================================================================//

	// public function get_a_level_regular_admission(){

	// 	$query = "select
	// 	af.form_id, af.form_no, af.gf_id, IFNULL(af.final_batchslot,'') as final_batchslot,af.form_discussion_criteria,
	// 	af.official_name as applicant_name, af.father_name, af.alevel_checklist,
	// 	IFNULL(DATE_FORMAT(af.offer_date, '%a %d, %b %Y'),'') as offer_date,
	// 	IFNULL(DATE_FORMAT(of.due_date, '%a %d, %b %Y'),'') as payment_due_date,af.form_submission_date,af.grade_name,af.father_mobile,af.mother_mobile,


	// 	/********** Offer Details **********/
	// 	IF(af.home_apartment_no='' AND af.home_street_name='' AND af.home_building_name=''
	// 		AND af.home_plot_no='' AND af.home_region='' AND af.home_subregion='', 0, 1) as is_address,
	// 	IF(of.due_date='0000-00-00' OR of.due_date is null, 0, 1) as is_date_of_payment, 
	// 	IF(of.concession_code='' OR of.concession_code is null,0,1) AS is_concession_code,
	// 	IF(of.joining_date='0000-00-00' OR of.joining_date is null, 0, 1) as is_activiation_date,
	// 	/********** Offer Details - END **********/


	// 	/********** Offer Preparation **********/
	// 	IFNULL(of.offer_letter,'') as is_printed_offer_letter, IFNULL(of.fif_form,'') as is_printed_fif, 
	// 	IFNULL(of.photo_token,'') as is_printed_photo_token, IFNULL(of.hand_book,'') as is_handbook,
	// 	/********** Offer Preparation - END **********/


	// 	/********** Offer Submission **********/
	// 	IFNULL(of.signed_offer_letter,'') as is_signed_offer_letter, IFNULL(of.completed_fif_form,'') as is_complete_fif_form,
	// 	IFNULL(of.signed_hand_book,'') as is_signed_hand_book, IFNULL(of.print_fee_bill,'') as is_printed_fee_bill,
	// 	/********** Offer Submission - END **********/


	// 	/********** Status **********/
	// 	IF(af.form_id=allocation.admission_form_id,1,0) as allocation,
	// 	IF(af.form_id=communication.admission_form_id,1,0) as communication,
	// 	IF(af.form_id=reminder.admission_form_id,1,0) as reminder,
	// 	IF(af.form_id=presence.admission_form_id,1,0) as presence,
	// 	IF(af.form_id=followup.admission_form_id,1,0) as followup,
	// 	/********** Status - END **********/


	// 	/********** Form Fields **********/
	// 	af.home_apartment_no, af.home_street_name, af.home_building_name,
	// 	af.home_plot_no, af.home_region, af.home_subregion,
	// 	IFNULL(of.due_date,'') as due_date, IFNULL(of.concession_code,'') as concession_code, 
	// 	IFNULL(of.concession_perc,'') as concession_perc, IFNULL(of.joining_date,'') as joining_date
	// 	/********** Form Fields - END **********/


	// 	from atif_gs_admission.view_admission_form as af

	// 	left join atif_gs_admission.admission_form_offer as of
	// 		on of.admission_form_id = af.form_id

	// 	left join (SELECT admission_form_id
	// 		FROM atif_gs_admission.log_form_status
	// 		where new_form_status=5 and new_form_stage=1
	// 		group by admission_form_id) as allocation
	// 		on allocation.admission_form_id=af.form_id

	// 	left join (SELECT admission_form_id
	// 		FROM atif_gs_admission.log_form_status
	// 		where new_form_status=5 and new_form_stage=2
	// 		group by admission_form_id) as communication
	// 		on communication.admission_form_id=af.form_id

	// 	left join (SELECT admission_form_id
	// 		FROM atif_gs_admission.log_form_status
	// 		where new_form_status=5 and new_form_stage=3
	// 		group by admission_form_id) as reminder
	// 		on reminder.admission_form_id=af.form_id
			
	// 	left join (SELECT admission_form_id
	// 		FROM atif_gs_admission.log_form_status
	// 		where new_form_status=5 and new_form_stage=4
	// 		group by admission_form_id) as presence
	// 		on presence.admission_form_id=af.form_id
			
	// 	left join (SELECT admission_form_id
	// 		FROM atif_gs_admission.log_form_status
	// 		where new_form_status=5 and new_form_stage=5
	// 		group by admission_form_id) as followup
	// 		on followup.admission_form_id=af.form_id
			
			
	// 	where af.form_status_id >= 5 and (af.form_status_stage_id = 3 OR af.form_status_stage_id = 1 OR af.form_status_stage_id = 10 OR af.form_status_stage_id = 12 OR af.form_status_stage_id = 2) and af.form_discussion_criteria = 'RAO'";

	// 	$row = $this->db->query($query);
	// 	return $row->result();
	// }
	public function get_a_level_regular_admission(){

		$query = "select
		af.form_id, af.form_no, af.gf_id, IFNULL(af.final_batchslot,'') as final_batchslot,af.form_discussion_criteria,
		af.official_name as applicant_name, af.father_name, af.alevel_checklist,
		IFNULL(DATE_FORMAT(af.offer_date, '%a %d, %b %Y'),'') as offer_date,
		IFNULL(DATE_FORMAT(of.due_date, '%a %d, %b %Y'),'') as payment_due_date,af.form_submission_date,af.grade_name,af.father_mobile,af.mother_mobile,


		/********** Offer Details **********/
		IF(af.home_apartment_no='' AND af.home_street_name='' AND af.home_building_name=''
			AND af.home_plot_no='' AND af.home_region='' AND af.home_subregion='', 0, 1) as is_address,
		IF(of.due_date='0000-00-00' OR of.due_date is null, 0, 1) as is_date_of_payment, 
		IF(of.concession_code='' OR of.concession_code is null,0,1) AS is_concession_code,
		IF(of.joining_date='0000-00-00' OR of.joining_date is null, 0, 1) as is_activiation_date,
		/********** Offer Details - END **********/


		/********** Offer Preparation **********/
		IFNULL(of.offer_letter,'') as is_printed_offer_letter, IFNULL(of.fif_form,'') as is_printed_fif, 
		IFNULL(of.photo_token,'') as is_printed_photo_token, IFNULL(of.hand_book,'') as is_handbook,
		/********** Offer Preparation - END **********/


		/********** Offer Submission **********/
		IFNULL(of.signed_offer_letter,'') as is_signed_offer_letter, IFNULL(of.completed_fif_form,'') as is_complete_fif_form,
		IFNULL(of.signed_hand_book,'') as is_signed_hand_book, IFNULL(of.print_fee_bill,'') as is_printed_fee_bill,
		/********** Offer Submission - END **********/


		/********** Status **********/
		IF(af.form_id=allocation.admission_form_id,1,0) as allocation,
		IF(af.form_id=communication.admission_form_id,1,0) as communication,
		IF(af.form_id=reminder.admission_form_id,1,0) as reminder,
		IF(af.form_id=presence.admission_form_id,1,0) as presence,
		IF(af.form_id=followup.admission_form_id,1,0) as followup,
		/********** Status - END **********/


		/********** Form Fields **********/
		af.home_apartment_no, af.home_street_name, af.home_building_name,
		af.home_plot_no, af.home_region, af.home_subregion,
		IFNULL(of.due_date,'') as due_date, IFNULL(of.concession_code,'') as concession_code, 
		IFNULL(of.concession_perc,'') as concession_perc, IFNULL(of.joining_date,'') as joining_date
		/********** Form Fields - END **********/


		from atif_gs_admission.view_admission_form as af

		left join atif_gs_admission.admission_form_offer as of
			on of.admission_form_id = af.form_id

		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=1
			group by admission_form_id) as allocation
			on allocation.admission_form_id=af.form_id

		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=2
			group by admission_form_id) as communication
			on communication.admission_form_id=af.form_id

		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=3
			group by admission_form_id) as reminder
			on reminder.admission_form_id=af.form_id
			
		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=4
			group by admission_form_id) as presence
			on presence.admission_form_id=af.form_id
			
		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=5
			group by admission_form_id) as followup
			on followup.admission_form_id=af.form_id
			
			
		where af.form_status_id >= 5 and (af.form_status_stage_id = 3 OR af.form_status_stage_id = 1 OR af.form_status_stage_id = 10/* OR af.form_status_stage_id = 12 */ OR af.form_status_stage_id = 2 OR af.form_status_stage_id = 7 OR af.form_status_stage_id = 11) and af.form_discussion_criteria = 'RAO' and (post_result_verification_approval = 0 || post_result_verification_approval is null)";

		$row = $this->db->query($query);
		return $row->result();
	}


	public function get_a_level_early_admission(){

		$query = "select
		af.form_id, af.form_no, af.gf_id, IFNULL(af.final_batchslot,'') as final_batchslot,af.form_discussion_criteria,
		af.official_name as applicant_name, af.father_name, af.alevel_checklist,
		IFNULL(DATE_FORMAT(af.offer_date, '%a %d, %b %Y'),'') as offer_date,
		IFNULL(DATE_FORMAT(of.due_date, '%a %d, %b %Y'),'') as payment_due_date,af.form_submission_date,af.grade_name,af.father_mobile,af.mother_mobile,

		/********** Offer Details **********/ IF(af.home_apartment_no=''  AND af.home_region='' AND af.home_subregion='', 0, 1) AS is_address, IF(of.due_date='0000-00-00' OR of.due_date IS NULL, 0, 1) AS is_date_of_payment, IF(of.concession_code='' OR of.concession_code IS NULL,0,1) AS is_concession_code, IF(of.joining_date='0000-00-00' OR of.joining_date IS NULL, 0, 1) AS is_activiation_date,
		IF(af.father_qualification <> '' AND af.father_occupation <> '' AND af.father_company <> '' AND af.father_department <> '' AND af.father_office_location <> '' AND af.father_work_phone <> '' AND af.father_designation <> '' AND af.mother_qualification <> '' AND af.mother_occupation <> '' AND af.mother_company <> '' AND af.mother_department <> '' AND af.mother_office_location <> '' AND af.mother_work_phone <> '' AND af.mother_designation <> '',1,0) as is_family_detail,IF(af.previous_school_id <> 0 AND af.previous_grade <> 0,1,0) as is_previous_school_grade,
		/********** Offer Details - END **********/


		/********** Offer Preparation **********/ IFNULL(of.offer_letter,'') AS is_printed_offer_letter,IFNULL(of.early_admission_offer_letter,'') AS is_early_admission_printed_offer_letter,IFNULL(of.early_admission_print_fee_bill,'') AS is_early_admission_print_fee_bill, IFNULL(of.fif_form,'') AS is_printed_fif, IFNULL(of.photo_token,'') AS is_printed_photo_token, IFNULL(of.hand_book,'') AS is_handbook,
		/********** Offer Preparation - END **********/


		/********** Offer Submission **********/ IFNULL(of.signed_offer_letter,'') AS is_signed_offer_letter, IFNULL(of.early_admission_signed_offer_letter,'') AS is_early_admission_signed_offer_letter,IFNULL(of.completed_fif_form,'') AS is_complete_fif_form, IFNULL(of.signed_hand_book,'') AS is_signed_hand_book, IFNULL(of.print_fee_bill,'') AS is_printed_fee_bill,IFNULL(of.early_admission_offer_pack_handover,'') as early_admission_offer_pack_handover,IFNULL(of.offer_pack_handover,'') as offer_pack_handover,
		/********** Offer Submission - END **********/


		/********** Status **********/
		IF(af.form_id=allocation.admission_form_id,1,0) as allocation,
		IF(af.form_id=communication.admission_form_id,1,0) as communication,
		IF(af.form_id=reminder.admission_form_id,1,0) as reminder,
		IF(af.form_id=presence.admission_form_id,1,0) as presence,
		IF(af.form_id=followup.admission_form_id,1,0) as followup,
		/********** Status - END **********/


		/********** Form Fields **********/
		af.home_apartment_no, af.home_street_name, af.home_building_name,
		af.home_plot_no, af.home_region, af.home_subregion,
		IFNULL(of.due_date,'') as due_date, IFNULL(of.concession_code,'') as concession_code, 
		IFNULL(of.concession_perc,'') as concession_perc, IFNULL(of.joining_date,'') as joining_date
		/********** Form Fields - END **********/


		from atif_gs_admission.view_admission_form as af

		left join atif_gs_admission.admission_form_offer as of
			on of.admission_form_id = af.form_id

		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=1
			group by admission_form_id) as allocation
			on allocation.admission_form_id=af.form_id

		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=2
			group by admission_form_id) as communication
			on communication.admission_form_id=af.form_id

		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=3
			group by admission_form_id) as reminder
			on reminder.admission_form_id=af.form_id
			
		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=4
			group by admission_form_id) as presence
			on presence.admission_form_id=af.form_id
			
		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=5
			group by admission_form_id) as followup
			on followup.admission_form_id=af.form_id

		left join  atif_fee_student.fee_bill fb on (IF(length(af.form_no ) >= 5, SUBSTR(fb.gb_id,5,5),SUBSTR(fb.gb_id,6,4)) = af.form_no AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')

		left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)
			
			
		where af.form_status_id >= 5 and (af.form_status_stage_id = 3 OR af.form_status_stage_id = 1 OR af.form_status_stage_id = 10 OR /*af.form_status_stage_id = 12 OR  */ af.form_status_stage_id = 2 OR af.form_status_stage_id = 7 OR af.form_status_stage_id = 11) and af.form_discussion_criteria = 'EAO' and of.early_admission_signed_offer_letter = 1 and fbr.fee_bill_id is not null and post_result_verification_approval = 0";

		$row = $this->db->query($query);
		return $row->result();
	}


	// Get School ids
		public function school_id(){
			$this->ddb = $this->load->database('gs_admission',TRUE);
			$SQLQuery = "SELECT `id` AS School_id, `name` AS School_name FROM `_school`";
			$result = $this->ddb->query( $SQLQuery );
			if( $result->num_rows() > 0 ){
			$grade_list = $result->result_array();
			return $grade_list;
			}else{ return FALSE; }
		}
	// End Grade id	
	

	
	// Get Grade ids
		public function grade_id(){
			$this->ddb2 = $this->load->database('default',TRUE);
			$SQLQuery = "SELECT `id` AS Grade_id, `dname` AS Grade_name FROM `_grade`";
			$result = $this->ddb2->query( $SQLQuery );
			if( $result->num_rows() > 0 ){
			$grade_list = $result->result_array();
			return $grade_list;
			}else{ return FALSE; }
		}
	// End Grade id

			// Insert database
	public function set($table,$data){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		//$this->ddb->trans_start();
		$this->ddb->insert($table, $data);
		return $this->ddb->insert_id();	
		/*if ($this->ddb->trans_status() === FALSE){
            $this->ddb->trans_rollback();
            return FALSE;
        }else{
			return $this->ddb->insert_id();	
		}
		$this->ddb->trans_complete();*/
		
	}

	public function get_school_grade_name($form_id){
		$query = "SELECT s.id AS school_id,s.name AS school_name,g.id AS grade_id,g.name AS grade_name
					FROM atif_gs_admission.admission_form af
					LEFT JOIN atif_gs_admission._school s ON s.id = af.previous_school_id
					LEFT JOIN atif._grade g ON g.id = af.previous_grade
					WHERE af.id = ".$form_id;
		$row = $this->db->query($query);
		return $row->result();

	}


	// GET PARENT DETAIL
	public function get_parent_detail($gf_id){
		$query = "SELECT *
				FROM(
				SELECT sfq.gf_id,sfq.`level`,sfq.parent_type,sfr.profession,sfwd.department,sfwd.organization,sfwd.phone,sfwd.address,sfwd.designation
				FROM atif.student_family_qualification sfq
				LEFT JOIN atif.student_family_work_detail sfwd ON (sfwd.gf_id = sfq.gf_id AND sfwd.parent_type = 1)
				LEFT JOIN atif.student_family_record sfr ON (sfr.gf_id = sfq.gf_id AND sfr.parent_type = 1)
				WHERE sfq.parent_type = 1 AND sfq.gf_id = $gf_id AND sfq.`level` != '' UNION
				SELECT sfq.gf_id,sfq.`level`,sfq.parent_type,sfr.profession,sfwd.department,sfwd.organization,sfwd.phone,sfwd.address,sfwd.designation
				FROM atif.student_family_qualification sfq
				LEFT JOIN atif.student_family_work_detail sfwd ON (sfwd.gf_id = sfq.gf_id AND sfwd.parent_type = 2)
				LEFT JOIN atif.student_family_record sfr ON (sfr.gf_id = sfq.gf_id AND sfr.parent_type = 2)
				WHERE sfq.parent_type = 2 AND sfq.gf_id = $gf_id  AND sfq.`level` != ''
							) AS a
				GROUP BY a.parent_type";
		$row = $this->db->query($query);
		return $row->result();
	}

	// Get Due Date

	public function get_dueDate($form_id){
		$query = "select
					IF(fb.bill_due_date is not null, fb.bill_due_date, 
						DATE_ADD(
					    af.offer_date,
					    INTERVAL 5 + 
					    IF(
					        (WEEK(af.offer_date) <> WEEK(DATE_ADD(af.offer_date, INTERVAL 5 DAY)))
					        OR (WEEKDAY(DATE_ADD(af.offer_date, INTERVAL 5 DAY)) IN (5, 6)),
					        2,
					        0)
					    DAY
					    )
					) as this_date

					from atif_gs_admission.admission_form as af
					left join atif_fee_student.fee_bill as fb
						on fb.gb_id like CONCAT('18%', af.form_no, '%')
						AND fb.bill_title = 'Admission' 
						AND fb.bill_cycle_no = 0 
						AND SUBSTR(fb.bill_issue_date,3,2) = '18' 
						AND LENGTH(fb.gb_id) = 10
					where af.id = $form_id";
		$row = $this->db->query($query);
		return $row->result();
	}

	public function get_Fill_Due_Date($Form_id)
	{
		$query = "select DATE_FORMAT( fo.due_date,'%e %M %Y') as Due_date from atif_gs_admission.admission_form_offer as fo
where fo.admission_form_id=$Form_id";
		$row = $this->db->query($query);
		$return = $row->result();
		return $return[0];
	}

	
		public function offer_detail_by_alevel_form_id($form_id){

		$query = "select
		af.form_id, af.form_no, IFNULL(af.final_batchslot,'') as final_batchslot,
		af.official_name as applicant_name, af.father_name, af.call_name, af.gender, af.grade_name, af.grade_id,
		IFNULL(DATE_FORMAT(af.offer_date, '%a %d, %b %Y'),'') as offer_date,
		IFNULL(DATE_FORMAT(of.due_date, '%a %d, %b %Y'),'') as payment_due_date, af.father_nic, 


		/********** Offer Details **********/
		IF(af.home_apartment_no='' AND af.home_street_name='' AND af.home_building_name=''
			AND af.home_plot_no='' AND af.home_region='' AND af.home_subregion='', 0, 1) as is_address,
		IF(of.due_date='0000-00-00' OR of.due_date is null, 0, 1) as is_date_of_payment, 
		IF(of.concession_code='' OR of.concession_code is null,0,1) AS is_concession_code,
		IF(of.joining_date='0000-00-00' OR of.joining_date is null, 0, 1) as is_activiation_date,
		IF(af.father_qualification <> '' AND af.father_occupation <> '' AND af.father_company <> '' AND af.father_department <> '' AND af.father_office_location <> '' AND af.father_work_phone <> '' AND af.mother_qualification <> '' AND af.mother_occupation <> '' AND af.mother_company <> '' AND af.mother_department <> '' AND af.mother_office_location <> '' AND af.mother_work_phone <> '' ,1,0) as is_family_detail,IF(af.previous_school_id <> 0 AND af.previous_grade <> 0,1,0) as is_previous_school_grade,
		/********** Offer Details - END **********/


		/********** Offer Preparation **********/
		IFNULL(of.offer_letter,'') as is_printed_offer_letter, IFNULL(of.early_admission_offer_letter,'') as is_early_admission_printed_offer_letter,IFNULL(of.fif_form,'') as is_printed_fif, 
		IFNULL(of.photo_token,'') as is_printed_photo_token, IFNULL(of.hand_book,'') as is_handbook,
		/********** Offer Preparation - END **********/


		/********** Offer Submission **********/
		IFNULL(of.signed_offer_letter,'') as is_signed_offer_letter,IFNULL(of.early_admission_signed_offer_letter,'') as is_early_admission_signed_offer_letter, IFNULL(of.completed_fif_form,'') as is_complete_fif_form,
		IFNULL(of.signed_hand_book,'') as is_signed_hand_book, IFNULL(of.print_fee_bill,'') as is_printed_fee_bill,IFNULL(of.early_admission_print_fee_bill,'') as is_early_admission_printed_fee_bill,IFNULL(of.offer_pack_handover,'') as offer_pack_handover,IFNULL(of.early_admission_offer_pack_handover,'') as is_early_offer_pack_handover,
		/********** Offer Submission - END **********/


		/********** Status **********/
		IF(af.form_id=allocation.admission_form_id,1,0) as allocation,
		IF(af.form_id=communication.admission_form_id,1,0) as communication,
		IF(af.form_id=reminder.admission_form_id,1,0) as reminder,
		IF(af.form_id=presence.admission_form_id,1,0) as presence,
		IF(af.form_id=followup.admission_form_id,1,0) as followup,
		/********** Status - END **********/


		/********** Form Fields **********/
		af.home_apartment_no, af.home_street_name, af.home_building_name,
		af.home_plot_no, af.home_region, af.home_subregion,
		IFNULL(of.due_date,'') as due_date, IFNULL(of.concession_code,'') as concession_code, 
		IFNULL(of.concession_perc,'') as concession_perc, IFNULL(of.joining_date,'') as joining_date
		/********** Form Fields - END **********/


		from atif_gs_admission.view_admission_form as af

		left join atif_gs_admission.admission_form_offer as of
			on of.admission_form_id = af.form_id

		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=1
			group by admission_form_id) as allocation
			on allocation.admission_form_id=af.form_id

		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=2
			group by admission_form_id) as communication
			on communication.admission_form_id=af.form_id

		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=3
			group by admission_form_id) as reminder
			on reminder.admission_form_id=af.form_id
			
		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=4
			group by admission_form_id) as presence
			on presence.admission_form_id=af.form_id
			
		left join (SELECT admission_form_id
			FROM atif_gs_admission.log_form_status
			where new_form_status=5 and new_form_stage=5
			group by admission_form_id) as followup
			on followup.admission_form_id=af.form_id
			
			
		where af.form_id = $form_id and af.form_status_id >= 5 and (af.form_status_stage_id = 3 OR af.form_status_stage_id = 1 OR af.form_status_stage_id = 10 OR af.form_status_stage_id = 12 OR af.form_status_stage_id = 2)";
		$row = $this->db->query($query);
		return $row->result();

	}

	public function get_dueDate_early_admission($form_id){
		$query = "select
					IF(fb.bill_due_date is not null, fb.bill_due_date, 
						DATE_ADD(
					    af.offer_date,
					    INTERVAL 5 + 
					    IF(
					        (WEEK(af.offer_date) <> WEEK(DATE_ADD(af.offer_date, INTERVAL 5 DAY)))
					        OR (WEEKDAY(DATE_ADD(af.offer_date, INTERVAL 5 DAY)) IN (5, 6)),
					        2,
					        0)
					    DAY
					    )
					) as this_date

					from atif_gs_admission.admission_form as af
					left join atif_fee_student.fee_bill as fb
						on fb.gb_id like CONCAT('18%', af.form_no, '%')
						AND substr(fb.gb_id ,3,2) = 72 
						AND fb.bill_title = 'Admission'
						AND fb.bill_cycle_no = 0 
						AND SUBSTR(fb.bill_issue_date,3,2) = '18' 
						AND LENGTH(fb.gb_id) = 10
					where  af.id = $form_id";
		$row = $this->db->query($query);
		return $row->result();
	}


	public function get_CheckList($form_id){

		$query = "SELECT af.alevel_checklist,afo.early_admission_signed_offer_letter,af.is_alevel_supplement FROM atif_gs_admission.admission_form af
			left join atif_gs_admission.admission_form_offer afo 
			on (afo.admission_form_id = af.id) 
			 where af.id = ".$form_id;
		$row = $this->db->query($query);
		return $row->result();

	}




}