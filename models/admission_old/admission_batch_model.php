<?php
class Admission_batch_model extends CI_Model{

	private $db_studentAdmission;

	function __construct()
	{
		parent::__construct();
		$this->db_studentAdmission = $this->load->database('gs_admission',TRUE);
	}


	protected $_table_name = '_form_batch';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'id desc';	
	protected $_timestamps = TRUE;




	


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




	public function get_sp_form_batch_availabe(){
		$query = "SELECT
		*
		FROM
		(select
		gg.id as grade_id, gg.name as grade_name, bt.batch_category, DATE_FORMAT(bt.date,'%a %d, %b %Y') as batch_date, 
		TIME_FORMAT(bt.time_start, '%h:%i %p') as time_start, 
		TIME_FORMAT(bt.time_end, '%h:%i %p') as time_end, bt.duration_per_slot,
		IF(no_of_slots.total_slots is null, '',
			CONCAT(IFNULL(available_slots.total_slots, 0), ' / ' , IFNULL(no_of_slots.total_slots, 0))) AS no_of_slots


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


		order by grade_id, batch_date, time_start";

		$sql = $this->db_studentAdmission->query($query);
		return $sql->result();
	}
	
	public function sp_form_batch_detail($BATCH_CATEGORY){
		$query = "SELECT
	slot_id, slot_time, slot, IF(batch_id = 2, CONCAT(default_appointment, ' to ', LEFT(time_end, 5)),default_appointment) as default_appointment, 
	form_no, applicant_name, revised_batch, revised_appointment
	FROM
		(select 
		bs.id as slot_id, bs.form_batch_id, bs.sno as slot_sno,
		bs.admission_form_id, bs.revised_batch_slot_id, bs.time_start as slot_time,
		bt.grade_id, bt.batch_id, bt.batch_category, bt.date, bt.time_start, bt.time_end, bt.date as bt_date,
		bt.no_of_slots, bt.duration_per_slot,
		af.gf_id, af.form_no, af.official_name as applicant_name,
		CONCAT(REPLACE(bt2.batch_category, '-', ''), '-', LPAD(bs2.sno, 2, '0')) AS revised_batch,
		CONCAT(DATE_FORMAT(bt2.date, '%a %d %b, %Y'), ' @ ', CAST(LEFT(bs2.time_start, 5) AS CHAR CHARACTER SET utf8)) AS revised_appointment,
		CONCAT(REPLACE(bt.batch_category, '-', ''), '-', LPAD(bs.sno, 2, '00')) as slot,
		CONCAT(DATE_FORMAT(bt.date, '%a %d %b, %Y'), ' @ ', CAST(LEFT(bs.time_start, 5) AS CHAR CHARACTER SET utf8)) as default_appointment



		from atif_gs_admission._form_batch as bt
		left join atif_gs_admission._form_batch_slots as bs
			on bt.id = bs.form_batch_id
		left join atif_gs_admission.admission_form as af
			on af.id = bs.admission_form_id
			
		left join atif_gs_admission._form_batch_slots as bs2
			on bs2.id = bs.revised_batch_slot_id
		left join atif_gs_admission._form_batch as bt2
			on bt2.id = bs2.form_batch_id

		where REPLACE(bt.batch_category, '-', '') = '$BATCH_CATEGORY') AS DATA

	order by
	date, slot_time, slot";
		$row = $this->db_studentAdmission->query($query);
		return $row->result();
	}

	public function get_batch_code($grade_id){
		$query = "SELECT
		concat(bt.batch_code, '-', LPAD(CAST(num AS CHAR CHARACTER SET utf8),2,'0')) as batch_name, num

		from
		(select 
			(RIGHT(batch_category, 2)+1) as num, grade_id
			from atif_gs_admission._form_batch
			where grade_id = $grade_id
			order by batch_category desc
			limit 1
		) as b
		left join atif_gs_admission._dob_grade as bt
			on bt.id = $grade_id";
		$row = $this->db_studentAdmission->query($query);
		return $row->result();
	}

		public function get_by_all($tablename,$select='',$where=null,$group=''){

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


	//===================Slots Available ===============================//
	//==================================================================//

	public function available_slots($batch_category){
		$query = "Select count(fbs.id) as total_slot_available  from _form_batch fb
			inner join _form_batch_slots fbs on fbs.form_batch_id = fb.id
			where fb.batch_category = '$batch_category' and fbs.admission_form_id  = ''";
		$row = $this->db->query($query);
		return $row->result();

	}

	//=========================Total Slots ================================//
	//=====================================================================//

	public function total_slots($batch_category){
		$query = "Select count(fbs.id) as total_slot_available  from _form_batch fb
			inner join _form_batch_slots fbs on fbs.form_batch_id = fb.id
			where fb.batch_category = '$batch_category'";
		$row = $this->db->query($query);
		return $row->result();

	}

	public function insert_data($tablename,$data){

		$this->db->insert($tablename,$data);
		
		$affected = $this->db->affected_rows();
		return $affected;

	}

	// public function get_sp_batch_available_grade_id($grade_id){
	// 	$query ="SELECT
	// 			*
	// 			FROM
	// 			(select
	// 			gg.id as grade_id, gg.name as grade_name, bt.batch_category, bt.date as batch_date, bt.time_start, bt.time_end, bt.duration_per_slot,
	// 			IF(no_of_slots.total_slots is null, '',
	// 				CONCAT(IFNULL(available_slots.total_slots, 0), ' / ' , IFNULL(no_of_slots.total_slots, 0))) AS no_of_slots


	// 			from atif_gs_admission._form_batch as bt
	// 			left join atif._grade as gg
	// 				on gg.id = bt.grade_id

	// 			left join (select 
	// 			bs.form_batch_id, count(bs.form_batch_id) as total_slots
	// 			from atif_gs_admission._form_batch_slots as bs
	// 			group by form_batch_id) as no_of_slots
	// 				on no_of_slots.form_batch_id = bt.id
					
	// 			left join (select 
	// 			bs.form_batch_id, count(bs.form_batch_id) as total_slots
	// 			from atif_gs_admission._form_batch_slots as bs
	// 			where bs.admission_form_id = 0
	// 			group by form_batch_id) as available_slots
	// 				on available_slots.form_batch_id = bt.id) AS DATA

	// 			where grade_id = $grade_id
	// 			order by grade_id, batch_date, time_start";
	// 			$row = $this->db->query($query);
	// 			return $row->result();
	// }


	public function get_category_teacher($grade_id,$status_id,$category){
		$query = "SELECT afa.id,afa.grade_id,afa.form_status_id,afa.category,afa.staff_id,sr.name FROM admission_form_and afa
		inner join atif.staff_registered sr on sr.id = afa.staff_id
		inner join atif._grade g on g.id = afa.grade_id
		where  g.id= ".$grade_id." and afa.form_status_id =".$status_id." and afa.category = '".$category."'";
		$row = $this->db->query($query);
		return $row->result();
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


	public function  get_result_discussion($form_id,$form_status_id){

		$query = "Select LPAD(af.form_no, 4, '0') AS form_no,af.official_name,af.form_status_id,
		af.form_assessment_result,af.form_assessment_result_by,
		af.form_assessment_decision,af.form_assessment_decision_by,
		af.form_discussion_date,af.form_discussion_time,af.form_discussion_result,
		af.form_discussion_result_by,af.form_discussion_decision,af.form_discussion_decision_by,
		sr.name as form_assessment_result_by_name,sd.name as form_assessment_decision_by_name,
		sdr.name as form_discussion_result_by_name,sdd.name as form_discussion_decision_by_name,af.form_discussion_criteria,
		afw.weightage,af.offer_date
		from atif_gs_admission.admission_form af

		left join atif.staff_registered sr on (sr.id = af.form_assessment_result_by)
		left join atif.staff_registered sd on (sd.id = af.form_assessment_decision_by)
		left join atif.staff_registered sdr on (sdr.id = af.form_discussion_result_by)
		left join atif.staff_registered sdd on (sdd.id = af.form_discussion_decision_by)

		inner join atif_gs_admission._form_status fs on fs.id = af.form_status_id
		left join (select * from atif_gs_admission.admission_form_waitlist where form_status_id=".$form_status_id.") as afw on afw.admission_form_id = af.id

		where  af.id  = ".$form_id;
		$row = $this->db->query($query);
		return $row->result();

	}


	public function sp_form_complete_log($form_id) {

		$query = "SELECT * FROM
			(
			/************************************************* Form Issuance
			*****************************************************************/
			select
			af.id as admission_form_id, FROM_UNIXTIME(af.created) as change_date, DATE_FORMAT(FROM_UNIXTIME(af.created), '%d-%b-%Y %h:%i %p') as dt, '' as reason,
			CONCAT('Admission form issued', ' on ', DATE_FORMAT(FROM_UNIXTIME(af.created), '%d-%b-%Y %h:%i %p')) as message,
			'Issuance' as type, sr.employee_id as photo_id, af.register_by as user_id, sr.abridged_name as staff_name, 1 as this_order
			from atif_gs_admission.admission_form as af
			left join atif.staff_registered as sr
			    on sr.user_id = af.register_by
			where af.id = $form_id /***** Change Form ID *****/
			
			
			
			UNION
			
			
			/************************************** Form Issuance - Comments
			*****************************************************************/
			select
			af.id as admission_form_id, FROM_UNIXTIME(af.created) as change_date, DATE_FORMAT(FROM_UNIXTIME(af.created), '%d-%b-%Y %h:%i %p') as dt,
			IF(af.comments!='', 'Admission Form Comments', '') as reason,
			IF(af.comments != '', af.comments, '') as message,
			'Comments' as type, sr.employee_id as photo_id, af.register_by as user_id, sr.abridged_name as staff_name, 1 as this_order
			from atif_gs_admission.admission_form as af
			left join atif.staff_registered as sr
			    on sr.user_id = af.register_by
			where af.id = $form_id and af.comments!='' /***** Change Form ID *****/



			UNION

			/*************************************************** Form Status - Submission
			*****************************************************************/
			select
			lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p') as dt, '' as reason,
			CONCAT(fst_new.name, ' on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
			'Status' as type, sr.employee_id as photo_id, lgs.modified_by as user_id, sr.abridged_name as staff_name, 2 as this_order

			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission._form_status as fst_old
			    on fst_old.id = lgs.old_form_status
			left join atif_gs_admission._form_status as fst_new
			    on fst_new.id = lgs.new_form_status
			left join atif.staff_registered as sr
			    on sr.user_id = lgs.modified_by
			where lgs.admission_form_id = $form_id /***** Change Form ID *****/    
			and lgs.type = 'S' and lgs.old_form_status=1 and lgs.new_form_status=2
			group by lgs.admission_form_id

			UNION


			/************************************ Communication - Assessment
			*****************************************************************/
			select
			lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p') as dt, '' as reason,
			CONCAT('Communication of Assessment on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
			'Stage' as type, sr.employee_id as photo_id, lgs.modified_by as user_id, sr.abridged_name as staff_name, 3 as this_order

			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission._form_status_stage as fst_old
			    on fst_old.id = lgs.new_form_stage
			left join atif_gs_admission._form_status_stage as fst_new
			    on fst_new.id = lgs.new_form_stage
			left join atif.staff_registered as sr
			    on sr.user_id = lgs.modified_by
			where lgs.admission_form_id = $form_id /***** Change Form ID *****/    
			and lgs.new_form_status = 2 and lgs.new_form_stage = 2
			group by admission_form_id


			UNION


			/***************************************** Presence - Assessment
			*****************************************************************/
			select
			lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p') as dt, '' as reason,
			CONCAT('Presence of Assessment on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
			'Stage' as type, sr.employee_id as photo_id, lgs.modified_by as user_id, sr.abridged_name as staff_name, 3 as this_order

			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission._form_status_stage as fst_old
			    on fst_old.id = lgs.new_form_stage
			left join atif_gs_admission._form_status_stage as fst_new
			    on fst_new.id = lgs.new_form_stage
			left join atif.staff_registered as sr
			    on sr.user_id = lgs.modified_by
			where lgs.admission_form_id = $form_id /***** Change Form ID *****/    
			and lgs.new_form_status = 3 and lgs.new_form_stage = 4
			group by admission_form_id


			UNION



			/*********************************** Form Status Stage - Beyond 5
			*****************************************************************/
			/*
			select
			lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, '' as reason,
			CONCAT(fst_new.name, ' on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
			'Stage' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 5 as this_order

			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission._form_status_stage as fst_old
			    on fst_old.id = lgs.new_form_stage
			left join atif_gs_admission._form_status_stage as fst_new
			    on fst_new.id = lgs.new_form_stage
			left join atif.staff_registered as sr
			    on sr.user_id = lgs.modified_by
			where lgs.admission_form_id = $form_id /***** Change Form ID *****/    
			/*and lgs.type = 'G' and lgs.new_form_status >= 5


			UNION*/



			/************************************************* Form Comments
			*****************************************************************/
			select
			com.admission_form_id, FROM_UNIXTIME(com.created) as change_date, DATE_FORMAT(FROM_UNIXTIME(com.created), '%d-%b-%Y %h:%i %p') as dt,
			IF(com.reason = '', '', com.reason) as reason,
			com.comments as message, 'Comments' as type,
			if(sr.employee_id='298', 'gs_logo', sr.employee_id) as photo_id, com.register_by as user_id, sr.abridged_name as staff_name, 4 as this_order

			from atif_gs_admission.log_form_comments as com
			left join atif.staff_registered as sr
			    on sr.user_id = com.register_by
			        
			where com.admission_form_id = $form_id /***** Change Form ID *****/        
			) AS DATA

			order by admission_form_id, change_date, this_order";

				

			$row = $this->db->query($query);
			return $row->result();

	}


	public function get_aso_and($batch_id){
		$query = "select
				af.form_id, LPAD(af.form_no, 4, '0') AS form_no, af.official_name as applicant_name, af.father_name,

				/***** Assessment *****/
				CONCAT(DATE_FORMAT(af.form_assessment_date, '%a %d %b'), '@ ', TIME_FORMAT(af.batch_time_submission, '%h:%i')) as form_assessment_date,
				IFNULL(DATE_FORMAT(AST_Presence.date, '%a %d %b'),'') AS ast_done_on, af.ast_name_code, 
				IF(IFNULL(AST_Reminder.admission_form_id,0)=0,0,1) as flag_ast_reminder, IF(IFNULL(AST_Presence.date,0)=0,0,1) as flag_ast_presence, 
				IF(IFNULL(AST_Followup.admission_form_id,0)=0,0,1) as flag_ast_followup,
				af.form_assessment_result, af.form_assessment_decision,
				IF(af.form_assessment_result='',0,1) as flag_ast_result,
				IF(af.form_assessment_decision='',0,1) as flag_ast_decision, IF(af.form_assessment_decision='',0,1) as flag_ast_allocation,
				IF(IFNULL(DIS_Communication.admission_form_id,0)=0,0,1) as flag_comm_ast_result,
				/***** Assessment - END *****/



				IF(IFNULL(OFFER.admission_form_id, 'A')='A', 'Approval Pending', DATE_FORMAT(OFFER.date, '%a %d %b')) as OFFER,



				/***** Assessment *****/
				IFNULL(CONCAT(DATE_FORMAT(af.form_discussion_date, '%a %d %b'), '@ ', TIME_FORMAT(af.form_discussion_time, '%h:%i')), '') as form_discussion_date,
				IFNULL(DATE_FORMAT(Dis_Presence.date, '%a %d %b'),'') AS dis_done_on, af.dis_name_code,
				IF(IFNULL(DIS_Reminder.admission_form_id,0)=0,0,1) as flag_dis_reminder, IF(IFNULL(DIS_Presence.date,0)=0,0,1) as flag_dis_presence, 
				IF(IFNULL(DIS_Followup.admission_form_id,0)=0,0,1) as flag_dis_followup,
				af.form_discussion_result, af.form_discussion_decision,
				IF(af.form_discussion_result='',0,1) as flag_dis_result,
				IF(af.form_discussion_decision='',0,1) as flag_dis_decision, IF(af.form_discussion_decision='',0,1) as flag_dis_allocation,
				IF(IFNULL(OFR_Communication.admission_form_id,0)=0,0,1) as flag_comm_dis_result,
				/***** Assessment - END *****/




				DATE_FORMAT(af.offer_date, '%a %d %b') as offer_date,


				/***** Other References Fields *****/
				af.form_batch_id, af.grade_id, af.and_id, af.and_batch,
				
				af.batch_category, af.grade_name,
				/***** Other References Fields - END *****/




				/***** Final Decision *****/
				af.form_status_id, af.form_status_stage_id,
				IF((af.form_status_id>=3 AND af.form_status_id<=6) AND af.form_status_stage_id=15, 'Regret',
					IF((af.form_status_id>=3 AND af.form_status_id<=6) AND af.form_status_stage_id=17, 'Wait List',
					IF((af.form_status_id>=3 AND af.form_status_id<=6) AND af.form_status_stage_id=16, 'On Hold',
					IF(af.form_status_id>=5 AND (af.form_status_stage_id<=3  OR af.form_status_stage_id = 7 OR af.form_status_stage_id = 11 OR af.af.form_status_stage_id = 10), CONCAT('Offer ', IFNULL(DATE_FORMAT(af.offer_date, '%a %d %b'),'')),
					IF((af.form_status_id>=4 OR af.form_status_id<=6) AND (af.form_status_stage_id=12 OR af.form_status_stage_id=6 OR af.form_status_stage_id=8  OR af.form_status_stage_id=9), 'Approval Pending', '-'
				  ))))) as final_decision
				/***** Final Decision - END *****/
				
				


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
					and (new_form_stage = 5 or new_form_stage = 7 or new_form_stage = 10 or new_form_stage = 11)
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
					and (new_form_stage = 5 or new_form_stage = 7 or new_form_stage = 10 or new_form_stage = 11)
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



				where af.form_assessment_date != '0000-00-00'
				and af.form_assessment_date != '2001-01-01'
				and af.form_batch_id  = $batch_id order by af.batch_time_submission";

				$row = $this->db->query($query);
				return $row->result();
	}


	public function get_and_detail($form_no){
		$query = "select
		af.form_id, LPAD(af.form_no, 4, '0') AS form_no, af.official_name as applicant_name, af.father_name,

		/***** Assessment *****/
		CONCAT(DATE_FORMAT(af.form_assessment_date, '%a %d %b'), '@ ', TIME_FORMAT(af.batch_time_submission, '%h:%i')) as form_assessment_date,
		IFNULL(DATE_FORMAT(AST_Presence.date, '%a %d %b'),'') AS ast_done_on, af.ast_name_code, 
		IF(IFNULL(AST_Reminder.admission_form_id,0)=0,0,1) as flag_ast_reminder, IF(IFNULL(AST_Presence.date,0)=0,0,1) as flag_ast_presence, 
		IF(IFNULL(AST_Followup.admission_form_id,0)=0,0,1) as flag_ast_followup,
		af.form_assessment_result, af.form_assessment_decision,
		IF(af.form_assessment_result='',0,1) as flag_ast_result,
		IF(af.form_assessment_decision='',0,1) as flag_ast_decision, IF(af.form_assessment_decision='',0,1) as flag_ast_allocation,
		IF(IFNULL(DIS_Communication.admission_form_id,0)=0,0,1) as flag_comm_ast_result,
		/***** Assessment - END *****/



		IF(IFNULL(OFFER.admission_form_id, 'A')='A', 'Approval Pending', DATE_FORMAT(OFFER.date, '%a %d %b')) as OFFER,



		/***** Assessment *****/
		IFNULL(CONCAT(DATE_FORMAT(af.form_discussion_date, '%a %d %b'), '@ ', TIME_FORMAT(af.form_discussion_time, '%h:%i')), '') as form_discussion_date,
		IFNULL(DATE_FORMAT(Dis_Presence.date, '%a %d %b'),'') AS dis_done_on, af.dis_name_code,
		IF(IFNULL(DIS_Reminder.admission_form_id,0)=0,0,1) as flag_dis_reminder, IF(IFNULL(DIS_Presence.date,0)=0,0,1) as flag_dis_presence, 
		IF(IFNULL(DIS_Followup.admission_form_id,0)=0,0,1) as flag_dis_followup,
		af.form_discussion_result, af.form_discussion_decision,
		IF(af.form_discussion_result='',0,1) as flag_dis_result,
		IF(af.form_discussion_decision='',0,1) as flag_dis_decision, IF(af.form_discussion_decision='',0,1) as flag_dis_allocation,
		IF(IFNULL(OFR_Communication.admission_form_id,0)=0,0,1) as flag_comm_dis_result,
		/***** Assessment - END *****/




		DATE_FORMAT(af.offer_date, '%a %d %b') as offer_date,


		/***** Other References Fields *****/
		af.form_batch_id, af.grade_id, af.and_id, af.and_batch,
		af.batch_category, af.grade_name
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
			and (new_form_stage = 5 or new_form_stage = 7 or new_form_stage = 10 or new_form_stage = 11)
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
			and (new_form_stage = 5 or new_form_stage = 7 or new_form_stage = 10 or new_form_stage = 11)
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



		where af.form_assessment_date != '0000-00-00'
		and af.form_assessment_date != '2001-01-01'
		and af.form_id = $form_no";
		$row = $this->db->query($query);
		return $row->result();

	}


	public function get_aso_and_by_grade($grade_id){
		$query = "select
				af.form_id, LPAD(af.form_no, 4, '0') AS form_no, af.official_name as applicant_name, af.father_name,

				/***** Assessment *****/
				CONCAT(DATE_FORMAT(af.form_assessment_date, '%a %d %b'), '@ ', TIME_FORMAT(af.batch_time_submission, '%h:%i')) as form_assessment_date,
				IFNULL(DATE_FORMAT(AST_Presence.date, '%a %d %b'),'') AS ast_done_on, af.ast_name_code, 
				IF(IFNULL(AST_Reminder.admission_form_id,0)=0,0,1) as flag_ast_reminder, IF(IFNULL(AST_Presence.date,0)=0,0,1) as flag_ast_presence, 
				IF(IFNULL(AST_Followup.admission_form_id,0)=0,0,1) as flag_ast_followup,
				af.form_assessment_result, af.form_assessment_decision,
				IF(af.form_assessment_result='',0,1) as flag_ast_result,
				IF(af.form_assessment_decision='',0,1) as flag_ast_decision, IF(af.form_assessment_decision='',0,1) as flag_ast_allocation,
				IF(IFNULL(DIS_Communication.admission_form_id,0)=0,0,1) as flag_comm_ast_result,
				/***** Assessment - END *****/



				IF(IFNULL(OFFER.admission_form_id, 'A')='A', 'Approval Pending', DATE_FORMAT(OFFER.date, '%a %d %b')) as OFFER,



				/***** Assessment *****/
				IFNULL(CONCAT(DATE_FORMAT(af.form_discussion_date, '%a %d %b'), '@ ', TIME_FORMAT(af.form_discussion_time, '%h:%i')), '') as form_discussion_date,
				IFNULL(DATE_FORMAT(Dis_Presence.date, '%a %d %b'),'') AS dis_done_on, af.dis_name_code,
				IF(IFNULL(DIS_Reminder.admission_form_id,0)=0,0,1) as flag_dis_reminder, IF(IFNULL(DIS_Presence.date,0)=0,0,1) as flag_dis_presence, 
				IF(IFNULL(DIS_Followup.admission_form_id,0)=0,0,1) as flag_dis_followup,
				af.form_discussion_result, af.form_discussion_decision,
				IF(af.form_discussion_result='',0,1) as flag_dis_result,
				IF(af.form_discussion_decision='',0,1) as flag_dis_decision, IF(af.form_discussion_decision='',0,1) as flag_dis_allocation,
				IF(IFNULL(OFR_Communication.admission_form_id,0)=0,0,1) as flag_comm_dis_result,
				/***** Assessment - END *****/




				DATE_FORMAT(af.offer_date, '%a %d %b') as offer_date,


				/***** Other References Fields *****/
				af.form_batch_id, af.grade_id, af.and_id, af.and_batch,
				
				af.batch_category, af.grade_name,
				/***** Other References Fields - END *****/




				/***** Final Decision *****/
				af.form_status_id, af.form_status_stage_id,
				IF((af.form_status_id>=3 AND af.form_status_id<=6) AND af.form_status_stage_id=15, 'Regret',
					IF((af.form_status_id>=3 AND af.form_status_id<=6) AND af.form_status_stage_id=17, 'Wait List',
					IF((af.form_status_id>=3 AND af.form_status_id<=6) AND af.form_status_stage_id=16, 'On Hold',
					IF(af.form_status_id>=5 AND (af.form_status_stage_id<=3 OR af.form_status_stage_id = 7 OR af.form_status_stage_id = 11 OR af.form_status_stage_id = 10), CONCAT('Offer ', IFNULL(DATE_FORMAT(af.offer_date, '%a %d %b'),'')),
					IF((af.form_status_id>=4 OR af.form_status_id<=6) AND (af.form_status_stage_id=12 OR af.form_status_stage_id=6 OR af.form_status_stage_id=8  OR af.form_status_stage_id=9), 'Approval Pending', '-'
				  ))))) as final_decision
				/***** Final Decision - END *****/
				
				


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
					and (new_form_stage = 5 or new_form_stage = 7 or new_form_stage = 10 or new_form_stage = 11)
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
					and (new_form_stage = 5 or new_form_stage = 7 or new_form_stage = 10 or new_form_stage = 11)
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



				where af.form_assessment_date != '0000-00-00'
				and af.form_assessment_date != '2001-01-01'
				and af.grade_id  = ".$grade_id;

		$row = $this->db->query($query);
		return $row->result();
	}


	// Batch Sheet
	public function getbatchadmissiondetail($batch_id){

		$batch_id = SUBSTR($batch_id, 0, 1) . '-' . SUBSTR($batch_id, -2);
		$query = "select * from
					(select
					af.form_id, LPAD(af.form_no, 4, '0') AS form_no,
					if(af.gf_id >= 18000 and af.gf_id <= 19000, '', concat(left(lpad(af.gf_id, 5, 0),2),'-',right(lpad(af.gf_id, 5, 0),3))) as gf_id,
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
					ifnull(outcome.outcome_date,'') as outcome_date, waitlist.weightage, wil.wil_decision
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
					
					/***** Waitlist *****/
					left join (Select 
									admission_form_id, form_status_id, weightage
								From atif_gs_admission.admission_form_waitlist ) as waitlist on
							waitlist.admission_form_id = af.form_id
					left join (select admission_form_id, wil_decision 
								from(select
									id as id, admission_form_id,
									if(new_form_stage = 6 or new_form_stage = 15, 'RGT',
									if(new_form_stage = 8 or new_form_stage = 16, 'OHD',
									if(new_form_stage = 9 or new_form_stage = 17, 'WIL',
									if(new_form_stage = 7, 'NIT',
									if(new_form_status >= 5, 'OFR',''))))) as wil_decision
								from atif_gs_admission.log_form_status			
								where (old_form_stage = 9 or old_form_stage = 17)
								order by admission_form_id, id desc) as da
								group by admission_form_id) as wil
								on wil.admission_form_id = af.form_id
					/***** Waitlist - END *****/
					
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
					and af.batch_category = '$batch_id'



					order by af.batch_time_submission) as data
					group by form_no
					
					order by batch_time_submission, form_no";


		$row = $this->db->query($query);
		return $row->result();

	}

	public function getbatchadmissiondetailAlevel($form_id){

		$query = "SELECT af.id AS form_id, LPAD(af.form_no, 4, '0') form_no,af.official_name as applicant_name, DATE_FORMAT(af.dob, '%d-%b-%Y') AS dob,fr.father_name ,fr.mother_name,af.grade_name,CONCAT(DATE_FORMAT(af.form_assessment_date, '%a %d %b'), '@ ', TIME_FORMAT(af.form_discussion_time, '%h:%i')) as form_assessment_date,if(af.gf_id >= 18000 and af.gf_id <= 19000, '', concat(left(lpad(af.gf_id, 5, 0),2),'-',right(lpad(af.gf_id, 5, 0),3))) as gf_id,af.grade_id
			FROM atif_gs_admission.admission_form af
			LEFT JOIN atif_gs_admission.family_registration fr on fr.gf_id = af.gf_id
			WHERE af.id = ".$form_id;


		$row = $this->db->query($query);
		return $row->result();

	}


	public function get_stage_applicant($form_status_stage_id,$grade){
		$query = "select
		af.form_id, LPAD(af.form_no, 4, '0') AS form_no, af.official_name as applicant_name, af.father_name,

		/***** Assessment *****/
		CONCAT(DATE_FORMAT(af.form_assessment_date, '%a %d %b'), '@ ', TIME_FORMAT(af.batch_time_submission, '%h:%i')) as form_assessment_date,
		IFNULL(DATE_FORMAT(AST_Presence.date, '%a %d %b'),'') AS ast_done_on, af.ast_name_code, 
		IF(IFNULL(AST_Reminder.admission_form_id,0)=0,0,1) as flag_ast_reminder, IF(IFNULL(AST_Presence.date,0)=0,0,1) as flag_ast_presence, 
		IF(IFNULL(AST_Followup.admission_form_id,0)=0,0,1) as flag_ast_followup,
		af.form_assessment_result, af.form_assessment_decision,
		IF(af.form_assessment_result='',0,1) as flag_ast_result,
		IF(af.form_assessment_decision='',0,1) as flag_ast_decision, IF(af.form_assessment_decision='',0,1) as flag_ast_allocation,
		IF(IFNULL(DIS_Communication.admission_form_id,0)=0,0,1) as flag_comm_ast_result,
		/***** Assessment - END *****/



		IF(IFNULL(OFFER.admission_form_id, 'A')='A', 'Approval Pending', DATE_FORMAT(OFFER.date, '%a %d %b')) as OFFER,



		/***** Assessment *****/
		IFNULL(CONCAT(DATE_FORMAT(af.form_discussion_date, '%a %d %b'), '@ ', TIME_FORMAT(af.form_discussion_time, '%h:%i')), '') as form_discussion_date,
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
		af.batch_category, af.grade_name,
		/***** Other References Fields - END *****/

		/***** Final Decision *****/
		af.form_status_id, af.form_status_stage_id,
		IF((af.form_status_id>=3 AND af.form_status_id<=6) AND af.form_status_stage_id=15, 'Regret',
			IF((af.form_status_id>=3 AND af.form_status_id<=6) AND af.form_status_stage_id=17, 'Wait List',
			IF((af.form_status_id>=3 AND af.form_status_id<=6) AND af.form_status_stage_id=16, 'On Hold',
			IF(af.form_status_id>=5 AND af.form_status_stage_id<=3, CONCAT('Offer ', IFNULL(DATE_FORMAT(af.offer_date, '%a %d %b'),'')),
			IF((af.form_status_id>=4 OR af.form_status_id<=6) AND (af.form_status_stage_id=12 OR af.form_status_stage_id=6 OR af.form_status_stage_id=8  OR af.form_status_stage_id=9), 'Approval Pending', '-'
		  ))))) as final_decision
		/***** Final Decision - END *****/





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
			and (new_form_stage = 5 or new_form_stage = 7 or new_form_stage = 10 or new_form_stage = 11)
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
			and (new_form_stage = 5 or new_form_stage = 7 or new_form_stage = 10 or new_form_stage = 11)
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



		where af.form_assessment_date != '0000-00-00'
		and af.form_assessment_date != '2001-01-01'
		and (af.form_status_id = 3 or af.form_status_id = 4 or af.form_status_id = 5)
		and af.form_status_stage_id = ".$form_status_stage_id. 
		" and af.grade_id = ".$grade  ;
		$row = $this->db->query($query);
		return $row->result();
	}


	public function get_offer_stage($stage,$grade){
		$query = "select
		af.form_id, LPAD(af.form_no, 4, '0') AS form_no, af.official_name as applicant_name, af.father_name,

		/***** Assessment *****/
		CONCAT(DATE_FORMAT(af.form_assessment_date, '%a %d %b'), '@ ', TIME_FORMAT(af.batch_time_submission, '%h:%i')) as form_assessment_date,
		IFNULL(DATE_FORMAT(AST_Presence.date, '%a %d %b'),'') AS ast_done_on, af.ast_name_code, 
		IF(IFNULL(AST_Reminder.admission_form_id,0)=0,0,1) as flag_ast_reminder, IF(IFNULL(AST_Presence.date,0)=0,0,1) as flag_ast_presence, 
		IF(IFNULL(AST_Followup.admission_form_id,0)=0,0,1) as flag_ast_followup,
		af.form_assessment_result, af.form_assessment_decision,
		IF(af.form_assessment_result='',0,1) as flag_ast_result,
		IF(af.form_assessment_decision='',0,1) as flag_ast_decision, IF(af.form_assessment_decision='',0,1) as flag_ast_allocation,
		IF(IFNULL(DIS_Communication.admission_form_id,0)=0,0,1) as flag_comm_ast_result,
		/***** Assessment - END *****/



		IF(IFNULL(OFFER.admission_form_id, 'A')='A', 'Approval Pending', DATE_FORMAT(OFFER.date, '%a %d %b')) as OFFER,



		/***** Assessment *****/
		IFNULL(CONCAT(DATE_FORMAT(af.form_discussion_date, '%a %d %b'), '@ ', TIME_FORMAT(af.form_discussion_time, '%h:%i')), '') as form_discussion_date,
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
		af.batch_category, af.grade_name,
		/***** Other References Fields - END *****/

		/***** Final Decision *****/
		af.form_status_id, af.form_status_stage_id,
		IF((af.form_status_id>=3 AND af.form_status_id<=6) AND af.form_status_stage_id=15, 'Regret',
			IF((af.form_status_id>=3 AND af.form_status_id<=6) AND af.form_status_stage_id=17, 'Wait List',
			IF((af.form_status_id>=3 AND af.form_status_id<=6) AND af.form_status_stage_id=16, 'On Hold',
			IF(af.form_status_id>=5 AND af.form_status_stage_id<=3, CONCAT('Offer ', IFNULL(DATE_FORMAT(af.offer_date, '%a %d %b'),'')),
			IF((af.form_status_id>=4 OR af.form_status_id<=6) AND (af.form_status_stage_id=12 OR af.form_status_stage_id=6 OR af.form_status_stage_id=8  OR af.form_status_stage_id=9), 'Approval Pending', '-'
		  ))))) as final_decision
		/***** Final Decision - END *****/

 




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
			and (new_form_stage = 5 or new_form_stage = 7 or new_form_stage = 10 or new_form_stage = 11)
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
			and (new_form_stage = 5 or new_form_stage = 7 or new_form_stage = 10 or new_form_stage = 11)
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



		where af.form_assessment_date != '0000-00-00'
		and af.form_assessment_date != '2001-01-01'		
		and (af.form_status_id = 5)
		and af.form_status_stage_id = $stage 
		and af.grade_id = $grade  ";
		
		$row = $this->db->query($query);
		return $row->result();
	}




	// Batch Wise Grade Summary
	public function get_batchwisegradesummary($grade){
		$query = "SELECT
					total_forms, form_no, gender_b, gender_g, grade_id, grade_name, siblings, pet, batch_case, batch, batch_date, batch_id, re_allocated, 
					ass_ap, ass_a, ass_am, ass_bp, ass_b, ass_bm, ass_c, ass_d, ass_total, ass_cfd, ass_wl, ass_oh, ass_rgr, ass_rgr_pre,
					dsc_ap, dsc_a, dsc_am, dsc_bp, dsc_b, dsc_bm, dsc_c, dsc_d, dsc_total, dsc_cfd, dsc_tbo, dsc_wl, dsc_oh, dsc_rgr, dsc_rgr_pre,
					(ass_wl+dsc_wl) as inter_wl,
					(ass_oh+dsc_oh) as inter_oh,
					ofd_total as inter_ofd, adm_cnf

					FROM
					(select
					count(form_id) as total_forms, form_no, 
					SUM(CASE WHEN gender='B' THEN 1 ELSE 0 END) as gender_b, 
					SUM(CASE WHEN gender='G' THEN 1 ELSE 0 END) as gender_g,
					grade_id, grade_name, sum(siblings) as siblings, sum(pet) as pet, 
					batch_case, batch, batch_date, batch_id, sum(re_allocated) as re_allocated,
					/***** Assessment *****/ 
					SUM(CASE WHEN form_assessment_result='A+' THEN 1 ELSE 0 END) as ass_ap,
					SUM(CASE WHEN form_assessment_result='A' THEN 1 ELSE 0 END) as ass_a,
					SUM(CASE WHEN form_assessment_result='A-' THEN 1 ELSE 0 END) as ass_am,
					SUM(CASE WHEN form_assessment_result='B+' THEN 1 ELSE 0 END) as ass_bp,
					SUM(CASE WHEN form_assessment_result='B' THEN 1 ELSE 0 END) as ass_b,
					SUM(CASE WHEN form_assessment_result='B-' THEN 1 ELSE 0 END) as ass_bm,
					SUM(CASE WHEN form_assessment_result='C' THEN 1 ELSE 0 END) as ass_c,
					SUM(CASE WHEN form_assessment_result='D' THEN 1 ELSE 0 END) as ass_d,

					SUM(CASE WHEN assessment='NI' THEN 1 ELSE 0 END) as ass_total,
					SUM(CASE WHEN assessment='CFD' THEN 1 ELSE 0 END) as ass_cfd,
					SUM(CASE WHEN assessment='WL' THEN 1 ELSE 0 END) as ass_wl,
					SUM(CASE WHEN assessment='OH' THEN 1 ELSE 0 END) as ass_oh,
					SUM(CASE WHEN assessment='RGR' THEN 1 ELSE 0 END) as ass_rgr,
					SUM(CASE WHEN assessment='RGR-Pre' THEN 1 ELSE 0 END) as ass_rgr_pre,

					/***** Discussion *****/
					SUM(CASE WHEN form_discussion_result='A+' THEN 1 ELSE 0 END) as dsc_ap,
					SUM(CASE WHEN form_discussion_result='A' THEN 1 ELSE 0 END) as dsc_a,
					SUM(CASE WHEN form_discussion_result='A-' THEN 1 ELSE 0 END) as dsc_am,
					SUM(CASE WHEN form_discussion_result='B+' THEN 1 ELSE 0 END) as dsc_bp,
					SUM(CASE WHEN form_discussion_result='B' THEN 1 ELSE 0 END) as dsc_b,
					SUM(CASE WHEN form_discussion_result='B-' THEN 1 ELSE 0 END) as dsc_bm,
					SUM(CASE WHEN form_discussion_result='C' THEN 1 ELSE 0 END) as dsc_c,
					SUM(CASE WHEN form_discussion_result='D' THEN 1 ELSE 0 END) as dsc_d,

					SUM(CASE WHEN discussion='NI' THEN 1 ELSE 0 END) as dsc_total,
					SUM(CASE WHEN discussion='CFD' THEN 1 ELSE 0 END) as dsc_cfd,
					SUM(CASE WHEN discussion='TBO' THEN 1 ELSE 0 END) as dsc_tbo,
					SUM(CASE WHEN discussion='WL' THEN 1 ELSE 0 END) as dsc_wl,
					SUM(CASE WHEN discussion='OH' THEN 1 ELSE 0 END) as dsc_oh,
					SUM(CASE WHEN discussion='RGR' THEN 1 ELSE 0 END) as dsc_rgr,
					SUM(CASE WHEN discussion='RGR-Pre' THEN 1 ELSE 0 END) as dsc_rgr_pre,
					
					SUM(CASE WHEN confirmation='CNF' THEN 1 ELSE 0 END) as adm_cnf,

					/***** Intermediates *****/
					SUM(CASE WHEN intermediates='OFD' THEN 1 ELSE 0 END) as ofd_total

					FROM(select 
					af.id as form_id, af.form_no, af.call_name, af.gender, af.grade_id, af.grade_name,
					if(af.gf_id < 17000, 1, 0) as siblings, if(pet.gf_id is not null, 1, 0) as pet,
					b.name as batch_case, bt.batch_category as batch, date_format(bt.date, '%a %d %M %Y') as batch_date, bt.id as batch_id, bs.sno as batch_slot_no,
					if(bs2.revised_batch_slot_id is not null, 1, 0) as re_allocated,
					af.form_assessment_result, af.form_discussion_result,
					af.form_status_id, af.form_status_stage_id,
					if(af.form_status_id=3, 
						if(af.form_status_stage_id=13, 'CFD',
						if(af.form_status_stage_id=9 or af.form_status_stage_id=17, 'WL',
						if(af.form_status_stage_id=8 or af.form_status_stage_id=16, 'OH',
						if(af.form_status_stage_id=15, 'RGR',
						if(af.form_status_stage_id=6, 'RGR-Pre', ''))))),
					if(af.form_status_id=2 and af.form_status_stage_id=7, 'NI', '')) as assessment,

					if(af.form_status_id=4, 
						if(af.form_status_stage_id=13, 'CFD',
						if(af.form_status_stage_id=9 or af.form_status_stage_id=17, 'WL',
						if(af.form_status_stage_id=8 or af.form_status_stage_id=16, 'OH',
						if(af.form_status_stage_id=15, 'RGR',
						if(af.form_status_stage_id=6, 'RGR-Pre', ''))))),
					if(af.form_status_id=5 and af.form_status_stage_id=12, 'TBO', if(af.form_status_id>=3 and af.form_status_stage_id=7, 'NI', ''))) as discussion,

					if(af.form_status_id = 6, 'CNF', '') as confirmation,
	
					if(af.form_status_id=5, 
						if(af.form_status_stage_id <= 5 or af.form_status_stage_id = 10 or af.form_status_stage_id = 11 or af.form_status_stage_id = 14, 'OFD', ''),
					if(af.form_status_id=4 and af.form_status_stage_id=7, 'NI', '')) as intermediates
						
					from atif_gs_admission.admission_form as af
					left join atif_gs_admission._form_batch as bt
						on bt.id = af.form_batch_id
					left join atif_gs_admission._batch as b
						on b.id = bt.batch_id
					left join atif_gs_admission._form_batch_slots as bs
						on bs.id = af.batch_slot_id
					left join atif_gs_admission._form_batch_slots as bs2
						on bs2.admission_form_id = af.id
						and bs2.revised_batch_slot_id>0
					left join atif_gs_events.1509_petitioners as pet
						on pet.gf_id = af.gf_id
						
					where af.batch_slot_id != 0) as data

					group by batch_id) AS DATA

					where grade_id = $grade
					order by grade_id, batch_id";
		
		$row = $this->db->query($query);
		return $row->result();
	}






















	// Batch - Grade Summary
	public function get_GradeBatchSummary($grade){
		$query = "SELECT
					sum(total_forms) as total_forms, 
					form_no, sum(gender_b) as gender_b, sum(gender_g) as gender_g, 
					grade_id, 'Generation''s School' as grade_name,
					sum(siblings) as siblings, sum(pet) as pet, batch_case, 
					grade_name as batch, batch_date, batch_id, sum(re_allocated) as re_allocated, 
					sum(ass_ap) as ass_ap, sum(ass_a) as ass_a, sum(ass_am) as ass_am, sum(ass_bp) as ass_bp, sum(ass_b) as ass_b, sum(ass_bm) as ass_bm, sum(ass_c) as ass_c,
					sum(ass_d) as ass_d, sum(ass_total) as ass_total, sum(ass_cfd) as ass_cfd, sum(ass_wl) as ass_wl, sum(ass_oh) as ass_oh, sum(ass_rgr) as ass_rgr, sum(ass_rgr_pre) as ass_rgr_pre,
					
					sum(dsc_ap) as dsc_ap, sum(dsc_a) as dsc_a, sum(dsc_am) as dsc_am, sum(dsc_bp) as dsc_bp, sum(dsc_b) as dsc_b, sum(dsc_bm) as dsc_bm, sum(dsc_c) as dsc_c,
					sum(dsc_d) as dsc_d, sum(dsc_total) as dsc_total, sum(dsc_cfd) as dsc_cfd, sum(dsc_tbo) as dsc_tbo, sum(dsc_wl) as dsc_wl, sum(dsc_oh) as dsc_oh, sum(dsc_rgr) as dsc_rgr, sum(dsc_rgr_pre) as dsc_rgr_pre,
					(sum(ass_wl)+sum(dsc_wl)) as inter_wl,
					(sum(ass_oh)+sum(dsc_oh)) as inter_oh,
					sum(ofd_total) as inter_ofd, sum(adm_cnf) as adm_cnf

					FROM
					(select
					count(form_id) as total_forms, form_no, 
					SUM(CASE WHEN gender='B' THEN 1 ELSE 0 END) as gender_b, 
					SUM(CASE WHEN gender='G' THEN 1 ELSE 0 END) as gender_g,
					grade_id, grade_name, sum(siblings) as siblings, sum(pet) as pet, 
					batch_case, batch, batch_date, batch_id, sum(re_allocated) as re_allocated,
					/***** Assessment *****/ 
					SUM(CASE WHEN form_assessment_result='A+' THEN 1 ELSE 0 END) as ass_ap,
					SUM(CASE WHEN form_assessment_result='A' THEN 1 ELSE 0 END) as ass_a,
					SUM(CASE WHEN form_assessment_result='A-' THEN 1 ELSE 0 END) as ass_am,
					SUM(CASE WHEN form_assessment_result='B+' THEN 1 ELSE 0 END) as ass_bp,
					SUM(CASE WHEN form_assessment_result='B' THEN 1 ELSE 0 END) as ass_b,
					SUM(CASE WHEN form_assessment_result='B-' THEN 1 ELSE 0 END) as ass_bm,
					SUM(CASE WHEN form_assessment_result='C' THEN 1 ELSE 0 END) as ass_c,
					SUM(CASE WHEN form_assessment_result='D' THEN 1 ELSE 0 END) as ass_d,

					SUM(CASE WHEN assessment='NI' THEN 1 ELSE 0 END) as ass_total,
					SUM(CASE WHEN assessment='CFD' THEN 1 ELSE 0 END) as ass_cfd,
					SUM(CASE WHEN assessment='WL' THEN 1 ELSE 0 END) as ass_wl,
					SUM(CASE WHEN assessment='OH' THEN 1 ELSE 0 END) as ass_oh,
					SUM(CASE WHEN assessment='RGR' THEN 1 ELSE 0 END) as ass_rgr,
					SUM(CASE WHEN assessment='RGR-Pre' THEN 1 ELSE 0 END) as ass_rgr_pre,

					/***** Discussion *****/
					SUM(CASE WHEN form_discussion_result='A+' THEN 1 ELSE 0 END) as dsc_ap,
					SUM(CASE WHEN form_discussion_result='A' THEN 1 ELSE 0 END) as dsc_a,
					SUM(CASE WHEN form_discussion_result='A-' THEN 1 ELSE 0 END) as dsc_am,
					SUM(CASE WHEN form_discussion_result='B+' THEN 1 ELSE 0 END) as dsc_bp,
					SUM(CASE WHEN form_discussion_result='B' THEN 1 ELSE 0 END) as dsc_b,
					SUM(CASE WHEN form_discussion_result='B-' THEN 1 ELSE 0 END) as dsc_bm,
					SUM(CASE WHEN form_discussion_result='C' THEN 1 ELSE 0 END) as dsc_c,
					SUM(CASE WHEN form_discussion_result='D' THEN 1 ELSE 0 END) as dsc_d,

					SUM(CASE WHEN discussion='NI' THEN 1 ELSE 0 END) as dsc_total,
					SUM(CASE WHEN discussion='CFD' THEN 1 ELSE 0 END) as dsc_cfd,
					SUM(CASE WHEN discussion='TBO' THEN 1 ELSE 0 END) as dsc_tbo,
					SUM(CASE WHEN discussion='WL' THEN 1 ELSE 0 END) as dsc_wl,
					SUM(CASE WHEN discussion='OH' THEN 1 ELSE 0 END) as dsc_oh,
					SUM(CASE WHEN discussion='RGR' THEN 1 ELSE 0 END) as dsc_rgr,
					SUM(CASE WHEN discussion='RGR-Pre' THEN 1 ELSE 0 END) as dsc_rgr_pre,
					
					SUM(CASE WHEN confirmation='CNF' THEN 1 ELSE 0 END) as adm_cnf,

					/***** Intermediates *****/
					SUM(CASE WHEN intermediates='OFD' THEN 1 ELSE 0 END) as ofd_total

					FROM(select 
					af.id as form_id, af.form_no, af.call_name, af.gender, af.grade_id, af.grade_name,
					if(af.gf_id < 17000, 1, 0) as siblings, if(pet.gf_id is not null, 1, 0) as pet,
					b.name as batch_case, bt.batch_category as batch, '' as batch_date, bt.id as batch_id, bs.sno as batch_slot_no,
					if(bs2.revised_batch_slot_id is not null, 1, 0) as re_allocated,
					af.form_assessment_result, af.form_discussion_result,
					af.form_status_id, af.form_status_stage_id,
					if(af.form_status_id=3, 
						if(af.form_status_stage_id=13, 'CFD',
						if(af.form_status_stage_id=9 or af.form_status_stage_id=17, 'WL',
						if(af.form_status_stage_id=8 or af.form_status_stage_id=16, 'OH',
						if(af.form_status_stage_id=15, 'RGR',
						if(af.form_status_stage_id=6, 'RGR-Pre', ''))))),
					if(af.form_status_id=2 and af.form_status_stage_id=7, 'NI', '')) as assessment,

					if(af.form_status_id=4, 
						if(af.form_status_stage_id=13, 'CFD',
						if(af.form_status_stage_id=9 or af.form_status_stage_id=17, 'WL',
						if(af.form_status_stage_id=8 or af.form_status_stage_id=16, 'OH',
						if(af.form_status_stage_id=15, 'RGR',
						if(af.form_status_stage_id=6, 'RGR-Pre', ''))))),
					if(af.form_status_id=5 and af.form_status_stage_id=12, 'TBO', if(af.form_status_id>=3 and af.form_status_stage_id=7, 'NI', ''))) as discussion,

					if(af.form_status_id = 6, 'CNF', '') as confirmation,
	
					if(af.form_status_id=5, 
						if(af.form_status_stage_id <= 5 or af.form_status_stage_id = 10 or af.form_status_stage_id = 11 or af.form_status_stage_id = 14, 'OFD', ''),
					if(af.form_status_id=4 and af.form_status_stage_id=7, 'NI', '')) as intermediates
						
					from atif_gs_admission.admission_form as af
					left join atif_gs_admission._form_batch as bt
						on bt.id = af.form_batch_id
					left join atif_gs_admission._batch as b
						on b.id = bt.batch_id
					left join atif_gs_admission._form_batch_slots as bs
						on bs.id = af.batch_slot_id
					left join atif_gs_admission._form_batch_slots as bs2
						on bs2.admission_form_id = af.id
						and bs2.revised_batch_slot_id>0
					left join atif_gs_events.1509_petitioners as pet
						on pet.gf_id = af.gf_id
						
					where af.batch_slot_id != 0) as data

					group by batch_id) AS DATA
					
					group by grade_id
					order by grade_id, batch_id";
		
		$row = $this->db->query($query);
		return $row->result();
	}
	public function get_dis_presence($form_id){

		$query = "select
		af.id as form_id, LPAD(af.id, 4, '0') AS form_no, af.official_name as applicant_name,

		IF(IFNULL(AST_Presence.date,0)=0,0,1) as flag_dis_presence, 

		b.id as and_id
		

		from atif_gs_admission.admission_form as af
		left join atif_gs_admission._form_batch as bt
			on bt.id = af.form_batch_id
		left join atif_gs_admission._batch as b
			on b.id = bt.batch_id

		/***** Assessment *****/
		left join (select
			admission_form_id, from_unixtime(modified) as date
			from atif_gs_admission.log_form_status
			where new_form_status = 4
			and new_form_stage = 4
			group by admission_form_id) as AST_Presence
				on AST_Presence.admission_form_id = af.id



		where af.form_assessment_date != '0000-00-00'
		and af.form_assessment_date != '2001-01-01'
		and af.id = ".$form_id;
		$row = $this->db->query($query);
		return $row->result();

	}

	public function get_a_level_detail($grade_id){
		$query = "select
				af.form_id, LPAD(af.form_no, 4, '0') AS form_no, af.official_name as applicant_name, af.father_name,

				/***** Assessment *****/
				CONCAT(DATE_FORMAT(af.form_assessment_date, '%a %d %b'), '@ ', TIME_FORMAT(af.batch_time_submission, '%h:%i')) as form_assessment_date,
				IFNULL(DATE_FORMAT(AST_Presence.date, '%a %d %b'),'') AS ast_done_on, af.ast_name_code, 
				IF(IFNULL(AST_Reminder.admission_form_id,0)=0,0,1) as flag_ast_reminder, IF(IFNULL(AST_Presence.date,0)=0,0,1) as flag_ast_presence, 
				IF(IFNULL(AST_Followup.admission_form_id,0)=0,0,1) as flag_ast_followup,
				af.form_assessment_result, af.form_assessment_decision,
				IF(af.form_assessment_result='',0,1) as flag_ast_result,
				IF(af.form_assessment_decision='',0,1) as flag_ast_decision, IF(af.form_assessment_decision='',0,1) as flag_ast_allocation,
				IF(IFNULL(DIS_Communication.admission_form_id,0)=0,0,1) as flag_comm_ast_result,
				/***** Assessment - END *****/



				IF(IFNULL(OFFER.admission_form_id, 'A')='A', 'Approval Pending', DATE_FORMAT(OFFER.date, '%a %d %b')) as OFFER,



				/***** Assessment *****/
				IFNULL(CONCAT(DATE_FORMAT(af.form_discussion_date, '%a %d %b'), '@ ', TIME_FORMAT(af.form_discussion_time, '%h:%i')), '') as form_discussion_date,
				IFNULL(DATE_FORMAT(Dis_Presence.date, '%a %d %b'),'') AS dis_done_on, af.dis_name_code,
				IF(IFNULL(DIS_Reminder.admission_form_id,0)=0,0,1) as flag_dis_reminder, IF(IFNULL(DIS_Presence.date,0)=0,0,1) as flag_dis_presence, 
				IF(IFNULL(DIS_Followup.admission_form_id,0)=0,0,1) as flag_dis_followup,
				af.form_discussion_result, af.form_discussion_decision,
				IF(af.form_discussion_result='',0,1) as flag_dis_result,
				IF(af.form_discussion_decision='',0,1) as flag_dis_decision, IF(af.form_discussion_decision='',0,1) as flag_dis_allocation,
				IF(IFNULL(OFR_Communication.admission_form_id,0)=0,0,1) as flag_comm_dis_result,
				/***** Assessment - END *****/




				DATE_FORMAT(af.offer_date, '%a %d %b') as offer_date,


				/***** Other References Fields *****/
				af.form_batch_id, af.grade_id, af.and_id, af.and_batch,
				
				af.batch_category, af.grade_name,
				/***** Other References Fields - END *****/




				/***** Final Decision *****/
				af.form_status_id, af.form_status_stage_id,
				IF((af.form_status_id>=3 AND af.form_status_id<=6) AND af.form_status_stage_id=15, 'Regret',
					IF((af.form_status_id>=3 AND af.form_status_id<=6) AND af.form_status_stage_id=17, 'Wait List',
					IF((af.form_status_id>=3 AND af.form_status_id<=6) AND af.form_status_stage_id=16, 'On Hold',
					IF(af.form_status_id>=5 AND af.form_status_stage_id<=3, CONCAT('Offer ', IFNULL(DATE_FORMAT(af.offer_date, '%a %d %b'),'')),
					IF((af.form_status_id>=4 OR af.form_status_id<=6) AND (af.form_status_stage_id=12 OR af.form_status_stage_id=6 OR af.form_status_stage_id=8  OR af.form_status_stage_id=9), 'Approval Pending', '-'
				  ))))) as final_decision
				/***** Final Decision - END *****/
				
				


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
					and (new_form_stage = 5 or new_form_stage = 7 or new_form_stage = 10 or new_form_stage = 11)
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
					and (new_form_stage = 5 or new_form_stage = 7 or new_form_stage = 10 or new_form_stage = 11)
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



				where af.grade_id  = ".$grade_id."  and af.form_discussion_date IS NOT NULL and af.form_discussion_date != '0000-00-00'
				and af.form_discussion_date != '2001-01-01'
				order by af.batch_time_submission";
		$row = $this->db->query($query);
		return $row->result();

	}

	public function sp_form_complete_log_a_level($form_id){

		$query = "SELECT * FROM(
			/************************************************* Form Issuance
			*****************************************************************/
			select
			af.id as admission_form_id, FROM_UNIXTIME(af.created) as change_date, DATE_FORMAT(FROM_UNIXTIME(af.created), '%d-%b-%Y %h:%i %p') as dt, '' as reason,
			CONCAT('Admission form issued', ' on ', DATE_FORMAT(FROM_UNIXTIME(af.created), '%d-%b-%Y %h:%i %p')) as message,
			'Issuance' as type, sr.employee_id as photo_id, af.register_by as user_id, sr.abridged_name as staff_name, 1 as this_order
			from atif_gs_admission.admission_form as af
			left join atif.staff_registered as sr
			    on sr.user_id = af.register_by
			where af.id = $form_id /***** Change Form ID *****/
			
			
			
			UNION
			
			
			/************************************** Form Issuance - Comments
			*****************************************************************/
			select
			af.id as admission_form_id, FROM_UNIXTIME(af.created) as change_date, DATE_FORMAT(FROM_UNIXTIME(af.created), '%d-%b-%Y %h:%i %p') as dt,
			IF(af.comments!='', 'Admission Form Comments', '') as reason,
			IF(af.comments != '', af.comments, '') as message,
			'Comments' as type, sr.employee_id as photo_id, af.register_by as user_id, sr.abridged_name as staff_name, 1 as this_order
			from atif_gs_admission.admission_form as af
			left join atif.staff_registered as sr
			    on sr.user_id = af.register_by
			where af.id = $form_id and af.comments!='' /***** Change Form ID *****/



			UNION

			/*************************************************** Form Status - Submission
			*****************************************************************/
			select
			lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p') as dt, '' as reason,
			CONCAT(fst_new.name, ' on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
			'Status' as type, sr.employee_id as photo_id, lgs.modified_by as user_id, sr.abridged_name as staff_name, 2 as this_order

			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission._form_status as fst_old
			    on fst_old.id = lgs.old_form_status
			left join atif_gs_admission._form_status as fst_new
			    on fst_new.id = lgs.new_form_status
			left join atif.staff_registered as sr
			    on sr.user_id = lgs.modified_by
			where lgs.admission_form_id = $form_id /***** Change Form ID *****/    
			and lgs.type = 'S' and lgs.old_form_status=1 and lgs.new_form_status=2
			group by lgs.admission_form_id

			UNION


			/************************************ Communication - Assessment
			*****************************************************************/
			select
			lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p') as dt, '' as reason,
			CONCAT('Communication of Assessment on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
			'Stage' as type, sr.employee_id as photo_id, lgs.modified_by as user_id, sr.abridged_name as staff_name, 3 as this_order

			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission._form_status_stage as fst_old
			    on fst_old.id = lgs.new_form_stage
			left join atif_gs_admission._form_status_stage as fst_new
			    on fst_new.id = lgs.new_form_stage
			left join atif.staff_registered as sr
			    on sr.user_id = lgs.modified_by
			where lgs.admission_form_id = $form_id /***** Change Form ID *****/    
			and lgs.new_form_status = 2 and lgs.new_form_stage = 2
			group by admission_form_id


			UNION


			/***************************************** Presence - Assessment
			*****************************************************************/
			select
			lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p') as dt, '' as reason,
			IF(af.grade_id = 15 OR af.grade_id = 16,CONCAT('Presence of Disscussion on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')),CONCAT('Presence of Assessment on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p'))) as message,
			'Stage' as type, sr.employee_id as photo_id, lgs.modified_by as user_id, sr.abridged_name as staff_name, 3 as this_order

			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission._form_status_stage as fst_old
			    on fst_old.id = lgs.new_form_stage
			left join atif_gs_admission._form_status_stage as fst_new
			    on fst_new.id = lgs.new_form_stage
			left join atif.staff_registered as sr
			    on sr.user_id = lgs.modified_by
			left join atif_gs_admission.admission_form as af 
			on af.id = lgs.admission_form_id
			where lgs.admission_form_id = $form_id /***** Change Form ID *****/    
			and lgs.new_form_status = 3 and lgs.new_form_stage = 4
			group by admission_form_id


			UNION



			/*********************************** Form Status Stage - Beyond 5
			*****************************************************************/
			/*
			select
			lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, '' as reason,
			CONCAT(fst_new.name, ' on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
			'Stage' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 5 as this_order

			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission._form_status_stage as fst_old
			    on fst_old.id = lgs.new_form_stage
			left join atif_gs_admission._form_status_stage as fst_new
			    on fst_new.id = lgs.new_form_stage
			left join atif.staff_registered as sr
			    on sr.user_id = lgs.modified_by
			where lgs.admission_form_id = $form_id/***** Change Form ID *****/    
			/*and lgs.type = 'G' and lgs.new_form_status >= 5


			UNION*/



			/************************************************* Form Comments
			*****************************************************************/
			select
			com.admission_form_id, FROM_UNIXTIME(com.created) as change_date, DATE_FORMAT(FROM_UNIXTIME(com.created), '%d-%b-%Y %h:%i %p') as dt,
			IF(com.reason = '', '', com.reason) as reason,
			com.comments as message, 'Comments' as type,
			if(sr.employee_id='298', 'gs_logo', sr.employee_id) as photo_id, com.register_by as user_id, sr.abridged_name as staff_name, 4 as this_order

			from atif_gs_admission.log_form_comments as com
			left join atif.staff_registered as sr
			    on sr.user_id = com.register_by
			        
			where com.admission_form_id = $form_id /***** Change Form ID *****/        
			) AS DATA

			order by admission_form_id, change_date, this_order";

		$row = $this->db->query($query);
		return $row->result();

	}

	public function get_batch_grade(){
		$query = "select * from atif._grade  where id <=14 or id = 17";
		$row = $this->db->query($query);
		return $row->result();
	}
}