<?php
class Process_flow_xp_model extends CI_Model{

	private $dbad;
	function __construct(){ parent::__construct(); }


	public function getCount_IssuanceOfAll(){
		$this->dbad = $this->load->database('gs_admission',TRUE);

		
		 
		$query = "select 9999 as form_status_id, 9999 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af

			UNION # Waiting for Submission
			select 9988 as form_status_id, 9988 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id=1) and ( af.form_status_stage_id <= 3 ) and (af.form_submission_date >= curdate())
			
			UNION 
			select 9981 as form_status_id, 9981 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id=1) and ( af.form_status_stage_id <= 3 ) and (af.form_submission_date >= curdate())
			and from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) 
			

			

			# currently in submission extension
			UNION 
			select 9977 as form_status_id, 9977 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af where af.form_status_id = 1 and af.form_status_stage_id = 10 
			
			# currently in submission extension ( red )
			union
			select 9978 as form_status_id, 9978 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af where af.form_status_id = 1 and af.form_status_stage_id = 10 
			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			

			#Admission forms submitted
			UNION	
			select 8888 as form_status_id, 8888 as form_status_stage_id, count(id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af where af.form_status_id >= 2
			
			
			# To Be submission followed up
			UNION 
			select 
			8899 as form_status_id, 8899 as form_status_stage_id, sum(IDs) as num, '' as status, '' as stage
			from (
				SELECT count(lgs.id) as IDs
				from atif_gs_admission.log_form_status as lgs
				where lgs.new_form_status = 1 
				and (  lgs.new_form_stage =7 or lgs.new_form_stage = 10 )
				UNION ALL
				select count(af.id) as IDs from atif_gs_admission.admission_form as af 
				where ( af.form_status_id=1 and af.form_submission_date < curdate() and af.form_assessment_date='0000-00-00')
				and ( af.form_status_stage_id not in (7,10))
			) as af


			



			#Total Submission Overall Extensions
			UNION 
			select 8877 as form_status_id, 8877 as form_status_stage_id, count(*) as num, '' as status, '' as stage
from atif_gs_admission.log_form_status as lgs
where lgs.new_form_status=1 and lgs.new_form_stage=10 


			

			# Currently in submission follow up
			UNION 
			select 8866 as form_status_id, 8866 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from (select af.* from atif_gs_admission.admission_form as af 
				where ( af.form_status_id=1 and af.form_submission_date < curdate() and af.form_assessment_date='0000-00-00')
				and ( af.form_status_stage_id not in (7,10))
			) as af

			
			UNION
			select 8867 as form_status_id, 8867 as form_status_stage_id, count(af.form_id)  as num, '' as status, '' as stage 
			from ( 
			select af.id as form_id
			from atif_gs_admission.admission_form as af
			where ( af.form_status_id=1 and af.form_submission_date < curdate() and af.form_assessment_date='0000-00-00' 
			and ( from_unixtime( af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) ) )
			and ( af.form_status_stage_id not in (7,10)) 
			) as af
			
			

			
			
			
			# Form Submission Interested
			UNION 
			select 8855 as form_status_id, 8855 as form_status_stage_id, count(*) as num, '' as status, '' as stage
				from atif_gs_admission.admission_form as af
			where af.form_status_id=1
			and af.form_status_stage_id=7


			# Currently Waiting / Extensions for Form assessment
			UNION
			select 8844 as form_status_id, 8844 as form_status_stage_id,  count(*) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 2
			
			# Waiting/Extensions for Form assessment ( Red )
			UNION
			select 8841 as form_status_id, 8841 as form_status_stage_id,  count(*) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 2
			and ( from_unixtime( af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) ) 


			# Form Submission Currently in To Be Allocate
			UNION
			
select 7799 as form_status_id, 7799 as form_status_stage_id, count( af.id ) as num, '' as status, '' as stage
 			From atif_gs_admission.admission_form as af
				
				Where ( 
				af.form_status_id=2 and 
				af.form_assessment_date = '2001-01-01' and af.form_status_stage_id=12 )
				

			
			
			# Form Submission To Be Allocate more than 2 days 
			UNION
			select 77099 as form_status_id, 77099 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			From atif_gs_admission.admission_form as af
				Where  
				af.form_status_id=2 and 
				af.form_assessment_date = '2001-01-01'
				and af.form_status_stage_id=12
				and (from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) ) 
			
			
			
			

			# Form Submission To Be Allocate Overall
			UNION
			select 7788 as form_status_id, 7788 as form_status_stage_id, count(*) as num, '' as status, '' as stage from atif_gs_admission.log_form_status as ls
where ls.new_form_status=2 and ls.new_form_stage=12
and ls.`type`='G'

			# Form Submission To Be Allocate Removed
			UNION
			select 77088 as form_status_id, 77088 as form_status_stage_id, count(*) as num, '' as status, '' as stage  
			From atif_gs_admission.log_form_status as ls
			where ls.new_form_status=2  and ls.old_form_stage=12 and ls.`type`='G'
	
			
			
			


			#Applicants currently in Assessment
			UNION 
			select 7777 as form_status_id, 7777 as form_status_stage_id, count(id)  as num, '' as status, '' as stage
			from atif_gs_admission.view_process_flow as af  
			where af.form_status_id=2 and ( af.form_assessment_date >= curdate()) and af.form_status_stage_id < 4
					
			
			#Overall applicants moved to Assessment Process
			UNION 
			select 7766 as form_status_id, 7766 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from ( select af.id from atif_gs_admission.admission_form as af where af.form_status_id > 2 ) as af
			

			# Assessment R&D Overall applicants moved to Follow up
			UNION 
			select 7755 as form_status_id, 7755 as form_status_stage_id, sum(IDs) as num, '' as status, '' as stage
			from (
			select count(lgs.id) as IDs
			from atif_gs_admission.log_form_status as lgs
			where (  lgs.new_form_status=2 )
			and ( lgs.new_form_stage =7 or lgs.new_form_stage =10 )
		

			UNION all
			select count(af.id) as IDs from atif_gs_admission.admission_form as af 
			where ( af.form_status_id=2 and af.form_assessment_date < curdate() 
			and af.form_assessment_date != '2001-01-01' 
			
			and ( af.form_status_stage_id not in (6,7,10,15,16,17) ) 
			
			and af.form_discussion_date='0000-00-00' )
			
		
			) as af

			
			

			#Applicants currently in Follow up
			UNION
			select 7744 as form_status_id, 7744 as form_status_stage_id, count(result.id) as num, '' as status, '' as stage
			from(			
			select * from atif_gs_admission.admission_form as af where  af.form_status_id=2 and af.form_assessment_date < CURDATE()
			and af.form_assessment_date != '2001-01-01'  
			and ( af.form_status_stage_id not in (6,7,10,15,16,17) ) 
			and af.form_discussion_date='0000-00-00' 
			) as result
			
			
			

			#Applicants currently in Follow up ( Red )
			UNION
			select 7733 as form_status_id, 7733 as form_status_stage_id, count(result.id) as num, '' as status, '' as stage 
			from(			
			select af.id from atif_gs_admission.admission_form as af where  af.form_status_id=2 and af.form_assessment_date < CURDATE()
			and af.form_assessment_date != '2001-01-01'  
			and ( af.form_status_stage_id not in (6,7,10,15,16,17) ) 
			and af.form_discussion_date='0000-00-00' 
			and (from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) )
			) as result

			#Overall request for extension in assessment
			UNION
			select 7722 as form_status_id, 7722 as form_status_stage_id, count( af.Form_id )as num, '' as status, '' as stage
			from (
			select ( lgs.admission_form_id) as Form_id
			from atif_gs_admission.log_form_status as lgs 
							where (lgs.new_form_stage = 10 ) 
							and (lgs.new_form_status = 2) 
							
						) as af

			#not interested from follow up in assessment
			UNION
			select 7711 as form_status_id, 7711 as form_status_stage_id, count( af.Form_id ) as num, '' as status, '' as stage
			from ( 
				select ( lgs.form_id) as Form_id 
				from atif_gs_admission.view_process_flow as lgs 
								where (lgs.form_status_stage_id = 7 ) 
							and (lgs.form_status_id = 2) 
							
							
				
			) as af

			#Applicants showed up for Assessment
			UNION
			select 7700 as form_status_id, 7700 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_discussion_result = ''
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_status_id=3 and (af.form_status_stage_id = 4)
			and af.form_assessment_result =''
			
			
			
		
			

			#Applicants currently On Hold
			UNION
			select 7701 as form_status_id, 7701 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			
			and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16)

			#Applicants currently On assessment Hold Red (-)
			UNION
			select 7702 as form_status_id, 7702 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3) 

			and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16) 
			and (from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) )

			#Applicants moved to assessment waitlist
			UNION
			select 7703 as form_status_id, 7703 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where ( lgs.new_form_stage = 9 or lgs.new_form_stage = 17 ) 
				and (lgs.new_form_status = 3) 
				group by af.id
			) as af

			#Applicants assessment moved to regret 
			
			UNION
			select 7704 as form_status_id, 7704 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where  af.form_status_id = 3 and af.form_status_stage_id=15 and (af.form_assessment_decision ='RGT' or af.form_assessment_decision='OHD')

			#Applicants assessment moved to regret by po
			UNION
			select 7705 as form_status_id, 7705 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where  af.form_status_id = 3 and af.form_status_stage_id=15 and af.form_assessment_decision='WIL'
			

			#Applicants assessment currently wait list
			UNION
			select 7706 as form_status_id, 7706 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3) 
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17)

			#Applicants assessment currently wait list Red less then 2 day
			UNION
			select 7707 as form_status_id, 7707 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) 
			and ( from_unixtime(af.modified, '%Y-%m-%d' ) < ( curdate()- INTERVAL 3 day ) )

			#Applicants assessment allocated from wait list
			UNION
			select 7708 as form_status_id, 7708 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (((lgs.old_form_stage = 9 or lgs.old_form_stage = 17) 
				and (lgs.new_form_status = 3))  )
				group by af.id
			) as af

			UNION
			select 7709 as form_status_id, 7709 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 3

			#Currently discussion / Call for discussion
			UNION
			select 6666 as form_status_id, 6666 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.view_process_flow as af
			where af.form_status_id=3
			and af.form_dd >= CURDATE()
			and af.form_status_stage_id=13
			
			#Moved to discussion
			UNION
			select 6655 as form_status_id, 6655 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( select af.id as Form_id from atif_gs_admission.admission_form as af where af.form_status_id > 3 ) as af

			#Discussion move to Overall follow up
			UNION
			select 6644 as form_status_id, 6644 as form_status_stage_id, sum(af.IDs) as num, '' as status, '' as stage
			from (
			select count(lgs.id) as IDs
			from atif_gs_admission.log_form_status as lgs
			where (  lgs.new_form_status=3 )
			and (  lgs.new_form_stage =7 or lgs.new_form_stage =10 )
			

			UNION all
				select  count(af.id) as IDs
				from atif_gs_admission.admission_form as af 
							where ( af.form_status_id=3 )
							and ( af.form_status_stage_id not in (4,6,7,8,10,15,16,17))
							and af.form_discussion_date != '0000-00-00'
							and af.form_discussion_date < curdate()
			) as af

			

			#Discussion currently Follow up
			UNION
			select 6633 as form_status_id, 6633 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			where ( af.form_status_id=3 )
							and ( af.form_status_stage_id not in (4,6,7,8,10,15,16,17))
							#and af.form_discussion_date != '0000-00-00'
							and af.form_discussion_date < curdate()
			
			

			
			#Discussion Overall extension
			UNION
			select 6622 as form_status_id, 6622 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			where af.form_status_id=3
			and ( af.form_status_stage_id = 10 )
			and (af.form_discussion_date < curdate() )
			#and af.offer_date='0000-00-00'
			
			


			#Currently discussion not interested
			UNION
			select 
			6611 as form_status_id, 6611 as form_status_stage_id, count(*) as num, '' as status, '' as stage
				from atif_gs_admission.admission_form as af
			where (af.form_status_id=3 or af.form_status_id=4)
			and af.form_status_stage_id=7



			#Currently Show up for discussion
			UNION
			select 6600 as form_status_id, 6600 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where ( af.form_status_id =4 )
			and ( af.form_status_stage_id = 4)
			
			
			#Currently discussion On Hold
			UNION
			select 6601 as form_status_id, 6601 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_id = 4 and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16)
			
			#Currently discussion On Hold Red more than 2 days
			UNION
			select 6602 as form_status_id, 6602 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_id = 4 and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16) 
			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day)
			
			
			#discussion post wait list current
			UNION
			select 6603 as form_status_id, 6603 as form_status_stage_id, sum(af.Form_id) as num, '' as status, '' as stage 
			from( 
			select count(af.id) as Form_id 
			from atif_gs_admission.admission_form as af 
			where af.form_status_id=4 and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17 ) 
					
			union all 
			select count(af.id) as Form_id 
			from atif_gs_admission.admission_form as af 
			where af.form_status_id=5 
			and af.form_status_stage_id=12 
			) as af
			
			#discussion post wait list current (red)
			UNION
			select 6610 as form_status_id, 6610 as form_status_stage_id, sum(af.Form_id) as num, '' as status, '' as stage 
			from( 
			select count(afff.id) as Form_id 
			from atif_gs_admission.admission_form as afff
			where afff.form_status_id=4 and (afff.form_status_stage_id = 9 or afff.form_status_stage_id = 17 ) 
			and from_unixtime(afff.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			
			union  all
			select count(aff.id) as Form_id 
			from atif_gs_admission.admission_form as aff 
			where aff.form_status_id=5 
			and aff.form_status_stage_id=12 
			and from_unixtime(aff.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			) as af
			
			
			#discussion overall regret
			UNION
			select  
			6604 as form_status_id, 6604 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			

			where (af.form_status_id=4 or af.form_status_id=5)
			and af.form_status_stage_id=15 and (af.form_discussion_decision ='RGT' or af.form_discussion_decision='OHD')


			
			
			#discussion overall regret by p o
			UNION
			select  
			6605 as form_status_id, 6605 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			
			where (af.form_status_id=4 or af.form_status_id=5)
			and af.form_status_stage_id=15	and af.form_discussion_decision='WIL'


			
			
			#discussion overall move to wait list
			UNION
			select 6606 as form_status_id, 6606 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.log_form_status as lgs
			where lgs.new_form_status=4
			and( lgs.new_form_stage=9 or lgs.new_form_stage=17 )
			
			
			#discussion request for extension
			UNION
			select 6608 as form_status_id, 6608 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.log_form_status as af
			where (  af.new_form_status=4 ) and af.new_form_stage=10
			
			
			
			#discussion request for extension
			UNION
			select 6609 as form_status_id, 6609 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.log_form_status as af
			where ( af.new_form_status=3 or af.new_form_status=4 ) and af.new_form_stage=10 
			and from_unixtime(af.modified, '%Y-%m-%d') = (curdate() - INTERVAL 3 day)
			

			

			UNION
			select 5599 as form_status_id, 5599 as form_status_stage_id, count(id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision != ''
			and af.form_discussion_decision != 'OFR'
			and af.form_status_stage_id != 15
			and af.form_status_stage_id != 16
			and af.form_status_stage_id != 17
			and af.form_status_stage_id != 7
			and af.form_status_stage_id != 8
			and af.form_status_stage_id != 9

			UNION
			select 5588 as form_status_id, 5588 as form_status_stage_id, count(id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision != ''
			and af.offer_date != ''

			UNION
			select 5577 as form_status_id, 5577 as form_status_stage_id, count(id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_status_stage_id = 16

			UNION
			select 5566 as form_status_id, 5566 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision = 'OHD' and from_unixtime(af.modified) < curdate()-2

			UNION
			select 5555 as form_status_id, 5555 as form_status_stage_id, count(*) as num, '' as status, '' as stage
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

			# To Be Regretted ( PO Approval )
			UNION
			select 5501 as form_status_id, 5501 as form_status_stage_id, sum(af.Form_id) as num, '' as status, '' as stage
			from( 
			select count(af.id) as Form_id
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 15 )) as af
			
			

			#Overall Applicants Move to Offer Preparations
			UNION
select 4499 as form_status_id, 4499 as form_status_stage_id, count(af.id ) as num, '' as status, '' as stage
from atif_gs_admission.admission_form as af
left join atif_gs_admission.admission_form_offer as fo on fo.admission_form_id = af.id
where af.form_status_id > 4
and af.form_status_stage_id  != 12 
and (case when (af.grade_id = 15 or af.grade_id=16) 
	then `fo`.`post_result_verification_approval`=1 and fo.early_admission_signed_offer_letter=1
	else true end )
	



			#Currently Offer Preparations 
			UNION
			select 4488 as form_status_id, 4488 as form_status_stage_id, sum(aff.id) as num, '' as status, '' as stage
			
			from(
			
			
			select count(af.id) as id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where
			af.form_status_id=5 
			and fo.signed_offer_letter=0 and fo.offer_pack_handover=0
			and af.offer_date >= curdate()
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			
			
			
			union all 
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 

			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date >= curdate()
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			
		) as aff	
			


			



			#Currently Offer Preparations (red)
			UNION
			select 4477 as form_status_id, 4477 as form_status_stage_id, sum(aff.id) as num, '' as status, '' as stage
			
			from(
			
		
			select count(af.id) as id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where
			af.form_status_id=5  
			
			and fo.signed_offer_letter=0 and fo.offer_pack_handover=0
			and af.offer_date > curdate()
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			
			
			
			union all 
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 

			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date > curdate()
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			
		) as aff	


			
			

		#Overall applicants show up to received the offer letter
			UNION
			select 4466 as form_status_id, 4466 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from ( select af.* from atif_gs_admission.view_process_flow as af 
				
				left join atif_gs_admission.admission_form_offer as fo		
				on  af.form_id =  fo.admission_form_id
				 
				where (af.form_status_id >= 5) 
				and (af.is_OFL = 1) 
				and fo.offer_letter=1
				and fo.fif_form=1
				and fo.photo_token=1
				and fo.hand_book=1
				
				and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_offer_letter=1
				else true
				end )



				
			) as af
			
			
			

			#Overall Applicants Move to follow up not show up to received offer letter	
			
			UNION
			select 4455 as form_status_id, 4455 as form_status_stage_id, sum(aff.Form_id) as num, '' as status, '' as stage
			from( 
				select count( gg.Form_id) as Form_id
				from
				(
					select ( lgs.admission_form_id) as Form_id
					from atif_gs_admission.log_form_status as lgs
					left join atif_gs_admission.admission_form_offer as fo
					on fo.admission_form_id = lgs.admission_form_id
					
					where lgs.new_form_status=5 
					
					and ( lgs.new_form_stage=7 or lgs.new_form_stage=10 or lgs.new_form_stage=11 ) 
					and (fo.signed_offer_letter=0 and fo.offer_pack_handover=0)
					and (  case 
					when (lgs.admission_form_id= 15 or lgs.admission_form_id=16)
					then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
					else true
					end )
					
				) as gg
				
				
				
				
				
				
			union  
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 

			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date < curdate()
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			
				
			) as aff
			
			
			
			#Currently Offer Preparations Currently in Follow up
			UNION
			select 4456 as form_status_id, 4456 as form_status_stage_id, sum(af.Form_id)  as num, '' as status, '' as stage
from ( 

			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id = 5 
			and ( af.form_status_stage_id != 7)
			and( af.form_status_stage_id != 10 )
			and( af.form_status_stage_id != 12 )
			and af.offer_date < curdate()
			and (fo.signed_offer_letter=0 or fo.offer_pack_handover=0)

			and (case when (af.grade_id = 15 or af.grade_id=16) then fo.post_result_verification_approval=1 and fo.early_admission_offer_pack_handover=1
			and fo.early_admission_offer_letter=1
				else true end )
			
			
			
			union all 
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 
			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date < curdate()
			and (case when (af.grade_id = 15 or af.grade_id=16) then fo.post_result_verification_approval=1 and fo.early_admission_offer_pack_handover=1
			and fo.early_admission_offer_letter=1
				else true end )

			
			
	) as af		
			


	#Currently Offer Preparations Currently in Follow up ( red )
	UNION
	select 4458 as form_status_id, 4458 as form_status_stage_id, sum(af.Form_id) as num, '' as status, '' as stage
			from ( 

			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id = 5 
			and ( af.form_status_stage_id != 7)
			and( af.form_status_stage_id != 10 )
			and( af.form_status_stage_id != 12 )
			and af.offer_date < curdate()
			
			and (fo.signed_offer_letter=0 or fo.offer_pack_handover=0)

			and (case when (af.grade_id = 15 or af.grade_id=16) then fo.post_result_verification_approval=1 and fo.early_admission_offer_pack_handover=1
			and fo.early_admission_offer_letter=1
				else true end )

			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			
			
			
			
			union all 
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 

			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date < curdate()

			and (case when (af.grade_id = 15 or af.grade_id=16) then fo.post_result_verification_approval=1 and fo.early_admission_offer_pack_handover=1
			and fo.early_admission_offer_letter=1
				else true end )

			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			
		) as af	
	
	

			#Offer Preparations Overall Extension Request
			UNION
			select 4457 as form_status_id, 4457 as form_status_stage_id, count(lgs.form_id) as num, '' as status, '' as stage
			from(
				select  count(lgs.admission_form_id) as form_id
				from atif_gs_admission.log_form_status as lgs 
				left join atif_gs_admission.admission_form as af
				on af.id = lgs.admission_form_id
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = lgs.admission_form_id 
				where lgs.new_form_status=5 
				and (lgs.new_form_stage = 10 ) 
				and (fo.signed_offer_letter=0)
				group by lgs.admission_form_id
			) as lgs		

			
			#not interested to show up received offer letter
			UNION
			select 4444 as form_status_id, 4444 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id=af.id
			where af.form_status_id=5
			and af.form_status_stage_id=7
			and ( fo.signed_offer_letter=0 or  fo.offer_pack_handover=0 )



			#Currently Offer Procedure
			UNION
			select 4433 as form_status_id, 4433 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			
			left join atif_fee_student.fee_bill as fb
			on (SUBSTR(fb.gb_id, 6, 4) = af.form_no) and fb.academic_session_id >= 11 
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'
			
			left join atif_fee_student.fee_bill_received as fbr
			on fbr.fee_bill_id = fb.id
			
			where 
			af.form_status_id=5 
			and ( af.form_status_stage_id = 1 or af.form_status_stage_id = 3  )
			and fo.offer_letter=1
			and fo.fif_form=1
			and fo.print_fee_bill=1
			and fo.photo_token=1
			and fo.hand_book=1
			and fo.signed_offer_letter=1
			and fo.offer_pack_handover=1
			and ( fo.completed_fif_form=0 or fo.signed_hand_book=0)
			and af.offer_date >= curdate()

			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			
			
			#Currently Offer Procedure
			UNION
			select 4434 as form_status_id, 4434 as form_status_stage_id, 0 as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			left join atif_fee_student.fee_bill as fb
			on (SUBSTR(fb.gb_id, 6, 4) = af.form_no) and fb.academic_session_id >= 11 
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10
			left join atif_fee_student.fee_bill_received as fbr
			on fbr.fee_bill_id = fb.id
			where 
			af.form_status_id=5 
			and ( af.form_status_stage_id = 1 or af.form_status_stage_id = 3  )
			and fo.offer_letter=1
			and fo.fif_form=1
			and fo.print_fee_bill=1
			and fo.photo_token=1
			and fo.hand_book=1
			and fo.signed_offer_letter=1
			and fo.offer_pack_handover=1
			and ( fo.completed_fif_form=0 or fo.signed_hand_book=0)
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			and af.offer_date > curdate()
			and from_unixtime(af.modified, '%Y-%m-%d') <  (curdate() - INTERVAL 3 day )
			
			
			 
			#Currently Offer complete check out
			UNION
			select 1984 as form_status_id, 1984 as form_status_stage_id, count(aff.Form_id) as num, '' as status, '' as stage
			from ( 
			
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = af.id

				left JOIN  atif_fee_student.fee_bill as fb
				ON af.form_no = mid(fb.gb_id, 6, 4)
				AND fb.academic_session_id >= 11
				AND fb.record_deleted = 0
				AND fb.gb_id like '18%'
				AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'
				left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
				where 
				af.form_status_id = 5 
				and ( fbr.received_amount is null )
				and fo.signed_offer_letter=1 and fo.offer_pack_handover=1
				and af.offer_date >= curdate()

				and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
				
				
			) as aff	
			
			
			#Currently Offer complete check out ( Red )
			UNION
			select 19084 as form_status_id, 19084 as form_status_stage_id, sum(aff.Form_id) as num, '' as status, '' as stage
			from ( 
			
				select count(af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = af.id

				left JOIN  atif_fee_student.fee_bill as fb
				ON af.form_no = mid(fb.gb_id, 6, 4)
				AND fb.academic_session_id >= 11
				AND fb.record_deleted = 0
				AND fb.gb_id like '18%'
				AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'
				left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
				where 
				af.form_status_id = 5 
				and ( fbr.received_amount is null )
				and fo.signed_offer_letter=1 and fo.offer_pack_handover=1
				and af.offer_date >= curdate()

				and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )


				and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
				
				
			) as aff
			
			
			
			
			


			#Overall follow Complete Checks out
			union
					select 1985 as form_status_id, 1985 as form_status_stage_id, sum(aff.Form_id) as num, '' as status, '' as stage
			from ( 
			
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id = 5 
			and ( af.form_status_stage_id = 7 or af.form_status_stage_id = 10 or af.form_status_stage_id = 11 )
			
			and af.offer_date < curdate()
			and (fo.signed_offer_letter=1 or fo.offer_pack_handover=1)
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			

		
		
			union
			select count(af.id) as Form_id
from atif_gs_admission.admission_form as af
left join atif_gs_admission.admission_form_offer as fo
on fo.admission_form_id = af.id

left JOIN  atif_fee_student.fee_bill as fb
ON af.form_no = mid(fb.gb_id, 6, 4)
AND fb.academic_session_id >= 11
AND fb.record_deleted = 0
AND fb.gb_id like '18%'
AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
where 
af.form_status_id = 5 
and ( af.form_status_stage_id != 7) and (af.form_status_stage_id != 10 )
and ( fbr.received_amount is null )

and ( fo.signed_offer_letter=1 or fo.offer_pack_handover=1 )
and af.offer_date < curdate()

and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )

) as aff	
			
			
			
			
		#Complete Checks out extension
		union
		select 1986 as form_status_id, 1986 as form_status_stage_id, count(aff.form_id) as num, '' as status, '' as stage
		from (

		select  (lgs.admission_form_id) as form_id
				from atif_gs_admission.log_form_status as lgs 
				
				left join atif_gs_admission.admission_form as af
				on af.id = lgs.admission_form_id
				
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = lgs.admission_form_id 
				
				where lgs.new_form_status=5 
				
				and ( lgs.new_form_stage = 10 ) 
				
				and ( fo.signed_offer_letter=1)
				and af.offer_date < curdate()
				
				group by lgs.admission_form_id
				
				
		) as aff
		
		

			UNION
			select 3311 as form_status_id, 3311 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 6) 
				group by af.id
			) as af

			
			
			
			
		#Complete Checks currently in Follow up
		UNION
		select 3322 as form_status_id, 3322 as form_status_stage_id, count(aff.Form_id) as num, '' as status, '' as stage
		from ( 
			
			
			select (af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			
			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 
			and ( fbr.received_amount is null )
			and af.form_status_stage_id not in(6,7,8,9,12,13,14,15,16,17) 
			and fo.signed_offer_letter=1 and fo.offer_pack_handover=1
			and af.offer_date < curdate()

			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			

		) as aff
			
			
			
			
			#Complete Checks currently in Follow up ( Red )
			UNION
			select 3321 as form_status_id, 3321 as form_status_stage_id, count(aff.Form_id) as num, '' as status, '' as stage
			from ( 
				
				
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = af.id
				
				left JOIN  atif_fee_student.fee_bill as fb
ON af.form_no = mid(fb.gb_id, 6, 4)
AND fb.academic_session_id >= 11
AND fb.record_deleted = 0
AND fb.gb_id like '18%'
AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
where 
af.form_status_id = 5 

and ( fbr.received_amount is null )
and af.form_status_stage_id not in(6,7,8,9,10,12,13,14,15,16,17) 
and fo.signed_offer_letter=1 and fo.offer_pack_handover=1
and af.offer_date < curdate()

and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )


and from_unixtime(af.modified, '%Y-%m-%d') <  (curdate() - INTERVAL 3 day )
				
			) as aff


			
			#not interested in complete check list
			UNION
			select 1987 as form_status_id, 1987 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id=af.id
			where af.form_status_id=5
			and af.form_status_stage_id=7
			and ( fo.completed_fif_form=1 or fo.signed_hand_book=1)
			
			
		
			





			#Applicants Aborted overall
			UNION
			select 1111 as form_status_id, 1111 as form_status_stage_id, count(id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_stage_id = 7

			#Admission Complete
			UNION
			select 2222 as form_status_id, 2222 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id = 6 #and af.form_status_stage_id=1

			#Total Regretted
			UNION
			select 3333 as form_status_id, 3333 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
			select (af.id) as Form_id
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id=15 
			
			) as af	";


			// Start of A level admission queries
		$query .= " 
			#Total Regretted
			UNION
			select 3301 as form_status_id, 3301 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='RAO') 
				and af.form_status_stage_id != 12
			) as af 


			UNION
			select 3302 as form_status_id, 3302 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='RAO') 
				and af.form_status_stage_id != 12
			) as af 

			# EAO overall
			UNION
			select 3303 as form_status_id, 3303 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO') 
				and af.form_status_stage_id != 12
			) as af 


			UNION
			select 3304 as form_status_id, 3304 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')  and af.form_status_stage_id = 2
				and af.offer_date >= curdate()
				and (afo.early_admission_offer_letter=0 or afo.early_admission_offer_letter is null)
				and ( afo.early_admission_print_fee_bill=0 or  afo.early_admission_print_fee_bill is null )
				

				union

				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO') and af.form_status_stage_id = 2
				and af.offer_date >= curdate()
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1  )

				and ( afo.early_admission_signed_offer_letter=0 )
				and (afo.early_admission_offer_pack_handover=0)
				

			) as af 

			#Move to Procedure

			UNION
			select 3305 as form_status_id, 3305 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage 
			from ( select (af.id) as Form_id 
				
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')  
				and (afo.early_admission_offer_letter=1)
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1)
				and ( afo.early_admission_offer_pack_handover=1)
				

			) as af 

			# In EAO Procedure
			UNION
			select 3306 as form_status_id, 3306 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')

				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)

				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and af.form_status_stage_id = 2
				
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)
				

				and ( fbr.fee_bill_id is null) 
				and fb.bill_due_date >= curdate()
			
				
			

			) as af 
			#A level EAO waiting results
			UNION
			select 3307 as form_status_id, 3307 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no 
				AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')

				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)

				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO') 
				#and af.form_status_stage_id = 2
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)

				and ( fbr.fee_bill_id is not null) 

				



			) as af 

			# EAO  Currently in Followup
			UNION
			select 3308 as form_status_id, 3308 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
			

				
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')  and af.form_status_stage_id = 2
				and af.offer_date < curdate()
				and (afo.early_admission_offer_letter=0 or afo.early_admission_offer_letter is null)
				and ( afo.early_admission_print_fee_bill=0 or  afo.early_admission_print_fee_bill is null )
				

				union

				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO') and af.form_status_stage_id = 2
				and af.offer_date < curdate()
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1  )

				and ( afo.early_admission_signed_offer_letter=0 )
				and (afo.early_admission_offer_pack_handover=0)
			


			) as af 

 

			# Post Result Verification Approval
			UNION
			select 3309 as form_status_id, 3309 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')

				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)

				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)

				and ( fbr.fee_bill_id is not null) 
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				
				union 

				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) 
				and (af.form_discussion_criteria ='RAO') 
				and af.form_status_stage_id = 2 
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				
				
				) as af 


			
		UNION
			select 3310 as form_status_id, 3310 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no 
				AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')

				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)

				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and af.form_status_stage_id=2
				
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)
				
				and ( fbr.fee_bill_id is null) 
				and fb.bill_due_date < curdate()
			) as af 

			# Currently Extensions in EAO Preparations
			UNION
			select 3101 as form_status_id, 3101 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')  and af.form_status_stage_id = 10
				and af.offer_date >= curdate()
				and (afo.early_admission_offer_letter=0 or afo.early_admission_offer_letter is null)
				and ( afo.early_admission_print_fee_bill=0 or  afo.early_admission_print_fee_bill is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )

				
			) as af 

			# Overall Extensions at EAO Preparations
			UNION
			select 3102 as form_status_id, 3102 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				left join atif_gs_admission.log_form_status as ls
				on ls.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')  
				and (afo.early_admission_offer_letter=0 or afo.early_admission_offer_letter is null)
				and ( afo.early_admission_print_fee_bill=0 or  afo.early_admission_print_fee_bill is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and ls.new_form_status=5 and ls.new_form_stage = 10

				
			) as af 


			# Overall Not Interested at EAO Preparations
			UNION
			select 3103 as form_status_id, 3103 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				left join atif_gs_admission.log_form_status as ls
				on ls.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')  
				and (afo.early_admission_offer_letter=0 or afo.early_admission_offer_letter is null)
				and ( afo.early_admission_print_fee_bill=0 or  afo.early_admission_print_fee_bill is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and ls.new_form_status=5 and ls.new_form_stage = 7

				
			) as af 


			# Overall Extensions EAO Procedure fee bill extension
			UNION
			select 3104 as form_status_id, 3104 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join atif_gs_admission.log_form_status as ls	on ls.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and ls.new_form_status=5 
				and ls.new_form_stage = 10
			) as af 


			# Currently Extensions EAO Procedure fee bill extension
			UNION
			select 3105 as form_status_id, 3105 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				left join atif_gs_admission.log_form_status as ls	on ls.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and ( afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1 )
				and ( afo.early_admission_signed_offer_letter=1 )
				and ( afo.early_admission_offer_pack_handover=1 )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and af.form_status_stage_id=10
			) as af 



			# Move To Final Admission Offer
			UNION
			select 3106 as form_status_id, 3106 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no 
				AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')
				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and ( afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1 )
				and ( afo.early_admission_signed_offer_letter=1 )
				and ( afo.early_admission_offer_pack_handover=1 )
				and (afo.post_result_verification_approval = 1  )
				and ( fbr.fee_bill_id is not null) 
				and fbr.received_amount > 0
				
			) as af 



				# Currently Not Interested EAO Procedure 
			UNION
			select 3107 as form_status_id, 3107 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				left join atif_gs_admission.log_form_status as ls	on ls.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and ( afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1 )
				and ( afo.early_admission_signed_offer_letter=1 )
				and ( afo.early_admission_offer_pack_handover=1 )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and af.form_status_stage_id=7
			) as af 



			";
			
			
			
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





