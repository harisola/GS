<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admission_process_flows_xp extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('session');
    }


    public function index()
	{
		
        //if($this->ion_auth->logged_in() == FALSE)
		//{
       //     redirect('welcome');
       // }else{
            $this->load->model('gs_admission/process_flows/process_flow_xp_model');
            $this->data['full'] = $this->process_flow_xp_model->getCount_IssuanceOfAll();
            
            $this->load->view('gs_files/header');
            $this->load->view('gs_files/main-nav');
            $this->load->view('gs_files/breadcrumb');
            
            $user_id = (int)$this->session->userdata("user_id");
            
			//var_dump($this->data['full']); exit;
            $this->load->view('gs_admission/process_flows/processflow_css');
            $this->load->view('gs_admission/process_flows/process_flow_xp');
       // }
    }






    public function edit(){


        $html = '';



        $this->load->model('gs_admission/process_flows/process_flow_xp_model', 'PFM');
        
        $gradeID = $this->input->post('gradeID');
        $gender = $this->input->post('gender');
        $batchID = $this->input->post('batch');



        $data['full'] = $this->PFM->getFullAdmissionInfo($gradeID, $batchID, $gender);
		



        /******************************** Declaring Variables *****/
        /**********************************************************/
        $ad_full_issuance = "-";
        $ad_full_issuance_statusID = 0;
        $ad_full_issuance_stageID = 0;
        $ad_full_issuance_query='';

        $ad_full_issuanceExtentionCurrent = "-";
        $ad_full_issuanceExtentionCurrent_statusID = 0;
        $ad_full_issuanceExtentionCurrent_stageID = 0;
        $ad_full_issuanceExtentionCurrent_query = "";

        $ad_full_issuanceExtention = "-";
        $ad_full_issuanceExtention_statusID = 0;
        $ad_full_issuanceExtention_stageID = 0;
        $ad_full_issuanceExtention_query = "";
                
                $ad_full_issuanceExtention_over = "-";
        $ad_full_issuanceExtention_statusID_over = 0;
        $ad_full_issuanceExtention_stageID_over = 0;
        $ad_full_issuanceExtention_query_over = "";



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
                $ad_full_submissionExtentionCurrentOver = "-";
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


                $ad_full_submissionTBIOver = "-";
        $ad_full_submissionTBIOver_statusID = 0;
        $ad_full_submissionTBIOver_stageID = 0;
        $ad_full_submmisionTBIOver_query = "";





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

                $ad_full_discussion_Onhold = "-";
        $ad_full_discussion_Onhold_statusID = 0;
        $ad_full_discussion_Onhold_stageID = 0;
        $ad_full_discussion_Onhold_query = "";

        $ad_full_discussion_OnholdOver = "-";
        $ad_full_discussion_OnholdOver_statusID = 0;
        $ad_full_discussion_OnholdOver_stageID = 0;
        $ad_full_discussion_OnholdOver_query = "";
                
                
        
                
                $ad_full_discussion_Waitlist_Current = "-";
                $ad_full_discussion_Waitlist_CurrentThreeOver="-";
        $ad_full_discussion_Waitlist_Current_statusID = 0;
        $ad_full_discussion_Waitlist_Current_stageID = 0;
        $ad_full_discussion_Waitlist_Current_query = "";

        $ad_full_discussion_Waitlist_CurrentOver = "-";
        $ad_full_discussion_Waitlist_CurrentOver_statusID = 0;
        $ad_full_discussion_Waitlist_CurrentOver_stageID = 0;
        $ad_full_discussion_Waitlist_CurrentOver_query = "";

                
                
                $ad_full_discussion_Regret = "-";
        $ad_full_discussion_Regret_statusID = 0;
        $ad_full_discussion_Regret_stageID = 0;
        $ad_full_discussion_Regret_query = "";

        $ad_full_discussion_RegretPO = "-";
        $ad_full_discussion_RegretPO_statusID = 0;
        $ad_full_discussion_RegretPO_stageID = 0;
        $ad_full_discussion_RegretPO_query = "";

                $ad_full_discussionWaitlist = "-";
        $ad_full_discussionWaitlist_statusID = 0;
        $ad_full_discussionWaitlist_stageID = 0;
        $ad_full_discussionWaitlist_query = "";
                
                
                $ad_full_discussion_AfterWaitlist = "-";
        $ad_full_discussion_AfterWaitlist_statusID = 0;
        $ad_full_discussion_AfterWaitlist_stageID = 0;
        $ad_full_discussion_AfterWaitlist_query = "";
                
                
                $ad_full_discussionExtentionCurrent = "-";
        $ad_full_discussionExtentionCurrent_statusID = 0;
        $ad_full_discussionExtentionCurrent_stageID = 0;
        $ad_full_discussionExtentionCurrent_query = "";
                
                $ad_full_discussionExtentionCurrent_over = "-";
        $ad_full_discussionExtentionCurrent_statusID_over = 0;
        $ad_full_discussionExtentionCurrent_stageID_over = 0;
        $ad_full_discussionExtentionCurrent_query_over = "";
                
                 













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
                
                
                $ad_full_offerCurrenlty2Days = "-";
        $ad_full_offerCurrenlty2Days_statusID = 0;
        $ad_full_offerCurrenlty2Days_stageID = 0;
        $ad_full_offerCurrenlty2Days_query = "";
                
                

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
                
        $ad_full_offered_complete_check = "-";
        $ad_full_offered_complete_checkOver = "-";
        $ad_full_offered_complete_check_statusID = 0;
        $ad_full_offered_complete_check_stageID = 0;
        $ad_full_offered_complete_check_query = "";

                
                
                $ad_full_offeredf_complete_check = "-";
        $ad_full_offeredf_complete_check_statusID = 0;
        $ad_full_offeredf_complete_check_stageID = 0;
        $ad_full_offeredf_complete_check_query = "";

                
                $ad_full_offerede_complete_check = "-";
        $ad_full_offerede_complete_check_statusID = 0;
        $ad_full_offerede_complete_check_stageID = 0;
        $ad_full_offerede_complete_check_query = "";

                $ad_full_complete_checknNotInterested = "-";
        $ad_full_complete_checkNotInterested_statusID = 0;
        $ad_full_complete_checkNotInterested_stageID = 0;
        $ad_full_complete_checkNotInterested_query = "";









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
                
                
        $ad_full_submissionTBI_Current_statusID2 = 0;
        $ad_full_submissionTBI_Current_stageID2 = 0;
        $ad_full_submissionTBI_Current2 = 0;
        $ad_full_submmisionTBI_Current_query2 = "";


        $ad_full_assessment2 = 0;

         // Early Admission A-Level

    $ROA_Overall_Total = "-";
    $ROA_Overall_Status = 0;
    $ROA_Overall_Stage = 0;
    $ROA_Overall_Query = "";

    $ROA_WaitingR_Total = "-";
    $ROA_WaitingR_Status = 0;
    $ROA_WaitingR_Stage = 0;
    $ROA_WaitingR_Query = "";


    $EOA_Overall_Total = "-";
    $EOA_Overall_Status = 0;
    $EOA_Overall_Stage = 0;
    $EOA_Overall_Query = "";


    $In_EOA_Prep_Total = "-";
    $In_EOA_Prep_Status = 0;
    $In_EOA_Prep_Stage = 0;
    $In_EOA_Prep_Query = "";

    $Move_To_EOA_Proc_Total = "-";
    $Move_To_EOA_Proc_Status = 0;
    $Move_To_EOA_Proc_Stage = 0;
    $Move_To_EOA_Proc_Query = "";


    $EOA_Prep_NI = "-";
    $EOA_Prep_NI_Status = 0;
    $EOA_Prep_NI_Stage = 0;
    $EOA_Prep_NI_Query = "";

    $EOA_Prep_Overall_Awaiting_Result = "-";
    $EOA_Prep_Overall_Awaiting_Result_Status = 0;
    $EOA_Prep_Overall_Awaiting_Result_Stage = 0;
    $EOA_Prep_Overall_Awaiting_Result_Query = "";


    $EOA_Prep_Followup = "-";
    $EOA_Prep_Followup_Status = 0;
    $EOA_Prep_Followup_Stage = 0;
    $EOA_Prep_Followup_Query = "";

    $EOA_Prep_Overall_Ext = "-";
    $EOA_Prep_Overall_Ext_Status = 0;
    $EOA_Prep_Overall_Ext_Stage = 0;
    $EOA_Prep_Overall_Ext_Query = "";

    $EOA_Prep_In_Ext = "-";
    $EOA_Prep_In_Ext_Status = 0;
    $EOA_Prep_In_Ext_Stage = 0;
    $EOA_Prep_In_Ext_Query = "";

    $In_EOA_Proc_Total = "-";
    $In_EOA_Proc_Status = 0;
    $In_EOA_Proc_Stage = 0;
    $In_EOA_Proc_Query = "";


    $EOA_Prep_Overall_Awaiting_Result='-';
    $EOA_Overall_Awaiting_Result_Status=0;
    $EOA_Overall_Awaiting_Result_Stage=0;
    $EOA_Overall_Awaiting_Result_Query='';

    $PR_Verification_Num="-";
    $PR_Verification_Status=0;
    $PR_Verification_Stage=0;
    $PR_Verification_Query="";


   


    $BankConfirmationFollowup="-";
    $BankConfirmationFollowup_Status=0;
    $BankConfirmationFollowup_Stage=0;
    $BankConfirmationFollowup_Query="";

    $BankConfirmationExtOverall="-";
    $BBankConfirmationExtOverall_Status=0;
    $BankConfirmationExtOverall_Stage=0;
    $BankConfirmationExtOverall_Query="";


    $BankConfirmationExtCurrent="-";
    $BBankConfirmationExtCurrent_Status=0;
    $BankConfirmationExtCurrent_Stage=0;
    $BankConfirmationExtCurrent_Query="";

    
    $EOA_Prepre_CurExt_Num="-";
    $EOA_Prepre_CurExt_Status=0;
    $EOA_Prepre_CurExt_Stage=0;
    $EOA_Prepre_CurExt_Query="";

    $EOA_Prepre_OverallExt_Num="-";
    $EOA_Prepre_OverallExtt_Status=0;
    $EOA_Prepre_OverallExt_Stage=0;
    $EOA_Prepre_OverallExt_Query="";



    $EOA_Proc_CurExt_Num="-";
    $EOA_Proc_CurExt_Status=0;
    $EOA_Proc_CurExt_Stage=0;
    $EOA_Proc_CurExt_Query="";

    $EOA_Proc_OverallExt_Num="-";
    $EOA_Proc_OverallExtt_Status=0;
    $EOA_Proc_OverallExt_Stage=0;
    $EOA_Proc_OverallExt_Query="";

  

    $EOA_Prep_NI = "-";
    $EOA_Prep_NI_Status = 0;
    $EOA_Prep_NI_Stage = 0;
    $EOA_Prep_NI_Query = "";


    $FinalAdmissionOffer_Num="-";
    $FinalAdmissionOffer_Status=0;
    $FinalAdmissionOffer_Stage=0;
    $FinalAdmissionOffer_Query="";

    $EOA_NI_FB = "-";
    $EOA_NI_FB_Status = 0;
    $EOA_NI_FB_Stage = 0;
    $EOA_NI_FB_Query = "";
                                
        /********************** Declaring Variables - E N D - *****/






        /*********************************** Assigning Values *****/
        /**********************************************************/
        foreach ($data['full'] as $dd) 
        {

            if($dd['form_status_id']==9999 && $dd['form_status_stage_id']==9999){
                $ad_full_issuance_statusID = 9900;
                $ad_full_issuance_stageID = 9900;
                $ad_full_issuance_query =  '(af.form_status_id >= 1) group by af.id';
                $ad_full_issuance = $dd['num'];

            }
            if($dd['form_status_id']==9988 && $dd['form_status_stage_id']==9988){
                $ad_full_issuanceExtentionCurrent_statusID = 1808201;
                $ad_full_issuanceExtentionCurrent_stageID = 1808201;
                $ad_full_issuanceExtentionCurrent = $dd['num'];
                $ad_full_issuanceExtentionCurrent_query = "(af.form_status_id=1) and ( af.form_status_stage_id <= 3 ) and (af.form_submission_date >= curdate()) ";
            }
                        
            if($dd['form_status_id']==9981 && $dd['form_status_stage_id']==9981)
            {
                $ad_full_issuanceExtentionCurrentRed = $dd['num'];
            }
                        
            if($dd['form_status_id']==9977 && $dd['form_status_stage_id']==9977){
                $ad_full_issuanceExtention_statusID = 9900;
                $ad_full_issuanceExtention_stageID = 9900;
                $ad_full_issuanceExtention = $dd['num'];
                //$ad_full_issuanceExtention_query = "(af.form_assessment_date = '0000-00-00')";
                                $ad_full_issuanceExtention_query = "(af.form_status_id = 1 and af.form_status_stage_id = 10 ) group by af.id";
                                
                                
            }
                        
                        if($dd['form_status_id']==9978 && $dd['form_status_stage_id']==9978)
                        {
                $ad_full_issuanceExtention_statusID_over = 9900;
                $ad_full_issuanceExtention_stageID_over = 9900;
                $ad_full_issuanceExtention_over = $dd['num'];
                //$ad_full_issuanceExtention_query = "(af.form_assessment_date = '0000-00-00')";
                                $ad_full_issuanceExtention_query_over = "(af.form_status_id = 1 and af.form_status_stage_id = 10 ) and from_unixtime(af.modified, '%Y-%m-%d') < ( curdate() - interval 2 day ) group by af.id";
                                
                                
            }





            if($dd['form_status_id']==8888 && $dd['form_status_stage_id']==8888){
                $ad_full_submission_statusID = 9900;
                $ad_full_submission_stageID = 9900;
                $ad_full_submission = $dd['num'];
                $ad_full_submmision_query = "af.form_assessment_date != '0000-00-00' group by af.id";
            }  
            if($dd['form_status_id']==8899 && $dd['form_status_stage_id']==8899){
                $ad_full_submissionOffer_statusID = 9936;
                $ad_full_submissionOffer_stageID = 9936;
                $ad_full_submissionOffer = $dd['num'];
               $ad_full_submmisionOffer_query = "(
                                ( af.form_status_id=1 and af.form_submission_date < curdate() and af.form_assessment_date='0000-00-00' )
                                and ( af.form_status_stage_id not in (7,10))
                                and( lgs.new_form_status = 1 ) and ( lgs.new_form_stage = 7 or lgs.new_form_stage = 10 ) 
                                ) ";
                                

            }
            if($dd['form_status_id']==8877 && $dd['form_status_stage_id']==8877){
                $ad_full_submissionExtention_statusID = 9999;
                $ad_full_submissionExtention_stageID = 9999;
                $ad_full_submissionExtention = $dd['num'];
                $ad_full_submmisionExtention_query = "(lgs.new_form_stage = 10) and (lgs.new_form_status = 1)";
            }
            if($dd['form_status_id']==8866 && $dd['form_status_stage_id']==8866){
                $ad_full_submissionFollowup_statusID = 1808202;
                $ad_full_submissionFollowup_stageID = 1808202;
                $ad_full_submissionFollowup = $dd['num'];
                #$ad_full_submmisionFollowup_query = "af.form_assessment_date = '0000-00-00' and af.form_submission_date < CURDATE() and af.form_status_stage_id != 7";
$ad_full_submmisionFollowup_query =  "( af.form_status_id=1 and af.form_submission_date < curdate()) and ( af.form_status_stage_id not in (7,10)) group by af.id";
            } 
            if($dd['form_status_id']==8867 && $dd['form_status_stage_id']==8867){
                $ad_full_submissionFollowupOver_statusID = 9999;
                $ad_full_submissionFollowupOver_stageID = 9999;
                $ad_full_submissionFollowupOver = $dd['num'];
                $ad_full_submmisionFollowupOver_query = "af.form_assessment_date = '0000-00-00'
                    and af.form_submission_date < CURDATE()-2
                    and af.form_status_stage_id != 7 group by af.id";
            }
            if($dd['form_status_id']==8855 && $dd['form_status_stage_id']==8855){
               $ad_full_submissionNotInterested_statusID = 9944;
                $ad_full_submissionNotInterested_stageID = 9944;
                $ad_full_submissionNotInterested = $dd['num'];
                $ad_full_submmisionNotInterested_query =  urlencode ("select af.id as Form_id
                        from atif_gs_admission.admission_form as af 
                        where  af.form_status_id=1
                        and af.form_status_stage_id=7");
                #$ad_full_submmisionNotInterested_query = "( af.form_status_id=1 and af.form_status_stage_id=7 ) group by af.id";
            }
            if($dd['form_status_id']==8844 && $dd['form_status_stage_id']==8844){
                $ad_full_submissionExtentionCurrent_statusID = 9900;
                $ad_full_submissionExtentionCurrent_stageID = 9900;
                $ad_full_submissionExtentionCurrent = $dd['num'];
                $ad_full_submissionExtentionCurrent_query = "(af.form_status_stage_id = 10 and af.form_status_id = 2) group by af.id";
            }
                        
                        if($dd['form_status_id']==8841 && $dd['form_status_stage_id']==8841){
                $ad_full_submissionExtentionCurrentOver = $dd['num'];
                
            }

            if($dd['form_status_id']==7799 && $dd['form_status_stage_id']==7799){
                $ad_full_submissionTBI_Current_statusID = 9900;
                $ad_full_submissionTBI_Current_stageID = 9900;
                $ad_full_submissionTBI_Current = $dd['num'];
                                $ad_full_submmisionTBI_Current_query = "(af.form_status_id=2 and af.form_assessment_date = '2001-01-01' and af.form_status_stage_id=12 )";
            }
                        
                        
                          if($dd['form_status_id']==77099 && $dd['form_status_stage_id']==77099){
                $ad_full_submissionTBI_Current_statusID2 = 9900;
                $ad_full_submissionTBI_Current_stageID2 = 9900;
                $ad_full_submissionTBI_Current2 = $dd['num'];
                                $ad_full_submmisionTBI_Current_query2 = "( af.form_assessment_date = '2001-01-01'
                                and (from_unixtime(af.modified, '%Y-%m-%d') < ( CURDATE() - INTERVAL 2 day )  ) group by af.id";
                                
                                
            }








            if($dd['form_status_id']==7788 && $dd['form_status_stage_id']==7788)
                        {
                $ad_full_submissionTBIOver_statusID = 9903;
                $ad_full_submissionTBIOver_stageID = 9903;
                $ad_full_submissionTBIOver = $dd['num'];
                $ad_full_submmisionTBIOver_query = "( ls.new_form_status=2 and ls.new_form_stage=12 and ls.`type`='G' ) group by af.id";

                
                                //$ad_full_submissionTBI2 = $ad_full_assessment;
            }
                        
                         if($dd['form_status_id']==77088 && $dd['form_status_stage_id']==77088){
                $ad_full_assessment_statusID = 9937;
                $ad_full_assessment_stageID = 9937;
                $ad_full_assessment2 = $dd['num'];
                $ad_full_assessment_query = "( ls.new_form_status=2 and ls.old_form_stage=12 and ls.`type`='G' ) group by af.id";

            }
                        
            if($dd['form_status_id']==7777 && $dd['form_status_stage_id']==7777){
                $ad_full_assessmentCurrent_statusID = 1808203;
                $ad_full_assessmentCurrent_stageID = 1808203;
                $ad_full_assessmentCurrent = $dd['num'];
                                
                /*$ad_full_assessmentCurrent_query = "(af.form_dd = '0000-00-00' and af.form_assessment_date != '0000-00-00' and af.form_assessment_date != '2001-01-01' and af.form_status_stage_id != 7
                    and af.form_status_stage_id != 15 and af.form_assessment_date > CURDATE())"; */
                                        
                                $ad_full_assessmentCurrent_query = "af.form_status_id=2 and (af.form_assessment_date >= curdate()) and af.form_status_stage_id < 4 group by af.id";
                                        
                                
            }
            if($dd['form_status_id']==7766 && $dd['form_status_stage_id']==7766){
                $ad_full_assessmentPresence_statusID = 9902;
                $ad_full_assessmentPresence_stageID = 9902;
                $ad_full_assessmentPresence = $dd['num'];
                $ad_full_assessmentPresence_query = "(lgs.new_form_stage = 4) and (lgs.new_form_status = 3) group by af.id";

                                $ad_full_submissionTBI = $ad_full_assessment - $ad_full_submissionTBI_Current;
            }
            if($dd['form_status_id']==7755 && $dd['form_status_stage_id']==7755){
                $ad_full_assessmentFollowup_statusID = 9941;
                $ad_full_assessmentFollowup_stageID = 9941;
                $ad_full_assessmentFollowup = $dd['num'];
                                
                $ad_full_assessmentFollowup_query = "(af.form_status_id=2) ";
                                
            }
            if($dd['form_status_id']==7744 && $dd['form_status_stage_id']==7744){
                $ad_full_assessmentFollowup_Current_statusID = 7744;
                $ad_full_assessmentFollowup_Current_stageID = 7744;
                $ad_full_assessmentFollowup_Current = $dd['num'];
               # $ad_full_assessmentFollowup_Current_query = "af.form_status_id=2 and af.form_assessment_date < CURDATE() and ( af.form_status_stage_id <= 5 or af.form_status_stage_id = 11 ) group by af.id";
              $ad_full_assessmentFollowup_Current_query = "
                
                (`af`.`form_status_id`=2 and `af`.`form_assessment_date` < CURDATE()
            and `af`.`form_assessment_date` != '2001-01-01' 
            and ( `af`.`form_status_stage_id` not in (6,7,10,15,16,17) ) 
            and `af`.`form_discussion_date`='0000-00-00' ) group by af.id

                ";
                                
                                
            }
            if($dd['form_status_id']==7733 && $dd['form_status_stage_id']==7733){
                //$ad_full_assessmentFollowup_CurrentOver_statusID = 9999;
                //$ad_full_assessmentFollowup_CurrentOver_stageID = 9999;
                //$ad_full_assessmentFollowup_CurrentOver = $ad_full_assessmentFollowup_Current;
                $ad_full_assessmentFollowup_CurrentOver = $dd['num'];
                //$ad_full_assessmentFollowup_CurrentOver_query = "";
            }
            if($dd['form_status_id']==7722 && $dd['form_status_stage_id']==7722){
                $ad_full_assessmentExtention = $dd['num'];
                $ad_full_assessmentExtention_statusID = 9999;
                $ad_full_assessmentExtention_stageID = 9999;
                $ad_full_assessmentExtention_query = "(lgs.new_form_stage = 10 or lgs.old_form_stage=10 ) 
                and (lgs.new_form_status = 2) group by af.id";
            }
            if($dd['form_status_id']==7711 && $dd['form_status_stage_id']==7711){
                $ad_full_assessmentNotInterested = $dd['num'];
                $ad_full_assessmentNotInterested_statusID = 9999;
                $ad_full_assessmentNotInterested_stageID = 9999;
                $ad_full_assessmentNotInterested_query = "(lgs.new_form_stage = 7) and (lgs.new_form_status = 2) group by af.id";
            }
            if($dd['form_status_id']==7700 && $dd['form_status_stage_id']==7700){
                $ad_full_assessmentToday = $dd['num'];
                $ad_full_assessmentToday_statusID = 9999;
                $ad_full_assessmentToday_stageID = 9999;
                                
                $ad_full_assessmentToday_query = "( 
                               
                af.form_assessment_date != '2001-01-01' and af.form_status_id=3 and (af.form_status_stage_id = 4 ) and af.form_assessment_result ='' ) group by af.id "; 
            }
                        // After Assessment Currently on hold
            if($dd['form_status_id']==7701 && $dd['form_status_stage_id']==7701)
                        {
                                $ad_full_assessment_Onhold = $dd['num'];
                                $ad_full_assessment_Onhold_statusID = 9999;
                $ad_full_assessment_Onhold_stageID = 9999;
                $ad_full_assessment_Onhold_query = "(af.form_status_id = 3) and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16) group by af.id";
            }
                        
            if($dd['form_status_id']==7702 && $dd['form_status_stage_id']==7702)
                        {
                $ad_full_assessment_OnholdOver = $dd['num'];
            }
                        
            if($dd['form_status_id']==7703 && $dd['form_status_stage_id']==7703)
                        {
                $ad_full_assessmentWaitlist = $dd['num'];
                $ad_full_assessmentWaitlist_statusID = 9999;
                $ad_full_assessmentWaitlist_stageID = 9999;
                $ad_full_assessmentWaitlist_query = "(af.form_status_id = 3)
                    and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) group by af.id";
            }
                        
                        
                        
            if($dd['form_status_id']==7704 && $dd['form_status_stage_id']==7704){
                $ad_full_assessment_Regret = $dd['num'];
                $ad_full_assessment_Regret_statusID = 9944;
                $ad_full_assessment_Regret_stageID = 9944;
                $ad_full_assessment_Regret_query = urlencode (
                                
                        "select af.id as Form_id
                        from atif_gs_admission.admission_form as af 
                        where  af.form_status_id = 3 and af.form_status_stage_id=15 
                        and (`af`.`form_assessment_decision`='RGT' or `af`.`form_assessment_decision`='OHD')
                        
                        
                        
                                
                                ");
            }
            if($dd['form_status_id']==7705 && $dd['form_status_stage_id']==7705){
                $ad_full_assessment_RegretPO = $dd['num'];
                $ad_full_assessment_RegretPO_statusID = 9944;
                $ad_full_assessment_RegretPO_stageID = 9944;
                $ad_full_assessment_RegretPO_query = urlencode ("
                                
                                
                                
                                select af.id as Form_id
                        from atif_gs_admission.admission_form as af 
                        where  af.form_status_id = 3 and af.form_status_stage_id=15 
                        and (`af`.`form_assessment_decision` ='WIL')
                        
                        
                                ");
            }
                        
                        
                        
            if($dd['form_status_id']==7706 && $dd['form_status_stage_id']==7706)
                        {
                $ad_full_assessment_Waitlist_Current = $dd['num'];
                                $ad_full_assessment_Waitlist_Current_statusID = 9999;
                $ad_full_assessment_Waitlist_Current_stageID = 9999;
                $ad_full_assessment_Waitlist_Current_query = "(af.form_status_id = 3)
                    and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) group by af.id";
            }
            if($dd['form_status_id']==7707 && $dd['form_status_stage_id']==7707)
                        {
                $ad_full_assessment_Waitlist_CurrentOver = $dd['num'];
                                $ad_full_assessment_Waitlist_CurrentOver_statusID = 9999;
                $ad_full_assessment_Waitlist_CurrentOver_stageID = 9999;
                                $ad_full_assessment_Waitlist_CurrentOver_query = "af.form_assessment_decision='WIL' and from_unixtime(af.modified) < ( curdate()- interval 2 day ) group by af.id";
                                
            }
            if($dd['form_status_id']==7708 && $dd['form_status_stage_id']==7708){
                $ad_full_assessment_AfterWaitlist = $dd['num'];
                $ad_full_assessment_AfterWaitlist_statusID = 9999;
                $ad_full_assessment_AfterWaitlist_stageID = 9999;
                $ad_full_assessment_AfterWaitlist_query = "(((lgs.old_form_stage = 9 or lgs.old_form_stage = 17) 
                and (lgs.new_form_status = 3))  ) group by af.id";
            }
            if($dd['form_status_id']==7709 && $dd['form_status_stage_id']==7709){
                $ad_full_assessmentExtentionCurrent = $dd['num'];
                $ad_full_assessmentExtentionCurrent_statusID = 9900;
                $ad_full_assessmentExtentionCurrent_stageID = 9900;
                $ad_full_assessmentExtentionCurrent_query = "(af.form_status_stage_id = 10
                and af.form_status_id = 3) group by af.id";
            }












            if($dd['form_status_id']==6666 && $dd['form_status_stage_id']==6666)
                        {
                $ad_full_discussion = $dd['num'];
                $ad_full_discussion_statusID = 9999;
                $ad_full_discussion_stageID = 9999;
                $ad_full_discussion_query = "(
                                af.form_status_id=3
                                and af.form_dd >= CURDATE()
                        and af.form_status_stage_id=13) group by af.id";
            }
            if($dd['form_status_id']==6655 && $dd['form_status_stage_id']==6655){
                $ad_full_discussionPresence = $dd['num'];
                $ad_full_discussionPresence_statusID = 9902;
                $ad_full_discussionPresence_stageID = 9902;
                $ad_full_discussionPresence_query = "(lgs.new_form_stage = 4) and (lgs.new_form_status = 4) group by af.id";
            }
            if($dd['form_status_id']==6644 && $dd['form_status_stage_id']==6644){
                $ad_full_discussion_Followup = $dd['num'];
                $ad_full_discussion_Followup_statusID = 9942;
                $ad_full_discussion_Followup_stageID = 9942;
                $ad_full_discussion_Followup_query = "( af.form_status_id = 3 ) ";
            }
            if($dd['form_status_id']==6633 && $dd['form_status_stage_id']==6633){
                $ad_full_discussion_FollowupCurrent = $dd['num'];
                $ad_full_discussion_FollowupCurrent_statusID = 6633;
                $ad_full_discussion_FollowupCurrent_stageID = 6633;
                                
              /*  $ad_full_discussion_FollowupCurrent_query = "( af.form_status_id=3
                        and
                        af.form_status_stage_id=13
                        and af.form_discussion_date < curdate() ) group by af.id";*/
                        
                        
                        $ad_full_discussion_FollowupCurrent_query = "( ( af.form_status_id=3 )
                            and ( af.form_status_stage_id not in (4,6,7,8,10,15,16,17))
                            #and af.form_discussion_date != '0000-00-00'
                            and af.form_discussion_date < curdate() )  group by af.id ";
            }
                        
            if($dd['form_status_id']==6622 && $dd['form_status_stage_id']==6622)
                        
                        {
                $ad_full_discussion_FollowupCurrentOver = $dd['num'];
                $ad_full_discussion_FollowupCurrentOver_statusID = 9999;
                $ad_full_discussion_FollowupCurrentOver_stageID = 9999;
                $ad_full_discussion_FollowupCurrentOver_query = " ( lgs.new_form_status=3 and lgs.new_form_stage=10 )";
                                
                                
            }
            
                        
                        
                        if($dd['form_status_id']==6611 && $dd['form_status_stage_id']==6611)
                        {
                $ad_full_discussionNotInterested_statusID = 9999;
                $ad_full_discussionNotInterested_stageID = 9999;
                $ad_full_discussionNotInterested = $dd['num'];
                                
                $ad_full_discussionNotInterested_query = "( ( lgs.new_form_status=3 or lgs.new_form_status=4) and lgs.new_form_stage=7 )";
                        }
                        
                        
                        
            if($dd['form_status_id']==6600 && $dd['form_status_stage_id']==6600){
                $ad_full_discussionCurrent = $dd['num'];
                $ad_full_discussionCurrent_statusID = 9999;
                $ad_full_discussionCurrent_stageID = 9999;
                $ad_full_discussionCurrent_query = "( ( af.form_status_id=4 or  af.form_status_id=5) and (  af.form_status_stage_id = 4  ) ) group by af.id";
            }
                        
                        
                        if($dd['form_status_id']==6601 && $dd['form_status_stage_id']==6601)
                        {
                $ad_full_discussion_Onhold = $dd['num'];
                $ad_full_discussion_Onhold_statusID = 9999;
                $ad_full_discussion_Onhold_stageID = 9999;
                $ad_full_discussion_Onhold_query = "af.form_status_id=4 and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16) group by af.id";
            }
                        
                        if($dd['form_status_id']==6602 && $dd['form_status_stage_id']==6602)
                        {
                $ad_full_discussion_OnholdOver = $dd['num'];
                $ad_full_discussion_OnholdOver_statusID = 9999;
                $ad_full_discussion_OnholdOver_stageID = 9999;
                $ad_full_discussion_OnholdOver_query = "af.form_status_id=4 and (af.form_status_stage_id = 8 or af.form_status_stage_id = 16) group by af.id";
            }
                        
                        
                        
                        if($dd['form_status_id']==6603 && $dd['form_status_stage_id']==6603)
                        {
                $ad_full_discussion_Waitlist_Current = $dd['num'];
                $ad_full_discussion_Waitlist_Current_statusID = 9945;
                $ad_full_discussion_Waitlist_Current_stageID = 9945;
                $ad_full_discussion_Waitlist_Current_query = "";
            }
                        
                        if($dd['form_status_id']==6610 && $dd['form_status_stage_id']==6610)
                        {
                $ad_full_discussion_Waitlist_CurrentThreeOver = $dd['num'];
                
            }
                        
            if($dd['form_status_id']==6604 && $dd['form_status_stage_id']==6604){
                $ad_full_discussion_Regret = $dd['num'];
                $ad_full_discussion_Regret_statusID = 9944;
                $ad_full_discussion_Regret_stageID = 9944;
                $ad_full_discussion_Regret_query = urlencode ("

select af.id as Form_id
                        from atif_gs_admission.admission_form as af
                        where (af.form_status_id=4 or af.form_status_id=5)
                        and af.form_status_stage_id=15 
                        and (`af`.`form_discussion_decision` ='RGT' or `af`.`form_discussion_decision`='OHD')
                        ");
            }
                        
                        
            if($dd['form_status_id']==6605 && $dd['form_status_stage_id']==6605)
                        {
                $ad_full_discussion_RegretPO = $dd['num'];
                                
                $ad_full_discussion_RegretPO_statusID = 9944;
                                
                $ad_full_discussion_RegretPO_stageID2 = 9944;
                $ad_full_discussion_RegretPO_query = urlencode ("
                                select  
                        af.id as Form_id
                        from atif_gs_admission.admission_form as af
                        where (af.form_status_id=4 or af.form_status_id=5)
                        and `af`.`form_status_stage_id`=15 
                        and `af`.`form_discussion_decision`='WIL'
                                
                                ");
            }
                        
                        
                        if($dd['form_status_id']==6606 && $dd['form_status_stage_id']==6606)
                        {
                $ad_full_discussionWaitlist = $dd['num'];
                $ad_full_discussionWaitlist_statusID = 9999;
                $ad_full_discussion_RegretPO_stageID = 9999;
                $ad_full_discussionWaitlist_query = "(lgs.new_form_stage=9 or lgs.new_form_stage=17 ) 
                and (lgs.new_form_status = 4) group by af.id";
            }
                        
                        
                        
                        if($dd['form_status_id']==6607 && $dd['form_status_stage_id']==6607)
                        {
                $ad_full_discussion_AfterWaitlist = $dd['num'];
                $ad_full_discussion_AfterWaitlist_statusID = 9999;
                $ad_full_discussion_AfterWaitlist_stageID = 9999;
                $ad_full_discussion_AfterWaitlist_query = "(lgs.old_form_stage=9 or lgs.old_form_stage=17 ) 
                and (lgs.new_form_status = 4) group by af.id";
            } 
                        
                        
                        
                        if($dd['form_status_id']==6608 && $dd['form_status_stage_id']==6608)
                        {
                $ad_full_discussionExtentionCurrent = $dd['num'];
                $ad_full_discussionExtentionCurrent_statusID = 9999;
                $ad_full_discussionExtentionCurrent_stageID = 9999;
                $ad_full_discussionExtentionCurrent_query = "(af.form_status_id=4 and af.form_status_stage_id=10) group by af.id";
            }
                        
                        
                        if($dd['form_status_id']==6609 && $dd['form_status_stage_id']==6609)
                        {
                $ad_full_discussionExtentionCurrent_over = $dd['num'];
                
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
                    and af.form_status_stage_id != 7) group by af.id";
            }
            if($dd['form_status_id']==5588 && $dd['form_status_stage_id']==5588){
                $ad_full_PO_Approval = $dd['num'];
                $ad_full_PO_Approval_statusID = 9900;
                $ad_full_PO_Approval_stageID = 9900;
                $ad_full_PO_Approval_query = "(af.form_status_id >= 4
                    and af.form_dc != ''
                    and af.offer_date != '') group by af.id";
            }
            if($dd['form_status_id']==5577 && $dd['form_status_stage_id']==5577){
                $ad_full_PO_onHold = $dd['num'];
                $ad_full_PO_onHold_statusID = 9999;
                $ad_full_PO_onHold_stageID = 9999;
                $ad_full_PO_onHold_query = "(af.form_status_id >= 4
                    and af.form_status_stage_id = 16) group by af.id";
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
                    and (lgs.new_form_status >= 4) group by af.id";
            }
            if($dd['form_status_id']==5544 && $dd['form_status_stage_id']==5544){
                $ad_full_PO_Regret = $dd['num'];
                $ad_full_PO_Regret_statusID = 9999;
                $ad_full_PO_Regret_stageID = 9999;
                $ad_full_PO_Regret_query = "(af.form_status_id >= 4
                    and af.form_status_stage_id = 15) group by af.id";
            }
            if($dd['form_status_id']==5533 && $dd['form_status_stage_id']==5533){
                $ad_full_PO_Waitlist_to_Regret = $dd['num'];
                $ad_full_PO_Waitlist_to_Regret_statusID = 9999;
                $ad_full_PO_Waitlist_to_Regret_stageID = 9999;
                $ad_full_PO_Waitlist_to_Regret_query = "((lgs.old_form_stage = 9 or lgs.old_form_stage = 17) and (lgs.new_form_stage = 6 or lgs.new_form_stage = 15))
                    and (lgs.new_form_status >= 3) group by af.id";
            }
            if($dd['form_status_id']==5522 && $dd['form_status_stage_id']==5522){
                $ad_full_PO_WaitlistCurrent = $dd['num'];
                $ad_full_PO_WaitlistCurrent_statusID = 9999;
                $ad_full_PO_WaitlistCurrent_stageID = 9999;
                $ad_full_PO_WaitlistCurrent_query = "af.form_status_id >= 4
                    and (af.form_status_stage_id = 9 or af.form_status_stage_id = 17) group by af.id";
            }
            if($dd['form_status_id']==5511 && $dd['form_status_stage_id']==5511)
                        {
                $ad_full_PO_WaitlistCurrentOver = $ad_full_PO_WaitlistCurrent;
                $ad_full_PO_WaitlistCurrentOver_statusID = 9999;
                $ad_full_PO_WaitlistCurrentOver_stageID = 9999;
                $ad_full_PO_WaitlistCurrentOver_query = "";
            }
            if($dd['form_status_id']==5500 && $dd['form_status_stage_id']==5500)
                        {
                $ad_full_PO_Waitlist_to_Offer = $dd['num'];
                $ad_full_PO_Waitlist_to_Offer_statusID = 9999;
                $ad_full_PO_Waitlist_to_Offer_stageID = 9999;
                $ad_full_PO_Waitlist_to_Offer_query = "((lgs.old_form_stage = 9 or lgs.old_form_stage = 17 OR lgs.new_form_stage = 9 or lgs.new_form_stage = 17))
                    and (af.form_status_id >= 5) group by af.id";
            }
                        
            if($dd['form_status_id']==5501 && $dd['form_status_stage_id']==5501)
                        {
                $ad_full_PO_RegretAPR = $dd['num'];
                $ad_full_PO_RegretAPR_statusID = 9900;
                $ad_full_PO_RegretAPR_stageID = 9900;
                $ad_full_PO_RegretAPR_query = "((af.form_status_id = 15 ) ) group by af.id";
            }

            if($dd['form_status_id'] == 4499 && $dd['form_status_stage_id']== 4499 )
                        {
                                $ad_full_offer = $dd['num'];
                                $ad_full_offer_statusID = 9935;
                                $ad_full_offer_stageID = 9935;
                                $ad_full_offer_query = " ( lgs.new_form_status=5 and lgs.new_form_stage=2 ) group by lgs.admission_form_id";
                                $ad_full_offer_query = " ( af.form_status_id > 4  and af.form_status_stage_id  != 12 ) ";
                                
                                
                        }
                        
            if($dd['form_status_id']==4488 && $dd['form_status_stage_id']==4488)
                        {
                $ad_full_offerFollowup = $dd['num'];
                $ad_full_offerFollowup_statusID = 9938;
                $ad_full_offerFollowup_stageID = 9938;
                $ad_full_offerFollowup_query = "( af.form_status_stage_id < 4 and af.offer_date >= curdate() ) ";

            }
                        
                        
            if($dd['form_status_id']==4477 && $dd['form_status_stage_id']==4477)
                        {
               $ad_full_offerCurrenlty2Days  = $dd['num'];
                $ad_full_offerCurrenlty2Days_statusID  = 9999;
                $ad_full_offerCurrenlty2Days_stageID  = 9999;
                $ad_full_offerCurrenlty2Days_query  = "(af.offer_date != '0000-00-00'
                    and af.offer_date != '2001-01-01'
                    and af.offer_date < CURDATE()
                    and af.form_status_stage_id != 7
                    and afo.signed_offer_letter = 0
                    and af.form_status_stage_id != 6
                    and af.form_status_stage_id != 15) group by af.id";
            }
                        
                        
        if($dd['form_status_id']==4456 && $dd['form_status_stage_id']==4456){
                $ad_full_offerFollowupOver = $dd['num'];
                $ad_full_offerFollowupOver_statusID = 9946;
                $ad_full_offerFollowupOver_stageID = 9946;
                $ad_full_offerFollowupOver_query = "( ( af.form_status_stage_id != 7) 
        and( af.form_status_stage_id != 10 ) and af.offer_date < curdate() 
        and (afo.signed_offer_letter=0 or afo.offer_pack_handover=0)

        and (case when (af.grade_id = 15 or af.grade_id=16) then afo.post_result_verification_approval=1 
                and afo.early_admission_offer_pack_handover=1
                        and afo.early_admission_offer_letter=1
                                else true end )

        )";
            }
                        
                        
                        if($dd['form_status_id']==4458 && $dd['form_status_stage_id']==4458){
                                $ad_full_offerFollowupOver_red = $dd['num'];
            }
                        
                        
        if($dd['form_status_id']==4457 && $dd['form_status_stage_id']==4457){
        $ad_full_offerExtention = $dd['num'];

        //$ad_full_offerExtention_statusID = 9999;
        //$ad_full_offerExtention_stageID = 9999;

        $ad_full_offerExtention_statusID = 9944;
        $ad_full_offerExtention_stageID = 9944;

        
        /*$ad_full_offerExtention_query  = "( (lgs.new_form_stage = 10)  and (lgs.new_form_status = 5)  
        ) group by lgs.admission_form_id";  */

        $ad_full_offerExtention_query  =urlencode ("
                select  (lgs.admission_form_id) as form_id
                                from atif_gs_admission.log_form_status as lgs 
                                
                                left join atif_gs_admission.admission_form as af
                                on af.id = lgs.admission_form_id
                                
                                left join atif_gs_admission.admission_form_offer as fo
                                on fo.admission_form_id = lgs.admission_form_id 
                                
                                where lgs.new_form_status=5  
                                
                                and ( lgs.new_form_stage = 10 ) 
                                
                                and ( fo.signed_offer_letter=0)
                                
                                
                ");


        }
                        
                        
            if($dd['form_status_id']==4466 && $dd['form_status_stage_id']==4466){
                $ad_full_offerShowedup = $dd['num'];
                $ad_full_offerShowedup_statusID = 9944;
                $ad_full_offerShowedup_stageID = 9944;
                /*$ad_full_offerShowedup_query = "(af.form_status_id >= 5) 
                    and (af.is_OFL = 1) group by af.id";*/

                 $ad_full_offerShowedup_query =  urlencode ( "select af.form_id from atif_gs_admission.view_process_flow as af 
                                
                        left join atif_gs_admission.admission_form_offer as fo          
                        on `af`.`form_id` =  `fo`.`admission_form_id`
                                 
                                where (`af`.`form_status_id` >= 5) 
                                and (`af`.`is_OFL` = 1) 
                                and `fo`.`offer_letter`=1
                                and `fo`.`fif_form`=1
                                and `fo`.`photo_token`=1
                                and `fo`.`hand_book`=1
                                
                                and (  case 
                                when (`af`.`grade_id` = 15 or `af`.`grade_id`=16)
                                then `fo`.`post_result_verification_approval`=1 
                                and `fo`.`early_admission_offer_letter`=1
                                else true
                                end )" );
            }
            if($dd['form_status_id']==4455 && $dd['form_status_stage_id']==4455){
                $ad_full_offerFollowup_ALL = $dd['num'];
                $ad_full_offerFollowup_ALL_statusID = 9947;
                $ad_full_offerFollowup_ALL_stageID = 9947;
                $ad_full_offerFollowup_ALL_query = "(
                                af.form_status_id=5  and af.offer_date < curdate() 
                                and af.form_status_stage_id not in (7,10,16)
                                )";
            }
            if($dd['form_status_id']==4444 && $dd['form_status_stage_id']==4444){
                $ad_full_offer_NotInterested = $dd['num'];
                $ad_full_offer_NotInterested_statusID = 9944;
                $ad_full_offer_NotInterested_stageID = 9944;
                $ad_full_offer_NotInterested_query = urlencode (" 
                select af.id as Form_id
            from atif_gs_admission.admission_form as af 
            left join atif_gs_admission.admission_form_offer as fo
            on `fo`.`admission_form_id`=`af`.`id`
            where `af`.`form_status_id`=5 
            and `af`.`form_status_stage_id`=7
            and ( `fo`.`signed_offer_letter`=0 or `fo`.`signed_offer_letter`=0)
                ");
            }
                         
            if($dd['form_status_id']==4433 && $dd['form_status_stage_id']==4433){
                $ad_full_offered = $dd['num'];
                /*$ad_full_offered_statusID = 9943;
                $ad_full_offered_stageID = 9943;
                $ad_full_offered_query = "( af.form_status_id = 5)";*/

                $ad_full_offered_statusID = 9944;
                $ad_full_offered_stageID = 9944;
                $ad_full_offered_query = urlencode (" 
                                select af.id as Form_id
                        from atif_gs_admission.admission_form as af 
                        left join atif_gs_admission.admission_form_offer as fo
                        on `fo`.`admission_form_id`=`af`.`id`
                        where `af`.`form_status_id`=5 
                        and ( `af`.`form_status_stage_id`=1 or `af`.`form_status_stage_id`=3)
                        and ( `fo`.`signed_offer_letter`=1 or `fo`.`offer_pack_handover`=1)
                        and ( `fo`.`completed_fif_form`=0 or `fo`.`signed_hand_book`=0)
                        and `af`.`offer_date` >= curdate()

                        and (  case 
                                when (`af`.`grade_id` = 15 or `af`.`grade_id`=16)
                                then `fo`.`post_result_verification_approval`=1 
                                and `fo`.`early_admission_signed_offer_letter`=1
                                else true
                                end )

                                ");



            }
                        
                        $ad_full_offered_red=0;
                        if($dd['form_status_id']==4434 && $dd['form_status_stage_id']==4434){
                                $ad_full_offered_red = $dd['num'];
            }
                        
                        
                        
                        if($dd['form_status_id']==1984 && $dd['form_status_stage_id']==1984)
                        {
                $ad_full_offered_complete_check = $dd['num'];
                $ad_full_offered_complete_check_statusID = 9944;
                $ad_full_offered_complete_check_stageID = 9944;
                $ad_full_offered_complete_check_query = urlencode (
                                "
                   
                   
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
                
                
                                
                                 " ) ;
                                
            }
            if($dd['form_status_id']==19084 && $dd['form_status_stage_id']==19084)
            {
                 $ad_full_offered_complete_checkOver = $dd['num'];
            }
                        
                        if($dd['form_status_id']==1985 && $dd['form_status_stage_id']==1985){
                $ad_full_offeredf_complete_check = $dd['num'];
                $ad_full_offeredf_complete_check_statusID = 9948;
                $ad_full_offeredf_complete_check_stageID = 9948;
                $ad_full_offeredf_complete_check_query = urlencode (" 
                
                
                                    select ( af.id) as Form_id
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
                                then `fo`.`post_result_verification_approval`=1 
                                and `fo`.`early_admission_signed_offer_letter`=1
                                else true
                                end ) 

                                
                                
                                
                        Break_Query
                        
                       union
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
and ( af.form_status_stage_id != 7) and (af.form_status_stage_id != 10 )
and ( fbr.received_amount is null )

and ( fo.signed_offer_letter=1 or fo.offer_pack_handover=1 )
and af.offer_date < curdate()
and (  case 
                                when (af.grade_id = 15 or af.grade_id=16)
                                then fo.post_result_verification_approval=1 and fo.early_admission_signed_offer_letter=1
                                else true
                                end )

                                
                                ");
            }
                        
                        
                        if($dd['form_status_id']==1986 && $dd['form_status_stage_id']==1986)
                        {
                $ad_full_offerede_complete_check = $dd['num'];
                $ad_full_offerede_complete_check_statusID = 9944;
                $ad_full_offerede_complete_check_stageID = 9944;
                $ad_full_offerede_complete_check_query = urlencode (" 
                
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
                
                
                
                ");
            }
                        
                        
                        if($dd['form_status_id']==1987 && $dd['form_status_stage_id']==1987)
                        {
               $ad_full_complete_checknNotInterested = $dd['num'];
                $ad_full_complete_checkNotInterested_statusID = 9999;
                $ad_full_complete_checkNotInterested_stageID  = 9999;
                $ad_full_complete_checkNotInterested_query  = "( 
                                af.form_status_id=5
                        and af.form_status_stage_id=7
                        and ( afo.completed_fif_form=1 )
                        
                        
                                 ) group by af.id";
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
                                
                $ad_full_admission_Followup_statusID = 1983;
                $ad_full_admission_Followup_stageID = 1983;
                                
                $ad_full_admission_Followup_query = "( ( afo.completed_fif_form=0 or afo.signed_hand_book=0) ) 
                                #group by af.id ";

                #$ad_full_admission_FollowupOver = $ad_full_admission_Followup;
                                $ad_full_admission_FollowupOver = 0;
            }
                        
                        
                        if($dd['form_status_id']==3321 && $dd['form_status_stage_id']==3321)
                        {
                                $ad_full_admission_FollowupOver = $dd['num'];
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






if($dd['form_status_id']== 3301 && $dd['form_status_stage_id']== 3301)
        {
            $ROA_Overall_Total = $dd['num'];
            $ROA_Overall_Status = 1808204;
            $ROA_Overall_Stage = 1808204;
            $ROA_Overall_Query = " ( `af`.`grade_id`=15 or `af`.`grade_id`=16) and (`af`.`form_discussion_criteria` ='RAO') 
                and `af`.`form_status_stage_id` != 12
                group by af.form_id
            ";
        }


        if($dd['form_status_id']== 3302 && $dd['form_status_stage_id']== 3302)
        {
            $ROA_WaitingR_Total = $dd['num'];
            $ROA_WaitingR_Status = 1808204;
            $ROA_WaitingR_Stage = 1808204;
            $ROA_WaitingR_Query = " ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
            and (`af`.`form_discussion_criteria` ='RAO') 
            and `af`.`form_status_stage_id` != 12 group by af.form_id ";

        }


        if($dd['form_status_id']== 3303 && $dd['form_status_stage_id']== 3303)
        {
            $EOA_Overall_Total = $dd['num'];
            $EOA_Overall_Status = 1808205;
            $EOA_Overall_Stage = 1808205;
            $EOA_Overall_Query = " (( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
            and (`af`.`form_discussion_criteria` ='EAO') 
            and `af`.`form_status_stage_id` != 12 ) group by af.form_id";
        }

        if ($dd['form_status_id'] == 3304 && $dd['form_status_stage_id'] == 3304) {
            $In_EOA_Prep_Total = $dd['num'];
            $In_EOA_Prep_Status = 9944;
            $In_EOA_Prep_Stage = 9944;
           


              $In_EOA_Prep_Query = urlencode(
                "select (af.id) as Form_id
                from atif_gs_admission.admission_form as af
                left join atif_gs_admission.admission_form_offer as afo
                on afo.admission_form_id = af.id
                where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
                and (`af`.`form_discussion_criteria` ='EAO')

                and (`afo`.`early_admission_offer_letter`=0 or `afo`.`early_admission_offer_letter` is null )
and (`afo`.`early_admission_print_fee_bill`=0 or `afo`.`early_admission_print_fee_bill` is null )


                and `af`.`offer_date` >= curdate()
                and `af`.`form_status_stage_id` = 2


                union

                select (af.id) as Form_id
                from atif_gs_admission.admission_form as af
                left join atif_gs_admission.admission_form_offer as afo
                on `afo`.`admission_form_id` = `af`.`id`
                where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
                and (`af`.`form_discussion_criteria` ='EAO') 
                and `af`.`form_status_stage_id` = 2
                and `af`.`offer_date` >= curdate()
                and (`afo`.`early_admission_offer_letter`=1 )
                and ( `afo`.`early_admission_print_fee_bill`=1  )

                and ( `afo`.`early_admission_signed_offer_letter`=0 )
                and (`afo`.`early_admission_offer_pack_handover`=0)
                


                ");

        }

        if ($dd['form_status_id'] == 3305 && $dd['form_status_stage_id'] == 3305)
         {
            $Move_To_EOA_Proc_Total = $dd['num'];
            $Move_To_EOA_Proc_Status = 9944;
            $Move_To_EOA_Proc_Stage = 9944;
            $Move_To_EOA_Proc_Query = urlencode ("
select (af.id) as Form_id
                from atif_gs_admission.admission_form as af
                left join atif_gs_admission.admission_form_offer as afo
                on `afo`.`admission_form_id` = `af`.`id`        

                where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
                and (`af`.`form_discussion_criteria` ='EAO') 
                and ( `afo`.`early_admission_offer_letter`=1)
                and ( `afo`.`early_admission_print_fee_bill`=1 )
                and ( `afo`.`early_admission_signed_offer_letter`=1 )
                and ( `afo`.`early_admission_offer_pack_handover`=1 )
               
                   ");
        }

        if ($dd['form_status_id'] == 3306 && $dd['form_status_stage_id'] == 3306)
         {
            $In_EOA_Proc_Total = $dd['num'];
            $In_EOA_Proc_Status = 9944;
            $In_EOA_Proc_Stage = 9944;
            


            $In_EOA_Proc_Query = urlencode(
                "
                select (af.id) as Form_id
                from atif_gs_admission.admission_form as af
                left join atif_gs_admission.admission_form_offer as afo
                on `afo`.`admission_form_id` = `af`.`id`

                left join  atif_fee_student.fee_bill fb on (SUBSTR(`fb`.`gb_id`,6,4) = `af`.`form_no` AND SUBSTR(`fb`.`gb_id`,3,2) = 72  
                AND `fb`.`bill_title` = 'Admission')

                left join atif_fee_student.fee_bill_received fbr 
                on (`fbr`.`fee_bill_id` = `fb`.`id`)

                where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
                and (`af`.`form_discussion_criteria` ='EAO')
                and `af`.`form_status_stage_id`=2
                
                and (`afo`.`early_admission_offer_letter`=1 )
                and ( `afo`.`early_admission_print_fee_bill`=1)
                and ( `afo`.`early_admission_signed_offer_letter`=1 )
                and (`afo`.`early_admission_offer_pack_handover`=1)
               
                and ( `fbr`.`fee_bill_id` is null) 
                and `fb`.`bill_due_date` >= curdate()


                ");

        }

        if ($dd['form_status_id'] == 3307 && $dd['form_status_stage_id'] == 3307)
         {
            $EOA_Prep_Overall_Awaiting_Result = $dd['num'];
            $EOA_Prep_Overall_Awaiting_Result_Status = 9944;
            $EOA_Prep_Overall_Awaiting_Result_Stage = 9944;
            $EOA_Prep_Overall_Awaiting_Result_Query = urlencode(
                "select (af.id) as Form_id
                                from atif_gs_admission.admission_form as af
                                left join atif_gs_admission.admission_form_offer as afo
                                on afo.admission_form_id = af.id

                                left join  atif_fee_student.fee_bill fb on (SUBSTR(fb.gb_id,6,4) = af.form_no AND SUBSTR(fb.gb_id,3,2) = 72  AND fb.bill_title = 'Admission')

                                left join atif_fee_student.fee_bill_received fbr on (fbr.fee_bill_id = fb.id)

                where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
                and (`af`.`form_discussion_criteria` ='EAO')
                                and (`afo`.`early_admission_offer_letter`=1 )
                                and (`afo`.`early_admission_print_fee_bill`=1)
                                and (`afo`.`early_admission_signed_offer_letter`=1 )
                                and (`afo`.`early_admission_offer_pack_handover`=1)

                                and ( `fbr`.`fee_bill_id` is not null) 
                                 ");
         }


 

         if ($dd['form_status_id'] == 3308 && $dd['form_status_stage_id'] == 3308)
         {
            $EOA_Prep_Followup = $dd['num'];
            $EOA_Prep_Followup_Status = 9944;
            $EOA_Prep_Followup_Stage = 9944;
            $EOA_Prep_Followup_Query = urlencode(
                "select (af.id) as Form_id
                                from atif_gs_admission.admission_form as af
                                left join atif_gs_admission.admission_form_offer as afo
                                on afo.admission_form_id = af.id
                where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
                and (`af`.`form_discussion_criteria` ='EAO')
                                and (`afo`.`early_admission_offer_letter`=0 or `afo`.`early_admission_offer_letter` is null )
and (`afo`.`early_admission_print_fee_bill`=0 or `afo`.`early_admission_print_fee_bill` is null )
                

                and `af`.`offer_date` < curdate()
                and `af`.`form_status_stage_id` = 2

                
                union

                select (af.id) as Form_id
                from atif_gs_admission.admission_form as af
                left join atif_gs_admission.admission_form_offer as afo
                on `afo`.`admission_form_id` = `af`.`id`
                where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
                and (`af`.`form_discussion_criteria` ='EAO') 
                and `af`.`form_status_stage_id` = 2
                and `af`.`offer_date` < curdate()
                and (`afo`.`early_admission_offer_letter`=1 )
                and ( `afo`.`early_admission_print_fee_bill`=1  )

                and ( `afo`.`early_admission_signed_offer_letter`=0 )
                and (`afo`.`early_admission_offer_pack_handover`=0)

                

                                ");
         }


        if ($dd['form_status_id'] == 3309 && $dd['form_status_stage_id'] == 3309)
         {
            $PR_Verification_Num = $dd['num'];
            $PR_Verification_Status = 9948;
            $PR_Verification_Stage = 9948;
            $PR_Verification_Query = urlencode(
                "select (af.id) as Form_id
                from atif_gs_admission.admission_form as af
                left join atif_gs_admission.admission_form_offer as afo
                on `afo`.`admission_form_id` = `af`.`id`

                left join  atif_fee_student.fee_bill fb on (SUBSTR(`fb`.`gb_id`,6,4) = `af`.`form_no` AND SUBSTR(fb.gb_id,3,2) = 72  AND `fb`.`bill_title` = 'Admission')

                left join atif_fee_student.fee_bill_received fbr on (`fbr`.`fee_bill_id` = `fb`.`id`)

                where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
                and `af`.`form_status_stage_id` = 2
                and (`af`.`form_discussion_criteria` ='EAO')
                and (`afo`.`early_admission_offer_letter`=1 )
                and (`afo`.`early_admission_print_fee_bill`=1)
                and (`afo`.`early_admission_signed_offer_letter`=1 )
                and (`afo`.`early_admission_offer_pack_handover`=1)
                and (`fbr`.`fee_bill_id` is not null) 
                
                Break_Query
                union
                select (af.id) as Form_id
                from atif_gs_admission.admission_form as af
                left join atif_gs_admission.admission_form_offer as afo
                on `afo`.`admission_form_id` = `af`.`id`

                
                where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
                and (`af`.`form_discussion_criteria` ='RAO')
                and `af`.`form_status_stage_id` = 2
                and (`afo`.`post_result_verification_approval` = 0 or `afo`.`post_result_verification_approval` is null )
                

                ");


         }



         if ($dd['form_status_id'] == 3310 && $dd['form_status_stage_id'] == 3310)
         {
            $BankConfirmationFollowup = $dd['num'];
            $BankConfirmationFollowup_Status = 9944;
            $BankConfirmationFollowup_Stage = 9944;
            $BankConfirmationFollowup_Query = urlencode(
                "
                select (af.id) as Form_id
                from atif_gs_admission.admission_form as af
                left join atif_gs_admission.admission_form_offer as afo
                on `afo`.`admission_form_id` = `af`.`id`

                left join  atif_fee_student.fee_bill fb on (SUBSTR(`fb`.`gb_id`,6,4) = `af`.`form_no`
                AND SUBSTR(`fb`.`gb_id`,3,2) = 72  
                AND `fb`.`bill_title` = 'Admission')

                left join atif_fee_student.fee_bill_received fbr on (`fbr`.`fee_bill_id` = `fb`.`id`)

                where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
                and (`af`.`form_discussion_criteria` ='EAO')
                and `af`.`form_status_stage_id`=2
                
                and ( `afo`.`early_admission_offer_letter`=1 )
                and ( `afo`.`early_admission_print_fee_bill`=1)
                and ( `afo`.`early_admission_signed_offer_letter`=1 )
                and ( `afo`.`early_admission_offer_pack_handover`=1)
                
                and ( `fbr`.`fee_bill_id` is null) 
                and `fb`.`bill_due_date` < curdate()
                
                ");
         }


if ($dd['form_status_id'] == 3101 && $dd['form_status_stage_id'] == 3101)
 {
    $EOA_Prepre_CurExt_Num = $dd['num'];
    $EOA_Prepre_CurExt_Status = 9944;
    $EOA_Prepre_CurExt_Stage = 9944;
    $EOA_Prepre_CurExt_Query = urlencode(
        " select (af.id) as Form_id
        from atif_gs_admission.admission_form as af
        left join atif_gs_admission.admission_form_offer as afo
        on `afo`.`admission_form_id` = `af`.`id`
        where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
        and (`af`.`form_discussion_criteria` ='EAO')
        and `af`.`form_status_stage_id`=10
        and (`afo`.`early_admission_offer_letter`=0 or `afo`.`early_admission_offer_letter` is null )
        and (`afo`.`early_admission_print_fee_bill`=0 or `afo`.`early_admission_print_fee_bill` is null )
        and (`afo`.`post_result_verification_approval` = 0 or `afo`.`post_result_verification_approval` is null )
        and `af`.`offer_date` >= curdate()");
 }

 if ($dd['form_status_id'] == 3102 && $dd['form_status_stage_id'] == 3102)
 {
    $EOA_Prepre_OverallExt_Num = $dd['num'];
    $EOA_Prepre_OverallExtt_Status = 9944;
    $EOA_Prepre_OverallExt_Stage = 9944;
    $EOA_Prepre_OverallExt_Query = urlencode(
        " select (af.id) as Form_id
        from atif_gs_admission.admission_form as af
        left join atif_gs_admission.admission_form_offer as afo
        on `afo`.`admission_form_id` = `af`.`id`
        left join atif_gs_admission.log_form_status as ls
        on `ls`.`admission_form_id` = `af`.`id`

        where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
        and (`af`.`form_discussion_criteria` ='EAO')
        
        and (`afo`.`early_admission_offer_letter`=0 or `afo`.`early_admission_offer_letter` is null )
        and (`afo`.`early_admission_print_fee_bill`=0 or `afo`.`early_admission_print_fee_bill` is null )
        and (`afo`.`post_result_verification_approval` = 0 or `afo`.`post_result_verification_approval` is null )
        and `ls`.`new_form_status`=5 and `ls`.`new_form_stage` = 10
         ");
 }

  if ($dd['form_status_id'] == 3103 && $dd['form_status_stage_id'] == 3103)
 {
    $EOA_Prep_NI = $dd['num'];
    $EOA_Prep_NI_Status = 9944;
    $EOA_Prep_NI_Stage = 9944;
    $EOA_Prep_NI_Query = urlencode(
        " select (af.id) as Form_id
        from atif_gs_admission.admission_form as af
        left join atif_gs_admission.admission_form_offer as afo
        on `afo`.`admission_form_id` = `af`.`id`
        left join atif_gs_admission.log_form_status as ls
        on `ls`.`admission_form_id` = `af`.`id`

        where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
        and (`af`.`form_discussion_criteria` ='EAO')
        
        and (`afo`.`early_admission_offer_letter`=0 or `afo`.`early_admission_offer_letter` is null )
        and (`afo`.`early_admission_print_fee_bill`=0 or `afo`.`early_admission_print_fee_bill` is null )
        and (`afo`.`post_result_verification_approval` = 0 or `afo`.`post_result_verification_approval` is null )
        and `ls`.`new_form_status`=5 and `ls`.`new_form_stage` = 7
         ");
 }



if ($dd['form_status_id'] == 3104 && $dd['form_status_stage_id'] == 3104)
 {
    $EOA_Proc_OverallExt_Num = $dd['num'];
    $EOA_Proc_OverallExtt_Status = 9944;
    $EOA_Proc_OverallExt_Stage = 9944;
    $EOA_Proc_OverallExt_Query = urlencode(
        " select (af.id) as Form_id
        from atif_gs_admission.admission_form as af
        left join atif_gs_admission.admission_form_offer as afo
        on `afo`.`admission_form_id` = `af`.`id`
        left join atif_gs_admission.log_form_status as ls
        on `ls`.`admission_form_id` = `af`.`id`

        where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
        and (`af`.`form_discussion_criteria` ='EAO')
        

        and (`afo`.`early_admission_offer_letter`=1  )
        and (`afo`.`early_admission_print_fee_bill`=1  )

        and (`afo`.`early_admission_signed_offer_letter`=1  )
        and (`afo`.`early_admission_offer_pack_handover`=1  )
        and (`afo`.`post_result_verification_approval` = 0 or `afo`.`post_result_verification_approval` is null )

        and `ls`.`new_form_status`=5 and `ls`.`new_form_stage` = 10
         ");
 }



if ($dd['form_status_id'] == 3105 && $dd['form_status_stage_id'] == 3105)
 {
    $EOA_Proc_CurExt_Num = $dd['num'];
    $EOA_Proc_CurExt_Status = 9944;
    $EOA_Proc_CurExt_Stage = 9944;
    $EOA_Proc_CurExt_Query = urlencode(
        " select (af.id) as Form_id
        from atif_gs_admission.admission_form as af
        left join atif_gs_admission.admission_form_offer as afo
        on `afo`.`admission_form_id` = `af`.`id`
        

        where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
        and (`af`.`form_discussion_criteria` ='EAO')
        and `af`.`form_status_stage_id`=10

        and (`afo`.`early_admission_offer_letter`=1  )
        and (`afo`.`early_admission_print_fee_bill`=1  )
        and (`afo`.`early_admission_signed_offer_letter`=1  )
        and (`afo`.`early_admission_offer_pack_handover`=1  )
        and (`afo`.`post_result_verification_approval` = 0 or `afo`.`post_result_verification_approval` is null )

        
         ");
 }



if ($dd['form_status_id'] == 3106 && $dd['form_status_stage_id'] == 3106)
 {
    $FinalAdmissionOffer_Num = $dd['num'];
    $FinalAdmissionOffer_Status = 9944;
    $FinalAdmissionOffer_Stage = 9944;
    $FinalAdmissionOffer_Query = urlencode(
        " select (af.id) as Form_id
        from atif_gs_admission.admission_form as af
        left join atif_gs_admission.admission_form_offer as afo
        on `afo`.`admission_form_id` = `af`.`id`
        left join  atif_fee_student.fee_bill fb on (SUBSTR(`fb`.`gb_id`,6,4) = `af`.`form_no`
                AND SUBSTR(`fb`.`gb_id`,3,2) = 72  AND `fb`.`bill_title` = 'Admission')

        left join atif_fee_student.fee_bill_received fbr on (`fbr`.`fee_bill_id` = `fb`.`id`)

        where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
        and (`af`.`form_discussion_criteria` ='EAO')
        and (`afo`.`early_admission_offer_letter`=1  )
        and (`afo`.`early_admission_print_fee_bill`=1  )
        and (`afo`.`early_admission_signed_offer_letter`=1  )
        and (`afo`.`early_admission_offer_pack_handover`=1  )
        and (`afo`.`post_result_verification_approval` = 1 )
        and ( `fbr`.`fee_bill_id` is not null) and `fbr`.`received_amount` > 0

        
         ");
 }



 if ($dd['form_status_id'] == 3107 && $dd['form_status_stage_id'] == 3107)
 {
    $EOA_NI_FB = $dd['num'];
    $EOA_NI_FB_Status = 9944;
    $EOA_NI_FB_Stage = 9944;
    $EOA_NI_FB_Query = urlencode(
        " select (af.id) as Form_id
        from atif_gs_admission.admission_form as af
        left join atif_gs_admission.admission_form_offer as afo
        on `afo`.`admission_form_id` = `af`.`id`

        where ( `af`.`grade_id`=15 or `af`.`grade_id`=16) 
        and (`af`.`form_discussion_criteria` ='EAO')
        and `af`.`form_status_stage_id`=7
        and (`afo`.`early_admission_offer_letter`=1  )
        and (`afo`.`early_admission_print_fee_bill`=1  )
        and (`afo`.`early_admission_signed_offer_letter`=1  )
        and (`afo`.`early_admission_offer_pack_handover`=1  )
        and (`afo`.`post_result_verification_approval` = 1 )

        

        
         ");
 }




        }




        /************************ Assigning Values - E N D - *****/







        $html .= 
                '<div class="issuanceArea absolute">
            <span class="totalApplicants tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Total Issuance"  id="status_stage" data-status="'.$ad_full_issuance_statusID.'" data-stage="'.$ad_full_issuance_stageID.'" data-query="'.$ad_full_issuance_query.'">'.$ad_full_issuance.'</a><span class="tooltiptext">Form Issuance</span></span>
        </div><!-- issuanceArea -->
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->        
        <div class="submissionArea absolute" style="background:#;">
            <!-- code edit to be done by ATN -->
            <span class="ApplicantsOnIssuanceToSubmission absolute"> <!-- CHange 1 -->
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Wait For Submission" id="status_stage" data-status="'.$ad_full_issuanceExtentionCurrent_statusID.'" data-stage="'.$ad_full_issuanceExtentionCurrent_stageID.'" data-query="'.$ad_full_issuanceExtentionCurrent_query.'">'.$ad_full_issuanceExtentionCurrent.'</a><span class="tooltiptext">Applications awaiting for submission</span> <span class="overdueApplicantsOnFollowUp RedColorClass">('.$ad_full_issuanceExtentionCurrentRed.')</span></span>
            </span>
            <!-- code edit to be done by ATN -->
            
           
            
            <span class="totalApplicantsOnSubmission absolute" >
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Form Submitted" id="status_stage" data-status="'.$ad_full_submission_statusID.'" data-stage="'.$ad_full_submission_stageID.'" data-query="'.$ad_full_submmision_query.'">'.$ad_full_submission.'</a><span class="tooltiptext">Admission forms submitted</span></span>
            </span>
                
            <span class="totalApplicantsOnTBI absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-title="Overall Submission TBI" data-target="#myModal" id="status_stage" data-status="'.$ad_full_submissionTBIOver_statusID.'" data-stage="'.$ad_full_submissionTBIOver_stageID.'" data-query="'.$ad_full_submmisionTBIOver_query.'">'.$ad_full_submissionTBIOver.'</a><span class="tooltiptext">Applicants in To Be Allocated</span></span>
            </span>
                         
            <span class="ApplicantsOnTBILeft absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Currently Submission TBI"  id="status_stage" data-status="'.$ad_full_submissionTBI_Current_statusID.'" data-stage="'.$ad_full_submissionTBI_Current_stageID.'" data-query="'.$ad_full_submmisionTBI_Current_query.'">'.$ad_full_submissionTBI_Current.'</a> <span class="overdueApplicantsOnTBI RedColorClass RedColorClass">('.$ad_full_submissionTBI_Current2.')</span><span class="tooltiptext">Applicants Currently in To Be Allocated</span></span>
            </span>
            <span class="totalApplicantsOnTBIAllocated absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Submission TBI To Allocated"  id="status_stage" data-status="'.$ad_full_assessment_statusID.'" data-stage="'.$ad_full_assessment_stageID.'" data-query="'.$ad_full_assessment_query.'">'.$ad_full_assessment2.'</a><span class="tooltiptext">Applicants Allocated</span></span>
            </span>
            <span class="followUpApplicants absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Submission Overall Followup"  id="status_stage" data-status="'.$ad_full_submissionOffer_statusID.'" data-stage="'.$ad_full_submissionOffer_stageID.'" data-query="'.$ad_full_submmisionOffer_query.'">'.$ad_full_submissionOffer.'</a><span class="tooltiptext">Applicants to be Followed up</span></span>
            </span>
            <!-- ATN -->
            <span class="EXTUpApplicantsCurrent absolute"> <!-- Change 2 -->
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Currently Submission Extension"  id="status_stage" data-status="'.$ad_full_issuanceExtention_statusID.'" data-stage="'.$ad_full_issuanceExtention_stageID.'" data-query="'.$ad_full_issuanceExtention_query.'">'.$ad_full_issuanceExtention.'</a><span class="tooltiptext">Applicants currently in Submission Extension</span> <span class="overdueApplicantsOnFollowUp RedColorClass RedColorClass">('.$ad_full_issuanceExtention_over.')</span> </span>
            </span>
            <!-- ATN -->
            
            <span class="followUpApplicantsCurrent absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Currently Submission Followup"  id="status_stage" data-status="'.$ad_full_submissionFollowup_statusID.'" data-stage="'.$ad_full_submissionFollowup_stageID.'" data-query="'.$ad_full_submmisionFollowup_query.'">'.$ad_full_submissionFollowup.'</a><span class="tooltiptext">Applicants currently in Followup</span> <span class="overdueApplicantsOnFollowUp RedColorClass RedColorClass">('.$ad_full_submissionFollowupOver.')</span></span>
            </span>
            <span class="followUpApplicantsNI absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" <a href="#" data-toggle="modal" data-target="#myModal" data-title="Not Interested at Submission"  id="status_stage" data-status="'.$ad_full_submissionNotInterested_statusID.'" data-stage="'.$ad_full_submissionNotInterested_stageID.'" data-query="'.$ad_full_submmisionNotInterested_query.'">'.$ad_full_submissionNotInterested.'</a><span class="tooltiptext">Applicants Not Interested</span></span>
            </span>
            <span class="followUpApplicantsExt absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Overall Submission Extension"  id="status_stage" data-status="'.$ad_full_submissionExtention_statusID.'" data-stage="'.$ad_full_submissionExtention_stageID.'" data-query="'.$ad_full_submmisionExtention_query.'">'.$ad_full_submissionExtention.'</a><span class="tooltiptext">Applicants for Submission Extension</span></span>
            </span>
        </div><!-- submissionArea -->
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->        
        <div class="assessmentArea absolute" style="background:#;">
                
                
            <span class="totalApplicantsOnAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Currently in Assessment"  id="status_stage" data-status="'.$ad_full_assessmentCurrent_statusID.'" data-stage="'.$ad_full_assessmentCurrent_stageID.'" data-query="'.$ad_full_assessmentCurrent_query.'">'.$ad_full_assessmentCurrent.'</a><span class="tooltiptext">Applicants currently in Assessment</span></span>
            </span>
                        
                        
            <span class="totalApplicantsOnAssessmentOverAll absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Overall Applicants Move To Assessment"  id="status_stage" data-status="'.$ad_full_assessmentPresence_statusID.'" data-stage="'.$ad_full_assessmentPresence_stageID.'" data-query="'.$ad_full_assessmentPresence_query.'">'.$ad_full_assessmentPresence.'</a><span class="tooltiptext">Overall applicants moved to Assessment Process</span></span>
            </span>
                        
                        
            <span class="totalApplicantsOnAssessmentPresent absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Total Applicants On Assessment Present"  id="status_stage" data-status="'.$ad_full_assessmentToday_statusID.'" data-stage="'.$ad_full_assessmentToday_stageID.'" data-query="'.$ad_full_assessmentToday_query.'">'.$ad_full_assessmentToday.'</a><span class="tooltiptext">Applicants showed up for Assessment</span></span>
            </span>
                        
                        
            <span class="totalApplicantsOnWTLAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Move to Waitlist"  id="status_stage" data-status="'.$ad_full_assessmentWaitlist_statusID.'" data-stage="'.$ad_full_assessmentWaitlist_stageID.'" data-query="'.$ad_full_assessmentWaitlist_query.'">'.$ad_full_assessmentWaitlist.'</a><span class="tooltiptext">Overall applicants moved to Waitlist</span></span>
            </span>
                        
                        
                        
                        
            <span class="ApplicantsOnWTLLeftAssessment absolute">
                <span class="tooltipp"><a href="#" data-title="Assessment currently in Waitlist" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_full_assessment_Waitlist_Current_statusID.'" data-stage="'.$ad_full_assessment_Waitlist_Current_stageID.'" data-query="'.$ad_full_assessment_Waitlist_Current_query.'" >'.$ad_full_assessment_Waitlist_Current.'</a><span class="tooltiptext">Applicants currently in Waitlist</span> <span class="overdueApplicantsOnWTLAssessment RedColorClass">('.$ad_full_assessment_Waitlist_CurrentOver.')</span></span>
            </span>
                        
                        
                        
                        
                        
                        
                        
            <span class="totalApplicantsFromWTLToRGT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="From waitlist to regret"  id="status_stage" data-status="'.$ad_full_assessment_RegretPO_statusID.'" data-stage="'.$ad_full_assessment_RegretPO_stageID.'" data-query="'.$ad_full_assessment_RegretPO_query.'">'.$ad_full_assessment_RegretPO.'</a><span class="tooltiptext">Overall applicants moved to Regret by PO</span></span>
            </span>
                        
            <span class="totalApplicantsFromAssessmentToRGT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Assessment to regret"  id="status_stage" data-status="'.$ad_full_assessment_Regret_statusID.'" data-stage="'.$ad_full_assessment_Regret_stageID.'" data-query="'.$ad_full_assessment_Regret_query.'">'.$ad_full_assessment_Regret.'</a><span class="tooltiptext">Overall applicants moved to Regret First </span></span>
            </span>
            <span class="totalApplicantsPassedFromWTL absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Allocated from waitlist"  id="status_stage" data-status="'.$ad_full_assessment_AfterWaitlist_statusID.'" data-stage="'.$ad_full_assessment_AfterWaitlist_stageID.'" data-query="'.$ad_full_assessment_AfterWaitlist_query.'">'.$ad_full_assessment_AfterWaitlist.'</a><span class="tooltiptext">Overall applicants allocated from Waitlist</span></span>
            </span>
            <span class="followUpApplicants absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Assessment overall Followup"  id="status_stage" data-status="'.$ad_full_assessmentFollowup_statusID.'" data-stage="'.$ad_full_assessmentFollowup_stageID.'" data-query="'.$ad_full_assessmentFollowup_query.'">'.$ad_full_assessmentFollowup.'</a><span class="tooltiptext">Overall applicants moved to Followup</span></span>
            </span>
            <!-- ATN -->
            <span class="AssEXTApplicantsCurrent absolute"> <!-- Change 3 -->
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Current in Assessment Extension"  id="status_stage" data-status="'.$ad_full_submissionExtentionCurrent_statusID.'" data-stage="'.$ad_full_submissionExtentionCurrent_stageID.'" data-query="'.$ad_full_submissionExtentionCurrent_query.'">'.$ad_full_submissionExtentionCurrent.'</a> <span class="overdueApplicantsOnTBI RedColorClass">('.$ad_full_submissionExtentionCurrentOver.')</span><span class="tooltiptext">Applicants awaited for Form Assessment</span></span>
            </span>
            <!-- ATN -->
            <span class="followUpApplicantsCurrent absolute change">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Applicants Current in Assessment Followup"  id="status_stage" data-status="'.$ad_full_assessmentFollowup_Current_statusID.'" data-stage="'.$ad_full_assessmentFollowup_Current_stageID.'" data-query="'.$ad_full_assessmentFollowup_Current_query.'">'.$ad_full_assessmentFollowup_Current.'</a><span class="tooltiptext">Applicants currently in Followup</span> <span class="overdueApplicantsOnFollowUp RedColorClass">('.$ad_full_assessmentFollowup_CurrentOver.')</span></span>
            </span>
            <span class="followUpApplicantsNI absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Not Interested at Assessment"  id="status_stage" data-status="'.$ad_full_assessmentNotInterested_statusID.'" data-stage="'.$ad_full_assessmentNotInterested_stageID.'" data-query="'.$ad_full_assessmentNotInterested_query.'">'.$ad_full_assessmentNotInterested.'</a><span class="tooltiptext">Applicants moved to Not Interested from Followup</span></span>
            </span>
                        
                        
                        
            <span class="followUpApplicantsExtAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Overall Assessment Extension"  id="status_stage" data-status="'.$ad_full_assessmentExtention_statusID.'" data-stage="'.$ad_full_assessmentExtention_stageID.'" data-query="'.$ad_full_assessmentExtention_query.'">'.$ad_full_assessmentExtention.'</a><span class="tooltiptext">Overall applicants requested for Extension</span></span>
            </span>
                        
                        
                        
                        
           <span class="OHDApplicantsAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="On Hold After Assessment"  id="status_stage" data-status="'.$ad_full_assessment_Onhold_statusID.'" data-stage="'.$ad_full_assessment_Onhold_stageID.'" data-query="'.$ad_full_assessment_Onhold_query.'">'.$ad_full_assessment_Onhold.'</a><span class="tooltiptext">Applicants currently On Hold</span> <span class="overdueApplicantsOnAssessmentOHD RedColorClass">('.$ad_full_assessment_OnholdOver.')</span></span>
            </span>
                        
        </div><!-- assessmentArea  totalApplicantsPassedFromWTL -->
                
                
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->        
        
                
                <div class="discussionArea absolute" style="background:#;"> 
            <span class="totalApplicantsOnAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Currently in Discussion"  id="status_stage" data-status="'.$ad_full_discussion_statusID.'" data-stage="'.$ad_full_discussion_stageID.'" data-query="'.$ad_full_discussion_query.'">'.$ad_full_discussion.'</a><span class="tooltiptext">Applicants currently in Discussion</span></span>
            </span>
            <span class="totalApplicantsOnAssessmentOverAll absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Move To Discussion"  id="status_stage" data-status="'.$ad_full_discussionPresence_statusID.'" data-stage="'.$ad_full_discussionPresence_stageID.'" data-query="'.$ad_full_discussionPresence_query.'">'.$ad_full_discussionPresence.'</a><span class="tooltiptext">Overall applicants moved to Discussion</span></span>
            </span>
            <span class="totalApplicantsOnAssessmentPresent absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Show up for Discussion"  id="status_stage" data-status="'.$ad_full_discussionCurrent_statusID.'" data-stage="'.$ad_full_discussionCurrent_stageID.'" data-query="'.$ad_full_discussionCurrent_query.'">'.$ad_full_discussionCurrent.'</a><span class="tooltiptext">Applicants showed up for Discussion</span></span>
            </span>
                        
                         <span class="totalApplicantsOnWTLAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Move to Discussion Waitlist"  id="status_stage" data-status="'.$ad_full_discussionWaitlist_statusID.'" data-stage="'.$ad_full_discussionWaitlist_stageID.'" data-query="'.$ad_full_discussionWaitlist_query.'">'.$ad_full_discussionWaitlist.'</a><span class="tooltiptext">Overall applicants moved to Waitlist</span></span>
            </span>
                        
                        
            <span class="ApplicantsOnWTLLeftAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Currently in Discussion Waitlist"  id="status_stage" data-status="'.$ad_full_discussion_Waitlist_Current_statusID.'" data-stage="'.$ad_full_discussion_Waitlist_Current_stageID.'" data-query="'.$ad_full_discussion_Waitlist_Current_query.'">'.$ad_full_discussion_Waitlist_Current.'</a><span class="tooltiptext">Applicants currently in Waitlist</span> <span class="overdueApplicantsOnWTLAssessment RedColorClass">('.$ad_full_discussion_Waitlist_CurrentThreeOver.')</span></span>
            </span>
                        
                        
            <span class="totalApplicantsFromWTLToRGT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="From Discussion Waitlist to Regret"  id="status_stage" data-status="'.$ad_full_discussion_RegretPO_statusID.'" data-stage="'.$ad_full_discussion_RegretPO_stageID2.'" data-query="'.$ad_full_discussion_RegretPO_query.'">'.$ad_full_discussion_RegretPO.'</a><span class="tooltiptext">Overall applicants moved to Regret PO </span></span>
            </span>
                        
            <span class="totalApplicantsFromAssessmentToRGT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Move to Regret at Discussion"  id="status_stage" data-status="'.$ad_full_discussion_Regret_statusID.'" data-stage="'.$ad_full_discussion_Regret_stageID.'" data-query="'.$ad_full_discussion_Regret_query.'">'.$ad_full_discussion_Regret.'</a><span class="tooltiptext">Overall applicants moved to Regret First  </span></span>
            </span>
                        
                        
            <span class="totalApplicantsPassedFromWTL absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Discussion Allocated from waitlist"  id="status_stage" data-status="'.$ad_full_discussion_AfterWaitlist_statusID.'" data-stage="'.$ad_full_discussion_AfterWaitlist_stageID.'" data-query="'.$ad_full_discussion_AfterWaitlist_query.'">'.$ad_full_discussion_AfterWaitlist.'</a><span class="tooltiptext">Overall applicants allocated from Waitlist</span></span>
            </span>
                        
                        
            <span class="followUpApplicants absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Discussion Overall Followup"  id="status_stage" data-status="'.$ad_full_discussion_Followup_statusID.'" data-stage="'.$ad_full_discussion_Followup_stageID.'" data-query="'.$ad_full_discussion_Followup_query.'">'.$ad_full_discussion_Followup.'</a><span class="tooltiptext">Overall applicants moved to Followup</span></span>
            </span>
            <!-- ATN -->
                        
                        
            <span class="DISCEXTApplicantsCurrent absolute"> <!-- Change 4 -->
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Discussion Currently in Extension"  id="status_stage" data-status="'.$ad_full_discussionExtentionCurrent_statusID.'" data-stage="'.$ad_full_discussionExtentionCurrent_stageID.'" data-query="'.$ad_full_discussionExtentionCurrent_query.'">'.$ad_full_discussionExtentionCurrent.'</a><span class="tooltiptext">Applicants currently in Discussion Extension</span> <span class="overdueApplicantsOnFollowUp RedColorClass">('.$ad_full_discussionExtentionCurrent_over.')</span></span>
            </span>
                        
                        
            <!-- ATN -->
            <span class="followUpApplicantsCurrent absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Discussion Currently in Followup"  id="status_stage" data-status="'.$ad_full_discussion_FollowupCurrent_statusID.'" data-stage="'.$ad_full_discussion_FollowupCurrent_stageID.'" data-query="'.$ad_full_discussion_FollowupCurrent_query.'">'.$ad_full_discussion_FollowupCurrent.'</a><span class="tooltiptext">Applicants currently in Followup</span> <span class="overdueApplicantsOnFollowUp RedColorClass">('.$ad_full_discussion_FollowupCurrentOver.')</span></span>
            </span>
            <span class="followUpApplicantsNI absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Discussion not interested"  id="status_stage" data-status="'.$ad_full_discussionNotInterested_statusID.'" data-stage="'.$ad_full_discussionNotInterested_stageID.'" data-query="'.$ad_full_discussionNotInterested_query.'">'.$ad_full_discussionNotInterested.'</a><span class="tooltiptext">Applicants moved to Not Interested from Followup</span></span>
            </span>
                        
            <span class="followUpApplicantsExtAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Discussion Overall Extension"  id="status_stage" data-status="'.$ad_full_discussion_FollowupCurrentOver_statusID.'" data-stage="'.$ad_full_discussion_FollowupCurrentOver_stageID.'" data-query="'.$ad_full_discussion_FollowupCurrentOver_query.'">'.$ad_full_discussion_FollowupCurrentOver.'</a><span class="tooltiptext">Overall applicants requested for Extension</span></span>
            </span>
                        
                        
                        <span class="OHDApplicantsAssessment absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Discussion on Hold After Discussion"  id="status_stage" data-status="'.$ad_full_discussion_Onhold_statusID.'" data-stage="'.$ad_full_discussion_Onhold_stageID.'" data-query="'.$ad_full_discussion_Onhold_query.'">'.$ad_full_discussion_Onhold.'</a><span class="tooltiptext">Applicants currently On Hold</span> <span class="overdueApplicantsOnAssessmentOHD RedColorClass">('.$ad_full_discussion_OnholdOver.')</span></span>
            </span>
                        
        </div><!-- discussionArea -->
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->        
        
               <div class="EAOOfferArea absolute" style="background:#;">
    <span class="totalApplicantsOnALEVELRAO absolute">
    <span class="tooltipp">
    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Overall Applicants in A-Level RAO"  id="status_stage" data-status="'.$ROA_Overall_Status.'" data-stage="'.$ROA_Overall_Stage.'" data-query="'.$ROA_Overall_Query.'">'.$ROA_Overall_Total. '</a>
    <span class="tooltiptext">Overall Applicants in A-Level RAO</span>
    </span>
    </span>
    <span class="totalApplicantsOnALEVELEAO absolute">
    <span class="tooltipp">
    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Overall Applicants in A-Level EAO"  id="status_stage" data-status="'.$EOA_Overall_Status. '" data-stage="' . $EOA_Overall_Stage . '" data-query="'. $EOA_Overall_Query . '">' . $EOA_Overall_Total . '</a>
    <span class="tooltiptext">Overall Applicants in A-Level EAO</span>
    </span>
    </span>

    <span class="totalApplicantsOnALEVELRAOAwaiting absolute">
    <span class="tooltipp">
    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Overall Applicants in A-Level RAO Awaiting Result"  id="status_stage" data-status="'. $ROA_WaitingR_Status . '" data-stage="'.$ROA_WaitingR_Stage. '" data-query="'. $ROA_WaitingR_Query . '">' . $ROA_WaitingR_Total . '</a>
    <span class="tooltiptext">Overall Applicants in A-Level RAO Awaiting Result</span>
    </span>
    </span>
    <span class="totalApplicantsOnALEVELEAOAwaiting absolute">
    <span class="tooltipp">
    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Overall Applicants EAO"  id="status_stage" data-status="' . $EOA_Prep_Overall_Awaiting_Result_Status . '" data-stage="'. $EOA_Prep_Overall_Awaiting_Result_Stage . '" data-query="'. $EOA_Prep_Overall_Awaiting_Result_Query . '">'. $EOA_Prep_Overall_Awaiting_Result . '</a>
    <span class="tooltiptext">Overall Applicants in A-Level EAO Awaiting Result</span>
    </span>
    </span>

    <span class="totalApplicantsOnALEVELEAOPrep absolute">
    <span class="tooltipp">
    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Applicants in EAO Preparation"  id="status_stage" data-status="' . $In_EOA_Prep_Status . '" data-stage="' . $In_EOA_Prep_Stage . '" data-query="' . $In_EOA_Prep_Query . '">' . $In_EOA_Prep_Total . '</a>
    <span class="tooltiptext">Applicants in EAO Preparation</span>
    </span>
    </span>
    <span class="totalApplicantsOnALEVELEAOProc absolute">
    <span class="tooltipp">
    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Applicants in EAO Procedure"  id="status_stage" data-status="'.$In_EOA_Proc_Status.'" data-stage="'. $In_EOA_Proc_Stage .'" data-query="'. $In_EOA_Proc_Query .'">'.$In_EOA_Proc_Total.'</a>
    <span class="tooltiptext">Applicants in EAO Procedure</span>
    </span>
    </span>
    <span class="totalApplicantsOnALEVELEAOmovedFromPrepToProc absolute">
    <span class="tooltipp">
    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Overall Applicants Move EAO Procedure"  id="status_stage" data-status="'.$Move_To_EOA_Proc_Status.'" data-stage="'.$Move_To_EOA_Proc_Stage.'" data-query="'. $Move_To_EOA_Proc_Query .'">'.$Move_To_EOA_Proc_Total. '</a>
    <span class="tooltiptext">Overall Applicants in A-Level EAO</span>
    </span>
    </span>


    <span class="totalApplicantsOnALEVELRAOPRV-Regret absolute">
    <span class="tooltipp">
    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Applicants in Post Result Verification"  id="status_stage" data-status="" data-stage="" data-query="">12</a>
    <span class="tooltiptext">Applicants in Post Result Verification</span>
    </span>
    </span>
    <span class="totalApplicantsOnALEVELRAOPRV absolute">

    <span class="tooltipp">
    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Applicants in Post Result Verification"  id="status_stage" data-status="'.$PR_Verification_Status.'" data-stage="'.$PR_Verification_Stage.'" data-query="'.$PR_Verification_Query.'">'.$PR_Verification_Num.'</a>
    <span class="tooltiptext">Applicants in Post Result Verification</span>
    </span>

    </span>

    <span class="totalApplicantsOnALEVELRAOPRVOverallToOffer absolute">

   

    <span class="tooltipp">
    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Applicants moved to Final Admission Offer"  id="status_stage" data-status="'.$FinalAdmissionOffer_Status.'" data-stage="'.$FinalAdmissionOffer_Stage.'" data-query="'.$FinalAdmissionOffer_Query.'">'.$FinalAdmissionOffer_Num.'</a>
    <span class="tooltiptext">Applicants moved to Final Admission Offer</span>
    </span>


    </span>


    <span class="followUpApplicantsforEAOPrep absolute ">
    <span class="tooltipp">
    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Applicants in Preparation Followup"  id="status_stage" data-status="' . $EOA_Prep_Followup_Status . '" data-stage="'.$EOA_Prep_Followup_Stage.'" data-query="'. $EOA_Prep_Followup_Query .'">'.$EOA_Prep_Followup.'</a>
    <span class="tooltiptext">Applicants in Preparation Followup</span>
    </span>
    </span>
    <span class="followUpApplicantsforEAOPrepExt absolute ">
    <span class="tooltipp">
    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Applicants in Preparation Extension"  id="status_stage" data-status="'.$EOA_Prepre_CurExt_Status.'" data-stage="'.$EOA_Prepre_CurExt_Stage.'" data-query="'. $EOA_Prepre_CurExt_Query .'">'.$EOA_Prepre_CurExt_Num.'</a>
    <span class="tooltiptext">Applicants in Preparation Extension</span>
    </span>
    </span>
    <span class="followUpApplicantsforEAOPrepExtOverall absolute ">
    <span class="tooltipp">
    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Overall Extensions"  id="status_stage" data-status="'.$EOA_Prepre_OverallExtt_Status.'" data-stage="'.$EOA_Prepre_OverallExt_Stage.'" data-query="'.$EOA_Prepre_OverallExt_Query.'">'.$EOA_Prepre_OverallExt_Num.'</a>
    <span class="tooltiptext">Overall Extensions</span>
    </span>
    </span>
    <span class="followUpApplicantsforEAOPrepRGT absolute ">
    <span class="tooltipp">

    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Applicants moved to Not Interested from Followup"  id="status_stage" data-status="'. $EOA_Prep_NI_Status .'" data-stage="'. $EOA_Prep_NI_Stage .'" data-query="'. $EOA_Prep_NI_Query .'">'.$EOA_Prep_NI.'</a>
    <span class="tooltiptext">Applicants moved to Not Interested from Followup</span>
    </span>
    </span>

    <span class="followUpApplicantsforEAOProcedure absolute ">
    <span class="tooltipp">

     <a href="#" data-toggle="modal" data-target="#myModal" data-title="Applicants in Bank Confirmation Followup"  id="status_stage" data-status="'. $BankConfirmationFollowup_Status .'" data-stage="'. $BankConfirmationFollowup_Stage .'" data-query="'. $BankConfirmationFollowup_Query .'">'.$BankConfirmationFollowup.'</a>

   
    <span class="tooltiptext">Applicants in Bank Confirmation Followup</span>
    </span>
    </span>
    <span class="followUpApplicantsforEAOProcedureExt absolute ">
    <span class="tooltipp">
   

    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Applicants in Bank Confirmation Extension"  id="status_stage" data-status="'. $EOA_Proc_CurExt_Status .'" data-stage="'. $EOA_Proc_CurExt_Stage .'" data-query="'. $EOA_Proc_CurExt_Query .'">'.$EOA_Proc_CurExt_Num.'</a>

    <span class="tooltiptext">Applicants in Bank Confirmation Extension</span>
    </span>
    </span>
    <span class="followUpApplicantsforEAOProcedureExtOverall absolute ">
    <span class="tooltipp">
   

 <a href="#" data-toggle="modal" data-target="#myModal" data-title="Overall Applicants Extension"  id="status_stage" data-status="'. $EOA_Proc_OverallExtt_Status .'" data-stage="'. $EOA_Proc_OverallExt_Stage .'" data-query="'. $EOA_Proc_OverallExt_Query .'">'.$EOA_Proc_OverallExt_Num.'</a>



    <span class="tooltiptext">Overall Applicants Extension</span>
    </span>
    </span>
    <span class="followUpApplicantsforEAOProcedureRGT absolute ">
    <span class="tooltipp">
    <a href="#" data-toggle="modal" data-target="#myModal" data-title="Applicants moved to Not Interested from Followup"  id="status_stage" data-status="'.$EOA_NI_FB_Status.'" data-stage="'.$EOA_NI_FB_Stage.'" data-query="'.$EOA_NI_FB_Query.'">'.$EOA_NI_FB.'</a>
    <span class="tooltiptext">Applicants moved to Not Interested from Followup</span>
    </span>
    </span>

    </div><!-- EAOOfferArea -->
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
        
                <div class="offerArea absolute">
                
                
                
            <span class="totlaApplicantsPassedFromOffer absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Overall Move to Offer Preparation"  id="status_stage" data-status="'.$ad_full_offer_statusID.'" data-stage="'.$ad_full_offer_stageID.'" data-query="'.$ad_full_offer_query.'">'.$ad_full_offer.'</a><span class="tooltiptext">Overall applicants moved to Offer Preparation</span></span>
            </span>
                        
                        
            <span class="totalApplicantsOnOffer absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Currently in Offer Preparation"  id="status_stage" data-status="'.$ad_full_offerFollowup_statusID.'" data-stage="'.$ad_full_offerFollowup_stageID.'" data-query="'.$ad_full_offerFollowup_query.'">'.$ad_full_offerFollowup.'</a><span class="tooltiptext">Applicants currently in Offer Preparation</span> <span class="overdueApplicantsOnOffer RedColorClass">('.$ad_full_offerCurrenlty2Days.')</span></span>
            </span>
                        
                        
            <span class="totlaApplicantsPassedFromOfferShow absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Offer Show"  id="status_stage" data-status="'.$ad_full_offerShowedup_statusID.'" data-stage="'.$ad_full_offerShowedup_stageID.'" data-query="'.$ad_full_offerShowedup_query.'">'.$ad_full_offerShowedup.'</a><span class="tooltiptext">Overall applicants showed up to Receive the Offer Letter</span></span>
            </span>
                        
                        
                        <span class="totlaApplicantsPassedFromFAOProcedureToChecklist absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Applicants In Offered Procedure"  id="status_stage" data-status="'.$ad_full_offerShowedup_statusID.'" data-stage="'.$ad_full_offerShowedup_stageID.'" data-query="'.$ad_full_offerShowedup_query.'">'.$ad_full_offerShowedup.'</a><span class="tooltiptext">Overall applicants moved to Complete Check</span></span>
            </span>
                        
                        
            <span class="offerShowupToFollowup absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Overall FAO Followup"  id="status_stage" data-status="'.$ad_full_offerFollowup_ALL_statusID.'" data-stage="'.$ad_full_offerFollowup_ALL_stageID.'" data-query="'.$ad_full_offerFollowup_ALL_query.'">'.$ad_full_offerFollowup_ALL.'</a><span class="tooltiptext">Overall applicants moved to Followup</span></span> 
            </span>
                        
                        
                        
                        
            <span class="totalApplicantsOnOfferFollowUp absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Currently FAO Followup"  id="status_stage" data-status="'.$ad_full_offerFollowupOver_statusID.'" data-stage="'.$ad_full_offerFollowupOver_stageID.'" data-query="'.$ad_full_offerFollowupOver_query.'">'.$ad_full_offerFollowupOver.'</a><span class="tooltiptext">Applicants currently in Followup</span> <span class="overdueApplicantsOnOfferShow RedColorClass">('.$ad_full_offerFollowupOver_red.')</span></span>
            </span>
                        
                        
                        
            <span class="totlaApplicantsPassedFromFollowupToNIT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="FOA Overall Not Interested"  id="status_stage" data-status="'.$ad_full_offer_NotInterested_statusID.'" data-stage="'.$ad_full_offer_NotInterested_stageID.'" data-query="'.$ad_full_offer_NotInterested_query.'">'.$ad_full_offer_NotInterested.'</a><span class="tooltiptext">Overall applicants moved to Not Interedted from Followup</span></span>
            </span>
                        
                        
            <span class="totlaApplicantsPassedFromFollowupToEXT absolute">
                <span class="tooltipp"><a href="#" data-target="#myModal" data-toggle="modal" data-title="FAO Extension"  id="status_stage" data-status="'.$ad_full_offerExtention_statusID.'" data-stage="'.$ad_full_offerExtention_stageID.'" data-query="'.$ad_full_offerExtention_query.'">'.$ad_full_offerExtention.'</a><span class="tooltiptext">Overall applicants requested for Extension</span></span>
            </span>
                        
                         
                        
            <span class="bankShowupToFollowup absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Fee Bill Due Date"  id="status_stage" data-status="'.$ad_full_offeredf_complete_check_statusID.'" data-stage="'.$ad_full_offeredf_complete_check_stageID .'" data-query="'.$ad_full_offeredf_complete_check_query.'">'.$ad_full_offeredf_complete_check.'</a><span class="tooltiptext">Overall applicants moved to Followup from Fee bill due date</span></span> 
                        </span>

            <!-- Change Here -->
            <span class="totalApplicantsInOffered absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="FOA Procedure Currently"  id="status_stage" data-status="'.$ad_full_offered_statusID.'" data-stage="'.$ad_full_offered_stageID.'" data-query="'.$ad_full_offered_query.'">'.$ad_full_offered.'</a><span class="tooltiptext">Applicants in Procedure</span> <span class="overdueApplicantsOnOffer RedColorClass">('.$ad_full_offered_red.')</span></span>
            </span>
                        
                        
                           
                           
                        <span class="totalApplicantsInOfferedCompleteCheck absolute">
                                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="In Offered Complete Check Admission"  id="status_stage" data-status="'.$ad_full_offered_complete_check_statusID.'" data-stage="'.$ad_full_offered_complete_check_stageID.'" data-query="'.$ad_full_offered_complete_check_query.'">'.$ad_full_offered_complete_check.'</a><span class="tooltiptext">Applicants in Complete Check</span> <span class="overdueApplicantsOnOffer RedColorClass">('.$ad_full_offered_complete_checkOver.')</span></span>
            </span>

            <span class="totalApplicantsOnBankFollowUp absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Currently Complete Checklist Followup"  id="status_stage" data-status="'.$ad_full_admission_Followup_statusID.'" data-stage="'.$ad_full_admission_Followup_stageID.'" data-query="'.$ad_full_admission_Followup_query.'">'.$ad_full_admission_Followup.'</a><span class="tooltiptext">Applicants currently in Followup</span> <span class="overdueApplicantsOnOfferShow RedColorClass">('.$ad_full_admission_FollowupOver.')</span></span>
            </span>
                        
                        
            <span class="totlaApplicantsPassedFromBankToNIT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Complete Checklist Not Interested"  id="status_stage" data-status="'.$ad_full_complete_checkNotInterested_statusID.'" data-stage="'.$ad_full_complete_checkNotInterested_stageID.'" data-query="'.$ad_full_complete_checkNotInterested_query .'">'.$ad_full_complete_checknNotInterested.'</a><span class="tooltiptext">Overall applicants moved to Not Intersted from Followup</span></span>
            </span>
                        
                        
            <span class="totlaApplicantsPassedFromBankToEXT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-title="Complete Checklist Extension"  data-status="'.$ad_full_offerede_complete_check_statusID.'" data-stage="'.$ad_full_offerede_complete_check_stageID .'" data-query="'.$ad_full_offerede_complete_check_query .'">'.$ad_full_offerede_complete_check.'</a><span class="tooltiptext">Overall applicants requested for Extension</span></span>
            </span>
                        
                        
        </div><!-- offerArea -->
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->     
        <div class="finalArea absolute">
            <span class="finalRGT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Applicants Regrected"  id="status_stage" data-status="'.$ad_total_Regret_statusID.'" data-stage="'.$ad_total_Regret_stageID.'" data-query="'.$ad_total_Regret_query.'">'.$ad_total_Regret.'</a><span class="tooltiptext">List of Applicants in Regret</span></span>
            </span>
            <!-- Change Here -->
            <span class="finalRGTPAApproval absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="To be regretted"  id="status_stage" data-status="'.$ad_full_PO_RegretAPR_statusID.'" data-stage="'.$ad_full_PO_RegretAPR_stageID.'" data-query="'.$ad_full_PO_RegretAPR_query.'">'.$ad_full_PO_RegretAPR.'</a><span class="tooltiptext">To Be Regretted</span></span>
            </span>
            <span class="finalADMCOM absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Admission Complete"  id="status_stage" data-status="'.$ad_total_Admission_statusID.'" data-stage="'.$ad_total_Admission_stageID.'" data-query="'.$ad_total_Admission_query.'">'.$ad_total_Admission.'</a><span class="tooltiptext">List of Applicants with Confirm Admissions</span></span>
            </span>
 
            <!-- Change Here -->
            <span class="finalNIT absolute">
                <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-title="Applicants Aborted"  id="status_stage" data-status="'.$ad_total_NotInterested_statusID.'" data-stage="'.$ad_total_NotInterested_stageID.'" data-query="'.$ad_total_NotInterested_query.'">'.$ad_total_NotInterested.'</a><span class="tooltiptext">Aborted</span></span>
            </span>
        </div><!-- finalArea -->'; 
		
		echo $html;
    }   


    public function edit2(){
        $html = '';


        $this->load->model('gs_admission/process_flows/process_flow_xp_model');        
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
		$Modal_Title = $this->input->post('Modal_Title');
		//var_dump($this->input->post());
        $this->load->model('gs_admission/process_flows/process_flow_xp_model');
		$data['admission'] = $this->process_flow_xp_model->getAdmissionList($StatusID, $StageID, $gradeID, $batchID, $gender, $query);
		$html = '';
        $html .='<div class="modal-header">';
        $html .='<button type="button" class="close floatClose" data-dismiss="modal">&times;</button>';
        $html .='<h4 class="modal-title">Applicant Details - <strong>'.$Modal_Title.'</strong> <span class="pull-right"></span></h4>';
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
		//$html .= '<script> $("#AllApplicantListing").dataTable(); </script>';
		
		$html .= "<script> 
		
		var Modal_Title = '$Modal_Title';
		
		$('#AllApplicantListing').DataTable( {
        dom: 'Bfrtip',
		buttons: [
			{
                extend: 'excelHtml5',
				text: 'Export Excel Format',
                title: Modal_Title,
				className: 'btn btn-default btn-xs',
				exportOptions: { columns: ':not(:last-child)', }
				
            },
			{
                extend: 'pdfHtml5',
				text: 'Export PDF Format',
				title: Modal_Title,
				className: 'btn btn-default btn-xs',
				exportOptions: { columns: ':not(:last-child)', }
				
            }
        ],
		 
    } );
	
		</script>";
		

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