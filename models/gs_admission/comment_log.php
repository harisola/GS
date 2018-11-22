<?php
class Comment_log extends CI_Model{
	private $ddb;
	function __construct(){ parent::__construct(); }
	
	public function get_log($form_id){
		
		$this->ddb = $this->load->database('gs_admission',TRUE);
		
			$query = "

   SELECT * FROM
         (
         /************************************************* Form Issuance
         *****************************************************************/
         select
         af.id as admission_form_id, FROM_UNIXTIME(af.created) as change_date, 


         '' as reason,

         if( b.batch_category != '',
         
         CONCAT('Admission form issued', ' on <strong>', DATE_FORMAT((`b`.`date`), '%a, %b %e, %Y'), ' </strong> at <strong> ', 
         time_format(`b`.`time_start`, '%h:%i %p' ) ,

         ' </strong> and allocated to <strong> Batch ', b.batch_category ,'</strong>' ) 
         ,
         CONCAT('Admission form issued', ' on <strong>', DATE_FORMAT(FROM_UNIXTIME(af.created), '%a, %b %e, %Y %h:%i %p'), ' </strong> with next step <strong> TBI </strong> ' )
         ) as message,
         'Additional Comments'  as Additional_Comments,
         'Issuance' as type, 
         sr.employee_id as photo_id, 
         sr.abridged_name as staff_name, 
         sr.user_id as user_id, 
         1 as this_order
         from atif_gs_admission.admission_form as af
         left join atif.staff_registered as sr on sr.user_id = af.register_by
         
         left join atif_gs_admission.log_form_batch as bb on bb.admission_form_id= af.id 
         and bb.old_form_batch=0 
         left join atif_gs_admission._form_batch as b on b.id=bb.new_form_batch 
         where af.id = ".$form_id." /***** Change Form ID *****/
         
         UNION
         select
         lgs.admission_form_id, 
         from_unixtime(lgs.modified) as change_date, 
         '' as reason,
         if( old_batch.batch_category != '',
      
      CONCAT( ' Admission form ', fst_new.name_code , ' on ', DATE_FORMAT((af.form_submission_date), '%a, %b %e, %Y %h:%i %p'), ' for batch  ', old_batch.batch_category ) 
      ,
      CONCAT( ' Admission form ', fst_new.name_code , ' on ', DATE_FORMAT((af.form_submission_date), '%a, %b %e, %Y %h:%i %p')) 
      )
      as message,
if( af.comments !='',
CONCAT('<br /><strong>Additional Comments: </strong> ', af.comments ),'') as Additional_Comments,


         'Status' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 
         sr.user_id as user_id, 3 as this_order

         from atif_gs_admission.log_form_status as lgs
         left join atif_gs_admission._form_status as fst_old on fst_old.id = lgs.old_form_status
         left join atif_gs_admission._form_status as fst_new on fst_new.id = lgs.new_form_status
         left join atif.staff_registered as sr on sr.user_id = lgs.modified_by

         left join atif_gs_admission.log_form_batch as  bb
 on bb.admission_form_id = lgs.admission_form_id and bb.old_form_batch = 1
 
 

  

left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
left join atif_gs_admission._form_batch as old_batch on old_batch.id = bb.new_form_batch







         where lgs.admission_form_id = ".$form_id." /***** Change Form ID *****/    
         and lgs.type = 'S' and lgs.old_form_status=1 and lgs.new_form_status=2
         group by lgs.admission_form_id

         UNION


         /************************************ Communication - Assessment
         *****************************************************************/
         select
         lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, '' as reason,
         CONCAT('Communication of Assessment on ', DATE_FORMAT((af.form_assessment_date), '%d-%b-%Y %h:%i %p')) as message,
         '' as Additional_Comments,
         'Stage' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 
         sr.user_id as user_id, 4 as this_order

         from atif_gs_admission.log_form_status as lgs
         left join atif_gs_admission._form_status_stage as fst_old on fst_old.id = lgs.new_form_stage
         left join atif_gs_admission._form_status_stage as fst_new on fst_new.id = lgs.new_form_stage
         left join atif.staff_registered as sr on sr.user_id = lgs.modified_by

		left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
		where lgs.admission_form_id = ".$form_id." 
        and lgs.new_form_status = 2 and lgs.new_form_stage = 2
         group by admission_form_id


         /***************************************** Presence - Assessment
         *****************************************************************/

         /*UNION
		 select
         lgs.admission_form_id,  from_unixtime(lgs.modified) as change_date, '' as reason,
         CONCAT('Presence of Assessment on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,
         '' as Additional_Comments,
         'Stage' as type, sr.employee_id as photo_id, sr.abridged_name as staff_name, 
         sr.user_id as user_id, 5 as this_order

         from atif_gs_admission.log_form_status as lgs

         left join atif_gs_admission._form_status_stage as fst_old
            on fst_old.id = lgs.new_form_stage

         left join atif_gs_admission._form_status_stage as fst_new
            on fst_new.id = lgs.new_form_stage
         left join atif.staff_registered as sr
            on sr.user_id = lgs.modified_by

        left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
         where lgs.admission_form_id = ".$form_id." 
         and lgs.new_form_status = 3 and lgs.new_form_stage = 4
         group by admission_form_id */


         



         /************************************************* Form Comments
         *****************************************************************/
		union
         select
         com.admission_form_id, FROM_UNIXTIME(com.created) as change_date, 

         IF(com.reason = '', '', CONCAT(com.reason, ' on ', DATE_FORMAT(FROM_UNIXTIME(com.created), '%a %d, %b %Y %h:%i %p'))) as reason,

         com.comments as message, 


         '' as Additional_Comments,

         'Comments' as type,
         if(sr.employee_id='298', 'gs_logo', sr.employee_id) as photo_id, sr.abridged_name as staff_name, 
         sr.user_id as user_id, 6 as this_order

         from atif_gs_admission.log_form_comments as com
         left join atif.staff_registered as sr
            on sr.user_id = com.register_by
                
         where com.admission_form_id = ".$form_id." and com.register_by=1 


         /***** Change Form ID *****/   


/************************************************* Batch changed
         *****************************************************************/

         union 

         select
         lgs.admission_form_id,  
         from_unixtime(lgs.modified) as change_date, 
         '' as reason,
                  CONCAT('Batch changed to from ',
                  old_batch.batch_category, 
                  ' to ', new_batch.batch_category, 
                  
                  
                  ' on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,


                  '' as Additional_Comments,

                  'Status' as type, 
                  sr1.employee_id as photo_id, 
                  sr1.abridged_name as staff_name, 
                  sr1.user_id as user_id, 
                  7 as this_order
         from atif_gs_admission.log_form_batch as lgs 

         left join atif_gs_admission._form_batch as old_batch 
         on old_batch.id = lgs.old_form_batch
         left join atif.staff_registered as sr1 on  
         sr1.user_id  = lgs.modified_by

         left join atif_gs_admission._form_batch as new_batch 
         on new_batch.id = lgs.new_form_batch





         where lgs.register_by != 0 and lgs.admission_form_id=".$form_id." 
         and lgs.old_form_batch > 1


         union

         select
         lgs.admission_form_id,  
         from_unixtime(lgs.modified) as change_date, 
         '' as reason,
                  CONCAT('Batch Reallocated to ', new_batch.batch_category, 
                  
                  
                  ' on ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p')) as message,


                  '' as Additional_Comments,

                  'Status' as type, 
                  sr1.employee_id as photo_id, 
                  sr1.abridged_name as staff_name, 
                  sr1.user_id as user_id, 
                  8 as this_order
         from atif_gs_admission.log_form_batch as lgs 

         left join atif_gs_admission._form_batch as old_batch 
         on old_batch.id = lgs.old_form_batch
         left join atif.staff_registered as sr1 on  
         sr1.user_id  = lgs.modified_by

         left join atif_gs_admission._form_batch as new_batch on new_batch.id = lgs.new_form_batch

         left join (
         select * from atif_gs_admission.log_form_status as lg 
         where lg.new_form_status < 4 
         #lg.new_form_stage < 3 this condition for both Issuance and Submission
         and lg.`type`='S' 
         ) as lg
         on lg.admission_form_id=lgs.admission_form_id
         
         where lgs.register_by != 0
         and lgs.admission_form_id=".$form_id." 
         and lgs.old_form_batch > 1   and lg.id is not null
         



#Not Response on Submission
union
select
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.modified) as change_date, 
'No Response'  as reason,
CONCAT
('<strong> No Response </strong> on calling the Applicant for <strong> Submission and Assessment </strong>'
) as message,
CONCAT('<strong> Additional Comments : </strong> ', c.comments ) as Additional_Comments,
'Comments' as type, 
sr.employee_id as photo_id, sr.abridged_name as staff_name, sr.user_id as user_id, 9 as this_order
from atif_gs_admission.log_form_status as lgs 
left join atif_gs_admission.admission_form as af on af.id=lgs.admission_form_id
left join atif_Gs_admission.log_form_comments as c 
on c.admission_form_id = lgs.admission_form_id and c.reason='NR'
left join atif.staff_registered as sr on sr.user_id = lgs.register_by
where 
lgs.admission_form_id=".$form_id."
and lgs.new_form_status=2 
and lgs.new_form_stage=11


#Not Interested on Submission
union
select
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.modified) as change_date, 
'No Response'  as reason,
CONCAT
('<strong>  Not Interested </strong> for <strong> Submission and Assessment </strong>'
) as message,

CONCAT('<strong> Additional Comments : </strong> ', c.comments ) as Additional_Comments,
'Comments' as type, 
sr.employee_id as photo_id, sr.abridged_name as staff_name, sr.user_id as user_id, 10 as this_order
from atif_gs_admission.log_form_status as lgs 
left join atif_gs_admission.admission_form as af on af.id=lgs.admission_form_id
left join atif_Gs_admission.log_form_comments as c 
on c.admission_form_id = lgs.admission_form_id and c.reason='NI'
left join atif.staff_registered as sr on sr.user_id = lgs.register_by
where 
lgs.admission_form_id=".$form_id."
and lgs.new_form_status=2 
and lgs.new_form_stage=7



union 
select  
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(c.created) as change_date, 
'Extension'  as reason,
CONCAT('<strong> Extension </strong>  for <strong> Submission and Assessment </strong> on ', DATE_FORMAT(FROM_UNIXTIME(c.created), '%d-%b-%Y %h:%i %p'),' Reallocated to batch: ', new_batch.batch_category )  as message,
CONCAT
('<strong> Additional Comments : </strong> ', c.comments)  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
 11 as this_order    
from atif_gs_admission.log_form_status as lgs 
left join atif_gs_admission.admission_form as af on af.id=lgs.admission_form_id
left join atif_Gs_admission.log_form_comments as c on c.admission_form_id = lgs.admission_form_id and c.reason='Ext'

left join atif_gs_admission.log_form_batch as  bb
 on bb.admission_form_id = lgs.admission_form_id and bb.old_form_batch != 1

left join atif_gs_admission._form_batch as old_batch on old_batch.id = bb.old_form_batch
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by

left join atif_gs_admission._form_batch as new_batch on new_batch.id = bb.new_form_batch
            
where 
lgs.admission_form_id=".$form_id."
and lgs.new_form_status=2 
and lgs.new_form_stage=10 


union 
select  
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.modified) as change_date, 
''  as reason,
CONCAT('Marked as Present for Assessment ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p'))  as message,
''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
12 as this_order     
from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id   
where 
lgs.admission_form_id=".$form_id."
and lgs.new_form_status=3
and lgs.new_form_stage=4 
#and af.grade_id = 17 and af.grade_id = 1 and af.grade_id = 2


