<?php
class Frontoffice_followup extends CI_Model{
	private $ddb;
	
	function __construct(){ parent::__construct(); }

	
		// Get Follow up forms
		public function getFollowupFormsFrontOffice($current_date){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$query = " SELECT
			form_id, form_no, form_submission_date, 
			IF(day_diff = 1, '(1 day ago)', CONCAT('(', day_diff, ' days ago)')) as day_diff,
			applicant_name, father_name, father_mobile, current_standing,
			current_status_1

			FROM
			(select
			af.id as form_id, af.form_no, af.form_submission_date, 
			/***** Current Date is here *****/
			DATEDIFF('".$current_date."', af.form_submission_date) as day_diff,
			af.official_name as applicant_name,
			fr.father_name, fr.father_mobile,
			'Submission' as current_standing, 'Submission Date expired' as current_status_1

			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.family_registration as fr
				on fr.gf_id = af.gf_id


			where af.form_assessment_date = '0000-00-00'
			and af.form_submission_date < curdate() /***** Current Date is here *****/
			and af.form_status_stage_id != 7
			) AS DATA";
			$result = $this->ddb->query( $query );
			if( $result->num_rows() > 0 ){
				$results = $result->result_array();
				return $results;
			}else{ return FALSE; }
		}
	// end set

}
?>