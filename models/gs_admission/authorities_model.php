<?php
class Authorities_model extends CI_Model{
	private $ddb;
	function __construct(){ parent::__construct(); 
	}
	
	
	
	public function confirm_admission(){
		$this->ddb = $this->load->database('gs_admission',TRUE);	
		$query = "SELECT `af`.`id` AS `form_id`,

`af`.`form_no` AS `form_no`,

`af`.`alevel_checklist` AS `alevel_checklist`,

`af`.`official_name` AS `official_name`,
`af`.`abridged_name` AS `abridged_name`,

`af`.`form_batch_id` AS `form_batch_id`,
`bt`.`batch_category` AS `batch_category`,
`af`.`batch_slot_id` AS `batch_slot_id`,
`bs`.`sno` AS `batch_slot_no`,
`bs`.`time_start` AS `batch_time_submission`,
`af`.`grade_id` AS `grade_id`,
`af`.`grade_name` AS `grade_name`,
`af`.`academic_session_id` AS `academic_session_id`, 

 `af`.`form_status_id` AS `form_status_id`,`st`.`name` AS `status_name`,
 `af`.`form_status_stage_id` AS `form_status_stage_id`,`sg`.`name` AS `stage_name`,
 
 
 DATE_FORMAT(FROM_UNIXTIME(`af`.`created`),'%Y-%m-%d') AS `form_issuance_date`,
 `af`.`form_submission_date` AS `form_submission_date`,
 `af`.`form_assessment_date` AS `form_assessment_date`,
 `af`.`form_discussion_date` AS `form_discussion_date`,
 `af`.`form_discussion_time` AS `form_discussion_time`,


 `af`.`request_grade` AS `RequestGrade`,
 `fr`.`father_name` AS `father_name`,
 `fr`.`father_mobile` AS `father_mobile`,

 `fr`.`mother_name` AS `mother_name`,
 `fr`.`mother_mobile` AS `mother_mobile`,

 `fr`.`home_address` AS `home_address`,
 `fr`.`home_phone` AS `home_phone`,




`fr`.`father_work_phone` AS `father_work_phone`,
 `fr`.`father_email` AS `father_email`,
 `fr`.`mother_company` AS `mother_company`,
 `fr`.`mother_office_location` AS `mother_office_location`,
 `fr`.`mother_work_phone` AS `mother_work_phone`,
 `fr`.`mother_email` AS `mother_email`,
 `fr`.`single_parent` AS `single_parent`,
  IF((`fr`.`primary_contact` = 0),`fr`.`father_mobile`,`fr`.`mother_mobile`) AS `primary_contact`,
  `b`.`id` AS `and_id`,
  `b`.`name` AS `and_batch`, 
  `af`.`form_discussion_result` AS `form_discussion_result`,
  `af`.`form_discussion_decision` AS `form_discussion_decision`,
  `af`.`offer_date` AS `offer_date`, 
  CONCAT(
REPLACE(`bt`.`batch_category`,'-',''),'-', CONVERT(LPAD(`bs`.`sno`,2,'0') USING latin1)) AS `final_batchslot`, 
CONCAT(`bt`.`batch_category`,'-', CONVERT(LPAD(`bs`.`sno`,2,'0') USING latin1)) AS `final_batch_slot`, 
DATE_FORMAT(FROM_UNIXTIME(`af`.`created`),'%Y-%m-%d') AS `issuance_date`, 
FROM_UNIXTIME(`af`.`modified`) AS `modified`
FROM (((((((`atif_gs_admission`.`admission_form` `af`
LEFT JOIN `atif_gs_admission`.`family_registration` `fr` ON((`fr`.`gf_id` = `af`.`gf_id`)))
LEFT JOIN `atif_gs_admission`.`_form_batch` `bt` ON((`bt`.`id` = `af`.`form_batch_id`)))
LEFT JOIN `atif_gs_admission`.`_batch` `b` ON((`b`.`id` = `bt`.`batch_id`)))
LEFT JOIN `atif_gs_admission`.`_form_batch_slots` `bs` ON((`bs`.`id` = `af`.`batch_slot_id`)))
LEFT JOIN `atif_gs_admission`.`_form_status` `st` ON((`st`.`id` = `af`.`form_status_id`)))
LEFT JOIN `atif_gs_admission`.`_form_status_stage` `sg` ON((`sg`.`id` = `af`.`form_status_stage_id`)))
LEFT JOIN `atif`.`staff_registered` `ast` ON((`ast`.`id` = `af`.`form_assessment_result_by`)))
where (af.form_status_id = 5 or af.form_status_id = 6)


GROUP BY `af`.`form_no`
ORDER BY `af`.`form_no`";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
	}
	
	
	public function not_interested(){
		$this->ddb = $this->load->database('gs_admission',TRUE);	
		$query = "SELECT `af`.`id` AS `form_id`,

`af`.`form_no` AS `form_no`,

`af`.`alevel_checklist` AS `alevel_checklist`,

`af`.`official_name` AS `official_name`,
`af`.`abridged_name` AS `abridged_name`,

`af`.`form_batch_id` AS `form_batch_id`,
`bt`.`batch_category` AS `batch_category`,
`af`.`batch_slot_id` AS `batch_slot_id`,
`bs`.`sno` AS `batch_slot_no`,
`bs`.`time_start` AS `batch_time_submission`,
`af`.`grade_id` AS `grade_id`,
`af`.`grade_name` AS `grade_name`,
`af`.`academic_session_id` AS `academic_session_id`, 

 `af`.`form_status_id` AS `form_status_id`,`st`.`name` AS `status_name`,
 `af`.`form_status_stage_id` AS `form_status_stage_id`,`sg`.`name` AS `stage_name`,
 
 
 DATE_FORMAT(FROM_UNIXTIME(`af`.`created`),'%Y-%m-%d') AS `form_issuance_date`,
 `af`.`form_submission_date` AS `form_submission_date`,
 `af`.`form_assessment_date` AS `form_assessment_date`,
 `af`.`form_discussion_date` AS `form_discussion_date`,
 `af`.`form_discussion_time` AS `form_discussion_time`,


 `af`.`request_grade` AS `RequestGrade`,
 `fr`.`father_name` AS `father_name`,
 `fr`.`father_mobile` AS `father_mobile`,

 `fr`.`mother_name` AS `mother_name`,
 `fr`.`mother_mobile` AS `mother_mobile`,

 `fr`.`home_address` AS `home_address`,
 `fr`.`home_phone` AS `home_phone`,




`fr`.`father_work_phone` AS `father_work_phone`,
 `fr`.`father_email` AS `father_email`,
 `fr`.`mother_company` AS `mother_company`,
 `fr`.`mother_office_location` AS `mother_office_location`,
 `fr`.`mother_work_phone` AS `mother_work_phone`,
 `fr`.`mother_email` AS `mother_email`,
 `fr`.`single_parent` AS `single_parent`,
  IF((`fr`.`primary_contact` = 0),`fr`.`father_mobile`,`fr`.`mother_mobile`) AS `primary_contact`,
  `b`.`id` AS `and_id`,
  `b`.`name` AS `and_batch`, 
  `af`.`form_discussion_result` AS `form_discussion_result`,
  `af`.`form_discussion_decision` AS `form_discussion_decision`,
  `af`.`offer_date` AS `offer_date`, 
  CONCAT(
REPLACE(`bt`.`batch_category`,'-',''),'-', CONVERT(LPAD(`bs`.`sno`,2,'0') USING latin1)) AS `final_batchslot`, 
CONCAT(`bt`.`batch_category`,'-', CONVERT(LPAD(`bs`.`sno`,2,'0') USING latin1)) AS `final_batch_slot`, 
DATE_FORMAT(FROM_UNIXTIME(`af`.`created`),'%Y-%m-%d') AS `issuance_date`, 
FROM_UNIXTIME(`af`.`modified`) AS `modified`
FROM (((((((`atif_gs_admission`.`admission_form` `af`
LEFT JOIN `atif_gs_admission`.`family_registration` `fr` ON((`fr`.`gf_id` = `af`.`gf_id`)))
LEFT JOIN `atif_gs_admission`.`_form_batch` `bt` ON((`bt`.`id` = `af`.`form_batch_id`)))
LEFT JOIN `atif_gs_admission`.`_batch` `b` ON((`b`.`id` = `bt`.`batch_id`)))
LEFT JOIN `atif_gs_admission`.`_form_batch_slots` `bs` ON((`bs`.`id` = `af`.`batch_slot_id`)))
LEFT JOIN `atif_gs_admission`.`_form_status` `st` ON((`st`.`id` = `af`.`form_status_id`)))
LEFT JOIN `atif_gs_admission`.`_form_status_stage` `sg` ON((`sg`.`id` = `af`.`form_status_stage_id`)))
LEFT JOIN `atif`.`staff_registered` `ast` ON((`ast`.`id` = `af`.`form_assessment_result_by`)))
where (af.form_status_stage_id = 7)


GROUP BY `af`.`form_no`
ORDER BY `af`.`form_no`";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
	}
	
	
	
