<?php
class Submission_model extends CI_Model{
	private $ddb;
	
	function __construct(){ parent::__construct(); }

	
// Get list of Admission Form
public function getDataByFormNo($form_no){
$this->ddb = $this->load->database('gs_admission',TRUE);
$query = "select 
af.id AS Form_id,
af.form_no AS Form_no,
af.token_no AS Token_no,
af.gf_id AS Gf_id,
af.official_name AS Applicate_name,
af.call_name AS Call_name,
af.dob AS Dob,
af.referal_code,
af.student_nic AS Student_nic,
af.student_mobile AS Student_mobile,
af.student_email AS Student_email,
af.is_alevel_supplement AS Alevel_supplement,
af.alevel_checklist AS Alevel_checklist,
af.form_batch_id AS Batch_id,
af.batch_slot_id AS Slot_id,
af.form_discussion_date AS Form_discussion_date,
af.form_discussion_time AS Form_discussion_time,
af.gender AS Gender,
af.is_photo_submitted AS Photo_submitted,
af.is_birthcrt_o AS Birth_o,
af.is_birthcrt_c AS Birth_c,
af.grade_id AS Grade_id,
af.grade_name AS Grade_name,
af.academic_session_id AS Academic,
af.form_status_id AS Form_status,
af.previous_school_id AS PS_id,
af.previous_grade AS PG_id,
af.form_submission_date as Submission_date,
af.campus AS Campus,
af.comments AS Comments,
fr.id as Family_reg_id,
fr.primary_contact as Primary_contact,
fr.father_name AS Father_name,
fr.father_mobile AS Father_mobile,
fr.father_mobile_other AS Father_mobile_other,
fr.father_nic AS Father_nic,
fr.mother_name As Mother_name,
fr.mother_mobile as Mother_mobile,
fr.mother_mobile_other as Mother_mobile_other,
fr.mother_nic as Mother_nic,
fr.father_email as Father_email,
fr.mother_email AS Mother_email,
fr.single_parent as single_parent,
fr.primary_contact as primary_contact
from atif_gs_admission.admission_form AS af left join atif_gs_admission.family_registration AS fr on (fr.gf_id = af.gf_id )";
$query .= " where af.form_no=".$form_no." ";
$query .= " order by af.id desc";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->row_array();
			return $results;
		}else{ return FALSE; }
	}
	// end set
	

	/*
	 * ------------------------- ---------
	 *  Get Form Batch Slots By ID
	 * -----------------------------------
	*/
		public function getSlots($formBID,$form_id){
			$this->ddb = $this->load->database('gs_admission',TRUE);
			//$query = "select id as slotID, TIME_FORMAT( time_start, '%h:%i %p' ) as Duration from atif_gs_admission._form_batch_slots where form_batch_id = ".$formBID." and admission_form_id = 0 and revised_batch_slot_id=0";
			//$query = "select id as slotID, TIME_FORMAT( time_start, '%h:%i %p' ) as Duration from atif_gs_admission._form_batch_slots";
			
			$query= "select id as slotID, TIME_FORMAT( time_start, '%h:%i %p' ) as Duration from atif_gs_admission._form_batch_slots where 
			form_batch_id=".$formBID." and ( admission_form_id=0 or admission_form_id = ".$form_id." )";
			
			$result = $this->ddb->query( $query );
				if( $result->num_rows() > 0 ){
					$results = $result->result_array();
					return $results;
				}else{ return FALSE; }
			}
	/* ------------------------------ */
	
	
	



/*
	 * ------------------------- ---------
	 *  Get Avaiilable Batches for Grade
	 * -----------------------------------
	*/
		public function batchAvailable($grade_id){
			$this->ddb = $this->load->database('gs_admission',TRUE);
			$query= "	SELECT
*

FROM
(select
gg.id as grade_id, gg.name as grade_name, bt.batch_category, bt.date as batch_date, bt.time_start, bt.time_end, bt.duration_per_slot,
IF(no_of_slots.total_slots is null, '',
	CONCAT(IFNULL(available_slots.total_slots, 0), ' / ' , IFNULL(no_of_slots.total_slots, 0))) AS no_of_slots,
IFNULL(available_slots.total_slots, 0) AS available_slots, IFNULL(no_of_slots.total_slots, 0) as total_slots


from atif_gs_admission._form_batch as bt
left join atif._grade as gg
	on gg.id = bt.grade_id

left join (select 
bs.form_batch_id, count(bs.form_batch_id) as total_slots
from atif_gs_admission._form_batch_slots as bs
group by form_batch_id) as no_of_slots
	on no_of_slots.form_batch_id = bt.id
	
left join (select 
bs.form_batch_id, count(bs.form_batch_id) as total_slots
from atif_gs_admission._form_batch_slots as bs
where bs.admission_form_id = 0
group by form_batch_id) as available_slots
	on available_slots.form_batch_id = bt.id) AS DATA

where grade_id = ".$grade_id."  /***** Change Grade ID here *****/
order by grade_id, batch_date, time_start";
			
			$result = $this->ddb->query( $query );
				if( $result->num_rows() > 0 ){
					$results = $result->result_array();
					return $results;
				}else{ return FALSE; }
			}
	/* ------------------------------ */







	public function getUserInfo($User_id)
	{
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$SQL = "select sr.employee_id as Emp_id from atif.staff_registered as sr where sr.user_id=".$User_id."";
		$result = $this->ddb->query( $SQL );
		if( $result->num_rows() > 0 ){
			$results = $result->row_array();
			return $results;
		}else{ return FALSE; }
		
	}


	
}
?>