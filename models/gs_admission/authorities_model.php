<?php
class Authorities_model extends CI_Model{
	private $ddb;
	function __construct(){ parent::__construct(); 
	}
	
	
	
	public function confirm_admission(){
		$this->ddb = $this->load->database('gs_admission',TRUE);	
		$query = "select af.* from atif_gs_admission.view_admission_form as af where (af.form_status_id = 5 or af.form_status_id = 6)";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
	}
	
	
	public function not_interested(){
		$this->ddb = $this->load->database('gs_admission',TRUE);	
		$query = "select af.* from atif_gs_admission.view_admission_form as af where (af.form_status_stage_id = 7)";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
	}
	
	
	
	public function regret(){
		$this->ddb = $this->load->database('gs_admission',TRUE);	
		$query = "select af.* from atif_gs_admission.view_admission_form as af where (af.form_status_stage_id = 15)";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
	}
	
	public function all_applications(){
		$this->ddb = $this->load->database('gs_admission',TRUE);	
		$query = "select af.* from atif_gs_admission.view_admission_form as af where (af.form_status_id = 5 or af.form_status_id = 6) 
			UNION select af.* from atif_gs_admission.view_admission_form as af where (af.form_status_stage_id = 7)
			UNION select af.* from atif_gs_admission.view_admission_form as af where (af.form_status_stage_id = 15)
			UNION select af.* from atif_gs_admission.view_admission_form as af where (af.RequestGrade = 2)";
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