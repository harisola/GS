<?php
class Frontoffice_followup_model extends CI_Model{
	private $ddb;
	
	function __construct(){ parent::__construct(); }

	
	
	/**
	 * ---------------------------------------------
     * Get Follow up forms which were not submitted
	 * Due date crossed
	 * ---------------------------------------------
     * @param   string  $current_date
     * @return   array 	
     * ----------------------------------------------
     */
	 
		public function getFollowupFormsFrontOffice($current_date){
		$this->ddb = $this->load->database('gs_admission',TRUE);

			$query = "SELECT
form_id, form_no, form_submission_date, day_diff as day_passed, grade_name,
IF(day_diff = 1, '(1 day ago)', CONCAT('(', day_diff, ' days ago)')) as day_diff,
applicant_name, father_name, father_mobile, mother_mobile, current_standing,
current_status_1

FROM
(select
af.id as form_id, af.form_no, af.form_submission_date, af.grade_name,
/***** Current Date is here *****/
DATEDIFF(CURDATE(), af.form_submission_date) as day_diff,
af.official_name as applicant_name,
fr.father_name, fr.father_mobile, fr.mother_mobile,
'Submission' as current_standing, IF(af.grade_id <= 2 or af.grade_id = 17,'Submission, Assessment and Discussion Date expired','Submission and Assessment Date Expired') as current_status_1

from atif_gs_admission.admission_form as af
left join atif_gs_admission.family_registration as fr
    on fr.gf_id = af.gf_id
where af.form_assessment_date < CURDATE()
and af.form_submission_date < CURDATE() /***** Current Date is here *****/
and af.form_status_stage_id != 7
and af.form_status_stage_id != 6
and af.form_status_stage_id != 15
and af.form_status_stage_id != 20
) AS SUBMISSION_FOLLOWUP




UNION


SELECT
form_id, form_no, form_discussion_date as form_submission_date, day_diff as day_passed, grade_name,
IF(day_diff = 1, '(1 day ago)', CONCAT('(', day_diff, ' days ago)')) as day_diff,
applicant_name, father_name, father_mobile, mother_mobile, current_standing,
current_status_1

FROM
(select
af.id as form_id, af.form_no, af.form_discussion_date, af.grade_name,
/***** Current Date is here *****/
DATEDIFF(CURDATE(), af.form_discussion_date) as day_diff,
af.official_name as applicant_name,
fr.father_name, fr.father_mobile, fr.mother_mobile,
lgs.thisDate,
'Discussion' as current_standing, 'Discussion Date expired' as current_status_1

from atif_gs_admission.admission_form as af
left join atif_gs_admission.family_registration as fr
    on fr.gf_id = af.gf_id
left join (select lgs.admission_form_id, from_unixtime(lgs.modified) as thisDate 
	from atif_gs_admission.log_form_status lgs
	where lgs.new_form_status = 4
	and lgs.new_form_stage = 4) as lgs
	on lgs.admission_form_id = af.id


where af.offer_date = '0000-00-00'
and af.form_discussion_date != '0000-00-00'
and af.form_discussion_date != '2001-01-01'
and af.form_discussion_date < CURDATE() /***** Current Date is here *****/
and lgs.thisDate is null
and af.form_status_stage_id != 7
and af.form_status_stage_id != 6
and af.form_status_stage_id != 15
and af.form_status_stage_id != 20
) AS DISCUSSION_FOLLOWUP


UNION


SELECT
form_id, form_no, offer_date as form_submission_date, day_diff as day_passed, grade_name,
IF(day_diff = 1, '(1 day ago)', CONCAT('(', day_diff, ' days ago)')) as day_diff,
applicant_name, father_name, father_mobile, mother_mobile, current_standing,
current_status_1

FROM
(select
af.id as form_id, af.form_no, af.offer_date, af.grade_name,
/***** Current Date is here *****/
DATEDIFF(CURDATE(), af.offer_date) as day_diff,
af.official_name as applicant_name,
fr.father_name, fr.father_mobile, fr.mother_mobile, 
'Offer' as current_standing, 'Offer Pack Not Received By Parents' as current_status_1

from atif_gs_admission.admission_form as af
left join atif_gs_admission.family_registration as fr
    on fr.gf_id = af.gf_id
left join atif_gs_admission.admission_form_offer as afo
	on afo.admission_form_id = af.id


where af.offer_date != '0000-00-00'
and af.offer_date != '2001-01-01'
and af.offer_date < CURDATE() /***** Current Date is here *****/
and af.form_status_stage_id != 7
and afo.signed_offer_letter = 0
and af.form_status_stage_id != 6
and af.form_status_stage_id != 15
and af.form_status_stage_id != 20
and afo.print_fee_bill = 1
) AS OFFER_FOLLOWUP



UNION

SELECT
form_id, form_no, offer_date as form_submission_date, day_diff as day_passed, grade_name,
IF(day_diff = 1, '(1 day ago)', CONCAT('(', day_diff, ' days ago)')) as day_diff,
applicant_name, father_name, father_mobile, mother_mobile, current_standing,
current_status_1

FROM
(select
af.id as form_id, af.form_no, af.offer_date, af.grade_name,
/***** Current Date is here *****/
DATEDIFF(CURDATE(), af.offer_date) as day_diff,
af.official_name as applicant_name,
fr.father_name, fr.father_mobile, fr.mother_mobile, 
'Fee Bill' as current_standing, 'Due Date expired' as current_status_1

from atif_gs_admission.admission_form as af
left join atif_gs_admission.family_registration as fr
    on fr.gf_id = af.gf_id
left join atif_gs_admission.admission_form_offer as afo
	on afo.admission_form_id = af.id
left join atif_fee_student.fee_bill as fb
	on (SUBSTR(fb.gb_id, 6, 4) = af.form_no AND LEFT(fb.gb_id, 2) != '17')
left join atif_fee_student.fee_bill_received as fbr
	on fbr.fee_bill_id = fb.id


where fb.student_id = 7060
and fb.bill_due_date < CURDATE()
and af.form_status_stage_id != 7
and af.form_status_stage_id != 6
and af.form_status_stage_id != 15
and af.form_status_stage_id != 20
and af.offer_date != '0000-00-00'
and afo.signed_offer_letter = 1
group by af.id
) AS FeeBill_FOLLOWUP
order by form_no";



			$result = $this->ddb->query( $query );
			if( $result->num_rows() > 0 ){
				$results = $result->result_array();
				return $results;
				//echo $this->ddb->last_query();
			}else{ return FALSE; }
		}
	// end set

	
	
	
	
