<?php
class Staff_offboarding_model extends MY_Model{

	protected $_table_name = 'staff_registered';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'abridged_name asc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct()

	{
		parent::__construct();
	}







	public function getStaff_BasicInformation($GTID){
		$query="select
		sr.id as staff_id, sr.gt_id, cr.gc_id, st.code as staff_status_code, sr.employee_id as photo_id,
		IF(sr.gender='f', 'Female', 'Male') as gender, sr.nic, sr.doj,
		sr.name, sr.abridged_name as staff_abridged_name, SUBSTR(sr.gg_id, 1, POSITION('@' IN sr.gg_id)-1) as gg_id, sr.name_code,
		cnt.apartment_no, cnt.building_name, r.name as region, rs.name as sub_region, IF(cnp.mobile='', sr.mobile_phone, cnp.mobile) as mobile, sr.land_line,
		cnt.plot_no, cnt.street_name,
		sc.gf_id,
		concat(convert(left(lpad(sc.gf_id,5,0),2) using utf8mb4),'-',convert(right(lpad(sc.gf_id,5,0),3) using utf8mb4)) AS `gfid`,
		IF(fs.is_spouse=1, fs.name, '') as father_name,
		IF(fs.is_spouse=1, fs.name, '') as spouse_name,
		std.gs_id, std.abridged_name,
		if(cl.grade_name='', '', CONCAT(cl.grade_name, '-', cl.section_name)) as class,
		if(cl.std_status_code='', 'Alumni', cl.std_status_code) as std_status_code,
		if(cl.house_name='', '', cl.house_name) as house_name

		from atif.staff_registered as sr
		left join atif._staffstatus as st
			on st.id = sr.staff_status
		left join atif_career.career as cr
			on cr.nic = sr.nic
		left join atif.staff_contact_info as cnt
			on cnt.staff_id = sr.id
		left join atif._region as r
			on r.id = cnt.region
		left join atif._region_sub as rs
			on rs.id = cnt.sub_region
		left join atif.staff_contact_phone as cnp
			on cnp.staff_id = sr.id
		left join atif.staff_registered_father_spouse as fs
			on fs.staff_id = sr.id
		left join atif.staff_child as sc
			on sc.staff_id = sr.id
		left join atif.student_registered as std	
			on std.gf_id = sc.gf_id
		left join atif.class_list as cl
			on cl.gs_id = std.gs_id
			
		where sr.gt_id = '$GTID'

		group by std.gs_id";
		$row=$this->db->query($query);
		return $row->result_array();
	}




	public function getStaff_LastWD($StaffID){
		$query="select
			r.id, r.staff_id, r.last_wd, r.notice_period, r.do_resignation, sr.abridged_name as prepared_by, FROM_UNIXTIME(r.created) as prepared_date
			from atif.staff_reg_off_lastwd as r
			left join atif.staff_registered as sr
				on sr.id = r.staff_id

			where r.staff_id = $StaffID 
			order by r.id desc
			limit 1";
		$row=$this->db->query($query);
		return $row->result_array();
	}






	public function getStaff_SectionDepartment($StaffID){
		$query="select
			r.id, r.staff_id, r.planners_returned, r.induction_manual_returned, r.record_keeping_reg_returned,
			r.atd_reg_returned, r.q_bank_returned, r.all_keys_returned, r.all_files_handedover, r.any_other_mat_returned,
			r.comments, r.chk_and_apr_name, r.chk_and_apr_date, r.discussed_with_po, r.is_posted,
			from_unixtime(r.created) as prepared_date, sr.abridged_name as prepared_name
			from atif.staff_reg_off_secdep as r
			left join atif.staff_registered as sr
				on sr.id = r.staff_id
				
			where r.staff_id = $StaffID 
			order by r.id desc
			limit 1";
		$row=$this->db->query($query);
		return $row->result_array();
	}








	public function getStaff_Library($StaffID){
		$query="select
			r.id, r.staff_id, r.section, r.books_returned, r.amount_due,
			r.chk_and_apr_name, r.chk_and_apr_date, r.title_of_books
			from atif.staff_reg_off_library as r
			where r.staff_id = $StaffID 
			order by r.id desc
			limit 1";
		$row=$this->db->query($query);
		return $row->result_array();
	}







