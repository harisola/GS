<?php
class Process_flow_model extends CI_Model{

	private $dbad;
	function __construct(){ parent::__construct(); }





	public function getCount_IssuanceOfAll(){
		$this->dbad = $this->load->database('gs_admission',TRUE);

		$query= "select 9999 as form_status_id, 9999 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form
			
			UNION
			select
			form_status_id, form_status_stage_id, count(form_id) as num, status_name as status, stage_name as stage
			from atif_gs_admission.view_admission_form
			group by form_status_id, form_status_stage_id

			UNION
			select 2 as form_status_id, 5 as form_status_stage_id, count(id) as num,
			'Submission' as status, 'Follwup' as stage
			from atif_gs_admission.admission_form as af
			where af.form_assessment_date = '0000-00-00'
			and af.form_submission_date < CURDATE() /***** Current Date is here *****/
			and af.form_status_stage_id != 7

			UNION
			select 3 as form_status_id, 5 as form_status_stage_id, count(id) as num,
			'Assessment' as status, 'Follwup' as stage
			from atif_gs_admission.admission_form as af
			where af.form_discussion_result = ''
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_assessment_date < CURDATE() /***** Current Date is here *****/
			and af.form_status_stage_id != 7

			UNION
			select 4 as form_status_id, 5 as form_status_stage_id, count(id) as num,
			'Discussion' as status, 'Follwup' as stage
			from atif_gs_admission.admission_form as af
			where af.offer_date = '0000-00-00'
			and af.form_discussion_date != '0000-00-00'
			and af.form_discussion_date != '2001-01-01'
			and af.form_discussion_date < CURDATE() /***** Current Date is here *****/
			and af.form_status_stage_id != 7

			UNION
			select 5 as form_status_id, 5 as form_status_stage_id, count(id) as num,
			'Offer' as status, 'Follwup' as stage
			from atif_gs_admission.admission_form as af
			where af.offer_date != '0000-00-00'
			and af.offer_date != '2001-01-01'
			and af.offer_date < CURDATE() /***** Current Date is here *****/
			and af.form_status_stage_id != 7";
			
		$result = $this->dbad->query($query);
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{
			return FALSE;
		}
	}





















	public function getCount_Issuance($GradeName, $BatchID, $Gender){
		$this->dbad = $this->load->database('gs_admission',TRUE);


		$Where = '(';
		foreach ($GradeName as $gradeName) {
			$Where .= "grade_name = '$gradeName' or ";
		}
		$Where = substr($Where, 0, -23);


		$WhereFull = $Where;
		if($BatchID != ''){
			$Where .= ') and (form_batch_id = '.$BatchID.' and batch_slot_id!=0) and (';
			$WhereFull .=  ') and (form_batch_id = '.$BatchID.') and (';
		}else{
			if(!empty($Gender)){
				$Where .= ') and (';
				$WhereFull = $Where;
			}
		}

		if(($BatchID = '' && !empty($Gender)) || empty($Gender && $BatchID != '')){
			$Where = substr($Where, 0, -7);
			$WhereFull = substr($WhereFull, 0, -7);
		}

		$WhereGender = '';
		foreach ($Gender as $gender) {
			$gender = substr($gender, 0, 1);
			if($gender == 'A'){
				$WhereGender = ") and (gender='B' or gender='G' or ";
			}else{
				$WhereGender .= ") and (gender = '$gender' or ";
			}
		}
		$WhereGender = substr($WhereGender, 0, -26);
		$Where .= $WhereGender . ')';
		$WhereFull .= $WhereGender . ')';


		$query = "select 9999 as form_status_id, 9999 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form
			where " . $WhereFull . " 
			
			UNION
			select
			form_status_id, form_status_stage_id, count(form_id) as num, status_name as status, stage_name as stage
			from atif_gs_admission.view_admission_form
			where " . $Where . "  
			group by form_status_id, form_status_stage_id
			
			UNION
			select 2 as form_status_id, 5 as form_status_stage_id, count(id) as num,
			'Submission' as status, 'Follwup' as stage
			from atif_gs_admission.admission_form as af
			where af.form_assessment_date = '0000-00-00'
			and af.form_submission_date < CURDATE() /***** Current Date is here *****/
			and af.form_status_stage_id != 7
			and " . $Where . "

			UNION
			select 3 as form_status_id, 5 as form_status_stage_id, count(id) as num,
			'Assessment' as status, 'Follwup' as stage
			from atif_gs_admission.admission_form as af
			where af.form_discussion_result = ''
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_assessment_date < CURDATE() /***** Current Date is here *****/
			and af.form_status_stage_id != 7
			and " . $Where . "

			UNION
			select 4 as form_status_id, 5 as form_status_stage_id, count(id) as num,
			'Discussion' as status, 'Follwup' as stage
			from atif_gs_admission.admission_form as af
			where af.offer_date = '0000-00-00'
			and af.form_discussion_date != '0000-00-00'
			and af.form_discussion_date != '2001-01-01'
			and af.form_discussion_date < CURDATE() /***** Current Date is here *****/
			and af.form_status_stage_id != 7
			and " . $Where . "

			UNION
			select 5 as form_status_id, 5 as form_status_stage_id, count(id) as num,
			'Offer' as status, 'Follwup' as stage
			from atif_gs_admission.admission_form as af
			where af.offer_date != '0000-00-00'
			and af.offer_date != '2001-01-01'
			and af.offer_date < CURDATE() /***** Current Date is here *****/
			and af.form_status_stage_id != 7
			and " . $Where;


		//print_r($query);
		$result = $this->dbad->query($query);
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{
			return FALSE;
		}
	}







