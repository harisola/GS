<?php
class Process_flow_xp_model extends CI_Model{

	private $dbad;
	function __construct(){ parent::__construct(); }


	public function getCount_IssuanceOfAll(){
		$this->dbad = $this->load->database('gs_admission',TRUE);

		$query = "select 9999 as form_status_id, 9999 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af

			UNION
			select 9988 as form_status_id, 9988 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_assessment_date = '0000-00-00'

			UNION
			select 9977 as form_status_id, 9977 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_assessment_date = '0000-00-00'

			UNION
			select 8888 as form_status_id, 8888 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af where af.form_assessment_date != '0000-00-00'

			UNION
			select 8899 as form_status_id, 8899 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 5 or lgs.new_form_stage = 7 
				or lgs.new_form_stage = 11 or lgs.new_form_stage = 14) 
				and (lgs.new_form_status = 2) 
				group by af.id
			) as af

			UNION
			select 8877 as form_status_id, 8877 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 10) 
				and (lgs.new_form_status = 1) 
				group by af.id
			) as af

			UNION
			select 8866 as form_status_id, 8866 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_assessment_date = '0000-00-00'
			and af.form_submission_date < CURDATE()
			and af.form_status_stage_id != 7

			UNION
			select 8867 as form_status_id, 8867 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_assessment_date = '0000-00-00'
			and af.form_submission_date < CURDATE()-2
			and af.form_status_stage_id != 7

			UNION
			select 8855 as form_status_id, 8855 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 1) 
				group by af.id
			) as af

			UNION
			select 8844 as form_status_id, 8844 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 2


			UNION
			select 7799 as form_status_id, 7799 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (
			Select 
				af.form_no, af.official_name, af.form_batch_id, af.grade_id,
				lfa.old_assessment_date, af.form_assessment_date	
			From atif_gs_admission.log_form_assessment_date as lfa
			Left Join atif_gs_admission.admission_form as af
				on af.id = lfa.admission_form_id
			Where (af.form_assessment_date = '2001-01-01')
			) as af

			UNION
			select 7788 as form_status_id, 7788 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (Select 
					af.form_no, af.official_name, af.form_batch_id, af.grade_id,
					lfa.old_assessment_date, af.form_assessment_date	
				From atif_gs_admission.log_form_assessment_date as lfa
				Left Join atif_gs_admission.admission_form as af
					on af.id = lfa.admission_form_id
				Where lfa.old_assessment_date = '2001-01-01'
				group by af.id
			) as af

			UNION
			select 7777 as form_status_id, 7777 as form_status_stage_id, count(id) as num, '' as status, '' as stage
			from atif_gs_admission.view_process_flow as af  
			where af.form_dd = '0000-00-00'
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_status_stage_id != 7
			and af.form_status_stage_id != 15
			and af.form_assessment_date > CURDATE()

			UNION
			select 7766 as form_status_id, 7766 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 4) 
				and (lgs.new_form_status = 3) 
				group by af.id
			) as af

			UNION
			select 7755 as form_status_id, 7755 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where ((lgs.new_form_stage = 5 or lgs.new_form_stage = 7 
				or lgs.new_form_stage = 11 or lgs.new_form_stage = 14) 
				and (lgs.new_form_status = 2) OR (af.form_dr = ''
				and af.form_assessment_date != '0000-00-00'
				and af.form_assessment_date != '2001-01-01'
				and af.form_assessment_date < CURDATE()
				and af.form_status_stage_id != 7)) 
				group by af.id
			) as af

			UNION
			select 7744 as form_status_id, 7744 as form_status_stage_id, count(result.id) as num, '' as status, '' as stage
			from(			
			select af.id
			from atif_gs_admission.admission_form as af
			left join (select lgs.admission_form_id, from_unixtime(lgs.modified) as thisDate 
				from atif_gs_admission.log_form_status lgs
				where lgs.new_form_status = 3
				and lgs.new_form_stage = 4) as lgs
			on lgs.admission_form_id = af.id
			where af.form_discussion_result = ''
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_assessment_date < CURDATE() /***** Current Date is here *****/
			and af.form_assessment_result = ''
			and af.form_status_stage_id != 7 and af.form_status_stage_id != 6 and af.form_status_stage_id != 15
			group by af.id) as result

			UNION
			select 7733 as form_status_id, 7733 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_discussion_result = ''
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_assessment_date < CURDATE()-2
			and af.form_status_stage_id != 7

			UNION
			select 7722 as form_status_id, 7722 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 10) 
				and (lgs.new_form_status = 2) 
				group by af.id
			) as af

			UNION
			select 7711 as form_status_id, 7711 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 2) 
				group by af.id
			) as af

			UNION
			select 7700 as form_status_id, 7700 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_discussion_result = ''
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_assessment_date = CURDATE()
			and af.form_status_stage_id != 7

			UNION
			select 7701 as form_status_id, 7701 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16)

			UNION
			select 7702 as form_status_id, 7702 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16) and from_unixtime(af.modified) < curdate()-2

			UNION
			select 7703 as form_status_id, 7703 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 9 or lgs.new_form_stage = 17) 
				and (lgs.new_form_status = 3) 
				group by af.id
			) as af

			UNION
			select 7704 as form_status_id, 7704 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 6 or lgs.new_form_stage = 15) 
				and (lgs.new_form_status = 3) 
				group by af.id
			) as af

			UNION
			select 7705 as form_status_id, 7705 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 15) 
				and (lgs.new_form_status = 3) 
				group by af.id
			) as af

			UNION
			select 7706 as form_status_id, 7706 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17)

			UNION
			select 7707 as form_status_id, 7707 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) and from_unixtime(af.modified) < curdate()-2

			UNION
			select 7708 as form_status_id, 7708 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (((lgs.new_form_stage = 9 or lgs.new_form_stage = 17) 
				and (lgs.new_form_status = 3)) and (af.form_status_stage_ID!=9 or af.form_status_stage_id !=17))
				group by af.id
			) as af

			UNION
			select 7709 as form_status_id, 7709 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 3

			UNION
			select 6666 as form_status_id, 6666 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.view_process_flow as af
			where af.form_dd = '0000-00-00'
			and af.form_dd > CURDATE()
			and af.offer_date != '0000-00-00'
			and af.form_status_stage_id != 7

			UNION
			select 6655 as form_status_id, 6655 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 4) 
				and (lgs.new_form_status = 4) 
				group by af.id
			) as af

			UNION
			select 6644 as form_status_id, 6644 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_status = 4) and (lgs.new_form_stage=5 or lgs.new_form_stage=7 or lgs.new_form_stage=10 or lgs.new_form_stage=11)  
				group by af.id
			) as af

			UNION
			select 6633 as form_status_id, 6633 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.admission_form as af
					left join atif_gs_admission.family_registration as fr
					    on fr.gf_id = af.gf_id
					left join (select lgs.admission_form_id, from_unixtime(lgs.modified) as thisDate 
						from atif_gs_admission.log_form_status lgs
						where lgs.new_form_status = 4
						and lgs.new_form_stage = 4) as lgs
						on lgs.admission_form_id = af.id
					
					
					where af.offer_date = '0000-00-00'
					and af.form_discussion_date != '0000-00-00'
					and af.form_discussion_date != '2001-01-01'
					and af.form_discussion_date < CURDATE() /***** Current Date is here *****/
					and lgs.thisDate is null
					and af.form_status_stage_id != 7
					and af.form_status_stage_id != 6
					and af.form_status_stage_id != 15
				group by af.id
			) as af

			UNION
			select 6622 as form_status_id, 6622 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (af.offer_date = '0000-00-00'
	            and af.form_dd != '0000-00-00'
	            and af.form_dd != '2001-01-01'
	            and af.form_dd < CURDATE()
	            and (af.form_status_stage_id != 7 and af.form_status_stage_id != 8 and af.form_status_stage_id != 9 
						  and af.form_status_stage_id != 15 and af.form_status_stage_id != 16 and af.form_status_stage_id != 17))
				and af.last_d < curdate()-2
				group by af.id
			) as af

			UNION
			select 6611 as form_status_id, 6611 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 3) 
				group by af.id
			) as af

			UNION
			select 6600 as form_status_id, 6600 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.offer_date = '0000-00-00'
			and af.form_discussion_date != '0000-00-00'
			and af.form_discussion_date != '2001-01-01'
			and af.form_discussion_date = CURDATE()
			and af.form_status_stage_id != 7

			UNION
			select 5599 as form_status_id, 5599 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision != ''
			and af.form_discussion_decision != 'OFR'
			and af.form_status_stage_id != 15
			and af.form_status_stage_id != 16
			and af.form_status_stage_id != 17
			and af.form_status_stage_id != 7

			UNION
			select 5588 as form_status_id, 5588 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision != ''
			and af.offer_date != ''

			UNION
			select 5577 as form_status_id, 5577 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_status_stage_id = 16

			UNION
			select 5566 as form_status_id, 5566 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision = 'OHD' and from_unixtime(af.modified) < curdate()-2

			UNION
			select 5555 as form_status_id, 5555 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 9) 
				and (lgs.new_form_status >= 4) 
				group by af.id
			) as af

			UNION
			select 5544 as form_status_id, 5544 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_status_stage_id = 15

			UNION
			select 5533 as form_status_id, 5533 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where ((lgs.old_form_stage = 9 or lgs.old_form_stage = 17) and (lgs.new_form_stage = 6 or lgs.new_form_stage = 15))
				and (lgs.new_form_status >= 3) 
				group by af.id
			) as af

			UNION
			select 5522 as form_status_id, 5522 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17)

			UNION
			select 5511 as form_status_id, 5511 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) and from_unixtime(af.modified) < curdate()-2

			UNION
			select 5500 as form_status_id, 5500 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where ((lgs.old_form_stage = 9 or lgs.old_form_stage = 17 OR lgs.new_form_stage = 9 or lgs.new_form_stage = 17))
				and (af.form_status_id >= 5) 
				group by af.id
			) as af

			UNION
			select 5501 as form_status_id, 5501 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_stage_id = 6

			UNION
			select 4499 as form_status_id, 4499 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 5

			UNION
			select 4488 as form_status_id, 4488 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where af.form_status_id = 5
			and fo.print_fee_bill = 0 and af.form_status_stage_id != 7


			UNION
			select 4433 as form_status_id, 4433 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			left join atif_fee_student.fee_bill as fb
							on SUBSTR(fb.gb_id, 5, 4) = af.form_no
			where af.form_status_id = 5
			and fo.print_fee_bill = 1 and af.form_status_stage_id != 7 and fb.bill_due_date > CURDATE()


			UNION
			select 4477 as form_status_id, 4477 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.view_process_flow as af
			left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id 
			where af.offer_date != '0000-00-00'
			and af.offer_date != '2001-01-01'
			and af.offer_date < CURDATE() /***** Current Date is here *****/
			and af.form_status_stage_id != 7
			and afo.signed_offer_letter = 0
			and af.form_status_stage_id != 6
			and af.form_status_stage_id != 15

			UNION
			select 4466 as form_status_id, 4466 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (af.form_status_id >= 5) 
				and (af.is_OFL = 1)
				group by af.id
			) as af

			UNION
			select 4455 as form_status_id, 4455 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 5
			and af.offer_date < curdate()

			UNION
			select 4444 as form_status_id, 4444 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 5) 
				group by af.id
			) as af




			UNION
			select 3311 as form_status_id, 3311 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 6) 
				group by af.id
			) as af

			UNION
			select 3322 as form_status_id, 3322 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.view_process_flow as af
			left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
			left join atif_fee_student.fee_bill as fb
				on SUBSTR(fb.gb_id, 5, 4) = af.form_no
			left join atif_fee_student.fee_bill_received as fbr
				on fbr.fee_bill_id = fb.id
			where fb.student_id = 7060
			and fb.bill_due_date < CURDATE()
			and af.form_status_stage_id != 7
			





			UNION
			select 1111 as form_status_id, 1111 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_stage_id = 7

			UNION
			select 2222 as form_status_id, 2222 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 6

			UNION
			select 3333 as form_status_id, 3333 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where (af.form_status_stage_id = 15)";
			
		$result = $this->dbad->query($query);
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{
			return FALSE;
		}
	}



























	public function getBatch($GradeName){
		$this->dbad = $this->load->database('gs_admission',TRUE);

		$Where = '';
		foreach ($GradeName as $gradeName) {
			$Where .= "gg.name = '$gradeName' or ";
		}
		$Where = substr($Where, 0, -3);

		$query= "select
				bt.id, bt.grade_id, gg.name as grade_name, bt.batch_category
				from atif_gs_admission._form_batch as bt
				left join atif._grade as gg on gg.id=bt.grade_id
				where $Where
				group by bt.batch_category
				order by bt.batch_category";
			
		$result = $this->dbad->query($query);
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{
			return FALSE;
		}
	}






	public function getAdmissionList($StatusID, $StageID, $GradeID, $BatchID, $Gender, $thisQuery){
		$this->dbad = $this->load->database('gs_admission',TRUE);
		$JoinClause7744 = '';
		$QueryType = 0;
		if($StatusID=7744 and $StageID==7744){
			$JoinClause7744 = "and lgs.new_form_status = 3 and lgs.new_form_stage = 4";
		}else if($StatusID=6633 and $StageID==6633){
			$JoinClause7744 = "and lgs.new_form_status = 4 and lgs.new_form_stage = 4";
		}else if($StatusID=9900 and $StageID==9900){
			$QueryType = 1;
		}else if($StatusID=9902 and $StageID==9902){
			$QueryType = 2;
		}else if($StatusID=9903 and $StageID==9903){
			$QueryType = 3;
		}
		$StatusID = 9999;
		$StageID = 9999;

		$WhereGrade = $this->makeWhereCaluse($GradeID, ',', 'af.grade_name', 0, 'OR', 1);
		$WhereGender = $this->makeWhereCaluse($Gender, ',', 'af.gender', 0, 'OR', 1);
		$WhereStatus = $this->makeWhereCaluse($StatusID, ',', 'af.form_status_id', 1, 'OR', 0);
		$WhereStage = $this->makeWhereCaluse($StageID, ',', 'af.form_status_stage_id', 1, 'OR', 0);

		//var_dump($WhereGrade);
		$WhereFull = $WhereGrade;
		if($BatchID!='' && $BatchID != 'Select Batch' && $GradeID!='All,'){
			$WhereFull .= ' AND (af.form_batch_id = ' . $BatchID . ')'; 
		}
		if($Gender!='' && $Gender != 'BOY,GIRL,'){
			$WhereGender = str_replace("BOY", "B", $WhereGender);
			$WhereGender = str_replace("GIRL", "G", $WhereGender);
			$WhereFull .= ' AND ' . $WhereGender;
		}



		if($thisQuery == ''){
			if($WhereFull != '' && $StatusID != 9999){
				$WhereFull .= ' AND ';
			}
			if($StatusID != '' && $StatusID != 9999){
				$WhereFull .= $WhereStatus;
			}
			if($WhereFull != '' && $StageID != 9999){
				$WhereFull .= ' AND ';
			}
			if($StageID != '' && $StageID != 9999){
				$WhereFull .= $WhereStage;
			}

			if(($GradeID=='' || $GradeID=='All,') && ($BatchID=='' || $BatchID == 'Select Batch') && ($Gender=='' || $Gender == 'BOY,GIRL,')){
				if($QueryType == 1){
					$query = "select * from atif_gs_admission.view_process_flow as af";
				}else if($QueryType == 2){
					$query = "select * from atif_gs_admission.view_process_flow as af
						left join atif_gs_admission.log_form_status as lgs";
				}else if($QueryType == 3){
					$query = "Select af.* 
						From atif_gs_admission.log_form_assessment_date as lfa
						Left Join atif_gs_admission.view_process_flow as af
							on af.id = lfa.admission_form_id";
				}else{
					$query = "select * from atif_gs_admission.view_process_flow as af
					/*left join atif_gs_admission.log_form_status as lgs
						on lgs.admission_form_id = af.id ".$JoinClause7744."
					left join atif_gs_admission.admission_form_offer as afo
						on afo.admission_form_id = af.id
					left join atif_fee_student.fee_bill as fb
						on SUBSTR(fb.gb_id, 5, 4) = af.form_no
					left join atif_fee_student.fee_bill_received as fbr
						on fbr.fee_bill_id = fb.id*/";
				}
				
			}else{
				if($QueryType == 1){
					$query = "select * from atif_gs_admission.view_process_flow as af
						where $WhereFull ";
				}else if($QueryType == 2){
					$query = "select * from atif_gs_admission.view_process_flow as af
						left join atif_gs_admission.log_form_status as lgs
							on lgs.admission_form_id = af.id 
						where $WhereFull ";
				}else if($QueryType == 3){
					$query = "Select af.* 
						From atif_gs_admission.log_form_assessment_date as lfa
						Left Join atif_gs_admission.view_process_flow as af
							on af.id = lfa.admission_form_id
						where $WhereFull ";
				}else{
					$query = "select * from atif_gs_admission.view_process_flow as af
						left join atif_gs_admission.log_form_status as lgs
							on lgs.admission_form_id = af.id ".$JoinClause7744."
						left join atif_gs_admission.admission_form_offer as afo
							on afo.admission_form_id = af.id
						left join atif_fee_student.fee_bill as fb
							on SUBSTR(fb.gb_id, 5, 4) = af.form_no
						left join atif_fee_student.fee_bill_received as fbr
							on fbr.fee_bill_id = fb.id 
						where $WhereFull ";
				}
			}
		}else{
			if(($WhereFull == '' || $WhereGrade == ')') && $BatchID == ''){
				if($QueryType == 1){
					$query = "select * from atif_gs_admission.view_process_flow as af
						where $thisQuery ";
				}else if($QueryType == 2){
					$query = "select * from atif_gs_admission.view_process_flow as af
						left join atif_gs_admission.log_form_status as lgs
							on lgs.admission_form_id = af.id 
						where $thisQuery ";
				}else if($QueryType == 3){
					$query = "Select af.* 
						From atif_gs_admission.log_form_assessment_date as lfa
						Left Join atif_gs_admission.view_process_flow as af
							on af.id = lfa.admission_form_id
						where $thisQuery ";
				}else{
					$query = "select * from atif_gs_admission.view_process_flow as af
						left join atif_gs_admission.log_form_status as lgs
							on lgs.admission_form_id = af.id ".$JoinClause7744."
						left join atif_gs_admission.admission_form_offer as afo
							on afo.admission_form_id = af.id
						left join atif_fee_student.fee_bill as fb
							on SUBSTR(fb.gb_id, 5, 4) = af.form_no
						left join atif_fee_student.fee_bill_received as fbr
							on fbr.fee_bill_id = fb.id 
						where $thisQuery ";
				}
			}else{
				if($QueryType == 1){
					$query = "select * from atif_gs_admission.view_process_flow as af
						where $WhereFull and $thisQuery ";
				}else if($QueryType == 2){
					$query = "select * from atif_gs_admission.view_process_flow as af
						left join atif_gs_admission.log_form_status as lgs
							on lgs.admission_form_id = af.id
						where $WhereFull and $thisQuery ";
				}else if($QueryType == 3){
					$query = "Select af.* 
						From atif_gs_admission.log_form_assessment_date as lfa
						Left Join atif_gs_admission.view_process_flow as af
							on af.id = lfa.admission_form_id
						where $WhereFull and $thisQuery ";
				}else{			
					$query = "select * from atif_gs_admission.view_process_flow as af
					left join atif_gs_admission.log_form_status as lgs
						on lgs.admission_form_id = af.id ".$JoinClause7744."
					left join atif_gs_admission.admission_form_offer as afo
						on afo.admission_form_id = af.id 
					left join atif_fee_student.fee_bill as fb
						on SUBSTR(fb.gb_id, 5, 4) = af.form_no
					left join atif_fee_student.fee_bill_received as fbr
						on fbr.fee_bill_id = fb.id 
					where $WhereFull and $thisQuery ";	
				}		
			}			
		}
		

		
        

		$query .= " group by af.id order by af.grade_id, call_name";

		//print_r($query);
		$result = $this->dbad->query($query);
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{
			return FALSE;
		}
	}
















	public function makeWhereCaluse($stringArray, $seprator, $makeWithName, $IsNum, $LogicOperator, $RemoveLast){
		$Strings = explode($seprator, $stringArray);

		$i = 1;
		$WhereClause = '';
		if(strpos($stringArray, $seprator)>0){
			$WhereClause = '(';
			foreach ($Strings as $dd) {
				if($dd == 'All' || (count($Strings)==$i && $RemoveLast==1)){
					break;
				}else{
					if($IsNum==0){
						$WhereClause .= $makeWithName . "= '" . $dd . "' " . $LogicOperator . " ";
					}else{
						$WhereClause .= $makeWithName . "= " . $dd . " " . $LogicOperator . " ";
					}
				}
				$i++;
			}
			$WhereClause = substr($WhereClause, 0, -(strlen($LogicOperator)+2));
			$WhereClause .= ')';
		}else{
			if($stringArray!='' && $stringArray != 'All' && $stringArray != 'All,'){
				$WhereClause = '(' . $makeWithName . "= " . $stringArray . ')';
			}
		}

		return $WhereClause;
	}









	public function getFullAdmissionInfo($GradeID, $BatchID, $Gender){
		$WhereGrade = $this->makeWhereCaluse($GradeID, ',', 'af.grade_name', 0, 'OR', 1);
		$WhereGender = $this->makeWhereCaluse($Gender, ',', 'af.gender', 0, 'OR', 1);


		$WhereFull = $WhereGrade;
		if($BatchID!='' && $BatchID!= 'Select Batch'){
			$WhereFull .= ' AND (af.form_batch_id = ' . $BatchID . ')'; 
		}
		if($Gender!=''){
			$WhereGender = str_replace("BOY", "B", $WhereGender);
			$WhereGender = str_replace("GIRL", "G", $WhereGender);
			$WhereFull .= ' AND ' . $WhereGender;
		}


		$this->dbad = $this->load->database('gs_admission',TRUE);



		if(($GradeID=='' || $GradeID=='All,') && ($BatchID=='' || $BatchID == 'Select Batch') && ($Gender=='' || $Gender == 'BOY,GIRL,')){
			$query = "select 9999 as form_status_id, 9999 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af

			UNION
			select 9988 as form_status_id, 9988 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_assessment_date = '0000-00-00'

			UNION
			select 9977 as form_status_id, 9977 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_assessment_date = '0000-00-00'

			UNION
			select 8888 as form_status_id, 8888 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af where af.form_assessment_date != '0000-00-00'

			UNION
			select 8899 as form_status_id, 8899 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 5 or lgs.new_form_stage = 7 
				or lgs.new_form_stage = 11 or lgs.new_form_stage = 14) 
				and (lgs.new_form_status = 2) 
				group by af.id
			) as af

			UNION
			select 8877 as form_status_id, 8877 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 10) 
				and (lgs.new_form_status = 1) 
				group by af.id
			) as af

			UNION
			select 8866 as form_status_id, 8866 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_assessment_date = '0000-00-00'
			and af.form_submission_date < CURDATE()
			and af.form_status_stage_id != 7

			UNION
			select 8867 as form_status_id, 8867 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_assessment_date = '0000-00-00'
			and af.form_submission_date < CURDATE()-2
			and af.form_status_stage_id != 7

			UNION
			select 8855 as form_status_id, 8855 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 1) 
				group by af.id
			) as af

			UNION
			select 8844 as form_status_id, 8844 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 2

			UNION
			select 7799 as form_status_id, 7799 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (
			Select 
				af.form_no, af.official_name, af.form_batch_id, af.grade_id,
				lfa.old_assessment_date, af.form_assessment_date	
			From atif_gs_admission.log_form_assessment_date as lfa
			Left Join atif_gs_admission.admission_form as af
				on af.id = lfa.admission_form_id
			Where (af.form_assessment_date = '2001-01-01')
			) as af

			UNION
			select 7788 as form_status_id, 7788 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (Select 
					af.form_no, af.official_name, af.form_batch_id, af.grade_id,
					lfa.old_assessment_date, af.form_assessment_date	
				From atif_gs_admission.log_form_assessment_date as lfa
				Left Join atif_gs_admission.admission_form as af
					on af.id = lfa.admission_form_id
				Where lfa.old_assessment_date = '2001-01-01'
				group by af.id
			) as af

			UNION
			select 7777 as form_status_id, 7777 as form_status_stage_id, count(id) as num, '' as status, '' as stage
			from atif_gs_admission.view_process_flow as af  
			where af.form_dd = '0000-00-00'
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_status_stage_id != 7
			and af.form_status_stage_id != 15
			and af.form_assessment_date > CURDATE()

			UNION
			select 7766 as form_status_id, 7766 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 4) 
				and (lgs.new_form_status = 3) 
				group by af.id
			) as af

			UNION
			select 7755 as form_status_id, 7755 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where ((lgs.new_form_stage = 5 or lgs.new_form_stage = 7 
				or lgs.new_form_stage = 11 or lgs.new_form_stage = 14) 
				and (lgs.new_form_status = 2) OR (af.form_dr = ''
				and af.form_assessment_date != '0000-00-00'
				and af.form_assessment_date != '2001-01-01'
				and af.form_assessment_date < CURDATE()
				and af.form_status_stage_id != 7)) 
				group by af.id
			) as af

			UNION
			select 7744 as form_status_id, 7744 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			left join (select lgs.admission_form_id, from_unixtime(lgs.modified) as thisDate 
				from atif_gs_admission.log_form_status lgs
				where lgs.new_form_status = 3
				and lgs.new_form_stage = 4) as lgs
			on lgs.admission_form_id = af.id
			where af.form_discussion_result = ''
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_assessment_date < CURDATE() /***** Current Date is here *****/
			and /*lgs.modified is null*/ af.form_assessment_result = ''
			and af.form_status_stage_id != 7 and af.form_status_stage_id != 6 and af.form_status_stage_id != 15

			UNION
			select 7733 as form_status_id, 7733 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_discussion_result = ''
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_assessment_date < CURDATE()-2
			and af.form_status_stage_id != 7

			UNION
			select 7722 as form_status_id, 7722 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 10) 
				and (lgs.new_form_status = 2) 
				group by af.id
			) as af

			UNION
			select 7711 as form_status_id, 7711 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 2) 
				group by af.id
			) as af

			UNION
			select 7700 as form_status_id, 7700 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_discussion_result = ''
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_assessment_date = CURDATE()
			and af.form_status_stage_id != 7

			UNION
			select 7701 as form_status_id, 7701 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16)

			UNION
			select 7702 as form_status_id, 7702 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16) and from_unixtime(af.modified) < curdate()-2

			UNION
			select 7703 as form_status_id, 7703 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 9 or lgs.new_form_stage = 17) 
				and (lgs.new_form_status = 3) 
				group by af.id
			) as af

			UNION
			select 7704 as form_status_id, 7704 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 6 or lgs.new_form_stage = 15) 
				and (lgs.new_form_status = 3) 
				group by af.id
			) as af

			UNION
			select 7705 as form_status_id, 7705 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 15) 
				and (lgs.new_form_status = 3) 
				group by af.id
			) as af

			UNION
			select 7706 as form_status_id, 7706 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17)

			UNION
			select 7707 as form_status_id, 7707 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) and from_unixtime(af.modified) < curdate()-2

			UNION
			select 7708 as form_status_id, 7708 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (((lgs.new_form_stage = 9 or lgs.new_form_stage = 17) 
				and (lgs.new_form_status = 3)) and (af.form_status_stage_ID!=9 or af.form_status_stage_id !=17))
				group by af.id
			) as af

			UNION
			select 7709 as form_status_id, 7709 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 3

			UNION
			select 6666 as form_status_id, 6666 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.view_process_flow as af
			where af.form_dd = '0000-00-00'
			and af.form_dd > CURDATE()
			and af.offer_date != '0000-00-00'
			and af.form_status_stage_id != 7

			UNION
			select 6655 as form_status_id, 6655 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 4) 
				and (lgs.new_form_status = 4) 
				group by af.id
			) as af

			UNION
			select 6644 as form_status_id, 6644 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_status = 4) and (lgs.new_form_stage=5 or lgs.new_form_stage=7 or lgs.new_form_stage=10 or lgs.new_form_stage=11)  
				group by af.id
			) as af

			UNION
			select 6633 as form_status_id, 6633 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.admission_form as af
					left join atif_gs_admission.family_registration as fr
					    on fr.gf_id = af.gf_id
					left join (select lgs.admission_form_id, from_unixtime(lgs.modified) as thisDate 
						from atif_gs_admission.log_form_status lgs
						where lgs.new_form_status = 4
						and lgs.new_form_stage = 4) as lgs
						on lgs.admission_form_id = af.id
					
					
					where af.offer_date = '0000-00-00'
					and af.form_discussion_date != '0000-00-00'
					and af.form_discussion_date != '2001-01-01'
					and af.form_discussion_date < CURDATE() /***** Current Date is here *****/
					and lgs.thisDate is null
					and af.form_status_stage_id != 7
					and af.form_status_stage_id != 6
					and af.form_status_stage_id != 15
				group by af.id
			) as af

			UNION
			select 6622 as form_status_id, 6622 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (af.offer_date = '0000-00-00'
	            and af.form_dd != '0000-00-00'
	            and af.form_dd != '2001-01-01'
	            and af.form_dd < CURDATE()
	            and (af.form_status_stage_id != 7 and af.form_status_stage_id != 8 and af.form_status_stage_id != 9 
						  and af.form_status_stage_id != 15 and af.form_status_stage_id != 16 and af.form_status_stage_id != 17))
				and af.last_d < curdate()-2
				group by af.id
			) as af

			UNION
			select 6611 as form_status_id, 6611 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 3) 
				group by af.id
			) as af

			UNION
			select 6600 as form_status_id, 6600 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.offer_date = '0000-00-00'
			and af.form_discussion_date != '0000-00-00'
			and af.form_discussion_date != '2001-01-01'
			and af.form_discussion_date = CURDATE()
			and af.form_status_stage_id != 7

			UNION
			select 5599 as form_status_id, 5599 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision != ''
			and af.form_discussion_decision != 'OFR'
			and af.form_status_stage_id != 15
			and af.form_status_stage_id != 16
			and af.form_status_stage_id != 17
			and af.form_status_stage_id != 7

			UNION
			select 5588 as form_status_id, 5588 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision != ''
			and af.offer_date != ''

			UNION
			select 5577 as form_status_id, 5577 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_status_stage_id = 16

			UNION
			select 5566 as form_status_id, 5566 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision = 'OHD' and from_unixtime(af.modified) < curdate()-2

			UNION
			select 5555 as form_status_id, 5555 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 9) 
				and (lgs.new_form_status >= 4) 
				group by af.id
			) as af

			UNION
			select 5544 as form_status_id, 5544 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_status_stage_id = 15

			UNION
			select 5533 as form_status_id, 5533 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where ((lgs.old_form_stage = 9 or lgs.old_form_stage = 17) and (lgs.new_form_stage = 6 or lgs.new_form_stage = 15))
				and (lgs.new_form_status >= 3) 
				group by af.id
			) as af

			UNION
			select 5522 as form_status_id, 5522 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17)

			UNION
			select 5511 as form_status_id, 5511 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) and from_unixtime(af.modified) < curdate()-2

			UNION
			select 5500 as form_status_id, 5500 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where ((lgs.old_form_stage = 9 or lgs.old_form_stage = 17 OR lgs.new_form_stage = 9 or lgs.new_form_stage = 17))
				and (af.form_status_id >= 5) 
				group by af.id
			) as af

			UNION
			select 5501 as form_status_id, 5501 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_stage_id = 6

			UNION
			select 4499 as form_status_id, 4499 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 5

			UNION
			select 4488 as form_status_id, 4488 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where af.form_status_id = 5
			and fo.print_fee_bill = 0 and af.form_status_stage_id != 7

			UNION
			select 4433 as form_status_id, 4433 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			left join atif_fee_student.fee_bill as fb
							on SUBSTR(fb.gb_id, 5, 4) = af.form_no
			where af.form_status_id = 5
			and fo.print_fee_bill = 1 and af.form_status_stage_id != 7 and fb.bill_due_date > CURDATE()


			UNION
			select 4477 as form_status_id, 4477 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.view_process_flow as af
			left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id 
			where af.offer_date != '0000-00-00'
			and af.offer_date != '2001-01-01'
			and af.offer_date < CURDATE() /***** Current Date is here *****/
			and af.form_status_stage_id != 7
			and afo.signed_offer_letter = 0
			and af.form_status_stage_id != 6
			and af.form_status_stage_id != 15

			UNION
			select 4466 as form_status_id, 4466 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (af.form_status_id >= 5) 
				and (af.is_OFL = 1)
				group by af.id
			) as af

			UNION
			select 4455 as form_status_id, 4455 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 5
			and af.offer_date < curdate()

			UNION
			select 4444 as form_status_id, 4444 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 5) 
				group by af.id
			) as af


			UNION
			select 3311 as form_status_id, 3311 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 6) 
				group by af.id
			) as af

			UNION
			select 3322 as form_status_id, 3322 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.view_process_flow as af
			left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
			left join atif_fee_student.fee_bill as fb
				on SUBSTR(fb.gb_id, 5, 4) = af.form_no
			left join atif_fee_student.fee_bill_received as fbr
				on fbr.fee_bill_id = fb.id
			where fb.student_id = 7060
			and fb.bill_due_date < CURDATE()
			and af.form_status_stage_id != 7
			



			UNION
			select 1111 as form_status_id, 1111 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_stage_id = 7

			UNION
			select 2222 as form_status_id, 2222 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 6

			UNION
			select 3333 as form_status_id, 3333 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where (af.form_status_stage_id = 15)";



		}else{
			$query = "select 9999 as form_status_id, 9999 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where " . $WhereFull . " 

			UNION
			select 9988 as form_status_id, 9988 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_assessment_date = '0000-00-00' and " . $WhereFull . "

			UNION
			select 9977 as form_status_id, 9977 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_assessment_date = '0000-00-00' and " . $WhereFull . "


			UNION
			select 8888 as form_status_id, 8888 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af where af.form_assessment_date != '0000-00-00'
			and " . $WhereFull . "

			UNION
			select 8899 as form_status_id, 8899 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 5 or lgs.new_form_stage = 7 
				or lgs.new_form_stage = 11 or lgs.new_form_stage = 14) 
				and (lgs.new_form_status = 2) and " . $WhereFull . "
				group by af.id
			) as af

			UNION
			select 8877 as form_status_id, 8877 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 10) 
				and (lgs.new_form_status = 1) and " . $WhereFull . "
				group by af.id
			) as af

			UNION
			select 8866 as form_status_id, 8866 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_assessment_date = '0000-00-00'
			and af.form_submission_date < CURDATE()
			and af.form_status_stage_id != 7 and " . $WhereFull . "

			UNION
			select 8867 as form_status_id, 8867 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_assessment_date = '0000-00-00'
			and af.form_submission_date < CURDATE()-2
			and af.form_status_stage_id != 7 and " . $WhereFull . "

			UNION
			select 8855 as form_status_id, 8855 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 1) and " . $WhereFull . "
				group by af.id
			) as af

			UNION
			select 8844 as form_status_id, 8844 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 2 and " . $WhereFull . "

			UNION
			select 7799 as form_status_id, 7799 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (
			Select 
				af.form_no, af.official_name, af.form_batch_id, af.grade_id,
				lfa.old_assessment_date, af.form_assessment_date	
			From atif_gs_admission.log_form_assessment_date as lfa
			Left Join atif_gs_admission.admission_form as af
				on af.id = lfa.admission_form_id
			Where (af.form_assessment_date = '2001-01-01') and " . $WhereFull . "
			) as af

			UNION
			select 7788 as form_status_id, 7788 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (Select 
					af.form_no, af.official_name, af.form_batch_id, af.grade_id,
					lfa.old_assessment_date, af.form_assessment_date	
				From atif_gs_admission.log_form_assessment_date as lfa
				Left Join atif_gs_admission.admission_form as af
					on af.id = lfa.admission_form_id
				Where lfa.old_assessment_date = '2001-01-01' and " . $WhereFull . "
				group by af.id
			) as af

			UNION
			select 7777 as form_status_id, 7777 as form_status_stage_id, count(id) as num, '' as status, '' as stage
			from atif_gs_admission.view_process_flow as af  
			where af.form_dd = '0000-00-00'
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_status_stage_id != 7 
			and af.form_status_stage_id != 15
			and af.form_assessment_date > CURDATE()
			and " . $WhereFull . "

			UNION
			select 7766 as form_status_id, 7766 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 4) 
				and (lgs.new_form_status = 3) and " . $WhereFull . "
				group by af.id
			) as af

			UNION
			select 7755 as form_status_id, 7755 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where ((lgs.new_form_stage = 5 or lgs.new_form_stage = 7 
				or lgs.new_form_stage = 11 or lgs.new_form_stage = 14) 
				and (lgs.new_form_status = 2) OR (af.form_dr = ''
				and af.form_assessment_date != '0000-00-00'
				and af.form_assessment_date != '2001-01-01'
				and af.form_assessment_date < CURDATE()
				and af.form_status_stage_id != 7))  and " . $WhereFull . "
				group by af.id
			) as af

			UNION
			select 7744 as form_status_id, 7744 as form_status_stage_id, count(result.id) as num, '' as status, '' as stage
			from(			
			select af.id
			from atif_gs_admission.admission_form as af
			left join (select lgs.admission_form_id, from_unixtime(lgs.modified) as thisDate 
				from atif_gs_admission.log_form_status lgs
				where lgs.new_form_status = 3
				and lgs.new_form_stage = 4) as lgs
			on lgs.admission_form_id = af.id
			where af.form_discussion_result = ''
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_assessment_date < CURDATE() /***** Current Date is here *****/
			and af.form_assessment_result = ''
			and af.form_status_stage_id != 7 and af.form_status_stage_id != 6 and af.form_status_stage_id != 15
			and " . $WhereFull . "
			group by af.id) as result 

			UNION
			select 7733 as form_status_id, 7733 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_discussion_result = ''
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_assessment_date < CURDATE()-2
			and af.form_status_stage_id != 7 and " . $WhereFull . "

			UNION
			select 7722 as form_status_id, 7722 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 10) 
				and (lgs.new_form_status = 2)  and " . $WhereFull . " 
				group by af.id
			) as af

			UNION
			select 7711 as form_status_id, 7711 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 2)  and " . $WhereFull . "  
				group by af.id
			) as af

			UNION
			select 7700 as form_status_id, 7700 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_discussion_result = ''
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_assessment_date = CURDATE()
			and af.form_status_stage_id != 7  and " . $WhereFull . "

			UNION
			select 7701 as form_status_id, 7701 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16) and " . $WhereFull . "

			UNION
			select 7702 as form_status_id, 7702 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16) and from_unixtime(af.modified) < curdate()-2 and " . $WhereFull . "

			UNION
			select 7703 as form_status_id, 7703 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 9 or lgs.new_form_stage = 17) 
				and (lgs.new_form_status = 3) and " . $WhereFull . " 
				group by af.id
			) as af

			UNION
			select 7704 as form_status_id, 7704 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 6 or lgs.new_form_stage = 15) 
				and (lgs.new_form_status = 3) and " . $WhereFull . " 
				group by af.id
			) as af

			UNION
			select 7705 as form_status_id, 7705 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 15) 
				and (lgs.new_form_status = 3) and " . $WhereFull . " 
				group by af.id
			) as af

			UNION
			select 7706 as form_status_id, 7706 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) and " . $WhereFull . "

			UNION
			select 7707 as form_status_id, 7707 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) and from_unixtime(af.modified) < curdate()-2 and " . $WhereFull . "

			UNION
			select 7708 as form_status_id, 7708 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (((lgs.new_form_stage = 9 or lgs.new_form_stage = 17) 
				and (lgs.new_form_status = 3)) and (af.form_status_stage_ID!=9 or af.form_status_stage_id !=17)) and " . $WhereFull . "
				group by af.id
			) as af

			UNION
			select 7709 as form_status_id, 7709 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 3 and " . $WhereFull . "

			UNION
			select 6666 as form_status_id, 6666 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.view_process_flow as af
			where af.form_dd = '0000-00-00'
			and af.form_dd < CURDATE()
			and af.offer_date != '0000-00-00'
			and af.form_status_stage_id != 7 and " . $WhereFull . "

			UNION
			select 6655 as form_status_id, 6655 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 4) 
				and (lgs.new_form_status = 4) and " . $WhereFull . "
				group by af.id
			) as af

			UNION
			select 6644 as form_status_id, 6644 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_status = 4) and (lgs.new_form_stage=5 or lgs.new_form_stage=7 or lgs.new_form_stage=10 or lgs.new_form_stage=11) and " . $WhereFull . "
				group by af.id
			) as af

			UNION
			select 6633 as form_status_id, 6633 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.admission_form as af
					left join atif_gs_admission.family_registration as fr
					    on fr.gf_id = af.gf_id
					left join (select lgs.admission_form_id, from_unixtime(lgs.modified) as thisDate 
						from atif_gs_admission.log_form_status lgs
						where lgs.new_form_status = 4
						and lgs.new_form_stage = 4) as lgs
						on lgs.admission_form_id = af.id
					
					
					where af.offer_date = '0000-00-00'
					and af.form_discussion_date != '0000-00-00'
					and af.form_discussion_date != '2001-01-01'
					and af.form_discussion_date < CURDATE() /***** Current Date is here *****/
					and lgs.thisDate is null
					and af.form_status_stage_id != 7
					and af.form_status_stage_id != 6
					and af.form_status_stage_id != 15 and " . $WhereFull . "
				group by af.id
			) as af

			UNION
			select 6622 as form_status_id, 6622 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (af.offer_date = '0000-00-00'
	            and af.form_dd != '0000-00-00'
	            and af.form_dd != '2001-01-01'
	            and af.form_dd < CURDATE()
	            and (af.form_status_stage_id != 7 and af.form_status_stage_id != 8 and af.form_status_stage_id != 9 
						  and af.form_status_stage_id != 15 and af.form_status_stage_id != 16 and af.form_status_stage_id != 17))
				and af.last_d < curdate()-2 and " . $WhereFull . "
				group by af.id
			) as af

			UNION
			select 6611 as form_status_id, 6611 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 3) and " . $WhereFull . " 
				group by af.id
			) as af

			UNION
			select 6600 as form_status_id, 6600 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.offer_date = '0000-00-00'
			and af.form_discussion_date != '0000-00-00'
			and af.form_discussion_date != '2001-01-01'
			and af.form_discussion_date = CURDATE()
			and af.form_status_stage_id != 7 and " . $WhereFull . "

			UNION
			select 5599 as form_status_id, 5599 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision != ''
			and af.form_discussion_decision != 'OFR'
			and af.form_status_stage_id != 15
			and af.form_status_stage_id != 16
			and af.form_status_stage_id != 17
			and af.form_status_stage_id != 7 and " . $WhereFull . "

			UNION
			select 5588 as form_status_id, 5588 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision != ''
			and af.offer_date != '' and " . $WhereFull . "

			UNION
			select 5577 as form_status_id, 5577 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_status_stage_id = 16 and " . $WhereFull . "

			UNION
			select 5566 as form_status_id, 5566 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision = 'OHD' and from_unixtime(af.modified) < curdate()-2 and " . $WhereFull . "

			UNION
			select 5555 as form_status_id, 5555 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 9) 
				and (lgs.new_form_status >= 4) and " . $WhereFull . "
				group by af.id
			) as af

			UNION
			select 5544 as form_status_id, 5544 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_status_stage_id = 15 and " . $WhereFull . "

			UNION
			select 5533 as form_status_id, 5533 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where ((lgs.old_form_stage = 9 or lgs.old_form_stage = 17) and (lgs.new_form_stage = 6 or lgs.new_form_stage = 15))
				and (lgs.new_form_status >= 3) and " . $WhereFull . " 
				group by af.id
			) as af

			UNION
			select 5522 as form_status_id, 5522 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) and " . $WhereFull . " 

			UNION
			select 5511 as form_status_id, 5511 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) and from_unixtime(af.modified) < curdate()-2 and " . $WhereFull . "

			UNION
			select 5500 as form_status_id, 5500 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where ((lgs.old_form_stage = 9 or lgs.old_form_stage = 17 OR lgs.new_form_stage = 9 or lgs.new_form_stage = 17))
				and (af.form_status_id >= 5) and " . $WhereFull . " 
				group by af.id
			) as af

			UNION
			select 5501 as form_status_id, 5501 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_stage_id = 6 and " . $WhereFull . "

			UNION
			select 4499 as form_status_id, 4499 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 5 and " . $WhereFull . "

			UNION
			select 4488 as form_status_id, 4488 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where af.form_status_id = 5
			and fo.print_fee_bill = 0  and af.form_status_stage_id != 7 and " . $WhereFull . "

			UNION
			select 4433 as form_status_id, 4433 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			left join atif_fee_student.fee_bill as fb
							on SUBSTR(fb.gb_id, 5, 4) = af.form_no
			where af.form_status_id = 5
			and fo.print_fee_bill = 1  and af.form_status_stage_id != 7 and fb.bill_due_date > CURDATE() and " . $WhereFull . "


			UNION
			select 4477 as form_status_id, 4477 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.view_process_flow as af
			left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id 
			where af.offer_date != '0000-00-00'
			and af.offer_date != '2001-01-01'
			and af.offer_date < CURDATE() /***** Current Date is here *****/
			and af.form_status_stage_id != 7
			and afo.signed_offer_letter = 0
			and af.form_status_stage_id != 6
			and af.form_status_stage_id != 15 and " . $WhereFull . "

			UNION
			select 4466 as form_status_id, 4466 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (af.form_status_id >= 5) 
				and (af.is_OFL = 1) and " . $WhereFull . "
				group by af.id
			) as af

			UNION
			select 4455 as form_status_id, 4455 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 5
			and af.offer_date < curdate() and " . $WhereFull . "

			UNION
			select 4444 as form_status_id, 4444 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 5) and " . $WhereFull . " 
				group by af.id
			) as af

			UNION
			select 3311 as form_status_id, 3311 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 6) and " . $WhereFull . "  
				group by af.id
			) as af

			UNION
			select 3322 as form_status_id, 3322 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.view_process_flow as af
			left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
			left join atif_fee_student.fee_bill as fb
				on SUBSTR(fb.gb_id, 5, 4) = af.form_no
			left join atif_fee_student.fee_bill_received as fbr
				on fbr.fee_bill_id = fb.id
			where fb.student_id = 7060
			and fb.bill_due_date < CURDATE()
			and af.form_status_stage_id != 7 and " . $WhereFull . "  







			UNION
			select 1111 as form_status_id, 1111 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_stage_id = 7 and " . $WhereFull . "

			UNION
			select 2222 as form_status_id, 2222 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 6 and " . $WhereFull . "

			UNION
			select 3333 as form_status_id, 3333 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where (af.form_status_stage_id = 15) and " . $WhereFull . "";
		}
		
		//print_r($query);
		

		$result = $this->dbad->query($query);
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{
			return FALSE;
		}
	}
}