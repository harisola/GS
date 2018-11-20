<?php
class Admission_form_issuance_model extends CI_Model{

	private $db_studentAdmission;

	function __construct()
	{
		parent::__construct();
		$this->db_studentAdmission = $this->load->database('gs_admission',TRUE);
	}


	protected $_table_name = 'admission_form';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'id desc';	
	protected $_timestamps = TRUE;

	public function getFormIssuanceData($FormNo){
		$query = "Select
					ad.form_no as form_no,ad.referal_code,
					date_format(ad.form_submission_date, '%W, %d %b %Y') as form_submission_date,
					IFNULL(LOWER(concat(TIME_FORMAT(sch.time_start, '%h:%i %p'), ' to ', TIME_FORMAT(sch.time_end, '%h:%m %p'))), '09:00 am to 11:00 am') as form_submission_time,

					if(ad.grade_id >= 15, '',if(fi.date = from_unixtime(ad.created, '%Y-%m-%d'), '', 'Late Issuance')) as is_late,
					if(sfr.nic = fm.father_nic, 'yes', 'no') as siblings,
					upper(ad.official_name) as official_name,
					if(ad.gender = 'b', 'BOY', if(ad.gender = 'g', 'GIRL','')) as gender,
					date_format(ad.dob, '%d-%M-%Y') as dob, gg.name as grade_name, ad.old_gs_id, ad.gt_id,
					concat(left(lpad(fm.gf_id,5,0),2),'-',right(lpad(fm.gf_id,5,0),3)) as gf_id,	
					upper(fm.father_name) as father_name, fm.father_nic, 
					concat(fm.father_mobile, if(fm.father_mobile_other = '', '', ', '), fm.father_mobile_other) as father_mobile, fm.father_email,
					upper(fm.mother_name) as mother_name, fm.mother_nic, 
					concat(fm.mother_mobile, if(fm.mother_mobile_other = '', '', ', '), fm.mother_mobile_other) as mother_mobile, fm.mother_email
				From
					atif_gs_admission.admission_form as ad

				Left Join
					atif_gs_admission.family_registration as fm
					on fm.gf_id = ad.gf_id
					
				Left Join
					atif._grade as gg
					on gg.id = ad.grade_id
					
				Left Join
					atif_gs_admission._form_issuance_schedule fi
					on fi.grade_id = ad.grade_id and fi.date = from_unixtime(ad.created, '%Y-%m-%d')
					
				Left Join
					atif.student_family_record as sfr
					on sfr.nic = fm.father_nic
					
				left join
					atif_gs_admission._form_submission_schedule as sch
					on sch.date = ad.form_submission_date
					
				Where ad.id = '$FormNo' ";

		$sql = $this->db_studentAdmission->query($query);
		return $sql->result();
	}


	public function getFormSubmissionData($FormNo){
		$query = "select
					af.form_no as form_no, upper(af.official_name) as official_name, af.grade_name,
					IF(af.form_assessment_date = '2001-01-01', '-', bt.batch_category) as batch_category,
					IF(af.form_assessment_date = '2001-01-01', 'TBI', b.name) as batch, 
					IF(af.form_assessment_date = '2001-01-01', 'To Be Informed',b.description) as process,
					IF(af.grade_id = 15 or af.grade_id = 16, 
						IF(af.form_assessment_date != '2001-01-01', 
							IFNULL(CONCAT(DATE_FORMAT(af.form_discussion_date, '%a, %d %b'), ' @ ', 
								LOWER(TIME_FORMAT(af.form_discussion_time, '%h:%i %p'))),'-'), '-'),	
						IF(af.form_assessment_date != '2001-01-01', 
							IFNULL(CONCAT(DATE_FORMAT(af.form_assessment_date, '%a, %d %b'), ' @ ', 
								LOWER(TIME_FORMAT(bs.time_start, '%h:%i %p'))),'-'), '-')) as date_time

					from atif_gs_admission.admission_form as af

					left join atif_gs_admission._form_batch as bt
						on bt.id = af.form_batch_id
						
					left join atif_gs_admission._batch as b
						on b.id = bt.batch_id
						
					left join atif_gs_admission._form_batch_slots as bs
						on bs.id = af.batch_slot_id
					where af.id = '$FormNo'";

		$sql = $this->db_studentAdmission->query($query);
		return $sql->result();
	}

	


	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_studentAdmission->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_studentAdmission->where('record_deleted', 0);
		if(!count($this->db_studentAdmission->ar_orderby)){
			$this->db_studentAdmission->order_by($this->_order_by);
		}
		return $this->db_studentAdmission->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_studentAdmission->where($where);
		return $this->get(NULL, $single);
	}

	public function save($data, $id = NULL){

		// Set timestamps
		if($this->_timestamps == TRUE){
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = human_to_unix($now);
			$id || $data['register_by'] = (int)$this->session->userdata['user_id'];
			$data['modified'] = human_to_unix($now);
			$data['modified_by'] = (int)$this->session->userdata['user_id'];
		}

		// Insert a new record
		if ($id === NULL){
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db_studentAdmission->set($data);
			$this->db_studentAdmission->insert($this->_table_name);
			$id = $this->db_studentAdmission->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_studentAdmission->set($data);
			$this->db_studentAdmission->where($this->_primary_key, $id);
			$this->db_studentAdmission->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_studentAdmission->where($this->_primary_key, $id);
		$this->db_studentAdmission->limit(1);
		$this->db_studentAdmission->delete($this->_table_name);
	}
}