	public function regret(){
		$this->ddb = $this->load->database('gs_admission',TRUE);	
		$query = "SELECT `af`.`id` AS `form_id`,

`af`.`form_no` AS `form_no`,

`af`.`alevel_checklist` AS `alevel_checklist`,

`af`.`official_name` AS `official_name`,
`af`.`abridged_name` AS `abridged_name`,

`af`.`form_batch_id` AS `form_batch_id`,
`bt`.`batch_category` AS `batch_category`,
`af`.`batch_slot_id` AS `batch_slot_id`,
`bs`.`sno` AS `batch_slot_no`,
`bs`.`time_start` AS `batch_time_submission`,
`af`.`grade_id` AS `grade_id`,
`af`.`grade_name` AS `grade_name`,
`af`.`academic_session_id` AS `academic_session_id`, 

 `af`.`form_status_id` AS `form_status_id`,`st`.`name` AS `status_name`,
 `af`.`form_status_stage_id` AS `form_status_stage_id`,`sg`.`name` AS `stage_name`,
 
 
 DATE_FORMAT(FROM_UNIXTIME(`af`.`created`),'%Y-%m-%d') AS `form_issuance_date`,
 `af`.`form_submission_date` AS `form_submission_date`,
 `af`.`form_assessment_date` AS `form_assessment_date`,
 `af`.`form_discussion_date` AS `form_discussion_date`,
 `af`.`form_discussion_time` AS `form_discussion_time`,


 `af`.`request_grade` AS `RequestGrade`,
 `fr`.`father_name` AS `father_name`,
 `fr`.`father_mobile` AS `father_mobile`,

 `fr`.`mother_name` AS `mother_name`,
 `fr`.`mother_mobile` AS `mother_mobile`,

 `fr`.`home_address` AS `home_address`,
 `fr`.`home_phone` AS `home_phone`,




`fr`.`father_work_phone` AS `father_work_phone`,
 `fr`.`father_email` AS `father_email`,
 `fr`.`mother_company` AS `mother_company`,
 `fr`.`mother_office_location` AS `mother_office_location`,
 `fr`.`mother_work_phone` AS `mother_work_phone`,
 `fr`.`mother_email` AS `mother_email`,
 `fr`.`single_parent` AS `single_parent`,
  IF((`fr`.`primary_contact` = 0),`fr`.`father_mobile`,`fr`.`mother_mobile`) AS `primary_contact`,
  `b`.`id` AS `and_id`,
  `b`.`name` AS `and_batch`, 
  `af`.`form_discussion_result` AS `form_discussion_result`,
  `af`.`form_discussion_decision` AS `form_discussion_decision`,
  `af`.`offer_date` AS `offer_date`, 
  CONCAT(
REPLACE(`bt`.`batch_category`,'-',''),'-', CONVERT(LPAD(`bs`.`sno`,2,'0') USING latin1)) AS `final_batchslot`, 
CONCAT(`bt`.`batch_category`,'-', CONVERT(LPAD(`bs`.`sno`,2,'0') USING latin1)) AS `final_batch_slot`, 
DATE_FORMAT(FROM_UNIXTIME(`af`.`created`),'%Y-%m-%d') AS `issuance_date`, 
FROM_UNIXTIME(`af`.`modified`) AS `modified`
FROM (((((((`atif_gs_admission`.`admission_form` `af`
LEFT JOIN `atif_gs_admission`.`family_registration` `fr` ON((`fr`.`gf_id` = `af`.`gf_id`)))
LEFT JOIN `atif_gs_admission`.`_form_batch` `bt` ON((`bt`.`id` = `af`.`form_batch_id`)))
LEFT JOIN `atif_gs_admission`.`_batch` `b` ON((`b`.`id` = `bt`.`batch_id`)))
LEFT JOIN `atif_gs_admission`.`_form_batch_slots` `bs` ON((`bs`.`id` = `af`.`batch_slot_id`)))
LEFT JOIN `atif_gs_admission`.`_form_status` `st` ON((`st`.`id` = `af`.`form_status_id`)))
LEFT JOIN `atif_gs_admission`.`_form_status_stage` `sg` ON((`sg`.`id` = `af`.`form_status_stage_id`)))
LEFT JOIN `atif`.`staff_registered` `ast` ON((`ast`.`id` = `af`.`form_assessment_result_by`)))
where (af.form_status_stage_id = 15)


GROUP BY `af`.`form_no`
ORDER BY `af`.`form_no`";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
	}
	