union 
select  
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.modified) as change_date, 
''  as reason,
CONCAT('Marked as Present for <strong> Discussion </strong>', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p'))  as message,
''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
10  as this_order    
from atif_gs_admission.log_form_status as lgs 

left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id   
where 
lgs.admission_form_id=".$form_id."
and lgs.new_form_status=4
and lgs.new_form_stage=4 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2
         


union

select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,

CONCAT(' Assessment done by  ',  
srr4.abridged_name, ' with <strong> (', af.form_assessment_result, ') 
</strong> grade <br />',DATE_FORMAT(FROM_UNIXTIME(lgs.created), '%d-%b-%Y %h:%i %p'))  as message,


''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
13  as this_order 
from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
left join atif.staff_registered as srr4 on srr4.id = af.form_assessment_result_by
where  lgs.admission_form_id=".$form_id." and  lgs.new_form_status=3 and  lgs.new_form_stage=4 
and af.grade_id = 17 and af.grade_id = 1 and af.grade_id = 2
group by af.id

union
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,

if( af.form_assessment_decision = 'RGT' or af.form_assessment_decision = 'OHD' or af.form_assessment_decision = 'WIL',

CONCAT(' Assessment done by  ',  
srr4.abridged_name, ' with <strong> (', af.form_assessment_result, ') 
</strong> grade <br /> Next step decision <strong> (', af.form_assessment_decision, ' )</strong>')  

,

CONCAT(' Assessment done by  ',  
srr4.abridged_name, ' with <strong> (', af.form_assessment_result, ') 
</strong> grade <br /> Next step decision <strong> (', af.form_assessment_decision, ' ) </strong>', ' on ',
if(af.form_discussion_date != '0000-00-00',
DATE_FORMAT(af.form_discussion_date, '%d-%b-%Y %h:%i %p'),
'' ),DATE_FORMAT(FROM_UNIXTIME(lgs.created), '%d-%b-%Y %h:%i %p'))

) as message,



''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
14  as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
left join atif.staff_registered as srr4 on srr4.id = af.form_assessment_result_by
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=3 and lgs.new_form_stage=4 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2
group by af.id



union 
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' Moved to Communication. Applicant to appear for Discussion on ', DATE_FORMAT((af.form_discussion_date), '%d-%b-%Y %h:%i %p') )as message,

''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
15  as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=3 and lgs.new_form_stage=13 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2
group by af.id


union 
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' Communicated for <strong> Discussion </strong> on ', DATE_FORMAT((af.form_discussion_date), '%d-%b-%Y %h:%i %p') )as message,

''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
16  as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=4 and lgs.new_form_stage=1 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2


union 
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT('<strong> No Response </strong>  on calling the Applicant for <strong> Discussion </strong> on ', DATE_FORMAT((af.form_discussion_date), '%d-%b-%Y %h:%i %p') )as message,

''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
17  as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=4 and lgs.new_form_stage=11 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2


union 
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' Applicant moved to <strong> Not Interested  </strong>  for <strong> Discussion </strong> on ', DATE_FORMAT((af.form_discussion_date), '%d-%b-%Y %h:%i %p') )as message,

