<?php
class Billing_confirmation_model extends CI_Model{
	private $ddb;
	function __construct(){ parent::__construct(); }
	
	
	public function billing_confirmation($where=NULL){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		
		$query = "select
			fb.gb_id, fb.form_no, fb.receivable, fb.bill_due_date, fb.fee_bill_id, fb.fee_received_date, fb.fee_received_amount,
			af.official_name, CONCAT(REPLACE(af.batch_category, '-', ''), '-', LPAD(af.batch_slot_no, 2, '0')) as batch_id,
			fb.concession_code, gs_id, af.grade_name
			from (select
			fb.gb_id, mid(fb.gb_id, 6,4) as form_no, fb.total_payable as receivable, DATE_FORMAT(fb.bill_due_date, '%a %d, %b %Y') as bill_due_date,
			CONCAT(left(fb.gb_id, 2), '-', mid(fb.gb_id, 3, 2) ,'-', mid(fb.gb_id, 5,5), '-', right(fb.gb_id, 1)) as fee_bill_id,
			IFNULL(DATE_fORMAT(fbr.received_date, '%a %d, %b %Y'), '') as fee_received_date, IFNULL(fbr.received_amount, '') as fee_received_amount,
			fb.fee_d_l1 as concession_code, IF(sr.id=7060, '', sr.gs_id) as gs_id
			from atif_fee_student.fee_bill as fb
				left join atif_fee_student.fee_bill_received as fbr
					on fbr.fee_bill_id = fb.id
				left join atif.student_registered as sr
					on sr.id = fb.student_id
			where (fb.student_id = 7060 or fb.bill_cycle_no=0) and sr.gs_id like '18-%') as fb

			left join atif_gs_admission.view_admission_form as af
				on af.form_no = fb.form_no";
	if( $where != NULL ){
		$query .= $where;
	}
		
		
		$result = $this->ddb->query( $query );
		
		
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		
		}else{ return FALSE; 
		}
			
	}
	
	
	
	public function bill_mis($from, $to,$from_date=NULL, $to_date=NULL ){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		/*
		$query = "SELECT
gb_id as bill_no, gs_id, official_name, class, additional_late_fee, current_billing_amount, arrears,
amount_before, amount_after, bill_due_date

FROM(select
CONCAT(LEFT(fb.gb_id, 2) , '-0-', SUBSTRING(fb.gb_id, 4, 5), '-', RIGHT(fb.gb_id, 1)) as gb_id,
CONCAT('80-', RIGHT(af.form_no, 3)) as gs_id, af.official_name, af.grade_name as class,
'0' as additional_late_fee, fb.bill_payable as current_billing_amount, fb.adjustment as arrears,
fb.total_payable as amount_before, (fb.total_payable) as amount_after, fb.bill_due_date,
from_unixtime(fb.modified) as bill_created, af.call_name, fb.bill_issue_date

from

atif_fee_student.fee_bill as fb

left join atif_gs_admission.admission_form as af
	on af.form_no = SUBSTRING(fb.gb_id, 5, 4)

where fb.bill_cycle_no = 0
and fb.total_payable > 0
and fb.bill_title = 'Admission'";
*/
	$query = "select
fb.gb_id as bill_no,
IF(sr.gs_id = '', CONCAT(SUBSTRING(fb.gb_id, 7, 2), '-', SUBSTRING(fb.gb_id, 9, 3)), sr.gs_id) as gs_id,
af.official_name, af.grade_name as class,
fb.additional_late_fee, fb.current_billing_amount, fb.arrears,
fb.amount_before, fb.amount_after, fb.bill_due_date


from
(select
	IF(fb.bill_issue_date < '2018-01-01',
		CONCAT(LEFT(fb.gb_id, 2) , '-0-', SUBSTRING(fb.gb_id, 4, 5), '-', RIGHT(fb.gb_id, 1)),
		CONCAT(LEFT(fb.gb_id, 2) , '-', SUBSTRING(fb.gb_id, 3, 2), '-', SUBSTRING(fb.gb_id, 5, 5), '-', RIGHT(fb.gb_id, 1))) as gb_id,
	IF(fb.bill_issue_date < '2018-01-01',
		SUBSTRING(fb.gb_id, 4, 5),
		SUBSTRING(fb.gb_id, 5, 5)) as form_no,
	'0' as additional_late_fee, fb.bill_payable as current_billing_amount, fb.adjustment as arrears,
	fb.total_payable as amount_before, (fb.total_payable) as amount_after, fb.bill_due_date,
	fb.bill_issue_date, from_unixtime(fb.modified) as bill_created,
	fb.student_id
		
	
	from atif_fee_student.fee_bill as fb
	
	where fb.bill_cycle_no = 0
	and fb.total_payable > 0
	and fb.bill_issue_date >= '2018-01-01' ";

if( $from_date != NULL && $to_date != NULL ){
	$query .= "  and ( fb.bill_issue_date  BETWEEN '".$from_date."' AND '".$to_date."') ";
}

$query .= "
) as fb

left join atif_gs_admission.admission_form as af
	on af.form_no = fb.form_no
left join atif.student_registered as sr
	on sr.id = fb.student_id

where af.official_name != ''";

/*
if( $from_date != NULL && $to_date != NULL ){
	$query .= "  and ( fb.bill_issue_date  BETWEEN '".$from_date."' AND '".$to_date."')";
}

$query .= "and fb.academic_session_id>=".$from." and fb.academic_session_id<=".$to."";

$query .= " ) AS DATA";
*/




$result = $this->ddb->query( $query );
		
		
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		
		}else{ return FALSE; 
		}
		
		
		
	}
	
	
	
	function batch_bill(){
		
$this->ddb = $this->load->database('gs_admission',TRUE);
$query = "select * from
					(select
					af.form_id, LPAD(af.form_no, 5, '0') AS form_no,
					if(af.gf_id >= 17000 and af.gf_id <= 18000, '', concat(left(lpad(af.gf_id, 5, 0),2),'-',right(lpad(af.gf_id, 5, 0),3))) as gf_id,
					af.official_name as applicant_name, af.father_name, af.mother_name,
					
					if(af.gender = 'B', 'Boy', 'Girl') as gender, af.sibling, af.pet_code, 
					
					DATE_FORMAT(af.form_issuance_date, '%a %d %b') as form_issuance_date,
					DATE_FORMAT(af.form_submission_date, '%a %d %b') as form_submission_date,
					af.batch_time_submission, DATE_FORMAT(af.dob, '%d-%b-%Y') as dob,
					CONCAT(
						YEAR(FROM_DAYS(DATEDIFF(NOW(),af.dob))),'y, ',
						MONTH(FROM_DAYS(DATEDIFF(NOW(),af.dob))),'m', '') as age,

					/***** Assessment *****/
					CONCAT(DATE_FORMAT(af.form_assessment_date, '%a %d %b'), '@ ', TIME_FORMAT(af.batch_time_submission, '%h:%i')) as form_assessment_date,
					DATE_FORMAT(af.form_assessment_date, '%d %b') as simple_form_assessment_date,
					IFNULL(DATE_FORMAT(AST_Presence.date, '%a %d %b'),'') AS ast_done_on, af.ast_name_code, 
					IF(IFNULL(AST_Reminder.admission_form_id,0)=0,0,1) as flag_ast_reminder, IF(IFNULL(AST_Presence.date,0)=0,0,1) as flag_ast_presence, 
					IF(IFNULL(AST_Followup.admission_form_id,0)=0,0,1) as flag_ast_followup,
					af.form_assessment_result, af.form_assessment_decision,
					IF(af.form_assessment_result='',0,1) as flag_ast_result,
					IF(af.form_assessment_decision='',0,1) as flag_ast_decision, IF(af.form_assessment_decision='',0,1) as flag_ast_allocation,
					IF(IFNULL(DIS_Communication.admission_form_id,0)=0,0,1) as flag_comm_ast_result,
					/***** Assessment - END *****/

					IF(IFNULL(OFFER.admission_form_id, 'A')='A', '', DATE_FORMAT(OFFER.date, '%a %d %b')) as OFFER,

					/***** Assessment *****/
					IFNULL(CONCAT(DATE_FORMAT(af.form_discussion_date, '%a %d %b'), ' @ ', TIME_FORMAT(af.form_discussion_time, '%h:%i')), '') as form_discussion_date,
					IFNULL(DATE_FORMAT(Dis_Presence.date, '%a %d %b'),'') AS dis_done_on, af.dis_name_code,
					IF(IFNULL(DIS_Reminder.admission_form_id,0)=0,0,1) as flag_dis_reminder, IF(IFNULL(DIS_Presence.date,0)=0,0,1) as flag_dis_presence, 
					IF(IFNULL(DIS_Followup.admission_form_id,0)=0,0,1) as flag_dis_followup,
					af.form_discussion_result, af.form_discussion_decision,
					IF(af.form_discussion_result='',0,1) as flag_dis_result,
					IF(af.form_discussion_decision='',0,1) as flag_dis_decision, IF(af.form_discussion_decision='',0,1) as flag_dis_allocation,
					IF(IFNULL(OFR_Communication.admission_form_id,0)=0,0,1) as flag_comm_dis_result,
					/***** Assessment - END *****/


					/***** Other References Fields *****/
					af.form_batch_id, af.grade_id, af.and_id, af.and_batch,
					af.batch_category, af.batch_slot_no, af.grade_name, af.form_status_stage_id,
					af.form_status_id, 
					ifnull(outcome.outcome_date,'') as outcome_date
					/***** Other References Fields - END *****/


					from atif_gs_admission.view_admission_form as af

					/***** Assessment *****/
					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 3
						and new_form_stage = 4
						/*and type = 'G'*/
						group by admission_form_id) as AST_Presence
							on AST_Presence.admission_form_id = af.form_id

					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 3
						and new_form_stage = 3
						/*and type = 'G'*/
						group by admission_form_id) as AST_Reminder
							on AST_Reminder.admission_form_id = af.form_id
						
					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 3
						and new_form_stage = 5
						/*and type = 'G'*/
						group by admission_form_id) as AST_Followup
							on AST_Followup.admission_form_id = af.form_id
						
					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 3
						and new_form_stage = 2
						/*and type = 'G'*/
						group by admission_form_id) as DIS_Communication
							on DIS_Communication.admission_form_id = af.form_id
					/***** Assessment - END *****/

							

					/***** Discussion *****/
					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 4
						and new_form_stage = 4
						/*and type = 'G'*/
						group by admission_form_id) as Dis_Presence
							on Dis_Presence.admission_form_id = af.form_id
							
					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 4
						and new_form_stage = 3
						/*and type = 'G'*/
						group by admission_form_id) as DIS_Reminder
							on DIS_Reminder.admission_form_id = af.form_id
						
					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 4
						and new_form_stage = 5
						/*and type = 'G'*/
						group by admission_form_id) as DIS_Followup
							on DIS_Followup.admission_form_id = af.form_id

					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 4
						and new_form_stage = 2
						/*and type = 'G'*/
						group by admission_form_id) as OFR_Communication
							on OFR_Communication.admission_form_id = af.form_id
					/***** Discussion - END *****/


					/***** Offer *****/
					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 5
						and type = 'S'
						group by admission_form_id) as OFFER
							on OFFER.admission_form_id = af.form_id
					/***** Offer - END *****/
					
					/***** Outcome date *****/
					left join (Select admission_form_id, 
						from_unixtime(max(modified), '%a %d %b') as outcome_date 
						From atif_gs_admission.log_form_status 
						where new_form_stage = 15 or new_form_stage = 7
						group by admission_form_id
						union
						select lgs.admission_form_id, 
						from_unixtime(min(lgs.modified), '%a %d %b') as outcome_date
						from atif_gs_admission.log_form_status as lgs
						where lgs.new_form_status >= 6
						group by lgs.admission_form_id) as outcome
						on outcome.admission_form_id = af.form_id
					/***** Outcome date - End *****/

					where af.form_assessment_date != '0000-00-00'
					and af.form_assessment_date != '2001-01-01'
					#and af.batch_category = 'J-01'



					order by af.batch_time_submission) as data
					group by form_no
					
					order by batch_time_submission, form_no";
				$result = $this->ddb->query( $query );
				if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
				$results = $result->result_array();
				return $results;
				}else{ return FALSE; }
	}
	
	
		
	public function batch_bill2( $query ){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$result = $this->ddb->query( $query );
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->result_array();
		return $results;
		}else{ return FALSE; }
	}
	
	
	
	public function getBatch($GradeName){
		$this->dbad = $this->load->database('gs_admission',TRUE);
		$Where = '';
		foreach ($GradeName as $gradeName) {
			$Where .= "gg.name = ".$gradeName." or ";
		}
		$Where = substr($Where, 0, -3);
		$query= "select
				bt.id, bt.grade_id, gg.name as grade_name, bt.batch_category
				from atif_gs_admission._form_batch as bt
				left join atif._grade as gg on gg.id=bt.grade_id
				where $Where
				group by bt.batch_category
				order by bt.batch_category";
			
		$result = $this->dbad->query($query);
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{
			return FALSE;
		}
	}
	
	
}	