	public function getStaff_Finance($StaffID){
		$query="select
		r.id, r.staff_id, r.loan_balance, r.advance_amount, r.pf_contribution,
		r.cpd_balance, r.child_disc_inactive, r.child_sec_deposit_receivable,
		r.comments, r.chk_finance_name, r.chk_finance_date
		from atif.staff_reg_off_finance as r
		where r.staff_id = $StaffID 
		order by r.id desc
		limit 1";
		$row=$this->db->query($query);
		return $row->result_array();
	}










	public function getStaff_HR($StaffID){
		$query="select
		r.id, r.staff_id, r.takaful_opted, r.amount, r.family_size,
		r.induction_booklet, r.smart_card, r.vehicle_sticker, r.gs_email,
		r.portal_id, r.suspended_immediately, r.suspended_after
		from atif.staff_reg_off_hr as r
		where r.staff_id = $StaffID 
		order by r.id desc
		limit 1";
		$row=$this->db->query($query);
		return $row->result_array();
	}


	












	/************************************************************** Checking
	 * Existing Record
	 *************************************************************************/
	public function offBoard_exists_BasicProfile($GTID){
		$ID = 0;

		$query="select
			r.id
			from atif.staff_reg_off_lastwd as r
			left join atif.staff_registered as sr
				on sr.id = r.staff_id

			where sr.gt_id = '".$GTID."'
			order by r.id desc
			limit 1";
		$row=$this->db->query($query);
		if($row->num_rows() > 0){
			$row = $row->result_array();
			$ID = $row[0]['id'];
		}

		return $ID;
	}

	public function offBoard_exists_SectionDepartment($GTID){
		$ID = 0;

		$query="select
			r.id
			from atif.staff_reg_off_secdep as r
			left join atif.staff_registered as sr
				on sr.id = r.staff_id

			where sr.gt_id = '".$GTID."'
			order by r.id desc
			limit 1";
		$row=$this->db->query($query);
		if($row->num_rows() > 0){
			$row = $row->result_array();
			$ID = $row[0]['id'];
		}

		return $ID;
	}

	public function offBoard_exists_Library($GTID){
		$ID = 0;

		$query="select
			r.id
			from atif.staff_reg_off_library as r
			left join atif.staff_registered as sr
				on sr.id = r.staff_id

			where sr.gt_id = '".$GTID."'
			order by r.id desc
			limit 1";
		$row=$this->db->query($query);
		if($row->num_rows() > 0){
			$row = $row->result_array();
			$ID = $row[0]['id'];
		}

		return $ID;
	}

	public function offBoard_exists_Finance($GTID){
		$ID = 0;

		$query="select
			r.id
			from atif.staff_reg_off_finance as r
			left join atif.staff_registered as sr
				on sr.id = r.staff_id

			where sr.gt_id = '".$GTID."'
			order by r.id desc
			limit 1";
		$row=$this->db->query($query);
		if($row->num_rows() > 0){
			$row = $row->result_array();
			$ID = $row[0]['id'];
		}

		return $ID;
	}

	public function offBoard_exists_HR($GTID){
		$ID = 0;

		$query="select
			r.id
			from atif.staff_reg_off_hr as r
			left join atif.staff_registered as sr
				on sr.id = r.staff_id

			where sr.gt_id = '".$GTID."'
			order by r.id desc
			limit 1";
		$row=$this->db->query($query);
		if($row->num_rows() > 0){
			$row = $row->result_array();
			$ID = $row[0]['id'];
		}

		return $ID;
	}