''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
18  as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=4 and lgs.new_form_stage=7 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2




union 
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' <strong> Extension </strong>for <strong> Dicussion </strong> till ', DATE_FORMAT((af.form_discussion_date), '%d-%b-%Y %h:%i %p') )as message,

''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
19  as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=4 and lgs.new_form_stage=10 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2


union
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
if( af.form_discussion_decision = 'RGT' or af.form_discussion_decision = 'OHD' or af.form_discussion_decision = 'WIL',
CONCAT(' Discussion done by  ',  
srr4.abridged_name, ' with <strong> (', af.form_discussion_result, ') 
</strong> grade <br /> Next step decision <strong> (', af.form_discussion_decision, ' )</strong>')  
,
CONCAT(' Discussion done by  ',  
srr4.abridged_name, ' with <strong> (', af.form_discussion_result, ') 
</strong> grade <br /> Next step decision <strong> (', af.form_discussion_decision, ' ) </strong>', ' on ',
if(af.form_discussion_date != '0000-00-00',
DATE_FORMAT(af.form_discussion_date, '%d-%b-%Y %h:%i %p'),
'' ),DATE_FORMAT(FROM_UNIXTIME(lgs.created), '%d-%b-%Y %h:%i %p'))
) as message,
''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
20  as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
left join atif.staff_registered as srr4 on srr4.id = af.form_assessment_result_by
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=4 and lgs.new_form_stage=4 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2



/* start Reassessment and rediscussion */


union 
select  
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.modified) as change_date, 
''  as reason,
CONCAT('Marked as Present for ReAssessment ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p'))  as message,
''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
 21 as this_order    