	public function all_applications(){
		$this->ddb = $this->load->database('gs_admission',TRUE);	
		$query = "SELECT `af`.`id` AS `form_id`,

`af`.`form_no` AS `form_no`,

`af`.`alevel_checklist` AS `alevel_checklist`,

`af`.`official_name` AS `official_name`,
`af`.`abridged_name` AS `abridged_name`,

`af`.`form_batch_id` AS `form_batch_id`,
`bt`.`batch_category` AS `batch_category`,
`af`.`batch_slot_id` AS `batch_slot_id`,
`bs`.`sno` AS `batch_slot_no`,
`bs`.`time_start` AS `batch_time_submission`,
`af`.`grade_id` AS `grade_id`,
`af`.`grade_name` AS `grade_name`,
`af`.`academic_session_id` AS `academic_session_id`, 

 `af`.`form_status_id` AS `form_status_id`,`st`.`name` AS `status_name`,
 `af`.`form_status_stage_id` AS `form_status_stage_id`,`sg`.`name` AS `stage_name`,
 
 
 DATE_FORMAT(FROM_UNIXTIME(`af`.`created`),'%Y-%m-%d') AS `form_issuance_date`,
 `af`.`form_submission_date` AS `form_submission_date`,
 `af`.`form_assessment_date` AS `form_assessment_date`,
 `af`.`form_discussion_date` AS `form_discussion_date`,
 `af`.`form_discussion_time` AS `form_discussion_time`,


 `af`.`request_grade` AS `RequestGrade`,
 `fr`.`father_name` AS `father_name`,
 `fr`.`father_mobile` AS `father_mobile`,

 `fr`.`mother_name` AS `mother_name`,
 `fr`.`mother_mobile` AS `mother_mobile`,

 `fr`.`home_address` AS `home_address`,
 `fr`.`home_phone` AS `home_phone`,




`fr`.`father_work_phone` AS `father_work_phone`,
 `fr`.`father_email` AS `father_email`,
 `fr`.`mother_company` AS `mother_company`,
 `fr`.`mother_office_location` AS `mother_office_location`,
 `fr`.`mother_work_phone` AS `mother_work_phone`,
 `fr`.`mother_email` AS `mother_email`,
 `fr`.`single_parent` AS `single_parent`,
  IF((`fr`.`primary_contact` = 0),`fr`.`father_mobile`,`fr`.`mother_mobile`) AS `primary_contact`,
  `b`.`id` AS `and_id`,
  `b`.`name` AS `and_batch`, 
  `af`.`form_discussion_result` AS `form_discussion_result`,
  `af`.`form_discussion_decision` AS `form_discussion_decision`,
  `af`.`offer_date` AS `offer_date`, 
  CONCAT(
REPLACE(`bt`.`batch_category`,'-',''),'-', CONVERT(LPAD(`bs`.`sno`,2,'0') USING latin1)) AS `final_batchslot`, 
CONCAT(`bt`.`batch_category`,'-', CONVERT(LPAD(`bs`.`sno`,2,'0') USING latin1)) AS `final_batch_slot`, 
DATE_FORMAT(FROM_UNIXTIME(`af`.`created`),'%Y-%m-%d') AS `issuance_date`, 
FROM_UNIXTIME(`af`.`modified`) AS `modified`
FROM (((((((`atif_gs_admission`.`admission_form` `af`
LEFT JOIN `atif_gs_admission`.`family_registration` `fr` ON((`fr`.`gf_id` = `af`.`gf_id`)))
LEFT JOIN `atif_gs_admission`.`_form_batch` `bt` ON((`bt`.`id` = `af`.`form_batch_id`)))
LEFT JOIN `atif_gs_admission`.`_batch` `b` ON((`b`.`id` = `bt`.`batch_id`)))
LEFT JOIN `atif_gs_admission`.`_form_batch_slots` `bs` ON((`bs`.`id` = `af`.`batch_slot_id`)))
LEFT JOIN `atif_gs_admission`.`_form_status` `st` ON((`st`.`id` = `af`.`form_status_id`)))
LEFT JOIN `atif_gs_admission`.`_form_status_stage` `sg` ON((`sg`.`id` = `af`.`form_status_stage_id`)))
LEFT JOIN `atif`.`staff_registered` `ast` ON((`ast`.`id` = `af`.`form_assessment_result_by`)))


GROUP BY `af`.`form_no`
ORDER BY `af`.`form_no`";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
	}
	
	
	public function wait_list(){
		$this->ddb = $this->load->database('gs_admission',TRUE);	
		$query = "select af.* from atif_gs_admission.view_admission_form as af where (af.form_status_stage_id = 17)";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
	}
	
	
	public function on_hold(){
		$this->ddb = $this->load->database('gs_admission',TRUE);	
		$query = "select af.*, on_hold.modified_new, on_hold.day_diff
			from atif_gs_admission.view_admission_form as af
			left join (select lgs.*, 
				DATE_FORMAT(from_unixtime(lgs.modified), '%a %d, %b %Y') as modified_new, 
				DATEDIFF(curdate(), from_unixtime(lgs.modified)) as day_diff
				from atif_gs_admission.log_form_status as lgs 
				where lgs.new_form_stage = 16) as on_hold
				on on_hold.admission_form_id = af.form_id
			where (af.form_status_stage_id = 16)";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
	}
	