	/************************************************************** Inserting
	 * New - Off Board Record
	 * Basic Proile
	 *************************************************************************/
	public function insertRecord_BasicProfile($GTID, $LastWD, $NoticePeriod, $DOR){
		$now = date('Y-m-d H:i:s');
		$TimeStamp = human_to_unix($now);
		$ID = (int)$this->session->userdata['user_id'];


		if($LastWD == ''){$LastWD = 'null';}else{$LastWD = "'".$LastWD."'";}
		if($DOR == ''){$DOR = 'null';}else{$DOR = "'".$DOR."'";}
		if($NoticePeriod == ''){$NoticePeriod = '0';}


		$query = $this->db->query("INSERT INTO `staff_reg_off_lastwd`
			(`staff_id`, `last_wd`, `notice_period`, `do_resignation`, `created`, `register_by`, `modified`, `modified_by`)
			select id as staff_id,
			$LastWD as last_wd,
			'$NoticePeriod' as notice_period,
			$DOR as do_resignation,
			'$TimeStamp' as created,
			'$ID' as register_by,
			'$TimeStamp' as modified,
			'$ID' as modified_by
			from staff_registered where gt_id = '$GTID'");
	}
	/************************************************************** Updating
	 * Update - Off Board Record
	 * Basic Proile
	 *************************************************************************/
	public function updateRecord_BasicProfile($RecordID, $LastWD, $NoticePeriod, $DOR){
		$now = date('Y-m-d H:i:s');
		$TimeStamp = human_to_unix($now);
		$ID = (int)$this->session->userdata['user_id'];


		if($LastWD == ''){$LastWD = 'null';}else{$LastWD = "'".$LastWD."'";}
		if($DOR == ''){$DOR = 'null';}else{$DOR = "'".$DOR."'";}
		if($NoticePeriod == ''){$NoticePeriod = '0';}


		$query = $this->db->query("UPDATE `staff_reg_off_lastwd` SET 
			last_wd = $LastWD,
			notice_period = '$NoticePeriod',
			do_resignation = $DOR,
			modified = '$TimeStamp',
			modified_by = '$ID'

			WHERE id = $RecordID");
	}
















	/************************************************************** Inserting
	 * New - Off Board Record
	 * Section / Department
	 *************************************************************************/
	public function insertRecord_SectionDepartment($GTID, $SD_PlannersReturned, $SD_InductionManualReturned, $SD_RecordKeepingRegReturned, $SD_AtdRegReturned, $SD_QBankReturned, $SD_AllKeysReturned, $SD_AllFilesHandedOver, $SD_AnyOtherMatReturned, $SD_Comments){
		$now = date('Y-m-d H:i:s');
		$TimeStamp = human_to_unix($now);
		$ID = (int)$this->session->userdata['user_id'];


		$query = $this->db->query("INSERT INTO `staff_reg_off_secdep`
			(`staff_id`, `planners_returned`, `induction_manual_returned`, `record_keeping_reg_returned`, 
			atd_reg_returned, q_bank_returned, 	all_keys_returned, all_files_handedover, any_other_mat_returned, comments,
			chk_and_apr_name, chk_and_apr_date, discussed_with_po, is_posted,
			`created`, `register_by`, `modified`, `modified_by`)
			select id as staff_id,
			$SD_PlannersReturned as planners_returned,
			$SD_InductionManualReturned as induction_manual_returned,
			$SD_RecordKeepingRegReturned as record_keeping_reg_returned,
			$SD_AtdRegReturned as atd_reg_returned,
			$SD_QBankReturned as q_bank_returned,
			$SD_AllKeysReturned as all_keys_returned,
			$SD_AllFilesHandedOver as all_files_handedover,
			$SD_AnyOtherMatReturned as any_other_mat_returned,
			'$SD_Comments' as comments,
			'' as chk_and_apr_name,
			null as chk_and_apr_date,
			0 as discussed_with_po,
			0 as posted,

			'$TimeStamp' as created,
			'$ID' as register_by,
			'$TimeStamp' as modified,
			'$ID' as modified_by
			from staff_registered where gt_id = '$GTID'");
	}
	/************************************************************** Updating
	 * Update - Off Board Record
	 * Section / Department
	 *************************************************************************/
	public function updateRecord_SectionDepartment($RecordID, $SD_PlannersReturned, $SD_InductionManualReturned, $SD_RecordKeepingRegReturned, $SD_AtdRegReturned, $SD_QBankReturned, $SD_AllKeysReturned, $SD_AllFilesHandedOver, $SD_AnyOtherMatReturned, $SD_Comments){
		$now = date('Y-m-d H:i:s');
		$TimeStamp = human_to_unix($now);
		$ID = (int)$this->session->userdata['user_id'];

		$query = $this->db->query("UPDATE `staff_reg_off_secdep` SET 
			planners_returned = $SD_PlannersReturned,
			induction_manual_returned = '$SD_InductionManualReturned',
			record_keeping_reg_returned = $SD_RecordKeepingRegReturned,
			atd_reg_returned = $SD_AtdRegReturned,
			q_bank_returned = '$SD_QBankReturned',
			all_keys_returned = $SD_AllKeysReturned,
			all_files_handedover = $SD_AllFilesHandedOver,
			any_other_mat_returned = '$SD_AnyOtherMatReturned',
			comments = '$SD_Comments',

			modified = '$TimeStamp',
			modified_by = '$ID'

			WHERE id = $RecordID");
	}




















	/************************************************************** Inserting
	 * New - Off Board Record
	 * Library
	 *************************************************************************/
	public function insertRecord_Library($GTID, $LB_Section, $LB_Returned, $LB_Amount, $LB_TitleOfBooks){
		$now = date('Y-m-d H:i:s');
		$TimeStamp = human_to_unix($now);
		$ID = (int)$this->session->userdata['user_id'];

		if($LB_Amount == ''){$LB_Amount = '0';}

		$query = $this->db->query("INSERT INTO `staff_reg_off_library`
			(`staff_id`, `section`, `books_returned`, `amount_due`, title_of_books,
			chk_and_apr_name, chk_and_apr_date,
			`created`, `register_by`, `modified`, `modified_by`)
			select id as staff_id,
			'$LB_Section' as section,
			$LB_Returned as books_returned,
			$LB_Amount as amount_due,
			'$LB_TitleOfBooks' as title_of_books,
			'' as chk_and_apr_name,
			null as chk_and_apr_date,

			'$TimeStamp' as created,
			'$ID' as register_by,
			'$TimeStamp' as modified,
			'$ID' as modified_by
			from staff_registered where gt_id = '$GTID'");
	}
	/************************************************************** Updating
	 * Update - Off Board Record
	 * Library
	 *************************************************************************/
	public function updateRecord_Library($RecordID, $LB_Section, $LB_Returned, $LB_Amount, $LB_TitleOfBooks){
		$now = date('Y-m-d H:i:s');
		$TimeStamp = human_to_unix($now);
		$ID = (int)$this->session->userdata['user_id'];

		if($LB_Amount == ''){$LB_Amount = '0';}

		$query = $this->db->query("UPDATE `staff_reg_off_library` SET 
			section = '$LB_Section',
			books_returned = '$LB_Returned',
			amount_due = $LB_Amount,
			title_of_books = '$LB_TitleOfBooks',

			modified = '$TimeStamp',
			modified_by = '$ID'

			WHERE id = $RecordID");
	}
















	/************************************************************** Inserting
	 * New - Off Board Record
	 * Finance
	 *************************************************************************/
	public function insertRecord_Finance($GTID, $FN_LoanBalance, $FN_AdvAmount, $FN_PFContribution, $FN_CPDOutstanding, $FN_ChildFee, $FN_ChildSDReceivable, $FN_Comments){
		$now = date('Y-m-d H:i:s');
		$TimeStamp = human_to_unix($now);
		$ID = (int)$this->session->userdata['user_id'];


		$query = $this->db->query("INSERT INTO `staff_reg_off_finance`
			(`staff_id`, `loan_balance`, `advance_amount`, `pf_contribution`, 
			cpd_balance, child_disc_inactive, 	child_sec_deposit_receivable, comments,
			chk_finance_name, 	chk_finance_date,
			`created`, `register_by`, `modified`, `modified_by`)
			select id as staff_id,
			$FN_LoanBalance as loan_balance,
			$FN_AdvAmount as advance_amount,
			$FN_PFContribution as pf_contribution,
			$FN_CPDOutstanding as cpd_balance,
			$FN_ChildFee as child_disc_inactive,
			$FN_ChildSDReceivable as child_sec_deposit_receivable,
			'$FN_Comments' as comments,
			'' as chk_finance_name,
			null as chk_finance_date,

			'$TimeStamp' as created,
			'$ID' as register_by,
			'$TimeStamp' as modified,
			'$ID' as modified_by
			from staff_registered where gt_id = '$GTID'");
	}
	/************************************************************** Updating
	 * Update - Off Board Record
	 * Finance
	 *************************************************************************/
	public function updateRecord_Finance($RecordID, $FN_LoanBalance, $FN_AdvAmount, $FN_PFContribution, $FN_CPDOutstanding, $FN_ChildFee, $FN_ChildSDReceivable, $FN_Comments){
		$now = date('Y-m-d H:i:s');
		$TimeStamp = human_to_unix($now);
		$ID = (int)$this->session->userdata['user_id'];

		$query = $this->db->query("UPDATE `staff_reg_off_finance` SET 
			loan_balance = $FN_LoanBalance,
			advance_amount = '$FN_AdvAmount',
			pf_contribution = $FN_PFContribution,
			cpd_balance = '$FN_CPDOutstanding',
			child_disc_inactive = $FN_ChildFee,
			child_sec_deposit_receivable = $FN_ChildSDReceivable,
			comments = '$FN_Comments',

			modified = '$TimeStamp',
			modified_by = '$ID'

			WHERE id = $RecordID");
	}
















	/************************************************************** Inserting
	 * New - Off Board Record
	 * HR
	 *************************************************************************/
	public function insertRecord_HR($GTID, $HR_TakafulOpted, $HR_PrimaryInductionBooklet, $HR_SmartCard, $HR_VehicleSticker, $HR_SuspendImmediately, $HR_Amount, $HR_FamilySize, $HR_GSEmail, $HR_PortalID, $HR_SuspendAfter){
		$now = date('Y-m-d H:i:s');
		$TimeStamp = human_to_unix($now);
		$ID = (int)$this->session->userdata['user_id'];

		if($HR_TakafulOpted == ''){$HR_TakafulOpted = '0';}
		if($HR_PrimaryInductionBooklet == ''){$HR_PrimaryInductionBooklet = '0';}
		if($HR_SmartCard == ''){$HR_SmartCard = '0';}
		if($HR_VehicleSticker == ''){$HR_VehicleSticker = '0';}
		if($HR_SuspendImmediately == ''){$HR_SuspendImmediately = '0';}
		if($HR_Amount == ''){$HR_Amount = '0';}
		if($HR_FamilySize == ''){$HR_FamilySize = '0';}
		if($HR_SuspendAfter == ''){$HR_SuspendAfter = 'null';}else{$HR_SuspendAfter = "'".$HR_SuspendAfter."'";}

		$query = $this->db->query("INSERT INTO `staff_reg_off_hr`
			(`staff_id`, `takaful_opted`, `amount`, `family_size`, 
			induction_booklet, smart_card, vehicle_sticker, gs_email, portal_id, suspended_immediately, suspended_after,
			`created`, `register_by`, `modified`, `modified_by`)
			select id as staff_id,
			'$HR_TakafulOpted' as takaful_opted,
			'$HR_Amount' as amount,
			'$HR_FamilySize' as family_size,
			'$HR_PrimaryInductionBooklet' as induction_booklet,
			'$HR_SmartCard' as smart_card,
			'$HR_VehicleSticker' as vehicle_sticker,
			'$HR_GSEmail' as gs_email,
			'$HR_PortalID' as portal_id,
			'$HR_SuspendImmediately' as suspended_immediately,
			$HR_SuspendAfter as suspended_after,

			'$TimeStamp' as created,
			'$ID' as register_by,
			'$TimeStamp' as modified,
			'$ID' as modified_by
			from staff_registered where gt_id = '$GTID'");
	}
	/************************************************************** Updating
	 * Update - Off Board Record
	 * HR
	 *************************************************************************/
	public function updateRecord_HR($RecordID, $HR_TakafulOpted, $HR_PrimaryInductionBooklet, $HR_SmartCard, $HR_VehicleSticker, $HR_SuspendImmediately, $HR_Amount, $HR_FamilySize, $HR_GSEmail, $HR_PortalID, $HR_SuspendAfter){
		$now = date('Y-m-d H:i:s');
		$TimeStamp = human_to_unix($now);
		$ID = (int)$this->session->userdata['user_id'];

		if($HR_TakafulOpted == ''){$HR_TakafulOpted = '0';}
		if($HR_PrimaryInductionBooklet == ''){$HR_PrimaryInductionBooklet = '0';}
		if($HR_SmartCard == ''){$HR_SmartCard = '0';}
		if($HR_VehicleSticker == ''){$HR_VehicleSticker = '0';}
		if($HR_SuspendImmediately == ''){$HR_SuspendImmediately = '0';}
		if($HR_Amount == ''){$HR_Amount = '0';}
		if($HR_FamilySize == ''){$HR_FamilySize = '0';}
		if($HR_SuspendAfter == ''){$HR_SuspendAfter = 'null';}else{$HR_SuspendAfter = "'".$HR_SuspendAfter."'";}

		$query = $this->db->query("UPDATE `staff_reg_off_hr` SET 
			takaful_opted = $HR_TakafulOpted,
			amount = '$HR_Amount',
			family_size = $HR_FamilySize,
			induction_booklet = '$HR_PrimaryInductionBooklet',
			smart_card = $HR_SmartCard,
			vehicle_sticker = $HR_VehicleSticker,
			gs_email = '$HR_GSEmail',
			portal_id = '$HR_PortalID',
			suspended_immediately = '$HR_SuspendImmediately',
			suspended_after = $HR_SuspendAfter,

			modified = '$TimeStamp',
			modified_by = '$ID'

			WHERE id = $RecordID");
	}
}	