from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id   
where 
lgs.admission_form_id=".$form_id."
and lgs.new_form_status=8
and lgs.new_form_stage=4 
#and af.grade_id = 17 and af.grade_id = 1 and af.grade_id = 2


union 
select  
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.modified) as change_date, 
''  as reason,
CONCAT('Marked as Present for ReDiscussion ', DATE_FORMAT(FROM_UNIXTIME(lgs.modified), '%d-%b-%Y %h:%i %p'))  as message,
''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
22  as this_order    
from atif_gs_admission.log_form_status as lgs 

left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id   
where 
lgs.admission_form_id=".$form_id."
and lgs.new_form_status=9
and lgs.new_form_stage=4 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2
         


union

select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,

CONCAT(' ReAssessment done by  ',  
srr4.abridged_name, ' with <strong> (', af.form_assessment_result, ') 
</strong> grade <br />',DATE_FORMAT(FROM_UNIXTIME(lgs.created), '%d-%b-%Y %h:%i %p'))  as message,


''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
23  as this_order 
from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
left join atif.staff_registered as srr4 on srr4.id = af.form_assessment_result_by
where  lgs.admission_form_id=".$form_id." and  lgs.new_form_status=3 and  lgs.new_form_stage=4 
and af.grade_id = 17 and af.grade_id = 1 and af.grade_id = 2
group by af.id

union
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,

if( af.form_assessment_decision = 'RGT' or af.form_assessment_decision = 'OHD' or af.form_assessment_decision = 'WIL',

CONCAT(' ReAssessment done by  ',  
srr4.abridged_name, ' with <strong> (', af.form_assessment_result, ') 
</strong> grade <br /> Next step decision <strong> (', af.form_assessment_decision, ' )</strong>')  

,

CONCAT(' ReAssessment done by  ',  
srr4.abridged_name, ' with <strong> (', af.form_assessment_result, ') 
</strong> grade <br /> Next step decision <strong> (', af.form_assessment_decision, ' ) </strong>', ' on ',
if(af.form_discussion_date != '0000-00-00',
DATE_FORMAT(af.form_discussion_date, '%d-%b-%Y %h:%i %p'),
'' ),DATE_FORMAT(FROM_UNIXTIME(lgs.created), '%d-%b-%Y %h:%i %p'))

) as message,

''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
24  as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
left join atif.staff_registered as srr4 on srr4.id = af.form_assessment_result_by
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=8 and lgs.new_form_stage=4 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2
group by af.id



union 
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' Moved to Communication. Applicant to appear for ReDiscussion on ', DATE_FORMAT((af.form_discussion_date), '%d-%b-%Y %h:%i %p') )as message,

''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id, 
25  as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=8 and lgs.new_form_stage=13 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2
group by af.id


union 
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' Communicated for <strong> ReDiscussion </strong> on ', DATE_FORMAT((af.form_discussion_date), '%d-%b-%Y %h:%i %p') )as message,

