<?php
class Fee_bill_arrears_advance_model extends CI_Model{

	private $db_atif_fee;

	function __construct()
	{
		parent::__construct();
		$this->db_atif_fee = $this->load->database('fee_bill_db', TRUE);
	}


	protected $_table_name = 'fee_bill';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'created desc';	
	protected $_timestamps = TRUE;


	public function getAllFeeCycles($AcademicSessionFrom, $AcademicSessionTo){		
		$query=$this->db->query("select 
			fee_bill_type_id, bill_cycle_id 

			from 
			atif_fee.fee_bill 

			where academic_session_id>=" . $AcademicSessionFrom . " and academic_session_id <= " . $AcademicSessionTo . " 

			group by fee_bill_type_id, bill_cycle_id 

			order by fee_bill_type_id, bill_cycle_id");

		$rows_array = $query->result_array();		
				
        return $rows_array;
	}


	public function getStudentsArrearsAdvanceAmount($AcademicSessionFrom, $AcademicSessionTo){
		$query=$this->db->query("select cl.gs_id, CONCAT(LEFT(LPAD(cl.gf_id,5,0), 2), '-', RIGHT(LPAD(cl.gf_id,5,0), 3)) as gf_id, cl.abridged_name, cl.student_status_name,
					cl.grade_name, cl.section_name, cl.grade_id, cl.section_id,
					IFNULL(pet.petitioner_type, '') AS petitioner_type,
					IFNULL(pet.petitioner_title, '') AS petitioner_title,
					IFNULL(pet.petitioner_code, '') AS petitioner_code,
					IFNULL(pet.petitioner_no, '') AS petitioner_no,
					IFNULL(feebill_1.adjustment,0) as feebill_1_adjustment,IFNULL(feebill_1.bill_title, '') as feebill_1_title, IFNULL(feebill_1.total_payable,0) as feebill_1_payable, IFNULL(feebill_1.received_amount,0) as feebill_1_received,
					IFNULL(feebill_2.adjustment,0) as feebill_2_adjustment,IFNULL(feebill_2.bill_title, '') as feebill_2_title, IFNULL(feebill_2.total_payable,0) as feebill_2_payable, IFNULL(feebill_2.received_amount,0) as feebill_2_received,
					IFNULL(feebill_3.adjustment,0) as feebill_3_adjustment,IFNULL(feebill_3.bill_title, '') as feebill_3_title, IFNULL(feebill_3.total_payable,0) as feebill_3_payable, IFNULL(feebill_3.received_amount,0) as feebill_3_received,
					IFNULL(feebill_4.adjustment,0) as feebill_4_adjustment,IFNULL(feebill_4.bill_title, '') as feebill_4_title, IFNULL(feebill_4.total_payable,0) as feebill_4_payable, IFNULL(feebill_4.received_amount,0) as feebill_4_received,
					IFNULL(feebill_5.adjustment,0) as feebill_5_adjustment,IFNULL(feebill_5.bill_title, '') as feebill_5_title, IFNULL(feebill_5.total_payable,0) as feebill_5_payable, IFNULL(feebill_5.received_amount,0) as feebill_5_received,
					IFNULL(feebill_6.adjustment,0) as feebill_6_adjustment,IFNULL(feebill_6.bill_title, '') as feebill_6_title, IFNULL(feebill_6.total_payable,0) as feebill_6_payable, IFNULL(feebill_6.received_amount,0) as feebill_6_received,


					IF(feebill_6.bill_title!='', IFNULL(feebill_6.bill_title,''),
						IF(feebill_5.bill_title!='', IFNULL(feebill_5.bill_title,''),
							IF(feebill_4.bill_title!='', IFNULL(feebill_4.bill_title,''),
								IF(feebill_3.bill_title!='', IFNULL(feebill_3.bill_title,''),
									IF(feebill_2.bill_title!='', IFNULL(feebill_2.bill_title,''),
										IF(feebill_1.bill_title!='', IFNULL(feebill_1.bill_title,''), '')))))) as last_bill_title,


					IF(feebill_6.bill_title!='', IFNULL(feebill_6.total_payable,0)-IFNULL(feebill_6.received_amount,0),
						IF(feebill_5.bill_title!='', IFNULL(feebill_5.total_payable,0)-IFNULL(feebill_5.received_amount,0),
							IF(feebill_4.bill_title!='', IFNULL(feebill_4.total_payable,0)-IFNULL(feebill_4.received_amount,0),
								IF(feebill_3.bill_title!='', IFNULL(feebill_3.total_payable,0)-IFNULL(feebill_3.received_amount,0),
									IF(feebill_2.bill_title!='', IFNULL(feebill_2.total_payable,0)-IFNULL(feebill_2.received_amount,0),
										IF(feebill_1.bill_title!='', IFNULL(feebill_1.total_payable,0)-IFNULL(feebill_1.received_amount,0), IFNULL(feebill_1.adjustment,0))))))) as balance
						
					from atif.class_list cl


					left join
					(select title as petitioner_title, gf_id, petitioner_code, petitioner_no, type as petitioner_type
						from atif_gs_events.1509_petitioners group by gf_id, title) as pet on pet.gf_id = cl.gf_id

					left join
					(SELECT * FROM
						(SELECT student_id, adjustment, total_payable, received_amount, bill_title,
								IF(@prev=student_id, @cnt := @cnt + 1, @cnt := 1) AS bill_paid,
								@prev:=student_id as this_student_id

						FROM(
							SELECT fb.student_id as student_id, IFNULL(fb.adjustment,0) as adjustment, 
								fb.total_payable, fbr.received_amount, fb.bill_title

								FROM atif_fee_student.fee_bill fb

								left join (select 
									fee_bill_id, received_date, sum(received_amount) as received_amount,
									received_late_fee, received_payment_mode, received_branch,
									is_void	
									from atif_fee_student.fee_bill_received 	
									where is_void=0 and record_deleted=0	
									group by fee_bill_id) as fbr on fbr.fee_bill_id = fb.id

								where fb.academic_session_id>=$AcademicSessionFrom and fb.academic_session_id<=$AcademicSessionTo
								and fb.is_void=0 and fb.record_deleted=0
								and bill_cycle_no=1 and fee_bill_type_id=1

								order by student_id asc, received_amount desc
						) AS DATA
						JOIN (SELECT @prev := null) p
						JOIN (SELECT @cnt := 1) c
						
						order by student_id, received_amount desc) AS DATA
						where bill_paid = 1) as feebill_1 on feebill_1.student_id = cl.id



					left join
					(SELECT * FROM
						(SELECT student_id, adjustment, total_payable, received_amount, bill_title,
								IF(@prev=student_id, @cnt := @cnt + 1, @cnt := 1) AS bill_paid,
								@prev:=student_id as this_student_id

						FROM(
							SELECT fb.student_id as student_id, IFNULL(fb.adjustment,0) as adjustment, 
								fb.total_payable, fbr.received_amount, fb.bill_title

								FROM atif_fee_student.fee_bill fb

								left join (select 
									fee_bill_id, received_date, sum(received_amount) as received_amount,
									received_late_fee, received_payment_mode, received_branch,
									is_void	
									from atif_fee_student.fee_bill_received 	
									where is_void=0 and record_deleted=0	
									group by fee_bill_id) as fbr on fbr.fee_bill_id = fb.id

								where fb.academic_session_id>=$AcademicSessionFrom and fb.academic_session_id<=$AcademicSessionTo
								and fb.is_void=0 and fb.record_deleted=0
								and bill_cycle_no=2 and fee_bill_type_id=1

								order by student_id asc, received_amount desc
						) AS DATA
						JOIN (SELECT @prev := null) p
						JOIN (SELECT @cnt := 1) c
						
						order by student_id, received_amount desc) AS DATA
						where bill_paid = 1) as feebill_2 on feebill_2.student_id = cl.id







					left join
					(SELECT * FROM
						(SELECT student_id, adjustment, total_payable, received_amount, bill_title,
								IF(@prev=student_id, @cnt := @cnt + 1, @cnt := 1) AS bill_paid,
								@prev:=student_id as this_student_id

						FROM(
							SELECT fb.student_id as student_id, IFNULL(fb.adjustment,0) as adjustment, 
								fb.total_payable, fbr.received_amount, fb.bill_title

								FROM atif_fee_student.fee_bill fb

								left join (select 
									fee_bill_id, received_date, sum(received_amount) as received_amount,
									received_late_fee, received_payment_mode, received_branch,
									is_void	
									from atif_fee_student.fee_bill_received 	
									where is_void=0 and record_deleted=0	
									group by fee_bill_id) as fbr on fbr.fee_bill_id = fb.id

								where fb.academic_session_id>=$AcademicSessionFrom and fb.academic_session_id<=$AcademicSessionTo
								and fb.is_void=0 and fb.record_deleted=0
								and bill_cycle_no=3 and fee_bill_type_id=1

								order by student_id asc, received_amount desc
						) AS DATA
						JOIN (SELECT @prev := null) p
						JOIN (SELECT @cnt := 1) c
						
						order by student_id, received_amount desc) AS DATA
						where bill_paid = 1) as feebill_3 on feebill_3.student_id = cl.id











					left join
					(SELECT * FROM
						(SELECT student_id, adjustment, total_payable, received_amount, bill_title,
								IF(@prev=student_id, @cnt := @cnt + 1, @cnt := 1) AS bill_paid,
								@prev:=student_id as this_student_id

						FROM(
							SELECT fb.student_id as student_id, IFNULL(fb.adjustment,0) as adjustment, 
								fb.total_payable, fbr.received_amount, fb.bill_title

								FROM atif_fee_student.fee_bill fb

								left join (select 
									fee_bill_id, received_date, sum(received_amount) as received_amount,
									received_late_fee, received_payment_mode, received_branch,
									is_void	
									from atif_fee_student.fee_bill_received 	
									where is_void=0 and record_deleted=0	
									group by fee_bill_id) as fbr on fbr.fee_bill_id = fb.id

								where fb.academic_session_id>=$AcademicSessionFrom and fb.academic_session_id<=$AcademicSessionTo
								and fb.is_void=0 and fb.record_deleted=0
								and bill_cycle_no=4 and fee_bill_type_id=1

								order by student_id asc, received_amount desc
						) AS DATA
						JOIN (SELECT @prev := null) p
						JOIN (SELECT @cnt := 1) c
						
						order by student_id, received_amount desc) AS DATA
						where bill_paid = 1) as feebill_4 on feebill_4.student_id = cl.id











					left join
					(SELECT * FROM
						(SELECT student_id, adjustment, total_payable, received_amount, bill_title,
								IF(@prev=student_id, @cnt := @cnt + 1, @cnt := 1) AS bill_paid,
								@prev:=student_id as this_student_id

						FROM(
							SELECT fb.student_id as student_id, IFNULL(fb.adjustment,0) as adjustment, 
								fb.total_payable, fbr.received_amount, fb.bill_title

								FROM atif_fee_student.fee_bill fb

								left join (select 
									fee_bill_id, received_date, sum(received_amount) as received_amount,
									received_late_fee, received_payment_mode, received_branch,
									is_void	
									from atif_fee_student.fee_bill_received 	
									where is_void=0 and record_deleted=0	
									group by fee_bill_id) as fbr on fbr.fee_bill_id = fb.id

								where fb.academic_session_id>=$AcademicSessionFrom and fb.academic_session_id<=$AcademicSessionTo
								and fb.is_void=0 and fb.record_deleted=0
								and bill_cycle_no=5 and fee_bill_type_id=1

								order by student_id asc, received_amount desc
						) AS DATA
						JOIN (SELECT @prev := null) p
						JOIN (SELECT @cnt := 1) c
						
						order by student_id, received_amount desc) AS DATA
						where bill_paid = 1) as feebill_5 on feebill_5.student_id = cl.id 









					left join
					(SELECT * FROM
						(SELECT student_id, adjustment, total_payable, received_amount, bill_title,
								IF(@prev=student_id, @cnt := @cnt + 1, @cnt := 1) AS bill_paid,
								@prev:=student_id as this_student_id

						FROM(
							SELECT fb.student_id as student_id, IFNULL(fb.adjustment,0) as adjustment, 
								fb.total_payable, fbr.received_amount, fb.bill_title

								FROM atif_fee_student.fee_bill fb

								left join (select 
									fee_bill_id, received_date, sum(received_amount) as received_amount,
									received_late_fee, received_payment_mode, received_branch,
									is_void	
									from atif_fee_student.fee_bill_received 	
									where is_void=0 and record_deleted=0	
									group by fee_bill_id) as fbr on fbr.fee_bill_id = fb.id

								where fb.academic_session_id>=$AcademicSessionFrom and fb.academic_session_id<=$AcademicSessionTo
								and fb.is_void=0 and fb.record_deleted=0
								and bill_cycle_no=6 and fee_bill_type_id=1

								order by student_id asc, received_amount desc
						) AS DATA
						JOIN (SELECT @prev := null) p
						JOIN (SELECT @cnt := 1) c
						
						order by student_id, received_amount desc) AS DATA
						where bill_paid = 1) as feebill_6 on feebill_6.student_id = cl.id
				");	

		
		$rows_array = $query->result_array();		
				
        return $rows_array;
	}




	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_atif_fee->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_atif_fee->where('record_deleted', 0);
		if(!count($this->db_atif_fee->ar_orderby)){
			$this->db_atif_fee->order_by($this->_order_by);
		}
		return $this->db_atif_fee->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_atif_fee->where($where);
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
			$this->db_atif_fee->set($data);
			$this->db_atif_fee->insert($this->_table_name);
			$id = $this->db_atif_fee->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_atif_fee->set($data);
			$this->db_atif_fee->where($this->_primary_key, $id);
			$this->db_atif_fee->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_atif_fee->where($this->_primary_key, $id);
		$this->db_atif_fee->limit(1);
		$this->db_atif_fee->delete($this->_table_name);
	}
}