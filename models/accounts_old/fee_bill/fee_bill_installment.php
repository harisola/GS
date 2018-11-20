<?php
class Fee_bill_installment extends CI_Model{

	private $db_atif_fee;

	function __construct()
	{
		parent::__construct();
		$this->db_atif_fee = $this->load->database('fee_bill_student_db',TRUE);
	}


	protected $_table_name = 'fee_bill';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'created desc';	
	protected $_timestamps = TRUE;
	


	public function getStudentInfo($GSID){
		$query = "select
			cl.gs_id, CONCAT(cl.grade_name, '-', cl.section_name) as class,
			if(cl.gender = 'B', CONCAT('S/O ', father.name),  CONCAT('D/O ', father.name)) as father_name, father.nic as father_nic,
			cl.abridged_name, installment.installment_no
			from atif.class_list as cl
			left join atif.student_family_record as father
				on father.gf_id = cl.gf_id
				and father.parent_type = 1
			left join atif.student_family_record as mother
				on mother.gf_id = cl.gf_id
				and mother.parent_type = 1
			JOIN (select
				max(bill_cycle_no) as installment_no
				from atif_fee_student.fee_bill as fb
				where fb.academic_session_id in 
						(select
						group_concat(id)
						from atif._academic_session
						where is_active = 1
						and is_lock = 0)) as installment
			where cl.gs_id = '" . $GSID . "'";
		$sql = $this->db_atif_fee->query($query);		
		return $sql->result();
	}



	public function GetStaffInfo($GSID){
		$query = "select
			cl.gs_id, sr.gt_id, sr.status_code
			from atif.class_list as cl
			left join atif.staff_child as sc
				on sc.gf_id = cl.gf_id
			left join atif.staff_registered as sr
				on sr.id = sc.staff_id
			where cl.gs_id = '" . $GSID . "'";
		$sql = $this->db_atif_fee->query($query);		
		return $sql->result();
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