''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
26  as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=9 and lgs.new_form_stage=1 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2


union 
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT('<strong> No Response </strong>  on calling the Applicant for <strong> ReDiscussion </strong> on ', DATE_FORMAT((af.form_discussion_date), '%d-%b-%Y %h:%i %p') )as message,

''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
27  as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=9 and lgs.new_form_stage=11 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2


union 
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' Applicant moved to <strong> Not Interested  </strong>  for <strong> ReDiscussion </strong> on ', DATE_FORMAT((af.form_discussion_date), '%d-%b-%Y %h:%i %p') )as message,

''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
28  as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=9 and lgs.new_form_stage=7 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2




union 
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' <strong> Extension </strong>for <strong> ReDicussion </strong> till ', DATE_FORMAT((af.form_discussion_date), '%d-%b-%Y %h:%i %p') )as message,

''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
29  as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=9 and lgs.new_form_stage=10 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2


union
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
if( af.form_discussion_decision = 'RGT' or af.form_discussion_decision = 'OHD' or af.form_discussion_decision = 'WIL',
CONCAT(' ReDiscussion done by  ',  
srr4.abridged_name, ' with <strong> (', af.form_discussion_result, ') 
</strong> grade <br /> Next step decision <strong> (', af.form_discussion_decision, ' )</strong>')  
,
CONCAT(' ReDiscussion done by  ',  
srr4.abridged_name, ' with <strong> (', af.form_discussion_result, ') 
</strong> grade <br /> Next step decision <strong> (', af.form_discussion_decision, ' ) </strong>', ' on ',
if(af.form_discussion_date != '0000-00-00',
DATE_FORMAT(af.form_discussion_date, '%d-%b-%Y %h:%i %p'),
'' ),DATE_FORMAT(FROM_UNIXTIME(lgs.created), '%d-%b-%Y %h:%i %p'))
) as message,
''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
30  as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
left join atif.staff_registered as srr4 on srr4.id = af.form_assessment_result_by
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=9 and lgs.new_form_stage=4 
and af.grade_id != 17 and af.grade_id != 1 and af.grade_id != 2

/*End Reassessment and rediscussion*/


union
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' Moved to Communication. Applicant to appear for Offer pack on  ',
DATE_FORMAT((af.offer_date), '%d-%b-%Y %h:%i %p')
) as message,
''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
31  as this_order
from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
left join atif.staff_registered as srr4 on srr4.id = af.form_assessment_result_by
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=5 and lgs.new_form_stage=2 

