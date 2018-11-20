<?php
class Family_registered_model extends MY_Model{
	protected $_table_name = 'student_family_record';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'created desc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct()
	{
		parent::__construct();
	}



	public function get_GFID($FatherNIC){

		$GFID = "";

		$query=$this->db->query("SELECT gf_id FROM student_family_record WHERE nic = '" . $FatherNIC . "'"); 
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$GFID = $row['gf_id'];
		}

		return $GFID;
	}



	public function generate_GFID($Year){
		$generate_GFID = "";
		$gfid_this = intval(substr($Year, -2) . "000");
		$gfid_that = intval(intval(substr($Year, -2))+1 . "000");

		$query=$this->db->query("SELECT gf_id FROM student_family_record WHERE gf_id > " . $gfid_this . " and gf_id < " . $gfid_that);
		
		if ($query->num_rows() > 0) {
			$generate_GFID = $gfid_this + $query->num_rows() + 1;
		}else{
			$generate_GFID = $gfid_this + 1;
		}

		return $generate_GFID;
	}









	public function getAdmissionFeeInfo($FormNo){
		$cQuery = "select
			af.grade_name, af.grade_id, fr.father_nic, fr.father_name, af.official_name, af.abridged_name, af.call_name,
			af.gender, af.dob, af.form_no, afo.joining_date,
			fb.admission_fee, fb.security_deposit, fb.fee_a,
			fr.home_phone, fr.home_apartment_no, fr.home_street_name,
			fr.home_building_name, fr.home_plot_no, fr.home_region, fr.home_subregion
			
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.family_registration as fr
				on fr.gf_id = af.gf_id
			left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
			left join atif_fee_student.fee_bill as fb
				on fb.student_id = 7060
				and af.form_no = IF(LENGTH(af.form_no) > 4 , mid(fb.gb_id, 5, 5),mid(fb.gb_id, 6, 4) )
				and fb.bill_title = 'Admission'
				

			where af.form_no = $FormNo  and MID(fb.gb_id,3,2) <> '72'";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}

	public function get_FormID($FormNo){
		$FormID = 0;
		$query=$this->db->query("SELECT id FROM atif_gs_admission.admission_form WHERE form_no = $FormNo"); 
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$FormID = $row['id'];
		}
		return $FormID;
	}

	public function updateStudentID_ofFeeBill($GBID, $StudentID){
		$cQuery = "update atif_fee_student.fee_bill set student_id = $StudentID where gb_id = '$GBID'";
   		$query=$this->db->query($cQuery);
	}

	public function update_admission_form_comments($FormNo, $Reason, $Comments, $Created, $RegisterBy){
		$AdmissionFormID = $this->get_FormID($FormNo);
		$cQuery = "insert into atif_gs_admission.log_form_comments
			(admission_form_id, reason, comments, created, register_by, modified, modified_by, record_deleted)
			VALUES
			($AdmissionFormID, '$Reason', '$Comments', $Created, $RegisterBy, $Created, $RegisterBy, 0)";
   		$query=$this->db->query($cQuery);



   		$cQuery = "update atif_gs_admission.admission_form set form_status_id = 6, form_status_stage_id = 1 where id = $AdmissionFormID";
   		$query=$this->db->query($cQuery);
	}
}