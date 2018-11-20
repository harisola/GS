<?php

class Edit_admission_form extends CI_Model{

	function __construct(){
		parent::__construct(); 
		$this->db= $this->load->database('gs_admission',TRUE);
	}

	public function getAllAdmissionForm(){
		$query = "SELECT af.id,af.form_no,af.official_name, CONCAT(fr.father_name,' - ',fr.father_mobile) AS father_detail,fs.name as status, af.gf_id as gf,
			if(LENGTH(af.gf_id)=5,CONCAT(SUBSTRING(af.gf_id, 1, 2),'-', SUBSTRING(af.gf_id, 3,5)),CONCAT('0',CONCAT(SUBSTRING(af.gf_id, 1, 1),'-', SUBSTRING(af.gf_id, 2,5)))) as gf_id
			FROM atif_gs_admission.admission_form af
			LEFT JOIN atif_gs_admission._form_status fs ON af.form_status_id = fs.id
			LEFT JOIN atif_gs_admission.family_registration fr ON fr.gf_id = af.gf_id order by form_no";
		$result = $this->db->query( $query );
		return $result->result();
	}

	public function getAdmissionFormByID($form_id){
		$query = "SELECT af.id,af.form_no,af.gf_id as gfid,af.official_name,af.call_name, CONCAT(fr.father_name,' - ',fr.father_mobile) AS father_detail,fs.name, af.gf_id AS gf, IF(LENGTH(af.gf_id)=5, CONCAT(SUBSTRING(af.gf_id, 1, 2),'-', SUBSTRING(af.gf_id, 3,5)), CONCAT('0', CONCAT(SUBSTRING(af.gf_id, 1, 1),'-', SUBSTRING(af.gf_id, 2,5)))) AS gf_id,
			af.dob,af.grade_name,af.grade_id,af.gender,fr.father_name,fr.father_mobile,fr.father_nic,fr.father_email,fr.mother_name,fr.mother_mobile,fr.mother_nic,fr.mother_email,af.student_nic,af.student_email,af.student_mobile,fr.father_mobile_other,fr.mother_mobile_other,af.request_for_grade,af.request_grade
			FROM atif_gs_admission.admission_form af
			LEFT JOIN atif_gs_admission._form_status fs ON af.form_status_id = fs.id
			LEFT JOIN atif_gs_admission.family_registration fr ON fr.gf_id = af.gf_id
			where af.id = ".$form_id."
			ORDER BY form_no";
		$result = $this->db->query( $query );
		return $result->result();
	}

	public function updateAdmission($where,$data){

		$query = "UPDATE  atif_gs_admission.admission_form af
		LEFT JOIN
		atif_gs_admission.family_registration fr
		ON      fr.gf_id = af.gf_id
		SET     af.official_name = '".$data['official_name']."' , af.call_name = '".$data['call_name']."' , af.gender = '".$data['gender']."' , af.grade_id = '".$data['grade_id']."',af.grade_name = '".$data['grade_name']."', fr.father_name = '".$data['father_name']."' , fr.mother_name = '".$data['mother_name']."' , fr.father_email = '".$data['father_email']."' , fr.mother_email = '".$data['mother_email']."' ,fr.father_nic  = '".$data['father_nic']."' ,fr.mother_nic = '".$data['mother_nic']."'"." , fr.father_mobile = '".$data['father_mobile']."', fr.father_mobile_other = '".$data['father_mobile_other']."' , fr.mother_mobile = '".$data['mother_mobile']."' ,fr.mother_mobile_other = '".$data['mother_mobile_other']."' , af.student_nic = '".$data['student_nic']."' , af.student_email = '".$data['student_email']."' ,af.student_mobile = '".$data['student_mobile']."' ,af.request_grade = '".$data['request_grade']."' ,af.request_for_grade = '".$data['request_for_grade']."'
		WHERE   af.id = ".$where['id'];

		
		$result = $this->db->query( $query );

		return $result == 1 ?  1 :  0;
		
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