public function Break_Query( $thisQuery, $WhereFull = NULL )
{
	$thQuery = urldecode( $thisQuery );
	
	$Exp_Str = explode('Break_Query',$thQuery);
	$Exp_StrStr = 'Break_Query';
	$pos = strpos($thQuery, $Exp_StrStr);
	
	if ( $WhereFull != NULL  ) 
	{
		
		//$thisQuery = $thQuery;
		
		
			if( sizeof( $Exp_Str ) > 1 )
			{

				$First_Part = $Exp_Str[0];	
				$Secod_Part = $Exp_Str[1];	
				$First_Part .= " and $WhereFull ";
				$Secod_Part .= " and $WhereFull ";
				$thisQuery = $First_Part.$Secod_Part;
			}else
			{
				
				$First_Part = $Exp_Str[0];
				$First_Part .= " and $WhereFull ";
				$thisQuery = $First_Part;
			}
		
	
	
		
	} else
	{
		
		//$thisQuery = $thQuery;
		
		
		if( sizeof( $Exp_Str ) > 1 )
		{
			
			$First_Part = $Exp_Str[0];	
			$Secod_Part = $Exp_Str[1];	


			$thisQuery = $First_Part.$Secod_Part;
		}else
		{
			
			$First_Part = $Exp_Str[0];
			$thisQuery = $thQuery;
		}
			
			
		
	}
	
	
	/*if(!empty($Exp_Str) && ($WhereFull != NULL) )
	{
		if( sizeof( $Exp_Str ) > 1 )
		{
			$First_Part = $Exp_Str[0];
			$Secod_Part = $Exp_Str[1];	
			$First_Part .= " and $WhereFull ";
			$Secod_Part .= " and $WhereFull ";
			$thisQuery = $First_Part.$Secod_Part;
		}else
		{
			$First_Part = $Exp_Str[0];
			$First_Part .= " and $WhereFull ";
			$thisQuery = $First_Part;
		}
	}
	else
	{
		$thisQuery = $thQuery;
	}*/
		
	
		
		
		
	// echo $WhereFull; exit;
	 //echo $thisQuery; exit;
	return $thisQuery;
}

	public function getAdmissionList($StatusID, $StageID, $GradeID, $BatchID, $Gender, $thisQuery){
		$this->dbad = $this->load->database('gs_admission',TRUE);
		$JoinClause7744 = '';
		$QueryType = 0;
		$QueryType = 0;
		


		if($StatusID==7744 and $StageID==7744)
		{
			//$JoinClause7744 = "and lgs.new_form_status = 2 and lgs.new_form_stage not in (6,7,10,15,16,17) ";
			
			
		}else if($StatusID==6633 and $StageID==6633){
			//$JoinClause7744 = "and lgs.new_form_status = 4 and lgs.new_form_stage = 4";
		}else if($StatusID==9900 and $StageID==9900){
			$QueryType = 1;
		}else if($StatusID==9902 and $StageID==9902){
			$QueryType = 2;
		}else if($StatusID==9903 and $StageID==9903){
			$QueryType = 3;
		}else if($StatusID==1983 and $StageID==1983){
			$QueryType = 5;
		}else if($StatusID==9935 and $StageID==9935){
			$QueryType = 6;
		}else if($StatusID==9936 and $StageID==9936){
			$QueryType = 7;
		}else if($StatusID==9937 and $StageID==9937){
			$QueryType = 8;
		}else if($StatusID==9938 and $StageID==9938){
			$QueryType = 9;
		}else if($StatusID==9939 and $StageID==9939){
			$QueryType = 10;
		}else if($StatusID==9940 and $StageID==9940){
			$QueryType = 11;
		}else if($StatusID==9941 and $StageID==9941){
			$QueryType = 12;
		}else if($StatusID==9942 and $StageID==9942){
			$QueryType = 13;
		}else if($StatusID==9943 and $StageID==9943){
			$QueryType = 14;
		}else if($StatusID==9944 and $StageID==9944){
			$QueryType = 15;
		}else if($StatusID==9945 and $StageID==9945){
			$QueryType = 16;
		}else if($StatusID==9946 and $StageID==9946){
			$QueryType = 17;
		}
		else if($StatusID==9947 and $StageID==9947){
			$QueryType = 18;
		}
		else if($StatusID==9948 and $StageID==9948){
			$QueryType = 19;
		}
		elseif($StatusID==1808181 and $StageID==1808181)
		{
			$QueryType = 20;
		}elseif($StatusID==1808201 and $StageID==1808201)
		{
			$QueryType = 21;
		}elseif($StatusID==1808202 and $StageID==1808202)
		{
			$QueryType = 22;
		}elseif($StatusID==1808203 and $StageID==1808203)
		{
			$QueryType = 23;
		}elseif($StatusID==1808204 and $StageID==1808204)
		{
			$QueryType = 24;
		}elseif($StatusID==1808205 and $StageID==1808205)
		{
			$QueryType = 25;
		}elseif($StatusID==1808206 and $StageID==1808206)
		{
			$QueryType = 26;
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

		$thQuery = '';
		$Exp_Str = '';
		$First_Part = '';
		$Secod_Part = '';
		
					
		if($thisQuery == '')
		{
			if($WhereFull != '' && $StatusID != 9999)
			{
				$WhereFull .= ' AND ';
			}
			if($StatusID != '' && $StatusID != 9999)
			{
				$WhereFull .= $WhereStatus;
			}
			if($WhereFull != '' && $StageID != 9999)
			{
				$WhereFull .= ' AND ';
			}
			if($StageID != '' && $StageID != 9999)
			{
				$WhereFull .= $WhereStage;
			}

			if(($GradeID=='' || $GradeID=='All,') && ($BatchID=='' || $BatchID == 'Select Batch') && ($Gender=='' || $Gender == 'BOY,GIRL,'))
			{
				if($QueryType == 1){
					$query = "select * from atif_gs_admission.view_process_flow as af 
								left join atif_gs_admission.admission_form_offer as fo 
								on fo.admission_form_id = af.form_id
								where (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )"; 
					
				}else if($QueryType == 2){
					$query = "select * from atif_gs_admission.view_process_flow as af
						left join atif_gs_admission.log_form_status as lgs";
				}else if($QueryType == 3){
					$query = "
select af.*
from atif_gs_admission.log_form_status as ls
left join atif_gs_admission.view_process_flow as af
on af.id = ls.admission_form_id
where ls.new_form_status=2 and ls.new_form_stage=12
and ls.`type`='G'";
				}
				else if($QueryType == 5){
					
					
					
					$query = "select * from atif_gs_admission.view_process_flow as af
					
					
					left join atif_gs_admission.admission_form_offer as afo
						on afo.admission_form_id = af.id
					left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10
			
			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then afo.post_result_verification_approval=1 
				and afo.early_admission_signed_offer_letter=1
				else true
				end )

			";

						
						
				} 
				else if($QueryType == 6){
				$query = "select af.* 
				from
				atif_gs_admission.log_form_status as lgs
				Left Join atif_gs_admission.view_process_flow as af
				on af.id = lgs.admission_form_id 
				left join atif_gs_admission.admission_form_offer as fo  
				on fo.admission_form_id = af.form_id
				where (case 
					when (af.grade_id = 15 or af.grade_id=16) 
					then fo.post_result_verification_approval=1
					else true 
					end
				)"; 




				




				}
				
				else if($QueryType == 5){
					
					
					
					$query = "select * from atif_gs_admission.view_process_flow as af
					
					
					left join atif_gs_admission.admission_form_offer as afo
						on afo.admission_form_id = af.id
					left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10
			
			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
where 
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then afo.post_result_verification_approval=1 
				and afo.early_admission_signed_offer_letter=1
				else true
				end )
			";
						
						
				}
				else if($QueryType == 7){
				$query = "select * from atif_gs_admission.view_process_flow as af 
left join atif_gs_admission.log_form_status as lgs on lgs.admission_form_id = af.id ";

					
					
						
						
				}else if($QueryType == 8){
					
					$query = "select af.* From atif_gs_admission.log_form_status as ls 
					left join atif_gs_admission.view_process_flow as af 
					on af.id= ls.admission_form_id";
					


				}else if( $QueryType == 9 ){
					
					$query = "	
					select af.* from( 
					
					select af.*
			from atif_gs_admission.view_process_flow as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where
			af.form_status_id = 5 
			and( (fo.offer_letter=0)
			or (fo.fif_form=0)
			or (fo.print_fee_bill=0)
			or (fo.photo_token=0)
			or (fo.hand_book=0)
			)
			
				
			union all
			select af.*
			from atif_gs_admission.view_process_flow as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where
			af.form_status_id=5 
			and( (fo.offer_letter=1)
			or (fo.fif_form=1)
			or (fo.print_fee_bill=1)
			or (fo.photo_token=1)
			or (fo.hand_book=1)
			)
			and fo.signed_offer_letter=0 and fo.offer_pack_handover=0
			and af.offer_date >= curdate()
			 
			) as af";
					


				}else if($QueryType == 10)
				{
					$query = " select af.*
			from atif_gs_admission.view_process_flow as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id=5 
			and ( af.form_status_stage_id != 7)
			and( af.form_status_stage_id != 10 )
			and af.offer_date < curdate()
			and fo.offer_letter=1
			and fo.fif_form=1
			and fo.print_fee_bill=1
			and fo.photo_token=1
			and fo.hand_book=1
			and (fo.signed_offer_letter=0 and fo.offer_pack_handover=0) ";
			
				}else if($QueryType == 12)
				{
					 $query = " select * from atif_gs_admission.view_process_flow as af
where af.form_id in (
 
			select aaf.Form_id
			from (
			select (lgs.admission_form_id) as Form_id
			from atif_gs_admission.log_form_status as lgs
			where (  lgs.new_form_status=2 )
			and ( lgs.new_form_stage =7 or lgs.new_form_stage =10 or lgs.new_form_stage = 11 )
		

			UNION all
			select (aff.id) as Form_id from atif_gs_admission.admission_form as aff 
			where ( aff.form_status_id=2 and aff.form_assessment_date < curdate())
			and ( aff.form_status_stage_id not in (7,10,12))
		
			) as aaf
		)	 "; 
		
				}else if($QueryType == 13)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af
where af.form_id in (  select aaf.Form_id
			from (
			
			select (lgs.admission_form_id) as Form_id
			from atif_gs_admission.log_form_status as lgs
			where (  lgs.new_form_status=3 )
			and ( lgs.new_form_stage =5 or lgs.new_form_stage =7 or lgs.new_form_stage =10 or lgs.new_form_stage = 11 )
				group by lgs.admission_form_id 

			UNION all
			select  af.id  as Form_id  from atif_gs_admission.admission_form as af 
			where ( af.form_status_id=3 and af.form_discussion_date < curdate())
			and ( af.form_status_stage_id = 13  )
			group by af.id
			

			) as aaf )";
				}else if($QueryType == 16)
				{
				
				
				$query = "select * from atif_gs_admission.view_process_flow as af
				where af.form_id in (
				
				(select (af.id) as Form_id  
			from atif_gs_admission.admission_form as af 
			where af.form_status_id=4 and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17 ) 
					
			union 
			select (af.id) as Form_id 
			from atif_gs_admission.admission_form as af 
			where af.form_status_id=5 and af.form_status_stage_id=12) ) ";
				
				
				}else if($QueryType == 20)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af";
				}
				
				else{
					$query = "select * from atif_gs_admission.view_process_flow as af
					left join atif_gs_admission.log_form_status as lgs
						on lgs.admission_form_id = af.id ".$JoinClause7744."
					left join atif_gs_admission.admission_form_offer as afo
						on afo.admission_form_id = af.id
					left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10
			
			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id";
						
				}
				
			}else{
				
				if($QueryType == 1)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af 
					left join atif_gs_admission.log_form_status as lgs
					on lgs.admission_form_id = af.form_id 
					left join atif_gs_admission.admission_form_offer as fo 
					on fo.admission_form_id = af.form_id 
							
					where $WhereFull and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )"; 
						
				}else if($QueryType == 2){
					$query = "select * from atif_gs_admission.view_process_flow as af
						left join atif_gs_admission.log_form_status as lgs
							on lgs.admission_form_id = af.id 
						where $WhereFull ";
				}else if($QueryType == 3){
					$query = "
						select af.*
						from atif_gs_admission.log_form_status as ls
						left join atif_gs_admission.view_process_flow as af
						on af.id = ls.admission_form_id
						where $WhereFull ";
				}
				else if($QueryType == 5){
					
					
					
					$query = "select * from atif_gs_admission.view_process_flow as af
					
					
					left join atif_gs_admission.admission_form_offer as afo
						on afo.admission_form_id = af.id
					left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10
			
			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id 

			
			where ".$WhereFull. " 
			 
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then `afo`.`post_result_verification_approval`=1 
				and `afo.`early_admission_signed_offer_letter`=1
				else true
				end )";
						
						
				}
				
				else if($QueryType == 6){
				$query = "select af.* 
				from
				atif_gs_admission.log_form_status as lgs
				Left Join atif_gs_admission.view_process_flow as af
				on af.id = lgs.admission_form_id
				left join atif_gs_admission.admission_form_offer as fo  
				on fo.admission_form_id = af.form_id

				where $WhereFull and 
(
	case 
	when (af.grade_id = 15 or af.grade_id=16) 
	then fo.post_result_verification_approval=1
	else true 
	end
)"; 

				}
				
				else if($QueryType == 5){
					
					
					
					$query = "select * from atif_gs_admission.view_process_flow as af
					
					
					left join atif_gs_admission.admission_form_offer as afo
						on afo.admission_form_id = af.id
					left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10
			
			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			
						where ".$WhereFull . " 

			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then afo.post_result_verification_approval=1 
				and afo.early_admission_signed_offer_letter=1
				else true
				end )	";
						
						
				}
				else if($QueryType == 7){
				$query = "select * from atif_gs_admission.view_process_flow as af 
left join atif_gs_admission.log_form_status as lgs on lgs.admission_form_id = af.id 
where $WhereFull ";

					
					
						
						
				}else if($QueryType == 8){
					
					$query = "select af.* From atif_gs_admission.log_form_status as ls 
					left join atif_gs_admission.view_process_flow as af 
					on af.id= ls.admission_form_id
					where $WhereFull ";
					


				}else if($QueryType == 9){
					
					$query = "	
					select af.* from( 
					
					select af.*
			from atif_gs_admission.view_process_flow as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where
			af.form_status_id=5  and $WhereFull
			
			and( (fo.offer_letter=0)
			or (fo.fif_form=0)
			or (fo.print_fee_bill=0)
			or (fo.photo_token=0)
			or (fo.hand_book=0)
			)
			 
				
			union all
			select af.*
			from atif_gs_admission.view_process_flow as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where
			af.form_status_id=5  and $WhereFull
			and( (fo.offer_letter=1)
			or (fo.fif_form=1)
			or (fo.print_fee_bill=1)
			or (fo.photo_token=1)
			or (fo.hand_book=1)
			)
			and fo.signed_offer_letter=0 and fo.offer_pack_handover=0  
			
			and af.offer_date >= curdate()
			
			
			
			
			union all 
			select af.*
			from atif_gs_admission.view_process_flow as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where af.form_status_id >= 5 and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date >= curdate()
			
			) as af ";
					


				}else if($QueryType == 10)
				{
					$query = " select af.*
			from atif_gs_admission.view_process_flow as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id=5 
			and ( af.form_status_stage_id != 7)
			and( af.form_status_stage_id != 10 )
			and af.offer_date < curdate()
			and fo.offer_letter=1
			and fo.fif_form=1
			and fo.print_fee_bill=1
			and fo.photo_token=1
			and fo.hand_book=1
			and (fo.signed_offer_letter=0 and fo.offer_pack_handover=0)
			where $WhereFull "; 
			
				}else if($QueryType == 12)
				{
					 $query = " select * from atif_gs_admission.view_process_flow as af
where af.form_id in (
 
			select aaf.Form_id
			from (
			select (lgs.admission_form_id) as Form_id
			from atif_gs_admission.log_form_status as lgs
			where (  lgs.new_form_status=2 )
			and ( lgs.new_form_stage =7 or lgs.new_form_stage =10 or lgs.new_form_stage = 11 )
		

			UNION all
			select (aff.id) as Form_id from atif_gs_admission.admission_form as aff 
			where ( aff.form_status_id=2 and aff.form_assessment_date < curdate())
			and ( aff.form_status_stage_id not in (7,10,12))
		
			) as aaf
		)	 and $WhereFull "; 
		
				}else if($QueryType == 13)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af
where af.form_id in (  select aaf.Form_id
			from (
			
			select (lgs.admission_form_id) as Form_id
			from atif_gs_admission.log_form_status as lgs
			where (  lgs.new_form_status=3 )
			and ( lgs.new_form_stage =5 or lgs.new_form_stage =7 or lgs.new_form_stage =10 or lgs.new_form_stage = 11 )
				group by lgs.admission_form_id 

			UNION all
			select  af.id  as Form_id  from atif_gs_admission.admission_form as af 
			where ( af.form_status_id=3 and af.form_discussion_date < curdate())
			and ( af.form_status_stage_id = 13  )
			group by af.id
			

			) as aaf ) and $WhereFull ";
				}else if($QueryType == 16)
				{
				
				
				$query = "select * from atif_gs_admission.view_process_flow as af
				where af.form_id in (
				
				(select (af.id) as Form_id 
			from atif_gs_admission.admission_form as af 
			where af.form_status_id=4 and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17 ) and $WhereFull 
					
			union
			select (af.id) as Form_id 
			from atif_gs_admission.admission_form as af 
			where af.form_status_id=5 and af.form_status_stage_id=12 and $WhereFull)
			
				) ";
				
				
				}else if($QueryType == 20)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af";
				}else if($QueryType == 21)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af where $WhereFull";
				}else if($QueryType == 22)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af 
where ( af.form_status_id=1 and af.form_submission_date < curdate() 
				and af.form_assessment_date='0000-00-00')
				and ( af.form_status_stage_id not in (7,10))";
				}else if($QueryType == 23)
				{
					$query = "select *
			from atif_gs_admission.view_process_flow as af  
			where af.form_status_id=2 and ( af.form_assessment_date >= curdate()) and af.form_status_stage_id < 4";
				}else if($QueryType == 24)
				{
					$query = "select *
			from atif_gs_admission.view_process_flow as af   
			where af.form_id in ( select af.id
			 from atif_gs_admission.admission_form as af
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='RAO') 
				and af.form_status_stage_id != 12 )";

				}else if($QueryType == 25)
				{
					$query = "select *
			from atif_gs_admission.view_process_flow as af   
			where af.form_id in ( select af.id
			 from atif_gs_admission.admission_form as af
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO') 
				and af.form_status_stage_id != 12 )";
				}else if($QueryType == 26)
				{
					$query = "select *
			from atif_gs_admission.view_process_flow as af   
			where af.form_id in ( select af.id
			 from atif_gs_admission.admission_form as af
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO') 
				and af.form_status_stage_id != 12 )";
				}
				
				else{
				$query = "select * from atif_gs_admission.view_process_flow as af
						left join atif_gs_admission.log_form_status as lgs
							on lgs.admission_form_id = af.id ".$JoinClause7744."
						left join atif_gs_admission.admission_form_offer as afo
							on afo.admission_form_id = af.id
						left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10
			
			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where $WhereFull "; 
			
				}
			}
			
			
		}else{ // else query not empty

		
			if(($WhereFull == '' || $WhereGrade == ')') && $BatchID == ''){
				if($QueryType == 1)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af 
					left join atif_gs_admission.admission_form_offer as fo 
								on fo.admission_form_id = af.form_id
					where $thisQuery and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )";
					
				}else if($QueryType == 2)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af 
						left join atif_gs_admission.log_form_status as lgs 
						on lgs.admission_form_id = af.id  
						where $thisQuery ";
						
				}else if($QueryType == 3)
				{
					$query = " select af.* from atif_gs_admission.log_form_status as ls left join atif_gs_admission.view_process_flow as af 
					on af.id = ls.admission_form_id 
					where $thisQuery "; 

				}else if($QueryType == 6)
				{
					$query = " select af.* from atif_gs_admission.view_process_flow as af 
					left join atif_gs_admission.admission_form_offer as fo  
					on fo.admission_form_id = af.form_id
					where $thisQuery and 
(
	case 
	when (af.grade_id = 15 or af.grade_id=16) 
	then fo.post_result_verification_approval=1
	else true 
	end
)";  

									
				}
				
				else if($QueryType == 5){
					
					
					
					$query = "select af.* from atif_gs_admission.view_process_flow as af
where af.form_id in ( 


select (af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			
			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 

			and ( fbr.received_amount is null )
			and af.form_status_stage_id not in(6,7,8,9,10,12,13,14,15,16,17) 
			and fo.signed_offer_letter=1 and fo.offer_pack_handover=1
			
			and af.offer_date < curdate()
 
 
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 
				and fo.early_admission_signed_offer_letter=1
				else true
				end )


				) ";
						
						
				}
				else if($QueryType == 7)
				{
				
				/*echo $query = "select * from atif_gs_admission.view_process_flow as af 
left join atif_gs_admission.log_form_status as lgs on lgs.admission_form_id = af.id 
where $thisQuery "; exit;*/

$query = "select * from atif_gs_admission.view_process_flow as af 
where af.form_id in( 
select (lgs.admission_form_id) as IDs 
from atif_gs_admission.log_form_status as lgs 
where lgs.new_form_status = 1  
and (  lgs.new_form_stage =7 or lgs.new_form_stage =10) 
UNION all  
select (af.id) as IDs from atif_gs_admission.admission_form as af  
where ( af.form_status_id=1 and af.form_submission_date < curdate() and af.form_assessment_date='0000-00-00') 
#and ( af.form_status_stage_id in (7,10))				
) ";



					
					
						
						
				}else if($QueryType == 8)
				{
					
					$query = "select af.* From atif_gs_admission.log_form_status as ls 
					left join atif_gs_admission.view_process_flow as af 
					on af.id= ls.admission_form_id
					where $thisQuery ";
					


				}else if($QueryType == 9){
					
					$query = "	
					
					select af.* from atif_gs_admission.view_process_flow as af
					
					where af.form_id in (
					
			
			select (af.id) as id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where
			af.form_status_id = 5 and $thisQuery
			and( (fo.offer_letter=0)
			or (fo.fif_form=0)
			or (fo.print_fee_bill=0)
			or (fo.photo_token=0)
			or (fo.hand_book=0)
			)
			
			union all
			select (af.id) as id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where
			af.form_status_id=5 and $thisQuery
			and( (fo.offer_letter=1)
			or (fo.fif_form=1)
			or (fo.print_fee_bill=1)
			or (fo.photo_token=1)
			or (fo.hand_book=1)
			)
			and fo.signed_offer_letter=0 and fo.offer_pack_handover=0
			
			
			
			union all 
			select af.id as id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where af.form_status_id = 5  
			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date >= curdate()
			
			
			
		
		
					) "; 
					 
					


				}else if($QueryType == 10)
				{
				

			
			
			$query = "	
					
					select af.* from atif_gs_admission.view_process_flow as af
					
					where af.form_id in (
					
			select ( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id=5  and $thisQuery
			
			and fo.offer_letter=1
			and fo.fif_form=1
			and fo.print_fee_bill=1
			and fo.photo_token=1
			and fo.hand_book=1
			and (fo.signed_offer_letter=0 or fo.offer_pack_handover=0) 
			
			
			union all
			
			select ( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id=5  and $thisQuery  
			and fo.offer_letter=0
			and fo.fif_form=0
			and fo.print_fee_bill=0
			and fo.photo_token=0
			and fo.hand_book=0
			and (fo.signed_offer_letter=0 or fo.offer_pack_handover=0) 
			
			
			
			union all 
				select (af.id) as id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where af.form_status_id >= 5 and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date < curdate() 

			
			
			
			)
			
			AND af.form_no NOT IN 
	( SELECT af.form_no
	FROM atif_gs_admission.view_process_flow AS af
	WHERE af.form_id IN (
	SELECT (lgs.admission_form_id) AS Form_id
	FROM atif_gs_admission.log_form_status AS lgs
	LEFT JOIN atif_gs_admission.admission_form_offer AS fo ON (fo.admission_form_id = lgs.admission_form_id)
	WHERE (lgs.new_form_stage != 12) AND (lgs.new_form_stage != 2) AND (lgs.new_form_stage != 1) AND (lgs.new_form_stage != 3) 
	AND (lgs.new_form_stage != 16) AND (lgs.new_form_stage != 8) AND (lgs.new_form_status = 5) AND fo.signed_offer_letter=1 
	AND fo.offer_pack_handover=1 AND (fo.completed_fif_form=1 OR fo.signed_hand_book=1)
	and $thisQuery
	GROUP BY lgs.admission_form_id 
	
	
	UNION
	SELECT (af.id) AS Form_id
	FROM atif_gs_admission.admission_form AS af
	LEFT JOIN atif_gs_admission.admission_form_offer AS fo ON fo.admission_form_id = af.id
	LEFT JOIN atif_fee_student.fee_bill AS fb ON af.form_no = MID(fb.gb_id, 6, 4) AND fb.academic_session_id >= 11 AND fb.record_deleted = 0 AND fb.gb_id LIKE '18%' AND LENGTH(fb.gb_id) = 10 AND
	LEFT(fb.gb_id, 2) != '17'
	LEFT JOIN atif_fee_student.fee_bill_received AS fbr ON fbr.fee_bill_id = fb.id
	WHERE af.form_status_id >= 5 AND (fbr.received_amount IS NULL) 
	AND (fo.signed_offer_letter=1 OR fo.offer_pack_handover=1)
	AND (fo.completed_fif_form=1 OR fo.signed_hand_book=1)
	AND af.offer_date < CURDATE()
	and $thisQuery
	
	
	)
	)
			
			
			";




			
				}else if($QueryType == 12)
				{
				/*$query = " select * from atif_gs_admission.view_process_flow as af
where af.form_id in (
 
			select aaf.Form_id
			from (
			select (lgs.admission_form_id) as Form_id
			from atif_gs_admission.log_form_status as lgs
			where (  lgs.new_form_status=2 )
			and ( lgs.new_form_stage =7 or lgs.new_form_stage =10 or lgs.new_form_stage = 11 )
		

			UNION all
			select (aff.id) as Form_id from atif_gs_admission.admission_form as aff 
			where ( aff.form_status_id=2 and aff.form_assessment_date < curdate())
			and ( aff.form_status_stage_id < 5 )
		
			) as aaf
		)	 and $thisQuery "; */
		
		$query = "select * from ( 
		select  
count(lgs.id) as CountTotal,
af.*
from atif_gs_admission.log_form_status as lgs
left join atif_gs_admission.view_process_flow as af
on af.form_id = lgs.admission_form_id
where ( lgs.new_form_status=2 )
and ( lgs.new_form_stage =7 or lgs.new_form_stage =10  ) group by lgs.id


union all
select 
count(af.form_id) as CountTotal,
af.*
from atif_gs_admission.view_process_flow as af 

where ( af.form_status_id=2 and af.form_assessment_date < curdate() 
			and af.form_assessment_date != '2001-01-01' 
			and ( af.form_status_stage_id < 5 ) 
			and af.form_discussion_date='0000-00-00' ) group by af.id
			
 ) as af "; 
		
				}else if($QueryType == 13)
				{
				
				$query = "select * from atif_gs_admission.view_process_flow as af
where af.form_id in (  
			
			
			
			
			select (lgs.admission_form_id) as IDs
			from atif_gs_admission.log_form_status as lgs
			where (  lgs.new_form_status=3 ) 
			and (  lgs.new_form_stage =7 or lgs.new_form_stage =10 )
			

			UNION all
				select  (af.id) as IDs
				from atif_gs_admission.admission_form as af 
							where ( af.form_status_id=3 ) 
							and ( af.form_status_stage_id not in (4,6,7,8,10,15,16,17))
							and af.form_discussion_date != '0000-00-00'
							and af.form_discussion_date < curdate()
							
							
			

			)   ";
			
				}else if($QueryType == 14)
				{
					$query = "  select af.*
			from atif_gs_admission.view_process_flow as af
			
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			
			left join atif_fee_student.fee_bill as fb
			on (SUBSTR(fb.gb_id, 6, 4) = af.form_no) and fb.academic_session_id >= 11 
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10
			
			left join atif_fee_student.fee_bill_received as fbr
			on fbr.fee_bill_id = fb.id
			
			where 
			af.form_status_id=5 
			and ( af.form_status_stage_id = 1 or af.form_status_stage_id = 3  )
			and fo.offer_letter=1
			and fo.fif_form=1
			and fo.print_fee_bill=1
			and fo.photo_token=1
			and fo.hand_book=1
			and fo.signed_offer_letter=1
			and fo.offer_pack_handover=1
			and af.offer_date >= curdate()
			and $thisQuery";
				}else if($QueryType == 15)
				{
					
				$thisQuery = $this->Break_Query($thisQuery, $WhereFull=NULL);
				
				$query = "select * from atif_gs_admission.view_process_flow as af where af.form_id in (".$thisQuery.") ";
				
				
				}else if($QueryType == 16)
				{
				
				
				$query = "select * from atif_gs_admission.view_process_flow as af
				where af.form_id in (
				
				select (af.id) as Form_id 
			from atif_gs_admission.admission_form as af 
			where af.form_status_id=4 and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17 ) and $WhereFull and $thisQuery
					
			union all
			select (af.id) as Form_id 
			from atif_gs_admission.admission_form as af 
			where af.form_status_id=5 and af.form_status_stage_id=12 and $WhereFull and $thisQuery
			
				) ";
				
				
				}
				else if($QueryType == 17)
				{
				

			
			
			$query = "	
					
					select af.* from atif_gs_admission.view_process_flow as af
					
					where af.form_id in (
					
			select ( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id = 5 
			and ( af.form_status_stage_id != 7)
			and( af.form_status_stage_id != 10 )
			and( af.form_status_stage_id != 12 )
			and af.offer_date < curdate()
			and (fo.signed_offer_letter=0 or fo.offer_pack_handover=0)
			and (case when (af.grade_id = 15 or af.grade_id=16) then fo.post_result_verification_approval=1 and fo.early_admission_offer_pack_handover=1
			and fo.early_admission_offer_letter=1
				else true end )
						
			union all 
			select ( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 
			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date < curdate()
			and (case when (af.grade_id = 15 or af.grade_id=16) then fo.post_result_verification_approval=1 and fo.early_admission_offer_pack_handover=1
			and fo.early_admission_offer_letter=1
				else true end )

			
			
			
			)";




			
				}else if($QueryType == 18){
					
				$query = "	
					
					select af.* from atif_gs_admission.view_process_flow as af
					
					where af.form_id in (
				
					
					select ( lgs.admission_form_id) as Form_id
					from atif_gs_admission.log_form_status as lgs
					left join atif_gs_admission.admission_form_offer as fo
					on fo.admission_form_id = lgs.admission_form_id
					
					where lgs.new_form_status=5 
					and ( lgs.old_form_stage <= 3 )
					and ( lgs.new_form_stage=7 or lgs.new_form_stage=10 or lgs.new_form_stage=11 ) 
					and ( fo.signed_offer_letter=0)
					and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
					
					
				
				
				
				union
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = af.id
				
				
				where 
				af.form_status_id=5 
				
				and af.offer_date < curdate()
			
				and( (fo.offer_letter=1)
				or (fo.fif_form=1)
				or (fo.print_fee_bill=1)
				or (fo.photo_token=1)
				or (fo.hand_book=1)
				)
				and (fo.signed_offer_letter=0 and fo.offer_pack_handover=0) and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
				
				
				
			union  
			select ( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 

			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date < curdate()
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
					
					)";
				}else if($QueryType == 19){
					
					$query = "select af.* from atif_gs_admission.view_process_flow as af
					where af.form_id in ( 
					select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')

				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)

				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)

				and ( fbr.fee_bill_id is not null) 
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				
				union 

				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) 
				and (af.form_discussion_criteria ='RAO') 
				and af.form_status_stage_id = 2 
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )


					)";
				}else if($QueryType == 20)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af";
				}else if($QueryType == 21)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af 
where (af.form_status_id=1) and ( af.form_status_stage_id <= 3 ) and (af.form_submission_date >= curdate()) 
";
				}else if($QueryType == 22)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af 
	where ( af.form_status_id=1 and af.form_submission_date < curdate() 
				and af.form_assessment_date='0000-00-00')
				and ( af.form_status_stage_id not in (7,10))
";
				}else if($QueryType == 23)
				{
					$query = "select *
			from atif_gs_admission.view_process_flow as af  
			where af.form_status_id=2 and ( af.form_assessment_date >= curdate()) and af.form_status_stage_id < 4";
				}else if($QueryType == 24)
				{
					$query = "select *
			from atif_gs_admission.view_process_flow as af   
			where af.form_id in ( select af.id
			 from atif_gs_admission.admission_form as af
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='RAO') 
				and af.form_status_stage_id != 12 )";
				}else if($QueryType == 25)
				{
					$query = "select *
			from atif_gs_admission.view_process_flow as af   
			where af.form_id in ( select af.id
			 from atif_gs_admission.admission_form as af
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO') 
				and af.form_status_stage_id != 12 )";
				}		
				
				else{
					
					//   with out filter set follow up, not interested
					
					$query = "select af.* from atif_gs_admission.view_process_flow as af
					
						left join atif_gs_admission.log_form_status as lgs
							on lgs.admission_form_id = af.id ".$JoinClause7744."
							
						left join atif_gs_admission.admission_form_offer as afo
							on afo.admission_form_id = af.id
						left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10 
			
			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id 
			
			
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
						left join atif_gs_admission.admission_form_offer as fo 
						on fo.admission_form_id = af.form_id
						where $WhereFull and $thisQuery 
						and (  case 
						when (af.grade_id = 15 or af.grade_id=16)
						then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
						else true
						end )"; 
						
				}else if($QueryType == 3){
					$query = "
							
select af.*
from atif_gs_admission.log_form_status as ls
left join atif_gs_admission.view_process_flow as af
on af.id = ls.admission_form_id
where $WhereFull and $thisQuery "; 
						
						
				}else if($QueryType == 6){
				/*$query = "select af.* 
				from
				atif_gs_admission.log_form_status as lgs Left Join atif_gs_admission.view_process_flow as af on af.id = lgs.admission_form_id
							
					where $WhereFull and $thisQuery ";  */
					
					$query = " select af.* from atif_gs_admission.view_process_flow as af 
					left join atif_gs_admission.admission_form_offer as fo  
					on fo.admission_form_id = af.form_id
					where $WhereFull and $thisQuery and 
(
	case 
	when (af.grade_id = 15 or af.grade_id=16) 
	then fo.post_result_verification_approval=1
	else true 
	end
)";  



					
				}
				
				else if($QueryType == 5){
					
					
					
					$query = "select af.* from atif_gs_admission.view_process_flow as af
where af.form_id in ( 






select (af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			
			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 and $WhereFull

			and ( fbr.received_amount is null )
			and af.form_status_stage_id not in(6,7,8,9,10,12,13,14,15,16,17) 
			and fo.signed_offer_letter=1 and fo.offer_pack_handover=1
			
			and af.offer_date < curdate()

			 
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 
				and fo.early_admission_signed_offer_letter=1
				else true
				end )

			
			
				)";
						
						
				}
				else if($QueryType == 7){
				/*$query = "select * from atif_gs_admission.view_process_flow as af 
left join atif_gs_admission.log_form_status as lgs on lgs.admission_form_id = af.id 
where $WhereFull and $thisQuery ";*/

					
					
					$query = "select * from atif_gs_admission.view_process_flow as af 
where af.form_id in( 
select (lgs.admission_form_id) as IDs 
from atif_gs_admission.log_form_status as lgs 
left join atif_gs_admission.admission_form as af  
on af.id = lgs.admission_form_id
where lgs.new_form_status = 1  and $WhereFull		
and (  lgs.new_form_stage =7 or lgs.new_form_stage =10) 
UNION all  
select (af.id) as IDs from atif_gs_admission.admission_form as af  
where ( af.form_status_id=1 and af.form_submission_date < curdate() and af.form_assessment_date='0000-00-00') 
#and ( af.form_status_stage_id in (7,10)) 
and $WhereFull		
) ";

						
						
				}else if($QueryType == 8){
					
					$query = "select af.* From atif_gs_admission.log_form_status as ls 
					left join atif_gs_admission.view_process_flow as af 
					on af.id= ls.admission_form_id
					where $WhereFull and $thisQuery ";
					


				}else if($QueryType == 9){
					
			
			
			
			 $query = "	
					
					select af.* from atif_gs_admission.view_process_flow as af
					
					where af.form_id in (
					
			
			select (af.id) as id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where
			af.form_status_id = 5 and $WhereFull 
			and af.form_status_stage_id < 4	
			and af.offer_date >= curdate()
			
			and( (fo.offer_letter=0)
			or (fo.fif_form=0)
			or (fo.print_fee_bill=0)
			or (fo.photo_token=0)
			or (fo.hand_book=0)
			)
			
			union all
			select (af.id) as id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where
			af.form_status_id=5 and $WhereFull 
			
			and af.form_status_stage_id < 4	
			and af.offer_date >= curdate()
			
			and( (fo.offer_letter=1)
			or (fo.fif_form=1)
			or (fo.print_fee_bill=1)
			or (fo.photo_token=1)
			or (fo.hand_book=1)
			)
			and fo.signed_offer_letter=0 and fo.offer_pack_handover=0
			
			
			union all 
			select af.id as id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where af.form_status_id = 5 
			and $WhereFull 
			
			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date >= curdate()
			
			
		
		
					) ";
					
					


				}else if($QueryType == 10)
				{
					
				$query = "	
					
					select af.* from atif_gs_admission.view_process_flow as af
					
					where af.form_id in (
					
			select ( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id=5  and $WhereFull 
			
			and fo.offer_letter=1
			and fo.fif_form=1
			and fo.print_fee_bill=1
			and fo.photo_token=1
			and fo.hand_book=1
			and (fo.signed_offer_letter=0 or fo.offer_pack_handover=0) 
			
			
			union all
			
			select ( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id=5  and $WhereFull
			and fo.offer_letter=0
			and fo.fif_form=0
			and fo.print_fee_bill=0
			and fo.photo_token=0
			and fo.hand_book=0
			and (fo.signed_offer_letter=0 or fo.offer_pack_handover=0) 
			
			
			
			union all 
			select (af.id) as id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where af.form_status_id >= 5 and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date < curdate() and $WhereFull
			
			union all 
			select ( gg.Form_id) as Form_id
				from
				(
					select ( lgs.admission_form_id) as Form_id
					from atif_gs_admission.log_form_status as lgs
					left join atif_gs_admission.admission_form as af
					on af.id = lgs.admission_form_id
					where lgs.new_form_status=5 
					and ( lgs.old_form_stage <= 3 )
					and ( lgs.new_form_stage=7 or lgs.new_form_stage=10 or lgs.new_form_stage=11 and $WhereFull ) group by lgs.admission_form_id
				) as gg
				
				
				
			

			
			
			
			)
			
			AND af.form_no NOT IN 
	( SELECT af.form_no
	FROM atif_gs_admission.view_process_flow AS af
	WHERE af.form_id IN (
	SELECT (lgs.admission_form_id) AS Form_id
	FROM atif_gs_admission.log_form_status AS lgs
	LEFT JOIN atif_gs_admission.admission_form_offer AS fo ON (fo.admission_form_id = lgs.admission_form_id)
	WHERE (lgs.new_form_stage != 12) AND (lgs.new_form_stage != 2) AND (lgs.new_form_stage != 1) AND (lgs.new_form_stage != 3) 
	AND (lgs.new_form_stage != 16) AND (lgs.new_form_stage != 8) AND (lgs.new_form_status = 5) AND fo.signed_offer_letter=1 
	AND fo.offer_pack_handover=1 AND (fo.completed_fif_form=1 OR fo.signed_hand_book=1)
	and $WhereFull
	GROUP BY lgs.admission_form_id 
	
	
	UNION
	SELECT (af.id) AS Form_id
	FROM atif_gs_admission.admission_form AS af
	LEFT JOIN atif_gs_admission.admission_form_offer AS fo ON fo.admission_form_id = af.id
	LEFT JOIN atif_fee_student.fee_bill AS fb ON af.form_no = MID(fb.gb_id, 6, 4) AND fb.academic_session_id >= 11 AND fb.record_deleted = 0 AND fb.gb_id LIKE '18%' AND LENGTH(fb.gb_id) = 10 AND
	LEFT(fb.gb_id, 2) != '17'
	LEFT JOIN atif_fee_student.fee_bill_received AS fbr ON fbr.fee_bill_id = fb.id
	WHERE af.form_status_id >= 5 AND (fbr.received_amount IS NULL) 
	AND (fo.signed_offer_letter=1 OR fo.offer_pack_handover=1)
	AND (fo.completed_fif_form=1 OR fo.signed_hand_book=1)
	AND af.offer_date < CURDATE()
	and $WhereFull
	
	
	)
	)
			
			
			
			
			";
			
			
			
				}else if($QueryType == 12)
				{
					/* $query = " select * from atif_gs_admission.view_process_flow as af
where af.form_id in (
 
			select aaf.Form_id
			from (
			select (lgs.admission_form_id) as Form_id
			from atif_gs_admission.log_form_status as lgs
			where (  lgs.new_form_status=2 )
			and ( lgs.new_form_stage =7 or lgs.new_form_stage =10 or lgs.new_form_stage = 11 )
		

			UNION all
			select (aff.id) as Form_id from atif_gs_admission.admission_form as aff 
			where ( aff.form_status_id=2 and aff.form_assessment_date < curdate())
			and ( aff.form_status_stage_id < 5 )
		
			) as aaf
		)	 and $WhereFull and $thisQuery "; */
		
		
		$query = "select * from ( 
		select  
count(lgs.id) as CountTotal,
af.*
from atif_gs_admission.log_form_status as lgs
left join atif_gs_admission.view_process_flow as af
on af.form_id = lgs.admission_form_id
where ( lgs.new_form_status=2 ) and $WhereFull
and ( lgs.new_form_stage =7 or lgs.new_form_stage =10  ) group by lgs.id


union all
select 
count(af.form_id) as CountTotal,
af.*
from atif_gs_admission.view_process_flow as af 

where ( af.form_status_id=2 and af.form_assessment_date < curdate()  and $WhereFull
			and af.form_assessment_date != '2001-01-01' 
			and ( af.form_status_stage_id < 5 ) 
			and af.form_discussion_date='0000-00-00' ) group by af.id
			
 ) as af "; 
		
		
		
		


		
				}else if($QueryType == 13)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af
where af.form_id in (  
			
			
			
			
			select (lgs.admission_form_id) as IDs
			from atif_gs_admission.log_form_status as lgs
			where (  lgs.new_form_status=3 ) 
			and (  lgs.new_form_stage =7 or lgs.new_form_stage =10 )
			

			UNION all
				select  (af.id) as IDs
				from atif_gs_admission.admission_form as af 
							where ( af.form_status_id=3 ) 
							and ( af.form_status_stage_id not in (4,6,7,8,10,15,16,17))
							and af.form_discussion_date != '0000-00-00'
							and af.form_discussion_date < curdate()
							
							
			

			)  and $WhereFull and $thisQuery ";
			
				}else if($QueryType == 14)
				{
					$query = " select af.*
			from atif_gs_admission.view_process_flow as af
			
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			
			left join atif_fee_student.fee_bill as fb
			on (SUBSTR(fb.gb_id, 6, 4) = af.form_no) and fb.academic_session_id >= 11 
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10
			
			left join atif_fee_student.fee_bill_received as fbr
			on fbr.fee_bill_id = fb.id
			
			where 
			af.form_status_id=5 
			and ( af.form_status_stage_id = 1 or af.form_status_stage_id = 3  )
			and fo.offer_letter=1
			and fo.fif_form=1
			and fo.print_fee_bill=1
			and fo.photo_token=1
			and fo.hand_book=1
			and fo.signed_offer_letter=1
			and fo.offer_pack_handover=0
			and af.offer_date > curdate()
					
				and $WhereFull and $thisQuery ";
				}else if($QueryType == 15)
				{
					$thisQuery = $this->Break_Query($thisQuery, $WhereFull);
					#echo $thisQuery; exit;
					$query = "select * from atif_gs_admission.view_process_flow as af where af.form_id in (".$thisQuery.")  "; 
					
					
				}else if($QueryType == 16)
				{
				
					$query = "select * from atif_gs_admission.view_process_flow as af
				where af.form_id in (
				
				select (af.id) as Form_id 
			from atif_gs_admission.admission_form as af 
			where af.form_status_id=4 and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17 ) and $WhereFull and $thisQuery
					
			union all
			select (af.id) as Form_id 
			from atif_gs_admission.admission_form as af 
			where af.form_status_id=5 and af.form_status_stage_id=12 and $WhereFull and $thisQuery
			
				) ";
				}else if($QueryType == 17)
				{
				

			
			
			$query = "	
			
			
			
			
					select af.* from atif_gs_admission.view_process_flow as af
					
					where af.form_id in (
					


			select ( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id = 5 
			and ( af.form_status_stage_id != 7)
			and( af.form_status_stage_id != 10 )
			and( af.form_status_stage_id != 12 )
			and af.offer_date < curdate()
			and (case when (af.grade_id = 15 or af.grade_id=16) then fo.post_result_verification_approval=1 and fo.early_admission_offer_pack_handover=1
			and fo.early_admission_offer_letter=1
				else true end )
			and (fo.signed_offer_letter=0 or fo.offer_pack_handover=0) and $WhereFull
			
			
			
			union all 
			select ( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 

			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and (case when (af.grade_id = 15 or af.grade_id=16) then fo.post_result_verification_approval=1 and fo.early_admission_offer_pack_handover=1
			and fo.early_admission_offer_letter=1
				else true end )
			and af.offer_date < curdate() and $WhereFull
			
			)";




			
				}else if($QueryType == 18){
					
					 $query = "	
					
					select af.* from atif_gs_admission.view_process_flow as af
					
					where af.form_id in (
				
					
					select ( lgs.admission_form_id) as Form_id
					from atif_gs_admission.log_form_status as lgs
					left join atif_gs_admission.admission_form_offer as fo
					on fo.admission_form_id = lgs.admission_form_id
					
					
					left join atif_gs_admission.admission_form as af
					on af.id=fo.admission_form_id
					
					
					
					where lgs.new_form_status=5 and $WhereFull
					and ( lgs.old_form_stage <= 3 )
					and ( lgs.new_form_stage=7 or lgs.new_form_stage=10 or lgs.new_form_stage=11 ) 
					and ( fo.signed_offer_letter=0)
					and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
					
					
					
				
				
				
				union
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = af.id
				
				
				where 
				af.form_status_id=5 and $WhereFull
				
				and af.offer_date < curdate()
			
				and( (fo.offer_letter=1)
				or (fo.fif_form=1)
				or (fo.print_fee_bill=1)
				or (fo.photo_token=1)
				or (fo.hand_book=1)
				)
				and (fo.signed_offer_letter=0 and fo.offer_pack_handover=0)
				and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
				
				
				
			union  
			select ( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 and $WhereFull

			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date < curdate()
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
					
					)";
					
					
					
					
				}else if($QueryType == 19){
					
					 $query = "select af.* from atif_gs_admission.view_process_flow as af
					where af.form_id in ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')

				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)

				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)

				and ( fbr.fee_bill_id is not null) 
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				
				union 

				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) 
				and (af.form_discussion_criteria ='RAO') 
				and af.form_status_stage_id = 2 
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )



					)"; 
				}else if($QueryType == 20)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af";
				}else if($QueryType == 21)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af 
where (af.form_status_id=1) and ( af.form_status_stage_id <= 3 ) and (af.form_submission_date >= curdate() 	)  and $WhereFull
";
				}else if($QueryType == 22)
				{
					$query = "select * from atif_gs_admission.view_process_flow as af 
where ( af.form_status_id=1 and af.form_submission_date < curdate() 
				and af.form_assessment_date='0000-00-00')
				and ( af.form_status_stage_id not in (7,10)) and $WhereFull";
				}else if($QueryType == 23)
				{
					$query = "select *
			from atif_gs_admission.view_process_flow as af  
			where af.form_status_id=2 and ( af.form_assessment_date >= curdate()) and af.form_status_stage_id < 4 and $WhereFull";
				}else if($QueryType == 24)
				{
					$query = " select *
			from atif_gs_admission.view_process_flow as af   
			where af.form_id in ( select af.id
			 from atif_gs_admission.admission_form as af
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='RAO') 
				and af.form_status_stage_id != 12 ) and $WhereFull";
				}else if($QueryType == 25)
				{
					$query = " select *
			from atif_gs_admission.view_process_flow as af   
			where af.form_id in ( select af.id
			 from atif_gs_admission.admission_form as af
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO') 
				and af.form_status_stage_id != 12 ) and $WhereFull";
				}			
				
				
				
				else{
					
				if( $QueryType2=1){
					
					// Follow up not show up in assessment
					$query = "select * from atif_gs_admission.view_process_flow as af 
					left join atif_gs_admission.log_form_status as lgs
					on lgs.admission_form_id = af.form_id 
					
					left join atif_gs_admission.admission_form_offer as afo
					on afo.admission_form_id = af.form_id 
					
					
					where $WhereFull and $thisQuery "; 
						
				}else{
					$query = "select * from atif_gs_admission.view_process_flow as af
					left join atif_gs_admission.log_form_status as lgs
					on lgs.admission_form_id = af.id ".$JoinClause7744."
					
					left join atif_gs_admission.admission_form_offer as afo
					on afo.admission_form_id = af.id 
					
					left JOIN  atif_fee_student.fee_bill as fb
					ON af.form_no = mid(fb.gb_id, 6, 4)
					AND fb.academic_session_id >= 11
					AND fb.record_deleted = 0
					AND LENGTH(fb.gb_id) = 10
					
					left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id					
					where $WhereFull and $thisQuery "; 
				}
					
				
			
			
					
				}		
			}			
		}
		

		
        


		//$query .= " group by af.id order by af.grade_id, call_name";
		$query .= " order by af.grade_id, call_name";

		#print_r($query); exit;
		
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

			UNION # Waiting for Submission
			select 9988 as form_status_id, 9988 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id=1) and ( af.form_status_stage_id <= 3 ) and (af.form_submission_date >= curdate())
			
			UNION 
			select 9981 as form_status_id, 9981 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id=1) and ( af.form_status_stage_id <= 3 ) and (af.form_submission_date >= curdate())
			and from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) 
			

			

			# currently in submission extension
			UNION 
			select 9977 as form_status_id, 9977 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af where af.form_status_id = 1 and af.form_status_stage_id = 10 
			
			# currently in submission extension ( red )
			union
			select 9978 as form_status_id, 9978 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af where af.form_status_id = 1 and af.form_status_stage_id = 10 
			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			

			#Admission forms submitted
			UNION	
			select 8888 as form_status_id, 8888 as form_status_stage_id, count(id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af where af.form_status_id >= 2
			
			
			# To Be submission followed up
			UNION 
			select 
			8899 as form_status_id, 8899 as form_status_stage_id, sum(IDs) as num, '' as status, '' as stage
			from (
				select count(lgs.id) as IDs
				from atif_gs_admission.log_form_status as lgs
				where (  lgs.new_form_status = 1 )
				and (  lgs.new_form_stage =7 or lgs.new_form_stage =10  )
				UNION all
				select count(af.id) as IDs from atif_gs_admission.admission_form as af 
				where ( af.form_status_id=1 and af.form_submission_date < curdate() and af.form_assessment_date='0000-00-00')
				and ( af.form_status_stage_id not in (7,10))
			) as af


			



			#Total Submission Overall Extensions
			UNION 
			select 8877 as form_status_id, 8877 as form_status_stage_id, count(*) as num, '' as status, '' as stage
from atif_gs_admission.log_form_status as lgs
where lgs.new_form_status=1 and lgs.new_form_stage=10 


			

			# Currently in submission follow up
			UNION 
			select 8866 as form_status_id, 8866 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from (select af.* from atif_gs_admission.admission_form as af 
				where ( af.form_status_id=1 and af.form_submission_date < curdate() and af.form_assessment_date='0000-00-00')
				and ( af.form_status_stage_id not in (7,10))
			) as af

			UNION
			select 8867 as form_status_id, 8867 as form_status_stage_id, count(af.form_id)  as num, '' as status, '' as stage 
			from ( 
			select af.id as form_id
			from atif_gs_admission.admission_form as af
			where ( af.form_status_id=1 and af.form_submission_date < curdate() and af.form_assessment_date='0000-00-00' 
			and ( from_unixtime( af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) ) )
			and ( af.form_status_stage_id not in (7,10)) 
			) as af
			
			

			
			
			
			# Form Submission Interested
			UNION 
			select 8855 as form_status_id, 8855 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from atif_gs_admission.log_form_status as lgs 
			where lgs.new_form_stage=7 
			and lgs.new_form_status=1 
			

			# Waiting/Extensions for Form assessment
			UNION
			select 8844 as form_status_id, 8844 as form_status_stage_id,  count(*) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 2
			
			# Waiting/Extensions for Form assessment ( Red )
			UNION
			select 8841 as form_status_id, 8841 as form_status_stage_id,  count(*) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 2
			and ( from_unixtime( af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) ) 


			# Form Submission Currently in To Be Allocate
			UNION
select 7799 as form_status_id, 7799 as form_status_stage_id, count( af.id ) as num, '' as status, '' as stage
 			From atif_gs_admission.admission_form as af
				
				Where ( 
				af.form_status_id=2 and 
				af.form_assessment_date = '2001-01-01')

			
			
			# Form Submission To Be Allocate more than 2 days 
			UNION
			select 77099 as form_status_id, 77099 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			From atif_gs_admission.admission_form as af
				Where  
				af.form_status_id=2 and 
				af.form_assessment_date = '2001-01-01'
				and (from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) ) 
			
			
			
			

			# Form Submission To Be Allocate Overall
			UNION
			select 7788 as form_status_id, 7788 as form_status_stage_id, count(*) as num, '' as status, '' as stage from atif_gs_admission.log_form_status as ls
where ls.new_form_status=2 and ls.new_form_stage=12
and ls.`type`='G'

			# Form Submission To Be Allocate Removed
			UNION
			select 77088 as form_status_id, 77088 as form_status_stage_id, count(*) as num, '' as status, '' as stage  
			From atif_gs_admission.log_form_status as ls
			where ls.new_form_status=2  and ls.old_form_stage=12 and ls.`type`='G'
	
			
			
			


			#Applicants currently in Assessment
			UNION 
			select 7777 as form_status_id, 7777 as form_status_stage_id, count(id)  as num, '' as status, '' as stage
			from atif_gs_admission.view_process_flow as af  
			where af.form_status_id=2 and ( af.form_assessment_date >= curdate()) and af.form_status_stage_id < 4
					
			
			#Overall applicants moved to Assessment Process
			UNION 
			select 7766 as form_status_id, 7766 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from ( select af.id from atif_gs_admission.admission_form as af where af.form_status_id > 2 ) as af
			

			# Assessment R&D Overall applicants moved to Follow up
			UNION 
			select 7755 as form_status_id, 7755 as form_status_stage_id, sum(IDs) as num, '' as status, '' as stage
			from (
			select count(lgs.id) as IDs
			from atif_gs_admission.log_form_status as lgs
			where (  lgs.new_form_status=2 )
			and ( lgs.new_form_stage =7 or lgs.new_form_stage =10  )
		

			UNION all
			select count(af.id) as IDs from atif_gs_admission.admission_form as af 
			where ( af.form_status_id=2 and af.form_assessment_date < curdate())
			and ( af.form_status_stage_id < 5 )
		
			) as af

			#Applicants currently in Follow up
			UNION
			select 7744 as form_status_id, 7744 as form_status_stage_id, count(result.id) as num, '' as status, '' as stage
			from(			
			select * from atif_gs_admission.admission_form as af where  af.form_status_id=2 and af.form_assessment_date < CURDATE()
			and af.form_assessment_date != '2001-01-01'  
			and ( af.form_status_stage_id not in (6,7,10,15,16,17) ) 
			and af.form_discussion_date='0000-00-00' 
			) as result
			
			
			

			#Applicants currently in Follow up ( Red )
			UNION
			select 7733 as form_status_id, 7733 as form_status_stage_id, count(result.id) as num, '' as status, '' as stage 
			from(			
			select af.id from atif_gs_admission.admission_form as af where  af.form_status_id=2 and af.form_assessment_date < CURDATE()
			and af.form_assessment_date != '2001-01-01'  
			and ( af.form_status_stage_id not in (6,7,10,15,16,17) ) 
			and af.form_discussion_date='0000-00-00' 
			and (from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) )
			) as result

			#Overall request for extension in assessment
			UNION
			select 7722 as form_status_id, 7722 as form_status_stage_id, count( af.Form_id )as num, '' as status, '' as stage
			from (
			select ( lgs.admission_form_id) as Form_id
			from atif_gs_admission.log_form_status as lgs 
							where (lgs.new_form_stage = 10 or lgs.old_form_stage=10 ) 
							and (lgs.new_form_status = 2) 
							group by lgs.admission_form_id
						) as af

			#not interested from follow up in assessment
			UNION
			select 7711 as form_status_id, 7711 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 2)  	and af.form_status_id=2 and af.form_status_stage_id=7
				group by af.id
			) as af

			#Applicants showed up for Assessment
			UNION
			select 7700 as form_status_id, 7700 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_discussion_result = ''
			and af.form_assessment_date != '0000-00-00'
			and af.form_assessment_date != '2001-01-01'
			and af.form_status_id=3 and (af.form_status_stage_id <= 4 or af.form_status_stage_id = 11)
			
			
		
			

			#Applicants currently On Hold
			UNION
			select 7701 as form_status_id, 7701 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and af.form_discussion_date = '0000-00-00'
			and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16)

			#Applicants currently On assessment Hold Red (-)
			UNION
			select 7702 as form_status_id, 7702 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3) and af.form_discussion_date = '0000-00-00'
			and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16) and (from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) )

			#Applicants moved to assessment waitlist
			UNION
			select 7703 as form_status_id, 7703 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where ( lgs.new_form_stage = 9 or lgs.new_form_stage = 17 ) 
				and (lgs.new_form_status = 3) 
				group by af.id
			) as af

			


			#Applicants assessment moved to regret 
			
			UNION
			select 7704 as form_status_id, 7704 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where  af.form_status_id = 3 and af.form_status_stage_id=15 and (af.form_assessment_decision ='RGT' or af.form_assessment_decision='OHD')

			#Applicants assessment moved to regret by po
			UNION
			select 7705 as form_status_id, 7705 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			left join atif_gs_admission.log_form_status as lgs
			on lgs.admission_form_id = af.id
			where  af.form_status_id = 3 and af.form_status_stage_id=15 and af.form_assessment_decision='WIL'


		

			#Applicants assessment currently waitlist
			UNION
			select 7706 as form_status_id, 7706 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3) 
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17)

			#Applicants assessment currently wait list Red less then 2 day
			UNION
			select 7707 as form_status_id, 7707 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) 
			and ( from_unixtime(af.modified, '%Y-%m-%d' ) < ( curdate()- INTERVAL 3 day ) )

			#Applicants assessment allocated from wait list
			UNION
			select 7708 as form_status_id, 7708 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (((lgs.old_form_stage = 9 or lgs.old_form_stage = 17) 
				and (lgs.new_form_status = 3))  )
				group by af.id
			) as af

			UNION
			select 7709 as form_status_id, 7709 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 3

			#Currently discussion / Call for discussion
			UNION
			select 6666 as form_status_id, 6666 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.view_process_flow as af
			where af.form_status_id=3
			and af.form_dd >= CURDATE()
			and af.form_status_stage_id=13
			
			#Moved to discussion
			UNION
			select 6655 as form_status_id, 6655 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( select af.id as Form_id from atif_gs_admission.admission_form as af where af.form_status_id > 3 ) as af

	#Discussion move to Overall follow up
			UNION
			select 6644 as form_status_id, 6644 as form_status_stage_id, sum(af.IDs) as num, '' as status, '' as stage
			from (
			select count(lgs.id) as IDs
			from atif_gs_admission.log_form_status as lgs
			where (  lgs.new_form_status=3 )
			and (  lgs.new_form_stage =7 or lgs.new_form_stage =10 )
			

			UNION all
				select  count(af.id) as IDs
				from atif_gs_admission.admission_form as af 
							where ( af.form_status_id=3 )
							and ( af.form_status_stage_id not in (4,6,7,8,10,15,16,17))
							and af.form_discussion_date != '0000-00-00'
							and af.form_discussion_date < curdate()
			) as af
			

			

			#Discussion currently Follow up
			UNION
			select 6633 as form_status_id, 6633 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			where ( af.form_status_id=3 )
							and ( af.form_status_stage_id not in (4,6,7,8,10,15,16,17))
							and af.form_discussion_date != '0000-00-00'
							and af.form_discussion_date < curdate()
			
			

			
			#Discussion currently Follow up( red )
			UNION
			select 6622 as form_status_id, 6622 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			
			from atif_gs_admission.admission_form as af
			
			where ( af.form_status_id=3 )
			and ( af.form_status_stage_id not in (4,6,7,8,10,15,16,17))
			and af.form_discussion_date != '0000-00-00'
			and af.form_discussion_date < curdate()
			and ( from_unixtime(af.modified, '%Y-%m-%d' ) < ( curdate() - INTERVAL 3 day ) )				
			
			


			#Currently discussion not interested
			UNION
			select 
			6611 as form_status_id, 6611 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from atif_gs_admission.log_form_status as af
			where ( af.new_form_status=3 or af.new_form_status=4 ) and af.new_form_stage=7
			


			#Currently Show up for discussion
			UNION
			select 6600 as form_status_id, 6600 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where ( af.form_status_id =4 )
			and ( af.form_status_stage_id = 4)
			
			
			#Currently discussion On Hold
			UNION
			select 6601 as form_status_id, 6601 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_id = 4 and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16)
			
			#Currently discussion On Hold Red more than 2 days
			UNION
			select 6602 as form_status_id, 6602 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_id = 4 and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16) 
			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day)
			
			
			#discussion post wait list current
			UNION
			select 6603 as form_status_id, 6603 as form_status_stage_id, sum(af.Form_id) as num, '' as status, '' as stage 
			from( 
			select count(af.id) as Form_id 
			from atif_gs_admission.admission_form as af 
			where af.form_status_id=4 and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17 ) 
					
			union all 
			select count(af.id) as Form_id 
			from atif_gs_admission.admission_form as af 
			where af.form_status_id=5 
			and af.form_status_stage_id=12 
			) as af
			
			#discussion post wait list current (red)
			UNION
			select 6610 as form_status_id, 6610 as form_status_stage_id, sum(af.Form_id) as num, '' as status, '' as stage 
			from( 
			select count(afff.id) as Form_id 
			from atif_gs_admission.admission_form as afff
			where afff.form_status_id=4 and (afff.form_status_stage_id = 9 or afff.form_status_stage_id = 17 ) 
			and from_unixtime(afff.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			
			union  all
			select count(aff.id) as Form_id 
			from atif_gs_admission.admission_form as aff 
			where aff.form_status_id=5 
			and aff.form_status_stage_id=12 
			and from_unixtime(aff.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			) as af
			
			

			#discussion overall regret
			UNION
			select  
			6604 as form_status_id, 6604 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			

			where (af.form_status_id=4 or af.form_status_id=5)
			and af.form_status_stage_id=15 and (af.form_discussion_decision ='RGT' or af.form_discussion_decision='OHD')


			
			
			#discussion overall regret by p o
			UNION
			select  
			6605 as form_status_id, 6605 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			
			where (af.form_status_id=4 or af.form_status_id=5)
			and af.form_status_stage_id=15	and af.form_discussion_decision='WIL'	




			
			
			#discussion overall move to wait list
			UNION
			select 6606 as form_status_id, 6606 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.log_form_status as lgs
			where lgs.new_form_status=4
			and( lgs.new_form_stage=9 or lgs.new_form_stage=17 )
			
			
			#discussion request for extension
			UNION
			select 6608 as form_status_id, 6608 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id=3) and ( af.form_discussion_date != '0000-00-00' && af.form_discussion_date <= curdate() )
			and (af.form_status_stage_id=10)
			
			
			
			#discussion request for extension
			UNION
			select 6609 as form_status_id, 6609 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where
			(af.form_status_id=3) and ( af.form_discussion_date != '0000-00-00' && af.form_discussion_date <= curdate() )
			and from_unixtime(af.modified, '%Y-%m-%d') = (curdate() - INTERVAL 3 day)
			

			

			UNION
			select 5599 as form_status_id, 5599 as form_status_stage_id, count(id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision != ''
			and af.form_discussion_decision != 'OFR'
			and af.form_status_stage_id != 15
			and af.form_status_stage_id != 16
			and af.form_status_stage_id != 17
			and af.form_status_stage_id != 7
			and af.form_status_stage_id != 8
			and af.form_status_stage_id != 9

			UNION
			select 5588 as form_status_id, 5588 as form_status_stage_id, count(id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision != ''
			and af.offer_date != ''

			UNION
			select 5577 as form_status_id, 5577 as form_status_stage_id, count(id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_status_stage_id = 16

			UNION
			select 5566 as form_status_id, 5566 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision = 'OHD' and from_unixtime(af.modified) < curdate()-2

			UNION
			select 5555 as form_status_id, 5555 as form_status_stage_id, count(*) as num, '' as status, '' as stage
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

				# To Be Regretted ( PO Approval )
			UNION
			select 5501 as form_status_id, 5501 as form_status_stage_id, sum(af.Form_id) as num, '' as status, '' as stage
			from( 
			select count(af.id) as Form_id
			from atif_gs_admission.admission_form as af
			where (af.form_status_id=3 or af.form_status_id=4 or af.form_status_id=5)
			and af.form_status_stage_id=6 
			) as af
			
			

			#Overall Applicants Move to Offer Preparations
			UNION
select 4499 as form_status_id, 4499 as form_status_stage_id, count(af.id ) as num, '' as status, '' as stage
from atif_gs_admission.admission_form as af
left join atif_gs_admission.admission_form_offer as fo on fo.admission_form_id = af.id
where af.form_status_id > 4
and af.form_status_stage_id  != 12 
and (case when (af.grade_id = 15 or af.grade_id=16) 
	then `fo`.`post_result_verification_approval`=1 and fo.early_admission_signed_offer_letter=1
	else true end )
	



			#Currently Offer Preparations 
			UNION
			select 4488 as form_status_id, 4488 as form_status_stage_id, sum(aff.id) as num, '' as status, '' as stage
			
			from(
			
		select count(af.id) as id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where
			af.form_status_id=5 
			and fo.signed_offer_letter=0 and fo.offer_pack_handover=0
			and af.offer_date > curdate()
			and (af.form_status_stage_id < 4 )
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			
			
			
			union all 
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 

			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date > curdate()
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			
		) as aff	
			


			



			#Currently Offer Preparations (red)
			UNION
			select 4477 as form_status_id, 4477 as form_status_stage_id, sum(aff.id) as num, '' as status, '' as stage
			
			from(
			
			
			select count(af.id) as id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where
			af.form_status_id=5  and af.form_status_stage_id < 4
			
			and fo.signed_offer_letter=0 and fo.offer_pack_handover=0
			and af.offer_date >= curdate()
			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			
			
			
			union all 
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 

			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date >= curdate()
			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			
		) as aff	


			
			

			#Overall applicants show up to received the offer letter
			UNION
			select 4466 as form_status_id, 4466 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from ( select af.* from atif_gs_admission.view_process_flow as af 
				
				left join atif_gs_admission.admission_form_offer as fo		
				on  af.id =  fo.admission_form_id
				 
				where (af.form_status_id >= 5) 
				and (af.is_OFL = 1) 
				and fo.offer_letter=1
				and fo.fif_form=1
				and fo.photo_token=1
				and fo.hand_book=1
				
				and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1
				else true
				end )



				
			) as af
			
			
			
			

			#Overall Applicants Move to follow up not show up to received offer letter	
			
			UNION
			select 4455 as form_status_id, 4455 as form_status_stage_id, sum(aff.Form_id) as num, '' as status, '' as stage
			from( 
				select count( gg.Form_id) as Form_id
				from
				(
					select ( lgs.admission_form_id) as Form_id
					from atif_gs_admission.log_form_status as lgs
					left join atif_gs_admission.admission_form_offer as fo
					on fo.admission_form_id = lgs.admission_form_id
					
					where lgs.new_form_status=5 
					
					and ( lgs.new_form_stage=7 or lgs.new_form_stage=10 or lgs.new_form_stage=11 ) 
					and (fo.signed_offer_letter=0 and fo.offer_pack_handover=0)
					and (  case 
					when (lgs.admission_form_id= 15 or lgs.admission_form_id=16)
					then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
					else true
					end )
					
				) as gg
				
				
				
				
				
				
			union  
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 

			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date < curdate()
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			
				
			) as aff
			
			
			
			
			#Currently Offer Preparations Currently in Follow up
			UNION
			select 4456 as form_status_id, 4456 as form_status_stage_id, sum(af.Form_id)  as num, '' as status, '' as stage
from ( 

			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id = 5 
			and ( af.form_status_stage_id != 7)
			and( af.form_status_stage_id != 10 )
			and( af.form_status_stage_id != 12 )
			and af.offer_date < curdate()
			and (fo.signed_offer_letter=0 or fo.offer_pack_handover=0)

			and (case when (af.grade_id = 15 or af.grade_id=16) then fo.post_result_verification_approval=1 and fo.early_admission_offer_pack_handover=1
			and fo.early_admission_offer_letter=1
				else true end )
			
			
			
			union all 
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 
			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date < curdate()
			and (case when (af.grade_id = 15 or af.grade_id=16) then fo.post_result_verification_approval=1 and fo.early_admission_offer_pack_handover=1
			and fo.early_admission_offer_letter=1
				else true end )

			
			
	) as af		
			


	#Currently Offer Preparations Currently in Follow up ( red )
	UNION
	select 4458 as form_status_id, 4458 as form_status_stage_id, sum(af.Form_id) as num, '' as status, '' as stage
			from ( 

			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id = 5 
			and ( af.form_status_stage_id != 7)
			and( af.form_status_stage_id != 10 )
			and( af.form_status_stage_id != 12 )
			and af.offer_date < curdate()
			
			and (fo.signed_offer_letter=0 or fo.offer_pack_handover=0)

			and (case when (af.grade_id = 15 or af.grade_id=16) then fo.post_result_verification_approval=1 and fo.early_admission_offer_pack_handover=1
			and fo.early_admission_offer_letter=1
				else true end )

			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			
			
			
			
			union all 
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 

			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date < curdate()

			and (case when (af.grade_id = 15 or af.grade_id=16) then fo.post_result_verification_approval=1 and fo.early_admission_offer_pack_handover=1
			and fo.early_admission_offer_letter=1
				else true end )

			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			
		) as af	
	

			
			
			
			#Offer Preparations Overall Extensions Request
			UNION
select 4457 as form_status_id, 4457 as form_status_stage_id, count(lgs.form_id) as num, '' as status, '' as stage
			from(
				select  count(lgs.admission_form_id) as form_id
				from atif_gs_admission.log_form_status as lgs 
				
				left join atif_gs_admission.admission_form as af
				on af.id = lgs.admission_form_id
				
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = lgs.admission_form_id 
				
				where lgs.new_form_status=5 
				
				and ( lgs.new_form_stage = 10 ) 
				
				and ( fo.signed_offer_letter=0)
				
				group by lgs.admission_form_id
			) as lgs			
			
			
			

			#not interested to show up received offer letter
			UNION
			select 4444 as form_status_id, 4444 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id=af.id
			where af.form_status_id=5
			and af.form_status_stage_id=7
			and ( fo.signed_offer_letter=0 or  fo.offer_pack_handover=0 )



			#Currently Offer Procedure
			UNION
			select 4433 as form_status_id, 4433 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			
			left join atif_fee_student.fee_bill as fb
			on (SUBSTR(fb.gb_id, 6, 4) = af.form_no) and fb.academic_session_id >= 11 
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'
			
			left join atif_fee_student.fee_bill_received as fbr
			on fbr.fee_bill_id = fb.id
			
			where 
			af.form_status_id=5 
			and ( af.form_status_stage_id = 1 or af.form_status_stage_id = 3  )
			and fo.offer_letter=1
			and fo.fif_form=1
			and fo.print_fee_bill=1
			and fo.photo_token=1
			and fo.hand_book=1
			and fo.signed_offer_letter=1
			and fo.offer_pack_handover=1
			and ( fo.completed_fif_form=0 or fo.signed_hand_book=0)
			and af.offer_date >= curdate()
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			
			#Currently Offer Procedure
			UNION
			select 4434 as form_status_id, 4434 as form_status_stage_id, 0 as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			left join atif_fee_student.fee_bill as fb
			on (SUBSTR(fb.gb_id, 6, 4) = af.form_no) and fb.academic_session_id >= 11 
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10
			left join atif_fee_student.fee_bill_received as fbr
			on fbr.fee_bill_id = fb.id
			where 
			af.form_status_id=5 
			and ( af.form_status_stage_id = 1 or af.form_status_stage_id = 3  )
			and fo.offer_letter=1
			and fo.fif_form=1
			and fo.print_fee_bill=1
			and fo.photo_token=1
			and fo.hand_book=1
			and fo.signed_offer_letter=1
			and fo.offer_pack_handover=1
			and ( fo.completed_fif_form=0 or fo.signed_hand_book=0)
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			and af.offer_date > curdate()
			and from_unixtime(af.modified, '%Y-%m-%d') <  (curdate() - INTERVAL 3 day )
			
			
			 
			#Currently Offer complete check out
			UNION
			select 1984 as form_status_id, 1984 as form_status_stage_id, count(aff.Form_id) as num, '' as status, '' as stage
			from ( 
			
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = af.id

				left JOIN  atif_fee_student.fee_bill as fb
				ON af.form_no = mid(fb.gb_id, 6, 4)
				AND fb.academic_session_id >= 11
				AND fb.record_deleted = 0
				AND fb.gb_id like '18%'
				AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'
				left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
				where 
				af.form_status_id = 5 
				and ( fbr.received_amount is null )
				and fo.signed_offer_letter=1 and fo.offer_pack_handover=1
				and af.offer_date >= curdate()
				
				
			) as aff	
			
			
			#Currently Offer complete check out ( Red )
			UNION
			select 19084 as form_status_id, 19084 as form_status_stage_id, sum(aff.Form_id) as num, '' as status, '' as stage
			from ( 
			
				select count(af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = af.id

				left JOIN  atif_fee_student.fee_bill as fb
				ON af.form_no = mid(fb.gb_id, 6, 4)
				AND fb.academic_session_id >= 11
				AND fb.record_deleted = 0
				AND fb.gb_id like '18%'
				AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'
				left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
				where 
				af.form_status_id = 5 
				and ( fbr.received_amount is null )
				and fo.signed_offer_letter=1 and fo.offer_pack_handover=1
				and af.offer_date >= curdate()
				and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
				
				
			) as aff


		#Overall follow Complete Checks out
		union
		select 1985 as form_status_id, 1985 as form_status_stage_id, sum(aff.Form_id) as num, '' as status, '' as stage
from ( 


			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id = 5 
			and ( af.form_status_stage_id = 7 or af.form_status_stage_id = 10 or af.form_status_stage_id = 11)
			
			and af.offer_date < curdate()
			and (fo.signed_offer_letter=1 or fo.offer_pack_handover=1)
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )

		
		
			union
			select count(af.id) as Form_id
from atif_gs_admission.admission_form as af
left join atif_gs_admission.admission_form_offer as fo
on fo.admission_form_id = af.id

left JOIN  atif_fee_student.fee_bill as fb
ON af.form_no = mid(fb.gb_id, 6, 4)
AND fb.academic_session_id >= 11
AND fb.record_deleted = 0
AND fb.gb_id like '18%'
AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
where 
af.form_status_id = 5 
and ( af.form_status_stage_id != 7) and (af.form_status_stage_id != 10 )
and ( fbr.received_amount is null )

and ( fo.signed_offer_letter=1 or fo.offer_pack_handover=1 )
and af.offer_date < curdate()
and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )




				
				
				
			) as aff	
			
			
			
		#Complete Checks out extension
		union
		select 1986 as form_status_id, 1986 as form_status_stage_id, count(aff.form_id) as num, '' as status, '' as stage
		from (
		
		select  (lgs.admission_form_id) as form_id
				from atif_gs_admission.log_form_status as lgs 
				
				left join atif_gs_admission.admission_form as af
				on af.id = lgs.admission_form_id
				
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = lgs.admission_form_id 
				
				where lgs.new_form_status=5 
				
				and ( lgs.new_form_stage = 10 ) 
				
				and ( fo.signed_offer_letter=1)
				and af.offer_date < curdate()
				
				group by lgs.admission_form_id
	
				
		) as aff
		
		

			UNION
			select 3311 as form_status_id, 3311 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 6) 
				group by af.id
			) as af

			
			
			
			
		#Complete Checks currently in Follow up
		UNION
		select 3322 as form_status_id, 3322 as form_status_stage_id, count(aff.Form_id) as num, '' as status, '' as stage
		from ( 
			
			
			select (af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			
			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 

			and ( fbr.received_amount is null )
			and af.form_status_stage_id not in(6,7,8,9,10,12,13,14,15,16,17) 
			and fo.signed_offer_letter=1 and fo.offer_pack_handover=1
			
			and af.offer_date < curdate()
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )

		) as aff
		
		
		#Complete Checks currently in Follow up ( Red )
			UNION
			select 3321 as form_status_id, 3321 as form_status_stage_id, count(aff.Form_id) as num, '' as status, '' as stage
			from ( 
				
				
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = af.id
				
				left JOIN  atif_fee_student.fee_bill as fb
ON af.form_no = mid(fb.gb_id, 6, 4)
AND fb.academic_session_id >= 11
AND fb.record_deleted = 0
AND fb.gb_id like '18%'
AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
where 
af.form_status_id = 5 

and ( fbr.received_amount is null )
and af.form_status_stage_id not in(6,7,8,9,10,12,13,14,15,16,17) 
and fo.signed_offer_letter=1 and fo.offer_pack_handover=1
and af.offer_date < curdate()

and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )



and from_unixtime(af.modified, '%Y-%m-%d') <  (curdate() - INTERVAL 3 day )
				
			) as aff

			
			
			
			



			
			#not interested in complete check list
			UNION
			select 1987 as form_status_id, 1987 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id=af.id
			where af.form_status_id=5
			and af.form_status_stage_id=7
			and ( fo.signed_offer_letter=1 or  fo.offer_pack_handover=1 )
			and ( fo.completed_fif_form=1 or fo.signed_hand_book=1)
			
			
		
			





			#Applicants Aborted overall
			UNION
			select 1111 as form_status_id, 1111 as form_status_stage_id, count(id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_stage_id = 7

			#Admission Complete
			UNION
			select 2222 as form_status_id, 2222 as form_status_stage_id, count(id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id = 6 
			#and af.form_status_stage_id=1

			#Total Regretted
			UNION
			select 3333 as form_status_id, 3333 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
			select (af.id) as Form_id
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id=15 
			
			) as af	";


		// Start of A level admission queries
		$query .= " 
			#Total Regretted
			UNION
			select 3301 as form_status_id, 3301 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='RAO') and af.form_status_stage_id = 2
			) as af 


			UNION
			select 3302 as form_status_id, 3302 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='RAO') and af.form_status_stage_id = 2
			) as af 

			UNION
			select 3303 as form_status_id, 3303 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO') and af.form_status_stage_id = 2
			) as af 


			UNION
			select 3304 as form_status_id, 3304 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')  and af.form_status_stage_id = 2
				and af.offer_date >= curdate()
				and (afo.early_admission_offer_letter=0 or afo.early_admission_offer_letter is null)
				and ( afo.early_admission_print_fee_bill=0 or  afo.early_admission_print_fee_bill is null )
				

				union

				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO') and af.form_status_stage_id = 2
				and af.offer_date >= curdate()
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1  )

				and ( afo.early_admission_signed_offer_letter=0 )
				and (afo.early_admission_offer_pack_handover=0)
				

			) as af 

			UNION
			select 3305 as form_status_id, 3305 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage 
			from ( select (af.id) as Form_id 
				/*from atif_gs_admission.log_form_status as fs where fs.new_form_status=5 and fs.new_form_stage=19 group by fs.admission_form_id*/

				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')  and af.form_status_stage_id = 2
				and (afo.early_admission_offer_letter=1)
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1)
				

			) as af 

			# In EAO Procedure
			UNION
			select 3306 as form_status_id, 3306 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')

				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)

				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and af.form_status_stage_id=2
				
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)
				

				and ( fbr.fee_bill_id is null) 
				and fb.bill_due_date >= curdate()
			
				
			

			) as af 

			UNION
			select 3307 as form_status_id, 3307 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')

				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)

				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO') and af.form_status_stage_id = 2
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)

				and ( fbr.fee_bill_id is not null) 

				



			) as af 

			# EAO  Currently in Followup
			UNION
			select 3308 as form_status_id, 3308 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
			

				
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')  and af.form_status_stage_id = 2
				and af.offer_date < curdate()
				and (afo.early_admission_offer_letter=0 or afo.early_admission_offer_letter is null)
				and ( afo.early_admission_print_fee_bill=0 or  afo.early_admission_print_fee_bill is null )
				

				union

				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO') and af.form_status_stage_id = 2
				and af.offer_date < curdate()
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1  )

				and ( afo.early_admission_signed_offer_letter=0 )
				and (afo.early_admission_offer_pack_handover=0)
			


			) as af 

 

			# Post Result Verification Approval
			UNION
			select 3309 as form_status_id, 3309 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no 
				AND ( SUBSTR(fb.gb_id,3,2) = 72 )  AND fb.bill_title = 'Admission')

				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)

				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)

				and ( fbr.fee_bill_id is not null) 
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				
				union 

				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) 
				and (af.form_discussion_criteria ='RAO') 
				and af.form_status_stage_id = 2 
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				
				
				) as af 


			
		UNION
			select 3310 as form_status_id, 3310 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no 
				AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')

				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)

				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and af.form_status_stage_id=2
				
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)
				
				and ( fbr.fee_bill_id is null) 
				and fb.bill_due_date < curdate()
			) as af 

			# Currently Extensions in EAO Preparations
			UNION
			select 3101 as form_status_id, 3101 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')  and af.form_status_stage_id = 10
				and af.offer_date >= curdate()
				and (afo.early_admission_offer_letter=0 or afo.early_admission_offer_letter is null)
				and ( afo.early_admission_print_fee_bill=0 or  afo.early_admission_print_fee_bill is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )

				
			) as af 

			# Overall Extensions at EAO Preparations
			UNION
			select 3102 as form_status_id, 3102 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				left join atif_gs_admission.log_form_status as ls
				on ls.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')  
				and (afo.early_admission_offer_letter=0 or afo.early_admission_offer_letter is null)
				and ( afo.early_admission_print_fee_bill=0 or  afo.early_admission_print_fee_bill is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and ls.new_form_status=5 and ls.new_form_stage = 10

				
			) as af 


			# Overall Not Interested at EAO Preparations
			UNION
			select 3103 as form_status_id, 3103 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				left join atif_gs_admission.log_form_status as ls
				on ls.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')  
				and (afo.early_admission_offer_letter=0 or afo.early_admission_offer_letter is null)
				and ( afo.early_admission_print_fee_bill=0 or  afo.early_admission_print_fee_bill is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and ls.new_form_status=5 and ls.new_form_stage = 7

				
			) as af 


			# Overall Extensions EAO Procedure fee bill extension
			UNION
			select 3104 as form_status_id, 3104 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join atif_gs_admission.log_form_status as ls	on ls.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and ls.new_form_status=5 
				and ls.new_form_stage = 10
			) as af 


			# Currently Extensions EAO Procedure fee bill extension
			UNION
			select 3105 as form_status_id, 3105 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				left join atif_gs_admission.log_form_status as ls	on ls.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and ( afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1 )
				and ( afo.early_admission_signed_offer_letter=1 )
				and ( afo.early_admission_offer_pack_handover=1 )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and af.form_status_stage_id=10
			) as af 



			# Move To Final Admission Offer
			UNION
			select 3106 as form_status_id, 3106 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no 
				AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')
				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and ( afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1 )
				and ( afo.early_admission_signed_offer_letter=1 )
				and ( afo.early_admission_offer_pack_handover=1 )
				and (afo.post_result_verification_approval = 1  )
				and ( fbr.fee_bill_id is not null) 
				and fbr.received_amount > 0
				
			) as af 



				# Currently Not Interested EAO Procedure 
			UNION
			select 3107 as form_status_id, 3107 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				left join atif_gs_admission.log_form_status as ls	on ls.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) and (af.form_discussion_criteria ='EAO')
				and ( afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1 )
				and ( afo.early_admission_signed_offer_letter=1 )
				and ( afo.early_admission_offer_pack_handover=1 )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and af.form_status_stage_id=7
			) as af 



			";



		}else
		{
			
			$query = "select 9999 as form_status_id, 9999 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where " . $WhereFull . " 

			UNION
			select 9988 as form_status_id, 9988 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id=1) and ( af.form_status_stage_id <= 3  ) and (af.form_submission_date >= curdate())
			and " . $WhereFull . "
			
			UNION 
			select 9981 as form_status_id, 9981 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id=1) and ( af.form_status_stage_id <= 3 ) and (af.form_submission_date >= curdate())
			and from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day )  and " . $WhereFull . "
			

			UNION
			select 9977 as form_status_id, 9977 as form_status_stage_id, count( af.id )  as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 1 and " . $WhereFull . "
			
			union
			select 9978 as form_status_id, 9978 as form_status_stage_id, count( af.id )  as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af where af.form_status_id = 1 and af.form_status_stage_id = 10 
			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day ) and " . $WhereFull . "
			
			#Admission forms submitted
			UNION	
			select 8888 as form_status_id, 8888 as form_status_stage_id, count(id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af where af.form_status_id >= 2 and " . $WhereFull . "


			# To Be submission followed up
			UNION
			select 8899 as form_status_id, 8899 as form_status_stage_id, sum(IDs) as num, '' as status, '' as stage
			from (
			
			select count(lgs.id) as IDs
			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission.admission_form as af
			on af.id= lgs.admission_form_id
			where (  lgs.new_form_status=1 )
			and ( lgs.new_form_stage =7 or lgs.new_form_stage =10 )
			and " . $WhereFull . "
			
			
			UNION all
			select count(af.id) as IDs from atif_gs_admission.admission_form as af 
			where ( af.form_status_id=1 and af.form_submission_date < curdate() and af.form_assessment_date='0000-00-00')
			and ( af.form_status_stage_id not in (7,10 ))
			and " . $WhereFull . "
			
			) as af

			
			

			
	
			#Total Submission Overall Extensions
			UNION
			select 8877 as form_status_id, 8877 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.admission_form as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 10)  
				and (lgs.new_form_status = 1) and " . $WhereFull . "
				group by af.id
			) as af

						
			# Currently in submission follow up
			UNION 
			select 8866 as form_status_id, 8866 as form_status_stage_id, count( af.id )  as num, '' as status, '' as stage 
			from (select af.* from atif_gs_admission.admission_form as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where ( af.form_status_id=1 and af.form_submission_date < curdate() and af.form_assessment_date='0000-00-00')
				and ( af.form_status_stage_id not in (7,10))
				and " . $WhereFull . "

group by af.id

			) as af
			
			union
			select 8867 as form_status_id, 8867 as form_status_stage_id, count(af.form_id)  as num, '' as status, '' as stage 
			from ( 
			select af.id as form_id
			from atif_gs_admission.admission_form as af
			where ( af.form_status_id=1 and af.form_submission_date < curdate() and af.form_assessment_date='0000-00-00' 
			and ".$WhereFull." 
			and ( from_unixtime( af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) ) 
			and ( af.form_status_stage_id not in (7,10))
)			

	group by af.id
			) as af
			
			
				
				
				
			
			
			# Form Submission Interested
			UNION 
select 8855 as form_status_id, 8855 as form_status_stage_id, count(*) as num, '' as status, '' as stage
from atif_gs_admission.log_form_status as lgs
left join atif_gs_admission.admission_form as af
on af.id = lgs.admission_form_id
where lgs.new_form_stage=7
and af.form_status_id=1
and lgs.new_form_status=1
and " . $WhereFull ."


			
			
			
		

			UNION
			select 8844 as form_status_id, 8844 as form_status_stage_id, count( af.id )  as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 2 and " . $WhereFull . "
			
			# Waiting/Extensions for Form assessment ( Red )
			UNION
			select 8841 as form_status_id, 8841 as form_status_stage_id,  count(*) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 2 and " . $WhereFull . "
			and ( from_unixtime( af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) ) 
			
			

			# Form Submission Currently in Allocate
			UNION
			select 7799 as form_status_id, 7799 as form_status_stage_id, count( af.id ) as num, '' as status, '' as stage
 			From atif_gs_admission.admission_form as af
				
				Where ( 
				af.form_status_id=2
				and ".$WhereFull."
				and af.form_assessment_date = '2001-01-01')

				
			
			
			
			
			# Form Submission To Be Allocate more than 2 days 
			UNION
			select 77099 as form_status_id, 77099 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			From atif_gs_admission.admission_form as af
				Where  
				af.form_status_id=2 
				and " . $WhereFull . "  
				and af.form_assessment_date = '2001-01-01'
				and (from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) ) 
			
			
			# Form Submission To Be Allocate Overall
			UNION
			select 7788 as form_status_id, 7788 as form_status_stage_id, count(*) as num, '' as status, '' as stage 
			from atif_gs_admission.log_form_status as ls
			Left Join atif_gs_admission.admission_form as af
			on af.id = ls.admission_form_id
			
			where ls.new_form_status=2 and ls.new_form_stage=12 and ls.`type`='G' and " . $WhereFull . "

			
			# Form Submission To Be Allocate Removed
			UNION
			select 77088 as form_status_id, 77088 as form_status_stage_id, count(*) as num, '' as status, '' as stage  
			From atif_gs_admission.log_form_status as ls
			left join atif_gs_admission.admission_form as af
			on ls.admission_form_id = af.id
			where ls.new_form_status=2 and ls.old_form_stage=12 and ls.`type`='G' and " . $WhereFull . "
			
			
			
			UNION #Applicants currently in Assessment
			select 7777 as form_status_id, 7777 as form_status_stage_id, count( af.id )  as num, '' as status, '' as stage
			from atif_gs_admission.view_process_flow as af  
			where af.form_status_id=2 and (af.form_assessment_date >= curdate()) and " . $WhereFull . " and af.form_status_stage_id < 4
			
			

			#Overall applicants moved to Assessment Process
			UNION
			select 7766 as form_status_id, 7766 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.admission_form as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 4) 
				and (lgs.new_form_status = 3) and " . $WhereFull . "
				group by af.id
			) as af
			
			
			
			
			# Assessment R&D Overall applicants moved to Follow up
			UNION 
			select 7755 as form_status_id, 7755 as form_status_stage_id, sum(IDs) as num, '' as status, '' as stage
			from (
			select count(lgs.id) as IDs
			from atif_gs_admission.log_form_status as lgs
			
			left join atif_gs_admission.admission_form as af
			on af.id=lgs.admission_form_id
			
			where (  lgs.new_form_status=2 )
			and ( lgs.new_form_stage =5 or lgs.new_form_stage =7 or lgs.new_form_stage =10  ) and " . $WhereFull . "
		

			UNION all
			select count(af.id) as IDs from atif_gs_admission.admission_form as af 
			where ( af.form_status_id=2 and af.form_assessment_date < curdate())
			and ( af.form_status_stage_id < 5 ) and " . $WhereFull . "
		
			) as af
			
			#Applicants currently in Follow up
			UNION
			select 7744 as form_status_id, 7744 as form_status_stage_id, count(result.id) as num, '' as status, '' as stage
			from(			
			select * from atif_gs_admission.admission_form as af where  af.form_status_id=2 and af.form_assessment_date < CURDATE()
			and af.form_assessment_date != '2001-01-01'   and " . $WhereFull . "
			and ( af.form_status_stage_id not in (6,7,10,15,16,17) ) 
			and af.form_discussion_date='0000-00-00' 
			) as result
			
			
			

			#Applicants currently in Follow up ( Red )
			UNION
			select 7733 as form_status_id, 7733 as form_status_stage_id, count(result.id) as num, '' as status, '' as stage 
			from(			
			select af.id from atif_gs_admission.admission_form as af where  af.form_status_id=2 and af.form_assessment_date < CURDATE()
			and " . $WhereFull . "
			and af.form_assessment_date != '2001-01-01'  
			and ( af.form_status_stage_id not in (6,7,10,15,16,17) ) 
			and af.form_discussion_date='0000-00-00' 
			and (from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) )
			) as result
			
			

			#Overall request for extension in assessment
			UNION
			select 7722 as form_status_id, 7722 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.admission_form as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 10) 
				and (lgs.new_form_status = 2)  and " . $WhereFull . " 
				group by af.id
			) as af
			

			UNION
			select 7711 as form_status_id, 7711 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.admission_form as af 
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
			and af.form_status_id=3 and (af.form_status_stage_id <= 4 or af.form_status_stage_id = 11)
			and " . $WhereFull . "

			UNION
			select 7701 as form_status_id, 7701 as form_status_stage_id, count( af.id )  as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16) and " . $WhereFull . "

			UNION
			select 7702 as form_status_id, 7702 as form_status_stage_id, count( af.id )  as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16) 
			and (from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) )

			UNION
			select 7703 as form_status_id, 7703 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.admission_form as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 9 or lgs.new_form_stage = 17) 
				and (lgs.new_form_status = 3) and " . $WhereFull . " 
				group by af.id
			) as af






			#Applicants assessment moved to regret 
			
			UNION
			select 7704 as form_status_id, 7704 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where  af.form_status_id = 3 and " . $WhereFull . "
			and af.form_status_stage_id=15 and (af.form_assessment_decision ='RGT' or af.form_assessment_decision='OHD')

			#Applicants assessment moved to regret by po
			UNION
			select 7705 as form_status_id, 7705 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			
			where  af.form_status_id = 3 
			and " . $WhereFull . "
			and af.form_status_stage_id=15 and af.form_assessment_decision='WIL'





			UNION
			select 7706 as form_status_id, 7706 as form_status_stage_id, count( af.id )  as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) and " . $WhereFull . "

			UNION
			select 7707 as form_status_id, 7707 as form_status_stage_id, count( af.id )  as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id = 3)
			and " . $WhereFull . "
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) 
			and (from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) )

			UNION
			select 7708 as form_status_id, 7708 as form_status_stage_id, count( af.id )  as num, '' as status, '' as stage 
			from (select af.* from atif_gs_admission.admission_form as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (((lgs.new_form_stage = 9 or lgs.new_form_stage = 17) 
				and (lgs.new_form_status = 3)) ) and " . $WhereFull . "
				group by af.id
			) as af

			UNION
			select 7709 as form_status_id, 7709 as form_status_stage_id, count( af.id )  as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id = 10
			and af.form_status_id = 3 and " . $WhereFull . "

			UNION
			select 6666 as form_status_id, 6666 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as fa
			left join atif_gs_admission.view_process_flow as af
			on af.id=fa.id
			where af.form_status_id=3
			and af.form_dd >= CURDATE()
			and af.form_status_stage_id=13
			and " . $WhereFull . "

			UNION
			select 6655 as form_status_id, 6655 as form_status_stage_id, count(af.Form_id)as num, '' as status, '' as stage
			from ( select af.id as Form_id from atif_gs_admission.admission_form as af where af.form_status_id > 3 and " . $WhereFull . " ) as af
			
			

			#Discussion move to Overall follow up
			UNION
			select 6644 as form_status_id, 6644 as form_status_stage_id, sum(af.IDs) as num, '' as status, '' as stage
			from (
			select count(lgs.admission_form_id) as IDs
			from atif_gs_admission.log_form_status as lgs
			left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
			where (  lgs.new_form_status=3 ) and " . $WhereFull . "
			and ( lgs.new_form_stage =7 or lgs.new_form_stage =10 ) 
			group by lgs.admission_form_id 

			UNION all
			select  count(af.id) as IDs 
			from atif_gs_admission.admission_form as af  
			where ( af.form_status_id=3 ) and " . $WhereFull . " 
			and ( af.form_status_stage_id not in (4,6,7,8,10,15,16,17)) 
			and af.form_discussion_date != '0000-00-00' 
			and af.form_discussion_date < curdate() 
							
							
			) as af
			
			

		
			
			#Discussion currently Follow up
			UNION
			select 6633 as form_status_id, 6633 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			where ( af.form_status_id=3 ) and " . $WhereFull . "
							and ( af.form_status_stage_id not in (4,6,7,8,10,15,16,17))
							and af.form_discussion_date != '0000-00-00'
							and af.form_discussion_date < curdate()
							
			
					
			#Discussion currently Follow up( red )
			UNION
			select 6622 as form_status_id, 6622 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			
			from atif_gs_admission.admission_form as af
			
			where ( af.form_status_id=3 ) and " . $WhereFull . "
			and ( af.form_status_stage_id not in (4,6,7,8,10,15,16,17))
			and af.form_discussion_date != '0000-00-00'
			and af.form_discussion_date < curdate()
			and (from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 3 day ) )
			

			UNION
			select 6611 as form_status_id, 6611 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.admission_form as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and ( lgs.new_form_status = 3 or lgs.new_form_status = 4 ) and " . $WhereFull . " 
				group by af.id
			) as af

					
			#Currently Show up for discussion
			UNION
			select 6600 as form_status_id, 6600 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where ( af.form_status_id =4 ) 
			and ( af.form_status_stage_id = 4) and " . $WhereFull . "
			
			
			
			
			#Currently discussion On Hold
			UNION
			select 6601 as form_status_id, 6601 as form_status_stage_id, count( af.id )  as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_id=4 and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16)
			and " . $WhereFull . "
			
			#Currently discussion On Hold Red more than 2 days
			UNION
			select 6602 as form_status_id, 6602 as form_status_stage_id, count( af.id )  as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where af.form_status_id=4 and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16) and from_unixtime(af.modified, '%Y-%m-%d') = (curdate() - INTERVAL 3 day)
			and " . $WhereFull . "
			
			
						
			#discussion post wait list current
			UNION
			select 6603 as form_status_id, 6603 as form_status_stage_id, sum(aff.Form_id) as num, '' as status, '' as stage 
			from( 
			select count(af.id) as Form_id 
			from atif_gs_admission.admission_form as af 
			where af.form_status_id=4 and " . $WhereFull . "
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17 ) 
					
			union all 
			select count(af.id) as Form_id 
			from atif_gs_admission.admission_form as af 
			where af.form_status_id=5  and " . $WhereFull . "
			and af.form_status_stage_id=12 
			) as aff
			
			#discussion post wait list current (red)
			UNION
			select 6610 as form_status_id, 6610 as form_status_stage_id, sum(aff.Form_id) as num, '' as status, '' as stage 
			from( 
			select count(af.id) as Form_id 
			from atif_gs_admission.admission_form as af
			where af.form_status_id=4 and " . $WhereFull . "
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17 ) 
			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			
			union  all
			select count(af.id) as Form_id 
			from atif_gs_admission.admission_form as af 
			where af.form_status_id=5 
			and " . $WhereFull . "
			and af.form_status_stage_id=12 
			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
			) as aff
			
			
			#discussion overall reget
			UNION
			select 6604 as form_status_id, 6604 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			
			where (af.form_status_id=4 or af.form_status_id=5) and " . $WhereFull . " 
			and af.form_status_stage_id=15 and (af.form_discussion_decision ='RGT' or af.form_discussion_decision='OHD')
			
			#discussion overall regret by p o
			UNION
			select  
			6605 as form_status_id, 6605 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id=4 or af.form_status_id=5) and " . $WhereFull . "
			and af.form_status_stage_id=15 and af.form_discussion_decision='WIL'	
			
			
			
			
			#discussion overall move to wait list
			UNION
			select 6606 as form_status_id, 6606 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage 
			from atif_gs_admission.log_form_status as lgs
			
			left join atif_gs_admission.admission_form as af
			on af.id=lgs.admission_form_id
			
			where lgs.new_form_status=4
			and( lgs.new_form_stage=9 or lgs.new_form_stage=17 ) and " . $WhereFull . "
			
			
			#discussion request for extension
			UNION
			select 6608 as form_status_id, 6608 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where (af.form_status_id=3) and ( af.form_discussion_date != '0000-00-00' && af.form_discussion_date <= curdate() )
			and (af.form_status_stage_id=10) and " . $WhereFull . "
			
			
			
			#discussion request for extension
			UNION
			select 6609 as form_status_id, 6609 as form_status_stage_id, count(id) as num, '' as status, '' as stage 
			from atif_gs_admission.admission_form as af
			where 
			(af.form_status_id=3) and ( af.form_discussion_date != '0000-00-00' && af.form_discussion_date <= curdate() )
			and " . $WhereFull . " 
			and from_unixtime(af.modified, '%Y-%m-%d') = (curdate() - INTERVAL 3 day)
			

			
			
			

			UNION
			select 5599 as form_status_id, 5599 as form_status_stage_id, count( af.id ) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision != ''
			and af.form_discussion_decision != 'OFR'
			and af.form_status_stage_id != 15
			and af.form_status_stage_id != 16
			and af.form_status_stage_id != 17
			and af.form_status_stage_id != 7 and " . $WhereFull . "

			UNION
			select 5588 as form_status_id, 5588 as form_status_stage_id, count( af.id ) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision != ''
			and af.offer_date != '' and " . $WhereFull . "

			UNION
			select 5577 as form_status_id, 5577 as form_status_stage_id, count( af.id ) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_status_stage_id = 16 and " . $WhereFull . "

			UNION
			select 5566 as form_status_id, 5566 as form_status_stage_id, count( af.id ) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_discussion_decision = 'OHD' and from_unixtime(af.modified) < curdate()-2 and " . $WhereFull . "

			UNION
			select 5555 as form_status_id, 5555 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.admission_form as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 9) 
				and (lgs.new_form_status >= 4) and " . $WhereFull . "
				group by af.id
			) as af

			UNION
			select 5544 as form_status_id, 5544 as form_status_stage_id, count( af.id ) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and af.form_status_stage_id = 15 and " . $WhereFull . "

			UNION
			select 5533 as form_status_id, 5533 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.admission_form as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where ((lgs.old_form_stage = 9 or lgs.old_form_stage = 17) and (lgs.new_form_stage = 6 or lgs.new_form_stage = 15))
				and (lgs.new_form_status >= 3) and " . $WhereFull . " 
				group by af.id
			) as af

			UNION
			select 5522 as form_status_id, 5522 as form_status_stage_id, count( af.id ) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) and " . $WhereFull . " 

			UNION
			select 5511 as form_status_id, 5511 as form_status_stage_id, count( af.id ) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id >= 4
			and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) and from_unixtime(af.modified) < curdate()-2 and " . $WhereFull . "

			UNION
			select 5500 as form_status_id, 5500 as form_status_stage_id, count(*)as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.admission_form as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where ((lgs.old_form_stage = 9 or lgs.old_form_stage = 17 OR lgs.new_form_stage = 9 or lgs.new_form_stage = 17))
				and (af.form_status_id >= 5) and " . $WhereFull . " 
				group by af.id
			) as af

			# To Be Regretted ( PO Approval )
			UNION
			select 5501 as form_status_id, 5501 as form_status_stage_id, sum(af.Form_id) as num, '' as status, '' as stage
			from( 
			select count(af.id) as Form_id
			from atif_gs_admission.admission_form as af
			where (af.form_status_id=3 or af.form_status_id=4 or af.form_status_id=5)
			and af.form_status_stage_id=6 and " . $WhereFull . "
			) as af
			
			
			

#Overall Applicants Move to Offer Preparations
			UNION
select 4499 as form_status_id, 4499 as form_status_stage_id, count(af.id ) as num, '' as status, '' as stage
from atif_gs_admission.admission_form as af
left join atif_gs_admission.admission_form_offer as fo on fo.admission_form_id = af.id
where af.form_status_id > 4
and af.form_status_stage_id  != 12  and " . $WhereFull . "
and (case when (af.grade_id = 15 or af.grade_id=16) 
	then `fo`.`post_result_verification_approval`=1 and fo.early_admission_signed_offer_letter=1
	else true end )

			
			
			
			

			#Currently Offer Preparations 
	
		
		
		
		UNION
			select 4488 as form_status_id, 4488 as form_status_stage_id, sum(aff.id) as num, '' as status, '' as stage
			
			from(
			
			select count(af.id) as id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where
			af.form_status_id = 5 and af.form_status_stage_id < 4 and " . $WhereFull . "
			and af.offer_date >= curdate()
			and( (fo.offer_letter=0)
			or (fo.fif_form=0)
			or (fo.print_fee_bill=0)
			or (fo.photo_token=0)
			or (fo.hand_book=0)
			)
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			
			
			union all
			select count(af.id) as id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where
			af.form_status_id=5 and " . $WhereFull . "
			and( (fo.offer_letter=1)
			or (fo.fif_form=1)
			or (fo.print_fee_bill=1)
			or (fo.photo_token=1)
			or (fo.hand_book=1)
			)
			and (fo.signed_offer_letter=0 or fo.offer_pack_handover=0)
			and af.offer_date >= curdate()
			and af.form_status_stage_id < 4
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			
			
			
			union all 
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id >= 5  and " . $WhereFull . "

			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date >= curdate()
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			
			
		) as aff	
		
		
		#Currently Offer Preparations (red)
			UNION
			select 4477 as form_status_id, 4477 as form_status_stage_id, sum(aff.id) as num, '' as status, '' as stage
			
			from(
			
			
			select count(af.id) as id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where
			af.form_status_id=5  and " . $WhereFull . " and af.form_status_stage_id < 4 
			
			and fo.signed_offer_letter=0 and fo.offer_pack_handover=0
			and af.offer_date >= curdate()
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
		) as aff	


			
			

			#Overall applicants show up to received the offer letter
			UNION
			select 4466 as form_status_id, 4466 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.admission_form_offer as fo  
				on fo.admission_form_id = af.form_id
				where (af.form_status_id >= 5)  and " . $WhereFull . "
				and (af.is_OFL = 1)
				and 
(
	case 
	when (af.grade_id = 15 or af.grade_id=16) 
	then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
	else true 
	end
)
			) as af
			
			
			

			
			
			#Overall Applicants Move to follow up not show up to received offer letter	
			UNION
			select 4455 as form_status_id, 4455 as form_status_stage_id, sum(aff.Form_id) as num, '' as status, '' as stage
			from( 
				select count( gg.Form_id) as Form_id
				from
				(
					select ( lgs.admission_form_id) as Form_id
					from atif_gs_admission.log_form_status as lgs
					left join atif_gs_admission.admission_form as af
					on af.id = lgs.admission_form_id
					
					left join atif_gs_admission.admission_form_offer as fo
					on fo.admission_form_id = lgs.admission_form_id
					
					
					where lgs.new_form_status=5 
					
					and ( lgs.new_form_stage=7 or lgs.new_form_stage=10  or lgs.new_form_stage=11  ) 
					and " . $WhereFull . "
					and (fo.signed_offer_letter=0 and fo.offer_pack_handover=0)
					and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
					
				) as gg
				
				
				
				
				
				
			union  
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 and " . $WhereFull . "

			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date < curdate()
			
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
				 
			) as aff
			
			
			
			
			
			#Currently Offer Preparations Currently in Follow up
			UNION
			select 4456 as form_status_id, 4456 as form_status_stage_id, sum(af.Form_id)  as num, '' as status, '' as stage
from ( 

select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id=5  and " . $WhereFull . "
			and ( af.form_status_stage_id != 7)
			and( af.form_status_stage_id != 10 )
			and( af.form_status_stage_id != 12 )
			and af.offer_date < curdate()
			
			
			
			and (fo.signed_offer_letter=0 or fo.offer_pack_handover=0)
			
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			
			
			
			union all 
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5  and " . $WhereFull . "

			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date < curdate()
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )

			
			
	) as af		
			
	
	
			
			
			


			#Currently Offer Preparations Currently in Follow up ( red )
			UNION
			select 4458 as form_status_id, 4458 as form_status_stage_id, sum(af.Form_id)  as num, '' as status, '' as stage
from ( 

select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id=5 and " . $WhereFull . "
			and ( af.form_status_stage_id != 7)
			and( af.form_status_stage_id != 10 )
			and( af.form_status_stage_id != 12 )
			
			and af.offer_date < curdate()
			and fo.offer_letter=1
			and fo.fif_form=1
			and fo.print_fee_bill=1
			and fo.photo_token=1
			and fo.hand_book=1
			and (fo.signed_offer_letter=0 or fo.offer_pack_handover=0)
			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )  
			
			union all
			
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id=5  and " . $WhereFull . " 
			and ( af.form_status_stage_id != 7)
			and( af.form_status_stage_id != 10 )
			and af.offer_date < curdate()
			and fo.offer_letter=0
			and fo.fif_form=0
			and fo.print_fee_bill=0
			and fo.photo_token=0
			and fo.hand_book=0
			and (fo.signed_offer_letter=0 or fo.offer_pack_handover=0)

			and (case when (af.grade_id = 15 or af.grade_id=16) then fo.post_result_verification_approval=1 and fo.early_admission_offer_pack_handover=1
			and fo.early_admission_offer_letter=1
				else true end )


			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )  
			
			
			
			union all 
			select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id

			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id >= 5  and " . $WhereFull . "

			and ( fbr.received_amount is not null or fbr.received_amount > 0  )
			and ( fo.signed_offer_letter=0 or fo.offer_pack_handover=0 )
			and af.offer_date < curdate()

			and (case when (af.grade_id = 15 or af.grade_id=16) then fo.post_result_verification_approval=1 and fo.early_admission_offer_pack_handover=1
			and fo.early_admission_offer_letter=1
				else true end )

				
			and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )  
	) as af		
	

			
			
			
			#Offer Preparations Overall Extensions Request
			UNION
			select 4457 as form_status_id, 4457 as form_status_stage_id, count(lgs.form_id) as num, '' as status, '' as stage
			from(
				select  count(lgs.admission_form_id) as form_id
				from atif_gs_admission.log_form_status as lgs 
				
				left join atif_gs_admission.admission_form as af
				on af.id = lgs.admission_form_id
				
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = lgs.admission_form_id 
				
				where lgs.new_form_status=5  and " . $WhereFull . "
				
				and ( lgs.new_form_stage = 10 ) 
				
				and ( fo.signed_offer_letter=0)
				
				group by lgs.admission_form_id
			) as lgs	
				
				
			
			
			
			

			
			

			#not interested to show up received offer letter
			UNION
			select 4444 as form_status_id, 4444 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id=af.id
			where af.form_status_id=5 and " . $WhereFull . "
			and af.form_status_stage_id=7
			and ( fo.signed_offer_letter=0 or fo.signed_offer_letter=0)
		
		
		

			UNION
			select 4433 as form_status_id, 4433 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			
			left join atif_fee_student.fee_bill as fb
			on (SUBSTR(fb.gb_id, 6, 4) = af.form_no) and fb.academic_session_id >= 11 
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10
			
			left join atif_fee_student.fee_bill_received as fbr
			on fbr.fee_bill_id = fb.id
			
			where 
			af.form_status_id=5 
			and ( af.form_status_stage_id = 1 or af.form_status_stage_id = 3  )
			and fo.offer_letter=1
			and fo.fif_form=1
			and fo.print_fee_bill=1
			and fo.photo_token=1
			and fo.hand_book=1
			and fo.signed_offer_letter=1
			and fo.offer_pack_handover=1
			and ( fo.completed_fif_form=0 or fo.signed_hand_book=0)
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			and af.offer_date >= curdate()
			and " . $WhereFull . "
			
			
			
			#Currently Offer Procedure ( red )
			UNION
			select 4434 as form_status_id, 4434 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			left join atif_fee_student.fee_bill as fb
			on (SUBSTR(fb.gb_id, 6, 4) = af.form_no) and fb.academic_session_id >= 11 
			AND fb.record_deleted = 0
			AND LENGTH(fb.gb_id) = 10
			left join atif_fee_student.fee_bill_received as fbr
			on fbr.fee_bill_id = fb.id
			where 
			af.form_status_id=5 
			and ( af.form_status_stage_id = 1 or af.form_status_stage_id = 3  )
			and fo.offer_letter=1
			and fo.fif_form=1
			and fo.print_fee_bill=1
			and fo.photo_token=1
			and fo.hand_book=1
			and fo.signed_offer_letter=1
			and fo.offer_pack_handover=1
			and ( fo.completed_fif_form=0 or fo.signed_hand_book=0)
			and af.offer_date >= curdate()
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )
			and from_unixtime(af.modified, '%Y-%m-%d') <  (curdate() - INTERVAL 3 day ) and " . $WhereFull . "
			


			
		

			
			
			
			
			
			
			
			
			
			
		#Currently Offer complete check out
			UNION
			select 1984 as form_status_id, 1984 as form_status_stage_id, count(aff.Form_id) as num, '' as status, '' as stage
			from ( 
			
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = af.id

				left JOIN  atif_fee_student.fee_bill as fb
				ON af.form_no = mid(fb.gb_id, 6, 4)
				AND fb.academic_session_id >= 11
				AND fb.record_deleted = 0
				AND fb.gb_id like '18%'
				AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'
				left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
				where 
				af.form_status_id = 5  and " . $WhereFull . "
				and ( fbr.received_amount is null )
				and fo.signed_offer_letter=1 and fo.offer_pack_handover=1
				and af.offer_date >= curdate()
				
				
			) as aff	
			
			
			#Currently Offer complete check out ( Red )
			UNION
			select 19084 as form_status_id, 19084 as form_status_stage_id, sum(aff.Form_id) as num, '' as status, '' as stage
			from ( 
			
				select count(af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = af.id

				left JOIN  atif_fee_student.fee_bill as fb
				ON af.form_no = mid(fb.gb_id, 6, 4)
				AND fb.academic_session_id >= 11
				AND fb.record_deleted = 0
				AND fb.gb_id like '18%'
				AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'
				left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
				where 
				af.form_status_id = 5  and " . $WhereFull . "
				and ( fbr.received_amount is null )
				and fo.signed_offer_letter=1 and fo.offer_pack_handover=1
				and af.offer_date >= curdate()
				and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - INTERVAL 3 day )
				
				
			) as aff
			


		
		
		#Overall follow Complete Checks out
		union
		select 1985 as form_status_id, 1985 as form_status_stage_id, sum(aff.Form_id) as num, '' as status, '' as stage
from ( 
select count( af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			where 
			af.form_status_id = 5 and " . $WhereFull . "
			and ( af.form_status_stage_id = 7 or af.form_status_stage_id = 10 or af.form_status_stage_id = 11)
			
			and af.offer_date < curdate()
			and (fo.signed_offer_letter=1 or fo.offer_pack_handover=1)
			and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )

		
		
			union
			select count(af.id) as Form_id
from atif_gs_admission.admission_form as af
left join atif_gs_admission.admission_form_offer as fo
on fo.admission_form_id = af.id

left JOIN  atif_fee_student.fee_bill as fb
ON af.form_no = mid(fb.gb_id, 6, 4)
AND fb.academic_session_id >= 11
AND fb.record_deleted = 0
AND fb.gb_id like '18%'
AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
where 
af.form_status_id = 5 and " . $WhereFull . "
and ( af.form_status_stage_id != 7) and (af.form_status_stage_id != 10 )
and ( fbr.received_amount is null )

and ( fo.signed_offer_letter=1 or fo.offer_pack_handover=1 )
and af.offer_date < curdate()
and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )



				
				
				
			) as aff	
			
			
			
		
			
			
			
			
		#Complete Checks out extension
		union
		select 1986 as form_status_id, 1986 as form_status_stage_id, count(aff.form_id) as num, '' as status, '' as stage
		from (


				select  (lgs.admission_form_id) as form_id
				from atif_gs_admission.log_form_status as lgs 
				
				left join atif_gs_admission.admission_form as af
				on af.id = lgs.admission_form_id
				
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = lgs.admission_form_id 
				
				where lgs.new_form_status=5 and " . $WhereFull . "
				
				and ( lgs.new_form_stage = 10 ) 
				
				and ( fo.signed_offer_letter=1)
				and af.offer_date < curdate()
				
				group by lgs.admission_form_id

				
				
		) as aff
		
		
		
		
		

			UNION
			select 3311 as form_status_id, 3311 as form_status_stage_id, count(*) as num, '' as status, '' as stage
			from (select af.* from atif_gs_admission.view_process_flow as af 
				left join atif_gs_admission.log_form_status as lgs on af.id = lgs.admission_form_id 
				where (lgs.new_form_stage = 7) 
				and (lgs.new_form_status = 6) 
				group by af.id
			) as af


		#Complete Checks currently in Follow up
			UNION
			select 3322 as form_status_id, 3322 as form_status_stage_id, count(aff.Form_id) as num, '' as status, '' as stage
			from ( 
				
				
	



select (af.id) as Form_id
			from atif_gs_admission.admission_form as af
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id = af.id
			
			left JOIN  atif_fee_student.fee_bill as fb
			ON af.form_no = mid(fb.gb_id, 6, 4)
			AND fb.academic_session_id >= 11
			AND fb.record_deleted = 0
			AND fb.gb_id like '18%'
			AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

			left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
			where 
			af.form_status_id = 5 and " . $WhereFull . "

			and ( fbr.received_amount is null )
			and af.form_status_stage_id not in(6,7,8,9,10,12,13,14,15,16,17) 
			and fo.signed_offer_letter=1 and fo.offer_pack_handover=1
			
			and af.offer_date < curdate() 

and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )

						
				
				
			) as aff
			
			
			#Complete Checks currently in Follow up ( Red )
			UNION
			select 3321 as form_status_id, 3321 as form_status_stage_id, count(aff.Form_id) as num, '' as status, '' as stage
			from ( 
				
				
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as fo
				on fo.admission_form_id = af.id
				
				left JOIN  atif_fee_student.fee_bill as fb
ON af.form_no = mid(fb.gb_id, 6, 4)
AND fb.academic_session_id >= 11
AND fb.record_deleted = 0
AND fb.gb_id like '18%'
AND LENGTH(fb.gb_id) = 10 AND LEFT(fb.gb_id, 2) != '17'

left JOIN atif_fee_student.fee_bill_received as fbr ON fbr.fee_bill_id = fb.id
where 
af.form_status_id = 5 and " . $WhereFull . "

and ( fbr.received_amount is null )
and af.form_status_stage_id not in(6,7,8,9,10,12,13,14,15,16,17) 
and fo.signed_offer_letter=1 and fo.offer_pack_handover=1
and af.offer_date < curdate()
and (  case 
				when (af.grade_id = 15 or af.grade_id=16)
				then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
				else true
				end )

and from_unixtime(af.modified, '%Y-%m-%d') <  (curdate() - INTERVAL 3 day )
				
			) as aff



			#not interested in complete check list
			UNION
			select 1987 as form_status_id, 1987 as form_status_stage_id, count(af.id) as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			left join atif_gs_admission.admission_form_offer as fo
			on fo.admission_form_id=af.id
			where af.form_status_id=5
			and af.form_status_stage_id=7
			and fo.signed_offer_letter=1 and fo.offer_pack_handover=1
			and ( fo.completed_fif_form=1 or fo.signed_hand_book=1) and " . $WhereFull . "
			
			




			UNION
			select 1111 as form_status_id, 1111 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_stage_id = 7 and ".$WhereFull."

			UNION
			select 2222 as form_status_id, 2222 as form_status_stage_id, count(af.id)as num, '' as status, '' as stage
			from atif_gs_admission.admission_form as af 
			where af.form_status_id = 6 
			#and af.form_status_stage_id=1  
			and " . $WhereFull . "

					
			#Total Regretted
			UNION
			select 3333 as form_status_id, 3333 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
			select (af.id) as Form_id
			from atif_gs_admission.admission_form as af
			where af.form_status_stage_id=15 and " .$WhereFull. "
			
			
			
			) as af	";




		// Start of A level admission queries
		$query .= " 
			#Total Regretted
			UNION
			select 3301 as form_status_id, 3301 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				where " .$WhereFull. " AND (af.form_discussion_criteria ='RAO') and af.form_status_stage_id = 2
			) as af 


			UNION
			select 3302 as form_status_id, 3302 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				where " .$WhereFull. " AND (af.form_discussion_criteria ='RAO') and af.form_status_stage_id = 2
			) as af 

			UNION
			select 3303 as form_status_id, 3303 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO') and af.form_status_stage_id = 2
			) as af 


			UNION
			select 3304 as form_status_id, 3304 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO')  and af.form_status_stage_id = 2
				and af.offer_date >= curdate()
				and (afo.early_admission_offer_letter=0 or afo.early_admission_offer_letter is null)
				and ( afo.early_admission_print_fee_bill=0 or  afo.early_admission_print_fee_bill is null )
				

				union

				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO') and af.form_status_stage_id = 2
				and af.offer_date >= curdate()
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1  )

				and ( afo.early_admission_signed_offer_letter=0 )
				and (afo.early_admission_offer_pack_handover=0)
				

			) as af 

			UNION
			select 3305 as form_status_id, 3305 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage 
			from ( select (af.id) as Form_id 
				/*from atif_gs_admission.log_form_status as fs where fs.new_form_status=5 and fs.new_form_stage=19 group by fs.admission_form_id*/

				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO')  and af.form_status_stage_id = 2
				and (afo.early_admission_offer_letter=1)
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1)
				

			) as af 

			# In EAO Procedure
			UNION
			select 3306 as form_status_id, 3306 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')

				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)

				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO')
				and af.form_status_stage_id=2
				
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)
				

				and ( fbr.fee_bill_id is null) 
				and fb.bill_due_date >= curdate()
			
				
			

			) as af 

			UNION
			select 3307 as form_status_id, 3307 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')

				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)

				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO') and af.form_status_stage_id = 2
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)

				and ( fbr.fee_bill_id is not null) 

				



			) as af 

			# EAO  Currently in Followup
			UNION
			select 3308 as form_status_id, 3308 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
			

				
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO')  and af.form_status_stage_id = 2
				and af.offer_date < curdate()
				and (afo.early_admission_offer_letter=0 or afo.early_admission_offer_letter is null)
				and ( afo.early_admission_print_fee_bill=0 or  afo.early_admission_print_fee_bill is null )
				

				union

				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO') and af.form_status_stage_id = 2
				and af.offer_date < curdate()
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1  )

				and ( afo.early_admission_signed_offer_letter=0 )
				and (afo.early_admission_offer_pack_handover=0)
			


			) as af 

 

			# Post Result Verification Approval
			UNION
			select 3309 as form_status_id, 3309 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')

				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)

				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO')
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)

				and ( fbr.fee_bill_id is not null) 
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				
				union 

				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where ( af.grade_id=15 or af.grade_id=16) 
				and (af.form_discussion_criteria ='RAO') 
				and af.form_status_stage_id = 2 
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				
				
				) as af 


			
		UNION
			select 3310 as form_status_id, 3310 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no 
				AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')

				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)

				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO')
				and af.form_status_stage_id=2
				
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)
				
				and ( fbr.fee_bill_id is null) 
				and fb.bill_due_date < curdate()
			) as af 

			# Currently Extensions in EAO Preparations
			UNION
			select 3101 as form_status_id, 3101 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO')  and af.form_status_stage_id = 10
				and af.offer_date >= curdate()
				and (afo.early_admission_offer_letter=0 or afo.early_admission_offer_letter is null)
				and ( afo.early_admission_print_fee_bill=0 or  afo.early_admission_print_fee_bill is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )

				
			) as af 

			# Overall Extensions at EAO Preparations
			UNION
			select 3102 as form_status_id, 3102 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				left join atif_gs_admission.log_form_status as ls
				on ls.admission_form_id = af.id
				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO')  
				and (afo.early_admission_offer_letter=0 or afo.early_admission_offer_letter is null)
				and ( afo.early_admission_print_fee_bill=0 or  afo.early_admission_print_fee_bill is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and ls.new_form_status=5 and ls.new_form_stage = 10

				
			) as af 


			# Overall Not Interested at EAO Preparations
			UNION
			select 3103 as form_status_id, 3103 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				left join atif_gs_admission.log_form_status as ls
				on ls.admission_form_id = af.id
				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO')  
				and (afo.early_admission_offer_letter=0 or afo.early_admission_offer_letter is null)
				and ( afo.early_admission_print_fee_bill=0 or  afo.early_admission_print_fee_bill is null )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and ls.new_form_status=5 and ls.new_form_stage = 7

				
			) as af 


			# Overall Extensions EAO Procedure fee bill extension
			UNION
			select 3104 as form_status_id, 3104 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id

				left join atif_gs_admission.log_form_status as ls	on ls.admission_form_id = af.id
				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO')
				and (afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1)
				and ( afo.early_admission_signed_offer_letter=1 )
				and (afo.early_admission_offer_pack_handover=1)
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and ls.new_form_status=5 
				and ls.new_form_stage = 10
			) as af 


			# Currently Extensions EAO Procedure fee bill extension
			UNION
			select 3105 as form_status_id, 3105 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				left join atif_gs_admission.log_form_status as ls	on ls.admission_form_id = af.id
				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO')
				and ( afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1 )
				and ( afo.early_admission_signed_offer_letter=1 )
				and ( afo.early_admission_offer_pack_handover=1 )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and af.form_status_stage_id=10
			) as af 



			# Move To Final Admission Offer
			UNION
			select 3106 as form_status_id, 3106 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no 
				AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')
				left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)
				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO')
				and ( afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1 )
				and ( afo.early_admission_signed_offer_letter=1 )
				and ( afo.early_admission_offer_pack_handover=1 )
				and (afo.post_result_verification_approval = 1  )
				and ( fbr.fee_bill_id is not null) 
				and fbr.received_amount > 0
				
			) as af 



				# Currently Not Interested EAO Procedure 
			UNION
			select 3107 as form_status_id, 3107 as form_status_stage_id, count(af.Form_id) as num, '' as status, '' as stage
			from ( 
				select (af.id) as Form_id
				from atif_gs_admission.admission_form as af
				left join atif_gs_admission.admission_form_offer as afo
				on afo.admission_form_id = af.id
				left join atif_gs_admission.log_form_status as ls	on ls.admission_form_id = af.id
				where " .$WhereFull. " AND (af.form_discussion_criteria ='EAO')
				and ( afo.early_admission_offer_letter=1 )
				and ( afo.early_admission_print_fee_bill=1 )
				and ( afo.early_admission_signed_offer_letter=1 )
				and ( afo.early_admission_offer_pack_handover=1 )
				and (afo.post_result_verification_approval = 0 or afo.post_result_verification_approval is null )
				and af.form_status_stage_id=7
			) as af 



			";

			
			
			
			
			
			
			
			
			
		}
		
		#print_r($query); exit;
		

		$result = $this->dbad->query($query);
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{
			return FALSE;
		}
	}
}