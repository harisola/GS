<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admission_process_flow_xp extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('session');
    }


    public function index(){
        if($this->ion_auth->logged_in() == FALSE){
            redirect('welcome');
        }else{
            $this->load->model('gs_admission/process_flow_xp_model');
            $this->data['full'] = $this->process_flow_xp_model->getCount_IssuanceOfAll();
            
            $this->load->view('gs_files/header');
            $this->load->view('gs_files/main-nav');
            $this->load->view('gs_files/breadcrumb');
            
            $user_id = (int)$this->session->userdata("user_id");
            
            $this->load->view('gs_admission/process_flow/processflow_css');
            $this->load->view('gs_admission/process_flow/process_flow_xp');
        }
    }






    public function edit(){
        $html = '';



        $this->load->model('gs_admission/process_flow_xp_model');
        
        $gradeID = $this->input->post('gradeID');
        $gender = $this->input->post('gender');
        $batchID = $this->input->post('batch');



        $data['full'] = $this->process_flow_xp_model->getFullAdmissionInfo($gradeID, $batchID, $gender);






        /******************************** Declaring Variables *****/
        /**********************************************************/
        $ad_full_issuance = "-";
        $ad_full_issuance_statusID = 0;
        $ad_full_issuance_stageID = 0;

        $ad_full_issuanceExtentionCurrent = "-";
        $ad_full_issuanceExtentionCurrent_statusID = 0;
        $ad_full_issuanceExtentionCurrent_stageID = 0;
        $ad_full_issuanceExtentionCurrent_query = "";

        $ad_full_issuanceExtention = "-";
        $ad_full_issuanceExtention_statusID = 0;
        $ad_full_issuanceExtention_stageID = 0;
        $ad_full_issuanceExtention_query = "";



        $ad_full_submission = "-";
        $ad_full_submission_statusID = 0;
        $ad_full_submission_stageID = 0;
        $ad_full_submmision_query = "";

        $ad_full_submissionOffer = "-";
        $ad_full_submissionOffer_statusID = 0;
        $ad_full_submissionOffer_stageID = 0;
        $ad_full_submmisionOffer_query = "";

        $ad_full_submissionExtention = "-";
        $ad_full_submissionExtention_statusID = 0;
        $ad_full_submissionExtention_stageID = 0;
        $ad_full_submmisionExtention_query = "";

        $ad_full_submissionExtentionCurrent = "-";
        $ad_full_submissionExtentionCurrent_statusID = 0;
        $ad_full_submissionExtentionCurrent_stageID = 0;
        $ad_full_submmisionExtentionCurrent_query = "";

        $ad_full_submissionFollowup = "-";
        $ad_full_submissionFollowup_statusID = 0;
        $ad_full_submissionFollowup_stageID = 0;
        $ad_full_submmisionFollowup_query = "";

        $ad_full_submissionFollowupOver = "-";
        $ad_full_submissionFollowupOver_statusID = 0;
        $ad_full_submissionFollowupOver_stageID = 0;
        $ad_full_submmisionFollowupOver_query = "";

        $ad_full_submissionNotInterested_statusID = 0;
        $ad_full_submissionNotInterested_stageID = 0;
        $ad_full_submissionNotInterested = '-';
        $ad_full_submmisionNotInterested_query = "";




        $ad_full_submissionTBI = "-";
        $ad_full_submissionTBI_statusID = 0;
        $ad_full_submissionTBI_stageID = 0;
        $ad_full_submmisionTBI_query = "";

        $ad_full_submissionTBI_Current = "-";
        $ad_full_submissionTBI_Current_statusID = 0;
        $ad_full_submissionTBI_Current_stageID = 0;
        $ad_full_submmisionTBI_Current_query = "";







        $ad_full_assessment = "-";
        $ad_full_assessment_statusID = 0;
        $ad_full_assessment_stageID = 0;
        $ad_full_assessment_query = "";

        $ad_full_assessmentCurrent = "-";
        $ad_full_assessmentCurrent_statusID = 0;
        $ad_full_assessmentCurrent_stageID = 0;
        $ad_full_assessmentCurrent_query = "";

        $ad_full_assessmentPresence = "-";
        $ad_full_assessmentPresence_statusID = 0;
        $ad_full_assessmentPresence_stageID = 0;
        $ad_full_assessmentPresence_query = "";

        $ad_full_assessmentFollowup_statusID = 0;
        $ad_full_assessmentFollowup_stageID = 0;
        $ad_full_assessmentFollowup = '-';
        $ad_full_assessmentFollowup_query = "";

        $ad_full_assessmentFollowup_Current_statusID = 0;
        $ad_full_assessmentFollowup_Current_stageID = 0;
        $ad_full_assessmentFollowup_Current = '-';
        $ad_full_assessmentFollowup_Current_query = "";
        $ad_full_assessmentFollowup_CurrentOver_statusID = 0;
        $ad_full_assessmentFollowup_CurrentOver_stageID = 0;
        $ad_full_assessmentFollowup_CurrentOver = '-';
        $ad_full_assessmentFollowup_CurrentOver_query = "";

        $ad_full_assessmentExtention = "-";
        $ad_full_assessmentExtention_statusID = 0;
        $ad_full_assessmentExtention_stageID = 0;
        $ad_full_assessmentExtention_query = "";

        $ad_full_assessmentNotInterested = "-";
        $ad_full_assessmentNotInterested_statusID = 0;
        $ad_full_assessmentNotInterested_stageID = 0;
        $ad_full_assessmentNotInterested_query = "";

        $ad_full_assessmentToday = "-";
        $ad_full_assessmentToday_statusID = 0;
        $ad_full_assessmentToday_stageID = 0;
        $ad_full_assessmentToday_query = "";

        $ad_full_assessment_Onhold = "-";
        $ad_full_assessment_Onhold_statusID = 0;
        $ad_full_assessment_Onhold_stageID = 0;
        $ad_full_assessment_Onhold_query = "";

        $ad_full_assessment_OnholdOver = "-";
        $ad_full_assessment_OnholdOver_statusID = 0;
        $ad_full_assessment_OnholdOver_stageID = 0;
        $ad_full_assessment_OnholdOver_query = "";

        $ad_full_assessmentWaitlist = "-";
        $ad_full_assessmentWaitlist_statusID = 0;
        $ad_full_assessmentWaitlist_stageID = 0;
        $ad_full_assessmentWaitlist_query = "";

        $ad_full_assessment_Regret = "-";
        $ad_full_assessment_Regret_statusID = 0;
        $ad_full_assessment_Regret_stageID = 0;
        $ad_full_assessment_Regret_query = "";

        $ad_full_assessment_RegretPO = "-";
        $ad_full_assessment_RegretPO_statusID = 0;
        $ad_full_assessment_RegretPO_stageID = 0;
        $ad_full_assessment_RegretPO_query = "";

        $ad_full_assessment_Waitlist_Current = "-";
        $ad_full_assessment_Waitlist_Current_statusID = 0;
        $ad_full_assessment_Waitlist_Current_stageID = 0;
        $ad_full_assessment_Waitlist_Current_query = "";

        $ad_full_assessment_Waitlist_CurrentOver = "-";
        $ad_full_assessment_Waitlist_CurrentOver_statusID = 0;
        $ad_full_assessment_Waitlist_CurrentOver_stageID = 0;
        $ad_full_assessment_Waitlist_CurrentOver_query = "";

        $ad_full_assessment_AfterWaitlist = "-";
        $ad_full_assessment_AfterWaitlist_statusID = 0;
        $ad_full_assessment_AfterWaitlist_stageID = 0;
        $ad_full_assessment_AfterWaitlist_query = "";


        $ad_full_assessmentExtentionCurrent = "-";
        $ad_full_assessmentExtentionCurrent_statusID = 0;
        $ad_full_assessmentExtentionCurrent_stageID = 0;
        $ad_full_assessmentExtentionCurrent_query = "";












        $ad_full_discussion = "-";
        $ad_full_discussion_statusID = 0;
        $ad_full_discussion_stageID = 0;
        $ad_full_discussion_query = "";

        $ad_full_discussionPresence = "-";
        $ad_full_discussionPresence_statusID = 0;
        $ad_full_discussionPresence_stageID = 0;
        $ad_full_discussionPresence_query = "";

        $ad_full_discussion_Followup = "-";
        $ad_full_discussion_Followup_statusID = 0;
        $ad_full_discussion_Followup_stageID = 0;
        $ad_full_discussion_Followup_query = "";

        $ad_full_discussion_FollowupCurrent = "-";
        $ad_full_discussion_FollowupCurrent_statusID = 0;
        $ad_full_discussion_FollowupCurrent_stageID = 0;
        $ad_full_discussion_FollowupCurrent_query = "";

        $ad_full_discussion_FollowupCurrentOver = "-";
        $ad_full_discussion_FollowupCurrentOver_statusID = 0;
        $ad_full_discussion_FollowupCurrentOver_stageID = 0;
        $ad_full_discussion_FollowupCurrentOver_query = "";

        $ad_full_discussionNotInterested_statusID = 0;
        $ad_full_discussionNotInterested_stageID = 0;
        $ad_full_discussionNotInterested = '-';
        $ad_full_discussionNotInterested_query = "";

        $ad_full_discussionCurrent = "-";
        $ad_full_discussionCurrent_statusID = 0;
        $ad_full_discussionCurrent_stageID = 0;
        $ad_full_discussionCurrent_query = "";

        $ad_full_discussion_extention = "-";
        $ad_full_discussion_extention_statusID = 0;
        $ad_full_discussion_extention_stageID = 0;
        $ad_full_discussion_extention_query = "";
















        $ad_full_PO_ApprovalPending = "-";
        $ad_full_PO_ApprovalPending_statusID = 0;
        $ad_full_PO_ApprovalPending_stageID = 0;
        $ad_full_PO_ApprovalPending_query = "";

        $ad_full_PO_Approval = "-";
        $ad_full_PO_Approval_statusID = 0;
        $ad_full_PO_Approval_stageID = 0;
        $ad_full_PO_Approval_query = "";

        $ad_full_PO_onHold = "-";
        $ad_full_PO_onHold_statusID = 0;
        $ad_full_PO_onHold_stageID = 0;
        $ad_full_PO_onHold_query = "";

        $ad_full_PO_onHoldCurrent = "-";
        $ad_full_PO_onHoldCurrentstatusID = 0;
        $ad_full_PO_onHoldCurrent_stageID = 0;
        $ad_full_PO_onHoldCurrent_query = "";

        $ad_full_PO_Waitlist = "-";
        $ad_full_PO_Waitlist_statusID = 0;
        $ad_full_PO_Waitlist_stageID = 0;
        $ad_full_PO_Waitlist_query = "";

        $ad_full_PO_Regret = "-";
        $ad_full_PO_Regret_statusID = 0;
        $ad_full_PO_Regret_stageID = 0;
        $ad_full_PO_Regret_query = "";

        $ad_full_PO_Waitlist_to_Regret = "-";
        $ad_full_PO_Waitlist_to_Regret_statusID = 0;
        $ad_full_PO_Waitlist_to_Regret_stageID = 0;
        $ad_full_PO_Waitlist_to_Regret_query = "";

        $ad_full_PO_WaitlistCurrent = "-";
        $ad_full_PO_WaitlistCurrent_statusID = 0;
        $ad_full_PO_WaitlistCurrent_stageID = 0;
        $ad_full_PO_WaitlistCurrent_query = "";

        $ad_full_PO_WaitlistCurrentOver = "-";
        $ad_full_PO_WaitlistCurrentOver_statusID = 0;
        $ad_full_PO_WaitlistCurrentOver_stageID = 0;
        $ad_full_PO_WaitlistCurrentOver_query = "";

        $ad_full_PO_Waitlist_to_Offer = "-";
        $ad_full_PO_Waitlist_to_Offer_statusID = 0;
        $ad_full_PO_Waitlist_to_Offer_stageID = 0;
        $ad_full_PO_Waitlist_to_Offer_query = "";

        $ad_full_PO_RegretAPR = "-";
        $ad_full_PO_RegretAPR_statusID = 0;
        $ad_full_PO_RegretAPR_stageID = 0;
        $ad_full_PO_RegretAPR_query = "";















        $ad_full_offer = "-";
        $ad_full_offer_statusID = 0;
        $ad_full_offer_stageID = 0;
        $ad_full_offer_query = "";

        $ad_full_offerExtention = "-";
        $ad_full_offerExtention_statusID = 0;
        $ad_full_offerExtention_stageID = 0;
        $ad_full_offerExtention_query = "";

        $ad_full_offerFollowup = "-";
        $ad_full_offerFollowup_statusID = 0;
        $ad_full_offerFollowup_stageID = 0;
        $ad_full_offerFollowup_query = "";

        $ad_full_offerFollowupOver = "-";
        $ad_full_offerFollowupOver_statusID = 0;
        $ad_full_offerFollowupOver_stageID = 0;
        $ad_full_offerFollowupOver_query = "";

        $ad_full_offerShowedup = "-";
        $ad_full_offerShowedup_statusID = 0;
        $ad_full_offerShowedup_stageID = 0;
        $ad_full_offerShowedup_query = "";

        $ad_full_offerFollowup_ALL = "-";
        $ad_full_offerFollowup_ALL_statusID = 0;
        $ad_full_offerFollowup_ALL_stageID = 0;
        $ad_full_offerFollowup_ALL_query = "";

        $ad_full_offer_NotInterested = "-";
        $ad_full_offer_NotInterested_statusID = 0;
        $ad_full_offer_NotInterested_stageID = 0;
        $ad_full_offer_NotInterested_query = "";


        $ad_full_offered = "-";
        $ad_full_offered_statusID = 0;
        $ad_full_offered_stageID = 0;
        $ad_full_offered_query = "";










        $ad_total_NotInterested = "-";
        $ad_total_NotInterested_statusID = 0;
        $ad_total_NotInterested_stageID = 0;
        $ad_total_NotInterested_query = "";

        $ad_total_Regret = "-";
        $ad_total_Regret_statusID = 0;
        $ad_total_Regret_stageID = 0;
        $ad_total_Regret_query = "";

        $ad_total_Admission = "-";
        $ad_total_Admission_statusID = 0;
        $ad_total_Admission_stageID = 0;
        $ad_total_Admission_query = "";












        $ad_full_admissionFollowup_total = "-";
        $ad_full_admissionFollowup_total_statusID = 0;
        $ad_full_admissionFollowup_total_stageID = 0;
        $ad_full_admissionFollowup_total_query = "";

        $ad_full_admission_Followup = "-";
        $ad_full_admission_Followup_statusID = 0;
        $ad_full_admission_Followup_stageID = 0;
        $ad_full_admission_Followup_query = "(fb.student_id = 7060 and fb.bill_due_date < CURDATE())";

        $ad_full_admission_FollowupOver = "-";
        $ad_full_admission_FollowupOver_statusID = 0;
        $ad_full_admission_FollowupOver_stageID = 0;
        $ad_full_admission_FollowupOver_query = "";

        $ad_full_admissionNotInterested = "-";
        $ad_full_admissionNotInterested_statusID = 0;
        $ad_full_admissionNotInterested_stageID = 0;
        $ad_full_admissionNotInterested_query = "";

        $ad_full_admissionExtention = "-";
        $ad_full_admissionExtention_statusID = 0;
        $ad_full_admissionExtention_stageID = 0;
        $ad_full_admissionExtention_query = "";
        /********************** Declaring Variables - E N D - *****/




        /*********************************** Assigning Values *****/
        /**********************************************************/
        foreach ($data['full'] as $dd) {
            if($dd['form_status_id']==9999 && $dd['form_status_stage_id']==9999){
                $ad_full_issuance_statusID = 9900;
                $ad_full_issuance_stageID = 9900;
                $ad_full_issuance = $dd['num'];
            }
            if($dd['form_status_id']==9988 && $dd['form_status_stage_id']==9988){
                $ad_full_issuanceExtentionCurrent_statusID = 9900;
                $ad_full_issuanceExtentionCurrent_stageID = 9900;
                $ad_full_issuanceExtentionCurrent = $dd['num'];
                $ad_full_issuanceExtentionCurrent_query = "(af.form_assessment_date = '0000-00-00')";
            }
            if($dd['form_status_id']==9977 && $dd['form_status_stage_id']==9977){
                $ad_full_issuanceExtention_statusID = 9900;
                $ad_full_issuanceExtention_stageID = 9900;
                $ad_full_issuanceExtention = $dd['num'];
                $ad_full_issuanceExtention_query = "(af.form_assessment_date = '0000-00-00')";
            }




            if($dd['form_status_id']==8888 && $dd['form_status_stage_id']==8888){
                $ad_full_submission_statusID = 9900;
                $ad_full_submission_stageID = 9900;
                $ad_full_submission = $dd['num'];
                $ad_full_submmision_query = "af.form_assessment_date != '0000-00-00'";
            }  
            if($dd['form_status_id']==8899 && $dd['form_status_stage_id']==8899){
                $ad_full_submissionOffer_statusID = 9999;
                $ad_full_submissionOffer_stageID = 9999;
                $ad_full_submissionOffer = $dd['num'];
                $ad_full_submmisionOffer_query = "(lgs.new_form_stage = 5 or lgs.new_form_stage = 7
                or lgs.new_form_stage = 11 or lgs.new_form_stage = 14) and (lgs.new_form_status = 2)";
            }
            if($dd['form_status_id']==8877 && $dd['form_status_stage_id']==8877){
                $ad_full_submissionExtention_statusID = 9999;
                $ad_full_submissionExtention_stageID = 9999;
                $ad_full_submissionExtention = $dd['num'];
                $ad_full_submmisionExtention_query = "(lgs.new_form_stage = 10) and (lgs.new_form_status = 1)";
            }
            if($dd['form_status_id']==8866 && $dd['form_status_stage_id']==8866){
                $ad_full_submissionFollowup_statusID = 9900;
                $ad_full_submissionFollowup_stageID = 9900;
                $ad_full_submissionFollowup = $dd['num'];
                $ad_full_submmisionFollowup_query = "af.form_assessment_date = '0000-00-00'
                    and af.form_submission_date < CURDATE()
                    and af.form_status_stage_id != 7";
            }
            if($dd['form_status_id']==8867 && $dd['form_status_stage_id']==8867){
                $ad_full_submissionFollowupOver_statusID = 9999;
                $ad_full_submissionFollowupOver_stageID = 9999;
                $ad_full_submissionFollowupOver = $dd['num'];
                $ad_full_submmisionFollowupOver_query = "af.form_assessment_date = '0000-00-00'
                    and af.form_submission_date < CURDATE()-2
                    and af.form_status_stage_id != 7";
            }
            if($dd['form_status_id']==8855 && $dd['form_status_stage_id']==8855){
                $ad_full_submissionNotInterested_statusID = 9999;
                $ad_full_submissionNotInterested_stageID = 9999;
                $ad_full_submissionNotInterested = $dd['num'];
                $ad_full_submmisionNotInterested_query = "(lgs.new_form_stage = 7) and (lgs.new_form_status = 1)";
            }
            if($dd['form_status_id']==8844 && $dd['form_status_stage_id']==8844){
                $ad_full_submissionExtentionCurrent_statusID = 9900;
                $ad_full_submissionExtentionCurrent_stageID = 9900;
                $ad_full_submissionExtentionCurrent = $dd['num'];
                $ad_full_submissionExtentionCurrent_query = "(af.form_status_stage_id = 10 and af.form_status_id = 2)";
            }

            if($dd['form_status_id']==7799 && $dd['form_status_stage_id']==7799){
                $ad_full_submissionTBI_Current_statusID = 9900;
                $ad_full_submissionTBI_Current_stageID = 9900;
                $ad_full_submissionTBI_Current = $dd['num'];
                $ad_full_submmisionTBI_Current_query = "(af.form_assessment_date = '2001-01-01')";
            }








            if($dd['form_status_id']==7788 && $dd['form_status_stage_id']==7788){
                $ad_full_assessment_statusID = 9903;
                $ad_full_assessment_stageID = 9903;
                $ad_full_assessment = $dd['num'];
                $ad_full_assessment_query = "(lfa.old_assessment_date = '2001-01-01')";

                //$ad_full_submissionTBI = $ad_full_assessment - $ad_full_submissionTBI_Current;
            }
            if($dd['form_status_id']==7777 && $dd['form_status_stage_id']==7777){
                $ad_full_assessmentCurrent_statusID = 9900;
                $ad_full_assessmentCurrent_stageID = 9900;
                $ad_full_assessmentCurrent = $dd['num'];
                $ad_full_assessmentCurrent_query = "(af.form_dd = '0000-00-00' and af.form_assessment_date != '0000-00-00' and af.form_assessment_date != '2001-01-01' and af.form_status_stage_id != 7
                    and af.form_status_stage_id != 15 and af.form_assessment_date > CURDATE())";
            }
            if($dd['form_status_id']==7766 && $dd['form_status_stage_id']==7766){
                $ad_full_assessmentPresence_statusID = 9902;
                $ad_full_assessmentPresence_stageID = 9902;
                $ad_full_assessmentPresence = $dd['num'];
                $ad_full_assessmentPresence_query = "(lgs.new_form_stage = 4) and (lgs.new_form_status = 3)";

                //$ad_full_submissionTBI = $ad_full_assessment - $ad_full_submissionTBI_Current;
            }
            if($dd['form_status_id']==7755 && $dd['form_status_stage_id']==7755){
                $ad_full_assessmentFollowup_statusID = 9999;
                $ad_full_assessmentFollowup_stageID = 9999;
                $ad_full_assessmentFollowup = $dd['num'];
                $ad_full_assessmentFollowup_query = "((lgs.new_form_stage = 5 or lgs.new_form_stage = 7 
                or lgs.new_form_stage = 11 or lgs.new_form_stage = 14) 
                and (lgs.new_form_status = 2) OR (af.form_dr = ''
                and af.form_assessment_date != '0000-00-00'
                and af.form_assessment_date != '2001-01-01'
                and af.form_assessment_date < CURDATE()
                and af.form_status_stage_id != 7))";
            }
            if($dd['form_status_id']==7744 && $dd['form_status_stage_id']==7744){
                $ad_full_assessmentFollowup_Current_statusID = 7744;
                $ad_full_assessmentFollowup_Current_stageID = 7744;
                $ad_full_assessmentFollowup_Current = $dd['num'];
                $ad_full_assessmentFollowup_Current_query = "af.form_dr = ''
                    and af.form_assessment_date != '0000-00-00'
                    and af.form_assessment_date != '2001-01-01'
                    and af.form_assessment_date < CURDATE() /***** Current Date is here *****/
                    and /*lgs.modified is null*/ af.form_assessment_result = ''
                    and af.form_status_stage_id != 7 and af.form_status_stage_id != 6 and af.form_status_stage_id != 15";
            }
            if($dd['form_status_id']==7733 && $dd['form_status_stage_id']==7733){
                $ad_full_assessmentFollowup_CurrentOver_statusID = 9999;
                $ad_full_assessmentFollowup_CurrentOver_stageID = 9999;
                $ad_full_assessmentFollowup_CurrentOver = $ad_full_assessmentFollowup_Current;
                $ad_full_assessmentFollowup_CurrentOver_query = "";
            }
            if($dd['form_status_id']==7722 && $dd['form_status_stage_id']==7722){
                $ad_full_assessmentExtention = $dd['num'];
                $ad_full_assessmentExtention_statusID = 9999;
                $ad_full_assessmentExtention_stageID = 9999;
                $ad_full_assessmentExtention_query = "(lgs.new_form_stage = 10) 
                and (lgs.new_form_status = 2)";
            }
            if($dd['form_status_id']==7711 && $dd['form_status_stage_id']==7711){
                $ad_full_assessmentNotInterested = $dd['num'];
                $ad_full_assessmentNotInterested_statusID = 9999;
                $ad_full_assessmentNotInterested_stageID = 9999;
                $ad_full_assessmentNotInterested_query = "(lgs.new_form_stage = 7) and (lgs.new_form_status = 2)";
            }
            if($dd['form_status_id']==7700 && $dd['form_status_stage_id']==7700){
                $ad_full_assessmentToday = $dd['num'];
                $ad_full_assessmentToday_statusID = 9999;
                $ad_full_assessmentToday_stageID = 9999;
                $ad_full_assessmentToday_query = "af.form_dr = ''
                    and af.form_assessment_date != '0000-00-00'
                    and af.form_assessment_date != '2001-01-01'
                    and af.form_assessment_date = CURDATE()
                    and af.form_status_stage_id != 7"; 
            }
            if($dd['form_status_id']==7701 && $dd['form_status_stage_id']==7701){
                $ad_full_assessment_Onhold = $dd['num'];
                $ad_full_assessment_Onhold_statusID = 9999;
                $ad_full_assessment_Onhold_stageID = 9999;
                $ad_full_assessment_Onhold_query = "(af.form_status_id = 3)
                    and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16)";
            }
            if($dd['form_status_id']==7702 && $dd['form_status_stage_id']==7702){
                $ad_full_assessment_OnholdOver = $dd['num'];
            }
            if($dd['form_status_id']==7703 && $dd['form_status_stage_id']==7703){
                $ad_full_assessmentWaitlist = $dd['num'];
                $ad_full_assessmentWaitlist_statusID = 9999;
                $ad_full_assessmentWaitlist_stageID = 9999;
                $ad_full_assessmentWaitlist_query = "(af.form_status_id = 3)
                    and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17)";
            }
            if($dd['form_status_id']==7704 && $dd['form_status_stage_id']==7704){
                $ad_full_assessment_Regret = $dd['num'];
                $ad_full_assessment_Regret_statusID = 9999;
                $ad_full_assessment_Regret_stageID = 9999;
                $ad_full_assessment_Regret_query = "(lgs.new_form_stage = 6 or lgs.new_form_stage = 15) 
                and (lgs.new_form_status = 3)";
            }
            if($dd['form_status_id']==7705 && $dd['form_status_stage_id']==7705){
                $ad_full_assessment_RegretPO = $dd['num'];
                $ad_full_assessment_RegretPO_statusID = 9999;
                $ad_full_assessment_RegretPO_stageID = 9999;
                $ad_full_assessment_RegretPO_query = "(lgs.new_form_stage = 15) 
                and (lgs.new_form_status = 3)";
            }
            if($dd['form_status_id']==7706 && $dd['form_status_stage_id']==7706){
                $ad_full_assessment_Waitlist_Current = $dd['num'];
                $ad_full_assessment_Waitlist_Current_statusID = 9999;
                $ad_full_assessment_Waitlist_Current_stageID = 9999;
                $ad_full_assessment_Waitlist_Current_query = "(af.form_status_id = 3)
                    and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17)";
            }
            if($dd['form_status_id']==7707 && $dd['form_status_stage_id']==7707){
                $ad_full_assessment_Waitlist_Current = $dd['num'];
            }
            if($dd['form_status_id']==7708 && $dd['form_status_stage_id']==7708){
                $ad_full_assessment_AfterWaitlist = $dd['num'];
                $ad_full_assessment_AfterWaitlist_statusID = 9999;
                $ad_full_assessment_AfterWaitlist_stageID = 9999;
                $ad_full_assessment_AfterWaitlist_query = "(((lgs.new_form_stage = 9 or lgs.new_form_stage = 17) 
                and (lgs.new_form_status = 3)) and (af.form_status_stage_ID!=9 or af.form_status_stage_id !=17))";
            }
            if($dd['form_status_id']==7709 && $dd['form_status_stage_id']==7709){
                $ad_full_assessmentExtentionCurrent = $dd['num'];
                $ad_full_assessmentExtentionCurrent_statusID = 9900;
                $ad_full_assessmentExtentionCurrent_stageID = 9900;
                $ad_full_assessmentExtentionCurrent_query = "(af.form_status_stage_id = 10
                and af.form_status_id = 3)";
            }












            if($dd['form_status_id']==6666 && $dd['form_status_stage_id']==6666){
                $ad_full_discussion = $dd['num'];
                $ad_full_discussion_statusID = 9999;
                $ad_full_discussion_stageID = 9999;
                $ad_full_discussion_query = "(af.form_dd = '0000-00-00'
                            and af.form_dd > CURDATE()
                            and af.offer_date != '0000-00-00'
                            and af.form_status_stage_id != 7)";
            }
            if($dd['form_status_id']==6655 && $dd['form_status_stage_id']==6655){
                $ad_full_discussionPresence = $dd['num'];
                $ad_full_discussionPresence_statusID = 9902;
                $ad_full_discussionPresence_stageID = 9902;
                $ad_full_discussionPresence_query = "(lgs.new_form_stage = 4) and (lgs.new_form_status = 4)";
            }
            if($dd['form_status_id']==6644 && $dd['form_status_stage_id']==6644){
                $ad_full_discussion_Followup = $dd['num'];
                $ad_full_discussion_Followup_statusID = 9999;
                $ad_full_discussion_Followup_stageID = 9999;
                $ad_full_discussion_Followup_query = "(lgs.new_form_status = 4) and (lgs.new_form_stage=5 or lgs.new_form_stage=7 or lgs.new_form_stage=10 or lgs.new_form_stage=11)";
            }
            if($dd['form_status_id']==6633 && $dd['form_status_stage_id']==6633){
                $ad_full_discussion_FollowupCurrent = $dd['num'];
                $ad_full_discussion_FollowupCurrent_statusID = 6633;
                $ad_full_discussion_FollowupCurrent_stageID = 6633;
                $ad_full_discussion_FollowupCurrent_query = "(af.offer_date = '0000-00-00'
                    and af.form_discussion_date != '0000-00-00'
                    and af.form_discussion_date != '2001-01-01'
                    and af.form_discussion_date < CURDATE() /***** Current Date is here *****/
                    and lgs.modified is null
                    and af.form_status_stage_id != 7
                    and af.form_status_stage_id != 6
                    and af.form_status_stage_id != 15)";
            }
            if($dd['form_status_id']==6622 && $dd['form_status_stage_id']==6622){
                $ad_full_discussion_FollowupCurrentOver = $dd['num'];
                $ad_full_discussion_FollowupCurrentOver_statusID = 9999;
                $ad_full_discussion_FollowupCurrentOver_stageID = 9999;
                $ad_full_discussion_FollowupCurrentOver_query = "";
            }
            if($dd['form_status_id']==6611 && $dd['form_status_stage_id']==6611){
                $ad_full_discussionNotInterested_statusID = 9999;
                $ad_full_discussionNotInterested_stageID = 9999;
                $ad_full_discussionNotInterested = $dd['num'];
                $ad_full_discussionNotInterested_query = "(lgs.new_form_stage = 7) 
                    and (lgs.new_form_status = 3)";
            }
            if($dd['form_status_id']==6600 && $dd['form_status_stage_id']==6600){
                $ad_full_discussionCurrent = $dd['num'];
                $ad_full_discussionCurrent_statusID = 9999;
                $ad_full_discussionCurrent_stageID = 9999;
                $ad_full_discussionCurrent_query = "(af.offer_date = '0000-00-00'
                    and af.form_dd != '0000-00-00'
                    and af.form_dd != '2001-01-01'
                    and af.form_dd = CURDATE()
                    and af.form_status_stage_id != 7)";
            }











            if($dd['form_status_id']==5599 && $dd['form_status_stage_id']==5599){
                $ad_full_PO_ApprovalPending = $dd['num'];
                $ad_full_PO_ApprovalPending_statusID = 9900;
                $ad_full_PO_ApprovalPending_stageID = 9900;
                $ad_full_PO_ApprovalPending_query = "(af.form_status_id >= 4
                    and af.form_dc != ''
                    and af.form_dc != 'OFR'
                    and af.form_status_stage_id != 15
                    and af.form_status_stage_id != 16
                    and af.form_status_stage_id != 17
                    and af.form_status_stage_id != 7)";
            }
            if($dd['form_status_id']==5588 && $dd['form_status_stage_id']==5588){
                $ad_full_PO_Approval = $dd['num'];
                $ad_full_PO_Approval_statusID = 9900;
                $ad_full_PO_Approval_stageID = 9900;
                $ad_full_PO_Approval_query = "(af.form_status_id >= 4
                    and af.form_dc != ''
                    and af.offer_date != '')";
            }
            if($dd['form_status_id']==5577 && $dd['form_status_stage_id']==5577){
                $ad_full_PO_onHold = $dd['num'];
                $ad_full_PO_onHold_statusID = 9999;
                $ad_full_PO_onHold_stageID = 9999;
                $ad_full_PO_onHold_query = "(af.form_status_id >= 4
                    and af.form_status_stage_id = 16)";
            }
            if($dd['form_status_id']==5566 && $dd['form_status_stage_id']==5566){
                $ad_full_PO_onHoldCurrent = $ad_full_PO_onHold;
                $ad_full_PO_onHoldCurrentstatusID = 9999;
                $ad_full_PO_onHoldCurrent_stageID = 9999;
                $ad_full_PO_onHoldCurrent_query = "";
            }



            if($dd['form_status_id']==5555 && $dd['form_status_stage_id']==5555){
                $ad_full_PO_Waitlist = $dd['num'];
                $ad_full_PO_Waitlist_statusID = 9999;
                $ad_full_PO_Waitlist_stageID = 9999;
                $ad_full_PO_Waitlist_query = "(lgs.new_form_stage = 9) 
                    and (lgs.new_form_status >= 4)";
            }
            if($dd['form_status_id']==5544 && $dd['form_status_stage_id']==5544){
                $ad_full_PO_Regret = $dd['num'];
                $ad_full_PO_Regret_statusID = 9999;
                $ad_full_PO_Regret_stageID = 9999;
                $ad_full_PO_Regret_query = "(af.form_status_id >= 4
                    and af.form_status_stage_id = 15)";
            }
            if($dd['form_status_id']==5533 && $dd['form_status_stage_id']==5533){
                $ad_full_PO_Waitlist_to_Regret = $dd['num'];
                $ad_full_PO_Waitlist_to_Regret_statusID = 9999;
                $ad_full_PO_Waitlist_to_Regret_stageID = 9999;
                $ad_full_PO_Waitlist_to_Regret_query = "((lgs.old_form_stage = 9 or lgs.old_form_stage = 17) and (lgs.new_form_stage = 6 or lgs.new_form_stage = 15))
                    and (lgs.new_form_status >= 3)";
            }
            if($dd['form_status_id']==5522 && $dd['form_status_stage_id']==5522){
                $ad_full_PO_WaitlistCurrent = $dd['num'];
                $ad_full_PO_WaitlistCurrent_statusID = 9999;
                $ad_full_PO_WaitlistCurrent_stageID = 9999;
                $ad_full_PO_WaitlistCurrent_query = "af.form_status_id >= 4
                    and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17)";
            }
            if($dd['form_status_id']==5511 && $dd['form_status_stage_id']==5511){
                $ad_full_PO_WaitlistCurrentOver = $ad_full_PO_WaitlistCurrent;
                $ad_full_PO_WaitlistCurrentOver_statusID = 9999;
                $ad_full_PO_WaitlistCurrentOver_stageID = 9999;
                $ad_full_PO_WaitlistCurrentOver_query = "";
            }
            if($dd['form_status_id']==5500 && $dd['form_status_stage_id']==5500){
                $ad_full_PO_Waitlist_to_Offer = $dd['num'];
                $ad_full_PO_Waitlist_to_Offer_statusID = 9999;
                $ad_full_PO_Waitlist_to_Offer_stageID = 9999;
                $ad_full_PO_Waitlist_to_Offer_query = "((lgs.old_form_stage = 9 or lgs.old_form_stage = 17 OR lgs.new_form_stage = 9 or lgs.new_form_stage = 17))
                    and (af.form_status_id >= 5)";
            }
            if($dd['form_status_id']==5501 && $dd['form_status_stage_id']==5501){
                $ad_full_PO_RegretAPR = $dd['num'];
                $ad_full_PO_RegretAPR_statusID = 9900;
                $ad_full_PO_RegretAPR_stageID = 9900;
                $ad_full_PO_RegretAPR_query = "(af.form_status_stage_id = 6)";
            }















            if($dd['form_status_id']==4499 && $dd['form_status_stage_id']==4499){
                $ad_full_offer = $dd['num'];
                $ad_full_offer_statusID = 9900;
                $ad_full_offer_stageID = 9900;
                $ad_full_offer_query = "(af.form_status_id >= 5)";
            }
            if($dd['form_status_id']==4488 && $dd['form_status_stage_id']==4488){
                $ad_full_offerFollowup = $dd['num'];
                $ad_full_offerFollowup_statusID = 9999;
                $ad_full_offerFollowup_stageID = 9999;
                $ad_full_offerFollowup_query = "(af.form_status_id = 5
                    and afo.print_fee_bill = 0 and af.form_status_stage_id != 7)";
            }
            if($dd['form_status_id']==4477 && $dd['form_status_stage_id']==4477){
                $ad_full_offerFollowupOver = $dd['num'];
                $ad_full_offerFollowupOver_statusID = 9999;
                $ad_full_offerFollowupOver_stageID = 9999;
                $ad_full_offerFollowupOver_query = "(af.offer_date != '0000-00-00'
                    and af.offer_date != '2001-01-01'
                    and af.offer_date < CURDATE() /***** Current Date is here *****/
                    and af.form_status_stage_id != 7
                    and afo.signed_offer_letter = 0
                    and af.form_status_stage_id != 6
                    and af.form_status_stage_id != 15)";
            }
            if($dd['form_status_id']==4466 && $dd['form_status_stage_id']==4466){
                $ad_full_offerShowedup = $dd['num'];
                $ad_full_offerShowedup_statusID = 9900;
                $ad_full_offerShowedup_stageID = 9900;
                $ad_full_offerShowedup_query = "(af.form_status_id >= 5) 
                    and (af.is_OFL = 1)";
            }
            if($dd['form_status_id']==4455 && $dd['form_status_stage_id']==4455){
                $ad_full_offerFollowup_ALL = $dd['num'];
                $ad_full_offerFollowup_ALL_statusID = 9900;
                $ad_full_offerFollowup_ALL_stageID = 9900;
                $ad_full_offerFollowup_ALL_query = "(af.form_status_id >= 5
                    and af.offer_date < curdate())";
            }
            if($dd['form_status_id']==4444 && $dd['form_status_stage_id']==4444){
                $ad_full_offer_NotInterested = $dd['num'];
                $ad_full_offer_NotInterested_statusID = 9999;
                $ad_full_offer_NotInterested_stageID = 9999;
                $ad_full_offer_NotInterested_query = "(lgs.new_form_stage = 7) 
                    and (lgs.new_form_status = 5)";
            }
            if($dd['form_status_id']==4433 && $dd['form_status_stage_id']==4433){
                $ad_full_offered = $dd['num'];
                $ad_full_offered_statusID = 9999;
                $ad_full_offered_stageID = 9999;
                $ad_full_offered_query = "(af.form_status_id = 5
                    and afo.print_fee_bill = 1 and af.form_status_stage_id != 7 and fb.bill_due_date > CURDATE())";
            }










            if($dd['form_status_id']==3311 && $dd['form_status_stage_id']==3311){
                $ad_full_admissionNotInterested = $dd['num'];
                $ad_full_admissionNotInterested_statusID = 9999;
                $ad_full_admissionNotInterested_stageID = 9999;
                $ad_full_admissionNotInterested_query = "(lgs.new_form_stage = 7) 
                    and (lgs.new_form_status = 6)";
            }
            if($dd['form_status_id']==3322 && $dd['form_status_stage_id']==3322){
                $ad_full_admission_Followup = $dd['num'];
                $ad_full_admission_Followup_statusID = 9999;
                $ad_full_admission_Followup_stageID = 9999;
                $ad_full_admission_Followup_query = "(fb.student_id = 7060
                    and fb.bill_due_date < CURDATE() and af.form_status_stage_id != 7)";

                $ad_full_admission_FollowupOver = $ad_full_admission_Followup;
            }








            if($dd['form_status_id']==1111 && $dd['form_status_stage_id']==1111){
                $ad_total_NotInterested = $dd['num'];
                $ad_total_NotInterested_statusID = 9900;
                $ad_total_NotInterested_stageID = 9900;
                $ad_total_NotInterested_query = "(af.form_status_stage_id = 7)";
            }
             if($dd['form_status_id']==3333 && $dd['form_status_stage_id']==3333){
                $ad_total_Regret = $dd['num'];
                $ad_total_Regret_statusID = 9900;
                $ad_total_Regret_stageID = 9900;
                $ad_total_Regret_query = "(af.form_status_stage_id = 15)";
            }
             if($dd['form_status_id']==2222 && $dd['form_status_stage_id']==2222){
                $ad_total_Admission = $dd['num'];
                $ad_total_Admission_statusID = 9900;
                $ad_total_Admission_stageID = 9900;
                $ad_total_Admission_query = "(af.form_status_id >= 6)";
            }
        }
        /************************ Assigning Values - E N D - *****/







        $html .= 
            '<div class="issuanceArea absolute">
            <span class="totalApplicants tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_issuance_statusID.'" data-stage="'.$ad_full_issuance_stageID.'" data-query="">'.$ad_full_issuance.'</a><span class="tooltiptext">Form Issuance</span></span>
        </div><!-- issuanceArea -->
        
        <div class="submissionArea absolute">
            <!-- code edit to be done by ATN -->
            <span class="ApplicantsOnIssuanceToSubmission absolute"> <!-- CHange 1 -->
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_issuanceExtentionCurrent_statusID.'" data-stage="'.$ad_full_issuanceExtentionCurrent_stageID.'" data-query="'.$ad_full_issuanceExtentionCurrent_query.'">'.$ad_full_issuanceExtentionCurrent.'</a><span class="tooltiptext">Applications awaiting for submission</span> <span class="overdueApplicantsOnFollowUp">('.$ad_full_issuanceExtentionCurrent.')</span></span>
            </span>
            <!-- code edit to be done by ATN -->
            
            
            
            <span class="totalApplicantsOnSubmission absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_submission_statusID.'" data-stage="'.$ad_full_submission_stageID.'" data-query="'.$ad_full_submmision_query.'">'.$ad_full_submission.'</a><span class="tooltiptext">Admission forms submitted</span></span>
            </span>
            <span class="totalApplicantsOnTBI absolute">
                <span class="tooltipp"><a href="#" data-toggle="" data-target="#myModal">'.$ad_full_submissionTBI.'</a><span class="tooltiptext">Applicants in To Be Allocated</span></span>
            </span>
            <span class="ApplicantsOnTBILeft absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_submissionTBI_Current_statusID.'" data-stage="'.$ad_full_submissionTBI_Current_stageID.'" data-query="'.$ad_full_submmisionTBI_Current_query.'">'.$ad_full_submissionTBI_Current.'</a> <span class="overdueApplicantsOnTBI">('.$ad_full_submissionTBI_Current.')</span><span class="tooltiptext">Applicants in To Be Allocated</span></span>
            </span>
            <span class="totalApplicantsOnTBIAllocated absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_assessment_statusID.'" data-stage="'.$ad_full_assessment_stageID.'" data-query="'.$ad_full_assessment_query.'">'.$ad_full_assessment.'</a><span class="tooltiptext">Applicants Allocated</span></span>
            </span>
            <span class="followUpApplicants absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_submissionOffer_statusID.'" data-stage="'.$ad_full_submissionOffer_stageID.'" data-query="'.$ad_full_submmisionOffer_query.'">'.$ad_full_submissionOffer.'</a><span class="tooltiptext">Applicants to be Followed up</span></span>
            </span>
            <!-- ATN -->
            <span class="EXTUpApplicantsCurrent absolute"> <!-- Change 2 -->
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_issuanceExtention_statusID.'" data-stage="'.$ad_full_issuanceExtention_stageID.'" data-query="'.$ad_full_issuanceExtention_query.'">'.$ad_full_issuanceExtention.'</a><span class="tooltiptext">Applicants currently in Submission Extension</span> <span class="overdueApplicantsOnFollowUp">('.$ad_full_issuanceExtention.')</span></span>
            </span>
            <!-- ATN -->
            
            <span class="followUpApplicantsCurrent absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_submissionFollowup_statusID.'" data-stage="'.$ad_full_submissionFollowup_stageID.'" data-query="'.$ad_full_submmisionFollowup_query.'">'.$ad_full_submissionFollowup.'</a><span class="tooltiptext">Applicants currently in Followup</span> <span class="overdueApplicantsOnFollowUp">('.$ad_full_submissionFollowup.')</span></span>
            </span>
            <span class="followUpApplicantsNI absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" <a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_submissionNotInterested_statusID.'" data-stage="'.$ad_full_submissionNotInterested_stageID.'" data-query="'.$ad_full_submmisionNotInterested_query.'">'.$ad_full_submissionNotInterested.'</a><span class="tooltiptext">Applicants Not Interested</span></span>
            </span>
            <span class="followUpApplicantsExt absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_submissionExtention_statusID.'" data-stage="'.$ad_full_submissionExtention_stageID.'" data-query="'.$ad_full_submmisionExtention_query.'">'.$ad_full_submissionExtention.'</a><span class="tooltiptext">Applicants for Submission Extension</span></span>
            </span>
        </div><!-- submissionArea -->
        
        <div class="assessmentArea absolute">
            <span class="totalApplicantsOnAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_assessmentCurrent_statusID.'" data-stage="'.$ad_full_assessmentCurrent_stageID.'" data-query="'.$ad_full_assessmentCurrent_query.'">'.$ad_full_assessmentCurrent.'</a><span class="tooltiptext">Applicants currently in Assessment</span></span>
            </span>
            <span class="totalApplicantsOnAssessmentOverAll absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_assessmentPresence_statusID.'" data-stage="'.$ad_full_assessmentPresence_stageID.'" data-query="'.$ad_full_assessmentPresence_query.'">'.$ad_full_assessmentPresence.'</a><span class="tooltiptext">Overall applicants moved to Assessment Process</span></span>
            </span>
            <span class="totalApplicantsOnAssessmentPresent absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_assessmentToday_statusID.'" data-stage="'.$ad_full_assessmentToday_stageID.'" data-query="'.$ad_full_assessmentToday_query.'">'.$ad_full_assessmentToday.'</a><span class="tooltiptext">Applicants showed up for Assessment</span></span>
            </span>
            <span class="totalApplicantsOnWTLAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_assessmentWaitlist_statusID.'" data-stage="'.$ad_full_assessmentWaitlist_stageID.'" data-query="'.$ad_full_assessmentWaitlist_query.'">'.$ad_full_assessmentWaitlist.'</a><span class="tooltiptext">Overall applicants moved to Waitlist</span></span>
            </span>
            <span class="ApplicantsOnWTLLeftAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal">'.$ad_full_assessment_Waitlist_Current.'</a><span class="tooltiptext">Applicants currently in Waitlist</span> <span class="overdueApplicantsOnWTLAssessment">('.$ad_full_assessment_Waitlist_CurrentOver.')</span></span>
            </span>
            <span class="totalApplicantsFromWTLToRGT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_assessment_RegretPO_statusID.'" data-stage="'.$ad_full_assessment_RegretPO_stageID.'" data-query="'.$ad_full_assessment_RegretPO_query.'">'.$ad_full_assessment_RegretPO.'</a><span class="tooltiptext">Overall applicants moved to Regret</span></span>
            </span>
            <span class="totalApplicantsFromAssessmentToRGT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_assessment_Regret_statusID.'" data-stage="'.$ad_full_assessment_Regret_stageID.'" data-query="'.$ad_full_assessment_Regret_query.'">'.$ad_full_assessment_Regret.'</a><span class="tooltiptext">Overall applicants moved to Regret</span></span>
            </span>
            <span class="totalApplicantsPassedFromWTL absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_assessment_AfterWaitlist_statusID.'" data-stage="'.$ad_full_assessment_AfterWaitlist_stageID.'" data-query="'.$ad_full_assessment_AfterWaitlist_query.'">'.$ad_full_assessment_AfterWaitlist.'</a><span class="tooltiptext">Overall applicants allocated from Waitlist</span></span>
            </span>
            <span class="followUpApplicants absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_assessmentFollowup_statusID.'" data-stage="'.$ad_full_assessmentFollowup_stageID.'" data-query="'.$ad_full_assessmentFollowup_query.'">'.$ad_full_assessmentFollowup.'</a><span class="tooltiptext">Overall applicants moved to Followup</span></span>
            </span>
            <!-- ATN -->
            <span class="AssEXTApplicantsCurrent absolute"> <!-- Change 3 -->
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_submissionExtentionCurrent_statusID.'" data-stage="'.$ad_full_submissionExtentionCurrent_stageID.'" data-query="'.$ad_full_submissionExtentionCurrent_query.'">'.$ad_full_submissionExtentionCurrent.'</a> <span class="overdueApplicantsOnTBI">('.$ad_full_submissionExtentionCurrent.')</span><span class="tooltiptext">Applicants awaited for Form Assessment</span></span>
            </span>
            <!-- ATN -->
            <span class="followUpApplicantsCurrent absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_assessmentFollowup_Current_statusID.'" data-stage="'.$ad_full_assessmentFollowup_Current_stageID.'" data-query="'.$ad_full_assessmentFollowup_Current_query.'">'.$ad_full_assessmentFollowup_Current.'</a><span class="tooltiptext">Applicants currently in Followup</span> <span class="overdueApplicantsOnFollowUp">('.$ad_full_assessmentFollowup_CurrentOver.')</span></span>
            </span>
            <span class="followUpApplicantsNI absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_assessmentNotInterested_statusID.'" data-stage="'.$ad_full_assessmentNotInterested_stageID.'" data-query="'.$ad_full_assessmentNotInterested_query.'">'.$ad_full_assessmentNotInterested.'</a><span class="tooltiptext">Applicants moved to Not Interested from Followup</span></span>
            </span>
            <span class="followUpApplicantsExtAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_assessmentExtention_statusID.'" data-stage="'.$ad_full_assessmentExtention_stageID.'" data-query="'.$ad_full_assessmentExtention_query.'">'.$ad_full_assessmentExtention.'</a><span class="tooltiptext">Overall applicants requested for Extension</span></span>
            </span>
            <span class="OHDApplicantsAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_assessment_Onhold_statusID.'" data-stage="'.$ad_full_assessment_Onhold_stageID.'" data-query="'.$ad_full_assessment_Onhold_query.'">'.$ad_full_assessment_Onhold.'</a><span class="tooltiptext">Applicants currently On Hold</span> <span class="overdueApplicantsOnAssessmentOHD">('.$ad_full_assessment_OnholdOver.')</span></span>
            </span>
        </div><!-- assessmentArea -->
        
        <div class="discussionArea absolute">
            <span class="totalApplicantsOnAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_discussion_statusID.'" data-stage="'.$ad_full_discussion_stageID.'" data-query="'.$ad_full_discussion_query.'">'.$ad_full_discussion.'</a><span class="tooltiptext">Applicants currently in Discussion</span></span>
            </span>
            <span class="totalApplicantsOnAssessmentOverAll absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_discussionPresence_statusID.'" data-stage="'.$ad_full_discussionPresence_stageID.'" data-query="'.$ad_full_discussionPresence_query.'">'.$ad_full_discussionPresence.'</a><span class="tooltiptext">Overall applicants moved to Discussion</span></span>
            </span>
            <span class="totalApplicantsOnAssessmentPresent absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_discussionCurrent_statusID.'" data-stage="'.$ad_full_discussionCurrent_stageID.'" data-query="'.$ad_full_discussionCurrent_query.'">'.$ad_full_discussionCurrent.'</a><span class="tooltiptext">Applicants showed up for Discussion</span></span>
            </span>
            <span class="followUpApplicants absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_discussion_Followup_statusID.'" data-stage="'.$ad_full_discussion_Followup_stageID.'" data-query="'.$ad_full_discussion_Followup_query.'">'.$ad_full_discussion_Followup.'</a><span class="tooltiptext">Overall applicants moved to Followup</span></span>
            </span>
            <!-- ATN -->
            <span class="DISCEXTApplicantsCurrent absolute"> <!-- Change 4 -->
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_assessmentExtentionCurrent_statusID.'" data-stage="'.$ad_full_assessmentExtentionCurrent_stageID.'" data-query="'.$ad_full_assessmentExtentionCurrent_query.'">'.$ad_full_assessmentExtentionCurrent.'</a><span class="tooltiptext">Applicants currently in Discussion Extension</span> <span class="overdueApplicantsOnFollowUp">('.$ad_full_assessmentExtentionCurrent.')</span></span>
            </span>
            <!-- ATN -->
            <span class="followUpApplicantsCurrent absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_discussion_FollowupCurrent_statusID.'" data-stage="'.$ad_full_discussion_FollowupCurrent_stageID.'" data-query="'.$ad_full_discussion_FollowupCurrent_query.'">'.$ad_full_discussion_FollowupCurrent.'</a><span class="tooltiptext">Applicants currently in Followup</span> <span class="overdueApplicantsOnFollowUp">('.$ad_full_discussion_FollowupCurrentOver.')</span></span>
            </span>
            <span class="followUpApplicantsNI absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_discussionNotInterested_statusID.'" data-stage="'.$ad_full_discussionNotInterested_stageID.'" data-query="'.$ad_full_discussionNotInterested_query.'">'.$ad_full_discussionNotInterested.'</a><span class="tooltiptext">Applicants moved to Not Interested from Followup</span></span>
            </span>
            <span class="followUpApplicantsExtAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal">'.$ad_full_discussion_extention.'</a><span class="tooltiptext">Overall applicants requested for Extension</span></span>
            </span>
        </div><!-- discussionArea -->
        
        <div class="pricipalArea absolute">
            <span class="totalApplicantsOnPO absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_PO_ApprovalPending_statusID.'" data-stage="'.$ad_full_PO_ApprovalPending_stageID.'" data-query="'.$ad_full_PO_ApprovalPending_query.'">'.$ad_full_PO_ApprovalPending.'</a><span class="tooltiptext">Applicants currently in Principal Office Approval</span></span>
            </span>
            <span class="totalApplicantsOnPOOverAll absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_PO_Approval_statusID.'" data-stage="'.$ad_full_PO_Approval_stageID.'" data-query="'.$ad_full_PO_Approval_query.'">'.$ad_full_PO_Approval.'</a><span class="tooltiptext">Overall applicants moved to Prinipal Office approval</span></span>
            </span>
            <span class="totalApplicantsOnWTLPO absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_PO_Waitlist_statusID.'" data-stage="'.$ad_full_PO_Waitlist_stageID.'" data-query="'.$ad_full_PO_Waitlist_query.'">'.$ad_full_PO_Waitlist.'</a><span class="tooltiptext">Overall applicants moved to Waitlist</span></span>
            </span>
            <span class="ApplicantsOnWTLLeftPO absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_PO_WaitlistCurrent_statusID.'" data-stage="'.$ad_full_PO_WaitlistCurrent_stageID.'" data-query="'.$ad_full_PO_WaitlistCurrent_query.'">'.$ad_full_PO_WaitlistCurrent.'</a><span class="tooltiptext">Applicants currently in Waitlist</span> <span class="overdueApplicantsOnWTL_PO">('.$ad_full_PO_WaitlistCurrentOver.')</span></span>
            </span>
            <span class="totalApplicantsFromWTLToRGT_PO absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_PO_Waitlist_to_Regret_statusID.'" data-stage="'.$ad_full_PO_Waitlist_to_Regret_stageID.'" data-query="'.$ad_full_PO_Waitlist_to_Regret_query.'">'.$ad_full_PO_Waitlist_to_Regret.'</a><span class="tooltiptext">Overall applicants moved to Regret from Waitlist</span></span>
            </span>
            <span class="totalApplicantsFromPOToRGT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_PO_Regret_statusID.'" data-stage="'.$ad_full_PO_Regret_stageID.'" data-query="'.$ad_full_PO_Regret_query.'">'.$ad_full_PO_Regret.'</a><span class="tooltiptext">Overall applicants moved to Regret from Pricipal Office approval</span></span>
            </span>
            <span class="totalApplicantsPassedFromWTL_PO absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_PO_Waitlist_to_Offer_statusID.'" data-stage="'.$ad_full_PO_Waitlist_to_Offer_stageID.'" data-query="'.$ad_full_PO_Waitlist_to_Offer_query.'">'.$ad_full_PO_Waitlist_to_Offer.'</a><span class="tooltiptext">Overall applicants allocated from Waitlist</span></span>
            </span>
            <span class="OHDApplicantsPO absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_PO_onHold_statusID.'" data-stage="'.$ad_full_PO_onHold_stageID.'" data-query="'.$ad_full_PO_onHold_query.'">'.$ad_full_PO_onHold.'</a><span class="tooltiptext">Applicants currently On Hold</span> <span class="overdueApplicantsOnPOOHD">('.$ad_full_PO_onHoldCurrent.')</span></span>
            </span>    
        </div><!-- pricipalArea -->
        
        <div class="offerArea absolute">
            <span class="totlaApplicantsPassedFromOffer absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_offer_statusID.'" data-stage="'.$ad_full_offer_stageID.'" data-query="'.$ad_full_offer_query.'">'.$ad_full_offer.'</a><span class="tooltiptext">Overall applicants moved to Offer Preparation</span></span>
            </span>
            <span class="totalApplicantsOnOffer absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_offerFollowup_statusID.'" data-stage="'.$ad_full_offerFollowup_stageID.'" data-query="'.$ad_full_offerFollowup_query.'">'.$ad_full_offerFollowup.'</a><span class="tooltiptext">Applicants currently in Offer Preparation</span> <span class="overdueApplicantsOnOffer">('.$ad_full_offerFollowupOver.')</span></span>
            </span>
            <span class="totlaApplicantsPassedFromOfferShow absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_offerShowedup_statusID.'" data-stage="'.$ad_full_offerShowedup_stageID.'" data-query="'.$ad_full_offerShowedup_query.'">'.$ad_full_offerShowedup.'</a><span class="tooltiptext">Overall applicants showed up to Receive the Offer Letter</span></span>
            </span>
            <span class="offerShowupToFollowup absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_offerFollowup_ALL_statusID.'" data-stage="'.$ad_full_offerFollowup_ALL_stageID.'" data-query="'.$ad_full_offerFollowup_ALL_query.'">'.$ad_full_offerFollowup_ALL.'</a><span class="tooltiptext">Overall applicants moved to Followup</span></span> 
            </span>
            <span class="totalApplicantsOnOfferFollowUp absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_offerFollowupOver_statusID.'" data-stage="'.$ad_full_offerFollowupOver_stageID.'" data-query="'.$ad_full_offerFollowupOver_query.'">'.$ad_full_offerFollowupOver.'</a><span class="tooltiptext">Applicants currently in Followup</span> <span class="overdueApplicantsOnOfferShow">('.$ad_full_offerFollowupOver.')</span></span>
            </span>
            <span class="totlaApplicantsPassedFromFollowupToNIT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_offer_NotInterested_statusID.'" data-stage="'.$ad_full_offer_NotInterested_stageID.'" data-query="'.$ad_full_offer_NotInterested_query.'">'.$ad_full_offer_NotInterested.'</a><span class="tooltiptext">Overall applicants moved to Not Interedted from Followup</span></span>
            </span>
            <span class="totlaApplicantsPassedFromFollowupToEXT absolute">
                <span class="tooltipp"><a href="#" data-toggle="" data-target="#myModal">'.$ad_full_offerExtention.'</a><span class="tooltiptext">Overall applicants requested for Extension</span></span>
            </span>
            <span class="bankShowupToFollowup absolute">
                <span class="tooltipp"><a href="#" data-toggle="" data-target="#myModal">'.$ad_full_admissionFollowup_total.'</a><span class="tooltiptext">Overall applicants moved to Followup from Fee bill due date</span></span> 
            </span>

            <!-- Change Here -->
            <span class="totalApplicantsInOffered absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_offered_statusID.'" data-stage="'.$ad_full_offered_stageID.'" data-query="'.$ad_full_offered_query.'">'.$ad_full_offered.'</a><span class="tooltiptext">To Be Offered</span> <span class="overdueApplicantsOnOffer">('.$ad_full_offered.')</span></span>
            </span>


            <span class="totalApplicantsOnBankFollowUp absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_admission_Followup_statusID.'" data-stage="'.$ad_full_admission_Followup_stageID.'" data-query="'.$ad_full_admission_Followup_query.'">'.$ad_full_admission_Followup.'</a><span class="tooltiptext">Applicants currently in Followup</span> <span class="overdueApplicantsOnOfferShow">('.$ad_full_admission_FollowupOver.')</span></span>
            </span>
            <span class="totlaApplicantsPassedFromBankToNIT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_admissionNotInterested_statusID.'" data-stage="'.$ad_full_admissionNotInterested_stageID.'" data-query="'.$ad_full_admissionNotInterested_query.'">'.$ad_full_admissionNotInterested.'</a><span class="tooltiptext">Overall applicants moved to Not Intersted from Followup</span></span>
            </span>
            <span class="totlaApplicantsPassedFromBankToEXT absolute">
                <span class="tooltipp"><a href="#" data-toggle="" data-target="#myModal">'.$ad_full_admissionExtention.'</a><span class="tooltiptext">Overall applicants requested for Extension</span></span>
            </span>
        </div><!-- offerArea -->
     
        <div class="finalArea absolute">
            <span class="finalRGT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_total_Regret_statusID.'" data-stage="'.$ad_total_Regret_stageID.'" data-query="'.$ad_total_Regret_query.'">'.$ad_total_Regret.'</a><span class="tooltiptext">List of Applicants in Regret</span></span>
            </span>
            <!-- Change Here -->
            <span class="finalRGTPAApproval absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_PO_RegretAPR_statusID.'" data-stage="'.$ad_full_PO_RegretAPR_stageID.'" data-query="'.$ad_full_PO_RegretAPR_query.'">'.$ad_full_PO_RegretAPR.'</a><span class="tooltiptext">To Be Regretted</span></span>
            </span>
            <span class="finalADMCOM absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_total_Admission_statusID.'" data-stage="'.$ad_total_Admission_stageID.'" data-query="'.$ad_total_Admission_query.'">'.$ad_total_Admission.'</a><span class="tooltiptext">List of Applicants with Confirm Admissions</span></span>
            </span>
            <span class="finalNIT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_total_NotInterested_statusID.'" data-stage="'.$ad_total_NotInterested_stageID.'" data-query="'.$ad_total_NotInterested_query.'">'.$ad_total_NotInterested.'</a><span class="tooltiptext">List of Applicants Not Interested</span></span>
            </span>


            <!-- Change Here -->
            <span class="finalNITPAApproval absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_total_NotInterested_statusID.'" data-stage="'.$ad_total_NotInterested_stageID.'" data-query="'.$ad_total_NotInterested_query.'">'.$ad_total_NotInterested.'</a><span class="tooltiptext">To Be Aborted</span></span>
            </span>
        </div><!-- finalArea -->';
        

        echo $html;
    }   




























    public function edit2(){
        $html = '';


        $this->load->model('gs_admission/process_flow_xp_model');        
        $gradeID = $this->input->post('gradeID');
        $gradeIDs = explode(",", $gradeID);
        $data['batch'] = $this->process_flow_xp_model->getBatch($gradeIDs);



        if($gradeIDs[0] == 'All' || $gradeID ==''){

        }else{
            if($gradeID == ''){
                $html = '';
            }else{
                $html .= '
                <select required="" class="BiGSelectBox">
                  <option value="" disabled="" selected="">Select Batch</option>';
                foreach ($data['batch'] as $batch) {
                    $html .= '<option value="'.$batch['id'].'">'.$batch['batch_category'].'</option>';
                }

                $html .= '</select>';
            }
        }
        


        echo $html;
    }













    public function modal_load(){
        $StatusID = $this->input->post('status_id');
        $StageID = $this->input->post('stage_id');
        $gradeID = $this->input->post('gradeID');
        $gender = $this->input->post('gender');
        $batchID = $this->input->post('batch');
        $query = $this->input->post('query');
        
        //var_dump($this->input->post());
        $this->load->model('gs_admission/process_flow_xp_model');

        $data['admission'] = $this->process_flow_xp_model->getAdmissionList($StatusID, $StageID, $gradeID, $batchID, $gender, $query);


        $html = '';
        $html .='<div class="modal-header">';
        $html .='<button type="button" class="close floatClose" data-dismiss="modal">&times;</button>';
        $html .='<h4 class="modal-title">Applicant Details - <strong>Admission Initiation</strong> <span class="pull-right"></span></h4>';
        $html .='</div>';
        $html .= ' <div class="modal-body">';
        $html .='<p>';
        $html .= '<div class="col-md-8" id="change" >';
        $html .= '<table id="AllApplicantListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="margin: 1% 1%;width: 98%;" >';
        $html .='<thead>';
        $html .='<tr>';
        $html .='<th class="valignMiddle">Form #<br /><small>Batch ID</small></th>';
        $html .='<th class="valignMiddle">Applicants Name<br /><small>Father Name - Mobile No.</small></th>';
        $html .='<th class="valignMiddle">Grade</th>';
        //$html .='<th class="valignMiddle">Next Process date</th>';
        $html .='<th class="text-center" >Action</th>';
        $html .='</tr>';
        $html .='</thead>';
        $html .='<tbody>';


        if(!empty($data['admission'])){
            foreach ($data['admission'] as $adm) {
                $html .='<tr>';
                $html .='<td><strong>'.$adm['form_no'].'</strong><br /><small>'.$adm['batch_id'].'</small></td>';
                $html .='<td>'.$adm['official_name'].'<br /><small>'.$adm['father_name'].' - '.$adm['father_mobile'].'</small></td>';
                $html .='<td class="valignMiddle"><strong>'.$adm['grade_name'].'</strong></td>';
                //$html .='<td class="valignMiddle">02-December-2016 </td>';
                $html .='<td class="text-center"><a href="#" class="timeline" id="timeline" data-formid="'.$adm['form_id'].'">View timeline</a></td>';
                $html .='</tr>';            
            }
        }
        
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';
        $html .= '<div class="modalTimeline"></div>';
        $html .= '</p>';
        $html .='</div>';

        $html .= '<script>
            $("#AllApplicantListing").dataTable();
        </script>';

        echo $html;


        }











        public function modal_timeline(){
        $FormID = $this->input->post('FormID');

        $this->load->model('admission/admission_batch_model');
        $comments_log = $this->admission_batch_model->sp_form_complete_log($FormID);

        $html = '';
        $html .= '<div class="col-md-4" class="timeline" style="display:">';
        $html .='<div class="MaroonBorderBox">';
        $html .='<h3>Applicant Details</h3>';
        $html .='<div class="inner" style="padding-bottom:0;">';
        $html .= '<div class="col-md-12">';
        $html .= '<div class="TimelineReview">';
        $html .= '<ul>';

        foreach($comments_log as $log){
            if($log->type == 'Issuance' || $log->type == 'Stage' || $log->type == 'Status'){
                $html .= '<li class="adminResponse">';
                $html .= '<p>'.$log->message.'</p>';
                $html .= '</li>';
            }
            else{


                $html .= '<li class="in">';
                $html .= '<div class="avatarLeft col-md-2">';
                $html .= '<img src="'.base_url('assets/photos/hcm/150x150/staff/'.$log->photo_id.'.png') .'"/>';
                $html .= '</div>'; //<!-- avatarLeft -->
                $html .= '<div class="systemResponse col-md-10">';
                $html .= '<span class="arrowHeadLeft">&nbsp;</span>';
                $html .= '<p><strong>'.$log->reason.'</strong><br /><small>'.$log->message.'</small></p>';
                $html .= '<span class="commentDate">'.$log->dt.'</span>'; // <!-- commentDate -->

                $html .= '</div>'; //<!-- systemResponse -->
                //$html .= '<img src="'.base_url('assets/photos/hcm/150x150/staff/'.$log->photo_id.'.png') .'"/>';
                $html .= '</li>'; //<!-- in -->
            }
        }
        
        $html .= '</ul>';
        $html .= '</div><!-- Timeline -->';
        $html .= '</div><!-- col-md-9 -->';
        $html .= '</div><!-- inner -->';
        $html .= '</div><!-- .MaroonBorderBox -->';
        $html .= '</div><!-- col-md-12 -->';
        $html .= '</div><!-- modal-body -->';




       




        echo $html;

    }
}