	/**
	 * ---------------------------------------------
     * Get Forms which in Cummunication Stage
	 * Due date crossed
	 * ---------------------------------------------
     * @param   string  $current_date
     * @return   array 	
     * ----------------------------------------------
     */
	 
	public function getFOFormsInCommunicationStage($current_date){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$query = "SELECT
		af.form_id, af.form_no, af.form_submission_date, af.grade_name,
		'' AS day_diff, '' AS day_passed,
		af.official_name AS applicant_name,
		fr.father_name, fr.father_mobile, fr.mother_mobile,
		af.status_name AS current_standing, '' AS current_status_1
FROM atif_gs_admission.view_admission_form AS af
LEFT JOIN atif_gs_admission.family_registration AS fr ON fr.gf_id = af.gf_id
LEFT JOIN atif_gs_admission.admission_form_offer afo ON afo.admission_form_id = af.form_id
WHERE ((af.form_status_id != 1 AND af.form_status_id != 2 AND af.form_status_stage_id = 2 AND afo.print_fee_bill = 1) OR af.form_status_stage_id = 18) UNION
SELECT
af.id AS form_id, af.form_no, af.form_submission_date, af.grade_name,
/***** Current Date is here *****/ DATEDIFF(CURDATE(), af.offer_date) AS day_diff,'' AS day_passed,
af.official_name AS applicant_name,
fr.father_name, fr.father_mobile, fr.mother_mobile, 
'Admission Complete Check' AS current_standing, 'Admission Complete Check Expire' AS current_status_1
FROM atif_gs_admission.admission_form AS af
LEFT JOIN atif_gs_admission.family_registration AS fr ON fr.gf_id = af.gf_id
LEFT JOIN atif_gs_admission.admission_form_offer AS afo ON afo.admission_form_id = af.id
LEFT JOIN atif_fee_student.fee_bill AS fb ON (SUBSTR(fb.gb_id, 6, 4) = af.form_no AND
LEFT(fb.gb_id, 2) != '17')
LEFT JOIN atif_fee_student.fee_bill_received AS fbr ON fbr.fee_bill_id = fb.id
WHERE fb.student_id <> 7060 AND fbr.id IS NOT NULL AND af.form_status_stage_id != 7 AND af.form_status_stage_id != 6 AND af.form_status_stage_id != 15 AND af.form_status_stage_id != 20 AND af.offer_date != '0000-00-00' AND afo.signed_offer_letter = 1 AND (afo.completed_fif_form = 0 OR afo.signed_hand_book = 0)";
			$result = $this->ddb->query( $query );
			if( $result->num_rows() > 0 ){
				$results = $result->result_array();
				return $results;
				//echo $this->ddb->last_query();
			}else{ return FALSE; }
		}
	// end set
	
	
	/**
	 * ---------------------------------------------
     * Get Forms which in All Applicant Stage
	 * Due date crossed
	 * ---------------------------------------------
     * @param   string  $current_date
     * @return   array 	
     * ----------------------------------------------
     */
	 
