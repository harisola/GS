<?php
class Ajax_base_model extends CI_Model{
	private $ddb;
	private $ddb2;
	function __construct(){ parent::__construct(); }
	
	
	// Get list of Admission Form
	public function list_of_admission_form( $where = NULL ){
		$this->ddb = $this->load->database('gs_admission',TRUE);
$query = "select
af.id AS Form_id,
af.form_no AS Form_no,
af.token_no AS Token_no,
IF(af.gf_id<17000, af.gf_id, '') AS Gf_id,
concat(left(lpad(af.gf_id,5,0),2),'-',right(lpad(af.gf_id,5,0),3)) AS `gfid`,
af.official_name AS Applicate_name,
af.call_name AS Call_name,
af.dob AS Dob,
af.student_nic AS Student_nic,
af.student_mobile AS Student_mobile,
af.student_email AS Student_email,
af.gt_id AS gt_id,
af.form_batch_id AS Batch_id,
af.batch_slot_id AS Slot_id,
af.gender AS Gender,
af.is_photo_submitted AS Photo_submitted,
af.is_alevel_supplement AS Alevel_supplement,
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
af.referal_code,
fr.id as Family_reg_id,
fr.primary_contact as Primary_contact,
fr.father_name AS Father_name,
fr.father_mobile AS Father_mobile,
fr.father_mobile_other as Father_mobile_other,
fr.father_nic AS Father_nic,
fr.mother_name As Mother_name,
fr.mother_mobile as Mother_mobile,
fr.mother_mobile_other as Mother_mobile_other,
fr.mother_nic as Mother_nic,
fr.father_email as Father_email,
fr.mother_email AS Mother_email,
fr.single_parent as single_parent,
fr.primary_contact as primary_contact,
IF(af.form_assessment_date = '2001-01-01', 'TBI', CONCAT(fb.batch_category, '-', LPAD(fbs.sno, 2,0))) AS batch_name, IF(af.form_assessment_date <= '2001-01-01', '-', DATE_FORMAT(af.form_assessment_date, '%a, %d %b')) AS form_assessment_date, IF(af.form_assessment_date <= '2001-01-01', '-', TIME_FORMAT(fbs.time_start, '%h:%i %p')) AS form_assessment_time,af.form_assessment_date as assessment_date_simple_format
from atif_gs_admission.admission_form AS af left join atif_gs_admission.family_registration AS fr on (fr.gf_id = af.gf_id )
LEFT JOIN atif_gs_admission._form_batch AS fb ON fb.id = af.form_batch_id
LEFT JOIN atif_gs_admission._form_batch_slots AS fbs ON fbs.id = af.batch_slot_id";

$query .= " where af.form_status_id = 1";
	
		if( $where != NULL ){
			$query .= " and af.id=".$where."";
		}
		
		$query .= " order by af.id desc";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			if( $where != NULL ){
				$results = $result->row_array();
			}else{
				$results = $result->result_array();	
			}
			
			//echo $this->ddb->last_query();
			return $results;
		}else{ return FALSE; }
	}
	// end set
	
	
		// Get list of Admission Form
	public function list_of_admission_form2( $where = NULL ){
		$this->ddb = $this->load->database('gs_admission',TRUE);
$query = "select 
af.id AS Form_id,
af.form_no AS Form_no,
af.token_no AS Token_no,
af.gf_id AS Gf_id,
af.official_name AS Applicate_name,
af.call_name AS Call_name,
af.dob AS Dob,
af.form_batch_id AS Batch_id,
af.batch_slot_id AS Slot_id,
af.gender AS Gender,
af.form_discussion_time AS Form_discussion_time,
af.is_photo_submitted AS Photo_submitted,
af.is_birthcrt_o AS Birth_o,
af.is_birthcrt_c AS Birth_c,
af.grade_id AS Grade_id,
af.grade_name AS Grade_name,
af.academic_session_id AS Academic,
af.form_status_id AS Form_status,
af.previous_school_id AS PS_id,
af.previous_grade AS PG_id,
DATE_FORMAT(af.form_submission_date, '%a, %d %b %Y') as Submission_date,
DATE_FORMAT(from_unixtime(af.modified), '%a, %d %b %Y') as submission_unix_date,
af.campus AS Campus,
af.comments AS Comments,
fr.id as Family_reg_id,
fr.primary_contact as Primary_contact,
fr.father_name AS Father_name,
fr.father_mobile AS Father_mobile,
fr.father_nic AS Father_nic,
fr.mother_name As Mother_name,
fr.mother_mobile as Mother_mobile,
fr.mother_nic as Mother_nic,
fr.father_email as Father_email,
fr.mother_email AS Mother_email,
fr.single_parent as single_parent,
fr.primary_contact as primary_contact,
if(reminder.admission_form_id = af.id, 1, 0) as done_reminder,
if(presence.admission_form_id = af.id, 1, 0) as done_presence,
if(followup.admission_form_id = af.id, 1, 0) as done_followup,
if(af.form_assessment_date = '2001-01-01', 'TBI', concat(fb.batch_category, '-',lpad(fbs.sno, 2,0))) as batch_name, 
if(af.form_assessment_date <= '2001-01-01', '-', date_format(af.form_assessment_date, '%a, %d %b')) as form_assessment_date,
if(af.form_assessment_date <= '2001-01-01', '-', time_format(fbs.time_start, '%h:%i %p')) as form_assessment_time,
af.referal_code
from atif_gs_admission.admission_form AS af 
left join atif_gs_admission.family_registration AS fr on (fr.gf_id = af.gf_id)
left join atif_gs_admission._form_batch as fb on fb.id = af.form_batch_id
left join atif_gs_admission._form_batch_slots as fbs on fbs.id = af.batch_slot_id

left join (select 
	lst.admission_form_id/*, lst.new_form_status,
	lst.old_form_stage, lst.new_form_stage*/
	from atif_gs_admission.log_form_status as lst
	where new_form_status = 1
	and new_form_stage = 3 limit 1) as reminder on reminder.admission_form_id = af.id

left join (select 
	id as admission_form_id
	from atif_gs_admission.admission_form 
	where form_submission_date != '0000-00-00') as presence on presence.admission_form_id = af.id
	
left join (select 
	lst.admission_form_id/*, lst.new_form_status,
	lst.old_form_stage, lst.new_form_stage*/
	from atif_gs_admission.log_form_status as lst
	where new_form_status = 1
	and (new_form_stage = 7 or new_form_stage = 10 or new_form_stage = 11)) as followup on followup.admission_form_id = af.id";
	
	
	$query .= " where af.form_status_id = 2 and af.form_status_stage_id != 7";
		
		
		$query .= " order by af.id desc";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			if( $where != NULL ){
				
				$results = $result->row_array();
			}else{
				$results = $result->result_array();	
			}
			
			//echo $this->ddb->last_query();
			return $results;
		}else{ return FALSE; }
	}
	// end se
	
	
		// Get list of Admission Form
	public function list_of_admission_form3( $where = NULL ){
		$this->ddb = $this->load->database('gs_admission',TRUE);
$query = "select
af.id AS Form_id,
af.form_no AS Form_no,
af.token_no AS Token_no,
af.gf_id AS Gf_id,
af.official_name AS Applicate_name,
af.call_name AS Call_name,
af.referal_code,
af.dob AS Dob,
af.form_batch_id AS Batch_id,
af.batch_slot_id AS Slot_id,
af.gender AS Gender,
af.student_nic AS Student_nic,
af.student_mobile AS Student_mobile,
af.student_email AS Student_email,
af.alevel_checklist AS Alevel_checklist,
af.is_photo_submitted AS Photo_submitted,
af.is_birthcrt_o AS Birth_o,
af.is_birthcrt_c AS Birth_c,
af.is_alevel_supplement AS Alevel_supplement,
af.grade_id AS Grade_id,
af.grade_name AS Grade_name,
af.academic_session_id AS Academic,
af.form_status_id AS Form_status,
af.previous_school_id AS PS_id,
af.previous_grade AS PG_id,
af.form_submission_date as Submission_date,
af.form_discussion_date as Form_discussion_date,
af.form_discussion_time as Form_discussion_time,
af.campus AS Campus,
af.comments AS Comments,
fr.id as Family_reg_id,
fr.primary_contact as Primary_contact,
fr.father_name AS Father_name,
fr.father_mobile AS Father_mobile,
fr.father_nic AS Father_nic,
fr.mother_name As Mother_name,
fr.mother_mobile as Mother_mobile,
fr.mother_nic as Mother_nic,
fr.father_email as Father_email,
fr.mother_email AS Mother_email,
fr.single_parent as single_parent,
fr.primary_contact as primary_contact,
fr.father_mobile_other as Father_mobile_other,
fr.mother_mobile_other as Mother_mobile_other
from atif_gs_admission.admission_form AS af left join atif_gs_admission.family_registration AS fr on (fr.gf_id = af.gf_id )";

	
		if( $where != NULL ){
			$query .= " where af.id=".$where."";
		}
		
		$query .= " order by af.id desc";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			if( $where != NULL ){
				$results = $result->row_array();
			}else{
				$results = $result->result_array();	
			}
			
			//echo $this->ddb->last_query();
			return $results;
		}else{ return FALSE; }
	}
	// end set
	
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
	// end set

	     public function getBatchDataByGradeId($grade_id){

			$this->DDB = $this->load->database('default',TRUE);
			$result = "";
			$cQuery = "select
			bt.grade_id, gg.name as grade_name, bs.id as slot_id, bs.sno, bs.time_start, admission_form_id, revised_batch_slot_id, bs.form_batch_id,
			bt.batch_category, bt.id as batch_id, bt.date as batch_date
			from atif_gs_admission._form_batch_slots as bs
			left join atif_gs_admission._form_batch as bt
			on bt.id = bs.form_batch_id
			left join atif._grade as gg
			on gg.id = bt.grade_id
			where bs.admission_form_id = 0 and revised_batch_slot_id = 0
			and bt.grade_id = $grade_id
			and bt.date > curdate()
			group by bt.batch_category
			order by form_batch_id, time_start";
			$query=$this->db->query($cQuery);
			if($query->num_rows() > 0){
				$result = $query->result_array();
			}
			return $result;
		
	}

	public function getSlotDataByGradeId($batch_id){

			$this->DDB = $this->load->database('default',TRUE);
			$result = "";
			 $cQuery = "select
			bt.grade_id, gg.name as grade_name, bs.id as slot_id, bs.sno, bs.time_start, admission_form_id, revised_batch_slot_id, bs.form_batch_id,
			bt.batch_category, bt.id as batch_id, bt.date as batch_date
			from atif_gs_admission._form_batch_slots as bs
			left join atif_gs_admission._form_batch as bt
			on bt.id = bs.form_batch_id
			left join atif._grade as gg
			on gg.id = bt.grade_id
			where 
			form_batch_id=$batch_id and

			bs.admission_form_id = 0 and revised_batch_slot_id = 0
			and bt.date > curdate()
			order by form_batch_id, time_start
			";
			$query=$this->db->query($cQuery);
			if($query->num_rows() > 0){
				$result = $query->result_array();
			}
			return $result;
		
	}

	public function slot_update($form_id,$batch_id,$slot_id,$assistment_date){

		$this->DDB = $this->load->database('gs_admission',TRUE);
			$cQuery = "UPDATE _form_batch_slots fbs set fbs.admission_form_id=0 where fbs.admission_form_id=$form_id
			";
			$query=$this->db->query($cQuery);
			$cQuery = "UPDATE _form_batch_slots fbs set fbs.admission_form_id=$form_id where fbs.id=$slot_id
			";
			$query=$this->db->query($cQuery);

			$cQuery = "UPDATE admission_form  set form_batch_id=$batch_id , batch_slot_id=$slot_id,form_assessment_date='$assistment_date',form_submission_date='$assistment_date' where id=
			$form_id";
			$query=$this->db->query($cQuery);


			
			return $query;

	}


	
	
	// Get Family Data
	public function getFamilyInfo($gf_id){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$query = "SELECT id FROM `family_registration` WHERE `gf_id`='".$gf_id."'";
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->row_array();
			//$this->dbV->last_query();
			return $results;
		}else{
			return FALSE;
		}
	}
	
	/* 
	 * --------------------------------------------------
	 * Get Family info if already submitted
	 * ie: Father, mother name, phone, email, nic etc
	 * --------------------------------------------------
     */	
