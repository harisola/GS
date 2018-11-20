<?php
class Career_form_model extends CI_Model{

	private $db_career;

	function __construct()
	{
		parent::__construct();
		$this->db_career = $this->load->database('career',TRUE);
	}


	protected $_table_name = 'career';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'created desc';
	public $rules = array();
	protected $_timestamps = TRUE;	


	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_career->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_career->where('record_deleted', 0);
		if(!count($this->db_career->ar_orderby)){
			$this->db_career->order_by($this->_order_by);
		}
		return $this->db_career->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_career->group_by('nic')->where($where)->order_by('created', 'desc');
		return $this->get(NULL, $single);
	}

	public function save($data, $id = NULL){

		// Set timestamps
		if($this->_timestamps == TRUE){
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = human_to_unix($now);
			$data['modified'] = human_to_unix($now);
			$data['modified_by'] = (int)$this->session->userdata['user_id'];
		}

		// Insert a new record
		if ($id === NULL){
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db_career->set($data);
			$this->db_career->insert($this->_table_name);
			$id = $this->db_career->insert_id();
			// var_dump($data);
			// die();
			
			//Insert data into new table
			$sql = "INSERT INTO atif_career.career_form
	    			(gc_id, name, mobile_phone, land_line, nic, gender, position_applied,created, register_by, modified, modified_by, stage_id, status_id, form_source)
	    			values ( '". $data['gc_id'] ."', '".$data['name'] ."', '".$data['mobile_phone'] ."', '".$data['landline'] ."', '".$data['nic'] ."', '".$data['gender'] ."', '".$data['position_applied'] ."', ".$data['created'].", ".$data['modified_by'].", ".$data['modified'].", ".$data['modified_by'].", 1, 1, 1)";
			$this->db_career->query($sql);			
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_career->set($data);
			$this->db_career->where($this->_primary_key, $id);
			$this->db_career->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_career->where($this->_primary_key, $id);
		$this->db_career->limit(1);
		$this->db_career->delete($this->_table_name);
	}


	public function CleanToSave($ip){
		$result = true;

		$query=$this->db_career->query("SELECT COUNT(*) AS NumOfRows FROM career WHERE ip = '" . $ip . "' AND created > unix_timestamp(DATE_SUB(NOW(), INTERVAL 10 MINUTE))"); 
		$row = $query->row_array();
		$NumOfRows = $row['NumOfRows'];
		
		if ($NumOfRows > 0) {
			$result = false;
		}

		/*if(substr(site_url(),0,2) == "10" || substr(site_url(),0,3) == "113"){
			$result = true;
		}else{
			$query=$this->db_career->query("SELECT COUNT(*) AS NumOfRows FROM career WHERE ip = '" . $ip . "' AND created > unix_timestamp(DATE_SUB(NOW(), INTERVAL 10 MINUTE))"); 
			$row = $query->row_array();
			$NumOfRows = $row['NumOfRows'];
			if ($NumOfRows > 0) {
				$result = false;
			}
		}*/


		return $result;
	}

	public function getRemainingTime($ip){
		$result = "0";

		$query=$this->db_career->query("SELECT from_unixtime(created) AS registerTime, ADDTIME(from_unixtime(created), '1000') as remainingTime FROM career WHERE ip = '" . $ip . "' AND created > unix_timestamp(DATE_SUB(NOW(), INTERVAL 10 MINUTE))");
		$row = $query->row_array();
		$endDateTime = $row['remainingTime'];
		$datetime = explode(" ",$endDateTime);
		$endDate = $datetime[0];
		$endTime = $datetime[1];

		$now = date('Y-m-d H:i:s');
		$to_time = strtotime($now);
		$from_time = strtotime($endTime);
		$endTime = round(abs($to_time - $from_time) / 60,0). " minute";
	
		$result = $endTime;

		return $result;
	}


	public function generateGCID($thisID){
		$result = "0";

		$thisQuery = "SELECT max(gc_id) as gc_id FROM career WHERE gc_id like '" . $thisID . "/%'";		
		$query=$this->db_career->query($thisQuery);
		$row = $query->row_array();
		$gotGCID = $row['gc_id'];		
		$gotGCID = substr($gotGCID, 6, 9);		
		$gotGCID = intval($gotGCID);
		$gotGCID++;		

		if ($gotGCID <= 0) {$gotGCID = 1;}

		$result = str_pad($gotGCID, 4, '0', STR_PAD_LEFT); 

		return $result;
	}


	public function getStage2HRFormData(){
		$query =
		"select
		c.id, flow.flow_id, form_sr.form_send_received_id, form_sr.form_location,
        c.name, c.mobile_phone, c.email, c.nic, c.gc_id, c.gender,
		flow.forward_interaction_name, flow.forward_interaction_centre_name, flow.forward_grade_name,
		flow.suggested_interaction_name, flow.suggested_interaction_centre_name, flow.suggested_grade_name,
		flow.forward_date, c.handedover_datetime,
		form_sr.interaction_centre_name as form_in_centre,form_sr.form_send_datetime,form_sr.form_received_datetime, form_sr.form_send_interaction_center_id,
		c.created, c.register_by, c.modified, c.modified_by, c.record_deleted, c.shortlist_a, c.shortlist_b, c.initial_sa_interview, flow.interaction_finished
		from career c
		left join
		(select * from (select flow_id, career_id, forward_interaction_id, forward_interaction_centre_id, forward_grade_id, forward_interaction_name, forward_interaction_centre_name, forward_grade_name, forward_comments, forward_tags, suggested_interaction_id, suggested_interaction_centre_id, suggested_grade_id, suggested_interaction_name, suggested_interaction_centre_name, suggested_grade_name, suggested_comments, suggested_tags, suggested_date, interaction_finished, created as forward_date, modified as modified_date from interaction_flow_detail order by created desc) as sub group by career_id) as flow on flow.career_id = c.id
		left join
		(select * from (select form_send_received_id, career_id, form_location, form_send_interaction_center_id, interaction_centre_name, form_send_datetime, form_received_datetime, created, register_by, modified, modified_by, record_deleted from form_send_received_detail order by created desc) as sub group by career_id) as form_sr on form_sr.career_id = c.id
		where (c.initial_sa_interview = 1 and sl3 = 1) /*and from_unixtime(c.created) >= '2016-01-01'*/ order by c.created desc";

		$sql = $this->db_career->query($query);
		return $sql->result();
	}

	public function getStage2HRFormData_GCID($GCID){
		$query =
		'select
		c.id, flow.flow_id, form_sr.form_send_received_id, form_sr.form_location,
		c.name, c.mobile_phone, c.email, c.nic, c.gc_id, c.gender,
		flow.forward_interaction_name, flow.forward_interaction_centre_name, flow.forward_grade_name,
		flow.suggested_interaction_name, flow.suggested_interaction_centre_name, flow.suggested_grade_name,
		flow.forward_date, flow.forward_interaction_id, c.handedover_datetime,
		form_sr.interaction_centre_name as form_in_centre,form_sr.form_send_datetime,form_sr.form_received_datetime,		
		c.created, c.register_by, c.modified, c.modified_by, c.record_deleted, c.shortlist_a, c.shortlist_b, c.initial_sa_interview, flow.interaction_finished
		from career c
		left join
		(select * from (select flow_id, career_id, forward_interaction_id, forward_interaction_centre_id, forward_grade_id, forward_interaction_name, forward_interaction_centre_name, forward_grade_name, forward_comments, forward_tags, suggested_interaction_id, suggested_interaction_centre_id, suggested_grade_id, suggested_interaction_name, suggested_interaction_centre_name, suggested_grade_name, suggested_comments, suggested_tags, suggested_date, interaction_finished, created as forward_date, modified as modified_date from interaction_flow_detail order by created desc) as sub group by career_id) as flow on flow.career_id = c.id
		left join
		(select * from (select form_send_received_id, career_id, form_location, interaction_centre_name, form_send_datetime, form_received_datetime, created, register_by, modified, modified_by, record_deleted from form_send_received_detail order by created desc) as sub group by career_id) as form_sr on form_sr.career_id = c.id
		where (c.initial_sa_interview = 1 and sl3 = 1) and c.id = ' . $GCID;

		$sql = $this->db_career->query($query);
		return $sql->result();		
	}


	public function getShortList2Data(){
		$query =
		'select
		c.id, flow.flow_id, form_sr.form_send_received_id, form_sr.form_location,
        c.name, c.mobile_phone, c.email, c.nic, c.gc_id, c.gender, c.sl2_comments, c.sl2, c.sl2_grade,
        c.sl_tags_acd_subject, c.sl_tags_acd_section, c.sl_tags_acd_primary,
        c.sl_tags_acdm, c.sl_tags_acdm_primary,
        c.sl_tags_admin_area, c.sl_tags_admin_position, c.sl_tags_admin_primary,
		flow.forward_interaction_name, flow.forward_interaction_centre_name, flow.forward_grade_name,
		flow.suggested_interaction_name, flow.suggested_interaction_centre_name, flow.suggested_grade_name,
		flow.forward_date, c.handedover_datetime,
		form_sr.interaction_centre_name as form_in_centre,form_sr.form_send_datetime,form_sr.form_received_datetime, form_sr.form_send_interaction_center_id,
		c.created, c.register_by, c.modified, c.modified_by, c.record_deleted, c.shortlist_a, c.shortlist_b, c.initial_sa_interview, IFNULL(flow.interaction_finished, 0) as interaction_finished
		from career c
		left join
		(select * from (select flow_id, career_id, forward_interaction_id, forward_interaction_centre_id, forward_grade_id, forward_interaction_name, forward_interaction_centre_name, forward_grade_name, forward_comments, forward_tags, suggested_interaction_id, suggested_interaction_centre_id, suggested_grade_id, suggested_interaction_name, suggested_interaction_centre_name, suggested_grade_name, suggested_comments, suggested_tags, suggested_date, interaction_finished, created as forward_date, modified as modified_date from interaction_flow_detail order by created desc) as sub group by career_id) as flow on flow.career_id = c.id
		left join
		(select * from (select form_send_received_id, career_id, form_location, form_send_interaction_center_id, interaction_centre_name, form_send_datetime, form_received_datetime, created, register_by, modified, modified_by, record_deleted from form_send_received_detail order by created desc) as sub group by career_id) as form_sr on form_sr.career_id = c.id
		where c.initial_sa_interview = 1';

		$sql = $this->db_career->query($query);
		return $sql->result();
	}


	public function getShortList3Data(){
		$query =
		'select
		c.id, flow.flow_id, form_sr.form_send_received_id, form_sr.form_location,
        c.name, c.mobile_phone, c.email, c.nic, c.gc_id, c.gender, c.sl3_comments, c.sl3, c.sl3_grade,
        c.sl_tags_acd_subject, c.sl_tags_acd_section, c.sl_tags_acd_primary,
        c.sl_tags_acdm, c.sl_tags_acdm_primary,
        c.sl_tags_admin_area, c.sl_tags_admin_position, c.sl_tags_admin_primary,
		flow.forward_interaction_name, flow.forward_interaction_centre_name, flow.forward_grade_name,
		flow.suggested_interaction_name, flow.suggested_interaction_centre_name, flow.suggested_grade_name,
		flow.forward_date, c.handedover_datetime,
		form_sr.interaction_centre_name as form_in_centre,form_sr.form_send_datetime,form_sr.form_received_datetime, form_sr.form_send_interaction_center_id,
		c.created, c.register_by, c.modified, c.modified_by, c.record_deleted, c.shortlist_a, c.shortlist_b, c.initial_sa_interview, flow.interaction_finished
		from career c
		left join
		(select * from (select flow_id, career_id, forward_interaction_id, forward_interaction_centre_id, forward_grade_id, forward_interaction_name, forward_interaction_centre_name, forward_grade_name, forward_comments, forward_tags, suggested_interaction_id, suggested_interaction_centre_id, suggested_grade_id, suggested_interaction_name, suggested_interaction_centre_name, suggested_grade_name, suggested_comments, suggested_tags, suggested_date, interaction_finished, created as forward_date, modified as modified_date from interaction_flow_detail order by created desc) as sub group by career_id) as flow on flow.career_id = c.id
		left join
		(select * from (select form_send_received_id, career_id, form_location, form_send_interaction_center_id, interaction_centre_name, form_send_datetime, form_received_datetime, created, register_by, modified, modified_by, record_deleted from form_send_received_detail order by created desc) as sub group by career_id) as form_sr on form_sr.career_id = c.id
		where c.initial_sa_interview = 1 and c.sl2 = 1';

		$sql = $this->db_career->query($query);
		return $sql->result();
	}



	public function getStage2HRFormData_ICID($ICID){
		$query =
		'select
		c.id, flow.flow_id, form_sr.form_send_received_id, form_sr.form_location,
		c.name, c.mobile_phone, c.email, c.nic, c.gc_id, c.gender,
		flow.forward_interaction_name, flow.forward_interaction_centre_name, flow.forward_grade_name,
		flow.suggested_interaction_name, flow.suggested_interaction_centre_name, flow.suggested_grade_name,
		flow.forward_date, flow.forward_interaction_id,
		form_sr.interaction_centre_name as form_in_centre,form_sr.form_send_datetime,form_sr.form_received_datetime,
		form_sr.form_send_interaction_center_id, c.handedover_datetime,
		recom_by.recommended_interaction_centre_name, recom_by.recommended_grade_name,
		recom_by.recommended_interaction_name, recom_by.recommended_comments,
		recom_by.recommended_tags,
		c.created, c.register_by, c.modified, c.modified_by, c.record_deleted, c.shortlist_a, c.shortlist_b, c.initial_sa_interview, flow.interaction_finished
		from career c
		left join
		(select * from (select flow_id, career_id, forward_interaction_id, forward_interaction_centre_id, forward_grade_id, forward_interaction_name, forward_interaction_centre_name, forward_grade_name, forward_comments, forward_tags, suggested_interaction_id, suggested_interaction_centre_id, suggested_grade_id, suggested_interaction_name, suggested_interaction_centre_name, suggested_grade_name, suggested_comments, suggested_tags, suggested_date, interaction_finished, created as forward_date, modified as modified_date from interaction_flow_detail order by created desc) as sub group by career_id) as flow on flow.career_id = c.id
		left join
		(select * from (select form_send_received_id, form_send_interaction_center_id, career_id, form_location, interaction_centre_name, form_send_datetime, form_received_datetime, created, register_by, modified, modified_by, record_deleted from form_send_received_detail order by created desc) as sub group by career_id) as form_sr on form_sr.career_id = c.id
		left join
		(select * from (select recommended_id, career_id, forward_interaction_id as recommended_interaction_id, forward_interaction_name as recommended_interaction_name, forward_interaction_centre_id as recommended_interaction_centre_id, forward_interaction_centre_name as recommended_interaction_centre_name, forward_grade_id as recommended_grade_id, forward_grade_name as recommended_grade_name, forward_comments as recommended_comments, forward_tags as recommended_tags from recommended_by_ic_detail order by created desc) as sub group by career_id) as recom_by on recom_by.career_id = c.id
		where (c.initial_sa_interview = 1 and sl3 = 1) and flow.forward_interaction_id = ' . $ICID;

		$sql = $this->db_career->query($query);
		return $sql->result();		
	}


	public function getStage2HRFormData_ICID2($ICID1, $ICID2){
		$query =
		'select
		c.id, flow.flow_id, form_sr.form_send_received_id, form_sr.form_location,
		c.name, c.mobile_phone, c.email, c.nic, c.gc_id, c.gender,
		flow.forward_interaction_name, flow.forward_interaction_centre_name, flow.forward_grade_name,
		flow.suggested_interaction_name, flow.suggested_interaction_centre_name, flow.suggested_grade_name,
		flow.forward_date, flow.forward_interaction_id,
		form_sr.interaction_centre_name as form_in_centre,form_sr.form_send_datetime,form_sr.form_received_datetime,
		form_sr.form_send_interaction_center_id, c.handedover_datetime,
		recom_by.recommended_interaction_centre_name, recom_by.recommended_grade_name,
		recom_by.recommended_interaction_name, recom_by.recommended_comments,
		recom_by.recommended_tags,
		c.created, c.register_by, c.modified, c.modified_by, c.record_deleted, c.shortlist_a, c.shortlist_b, c.initial_sa_interview, flow.interaction_finished
		from career c
		left join
		(select * from (select flow_id, career_id, forward_interaction_id, forward_interaction_centre_id, forward_grade_id, forward_interaction_name, forward_interaction_centre_name, forward_grade_name, forward_comments, forward_tags, suggested_interaction_id, suggested_interaction_centre_id, suggested_grade_id, suggested_interaction_name, suggested_interaction_centre_name, suggested_grade_name, suggested_comments, suggested_tags, suggested_date, interaction_finished, created as forward_date, modified as modified_date from interaction_flow_detail order by created desc) as sub group by career_id) as flow on flow.career_id = c.id
		left join
		(select * from (select form_send_received_id, form_send_interaction_center_id, career_id, form_location, interaction_centre_name, form_send_datetime, form_received_datetime, created, register_by, modified, modified_by, record_deleted from form_send_received_detail order by created desc) as sub group by career_id) as form_sr on form_sr.career_id = c.id
		left join
		(select * from (select recommended_id, career_id, forward_interaction_id as recommended_interaction_id, forward_interaction_name as recommended_interaction_name, forward_interaction_centre_id as recommended_interaction_centre_id, forward_interaction_centre_name as recommended_interaction_centre_name, forward_grade_id as recommended_grade_id, forward_grade_name as recommended_grade_name, forward_comments as recommended_comments, forward_tags as recommended_tags from recommended_by_ic_detail order by created desc) as sub group by career_id) as recom_by on recom_by.career_id = c.id
		where (c.initial_sa_interview = 1 and sl3 = 1) and (flow.forward_interaction_id = ' . $ICID1 . ' or flow.forward_interaction_id = ' . $ICID2 . ')';

		$sql = $this->db_career->query($query);
		return $sql->result();		
	}




	public $validation = array(
		array('field' => 'full_name', 'label' => 'Full Name', 'rules' => 'trim|sanitize|required|xss_clean'),
		array('field' => 'email', 'label' => 'Email Id', 'rules' => 'trim|sanitize|valid_email|required|xss_clean'),
		array('field' => 'cell_number', 'label' => 'Mobile Phone No.', 'rules' => 'trim|sanitize|min_length[12]|max_length[12]|xss_clean|required'),
		array('field' => 'cnic', 'label' => 'NIC No.', 'rules' => 'trim|sanitize|min_length[15]|max_length[15]|xss_clean|required'),
		array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim|sanitize|min_length[1]|max_length[1]|xss_clean|required'),
		array('field' => 'position_applied', 'label' => 'Applied Position', 'rules' => 'trim|sanitize|required'),
		array('field' => 'seeking_position', 'label' => 'Seeking Position', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'applied_before', 'label' => 'Applied before', 'rules' => 'trim|sanitize|xss_clean|min_length[1]|max_length[1]|required'),
		array('field' => 'dob', 'label' => 'Date of Birth', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'nationality', 'label' => 'Nationality', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'religion', 'label' => 'Religion', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'marital_status', 'label' => 'Marital Status', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'level_1_institute', 'label' => 'School Name', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'level_1_subject_1', 'label' => 'School Name', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'level_1_subject_2', 'label' => 'School Name', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'level_1_subject_3', 'label' => 'School Name', 'rules' => 'trim|sanitize|xss_clean|required'),		
		array('field' => 'level_1_result', 'label' => 'School Result', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'level_1_year', 'label' => 'School Passout Year', 'rules' => 'trim|sanitize|xss_clean|required|min_length[4]|max_length[4]'),
		array('field' => 'level_2_institute', 'label' => 'School / College Name', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'level_2_subject_1', 'label' => 'School Name', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'level_2_subject_2', 'label' => 'School Name', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'level_2_subject_3', 'label' => 'School Name', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'level_2_result', 'label' => 'School / College Result', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'level_2_year', 'label' => 'School / College Passout Year', 'rules' => 'trim|sanitize|xss_clean|required|min_length[4]|max_length[4]'),
		array('field' => 'level_3_institute_req', 'label' => 'University Name', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'level_3_subjects_req', 'label' => 'University Subjects', 'rules' => 'trim|sanitize|xss_clean|required|min_length[4]'),
		array('field' => 'level_3_degree_req', 'label' => 'University Degree', 'rules' => 'trim|sanitize|xss_clean|required|min_length[2]'),
		array('field' => 'level_3_result_req', 'label' => 'University Result', 'rules' => 'trim|sanitize|xss_clean|required'),
		array('field' => 'level_3_year_req', 'label' => 'University Passout Year', 'rules' => 'trim|sanitize|xss_clean|required|min_length[4]|max_length[4]'),
		array('field' => 'currently_employed', 'label' => 'Currently Employed', 'rules' => 'trim|sanitize|min_length[1]|max_length[1]|xss_clean|required'),


		array('field' => 'landline', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'training_qualification', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'additional_qualification', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'it_word', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'it_excel', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'it_powerpoint', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'it_erpsoftware', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'it_graphics', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'it_email', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'it_internet', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'it_other', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'currently_employed', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'notice_period', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'current_salary', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'expected_salary', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'current_timing', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'when_can_join', 'label' => '', 'rules' => 'trim|sanitize|xss_clean'),
		array('field' => 'birthPlace', 'label' => '', 'rules' => 'trim|sanitize|xss_clean')
		
		
		/*array('field' => '', 'label' => '', 'rules' => '')*/		
	);













	public function getDataFor_Handedover($thisDate){
		$query = "
		SELECT * FROM
			(
				select
				c.created, c.name, c.nic, c.mobile_phone, c.landline, c.gc_id, c.id, c.gender, c.initial_sa_interview
				from atif_career.career as c
				where from_unixtime(c.created) >= '$thisDate'
				and c.mobile_phone != ''
				and c.name != ''
				
				UNION
				
				select
				c.created, c.name, c.nic, c.mobile_phone, c.landline, c.gc_id, c.id, c.gender, c.initial_sa_interview
				from atif.hcm_staffing_applicantform as h
				left join (SELECT * from
					(select career.* from
					atif_career.career as career
					inner join
						(select
						max(c.id) as id
						from atif_career.career as c
						where from_unixtime(c.created) >= '$thisDate'
						and c.mobile_phone != ''
						and c.name != ''
						group by c.nic) as c
						on c.id = career.id) as career)
					as c
					on c.nic = h.nic
				order by id desc
			) as data
			where name != ''
			group by gc_id
			order by created desc
		";
		$sql = $this->db_career->query($query);
		return $sql->result();
	}





	public function getLastFormData($NIC){
		$query =
		"SELECT * from atif_career.career_form where nic = '" . $NIC . "' order by id desc limit 1";
		
		$sql = $this->db_career->query($query);
		
		return $sql->result();		
		
	}



	public function getLastFormData3($NIC)
	{
		$query= "select 1 from (
		    select nic as username from atif_career.career
		    union all
		    select nic from atif_career.career_form ) a
		where username = '".$NIC."'";

		$sql = $this->db_career->query($query);

		if( $sql->num_rows() > 0 )
		{
			return true;	
		}else
		{
			return false;
		}
	}



	public function getLastFormData2($NIC){
		// $query =
		// "SELECT * from atif_career.career_form where mobile_phone = '" . $NIC . "' order by id desc limit 1";
		//$sql = $this->db_career->query($query);
		//return $sql->result();	


		$query= "select Mobile_number from ( 
select c.mobile_phone as Mobile_number from atif_career.career as c
union all 
select  cf.mobile_phone as Mobile_number from atif_career.career_form as cf
) a 
where Mobile_number='".$NIC."'";


			

		$sql = $this->db_career->query($query);

		if( $sql->num_rows() > 0 )
		{
			return true;	
		}else
		{
			return false;
		}


	}












	public function get_careerForm_data($GCID){
		$query =
		"SELECT *,from_unixtime(created) as created_date from atif_career.career_form where gc_id = '" . $GCID . "'";

		$sql = $this->db_career->query($query);
		return $sql->result();		
	}
}