		public function getFOFormsInAllApplicantStage($current_date){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$query = "select * from(

		SELECT * FROM
(SELECT
form_id, form_no, form_submission_date, day_diff as day_passed, grade_name,
IF(day_diff = 1, '(1 day ago)', CONCAT('(', day_diff, ' days ago)')) as day_diff,
applicant_name, father_name, father_mobile, mother_mobile, current_standing,
current_status_1

FROM
(select
af.id as form_id, af.form_no, af.form_submission_date, af.grade_name,
/***** Current Date is here *****/
DATEDIFF(CURDATE(), af.form_submission_date) as day_diff,
af.official_name as applicant_name,
fr.father_name, fr.father_mobile, fr.mother_mobile, 
'Submission' as current_standing, 'Submission Date expired' as current_status_1

from atif_gs_admission.admission_form as af
left join atif_gs_admission.family_registration as fr
    on fr.gf_id = af.gf_id


where af.form_assessment_date = '0000-00-00'
and af.form_submission_date < CURDATE() /***** Current Date is here *****/
) AS SUBMISSION_FOLLOWUP



UNION



SELECT
form_id, form_no, form_assessment_date as form_submission_date, day_diff as day_passed, grade_name,
IF(day_diff = 1, '(1 day ago)', CONCAT('(', day_diff, ' days ago)')) as day_diff,
applicant_name, father_name, father_mobile, mother_mobile, current_standing,
current_status_1

FROM
(select
af.id as form_id, af.form_no, af.form_assessment_date, af.grade_name,
/***** Current Date is here *****/
DATEDIFF(CURDATE(), af.form_assessment_date) as day_diff,
af.official_name as applicant_name,
fr.father_name, fr.father_mobile, fr.mother_mobile, 
'Assessment' as current_standing, 'Assessment Date expired' as current_status_1

from atif_gs_admission.admission_form as af
left join atif_gs_admission.family_registration as fr
    on fr.gf_id = af.gf_id


where af.form_discussion_date = '0000-00-00'
and af.form_assessment_date != '0000-00-00'
and af.form_assessment_date != '2001-01-01'
and af.form_assessment_date < CURDATE() /***** Current Date is here *****/
) AS ASSESSMENT_FOLLOWUP


UNION


SELECT
form_id, form_no, form_discussion_date as form_submission_date, day_diff as day_passed, grade_name,
IF(day_diff = 1, '(1 day ago)', CONCAT('(', day_diff, ' days ago)')) as day_diff,
applicant_name, father_name, father_mobile, mother_mobile, current_standing,
current_status_1

FROM
(select
af.id as form_id, af.form_no, af.form_discussion_date, af.grade_name,
/***** Current Date is here *****/
DATEDIFF(CURDATE(), af.form_discussion_date) as day_diff,
af.official_name as applicant_name,
fr.father_name, fr.father_mobile, fr.mother_mobile, 
'Assessment' as current_standing, 'Discussion Date expired' as current_status_1

from atif_gs_admission.admission_form as af
left join atif_gs_admission.family_registration as fr
    on fr.gf_id = af.gf_id


where af.offer_date = '0000-00-00'
and af.form_discussion_date != '0000-00-00'
and af.form_discussion_date != '2001-01-01'
and af.form_discussion_date < CURDATE() /***** Current Date is here *****/
) AS DISCUSSION_FOLLOWUP


UNION


SELECT
form_id, form_no, offer_date as form_submission_date, day_diff as day_passed, grade_name,
IF(day_diff = 1, '(1 day ago)', CONCAT('(', day_diff, ' days ago)')) as day_diff,
applicant_name, father_name, father_mobile, mother_mobile, current_standing,
current_status_1

FROM
(select
af.id as form_id, af.form_no, af.offer_date, af.grade_name, 
/***** Current Date is here *****/
DATEDIFF(CURDATE(), af.offer_date) as day_diff,
af.official_name as applicant_name,
fr.father_name, fr.father_mobile, fr.mother_mobile, 
'Assessment' as current_standing, 'Offer Date expired' as current_status_1

from atif_gs_admission.admission_form as af
left join atif_gs_admission.family_registration as fr
    on fr.gf_id = af.gf_id


where af.offer_date != '0000-00-00'
and af.offer_date != '2001-01-01'
and af.offer_date < CURDATE() /***** Current Date is here *****/
) AS OFFER_FOLLOWUP



UNION


select
af.form_id, af.form_no, af.form_submission_date, 
 '' as day_passed, af.grade_name, '' as day_diff,
af.official_name as applicant_name,
fr.father_name, fr.father_mobile, fr.mother_mobile, 
af.status_name as current_standing, '' as current_status_1
from atif_gs_admission.view_admission_form as af
left join atif_gs_admission.family_registration as fr
on fr.gf_id = af.gf_id
where af.form_status_id != 1
and af.form_status_id != 2
and af.form_status_stage_id = 2) AS DATA

ORDER BY form_no, day_diff asc) as data
group by form_no";


