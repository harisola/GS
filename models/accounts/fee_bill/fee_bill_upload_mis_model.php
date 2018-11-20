<?php
class Fee_bill_upload_mis_model extends CI_Model{

	private $db_fee_bill;

	function __construct()
	{
		parent::__construct();
		$this->db_fee_bill = $this->load->database('fee_bill_student_db',TRUE);
	}

	protected $_table_name = 'fee_bill_received';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'id desc';	
	protected $_timestamps = TRUE;	


	public function checkMonth($str){
		$months = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
		$result = false;
		if (in_array(strtoupper($str), $months)) {
			$result = true;
		}
		return $result;
	}


	public function getStudentInformation($gsid){
		$cQuery = "select abridged_name, grade_name, section_name,
			concat(grade_name, '-', section_name) as class
			from atif.class_list where gs_id = '$gsid'";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}




	public function getComplete_FamilyFeeInfo($gsid){
		$GFID = "";

		$thisQuery = "select gf_id
					from atif.class_list
					where gs_id = '$gsid'";
		$query=$this->db_fee_bill->query($thisQuery);
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$GFID = $row['gf_id'];		
		}		
		
		$this->db_AssReport = $this->load->database('atif_sp',TRUE);
		$query = "CALL atif_fee_student.FamilyView_GFID_1617($GFID)";
   		$query=$this->db_AssReport->query($query); 
   		$row = $query->result_array();	
   		$this->db_fee_bill = $this->load->database('fee_bill_student_db',TRUE);
    				
   		return $row;
	}




	




	public function checkGSID($gsid){
		$gsid = str_replace("-", "", $gsid);
		$result = false;
		$query=$this->db_fee_bill->query("select id from fee_bill where gb_id like '%" . $gsid . "%' and is_void=0 and record_deleted=0");
		if($query->num_rows() > 0){
			$result = true;		
		}
		return $result;
	}


	
	public function checkBillID($gbid){
		$result = false;
		$query=$this->db_fee_bill->query("select id from fee_bill where gb_id = '" . $gbid . "' and is_void=0 and record_deleted=0");
		if($query->num_rows() > 0){
			$result = true;		
		}
		return $result;
	}


	public function matchBillNo_GSID($gbid, $gsid){
		$result = false;
		//$gbid = $this->convertBankGBIDtoGBID($gbid);

		$thisQuery = "select cl.gs_id
						from atif_fee_student.fee_bill fb
						left join atif.class_list cl on cl.id = fb.student_id 
						where fb.gb_id = '" . $gbid . "' 
						and fb.is_void=0 and fb.record_deleted=0";
		
		$query=$this->db_fee_bill->query($thisQuery);
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$DB_GSID = $row['gs_id'];

			if($DB_GSID == $gsid){
				$result = true;
			}			
		}		