/*		public function getFamilyDataByGfId( $gf_id=NULL, $f_nic=NULL ){
			$this->ddb = $this->load->database('default',TRUE);
			
			
			
			if( $gf_id != NULL){


$query = "select * from
(select

ffr.id as family_id,

ffr.gf_id as f_id,
'' as s_p,
'' as p_c,
ffr.nic as f_nic, ffr.name as f_name, ffr.mobile_phone as f_mobile_phone, ffr.email as f_email,
ffm.m_nic, ffm.m_name, ffm.m_mobile_phone, ffm.m_email
from atif.student_family_record as ffr
left join (select
nic as m_nic, name as m_name, mobile_phone as m_mobile_phone, email as m_email, gf_id
from
atif.student_family_record
where parent_type = 2 and gf_id = ".$gf_id.") as ffm
on ffm.gf_id = ffr.gf_id

where ffr.parent_type = 1 and ffr.gf_id = ".$gf_id."
union
SELECT 
'' as family_id,
fr.gf_id as f_id,
fr.single_parent as s_p,
fr.primary_contact as p_c,
fr.father_nic as f_nic,
fr.father_name as f_name, 
fr.father_mobile as f_mobile_phone, 
fr.father_email as f_email,
fr.mother_nic as m_nic,
fr.mother_name as m_name, 
fr.mother_mobile as m_mobile_phone, 
fr.mother_email as m_email
FROM atif_gs_admission.family_registration as fr 
WHERE fr.gf_id = ".$gf_id.") as data
order by family_id desc, m_nic desc";

			}
			if( $f_nic != NULL ){
				
				
 
 $query = "select * from

(select
ffr.id as family_id,
ffr.gf_id as f_id,
'' as s_p,
'' as p_c,
ffr.nic as f_nic, ffr.name as f_name, ffr.mobile_phone as f_mobile_phone, ffr.email as f_email,
ffm.m_nic, ffm.m_name, ffm.m_mobile_phone, ffm.m_email
from atif.student_family_record as ffr
left join (select
	nic as m_nic, name as m_name, mobile_phone as m_mobile_phone, email as m_email, gf_id
	from
	atif.student_family_record
	where parent_type = 2) as ffm
	on ffm.gf_id = ffr.gf_id
where ffr.parent_type = 1 and ffr.nic = '".$f_nic."'

union

SELECT 
'' as family_id,
fr.gf_id as f_id,
fr.single_parent as s_p,
fr.primary_contact as p_c,
fr.father_nic as f_nic,
fr.father_name as f_name, 
fr.father_mobile as f_mobile_phone, 
fr.father_email as f_email,

fr.mother_nic as m_nic,
fr.mother_name as m_name, 
fr.mother_mobile as m_mobile_phone, 
fr.mother_email as m_email

 FROM atif_gs_admission.family_registration as fr 
 
 WHERE fr.father_nic = '".$f_nic."') as data
 
order by family_id desc, m_nic desc
limit 1";
 
 
			}
			$result = $this->ddb->query( $query );
			if( $result->num_rows() > 0 ){
				$results = $result->row_array();
				//$this->dbV->last_query();
				return $results;
			}else{
				return FALSE;
			}
		}*/
	/* 
	 * --------------------------------------------------
	 * Get Family info if already submitted
	 * ie: Father, mother name, phone, email, nic etc
	 * --------------------------------------------------
     */	
		public function getFamilyDataByGfId( $gf_id=NULL, $f_nic=NULL ){
			$this->ddb = $this->load->database('default',TRUE);
			
			
			
			if( $gf_id != NULL){


			$query = "select * from
			(select

			ffr.id as family_id,

			ffr.gf_id as f_id,
			'' as s_p,
			'' as p_c,
			ffr.nic as f_nic, ffr.name as f_name, ffr.mobile_phone as f_mobile_phone, ffr.email as f_email,
			ffm.m_nic, ffm.m_name, ffm.m_mobile_phone, ffm.m_email,sc.staff_id,sr.gt_id
			from atif.student_family_record as ffr
			left join (select
			nic as m_nic, name as m_name, mobile_phone as m_mobile_phone, email as m_email, gf_id
			from
			atif.student_family_record
			where parent_type = 2 and gf_id = $gf_id ) as ffm
			on ffm.gf_id = ffr.gf_id

			left join atif.staff_child sc on sc.gf_id = ffr.gf_id
			left join atif.staff_registered sr on (sr.id = sc.staff_id and sr.is_active = 1)

			where ffr.parent_type = 1 and ffr.gf_id = $gf_id 
			union
			SELECT 
			'' as family_id,
			fr.gf_id as f_id,
			fr.single_parent as s_p,
			fr.primary_contact as p_c,
			fr.father_nic as f_nic,
			fr.father_name as f_name, 
			fr.father_mobile as f_mobile_phone, 
			fr.father_email as f_email,
			fr.mother_nic as m_nic,
			fr.mother_name as m_name, 
			fr.mother_mobile as m_mobile_phone, 
			fr.mother_email as m_email,sc.staff_id,sr.gt_id
			FROM atif_gs_admission.family_registration as fr

			left join atif.staff_child sc on sc.gf_id = fr.gf_id
			left join atif.staff_registered sr on (sr.id = sc.staff_id and sr.is_active = 1)
			WHERE fr.gf_id = $gf_id ) as data
			order by family_id desc, m_nic desc";

			}
			if( $f_nic != NULL ){
				
				
 
			 $query = "select * from

			(select
			ffr.id as family_id,
			ffr.gf_id as f_id,
			'' as s_p,
			'' as p_c,
			ffr.nic as f_nic, ffr.name as f_name, ffr.mobile_phone as f_mobile_phone, ffr.email as f_email,
			ffm.m_nic, ffm.m_name, ffm.m_mobile_phone, ffm.m_email,sc.staff_id,sr.gt_id
			from atif.student_family_record as ffr
			left join (select
			   nic as m_nic, name as m_name, mobile_phone as m_mobile_phone, email as m_email, gf_id
			   from
			   atif.student_family_record
			   where parent_type = 2) as ffm
			   on ffm.gf_id = ffr.gf_id
			   
			   left join atif.staff_child sc on sc.gf_id = ffr.gf_id
			left join atif.staff_registered sr on (sr.id = sc.staff_id and sr.is_active = 1)
			where ffr.parent_type = 1 and ffr.nic = '$f_nic'

			union

			SELECT 
			'' as family_id,
			fr.gf_id as f_id,
			fr.single_parent as s_p,
			fr.primary_contact as p_c,
			fr.father_nic as f_nic,
			fr.father_name as f_name, 
			fr.father_mobile as f_mobile_phone, 
			fr.father_email as f_email,

			fr.mother_nic as m_nic,
			fr.mother_name as m_name, 
			fr.mother_mobile as m_mobile_phone, 
			fr.mother_email as m_email,sc.staff_id,sr.gt_id

			FROM atif_gs_admission.family_registration as fr 

			left join atif.staff_child sc on sc.gf_id = fr.gf_id
			left join atif.staff_registered sr on (sr.id = sc.staff_id and sr.is_active = 1)

			WHERE fr.father_nic = '$f_nic') as data

			order by family_id desc, m_nic desc
			limit 1";
			 
 
			}
			$result = $this->ddb->query( $query );
			if( $result->num_rows() > 0 ){
				$results = $result->row_array();
				//$this->dbV->last_query();
				return $results;
			}else{
				return FALSE;
			}
		}


		public function getFamilyDataByMNic( $m_nic ){
			
			$this->ddb = $this->load->database('default',TRUE);

			$query = "SELECT gt_id FROM atif.staff_registered where nic = '$m_nic'";

			$result = $this->ddb->query( $query );
			if( $result->num_rows() > 0 ){
				return $result->row_array();
				
			}else{
				return FALSE;
			}
		}		
	/*
	 * End function getFamilyDataByGfId
	 */
	 
	 
	 
	/*
	 * ------------------------------------------
	 *  Get Form Number	and increment by 1
	 * ------------------------------------------
	 */
		public function getFormNo(){
			$this->ddb = $this->load->database('default',TRUE);
				 // $query = "select if(max(af.form_no) is null, 9101, max(af.form_no)+1) as FNo from atif_gs_admission.admission_form as af order by af.form_no desc limit 1";
			$query = "SELECT IF(MAX(af.form_no) IS NULL, '0001', MAX(af.form_no)) AS oldForm,
			'19' as temp_year,CONCAT(19,'/',IF(MAX(af.form_no) IS NULL, '0001', MAX(af.form_no))) AS FNo
			FROM atif_gs_admission.admission_form AS af
			ORDER BY af.form_no DESC
			LIMIT 1";


				$result = $this->ddb->query( $query );
				
				if( $result->num_rows() > 0 ){
					$results = $result->row_array();
					$exp_result=explode('/',$results['FNo']);
					if(sizeof($exp_result)>2){
						 $results['temp_year'];
						 $myNewRow=($exp_result[2]+0001);
						 if($myNewRow<1000){
						 	 $myNewRow= str_pad($myNewRow,4,0,STR_PAD_LEFT);
						 }
						     $results=$results['temp_year'].'/'.($myNewRow);
					}else{
						$results=$results['FNo'];
					}
					//$this->dbV->last_query();
					return $results;
				}else{
					return FALSE;
				}
			
		} 
	/* End getFormNo */
	
	/*
	 * ------------------------------------------
	 *  Get Admission Grade Accordingly to DOB
	 * ------------------------------------------
	 */
		public function getAdmissionGrade($DOB){
			$this->ddb = $this->load->database('default',TRUE);
			$query = "select dob_g.grade_id, gg.name as grade_name from atif_gs_admission._dob_grade as dob_g left join atif._grade as gg on gg.id = dob_g.grade_id where dob_g.date_to >= '".$DOB."' and dob_g.date_from <= '".$DOB."'";
			
			$result = $this->ddb->query( $query );
			$results = $result->result_array();
			return $results;
			/*if( $result->num_rows() > 0 ){
				//$this->dbV->last_query();
			}else{
				return FALSE;
			}*/
		} 
	/* End getFormNo */
	
	/*
	 * ------------------------------------------
	 *  Get Acadmic Session
	 * ------------------------------------------
	 */
		public function academic_session( $branch_id ){
			$this->ddb = $this->load->database('default',TRUE);
			$query = "SELECT id AS Acadmic_session FROM atif._academic_session WHERE `branch_id`= ".$branch_id." AND is_lock=0";
			$result = $this->ddb->query( $query );
			if( $result->num_rows() > 0 ){
				$results = $result->row_array();
				return $results;
				//$this->dbV->last_query();
			}else{ return FALSE; }
		} 
	/* End getFormNo */
	
	
	/*
	--------------------------------------------------
		Function For Creat New Family Id (gf_id)
	--------------------------------------------------
	*/
	
	public function set_family_id(){
		$this->ddb = $this->load->database('default',TRUE);
		// $query = "select IF(RIGHT(YEAR(curdate()), 2)=LEFT(max(gf_id),2), max(gf_id)+1, CONCAT(RIGHT(YEAR(curdate()), 2), '001')) as new_gfid from atif_gs_admission.family_registration as af order by id limit 1";

		//for temperorary purpose 2019
			$query = "SELECT IF(
			RIGHT(19, 2)=
			LEFT(MAX(gf_id),2), MAX(gf_id)+1, CONCAT(
			RIGHT(19, 2), '001')) AS new_gfid
			FROM atif_gs_admission.family_registration AS af
			ORDER BY id
			LIMIT 1";
			$result = $this->ddb->query( $query );
			if( $result->num_rows() > 0 ){
				$results = $result->row_array();
				return $results;
			}else{ return FALSE; }
		
	}
	 // ------- End Family Id ------
	
	public function reset($table,$data,$where){
		
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
     * Get Form Submission Date
	 * ---------------------------------------------
     * @param   string  $tablename
     * @param   array  	$set_data
     * @param   array 	$where
     * @return  integer
	 * ----------------------------------------------
     */
		public function form_submission_date(){
			$this->ddb = $this->load->database('default',TRUE);
			$WorkingDaysToAdd = 1;
			//$query = "select submission_date/*, no_of_forms_submission, forms_allocated, /*dummy,*/ /*thisDate*/ from (select submission_date, no_of_forms_submission, forms_allocated, /*dummy,*/ if(forms_allocated < no_of_forms_submission, 'Available', 'NOT') as thisDate from (select s.date as submission_date, s.no_of_forms_submission, ifnull(af.forms_allocated, 0) as forms_allocated/*, if(s.date='2017-01-16', 100, '') as dummy*/ from atif_gs_admission._form_submission_schedule as s left join (select form_submission_date, count(form_submission_date) as forms_allocated from atif_gs_admission.admission_form group by form_submission_date) as af on af.form_submission_date = s.date) as DATA) as DATA where thisDate = 'Available' order by submission_date limit 1";
			$query = 
				"SELECT submission_date
				FROM (
					SELECT submission_date, no_of_forms_submission, forms_allocated, IF(forms_allocated < no_of_forms_submission, 'Available', 'NOT') AS thisDate
					FROM (
						SELECT s.date AS submission_date, s.no_of_forms_submission, IFNULL(af.forms_allocated, 0) AS forms_allocated
						FROM atif_gs_admission._form_submission_schedule AS s
						LEFT JOIN (
							SELECT form_submission_date, COUNT(form_submission_date) AS forms_allocated
							FROM atif_gs_admission.admission_form
							GROUP BY form_submission_date) AS af
						ON af.form_submission_date = s.date
						WHERE s.date >= DATE_ADD(
						    CURDATE(),
						    INTERVAL ".$WorkingDaysToAdd." + 
						    IF(
						        (WEEK(CURDATE()) <> WEEK(DATE_ADD(CURDATE(), INTERVAL ".$WorkingDaysToAdd." DAY)))
						        OR (WEEKDAY(DATE_ADD(CURDATE(), INTERVAL ".$WorkingDaysToAdd." DAY)) IN (5, 6)),
						        2,
						        0)
						    DAY
					    )
					) AS DATA
					WHERE submission_date > CURDATE()
				) AS DATA
				WHERE thisDate = 'Available'
				ORDER BY submission_date
				LIMIT 1";
				$result = $this->ddb->query( $query );
				if( $result->num_rows() > 0 ){
					$results = $result->row_array();
					return $results;
				}else{
					$dateQuery = 
					"SELECT DATE_ADD(
					    CURDATE(),
					    INTERVAL ".$WorkingDaysToAdd." + 
					    IF(
					        (WEEK(CURDATE()) <> WEEK(DATE_ADD(CURDATE(), INTERVAL ".$WorkingDaysToAdd." DAY)))
					        OR (WEEKDAY(DATE_ADD(CURDATE(), INTERVAL ".$WorkingDaysToAdd." DAY)) IN (5, 6)),
					        2,
					        0)
					    DAY
				    ) AS submission_date;";
				    $dateResult = $this->ddb->query( $dateQuery );



				    $insertQuery = 
				    "INSERT INTO atif_gs_admission._form_submission_schedule (date, time_start, time_end, duration_per_slot, no_of_slots, forms_submit_per_slot, no_of_forms_submission, created, register_by, modified, modified_by, record_deleted)
					SELECT DATE_ADD(
					    CURDATE(),
					    INTERVAL ".$WorkingDaysToAdd." + 
					    IF(
					        (WEEK(CURDATE()) <> WEEK(DATE_ADD(CURDATE(), INTERVAL ".$WorkingDaysToAdd." DAY)))
					        OR (WEEKDAY(DATE_ADD(CURDATE(), INTERVAL ".$WorkingDaysToAdd." DAY)) IN (5, 6)),
					        2,
					        0)
					    DAY
					    ) AS date, '09:00:00' as time_start, '11:00:00' as time_end, 15 as duration_per_slot, 10 as no_of_slots, 10 as forms_submit_per_slot, 100 as no_of_forms_submission, UNIX_TIMESTAMP(NOW()) as created, 1 as register_by, UNIX_TIMESTAMP(NOW()) as modified, 1 as modified_by, 0 as record_deleted";
				    $insertResult = $this->ddb->query( $insertQuery );
					return $dateResult->row_array();
				}
		}
	// ------------------------------------------------
	
	
	/**
	 * ---------------------------------------------
     * Count Current Users Form Create
	 * ---------------------------------------------
     * @param   integer $user_id
     * @return  integer mytotal
	 * ----------------------------------------------
     */
	public function getUserUploadedForm($user_id=NULL){
		$this->ddb = $this->load->database('default',TRUE);
		if( $user_id == NULL ){
		$query = "select count(*) as totalForm from atif_gs_admission.admission_form where form_status_id = 1";
		}else{
		$query = "select count(*) as mytotal from atif_gs_admission.admission_form where register_by = ".$user_id." and form_status_id=1";	
		}
		
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
	}
	
	
	/**
	 * ---------------------------------------------
     *  Get Already Submitted Form no
	 * ---------------------------------------------
     * @param   string $father_nic
	 * @param   string $official_name
	 * @param   string $dob
	 * @param   integer $session_id
     * @return  integer mytotal
	 * ----------------------------------------------
     */
	public function getAlreadySubmittedFormNo($father_nic,$official_name,$dob,$academic_session_id){
		$this->ddb = $this->load->database('default',TRUE);
		$query = "
		select fr.form_no from atif_gs_admission.admission_form as fr
join atif_gs_admission.family_registration as rf
on(rf.gf_id = fr.gf_id )
where 
rf.father_nic = '".$father_nic."' 
and
fr.official_name = '".$official_name."'
and 
fr.dob = '".$dob."'";
//and fr.academic_session_id = ".$academic_session_id."";
		
		
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }
	}
	// end Get Already SubmittedForm No
	
	
	

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
	
	/**
	 * ---------------------------------------------
     *  Create Form Submission Assessment Date
	 * ---------------------------------------------
     * @return  array $row, 
	 * ----------------------------------------------
     */
	public function creatAssessmentdate($grade_id, $formBatchId){
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
	 * ---------------------------------------------
     *  Create Form Submission Assessment Date
	 * ---------------------------------------------
     * @return  array $row, 
	 * ----------------------------------------------
     */
	public function creatAssessmentdateStage($grade_id,$formBatchId,$timeSlot){
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
and bt.date >= curdate()
and bt.grade_id = '.$grade_id.' and bs.form_batch_id='.$formBatchId.' and bs.id='.$timeSlot.'
order by form_batch_id, time_start';
			$result = $this->ddb->query( $SQLQuery );
			if( $result->num_rows() > 0 ){
			$grade_list = $result->row_array();
			return $grade_list;
			}else{ return FALSE; }
	}
	// 
	
	
	
	/**
	 * ----------------------------------------------------
     *  Get Form Batch Id, Batch Category name, Grade Wise
	 * ----------------------------------------------------
	 * @db atif_gs_admission
	 * @tablename _form_batch
	 * @param integer $grade_id
     * @return  array $result,
	 * ----------------------------------------------------
     */
		public function getGradeFormBatch($grade_id){
			$this->ddb = $this->load->database('gs_admission',TRUE);
$SQLQuery = "SELECT
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
and batch_date >= curdate()
and grade_id = ".$grade_id."";


				$result = $this->ddb->query( $SQLQuery );
				if( $result->num_rows() > 0 ){
				$grade_list = $result->result_array();
				return $grade_list;
				}else{ return FALSE; }
		}
	// End getGradeFormBatch($grade_id)
	
	
	
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
		public function getFormSlot($form_id){
			$this->ddb = $this->load->database('gs_admission',TRUE);
			$SQLQuery =  'select id as aSlotID from atif_gs_admission._form_batch_slots where admission_form_id='.$form_id.' order by id desc limit 1';
				$result = $this->ddb->query( $SQLQuery );
				if( $result->num_rows() > 0 ){
				$grade_list = $result->row_array();
				return $grade_list;
				}else{ return FALSE; }
		}
	// End getGradeFormBatch($grade_id)
		
		
	/**
	 * ----------------------------------------------------
     *  Get getfif
	 * ----------------------------------------------------
	 * @param integer $gf_id
     * @return  array $result,
	 * ----------------------------------------------------
     */
		public function getfif($gf_id){
			$this->ddb = $this->load->database('gs_admission',TRUE);
			$SQLQuery =  "select
						sr.gs_id, sr.official_name, sr.abridged_name, sr.call_name, sr.DOB, sr.religion, sr.gender,
						sr.year_of_admission, sr.grade_of_admission, sr.year_of_admission, sr.gf_id, 
						IFNULL(cl.grade_name,'') AS grade_name, 
						IFNULL(cl.section_name,'') AS section_name, IFNULL(cl.generation_of,'') AS generation_of, 
						sr.gr_no as photo_id,cl.house_name, IF(LEFT(cl.std_status_code,1) = 'X', '', cl.std_status_code) AS std_status_code,
						father.name as father_name, mother.name as mother_name
						from atif.student_registered as sr
						left join atif.class_list as cl 
						on cl.id = sr.id
						left join (select gf_id, name from atif.student_family_record where parent_type=1) as father
						on father.gf_id = sr.gf_id
						left join (select gf_id, name from atif.student_family_record where parent_type=2) as mother
						on mother.gf_id = sr.gf_id
						where sr.gf_id = ".$gf_id." order by sr.dob";
						
				$result = $this->ddb->query( $SQLQuery );
				if( $result->num_rows() > 0 ){
				$grade_list = $result->result_array();
				return $grade_list;
				}else{ return FALSE; }
		}
	// End getfif($gf_id)	

		public function get_admission_setup_data(){
			$this->ddb2 = $this->load->database('gs_admission',TRUE);
			$SQLQuery = "SELECT name, DATE_FORMAT(date, '%a, %d %b %Y') as date, DATE_FORMAT(FROM_UNIXTIME(`fis`.`created`), '%a, %d %b %Y') as created , (case when ( CURDATE() > date)  
				THEN
				      'Inactive' 
				ELSE
				      'Active' 
				END )
 				as status FROM `atif_gs_admission`.`_form_issuance_schedule` as `fis` INNER JOIN `atif`.`_grade` as `gt` ON `fis`.`grade_id` = `gt`.id ORDER BY `date` ASC";
			$result = $this->ddb2->query( $SQLQuery );
			if( $result->num_rows() > 0 ){
			$grade_list = $result->result_array();
			return $grade_list;
			}else{ return FALSE; }
		}		
	
		public function get_admission_setup_submission_data(){
			$this->ddb2 = $this->load->database('gs_admission',TRUE);
			$SQLQuery = "SELECT no_of_forms_submission, time_end, time_start, DATE_FORMAT(date, '%a, %d %b %Y') as date, DATE_FORMAT(FROM_UNIXTIME(`fss`.`created`), '%a, %d %b %Y') as created , (case when ( CURDATE() > date)  
				THEN
				      'Inactive' 
				ELSE
				      'Active' 
				END )
 				as status FROM `atif_gs_admission`.`_form_submission_schedule` as `fss` ORDER BY `date` ASC";
			$result = $this->ddb2->query( $SQLQuery );
			if( $result->num_rows() > 0 ){
			$grade_list = $result->result_array();
			return $grade_list;
			}else{ return FALSE; }
		}


		public function addSubmissionDate(){
			$this->ddb2 = $this->load->database('gs_admission',TRUE);
			$query = "SELECT submission_date/*, no_of_forms_submission, forms_allocated, /*dummy,*/ /*thisDate*/
			FROM (
			SELECT submission_date, no_of_forms_submission, forms_allocated, /*dummy,*/ IF(forms_allocated < no_of_forms_submission, 'Available', 'NOT') AS thisDate
			FROM (
			SELECT s.date AS submission_date, s.no_of_forms_submission, IFNULL(af.forms_allocated, 0) AS forms_allocated/*, if(s.date='2017-01-16', 100, '') as dummy*/
			FROM atif_gs_admission._form_submission_schedule AS s
			LEFT JOIN (
			SELECT form_submission_date, COUNT(form_submission_date) AS forms_allocated
			FROM atif_gs_admission.admission_form
			GROUP BY form_submission_date) AS af ON af.form_submission_date = s.date) AS DATA) AS DATA
			WHERE thisDate = 'Available' and submission_date >= curdate()+2
			ORDER BY submission_date
			LIMIT 1";
			$result = $this->ddb2->query($query);
			
			if( $result->num_rows() > 0 ){
				return $result->result_array();
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

	public function get_last_record($form_id){
		$this->ddb2 = $this->load->database('gs_admission',TRUE);
		$query1 = "SELECT * from atif_gs_admission._form_batch_slots where admission_form_id = $form_id order by id desc limit 1";
			//print_r($query);
			$result = $this->ddb2->query($query1);
			
			if( $result->num_rows() > 0 ){
				return $result->result_array();
			}else{
				return FALSE;
			}
	}
}
?>