			$result = $this->ddb->query( $query );
			if( $result->num_rows() > 0 ){
				$results = $result->result_array();
				return $results;
				//echo $this->ddb->last_query();
			}else{ return FALSE; }
		}
	// end set
	
	
	
	
	/**
	 * ---------------------------------------------
     * Simple Insert Function
	 * ---------------------------------------------
     * @param   string  $tablename
     * @param   array  	$set_data
     * @param   array 	$where
     * @return  integer
	 * ----------------------------------------------
     */
	 
	public function insertData( $table, $data ){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$this->ddb->insert($table, $data);
		return $this->ddb->insert_id();	
	}
	
	
	/**
	 * ---------------------------------------------
     * Fucntion for form give time slot
	 * ---------------------------------------------
     * @form_id   integer  $form_id
    
	 * ----------------------------------------------
     */
	 
	public function giveSlot($form_id){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$query = 'select * from atif_gs_admission._form_batch_slots where admission_form_id='.$form_id.' and revised_batch_slot_id=0';
		$result = $this->ddb->query( $query );
			if( $result->num_rows() > 0 ){
				$results = $result->row_array();
				return $results;
			}else{ return FALSE; }
			
	}
	
	
	/**
	 * ---------------------------------------------
     * Overwrite/Update function table data
	 * ---------------------------------------------
     * @param   string  $tablename
     * @param   array  	$set_data
     * @param   array 	$where
     * @return  integer
	 * ----------------------------------------------
     */
		public function update_function($tablename, $set_data, $where){ 
			$this->ddb = $this->load->database('gs_admission',TRUE);
			$this->ddb->where( $where );
			$this->ddb->update($tablename, $set_data );
			return $this->ddb->affected_rows();
		}
	// ------------------------------------------------
	
	
	/**
	 * ---------------------------------------------
     * Get Avialable Slot batch slot wise
	 * ---------------------------------------------
     */
	public function getAvailableSlotBatch_Slot_Wise($batch_id, $slot_id ){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		
		//$query ='select id from atif_gs_admission._form_batch_slots as s where s.form_batch_id= '.$batch_id.' and s.time_start = "'.$slot_id.'"';
		
		$query ='select id from atif_gs_admission._form_batch_slots as s where id = "'.$slot_id.'"';
		
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->row_array();
			return $results;
		}else{ return FALSE; }
	}
	
	
	/**
	 * ---------------------------------------------
     * Get Available Batch Slot grade Wise
	 * ---------------------------------------------
     */
	public function getAvailable_Batch_Slot_grade_Wise( $grade_id ){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		
		$query ="select
bt.grade_id, gg.name as grade_name, bs.id as slot_id, bs.sno, bs.time_start, admission_form_id, revised_batch_slot_id, bs.form_batch_id,
bt.batch_category, bt.id as batch_id, bt.date as batch_date
from atif_gs_admission._form_batch_slots as bs
left join atif_gs_admission._form_batch as bt
on bt.id = bs.form_batch_id
left join atif._grade as gg
on gg.id = bt.grade_id
where bs.admission_form_id = 0 and bs.revised_batch_slot_id = 0
and bt.grade_id = ".$grade_id."
order by form_batch_id, time_start";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
	}
	
	
	/**
	 * ---------------------------------------------
     * Get Get All Information About Applicant Form 
	 * ---------------------------------------------
     */
	public function getFormInfo($form_id){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$query ="select * from atif_gs_admission.admission_form where id = ".$form_id."";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->row_array();
			return $results;
		}else{ return FALSE; }
		
	}
	
	/**
	 * ---------------------------------------------
     * Get Get All Information About Applicant Form 
	 * ---------------------------------------------
     */
	public function getBatchInfo($grade_id){
		$this->ddb = $this->load->database('gs_admission',TRUE);
	

$query = "SELECT
formBatchID, batch_category as batchCategory, batch_date as BDate
FROM
(select
gg.id as grade_id, gg.name as grade_name, bt.batch_category, bt.date as batch_date, bt.time_start, bt.time_end, bt.duration_per_slot,
IF(no_of_slots.total_slots is null, '',
    CONCAT(IFNULL(available_slots.total_slots, 0), ' / ' , IFNULL(no_of_slots.total_slots, 0))) AS no_of_slots,
IFNULL(available_slots.total_slots, 0) AS available_slots, IFNULL(no_of_slots.total_slots, 0) as total_slots, bt.id as formBatchID
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


where available_slots > 0
and batch_date > curdate()
and grade_id = ".$grade_id."";
		
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
		
	}
	
	
	public function getBatchSlot($batch_id){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$query ="select id, time_start from atif_gs_admission._form_batch_slots where form_batch_id=".$batch_id." and admission_form_id=0";
			$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
	}
	
	
	/**
	 * ---------------------------------------------
     * Get Get All Comments About Applicant Form 
	 * ---------------------------------------------
     */
	public function getFormComments($form_id){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$query = "select * from atif_gs_admission.log_form_comments where admission_form_id=".$form_id."";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
		
	}
	// End Form Comments
	
	
	
	/**
	 * ---------------------------------------------
     * 	Get Get All Comments About Applicant Form 
	 * ---------------------------------------------
	 * Back up 23 - 12 - 2016
     */
	public function getFormCommentsLogs_bak($form_id){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$query = "
		SELECT * FROM
(
/************************************************* Form Issuance
*****************************************************************/
select
af.id as admission_form_id, FROM_UNIXTIME(af.created) as change_date,
CONCAT('Admission form issued', ' on ', DATE_FORMAT(FROM_UNIXTIME(af.created), '%d-%b-%Y %h:%i %p')) as message,
'Issuance' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name
from atif_gs_admission.admission_form as af
left join atif.staff_registered as sr
	on sr.user_id = af.register_by
where af.id = ".$form_id." /***** Change Form ID *****/

UNION

/*************************************************** Form Status
*****************************************************************/
select
lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date,
CONCAT(fst_new.name, ' on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
'Status' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name

from atif_gs_admission.log_form_status as lgs
left join atif_gs_admission._form_status as fst_old
	on fst_old.id = lgs.old_form_status
left join atif_gs_admission._form_status as fst_new
	on fst_new.id = lgs.new_form_status
left join atif.staff_registered as sr
	on sr.user_id = lgs.modified_by
where lgs.admission_form_id = ".$form_id." /***** Change Form ID *****/	
UNION
/********************************************* Form Status Stage
*****************************************************************/
select
lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date,
CONCAT(fst_new.name, ' on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
'Stage' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name

from atif_gs_admission.log_form_status as lgs
left join atif_gs_admission._form_status_stage as fst_old
	on fst_old.id = lgs.old_form_stage
left join atif_gs_admission._form_status_stage as fst_new
	on fst_new.id = lgs.new_form_stage
left join atif.staff_registered as sr
	on sr.user_id = lgs.modified_by
where lgs.admission_form_id = ".$form_id." /***** Change Form ID *****/	
	


UNION



/************************************************* Form Comments
*****************************************************************/
select
com.admission_form_id, FROM_UNIXTIME(com.created) as change_date,
com.comments as message, 'Comments' as type,
sr.employee_id as photo_id, sr.abridged_name as staff_name

from atif_gs_admission.log_form_comments as com
left join atif.staff_registered as sr
	on sr.user_id = com.register_by
		
	
) AS DATA


order by admission_form_id, change_date;
		";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
		
	}
	
	
	
	
	/**
	 * ---------------------------------------------
     * 	Get Get All Comments About Applicant Form 
	 * ---------------------------------------------
	 */
	public function getFormHistoryLogs($form_id){
		$this->ddb = $this->load->database('gs_admission',TRUE);
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
where lgs.admission_form_id = ".$form_id."  /***** Change Form ID *****/    
and lgs.new_form_status = 3 and lgs.new_form_stage = 4
group by admission_form_id


UNION



/*********************************** Form Status Stage - Beyond 5
*****************************************************************/
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
and lgs.type = 'G' and lgs.new_form_status >= 5


UNION



/************************************************* Form Comments
*****************************************************************/
select
com.admission_form_id, FROM_UNIXTIME(com.created) as change_date, IF(com.reason = '', '', CONCAT(com.reason, ' on ', DATE_FORMAT(FROM_UNIXTIME(com.created), '%a %d, %b %Y %h:%i %p'))) as reason,
com.comments as message, 'Comments' as type,
sr.employee_id as photo_id, sr.abridged_name as staff_name, 4 as this_order

from atif_gs_admission.log_form_comments as com
left join atif.staff_registered as sr
    on sr.user_id = com.register_by
        
where com.admission_form_id = ".$form_id." /***** Change Form ID *****/        
) AS DATA


order by admission_form_id, change_date, this_order";
$result = $this->ddb->query( $query );
	if( $result->num_rows() > 0 ){
		$results = $result->result_array();
		return $results;
	}else{ return FALSE; }
	
}




public function getFormBatchByBatchId($ID){
	
$this->ddb = $this->load->database('gs_admission',TRUE);
$query = "select `date` as assessmentDate from atif_gs_admission._form_batch where id=".$ID."";
$result = $this->ddb->query( $query );
if( $result->num_rows() > 0 ){
$results = $result->row_array();
return $results;
}else{ return FALSE; }	

}
	public function get_requested_form($form_id){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$query = "select id from atif_gs_admission.admission_form where id=".$form_id." and request_grade=2 limit 1";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			return TRUE;
		}else{ 
			return FALSE; 
		}

	}
	
	public function extend_fee_bill_due_date( $form_no,$selected_date ){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$query = "update atif_fee_student.fee_bill
				set bill_due_date = '".$selected_date."',
				bill_bank_valid_date = '".$selected_date."'
				where student_id = 7060
				and SUBSTR(gb_id, 6, 4) = ". $form_no."";

		$this->ddb->query( $query );
		return TRUE;
		

		
	}

	public function get_offer_user_expire(){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$query = "SELECT
			form_id, form_no, offer_date as form_submission_date, day_diff as day_passed, grade_name,
			IF(day_diff = 1, '(1 day ago)', CONCAT('(', day_diff, ' days ago)')) as day_diff,
			applicant_name, father_name, father_mobile, mother_mobile, current_standing,
			current_status_1

			FROM
			(select
			af.id as form_id, af.form_no, af.offer_date, af.grade_name,
			/***** Current Date is here *****/
			DATEDIFF(CURDATE(), af.offer_date) as day_diff,
			af.official_name as applicant_name,
			fr.father_name, fr.father_mobile, fr.mother_mobile, 
			'Offer' as current_standing, 'Offer User Expire' as current_status_1

			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.family_registration as fr
			    on fr.gf_id = af.gf_id
			left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id


			where af.offer_date != '0000-00-00'
			and af.offer_date != '2001-01-01'
			and af.offer_date < CURDATE() /***** Current Date is here *****/
			and af.form_status_stage_id != 7
			and af.form_status_stage_id != 6
			and af.form_status_stage_id != 15
and af.form_status_stage_id != 20
			and (afo.print_fee_bill is null or afo.print_fee_bill = 0)
			 ) as OFFER_USER_EXPIRE";

			$result = $this->ddb->query( $query );
			if( $result->num_rows() > 0 ){
				$results = $result->result_array();
				return $results;
			}else{ 
				return FALSE; 
			}
	}

	public function update_discussion_date($form_no,$discussion_date){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$query = "UPDATE atif_gs_admission.admission_form af SET af.form_discussion_date = '".$discussion_date."' WHERE af.form_no = '".$form_no."'";
		$result = $this->ddb->query($query);
		return $result;
	}

	public function update_offer_date($form_no,$offer_date){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$query = "UPDATE atif_gs_admission.admission_form af SET af.offer_date = '".$offer_date."' WHERE af.form_no = '".$form_no."'";
		$result = $this->ddb->query($query);
		return $result;
	}



		public function get_followup_hold(){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$query = "SELECT
form_id, form_no, form_submission_date, day_diff as day_passed, grade_name,
IF(day_diff = 1, '(1 day ago)', CONCAT('(', day_diff, ' days ago)')) as day_diff,
applicant_name, father_name, father_mobile, mother_mobile, current_standing,
current_status_1

FROM
(select
af.id as form_id, af.form_no, af.form_submission_date, af.grade_name,
/***** Current Date is here *****/
DATEDIFF(CURDATE(), af.form_submission_date) as day_diff,
af.official_name as applicant_name,
fr.father_name, fr.father_mobile, fr.mother_mobile,
'Submission' as current_standing, 'Submission Date expired' as current_status_1

from atif_gs_admission.admission_form as af
left join atif_gs_admission.family_registration as fr
    on fr.gf_id = af.gf_id
where af.form_assessment_date = '0000-00-00'
and af.form_submission_date < CURDATE() /***** Current Date is here *****/
and af.form_status_stage_id = 20
#and from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 30 day )

) AS SUBMISSION_FOLLOWUP

UNION
SELECT
form_id, form_no, form_assessment_date as form_submission_date, day_diff as day_passed, grade_name,
IF(day_diff = 1, '(1 day ago)', CONCAT('(', day_diff, ' days ago)')) as day_diff,
applicant_name, father_name, father_mobile, mother_mobile, current_standing,
current_status_1

FROM
(select
af.id as form_id, af.form_no, af.form_assessment_date, af.grade_name,
/***** Current Date is here *****/
DATEDIFF(CURDATE(), af.form_assessment_date) as day_diff,
af.official_name as applicant_name,
fr.father_name, fr.father_mobile, fr.mother_mobile,
'Assessment' as current_standing, 'Assessment Date expired' as current_status_1

from atif_gs_admission.admission_form as af
left join atif_gs_admission.family_registration as fr
    on fr.gf_id = af.gf_id
left join (select lgs.admission_form_id, from_unixtime(lgs.modified) as thisDate 
	from atif_gs_admission.log_form_status lgs
	where lgs.new_form_status = 3
	and lgs.new_form_stage = 4) as lgs
	on lgs.admission_form_id = af.id


where af.form_discussion_result = ''
and af.form_assessment_date != '0000-00-00'
and af.form_assessment_date != '2001-01-01'
and af.form_assessment_date < CURDATE() /***** Current Date is here *****/
and lgs.thisDate is null

and af.form_status_stage_id = 20
#and from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 30 day )
) AS ASSESSMENT_FOLLOWUP


UNION


SELECT
form_id, form_no, form_discussion_date as form_submission_date, day_diff as day_passed, grade_name,
IF(day_diff = 1, '(1 day ago)', CONCAT('(', day_diff, ' days ago)')) as day_diff,
applicant_name, father_name, father_mobile, mother_mobile, current_standing,
current_status_1

FROM
(select
af.id as form_id, af.form_no, af.form_discussion_date, af.grade_name,
/***** Current Date is here *****/
DATEDIFF(CURDATE(), af.form_discussion_date) as day_diff,
af.official_name as applicant_name,
fr.father_name, fr.father_mobile, fr.mother_mobile,
lgs.thisDate,
'Discussion' as current_standing, 'Discussion Date expired' as current_status_1

from atif_gs_admission.admission_form as af
left join atif_gs_admission.family_registration as fr
    on fr.gf_id = af.gf_id
left join (select lgs.admission_form_id, from_unixtime(lgs.modified) as thisDate 
	from atif_gs_admission.log_form_status lgs
	where lgs.new_form_status = 4
	and lgs.new_form_stage = 4) as lgs
	on lgs.admission_form_id = af.id


where af.offer_date = '0000-00-00'
and af.form_discussion_date != '0000-00-00'
and af.form_discussion_date != '2001-01-01'
and af.form_discussion_date < CURDATE() /***** Current Date is here *****/
and lgs.thisDate is null
and af.form_status_stage_id = 20
#and from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 30 day )

) AS DISCUSSION_FOLLOWUP


UNION


SELECT
form_id, form_no, offer_date as form_submission_date, day_diff as day_passed, grade_name,
IF(day_diff = 1, '(1 day ago)', CONCAT('(', day_diff, ' days ago)')) as day_diff,
applicant_name, father_name, father_mobile, mother_mobile, current_standing,
current_status_1

FROM
(select
af.id as form_id, af.form_no, af.offer_date, af.grade_name,
/***** Current Date is here *****/
DATEDIFF(CURDATE(), af.offer_date) as day_diff,
af.official_name as applicant_name,
fr.father_name, fr.father_mobile, fr.mother_mobile, 
'Offer' as current_standing, 'Offer Pack Not Received By Parents' as current_status_1

from atif_gs_admission.admission_form as af
left join atif_gs_admission.family_registration as fr
    on fr.gf_id = af.gf_id
left join atif_gs_admission.admission_form_offer as afo
	on afo.admission_form_id = af.id


where af.offer_date != '0000-00-00'
and af.offer_date != '2001-01-01'
and af.offer_date < CURDATE() /***** Current Date is here *****/
and af.form_status_stage_id = 20
and afo.print_fee_bill = 1

#and from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 30 day )


) AS OFFER_FOLLOWUP



UNION

SELECT
form_id, form_no, offer_date as form_submission_date, day_diff as day_passed, grade_name,
IF(day_diff = 1, '(1 day ago)', CONCAT('(', day_diff, ' days ago)')) as day_diff,
applicant_name, father_name, father_mobile, mother_mobile, current_standing,
current_status_1

FROM
(select
af.id as form_id, af.form_no, af.offer_date, af.grade_name,
/***** Current Date is here *****/
DATEDIFF(CURDATE(), af.offer_date) as day_diff,
af.official_name as applicant_name,
fr.father_name, fr.father_mobile, fr.mother_mobile, 
'Fee Bill' as current_standing, 'Due Date expired' as current_status_1

from atif_gs_admission.admission_form as af
left join atif_gs_admission.family_registration as fr
    on fr.gf_id = af.gf_id
left join atif_gs_admission.admission_form_offer as afo
	on afo.admission_form_id = af.id
left join atif_fee_student.fee_bill as fb
	on (SUBSTR(fb.gb_id, 6, 4) = af.form_no AND LEFT(fb.gb_id, 2) != '17')
left join atif_fee_student.fee_bill_received as fbr
	on fbr.fee_bill_id = fb.id


where fb.student_id = 7060
and fb.bill_due_date < CURDATE()

and af.form_status_stage_id = 20
and af.offer_date != '0000-00-00'
and afo.signed_offer_letter = 1
and from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 30 day )

group by af.id
) AS FeeBill_FOLLOWUP
order by form_no";

			$result = $this->ddb->query( $query );
			if( $result->num_rows() > 0 ){
				$results = $result->result_array();
				return $results;
			}else{ 
				return FALSE; 
			}
	}

	// GET Admission Data
	public function get_admission_data($form_id){
		$query = "SELECT * FROM atif_gs_admission.admission_form where id = '".$form_id."'";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ 
				return FALSE; 
		}
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
	
}
?>