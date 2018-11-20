<?php
class Comment_log extends CI_Model{
	private $ddb;
	function __construct(){ parent::__construct(); }
	
	public function get_log($form_id){
		
		$this->ddb = $this->load->database('gs_admission',TRUE);
		
			$query = "SELECT * FROM
			(
			/************************************************* Form Issuance
			*****************************************************************/
			select
			af.id as admission_form_id, FROM_UNIXTIME(af.created) as change_date, '' as reason,
			CONCAT('Admission form issued', ' on ', DATE_FORMAT(FROM_UNIXTIME(af.created), '%d-%b-%Y %h:%i %p')) as message,
			'Issuance' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 1 as this_order
			from atif_gs_admission.admission_form as af
			left join atif.staff_registered as sr
			   on sr.user_id = af.register_by
			where af.id = ".$form_id." /***** Change Form ID *****/
			
			
			
			UNION
			
			
			/************************************** Form Issuance - COmments
			*****************************************************************/
			select
			af.id as admission_form_id, FROM_UNIXTIME(af.created) as change_date, IF(af.comments!='', 'Admission Form Comments', '') as reason,
			IF(af.comments != '', CONCAT(af.comments, ' on ', DATE_FORMAT(FROM_UNIXTIME(af.created), '%d-%b-%Y %h:%i %p')), '') as message,
			'Comments' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 1 as this_order
			from atif_gs_admission.admission_form as af
			left join atif.staff_registered as sr
			   on sr.user_id = af.register_by
			where af.id = ".$form_id." and af.comments!='' /***** Change Form ID *****/



			UNION

			/*************************************************** Form Status - Submission
			*****************************************************************/
			select
			lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, '' as reason,
			CONCAT(fst_new.name, ' on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
			'Status' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 2 as this_order

			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission._form_status as fst_old
			   on fst_old.id = lgs.old_form_status
			left join atif_gs_admission._form_status as fst_new
			   on fst_new.id = lgs.new_form_status
			left join atif.staff_registered as sr
			   on sr.user_id = lgs.modified_by
			where lgs.admission_form_id = ".$form_id." /***** Change Form ID *****/    
			and lgs.type = 'S' and lgs.old_form_status=1 and lgs.new_form_status=2
			group by lgs.admission_form_id

			UNION


			/************************************ Communication - Assessment
			*****************************************************************/
			select
			lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, '' as reason,
			CONCAT('Communication of Assessment on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
			'Stage' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 3 as this_order

			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission._form_status_stage as fst_old
			   on fst_old.id = lgs.new_form_stage
			left join atif_gs_admission._form_status_stage as fst_new
			   on fst_new.id = lgs.new_form_stage
			left join atif.staff_registered as sr
			   on sr.user_id = lgs.modified_by
			where lgs.admission_form_id = ".$form_id." /***** Change Form ID *****/    
			and lgs.new_form_status = 2 and lgs.new_form_stage = 2
			group by admission_form_id


			UNION


			/***************************************** Presence - Assessment
			*****************************************************************/
			select
			lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, '' as reason,
			CONCAT('Presence of Assessment on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
			'Stage' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 3 as this_order

			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission._form_status_stage as fst_old
			   on fst_old.id = lgs.new_form_stage
			left join atif_gs_admission._form_status_stage as fst_new
			   on fst_new.id = lgs.new_form_stage
			left join atif.staff_registered as sr
			   on sr.user_id = lgs.modified_by
			where lgs.admission_form_id = ".$form_id." /***** Change Form ID *****/    
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
			where lgs.admission_form_id = ".$form_id." /***** Change Form ID *****/    
			/*and lgs.type = 'G' and lgs.new_form_status >= 5


			UNION*/



			/************************************************* Form Comments
			*****************************************************************/
			select
			com.admission_form_id, FROM_UNIXTIME(com.created) as change_date, IF(com.reason = '', '', CONCAT(com.reason, ' on ', DATE_FORMAT(FROM_UNIXTIME(com.created), '%a %d, %b %Y %h:%i %p'))) as reason,
			com.comments as message, 'Comments' as type,
			if(sr.employee_id='298', 'gs_logo', sr.employee_id) as photo_id, sr.abridged_name as staff_name, 4 as this_order

			from atif_gs_admission.log_form_comments as com
			left join atif.staff_registered as sr
			   on sr.user_id = com.register_by
			       
			where com.admission_form_id = ".$form_id." /***** Change Form ID *****/        
			) AS DATA

			order by admission_form_id, change_date, this_order";



	$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
	}else{ return FALSE; }
		
} // Get Log
// Insert database
public function insert_log($table,$data){
	$this->ddb = $this->load->database('gs_admission',TRUE);
	$this->ddb->insert($table, $data);
	return $this->ddb->insert_id();	
}
// end set



// Insert database
public function Custom_Query($Query){
	$this->ddb = $this->load->database('gs_admission',TRUE);
	$return = $this->ddb->query($Query);
	return $return;
}
// end set



	
} //Authorities modal	