union
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT( ' Communicated for Offer.' ) as message,
''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
32  as this_order
from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
left join atif.staff_registered as srr4 on srr4.id = af.form_assessment_result_by
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=5 and lgs.new_form_stage=3 

union
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' Moved to Followup on ', DATE_FORMAT(FROM_UNIXTIME(lgs.created), '%d-%b-%Y %h:%i %p'), ' <strong> Offer </strong> ' ) as message,
''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
33  as this_order
from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
left join atif.staff_registered as srr4 on srr4.id = af.form_assessment_result_by
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=5  and
 ( lgs.new_form_stage=5
  or lgs.new_form_stage=7
   or lgs.new_form_stage=10
    or  lgs.new_form_stage=11 ) 

union
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' Moved to Followup on ', DATE_FORMAT(FROM_UNIXTIME(lgs.created), '%d-%b-%Y %h:%i %p'), ' from <strong> Submission and Assessment </strong> ' ) as message,
''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
34 as this_order
from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
left join atif.staff_registered as srr4 on srr4.id = af.form_assessment_result_by
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=2  and
 ( lgs.new_form_stage=5
  or lgs.new_form_stage=7
   or lgs.new_form_stage=10
    or  lgs.new_form_stage=11 ) 



    union
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' Moved to Followup on ', DATE_FORMAT(FROM_UNIXTIME(lgs.created), '%d-%b-%Y %h:%i %p'), ' for <strong> Discussion </strong> ' ) as message,
''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
 35 as this_order
from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
left join atif.staff_registered as srr4 on srr4.id = af.form_assessment_result_by
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=4  and
 ( lgs.new_form_stage=5
  or lgs.new_form_stage=7
   or lgs.new_form_stage=10
    or  lgs.new_form_stage=11 ) 


    union 
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' <strong> No Response  </strong> on calling the Applicant for <strong> Offer </strong> ', 
   DATE_FORMAT( FROM_UNIXTIME(lgs.created), '%d-%b-%Y %h:%i %p') 
 ) as message,

''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
36  as this_order
from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=5 and lgs.new_form_stage=11 


union 
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' Applicant moved to <strong> Not Interested  </strong>  for <strong> Offer </strong> on ', DATE_FORMAT( FROM_UNIXTIME(lgs.created), '%d-%b-%Y %h:%i %p'), ' ',
if( com.reason != '', com.reason, '' ) 
)as message,

''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
37 as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id


left join ( select * from atif_gs_admission.log_form_comments as l where (l.reason like '%offer%' or 
l.reason like '%OFR%') and l.register_by > 1 ) as com
on com.admission_form_id = af.id


where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=5 and lgs.new_form_stage=7 





union 
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' <strong> Extension </strong>for <strong> Offer ', DATE_FORMAT((af.offer_date), '%d-%b-%Y %h:%i %p'), ' </strong> ', if( com.reason != '', com.reason, '' ) 


)as message,

''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
38  as this_order

from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id

left join ( select * from atif_gs_admission.log_form_comments as l where (l.reason like '%offer%' or 
l.reason like '%OFR%') and l.register_by > 1 ) as com
on com.admission_form_id = af.id

where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=5 and lgs.new_form_stage=10 



union 
select 
lgs.admission_form_id as admission_form_id, 
FROM_UNIXTIME(lgs.created) as change_date, 
''  as reason,
CONCAT(' <strong> Offer </strong>', fst_new.name  ) as message,

''  as Additional_Comments,
'Comments' as type, 
srr3.employee_id as photo_id, 
srr3.abridged_name as staff_name, 
srr3.user_id as user_id,
39  as this_order
from atif_gs_admission.log_form_status as lgs 
left join atif.staff_registered as srr3 on srr3.user_id = lgs.register_by
left join atif_gs_admission.admission_form as af on af.id = lgs.admission_form_id
left join atif_gs_admission._form_status_stage as fst_new on fst_new.id = lgs.new_form_stage
where 
lgs.admission_form_id=".$form_id." and 
lgs.new_form_status=5 

 and
  lgs.new_form_stage !=5
  and lgs.new_form_stage!=7
   and lgs.new_form_stage!=10
    and  lgs.new_form_stage!=11  
    
    and lgs.new_form_stage!=1
    and lgs.new_form_stage!=2
    and lgs.new_form_stage!=3


) AS DATA  
order by admission_form_id, change_date;

";




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