	// All Application for administrator North Campus
	public function allAppAdmin(){
		$this->ddb = $this->load->database('gs_admission',TRUE);	
		$query = "select af.*
			from atif_gs_admission.view_admission_form as af
			where (af.form_status_stage_id = 17)
			UNION
			select
			af.*
			from atif_gs_admission.view_admission_form as af
			where (af.form_status_stage_id = 16)
			ORDER BY form_no";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
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
     * Request For Grade function table data
	 * ---------------------------------------------
     * @param   string  $tablename
     * @param   array  	$set_data
     * @param   array 	$where
     * @return  integer
	 * ----------------------------------------------
     */
	public function requestForGrade(){
		$this->ddb = $this->load->database('gs_admission',TRUE);	
		$query = "select af.* from atif_gs_admission.view_admission_form as af where af.RequestGrade=1 order by form_id desc";
		
		$result = $this->ddb->query( $query );
		
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
		}
	// ------------------------------------------------
	
	//  return form submitted or not
	public function check_form_submitted($form_id){
		$this->ddb = $this->load->database('gs_admission',TRUE);	
		$query = "select * from atif_gs_admission.admission_form where id = ".$form_id." and form_assessment_date = '0000-00-00'";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
		
	}
	
	
		/**
	 * ---------------------------------------------
     *  Create Form Submission Assessment Date
	 * ---------------------------------------------
     * @return  array $row, 
	 * ----------------------------------------------
     */
	public function creatAssessmentdate2($grade_id){
		$this->ddb = $this->load->database('gs_admission',TRUE);
//and bs.form_batch_id='.$formBatchId.'		
$SQLQuery = 'select
bt.grade_id, gg.name as grade_name, bs.id as slot_id, bs.sno, bs.time_start, admission_form_id, revised_batch_slot_id, bs.form_batch_id,
bt.batch_category, bt.id as batch_id, bt.date as batch_date
from atif_gs_admission._form_batch_slots as bs
left join atif_gs_admission._form_batch as bt
on bt.id = bs.form_batch_id
left join atif._grade as gg
on gg.id = bt.grade_id
where bs.admission_form_id = 0 and revised_batch_slot_id = 0
and bt.grade_id = '.$grade_id.'
and bt.date > curdate()
order by form_batch_id, time_start
limit 1';
			$result = $this->ddb->query( $SQLQuery );
			if( $result->num_rows() > 0 ){
			$grade_list = $result->row_array();
			return $grade_list;
			}else{ return FALSE; }
	}
	// 
	
	
		/**
	 * ----------------------------------------------------
     *  Get Form Already Assigned Slot Id 
	 * ----------------------------------------------------
	 * @db atif_gs_admission
	 * @tablename _form_batch_slots
	 * @param integer $form_id
     * @return  array $result,
	 * ----------------------------------------------------
     */
		public function getFormSlot2($form_id){
			$this->ddb = $this->load->database('gs_admission',TRUE);
			$SQLQuery =  'select id as aSlotID from atif_gs_admission._form_batch_slots where admission_form_id='.$form_id.' order by id desc limit 1';
				$result = $this->ddb->query( $SQLQuery );
				if( $result->num_rows() > 0 ){
				$grade_list = $result->row_array();
				return $grade_list;
				}else{ return FALSE; }
		}
	// End getGradeFormBatch($grade_id)
	
} //Authorities modal	