		return $result;
	}


	public function getLastBillNumber($gsid, $GBID){
		//$gsid = str_replace("-", "", $gsid);
		$result = "";
		//$gbid = $this->convertBankGBIDtoGBID($gbid);

		$thisQuery = "select fb.gb_id 
					from atif_fee_student.fee_bill fb 

					left join atif.class_list as cl on cl.id=fb.student_id

					where cl.gs_id = '$gsid' and fb.gb_id = '$GBID'
					and fb.is_void=0 and fb.record_deleted=0 order by fb.id desc limit 1";
		$query=$this->db_fee_bill->query($thisQuery);
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$DB_GBID = $row['gb_id'];

			
			$result = $DB_GBID;			
		}		

		return $result;
	}



	public function getLastBillNumber_Admission($gsid, $GBID){
		//$gsid = str_replace("-", "", $gsid);
		$result = "";
		//$gbid = $this->convertBankGBIDtoGBID($gbid);

		$thisQuery = "select fb.gb_id 
					from atif_fee_student.fee_bill fb 

					left join atif.class_list as cl on cl.id=fb.student_id

					where fb.gb_id = '$GBID'
					and fb.is_void=0 and fb.record_deleted=0 order by fb.id desc limit 1";

		$query=$this->db_fee_bill->query($thisQuery);
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$DB_GBID = $row['gb_id'];

			
			$result = $DB_GBID;			
		}		

		return $result;
	}


















	public function getCorrectFeeAmount($gbid){
		$result = "Not Found!";
		//$gbid = $this->convertBankGBIDtoGBID($gbid);

		$thisQuery = "select total_payable 
						from atif_fee_student.fee_bill 
						where gb_id = '" . $gbid . "' 
						and is_void=0 and record_deleted=0";


		$query=$this->db_fee_bill->query($thisQuery);
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$DB_received_amount = $row['total_payable'];

			$result = $DB_received_amount;			
		}

		return $result;
	}






	

	public function matchBillAmount($gbid, $receivedAmount){
		$result = false;
		//$gbid = $this->convertBankGBIDtoGBID($gbid);

		$thisQuery = "select id from fee_bill where gb_id = '" . $gbid . "' and total_payable = " . $receivedAmount . " and is_void=0 and record_deleted=0";
		$query=$this->db_fee_bill->query($thisQuery);
		if($query->num_rows() > 0){
			$result = true;		
		}
		return $result;
	}



	public function convertBankGBIDtoGBID($gbid){
		$result = '';		
		$result = substr($gbid,0,4) . ' / ' . substr($gbid,5,6) . ' / ' . substr($gbid,12,2);		
		return $result;
	}



	public function getOCSmartCardIds($gbid){
		$result = "";		

		$thisQuery = "select oc_smartcard_ids 
						from fee_bill 
						where gb_id = '" . $gbid . "' 
						and is_void=0 and record_deleted=0 limit 1";
		$query=$this->db_fee_bill->query($thisQuery);
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$DB_SCIds = $row['oc_smartcard_ids'];

			
			$result = $DB_SCIds;			
		}		

		return $result;
	}




	public function getFeeBillID($gbid){
		$result = "";		

		$thisQuery = "select id 
						from fee_bill 
						where gb_id = '" . $gbid . "' 
						and is_void=0 and record_deleted=0 limit 1";
		$query=$this->db_fee_bill->query($thisQuery);
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$DB_ID = $row['id'];

			
			$result = $DB_ID;			
		}		

		return $result;
	}

	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_fee_bill->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_fee_bill->where('record_deleted', 0);
		if(!count($this->db_fee_bill->ar_orderby)){
			$this->db_fee_bill->order_by($this->_order_by);
		}
		return $this->db_fee_bill->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_fee_bill->where($where);
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
			$this->db_fee_bill->set($data);
			$this->db_fee_bill->insert($this->_table_name);
			$id = $this->db_fee_bill->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_fee_bill->set($data);
			$this->db_fee_bill->where($this->_primary_key, $id);
			$this->db_fee_bill->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_fee_bill->where($this->_primary_key, $id);
		$this->db_fee_bill->limit(1);
		$this->db_fee_bill->delete($this->_table_name);
	}





	public $validation_payorder_receiving = array(
		array('field' => 'fee_bill_no', 'label' => 'Fee Bill No', 'rules' => 'trim|sanitize|required|xss_clean'),
		array('field' => 'payorder_date', 'label' => 'Payorder Date', 'rules' => 'trim|sanitize|required|xss_clean'),
		array('field' => 'payorder_number', 'label' => 'Payorder Number', 'rules' => 'trim|sanitize|min_length[5]|max_length[20]|xss_clean|required'),
		array('field' => 'payorder_description', 'label' => 'Payorder Description', 'rules' => 'trim|sanitize|min_length[3]|max_length[255]|xss_clean|required'),
		array('field' => 'payorder_amount', 'label' => 'Payorder Amount', 'rules' => 'trim|sanitize|is_natural_no_zero|xss_clean|required'),
		array('field' => 'is_late_fee', 'label' => 'Late Fee', 'rules' => 'trim|sanitize|is_natural|required'),
		array('field' => 'is_po_charges', 'label' => 'Deduct Pay Order charges?', 'rules' => 'trim|sanitize|is_natural|required')
	);





	public function getAllFeeBillDetail($GSID, $ASFrom, $ASTo)
	{		
		$GSID_num = str_replace("-", "", $GSID);
		$cquery1 = "select
			id, fee_bill_type_id, gb_id, academic_session_id, bill_cycle_id,
			bill_title, bill_issue_date, bill_due_date, bill_bank_valid_date,
			bill_months, student_id, fee_a, fee_d_l1, fee_d_l2, fee_b, adv_tax,
			adjustment, gross_tuition_fee, additional_charges, total_current_bill,
			oc_smartcard_charges, oc_smartcard_ids, oc_magazine, oc_surcharge, oc_adv_tax,
			oc_late_fee, total_payable, received_date, received_amount, received_late_fee,
			received_payment_mode, received_branch, is_void, created, register_by,
			modified, modified_by, record_deleted

			from
			(select 
			fb.id, fb.fee_bill_type_id, fb.gb_id, fb.academic_session_id, fb.bill_cycle_id,
			fb.bill_title, fb.bill_issue_date, fb.bill_due_date, fb.bill_bank_valid_date,
			fb.bill_months, fb.student_id, fb.fee_a, fb.fee_d_l1, fb.fee_d_l2, fb.fee_b, fb.adv_tax,
			fb.adjustment, fb.gross_tuition_fee, fb.additional_charges, fb.total_current_bill,
			fb.oc_smartcard_charges, fb.oc_smartcard_ids, fb.oc_magazine, fb.oc_surcharge, fb.oc_adv_tax,
			fb.oc_late_fee, fb.total_payable, fb.received_date, fb.received_amount, fb.received_late_fee,
			fb.received_payment_mode, fb.received_branch, fb.is_void, fb.created, fb.register_by,
			fb.modified, fb.modified_by, fb.record_deleted


			from atif_fee.fee_bill fb
			

			where gb_id like '%" . $GSID . "%' and is_void=0 and record_deleted=0 


			union


			select 
			fb.id, fb.fee_bill_type_id, fb.gb_id, fb.academic_session_id, fb.bill_cycle_no as bill_cycle_id,
			fb.bill_title, fb.bill_issue_date, fb.bill_due_date, fb.bill_bank_valid_date,
			fb.bill_months, fb.student_id, fb.fee_a, fb.fee_d_l1, fb.fee_d_l2, fb.fee_b, '' as adv_tax,
			(fb.adjustment - fb.waive_amount) as adjustment, fb.gross_tuition_fee, fb.additional_charges, fb.total_current_bill,
			fb.oc_smartcard_charges, fb.oc_smartcard_ids, fb.oc_magazine, fb.oc_surcharge, fb.oc_adv_tax,
			fb.oc_late_fee, fb.total_payable, fbr.received_date, fbr.received_amount, fbr.received_late_fee,
			fbr.received_payment_mode, fbr.received_branch, fb.is_void, fb.created, fb.register_by,
			fb.modified, fb.modified_by, fb.record_deleted


			from atif_fee_student.fee_bill fb
			left join (select 
				fee_bill_id, received_date, sum(received_amount) as received_amount,
				received_late_fee, received_payment_mode, received_branch,
				is_void	
				from atif_fee_student.fee_bill_received 	
				where is_void=0 and record_deleted=0	
				group by fee_bill_id) as fbr on fbr.fee_bill_id = fb.id
			left join atif.student_registered as cl on cl.id = fb.student_id

			where cl.gs_id = '" . $GSID . "' and fb.is_void=0 and fb.record_deleted=0) as StudentFeeBills


			order by academic_session_id, id";



			$cquery="select
		id, fee_bill_type_id, gb_id, academic_session_id, bill_cycle_id,
		bill_title, bill_issue_date, bill_due_date, bill_bank_valid_date,
		bill_months, student_id, fee_a, fee_d_l1, fee_d_l2, fee_b, adv_tax,
		adjustment, gross_tuition_fee, additional_charges, total_current_bill,
		oc_smartcard_charges, oc_smartcard_ids, oc_magazine, oc_surcharge, oc_adv_tax,
		oc_late_fee, total_payable, received_date, received_amount, received_late_fee,
		received_payment_mode, received_branch, is_void, created, register_by,
		modified, modified_by, record_deleted,
		
		 
		tuition_fee, resource_fee, musakhar,  yearly, sc_discount, Installment_1, percentage,Com_Gb_id, concession, scholarship_codes


		from
		(select 
			0 as Com_Gb_id,
		fb.id, fb.fee_bill_type_id, fb.gb_id, fb.academic_session_id, fb.bill_cycle_id,
		fb.bill_title, fb.bill_issue_date, fb.bill_due_date, fb.bill_bank_valid_date,
		fb.bill_months, fb.student_id, fb.fee_a, fb.fee_d_l1, fb.fee_d_l2, fb.fee_b, fb.adv_tax,
		fb.adjustment, fb.gross_tuition_fee, fb.additional_charges, fb.total_current_bill,
		fb.oc_smartcard_charges, fb.oc_smartcard_ids, fb.oc_magazine, fb.oc_surcharge, fb.oc_adv_tax,
		fb.oc_late_fee, fb.total_payable, fb.received_date, fb.received_amount, fb.received_late_fee,
		fb.received_payment_mode, fb.received_branch, fb.is_void, fb.created, fb.register_by,
		fb.modified, fb.modified_by, fb.record_deleted, 
		 0 as tuition_fee, 0 as resource_fee, 0 as musakhar, 0 as yearly,
		 0 as sc_discount,
		 0 as Installment_1, 0 as percentage,
		 fb.fee_d_l1 as concession,
		 fb.fee_d_l2 as scholarship_codes

		from atif_fee.fee_bill fb
		

		where gb_id like '%" . $GSID . "%' and is_void=0 and record_deleted=0 
		and fb.academic_session_id >=5 and fb.academic_session_id <= 12


		union


		select 

		/*if( (ar.grade_id > 14 and ar.grade_id != 17), 
		CONCAT(LEFT(fb.gb_id, 2) , '-', SUBSTRING(fb.gb_id, 3, 2), '-', SUBSTRING(fb.gb_id, 5, 5), '-', RIGHT(fb.gb_id, 2)),
		CONCAT(LEFT(fb.gb_id, 2) , '-', SUBSTRING(fb.gb_id, 3, 2), '-', SUBSTRING(fb.gb_id, 5, 5), '-', RIGHT(fb.gb_id, 1))
		
		) as Com_Gb_id,*/
		fb.gb_id as Com_Gb_id,

		fb.id, fb.fee_bill_type_id, fb.gb_id, fb.academic_session_id, fb.bill_cycle_no as bill_cycle_id,
		fb.bill_title, fb.bill_issue_date, fb.bill_due_date, fb.bill_bank_valid_date,
		fb.bill_months, fb.student_id, fb.fee_a, fb.fee_d_l1, fb.fee_d_l2, fb.fee_b, '' as adv_tax,
		(fb.adjustment - fb.waive_amount) as adjustment, fb.gross_tuition_fee, fb.additional_charges, fb.total_current_bill,
		fb.oc_smartcard_charges, fb.oc_smartcard_ids, fb.oc_magazine, fb.oc_surcharge, fb.oc_adv_tax,
		fb.oc_late_fee, fb.total_payable, fbr.received_date, fbr.received_amount, fbr.received_late_fee,
		fbr.received_payment_mode, fbr.received_branch, fb.is_void, fb.created, fb.register_by,
		fb.modified, fb.modified_by, fb.record_deleted, 
		
			
			((d.tuition_fee)*(2.4)) tuition_fee, 
		
		
		
			if( ar.grade_id <= 14 or  ar.grade_id=17,
			FORMAT( ( ifnull(d.resource_fee,0)*(2.4)), 0), 
			FORMAT( ( ifnull(d.lab_avc,0)*(2.4)), 0) )  as resource_fee,
		
			FORMAT( ( (d.musakhar)*(2.4)), 0) as musakhar,
		
		
		if( fb.bill_cycle_no = 1,0, FORMAT(d.yearly,0) ) as yearly, 
		if( c.concession_code_id is not null and c.concession_code_id=9,FORMAT(1000,0),0) as sc_discount,
		c.Installment_1, 
		
		if(s.percentage is null, cld.percentage, s.percentage ) as percentage,
		
	if( fb.concession_code is null, fb.fee_d_l1, concat(fb.concession_code,'',fb.concession_percentage ) )as concession,
	if( fb.scholarship_codes is null, fb.fee_d_l2, fb.scholarship_codes ) as scholarship_codes


			from atif_fee_student.fee_bill fb
		left join (select 
			fee_bill_id, received_date, sum(received_amount) as received_amount,
			received_late_fee, received_payment_mode, received_branch,
			is_void	
			from atif_fee_student.fee_bill_received 	
			where is_void=0 and record_deleted=0	
			group by fee_bill_id) as fbr on fbr.fee_bill_id = fb.id
			
		
				
				
			left join atif.student_registered as cl on cl.id = fb.student_id

			left join atif.student_academic_record as ar on (ar.student_id= cl.id and ar.academic_session_id=fb.academic_session_id)
			
			
			left join atif_fee_student.fee_definition as d on (d.academic_session_id= fb.academic_session_id and d.grade_id=ar.grade_id)	

			left join atif_fee_student.concessions_for_session as c
			on (c.student_id= fb.student_id and fb.academic_session_id=c.academic_session_id)
			
			left join atif_fee_student.scholarship_for_session as s
			on (s.student_id= fb.student_id and s.academic_session_id=fb.academic_session_id)	
			
			
			left join atif_fee_Student.fee_bill_month as fbm
		on (fbm.bill_cycle_no = fb.bill_cycle_no and fbm.academic_session_id=fb.academic_session_id)
		
		left join atif_fee_student.concession_level_definition as cld
		on ( cld.student_id = fb.student_id and cld.academic_session_id=fb.academic_session_id)

			where cl.gs_id = '" . $GSID . "' and fb.is_void=0 and fb.record_deleted=0
				and fb.academic_session_id >= 5 and fb.academic_session_id <= 12
			 ) as StudentFeeBills

		group by id
			order by academic_session_id, id
";
		
					
		//print_r($cquery);
		$query=$this->db_fee_bill->query($cquery);
		$rows_array = $query->result_array();		
        return $rows_array;        
	}



	public function matchBillID_GBID($BillID, $GBID){
		$result = 0;
		//$gbid = $this->convertBankGBIDtoGBID($gbid);

		$thisQuery = "select bill_cycle_id from fee_bill where gb_id = '" . $GBID . "' and id = " . $BillID . " and is_void=0 and record_deleted=0";
		$query=$this->db_fee_bill->query($thisQuery);
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$result = $row['bill_cycle_id'];		
		}
		return $result;
	}







	public function getThisFeeBillInfo($GBID)
	{
		$oldGBID = SUBSTR($GBID, 0, 2) . SUBSTR($GBID, 3, 7);

		$cquery = "select
			cl.gs_id, cl.abridged_name,
			concat(cl.grade_name, '-', cl.section_name) as class,

			fb.fee_bill_type_id, fb.gb_id, fb.academic_session_id,
			fb.bill_cycle_no, fb.bill_title, fb.bill_issue_date,
			fb.bill_due_date, fb.bill_bank_valid_date, fb.bill_months,
			fb.student_id, fb.fee_a, fb.fee_a_discount, fb.fee_d_l1,
			fb.fee_d_l2, fb.fee_b, fb.fee_b_discount, fb.adjustment,
			fb.arrears_suspended, fb.gross_tuition_fee, fb.additional_charges,
			fb.total_current_bill, fb.oc_smartcard_charges, fb.oc_smartcard_ids,
			fb.oc_magazine, fb.oc_surcharge, fb.oc_suspended, fb.oc_adv_tax,
			fb.oc_late_fee, fb.waive_amount, fb.bill_payable, fb.total_payable,
			fb.is_void, DATE_FORMAT(from_unixtime(fbr.created),'%Y-%m-%d') as created,

			fbr.received_date, fbr.received_adv_tax, fbr.received_amount,
			fbr.received_late_fee, fbr.received_payment_mode, fbr.received_branch


			from atif_fee_student.fee_bill fb

			left join (select fee_bill_id, received_date, received_adv_tax,
				received_amount, received_late_fee, received_payment_mode,
				received_branch, is_void, created
				from atif_fee_student.fee_bill_received
				where is_void=0 and record_deleted=0)
				as fbr on fbr.fee_bill_id = fb.id

				
			left join atif.class_list cl on cl.id = fb.student_id

			where fb.is_void=0 and fb.record_deleted=0
			and fb.gb_id = '" . $GBID . "'
			or fb.gb_id = '" . $oldGBID . "' 

			order by fbr.received_date asc
			limit 1";
					

		$query=$this->db_fee_bill->query($cquery);
		$rows_array = $query->result_array();		
        return $rows_array;        
	}
	public  function freezeBlocks(){
		$query="SELECT * from atif_fee_student.billing_cycle_definition order by id desc limit 1";
		$query=$this->db_fee_bill->query($query);
		$data = $query->result_array()[0];
		$current_date=date('Y-m-d');
		$freeze_date_start=$data['adjustment_freeze_date'];
		$unfreeze_date=$data['adjustment_unfreeze_date'];
		$get_bill_cycle_no=$data['bill_cycle_no'];
			if($current_date > $freeze_date_start && $current_date < $unfreeze_date){
				return 'Yes';
			}else{
				return 'No';
			}
	}
}