	public function getBatch($GradeName){
		$this->dbad = $this->load->database('gs_admission',TRUE);

		$Where = '';
		foreach ($GradeName as $gradeName) {
			$Where .= "gg.name = '$gradeName' or ";
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






	public function getAdmissionList($StatusID, $StageID, $GradeID){
		$this->dbad = $this->load->database('gs_admission',TRUE);

		$StatusIDs = array();
        $StageIDs = array();
        $GradeIDs = array();


        $WhereStatus = '';
        $WhereStage = '';
        $WhereGrade = '';

        if($StatusID != ''){
        	$StatusIDs = explode(",", $StatusID);
        	$WhereStatus = '(af.form_status_id = '.$StatusID.')';
        }

        if($StageID != ''){
        	$StageIDs = explode(",", $StageID);

        	if(count($StageIDs) > 1){
				$WhereStage = "(";
				foreach ($StageIDs as $id) {
					$WhereStage .= "af.form_status_stage_id = " .$id. " or ";
				}
				$WhereStage = substr($WhereStage, 0, -4);
				$WhereStage .= ")";
			}else{
    			$WhereStage = '(af.form_status_stage_id = '.$StageID.')';
    		}
   	
        }



        if($GradeID != ''){
        	$GradeIDs = explode(",", $GradeID);

        	if(count($GradeIDs) > 1){
				$WhereGrade = "and (";
				foreach ($GradeIDs as $id) {
					$WhereGrade .= "af.grade_name = '" .$id. "' or ";
				}
				$WhereGrade = substr($WhereGrade, 0, -4);
				$WhereGrade .= ")";
			}else{
    			$WhereGrade = '(af.form_status_stage_id = '.$GradeID.')';
    		}
        }
        

        if($StageID == 5){
        	if($StatusID == 2){
				$query="select
					af.id as form_id, af.form_no, CONCAT(REPLACE(b.name, '-', ''), '-', LPAD(bs.sno, 2, '0')) as batch_id,
					af.official_name, fr.father_name, fr.father_mobile, af.grade_name
					from atif_gs_admission.admission_form as af
					left join atif_gs_admission._form_batch as bt
						on bt.id = af.form_batch_id
					left join atif_gs_admission._batch as b
						on b.id = bt.batch_id
					left join atif_gs_admission._form_batch_slots as bs
						on bs.id = af.batch_slot_id
					left join atif_gs_admission.family_registration as fr
						on fr.gf_id = af.gf_id
					where af.form_assessment_date = '0000-00-00'
					and af.form_submission_date < CURDATE() /***** Current Date is here *****/
					and af.form_status_stage_id != 7 $WhereGrade";
        	}else if($StatusID == 3){
        		$query="select
					af.id as form_id, af.form_no, CONCAT(REPLACE(b.name, '-', ''), '-', LPAD(bs.sno, 2, '0')) as batch_id,
					af.official_name, fr.father_name, fr.father_mobile, af.grade_name
					from atif_gs_admission.admission_form as af
					left join atif_gs_admission._form_batch as bt
						on bt.id = af.form_batch_id
					left join atif_gs_admission._batch as b
						on b.id = bt.batch_id
					left join atif_gs_admission._form_batch_slots as bs
						on bs.id = af.batch_slot_id
					left join atif_gs_admission.family_registration as fr
						on fr.gf_id = af.gf_id
					where af.form_discussion_result = ''
					and af.form_assessment_date != '0000-00-00'
					and af.form_assessment_date != '2001-01-01'
					and af.form_assessment_date < CURDATE() /***** Current Date is here *****/
					and af.form_status_stage_id != 7 $WhereGrade";
        	}else if($StatusID == 4){
        		$query="select
					af.id as form_id, af.form_no, CONCAT(REPLACE(b.name, '-', ''), '-', LPAD(bs.sno, 2, '0')) as batch_id,
					af.official_name, fr.father_name, fr.father_mobile, af.grade_name
					from atif_gs_admission.admission_form as af
					left join atif_gs_admission._form_batch as bt
						on bt.id = af.form_batch_id
					left join atif_gs_admission._batch as b
						on b.id = bt.batch_id
					left join atif_gs_admission._form_batch_slots as bs
						on bs.id = af.batch_slot_id
					left join atif_gs_admission.family_registration as fr
						on fr.gf_id = af.gf_id
					where af.offer_date = '0000-00-00'
					and af.form_discussion_date != '0000-00-00'
					and af.form_discussion_date != '2001-01-01'
					and af.form_discussion_date < CURDATE() /***** Current Date is here *****/
					and af.form_status_stage_id != 7 $WhereGrade";
        	}else if($StatusID == 5){
        		$query="select
					af.id as form_id, af.form_no, CONCAT(REPLACE(b.name, '-', ''), '-', LPAD(bs.sno, 2, '0')) as batch_id,
					af.official_name, fr.father_name, fr.father_mobile, af.grade_name
					from atif_gs_admission.admission_form as af
					left join atif_gs_admission._form_batch as bt
						on bt.id = af.form_batch_id
					left join atif_gs_admission._batch as b
						on b.id = bt.batch_id
					left join atif_gs_admission._form_batch_slots as bs
						on bs.id = af.batch_slot_id
					left join atif_gs_admission.family_registration as fr
						on fr.gf_id = af.gf_id
					where af.offer_date != '0000-00-00'
					and af.offer_date != '2001-01-01'
					and af.offer_date < CURDATE() /***** Current Date is here *****/
					and af.form_status_stage_id != 7 $WhereGrade";
        	}
        }else{
        	if($StatusID != '' and $StageID == ''){
				$query="select
					af.id as form_id, af.form_no, CONCAT(REPLACE(b.name, '-', ''), '-', LPAD(bs.sno, 2, '0')) as batch_id,
					af.official_name, fr.father_name, fr.father_mobile, af.grade_name
					from atif_gs_admission.admission_form as af
					left join atif_gs_admission._form_batch as bt
						on bt.id = af.form_batch_id
					left join atif_gs_admission._batch as b
						on b.id = bt.batch_id
					left join atif_gs_admission._form_batch_slots as bs
						on bs.id = af.batch_slot_id
					left join atif_gs_admission.family_registration as fr
						on fr.gf_id = af.gf_id
					where $WhereStatus $WhereGrade";
			}else if($StatusID == '' and $StageID != ''){
				$query="select
					af.id as form_id, af.form_no, CONCAT(REPLACE(b.name, '-', ''), '-', LPAD(bs.sno, 2, '0')) as batch_id,
					af.official_name, fr.father_name, fr.father_mobile, af.grade_name
					from atif_gs_admission.admission_form as af
					left join atif_gs_admission._form_batch as bt
						on bt.id = af.form_batch_id
					left join atif_gs_admission._batch as b
						on b.id = bt.batch_id
					left join atif_gs_admission._form_batch_slots as bs
						on bs.id = af.batch_slot_id
					left join atif_gs_admission.family_registration as fr
						on fr.gf_id = af.gf_id
					where $WhereStage $WhereGrade";
			}else {
				$query="select
					af.id as form_id, af.form_no, CONCAT(REPLACE(b.name, '-', ''), '-', LPAD(bs.sno, 2, '0')) as batch_id,
					af.official_name, fr.father_name, fr.father_mobile, af.grade_name
					from atif_gs_admission.admission_form as af
					left join atif_gs_admission._form_batch as bt
						on bt.id = af.form_batch_id
					left join atif_gs_admission._batch as b
						on b.id = bt.batch_id
					left join atif_gs_admission._form_batch_slots as bs
						on bs.id = af.batch_slot_id
					left join atif_gs_admission.family_registration as fr
						on fr.gf_id = af.gf_id
					where $WhereStatus and $WhereStage $WhereGrade";
			}
        }
        

		$query .= " order by af.grade_id, call_name";

		//print_r($query);
		$result = $this->dbad->query($query);
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{
			return FALSE;
		}
	}
}